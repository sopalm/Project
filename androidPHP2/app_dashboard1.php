<?php
	include("../connection.php");
    include("../function.php");
     
    $id_card = mysqli_real_escape_string($con,$_POST['idCard']);
    $cs_no = mysqli_real_escape_string($con,$_POST['csNo']);
		   
	$result = mysqli_query($con, "SELECT * from employee JOIN check_list ON employee.emp_id = check_list.emp_id JOIN check_service_detail ON check_list.csd_no = check_service_detail.csd_no JOIN program_check ON program_check.pro_id = check_service_detail.pro_id WHERE check_list.emp_id = '$id_card' AND check_service_detail.cs_no = '$cs_no' ")
        or die("Failed db".mysqli_error());

    $response = array();
 
    while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $arr = array(
                'no' => $rows['emp_no'],
                'name' => $rows['emp_title']." ".$rows['emp_name']." ".$rows['emp_surname'],
                'age' => $rows['emp_age'],
                'bd' => DateThaietc($rows['emp_bd']),
                'pro' => $rows['pro_name'],
                'csd' => $rows['csd_no']
            );
            array_push($response, $arr);
        }  
    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

?>