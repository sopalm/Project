<?php
	session_start();
	include('connection.php');

	if (isset($_POST['program'])) {
		$sqlCommand = "INSERT INTO `program_check`(`pro_id`, `pro_name`, `date_modify`, `user_modify`) VALUES ('$_POST[pro_id]','$_POST[pro_name]','$_SESSION[date]','$_SESSION[user_name]')";
		//echo $sqlCommand;
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());

		echo "<script language=\"JavaScript\">";
		echo "alert('success');";
		echo "window.location='edit_program.php';";
		echo "</script>";
	}
	if (isset($_POST['checklist'])) {
		$sqlCommand = "INSERT INTO `program_check_detail`(`checklist_id`, `checklist_name`, `date_modify`, `user_modify`) VALUES (NULL,'$_POST[cl_name]','$_SESSION[date]','$_SESSION[user_name]')";
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());

		$query = "SELECT * FROM program_check_detail ";
        $result = mysqli_query($con,$query); 
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        	$cl_id = $row["checklist_id"];
        }

		$sqlCommand2 = "INSERT INTO `program_check_u`(`pcu_id`, `pro_id`, `checklist_id`, `date_modify`, `user_modify`) VALUES (NULL,'$_POST[pro_no]','$cl_id','$_SESSION[date]','$_SESSION[user_name]')";
		$result2=mysqli_query($con,$sqlCommand2)
			or die("Failed db".mysqli_error());
		
		echo "<script language=\"JavaScript\">";
		echo "alert('success');";
		echo "window.location='edit_program.php';";
		echo "</script>";
	}
?>