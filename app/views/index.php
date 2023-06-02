<?php $this->layout('template', ['title' => 'Home', 'guard' => isset($guard) ? $guard : null]) ?>

<div class="row page">
  <div class="col-lg-12 title">
    <h1>Faça login para ter acesso ao Mapa da Riqueza</h1>
  </div>
  <div class="card card-login col-xs-10 col-sm-10 col-md-8 col-lg-6 col-xl-6">
    <div class="card-body">
      <img class="img-logo" src="<?= $_ENV['BASE_PATH'] ?>/img/Logo.png">
      <form id="formulario">
        <div class="form-group mb-4">
          <div class="radiocheck mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" value="cpfCheck" type="radio" name="cnpjfCheck" id="cpfCheck" checked>
              <label class="form-check-label" for="cpfCheck">CPF</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" value="cnpjCheck" type="radio" name="cnpjfCheck" id="cnpjCheck">
              <label class="form-check-label" for="cnpjCheck">CNPJ</label>
            </div>
          </div>

          <input type="text" class="form-control" placeholder="Informe o CPF" id="cnpjf" />
        </div>
        <Button class="btn btn-success acessar" type="submit">ACESSAR</Button>
      </form>
    </div>
  </div>
  <div class="col-lg-12 subtitle mt-2">
    <p>Está com dificuldade de acessar ? <a class="link" href="#">Clique aqui</a> e fale conosco.</p>
  </div>
</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/index.js"></script>