                    
                    <style >
                    .text-left
                    {
                    text-align: left !important;
                    }
                    </style>
                    
                    
                    <div class="content-wrapper" style="min-height: 946px;">
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-map-o"></i>Allot <small><?php echo $this->lang->line('Students') ; ?></small>  
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
                    
                    
                    <form role="form" action="<?php echo site_url('entrance_allotment/allotment/viewallotment') ?>" method="post" >
                    <?php echo $this->customlib->getCSRF(); ?>
                    
                    <div class="row">
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                    <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                   <!-- <select  id="session" name="session" class="form-control select2"  >
                    <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?> </option>
                    
                    <?php
                    foreach($sessionlist as $sess)
                    {
                    ?>
                    <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
                    <?php
                    } 
                    ?>
                    </select>-->
                    
                    
                    
                    <select name="session" class="form-control">
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
                    
                    
                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
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
                    
                    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
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
                    
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                    <label><?php echo  $this->lang->line('type'); ?></label><small class="req"> *</small>
                    <select  id="statustype" required name="statustype" class="form-control select2"  >
                    <option value="">SELECT TYPE</option>
                    <?php
                    foreach($allot_seattype as $allot) {
                    ?>
                    <option value="<?php echo  $allot['entrance_allot_type_id']; ?>" <?php
                    if (set_value('statustype') == $allot['entrance_allot_type_id']) {
                    echo "selected=selected";
                    }
                    ?>><?php echo $allot['entrance_allot_type_name']; ?></option>
                    <?php
                    }
                    ?>
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
                        
                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> Alloted Students</h3>
                    <form action="<?php echo  site_url('entrance_allotment/allotment/exportCSV') ?>" method="POST" name="frm">
                    <input type="hidden" name="session_id" value="<?php echo $session_id;  ?>" /> 
                    <input type="hidden" name="courseid" value="<?php echo $courseid;  ?>" /> 
                    <input type="hidden" name="instituteid" value="<?php echo $institu;  ?>" /> 
                    <input type="hidden" name="statustype" value="<?php echo $statustype;  ?>" /> 
                    <input type="submit" name="submit" class="btn btn-success pull-right btn-sm checkbox-toggle" value="EXPORT" /> 
                    </form>
                    
                    
                    <button type="button" style="margin-left:4px;margin-right:4px;" class="btn btn-success pull-right btn-sm checkbox-toggle" data-toggle="modal" data-target=".bd-example-modal-lg">IMPORT</button>
                   
                    
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>  
                    <form method="POST"  action="<?php echo site_url('entrance_allotment/allotment/import_test'); ?>" enctype= "multipart/form-data" />
                    <input class="filestyle form-control" type='file' name='file' id="file" size='20' /></p>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="box-body">
                    
                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                    <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('application'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('mobile_no'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('father_name'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('house'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('name'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('view'); ?></th>
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
                    <td><?php  echo $app['admission_application_no']; ?></td> 
                    <td><?php  echo $app['admission_mobile']; ?></td>
                    <td><?php  echo $app['admission_fathername']; ?></td> 
                    <td><?php  echo $app['admission_housename']; ?></td> 
                    <td><?php  echo $app['admission_name']; ?></td>
                    <td><a href="<?php  echo site_url(); ?>entranceExam/examview/<?php  echo $app['admission_id']; ?>"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <?php $sl++; }  ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <?php  
                    }
                    ?>
                    </div>
                    </section>
                    </div>
                    
                    <script type="text/javascript">
                    $('#select_all').click(function () {    
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