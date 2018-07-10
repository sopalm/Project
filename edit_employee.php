<!DOCTYPE html>
<html>
<?php include("head.php"); ?>


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<body class="skin-blue">
<?php include("header.php"); ?>
      
<?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <!-- Main content -->
            <div class="body">
            
            <div class="box-header"><a style="color: black;text-decoration-line: none;" href="">/ รายชื่อพนักงานในระบบ</a>
                <h2>รายชื่อพนักงานในระบบ</h2>
            </div>
                <!-- กำหนดตัวแปลใช้ในการค้นหา -->
                <?php
                    ini_set('display_errors', 1);
                    error_reporting(~0);

                    $strKeyID = null;
                    if(isset($_POST["txtKeyid"]))
                    {
                        $strKeyID = $_POST["txtKeyid"];
                    }

                    $strKeyName = null;
                    if(isset($_POST["txtKeyname"]))
                    {
                        $strKeyName = $_POST["txtKeyname"];
                    }

                    $strKeySurname = null;
                    if(isset($_POST["txtKeysurname"]))
                    {
                        $strKeySurname = $_POST["txtKeysurname"];
                    }

                    $strKeyTitle = null;
                    if(isset($_POST["txtKeytitle"]))
                    {
                        $strKeyTitle = $_POST["txtKeytitle"];
                    }

                    $strKeyBD = null;
                    if(isset($_POST["txtKeybd"]))
                    {
                        $strKeyBD = $_POST["txtKeybd"];
                    }

                    $strKeyAge = null;
                    if(isset($_POST["txtKeyage"]))
                    {
                        $strKeyAge = $_POST["txtKeyage"];
                    }
                    $strKeyCom = null;
                    if(isset($_POST["txtKeycom"]))
                    {
                        $strKeyCom = $_POST["txtKeycom"];
                    }
                ?>
                          <a href="regis_emp.php" style="height: 30px;" class="btn btn-primary"  >เพิ่มพนักที่เข้ารับการตรวจสุขภาพ</a><br>
                <?php
                include('connection.php');
                include('function.php');
                $query = "SELECT emp.*,dc.* ,c.*
                          FROM employee as emp LEFT JOIN dep_comp as dc ON emp.dep_comp_no=dc.dep_comp_no
                                                LEFT JOIN company as c ON dc.comp_id=c.comp_id
                          WHERE emp_id LIKE '%".$strKeyID."%' AND emp_name LIKE '%".$strKeyName."%' 
                          AND  emp_surname LIKE '%".$strKeySurname."%' AND  emp_title LIKE '%".$strKeyTitle."' AND   emp_bd LIKE '%".$strKeyBD."%' AND emp_age LIKE '%".$strKeyAge."%' AND  dc.comp_id LIKE '%".$strKeyCom."%'  ";

                $result = mysqli_query($con,$query); 
                ?>
                <div >
                  <table id="example1" class="display" width="100%">
                  <thead>
                    <tr >
                      <th > <div align="center">H.N </div></th>
                      <th > <div align="center">V.N </div></th>
                      <th > <div align="center">คำนำหน้า</div></th>
                      <th > <div align="center">ชื่อ</div></th>
                      <th > <div align="center">นามสกุล</div></th>
                      <th > <div align="center">วันเกิด</div></th>
                      <th > <div align="center">อายุ</div></th>
                      <th > <div align="center">บริษัท</div></th>
                      


                      <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <th > <div align="center">วันที่ทำการแก้ไขล่าสุด</div></th>
                            <th > <div align="center">ผู้ใช้</div></th>
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
                      <td ><div align="center"><?php echo $row["emp_id"];?></div></td>
                      <td ><div align="center"><?php echo $row["VN"];?></div></td>
                      <td ><div align="center"><?php echo $row["emp_title"];?></div></td>
                      <td ><?php echo $row["emp_name"];?></td>
                      <td ><?php echo $row["emp_surname"];?></td>
                      <td ><div align="center"><?php echo thai_date($row["emp_bd"]);?></div></td>
                      <td ><div align="center"><?php echo $row["emp_age"];?></div></td>
                      <td ><div align="center"><?php echo $row["comp_name"];?></div></td>
   
                      <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><?php echo DateThai($row["date_modify"]);?></td>
                            <td align="center"><?php echo $row["user"];?></td>
                            <td align="center"><a href="edit_employee_update.php?emp_id=<?php echo $row["emp_id"];?>">แก้ไข</a></td>
                          <?php 
                          } 
                          ?>
                    </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                  <tfoot>
                    <tr >
                      <th > <div align="center">H.N </div></th>
                      <th > <div align="center">V.N </div></th>
                      <th > <div align="center">คำนำหน้า</div></th>
                      <th > <div align="center">ชื่อ</div></th>
                      <th > <div align="center">นามสกุล</div></th>
                      <th > <div align="center">วันเกิด</div></th>
                      <th > <div align="center">อายุ</div></th>
                      <th > <div align="center">บริษัท</div></th>
                      


                      <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <th > <div align="center">วันที่ทำการแก้ไขล่าสุด</div></th>
                            <th > <div align="center">ผู้ใช้</div></th>
                            <td > <div align="center"><!--Edit--></div></td>
                          <?php 
                          } 
                          ?>
                    </tr>
                  </tfoot>
                  </table>
                </div>
        </div>
   
      </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>