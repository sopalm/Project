<?php

    if($_SESSION['alert']=='loginSuccess'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เข้าสู่ระบบสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='loginFalse'){
        echo "<script language=\"JavaScript\">";
        echo "alert('username หรือ password ไม่ถูกต้อง');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='No_login'){
        echo "<script language=\"JavaScript\">";
        echo "alert('กรุณาเข้าสู่ระบบ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='address_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มที่อยู่สำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='cs_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มกำหนดการออกตรวจสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='c_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มบริษัทสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='c_add_false'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มบริษัทไม่สำเร็จ ข้อมูลซ้ำหรือไม่ถูกต้อง');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='d_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มแผนกสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='ds_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มแพทย์ในการออกตรวจสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='ds_del'){
        echo "<script language=\"JavaScript\">";
        echo "alert('ลบแพทย์ออกจากการออกตรวจสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='doctor_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มแพทย์ลงในระบบสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='emp_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มรายชื่อผู้เขารับการตรวจสุขภาพสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='emp_add_false_person'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มรายชื่อผู้เขารับการตรวจสุขภาพไม่สำเร็จ มีชื่ออยู่ในการตรวจแล้ว');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='emp_add_false'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มรายชื่อผู้เขารับการตรวจสุขภาพไม่สำเร็จ ไฟล์รายชื่อไม่ถูกต้อง');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='lab_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มผลการตรวจจากห้องปฏิบัติการสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='pro_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มโปรแกรมการตรวจสุขภาพสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='user_add'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เพิ่มผู้ใช้งานสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit'){
        echo "<script language=\"JavaScript\">";
        echo "alert('แก้ไขข้อมูลสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit_false'){
        echo "<script language=\"JavaScript\">";
        echo "alert('แก้ไขข้อมูลไม่สำเร็จ ข้อมูลไม่ถูกต้อง หรือซ้ำกับข้อมูลที่อยู่ในระบบ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit_Pass'){
        echo "<script language=\"JavaScript\">";
        echo "alert('เปลี่ยนรหัสผ่านสำเร็จ');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit_Pass_EQ'){
        echo "<script language=\"JavaScript\">";
        echo "alert('รหัสผ่านใหม่ห้ามซ้ำกับรหัสผ่านเก่า');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit_Pass_Noconfirm'){
        echo "<script language=\"JavaScript\">";
        echo "alert('รหัสผ่านใหม่ไม่ถูกต้อง');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit_Pass_false'){
        echo "<script language=\"JavaScript\">";
        echo "alert('รหัสผ่านเก่าไม่ถูกต้อง');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    if($_SESSION['alert']=='Edit_Pass_admin_false'){
        echo "<script language=\"JavaScript\">";
        echo "alert('รหัสยืนยันสิทธิ์ไม่ถูกต้อง');";
        //echo "window.location='index.php';";
        echo "</script>";
        //echo $_SESSION['alert'];
        $_SESSION['alert']=NULL;
    }
    
?>