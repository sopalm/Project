<?php  
	include('connection.php');
	$get=$_GET['cs_no'];
	$nub=0;
    $sqlcheck="SELECT tag FROM check_service_tag WHERE cs_no=$get";
    $check=mysqli_query($con,$sqlcheck);
    if(mysqli_num_rows($check)== 0){
    	$nub=3;
    }

    $sqlputtag="SELECT DISTINCT `checklist_name_tag` 
                FROM `program_check_detail`as pcd JOIN program_check_u as pcu ON pcd.checklist_id = pcu.checklist_id
                                                   JOIN check_service_detail as csd ON csd.pro_id = pcu.pro_id
                WHERE csd.cs_no = $get";
    $puttag=mysqli_query($con,$sqlputtag);
    if($nub==0)
    {
    	while ($new=mysqli_fetch_array($puttag)) {
        	$nub=0;
        	$check=mysqli_query($con,$sqlcheck);
        	while ($old=mysqli_fetch_array($check)) {
        		if($new[0]!=$old[0]){
        			$nub=1;
        		}
        		if($new[0]==$old[0]){
        			$nub=0;break;
        		}
        	}
        	if($nub==1){
				
				$sqlputdata ="INSERT INTO `check_service_tag`(`cst_id`,`cs_no`, `tag`,`date_modify`, `user_modify`) 
                           VALUES (NULL,'$get','$new[0]','$_SESSION[date]',0) ";
            	$putdata=mysqli_query($con,$sqlputdata);
        	}
		}
    }
    else{
    	while ($row=mysqli_fetch_array($puttag)) 
	    {
	        $sqlputdata ="INSERT INTO `check_service_tag`(`cst_id`,`cs_no`, `tag`,`date_modify`, `user_modify`) 
	                       VALUES (NULL,'$get','$row[0]','$_SESSION[date]',0) ";
	        $putdata=mysqli_query($con,$sqlputdata);
		}
    }
	if($_GET['check']==0){
		header("Location: report_check_list.php?cs_no=$get");
	}else{
		header("Location: user_check_point.php?cs_no=$get");
	}
	
?>