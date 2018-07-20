<?php
	$con= mysqli_connect("localhost","root","","yhdb") or die("Error: " . mysqli_error($con));
	if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    } 
	
    mysqli_set_charset($con, "utf8");
	date_default_timezone_set("Asia/Bangkok");
	$_SESSION['date'] = date("Y-m-d H:i:s");
	$date = date("Y-m-d");
	
?>
