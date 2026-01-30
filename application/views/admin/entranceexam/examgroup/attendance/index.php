                                    
                                    <style >
                                    
                                    .text-left
                                    {
                                    text-align: left !important;
                                    }
                                    </style>
                                    
                                    
                                    <div class="content-wrapper" style="min-height: 946px;">
                                    <section class="content-header">
                                    <h1>
                                    <i class="fa fa-map-o"></i> <?php echo $this->lang->line('Attendance'); ?> <small></small>  
                                    </h1>
                                    </section>
                                    <!-- Main content -->
                                    <section class="content">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="box box-primary">
                                    <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search"></i><?php echo $this->lang->line('attendance'); ?> <small>
                                    </div>
                                    
                                    
                                    
                                    <div class="box-body">
                                    <form role="form" action="<?php echo site_url('entrance_allotment/attendance') ?>" method="post" >
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    
                                    <div class="row">
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo  $this->lang->line('phase'); ?></label><small class="req"> *</small>
                                    <select  id="phaseid" name="phaseid" class="form-control select2" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    $count = 0;
                                    foreach ($phaselist as $phase) {
                                    ?>
                                    <option value="<?php echo $phase['entrance_examgroup_id'] ?>" <?php if (set_value('phaseid') == $phase['entrance_examgroup_id']) {
                                    echo "selected=selected";
                                    }
                                    ?>><?php echo $phase['entrance_examgroup_name'] ?></option>
                                    <?php
                                    $count++;
                                    }
                                    ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('phaseid'); ?></span>
                                    </div>
                                    </div>
                                        
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                                    <select  id="entrance_course" name="entrance_course" class="form-control select2"  >
                                    <?php
                                    foreach($course as $cou)
                                    {
                                    ?>
                                    <option value="<?php  echo $cou['entranceexam_course_id'];  ?>"
                                    <?php
                                    if(set_value('entrance_course')==$cou['entranceexam_course_id'])
                                    {
                                    echo "selected=selected"; 
                                        
                                    }
                                    ?>
                                    ><?php  echo $cou['entranceexam_course_name'];  ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                                    </div>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                                    <select  id="session" name="session" class="form-control select2"  >
                                    <?php
                                    foreach($sessionlist as $session)
                                    {
                                    ?>
                                    <option value="<?php  echo $session['id'];?>" <?php
                                    if($current_entrancesession['cur_session']== $session['id'])
                                    {
                                    echo "selected=selected";
                                    }
                                    ?>><?php  echo $session['session']; ?></option>
                                    <?php 
                                    }
                                    ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('session'); ?></span>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo $this->lang->line('subject') ?></label><small class="req"> *</small>
                                    <!--
                                    <select  id="entrance_subject" name="entrance_subject" class="form-control select2">
                                    <option value="<?php if(!empty($subject_marks)) 
                                    { 
                                    echo  $subject_marks['entrance_subtype_id'];} else { echo ""; } ?>">
                                    <?php if(!empty($subject_marks)) { echo $subject_marks['entrance_subtype_name']; } else { echo $this->lang->line('select'); } ?>
                                    </option>
                                    </select>
                                    -->
                                    
                                    <select id="entrance_subject" name="entrance_subject" class="form-control select2">
                                    <option value="<?php set_value('entrance_subject', !empty($subject_marks) ? $subject_marks['entrance_subtype_id'] : '') ?>">
                                    <?php !empty($subject_marks) ? $subject_marks['entrance_subtype_name'] : $this->lang->line('select'); ?>
                                    </option>
                                    </select>
                                    
                                    
                                    <span class="text-danger"><?php echo form_error('entrance_subject'); ?></span>
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
                                    <div>
                                      
                                        
                                    <?php
                                    if (!empty($applicants)) 
                                    { 
                                    ?>
                                    <form method="post" action="<?php echo base_url('entrance_allotment/attendance/enterattendance') ?>" >
                                    
                                    <div class="" >
                                    <div class="box-header ptbnull"></div>
                                    <div class="box-header ptbnull">
                                    <h3 class="box-title titlefix"><i class="fa fa-users"></i><?php echo $this->lang->line('attendance '); ?></h3>
                                    </div>
                                    <div class="box-body">
                                    
                                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                                    
                                    <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                                    
                                    <thead>
                                    <tr>
                                    <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                                    <th class="text-left">Admission no</th>
                                    <th class="text-left"><?php echo $this->lang->line('mobile_no'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('student_name'); ?></th>
                                    
                                    <th class="text-left"><?php echo $this->lang->line('attendence'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('note') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sl=1;
                                    
                                    
                                    
                                    foreach($applicants as $appl)
                                    {
                                    ?>  
                                    <tr>
                                    <td><?php   echo $sl; ?></td> 
                                    <td><?php   echo $appl['admission_application_no'];  ?></td>
                                    <td><?php   echo $appl['admission_mobile'];  ?></td>
                                    <td><?php   echo $appl['admission_name'];  ?></td>
                                    <td>
                                    <select name="attendence[]" class="form-control">
                                    <?php
                                        
                                    foreach($getby_attendance as $att)
                                    {
                                    if( $att['entranceexam_attendance_applicant']==$appl['admission_application_registerid'] && $att['entranceexam_attendance_subject']==$appl['entranceexam_subject_subid'])
                                    {
                                    
                                    ?>
                                   
                                    <option value="<?php echo  $att['entranceexam_attendance_attendence']; ?>"><?php echo  $att['entranceexam_attendance_attendence']; ?></option>
                                    <?php
                                    }
                                    }
                                    ?>    
                                    ?>    
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    </select>
                                    </td>
                                    
                                    
                                    <td>
                                    <input type="hidden" name="session_id[]" value="<?php echo $session_id; ?>" class="form-control"/>
                                    <input type="hidden" name="applicantname[]" value="<?php echo $appl['admission_application_registerid']; ?>" class="form-control"/> 
                                    
                                    
                                    <input type="hidden" name="subjectid[]" value="<?php  echo $appl['entranceexam_subject_subid']; ?>" class="form-control"/>    
                                        
                                   
                                    
                                    
                                    <textarea class="form-control" name="notes[]" ><?php 
                                    foreach($getby_attendance as $att)
                                    {
                                    if( $att['entranceexam_attendance_applicant']==$appl['admission_application_registerid'] && $att['entranceexam_attendance_subject']==$appl['entranceexam_subject_subid'])
                                    {
                                    
                                    echo  $att['entranceexam_attendance_notes'];
                                    }
                                    }
                                    ?>
                                    </textarea>
                                    </td>
                                    
                                    </tr>
                                    
                                    <?php $sl++; }  ?>
                                    
                                    </tbody>
                                    </table>
                                    
                                    <input type="submit" name="submit" value="SAVE" class="btn btn-success"/>
                                    </form>
                                    
                                    
                                    <?php   
                                    } 
                                    ?>
                                    
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
                                    
                                    $(document).on('change', '#entrance_course', function (e) 
                                    {
                                    //$('#entrance_course').html("");
                                    var entrance_course = $(this).val();
                                    getsubjectbycourse(entrance_course, 0);
                                    });
                                    
                                    function getsubjectbycourse(entrance_course, entrance_subject) 
                                    { 
                                        
                                      
                                    var entrance_course = $('#entrance_course').val();
                                    var session = $('#session').val();
                                    var entrance_subject = $('#entrance_subject').val();
                                    if (entrance_course !== "") 
                                    {
                                    $('#entrance_subject').html("");
                                    var base_url = '<?php echo base_url() ?>';
                                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                    
                                    $.ajax({
                                    type: "POST",
                                    url: base_url + "entrance_allotment/add_marks/getentranceSubject",
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
                                    if (entrance_subject === obj.entrance_subtype_id) {
                                    sel = "selected";
                                    }
                                    div_data += "<option value=" + obj.entrance_subtype_id + " " + sel + ">" + obj.entrance_subtype_name + "</option>";
                                    });
                                    
                                    $('#entrance_subject').append(div_data);
                                    $('#entrance_subject').trigger('change');
                                    },
                                    complete: function () {
                                    $('#entrance_subject').removeClass('dropdownloading');
                                    }
                                    });
                                    }
                                    }
                                    </script>