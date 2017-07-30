<?php
	//ob_start();
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	session_destroy();
    header("Location: ../html-pages/Authorization.php");
    exit();
?>