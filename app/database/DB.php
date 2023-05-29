<?php

  namespace app\database;

  abstract class DB {
    protected $host = null;
    protected $conn = null;
    protected $database = null;
    protected $user = null;
    protected $pass = null;
    protected $port = null;
    protected $rows = 0;
    protected $err_msg;
  
    abstract public function connect();
    abstract public function desconnect();
    abstract public function set_connection($param);

    /**
     * @param string $sql
     * @param array|null $args
     * 
     * @return mixed
     */
    abstract public function query($sql, $args = null);
    abstract public function non_query($sql, $args = null, $commit = true);
    abstract public function commit();
    abstract public function rollback();

    abstract public function get_error();
    
    public function conectado(){
      return !empty($this->conn);
    } 

    public function get_rows($clear = false)
    {
      $rows = $this->rows;
      if ($clear) {
        $this->rows = 0;
      }
      return $rows;
    }

    public function clear_rows()
    {
      $this->rows = 0;
    }

    public function get_last_id() 
    {
      return $this->conn->lastInsertId();
    }

    public function __destruct()
    {
      $this->desconnect();
    }
  }