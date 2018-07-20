<?php
	include("../connection.php");
    
    $emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
    $tag_id = mysqli_real_escape_string($con,$_POST['tag_id']);
    $user = mysqli_real_escape_string($con,$_POST['user']);


    $sqlCommand = "UPDATE `check_tags` SET `tag_status` = '1' ,`date_modify`= '$_SESSION[date]',`user_modify`='$user' WHERE ct_id = '$tag_id' ";
    mysqli_query($con,$sqlCommand) or die("Failed db".mysqli_error());

    $sqlCommand = "UPDATE `check_list` SET `regis` = '1' ,`date_modify`= '$_SESSION[date]',`user_modify`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no' ";
    mysqli_query($con,$sqlCommand) or die("Failed db".mysqli_error());

?>