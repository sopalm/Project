
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
				data-toggle="modal" href="#editsup" class="edit-sup"  
				data-supID="<?php echo $info["user_id"];?>"               
            >เปลี่ยนรหัสผ่าน</a>
			<a style="color: white;
						position:fixed;
					   top:15px;
					   right:10px;
			 " href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ')">ออกจากระบบ</a>
		<?php } ?>
			<center>
            	<!-- Modal -->
                <div class="modal fade" id="editsup" role="dialog" data-backdrop="false">
					<div class="modal-dialog modal-sm">
                        
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                            </div>
                        	<div class="modal-body">
                        	<form method='POST' action="change_password.php">
								<input hidden type="text" id="supID" name="supID" style="width: 30px;border: none;">
								รหัสผ่านเก่า<br>
								<input type="password" id="pass_old" name="pass_old" ><br>
								รหัสผ่านใหม่<br>
								<input type="password" id="pass_new" name="pass_new" ><br>
								ยืนยันรหัสผ่านใหม่<br>
								<input type="password" id="pass_confirm" name="pass_confirm" ><br>
                        	</div>
                        	<div class="modal-footer">
                            	<center><button class="btn btn-default" type="submit" name="change_pass">ยืนยัน</button></center>        
                        	</form>
                        	</div>
                        </div>
                          
                    </div>
                </div>
            </center>
