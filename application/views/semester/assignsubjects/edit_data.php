             <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
            
            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            $language = $this->customlib->getLanguage();
            $language_name = $language["short_code"];
            ?>


            <style type="text/css">
            @media print 
            {
            .no-print 
            {
            visibility: hidden !important;
            display:none !important;
            }
            }

            </style>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

            <section class="content-header">
            <h1>
            <i class="fa fa-usd"></i> Assign Subjects </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                 <div class="col-md-12">
              <?php
               $this->load->view('layout/topbar'); ?>
              </div>
              &nbsp;
            <div class="row">
            <?php
            // if ($this->rbac->hasPrivilege('semester', 'can_add')) {
            ?>
            <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-primary">
            <div class="box-header with-border">  

            <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('assign_subject'); ?></h3>
            </div><!-- /.box-header -->

            <?php
            $selected_groups = explode(',', $edit_assigned_subjects['as_subjectgroup']);            
            ?>

            <br>
            <form id="form1" action="<?php echo site_url('semester/assignsubjects/edit/'.$id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">


            <div class="box-body">
            <?php             
            echo $this->customlib->getCSRF(); ?> 
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
            <select name="program_type" id="program_type" class="form-control" > 
            <?php
            foreach($Programmetype_list as $prog_type)
            {
            ?>
            <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if($edit_assigned_subjects['prog_type_id']==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
            <?php 
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('program_type'); ?></span>
            </div>



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?><small class="req"> *</small></label>
            <select name="programe" id="programe" class="form-control">
            <option value="<?php  echo $edit_assigned_subjects['as_programs'];  ?>"><?php  echo $edit_assigned_subjects['p_name'];  ?></option>

            </select>
            <span class="text-danger"><?php echo form_error('programe'); ?></span>
            </div>

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_type'); ?><small class="req"> *</small></label>
            <select name="semester_type" id="semester_type" class="form-control" >

            <?php
            foreach($semestertype_list as $sem_type)
            {
            ?>
            <option value="<?php  echo $sem_type['st_id'];  ?>"

            <?php
            if($edit_assigned_subjects['sem_group_semester']==$sem_type['st_id'])
            {
            echo "selected=selected";
            }
            ?>
            ><?php  echo $sem_type['st_name'];  ?></option>
            <?php
            }
            ?>
            </select>            
            <span class="text-danger"><?php echo form_error('semester_type'); ?></span>
            </div>  


            <div class="form-group">
                <label for="exampleInputEmail1">Semester Term<small class="req"> *</small></label>
                <select name="semester_term" id="semester_term" class="form-control" >
                <option value="">Select Semester</option>

                <?php
                foreach($semester_term as $term)
                {
                ?>
                <option value="<?php echo  $term['stm_id']; ?>"<?php if(set_value('semester_term')==$term['stm_id']) { echo "selected=selected"; }        ?> ><?php echo  $term['stm_name']; ?> </option>
                <?php 
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('semester_term'); ?></span>
                </div>
            
            
          

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('assign_subjects'); ?><small class="req"> *</small></label>            
            <select name="batch_group" id="batch_group" class="form-control">
            <?php foreach ($batch_group as $batch): ?>
            <option value="<?php echo $batch['batch_group_id']; ?>"
            <?php echo ($edit_assigned_subjects['sem_group_batchgroup'] == $batch['batch_group_id']) ? 'selected="selected"' : ''; ?>>
            <?php echo $batch['batch_group_name'] . ' ' . $batch['batch_group_year']; ?>
            </option>
            <?php endforeach; ?>
            </select>
            <span class="text-danger"><?php echo form_error('batch_group'); ?></span>         
            </div> 


             <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('assign_subjects'); ?></label> 
            <div>  
            <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
            <!-- <?php foreach ($subject_groups as $subjects): ?>
            <div class="checkbox">
            <label>
            <input type="checkbox" name="subject_groups[]" value="<?php echo $subjects['id']; ?>"
            <?php echo in_array($subjects['id'], $checked_ids) ? 'checked' : ''; ?>>
            <?php echo $subjects['name']; ?>
            </label>
            </div>
            <?php endforeach; ?> -->



            <?php foreach ($subject_groups as $subjects): ?>
            <div class="checkbox">
            <label>
            <input type="checkbox" name="subject_groups[]" value="<?php echo $subjects['id']; ?>"
            <?php echo in_array($subjects['id'], $checked_ids) ? 'checked' : ''; ?>>
            <?php echo $subjects['name']; ?>
            </label>
            </div>
            <?php endforeach; ?>



            </div>
            </div> 
            </div>    
           


            </div><!-- /.box-body -->

            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            </div>
            </form>
            </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <?php //} ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('semester', 'can_add')) {
            echo "8";
            } else {
            echo "12";
            }
            ?>">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('semester'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">

            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <th><input type="checkbox" id="select_all"></th>
            <th><?php echo $this->lang->line('slno'); ?></th>
<<<<<<< HEAD
            <th><?php echo $this->lang->line('type'); ?> </th>
            <th><?php echo $this->lang->line('programee'); ?> </th>
=======
            <th><?php echo $this->lang->line('type'); ?>/<?php echo $this->lang->line('programee'); ?> </th>
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

            <th><?php echo $this->lang->line('semester'); ?> </th>
            <th><?php echo $this->lang->line('batch'); ?> </th>
            <th><?php echo $this->lang->line('subject').'&nbsp;'.$this->lang->line('group'); ?> </th>

            <th><?php echo $this->lang->line('status'); ?></th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            $slno   =1;
            foreach($get_assigned_subjects as $subjects)
            {
            ?>
            <tr>
            <td><input type="checkbox" class="allcheckbox" value="<?php echo $subjects['sem_assign_id']; ?>"></td>
            <td><?php  echo $slno; ?></td>
<<<<<<< HEAD
            <td><?php  echo $subjects['prog_type_name']; ?></td>
            <td><?php  echo $subjects['p_name']; ?></td>
=======
            <td><?php echo trim(($subjects['prog_type_name'] ? $subjects['prog_type_name'].' - ' : '').$subjects['p_name']); ?></td>
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            <td><?php  echo $subjects['st_name']; ?></td>
            <td><?php  echo $subjects['batch_group_name']; ?></td> 
            <td><?php  echo $subjects['group_names']; ?></td>           
            <td>
            <div class="material-switch switchcheck">
            <input id="is_status_<?php echo $subjects['sem_assign_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($subjects['sem_assign_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $subjects['sem_assign_id']; ?>, this.checked)">
            <label for="is_status_<?php echo $subjects['sem_assign_id']; ?>" class="label-success"></label>
            </div>
            </td>


            <td text-align="right">
            <!-- <a data-placement="left" href="<?php echo site_url('semester/assignsubjects/edit/' . $subjects['sem_assign_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a> -->
            <a data-placement="left" href="<?php echo site_url('semester/assignsubjects/delete/' . $subjects['sem_assign_id']); ?>" onclick="return doconfirm();"  class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
            </td>
            </tr>

            <?php 
            $slno++;
            } ?>
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
            </div>
            </div>




            <script>
            $(document).ready(function()
            {
            $('#program_type').change(function()
            {  
            var prog_type_id = $(this).val();
            if(prog_type_id != ''){
            $.ajax({
            url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
            method: "POST",
            data: { prog_type_id: prog_type_id },
            dataType: "json",
            success: function(data){
            $('#programe').empty();
            $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            $.each(data, function(key, value){
            $('#programe').append('<option value="'+ value.id +'">'+ value.p_name +'</option>');
            });
            }
            });
            } else {
            $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            }
            });
            });




            $(document).ready(function () {

            function checkExistingSubjects() {
            var program = $('#programe').val();
            var batch = $('#batch_type').val();
            var semester = $('#semester_type').val();      

            if (program && batch && semester) {
            $.ajax({
            url: "<?php echo site_url('semester/assignsubjects/getAssignedSubjectGroups'); ?>",
            type: "POST",
            dataType: "json",
            data: {
            programe: program,
            batch_type: batch,
            semester_type: semester,
            // <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success: function (response) {
            // Uncheck all first
            $("input[name='subject_groups[]']").prop('checked', false);

            if (response.status === 'exists') {
            // Loop through existing group IDs and check them
            response.subject_groups.forEach(function (groupId) {
            $("input[name='subject_groups[]'][value='" + groupId + "']").prop('checked', true);
            });
            }
            },
            error: function () {
            console.error("Error checking subject group assignment.");
            }
            });
            }
            }

            $('#programe, #batch_type, #semester_type').on('change', function () {
            checkExistingSubjects();
            });

            });
            </script>








