
                    <style >
                    .text-left
                    {
                    text-align: left !important;
                    }

                    .candidate-details-simple {
                    background: #fff;
                    border: 1px solid #e3e6f0;
                    border-left: 4px solid #3c8dbc;
                    padding: 20px;
                    border-radius: 6px;
                    margin-bottom: 25px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                    }

                    .detail-row {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                    }

                    .detail-label {
                    font-size: 14px;
                    font-weight: 600;
                    color: #5a5c69;
                    min-width: 140px;
                    }

                    .detail-value {
                    font-size: 16px;
                    font-weight: 600;
                    color: #2c3e50;
                    }

                    </style>


                    <div class="content-wrapper" style="min-height: 946px;">
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-map-o"></i>Forward Enroll <small><?php echo $this->lang->line('Students') ; ?></small>  
                    </h1>
                    </section>
                    <!-- Main content -->
                    <section class="content">

                    <div class="col-md-12">
                    <?php
                    $this->load->view('layout/topbar_enrollment'); ?>
                    </div>
                    &nbsp;

                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i><?php echo $this->lang->line('enroll').'&nbsp;&nbsp;'.$this->lang->line('candidates') ; ?> </h3>
                    </div>

                    <div class="box-body">

                    <!-- <h4 class="pagetitleh2">Candidate Details : <br><br>
                    Name  : <?php  echo $admission_name; ?>


                    <br>
                    </h4>
                    <br> -->

                    <!-- Candidate Details Section -->
                    <div class="candidate-details-simple">
                    <div class="detail-row">
                    <span class="detail-label">Candidate Name:</span>
                    <span class="detail-value"><?php echo $admission_name; ?></span>
                    </div>
                    </div>
                    <h4 class="pagetitleh2">Enrol Session Details</h4>
                    <br>



                    <div id="modelError"></div>
                    <form name="form" id="form" method="POST" action="<?php echo site_url('semester_enrollment/Enroll/add_frwdenrol');  ?>" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" name="admission_name" value="<?php echo $admission_name;   ?>" />
                    <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>" />                   
                    <br>

                    </div>

                    <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label><small class="req"> *</small>
                    <select name="program_type" id="program_type" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select').'&nbsp;'.$this->lang->line('type'); ?></option>

                    <?php
                    foreach($Programmetype_list as $prog_type)
                    {
                    ?>
                    <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
                    <?php 
                    }
                    ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('program_type'); ?></span>
                    </div>
                    </div>



                    <div class="col-sm-2">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label><small class="req"> *</small>
                    <select name="programe" id="programe" class="form-control">
                     <option value=""><?php echo $this->lang->line('select').'&nbsp;'. $this->lang->line('programee'); ?></option>
                    </select>
                    </div>
                    </div>

                    <div class="col-sm-2">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('batch'); ?></label><small class="req"> *</small>

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
                    </div>
                    </div>


                    <div class="col-sm-2">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?></label><small class="req"> *</small>
                    <select name="semester_semtype" id="semester_semtype" class="form-control" >
                    <option value=""><?php  echo $this->lang->line('select').'&nbsp;'.$this->lang->line('semester_type'); ?></option>
                    <?php
                    foreach($semestertype_list as $sem_type)
                    {
                    ?>
                    <option value="<?php  echo $sem_type['st_id'];  ?>"

                    <?php
                    if(set_value('semester_type')==$sem_type['st_id'])
                    {
                    echo "selected=selected";
                    }
                    ?>
                    ><?php  echo $sem_type['st_name'];  ?></option>
                    <?php } ?>
                    </select>
                    </div>
                    </div>


                    <input type="hidden" name="sem_group_id" id="sem_group_id" value="" >   

                    <div class="col-sm-2">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_term'); ?></label><small class="req"> *</small>
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

                    </div>
                    </div>
                    </div>
                    <br>
                   

                    <div class="row">

                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('admission_no'); ?></label><small class="req"> *</small>
                    <input type="text" name="admission_no" id="admission_no"  value="<?php if($students_regid['admission_no']!="") 
                    {echo $students_regid['admission_no']; } else {  echo ++$max_studentsid['admission_no']; } ?>" class="form-control"/>
                    <span class="text-danger"><?php echo form_error('admission_no'); ?></span>
                    </div>
                    </div>


                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('roll_no'); ?></label><small class="req"> *</small>
                    <input type="text" name="roll_no" id="roll_no" class="form-control"   value="<?php
                    if($students_regid['roll_no']!="") 
                    { echo $students_regid['roll_no']; } else { echo ++$max_rollid['roll_no']; } ?>"/>
                    <span class="text-danger"><?php echo form_error('roll_no'); ?></span>
                    </div>
                    </div>



                    <div class="col-md-4">
                    <div class="form-group">
                    <button type="button"  name="search" value="search_filter" onclick="generate_id()" class="btn btn-success pull-right btn-sm checkbox-toggle"><?php echo $this->lang->line('generate'); ?></button>
                    </div>
                    </div>
                    </div>
                    <br>
                    <br>

                    <br>
                    <h4 class="pagetitleh2">Upload Documents</h4>
                    <br>

                    <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('adhaar'); ?></label>
                    <input class="filestyle form-control" type='file' name='adhaar' id="adhaar" size='20' />


                    </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('affidavit'); ?></label>
                    <input class="filestyle form-control" type='file' name='affidavit'   id="affidavit" size='20' />


                    </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('ration'); ?></label>
                    <input class="filestyle form-control" type='file' name='ration'  id="ration" size='20' />
                    </div>
                    </div>
                    </div>



                    <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('document'); ?>&nbsp;1</label>
                    <!--<input type="text" name="adhaar_no"  id="adhaar_no" class="form-control"/>-->
                    <input class="filestyle form-control" type='file' name='document_one'   id="document_one" size='20' />
                    </div>
                    </div>



                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('document'); ?>&nbsp;2</label>
                    <!--<input type="text" name="affidavit_no" id="affidavit_no"  class="form-control"/>-->
                    <input class="filestyle form-control" type='file' name='document_two'   id="document_two" size='20' />
                    </div>
                    </div>



                    <div class="col-md-4">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('document'); ?>&nbsp;3</label>
                    <!--<input type="text" name="ration_no" id="ration_no"  class="form-control"/>-->
                    <input class="filestyle form-control" type='file' name='document_three'   id="document_three" size='20' />
                    </div>
                    </div>
                    </div>



                    <h4 class="pagetitleh2">Fee Payment Details</h4>
                    <br>
                    <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('category'); ?></label><small class="req"> *</small>
                    <select name="category" id="category" class="form-control" >
                    <option value="">Select Category</option>
                    category_id
                    <?php
                    foreach($categorylist as $cate)
                    {
                    ?>
                    <option value="<?php echo $cate['id']; ?>" <?php
                    if ($students_regid['category_id'] == $cate['id']) {
                    echo "selected=selected";
                    }
                    ?>><?php echo $cate['category']; ?></option>
                    <?php  } ?>
                    </select>

                    <span class="text-danger"><?php echo form_error('category'); ?></span>
                    </div>
                    </div>



                    <div class="col-md-3">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('receipt_no'); ?></label>
                    <input type="text" name="receipt" id="receipt" value="<?php echo $students_regid['studentfees_receiptno'];  ?>" class="form-control"/>
                    </div>
                    </div>



                    <div class="col-md-3">
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label>
                    <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $students_regid['studentfees_feesamount'];  ?>"/>
                    </div>
                    </div>

                    <?php
                    if($students_regid['studentfees_feesamount']!="")
                    {
                    ?>
                    <div class="col-md-3">
                    <div class="form-group">
                    <button type="button"  name="search" value="search_filter" id="btnPrint" class="btn btn-success pull-right btn-sm checkbox-toggle"><?php echo $this->lang->line('print').'&nbsp;'.$this->lang->line('receipt'); ?></button>
                    </div>
                    </div>
                    <?php } ?>
                    </div>
                    <?php
                    if($students_regid['entrance_reg_id']!="")
                    {
                    $st="btn btn-success";  
                    }
                    else
                    {
                    $st="btn btn-danger";   
                    }
                    ?>
                    <div class="col-sm-12">
                    <div class="form-group">
                    <input type="hidden" name="student_reg_id" id="student_reg_id" value="<?php echo $students_regid['entrance_reg_id']; ?>" />
                    <?php
                    if($students_regid['entrance_reg_id']!="")
                    {
                    ?>
                    <button type="button"  name="search" value="search_filter" class="btn btn-warning pull-right btn-sm checkbox-toggle"><i class='fa fa-check  pull-right btn-sm checkbox-toggle'></i>Successfully Enrolled </button>
                    <?php
                    }
                    else
                    {
                    ?>
                    <button type="submit"  name="search" value="search_filter" class="<?php  echo $st; ?> pull-right btn-sm checkbox-toggle">&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('enroll'); ?>&nbsp;&nbsp;&nbsp;</button>
                    <?php
                    }
                    ?> 
                    </div>
                    </div>
                    </form>


                    <br>
                    </div>
                    <div>
                    </div>
                    </section>
                    </div>



                    <script type="text/javascript">
                    $(document).ready(function (e) {
                    $("#form").on('submit', (function (e) 
                    {
                    e.preventDefault();

                    job=confirm("It will send whatsapp messages .Do you want to proceed?");
                   
                    if(job!=true)
                    {
                    return false;
                    }
                    else
                    {
                    $.ajax({
                    url: "<?php echo site_url("semester_enrollment/Enroll/add_frwdenrol") ?>",
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {

                    if (data.status == "fail") {

                    var message = "";
                    $.each(data.error, function (index, value) {

                    message += value;
                    });
                    errorMsg(message);
                    } else {

                    successMsg(data.message);
                    window.location.reload(true);
                    }
                    }
                    });
                    }
                    }));
                    });

                    $('#select_all').click(function () {    
                    $('input:checkbox').prop('checked', this.checked);    
                    });
                    $(document).ready(function () 
                    {
                    $('#admission_no').hide();
                    $('#roll_no').hide();
                    $('.select2').select2();
                    });
                    $(document).ready(function () {
                    $.extend($.fn.dataTable.defaults, {
                    searching: true,
                    ordering: true,
                    paging: false,
                    retrieve: true,
                    destroy: true,
                    info: false
                    });
                    });
                    $(document).on('change', '#entrance_course', function (e) 
                    {
                    var entrance_course = $(this).val();
                    getinstitutebycourse(entrance_course, 0);
                    });
                    function getinstitutebycourse(entrance_course, entrance_institute) 
                    {
                    var entrance_course     = $('#entrance_course').val();
                    var session             = $('#session').val();
                    var entrance_institute  = $('#entrance_institute').val();


                    if (entrance_course !== "") 
                    {
                    $('#entrance_institute').html("");

                    var base_url = '<?php echo base_url() ?>';
                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

                    $.ajax({
                    type: "POST",
                    url: base_url + "entrance_allotment/allotment/getinstitute",
                    data: {'entrance_course': entrance_course},
                    dataType: "json",
                    // beforeSend: function () {
                    //     $('#exam_id').addClass('dropdownloading');
                    // },
                    success: function (data) 
                    { 

                    $.each(data, function (i, obj)
                    {
                    var sel = "";
                    if (entrance_institute == obj.entranceexam_insituteid)
                    {
                    sel = "selected";
                    }
                    div_data += "<option value=" + obj.entranceexam_insituteid + " " + sel + ">" + obj.entranceexam_insitutename + "</option>";

                    });


                    $('#entrance_institute').append(div_data);
                    $('#entrance_institute').trigger('change');
                    },

                    complete: function () {
                    $('#entrance_institute').removeClass('dropdownloading');
                    }
                    });
                    }
                    }



                   

                    


                 



                    function generate_id() {
                    $('#admission_no').show();
                    $('#roll_no').show();

                    const selectedSessionText = $('#session_id option:selected').text(); // e.g. "2025-26"

                    if (!selectedSessionText || selectedSessionText.trim() === "" || selectedSessionText === "Select") {
                    alert("Please select Enroll session");
                    return; // Stop further execution
                    }

                    const sessionYearSuffix = selectedSessionText.split('-')[0].slice(2); // "25"

                    let currentRollNo = $('#roll_no').val(); // May be empty if coming from max_rollid

                    if (currentRollNo && currentRollNo.trim() !== "") {
                    // Replace the digits after "JJ" with the session year suffix
                    let updatedRollNo = currentRollNo.replace(/(JJ)\d{2}/, `$1${sessionYearSuffix}`);
                    $('#roll_no').val(updatedRollNo);
                    } else {
                    // fallback to PHP-generated max_rollid
                    const fallbackRollNo = "<?= $max_rollid['roll_no']; ?>"; // e.g. JJ30SE129
                    let updatedFallback = fallbackRollNo.replace(/(JJ)\d{2}/, `$1${sessionYearSuffix}`);
                    $('#roll_no').val(updatedFallback);
                    }
                    }








                    $("#btnPrint").on("click", function() 
                    {
                    var student_reg_id      = $("#student_reg_id").val();
                    $.ajax({
                    type : "POST",
                    url: base_url + "admin/Enroll/printreceipt",
                    data: {student_reg_id:student_reg_id},       
                    datatype : 'JSON',
                    success:function(data)
                    {
                    var ht = $(window).height();
                    var wt = $(window).width();
                    var divContents = $("#print_content").html();
                    var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
                    printWindow.document.write('<html><head><title><?php  echo $this->customlib->getAppName(); ?>  </title>');
                    printWindow.document.write('<link href="<?=base_url()?>web_assets/css/bootstrap.css" rel="stylesheet" media="screen">  <link href="<?=base_url()?>web_assets/css/custom.css" rel="stylesheet" media="screen">');
                    printWindow.document.write('</head><body>');
                    printWindow.document.write(data);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print(); 
                    },
                    });
                    });





                    </script>


                    <script type="text/javascript">


                    $(document).ready(function()
                    {

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


                    // $('#program_type').change(function()
                    // { 
                    // var prog_type_id = $(this).val();
                    // if(prog_type_id != ''){
                    // $.ajax({
                    // url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
                    // method: "POST",
                    // data: { prog_type_id: prog_type_id },
                    // dataType: "json",
                    // success: function(data){
                    // $('#programe').empty();
                    // $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                    // $.each(data, function(key, value){
                    // $('#programe').append('<option value="'+ value.id +'">'+ value.p_name +'</option>');
                    // });
                    // }
                    // });
                    // } else {
                    // $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                    // }
                    // }); 




                    $('#programe, #batch_group, #semester_semtype,#semester_term').change(function() 
                    {
                    var prog      = $('#programe').val();
                    var bat       = $('#batch_group').val();
                    var sem       = $('#semester_semtype').val(); 
                    var sem_term  = $('#semester_term').val();

                    if( prog && bat && sem && sem_term) 
                    {
                    $.ajax({
                    url: '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
                    type: 'POST',
                    data: { 
                    prog   : prog,
                    bat    : bat,
                    sem    : sem,
                    sem_term:sem_term,
                    },
                    success: function(response) 
                    {
                    var res = JSON.parse(response);  // Convert string to object 
                    console.log(res.sem_group_id);  
                    $('#sem_group_id').val(res.sem_group_id); 
                    $('#sem_group_id').trigger('change');
                    }
                    });
                    }
                    else {
                    // Clear sem_group_id when any required field is empty
                    $('#sem_group_id').val('');
                    $('#sem_group_id').trigger('change');  // Optional: To handle downstream logic if needed
                    console.log('sem_group_id cleared because prog, bat, or sem is empty');
                    }
                    });

                    }); 




                    </script>