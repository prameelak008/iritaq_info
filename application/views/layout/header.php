                <!DOCTYPE html> 
                <html <?php echo $this->customlib->getRTL(); ?>>
                <head>
                <meta charset="utf-8">
                <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                <meta http-equiv="Pragma" content="no-cache" />
                <meta http-equiv="Expires" content="0" />

                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title><?php echo $this->customlib->getAppName(); ?></title>
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                <meta http-equiv="Cache-control" content="no-cache">
                <meta name="theme-color" content="#424242" />
                <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" rel="shortcut icon" type="image/x-icon">

                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/jquery.mCustomScrollbar.min.css">
                <script src="//cdn.ckeditor.com/4.10.0/full-all/ckeditor.js"></script>      


                
                <?php
                $this->load->view('layout/theme');
                ?>

                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.css">

                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
                <!--file dropify-->
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/dropify.min.css">
                <!--file nprogress-->
                <link href="<?php echo base_url(); ?>backend/dist/css/nprogress.css" rel="stylesheet">

                <!--print table-->
                <link href="<?php echo base_url(); ?>backend/dist/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
                <link href="<?php echo base_url(); ?>backend/dist/datatables/css/buttons.dataTables.min.css" rel="stylesheet">
                <link href="<?php echo base_url(); ?>backend/dist/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
                <!--print table mobile support-->
                <link href="<?php echo base_url(); ?>backend/dist/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
                <link href="<?php echo base_url(); ?>backend/dist/datatables/css/rowReorder.dataTables.min.css" rel="stylesheet">
                <!--language css-->
                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/dist/css/bootstrap-select.min.css">
                <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
                <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
                <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
                <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.js"></script>
                <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
                <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>
                <script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>
                <script src="<?php echo base_url(); ?>backend/js/school-admin-custom.js"></script>
                <script src="<?php echo base_url(); ?>backend/js/sstoast.js"></script>         
                <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>   -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <!-- fullCalendar -->
                <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.css">
                <link rel="stylesheet" href="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.print.min.css" media="print">
                
                <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->


                <script type="text/javascript">
                var baseurl = "<?php echo base_url(); ?>";
                var base_url = baseurl; // alias for scripts expecting base_url
                var start_week=<?php echo $this->customlib->getStartWeek();?>;
                var chk_validate="<?php echo $this->config->item('SSLK')?>";                
                </script>



                <style type="text/css"> 

                .action_btn {
                margin-right: 10px;
                margin-top:10px;
                float:left;
                }

                .action_btn form {
                display: inline;
                }         


                .btn-link-button {
                /*inline style  color:#fff; border-width: 2px; padding:4px 4px 4px 4px; background-color:green; */
                display: inline-block;
                padding: 6px 12px;
                background-color: green;
                color: #fff;
                border: 2px solid green;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                }

                .btn-link-button:hover {
                background-color: darkgreen;
                border-color: darkgreen;
                }

                .btn-link-cancel-button {
                /* inline style : color:#fff; border-width: 2px; padding:4px 4px 4px 4px; background-color:#c43535;  */
                display: inline-block;
                padding: 6px 12px;
                background-color: red;
                color: #fff;
                border: 2px solid red;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                }
                .btn-link-cancel-button:hover {
                background-color: darkred;
                border-color: darkred;
                }

                 .btn-link-button-primary 
                 {       
                display: inline-block;
                padding: 6px 12px;
                background-color: #168DEE ;
                color: #fff;
                border: 2px solid #168DEE;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                }


                .btn-link-button-primary:hover {
                background-color: #168DEE;
                border-color: #168DEE;
                }

                .text-decor-approve
                {
                display: inline-block; 
                padding: 6px 12px;
                background-color: green;
                color: white;
                border: 2px solid #cdcaca;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                /* cursor: pointer; */
                }


                .text-decor-reject
                {
                display: inline-block; 
                padding: 6px 12px;
                background-color: #d44545;
                color: white;
                border: 2px solid #cdcaca;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                /* cursor: pointer; */
                }

                .text-decor-awaiting
                {
                display: inline-block; 
                padding: 6px 12px;
                background-color: #7979e6;
                color: white;
                border: 2px solid #cdcaca;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
                font-weight: bold;
                /* cursor: pointer; */
                }



                span.flag-icon.flag-icon-us{text-orientation: mixed;}      
                .lbl-toggle { display: block; font-weight: bold; font-family: monospace; font-size: 1.2rem; 
                text-transform: uppercase; text-align: center; padding: 1rem; color: #DDD; background: #3d8b87; 
                cursor: pointer; border-radius: 7px; transition: all 0.25s ease-out; }
                .lbl-toggle:hover { color: #FFF; }
                .lbl-toggle::before { content: ' ';

                display: inline-block;
                border-top: 5px solid transparent;

                border-bottom: 5px solid transparent; border-left: 5px solid currentColor; vertical-align: middle; margin-right: .7rem; transform: translateY(-2px);
                transition: transform .2s ease-out; } .toggle:checked+.lbl-toggle::before { transform: rotate(90deg) translateX(-3px); }


                .toggle:checked + .lbl-toggle + .collapsible-content { max-height: 350px; } 
                .toggle:checked+.lbl-toggle { border-bottom-right-radius: 0; border-bottom-left-radius: 0; }


                .collapsible-content 
                .content-inner
                {
                border-bottom: 1px solid rgba(0, 105, 255, .45); border-bottom-left-radius: 7px; border-bottom-right-radius: 7px;  } 
                .collapsible-content p { margin-bottom: 0; }   


                .lbl-toggle_val { display: block; font-weight: bold; font-family: monospace; font-size: 1.2rem; 
                text-transform: uppercase; text-align: center; padding: 1rem; color: #DDD; background: #3d8b87; 
                cursor: pointer; border-radius: 7px; transition: all 0.25s ease-out; }
                .lbl-toggle_val:hover { color: #FFF; }
                .lbl-toggle_val::before { content: ' ';

                display: inline-block;
                border-top: 5px solid transparent;

                border-bottom: 5px solid transparent; border-left: 5px solid currentColor; vertical-align: middle; margin-right: .7rem; transform: translateY(-2px);
                transition: transform .2s ease-out; } .toggle:checked+.lbl-toggle_val::before { transform: rotate(90deg) translateX(-3px); }


                .toggle:checked + .lbl-toggle_val + .collapsible-content { max-height: 350px; } 
                .toggle:checked+.lbl-toggle_val { border-bottom-right-radius: 0; border-bottom-left-radius: 0; }


                .fontdelcol{
                color:#db1d24 !important;
                }


                .extstyle
                {
                color:#9a5b5b;
                }


                .mCustomScrollBox
                {
                overflow: unset !important;
                }

                .trashstyle
                {
                color:#d82f2f;
                }

                .editstyle
                {
                color:#4d4d65;
                }

                .custombtn { 
                margin-right:10px; 
                }
                .overflowtextdot{overflow: hidden;width: 108%;white-space: nowrap;text-overflow: ellipsis;margin-left: 20px;}

/* ============================= */
/* Variables for Semester Module */
/* ============================= */
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --secondary: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --light-bg: #f8fafc;
    --border-color: #e2e8f0;
    --text-dark: #1f2937;
    --text-light: #6b7280;
}

/* ============================= */
/* Box Styles */
/* ============================= */
.box {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
}

/* .box:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
} */

/* .box-primary {
    border-top: 4px solid var(--primary);
}

.box-header {
    background: linear-gradient(135deg, #6589d7 0%, #293047 100%);
    color: white;
    padding: 20px;
    border: none;
} */

/* ============================= */
/* Buttons */
/* ============================= */
.btn {
    display: inline-block;
    border-radius: 6px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
    font-family: inherit;
   
}

/* .btn-info {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
}

.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
} */

/* .btn-danger {
    background-color: var(--danger);
    color: white;
}

.btn-danger:hover {
    background-color: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
} */

/* .btn-default {
    background-color: white;
    color: var(--text-dark);
    border: 1px solid var(--border-color);
}

.btn-default:hover {
    background-color: var(--light-bg);
    border-color: var(--primary);
} */



/* ============================= */
/* Checkboxes */
/* ============================= */
input[type="checkbox"] {
    cursor: pointer;
    width: 20px;
    height: 20px;
    accent-color: var(--primary);
}


 .form-control001{
    /* width: 100%; */
    border: 1px solid var(--border-color);
    border-radius: 6px;
    /* padding: 23px 18px; */
    font-size: 17px;
    /* transition: all 0.3s 
ease; */
    background-color: #ffffff;
    font-family: inherit;
} 

/* .form-control {
  width: 100%;
  border: 1px solid var(--border-color);
  border-radius: 6px;
  padding: 10px 14px;       
  font-size: 16px;
  line-height: 1.4;
  background-color: #ffffff;
  color: var(--text-dark);
  transition: all 0.3s ease;
  font-family: inherit;
  box-sizing: border-box;
  height: 45px;             
} */

/* For select boxes */
/* select.form-control {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,<svg xmlns='http://www.w3.org/2000/svg' fill='%236b7280' viewBox='0 0 24 24'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 12px center;
  background-size: 16px;
  padding-right: 36px;       /* space for dropdown arrow */
  cursor: pointer;
} */

/* Focus effect */
/* .form-control:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
  outline: none;
} */

/* Disabled state */
/* .form-control:disabled {
  background-color: #f3f4f6;
  color: var(--text-light);
  cursor: not-allowed;
} */









                </style>
                </head>
                <body class="hold-transition skin-blue fixed sidebar-mini">


                <?php
                $coun           =  $this->customlib->countstudentleave();
                $stfcoun        =  $this->customlib->countstaffleave();

                $result       = $this->customlib->getUserData();

                $image        = $result["image"];
                $role         = $result["user_type"];
                $id           = $result["id"];
                $countstud    = $this->customlib->countleave_student($id);


                ?>
                <?php
                //if ($this->config->item('SSLK') == "") {
                ?>
                <!--<div class="topaleart">
                <div class="slidealert">
                <div class="alert alert-dismissible topaleart-inside"> 
                <p class="palert"><strong>Alert!</strong> You are using unregistered version of Smart School. Please <a  href="#" class="purchasemodal">click here</a> to register your purchase code for Smart School.</p>
                </div></div>
                </div>-->
                <?php
                //}


                ?> 
                <script>

                function collapseSidebar() {

                if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                sessionStorage.setItem('sidebar-toggle-collapsed', '');
                } else {
                sessionStorage.setItem('sidebar-toggle-collapsed', '1');
                }

                }

                function checksidebar()
                {
                if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                var body = document.getElementsByTagName('body')[0];
                body.className = body.className + ' sidebar-collapse';
                }
                }

                checksidebar();

                </script> 
                <div class="wrapper">

                <header class="main-header" id="alert" >
                <a href="<?php echo base_url(); ?>admin/admin/dashboard" class="logo">
                <span class="logo-mini"><img src="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                <span class="logo-lg"><img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo();?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                <a onclick="collapseSidebar()"  class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </a>
                <div class="col-lg-5 col-md-3 col-sm-2 col-xs-5">
                <span href="#"  class="sidebar-session">
                <?php echo $this->setting_model->getCurrentSchoolName(); ?>
                </span>
                </div>
                <div class="col-lg-7 col-md-9 col-sm-10 col-xs-7">
                <div class="pull-right">
                <?php if ($this->rbac->hasPrivilege('student', 'can_view')) {?>





                <form id="header_search_form" class="navbar-form navbar-left search-form" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
                    <?php echo $this->customlib->getCSRF(); ?>
                    <div class="input-group">
                        <input type="text" value="<?php echo set_value('search_text1');?>" name="search_text1" id="search_text1" class="form-control search-form search-form3" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" onclick="getstudentlist()" style="" class="btn btn-flat topsidesearchbtn"><i class="fa fa-search"></i></button>
                        </span>
                    </div>

                </form>



                <?php }?>
                <div class="navbar-custom-menu">
                <?php if($this->rbac->hasPrivilege('language_switcher','can_view')){
                    ?>
                    <div class="langdiv"><select class="languageselectpicker" onchange="set_languages(this.value)"  type="text" id="languageSwitcher" >
                            
                            <?php $this->load->view('admin/language/languageSwitcher')?>

                        </select></div> 
                    <?php
                }?>

                        
                <ul class="nav navbar-nav headertopmenu">
                <?php
                if ($this->module_lib->hasActive('calendar_to_do_list')) {
                if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
                ?>
                            <li class="cal15"><a data-placement="bottom" data-toggle="tooltip" title="<?php echo $this->lang->line('calendar') ?>" href="<?php echo base_url() ?>admin/calendar/events" ><i class="fa fa-calendar"></i></a>

                            </li>
                            <?php
                }
                }
                ?>
                    <?php
                if ($this->module_lib->hasActive('calendar_to_do_list')) {
                if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_view')) {
                ?>
                            <li class="dropdown" data-placement="bottom" data-toggle="tooltip" title="<?php echo $this->lang->line('task') ?>">
                                <a href="#"  class="dropdown-toggle todoicon" data-toggle="dropdown">
                                    <i class="fa fa-check-square-o"></i>
                                    <?php
                $userdata = $this->customlib->getUserData();
                $count    = $this->customlib->countincompleteTask($userdata["id"]);
                if ($count > 0) {
                ?>

                                        <span class="todo-indicator"><?php echo $count ?></span>
                                    <?php }?>
                                </a>
                                <ul class="dropdown-menu menuboxshadow">

                <li class="todoview plr10 ssnoti"><?php echo $this->lang->line('today_you_have'); ?> <?php echo $count; ?> <?php echo $this->lang->line('pending_task'); ?><a href="<?php echo base_url() ?>admin/calendar/events" class="pull-right pt0"><?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('all'); ?></a></li>


                <li>

                <ul class="todolist">
                <?php
                $tasklist = $this->customlib->getincompleteTask($userdata["id"]);
                foreach ($tasklist as $key => $value) {
                ?>
                <li>
                <div class="checkbox">
                <label><input type="checkbox" id="newcheck<?php echo $value["id"] ?>" onclick="markc('<?php echo $value['id'] ?>')" name="eventcheck"  value="<?php echo $value["id"]; ?>"><?php echo $value["event_title"] ?></label>
                </div>
                </li>
                <?php }?>

                </ul>
                </li>
                </ul>
                </li>



                <?php

                $result = $this->customlib->getUserData();
                $role   = $result["user_type"];

                if ($role=='Super Admin' || $role=='Admin')
                { 
                ?>

                <li class="dropdown" data-placement="bottom" data-toggle="tooltip" title="<?php echo $this->lang->line('student') .'-'. $this->lang->line('staff').'&nbsp;'.$this->lang->line('leave_request') ;?>">

                <a href="#"  class="dropdown-toggle todoicon" data-toggle="dropdown">
                <i class="fa fa-bell">
                </i>

                <?php
                if ($coun > 0 || $stfcoun>0) 
                {
                ?>
                <span class="todo-indicator"><?php  echo $coun+$stfcoun; ?></span>
                <?php 
                }
                ?>
                </a>
                <ul class="dropdown-menu menuboxshadow">
                <li class="todoview plr10 ssnoti">

                <?php
                if($coun>0)
                {
                ?>
                <?php echo $this->lang->line('today_you_have'); ?> <?php echo $coun; ?>&nbsp;
                <?php echo $this->lang->line('student').'&nbsp;'.$this->lang->line('leave_request'); ?>


                <a href="<?php echo base_url() ?>admin/approve_leave" class="pull-right pt0">
                <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('all'); ?>
                </a>
                <?php } ?>
                <br>
                <br>


                <?php
                if($stfcoun>0)
                {
                ?>
                <?php echo $this->lang->line('today_you_have'); ?> <?php echo $stfcoun; ?>&nbsp;<?php echo $this->lang->line('staff').'&nbsp;'.$this->lang->line('leave_request'); ?>
                <a href="<?php echo base_url() ?>admin/leaverequest/leaverequest" class="pull-right pt0">
                <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('all'); ?>
                </a>
                <?php } ?>
                <li>
                <ul class="todolist">
                </ul>
                </li>
                </ul>
                </li>

                <?php
                }

                else if($role=="Teacher")
                { 
                ?>

                <li class="dropdown" data-placement="bottom" data-toggle="tooltip" title="<?php echo $this->lang->line('student') .'--'.$this->lang->line('leave_request') ;?>">

                <a href="#"  class="dropdown-toggle todoicon" data-toggle="dropdown">
                <i class="fa fa-bell">
                </i>

                <?php
                if ($countstud > 0 ) 
                {
                ?>
                <span class="todo-indicator"><?php  echo $countstud; ?></span>
                <?php 
                }
                ?>
                </a>

                <?php
                if($countstud>0)
                {
                ?>
                <ul class="dropdown-menu menuboxshadow">
                <li class="todoview plr10 ssnoti">



                <?php echo $this->lang->line('today_you_have'); ?> <?php echo $countstud; ?>&nbsp;
                <?php echo $this->lang->line('student').'&nbsp;'.$this->lang->line('leave_request'); ?>


                <a href="<?php echo base_url() ?>admin/approve_leave" class="pull-right pt0">
                <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('all'); ?>
                </a>


                <li>
                <ul class="todolist">
                </ul>
                </li>
                </ul>
                <?php 
                }
                ?>
                </li>

                <?php
                }
                }
                }
                if ($this->module_lib->hasActive('chat')){
                    if($this->rbac->hasPrivilege('chat','can_view')){
                        ?>
                            <li class="cal15"><a data-placement="bottom" data-toggle="tooltip" title="" href="<?php echo base_url()?>admin/chat" data-original-title="<?php echo $this->lang->line('chat')?>" class="todoicon"><i class="fa fa-whatsapp"></i></a></li> 
                        <?php
                    }
                ?>

                    
                <?php }
                $file         = "";
                $result       = $this->customlib->getUserData();

                $image        = $result["image"];
                $role         = $result["user_type"];
                $id           = $result["id"];





                if (!empty($image)) 
                {

                $file = "uploads/staff_images/" . $image;
                } 
                else
                {
                if($result['gender']=='Female')
                {
                $file= "uploads/staff_images/default_female.jpg";
                }
                else
                {
                $file ="uploads/staff_images/default_male.jpg";
                }    
                }
                ?>
                    <li class="dropdown user-menu">
                        <a class="dropdown-toggle" style="padding: 15px 13px;" data-toggle="dropdown" href="#" aria-expanded="false">
                            <img src="<?php echo base_url() . $file; ?>" class="topuser-image" alt="User Image">
                        </a>
                        <ul class="dropdown-menu dropdown-user menuboxshadow">
                            <li>
                                <div class="sstopuser">
                                    <div class="ssuserleft">
                                        <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>"><img src="<?php echo base_url() . $file; ?>" alt="User Image"></a>
                                    </div>

                                    <div class="sstopuser-test">
                            <h4 class="text-capitalize"><?php echo $this->customlib->getAdminSessionUserName(); ?></h4>
                                        <h5><?php echo $role; ?></h5>
                                        
                                    </div>

                                    <div class="divider"></div>
                                    <div class="sspass">
                                        <a href="<?php echo base_url() . "admin/staff/profile/" . $id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('my_profile'); ?>"><i class="fa fa-user"></i><?php echo $this->lang->line('profile'); ?> </a> 
                                        <a class="pl25" href="<?php echo base_url(); ?>admin/admin/changepass" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('change_password'); ?>"><i class="fa fa-key"></i><?php echo $this->lang->line('password'); ?></a> <a class="pull-right" href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i><?php echo $this->lang->line('logout'); ?></a>
                                    </div>
                                </div><!--./sstopuser--></li>
                        </ul>
                    </li>
                    
                </ul>
                </div>
                </div>


                <div class="buttons">
                <div class="action_btn">
                <form id="stentrance" method="POST" action="<?php echo site_url('admin/admin/entrancedashboard'); ?>" >
                <input type="submit" name="btnexam"  value="Entrance Exam"  />
                </form>


                <form id="ststudent" method="POST" action="<?php echo site_url('admin/admin/dashboard'); ?>" >
                <input type="submit" name="btnstudent" value="Student"  />
                </form>
                </div>
                </div>
                </nav>
                </header>


                <?php $this->load->view('layout/sidebar');?>
                <script>
                function defoult(id){
                var defoult=  $('#languageSwitcher').val();   

                $.ajax({
                type: "POST",
                url: base_url + "admin/language/default_language/"+id,
                data: {},
                success: function (data) {
                successMsg("Status Change Successfully");
                $('#languageSwitcher').html(data);

                }
                });

                window.location.reload('true');        
                }

                function set_languages(lang_id){       
                $.ajax({
                type: "POST",
                url: base_url + "admin/language/user_language/"+lang_id,
                data: {},
                success: function (data) { 
                successMsg("Status Change Successfully");
                window.location.reload('true');
                }
                });

                }
                </script>


