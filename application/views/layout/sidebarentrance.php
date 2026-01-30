<aside class="main-sidebar" id="alert2">
    <?php if ($this->rbac->hasPrivilege('student', 'can_view')) {?>
        <form class="navbar-form navbar-left search-form2" role="search"  action="<?php echo site_url('admin/admin/search'); ?>" method="POST">
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="input-group ">

                <input type="text"  name="search_text" class="form-control search-form" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    <?php }?>
    
    <section class="sidebar" id="sibe-box">
        <?php $this->load->view('layout/top_sidemenu');?>
        
            <ul class="sidebar-menu verttop">
            <?php
            if ($this->module_lib->hasActive('entrance_applcation')) {
            if (($this->rbac->hasPrivilege('entrance_examgroup', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_examcenter', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_exam_institute', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_exam_course', 'can_view') ||
            $this->rbac->hasPrivilege('applicant_details', 'can_view'))) 
            {
            ?>
            
            
            <li class="treeview <?php echo set_Topmenu('entrance_applcation'); ?>">
            <a href="#">
            <i class="fa fa-users"></i> <span><?php echo $this->lang->line('entrance_applcation'); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            
            <ul class="treeview-menu">
            <?php if ($this->rbac->hasPrivilege('entrance_examgroup', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/examgroup'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/examgroup"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('examgroup'); ?> </a></li>
            <?php
            }
            
            
            
            if ($this->rbac->hasPrivilege('entrance_exam_course ', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('EntranceExam/course'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/course"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('examcourse'); ?> </a></li>
            
            <li class="<?php echo set_Submenu('EntranceExam/selected_course'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/selected_course"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('selected_course'); ?> </a></li>
            
            <?php
            }
            
            
            if ($this->rbac->hasPrivilege('entrance_examcenter', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('EntranceExam/center'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/center"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('examcenter'); ?> </a></li>
            <?php
            }
            if ($this->rbac->hasPrivilege('entrance_exam_institute ', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('EntranceExam/institute'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/groupinstitute"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('examinstitute'); ?> </a></li>
            
            <li class="<?php echo set_Submenu('EntranceExam/selected_institute'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/institute"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('selected_institute'); ?> </a></li>
            
            <li class="<?php echo set_Submenu('EntranceExam/selected_center'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/selected_center"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('selected_center'); ?> </a></li>
            <?php
            }
            
            if ($this->rbac->hasPrivilege('applicant_details ', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('EntranceExam/examsearch'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/examsearch"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('applicant_details'); ?> </a></li>
            <?php
            }
            ?>
            </ul>
            </li>
            <?php
            }
            }
            ?>
            
            
            
            <?php
            if ($this->module_lib->hasActive('entrance_payment')) {
            if (($this->rbac->hasPrivilege('payment_details', 'can_view') || 
            $this->rbac->hasPrivilege('update_payment', 'can_view')))
            {
            ?>
            <li class="treeview <?php echo set_Topmenu('entrance_payment'); ?>">
            <a href="#">
            <i class="fa fa-money"></i> <span><?php echo $this->lang->line('payment_details'); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <?php if ($this->rbac->hasPrivilege('payment_details', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('EntranceExam/paymentdetails'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/paymentdetails"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('payment_details'); ?> </a></li>
            <?php
            }
            
            if ($this->rbac->hasPrivilege('update_payment', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/payment/checkpayment'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/payment/checkpayment"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('update_payment'); ?> </a></li>
            <?php
            }
            ?>
            </ul>
            </li>
            <?php } }
            
            
            
            if ($this->module_lib->hasActive('entrance_exam')) 
            {
            if (($this->rbac->hasPrivilege('entrancesubject_type', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_subject', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_admit_card', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_attendance', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_enter_marks', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_printmarklist', 'can_view') ||
            $this->rbac->hasPrivilege('entrance_assign_marks', 'can_view') ))
            {
            ?>
            
            <li class="treeview <?php echo set_Topmenu('entrance_exam'); ?>">
            <a href="#">
            <i class="fa fa-book"></i> <span><?php echo $this->lang->line('entranceexam'); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
            <?php if ($this->rbac->hasPrivilege('entrancesubject_type', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/Entrance_subjecttype/subjecttype'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Entrance_subjecttype/subjecttype"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('exam').''.$this->lang->line('type'); ?> 
            </a>
            </li>
            <?php
            }
            
            if ($this->rbac->hasPrivilege('entrance_subject', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/Entranceexam_subject/subject'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Entranceexam_subject/subject"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('subject'); ?> </a></li>
            <?php
            }
            
            
            
            if ($this->rbac->hasPrivilege('entrance_admit_card', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('EntranceExam/admitcard'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/admitcard"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('admitcard'); ?> </a></li>
            <?php
            }
            
            if ($this->rbac->hasPrivilege('entrance_assign_marks', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/Entranceexam_marks/marks'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Entranceexam_marks/marks"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('assign_marks'); ?> </a></li>
            <?php
            }
           
           
            if ($this->rbac->hasPrivilege('entrance_attendance', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/attendance'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/attendance"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('attendance'); ?> </a></li>
            <?php
            }
            
             if ($this->rbac->hasPrivilege('entrance_enter_marks', 'can_view')) 
             { 
             ?>
            <li class="<?php echo set_Submenu('entrance_allotment/Add_marks'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Add_marks"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('enter_marks'); ?> </a></li>
            
            <li class="<?php echo set_Submenu('entrance_allotment/Examresult'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Examresult"><i class="fa fa-angle-double-right"></i> Print Marklist</a></li>
            <?php
            }
             ?>
            </ul>
            </li>
            
            <?php
            }
            }
            
            
            
            
            if ($this->module_lib->hasActive('entrance_allotment')) 
            {
            if (($this->rbac->hasPrivilege('allotment_type', 'can_view') ||
            $this->rbac->hasPrivilege('allotment_seat', 'can_view') ||
            $this->rbac->hasPrivilege('cutofmarks', 'can_view') ||
            $this->rbac->hasPrivilege('eligible', 'can_view') ||
            $this->rbac->hasPrivilege('generate_allotment', 'can_view') ||
            $this->rbac->hasPrivilege('view_allotment', 'can_view')))
            {
            ?>
            
            
            <li class="treeview <?php echo set_Topmenu('entrance_allotment'); ?>">
            <a href="#">
            <i class="fa fa-list-ol"></i> <span><?php echo $this->lang->line('ranklist'); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            
            <ul class="treeview-menu">
            <?php if ($this->rbac->hasPrivilege('allotment_type', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/Seatquota'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Seatquota"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('criteria'); ?> </a></li>
            <?php
            }
            ?>
             
             
            <?php if ($this->rbac->hasPrivilege('allotment_type', 'can_view')) { ?>
            <li class="<?php echo set_Submenu('entrance_allotment/ranklist'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/ranklist"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('ranklist'); ?> </a></li>
            <?php
            }
            ?>
            </ul>
            </li>
            <?php
            }
            }
            
            
            
            
            if ($this->module_lib->hasActive('entrance_allotment')) 
            {
            if (($this->rbac->hasPrivilege('allotment_type', 'can_view') ||
            $this->rbac->hasPrivilege('allotment_seat', 'can_view') ||
            $this->rbac->hasPrivilege('cutofmarks', 'can_view') ||
            $this->rbac->hasPrivilege('eligible', 'can_view') ||
            $this->rbac->hasPrivilege('generate_allotment', 'can_view') ||
            $this->rbac->hasPrivilege('view_allotment', 'can_view')))
            {
            ?>
            
            <li class="treeview <?php echo set_Topmenu('entrance_allotment'); ?>">
            <a href="#">
            <i class="fa fa-life-ring"></i> <span><?php echo $this->lang->line('allotment'); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <?php if ($this->rbac->hasPrivilege('allotment_type', 'can_view')) { ?>
           
            <li class="<?php echo set_Submenu('EntranceExam/paymentdetailsentrance_allotment/Entrance_allotmenttype/allotmenttype'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/Entrance_allotmenttype/allotmenttype"><i class="fa fa-angle-double-right"></i>
            
            <?php echo  $this->lang->line('seat').''.$this->lang->line('type'); ?> </a></li>
            <?php
            }
            
            if ($this->rbac->hasPrivilege('allotment_seat', 'can_view')) 
            {
            ?>
            
            <li class="<?php echo set_Submenu('entrance_allotment/Entrance_allotmentseat/allotmentseat'); ?>">
            <a href="<?php echo base_url(); ?>entrance_allotment/Entrance_allotmentseat/allotmentseat"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('seat').''.$this->lang->line('no'); ?> </a></li>

            <!-- <li class="<?php echo set_Submenu('entrance_allotment/allotment/setpriority'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/setpriority'); ?>"><i class="fa fa-angle-double-right"></i>Set Priority  </a></li> -->
           
           
            <li class="<?php echo set_Submenu('entrance_allotment/allotment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment'); ?>"><i class="fa fa-angle-double-right"></i>Allotment </a></li>
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/listallotment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/viewallotment'); ?>"><i class="fa fa-angle-double-right"></i>View Allotment </a></li>
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/enrolment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/forwardenroll'); ?>"><i class="fa fa-angle-double-right"></i>Forward To Enroll </a></li>

            <?php
            }
            
            if ($this->rbac->hasPrivilege('cutofmarks', 'can_view')) { ?>
            <!--<li class="<?php echo set_Submenu('EntranceExam/paymentdetails'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/paymentdetails"><i class="fa fa-angle-double-right"></i>-->
            <!--<?php echo $this->lang->line('cutofmarks'); ?> </a></li>-->
              
             <?php
             }
             
            
            // if ($this->rbac->hasPrivilege('eligible', 'can_view')) 
            // { 
            ?>
           
            <?php
            // }
            
            if ($this->rbac->hasPrivilege('generate_allotment', 'can_view')) 
            {
            ?>
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/generate_allotment'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/allotment/generate_allotment"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line('generate'); ?> </a>
            </li>
            <?php
            }
            ?>
            
            
            
            </ul>
            </li>
            <?php } }
            
          
            if ($this->module_lib->hasActive('entrance_settings')) 
            {
            if ((
            $this->rbac->hasPrivilege('template', 'can_view') 
            ))
            {
            ?>
            
            
            
            <li class="treeview <?php echo set_Topmenu('entrance_settings'); ?>">
            <a href="#">
            <i class="fa fa-cog"></i> <span><?php echo $this->lang->line('entrance_settings'); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                
            <?php if ($this->rbac->hasPrivilege('template', 'can_view')) { ?>
            
            <li class="<?php echo set_Submenu('entrance_settings/template/'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/template/"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('template'); ?> </a></li>
            
            
             <li class="<?php echo set_Submenu('entrance_settings/settings/'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/settings/"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('settings'); ?> </a></li>
            
            <!--
           
            <li class="<?php echo set_Submenu('entrance_settings/admission'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/admission"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('admission'); ?> </a></li>
           
            
             <li class="<?php echo set_Submenu('entrance_settings/examresult'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/examresult"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('Exam').''.$this->lang->line('result'); ?> </a></li>
            
            
            <li class="<?php echo set_Submenu('entrance_settings/allotment'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/allotment"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('allotment'); ?> </a></li>
            -->



            
           <li class="<?php echo set_Submenu('entrance_settings/currentsettings'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/currentsettings"><i class="fa fa-angle-double-right"></i>
            <?php echo $this->lang->line('currentsettings'); ?> </a></li> 
            
            
            <li class="<?php echo set_Submenu('mailsms/compose_whatsapp'); ?>"><a href="<?php echo base_url(); ?>entrance_settings/mailsms/compose_whatsapp"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('send') . " " . $this->lang->line('WhatsApp') ?></a></li>
            
            
            <li class="<?php echo set_Submenu('entrance_allotment/set_fees'); ?>"><a href="<?php echo base_url(); ?>entrance_allotment/set_fees"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('set') . " " . $this->lang->line('fees') ?></a></li>
            
            
            <?php
            }
            ?>
            </ul>
            </li>
            <?php 
            }  
            }
            
            
            
            
/*            
            
if ($this->module_lib->hasActive('front_office')) {
    if (($this->rbac->hasPrivilege('admission_enquiry', 'can_view') ||
        $this->rbac->hasPrivilege('visitor_book', 'can_view') ||
        $this->rbac->hasPrivilege('phon_call_log', 'can_view') ||
        $this->rbac->hasPrivilege('postal_dispatch', 'can_view') ||
        $this->rbac->hasPrivilege('postal_receive', 'can_view') ||
        $this->rbac->hasPrivilege('complaint', 'can_view') ||
        $this->rbac->hasPrivilege('setup_font_office', 'can_view'))) {
        ?>

                    <li class="treeview <?php echo set_Topmenu('front_office'); ?>">
                        <a href="#">
                            <i class="fa fa-ioxhost ftlayer"></i> <span><?php echo $this->lang->line('front_office'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('admission_enquiry', 'can_view')) {?>

                                <li class="<?php echo set_Submenu('admin/enquiry'); ?>"><a href="<?php echo base_url(); ?>admin/enquiry"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('admission_enquiry'); ?> </a></li>

                                <?php
}
        if ($this->rbac->hasPrivilege('visitor_book', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('admin/visitors'); ?>"><a href="<?php echo base_url(); ?>admin/visitors"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('visitor_book'); ?></a></li>

                                <?php
}
        if ($this->rbac->hasPrivilege('phone_call_log', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('admin/generalcall'); ?>"><a href="<?php echo base_url(); ?>admin/generalcall"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('phone_call_log'); ?></a></li>

                                <?php
}
        if ($this->rbac->hasPrivilege('postal_dispatch', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('admin/dispatch'); ?>"><a href="<?php echo base_url(); ?>admin/dispatch"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('postal_dispatch'); ?></a></li>

                                <?php
}
        if ($this->rbac->hasPrivilege('postal_receive', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('admin/receive'); ?>"><a href="<?php echo base_url(); ?>admin/receive"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('postal_receive'); ?></a></li>

                                <?php
}
        if ($this->rbac->hasPrivilege('complaint', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('admin/complaint'); ?>"><a href="<?php echo base_url(); ?>admin/complaint"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('complain'); ?></a></li>

                                <?php
}
        if ($this->rbac->hasPrivilege('setup_font_office', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('admin/visitorspurpose'); ?>"><a href="<?php echo base_url(); ?>admin/visitorspurpose"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('setup_front_office'); ?></a></li>

                            <?php }?>
                        </ul>
                    </li>
                    <?php
}
}


if ($this->module_lib->hasActive('student_information')) {
    if (($this->rbac->hasPrivilege('student', 'can_view') ||
        $this->rbac->hasPrivilege('student', 'can_add') ||
        $this->rbac->hasPrivilege('student_history', 'can_view') ||
        $this->rbac->hasPrivilege('student_categories', 'can_view') ||
        $this->rbac->hasPrivilege('student_houses', 'can_view') ||
        $this->rbac->hasPrivilege('disable_student', 'can_view') || $this->rbac->hasPrivilege('disable_reason', 'can_view') || $this->rbac->hasPrivilege('online_admission', 'can_view') || $this->rbac->hasPrivilege('multiclass_student', 'can_view') || $this->rbac->hasPrivilege('disable_reason', 'can_view'))) {
        ?>


                    <li class="treeview <?php echo set_Topmenu('Entrance Exam Application'); ?>">
                        <a href="#">
                            <i class="fa fa-user-plus ftlayer"></i> <span><?php echo ('Entrance'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php
if ($this->rbac->hasPrivilege('student', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('EntranceExam/examsearch'); ?>"><a href="<?php echo base_url(); ?>EntranceExam/examsearch"><i class="fa fa-angle-double-right"></i> <?php echo ('Applicants Details'); ?></a></li>

                                <?php
}

if ($this->rbac->hasPrivilege('student', 'can_add')) {
            ?>

                                <li class="<?php echo set_Submenu('student/create'); ?>"><a href="<?php echo base_url(); ?>student/create"><i class="fa fa-angle-double-right"></i> <?php echo ('Design Hall Ticket'); ?></a></li>
                            <?php }?><?php
if ($this->module_lib->hasActive('online_admission')) {
            if ($this->rbac->hasPrivilege('online_admission', 'can_view')) {
                ?>

                                    <li class="<?php echo set_Submenu('onlinestudent'); ?>"><a href="<?php echo site_url('admin/onlinestudent'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('online') . " " . $this->lang->line('admission'); ?></a></li>

                                    <?php
}
        }

        if ($this->rbac->hasPrivilege('disable_student', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('student/disablestudentslist'); ?>"><a href="<?php echo base_url(); ?>student/disablestudentslist"><i class="fa fa-angle-double-right"></i> <?php echo ('Print Hall Ticket'); ?></a></li>
                                <?php
}
        if ($this->module_lib->hasActive('multi_class')) {
            if ($this->rbac->hasPrivilege('multi_class_student', 'can_view')) {
                ?>
                                    <li class="<?php echo set_Submenu('student/multiclass'); ?>"><a href="<?php echo base_url(); ?>student/multiclass"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line('multiclass') . " " . $this->lang->line('student'); ?></a></li>
                                    <?php
}
        }
        if ($this->rbac->hasPrivilege('student', 'can_delete')) {
            ?>
                                <li class="<?php echo set_Submenu('bulkdelete'); ?>"><a href="<?php echo site_url('student/bulkdelete'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo ('Create Campus'); ?></a>
                                </li>
                                <?php
}

        if ($this->rbac->hasPrivilege('student_categories', 'can_view')) {
            ?>

                                <li class="<?php echo set_Submenu('category/index'); ?>"><a href="<?php echo base_url(); ?>category"><i class="fa fa-angle-double-right"></i> <?php echo ('Enter Marks'); ?></a></li>

                            <?php }
        ?>
                            <?php
if ($this->rbac->hasPrivilege('student_houses', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('admin/schoolhouse'); ?>"><a href="<?php echo base_url(); ?>admin/schoolhouse"><i class="fa fa-angle-double-right"></i> <?php echo ('Print Marklist'); ?></a></li>
                                <?php
}

        if ($this->rbac->hasPrivilege('disable_reason', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('student/disable_reason'); ?>"><a href="<?php echo base_url(); ?>admin/disable_reason"><i class="fa fa-angle-double-right"></i> <?php echo ('Set Criteria'); ?></a></li>
                                <?php
}

        if ($this->rbac->hasPrivilege('disable_reason', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('student/disable_reason'); ?>"><a href="<?php echo base_url(); ?>admin/disable_reason"><i class="fa fa-angle-double-right"></i> <?php echo ('Prepare Ranklist'); ?></a></li>
                                <li class="<?php echo set_Submenu('entrance_allotment/Add_marks'); ?>"><a href="<?php echo site_url('entrance_allotment/Add_marks'); ?>"><i class="fa fa-angle-double-right"></i>Enter Marks</a></li>
                                
                                <?php
}
         
        ?>                              


                        </ul>
                    </li>
                    <?php
}
}


if ($this->module_lib->hasActive('fees_collection')) {
    if (($this->rbac->hasPrivilege('collect_fees', 'can_view') ||
        $this->rbac->hasPrivilege('search_fees_payment', 'can_view') ||
        $this->rbac->hasPrivilege('search_due_fees', 'can_view') ||
        $this->rbac->hasPrivilege('fees_statement', 'can_view') ||
        $this->rbac->hasPrivilege('fees_carry_forward', 'can_view') ||
        $this->rbac->hasPrivilege('fees_master', 'can_view') ||
        $this->rbac->hasPrivilege('fees_group', 'can_view') ||
        $this->rbac->hasPrivilege('fees_type', 'can_view') ||
        $this->rbac->hasPrivilege('fees_discount', 'can_view') ||
        $this->rbac->hasPrivilege('accountants', 'can_view'))) {
        ?>
                    <li class="treeview <?php echo set_Topmenu('Allotment'); ?>">
                        <a href="#">
                            <i class="fa fa-money ftlayer"></i> <span> <?php echo ('Allotment'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('collect_fees', 'can_view')) {?>
                                <li class="<?php echo set_Submenu('studentfee/index'); ?>"><a href="<?php echo base_url(); ?>studentfee"><i class="fa fa-angle-double-right"></i> <?php echo ('Allotment Setting'); ?></a></li>
                                <?php
}   
        if ($this->rbac->hasPrivilege('search_fees_payment', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('studentfee/searchpayment'); ?>"><a href="<?php echo base_url(); ?>studentfee/searchpayment"><i class="fa fa-angle-double-right"></i> <?php echo ('Quota Creation'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('search_due_fees', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('studentfee/feesearch'); ?>"><a href="<?php echo base_url(); ?>studentfee/feesearch"><i class="fa fa-angle-double-right"></i> <?php echo ('Merit'); ?> </a></li>
                                <?php
}

        if ($this->rbac->hasPrivilege('fees_master', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('admin/feemaster'); ?>"><a href="<?php echo base_url(); ?>admin/feemaster"><i class="fa fa-angle-double-right"></i> <?php echo
                                ('Management'); ?></a></li>
                                <?php
}

        ?>
                        </ul>
                    </li>
                    <?php
}
}

if ($this->module_lib->hasActive('income')) {
    if (($this->rbac->hasPrivilege('income', 'can_view') ||
        $this->rbac->hasPrivilege('search_income', 'can_view') ||
        $this->rbac->hasPrivilege('income_head', 'can_view'))) {
        ?>

                    <li class="treeview <?php echo set_Topmenu('Document'); ?>">
                        <a href="#">
                            <i class="fa fa-usd ftlayer"></i> <span><?php echo ('Document'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('income', 'can_view')) {?>
                                <li class="<?php echo set_Submenu('income/index'); ?>"><a href="<?php echo base_url(); ?>admin/income"><i class="fa fa-angle-double-right"></i><?php echo ('Upload Document'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('search_income', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('income/incomesearch'); ?>"><a href="<?php echo base_url(); ?>admin/income/incomesearch"><i class="fa fa-angle-double-right"></i><?php echo ('Verify Document'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('incomeshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/incomehead"><i class="fa fa-angle-double-right"></i><?php echo ('Download Document'); ?></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php
}
}

if ($this->module_lib->hasActive('expense')) {
    if (($this->rbac->hasPrivilege('expense', 'can_view') ||
        $this->rbac->hasPrivilege('search_expense', 'can_view') ||
        $this->rbac->hasPrivilege('expense_head', 'can_view'))) {
        ?>
                    <li class="treeview <?php echo set_Topmenu('Reports'); ?>">
                        <a href="#">
                            <i class="fa fa-credit-card ftlayer"></i> <span><?php echo ('Reports'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if ($this->rbac->hasPrivilege('expense', 'can_view')) {?>
                                <li class="<?php echo set_Submenu('expense/index'); ?>"><a href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-angle-double-right"></i> <?php echo ('Applicants Details'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('search_expense', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo ('Fee Payment Details'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('search_expense', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo ('Allotment'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('search_expense', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo ('Enter Marks'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('search_expense', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('expense/expensesearch'); ?>"><a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo ('Set Criteria'); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('expense_head', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('expenseshead/index'); ?>"><a href="<?php echo base_url(); ?>admin/expensehead"><i class="fa fa-angle-double-right"></i> <?php echo ('Ranklist'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
       }
    } 
    */
    
    
if ($this->module_lib->hasActive('income')) {
    if (($this->rbac->hasPrivilege('income', 'can_view') ||
        $this->rbac->hasPrivilege('search_income', 'can_view') ||
        $this->rbac->hasPrivilege('income_head', 'can_view'))) {
        ?>

                    <!--<li class="treeview <?php echo set_Topmenu('Other'); ?>">
                        <a href="#">
                            <i class="fa fa-book"></i> <span><?php echo ('Entrance Application'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                                <?php
                                
                 if ($this->rbac->hasPrivilege('search_income', 'can_view')) {
            ?>
            
            
                                <li class="<?php echo set_Submenu('entrance_allotment/examgroup'); ?>"><a href="<?php echo site_url('entrance_allotment/examgroup'); ?>"><i class="fa fa-angle-double-right"></i>Exam Group</a></li>
                                <?php
}                            
                                
        if ($this->rbac->hasPrivilege('search_income', 'can_view')) {
            ?>
            
            
            
            
            
                                <li class="<?php echo set_Submenu('EntranceExam/center'); ?>"><a href="<?php echo site_url('EntranceExam/center'); ?>"><i class="fa fa-angle-double-right"></i><?php echo (' Exam Center '); ?></a></li>
                                <?php
}
        if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('EntranceExam/institute'); ?>"><a href="<?php echo site_url('EntranceExam/institute'); ?>"><i class="fa fa-angle-double-right"></i><?php echo ('Exam Institute '); ?></a></li>
                            <?php }
                            
                            
         if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('EntranceExam/course'); ?>"><a href="<?php echo site_url('EntranceExam/course'); ?>"><i class="fa fa-angle-double-right"></i><?php echo (' Exam Course '); ?></a></li>
                            <?php }
                            
                            
                            
                            
                   if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
                                <li class="<?php echo set_Submenu('EntranceExam/examsearch'); ?>"><a href="<?php echo site_url('EntranceExam/examsearch'); ?>"><i class="fa fa-angle-double-right"></i><?php echo ('Applicant Details '); ?></a></li>
                            <?php }
                            
                            
                            
                            if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
                            ?>
                                <li class="<?php echo set_Submenu('EntranceExam/paymentdetails'); ?>"><a href="<?php echo site_url('EntranceExam/paymentdetails'); ?>"><i class="fa fa-angle-double-right"></i>Payment Details</a></li>
                                
                                 <li class="<?php echo set_Submenu('EntranceExam/paymentdetails'); ?>"><a href="<?php echo site_url('entrance_allotment/payment/checkpayment'); ?>"><i class="fa fa-angle-double-right"></i>Update Payment</a></li>
                            
                            
                            <?php } 
                            
                            
                             if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
                            ?>
                                <li class="<?php echo set_Submenu('EntranceExam/admitcard'); ?>"><a href="<?php echo site_url('EntranceExam/admitcard'); ?>"><i class="fa fa-angle-double-right"></i>Admit Card</a></li>
                            <?php } 
                            
                            if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
                            ?>
            
            <li class="<?php echo set_Submenu('entrance_allotment/Entrance_subjecttype/subjecttype'); ?>"><a href="<?php echo site_url('entrance_allotment/Entrance_subjecttype/subjecttype'); ?>"><i class="fa fa-angle-double-right"></i>Subject Type</a></li>
        <?php }   if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
            
            
            
            <li class="<?php echo set_Submenu('Entranceexam_subject/subject'); ?>"><a href="<?php echo site_url('entrance_allotment/Entranceexam_subject/subject'); ?>"><i class="fa fa-angle-double-right"></i>Subject</a></li>
        <?php }   if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
            
               <li class="<?php echo set_Submenu('entrance_allotment/Entranceexam_marks/marks'); ?>"><a href="<?php echo site_url('entrance_allotment/Entranceexam_marks/marks'); ?>"><i class="fa fa-angle-double-right"></i>Assign Marks</a></li>
        <?php }  if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
            
            <li class="<?php echo set_Submenu('entrance_allotment/Entrance_allotmenttype/allotmenttype'); ?>"><a href="<?php echo site_url('entrance_allotment/Entrance_allotmenttype/allotmenttype'); ?>"><i class="fa fa-angle-double-right"></i>Allotment Type</a></li>
            
             <li class="<?php echo set_Submenu('Entrance_allotmentseat/allotmentseat'); ?>"><a href="<?php echo site_url('entrance_allotment/Entrance_allotmentseat/allotmentseat'); ?>"><i class="fa fa-angle-double-right"></i><?php echo ('Seat '); ?></a></li>
            
        <?php 
            
        }   
        if ($this->rbac->hasPrivilege('admission_enquiry', 'can_view')) 
        {
            ?>
            
            <li class="<?php echo set_Submenu('entrance_allotment/attendance'); ?>"><a href="<?php echo site_url('entrance_allotment/attendance'); ?>"><i class="fa fa-angle-double-right"></i>Attendance</a></li>
            
            <li class="<?php echo set_Submenu('entrance_allotment/Add_marks'); ?>"><a href="<?php echo site_url('entrance_allotment/Add_marks'); ?>"><i class="fa fa-angle-double-right"></i>Enter Marks</a></li>
            
            <li class="<?php echo set_Submenu('entrance_allotment/Examresult'); ?>"><a href="<?php echo site_url('entrance_allotment/Examresult'); ?>"><i class="fa fa-angle-double-right"></i>Print Marklist</a></li>
            <li class="<?php echo set_Submenu('entrance_allotment/Seatquota'); ?>"><a href="<?php echo site_url('entrance_allotment/seatquota'); ?>"><i class="fa fa-angle-double-right"></i>Eligible </a></li>
            
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/setpriority'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/setpriority'); ?>"><i class="fa fa-angle-double-right"></i>Set Priority  </a></li>
            
            
            <li class="<?php echo set_Submenu('entrance_allotment/allotment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment'); ?>"><i class="fa fa-angle-double-right"></i>Allotment </a></li>
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/listallotment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/viewallotment'); ?>"><i class="fa fa-angle-double-right"></i>View Allotment </a></li>
            
            
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/enrolment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/forwardenroll'); ?>"><i class="fa fa-angle-double-right"> Forward To Enroll</i> </a></li>
            <li class="<?php echo set_Submenu('entrance_allotment/allotment/generate_allotment'); ?>"><a href="<?php echo site_url('entrance_allotment/allotment/generate_allotment'); ?>"><i class="fa fa-angle-double-right"></i>Generate Allotment </a></li>
            <li class="<?php echo set_Submenu('entrance_allotment/Entrancesettings'); ?>"><a href="<?php echo site_url('entrance_allotment/Entrancesettings'); ?>"><i class="fa fa-angle-double-right"></i>Entrance Settings </a></li>
            
        <?php }  if ($this->rbac->hasPrivilege('income_head', 'can_view')) {
            ?>
            
           
        <?php }
                            
             ?>
             </ul>
             </li>-->
 <?php
}
}

    ?>

        </ul>
        
        
        
        
        
        
        
        
    </section>
</aside>