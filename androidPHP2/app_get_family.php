<?php
    include("../connection.php");
    include("translate.php");

	$emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];
    $result = mysqli_query($con, "
        SELECT * 
        from personal_family_information 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $response = array();
 
    $rows = mysqli_fetch_array($result);
        $arr = array(
                findSomeThing ('heart',2) => $rows['heart'],
                findSomeThing ('hypertension',2) => $rows['hypertension'],
                findSomeThing ('dyslipidemia',2) => $rows['dyslipidemia'],
                findSomeThing ('diabetes_mellitus',2) => $rows['diabetes_mellitus'],
                findSomeThing ('cancer',2) => $rows['cancer']
            );
            array_push($response, $arr);
        
    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

?>