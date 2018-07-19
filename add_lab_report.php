<?php
	session_start();
	include('connection.php');

//excel---------------------------------------------------------------------

	$check = 1;$cs_date=mysqli_real_escape_string($con,$_POST['check_no']);
	if (isset($_POST["submit_total_excel"])) {
		for ($i=0; $i < $_POST['nub2'] ; $i++) {
			if (check_id($_POST["b$i"]) == 0){
				$check = 0;
				$warring = $i+1;
				//echo $warring;
				echo "<script language=\"JavaScript\">";
				//echo "alert('พนักงานลำดับที่ '+$warring+' ไม่มีข้อมุลอยู่ในระบบ');";
				//echo "window.location='regis_lab.php?cs_no=$cs_date';";
				echo "</script>";
				header("Location: regis_lab.php?cs_no=".$cs_date."");
				break;
			}
		}
	}
	if ($check == 1) {
		for ($i=0; $i < $_POST['nub2'] ; $i++) {
			$no = $_POST["a$i"];
			$id = $_POST["b$i"];
			//ปกติ//ไม่ปกติ
			if($_POST["c$i"]=='Normal'){
				$c = 1;
			}
			else{
				if($_POST["c$i"]=='Under Weight'){
					$c = 2;
				}
				else{
					if($_POST["c$i"]=='Over Weight'){
						$c = 3;
					}
					else{
						if($_POST["c$i"]=='Weight Disease'){
							$c = 4;
						}
					}
				}
			}
			if($_POST["d$i"]=='ปกติ'){
				$d = 1;
			}
			else{
				$d = 0;
			}
			if($_POST["e$i"]=='ปกติ'){
				$e = 1;
			}
			else{
				$e = 0;
			}
			if($_POST["f$i"]=='ปกติ'){
				$f = 1;
			}
			else{
				$f = 0;
			}
			if($_POST["g$i"]=='ปกติ'){
				$g = 1;
			}
			else{
				$g = 0;
			}
			if($_POST["h$i"]=='ปกติ'){
				$h = 1;
			}
			else{
				$h = 0;
			}
			if($_POST["i$i"]=='ปกติ'){
				$zi = 1;
			}
			else{
				$zi = 0;
			}
			if($_POST["j$i"]=='ปกติ'){
				$j = 1;
			}
			else{
				$j = 0;
			}
			if($_POST["k$i"]=='ปกติ'){
				$k = 1;
			}
			else{
				$k = 0;
			}
			if($_POST["l$i"]=='ปกติ'){
				$l = 1;
			}
			else{
				$l = 0;
			}if($_POST["m$i"]=='ปกติ'){
				$m = 1;
			}
			else{
				$m = 0;
			}if($_POST["n$i"]=='ปกติ'){
				$n = 1;
			}
			else{
				$n = 0;
			}if($_POST["o$i"]=='ปกติ'){
				$o = 1;
			}
			else{
				$o = 0;
			}if($_POST["p$i"]=='ปกติ'){
				$p = 1;
			}
			else{
				$p = 0;
			}
			if($_POST["q$i"]=='ปกติ'){
				$q = 1;
			}
			else{
				$q = 0;
			}
			//ตัวเลข
			

			$r = mysqli_real_escape_string($con,$_POST['r$i']);
			$s = mysqli_real_escape_string($con,$_POST['s$i']);
			$t = mysqli_real_escape_string($con,$_POST['t$i']);
			$u = mysqli_real_escape_string($con,$_POST['u$i']);
			$v = mysqli_real_escape_string($con,$_POST['v$i']);
			$w = mysqli_real_escape_string($con,$_POST['w$i']);
			$x = mysqli_real_escape_string($con,$_POST['x$i']);
			$y = mysqli_real_escape_string($con,$_POST['y$i']);
			$z = mysqli_real_escape_string($con,$_POST['z$i']);
			$aa = mysqli_real_escape_string($con,$_POST['aa$i']);
			
			$ab = mysqli_real_escape_string($con,$_POST['ab$i']);
			$ac = mysqli_real_escape_string($con,$_POST['ac$i']);
			$ad = mysqli_real_escape_string($con,$_POST['ad$i']);
			$ae = mysqli_real_escape_string($con,$_POST['ae$i']);
			$af = mysqli_real_escape_string($con,$_POST['af$i']);
			$ag = mysqli_real_escape_string($con,$_POST['ag$i']);
			$ah = mysqli_real_escape_string($con,$_POST['ah$i']);
			$ai = mysqli_real_escape_string($con,$_POST['ai$i']);
			$aj = mysqli_real_escape_string($con,$_POST['aj$i']);
			$ak = mysqli_real_escape_string($con,$_POST['ak$i']);

			
			//echo $cs_date;echo "555555</br>";
				$sqlcsd =" SELECT csd.csd_no
							FROM check_service_detail AS csd 
							LEFT JOIN check_list AS cl ON cl.csd_no=csd.csd_no
							WHERE cl.emp_id='$id' AND csd.cs_no='$cs_date'	";
				$resultcsd=mysqli_query($con,$sqlcsd)
					or die("Failed db".mysqli_error());
				$csd=mysqli_fetch_array($resultcsd);
				//echo $csd[0];echo "</br>";

				$sqlCommand = "INSERT INTO `report_total` (`emp_id`, `csd_no`, `bmi_report`, `physical_examination`, `blood_pressure`, `cxr`, `ekg`, `ua`, `cbc`, `mammogram`, `thin_prep`, `upper_abdomen`, `lower_abdomen`, `whole_abdomen`, `exercise_stress_test`, `stool_occult_blood`, `bmd`, `fbs`, `bun`, `cr`, `chol`, `hdl`, `ldl`, `trig`, `total_blirubin`, `sgot`, `sgpt`, `alk`, `uric_acid`, `psa`, `total_protein`, `albumin`, `direct_bilirubin`, `globulin`, `cea`, `afp`, `cap19-9`, `date_modify`, `user`)  VALUES ('$id','$csd[0]','$c','$d','$e','$f','$g','$h','$zi','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w','$x','$y','$z','$aa','$ab','$ac','$ad','$ae','$af','$ag','$ah','$ai','$aj','$ak','$_SESSION[date]','$_SESSION[user_name]')";
		    	$result=mysqli_query($con,$sqlCommand)
					or die("Failed db".mysqli_error());
				echo "<script language=\"JavaScript\">";
				//echo "alert('success');";
				//echo "window.location='check-service_list.php?cs_no=$cs_date';";
				echo "</script>";	
				$_SESSION['alert']='lab_add';
				header("Location: check-service_list.php?cs_no=".$cs_date."");
				
			
		}
		
				
	}

	//check id in sys
	function check_id($number){
		include('connection.php');
		$a=0;
		$cs_date=$_POST["check_no"];
		$sqlCommand1 = "SELECT e.emp_id FROM employee as e 	LEFT JOIN check_list as cl ON cl.emp_id = e.emp_id 
															LEFT JOIN check_service_detail as csd ON cl.csd_no = csd.csd_no 
															LEFT JOIN program_check as pc ON csd.pro_id = pc.pro_id 
						WHERE csd.cs_no = $cs_date ";
        $result1=mysqli_query($con,$sqlCommand1);

        while ($row=mysqli_fetch_array($result1)) {
        	if ($row["emp_id"] == $number) {
        		$a = 1;
        	}
        }
        return $a;


	}


?>