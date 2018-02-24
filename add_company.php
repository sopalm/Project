<?php
	session_start();
	include('connection.php');

	$sqlCommand = "INSERT INTO `company`(`comp_id`, `comp_name`, `comp_address`) VALUES ('$_POST[comp_num]','$_POST[comp_name]','$_POST[comp_add]')";
	$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='regis_comp.php';";
	echo "</script>";
?>
  