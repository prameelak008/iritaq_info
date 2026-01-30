            <style type="text/css">
            .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 22px !important; border-radius: 0 !important; padding-left: 0 !important;}
            .input-group-addon .glyphicon{font-size: 12px;}

            .show{
            display : block;
            z-index: 100;
            background-image : url('../../backend/images/timeloader.gif');
            opacity : 0.6;
            background-repeat : no-repeat;
            background-position : center;
            }
            /* .tab-pane{min-height: 200px;}*/
            .commentForm .input-group {position: relative;display: block;border-collapse: separate;}
            .commentForm .input-group-addon{
            position: absolute;
            right: 26px;
            top: 0px;
            z-index: 3;
            }
            .relative{position: relative;}
            .commentForm .input-group-addon i,
            .commentForm .input-group-addon span{padding-left: 13px;}
            .commentForm .relative label.text-danger{position: absolute; bottom: 5px;}
            .addbtnright{ position: absolute;right: 0;top: -46px;}

            @media(max-width:767px){
            .timeresponsive{overflow-x: auto;     overflow-y: hidden;}
            .timeresponsive .dropdown-menu{z-index: 1060;    bottom: 0 !important; height: 250px; padding: 20px;}
            .tablewidthRS{width: 690px;}
            }
            </style>
            <script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>

            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
            </section>
            <!-- Main content -->
            <section class="content">



             <div class="col-md-12">
                    <?php
                    $this->load->view('layout/topbar_activities'); ?>
                    </div>
                    &nbsp;
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
            <div class="box-tools pull-right">
            </div>
            </div>


            <form action="<?php echo site_url('semester_activities/semester_attendance') ?>" method="post" accept-charset="utf-8">

            <div class="box-body">
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="row">


            <div class="col-md-2">
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label> 

            <select name="program_type" id="program_type" class="form-control" >
            <option value=""><?php echo $this->lang->line('type'); ?></option>

            <?php
            foreach($Programmetype_list as $prog_type)
            {
            ?>
            <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
            <?php 
            }
            ?>
            </select>
            <!-- <span class="text-danger"><?php echo form_error('programee_type'); ?></span> -->
            </div>
            </div>




            <div class="col-md-2">
            <div class="form-group">
            <label><?php echo $this->lang->line('programme'); ?><small class="req"> *</small></label>
            <select name="programe" id="programe" class="form-control">
            <option></option>
            </select>
            <span class="text-danger"><?php echo form_error('programme'); ?></span>
            </div>
            </div>


            <div class="col-md-2">
            <div class="form-group">
            <label><?php echo $this->lang->line('batch'); ?><small class="req"> *</small></label>

            <select name="batch_group" id="batch_group" class="form-control" >
            <option value="">Select Batch</option>

            <?php
            foreach($batch_group as $batch)
            {
            ?>
            <option value="<?php echo  $batch['batch_group_id']; ?>"<?php if(set_value('batch_group')==$batch['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $batch['batch_group_name'].'&nbsp;&nbsp;'.$batch['batch_group_year']; ?> </option>
            <?php 
            }
            ?>
            </select> 
            <span class="text-danger"><?php echo form_error('batch'); ?></span>
            </div>
            </div>

          
       


            <div class="col-md-2">
            <div class="form-group">
            <label><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>

            <select name="semester_semtype" id="semester_semtype" class="form-control" >
            <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
            <?php
            foreach($semestertype_list as $sem_type)
            {
            ?>
            <option value="<?php  echo $sem_type['st_id'];  ?>"

            <?php
            if(set_value('semester_semtype')==$sem_type['st_id'])
            {
            echo "selected=selected";
            }
            ?>
            ><?php  echo $sem_type['st_name'];  ?></option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('semester'); ?></span>
            </div>
            </div>



            <div class="col-md-2">
            <div class="form-group">
            <label><?php echo $this->lang->line('subject'); ?><small class="req"> *</small></label>        
            <select name="subject" id="subject" class="form-control" >
            <option><option>
            </select>
            <span class="text-danger"><?php echo form_error('subject'); ?></span>
            </div>
            </div>


            <div class="col-md-2">
            <div class="form-group">
            <label><?php echo $this->lang->line('paper'); ?><small class="req"> *</small></label>        
            <select name="paper" id="paper" class="form-control" >
            <option><option>
            </select>
            <span class="text-danger"><?php echo form_error('paper'); ?></span>
            </div>
            </div>       


            </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right btn-sm"><?php echo $this->lang->line('search'); ?></button>
            </div>
            </form>


            <br>
            <br>
            &nbsp;&nbsp;&nbsp;
            <button  class="btn-primary"><i class="fa fa-check"></i>Mark as Holiday</button>&nbsp;&nbsp;
            <button  class="btn-primary"><i class="fa fa-check"></i>Monthly Leave</button>&nbsp;&nbsp;
            <button  class="btn-primary"><i class="fa fa-check"></i>Class Leave</button>&nbsp;&nbsp;
            <button  class="btn-primary"><i class="fa fa-check"></i>Special Leave</button>&nbsp;&nbsp;
            <br>
            <br>

            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example">

            <tr>
            <th>sl.no</th>
            <th>instituion id</th>
            <th>Registration Id</th>
            <th>Name</th>
            <th>Attendance</th>            
            <th>Note</th>
            </tr>

            <tr>
            <th>1</th>
            <th>INST123</th>
            <th>RREG-123</th>
            <th>Student Name</th>
            <th>
            <input type="radio" name="option" value="1">Present  
            <input type="radio" name="option" value="2"> Absent
            <input type="radio" name="option" value="3">Class Leave
            </th>            
            <th>Note</th>
            </tr>


            </table>
            </div>




            <?php
            if (isset($getDaysnameList)) {
            ?>
            <div class="box-header ptbnull">
            <div class="col-md-12 column">
            <a class="btn btn-success btn-sm pull-left" href="<?php  echo site_url('admin/timetable/create_TimetableCreate'); ?>"><i class="fa fa-plus"></i>Add Entry</a>
            </div>

            </div>
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="myTabs">
            <?php
            $count = 1;

            foreach ($getDaysnameList as $days_key => $days_value) {
            $cls = "";
            if ($count == 1) {
            }
            ?>
            <li <?php echo $cls; ?>><a href="#tab_<?php echo $count; ?>" data-c="<?php echo set_value('class_id'); ?>" data-days="<?php echo $days_value; ?>" data-s="<?php echo set_value('section_id'); ?>" data-group="<?php echo set_value('subject_group_id'); ?>" data-day="<?php echo $days_key; ?>" data-toggle="tab" aria-expanded="true"><?php echo $days_value; ?></a></li>

            <?php
            $count++;
            }
            ?>
            </ul>
            <div class="tab-content">
            <?php
            $count = 1;
            foreach ($getDaysnameList as $days_key => $days_value) {
            $cls = "class='tab-pane'";
            if ($count == 1) 
            {
            }
            ?>
            <div <?php echo $cls; ?> id="tab_<?php echo $count; ?>">
            </div>
            <?php
            $count++;
            }
            ?>
            </div>
            </div>
            </div>
            <?php
            }
            ?>
            </section>
            </div>


            <script>
            $(document).ready(function() 
            {

            $('#programe, #batch_group, #semester_semtype').change(function() 
            {
            var prog = $('#programe').val();
            var bat  = $('#batch_group').val();
            var sem  = $('#semester_semtype').val();      

            if( prog && bat && sem) {
            $.ajax({
            url    : '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
            type   : 'POST',
            data   : { 
            prog   : prog,
            bat    : bat,
            sem    : sem
            },
            success: function(response) 
            {
            var res = JSON.parse(response);  // Convert string to object                    
            $('.sem_group_id').val(res.sem_group_id); 
            }
            });
            }
            });
            });




            var old_program_type  = "<?php echo set_value('program_type'); ?>";
            var old_programe      = "<?php echo set_value('programe'); ?>";


            $(document).ready(function()
            {
            function loadProgrames(prog_type_id, selected_programe = '') 
            {
            if(prog_type_id != '') {
            $.ajax({
            url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
            method: "POST",
            data: { prog_type_id: prog_type_id },
            dataType: "json",
            success: function(data) { 
            $('#programe').empty();
            $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            $.each(data, function(key, value) { 
            var selected = (value.id == selected_programe) ? 'selected' : '';
            $('#programe').append('<option value="'+ value.id +'" '+selected+'>'+ value.p_name +'</option>');
            });
            }
            });
            } else {
            $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            }
            }

            // On page load: populate programe if old_program_type exists
            if(old_program_type != '') {
            $('#program_type').val(old_program_type);
            loadProgrames(old_program_type, old_programe);
            }
            // On change: load programe dynamically
            $('#program_type').change(function() {
            var prog_type_id = $(this).val();
            loadProgrames(prog_type_id);
            });
            });
            </script>