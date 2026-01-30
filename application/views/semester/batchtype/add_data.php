
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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('batch'); ?></h1>
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
            // if ($this->rbac->hasPrivilege('batch', 'can_add')) {
            ?>
            <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('batch').'&nbsp;'.$this->lang->line('type'); ?></h3>
            </div><!-- /.box-header -->



            <form id="form1" action="<?php echo site_url('semester/batchtype/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

            <div class="box-body">
            <?php echo $this->customlib->getCSRF(); ?>        
            <?php
            $max_code = $max_code['b_bid'];
            if($max_code=="")
            {
            $max=001;
            }
            else
            {
            $max=$max_code+1;   
            }
            ?>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_id'); ?><small class="req"> *</small></label>
            <input id="batch_id" name="batch_id" placeholder="Batch Identify Number" readonly type="text" class="form-control"  value="<?php  echo $max; ?>"/>
            <span class="text-danger"><?php echo form_error('batch_id'); ?></span>
            </div>     


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('mode'); ?><small class="req"> *</small></label>

            <select name="batch_mode" id="batch_mode" class="form-control select2">
            <option value="">Select Type</option> 

            <?php
            foreach($batch_mode as $mode)
            {
            ?>
            <option value="<?php echo $mode['b_mode_id']?>"

            <?php
            if(set_value('batch_mode')==$mode['b_mode_id'])
            {
            echo "selected=selected";
            }
            ?>>
            <?php echo $mode['b_mode_name']?></option>
            <?php } ?>
            </select> 

            <span class="text-danger"><?php echo form_error('batch_mode'); ?></span>
            </div>





            <!-- <div class="form-group">
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
            <option></option>
            </select>
            <span class="text-danger"><?php echo form_error('programe'); ?></span>
            </div> -->




   
            <!-- <div class="form-group">
            <label>Program Type / Program <small class="req">*</small></label> 
            <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
            <span class="text-danger"><?php echo form_error('program'); ?></span>
            </div>           -->


            <div class="form-group"> 
            <?= dropdownlist(
            $programs,
            set_value('program')
            ); ?>

            <span class="text-danger"><?= form_error('program'); ?></span>
            </div>

           
            

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch').'&nbsp;'.$this->lang->line('category'); ?><small class="req"> *</small></label> 
            <div class="input-group">
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
          
            <span class="input-group-btn">

            &nbsp;
            &nbsp;

            <button type="button" id="manage_batch_groups_btn" class="btn btn-success btn-sm" title="Add Batch Group">
            <i class="fa fa-plus"></i>
            </button>
            
            </span>
            </div>
            <span class="text-danger"><?php echo form_error('batch_group'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_code'); ?><small class="req"> *</small></label>
            <input id="batch_code" name="batch_code" placeholder="Batch Identify Code" type="text" class="form-control"  value="<?php echo set_value('batch_code'); ?>" />
            <span class="text-danger"><?php echo form_error('batch_code'); ?></span>
            </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i>&nbsp;<?php echo $this->lang->line('save'); ?></button>
            </div>
            </form>




            </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <?php //} ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('batch', 'can_add')) {
            echo "8";
            } else {
            echo "12";
            }
            ?>">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('batch').'&nbsp;&nbsp;'.$this->lang->line('list'); ?></h3>
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
            <th><?php echo $this->lang->line('batch_id'); ?></th>
            <th><?php echo $this->lang->line('programee').'&nbsp;'.$this->lang->line('type'); ?>/<?php echo $this->lang->line('programee'); ?></th>
            <th><?php echo $this->lang->line('batch_name'); ?>
            </th>
            <th><?php echo $this->lang->line('batch_code'); ?> </th>         


            <th><?php echo $this->lang->line('status'); ?></th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            $slno=1;
            foreach($batch_list as $batch)
            {
            ?>
            <tr> 
            <td><input type="checkbox" class="batch_checkbox" value="<?php echo $batch['b_id']; ?>"></td>                          
            <td><?php  echo $batch['b_bid']; ?></td>
            <td><?php echo trim(($batch['prog_type_name'] ? $batch['prog_type_name'].' - ' : '').$batch['p_name']); ?></td>          

            <td><?php  echo $batch['batch_group_name'] .'&nbsp;&nbsp;'.$batch['batch_group_year']; ?></td>

             <td><?php  echo $batch['b_code']; ?></td>
            <td>
            <div class="material-switch switchcheck">
            <input id="is_status_<?php echo $batch['b_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($batch['b_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $batch['b_id']; ?>, this.checked)">
            <label for="is_status_<?php echo $batch['b_id']; ?>" class="label-success"></label>
            </div>
            </td>

            <td text-align="right">
            <a data-placement="left" href="<?php echo site_url('semester/batchtype/edit/' . $batch['b_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
            <a data-placement="left" href="<?php echo site_url('semester/batchtype/delete/' . $batch['b_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash trashstyle" ></i></a>
            </td>

            </tr>
            <?php 
            $slno++;
            } ?>
            </tbody>
            </table>

            <script>
            $(document).on('change', '.bg-status', function(){
            var id = $(this).data('id');
            var status = $(this).is(':checked') ? 1 : 0;
            $.ajax({
            url: '<?php echo site_url('semester/batchtype/toggle_batch_group_status'); ?>',
            type: 'POST',
            data: { batch_group_id: id, status: status },
            success: function(resp){
            // optional: toast/notify
            },
            error: function(){
            alert('Failed to update status');
            }
            });
            });
            </script><!-- /.table -->
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

            <!-- Batch Groups Modal -->
            <div class="modal fade" id="batchGroupsModal" tabindex="-1" role="dialog" aria-labelledby="batchGroupsModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="batchGroupsModalLabel">
                
                
            Manage Batch Groups
        
            </h4>
            </div>
            <div class="modal-body">
            <form id="batchGroupForm">
            <input type="hidden" id="bg_id" name="batch_group_id" />
            <div class="form-group">
            <label><?php echo $this->lang->line('name'); ?></label>
            <input type="text" class="form-control" id="bg_name" name="batch_group_name" />
            </div>
            <div class="form-group">
            <label><?php echo $this->lang->line('year'); ?></label>
            <input type="text" class="form-control" id="bg_year" name="batch_group_year" />
            </div>
            <div class="text-right">
            <button type="submit" class="btn btn-primary" id="saveBgBtn"><i class="fa fa-save"></i> <?php echo $this->lang->line('save'); ?></button>&nbsp;
            <button type="button" class="btn btn-default" id="resetBgBtn"><i class="fa fa-refresh"></i> <?php echo $this->lang->line('reset'); ?></button>
            </div>
            </form>
            <hr/>

            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="batchGroupsTable">
            <thead>
            <tr>
            <th>#</th>
            <th><?php echo $this->lang->line('name'); ?></th>
            <th><?php echo $this->lang->line('year'); ?></th>
            <th><?php echo $this->lang->line('status'); ?></th>
            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
            </tr>


            </thead>
            <tbody>
            <?php if (!empty($batch_grouplist)) { $i = 1; foreach ($batch_grouplist as $bg) { ?>
            <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($bg['batch_group_name']); ?></td>
            <td><?php echo htmlspecialchars($bg['batch_group_year']); ?></td>
            <td>
            <div class="material-switch switchcheck">
            <input id="bg_status_<?php echo $bg['batch_group_id']; ?>" type="checkbox" class="bg-status" data-id="<?php echo $bg['batch_group_id']; ?>" <?php echo ($bg['batch_group_status'] == 1 ? 'checked' : ''); ?> />
            <label for="bg_status_<?php echo $bg['batch_group_id']; ?>" class="label-success"></label>
            </div>
            </td>
            <td class="text-right">
            <button type="button" class="btn btn-xs btn-primary editBg" 
            data-id="<?php echo $bg['batch_group_id']; ?>"
            data-name="<?php echo htmlspecialchars($bg['batch_group_name'], ENT_QUOTES); ?>"
            data-year="<?php echo htmlspecialchars($bg['batch_group_year'], ENT_QUOTES); ?>"
            data-status="<?php echo (int)$bg['batch_group_status']; ?>">
            <i class="fa fa-pencil"></i>
            </button>
            <button type="button" class="btn btn-xs btn-danger deleteBg" data-id="<?php echo $bg['batch_group_id']; ?>">
            <i class="fa fa-trash"></i>
            </button>
            </td>
            </tr>
            <?php } } ?>
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

            <script type="text/javascript">
            function updateStatus(batchId, status) 
            { 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('semester/batch/update_status'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Status updated successfully');
            }
            };
            xhr.send("batch_id=" + batchId + "&status=" + (status ? 1 : 0));
            }



