<!DOCTYPE html>
<html>

    <?php include("head.php"); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <body class="skin-blue">
    <?php include("header.php"); ?>
      
    <?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <div class="body">
         <!-- Main content --> 
         <div class="box-header">
            <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a class="path" href="check-service_list.php?cs_no=<?php echo $_GET['cs_no']; ?>">/ ข้อมูลการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / จัดการเจ้าหน้าที่</a>
        </div> 
         

          <?php
            include('function.php');
                if(isset($_GET['cs_no'])){
                  $sqlcp = "SELECT c.comp_name,cs.cs_date
                            FROM company as c  LEFT JOIN company_address as ca ON c.comp_id=ca.comp_id 
                                                LEFT JOIN check_service as cs ON cs.ca_id=ca.ca_id 
                            WHERE cs.cs_no = $_GET[cs_no]";
                  $querycp=mysqli_query($con,$sqlcp);
                  $cp=mysqli_fetch_array($querycp);
                  if (!$querycp)
                  {
                    echo("Error description: " . mysqli_error($con));
                  }
                }       
                $query = "SELECT user.*,cst.tag,cst.cs_no 
                          FROM user JOIN check_service_tag as cst ON cst.cst_id=user.cst_id
                          
                          ORDER BY user.user_id ";

                $result = mysqli_query($con,$query);
                $sqltag= "SELECT * FROM check_service_tag WHERE cs_no = $_GET[cs_no] ";
                $resulttag = mysqli_query($con,$sqltag);

                $edit=1;
              ?>

        <div >
         <h2 align="center">จัดการเจ้าหน้าที่ในการตรวจสุขภาพของบริษัท <?php echo $cp["comp_name"]; ?><br> วันที่ <?php echo DateThaiShow($cp["cs_date"]); ?></h2>
         <table id="tablepage" class="display">
                  <thead>
                    <tr >
                      <th > <div align="center">รหัสผู้ใช้ </div></th>
                      <th > <div align="center">ชื่อผู้ใช้งาน</div></th>
                      <th > <div align="center">จุดตรวจ </div></th>
                      <th > <div align="center">สถานะ </div></th>
                      <th > <div align="center">วันที่ทำการแก้ไขล่าสุด </div></th>
                      <th > <div align="center">ผู้ใช้ </div></th>

                      <?php
                        if ($_SESSION["status"]== '1')
                        { ?>
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
                        <td ><div align="center"><?php echo $row["user_id"];?></div></td>
                        <td ><?php echo $row["user_name"];?></td>
                        <td align="center">
                          <?php if($row["cs_no"]==$_GET["cs_no"]){
                                  echo $row["tag"];
                                }else{
                                  echo "ยังไม่กำหนด";
                                  } ?>
                        </td>
                        <td ><center><?php echo $row["user_status"];?></center></td>
                        <td ><center><?php echo $row["date_modify"];?></center></td>
                        <td ><center><?php echo $row["user"];?></center></td>
     
                        <?php
                          if ($_SESSION["status"]== '1')
                          { ?>
                            <td align="center">

                              <a data-toggle="modal" href="#editsup" class="edit-sup"
                              data-supID="<?php echo $row["user_id"];?>"
                              data-supName="<?php echo $row["user_name"];?>"
                              data-tag="<?php echo $row["tag"];?>"
                              
                              ><button name="edit" type="button" class="btn btn-primary">แก้ไข</button></a>

                            </td>
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
                      <div class="modal fade" id="editsup" role="dialog">
                        <div class="modal-dialog modal-sm">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ลงทะเบียน จุดตรวจ</h4>
                            </div>
                            <div class="modal-body">
                              <form method='POST' action="">
                                    <input type="text" id="supID" name="supID" style="width: 30px;border: none;">
                                    <input type="text" id="supName" name="supName" style="width: 50px;border: none;">
                                    <SELECT>
                                      <option value="" selected>--เลือก--</option>
                                      <?php 
                                        while($row=mysqli_fetch_array($resulttag,MYSQLI_ASSOC)){
                                          echo "<option value='".$row["cst_id"]."'>".$row["tag"]."</option>";
                                        }
                                      ?>
                                    </SELECT>

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
    </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>