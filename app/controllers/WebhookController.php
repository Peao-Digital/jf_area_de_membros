<?php

  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  use app\database\PDOConnection;
  use app\models\{Cliente, Item, TransacaoItem, Log};

  class WebhookController {
    private $log = null;

    public function __invoke(Request $request, Response $response, $args = []) {
      $this->log = new Log();
      $json = $this->get_json();

      if ($json != null) {
        if($this->salvar_dados($json[0])) {
          return $response;
        }
      }

      return $response->withStatus(400);
    }

    private function get_json() {
      $filePath = 'php://input';
      
      try {
        $dataString = file_get_contents($filePath);
        $jsonData = str_replace([",}", ", }"],['}','}'],trim(preg_replace('/\s\s+/', ' ', $dataString))) ;
        $jsonObj  = json_decode($jsonData, true);

        if (is_null($jsonObj)) {
          $this->log->descricao = 'Erro ao descodificar o json.';
          $this->log->erro = $jsonData;
          $this->log->salvar();
        }
        
        return $jsonObj;
      } catch (Exception $e) {
        return null;
      }
    }

    private function salvar_dados($json) {
      $db = new PDOConnection($_ENV);

      $ok = true;
      /** 
       * Gravando o cliente (inserindo ou atualizando as suas informações)
       * Será gravado no array temp_clientes para evitar repetir esta mesma ação durante esta execução
      **/
      if(!isset($this->temp_clientes[$json['customer']['doc']])) {
        $clienteObj = new Cliente($db, $json);
        if(!$clienteObj->salvar(false)) {
          $this->log->descricao = 'Erro ao salvar o cliente! Cliente: ' . $clienteObj->documento;
          $this->log->erro =  $clienteObj->db->get_error();
          $this->log->salvar();
          $ok = false;
        }
        $this->temp_clientes[$json['customer']['doc']] = $clienteObj->id;
      }
      $cliente_id = $this->temp_clientes[$json['customer']['doc']];
      
      foreach($json['items'] as $item) {
//
      //  /** 
      //   * Gravando o item (inserindo ou atualizando as suas informações)
      //   * Será gravado no array temp_itens para evitar repetir esta mesma ação durante esta execução
      //  **/
        if(!isset($this->temp_itens[$item['code']])) {
          $itemObj = new Item($db, $item);
          if(!$itemObj->salvar(false)) {
            $this->log->descricao = 'Erro ao salvar o item! Item: ' . $itemObj->codigo_item;
            $this->log->erro = $itemObj->db->get_error();
            $this->log->salvar();
            $ok = false;
          }
          $this->temp_itens[$item['code']] = $itemObj->id;
        }
        $item_id = $this->temp_itens[$item['code']];

        /* Gravando a relação entre Item, Cliente e transação (caso não exista) */
        $transacaoObj = new TransacaoItem($db);
        $transacaoObj->item_id = $item_id;
        $transacaoObj->cliente_id = $cliente_id;
        $transacaoObj->quantidade = $item['amount']??null;
        $transacaoObj->data_transacao = $json['registration_date']??null;
        $transacaoObj->codigo_transacao = $json['transaction_code']??null;
        $transacaoObj->codigo_plano_vendas = $json['sales_plan_code']??null;
        $transacaoObj->codigo_plano_vendas_desc = $json['sales_plan_name']??null;
        $transacaoObj->liberado = in_array($json['status'], ['APPROVED', 'COMPLETED'])? 'S':'N';
        
        if(!$transacaoObj->salvar(false)) {
          $this->log->descricao = 'Erro ao salvar o vinculo de item com cliente!<br>Vinculo: Item ' . $item['code'] . " Cliente " . $json['customer']['doc'];
          $this->log->erro =  $transacaoObj->db->get_error();
          $this->log->salvar();
          $ok = false;
        }
      }

      if($ok) {
        print_r('Coleta finalizada!');
        $db->commit();
      }

      return $ok;
    }
  }