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
        <?php 
            if (isset($_GET['cs_no']))
            {
                include('function.php');
                $get=$_GET['cs_no'];
                $sqlcompany = "SELECT c.comp_name,cs.cs_date,cs.cs_total_people,cs.cs_no 
                                          FROM check_service as cs  LEFT JOIN company_address as ca ON cs.ca_id=ca.ca_id
                                                                    LEFT JOIN company as c ON ca.comp_id=c.comp_id
                                          WHERE cs.cs_no = $get ";
                           $resultcompany=mysqli_query($con,$sqlcompany);
                           $company=mysqli_fetch_array($resultcompany);
            }
        ?>
            <div class="box-header">
                <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a class="path" href="check-service_list.php?cs_no=<?php echo $_GET['cs_no']; ?>">/ ข้อมูลการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / เพิ่มผลการตรวจจากห้องปฏิบัติการ</a>
                <h2>ลงทะเบียน ผลการตรวจสุขภาพจากห้องปฏิบัติการของบริษัท <?php echo $company[0];?> วันที่ <?php echo DateThaiShow($company[1]);?> </h2>

            </div>
            
        <div>
            <br/>
            <form action="" method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label><input type="hidden" name="check_no" id="check_no" value="<?php echo $company[3];?>"><br/>
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submitfile" value="เปิดไฟล์">
            <input type="submit" name="clear" value="ลบไฟล์">
            </form></br>

            <?php include('regis_lab_excel.php'); ?>

            <a class="btn btn-danger" href="edit_report_total.php" >ยกเลิก</a> 
        </div>
     </div>
    </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>