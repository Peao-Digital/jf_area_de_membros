<?php
  namespace app\models;

  class TransacaoItem extends ModeloGenerico {
    public $item_id = null;
    public $cliente_id = null;
    public $data_transacao = null;
    public $codigo_transacao = null;
    public $quantidade = null;
    
    protected function alimentar_modelo_json($obj){}

    private function existe() {
      $transacao = new TransacaoItem();
      $sql = "SELECT 1 FROM api_transacao_item WHERE cliente_id = :CLIENTE_ID AND item_id = :ITEM_ID";
      $args = [':CLIENTE_ID' => $this->cliente_id, ':ITEM_ID' => $this->item_id];

      return !empty($transacao->db->query($sql, $args));
    }

    public function salvar($commit = true) {
      $sql = 
        "INSERT INTO api_transacao_item (item_id, cliente_id, data_transacao, codigo_transacao, quantidade) 
        VALUES (:ITEM_ID, :CLIENTE_ID, :DATA_TRANSACAO, :CODIGO_TRANSACAO, :QUANTIDADE)";

      $args = [
        ':ITEM_ID' => $this->item_id, ':CLIENTE_ID' => $this->cliente_id, 
        ':DATA_TRANSACAO' => $this->data_transacao, 
        ':CODIGO_TRANSACAO' => $this->codigo_transacao, ':QUANTIDADE' => $this->quantidade
      ];

      if($this->existe()) {
        return true;
      } else {
        $this->db->non_query($sql, $args, $commit);
        return $this->db->get_rows(true) > 0;
      }
    }

  }