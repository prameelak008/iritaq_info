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
            <div class="row">
            <?php
            // if ($this->rbac->hasPrivilege('batch', 'can_add')) {
            ?>
            <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><?php echo $this->lang->line('edit').'&nbsp;'.$this->lang->line('batch'); ?></h3>
            </div><!-- /.box-header -->
            
            
            
            <form id="form1" action="<?php echo site_url('semester/batch/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            
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
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
            <select name="programee_type" id="programee_type" class="form-control" onchange="getProgrammes()">
           
            <?php
            foreach($Programmetype_list as $prog)
            {
            ?>
            <option value="<?php  echo $prog['prog_type_id']; ?>"
            <?php   
            if($editbatch['b_progtype']==$prog['prog_type_id'])
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
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programee" id="programee" class="form-control">
            <!-- <option value="">Select Programe</option> -->
            </select>
            <span class="text-danger"><?php echo form_error('programee'); ?></span>
            </div>
            
            
            
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch'); ?></label>
            <select name="batch" id="batch" class="form-control">
            <option value="">Select Batch</option>
            <?php            	
            foreach($batch as $btc)
            {
            ?>
            <option value="<?php  echo $btc['b_id']; ?>"
            <?php   
            if($editbatch['b_batchtype']==$btc['b_id'])
            {
            echo "selected=selected";
            }
            ?>
            >
            <?php echo $btc['b_name']; ?>  
            </option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('batch'); ?></span>
            </div>        
            
            
            
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('from').'&nbsp;'.$this->lang->line('date'); ?></label>
            <input type="date" name="fromdate" value="<?php echo $editbatch['b_startdate']; ?>" id="fromdate" class="form-control" />
            <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
            </div>
            
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('to').'&nbsp;'.$this->lang->line('date'); ?></label>
            <input type="date" name="todate" id="todate" value="<?php echo $editbatch['b_enddate']; ?>" class="form-control" />
            <span class="text-danger"><?php echo form_error('todate'); ?></span>
            </div>          
            
	

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('academic').'&nbsp;'.$this->lang->line('year'); ?></label>
            <select  id="session_id" name="session_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php
            foreach ($sessionlist as $session) {
            ?>
            <option value="<?php echo $session['id'] ?>" <?php
            if ($editbatch['b_year']  == $session['id']) {
            echo "selected=selected";
            }
            ?>><?php echo $session['session'] ?></option>
            <?php
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('session_id'); ?></span>
            </div>            
            

            <input type="hidden" id="selectedProgramme" value="<?php echo isset($editbatch['b_program']) ? $editbatch['b_program'] : ''; ?>">


            
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
            if ($this->rbac->hasPrivilege('batch', 'can_add')) {
            echo "8";
            } else {
            echo "12";
            }
            ?>">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('batch'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            
            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
                
                
            <th><?php echo $this->lang->line('slno'); ?></th>            
            <th><?php echo $this->lang->line('programee_type'); ?>  </th>            
            <th><?php echo $this->lang->line('programee'); ?> 
            </th>
            <th><?php echo $this->lang->line('batch'); ?>
            </th>
            <th><?php echo $this->lang->line('from'); ?>
            </th>
            <th><?php echo $this->lang->line('to'); ?>
            </th>
            
       
            
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
            <td><?php echo $slno; ?></td>          
            <td><?php  echo $batch['prog_type_name']; ?></td>
            <td><?php  echo $batch['p_name']; ?></td>
            <td><?php  echo $batch['b_name']; ?></td>           
            <td><?php  echo $batch['b_startdate']; ?></td>
            <td><?php  echo $batch['b_enddate']; ?></td> 
            <td>
            <div class="material-switch switchcheck">
            <input id="is_status_<?php echo $batch['bt_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($batch['b_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $batch['bt_id']; ?>, this.checked)">
            <label for="is_status_<?php echo $batch['bt_id']; ?>" class="label-success"></label>
            </div>
            </td>
            
            <td text-align="right">
            <a data-placement="left" href="<?php echo site_url('semester/batch/edit/' . $batch['bt_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
            <a data-placement="left" href="<?php echo site_url('semester/batch/delete/' . $batch['bt_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
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
            
            
            
   
            


            function getProgrammes() {
            var progType          = $('#programee_type').val();
            var selectedProgramme = $('#selectedProgramme').val(); // get selected value 
            
         

            $.ajax({
            type: "POST",
            url: "<?php echo site_url('semester/batch/getProgramsByType'); ?>",
            data: { progType: progType },
            success: function (result) {

            

            $('#programee').empty();
            var jsondata = JSON.parse(result);
            // $('#programee').append('<option value="">Select Programme</option>');
            $.each(jsondata, function (key, value) {
            var selectedAttr = (value.id == selectedProgramme) ? 'selected' : '';
            $('#programee').append('<option value="' + value.id + '" ' + selectedAttr + '>' + value.p_name + '</option>');
            });
            }
            });
            }



            $(document).ready(function () {              
            <?php if (isset($editbatch['b_progtype'])): ?>
            getProgrammes(); 
            <?php endif; ?>
            });

            
            </script>
            
            
            
           