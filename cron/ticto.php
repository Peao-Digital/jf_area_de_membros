<?php

  #Executar o script apenas via cmd
  if (PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) {
    die('cli only');
  }

  