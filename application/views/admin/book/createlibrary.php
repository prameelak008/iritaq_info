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
                            <h3 class="box-title"><?php echo ('Add Library'); ?></h3>
                        </div><!-- /.box-header -->

                        <form id="form1" action="<?php echo site_url('Library/addlibrary'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
 								<!-- name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Library Name'); ?><small class="req"> *</small></label>
                                    <input type="text" name="name" placeholder="Name" class="form-control"  required>
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                <!-- code -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Library Code'); ?><small class="req"> *</small></label>
                                    <input type="text" name="code" placeholder="Code" class="form-control" required>
                                </div>
                                <!-- location -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Location'); ?><small class="req"> *</small></label>
                                    <input type="text" name="location" placeholder="Location" class="form-control" required>
                                </div>
                                <!-- details -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Details'); ?><small class="req"> *</small></label>
                                    <input type="text" name="details" placeholder="Details" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Status'); ?><small class="req"> *</small></label>
                                   <select class="form-control" name="status" required="">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <option value="1"><?php echo "Yes"; ?></option>
                                        <option value="0"><?php echo "No"; ?></option>
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
           <!--  <?php } ?> -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo ('Library List'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       
                        <div class="table-responsive mailbox-messages">
                                 <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Library List'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo ('Library Name'); ?>
                                        </th>
                                        <th><?php echo ('Library Code'); ?>
                                        </th>
                                        <th><?php echo ('Location'); ?>
                                        </th>
                                        <th><?php echo ('Details'); ?>
                                        </th>
                                        <th><?php echo ('Status'); ?>
                                        </th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	 <?php
										$count = 0;
										foreach ($librarylist as $liblist) { ?>
										    <tr>                                                  
										    <td><?php echo $liblist['library_name']; ?></td>
										    <td><?php echo $liblist['library_code']; ?></td>
                                            <td><?php echo $liblist['library_location']; ?></td>
                                            <td><?php echo $liblist['library_details']; ?></td>
                                            <td><?php if($liblist['library_status']==1)
                                                        {
                                                            echo "Yes";
                                                        }
                                                        else {
                                                            echo "No";
                                                        } ?>
                                            </td>
										    <td align="right">
                                                <a data-placement="left" href="<?php echo site_url('Library/editlibrary/' . $liblist['library_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                                <a data-placement="left" href="<?php echo site_url('Library/deletelibrary/' . $liblist['library_id']); ?>" class="btn btn-default btn-xs" id="delclk" data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
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

















