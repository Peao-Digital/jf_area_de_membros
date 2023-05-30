<?php
  use Slim\App;
  use app\middlewares\{CsrfMiddleware, TokenMiddleware};
  use app\controllers\HomeController;
  use app\controllers\ProdutoController;
  use app\controllers\WebHookController;

  return function(App $app) use ($guard) {
    $app->get('/', function($request, $response, $args) use ($app, $guard) {
      return (new HomeController)->index($request, $response, $guard);
    });

    $app->get('/produtos', function($request, $response, $args) use ($app, $guard) {
      return (new ProdutoController)->index($request, $response, $guard);
    })->add(new CsrfMiddleware($guard));

    $app->get('/produtos/consultar', function($request, $response, $args) use ($app, $guard) {
      return (new ProdutoController)->consultar($request, $response);
    })->add(new CsrfMiddleware($guard));

    $app->any('/webhook', WebHookController::class)->add(new TokenMiddleware());
  };