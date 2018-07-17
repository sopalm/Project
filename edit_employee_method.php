<?php
	session_start();
	include('connection.php');
	$title = mysqli_real_escape_string($con,$_POST['txtTitle']);
	$name = mysqli_real_escape_string($con,$_POST['txtName']);
	$surname = mysqli_real_escape_string($con,$_POST['txtSurname']);
	$bd = mysqli_real_escape_string($con,$_POST['txtBD']);
	$age = mysqli_real_escape_string($con,$_POST['txtAge']);
	$VN = mysqli_real_escape_string($con,$_POST['txtVN']);
	$id = mysqli_real_escape_string($con,$_POST['txtID']);

	$sql = "UPDATE employee SET 
			VN = '".$VN."' ,
			emp_title = '".$title."' ,
			emp_name = '".$name."',
			emp_surname = '".$surname."' ,
			emp_bd = '".$bd."' ,
			emp_age = '".$age."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]' 
			WHERE emp_id = '".$id."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload Success');";
	//echo "window.location='edit_company.php';";
	echo "</script>";
	header("Location: edit_company.php");
?>