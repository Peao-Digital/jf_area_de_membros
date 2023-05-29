<?php
  namespace app\models;
  use app\database\PDOConnection;

  abstract class ModeloGenerico {
    public $db = null;

    public function __construct($db = null, $json = null) {
      if ($db == null) {
        $db = new PDOConnection($_ENV);
      }
      $this->db = $db;

      if($json != null) {
        $this->alimentar_modelo_json($json);
      }
    }

    abstract protected function alimentar_modelo_json($json);
    abstract public function salvar($commit = true);
  }