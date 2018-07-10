<!DOCTYPE html>
<html>
<?php include("head.php"); ?>

<body class="skin-blue">
<?php include("header.php"); ?>
      
<?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <!-- Main content -->
            <div class="body">
            <div class="box-header">
                <h2>แก้ไข ผู้ใช้</h2>
            </div>
                <?php

                $ID = null;
                
                if(isset($_GET["user_id"]))
                {
                    $ID = $_GET["user_id"];
                }
                $sql = "SELECT * FROM user WHERE user_id = '".$ID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

                ?>
                <form action="edit_user_method.php" name="frmAdd" method="post">
                <table >
                    <tr>
                        <th width="200">รหัสผู้ใช้</th>
                        <td width="200"><input type="hidden" name="txtID" value="<?php echo $result["user_id"];?>"><?php echo $result["user_id"];?></td>
                    </tr>

                    <tr>
                        <th width="200">ชื่อผู้ใช้งาน</th>
                        <td ><input pattern="[a-zA-Z0-9-]+" required title="Character and Number Only" type="text" name="txtName" size="20" value="<?php echo $result["user_name"];?>"></td>
                    </tr>
                    <tr>
                        <th width="200">รหัสผ่าน</th>
                        <td ><input required type="text" name="txtPW" size="20" value="<?php echo $result["user_pass"];?>"></td>
                    </tr>
                    <tr>
                        <th width="200">สถานะ</th>
                        <td >
                            <select  required name="txtStatus">
                                <option value="" >---เลือก---</option>
                                    <?php

                                        if($result["user_status"]=='admin')
                                        {
                                            echo "<option selected value='".$result["user_status"]."'>"."ผู้ดูแล"."</option>";
                                            echo "<option value='user'>user</option>";
                                        }
                                        else
                                        {
                                            echo "<option selected value='".$result["user_status"]."'>"."ผู้ใช้"."</option>";
                                            echo "<option value='admin'>admin</option>";
                                        }
                                            
                                    ?>
                            </select>
                        </td>
                    </tr>
                    <th>
                        <a class="back" href="edit_user.php">ยกเลิก</a>

                    </th>
                    <td><input type="submit" name="submit" value="ยันยัน"></td>

                  </table>
                  
                </form>

        </div>
       
      </div>


    <?php 
    include("footer.php");
    ?>
  </body>
</html>