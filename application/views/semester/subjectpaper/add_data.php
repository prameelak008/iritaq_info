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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('subjectpaper'); ?></h1>
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
<h3 class="box-title titlefix"> <?php echo $this->lang->line('paper');?></h3>
            </div><!-- /.box-header -->



            <form id="form1" action="<?php echo site_url('semester/semester_Subjectpaper/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

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
            <label for="exampleInputEmail1"><?php echo $this->lang->line('select').'&nbsp;'.$this->lang->line('subject'); ?><small class="req"> *</small></label>
            <select class="form-control js-example-basic-single" name="subjectid" id="subjectid" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php foreach ($subjects as $subs) {
            ?>
            <option value="<?php echo $subs['id'] ?>" <?php if (set_value('subjectid') == $subs['id']) { echo "selected=selected"; } ?>><?php echo $subs['name'].'&nbsp;-&nbsp;'.$subs['code'] ?></option> 
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('subjectid'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('paper_code'); ?><small class="req"> *</small></label>
            <input type="text" name="paper_code" id="paper_code" class="form-control" value="<?php echo set_value('paper_code'); ?>" />

            <span class="text-danger"><?php echo form_error('paper_code'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('papername'); ?><small class="req"> *</small></label>
            <input type="text" name="papername" id="papername" class="form-control" value="<?php echo set_value('papername'); ?>" />          
            <span class="text-danger"><?php echo form_error('papername'); ?></span>
            </div>



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
            <textarea class="form-control" name="description" id="description"></textarea>        
            <span class="text-danger"><?php echo form_error('description'); ?></span>
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
            if ($this->rbac->hasPrivilege('batch', 'can_add')) {
            echo "8";
            } else {
            echo "12";
            }
            ?>">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('paper').'&nbsp;'.$this->lang->line('list'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">

            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>                
            <th><?php echo $this->lang->line('slno'); ?></th>
            <th><?php echo $this->lang->line('subject'); ?> </th> 
            <th><?php echo $this->lang->line('code'); ?></th>
            <th><?php echo $this->lang->line('paper'); ?></th>
            <th><?php echo $this->lang->line('status'); ?></th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            $sl=1;
            foreach($subject_paper as $paper)
            {
            ?>
            <tr>

            <td><?php  echo $sl; ?> </td> 
            <td><?php  echo $paper['name']; ?></td>
            <td><?php  echo $paper['sem_paper_code']; ?></td>
            <td><?php  echo $paper['sem_paper_paper']; ?></td>
            <td>
            <div class="material-switch switchcheck">
            <input id="is_status_<?php echo $paper['sem_paper_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($paper['sem_paper_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $paper['sem_paper_id']; ?>, this.checked)">
            <label for="is_status_<?php echo $paper['sem_paper_id']; ?>" class="label-success"></label>
            </div>
            </td>
            <td text-align="right">
            <a data-placement="left" href="<?php echo site_url('semester/Semester_Subjectpaper/edit/' . $paper['sem_paper_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
            <a data-placement="left" href="<?php echo site_url('semester/Semester_Subjectpaper/delete/' . $paper['sem_paper_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash trashstyle" ></i></a>
            </td>

            </tr>
            <?php $sl++;
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
            function updateStatus(id, status) 
            { 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('semester/semester_Subjectpaper/update_status'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Status updated successfully');
            }
            };
            xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
            }
            </script>