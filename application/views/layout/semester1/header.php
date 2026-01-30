        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->customlib->getAppName(); ?></title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">    
        <link href="<?php echo base_url(); ?>backend/dist/css/user_sem_theme.css" rel="stylesheet">    
        </head>



        <body>
    <!-- Header -->
    <nav class="header navbar navbar-dark">
        <div class="container-fluid">

            <button class="btn text-white" onclick="toggleSidebar()">
                <i class="fas fa-bars fa-lg"></i>
            </button>

            <!-- <span class="navbar-brand mb-0 h1">Admin Dashboard</span> -->
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i>
                        <span class="ms-2 d-none d-md-inline">Admin User</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('SemesterAuth/logout'); ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>



    <!-- Sidebar -->

    <aside class="sidebar" id="sidebar">
        

            <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url(); ?>student_semester_info/dashboard">
                    <i class="fas fa-home menu-icon"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

             <li>
                <a href="<?php echo base_url(); ?>student_semester_info/user" class="active">
                    <i class="fas fa-users menu-icon"></i>
                    <span class="menu-text">Profile</span>
                </a>
            </li>



            <li>
                <a href="#">
                    <i class="fas fa-users menu-icon"></i>
                    <span class="menu-text">Fees</span>
                </a>
            </li>



            <li>
                <a href="<?php echo base_url(); ?>student_semester_info/timetable">
                    <i class="fas fa-box menu-icon"></i>
                    <span class="menu-text">Class Timetable</span>
                </a>
            </li>
            


            <li>
                <a href="#">
                    <i class="fas fa-shopping-cart menu-icon"></i>
                    <span class="menu-text">Lesson Plan</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-line menu-icon"></i>
                    <span class="menu-text">Syllabus Status</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>student_semester_info/homework">
                    <i class="fas fa-envelope menu-icon"></i>
                    <span class="menu-text">Home Work</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>student_semester_info/apply_leave">
                    <i class="fas fa-file-alt menu-icon"></i>
                    <span class="menu-text">Apply Leave</span>
                </a>
            </li>
            


            <li>
                <a href="#">
                    <i class="fas fa-cog menu-icon"></i>
                    <span class="menu-text">Download Center</span>
                </a>
            </li>



            <li>
            <a href="#">
            <i class="fas fa-cog menu-icon"></i>
            <span class="menu-text">Attendance</span>
            </a>
            </li>
            



             <li>
                <a href="#">
                    <i class="fas fa-cog menu-icon"></i>
                    <span class="menu-text">Subject Attendance</span>
                </a>
            </li>


            

            <!-- <li>
            <a href="#">
            <i class="fas fa-cog menu-icon"></i>
            <span class="menu-text">Examination</span>
            </a>
            <ul class="submenu">
            <li><a href="<?php echo base_url(); ?>student_semester_info/examschedule"><i class="fas fa-plus"></i><span>Exam Schedule</span></a></li>
            <li><a href="<?php echo base_url(); ?>semesterauth/admitcard"><i class="fas fa-plus"></i><span>Admit Card</span></a></li>               
            <li><a href="<?php echo base_url(); ?>student_semester_info/Examapplication/onlineExamination"><i class="fas fa-list"></i><span>Apply For Examination</span></a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i><span>Exam Result</span></a></li>
            <li><a href="#"><i class="fas fa-calendar"></i><span>Exam Schedule</span></a></li>
            <li><a href="#"><i class="fas fa-calendar"></i><span>Exam Schedule</span></a></li>
            </ul>
            </li> -->

            <li class="menu-item">
            <a href="#" class="menu-toggle">
            <i class="fas fa-cog menu-icon"></i>
            <span class="menu-text">Examination</span>
            <i class="fas fa-angle-down float-end"></i>
            </a>

            <ul class="submenu">
            <li><a href="<?php echo base_url(); ?>student_semester_info/examschedule"><i class="fas fa-plus"></i><span>Exam Schedule</span></a></li>
            <li><a href="<?php echo base_url(); ?>semesterauth/admitcard"><i class="fas fa-plus"></i><span>Admit Card</span></a></li>               
            <li><a href="<?php echo base_url(); ?>student_semester_info/Examapplication/onlineExamination"><i class="fas fa-list"></i><span>Apply For Examination</span></a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i><span>Exam Result</span></a></li>
            <li><a href="#"><i class="fas fa-calendar"></i><span>Exam Schedule</span></a></li>
            </ul>
            </li>

             <li>
                <a href="#">
                    <i class="fas fa-cog menu-icon"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </li>

        </ul>
    </aside>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <script>
    // Toggle submenu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const submenu = menuToggle.nextElementSibling;
        const chevron = menuToggle.querySelector('.fa-angle-down');
        
        // Close submenu by default
        submenu.style.display = 'none';
        
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const isHidden = submenu.style.display === 'none';
            
            // Toggle submenu
            submenu.style.display = isHidden ? 'block' : 'none';
            
            // Toggle chevron icon
            if (isHidden) {
                chevron.classList.remove('fa-angle-down');
                chevron.classList.add('fa-angle-up');
            } else {
                chevron.classList.remove('fa-angle-up');
                chevron.classList.add('fa-angle-down');
            }
        });
    });
    </script>