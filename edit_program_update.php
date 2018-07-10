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
            <a class="path" href="edit_program.php">/ โปรแกรมการตรวจสุขภาพ</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไขโปรแกรมการตรวจสุขภาพ</a>
                <h2>แก้ไข โปรแกรมการตรวจสุขภาพ</h2>
            </div>
                <?php

                $ID = null;
                
                if(isset($_GET["pro_id"]))
                {
                    $ID = $_GET["pro_id"];
                }
                $sql = "SELECT * FROM program_check WHERE pro_id = '".$ID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

                ?>
                <form action="edit_program_method.php" name="frmAdd" method="post">
                <table >
                    <tr>
                        <th width="200">หมายเลขโปรแกรม</th>
                        <td width="200"><input type="hidden" name="pro_id_edit" value="<?php echo $result["pro_id"];?>"><?php echo $result["pro_id"];?></td>
                    </tr>

                    <tr>
                        <th width="200">ชื่อโปรแกรม</th>
                        <td ><input required="" type="text" name="pro_name_edit" value="<?php echo $result["pro_name"];?>"></td>
                    </tr>
                   
                    <th>
                        <a class="back" href="edit_program.php">ยกเลิก</a>

                    </th>
                    <td><input type="submit" name="submit_pro" value="ยืนยัน"></td>

                  </table>
                  
                </form>

        </div>
       
      </div>


    <?php 
    include("footer.php");
    ?>
  </body>
</html>