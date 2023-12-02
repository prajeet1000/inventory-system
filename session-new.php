<?php 
	if($_SESSION['INVENTORY']==''){
		header("Location:login.php");
	}
	else{
		$squery 	=	$conn->query("SELECT * FROM `users` WHERE id = '".$_SESSION['INVENTORY']."'");
		$srecord	=	mysqli_fetch_assoc($squery);
	}
?>