
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
                <i class="fa fa-usd"></i> <?php echo $this->lang->line('class_teacher'); ?></h1>
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
                <h3 class="box-title titlefix"> <?php echo $this->lang->line('assign').''.'&nbsp;&nbsp;'.$this->lang->line('class_teacher'); ?></h3>
                </div><!-- /.box-header -->

                <form id="form1" action="<?php echo site_url('semester_activities/semester_classteacher/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                <div class="box-body">

                <?php echo $this->customlib->getCSRF();   ?> 

                <!-- <input type="text" name="sem_group_id" class="sem_group_id form-control" id="sem_group_id"  autocomplete= "off" class="form-control"> -->


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

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>            
                <textarea rows="3" cols="3" class="form-control" name="description" id="description"></textarea>
                <!-- <span class="text-danger"><?php echo form_error('description'); ?></span> -->
                </div>


                <div class="form-group">
                <label for="exampleInputEmail1">Teacher Name</label>  
                <br> 
                <br> 

                <input type="hidden" name="branch_id" id="branch_id" class="form-control" >


                <?php foreach($teaching_staff as $staff): ?>
                <div class="form-check">
                <input 
                type="checkbox" 
                name="teacher[]" 
                id="teacher_<?php echo $staff['staff_id']; ?>" 
                value="<?php echo $staff['staff_id']; ?>" 
                class="form-check-input"
                >
                <label for="teacher_<?php echo $staff['staff_id']; ?>" class="form-check-label">
                &nbsp;<?php echo $staff['name']; ?>
                </label>
                </div>
                <?php endforeach; ?>
                </div>
                <span class="text-danger"><?php echo form_error('teacher'); ?></span>

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
                if ($this->rbac->hasPrivilege('class_teacher', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"> <?php echo $this->lang->line('assign').''.'&nbsp;&nbsp;'.$this->lang->line('class_teacher'); ?></h3>
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
                <th><?php echo $this->lang->line('programme'); ?></th> 
                <th><?php echo $this->lang->line('batch'); ?>
                </th>
                <th><?php echo $this->lang->line('teacher'); ?>
                </th> 
                <th><?php echo $this->lang->line('status'); ?>
                </th>
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php 


                foreach($get_classteacher as $cl_teach)
                {
                ?>
                <tr>
                <td><input type="checkbox" class="allcheckbox" value="<?php echo $cl_teach['semcl_id']; ?>"></td>
                <td><?php echo $cl_teach['p_name'] ; ?></td>
        
                <td><?php echo $cl_teach['batch_group_name'].'&nbsp;&nbsp;'.$cl_teach['batch_group_year'] ; ?></td>            
                <td><?php echo $cl_teach['teacher_names'] ; ?></td>
                <td>
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $cl_teach['semcl_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($cl_teach['semcl_sem_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $cl_teach['semcl_id']; ?>, this.checked)">
                <label for="is_status_<?php echo $cl_teach['semcl_id']; ?>" class="label-success"></label>
                </div>
                </td>

                <td text-align="right">
                <!-- <a data-placement="left" href="<?php echo site_url('semester_activities/semester_classteacher/edit/' . $cl_teach['semcl_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a> -->
                <a data-placement="left" href="<?php echo site_url('semester_activities/semester_classteacher/delete/' . $cl_teach['semcl_id']); ?>" onclick="return doconfirm();"  class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
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
                xhr.open("POST", "<?php echo site_url('semester_activities/semester_classteacher/update_status'); ?>", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                console.log('Status updated successfully');
                }
                };
                xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
                } 

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
                
                

                $(document).on('change', '#prog_id', function () 
                {                    
                const program_id  = $(this).val();
                const $select     = $('#sem_type');  
                if (!program_id) {
                $select.html('<option value="">-- Select Batch & Semester --</option>');
                return;
                }
                $select.prop('disabled', true)
                .html('<option>Loading...</option>');

                $.post(
                "<?= site_url('semester/assignsubjects/get_semester_batch_by_program'); ?>",
                { program_id: program_id },
                function (data) {            

                let html = '<option value="">-- Select Batch & Semester --</option>';
                let currentMode = '';

                if (data.length > 0) {
                data.forEach(row => {

                if (row.b_mode_name !== currentMode)
                {
                if (currentMode !== '') html += '</optgroup>';
                currentMode = row.b_mode_name;
                html += `<optgroup label="${currentMode}">`;
                }

                html += `
                <option 
                value="${row.bchsem_id}" 
                data-semterm="${row.semterm_id}">
                ${row.semester_name} - ${row.batch_group_name} - ${row.batch_group_year}
                </option>
                `;

                });
                html += '</optgroup>';
                } else {
                html += '<option value="">No data found</option>';
                }

                $select.html(html).prop('disabled', false);
                },
                'json'
                );
                });               



                $(document).on('change', '#sem_type', function ()
                {
                const sem_group_id = $(this).val(); 
                $('input[name="teacher[]"]').prop('checked', false);

                if (!sem_group_id) {
                return;
                }                    
                $.ajax({
                url: "<?= site_url('semester_activities/semester_classteacher/get_assigned_teachers'); ?>",
                type: "POST",
                data: { sem_group_id: sem_group_id },
                dataType: "json",
                success: function (response) 
                { 
                // Its not a single object response['0']  
                $('#description').val(response[0].semcl_sem_description);

                // 3️⃣ Check only existing teachers
                if (response.length > 0) {
                response.forEach(function (row) {
                $('#teacher_' + row.semcl_det_teacher)
                .prop('checked', true);
                });
                }
                }
                });
                });

                </script>







