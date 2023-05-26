<?php

  use Psr\Http\Message\ResponseInterface as Response;

  function load_view(string $view, array $data = [], $guard = null) {
    $path = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR .'views';
    $templates = new League\Plates\Engine($path);

    if ($guard != null) {
      $data['guard'] = $guard;
    }

    echo $templates->render($view, $data);
  }