               <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
               <style>
               /* .tab {
               overflow: hidden;
               border: 1px solid #ccc;
               background-color: #f1f1f1;
               }


               .tab button {
               background-color: inherit;
               float: left;
               border: none;
               outline: none;
               cursor: pointer;
               padding: 14px 80px;
               transition: 0.3s;
               border-radius: 0px 2px 0px 0px;
               border:2px solid #e9e9e9;
               font-size:20px;
               }


               .tab button:hover {
               background-color: #ddd;
               }


               .tab button.active {
               background-color: #ccc;
               }


               .tabcontent {
               display: none;
               padding: 6px 12px;
               border: 1px solid #ccc;
               border-top: none;
               } */



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
               .tab button {
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

               
            
               <div class="">
               <div class="col-md-12">
               <div class="box box-primary">
               <!-- <div class="box-header with-border">
               </div> -->


               
               <div class="box-body">
               <div class="tab">
               <button class="tablinks" data-toggle="tab" onclick="set_tab(event, 'building')">Building</button>
               <button class="tablinks" onclick="set_tab(event, 'floor')">Floor</button>
               <button class="tablinks" onclick="set_tab(event, 'seating_type')"><?php echo $this->lang->line('seat_type'); ?> </button>
               <button class="tablinks" onclick="set_tab(event, 'class_room_type')">Class Room Type</button>
               <button class="tablinks" onclick="set_tab(event, 'set_capacity')">Set </button>
               <!-- <button class="tablinks" onclick="set_tab(event, 'set_hall')">Set Hall </button> -->

               </div>


               <p> 
               <!---------------------------------Building Block---------------------------------------------------------------------------->

               <div id="building" class="tabcontent">
               <div class="row">
               <div class="col-md-4">
               <!-- Horizontal Form -->
               <div class="box box-primary">
               <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('building'); ?></h3>
               </div>


               <form id="form1" class="ajax-form" action="<?php echo site_url("semester/Set_room_allocation/") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

               <div class="box-body">                                          

               <input id="building_id" name="building_id"  placeholder="Building Id" type="hidden" value="" class="form-control" />  

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('building').'&nbsp;'.$this->lang->line('name'); ?><small class="req"> *</small></label>
               <input type="text" name="building_name" id="building_name" class="form-control"/>
               <span class="text-danger"><?php echo form_error('building_name'); ?></span>
               </div>   



               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
               <textarea name="building_description" class="form-control" id="building_description"></textarea>
               <span class="text-danger"><?php echo form_error('building_description'); ?></span>
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
               if ($this->rbac->hasPrivilege('building', 'can_add')) {
               echo "8";
               } else {
               echo "12";
               }
               ?>">
               <!-- general form elements -->
               <div class="box box-primary">
               <div class="box-header ptbnull">
               <h3 class="box-title titlefix"><?php echo $this->lang->line('list').'&nbsp;'.$this->lang->line('building'); ?></h3>
               <div class="box-tools pull-right">
               </div><!-- /.box-tools -->
               </div><!-- /.box-header -->
               <div class="box-body">

               <div class="table-responsive mailbox-messages" >
               <table class="table table-striped table-bordered table-hover example" >
               <thead>
               <tr>
               <th><?php echo $this->lang->line('slno'); ?></th>
               <th><?php echo $this->lang->line('building'); ?></th>   
               <th><?php echo $this->lang->line('description'); ?></th>           
               <th><?php echo $this->lang->line('status'); ?></th>
               <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
               </tr>
               </thead>
               <tbody>
               <?php

               $slno=1;
               foreach($get_building as $building)
               {
               ?>
               <tr>
               <td><?php  echo $slno; ?></td>
               <td><?php  echo $building['build_name']; ?></td>  
               <td><?php  echo $building['build_description']; ?></td> 
               <td>
               <div class="material-switch switchcheck">
               <input id="is_status_<?php echo $building['build_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($building['build_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $building['build_id']; ?>, this.checked)">
               <label for="is_status_<?php echo $building['build_id']; ?>" class="label-success"></label>
               </div>
               </td>
               
               <td text-align="right"> 
               <a data-placement="left"   class="btn btn-default btn-xs edit-btn" data-id="<?php echo $building['build_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
               <i class="fa fa-pencil">
               </i>

               <a data-placement="left"    class="btn btn-default btn-xs del-btn"  data-id="<?php echo $building['build_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
               <i class="fa fa-trash  trashstyle"></i>
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



               <div id="floor" class="tabcontent">
               <div class="row">
               <div class="col-md-4">
               <!-- Horizontal Form -->
               <div class="box box-primary">
               <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('floor'); ?></h3>
               </div>



               <form id="form2" class="ajax-form" action="<?php echo site_url("semester/Set_room_allocation/set_floor") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

               <div class="box-body">                                          

               <input id="floor_id" name="floor_id"  placeholder="Floor Id" type="hidden" value="" class="form-control" />  

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('floor').'&nbsp;'.$this->lang->line('name'); ?><small class="req"> *</small></label>
               <input type="text" name="floor_name" id="floor_name" class="form-control"/>
               <span class="text-danger"><?php echo form_error('floor_name'); ?></span>
               </div>                 

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
               <textarea name="floor_description" class="form-control" id="floor_description"></textarea>
               <span class="text-danger"><?php echo form_error('floor_description'); ?></span>
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
               if ($this->rbac->hasPrivilege('floor', 'can_add')) {
               echo "8";
               } else {
               echo "12";
               }
               ?>">
               <!-- general form elements -->
               <div class="box box-primary">
               <div class="box-header ptbnull">
               <h3 class="box-title titlefix"><?php echo $this->lang->line('list').'&nbsp;'.$this->lang->line('floor'); ?></h3>
               <div class="box-tools pull-right">
               </div><!-- /.box-tools -->
               </div><!-- /.box-header -->
               <div class="box-body">

               <div class="table-responsive mailbox-messages" >
               <table class="table table-striped table-bordered table-hover example" >
               <thead>
               <tr>
               <th><?php echo $this->lang->line('slno'); ?></th>
               <th><?php echo $this->lang->line('floor'); ?></th>   
               <th><?php echo $this->lang->line('description'); ?></th>           
               <th><?php echo $this->lang->line('status'); ?></th>
               <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
               </tr>
               </thead>
               <tbody>
               <?php
               $slno=1;
               foreach($get_floor as $floor)
               {
               ?>
               <tr>
               <td><?php  echo $slno; ?></td>
               <td><?php  echo $floor['floor_name']; ?></td>  
               <td><?php  echo $floor['floor_description']; ?></td>           


               <td>
               <div class="material-switch switchcheck">
               <input id="is_status_<?php echo $floor['floor_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($floor['floor_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_floor(<?php echo $floor['floor_id']; ?>, this.checked)">
               <label for="is_status_<?php echo $floor['floor_id']; ?>" class="label-success"></label>
               </div>
               </td>



               <td text-align="right"> 
               <a data-placement="left"   class="btn btn-default btn-xs edit-btn-floor" data-id="<?php echo $floor['floor_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
               <i class="fa fa-pencil">
               </i>

               <a data-placement="left"    class="btn btn-default btn-xs del-btn-floor"  data-id="<?php echo $floor['floor_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
               <i class="fa fa-trash trashstyle"></i>
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
               <!--------------------------------------- Floor Closed   ------------------------------------------>



               <!--------------------------------------  Room Type Started -------------------------------------->
               <div id="seating_type" class="tabcontent">
               <div class="row">
               <div class="col-md-4">
               <!-- Horizontal Form -->
               <div class="box box-primary">
               <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('seat_type'); ?></h3>
               </div>

               <form id="form3" class="ajax-form" action="<?php echo site_url("semester/Set_room_allocation/set_roomtype") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

               <div class="box-body">                                          

               <input id="roomtype_id" name="roomtype_id"  placeholder="Room Type Id" type="hidden" value="" class="form-control" />  

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
               <input type="text" name="roomtype_name" id="roomtype_name" class="form-control"/>
               <span class="text-danger"><?php echo form_error('roomtype_name'); ?></span>
               </div>                 

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
               <textarea name="roomtype_description" class="form-control" id="roomtype_description"></textarea>
               <span class="text-danger"><?php echo form_error('roomtype_description'); ?></span>
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
               if ($this->rbac->hasPrivilege('room_type', 'can_add')) {
               echo "8";
               } else {
               echo "12";
               }
               ?>">
               <!-- general form elements -->
               <div class="box box-primary">
               <div class="box-header ptbnull">
               <h3 class="box-title titlefix"><?php echo  $this->lang->line('list').'&nbsp;'.$this->lang->line('seat_type'); ?></h3>
               <div class="box-tools pull-right">
               </div><!-- /.box-tools -->
               </div><!-- /.box-header -->
               <div class="box-body">

               <div class="table-responsive mailbox-messages" >
               <table class="table table-striped table-bordered table-hover example" >
               <thead>
               <tr>
               <th><?php echo $this->lang->line('slno'); ?></th>
               <th><?php echo $this->lang->line('name'); ?></th>   
               <th><?php echo $this->lang->line('description'); ?></th>           
               <th><?php echo $this->lang->line('status'); ?></th>
               <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
               </tr>
               </thead>
               <tbody>


               <?php
               $slno=1;
               foreach($get_roomtype as $room_type)
               {
               ?>
               <tr>
               <td><?php  echo $slno; ?></td>
               <td><?php  echo $room_type['roomtype_name']; ?></td>  
               <td><?php  echo $room_type['roomtype_description']; ?></td> 
               <td>
               <div class="material-switch switchcheck">
               <input id="is_status_<?php echo $room_type['roomtype_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($room_type['roomtype_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_floor(<?php echo $room_type['roomtype_id']; ?>, this.checked)">
               <label for="is_status_<?php echo $room_type['roomtype_id']; ?>" class="label-success"></label>
               </div>
               </td>



               <td text-align="right"> 
               <a data-placement="left"   class="btn btn-default btn-xs edit-btn-roomtype" data-id="<?php echo $room_type['roomtype_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
               <i class="fa fa-pencil">
               </i>

               <a data-placement="left"    class="btn btn-default btn-xs del-btn-roomtype"  data-id="<?php echo $room_type['roomtype_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
               <i class="fa fa-trash trashstyle"></i>
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

               <!-------Room Type Closed-------------------------------------------------------------------------->


               <!--------------------------------------  Class Room Type Started --------------------------------------->


               <div id="class_room_type" class="tabcontent">
               <div class="row">
               <div class="col-md-4">
               <!-- Horizontal Form -->
               <div class="box box-primary">
               <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('classroom'); ?></h3>
               </div>
               <form id="form4"  class="ajax-form" action="<?php echo site_url("semester/Set_room_allocation/set_capacitytype") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

               <div class="box-body">                                          

               <input id="classroom_type_id" name="classroom_type_id"  placeholder="Class Room Type Id" type="hidden" value="" class="form-control" />  

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
               <input type="text" name="classroom_type_name" id="classroom_type_name" class="form-control"/>
               <span class="text-danger"><?php echo form_error('classroom_type_name'); ?></span>
               </div>                 

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
               <textarea name="classroom_type_description" class="form-control" id="classroom_type_description"></textarea>
               <span class="text-danger"><?php echo form_error('classroom_type_description'); ?></span>
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
               if ($this->rbac->hasPrivilege('room_type', 'can_add')) {
               echo "8";
               } else {
               echo "12";
               }
               ?>">
               <!-- general form elements -->
               <div class="box box-primary">
               <div class="box-header ptbnull">
               <h3 class="box-title titlefix"><?php echo $this->lang->line('list') .'&nbsp;'.$this->lang->line('classroom'); ?></h3>
               <div class="box-tools pull-right">
               </div><!-- /.box-tools -->
               </div><!-- /.box-header -->
               <div class="box-body">

               <div class="table-responsive mailbox-messages" >
               <table class="table table-striped table-bordered table-hover example" >
               <thead>
               <tr>
               <th><?php echo $this->lang->line('slno'); ?></th>
               <th><?php echo $this->lang->line('name'); ?></th>   
               <th><?php echo $this->lang->line('description'); ?></th>           
               <th><?php echo $this->lang->line('status'); ?></th>
               <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
               </tr>
               </thead>
               <tbody>


               <?php
               $slno=1;
               foreach($get_classroomtypes as $classtypes)
               {
               ?>
               <tr>
               <td><?php  echo $slno; ?></td>
               <td><?php  echo $classtypes['cls_roomtype_name']; ?></td>  
               <td><?php  echo $classtypes['cls_roomtype_description']; ?></td> 
               <td>

               <div class="material-switch switchcheck">
               <input id="is_status_<?php echo $classtypes['cls_roomtype_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($classtypes['cls_roomtype_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_classtype(<?php echo $classtypes['cls_roomtype_id']; ?>, this.checked)">
               <label for="is_status_<?php echo $classtypes['cls_roomtype_id']; ?>" class="label-success"></label>
               </div>
               </td>

               <td text-align="right"> 
               <a data-placement="left"   class="btn btn-default btn-xs edit-btn-classtype" data-id="<?php echo $classtypes['cls_roomtype_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
               <i class="fa fa-pencil">
               </i>

               &nbsp;&nbsp;


               <?php              

               if($classtypes['cls_roomtype_isystem']==0)
               {

               ?>
               <a data-placement="left"    class="btn btn-default btn-xs del-btn-classtype"  data-id="<?php echo $classtypes['cls_roomtype_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">

               <i class="fa fa-trash trashstyle" ></i>
               <?php }
               else 
               { 
               ?>
               <i class="fa fa-lock text-muted" style="cursor:not-allowed;" title="Cannot delete"></i>

               <?php
               } ?> 





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

               <!------------------Class Room Type Closed-------------------------------------------------------------------------->



               <!---------------- Set Capacity Started ---------------------------------------------------------------------------->




               <div id="set_capacity" class="tabcontent">
               <div class="row">
               <div class="col-md-4">
               <!-- Horizontal Form -->
               <div class="box box-primary">

               <div class="box-header with-border">
               <h3 class="box-title">Set Capacity</h3>
               </div>
               
               


               <form id="form5" class="ajax-form" action="<?php echo site_url("semester/Set_room_allocation/set_class_capacity") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

               <div class="box-body"> 
               <input id="cl_cap_id" name="cl_cap_id"  placeholder="Class Room Type Id" type="hidden" value="" class="form-control" /> 
               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('room_no'); ?><small class="req"> *</small></label>
               <input type="text" name="cl_cap_room_number" id="cl_cap_room_number" class="form-control"/>
               <span class="text-danger"><?php echo form_error('cl_cap_room_number'); ?></span>
               </div>


               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('building'); ?><small class="req"> *</small></label> 
               <select name="cl_cap_building" id="cl_cap_building" class="form-control" >
               <option value="">Select Building</option>
               <?php
               foreach($buildinglist as $build)
               {
               ?>
               <option value="<?php echo  $build['build_id']; ?>"<?php if(set_value('cl_cap_building')==$build['build_id']) { echo "selected=selected"; }        ?> ><?php echo  $build['build_name']; ?> </option>
               <?php 
               }
               ?>
               </select> 
               <span class="text-danger"><?php echo form_error('cl_cap_building'); ?></span>
               </div>  


               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('floor'); ?><small class="req"> *</small></label>
               <select name="cl_cap_floor" id="cl_cap_floor" class="form-control" >
               <option value="">Select Floor</option>
               <?php
               foreach($floorlist as $floor)
               {
               ?>
               <option value="<?php echo  $floor['floor_id']; ?>"<?php if(set_value('cl_cap_floor')==$floor['floor_id']) { echo "selected=selected"; }        ?> ><?php echo  $floor['floor_name']; ?> </option>
               <?php 
               }
               ?>a
               </select> 
               <span class="text-danger"><?php echo form_error('cl_cap_floor'); ?></span>
               </div> 


               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('room_type'); ?><small class="req"> *</small></label>            
               <select name="cl_cap_classroom_type" id="cl_cap_classroom_type" class="form-control" >
               <option value=""><?php echo $this->lang->line('room_type'); ?></option>
               <?php
               foreach($classlist as $class)
               {
               ?>
               <option value="<?php echo  $class['cls_roomtype_id']; ?>"<?php if(set_value('cl_cap_classroom_type')==$class['cls_roomtype_id']) { echo "selected=selected"; }  ?> ><?php echo  $class['cls_roomtype_name']; ?> </option>
               <?php 
               }
               ?>
               </select> 
               <span class="text-danger"><?php echo form_error('cl_cap_classroom_type'); ?></span>
               </div> 

               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?><small class="req"> *</small></label>
               <select name="cl_cap_roomtype" id="cl_cap_roomtype" class="form-control" >
               <option value=""><?php echo $this->lang->line('class'); ?></option>
               <?php
               foreach($roomtypelist as $roomtype)
               {
               ?>
               <option value="<?php echo  $roomtype['roomtype_id']; ?>"<?php if(set_value('cl_cap_roomtype_id')==$roomtype['roomtype_id']) { echo "selected=selected"; }        ?> ><?php echo  $roomtype['roomtype_name']; ?> </option>
               <?php 
               }
               ?>
               </select> 
               <span class="text-danger"><?php echo form_error('cl_cap_roomtype'); ?></span>
               </div> 



               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('capacity'); ?><small class="req"> *</small></label>
               <input type="text" name="cl_cap_capacity" id="cl_cap_capacity" class="form-control"/>
               <span class="text-danger"><?php echo form_error('cl_cap_capacity'); ?></span>
               </div>



               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
               <textarea name="cl_cap_description" class="form-control" id="cl_cap_description"></textarea>
               <span class="text-danger"><?php echo form_error('cl_cap_description'); ?></span>
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
               if ($this->rbac->hasPrivilege('room_type', 'can_add')) {
               echo "8";
               } else {
               echo "12";
               }
               ?>">
               <!-- general form elements -->
               <div class="box box-primary">
               <div class="box-header ptbnull">
               <h3 class="box-title titlefix">List  Capacity</h3>
               <div class="box-tools pull-right">
               </div><!-- /.box-tools -->
               </div><!-- /.box-header -->
               <div class="box-body">
               <div class="table-responsive mailbox-messages" >
               <table class="table table-striped table-bordered table-hover example" >
               <thead>
               <tr>
               <th><?php echo $this->lang->line('slno'); ?></th>
               <th><?php echo $this->lang->line('room_no'); ?></th>
               <th><?php echo $this->lang->line('building'); ?></th> 
               <th><?php echo $this->lang->line('floor'); ?></th> 
               <th><?php echo $this->lang->line('class'); ?></th> 
               <th><?php echo $this->lang->line('room'); ?></th> 
               <th><?php echo $this->lang->line('capacity'); ?></th>        
               <th><?php echo $this->lang->line('description'); ?></th>           
               <th><?php echo $this->lang->line('status'); ?></th>
               <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
               </tr>
               </thead>
               <tbody>
               <?php
               $slno=1;
               foreach($get_capacity_list as $capacity)
               {
               ?>
               <tr>
               <td><?php  echo $slno; ?></td>
               <td><?php  echo $capacity['cl_cap_room_number']; ?></td>
               <td><?php  echo $capacity['build_name']; ?></td>
               <td><?php  echo $capacity['floor_name']; ?></td>  
               <td><?php  echo $capacity['cls_roomtype_name']; ?></td>  
               <td><?php  echo $capacity['roomtype_name']; ?></td> 
               <td><?php  echo $capacity['cl_cap_capacity']; ?></td> 
               <td><?php  echo $capacity['cl_cap_description']; ?></td> 

               <td>
               <div class="material-switch switchcheck">
               <input id="is_status_<?php echo $capacity['cl_cap_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($capacity['cls_roomtype_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_capacity(<?php echo $capacity['cl_cap_id']; ?>, this.checked)">
               <label for="is_status_<?php echo $capacity['cl_cap_id']; ?>" class="label-success"></label>
               </div>
               </td>

               <td text-align="right"> 
               <a data-placement="left" class="btn btn-default btn-xs edit-btn-capacity" data-id="<?php echo $capacity['cl_cap_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
               <i class="fa fa-pencil">
               </i>
               <a data-placement="left"  class="btn btn-default btn-xs del-btn-capacity"  data-id="<?php echo $capacity['cl_cap_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
               <i class="fa fa-trash trashstyle"></i>
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

               <!------------------Set Capacity Closed-------------------------------------------------------------------------->




               <!---------------- Set Capacity Started ---------------------------------------------------------------------------->






               <div id="set_hall" class="tabcontent">
               <div class="row">
               <div class="col-md-4">
               <!-- Horizontal Form -->
               <div class="box box-primary">

               <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('set_hall'); ?></h3>
               </div> 
               <form id="form6" class="ajax-form" action="<?php echo site_url("semester/Set_room_allocation/set_class_capacity") ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

               <div class="box-body"> 
               <input id="cl_cap_id" name="cl_cap_id"  placeholder="Class Room Type Id" type="hidden" value="" class="form-control" />          



               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('building'); ?></label>
               <select name="sethall_cap_building" id="sethall_cap_building" class="form-control" onchange="get_floor(this.value)" >
               <option value="">Select Building</option>
               <?php
               foreach($buildinglist as $build)
               {
               ?>
               <option value="<?php echo  $build['build_id']; ?>"<?php if(set_value('sethall_cap_building')==$build['build_id']) { echo "selected=selected"; }        ?> ><?php echo  $build['build_name']; ?> </option>
               <?php 
               }
               ?>
               </select> 
               <span class="text-danger"><?php echo form_error('sethall_cap_building'); ?></span>
               </div>




               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('floor'); ?></label>
               <select name="sethall_build_floor" id="sethall_build_floor" class="form-control" onchange="get_classtype(this.value)"  >
               <option></option>            
               </select> 
               <span class="text-danger"><?php echo form_error('sethall_build_floor'); ?></span>
               </div>      



               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('class').'&nbsp;'.$this->lang->line('type'); ?></label>
               <select name="sethall_classroom_types" id="sethall_classroom_types" class="form-control" onchange="get_roomtype(this.value)" >
               <option></option>            
               </select> 
               <span class="text-danger"><?php echo form_error('sethall_classroom_types'); ?></span>
               </div>


               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('Room').'&nbsp;'.$this->lang->line('type'); ?></label>
               <select name="sethall_room_types" id="sethall_room_types" class="form-control"  onchange="get_roomno()"  >
               <option></option>            
               </select> 
               <span class="text-danger"><?php echo form_error('sethall_room_types'); ?></span>
               </div> 



               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('room_no'); ?></label>
               <select name="sethall_room_no" id="sethall_room_no" class="form-control"  >
               <option></option>            
               </select> 
               <span class="text-danger"><?php echo form_error('sethall_room_no'); ?></span>
               </div>


               <div class="form-group">
               <label for="exampleInputEmail1"><?php echo $this->lang->line('total_capacity'); ?></label>
               Show Total Capacity
               <input type="text" name="total_capacity" id="total_capacity" class="form-control" readonly  >              
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
               if ($this->rbac->hasPrivilege('room_type', 'can_add')) {
               echo "8";
               } else {
               echo "12";
               }
               ?>">
               <!-- general form elements -->
               <div class="box box-primary">
               <div class="box-header ptbnull">

               <h3 class="box-title titlefix"><?php  echo$this->lang->line('list') .'&nbsp;'.$this->lang->line('set_hall');  ?></h3>
               <div class="box-tools pull-right">
               </div><!-- /.box-tools -->
               </div><!-- /.box-header -->
               <div class="box-body">
               <div class="table-responsive mailbox-messages" >
               <table class="table table-striped table-bordered table-hover example" >
               <thead>
               <tr>
               <th><?php echo $this->lang->line('slno'); ?></th>
               <th><?php echo $this->lang->line('room_no'); ?></th>
               <th><?php echo $this->lang->line('building'); ?></th> 
               <th><?php echo $this->lang->line('floor'); ?></th> 
               <th><?php echo $this->lang->line('class'); ?></th> 
               <th><?php echo $this->lang->line('room'); ?></th> 
               <th><?php echo $this->lang->line('capacity'); ?></th>        
               <th><?php echo $this->lang->line('description'); ?></th>           
               <th><?php echo $this->lang->line('status'); ?></th>
               <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
               </tr>
               </thead>
               <tbody>
               <?php
               $slno=1;
               foreach($get_capacity_list as $capacity)
               {
               ?>

               <tr>
               <td><?php  echo $slno; ?></td>
               <td><?php  echo $capacity['cl_cap_room_number']; ?></td>
               <td><?php  echo $capacity['build_name']; ?></td>
               <td><?php  echo $capacity['floor_name']; ?></td>  
               <td><?php  echo $capacity['cls_roomtype_name']; ?></td>  
               <td><?php  echo $capacity['roomtype_name']; ?></td> 
               <td><?php  echo $capacity['cl_cap_capacity']; ?></td> 
               <td><?php  echo $capacity['cl_cap_description']; ?></td> 
               <td>


               <div class="material-switch switchcheck">
               <input id="is_status_<?php echo $capacity['cl_cap_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($capacity['cls_roomtype_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_capacity(<?php echo $capacity['cl_cap_id']; ?>, this.checked)">
               <label for="is_status_<?php echo $capacity['cl_cap_id']; ?>" class="label-success"></label>
               </div>
               </td>

               <td text-align="right"> 
               <a data-placement="left" class="btn btn-default btn-xs edit-btn-capacity_type" data-id="<?php echo $capacity['cl_cap_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
               <i class="fa fa-pencil">
               </i>
               <a data-placement="left"  class="btn btn-default btn-xs del-btn-capacity"  data-id="<?php echo $capacity['cl_cap_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
               <i class="fa fa-trash trashstyle"></i>
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

               <!------------------------Set Capacity Closed-------------------------------------------------------------------------->


               <!------------------------Semester Closed------------------------->

               <!------------------------Seat Capacity-------------------------->


               </section>  
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


               // $('#form5').on('submit', function(e) 
               // {
               // e.preventDefault();
               // $.ajax({
               // url: $(this).attr('action'),
               // type: 'POST',
               // data: $(this).serialize(),
               // success: function(response) {
               // alert("Saved!");
               // },
               // error: function() {
               // alert("Failed .");
               // }
               // });
               // }); 
               // });





               //// Submit refresh (Only one form)...............................................................
               //    $('#form2').on('submit', function(e) {   
               //     e.preventDefault();

               //     // Save current active tab before submitting
               //     var currentTab = document.querySelector('.tablinks.active').getAttribute('onclick').match(/'(.*?)'/)[1];
               //     localStorage.setItem('activeTab', currentTab);

               //     $.ajax({
               //         url: $(this).attr('action'),
               //         type: 'POST',
               //         data: $(this).serialize(),
               //         success: function(response) {
               //             alert("Saved Successfully!");
               //             // Refresh the page
               //             location.reload();
               //         },
               //         error: function() {
               //             alert("Failed.");
               //         }
               //     });
               // });

               // // Restore active tab on page load
               // window.onload = function () {
               //     var activeTab = localStorage.getItem('activeTab');
               //     if (activeTab) {
               //         var tabs = document.getElementsByClassName("tablinks");
               //         for (var i = 0; i < tabs.length; i++) {
               //             var tabId = tabs[i].getAttribute("onclick").match(/'(.*?)'/)[1];
               //             if (tabId === activeTab) {
               //                 set_tab({ currentTarget: tabs[i] }, activeTab);
               //                 localStorage.removeItem('activeTab'); // clean up
               //                 break;
               //             }
               //         }
               //     } else {
               //         // Default: open first tab
               //         const firstTab = document.getElementsByClassName("tablinks")[0];
               //         const firstTabId = firstTab.getAttribute("onclick").match(/'(.*?)'/)[1];
               //         set_tab({ currentTarget: firstTab }, firstTabId);
               //     }
               // };


               ///// Submit with refresh closed........................................................................

               // Generic form submit handler for all forms with class "ajax-form"



               function get_floor(cl_building_id) 
               { 
               $('#sethall_build_floor').html("");
               var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
               $.ajax({
               url: "<?php echo base_url('semester/set_room_allocation/getFloorsByBuilding'); ?>", 
               type: "POST",
               data: {cl_building_id: cl_building_id},
               dataType: 'json',
               success: function(data) 
               {         

               $.each(data, function (i, obj)
               {
               div_data += "<option value=" + obj.floor_id + ">" + obj.floor_name + "</option>";
               });

               $('#sethall_build_floor').append(div_data);

               }
               });
               }




               function get_classtype(cl_floor_id)
               { 
               var building_bl   =   $('#sethall_cap_building').val();
               $('#sethall_classroom_types').html("");
               var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
               $.ajax({
               url: "<?php echo base_url('semester/set_room_allocation/getclasstypeByFloor'); ?>", 
               type: "POST",
               data: {cl_floor_id: cl_floor_id,building_bl:building_bl},
               dataType: 'json',
               success: function(data) 
               {        

               $.each(data, function (i, obj)
               {
               div_data += "<option value=" + obj.cls_roomtype_id + ">" + obj.cls_roomtype_name + "</option>";
               });

               $('#sethall_classroom_types').append(div_data);

               }
               });
               }


               function get_roomtype(cl_clstype)
               {
               var sethall_build_floor    =   $('#sethall_build_floor').val();
               var sethall_cap_building   =   $('#sethall_cap_building').val();

               $('#sethall_room_types').html("");
               var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
               $.ajax({
               url: "<?php echo base_url('semester/set_room_allocation/getroomtypeByclass'); ?>", 
               type: "POST",
               data: {cl_clstype: cl_clstype,sethall_cap_building:sethall_cap_building,sethall_build_floor:sethall_build_floor},
               dataType: 'json',
               success: function(data) 
               {        

               $.each(data, function (i, obj)
               {
               div_data += "<option value=" + obj.roomtype_id  + ">" + obj.roomtype_name + "</option>";
               });

               $('#sethall_room_types').append(div_data);

               }
               });
               }


               function get_roomno()
               {

               var pl_building         =   $('#sethall_cap_building').val();
               var pl_build_floor      =   $('#sethall_build_floor').val();  
               var pl_classroom_types  =   $('#sethall_classroom_types').val();
               var pl_room_types       =   $('#sethall_room_types').val();

               $('#sethall_room_no').html("");

               var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
               $.ajax({
               url: "<?php echo base_url('semester/set_room_allocation/fetchAllRooms'); ?>", 
               type: "POST",
               data: {pl_building:pl_building,pl_build_floor:pl_build_floor,pl_classroom_types:pl_classroom_types,pl_room_types:pl_room_types},
               dataType: 'json',
               success: function(data) 
               {       

               $.each(data, function (i, obj)
               {
               div_data += "<option value=" + obj.cl_cap_room_number  + ">" + obj.cl_cap_room_number + "</option>";
               });

               $('#sethall_room_no').append(div_data);
               }
               });
               }




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
               

               $(document).ready(function() 
               {
               
               // Generic form submit handler for all forms
            //    $('.ajax-form').on('submit', function(e) {
            //    e.preventDefault();

            //    var form = $(this);
            //    var formId = form.attr('id'); // store which form
            //    var activeTabBtn = document.querySelector('.tablinks.active');

            //    if(activeTabBtn) {
            //    var currentTab = activeTabBtn.getAttribute('onclick').match(/'(.*?)'/)[1];
            //    localStorage.setItem('activeTab', currentTab);
            //    }

            //    localStorage.setItem('activeForm', formId);

            //    $.ajax({
            //    url: form.attr('action'),
            //    type: 'POST',
            //    data: form.serialize(),
            //    success: function(response) {
            //    alert("Saved Successfully!");
            //    location.reload(); // refresh page
            //    },
            //    error: function() {
            //    alert("Failed.");
            //    }
            //    });
            //    });


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


               </script>


               <script>

               ///////building block .............

               // $(document).ready(function() 
               // { 
               // $('.del-btn').click(function(e) 
               // { 
               // var id = $(this).data('id');                

               // e.preventDefault();               
               // $.ajax({
               // url: '<?php echo base_url(); ?>semester/set_room_allocation/delete_building/' + id,
               // type: 'GET',
               // dataType: 'json',
               // success: function(response) 
               // {
               // if (response.success) {
               // $('#building').tab('show');
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
               url: '<?php echo base_url(); ?>semester/set_room_allocation/delete_building/' + id,
               type: 'GET',
               dataType: 'json',
               success: function(response) {
               if(response.success) {
               alert("Deleted Successfully!");
               location.reload(); // refresh page, stay on saved tab
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


               function updateStatus(Id, status) 
               { 
               var xhr = new XMLHttpRequest();
               xhr.open("POST", "<?php echo site_url('semester/set_room_allocation/update_status'); ?>", true);
               xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
               xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
               console.log('Status updated successfully');
               }
               };
               xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
               }               


               function updateStatus_classtype(Id, status) 
               {             
               var xhr = new XMLHttpRequest();
               xhr.open("POST", "<?php echo site_url('semester/set_room_allocation/update_status_classtype'); ?>", true);
               xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
               xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
               console.log('Status updated successfully');
               }
               };
               xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
               }                




               function updateStatus_capacity(Id, status) 
               {                   
               var xhr = new XMLHttpRequest();
               xhr.open("POST", "<?php echo site_url('semester/set_room_allocation/update_status_capacity'); ?>", true);
               xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
               xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
               console.log('Status updated successfully');
               }
               };
               xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
               }


               $(document).ready(function () 
               {
               $('.edit-btn').click(function (e) {

               e.preventDefault();
               let id = $(this).data('id');               

               $.ajax({
               url: "<?php echo site_url('semester/set_room_allocation/get_building_byid/'); ?>" + id,
               type: "GET",
               dataType: "json",
               success: function (data) 
               {  

               $('#building_name').val(data.build_name);
               $('#building_description').val(data.build_description);
               $('#building_id').val(data.build_id);                
               document.getElementById("form1").scrollIntoView({ behavior: 'smooth' });
               },
               error: function () {
               alert("Error loading record.");
               }
               });
               });
               }); 




               ///////building block closed.............

               ///////Floor.............


               function updateStatus_floor(Id, status) 
               { 
               var xhr = new XMLHttpRequest();
               xhr.open("POST", "<?php echo site_url('semester/set_room_allocation/update_status_floor'); ?>", true);
               xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
               xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
               console.log('Status updated successfully');
               }
               };
               xhr.send("Id=" + Id + "&status=" + (status ? 1 : 0));
               }



               $(document).ready(function () 
               {
               $('.edit-btn-floor').click(function (e) {
               e.preventDefault();
               let id = $(this).data('id');               

               $.ajax({
               url: "<?php echo site_url('semester/set_room_allocation/get_floor_byid/'); ?>" + id,
               type: "GET",
               dataType: "json",
               success: function (data) 
               {                
               $('#floor_name').val(data.floor_name);
               $('#floor_description').val(data.floor_description);
               $('#floor_id').val(data.floor_id);                
               document.getElementById("form2").scrollIntoView({ behavior: 'smooth' });
               },
               error: function () {
               alert("Error loading record.");
               }
               });
               });
               }); 



               $(document).ready(function() {
               var activeTab = localStorage.getItem('activeTab');
               if(activeTab) {
               var tabs = document.getElementsByClassName("tablinks");
               for(var i=0; i<tabs.length; i++) {
               if(tabs[i].getAttribute('onclick').match(/'(.*?)'/)[1] === activeTab) {
               set_tab({ currentTarget: tabs[i] }, activeTab);
               break;
               }
               }
               localStorage.removeItem('activeTab');
               }
               });


               // Delete floor
               $('.del-btn-floor').click(function(e) {
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
               url: '<?php echo base_url(); ?>semester/set_room_allocation/delete_floor/' + id,
               type: 'GET',
               dataType: 'json',
               success: function(response) {
               if(response.success) {
               alert("Deleted Successfully!");
               location.reload(); // refresh page, stay on saved tab
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



               $(document).ready(function () 
               {
               $('.edit-btn-roomtype').click(function (e) {
               e.preventDefault();
               let id = $(this).data('id');               

               $.ajax({
               url: "<?php echo site_url('semester/set_room_allocation/get_roomtype_byid/'); ?>" + id,
               type: "GET",
               dataType: "json",
               success: function (data) 
               {                
               $('#roomtype_name').val(data.roomtype_name);
               $('#roomtype_description').val(data.roomtype_description);
               $('#roomtype_id').val(data.roomtype_id);                
               document.getElementById("form4").scrollIntoView({ behavior: 'smooth' });
               },
               error: function () {
               alert("Error loading record.");
               }
               });
               });




               $('.edit-btn-capacity_type').click(function (e) {

               e.preventDefault();
               let id = $(this).data('id');               

               $.ajax({
               url: "<?php echo site_url('semester/set_room_allocation/get_roomtype_byid/'); ?>" + id,
               type: "GET",
               dataType: "json",
               success: function (data) 
               {                
               $('#roomtype_name').val(data.roomtype_name);
               $('#roomtype_description').val(data.roomtype_description);
               $('#roomtype_id').val(data.roomtype_id);                
               document.getElementById("form4").scrollIntoView({ behavior: 'smooth' });
               },
               error: function () {
               alert("Error loading record.");
               }
               });
               });













               $('.edit-btn-capacity').click(function (e) {
               e.preventDefault();
               let id = $(this).data('id');               

               $.ajax({
               url: "<?php echo site_url('semester/set_room_allocation/get_capacity_byid/'); ?>" + id,
               type: "GET",
               dataType: "json",
               success: function (data) 
               {    

               $('#cl_cap_room_number').val(data.cl_cap_room_number);            
               $('#cl_cap_id').val(data.cl_cap_id); 

               $('#cl_cap_building').empty();
               $('#cl_cap_building').append('<option value="' + data.build_id + '">' + data.build_name + '</option>');
               <?php foreach($buildinglist as $build): ?>
               $('#cl_cap_building').append('<option value="<?php echo $build['build_id']; ?>"><?php echo $build['build_name']; ?></option>');
               <?php endforeach; ?>


               $('#cl_cap_floor').empty();
               $('#cl_cap_floor').append('<option value="' + data.floor_id + '">' + data.floor_name + '</option>');
               <?php foreach($floorlist as $floor): ?>
               $('#cl_cap_floor').append('<option value="<?php echo $floor['floor_id']; ?>"><?php echo $floor['floor_name']; ?></option>');
               <?php endforeach; ?>


               $('#cl_cap_classroom_type').empty();
               $('#cl_cap_classroom_type').append('<option value="' + data.cls_roomtype_id + '">' + data.cls_roomtype_name + '</option>');
               <?php foreach($classlist as $class): ?>
               $('#cl_cap_classroom_type').append('<option value="<?php echo $class['cls_roomtype_id']; ?>"><?php echo $class['cls_roomtype_name']; ?></option>');
               <?php endforeach; ?> 


               $('#cl_cap_roomtype').empty();
               $('#cl_cap_roomtype').append('<option value="' + data.roomtype_id + '">' + data.roomtype_name + '</option>');
               <?php foreach($roomtypelist as $roomtype): ?>
               $('#cl_cap_roomtype').append('<option value="<?php echo $roomtype['roomtype_id']; ?>"><?php echo $roomtype['roomtype_name']; ?></option>');
               <?php endforeach; ?>

               $('#cl_cap_capacity').val(data.cl_cap_capacity); 
               $('#cl_cap_description').val(data.cl_cap_description);

               document.getElementById("form5").scrollIntoView({ behavior: 'smooth' });
               },
               error: function () {
               alert("Error loading record.");
               }
               });
               });
               }); 







               $('.del-btn-roomtype').click(function(e) {
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
               url: '<?php echo base_url(); ?>semester/set_room_allocation/delete_roomtype/' + id,
               type: 'GET',
               dataType: 'json',
               success: function(response) {
               if(response.success) {
               alert("Deleted Successfully!");
               location.reload(); // refresh page, stay on saved tab
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


               $('#sethall_cap_building, #sethall_build_floor, #sethall_classroom_types, #sethall_room_types,#sethall_room_no').change(function() {
               // Get selected values
               var cl_cap_building    = $('#sethall_cap_building').val();
               var cl_build_floor     = $('#sethall_build_floor').val();
               var cl_classroom_types = $('#sethall_classroom_types').val();
               var  cl_room_types     = $('#sethall_room_types').val(); 
               var  sethall_room_no   = $('#sethall_room_no').val();              

               // Make sure all dropdowns have values before sending
               if (cl_cap_building && cl_room_types && cl_classroom_types && cl_build_floor && sethall_room_no) {
               $.ajax({
               url: '<?php echo base_url("semester/set_room_allocation/get_totalcapacity"); ?>',
               type: 'POST',
               dataType: 'json',
               data: {
               cl_cap_building: cl_cap_building,
               cl_room_types: cl_room_types,
               cl_classroom_types: cl_classroom_types,
               cl_build_floor: cl_build_floor,
               sethall_room_no:sethall_room_no
               },
               success: function(response) {

               if (response) {
               // Assuming your response contains capacity value
               $('#total_capacity').val(response.cl_cap_capacity);
               } else {
               alert("No capacity found!");
               $('#total_capacity').val('');
               }

               },
               error: function(xhr, status, error) {
               console.error(xhr.responseText);
               alert("Error fetching capacity.");
               }
               });
               }
               });




               $('.del-btn-capacity').click(function(e) {
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
               url: '<?php echo base_url(); ?>semester/set_room_allocation/delete_capacity/' + id,
               type: 'GET',
               dataType: 'json',
               success: function(response) {
               if(response.success) {
               alert("Deleted Successfully!");
               location.reload(); // refresh page, stay on saved tab
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


               $(document).ready(function () 
               {
               $('.edit-btn-classtype').click(function (e) {
               e.preventDefault();
               let id = $(this).data('id');                
               $.ajax({
               url: "<?php echo site_url('semester/set_room_allocation/get_classtype_byid/'); ?>" + id,
               type: "GET",
               dataType: "json",
               success: function (data) 
               {                
               $('#classroom_type_name').val(data.cls_roomtype_name);
               $('#classroom_type_description').val(data.cls_roomtype_description);
               $('#classroom_type_id').val(data.cls_roomtype_id);                
               document.getElementById("form4").scrollIntoView({ behavior: 'smooth' });
               },
               error: function () {
               alert("Error loading record.");
               }
               });
               });
               });             



               $('.del-btn-classtype').click(function(e) {
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
               url: '<?php echo base_url(); ?>semester/set_room_allocation/delete_classtype/' + id,
               type: 'GET',
               dataType: 'json',
               success: function(response) {
               if(response.success) {
               alert("Deleted Successfully!");
               location.reload(); // refresh page, stay on saved tab
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




               var modal = document.getElementById("myModal");

               // Get the button that opens the modal
               var btn = document.getElementById("myBtn");

               // Get the <span> element that closes the modal
               var span = document.getElementsByClassName("close")[0];

               // When the user clicks on the button, open the modal
               btn.onclick = function() {
               modal.style.display = "block";
               }

               // When the user clicks on <span> (x), close the modal
               span.onclick = function() {
               modal.style.display = "none";
               }

               // When the user clicks anywhere outside of the modal, close it
               window.onclick = function(event) {
               if (event.target == modal) {
               modal.style.display = "none";
               }
               }


               </script>











