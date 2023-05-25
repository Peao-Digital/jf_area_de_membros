<?php
  require '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';

  use Slim\Factory\AppFactory;

  header('Content-Type: text/html; charset=UTF-8');
  ini_set('session.gc_maxlifetime', 360000);
  session_set_cookie_params(360000);

  $app = AppFactory::create();
  $app->addRoutingMiddleware();
  $errorMiddleware = $app->addErrorMiddleware(true, true, true);

  $routes = require ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'routes.php';
  $routes($app);

  $app->run();