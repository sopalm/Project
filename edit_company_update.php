<!DOCTYPE html>
<html>
    <?php include("head.php"); 
    ?>
  <body class="skin-blue">
    <?php include("header.php"); ?>
      
 <?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <!-- Main content -->
            <div class="body">
            
            <div class="box-header"><a class="path" href="edit_company.php">/ บริษํท</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไข</a>
                <h2>แก้ไข บริษัท</h2>
            </div>
                <?php
                include('connection.php');

                $strCompID = null;
                
                if(isset($_GET["comp_id"]))
                {
                    $strCompID = $_GET["comp_id"];
                }
                $sql = "SELECT * FROM company WHERE comp_id = '".$strCompID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

                ?>
                <form action="edit_company_method.php" name="frmAdd" method="post">
                <table >
                  <tr>
                    <th width="200">รหัสบริษัท</th>
                    <td width="200"><input type="hidden" name="txtID" value="<?php echo $result["comp_id"];?>"><?php echo $result["comp_id"];?></td>
                    </tr>
                  <tr>
                    <th width="200">ชื่อบริษัท</th>
                    <td><input type="text" name="txtName" size="20" value="<?php echo $result["comp_name"];?>"></td>
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