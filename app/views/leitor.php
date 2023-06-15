<html>

<head>
  <title><?= $pdf ?></title>

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/leitor.css?v=<?= time() ?>">

  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/all.min.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/pdf.min.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/pdf.worker.min.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/bootstrap.min.js"></script>
</head>
<body oncontextmenu='return false'>

  <?php if (isset($guard)) : ?>
    <input type="hidden" class="valid" id="pdf" value="<?= $pdf ?>">
    <input type="hidden" class="valid" id="<?= $guard->getTokenNameKey() ?>" value="<?= $guard->getTokenName() ?>">
    <input type="hidden" class="valid" id="<?= $guard->getTokenValueKey() ?>" value="<?= $guard->getTokenValue() ?>">
  <?php endif; ?>

  <div id="pdf-viewer">
    <button onclick="goBack()" class="btn btn-back">Voltar</button>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/app/leitor.js?v=<?= time() ?>"></script>
</body>

</html>