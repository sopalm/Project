<?php
     include_once('connection.php');
/** PHPExcel */
    if(isset($_POST["submitfile"])&&$_FILES["file"]["name"]!=null)
    {
        require_once 'Classes/PHPExcel.php';
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
    table.excel td input:disabled{
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
        <th>เลขบัตรประชาชน</th>
        <th>คำนำหน้า</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>วัน/เดือน/ปีเกิด</th>
        <th>อายุ</th>
        <th>แผนก</th>
        <th>โปรแกรม</th>
    </tr>
</thead>


<form method='POST' action="add_employee.php">
<?php
        
        $nub = 0;
        foreach ($namedDataArray as $result) {
            echo "<tr>";
            echo "<td>"."<input disabled style='max-width: 30px; ' type='number' name='a".$nub."' value='".$result["A"]."' required >"."</td>";
            echo "<td>"."<input disabled style='max-width: 110px; ' type='text' name='b".$nub."' value='".$result["B"]."' maxlength='13' required >"."</td>";
            echo "<td>"."<input disabled style='max-width: 50px; ' type='text' name='c".$nub."' value='".$result["C"]."' required >"."</td>";
            echo "<td>"."<input disabled type='text' name='d".$nub."' value='".$result["D"]."' required >"."</td>";
            echo "<td>"."<input disabled type='text' name='e".$nub."' value='".$result["E"]."' required >"."</td>";
            if (strpos($result["F"], '/') || strpos($result["F"], '-') ) {
                $time = explode("/", $result["F"]);
                $y = $time['2']-543;
                $m = $time['1'];
                $d = $time['0']; 
                $time2 = $y."-".$m."-".$d;
                $time3 = strtotime($time2);
                $date = date('Y-m-d',$time3);
            }
            else{
                if ($result["F"] > 100000) {
                    $unix_date = (($result["F"] - 25569) * 86400) - (86400*365.25*543);
                }
                else{
                    $unix_date = ($result["F"] - 25569) * 86400;
                }
                //$date = date('Y-m-d',$unix_date);
                //echo date("Y",$unix_date)." ";
            }
            echo "<td>"."<input disabled style='max-width: 120px; ' type='date' name='f".$nub."' value='".$date."' required >"."</td>";
            echo "<td>"."<input disabled style='max-width: 30px; ' type='number' min='18' max='70' id='age' name='g".$nub."' value='".$result["G"]."'required >"."</td>";
            echo "<td>"."<select name='emp_dep' required> <option value=''>--- Pleaser Select ---</option>";
            $sqlCommand = "SELECT * FROM department LEFT JOIN dep_comp ON department.dep_id = dep_comp.dep_id WHERE dep_comp.comp_id = '$_POST[emp_comp_excel]' ";
                $result=mysqli_query($con,$sqlCommand);
                while ($row1=mysqli_fetch_array($result)) {
                    echo "<option value='".$row1['dep_comp_no']."'>".$row1['dep_name']."</option>";
                }
            echo "</td>";
            echo "<td>"."<select name='emp_pro' required>";
            echo "<option value=''>--- Pleaser Select ---</option>";
                
                    $sqlCommand = "SELECT * FROM program_check";
                    $result=mysqli_query($con,$sqlCommand);
                    while ($row2=mysqli_fetch_array($result)) {
                        echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
                    }
            echo "</select>"."</td>";
            $nub++;
        }
        echo "</table>"."</br>";
        ?>
    
       
            <br/>
            <br/>
            <label >วันที่ออกตรวจ</label>
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
            <?php      
        echo "</select>"."&emsp;";
        echo "<input type='submit' value='submit' name='submit_excel' >";
        echo "<input type='hidden' value='$r' name='nub' >";
        echo "</form>";
    } 
    if (isset($_POST["clear"])) {
        system('clear');
    }

?>