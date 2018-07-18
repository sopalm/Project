<?php
	session_start();
	include('connection.php');
	$cid = mysqli_real_escape_string($con,$_POST['comp_num']);
	$cname = mysqli_real_escape_string($con,$_POST['comp_name']);
	$cadd = mysqli_real_escape_string($con,$_POST['comp_add']);
	$check=0;
	if(isset($_POST['comp_num']))
	{
		$sqlcheck="SELECT * FROM company";
		$result=mysqli_query($con,$sqlcheck);
		while($row=mysqli_fetch_array($result)){
			if($cid==$row['comp_id']){
				$check=1;break;
			}
		}
		if($check==1){
			echo "<script language=\"JavaScript\">";
			//echo "alert('เพิ่มข้อมูลไม่สำเร็จ เนื่องจากรหัสบริษัท ".$cid." ซ้ำ');";
			//echo "window.location='edit_company.php';";
			echo "</script>";
			$_SESSION['alert']='c_add_false';
			header('Location: edit_company.php');
		}
	
		$sqlCommand = "INSERT INTO `company`(`comp_id`, `comp_name`,`date_modify`, `user`) VALUES ('$cid','$cname','$_SESSION[date]','$_SESSION[user_name]')";
		//    mysqli_real_escape_string();  -- Escape string
			$result=mysqli_query($con,$sqlCommand)
			or die("Failed db".mysqli_error());


		$sqlCommand2 = "INSERT INTO `company_address`(`comp_id`, `address`,`date_modify`, `user`) VALUES ('$cid','$cadd','$_SESSION[date]','$_SESSION[user_name]')";
		$result1=mysqli_query($con,$sqlCommand2)
			or die("Failed db".mysqli_error());

		$_SESSION['alert']='c_add';
	}
	echo "<script language=\"JavaScript\">";
	//echo "alert('success');";
	//echo "window.location='edit_company.php';";
	echo "</script>";
	
	header('Location: edit_company.php');
?>