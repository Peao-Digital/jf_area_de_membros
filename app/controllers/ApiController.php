<?php

  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  use app\database\PDOConnection;
  use app\models\{Cliente, Item, TransacaoItem};

  class ApiController {
    private $erro_msg = null;
    private $token = null;
    private $token_tipo = null;
    private $data_inicial = null;
    private $data_final = null;
    private $temp_clientes = [];
    private $temp_itens = [];
    
    private $url_autenticacao = 'https://api.app.doppus.com/3.0/auth/';
    private $url_dados = 'https://api.app.doppus.com/3.0/sales/';

    public function __invoke(Request $request, Response $response, $args = []) {
      //Caso um periodo de datas não tenham sido informadas, utilizar o dia atual
      $this->data_inicial = $request->getQueryParams()['data_inicial']??date('Y-m-d');
      $this->data_final = $request->getQueryParams()['data_final']??date('Y-m-d');

      if ($this->buscar_token()) {
        if ($this->executar_coleta()) {
          $response->getBody()->write("Coleta finalizada!");
          return $response;
        } else {
          $response->getBody()->write("Um ou mais erros aconteceram durante a coleta!<br>" . $this->erro_msg);
          return $response->withStatus(500);
        }
      } else {
        $response->getBody()->write("Acesso não autorizado na API!");
        return $response->withStatus(401);
      }
    }

    private function conveter_para_json($response) {
      try {
        return json_decode($response);
      } catch(Exception $e) {
        print_r('Erro ao descodificar o json!');
        return null;
      }
    }

    private function buscar_token() {
      $vars = 'grant_type=client_credentials';
      $auth = base64_encode($_ENV['API_CLIENT_ID'] . ':' . $_ENV['API_CLIENT_SECRET']);
      $headers = [
        'Authorization: Basic ' . $auth,
        'Content-Type: application/x-www-form-urlencoded'
      ];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->url_autenticacao);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $response = curl_exec($ch);
      curl_close($ch);

      $json = $this->conveter_para_json($response);
      if (!is_null($json)) {
        if($json->success) {
          $this->token = $json->data->token;
          $this->token_tipo = $json->data->token_type;
        }
      }

      return !empty($this->token);
    }

    private function buscar_dados_api($pagina) {
      $headers = [
        'Authorization: Bearer ' . $this->token,
        'Content-Type: application/json'
      ];
      
      /** 
       * Status 4 (Buscando apenas as transações com pagamento concluido)
      **/
      $vars = [
        'registration_date_start' => $this->data_inicial, 'registration_date_end' => $this->data_final, 
        'page' => $pagina, 'status' => 5
      ];
      $url = $this->url_dados . '?' . http_build_query($vars);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $response = curl_exec($ch);
      curl_close($ch);

      return $this->conveter_para_json($response);
    }

    private function executar_coleta() {
      $db = new PDOConnection($_ENV);
      $pagina = 1;
      $ok = false;

      try{
        while (true) {
          $json = $this->buscar_dados_api($pagina);
          if (empty($json)) {
            break;
          }

          if(!$json->success) {
            $this->erro_msg = json_encode($json);
            break;
          }
          
          if (empty($json->data)) {
            break;
          }

          $ok = $this->salvar($db, $json);
          $pagina++;

        }

        if($db->in_transaction) {
          if ($ok) {
            $db->commit();
          } else{
            $db->rollback();
          }
        }

        return $ok;
      } catch(Exception $ex) {
        $this->erro_msg = $ex->getMessage();
        return false;
      }
    }

    private function salvar($db, $json) {
      $ok = true;
      foreach($json->data as $dado) {

        /** 
         * Gravando o cliente (inserindo ou atualizando as suas informações)
         * Será gravado no array temp_clientes para evitar repetir esta mesma ação durante esta execução
        **/
        if(!isset($this->temp_clientes[$dado->customer->doc])) {
          $clienteObj = new Cliente($db, $dado);
          if(!$clienteObj->salvar(false)) {
            $this->erro_msg = 'Erro ao salvar o cliente!<br>Cliente: ' . $clienteObj->documento;
            $ok = false;
            break;
          }
          $this->temp_clientes[$dado->customer->doc] = $clienteObj->id;
        }
        $cliente_id = $this->temp_clientes[$dado->customer->doc];
        
        foreach($dado->items as $item) {

          /** 
           * Gravando o item (inserindo ou atualizando as suas informações)
           * Será gravado no array temp_itens para evitar repetir esta mesma ação durante esta execução
          **/
          if(!isset($this->temp_itens[$item->code])) {
            $itemObj = new Item($db, $item);
            if(!$itemObj->salvar(false)) {
              $this->erro_msg = 'Erro ao salvar o item!<br>Item: ' . $itemObj->codigo_item;
              $ok = false;
              break;
            }
            $this->temp_itens[$item->code] = $itemObj->id;
          }
          $item_id = $this->temp_itens[$item->code];

          /* Gravando a relação entre Item, Cliente e transação (caso não exista) */
          $transacaoObj = new TransacaoItem($db);
          $transacaoObj->item_id = $item_id;
          $transacaoObj->cliente_id = $cliente_id;
          $transacaoObj->quantidade = $item->amount;
          $transacaoObj->data_transacao = $dado->registration_date;
          $transacaoObj->codigo_transacao = $dado->transaction_code;
          
          if(!$transacaoObj->salvar(false)) {
            $this->erro_msg = 'Erro ao salvar o vinculo de item com cliente!<br>Vinculo: Item ' . $item->code . " Cliente " . $dado->customer->doc;
            $ok = false;
            break;
          }
        }

      }

      return $ok;
    }

  }
