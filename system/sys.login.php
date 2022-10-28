<?php
$data = $_POST;
if (isset($data['do_login'])) {
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ($user) {
		//логин существует
		if (password_verify($data['password'], $user->password)) {
			//если пароль совпадает, то нужно авторизовать пользователя
			$_SESSION['logged_user'] = $user;
			echo '<script type="text/javascript">window.location.href = "/"; </script>';
		} else {
			$errors[] = 'Неверно введен пароль!';
		}
	} else {
		$errors[] = 'Пользователь с таким логином не найден!';
	}

	if (!empty($errors)) {
		//выводим ошибки авторизации
		echo '<div id="errors" style="color:red;">' . array_shift($errors) . '</div><hr>';
	}
}
