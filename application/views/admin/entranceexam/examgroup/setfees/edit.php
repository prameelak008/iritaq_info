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
                <i class="fa fa-usd"></i> Set Fees</h1>
                </section>
                
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary" style="padding-bottom: 100px">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('edit').'&nbsp;'.$this->lang->line('set').'&nbsp;'.$this->lang->line('fees'); ?></h3>
                </div><!-- /.box-header -->
                
                
                <form id="form1" action="<?php echo site_url('entrance_allotment/set_fees/editval/' . $id); ?>"  id="setfees" name="setfees" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="box-body">
                    
                    
                <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $get_fees['entrance_setfees_id'];    ?>" placeholder="Name" class="form-control" required>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
                
                
                <div class="form-group">
                <label><?php echo $this->lang->line('phase') ?></label><small class="req"> *</small>
                <select  id="entrance_phase" name="entrance_phase" class="form-control select2"  >
                <option value="">Select</option>
                <?php
                foreach($get_phase as $phase)
                {
                ?>
                <option value="<?php echo  $phase['entrance_examgroup_id']; ?>" <?php
                if ($get_fees['entrance_setfees_phase']== $phase['entrance_examgroup_id']) {
                echo "selected=selected";
                }
                ?>><?php echo $phase['entrance_examgroup_name']; ?></option>
                <?php } ?>
                </select>
                
                
                <span class="text-danger"><?php echo form_error('entrance_phase'); ?></span>
                </div>
                
                
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
                
             
                <!--
                <div class="form-group">
                <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                <select  id="entrance_course" name="entrance_course" class="form-control select2"  >
                <?php
                foreach($course as $cou)
                {
                ?>
                <option value="<?php echo  $cou['entranceexam_course_id']; ?>" <?php
                if ($get_fees['entrance_setfees_course'] == $cou['entranceexam_course_id']) {
                echo "selected=selected";
                }
                ?>><?php echo $cou['entranceexam_course_name']; ?></option>
                <?php
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                </div>-->
                
                
                
                <div class="form-group">
                <label><?php echo  $this->lang->line('title'); ?></label><small class="req"> *</small>
                <input type="text" name ="entrance_title" id="entrance_title" class="form-control" value="<?php echo $get_fees['entrance_setfees_fees_title'];    ?>"  >
                <span class="text-danger"><?php echo form_error('entrance_title'); ?></span>
                </div>
                
                
                <div class="form-group">
                <label><?php echo  $this->lang->line('fees'); ?></label><small class="req"> *</small>
                <input type="number" name ="entrance_fees" class="form-control " value="<?php echo $get_fees['entrance_setfees_fees']; ?>" >
                <span class="text-danger"><?php echo form_error('entrance_fees'); ?></span>
                </div>
               
                <?php 
                $courseIds = json_decode($get_fees['entrance_setfees_course'], true); // Decode the JSON string
                   ?>
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
                       <?php 
                       // Check if the current course ID is in the decoded $courseIds array
                       if (in_array($cou['entranceexam_course_id'], $courseIds)) {
                           echo 'checked'; // If it exists, mark the checkbox as checked
                       }
                       ?>
                >
                <label for="course_<?php echo $cou['entranceexam_course_id']; ?>" class="form-check-label">
                    <?php echo $cou['entranceexam_course_name']; ?>
                </label>
            </div>
        <?php } ?>
    </div>
    <!--<span class="text-danger"><?php echo form_error('entrance_course'); ?></span>-->
</div>
                
                
   
<!--
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
                       <?php
                       // Check if the value is in the previously submitted form data
                       $checked = (set_value('entrance_course') && in_array($cou['entranceexam_course_id'], (array)set_value('entrance_course'))) ? 'checked' : '';
                       echo $checked;
                       ?>>
                <label for="course_<?php echo $cou['entranceexam_course_id']; ?>" class="form-check-label">
                    <?php echo $cou['entranceexam_course_name']; ?>
                </label>
            </div>
        <?php } ?>
    </div>
    
</div>
-->

                
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('update'); ?></button>
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
                <a data-placement="left" href="<?php echo site_url();?>entrance_allotment/set_fees/editval/<?php echo $fee_status['entrance_setfees_id']; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('update'); ?>"><i class="fa fa-pencil"></i></a> 
                <a data-placement="left" href="<?php echo site_url(); ?>entrance_allotment/set_fees/delval/<?php echo  $fee_status['entrance_setfees_id']; ?>" class="btn btn-default btn-xs"   style="color:red" data-toggle="tooltip"   onclick="return doconfirm();"  title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
                </td>
                
                </tr>                                        
                <?php
                $count++;
                }
                ?>
                </tbody>
                </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                </div>
                </div><!--/.col (left) -->
                <!-- right column -->
                
                </div>
                
                </section><!-- /.content -->
                </div>
                <script type="text/javascript">
                
                
                
                
                $(document).ready(function() 
                {  
             
                $('#entrance_phase, #entrance_title').change(function() 
                {
                    
                   
                var phaseId        = $('#entrance_phase').val();
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
                
                
                
                
                function doconfirm()
                {
                var job=confirm("Do you want to delete");
                if(job == true)
                {
                return true;
                }
                else
                {
                return false;
                }
                }
                </script>
                
                
                <script>
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
                
                
