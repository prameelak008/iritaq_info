                  <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
                  <style>
                  .tab {
                  overflow-x: auto;
                  overflow-y: hidden;
                  background-color: #ffffff;
                  border-bottom: 3px solid #e0e0e0;
                  display: flex;
                  gap: 5px;
                  white-space: nowrap;
                  -webkit-overflow-scrolling: touch;
                  scrollbar-width: thin;
                  }

                  .tab::-webkit-scrollbar {
                  height: 4px;
                  }

                  .tab::-webkit-scrollbar-track {
                  background: #f1f1f1;
                  }

                  .tab::-webkit-scrollbar-thumb {
                  background: #888;
                  border-radius: 4px;
                  }

                  /* Style the buttons that are used to open the tab content */
                  .tab button {
                  background-color: #f8f9fa;
                  border: none;
                  outline: none;
                  cursor: pointer;
                  padding: 16px 30px;
                  transition: all 0.3s ease;
                  border-radius: 10px 10px 0 0;
                  font-size: 20px;
                  font-weight: 500;
                  color: #214370;
                  border: 2px solid transparent;
                  border-bottom: none;
                  position: relative;
                  margin-bottom: -3px;
                  flex-shrink: 0;
                  }

                  /* Change background color of buttons on hover */
                  .tab button:hover {
                  background-color: #e8f0fe;
                  color: #1a73e8;
                  }

                  /* Create an active/current tablink class */
                  .tab button.active {
                  background-color: #ffffff;
                  color: #1a73e8;
                  border: 2px solid #e0e0e0;
                  border-bottom: 3px solid #ffffff;
                  font-weight: 600;
                  }

                  /* Style the tab content */
                  .tabcontent {
                  display: none;
                  padding: 25px 15px;
                  border: 2px solid #e0e0e0;
                  border-top: none;
                  background-color: #ffffff;
                  border-radius: 0 0 10px 10px;
                  animation: fadeIn 0.4s ease;
                  }

                  @keyframes fadeIn {
                  from {
                  opacity: 0;
                  transform: translateY(-10px);
                  }
                  to {
                  opacity: 1;
                  transform: translateY(0);
                  }
                  }

                  /* Mobile devices (phones) */
                  @media (max-width: 576px) {
                  .box-body {
                  margin: 10px;
                  }

                  .tab button {
                  padding: 14px 20px;
                  font-size: 14px;
                  min-width: 120px;
                  }

                  .tabcontent {
                  padding: 20px 12px;
                  }

                  .tabcontent h3 {
                  font-size: 18px;
                  }
                  }

                  /* Tablets */
                  @media (min-width: 577px) and (max-width: 768px) {
                  .tab button {
                  padding: 15px 25px;
                  font-size: 15px;
                  }
                  }

                  /* Small laptops */
                  @media (min-width: 769px) and (max-width: 992px) {
                  .tab button
                   {
                  padding: 16px 28px;
                  }
                  }
                  </style>




                  <div class="content-wrapper" >
                  <section class="content-header">
                  <h1>
                  <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('select'); ?> <small></small></h1>
                  </section>

                  <section class="content">
                  <div class="col-md-12">
                  <?php
                  $this->load->view('layout/topbar'); ?>
                  </div>
                  &nbsp;


                  
                  <div class="row">
                  <div class="col-md-12">
                  <div class="box box-primary">
                  <div class="box-header with-border">

                 
                  <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('set_duration'); ?> <small></small>
               

                  </div>
                  <div class="box-body">
                  <div class="tab">
                  <button class="tablinks" data-toggle="tab" onclick="set_tab(event, 'Programee')"><?php echo $this->lang->line('programee'); ?></button>
                  <button class="tablinks" onclick="set_tab(event, 'Batch')"><?php echo $this->lang->line('batch'); ?></button>
                  <button class="tablinks" onclick="set_tab(event, 'Semester')"><?php echo $this->lang->line('semester'); ?></button>
                  <button class="tablinks" onclick="set_tab(event, 'Seat_Capacity')"><?php echo $this->lang->line('seat_capacity'); ?></button>
                  </div>
                  <p>           

                  <div id="Programee" class="tabcontent">
                  <div class="row">
                  <div class="col-md-4">
                  <!-- Horizontal Form -->
                  <div class="box box-primary">
                  <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $this->lang->line('programee'); ?></h3>
                  </div>

                  <form id="form1" class="ajax-form001" action="<?php echo site_url("semester/setduration/") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                  <div class="box-body">
                  <?php
                  /* if ($this->session->flashdata('msg')) {?>
                  <?php echo $this->session->flashdata('msg') ?>
                  <?php }
                  */
                  ?>            
                  <?php echo $this->customlib->getCSRF(); 
                  ?> 


                  <input id="program_id" name="program_id"  placeholder="Program Id" type="hidden" class="form-control" />
                  
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
                  <select name="program_type" id="program_type" class="form-control" >
                  <option value=""><?php echo $this->lang->line('programmetype'); ?></option>
                  <?php
                  foreach($Programmetype_list as $prog_type)
                  {
                  ?>
                  <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
                  <?php 
                  }
                  ?>
                  </select>
                  <span class="text-danger"><?php echo form_error('program_type'); ?></span>
                  </div>


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?><small class="req"> *</small></label>
                  <select name="programe" id="programe" class="form-control">
                  </select>
                  <span class="text-danger"><?php echo form_error('programe'); ?></span>
                  </div>


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('date_from'); ?><small class="req"> *</small></label>
                  <input id="date_from" name="date_from" placeholder="From Date"  type="date" class="form-control"  value="<?php echo set_value('date_from'); ?>" />
                  <span class="text-danger"><?php echo form_error('date_to'); ?></span>
                  </div>


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('date_to'); ?><small class="req"> *</small></label>
                  <input id="date_to" name="date_to" placeholder="To Date" type="date" class="form-control"  value="<?php echo set_value('date_to'); ?>" />
                  <span class="text-danger"><?php echo form_error('date_to'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('no_of_semester'); ?><small class="req"> *</small></label>
                  <input id="No_of_Semester" name="No_of_Semester" placeholder="No Of Semester" type="text" class="form-control"  value="<?php echo set_value('No_of_Semester'); ?>" />
                  <span class="text-danger"><?php echo form_error('No_of_Semester'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('no_of_months'); ?><small class="req"> *</small></label>
                  <input id="No_of_Months" name="No_of_Months" placeholder="No Of Months" type="text" class="form-control"  value="<?php echo set_value('No_of_Months'); ?>" />
                  <span class="text-danger"><?php echo form_error('No_of_Months'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('no_of_days'); ?><small class="req"> *</small></label>
                  <input id="No_of_Days" name="No_of_Days" placeholder="No Of Days" type="text" class="form-control"  value="<?php echo set_value('No_of_Days'); ?>" />
                  <span class="text-danger"><?php echo form_error('No_of_Days'); ?></span>
                  </div>
                  </div>                  
                  <!-- /.box-body -->

                  <div class="box-footer">

                  <button type="button" class="btn btn-default" id="resetBtn">
                  <?php echo $this->lang->line('reset'); ?>
                  </button>

                  <button type="submit" class="btn btn-info prog-info pull-right"><?php echo $this->lang->line('save'); ?></button>
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

                  <h3 class="box-title titlefix"><?php echo $this->lang->line('programee').'&nbsp;'. $this->lang->line('list'); ?></h3>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body">

                  <div class="table-responsive mailbox-messages" >
                  <table class="table table-striped table-bordered table-hover example" >
                  <thead>
                  <tr>
                  <th><?php echo $this->lang->line('slno'); ?></th>
                  <th><?php echo $this->lang->line('programee_type'); ?></th>
                  <th><?php echo $this->lang->line('programee_id'); ?></th>
                  <th><?php echo $this->lang->line('programee_code'); ?></th>
                  <th><?php echo $this->lang->line('programee_name'); ?></th>
                  <th><?php echo $this->lang->line('date_from'); ?> </th>
                  <th><?php echo $this->lang->line('date_to'); ?> </th>
                  <th><?php echo $this->lang->line('no_of_semester'); ?> </th>
                  <th><?php echo $this->lang->line('no_of_months'); ?> </th>
                  <th><?php echo $this->lang->line('no_of_days'); ?> </th>
                  <th><?php echo $this->lang->line('status'); ?></th>
                  <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $slno=1;
                  foreach($durationlist as $duration)
                  {
                  ?>
                  <tr>
                  <td><?php  echo $slno; ?></td>
                  <td><?php  echo $duration['prog_type_name']; ?></td>  
                  <td><?php  echo $duration['p_id']; ?></td>
                  <td><?php  echo $duration['p_code']; ?></td>
                  <td><?php  echo $duration['p_name']; ?></td>
                  <td><?php  echo $duration['date_from']; ?></td>
                  <td><?php  echo $duration['date_to']; ?></td>         
                  <td><?php  echo $duration['no_of_semester']; ?></td>
                  <td><?php  echo $duration['no_of_months']; ?></td>
                  <td><?php  echo $duration['no_of_days']; ?></td>
                  <td>
                  <div class="material-switch switchcheck">
                  <input id="is_status_<?php echo $duration['duration_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($duration['status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $duration['duration_id']; ?>, this.checked)">
                  <label for="is_status_<?php echo $duration['duration_id']; ?>" class="label-success"></label>
                  </div>
                  </td>

                  <td text-align="right"> 

                  <a data-placement="left"   class="btn btn-default btn-xs edit-btn" data-id="<?php echo $duration['duration_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                  <i class="fa fa-pencil">
                  </i>

                  <a data-placement="left"    class="btn btn-default btn-xs del-btn"  data-id="<?php echo $duration['duration_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                  <i class="fa fa-trash  trashstyle "></i>
                  </a>


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
                  </p>
                  </div>



                  <div id="Batch" class="tabcontent">            
                  <p>
                  <div class="row">
                  <?php
                  // if ($this->rbac->hasPrivilege('programee', 'can_add')) {
                  ?>
                  <div class="col-md-4">
                  <!-- Horizontal Form -->
                  <div class="box box-primary">
                  <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $this->lang->line('batch'); ?> </h3>
                  </div>



                  <form id="form2" class="ajax-form" action="<?php echo site_url('semester/batchduration/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">


                  <div class="box-body">
                  <?php echo $this->customlib->getCSRF(); 
                  ?>                    

                <input id="batch_duration_id" name="batch_duration_id" placeholder="batch Id" type="hidden" class="form-control"   />  
                  

                  
                <div class="form-group">           
                <?= dropdownlist_prog(
                $programs,
                set_value('progm_id')
                ); ?>
                <span class="text-danger"><?= form_error('progm_id'); ?></span>
                </div>  
                 
                  <!-- <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?><small class="req"> *</small></label>
                  <select name="sem_program_type" id="sem_program_type" class="form-control" >
                  <option value=""><?php echo $this->lang->line('programmetype'); ?></option>
                  <?php
                  foreach($Programmetype_list as $prog_type)
                  {
                  ?>
                  <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
                  <?php 
                  }
                  ?>
                  </select>
                  <span class="text-danger"><?php echo form_error('sem_program_type'); ?></span>
                  </div>


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?><small class="req"> *</small></label>
                  <select name="sem_programe" id="sem_programe" class="form-control">
                  </select>
                  <span class="text-danger"><?php echo form_error('sem_programe'); ?></span>
                  </div> -->
<!-- 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Batch Group<small class="req"> *</small></label>
                  <select name="sem_batch_type" id="sem_batch_type" class="form-control" >
                  <option value="">Select Batch</option>

                  <?php
                  foreach($batch_group as $batch)
                  {
                  ?>
                  <option value="<?php echo  $batch['batch_group_id']; ?>"<?php if(set_value('sem_batch_type')==$batch['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $batch['batch_group_name'].'&nbsp;&nbsp;'.$batch['batch_group_year']; ?> </option>
                  <?php 
                  }
                  ?>
                  </select> 
                  <span class="text-danger"><?php echo form_error('sem_batch_type'); ?></span>
                  </div> -->



                  <!-- <div class="form-group">
                  <?php
                  echo batchtype_mode_list(
                  $batch_types,
                  set_value('sem_batch_type'),
                  'sem_batch_type',
                  'sem_batch_type'
                  );
                  ?>
                  </div> -->



                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="batch_type" name="batch_type" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                </div>           
              

                  


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?><small class="req"> *</small></label>
                  <input type="date" name="bt_from_date" id="bt_from_date" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('bt_from_date'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?><small class="req"> *</small></label>
                  <input type="date" name="bt_to_date" id="bt_to_date" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('bt_to_date'); ?></span>
                  </div>
                  </div>
                  <div class="box-footer">
                  <button type="button" class="btn btn-default" id="batch-resetBtn">
                  <?php echo $this->lang->line('reset'); ?>
                  </button>

                  <button type="submit" class="btn btn-info batch-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                 
                
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
                  <h3 class="box-title titlefix"> <?php echo $this->lang->line('batch').'&nbsp;'. $this->lang->line('list');  ?></h3>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body">

                  <div class="table-responsive mailbox-messages">
                  <table class="table table-striped table-bordered table-hover example">
                  <thead>
                  <tr>
                  <!-- <th><?php echo $this->lang->line('semester'); ?>
                  </th> -->

                  <th><?php echo $this->lang->line('programme'); ?></th>
                  <th><?php echo $this->lang->line('batch'); ?>
                  </th>
                  <th><?php echo $this->lang->line('from'); ?>
                  </th>
                  <th><?php echo $this->lang->line('to'); ?> </th>
                  <th><?php echo $this->lang->line('status'); ?></th>
                  <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                  </tr>
                  </thead>
                  <tbody>


                  <?php

                  foreach($get_batch_duration as $batch)
                  {
                  ?>
                  <tr>

                  <td><?php  echo $batch['p_name']; ?></td>

                  <td><?php  echo $batch['sp_name']; ?></td>

                  <td>
                  <?php  echo $batch['fromdate']; ?></td>

                  <td>
                  <?php
                  echo $batch['todate'];
                  ?>
                  </td>
                  <td>

                  <div class="material-switch switchcheck">
                  <input id="is_status_<?php echo $batch['batch_duration_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($batch['status'] == 1 ? 'checked' : ''); ?> onchange="updatebatchStatus(<?php echo $batch['batch_duration_id']; ?>, this.checked)">
                  <label for="is_status_<?php echo $batch['batch_duration_id']; ?>" class="label-success"></label>
                  </div>
                  </td>

                  <td text-align="right">
                  <a data-placement="left"  class="btn btn-default btn-xs edit-btn-batch" data-id="<?php echo $batch['batch_duration_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                  <i class="fa fa-pencil"></i>

                  <a data-placement="left"   class="btn btn-default btn-xs del-btn-bat fontdelcol"  data-id="<?php echo $batch['batch_duration_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                  <i class="fa fa-trash trashstyle"></i>
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
                  </p>
                  </div>
                  <!------ Batch Closed---------------------------->


                  <!-- Semester---------------------->




                  <div id="Semester" class="tabcontent">
                  <p>
                  <div class="row"> 
                  <form id="form3" class="ajax-form" action="<?php echo site_url('semester/set_semesterduration/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  <div class="col-md-4">
                  <!-- Horizontal Form -->
                  <div class="box box-primary">
                  <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $this->lang->line('semester'); ?> </h3>
                  </div><!-- /.box-header -->


                  <div class="box-body">
                  <?php echo $this->customlib->getCSRF(); ?>


                  <input type="hidden" name="semesterduration_id" id="semesterduration_id" class="form-control"/>



                


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>
                  <select name="semester_semtype" id="semester_semtype" class="form-control" >
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
                  <span class="text-danger"><?php echo form_error('semester_semtype'); ?></span>
                  </div>



              <div id="editSemesterModal">
              <div class="form-group">           
              <?= dropdownlist_program(
              $programs,
              set_value('prog_id')
              ); ?>
              <span class="text-danger"><?= form_error('prog_id'); ?></span>
              </div> 
              </div>



                <div id="editSem_batch">
                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_batch_type" name="sem_batch_type" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                </div>
                </div>



                  <div class="form-group">
                  <label for="exampleInputEmail1">Semester Term<small class="req"> *</small></label>
                  <select name="semester_term" id="semester_term" class="form-control" >
                  <option value="">Select Semester</option>
                  <?php
                  foreach($semester_term as $term)
                  {
                  ?>
                  <option value="<?php echo  $term['stm_id']; ?>"<?php if(set_value('semester_term')==$term['stm_id']) { echo "selected=selected"; }        ?> ><?php echo  $term['stm_name']; ?> </option>
                  <?php 
                  }
                  ?>
                  </select> 
                  <span class="text-danger"><?php echo form_error('semester_term'); ?></span>
                  </div>  



                  <div class="form-group">
                  <!-- <label for="exampleInputEmail1">Batch Group<small class="req"> *</small></label>
                  <select name="batch_semtype" id="batch_semtype" class="form-control" >
                  <option value="">Select Batch</option>
                  <?php
                  foreach($batch_group as $batch)
                  {
                  ?>
                  <option value="<?php echo  $batch['batch_group_id']; ?>"<?php if(set_value('sem_batch_type')==$batch['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $batch['batch_group_name'].'&nbsp;&nbsp;'.$batch['batch_group_year']; ?> </option>
                  <?php 
                  }
                  ?>
                  </select>     -->                



                  <!-- <div class="form-group">
                  <?php
                  echo batchtype_mode_list(
                  $batch_types,
                  set_value('sem_batch_type'),
                  'sem_batch_type',
                  'sem_batch_type'
                  );
                  ?>
                  </div> -->

                  <span class="text-danger"><?php echo form_error('batch_semtype'); ?></span>
                  </div>            



                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?><small class="req"> *</small></label>
                  <input   name="from_semdate" id="from_semdate" placeholder="<?php echo $this->lang->line('from_date'); ?>" type="date" class="form-control" />
                  <span class="text-danger"><?php echo form_error('from_semdate'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?><small class="req"> *</small></label>
                  <input   name="to_semdate" id="to_semdate"   placeholder="<?php echo $this->lang->line('to_date'); ?>" type="date"    class="form-control "  />
                  <span class="text-danger"><?php echo form_error('to_semdate'); ?></span>
                  </div>
                  </div>
                  </div>
                  </div>


                  <div class="col-md-4">
                  <!-- Horizontal Form -->
                  <div class="box box-primary">
                  <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                  </div>


                  <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('working').'&nbsp;'.$this->lang->line('days'); ?><small class="req"> *</small></label>
                  <input type="text" name="workingdays" id="workingdays" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('workingdays'); ?></span>
                  </div>


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('learning').'&nbsp;'.$this->lang->line('days'); ?><small class="req"> *</small></label>
                  <input type="text" name="learningdays" id="learningdays" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('learningdays'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('holiday'); ?><small class="req"> *</small></label>
                  <input type="text" name="holidays" id="holidays" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('holidays'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('class').'&nbsp;'.$this->lang->line('leave'); ?><small class="req"> *</small></label>
                  <input type="text" name="classleave" id="classleave" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('classleave'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('leave').'&nbsp;'.$this->lang->line('staff');; ?><small class="req"> *</small></label>
                  <input type="text" name="leavestaff" id="leavestaff" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('leavestaff'); ?></span>
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('leave').'&nbsp;'.$this->lang->line('student'); ?><small class="req"> *</small></label>
                  <input type="text" name="leavestudent" id="leavestudent" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('leavestudent'); ?></span>
                  </div>



                  </div>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <!-- Horizontal Form -->
                  <div class="box box-primary">
                  <div class="box-header with-border">
                  <h3 class="box-title">Assign to Programmes(Multi Selection)</h3>
                  </div>
                  <div class="box-body">

                  </div>
                  <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                  </div>
                  </form>
                  </div>
                  </div>


                  <!--/.col (right) -->
                  <!-- left column -->
                  <?php //} ?>
                  <div class="col-md-<?php
                  if ($this->rbac->hasPrivilege('programee', 'can_add')) {
                  echo "12";
                  } else {
                  echo "12";
                  }
                  ?>">
                  <!-- general form elements -->
                  <div class="box box-primary">
                  <div class="box-header ptbnull">
                  <h3 class="box-title titlefix"> <?php echo $this->lang->line('semester') ; ?></h3>
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

                  <!-- <th><?php echo $this->lang->line('semester_no'); ?>
                  </th>         -->

                  <th><?php echo $this->lang->line('from'); ?>
                  </th>
                  <th><?php echo $this->lang->line('to'); ?>
                  </th>   

                  <th><?php echo $this->lang->line('working').'&nbsp;'.$this->lang->line('days'); ?>
                  </th>

                  <th><?php echo $this->lang->line('learning').'&nbsp;'.$this->lang->line('days'); ?>
                  </th> 

                  <th><?php echo $this->lang->line('holiday'); ?>
                  </th> 

                  <th><?php echo $this->lang->line('class').''. $this->lang->line('leave'); ?>
                  </th>

                  <th><?php echo $this->lang->line('leave').''.$this->lang->line('staff'); ?> </th> 
                  <th><?php echo $this->lang->line('leave').''.$this->lang->line('student'); ?></th> 

                  
                   <th><?php echo $this->lang->line('status'); ?></th>
                  <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                  </tr>
                  </thead>
                  <tbody>


                  <?php
                  $slno=1;          
                  foreach($get_semester_duration as $bt_sem)
                  {
                  ?>
                  <tr>
                  <td><?php echo $slno; ?></td>          
                  <td><?php  echo $bt_sem['batch_group_name'].'&nbsp;'.$bt_sem['batch_group_year']; ?></td>
                  <td><?php  echo $bt_sem['st_name']; ?></td>
                  <!-- <td><?php  echo $bt_sem['bchsem_count']; ?></td> -->
                  <td><?php  echo $bt_sem['bchsem_from']; ?></td>
                  <td><?php  echo $bt_sem['bchsem_to']; ?></td> 
                  <td><?php  echo $bt_sem['bchsem_workingdays']; ?></td>
                  <td><?php  echo $bt_sem['bchsem_learningdays']; ?></td>
                  <td><?php  echo $bt_sem['bchsem_holidays']; ?></td>
                  <td><?php  echo $bt_sem['bchsem_classleave']; ?></td>
                  <td><?php  echo $bt_sem['bchsem_leavestaff']; ?></td>
                  <td><?php  echo $bt_sem['bchsem_leavestudent']; ?></td>

                  <td>
                  <div class="material-switch switchcheck">
                  <input id="is_status_<?php echo $bt_sem['bchsem_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($bt_sem['b_status'] == 1 ? 'checked' : ''); ?> onchange="updatesemStatus(<?php echo $bt_sem['bchsem_id']; ?>, this.checked)">
                  <label for="is_status_<?php echo $bt_sem['bchsem_id']; ?>" class="label-success"></label>
                  </div>
                  </td>

                  <td text-align="right">
                  <a data-placement="left" href="<?php echo site_url('semester/batchsemester/edit/' . $bt_sem['bchsem_id']); ?>" class="btn btn-default btn-xs edit-btn-sem"  data-id="<?php echo $bt_sem['bchsem_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                  <a data-placement="left" href="<?php echo site_url('semester/batchsemester/delete/' . $bt_sem['bchsem_id']); ?>"    class="btn btn-default btn-xs del-btn_sem" data-id="<?php echo $bt_sem['bchsem_id']; ?>"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash  trashstyle" style="color:#cb1515;"></i></a>                        
                  <a href="#" class="btn btn-default btn-xs" onclick="openSemesterModal()" title="Add Semester"><i class="fa fa-plus"></i></a>
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
                  </p>
                  </div>



                  <!--Semester Closed-->

                  <!--Seat Capacity-->



                  <div id="Seat_Capacity" class="tabcontent">
                  <h3></h3>
                  <p>
                  <div class="row">

                  <?php
                  // if ($this->rbac->hasPrivilege('programee', 'can_add')) {
                  ?>
                  <div class="col-md-4">
                  <!-- Horizontal Form -->
                  <div class="box box-primary">
                  <div class="box-header with-border">
                  <h3 class="box-title"> <?php echo $this->lang->line('seat').'&nbsp;&nbsp;'.$this->lang->line('capacity'); ?></h3>
                  </div>


                  <form id="form4" class="ajax-form" action="<?php echo site_url('semester/Seatcapacityduration/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">


                  <div class="box-body">
                  <input type="hidden" name="seatcapacity_duration" id="seatcapacity_duration" class="form-control"/>
                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('faculty'); ?><small class="req"> *</small></label>
                  <select name="facultycapacity" id="facultycapacity" class="form-control">
                  <option value="">Select Faculty</option>
                  <?php
                  foreach($facultylist as $fac)
                  {
                  ?>
                  <option value="<?php echo $fac['id']; ?>">
                  <?php
                  if(set_value('facultycapacity')==$fac['id'])
                  {
                  echo "selected=selected" ;  
                  }
                  echo  $fac['faculty_name'];
                  ?>
                  </option>
                  <?php } ?>
                  </select>
                  <span class="text-danger"><?php echo form_error('facultycapacity'); ?></span>
                  </div>




                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('batch'); ?><small class="req"> *</small></label>
                  <select name="batch_capacitytype" id="batch_capacitytype" class="form-control" >
                  <option value=""><?php echo $this->lang->line('batch_type'); ?></option>             
                  <?php 
                  foreach($batchlist as $bt)
                  {
                  ?>
                  <option value="<?php  echo $bt['batch_group_id'];?>"
                  <?php
                  if(set_value('batch_capacitytype')==$bt['batch_group_id'])

                  echo "selected=selected"; 

                  ?>>
                  <?php echo $bt['batch_group_name'].'&nbsp;'.$bt['batch_group_year']; ?>
                  </option>
                  <?php } ?>
                  </select>
                  <span class="text-danger"><?php echo form_error('batch_capacitytype'); ?></span>
                  </div>


                  <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $this->lang->line('seat').'&nbsp;'.$this->lang->line('capacity'); ?><small class="req"> *</small></label>
                  <input type="text" name="se_seatcapacity" id="se_seatcapacity" class="form-control"/>
                  <span class="text-danger"><?php echo form_error('se_seatcapacity'); ?></span>
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
                  if ($this->rbac->hasPrivilege('programee', 'can_add')) {
                  echo "8";
                  } else {
                  echo "12";
                  }
                  ?>">
                  <!-- general form elements -->
                  <div class="box box-primary">
                  <div class="box-header ptbnull">
                  <h3 class="box-title titlefix"> <?php echo $this->lang->line('seat').'&nbsp;'.$this->lang->line('capacity'); ?></h3>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body">

                  <div class="table-responsive mailbox-messages">
                  <table class="table table-striped table-bordered table-hover example">
                  <thead>
                  <tr>
                  <th><?php echo $this->lang->line('slno'); ?>  </th>
                  <th><?php echo $this->lang->line('faculty'); ?></th>
                  <th><?php echo $this->lang->line('batch'); ?></th>
                  <th><?php echo $this->lang->line('seat'); ?> </th>
                  <th><?php echo $this->lang->line('status'); ?></th>
                  <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $sl=1;
                  foreach($get_seatcapacity as $seat)
                  {
                  ?>
                  <tr>
                  <td><?php  echo $sl; ?></td>
                  <td><?php  echo $seat['faculty_code'].'&nbsp;-&nbsp;'.$seat['faculty_name']; ?></td>
                  <td><?php  echo $seat['batch_group_name'].'&nbsp-&nbsp;'.$seat['batch_group_year']; ?></td>
                  <td><?php  echo $seat['seatcapacity']; ?></td>
                  <td>
                  <div class="material-switch switchcheck">
                  <input id="is_status_<?php echo $seat['id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($seat['status'] == 1 ? 'checked' : ''); ?> onchange="updateseatcapStatus(<?php echo $seat['id']; ?>, this.checked)">
                  <label for="is_status_<?php echo $seat['id']; ?>" class="label-success"></label>
                  </div>
                  </td>

                  <td text-align="right">
                  <a data-placement="left"  class="btn btn-default btn-xs edit-btn_seatcap" data-id="<?php echo $seat['id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                  <i class="fa fa-pencil"></i>
                  <a data-placement="left"   class="btn btn-default btn-xs del-btn_seatcap fontdelcol"  data-id="<?php echo $seat['id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                  <i class="fa fa-trash trashstyle"></i>
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
                  </p>
                  </div>            
                  </section>


                  <div id="semesterModal" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                  <form id="semesterForm" method="post" action="<?php echo site_url('semester/batchsemester/add_multiple'); ?>">
                  <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title">Add Semester Details</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  ×
                  </button>
                  </div>
                  <div class="modal-body">
                  <table class="table table-bordered" id="semesterTable">
                  <thead>
                  <tr>
                  <th>Semester No</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Capacity</th>
                  <th>Remove</th>
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



                  </div><!-- /.content-wrapper -->


                  <style>
                  .tabcontent {
                  display: none;
                  }
                  .tablinks.active {
                  font-weight: bold;
                  }
                  </style>


                  <script src="<?php  echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script> 

                  <script>
                  $(document).ready(function()
                  {
                  // $('.ajax-form').on('submit', function(e) {
                  // e.preventDefault();

                  // var form = $(this);
                  // var formId = form.attr('id'); // store which form
                  // var activeTabBtn = document.querySelector('.tablinks.active');

                  // if(activeTabBtn) {
                  // var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                  // localStorage.setItem('activeTab', currentTab);
                  // }
                  // localStorage.setItem('activeForm', formId);

                  // $.ajax({
                  // url: form.attr('action'),
                  // type: 'POST',
                  // data: form.serialize(),
                  // success: function(response) {
                  // alert("Saved Successfully!");
                  // location.reload(); // refresh page
                  // },
                  // error: function() {
                  // alert("Failed.");
                  // }
                  // });
                  // });



                  $('#sem_program_type').change(function()
                  {                 
                  var prog_type_id = $(this).val();
                  if(prog_type_id != ''){
                  $.ajax({
                  url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
                  method: "POST",
                  data: { prog_type_id: prog_type_id },
                  dataType: "json",
                  success: function(data){

                  $('#sem_programe').empty();
                  $('#sem_programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                  $.each(data, function(key, value){
                  $('#sem_programe').append('<option value="'+ value.id +'">'+ value.p_name +'</option>');
                  });
                  }
                  });
                  } else {
                  $('#sem_programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                  }
                  });
                  });




                  $(document).ready(function () {

                  $('.edit-btn').click(function (e) {                      
                  e.preventDefault();
                  let id = $(this).data('id');

                  $.ajax({
                  url: "<?php echo site_url('semester/setduration/get_duration_by_id/'); ?>" + id,
                  type: "GET",
                  dataType: "json",
                  success: function (data) 
                  {

                  $('#program_id').val(data.duration_id);

                  $('#program_type').empty();
                  $('#program_type').append('<option value="' + data.prog_type_id + '">' + data.prog_type_name + '</option>');


                  <?php foreach($Programmetype_list as $prog_type): ?>
                  $('#program_type').append('<option value="<?php echo $prog_type['prog_type_id']; ?>"><?php echo $prog_type['prog_type_name']; ?></option>');
                  <?php endforeach; ?> 


                  $('#programe').empty();
                  $('#programe').append('<option value="' + data.id + '">' + data.p_name + '</option>'); 


                  $('#date_from').val(data.date_from);
                  $('#date_to').val(data.date_to);
                  $('#No_of_Semester').val(data.no_of_semester);
                  $('#No_of_Months').val(data.no_of_months);
                  $('#No_of_Days').val(data.no_of_days); 
                  if (data.duration_id) {
                  $('.prog-info').text('Update');
                  }

                  document.getElementById("form1").scrollIntoView({ behavior: 'smooth' });
                  },
                  error: function () {
                  alert("Error loading record.");
                  }
                  });
                  });                  




                  $('.edit-btn-batch').click(function (e)
                  {                   
                  e.preventDefault();
                  let id = $(this).data('id'); 
                  $.ajax({
                  url: "<?php echo site_url('semester/batchduration/get_batchduration_by_id/'); ?>" + id,
                  type: "GET",
                  dataType: "json", 
                  success: function (data)
                  {                               
                  editBatchData = data; 
                                   
                  $('#progm_id').val(data.program).trigger('change');
                  $('#batch_type').val(data.b_id).trigger('change');                 

                  $('#batch_duration_id').val(data.batch_duration_id);
                  // $('#sem_batch_type').val(data.b_id).trigger('change');           

                  // Batch Type
                  // $('#sem_batch_type').empty();
                  // $('#sem_batch_type').append('<option value="' + data.batch_group_id + '">' + data.batch_group_name + '</option>');
                  // <?php foreach($batch_group as $batch): ?>
                  // $('#sem_batch_type').append('<option value="<?php echo $batch['batch_group_id']; ?>"><?php echo $batch['batch_group_name'].' '.$batch['batch_group_year']; ?></option>');
                  // <?php endforeach; ?>
                  // $('#sem_batch_type').val(data.batch_group_id);

                  // Program Type

                  // $('#sem_program_type').empty();
                  // $('#sem_program_type').append('<option value="' + data.prog_type_id + '">' + data.prog_type_name + '</option>');
                  // <?php foreach($Programmetype_list as $prog_type): ?>
                  // $('#sem_program_type').append('<option value="<?php echo $prog_type['prog_type_id']; ?>"><?php echo $prog_type['prog_type_name']; ?></option>');
                  // <?php endforeach; ?>
                  // $('#sem_program_type').val(data.prog_type_id);

                  // // Program
                  $('#sem_programe').empty();
                  $('#sem_programe').append('<option value="' + data.id + '">' + data.p_name + '</option>');
                  $('#sem_programe').val(data.id);

                  // Dates
                  $('#bt_from_date').val(data.fromdate);
                  $('#bt_to_date').val(data.todate);

                  if (data.batch_duration_id) {
                  $('.batch-info').text('Update');
                  }

                  document.getElementById("form2").scrollIntoView({ behavior: 'smooth' });

                  },
                  error: function () {
                  alert("Error loading record.");
                  }
                  });
                  });



                  $('.edit-btn-sem').click(function (e) 
                  { 
                  e.preventDefault();
                  let id = $(this).data('id');

                  $.ajax({
                  url: "<?php echo site_url('semester/set_semesterduration/get_semduration_by_id/'); ?>" + id,
                  type: "GET",
                  dataType: "json",
                  success: function (data) 
                  {


                  editSemesterData       = data;

                  $('#editSemesterModal #prog_id').val(data.b_program).trigger('change');
                  $('#editSem_batch #sem_batch_type').val(data.b_id).trigger('change');

                  // $('#sem_batch_type').val(data.b_id).trigger('change');

                  //  $('#batch_type').val(data.b_id).trigger('change'); 
                  
                  $('#semesterduration_id').val(data.bchsem_id);  
                  $('#semester_semtype').empty();
                  $('#semester_semtype').append('<option value="' + data.st_id + '">' + data.st_name + '</option>');

                  <?php foreach($semestertype_list as $sem_type): ?>
                  $('#semester_semtype').append('<option value="<?php echo $sem_type['st_id']; ?>"><?php echo $sem_type['st_name']; ?></option>');
                  <?php endforeach; ?>


                  $('#semester_term').empty();
                  $('#semester_term').append('<option value="' + data.stm_id + '">' + data.stm_name + '</option>');

                  <?php foreach($semester_term as $term): ?>
                  $('#semester_term').append('<option value="<?php echo $term['stm_id']; ?>"><?php echo $term['stm_name']; ?></option>');
                  <?php endforeach; ?>  

                  $('#batch_semtype').empty();
                  $('#batch_semtype').append('<option value="' + data.st_id + '">' + data.st_name + '</option>');

                  <?php foreach($batchlist as $bt): ?>
                  $('#batch_semtype').append('<option value="<?php echo $bt['batch_group_id']; ?>"><?php echo $bt['batch_group_name']; ?></option>');
                  <?php endforeach; ?>

                  $('#semester_no').val(data.bchsem_count);
                  $('#from_semdate').val(data.bchsem_from);
                  $('#to_semdate').val(data.bchsem_to);
                  $('#workingdays').val(data.bchsem_workingdays);
                  $('#learningdays').val(data.bchsem_learningdays);
                  $('#holidays').val(data.bchsem_holidays);
                  $('#classleave').val(data.bchsem_classleave);  
                  $('#leavestaff').val(data.bchsem_leavestaff);  
                  $('#leavestudent').val(data.bchsem_leavestudent); 
                  document.getElementById("form3").scrollIntoView({ behavior: 'smooth' }); 
                  },
                  error: function () {
                  alert("Error loading record.");
                  }
                  });
                  });



                  $('.edit-btn_seatcap').click(function (e)
                  {                        
                  e.preventDefault();
                  let id = $(this).data('id');                 

                  $.ajax({
                  url: "<?php echo site_url('semester/Seatcapacityduration/get_data/'); ?>" + id,            
                  type: "GET",
                  dataType: "json",           
                  success: function (data) 
                  { 

                  $('#seatcapacity_duration').val(data.id);
                  $('#facultycapacity').empty();
                  $('#facultycapacity').append('<option value="' + data.faculty_id + '">' + data.faculty_name + '</option>');

                  <?php foreach($facultylist as $fac): ?>
                  $('#facultycapacity').append('<option value="<?php echo $fac['id']; ?>"><?php echo $fac['faculty_name']; ?></option>');
                  <?php endforeach; ?>              


                  $('#batch_capacitytype').empty();
                  $('#batch_capacitytype').append('<option value="' + data.batch_group_id + '">' + data.batch_group_name + '</option>');

                  <?php foreach($batchlist as $bt): ?>
                  $('#batch_capacitytype').append('<option value="<?php echo $bt['batch_group_id']; ?>"><?php echo $bt['batch_group_name']; ?></option>');
                  <?php endforeach; ?>

                  $('#se_seatcapacity').val(data.seatcapacity); 

                  document.getElementById("form4").scrollIntoView({ behavior: 'smooth' });
                  },
                  error: function () {
                  alert("Error loading record.");
                  }
                  });
                  });
                  });

                  </script>

                  <script>

                  function updatebatchStatus(id, status) 
                  {               
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "<?php echo site_url('semester/batchduration/update_status'); ?>", true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function () {
                  if (xhr.readyState == 4 && xhr.status == 200)
                  {
                  }
                  };
                  xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
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


                  function updateStatus(Id, status) 
                  { 
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "<?php echo site_url('semester/setduration/update_status'); ?>", true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function () {
                  if (xhr.readyState == 4 && xhr.status == 200) {
                  console.log('Status updated successfully');
                  }
                  };
                  xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
                  }


                  $(document).ready(function (e) 
                  {

                  $("#form51").on('submit', (function (e) {                
                  e.preventDefault();
                  $.ajax({
                  url: "<?php echo site_url("semester/setduration/") ?>",
                  type: "POST",
                  data: new FormData(this),
                  dataType: 'json',
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function (data)
                  {
                  if (data.status == "fail") {
                  var message = "";
                  $.each(data.error, function (index, value) {

                  message += value;
                  });
                  errorMsg(message);
                  } 
                  else 
                  {
                  successMsg(data.message);
                  }
                  }
                  });
                  }));           
                  });


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
                  <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="fa fa-trash trashstyle"></i></button></td>
                  </tr>
                  `;
                  $('#semesterTable tbody').append(rowHtml);
                  }

                  function removeRow(button) {
                  $(button).closest('tr').remove();
                  }

                  function updatesemStatus(id, status) 
                  {        
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "<?php echo site_url('semester/set_semesterduration/update_status'); ?>", true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function () {
                  if (xhr.readyState == 4 && xhr.status == 200) {
                  console.log('Status updated successfully');
                  }
                  };
                  xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
                  }
                  </script>  


                  <script>           

                  function set_tab(evt, cityName) 
                  {

                  var i, tabcontent, tablinks;
                  tabcontent = document.getElementsByClassName("tabcontent");
                  for (i = 0; i < tabcontent.length; i++) {
                  tabcontent[i].style.display = "none";
                  }
                  tablinks = document.getElementsByClassName("tablinks");
                  for (i = 0; i < tablinks.length; i++) {
                  tablinks[i].className = tablinks[i].className.replace(" active", "");
                  }
                  document.getElementById(cityName).style.display = "block";
                  evt.currentTarget.className += " active";
                  }

                  // Automatically open the first tab on page load
                  // window.onload = function () 
                  // {
                  // const firstTab = document.getElementsByClassName("tablinks")[0];
                  // const firstTabId = firstTab.getAttribute("onclick").match(/'(.*?)'/)[1];
                  // set_tab({ currentTarget: firstTab }, firstTabId);
                  // };
                  </script>


                  <script>

                  // $(document).ready(function() 
                  // { 
                  // $('.del-btn').click(function(e) 
                  // {  

                  // var id = $(this).data('id');             

                  // e.preventDefault();               
                  // $.ajax({
                  // url: '<?php echo base_url(); ?>semester/setduration/delete/' + id,
                  // type: 'GET',
                  // dataType: 'json',
                  // success: function(response) 
                  // {
                  // if (response.success) {
                  // $('#Programee').tab('show');
                  // } 
                  // else
                  // {
                  // }
                  // },
                  // error: function(xhr, status, error) {
                  // // Handle error
                  // console.error(error);
                  // }
                  // });
                  // });
                  // });



                  $('.del-btn').click(function(e) {
                  e.preventDefault();
                  if(!confirm("Do you want to delete?")) return;
                  var id = $(this).data('id');

                  // Save current tab
                  var activeTabBtn = document.querySelector('.tablinks.active');
                  if(activeTabBtn) {
                  var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                  localStorage.setItem('activeTab', currentTab);
                  }

                  $.ajax({
                  url: '<?php echo base_url(); ?>semester/setduration/delete/' + id,
                  type: 'GET',
                  dataType: 'json',
                  success: function(response) {

                  if(response.success) {
                  alert("Deleted Successfully!");
                  location.reload(); // refresh page, stay on saved tab
                  document.getElementById("form1").scrollIntoView({ behavior: 'smooth' });
                  } else {
                  alert("Failed to delete.");
                  }
                  },
                  error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Error deleting record.");
                  }
                  });
                  });





                  $('.del-btn-bat').click(function(e) {

                  e.preventDefault();
                  if(!confirm("Do you want to delete?")) return;
                  var id = $(this).data('id');

                  // Save current tab
                  var activeTabBtn = document.querySelector('.tablinks.active');
                  if(activeTabBtn) {
                  var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                  localStorage.setItem('activeTab', currentTab);
                  }

                  $.ajax({
                  url: '<?php echo base_url(); ?>semester/batchduration/delete/' + id,
                  type: 'GET',
                  dataType: 'json',
                  success: function(response) {


                  if(response.success) {
                  alert("Deleted Successfully!");
                  location.reload(); // refresh page, stay on saved tab
                  document.getElementById("form1").scrollIntoView({ behavior: 'smooth' });
                  } else {
                  alert("Failed to delete.");
                  }
                  },
                  error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Error deleting record.");
                  }
                  });
                  });



                  // $(document).ready(function (e) 
                  // {
                  // $('.del-btn-bat').click(function(e) 
                  // {
                  // if (confirm("Do you want to delete?"))
                  // {
                  // e.preventDefault();
                  // var id = $(this).data('id');
                  // alert(id)
                  // $.ajax({
                  // url: '<?php echo base_url(); ?>semester/batchduration/delete/' + id,
                  // type: 'GET',
                  // dataType: 'json',
                  // success: function(response) 
                  // {
                  // if (response.success) 
                  // {
                  // $('#batch').tab('show');
                  // } 
                  // else
                  // {
                  // }
                  // },
                  // error: function(xhr, status, error) {
                  // // Handle error
                  // console.error(error);
                  // }

                  // });
                  // }
                  // });           
                  // });  



                  $('.del-btn_seatcap').click(function(e) {
                  e.preventDefault();
                  if(!confirm("Do you want to delete?")) return;

                  var id = $(this).data('id');

                  // Save current tab
                  var activeTabBtn = document.querySelector('.tablinks.active');
                  if(activeTabBtn) {
                  var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                  localStorage.setItem('activeTab', currentTab);
                  }

                  $.ajax({
                  url: '<?php echo base_url(); ?>semester/seatcapduration/remove/' + id,
                  type: 'GET',
                  dataType: 'json',
                  success: function(response) 
                  {   

                  if(response.success) 
                  {
                  alert("Deleted Successfully!");
                  location.reload(); // refresh page, stay on saved tab
                  document.getElementById("form4").scrollIntoView({ behavior: 'smooth' });
                  } 
                  else
                     {
                  alert("Failed to delete.");
                  }
                  },
                  error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Error deleting record.");
                  }
                  });
                  });




                  $('.del-btn_sem').click(function(e) 
                  {
                  if (confirm("Do you want to delete?"))
                  {
                  e.preventDefault();
                  var id = $(this).data('id');
                  alert(id);
                  $.ajax({
                  url: '<?php echo base_url(); ?>semester/set_semesterduration/delete/' + id,
                  type: 'GET',
                  dataType: 'json',
                  success: function(response) 
                  {
                  if (response.status) 
                  {
                  location.reload();
                  } 
                  else
                  {
                  }
                  },
                  error: function(xhr, status, error) {
                  // Handle error
                  console.error(error);
                  }
                  });
                  }
                  });




                  /*
                  $('.edit-btn_seatcap').click(function(e) 
                  { 

                  e.preventDefault();
                  var id = $(this).data('id'); 
                  $.ajax({
                  url: '<?php echo base_url(); ?>semester/seatcapduration/get_data/' + id,
                  type: 'GET',
                  dataType: 'json',
                  success: function(response) 
                  {

                  $('#se_faculty').empty();
                  $('#se_faculty').append('<option value="' + response.id + '">' + response.faculty_name + '</option>');
                  <?php foreach($facultlist as $faculty): ?>
                  $('#se_faculty').append('<option value="<?php echo $faculty['id']; ?>"><?php echo $faculty['faculty_name']; ?></option>');
                  <?php endforeach; ?> 


                  $('#se_batch').empty();
                  $('#se_batch').append('<option value="' + response.id + '">' + response.b_name + '</option>');
                  <?php foreach($batchlist as $batch): ?>
                  $('#se_batch').append('<option value="<?php echo $batch['id']; ?>"><?php echo $batch['b_name']; ?></option>');
                  <?php endforeach; ?>

                  $('#se_seatcapacity').val(response.seatcapacity || '');
                  },
                  error: function(xhr, status, error) {
                  // Handle error
                  console.error(error);
                  }
                  });
                  });


                  });
                  */
                 

                  function updateseatcapStatus(Id, status) 
                  {   
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "<?php echo site_url('semester/seatcapduration/update_status'); ?>", true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onreadystatechange = function () {
                  if (xhr.readyState == 4 && xhr.status == 200)
                  {
                  }
                  };
                  xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
                  }


                  $(document).ready(function() 
                  {
                  // Generic form submit handler for all forms
                  // $('.ajax-form').on('submit', function(e) {
                  // e.preventDefault();

                  // var form = $(this);
                  // var formId = form.attr('id'); // store which form
                  // var activeTabBtn = document.querySelector('.tablinks.active');

                  // if(activeTabBtn) {
                  // var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                  // localStorage.setItem('activeTab', currentTab);
                  // }

                  // localStorage.setItem('activeForm', formId);

                  // $.ajax({
                  // url: form.attr('action'),
                  // type: 'POST',
                  // data: form.serialize(),
                  // success: function(response) {
                  // alert("Saved Successfully!");
                  // location.reload(); // refresh page
                  // },
                  // error: function() {
                  // alert("Failed.");
                  // }
                  // });
                  // });




                        // $('.ajax-form').on('submit', function(e) {
                        // if (this.id !== 'form2') {
                        // e.preventDefault();
                        // var form = $(this);
                        // var formId = form.attr('id');
                        // var activeTabBtn = document.querySelector('.tablinks.active');
                        // if (activeTabBtn) {
                        // var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                        // localStorage.setItem('activeTab', currentTab);
                        // }
                        // localStorage.setItem('activeForm', formId);

                        // $.ajax({
                        // url: form.attr('action'),
                        // type: 'POST',
                        // data: form.serialize(),
                        // success: function(response) {
                        // alert("Saved Successfully!");
                        // location.reload();
                        // },
                        // error: function() {
                        // alert("Failed.");
                        // }
                        // });
                        // }
                        // // else: allow normal submit for form2
                        // });



                        // Forms that should SUBMIT NORMALLY (no AJAX), but preserve active tab


const normalForms = ['form2', 'form3', 'form4'];

$('.ajax-form').on('submit', function(e) {
  if (!normalForms.includes(this.id))
   {
    e.preventDefault();
    var form = $(this);
    var formId = this.id;

    var activeTabBtn = document.querySelector('.tablinks.active');
    if (activeTabBtn) {
      var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
      localStorage.setItem('activeTab', currentTab);
    }
    localStorage.setItem('activeForm', formId);

    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: form.serialize(),
      success: function(response) {
        alert("Saved Successfully!");
        location.reload();
      },
      error: function() {
        alert("Failed.");
      }
    });
  }
  // else: allow normal submit for form2, form3, form4
});



// Preserve active tab on normal submit for 2/3/4
$('#form2, #form3, #form4').on('submit', function() {
  var activeTabBtn = document.querySelector('.tablinks.active');
  if (activeTabBtn) {
    var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
    localStorage.setItem('activeTab', currentTab);
  }
  localStorage.setItem('activeForm', this.id);
});


//                         $('#form2').on('submit', function() {
//   var activeTabBtn = document.querySelector('.tablinks.active');
//   if (activeTabBtn) {
//     var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
//     localStorage.setItem('activeTab', currentTab);
//   }
//   localStorage.setItem('activeForm', this.id);
//   // no preventDefault: allow normal submit
// });



                  $('#form3').on('submit', function() {
                    var activeTabBtn = document.querySelector('.tablinks.active');
                    if (activeTabBtn) {
                      var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
                      localStorage.setItem('activeTab', currentTab);
                    }
                    localStorage.setItem('activeForm', this.id);
                  });



                  // Restore tab and scroll to form after page reload
                  (function restoreTabAndForm() {
                  var activeTab = localStorage.getItem('activeTab');
                  var activeForm = localStorage.getItem('activeForm');

                  if(activeTab) {
                  // Find tab button matching saved tab
                  var tabs = document.getElementsByClassName("tablinks");
                  for(var i=0; i<tabs.length; i++) {
                  var tabId = tabs[i].getAttribute('onclick').match(/'(.*?)'/)[1];
                  if(tabId === activeTab) {
                  set_tab({ currentTarget: tabs[i] }, activeTab); // open saved tab
                  break;
                  }
                  }
                  } else {
                  // Default: first tab only if no tab saved
                  var firstTab = document.getElementsByClassName("tablinks")[0];
                  if(firstTab) {
                  var firstTabId = firstTab.getAttribute('onclick').match(/'(.*?)'/)[1];
                  set_tab({ currentTarget: firstTab }, firstTabId);
                  }
                  }

                  // Scroll to the form submitted
                  if(activeForm) {
                  var formElement = document.getElementById(activeForm);
                  if(formElement) {
                  formElement.scrollIntoView({ behavior: 'smooth' });
                  }
                  }

                  // Cleanup
                  localStorage.removeItem('activeTab');
                  localStorage.removeItem('activeForm');
                  })();
                  });


                    //Reset Button

                    document.getElementById('resetBtn').addEventListener('click', function() {
                    // Reset the form
                    document.getElementById('form1').reset();

                    // Change button text back to Save
                    $('.prog-info').text('<?php echo $this->lang->line("save"); ?>');

                    // Reset the program_id to ensure it's treated as a new entry
                    $('#program_id').val('');

                    // Switch to the first tab
                    $('a[href="#tab_1"]').tab('show');

                    // Optional: Reset any select2 elements if you're using them
                    if ($.fn.select2) {
                    $('.select2').val('').trigger('change');
                    }
                    });                    

                     //Reset Button

                    // document.getElementById('batch-resetBtn').addEventListener('click', function() {
                    // // Reset the form
                    // document.getElementById('form2').reset();

                    // // Change button text back to Save
                    // $('.batch-info').text('<?php echo $this->lang->line("save"); ?>');

                    // // Reset the program_id to ensure it's treated as a new entry
                    // $('#batch_duration_id').val('');

                    // // Switch to the first tab
                    // $('a[href="#tab_1"]').tab('show');

                    // // Optional: Reset any select2 elements if you're using them
                    // if ($.fn.select2) {
                    // $('.select2').val('').trigger('change');
                    // }
                    // });


                      // Add this inside your document.ready function


                      $('#batch-resetBtn').on('click', function() {
                      // Reset the form
                      var form = document.getElementById('form2');
                      if (form) {
                      form.reset();
                      }

                      // Clear any hidden fields
                      $('#batch_duration_id').val('');

                      // Reset select2 dropdowns if they exist
                      if ($.fn.select2) {
                      $('select', form).each(function() {
                      $(this).val('').trigger('change');
                      });
                      }

                      // Reset date fields
                      $('#bt_from_date').val('');
                      $('#bt_to_date').val('');

                      // Reset button text
                      $('.batch-info').text('<?php echo $this->lang->line("save"); ?>');

                      // Switch to first tab
                      $('a[href="#tab_1"]').tab('show');

                      // Clear any validation errors
                      $('.text-danger').text('');
                      });





                $(document).on('change', '#prog_id', function () 
                {

    const program_id = $(this).val();
    const $select = $('#sem_batch_type');

    if (!program_id) {
        $select.html('<option value="">-- Select Batch --</option>');
        return;
    }

    $select.prop('disabled', true)
           .html('<option value="">Loading...</option>');

    $.post(
        "<?php echo site_url('semester/assignsubjects/get_batchtype'); ?>",
        { program_id: program_id },
        function (data) {

            let html = '<option value="">-- Select Batch --</option>';
            let currentMode = '';

            if (data && data.length > 0) {

                data.forEach(row => {

                    if (row.b_mode_name !== currentMode) {
                        if (currentMode !== '') html += '</optgroup>';
                        currentMode = row.b_mode_name || 'Others';
                        html += `<optgroup label="${currentMode}">`;
                    }

                    html += `
                        <option value="${row.b_id}">
                            ${row.batch_group_name}
                        </option>
                    `;
                });

                html += '</optgroup>';

            } 
            else 
            {
            html += '<option value="">No batch found</option>';
            }

            $select.html(html).prop('disabled', false);

         
            if (typeof editSemesterData !== 'undefined' &&
                editSemesterData &&
                editSemesterData.b_id) 
                {
                $select.val(editSemesterData.b_id).trigger('change');
            }

        },
        'json'
    );
});

</script>






