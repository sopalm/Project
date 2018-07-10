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
        $post=$_POST["check_no"];
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

<center>
<h3></h3>
<div style="overflow-x:auto;">
<table class='excel'  border="1">
<thead>
    <tr>
        <th align="center">ลำดับ</th>
        <th align="center">H.N</th>

        <th>bmi</th><th>pe</th>
        <th>bp</th><th>cxr</th>
        <th>ekg</th><th>ua</th>
        <th>cbc</th><th>mam</th>
        <th>tp</th><th>ua</th>
        <th>la</th><th>wa</th>
        <th>est</th><th>scb</th>
        <th>bmd</th>

        <th>fbs</th>
        <th>bun</th><th>cr</th>
        <th>chol</th><th>hdl</th>
        <th>ldl</th><th>trig</th>
        <th>tb</th><th>sgot</th>
        <th>sgpt</th><th>alk</th>
        <th>uric</th><th>psa</th>
        <th>tp</th><th>alb</th>
        <th>db</th><th>glo</th>
        <th>cea</th><th>afp</th>
        <th>cap</th>

    </tr>
</thead>


<form method='POST' action="add_lab_report.php">
<?php
        
        $nub = 0;
        foreach ($namedDataArray as $result) {
            echo "<tr>";
            echo "<td>"."<input style='max-width: 30px; ' type='number' name='a".$nub."' value='".$result["A"]."' required >"."</td>";
            echo "<td>"."<input style='max-width: 110px; ' type='text' name='b".$nub."' value='".$result["B"]."' maxlength='13' required >"."</td>";
            //ปกติ//ไม่ปกติ
            echo "<td>"."<input type='text' name='c".$nub."' value='".$result["C"]."' required >"."</td>";//bmi
            echo "<td>"."<input type='text' name='d".$nub."' value='".$result["D"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='e".$nub."' value='".$result["E"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='f".$nub."' value='".$result["F"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='g".$nub."' value='".$result["G"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='h".$nub."' value='".$result["H"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='i".$nub."' value='".$result["I"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='j".$nub."' value='".$result["J"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='k".$nub."' value='".$result["K"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='l".$nub."' value='".$result["L"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='m".$nub."' value='".$result["M"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='n".$nub."' value='".$result["N"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='o".$nub."' value='".$result["O"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='p".$nub."' value='".$result["P"]."' required >"."</td>";
            echo "<td>"."<input type='text' name='q".$nub."' value='".$result["Q"]."' required >"."</td>";
            //ตัวเลข
            echo "<td>"."<input type='number' name='r".$nub."' value='".$result["R"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='s".$nub."' value='".$result["S"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='t".$nub."' value='".$result["T"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='u".$nub."' value='".$result["U"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='v".$nub."' value='".$result["V"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='w".$nub."' value='".$result["W"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='x".$nub."' value='".$result["X"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='y".$nub."' value='".$result["Y"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='z".$nub."' value='".$result["Z"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='aa".$nub."' value='".$result["AA"]."' required >"."</td>";

            echo "<td>"."<input type='number' name='ab".$nub."' value='".$result["AC"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='ac".$nub."' value='".$result["AD"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='ad".$nub."' value='".$result["AE"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='ae".$nub."' value='".$result["AE"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='af".$nub."' value='".$result["AF"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='ag".$nub."' value='".$result["AG"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='ah".$nub."' value='".$result["AH"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='ai".$nub."' value='".$result["AI"]."' required >"."</td>";
            echo "<td>"."<input type='number' step='any' name='aj".$nub."' value='".$result["AJ"]."' required >"."</td>";
            echo "<td>"."<input type='number' name='ak".$nub."' value='".$result["AK"]."' required >"."</td>";

            $nub++;
        }
        echo "</table>"."</br>";
        echo "<input type='hidden' value='$post' name='check_no' >";
        ?>
    </div>
    </center>
    <?php      
        echo "</select>"."&emsp;";
        echo "<input class='btn btn-success' type='submit' value='submit' name='submit_total_excel' >";
        echo "<input type='hidden' value='$r' name='nub2' >";
        echo "</form>";
    } 
    if (isset($_POST["clear"])) {
        system('clear');
    }

?>