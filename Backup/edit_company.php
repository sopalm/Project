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
            <div class="box-header">
                <h2>บริษัท</h2>
            </div>
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
                    $strKeyAddress = null;

                    if(isset($_POST["txtKeyaddress"]))
                    {
                        $strKeyAddress = $_POST["txtKeyaddress"];
                    }
                ?>
                <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">

                    
                          รหัสบริษัท
                          <input class="Search" name="txtKeyid" type="number" min="1" id="txtKeyid" value="<?php echo $strKeyID;?>">
                          
                          ชื่อบริษัท
                          <input class="Search" name="txtKeyname" type="text" id="txtKeyname" value="<?php echo $strKeyName;?>">
                          
                          สถานที่ตรวจสุขภาพ
                          <input class="Search" name="txtKeyaddress" type="text" id="txtKeyaddress" value="<?php echo $strKeyAddress;?>">
                          
                          <input name="Search" type="submit" value="ค้นหา" class="btn btn-secondary">

                        <!-- Trigger the modal with a button -->
                        <button  style="height: 30px;" type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">เพิ่ม</button>
       
                </form>
                <?php
                include_once('connection.php');

                $query = "SELECT * 
                          FROM company 
                          WHERE comp_id LIKE '%".$strKeyID."%' AND comp_name LIKE '%".$strKeyName."%' AND comp_address LIKE '%".$strKeyAddress."%' 
                          ORDER BY comp_id ";

                $result = mysqli_query($con,$query); 
                ?>

                <table id="tablepage" class="display" width="100%">
                  <thead>
                    <tr >
                      <th > <div align="center">รหัส </div></th>
                      <th > <div align="center">ชื่อบริษัท </div></th>
                      <th > <div align="center">สถานที่ตรวจสุขภาพ</div></th>

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
                        <td ><div align="center"><?php echo $row["comp_id"];?></div></td>
                        <td ><?php echo $row["comp_name"];?></td>
                        <td ><?php echo $row["comp_address"];?></td>
     
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><?php echo $row["date_modify"];?></td>
                            <td align="center"><?php echo $row["user_modify"];?></td>
                            <td align="center"><a href="edit_company_update.php?comp_id=<?php echo $row["comp_id"];?>">แก้ไข</a></td>
                          <?php 
                          } 
                          ?>
                      </tr>
                    <?php
                    }
                    ?>
                  <tbody>
                </table>
                <center>
                <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">ลงทะเบียน บริษัท</h4>
                        </div>
                        <div class="modal-body">
                          <form method='POST' action="add_company.php">
                                <label >รหัสบริษัท</label>
                                <br/>
                                <input type="number" min="1" id="comp_num" name="comp_num" required>
                                <br/>
                                <br/>
                                <label >ชื่อบริษัท</label>
                                <br/>
                                <input type="text" id="comp_name" name="comp_name" required>
                                <br/>
                                <br/>
                                <label >สถานที่ตรวจสุขภาพ</label>
                                <br/>
                                <textarea id="comp_add" name="comp_add" required></textarea>

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