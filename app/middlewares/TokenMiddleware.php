<?php

  namespace app\middlewares;
  use Psr\Http\Message\ResponseInterface;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
  use Slim\Psr7\Response as Response;

  class TokenMiddleware {
    public function __invoke(Request $request, RequestHandler $handler): Response {
      $token = $request->getHeader("Authorization");

      $teste = empty($token)? null: $token[0];
      $token = empty($token)? null: str_replace(['Token ', 'Bearer '], ['',''], $token[0]);

      $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
      $txt = $teste;
      fwrite($myfile, $txt);
      fclose($myfile);
      
      if(!in_array($token, $_ENV['TOKENS_TICTO'])) {
        $response = new Response();
        return $response->withStatus(403);
      }

      $response = $handler->handle($request);
      return $response;
    }
  }