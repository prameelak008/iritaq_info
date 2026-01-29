                    <?php
                    $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
                    ?>
                    <div class="content-wrapper">
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
                    </section>
                    <!-- Main content -->

                    <section class="content">

                    <div class="col-md-12">
                    <?php
                    $this->load->view('layout/topbar_studentnexus'); ?>
                    </div>

                    &nbsp;

                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('homework'); ?></h3>
                    </div>

                    <div class="box-body">
                    <form role="form" action="<?php echo site_url('student_nexus/homework') ?>" method="post" class="class_search_form">
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
                    <div class="col-md-6">
                    <div class="form-group"> 
                    </div>
                    </div>       

                    </div>
                    </div><!--./col-md-6-->
                    </div>

                    <div class="col-md-12">
                    <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                    <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
                    <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('search'); ?>
                    </button>
                    </div>
                    </div>
                    </div>
                    </div> 
                    </div>
                    </form>                    
                    </div>
                    </div>
                    </div>

                    <?php  
                    // if (isset($homeworklist)) 
                    // {
                    ?>

                    <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
                    <div class="nav-tabs-custom border0 navnoshadow">
                    <div class="box-header ptbnull"><?php echo $this->lang->line('homework'); ?></div>

                    <ul class="nav nav-tabs">
                    <br>
                    <div class="col-sm-12">
                    <div class="form-group">
                    <!-- <button type="button" id="addHomeworkBtn" class="btn btn-primary pull-right btn-sm">
                    <i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?>
                    </button> -->

                    <button type="button" class="btn btn-primary pull-right btn-sm checkbox-toggle" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i>&nbsp; Add</button>

                    <br>
                    <br>
                    </div>
                    </div>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                    <table class="table table-striped table-bordered table-hover student-list-tab1" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">

                    <thead>
                    <tr>
                    <th><?php echo $this->lang->line('slno'); ?></th>
                    <th><?php echo $this->lang->line('programme'); ?></th>
                    <th><?php echo $this->lang->line('batch'); ?></th>
                    <th><?php echo $this->lang->line('subject').'&nbsp;'.$this->lang->line('group'); ?></th>
                    <th><?php echo $this->lang->line('subject'); ?></th>
                    <th><?php echo $this->lang->line('homework').'&nbsp;'.$this->lang->line('date'); ?></th>  
                    <th><?php echo $this->lang->line('submission').'&nbsp;'.$this->lang->line('date'); ?></th> 
                    <th><?php echo $this->lang->line('evaluation').'&nbsp;'.$this->lang->line('date'); ?></th>  
                    <th><?php echo $this->lang->line('created_date'); ?></th>  
                    <th><?php echo $this->lang->line('created_by'); ?></th>                 
                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sl=1;
                    foreach($homeworklist as $homework)
                    {
                    ?>
                    <tr>
                    <th><?php echo $sl; ?></th>
                    <th><?php echo $homework['prog_type_name']; ?></th>
                    <th><?php echo $homework['batch_group_name'].'&nbsp;'.$homework['batch_group_year']; ?></th>
                    <th><?php echo $homework['groupname']; ?></th>
                    <th><?php echo $homework['subjectname']; ?></th>             
                    <th><?php echo $homework['homework_date']; ?></th>
                    <th><?php echo $homework['submit_date']; ?></th>
                    <th><?php echo $this->lang->line('evaluation').'&nbsp;'.$this->lang->line('date'); ?></th>  
                    <th><?php echo $homework['create_date']; ?></th>
                    <th><?php echo $homework['staffname']; ?></th>
                    <th>
                    <button 
                    type="button"
                    class="btn btn-default btn-xs viewStudents"
                    data-id="<?php echo $homework['sem_homework_id']; ?>"
                    data-sem-group="<?php echo $homework['sem_group_id']; ?>"
                    data-toggle="tooltip"
                    title="<?php echo $this->lang->line('show'); ?>">
                    <i class="fa fa-reorder"></i>
                    </button>

                    <button 
                    type="button" 
                    class="btn btn-default btn-xs editHomeworkBtn" 
                    data-id="<?php echo $homework['sem_homework_id']; ?>" 
                    title="Edit">
                    <i class="fa fa-pencil"></i>
                    </button>



                    <form role="form" action="<?php echo site_url('student_nexus/homework/delete') ?>" method="post" >
                    <input type="hidden" name="id"  value="<?php echo $homework['sem_homework_id']; ?>">
                    <button type="submit" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                    <i class="fa fa-trash trashstyle" ></i>
                    </button>
                    </form>                      
                    

                    </th>
                    </tr>  
                    <?php 
                    $sl++;
                    } 
                    ?>
                    </tbody>
                    </table> 


                    <div class="modal fade" id="studentModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <div class="modal-header">
                    <h5 class="modal-title">Student List</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" id="studentModalBody">
                    <div class="text-center">
                    <i class="fa fa-spinner fa-spin"></i> Loading...      

                    </div>
                    </div>
                    </div>
                    </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <form id="addHomeworkForm" enctype="multipart/form-data"  method="POST">
                    <div class="modal-body"> 
                    <input type="hidden" name="sem_group_id_mod" id="sem_group_id_mod">


                    <input type="hidden" name="sem_home_id_mod" id="sem_home_id_mod">


                    <div class="row">
                    <div class="col-md-6">
                    <label>Program Type / Program <small class="req">*</small></label>
                    <select id="program_mode" name="program_mode" class="form-control">
                    <option value="">-- Select Program --</option>
                    <?php 
                    // Build index of programs by type id for quick lookup
                    $programs_by_type = [];
                    foreach ($programs as $p) {
                    $tid = isset($p['prog_type_id']) ? $p['prog_type_id'] : null;
                    if ($tid === null) continue;
                    if (!isset($programs_by_type[$tid])) $programs_by_type[$tid] = [];
                    $programs_by_type[$tid][] = $p;
                    }
                    // Render all program types as optgroups, even if empty
                    foreach ($program_types as $type) {
                    echo '<optgroup label="'.htmlspecialchars($type['prog_type_name']).'">';
                    $list = isset($programs_by_type[$type['prog_type_id']]) ? $programs_by_type[$type['prog_type_id']] : [];
                    if (!empty($list)) {
                    foreach ($list as $prog) {
                    echo '<option value="'.$prog['p_id'].'" '.set_select('program', $prog['p_id']).'>'
                    .htmlspecialchars($prog['p_name']).
                    '</option>';
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

                    <div class="col-md-6">
                    <label>Semester <small class="req">*</small></label>
                    <select id="semester_mode" name="semester_mode" class="form-control">
                    <option value="">-- Select Semester / Term / Batch --</option>
                    <?php 
                    $current_type = '';
                    foreach ($semesters_batches as $sem): 
                    if ($current_type != $sem['st_name']) {
                    if ($current_type != '') echo '</optgroup>';
                    echo '<optgroup label="' . htmlspecialchars($sem['st_name']) . '">';
                    $current_type = $sem['st_name'];
                    }

                    // Only pass the individual IDs: semester | batch | term
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


                    <div class="col-md-6">
                    <label>Subject Groups <small class="req">*</small></label>
                    <select name="subject_group_mod" id="subject_group_mod"  class="form-control" >
                    <option value=""><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?></option>                  
                    <?php
                    foreach($subject_groups as $subjects)
                    {
                    ?>
                    <option value="<?php  echo $subjects['id'];  ?>"

                    <?php
                    if(set_value('subject_group_mod')==$subjects['id'])
                    {
                    echo "selected=selected";
                    }
                    ?>
                    ><?php  echo $subjects['name'];  ?></option>
                    <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('subject_group_mod'); ?></span>
                    </div>



                    <div class="col-md-6">
                    <label>Subjects <small class="req">*</small></label>
                    <select name="subject_mod" id="subject_mod"  class="form-control">                 
                    </select>
                    <span class="text-danger"><?php echo form_error('subject_mod'); ?></span>
                    </div>


                    <div class="col-md-6">
                    <label>Homework Date <span class="req">*</span></label>
                    <input type="date" name="homework_date" id="homework_date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                    <label>Submission Date <span class="req">*</span></label>
                    <input type="date" name="submit_date" id="submit_date" class="form-control" required>
                    </div>     


                    <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>

                    <div class="col-md-12">
                    <label>Attach Document (optional)</label>
                    <input type="file" name="document" id="document" class="form-control">
                    </div>
                    </div>
                    

                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Save Homework
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                    </button>
                    </div>

                    </form>
                    </div>
                    </div>
                    </div>


                    <!-- Add Homework Modal -->

                    <script>
                    $(function()
                    {
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

                    </div>
                    </div>
                    </div><!--./box box-primary -->
                    <?php
                    // }
                    ?>
                    </div>
                    </div>
                    </section>
                    </div>




                    <script>
                    $(document).ready(function()
                    {
                    function loadSubjectGroups(sem_group_id)
                    {             
                    // if(!sem_group_id) {
                    // $('#subject_group').html('<option value="">-- Select Subject Group --</option>');
                    // return;
                    // }

                    // AJAX call to get subject groups
                    $.ajax({
                    url: '<?php echo base_url("student_nexus/homework/get_subject_groups"); ?>',
                    method: 'POST',
                    data: { sem_group_id: sem_group_id },
                    dataType: 'json',
                    success: function(subjects){
                    var options = '<option value="">-- Select Subject Group --</option>';
                    if(subjects.length > 0){
                    $.each(subjects, function(i, sg){
                    options += '<option value="'+sg.id+'">'+sg.name+'</option>';
                    });
                    }
                    $('#subject_group').html(options);
                    }
                    });
                    }

                    // When semester changes
                    $('#semester').change(function() {
                    var sem_value = $(this).val(); // e.g. "semester|batch|term"
                    if(!sem_value) {
                    $('#subject_group').html('<option value="">-- Select Subject Group --</option>');
                    return;
                    }

                    var parts = sem_value.split('|');
                    var semester = parts[0];
                    var batch = parts[1];
                    var term = parts[2];
                    var program_id = $('#program').val();

                    if(!program_id) {
                    alert('Please select a Program first.');
                    return;
                    }

                    // Get sem_group_id from server
                    $.ajax({
                    url: '<?php echo base_url("student_nexus/homework/get_sem_group_id"); ?>',
                    method: 'POST',
                    data: { 
                    program_id: program_id, 
                    semester: semester, 
                    batch: batch, 
                    term: term 
                    },
                    dataType: 'json',
                    success: function(response){
                    loadSubjectGroups(response.sem_group_id);
                    }
                    });
                    });
                    });



                    $('#subject_group').change(function()
                    { 
                    var subject_group_id = $(this).val();
                    if(!subject_group_id) {
                    $('#subjects').html('<option value="">-- Select Subject --</option>');
                    return;
                    }
                    $.ajax({
                    url: '<?php echo base_url("student_nexus/homework/get_subjects"); ?>',
                    method: 'POST',
                    data: { subject_group_id: subject_group_id },
                    dataType: 'json',
                    success: function(subjects){
                    var options = '<option value="">-- Select Subject --</option>';
                    if(subjects.length > 0){
                    $.each(subjects, function(i, s){
                    options += '<option value="'+s.id+'">'+s.name+'</option>';
                    });
                    }
                    $('#subjects').html(options);
                    }
                    });
                    });



                    $(document).ready(function () 
                    {
                    function showSemGroupId() {
                    var program_id = $('#program_mode').val();
                    var semValue   = $('#semester_mode').val();    

                    $('#sem_group_id').val(''); // clear first

                    if (program_id === '' || semValue === '') {
                    return;
                    } 
                    var parts = semValue.split('|');
                    if (parts.length !== 3) {
                    return;
                    }
                    $.ajax({
                    url: '<?php echo base_url("student_nexus/homework/get_sem_group_id_mod"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                    program_id  : program_id,
                    semester_id : parts[0],
                    batch_id    : parts[1],
                    term_id     : parts[2]
                    },
                    success: function (res) 
                    {

                    if (res.status) 
                    {
                    $('#sem_group_id_mod').val(res.sem_group_id);
                    } 
                    else 
                    {
                    $('#sem_group_id_mod').val('Not Found');
                    }
                    }
                    });
                    }
                    $('#program_mode').on('change', showSemGroupId);
                    $('#semester_mode').on('change', showSemGroupId);
                    });





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



                    $('#subject_group_mod').change(function() 
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
                    $('#subject_mod').empty();
                    $('#subject_mod').append('<option value="">Select Subject</option>');
                    $.each(data, function(key, value) {
                    $('#subject_mod').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                    }
                    });
                    } else {
                    $('#subject_mod').empty();
                    $('#subject_mod').append('<option value="">Select Subject</option>');            }
                    });              


                    $(document).ready(function() {
                    $('#subjects').change(function() {
                    var subject_id  = $(this).val();
                    var $paper      = $('#paper');
                    $paper.empty(); // Clear previous options first
                    $paper.append('<option value="">Select Paper</option>');  // Default option

                    if(subject_id != '') 
                    {
                    $.ajax({
                    url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_papers'); ?>",
                    method: "POST",
                    data: { subject_id: subject_id },
                    dataType: "json",
                    success: function(data) {
                    if(data.length > 0) {
                    $.each(data, function(key, value) {
                    $paper.append('<option value="'+ value.sem_paper_id +'">'+ value.sem_paper_paper +'</option>');
                    });
                    } else {
                    $paper.append('<option value="">No papers available</option>');
                    }
                    }
                    });
                    }
                    });
                    });


                    $('#addHomeworkForm').on('submit', function (e) 
                    {                        

                    e.preventDefault();  

                    var formData = new FormData(this);
                    $.ajax({
                    url: "<?php echo base_url('student_nexus/homework/add_or_update'); ?>",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function (res) { 

                    if (res.status) 
                    {                       
                    $('#addHomeworkForm')[0].reset();
                    $('#addHomeworkModal').modal('hide');
                    } 
                    else
                    {
                    alert(res.message);
                    }
                    },
                    error: function () {
                    alert('Something went wrong');
                    }
                    });
                    });


                    $(document).on('click', '.viewStudents', function ()
                    {
                    var homework_id  = $(this).data('id');
                    var sem_group_id = $(this).data('sem-group');                  

                    $('#studentModal').modal('show');
                    $('#studentModalBody').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');

                    $.ajax({
                    url: "<?= base_url('student_nexus/homework/view') ?>",
                    type: "POST",
                    data: {
                    homework_id: homework_id,
                    sem_group_id: sem_group_id
                    },
                    success: function (response) 
                    {                

                    $('#studentModalBody').html(response);
                    },
                    error: function () {
                    $('#studentModalBody').html('<p class="text-danger">Failed to load students</p>');
                    }
                    });
                    });

                    //     $(document).on('click', '.editHomeworkBtn', function ()
                    //     {      
                    //       var homework_id = $(this).data('id');
                    //       var subject_id  = $(this).val('homework_id'); 
                    //       $('#sem_home_id_mod').val(homework_id);

                    //     $.ajax({
                    //         url: "<?php echo base_url('student_nexus/homework/get_homework_by_id'); ?>",
                    //         type: "POST",
                    //         dataType: "json",
                    //         data: { homework_id: homework_id },
                    //         success: function (res) 
                    //         {
                    //           console.log(res); 


                    //             $('.bd-example-modal-lg').modal('show');
                    //             $('#homework_id').val(res.data.sem_homework_id);


                    //             $('#program_mode')
                    //                 .val(res.data.sem_group_program)
                    //                 .trigger('change');


                    //             $('#semester_mode')
                    //                 .val(
                    //                     res.data.sem_group_semester + '|' +
                    //                     res.data.sem_group_batchgroup + '|' +
                    //                     res.data.sem_group_semester_term
                    //                 )
                    //                 .trigger('change');


                    //             $('#subject_group_mod')
                    //                 .val(res.data.subject_group_subject_id)
                    //                 .trigger('change');


                    //                  $('#subject_mod')
                    //                         .val(res.data.subject_id)
                    //                         .trigger('change');



                    //             $('#homework_date').val(res.data.homework_date);
                    //             $('#submit_date').val(res.data.submit_date);
                    //             $('#description').val(res.data.description);
                    //             $('#sem_group_id_mod').val(res.data.sem_group_id);
                    //         }
                    //     });
                    // });



                    $(document).on('click', '.editHomeworkBtn', function() {
                    var homework_id = $(this).data('id');
                    $('#sem_home_id_mod').val(homework_id);

                    $.ajax({
                    url: "<?php echo base_url('student_nexus/homework/get_homework_by_id'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: { homework_id: homework_id },
                    success: function(res) {
                    $('.bd-example-modal-lg').modal('show');

                    $('#homework_id').val(res.data.sem_homework_id);
                    $('#program_mode').val(res.data.sem_group_program).trigger('change');

                    $('#semester_mode')
                    .val(
                    res.data.sem_group_semester + '|' +
                    res.data.sem_group_batchgroup + '|' +
                    res.data.sem_group_semester_term
                    )
                    .trigger('change');

                    // 1️⃣ Set subject group
                    $('#subject_group_mod').val(res.data.subject_group_subject_id).trigger('change');

                    // 2️⃣ Wait for #subject_mod to populate via AJAX
                    $.ajax({
                    url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_subjects'); ?>",
                    method: "POST",
                    data: { group_id: res.data.subject_group_subject_id },
                    dataType: "json",
                    success: function(subjects) {
                    $('#subject_mod').empty();
                    $('#subject_mod').append('<option value="">Select Subject</option>');
                    $.each(subjects, function(key, value) {
                    $('#subject_mod').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });

                    // 3️⃣ Finally set the selected subject
                    $('#subject_mod').val(res.data.subject_id).trigger('change');
                    }
                    });

                    $('#homework_date').val(res.data.homework_date);
                    $('#submit_date').val(res.data.submit_date);
                    $('#description').val(res.data.description);
                    $('#sem_group_id_mod').val(res.data.sem_group_id);
                    }
                    });
                    });


                    </script>





