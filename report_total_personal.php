<!DOCTYPE html>
<html>
<?php
	include('head.php');
?>
<body class="skin-blue">
    <?php include("header.php");
			include("slide_menu.php"); 

			$strID = null;    
            if(isset($_GET["id"]))
            {
                $strID = $_GET["id"];
                $check = 1;
            }
            $sqlemp = "SELECT *
                    FROM employee 
                    WHERE emp_id = '".$strID."' ";
            $queryemp = mysqli_query($con,$sqlemp);
            $resultemp=mysqli_fetch_array($queryemp,MYSQLI_ASSOC);

            include('function.php');
            $sqllab = "SELECT cs.cs_date ,rt.*,pi.*,pe.*
                    FROM report_total as rt LEFT JOIN check_service_detail as csd ON rt.csd_no=csd.csd_no
                                            LEFT JOIN check_service as cs ON csd.cs_no=cs.cs_no 
                                            LEFT JOIN personal_information as pi ON pi.csd_no=rt.csd_no
                                            LEFT JOIN personal_physical_examination as pe ON pe.csd_no=rt.csd_no
                    WHERE rt.emp_id = '".$strID."' "; 
            $querylab = mysqli_query($con,$sqllab);

            $sqlfam =" SELECT pfi.*,rt.emp_id
                        FROM personal_family_information as pfi LEFT JOIN report_total as rt ON pfi.emp_id=rt.emp_id
                        WHERE pfi.emp_id= '".$strID."'   ";
            $queryfam = mysqli_query($con,$sqlfam);
            $fam=mysqli_fetch_array($queryfam,MYSQLI_ASSOC)

	?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="body">
            <div class="box-header">
            <a class="path" href="edit_check-service.php">/ กำหนดการออกตรวจ</a><a class="path" href="check-service_list.php?cs_no=<?php echo $_GET['cs_no']; ?>">/ ข้อมูลการออกตรวจ</a><a style="color: black;text-decoration-line: none;" href=""> / ผลการตรวจรายบุคคล</a>
                <h2>ผลการตรวจสุขภาพ ของ <?php echo $resultemp["emp_title"];?> <?php echo $resultemp["emp_name"];?> <?php echo $resultemp["emp_surname"];?> </h2>
            </div>
            <h4>ประวัติครอบครัว</h4>
            <?php 
                echo "</br>";
                if($fam["heart"]!=NULL)
                {
                    echo "โรคหัวใจ: ".$fam["heart"]."</br>";
                }
                else
                {
                    echo "โรคหัวใจ: -</br>";
                }
                if($fam["hypertension"]!=NULL)
                {
                    echo "โรคความดันโลหิตสูง: ".$fam["hypertension"]."</br>";
                }
                else
                {
                    echo "โรคความดันโลหิตสูง: -</br>";
                }
                if($fam["dyslipidemia"]!=NULL)
                {
                    echo "โรคไขมันในเลือดสูง: ".$fam["dyslipidemia"]."</br>";
                }
                else
                {
                    echo "โรคไขมันในเลือดสูง: -</br>";
                }
                if($fam["diabetes_mellitus"]!=NULL)
                {
                    echo "โรคเบาหวาน: ".$fam["diabetes_mellitus"]."</br>";
                }
                else
                {
                    echo "โรคเบาหวาน: -</br>";
                }
                if($fam["cancer"]!=NULL)
                {
                    echo "โรคมะเร็ง: ".$fam["cancer"]."</br>";
                }
                else
                {
                    echo "โรคมะเร็ง: -</br>";
                }
            ?>
            </br>
            	<?php
                while($row=mysqli_fetch_array($querylab,MYSQLI_ASSOC))
                {
                ?>

                	<div class="panel-group">
					    <div class="panel panel-primary">
					      	<div class="panel-heading">
					        	<h4 class="panel-title">
					          		<a data-toggle="collapse" href="#collapse<?php echo $check;?>">ผลการตรวจวันที่ <?php echo thai_date($row["cs_date"]);?></a>
					        	</h4>
					      	</div>
					      	<div id="collapse<?php echo $check;?>" class="panel-collapse collapse">
					        	<div class="panel-body">
                                    <h4>ข้อมูลทั่วไป</h4><br>
                                    <table>
                                        <tr>
                                            <td>น้ำหนัก:&nbsp;<?php echo $row["weight"];?></td><td>ความดันโลหิต ครั้งที่ 1 :&nbsp;<?php echo $row["blood_pressure"];?></td>
                                            <td>ชีพจร ครั้งที่ 1 :&nbsp;<?php echo $row["pulsation"];?></td>
                                        </tr>
                                        <tr>
                                            <td>ส่วนสูง:&nbsp;<?php echo $row["height"];?></td><td>ความดันโลหิต ครั้งที่ 2 :&nbsp;<?php echo $row["blood_pressure_extra"];?></td>
                                            <td>ชีพจร ครั้งที่ 2 :&nbsp;<?php echo $row["pulsation_extra"];?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <h4>ประวัติส่วนตัว</h4>
                                    <table>
                                        <tr>
                                            <td>โรคประจำตัว :</td>
                                            <td>
                                                <?php 
                                                    if($row["underlying_disease"]!=NULL){
                                                        echo $row["underlying_disease"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ยาที่ใช้ประจำ :</td>
                                            <td>
                                                <?php 
                                                    if($row["medicines"]!=NULL){
                                                        echo $row["medicines"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ประวัติการแพ้ยา/สารอื่นๆ :</td>
                                            <td>
                                                <?php 
                                                    if($row["medicines_history"]!=NULL){
                                                        echo $row["medicines_history"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ยาสมุนไพร/ยาลูกลอน :</td>
                                            <td>
                                                <?php 
                                                    if($row["herbal_bolus"]!=NULL){
                                                        echo $row["herbal_bolus"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>การผ่าตัด :</td>
                                            <td>
                                                <?php 
                                                    if($row["operate"]!=NULL){
                                                        echo $row["operate"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>การดื่มสุรา :</td>
                                            <td>
                                                <?php 
                                                    if($row["alcohol"]!=NULL){
                                                        echo $row["alcohol"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>การสูบบุหรี่ :</td>
                                            <td>
                                                <?php 
                                                    if($row["smoke"]!=NULL){
                                                        echo $row["smoke"];
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <hr>
                                    </br>
                                    <h4>สภาพร่างกายทั่วไป</h4>
                                    <table>
                                        <tr>
                                            <th>รูปร่าง/ความสมบูรณ์ของร่างกาย</th> <td><?php echo $row["general_appearance"]; ?></td>
                                            <th>ภาวซีด เหลือง บวม</th> <td><?php echo $row["anemia"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>ศรีษะ คอ ต่อมน้ำเหลือง</th> <td><?php echo $row["head_cervival_nodes"]; ?></td>
                                            <th>ตา หู จมูก ปาก ช่องคอ</th> <td><?php echo $row["eyes_ear_throat_nose_mouth"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>ช่องปาก ฟัน เหงือก</th> <td><?php echo $row["oral_teeth"]; ?></td>
                                            <th>เสียงปอด รูปทรงทรวงอก</th> <td><?php echo $row["breath_sound"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>เสียงหัวใจ</th> <td><?php echo $row["heartbeat"]; ?></td>
                                            <th>ช่องท้อง ตับ ม้าม</th> <td><?php echo $row["abdomen"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>แขนขา</th> <td><?php echo $row["arm_leg"]; ?></td>
                                            <th>กระดูกสันหลัง หล้ามเนื้อ</th> <td><?php echo $row["back_bone"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th>ผิวหนัง</th> <td><?php echo $row["skin"]; ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    </br>

                                    <h4>ผลการตรวจสุขภาพจากห้องปฏิบัติการ </h4>
                                    <?php 
                                        echo "BMI: ";
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
                                                        echo "error";
                                                    }
                                                }
                                            }
                                        }
                                        echo "</br>";
                                        echo "ระดับน้ำตาลในเลือด: ".$row["fbs"]."</br>";
                                    ?>                 
                                </div>
					      	</div>
					    </div>
					 </div>


                <?php
                	$check++;
                }
                ?>
            

     	</div>
    </div>

    <?php 
        include("footer.php");
        include("js/DataTable.js");
    ?>
 </body>
</html>