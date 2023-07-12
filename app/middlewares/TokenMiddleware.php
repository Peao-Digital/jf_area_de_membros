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
      $auth = '';
      if (isset($headers['Authorization'])) {
        $auth = is_array($headers['Authorization'])? $headers['Authorization'][0]: $headers['Authorization'];
      } else if(isset($headers['Doppus-token'])) {
        $auth = is_array($headers['Doppus-token'])? $headers['Doppus-token'][0]: $headers['Doppus-token'];
      }

      $token = str_replace(['Token', 'Bearer', ''], '', $auth);

      if(in_array($token, $_ENV['WEBHOOK_TOKEN'])) {
        $response = $handler->handle($request);
        return $response;
      }

      $log = new Log();
      $log->descricao = 'Acesso não autorizado ao WebHook!';
      $log->erro = 'Token da requisição: ' . $token . ' |' . json_encode($headers);
      $log->salvar();
      
      $response = new Response();
      $response->getBody()->write("Acesso não autorizado!");
      return $response->withStatus(401);
    }
    
  }