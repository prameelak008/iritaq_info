
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/topbar_style.css">
                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">  
                
                <div class="row">
                <div class="col-md-12">
                <div class="box box-primary border0 mb0 margesection">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i>  <?php echo $this->lang->line('student_nexus') ; ?></h3>
                </div>
                <div class="">
                <br>

                    <ul class="reportlists">
                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'homework' ) ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>student_nexus/homework/">
                    <i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('homework'); ?>
                    </a>
                    </li>

               

                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'library' && $this->uri->segment(3) == '') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>student_nexus/library">
                    <i class="fa fa-book"></i> <?php echo $this->lang->line('library'); ?>
                    </a>
                    </li>

                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'issue_return' || $this->uri->segment(3) == 'issue' ) ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>student_nexus/library/issue_return">
                    <i class="fa fa-exchange"></i> <?php echo $this->lang->line('issue_return'); ?>
                    </a>
                    </li>

                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'generateidcard') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>student_nexus/generateidcard/search">
                    <i class="fa fa-id-card"></i> <?php echo $this->lang->line('card'); ?>
                    </a>
                    </li>
                    

                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(2) == 'generatecertificate') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>student_nexus/generatecertificate/">
                    <i class="fa fa-certificate"></i> <?php echo $this->lang->line('certificate'); ?>
                    </a>
                    </li>



                    <li class="col-lg-3 col-md-3 col-sm-6 <?php echo ($this->uri->segment(3) == 'alumni') ? 'active' : ''; ?>">
                     <a href="<?php echo base_url(); ?>student_nexus/student_nexus/alumni">
                    <i class="fa fa-graduation-cap"></i> <?php echo $this->lang->line('alumni'); ?>
                    </a>
                    </li>                
                    
                    </ul>


                    </div>
                    </div> 
                    </div>
                    </div>