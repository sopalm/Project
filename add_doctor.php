<?php
	session_start();
	include('connection.php');

	$title = mysqli_real_escape_string($con,$_POST['title']);
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$surname = mysqli_real_escape_string($con,$_POST['surname']);
	$doclicense = mysqli_real_escape_string($con,$_POST['doc_license']);
	if(isset($_POST['name'])&&isset($_POST['surname']))
	{
		$sqlCommand = "INSERT INTO `doctor`(`doc_title`,`doc_name`, `doc_surname`, `doc_license`,`date_modify`, `user`) 
					VALUES ('$title','$name','$surname','$doclicense','$_SESSION[date]','$_SESSION[user_name]')";
		$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('success');";
	//echo "window.location='edit_doctor.php';";
	echo "</script>";
	$_SESSION['alert']='doctor_add';
	header("Location: edit_doctor.php");
?>
  