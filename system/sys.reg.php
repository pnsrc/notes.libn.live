<?php
$data = $_POST;
if (isset($data['do_signup'])) {
  $errors = array();

  if (trim($data['login']) == '') {
    $errors[] = 'Введите логин';
  }

  if (trim($data['email']) == '') {
    $errors[] = 'Введите Email';
  }

  if ($data['password'] == '') {
    $errors[] = 'Введите пароль';
  }

  if ($data['password_2'] != $data['password']) {
    $errors[] = 'Повторный пароль введен не верно!';
  }

  if (R::count('users', "login = ?", array($data['login'])) > 0) {
    $errors[] = 'Пользователь с таким логином уже существует!';
  }

  if (R::count('users', "email = ?", array($data['email'])) > 0) {
    $errors[] = 'Пользователь с таким Email уже существует!';
  }


  if (empty($errors)) {
    $user = R::dispense('users');
    $user->login = $data['login'];
    $user->username = $data['username'];
    $user->email = $data['email'];
    $user->ban = "false";
    $user->admin = "false";
    $user->password = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
    R::store($user);
    echo '<script>alert("Спасибо за регистрацию.");</script>';
    echo '<script type="text/javascript">window.location.href = "/"; </script>';
  } else {
    echo '<script>alert("' . array_shift($errors) . '");</script>';
  }
}
