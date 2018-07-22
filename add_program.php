<?php
	session_start();
	include('connection.php');

	if (isset($_POST['program'])) {
		$proid = mysqli_real_escape_string($con,$_POST['pro_id']);
		$proname = mysqli_real_escape_string($con,$_POST['pro_name']);

		$sqlCommand = "INSERT INTO `program_check`(`pro_id`, `pro_name`, `date_modify`, `user_modify`) VALUES ('$proid','$proname','$_SESSION[date]','$_SESSION[user_name]')";
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
		if (!empty($_POST['cl_name'])&&!empty($_POST['cl_name_en'])&&!empty($_POST['cl_name_tag']))
		{
			$sqlCommand = "INSERT INTO `program_check_detail`(`checklist_id`, `checklist_name_th`, `checklist_name_en`, `checklist_name_tag`, `date_modify`, `user_modify`) VALUES (NULL,'$clname','$clnameen','$clnametag','$_SESSION[date]','$_SESSION[user_name]')";
			$result=mysqli_query($con,$sqlCommand)
				or die("Failed db".mysqli_error());

			$query = "SELECT * FROM program_check_detail ";
			$result = mysqli_query($con,$query); 
			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$cl_id = $row["checklist_id"];
			}
			$prono = mysqli_real_escape_string($con,$_POST['pro_no']);

			$sqlCommand2 = "INSERT INTO `program_check_u`(`pcu_id`, `pro_id`, `checklist_id`, `date_modify`, `user_modify`) VALUES (NULL,'$prono','$cl_id','$_SESSION[date]','$_SESSION[user_name]')";
			$result2=mysqli_query($con,$sqlCommand2)
				or die("Failed db".mysqli_error());
		}	
		if(!empty($_POST['check_list'])) {

			$checked_count = count($_POST['check_list']);

			// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected) {
						//echo "<p>".$selected ."</p>";
						$query1 = "SELECT * FROM program_check_detail ";
						$result1 = mysqli_query($con,$query1); 
						while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
							$cl_id = $selected;
						}
						$prono = mysqli_real_escape_string($con,$_POST['pro_no']);
				
						$sqlCommand3 = "INSERT INTO `program_check_u`(`pcu_id`, `pro_id`, `checklist_id`, `date_modify`, `user_modify`) VALUES (NULL,'$prono','$cl_id','$_SESSION[date]','$_SESSION[user_name]')";
						$result3=mysqli_query($con,$sqlCommand3)
							or die("Failed db".mysqli_error());
			}

		}

		$_SESSION['alert']='pro_add';
		header("Location: edit_program.php");
	}
?>