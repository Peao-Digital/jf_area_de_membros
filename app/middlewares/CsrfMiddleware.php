<?php

  namespace app\middlewares;
  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
  use Slim\Psr7\Response as R;

  class CsrfMiddleware {
    private $guard = null;
    public function __construct($guard) {
      $this->guard = $guard;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response {
      $response = $handler->handle($request);

      $method = $request->getMethod() == 'GET'? $request->getQueryParams(): $request->getParsedBody();

      $name = isset($method[$this->guard->getTokenNameKey()])? $method[$this->guard->getTokenNameKey()]: null;
      $value = isset($method[$this->guard->getTokenValueKey()])? $method[$this->guard->getTokenValueKey()]: null;
      $value = str_replace(' ', '+', $value);

      $json_erro = json_encode(['erro' => 'Acesso inválido!']);

      if($name == null) {
        if ($request->getMethod() == 'GET') {
          return $response->withHeader('Location', $_ENV['BASE_PATH'] . '/?redirected=1')->withStatus(302);
        } else {          
          $response->getBody()->write(json_encode($json_erro));
          return $response->withHeader('content-type', 'application/json');
        }

        return $response;
      }

      if( !$this->guard->validateToken($name, $value) ) {
        if ($request->getMethod() == 'GET') {
          return $response->withHeader('Location', '/?redirected=1')->withStatus(302);
        } else {          
          $response->getBody()->write(json_encode($json_erro));
          return $response->withHeader('content-type', 'application/json');
        }
      }
      return $response;
    }
  }