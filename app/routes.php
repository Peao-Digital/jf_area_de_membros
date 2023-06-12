<?php
  use Slim\App;
  use app\middlewares\CsrfMiddleware;
  use app\controllers\{HomeController, ProdutoController, ApiController, LeitorPdfController};

  return function(App $app) use ($guard) {
    $app->get('/', function($request, $response, $args) use ($app, $guard) {
      return (new HomeController)->index($request, $response, $guard);
    });

    $app->get('/produtos', function($request, $response, $args) use ($app, $guard) {
      return (new ProdutoController)->index($request, $response, $guard);
    })->add(new CsrfMiddleware($guard));

    $app->get('/produtos/consultar', function($request, $response, $args) use ($app) {
      return (new ProdutoController)->consultar($request, $response);
    })->add(new CsrfMiddleware($guard));

    $app->any('/api', ApiController::class);

    $app->post('/teste/autenticar', function($request, $response, $args) use ($app, $guard) {
      return (new TesteController)->autenticar($request, $response);
    });

    $app->any('/leitor', function($request, $response, $args) use ($app, $guard) {
      return (new LeitorPdfController)->index($request, $response, $guard);
    })->add(new CsrfMiddleware($guard));

    $app->get('/leitor/arquivo', function($request, $response, $args) use ($app) {
      return (new LeitorPdfController)->arquivo($request, $response);
    })->add(new CsrfMiddleware($guard));

  };