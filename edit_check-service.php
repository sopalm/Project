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
          
            <div class="box-header"><a style="color: black;text-decoration-line: none;" href="">/ กำหนดการออกตรวจ</a>
                <h2>กำหนดการออกตรวจสุขภาพ</h2>
            </div>
                <?php
                    


                    $query1 = "SELECT * FROM Company";
                    $result1 = mysqli_query($con,$query1);

                    $query2 = "SELECT * FROM doctor";
                    $result2 = mysqli_query($con,$query2);
                ?>
                <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">

                          <button style="height: 30px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">เพิ่มกำหนดการตรวจสุขภาพ</button>

                </form>
                <?php
                include('function.php');
                $query1 = "SELECT cs.*,c.comp_name,ca.address 
                          FROM check_service as cs LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                    LEFT JOIN company as c ON ca.comp_id=c.comp_id 
                          WHERE cs.cs_status = 0 ORDER BY cs.cs_date ASC ";
                $result1 = mysqli_query($con,$query1); 

                if (!$result1)
                  {
                  echo("Error description: " . mysqli_error($con));
                  }

                $query2 = "SELECT cs.*,c.comp_name,ca.address 
                          FROM check_service as cs LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                    LEFT JOIN company as c ON ca.comp_id=c.comp_id 
                          WHERE cs.cs_status > 0 ORDER BY cs.cs_date ASC";
                $result2 = mysqli_query($con,$query2); 

                if (!$result2)
                  {
                  echo("Error description: " . mysqli_error($con));
                  }


                ?>
                <br>
                <h3><u>กำหนดการออกตรวจสุขภาพที่ยังไม่ได้ดำเนินการ</u></h3>
                <div name="table_UNuse">
                <table name="check_service" id="example" class="display" width="100%" >
                  <thead>
                    <tr >
                      <th > <div align="center">วันที่ออกตรวจ</div></th>
                      <th > <div align="center">ชื่อบริษัท</div></th>
                      <th > <div align="center">สถานที่ตรวจ</div></th>
                      <th > <div align="center">จำนวนผู้เข้ารับการตรวจ</div></th>
                      <th > <div align="center">สถานะ</div></th>
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
                      <tr data-href="check-service_list.php?cs_no=<?php echo $row["cs_no"];?>">
                        <td ><div align="center"><?php echo DateThaietc($row["cs_date"]);?></div></td>
                        <td ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["comp_name"];?>"><?php echo $row["comp_name"];?></a></td>
                        <td ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["address"];?>"><?php echo $row["address"];?></a></td>
                        <td ><div align="center"><?php echo $row["cs_total_people"];?></div></td>
                        <td ><div align="center"><?php if($row["cs_date"]==$date){
                          echo "<img src='images\livenow.gif'  width='40' height='20'/>";
                          }else{echo "ยังไม่ได้ตรวจ";}?></div></td>
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><?php echo DateThaietc($row["date_modify"]);?></td>
                            <td align="center"><?php echo $row["user_modify"];?></td>
                            <td align="center"><a href="edit_check-service_update.php?cs_no=<?php echo $row["cs_no"];?>">แก้ไข</a></td>
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
                      <th > <div align="center">วันที่ออกตรวจ</div></th>
                      <th > <div align="center">ชื่อบริษัท</div></th>
                      <th > <div align="center">สถานที่ตรวจ</div></th>
                      <th > <div align="center">จำนวนผู้เข้ารับการตรวจ</div></th>
                      <th > <div align="center">สถานะ</div></th>
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
                </div >
                <!------------------------------------------------------------------------------------------>
                <h3><u>กำหนดการออกตรวจสุขภาพที่ดำเนินการแล้ว</u></h3>
                <div name="table_USE">
                <table name="check_service" id="example2" class="display" width="100%">
                  <thead>
                    <tr >
                      <th > <div align="center">วันที่ออกตรวจ</div></th>
                      <th > <div align="center">ชื่อบริษัท</div></th>
                      <th > <div align="center">สถานที่ตรวจ</div></th>
                      <th > <div align="center">จำนวนผู้เข้ารับการตรวจ</div></th>
                      <th > <div align="center">สถานะ</div></th>
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
                    while($row=mysqli_fetch_array($result2,MYSQLI_ASSOC))
                    {
                    ?>
                      <tr data-href="check-service_list.php?cs_no=<?php echo $row["cs_no"];?>">
                        <td ><div align="center"><?php echo DateThaietc($row["cs_date"]);?></div></td>
                        <td ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["comp_name"];?>"><?php echo $row["comp_name"];?></a></td>
                        <td ><a class="btn" style="color:black;" data-placement="top" data-toggle="popover" data-trigger="hover" data-content="<?php echo $row["address"];?>"><?php echo $row["address"];?></a></td>
                        <td ><div align="center"><?php echo $row["cs_total_people"];?></div></td>
                        <td ><div align="center"><?php if($row["cs_status"]==1){echo "รอผลจากห้องปฏิบัติการ";}
                                                    else{echo "เสร็จสิ้นการตรวจ";} ?></div></td>
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center"><a href="check-service_list.php?cs_no=<?php echo $row["cs_no"];?>" style="display:block;height:100%;width:100%;text-decoration: none;color: black;"><?php echo DateThaietc($row["date_modify"]);?></a></td>
                            <td align="center"><a href="check-service_list.php?cs_no=<?php echo $row["cs_no"];?>" style="display:block;height:100%;width:100%;text-decoration: none;color: black;"><?php echo $row["user_modify"];?></a></td>
                            <td align="center"><a href="edit_check-service_update.php?cs_no=<?php echo $row["cs_no"];?>">แก้ไข</a></td>
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
                      <th > <div align="center">วันที่ออกตรวจ</div></th>
                      <th > <div align="center">ชื่อบริษัท</div></th>
                      <th > <div align="center">สถานที่ตรวจ</div></th>
                      <th > <div align="center">จำนวนผู้เข้ารับการตรวจ</div></th>
                      <th > <div align="center">สถานะ</div></th>
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
                </div >

                <center>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ลงทะเบียน กำหนดการออกตรวจสุขภาพ</h4>
                      </div>
                      <div class="modal-body">
                        <?php 
                          $query = "SELECT * FROM Company";
                          $result = mysqli_query($con,$query);
                          $doctor = "SELECT * FROM doctor";
                          $list = mysqli_query($con,$doctor);
                        ?>
                        <form method='POST' action="add_check-service.php">

                            <label >วันที่ออกตรวจ</label >
                            <br/>
                            <input required="" type="Date" min="<?php echo date("Y-m-d"); ?>" id="cs_date" name="cs_date">
                            <br/>
                            <br/>
                            <label >บริษัท</label>
                            <select  id="comp" name="comp" >
                                <option id="comp_list" value=""> -- เลือก --</option>
                            </select>
                            <label >ที่อยู่</label>
                            <select  id="add" name="add" >
                                <option id="add_list" value=""> -- เลือก --</option>
                            </select>
                            <input required type="number" id="cs_pp" name="cs_pp" value="0" hidden>
                      </div>
                      <div class="modal-footer">
                        <center><button class="btn btn-default" type="submit" name="submit" value="Submit">ยืนยัน</button></center>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                </center>
                
        </div>   
      </div><!--content-wrapper-->
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
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('[data-toggle="popover"]').popover();

            $('#example').on( 'click', 'tbody tr', function () {
            window.location.href = $(this).data('href');
            } );
            $('#example2').on( 'click', 'tbody tr', function () {
            window.location.href = $(this).data('href');
            } );
        });
        

      </script>
  </body>
</html>