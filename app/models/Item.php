<?php

  namespace app\models;

  class Item extends ModeloGenerico {
    public $ordem_id = null;
    public $nome_produto = null;
    public $produto_id = null;
    public $nome_produto_adquirido = null;
    public $oferta_id = null;
    public $prazo_reembolso = null;
    public $cupom_id = null;
    public $quantidade_itens = null;
    public $preco_unidade_oferta = null;
    public $membro_id = null;
    public $membro_classe_id = null;
    public $dias_acesso_membros = null;

    protected function alimentar_modelo_json($json) {
      $this->nome_produto           = $json["product_name"];
      $this->produto_id             = $json["product_id"];
      $this->nome_produto_adquirido = $json["offer_name"];
      $this->oferta_id              = $json["offer_id"];
      $this->prazo_reembolso        = $json["refund_deadline"]??null;
      $this->cupom_id               = $json["coupon_id"];
      $this->quantidade             = $json["quantity"];
      $this->preco_unidade_oferta   = $json["amount"];
      $this->membro_id              = $json["members_portal_id"];
      $this->membro_classe_id       = $json["members_classroom_id"];
      $this->dias_acesso_membros    = $json["days_of_access"];
    }
    
    public function salvar($commit = true) {
      $sql = 
        "INSERT INTO ticto_item (ordem_id, nome_produto, produto_id, nome_produto_adquirido,oferta_id,prazo_reembolso,
          cupom_id,quantidade,preco_unidade_oferta, membro_id, membro_classe_id,dias_acesso_membros)
         VALUES (:ORDEM_ID, :NOME_PRODUTO, :PRODUTO_ID, :NOME_PRODUTO_ADQUIRIDO, :OFERTA_ID, :PRAZO_REEMBOLSO,
          :CUPOM_ID, :QUANTIDADE, :PRECO_UNIDADE_OFERTA, :MEMBRO_ID, :MEMBRO_CLASSE_ID, :DIAS_ACESSO_MEMBROS)";
      
      $args = [
        ':ORDEM_ID' => $this->ordem_id, ':NOME_PRODUTO' => $this->nome_produto, ':PRODUTO_ID' => $this->produto_id, 
        ':NOME_PRODUTO_ADQUIRIDO' => $this->nome_produto_adquirido, ':OFERTA_ID' => $this->oferta_id, 
        ':PRAZO_REEMBOLSO' => $this->prazo_reembolso, ':CUPOM_ID' => $this->cupom_id, ':QUANTIDADE' => $this->quantidade, 
        ':PRECO_UNIDADE_OFERTA' => $this->preco_unidade_oferta, ':MEMBRO_ID' => $this->membro_id, 
        ':MEMBRO_CLASSE_ID' => $this->membro_classe_id, ':DIAS_ACESSO_MEMBROS' => $this->dias_acesso_membros
      ];

      $this->db->non_query($sql, $args, $commit);
      $this->id = $this->db->get_last_id();

      return $this->db->get_rows(true) > 0;
    }

  }