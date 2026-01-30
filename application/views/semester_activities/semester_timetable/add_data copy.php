
<<<<<<< HEAD
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
=======
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956


            <style type="text/css"> 

<<<<<<< HEAD
       
=======
            /* Modern Tab Styles */
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            .nav-tabs {              
            padding: 0;
            margin: 0 0 30px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            border-bottom: none;
            }

            .nav-tabs li {
            list-style: none;
            margin-bottom: 0;
            }

            .nav-tabs li a {
            display: block;
            padding: 12px 24px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid #e0e0e0;
            background: #ffffff;
            border-radius: 8px;
            position: relative;
            transition: all 0.3s ease;
            }

            .nav-tabs li a:hover {
            color: white;
            border-color: #6b7275;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
            }

            .nav-tabs li.active a {
            color: white;
<<<<<<< HEAD
         
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #6b7275 0%, #6b7275 100%); 
=======
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #6b7275 0%, #6b7275 100%); */
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            }



            @media (max-width: 768px) {
            .nav-tabs {
            gap: 5px;
            }
            .nav-tabs li a {
            padding: 10px 16px;
            font-size: 13px;
            }
            }

            @media (max-width: 480px) {
            .nav-tabs {
            flex-direction: column;
            }
            .nav-tabs li {
            width: 100%;
            }
            .nav-tabs li a {
            text-align: center;
            }
            }
