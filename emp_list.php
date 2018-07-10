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
            <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a class="path" href="check-service_list.php?cs_no=<?php echo $_GET['cs_no']; ?>">/ ข้อมูลการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / ใบรายชื่อผู้เข้ารับการตรวจ</a>
        </div> 
         <div>
          <form method='POST' action="" >
            <label >เลือก กำหนดาการออกตรวจสุขภาพ</label>
           <select name='check_service' required>
                <option value="">--- เลือก ---</option>
                <?php
                    include('function.php');
                  

                    $sqlCommand = "SELECT cs.cs_no,cs.cs_date,c.comp_name
                    FROM check_service as cs  LEFT JOIN company_address as ca ON cs.ca_id = ca.ca_id 
                                              LEFT JOIN company as c ON c.comp_id = ca.comp_id";
                    $result=mysqli_query($con,$sqlCommand);
                    while ($row3=mysqli_fetch_array($result)) {
                        echo "<option value='".$row3[0]."'>".$row3[1]." ".$row3[2]."</option>";
                    }
                    
                ?>
            </select>
            <input style="height: 30px; width: 60px;" class="btn btn-primary" type="submit" name="submit_emp_list" value="submit">
             <input name="Search" class="btn btn-secondary" type="submit" name="clear" value="clear">
          </form>
          </div>

          <?php if (isset($_POST['submit_emp_list'])||isset($_GET['cs_no'])) { 
                    if (isset($_POST['submit_emp_list'])){
                      $sqlcp = "SELECT c.comp_name,cs.cs_date
                            FROM company as c  LEFT JOIN company_address as ca ON c.comp_id=ca.comp_id 
                                                LEFT JOIN check_service as cs ON cs.ca_id=ca.ca_id 
                            WHERE cs.cs_no = $_POST[check_service]";
                      $querycp=mysqli_query($con,$sqlcp);
                      $cp=mysqli_fetch_array($querycp);
                    }
                    else 
                    {
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
                    }
            ?>
          <input type="button" value="Print" name="Search" class="btn btn-secondary" onclick="PrintDoc()"/>
         
         <div class="page-break" id="printarea">
         <h2 align="center">รายชื่อพนักงานที่เข้ารับการตรวจสุขภาพของบริษัท <?php echo $cp["comp_name"]; ?><br> วันที่ <?php echo DateThaiShow($cp["cs_date"]); ?></h2>
          <div >
                  <center>
                  <table id="" border="1">
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
                      <th width="100"> <div align="center">ลงชื่อ</div></th>
                    </tr>
                  </thead>
                  <tbody>
        <?php
            include('connection.php');
            if (isset($_POST['submit_emp_list']))
            {
              $c = 0;
              $p = 0;
              $sqlCommand = "SELECT * FROM `employee` LEFT JOIN check_list ON check_list.emp_id = employee.emp_id LEFT JOIN check_service_detail ON check_list.csd_no = check_service_detail.csd_no LEFT JOIN program_check ON check_service_detail.pro_id = program_check.pro_id WHERE check_service_detail.cs_no = '$_POST[check_service]' ORDER BY employee.emp_no ";
            }
            if (isset($_GET['cs_no']))
            {
              $c = 0;
              $p = 0;
              $sqlCommand = "SELECT * FROM `employee` LEFT JOIN check_list ON check_list.emp_id = employee.emp_id LEFT JOIN check_service_detail ON check_list.csd_no = check_service_detail.csd_no LEFT JOIN program_check ON check_service_detail.pro_id = program_check.pro_id WHERE check_service_detail.cs_no = '$_GET[cs_no]' ORDER BY employee.emp_no ";
            }
            $result=mysqli_query($con,$sqlCommand);
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                  { 
                    
                    echo "<tr  >";
                      echo "<td align='center'><div>".$row['emp_no']."</div></td>";
                      echo "<td ><div align='center'>".$row['emp_id'];
                      echo "</div></td>";
                      echo "<td align='center'><div>".$row['VN']."</div></td>";
                      echo "<td ><div>".$row['emp_title']."</div></td>";
                      echo "<td >".$row['emp_name']."</td>";
                      echo "<td >".$row['emp_surname']."</td>";
                      echo "<td ><div align='center'>".DateThaietc($row['emp_bd'])."</div></td>";
                      echo "<td ><div align='center'>".$row["emp_age"]."</div></td>";
                      echo "<td ><div>".$row["pro_name"]."</div></td>";
                      echo "<td ><div align='center'>"."</div></td>";
                      echo "<td ><div align='center'>"."</div></td>";
                      
                    echo "</tr>";
                }
                echo "</tbody>"; 
             echo "</table>";
             echo "</center>";       
        }
        if (isset($_POST["clear"])) {
        system('clear');
        }
    ?>            

        </div>
     </div>
    </div>

    <script type="text/javascript">
        
        function PrintDoc() {

            var toPrint = document.getElementById('printarea');

            var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');

            popupWin.document.open();

            popupWin.document.write('<html><title>::Preview::</title><head><style>table{border-collapse: collapse;border: 1px solid black;}th, td {padding-top: 2px;padding-bottom: 2px;padding-left: 2px; padding-right: 2px;}</style></head><body onload="window.print()">')

            popupWin.document.write(toPrint.innerHTML);

            popupWin.document.write('</html>');

            popupWin.document.close();

        }

    </script>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>