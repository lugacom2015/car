<?php
	include "connectScript.php";
    $authQuery=$dbConnection
        //запрос на выборку из БД, имена таблиц и полей не конечные и могут изменяться
        ->query("SELECT id,password,admin FROM user WHERE login='".$_POST["username"]."'");
        $userInfo=$authQuery->fetch_row();//переменная содержащая данные загруженые с помощью запроса
	if ($userInfo[1]==$_POST["password"])//проверка на ввод правильного сочетания логин/пароль
    {
        if ($userInfo[2]==FALSE)//проверка является ли админом пользователь
        {
            header("Location: ../html-pages/Application.php?id=".$userInfo[0]);
            //echo "Введено правильное сочетание логин/пароль";
            exit;
        }
        else
        {
            //header("Location: ../html-pages/admin.php");
            echo "Введено правильное сочетание логин/пароль";
            exit;
        }
    }
    else
    {
        echo "Введено неправильное сочетание логин/пароль";
    }
?>