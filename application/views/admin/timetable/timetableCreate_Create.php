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
        
        
        <form action="<?php echo site_url('admin/timetable/create_TimetableCreate') ?>" method="post" accept-charset="utf-8">
        <div class="box-body">
        <?php echo $this->customlib->getCSRF(); ?>
        <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-4">
        <div class="form-group">
        <label><?php echo $this->lang->line('section'); ?><small class="req"> *</small></label>
        <select  id="section_id" name="section_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
        <label><?php echo $this->lang->line('subject') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
        <select  id="subject_group_id" name="subject_group_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('subject_group_id'); ?></span>
        </div>
        </div>
        </div>
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right btn-sm"><?php echo $this->lang->line('search'); ?></button>
        </div>
        </form>
        
        
        <?php
        if (isset($getDaysnameList)) 
        {
        ?>
        <div class="row">
        <div class="col-md-12">
        <div class="box-header ptbnull">
            
        <form action="<?php echo site_url('admin/timetable/savetimetable_create') ?>" method="post" accept-charset="utf-8">
        <div class="">
        <input type="hidden" name="day" id="day_input" value="">
        <input type="hidden" name="class_id"  value="<?php echo $class_id; ?>">
        <input type="hidden" name="section_id"  value="<?php echo $section_id; ?>">
        <input type="hidden" name="subject_group_id"  value="<?php echo $subject_group_id; ?>">
        <input type="hidden" id="count" value="0"> 
        
        
        <div class="col-md-4">
        <div class="form-group">
        <br>
        <select name="dayval" id="day" onchange="updateDayValue()" class="form-control" >
        <option value="Sunday">Sunday</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        </select>
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
        <a id="add_row" class="addrow addbtnleft btn btn-default btn-sm pull-left">
        <i class="fa fa-plus"></i> Add New Row
        </a>
        </div>
        </div>
        
        
        <div class="col-md-4">
        <div class="form-group">
        <a class="btn btn-default btn-sm pull-right " style="margin-left:10px; " href="<?php echo site_url('admin/timetable/viewtable_Details'); ?>"><i class="fa fa-table"></i>&nbsp;View Table</a>
        <a class="btn btn-default btn-sm pull-right" href="<?php echo site_url('admin/timetable/create'); ?>"><i class="fa fa-long-arrow-left"></i>&nbsp;Back</a>
        </div>
        </div>

        <table class="table table-bordered table-hover order-list example">
        <thead>
        <tr>
        <th>Sl.no</th>
        <th>Paper Name</th>
        <th>Subject Paper</th>
        <th>Teacher</th>
        <th>Period</th>
        <th>Time From</th>
        <th>Time To</th>
        <th>Room No</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody id="items"></tbody>
        </table>

        <input type="hidden" id="count" value="0">
        
        <?php if ($this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
        ?>
        <button class="btn btn-primary btn-sm pull-right" type="submit"><i class="fa fa-save"></i> <?php echo $this->lang->line('save'); ?></button>&nbsp;
        <?php }
        ?>
        </form>
        
        </div>
       
        <?php
        }
        ?>
        </section>
        </div>
        </div>
        </div>
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
            
            function getSectionByClass(class_id, section_id) 
            {
            if (class_id != "" && section_id != "") 
            {
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
            
            
            function getGroupByClassandSection(class_id, section_id, subject_group_id) 
            {
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
            
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) 
            {
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
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
            
            function getperiod_id(row)
            {
            var period_id= $('#period_id_'+row).val();
            $.ajax({
            type: "POST",
            url: base_url + "admin/timetable/getperiod",
            data: {'period_id': period_id},
            dataType: "json",
            success: function (data) 
            {
            $('#time_from_'+row).val(data.periodic_table_timefrom);  
            $('#time_to_'+row).val(data.periodic_table_timeto);
            }
            });
            }
            
            
            function get_subject_id(row)
            {
            var subjectpaper = $('#subjectpaper_' + row).val();
            $.ajax({
            type: "POST",
            url: base_url + "admin/timetable/get_subjects",
            data: {'subjectpaper': subjectpaper},
            dataType: "json",
            success: function (data) {
            // Ensure that the data structure has 'name' and 'id'
            if (data && data.name && data.id) {
            $('#getsubname_' + row).val(data.name); // Set the fetched subject name
            $('#subject_id_' + row).val(data.id); // Set the subject ID (if needed)
            } else {
            console.error("Unexpected data structure:", data);
            }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error fetching subjects: ", textStatus, errorThrown);
            }
            });
            }
            
            
            
            function updateDayValue() {
            var selectedDay = document.getElementById("day").value;
            document.getElementById("day_input").value = selectedDay;
            }
            
            $(document).ready(function () 
            {
            var counter = 1; 
            $('#day').change(function() {
            // Clear previous rows from the table
            $("#items").empty(); // Remove all rows from tbody with id 'items'
            $("#count").val(0); // Reset the count input to 0
            counter = 1; // Reset the counter
            });
            
            $(document).on("click", "#add_row", function () 
            {
            var day = $('#day').val(); 
            var class_id = $('#class_id').val(); 
            var section_id = $('#section_id').val(); 
            var subject_group_id = $('#subject_group_id').val();
            
            // Prepare a new row
            var countval = $("#count").val(); // Get current row count
            var rowcount = parseInt(countval) + 1; // Increment row count
            $("#count").val(rowcount); // Update the hidden input for row count            
        
            var items = '<tr id="rowno' + rowcount + '">';
            items += '<td><input type="text" class="form-control" readonly name="counter[]" value="' + rowcount + '" ></td>';
            items += '<td><select class="form-control subjectpaper" onchange="get_subject_id(' + rowcount + ')" id="subjectpaper_' + rowcount + '" name="subjectpaper[]">' + $("#subjectpapers_dropdown").html() + '</select></td>';
            items += '<td class="relative"><input type="text" name="getsubname[]" class="form-control getsubname" id="getsubname_' + rowcount + '" aria-invalid="false"></td>';
            items += '<td class="relative"><select class="form-control" id="staff_id_' + rowcount + '" name="staff_id[]">' + $("#staff_dropdown").html() + '</select></td>';
            items += '<td class="relative"><select class="form-control period" onchange="getperiod_id(' + rowcount + ')" id="period_id_' + rowcount + '" name="period_id[]">' + $("#period_dropdown").html() + '</select></td>';
            items += '<td><div class="input-group"><input type="text" name="time_from[]" class="form-control time_from time" id="time_from_' + rowcount + '" aria-invalid="false"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td>';
            items += '<td><div class="input-group"><input type="text" name="time_to[]" class="form-control time_to time" id="time_to_' + rowcount + '" aria-invalid="false"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div></div></td>';
            items += '<td><input type="text" class="form-control room_no" name="room_no[]" id="room_no_' + rowcount + '"/></td>';
            items += '<td class="text-right"><button type="button" class="ibtnDel btn btn-danger btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>';
            items += '</tr>';
            $("#items").append(items);
            });
            });
            
            $(document).on("click", ".ibtnDel", function (event)
            {
            if($(this).closest('tr').prev('input').val())
            {
            if (confirm('<?php echo $this->lang->line("are_you_sure_you_want_to_delete"); ?>')) {
            $(this).closest("tr").remove();
            counter -= 1
            }
            return false;
            
            }
            else
            {
            $(this).closest("tr").remove();
            counter -= 1
            }
            });
            
            </script>