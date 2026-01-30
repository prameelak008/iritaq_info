            <script src="//cdn.ckeditor.com/4.10.0/full-all/ckeditor.js"></script>
            <style >
            
            .text-left
            {
            text-align: left !important;
            }
            </style>
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('fees'); ?> <small></small>  
            </h1>
            </section>
            <!-- Main content -->
            
            
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('fees'); ?></h3>
            </div>
            
            
            <div class="box-body">
            
            <?php echo $this->customlib->getCSRF(); ?>
            
            <form role="form" action="<?php echo site_url('admin/examapplicationfees/index') ?>" method="post" >
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
            <button type="submit"   name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
            </div>
            </div>
            </div>
            </form>
            </div>
            
            
            <?php

            
            if(isset($getsubjectdetails))
            { 
            ?>
            
            <div class="row">        
            <div class="col-md-12">    
            <div class="box-header ptbnull">
            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('exam') . " " . $this->lang->line('list') ; ?></h3>                
            </div>
            <div class="box-body">
            <div class="download_label"><?php echo $this->lang->line('exam') .''. $this->lang->line('list'); ?></div>
            <div class="mailbox-messages table-responsive">


                
            
            <form role="form" action="<?php echo site_url('admin/examapplicationfees/getfees') ?>" method="post" >           
            
            <table class="table table-hover table-striped table-bordered example">
            <thead>
            <tr>
            <th><?php echo $this->lang->line('slno'); ?></th>                                  
            <th><?php echo $this->lang->line('name'); ?></th>
            <th><?php echo $this->lang->line('code'); ?></th>
            <th><?php echo $this->lang->line('fees'); ?></th>
            <th><?php echo $this->lang->line('fine'); ?></th>                                        
            
            </tr>
            </thead>
            <tbody>
            
            <?php
            
            $sl=1;
            foreach($getsubjectdetails as $getsubject)
            {
            
            // $su             = explode('-',$getsubject['code']);
            // $sscode         = $su[1]; 
            
            $su     = explode('-', $getsubject['code']); 
            $sscode = end($su); 
            ?> 
            <tr>
            <td><?php   echo $sl; ?></td> 
            <td>
            
            <input type="hidden" name="session_id[]" value="<?php  echo $session_id;  ?>"/>
            
            <input type="hidden" name="exam_group_id[]" value="<?php  echo $exam_group_id;  ?>"/>
            
            <input type="hidden" name="exam_id[]" value="<?php  echo $exam_id;  ?>"/>
            
            <input type="hidden" name="class_id[]" value="<?php  echo $class_id;  ?>"/>
            <input type="hidden" name="section_id[]" value="<?php  echo $section_id;  ?>"/>
            
            <input type="hidden" name="subj_id[]" value="<?php echo $getsubject['subjectid'];  ?>">
            <input type="hidden" name="subj_code[]" value="<?php echo $sscode;  ?>">
            <?php echo $getsubject['name'];  ?></td>
            <td><?php echo $getsubject['code'];  ?></td>
            <td>
            
            <?php
            foreach($getfeedetails as $getfee) 
            {
            if($exam_group_id==$getfee['application_fees_examgroup'] && $exam_id==$getfee['application_fees_examgroupbatch'] && $class_id==$getfee['application_fees_class'] 
            && $getsubject['subjectid']==$getfee['application_fees_subjectid'])
            {
            $getf       =   $getfee['application_fees_fees'];
            $getfine    =   $getfee['application_fees_finefees'];
            $fid        =   $getfee['application_fees_id'];
            }
            }
            ?>
            <input type="hidden" name="fid[]" class="form-control" value="<?php echo  $fid ; ?>">
            <input type="text" name="fees[]" class="form-control" value="<?php echo  $getf ; ?>">
            </td>
            
            <td>
            <input type="text" name="finefees[]" class="form-control" value="<?php echo $getfine;  ?>">
            </td>
            
            </tr>
            <?php
            $sl++; 
            
            }
            ?>
                       
            </tbody>                                       
            </table>
            
            <button type="submit"   name="findfee" value="Find Fee" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-save"></i> <?php echo $this->lang->line('save'); ?>
            </button>
            </form>
            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Add Fees
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('exam').'&nbsp;&nbsp;'.$this->lang->line('fees'); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            
            <div class="modal-body">
            
            <form role="form" action="<?php echo site_url('admin/examapplicationfees/addapplicationfees') ?>" method="post" >
                
            <input type="hidden" name="applicationfee_id" class="form-control"  value="<?php  echo $applicationfee['application_examfee_id'];  ?>">
            
            Application Fee<input type="text" name="applicationfee" class="form-control"  value="<?php  echo $applicationfee['application_examfee_fees'];  ?>">
            Fine Fee<input type="text" name="application_finefee" class="form-control"  value="<?php echo $applicationfee['application_examfee_finefees'];  ?>">
            
            Mark List Fee<input type="text" name="marklistfee" class="form-control"  value="<?php echo $applicationfee['application_examfee_marklistfee'];  ?>">
            
            
            Evaluation Camp Fee<input type="text" name="evaluationcampfee" class="form-control" value="<?php echo $applicationfee['application_examfee_evaluationcampfee'];  ?>">
            
            
            Fine Date<input type="date" name="finedate" class="form-control" value="<?php echo $applicationfee['application_examfee_finedate'];  ?>">
            
            
            Processing Fees
            
            <br>
            <input type="text" name="processingfees" class="form-control" value="<?php echo $applicationfee['application_examfee_processingfees'];  ?>">
            Payment Title
            <br>
            <textarea class="form-control ckeditor" name="paymenttitle" rows="6" cols="4"><?php echo $applicationfee['application_examfee_paymenttitle'];  ?></textarea>
            Payment Terms
            <br> 
            <textarea class="form-control ckeditor" name="paymentterms" rows="6" cols="4"><?php echo $applicationfee['application_examfee_paymentterms'];  ?></textarea>
            
            <input type="hidden" name="session_in" value="<?php  echo $session_id;  ?>"/>
            
            <input type="hidden" name="exam_group_in" value="<?php  echo $exam_group_id;  ?>"/>
            
            <input type="hidden" name="exam_in" value="<?php  echo $exam_id;  ?>"/>
            
            <input type="hidden" name="class_in" value="<?php  echo $class_id;  ?>"/>
            <input type="hidden" name="section_in" value="<?php  echo $section_id;  ?>"/>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"   name="findfee" class="btn btn-primary">SAVE</button>
            </div>
            </form>
            
            </div>
            
            </div>
            </div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
            </div>
            </div>
            </div>
            
            
            <?php } ?>
            
            
            </div>
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
            
            
            
            
            /*$.ajax({
            type: "POST",   
            data: {exam_id:exam_id}, 
            
            url: "<?php echo site_url('admin/valuationmarkentry/getsubject');?>",
            success:function(result)
            {                                
            
            var jsondata= JSON.parse(result);
            //$('#subjectname').html('<option value=""></option>');                        
            $.each(jsondata, function(key, value) 
            {
            
            // $('select[name="subjectname"]').append('<option value="'+ value.subject_id +'">'+ value.code +' - '+ value.name +'</option>');
            var sub=value.subject_id
            
            $('#subjectlist').val(sub); 
            
            });                              
            }
            });
            */
            
            }
            
            
            
            
            
            
            
            
            
            /*                         
            $.ajax({
            type: "POST",   
            data: {exam_id:exam_id}, 
            
            url: "<?php echo site_url('admin/valuationmarkentry/getsubject');?>",
            success:function(result)
            {
            
            
            $('#sub').html(result); 
            
            }
            }); */
            
            
            /* var exam_id    =   $('#exam_id').val();  
            $.ajax({
            type: "POST",   
            data: {exam_id:exam_id}, 
            
            url: "<?php echo site_url('admin/valuationmarkentry/getsubject');?>",
            success:function(result)
            {                                
            
            var jsondata= JSON.parse(result);
            $('#subjectname').html('<option value=""></option>');                        
            $.each(jsondata, function(key, value) 
            {
            
            $('select[name="subjectname"]').append('<option value="'+ value.subject_id +'">'+ value.code +' - '+ value.name +'</option>');
            var sub=value.subject_id
            
            $('#subjectlist').val(sub); 
            
            });                              
            }
            });           
            
            }*/
            
            
            
            
            function gettsudentlist()
            {
            
            var exam_group_id =  $('#exam_group_id').val();
            var exam_id       =  $('#exam_id').val();
            
            var class_id      =  $('#class_id').val();
            var section_id  =   $('#section_id').val();
            var subjectname   = $('#subjectname').val();
            var exam_group_id    =  $('#exam_group_id').val();
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
            var student                    =  $('#student'+row).val();            
            
            var exam_group_exam_studentid  =  $('#exam_group_exam_revaluation_studentid'+row).val();
            var post_exam_id                =  $('#post_exam_id'+row).val(); 
            
            var post_exam_group_id          =  $('#post_exam_group_id'+row).val();
            
            
            
            $.ajax({
            type: "POST",   
            data: {student:student,exam_group_exam_studentid:exam_group_exam_studentid,post_exam_id:post_exam_id,post_exam_group_id:post_exam_group_id},  
            url: "<?php echo site_url('admin/revaluation/getstudent_revaluationlist_modal');?>",
            success:function(result)
            {
            
            
            $('#myModal').modal("show");
            $('#mod').html(result);
            
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
            
            </script>