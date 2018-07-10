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
        where emp_id = '$id_card' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	 
    if($row['emp_id']){
        $sqlCommand = "UPDATE `personal_family_information` SET `heart`='$x1',`hypertension`='$x2',`dyslipidemia`='$x3',`diabetes_mellitus`='$x4',`cancer`='$x5',`date_modify`='$_SESSION[date]',`user`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no')";
            $result=mysqli_query($con,$sqlCommand)
                or die("Failed db".mysqli_error());
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_family_information`(`pfi_id`, `emp_id`, `csd_no`, `heart`, `hypertension`, `dyslipidemia`, `diabetes_mellitus`, `cancer`, `date_modify`, `user`) VALUES (NULL,'$emp_id','$csd_no','$x1','$x2,'$x3','$x4','$x5','$_SESSION[date]','$user')";
            $result=mysqli_query($con,$sqlCommand2)
                or die("Failed db".mysqli_error());
    }
	
?>