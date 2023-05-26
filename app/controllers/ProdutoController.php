<?php
  
  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class ProdutoController {
    public function index(Request $request, Response $response, $guard) {
      load_view('produtos', [], $guard);
      return $response;
    }

    public function consultar(Request $request, Response $response)  {
      $dados = [];
      $busca = isset($request->getQueryParams()['cliente'])? $request->getQueryParams()['cliente']:null;

      //buscar dados no banco

      $response->getBody()->write(json_encode($dados));
      return $response
        ->withHeader('content-type', 'application/json');
    }
  }