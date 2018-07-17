<?php
	session_start();
	include('connection.php');
	$title = mysqli_real_escape_string($con,$_POST['txtTitle']);
	$name = mysqli_real_escape_string($con,$_POST['txtName']);
	$surname = mysqli_real_escape_string($con,$_POST['txtSurname']);
	$licen = mysqli_real_escape_string($con,$_POST['txtLicen']);
	$id = mysqli_real_escape_string($con,$_POST['txtID']);
	if(isset($_POST['txtID']))
	{$sql = "UPDATE doctor SET 
			doc_title = '".$title."' ,
			doc_name = '".$name."' ,
			doc_surname = '".$surname."',
			doc_license = '".$licen."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE doc_id = '".$id."' ";

	$query = mysqli_query($con,$sql);}

	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload Success');";
	//echo "window.location='edit_doctor.php';";
	echo "</script>";
	header("Location: edit_doctor.php");
?>