<?php
  
  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class CursoController {
    public function index(Request $request, Response $response) {
      view('cursos');
      return $response;
    }
  }