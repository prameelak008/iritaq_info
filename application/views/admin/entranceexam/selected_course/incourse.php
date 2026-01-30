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
    <i class="fa fa-usd"></i> <?php echo $this->lang->line('Course'); ?></h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-4">
    <!-- Horizontal Form -->
    <div class="box box-primary" style="padding-bottom: 100px">
    <div class="box-header with-border">
    <h3 class="box-title titlefix"> <?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('course').'&nbsp;&nbsp;'.$current_entrancesession['session']; ?></h3>
    </div><!-- /.box-header -->
    
    <form id="form1" action="<?php echo site_url('EntranceExam/add_selected_course'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="box-body">
        
        
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('course'); ?><small class="req"> *</small></label>
    <select name="course" id="course" class="form-control">
    <option value="">Select Course</option>
    <?php
    foreach($get_courselist as $course)
    {
    ?>
    <option value="<?php echo $course['entranceexam_course_id'];  ?>"><?php echo $course['entranceexam_course_name'];  ?></option>
    <?php } ?>
    </select>
    <span class="text-danger"><?php echo form_error('course'); ?></span>
    </div>
    
    
  
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
    <select name="session" id="session" class="form-control">
        
    <?php
    foreach($sessionlist as $session)
    {
    ?>
    <option value="<?php echo $session['id'] ?>" <?php
    if ($current_entrancesession['cur_session'] == $session['id']) 
    {
    echo "selected=selected";
    }
    ?>><?php   echo $session['session']; ?></option>
    <?php } ?>
    </select>
    <span class="text-danger"><?php echo form_error('session'); ?></span>
    </div>
    
    <br>
    
    <div class="form-group">
    <p><b><?php echo $this->lang->line('select').'&nbsp;&nbsp;'.$this->lang->line('phase'); ?></b></p>
    <br>
    <?php
    foreach($get_phase as $phase)
    {
    ?>
    <span style="font-size:15px;"><?php echo $phase['entrance_examgroup_name'];  ?></span>&nbsp;&nbsp;
    <input type="checkbox" style="height:20px; width:20px;" name="phase[]" value="<?php echo $phase['entrance_examgroup_id'];  ?>"/>&nbsp;&nbsp;
    <?php
    }
    ?>
    </div>
    </div>
    
    <div class="box-footer">
    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
    </div>
    </form>
    </div>
    
   
    </div><!--/.col (right) -->
    <!-- left column -->
    <div class="col-md-8">
    <!-- general form elements -->
    <div class="box box-primary">
    <div class="box-header ptbnull">
    <h3 class="box-title titlefix"> <?php echo $this->lang->line('course').'&nbsp;'.$this->lang->line('list').'&nbsp;&nbsp;'.$entrance_current_session['session'];  ?></h3>
    <div class="box-tools pull-right">
    </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
    
    <div class="table-responsive mailbox-messages">
    <table class="table table-striped table-bordered table-hover example" >
    <thead>
        
    <tr>
    <th><?php echo $this->lang->line('session'); ?></th>
    <th><?php echo $this->lang->line('course'); ?> </th>
    <th><?php echo $this->lang->line('phase').'&nbsp;&nbsp;'.$this->lang->line('selected'); ?> </th>
    
    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
    </tr>
    
    </thead>
    <tbody>
        
    <?php
    $count = 0;
    foreach ($getselected_courselist as $crslist) {
    
    $phaselist = json_decode($crslist['sel_entranceexam_course_phaselist'], true);
    ?>
    <tr> 
    <td><?php echo $crslist['session']; ?></td>
    <td><?php echo $crslist['entranceexam_course_name']; ?></td>
    <td>
    <?php
    foreach ($phaselist as $phase) {
    $this->db->select('*');
    $this->db->from('entrance_examgroup');
    $this->db->where(array('entrance_examgroup_id'=> $phase));
    $query = $this->db->get();
    $res= $query->row_array();
    echo $res['entrance_examgroup_name'].",";
    }
    ?>
    </td>
    
    <td align="right">
    <a data-placement="left" href="<?php echo site_url('EntranceExam/edit_selected_course/' . $crslist['sel_entranceexam_course_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
    <a data-placement="left" href="<?php echo site_url('EntranceExam/delete_selected_course/' . $crslist['sel_entranceexam_course_id']); ?>" class="btn btn-default btn-xs" onclick="return doconfirm();"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove" style="color:#cb1515;"></i></a>
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
    </div>
    
    </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
    
        <script type="text/javascript">
        $(document).ready(function() {
        $('#course').change(function() 
        {
            $('input[name="phase[]"]').prop('checked', false); 
            var selectedCourse = $(this).val();
            var selectedSession = $('#session').val();
            $.ajax({
                url: base_url + "EntranceExam/get_phse_lst",
                method: 'POST',
                data: {
                course : selectedCourse,
                session: selectedSession
                },
                success: function(response) 
                {
                var responseData     = JSON.parse(response)[0];
                var selectedPhaseIds = JSON.parse(responseData.sel_entranceexam_course_phaselist);
                $('input[name="phase[]"]').prop('checked', false); // Uncheck all checkboxes initially
                selectedPhaseIds.forEach(function(phaseId) {
                $('input[name="phase[]"][value="' + phaseId + '"]').prop('checked', true);
                });
                },
                error: function(xhr, status, error)
                {
                console.error('AJAX error:', error);
                }
            });
        });
        });
        </script>

    
    
    
    
    
    
