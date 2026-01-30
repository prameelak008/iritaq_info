                    
                    <style >
                    .text-left
                    {
                    text-align: left !important;
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
                    
                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i><?php echo $this->lang->line('alloted').'&nbsp;&nbsp;'.$this->lang->line('students') ; ?> </h3>
                    </div>
                    <div class="box-body">
                    
                    
                    <form role="form" action="<?php echo site_url('entrance_allotment/allotment/forwardenroll') ?>" method="post" >
                    <?php echo $this->customlib->getCSRF(); ?>
                    
                    <div class="row">
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                        
                        
                    <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                    
                    <!--<select  id="session" name="session" class="form-control select2"  >
                    <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?> </option>
                    
                    <?php
                    foreach($sessionlist as $sess)
                    {
                    ?>
                    <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
                    <?php
                    } 
                    ?>
                    </select>
                    -->
                    
                    
                    
                    <select name="session" id="session" class="form-control">
                    <?php
                    foreach($sessionlist as $session)
                    {
                    ?>
                    <option value="<?php echo $session['id'] ?>" <?php
                    if ($current_session['cur_session'] == $session['id']) 
                    {
                    echo "selected=selected";
                    }
                    ?>><?php   echo $session['session']; ?></option>
                    <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('session'); ?></span>
                    </div>
                    </div>
                    
                    
                    
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                    <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                    <select  id="entrance_course" required name="entrance_course" class="form-control select2"  >
                    
                    <option value="">SELECT COURSE </option>
                    <?php
                    foreach($course as $cou)
                    {
                    ?>
                    <option value="<?php echo  $cou['entranceexam_course_id']; ?>" <?php
                    if (set_value('entrance_course') == $cou['entranceexam_course_id']) {
                    echo "selected=selected";
                    }
                    ?>><?php echo $cou['entranceexam_course_name']; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    
                    <span class="text-danger"><?php echo form_error('entrance_course'); ?></span>
                    </div>
                    </div>
                    
                    
                    
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                    <label>Institute</label><small class="req"> *</small>
                    <select  id="entrance_institute" required name="entrance_institute" class="form-control select2"  >
                    <option value="">SELECT INSTITUTE</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
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
                    if (!empty($applicant)) 
                    { 
                    ?>
                    
                    <div class="" >
                    <div class="box-header ptbnull"></div>
                    <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> Enroll Students</h3>
                    </div>
                    
                    <div class="box-body">
                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                    
                    <table border="1px  #5b5555;" width="80%"  style="line-height:60px; text-align:center; font-weight:bold;" >
                    <tr>
                    <td width="50%">Session</td>
                    <td width="50%"><?php   echo $current_session['session']; ?></td>
                    </tr>
                    <tr>
                    <td width="50%">Course</td>
                    <td width="50%"><?php  echo $getcourse_name['entranceexam_course_name'];  ?></td>
                    </tr>
                    <tr>
                    <td width="50%">Institute Name</td>
                    <td width="50%"><?php  echo $getcourse_name['entranceexam_insitutename'];  ?></td>
                    </tr>
                    </table>
                    <br>
                    <br>
                    
                    
                    
                    <form method="POST" action="<?php echo site_url('entrance_allotment/allotment/add_forward_to_enrol');?>" name="form" />
                    
                    <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                    <th class="text-left">Seat No</th>
                    <th class="text-left">Marks</th>
                    
                    <th class="text-left"><?php echo $this->lang->line('application'); ?></th>
                   <th class="text-left"><?php echo $this->lang->line('name'); ?></th>
                  
                    <th class="text-left">Seat Type</th>
                    
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sl=1;
                    
                    foreach($applicant as $app)
                    {
                    ?>
                    <tr>
                    
                    <td><?php  echo $sl; ?></td> 
                    <td></td>
                    <td><?php  echo $app['exam_publish_percentage']; ?></td> 
                    <td><?php  echo $app['admission_application_no']; ?></td> 
                    
                    <td><?php  echo $app['admission_name']; ?></td>
                    <td><?php  echo $app['entrance_allot_type_name']; ?>
                    
                    
                    
                    <input type="hidden" name="allot_type_id[]" value="<?php  echo $app['entrance_allot_type_id']; ?>" class="form-control"  />
                    <input type="hidden" name="applicant_id[]" value="<?php  echo $app['admission_application_registerid']; ?>" class="form-control"  /></td>
                    
                    </td>
                   
                   
                    </tr>
                    <?php $sl++; }  ?>
                    </tbody>
                    </table>
                    
                     <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('forward_to_enrol');?></button>
                    </form> 
                     
                    </div>
                    </div>
                    <?php  
                    }
                    ?>
                    </div>
                    </section>
                    </div>
                    
                    <script type="text/javascript">
                    
                    $('#select_all').click(function () 
                    {    
                    $('input:checkbox').prop('checked', this.checked);    
                    });
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
                    
                    
                    
                    </script>