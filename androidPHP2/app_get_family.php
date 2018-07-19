<?php
    include("../connection.php");
    include("translate.php");

	$emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
    $result = mysqli_query($con, "
        SELECT * 
        from personal_family_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $rows = mysqli_fetch_array($result);

    $res = array();
    $data1 = array(findSomeThing ('heart',2), findSomeThing ('hypertension',2), findSomeThing ('dyslipidemia',2), findSomeThing ('diabetes_mellitus',2), findSomeThing ('cancer',2));
    $data2 = array($rows['heart'], $rows['hypertension'], $rows['dyslipidemia'], $rows['diabetes_mellitus'], $rows['cancer']);

    for($i=0; $i<count($data1); $i++) {
        
        $arr = array(
            "name" => $data1[$i],
            "status" => $data2[$i] 
        );
        array_push($res, $arr);
    }

    echo json_encode($res, JSON_UNESCAPED_UNICODE); 


?>