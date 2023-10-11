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
    


// Поиск пользователя по логину
$stmt1 = $conn->prepare("SELECT * FROM `user` WHERE login = :login");
$stmt1->bindParam(':login', $login2);
$stmt1->execute();
$userByLogin = $stmt1->fetch();

// Поиск пользователя по почте
$stmt2 = $conn->prepare("SELECT * FROM `user` WHERE email = :email");
$stmt2->bindParam(':email', $email);
$stmt2->execute();
$userByEmail = $stmt2->fetch();

if ($userByLogin) {
if (password_verify($pass, $userByLogin['password'])) {
echo "Авторизация по логину прошла успешно!";
} else {
echo "Неверный пароль!";
}
} elseif ($userByEmail) {
if (password_verify($pass, $userByEmail['password'])) {
echo "Авторизация по почте прошла успешно!";
} else {
echo "Неверный пароль!";
}
} else {
echo "Пользователь не найден!";
}









       $conn = null;
?>
</body>
</html>