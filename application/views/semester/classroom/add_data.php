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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('classroom'); ?></h1>
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
            <h3 class="box-title"><?php echo $this->lang->line('classroom'); ?></h3>
            </div><!-- /.box-header -->
            
            
            
            <form id="form1" action="<?php echo site_url('semester/classroom/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            
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
            <label for="exampleInputEmail1"><?php echo $this->lang->line('room').'&nbsp;'.$this->lang->line('no'); ?></label>
            
            <input type="hidden" name="clsid" id="clsid" class="form-control" />
            
            
            <input type="text" name="room_number" id="room_number" class="form-control"/>
            <span class="text-danger"><?php echo form_error('room_number'); ?></span>
            </div> 
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('building_block'); ?><small class="req"> *</small></label>
            <select name="building_block" id="building_block" class="form-control">
            <option value="">Select Building Block</option>
            <?php
            foreach($buildingblock_bystatus as $status)
            {
            ?>
            <option value="<?php echo $status['id']; ?>"
            <?php  
            if(set_value('building_block')==$status['id'])  
            {
            echo "selected=selected";  
            }
            ?>><?php echo $status['block_name']; ?></option>
            <?php  } ?>
            </select> 
            <button type="button" class="" data-toggle="modal" data-target="#myModal">Add +</button>
            <span class="text-danger"><?php echo form_error('building_block'); ?></span>
            </div>
            
           
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('select').'&nbsp;'.$this->lang->line('floor'); ?></label>
            <select name="floor" id="floor" class="form-control">
            <option value="">Select Floor</option>
            <?php
            foreach($floor_bystatus as $floor)
            {
            ?>
            <option value="<?php  echo $floor['id']; ?>"
            <?php if(set_value('floor')== $floor['id'])
            {
            echo "selected=selected";
            }
            ?>><?php   echo  $floor['floor_name'];?>
            </option>
            <?php
            }
            ?>
            </select>
            <button type="button" class="" data-toggle="modal" data-target="#myModalfloor">Add +</button>
            <span class="text-danger"><?php echo form_error('floor'); ?></span>
            </div>
            
            
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('select').'&nbsp;'.$this->lang->line('type'); ?></label>
            <select name="type" id="type" class="form-control">
            <option value="">Select Type</option>
            <?php
            foreach($type_bystatus as $type)
            {
            ?>
            <option value="<?php  echo $type['cls_id']; ?>"
            <?php  
            if(set_value('type')==$type['cls_id'])
            {
            echo "selected=selected";
            }
            ?>>
            <?php echo $type['cls_name']; ?></option>
            <?php } ?>
            
            </select>
            <button type="button" class="" data-toggle="modal" data-target="#myModaltype">Add +</button>
            <span class="text-danger"><?php echo form_error('type'); ?></span>
            </div>

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('select').'&nbsp;'.$this->lang->line('capacity'); ?></label>
            <input type="text" name="capacity" id="capacity" class="form-control"/>
            <span class="text-danger"><?php echo form_error('capacity'); ?></span>
            </div> 
            
            </div><!-- /.box-body -->
            
            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            </div>
            </form>
            </div>
            </div>
            
            
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Building Block</h4>
                </div>
                
                <form name="form" id="form5" method="POST" action="#" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('building_block'); ?></label>
                <input type="text" name="block_name" id="block_name" class="form-control"/>
                <span class="text-danger"><?php echo form_error('block_name'); ?></span>
                </div> 
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                <textarea name="description" class="form-control" id="description"></textarea>
                <span class="text-danger"><?php echo form_error('description'); ?></span>
                </div> 
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr> 
                
                <th>slno</th>
                <th>Building Block</th>
                <th>Description</th>
                <th>Status</th>
                <th>Edit</th>
                </tr>
                </thead>
                <?php
                $slno=1;
                foreach($buildingblock as $block)
                {
                ?>
                <form name="form"  class="edit-block-form" method="POST" action="#"  method="post" accept-charset="utf-8" enctype="multipart/form-data">  
                <tr>
                <td><?php  echo $slno; ?></td>
                <td>
                <input type="hidden" name="block_id" class="form-control" value="<?php  echo $block['id']; ?>"/>   
                <input type="text" name="block_name" class="form-control" value="<?php  echo $block['block_name']; ?>"/></td>
                <td>
                <textarea id="block_description" class="form-control" name="block_description" rows="4" cols="50"><?php  echo $block['description']; ?></textarea>
                </td>
                <td>
                    
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $block['id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($block['status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $block['id']; ?>, this.checked)">
                <label for="is_status_<?php echo $block['id']; ?>" class="label-success"></label>
                </div>
                </td>
                
                <td>
                <button type="submit" class="btn btn-default" ><i class="fa fa-pencil"></i></button>
                </td>
                </tr>
                </form>
                
                <?php $slno++; } ?>
                </table>
                </div>
                </div>
                </div>
                </div> 
                
                <!-----Add Floor----------------------------------------------------------------------->
                <div class="modal fade" id="myModalfloor" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add').'&nbsp;&nbsp;'.$this->lang->line('floor'); ?></h4>
                </div>
                
                <form name="form" id="form5" method="POST" action="#" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('floor'); ?></label>
                <input type="text" name="floor_name" id="floor_name" class="form-control"/>
                <span class="text-danger"><?php echo form_error('floor_name'); ?></span>
                </div>
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                <textarea name="description" class="form-control" id="description"></textarea>
                <span class="text-danger"><?php echo form_error('description'); ?></span>
                </div> 
                
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr> 
                
                <th>slno</th>
                <th>Building Block</th>
                <th>Description</th>
                <th>Status</th>
                <th>Edit</th>
                </tr>
                </thead>
                <?php
                $slno=1;
                foreach($buildingblock as $block)
                {
                ?>
                <form name="form"  class="edit-block-form" method="POST" action="#"  method="post" accept-charset="utf-8" enctype="multipart/form-data">  
                <tr>
                <td><?php  echo $slno; ?></td>
                <td>
                <input type="hidden" name="block_id" class="form-control" value="<?php  echo $block['id']; ?>"/>   
                <input type="text" name="block_name" class="form-control" value="<?php  echo $block['block_name']; ?>"/></td>
                <td>
                <textarea id="block_description" class="form-control" name="block_description" rows="4" cols="50"><?php  echo $block['description']; ?></textarea>
                </td>
                <td>
                    
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $block['id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($block['status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus(<?php echo $block['id']; ?>, this.checked)">
                <label for="is_status_<?php echo $block['id']; ?>" class="label-success"></label>
                </div>
                </td>
                
                <td>
                <button type="submit" class="btn btn-default" ><i class="fa fa-pencil"></i></button>
                </td>
                </tr>
                </form>
                
                <?php $slno++; } ?>
                </table>
                </div>
                </div>
                </div>
                </div> 
                
                
                
                
                <!-----Add Type------------------------------------------------------------------------>
                <div class="modal fade" id="myModaltype" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Type</h4>
                </div>
                
                <form name="form" id="form6" method="POST" action="#" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('classroom_type'); ?></label>
                <input type="text" name="classroom_type" id="classroom_type" class="form-control"/>
                <span class="text-danger"><?php echo form_error('classroom_type'); ?></span>
                </div> 
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                <textarea name="description" class="form-control" id="description"></textarea>
                <span class="text-danger"><?php echo form_error('description'); ?></span>
                </div> 
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr> 
                
                <th>slno</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Edit</th>
                </tr>
                </thead>
                <?php
                $slno=1;
                foreach($class_type as $type)
                {
                ?>
                <form name="form"  class="edit-block-form" method="POST" action="#"  method="post" accept-charset="utf-8" enctype="multipart/form-data">  
                <tr>
                <td><?php  echo $slno; ?></td>
                <td>
                <input type="hidden" name="cls_id" class="form-control" value="<?php  echo $type['cls_id']; ?>"/>   
                <input type="text" name="cls_name" class="form-control" value="<?php  echo $type['cls_name']; ?>"/></td>
                <td>
                <textarea id="cls_description" class="form-control" name="cls_description" rows="4" cols="50"><?php  echo $type['cls_description']; ?></textarea>
                </td>
                <td>
                    
                <div class="material-switch switchcheck">
                <input id="is_status_<?php echo $type['id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($type['status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_Type(<?php echo $type['cls_id']; ?>, this.checked)">
                <label for="is_status_<?php echo $type['id']; ?>" class="label-success"></label>
                </div>
                </td>
                
                <td>
                <button type="submit" class="btn btn-default" ><i class="fa fa-pencil"></i></button>
                </td>
                </tr>
                </form>
                
                <?php $slno++; } ?>
                </table>
                </div>
                </div>
                </div>
                </div> 
   
   
                <script type="text/javascript">
                $(document).ready(function (e) 
                {
                $("#form4").on('submit', (function (e) 
                {
                e.preventDefault();
                $.ajax({
                url: "<?php echo site_url("semester/classroom/add_buildingblock") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: true,
                processData: false,
                success: function (data)
                {
                if (data.status == "fail") 
                {
                var message = "";
                $.each(data.error, function (index, value)
                {
                message += value;
                });
                errorMsg(message);
                } 
                else 
                {
                successMsg(data.message);
                $("#form4")[0].reset();
                }
                }
                });
                }));
                
                $("#form5").on('submit', (function (e) 
                {
                e.preventDefault();
                $.ajax({
                url: "<?php echo site_url("semester/classroom/add_floor") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: true,
                processData: false,
                success: function (data)
                {
                if (data.status == "fail") 
                {
                var message = "";
                $.each(data.error, function (index, value)
                {
                message += value;
                });
                errorMsg(message);
                } 
                else 
                {
                successMsg(data.message);
                $("#form5")[0].reset();
                }
                }
                });
                }));
                
                $("#form6").on('submit', (function (e) 
                {
                e.preventDefault();
                $.ajax({
                url: "<?php echo site_url("semester/classroom/add_clstype") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: true,
                processData: false,
                success: function (data)
                {
                if (data.status == "fail") 
                {
                var message = "";
                $.each(data.error, function (index, value)
                {
                message += value;
                });
                errorMsg(message);
                } 
                else 
                {
                successMsg(data.message);
                $("#form6")[0].reset();
                }
                }
                });
                }));
                
                $(".edit-block-form").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                url: "<?php echo site_url('semester/classroom/edit_block/'); ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) 
                {
                if (data.status == "fail") 
                {
                var message = "";
                $.each(data.error, function (index, value)
                {
                message += value;
                });
                errorMsg(message);
                } 
                else 
                {
                successMsg(data.message);
                $(".edit-block-form")[0].reset();
                }
                }
                });
                });
                });

                </script>
            
            
            
            <!-- left column -->
            <?php //} ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('classroom', 'can_add')) {
            echo "8";
            } else {
            echo "12";
            }
            ?>">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('classroom'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            
            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
                
            <th><?php echo $this->lang->line('slno'); ?></th>
            <th><?php echo $this->lang->line('room_no'); ?> </th>
            <th><?php echo $this->lang->line('building_block'); ?></th>
            <th><?php echo $this->lang->line('floor'); ?></th>
            <th><?php echo $this->lang->line('type'); ?></th>
            <th><?php echo $this->lang->line('capacity'); ?></th>
            <th><?php echo $this->lang->line('status'); ?></th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>
            
            <?php
           
             $sl=1;
            foreach($classroomlist as $list)
            {
            ?>
            <tr>
            <th><?php echo $sl; ?> </th> 
            <td><?php  echo $list['cl_room_number']; ?></td>
            <td><?php  echo $list['block_name']; ?></td>
            <td><?php  echo $list['floor_name']; ?></td>
            <td><?php  echo $list['cls_name']; ?></td>
            <td><?php  echo $list['cl_capacity']; ?></td>
            
            <td>
            <div class="material-switch switchcheck">
            <input id="is_statuscls_<?php echo $list['cl_id']; ?>" name="is_status" type="checkbox" class="chk" value="1" <?php echo ($list['cl_status'] == 1 ? 'checked' : ''); ?> onchange="updateStatus_Clss(<?php echo $list['cl_id']; ?>, this.checked)">
            <label for="is_statuscls_<?php echo $list['cl_id']; ?>" class="label-success"></label>
            </div>
            </td>
            
            <td align="right">
            <a data-placement="left" href="#" class="btn btn-default btn-xs edit-btn" data-id="<?php echo $list['cl_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
            <i class="fa fa-pencil"></i>
            <a data-placement="left" href="<?php echo site_url('semester/classroom/delete/' . $list['cl_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#cb1515;"></i></a>
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
            xhr.open("POST", "<?php echo site_url('semester/classroom/update_status'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Status updated successfully');
            }
            };
            xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
            }
            
            
            
            function updateStatus_Clss(id, status) 
            { 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('semester/classroom/update_statusClss'); ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Status updated successfully');
            }
            };
            xhr.send("id=" + id + "&status=" + (status ? 1 : 0));
            }
               
                
                
            $('.edit-btn').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
            url: '<?php echo base_url(); ?>semester/classroom/get_data/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                
            $('#clsid').val(response.cl_id);
            $('#room_number').val(response.cl_room_number);
            $('#building_block').empty();
            $('#floor').empty();
            $('#type').empty();
            
            $('#building_block').append('<option value="' + response.cl_building_block + '">' + response.block_name + '</option>');
            $('#floor').append('<option value="' + response.cl_floor + '">' + response.floor_name + '</option>');
            $('#type').append('<option value="' + response.cl_type + '">' + response.cls_name + '</option>');
            $('#capacity').val(response.cl_capacity);
            },
            error: function(xhr, status, error) {
            console.error(error);
            }
            });
            });

                	
            </script>