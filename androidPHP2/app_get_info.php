<?php
	include("../connection.php");
	include("translate.php");

	$emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
    $result = mysqli_query($con, "
        SELECT * 
        from personal_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $rows = mysqli_fetch_array($result);
    $response = array();
 
        $arr = array(
                findSomeThing('weight',0) => $rows['weight'],
                findSomeThing('height',0) => $rows['height'],
                'bmi' => $rows['bmi'],
                findSomeThing('blood_pressure',0) => $rows['blood_pressure'],
                findSomeThing('blood_pressure_extra',0) => $rows['blood_pressure_extra'],
                'pulsation' => $rows['pulsation'],
                'pulsation_extra' => $rows['pulsation_extra'],
            );
    array_push($response, $arr);

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

?>