/*

            $(document).ready(function () 
            {

            var selected_program = "<?php echo set_value('programe'); ?>";

            $('#program_type').change(function () { 
            var prog_type_id = $(this).val();

            if (prog_type_id !== '')
            {
            $.ajax({
            url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
            method: "POST",
            data: { prog_type_id: prog_type_id },
            dataType: "json",
            success: function (data) 
            {

            $('#programe').html('<option value="">Select</option>');

            $.each(data, function (key, value) {
            $('#programe').append(
            '<option value="' + value.id + '">' + value.p_name + '</option>'
            );
            });

            // ✅ THIS line selects old value
            $('#programe').val(selected_program);
            }
            });
            } else {
            $('#programe').html('<option value="">Select</option>');
            }
            });

            // 🔁 Auto trigger when page reloads after validation error
            if ($('#program_type').val() !== '') {
            $('#program_type').trigger('change');
            }
            });
            */


            
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


            $(function(){
            function loadBatchGroups(){
            $.ajax({
            url: "<?php echo site_url('semester/batchtype/get_batch_groups'); ?>",
            method: "GET",
            dataType: "json",
            success: function(list){
            var tbody = $('#batchGroupsTable tbody');
            tbody.empty();
            $.each(list, function(i, row){
            var tr = $('<tr/>');
            tr.append('<td>'+(i+1)+'</td>');
            tr.append('<td>'+ row.batch_group_name +'</td>');
            tr.append('<td>'+ row.batch_group_year +'</td>');
            var toggle = '\n            <div class="material-switch switchcheck">\n              <input id="bg_status_'+row.batch_group_id+'" type="checkbox" class="bg-status" data-id="'+row.batch_group_id+'" '+ (parseInt(row.batch_group_status,10)===1 ? 'checked' : '') +' />\n              <label for="bg_status_'+row.batch_group_id+'" class="label-success"></label>\n            </div>\n          ';
            tr.append('<td>'+ toggle +'</td>');
            var safeName = (row.batch_group_name || '').replace(/"/g, '&quot;');
            tr.append('<td class="text-right">\
            <button type="button" class="btn btn-xs btn-primary editBg" data-id="'+row.batch_group_id+'" data-name="'+ safeName +'" data-year="'+row.batch_group_year+'" data-status="'+row.batch_group_status+'"><i class="fa fa-pencil"></i></button> \
            <button type="button" class="btn btn-xs btn-danger deleteBg" data-id="'+row.batch_group_id+'"><i class="fa fa-trash"></i></button>');
            tbody.append(tr);
            });
            }
            });
            }

            function refreshBatchGroupDropdown(selectedId){
            $.ajax({
            url: "<?php echo site_url('semester/batchtype/get_batch_groups'); ?>",
            method: "GET",
            dataType: "json",
            success: function(list){
            var sel = $('#batch_group');
            var current = selectedId || sel.val();
            sel.empty();
            sel.append('<option value="">Select Batch</option>');
            $.each(list, function(i, row){
            var text = row.batch_group_name + '  ' + row.batch_group_year;
            var opt = $('<option/>').val(row.batch_group_id).text(text);
            sel.append(opt);
            });
            if(current){ sel.val(current); }
            }
            });
            }



            $('#manage_batch_groups_btn').on('click', function(){           
            $('#batchGroupForm')[0].reset();
            $('#bg_id').val('');
            $('#batchGroupsModal').modal('show');
            });

            $('#resetBgBtn').on('click', function(){
            $('#batchGroupForm')[0].reset();
            $('#bg_id').val('');
            });



            $('#batchGroupForm').on('submit', function(e)
            {
            e.preventDefault();
            var id = $('#bg_id').val();
            var payload = {
            batch_group_id: id,
            batch_group_name: $('#bg_name').val(),
            batch_group_year: $('#bg_year').val()
            };
            var url = id ? "<?php echo site_url('semester/batchtype/update_batch_group'); ?>"
            : "<?php echo site_url('semester/batchtype/add_batch_group'); ?>";
            $.ajax({
            url: url,
            method: 'POST',
            data: payload,
            dataType: 'json',
            success: function(resp){
            if(resp && resp.status === 'success'){
            var newId = resp.id || id;
            var name = $('#bg_name').val();
            var year = $('#bg_year').val();

            if (id) {
            // update existing row (status not handled via form)
            var $btn = $('#batchGroupsTable').find('.editBg[data-id="'+id+'"]');
            var $tr = $btn.closest('tr');
            $tr.find('td').eq(1).text(name);
            $tr.find('td').eq(2).text(year);
            $btn
            .data('name', name)
            .data('year', year);
            } else {
            // insert new row, default status Active (checked)
            var idx = $('#batchGroupsTable tbody tr').length + 1;
            var safeName = (name || '').replace(/"/g, '&quot;');
            var toggle = '\n            <div class="material-switch switchcheck">\n              <input id="bg_status_'+newId+'" type="checkbox" class="bg-status" data-id="'+newId+'" checked />\n              <label for="bg_status_'+newId+'" class="label-success"></label>\n            </div>\n          ';
            var $tr = $('<tr/>');
            $tr.append('<td>'+idx+'</td>');
            $tr.append('<td>'+ name +'</td>');
            $tr.append('<td>'+ year +'</td>');
            $tr.append('<td>'+ toggle +'</td>');
            $tr.append('<td class="text-right">\
            <button type="button" class="btn btn-xs btn-primary editBg" data-id="'+newId+'" data-name="'+ safeName +'" data-year="'+year+'"><i class="fa fa-pencil"></i></button> \
            <button type="button" class="btn btn-xs btn-danger deleteBg" data-id="'+newId+'"><i class="fa fa-trash"></i></button>');
            $('#batchGroupsTable tbody').append($tr);
            $('#bg_id').val(newId);
            }

            // refresh main dropdown and keep selection
            refreshBatchGroupDropdown(newId);
            } else {
            alert((resp && resp.message) || 'Operation failed');
            }
            },
            error: function(){
            alert('Request failed');
            }
            });
            });



            // delegate edit
            $('#batchGroupsTable').on('click', '.editBg', function(){
            var btn = $(this);
            $('#bg_id').val(btn.data('id'));
            $('#bg_name').val(btn.data('name'));
            $('#bg_year').val(btn.data('year'));
            });
            // delegate delete
            $('#batchGroupsTable').on('click', '.deleteBg', function(){
            var id = $(this).data('id');
            var $row = $(this).closest('tr');
            if(!confirm('Delete this batch group?')) return;
            $.ajax({
            url: "<?php echo site_url('semester/batchtype/delete_batch_group'); ?>/" + id,
            method: 'POST',
            dataType: 'json',
            success: function(resp){
            if(resp && resp.status === 'success'){
            // remove the row in-place
            $row.remove();
            // reindex the serial numbers
            $('#batchGroupsTable tbody tr').each(function(idx){
            $(this).find('td:first').text(idx+1);
            });
            // refresh main dropdown
            refreshBatchGroupDropdown();
            } else {
            alert((resp && resp.message) || 'Delete failed');
            }
            },
            error: function(){
            alert('Request failed');
            }
            });
            });
            });

            $(document).ready(function () {
            // Select/Deselect all checkboxes
            $("#select_all").on("click", function () {
            $(".batch_checkbox").prop("checked", this.checked);
            });

            // If all checkboxes are checked, check "select_all" too
            $(".batch_checkbox").on("change", function () {
            if ($(".batch_checkbox:checked").length == $(".batch_checkbox").length) {
            $("#select_all").prop("checked", true);
            } else {
            $("#select_all").prop("checked", false);
            }
            });

            // Bulk delete
            $("#delete_selected").on("click", function () {
            var ids = [];
            $(".batch_checkbox:checked").each(function () {
            ids.push($(this).val());
            });

            if (ids.length === 0) {
            alert("Please select at least one row to delete.");
            return;
            }

            if (confirm("Are you sure you want to delete selected list?")) {
            $.ajax({
            url: "<?= base_url('semester/batchtype/bulkDelete') ?>",
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

