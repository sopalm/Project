<?php
	session_start();
	include('connection.php');

	if (isset($_POST['change_pass'])) {
		$supID = mysqli_real_escape_string($con,$_POST['supID']);
		$passold = mysqli_real_escape_string($con,$_POST['pass_old']);
		$passnew = mysqli_real_escape_string($con,$_POST['pass_new']);
		$passconfirm = mysqli_real_escape_string($con,$_POST['pass_confirm']);
	
		$sql_pass = "SELECT * FROM user WHERE user_id = '$supID' ";
		$result_pass=mysqli_query($con,$sql_pass)
			or die("Failed db".mysqli_error());
		$check_pass =mysqli_fetch_array($result_pass);
		//echo "DB: ".$check_pass[2];
		//echo "input: ".$passold;
		if($check_pass['user_pass']==$passold)
		{
			if($passnew==$passconfirm)
			{
				if($passnew!=$passold)
				{
					$sqlCommand = "UPDATE `user` SET user_pass = '$passnew' ,date_modify ='$_SESSION[date]',user_modify ='$_SESSION[user_name]' WHERE user_id = $supID ";
					$result=mysqli_query($con,$sqlCommand)
						or die("Failed db".mysqli_error());
					$_SESSION['alert']='Edit_Pass';
				}else{
					$_SESSION['alert']='Edit_Pass_EQ';
				}
			}
			else{
				$_SESSION['alert']='Edit_Pass_Noconfirm';
			}
		}else{
			$_SESSION['alert']='Edit_Pass_false';
		}
	}
	if(isset($_POST['reset_pass'])){
		$adminid = mysqli_real_escape_string($con,$_POST['admin_id']);
		$supName = mysqli_real_escape_string($con,$_POST['supName']);
		$passadmin = mysqli_real_escape_string($con,$_POST['pass_admin']);
		$passnew = mysqli_real_escape_string($con,$_POST['pass_new']);
		$passconfirm = mysqli_real_escape_string($con,$_POST['pass_confirm']);

		$sql_pass = "SELECT * FROM user WHERE user_id = '$adminid' ";
		$result_pass=mysqli_query($con,$sql_pass)
			or die("Failed db".mysqli_error());
		$check_pass =mysqli_fetch_array($result_pass);
		//echo "DB: ".$check_pass[2];
		//echo "input: ".$passold;
		if($check_pass['user_pass']==$passadmin)
		{
			if($passnew==$passconfirm)
			{
				$sqlCommand = "UPDATE `user` SET user_pass = '$passnew',date_modify ='$_SESSION[date]',user_modify ='$_SESSION[user_name]' WHERE user_id = $supName ";
				$result=mysqli_query($con,$sqlCommand)
					or die("Failed db".mysqli_error());
				$_SESSION['alert']='Edit_Pass';

			}
			else{
				$_SESSION['alert']='Edit_Pass_Noconfirm';
			}
		}else{
			$_SESSION['alert']='Edit_Pass_admin_false';
		}
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>