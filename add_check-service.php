<?php
	session_start();
	include('connection.php');
	if(isset($_POST['submit'])){
		$sqlCommand1 = "INSERT INTO `check_service`(`cs_no`, `ca_id`,`cs_date`, `cs_total_people`, `cs_status`,`date_modify`, `user`) 
						VALUES (NULL,'$_POST[add]','$_POST[cs_date]','$_POST[cs_pp]',0,'$_SESSION[date]','$_SESSION[user_name]')";
		mysqli_query($con,$sqlCommand1);

		$sqllast = "SELECT MAX(cs_no) FROM check_service";
		$resultlast = mysqli_query($con,$sqllast);
		$last = mysqli_fetch_array($resultlast);
		//echo $last[0];
		/*$sqllist = "SELECT DISTINCT `checklist_name_tag` 
                    FROM `program_check_detail`as pcd JOIN program_check_u as pcu ON pcd.checklist_id = pcu.checklist_id
                                                      JOIN check_service_detail as csd ON csd.pro_id = pcu.pro_id
                    WHERE csd.cs_no = $last[0]";
        $querylist=mysqli_query($con,$sqllist);
        while ($row=mysqli_fetch_array($querylist)) {
        	$sqltag ="INSERT INTO `check_service_tag`(`cst_id`,`cs_no`, `tag`,`date_modify`, `user`) 
						VALUES (NULL,'$last[0]','$row[0]','$_SESSION[date]','$_SESSION[user_name]') ";
        }*/
	}

	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='edit_check-service.php'";
	echo "</script>";
?>


