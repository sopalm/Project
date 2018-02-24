<!DOCTYPE html>
<html>
  <head>
    
    <title>ระบบจัดการ การตรวจสุขภาพนอกสถานที่ รพใยันฮี</title>
    <?php include("head.php"); ?>
  </head>
  <body class="skin-blue">
    <?php include("header.php"); ?>
      
    <?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <!-- Main content -->
            <div class="">
            <div class="box-header">
                <h2>Regist Employee</h2>
            </div>
            <form method='POST' action="add_employee.php">
            <label >Employee_id</label>
            <input type="text" id="emp_id" name="emp_id" minlength="13" maxlength="13" >
            &emsp;
            <label >Title</label>
            <select name="title">
              <option value="นาย">นาย</option>
              <option value="นางสาว">นางสาว</option>
              <option value="นาง">นาง</option>
            </select>
            &emsp;
            <label >Employee_name</label>
            <input type="text" id="emp_name" name="emp_name">
            &emsp;
            <label >Employee_surname</label>
            <input type="text" id="emp_surname" name="emp_surname">
            <br/>
            <br/>
            <label >Birthday </label>
            <input type="date" id="birthday" max="<?php echo date("Y-m-d"); ?>" name="birthday">
            &emsp;
            <label >Age</label>
            <input type="number" min="18" max="70" id="age" name="age">
            &emsp;
            <label >Company</label>
            <select name="emp_comp">
                <?php
                    include('connection.php');
                    $sqlCommand = "SELECT * FROM company";
                    $result=mysqli_query($con,$sqlCommand);
                    while ($row=mysqli_fetch_array($result)) {
                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                    }
                    
                ?>
            </select>
            <br/>
            <br/>
            <button type="submit">Submit</button>
        </form>
        </div>

        <div>
            <br/>
            <form action="" method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submitfile" value="Submit">
            <input type="submit" name="clear" value="clear">
            </form>
            <?php include('regis_emp_excel.php'); ?>
        </div>


        
      </div>

      






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