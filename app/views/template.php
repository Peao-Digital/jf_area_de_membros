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
  <script src="<?= $_ENV['BASE_PATH'] ?>/js/app/template.js?v=<?= time() ?>"></script>

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

  <a class="wpp_button" id="btn-wpp"><i class="fa-solid fa-question" style="color: #000000;"></i></a>

  <div class="div_flutuant oculto">
    <ul class="flutuant_ul">
      <li><a href="https://api.whatsapp.com/send/?phone=555491025477&text=Ol%C3%A1%21+N%C3%A3o+estou+conseguindo+acessar+a+plataforma&type=phone_number&app_absent=0">Não conseguiu acessar?</a></li><hr>
      <li><a href="https://api.whatsapp.com/send/?phone=555491025477&text=Ol%C3%A1%21+Tenho+produtos+bloqueados+na+plataforma+e+quero+desbloquear&type=phone_number&app_absent=0">Seu produto está bloqueado?</a></li><hr>
      <li><a href="https://api.whatsapp.com/send/?phone=555491025477&text=Ol%C3%A1%21+A+plataforma+tem+algum+erro+acontecendo...&type=phone_number&app_absent=0">Plataforma está com algum erro?</a></li><hr>
      <li><a href="https://api.whatsapp.com/send/?phone=555491025477&text=Ol%C3%A1%21+Eu+preciso+de+ajuda&type=phone_number&app_absent=0">Outro assunto?</a></li>
    </ul>
  </div>

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
          <button type="button" class="btn closeButton" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>