                                    
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
                                    <h3 class="box-title"><i class="fa fa-search"></i>Allot Students</h3>
                                    </div>
                                    <div class="box-body">
                                        
                                        
                                    <form role="form" action="<?php echo site_url('entrance_allotment/allotment') ?>" method="post" >
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="row">
                                        
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo $this->lang->line('phase') ?></label><small class="req"> *</small>
                                    <select  id="entrance_phase" name="entrance_phase" class="form-control select2"  >
                                    <option value"">Select Phase</option>
                                    <?php
                                    foreach($get_phase as $phase)
                                    {
                                    ?>
                                    <option value="<?php echo  $phase['entrance_examgroup_id']; ?>" <?php
                                    if (set_value('entrance_phase') == $phase['entrance_examgroup_id']) {
                                    echo "selected=selected";
                                    }
                                    ?>><?php echo $phase['entrance_examgroup_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('entrance_phase'); ?></span>
                                    </div>
                                    </div>
                                        
                                        
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                                    <!--<select  id="session" name="session" class="form-control select2"  >
                                    <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
                                    <?php
                                    foreach($sessionlist as $sess)
                                    {
                                    ?>
                                    <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
                                    <?php 
                                    } 
                                    ?>
                                    </select>-->
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
                                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
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
                                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> Allot Students</h3>
                                    </div>
                                    
                                    <button type="button"  data-toggle="modal" data-target="#sel_institute">
                                    <i class="fa fa-plus btn btn-success">ALLOT INSTITUTE</i>
                                    </button> 
                                    <div class="box-body">
                                    <form id="form" method="post" action="<?php echo base_url('entrance_allotment/allotment/add_forallotmant') ?>" accept-charset="utf-8" enctype="multipart/form-data" >
                                   
                                     <input type="hidden"  class="form-control" name="course" value="<?php echo $courseid; ?>">
                                   
                                   
                                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                                    <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                    <th class="text-left"><input type="checkbox" id="select_all" class=""/></th>    
                                    <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('application'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('name'); ?></th>
                                    
                                    <th class="text-left"><?php echo $this->lang->line('total'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('percentage'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('rank'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                       
                                    <?php
                                    $sl=1;
                                    foreach($applicant as $app)
                                    {
                                    ?>
                                    <tr>
                                    <td>
                                    <input class="checkbox" type="checkbox" class="exam_publish_id" id="exam_publish_id" name="exam_publish_id[]" value="<?php  echo $app['exam_publish_id']; ?>" data-publish="<?php  echo $app['exam_publish_id']; ?>" ></td> 
                                    <td><?php  echo $sl; ?></td> 
                                    <td><?php  echo $app['admission_application_no']; ?></td> 
                                    <td><?php  echo $app['admission_name']; ?></td>
                                    <td><?php  echo $app['exam_publish_totalmarks']; ?></td> 
                                    <td><?php  echo number_format($app['exam_publish_percentage'],2); ?></td> 
                                    <td>
                                    <?php  echo $app['exam_publish_rank']; ?>
                                    
                                    
                                    </td> 
                                    </tr>
                                    <?php $sl++; }  ?>
                                    </tbody>
                                    </table>
                                    
                                    <div class="modal fade" id="sel_institute" role="dialog">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title title text-center">Select Institute</h4>
                                    </div>
                                    <div class="modal-body pb0">
                                    <div class="form-horizontal balanceformpopup">
                                    <div class="box-body">
                                    
                                    <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Institute</label>
                                    
                                    <div class="col-sm-9">
                                    <select name="entrance_institute" id="entrance_institute" class="form-control" required="required"  >
                                    <option value="">Select Institute</option>
                                    <?php
                                    foreach($entrance_institute as $inst)
                                    {
                                    ?>
                                    <option value="<?php echo $inst['entranceexam_insituteid']; ?>"><?php echo $inst['entranceexam_insitutename']; ?></option>
                                    <?php } ?>
                                    </select>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('seat_type'); ?></label>
                                    <div class="col-sm-6">
                                    <select name="seattype" id="seattype" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select').'&nbsp;&nbsp;'.$this->lang->line('seat_type'); ?></option>
                                    <?php
                                    foreach($allottype as $allot)
                                    {
                                    ?>
                                    <option value="<?php echo $allot['entrance_allot_type_id']; ?>"><?php echo $allot['entrance_allot_type_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    </div>
                                    
                                    <div class="col-sm-3" id="divno">
                                   Total:&nbsp;<span id="seatno"></span>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" id="description" name="description" placeholder=""></textarea>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                                    <input type="submit"  name="submit"  class="btn btn-success" value="ALLOT">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    </div>
                                    </div>
                                    </form>
                                   
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
                                         $('#divno').hide(); 
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
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    $(document).on('change', '#seattype', function (e) 
                                    {
                                    var seattype           = $(this).val();
                                    var entrance_course    = $('#entrance_course').val();
                                    var entrance_institute = $('#entrance_institute').val();
                                    $.ajax({
                                    type: "POST",
                                    data: {'seattype':seattype,'entrance_course':entrance_course,'entrance_institute':entrance_institute},
                                    url: base_url + "entrance_allotment/allotment/getallot_no",
                                    dataType: "json",
                                    success: function (data) 
                                    {
                                        
                                      $('#divno').show(); 
                                        
                                        
                                    $('#seatno').html(data.entrance_allot_seat_seatno);
                                    }
                                    
                                    });
                                    });
                                    
                                    
                                    </script>