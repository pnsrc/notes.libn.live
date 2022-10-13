<?php 
	require 'init.system.php';
	unset($_SESSION['logged_user']);
	echo '<script type="text/javascript">alert("Вы вышли из своего аккаунта. ");  window.location.href = "/"; </script>';
?>
