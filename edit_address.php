<?php
	session_start();
	include('connection.php');
	$sqlCommand = "UPDATE `company_address` SET address = '$_POST[supName]' WHERE ca_id = $_POST[supID] ";
	$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='edit_company_data.php?id=$_POST[tag]';";
	echo "</script>";
?>
  