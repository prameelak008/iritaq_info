            
            <style>
            .text-left
            {
            text-align: left !important;
            }
            </style>
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('sayexam'); ?> <small></small>  
            </h1>
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('sayexam'); ?></h3>
            </div>
            
            
            <div class="box-body">
            <form role="form" action="<?php echo site_url('admin/sayexamte/sayexam_attempts') ?>" method="post" >
            <?php echo $this->customlib->getCSRF(); ?>
            
            <div class="row">
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
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
            </div>
            <!--./col-md-3-->    
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo $this->lang->line('exam') ?></label><small class="req"> *</small>
            <select  id="exam_id" name="exam_id" class="form-control select2"  >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>
            </div>
            
            <!--./col-md-3-->
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo $this->lang->line('session'); ?></label><small class="req"> *</small>
            <select  id="session_id" name="session_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
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
            
            
            <!--./col-md-3-->
            <div class="col-sm-6 col-lg-3 col-md-12 col20">
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
            
            <div class="col-sm-6 col-lg-3 col-md-12 col20">
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
            <button type="submit"  name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
            </div>
            </div>
            
            </div>
            </form>
            </div>
            
            
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Say Exam Details </h4>
            </div>
            <div class="modal-body">
            <div style="width:100%;" id="mod">
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            
            <?php
            if (isset($sayexam)) 
            {
            ?> 
            <div class="" >
            <div class="box-header ptbnull"></div>
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo  $this->lang->line('sayexam'); ?></h3>
            </div>
            
            
            <div class="box-body">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <div class="download_label">
            <span style=""><h1><?php echo $this->lang->line('application_for_sayexam').'&nbsp;'.$this->lang->line('TE').'&nbsp;-&nbsp;'.$sess['session'];?></h1></span>
            <br>
            <span style=""><h5>
            <?php
            echo $getgroup_name['name'].'&nbsp;'.$getgroup_name['exam']; 
            echo "<br>";
            echo  $get_class_section['class'].'&nbsp;-&nbsp;'. $get_class_section['section'];
            
            ?>
            </h5>
            </span>
            </div>
            
            
            
            <?php                 
            $sl=1;
            if (isset($sayexam)) 
            {
            ?>
            
            <form name="frm" method="POST" action="<?php echo site_url('admin/sayexamte/sayexam_attempts');?>" id="printCard"> 
            
            <button id="refreshButton" class="btn btn-danger btn-sm pull-right" style="margin-left:4px;margin-right:4px;" type="button" name="refresh" title="Refresh Page">
                <i class="fa fa-refresh"> <?php echo $this->lang->line('refresh'); ?></i>
                </button>
            
            <button  class="btn btn-info btn-sm printSelected pull-right" type="submit" name="generate" title="generate multiple certificate">
            <?php echo $this->lang->line('generate'); ?></button>  
            
            <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
            
            <thead>
            <tr>
            <th><input type="checkbox" id="select_all" /></th>
            <th><?php echo $this->lang->line('sl_no'); ?></th>
            <th><?php echo $this->lang->line('student_name'); ?></th>
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('roll_no'); ?></th>
            <th><?php echo $this->lang->line('email'); ?></th>
            <th><?php echo $this->lang->line('mobile_no'); ?></th>
            <th><?php echo $this->lang->line('update'); ?></th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach($sayexam as $sy) {
            ?>
            <tr>
            <td>
            <input type="checkbox" class="checkbox center-block"  name="exam_group_class_batch_exam_student_id[]" data-student_id="<?php echo $sy['Studentid']; ?>" value="<?php echo $sy['Studentid']; ?>">
            </td> 
            
            <td><?php   echo $sl;  ?></td>
            <td><?php   echo $sy['firstname'].''.$sy['middlename'] .''.$sy['lastname']  ?></td>
            <td><?php   echo $sy['admission_no']; ?></td>
            <td><?php   echo $sy['roll_no']; ?></td>
            <td><?php   echo $sy['email']; ?></td>
            <td><?php   echo $sy['mobileno']; ?></td>
          
            <td>
            <input type="hidden" name="student" id="student<?php echo $sl; ?>" value="<?php echo $sy['Studentid']; ?>">
            
            <input type="hidden" name="post_exam_id" id="post_exam_id<?php echo $sl; ?>" value="<?php echo $sy['exam_group_exam_sayexam_examid']; ?>">
            
            
            
            <input type="hidden" name="session_id" id="session_id<?php echo $sl; ?>" value="<?php  echo $session_id; ?>"/>
            <input type="hidden" name="class_id" id="class_id<?php echo $sl; ?>" value="<?php  echo $class_id; ?>"/>
            <input type="hidden" name="section_id" id="section_id<?php echo $sl; ?>" value="<?php  echo $section_id; ?>"/>
            
            <input type="hidden" name="exam_group_exam_sayexam_studentid" id="exam_group_exam_sayexam_studentid<?php echo $sl; ?>" value="<?php echo $sy['exam_group_exam_sayexam_studentid']; ?>">
            
            <input type="hidden" name="student" id="student<?php echo $sl; ?>" value="<?php echo $sy['Studentid']; ?>">
            
            <input type="hidden" name="post_exam_group_id" id="post_exam_group_id<?php echo $sl; ?>" value="<?php echo $sy['exam_group_exam_sayexam_examgroupid']; ?>">
            
            
            <button type="button" title="Update"   onclick="getdata(<?php echo $sl; ?>)" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i></button></td>
            
            </tr>
            
            <?php 
            $sl++;
            } ?>
            </tbody>
            </table>
            </form>
            <?php } ?>
            </div>
            </div>
            </div>
            </div>
            <?php
            }
            ?>
            </div>
            </div>
            </section>
            </div>
            
            
            
            
            <script type="text/javascript">
            
            $(document).ready(function () 
            {
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
            
            var date_format    = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
            var class_id       = '<?php echo set_value('class_id') ?>';
            var section_id     = '<?php echo set_value('section_id') ?>';
            var exam_group_id  = '<?php echo set_value('exam_group_id') ?>';
            var exam_id        = '<?php echo set_value('exam_id') ?>';
            var subjectname    = '<?php echo set_value('subjectname') ?>';
            getSectionByClass(class_id, section_id);
            
            // getExamgroupByClassSectionSession(class_id, section_id, session_id);
            getExamByExamgroup(exam_group_id, exam_id);
            
            getSubjectByExamgroup(exam_id, subjectname);
            
            
            $(document).on('change', '#exam_group_id', function (e) 
            {
            $('#exam_id').html("");
            var exam_group_id = $(this).val();
            getExamByExamgroup(exam_group_id, 0);
            });
            
            
            
            $(document).on('change', '#exam_id', function (e) 
            {       
            $('#subjectname').html("");
            var exam_id = $(this).val();
            getSubjectByExamgroup(exam_id, 0);
            });
            
            
            
            
            $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            getSectionByClass(class_id, 0);
            });
            
            
            function getSectionByClass(class_id, section_id) 
            {
            
            if (class_id !== "") {
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
            if (section_id === obj.section_id) {
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
            
            
            function getExamByExamgroup(exam_group_id, exam_id) 
            {        
            
            if (exam_group_id !== "") {
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
            
            
            
            
            function getSubjectByExamgroup(exam_id, subjectname) 
            {        
            
            if (exam_id !== "") {
            $('#subjectname').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_dataa = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            
            
            $.ajax({
            type: "POST",
            url: base_url + "admin/valuationmarkentry/getsubject",
            data: {'exam_id': exam_id},
            dataType: "json",
            beforeSend: function () {
            $('#exam_id').addClass('dropdownloading');
            },
            success: function (data) 
            {
            $.each(data, function (i, obj)
            {
            var sel = "";
            if (subjectname === obj.subject_id) {
            sel = "selected";
            
            var sub=obj.subject_id;
            $('#subjectlist').val(sub);
            
            
            }
            div_dataa += "<option value=" + obj.subject_id + " " + sel + ">" + obj.subject_id +'-'+ obj.code +'-'+ obj.name + "</option>";
            
            
            
            
            });
            
            $('#subjectname').append(div_dataa);
            $('#subjectname').trigger('change');
            },
            complete: function () {
            $('#subjectname').removeClass('dropdownloading');
            }
            });
            }
            }
            
            
            
            
            
            function gettsudentlist()
            {
            
            var exam_group_id =  $('#exam_group_id').val();
            var exam_id       =  $('#exam_id').val();
            
            var class_id      =  $('#class_id').val();
            var section_id  =   $('#section_id').val();
            var subjectname   = $('#subjectname').val();
            var exam_group_id =  $('#exam_group_id').val();
            var session_id       =  $('#session_id').val();
            
            
            
            
            $.ajax({
            type: "POST",   
            data: {exam_group_id:exam_group_id,exam_id:exam_id,class_id:class_id,session_id:session_id,section_id:section_id,subjectname:subjectname}, 
            
            url: "<?php echo site_url('admin/valuationmarkentry/getsubjecttet');?>",
            success:function(result)
            {
            
            //alert(result); 
            $('#pages').val(result);
            }
            });
            
            }
            
            
            
            
            
            
            
            
            function getdata(row)
            {
            
            var student                     =  $('#student'+row).val();            
            
            var exam_group_exam_studentid   =  $('#exam_group_exam_sayexam_studentid'+row).val();
            var post_exam_id                =  $('#post_exam_id'+row).val(); 
            
            var post_exam_group_id          =  $('#post_exam_group_id'+row).val();
            
            
            
            
            $.ajax({
            type: "POST",   
            data: {student:student,exam_group_exam_studentid:exam_group_exam_studentid,post_exam_id:post_exam_id,post_exam_group_id:post_exam_group_id},  
            url: "<?php echo site_url('admin/sayexamte/getstudent_sayexamtelist_modal');?>",
            success:function(result)
            {
            
            
            $('#myModal').modal("show");
            $('#mod').html(result);
            // Popup(result.page);
            }
            });
            }
            
            
            
            
            $(document).on('click', '#select_all', function ()
            {
            
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
            
            });
            
            </script>
            
            
            
            <script>
            
            $(document).on('submit', 'form#printCard', function (e)
            {
            e.preventDefault();
            var form                = $(this);
            var subsubmit_button    = $(this).find(':submit');
            var formdata            = form.serializeArray();
            
            var list_selected       =  $('form#printCard input[name="exam_group_class_batch_exam_student_id[]"]:checked').length;
            
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
            // $('.rrrrrr').html(response.page);
            
            },
            error: function (xhr) { // if error occured
            
            alert("Error occured.please try again");
            subsubmit_button.button('reset');
            },
            complete: function () {
            subsubmit_button.button('reset');
            }
            });
            }else{
            confirm("<?php echo $this->lang->line('please_select_student'); ?>");
            }
            
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
            
            
             document.getElementById('refreshButton').addEventListener('click', function() {
                location.reload();
                });
            
            </script>