<<<<<<< HEAD







            

           
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
            </div>

            <?php
            $subjectOptions = "";
            foreach ($subjectpapers as $paper) {
            $subjectOptions .= '<option value="'.$paper["subjectpaper_id"].'">'.$paper["subjectpaper_papername"].'</option>';
            }

            $staffOptions = "";
            foreach ($teaching_staff as $staff) {
            $staffOptions .= '<option value="'.$staff["id"].'">'.$staff["name"].'</option>';
            }

            // $periodOptions = "";
            // foreach ($period as $per) {
            // $periodOptions .= '<option value="'.$per["periodic_table_id"].'">'.$per["periodic_table_name"].'</option>';
            // }
            ?>



            <form role="form" action="<?php echo site_url('semester_activities/semester_timetable/set_timetable') ?>" method="post" class="class_search_form">
            <div class="promotion-grid">
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

            <div class="row">
            <div class="col-md-12">
            <div class="row">

            <?php echo $this->customlib->getCSRF(); ?>

            <div class="col-md-6">
            <div class="form-group">
            <label>Program Type / Program <small class="req">*</small></label>      

            <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
            <span class="text-danger"><?php echo form_error('program'); ?></span>
            </div>
            </div> 

            <div class="col-md-6">
            <div class="form-group">
            <label>Semester / Batch / Term <small class="req">*</small></label>
            <?php
            echo render_semester_dropdown($semesters_batches, set_value('semester'));
            ?>

            </div>
            </div>

            </div>
            </div>
            <!--./col-md-6-->

            <?php echo render_subject_dropdown_block(); ?>


            <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
            <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('search'); ?>
            </button>
            </div>
            </div>

            </div>
            </div><!--./col-md-6-->
            </div>          
            </form> 
            </div>    
            
            
            


            <form action="<?php echo site_url('semester_activities/semester_timetable/savetimetable') ?>" method="post" accept-charset="utf-8"> 
            <input type="hidden" name="prg" value="<?php  echo $selected_program; ?>" class="form-control">
            <input type="hidden" name="sem" value="<?php  echo $selected_semester_type; ?>" class="form-control">
            <input type="hidden" name="sem_term" value="<?php  echo $selected_term; ?>" class="form-control">
            <input type="hidden" name="bat" value="<?php  echo $selected_batch; ?>" class="form-control">
            <input type="hidden" name="sub_grp" value="<?php  echo $subject_group; ?>" class="form-control">

            <ul class="nav nav-tabs" id="myTabs">
            <?php
            $count = 1;
            foreach ($getDaysnameList as $days_key => $days_value) {
            $active = ($count == 1) ? "active" : "";
            ?>
            <li class="<?php echo $active; ?>">
            <a href="#tab_<?php echo $count; ?>" data-day="<?php echo $days_key; ?>" data-toggle="tab">
            <?php echo $days_key; ?>
            </a>
            </li>
            <?php
            $count++;
            }
            ?>
            </ul>

            <br>

            <div class="tab-content">
            <?php
            $count = 1;
            foreach ($getDaysnameList as $days_key => $days_value) {
            $active = ($count == 1) ? "active in" : "";
            ?>
            <div class="tab-pane fade <?php echo $active; ?>" id="tab_<?php echo $count; ?>">
            <button type="button" class="btn btn-sm btn-primary add_row pull-right" data-day="<?php echo $days_key; ?>">+ Add Row</button>          
            <br><br>
            <br><br>

            <div class="table-responsive mailbox-messages">
            <table class="table table-bordered ">
            <thead>
            <tr>
            <th>Sl. No</th>
            <th>Subject Paper</th>
            <th>Subject</th>

            <th>Staff</th>
            <th>Period</th>
            <th>Time From</th>
            <th>Time To</th>
            <th>Room No</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Rows will be appended here -->
            </tbody>
            </table>
            </div>
            </div>
            <?php
            $count++;
            }
            ?>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-success pull-right"><?php echo $this->lang->line('submit'); ?></button>
            <br>
            <br>
            </form>
            </section>          
            </div>  
            </div>
            </div>

            <?php     
            $subjectOptions = "";
            foreach ($subjectpapers as $paper) {
            $subjectOptions .= '<option value="'.$paper["sem_paper_id"].'">'.$paper["sem_paper_paper"].'</option>';
            }              

            $staffOptions = "";
            foreach ($teaching_staff as $staff) {
            $staffOptions .= '<option value="'.$staff["id"].'">'.$staff["name"].'</option>';
            }

            // $periodOptions = "";
            // foreach ($period as $per) {
            // $periodOptions .= '<option value="'.$per["periodic_table_id"].'">'.$per["periodic_table_name"].'</option>';
            // }



            $periodOptions = "";
            foreach ($period as $per) {
            $periodOptions .= '<option value="'.$per["periodic_table_id"].'" 
            data-from="'.$per["periodic_table_timefrom"].'" 
            data-to="'.$per["periodic_table_timeto"].'">
            '.$per["periodic_table_name"].'
            </option>';
            }

            ?>        



            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


            <script>



                function getperiod_id(selectElement)
                {
                let $select = $(selectElement);
                let $row = $select.closest('tr');

                console.log($select);
                console.log($row);

                let timeFrom = $select.find('option:selected').data('from');
                let timeTo   = $select.find('option:selected').data('to');

                // Display time in inputs
                $row.find('input[name*="time_from"]').val(timeFrom || '');
                $row.find('input[name*="time_to"]').val(timeTo || '');
                }



            $(document).ready(function() 
            {
            var isLoadingDay = false;  // To solve the double-entry issues

            $(document).on("click", "#myTabs a", function(e) {
            e.preventDefault();              


            if (isLoadingDay) return; // exit if already loading


            isLoadingDay  = true; // set flag
            var $this     = $(this);

            var day       = $(this).data("day");
            var $tabPane  = $($(this).attr("href"));
            var $tbody    = $tabPane.find("tbody");
            // var $tbody   = $tabPane.find("table tbody");

            // Clear previous rows immediately

            $tbody.empty(); 


            // Fetch timetable for the selected day
            $.ajax({
            url: "<?php echo site_url('semester_activities/semester_timetable/get_day_records'); ?>",
            type: "POST",
            data: {
            day: day,
            program: $("input[name='prg']").val(),
            semester: $("input[name='sem']").val(),
            sem_term: $("input[name='sem_term']").val(),
            bat: $("input[name='bat']").val(),
            sub_grp: $("input[name='sub_grp']").val()
            },

            success: function(response) {                   
            try {
            var data = JSON.parse(response);        

            if (data.length > 0) {
            $.each(data, function(index, row) {
            var newRow = `
            <tr>
            <td>
            <input type="text" name="slno[${day}][]" class="form-control" value="${index + 1}" readonly>
            <input type="hidden" name="sem_group_id[${day}][]" value="${row.tb_id}">
            <input type="hidden" name="dayy[]" value="${day}">
            </td>

            

            <td>
            <select class="form-control subjectpaper" name="subjectpaper[${day}][]">
            <?php echo $subjectOptions; ?>
            </select>
            </td>


            <td>
            <select class="form-control subject" name="subject[${day}][]">
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            </td>
            <td>
            <select class="form-control staff_id" name="staff_id[${day}][]">
            <?php echo $staffOptions; ?>
            </select>
            </td>        



            <td>
            <select class="form-control period" onchange="getperiod_id(this)" name="period[${day}][]">          
            <?php echo $periodOptions; ?>
            </select>
            </td>



            <td><input type="text" name="time_from[${day}][]" class="form-control" readonly></td>
            <td><input type="text" name="time_to[${day}][]" class="form-control" readonly></td>


            <td><input type="text" name="room_no[${day}][]" class="form-control" value="${row.tb_room_no}"></td>
            <td><button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
            </tr>`;


            $tbody.append(newRow);
            // preselect saved values for this appended row
            var $last = $tbody.find('tr').last();
            $last.find('select.subjectpaper').val(row.tb_subjectpaper);
            $last.find('select.staff_id').val(row.tb_staff_id);
            $last.find('select.period').val(row.tb_period_id);
            // auto-fill subject from selected paper
            $last.find('select.subjectpaper').trigger('change');
            });
            } else {
            $tbody.html("<tr><td colspan='8' class='text-center text-muted'>No records found for this day</td></tr>");
            }
            } catch (e) {
            console.error("Invalid JSON:", response);
            }
            },
            error: function(xhr, status, error) {
            console.error("AJAX error:", error);
            },

            complete: function() {
            isLoadingDay = false; // reset flag after AJAX completes
            }

            });
            });



            $(document).on("click", ".add_row", function () 
            {

            var $tabPane = $(this).closest(".tab-pane");
            var $tbody   = $tabPane.find("table tbody");
            var rowcount = $tbody.find("tr").length + 1;
            var day      = $(this).data("day");                  

            var newRow = `
            <tr>
            <td>
            <input type="text" name="slno[${day}][]" class="form-control" value="${rowcount}" readonly> 

            <input type="hidden" name="sem_group_id[${day}][]" class="sem_group_id" class="form-control">
            <input type="hidden" name="dayy[]" value="${day}">
            </td>

           <td>
            <select class="form-control subject" name="subject[${day}][]">
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            </td>
 

            <td>
            <select class="form-control subjectpaper" name="subjectpaper[${day}][]">
            <?php echo $subjectOptions; ?>
            </select>
            </td>

            <td>
            <select class="form-control staff_id" onchange="getstaff(${rowcount})" name="staff_id[${day}][]">
            <?php echo $staffOptions; ?>
            </select>
            </td>



            <td>
            <select class="form-control period" onchange="getperiod_id(this)" name="period[${day}][]">          
            <?php echo $periodOptions; ?>
            </select>
            </td>



            <td><input type="text" name="time_from[${day}][]" class="form-control" readonly></td>
            <td><input type="text" name="time_to[${day}][]" class="form-control" readonly></td>

            <td><input type="text" name="room_no[${day}][]" class="form-control"></td>
            <td>


            <button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </td>
            </tr>
            `;

            $tbody.append(newRow);
            // ensure subject reflects paper immediately if user picks paper
            // (handled globally by change listener below)
            });

            // Delete row functionality
            $(document).on("click", ".ibtnDel", function () {
            $(this).closest("tr").remove();
            });

            // Before submitting form, make sure all hidden tabs' inputs are included
            $("#scheduleForm").on("submit", function() {
            $(".tab-pane").removeClass("fade").addClass("active in").show();
            });
            }); 

            // When subject paper changes, fetch its subject and set the Subject select in the same row
            $(document).on('change', 'select.subjectpaper', function() {
            var $row = $(this).closest('tr');
            var paper_id = $(this).val();
            var $subjectSelect = $row.find('select.subject');

            if (!paper_id) {
            $subjectSelect.html('<option value=""><?php echo $this->lang->line('select'); ?></option>');
            return;
            }

            $.ajax({
            url: '<?php echo site_url('semester_activities/semester_timetable/get_subject_by_paper'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { paper_id: paper_id },
            success: function(res) {
            var opts = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            if (res && res.id) {
            opts += '<option value="'+res.id+'" selected>'+res.name+'</option>';
            }
            $subjectSelect.html(opts);
            }
            });
            });

            var old_program_type  = "<?php echo set_value('program_type'); ?>";
            var old_programe      = "<?php echo set_value('programe'); ?>";

            $(document).ready(function()
            {
            function loadProgrames(prog_type_id, selected_programe = '') {
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




            $(document).ready(function()
            {
            $('#subject_groups').change(function() 
            {
            var group_id = $(this).val(); 
            if(group_id != '')
            {
            $.ajax({
            url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_subjects'); ?>",
            method: "POST",
            data: {group_id: group_id},
            dataType: "json",
            success: function(data)
            {                  
            $('#subjects').empty();
            $('#subjects').append('<option value="">Select Subject</option>');
            $.each(data, function(key, value) {
            $('#subjects').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            });
            }
            });
            } else {
            $('#subjects').empty();
            $('#subjects').append('<option value="">Select Subject</option>');
            }
            });
            }); 
            </script>



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
            </script>
=======
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
                </div>

                <?php

                $subjectOptions = "";
                foreach ($subjectpapers as $paper) {
                $subjectOptions .= '<option value="'.$paper["subjectpaper_id"].'">'.$paper["subjectpaper_papername"].'</option>';
                }

                $staffOptions = "";
                foreach ($teaching_staff as $staff) {
                $staffOptions .= '<option value="'.$staff["id"].'">'.$staff["name"].'</option>';
                }

                $periodOptions = "";
                foreach ($period as $per) {
                $periodOptions .= '<option value="'.$per["periodic_table_id"].'">'.$per["periodic_table_name"].'</option>';
                }
                ?>

                <form action="<?php echo site_url('semester_activities/semester_timetable/set_timetable') ?>" method="post" accept-charset="utf-8">
                <br>
                <br>
                <div class="box-body">
                <?php echo $this->customlib->getCSRF(); ?>


                <div class="row">
                <div class="col-md-2">
                <label for="program"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
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

                 <span class="text-danger" id="form_error_program_type"><?php echo form_error('program_type'); ?></span>
                </div>



                <div class="col-md-2">
                <label for="program"><?php echo $this->lang->line('programee'); ?><small class="req"> *</small></label>
                <select name="programe" id="programe" class="form-control">
                <option></option>
                </select>
                <!-- <?php echo form_error('programe'); ?> -->
                  <span class="text-danger" id="form_error_programe"><?php echo form_error('programe'); ?></span>
                </div>


                <div class="col-md-2">
                <label for="semester"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>
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
                 <span class="text-danger" id="form_error_semester_semtype"><?php echo form_error('semester_semtype'); ?></span>
                </div>


                <div class="col-md-2">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_term'); ?><small class="req"> *</small></label>
                <select name="semester_term" id="semester_term" class="form-control" >
                <option value="">Select Semester</option>
                <?php
                foreach($semester_term as $term)
                {
                ?>
                <option value="<?php echo  $term['stm_id']; ?>"<?php if(set_value('semester_term')==$term['stm_id']) { echo "selected=selected"; }        ?> ><?php echo  $term['stm_name']; ?> </option>
                <?php 
                }
                ?>
                </select> 
                <!-- <?php echo form_error('semester_term'); ?> -->
                 <span class="text-danger" id="form_error_semester_term"><?php echo form_error('semester_term'); ?></span>
                </div>


                <div class="col-md-2">
                <label for="batch"><?php echo $this->lang->line('batch'); ?><small class="req"> *</small></label>
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

                <span class="text-danger" id="form_error_batch_group"><?php echo form_error('batch_group'); ?></span>
               
                </div>



                <div class="col-md-2">
                <label for="batch"><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?><small class="req"> *</small></label>
                <select name="subject_groups" id="subject_groups" class="form-control" >
                <option value=""><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?></option>                  
                <?php
                foreach($subject_groups as $subjects)
                {
                ?>
                <option value="<?php  echo $subjects['id'];  ?>"

                <?php
                if(set_value('subject_groups')==$subjects['id'])
                {
                echo "selected=selected";
                }
                ?>
                ><?php  echo $subjects['name'];  ?></option>
                <?php } ?>
                </select>                    
                

                 <span class="text-danger" id="form_error_subject_groups"><?php echo form_error('subject_groups'); ?></span>
                </div>
                </div>



                <br>
                <br>
              


                <div class="col-md-12">
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i>&nbsp;&nbsp;<?php echo $this->lang->line('search'); ?></button>
                </div> 
                </form>



                <form action="<?php echo site_url('semester_activities/semester_timetable/savetimetable') ?>" method="post" accept-charset="utf-8"> 
                <input type="hidden" name="prg" value="<?php  echo $programe; ?>" class="form-control">
                <input type="hidden" name="sem" value="<?php  echo $semester; ?>" class="form-control">
                <input type="hidden" name="sem_term" value="<?php  echo $sem_term; ?>" class="form-control">
                <input type="hidden" name="bat" value="<?php  echo $bat_group; ?>" class="form-control">
                <input type="hidden" name="sub_grp" value="<?php  echo $sub_groups; ?>" class="form-control">
               

                <ul class="nav nav-tabs" id="myTabs">
                <?php
                $count = 1;
                foreach ($getDaysnameList as $days_key => $days_value) {
                $active = ($count == 1) ? "active" : "";
                ?>
                <li class="<?php echo $active; ?>">
                <a href="#tab_<?php echo $count; ?>" data-day="<?php echo $days_key; ?>" data-toggle="tab">
                <?php echo $days_key; ?>
                </a>
                </li>
                <?php
                $count++;
                }
                ?>
                </ul>

                <br>

                <div class="tab-content">
                <?php
                $count = 1;
                foreach ($getDaysnameList as $days_key => $days_value) {
                $active = ($count == 1) ? "active in" : "";
                ?>
                <div class="tab-pane fade <?php echo $active; ?>" id="tab_<?php echo $count; ?>">
                <button type="button" class="btn btn-sm btn-primary add_row pull-right" data-day="<?php echo $days_key; ?>">+ Add Row</button>          
                <br><br>
                <br><br>

                <div class="table-responsive mailbox-messages">
                <table class="table table-bordered ">
                <thead>
                <tr>
                <th>Sl. No</th>
                <th>Subject Paper</th>
                <th>Subject</th>
                
                <th>Staff</th>
                <th>Period</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Room No</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Rows will be appended here -->
                </tbody>
                </table>
                </div>
                </div>
                <?php
                $count++;
                }
                ?>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-success pull-right"><?php echo $this->lang->line('submit'); ?></button>
                <br>
                <br>
                </form>
                </section>          
                </div>  
                </div>
                </div>




                <?php     
                $subjectOptions = "";
                foreach ($subjectpapers as $paper) {
                $subjectOptions .= '<option value="'.$paper["sem_paper_id"].'">'.$paper["sem_paper_paper"].'</option>';
                }              

                $staffOptions = "";
                foreach ($teaching_staff as $staff) {
                $staffOptions .= '<option value="'.$staff["id"].'">'.$staff["name"].'</option>';
                }

                $periodOptions = "";
                foreach ($period as $per) {
                $periodOptions .= '<option value="'.$per["periodic_table_id"].'">'.$per["periodic_table_name"].'</option>';
                }
                ?>              



                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                <script>
                $(document).ready(function() 
                {
                var isLoadingDay = false;  // To solve the double-entry issues

                $(document).on("click", "#myTabs a", function(e) {
                e.preventDefault();              


                if (isLoadingDay) return; // exit if already loading


                isLoadingDay  = true; // set flag
                var $this     = $(this);

                var day       = $(this).data("day");
                var $tabPane  = $($(this).attr("href"));
                var $tbody    = $tabPane.find("tbody");
                // var $tbody   = $tabPane.find("table tbody");

                // Clear previous rows immediately

                $tbody.empty(); 


                // Fetch timetable for the selected day
                $.ajax({
                url: "<?php echo site_url('semester_activities/semester_timetable/get_day_records'); ?>",
                type: "POST",
                data: {
                day: day,
                program: $("input[name='prg']").val(),
                semester: $("input[name='sem']").val(),
                sem_term: $("input[name='sem_term']").val(),
                bat: $("input[name='bat']").val(),
                sub_grp: $("input[name='sub_grp']").val()
                },

                success: function(response) {                   
                try {
                var data = JSON.parse(response);
                
                alert(data)

                if (data.length > 0) {
                $.each(data, function(index, row) {
                var newRow = `
                <tr>
                <td>
                <input type="text" name="slno[${day}][]" class="form-control" value="${index + 1}" readonly>
                <input type="hidden" name="sem_group_id[${day}][]" value="${row.tb_id}">
                <input type="hidden" name="dayy[]" value="${day}">
                </td>

                <td>
                <select class="form-control subjectpaper" name="subjectpaper[${day}][]">
                <?php echo $subjectOptions; ?>
                </select>
                </td>

                
                <td>
                <select class="form-control subject" name="subject[${day}][]">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                </td>
                <td>
                <select class="form-control staff_id" name="staff_id[${day}][]">
                <?php echo $staffOptions; ?>
                </select>
                </td>
                <td>
                <select class="form-control period" name="period[${day}][]">
                <?php echo $periodOptions; ?>
                </select>
                </td>
                <td><input type="time" name="time_from[${day}][]" class="form-control" value="${row.tb_time_from}"></td>
                <td><input type="time" name="time_to[${day}][]" class="form-control" value="${row.tb_time_to}"></td>
                <td><input type="text" name="room_no[${day}][]" class="form-control" value="${row.tb_room_no}"></td>
                <td><button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                </tr>`;
                $tbody.append(newRow);
                // preselect saved values for this appended row
                var $last = $tbody.find('tr').last();
                $last.find('select.subjectpaper').val(row.tb_subjectpaper);
                $last.find('select.staff_id').val(row.tb_staff_id);
                $last.find('select.period').val(row.tb_period_id);
                // auto-fill subject from selected paper
                $last.find('select.subjectpaper').trigger('change');
                });
                } else {
                $tbody.html("<tr><td colspan='8' class='text-center text-muted'>No records found for this day</td></tr>");
                }
                } catch (e) {
                console.error("Invalid JSON:", response);
                }
                },
                error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                },

                complete: function() {
                isLoadingDay = false; // reset flag after AJAX completes
                }

                });
                });



                $(document).on("click", ".add_row", function () {                   

                var $tabPane = $(this).closest(".tab-pane");
                var $tbody   = $tabPane.find("table tbody");
                var rowcount = $tbody.find("tr").length + 1;
                var day      = $(this).data("day");                   

                var newRow = `
                <tr>
                <td>
                <input type="text" name="slno[${day}][]" class="form-control" value="${rowcount}" readonly> 

                <input type="hidden" name="sem_group_id[${day}][]" class="sem_group_id" class="form-control">
                <input type="hidden" name="dayy[]" value="${day}">
                </td>

                <td>
                <select class="form-control subject" name="subject[${day}][]">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                </td>


                <td>
                <select class="form-control subjectpaper" name="subjectpaper[${day}][]">
                <?php echo $subjectOptions; ?>
                </select>
                </td>





                <td>
                <select class="form-control staff_id" onchange="getstaff(${rowcount})" name="staff_id[${day}][]">
                <?php echo $staffOptions; ?>
                </select>
                </td>


                <td>
                <select class="form-control period" onchange="getperiod_id(${rowcount})" name="period[${day}][]">
                <?php echo $periodOptions; ?>
                </select>
                </td>
                <td><input type="time" name="time_from[${day}][]" class="form-control"></td>
                <td><input type="time" name="time_to[${day}][]" class="form-control"></td>
                <td><input type="text" name="room_no[${day}][]" class="form-control"></td>
                <td>
                <button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </td>
                </tr>
                `;

                $tbody.append(newRow);
                // ensure subject reflects paper immediately if user picks paper
                // (handled globally by change listener below)
                });

                // Delete row functionality
                $(document).on("click", ".ibtnDel", function () {
                $(this).closest("tr").remove();
                });

                // Before submitting form, make sure all hidden tabs' inputs are included
                $("#scheduleForm").on("submit", function() {
                $(".tab-pane").removeClass("fade").addClass("active in").show();
                });
                }); 

                // When subject paper changes, fetch its subject and set the Subject select in the same row
                $(document).on('change', 'select.subjectpaper', function() {
                    var $row = $(this).closest('tr');
                    var paper_id = $(this).val();
                    var $subjectSelect = $row.find('select.subject');

                    if (!paper_id) {
                        $subjectSelect.html('<option value=""><?php echo $this->lang->line('select'); ?></option>');
                        return;
                    }

                    $.ajax({
                        url: '<?php echo site_url('semester_activities/semester_timetable/get_subject_by_paper'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: { paper_id: paper_id },
                        success: function(res) {
                            var opts = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                            if (res && res.id) {
                                opts += '<option value="'+res.id+'" selected>'+res.name+'</option>';
                            }
                            $subjectSelect.html(opts);
                        }
                    });
                });

                var old_program_type  = "<?php echo set_value('program_type'); ?>";
                var old_programe      = "<?php echo set_value('programe'); ?>";

                $(document).ready(function()
                {
                function loadProgrames(prog_type_id, selected_programe = '') {
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




                $(document).ready(function()
                {
                $('#subject_groups').change(function() 
                {
                var group_id = $(this).val(); 
                if(group_id != '')
                {
                $.ajax({
                url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_subjects'); ?>",
                method: "POST",
                data: {group_id: group_id},
                dataType: "json",
                success: function(data)
                {                  
                $('#subjects').empty();
                $('#subjects').append('<option value="">Select Subject</option>');
                $.each(data, function(key, value) {
                $('#subjects').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
                }
                });
                } else {
                $('#subjects').empty();
                $('#subjects').append('<option value="">Select Subject</option>');
                }
                });
                }); 
                </script>



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
                </script>
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

