<html>
  <head>
    <title><?= $pdf?></title>

    <style>
      #pdf-viewer {
        background: rgba(0, 0, 0, 0.1);
        overflow: auto;
      }
      
      .pdf-page-canvas {
        display: block;
        margin: 5px auto;
        border: 1px solid rgba(0, 0, 0, 0.2);
      }
    </style>
    
    <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/pdf.min.js"></script>
    <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/pdf.worker.min.js"></script>
  </head>
  <body oncontextmenu='return false'>

    <?php if (isset($guard)) : ?>
      <input type="hidden" class="valid" id="pdf" value="<?=$pdf ?>">
      <input type="hidden" class="valid" id="<?= $guard->getTokenNameKey() ?>" value="<?= $guard->getTokenName() ?>">
      <input type="hidden" class="valid" id="<?= $guard->getTokenValueKey() ?>" value="<?= $guard->getTokenValue() ?>">
    <?php endif; ?>

    <div id="pdf-viewer"></div>

    <script src="<?= $_ENV['BASE_PATH'] ?>/js/app/leitor.js"></script>
  </body>
</html>