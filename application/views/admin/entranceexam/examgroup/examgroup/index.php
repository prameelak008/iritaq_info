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
                <i class="fa fa-usd"></i><?php echo $this->lang->line('exam').'&nbsp;'.$this->lang->line('group'); ?></h1>
                </section>
                
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary" style="padding-bottom: 100px">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('exam').'&nbsp;'.$this->lang->line('group').'&nbsp;'.$current_session['session']; ?></h3>
                </div><!-- /.box-header -->
                
                
                <form id="form1" action="<?php echo site_url('entrance_allotment/examgroup'); ?>"  id="examgroup" name="examgroup" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="box-body">
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                <input type="text" name="name" placeholder="Name" class="form-control" required>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>
                                
                                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
                <select name="session" class="form-control">
                <?php
                
                foreach($sessionlist as $session)
                {
                ?>
                <option value="<?php echo $session['id'] ?>" <?php
                if ($current_session['cur_session'] == $session['id']) 
                {
                echo "selected=selected";
                }
                ?>><?php   echo $session['session']; ?></option>
                <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('session'); ?></span>
                </div>
                
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('start').'&nbsp;'.$this->lang->line('date'); ?><small class="req"> *</small></label>
                <input type="date" name="start_date" placeholder="Start Date" class="form-control" required>
                <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                </div>
                
                
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('end').''.$this->lang->line('date'); ?><small class="req"> *</small></label>
                <input type="date" name="end_date" placeholder="End Date" class="form-control" required>
                <span class="text-danger"><?php echo form_error('end_date'); ?></span>
                </div>
                
                
                </div><!-- /.box-body -->
                
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                </div>
                </form>
                
                
                
                </div>
                </div><!--/.col (right) -->
                <!-- left column -->
                <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"> Group List </h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example" >
                <thead>
                <tr>
                <th><?php echo $this->lang->line('name'); ?>
                <th><?php echo $this->lang->line('session'); ?>
                </th>
                
                
                 <th><?php echo $this->lang->line('start').'&nbsp;'.$this->lang->line('date'); ?>
                </th>
                
                 <th><?php echo $this->lang->line('end').'&nbsp;'.$this->lang->line('date');  ?>
                </th>
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                    
                    
                <?php
                $count = 1;
                foreach ($examgroup as $group) 
                { 
                ?>
                <tr>                                                  
                <td><?php echo $group['entrance_examgroup_name']; ?></td>
                <td><?php echo $group['session'];
                ?></td>
                
                <td><?php echo $group['entrance_start_date'];
                ?></td>
                
                <td><?php echo $group['entrance_end_date'];
                ?></td>
                
                <td align="right">
                <a data-placement="left" href="<?php echo site_url();?>entrance_allotment/examgroup/editval/<?php echo $group['entrance_examgroup_id']; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a> 
                <a data-placement="left" href="<?php echo site_url(); ?>entrance_allotment/examgroup/delval/<?php echo  $group['entrance_examgroup_id']; ?>" class="btn btn-default btn-xs" onclick="return doconfirm();"  style="color:red" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash"></i></a>
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
                
                
                
                
                <script type="text/javascript">
                function doconfirm()
                {
                    
                var job=confirm('Do you want to delete');
                if(job==true)
                {
                return true;
                }
                else
                {
                return false;
                }
                }
                
                $(document).ready(function (e) 
                {
                $("#form1").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                url: "<?php echo site_url("entrance_allotment/examgroup/add_val") ?>",
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
                } else {
                
                successMsg(data.message);
                window.location.reload(true);
                }
                }
                });
                }));
                });
                </script>
                
                
