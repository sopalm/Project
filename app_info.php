<?php
	include("app_login.php");
    
    $emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bp = $_POST['Bp'];
    $bp2 = $_POST['Bp2'];
    $bmi = $weight/(pow(($height/100),2));
	$user = $_POST['user'];
    $result = mysqli_query($con, "
        SELECT * 
        from personal_information 
        where emp_id = '$id_card' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	 
    if($row['emp_id']){
        $sqlCommand = "UPDATE `personal_information` SET `weight`='$weight',`height`='$height',`bmi`='$bmi',`blood_pressure`='$bp',`blood_pressure_extra`='$bp2',`date_modify`='$_SESSION[date]',`user`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no')";
            $result=mysqli_query($con,$sqlCommand)
                or die("Failed db".mysqli_error());
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_information`(`emp_id`, `csd_no`, `weight`, `height`, `bmi`, `blood_pressure`, `blood_pressure_extra`, `date_modify`, `user`) VALUES ('$emp_id','$csd_no','$weight','$height','$bmi','$bp','$bp2','$_SESSION[date]','$user')";
            $result=mysqli_query($con,$sqlCommand2)
                or die("Failed db".mysqli_error());
    }
    // $sqlCommand3 = "UPDATE `check_list` SET `cl_1`='1' WHERE csd_no = '$csd_no' AND emp_id = '$emp_id'";
    // $result=mysqli_query($con,$sqlCommand3) or die("Failed db".mysqli_error());
	
?>