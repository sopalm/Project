<?php
	session_start();
	include('connection.php');

	if (isset($_POST['submit_cl'])) {
		$sql = "UPDATE program_check_detail SET 
				checklist_name_th = '$_POST[cl_name_th]',
				checklist_name_en = '$_POST[cl_name_en]',
				checklist_name_tag = '$_POST[cl_name_tag]',
				date_modify ='$_SESSION[date]',
				user ='$_SESSION[user_name]'
				WHERE checklist_id = '".$_POST["pcl_id_edit"]."' ";

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