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
        <i class="fa fa-usd"></i> <?php echo $this->lang->line('institute'); ?></h1>
        </section>
        
        <!-- Main content -->
        <section class="content">
        <div class="row">
        <!-- <?php
        // if ($this->rbac->hasPrivilege('income', 'can_add')) {
        ?> -->
        <div class="col-md-4">
        <!-- Horizontal Form -->
        <div class="box box-primary" style="padding-bottom: 100px">
        <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;'. $this->lang->line('institute'); ?></h3>
        </div><!-- /.box-header -->
        
        
        <form id="form1" action="<?php echo site_url('EntranceExam/add_institute'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="box-body">
        <!-- <?php if ($this->session->flashdata('msg')) { ?>
        <?php echo $this->session->flashdata('msg') ?>
        <?php } ?> -->
        <!-- <?php
        if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>
        <?php echo $this->customlib->getCSRF(); ?>
        -->
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
        <select name="inst_name" id="inst_name" class="form-control" >
        <option  value="">Select Institute</option>
        <?php
        foreach($institutelist as $inst)
        {
        ?>
        <option value="<?php echo $inst['entranceexam_insitutename']; ?>"><?php echo $inst['entranceexam_insitutename']; ?></option>
        <?php } ?>
        </select>
        <span class="text-danger"><?php echo form_error('inst_name'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('phase'); ?><small class="req"> *</small></label>
        <select name="phase" id="phase" class="form-control" >
        <option  value="">Select Phase</option>
        <?php
        foreach($get_phase as $phse)
        {
        ?>
        <option value="<?php echo $phse['entrance_examgroup_id']; ?>"
        <?php 
        if(set_value('phase')==$phse['entrance_examgroup_id'])
        {
        echo "selected=selected";
        }
        ?> > <?php
        echo $phse['entrance_examgroup_name']; ?></option>
        <?php } ?>
        </select>
        <span class="text-danger"><?php echo form_error('phase'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
        <select name="session" id="session" class="form-control" >
        <!--<option value="<?php echo $current_entrancesession['cur_session']; ?>"><?php echo $current_entrancesession['session']; ?></option>-->
        
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
        
        <!--<select name="session"  class="form-control">
        <?php
        
        foreach($sessionlist as $session)
        {
        ?>
        <option value="<?php echo $session['id'] ?>" <?php
        if ($current_session == $session['id']) 
        {
        echo "selected=selected";
        }
        ?>><?php   echo $session['session']; ?></option>
        <?php } ?>
        </select>-->
        
        
        
        
        <span class="text-danger"><?php echo form_error('session'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('seat'); ?><small class="req"> *</small></label>
        <input type="text" name="inst_seat" placeholder="Enter Seat No" class="form-control" >
        <span class="text-danger"><?php echo form_error('inst_seat'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('course'); ?><small class="req"> *</small></label>
        <select class="form-control" name="inst_course" id="inst_course" >
        <option value="">SELECT COURSE</option>
        <?php foreach($courselist as $crslist){ ?>
        <option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if(set_value('inst_course')==$crslist['entranceexam_course_id'])
        {
        echo "selected=selected";
        }?>><?php echo $crslist['entranceexam_course_name']; ?></option>
        <?php } ?>
        </select>
        
        <span class="text-danger"><?php echo form_error('inst_course'); ?></span>
        <!-- <?php
        $count = 0;
        foreach ($courselist as $crslist) { ?>
        <input type="text" name="inst_course" placeholder="Course" class="form-control" value="<?php echo $crslist['entranceexam_course_name']; ?>" required>
        <?php
        $count++;
        }
        ?> -->
        </div>
        
   
        
      
        
        </div>
        
        <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
        </div>
        </form>
        </div>
        
        </div><!--/.col (right) -->
        <!-- left column -->
        <!--  <?php //} ?> -->
        <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
        <div class="box-header ptbnull">
        <h3 class="box-title"><?php echo $this->lang->line('institute').'&nbsp;'. $this->lang->line('list'); ?></h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        
        <div class="table-responsive mailbox-messages">
        <table class="table table-striped table-bordered table-hover example" >
        <thead>
        <tr>
        <th><?php echo $this->lang->line('name'); ?></th>
        <th><?php echo $this->lang->line('phase'); ?></th>
        <th><?php echo ('Seat'); ?></th>
        <th><?php echo ('Course'); ?></th>
        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        
        
        
        $count = 0;
        foreach ($get_all_institute as $instlist) { ?>
        <tr>                                                  
        <td><?php echo $instlist['entranceexam_insitutename']; ?></td>
        <td><?php echo $instlist['entrance_examgroup_name']; ?></td>
        <td><?php echo $instlist['entranceexam_insituteseats']; ?></td>
        <td><?php echo $instlist['entranceexam_course_name']; ?></td>
        <td align="right">
        <a data-placement="left" href="<?php echo site_url('EntranceExam/edit_institute/' . $instlist['entranceexam_insituteid']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
        <a data-placement="left" href="<?php echo site_url('EntranceExam/delete_institute/' . $instlist['entranceexam_insituteid']); ?>" class="btn btn-default btn-xs" onclick="return doconfirm();"    data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
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
        </div><!-- /.content-wrapper -->
        
        
        
        <script type="text/javascript">
        $(document).ready(function() {
        $('#inst_course,#inst_name').change(function() 
        {
        $('input[name="phase[]"]').prop('checked', false);
        var selectedInstituteName   = $('#inst_name').val();
        var selectedSession         = $('#session').val();
        var selectedCourse          = $('#inst_course').val();
        
        $.ajax({
        url: base_url + "EntranceExam/get_Institute_phse_lst",
        method: 'POST',
        data: {
        institute  : selectedInstituteName,
        session    : selectedSession,
        course     : selectedCourse
        },
        success: function(response) 
        {
        var responseData     = JSON.parse(response)[0];
        var selectedPhaseIds = JSON.parse(responseData.entranceexam_phaselist);
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
        
        
        
        
        
        
