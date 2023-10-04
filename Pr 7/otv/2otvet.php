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

if(isset($_POST['psw-repeat'])){ // Получаем данные из формы
    $Repass = $_POST['psw-repeat'];
} else {
    $Repass = "";
}
if($Repass == $pass){
    echo "Готово!<br>";
} else {
    echo "<span style=color:red>Ошибка подтверждения пароля</span>"; // Если пароли не совпадают, то выводим сообщение об ошибке. (Таким же способом можно выводить в конкретное поле, прописав в основном файле php)
    include "../index.html"; // Если пароли не совпадают, то возвращаем на страницу ввода. Тут своё название и путь к файлу укажите.
}



    $host       = "db4.myarena.ru";      // Адрес сервера базы данных
    $dbname     = "u19978_a07";    // Имя базы данных
    $user       = "u19978_a07";           // Имя пользователя
    $password   = "7R7h3E6u9Y";               // Пароль
    $connection = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
    
    $sql = "INSERT INTO `Reg` (`Login`, `Email`, `Password`) values (['$login2'], ['$email'], ['$pass'])";
    $affectedRowsNumber = $connection->exec($sql);
    echo "В таблицу Reg добавлено строк: $affectedRowsNumber";


?>
</body>
</html>