<?php
    require "init.system.php";

$client_id = 8016642; // ID приложения
$client_secret = 'fKY1Plh21UMoUmgb0B7G'; // Защищённый ключ
$redirect_uri = 'http://notes.libn.live/login/auth'; // Адрес сайта

$url = 'https://oauth.vk.com/authorize'; // Ссылка для авторизации на стороне ВК

$params = [ 'client_id' => $client_id, 'redirect_uri'  => $redirect_uri, 'response_type' => 'code']; // Массив данных, который нужно передать для ВК содержит ИД приложения код, ссылку для редиректа и запрос code для дальнейшей авторизации токеном


if (isset($_GET['code'])) {
    $result = true;
    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    ];

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,email',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }


    if ($result) {

        // Проводим авторизацию если все хорошо то впускаем пользователя
        $user = R::findOne('users', 'vk_id = ?', array($userInfo['id']));
		if ( $user )
		{
				$_SESSION['logged_user'] = $user;

		}else{
            //Если нет то регистрируем пользователя
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
			$gentoken = substr(str_shuffle($permitted_chars), 0, 15);
			//ошибок нет, теперь регистрируем
			$user = R::dispense('users');
			$user->isadmin = "false";
			$user->username =  $userInfo['first_name'];
			$user->vk_id = $userInfo['id'];
			$user->vk_img_profile = $userInfo['photo_big'];
			R::store($user);	
        }
        echo '<script type="text/javascript">alert("Поздравляем! \n Вы успешно авторизовались!. ");  window.location.href = "/"; </script>';

    }
}
?>
