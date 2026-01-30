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
        <h3 class="box-title"><?php echo ('Edit Subject'); ?></h3>
    </div><!-- /.box-header -->

    <form id="form1" action="<?php echo site_url('entrance_allotment/Entranceexam_subject/updatesubject'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="box-body">
                    <?php
                            $count = 0;
                            foreach ($subjectedit as $subedit) { ?>
                                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Select Course'); ?><small class="req"> *</small></label>
                    <select class="form-control" name="sub_course" required="">
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php foreach($courselist as $crslist){ ?>
                    <option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if($crslist['entranceexam_course_id']==$subedit->entranceexam_subject_course_id)
                                    {
                                    echo "selected=selected";
                                    }?>><?php echo $crslist['entranceexam_course_name']; ?></option>
                    <?php } ?>
                    </select>
                </div>
            <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Select Subject Type'); ?><small class="req"> *</small></label>
                    <select class="form-control" name="sub_subid" required="">
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php foreach($subjecttypelist as $stype){ ?>
                    <option value="<?php echo $stype['entrance_subtype_id']; ?>" <?php if($subedit->entranceexam_subject_subid==$stype['entrance_subtype_id'])
                    {
                    echo "selected=selected";
                    }?>><?php echo $stype['entrance_subtype_name']; ?></option>
                    <?php } ?>
                    </select>
            </div>
                <!--
                <div class="form-group">
                <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                <select  id="session" name="session" class="form-control select2"  >
                
                <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
                
                <?php
                
                
                foreach($sessionlist as $sess)
                {
                ?>
                
                <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
                
                <?php } ?>
                </select>
                
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                </div>
                -->
                                
                                
                                    
                                    
                                    
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Active'); ?><small class="req"> *</small></label>
                <select class="form-control" name="sub_status" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <option value="1" <?php if($subedit->entranceexam_subject_status==1)
                    {
                    echo "selected=selected";
                    }?>><?php echo "Yes"; ?></option>
                    <option value="0" <?php if($subedit->entranceexam_subject_status==0)
                    {
                    echo "selected=selected";
                    }?>><?php echo "No"; ?></option>
                </select>
            </div>
            <input type="hidden" name="sub_id" placeholder="ID" class="form-control" value="<?php echo $subedit->entranceexam_subject_id; ?>" required>
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
             <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Subject List'); ?>">
            <thead>
                <tr>
                    <th><?php echo ('Course'); ?>
                    </th>
                    <th><?php echo ('Subject Type'); ?>
                    </th>
                    <th><?php echo ('Active'); ?>
                    </th>
                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $count = 0;
                    foreach ($subjectlist as $sublist) { ?>
                        <tr>             
                        <td><?php echo $sublist['entranceexam_course_name']; ?></td>                                 
                        <td><?php echo $sublist['entrance_subtype_name']; ?></td>
                        <td><?php if($sublist['entranceexam_subject_status']==1)
                        {
                            echo "Yes";
                        }
                        else {
                            echo "No";
                        } ?></td>
                        <td align="right">
                            <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entranceexam_subject/editsubject/' . $sublist['entranceexam_subject_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                            <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entranceexam_subject/deletesubject/' . $sublist['entranceexam_subject_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
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
                url: "<?php echo site_url("entrance_allotment/Entranceexam_subject/updatesubject") ?>",
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





