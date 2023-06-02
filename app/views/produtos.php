<?php $this->layout('template', ['title' => 'Produtos', 'guard' => isset($guard) ? $guard : null]) ?>

<div class="row">
  <div class="center mt-5">
    <img class="img-logo" src="<?= $_ENV['BASE_PATH'] ?>/img/Logo.png">
  </div>
  <div class="col-12">
    <div class="card card-produto">
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <img class="img-logo" src="<?= $_ENV['BASE_PATH'] ?>/img/Logo.png">
          </div>
          <div class="col-6">
            <h4>LOREM IPSUM BLA BLA BLA</h4>
          </div>
          <div class="col-2 right">
            <button class="btn btn-success">ACESSAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/produtos.js"></script>