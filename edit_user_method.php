<?php
	session_start();
	include('connection.php');

	$sql = "UPDATE user SET 
			user_name = '".$_POST["txtName"]."',
			user_pass = '".$_POST["txtPW"]."',
			user_status = '".$_POST["txtStatus"]."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE user_id = '".$_POST["txtID"]."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_user.php';";
	echo "</script>";
?>