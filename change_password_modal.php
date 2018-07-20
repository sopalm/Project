<center>
            	<!-- Modal -->
                <div class="modal fade" id="edituser" role="dialog" data-backdrop="true">
					<div class="modal-dialog modal-sm">
                        
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                            </div>
                        	<div class="modal-body">
                        	<form method='POST' action="change_password.php">
								<input hidden type="text" id="supID" name="supID" >
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