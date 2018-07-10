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
            <div class="box-header"><a class="path" href="edit_doctor.php">/ รายชื่อแพทย์</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไข</a>
                <h2>แก้ไข แพทย์</h2>
            </div>
                <?php
                include('connection.php');

                $strID = null;
                
                if(isset($_GET["id"]))
                {
                    $strID = $_GET["id"];
                }
                $sql = "SELECT * FROM doctor WHERE doc_id = '".$strID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);


                $strTitle =  $result["doc_title"];
                ?>
                <form action="edit_doctor_method.php" name="frmAdd" method="post">
                <table >
                    <tr>
                        <th width="200">ลำดับ</th>
                        <td width="200"><input type="hidden" name="txtID" value="<?php echo $result["doc_id"];?>"><?php echo $result["doc_id"];?></td>
                    </tr>
                    <tr>
                        <th width="200">คำนำหน้า</th>
                        <td>
                            <select name="txtTitle" >
                            <?php 
                                if($strTitle=='นายแพทย์')
                                {
                                    echo "<option selected value='นายแพทย์'>นายแพทย์</option>";
                                    echo "<option value='แพทย์หญิง'>แพทย์หญิง</option>";
                                }
                                if($strTitle=='แพทย์หญิง')
                                {
                                    echo "<option value='นายแพทย์'>นายแพทย์</option>";
                                    echo "<option selected value='แพทย์หญิง'>แพทย์หญิง</option>";
                                }

                            ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">ชื่อ</th>
                        <td><input type="text" name="txtName" size="20" value="<?php echo $result["doc_name"];?>"></td>
                    </tr>
                    <tr>
                        <th width="200">นามสกุล</th>
                        <td><input type="text" name="txtSurname" size="20" value="<?php echo $result["doc_surname"];?>"></td>
                    </tr>
                    <tr>
                        <th width="200">ใบประกอบวิชาชีพแพทย์</th>
                        <td ><input type="text" name="txtLicen" value="<?php echo $result["doc_license"];?>" ></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                        <th>
                            
                        </th>
                        <td><input type="submit" name="submit" value="ยืนยัน"></td>

                  </table>
                  
                </form>
        </div>
       
      </div>

    <?php 
    include("footer.php");
    ?>
  </body>
</html>