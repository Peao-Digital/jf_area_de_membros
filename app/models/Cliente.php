<?php
  namespace app\models;

  class Cliente extends ModeloGenerico {
    public $id = null;
    public $documento = null;
    public $tipo_documento = null;
    public $nome = null;
    public $telefone = null;

    public $endereco = null;
    public $endereco_numero = null;
    public $bairro = null;
    public $cidade = null;
    public $estado = null;
    public $cep = null;

    protected function alimentar_modelo_json($obj) {
      if(isset($obj['customer']['phone'])) {
        $this->telefone = $obj['customer']['phone'];
      } else if(isset($obj['customer']['cellphone'])) {
        $this->telefone = $obj['customer']['cellphone'];
      }
      
      $this->nome            = $obj['customer']['name'];
      $this->documento       = $obj['customer']['doc'];
      $this->tipo_documento  = $obj['customer']['doc_type'];

      $this->cep             = $obj['address']['zipcode']??null;
      $this->endereco        = $obj['address']['address']??null;
      $this->endereco_numero = $obj['address']['number']??null;
      $this->bairro          = $obj['address']['neighborhood']??null;
      $this->cidade          = $obj['address']['city']??null;
      $this->estado          = $obj['address']['state']??null;
    }

    private function existe() {
      $cliente = new Cliente();
      $sql = "SELECT id FROM api_cliente WHERE documento = :DOCUMENTO";
      $busca = $cliente->db->query($sql, [':DOCUMENTO' => $this->documento]);
      
      if (!empty($busca)) {
        $this->id = $busca[0]['id'];
      }
    }

    public function salvar($commit = true) {
      $this->existe();
      $args = [
        ':NOME' => $this->nome, ':TELEFONE' => $this->telefone,
        ':CEP' => $this->cep, ':ENDERECO' => $this->endereco,
        ':END_NUMERO' => $this->endereco_numero, ':BAIRRO' => $this->bairro,
        ':CIDADE' => $this->cidade, ':ESTADO' => $this->estado,
      ];

      if ($this->id == null) {
        $sql = 
          "INSERT INTO api_cliente (nome, documento, tipo_documento, telefone, cep,
            endereco, endereco_numero, bairro, cidade, estado) 
          VALUES (:NOME, :DOCUMENTO, :TIPO_DOCUMENTO, :TELEFONE, :CEP, :ENDERECO, :END_NUMERO,
          :BAIRRO, :CIDADE, :ESTADO)";

        $args[':DOCUMENTO'] = $this->documento;
        $args[':TIPO_DOCUMENTO'] = $this->tipo_documento;
      } else {
        $sql = "UPDATE api_cliente SET nome = :NOME, telefone = :TELEFONE, cep = :CEP,
          endereco = :ENDERECO, endereco_numero = :END_NUMERO, bairro = :BAIRRO,
          cidade = :CIDADE, estado = :ESTADO
        WHERE id = :ID";
        $args[':ID'] = $this->id;
      }

      $this->db->non_query($sql, $args, $commit);
      $this->id = $this->id??$this->db->get_last_id();

      return $this->db->get_rows(true) == 1;
    }

  }