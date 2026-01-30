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
        <i class="fa fa-usd"></i> <?php echo $this->lang->line('Allotment Seat'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary" style="padding-bottom: 100px">
<div class="box-header with-border">
    <h3 class="box-title"><?php echo ('Add Allotment Seat'); ?></h3>
</div><!-- /.box-header -->

<form id="form1" action="<?php echo site_url('entrance_allotment/Entrance_allotmentseat/updateseat'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div class="box-body">
        
        
        
        <!--<div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Year'); ?><small class="req"> *</small></label>
            <select class="form-control" name="seat_year" required>
                <option value=""><?php echo $this->lang->line('select'); ?></option>
              <?php for ($i = 2022; $i <= 2050; $i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($i==$seatedit->entrance_allot_seat_year)
            {
            echo "selected=selected";
            }?>><?php echo $i; ?></option>
              <?php } ?>
            </select>
        </div>-->
        
        
        <input type="hidden" name="seat_year" id="seat_year" value="<?php echo date('Y'); ?>" />
        <!-- sessionlist -->
        <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Select Session'); ?><small class="req"> *</small></label>
            <select class="form-control" name="seat_session" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php foreach($sessionlist as $sslist){ ?>
            <option value="<?php echo $sslist['id']; ?>" <?php if($sslist['id']==$seatedit->entrance_allot_seat_sessionid)
            {
            echo "selected=selected";
            }?>><?php echo $sslist['session']; ?></option>
            <?php } ?>
            </select>
        </div>
       
        <!-- courselist -->
        <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Select Course'); ?><small class="req"> *</small></label>
            <select class="form-control" name="course_id" id="course_id" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php foreach($courselist as $crslist){ ?>
            <option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if($crslist['entranceexam_course_id']==$seatedit->entrance_allot_seat_course)
            {
            echo "selected=selected";
            }?>><?php echo $crslist['entranceexam_course_name']; ?></option>
            <?php } ?>
            </select>
        </div>
        <!--  institutelist -->
        <div class="form-group">
            <label><?php echo ('Institute'); ?></label> <small class="req"> *</small>
            <select id="institute_id" name="institute_id" class="form-control" >
                <option value="<?php echo $seatedit->entranceexam_insituteid; ?>"><?php echo $seatedit->entranceexam_insitutename; ?></option>
            </select>
              <span class="text-danger" id="error_class_id"></span>
        </div>
        
         <!--  centerlist -->
        <div class="form-group">
            <label><?php echo ('Center'); ?></label> <small class="req"> *</small>
            <select id="center_id" name="center_id" class="form-control" >
                <option value="<?php echo $seatedit->entranceexam_centreid; ?>"><?php echo $seatedit->entranceexam_centrename; ?></option>
            </select>
            <span class="text-danger" id="error_class_id"></span>
        </div>
      
        <!-- type list -->
        <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Select Seat Type'); ?><small class="req"> *</small></label>
                <select class="form-control" name="seat_type" required="">
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php foreach($seattypelist as $typelist){ ?>
                <option value="<?php echo $typelist['entrance_allot_type_id']; ?>" <?php if($typelist['entrance_allot_type_id']==$seatedit->entrance_allot_seat_type)
                {
                echo "selected=selected";
                }?>><?php echo $typelist['entrance_allot_type_name']; ?></option>
                <?php } ?>
                </select>
        </div> 
        
        
        
         <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Seat no'); ?><small class="req"> *</small></label>
            <input type="text" name="seat_seatno" placeholder="Seat no" class="form-control" value="<?php echo $seatedit->entrance_allot_seat_seatno; ?>" required>
            <span class="text-danger"><?php echo form_error('name'); ?></span>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Status'); ?><small class="req"> *</small></label>
            <!-- <select class="form-control" name="seat_status" required="">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="1"><?php echo "Yes"; ?></option>
                <option value="0"><?php echo "No"; ?></option>
            </select> -->
            <select class="form-control" name="seat_status" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <option value="1" <?php if($seatedit->entrance_allot_seat_status==1)
                    {
                    echo "selected=selected";
                    }?>><?php echo "Yes"; ?></option>
                    <option value="0" <?php if($seatedit->entrance_allot_seat_status==0)
                    {
                    echo "selected=selected";
                    }?>><?php echo "No"; ?></option>
            </select>
        </div>
        <input type="hidden" name="seat_id" placeholder="ID" class="form-control" value="<?php echo $seatedit->entrance_allot_seat_id; ?>" required>
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
<h3 class="box-title titlefix"> <?php echo ('Allotment Seat List'); ?></h3>
<div class="box-tools pull-right">
</div><!-- /.box-tools -->
</div><!-- /.box-header -->
<div class="box-body">

<div class="table-responsive mailbox-messages">
        <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Allotment Seat List'); ?>">
        
        <thead>
            <tr>
                <th><?php echo ('Year'); ?>
                </th>
                <th><?php echo ('Session'); ?>
                </th>
                <th><?php echo ('Seat no'); ?>
                </th>
                <th><?php echo ('Course'); ?>
                </th>
                <th><?php echo ('Institute'); ?>
                </th>
                <th><?php echo ('Center'); ?>
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
                foreach ($seatlist as $list) { ?>
                    <tr> 
                    <td><?php echo $list['entrance_allot_seat_year']; ?></td>
                    <td><?php echo $list['session']; ?></td>
                    <td><?php echo $list['entrance_allot_seat_seatno']; ?></td>
                    <td><?php echo $list['entranceexam_course_name']; ?></td>
                    <td><?php echo $list['entranceexam_insitutename']; ?></td>
                    <td><?php echo $list['entranceexam_centrename']; ?></td>
                    <td><?php echo $list['entrance_allot_type_name']; ?></td>
                    <td><?php if($list['entrance_allot_seat_status']==1)
                    {
                        echo "Yes";
                    }
                    else {
                        echo "No";
                    } ?></td>
                    <td align="right">
                        <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entrance_allotmentseat/editseat/' . $list['entrance_allot_seat_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                        <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entrance_allotmentseat/deleteseat/' . $list['entrance_allot_seat_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>
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
 $(document).ready(function (e) {
        $("#form1").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("entrance_allotment/Entrance_allotmentseat/updateseat") ?>",
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

<script type="text/javascript">


$(document).on('change', '#course_id', function (e) {
    $('#institute_id').html("");
    $('#center_id').html("");
    var course_id = $(this).val();
    getInstituteByCourse(course_id,institute_id);
    getCenterByCourse(course_id,center_id);
});

function getCenterByCourse(course_id,center_id) 
{
    //alert(course_id);
    var course_id = $('#course_id').val();
    if (course_id != "") {
        $('#center_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "entrance_allotment/Entrance_allotmentseat/selectCenter",
            data: {'course_id': course_id},
            dataType: "json",
            success: function (data) 
            {
                $.each(data, function (i, obj)
                {
                    var select = "";
                    if (<?php echo $seatedit->entrance_allot_seat_center; ?> == obj.entranceexam_centreid) {
                        var select = "selected=selected";
                    }
                    div_data += "<option value=" + obj.entranceexam_centreid + " " + select +  ">" + obj.entranceexam_centrename + "</option>";
                });
                $('#center_id').append(div_data);
            },
        });
    }
}

function getInstituteByCourse(course_id,institute_id) 
{
    //alert(course_id);
    var course_id = $('#course_id').val();
    if (course_id != "") {
        $('#institute_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "entrance_allotment/Entrance_allotmentseat/selectInstitute",
            data: {'course_id': course_id},
            dataType: "json",
            success: function (data) 
            {
                $.each(data, function (i, obj)
                {
                    var select = "";
                    if (<?php echo $seatedit->entrance_allot_seat_institute; ?> == obj.entranceexam_insituteid) {
                        var select = "selected=selected";
                    }
                    div_data += "<option value=" + obj.entranceexam_insituteid + " " + select + ">" + obj.entranceexam_insitutename + "</option>";
                });
                $('#institute_id').append(div_data);
            },
        });
    }
}

</script>








