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
        <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
        <div class="box-tools pull-right">
        </div>
        </div>
        
        
        
        <form action="<?php echo site_url('admin/timetable/viewtable_Details') ?>" method="post" accept-charset="utf-8">
        <div class="box-body">
        <?php echo $this->customlib->getCSRF(); ?>
        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
        <label><?php echo $this->lang->line('class'); ?><small class="req"> *</small></label>
        <select autofocus="" id="class_id" name="class_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        foreach ($classlist as $class) {
        ?>
        <option value="<?php echo $class['id'] ?>" <?php
        if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
        }
        ?>><?php echo $class['class'] ?></option>
        <?php
        }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
        <label><?php echo $this->lang->line('section'); ?><small class="req"> *</small></label>
        <select  id="section_id" name="section_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
        <label><?php echo $this->lang->line('subject') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
        <select  id="subject_group_id" name="subject_group_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('subject_group_id'); ?></span>
        </div>
        </div>
        
        
        <div class="col-md-3">
        <div class="form-group">
        <label><?php echo $this->lang->line('day') ; ?><small class="req"> *</small></label>
        
        <?php
        $selected_day = set_value('day', 'Monday'); 
        ?>
        <select name="day" id="day" class="form-control">
        <option value="Sunday" <?= ($selected_day == 'Sunday') ? 'selected' : '' ?>>Sunday</option>
        <option value="Monday" <?= ($selected_day == 'Monday') ? 'selected' : '' ?>>Monday</option>
        <option value="Tuesday" <?= ($selected_day == 'Tuesday') ? 'selected' : '' ?>>Tuesday</option>
        <option value="Wednesday" <?= ($selected_day == 'Wednesday') ? 'selected' : '' ?>>Wednesday</option>
        <option value="Thursday" <?= ($selected_day == 'Thursday') ? 'selected' : '' ?>>Thursday</option>
        <option value="Friday" <?= ($selected_day == 'Friday') ? 'selected' : '' ?>>Friday</option>
        <option value="Saturday" <?= ($selected_day == 'Saturday') ? 'selected' : '' ?>>Saturday</option>
        </select>
        </div>
        </div>
        
        </div>
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right btn-sm"><?php echo $this->lang->line('search'); ?></button>
        </div>
        </form>
        
        
        <div class="box-body">
        <div class="download_label"><?php echo $this->lang->line('timetable'); ?></div>
        <div class="mailbox-messages table-responsive">
        <?php if (isset($view_details) && !empty($view_details)) { ?>
        <div class="box-header ptbnull">
        <table class="table table-bordered table-hover example">
        <thead>
        <tr>
        <th>Sl.no</th>
        <th>Subject </th>
        <th>Paper </th>
        <th>Teacher</th>
        <th>Period</th>
        <th>Time From</th>
        <th>Time To</th>
        <th>Room No</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $slno=1;
        foreach($view_details as $deta)
        {
        ?>
        <tr id="row<?php echo $deta['sid']; ?>">
        <td><?php echo $slno; ?></td>
        <td><?php echo $deta['subjectname'];  ?></td>
        <td><?php echo "Code".'&nbsp;&nbsp;'.$deta['papercode'].'<br>'." Name".'&nbsp;&nbsp;'.$deta['papername'];  ?></td>
        <td><?php echo $deta['staffname'].'&nbsp;'. $deta['surname']; ?></td>
        <td><?php echo $deta['period']; ?></td>
        <td><?php echo $deta['time_from']; ?></td>
        <td><?php echo $deta['time_to']; ?></td>
        <td><?php echo $deta['room_no']; ?></td>
        <td>
        <a data-placement="left" href="javascript:void(0);" class="btn btn-default btn-xs delete-btn" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" data-id="<?php echo $deta['sid']; ?>">
        <i class="fa fa-trash fontdelcol"></i>
        </a>
        </td>
        
        </tr> 
        <?php 
        $slno++;
        }
        ?>
        </tbody>
        </table>   
        </div>
        </div>
        <?php
        } 
        else
        { 
        ?>
        <p style="text-align:center;" class="fontdelcol">No records available.</p>
        <?php
        } 
        ?>
        </div>
        </div>
        </div>
        </section>
        </div>
        <script type="text/javascript">
        $(document).on('focus', '.time', function () {
        var $this = $(this);
        $this.datetimepicker({
        format: 'LT'
        });
        });
        
        var tot_count = 0;
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        var subject_group_id = '<?php echo set_value('subject_group_id') ?>';
        $(document).ready(function () {
        
        $('#myTabs a:first').tab('show') // Select first tab
        getSectionByClass(class_id, section_id);
        getGroupByClassandSection(class_id, section_id, subject_group_id);
        
        $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        
        $.ajax({
        type: "GET",
        url: base_url + "sections/getByClass",
        data: {'class_id': class_id},
        dataType: "json",
        success: function (data) {
        $.each(data, function (i, obj)
        {
        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
        });
        
        $('#section_id').append(div_data);
        }
        });
        });
        
        $(document).on('change', '#section_id', function (e) {
        $('#subject_group_id').html("");
        var section_id = $(this).val();
        var class_id = $('#class_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
        type: "POST",
        url: base_url + "admin/subjectgroup/getGroupByClassandSection",
        data: {'class_id': class_id, 'section_id': section_id},
        dataType: "json",
        success: function (data) {
        $.each(data, function (i, obj)
        {
        div_data += "<option value=" + obj.subject_group_id + ">" + obj.name + "</option>";
        });
        
        $('#subject_group_id').append(div_data);
        }
        });
        });
        });
        
        function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        
        $.ajax({
        type: "GET",
        url: base_url + "sections/getByClass",
        data: {'class_id': class_id},
        dataType: "json",
        success: function (data) {
        $.each(data, function (i, obj)
        {
        var sel = "";
        if (section_id == obj.section_id) {
        sel = "selected";
        }
        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
        });
        $('#section_id').append(div_data);
        }
        });
        }
        }
        function getGroupByClassandSection(class_id, section_id, subject_group_id) {
        if (class_id != "" && section_id != "" && subject_group_id != "") {
        $('#subject_group_id').html("");
        
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
        type: "POST",
        url: base_url + "admin/subjectgroup/getGroupByClassandSection",
        data: {'class_id': class_id, 'section_id': section_id},
        dataType: "json",
        success: function (data) {
        console.log(subject_group_id);
        $.each(data, function (i, obj)
        {
        var sel = "";
        if (subject_group_id == obj.subject_group_id) {
        sel = "selected";
        }
        div_data += "<option value=" + obj.subject_group_id + " " + sel + ">" + obj.name + "</option>";
        });
        
        $('#subject_group_id').append(div_data);
        }
        });
        }
        }
        
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        
        var target = $(e.target).attr("href"); // activated tab
        var target_id = $(e.target).attr("id"); // activated tab
        var ajax_data = $(e.target).data(); // activated tab
        $(target).html("");
        getGroupdata(target, target_id, ajax_data);
        $('#gday').val(ajax_data.day);
        })
        
        function getGroupdata(target, target_id, ajax_data)
        {
        $.ajax({
        type: 'POST',
        url: base_url + "admin/timetable/getBydategroupclasssection",
        data: {'day': ajax_data.day, 'class_id': ajax_data.c, 'section_id': ajax_data.s, 'subject_group_id': ajax_data.group},
        dataType: 'json',
        beforeSend: function () {
        $(target).addClass('show');
        },
        success: function (data) {
        $(target).html(data.html);
        
        // $('.staff', target).select2({
        // dropdownAutoWidth: true,
        // width: '100%'
        // });
        $('.subject', target).select2({
        dropdownAutoWidth: true,
        width: '100%'
        });
        tot_count = data.total_count + 1;
        },
        error: function (xhr) { // if error occured
        
        },
        complete: function () {
        $(target).removeClass('show');
        }
        });
        }
        </script>
        <script type="text/template" id="staff_dropdown">
        <option value=""><?php echo $this->lang->line('select') ?></option>
        <?php
        foreach ($staff as $staff_key => $staff_value) {
        ?>
        <option value="<?php echo $staff_value['id']; ?>"><?php echo $staff_value['name'] . " " . $staff_value['surname'] . " (" . $staff_value['employee_id'] . ")"; ?></option>
        <?php
        }
        ?>
        </script>
        
        <script type="text/template" id="subject_dropdown">
        <option value=""><?php echo $this->lang->line('select') ?></option>
        <?php
        foreach ($subject as $subject_key => $subject_value) 
        {
        if ($subject_value->code !== '') {
        $sub_name = $subject_value->name . " (" . $subject_value->code . ")";
        } 
        else
        {
        $sub_name = $subject_value->name;
        }
        ?>
        <option value="<?php echo $subject_value->id; ?>" ><?php echo $sub_name; ?></option>
        <?php
        }
        ?>
        </script>
        
        <script type="text/template" id="subjectpapers_dropdown">
        <option value=""><?php echo $this->lang->line('select') ?></option>
        <?php
        foreach ($subjectpapers as $subjectpaper_key => $subjectpaper_value)
        {
        ?>
        <option value="<?php echo $subjectpaper_value['subjectpaper_id']; ?>" ><?php echo $subjectpaper_value['subjectpaper_papername'].'&nbsp;&nbsp;'.$subjectpaper_value['subjectpaper_papercode']; ?></option>
        <?php
        }
        ?>
        </script>
        
        <script type="text/template" id="period_dropdown">
        <option value=""><?php echo $this->lang->line('select') ?></option>
        <?php
        foreach ($period as $periodkey => $period_value) 
        {
        ?>
        <option value="<?php echo $period_value['periodic_table_id']; ?>"><?php echo $period_value['periodic_table_name'] ; ?></option>
        <?php
        }
        ?>
        </script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        
        $(document).ready(function() 
        {
        $('.delete-btn').click(function() {
        var id = $(this).data('id'); 
        if (confirm('<?php echo $this->lang->line('delete_confirm'); ?>')) {
        $.ajax({
        url: '<?php echo base_url(); ?>admin/timetable/delete_table/' + id,
        type: 'POST',
        success: function(response) {
        $('#row' + id).remove();
        },
        error: function(xhr, status, error) {
        alert('Error: ' + error);
        }
        });
        }
        });
        });
        
        
        </script>

      
        
        
