
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border"  style="text-align:center;">
            <h3 class="box-title"><i class="fa fa-search"></i><b> <?php echo $this->lang->line('onlineExamination'); ?></b></h3>
            </div>


            <div class="box-body">


            <form role="form" action="<?php echo site_url('admin/onlineexam/onlineExamination_by_class') ?>" method="post" >
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


            </form>

            </div>


            </div>

            <div  class="" >
            <div class="box-header ptbnull"></div> 


            <div class="box-body">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">

            <div class="download_label"> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></div>

            <?php



            if (!empty($subjectlist)) 
            {
            ?>
            <form method="post" action="<?php echo base_url('admin/onlineexam/viewsubjectpdf_byadmin') ?>" id="printCard">
            <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <div class="download_label"> <?php echo $this->lang->line('online_examination'); ?> <?php echo $this->lang->line('list'); ?></div>
            <!-- <input type="text" name="post_exam_id" value="<?php echo $exam_id; ?>">
            <input type="text" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
            <input type="text" name="session_id" value="<?php echo $session_id; ?>">
            <input type="text" name="class_id" id="class_id" value="<?php echo $class_id; ?>">
            <input type="text" name="section_id" id="section_id" value="<?php echo $section_id; ?>"> -->
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <!--   
            <th>
            <button  class="btn btn-success btn-sm printSelected pull-right" type="submit" name="generate" title="generate multiple certificate"><?php echo $this->lang->line('generate'); ?></button> 


            <br>
            <input type="checkbox" id="select_all" />
            </th>-->

            <th><?php echo $this->lang->line('slno'); ?></th>
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('roll_no'); ?></th>
            <th><?php echo $this->lang->line('student_name'); ?></th>
            <th><?php echo $this->lang->line('father_name'); ?></th>
            <th class=""><?php echo $this->lang->line('mobile_no'); ?></th>
            <th class=""><?php echo  $this->lang->line('staff').'&nbsp;'.$this->lang->line('status'); ?></th>
            <th class=""><?php echo  $this->lang->line('admin').'&nbsp;'.$this->lang->line('status'); ?></th>
            <th><?php echo $this->lang->line('update_status'); ?></th>
            <th><?php echo $this->lang->line('view'); ?></th>
            <th><?php echo $this->lang->line('print'); ?></th>                              
            </thead>
            <tbody>


            <?php
            $sl=1;
            foreach($subjectlist as $sub)
            {
                
            $admin_st="";
            ?>
            <tr>
            <!-- <td class="text-center"><input type="checkbox" class="checkbox center-block"  name="exam_group_class_batch_exam_student_id[]" data-student_id="<?php echo $sub['online_examination_student_id']; ?>" value="<?php echo $sub['online_examination_student_id']; ?>">

            </td> -->

            <td><?php   echo   $sl ; ?></td>
            <td><?php   echo   $sub['admission_no']; ?></td>
            <td><?php   echo   $sub['roll_no']; ?></td>
            <td><?php   echo   $sub['firstname'].''.$sub['middlename'].''.$sub['lastname']; ?></td>
            <td><?php   echo   $sub['father_name']; ?>
            <input type="hidden" name="studid" id="studid<?php echo $sl; ?>" value="<?php echo $sub['student_id'];?>">
            <input type="hidden" name="group" id="group<?php echo $sl; ?>" value="<?php echo  $sub['online_examination_examgroup']; ?>">
            <input type="hidden" name="exambatchid" id="exambatchid<?php echo $sl; ?>" value="<?php echo $sub['online_examination_exam']; ?>">
            </td>
            <td>
            <?php   echo   $sub['mobileno']; ?>
            </td>

            <td>
            <?php   




            $teacher_st= $sub['online_examination_subject_status']; 


            if($teacher_st=='1')
            {            
            $teachst="Waiting ";
            // $adbackgroundcolor="#9775b2";
            $btn_link_ad="text-decor-awaiting";

            }



            elseif($teacher_st=='2')
            {
            $teachst="Approved";
            // $adbackgroundcolor="#27a562";
            $btn_link_ad="text-decor-approve";

            }



            elseif($teacher_st=='3')
            {
            $teachst="Rejected";
            // $adbackgroundcolor="#a52731";
            $btn_link_ad="text-decor-reject";

            }           
            ?>

            <!--style="background-color:<?php  echo $adbackgroundcolor;  ?>; color:white; padding:2px 2px 2px 2px; "-->

            <span class="<?php echo $btn_link_ad; ?>" ><?php  echo $teachst; ?></span>
            </td>
            <td>

            <?php

            $admin_st= $sub['online_examination_admin_approve']; 



            if($admin_st=='1')
            {            
            $adst="Waiting ";

            $btn_link_st="text-decor-awaiting";
            }




            elseif($admin_st=='2')
            {
            $adst="Approved";

            $btn_link_st="text-decor-approve";

            }
            elseif($admin_st=='3')
            {
            $adst="Rejected";

            $btn_link_st="text-decor-reject";
            }           
            ?>
            <!-- <span style="background-color:<?php  echo $btn_link_st;  ?>; color:white; padding:2px 2px 2px 2px; "><?php  echo $adst; ?> -->

            </span>


            <span class="<?php echo  $btn_link_st; ?>" ><?php  echo $adst; ?>

            </span>


            </td>


            <?php

            // if($role =="Super Admin")
            // {
            ?>

            <td>
            <select name="approvedstatus" id="approvedstatus<?php echo $sl;  ?>" class="form-control" onchange="approvesta(<?php echo $sl; ?>);">
            <option value="">Select Status </option>
            <option value="2">Approve</option>
            <option value="3">Reject</option>
            <option value="1">Reset</option>
            </select>
            </td>

            <input type="hidden" value="<?php  echo $admin_st;?>" id="admin_st<?php echo $sl;  ?>" />


            <!-- <td>
            <button type="button" name="getonline"  style="background-color:red;color:#fff;" onclick="delete_student_online_exam(<?php echo $sl; ?>)"> <i class="fa fa-trash"></i></button>
            </td> -->



            <td>
            <input type="hidden" name="examgroup" id="examgroup<?php echo $sl; ?>" value="<?php echo $sub['examgroup']; ?>">
            <input type="hidden" name="exambatch" id="exambatch<?php echo $sl; ?>" value="<?php echo $sub['exambatch']; ?>">
            <input type="hidden" name="student" id="student<?php echo $sl; ?>" value="<?php echo $sub['studid']; ?>">
            <button type="button" class="btn-link-button-primary" onclick="getdata(<?php echo $sl; ?>)"  data-toggle="modal" data-target="#myModal">
            <?php echo $this->lang->line('view'); ?> &nbsp;
            <i class="fa fa-eye"></i>
            </button>
            </td>
            <td>
            <button type="button" class="btn-link-button-primary"  id="btnPrint" onclick="getdata_result(<?php echo $sl; ?>)" ><?php echo $this->lang->line('generate'); ?>&nbsp;<i class="fa fa-print"></i></button> 
            </td>
            <?php 
 $sl++;
             } 

            ?>
            </tr>

            </tbody>
            </table>
            </div>
            </div>
            </form>
            <?php
            // }
            }
            ?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Exam Details </h4>
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


            /*
            if (!empty($subjectlist)) 
            {
            ?>



            <table class="table table-striped table-bordered table-hover table-student" cellspacing="0" width="50%">
            <thead>
            <tr>

            <th><?php echo $this->lang->line('student'); ?></th>
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('roll_no'); ?></th>
            <th><?php echo $this->lang->line('mobile_no'); ?></th>
            <th><?php echo $this->lang->line('email'); ?></th>
            <th><?php echo $this->lang->line('gender'); ?></th>
            <th><?php echo $this->lang->line('current_address'); ?></th>

            </tr>
            </thead>
            <tbody>

            <?php


            $sl=1;
            foreach($subjectlist as $sub) 
            {

            ?>
            <tr>

            <td><b><?php echo $sub['firstname']; ?>&nbsp;<?php echo $sub['middlename']; ?>&nbsp;<?php echo $sub['lastname']; ?></b>
            <br>
            <br>
            <?php echo "Class:".'&nbsp;&nbsp;'. $sub['classname']; ?>
            <br>
            <?php echo "Section:".'&nbsp;&nbsp;'. $sub['sectionsname']; ?>


            </td>
            <td><?php echo $sub['admission_no']; ?></td> 
            <td><?php echo $sub['roll_no']; ?></td>
            <td><?php echo $sub['mobileno']; ?></td>
            <td><?php echo $sub['email']; ?></td>
            <td><?php echo $sub['gender']; ?></td>
            <td><textarea readonly class="form-control" rows="5" ><?php echo $sub['current_address']; ?></textarea></td>


            <td>




            <input type="hidden" name="examgroup" id="examgroup<?php echo $sl; ?>" value="<?php echo $sub['examgroup']; ?>">
            <input type="hidden" name="exambatch" id="exambatch<?php echo $sl; ?>" value="<?php echo $sub['exambatch']; ?>">




            <input type="hidden" name="student" id="student<?php echo $sl; ?>" value="<?php echo $sub['studid']; ?>">





            <button type="button" class="btn btn-info btn-lg" onclick="getdata(<?php echo $sl; ?>)"  data-toggle="modal" data-target="#myModal">
            View
            </button>


            </td>                                            
            </tr>

            <?php
            $sl++;
            }
            ?>
            </tbody>            
            </table>

            <?php }

            */

            ?>







            </div>                                                                           
            </div>                                                         
            </div>









            </div>  

            </div>

            </div>

            </section>
            </div>
            </div>
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
            getExamgroupByClassSectionSession(class_id, section_id, session_id);
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
            // $('#subjectname').html("");
            var exam_id = $(this).val();
            getSubjectByExamgroup(exam_id, 0);
            });



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

            // var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
            // var class_id = '<?php echo set_value('class_id') ?>';
            // var section_id = '<?php echo set_value('section_id') ?>';
            // var session_id = '<?php echo set_value('session_id') ?>';
            // var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
            // var exam_id = '<?php echo set_value('exam_id') ?>';
            // // getSectionByClass(class_id, section_id);
            // getExamByExamgroup(exam_group_id, exam_id);

            // $(document).on('change', '#exam_group_id', function (e)
            // {

            // $('#exam_id').html("");
            // var exam_group_id = $(this).val();
            // getExamByExamgroup(exam_group_id, 0);
            // }); 


            // function getExamByExamgroup(exam_group_id, exam_id) 
            // {
            // if (exam_group_id != "")
            // {
            // $('#exam_id').html("");
            // var base_url = '<?php echo base_url() ?>';
            // var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            // $.ajax({
            // type: "POST",
            // url: base_url + "user/user/getExamByExamgroup",
            // data: {'exam_group_id': exam_group_id},
            // dataType: "json",
            // beforeSend: function () {
            // $('#exam_id').addClass('dropdownloading');
            // },
            // success: function (data) {
            // $.each(data, function (i, obj)
            // {
            // var sel = "";
            // if (exam_id == obj.id) {
            // sel = "selected";
            // }
            // div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
            // });
            // $('#exam_id').append(div_data);
            // },
            // complete: function () {
            // $('#exam_id').removeClass('dropdownloading');
            // }
            // });
            // }
            // }

            </script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script>


            function getsubjectid()
            {
            var examid      = $('#exam_id').val();
            var subject_id  = $('#subject_id').val();       
            $.ajax({
            type: "POST",
            //dataType: "json",  
            data: {examid: examid},

            url: "<?php echo site_url('user/user/online_examination_get_subjectid');?>",
            success:function(result)
            {
            //$('#subject_id').empty();    

            var jsondata= JSON.parse(result);

            $('#subject_id').html('<option value=""></option>');

            $.each(jsondata, function(key, value) 
            {

            $('select[name="subject_id"]').append('<option value="'+ value.subjectid +'">'+ value.subject +'</option>');

            });

            },
            }); 
            }



            function getdata(row)
            {                  

            var examgroup           =  $('#examgroup'+row).val();
            var exambatch           =  $('#exambatch'+row).val();
            var student             =  $('#student'+row).val();          

            $.ajax({
            type: "POST",   
            data: {examgroup:examgroup,exambatch:exambatch,student:student},  
            url: "<?php echo site_url('admin/onlineexam/list_onlineexam');?>",
            success:function(result)
            {
            $('#myModal').modal("show");
            $('#mod').html(result);
            // Popup(result.page);
            }
            });
            }
            </script>


            <script>
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

            </script>


            <!--

            <script type="text/javascript">

            var base_url = '<?php echo base_url() ?>';
            function Popup(data)
            {


            /*var idd = document.querySelector('.checkbox:checked').value;
            $.ajax({
            type : "POST",

            url: base_url + "admin/Examresult/getstudent",
            data: {'idd': idd},        
            datatype : 'JSON',      

            success:function(data)
            {

            var json = JSON.parse(data);
            var firstname=json['firstname'];
            //alert(firstname);

            document.cookie = "name = " + firstname;

            document.title = "<?php echo $name= $_COOKIE['name']; ?> ";
            var json = JSON.parse(data);
            $.each(json, function (index, obj)
            { 
            var firstname=obj.firstname;
            document.cookie = "name = " + firstname;

            });



            },
            }); 
            */



            //$_COOKIE['name']="";

            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";

            $("body").append(frame1);

            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;

            frameDoc.document.open();

            //Create a new HTML document.
            frameDoc.document.write('<html>');
            frameDoc.document.write('<head>');
            frameDoc.document.write('<title><?php  echo $this->customlib->getAppName(); ?>  </title>');
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

            window.location.reload(true);

            }   

            </script>

            -->

            <script type="text/javascript">
            function approvesta(row)
            {
                
                alert(row)
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
            url: "<?php  echo site_url();?>/admin/onlineexam_list/update_staffapproval",   

            type: "POST", 
            dataType:'JSON',
            data: {studid: studid,group:group,exambatchid:exambatchid,approvedstatus:approvedstatus,class_id:class_id,section_id:section_id}, 


            success:function(result)
            {

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
            // alert(result);
            }
            });
            }
            }




            function getdata_result(row)
            { 
            var studid      = $("#studid"+row).val();
            var group     = $("#group"+row).val();
            var exambatchid = $("#exambatchid"+row).val();

            $.ajax({
            type : "POST",

            url: base_url + "admin/onlineexam/viewsubjectpdf_printer",

            data: {studid:studid,group:group,exambatchid:exambatchid},       
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
            }






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



            <script type="text/javascript">            

            var date_format    = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
            var class_id       = '<?php echo set_value('class_id') ?>';
            var section_id     = '<?php echo set_value('section_id') ?>';
            var exam_group_id  = '<?php echo set_value('exam_group_id') ?>';
            var exam_id        = '<?php echo set_value('exam_id') ?>';
            var subjectname    = '<?php echo set_value('subjectname') ?>';
            // getSectionByClass(class_id, section_id);

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


            <?php 
            $old_class_id = set_value('class_id');
            $old_section_id = set_value('section_id');
            ?>


            $(document).ready(function() {
            var oldClassId = "<?php echo $old_class_id; ?>";
            var oldSectionId = "<?php echo $old_section_id; ?>";

            // If class is already selected on page load, load sections
            if (oldClassId) {
            getSectionByClass(oldClassId, oldSectionId);
            }

            // When class changes
            $(document).on('change', '#class_id', function () {
            var class_id = $(this).val();
            getSectionByClass(class_id, 0); // on change, no preselection
            });
            });

            function getSectionByClass(class_id, section_id) {
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
            $.each(data, function (i, obj) {
            var sel = "";
            if (String(section_id) === String(obj.section_id)) {
            sel = "selected";
            }
            div_data += "<option value='" + obj.section_id + "' " + sel + ">" + obj.section + "</option>";
            });
            $('#section_id').append(div_data);
            },
            complete: function () {
            $('#section_id').removeClass('dropdownloading');
            }
            });
            }
            }


            // $(document).on('change', '#class_id', function (e) 
            // {
            // $('#section_id').html("");
            // var class_id = $(this).val();
            // getSectionByClass(class_id, 0);
            // });


            // function getSectionByClass(class_id, section_id) 
            // {

            // if (class_id !== "") {
            // $('#section_id').html("");
            // var base_url = '<?php echo base_url() ?>';
            // var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';            

            // $.ajax({
            // type: "GET",
            // url: base_url + "sections/getByClass",
            // data: {'class_id': class_id},
            // dataType: "json",
            // beforeSend: function () {
            // $('#section_id').addClass('dropdownloading');
            // },
            // success: function (data) {
            // $.each(data, function (i, obj)
            // {
            // var sel = "";
            // if (section_id === obj.section_id) {
            // sel = "selected";
            // }
            // div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
            // });
            // $('#section_id').append(div_data);
            // },
            // complete: function () {
            // $('#section_id').removeClass('dropdownloading');
            // }
            // });
            // }
            // }


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



            // function getSubjectByExamgroup(exam_id, subjectname) 
            // {        

            // if (exam_id !== "") {
            // $('#subjectname').html("");
            // var base_url = '<?php echo base_url() ?>';
            // var div_dataa = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


            // $.ajax({
            // type: "POST",
            // url: base_url + "admin/valuationmarkentry/getsubject",
            // data: {'exam_id': exam_id},
            // dataType: "json",
            // beforeSend: function () {
            // $('#exam_id').addClass('dropdownloading');
            // },
            // success: function (data) 
            // {
            // $.each(data, function (i, obj)
            // {
            // var sel = "";
            // if (subjectname === obj.subject_id) {
            // sel = "selected";

            // var sub=obj.subject_id;
            // $('#subjectlist').val(sub);


            // }
            // div_dataa += "<option value=" + obj.subject_id + " " + sel + ">" + obj.subject_id +'-'+ obj.code +'-'+ obj.name + "</option>";                     

            // });

            // $('#subjectname').append(div_dataa);
            // $('#subjectname').trigger('change');
            // },
            // complete: function () {
            // $('#subjectname').removeClass('dropdownloading');
            // }
            // });
            // }
            // }





            // function gettsudentlist()
            // {

            // var exam_group_id =  $('#exam_group_id').val();
            // var exam_id       =  $('#exam_id').val();

            // var class_id      =  $('#class_id').val();
            // var section_id  =   $('#section_id').val();
            // var subjectname   = $('#subjectname').val();
            // var exam_group_id =  $('#exam_group_id').val();
            // var session_id       =  $('#session_id').val();              
            // $.ajax({
            // type: "POST",   
            // data: {exam_group_id:exam_group_id,exam_id:exam_id,class_id:class_id,session_id:session_id,section_id:section_id,subjectname:subjectname}, 

            // url: "<?php echo site_url('admin/valuationmarkentry/getsubjecttet');?>",
            // success:function(result)
            // {

            // //alert(result); 
            // $('#pages').val(result);
            // }
            // });            
            // } 


            // function getdata(row)
            // {            
            // var student                     =  $('#student'+row).val(); 
            // var exam_group_exam_studentid   =  $('#exam_group_exam_sayexam_studentid'+row).val();
            // var post_exam_id                =  $('#post_exam_id'+row).val();            
            // var post_exam_group_id          =  $('#post_exam_group_id'+row).val();            

            // $.ajax({
            // type: "POST",   
            // data: {student:student,exam_group_exam_studentid:exam_group_exam_studentid,post_exam_id:post_exam_id,post_exam_group_id:post_exam_group_id},  
            // url: "<?php echo site_url('admin/sayexamte/getstudent_sayexamtelist_modal');?>",
            // success:function(result)
            // {            

            // $('#myModal').modal("show");
            // $('#mod').html(result);
            // // Popup(result.page);
            // }
            // });
            // }
            $(document).on('click', '#select_all', function ()
            {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
            });                             


            </script> 