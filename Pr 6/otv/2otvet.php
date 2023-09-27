<html>
<body>
 
<?php
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
echo 'Здравствуйте, '.htmlspecialchars($_POST['firstName']).'. <br>';
echo 'Вам '.(int)$_POST['twoName'].' лет.'.'<br>';
}
?>
</body>
</html>