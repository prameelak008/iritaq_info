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
                <i class="fa fa-usd"></i> <?php echo $this->lang->line('assign_subjects'); ?> </h1>
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

                <form id="form1" action="<?php echo site_url('semester/assignsubjects/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">


                <div class="box-body">


                <?php echo $this->customlib->getCSRF(); ?> 

                <?php
                /*
                ?>

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
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
                <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?><small class="req"> *</small></label>
                <select name="programe" id="programe" class="form-control">
                </select>
                <span class="text-danger"><?php echo form_error('programe'); ?></span>
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_type'); ?><small class="req"> *</small></label>

                <select name="semester_type" id="semester_type" class="form-control" >
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
                <span class="text-danger"><?php echo form_error('semester_type'); ?></span>
                </div>



                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_term'); ?><small class="req"> *</small></label>
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
                <label for="exampleInputEmail1">Batch Group<small class="req"> *</small></label>
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
                <span class="text-danger"><?php echo form_error('batch_group'); ?></span>         
                </div>




                <div class="form-group">
                <label>Program Type / Program <small class="req">*</small></label> 
                <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
                <span class="text-danger"><?php echo form_error('program'); ?></span>
                </div>  

                <div class="form-group">
                <label>Semester / Batch / Term <small class="req">*</small></label>      
                <?php
                echo render_semester_dropdown($semesters_batches, set_value('semester'));
                ?>
                </div> 
                <?php */ ?>



                <!-- <div class="form-group">           
                <?= dropdownlist(
                $programs,
                set_value('program')
                ); ?>
                <span class="text-danger"><?= form_error('program'); ?></span>
                </div>   -->

                <!-- <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="batchtype_id" name="batchtype_id" class="form-control">
                <option value="">-- Select Batch --</option>
                </select>
                </div> 




                <div class="form-group">
                <label>Semester Term <small class="req">*</small></label>
                <select id="semester_term" name="semester_term" class="form-control" >
                <option value="">-- Select Batch First --</option>
                </select>
                </div> -->


                <!-- <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="batcht_id" name="batch_id" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                </div> -->

                <!-- <input type="hidden" name="semester_term" id="semester_term" class="form-control"> -->



                 <!-- <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_batch_type" name="sem_batch_type" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                </div> -->


                <div class="form-group">           
                <?= dropdownlist_program(
                $programs,
                set_value('prog_id')
                ); ?>
                <span class="text-danger"><?= form_error('prog_id'); ?></span>
                </div> 
                

                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_type" name="sem_type" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                </div>

                

          
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('assign_subjects'); ?><small class="req"> *</small></label> 
                <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                <?php foreach($subject_groups as $subjects): ?>
                <div class="checkbox">
                <label>
                <input type="checkbox" name="subject_groups[]" value="<?php echo $subjects['id']; ?>">&nbsp;
                <?php echo $subjects['name']; ?>
                </label>
                </div>
                <?php endforeach; ?>
                </div>
                <span class="text-danger"><?php echo form_error('subject_groups[]'); ?></span>
                </div>
                </div>



                <!-- /.box-body -->

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
                <h3 class="box-title"><?php echo $this->lang->line('assign_subject').'&nbsp;'.$this->lang->line('list'); ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">

                <div class="table-responsive mailbox-messages">

                <!-- <button type="button" id="delete_selected" class="btn btn-danger pull-right"><?php echo $this->lang->line('delete'); ?>&nbsp;<i class="fa fa-trash"></i></button> -->
                <br>
                <br>


                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr>
                <!-- <th><input type="checkbox" id="select_all"></th> -->
                <th><?php echo $this->lang->line('slno'); ?></th>
                <th><?php echo $this->lang->line('type'); ?> </th>
                <th><?php echo $this->lang->line('programee'); ?> </th>
                <!-- <th><?php echo $this->lang->line('mode'); ?> </th> -->
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
                <!-- <td><input type="checkbox" class="allcheckbox" value="<?php echo $subjects['sem_assign_group_id']; ?>"></td> -->
                <td><?php  echo $slno; ?></td>
                <td><?php  echo $subjects['prog_type_name']; ?></td>
                <td><?php  echo $subjects['p_name']; ?></td> 
                <!--   <td><?php  echo $subjects['b_mode_name']; ?></td>-->
                <td><?php  echo $subjects['batch_group_name'].'&nbsp;&nbsp;'.$subjects['b_year']; ?></td> 
                <td><?php  echo $subjects['group_names']; ?></td>          
                <td>
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $subjects['sem_assign_group_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($subjects['sem_assign_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $subjects['sem_assign_group_id']; ?>, this.checked)">
                <label for="is_status_<?php echo $subjects['sem_assign_group_id']; ?>" class="label-success"></label>
                </div>
                </td>


                <td text-align="right">
                <!-- <a data-placement="left" href="<?php echo site_url('semester/assignsubjects/edit/' . $subjects['sem_assign_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a> -->
                <a data-placement="left" href="<?php echo site_url('semester/assignsubjects/delete/' . $subjects['sem_assign_group_id']); ?>" onclick="return doconfirm();"  class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
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


                <script type="text/javascript">


                function updateStatus(id, status) 
                {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "<?php echo site_url('semester/assignsubjects/update_status'); ?>", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () 
                {
                if (xhr.readyState == 4 && xhr.status == 200) {
                console.log('Status updated successfully');
                }
                };
                xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
                }           



                    $(document).ready(function () 
                    {
                    $(document).on('change', '#prog_id, #sem_type', function () 
                    {

                    var program = $('#prog_id').val();
                    var batch   = $('#sem_type').val();


                   

                    // STEP 1: Set semester_term from selected option
                    // if (batch) {
                    // var semterm_id = $('#sem_type option:selected').data('semterm');
                    // $('#semester_term').val(semterm_id);
                    // }

                    // STEP 2: Read AFTER setting
                    var term = $('#semester_term').val();

                    // alert(program + " " + batch + " " + term);

                    if (!program || !batch ) {
                    $("input[name='subject_groups[]']").prop('checked', false);
                    return;
                    }

                    // STEP 3: AJAX
                    $.ajax({
                    url: "<?= base_url('semester/Assignsubjects/checkAssignedSubjects') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                    program: program,
                    batchtype_id: batch,
                    // semester_term: term,
                    '<?= $this->security->get_csrf_token_name() ?>':
                    '<?= $this->security->get_csrf_hash() ?>'
                    },
                    success: function (res) {

                    $("input[name='subject_groups[]']").prop('checked', false);

                    if (res.status === 'exists') {
                    $.each(res.subject_groups, function (i, id) {
                    $("input[name='subject_groups[]'][value='" + id + "']")
                    .prop('checked', true);
                    });
                    }
                    }
                    });

                    });

                    });




                // $(document).ready(function () 
                // {

                // $('#prog_id, #sem_type').on('change', function () {

                // var program = $('#prog_id').val();
                // var batch   = $('#sem_type').val();
                // var term    = $('#semester_term').val();
                

                // alert(program + " " + batch + " " + term);

           

                // if (!program || !batch || !term) {
                // $("input[name='subject_groups[]']").prop('checked', false);
                // return;
                // }

                // $.ajax({
                // url: "<?= base_url('semester/Assignsubjects/checkAssignedSubjects') ?>",
                // type: "POST",
                // dataType: "json",
                // data: {
                // program: program,
                // batchtype_id: batch,
                // semester_term: term,
                // '<?= $this->security->get_csrf_token_name() ?>':
                // '<?= $this->security->get_csrf_hash() ?>'
                // },
                // success: function (res) {

                // $("input[name='subject_groups[]']").prop('checked', false);

                // if (res.status === 'exists') {
                // $.each(res.subject_groups, function (i, id) {
                // $("input[name='subject_groups[]'][value='" + id + "']")
                // .prop('checked', true);
                // });
                // }
                // }
                // });
                // });

                // });






