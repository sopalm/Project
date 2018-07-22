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

			$empid = randEmpID();
	    	$hn = mysqli_real_escape_string($con,$_POST['emp_id']);
	    	$vn = mysqli_real_escape_string($con,$_POST['vn']);
	    	$title = mysqli_real_escape_string($con,$_POST['title']);
	    	$ename = mysqli_real_escape_string($con,$_POST['emp_name']);
	    	$esur = mysqli_real_escape_string($con,$_POST['emp_surname']);
			$enum = mysqli_real_escape_string($con,$_POST['emp_num']);
			$ecn = mysqli_real_escape_string($con,$_POST['emp_check_no']);
			$ep = mysqli_real_escape_string($con,$_POST['emp_pro']);
			$dep = mysqli_real_escape_string($con,$_POST['dep']);
	    	$comp = mysqli_real_escape_string($con,$_POST['comp']);

	    if (check_id($empid,$ecn) == false ) {
	    	
	    	echo "<script language=\"JavaScript\">";
			echo "</script>";
			header("Location: regis_emp.php?cs_no=".$_POST[emp_check_no]."");
	    }
		else
		{
			if(check_id($empid,$ecn) == 'new'){
				echo "มีแล้ว แต่ตรวจคนละวัน";
			}
			$filename = $PNG_TEMP_DIR.md5($empid.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	    	QRcode::png($empid, $filename, $errorCorrectionLevel, $matrixPointSize, 2);      
	         
	   		$path_qr = $PNG_WEB_DIR.basename($filename);
	    	$date = date("Y-m-d", strtotime($_POST['birthday']) );


	    	$sql = "SELECT `dep_comp_no` FROM `dep_comp` WHERE dep_id='$dep' AND comp_id = '$comp' ";
	    	$result=mysqli_query($con,$sql);
            while ($row=mysqli_fetch_array($result)) {
            	$dep_comp = $row[0];
            }
	    	
	    	

	    	$sqlCommand = "INSERT INTO `employee`(`emp_id`,`HN`,`VN`, `emp_title`, `emp_name`, `emp_surname`, `emp_bd`, `emp_qrcode`, `dep_comp_no`,`emp_no`,`date_modify`, `user_modify`) VALUES ('$empid','$hn','$vn','$title','$ename','$esur','$date','$path_qr','$dep_comp','$enum','$_SESSION[date]','$_SESSION[user_name]')";
			$result=mysqli_query($con,$sqlCommand)
				or die("Failed db".mysqli_error());
				
			if (check_csd($ecn,$ep) == true ) {
	    		$sqlCommand1 = "INSERT INTO `check_service_detail`(`csd_no`, `cs_no`, `pro_id`, `csd_pro_people`, `date_modify`, `user_modify`) VALUES (NULL,'$ecn','$ep','1','$_SESSION[date]','$_SESSION[user_name]')";
	    		$result=mysqli_query($con,$sqlCommand1)
				or die("Failed db".mysqli_error());
	    	}
	    	else{
	    		$sqlCommand2 = "UPDATE `check_service_detail` SET `csd_pro_people` = csd_pro_people+1,`date_modify`= '$_SESSION[date]',`user_modify`= '$_SESSION[user_name]' WHERE `cs_no` = '$ecn' AND `pro_id` = '$ep'";
	    		$result=mysqli_query($con,$sqlCommand2)
				or die("Failed db".mysqli_error());
	    	}

	    	$sqlCommand3 = "UPDATE `check_service` SET `cs_total_people`= cs_total_people+1,`date_modify`='$_SESSION[date]',`user_modify`='$_SESSION[user_name]' WHERE `cs_no` = '$ecn'";
	    	$result=mysqli_query($con,$sqlCommand3)
				or die("Failed db".mysqli_error());

	    	$keb = 0;
	    	$sqlCommand4 = "SELECT `csd_no` FROM `check_service_detail` WHERE cs_no ='$ecn' AND pro_id ='$ep'";
	    	$result=mysqli_query($con,$sqlCommand4);
            while ($row=mysqli_fetch_array($result)) {
            	$keb = $row[0];
            }


	    	$sqlCommand5 = "INSERT INTO `check_list`(`check_id`, `emp_id`, `csd_no`, `regis`, `quantity_bf`, `quantity_at`, `date_modify`, `user_modify`) VALUES (NULL,'$empid','$keb',0,0,0,'$_SESSION[date]','$_SESSION[user_name]')";
	    	$result=mysqli_query($con,$sqlCommand5)
				or die("Failed db".mysqli_error());
			$sqlcl = "SELECT check_id FROM check_list WHERE emp_id = '$empid' AND csd_no = '$keb' ";
			$resultcl = mysqli_query($con,$sqlcl);
			$cl = mysqli_fetch_array($resultcl);

			$sqlTag ="SELECT DISTINCT `checklist_name_tag` 
						FROM `program_check_detail`as pcd JOIN program_check_u as pcu ON pcd.checklist_id = pcu.checklist_id
						WHERE pcu.pro_id = '$ep' ";
			$resultTag = mysqli_query($con,$sqlTag);
			while ($row=mysqli_fetch_array($resultTag)) {
            	$sqlct = "INSERT INTO check_tags(ct_id,check_id,tag,quantity,tag_status,date_modify,user_modify) VALUES(NULL,'$cl[check_id]','$row[checklist_name_tag]',NULL,0,'$_SESSION[date]','$_SESSION[user_name]')";
            	$resultct = mysqli_query($con,$sqlct);
            }

			$_SESSION['alert']='emp_add';
			header("Location: check-service_list.php?cs_no=".$ecn."");
	    }
		
		
	}

