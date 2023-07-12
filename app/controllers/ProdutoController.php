<?php
  
  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  use app\database\PDOConnection;

  class ProdutoController {
    public function index(Request $request, Response $response, $guard) {
      load_view('produtos', [], $guard);
      return $response;
    }

    public function verificar_cliente(Request $request, Response $response) {
      $db = new PDOConnection($_ENV);
      $cliente = isset($request->getQueryParams()['cliente'])? $request->getQueryParams()['cliente']:null;
      
      $sql = 
        "SELECT DISTINCT 1
        FROM api_transacao_item t_item
        INNER JOIN api_cliente cli on (cli.id = t_item.cliente_id)
        WHERE REGEXP_REPLACE(cli.documento, '[/.-]+', '') = REGEXP_REPLACE(:CLIENTE, '[/.-]+', '')";
      $dados = $db->query($sql, [':CLIENTE' => $cliente]);
      
      $response->getBody()->write(json_encode($dados));
      return $response
        ->withHeader('content-type', 'application/json');
    }

    public function consultar(Request $request, Response $response)  {
      $db = new PDOConnection($_ENV);
      $cliente = isset($request->getQueryParams()['cliente'])? $request->getQueryParams()['cliente']:null;
      
      $sql = 
        "SELECT item.codigo_item
        FROM api_transacao_item t_item
        INNER JOIN api_item item on (item.id = t_item.item_id)
        INNER JOIN api_cliente cliente on (cliente.id = t_item.cliente_id)
        WHERE REGEXP_REPLACE(cliente.documento, '[/.-]+', '') = REGEXP_REPLACE(:CLIENTE, '[/.-]+', '')
          and t_item.liberado = 'S'";

      $dados = $db->query($sql, [':CLIENTE' => $cliente]);
      $response->getBody()->write(json_encode($dados));
      return $response
        ->withHeader('content-type', 'application/json');
    }

    public function redirecionar_videos(Request $request, Response $response){
      load_view('videos', []);
      return $response;
    }

  }