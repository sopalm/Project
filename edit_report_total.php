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
            <div class="box-header">
            <a style="color: black;text-decoration-line: none;" href=""> / ผลการตรวจสุขภาพจากห้องปฏิบัติการ</a>
                <h2>ผลการตรวจจากห้องปฏิบัติการ</h2>
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

                    $strKeyDate = null;
                    if(isset($_POST["txtKeydate"]))
                    {
                        $strKeyDate = $_POST["txtKeydate"];
                    }
                    $strKeyCom = null;
                    if(isset($_POST["txtKeycom"]))
                    {
                        $strKeyCom = $_POST["txtKeycom"];
                    }

                ?>
                <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                          รหัสบัตรประชาชน
                          <input class="Search" name="txtKeyid" type="number" min="1" id="txtKeyid" value="<?php echo $strKeyID;?>">

                          คำนำหน้า
                          <select class="Search" name="txtKeytitle"  >
                            <option value="">--เลือก-- </option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="นาง">นาง</option>
                          </select>
                          
                          ชื่อ
                          <input class="Search" name="txtKeyname" type="text" id="txtKeyname" value="<?php echo $strKeyName;?>">
                          
                          นามสกุล
                          <input class="Search" name="txtKeysurname" type="text" id="txtKeysurname" value="<?php echo $strKeySurname;?>">

                          บริษัท
                          <select class="Search" name="txtKeycom" type="text" id="txtKeycom" value="<?php echo $strKeyCom;?>">
                            <option value="" >---เลือก---</option>
                            <?php
                            $sqlCompany = "SELECT c.comp_id,c.comp_name FROM company as c";
                            $result_comp=mysqli_query($con,$sqlCompany);
                            while ($row=mysqli_fetch_array($result_comp)) {
                                        echo "<option value='".$row[comp_id]."'>".$row[comp_name]."</option>";
                                    }
                            ?>
                          </select>
                          
                          วันที่ตรวจ
                          <input class="Search" name="txtKeydate" type="date" id="txtKeydate" value="<?php echo $strKeyDate;?>">
                          
                          <input name="Search" type="submit" value="ค้นหา" class="btn btn-secondary">
                          <a href="regis_lab.php" style="height: 30px;" class="btn btn-primary"  >เพิ่ม</a>
                </form>
                <?php
                include('connection.php');
                include('function.php');
                $query = "SELECT emp.*,c.comp_name
                          FROM employee as emp LEFT JOIN dep_comp as dc ON emp.dep_comp_no=dc.dep_comp_no
                                                LEFT JOIN company as c ON dc.comp_id=c.comp_id
                          WHERE emp_id LIKE '%".$strKeyID."%' AND emp_name LIKE '%".$strKeyName."%' AND emp_surname LIKE '%".$strKeySurname."%' 
                          AND emp_title LIKE '%".$strKeyTitle."%' AND  dc.comp_id LIKE '%".$strKeyCom."%'  ";

                $result = mysqli_query($con,$query); 
                ?>
                  <table id="tablepage" class="display" width="100%">
                    <thead>
                      <tr >
                        <th > <div align="center">รหัสบัตรประชาชน </div></th>

                        <th > <div align="center">คำนำหน้า</div></th>
                        <th > <div align="center">ชื่อ</div></th>
                        <th > <div align="center">นามสกุล</div></th>
                        <th > <div align="center">บริษัท</div></th>

                        <?php
                            if ($_SESSION["status"]== '1')
                            { ?>
                              <th > <div align="center">วันที่ทำการแก้ไขล่าสุด</div></th>
                              <th > <div align="center">ผู้ใช้</div></th>
                              
                            <?php 
                            } 
                            ?>
                          <th > <div align="center">ผลการตรวจ </div></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                    ?>
                      <tr >
                        <td ><div align="center"><?php echo $row["emp_id"];?></div></td>

                        <td ><div align="center"><?php echo $row["emp_title"];?></div></td>
                        <td ><div align="center"><?php echo $row["emp_name"];?></div></td>
                        <td ><div align="center"><?php echo $row["emp_surname"];?></div></td>
                        <td ><div align="center"><?php echo $row["comp_name"];?></div></td>


                        <?php
                            if ($_SESSION["status"]== '1')
                            { ?>
                              <td ><div align="center"><?php echo DateThai($row["date_modify"]);?></div></td>
                              <td ><div align="center"><?php echo $row["user"];?></div></td>
                              
                            <?php 
                            } 
                            ?>
                        <td ><div align="center"><a href="report_total_personal.php?id=<?php echo $row["emp_id"];?>">ผลการตรวจ</a></div></td>
                      </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
        </div>
   
      </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>