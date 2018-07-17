<?php
	session_start();
	include('connection.php');

	if (isset($_POST['program'])) {
		$proid = mysqli_real_escape_string($con,$_POST['pro_id']);
		$proname = mysqli_real_escape_string($con,$_POST['pro_name']);

		$sqlCommand = "INSERT INTO `program_check`(`pro_id`, `pro_name`, `date_modify`, `user`) VALUES ('$proid','$proname','$_SESSION[date]','$_SESSION[user_name]')";
		//echo $sqlCommand;
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());

		echo "<script language=\"JavaScript\">";
		echo "alert('success');";
		echo "window.location='edit_program.php';";
		echo "</script>";
	}
	if (isset($_POST['checklist'])) {
		$clname = mysqli_real_escape_string($con,$_POST['cl_name']);
		$clnameen = mysqli_real_escape_string($con,$_POST['cl_name_en']);
		$clnametag = mysqli_real_escape_string($con,$_POST['cl_name_tag']);
		
		$sqlCommand = "INSERT INTO `program_check_detail`(`checklist_id`, `checklist_name_th`, `checklist_name_en`, `checklist_name_tag`, `date_modify`, `user`) VALUES (NULL,'$clname','$clnameen','$clnametag','$_SESSION[date]','$_SESSION[user_name]')";
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());

		$query = "SELECT * FROM program_check_detail ";
        $result = mysqli_query($con,$query); 
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        	$cl_id = $row["checklist_id"];
        }
		$prono = mysqli_real_escape_string($con,$_POST['pro_no']);

		$sqlCommand2 = "INSERT INTO `program_check_u`(`pcu_id`, `pro_id`, `checklist_id`, `date_modify`, `user`) VALUES (NULL,'$prono','$cl_id','$_SESSION[date]','$_SESSION[user_name]')";
		$result2=mysqli_query($con,$sqlCommand2)
			or die("Failed db".mysqli_error());
		
		echo "<script language=\"JavaScript\">";
		//echo "alert('success');";
		//echo "window.location='edit_program.php';";
		echo "</script>";
		header("Location: edit_program.php");
	}
?>