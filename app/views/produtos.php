<?php $this->layout('template', ['title' => 'Produtos', 'guard' => isset($guard) ? $guard : null]) ?>

<div class="row-products">

  <div class="logo-img mt-4 mb-4">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_mapa.png">
  </div>

  <div class="products mt-4" id="products">
  </div>

</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/produtos.js"></script>