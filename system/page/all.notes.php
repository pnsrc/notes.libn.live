<?php
require "../init.system.php";
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ВКанаве</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sticky-footer/">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//unpkg.com/timeago.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
  <link rel="stylesheet" href="../css/style.css"></link>
  <script src="../lib/index.var.js"></script>
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
    <a class="navbar-brand" href="/">ВКанаве</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" aria-current="page" href="/notes/create">Создать заметку</a>
        <a class="nav-link active" href="/notes/all">Все заметки</a>
        <?php
        if ($_SESSION['logged_user']->admin === true) {
          echo '<a class="nav-link" href="/admin">Панель администратора</a>';
        }
        ?>
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
    <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      Быстрое написание поста
          </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <form method="POST" id="fast_send" action="javascript:void(null);" onsubmit="send()">
        <textarea class="form-control" name='posts' id="exampleFormControlTextarea1" rows="3"></textarea>
      </br>
        <figcaption id="mirror">
        <button class="btn btn-outline-dark" name="addSign" type="submit">Отправить</button>
        </figcaption>
        </form>      </div>
    </div>
  </div>
</div>

    <hr class="my-5">
    

    <div class="row" id='data_posts' data-masonry='{"percentPosition": true }'>


      <?php
      $results = R::getAll("SELECT * FROM records  ORDER BY id DESC");
      foreach ($results as $row) {
        //Counting like and dislike
        $like = R::count('likes', 'record_id = ?', array($row['id']));
        $dislike = R::count('dislikes', 'record_id = ?', array($row['id']));
        $liked = R::count('actions', 'post_id = ? AND which_activity = ?', array($row['id'], 'like'));
        $disliked = R::count('actions', 'post_id = ? AND which_activity = ?', array($row['id'], 'dislike'));
        echo '
     <div class="col-sm-6 col-lg-4 mb-4">
     <div class="card p-3">';
        if ($row['picture'] != null) {
          echo '<img src="' . $row['picture'] . '" class="card-img-top" alt="...">';
        }
        echo '
       <figure class="p-3 mb-0">
         <blockquote class="blockquote">
         ' . $Parsedown->text($row["publ"]) . '
         </blockquote>
         <figcaption class="blockquote-footer mb-0 text-muted">
         Создана ' . $row["datapub"] . ' и сохранена ' . $row["username"] . '
         </figcaption>
         </br>
         <figcaption id="mirror">
          <form action="/notes/like" method="post">
          <input type="hidden" name="id" value="' . $like_id = $row["id"] . '">
          <button type="submit" class="btn btn-success" name="do_like">Like ' . $liked . '</button>
          </form>
          <form action="/notes/dislike" method="post">
          <input type="hidden" name="id" value="' . $like_id = $row["id"] . '">
          <button type="submit" class="btn btn-danger" name="do_dislike">Dislike ' . $disliked . '</button>
          </form>
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

  <style>
    figcaption#mirror {
      display: flex;
      justify-content: space-between;
    }
  </style>
  <script type="text/javascript" language="javascript">
 	function send() {
 	  var msg   = $('#fast_send').serialize();
        $.ajax({
          type: 'POST',
          url: '../system/ajax.posts_fast.system.php',
          data: msg,
          success: function(data) {
            //alert(data)

            new AWN().success('Успешно', {durations: {success: 0}})
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
        update()
    }
function update() {
  $.ajax({
                url: '../system/ajax.posts_get.system.php',
                cache: true,
                success: function(html){
                    $('#data_posts').html(html);
                }
            });
};


</script>

</body>

</html>