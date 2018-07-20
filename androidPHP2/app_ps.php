<?php

	include("../connection.php");

    $emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
    $user = mysqli_real_escape_string($con,$_POST['user']);
	$c1 = mysqli_real_escape_string($con,$_POST['c1']);
	$c2 = mysqli_real_escape_string($con,$_POST['c2']);
	$c3 = mysqli_real_escape_string($con,$_POST['c3']);
	$c4 = mysqli_real_escape_string($con,$_POST['c4']);
	$c5 = mysqli_real_escape_string($con,$_POST['c5']);
	$c6 = mysqli_real_escape_string($con,$_POST['c6']);
	$c7 = mysqli_real_escape_string($con,$_POST['c7']);

	$result = mysqli_query($con, "
        SELECT * 
        from personal_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	 
    if($row['emp_id'] && $row['csd_no']){
        $sqlCommand = "UPDATE `personal_information` SET `underlying_disease`='$c1',`medicines`='$c2',`medicines_history`='$c3',`herbal_bolus`='$c4',`operate`='$c5',`alcohol`='$c6',`smoke`='$c7',`date_modify`='$_SESSION[date]',`user_modify`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no'";
            $result=mysqli_query($con,$sqlCommand)
                or die("Failed db".mysqli_error());
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_information`(`emp_id`, `csd_no`, `underlying_disease`, `medicines`, `medicines_history`, `herbal_bolus`, `operate`, `alcohol`, `smoke`, `date_modify`, `user_modify`) VALUES ('$emp_id','$csd_no','$c1','$c2','$c3','$c4','$c5','$c6','$c7','$_SESSION[date]','$user')";
            $result=mysqli_query($con,$sqlCommand2)
                or die("Failed db".mysqli_error());
    }

?>