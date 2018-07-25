<?php
     include_once('connection.php');
     
/** PHPExcel */
    if(isset($_POST["submitfile"])&&$_FILES["file"]["name"]!=null)
    {
        /** PHPExcel_IOFactory - Reader */
        include 'Classes/PHPExcel/IOFactory.php';
        $inputFileName = $_FILES["file"]["name"];
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName); 
        $objReader = PHPExcel_IOFactory::createReader($inputFileType); 
        $objReader->setReadDataOnly(true); 
        $objPHPExcel = $objReader->load($inputFileName); 
        
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        $r = 0;
        $namedDataArray = array();
        for ($row = 0; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                $namedDataArray[$r] = $dataRow[$row];
            }
        }
?>
<style type="text/css">
    table.excel td input{
            border: none;
            display: inline;
            font-family: inherit;
            font-size: inherit;
            padding: none;
            width: auto;
            background-color: #ecf0f5;
    }
    table.excel th{
        background-color: #3c8dbc;
        color: white;
    }
</style>
<table class='excel'  border="1">
<thead>
    <tr>
        <th align="center">ลำดับ</th>
        <th align="center">H.N</th>
        <th align="center">V.N</th>
        <th>คำนำหน้า</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>วัน/เดือน/ปีเกิด</th>
        <th>แผนก</th>
        <th>โปรแกรม</th>
    </tr>
</thead>


<form method='POST' action="add_employee.php">
    <?php
        
        $nub = 0;
        foreach ($namedDataArray as $result) {
            echo "<tr>";
            echo "<td>"."<input style='max-width: 50px; ' type='number' name='a".$nub."' value='".$result["A"]."' required >"."</td>";
            echo "<td>"."<input style='max-width: 110px; ' type='text' name='b".$nub."' value='".$result["B"]."' maxlength='13' required >"."</td>";
            echo "<td>"."<input style='max-width: 80px; ' type='text' name='c".$nub."' value='".$result["C"]."' maxlength='13' required >"."</td>";
            echo "<td>"."<input style='max-width: 50px; ' type='text' name='d".$nub."' value='".$result["D"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='e".$nub."' value='".$result["E"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='f".$nub."' value='".$result["F"]."' required >"."</td>";
            if (strpos($result["G"], '/') || strpos($result["G"], '-') ) {
                $time = explode("/", $result["G"]);
                $y = $time['2']-543;
                $m = $time['1'];
                $d = $time['0']; 
                $time2 = $y."-".$m."-".$d;
                $time3 = strtotime($time2);
                $date = date('Y-m-d',$time3);
            }
            else{
                if ($result["G"] > 100000) {
                    $unix_date = (($result["G"] - 25569) * 86400) - (86400*365.25*543);
                }
                else{
                    $unix_date = ($result["G"] - 25569) * 86400;
                }
                //$date = date('Y-m-d',$unix_date);
                //echo date("Y",$unix_date)." ";
            }
            echo "<td>"."<input style='max-width: 120px; ' type='date' name='g".$nub."' value='".$date."' required >"."</td>";
            echo "<td>"."<input style='max-width: 110px; ' type='text' name='emp_dep".$nub."' value='".$result["H"]."'>"."</td>";
            echo "<td>"."<input style='max-width: 180px; ' type='text' name='emp_pro".$nub."' value='".$result["I"]."' required >"."</td>";
            $nub++;
        }
        echo "</table>"."</br>";
    ?>
    
       
            <br/>
            <br/>
            <?php 
                if(isset($_POST["cs_no"])){
            ?>
            <input type="hidden" required name='emp_check_no' value="<?php echo $_POST['cs_no']; ?>">
            <?php 
                }else{
            ?>
            <label >วันที่ออกตรวจ</label>
            <select name='emp_check_no' required>
                <option value="">--- Pleaser Select ---</option>
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
            <?php 
                }

                echo "</select>"."&emsp;";
                echo "<input type='submit' value='submit' name='submit_excel' >";
                echo "<input type='hidden' value='$nub' name='nub' >";
                echo "</form>";
                } 
                if (isset($_POST["clear"])) {
                    system('clear');
                }

            ?>