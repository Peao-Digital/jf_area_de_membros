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

    public function consultar(Request $request, Response $response)  {
      $db = new PDOConnection($_ENV);
      $cliente = isset($request->getQueryParams()['cliente'])? $request->getQueryParams()['cliente']:null;
      
      $sql = 
        "WITH liberados AS (
          SELECT DISTINCT item.produto_id
          FROM ticto_cliente cliente
          INNER JOIN ticto_cliente_ordem cli_ordem on (cli_ordem.cliente_id = cliente.id)
          INNER JOIN ticto_ordem ordem on (ordem.id = cli_ordem.ordem_id)
            INNER JOIN ticto_item item on (item.ordem_id = ordem.id)
          WHERE (cliente.cpf = :CLIENTE OR cliente.cnpj = :CLIENTE)
        )
        SELECT DISTINCT item.produto_id, item.nome_produto, item.nome_produto_adquirido,
          (CASE WHEN liberados.produto_id IS NULL THEN 'N' ELSE 'S' END) liberado
        FROM ticto_item item
        LEFT JOIN liberados on (liberados.produto_id = item.produto_id)
        ORDER BY 1";
      $dados = $db->query($sql, [':CLIENTE' => $cliente]);

      $response->getBody()->write(json_encode($dados));
      return $response
        ->withHeader('content-type', 'application/json');
    }
  }