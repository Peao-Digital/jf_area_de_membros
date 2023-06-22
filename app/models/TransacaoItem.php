<?php
  namespace app\models;

  class TransacaoItem extends ModeloGenerico {
    public $id = null;
    public $item_id = null;
    public $cliente_id = null;
    public $codigo_plano_vendas = null;
    public $codigo_plano_vendas_desc = null;
    public $data_transacao = null;
    public $codigo_transacao = null;
    public $quantidade = null;
    public $liberado = null;
    
    protected function alimentar_modelo_json($obj){}

    private function existe() {
      $transacao = new TransacaoItem();
      $sql = "SELECT id FROM api_transacao_item WHERE cliente_id = :CLIENTE_ID AND item_id = :ITEM_ID";
      $args = [':CLIENTE_ID' => $this->cliente_id, ':ITEM_ID' => $this->item_id];

      $dados = $transacao->db->query($sql, $args);
 
      if (!empty($dados)) {
        $this->id = $dados[0]['id'];
        return true;
      }

      return false;
    }

    public function salvar($commit = true) {
      if($this->existe()) {
        $sql = "UPDATE api_transacao_item SET liberado = :LIBERADO WHERE id = :ID";
        $args = [
          ':ID' => $this->id, ':LIBERADO' => $this->liberado
        ];
        
      } else {
        $sql = 
          "INSERT INTO api_transacao_item (item_id, cliente_id, codigo_plano_vendas, codigo_plano_vendas_desc, data_transacao, codigo_transacao, quantidade, liberado) 
          VALUES (:ITEM_ID, :CLIENTE_ID, :COD_PLANO, :COD_PLA_DESC, :DATA_TRANSACAO, :CODIGO_TRANSACAO, :QUANTIDADE, :LIBERADO)";

        $args = [
          ':ITEM_ID' => $this->item_id, ':CLIENTE_ID' => $this->cliente_id,
          ':COD_PLANO' => $this->codigo_plano_vendas, ':COD_PLA_DESC' => $this->codigo_plano_vendas_desc,
          ':DATA_TRANSACAO' => $this->data_transacao, 
          ':CODIGO_TRANSACAO' => $this->codigo_transacao, ':QUANTIDADE' => $this->quantidade,
          ':LIBERADO' => $this->liberado
        ];
      }

      $this->db->non_query($sql, $args, $commit);
      return $this->db->get_rows(true) > 0;
    }

  }