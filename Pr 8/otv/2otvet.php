<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
<?php
if( $_SERVER['REQUEST_METHOD'] !== 'POST' )
exit('Не POST');

// Проверка, что все поля формы заполнены
if (!empty($_POST['login']) && !empty($_POST['psw'])) {
    // Все поля формы заполнены
    } else {
    // Не все поля формы заполнены
    echo "Пожалуйста, заполните все поля формы!<br>";
    include "../index.html"; // Если пароли не совпадают, то возвращаем на страницу ввода. Тут своё название и путь к файлу укажите.
    exit;
    }


// Получение данных из формы
$pass = filter_var(trim($_POST['psw']), FILTER_SANITIZE_STRING);
$login2 = $_POST['login'];

if (strlen($pass) >= 8) {
    } else {
    echo "Пароль должен содержать не менее 8 символов!<br>";
    include "../index.html"; // Если пароли не совпадают, то возвращаем на страницу ввода. Тут своё название и путь к файлу укажите.
    exit;
    }

    $host       = "db4.myarena.ru";      // Адрес сервера базы данных
    $dbname     = "u19978_a07";    // Имя базы данных
    $user       = "u19978_a07";           // Имя пользователя
    $password   = "7R7h3E6u9Y";               // Пароль
    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
    


    $stmt = $conn->prepare("SELECT * FROM `user` WHERE login = :login1");
    $stmt->bindParam(':login1', $login2);
    $stmt->execute();
    $user = $stmt->fetch();
    // Проверка, найден ли пользователь
    if ($user) {
    // Сравнение хешированного пароля из базы данных с введенным паролем
    if (password_verify($pass, $user['password'])) {
    // Если пароль совпадает, выполняем нужные действия
    echo "Авторизация прошла успешно!";
    } else {
    // Если пароль не совпадает, выводим сообщение об ошибке
    echo "Неверный пароль!";
    }
    } else {
    // Если пользователь не найден, выводим сообщение об ошибке
    echo "Пользователь не найден!";
    }









       $conn = null;
?>
</body>
</html>