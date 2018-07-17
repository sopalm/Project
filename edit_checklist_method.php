<?php
	session_start();
	include('connection.php');
	$nameth = mysqli_real_escape_string($con,$_POST['cl_name_th']);
	$nameen = mysqli_real_escape_string($con,$_POST['cl_name_en']);
	$nametag = mysqli_real_escape_string($con,$_POST['cl_name_tag']);
	$pclid = mysqli_real_escape_string($con,$_POST['pcl_id_edit']);

	if (isset($_POST['submit_cl'])) {
		$sql = "UPDATE program_check_detail SET 
				checklist_name_th = '$nameth',
				checklist_name_en = '$nameen',
				checklist_name_tag = '$nametag',
				date_modify ='$_SESSION[date]',
				user ='$_SESSION[user_name]'
				WHERE checklist_id = '".$pclid."' ";

		$query = mysqli_query($con,$sql);

		echo "<script language=\"JavaScript\">";
		//echo "alert('Upload Success');";
		//echo "window.location='edit_program.php';";
		echo "</script>";
		header("Location: edit_program.php");

	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('Upload failed');";
	//echo "window.location='edit_program.php';";
	echo "</script>";
	header("Location: edit_program.php");
?>