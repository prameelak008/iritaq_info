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



        <form id="form1" action="<?php echo site_url('semester/faculty/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">


        <div class="box-body">
        <?php
        /* if ($this->session->flashdata('msg')) {?>
        <?php echo $this->session->flashdata('msg') ?>
        <?php }
        */
        ?>
        <?php
        if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>


        <?php echo $this->customlib->getCSRF(); ?>

        <div class="form-group">
        <label for="exampleInputEmail1">Teacher Name</label>         
        <select name="teacher_id" id="teacher_id" class="form-control"> 
        <option value="">--Select Teacher--</option>
        <!-- Loop teachers -->
        </select>
        <span class="text-danger"><?php echo form_error('faculty_name'); ?></span>
        </div>



        <div class="form-group">
        <label for="exampleInputEmail1">Program</label>
        <select name="program_id" id="program_id" class="form-control">
        <!-- Loop programs -->
        </select>
        <span class="text-danger"><?php echo form_error('faculty_code'); ?></span>
        </div>



        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('batch'); ?></label>
        <select name="batch_id" id="batch_id" class="form-control">
        <!-- Loop batches -->
        </select>

        <span class="text-danger"><?php echo form_error('faculty_code'); ?></span>
        </div>




        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?></label>
        <select name="semester_id" id="semester_id" class="form-control">
        <!-- Loop semesters -->
        </select>

        <span class="text-danger"><?php echo form_error('faculty_code'); ?></span>
        </div>


        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label>
        <select name="subject_id[]" id="subject_id" multiple class="form-control">
        <!-- Loop subjects -->
        </select>


        <span class="text-danger"><?php echo form_error('faculty_code'); ?></span>
        </div>


        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?></label>
        <select name="session_id" id="session_id" class="form-control">
        <!-- Loop sessions -->
        </select>


        <span class="text-danger"><?php echo form_error('faculty_code'); ?></span>
        </div>


        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('status'); ?></label>
        <select name="status" id="status" class="form-control">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
        </select>


        <span class="text-danger"><?php echo form_error('faculty_code'); ?></span>
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
        <h3 class="box-title titlefix"> <?php echo $this->lang->line('faculty'); ?></h3>
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

        <th><?php echo $this->lang->line('status'); ?>
        </th>

        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach($faculty_list as $faculty)
        {
        ?>
        <tr>
        <td><input type="checkbox" class="allcheckbox" value="<?php echo $faculty['id']; ?>"></td>

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td text-align="right">
        <a data-placement="left" href="<?php echo site_url('semester/faculty/edit/' . $faculty['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
        <a data-placement="left" href="<?php echo site_url('semester/faculty/delete/' . $faculty['id']); ?>" onclick="return doconfirm();"  class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
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


        <script>
        function updateStatus(facultyId, status) 
        {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo site_url('semester/faculty/update_status'); ?>", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
        console.log('Status updated successfully');
        }
        };
        xhr.send("faculty_id=" + facultyId + "&status=" + (status ? 1 : 0));
        }
        </script>


        <script>
        $(document).ready(function () {
        // Select/Deselect all checkboxes
        $("#select_all").on("click", function () {
        $(".allcheckbox").prop("checked", this.checked);
        });

        // If all checkboxes are checked, check "select_all" too
        $(".allcheckbox").on("change", function () {
        if ($(".allcheckbox:checked").length == $(".allcheckbox").length) {
        $("#select_all").prop("checked", true);
        } else {
        $("#select_all").prop("checked", false);
        }
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
        url: "<?= base_url('semester/faculty/bulkDelete') ?>",
        type: "POST",
        data: {ids: ids},
        success: function (response) {
        location.reload(); // refresh after delete
        }
        });
        }
        });
        });
        </script>

