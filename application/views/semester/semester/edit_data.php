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
                <i class="fa fa-usd"></i> <?php echo  $this->lang->line('edit').'&nbsp;'.$this->lang->line('semester'); ?></h1>
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
                <h3 class="box-title"><?php echo $this->lang->line('edit').'&nbsp;'.$this->lang->line('semester'); ?></h3>
                </div><!-- /.box-header -->
                <?php
                print_r($sem);
                ?>
                <form id="form1" action="<?php echo site_url('semester/semester/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="box-body">
                
                <?php 

                if (isset($error_message)) {
                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                }
                ?>
                <?php echo $this->customlib->getCSRF(); ?>                 
                
                
                 <!-- <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
                <select name="programee_type" id="programee_type" class="form-control">
                <option value="">Select Type</option>
                <?php
                foreach($Programmetype_list as $prog)
                {
                ?>
                <option value="<?php  echo $prog['prog_type_id']; ?>"
                <?php   
                if($sem['prog_type_id']==$prog['prog_type_id'])
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
            <option value="">Select Type</option>
            <?php
            foreach($Programmetype_list as $prog)
            {
            ?>
            <option value="<?php  echo $prog['prog_type_id']; ?>"
            <?php   
            if($sem['s_prog']==$prog['prog_type_id'])
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
            </div> -->







            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label> 

            <select name="program_type" id="program_type" class="form-control" >
            <option value=""><?php echo $this->lang->line('type'); ?></option>

            <?php
            foreach($Programmetype_list as $prog_type)
            {
            ?>
            <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if($sem['prog_type_id']==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
            <?php 
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('programee_type'); ?></span>
            </div>
            
            

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programe" id="programe" class="form-control">
                
            
            </select>
            <span class="text-danger"><?php echo form_error('programe'); ?></span>
            </div>
            
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_type'); ?></label>
                <select name="semester_type" id="semester_type" class="form-control">
                <option value="">Select Type</option>
                <?php
                
                
                foreach($semestertype_list as $semt)
                {
                ?>
                <option value="<?php  echo $semt['st_id']; ?>"
                <?php   
                if($sem['s_sem_type']==$semt['st_id'])
                {
                echo "selected=selected";
                }
                ?>
                >
                <?php echo $semt['st_name']; ?>  
                </option>
                <?php }?>
                </select>
                <span class="text-danger"><?php echo form_error('st_name'); ?></span>
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
                if ($this->rbac->hasPrivilege('semester', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"> <?php echo $this->lang->line('semester'); ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr>
                
                <!--<th><?php echo $this->lang->line('semester_id'); ?>-->
                <!--</th>-->
                <!--<th><?php echo $this->lang->line('semester_code'); ?>-->
                <!--</th>-->
                <th><?php echo $this->lang->line('semester_name'); ?>
                </th>
                
                <th><?php echo $this->lang->line('programee_type'); ?>
                </th>
                
                <th><?php echo $this->lang->line('status'); ?>
                </th>
                
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                foreach($semester_list as $semester)
                {
                ?>
                <tr>
                <!--<td><?php  echo $semester['s_id']; ?></td>-->
                <!--<td><?php  echo $semester['s_code']; ?></td>-->
                <!--<td><?php  echo $semester['s_name']; ?></td>-->


                <td><?php  echo $semester['st_name']; ?></td>
                <td><?php  echo $semester['prog_type_name']; ?></td>
                <td>
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $semester['s_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($semester['s_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $semester['s_id']; ?>, this.checked)">
                <label for="is_status_<?php echo $semester['s_id']; ?>" class="label-success"></label>
                </div>
                </td>
                
                <td text-align="right">
                <a data-placement="left" href="<?php echo site_url('semester/semester/edit/' . $semester['s_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                <a data-placement="left" href="<?php echo site_url('semester/semester/delete/' . $semester['s_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
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
  $(document).ready(function() {
   
    const progTypeId = '<?php echo isset($sem['prog_type_id']) ? $sem['prog_type_id'] : ''; ?>';
    const selectedProgrameeId = '<?php echo isset($sem['s_prog']) ? $sem['s_prog'] : ''; ?>';
    const selectText = "<?php echo $this->lang->line('select'); ?>";

    alert(prog_type_id);
    alert(selectedProgrameeId)

    function loadProgrameeList(progTypeId, selectedProgrameeId = '') {
      if (progTypeId !== '') {
        $.ajax({
          url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
          method: "POST",
          data: { prog_type_id: progTypeId },
          dataType: "json",
          success: function(data) {
            $('#programe').empty().append('<option value="">' + selectedProgrameeId + '</option>');
            $.each(data, function(i, item) {
              const selected = (item.id.toString() === selectedProgrameeId.toString()) ? 'selected' : '';
              $('#programe').append('<option value="' + item.id + '" ' + selected + '>' + item.p_name + '</option>');
            });
          },
          error: function(xhr, status, error) {
            console.error("Error loading programee list:", error);
          }
        });
      }
    }

    // Load list when dropdown changes (optional for edit)
    $('#program_type').change(function() {
      const selectedType = $(this).val();
      loadProgrameeList(selectedType);
    });

    // 🟡 Trigger AJAX call when page loads with edit values
    if (progTypeId !== '') {
      loadProgrameeList(progTypeId, selectedProgrameeId);
    }
  });
</script>




