<?php
	session_start();
	include('connection.php');
	if(isset($_POST['submit'])){
		if(!empty($_POST['check_list'])) {
		// Counting number of checked checkboxes.
		$checked_count = count($_POST['check_list']);
		// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected) {
				//echo "<p>".$selected ."</p>";
			$csno = mysqli_real_escape_string($con,$_POST['cs_no']);

			$sqlCommand = "INSERT INTO `doctor_check_service`(`cs_no`, `doc_id`,`date_modify`, `user_modify`) 
							VALUES ('$csno','$selected','$_SESSION[date]','$_SESSION[user_name]')";
				$result=mysqli_query($con,$sqlCommand);
				if (!$result)
	                  {
	                  echo("Error description: " . mysqli_error($con));
	                  }
			}
		}
		echo "<script language=\"JavaScript\">";
		//echo "alert('success');";
		//echo "window.location='check-service_list.php?cs_no=$csno'";
		echo "</script>";
		$_SESSION['alert']='ds_add';
		header("Location: check-service_list.php?cs_no=".$csno."");
	}
	
	if(isset($_POST["delete"])){
		$csno = mysqli_real_escape_string($con,$_POST['cs_no']);
		$del = mysqli_real_escape_string($con,$_POST['delete']);

		$sqldelete= " DELETE FROM doctor_check_service WHERE cs_no = '$csno' AND doc_id = '$del' ";
		$delete=mysqli_query($con,$sqldelete);
		if (!$delete)
	    {
	        echo("Error description: " . mysqli_error($con));
	    }
		echo "<script language=\"JavaScript\">";
		//echo "alert('Delete success');";
		//echo "window.location='check-service_list.php?cs_no=$csno'";
		echo "</script>";
		$_SESSION['alert']='ds_del';
		header("Location: check-service_list.php?cs_no=".$csno."");
	}

?>