      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
         
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="active treeview">
              <a href="#">
                <i class=""></i> <span>ลงทะเบียน</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="edit_company.php"><i class="fa fa-circle-o"></i> บริษัท</a></li>
                <li class="active"><a href="edit_check-service.php"><i class="fa fa-circle-o"></i> กำหนดการออกตรวจ</a></li>
                <li class="active"><a href="edit_employee.php"><i class="fa fa-circle-o"></i> พนักงาน</a></li>
                <li class="active"><a href="edit_doctor.php"><i class="fa fa-circle-o"></i> แพทย์</a></li>
                <li class="active"><a href="edit_program.php"><i class="fa fa-circle-o"></i> โปรแกรมการตรวจ</a></li>
              </ul>
            </li>
            <?php 
              if ($_SESSION["status"]== '1')
              { ?>
            <li class="treeview">
              <a href="#">
                <span>ผู้ดูแล</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="edit_user.php"><i class="fa fa-circle-o"></i>แก้ไขผู้ใช้</a></li>
              </ul>
            </li>
            <?php
              }?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>