           
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
           
           <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            $language        = $this->customlib->getLanguage();
            $language_name   = $language["short_code"];
            ?>
            
            
            <style type="text/css">
            @media print {
            .no-print {
            visibility: hidden !important;
            display:none !important;
            }
            }
            
            /* Scoped styles for Batch Group Modal */
            .btn-batch-group-plus {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            background-color: #28a745;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            padding: 0;
            line-height: 1;
            transition: background-color 0.3s;
            text-align: center;
            vertical-align: middle;
            position: relative;
            }
            
            .btn-batch-group-plus .plus-symbol {
            color: #ffffff !important;
            font-size: 22px;
            font-weight: bold;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            }
            
            .btn-batch-group-plus:hover {
            background-color: #218838;
            }
            
            .btn-batch-group-plus:hover .plus-symbol {
            color: #ffffff !important;
            }
            
            .btn-batch-group-plus:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.25);
            }
            
            .btn-batch-group-plus:focus .plus-symbol {
            color: #ffffff !important;
            }
            
            .btn-batch-group-plus:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.25);
            }
            
            #batchGroupModal .modal-dialog {
            max-width: 900px;
            }
            
            #batchGroupModal .modal-header {
            background-color: #3c8dbc;
            color: white;
            border-bottom: none;
            }
            
            #batchGroupModal .modal-header .close {
            color: white;
            opacity: 0.8;
            }
            
            #batchGroupModal .modal-header .close:hover {
            opacity: 1;
            }
            
            #batchGroupModal .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            }
            
            #batchGroupModal .btn-save-batch-group {
            background-color: #3c8dbc;
            border-color: #3c8dbc;
            color: white;
            }
            
            #batchGroupModal .btn-save-batch-group:hover {
            background-color: #357ca5;
            border-color: #357ca5;
            }
            
            #batchGroupModal .table-batch-groups {
            margin-top: 20px;
            }
            
            #batchGroupModal .table-batch-groups th {
            background-color: #f4f4f4;
            font-weight: 600;
            }
            
            #batchGroupModal .status-switch-batch-group {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            }
            
            #batchGroupModal .status-switch-batch-group input {
            opacity: 0;
            width: 0;
            height: 0;
            }
            
            #batchGroupModal .status-switch-batch-group .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
            }
            
            #batchGroupModal .status-switch-batch-group .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            }
            
            #batchGroupModal .status-switch-batch-group input:checked + .slider {
            background-color: #28a745;
            }
            
            #batchGroupModal .status-switch-batch-group input:checked + .slider:before {
            transform: translateX(26px);
            }
            
            #batchGroupModal .btn-edit-batch-group {
            background-color: #3c8dbc;
            border-color: #3c8dbc;
            color: white;
            padding: 3px 8px;
            }
            
            #batchGroupModal .btn-delete-batch-group {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
            padding: 3px 8px;
            }
            </style>
            
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            
            <section class="content-header">
            <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('semester'); ?></h1>
            </section>
            
            <!-- Main content -->
            <section class="content">
               <div class="col-md-12">
              <?php
               $this->load->view('layout/topbar'); ?>
              </div>
              &nbsp;
            <div class="">
            <?php
            // if ($this->rbac->hasPrivilege('semester', 'can_add')) {
            ?>
            <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('semester'); ?>
            <button type="button" id="batch-group-plus-btn" class="btn-batch-group-plus" data-toggle="modal" data-target="#batchGroupModal" title="Manage Batch Groups"><span class="plus-symbol">+</span></button>
            </h3>
            </div><!-- /.box-header -->
            
            
            
            <form id="form1" action="<?php echo site_url('semester/semestertype/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            
            <div class="box-body">

              <?php
              /* if ($this->session->flashdata('msg')) {?>
              <?php echo $this->session->flashdata('msg') ?>
              <?php }
              */

              // if (isset($error_message)) {
              // echo "<div class='alert alert-danger'>" . $error_message . "</div>";
              // }

            ?>

            
            <?php echo $this->customlib->getCSRF(); ?>
            
            
            <?php 
            if (isset($max_code['st_sid']) && $max_code['st_sid'] != "")
            {
            $max = $max_code['st_sid']+1 ;
            } else {
            $max = 1; 
            }          
            ?>       

            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_id'); ?><small class="req"> *</small></label>
            <input id="semester_id" name="semester_id" placeholder="<?php echo $this->lang->line('semester_id'); ?>" readonly type="text" class="form-control"  value="<?php  echo $max; ?>"/>
            <span class="text-danger"><?php echo form_error('semester_id'); ?></span>
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_code'); ?><small class="req"> *</small></label>
            <input id="semester_code" name="semester_code" placeholder="<?php echo $this->lang->line('semester_code'); ?>"  type="text" class="form-control"  value="<?php echo set_value('semester_code'); ?>" />
            <span class="text-danger"><?php echo form_error('semester_code'); ?></span>
            </div>            
            
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_name'); ?><small class="req"> *</small></label>
            <input id="semester_name" name="semester_name" placeholder="<?php echo $this->lang->line('semester_name'); ?>" type="text" class="form-control"  value="<?php echo set_value('semester_name'); ?>" />
            <span class="text-danger"><?php echo form_error('semester_name'); ?></span>
            </div>            
            </div>
            
            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            </div>
            </form>
            </div>            
            </div>

            
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
           <h3 class="box-title titlefix"> <?php echo $this->lang->line('semester').'&nbsp;'.$this->lang->line('list'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            
            <div class="table-responsive mailbox-messages">

            <button type="button" id="delete_selected" class="btn btn-danger pull-right"><?php echo $this->lang->line('delete'); ?>&nbsp;<i class="fa fa-trash trashstyle"></i></button>
            <br>
            <br>

            <table class="table table-striped table-bordered table-hover example">
            <thead>

            <tr>
            <th><input type="checkbox" id="select_all"></th>  
            <th><?php echo $this->lang->line('slno'); ?></th>                
            <th><?php echo $this->lang->line('semester_id'); ?> </th>
            <th><?php echo $this->lang->line('semester_code'); ?> </th>
            <th><?php echo $this->lang->line('semester_name'); ?> </th>
            <th><?php echo $this->lang->line('status'); ?></th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>

            </thead>
            <tbody>            
            <?php 
            $slno=1;
            foreach($semester_list as $semester)
            {
            ?>
            <tr>
            <td><input type="checkbox" class="allcheckbox" value="<?php echo $semester['st_id']; ?>"></td>
            <td><?php  echo $slno; ?></td>
            <td><?php  echo $semester['st_id']; ?></td>
            <td><?php  echo $semester['st_code']; ?></td>
            <td><?php  echo $semester['st_name']; ?></td>

            <td>              
            <div class="material-switch switchcheck">
            <input id="is_status_<?php echo $semester['st_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($semester['st_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $semester['st_id']; ?>, this.checked)">
            <label for="is_status_<?php echo $semester['st_id']; ?>" class="label-success"></label>
            </div>
            </td> 

            <td text-align="right">
            <a data-placement="left" href="<?php echo site_url('semester/semestertype/edit/' . $semester['st_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
            <a data-placement="left" href="<?php echo site_url('semester/semestertype/delete/' . $semester['st_id']); ?>" onclick="return do_confirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
            </td>            
            
            </tr>
            <?php 
            $slno++;
            } 
            
            
            ?>
            </tbody>
            </table>
            
            
            
            
            <!-- /.table -->
            </div><!-- /.mail-box-messages -->
            </div><!-- /.box-body -->
            </div>
            </div><!--/.col (left) -->
            <!-- right column -->
            </div>
            
            </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            
            <!-- Batch Group Management Modal -->
            <div class="modal fade" id="batchGroupModal" tabindex="-1" role="dialog" aria-labelledby="batchGroupModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="batchGroupModalLabel">Manage Batch Groups</h4>
            </div>
            <div class="modal-body">
            <form id="batchGroupForm">
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <label for="batch_group_name">Name <small class="req">*</small></label>
            <input type="text" class="form-control" id="batch_group_name" name="batch_group_name" placeholder="Enter Name" required>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label for="batch_group_year">Year <small class="req">*</small></label>
            <input type="text" class="form-control" id="batch_group_year" name="batch_group_year" placeholder="Enter Year" required>
            </div>
            </div>
            </div>
            <input type="hidden" id="batch_group_id" name="batch_group_id" value="">
            <div class="form-group">
            <button type="submit" class="btn btn-save-batch-group">Save</button>
            <button type="button" class="btn btn-default" id="btn-reset-batch-group">Reset</button>
            </div>
            </form>
            
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-batch-groups">
            <thead>
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>Year</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody id="batchGroupTableBody">
            </tbody>
            </table>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            <!-- End Batch Group Management Modal -->
            
            
            
            <script type="text/javascript">
            function updateStatus(semesterId, status) 
            {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('semester/semester/update_status'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Status updated successfully');
            }
            };
            xhr.send("semester_id=" + semesterId + "&status=" + (status ? 1 : 0));
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
          alert("Please select at least one row to delete.");
          return;
          }

          if (confirm("Are you sure you want to delete selected list?")) {
          $.ajax({
          url: "<?= base_url('semester/semestertype/bulkDelete') ?>",
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
          
          <!-- Batch Group Modal JavaScript -->
          <script type="text/javascript">
          $(document).ready(function() {
          var baseUrl = '<?php echo base_url(); ?>';
          var editMode = false;
          
          // Load batch groups on modal open
          $('#batchGroupModal').on('show.bs.modal', function() {
          loadBatchGroups();
          });
          
          // Reset form
          $('#btn-reset-batch-group').on('click', function() {
          resetBatchGroupForm();
          });
          
          // Form submit
          $('#batchGroupForm').on('submit', function(e) {
          e.preventDefault();
          saveBatchGroup();
          });
          
          // Load batch groups
          function loadBatchGroups() {
          $.ajax({
          url: baseUrl + 'semester/Batchtype/get_batch_groups',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
          var tbody = $('#batchGroupTableBody');
          tbody.empty();
          
          if (data && data.length > 0) {
          $.each(data, function(index, item) {
          var row = '<tr>' +
          '<td>' + (index + 1) + '</td>' +
          '<td>' + (item.batch_group_name || '') + '</td>' +
          '<td>' + (item.batch_group_year || '') + '</td>' +
          '<td>' +
          '<label class="status-switch-batch-group">' +
          '<input type="checkbox" class="toggle-status-batch-group" data-id="' + item.batch_group_id + '" ' +
          (item.batch_group_status == 1 ? 'checked' : '') + '>' +
          '<span class="slider"></span>' +
          '</label>' +
          '</td>' +
          '<td>' +
          '<button type="button" class="btn btn-edit-batch-group btn-sm" data-id="' + item.batch_group_id + 
          '" data-name="' + (item.batch_group_name || '') + '" data-year="' + (item.batch_group_year || '') + '">' +
          '<i class="fa fa-pencil"></i> Edit' +
          '</button> ' +
          '<button type="button" class="btn btn-delete-batch-group btn-sm" data-id="' + item.batch_group_id + '">' +
          '<i class="fa fa-trash"></i> Delete' +
          '</button>' +
          '</td>' +
          '</tr>';
          tbody.append(row);
          });
          } else {
          tbody.append('<tr><td colspan="5" class="text-center">No batch groups found</td></tr>');
          }
          },
          error: function() {
          $('#batchGroupTableBody').html('<tr><td colspan="5" class="text-center text-danger">Error loading data</td></tr>');
          }
          });
          }
          
          // Save batch group
          function saveBatchGroup() {

          alert('sdsdssd')
          exit();
          var id = $('#batch_group_id').val();
          var name = $('#batch_group_name').val().trim();
          var year = $('#batch_group_year').val().trim();
          
          alert(id)
          if (!name || !year) {
          alert('Please fill in all required fields');
          return;
          }
          
          var url = baseUrl + 'semester/Batchtype/' + (editMode ? 'update_batch_group' : 'add_batch_group');
          var data = {
          batch_group_name: name,
          batch_group_year: year
          };
          
          if (editMode) {
          data.batch_group_id = id;
          }
          
          $.ajax({
          url: url,
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function(response) {
          if (response.status === 'success') {
          loadBatchGroups();
          resetBatchGroupForm();
          alert('Batch group saved successfully');
          } else {
          alert(response.message || 'Error saving batch group');
          }
          },
          error: function() {
          alert('Error saving batch group');
          }
          });
          }
          
          // Reset form
          function resetBatchGroupForm() {
          $('#batchGroupForm')[0].reset();
          $('#batch_group_id').val('');
          editMode = false;
          }
          
          // Edit batch group
          $(document).on('click', '.btn-edit-batch-group', function() {
          var id = $(this).data('id');
          var name = $(this).data('name');
          var year = $(this).data('year');
          
          $('#batch_group_id').val(id);
          $('#batch_group_name').val(name);
          $('#batch_group_year').val(year);
          editMode = true;
          });
          
          // Delete batch group
          $(document).on('click', '.btn-delete-batch-group', function() {
          if (!confirm('Are you sure you want to delete this batch group?')) {
          return;
          }
          
          var id = $(this).data('id');
          
          $.ajax({
          url: baseUrl + 'semester/Batchtype/delete_batch_group',
          type: 'POST',
          data: { batch_group_id: id },
          dataType: 'json',
          success: function(response) {
          if (response.status === 'success') {
          loadBatchGroups();
          alert('Batch group deleted successfully');
          } else {
          alert(response.message || 'Error deleting batch group');
          }
          },
          error: function() {
          alert('Error deleting batch group');
          }
          });
          });
          
          // Toggle status
          $(document).on('change', '.toggle-status-batch-group', function() {
          var id = $(this).data('id');
          var status = $(this).is(':checked') ? 1 : 0;
          
          $.ajax({
          url: baseUrl + 'semester/Batchtype/toggle_batch_group_status',
          type: 'POST',
          data: {
          batch_group_id: id,
          status: status
          },
          dataType: 'json',
          success: function(response) {
          if (response.status !== 'success') {
          alert('Error updating status');
          }
          },
          error: function() {
          alert('Error updating status');
          }
          });
          });
          });
          </script>
          <!-- End Batch Group Modal JavaScript -->
