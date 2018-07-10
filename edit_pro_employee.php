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
            <div class="box-header">
                <h2>Add Employee</h2>
            </div>
                <!-- กำหนดตัวแปลใช้ในการค้นหา -->
                
                <form name="frmSearch" method="post" action="">
                    <label >Company</label>
                    <select name='emp_comp' required>
                    <option value="">--- Pleaser Select ---</option>
                    <?php
                        $sqlCommand = "SELECT * FROM company";
                        $result=mysqli_query($con,$sqlCommand);
                        while ($row2=mysqli_fetch_array($result)) {
                            echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
                        }
                        
                    ?>
                    </select>
                    <input type="submit" value="Search" class="btn btn-secondary">
                </form>
                <?php
                include('connection.php');

                if (isset($_POST['emp_comp'])) {
                 
                $query = "SELECT * FROM `employee` LEFT JOIN dep_comp ON employee.dep_comp_no = dep_comp.dep_comp_no LEFT JOIN company ON dep_comp.comp_id = company.comp_id LEFT JOIN department ON dep_comp.dep_id = department.dep_id WHERE company.comp_id = '$_POST[emp_comp]' ";

                $result = mysqli_query($con,$query);
                } 
                ?>
                <form method="post" action="add_employee.php">
                <div style="overflow-x:auto;">
                  <table class="list" border="0">
                    <tr class="list">
                      <th class="list" width="5"> <div align="center"><input type="checkbox" onClick="toggle(this)" />All<br/></div></th>
                      <th class="list" width="10"> <div align="center">ID </div></th>
                      <th class="list" width="60"> <div align="center">Title </div></th>
                      <th class="list" width="100"> <div align="center">Name </div></th>
                      <th class="list" width="100"> <div align="center">Surname </div></th>
                      <th class="list" width="90"> <div align="center">Birthday </div></th>
                      <th class="list" width="10"> <div align="center">Age </div></th>
                      <th class="list" width="10"> <div align="center">Department </div></th>
                      <th class="list" width="15"> <div align="center">Program </div></th>

                    </tr>
                  <?php
                  $j = 0;
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                  { 
                    
                    echo "<tr class='list'>";
                      echo "<td class='list'><div align='center'><input type='checkbox' name='emp_choose".$j."'></div></td>";
                      echo "<td class='list'><div align='center'>".$row['emp_id'];
                      echo "<input type='hidden' name='emp_id".$j."' value='".$row['emp_id']."'>";
                      echo "</div></td>";
                      echo "<td class='list'><div align='center'>".$row['emp_title']."</div></td>";
                      echo "<td class='list'>".$row['emp_name']."</td>";
                      echo "<td class='list'>".$row['emp_surname']."</td>";
                      echo "<td class='list'><div align='center'>".$row['emp_bd']."</div></td>";
                      echo "<td class='list'><div align='center'>".$row["emp_age"]."</div></td>";
                      echo "<td class='list'><div align='center'>".$row["dep_name"]."</div></td>";
                      echo "<td class='list'><div align='center'><select name='emp_pro".$j."' >
                          <option value=''>--- Pleaser Select ---</option>";
                              $sqlCommand = "SELECT * FROM program_check";
                              $result2=mysqli_query($con,$sqlCommand);
                              while ($row2=mysqli_fetch_array($result2)) {
                                  echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
                              }  
                              $j++;
                          ?>
                      </select></div></td>
                      
                    </tr>
                  <?php
                  }
                  ?>
                  </table>
                  <label >check_date</label>
                  <select name='emp_check_no' required>
                    <option value="">--- Pleaser Select ---</option>
                    <?php
                        $sqlCommand = "SELECT check_service.cs_no,check_service.cs_date,company.comp_name
                        FROM check_service LEFT JOIN company ON check_service.comp_id = company.comp_id";
                        $result=mysqli_query($con,$sqlCommand);
                        while ($row3=mysqli_fetch_array($result)) {
                            echo "<option value='".$row3[0]."'>".$row3[1]." ".$row3[2]."</option>";
                        }
                        
                    ?>
                </select>
                &emsp;
                <?php echo "<input type='hidden' name='nub_emp' value='$j'>"; ?>
                <input type="submit" name="submit_pro_emp" value="submit">
        </form>
                </div>
        </div>
   
      </div>
    

    <?php 
        include("footer.php");
    ?>
  </body>
</html>