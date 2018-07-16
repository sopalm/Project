<?php
	session_start();
	include('connection.php');
	$cid = mysqli_real_escape_string($con,$_POST['txtcomp_id']);
	$did = mysqli_real_escape_string($con,$_POST['txtdep_id']);
	$dcid = mysqli_real_escape_string($con,$_POST['txtID']);

	$sql = "UPDATE dep_comp SET 
			comp_id = '".$cid."' ,
			dep_id = '".$did."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE dep_comp_no = '".$dcid."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_company.php';";
	echo "</script>";
?>