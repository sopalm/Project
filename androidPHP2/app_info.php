<?php
	include("../connection.php");
    
    $emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
    $weight = mysqli_real_escape_string($con,$_POST['weight']);
    $height = mysqli_real_escape_string($con,$_POST['height']);
    $bp = mysqli_real_escape_string($con,$_POST['Bp']);
    $bp2 = mysqli_real_escape_string($con,$_POST['Bp2']);
    $bmi = $weight/(pow(($height/100),2));
	$user = $_POST['user'];
    $result = mysqli_query($con, "
        SELECT * 
        from personal_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	 
    if($row['emp_id']&&$row['csd_no']){
        $sqlCommand = "UPDATE `personal_information` SET `weight`='$weight',`height`='$height',`bmi`='$bmi',`blood_pressure`='$bp',`blood_pressure_extra`='$bp2',`date_modify`='$_SESSION[date]',`user_modify`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no' ";
            $result=mysqli_query($con,$sqlCommand)
                or die("Failed db".mysqli_error());
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_information`(`pi_id`,`emp_id`, `csd_no`, `weight`, `height`, `bmi`, `blood_pressure`, `blood_pressure_extra`, `date_modify`, `user_modify`) VALUES (NUll,'$emp_id','$csd_no','$weight','$height','$bmi','$bp','$bp2','$_SESSION[date]','$user')";
            $result=mysqli_query($con,$sqlCommand2)
                or die("Failed db".mysqli_error());
    }

	
?>