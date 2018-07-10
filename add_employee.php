<?php
	session_start();
	include_once('connection.php');
	include "qrlib.php"; 

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	$PNG_WEB_DIR = 'temp/';
	if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $errorCorrectionLevel = 'H';

    $matrixPointSize = 8;

    if (isset($_POST["submit_emp"])) {
	    if (check_id($_POST['emp_id']) == false ) {
	    	


	    	echo "<script language=\"JavaScript\">";
			echo "alert('Failed');";
			echo "window.location='regis_emp.php?cs_no=$_POST[emp_check_no]';";
			echo "</script>";
	    }
	    else{
			$filename = $PNG_TEMP_DIR.md5($_POST['emp_id'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	    	QRcode::png($_POST['emp_id'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);      
	         
	   		$path_qr = $PNG_WEB_DIR.basename($filename);
	    	$date = date("Y-m-d", strtotime($_POST['birthday']) );

	    	$sql = "SELECT `dep_comp_no` FROM `dep_comp` WHERE dep_id='$_POST[dep]' AND comp_id = '$_POST[comp]' ";
	    	$result=mysqli_query($con,$sql);
            while ($row=mysqli_fetch_array($result)) {
            	$dep_comp = $row[0];
            }
	    	
	    	$sqlCommand = "INSERT INTO `employee`(`emp_id`, `emp_title`, `emp_name`, `emp_surname`, `emp_bd`, `emp_age`, `emp_qrcode`, `dep_comp_no`,`emp_no`,`date_modify`, `user`) VALUES ('$_POST[emp_id]','$_POST[title]','$_POST[emp_name]','$_POST[emp_surname]','$date','$_POST[age]','$path_qr','$dep_comp','$_POST[emp_num]','$_SESSION[date]','$_SESSION[user_name]')";
			$result=mysqli_query($con,$sqlCommand)
				or die("Failed db".mysqli_error());
				
			if (check_csd($_POST['emp_check_no'],$_POST['emp_pro']) == true ) {
	    		$sqlCommand1 = "INSERT INTO `check_service_detail`(`csd_no`, `cs_no`, `pro_id`, `csd_pro_people`, `date_modify`, `user`) VALUES (NULL,'$_POST[emp_check_no]','$_POST[emp_pro]','1','$_SESSION[date]','$_SESSION[user_name]')";
	    		$result=mysqli_query($con,$sqlCommand1)
				or die("Failed db".mysqli_error());
	    	}
	    	else{
	    		$sqlCommand2 = "UPDATE `check_service_detail` SET `csd_pro_people` = csd_pro_people+1,`date_modify`= '$_SESSION[date]',`user`= '$_SESSION[user_name]' WHERE `cs_no` = '$_POST[emp_check_no]' AND `pro_id` = '$_POST[emp_pro]'";
	    		$result=mysqli_query($con,$sqlCommand2)
				or die("Failed db".mysqli_error());
	    	}

	    	$sqlCommand3 = "UPDATE `check_service` SET `cs_total_people`= cs_total_people+1,`date_modify`='$_SESSION[date]',`user`='$_SESSION[user_name]' WHERE `cs_no` = '$_POST[emp_check_no]'";
	    	$result=mysqli_query($con,$sqlCommand3)
				or die("Failed db".mysqli_error());

	    	$keb = 0;
	    	$sqlCommand4 = "SELECT `csd_no` FROM `check_service_detail` WHERE cs_no ='$_POST[emp_check_no]' AND pro_id ='$_POST[emp_pro]'";
	    	$result=mysqli_query($con,$sqlCommand4);
            while ($row=mysqli_fetch_array($result)) {
            	$keb = $row[0];
            }


	    	$sqlCommand5 = "INSERT INTO `check_list`(`check_id`, `emp_id`, `csd_no`, `regis`, `quantity_bf`, `quantity_at`, `date_modify`, `user`) VALUES (NULL,'$_POST[emp_id]','$keb',0,0,0,'$_SESSION[date]','$_SESSION[user_name]')";
	    	$result=mysqli_query($con,$sqlCommand5)
				or die("Failed db".mysqli_error());
			$sqlcl = "SELECT check_id FROM check_list WHERE emp_id = '$_POST[emp_id]' AND csd_no = '$keb' ";
			$resultcl = mysqli_query($con,$sqlcl);
			$cl = mysqli_fetch_array($resultcl);

			$sqlTag ="SELECT DISTINCT `checklist_name_tag` 
						FROM `program_check_detail`as pcd JOIN program_check_u as pcu ON pcd.checklist_id = pcu.checklist_id
						WHERE pcu.pro_id = '$_POST[emp_pro]' ";
			$resultTag = mysqli_query($con,$sqlTag);
			while ($row=mysqli_fetch_array($resultTag)) {
            	$sqlct = "INSERT INTO check_tags(ct_id,check_id,tag,quantity,tag_status) VALUES(NULL,'$cl[check_id]','$row[checklist_name_tag]',NULL,0)";
            	$resultct = mysqli_query($con,$sqlct);
            }

			echo "<script language=\"JavaScript\">";
			echo "alert('success');";
			echo "window.location='check-service_list.php?cs_no=$_POST[emp_check_no]';";
			echo "</script>";
	    }
		
		
	}

//excel---------------------------------------------------------------------

	if (isset($_POST["submit_excel"])) {
		for ($i=0; $i < $_POST['nub'] ; $i++) {
			
			$a = $_POST["a$i"];
			$b = $_POST["b$i"];
			$c = $_POST["c$i"];
			$d = $_POST["d$i"];
			$e = $_POST["e$i"];
			$f = $_POST["f$i"];
			$g = $_POST["g$i"];
			$h = $_POST["h$i"];
			$dep = $_POST["emp_dep$i"];
			$pro = $_POST["emp_pro$i"];
			$date = date("Y-m-d", strtotime($g) );

			$sqlcomp="SELECT c.comp_id FROM company as c JOIN company_address as ca ON c.comp_id = ca.comp_id
														JOIN check_service as cs ON cs.ca_id = ca.ca_id
						WHERE cs.cs_no = '$_POST[emp_check_no]'";
			$resultcomp =mysqli_query($con,$sqlcomp);
			$comp =mysqli_fetch_array($resultcomp);
			$sqldep ="SELECT DISTINCT dc.dep_comp_no FROM department as d
									JOIN dep_comp as dc ON dc.dep_id = d.dep_id 
									JOIN company as c ON c.comp_id = dc.comp_id
						WHERE d.dep_name = TRIM('$dep') AND dc.comp_id = '$comp[0]' ";
			$resultdep =mysqli_query($con,$sqldep);
			$deparray =mysqli_fetch_array($resultdep);
			$dep=$deparray[0];

			$sqlpro ="SELECT pro_id FROM program_check WHERE pro_name = TRIM('$pro') ";
			$resultpro =mysqli_query($con,$sqlpro);
			$proarray =mysqli_fetch_array($resultpro);
			$pro=$proarray[0];
			//echo "step 1////";
			if (check_id($b) == false) {
				$sql = "UPDATE `employee` SET `VN`='$c',`emp_title`='$d',`emp_name`='$e',`emp_surname`='$f',`emp_age`='$h',`dep_comp_no`='$dep,`emp_no`='$a',`date_modify`='$_SESSION[date]',`user`= '$_SESSION[user_name]' WHERE emp_id = '$b' ";
	    		$result=mysqli_query($con,$sql);
			}
			else{
				$filename = $PNG_TEMP_DIR.md5($b.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
		    	QRcode::png($b, $filename, $errorCorrectionLevel, $matrixPointSize, 2);      
		         
		    	$path_qr = $PNG_WEB_DIR.basename($filename);

				$sqlCommand = "INSERT INTO `employee`(`emp_id`,`VN`, `emp_title`, `emp_name`, `emp_surname`, `emp_bd`, `emp_age`, `emp_qrcode`, `dep_comp_no`,`emp_no`,`date_modify`, `user`) VALUES ('$b','$c','$d','$e','$f','$date','$h','$path_qr','$dep','$a','$_SESSION[date]','$_SESSION[user_name]')";
				$result=mysqli_query($con,$sqlCommand)
					or die("Failed db".mysqli_error());
					//echo $sqlCommand;
			}
			//echo "step 2////";
			if (check_cs_no($b,$_POST['emp_check_no']) == true) {
				//echo "step 3////";
				if (check_csd($_POST['emp_check_no'],$pro) == true ) {
		    		$sqlCommand1 = "INSERT INTO `check_service_detail`(`csd_no`, `cs_no`, `pro_id`, `csd_pro_people`, `date_modify`, `user`) VALUES (NULL,'$_POST[emp_check_no]','$pro','1','$_SESSION[date]','$_SESSION[user_name]')";
		    			$result=mysqli_query($con,$sqlCommand1)
							or die("Failed db".mysqli_error());
							echo "mai som";
		    	}
		    	else{
		    		$sqlCommand2 = "UPDATE `check_service_detail` SET `csd_pro_people` = csd_pro_people+1,`date_modify`= '$_SESSION[date]',`user`= '$_SESSION[user_name]' WHERE `cs_no` = '$_POST[emp_check_no]' AND `pro_id` = '$pro'";
		    		$result=mysqli_query($con,$sqlCommand2)
							or die("Failed db".mysqli_error());
							echo "som";
		    	}
		    	//echo "step 4////";
		    	$sqlCommand3 = "UPDATE `check_service` SET `cs_total_people`= cs_total_people+1,`date_modify`='$_SESSION[date]',`user`= '$_SESSION[user_name]' WHERE `cs_no` = '$_POST[emp_check_no]'";
		    	$result=mysqli_query($con,$sqlCommand3)
							or die("Failed db".mysqli_error());

		    	$keb = 0;
		    	$sqlCommand4 = "SELECT `csd_no` FROM `check_service_detail` WHERE cs_no ='$_POST[emp_check_no]' AND pro_id ='$pro'";
		    	$result=mysqli_query($con,$sqlCommand4);
	            while ($row=mysqli_fetch_array($result)) {
	            	$keb = $row[0];
	            }

				$sqlCommand5 = "INSERT INTO `check_list`(`check_id`, `emp_id`, `csd_no`, `date_modify`, `user`) VALUES (NULL,'$b','$keb','$_SESSION[date]','$_SESSION[user_name]')";
		    	$result=mysqli_query($con,$sqlCommand5)
						or die("Failed db".mysqli_error());

				$sqlcl = "SELECT check_id FROM check_list WHERE emp_id = '$b' AND csd_no = '$keb' ";
				$resultcl = mysqli_query($con,$sqlcl);
				$cl = mysqli_fetch_array($resultcl);

				$sqlTag ="SELECT DISTINCT `checklist_name_tag` 
							FROM `program_check_detail`as pcd JOIN program_check_u as pcu ON pcd.checklist_id = pcu.checklist_id
							WHERE pcu.pro_id = '$pro' ";
				$resultTag = mysqli_query($con,$sqlTag);
				while ($row=mysqli_fetch_array($resultTag)) {
	            	$sqlct = "INSERT INTO check_tags(ct_id,check_id,tag,quantity,tag_status,date_modify,user) VALUES(NULL,'$cl[check_id]','$row[checklist_name_tag]',NULL,0,'$_SESSION[date]','$_SESSION[user_name]')";
	            	$resultct = mysqli_query($con,$sqlct);
	            }
				
				echo "<script language=\"JavaScript\">";
				echo "alert('success');";
				echo "window.location='check-service_list.php?cs_no=$_POST[emp_check_no]';";
				echo "</script>";
			}
			else{
				//echo "step 5////";
				$r = $i+1;
				echo "<script language=\"JavaScript\">";
				echo "alert('พนักงานลำดับที่ ".$r." ถูกเพิ่มในการตรวจครั้งนี้แล้ว กรุณาลองใหม่');";
				echo "window.location='regis_emp.php?cs_no=$_POST[emp_check_no]';";
				echo "</script>";
			}
		}
	}

	//add later from edit_pro_employee.php----------------------------------------------

	/*if (isset($_POST['submit_pro_emp'])) {
		for ($i=0; $i < $_POST['nub_emp'] ; $i++) { 
			$emp_pro = $_POST["emp_pro$i"];
			$emp_id = $_POST["emp_id$i"];
			$emp_choose = $_POST["emp_choose$i"];
			if ($emp_pro!= NULL && $emp_choose== 'on') {
				if (check_csd($_POST['emp_check_no'],$_POST['emp_pro']) == true ) {
	    			$sqlCommand1 = "INSERT INTO `check_service_detail`(`csd_no`, `cs_no`, `pro_id`, `csd_pro_people`, `date_modify`, `user`) VALUES (NULL,'$_POST[emp_check_no]','$emp_pro','1','$_SESSION[date]','$_SESSION[user_name]')";
	    			$result=mysqli_query($con,$sqlCommand1)
						or die("Failed db".mysqli_error());
	    		}
	    		else{
	    			$sqlCommand2 = "UPDATE `check_service_detail` SET `csd_pro_people` = csd_pro_people+1,`date_modify`= '$_SESSION[date]',`user`= '$_SESSION[user_name]' WHERE `cs_no` = '$_POST[emp_check_no]' AND `pro_id` = '$emp_pro'";
	    			$result=mysqli_query($con,$sqlCommand2)
						or die("Failed db".mysqli_error());
	    		}

	    		$sqlCommand3 = "UPDATE `check_service` SET `cs_total_people`= cs_total_people+1,`date_modify`='$_SESSION[date]',`user`= '$_SESSION[user_name]' WHERE `cs_no` = '$_POST[emp_check_no]'";
	    			$result=mysqli_query($con,$sqlCommand3)
						or die("Failed db".mysqli_error());

	    		$keb = 0;
	    		$sqlCommand4 = "SELECT `csd_no` FROM `check_service_detail` WHERE cs_no ='$_POST[emp_check_no]' AND pro_id ='$_POST[emp_pro]'";
	    		$result=mysqli_query($con,$sqlCommand4);
            	while ($row=mysqli_fetch_array($result)) {
            		$keb = $row[0];
            	}

				$sqlCommand5 = "INSERT INTO `check_list`(`check_id`, `emp_id`, `csd_no`, `date_modify`, `user`) VALUES (NULL,'$emp_id','$keb','$_SESSION[date]','$_SESSION[user_name]')";
	    		$result=mysqli_query($con,$sqlCommand5)
					or die("Failed db".mysqli_error());
			}
		}
		echo "<script language=\"JavaScript\">";
		echo "alert('success');";
		echo "window.location='home.php';";
		echo "</script>";
	}*/

	function check_digit($number){
		$check = ($number[0]*13)+($number[1]*12)+($number[2]*11)+($number[3]*10)+($number[4]*9)+($number[5]*8)
					+($number[6]*7)+($number[7]*6)+($number[8]*5)+($number[9]*4)+($number[10]*3)+($number[11]*2);
		$keb = fmod($check, 11);
		$check = 11-$keb;
		if ($check == 11) {
			$check = 1;
		}
		if ($check == 10) {
			$check = 0;
		}
		if ($check == $number[12]) {
			return true;
		}
		else{
			return false;
		}
	}

	function check_id($number){
		include('connection.php');
		$a=0;
		$sqlCommand = "SELECT * FROM employee ";
        $result=mysqli_query($con,$sqlCommand);
        while ($row=mysqli_fetch_array($result)) {
        	if ($row[0] == $number) {
        		$a = 1;
        	}
        }
        if($a == 1){
        	return false;
        }
        else{
        	return true;
        }
	}

	function check_csd($cs_no,$pro){
		include('connection.php');
		$b=0;
		$sqlCommand = "SELECT * FROM check_service_detail ";
        $result=mysqli_query($con,$sqlCommand);
        while ($row1=mysqli_fetch_array($result)) {
        	if ($row1[1] == $cs_no && $row1[2] == $pro) {
        		$b = 1;
        	}
        }
        if($b == 1){
        	return false;
        }
        else{
        	return true;
        }
	}

	function check_cs_no($emp_id,$cs_no){
		include('connection.php');
		$c=0;
		$sqlCommand = "SELECT emp_id FROM `check_list` LEFT JOIN check_service_detail ON check_list.csd_no = check_service_detail.csd_no WHERE check_list.emp_id = '$emp_id' AND check_service_detail.cs_no ='$cs_no' ";
        $result=mysqli_query($con,$sqlCommand);
        while ($row2=mysqli_fetch_array($result)) {
        	if ($row2['emp_id'] == $emp_id ) {
        		$c = 1;
        	}
        }
        if($c == 1){
        	return false;
        }
        else{
        	return true;
        }
	}

?>