<?php
include_once('connectScript.php');


        $send = 1;
        $id 		= $_POST['id'];
        $ds 		= $_POST['ds'];
        $ts 		= $_POST['ts'];
        $datastart 	= $ds.' '.$ts;
        $df 		= $_POST['df'];
        $tf 		= $_POST['tf'];
        $dataFinish = $df.' '.$tf;
        $endPoint 	= $_POST['endpoint'];


mysqli_query($dbConnection, "insert into `Request_first` set `user` = '$id', `time_from` = '$datastart', `time_to` = '$dataFinish', `destination` = '$endPoint', `view` = '0'");

header("Location: ../html-pages/Application.php?id=".$id."&s=".$send);

?>