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
            <a class="path"  href="edit_company.php">/ รายชื่อบริษัทที่เข้ารับการตรวจ</a><a class="path" href="edit_company_data.php?id=<?php echo $_GET["id"];?>">/ ข้อมูลของบริษัท</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไข</a>
            </div>
                <h2>แก้ไข พนักงาน</h2>
            </div>
                <?php
                include_once('connection.php');
                include('function.php');
                $strEmpID = null;
                if(isset($_GET["emp_id"]))
                {
                    $strEmpID = $_GET["emp_id"];
                }
                
                $sqltitle = "SELECT DISTINCT emp_title FROM employee  "; 
                $querytitle = mysqli_query($con,$sqltitle);

                $sql = "SELECT * FROM employee WHERE emp_id = '".$strEmpID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

                $strEmptitle =  $result["emp_title"];

                ?>

                <form action="edit_employee_method.php" name="frmAdd" method="post">

                <table width="284" border="0">
                    <tr>
                        <th width="120">หมายเลข H.N</th>
                        <td width="238"><input type="hidden" name="txtID" value="<?php echo $result["emp_id"];?>"><?php echo $result["emp_id"];?></td>
                    </tr>
                    <tr>
                        <th width="120">หมายเลข V.N</th>
                        <td width="238"><input type="hidden" name="txtVN" value="<?php echo $result["VN"];?>"><?php echo $result["VN"];?></td>
                    </tr>
                    <tr>
                        <th width="120">คำนำหน้า</th>
                        <td><select name="txtTitle" >
                            <?php 
                                while($title=mysqli_fetch_array($querytitle)){

                                    if($strEmptitle==$title[0])
                                    {
                                        echo "<option selected value='".$title[0]."'>".$title[0]."</option>";
                                    }else{
                                        echo "<option value='".$title[0]."'>".$title[0]."</option>";
                                    }

                                }
                                
                                
                            ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th >ชื่อ</th>
                        <td><input type="text" name="txtName" size="20" value="<?php echo $result["emp_name"];?>"></td>
                    </tr>
                    <tr>
                        <th >นามสกุล</th>
                        <td><input type="text" name="txtSurname" size="20" value="<?php echo $result["emp_surname"];?>"></td>
                    </tr>
                    <tr>
                        <th >วันเกิด</th>
                        <td><input type="date"  name="txtBD" size="20" value="<?php echo $result["emp_bd"];?>"></td>
                    </tr>
                    <tr>
                        <th>
                            
                        </th>
                        <td><input type="submit" name="submit" value="ยืนยัน"></td>
                    </tr>

                  </table>

                </form>
        </div>
   
      </div>

    <?php 
    include("footer.php");
    ?>
  </body>
</html>