<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/template.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <title><?= $this->e($title) ?></title>
  </head>

  <body>
    
    <div id="container">
      <?= $this->section('content') ?>
    </div>

  </body>

</html>