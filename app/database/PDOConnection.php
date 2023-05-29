<?php
  namespace app\database;

  use \PDO;
  use \PDOException;
  use \Exception;
  
  class PDOConnection extends DB {

    private $database_type = null;
    private $fetch = PDO::FETCH_ASSOC;
    private $fetch_class = null;
    private $in_transaction = false;
    private $database_types = ['sqlite', 'sqlsrv', 'mssql', 'mysql', 'pg', 'ibm', 'dblib', 'firebird'];

    public function __construct($param_connection = [], $auto_connect = true) {
      if (count($param_connection) > 0) {
        $this->database_type = $param_connection['DB_ENGINE'];
        $this->set_connection($param_connection);
      }

      if ($auto_connect) {
        $this->connect();
      }
    }

    public function get_error() {
      return $this->err_msg;
    }

    public function set_connection($param) {
      if (gettype($param) === 'array') {

        $this->set_db_info($param);

        return true;
      }
      return false;
    }

    public function set_db_info($param) {
      $this->conn = null;
      $this->host = isset($param['DB_HOST']) ? $param['DB_HOST'] : null;
      $this->port = isset($param['DB_PORT']) ? $param['DB_PORT'] : null;
      $this->user = isset($param['DB_USER']) ? $param['DB_USER'] : null;
      $this->pass = isset($param['DB_PASS']) ? $param['DB_PASS'] : null;
      if (isset($param['DB_DATABASE'])) {
        if ($param['DB_DATABASE'] !== null && $param['DB_DATABASE'] !== '') {
          $this->database = $param['DB_DATABASE'];
        }
      }
    }

    public function set_fetch($mode, $class = null) {
      if($mode == 'CLASSE'){
        $this->fetch = PDO::FETCH_CLASS;
        $this->fetch_class = $class;
      }else if($mode == 'OBJ') {
        $this->fetch = PDO::FETCH_OBJ;
      }else{
        $this->fetch = PDO::FETCH_ASSOC;
        $this->fetch_class = null;
      }
    }

    public function query($sql, $args = null, $fetch = true) {
      if ($this->conn != null) {
        try {
          $sttmnt = $this->conn->prepare($sql);
          if ($args !== null) {
            $sttmnt->execute($args);
          } else {
            $sttmnt->execute();
          }
          if ($fetch) {
            if ($this->fetch_class === null) {
              $sttmnt = $sttmnt->fetchAll($this->fetch);
            } else {
              $sttmnt = $sttmnt->fetchAll($this->fetch, $this->fetch_class);
            }
          }
          return $sttmnt;
        } catch (PDOException $e) {
          $this->err_msg = 'Error: ' . $e->getMessage();
          return false;
        }
      }
    }

    public function non_query($sql, $args = null, $commit = true) {
      if (!$commit && !$this->in_transaction) {
        try {
          $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        } catch (Exception $ex) {}
        $this->beginTransaction();
      } else if ($commit) {
        try {
          $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
        } catch (Exception $ex) {}
        $this->in_transaction = false;
      }
      try {
        $sttmnt = $this->conn->prepare($sql);
        if ($args !== null) {
          $sttmnt->execute($args);
        } else {
          $sttmnt->execute();
        }

        $this->rows += $sttmnt->rowCount();
        return $this->rows;
      } catch (PDOException $e) {
        $this->err_msg = 'Error: ' . $e->getMessage();
        return false;
      }
    }

    public function beginTransaction() {
      $this->conn->beginTransaction(); 
      $this->in_transaction = true;
    }

    public function commit() {
      $this->conn->commit();
      $this->in_transaction = false;
    }

    public function rollback() {
      $this->conn->rollBack();
      $this->in_transaction = false;
    }

    public function connect() {
      if (in_array($this->database_type, $this->database_types)) {
        try {
          if ($this->conn !== null) {
            return $this->conn;
          }

          switch ($this->database_type) {
            case 'mssql':
              $this->conn = new PDO('mssql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->pass);
              break;
            case 'sqlsrv':
              $this->conn = new PDO('sqlsrv:server=' . $this->host . ';database=' . $this->database, $this->user, $this->pass);
              break;
            case 'ibm': //default port = ?
              $this->conn = new PDO('ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=' . $this->database . '; HOSTNAME=' . $this->host . ';PORT=' . $this->port . ';PROTOCOL=TCPIP;', $this->user, $this->password);
              break;
            case 'dblib': //default port = 10060
              $this->conn = new PDO('dblib:host=' . $this->host . ':' . $this->port . ';dbname=' . $this->database, $this->user, $this->pass);
              break;
            case 'firebird':
              $this->conn = new PDO('firebird:dbname=' . $this->host . ':' . $this->database, $this->user, $this->pass);
              break;
            case 'sqlite':
              $this->conn = new PDO('sqlite:' . $this->database);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              break;
            case 'mysql':
              $opcoes = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::MYSQL_ATTR_FOUND_ROWS => true];
              $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->database . ';', $this->user, $this->pass, $opcoes);
              break;
            case 'pg':
              $this->conn = (is_numeric($this->port)) ? new PDO('pgsql:dbname=' . $this->database . ';port=' . $this->port . ';host=' . $this->host , $this->user, $this->pass) : new PDO('pgsql:dbname=' . $this->database . ';host=' . $this->host , $this->user, $this->pass);
              break;
            default:
              $this->conn = null;
              break;
          }

          $this->conn->exec('SET NAMES UTF8');
          
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

          return $this->conn;
        } catch (PDOException $e) {
          $this->err_msg = 'Error: ' . $e->getMessage();
          return false;
        }
      }
    }

    public function desconnect() {
      if ($this->conn !== null) {
        try {
          $this->conn = null;
        } catch (Exception $ex) {
          $this->err_msg = $ex->getMessage();
        }
      }
    }
  }