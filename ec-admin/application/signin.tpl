<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>%{ec_admin title}%</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
  <link rel="stylesheet" href="./application/assets/styles/bootstrap.css">
  <link rel="stylesheet" href="./application/assets/styles/font-awesome.css">
  <link rel="stylesheet" href="./application/assets/styles/main.css">
</head>
<body>

  <div class="signin">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="widget">
            <div class="widget-header"><h4 class="widget-title">Авторизация</h4></div>
            <div class="widget-separator"></div>
            <div class="widget-body">
              <center><img src="../../ec-tpl/default/images/load.png" class="signin-image" id="avatarProfile"></center><br>
              <div id="result"></div>
              <div class="form-alt"><input type="text" name="login" id="login" onkeyup="setImage(this, 'avatarProfile')" onchange="setImage(this, 'avatarProfile')" placeholder="Имя пользователя"></div>
              <div class="form-alt"><input type="password" name="password" id="password" onkeyup="setDis(this, 'login', 'submit')" placeholder="Пароль"></div>
              <button id="submit" class="btn btn-primary btn-block" onclick="auth_admin(this, 'login', 'password', 'avatarProfile')" disabled>Войти</button>
              <div class="text-center" hidden><a href="#" class="link-alt">Забыли пароль?</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./application/assets/scripts/jquery-3.1.1.js"></script>
  <script src="./application/assets/scripts/bootstrap.js"></script>
  <script src="./application/assets/scripts/hash.js"></script>
  <script src="./application/assets/scripts/main.js"></script>
</body>
</html>
