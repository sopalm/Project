<?php
	session_start();
	include('connection.php');

	$sql = "UPDATE employee SET 
			emp_title = '".$_POST["txtTitle"]."' ,
			emp_name = '".$_POST["txtName"]."',
			emp_surname = '".$_POST["txtSurname"]."' ,
			emp_bd = '".$_POST["txtBD"]."' ,
			emp_age = '".$_POST["txtAge"]."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]' 
			WHERE emp_id = '".$_POST["txtID"]."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_company.php';";
	echo "</script>";
?>