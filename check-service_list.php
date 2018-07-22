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
            <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / ข้อมูลการออกตรวจ</a>
            <?php 

            if (isset($_GET['cs_no'])) { 
                
              $get=$_GET['cs_no'];
              include('function.php'); 
              $sqlcompany = "SELECT c.comp_name,cs.cs_date,cs.cs_total_people,cs.cs_no 
                              FROM check_service as cs  LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                        LEFT JOIN company as c ON ca.comp_id=c.comp_id
                              WHERE cs.cs_no = $get ";
               $resultcompany=mysqli_query($con,$sqlcompany);
               $company=mysqli_fetch_array($resultcompany)               
            ?>
                <h2>ข้อมูลการตรวจสุขภาพของบริษัท <?php echo $company[0];?> วันที่ <?php echo DateThaiShow($company[1]);?> </h2>
            </div>
               
               
               <div  >
                <div name="emp">
                <u>รายชื่อผู้เข้ารับการตรวจสุขภาพ</u> 
                <a href="emp_list.php?cs_no=<?php echo $company["cs_no"];?>" class="btn btn-primary">ใบลงทะเบียน</a>
                <a href="check_point.php?cs_no=<?php echo $company["cs_no"];?>&check=0" class="btn btn-primary">สถานะการตรวจสุขภาพ</a>
                <a href="regis_lab.php?cs_no=<?php echo $company["cs_no"];?>" class="btn btn-primary"  >เพิ่มผลการตรวจจากห้องปฏิบัติการ</a>
                <a href="report_list.php?cs_no=<?php echo $company["cs_no"];?>" class="btn btn-primary"  >ผลการตรวจภาพรวม</a>
                <a href="check_point.php?cs_no=<?php echo $company["cs_no"];?>&check=1" class="btn btn-primary"  >จัดการเจ้าหน้าที่</a>
                <?php if($company[2]>0){ ?>
                        <table id="tablepage-span" class="display" width="100%" border="0">
                        <thead>
                          <tr >
                            <th > <div align="center">ลำดับ </div></th>
                            <th > <div align="center">H.N </div></th>
                            <th > <div align="center">V.N </div></th>
                            <th > <div align="center">คำนำหน้า</div></th>
                            <th > <div align="center">ชื่อ</div></th>
                            <th > <div align="center">นามสกุล</div></th>
                            <th > <div align="center">วันเกิด</div></th>
                            <th > <div align="center">อายุ</div></th>
                            <th > <div align="center">โปรแกรมที่ตรวจ</div></th>
                            <th > <div align="center">หมายเหตุ</div></th>
                            <th > <div align="center">ผลการตรวจ</div></th>
                          </tr>
                        </thead>
                        <tbody>
              <?php
                  
                  $sqlCommand = "SELECT * FROM `employee` LEFT JOIN check_list ON check_list.emp_id = employee.emp_id LEFT JOIN check_service_detail ON check_list.csd_no = check_service_detail.csd_no LEFT JOIN program_check ON check_service_detail.pro_id = program_check.pro_id WHERE check_service_detail.cs_no = $get ORDER BY employee.emp_no ";
                  $result=mysqli_query($con,$sqlCommand);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        { ?>
                          <tr  data-href="emp_card_personal.php?cs_no=<?php echo $company["cs_no"];?>&id=<?php echo $row["emp_id"];?>">
                          <td ><div align='center'><?php echo $row["emp_no"];?></div></td>
                          <td ><div align='center'><?php echo $row["emp_id"];?></div></td>
                          <td ><div align='center'><?php echo $row["VN"];?></div></td>
                          <td ><div><?php echo $row["emp_title"];?></div></td>
                          <td ><?php echo $row["emp_name"];?></td>
                          <td ><?php echo $row["emp_surname"];?></td>
                          <td ><div align='center'><?php echo DateThaietc($row["emp_bd"]);?></div></td>
                          <td ><div align='center'><?php echo Age($row["emp_bd"]);?></div></td>
                          <td ><div><?php echo $row["pro_name"];?></div></td>
                          <td ><div align='center'></div></td>
                          <td ><div align='center'>ผลการตรวจ</div></td>
                          </tr>
                      <?php
                      }
                      echo "</tbody>"; 
                   echo "</table>"; ?>     
                    </div>
                <?php }else{
                  echo "<br><h3>ยังไม่มีข้อมูลผู้เข้ารับการตรวจสุขภาพ</h3>";
                }
                ?>

                <a href="regis_emp.php?cs_no=<?php echo $get; ?>" style="height: 30px;" class="btn btn-primary"  >เพิ่มรายชื่อผู้เข้ารับการตรวจ</a>

                    <div class="row">
                        <?php 
                          $sqldoc = "SELECT dc.*,d.* FROM doctor_check_service as dc LEFT JOIN doctor as d ON dc.doc_id = d.doc_id WHERE dc.cs_no = $get ";
                          $resultdoc=mysqli_query($con,$sqldoc);

                          $querypro = "SELECT pc.pro_id,pc.pro_name,csd.csd_pro_people
                          FROM check_service_detail as csd LEFT JOIN program_check as pc ON csd.pro_id=pc.pro_id 
                          WHERE csd.cs_no= $get ";
                          $resultpro = mysqli_query($con,$querypro);
                        ?>
                      <div class="column">
                        <u>รายชื่อแพทย์ที่ตรวจสุขภาพ</u>
                        <table id="tablepage-page" class="display" width="100%">
                        <thead>
                          <th > <div align="center">คำนำหน้า</div></th>
                            <th > <div align="center">ชื่อ</div></th>
                            <th > <div align="center">นามสกุล</div></th>
                            <th><!--DELETE--></th>
                        </thead>
                          <tbody>
                            <?php
                            while($row=mysqli_fetch_array($resultdoc,MYSQLI_ASSOC))
                            {
                            ?>
                              <tr >
                                <td align="center"><?php echo $row["doc_title"];?></td>
                                <td ><?php echo $row["doc_name"];?></td>
                                <td ><?php echo $row["doc_surname"];?></td>
                                <form method="POST" action="add_doctor_service.php">
                                  <input type="hidden" required name="cs_no" value="<?php echo $get; ?>">
                                  <td align="center"><button class="btn btn-danger" type="submit" name="delete" value="<?php echo $row["doc_id"];?>" 
                                  onclick="return confirm('ต้องการลบ<?php echo $row["doc_title"];?> <?php echo $row["doc_name"];?> <?php echo $row["doc_surname"];?> ออกจากการตรวจ?')">ลบ</button></td>
                                </form>
                              </tr>
                            <?php
                            }
                            ?>
                          <tbody>
                        </table>
                        <br>
                        <!-- Trigger the modal with a button -->
                        <button  style="height: 30px;" type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">เพิ่มแพทย์ที่ออกตรวจ</button>
                        <center>
                        <!-- Modal -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog ">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">เลือกแพทย์สำหรับการออกตรวจ</h4>
                                </div>
                                <div class="modal-body">
                                <?php 
                                  $doctor = "SELECT * FROM doctor as d
                                            WHERE NOT d.doc_id
                                            IN (  SELECT dcs.doc_id FROM doctor_check_service as dcs 
                                                  WHERE dcs.cs_no = '$get'
                                                )";
                                  $list = mysqli_query($con,$doctor);
                                ?>
                                  <form method='POST' action="add_doctor_service.php">

                                      <table id="tablepage" class="display">
                                        <thead>
                                          <tr align="center">
                                            <th><div>เลือก</div></th>
                                            <th><div>คำนำหน้า</div></th>
                                            <th><div>ชื่อ</div></th>
                                            <th><div>นามสกุล</div></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                          while($row=mysqli_fetch_array($list,MYSQLI_ASSOC)){ ?>

                                          <tr  >
                                            <td width="30">
                                              <div align="center"><input type="checkbox" name="check_list[]" value="<?php echo $row["doc_id"];?>"></div>
                                            </td>
                                            <td  >
                                              <div><?php echo $row["doc_title"];?></div>
                                            </td>
                                            <td  >
                                              <div><?php echo $row["doc_name"];?></div>
                                            </td>
                                            <td  >
                                              <div><?php echo $row["doc_surname"];?></div>
                                            </td>
                                          </tr>
                                        <?php
                                          }
                                        ?>
                                        </tbody>

                                      </table>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" required name="cs_no" value="<?php echo $get; ?>">
                                    <center><button class="btn btn-default" type="submit" name="submit" value="Submit">ยืนยัน</button></center>
                                    
                                  </form>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </center>
                      </div>
                      <div class="column">
                        <u>โปรแกรมการตรวจสุขภาพ และจำนวนผู้เข้ารับการตรวจของแต่ละโปรแกรม</u>
                        <table id="tablepage-page2" class="display" width="100%">
                        <thead>
                          <th > <div align="center">หมายเลขโปรแกรม</div></th>
                            <th > <div align="center">ชื่อโปรแกรม</div></th>
                            <th > <div align="center">จำนวนผู้เข้ารับการตรวจ</div></th>
                        </thead>
                          <tbody>
                            <?php
                            while($row=mysqli_fetch_array($resultpro,MYSQLI_ASSOC))
                            {
                            ?>
                              <tr >
                                <td align="center"><?php echo $row["pro_id"];?></td>
                                <td ><?php echo $row["pro_name"];?></td>
                                <td align="center" ><?php echo $row["csd_pro_people"];?>&nbsp;คน</td>
                              </tr>
                            <?php
                            }
                            ?>
                          <tbody>
                        </table>
                      </div>
                    </div>
          <?php
              }

          ?>            

              
              
           </div>



                       
        </div>     
      </div>


    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#tablepage-span').on( 'click', 'tbody tr', function () {
              window.open($(this).data('href'),'_blank');
            } );
        });
        

      </script>
</body>
</html>