//excel---------------------------------------------------------------------

	if (isset($_POST["submit_excel"])) {
		$ecn = mysqli_real_escape_string($con,$_POST['emp_check_no']);
		for ($i=0; $i < $_POST['nub'] ; $i++) {
			$a = mysqli_real_escape_string($con,$_POST['a$i']);
			$b = mysqli_real_escape_string($con,$_POST['b$i']);
			$c = mysqli_real_escape_string($con,$_POST['c$i']);
			$d = mysqli_real_escape_string($con,$_POST['d$i']);
			$e = mysqli_real_escape_string($con,$_POST['e$i']);
			$f = mysqli_real_escape_string($con,$_POST['f$i']);
			$g = mysqli_real_escape_string($con,$_POST['g$i']);
			//$h = mysqli_real_escape_string($con,$_POST['h$i']);
			$dep = mysqli_real_escape_string($con,$_POST['emp_dep$i']);
			$pro = mysqli_real_escape_string($con,$_POST['emp_pro$i']);
			$date = date("Y-m-d", strtotime($g) );
			

			$sqlcomp="SELECT c.comp_id FROM company as c JOIN company_address as ca ON c.comp_id = ca.comp_id
														JOIN check_service as cs ON cs.ca_id = ca.ca_id
						WHERE cs.cs_no = '$ecn'";
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
			if (check_id($b,$ecn) == 'new') {
				$sql = "UPDATE `employee` SET `VN`='$c',`emp_title`='$d',`emp_name`='$e',`emp_surname`='$f',`emp_age`='$h',`dep_comp_no`='$dep,`emp_no`='$a',`date_modify`='$_SESSION[date]',`user_modify`= '$_SESSION[user_name]' WHERE emp_id = '$b' ";
	    		$result=mysqli_query($con,$sql);
			}
			else{
				$filename = $PNG_TEMP_DIR.md5($b.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
		    	QRcode::png($b, $filename, $errorCorrectionLevel, $matrixPointSize, 2);      
		         
		    	$path_qr = $PNG_WEB_DIR.basename($filename);

				$sqlCommand = "INSERT INTO `employee`(`emp_id`,`VN`, `emp_title`, `emp_name`, `emp_surname`, `emp_bd`, `emp_age`, `emp_qrcode`, `dep_comp_no`,`emp_no`,`date_modify`, `user_modify`) VALUES ('$b','$c','$d','$e','$f','$date','$h','$path_qr','$dep','$a','$_SESSION[date]','$_SESSION[user_name]')";
				$result=mysqli_query($con,$sqlCommand)
					or die("Failed db".mysqli_error());
					//echo $sqlCommand;
			}
			//echo "step 2////";
			if (check_cs_no($b,$ecn) == true) {
				//echo "step 3////";
				if (check_csd($ecn,$pro) == true ) {
		    		$sqlCommand1 = "INSERT INTO `check_service_detail`(`csd_no`, `cs_no`, `pro_id`, `csd_pro_people`, `date_modify`, `user_modify`) VALUES (NULL,'$ecn','$pro','1','$_SESSION[date]','$_SESSION[user_name]')";
		    			$result=mysqli_query($con,$sqlCommand1)
							or die("Failed db".mysqli_error());
							echo "mai som";
		    	}
		    	else{
		    		$sqlCommand2 = "UPDATE `check_service_detail` SET `csd_pro_people` = csd_pro_people+1,`date_modify`= '$_SESSION[date]',`user_modify`= '$_SESSION[user_name]' WHERE `cs_no` = '$ecn' AND `pro_id` = '$pro'";
		    		$result=mysqli_query($con,$sqlCommand2)
							or die("Failed db".mysqli_error());
							echo "som";
		    	}
		    	//echo "step 4////";
		    	$sqlCommand3 = "UPDATE `check_service` SET `cs_total_people`= cs_total_people+1,`date_modify`='$_SESSION[date]',`user_modify`= '$_SESSION[user_name]' WHERE `cs_no` = '$ecn'";
		    	$result=mysqli_query($con,$sqlCommand3)
							or die("Failed db".mysqli_error());

		    	$keb = 0;
		    	$sqlCommand4 = "SELECT `csd_no` FROM `check_service_detail` WHERE cs_no ='$ecn' AND pro_id ='$pro'";
		    	$result=mysqli_query($con,$sqlCommand4);
	            while ($row=mysqli_fetch_array($result)) {
	            	$keb = $row[0];
	            }

				$sqlCommand5 = "INSERT INTO `check_list`(`check_id`, `emp_id`, `csd_no`, `date_modify`, `user_modify`) VALUES (NULL,'$b','$keb','$_SESSION[date]','$_SESSION[user_name]')";
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
	            	$sqlct = "INSERT INTO check_tags(ct_id,check_id,tag,quantity,tag_status,date_modify,user_modify) VALUES(NULL,'$cl[check_id]','$row[checklist_name_tag]',NULL,0,'$_SESSION[date]','$_SESSION[user_name]')";
	            	$resultct = mysqli_query($con,$sqlct);
	            }
				
				$_SESSION['alert']='emp_add';
			}
			else{
				$r = $i+1;
				$_SESSION['alert']='emp_add_false';
			}
		}
		if($_SESSION['alert']=='emp_add'){
			header("Location: check-service_list.php?cs_no=".$ecn."");
		}
		if($_SESSION['alert']=='emp_add_false'){
			header("Location: regis_emp.php?cs_no=".$ecn."");
		}

	}

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

	function check_id($number,$cs){
		include('connection.php');
		$a=0;
		$sqlCommand = "SELECT emp.emp_id,cs.cs_no FROM employee as emp 
		JOIN check_list as cl ON cl.emp_id = emp.emp_id
		JOIN check_service_detail as csd ON csd.csd_no = cl.csd_no
		JOIN check_service as cs ON csd.cs_no=cs.cs_no
		WHERE emp.emp_id ='$number'";
		$result=mysqli_query($con,$sqlCommand);
		if(mysqli_num_rows($result)== 0){
			return true;
		}
        else{
        	while ($row=mysqli_fetch_array($result)){
				if($cs==$row["cs_no"]){
					$a=1;
				}
			}
		}
		if($a==1){
			return false;
		}else{
			return 'new';
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

	function randEmpID(){
		include('connection.php');
		$emp_rand = uniqid();
		$sqlCommand = "SELECT emp_id FROM employee WHERE emp_id = '$emp_rand' ";
		$result=mysqli_query($con,$sqlCommand);
		$row=mysqli_fetch_array($result);
		if($row['emp_id']){
			randEmpID();
		}
		else{
			return $emp_rand;
		}
	}

?>