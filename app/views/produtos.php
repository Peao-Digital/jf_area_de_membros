<?php $this->layout('template', ['title' => 'Produtos', 'guard' => isset($guard) ? $guard : null]) ?>

<link rel="stylesheet" type="text/css" href="<?= $_ENV['BASE_PATH'] ?>/css/produtos.css?v=<?= time() ?>">

<div class="row-products">

  <div class="logo-img mt-4 mb-4">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_mapa.png">
  </div>

  <div class="mt-4 mb-4" id="aviso">
    <h4>ACESSO LIBERADO! Para acessar seus produtos escolha entre as opções ABAIXO:</h4>
  </div>

  <div class="products mt-4" id="products">
  </div>

  <div class="modal" id="modal_products" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
      <div class="modal-content custom-modal">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
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


</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/produtos.js?v=<?= time() ?>"></script>
