<!DOCTYPE html>
<html>
    <?php include("head.php"); ?>
  <body class="skin-blue">
    <?php include("header.php"); ?>
      
    <?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <div class="body">
         <!-- Main content -->  
         <div class="box-header">
            <a style="color: black;text-decoration-line: none;" href=""> / QR-Code ของผู้เข้ารับการตรวจ</a>
        </div>
         <div >
          <form method='POST' action="" >
            <label >เลือก กำหนดการออกตรวจสุขภาพ</label>
           <select name='check_service' required>
                <option value="">--- เลือก ---</option>
                <?php
                    $sqlCommand = "SELECT check_service.cs_no,check_service.cs_date,company.comp_name
                    FROM check_service  LEFT JOIN company_address ON check_service.ca_id = company_address.ca_id
                                        LEFT JOIN company ON company_address.comp_id = company.comp_id";
                    $result=mysqli_query($con,$sqlCommand);
                    while ($row3=mysqli_fetch_array($result)) {
                        echo "<option value='".$row3[0]."'>".$row3[1]." ".$row3[2]."</option>";
                    }
                    
                ?>
            </select>
            <label>รหัสบัตรประชาชน/เลขที่พาสปอร์ต</label>
            <input type="text" name="emp_id" required="" maxlength="13">
            <input style="height: 30px; width: 60px;" class="btn btn-primary" type="submit" name="submit_emp_card" value="submit">
             <input name="Search" class="btn btn-secondary" type="submit" name="clear" value="clear">
          </form>
          </div>

          <?php if (isset($_POST['submit_emp_card'])) { ?>

         <input type="button" value="Print" name="Search" class="btn btn-secondary" onclick="PrintDoc()"/>
         <div class="page-break" id="printarea">
        <?php
            include('connection.php');
            include('function.php');
            $c = 0;
            $p = 0;
            $sqlCommand = "SELECT employee.*,check_service_detail.* FROM `employee` LEFT JOIN check_list ON check_list.emp_id = employee.emp_id LEFT JOIN check_service_detail ON check_list.csd_no = check_service_detail.csd_no WHERE check_service_detail.cs_no = '$_POST[check_service]' AND employee.emp_id = '$_POST[emp_id]'";
            $result=mysqli_query($con,$sqlCommand);
            while ($row=mysqli_fetch_array($result)) {

        ?>
                <table class="A5" frame="box" style="width: 14.8cm;height: 21cm;">
                    <tr style="height: 30%;width: 100%;">
                        <td style="width: 75%; vertical-align: top;text-align: left; font-size: 25px;">
                            ชื่อ:&nbsp;&nbsp; <?php echo $row["emp_title"];?> &nbsp;<?php echo $row["emp_name"];?>&nbsp;<?php echo $row["emp_surname"];?>
                            </br></br>
                            วัน/เดือน/ปี เกิด: <?php echo thai_date($row["emp_bd"]);?>&nbsp;&nbsp;อายุ:&nbsp; <?php echo $row["emp_age"];?>
                            </br></br>
                            โปรแกรม: &nbsp;&nbsp; <?php echo $row["pro_id"];?>
                        </td>
                        <td style="width: 25%; vertical-align: top;text-align: right; font-size: 25px;+5">ลำดับที่&nbsp;&nbsp;<?php echo $row["emp_no"];?></td>
                    </tr>
                    <tr style="height: 70%;width: 100%;" align="center" >
                        <td class="QRcode" colspan="2"><img width="300" height="300" src="<?php echo $row["emp_qrcode"]; ?>"></td>
                    </tr>
                </table>
                <div class="page-break"></div>
    <?php
                /*$c++;
                $p++;
                if ($c == 2) {
                    echo "</tr>";
                    $c = 0;
                }
                if ($p == 10) {
                    echo "</table>";
                    $p = 0;
                }*/
            }
                    
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

            var popupWin = window.open('', '_blank', 'width=500,height=500,location=no,left=200px');

            popupWin.document.open();

            popupWin.document.write('<html><title>::Preview::</title><link rel="stylesheet" type="text/css" href="css/print.css" /><style>@media print {@page {size: A5;}div.row > div {display: inline-block;  border: solid 1px #ccc;margin: 0.2cm;}div.row {display: block;}}</style></head><body onload="window.print()">')

            popupWin.document.write(toPrint.innerHTML);

            popupWin.document.write('</html>');

            popupWin.document.close();

        }

    </script>

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
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