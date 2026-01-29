<style>
.table-container {
display: table;
width: 100%;
border-collapse: collapse;
}

.table-row {
display: table-row;
}

.table-cell {
display: table-cell;
padding: 8px;
border: 1px solid #ddd;
}

.header {
font-weight: bold;
background-color: #f2f2f2;
}



.table-scroll-container 
{
width: 100%;
max-height: 300px; /* Set a maximum height for vertical scrolling */
overflow: auto; 
}



/* Add this style to ensure the table header stays fixed during scrolling */
.table-row.header {
    /*position: sticky;*/
    top: 0;
    background-color: #f2f2f2; /* Adjust the background color as needed */
}
</style>

                   
                    <?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                    
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-credit-card"></i> <?php echo $this->lang->line('circulation_privileges'); ?> <small></small></h1>
                    </section>
                    
                    <!-- Main content -->
                    <section class="content">
                    <div class="row">
                    <?php
                    //if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                    // ?>
                    <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        
                    <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $this->lang->line('circulation_privileges'); ?></h3>
                    </div>
                    
                    <!-- /.box-header -->
                    <form id="form1" action="<?php echo site_url('admin/circulation_privileges/add_circulation_privileges') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('category'); ?></label> <small class="req">*</small>
                    <select name="category" id="category" class="form-control">
                    <option value=""><?php echo $this->lang->line('select'); ?></option>  
                    <option value="Student"><?php echo $this->lang->line('student'); ?></option>   
                    <?php
                    foreach ($roles as $role_key => $role_value)
                    { 
                    ?>
                    <option value="<?php echo $role_value['name']; ?>"><?php echo $role_value['name']; ?></option>
                    <?php } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('category'); ?></span>
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('no_of_books'); ?></label> <small class="req">*</small>
                    <input id="no_of_books" name="no_of_books" placeholder="" type="text" class="form-control"  value="<?php echo set_value('no_of_books'); ?>" />
                    <span class="text-danger"><?php echo form_error('no_of_books'); ?></span>
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('no_of_days'); ?></label>
                    <input id="no_of_days" name="no_of_days" placeholder="" type="number" class="form-control"  value="<?php echo set_value('no_of_days'); ?>" />
                    <span class="text-danger"><?php echo form_error('no_of_days'); ?></span>
                    </div>
                    </div>
                    
                    <!-- /.box-body -->
                    
                    <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </div>
                    </form>
                    </div>
                    
                    </div><!--/.col (right) -->
                    <!-- left column -->
                    <?php // } ?>
                    <div class="col-md-<?php
                    if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                    echo "8";
                    } else {
                    echo "12";
                    }
                    ?>">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><?php echo $this->lang->line('circulation_privileges').'&nbsp;'.$this->lang->line('list').'&nbsp;&nbsp;'.$current_session['session']; ?></h3>
                    <div class="box-tools pull-right">
                    </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <div class="mailbox-messages table-responsive">
                    <div class="download_label"><?php echo $this->lang->line('circulation_privileges'); ?></div>
                    <div class="table-responsive"> 
                    <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo $this->lang->line('circulation_privileges'); ?>">
                    <thead>
                    <tr>
                    <th>Sl.No</th>   
                    <th><?php echo $this->lang->line('category'); ?></th>
                    <th><?php echo $this->lang->line('no_of_books'); ?></th>
                    <th><?php echo $this->lang->line('no_of_days'); ?></th>
                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $slno=1;
                    foreach($privileges as $privil)
                    {
                    ?>
                    <tr>
                    <td><?php echo $slno; ?></td>
                    <td><?php echo $privil['library_cp_category']; ?> </td>
                    <td><?php echo $privil['library_cp_no_of_books']; ?> </td>
                    <td><?php echo $privil['library_cp_no_of_days']; ?> </td>
                    <td>
                        
                    <a data-placement="left" data-toggle="modal" onclick="getprivilege(<?php echo $privil['library_cp_id']; ?>)" data-target="#exampleModal_<?php echo $sl; ?>" href="#" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('add'); ?>">
                    <i class="fa fa-plus"></i>
                    </a>
                        
                    <a data-placement="left" href="<?php echo site_url('admin/circulation_privileges/edit/' . $privil['library_cp_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                    <i class="fa fa-pencil"></i>
                    </a>
                    
                    <a data-placement="left" href="#" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                    <i class="fa fa-remove" style="color:#e52c2c;"></i>
                    </a>
                    
                    </td>
                    
                    <div class="modal fade" id="exampleModal_<?php echo $sl; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Multiple Fine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    
                    
                    <form name="form" class="add_form"  method="POST" action="<?php echo site_url('admin/circulation_privileges/add_multiplefine'); ?>" >
                    <div class="modal-body">
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label"><?php echo $this->lang->line('fine_days'); ?></label>
                    <input type="text" class="form-control" id="fine_days" required placeholder="Enter Days"  name="fine_days">
                    <input type="hidden" class="form-control" id="privilegefine"    name="privilegefine" value="<?php echo $privil['library_cp_id']; ?>">
                    </div>
                    <div class="form-group">
                    <label for="message-text" class="col-form-label"><?php echo $this->lang->line('fine').'&nbsp;&nbsp;'.$this->lang->line('amt'); ?></label>
                    <!--<textarea class="form-control" id="message-text" required placeholder="Enter Amount" id="fineamt" name="fineamt"></textarea>-->
                    
                    <input type="text" class="form-control" id="fineamt" required placeholder="Enter Amount"  name="fineamt">
                    </div>
                    
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="SAVE" >
                    </div>
                    </form>
                    
                    
                    
                            <div class="table-scroll-container">
                            <div class="table-container">
                            <div class="table-row header">
                            <div class="table-cell">Sl.No</div>
                            <div class="table-cell"><?php echo $this->lang->line('fine_days'); ?></div>
                            <div class="table-cell"><?php echo $this->lang->line('fine').'&nbsp;&nbsp;'.$this->lang->line('amt'); ?></div>
                            <div class="table-cell">Action</div>
                            </div>
                            <?php
                            $sl = 1;
                            foreach ($multifine as $mutli) 
                            {
                            if($mutli['lib_multi_privilege_id']==$privil['library_cp_id'])
                            {
                            ?>
                            <form name="frm" method="POST" action="<?php echo site_url('admin/circulation_privileges/editmulti'); ?>"/>
                            <div class="table-row">
                            <div class="table-cell"><?php echo $sl; ?></div>
                            <div class="table-cell"><input type="text"  placeholder="Enter Days" class="form-control" id="lib_multi_finedays" name="lib_multi_finedays" value="<?php echo $mutli['lib_multi_finedays']; ?>"/></div>
                            <div class="table-cell"><input type="text" placeholder="Enter Amount" class="form-control" id="lib_multi_amt" name="lib_multi_amt" value="<?php echo $mutli['lib_multi_amt']; ?>"/></div>
                            <div class="table-cell">
                            <input type="hidden" name="lib_multi_id" value="<?php echo $mutli['lib_multi_id']; ?>" />
                            <button type="submit" name="Edit" title="Edit" class="btn btn-default btn-xs "><i class="fa fa-pencil"></i></button>
                            <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" title="Delete" onclick="deletemulti(<?php echo $mutli['lib_multi_id']; ?>)">
                            <i class="fa fa-remove" style="color:#e52c2c;"></i>
                            </a>
                            </div>
                            </div>
                            </form>
                            <?php
                            $sl++;
                            }
                            }
                            ?>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                    
                    </tr>
                    <?php 
                    $slno++;
                    }
                    ?>
                    </tbody>
                    </table>
                    </div> 
                    </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                    </div>
                    </div><!--/.col (left) -->
                    
                    </div>
                    <div class="row">
                    <!-- left column -->
                    
                    <!-- right column -->
                    <div class="col-md-12">
                    
                    </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                    </section><!-- /.content -->
                    </div><!-- /.content-wrapper -->
                    
         
       
            <script type="text/javascript">
            $(document).ready(function()
            {
            $(".add_form").submit(function(event)
            {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
            url: '<?php echo site_url('admin/circulation_privileges/add_multiplefine'); ?>',
            type: 'POST',
            data: formData,
            async: false,
            success: function(data) 
            {
            if (data) 
            {
            alert("INSERTED SUCCESSFULLY");
            }
            else
            {
            alert("SOMETHING GONE WRONG");
            }
            },
            cache: false,
            contentType: false,
            processData: false
            });
            });
            });
            
            
            function deletemulti(lib_multi_id)
            {
            var confirmation = confirm('<?php echo $this->lang->line('delete_confirm') ?>');
            if (confirmation == true)
            {
                $.ajax({
                url: "<?php echo site_url("admin/circulation_privileges/delete_multi") ?>",
                type: "POST",
                data: {'lib_multi_id': lib_multi_id},
                dataType: "json",
                success: function (res)
                {
                if (res.status == 0) {
                errorMsg(res.error);
                } else {
                successMsg(res.success);
                window.location.reload(true);
                }
                }
                });
            }
            }
           </script>         
