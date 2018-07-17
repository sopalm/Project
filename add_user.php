<?php
	session_start();
	include('connection.php');

	if (isset($_POST['add_user'])) {
		$uname = mysqli_real_escape_string($con,$_POST['user_name']);
		$upass = mysqli_real_escape_string($con,$_POST['user_pass']);
		$ustatus = mysqli_real_escape_string($con,$_POST['user_status']);
		
		$sqlCommand = "INSERT INTO `user`(`user_id`, `user_name`, `user_pass`, `user_status`, `date_modify`, `user`) VALUES (NULL,'$uname','$upass','$ustatus','$_SESSION[date]','$_SESSION[user_name]')";
		
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());

		echo "<script language=\"JavaScript\">";
		//echo "alert('success');";
		//echo "window.location='edit_user.php';";
		echo "</script>";
		header("Location: edit_user.php");
	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('add fail');";
	//echo "window.location='edit_user.php';";
	echo "</script>";
	header("Location: edit_user.php");
?>