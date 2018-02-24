<?php
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

        $r = -1;
        $namedDataArray = array();
        for ($row = 0; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                $namedDataArray[$r] = $dataRow[$row];
            }
        }

?>

<table width="500" border="1">
<tr>
<td>เลขบัตรประชาชน</td>
<td>คำนำหน้า</td>
<td>ชื่อ</td>
<td>นามสกุล</td>
<td>วัน/เดือน/ปีเกิด</td>
<td>อายุ</td>
</tr>
<?php

        foreach ($namedDataArray as $result) {
            echo "<tr>";
            echo "<td>"."<input type='text' name='a' value='".$result["A"]."' minlength='13' maxlength='13'>"."</td>";
            echo "<td>"."<input type='text' name='b' value='".$result["B"]."'>"."</td>";
            echo "<td>"."<input type='text' name='c' value='".$result["C"]."'>"."</td>";
            echo "<td>"."<input type='text' name='d' value='".$result["D"]."'>"."</td>";
            if (strpos($result["E"], '/') || strpos($result["E"], '-') ) {
                $date = $result["E"];
            }
            else{
                $unix_date = ($result["E"] - 25569) * 86400;
                $excel_date = 25569 + ($unix_date / 86400);
                $unix_date = ($excel_date - 25569) * 86400;
                $date = date('Y-m-d',$unix_date);
            }
            echo "<td>"."<input type='date' name='e' value='".$date."'>"."</td>";
            echo "<td>"."<input type='number' min='18' max='70' id='age' name='f' value='".$result["F"]."'>"."</td>";
            echo "</tr>";

        }
        echo "</table>";
    } 
    if (isset($_POST["clear"])) {
        system('clear');
    }

?>