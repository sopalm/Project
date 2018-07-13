<?php
	session_start();
	include('connection.php');

	$sqlCommand2 = "INSERT INTO `company_address`(`comp_id`, `address`,`date_modify`, `user`) VALUES ('$_POST[comp_id]','$_POST[comp_add]','$_SESSION[date]','$_SESSION[user_name]')";
	$result1=mysqli_query($con,$sqlCommand2)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='edit_company_data.php?id=$_POST[comp_id]';";
	echo "</script>";
?>
  