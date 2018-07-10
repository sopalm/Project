
	<?php
	include("connection.php");
	//include("js/newjs.js");

		if ($_SESSION["login"]== '1') {
			echo "สวัสดี ".$_SESSION['user_name'];
			//echo "<a href='' onclick='logout()' >log out</a>";
			//echo "<a href='logout.php' id='logout' >log out</a>";
			?>
			<a style="color: white;
						position:fixed;
					   top:10px;
					   right:10px;
			 " href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a>
		<?php } ?>
