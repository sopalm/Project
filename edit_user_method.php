<?php
	session_start();
	include('connection.php');
	$uname = mysqli_real_escape_string($con,$_POST['txtName']);
	$upass = mysqli_real_escape_string($con,$_POST['txtPW']);
	$ustatus = mysqli_real_escape_string($con,$_POST['txtStatus']);
	$uid = mysqli_real_escape_string($con,$_POST['txtID']);
	if(isset($_POST['txtID']))
	{$sql = "UPDATE user SET 
			user_name = '".$uname."',
			user_pass = '".$upass."',
			user_status = '".$ustatus."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE user_id = '".$uid."' ";

	$query = mysqli_query($con,$sql);
	$_SESSION['alert']='Edit';
	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload Success');";
	//echo "window.location='edit_user.php';";
	echo "</script>";
	header("Location: edit_user.php");
?>