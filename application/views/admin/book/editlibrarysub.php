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
    <i class="fa fa-usd"></i> <?php echo $this->lang->line('subject'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <!-- <?php
    if ($this->rbac->hasPrivilege('income', 'can_add')) {
        ?> -->
        <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-primary" style="padding-bottom: 100px">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo ('Edit Subject'); ?></h3>
                </div><!-- /.box-header -->

                <form id="form1" action="<?php echo site_url('Librarysub/updatelibrarysub'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="box-body">
                        <!-- name -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo ('Subject Name'); ?><small class="req"> *</small></label>
                            <input type="text" name="subname" placeholder="Name" class="form-control"  required value="<?php echo $libsubedit->lib_sub_name; ?>">
                            <span class="text-danger"><?php echo form_error('name'); ?></span>
                        </div>
                        <!-- type -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo ('Subject Type'); ?><small class="req"> *</small></label>
                            <label class="radio-inline">
                                <input type="radio" value="<?php echo "Main"; ?>" name="subtype" <?php if($libsubedit->lib_sub_type=='Main')
                                                {
                                                echo "checked=checked";
                                                }?>>Main
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="<?php echo "Sub"; ?>" name="subtype" <?php if($libsubedit->lib_sub_type=='Sub')
                                                {
                                                echo "checked=checked";
                                                }?>>Sub
                            </label>
                            <!-- <?php $maintype = $libsubedit->lib_sub_type;?> -->
                        </div>
                    <div id="textboxes" style="display: none">
                        <!-- main sub -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo ('Select Main subject'); ?><small class="req"> *</small></label>
                            <!-- <input type="text" name="mainsub" placeholder="Main Subject" class="form-control" required> -->
                            <!-- <select class="form-control" name="mainsub" required>
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <option value="Main Sub1"><?php echo "Main Sub1"; ?></option>
                                <option value="Main Sub2"><?php echo "Main Sub2"; ?></option>
                            </select> -->
                             <select class="form-control" id="mainsub" name="mainsub"required>
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <?php foreach($mainsublist as $list){ ?>
                                <option value="<?php echo $list['lib_mainsub_id']; ?>" <?php if($list['lib_mainsub_id']==$libsubedit->lib_sub_mainsub)
                            {
                            echo "selected=selected";
                            }?>><?php echo $list['lib_mainsub_name']; ?></option>
                            <?php } ?>
                            </select> 
                        </div>
                    </div>
                    <!-- ddc -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo ('DDC Call Number'); ?><small class="req"> *</small></label>
                            <input type="text" id="ddcno" name="ddcno" placeholder="DDC Call Number" class="form-control" value="<?php echo $libsubedit->lib_sub_ddcno; ?>" required>
                        </div>
                        <!-- local -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo ('Local Call Number'); ?></label>
                            <input type="text" id="localno" name="localno" placeholder="Local Call Number" class="form-control" value="<?php echo $libsubedit->lib_sub_localno; ?>">
                        </div>
                    <!-- status -->
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo ('Status'); ?><small class="req"> *</small></label>
                           <select class="form-control" name="substatus" required="">
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <option value="1" <?php if($libsubedit->lib_sub_status==1)
                                    {
                                    echo "selected=selected";
                                    }?>><?php echo "Yes"; ?></option>
                                    <option value="0" <?php if($libsubedit->lib_sub_status==0)
                                    {
                                    echo "selected=selected";
                                    }?>><?php echo "No"; ?></option>
                            </select>
                        </div>
                        <input type="hidden" name="libsubid" placeholder="ID" class="form-control" value="<?php echo $libsubedit->lib_sub_id; ?>" required>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </div>
                </form>
            </div>

        </div><!--/.col (right) -->
        <!-- left column -->
   <!--  <?php } ?> -->
    <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header ptbnull">
                <h3 class="box-title titlefix"> <?php echo ('Library Subject List'); ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
               
                <div class="table-responsive mailbox-messages">
                         <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Library Subject List'); ?>">
                        <thead>
                            <tr>
                                <th><?php echo ('Name'); ?>
                                </th>
                                <th><?php echo ('Type'); ?>
                                </th>
                                <th><?php echo ('Main Subject'); ?>
                                </th>
                                <th><?php echo ('DDC Call Number'); ?>
                                </th>
                                <th><?php echo ('Local Call Number'); ?>
                                </th>
                                <th><?php echo ('Status'); ?>
                                </th>
                                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                $count = 0;
                                foreach ($librarysublist as $sublist) { ?>
                                    <tr>                                                  
                                    <td><?php echo $sublist['lib_sub_name']; ?></td>
                                    <td><?php echo $sublist['lib_sub_type']; ?></td>
                                    <td><?php echo $sublist['lib_mainsub_name']; ?></td>
                                    <td><?php echo $sublist['lib_sub_ddcno']; ?></td>
                                    <td><?php echo $sublist['lib_sub_localno']; ?></td>
                                    <td><?php if($sublist['lib_sub_status']==1)
                                                {
                                                    echo "Yes";
                                                }
                                                else {
                                                    echo "No";
                                                } ?>
                                    </td>
                                    <td align="right">
                                        <a data-placement="left" href="<?php echo site_url('Librarysub/editlibrarysub/' . $sublist['lib_sub_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                        <a data-placement="left" href="<?php echo site_url('Librarysub/deletelibrarysub/' . $sublist['lib_sub_id']); ?>" class="btn btn-default btn-xs" id="delclk" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
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
<script type="text/javascript">
    $(function() {

    $('input[name="subtype"]').on('click', function() {
        if ($(this).val() == 'Sub') {
            $('#textboxes').show();
        }
        else {
            $('#textboxes').hide();

        }
    });
    $( document ).ready(function() {
        var typeval= $("[name=subtype]:checked").val();
         if(typeval=='Sub')
         {
            $('#textboxes').show();
         }
    });
    $('input[name="subtype"]').click(function() {
      var tval= $("[name=subtype]:checked").val();
      if(tval=='Main')
         {
            document.getElementById("mainsub").value = "";
         }
    });
});
</script>
<!-- <script type="text/javascript">
$(document).ready(function (e) {
$("#form1").on('submit', (function (e) {
    e.preventDefault();
    $.ajax({
        url: "<?php echo site_url("EntranceExam/addcenter") ?>",
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
$("#delclk").on('click', (function (e) {
    e.preventDefault();
    $.ajax({
        url: "<?php echo site_url('EntranceExam/deletecenter/' . $ctrlist['entranceexam_centreid']); ?>",
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
</script> -->

















