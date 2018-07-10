<?php
	session_start();
	include('connection.php');

	if (isset($_POST['add_user'])) {
		$sqlCommand = "INSERT INTO `user`(`user_id`, `user_name`, `user_pass`, `user_status`, `date_modify`, `user`) VALUES (NULL,'$_POST[user_name]','$_POST[user_pass]','$_POST[user_status]','$_SESSION[date]','$_SESSION[user_name]')";
		
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());

		echo "<script language=\"JavaScript\">";
		echo "alert('success');";
		echo "window.location='edit_user.php';";
		echo "</script>";
	}
	echo "<script language=\"JavaScript\">";
	echo "alert('add fail');";
	echo "window.location='edit_user.php';";
	echo "</script>";
?>