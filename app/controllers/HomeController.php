<?php

  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class HomeController {
    public function index($request, $response, $_guard) {
      load_view('index', $data = [], $_guard);
      return $response;
    }
  }