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
                        <i class="fa fa-usd"></i> <?php echo $this->lang->line('batch_semester'); ?></h1>
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
                        <h3 class="box-title"><?php echo $this->lang->line('batch_semester'); ?></h3>
                        </div><!-- /.box-header -->



                        <form id="form1" action="<?php echo site_url('semester/Set_SemesterDuration/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                        <div class="box-body">
                        <?php echo $this->customlib->getCSRF(); ?>  
                        <div class="form-group"> 
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_type'); ?></label>
                        <select name="batch_type" id="batch_type" class="form-control" >
                        <option value=""><?php echo $this->lang->line('batch_type'); ?></option>             
                        <?php 
                        foreach($batchlist as $bt)
                        {
                        ?>
                        <option value="<?php  echo $bt['b_id'];?>"
                        <?php
                        if(set_value('batch_type')==$bt['b_id'])

                        echo "selected=selected"; 

                        ?>>
                        <?php echo $bt['b_name']; ?>  
                        </option>
                        <?php } ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('batch_type'); ?></span>
                        </div>      



                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_type'); ?></label>
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
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_no'); ?></label>
                        <input id="semester_no"  name="semester_no" placeholder="<?php echo $this->lang->line('semester_no'); ?>" type="text" class="form-control" />
                        <span class="text-danger"><?php echo form_error('semester_no'); ?></span>
                        </div>



                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
                        <input id="from_date"  name="from_date"  placeholder="<?php echo $this->lang->line('from_date'); ?>" type="date" class="form-control" />
                        <span class="text-danger"><?php echo form_error('from_date'); ?></span>
                        </div>


                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?></label>
                        <input id="to_date"  name="to_date"   placeholder="<?php echo $this->lang->line('to_date'); ?>" type="date"    class="form-control "  />
                        <span class="text-danger"><?php echo form_error('to_date'); ?></span>
                        </div> 

                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('capacity'); ?></label>
                        <input id="capacity"  name="capacity" placeholder="<?php echo $this->lang->line('capacity'); ?>" type="text" class="form-control"  />
                        <span class="text-danger"><?php echo form_error('capacity'); ?></span>
                        </div>
                        </div>

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
                        <th><?php echo $this->lang->line('batch'); ?></th>

                        <th><?php echo $this->lang->line('semester_type'); ?>  </th>

                        <th><?php echo $this->lang->line('semester_no'); ?>
                        </th>        

                        <th><?php echo $this->lang->line('from'); ?>
                        </th>
                        <th><?php echo $this->lang->line('to'); ?>
                        </th>   

                        <th><?php echo $this->lang->line('capacity'); ?>
                        </th>  

                        <th><?php echo $this->lang->line('status'); ?></th>
                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $slno=1;          
                        foreach($batch_semester as $bt_sem)
                        {
                        ?>
                        <tr>
                        <td><?php echo $slno; ?></td>          
                        <td><?php  echo $bt_sem['b_name']; ?></td>
                        <td><?php  echo $bt_sem['st_name']; ?></td>
                        <td><?php  echo $bt_sem['bchsem_no']; ?></td>
                        <td><?php  echo $bt_sem['bchsem_from']; ?></td>
                        <td><?php  echo $bt_sem['bchsem_to']; ?></td>
                        <td><?php  echo $bt_sem['bchsem_capacity']; ?></td>

                        <td>
                        <div class="material-switch switchcheck">
                        <input id="is_status_<?php echo $bt_sem['bchsem_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($bt_sem['b_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $bt_sem['bchsem_id']; ?>, this.checked)">
                        <label for="is_status_<?php echo $bt_sem['bchsem_id']; ?>" class="label-success"></label>
                        </div>
                        </td>

                        <td text-align="right">
                        <a data-placement="left" href="<?php echo site_url('semester/batchsemester/edit/' . $bt_sem['bchsem_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                        <a data-placement="left" href="<?php echo site_url('semester/batchsemester/delete/' . $bt_sem['bchsem_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>                        
                        <a href="#" class="btn btn-default btn-xs" onclick="openSemesterModal()" title="Add Semester"><i class="fa fa-plus"></i></a>
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


                        <div id="semesterModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                        <form id="semesterForm" method="post" action="<?php echo site_url('semester/batchsemester/add_multiple'); ?>">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title"><?php echo $this->lang->line('add').'&nbsp;'.$this->lang->line('semester').''.$this->lang->line('details'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        ×
                        </button>
                        </div>
                        <div class="modal-body">
                        <table class="table table-bordered" id="semesterTable">
                        <thead>
                        <tr>
                        <th><?php echo $this->lang->line('semester').'&nbsp;'.$this->lang->line('no') ;?> </th>
                        <th><?php echo $this->lang->line('from').'&nbsp;'.$this->lang->line('date') ;?></th>
                        <th><?php echo $this->lang->line('to').'&nbsp;'.$this->lang->line('date') ;?></th>
                        <th><?php echo $this->lang->line('capacity');?></th>
                        <th><?php echo $this->lang->line('remove');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Rows will be added here -->
                        </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-sm" onclick="addSemesterRow()">
                        <i class="fa fa-plus"></i> Add Row
                        </button>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                        </form>
                        </div>
                        </div>


                        <script>
                        function openSemesterModal()
                        {
                        $('#semesterModal').modal('show');
                        $('#semesterTable tbody').empty(); // Clear previous rows
                        addSemesterRow(); // Add default one row
                        }

                        function addSemesterRow() {
                        const rowCount = $('#semesterTable tbody tr').length + 1;
                        const rowHtml = `
                        <tr>
                        <td><input type="number" name="semester_no[]" class="form-control" value="${rowCount}" required></td>
                        <td><input type="date" name="from_date[]" class="form-control" required></td>
                        <td><input type="date" name="to_date[]" class="form-control" required></td>
                        <td><input type="number" name="capacity[]" class="form-control" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="fa fa-trash"></i></button></td>
                        </tr>
                        `;
                        $('#semesterTable tbody').append(rowHtml);
                        }

                        function removeRow(button)
                         {
                        $(button).closest('tr').remove();
                        }


                        function updateStatus(id, status) 
                        {             
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "<?php echo site_url('semester/batchSemester/update_status'); ?>", true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log('Status updated successfully');
                        }
                        };
                        xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
                        }
                        </script>