// $(document).ready(function () 
// {

//     $('#prog_id, #sem_type').on('change', function () {

//         var program = $('#prog_id').val();
//         var batch   = $('#sem_type').val();

//         // STEP 1: Set semester_term FIRST
//         if (program && batch) {

//             // Example logic (change if needed)
//             var term = (batch == 1) ? 'Semester 1' : 'Supplementary';

//             $('#semester_term').val(term);
//         }

//         // STEP 2: Read values AFTER setting
//         var semester_term = $('#semester_term').val();

//         alert(program + " | " + batch + " | " + semester_term);

//         // STEP 3: Validate
//         if (!program || !batch || !semester_term) {
//             $("input[name='subject_groups[]']").prop('checked', false);
//             return;
//         }

//         // STEP 4: AJAX
//         $.ajax({
//             url: "<?= base_url('semester/Assignsubjects/checkAssignedSubjects') ?>",
//             type: "POST",
//             dataType: "json",
//             data: {
//                 program: program,
//                 batchtype_id: batch,
//                 semester_term: semester_term,
//                 '<?= $this->security->get_csrf_token_name() ?>':
//                 '<?= $this->security->get_csrf_hash() ?>'
//             },
//             success: function (res) {

//                 $("input[name='subject_groups[]']").prop('checked', false);

