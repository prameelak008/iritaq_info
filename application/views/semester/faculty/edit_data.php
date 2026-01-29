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
            <i class="fa fa-usd"></i><?php echo $this->lang->line('edit').'&nbsp;&nbsp;'.$this->lang->line('faculty'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">      

            <div class="col-md-12">
            <?php $this->load->view('layout/topbar'); ?>
            </div>
            &nbsp;


        <div class="row" >
           
            
            <?php
           // if ($this->rbac->hasPrivilege('faculty', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;&nbsp;'.$this->lang->line('faculty'); ?></h3>
                        </div><!-- /.box-header -->
                        
                        

                        <form id="form1" action="<?php echo site_url('semester/faculty/edit/' . $id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('faculty_id'); ?><small class="req"> *</small></label>
                                <input id="faculty_id" name="faculty_id" placeholder="Faculty Identify Number" type="text" class="form-control" readonly  value="<?php echo $faculties['faculty_id']; ?>" />
                                
                                <span class="text-danger"><?php echo form_error('faculty_id'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('faculty_name'); ?><small class="req"> *</small></label>
                                <input id="faculty_name" name="faculty_name" placeholder="Faculty Identify Name" type="text" class="form-control"  value="<?php echo $faculties['faculty_name']; ?>" />
                                <span class="text-danger" id="form_error_faculty_name"><?php echo form_error('faculty_name'); ?></span>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('faculty_code'); ?><small class="req"> *</small></label>
                                <input id="faculty_code" name="faculty_code" placeholder="Faculty Identify Code" type="text" class="form-control"  value="<?php echo $faculties['faculty_code']; ?>" />
                                <span class="text-danger" id="form_error_faculty_code"><?php echo form_error('faculty_code'); ?></span>
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
                                <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                <tr>
                                <th><?php echo $this->lang->line('faculty_id'); ?>
                                </th>

                                  <th><?php echo $this->lang->line('faculty_name'); ?>
                                </th>
                                <th><?php echo $this->lang->line('faculty_code'); ?>
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
                                <td><?php  echo $faculty['faculty_id']; ?></td>
                                  <td><?php  echo $faculty['faculty_name']; ?></td>
                                <td><?php  echo $faculty['faculty_code']; ?></td>
                              
                                
                                <td>
                                <div class="material-switch switchcheck">
                                <input id="is_status_<?php echo $faculty['id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($faculty['faculty_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $faculty['id']; ?>, this.checked)">
                                <label for="is_status_<?php echo $faculty['id']; ?>" class="label-success"></label>
                                </div>
                                </td>
                                
                                <td text-align="right">
                                <a data-placement="left" href="<?php echo site_url('semester/faculty/edit/' . $faculty['id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                <a data-placement="left" href="<?php echo site_url('semester/faculty/delete/' . $faculty['id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash trashstyle"></i></a>
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
