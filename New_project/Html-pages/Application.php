<html>
<head>
	<title>Заявка</title>
	<meta http-equiv="Content-Type" content="text/html" charset = "UTF-8">
	<link rel = "stylesheet" type = "text/css" href = "../Css-files/Application.css" media = "all">	
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  	<script type = "text/javascript" src = "../Java_Script/JQuery/jquery.timepicker.js"></script>
  	<link rel = "stylesheet" type="text/css" href = "../Css-files/jquery.timepicker.css" />
  	<script type = "text/javascript" src = "../Java_Script/JQuery/bootstrap-datepicker.js"></script>
  	<link rel="stylesheet" type="text/css" href="../Css-files/bootstrap-datepicker.css" />
  	<script type = "text/javascript" src = "../Java_Script/JQuery/site.js"></script>
  	<link rel = "stylesheet" type="text/css" href = "../Css-files/lib/site.css" />
</head>
<body>
	<div class = "mid">
		<form method = "POST">
			<div>
				<label>Заявка</label>
			</div>
			<div>
				<input type = "text" name = "username" value = "Имя пользователя" readonly tabIndex="-1" disabled="disabled">
			</div>
			<div>
				<p id="datepairExample">
				    <input type="text" class="date start" required="required" value="" />
				    <input type="text" class="time start" required="required" value="" /> до
				    <input type="text" class="time end" required="required" value="" />
				    <input type="text" class="date end" required="required" value="" />
				</p>
			</div>
			<div>
				<select name = "endpoint" class="endpoint">
					<option disabled>Выберите город</option>
					<option>Антрацит</option>
					<option selected="selected">Луганск</option>
					<option>Краснодон</option>
				</select>
			</div>
			<div>
					<button type = "submit" name = "send">Отправить</button>
			</div>
			<script>
	    		$('#datepairExample .time').timepicker({
	       		 	'showDuration': true,
	      	     	'timeFormat': 'H:i',
	      	     	'step': 15
	    		});

			    $('#datepairExample .date').datepicker({
			        'format': 'yyyy-m-d',
			        'autoclose': true
			    });
			    
	    		$('#datepairExample').datepair();
			</script>
		</form>	
	</div>
</body>
</html>