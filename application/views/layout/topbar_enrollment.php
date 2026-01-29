
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/topbar_style.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">  
                
                <div class="row">
                <div class="col-md-12">
                <div class="box box-primary border0 mb0 margesection">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('semester').'&nbsp;'.$this->lang->line('enrollment') ; ?></h3>

                </div>
                <div class="">
                <br>

                <ul class="reportlists">
                <!-- <li class="col-lg-3 col-md-3 col-sm-6  <?php echo ($this->uri->segment(2) == 'Enroll') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_enrollment/Enroll/forward_to_enrol"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('candidate_enroll'); ?></a></li>                
                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'search') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_enrollment/Enroll/search"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('student_information'); ?> </a></li>  
                
                 <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'student_information') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_enrollment/Enroll/create"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('admission'); ?> </a></li>

                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Promote') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_enrollment/Promote/"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('promote_students'); ?> </a></li>  -->
                



                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Enroll' && $this->uri->segment(3) == 'forward_to_enrol') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>semester_enrollment/Enroll/forward_to_enrol">
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('candidate_enroll'); ?>
                    </a>
                    </li>


                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Enroll' && $this->uri->segment(3) == 'search') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>semester_enrollment/Enroll/search">
                    <i class="fa fa-id-card"></i> <?php echo $this->lang->line('student_information'); ?>
                    </a>
                    </li>

                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'create') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>semester_enrollment/Enroll/create">
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('admission'); ?>
                    </a>
                    </li>

                    

                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Promote') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>semester_enrollment/Promote/">
                    <i class="fa fa-level-up"></i> <?php echo $this->lang->line('promote_students'); ?>
                    </a>
                    </li>


                
                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'bulk_delete') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_enrollment/Enroll/bulk_delete/"><i class="fa fa-trash"></i><?php echo $this->lang->line('bulk_delete'); ?> </a></li> 
                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'disablestudentslist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_enrollment/Enroll/disablestudentslist/"><i class="fa fa-ban"></i><?php echo $this->lang->line('disabled_students'); ?> </a></li>  
                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'transfer_certificate') ? 'active' : ''; ?>"><a href=" <?php echo base_url(); ?>semester_enrollment/Enroll/transfer_certificate/"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('transfer_certificate'); ?></a></li> 
                    
                    </ul>
                    </div>
                    </div> 
                    </div>
                    </div>