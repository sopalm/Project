<?php
	$con= mysqli_connect("localhost","root","","pro_test") or die("Error: " . mysqli_error($con));
	if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
	mysqli_set_charset($con, "utf8");
?>
