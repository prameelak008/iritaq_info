            
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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('edit').'&nbsp;'.$this->lang->line('batch'); ?></h1>
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
            <h3 class="box-title"><?php echo $this->lang->line('edit').'&nbsp;'.$this->lang->line('batch').'&nbsp;'.$this->lang->line('type'); ?></h3>
            </div><!-- /.box-header -->



            <form id="form1" action="<?php echo site_url('semester/batchtype/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="box-body"> 

            <?php echo $this->customlib->getCSRF(); ?>


            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_id'); ?><small class="req"> *</small></label>
            <input id="batch_id" name="batch_id" placeholder="batch Identify Number" type="text" class="form-control" readonly  value="<?php echo $batch['b_bid']; ?>" />
            <span class="text-danger"><?php echo form_error('batch_id'); ?></span>
            </div>

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('mode'); ?><small class="req"> *</small></label>
            <select name="batch_mode" id="batch_mode" class="form-control select2">   

            <?php 
            foreach($batch_mode as $mode)
            {
            ?>
            <option value="<?php echo $mode['b_mode_id']?>"
            <?php
            if($batch['b_mode']==$mode['b_mode_id'])
            {
            echo "selected=selected";
            }
            ?> >
            <?php echo $mode['b_mode_name']?></option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('batch_mode'); ?></span>
            </div> 



            <!-- <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
            <select name="program_type" id="program_type" class="form-control" > 
            <?php
            foreach($Programmetype_list as $prog_type)
            {
            ?>
            <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if($batch['prog_type_id']==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
            <?php 
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('program_type'); ?></span>
            </div>




            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programe" id="programe" class="form-control">
            <option value="<?php  echo $batch['b_program'];  ?>"><?php  echo $batch['p_name'];  ?></option>

            </select>
            <span class="text-danger"><?php echo form_error('programe'); ?></span>
            </div> -->



          <div class="form-group">
          <?= dropdownlist(
          $programs,
          is_array($batch) ? ($batch['b_program'] ?? '') : ($batch->b_program ?? '')
          ); ?>

          <span class="text-danger"><?= form_error('program'); ?></span>
          </div>



            
             <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch').'&nbsp;'.$this->lang->line('category'); ?><small class="req"> *</small></label> 
            <select name="batch_group" id="batch_group" class="form-control" >
            <option value="">Select Batch</option>

            <?php
            foreach($batch_group as $bat)
            {
            ?>
            <option value="<?php echo  $bat['batch_group_id']; ?>"<?php if($batch['b_name']==$bat['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $bat['batch_group_name'].'&nbsp;&nbsp;'.$bat['batch_group_year']; ?> </option>
            <?php 
            }
            ?>
            </select> 
            <span class="text-danger"><?php echo form_error('batch_group'); ?></span>
            </div>  





            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_code'); ?></label>
            <input id="batch_code" name="batch_code" placeholder="batch Identify Code" type="text" class="form-control"  value="<?php echo $batch['b_code']; ?>" />
            <span class="text-danger"><?php echo form_error('batch_code'); ?></span>
            </div>




            



      



            </div><!-- /.box-body -->

            <div class="box-footer">
           <button type="submit" class="btn btn-info pull-right"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo $this->lang->line('update'); ?></button>
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
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <th><input type="checkbox" id="select_all"></th>
            <th><?php echo $this->lang->line('batch_id'); ?></th>
<<<<<<< HEAD
            <th><?php echo $this->lang->line('programee').'&nbsp;'.$this->lang->line('type'); ?></th>
              <th><?php echo $this->lang->line('programee'); ?> </th>
=======
            <th><?php echo $this->lang->line('programee').'&nbsp;'.$this->lang->line('type'); ?>/<?php echo $this->lang->line('programee'); ?> </th>
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
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

<<<<<<< HEAD
            <td><?php  echo $batch['prog_type_name']; ?></td>
            <td><?php  echo $batch['p_name']; ?></td>
=======
            <td><?php echo trim(($batch['prog_type_name'] ? $batch['prog_type_name'].' - ' : '').$batch['p_name']); ?></td>
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
           


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


            <script>

            function updateStatus(batchId, status) 
            {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('semester/batchtype/update_status'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Status updated successfully');
            }
            };
            xhr.send("batch_id=" + batchId + "&status=" + (status ? 1 : 0));
            }



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
            </script>
