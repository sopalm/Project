<?php
	session_start();
	include('connection.php');

	$sql = "UPDATE check_service SET 
			ca_id = '".$_POST["add"]."' ,
			cs_date = '".$_POST["txtDate"]."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE cs_no = '".$_POST["txtID"]."' ";

	$query = mysqli_query($con,$sql);



	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_check-service.php';";
	echo "</script>";
?>