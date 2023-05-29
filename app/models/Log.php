<?php

  namespace app\models;

  class Log extends ModeloGenerico {
    public $descricao = null;
    public $erro = null;

    protected function alimentar_modelo_json($json) {}

    public function salvar($commit = true) {
      $sql = 
        "INSERT INTO ticto_logs (descricao, erro) VALUES (:DESCRICAO, :ERRO)";
      
      $args = [':ERRO' => $this->erro, ':DESCRICAO' => $this->descricao];
      $this->db->non_query($sql, $args, $commit);
    }
  }