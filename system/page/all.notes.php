<?php
  require "./init.system.php";
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>notes.libn</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sticky-footer/">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/timeago.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

  
    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<meta name="theme-color" content="#7952b3">


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
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">notes.libn</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="/notes/create">Создать заметку</a>
        <a class="nav-link active" href="/notes/all">Все заметки</a>
        <a class="nav-link" href="/logout">Выйти</a>
      </div>
    </div>
  </div>
</nav>
  <body class="d-flex flex-column h-100">
    
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
  </br>
  </br>
    </br>

  </div>
</main>

<main class="container py-5">
  <h1>Постики из канавы</h1>

  <hr class="my-5">

  <div class="row" data-masonry='{"percentPosition": true }'>


  <?php
    $ded = $_SESSION["logged_user"]->vk_id;
     $results=R::getAll("SELECT * FROM records WHERE vk_id = '". $ded."' ORDER BY id DESC");

     foreach($results as $row){
     echo '
     <div class="col-sm-6 col-lg-4 mb-4" style="position: absolute; left: 50%; top: 0px;">
     <div class="card p-3">
       <figure class="p-3 mb-0">
         <blockquote class="blockquote">
           <p>'. $row["publ"] .'</p>
         </blockquote>
         <figcaption class="blockquote-footer mb-0 text-muted">
         Создана '.$row["datapub"].' и сохранена '.$row["username"].'
         </figcaption>
       </figure>
     </div>
   </div>
     ';
     }
    ?>





</div>

</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">pnsrc. 2021</span>
  </div>
</footer>


    
  </body>
</html>
