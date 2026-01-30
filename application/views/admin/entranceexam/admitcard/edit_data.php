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
                <i class="fa fa-usd"></i>Admit Card</h1>
                </section>
                
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <!-- <?php
                if ($this->rbac->hasPrivilege('income', 'can_add')) {
                ?> -->
                
                
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary" style="padding-bottom: 100px">
                <div class="box-header with-border">
                <h3 class="box-title">Admit Card-&nbsp;<?php echo   $current_entrancesession['session']; ?></h3>
                </div><!-- /.box-header -->
                
                <form id="form1" action="<?php echo site_url('EntranceExam/updateadmitcard'); ?>"   method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="box-body">
                <!-- <?php if ($this->session->flashdata('msg')) { ?>
                <?php echo $this->session->flashdata('msg') ?>
                <?php } ?> -->
                <!-- <?php
                if (isset($error_message)) {
                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                }
                ?>
                <?php echo $this->customlib->getCSRF(); ?>
                
                -->
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Phase'); ?><small class="req"> *</small></label>
                <select  id="entrance_phase" name="entrance_phase" class="form-control select2"  >
                <!--<option value"<?php  echo $getadmitbyid['entrance_examgroup_id']; ?>"><?php  echo $getadmitbyid['entrance_examgroup_name']; ?></option>-->
                <?php
                foreach($get_phase as $phase)
                {
                ?>
                <option value="<?php echo  $phase['entrance_examgroup_id']; ?>" <?php
                if ($getadmitbyid['entrance_examgroup_name'] == $phase['entrance_examgroup_id']) {
                echo "selected=selected";
                }
                ?>><?php echo $phase['entrance_examgroup_name']; ?></option>
                <?php } ?>
                </select>
                </div>
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Course'); ?><small class="req"> *</small></label>
                <select class="form-control" name="centre_course" id="centre_course" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                
                <?php foreach($courselist as $crslist){ ?>
                <option value="<?php echo $crslist['entranceexam_course_id']; ?>" 
                <?php 
                if($crslist['entranceexam_course_id']==$getadmitbyid['entrance_admitcardapplied_course']) 
                {
                echo "selected=selected";
                }
                ?>><?php echo $crslist['entranceexam_course_name']; ?></option>
                <?php } ?>
                </select>
                </div>
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('date').'&nbsp;'.$this->lang->line('time'); ?><small class="req"> *</small></label>
                
                <input type="hidden" name="entrance_admitcardid"  class="form-control" value="<?php  echo $getadmitbyid['entrance_admitcardid']; ?>"  >
                
                <input type="text" name="entrance_admitcarddate_time" placeholder="Date & Time" class="form-control" value="<?php  echo $getadmitbyid['entrance_admitcarddate_time']; ?>"  required>
                <span class="text-danger"><?php echo form_error('entrance_admitcarddate_time'); ?></span>
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1">Description<small class="req"> *</small></label>
                <textarea  class="form-control" rows="10" cols="5" name="entrance_admitcarddescription" ><?php  echo $getadmitbyid['entrance_admitcarddescription']; ?></textarea>
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1">Status<small class="req"> *</small></label>
                <select name="entrance_admitstatus" class="form-control">
                
                <?php 
                if($getadmitbyid['entrance_admitcardstatus']=='1')
                {
                $st="Active";
                }
                else if($getadmitbyid['entrance_admitcardstatus']=='0')
                {
                $st="Inactive";
                }
                ?>
                
                
                <option value="<?php  echo $getadmitbyid['entrance_admitstatus']; ?>"><?php  echo $st; ?></option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                </select>
                </div>
                
                </div><!-- /.box-body -->
                
                <div class="box-footer">
                <input type="submit" class="btn btn-info pull-right" value="SAVE">
                </div>
                </form>
                
                
                
                </div>
                
                </div><!--/.col (right) -->
                <!-- left column -->
                <!--  <?php } ?> -->
                <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"> Admit Card-&nbsp;<?php echo   $current_entrancesession['session']; ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example" data-export-title="">
                <thead>
                <tr>
                
                <th><?php echo $this->lang->line('name'); ?></th>
                <th><?php echo $this->lang->line('phase'); ?></th>
                <th><?php echo $this->lang->line('date').'&nbsp;'.$this->lang->line('time'); ?></th>
                <th><?php echo $this->lang->line('description'); ?></th>
                <th><?php echo $this->lang->line('status'); ?></th>
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 0;
                foreach ($admitcard as $admit) { ?>
                <tr>                                                  
                
                <td><?php echo $admit['entranceexam_course_name']; ?></td>
                
                <td><?php echo $admit['entrance_examgroup_name']; ?></td>
                
                <td><?php echo $admit['entrance_admitcarddate_time']; ?></td>
                <td><?php  echo $admit['entrance_admitcarddescription']; ?></td>
                <td><?php  
                
                if($admit['entrance_admitcardstatus']=="1")
                {
                $st="Active";
                }
                else
                {
                $st="Inactive";
                }
                
                echo $st; ?></td>
                
                
                <td align="right">
                <a data-placement="left" href="<?php echo site_url('EntranceExam/editadmitcard/' . $admit['entrance_admitcardid']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                <a data-placement="left" href="<?php echo site_url('EntranceExam/deleteadmitcard/' . $admit['entrance_admitcardid']); ?>" class="btn btn-default btn-xs" style="color:#fd5050;"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
                </td>
                </tr>                                                   
                <?php
                $count++;
                }
                ?>
                </tbody>
                </table>
                </div>
                </div>
                </div>
                </div>
               
                
                </div>
                
                </section>
                </div>
                
                
                
                
                
                
                
