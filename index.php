<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Library</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
<script async src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script async src="scriptEnter.js"></script>
</head>
<body>
<main>
<div class="wrapper backgroundColor">
    <div class="cdUserModal" id="enterWindow">
        <div class="cdUserModalContainer">
            <ul class="cdSwitcher">
                <li><a href="#0" id="loginTab" class="selected">Вход</a></li>
                <li><a href="#0" id="signupTab">Регистрация</a></li>
            </ul>

            <div id="cdLogin" class="isSelected"> 
                <form class="cdForm" action="login.php" method="POST">
                    <p class="fieldset">
                        <input id="loginEmail" type="email" name="loginEmail" placeholder="E-mail">
                    </p>

                    <p class="fieldset">
                        <input id="loginPassword" type="text" name="loginPassword" placeholder="Пароль">
                        <a href="#0" class="hidePassword">Скрыть</a>
                    </p>

                    <p class="fieldset">
                        <input class="full-width" type="submit" value="Войти">
                    </p>
                </form>
            </div>

            <div id="cdSignup">
                <form class="cdForm" action="signup.php" method="POST">
                    <p class="fieldset">
                        <input id="signupName" name="signupName" type="text" placeholder="Имя пользователя">
                    </p>

                    <p class="fieldset">
                        <input id="signupEmail" name="signupEmail" type="email" placeholder="E-mail">
                    </p>

                    <p class="fieldset">
                        <label for="signupBDate">Дата рождения:</label>
                        <input id="signupBDate" type="date" name="signupBDate" placeholder="Дата рождения">
                    </p>

                    <p class="fieldset">
                        <input id="signupPassword" name="signupPassword" type="text"  placeholder="Пароль">
                        <a href="#0" class="hidePassword">Скрыть</a>
                    </p>

                    <p class="fieldset">
                        <input type="submit" value="Создать аккаунт">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
</body>
</html>