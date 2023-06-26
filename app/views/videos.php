<?php $this->layout('template', ['title' => 'Vídeos']) ?>

<link rel=" stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/produtos.css?v=<?= time() ?>">


<div class="row-videos">

  <div class="logo-img mt-4 mb-4">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_riqueza.png">
  </div>

  <div class="videos">

    <div class="mb-4">
      <h5 id="aviso_video">ACESSO LIBERADO! Para acessar seus produtos escolha entre as opções ABAIXO:</h5>
    </div>

    <div id="embed-video">

    </div>
  </div>

  <div class="divVoltar">
    <button class="btn closeButton" id="voltarBtn">Voltar</button>
  </div>

  <div class="mt-4 mb-4 logo-empresa">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_jf.png">
  </div>

</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/videos.js?v=<?= time() ?>"></script>