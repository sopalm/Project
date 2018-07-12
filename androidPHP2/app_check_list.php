<?php
	include("../connection.php");
    
    $emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
    $tag_id = $_POST['tag_id'];
    $user = $_POST['user'];


    $sqlCommand = "UPDATE `check_tags` SET `tag_status` = '1' ,`date_modify`= '$_SESSION[date]',`user`='$user' WHERE ct_id = '$tag_id' ";
    mysqli_query($con,$sqlCommand) or die("Failed db".mysqli_error());

    $sqlCommand = "UPDATE `check_list` SET `regis` = '1' ,`date_modify`= '$_SESSION[date]',`user`='$user' WHERE emp_id = '$emp_id' AND csd_no = '$csd_no' ";
    mysqli_query($con,$sqlCommand) or die("Failed db".mysqli_error());

?>