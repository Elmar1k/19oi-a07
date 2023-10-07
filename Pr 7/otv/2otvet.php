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

// Получение данных из формы
$pass = filter_var(trim($_POST['psw']), FILTER_SANITIZE_STRING);
$login2 = $_POST['login'];
$email = $_POST['email'];
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

if(isset($_POST['psw-repeat'])){ // Получаем данные из формы
    $Repass = $_POST['psw-repeat'];
} else {
    $Repass = "";
}
if($Repass == $pass){
    echo "Пароли совпадают!<br>";
} else {
    echo "<span style=color:red>Ошибка подтверждения пароля</span>"; // Если пароли не совпадают, то выводим сообщение об ошибке. (Таким же способом можно выводить в конкретное поле, прописав в основном файле php)
    include "../index.html"; // Если пароли не совпадают, то возвращаем на страницу ввода. Тут своё название и путь к файлу укажите.
}

if (strlen($pass) >= 8) {
    echo "Пароль допустимой длины!<br>";
    } else {
    echo "Пароль должен содержать не менее 8 символов!<br>";
    exit;
    }
    if (empty(trim($password))) {
        echo "Пароль идеален<br>";
        } else {
        echo "Пароль прошел проверку!<br>";
        exit;
        }



    $host       = "db4.myarena.ru";      // Адрес сервера базы данных
    $dbname     = "u19978_a07";    // Имя базы данных
    $user       = "u19978_a07";           // Имя пользователя
    $password   = "7R7h3E6u9Y";               // Пароль
    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
    
    $sql1 = "SELECT COUNT(*) FROM `user` WHERE `login` = ?";
    $statement = $conn->prepare($sql1);
    $statement->execute([$login2]);
    $count = $statement->fetchColumn();

    if ($count > 0) {
    echo "Пользователь с таким логином уже существует!<br>";
    exit;
    } else {
    echo "Логин является уникальным!<br>";
    }

        try {
        $sql = "INSERT INTO `user` (login, email, password)
        VALUES ('$login2', '$email', '$hashedPassword')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";
        }
        catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
       $conn = null;
?>
</body>
</html>