<!DOCTYPE html>
<html>

    <?php include("head.php"); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
  <body class="skin-blue">
    <?php include("header.php"); ?>
      
    <?php include("slide_menu.php"); ?>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <div class="body">
         <!-- Main content -->  
         <div class="box-header">
            <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a class="path" href="check-service_list.php?cs_no=<?php echo $_GET['cs_no']; ?>">/ ข้อมูลการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href="">/ สถานะการตรวจสุขภาพ</a>
            </div>


          <?php if (isset($_GET['cs_no'])) { 
                $sqlcp = "SELECT cp.comp_name,cs.cs_date,cs.cs_total_people
                                         FROM company as cp  LEFT JOIN company_address as ca ON ca.comp_id=cp.comp_id
                                                             LEFT JOIN check_service as cs ON cs.ca_id=ca.ca_id 
                                         WHERE cs.cs_no = $_GET[cs_no]";
                         $querycp=mysqli_query($con,$sqlcp);
                         $cp=mysqli_fetch_array($querycp);
            ?>
         <div >
          <div id="printarea">
          <?php include('function.php'); ?>
          <center><h2>สถานะการตรวจสุขภาพพนักงานบริษัท <?php echo $cp["comp_name"]; ?> วันที่ <?php echo DateThaiShow($cp["cs_date"]); ?></h2></center>
                  
        <?php
            include('connection.php');

            $sqllist = "SELECT tag FROM check_service_tag
                          WHERE cs_no = '$_GET[cs_no]'";
                        $querylist=mysqli_query($con,$sqllist);
              $sqlemp ="SELECT emp.*,pc.pro_id ,csd.cs_no,cl.regis
                        FROM employee as emp JOIN check_list as cl ON emp.emp_id = cl.emp_id
                                              JOIN check_service_detail as csd ON cl.csd_no = csd.csd_no
                                              JOIN program_check as pc ON csd.pro_id = pc.pro_id
                        WHERE csd.cs_no = '$_GET[cs_no]' ORDER BY emp_no ";
                        $queryemp=mysqli_query($con,$sqlemp);
        ?>
            <div style="overflow-x:auto;" >
            <table id="print" class="display" width="100%" >
                 <thead >
                  <tr align="center">
                      <th align="center">ลำดับ</th>
                      <th align="center"> H.N</th>
                      <th align="center">ชื่อ-สกุล</th>
                      <th align="center">โปรแกรม</th>
                      <?php 
                        $tag = array();
                        $nub=0;
                        while ($row=mysqli_fetch_array($querylist)) {
                            array_push($tag,$row['tag']);
                            $nub++;
                          ?>
                          <th align="center"><?php echo $row["tag"]; ?></th>
                      <?php    
                        }
                      ?>
                      <th align="center">สถานะ</th>
                      

                  </tr>
                </thead>
                <tbody>
            <?php
              $querylist=mysqli_query($con,$sqllist);
              $column=mysqli_num_rows($querylist);//echo $column;
              $keb=$column;
              $tagsum = array();
              while ($row=mysqli_fetch_array($querylist,MYSQLI_ASSOC)) {
                  $tagsum[] = array(
                      'tag'=> $row['tag'],
                      'sum'=> 0
                  );
              }
            while($row=mysqli_fetch_array($queryemp))
                { ?>
              <tr>
                  <td align="center"><?php echo $row["emp_no"]; ?></td>
                  <td align="center"><?php echo $row["HN"]; ?></td>
                  <td><?php echo $row["emp_title"]; ?>&nbsp;<?php echo $row["emp_name"]; ?>&nbsp;&nbsp;<?php echo $row["emp_surname"]; ?></td>
                  <td align="center"><?php echo $row["pro_id"]; ?></td>

                  <?php 
                  $nub2=0;
                  $tagemp = array();
                  $sqlstatus = "SELECT ct.tag,ct.tag_status
                                FROM employee as emp JOIN check_list as cl ON emp.emp_id = cl.emp_id
                                                      JOIN check_service_detail as csd ON cl.csd_no = csd.csd_no
                                                      JOIN program_check as pc ON csd.pro_id = pc.pro_id
                                                      JOIN check_tags as ct ON ct.check_id = cl.check_id
                                WHERE csd.cs_no = '$row[cs_no]' AND emp.emp_id ='$row[emp_id]'";
                      $querystatus=mysqli_query($con,$sqlstatus);
                     while ($row2=mysqli_fetch_array($querystatus,MYSQLI_ASSOC)) {
                            $tagemp[] = array(
                                  'tag'=> $row2['tag'],
                                  'status'=> $row2['tag_status']
                              );
                            $nub2++;
                        }

                      $status=0;
                     for($j=0;$j<$nub2;$j++) {
                            for ($i=0;$i<$nub;$i++) 
                            { 
                              if($tagsum[$i]['tag']==$tagemp[$j]['tag']){

                                if($tagemp[$j]['status']==1){
                                  echo "<td align='center'>&#10004</td>";//check true
                                  $tagsum[$i]['sum']++;
                                  $status++;
                                }else{
                                  echo "<td align='center'></td> ";
                                }
                                //echo "<td align='center'> ".$tagemp[$j]['status']." </td>";
                                if($j<$nub2){
                                  $j++;
                                }
                                if($j>=$nub2){
                                  $j--;
                                }

                              }
                              else{
                                echo "<td align='center'>&#10008</i></td>";//check false
                              }
                            }

                      }
                      if($status==$nub2){
                        echo "<td align='center' bgcolor='#33ff77'>ตรวจครบ</td>";
                      }else{
                        echo "<td align='center' bgcolor='#ff3333' >ไม่ครบ</td> ";
                      }

                  ?>
                  

              </tr>

                        

                  
               <?php }?>
                    
                </tbody>
                <tfoot >
                  <tr align="center">
                      <th align="center">ลำดับ</th>
                      <th align="center"> H.N</th>
                      <th align="center">ชื่อ-สกุล</th>
                      <th align="center">โปรแกรม</th>
                      <?php 
                        $querylist=mysqli_query($con,$sqllist);
                        while ($row=mysqli_fetch_array($querylist)) {
                          ?>
                          <td align="center"></th>
                      <?php    
                        }
                      ?>
                      <td align="center"></th>
                      

                  </tr>
                </tfoot>
             </table>
             </div>
      <?php      
        }

    ?>   
        <div class="row">
        <?php 
          $regis=0;
          $queryemp=mysqli_query($con,$sqlemp);
          while($row=mysqli_fetch_array($queryemp)){
            if($row["regis"]==1){
              $regis++;
            }
          }
          ?>
          <h3 style="margin-left:10px;";>จำนวนผู้เข้ารับการตรวจที่ลงทะเบียนแล้ว <?php echo $regis; ?> คน  จาก <?php echo $cp["cs_total_people"]; ?> คน</h3>
          <div class="column">
        
            <table id="tablepage-page" width="100%" class="display">
            <thead>
              <th ><div align="center">จุดตรวจ</div></th>
              <th ><div align="center">จำนวนคนที่ตรวจไปแล้ว</div></th>
            </thead>
            <tbody>
              <?php 
                for ($i=0; $i <$keb ; $i++) {
                  $column++;
              ?>
                  <tr>
                    <td align="center"><?php echo $tagsum[$i]['tag']; ?></td><td align="center"><?php echo $tagsum[$i]['sum']; ?> คน</td>
                  </tr>
                  
              <?php    
                }
              ?>
              </tbody>
            </table> 
          </div>
          <div class="column">
            
          </div> 
        </div>    


        </div>
     </div>
    </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
  </body>
</html>