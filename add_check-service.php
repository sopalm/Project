<?php
	session_start();
	include('connection.php');
	if(isset($_POST['submit'])){
		
		$cadd = mysqli_real_escape_string($con,$_POST['add']);
		$csdate = mysqli_real_escape_string($con,$_POST['cs_date']);
		$cspp = mysqli_real_escape_string($con,$_POST['cs_pp']);

		$sqlCommand1 = "INSERT INTO `check_service`(`cs_no`, `ca_id`,`cs_date`, `cs_total_people`, `cs_status`,`date_modify`, `user`) 
						VALUES (NULL,'$cadd','$csdate','$cspp',0,'$_SESSION[date]','$_SESSION[user_name]')";
		mysqli_query($con,$sqlCommand1);

		$sqllast = "SELECT MAX(cs_no) FROM check_service";
		$resultlast = mysqli_query($con,$sqllast);
		$last = mysqli_fetch_array($resultlast);
		$_SESSION['alert']='cs_add';
	}

	//echo "<script language=\"JavaScript\">";
	//echo "alert('success');";
	//echo "window.location='edit_check-service.php'";
	//echo "</script>";
	
	header("Location: edit_check-service.php");
?>


