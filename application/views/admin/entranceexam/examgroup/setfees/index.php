                <?php
                $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
                $language = $this->customlib->getLanguage();
                $language_name = $language["short_code"];
                ?>
                <style type="text/css">
                
                @media print {
                .no-print {
                visibility: hidden !important;
                display:none !important;
                }
                }
                </style>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                
                <section class="content-header">
                <h1>
                <i class="fa fa-usd"></i><?php echo $this->lang->line('set').'&nbsp;'.$this->lang->line('fees'); ?></h1>
                </section>
                
                
                
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary" style="padding-bottom: 100px">
                    
                    
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('set').'&nbsp;'.$this->lang->line('fees'); ?></h3>
                </div><!-- /.box-header -->
           
           
                <form id="assign_form" action="<?php echo site_url('entrance_allotment/set_fees/addval'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php echo $this->customlib->getCSRF(); ?>
                <div class="row">
                    
                <div class="box-body">
                    
                <div class="form-group">
                <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                <select  id="session" name="session" class="form-control select2"  >
                <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
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
                    
                <div class="form-group">
                <label><?php echo $this->lang->line('phase') ?></label><small class="req"> *</small>
                <select  id="entrance_phase" name="entrance_phase" class="form-control select2"  >
                <option value="">Select Phase</option>
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
                
                
                <div class="form-group">
                <label><?php echo  $this->lang->line('title'); ?></label><small class="req"> *</small>
                <input type="text" name ="entrance_title" id="entrance_title" class="form-control"  >
                <span class="text-danger"><?php echo form_error('entrance_title'); ?></span>
                </div>
                
                
                <div class="form-group">
                <label><?php echo  $this->lang->line('fees'); ?></label><small class="req"> *</small>
                <input type="number" name ="entrance_fees" class="form-control "  >
                <span class="text-danger"><?php echo form_error('entrance_fees'); ?></span>
                </div>
               
             
                <!--
                <div class="form-group">
                <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                <select  id="entrance_course" name="entrance_course" class="form-control select2"  >
                <option value="">Select All Course</option>
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
                -->
                
                
                <div class="form-group">
                <label><?php echo $this->lang->line('course'); ?></label><small class="req"> *</small>
                <div>
                <?php foreach ($course as $cou) { ?>
                <div class="form-check">
                <input type="checkbox"  
                id="course_<?php echo $cou['entranceexam_course_id']; ?>" 
                name="entrance_course[]" 
                value="<?php echo $cou['entranceexam_course_id']; ?>"
                class="form-check-input"
                <?php echo (set_value('entrance_course') && in_array($cou['entranceexam_course_id'], (array)set_value('entrance_course'))) ? 'checked' : ''; ?>
                >
                <label for="course_<?php echo $cou['entranceexam_course_id']; ?>" class="form-check-label">
                <?php echo $cou['entranceexam_course_name']; ?>
                </label>
                </div>
                <?php } ?>
                </div>
                <span class="text-danger"><?php echo form_error('entrance_course'); ?></span>
                </div>
                </div>
                
                
                
                <div class="col-sm-12">
                <div class="form-group">
                <button type="submit"  name="Set Fees" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle">
                <?php echo $this->lang->line('save'); ?></button>
                </div>
                </div>
                
                </div>
                </form>
                
                
                
                </div>
                </div><!--/.col (right) -->
                <!-- left column -->
                <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><?php echo $this->lang->line('set').'&nbsp;'.$this->lang->line('fees'); ?> </h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example" >
                <thead>
                    
                <tr>
                <th><?php echo $this->lang->line('slno'); ?> </th>
                <th><?php echo $this->lang->line('phase'); ?> </th>
                <th><?php echo $this->lang->line('session'); ?> </th>
                <th><?php echo $this->lang->line('course'); ?> </th>
                <th><?php echo $this->lang->line('date'); ?> </th>
                <th><?php echo $this->lang->line('application'); ?></th>
                <th><?php echo $this->lang->line('fees'); ?></th>
                <th><?php echo $this->lang->line('status'); ?></th>
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                
                </tr>
                </thead>
                <tbody>
                    
                    
                <?php
                

                $count = 1;
                foreach ($get_fees_status as $fee_status) 
                { 
                ?>
                <tr>                                                  
                <td><?php echo $count; ?></td>
                <td><?php echo $fee_status['entrance_examgroup_name']; ?></td>
                <td><?php echo $fee_status['session']; ?></td>
                <td><?php echo $fee_status['course_names']; ?></td>
                
              
                <td><?php echo $fee_status['entrance_setfees_createddate']; ?></td>
                <td><?php echo $fee_status['entrance_setfees_fees_title']; ?></td>
                <td><?php echo $fee_status['entrance_setfees_fees']; ?></td>
                
                
                <td>
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $fee_status['entrance_setfees_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($fee_status['entrance_setfees_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $fee_status['entrance_setfees_id']; ?>, this.checked)">
                <label for="is_status_<?php echo $fee_status['entrance_setfees_id']; ?>" class="label-success"></label>
                </div>
                </td>
                
                
                <td align="right">
                <a data-placement="left" href="<?php echo site_url();?>entrance_allotment/set_fees/editval/<?php echo $fee_status['entrance_setfees_id']; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a> 
                <a data-placement="left" href="<?php echo site_url(); ?>entrance_allotment/set_fees/delval/<?php echo  $fee_status['entrance_setfees_id']; ?>" class="btn btn-default btn-xs"   style="color:red" data-toggle="tooltip"   onclick="return doconfirm();"  title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
                </td>
                
                </tr>                                        
                <?php
                $count++;
                }
                ?>
                </tbody>
                </table>
                </div>
                </div>
                </div>
                </div>
                </div>
                </section>
                </div>
                
                
                
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>


