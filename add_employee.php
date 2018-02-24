<?php
	session_start();
	include('connection.php');
	include "qrlib.php"; 

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	$PNG_WEB_DIR = 'temp/';
	if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $errorCorrectionLevel = 'H';

    $matrixPointSize = 4;

    if (isset($_POST['emp_id'])) { 
        $filename = $PNG_TEMP_DIR.md5($_POST['emp_id'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_POST['emp_id'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);         
    }       
         
    $path_qr = $PNG_WEB_DIR.basename($filename);
    $date = date("Y-m-d", strtotime($_POST['birthday']) );

	$sqlCommand = "INSERT INTO `employee`(`emp_id`, `emp_title`, `emp_name`, `emp_surname`, `emp_bd`, `emp_age`, `emp_qrcode`, `comp_id`) VALUES ('$_POST[emp_id]','$_POST[title]',
					'$_POST[emp_name]','$_POST[emp_surname]','$date','$_POST[age]','$path_qr','$_POST[emp_comp]')";
	$result=mysqli_query($con,$sqlCommand)
		or die("Failed db".mysqli_error());
	echo "<script language=\"JavaScript\">";
	echo "alert('success');";
	echo "window.location='regis_emp.php';";
	echo "</script>";
?>