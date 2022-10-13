<?php
require "system/init.system.php";
?>
<?php if ( isset ($_SESSION['logged_user']) ) : ?>
<?php
include 'system/page/index.main.php';
?>
<?php else : ?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>notes.libn</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    

    <!-- Bootstrap core CSS -->
<link href="css/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/n_index.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">notes.libn</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="/">Главная</a>
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>Возможно что-то новое</h1>
    <p class="lead">Удобный сервис для хранения заметок.</p>
    <p class="lead">
      <a href="/login" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Авторизоваться</a>
    </p>
  </main>

  <footer class="mt-auto text-white-50">
    <p>pnsrc 2021</p>
  </footer>
</div>


    
  </body>
</html>
<style type="text/css">
  .bg-dark {
    background-color: tomato!important;
}
</style>
<?php endif; ?>