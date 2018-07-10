<?php
	session_start();
	//unset($_SESSION["login"]);
	session_destroy();
	//$_SESSION['login']='0';
	echo "<script language=\"JavaScript\">";
	//echo "alert('".$_SESSION['login']."');";
	echo "window.location='index.php';";
	echo "</script>";
?>
