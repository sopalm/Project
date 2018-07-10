<?php
	session_start();
	include('connection.php');

	$sql = "UPDATE company SET 
			comp_name = '".$_POST["txtName"]."' ,
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE comp_id = '".$_POST["txtID"]."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_company.php';";
	echo "</script>";
?>