<?php

  namespace app\models;

  class Item extends ModeloGenerico {
    public $id = null;
    public $codigo_item = null;
    public $nome = null;
    public $descricao = null;
    public $tipo = null;
    public $tipo_descricao = null;
    public $imagem = null;

    protected function alimentar_modelo_json($obj) {
      $this->codigo_item    = $obj->code;
      $this->nome           = $obj->name??null;
      $this->descricao      = $obj->description??null;
      $this->tipo           = $obj->type??null;
      $this->tipo_descricao = $obj->type_text??null;
      $this->imagem         = $obj->image??null;
    }

    private function existe() {
      $item = new Item();
      $sql = "SELECT id FROM api_item WHERE codigo_item = :CODIGO_ITEM";
      $busca = $item->db->query($sql, [':CODIGO_ITEM' => $this->codigo_item]);
      
      if (!empty($busca)) {
        $this->id = $busca[0]['id'];
      }
    }
    
    public function salvar($commit = true) {
      $this->existe();
      $args = [
        ':NOME' => $this->nome, ':DESCRICAO' => $this->descricao, ':IMAGEM' => $this->imagem,
        ':TIPO' => $this->tipo, ':TIPO_DESCRICAO' => $this->tipo_descricao
      ];

      if ($this->id == null) {
        $sql = 
          "INSERT INTO api_item (codigo_item, nome, descricao, imagem, tipo, tipo_descricao) 
          VALUES (:CODIGO_ITEM, :NOME, :DESCRICAO, :IMAGEM, :TIPO, :TIPO_DESCRICAO)";
        $args[':CODIGO_ITEM'] = $this->codigo_item;
      } else {
        $sql = "UPDATE api_item SET nome = :NOME, descricao = :DESCRICAO, imagem = :IMAGEM,
         tipo = :TIPO, tipo_descricao = :TIPO_DESCRICAO WHERE id = :ID";
        $args[':ID'] = $this->id;
      }

      $this->db->non_query($sql, $args, $commit);
      $this->id = $this->id??$this->db->get_last_id();

      return $this->db->get_rows(true) > 0;
    }

  }