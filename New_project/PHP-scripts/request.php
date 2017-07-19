<?php
include_once('connectScript.php');


        //$username 	= $_POST['username'];
        $username = 1;
        $send = 1;
        $id 		= $_POST['id'];
        $ds 		= $_POST['ds'];
        $ts 		= $_POST['ts'];
        $datastart 	= $ds.' '.$ts;
        $df 		= $_POST['df'];
        $tf 		= $_POST['tf'];
        $datafinish = $df.' '.$tf;
        $endpoint 	= $_POST['endpoint'];


mysqli_query($dbConnection, "insert into `Request_first` set `user` = '$username', `time_from` = '$datastart', `time_to` = '$datafinish', `destination` = '$endpoint', `view` = '0'");

header("Location: ../html-pages/Application.php?id=".$id."&s=".$send);

?>