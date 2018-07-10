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
                <?php
                    ini_set('display_errors', 1);
                    error_reporting(~0);

                    $strKeyName = null;

                    if(isset($_POST["comp"]))
                    {
                        $strKeyName = $_POST["comp"];
                    }
                    $strKeyDep = null;

                    if(isset($_POST["dep"]))
                    {
                        $strKeyDep = $_POST["dep"];
                    }

                    
                ?>
                
            <div class="box-header"><a style="color: black;text-decoration-line: none;" href="">/ แผนก</a>
                <h2>แผนก</h2>
            </div>
                <div>
                    <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                              
                        <label >บริษัท</label>
                            <select  id="comp" name="comp" >
                                <option id="comp_list" value=""> -- เลือก --</option>
                            </select>
                        <label >แผนก</label>
                            <select  id="dep" name="dep" >
                                <option id="dep_list" value=""> -- เลือก --</option>
                            </select>
                              
                        <input name="Search" type="submit" value="ค้นหา" class="btn btn-secondary">
                        <!-- Trigger the modal with a button -->
                        <button style="height: 30px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">เพิ่ม</button>      
                    </form>
                </div></br>
                <?php
                    include('function.php');
                    $query =    "SELECT d.*, c.*,dc.*
                                FROM department AS d
                                    LEFT JOIN dep_comp AS dc ON dc.dep_id  = d.dep_id
                                    LEFT JOIN company AS c ON dc.comp_id  = c.comp_id
                                WHERE c.comp_id LIKE '%".$strKeyName."%' AND d.dep_id LIKE '%".$strKeyDep."%' 
                                ORDER BY dep_comp_no ASC ";

                    $result = mysqli_query($con,$query);
                ?>
                <table id="tablepage" class="display" width="100%">
                    <thead>
                        <tr >

                            <th > <div align="center">ชื่อบริษัท</div></th>
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
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                        ?>
                        <input type="number" hidden  name="txtcomp_id" value="<?php echo $row["comp_id"];?>">
                        <input type="number" hidden name="txtdep_id" value="<?php echo $row["dep_id"];?>">
                          <tr >
                            <td >
                                <?php echo $row["comp_name"];?>
                            </td>
                            <td >
                                <?php echo $row["dep_name"];?>
                                
                            </td>
                            
         
                            
                            <?php
                              if ($_SESSION["status"]== '1')
                              { ?>
                                <td align="center"><?php echo DateThai($row["date_modify"]);?></td>
                                <td align="center"><?php echo $row["user"];?></td>
                                <td align="center"><a href="edit_department_update.php?check_id=<?php echo $row["dep_comp_no"];?>">แก้ไข</a></td>
                              <?php 
                              } 
                              ?>
                          </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <center>
                <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">ลงทะเบียน แผนก</h4>
                    </div>
                    <div class="modal-body">
                      <form method='POST' action="add_department.php">
                                <label >ชื่อแผนก</label><br/>
                                <input type="text" id="dep_name" name="dep_name" required>
                                <br/>
                                <label >ชื่อบริษัท</label><br/>
                                <select name="dep_comp" required>
                                    <option value="" >--เลือก--</option>
                                    <?php
                                        $sqlAddCompany = "SELECT * FROM company";
                                        $result_addcomp=mysqli_query($con,$sqlAddCompany);
                                        while ($row=mysqli_fetch_array($result_addcomp)) {
                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                        }
                                        
                                    ?>
                                </select>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
            
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
    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
</body>
</html>