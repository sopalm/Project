<?php
    include("../connection.php");
    include("translate.php");

	$emp_id = $_POST['idCard'];
    $csd_no = $_POST['csd_no'];

    $result = mysqli_query($con, "
        SELECT * 
        from personal_physical_examination
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $rows = mysqli_fetch_array($result);

    $res = array();
    $data1 = array(findSomeThing ('general_appearance',3), findSomeThing ('anemia',3), findSomeThing ('head_cervival_nodes',3), findSomeThing ('eyes_ear_throat_nose_mouth',3), findSomeThing ('oral_teeth',3), findSomeThing ('breath_sound',3), findSomeThing ('heartbeat',3),findSomeThing ('abdomen',3), findSomeThing ('arm_leg',3), findSomeThing ('back_bone',3), findSomeThing ('skin',3));
    $data2 = array($rows['general_appearance'], $rows['anemia'], $rows['head_cervival_nodes'], $rows['eyes_ear_throat_nose_mouth'], $rows['oral_teeth'], $rows['breath_sound'], $rows['heartbeat'],$rows['abdomen'], $rows['arm_leg'], $rows['back_bone'], $rows['skin']);


    for($i=0; $i<count($data1); $i++) {
        
        $arr = array(
            "name" => $data1[$i],
            "status" => $data2[$i] 
        );
        array_push($res, $arr);
    }

    echo json_encode($res, JSON_UNESCAPED_UNICODE); 

?>