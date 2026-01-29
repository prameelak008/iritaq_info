<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-credit-card"></i> <?php echo $this->lang->line('template'); ?> </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
           // if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('settings'); ?></h3>
                        </div><!-- /.box-header -->
                        
                        <form id="form" action="<?php echo site_url('entrance_settings/currentsettings/create'); ?>"   name="form" method="post" >
                            
                            
                            
                                <div class="box-body"> 
                                
                                
                                
                                 <?php /* if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } */ ?>
                                
                            <div class="form-group">
                            <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                            <select  id="session" name="session" class="form-control select2"  >
                            <option value="" >Select Session</option>
                            <?php
                            foreach($sessionlist as $sess)
                            {
                            ?>
                            <option value="<?php echo $sess['id'];?>"
                            ><?php  echo $sess['session']; ?></option>
                            <?php 
                            } 
                            ?>
                            </select>
                            
                            <span class="text-danger"><?php echo form_error('session'); ?></span>
                            </div>
                                
                               
                            <div class="form-group" >
                            <label for="exampleInputEmail1">Title </label>
                            <textarea cols="3" rows="5" id="title" name="title" class="form-control ckeditor"  style="background-color: whitesmoke;"></textarea>
                            </div> 
                            
                            
                            <div class="form-group" >
                            <label for="exampleInputEmail1">Sub Title </label>
                            <textarea cols="3" rows="5" id="subpage" name="subpage" class="form-control ckeditor"  style="background-color: whitesmoke;"></textarea>
                            </div>
                            
                            <div class="form-group" >
                            <label for="exampleInputEmail1">Admit Card Title </label>
                            <input type="text" name="admit_title" id="admit_title" class="form-control" />
                            </div> 
                            
                            <div class="form-group switch-inline">
                            <label><?php echo $this->lang->line('active') ?><?php echo $this->lang->line('status') ?></label>
                            <div class="material-switch switchcheck">
                            
                            <input id="is_status" name="is_status" type="checkbox" class="chk" value="1">
                            <label for="is_status" class="label-success"></label>
                            </div>
                            </div>
                            
                           
                                
                                
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div>
               
            <?php // } ?>
            
            
            <div class="col-md-8">
                
            <?php
                /*
            if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            
            */
            ?>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('settings'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('template'); ?></div>
                            <div class="table-responsive"> 
                                <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo $this->lang->line('template'); ?>">
                                <thead>
                                    <tr>
                                    <th><?php echo $this->lang->line('session'); ?></th>
                                    <th><?php echo $this->lang->line('title'); ?></th>
                                    <th><?php echo $this->lang->line('sub').'&nbsp;'.$this->lang->line('page'); ?></th>
                                    <th><?php echo $this->lang->line('created'); ?></th>
                                    
                                    <th><?php echo $this->lang->line('active'); ?></th>
                                    
                                    
                                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    foreach($general as $gen)
                                    {
                                    ?>
                                    <tr>
                                    <th><?php echo $gen['session']; ?></th>
                                    <th><?php echo $gen['cur_title']; ?></th>
                                     <th><?php echo $gen['cur_title_subpage']; ?></th>
                                    <th><?php echo $gen['cur_createddate']; ?></th>
                                    
                                    <th>
                                    <?php
                                    if($gen['is_activestatus']==1)
                                    {
                                        ?>
                                     <i class="fa fa-check-circle text-success" style="font-size:20px;"></i>
                                    <?php }
                                    else
                                    {
                                        ?>
                                    <i class="fa fa-times-circle text-danger" style="font-size:20px;"></i>
                                    <?php
                                        
                                    }
                                    
                                    ?>
                                    </th>
                                    
                                    <th class="text-right">
                                        
                                    <a data-placement="left" href="<?php echo base_url(); ?>entrance_settings/currentsettings/edit/<?php echo $gen['cur_id']; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fa fa-pencil"></i>
                                    </a>
                                    
                                    <a data-placement="left" href="<?php echo base_url(); ?>entrance_settings/currentsettings/delete/<?php echo $gen['cur_id']; ?>" class="btn btn-default btn-xs"  onclick="return doconfirm();"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                                    <i class="fa fa-trash" style="color:red;"></i>
                                     </a>
                                     
                                    </th>
                                    </tr>
                                    <?php } ?>
                             

                                </tbody>
                            </table>
                          
                            <!-- /.table -->

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
        function doconfirm()
        {
        var job=confirm('Do you want To Delete');
        
        if(job==true)
        {
        return true;
        }
        else
        {
        return false;  
        }
        }
        
        
</script>