//                 if (res.status === 'exists') {
//                     $.each(res.subject_groups, function (i, id) {
//                         $("input[name='subject_groups[]'][value='" + id + "']")
//                             .prop('checked', true);
//                     });
//                 }
//             }
//         });
//     });

// });





            //      $(document).on('change', '#sem_type', function () {
            // const semterm_id = $(this).find(':selected').data('semterm');
            // $('#semester_term').val(semterm_id);

            // // optional debug
            // console.log('Semester Term ID:', semterm_id);
            // });

                // $('#batchtype_id').on('change', function () 
                // {
                // const semterm_id = $(this).find(':selected').data('semterm-id') || '';
                // $('#semester_term').val(semterm_id);
                // });                



                // $('#program, #batchtype_id').on('change', function ()
                // {
                // var program = $('#program').val();
                // var batch   = $('#batchtype_id').val();
                // var term    = $('#semester_term').val();

                // if (!program || !batch || !term) {
                // $("input[name='subject_groups[]']").prop('checked', false);
                // return;
                // }

                // $.ajax({
                // url: "<?= base_url('semester/Assignsubjects/checkAssignedSubjects') ?>",
                // type: "POST",
                // dataType: "json",
                // data: {
                // program: program,
                // batchtype_id: batch,
                // semester_term: term,
                // '<?= $this->security->get_csrf_token_name() ?>':
                // '<?= $this->security->get_csrf_hash() ?>'
                // },
                // success: function (res) {

                // // Uncheck all first
                // $("input[name='subject_groups[]']").prop('checked', false);

                // // Check assigned subjects
                // if (res.status === 'exists') {
                // $.each(res.subject_groups, function (i, id) {
                // $("input[name='subject_groups[]'][value='" + id + "']")
                // .prop('checked', true);
                // });
                // }
                // }
                // });
                // });


//                 $(document).ready(function () {

//     $('#prog_id, #sem_type').on('change', function () {

//         var program = $('#prog_id').val();
//         var batch   = $('#sem_type').val();
//         var term    = $('#semester_term').val();

//         alert(program + " " + batch + " " + term);

//         if (!program || !batch || !term) {
//             $("input[name='subject_groups[]']").prop('checked', false);
//             return;
//         }

//         $.ajax({
//             url: "<?= base_url('semester/Assignsubjects/checkAssignedSubjects') ?>",
//             type: "POST",
//             dataType: "json",
//             data: {
//                 program: program,
//                 batchtype_id: batch,
//                 semester_term: term,
//                 '<?= $this->security->get_csrf_token_name() ?>':
//                 '<?= $this->security->get_csrf_hash() ?>'
//             },
//             success: function (res) {

//                 $("input[name='subject_groups[]']").prop('checked', false);

//                 if (res.status === 'exists') {
//                     $.each(res.subject_groups, function (i, id) {
//                         $("input[name='subject_groups[]'][value='" + id + "']")
//                             .prop('checked', true);
//                     });
//                 }
//             }
//         });
//     });

// });



             






                $(document).ready(function ()
                {
                // Select/Deselect all checkboxes
                $("#select_all").on("click", function () {
                $(".allcheckbox").prop("checked", this.checked);
                });

                // If all checkboxes are checked, check "select_all" too
                $(".allcheckbox").on("change", function ()         
                {
                if ($(".allcheckbox:checked").length == $(".allcheckbox").length) {
                $("#select_all").prop("checked", true);
                } else {
                $("#select_all").prop("checked", false);
                }
                });

                // Bulk delete
                $("#delete_selected").on("click", function ()
                {
                var ids = [];
                $(".allcheckbox:checked").each(function () {
                ids.push($(this).val());
                });   

                if (ids.length === 0) {
                alert("Please select at least one row to delete.");
                return;
                }



                if (confirm("Are you sure you want to delete selected list?")) {
                $.ajax({
                url: "<?= base_url('semester/assignsubjects/bulkDelete') ?>",
                type: "POST",
                data: {ids: ids},
                success: function (response) {
                location.reload(); // refresh after delete
                }
                });
                }
                });
                });                 



            $(document).on('change', '#prog_id', function () 
            {
            const program_id = $(this).val();
            const $select = $('#sem_type');

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

            if (row.b_mode_name !== currentMode) {
            if (currentMode !== '') html += '</optgroup>';
            currentMode = row.b_mode_name;
            html += `<optgroup label="${currentMode}">`;
            }

            // html += `
            // <option value="${row.bchsem_id}">
            // ${row.semester_name} -  ${row.batch_group_name}- ${row.batch_group_year}
            // </option>
            // `;

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





           




                </script>







