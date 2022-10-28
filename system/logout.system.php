<?php 
	require 'init.system.php';
	unset($_SESSION['logged_user']);
	echo '<script type="text/javascript">window.location.href = "/"; </script>';
?>
