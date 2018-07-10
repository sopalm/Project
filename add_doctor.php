<?php
	session_start();
	include('connection.php');

	$sqlCommand = "INSERT INTO `doctor`(`doc_title`,`doc_name`, `doc_surname`, `doc_license`,`date_modify`, `user`) VALUES ('$_POST[title]','$_POST[name]','$_POST[surname]',
	'$_POST[doc_license]','$_SESSION[date]','$_SESSION[user_name]')";
	$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='edit_doctor.php';";
	echo "</script>";
?>
  