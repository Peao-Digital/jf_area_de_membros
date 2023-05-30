<?php

  namespace app\controllers;

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;

  use app\database\PDOConnection;
  use app\models\{Ordem, Cliente, Item, Log};

  class WebHookController {
    private $log = null;

    public function __invoke(Request $request, Response $response, $args = []) {
      $db = new PDOConnection($_ENV);
      $this->log = new Log();

      $json = $this->get_json();
      if ($json != null) {
        if(in_array($json['token']??null, $_ENV['TOKENS_TICTO'])) {
          $this->salvar_dados($db, $json);
        } else {
          $this->log->descricao = 'Token não encontrado!';
          $this->log->erro = json_encode($json);
          $this->log->salvar();
        }
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
          $this->log->descricao = 'Erro ao descodificar o json.';
          $this->log->erro = $jsonData;
          $this->log->salvar();
        }
        
        return $jsonObj;
      } catch (Exception $e) {
        $this->log->descricao = 'Erro ao descodificar o json.';
        $this->log->erro = $e->getMessage();
        $this->log->salvar();

        return null;
      }
    }

    private function salvar_dados($db, $json) {
      try{
        $ordem = new Ordem($db, $json);
        /* Conferindo se a esta ordem ja foi gravada (hash e data-horario) */

        if($ordem->existe()) {
          $this->log->descricao = 'Ordem possivelmente repetida!';
          $this->log->erro = json_encode($json['order']);
          $this->log->salvar();
          return true;
        }

        /* Gravando a ordem */
        if(!$ordem->salvar(false)) {
          $this->log->descricao = 'Erro ao gravar a ordem!';
          $this->log->erro = json_encode($json['order'] . $ordem->db->get_error());
          $this->log->salvar();

          $db->rollback();
          return false;
        }

        
        /* Gravando (atualizando) o cliente */
        $cliente = new Cliente($db, $json['customer']);
        $cliente->ordem_id = $ordem->id;
        if(!$cliente->salvar(false)) {
          $this->log->descricao = 'Erro ao gravar o cliente!';
          $this->log->erro = json_encode($json['customer'] . $cliente->db->get_error());
          $this->log->salvar();

          $db->rollback();
          return false;
        }
        
        /* Gravando o item */
        $item = new Item($db, $json['item']);
        $item->ordem_id = $ordem->id;
        if(!$item->salvar(false)) {
          $this->log->descricao = 'Erro ao gravar o item!';
          $this->log->erro = json_encode($json['item'] . $item->db->get_error());
          $this->log->salvar();

          $db->rollback();
          return false;
        }
        
        $db->commit();
        return true;
      } catch(Exception $e) {
        $this->log->descricao = 'Erro ao gravar os dados!';
        $this->log->erro = $e->getMessage();
        $this->log->salvar();
        
        $db->rollback();
        return false;
      } 
    }
  }
