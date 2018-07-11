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

    $res = array();
    $data1 = array(findSomeThing ('underlying_disease',1), findSomeThing ('medicines',1), findSomeThing ('medicines_history',1), findSomeThing ('herbal_bolus',1), findSomeThing ('operate',1), findSomeThing ('alcohol',1), findSomeThing ('smoke',1));
    $data2 = array($rows['underlying_disease'], $rows['medicines'], $rows['medicines_history'], $rows['herbal_bolus'], $rows['operate'], $rows['alcohol'], $rows['smoke']);

    for($i=0; $i<count($data1); $i++) {
        
        $arr = array(
            "name" => $data1[$i],
            "status" => $data2[$i] 
        );
        array_push($res, $arr);
    }

    echo json_encode($res, JSON_UNESCAPED_UNICODE); 

?>