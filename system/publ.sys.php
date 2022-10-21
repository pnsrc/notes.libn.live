<?php
require 'init.system.php';
$touch = is_dir('../users/id'.$_SESSION['logged_user']->id);
echo $touch;
if ($touch == true) {
	echo 'Папка создана';
} else {
	echo 'Папка не создана';
	mkdir('../users');
mkdir('../users/id'. $_SESSION['logged_user']->id);
}
$uploaddir = '../users/id'.$_SESSION['logged_user']->id.'/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	$toggle = 'true';
} else {
    $error = "Возможная атака с помощью файловой загрузки!\n";
}

$error = 'Некоторая отладочная информация:';

$data = $_POST;

	//если кликнули на button
	if ( isset($data['do_publish']) )
	{
		if ( empty($errors) )
		{
			$blog = R::dispense('records');
			$blog->username = trim($_SESSION['logged_user']->username);
			$blog->userid = trim($_SESSION['logged_user']->id);
			$blog->like_counter = '0';
			if($toggle == 'true'){
				$blog->picture = $uploadfile;
			}
			$blog->like_user_massive = '';
			$blog->vk_id = trim($_SESSION['logged_user']->vk_id);
			$blog->vk_image = trim($_SESSION['logged_user']->vk_img_profile);
			$blog->datapub = date(" Y-m-d H:i:s");
			$blog->publ = $data['publ'];
			R::store($blog);
			echo '<script type="text/javascript">
	alert("Заметка успешно добавлена!");  window.location.href = "/notes/all";
</script>';
		}else
		{
			echo '<script type="text/javascript">
	alert("'.array_shift($errors).'")
</script>';
		}

	}
?>