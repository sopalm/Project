<?php
	session_start();
	include('connection.php');
	$title = mysqli_real_escape_string($con,$_POST['txtTitle']);
	$name = mysqli_real_escape_string($con,$_POST['txtName']);
	$surname = mysqli_real_escape_string($con,$_POST['txtSurname']);
	$bd = mysqli_real_escape_string($con,$_POST['txtBD']);
	$VN = mysqli_real_escape_string($con,$_POST['txtVN']);
	$id = mysqli_real_escape_string($con,$_POST['txtID']);
	if(isset($_POST['txtID']))
	{
		$sql = "UPDATE employee SET 
			VN = '".$VN."' ,
			emp_title = '".$title."' ,
			emp_name = '".$name."',
			emp_surname = '".$surname."' ,
			emp_bd = '".$bd."' ,
			date_modify ='$_SESSION[date]',
			user_modify ='$_SESSION[user_name]' 
			WHERE emp_id = '".$id."' ";

		$query = mysqli_query($con,$sql);
		$_SESSION['alert']='Edit';
	}

	header("Location: edit_company.php");
?>