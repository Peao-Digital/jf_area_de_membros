<?php

  require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

  use Psr\Http\Message\ResponseInterface as Response;
  use Psr\Http\Message\ServerRequestInterface as Request;
  use Slim\Factory\AppFactory;
  use Slim\Psr7\Factory\ResponseFactory;

  define('ROOT', __DIR__);
  define('PDF', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR);

  if(!file_exists(ROOT)){
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Um erro ocorreu, tente mais tarde!</h1>";
    echo "Arquivo de configuração não encontrado!";
    exit();
  }

  /* Inicializando a variavel $_ENV com as configurações do arquivo .env*/
  $dotenv = Dotenv\Dotenv::createImmutable(ROOT);
  $dotenv->load();

  if($_ENV['DEBUG']){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  }

  if(isset($_ENV['TOKENS_TICTO'])) {
    $_ENV['TOKENS_TICTO'] = explode(',', $_ENV['TOKENS_TICTO']);
  } else {
    $_ENV['TOKENS_TICTO'] = [];
  }
  