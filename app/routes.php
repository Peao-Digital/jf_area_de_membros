<?php
  use Slim\App;
  use app\middlewares\{CsrfMiddleware, TokenMiddleware};
  use app\controllers\{HomeController, ProdutoController, WebhookController, LeitorPdfController};

  return function(App $app) use ($guard) {
    $app->get('/', function($request, $response, $args) use ($app, $guard) {
      return (new HomeController)->index($request, $response, $guard);
    });

    $app->get('/video', function($request, $response, $args) use ($app) {
      return (new ProdutoController)->redirecionar_videos($request, $response);
    });

    $app->get('/produtos', function($request, $response, $args) use ($app, $guard) {
      return (new ProdutoController)->index($request, $response, $guard);
    })->add(new CsrfMiddleware($guard));

    $app->get('/verificar_cliente', function($request, $response, $args) use ($app, $guard) {
      return (new ProdutoController)->verificar_cliente($request, $response, $guard);
    })->add(new CsrfMiddleware($guard));

    $app->get('/produtos/consultar', function($request, $response, $args) use ($app) {
      return (new ProdutoController)->consultar($request, $response);
    })->add(new CsrfMiddleware($guard));

    $app->any('/webhook', WebhookController::class);
    //->add(new TokenMiddleware())

    $app->any('/leitor', function($request, $response, $args) use ($app, $guard) {
      return (new LeitorPdfController)->index($request, $response);
    })->add(new CsrfMiddleware($guard));
  };