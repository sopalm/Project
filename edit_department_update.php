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
            
            <div class="box-header"><a class="path" href="edit_department.php">/ แผนก</a><a style="color: black;text-decoration-line: none;" href=""> / แก้ไข</a>
                <h2>แก้ไข แผนก</h2>
            </div>
                <?php
                include('connection.php');

                $strCheckID = null;
                
                if(isset($_GET["check_id"]))
                {
                    $strCheckID = $_GET["check_id"];
                }
                $sql_comp = "SELECT * FROM company "; 
                $query_comp = mysqli_query($con,$sql_comp);

                $sql_dep = "SELECT * FROM department "; 
                $query_dep = mysqli_query($con,$sql_dep);


                $sql =    "SELECT d.dep_id,d.dep_name, c.comp_name,c.comp_id,dc.dep_comp_no
                                FROM department AS d
                                    LEFT JOIN dep_comp AS dc ON dc.dep_id  = d.dep_id
                                    LEFT JOIN company AS c ON dc.comp_id  = c.comp_id
                                WHERE dep_comp_no = '".$strCheckID."'  ";

                    $query = mysqli_query($con,$sql);
                    $result=mysqli_fetch_array($query,MYSQLI_ASSOC);
                ?>
                <form action="edit_department_method.php" name="frmAdd" method="post">
                <table >
                  <tr>
                    <th width="200">รหัสแผนก</th>
                    <td width="200"><input type="hidden" name="txtID" value="<?php echo $result["dep_comp_no"];?>"><?php echo $result["dep_comp_no"];?></td>
                    </tr>
                  <tr>
                    <th width="200">ชื่อบริษํท</th>
                    <td>

                        <select  required name="txtcomp_id">
                            <option value="" >--เลือก--</option>
                                <?php
                                    while ($row=mysqli_fetch_array($query_comp)) {

                                        if($result["comp_id"]==$row["comp_id"])
                                        {
                                            echo "<option selected value='".$row["comp_id"]."'>".$row["comp_name"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$row["comp_id"]."'>".$row["comp_name"]."</option>";
                                        }

                                    }
                                        
                                ?>
                        </select>

                    </td>
                    </tr>
                  <tr>
                    <th width="200">ชื่อแผนก</th>
                    <td >

                        <select  required name="txtdep_id">
                            <option value="" >--เลือก--</option>
                                <?php
                                    while ($row=mysqli_fetch_array($query_dep)) {

                                        if($result["dep_id"]==$row["dep_id"])
                                        {
                                            echo "<option selected value='".$row["dep_id"]."'>".$row["dep_name"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$row["dep_id"]."'>".$row["dep_name"]."</option>";
                                        }

                                    }
                                        
                                ?>
                        </select>

                    </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                    <th>
                        
                    </th>
                    <td><input type="submit" name="submit" value="ยืนยัน"></td>

                  </table>
                  
                </form>
        </div>
    
      </div>

    <?php 
        include("footer.php");
    ?>
  </body>
</html>