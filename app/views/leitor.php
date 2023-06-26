<html>

<head>
  <title><?= $pdf ?></title>

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/leitor.css?v=<?= time() ?>">

  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/jquery.min.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/app/template.js?v=<?= time() ?>"></script>

</head>
<body oncontextmenu='return false'>

  <iframe id="pdf_viewer" onload="desmascarar()" 
    src="https://docs.google.com/gview?embedded=true&url=https://acesso.seucaminhodariqueza.com.br/pdf/<?=$pdf?>" 
    allowfullscreen="true" webkitallowfullscreen="true"></iframe>

  <div id="pdf-viewer">
    <button class="btn btn-back" id="BackButton">Voltar</button>
  </div>

</body>
</html>