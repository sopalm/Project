<?php
	session_start();
	include('connection.php');
	$cstid = mysqli_real_escape_string($con,$_POST['cst']);
	$uid = mysqli_real_escape_string($con,$_POST['supID']);
	$cs = mysqli_real_escape_string($con,$_POST['cs']);
	if(isset($_POST['cst']))
	{
		$sqlCommand = "UPDATE `user` SET cst_id = $cstid WHERE user_id = $uid ";
		$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());
		$_SESSION['alert']='Edit';
	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('success');";
	//echo "window.location='user_check_point.php?cs_no=$cs';";
	echo "</script>";
	header("Location: user_check_point.php?cs_no=$cs");
?>
  