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
            if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('template'); ?></h3>
                        </div><!-- /.box-header -->
                        
                        <form id="form1" action="<?php echo site_url('entrance_settings/template/create'); ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                            <div class="box-body">                            
                                <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('template').'&nbsp;'.$this->lang->line('name'); ?></label><small class="req"> *</small>
                                <input type="text" name="templatename"  class="form-control" />
                                <span class="text-danger"><?php echo form_error('templatename'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1">Instruction</label> 
                                <textarea name="instruction" id="instruction"  rows="6" class=" form-control ckeditor" required="required"></textarea>
                                </div>
                                
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
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
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('template').'&nbsp;'.$this->lang->line('list'); ?></h3>
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
                                        <th><?php echo $this->lang->line('template').'&nbsp;'.$this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('template'); ?></th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($template as $temp)
                                    {
                                    ?>
                                    <tr>
                                    <th><?php echo $temp['set_template_name']; ?></th>
                                    <th><?php echo $temp['set_template_instruction']; ?></th>
                                    <th class="text-right ">
                                        
                                    <a data-placement="left" href="<?php echo base_url(); ?>entrance_settings/template/edit/<?php echo $temp['set_template_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        
                                                        
                                                        
                                    <a data-placement="left" href="<?php echo base_url(); ?>entrance_settings/template/delete/<?php echo $temp['set_template_id'] ?>" class="btn btn-default btn-xs"  onclick="return doconfirm();"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                                    <i class="fa fa-trash" style="color:red;"></i>
                                     </a></th>
                                    </tr>
                                    
                                    
                                    <?php } ?>
                             

                                </tbody>
                            </table><!-- /.table -->

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
