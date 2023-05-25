<?php
  
  #Executar o script apenas via cmd
  if (PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) {
    die('cli only');
  }

  /*
    Matar todas as sessões
  */
  $files = scandir(session_save_path(), GLOB_BRACE);
  foreach($files as $file) {
    if ($file == '.' || $file == '..') {
      continue;
    }

    unlink(session_save_path() . DIRECTORY_SEPARATOR . $file);
  }