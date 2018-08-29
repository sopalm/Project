<?php
	session_start();
	include('connection.php');
	$uname = mysqli_real_escape_string($con,$_POST['username']);
	$upass = mysqli_real_escape_string($con,$_POST['password']);
	
	$result=mysqli_query($con,"SELECT * from user where user_name ='$uname' ")
		or die("Failed db".mysqli_error());
	$row=mysqli_fetch_array($result);

	$pass = $row['user_pass'];

	if($row['user_name']  && password_verify($upass,$pass)
		&& $uname!='' &&$upass!='' )
	{
		if ($row['user_status']=='admin') {
			$_SESSION['user_name']=$row['user_name'];
			$_SESSION['login']= '1';
			$_SESSION['status']= '1';
			$_SESSION['alert']='loginSuccess';
			header('Location: edit_check-service.php');
			exit;
		}
		else{
			$_SESSION['user_name']=$row['user_name'];
			$_SESSION['login']= '1';
			$_SESSION['status']= '2';
			$_SESSION['alert']='loginSuccess';
			header('Location: edit_check-service.php');
		}
		
	}
	else //wrong user or pass
	{	
		echo "<script language=\"JavaScript\">";
		echo "alert('Invalid username or password!!!');";
		// echo "window.location='index.php';";
		echo "</script>";
		$_SESSION['alert']='loginFalse';
		header('Location: index.php');
	}
?>
  