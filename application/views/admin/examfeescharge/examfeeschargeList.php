<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
    <i class="fa fa-money"></i> <?php echo ('Exam Fees Charge'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <?php
    if ($this->rbac->hasPrivilege('examfees_charge', 'can_add')) {
        ?>
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo ('Add Exam Fees Charge'); ?></h3>
    </div><!-- /.box-header -->
    <form id="form1" action="<?php echo base_url() ?>admin/examfeescharge/create"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
        <div class="box-body">
                <?php  /*if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php }  */ ?>
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
            }
            ?>
            <?php echo $this->customlib->getCSRF(); ?>

            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Exam Option'); ?></label> <small class="req">*</small>
                <select class="form-control" name="examoption" id="examoption" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="Improvement" <?php if (set_value('examoption') == 'Improvement') { echo "selected=selected"; } ?>>Improvement</option>
                <option value="Sayexam" <?php if (set_value('examoption') == 'Sayexam') { echo "selected=selected"; } ?>>Sayexam</option>
                <option value="Revaluation" <?php if (set_value('examoption') == 'Revaluation') { echo "selected=selected"; } ?>>Revaluation</option>
                </select>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
            

            <div class="form-group">
                <label><?php echo ('Exam Group'); ?><small class="req">  *</small></label>
                    <select class="form-control" name="examgroups_id" id="examgroups_id" required>
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        <?php foreach ($examgroups as $grps) {
                            ?>
                            <option value="<?php echo $grps['id'] ?>" <?php if (set_value('examgroup_id') == $grps['id']) { echo "selected=selected"; } ?>><?php echo $grps['name'] ?></option> 
                        <?php } ?>
                    </select>
            </div>

            <div class="form-group">
                <label><?php echo ('Exam'); ?><small class="req">  *</small></label>
                <select class="form-control" name="exam_id" id="exam_id" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Exam Type'); ?></label> <small class="req">*</small>
                <select class="form-control" name="examtype" id="examtype" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="CE" <?php if (set_value('examtype') == 'CE') { echo "selected=selected"; } ?>>CE</option>
                <option value="TE" <?php if (set_value('examtype') == 'TE') { echo "selected=selected"; } ?>>TE</option>
                <option value="Mixed" <?php if (set_value('examtype') == 'Mixed') { echo "selected=selected"; } ?>>Mixed</option>
                </select>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>

            <div class="form-group">
                <label><?php echo ('Fees Charge'); ?><small class="req">  *</small></label>
                <input type="text" class="form-control"  id="feescharge" name="feescharge" required/>
            </div>
            
            
            
            
            

            <div class="form-group">
                <label><?php echo ('Processing Charge'); ?><small class="req">  *</small></label>
                <input type="text" class="form-control"  id="processingcharge" name="processingcharge" required/>
            </div>
            
            
                <div class="form-group">
                <label><?php echo $this->lang->line('fine'); ?><small class="req">  *</small></label>
                <input type="text" class="form-control"  id="fine" name="fine" required/>
            </div>
            
            
            
            
            
             <div class="form-group">
                <label><?php echo $this->lang->line('last').'&nbsp;'.$this->lang->line('date'); ?><small class="req">  *</small></label>
                <input type="date" class="form-control"  id="lastdate" name="lastdate" required/>
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
    if ($this->rbac->hasPrivilege('examfees_charge', 'can_add')) {
        echo "8";
    } else {
        echo "12";
    }
    ?>">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><?php echo ('Exam Fees Charge List'); ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="download_label"><?php echo ('Exam Fees Charge List'); ?></div>
                <div class="mailbox-messages table-responsive">
                    <table class="table table-striped table-bordered table-hover example">
                        <thead>
                            <tr>
                                <th><?php echo ('Exam Option'); ?> </th>
                                <th><?php echo ('Exam Groups'); ?> </th>
                                <th><?php echo ('Exam'); ?> </th>
                                <th><?php echo ('Exam Type'); ?> </th>
                                <th><?php echo ('Fees Charge'); ?> </th>
                                <th><?php echo ('Processing Charge'); ?> </th>
                                <th><?php echo ('Session'); ?> </th>
                                <th><?php echo ('Active'); ?> </th>
                                <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($examfeeschargeList)) {
                            foreach ($examfeeschargeList as $examfeescharge) {
                                ?>
                                <tr>
                                    <td class="mailbox-name">
                                        <?php echo $examfeescharge['examfees_charge_examoption'] ?>                                     
                                    </td>
									<td class="mailbox-name"> 
                                        <?php echo $examfeescharge['name']; ?>
                                            
                                        </td>
                                        <td class="mailbox-name"> 
                                        <?php echo $examfeescharge['batchexamname']; ?>
                                            
                                        </td>
                                        <td class="mailbox-name"> 
                                        <?php echo $examfeescharge['examfees_charge_examtype']; ?>
                                            
                                        </td>
                                        <td class="mailbox-name"> 
                                        <?php echo $examfeescharge['examfees_charge_fees_charge']; ?>
                                            
                                        </td>
                                        <td class="mailbox-name"> 
                                        <?php echo $examfeescharge['examfees_charge_processing_charge']; ?>
                                            
                                        </td>
                                        <td class="mailbox-name"> 
                                        <?php echo $examfeescharge['session']; ?>
                                            
                                        </td>
                                        <td class="mailbox-name"> 
                                        <?php if(($examfeescharge['examfees_charge_exam_is_active']) == 0) {
                                                echo "Disabled";
                                            }
                                            else {
                                                echo "Enabled";
                                            } ?>
                                            
                                        </td>  
                                    <td class="mailbox-date pull-right">
                                        <?php
                                        if ($this->rbac->hasPrivilege('examfees_charge', 'can_edit')) {
                                            ?>
                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/examfeescharge/edit/<?php echo $examfeescharge['examfees_charge_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        <?php } ?>
                                        <?php
                                        if ($this->rbac->hasPrivilege('examfees_charge', 'can_delete')) {
                                            ?>
                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/examfeescharge/delete/<?php echo $examfeescharge['examfees_charge_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
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
<!-- <script>
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
</script> -->
<script type="text/javascript">

    $(document).on('change', '#examgroups_id', function (e) {
        $('#exam_id').html("");
        var examgroups_id = $(this).val();
        getExamByExamgroup(examgroups_id,exam_id);
    });

    function getExamByExamgroup(examgroups_id,exam_id) 
    {
        //alert(sub_course);
        var examgroups_id = $('#examgroups_id').val();
        if (examgroups_id != "") {
            $('#exam_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "admin/examfeescharge/selectexam",
                data: {'examgroups_id': examgroups_id},
                dataType: "json",
                success: function (data) 
                {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id  + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                },
            });
        }
    }

</script>