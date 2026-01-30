                <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">  
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
                <i class="fa fa-usd"></i> <?php echo $this->lang->line('faculty'); ?></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="col-md-12">
                <?php
                $this->load->view('layout/topbar_activities'); ?>
                </div>
                &nbsp;
                <div class="row">
                <?php
                // if ($this->rbac->hasPrivilege('faculty', 'can_add')) {
                ?>
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('assign').'&nbsp;&nbsp;'.$this->lang->line('teacher'); ?></h3>
                </div><!-- /.box-header -->





                <form id="form1" action="<?php echo site_url('semester_activities/teacher_subject_assignments/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="box-body">
                <?php
                /* if ($this->session->flashdata('msg')) {?>
                <?php echo $this->session->flashdata('msg') ?>
                <?php }
                */
                ?>
                <?php
                // if (isset($error_message)) {
                // echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                // }
                ?>

                <?php echo $this->customlib->getCSRF(); ?>

                <!-- <div class="form-group">
                <label for="exampleInputEmail1">Teacher Name</label>         
                <select name="teacher_id" id="teacher_id" class="form-control"> 
                <option value="">--Select Teacher--</option>

                </select>
                <span class="text-danger"><?php echo form_error('faculty_name'); ?></span>
                </div> -->




                <?php
                /*

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
                <select name="program_type" id="program_type" class="form-control"  >
                <option value=""><?php echo $this->lang->line('type'); ?></option>

                <?php
                foreach($Programmetype_list as $prog_type)
                {
                ?>
                <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
                <?php 
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('program_type'); ?></span>
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?><small class="req"> *</small></label>
                <select name="programe" id="programe" class="form-control" >
                <option></option>
                </select>
                <span class="text-danger"><?php echo form_error('programe'); ?></span>
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1">Batch Group<small class="req"> *</small></label> 
                <select name="batch_group" id="batch_group" class="form-control"  >
                <option value="">Select Batch</option>

                <?php
                foreach($batch_group as $batch)
                {
                ?>
                <option value="<?php echo  $batch['batch_group_id']; ?>"<?php if(set_value('batch_group')==$batch['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $batch['batch_group_name'].'&nbsp;&nbsp;'.$batch['batch_group_year']; ?> </option>
                <?php 
                }
                ?>
                </select>       
                <span class="text-danger"><?php echo form_error('batch_group'); ?></span>
                </div>


                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>
                <select name="semester_semtype" id="semester_semtype"  class="form-control">
                <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
                <?php
                foreach($semestertype_list as $sem_type)
                {
                ?>
                <option value="<?php  echo $sem_type['st_id'];  ?>"

                <?php
                if(set_value('semester_semtype')==$sem_type['st_id'])
                {
                echo "selected=selected";
                }
                ?>
                ><?php  echo $sem_type['st_name'];  ?></option>
                <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('semester_semtype'); ?></span>
                </div> 

                <?php */ ?>


                <div class="form-group">           
                <?= dropdownlist(
                $programs,
                set_value('program')
                ); ?>
                <span class="text-danger"><?= form_error('program'); ?></span>
                </div> 


                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="batchtype_id" name="batchtype_id" class="form-control">
                <option value="">-- Select Batch --</option>
                </select>
                <span class="text-danger"><?= form_error('batchtype_id'); ?></span>
                </div> 


                <div class="form-group">
                <label>Semester Term <small class="req">*</small></label>
                <select id="semester_term" name="semester_term" class="form-control" >
                <option value="">-- Select Batch First --</option>
                </select>
                <span class="text-danger"><?= form_error('semester_term'); ?></span>
                </div> 


                <input type="hidden" name="sem_group_id" id="sem_group_id" value="" >



                <!-- <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>
                <select name="semester_term" id="semester_term" class="form-control"  >
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
                </div> -->





                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?><small class="req"> *</small></label>
                <select name="subject_groups" id="subject_groups"  class="form-control" >
                <option value=""><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?></option>                  
                <?php
                foreach($subject_groups as $subjects)
                {
                ?>
                <option value="<?php  echo $subjects['id'];  ?>"

                <?php
                if(set_value('subject_groups')==$subjects['id'])
                {
                echo "selected=selected";
                }
                ?>
                ><?php  echo $subjects['name'];  ?></option>
                <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('subject_groups'); ?></span>
                </div>


                

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?><small class="req"> *</small></label>
                <select name="subjects" id="subjects"  class="form-control">                 
                </select>
                <span class="text-danger"><?php echo form_error('subjects'); ?></span>
                </div>




                <div class="form-group">
                <label for="paper">Paper<small class="req"> *</small></label>
                <select id="paper" name="paper[]"  multiple class="form-control">
                <option value="">Select Paper</option>
                <!-- Options will be populated dynamically via JS -->
                </select>
                <span class="text-danger"><?php echo form_error('paper[]'); ?></span>
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1">Teacher Name<small class="req"> *</small></label>         
                <select name="teacher" id="teacher" class="form-control"> 
                <option value="">--Select Teacher--</option>
                <?php
                foreach($teaching_staff as $staff)
                {
                ?>
                <option value="<?php echo $staff['staff_id']; ?>">

                <?php echo $staff['name']; ?>
                </option>
                <?php } ?>

                </select>
                <span class="text-danger"><?php echo form_error('teacher'); ?></span>

                <input type="hidden" name="branch_id" id="branch_id"  >
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
                if ($this->rbac->hasPrivilege('faculty', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"> <?php echo $this->lang->line('assign').'&nbsp;&nbsp;'.$this->lang->line('teacher'); ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">

                <div class="table-responsive mailbox-messages">

                <button type="button" id="delete_selected" class="btn btn-danger pull-right"><?php echo $this->lang->line('delete'); ?>&nbsp;<i class="fa fa-trash"></i></button>
                <br>
                <br>
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr>

                <th><input type="checkbox" id="select_all"></th>
                <th><?php echo $this->lang->line('teacher'); ?>
                </th>
                <th><?php echo $this->lang->line('programme'); ?>
                </th>
                <th><?php echo $this->lang->line('semester'); ?>
                </th>
                <th><?php echo $this->lang->line('batch'); ?>
                </th>

                <th><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?>
                </th>

                <th><?php echo $this->lang->line('subject'); ?>
                </th>

                <th><?php echo $this->lang->line('paper'); ?></th>

                <th><?php echo $this->lang->line('status'); ?>
                </th>

                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>

                    <?php

                    foreach($assign_teacher as $teach)
                    {
                    ?>
                    <tr>
                    <td><input type="checkbox" class="allcheckbox" value="<?php echo $teach['id']; ?>"></td>
                    <td><?php echo $teach['name'] ; ?></td>
                    <td><?php echo $teach['p_name'] ; ?></td>
                    <td><?php echo $teach['st_name'] ; ?></td>
                    <td><?php echo $teach['batch_group_name'].'&nbsp;&nbsp;'.$teach['batch_group_year'] ; ?></td>
                    <td><?php echo $teach['sub_group'] ; ?></td>

                    <td><?php  echo $teach['subjects'];?></td>
                    <td><?php  echo $teach['sem_paper_paper'];?></td>



                    <td>
                    <div class="material-switch switchcheck">
                    <input id="is_status_<?php echo $teach['assign_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($teach['assign_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $teach['assign_id']; ?>, this.checked)">
                    <label for="is_status_<?php echo $teach['assign_id']; ?>" class="label-success"></label>
                    </div>
                    </td>

                    <td text-align="right">
                    <a data-placement="left" href="<?php echo site_url('semester_activities/teacher_subject_assignments/edit/' . $teach['assign_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                    <a data-placement="left" href="<?php echo site_url('semester_activities/teacher_subject_assignments/delete/' . $teach['assign_id']); ?>" onclick="return doconfirm();"  class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
                    </td>
                    </tr>
                    <?php } ?>
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



                function updateStatus(id, status) 
                {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo site_url('semester_activities/teacher_subject_assignments/update_status'); ?>", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                console.log('Status updated successfully');
                }
                };
                xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
                }


                // $(document).ready(function()
                // {
                // $('#program_type').change(function()
                // { 
                // var prog_type_id = $(this).val();
                // if(prog_type_id != ''){
                // $.ajax({
                // url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
                // method: "POST",
                // data: { prog_type_id: prog_type_id },
                // dataType: "json",
                // success: function(data){
                // $('#programe').empty();
                // $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                // $.each(data, function(key, value){
                // $('#programe').append('<option value="'+ value.id +'">'+ value.p_name +'</option>');
                // });
                // }
                // });
                // } else {
                // $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                // }
                // });
                // });                    




                $(document).ready(function() {
                $('#subject_groups').change(function() 
                {
                var group_id = $(this).val();         
                if(group_id != '')
                {
                $.ajax({
                url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_subjects'); ?>",
                method: "POST",
                data: {group_id: group_id},
                dataType: "json",
                success: function(data)
                {                  
                $('#subjects').empty();
                $('#subjects').append('<option value="">Select Subject</option>');
                $.each(data, function(key, value) {
                $('#subjects').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
                }
                });
                } else {
                $('#subjects').empty();
                $('#subjects').append('<option value="">Select Subject</option>');
                }
                });
                });      




                $(document).ready(function() {
                $('#subjects').change(function() {
                var subject_id  = $(this).val();
                var $paper      = $('#paper');
                $paper.empty(); // Clear previous options first
                $paper.append('<option value="">Select Paper</option>');  // Default option

                if(subject_id != '') {
                $.ajax({
                url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_papers'); ?>",
                method: "POST",
                data: { subject_id: subject_id },
                dataType: "json",
                success: function(data) {
                if(data.length > 0) {
                $.each(data, function(key, value) {
                $paper.append('<option value="'+ value.sem_paper_id +'">'+ value.sem_paper_paper +'</option>');
                });
                } else {
                $paper.append('<option value="">No papers available</option>');
                }
                }
                });
                }
                });
                });






                $(document).ready(function() 
                {
                $('#program, #batchtype_id, #semester_term').change(function() 
                {
                var prog      = $('#program').val();
                var bat       = $('#batchtype_id').val();
                // var sem       = $('#semester_semtype').val(); 
                var sem       =  1;
                var sem_term  = $('#semester_term').val();                 

                if( prog && bat && sem && sem_term) {
                $.ajax({
                url: '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
                type: 'POST',
                data: { 
                prog     : prog,
                bat      : bat,
                sem      : sem,
                sem_term : sem_term,

                },
                success: function(response) 
                {
                var res = JSON.parse(response);  // Convert string to object
                console.log(res.sem_group_id);   // Should log "42"
                $('#sem_group_id').val(res.sem_group_id); 
                }
                });
                }
                });
                });


                // $(document).ready(function() 
                // {
                // $('#programe, #batch_group, #semester_semtype,#semester_term').change(function() 
                // {
                // var prog      = $('#programe').val();
                // var bat       = $('#batch_group').val();
                // var sem       = $('#semester_semtype').val(); 
                // var sem_term  = $('#semester_term').val();                 

                // if( prog && bat && sem && sem_term) {
                // $.ajax({
                // url: '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
                // type: 'POST',
                // data: { 
                // prog     : prog,
                // bat      : bat,
                // sem      : sem,
                // sem_term : sem_term,

                // },
                // success: function(response) 
                // {
                // var res = JSON.parse(response);  // Convert string to object
                // console.log(res.sem_group_id);   // Should log "42"
                // $('#sem_group_id').val(res.sem_group_id); 
                // }
                // });
                // }
                // });
                // });



                $(document).ready(function() {
                $('#teacher').change(function() 
                {
                var teacher_id = $(this).val();      
                if(teacher_id != '') {
                $.ajax({
                url: '<?php echo base_url("semester_activities/teacher_subject_assignments/get_teacher_branch"); ?>',
                method: 'POST',
                data: { teacher_id: teacher_id },
                dataType: 'json',
                success: function(response) {                    
                $('#branch_id').val(response.branch_id); // fill branch input
                }
                });
                } else {
                $('#branch_id').val('');
                }
                });
                });


                // Bulk delete
                $("#delete_selected").on("click", function () {
                var ids = [];
                $(".allcheckbox:checked").each(function () {
                ids.push($(this).val());
                });

                if (ids.length === 0) {
                alert("Please select at least one batch to delete.");
                return;
                }

                if (confirm("Are you sure you want to delete selected list?")) {
                $.ajax({
                url: "<?= base_url('semester_activities/Teacher_subject_assignments/bulkDelete') ?>",
                type: "POST",
                data: {ids: ids},
                success: function (response) {
                location.reload(); // refresh after delete
                }
                });
                }
                });
                </script>







