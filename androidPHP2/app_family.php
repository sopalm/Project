<?php
	include("../connection.php");
    
    $emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
	$user = $_POST['user'];
    $x1 = $_POST['x1'];
    $x2 = $_POST['x2'];
    $x3 = $_POST['x3'];
    $x4 = $_POST['x4'];
    $x5 = $_POST['x5'];
    
    $result = mysqli_query($con, "
        SELECT * 
        from personal_family_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	 
    if($row['emp_id']&&$row['csd_no']){
        $sqlCommand = "UPDATE `personal_family_information` SET`heart`= '$x1',`hypertension`= '$x2',`dyslipidemia`= '$x3',`diabetes_mellitus`= '$x4',`cancer`= '$x5',`date_modify`='$_SESSION[date]',`user_modify`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no' ";
        mysqli_query($con,$sqlCommand);
                echo $sqlCommand;
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_family_information`(`pfi_id`, `emp_id`, `csd_no`, `heart`, `hypertension`, `dyslipidemia`, `diabetes_mellitus`, `cancer`, `date_modify`, `user_modify`) VALUES (NULL,'$emp_id','$csd_no','$x1','$x2','$x3','$x4','$x5','$_SESSION[date]','$user')";
        mysqli_query($con,$sqlCommand2);
                echo $sqlCommand2;
    }
	
?>