<?php
	session_start();
	include('connection.php');

	$sql = "UPDATE doctor SET 
			doc_title = '".$_POST["txtTitle"]."' ,
			doc_name = '".$_POST["txtName"]."' ,
			doc_surname = '".$_POST["txtSurname"]."',
			doc_license = '".$_POST["txtLicen"]."',
			date_modify ='$_SESSION[date]',
			user ='$_SESSION[user_name]'
			WHERE doc_id = '".$_POST["txtID"]."' ";

	$query = mysqli_query($con,$sql);

	echo "<script language=\"JavaScript\">";
	echo "alert('Upload Success');";
	echo "window.location='edit_doctor.php';";
	echo "</script>";
?>