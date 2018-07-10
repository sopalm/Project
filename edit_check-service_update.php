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
            
            <div class="box-header"><a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไข</a>
                <h2>แก้ไข กำหนดการออกตรวจสุขภาพ</h2>
            </div>
                <?php
                include_once('connection.php');

                $strCSID = null;
                
                if(isset($_GET["cs_no"]))
                {
                    $strCSID = $_GET["cs_no"];
                }
                $doctor = "  SELECT * FROM doctor ";
                $list =mysqli_query($con,$doctor);

                $doc_service = "  SELECT * FROM doctor_check_service WHERE cs_no = '".$strCSID."' ";
                $checked =mysqli_query($con,$doc_service);
                //$check=mysqli_fetch_array($checked,MYSQLI_ASSOC);

                $sql_comp = "SELECT * FROM company "; 
                $query_comp = mysqli_query($con,$sql_comp);

                $sql_add = "SELECT c.*,ca.ca_id,ca.address FROM company as c LEFT JOIN company_address as ca ON c.comp_id=ca.comp_id ";
                $query_add = mysqli_query($con,$sql_add);

                $sql = "SELECT cs.*,ca.comp_id,c.comp_name 
                        FROM check_service as cs LEFT JOIN company_address as ca ON ca.ca_id=cs.ca_id
                                                LEFT JOIN company as c ON c.comp_id=ca.comp_id
                        WHERE cs_no = '".$strCSID."' "; 
                $query = mysqli_query($con,$sql);
                $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

                ?>
                <form action="edit_check-service_method.php" name="frmAdd" method="post">
                <table >
                    <tr>
                        <th width="200">รหัสการออกตรวจ</th>
                        <td width="200"><input type="hidden" name="txtID" value="<?php echo $result["cs_no"];?>"><?php echo $result["cs_no"];?></td>
                    </tr>
                    <tr>
                        <th>บริษัท</th>
                        <td>
                            <select  id="comp" name="comp" >
                                <option id="comp_list" value=""> -- เลือก --</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>ที่อยู่</th>
                        <td>
                            <select  id="add" name="add" >
                                <option id="add_list" value=""> -- เลือก --</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">วันที่ทำการออกตรวจ</th>
                        <td ><input required type="Date" name="txtDate" size="20" value="<?php echo $result["cs_date"];?>"></td>
                    </tr>

                  </table>
                            
                  <input type="submit" name="submit" value="ยืนยัน">
                </form>
        </div>
       
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
            
            $(function(){
                
                //เรียกใช้งาน Select2
                $(".select2-single").select2();
                
                //ดึงข้อมูล province จากไฟล์ get_data.php
                $.ajax({
                    url:"get_address.php",
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
                        url:"get_address.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{comp_id:comp_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                        success:function(data){
                            
                            //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                            $("#add").text("");
                            
                            //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                            $.each(data, function( index, value ) {
                                
                                //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                                  $("#add").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                            });
                        }
                    });
 
                });
            });
            
    </script>
    <?php 
    include("footer.php");
    include("js/DataTable.js");
    ?>
  </body>
</html>