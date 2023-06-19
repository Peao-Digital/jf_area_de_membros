<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/all.min.css">
  <link rel=" stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/template.css?v=<?= time() ?>">

  <script src=" <?= $_ENV['BASE_PATH'] ?>/js/lib/jquery.min.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/jquery.mask.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/bootstrap.min.js"></script>
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/lib/all.min.js"></script>

  <title><?= $this->e($title) ?></title>
</head>

<body>

  <section class="container" id="container">
    <?= $this->section('content') ?>
    <?php if (isset($guard)) : ?>
      <input type="hidden" class="valid" name="<?= $guard->getTokenNameKey() ?>" value="<?= $guard->getTokenName() ?>">
      <input type="hidden" class="valid" name="<?= $guard->getTokenValueKey() ?>" value="<?= $guard->getTokenValue() ?>">
    <?php endif; ?>

  </section>

  <!-- Mascara -->
  <div id="mascara"> </div>

  <!-- Modal de aviso -->
  <div class="modal fade" id="modal_aviso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Aviso</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>