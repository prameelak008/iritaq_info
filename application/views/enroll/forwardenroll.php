                    
                    <style >
                    .text-left
                    {
                    text-align: left !important;
                    }
                    </style>

                    
                    
                    <div class="content-wrapper" style="min-height: 946px;">
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-map-o"></i>Forward Enroll <small><?php echo $this->lang->line('candidates') ; ?></small>  
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
                        
                        
                    <?php if($this->session->flashdata('message')){?>
                    <div class="alert alert-success">      
                    <?php echo $this->session->flashdata('message')?>
                    </div>
                    <?php } ?> 
                    
                    
                    <form role="form" action="<?php echo site_url('admin/Enroll/forward_to_enrol') ?>" method="post" >
                    <?php echo $this->customlib->getCSRF(); ?>

                    
                    <div class="row">
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                    <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>                    
                    <select  id="session" name="session" class="form-control"  >
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
                    
                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                    </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                    <div class="form-group">
                    <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                    <select  id="entrance_course" required name="entrance_course" class="form-control"  >
                    
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
                    <select  id="entrance_institute" required name="entrance_institute" class="form-control"  >
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
                    </div>
                    
                    <div class="box-body">
                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                    <div class="download_label"></div>
                     
                    <table  width="80%"  style="line-height:60px; text-align:left; font-size:15px;" >
                    <tr>
                    <td width="100%">Session&nbsp;&nbsp;:<?php   echo $current_session['session']; ?></td>
                   
                    </tr>
                    <tr>
                    <td width="100%">Course&nbsp;&nbsp;:<?php  echo $getcourse_name['entranceexam_course_name'];  ?></td>
                    
                    </tr>
                    <tr>
                    <td width="100%">Institute Name&nbsp;&nbsp;:<?php  echo $getcourse_name['entranceexam_insitutename'];  ?></td>
                    
                    </tr>
                    </table>
                    <br>
                    <br>
                    
                    <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                    <th class="text-left">Seat No</th>
                    <th class="text-left"><?php echo $this->lang->line('marks'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('application'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('name'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('seat_type'); ?></th>
                    <th class="text-left"><?php echo $this->lang->line('status'); ?></th>
                    
                    <th class="text-left"><?php echo $this->lang->line('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sl=1;
                    
                    foreach($applicant as $app)
                    {
                    ?>
                   
                    <tr>
                    <form method="POST" action="<?php echo site_url('admin/enroll/afflited_enrol');?>" name="form" />
                    <td><?php  echo $sl; ?>
                    <input type="hidden" name="admission_institute"  id="admission_institute" value="<?php echo $getcourse_name['entranceexam_insitutename'];  ?>" />
                    </td> 
                    <td><?php  echo $app['entranceexam_allotment_seatno']; ?></td>
                    <td><?php  echo $app['exam_publish_percentage']; ?></td> 
                    <td><?php  echo $app['admission_application_no']; ?></td> 
                    <td><?php  echo $app['admission_name']; ?></td>
                    <td><?php  echo $app['entrance_allot_type_name']; ?>
                    
                    <input type="hidden" name="allot_type_id" value="<?php   echo $app['entrance_allot_type_id']; ?>" class="form-control"  />
                    <input type="hidden" name="applicant_id" value="<?php    echo $app['admission_application_registerid']; ?>" class="form-control"  />
                    <input type="hidden" name="admission_name" value="<?php  echo $app['admission_name']; ?>" class="form-control"  />
                    </td>
                    <td>
                        
                    <?php
                    $this->db->select('*');
                    $this->db->from ('students');
                    $this->db->where(array('entrance_reg_id'=>$app['admission_application_registerid']));
                    $query = $this->db->get();
                    $res= $query->row_array();
                    
                    if(empty($res))
                    {
                    echo "<i class='fa fa-remove' style='color:#d16969; font-size:25px;' title='Not Enrolled'></i>";
                    }
                    else
                    {
                    echo "<i class='fa fa-check' aria-hidden='true' style='color:#a0d8cd; font-size:25px;' title='Enrolled'  ></i>";
                    }
                    ?>
                    </td>
                    <td>
                    <input type="submit" name="submit" value="Enrol" class="btn btn-success"/>
                    </td>
                    </form>
                    </tr>
                    <?php $sl++; }  ?>
                    </tbody>
                    </table>
                    <br>
                    <br>
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
                    
                    
                    
                     $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
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
                     
                    
                    
                    
                    </script>