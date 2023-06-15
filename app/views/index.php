<?php $this->layout('template', ['title' => 'João Financeira', 'guard' => isset($guard) ? $guard : null]) ?>

<div class="row row-login">

  <div class="logo-img mt-4 mb-4">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_mapa.png">
  </div>

  <div class="account-title mt-4 mb-4">
    <h4>Acesse a sua conta</h4>
  </div>

  <div class="card card-login">
    <div class="card-body">

      <div class="subtitle mb-4">
        <p>PREENCHA SEUS DADOS</p>
      </div>

      <form id="formulario">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Digite aqui seu CPF ou CNPJ" id="cnpjf" />
          <div class="invalid-feedback">CPF ou CNPJ Inválido</div>
          <Button class="btn btn-acessar" type="submit">ACESSAR AGORA</Button>
        </div>
      </form>
    </div>
  </div>

  <div class="suporte mt-4">
    <a class="btn-suporte" href="https://api.whatsapp.com/send/?phone=5491025477&">
      <p class="suporte-duvidas">FICOU COM DÚVIDAS</p>
      <p class="suporte-clique">Clique aqui e fale com o suporte</p>
    </a>
  </div>

  <div class="mt-4 mb-4 logo-empresa">
    <img src="<?= $_ENV['BASE_PATH'] ?>/img/logo_jf.png">
  </div>
</div>

<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/validaCNPJF.js?v=<?= time() ?>"></script>
<script src="<?= $_ENV['BASE_PATH'] ?>/js/app/index.js?v=<?= time() ?>"></script>