<?php
  namespace app\models;

  class Cliente extends ModeloGenerico {
    public $id = null;
    public $ordem_id = null;
    public $cpf = null;
    public $cnpj = null;
    public $tipo = null;
    public $nome = null;
    public $email = null;
    public $estrangeiro = null;

    public $ddd = null;
    public $ddi = null;
    public $telefone = null;

    public $endereco = null;
    public $endereco_numero = null;
    public $endereco_complemento = null;
    public $bairro = null;
    public $cidade = null;
    public $estado = null;
    public $cep = null;

    protected function alimentar_modelo_json($json) {
      $this->cpf = $json["cpf"];
      $this->cnpj = $json["cnpj"];
      $this->nome = $json["name"];
      $this->tipo = $json["type"];
      $this->email = $json["email"];
      $this->estrangeiro = $json["is_foreign"]? 'S':'N';

      $this->ddd = $json['phone']["ddd"];
      $this->ddi = $json['phone']["ddi"];
      $this->telefone = $json['phone']["number"];

      $this->endereco = $json['address']["street"];
      $this->endereco_numero = $json['address']["street_number"];
      $this->endereco_complemento = $json['address']["complement"];
      $this->bairro = $json['address']["neighborhood"];
      $this->cidade = $json['address']["city"];
      $this->estado = $json['address']["state"];
      $this->cep = $json['address']["zip_code"];
    }

    private function existe() {
      //Nova transação
      $obj = new Cliente();
      $sql = 
       "SELECT id FROM ticto_cliente 
        WHERE tipo = :TIPO 
          AND (cpf = :CPF OR cnpj = :CNPJ)";

      $args = [
        ':TIPO' => $this->tipo, ':CPF' => $this->cpf, ':CNPJ' => $this->cnpj
      ];

      $res = $obj->db->query($sql, $args);
      return empty($res)? null: $res[0]['id'];
    }

    private function cadastrar_atualizar_cliente($commit = true) {
      $this->id = $this->existe();
      $args = [
        ':NOME' => $this->nome, ':EMAIL' => $this->email, ':ESTRANGEIRO' => $this->estrangeiro, 
        ':DDD' => $this->ddd, ':DDI' => $this->ddi, ':TELEFONE' => $this->telefone,
        ':ENDERECO' => $this->endereco, ':ENDERECO_NUMERO' => $this->endereco_numero,
        ':ENDERECO_COMPLEMENTO' => $this->endereco_complemento, ':BAIRRO' => $this->bairro,
        ':CIDADE' => $this->cidade, ':ESTADO' => $this->estado, ':CEP' => $this->cep
      ];

      if($this->id == null) {
        $sql = 
          "INSERT INTO ticto_cliente (cpf, cnpj, nome, tipo, email, estrangeiro, ddd, ddi, telefone, endereco, 
           endereco_numero, endereco_complemento, bairro, cidade, estado, cep) 
           VALUES (:CPF, :CNPJ, :NOME, :TIPO, :EMAIL, :ESTRANGEIRO, :DDD, :DDI, :TELEFONE, :ENDERECO, 
           :ENDERECO_NUMERO, :ENDERECO_COMPLEMENTO, :BAIRRO, :CIDADE, :ESTADO, :CEP)";
        
        $args[':CPF'] = $this->cpf;
        $args[':CNPJ'] = $this->cnpj;
        $args[':TIPO'] = $this->tipo;
      } else {
        $sql = 
          "UPDATE ticto_cliente SET nome = :NOME, email = :EMAIL, estrangeiro = :ESTRANGEIRO,
             ddd = :DDD, ddi = :DDI, telefone = :TELEFONE, endereco = :ENDERECO, endereco_numero = :ENDERECO_NUMERO,
             endereco_complemento = :ENDERECO_COMPLEMENTO, bairro = :BAIRRO, cidade = :CIDADE, estado = :ESTADO, cep = :CEP
           WHERE ID = :ID";
        
        $args[':ID'] = $this->id;
      }

      $this->db->non_query($sql, $args, $commit);
      if ($this->id == null) {
        $this->id = $this->db->get_last_id();
      }
    }

    public function salvar($commit = true) {
      $this->cadastrar_atualizar_cliente(false);

      //Gravando vinculo de ordem e cliente
      $sql = 
        "INSERT INTO ticto_cliente_ordem (cliente_id, ordem_id) 
         VALUES (:CLIENTE_ID, :ORDEM_ID)";
        
      $args = [
        ':CLIENTE_ID' => $this->id, ':ORDEM_ID' => $this->ordem_id
      ];

      $this->db->non_query($sql, $args, $commit);
      return $this->db->get_rows(true) == 2;
    }

  }