<?php
	session_start();
	include('connection.php');

	if (isset($_POST['submit_pro'])) {
		$sql = "UPDATE program_check SET 
				pro_name = '".$_POST["pro_name_edit"]."',
				date_modify ='$_SESSION[date]',
				user ='$_SESSION[user_name]'
				WHERE pro_id = '".$_POST["pro_id_edit"]."' ";

		$query = mysqli_query($con,$sql);

		echo "<script language=\"JavaScript\">";
		echo "alert('Upload Success');";
		echo "window.location='edit_program.php';";
		echo "</script>";
	}
	echo "<script language=\"JavaScript\">";
	echo "alert('Upload failed');";
	echo "window.location='edit_program.php';";
	echo "</script>";
?>