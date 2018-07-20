<?php
    //connect Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "yhdb"; //localhost

    /*$servername = "203.151.93.42";
    $username = "kmitnb_sopalm";
    $password = "30de55e";
    $db = "kmitnb_sopalm";*/ //yanhee
 
    // Create connection
    $conn = new mysqli($servername, $username, $password,$db);
    
    // Change character set to utf8
    mysqli_set_charset($conn,"utf8");
 
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
 
 
    //ตรวจสอบว่า มีค่า ตัวแปร $_GET['show_province'] เข้ามาหรือไม่      //แสดงรายชื่อจังหวัด
    if(isset($_GET['show_comp'])){
        
        //คำสั่ง SQL เลือก id และ  ชื่อจังหวัด
        $sql = "SELECT * FROM company";
        
        //ประมวณผลคำสั่ง SQL
        $result = $conn->query($sql);
 
        //ตรวจสอบ จำนวนข้อมูลที่ได้ มีค่ามากกว่า  0 หรือไม่
        if ($result->num_rows > 0) {
            
            //วนลูปแสดงข้อมูลที่ได้ เก็บไว้ในตัวแปร $row
            while($row = $result->fetch_assoc()) {
                
                //เก็บข้อมูลที่ได้ไว้ในตัวแปร Array 
                $json_result[] = [
                    'id'=>$row['comp_id'],
                    'name'=>$row['comp_name'],
                ];
            }
            
            //ใช้ Function json_encode แปลงข้อมูลในตัวแปร $json_result ให้เป็นรูปแบบ Json
            echo json_encode($json_result);
            
        } 
    }
 
    
    //ตรวจสอบว่า มีค่า ตัวแปร $_GET['province_id'] เข้ามาหรือไม่  //แสดงรายชืออำเภอ
    if(isset($_GET['comp_id'])){
 
        //กำหนดให้ตัวแปร $province_id มีค่าเท่ากับ $_GET['province_id]
        $comp_id = $_GET['comp_id'];
        
        //คำสั่ง SQL เลือก AMPHUR_ID และ  AMPHUR_NAME ที่มี PROVINCE_ID เท่ากับ $province_id
        $sql = "SELECT * FROM `company_address` as ca WHERE ca.comp_id ='$comp_id' ";
        
        //ประมวณผลคำสั่ง SQL
        $result = $conn->query($sql);
 
        //ตรวจสอบ จำนวนข้อมูลที่ได้ มีค่ามากกว่า  0 หรือไม่
        if ($result->num_rows > 0) {
            
            //วนลูปนำข้อมูลที่ได้ เก็บไว้ในตัวแปร $row
            while($row = $result->fetch_assoc()) {
                
                //เก็บข้อมูลที่ได้ไว้ในตัวแปร Array 
                $json_result[] = [
                    'id'=>$row['ca_id'],
                    'name'=>$row['address'],
                ];
            }
            
            //ใช้ Function json_encode แปลงข้อมูลในตัวแปร $json_result ให้เป็นรูปแบบ Json
            echo json_encode($json_result);
            
        } 
    }
    
    
    
    
?>