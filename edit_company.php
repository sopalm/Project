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
              <a style="color: black;text-decoration-line: none;" href="">/ รายชื่อบริษัทที่เข้ารับการตรวจ</a>

            </div>

                <div class="row">
                  <div class="column" name="1">
                  <h2 style="margin-top: 0px;">บริษัท</h2>


                    <!-- Trigger the modal with a button -->
                    <button  style="height: 30px;" type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">เพิ่ม</button>
                    <br><br>
                    <?php
                    include('function.php');
                    $query = "SELECT * 
                              FROM company  ";

                    $result = mysqli_query($con,$query); 
                    $color='';
                    ?>

                    <table name="company" id="example" class="display nowrap" width="100%" >
                      <thead>
                        <tr >
                          <th > <div align="center">รหัส </div></th>
                          <th > <div align="center">ชื่อบริษัท </div></th>
                          

                          <?php
                            if ($_SESSION["status"]== '1')
                            { ?>
                              <th > <div align="center">วันที่แก้ไขล่าสุด</div></th>
                              <th > <div align="center">ผู้ใช้</div></th>
                              <th > <div align="center"><!--Edit--> </div></th>
                            <?php 
                            } 
                            ?>
                          <th align="center" style="border: 0px;"></th>
                        </tr>
                      </thead>
                      <tbody >
                        <?php
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                          if(isset($_POST["dep_s"]))
                          {
                            if($_POST["dep_s"]==$row["comp_id"]){
                              $color='#e6ffff';
                            }else{
                              $color='';
                            }
                          }else{
                            $color='';
                          }
                        ?>
                          <tr data-href='edit_company_data.php?id=<?php echo $row["comp_id"];?>'>
                            <td bgcolor='<?php echo $color; ?>' ><div align="center"><?php echo $row["comp_id"];?></div></td>
                            <td bgcolor='<?php echo $color; ?>' ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["comp_name"];?>"><?php echo $row["comp_name"];?></a></td>
                            
         
                            <?php
                              if ($_SESSION["status"]== '1')
                              { ?>

                                <td bgcolor='<?php echo $color; ?>' align="center"><?php echo DateThaimod($row["date_modify"]);?></td>
                                <td bgcolor='<?php echo $color; ?>' align="center"><?php echo $row["user_modify"];?></td>
                                <td bgcolor='<?php echo $color; ?>' align="center"><a href="edit_company_update.php?comp_id=<?php echo $row["comp_id"];?>">แก้ไข</a></td>
                              <?php 
                              } 
                              ?>
                              <form action="" method="POST">
                                <td align="center" style="background: #ecf0f5;">
                                  <input type="hidden" name="dep_s" value="<?php echo $row["comp_id"];?>" >
                                  <button type="submit" value="submit" class="btn btn-default">แผนก</button>
                                </td>
                              </form>
                              
                          </tr>
                        <?php
                        }
                        ?>
                      <tbody>
                      <tfoot>
                        <tr >
                          <th > <div align="center">รหัส </div></th>
                          <th > <div align="center">ชื่อบริษัท </div></th>
                          

                          <?php
                            if ($_SESSION["status"]== '1')
                            { ?>
                              <th > <div align="center">วันที่แก้ไขล่าสุด</div></th>
                              <th > <div align="center">ผู้ใช้</div></th>
                              <td > <div align="center"><!--Edit--> </div></td>
                            <?php 
                            } 
                            ?>
                            <td align="center" style="border: 0px;"></td>
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
                              <h4 class="modal-title">ลงทะเบียน บริษัท</h4>
                            </div>
                            <div class="modal-body">
                              <form method='POST' action="add_company.php">
                                    <label >รหัสบริษัท</label>
                                    <br/>
                                    <input type="text" id="comp_num" name="comp_num" required>
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
                <!-------------------------->
                  <div class="column" name="2">
                  <?php if(isset($_POST["dep_s"])){ ?>
                    <?php
                    $query1 =  "SELECT d.*, c.*,dc.*
                                FROM department AS d
                                    LEFT JOIN dep_comp AS dc ON dc.dep_id  = d.dep_id
                                    LEFT JOIN company AS c ON dc.comp_id  = c.comp_id
                                WHERE c.comp_id = '$_POST[dep_s]' ";

                        $result1 = mysqli_query($con,$query1);

                    $sqlcomp ="SELECT comp_name,comp_id FROM company WHERE comp_id = '$_POST[dep_s]'";
                    $resultcomp = mysqli_query($con,$sqlcomp);
                    $comp=mysqli_fetch_array($resultcomp);
                    ?>
                  <h2 style="margin-top: 0px;">แผนก </h2>
                    <!-- Trigger the modal with a button -->
                    <button style="height: 30px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">เพิ่ม</button>  
                    <br><br>    
                    
                    <table id="example2" name="company" class="display nowrap"  width="100%" >
                        <thead>
                            <tr >

                                <th > <div align="center">ชื่อแผนก</div></th>
                                
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
                            while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC))
                            {
                            ?>
                            <input type="number" hidden  name="txtcomp_id" value="<?php echo $row["comp_id"];?>">
                            <input type="number" hidden name="txtdep_id" value="<?php echo $row["dep_id"];?>">
                              <tr >
                                <td bgcolor='#e6ffff' ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["dep_name"];?>">
                                    <?php echo $row["dep_name"];?>
                                    </a>
                                </td>
                                
             
                                
                                <?php
                                  if ($_SESSION["status"]== '1')
                                  { ?>
                                    <td bgcolor='#e6ffff' align="center"><?php echo DateThaimod($row["date_modify"]);?></td>
                                    <td bgcolor='#e6ffff' align="center"><?php echo $row["user_modify"];?></td>
                                    <td bgcolor='#e6ffff' align="center"><a href="edit_department_update.php?check_id=<?php echo $row["dep_comp_no"];?>">แก้ไข</a></td>
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
                                <th > <div align="center">ชื่อแผนก</div></th>
                                
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
                    <center>
                        <!-- Modal -->
                        <?php 
                          $sqldep ="SELECT * FROM department as d
                                    WHERE NOT d.dep_id
                                    IN (  SELECT d.dep_id FROM department as d 
                                                JOIN dep_comp as dc ON d.dep_id=dc.dep_id
                                                JOIN company AS c ON dc.comp_id  = c.comp_id
                                          WHERE c.comp_id = '$_POST[dep_s]'
                                        ) ";
                          $querydep=mysqli_query($con,$sqldep); 

                        ?>
                      <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog ">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">บริษัท <?php echo $comp[0]; ?> </h4><br>
                              <h4 class="modal-title">ลงทะเบียน แผนก </h4>
                            </div>
                            <div class="modal-body">
                              <form method='POST' action="add_department.php">
                                        
                                    <table id="tablepage-span" class="display" >
                                      <thead>
                                        <tr align="center">
                                          <th><div>เลือก</div></th>
                                          <th><div>ชื่อ</div></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php 
                                        while($row=mysqli_fetch_array($querydep,MYSQLI_ASSOC)){ ?>

                                        <tr  >
                                          <td width="30">
                                            <div align="center"><input type="checkbox" name="check_list[]" value="<?php echo $row["dep_id"];?>"></div>
                                          </td>
                                          <td  >
                                            <div><?php echo $row["dep_name"];?></div>
                                          </td>
                                        </tr>
                                      <?php
                                        }
                                      ?>
                                      </tbody>

                                    </table>
                                        <label >ชื่อแผนก</label><br/>
                                        <input type="text" id="dep_name" name="dep_name">
                                        <br/>
                                        <input hidden type="text" id="dep_comp" name="dep_comp" value="<?php echo $comp[1]; ?>" required>

                            </div>
                            <div class="modal-footer">
                                <center><button class="btn btn-default" type="submit">ยืนยัน</button></center>
                              
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </center>
                    <?php } ?>
                  </div>

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

            $('#example').on( 'click', 'tbody tr', function () {
            window.location.href = $(this).data('href');
            } );
        });
        

      </script>
</body>
</html>