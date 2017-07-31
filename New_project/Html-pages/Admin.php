
<?php
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		header('Location: Authorization.php');
	}
	include_once('../PHP-scripts/connectScript.php');
?>
<html>
<head>
	<title>Страница администратора</title>
	<meta http-equiv="Content-Type" content="text/html" charset = "UTF-8">
	<link rel = "stylesheet" type = "text/css" href = "../Css-files/Admin.css" media = "all">	
	<link rel = "stylesheet" type = "text/css" href = "../Css-files/table.css" media = "all">	
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  	<script type = "text/javascript" src = "../Java_Script/JQuery/jquery.timepicker.js"></script>
  	<link rel = "stylesheet" type="text/css" href = "../Css-files/jquery.timepicker.css" />
  	<script type = "text/javascript" src = "../Java_Script/JQuery/bootstrap-datepicker.js"></script>
  	<link rel="stylesheet" type="text/css" href="../Css-files/bootstrap-datepicker.css" />
  	<script type = "text/javascript" src = "../Java_Script/JQuery/check.js"></script>
</head>
<body>
	<div class = "mid">
		<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" name="auth" method="post">
		<?php
				if(isset($_POST['']))  
				{
					 header("Location: ../PHP-scripts/exit.php");
				}
			?>
		<div>
			<p id="datepairExample">
			    <input type="text" name="ds" class="date start" value="" />
			    <input type="text" name="ts" class="time start" value="" /> 
			    <button type = "submit" name = "search">Поиск</button>
			    <input type="text" name="df" class="date end" value="" />
			    <input type="text" name="tf" class="time end" value="" />
			</p>
		</div>
		</form>
		<table class='table'>
					<tr>
						<th>ФИО</th>
						<th>Откуда</th>
						<th>Куда</th>
						<th>Дата/Время с</th>
						<th>Дата/Время по</th>
						<th>Машина</th>
						<th>Водитель</th>
						<th>Примечание</th>
						<th>Сохранить</th>
					</tr>
					<?php
						$a = mysqli_query($dbConnection, "SELECT COUNT(1) FROM request_first");
						$b = mysqli_fetch_array( $a );    
		                 	$queryRequestFirst = mysqli_query($dbConnection, "SELECT * FROM request_first");
		                     while ($resultRequestFirst = mysqli_fetch_array($queryRequestFirst)) 
		                     {
	           					require '../PHP-scripts/select_for_admin.php';  
		                     }		           
					?>
		</table>
		<!--<button type = "submit" name = "save" class="save">Сохранить</button>-->
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