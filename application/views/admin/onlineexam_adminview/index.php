    <?php
    $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
    
    $result    = $this->customlib->getUserData();
    $role      = $result["user_type"];
    ?>    
    <div class="content-wrapper">
    
    <section class="content-header">
    <h1><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('online_examination'); ?></h1>
    </section>
    
    <section class="content">
    <div class="row">
    
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary" id="hroom">
    <div class="box-header ptbnull">
    <h3 class="box-title titlefix"><?php echo $this->lang->line('online_examination'); ?> </h3>
    </div><!-- /.box-header -->
    
    <div class="box-body">
    <form role="form" action="<?php echo site_url('admin/onlineexam_list/') ?>" method="post" class="row">
    <?php echo $this->customlib->getCSRF(); ?>
    <div class="col-sm-6 col-lg-3 col-md-3">
    <div class="form-group">
    <label><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req"> *</small>
    <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control select2" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    <?php
    foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
    ?>
    <option value="<?php echo $ex_group_value->id ?>" <?php
    if (set_value('exam_group_id') == $ex_group_value->id) {
    echo "selected=selected";
    }
    ?>><?php echo $ex_group_value->name; ?></option>
    <?php
    }
    ?>
    </select>
    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
    </div>  
    </div><!--./col-md-3-->
    <div class="col-sm-6 col-lg-3 col-md-3">
    <div class="form-group">   
    <label><?php echo $this->lang->line('exam'); ?></label><small class="req"> *</small>
    <select  id="exam_id" name="exam_id" class="form-control select2" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    </select>
    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
    </div>  
    </div><!--./col-md-3-->
    
    <div class="col-sm-6 col-lg-2 col-md-2">
    <div class="form-group">  
    <label><?php echo $this->lang->line('session'); ?></label><small class="req"> *</small>
    <select  id="session_id" name="session_id" class="form-control" >
    
    
    <?php
    foreach ($sessionlist as $session) {
    ?>
    <option value="<?php echo $session['id'] ?>" <?php
    if ($current_session == $session['id']) {
    echo "selected=selected";
    }
    ?>><?php echo $session['session'] ?></option>
    <?php
    }
    ?>
    </select>
    <span class="text-danger"><?php echo form_error('session_id'); ?></span>
    </div>  
    </div>
    
    <div class="col-sm-6 col-lg-2 col-md-2">
    <div class="form-group">   
    <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
    <select id="class_id" name="class_id" class="form-control" >
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
    
    <div class="col-sm-6 col-lg-2 col-md-2">
    <div class="form-group"> 
    <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
    <select  id="section_id" name="section_id" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    </select>
    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
    </div>
    </div>
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
    </div>
    </div>
    </form>
    </div>
    
    
    <?php
    if (!empty($online_examlist)) 
    {
    ?>
    <form method="post" action="<?php echo base_url('admin/onlineexam/viewsubjectpdf_byadmin') ?>" id="printCard">
    <div class="box-body">
    <div class="table-responsive mailbox-messages">
    <div class="download_label"> <?php echo $this->lang->line('online_examination'); ?> <?php echo $this->lang->line('list'); ?></div>
    <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
    <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
    <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">
    <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>">
    <input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>">
    <table class="table table-striped table-bordered table-hover example">
    <thead>
    <tr>
    <th>


    <button  class="btn btn-success btn-sm printSelected pull-right" type="submit" name="generate" title="generate multiple certificate"><?php echo $this->lang->line('generate'); ?></button>
    
    
    <br>
    <input type="checkbox" id="select_all" />
    </th>
    <th><?php echo $this->lang->line('admission_no'); ?></th>
    <th><?php echo $this->lang->line('roll_no'); ?></th>
    <th><?php echo $this->lang->line('student_name'); ?></th>
    <th><?php echo $this->lang->line('father_name'); ?></th>
    <th class=""><?php echo $this->lang->line('mobile_no'); ?></th>
    <th class=""><?php echo  $this->lang->line('staff').'&nbsp;'.$this->lang->line('status'); ?></th>
    <th class=""><?php echo  $this->lang->line('admin').'&nbsp;'.$this->lang->line('status'); ?></th>
    
   
    <?php
    if($role =="Super Admin")
    {
    ?>
    <th>Update Status</th>
    <?php } ?>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    
    <?php
    $sl=1;
    
    foreach($online_examlist as $online)
    {
    $admin_st="";
    ?>
    <tr>
    <td class="text-center"><input type="checkbox" class="checkbox center-block"  name="exam_group_class_batch_exam_student_id[]" data-student_id="<?php echo $online['online_examination_student_id']; ?>" value="<?php echo $online['online_examination_student_id']; ?>">
    
    </td>
    
    <td><?php   echo   $online['admission_no']; ?></td>
    <td><?php   echo   $online['roll_no']; ?></td>
    <td><?php   echo   $online['firstname'].''.$online['middlename'].''.$online['lastname']; ?></td>
    <td><?php   echo   $online['father_name']; ?>
    
    <input type="hidden" name="studid" id="studid<?php echo $sl; ?>" value="<?php echo $online['student_id'];?>">
    
    <input type="hidden" name="group" id="group<?php echo $sl; ?>" value="<?php echo  $online['online_examination_examgroup']; ?>">
    
    <input type="hidden" name="exambatchid" id="exambatchid<?php echo $sl; ?>" value="<?php echo $online['online_examination_exam']; ?>">
    </td>
    <td>
    <?php   echo   $online['mobileno']; ?></td>
    
    <td>
    <?php          
    
    $teacher_st= $online['online_examination_subject_status']; 
    
    if($teacher_st=='1')
    {            
    $teachst="Waiting ";
    $adbackgroundcolor="#9775b2";
    }
    
    elseif($teacher_st=='2')
    {
    $teachst="Approved";
    $adbackgroundcolor="#27a562";
    }
    
    elseif($teacher_st=='3')
    {
    $teachst="Rejected";
    $adbackgroundcolor="#a52731";
    }           
    ?>
    
    <span style="background-color:<?php  echo $adbackgroundcolor;  ?>; color:white; padding:2px 2px 2px 2px; "><?php  echo $teachst; ?></span>
    </td>
    
    <td>
    
    <?php
    
    
    
    
    $admin_st= $online['online_examination_admin_approve']; 
   
   
    if($admin_st=='1')
    {            
    $adst="Waiting ";
    $adbackgroundcolor="#9775b2";
    }
    
    elseif($admin_st=='2')
    {
    $adst="Approved";
    $adbackgroundcolor="#27a562";
    
    }
    elseif($admin_st=='3')
    {
    $adst="Rejected";
    $adbackgroundcolor="#a52731";
    }           
    ?>
    <span style="background-color:<?php  echo $adbackgroundcolor;  ?>; color:white; padding:2px 2px 2px 2px; "><?php  echo $adst; ?>
    
    </span>
    
    
    </td>
    
    
    <?php
    if($role =="Super Admin")
    {
    ?>
    
    <td>
    <select name="approvedstatus" id="approvedstatus<?php echo $sl;  ?>" class="form-control" onchange="approvesta(<?php echo $sl; ?>);">
    <option value="">Select Status </option>
    <option value="2">Approve</option>
    <option value="3">Reject</option>
    </select>
    </td>
    <input type="hidden" value="<?php  echo $admin_st;?>" id="admin_st<?php echo $sl;  ?>" />
    <td>
    <button type="button" name="getonline"  style="background-color:red;color:#fff;" onclick="delete_student_online_exam(<?php echo $sl; ?>)"> <i class="fa fa-trash"></i></button>
    </td>

    
    <?php  $sl++; } ?>
    
   
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>
    </div>
    <!-- /.table -->
    </div><!-- /.mail-box-messages -->
    </div><!-- /.box-body -->
    </form>
    
    <?php } ?>
    </div>
    </div><!--/.col (left) -->
    <!-- right column -->
    </div>
    <div class="row">
    <div class="col-md-12">
    </div><!--/.col (right) -->
    </div>   <!-- /.row -->
    </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
    
    
    <script type="text/javascript">
    
    $(document).ready(function () {
    $('.select2').select2();
    
    });
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
    var class_id = '<?php echo set_value('class_id') ?>';
    var section_id = '<?php echo set_value('section_id') ?>';
    var session_id = '<?php echo set_value('session_id') ?>';
    var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
    var exam_id = '<?php echo set_value('exam_id') ?>';
    
    getSectionByClass(class_id, section_id);
    
    getExamByExamgroup(exam_group_id, exam_id);
    $(document).on('change', '#exam_group_id', function (e) {
    $('#exam_id').html("");
    var exam_group_id = $(this).val();
    getExamByExamgroup(exam_group_id, 0);
    });
    
    $(document).on('change', '#class_id', function (e) {
    $('#section_id').html("");
    var class_id = $(this).val();
    getSectionByClass(class_id, 0);
    });
    
    function getSectionByClass(class_id, section_id)
    {
    if (class_id != "") {
    $('#section_id').html("");
    var base_url = '<?php echo base_url() ?>';
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    
    $.ajax({
    type: "GET",
    url: base_url + "sections/getByClass",
    data: {'class_id': class_id},
    dataType: "json",
    beforeSend: function () {
    $('#section_id').addClass('dropdownloading');
    },
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
    },
    complete: function () {
    $('#section_id').removeClass('dropdownloading');
    }
    });
    }
    }
    
    function getExamByExamgroup(exam_group_id, exam_id) {
    
    if (exam_group_id !== "") 
    {
    $('#exam_id').html("");
    var base_url = '<?php echo base_url() ?>';
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    
    
    $.ajax({
    type: "POST",
    url: base_url + "admin/examgroup/getExamByExamgroup",
    data: {'exam_group_id': exam_group_id},
    dataType: "json",
    beforeSend: function () {
    $('#exam_id').addClass('dropdownloading');
    },
    success: function (data) {
    $.each(data, function (i, obj)
    {
    var sel = "";
    if (exam_id === obj.id) {
    sel = "selected";
    }
    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
    });
    
    $('#exam_id').append(div_data);
    $('#exam_id').trigger('change');
    },
    complete: function () {
    $('#exam_id').removeClass('dropdownloading');
    }
    });
    }
    }
    </script>
    
    <script type="text/javascript">
    
    function approvesta(row)
    {
    job=confirm("Do You Want to Update?");
    if(job!=true)
    {
    return false;
    }
    
    var studid         =  $('#studid'+row).val();
    var group          =  $('#group'+row).val();
    var exambatchid    =  $('#exambatchid'+row).val();
    var approvedstatus =  $('#approvedstatus'+row).val();
    var class_id       =  $('#class_id').val();
    var section_id     =  $('#section_id').val();
    $.ajax({
    url: "<?php  echo site_url();?>/admin/onlineexam_list/update_approval",   
    
    type: "POST", 
    dataType:'JSON',
    data: {studid: studid,group:group,exambatchid:exambatchid,approvedstatus:approvedstatus,class_id:class_id,section_id:section_id}, 
    
    
    success:function(result)
    {
    alert(result);
    location.reload();
    }
    });
    
    
    
    if(approvedstatus=='2')
    {
    $.ajax({
    url: "<?php  echo site_url();?>/admin/onlineexam_list/send_approval",
    type: "POST", 
    dataType:'JSON',
    data: {studid: studid,group:group,exambatchid:exambatchid,approvedstatus:approvedstatus}, 
    success:function(result)
    {
    alert(result);
    }
    });
    }
    }
    
    
    function delete_student_online_exam(row)
    {
        
      
    // job=confirm("Are you sure to delete permanently?");
    // if(job!=true)
    // {
    // return false;
    // }
    var studid         =  $('#studid'+row).val();
    var group          =  $('#group'+row).val();
    var exambatchid    =  $('#exambatchid'+row).val();
    
  
    
    
    $.ajax({
    type: "POST",   
    data: {studid: studid,group:group,exambatchid:exambatchid}, 
    
    url: "<?php echo site_url('admin/onlineexam_list/delete_student_online_exam');?>",
    success:function(result)
    {
    alert("Deleted Successfully");
    }
    });
    }
    
    
    
    $(document).on('submit', 'form#printCard', function (e)
    { 
    e.preventDefault();
    var form                = $(this);
    var subsubmit_button    = $(this).find(':submit');
    var formdata            = form.serializeArray();
    var list_selected       = $('form#printCard input[name="exam_group_class_batch_exam_student_id[]"]:checked').length;
    
    if(list_selected > 0)
    {
    $.ajax({
    type: "POST",
    url: form.attr('action'),
    data: formdata, // serializes the form's elements.
    dataType: "JSON", // serializes the form's elements.
    beforeSend: function () {
    subsubmit_button.button('loading');
    },
    success: function (response)
    {
    Popup(response.page);
    
    },
    error: function (xhr) { // if error occured
    
    alert("Error occured.please try again");
    subsubmit_button.button('reset');
    },
    complete: function () {
    subsubmit_button.button('reset');
    }
    });
    }
    else
    {
    confirm("<?php echo $this->lang->line('please_select_student'); ?>");
    }
    
    });
    
    $(document).on('click', '#select_all', function () {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });
    var base_url = '<?php echo base_url() ?>';
    
    
    
    function Popup(data)
    {
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html>');
    frameDoc.document.write('<head>');
    frameDoc.document.write('<title></title>');
    // frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');
    
    frameDoc.document.write('</head>');
    frameDoc.document.write('<body>');
    frameDoc.document.write(data);
    frameDoc.document.write('</body>');
    frameDoc.document.write('</html>');
    frameDoc.document.close();
    setTimeout(function () {
    window.frames["frame1"].focus();
    window.frames["frame1"].print();
    frame1.remove();
    }, 500);
    
    return true;
    }
    </script>
