<?php
  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class LeitorPdfController {

    /** 
     * Caso o usuário tenta acessar a requisição via GET, será redirecionado para a página inicial
     * Via POST irá trazer a página de visualização do PDF
     */
    public function index(Request $request, Response $response) {
      $pdf_selecionado = $request->getParsedBody()['pdf']??null;
      if($request->getMethod() == 'GET' || $pdf_selecionado == null) {
        return $response->withHeader('Location', $_ENV['BASE_PATH'] . '/?redirected=1')->withStatus(302);
      } else {
        $this->visualizar($pdf_selecionado);
        return $response;
      }
    }

    /** 
     * Página do viewer
     */
    private function visualizar($pdf) {
      if(file_exists(PDF . $pdf)) {
        load_view('leitor', ['pdf' => $pdf]);
      } else {
        load_view('pdf_nao_encontrado');
      }
    }

  }