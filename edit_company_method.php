<?php
	session_start();
	include('connection.php');
	$cname = mysqli_real_escape_string($con,$_POST['txtName']);
	$cid = mysqli_real_escape_string($con,$_POST['txtID']);
	if(isset($_POST['txtID']))
	{
		$sql = "UPDATE company SET 
			comp_name = '".$cname."' ,
			date_modify ='$_SESSION[date]',
			user_modify ='$_SESSION[user_name]'
			WHERE comp_id = '".$cid."' ";

		$query = mysqli_query($con,$sql);
		$_SESSION['alert']='Edit';
	}

	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload Success');";
	//echo "window.location='edit_company.php';";
	echo "</script>";
	header("Location: edit_company.php");
?>