<?php
include "init.system.php";

//$guests = R::dispense( 'guests' );
//$guests->guest_name = $_POST['name'];
//$guests->comment = $_POST['description'];
//$guests = R::store( $guests );

$posts_data = $_POST['posts'];
$desc = $_POST['description'];
//mysqli_query($mysqli, "INSERT INTO `guest` (`name`, `user_text`) VALUES ('$guests_name', '$desc')");

if($posts_data === ''){
    exit();
} else {
    $blog = R::dispense('records');
$blog->username = trim($_SESSION['logged_user']->username);
$blog->userid = trim($_SESSION['logged_user']->id);
$blog->like_counter = '0';
if($toggle == 'true'){
    $blog->picture = $uploadfile;
}
$blog->ban = false;
$blog->datapub = date(" Y-m-d H:i:s");
$blog->publ = $_POST['posts'];
R::store($blog);
}
?>