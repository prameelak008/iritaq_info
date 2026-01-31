
            
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/topbar_style.css">        
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary border0 mb0 margesection">
            <div class="box-header with-border">
            <h3 class="box-title">
            <i class="fa fa-search"></i>
         

            <?php echo $this->lang->line('semester').'&nbsp;'.$this->lang->line('exam'); ?>
            </h3>
            </div>

            <div class="">
                
            <ul class="reportlists">

            <li class=" <?php echo ($this->uri->segment(2) == 'examgroup') ? 'active' : ''; ?>">
            <a href="<?php echo base_url(); ?>semester_exam/examgroup">
            <i class="fa fa-file-text-o"></i>
            <span><?php echo $this->lang->line('exam') . " " . $this->lang->line('group') ?></span>
            </a>
            </li>

            <li class=" <?php echo ($this->uri->segment(2) == 'exam_instruction') ? 'active' : ''; ?>">
            <a href="<?php echo base_url(); ?>semester_exam/exam_instruction">
            <i class="fa fa-file-text-o"></i>
            <span> Instructions & Payment</span>
            </a>
            </li>

             <li class=" <?php echo ($this->uri->segment(2) == 'exam_attempt') ? 'active' : ''; ?>">
            <a href="<?php echo base_url(); ?>semester_exam/exam_attempt">
            <i class="fa fa-hourglass"></i>
            <span><?php echo $this->lang->line('exam').'&nbsp;'. $this->lang->line('attempt'); ?></span>
            </a>
            </li>

            <li class=" <?php echo ($this->uri->segment(2) == 'examresult') ? 'active' : ''; ?>">
            <a href="<?php echo base_url(); ?>semester_exam/examresult/admitcard">
            <i class="fa fa-id-card-o"></i>
            <span><?php echo $this->lang->line('print') . " " . $this->lang->line('admit') . " " . $this->lang->line('card'); ?></span>
            </a>
            </li>


            <li class=" <?php echo ($this->uri->segment(2) == 'online_examination_instruction') ? 'active' : ''; ?>">
            <a href="<?php echo base_url(); ?>semester_exam/examresult/marksheet">
            <i class="fa fa-certificate"></i>
            <span><?php echo $this->lang->line('print') . " " . $this->lang->line('marksheet'); ?></span>
            </a>
            </li>



           


            <li class=" <?php echo ($this->uri->segment(2) == 'online_examination_instruction') ? 'active' : ''; ?>">
            <a href="<?php echo base_url(); ?>admin/onlineexam_list">
            <i class="fa fa-certificate"></i>
            <span><?php echo $this->lang->line('onlineExamination') ?></span>
            </a>
            </li>  
            </ul>

            
            </div>
            </div>
            </div>
            </div>




          


        





