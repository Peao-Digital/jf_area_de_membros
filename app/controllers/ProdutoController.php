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
        "WITH liberados AS (
          SELECT t_item.item_id, t_item.liberado
          FROM api_transacao_item t_item
          LEFT JOIN api_cliente cliente on (cliente.id = t_item.cliente_id)
          WHERE REGEXP_REPLACE(cliente.documento, '[/.-]+', '') = REGEXP_REPLACE(:CLIENTE, '[/.-]+', '')
        )
        SELECT item.codigo_item produto_id, item.nome nome_produto, item.descricao, item.imagem,
         (CASE WHEN liberados.item_id is not null THEN liberados.liberado ELSE 'N' END) liberado
        FROM api_item item
        LEFT JOIN liberados on (liberados.item_id = item.id)
        ORDER BY 1";

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