        
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/topbar_style.css">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-primary border0 mb0 margesection">
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('academics').'&nbsp;'.$this->lang->line('programme') ; ?></h3>

        </div>
        <div class="">
        <br>             

        
        <ul class="reportlists">
                
        <!-- <li class="col-lg-3 col-md-3 col-sm-6  <?php echo ($this->uri->segment(2) == 'faculty') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/faculty"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('faculty'); ?></a></li>
        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'programmetype') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/programmetype/index"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('programee').'&nbsp;'.$this->lang->line('type'); ?></a></li> 
        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'programee') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/programee/index"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('programee'); ?></a></li>    
        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'batchtype') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/batchtype/index"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('batch').'&nbsp;'.$this->lang->line('type'); ?></a></li>    
        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'semestertype') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/semestertype/index"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('semester').'&nbsp;&nbsp;'.$this->lang->line('type'); ?></a></li>    
        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Semester_Subjectgroups') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/Semester_Subjectgroups"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?></a></li>    
        <li class="col-lg-3 col-md-3 col-sm-6  <?php echo ($this->uri->segment(2) == 'Semester_Subjectpaper') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/Semester_Subjectpaper"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('paper'); ?></a></li>  
        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Assignsubjects') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/Assignsubjects/index"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('assign_subject'); ?></a></li> 
      
      
      
-->



        <!-- <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'faculty') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/faculty'); ?>"><i class="fa fa-institution"></i> 
        <?php echo $this->lang->line('faculty'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'programmetype') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/programmetype/index'); ?>"><i class="fa fa-cubes"></i>
        <?php echo $this->lang->line('programme').' '.$this->lang->line('type'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'programee') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/programee/index'); ?>"><i class="fa fa-book"></i> 
        <?php echo $this->lang->line('programme'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'batchtype') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/batchtype/index'); ?>"><i class="fa fa-users"></i>
        <?php echo $this->lang->line('batch').' '.$this->lang->line('type'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'semestertype') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/semestertype/index'); ?>"><i class="fa fa-calendar"></i>
        <?php echo $this->lang->line('semester').' '.$this->lang->line('type'); ?>
        </a>
        </li>
        


        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Setduration') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Setduration/index'); ?>"><i class="fa fa-clock-o"></i>
        <?php echo $this->lang->line('setduration'); ?>
        </a>
        </li>




        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Semester_Subjectgroups') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Semester_Subjectgroups'); ?>"><i class="fa fa-object-group"></i>
        <?php echo $this->lang->line('subject').' '.$this->lang->line('group'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Semester_Subjectpaper') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Semester_Subjectpaper'); ?>"><i class="fa fa-file-text"></i>
        <?php echo $this->lang->line('subject').' '.$this->lang->line('paper'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Assignsubjects' || $this->uri->segment(2) == 'assignsubjects') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Assignsubjects/index'); ?>"><i class="fa fa-tasks"></i>
        <?php echo $this->lang->line('assign_subject'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'assignprogramme') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/assignprogramme/index'); ?>"><i class="fa fa-calendar-check-o"></i>
        <?php echo $this->lang->line('assignprogramme'); ?>
        </a>
        </li>

      

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'set_room_allocation') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/set_room_allocation/index'); ?>"><i class="fa fa-building"></i>
        <?php echo $this->lang->line('set').' '.$this->lang->line('classroom'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'set_seatingarrangement') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>semester/set_seatingarrangement/"><i class="fa fa-file-text-o"></i> <?php echo $this->lang->line('seat').''.$this->lang->line('arrangement'); ?></a></li>  -->



        <style>
        li a i.fa {
        display: inline-block;
        width: 20px;
        text-align: center;
        margin-right: 5px;
        }
        </style>



        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'faculty') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/faculty'); ?>">
        <i class="fa fa-institution"></i>&nbsp;<?php echo $this->lang->line('faculty'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'programmetype') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/programmetype/index'); ?>">
        <i class="fa fa-cubes"></i>&nbsp;<?php echo $this->lang->line('programme').' '.$this->lang->line('type'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'programee') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/programee/index'); ?>">
        <i class="fa fa-book"></i>&nbsp;<?php echo $this->lang->line('programme'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'batchtype') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/batchtype/index'); ?>">
        <i class="fa fa-users"></i>&nbsp;<?php echo $this->lang->line('batch').' '.$this->lang->line('type'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'semestertype') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/semestertype/index'); ?>">
        <i class="fa fa-calendar"></i>&nbsp;<?php echo $this->lang->line('semester').' '.$this->lang->line('type'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Setduration') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Setduration/index'); ?>">
        <i class="fa fa-clock-o"></i>&nbsp;<?php echo $this->lang->line('setduration'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Semester_Subjectgroups') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Semester_Subjectgroups'); ?>">
        <i class="fa fa-object-group"></i>&nbsp;<?php echo $this->lang->line('subject').' '.$this->lang->line('group'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Semester_Subjectpaper') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Semester_Subjectpaper'); ?>">
        <i class="fa fa-file-text"></i>&nbsp;<?php echo $this->lang->line('subject').' '.$this->lang->line('paper'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'Assignsubjects' || $this->uri->segment(2) == 'assignsubjects') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/Assignsubjects/index'); ?>">
        <i class="fa fa-tasks"></i>&nbsp;<?php echo $this->lang->line('assign_subject'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'assignprogramme') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/assignprogramme/index'); ?>">
        <i class="fa fa-calendar-check-o"></i>&nbsp;<?php echo $this->lang->line('assignprogramme'); ?>
        </a>
        </li>

        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'set_room_allocation') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/set_room_allocation/index'); ?>">
        <i class="fa fa-building"></i>&nbsp;<?php echo $this->lang->line('set').' '.$this->lang->line('classroom'); ?>
        </a>
        </li>

        <!-- <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'set_seatingarrangement') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/set_seatingarrangement/'); ?>">
        <i class="fa fa-file-text-o"></i>&nbsp;<?php echo $this->lang->line('seat').' '.$this->lang->line('arrangement'); ?>
        </a>
        </li> -->




        <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'multi_seating') ? 'active' : ''; ?>">
        <a href="<?php echo base_url('semester/multi_seating/'); ?>">
        <i class="fa fa-file-text-o"></i>&nbsp;<?php echo $this->lang->line('multiple').' '.$this->lang->line('seat').' '.$this->lang->line('arrangement'); ?>
        </a>
        </li>


        </ul>
        </div>
        </div> 
        </div>
        </div>