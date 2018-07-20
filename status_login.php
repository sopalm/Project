
	<?php
	include("connection.php");
	//include("js/newjs.js");

		if ($_SESSION["login"]== '1') {
			echo "สวัสดี ".$_SESSION['user_name'];
			$username = $_SESSION['user_name'];
			//echo "<a href='' onclick='logout()' >log out</a>";
			//echo "<a href='logout.php' id='logout' >log out</a>";
			$sqlinfo ="SELECT * FROM user WHERE user_name = '$username' ";
			$resultinfo =mysqli_query($con,$sqlinfo);
			$info=mysqli_fetch_array($resultinfo);
			?>
			<a 	style="color: white;
						position:fixed;
					   top:15px;
					   right:130px;" 
				data-toggle="modal" href="#edituser" class="edit-user"  
				data-supID="<?php echo $info["user_id"];?>"               
            >เปลี่ยนรหัสผ่าน</a>
			<a style="color: white;
						position:fixed;
					   top:15px;
					   right:10px;
			 " href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a>
		<?php } ?>
			
