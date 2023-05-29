<?php

  namespace app\models;

  class Ordem extends ModeloGenerico {
    public $id = null;
    public $data_ordem = null;
    public $data_horario = null;
    public $hash_ordem = null;
    public $valor = null;
    public $parcelas = null;
    public $metodo_pagamento = null;
    public $metodo_pagamento_desc = null;
    public $tipo_comissao = null;
    public $tipo_comissao_desc = null;

    private function gerar_descricoes() {
      $pagamentos = [
        'bank_slip' => 'Boleto Bancário',
        'pix' => 'Pix',
        'credit_card' => 'Cartão de Crédito'
      ];

      $comissoes = [
        'producer' => 'Produtor',
        'coproducer' => 'Coprodutor',
        'affiliate' => 'Afiliado',
        'manager'=> 'Gestor de Afiliados',
        'provider' => 'Fornecedor de produto físico'
      ];

      $this->metodo_pagamento_desc = $pagamentos[$this->metodo_pagamento]??null;
      $this->tipo_comissao_desc = $comissoes[$this->tipo_comissao]??null;
    }
    
    protected function alimentar_modelo_json($json) {
      $this->data_ordem       = explode(' ', $json['order']['order_date'])[0];
      $this->data_horario     = $json['order']['order_date'];
      $this->hash_ordem       = $json['order']['hash'];
      $this->valor            = $json['order']['paid_amount'];
      $this->parcelas         = $json['order']['installments'];
      $this->metodo_pagamento = $json['payment_method'];
      $this->tipo_comissao    = $json['commission_type'];

      $this->gerar_descricoes();
    }

    public function salvar($commit = true) {
      $sql = 
       "INSERT INTO ticto_ordem (data_ordem, data_horario, hash_ordem, valor, parcelas, metodo_pagamento, metodo_pagamento_desc, tipo_comissao, tipo_comissao_desc) 
        VALUES (:DATA_ORDEM, :DATA_HORARIO, :HASH_ORDEM, :VALOR, :PARCELAS, :METODO_PAGAMENTO, :METODO_PAGAMENTO_DESC, :TIPO_COMISSAO, :TIPO_COMISSAO_DESC)";

      $args = [
        ':DATA_ORDEM' => $this->data_ordem, ':DATA_HORARIO'     => $this->data_horario,
        ':HASH_ORDEM' => $this->hash_ordem, ':VALOR'            => $this->valor,
        ':PARCELAS'   => $this->parcelas,   ':METODO_PAGAMENTO' => $this->metodo_pagamento,
        ':METODO_PAGAMENTO_DESC' => $this->metodo_pagamento_desc,
        ':TIPO_COMISSAO' => $this->tipo_comissao, ':TIPO_COMISSAO_DESC' => $this->tipo_comissao_desc
      ];

      $this->db->non_query($sql, $args, $commit);
      $this->id = $this->db->get_last_id();

      return $this->db->get_rows(true) > 0;
    }

    public function existe() {
      $sql = "SELECT 1 FROM ticto_ordem where hash_ordem = :HASH_ORDEM AND data_ordem = :DATA";
      $rows = $this->db->query($sql, [':HASH_ORDEM' => $this->hash_ordem, ':DATA' => $this->data_ordem]);
      $this->db->clear_rows();
      return count($rows) > 0;
    }

  }