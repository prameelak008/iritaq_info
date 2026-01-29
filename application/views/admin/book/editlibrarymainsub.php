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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('Library'); ?></h1>
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
                            <h3 class="box-title"><?php echo ('Edit Library'); ?></h3>
                        </div><!-- /.box-header -->

                        <form id="form1" action="<?php echo site_url('Librarymainsub/updatemainsub'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <!-- name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Library Name'); ?><small class="req"> *</small></label>
                                    <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $mainsubedit->lib_mainsub_name; ?>" required>
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Status'); ?><small class="req"> *</small></label>
                                <select class="form-control" name="status" required>
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <option value="1" <?php if($mainsubedit->lib_mainsub_status==1)
                                {
                                echo "selected=selected";
                                }?>><?php echo "Yes"; ?></option>
                                <option value="0" <?php if($mainsubedit->lib_mainsub_status==0)
                                {
                                echo "selected=selected";
                                }?>><?php echo "No"; ?></option>
                                </select>
                                </div>

            <input type="hidden" name="mainsubid" placeholder="ID" class="form-control" value="<?php echo $mainsubedit->lib_mainsub_id; ?>" required>
                
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
                        <h3 class="box-title titlefix"> <?php echo ('Main Subject List'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       
                        <div class="table-responsive mailbox-messages">
                                 <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Main Subject List'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo ('Name'); ?>
                                        </th>
                                        <th><?php echo ('Status'); ?>
                                        </th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                        $count = 0;
                                        foreach ($mainsublist as $sublist) { ?>
                                            <tr>                                                  
                                            <td><?php echo $sublist['lib_mainsub_name']; ?></td>
                                            <td><?php if($sublist['lib_mainsub_status']==1)
                                                        {
                                                            echo "Yes";
                                                        }
                                                        else {
                                                            echo "No";
                                                        } ?>
                                            </td>
                                            <td align="right">
                                                <a data-placement="left" href="<?php echo site_url('Librarymainsub/editmainsub/' . $sublist['lib_mainsub_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                                <a data-placement="left" href="<?php echo site_url('Librarymainsub/deletemainsub/' . $sublist['lib_mainsub_id']); ?>" class="btn btn-default btn-xs" id="delclk" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
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

















