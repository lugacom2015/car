<?php
$dbConnection=new mysqli("localhost","","","");//подключение к БД, данные для подключения не конечные

if (!$dbConnection) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
}
?>
