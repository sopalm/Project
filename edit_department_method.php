<?php
	session_start();
	include('connection.php');

	$sql = "UPDATE dep_comp SET 
			comp_id = '".$_POST["txtcomp_id"]."' ,
			dep_id = '".$_POST["txtdep_id"]."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE dep_comp_no = '".$_POST["txtID"]."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_company.php';";
	echo "</script>";
?>