<?php
  use Slim\App;
  use app\controllers\HomeController;
  use app\controllers\CursoController;

  return function(App $app) {
    $app->get('/', [HomeController::class, 'index']);
    $app->get('/cursos', [CursoController::class, 'index']);
  };