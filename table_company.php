<!DOCTYPE html>
<html>
<?php include("head.php");?>

<body class="skin-blue">
<?php include("header.php"); ?>
      
<?php include("slide_menu_admin.php"); 
    
?>
    
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="body">
            <div class="box-header">
              <h2>Manager</h2>
              <?php 
                $query = "SELECT * 
                          FROM user 
                          ORDER BY user.user_id ASC ";

                $result = mysqli_query($con,$query);
              ?>

                <table class="list" border="0">
                  <tr class="list">
                    <th class="list" width=""> <div align="center">ID </div></th>
                    <th class="list" width=""> <div align="center">Username </div></th>
                    <th class="list" width=""> <div align="center">Password </div></th>
                    <th class="list" width=""> <div align="center">Status </div></th>
                    <th class="list" width=""> <div align="center">Date Modify </div></th>
                    <th class="list" width=""> <div align="center">User Modify </div></th>

                    <?php
                      if ($_SESSION["status"]== '1')
                      { ?>
                        <th class="list" width="50"> <div align="center"><!--Edit--> </div></th>
                      <?php 
                      } 
                      ?>
                  </tr>
                <?php
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                ?>
                  <tr class="list">
                    <td class="list"><div align="center"><?php echo $row["user_id"];?></div></td>
                    <td class="list"><?php echo $row["user_name"];?></td>
                    <td class="list"><?php echo $row["user_pass"];?></td>
                    <td class="list"><?php echo $row["user_status"];?></td>
                    <td class="list"><?php echo $row["date_modify"];?></td>
                    <td class="list"><?php echo $row["user"];?></td>
 
                    <?php
                      if ($_SESSION["status"]== '1')
                      { ?>
                        <td class="list" align="center"><a href="edit_user_update.php?user_id=<?php echo $row["user_id"];?>">Edit</a></td>
                      <?php 
                      } 
                      ?>
                  </tr>
                <?php
                }
                ?>
                </table>

            </div>
                
        </div>   
      </div><!--content-wrapper-->

    <?php 
        include("footer.php");
    ?>
  </body>
</html>