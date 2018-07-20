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
            <a style="color: black;text-decoration-line: none;" href="">/ โปรแกรมการตรวจสุขภาพ</a>
                <h2>โปรแกรมการตรวจสุขภาพ</h2>
            </div>
                
               
                <?php
                include('function.php');
                $query = "SELECT *
                          FROM `program_check`";
                $result = mysqli_query($con,$query); 
                if (!$result)
                  {
                  echo("Error description: " . mysqli_error($con));
                  }
                ?>
                <br>
                <div class="row">
                <div class="column">
                 <form name="frmSearch" method="post" action="">
                          <!-- Trigger the modal with a button -->
                          <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">เพิ่มโปรแกรม</button>

                </form>
                </br>
                <form action="" method='POST'>
                <table id="tablepage" class="display" width="100%">
                  <thead>
                    <tr >
                      <th > <div align="center">หมายเลขโปรแกรม</div></th>
                      <th > <div align="center">ชื่อโปรแกรม</div></th>
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
                      <td ><div align="center"><input style="border: none;background: none;width: 100%;" type="submit" name="pro" id="pro" value='<?php echo $row["pro_id"];?>'></div></td>
                        <td ><?php echo $row["pro_name"];?></td>
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td ><?php echo DateThai($row["date_modify"]);?></td>
                            <td ><?php echo $row["user_modify"];?></td>
                            <td ><a href="edit_program_update.php?pro_id=<?php echo $row["pro_id"];?>">แก้ไข</a></td>
                          <?php 
                          } 
                          ?>

                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                 </form>
                </div>
                <div class="column">

                   <?php
                    if (isset($_POST['pro'])) { ?>
                      <form name="frmSearch" method="post" action="">
                          <!-- Trigger the modal with a button -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">เพิ่มรายการ</button>

                </form>
                </br>
                <?php
                $query = "SELECT * FROM program_check LEFT JOIN program_check_u ON program_check.pro_id = program_check_u.pro_id LEFT JOIN program_check_detail ON program_check_detail.checklist_id = program_check_u.checklist_id WHERE program_check.pro_id = '$_POST[pro]' ";
                $result = mysqli_query($con,$query); 
                if (!$result)
                  {
                  echo("Error description: " . mysqli_error($con));
                  }


                ?>
                <table id="tablepage-span" class="display nowrap" width="100%">
                  <thead>
                    <tr >
                      <th > <div align="center">หมายเลขรายการ</div></th>
                      <th > <div align="center">ชื่อรายการตรวจ</div></th>
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
                    $i = 1;
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                      if ($row["checklist_id"]!= NULL && $row["checklist_name_th"]!=NULL) {
                    ?>
                      <tr >
                        <td ><div align="center"><?php echo $i; ?></div></td>
                        <td ><?php echo $row["checklist_name_th"];?></td>
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><?php echo DateThai($row["date_modify"]);?></td>
                            <td align="center"><?php echo $row["user_modify"];?></td>
                            <td align="center"><a href="edit_checklist_update.php?checklist_id=<?php echo $row["checklist_id"];?>">แก้ไข</a></td>
                          <?php 
                          } 
                          ?>

                      </tr>
                    <?php
                    $i++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <?php }?>
                </div>

                </div>

                <center>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ลงทะเบียน โปรแกรมการตรวจสุขภาพ</h4>
                      </div>
                      <div class="modal-body">
                        <?php 
                          $query = "SELECT * FROM Company";
                          $result = mysqli_query($con,$query);
                        ?>
                        <form method='POST' action="add_program.php">
                            <label >หมายเลขโปรแกรม</label >
                            <br/>
                            <input type="number" min="1" id="pro_id" name="pro_id" required >
                            <br/>
                            <br/>
                            <label >ชื่อโปรแกรม</label >
                            <br/>
                            <input required="" type="text" id="pro_name" name="pro_name">
                            <br/>
                      
                      </div>
                      <div class="modal-footer">
                        <center><button class="btn btn-default" type="submit" name="program">ยืนยัน</button></center>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                </center>
 
 <!------- add checklist ------>
                 <center>
                <!-- Modal -->
                <div class="modal fade" id="myModal2" role="dialog">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ลงทะเบียน รายการตรวจสุขภาพ</h4>
                      </div>
                      <div class="modal-body">
                        <?php
                            $query = "SELECT *
                                      FROM `program_check` WHERE pro_id = '$_POST[pro]' ";
                            $result = mysqli_query($con,$query); 

                        ?>
                        <form method='POST' action="add_program.php">
                            <label >เพิ่มใน 
                             <?php
                              while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                              {
                                  echo $row["pro_name"];
                                }
                              ?>
                           </label >
                            <br/>
                            <br/>
                            <label >ชื่อรายการตรวจไทย</label >
                            <br/>
                            <input required="" type="text" id="cl_name" name="cl_name">
                            <br/>
                             <label >ชื่อรายการตรวจอังกฤษ</label >
                            <br/>
                            <input required="" type="text" id="cl_name_en" name="cl_name_en">
                            <br/>
                             <label >อักษรย่อ</label >
                            <br/>
                            <input required="" type="text" id="cl_name_tag" name="cl_name_tag">
                            <br/>
                            <input type="hidden" name="pro_no" value='<?php echo $_POST['pro']; ?>' >
                      </div>
                      <div class="modal-footer">
                        <center><button class="btn btn-default" type="submit" name="checklist" >ยืนยัน</button></center>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                </center>
                
        </div>   
      </div><!--content-wrapper-->

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>