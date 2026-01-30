                <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title><?php echo $this->customlib->getAppName(); ?></title>
                


                

                <!-- <script src="<?php echo base_url(); ?>semester_documents/plugins/jquery/jquery.min.js"></script> -->
                <!-- jQuery UI 1.11.4 -->
                <!-- <script src="<?php echo base_url(); ?>semester_documents/plugins/jquery-ui/jquery-ui.min.js"></script> -->
                <!-- Bootstrap 4 -->
                <script src="<?php echo base_url(); ?>semester_documents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- AdminLTE App -->
                <script src="<?php echo base_url(); ?>semester_documents/dist/js/adminlte.min.js"></script>

                <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


                <!-- Other scripts can go here -->
                <!-- Google Font: Source Sans Pro -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
                <!-- Font Awesome -->
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/fontawesome-free/css/all.min.css">
                <!-- Ionicons -->
                <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
                <!-- Tempusdominus Bootstrap 4 -->
                <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
                <!-- iCheck -->
                <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
                <!-- JQVMap -->
                <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/jqvmap/jqvmap.min.css"> -->
                <!-- Theme style -->
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/dist/css/adminlte.min.css">
                <!-- overlayScrollbars -->
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
                <!-- Daterange picker -->
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/daterangepicker/daterangepicker.css">
                <!-- summernote -->
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/summernote/summernote-bs4.min.css">
                <!--- Datatables--------------------------->

                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>semester_documents/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">               
                <!-- Other scripts can go here -->
                </head> 

                <?php
                $student   = $this->session->userdata('sem_student');
                $image     = !empty($student['image']) ? $student['image'] : 'default.png';
                $firstname = !empty($student['firstname']) ? $student['firstname'] : '';              
                ?>



                    <!-- <img src="<?php echo base_url('uploads/student_images/' . $image); ?>"
                    class="img-circle"
                    width="40"
                    height="40"
                    alt="Student Image"> -->




                
                <body class="hold-transition sidebar-mini layout-fixed">
                <div class="wrapper">
                <!-- Preloader -->
                <!-- <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
                </div> -->

                <!-- Navbar -->
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">               


                <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>


                <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
                </li> -->


                <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url($nav_link); ?>" class="nav-link">
                <?= $nav_text; ?>
                </a>
                </li>
                </ul>



                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                <form class="form-inline">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
                </button>
                </div>
                </div>
                </form>
                </div>
                </li>
                

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">

                
                <img src="<?php echo base_url($image); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">

                <div class="media-body">
                <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                <img src="<?php echo base_url($image); ?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
                </li>


                <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
                </a>
                </li> -->




                <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="<?php echo site_url('SemesterAuth/logout'); ?>" role="button">
                <i class="fa fa-gear" title="logout"></i>
                </a>
                </li> -->


                <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-gear" title="Settings"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                <li>
                <a href="<?php echo site_url('profile'); ?>" class="dropdown-item">
                <i class="fa fa-user mr-2"></i> Profile
                </a>
                </li>

                <li>
                <a href="<?php echo site_url('change-password'); ?>" class="dropdown-item">
                <i class="fa fa-lock mr-2"></i> Change Password
                </a>
                </li>


                <li class="dropdown-divider"></li>

                <li>
                <a href="<?php echo site_url('SemesterAuth/logout'); ?>" class="dropdown-item text-danger">
                <i class="fa fa-sign-out mr-2"></i> Logout
                </a>
                </li>


                </ul>
                </li>


                </ul>
                </nav>
                <!-- /.navbar -->

                

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
          
                <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"></span>
                </a>



                <!-- Sidebar -->
                <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="image">
                <img src="<?php echo base_url($image); ?>" class="img-circle elevation-2" alt="Students">
                </div>



                <div class="info">
                <a href="#" class="d-block">
                    
                <?php              
                
                echo $firstname; ?></a>
                </div>

                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
                </div>
                </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <!--
                <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
                </a>
                </li>
                </ul>
                </li>
                ------->




                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/dashboard" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
                </p>
                </a>
                </li>


                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/user" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Profile

                </p>
                </a>
                </li>


                <li class="nav-item">
                <a href="./index.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Fees

                </p>
                </a>
                </li>



                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/timetable" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Class Timetable

                </p>
                </a>
                </li>


                <li class="nav-item">
                <a href="./index.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Lesson Plan

                </p>
                </a>
                </li>


                <li class="nav-item">
                <a href="./index.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Syllabus Status

                </p>
                </a>
                </li>



                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/homework" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Homework

                </p>
                </a>
                </li>

                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/apply_leave" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Apply Leave
                </p>
                </a>
                </li> 


                
              


                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Download Center
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Assignments</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Study Materials</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Syllabus</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Refund</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Other Downloads <small></small></p>
                </a>
                </li>
                <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Old Question Papers</p>
                </a>
                </li>
                </ul>
                </li>


                
                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Attendence
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
                </p>
                </a>


 
                <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/attendancelog" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Date-wise Attendance</p>
                </a>
                </li>



                <li class="nav-item">
                <a href="<?php echo base_url(); ?>student_semester_info/attendancelog/period_wise_attendance" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Period-wise Attendance</p>
                </a>
                </li>               
                </ul>
                </li>
                



                
<!--
                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Attendance
                </p>
                </a>
                </li> 



                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Subject Attendance
                </p>
                </a>
                </li> 
            --> 
                
                


                    <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                    Examination
                    <i class="fas fa-angle-left right"></i>
                    <!-- <span class="badge badge-info right">6</span> -->
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="<?php echo base_url(); ?>student_semester_info/examschedule" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Exam Schedule</p>
                    </a>
                    </li>


                    <li class="nav-item">
                    <a href="<?php echo base_url(); ?>semesterauth/admitcard" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admit Card</p>
                    </a>
                    </li>

                    <li class="nav-item">
                    <a href="<?php echo base_url(); ?>student_semester_info/Examapplication/onlineExamination" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Apply For Examination</p>
                    </a>
                    </li>

                    <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Exam Result</p>
                    </a>
                    </li>


                    <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marksheet</p>
                    </a>
                    </li>




                    <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Other Downloads <small></small></p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="pages/layout/fixed-topnav.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Old Question Papers</p>
                    </a>
                    </li>
                    </ul>
                    </li>

                    
                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Notice Board
                </p>
                </a>
                </li>  

                 <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Teachers Review
                </p>
                </a>
                </li>  
                

                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Library
                </p>
                </a>
                </li>  

                 <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Hostel Rooms
                </p>
                </a>
                </li>  
                

                </ul>
                </nav>
                <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
                </aside>

                

