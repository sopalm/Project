<?php
	session_start();
	include('connection.php');
	$add = mysqli_real_escape_string($con,$_POST['supName']);
	$ca = mysqli_real_escape_string($con,$_POST['supID']);
	$id = mysqli_real_escape_string($con,$_POST['tag']);
	
	$sqlCommand = "UPDATE `company_address` SET address = '$add', date_modify = '$_SESSION[date]', user_modify ='$_SESSION[user_name]' WHERE ca_id = '$ca' ";
	$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	//echo "alert('success');";
	//echo "window.location='edit_company_data.php?id=$id';";
	echo "</script>";
	header("Location: edit_company_data.php?id=$id");
?>
  