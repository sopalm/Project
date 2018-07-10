<?php
	session_start();
	include('connection.php');

	$result=mysqli_query($con,"SELECT * from user where user_name='$_POST[username]' and user_pass = '$_POST[password]'")
		or die("Failed db".mysqli_error());
	$row=mysqli_fetch_array($result);

	if($row['user_name']==$_POST['username'] && $row['user_pass']==$_POST['password'] 
		&& $_POST['username']!='' &&$_POST['password']!='' )
	{
		if ($row['user_status']=='admin') {
			$_SESSION['user_name']=$row['user_name'];
			$_SESSION['login']= '1';
			$_SESSION['status']= '1';
			echo "<script language=\"JavaScript\">";
			echo "alert('you are ".$row['user_status']."');";
			echo "window.location='home.php';";
			echo "</script>";
		}
		else{
			$_SESSION['user_name']=$row['user_name'];
			$_SESSION['login']= '1';
			$_SESSION['status']= '2';
			echo "<script language=\"JavaScript\">";
			echo "alert('you are ".$row['user_status']."');";
			echo "window.location='home.php';";
			echo "</script>";
		}
		
	}
	else //wrong user or pass
	{	
		echo "<script language=\"JavaScript\">";
		echo "alert('Invalid username or password!!!');";
		echo "window.location='index.php';";
		echo "</script>";
	}
?>
  