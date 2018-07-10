<?php
	session_start();
	include('connection.php');
	$post=$_POST["cs"];
	echo $_POST["cs"];
	$sqlCommand = "UPDATE `user` SET cst_id = $_POST[cst] WHERE user_id = $_POST[supID] ";
	$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='user_check_point.php?cs_no=$_POST[cs]';";
	echo "</script>";
?>
  