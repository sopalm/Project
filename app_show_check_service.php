<?php
	include("connection.php");
    
	$result = mysqli_query($con, "SELECT * from check_service JOIN company_address ON check_service.ca_id = company_address.ca_id
    JOIN company ON company.comp_id = company_address.comp_id where cs_date = '$date' ")
        or die("Failed db".mysqli_error());
    $response = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
       $arr = array(
            'cs_no' => $row['cs_no'], 
            'name' => $row['comp_name'],
            'address' => $row['address']
        );
        array_push($response, $arr);
    }
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
?>