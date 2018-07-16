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
            <a class="path" href="edit_program.php">/ โปรแกรมการตรวจสุขภาพ</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไขรายการตรวจสุขภาพ</a>
                <h2>แก้ไข รายการตรวจสุขภาพ</h2>
            </div>
                <?php

                $ID = null;
                
                if(isset($_GET["checklist_id"]))
                {
                    $ID = $_GET["checklist_id"];
                }
                $sql = "SELECT * FROM program_check_detail WHERE checklist_id = '".$ID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

                ?>
                <form action="edit_checklist_method.php" name="frmAdd" method="post">
                <table >
                    <tr>
                        <th width="200">หมายเลขรายการตรวจ</th>
                        <td width="200"><input type="hidden" name="pcl_id_edit" value="<?php echo $result["checklist_id"];?>"><?php echo $result["checklist_id"];?></td>
                    </tr>

                    <tr>
                        <th width="200">ชื่อรายการตรวจภาษาไทย</th>
                        <td ><input required="" style="width: 200px;" type="text" name="cl_name_th" value="<?php echo $result["checklist_name_th"];?>"></td>
                    </tr>
                    <tr>
                        <th width="200">ชื่อรายการตรวจภาษาอังกฤษ</th>
                        <td ><input required="" type="text" name="cl_name_en" value="<?php echo $result["checklist_name_en"];?>"></td>
                    </tr>
                    <tr>
                        <th width="200">ชื่อย่อ</th>
                        <td ><input required="" type="text" name="cl_name_tag" value="<?php echo $result["checklist_name_tag"];?>"></td>
                    </tr>
                   
                    <th>
                        <a class="back" href="edit_program.php">ยกเลิก</a>

                    </th>
                    <td><input type="submit" name="submit_cl" value="ยืนยัน"></td>

                  </table>
                  
                </form>

        </div>
       
      </div>


    <?php 
    include("footer.php");
    ?>
  </body>
</html>