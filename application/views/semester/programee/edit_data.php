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
        <i class="fa fa-usd"></i> <?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('programee'); ?></h1>
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
        // if ($this->rbac->hasPrivilege('programee', 'can_add')) {
        ?>
        <div class="col-md-4">
        <!-- Horizontal Form -->
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('programee'); ?></h3>
        </div><!-- /.box-header -->



        <form id="form1" action="<?php echo site_url('semester/programee/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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


        <?php 
        echo $this->customlib->getCSRF(); ?>

        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_id'); ?><small class="req"> *</small></label>
        <input id="programee_id" name="programee_id" placeholder="programee Identify Number" type="text" class="form-control" readonly  value="<?php echo $get_by_id['p_id']; ?>" />
        <span class="text-danger"><?php echo form_error('programee_id'); ?></span>
        </div>


        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
        <select name="programee_type" id="programee_type" class="form-control">
        <option value="">Select Type</option>
        <?php
        foreach($Programmetype_bystatus as $prog)
        {
        ?>
        <option value="<?php  echo $prog['prog_type_id']; ?>"
        <?php   
        if($get_by_id['prog_type_id']==$prog['prog_type_id'])
        {
        echo "selected=selected";
        }
        ?>
        >
        <?php echo $prog['prog_type_name']; ?>  
        </option>
        <?php }?>
        </select>


        <span class="text-danger"><?php echo form_error('programee_type'); ?></span>
        </div>




        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_name'); ?><small class="req"> *</small></label>
        <input id="programee_name" name="programee_name" placeholder="<?php echo $this->lang->line('programee_name'); ?>" type="text" class="form-control"  value="<?php echo $get_by_id['p_name']; ?>" />
        <span class="text-danger"><?php echo form_error('programee_name'); ?></span>
        </div>

        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('pgm_identity_code'); ?><small class="req"> *</small></label>
        <input id="programee_code" name="programee_code" placeholder="<?php echo $this->lang->line('pgm_identity_code'); ?>" type="text" class="form-control"  value="<?php echo $get_by_id['p_code']; ?>" />
        <span class="text-danger"><?php echo form_error('programee_code'); ?></span>
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
        if ($this->rbac->hasPrivilege('programee', 'can_add')) {
        echo "8";
        } else {
        echo "12";
        }
        ?>">
        <!-- general form elements -->
        <div class="box box-primary">
        <div class="box-header ptbnull">
        <h3 class="box-title titlefix"> <?php echo $this->lang->line('programee'); ?></h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

        <div class="table-responsive mailbox-messages">
        <table class="table table-striped table-bordered table-hover example">
        <thead>

        <tr>
        <th><input type="checkbox" id="select_all"></th>
        <th><?php echo $this->lang->line('slno'); ?>
        </th> 

        <th><?php echo $this->lang->line('programee_id'); ?>
        </th>

        <th><?php echo $this->lang->line('programee_type'); ?> </th>



        <th><?php echo $this->lang->line('programee_name'); ?>
        </th>


        <th><?php echo $this->lang->line('programee_code'); ?>
        </th>




        <th><?php echo $this->lang->line('status'); ?></th>

        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
        </tr>
        </thead>
        <tbody>


        <?php
        $sl=1;
        foreach($programee_list as $programee)
        {
        ?>
        <tr>
        <td><input type="checkbox" class="allcheckbox" value="<?php echo $programee['id']; ?>"></td>  
        <td><?php   echo $sl; ?></td>
        <td><?php   echo $programee['p_id']; ?></td>
        <td><?php   echo $programee['prog_type_name']; ?></td>

        <td><?php   echo $programee['p_name']; ?></td>
        <td><?php   echo $programee['p_code']; ?></td>


        <td>
        <div class="material-switch switchcheck">
        <input id="is_status_<?php echo $programee['id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($programee['p_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $programee['id']; ?>, this.checked)">
        <label for="is_status_<?php echo $programee['id']; ?>" class="label-success"></label>
        </div>
        </td>

        <td text-align="right">
        <a data-placement="left" href="<?php echo site_url('semester/programee/edit/' . $programee['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
        <a data-placement="left" href="<?php echo site_url('semester/programee/delete/' . $programee['id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
        </td>

        </tr>
        <?php 
        $sl++;
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



        <script>
        function updateStatus(programeeId, status) 
        {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo site_url('semester/programee/update_status'); ?>", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
        console.log('Status updated successfully');
        }
        };
        xhr.send("programee_id=" + programeeId + "&status=" + (status ? 1 : 0));
        }
        </script>
