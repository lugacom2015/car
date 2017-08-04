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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script type = "text/javascript" src = "../Java_Script/JQuery/jquery.timepicker.js"></script>
  	<link rel = "stylesheet" type="text/css" href = "../Css-files/jquery.timepicker.css" />
  	<script type = "text/javascript" src = "../Java_Script/JQuery/bootstrap-datepicker.js"></script>
  	<link rel="stylesheet" type="text/css" href="../Css-files/bootstrap-datepicker.css" />
  	<script type="text/javascript">	
		function funckSuccess(idRequest,carId,driverId) 
		{
			$("#"+idRequest).css ("background", "#32CD32");
			$("#"+idRequest).text ("Сохранено");
			$("#"+idRequest).mouseover(function(event)
			{
  				$(this).css("border", "2px solid #32CD32");
  				$(this).css("transition", "all 0.5s");
  				$(this).css("background", "#fff");
  				$(this).css("color", "#32CD32");
  			});
  			$("#"+idRequest).mouseout(function(event) 
			{
				$(this).css("background", "#32CD32");
				$(this).css("transition", "all 1s");
				$(this).css("border", "2px solid #fff");
				$(this).css("color", "#fff");
			});

			$("#driver"+idRequest).change(function()
			{
				$("#"+idRequest).css ("background", "#617a76");
				$("#"+idRequest).text ("Сохранить");
				$("#"+idRequest).mouseover(function(event)
				{
	  				$(this).css("border", "2px solid #617a76");
	  				$(this).css("transition", "all 0.5s");
	  				$(this).css("background", "#fff");
	  				$(this).css("color", "#617a76");
	  			});
	  			$("#"+idRequest).mouseout(function(event) 
				{
					$(this).css("background", "#617a76");
					$(this).css("transition", "all 1s");
					$(this).css("border", "2px solid #fff");
					$(this).css("color", "#fff");
				});
			});

			$("#car"+idRequest).change(function()
			{
				$("#"+idRequest).css ("background", "#617a76");
				$("#"+idRequest).text ("Сохранить");
				$("#"+idRequest).mouseover(function(event)
				{
	  				$(this).css("border", "2px solid #617a76");
	  				$(this).css("transition", "all 0.5s");
	  				$(this).css("background", "#fff");
	  				$(this).css("color", "#617a76");
	  			});
	  			$("#"+idRequest).mouseout(function(event) 
				{
					$(this).css("background", "#617a76");
					$(this).css("transition", "all 1s");
					$(this).css("border", "2px solid #fff");
					$(this).css("color", "#fff");
				});	
			});


			var selectCar = document.getElementsByClassName('car');
			for (var i = 0; i <= selectCar.length-1; i++)
			{
				var valueOptionCar = selectCar[i].value;
				if(valueOptionCar != carId)
				{
					for (var j = 0; j <= selectCar[i].options.length-1; j++)
					{
						if (selectCar[i].options[j].value == carId) 
						{
							selectCar[i].remove(j);
							break;
						}
					}
				}
			}
			
			var selectDriver = document.getElementsByClassName('driver');
			for (i = 0; i <= selectDriver.length-1; i++)
			{
				var valueOptionDriver = selectDriver[i].value;
				if(valueOptionDriver != driverId)
				{
					for (j = 0; j <= selectDriver[i].options.length-1; j++)
					{
						if (selectDriver[i].options[j].value == driverId) 
						{
							selectDriver[i].remove(j);
							break;
						}
					}
				}
			}
  		}

		$(document).ready(function() 
		{
			$(".saved").bind("click",function()
			{
				var idRequest = $(this).data('id');
				var carId = document.getElementById('car' + idRequest).value;
				var driverId = document.getElementById('driver' + idRequest).value;
				var descId = document.getElementById('desc' + idRequest).value;
				if(carId != "Выберите машину" && driverId != "Выберите водителя")
				{	
					$.ajax 
					({
						url: "../PHP-scripts/requestEnd.php",
						type: "POST",
						data: ({
			    		car: carId, 
			    		driver: driverId,
			    		desc: descId,
			   			id: idRequest
							}),
						dataType: "html",
						success: funckSuccess(idRequest,carId,driverId)
					});
				}
			});
		});
	</script>
</head>
<body>
	<div class = "mid">
		<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" name="admin" method="post">
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
		                 	$queryRequestFirst = mysqli_query($dbConnection, "SELECT * FROM request_first WHERE view = 0");
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