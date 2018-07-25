<?php
	$con= mysqli_connect("localhost","root","","yhdb") or die("Error: " . mysqli_error($con));
	//$con= mysqli_connect("203.151.93.42","kmitnb_sopalm","30de55e","kmitnb_sopalm") or die("Error: " . mysqli_error($con));
	
    mysqli_set_charset($con, "utf8");
	date_default_timezone_set("Asia/Bangkok");
	$_SESSION['date'] = date("Y-m-d H:i:s");
	$date = date("Y-m-d");
	
?>
<?php
	/*try {
		$host = "localhost"; // ชื่อ host หรือ ip ที่ใช้
		$userhost = "kmitnb_sopalm"; // ชื่อ user ที่ใช้ในการล็อกอิน
		$passhost = "30de55e"; // password ที่ใช้ในการล็อกอิน
		$database = "kmitnb_sopalm"; // ชื่อ Database
		$con = mysqli_connect($host,$userhost,$passhost,$database); // connect to database
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
				echo ' not connected';
			  }
		mysqli_set_charset($con, "utf8");
		date_default_timezone_set("Asia/Bangkok");
		$_SESSION['date'] = date("Y-m-d H:i:s");
		$date = date("Y-m-d");
	} catch (Exception $e){
		throw new Exception($e);
	}*/
?>
