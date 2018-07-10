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
         <div class="box-header"><a style="color: black;text-decoration-line: none;" href="">/ ผลการตรวจแบบภาพรวมของแต่ละบริษํท </a>
            </div>
         <div >
          <form method='POST' action="" >
            <label >เลือก กำหนดาการออกตรวจสุขภาพ</label>
           <select name='check_service' required>
                <option value="">--- เลือก ---</option>
                <?php
                    $sqlCommand = "SELECT cs.cs_no,cs.cs_date,c.comp_name
                    FROM check_service as cs LEFT JOIN company_address as ca ON cs.ca_id = ca.ca_id
                                        LEFT JOIN company as c ON ca.comp_id = c.comp_id";
                    $result=mysqli_query($con,$sqlCommand);
                    while ($row3=mysqli_fetch_array($result)) {
                        echo "<option value='".$row3[0]."'>".$row3[1]." ".$row3[2]."</option>";
                    }
                    
                ?>
            </select>
            <input style="height: 30px; width: 50px;padding: 3px;" class="btn btn-primary" type="submit" name="submit_emp_list" value="submit">
             <input name="Search" class="btn btn-secondary" type="submit" name="clear" value="clear">
          </form>
          </div>

          <?php if (isset($_POST['submit_emp_list'])||isset($_GET['cs_no'])) { 
             if (isset($_POST['submit_emp_list']))
             {
                $sqlcp = "SELECT comp_name,cs.cs_date
                          FROM company as cp 
                          LEFT JOIN company_address as ca ON ca.comp_id=cp.comp_id
                          LEFT JOIN check_service as cs ON cs.ca_id=ca.ca_id 
                          WHERE cs.cs_no = $_POST[check_service]";
                $querycp=mysqli_query($con,$sqlcp);
                $cp=mysqli_fetch_array($querycp);
              }
              if (isset($_GET['cs_no']))
             {
                $sqlcp = "SELECT comp_name,cs.cs_date
                          FROM company as cp 
                          LEFT JOIN company_address as ca ON ca.comp_id=cp.comp_id
                          LEFT JOIN check_service as cs ON cs.ca_id=ca.ca_id 
                          WHERE cs.cs_no = $_GET[cs_no]";
                $querycp=mysqli_query($con,$sqlcp);
                $cp=mysqli_fetch_array($querycp);
              }
            ?>

         <input type="button" value="Print" name="Search" class="btn btn-secondary" onclick="PrintDoc()"/>
         <div class="page-break" style="overflow-x:auto;" >
          <div id="printarea">
          <?php include('function.php'); ?>
          <center><h2>ผลการตรวจสุขภาพพนักงานบริษัท <?php echo $cp["comp_name"]; ?> ประจำปี <?php echo thai_year($cp["cs_date"]); ?></h2></center>
                  <table class="" border="1" >
                 <thead style="background-color: #47d147">
                  <tr align="center">
                      <th align="center">ชื่อ-สกุล</th>
                      <th>ค่าbmi</th>

                      <th>bmi</th><th>ตรวจร่างกาย</th>
                      <th>ความดันโลหิต</th><th>x-ray</th>
                      <th>ekg</th><th>ua</th>
                      <th>cbc</th><th>mam</th>
                      <th>tp</th><th>ua</th>
                      <th>la</th><th>wa</th>
                      <th>est</th><th>scb</th>
                      <th>bmd</th>

                      <th>fbs</th>
                      <th>bun</th><th>cr</th>
                      <th>chol</th><th>hdl</th>
                      <th>ldl</th><th>trig</th>
                      <th>tb</th><th>sgot</th>
                      <th>sgpt</th><th>alk</th>
                      <th>uric</th><th>psa</th>
                      <th>tp</th><th>alb</th>
                      <th>db</th><th>glo</th>
                      <th>cea</th><th>afp</th>
                      <th>cap</th>

                  </tr>
                </thead>
                  <tbody>
        <?php
            include('connection.php');
            if (isset($_POST['submit_emp_list']))
            {
              $sqlreport = "SELECT cs.cs_date,cp.comp_name,emp.emp_no,emp.emp_title,emp.emp_name,emp.emp_surname,pi.bmi ,rt.*,csd.pro_id
                            FROM report_total as rt LEFT JOIN check_service_detail as csd ON rt.csd_no=csd.csd_no
                                                    LEFT JOIN check_service as cs ON csd.cs_no=cs.cs_no 
                                                    LEFT JOIN personal_information as pi ON pi.csd_no=rt.csd_no
                                                    LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                    LEFT JOIN company as cp ON ca.comp_id=cp.comp_id
                                                    LEFT JOIN employee as emp ON emp.emp_id=rt.emp_id
                            WHERE cs.cs_no = $_POST[check_service] ORDER BY emp.emp_no ASC "; 
                        $sqlpro = "SELECT pc.pro_id,pc.pro_name 
                                        FROM check_service as cs LEFT JOIN check_service_detail as csd ON cs.cs_no=csd.cs_no 
                                                                  LEFT JOIN program_check as pc ON csd.pro_id=pc.pro_id
                                        WHERE cs.cs_no = $_POST[check_service]";
                        $querypro=mysqli_query($con,$sqlpro);
            }
            if (isset($_GET['cs_no']))
            {
              $sqlreport = "SELECT cs.cs_date,cp.comp_name,emp.emp_no,emp.emp_title,emp.emp_name,emp.emp_surname,pi.bmi ,rt.*,csd.pro_id
                            FROM report_total as rt LEFT JOIN check_service_detail as csd ON rt.csd_no=csd.csd_no
                                                    LEFT JOIN check_service as cs ON csd.cs_no=cs.cs_no 
                                                    LEFT JOIN personal_information as pi ON pi.csd_no=rt.csd_no
                                                    LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                    LEFT JOIN company as cp ON ca.comp_id=cp.comp_id
                                                    LEFT JOIN employee as emp ON emp.emp_id=rt.emp_id
                            WHERE cs.cs_no = $_GET[cs_no] ORDER BY emp.emp_no ASC "; 
                        $sqlpro = "SELECT pc.pro_id,pc.pro_name 
                                        FROM check_service as cs LEFT JOIN check_service_detail as csd ON cs.cs_no=csd.cs_no 
                                                                  LEFT JOIN program_check as pc ON csd.pro_id=pc.pro_id
                                        WHERE cs.cs_no = $_GET[cs_no]";
                        $querypro=mysqli_query($con,$sqlpro);
            }


            while($pro=mysqli_fetch_array($querypro))
                { ?>
                  <tr>
                    <td colspan="45" style="background-color: #4db8ff;"><?php echo $pro["pro_name"]; ?> / โปรแกรม <?php echo $pro["pro_id"]; ?></td>
                  </tr>
                  
                    <?php 
                    $queryreport = mysqli_query($con,$sqlreport);
                      while ( $row=mysqli_fetch_array($queryreport)) {
                        if($pro['pro_id']==$row['pro_id']){
                        ?>
                        <tr>
                          <td><?php echo $row["emp_title"]; ?><?php echo $row["emp_name"]; ?>&nbsp;<?php echo $row["emp_surname"]; ?></td>
                          <td><?php echo $row["bmi"]; ?></td>
                          <?php 
                            for($i=10;$i<45;$i++){
                              if($i==10){
                                  echo "<td>";
                                        if($row["bmi_report"]==1){
                                            echo "Normal";
                                        }
                                        else{
                                            if($row["bmi_report"]==2){
                                                echo "<font color='red'>Under Weight</font>";
                                            }
                                            else{
                                                if($row["bmi_report"]==3){
                                                    echo "<font color='red'>Over Weight</font>";
                                                }
                                                else{
                                                    if($row["bmi_report"]==4){
                                                        echo "<font color='red'>Weight Disease</font>";
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                }
                                            }
                                        }
                                  echo "</td>";
                              }
                              else{
                                if($i<25){
                                  echo "<td>";
                                    if($row[$i]==1){
                                      echo "<font color='black'>ปกติ</font>";
                                    }
                                    else{
                                      echo "<font color='red'>ไม่ปกติ</font>";
                                    }
                                  echo "</td>";
                                }
                                else{
                                  echo "<td >".$row[$i]."</td>";
                                }
                                
                              }
                              
                            }
                          ?>
                        </tr> 
                        
                    <?php  }}
                    ?>
                  
               <?php }
                echo "</tbody>"; 
             echo "</table>";       
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

            popupWin.document.write('<html><head><title>::Preview::</title><link rel="stylesheet" type="text/css"  /><style type="text/css" media="print">@page { size: landscape; } table{border-collapse: collapse;border: 1px solid black;}</style></head><body onload="window.print()">')

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