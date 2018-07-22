<?php
	@session_start();
	if ($_SESSION['login']!='1') {
		echo "<script language=\"JavaScript\">";
		//echo "alert('Please Log In!!!');";
		//echo "window.location='index.php';";
		echo "</script>";
		$_SESSION['alert']='No_login';
		header('Location: index.php');
	}
?>