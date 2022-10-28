<?php
include "init.system.php";
$results = R::getAll("SELECT * FROM records  ORDER BY id DESC");
foreach ($results as $row) {
  //Counting like and dislike
  $like = R::count('likes', 'record_id = ?', array($row['id']));
  $dislike = R::count('dislikes', 'record_id = ?', array($row['id']));
  $liked = R::count('actions', 'post_id = ? AND which_activity = ?', array($row['id'], 'like'));
  $disliked = R::count('actions', 'post_id = ? AND which_activity = ?', array($row['id'], 'dislike'));
  echo '
<div class="col-sm-6 col-lg-4 mb-4" >
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