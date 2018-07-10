<!DOCTYPE html>
<html>
<?php include("head.php");?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<body class="skin-blue">
<?php include("header.php"); ?>
      
<?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <!-- Main content -->
        <div class="body">
            <div class="box-header"><a style="color: black;text-decoration-line: none;" href="">/ รายชื่อแพทย์</a>
                <h2>รายชื่อแพทย์ที่ทำหน้าที่ตรวจสุขภาพนอกสถานที่</h2>
            </div>
                <?php
                    ini_set('display_errors', 1);
                    error_reporting(~0);

                    $strKeyTitle = null;
                    if(isset($_POST["txtKeytitle"]))
                    {
                        $strKeyTitle = $_POST["txtKeytitle"];
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

                    $strKeyLicen = null;
                    if(isset($_POST["txtKeysurname"]))
                    {
                        $strKeyLicen = $_POST["txtKeylicen"];
                    }
                ?>
                        <button  style="height: 30px;" type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">เพิ่มแพทย์ที่ออกตรวจสุขภาพ</button><br>

                <?php
                include_once('connection.php');
                include('function.php');
                $query = "SELECT * 
                          FROM doctor 
                          WHERE doc_title LIKE '%".$strKeyTitle."%' AND doc_name LIKE '%".$strKeyName."%' AND doc_surname LIKE '%".$strKeySurname."%' 
                          AND doc_license LIKE '%".$strKeyLicen."%' ";

                $result = mysqli_query($con,$query); 
                ?>
                <br>
                <table id="example" class="display" width="100%">
                  <thead>
                    <tr >
                      <th > <div align="center">ลำดับ </div></th>
                      <th > <div align="center">คำนำหน้า </div></th>
                      <th > <div align="center">ชื่อ</div></th>
                      <th > <div align="center">นามสกุล</div></th>
                      <th > <div align="center">ใบระกอบวิชาชีพแพทย์</div></th>

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
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                    ?>
                      <tr >
                        <td ><div align="center"><?php echo $row["doc_id"];?></div></td>
                        <td ><?php echo $row["doc_title"];?></td>
                        <td ><?php echo $row["doc_name"];?></td>
                        <td ><?php echo $row["doc_surname"];?></td>
                        <td ><?php echo $row["doc_license"];?></td>
     
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><?php echo DateThai($row["date_modify"]);?></td>
                            <td align="center"><?php echo $row["user"];?></td>
                            <td align="center"><a href="edit_doctor_update.php?id=<?php echo $row["doc_id"];?>">แก้ไข</a></td>
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
                      <th > <div align="center">ลำดับ </div></th>
                      <th > <div align="center">คำนำหน้า </div></th>
                      <th > <div align="center">ชื่อ</div></th>
                      <th > <div align="center">นามสกุล</div></th>
                      <th > <div align="center">ใบระกอบวิชาชีพแพทย์</div></th>

                      <?php
                        if ($_SESSION["status"]== '1')
                        { ?>
                          <th > <div align="center">วันที่แก้ไขล่าสุด</div></th>
                          <th > <div align="center">ผู้ใช้</div></th>
                          <td > <div hidden><!--Edit--> </div></td>
                        <?php 
                        } 
                        ?>
                    </tr>
                  </tfoot>
                </table>
                <center>
                <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">ลงทะเบียน แพทย์</h4>
                        </div>
                        <div class="modal-body">
                          <form method='POST' action="add_doctor.php">
                                <label >คำนำหน้า</label>
                                <br/>
                                <select name="title" required>
                                  <option selected value="">---เลือก---</option>
                                  <option value="นายแพทย์">นายแพทย์</option>
                                  <option value="แพทย์หญิง">แพทย์หญิง</option>
                                </select>
                                <br/>
                                <br/>
                                <label >ชื่อ</label>
                                <br/>
                                <input type="text" id="name" name="name" required>
                                <br/>
                                <br/>
                                <label >นาสกุล</label>
                                <br/>
                                <input type="text" id="surname" name="surname" required>
                                <br/>
                                <br/>
                                <label >ใบประกอบวิชาชีพแพทย์</label>
                                <br/>
                                <input type="text" id="doc_license" name="doc_license" required>

                        </div>
                        <div class="modal-footer">
                            <center><button class="btn btn-default" type="submit">ยืนยัน</button></center>
                            
                        </form>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </center>



                       
        </div>     
      </div>


    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
</body>
</html>