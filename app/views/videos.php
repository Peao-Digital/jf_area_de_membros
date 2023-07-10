<?php $this->layout('template', ['title' => 'Vídeos']) ?>

<link rel=" stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/produtos.css?v=<?= time() ?>">

<div class="row-video-products products-container text-center">

  <div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">Essa aula está inclusa dentro do ebook "Caminho da Riqueza"! Aproveite e faça a leitura do e-book após assistir, para complementar seu conhecimento sobre essa aula e tirar suas dúvidas!</div>
  </div>

  <div class="logo-img mt-4">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_riqueza.png">
  </div>

  <div class="mb-4">
    <h6 id="aviso_video" class="title_acesso">ACESSO LIBERADO! Para acessar seus produtos escolha entre as opções ABAIXO:</h6>
  </div>

  <div id="embed-video"></div>

  <div class="divVoltar">
    <button class="btn ButtoncloseVideos" id="voltarBtn">Voltar</button>
  </div>

  <div class="logo-empresa">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_jf.png">
  </div>

</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/videos.js?v=<?= time() ?>"></script>