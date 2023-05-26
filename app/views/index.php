<?php $this->layout('template', ['title' => 'Home', 'guard' => isset($guard)? $guard:null]) ?>

PAGINA INICIAL

<?php print_r($_SERVER); ?>

<script src="/js/app/index.js"></script>