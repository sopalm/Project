<?php
	session_start();
	include('connection.php');
	$add = mysqli_real_escape_string($con,$_POST['add']);
	$txtdate = mysqli_real_escape_string($con,$_POST['txtDate']);
	$txtid = mysqli_real_escape_string($con,$_POST['txtID']);
	if(isset($_POST['txtID']))
	{
		$sql = "UPDATE check_service SET 
			ca_id = '".$add."' ,
			cs_date = '".$txtdate."',
			date_modify ='$_SESSION[date]',
			user_modify ='$_SESSION[user_name]'
			WHERE cs_no = '".$txtid."' ";

		$query = mysqli_query($con,$sql);
		$_SESSION['alert']='Edit';
	}



	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload Success');";
	//echo "window.location='edit_check-service.php';";
	echo "</script>";
	//$_SESSION['alert']='Edit';
	header("Location: edit_check-service.php");

?>