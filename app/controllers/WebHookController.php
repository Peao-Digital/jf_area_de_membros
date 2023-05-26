<?php

  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  class WebHookController {
    public function __invoke(Request $request, Response $response, $args = []) {
      
      $json = $this->get_json();
      if ($json != null) {
        $this->salvar($json);
      }
      
      return $response;
    }

    private function get_json() {
      $filePath = 'php://input';
      
      try {
        $dataString = file_get_contents($filePath);
        $jsonData = str_replace([",}", ", }"],['}','}'],trim(preg_replace('/\s\s+/', ' ', $dataString))) ;
        $jsonObj  = json_decode($jsonData, true);
      
        if (is_null($jsonObj)) {
          print_r('erro');
        }
        
        return $jsonObj;
      } catch (Exception $e) {
        echo '{"result":"FALSE","message":"Caught exception: ' . 
          $e->getMessage() . ' ~' . $filePath . '"}';

        return null;
      }
    }

    private function salvar($json) {
      
    }
  }