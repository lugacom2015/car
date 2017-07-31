<?php
    session_start();
	include "connectScript.php";
    $send = 0;
    $authQuery=$dbConnection
        //запрос на выборку из БД, имена таблиц и полей не конечные и могут изменяться
        ->query("SELECT id,password,admin FROM user WHERE login='".$_POST["username"]."'");
        $userInfo=$authQuery->fetch_row();//переменная содержащая данные загруженые с помощью запроса
	if ($userInfo[1]==$_POST["password"] and $_POST["password"]!="")//проверка на ввод правильного сочетания логин/пароль
    {
        if ($userInfo[2]==FALSE)//проверка является ли админом пользователь
        {
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['password'] = $_POST["password"];
            header("Location: ../html-pages/Application.php?id=".$userInfo[0]."&s=".$send);
            exit;
        }
        else
        {
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['password'] = $_POST["password"];
            header("Location: ../html-pages/Admin.php");
            exit;
        }
    }
    else
    {
        //echo "Введено неправильное сочетание логин/пароль";
        header("Location: ../html-pages/Authorization.php");
    }
?>