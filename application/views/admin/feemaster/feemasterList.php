                <style type="text/css">
                .liststyle1 {
                margin: 0;
                list-style: none;
                line-height: 28px;
                }
                


                .bootstrap-multiselect .dropdown-menu {
                max-height: 200px;
                overflow-y: auto;
                }


                </style>


                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

                <?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">

                <section class="content-header">
                <h1>
                <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="row">
                <?php if ($this->rbac->hasPrivilege('fees_master', 'can_add')) {
                ?>
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('add_fees_master') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>
                </div><!-- /.box-header -->
                <form id="form1" action="<?php echo base_url() ?>admin/feemaster"  id="feemasterform" name="feemasterform" method="post" accept-charset="utf-8" class="common-reset-form" >
                <div class="box-body">
                 <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>

                <?php echo $this->customlib->getCSRF(); ?>
                <div class="row">
                <div class="col-md-12">

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_group'); ?></label> <small class="req">*</small>

                <select autofocus="" id="fee_groups_id" name="fee_groups_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                foreach ($feegroupList as $feegroup) {
                ?>
                <option value="<?php echo $feegroup['id'] ?>"<?php
                if (set_value('fee_groups_id') == $feegroup['id']) {
                echo "selected =selected";
                }
                ?>><?php echo $feegroup['name'] ?></option>

                <?php
                $count++;
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('fee_groups_id'); ?></span>
                </div>

                <div class="form-group" style="visibility:hidden">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_type'); ?></label><small class="req"> *</small>

                <select  id="feetype_id" name="feetype_id" class="form-control" >
                <!--<option value=""><?php echo $this->lang->line('select'); ?></option>-->
                <?php
                foreach ($feetypeList as $feetype) {
                ?>
                <option value="<?php echo $feetype['id'] ?>"<?php
                if (set_value('feetype_id') == $feetype['id']) {
                echo "selected =selected";
                }
                ?>><?php echo $feetype['type'] ?></option>

                <?php
                $count++;
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('feetype_id'); ?></span>
                </div>




                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('fees_type'); ?></label><small class="req"> *</small>
                <select id="ftype" name="ftype[]" multiple class="form-control" >						    
                <?php foreach ($feetypeList as $feetype) {
                ?>
                <option value="<?php echo $feetype['id'] ?>"<?php
                if (set_value('feetype_id') == $feetype['id']) {
                echo "selected =selected";
                }
                ?>><?php echo $feetype['type'] ?></option>

                <?php
                $count++;
                }
                ?>
                </select>		
                <span class="text-danger"><?php echo form_error('feetype_id'); ?></span>
                </div>


                <script>
$(document).ready(function () {
$('#ftype').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
maxHeight: 200, // Controls visible height of dropdown
buttonWidth: '100%' // Optional: makes the button match form-control width
});
});
</script>


                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('due_date'); ?></label><small class="req" id="due_date_error"> </small>
                <input id="due_date" name="due_date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('due_date'); ?>" />
                <span class="text-danger"><?php echo form_error('due_date'); ?></span>
                </div>

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label><small class="req"> *</small>
                <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />
                <span class="text-danger"><?php echo form_error('amount'); ?></span>
                </div>

                <div class="col-sm-12">
                <div class="form-group">
                <label for="input-type"><?php echo $this->lang->line('fine') . " " . $this->lang->line('type') ?></label>
                
                
                <div id="input-type" class="row">
                <div class="col-sm-4">
                <label class="radio-inline">
                <input name="account_type" class="finetype" id="input-type-student" value="none" type="radio" <?php echo set_radio('account_type', 'none', true); ?>/><?php echo $this->lang->line('none') ?>
                </label>
                </div>

                <div class="col-sm-4">
                <label class="radio-inline">
                <input name="account_type" class="finetype" id="input-type-student" value="percentage" type="radio" <?php echo set_radio('account_type', 'percentage', set_value('percentage')); ?> /><?php echo $this->lang->line('percentage'); ?>
                </label>
                </div>

                <div class="col-sm-4">
                <label class="radio-inline">
                <input name="account_type" class="finetype" id="input-type-tutor" value="fix" type="radio"  <?php echo set_radio('account_type', 'fix', set_value('fix')); ?> />
                <?php echo $this->lang->line('fix') . " " . $this->lang->line('amount') ?>
                </label>
                </div>
                </div>

                </div>
                </div>
                </div>


                <div class="col-md-6 fine_percent_t" >
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('percentage') ?></label><small class="req" > *</small>
                <input id="fine_percentage" name="fine_percentage" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fine_percentage'); ?>" />
                <span class="text-danger"><?php echo form_error('fine_percentage'); ?></span>
                </div>
                </div> 
                
                
                <div class="col-md-6 fine_amt_t" >
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('fine') . " " . $this->lang->line('amount') ?></label><small class="req" > *</small>
                <input id="fine_amount" name="fine_amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('fine_amount'); ?>" />
                <span class="text-danger"><?php echo form_error('fine_amount'); ?></span>
                </div>
                </div> 

 
                </div>
                </div><!-- /.box-body -->

                <div class="box-footer">

                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                
            
                                  <button type="button" id="resetBtn" class="btn btn-warning pull-right  custombtn"><?php echo $this->lang->line('reset'); ?></button>


                          



            </div>
                </form>
                </div>

                </div><!--/.col (right) -->
                <!-- left column -->
                <?php } ?>
                <div class="col-md-<?php
                if ($this->rbac->hasPrivilege('fees_master', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></h3>

                </div><!-- /.box-header -->

                <div class="box-body">
                <div class="download_label"><?php echo $this->lang->line('fees_master_list') . " : " . $this->setting_model->getCurrentSessionName(); ?></div>
                <div class="mailbox-messages">
                <div class="table-responsive">  
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr>
                <th><?php echo $this->lang->line('fees_group'); ?></th>
                <th><?php echo $this->lang->line('fees_code'); ?></th>

                <th class="noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($feemasterList as $feegroup) {
                ?>
                <tr>
                <td class="mailbox-name">
                <?php echo $feegroup->group_name; ?>
                </td>


                <td class="mailbox-name">
                <ul class="liststyle1">
                <?php
                foreach ($feegroup->feetypes as $feetype_key => $feetype_value) {
                ?>
                <li> <i class="fa fa-money"></i>
                    <?php echo $feetype_value->code . " " . $currency_symbol . $feetype_value->amount; ?> &nbsp;&nbsp;
                    <?php if ($this->rbac->hasPrivilege('fees_master', 'can_edit')) { ?>
                        <a href="<?php echo base_url(); ?>admin/feemaster/edit/<?php echo $feetype_value->id ?>"   data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <?php
                    }
                    if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) {
                        ?>
                        <a href="<?php echo base_url(); ?>admin/feemaster/delete/<?php echo $feetype_value->id ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                            <i class="fa fa-remove"></i>
                        </a>
                    <?php } ?>

                </li>

                <?php
                }
                ?>
                </ul>
                </td>

                <td class="mailbox-date ">
                <?php if ($this->rbac->hasPrivilege('fees_group_assign', 'can_view')) { ?>
                <a data-placement="left" href="<?php echo base_url(); ?>admin/feemaster/assign/<?php echo $feegroup->id ?>"
                class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line('assign / view'); ?>">
                <i class="fa fa-tag"></i>
                </a>
                <?php } ?>
                <?php if ($this->rbac->hasPrivilege('fees_master', 'can_delete')) { ?>
                <a data-placement="left" href="<?php echo base_url(); ?>admin/feemaster/deletegrp/<?php echo $feegroup->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                <i class="fa fa-remove"></i>
                </a>
                <?php } ?>

                </td>
                </tr>
                <?php
                }
                ?>

                </tbody>
                </table><!-- /.table -->
                </div>  
                </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->


                </form>
                </div>

                </div><!--/.col (right) -->
                <!-- left column -->


                </div>

                </section><!-- /.content -->
                </div><!-- /.content-wrapper -->


                <script type="text/javascript">
                $(document).ready(function () {
                var account_type = "<?php echo set_value('account_type', 0); ?>";
                load_disable(account_type); 

                });

                $(document).on('change', '.finetype', function () {
                calculatefine();
                });


                $(document).on('keyup', '#amount,#fine_percentage', function () { 
                calculatefine();
                });


                function load_disable(account_type) {
                if (account_type === "percentage") {
                $('#due_date_error').html(' *');
                $('#fine_amount').prop('readonly', true);
                $('#fine_percentage').prop('readonly', false);
                } else if (account_type === "fix") {
                $('#due_date_error').html(' *');
                $('#fine_amount').prop('readonly', false);
                $('#fine_percentage').prop('readonly', true);
                } else {
                $('#due_date_error').html('');
                $('#fine_amount').prop('readonly', true);
                $('#fine_percentage').prop('readonly', true);
                }
                }



                function calculatefine() {
                var amount = $('#amount').val();
                var fine_percentage = $('#fine_percentage').val();

                var finetype = $('input[name=account_type]:checked', '#form1').val();

                if (finetype === "percentage") {
                $('#due_date_error').html(' *');
                fine_amount = ((amount * fine_percentage) / 100).toFixed(2);
                $('#fine_amount').val(fine_amount).prop('readonly', true);
                $('#fine_percentage').prop('readonly', false);
                } else if (finetype === "fix") {
                $('#due_date_error').html(' *');
                $('#fine_amount').val("").prop('readonly', false);
                $('#fine_percentage').val("").prop('readonly', true);
                } else {
                $('#due_date_error').html('');
                $('#fine_amount').val("");
                $('#fine_percentage').val("");
                $('#fine_amount').prop('readonly', true);
                $('#fine_percentage').prop('readonly', true);
                }

                }

                $(document).ready(function () {
                $('.detail_popover').popover({
                placement: 'right',
                trigger: 'hover',
                container: 'body',
                html: true,
                content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
                }
                });
                });


                $(document).ready(function() {       
                $('#ftype').multiselect({		
                nonSelectedText: 'Select Teams'				
                });
                });





                $(document).ready(function () {  
                                 

                $('.fine_percent_t').hide();
                $('.fine_amt_t').hide();  

                $(document).on('change', '.finetype', function () {
                const selectedType = $(this).val(); // get selected value

                if (selectedType === 'percentage') {
                

                $('.fine_percent_t').show();
                $('.fine_amt_t').show();  


                } else if (selectedType === 'fix') {
                       $('.fine_percent_t').hide();
                $('.fine_amt_t').show();  


               
                } else if (selectedType === 'none') {


                $('.fine_percent_t').hide();
                $('.fine_amt_t').hide(); 
           
               
                }

                });

                // Optional: trigger on page load if needed (e.g. when editing a form)
                const checkedType = $('.finetype:checked').val();
                $('.finetype:checked').trigger('change');
                });


                </script>