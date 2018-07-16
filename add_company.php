<?php
	session_start();
	include('connection.php');
	$cid = mysqli_real_escape_string($con,$_POST['comp_num']);
	$cname = mysqli_real_escape_string($con,$_POST['comp_name']);

	$sqlCommand = "INSERT INTO `company`(`comp_id`, `comp_name`,`date_modify`, `user`) VALUES ('$cid','$cname','$_SESSION[date]','$_SESSION[user_name]')";
	//    mysqli_real_escape_string();  -- Escape string
		$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());

	$cadd = mysqli_real_escape_string($con,$_POST['comp_add']);

	$sqlCommand2 = "INSERT INTO `company_address`(`comp_id`, `address`,`date_modify`, `user`) VALUES ('$cid','$cadd','$_SESSION[date]','$_SESSION[user_name]')";
	$result1=mysqli_query($con,$sqlCommand2)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='edit_company.php';";
	echo "</script>";
?>