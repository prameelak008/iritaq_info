
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">


            <style type="text/css"> 
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

            border-color: transparent;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #6b7275 0%, #6b7275 100%); 
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
            $subjectOptions = '';
            foreach ($subjectpapers as $paper) {
            $subjectOptions .= '<option value="'.$paper['sem_paper_id'].'">'
            .$paper['subject_name'].' - '.$paper['sem_paper_paper'].
            '</option>';
            }

            $staffOptions = '';
            foreach ($teaching_staff as $staff) {
            $staffOptions .= '<option value="'.$staff['id'].'">'.$staff['name'].'</option>';
            }

            $periodOptions = '';
            foreach ($period as $per) {
            $periodOptions .= '<option 
            value="'.$per['periodic_table_id'].'"
            data-from="'.$per['periodic_table_timefrom'].'"
            data-to="'.$per['periodic_table_timeto'].'">'
            .$per['periodic_table_name'].
            '</option>';
            }

            ?>



            <form role="form" action="<?php echo site_url('semester_activities/semester_timetable/set_timetable') ?>" method="post" class="class_search_form">
            <div class="promotion-grid">
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

            <div class="row">
            <div class="col-md-12">
            <div class="row">


            <?php echo $this->customlib->getCSRF(); ?>

            <div class="col-md-4">
            <div class="form-group">           
            <?= dropdownlist_program(
            $programs,              // Array of programs from DB
            set_value('prog_id'), 
            ); ?>
            <span class="text-danger"><?= form_error('prog_id'); ?></span>
            </div>        
            </div> 

            <div class="col-md-4">
            <div class="form-group">
            <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
            <select id="sem_type" name="sem_type" class="form-control">
            <option value="">-- Select Batch & Semester --</option>
            </select>
            <span class="text-danger"><?= form_error('sem_type'); ?></span>
            </div>            
            </div>



            <div class="col-md-4">
            <div class="form-group">
            <label><?php echo $this->lang->line('subject').'&nbsp;'.$this->lang->line('group'); ?> <small class="req">*</small></label>
            <select id="subject_group" name="subject_group" class="form-control">
            <option value="">-- Select Batch & Semester --</option>
            </select>
            <span class="text-danger"><?= form_error('subject_group'); ?></span>
            </div>            
            </div>
            </div>
            </div>       


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






            <ul class="nav nav-tabs" id="myTabs">
            <?php
            $first = true;
            foreach ($getDaysnameList as $day => $dayLabel) {
            ?>
            <li class="<?= $first ? 'active' : '' ?>">
            <a href="#tab_<?php echo $day; ?>" data-toggle="tab">
            <?php echo $day; ?>
            </a>
            </li>
            <?php
            $first = false;
            }
            ?>
            </ul>




            <div class="promotion-grid">
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('timetable'); ?></div>

            <div class="row">
            <div class="col-md-12">
            <div class="row">
            <form action="<?php echo site_url('semester_activities/semester_timetable/save_timetable') ?>" method="post">
            <?php echo $this->customlib->getCSRF(); ?>

            <div class="tab-content">
            <?php
            $first = true;
            foreach ($getDaysnameList as $day => $dayLabel) {
            ?>
            <div class="tab-pane <?= $first ? 'active' : '' ?>" id="tab_<?= $day ?>">
            <table class="table table-bordered">
            <thead>
            <tr>
            <th>Period</th>
            <th>Time From</th>
            <th>Time To</th>
            <th>Subject </th>
            <th>Subject Paper</th>
            <th>Staff</th>
            <th>Room</th>
            <th>Action</th>
            </tr>
            </thead>

            <tbody class="timetable-body" data-day="<?= $day ?>">
            <tr>
            <td>
            <select class="form-control period" onchange="getperiod_id(this)" name="period[<?= $day ?>][]">
            <?= $periodOptions ?>
            </select>
            </td>
            <td><input type="text" name="time_from[<?= $day ?>][]" class="form-control" readonly></td>
            <td><input type="text" name="time_to[<?= $day ?>][]" class="form-control" readonly></td>


            <td>
            <select class="form-control subject" name="subject[${day}][]">
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            </td>


            <td>
            <select name="subjectpaper[<?= $day ?>][]" class="form-control">
            <?= $subjectOptions ?>
            </select>
            </td>
            <td>
            <select name="staff[<?= $day ?>][]" class="form-control">
            <?= $staffOptions ?>
            </select>
            </td>
            <td><input type="text" name="room[<?= $day ?>][]" class="form-control"></td>
            <td><button type="button" class="btn btn-success addRow">+</button></td>
            </tr>
            </tbody>
            </table>            
            </div>


            <?php
            $first = false;
            }
            ?>

            <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm">
            <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('save'); ?>
            </button>
            </div>
            </div>
            <br>
            <br>        
            </div> 
            </form>
            </section>          
            </div>  
            </div>
            </div>





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


            $(document).on('click', '.addRow', function () {

            let $tbody = $(this).closest('tbody');

            // clone only template row
            let $row = $tbody.find('tr:first').clone();

            // reset values
            $row.find('input').val('');
            $row.find('select').prop('selectedIndex', 0);

            // convert + to -
            $row.find('.addRow')
            .removeClass('addRow btn-success')
            .addClass('removeRow btn-danger')
            .text('-');

            $tbody.append($row);
            });

            $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
            });





            $(document).on('change', '#prog_id', function () 
            {                    
            const program_id  = $(this).val();
            const $select     = $('#sem_type');  
            if (!program_id) {
            $select.html('<option value="">-- Select Batch & Semester --</option>');
            return;
            }
            $select.prop('disabled', true)
            .html('<option>Loading...</option>');

            $.post(
            "<?= site_url('semester/assignsubjects/get_semester_batch_by_program'); ?>",
            { program_id: program_id },
            function (data) {            

            let html = '<option value="">-- Select Batch & Semester --</option>';
            let currentMode = '';

            if (data.length > 0) {
            data.forEach(row => {

            if (row.b_mode_name !== currentMode)
            {
            if (currentMode !== '') html += '</optgroup>';
            currentMode = row.b_mode_name;
            html += `<optgroup label="${currentMode}">`;
            }

            html += `
            <option 
            value="${row.bchsem_id}" 
            data-semterm="${row.semterm_id}">
            ${row.semester_name} - ${row.batch_group_name} - ${row.batch_group_year}
            </option>
            `;

            });
            html += '</optgroup>';
            } else {
            html += '<option value="">No data found</option>';
            }

            $select.html(html).prop('disabled', false);
            },
            'json'
            );
            });



            $(document).on('change', '#sem_type', function ()
            {
            const sem_group_id = $(this).val();
            const program_id   = $('#prog_id').val();            

            // Reset ONLY subject group dropdown
            $('#subject_group')
            .prop('disabled', true)
            .html('<option>Loading...</option>');

            // if (!sem_group_id || !program_id) {
            // $('#subject_group')
            // .prop('disabled', false)
            // .html('<option value="">-- Select Subject Group --</option>');
            // return;
            // }

            $.post(
            "<?= site_url('semester_activities/semester_timetable/get_subject_groups_by_sem_group'); ?>",
            { sem_group_id: sem_group_id },   // program_id NOT needed unless backend uses it
            function (data) 
            {

            let html = '<option value="">-- Select Subject Group --</option>';

            if (Array.isArray(data) && data.length > 0) {
            data.forEach(row => {
            html += `<option value="${row.iid}">${row.iname}</option>`;
            });
            } else {
            html += '<option value="">No Subject Groups Found</option>';
            }

            $('#subject_group')
            .html(html)
            .prop('disabled', false);
            },
            'json'
            );
            });    
            
            

            </script>





















