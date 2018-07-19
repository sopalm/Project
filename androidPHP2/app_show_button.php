<?php
	include("../connection.php");
    
    $emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
    
	$result = mysqli_query($con, "SELECT * FROM check_tags JOIN check_list ON check_tags.check_id = check_list.check_id WHERE  check_list.emp_id = '$emp_id' AND check_list.csd_no = '$csd_no' ")
        or die("Failed db".mysqli_error());
    
    $response = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $arr = array(
            'id' => $row['ct_id'], 
            'name' => $row['tag'],
            'status' => $row['tag_status']
        );
        array_push($response, $arr);
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>