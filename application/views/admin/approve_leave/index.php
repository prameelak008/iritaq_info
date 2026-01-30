<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-flask"></i> <?php echo $this->lang->line('approve') . " " . $this->lang->line('leave'); ?>
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>

            </div>
            <form  class="assign_teacher_form" action="<?php echo base_url(); ?>admin/approve_leave" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                           <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>

                            <?php echo $this->customlib->getCSRF(); ?>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select autofocus="" id="searchclassid" name="class_id" onchange="getSectionByClass(this.value)"  class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($classlist as $class) {
                                        ?>
                                        <option <?php
                                        if ($class_id == $class["id"]) {
                                            echo "selected";
                                        }
                                        ?> value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                <span class="class_id_error text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                <select  id="secid" name="section_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="class_id_error text-danger"><?php echo form_error('section_id'); ?></span>
                            </div>
                        </div>

                    </div>
                    <button type="submit" id="search_filter" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                </div>
            </form>
            
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('approve') . " " . $this->lang->line('leave') . " " . $this->lang->line('list'); ?></h3>

                        <div class="box-tools pull-right">
                            <button type="button" onclick="add_leave()" class="btn btn-sm btn-primary " data-toggle="tooltip" data-placement="left" ><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                        </div>

                    </div>
                    <div class="box-body table-responsive">
                        <div class="download_label"> <?php echo $this->lang->line('approve') . " " . $this->lang->line('leave') . " " . $this->lang->line('list'); ?> </div>
                        <div >
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('student_name') ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('apply') . " " . $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('from') . " " . $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('from') . " " . $this->lang->line('time'); ?></th>
                                        <th><?php echo $this->lang->line('to') . " " . $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('to') . " " . $this->lang->line('time'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th><?php echo $this->lang->line('approve') . " " . $this->lang->line('by'); ?></th>
                                        <th class="pull-right"><?php echo $this->lang->line('return_report_date_time'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row_count = 1;
                                    $perc="";
                                    foreach ($results as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $this->customlib->getFullName($value['firstname'],$value['middlename'],$value['lastname'],$sch_setting->middlename,$sch_setting->lastname); ?></td>
                                            <td><?php echo $value['class']; ?></td>
                                            <td><?php echo $value['section']; ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value['apply_date'])); ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value['from_date'])); ?></td>
                                            <td><?php echo $value['leave_from_time']; ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value['to_date'])); ?></td>
                                            <td><?php echo $value['leave_to_time']; ?></td>
                                            <?php
                                            $to=date($this->customlib->getSchoolDateFormat(), strtotime($value['to_date']));
                                            $totime=$value['leave_to_time']; 
                                            ?>

                                            <td ><?php
                                                if ($value['status'] == 0) {
                                                    echo $this->lang->line('pending');
                                                } else {
                                                    echo $this->lang->line('approve');
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $value['staff_name'] . " " . $value['surname']; ?></td>
                                            
                                            
                                           
                                           
                                <td class="pull-right">
                                <div class="panel panel-default" >
                                <div class="panel-heading" role="tab" id="heading<?php echo $row_count ?>">
                                <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row_count; ?>" aria-expanded="false">Return Report Date & Time Details
                                
                                <?php
                                $dateval  = $value['reported_time'];
                                $arr      = explode(' ', $dateval);
                                if($arr[0]!="")
                                {
                                ?>
                                <i class="fa fa-check-circle" style="font-size:25px; color:green;"></i>
                                <?php
                                }
                                ?>
                                </a>
                                </h4>
                                </div>
                                <div id="collapse<?php echo $row_count; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $row_count; ?>">
                                <div class="panel-body">
                                <table class="table" style="width:500px;"  >
                                <thead class="thead-dark">
                                    
                                    
                                <tr>
                                <th style="width:250px; color:red; text-align:left; font-size: 16px; white-space: nowrap;background-color: #f0f0f0;
    border: 2px solid black; padding:10px 10px 10px 10px; font-weight:100px;"   >Reporting Date and Time</th>
                                <th style="width:250px; color:red; text-align:left; font-size: 16px; border-top: 2px solid black;border-bottom: 2px solid black; padding:10px 10px 10px 10px;" colspan="2"><span><?php echo $to;   ?></span>
                                
                                <input type="hidden" name="reporting" id="reporting<?php echo $row_count; ?>" value="<?php  echo $to;  ?>" />
                                <input type="hidden" name="reportingtime" id="reportingtime<?php echo $row_count; ?>" value="<?php  echo $totime;  ?>" />
                                </th>
                                <th style="width:250px; color:red; text-align:left; font-size: 16px;border-top: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;padding:10px 10px 10px 10px; " ><span ><?php echo $totime;   ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                <tr>
                                    
                                    <?php
                                    $repted  =  date('Y-m-d H:i',strtotime($to.''.$totime));  ?>
                                    <br>
                                    
                                    <?php $repting   =  date('Y-m-d H:i',strtotime($arr[0].''.$arr[1]));  ?>
                                    
                                    
                                    
                                
                                <input type="hidden" value="<?php echo $value['id']; ?>" id="leavid<?php echo $row_count; ?>" name="leavid" />
                                
                                <td style="width:350px;color:#0c7a0c; font-weight:500px;text-align:left; font-size: 16px; white-space: nowrap; background-color: #f0f0f0;
    border: 2px solid black; padding:10px 10px 10px 10px;" >Reported Date and Time</td>
                                
                                
                                <td style="width:250px; color:red; text-align:left; font-size: 16px; border-top: 2px solid black;border-bottom: 2px solid black; padding:10px 10px 10px 10px;" colspan="2">
                                <input type="date" style="font-size: 16px;color:#0c7a0c; font-weight:500px;" name="reported" id="reported<?php echo $row_count; ?>" value="<?php echo date($arr[0]); ?>" class="form-control"/>   
                                
                                </td>
                                <td style="border-top: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;padding:10px 10px 10px 10px;">
                                    <input type="time" style="font-size: 16px; color:#0c7a0c; font-weight:500px; "  name="reportedtime" id="reportedtime<?php echo $row_count; ?>" value="<?php  echo $arr[1]; ?>" class="form-control"/>   
                                </td>
                                </tr>
                                <tr class="space">
                                <td colspan="3"></td>
                                </tr>
                                <tr border="1px; padding-top:3px;  border-spacing: 5px;">
                                <td colspan="4" style="width:250px;color:black;text-align:left;font-size: 16px;font-weight:500px; border: 2px solid black;">Remarks<textarea rows="6" class="form-control" id="remarks<?php echo $row_count; ?>" name="remarks"><?php echo $value['reported_remarks']; ?></textarea></td></tr>
                                <tr>
                                <td colspan="4">
                                <span style="font-size:15px;">Accuracy : <?php   echo $value['reporting_accuracy']; ?> &nbsp; 
                                
                                <?php
                                if($repted>=$repting)
                                {
                                $perc = " - 100%";
                                }
                                else
                                {
                                $perc= "Late";
                                }
                                echo $perc;
                                ?>
                                
                                <input type="hidden" value="<?php  echo $perc; ?>" name="perc" id="perc<?php echo $row_count; ?>" />
                                </span>
                                </td>
                                </tr>
                                
                                
                                <tr>
                                <td colspan="4">
                                <span style="font-size:15px;">Last Updated On : <?php   echo $value['reporting_updated_time'];  ?></span>
                                </td>
                                </tr>
                                
                                
                                <tr>
                                <td colspan="4" style="width:250px;color:black;text-align:right;">
                                <input type="button" name="submit"  onclick="getrport(<?php echo $row_count; ?>)" class="btn btn-primary" value="SAVE" />    
                                &nbsp;     &nbsp;   
                                <input type="button" style="background-color:red;"  onclick="delreport(<?php echo $row_count; ?>)"  class="btn btn-danger" value="CLEAR">
                                </td>
                                </tr>
                                
                                </tbody>
                                </table>
                                </div>
                                </div>
                                </div>
                                </td>
                                            
                                        <td class="text-right white-space-nowrap">
                                        <?php
                                        if ($value['status'] == 1) {
                                        ?>
                                        <a data-placement="left"  onclick="approve_leave('<?php echo $value['id']; ?>', '0', '<?php echo $value['class_id']; ?>', '<?php echo $value['section_id']; ?>')"  class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('disapprove') ?>"> <i class="fa fa-times"  aria-hidden="true"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                        <a data-placement="left"  onclick="approve_leave('<?php echo $value['id']; ?>', '1', '<?php echo $value['class_id']; ?>', '<?php echo $value['section_id']; ?>')" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('approve') ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($value['docs'] != '') {
                                        ?>
                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/approve_leave/download/<?php echo $value['docs'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('download'); ?>">
                                        <i class="fa fa-download"></i>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                        
                                        <a data-placement="left" onclick="get('<?php echo $value['id']; ?>', '<?php echo $value['class_id']; ?>', '<?php echo $value['section_id']; ?>')" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('edit') ?>"><i class="fa fa-pencil"></i> </a>
                                        
                                        <a data-placement="left" onclick="delete_leave('<?php echo $value['id']; ?>', '<?php echo $value['class_id']; ?>', '<?php echo $value['section_id']; ?>');"  data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('delete') ?>" class="btn btn-default btn-xs"><i class="fa fa-trash" ></i> </a>
                                        
                                        </td>
                                        </tr>
                                        <?php
                                         $row_count++;
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div></section>
</div>


<div class="modal fade" id="homework_docs" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title" id="title"></h4>
            </div>
            <form role="form" id="addleave_form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-body pb0">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                             <!--    <input type="hidden" id="leave_id"  name="leave_id"> -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select type="text" onchange="get_section(this.value)" name="class" id="class" class="form-control ">
                                            <option value="" ><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($classlist as $value) {
                                                ?>
                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['class']; ?></option>
<?php }
?>



                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select type="text" name="section" id="section_id" onchange="get_student(this.value)" class="form-control ">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('student'); ?></label><small class="req"> *</small>
                                        <select type="text" name="student" id="student" class="form-control ">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('apply') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="apply_date" id="apply_date" value="<?php echo set_value('apply_date', date($this->customlib->getSchoolDateFormat())); ?>" class="form-control date">
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('from') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="from_date" id="from_date" class="form-control date date_betweenfrom" onchange="validatedate()"   value="<?php echo set_value('from_date', date($this->customlib->getSchoolDateFormat())); ?>">
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('from') . " " . $this->lang->line('time'); ?></label><small class="req"> *</small>
                                        <input type="time" name="leave_from_time" id="leave_from_time" class="form-control ">
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('to') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small>
                                        <input type="text" name="to_date" id="to_date" onchange="validatedate()"   class="form-control date date_betweento" value="<?php echo set_value('to_date', date($this->customlib->getSchoolDateFormat())); ?>">
                                    </div>
                                </div>
                                
                                 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('to') . " " . $this->lang->line('time'); ?></label><small class="req"> *</small>
                                        <input type="time" name="leave_to_time" id="leave_to_time" class="form-control ">
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('reason'); ?></label>
                                        <input type="hidden" name="leave_id" id="leave_id">
                                        <textarea type="text" id="message" name="message" class="form-control "></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd"><?php echo $this->lang->line('attach_document'); ?></label>
                                        <input type="file" id="file" name="userfile" class="filestyle form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">

                    <div class="pull-right paddA10">
                        <button class="btn btn-info pull-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save'); ?></button>

                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- -->
<script type="text/javascript">


    function getrport(getrport)
    {
    var leavid        = $('#leavid'+getrport).val();
    var reported      = $('#reported'+getrport).val();
    var remarks       = $('#remarks'+getrport).val();
    var reportedtime  = $('#reportedtime'+getrport).val();
    var reporting     = $('#reporting'+getrport).val();
    var reportingtime = $('#reportingtime'+getrport).val();
    var perc          = $('#perc'+getrport).val();
   
           $.ajax({
			url: "<?php  echo site_url();?>/admin/approve_leave/get_reportingtime",
			type: "POST",
			dataType:'json',
			data: {reported:reported,remarks:remarks,leavid:leavid,reportedtime:reportedtime,reporting:reporting,reportingtime:reportingtime,perc:perc},
			success:function(result) 
			{ 
			alert('Updated Suucessfully');
			window.location.reload(true);	
			}
			});	
      }



        function delreport(getrport)
        {
            var leavid       = $('#leavid'+getrport).val();
            var reported     = $('#reported'+getrport).val();
            var remarks      = $('#remarks'+getrport).val();
            var reportedtime = $('#reportedtime'+getrport).val();
            
            
                   $.ajax({
        			url: "<?php  echo site_url();?>/admin/approve_leave/delete_reportingtime",
        			type: "POST",
        			dataType:'json',
        			data: {reported:reported,remarks:remarks,leavid:leavid,reportedtime:reportedtime},
        			success:function(result) 
        			{ 
        				alert('Cleared Reported Time .');
			            window.location.reload(true);
        				
        			}
        			});	
            
        }



    $('#homework_docs').on('hidden.bs.modal', function () {

        $(this).find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        $('#section_id').find('option').not(':first').remove();
        $('#student').find('option').not(':first').remove();
    });

    $(document).ready(function (e) {

        getSectionByClass("<?php echo $class_id ?>", "<?php echo $section_id; ?>");



    });

    function approve_leave(id, status, class_id, section_id) {
        $.ajax({
            url: "<?php echo site_url("admin/approve_leave/status") ?>",
            type: "POST",
            data: {'class_id': class_id, 'section_id': section_id, 'id': id, 'status': status},
            dataType: "json",

            success: function (res)
            {
                if (res.status == 0) {
                    errorMsg(res.error);
                } else {
                    successMsg(res.success);
                    window.location.reload(true);
                }


            }
        });

    }

    function getSectionByClass(class_id, section_id) {
        if (class_id != "") {
            $('#secid').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#secid').addClass('dropdownloading');
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
                    $('#secid').append(div_data);
                },
                complete: function () {
                    $('#secid').removeClass('dropdownloading');
                }
            });
        }
        if (section_id != "") {

            $('#secid').val(section_id);

        }
    }
    function get_section(class_id, section_id = null) {
        if (class_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
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

                }

            });
    }
    }



    function delete_leave(leave_id, class_id, section_id) {
        var confirmation = confirm('<?php echo $this->lang->line('delete_confirm') ?>');
        if (confirmation == true) {


            $.ajax({
                url: "<?php echo site_url("admin/approve_leave/remove_leave") ?>",
                type: "POST",
                data: {'class_id': class_id, 'section_id': section_id, 'id': leave_id},
                dataType: "json",
                success: function (res)
                {
                    if (res.status == 0) {
                        errorMsg(res.error);
                    } else {
                        successMsg(res.success);
                        window.location.reload(true);
                    }


                }
            });
        }
    }

    function get(id, class_id, section_id) {

        $.ajax({
            url: "<?php echo site_url("admin/approve_leave/get_details") ?>",
            type: "POST",
            data: {'class_id': class_id, 'section_id': section_id, 'id': id},
            dataType: 'json',

            success: function (res)
            {
                if (res.status == 0) {
                    errorMsg(res.error)
                } else {
                    $('#apply_date').val(res.apply_date);
                    $('#from_date').val(res.from_date);
                    $('#to_date').val(res.to_date);
                    
                    $('#leave_from_time').val(res.leave_from_time);
                    $('#leave_to_time').val(res.leave_to_time);
                    
                    
                    $('#message').html(res.reason);
                    $('#leave_id').val(res.id);
                    $('#class').val(res.class_id);
                    $('#title').html('<?php echo $this->lang->line('edit') . " " . $this->lang->line('leave'); ?>');
                    get_section(res.class_id, res.section_id);
                    get_student(res.section_id, res.stud_id);
                    $('#homework_docs').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                }

            }
        });

    }

    function get_student(id, student_id = null, section_id = null) {

        $('#student').html("");
        var class_id = $('#class').val();

        $.ajax({
            url: "<?php echo site_url("admin/approve_leave/searchByClassSection") ?>/" + class_id + "/" + student_id,
            type: "POST",
            data: {section_id: id},
            success: function (res)
            {

                $('#student').html(res);
            }
        });
    }

    function add_leave() {
        $('#title').html('<?php echo $this->lang->line('add') . " " . $this->lang->line('leave'); ?>');
        $('#homework_docs').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

    }

    $(document).ready(function () {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });

    $("#addleave_form").on('submit', (function (e) {
        e.preventDefault();

        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("admin/approve_leave/add") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');

            },
            success: function (res)
            {

                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);

                } else {

                    successMsg(res.message);

                    window.location.reload(true);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));

</script>