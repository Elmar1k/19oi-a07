<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    $host       = "db4.myarena.ru";      // Адрес сервера базы данных
    $dbname     = "u19978_a07";    // Имя базы данных
    $user       = "u19978_a07";           // Имя пользователя
    $password   = "7R7h3E6u9Y";               // Пароль
    $connection = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
    
    $result = $connection->query('SELECT * FROM `product`');
    echo "<table border=1>";
    $row = $result->fetch( PDO::FETCH_ASSOC );
    foreach ($row as $key => $value) {
        echo "<td align=center bgcolor=green style=\"font-weight:bold; color:#ffffff\">".$key."</td>";
    }
    do {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>".$value."</td>";
        }
        echo "</tr>";
    } while ($row = $result->fetch( PDO::FETCH_ASSOC ));
    echo "</table>";
?>

</body>
</html>
