            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $this->customlib->getAppName(); ?></title>

            <!-- Bootstrap 5 CSS -->
            <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
            
            
            <link rel="stylesheet" href="<?php echo base_url('assets_sem/css/bootstrap.min.css'); ?>">

            <link rel="stylesheet" href="<?php echo base_url('assets_sem/css/all.min.css'); ?>">
            <!-- Font Awesome -->

           
            
            

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <meta name="theme-color" content="#424242" />



            <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" rel="shortcut icon" type="image/x-icon">
            <style>
            :root {
            --sidebar-width: 250px;
            --header-height: 60px;
            }

            body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            }

            /* Header Styles */
            .top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            background: linear-gradient(135deg, #5a7fa1, #5a7fa1);
            color: white;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .top-header .navbar-brand {
            font-size: 1.3rem;
            font-weight: 600;
            color: white;
            }

            .top-header .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
            }

            .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            color: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            }

            .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px 10px;
            transition: transform 0.3s ease;
            }

            .sidebar-toggle:hover {
            transform: scale(1.1);
            }

            /* Main Content Area */
            .main-wrapper {
            display: flex;
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            }

            /* Sidebar Styles */
            .sidebar {
            width: var(--sidebar-width);
            background: #2c3e50;
            color: white;
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1020;
            }

            .sidebar.minimized {
            width: 70px;
            }

            .sidebar.minimized .sidebar-header h5,
            .sidebar.minimized .sidebar-header small,
            .sidebar.minimized .sidebar-menu span {
            display: none;
            }

            .sidebar.minimized .sidebar-menu a {
            justify-content: center;
            padding: 15px 10px;
            }

            .sidebar.minimized .sidebar-menu i {
            font-size: 1.3rem;
            }

            .sidebar.minimized .sidebar-menu a:hover {
            padding-left: 10px;
            }

            .sidebar.collapsed {
            margin-left: calc(-1 * var(--sidebar-width));
            }

            .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            }

            .sidebar-menu li {
            border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 12px;
            }

            .sidebar-menu a:hover {
            background: rgba(52, 152, 219, 0.3);
            padding-left: 25px;
            }

            .sidebar-menu a.active {
            background: #3498db;
            border-left: 4px solid #2ecc71;
            }

            .sidebar-menu i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            }

            .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.2);
            border-bottom: 2px solid rgba(255,255,255,0.1);
            }

            .sidebar-header h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #3498db;
            }

            /* Submenu styles for vertical sidebar */
            /* Submenu styles for vertical sidebar - animated */
            .submenu {
            /* always in flow for animation */
            display: block;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            list-style: none;
            padding: 0;
            margin: 0;
            background: rgba(0, 0, 0, 0.2);
            transition: max-height 0.6s ease, opacity 0.6s ease;
            }

            /* Remove hover-open; only open when li has .active (JS toggles it) */
            /* .sidebar-menu > li:hover .submenu { ... }  <-- delete this line */
            .sidebar-menu > li.active .submenu {
            /* JS sets exact max-height, but this helps when class toggles without inline set */
            max-height: 1000px;
            opacity: 1;
            }

            /* Submenu items */
            .submenu li {
            border-bottom: none;
            }

            .submenu li a {
            padding: 12px 20px 12px 52px;
            color: #bdc3c7;
            font-size: 0.9rem;
            gap: 10px;
            }

            .submenu li a:hover {
            background: rgba(52, 152, 219, 0.2);
            color: #fff;
            padding-left: 57px;
            }

            /* Chevron rotation animation */
            .sidebar-menu > li > a .fa-chevron-down {
            transition: transform 0.6s ease;
            }

            .fa-chevron-down.rot-180 {
            transform: rotate(180deg);
            }

            /* When sidebar is minimized - keep submenus hidden */
            .sidebar.minimized .submenu {
            max-height: 0 !important;
            opacity: 0 !important;
            }

            /* .sidebar.minimized .fa-chevron-down {
            display: none;
            } */

            /* Mobile Responsive */
            /* Mobile Responsive */
            @media (max-width: 991.98px) {
            .sidebar {
            margin-left: calc(-1 * var(--sidebar-width));
            position: fixed; /* ensure it overlays content */
            }

            .sidebar.show {
            margin-left: 0;
            }

            /* Override content wrapper margin on mobile */
            .content-wrapper {
            margin-left: 0 !important; /* remove sidebar space */
            width: 100% !important;
            transition: all 0.3s ease;
            }

            /* Optional: if sidebar is open, shift content (optional) */
            .sidebar.show ~ .content-wrapper {
            /* If you want the content to shift when sidebar opens */
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            }
            }


            /* Content Area Adjustment */
            .content-wrapper {
            margin-left: var(--sidebar-width);
            padding: 20px;
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s ease;
            flex: 1;
            }

            .sidebar.minimized ~ .content-wrapper {
            margin-left: 70px;
            width: calc(100% - 70px);
            }

            @media (max-width: 991.98px) {
            .content-wrapper {
            margin-left: 0;
            width: 100%;
            }
            }

            /* Content Styles */
            .page-header h2 {
            font-weight: 600;
            color: #2c3e50;
            }

            .card {
            transition: transform 0.2s, box-shadow 0.2s;
            }

            .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            }

            .notice-item h6 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2c3e50;
            }

            .table th {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            }

            .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            }

            .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
            }

            .breadcrumb-item a:hover {
            text-decoration: underline;
            }

            /* Footer Styles */
            .footer {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            }

            .sidebar.minimized ~ * .footer,
            body.sidebar-minimized .footer {
            margin-left: 70px;
            }

            @media (max-width: 991.98px) {
            .footer {
            margin-left: 0;
            }
            }

            .footer a {
            color: #667eea;
            transition: color 0.2s;
            }

            .footer a:hover {
            color: #764ba2;
            }
            </style>
            </head>
            <body>
            <!-- ========== HEADER SECTION ========== -->
            <nav class="top-header">
            <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center h-100">
            <div class="d-flex align-items-center gap-3">
            <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">
            <i class="fas fa-graduation-cap"></i> Semester Portal
            </a>
            </div>

            <div class="user-menu">
            <div class="dropdown">        

            <!-- <button class="btn btn-link text-white dropdown-toggle text-decoration-none" type="button" id="userDropdown" data-bs-toggle="dropdown">
            <div class="user-avatar">J</div>
            <span class="ms-2 d-none d-md-inline">John Doe</span>
            </button> -->


                <?php $sem_student = $this->session->userdata('sem_student'); ?>
                <button class="btn btn-link text-white dropdown-toggle text-decoration-none d-flex align-items-center gap-2" type="button" id="userDropdown" data-bs-toggle="dropdown">
                <div class="user-avatar" style="width:35px; height:35px; border-radius:50%; background:white; color:#667eea; display:flex; align-items:center; justify-content:center; font-weight:600;">
                <?php 
                // Show first letter of firstname as avatar
                echo !empty($sem_student['firstname']) ? strtoupper($sem_student['firstname'][0]) : 'U'; 
                ?>
                </div>
                <span class="d-none d-md-inline">
                <?= !empty($sem_student['firstname']) ? $sem_student['firstname'] : 'User' ?>
                </span>
                </button>



            <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="<?php echo site_url('SemesterAuth/logout'); ?>"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
            </div>
            </div>
            </div>
            </div>
            </nav>

            <div class="main-wrapper">
            <!-- ========== SIDEBAR SECTION ========== -->
            <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
            <h5><i class="fas fa-user-graduate"></i> Student Menu</h5>
            <small class="text-muted">Academic Year 2024-25</small>
            </div>

            <ul class="sidebar-menu">
            <li>
            <a href="#" class="active">
            <i class="fas fa-gauge"></i>
            <span>Dashboard</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-money-bill-wave"></i>
            <span>Fees</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-calendar-days"></i>
            <span>Class Timetable</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Lesson Plan</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-list-check"></i>
            <span>Syllabus Status</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-file-pen"></i>
            <span>Home Work</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-calendar-minus"></i>
            <span>Apply Leave</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-download"></i>
            <span>Download Center</span>
            </a>
            </li>


            <li>
            <a href="#">
            <i class="fas fa-user-check"></i>
            <span>Attendance</span>
            </a>
            </li>


            <li>
            <a href="#">
            <i class="fas fa-clipboard-check"></i>
            <span>Subject Attendance</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-file-lines"></i>
            <span>Examination</span>
            <i class="fas fa-chevron-down"></i>
            </a>  



            <ul class="submenu">
            <li><a href="<?php echo base_url(); ?>student_semester_info/examschedule"><i class="fas fa-plus"></i><span>Exam Schedule</span></a></li>
            <li><a href="<?php echo base_url(); ?>semesterauth/admitcard"><i class="fas fa-plus"></i><span>Admit Card</span></a></li>               
            <li><a href="<?php echo base_url(); ?>student_semester_info/Examapplication/onlineExamination"><i class="fas fa-list"></i><span>Apply For Examination</span></a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i><span>Exam Result</span></a></li>
            <li><a href="#"><i class="fas fa-calendar"></i><span>Exam Schedule</span></a></li>
            <li><a href="#"><i class="fas fa-calendar"></i><span>Exam Schedule</span></a></li>
            </ul>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-file-circle-question"></i>
            <span>Say Exam</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-arrow-trend-up"></i>
            <span>Improvement</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-square-poll-vertical"></i>
            <span>Results</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-book"></i>
            <span>Library</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-bullhorn"></i>
            <span>Notices</span>
            </a>
            </li>

            <li>
            <a href="#">
            <i class="fas fa-id-badge"></i>
            <span>My Profile</span>
            </a>
            </li>
            </ul>
            </aside>
        </div>