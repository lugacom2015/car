<html>
	<head>
		<title>Авторизация</title>
		<meta http-equiv = "Content-Type" content = "text/html" charset = "UTF-8">
		<link rel = "stylesheet" type = "text/css" href = "../Css-files/Authorization.css"	 media = "all">	
	</head>
	<body>
		<div class = "mid">
			<form method = "POST" action ="../PHP-scripts/authScript.php">
				<div>
					<input type = "text" name = "username" placeholder = "Введите логин">	
				</div>
				<div>
					<input type = "password" name = "password" placeholder = "Введите пароль">	
				</div>
				<div>
					<button type = "submit" name = "send">Войти</button>
				</div>
			</form>	
		</div>
	</body>
</html>