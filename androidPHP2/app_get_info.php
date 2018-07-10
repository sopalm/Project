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
                findSomeThing ('weight',0) => $rows['weight'],
                findSomeThing ('height',0) => $rows['height'],
                'bmi' => $rows['bmi'],
                findSomeThing ('blood_pressure',0) => $rows['blood_pressure'],
                findSomeThing ('blood_pressure_extra',0) => $rows['blood_pressure_extra'],
                'pulsation' => $rows['pulsation'],
                'pulsation_extra' => $rows['pulsation_extra'],
                findSomeThing ('underlying_disease',1) => $rows['underlying_disease'],
                findSomeThing ('medicines',1) => $rows['medicines'],
                findSomeThing ('medicines_history',1) => $rows['medicines_history'],
                findSomeThing ('herbal_bolus',1) => $rows['herbal_bolus'],
                findSomeThing ('operate',1) => $rows['operate'],
                findSomeThing ('alcohol',1) => $rows['alcohol'],
                findSomeThing ('smoke',1) => $rows['smoke']
            );
    array_push($response, $arr);

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

?>