$(document).ready(function() 
{   
    
    $('#entrance_phase, #entrance_title').change(function() 
    {
        var phaseId = $('#entrance_phase').val();
        var entrance_title = $('#entrance_title').val(); 
    
        if (phaseId !== ""  && entrance_title !== "" )
        {
            $.ajax({
                url: base_url + "entrance_allotment/set_fees/get_course_status",
                type: 'POST',
                data: { phase_id: phaseId,entrance_title:entrance_title },
                dataType: 'json',
                success: function(response) 
                {
                    // Ensure response is parsed correctly
                    if (typeof response === "string") 
                    {
                        response = JSON.parse(response);
                    }
                    
                    if (Array.isArray(response) && typeof response[0] === "string")
                    {
                        response = JSON.parse(response[0]);
                    }

                    $('.form-check-input').prop('checked', false); 

                    if (Array.isArray(response))
                    {
                        response.forEach(function(courseId) 
                        {
                            $('#course_' + courseId).prop('checked', true);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        } else {
            $('.form-check-input').prop('checked', false); // Reset checkboxes
        }
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
            
            
            function ConfirmDelete(obj) 
            { 
            var x = confirm("Are you sure you want to delete?"); 
            if (x == true) 
            {
            var id = $(obj).data('id');
            if (id != '')
            {
            $.ajax({
            type: "POST",
            url: "<?php echo site_url('entrance_allotment/seatquota/delval'); ?>",
            cache: false,
            data: {'id': id},
            success: function (data) 
            {
            console.log('ajax returned: ');
            console.log(data);
            
            if (data) 
            {
            alert("Deleted Successfully");
            }
            else
            {
            alert("ERROR");
            }
            location.reload(true);
            return false;
            
            }
            });
            }
            }
            else
            {
            return false;
            }
            }
            
            
            function ConfDelete(obj) 
            { 
            var x = confirm("Are you sure you want to delete?"); 
            if (x == true) 
            {
            var id = $(obj).data('id');
            if (id != '')
            {
            $.ajax({
            type: "POST",
            url: "<?php echo site_url('entrance_allotment/seatquota/deleligibleval'); ?>",
            cache: false,
            data: {'id': id},
            success: function (data) 
            {
            console.log('ajax returned: ');
            console.log(data);
            
            if (data) 
            {
            alert("Deleted Successfully");
            }
            else
            {
            alert("ERROR");
            }
            location.reload(true);
            return false;
            }
            });
            }
            }
            else
            {
            return false;
            }
            }
        
        
            $('#entrance_allot_type_name').change(function()
            {
            $('#entrance_eligiblepercentage').val("");
            var type_name       = $(this).val();
            var courseid        = $('#courseid').val();
            var sessionid       = $('#sessionid').val();
            var entrance_phase  = $('#entrance_phase').val();
         
            $.ajax({
            type: "POST",
            url: "<?php echo site_url('entrance_allotment/seatquota/getvalue'); ?>",
            cache: false,
            data: {'type_name': type_name,'courseid': courseid,'sessionid': sessionid,'entrance_phase':entrance_phase},
            success: function (result) 
            {
            var data = JSON.parse(result);
            $('#entrance_eligiblepercentage').val(data.entranceexam_eligiblequota_elig_percentage);
            }
            });
            });
            
            
            
            function updateStatus(Id, status) 
            {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('entrance_allotment/set_fees/update_status'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
            console.log('Status updated successfully');
            }
            };
            xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
            }
            </script> 

                                    
                                    
                                  