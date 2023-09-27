<html>
<body>
 
<?php

if( $_SERVER['REQUEST_METHOD'] !== 'POST' )
    exit('Не POST');

if(empty($_POST['twoName']) || empty($_POST['twoName'])) exit('Не все поля заполнены');
if(!is_numeric($_POST['twoName']) || $_POST['twoName'] < 1) exit('Поле возраст заполнено неправильно');
echo 'Здравствуйте, '.htmlspecialchars($_POST['firstName']).'. <br>';
echo 'Вам '.(int)$_POST['twoName'].' лет.'.'<br>';

?>
</body>
</html>