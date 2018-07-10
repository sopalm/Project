<!DOCTYPE html>
<html>
<?php include("head.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<body class="skin-blue">
<?php include("header.php"); ?>

      
<?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <!-- Main content -->
        <div class="body">
            
            <div class="box-header">
              <a class="path"  href="edit_company.php">/ รายชื่อบริษัทที่เข้ารับการตรวจ</a><a style="color: black;text-decoration-line: none;" href="">/ ข้อมูลของบริษัท</a>
              <?php 
                $get=NULL;
                if(isset($_GET['id'])){
                  $get= $_GET['id'];
                }
                $sqlcp = "SELECT cp.comp_name
                          FROM company as cp 
                          WHERE cp.comp_id = '$get' ";
                $querycp=mysqli_query($con,$sqlcp);
                if (!$querycp) {
                  printf("Error: %s\n", mysqli_error($con));
                  exit();
              }
                $cp=mysqli_fetch_array($querycp);
              ?>
              <h2>ข้อมูลของบริษัท <?php echo $cp[0]; ?></h2>

            </div>
            
            <div name="emp_list">
              <?php 
                include('function.php');
                $sqlemp = "SELECT e.*,d.dep_name
                          FROM employee as e  LEFT JOIN dep_comp as dc ON e.dep_comp_no=dc.dep_comp_no 
                                              LEFT JOIN company as c ON c.comp_id=dc.comp_id
                                              LEFT JOIN department as d ON d.dep_id=dc.dep_id
                          WHERE c.comp_id = '$get' ";
                $queryemp=mysqli_query($con,$sqlemp);
              ?>
              <table id="example3" class="display" width="100%">
                <thead>
                  <tr >
                    <th > <div align="center">H.N</div></th>
                    <th > <div align="center">V.N</div></th>
                    <th > <div align="center">คำนำหน้า </div></th>
                    <th > <div align="center">ชื่อ </div></th>
                    <th > <div align="center">สกุล</div></th>
                    <th > <div align="center">วันเกิด</div></th>
                    <th > <div align="center">อายุ</div></th>
                    <th > <div align="center">แผนก</div></th>
                    <?php
                    if ($_SESSION["status"]== '1')
                    { ?>
                      <th > <div align="center">วันที่แก้ไขล่าสุด</div></th>
                      <th > <div align="center">ผู้ใช้</div></th>
                      <th > <div align="center"><!--Edit--> </div></th>
                    <?php 
                    } 
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($row=mysqli_fetch_array($queryemp,MYSQLI_ASSOC))
                  {
                  ?>
                    <tr class='' data-href=''>
                        <td align="center"><?php echo $row["emp_id"];?></td>
                        <td align="center"><?php echo $row["VN"];?></td>
                        <td align="center"><?php echo $row["emp_title"];?></td>
                        <td ><?php echo $row["emp_name"];?></td>
                        <td ><?php echo $row["emp_surname"];?></td>
                        <td align="center"><?php echo DateThaietc($row["emp_bd"]);?></td>
                        <td align="center"><?php echo $row["emp_age"];?></td>
                        <td ><?php echo $row["dep_name"];?></td>
                        <?php
                        if ($_SESSION["status"]== '1')
                        { ?>
                          <td align="center"><?php echo DateThaietc($row["date_modify"]);?></td>
                          <td align="center"><?php echo $row["user"];?></td>
                          <td align="center"><a href="edit_employee_update.php?emp_id=<?php echo $row["emp_id"];?>">แก้ไข</a></td>
                        <?php 
                        } 
                        ?>
                    </tr>
                  <?php
                  }
                  ?>
                      <tbody>
                <tfoot>
                  <tr >
                    <th > <div align="center">H.N</div></th>
                    <th > <div align="center">V.N</div></th>
                    <th > <div align="center">คำนำหน้า </div></th>
                    <th > <div align="center">ชื่อ </div></th>
                    <th > <div align="center">สกุล</div></th>
                    <th > <div align="center">วันเกิด</div></th>
                    <th > <div align="center">อายุ</div></th>
                    <th > <div align="center">แผนก</div></th>
                    <?php
                    if ($_SESSION["status"]== '1')
                    { ?>
                      <th > <div align="center">วันที่แก้ไขล่าสุด</div></th>
                      <th > <div align="center">ผู้ใช้</div></th>
                      <td > <div align="center"><!--Edit--> </div></td>
                    <?php 
                    } 
                    ?>
                  </tr>
                </tfoot>
              </table>
            </div> 
            <div name="place_list" style="width: 50%">
              <?php 
                $sqlplace = "SELECT ca.*
                          FROM company as c  LEFT JOIN company_address as ca ON c.comp_id=ca.comp_id
                          WHERE c.comp_id = '$get' ";
                $queryplace=mysqli_query($con,$sqlplace);
              ?>
              <table id="tablepage-page" class="display" >
                <thead align="center">
                  <th style="width: 50%;">ชื่อสถานที่</th>
                  <?php
                  if ($_SESSION["status"]== '1')
                  { ?>
                    <th > <div align="center">วันที่แก้ไขล่าสุด</div></th>
                    <th > <div align="center">ผู้ใช้</div></th>
                    <th > <div align="center"><!--Edit--> </div></th>
                  <?php 
                  } 
                  ?>
                </thead>
                <tbody>
                  <?php
                  while($row=mysqli_fetch_array($queryplace,MYSQLI_ASSOC))
                  {
                  ?>
                    <tr >
                        <td ><?php echo $row["address"];?></td>
                        <?php
                        if ($_SESSION["status"]== '1')
                        { ?>
                          <td align="center"><?php echo DateThaietc($row["date_modify"]);?></td>
                          <td align="center"><?php echo $row["user"];?></td>
                          <td align="center"><a href="edit_employee_update.php?id=<?php echo $row["ca_id"];?>">แก้ไข</a></td>
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
      </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
      </script>
</body>
</html> zz