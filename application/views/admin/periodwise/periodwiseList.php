<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('period_time_settings'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('period_time_settings', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        
                        <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('period_time_settings'); ?></h3>
                        </div><!-- /.box-header -->
                        
                        <form id="form1" action="<?php echo base_url() ?>admin/period_wise"  id="periodwise" name="periodwise" method="post" accept-charset="utf-8">
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
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label> <small class="req">*</small>
                                    <input autofocus="" id="name" name="name" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('fromtime'); ?></label> <small class="req">*</small>
                                    <input id="fromtime" name="fromtime" type="time" class="form-control"  value="<?php echo set_value('fromtime'); ?>" />
                                    <span class="text-danger"><?php echo form_error('fromtime'); ?></span>
                                </div>
                                
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('totime'); ?></label> <small class="req">*</small>
                                    <input id="totime" name="totime" type="time" class="form-control"  value="<?php echo set_value('totime'); ?>" />
                                    <span class="text-danger"><?php echo form_error('totime'); ?></span>
                                   </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"></span>
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
            if ($this->rbac->hasPrivilege('period_time_settings', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                       
                       
                        <h3 class="box-title"><?php echo $this->lang->line('period_time_settings').'&nbsp;'.$this->lang->line('list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('period_time_settings'); ?></div>
                        <div class="mailbox-messages table-responsive">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('fromtime'); ?></th>
                                        <th><?php echo $this->lang->line('totime'); ?></th>
                                        <th><?php echo $this->lang->line('count'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($periodwise as $period) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                               <?php echo $period['periodic_table_name']; ?>
                                              
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $period['periodic_table_timefrom']; ?>
                                            </td>
                                            
                                              <td class="mailbox-name">
                                                <?php echo $period['periodic_table_timeto']; ?>
                                              </td>
                                              
                                              
                                                 <td class="mailbox-name">
                                                 <?php echo $period['periodic_table_count']; ?>
                                                 </td>
                                              
                                              
                                              
                                            
                                             <td class="mailbox-name">
                                                <?php if($period['periodic_table_status']==1)
                                                {
                                                    echo "Active";
                                                }
                                                else
                                                {
                                                   echo "In Active";   
                                                }
                                                ; ?>
                                            </td>

                                            <td class="mailbox-date pull-right">
                                                <?php
                                                
                                                if ($this->rbac->hasPrivilege('period_time_settings', 'can_edit')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/period_wise/edit/<?php echo $period['periodic_table_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                if ($this->rbac->hasPrivilege('period_time_settings', 'can_delete')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/period_wise/delete/<?php echo $period['periodic_table_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } 
                                                
                                                
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
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
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


