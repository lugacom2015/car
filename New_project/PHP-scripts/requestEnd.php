<?php
	include_once("../php-scripts/connectScript.php");
	$firstRequestId = $_POST['id'];
	$carId = $_POST['car'];
	$driverId = $_POST['driver'];
	$desc = $_POST['desc'];
	$view = 1;
	$query = mysqli_query($dbConnection,"SELECT id FROM request_end WHERE request_first = '$firstRequestId'");
	$result = mysqli_fetch_row($query);
	if ($result[0] == ""){
		mysqli_query($dbConnection,"INSERT INTO request_end SET request_first = '".$firstRequestId."', car = '".$carId."', driver = '".$driverId."', note = '".$desc."'");
		mysqli_query($dbConnection,"UPDATE request_first SET view = '".$view."' WHERE id = '".$firstRequestId."'");
	}
	else
	{
		mysqli_query($dbConnection,"UPDATE request_end SET request_first = '".$firstRequestId."', car = '".$carId."', driver = '".$driverId."', note = '".$desc."' WHERE id = '".$result[0]."'");
	}
?>

