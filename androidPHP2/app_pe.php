<?php
	include("../connection.php");
    include("translate.php");
    
    $date = date("Y-m-d H:i:s") ;
    $emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
	
    
	
?>