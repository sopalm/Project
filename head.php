<head>
    
    <title>ระบบจัดการ การตรวจสุขภาพนอกสถานที่ รพ.ยันฮี</title>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    


    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>
.popover{
    max-width: 100%; /* Max Width of the popover (depending on the container!) */
}
input[name=Search]{
    width: 50px;
    height: 30px;
    padding: 3px;
}
.body{
    height: 100%;
}
body{
    background-color: #ecf0f5;
}
a.back{
    color: gray;
}
a.back:hover {
    background-color: black;
    color: white;
    padding: 10px 15px;
}
form[name="frmSearch"] input.Search{
   height: 20px;
}
input.emp{
    width: 100px;
}
textarea{
    height: 60px;
    resize: none;
}
div.body{
    margin-left: 10px;
    margin-right: 10px; 
    margin-top: 50px;
    margin-bottom: 20px;
}

th,td{

    padding: 10px;
}
table[name=company] td{
    padding: 10px;
    white-space:pre;
    overflow:hidden;
    max-width : 50px;
    text-overflow: ellipsis;
}
table[name=employee] td{
    padding: 10px;
    white-space:pre;
    overflow:hidden;
    max-width : 50px;
    text-overflow: ellipsis;
}
table[name=check_service] td{
    padding: 10px;
    white-space:pre;
    overflow:hidden;
    max-width : 200px;
    text-overflow: ellipsis;
}


.fieldset-auto-width {
    display: inline-block;
}

    .column{
        float: left;
        width: 50%;
        padding: 10px;
        height: 100%;
    }
    .row:after{
        content: "";
        display: table;
        clear: both;
    }
    .search{
        text-align: center;
    }
    /*---------------------------*/
    .main-sidebar,.left-side{
        position: fixed;
    }
    .main-header .logo{
        position: fixed;
    }
    .main-header>.navbar{
        position: fixed;
        width: 100%;
    }
    .path{
        color: gray;
        text-decoration-line: none;
    }
    .path:hover{
        color: black;
    }
    .dtb{
        width: 100%;
        text-align: center;
    }

    </style>
</head>