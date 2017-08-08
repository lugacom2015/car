<?php
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		header('Location: Authorization.php');
	}
	include_once('../PHP-scripts/connectScript.php');
	$ms = $_GET['ms'];
	$message_1 = 0;
	$message_2 = 1;
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

	  	function selectCarDriver(myMatrix)
	  	{
	  		var selectCar = document.getElementsByClassName('car');
	  		var selectDriver = document.getElementsByClassName('driver');
	  		var selectTime = document.getElementsByClassName('dateFirst');
	  		for(var i = 0; i < selectCar.length; i++)
	  		{	  		
	  			var date = new Date(selectTime[i].innerHTML);
	  			var valueOptionCar = selectCar[i].value;
	  			for (var j = 0; j <= selectCar[i].options.length-1; j++)
	  			{
	  				for(var row = 0; row < myMatrix.length; row++)
	  				{
	  					for(var col = 0; col < myMatrix[0].length-4; col++)
	  					{
	  						if (selectCar[i].options[j].value == myMatrix[row][col] && myMatrix[row][col] != valueOptionCar) 
	  						{
	  							if(date < myMatrix[row][col + 4])
	  							{
	  								selectCar[i].remove(j);
	  							}
	  						}
	  					}
	  				}
	  			}
	  		}

	  		for(var i = 0; i < selectDriver.length; i++)
	  		{	  		
	  			var date = new Date(selectTime[i].innerHTML);
	  			var valueOptionDriver = selectDriver[i].value;
	  			for (var j = 0; j <= selectDriver[i].options.length-1; j++)
	  			{
	  				for(var row = 0; row < myMatrix.length; row++)
	  				{
	  					for(var col = 0; col < myMatrix[0].length-4; col++)
	  					{
	  						if (selectDriver[i].options[j].value == myMatrix[row][col + 2] && myMatrix[row][col + 2] != valueOptionDriver) 
	  						{
	  							if(date < myMatrix[row][col + 4])
	  							{
	  								selectDriver[i].remove(j);
	  							}
	  						}
	  					}
	  				}
	  			}
	  		}
	  	}	  

  		function matrixArray(rows)
  		{
  			var selectCar = document.getElementsByClassName('car');
  			var selectDriver = document.getElementsByClassName('driver');
  			var selectTime = document.getElementsByClassName('dateEnd');
	  		var arr = new Array();
	  		for(var i=0; i<selectCar.length; i++)
	  		{
		    	arr[i] = new Array();
		    	for(var j=0; j<rows; j++)
	    		{
	    			if(j == 0)
	      				arr[i][j] = selectCar[i].value;

	      			else if(j == 1)
	      			{
	      				for (var num = 0; num <= selectCar[i].options.length-1; num++)
						{
							if(selectCar[i].options[num].value == selectCar[i].value)
							{
								arr[i][j] = selectCar[i].options[num].text;
								break;
							}
						}
	      			}

	      			else if(j == 2)
	      				arr[i][j] = selectDriver[i].value;

	      			else if(j == 3)
	      			{
	      				for (var num = 0; num <= selectDriver[i].options.length-1; num++)
						{
							if(selectDriver[i].options[num].value == selectDriver[i].value)
							{
								arr[i][j] = selectDriver[i].options[num].text;
								break;
							}
						}
	      			}

	      			else
	      			{
	      				date = new Date(selectTime[i].innerHTML);
	      				date.setMinutes(date.getMinutes() + 30);
	      				arr[i][j] = date;	
	      			}
	      				
	    		}
	  		}
	  		return arr;
		}

		function alertMatrix(myMatrix)
		{
			var selectCar = document.getElementsByClassName('car');
			for(var i=0; i<selectCar.length; i++)
			{
				for(var j = 0; j < 5; j++)
				{
					alert(myMatrix[i][j]);
				}	
			}
		}

		function addCar(matrixOptionCar,matrixTextOptionCar,row)
		{
			var check = 0;
			var selectCar = document.getElementsByClassName('car');
			for(var i = 0; i < selectCar.length; i++)
			{
				for (var num = 0; num <= selectCar[i].options.length-1; num++)
				{
					if(selectCar[i].options[num].value == matrixOptionCar)
					{
						check = 1;
						break;
					}
				}
				if(i != row && check != 1)
				{
					var newOption = new Option(matrixTextOptionCar, matrixOptionCar);
					selectCar[i].appendChild(newOption);
				}
			}
		}

		function addDriver(matrixOptionDriver,matrixTextOptionDriver,row)
		{
			var check = 0;
			var selectDriver = document.getElementsByClassName('driver');
			for(var i = 0; i < selectDriver.length; i++)
			{
				for (var num = 0; num <= selectDriver[i].options.length-1; num++)
				{
					if(selectDriver[i].options[num].value == matrixOptionDriver)
					{
						check = 1;
						break;
					}
				}
				if(i != row && check != 1)
				{
					var newOption = new Option(matrixTextOptionDriver, matrixOptionDriver);
					selectDriver[i].appendChild(newOption);
				}
			}
		}

		function funckSuccess(idRequest,carId,driverId,ms,myMatrix) 
		{
			if(ms == 0)
			{
				document.getElementById(idRequest).disabled = true;
				document.getElementById("driver"+idRequest).disabled = true;
				document.getElementById("car"+idRequest).disabled = true;
				document.getElementById("desc"+idRequest).disabled = true;
			}

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
  		}

		$(document).ready(function() 
		{
			var ms = <?php echo $ms ?>;
			var myMatrix = matrixArray(5);
			if(ms == 1)
			{
				//alertMatrix(myMatrix);
				selectCarDriver(myMatrix);
				$(".saved").bind("click",function()
				{
					var idRequest = $(this).data('id');
					var carId = document.getElementById('car' + idRequest).value;
					var driverId = document.getElementById('driver' + idRequest).value;
					var descId = document.getElementById('desc' + idRequest).value;	
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
						success: funckSuccess(idRequest,carId,driverId,ms,myMatrix) 
					});
				});
			}

			$(".save").bind("click",function()
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
						success: funckSuccess(idRequest,carId,driverId,ms,myMatrix)
					});
				}
			});

			$(".car").change(function()
			{
				if(ms == 1)
				{
					var selectCar = document.getElementsByClassName('car');
					for(var i = 0; i < selectCar.length; i++)
					{
						var valueOptionCar = selectCar[i].value;
						for (var num = 0; num <= selectCar[i].options.length-1; num++)
						{
							if(selectCar[i].options[num].value == valueOptionCar)
							{
								var textOptionCar = selectCar[i].options[num].text;
								break;
							}
						}
						for(var col = 0; col < myMatrix[0].length-4; col++)
						{	
							if(myMatrix[i][col] != valueOptionCar)
							{
								var matrixOptionCar = myMatrix[i][col];
								var matrixTextOptionCar = myMatrix[i][col + 1];
								addCar(matrixOptionCar,matrixTextOptionCar,i);
								myMatrix[i][col] = valueOptionCar;
								myMatrix[i][col + 1] = textOptionCar;
								selectCarDriver(myMatrix);
							}
						}
					}
				}
			});

			$(".driver").change(function()
			{
				if(ms == 1)
				{
					var selectDriver = document.getElementsByClassName('driver');
					for(var i = 0; i < selectDriver.length; i++)
					{
						var valueOptionDriver = selectDriver[i].value;
						for (var num = 0; num <= selectDriver[i].options.length-1; num++)
						{
							if(selectDriver[i].options[num].value == valueOptionDriver)
							{
								var textOptionDriver = selectDriver[i].options[num].text;
								break;
							}
						}
						for(var col = 0; col < myMatrix[0].length-4; col++)
						{	
							if(myMatrix[i][col + 2] != valueOptionDriver)
							{
								var matrixOptionDriver = myMatrix[i][col + 2];
								var matrixTextOptionDriver = myMatrix[i][col + 3];
								addDriver(matrixOptionDriver,matrixTextOptionDriver,i);
								myMatrix[i][col + 2] = valueOptionDriver;
								myMatrix[i][col + 3] = textOptionDriver;
								selectCarDriver(myMatrix);
							}
						}
					}
				}
			});
		});

	</script>
