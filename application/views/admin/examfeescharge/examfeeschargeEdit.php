<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
<i class="fa fa-money"></i> <?php echo $this->lang->line('examination'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<?php
if ($this->rbac->hasPrivilege('examfees_charge', 'can_add') || $this->rbac->hasPrivilege('examfees_charge', 'can_edit')) {
?>
<div class="col-md-4">
    <!-- Horizontal Form -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo ('Edit Exam Fees Charge'); ?></h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <form action="<?php echo site_url("admin/examfeescharge/edit/" . $examfees_charge_id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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
                <input name="examfees_charge_id " type="hidden" class="form-control"  value="<?php echo set_value('examfees_charge_id', $examchargeedit['examfees_charge_id']); ?>" required />

                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Exam Option'); ?></label> <small class="req">*</small>
                <select class="form-control" name="examoption" id="examoption" required>
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="Improvement" <?php if ('Improvement' == $examchargeedit['examfees_charge_examoption']) { echo "selected=selected"; } ?>>Improvement</option>
                <option value="Sayexam" <?php if ('Sayexam' == $examchargeedit['examfees_charge_examoption']) { echo "selected=selected"; } ?>>Sayexam</option>
                <option value="Revaluation" <?php if ('Revaluation' == $examchargeedit['examfees_charge_examoption']) { echo "selected=selected"; } ?>>Revaluation</option>
                </select>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
                </div>

            <div class="form-group">
                <label><?php echo ('Exam Group'); ?><small class="req">  *</small></label>
                        <select class="form-control" name="examgroups_id" id="examgroups_id" required>
                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                            <?php foreach ($examgroups as $grps) {
                                ?>
                                <option value="<?php echo $grps['id'] ?>" <?php if ($examchargeedit['examfees_charge_examgroup'] == $grps['id']) { echo "selected=selected"; } ?>><?php echo $grps['name'] ?></option> 
                            <?php } ?>
                        </select>
            </div>

            <div class="form-group">
                <label><?php echo ('Exam'); ?><small class="req">  *</small></label>
                <select class="form-control" name="exam_id" id="exam_id" required>
                    <option value="<?php echo $examchargeedit['batchexamid'] ?>"><?php echo $examchargeedit['batchexamname'] ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Exam Type'); ?></label> <small class="req">*</small>
                <select class="form-control" name="examtype" id="examtype" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="CE" <?php if ($examchargeedit['examfees_charge_examtype'] == 'CE') { echo "selected=selected"; } ?>>CE</option>
                <option value="TE" <?php if ($examchargeedit['examfees_charge_examtype'] == 'TE') { echo "selected=selected"; } ?>>TE</option>
                <option value="Mixed" <?php if ($examchargeedit['examfees_charge_examtype'] == 'Mixed') { echo "selected=selected"; } ?>>Mixed</option>
                </select>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>

            <div class="form-group">
                <label><?php echo ('Fees Charge'); ?><small class="req">  *</small></label>
                <input type="text" class="form-control"  id="feescharge" name="feescharge" value="<?php echo set_value('feescharge ', $examchargeedit['examfees_charge_fees_charge']); ?>"  required/>
            </div>
            
            <div class="form-group">
                <label><?php echo ('Processing Charge'); ?><small class="req">  *</small></label>
                <input type="text" class="form-control"  id="processingcharge" name="processingcharge" value="<?php echo set_value('processingcharge ', $examchargeedit['examfees_charge_processing_charge']); ?>" required/>
            </div>
            
            
            <div class="form-group">
                <label><?php echo $this->lang->line('fine'); ?><small class="req">  *</small></label>
                <input type="text" class="form-control"  id="fine" name="fine" value="<?php echo set_value('fine ', $examchargeedit['examfees_charge_fine']); ?>" required/>
            </div>
            
            
             <div class="form-group">
                <label><?php echo $this->lang->line('last').'&nbsp;'.$this->lang->line('date'); ?><small class="req">  *</small></label>
                <input type="date" class="form-control"  id="lastdate" name="lastdate" value="<?php echo set_value('lastdate ', $examchargeedit['examfees_charge_effectivedate']); ?>" required/>
             </div>
             
             
             

            <div class="form-group">
                <label><?php echo ('Active Status'); ?><small class="req">  *</small></label>
                <select class="form-control" name="active" id="active" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="1" <?php if ($examchargeedit['examfees_charge_exam_is_active'] == '1') { echo "selected=selected"; } ?>>Enable</option>
                <option value="0" <?php if ($examchargeedit['examfees_charge_exam_is_active'] == '0') { echo "selected=selected"; } ?>>Disable</option>
                </select>
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
if ($this->rbac->hasPrivilege('examfees_charge', 'can_add') || $this->rbac->hasPrivilege('examfees_charge', 'can_edit')) {
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

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#disable').change(function() {
            if ($('#disable').is(':checked')) {
                $('#disable').val('1');
            } else {
                $('#disable').val('0');
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