 
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                   
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Successfully updated!',
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>



<style >

.text-left
{
    text-align: left !important;
}
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
    <i class="fa fa-map-o"></i> <?php echo $this->lang->line('valuation_Camp'); ?> <small><?php echo $this->lang->line('valuation_Camp') ; ?></small>  
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('valuation_Camp').'-'. $this->lang->line('enter_mark'); ?></h3>
                    </div>


                    <div class="box-body">
                        
                        <form role="form" action="<?php echo site_url('admin/valuationmarkentry/entermark') ?>" method="post" >
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


                        <div class="col-sm-6 col-lg-3 col-md-3 col20"  >
                        <div class="form-group">
                        <label><?php echo $this->lang->line('select') . " " . $this->lang->line('subject'); ?></label><small class="req"> *</small>
                        <select id="subjectname" name="subjectname" class="form-control select2" >
                        </select>
                        <span class="text-danger"><?php echo form_error('subjectname'); ?></span>
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


                                    <?php 
                                
                                    $date= date('Y-m-d');
                                    if (isset($studentList)) 
                                    {
                                    if($role_id==7)
                                    {
                                    ?>   
                                        
                                        
                                <form method="post" id="myForm" action="<?php echo base_url('admin/Valuationmarkentry/entrymarks') ?>" >
                                <div class="" id="getval" >
                                <div class="box-header ptbnull"></div>
                                <div class="box-header ptbnull">
                                <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo  $this->lang->line('enter_mark'); ?></h3>
                                </div>
                                
                                    <div class="box-body">
                                    <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
                                    <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
                                    <input type="hidden" name="subjectid"  id="subjectid" value="<?php echo $subjectid; ?>">
                                    <input type="hidden" name="subjectlist" id="subjectlist"  >
                                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>

                                        <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                        <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('admission_no'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('roll_no'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('student_name'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('te_marks')." (".$this->lang->line('max').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('te_marks')." (".$this->lang->line('min').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('cmarks')." (".$this->lang->line('max').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('cmarks')." (".$this->lang->line('min').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('attendence'); ?></th>
                                        <th><?php echo $this->lang->line('te_marks') ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('cmarks') ?></th>                                           
                                        <th class="text-left"><?php echo $this->lang->line('note') ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (!empty($studentList)) 
                                            {
                                            $slno=1;
                                            foreach ($studentList as $student_key => $student_value)
                                            {
                                            $result_status = 1;
                                            $no_subject_result = 0;
                                            $result_status_cmark = 1;
                                            $no_subject_result_cmark = 0;
                                            ?>
                                            <tr>
                                                
                                            <td class="text-left"><?php echo $slno; ?>
                <!-- <input type="text" value="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>" id="exam_group_class_batch_exam_student_id" name="exam_group_class_batch_exam_student_id[]">-->

                  <input type="hidden"  id="exam_group_class_batch_exam_student_id" name="exam_group_class_batch_exam_student_id[]" value="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>">
                   </td>


                                            <td class="text-left"><?php echo $student_value->admission_no; ?></td>
                                            <td class="text-left"><?php echo ($student_value->roll_no);?> </td>
                                            <td class="text-left"> 
                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student_value->student_id; ?>"><?php echo $this->customlib->getFullName($student_value->firstname,$student_value->middlename,$student_value->lastname,$sch_setting->middlename,$sch_setting->lastname); ?>
                                            </a>
                                            </td>
                                            
                                            <td class="text-left"> 

                                            <?php echo $student_value->max_marks; ?>

                                            </td> 

                                            <td class="text-left"> 
                                            <?php echo $student_value->min_marks; ?>
                                            </td>

                                            <td class="text-left">

                                            <?php echo $student_value->max_cmarks; ?>

                                            </td> 

                                            <td class="text-left" > 
                                            <?php echo $student_value->min_cmarks;
                                           
                                            ?>
                                            </td>

<td>
    
    
<select name="sel[]" class="form-control"  >
<?php 
if($student_value->attendence=="Absent")
{
$attend="Absent";
$col="#d55717";
}

elseif($student_value->attendence=="Withheld")
{
$attend="Withheld";
$col="#d55717";
}
else
{
$attend="Present";
$col="#1E9FF2"; 
}
?>

<option  style="color:<?php echo $col; ?>" value="<?php echo $attend; ?>">
<?php echo $student_value->attendence; ?> </option>
<option value="Present">Present</option>
<option value="Withheld">Withheld</option>
<option value="Release">Release</option>
<option value="Absent">Absent</option>
</select> 
</td>
<td class="text-left">
    
   
<input type="text" class="marksssss form-control" name="exam_group_student_mark[]" value="<?php echo isset($student_value->get_marks) ? $student_value->get_marks : ''; ?>" step="any">
</td>

<td class="text-left"> <input type="text" class=" form-control" name="exam_group_student_cmark[]" value="<?php echo isset($student_value->get_cmarks) ? $student_value->get_cmarks : ''; ?>" step="any"></td>

<td class="text-left"><input type="text" class="form-control note" name="exam_group_student_note[]" value="<?php echo isset($student_value->note)? $student_value->note : ''; ?>" step="any"></td>

</tr>
<?php

$slno++;                                        
} 
?>                                               
              
</tbody>
</table>


                     <?php if ($this->rbac->hasPrivilege('entermark', 'can_edit')) 
                     { 
                     ?>
                    <div class="col-sm-12">
                    <div class="form-group">
                    <button type="submit" name="save" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-plus"></i> <?php echo $this->lang->line('save'); ?></button>
                    </div>
                    </div>
                    <?php } ?>                                        
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
                    <?php
                    }
                                        
                                    }
                                
                                else
                                {
                                    
                                if($marksenter_last_date['valuation_closingdate']>=$date  )
                                {
                                ?>
                                
                                <form method="post" action="<?php echo base_url('admin/Valuationmarkentry/entrymarks') ?>" >
                                <div class="" id="getval" >
                                <div class="box-header ptbnull"></div>
                                <div class="box-header ptbnull">
                                <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo  $this->lang->line('enter_mark'); ?></h3>
                                </div>
                                
                                    <div class="box-body">
                                    <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
                                    <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
                                    <input type="hidden" name="subjectlist" id="subjectlist"  >
                                    <input type="hidden" name="subjectid"  id="subjectid" value="<?php echo $subjectid; ?>">
                                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>

                                        <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                        <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('admission_no'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('roll_no'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('student_name'); ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('te_marks')." (".$this->lang->line('max').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('te_marks')." (".$this->lang->line('min').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('cmarks')." (".$this->lang->line('max').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('cmarks')." (".$this->lang->line('min').".)";?></th>
                                        <th class="text-left"><?php echo $this->lang->line('attendence'); ?></th>
                                        <th><?php echo $this->lang->line('te_marks') ?></th>
                                        <th class="text-left"><?php echo $this->lang->line('cmarks') ?></th>                                           
                                        <th class="text-left"><?php echo $this->lang->line('note') ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (!empty($studentList)) 
                                            {
                                            $slno=1;
                                            foreach ($studentList as $student_key => $student_value)
                                            {
                                            $result_status = 1;
                                            $no_subject_result = 0;
                                            $result_status_cmark = 1;
                                            $no_subject_result_cmark = 0;
                                            ?>
                                            <tr>
                                                
                                            <td class="text-left"><?php echo $slno; ?>
                <!-- <input type="text" value="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>" id="exam_group_class_batch_exam_student_id" name="exam_group_class_batch_exam_student_id[]">-->

                  <input type="hidden"  id="exam_group_class_batch_exam_student_id" name="exam_group_class_batch_exam_student_id[]" value="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>">
                   </td>


                                            <td class="text-left"><?php echo $student_value->admission_no; ?></td>
                                            <td class="text-left"><?php echo ($student_value->roll_no);?> </td>
                                            <td class="text-left"> 
                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student_value->student_id; ?>"><?php echo $this->customlib->getFullName($student_value->firstname,$student_value->middlename,$student_value->lastname,$sch_setting->middlename,$sch_setting->lastname); ?>
                                            </a>
                                            </td>
                                            
                                            <td class="text-left"> 

                                            <?php echo $student_value->max_marks; ?>

                                            </td> 

                                            <td class="text-left"> 
                                            <?php echo $student_value->min_marks; ?>
                                            </td>

                                            <td class="text-left">

                                            <?php echo $student_value->max_cmarks; ?>

                                            </td> 

                                            <td class="text-left" > 
                                            <?php echo $student_value->min_cmarks;
                                           
                                            ?>
                                            </td>

<td>
    
    
<select name="sel[]" class="form-control"  >
<?php 
if($student_value->attendence=="Absent")
{
$attend="Absent";
$col="#d55717";
}

elseif($student_value->attendence=="Withheld")
{
$attend="Withheld";
$col="#d55717";
}
else
{
$attend="Present";
$col="#1E9FF2"; 
}
?>

<option  style="color:<?php echo $col; ?>" value="<?php echo $attend; ?>">
<?php echo $student_value->attendence; ?> </option>
<option value="Present">Present</option>
<option value="Withheld">Withheld</option>
<option value="Release">Release</option>
<option value="Absent">Absent</option>
</select> 
</td>
<td class="text-left">
    
   
<input type="text" class="marksssss form-control" name="exam_group_student_mark[]" value="<?php echo isset($student_value->get_marks) ? $student_value->get_marks : ''; ?>" step="any">
</td>

<td class="text-left"> <input type="text" class=" form-control" name="exam_group_student_cmark[]" value="<?php echo isset($student_value->get_cmarks) ? $student_value->get_cmarks : ''; ?>" step="any"></td>

<td class="text-left"><input type="text" class="form-control note" name="exam_group_student_note[]" value="<?php echo isset($student_value->note)? $student_value->note : ''; ?>" step="any"></td>

</tr>
<?php

$slno++;                                        
} 
?>                                               
              
</tbody>
</table>


                     <?php if ($this->rbac->hasPrivilege('entermark', 'can_edit')) 
                     { 
                     ?>
                    <div class="col-sm-12">
                    <div class="form-group">
                    <button type="submit" name="save" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-plus"></i> <?php echo $this->lang->line('save'); ?></button>
                    </div>
                    </div>
                    <?php } ?>                                        
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
                    <?php
                    }
                    
                   
                    
                    }
                               
                    
                    
                     else
                    {
                       echo  $marksenter_last_date['valuation_close_entermarks_msg'];
                    }
                                }
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
                        // div_dataa += "<option value=" + obj.subject_id + " " + sel + ">" + obj.subject_id +'-'+ obj.code +'-'+ obj.name + "</option>";
                        div_dataa += "<option value=" + obj.subject_id + " " + sel + ">" + obj.code +'-'+ obj.name + "</option>";
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
    var exam_group_id    =  $('#exam_group_id').val();
    var exam_id          =  $('#exam_id').val();
    var class_id         =  $('#class_id').val();
    var section_id       =  $('#section_id').val();
    var subjectname      =  $('#subjectname').val();
    var exam_group_id    =  $('#exam_group_id').val();
    var session_id       =  $('#session_id').val();
    $.ajax({
    type: "POST",   
    data: {exam_group_id:exam_group_id,exam_id:exam_id,class_id:class_id,session_id:session_id,section_id:section_id,subjectname:subjectname}, 
    
    url: "<?php echo site_url('admin/valuationmarkentry/getsubjecttet');?>",
    success:function(result)
    {
    
    $('#pages').val(result);
    }
    });
                     
    }

</script>