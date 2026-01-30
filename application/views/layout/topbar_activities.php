
  <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/topbar_style.css">
                <div class="row">
                <div class="col-md-12">
                <div class="box box-primary border0 mb0 margesection">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('academics').'&nbsp;'.$this->lang->line('operations') ; ?></h3>

                </div>
                <div class="">
                <br>

                <ul class="reportlists">
                <li class="col-lg-3 col-md-3 col-sm-6  <?php echo ($this->uri->segment(2) == 'semester_classteacher') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_activities/semester_classteacher/index"><i class="fa fa-user-plus"></i> <?php echo $this->lang->line('assign_class_teacher'); ?></a></li>
                
                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'teacher_subject_assignments') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_activities/teacher_subject_assignments/index"><i class="fa fa-tasks"></i><?php echo $this->lang->line('subject').''.$this->lang->line('assignments'); ?> </a></li> 
                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'set_timetable') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_activities/semester_timetable/set_timetable"><i class="fa fa-hourglass-end"></i><?php echo $this->lang->line('timetable'); ?></a></li>  

                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'semester_substitute') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_activities/semester_substitute/index"><i class="fa fa-minus"></i> <?php echo $this->lang->line('substitute'); ?></a></li>
                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'semester_attendance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_activities/semester_attendance/index"><i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('attendance'); ?></a></li> 
                

                <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'semester_sub_attendance') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester_activities/Semester_period_attendance/index"><i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('period').'&nbsp;'.$this->lang->line('attendance'); ?></a></li>  


                </ul>
                </div>
                </div> 
                </div>
                </div>