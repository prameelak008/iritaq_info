
            <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">  
            -->

            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            ?>
            <div class="content-wrapper">
            <section class="content-header">
            <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> 
            <small><?php echo $this->lang->line('student1'); ?></small>
            </h1>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="col-md-12">
            <?php $this->load->view('layout/topbar_enrollment'); ?>
            </div>
            &nbsp;

            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">
            <i class="fa fa-search"></i> <?php echo $this->lang->line('bulk_delete'); ?>
            </h3>
            </div>



            <div class="box-body">
            <form role="form" action="<?php echo site_url('semester_enrollment/enroll/bulk_delete') ?>" method="post" class="class_search_form">
            <div class="promotion-grid">
            <!-- Selection Section -->
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('bulk_delete'); ?></div>

            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <label>Program Type / Program <small class="req">*</small></label>
            <select id="program" name="program" class="form-control">
            <option value="">-- Select Program --</option>
            <?php 
            $programs_by_type = [];
            foreach ($programs as $p) {
            $tid = isset($p['prog_type_id']) ? $p['prog_type_id'] : null;
            if ($tid === null) continue;
            if (!isset($programs_by_type[$tid])) $programs_by_type[$tid] = [];
            $programs_by_type[$tid][] = $p;
            }
            foreach ($program_types as $type) {
            echo '<optgroup label="'.htmlspecialchars($type['prog_type_name']).'">';
            $list = isset($programs_by_type[$type['prog_type_id']]) ? $programs_by_type[$type['prog_type_id']] : [];
            if (!empty($list)) {
            foreach ($list as $prog) {
            echo '<option value="'.$prog['p_id'].'" '.set_select('program', $prog['p_id']).'>'
            .htmlspecialchars($prog['p_name']).'</option>';
            }
            } else {
            echo '<option value="" disabled>-</option>';
            }
            echo '</optgroup>';
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('program'); ?></span>
            </div>
            </div>

            <!-- Semester / Batch / Term -->
            <div class="col-md-6">
            <div class="form-group">
            <label>Semester / Batch / Term <small class="req">*</small></label>
            <select id="semester" name="semester" class="form-control">
            <option value="">-- Select Semester / Term / Batch --</option>
            <?php 
            $current_type = '';
            foreach ($semesters_batches as $sem): 
            if ($current_type != $sem['st_name']) {
            if ($current_type != '') echo '</optgroup>';
            echo '<optgroup label="' . htmlspecialchars($sem['st_name']) . '">';
            $current_type = $sem['st_name'];
            }
            $value = $sem['sem_group_semester'] . '|' . $sem['sem_group_batchgroup'] . '|' . $sem['sem_group_semester_term'];
            ?>
            <option value="<?php echo $value; ?>" <?php echo set_select('semester', $value); ?>>
            <?php echo $sem['stm_name'] . ' - ' . $sem['batch_group_year']; ?>
            </option>
            <?php endforeach; ?>
            <?php if ($current_type != '') echo '</optgroup>'; ?>
            </select>
            <span class="text-danger"><?php echo form_error('semester'); ?></span>
            </div>
            </div>
            </div>

            </div>
            </div>

            <div class="col-md-12">
            <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
            <i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?>
            </button>
            </div>
            </div>
            </div>
            </div> 
            </form>
            </div>
            </div>
            <?php  
            if (isset($students)) 
            {
            ?>
            <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
            <div class="nav-tabs-custom border0 navnoshadow">
            <div class="box-header with-border">
            <h3 class="box-title">
            <i class="fa fa-search"></i> <?php echo $this->lang->line('student_list'); ?>
            </h3>
            </div>
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?>  <?php echo $this->lang->line('view'); ?></a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details'); ?> <?php echo $this->lang->line('view'); ?></a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <table class="table table-striped table-bordered table-hover student-list-tab1" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
            <thead>
            <tr>
            <th><input type="checkbox" id="select_all"></th>
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('roll_no'); ?></th>
            <th><?php echo $this->lang->line('student_name'); ?></th>
            <th><?php echo $this->lang->line('gender'); ?></th>
            <th><?php echo $this->lang->line('father_name'); ?></th>
            <th><?php echo $this->lang->line('current_address'); ?></th>
            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($students as $stud)
            {
            ?>
            <tr>
            <th>
            <input type="checkbox"
            class="allcheckbox"
            value="<?php echo $stud['id']; ?>">  
            </th>
            <th><?php echo $stud['admission_no']; ?></th>
            <th><?php echo $stud['roll_no']; ?></th>
            <th><?php echo $stud['firstname']; ?></th>              
            <th><?php echo $stud['gender']; ?></th>
            <th><?php echo $stud['father_name']; ?></th>
            <th><?php echo $stud['current_address']; ?></th>
            <th><?php echo $stud['dob']; ?></th>
            </tr> 
            <?php } ?>
            </tbody>
            </table>
            <br>
            <br>
            <button type="button" id="delete_selected" class="btn btn-danger pull-right btn-sm">
            <i class="fa fa-trash"></i> <?php echo $this->lang->line('bulk_delete'); ?>
            </button>
            <br>
            <br>



            <script>
            $(function(){
            var $tbl = $('.student-list-tab1');
            if ($tbl.length && $.fn.DataTable) {
            $tbl.DataTable({
            dom: 'Bfrtip',
            buttons: [
            {extend:'copy', text:'<i class="fa fa-files-o"></i>', className:'btn-copy', title: $tbl.data('exportTitle'), exportOptions:{columns:'thead th:not(.noExport)'}},
            {extend:'excel', text:'<i class="fa fa-file-excel-o"></i>', className:'btn-excel', title: $tbl.data('exportTitle'), exportOptions:{columns:'thead th:not(.noExport)'}},
            {extend:'csv', text:'<i class="fa fa-file-text-o"></i>', className:'btn-csv', title: $tbl.data('exportTitle'), exportOptions:{columns:'thead th:not(.noExport)'}},
            {extend:'pdf', text:'<i class="fa fa-file-pdf-o"></i>', className:'btn-pdf', title: $tbl.data('exportTitle'), exportOptions:{columns:'thead th:not(.noExport)'}},
            {extend:'print', text:'<i class="fa fa-print"></i>', className:'btn-print', title: $tbl.data('exportTitle'), exportOptions:{columns:'thead th:not(.noExport)'}}
            ],
            pageLength: 100,
            aaSorting: [],
            columnDefs: [
            { orderable: false, targets: -1, className: 'dt-body-right' }
            ]
            });
            }
            });
            </script>


            </div>
            <div class="tab-pane detail_view_tab" id="tab_2">
            <?php if (empty($students)) {
            ?>
            <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
            <?php
            } else {
            $count = 1;
            foreach ($students as $student) {

            if (empty($student["image"])) {
            if ($student['gender'] == 'Female') {
            $image = "uploads/student_images/default_female.jpg";
            } else {
            $image = "uploads/student_images/default_male.jpg";
            }
            } else {
            $image = $student['image'];
            }
            ?>
            <div class="carousel-row">
            <div class="slide-row">
            <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
            <div class="carousel-inner">
            <div class="item active">
            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
            <?php if ($sch_setting->student_photo) {?><img class="img-responsive img-thumbnail width150" alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>" src="<?php echo base_url() . $image; ?>" alt="Image"><?php }?></a>
            </div>
            </div>
            </div>
            <div class="slide-content">
            <h4><a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></a></h4>
            <div class="row">
            <div class="col-xs-6 col-md-6">
            <address>
            <strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
            <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
            <b><?php echo $this->lang->line('date_of_birth'); ?>:
            <?php if ($student["dob"] != null && $student["dob"] != '0000-00-00') {echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));}?><br>
            <b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $student['gender'] ?><br>
            </address>
            </div>

            <div class="col-xs-6 col-md-6">
            <b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
            <?php if ($sch_setting->guardian_name) {?>
            <b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
            <?php }if ($sch_setting->guardian_name) {?>
            <b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?><br> <?php }?>
            <b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
            </div>

            </div>
            </div>
            <div class="slide-footer">
            <span class="pull-right buttons">
            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
            <i class="fa fa-reorder"></i>
            </a>
            <?php
            if ($this->rbac->hasPrivilege('student', 'can_edit')) {
            ?>
            <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
            <i class="fa fa-pencil"></i>
            </a>
            <?php
            }
            if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) {
            ?>
            <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
            <?php echo $currency_symbol; ?>
            </a>
            <?php }?>
            </span>
            </div>
            </div>
            </div>
            <?php
            }
            $count++;
            }
            ?>
            </div>
            </div>
            </div>
            </div><!--./box box-primary -->
            <?php
            }
            ?>
            </div>
            </div>
            </section>
            </div>




            <script>
            function resetFields(search_type)
            {
            if(search_type == "search_full"){
            $('#class_id').prop('selectedIndex',0);
            $('#section_id').find('option').not(':first').remove();
            }else if (search_type == "search_filter") {

            $('#search_text').val("");
            }
            } 
            
            
           

                    $(document).ready(function ()
                    {
                    $("#select_all").on("click", function () {
                    $(".allcheckbox").prop("checked", this.checked);
                    });

                    $(".allcheckbox").on("change", function () {
                    $("#select_all").prop(
                    "checked",
                    $(".allcheckbox:checked").length === $(".allcheckbox").length
                    );
                    });

                    $("#delete_selected").on("click", function () {

                    var ids = [];

                    $(".allcheckbox:checked").each(function () {
                    ids.push($(this).val());
                    });

                    alert(ids);

                    if (ids.length === 0) {
                    alert("Please select at least one student.");
                    return;
                    }

                    if (confirm("Are you sure you want to delete selected students?")) {

                    $.ajax({
                    url: "<?php echo base_url('semester_enrollment/Enroll/delete_data'); ?>",
                    type: "POST",
                    data: { ids: ids },
                    dataType: "json",
                    success: function (response) {

                    console.log(response);

                    if (response.status === "success") {
                    alert("Deleted Successfully");
                    location.reload();
                    } else {
                    alert("Error: " + response.status);
                    console.log(response);
                    }

                    },
                    error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("AJAX error occurred");
                    }
                    });

                    }
                    });
                    });



        
          
/*
            $(document).ready(function () 
            {
            // Select / Deselect All
            $("#select_all").on("click", function () {
            $(".allcheckbox").prop("checked", this.checked);
            });

            $(".allcheckbox").on("change", function () {
            $("#select_all").prop(
            "checked",
            $(".allcheckbox:checked").length === $(".allcheckbox").length
            );
            });

            // Bulk Delete
            $("#delete_selected").on("click", function () {

            var ids = [];

            $(".allcheckbox:checked").each(function () {


            let id = $(this).val(); // semester_students.id

            alert(id)
            console.log("Row ID:", id);

            ids.push(id);
            });

            if (ids.length === 0) {
            alert("Please select at least one student.");
            return;
            }

            if (confirm("Are you sure you want to delete selected students?")) {
            $.ajax({
            url: "<?php base_url('semester_enrollment/Enroll/delete_data') ?>",
            type: "POST",
            data: { ids: ids }, // send only IDs
            dataType: "json",
            success: function (response)
            {
       
            location.reload();
            }
            });
            }
            });

            });
*/
          
            </script>