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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('institute'); ?></h1>
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
            <h3 class="box-title"><?php echo $this->lang->line('edit').'&nbsp;'. $this->lang->line('institute'); ?></h3>
            </div><!-- /.box-header -->
        
            <form id="form1" action="<?php echo site_url('EntranceExam/update_institute'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            
            <div class="box-body">
            <input type="hidden" name="inst_id" value="<?php  echo $inedit['entranceexam_insituteid']; ?>"/>
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
            <select name="inst_name" id="inst_name" class="form-control" required>
            <option  value="<?php  echo $inedit['entranceexam_insitutename']; ?>"><?php  echo $inedit['entranceexam_insitutename']; ?></option>
            <?php
            foreach($institutelist as $inst)
            {
            ?>
            <option value="<?php echo $inst['entranceexam_insitutename']; ?>"><?php echo $inst['entranceexam_insitutename']; ?></option>
            <?php } ?>
            </select>
            </div>
            
            <!--<div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('phase'); ?><small class="req"> *</small></label>
            <select name="phase" id="phase" class="form-control" >
            <?php
            foreach($get_phase as $phse)
            {
            ?>
            <option value="<?php echo $phse['entrance_examgroup_id']; ?>"
            <?php 
            if($inedit['entranceexam_phaselist']==$phse['entrance_examgroup_id'])
            {
            echo "selected=selected";
            }
            ?> > <?php
            echo $phse['entrance_examgroup_name']; ?></option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('phase'); ?></span>
            </div>-->
            
            
            
            
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('phase'); ?><small class="req"> *</small></label>
        <select name="phase" id="phase" class="form-control">
        <?php
        if($inedit['entranceexam_phaselist'] == 0) {
        echo '<option value="" selected>Select</option>';
        ?>
        <?php
        foreach($get_phase as $phse)
        {
        ?>
        <option value="<?php echo $phse['entrance_examgroup_id']; ?>"> 
        <?php
        echo $phse['entrance_examgroup_name']; ?></option>
        <?php 
        } 
        ?>
        <?php
        } 
        
        else
        {
        foreach($get_phase as $phse) {
        ?>
        <option value="<?php echo $phse['entrance_examgroup_id']; ?>"
        <?php 
        if($inedit['entranceexam_phaselist'] == $phse['entrance_examgroup_id'])
        {
        echo "selected=selected";
        }
        ?> > <?php
        echo $phse['entrance_examgroup_name']; ?></option>
        <?php 
        } 
        } 
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('phase'); ?></span>
        </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
            <select name="session" id="session" class="form-control" required>
            <option  value="<?php  echo $inedit['id']; ?>"><?php  echo $inedit['session']; ?></option>
            <?php
            foreach($sessionlist as $session)
            {
            ?>
            <option value="<?php echo $session['id'] ?>" <?php
            if ($current_session == $session['id']) 
            {
            echo "selected=selected";
            }
            ?>><?php   echo $session['session']; ?></option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('session'); ?></span>
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('seat'); ?><small class="req"> *</small></label>
            <input type="text" required name="inst_seat" placeholder="Enter Seat No" class="form-control" value="<?php echo $inedit['entranceexam_insituteseats'];  ?>" >
            </div>
            
           
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('course'); ?><small class="req"> *</small></label>
            <select class="form-control" name="inst_course" required>
            <?php foreach($courselist as $crslist){ ?>
            <option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if($inedit['entranceexam_insitutescourse']==$crslist['entranceexam_course_id'])
            {
            echo "selected=selected";
            }?>><?php echo $crslist['entranceexam_course_name']; ?></option>
            <?php } ?>
            </select>
            </div>
            </div>
            
            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('update'); ?></button>
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
            <h3 class="box-title"><?php echo $this->lang->line('institute').'&nbsp;'. $this->lang->line('list'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            
            
            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example" >
            <thead>
            <tr>
            <th><?php echo $this->lang->line('name'); ?></th>
            <th><?php echo $this->lang->line('phase'); ?></th>
            <th><?php echo ('Seat'); ?></th>
            <th><?php echo ('Course'); ?></th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>
            
            
            <?php
            $count = 0;
            foreach ($get_all_institute as $instlist) { ?>
            <tr>                                                  
            <td><?php echo $instlist['entranceexam_insitutename']; ?></td>
            <td><?php echo $instlist['entrance_examgroup_name']; ?></td>
            
            <td><?php echo $instlist['entranceexam_insituteseats']; ?></td>
            <td><?php echo $instlist['entranceexam_course_name']; ?></td>
            <td align="right">
            <a data-placement="left" href="<?php echo site_url('EntranceExam/edit_institute/' . $instlist['entranceexam_insituteid']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
            <a data-placement="left" href="<?php echo site_url('EntranceExam/delete_institute/' . $instlist['entranceexam_insituteid']); ?>" class="btn btn-default btn-xs" onclick="return doconfirm();"    data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
            </td>
            </tr>                                                   
            <?php
            $count++;
            }
            ?>
            </tbody>
            </table>
            </div>
            </div><!-- /.box-body -->
            </div>
            </div><!--/.col (left) -->
            <!-- right column -->
            
            </div>
            
            </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!--  <script>
            ( function ( $ ) {
            'use strict';
            $(document).ready(function () {
            initDatatable('income-list','admin/income/getincomelist',[],[],100);
            });
            } ( jQuery ) )
            </script>  -->
            
            
            
            
            
            
