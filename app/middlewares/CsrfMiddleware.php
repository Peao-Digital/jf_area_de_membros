<?php

  namespace app\middlewares;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
  use Slim\Psr7\Response as Response;

  class CsrfMiddleware {
    private $guard = null;
    public function __construct($guard) {
      $this->guard = $guard;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response {
      
      $method = $request->getMethod() == 'GET'? $request->getQueryParams(): $request->getParsedBody();

      $name = isset($method[$this->guard->getTokenNameKey()])? $method[$this->guard->getTokenNameKey()]: null;
      $value = isset($method[$this->guard->getTokenValueKey()])? $method[$this->guard->getTokenValueKey()]: null;
      $value = $value == null? $value:str_replace(' ', '+', $value);

      $json_erro = json_encode(['erro' => 'Acesso inválido!']);

      if($name == null || $value == null) {
        $response = new Response();
        return $response->withHeader('Location', $_ENV['BASE_PATH'] . '/?redirected=1')->withStatus(302);
      }

      if( !$this->guard->validateToken($name, $value) ) {
        $response = new Response();
        return $response->withHeader('Location', $_ENV['BASE_PATH'] . '/?redirected=1')->withStatus(302);
      }

      $response = $handler->handle($request);
      return $response;
    }
  }