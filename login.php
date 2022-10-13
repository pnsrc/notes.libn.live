<?php
include "system/vk.system.php";
?>
<?php if ( isset ($_SESSION['logged_user']) ) : ?>
<script type="text/javascript">
    location.replace("/")
</script>
<?php else : ?>
<html lang="гu">
  <head>
    <meta charset="utf-8">
    <title>notes.libn</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<style>
    body.text-center
    {
      background-image: url(http://picsum.photos/3840/2160?blur=4);
    }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      form.form-signin {
    border-radius: 4%;
    backdrop-filter: blur(12px);
    background-color: #fafafa66;
    box-shadow: 2px 2px 0px #00000026;
}
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.5/examples/sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
 <form class="form-signin" action="/site/login/next" method="POST">
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Войти</h1>
        <p></p>
      </div>
		<p>Вы можете только сделать вход с помощью ВК</p>
		<?php
		if(isset($_SESSION['id'])) {

			echo "Вы уже авторизованы";
		
		} else {
		
			echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';
		}
		
		?>
      <p class="mt-5 mb-3 text-muted text-center">Данное изображение предоставлено сервисом <a href="">picsum</a></p>
    </form>
</body>
</html>
<?php endif; ?>