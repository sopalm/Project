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
                <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a class="path" href="check-service_list.php?cs_no=<?php echo $_GET['cs_no']; ?>">/ ข้อมูลการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / เพิ่มรายชื่อผู้เข้ารับการตรวจ</a>
                <?php 
                    if (isset($_GET['cs_no'])) { 
                
                  $get=$_GET['cs_no'];
                  include('function.php'); 
                  $sqlcompany = "SELECT c.comp_name,cs.cs_date,cs.cs_no ,c.comp_id
                                  FROM check_service as cs  LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                            LEFT JOIN company as c ON ca.comp_id=c.comp_id
                                  WHERE cs.cs_no = $get ";
                   $resultcompany=mysqli_query($con,$sqlcompany);
                   $company=mysqli_fetch_array($resultcompany);  

                   $sqldep = "SELECT d.dep_id,d.dep_name
                                  FROM department as d  LEFT JOIN dep_comp as dc ON d.dep_id=dc.dep_id
                                                        LEFT JOIN company as c ON dc.comp_id=c.comp_id
                                  WHERE c.comp_id = '$company[3]' ";
                   $resultdep=mysqli_query($con,$sqldep);

                   $sqltitle="SELECT DISTINCT emp_title FROM employee ";
                   $title=mysqli_query($con,$sqltitle);

                   }
                   else{
                    echo "<script language=\"JavaScript\">";
                    echo "window.location='edit_check-service.php';";
                    echo "</script>";
                   }             
                ?>
                <h2>ลงทะเบียน พนักงานที่เข้าการตรวจสุขภาพของบริษัท <?php echo $company[0];?> วันที่ <?php echo DateThaiShow($company[1]);?> </h2>

            </div>
            <!-- Trigger the modal with a button -->
            <button  style="height: 30px;" type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">ลงทะเบียนรายบุคคล </button>

                <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #3399ff;color: white;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <center><h4 class="modal-title">ลงทะเบียน พนักงานที่เข้าการตรวจสุขภาพ<br>บริษัท <?php echo $company[0];?> วันที่ <?php echo DateThaietc($company[1]);?></h4></center>
                        </div>
                        <div class="modal-body">
                            <form method='POST' action="add_employee.php" enctype='multipart/form-data'>
                                <label >ลำดับ</label>
                                <input style="max-width: 60px; " type="number" min="1" maxlength="4" id="emp_num" name="emp_num" required>
                                <label >เลข H.N</label>
                                <input type="text" id="emp_id" name="emp_id"  maxlength="13" required>
                                <label >เลข V.N</label>
                                <input type="text" id="vn" name="vn"  maxlength="13" required >
                                </br></br>
                                <label >คำนำหน้า</label>
                                <select name="title">
                                <?php 
                                    while ($row=mysqli_fetch_array($title)) {
                                        echo "<option value='".$row[0]."'>".$row[0]."</option>";
                                    }
                                ?>
                                </select>

                                <label >ชื่อ</label>
                                <input type="text" id="emp_name" name="emp_name" style="width: 100px;" required>

                                <label >นามสกุล</label>
                                <input type="text" id="emp_surname" name="emp_surname" style="width: 100px;" required>
                                <br/>
                                <br/>
                                <label >วันเกิด</label>
                                <input type="date" id="birthday" max="<?php echo date("Y-m-d"); ?>" name="birthday" required>
                                <label >อายุ</label>
                                <input type="number" min="18" max="70" id="age" name="age" required>

                                <input type="hidden" required id="comp" name="comp" value="<?php echo $company[3]; ?>"><!--บริษัท-->
                                <label >แผนก</label>
                                <select id="dep" name="dep" >
                                    <option value="">--- เลือก ---</option>
                                    <?php
                                        while ($row=mysqli_fetch_array($resultdep)) {
                                            echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                        }
                                        
                                    ?>
                                </select>
                                </br></br>
                                <label >โปรแกรมการตรวจสุขภาพ</label>
                                <select name='emp_pro' required>
                                    <option value="">--- เลือก ---</option>
                                    <?php
                                        $sqlCommand = "SELECT * FROM program_check";
                                        $result=mysqli_query($con,$sqlCommand);
                                        while ($row2=mysqli_fetch_array($result)) {
                                            echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
                                        }
                                        
                                    ?>
                                </select>
                                </br></br>
                                <input type="hidden" required name='emp_check_no' value="<?php echo $get; ?>">

                        </div>
                        <div class="modal-footer">
                                <center><input type="submit" name="submit_emp" value="ยืนยัน"></center>
                            </form>
                        </div>
                      </div>
                      
                    </div>
                  </div>

            
                
        

        <div>
            <br/>
            <form action="" method="post" enctype="multipart/form-data" >
            
            <input type="hidden" required name='emp_comp_excel' value="<?php echo $company[3]; ?>">
            <input type="hidden" required name='cs_no' value="<?php echo $company[2]; ?>">
            <label for="file">Filename:</label><br/>
            <input name="file_src" type="hidden" value="">
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submitfile" value="เปิดไฟล์">
            <input type="submit" name="clear" value="ลบไฟล์">
            </form></br>
            <b><u>ตัวอย่างหัวข้อตาราง</u></b>
        <table width="750" border="0">
            <thead>
                <tr>  
                    <th>ลำดับ</th>
                    <th align="center">H.N</th>
                    <th align="center">V.N</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>วัน/เดือน/ปีเกิด</th>
                    <th>อายุ</th>
                    <th>แผนก</th>
                </tr>
            </thead>
        </table>
            <?php include('regis_emp_excel.php'); ?>
        </div>
     </div>
    </div>

     <!-- นำเข้า Javascript jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

    <!-- <script language="javascript" type="text/javascript">
            function getPath() {
            var Form = document.forms['frm_upload'];
            var inputName = Form.elements['file'].value;

            var imgPath = inputName;
            Form.elements['file_src'].value = imgPath;
            }
        </script>
    
    <script> -->
            
            $(function(){
                
                //เรียกใช้งาน Select2
                $(".select2-single").select2();
                
                //ดึงข้อมูล province จากไฟล์ get_data.php
                $.ajax({
                    url:"get_data.php",
                    dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
                    data:{show_comp:'show_comp'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
                    success:function(data){
                        
                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function( index, value ) {
                            //แทรก Elements ใน id province  ด้วยคำสั่ง append
                              $("#comp").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                        });
                    }
                });
                
                
                //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
                $("#comp").change(function(){
 
                    //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
                    var comp_id = $(this).val();
                    
                    $.ajax({
                        url:"get_data.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{comp_id:comp_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                        success:function(data){
                            
                            //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                            $("#dep").text("");
                            
                            //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                            $.each(data, function( index, value ) {
                                
                                //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                                  $("#dep").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                            });
                        }
                    });
 
                });
            });
            
    </script>
    


    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>