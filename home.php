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
        HOME NAJA
        <?php if(isset($_SESSION['user_name'])){ ?>
        <div class="container" style="padding-top: 20%">
          <div class="alert alert-success"  >Hello </div>
        </div>
        <?php  } ?>

      </div>

      






    <?php 
        include("footer.php");
    ?>
  </body>
</html>