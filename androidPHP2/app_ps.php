<?php

	include("../connection.php");

    $emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
    $user = $_POST['user'];
	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];
	$c3 = $_POST['c3'];
	$c4 = $_POST['c4'];
	$c5 = $_POST['c5'];
	$c6 = $_POST['c6'];
	$c7 = $_POST['c7'];

	$result = mysqli_query($con, "
        SELECT * 
        from personal_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	 
    if($row['emp_id'] && $row['csd_no']){
        $sqlCommand = "UPDATE `personal_information` SET `underlying_disease`='$c1',`medicines`='$c2',`medicines_history`='$c3',`herbal_bolus`='$c4',`operate`='$c5',`alcohol`='$c6',`smoke`='$c7',`date_modify`='$_SESSION[date]',`user`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no'";
        echo $sqlCommand;
            $result=mysqli_query($con,$sqlCommand)
                or die("Failed db".mysqli_error());
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_information`(`emp_id`, `csd_no`, `underlying_disease`, `medicines`, `medicines_history`, `herbal_bolus`, `operate`, `alcohol`, `smoke`, `date_modify`, `user`) VALUES ('$emp_id','$csd_no','$c1','$c2','$c3','$c4','$c5','$c6','$c7','$_SESSION[date]','$user')";
        echo $sqlCommand2;
            $result=mysqli_query($con,$sqlCommand2)
                or die("Failed db".mysqli_error());
    }

?>