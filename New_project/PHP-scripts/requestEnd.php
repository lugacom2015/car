<?php
	include_once("../php-scripts/connectScript.php");
	$firstRequestId=$id;
	$carId=$_POST['car'.$firstRequestId];
	$driverId=$_POST['driver'.$firstRequestId];
	$desc=$_POST['desc'.$firstRequestId];
	$query=mysqli_query($dbConnection,"SELECT id FROM request_end WHERE request_first='$firstRequestId'");
	$result=mysql_affected_rows($query);
	if ($result[0]==""){
		mysqli_query($dbConnection,"INSERT INTO request_end SET request_first='".$firstRequestId."', car='".$carId."', driver='".$driverId."', note='".$desc."'");
	}
	else
	{
		mysqli_query($dbConnection,"UPDATE request_end SET request_first='".$firstRequestId."', car='".$carId."', driver='".$driverId."', note='".$desc."' WHERE id='".$result[0]."'");
	}
?>