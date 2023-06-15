<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/produtos.css?v=<?= time() ?>">
  <link rel=" stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/template.css?v=<?= time() ?>">
  <link rel=" stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/index.css?v=<?= time() ?>">

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

</body>

</html>