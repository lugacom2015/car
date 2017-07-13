<?php
if (isset($_POST["send"])){
    $authQuery=$dbConnection
        //запрос на выборку из БД, имена таблиц и полей не конечные и могут изменяться
        ->query("SELECT id,admin FROM users WHERE login=".$_POST["username"]."AND password=".$_POST["password"]);
    if ($authQuery!=FALSE)//проверка на ввод правильного сочетания логин/пароль
    {
        $userInfo=$authQuery->fetch_row()//переменная содержащая данные загруженые с помощью запроса
        if ($userInfo[1]=FALSE)//проверка является ли админом пользователь
        {
            header("Location: ../html-pages/request.php?id=".$userInfo[0]);
            exit;
        }
        else
        {
            header("Location: ../html-pages/admin.php");
            exit;
        }
    }
    else
    {
        echo "Введено неправильное сочетание логин/пароль";
    }

}
?>