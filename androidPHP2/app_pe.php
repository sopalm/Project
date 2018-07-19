<?php
	include("../connection.php");
    include("translate.php");
    
    $date = date("Y-m-d H:i:s") ;
    $emp_id = mysqli_real_escape_string($con,$_POST['idCard']);
    $csd_no = mysqli_real_escape_string($con,$_POST['csd_no']);
    $pe1 = mysqli_real_escape_string($con,$_POST['pe1']);
    $pe2 = mysqli_real_escape_string($con,$_POST['pe2']);
    $pe3 = mysqli_real_escape_string($con,$_POST['pe3']);
    $pe4 = mysqli_real_escape_string($con,$_POST['pe4']);
    $pe5 = mysqli_real_escape_string($con,$_POST['pe5']);
    $pe6 = mysqli_real_escape_string($con,$_POST['pe6']);
    $pe7 = mysqli_real_escape_string($con,$_POST['pe7']);
    $pe8 = mysqli_real_escape_string($con,$_POST['pe8']);
    $pe9 = mysqli_real_escape_string($con,$_POST['pe9']);
    $pe10 = mysqli_real_escape_string($con,$_POST['pe10']);
    $pe11 = mysqli_real_escape_string($con,$_POST['pe11']);
    $user = $_POST['user'];

    $result = mysqli_query($con, "
        SELECT * 
        from personal_physical_examination 
        where emp_id = '$emp_id' AND csd_no = '$csd_no' "
    ) or die("Failed db".mysqli_error());
    $row = mysqli_fetch_array($result);	
    if($row['emp_id'] && $row['csd_no']){
        $sqlCommand = "UPDATE `personal_physical_examination` SET `general_appearance`='$pe1',`anemia`='$pe2',`head_cervival_nodes`='$pe3',`eyes_ear_throat_nose_mouth`='$pe4',`oral_teeth`='$pe5',`breath_sound`='$pe6',`heartbeat`='$pe7',`abdomen`='$pe8',`arm_leg`='$pe9',`back_bone`='$pe10',`skin`='$pe11',`date_modify`='$date',`user`='$user' WHERE WHERE emp_id = '$emp_id' AND csd_no = '$csd_no'";
            $result=mysqli_query($con,$sqlCommand)
                or die("Failed db".mysqli_error());
    }  
    else{
        $sqlCommand2 = "INSERT INTO `personal_physical_examination`(`ppe_id`,`emp_id`, `csd_no`, `general_appearance`, `anemia`, `head_cervival_nodes`, `eyes_ear_throat_nose_mouth`, `oral_teeth`, `breath_sound`, `heartbeat`, `abdomen`, `arm_leg`, `back_bone`, `skin`, `date_modify`, `user`) VALUES (null,'$emp_id','$csd_no','$pe1','$pe2','$pe3','$pe4','$pe5','$pe6','$pe7','$pe8','$pe9','$pe10','$pe11','$date','$user')";
            $result=mysqli_query($con,$sqlCommand2)
                or die("Failed db".mysqli_error());
    }

	
    
	
?>