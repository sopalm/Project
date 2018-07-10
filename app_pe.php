<?php
	//include("app_login.php");
    $con = mysqli_connect("localhost","root","","pro_test") or die("Error: " . mysqli_error($con));
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    mysqli_set_charset($con, "utf8"); 
    $date = date("Y-m-d H:i:s") ;
    $emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
	
    $sqlCommand3 = "UPDATE `check_list` SET `cl_2`='1',`date_modify`='$date',`user`='' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no')";
            $result=mysqli_query($con,$sqlCommand3) or die("Failed db".mysqli_error());
    echo "ok";
	
?>