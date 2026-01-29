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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('Subject'); ?></h1>
    </section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary" style="padding-bottom: 100px">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo ('Edit Subject Type'); ?></h3>
    </div><!-- /.box-header -->

    <form id="form1" action="<?php echo site_url('entrance_allotment/Entrance_subjecttype/updatesubjecttype'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="box-body">
                 <?php
                    $count = 0;
                    foreach ($subjecttypeedit as $subedit) { ?>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                <input type="text" name="sub_name" placeholder="Name" class="form-control" value="<?php echo $subedit->entrance_subtype_name; ?>" required>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Code'); ?><small class="req"> *</small></label>
                <input type="text" name="sub_code" placeholder="Code" class="form-control" value="<?php echo $subedit->entrance_subtype_code; ?>" required>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
           <!--  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Type'); ?><small class="req"> *</small></label>
                <input type="text" name="sub_type" placeholder="Type" class="form-control" value="<?php echo $subedit->entrance_subtype_type; ?>" required>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div> -->
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Type'); ?><small class="req"> *</small></label>
                <label class="radio-inline">
                    <input type="radio" value="<?php echo "practical"; ?>" name="sub_type" <?php if($subedit->entrance_subtype_type=='practical')
                                    {
                                    echo "checked=checked";
                                    }?>>Practical
                </label>
                <label class="radio-inline">
                    <input type="radio" value="<?php echo "theory"; ?>" name="sub_type" <?php if($subedit->entrance_subtype_type=='theory')
                                    {
                                    echo "checked=checked";
                                    }?>>Theory
                </label>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Status'); ?><small class="req"> *</small></label>
                <select class="form-control" name="sub_status" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <option value="1" <?php if($subedit->entrance_subtype_is_active==1)
                    {
                    echo "selected=selected";
                    }?>><?php echo "Yes"; ?></option>
                    <option value="0" <?php if($subedit->entrance_subtype_is_active==0)
                    {
                    echo "selected=selected";
                    }?>><?php echo "No"; ?></option>
                </select>
            </div>
            <input type="hidden" name="sub_id" placeholder="ID" class="form-control" value="<?php echo $subedit->entrance_subtype_id; ?>" required>
                <?php
                    $count++;
                    }
                    ?> 
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
    <h3 class="box-title titlefix"> <?php echo ('Subject List'); ?></h3>
    <div class="box-tools pull-right">
    </div><!-- /.box-tools -->
</div><!-- /.box-header -->
<div class="box-body">
   
    <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Allotment Seat Type List'); ?>">
            
            <thead>
                <tr>
                    <th><?php echo ('Name'); ?>
                    </th>
                    <th><?php echo ('Code'); ?>
                    </th>
                    <th><?php echo ('Type'); ?>
                    </th>
                    <th><?php echo ('Status'); ?>
                    </th>
                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
            </thead>
            <tbody>
                 <?php
                    $count = 0;
                    foreach ($subjecttypelist as $sublist) { ?>
                        <tr> 
                        <td><?php echo $sublist['entrance_subtype_name']; ?></td>
                        <td><?php echo $sublist['entrance_subtype_code']; ?></td>
                        <td style="text-transform: capitalize;"><?php echo $sublist['entrance_subtype_type']; ?></td>
                        <td><?php if($sublist['entrance_subtype_is_active']==1)
                        {
                            echo "Yes";
                        }
                        else {
                            echo "No";
                        } ?></td>
                        <td align="right">
                            <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entrance_subjecttype/editsubjecttype/' . $sublist['entrance_subtype_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                            <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entrance_subjecttype/deletesubjecttype/' . $sublist['entrance_subtype_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
                        </td>
                       
                        </tr>                                        
                        <?php
                    $count++;
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

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
 <!--  <script>
    ( function ( $ ) {
    'use strict';
    $(document).ready(function () {
        initDatatable('income-list','admin/income/getincomelist',[],[],100);
    });
} ( jQuery ) )
</script>  -->
<script type="text/javascript">
 $(document).ready(function (e) {
        $("#form1").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("entrance_allotment/Entrance_subjecttype/updatesubjecttype") ?>",
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





