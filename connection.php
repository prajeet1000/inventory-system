<?php
	error_reporting(0);
	session_start();
	$servername = "localhost";
	$username 	= "root";
	$password 	= "password";
	$db_name 	= "inventory_system";
	$conn 		= new mysqli($servername, $username, $password,$db_name);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	header("Content-Type: text/html; charset=utf-8");
	mysqli_set_charset($conn,"utf8");
		
	define('SITE_URL','http://localhost/inventory-system/');
?>
