<?php
	$con= mysqli_connect("localhost","root","","pro_test") or die("Error: " . mysqli_error($con));
	if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    } 
	
	//header("content-type:text/javascript;charset=utf-8");
    mysqli_set_charset($con, "utf8");
	date_default_timezone_set("Asia/Bangkok");
	$_SESSION['date'] = date("Y-m-d H:i:s");
	$date = date("Y-m-d");
	
	
?>
