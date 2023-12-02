<?php 
	session_start();
	session_destroy();
	unset($_SESSION['INVENTORY']);
	header("Location:login.php");
?>
