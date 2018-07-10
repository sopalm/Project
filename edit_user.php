<!DOCTYPE html>
<html>
<?php include("head.php");?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<body class="skin-blue">
<?php include("header.php"); ?>
      
<?php include("slide_menu.php"); 
    
?>
    
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="body">
            <div class="box-header">
              <h2>ผู้ใช้ในระบบ</h2>
              </br>
               <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">เพิ่ม</button>
               </br>
               </br>
              <?php 
                $query = "SELECT * 
                          FROM user 
                          ORDER BY user.user_id ASC ";

                $result = mysqli_query($con,$query);
              ?>

                <table id="tablepage" class="display">
                  <thead>
                    <tr >
                      <th > <div align="center">รหัสผู้ใช้ </div></th>
                      <th > <div align="center">ชื่อผู้ใช้งาน</div></th>
                      <th > <div align="center">รหัสผ่าน </div></th>
                      <th > <div align="center">สถานะ </div></th>
                      <th > <div align="center">วันที่ทำการแก้ไขล่าสุด </div></th>
                      <th > <div align="center">ผู้ใช้ </div></th>

                      <?php
                        if ($_SESSION["status"]== '1')
                        { ?>
                          <th > <div align="center"><!--Edit--> </div></th>
                        <?php 
                        } 
                        ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                    ?>
                      <tr >
                        <td ><div align="center"><?php echo $row["user_id"];?></div></td>
                        <td ><?php echo $row["user_name"];?></td>
                        <td ><input disabled style="border: none; background: none;" type="password" value="1111111111111111"></td>
                        <td ><center><?php echo $row["user_status"];?></center></td>
                        <td ><center><?php echo $row["date_modify"];?></center></td>
                        <td ><center><?php echo $row["user"];?></center></td>
     
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><a href="edit_user_update.php?user_id=<?php echo $row["user_id"];?>">Edit</a></td>
                          <?php 
                          } 
                          ?>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>

            </div>
                
        </div>   
      </div><!--content-wrapper-->
       <center>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ลงทะเบียน ผู้ใช้</h4>
                      </div>
                      <div class="modal-body">
                        <?php 
                          $query = "SELECT * FROM Company";
                          $result = mysqli_query($con,$query);
                        ?>
                        <form method='POST' action="add_user.php">
                            <label >ชื่อผู้ใช้</label >
                            <br/>
                            <input type="text" id="user_name" name="user_name" required >
                            <br/>
                            <br/>
                            <label >รหัสผ่าน</label >
                            <br/>
                            <input required="" type="password" id="user_pass" name="user_pass" minlength="8" maxlength="16">
                            <br/>
                            <br/>
                            <label >สถานะ</label >
                            <br/>
                             <select  required name="user_status">
                                <option value="" >---เลือก---</option>
                                    <option value="admin">ผู้ดูแล</option>
                                    <option value="user">ผู้ใช้</option>
                            </select>
                            <br/>
                      
                      </div>
                      <div class="modal-footer">
                        <center><button class="btn btn-default" type="submit" name="add_user">ยืนยัน</button></center>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                </center>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>