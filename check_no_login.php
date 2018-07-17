<?php
	session_start();
	if ($_SESSION['login']!='1') {
		echo "<script language=\"JavaScript\">";
		//echo "alert('Please Log In!!!');";
		//echo "window.location='index.php';";
		echo "</script>";
		header('Location: index.php');
	}
?>