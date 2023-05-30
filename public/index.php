<?php
  require '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';

  use Slim\Factory\AppFactory;
  use Slim\Psr7\Factory\ResponseFactory;
  use Slim\Csrf\Guard;

  header('Content-Type: text/html; charset=UTF-8');
  ini_set('session.gc_maxlifetime', 86400);
  session_set_cookie_params(86400);

  session_start();
  
  $app = AppFactory::create();
  
  if($_ENV['BASE_PATH'] != "") {
    $app->setBasePath($_ENV['BASE_PATH']);
  }

  $app->addRoutingMiddleware();
  if($_ENV['DEBUG']) {
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
  }

  /* Criando a validação por token CSRF */
  $responseFactory = new ResponseFactory();
  $guard = new Guard($responseFactory);
  $csrfNameKey = $guard->getTokenNameKey();
  $csrfValueKey = $guard->getTokenValueKey();
  $keyPair = $guard->generateToken();

  //Adicionando as rotas
  $routes = require ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'routes.php';
  $routes($app);

  $app->run();
