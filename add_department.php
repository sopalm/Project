<?php
	session_start();
	include('connection.php');

	$check =0;
	$dc = mysqli_real_escape_string($con,$_POST['dep_comp']);

	if(isset($_POST['dep_name'])&&!empty($_POST['dep_name']))
	{
		$querycheck = "SELECT * FROM department ";
		$resultcheck = mysqli_query($con,$querycheck); 
			while($row=mysqli_fetch_array($resultcheck,MYSQLI_ASSOC)){
				if($_POST["dep_name"]==$row["dep_name"]){
					$check=$row["dep_id"];
				}
			}
		if($check==0)    
		{
			
			$dname = mysqli_real_escape_string($con,$_POST['dep_name']);

			$sqlCommand = "INSERT INTO `department`(`dep_name`,`date_modify`, `user_modify`) VALUES ('$dname','$_SESSION[date]','$_SESSION[user_name]')";
			//echo $sqlCommand ;
			$result=mysqli_query($con,$sqlCommand)
				or die("Failed db".mysqli_error());
		
			$query = "SELECT * FROM department ";
			$id = mysqli_query($con,$query); 
				while($row=mysqli_fetch_array($id,MYSQLI_ASSOC)){
					$last_id = $row["dep_id"];
				}
			

			$sqlCommand2 = "INSERT INTO `dep_comp`(`dep_comp_no`,`comp_id`, `dep_id`,`date_modify`, `user_modify`) VALUES (NULL,'$dc','$last_id','$_SESSION[date]','$_SESSION[user_name]')";
			$result2=mysqli_query($con,$sqlCommand2)
				or die("Failed db".mysqli_error());
		}
		else
		{

			$sqlCommand3 = "INSERT INTO `dep_comp`(`dep_comp_no`,`comp_id`, `dep_id`,`date_modify`, `user_modify`) VALUES (NULL,'$dc','$check','$_SESSION[date]','$_SESSION[user_name]')";
			$result3=mysqli_query($con,$sqlCommand3)
				or die("Failed db".mysqli_error());
		}
		$_SESSION['alert']='d_add';
	}
	if(!empty($_POST['check_list'])) {
		// Counting number of checked checkboxes.
		$checked_count = count($_POST['check_list']);
		//echo "You have selected following ".$checked_count." option(s): <br/>";
		// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected) {
				//echo "<p>".$selected ."</p>";
			$sqlCommand = "INSERT INTO `dep_comp`(`dep_comp_no`,`comp_id`, `dep_id`,`date_modify`, `user_modify`) VALUES (NULL,'$dc','$selected','$_SESSION[date]','$_SESSION[user_name]')";
				$result=mysqli_query($con,$sqlCommand);
				if (!$result)
					{
						echo("Error description: " . mysqli_error($con));
					}
			}
			$_SESSION['alert']='d_add';	
	}

	
	header('Location: edit_company.php');
?>
  