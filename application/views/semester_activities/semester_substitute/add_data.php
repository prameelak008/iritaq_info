            
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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('substitute'); ?></h1>
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




            <h3 class="box-title"><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('substitute'); ?></h3>
            </div><!-- /.box-header -->

            <form id="form1" action="<?php echo site_url('semester_activities/semester_substitute/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

            <div class="box-body">               


            <?php echo $this->customlib->getCSRF(); ?> 



            <div class="form-group">
            <label for="program"><?php echo $this->lang->line('date'); ?></label>
            <input type="date" class="form-control"  name="date" id="date" value="<?php echo date('Y-m-d'); ?>" />
            </div>

            <div class="form-group">
            <label for="program"><?php echo $this->lang->line('day'); ?></label>
            <input type="text" id="day" name="day" class="form-control" readonly />
            </div> 



                <div class="form-group">           
                <?= dropdownlist_program(
                $programs,              // Array of programs from DB
                set_value('prog_id'), 
                ); ?>
                <span class="text-danger"><?= form_error('prog_id'); ?></span>
                </div>


                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_type" name="sem_type" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                <span class="text-danger"><?= form_error('sem_type'); ?></span>
                </div>






            <!-- <div class="form-group">
            <label for="program"><?php echo $this->lang->line('programee_type'); ?></label>
            <select name="program_type" id="program_type" class="form-control" >
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
            <label for="program"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programe" id="programe" class="form-control">
            <option></option>
            </select>
            <span class="text-danger"><?php echo form_error('program_type'); ?></span>
            </div>



            <div class="form-group">
            <label for="semester"><?php echo $this->lang->line('semester_type'); ?></label>
            <select name="semester_semtype" id="semester_semtype" class="form-control" >
            <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
            <?php
            foreach($semestertype_list as $sem_type)
            {
            ?>
            <option value="<?php  echo $sem_type['st_id'];  ?>"

            <?php
            if(set_value('semester_type')==$sem_type['st_id'])
            {
            echo "selected=selected";
            }
            ?>
            ><?php  echo $sem_type['st_name'];  ?></option>
            <?php } ?>
            </select>
       
            </div>
            


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_term'); ?></label>
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
            </div>




            <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('batch'); ?></label>
            <select name="batch_group" id="batch_group" class="form-control" >
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
          
            </div> -->



            <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('group'); ?></label>
            <select name="subject_groups" id="subject_groups" class="form-control" >
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
            <!-- <span class="text-danger"><?php echo form_error('subject_groups'); ?></span> -->
            </div>

              <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?><small class="req"> *</small></label>
                <select name="subjects" id="subjects"  class="form-control">                 
                </select>
                <span class="text-danger"><?php echo form_error('subjects'); ?></span>
                </div>




                <div class="form-group">
                <label for="paper">Paper<small class="req"> *</small></label>
                <select id="paper" name="paper"   class="form-control">
                <option value="">Select Paper</option>
                <!-- Options will be populated dynamically via JS -->
                </select>
                <span class="text-danger"><?php echo form_error('paper[]'); ?></span>
                </div>



            <!-- <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('subject'); ?></label>
            <select name="subject" id="subject" class="form-control" >
            <option value=""><?php echo $this->lang->line('paper'); ?></option>                  
            <?php foreach ($subjectpapers as $paper): ?>
            <option value="<?php echo $paper["subjectpaper_id"]; ?>">
            <?php echo $paper["subjectpaper_papername"]; ?>
            </option>
            <?php endforeach; ?>
            </select>
            <span class="text-danger"><?php echo form_error('paper'); ?></span>
            </div>  -->




        <!-- <div class="form-group">
        <label for="batch"><?php echo $this->lang->line('subject'); ?></label>


            <select name="subject" id="subject" class="form-control" >
            <option value=""><?php echo $this->lang->line('paper'); ?></option>                  
            <?php foreach ($subjectpapers as $paper): ?>
            <option value="<?php echo $paper["subjectpaper_id"]; ?>">
            <?php echo $paper["subjectpaper_papername"]; ?>
            </option>
            <?php endforeach; ?>
            </select>

        </div>

            <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('substituted').'&nbsp;&nbsp;'. $this->lang->line('paper'); ?></label>
            <select class="form-control " name="substitute_subjectpaper" id="substitute_subjectpaper">
            <?php foreach ($subjectpapers as $paper): ?>
            <option value="<?php echo $paper["subjectpaper_id"]; ?>">
            <?php echo $paper["subjectpaper_papername"]; ?>
            </option>
            <?php endforeach; ?>
            </select>
            
            </div> -->


            <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('period'); ?></label>
            <select name="period" id="period" class="form-control" >
            <option value=""><?php echo $this->lang->line('period'); ?></option>                  
            <?php foreach ($period as $peri): ?>
            <option value="<?php echo $peri["periodic_table_id"]; ?>">
            <?php echo $peri["periodic_table_name"]; ?>
            </option>
            <?php endforeach; ?>
            </select>                
            <span class="text-danger"><?php echo form_error('period'); ?></span>
            </div>



            <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('substitute').'&nbsp;&nbsp;'.$this->lang->line('staff'); ?></label>
            <select class="form-control" name="substitute_staff_id" id="substitute_staff_id">
            <?php foreach ($teaching_staff as $staff): ?>
            <option value="<?php echo $staff["id"]; ?>">
            <?php echo $staff["name"]; ?>
            </option>
            <?php endforeach; ?>
            </select>
            <span class="text-danger"><?php echo form_error('substitute_staff_id'); ?></span>
            </div>                 


            <div class="form-group">
            <label for="batch"><?php echo $this->lang->line('remarks'); ?></label>                
            <textarea rows="3" cols="3" class="form-control" id="remarks" name="remarks"></textarea>
            <!-- <input type="text" name="sem_group_id" class="sem_group_id form-control" id="sem_group_id"> -->
            <span class="text-danger"><?php echo form_error('remarks'); ?></span>
            </div> 

            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            </div>
            </form>
            </div>
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
            <h3 class="box-title"><?php echo $this->lang->line('subject').'&nbsp;&nbsp;'.$this->lang->line('substitute'); ?></h3>
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

            <th><?php echo $this->lang->line('type'); ?>
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


 
            foreach($get_subjectlist as $subjectlist)
            {
            ?>
            <tr>
            <td><input type="checkbox" class="allcheckbox" value="<?php echo $subjectlist['substitute_id']; ?>"></td>
            <td><?php echo $subjectlist['staff_name']; ?></td>

            <td><?php echo $subjectlist['prog_type_name']; ?></td>
            <td><?php echo $subjectlist['p_name']; ?></td>
            <td><?php echo $subjectlist['st_name']; ?></td>
            <td><?php echo $subjectlist['batch_group_name']; ?></td>
            <td><?php echo $subjectlist['semester_subject_groups']; ?></td>
            <td><?php echo $subjectlist['subject_name']; ?></td>
            <td><?php echo $subjectlist['paper_name']; ?></td>

            <td>
            <div class="material-switch switchcheck">
            <input id="is_status_<?php echo $subjectlist['substitute_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($subjectlist['substitute_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $subjectlist['substitute_id']; ?>, this.checked)">
            <label for="is_status_<?php echo $subjectlist['substitute_id']; ?>" class="label-success"></label>
            </div>
            </td>


            <td text-align="right">
            <a data-placement="left" href="<?php echo site_url('semester_activities/semester_substitute/edit/' . $subjectlist['substitute_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
            <a data-placement="left" href="<?php echo site_url('semester_activities/semester_substitute/delete/' . $subjectlist['substitute_id']); ?>" onclick="return doconfirm();"  class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash trashstyle" ></i></a>
            </td>


            </tr>

            <?php }?>



            </tbody>
            </table><!-- /.table -->
            </div><!-- /.mail-box-messages -->
            </div><!-- /.box-body -->



            </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            </div>
            </div>
            </div>
            </div>



            <script>
        //     $(document).ready(function()
        //     {
        //     $('#program_type').change(function()
        //     { 
        //     var prog_type_id = $(this).val();
        //     if(prog_type_id != ''){
        //     $.ajax({
        //     url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
        //     method: "POST",
        //     data: { prog_type_id: prog_type_id },
        //     dataType: "json",
        //     success: function(data){
        //     $('#programe').empty();
        //     $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
        //     $.each(data, function(key, value){
        //     $('#programe').append('<option value="'+ value.id +'">'+ value.p_name +'</option>');
        //     });
        //     }
        //     });
        //     } else {
        //     $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
        //     }
        //     });
        //     });  



                function updateStatus(id, status) 
                {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo site_url('semester_activities/semester_substitute/update_status'); ?>", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) 
                {
                console.log('Status updated successfully');
                }
                };
                xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
                }


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

            </script> 

            <script>


            document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById("date");
            const dayInput = document.getElementById("day");

            function updateDay() {
            const selectedDate = new Date(dateInput.value);
            if (!isNaN(selectedDate)) {
            // Array of day names
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            dayInput.value = days[selectedDate.getDay()];
            } else {
            dayInput.value = "";
            }
            }

            // Initialize day on page load
            updateDay();

            // Update day when date changes
            dateInput.addEventListener("change", updateDay);
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
            url: "<?= base_url('semester_activities/semester_substitute/bulkDelete') ?>",
            type: "POST",
            data: {ids: ids},
            success: function (response) {
            location.reload(); // refresh after delete
            }
            });
            }
            });




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

            </script>

