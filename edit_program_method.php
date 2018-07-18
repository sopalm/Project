<?php
	session_start();
	include('connection.php');
	$name = mysqli_real_escape_string($con,$_POST['pro_name_edit']);
	$id = mysqli_real_escape_string($con,$_POST['pro_id_edit']);

	if (isset($_POST['submit_pro'])) {
		$sql = "UPDATE program_check SET 
				pro_name = '".$name."',
				date_modify ='$_SESSION[date]',
				user ='$_SESSION[user_name]'
				WHERE pro_id = '".$id."' ";

		$query = mysqli_query($con,$sql);

		echo "<script language=\"JavaScript\">";
		//echo "alert('Upload Success');";
		//echo "window.location='edit_program.php';";
		echo "</script>";
		$_SESSION['alert']='Edit';
	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload failed');";
	//echo "window.location='edit_program.php';";
	echo "</script>";
	header("Location: edit_program.php");
?>