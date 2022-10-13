<?php
require 'init.system.php';

$data = $_POST;

	//если кликнули на button
	if ( isset($data['do_publish']) )
	{
		if ( empty($errors) )
		{
			$blog = R::dispense('records');
			$blog->username = trim($_SESSION['logged_user']->username);
			$blog->userid = trim($_SESSION['logged_user']->id);
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