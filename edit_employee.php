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

                          <a href="regis_emp.php" style="height: 30px;" class="btn btn-primary"  >เพิ่มพนักงานที่เข้ารับการตรวจสุขภาพ</a><br>
                <?php
                include('connection.php');
                include('function.php');
                $query = "SELECT emp.*,dc.* ,c.*
                          FROM employee as emp LEFT JOIN dep_comp as dc ON emp.dep_comp_no=dc.dep_comp_no
                                                LEFT JOIN company as c ON dc.comp_id=c.comp_id ";

                $result = mysqli_query($con,$query); 
                ?>
                <div >
                  <table name="employee" id="example" class="display nowrap" width="100%">
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
                      <td ><div align="center"><?php echo DateThaietc($row["emp_bd"]);?></div></td>
                      <td ><div align="center"><?php echo Age($row["emp_bd"]);?></div></td>
                      <td ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["comp_name"];?>"><?php echo $row["comp_name"];?></a></td>
                      <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><?php echo DateThaimod($row["date_modify"]);?></td>
                            <td align="center"><?php echo $row["user_modify"];?></td>
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
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('[data-toggle="popover"]').popover();
        });
      </script>
  </body>
</html>