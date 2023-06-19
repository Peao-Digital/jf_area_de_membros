<html>

<head>
  <title><?= $pdf ?></title>

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/leitor.css?v=<?= time() ?>">

  <script src=" <?= $_ENV['BASE_PATH'] ?>/js/lib/jquery.min.js"></script>

</head>
<body oncontextmenu='return false'>

  <iframe id="pdf_viewer" onload="removerDownload()" 
    src="https://docs.google.com/gview?embedded=true&url=https://acesso.seumapadariqueza.com.br/pdf/<?=$pdf?>" 
    allowfullscreen="true" webkitallowfullscreen="true"></iframe>

  <div id="pdf-viewer">
    <button onclick="goBack()" class="btn btn-back">Voltar</button>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }

    function removerDownload() {
      //$("#pdf_viewer").contents().find("#download").hide();
    }
    
  </script>
</body>

</html>