</head>
<body>
	<div class = "mid">
		<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" name="admin" method="post">
		<div>
			<p class="llink">
			<?php
				if($ms == 0)
				{
					echo '<a href=Admin.php?ms='.$message_2.'><label class=ledit>Редактировать </label></a>';
					echo '<a href=Admin.php?ms='.$message_1.'><label class=lconsred>Рассмотреть </label></a>';
				}
				else if($ms == 1)
				{
					echo '<a href=Admin.php?ms='.$message_2.'><label class=leditred>Редактировать </label></a>';
					echo '<a href=Admin.php?ms='.$message_1.'><label class=lcons>Рассмотреть </label></a>';
				}
			?>
			</p>
			<p id="datepairExample">
			    <input type="text" name="ds" class="date start" value="" />
			    <input type="text" name="ts" class="time start" value="" /> 
			    <button type = "submit" name = "search">Поиск</button>
			    <input type="text" name="df" class="date end" value="" />
			    <input type="text" name="tf" class="time end" value="" />
			</p>
		</div>
		</form>
		<table class='table' id="table">
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
							if($ms == 0)
							{
		                 		$queryRequestFirst = mysqli_query($dbConnection, "SELECT * FROM request_first WHERE view = 0");
		                 		while ($resultRequestFirst = mysqli_fetch_array($queryRequestFirst)) 
			                    {
		           					require '../PHP-scripts/select_for_admin.php';  
			                    }		  
							}
		                 	else if($ms == 1)
		                 	{
			                 	$queryRequestFirst = mysqli_query($dbConnection, "SELECT * FROM request_first WHERE view = 1");
			                    while ($resultRequestFirst = mysqli_fetch_array($queryRequestFirst)) 
			                    {
			                     	$queryCheckRequestEnd =  mysqli_query($dbConnection, "SELECT * FROM request_end WHERE request_first =".$resultRequestFirst['id']);
									if(mysqli_num_rows($queryCheckRequestEnd) > 0)	
		           						require '../PHP-scripts/select_for_admin.php';  
			                    }		  
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