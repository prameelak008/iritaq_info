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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('semester'); ?></h1>
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
                        
                        

                        <form id="form1" action="<?php echo site_url('semester/semestertype/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_id'); ?><small class="req"> *</small></label>
                                <input id="semester_id" name="semester_id" placeholder="<?php echo $this->lang->line('semester_id'); ?>" type="text" class="form-control" readonly  value="<?php echo $sem['st_id']; ?>" />
                                <span class="text-danger"><?php echo form_error('semester_id'); ?></span>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_code'); ?><small class="req"> *</small></label>
                                <input id="semester_code" name="semester_code" placeholder="<?php echo $this->lang->line('semester_code'); ?>" type="text" class="form-control"  value="<?php echo $sem['st_code']; ?>" />
                                <span class="text-danger"><?php echo form_error('semester_code'); ?></span>
                                </div>
                                
                                
    
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_name'); ?><small class="req"> *</small></label>
                                <input id="semester_name" name="semester_name" placeholder="<?php echo $this->lang->line('semester_name'); ?>" type="text" class="form-control"  value="<?php echo $sem['st_name']; ?>" />
                                <span class="text-danger"><?php echo form_error('semester_name'); ?></span>
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
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('semester').'&nbsp;'.$this->lang->line('list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       
                                <div class="table-responsive mailbox-messages">
                                <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                <tr>
                                <th><?php echo $this->lang->line('slno'); ?></th>                                    
                                <th><?php echo $this->lang->line('semester_id'); ?></th>
                                <th><?php echo $this->lang->line('semester_code'); ?></th>
                                <th><?php echo $this->lang->line('semester_name'); ?></th> 
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
                                <a data-placement="left" href="<?php echo site_url('semester/semestertype/delete/' . $semester['st_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash trashstyle" ></i></a>
                                </td>
                                
                                
                                </tr>
                                <?php 
                                $slno++;
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
