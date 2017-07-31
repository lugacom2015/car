<?php
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		header('Location: Authorization.php');
	}
	include_once('../PHP-scripts/connectScript.php');
	$id = $_GET['id'];
	$send = $_GET['s'];
?>
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
</head>
<body>
	<div class = "mid">
		<form action="../PHP-scripts/request.php" name="auth" method="post">
			<div>
				<label>Заявка</label>
			</div>
			<div>
				<?php
					echo "<input type = 'text' name = 'username' value = '";
					$query = mysqli_query($dbConnection, "SELECT * FROM user where id = '".$id."'");
					while ($result = mysqli_fetch_array($query)) 
					{
						echo
						$result['surname']. " ".
						$result['name']{0}. ".".
						$result['patronymic']{0};
					}
					echo "'";
					echo "readonly tabIndex='-1' disabled>";
				?>
			</div>
			<div>
				<p id="datepairExample">
				    <input type="text" name="ds" class="date start" required="required" value="" />
				    <input type="text" name="ts" class="time start" required="required" value="" /> до
				    <input type="text" name="tf" class="time end" required="required" value="" />
				    <input type="text" name="df" class="date end" required="required" value="" />
				</p>
			</div>
			<?php
				echo "<input class='id' name ='id' value = '".$id."'>";
			?>
			<div>
				<select name = "endpoint" class="endpoint">
				<option disabled>Выберите город</option>
					<?php						
						$result = mysqli_query($dbConnection, "select * from `Direction` order by `id`");
				    	
						/*$data = $dbConnection->prepare("select * from `Direction` order by `id` ");
						$data->execute();
						$sql = $data->fetchAll();*/
						
						echo "select * from `Direction` order by `id`";
				        while ($row = mysqli_fetch_assoc($result)) {
				        echo '<option value="'.$row['id'].'">'.$row['destination'].'</option>';
				        }				
					?>									
				</select>
			</div>
			<?php
				if($send != 0)
				{
					$query = mysqli_query($dbConnection, "SELECT * FROM request_first ORDER BY id DESC LIMIT 1");
					$result = mysqli_fetch_assoc($query);
					echo "<p class = 'add'>Заявка успешно отправлена</p>";
					echo "<p class = 'add'>Код заявки: ".$result['id']."</p>";
			?>
					<script type="text/javascript">
						function timer()
						{
							var obj=document.getElementById('timer_inp');
							obj.innerHTML--;  
							if(obj.innerHTML==0)
							{
							location.href='../PHP-scripts/exit.php';
							setTimeout(function(){},1000);
							}
							else
							{
								setTimeout(timer,1000);
							}
						}
						setTimeout(timer,1000);
					</script>
			<?php
					echo "<div class = 'add'>Осталось <span  id='timer_inp' class = 'add'> 5 </span></div>";
				}
			?>
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