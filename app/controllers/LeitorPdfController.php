<?php
  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class LeitorPdfController {

    /** 
     * Caso o usuário tenta acessar a requisição via GET, será redirecionado para a página inicial
     * Via POST irá trazer a página de visualização do PDF
     */
    public function index(Request $request, Response $response, $guard) {
      $pdf_selecionado = $request->getParsedBody()['pdf']??null;
      if($request->getMethod() == 'GET' || $pdf_selecionado == null) {
        return $response->withHeader('Location', $_ENV['BASE_PATH'] . '/?redirected=1')->withStatus(302);
      } else {
        $this->visualizar($pdf_selecionado, $guard);
        return $response;
      }
    }

    /** 
     * Página do viewer
     */
    private function visualizar($pdf, $guard) {
      if(file_exists(PDF . $pdf)) {
        load_view('leitor', ['pdf' => $pdf], $guard);
      } else {
        load_view('pdf_nao_encontrado');
      }
    }

    /**
     * Função para exibir o pdf selecionado (acesso direto a public/pdf é proibido)
     */
    public function arquivo(Request $request, Response $response) {
      $pdf = $request->getQueryParams()['pdf'];

      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="' . $pdf . '"');
      header('Content-Transfer-Encoding: binary');
      header('Accept-Ranges: bytes');
      @readfile(PDF . $pdf);

      return $response;
    }
  }