<?php

  namespace app\middlewares;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
  use Slim\Psr7\Response as Response;
  use app\models\{Log};

  class TokenMiddleware {

    public function __invoke(Request $request, RequestHandler $handler): Response {
      $headers = $request->getHeaders();

      $token = str_replace(
        ['Token', 'Bearer', ''], '', $headers['Authorization'][0]??''
      );

      if($token == $_ENV['WEBHOOK_TOKEN']) {
        $response = $handler->handle($request);
        return $response;
      }

      $log = new Log();
      $log->descricao = 'Acesso não autorizado ao WebHook!';
      $log->erro = 'Token da requisição: ' . $token;
      $log->salvar();

      $response = new Response();
      $response->getBody()->write("Acesso não autorizado!");
      return $response->withStatus(401);
    }
    
  }