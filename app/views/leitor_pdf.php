<?php
  
  $variaveis = http_build_query([
    'pdf' => $pdf,
    $guard->getTokenNameKey() => $guard->getTokenName(),
    $guard->getTokenValueKey() => $guard->getTokenValue()
  ]);

?>
<html>
  <head>
    <title><?= $pdf?></title>
    <style>
      html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
      }
    </style>
  </head>
  <body oncontextmenu='return false'>
    <object width="100%" height="100%" 
      type="application/pdf" 
      data="<?= $_ENV['BASE_PATH'] ?>/leitor/arquivo?<?= $variaveis ?>#toolbar=0" id="pdf">
      <p>Erro ao acessar o arquivo!</p>
    </object>

  </body>
</html>