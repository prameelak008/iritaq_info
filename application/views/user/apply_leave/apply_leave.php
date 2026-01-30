<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <i class="fa fa-flask"></i> <?php echo $this->lang->line('apply_leave'); ?>
        </h1>
    </section>
    
    
    
     <style>
      * {
        box-sizing: border-box;
      }
      .openBtn {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: fixed;
      }
      .loginPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
      }
    </style>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('leave') . " " . $this->lang->line('list'); ?></h3>

                        <div class="box-tools pull-right">
                        <button type="button" onclick="add_leave()" class="btn btn-sm btn-primary " data-toggle="tooltip" data-placement="left" title="<?php echo $this->lang->line('add'); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add'); ?></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="download_label"> <?php echo $this->lang->line('leave') . " " . $this->lang->line('list'); ?></div>
                        <div >
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('class'); ?>      </th>
                                        <th><?php echo $this->lang->line('section'); ?></th>
                                        <th><?php echo $this->lang->line('apply') . " " . $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('from') . " " . $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('from') . " " . $this->lang->line('time'); ?></th>
                                        
                                        <th><?php echo $this->lang->line('to') . " " . $this->lang->line('date'); ?></th>
                                         <th><?php echo $this->lang->line('to') . " " . $this->lang->line('time'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        
                                        <th class="pull-right"><?php echo $this->lang->line('action'); ?></th>
                                        <th class="pull-right"><?php echo $this->lang->line('print'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    
                                    foreach ($results as $value) {
                                        ?>
                                        <tr>
                                            <?php //echo $value['leaveid']; ?>
                                            <td><?php echo $value['class']; ?></td>
                                            <td><?php echo $value['section']; ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value['apply_date'])); ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value['from_date'])); ?></td>
                                            <td><?php echo $value['leave_from_time']; ?></td>
                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($value['to_date'])); ?></td>
                                            <td><?php echo $value['leave_to_time']; 
                                            
                                             $from       = date($this->customlib->getSchoolDateFormat(), strtotime($value['from_date']));
                                             $to         = date($this->customlib->getSchoolDateFormat(), strtotime($value['to_date']));
                                             
                                             $from_time  = $value['leave_from_time'];
                                             $to_time    = $value['leave_to_time']; 
                                             
                                             
                                            ?></td>
                                            
                                            
                                            <td><?php
if ($value['status'] == 0) {
        echo $this->lang->line('pending');
    } else {
        echo $this->lang->line('approved');
    }
    ?>
                                            
</td>
                                            
                                            
                                            
                                            <td class="pull-right">
                                                <?php
if ($value['docs'] != '') {
        ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>user/apply_leave/download/<?php echo $value['docs'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('download'); ?>">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <?php
}
    ?>
                                                <?php
if ($value['status'] == 0) {
        ?>
                                                    <a data-placement="left" onclick="get('<?php echo $value['id']; ?>')" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i> </a>
                                                    <a data-placement="left" onclick="return doconfirm();"  href="<?php echo base_url(); ?>user/apply_leave/remove_leave/<?php echo $value['id']; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>" class="btn btn-default btn-xs"><i class="fa fa-remove"></i> </a>
    <?php }?>

                                            </td>
                                            <td> 
                                            <button type="button" id="printbtn" data-from="<?php  echo $from; ?>" data-to="<?php echo $to; ?>" data-fromtime="<?php echo $from_time; ?>" data-totime="<?php echo $to_time; ?>"  data-sid="<?php echo $value['sid']; ?>" data-ssid="<?php echo $value['ssid']; ?>" data-leaveid="<?php echo $value['leaveid']; ?>" data-cls="<?php echo $value['class']; ?>" data-sctn="<?php echo $value['section']; ?>" class="btn btn-xs btn-default"><i class="fa fa-print"></i> </button></td>
                                           </tr>
                                           
                                           
                                        
                                           
                                           
                                        
                                        <?php
                                       
}
?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>



<div class="modal fade" id="homework_docs" tabindex="-1" role="dialog" aria-labelledby="evaluation" style="padding-left: 0 !important">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="box-title" id="title"></h4>
            </div>
            <form role="form" id="addleave_form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-body pb0 ">
                    <div class="row">

                        <input type="hidden" id="homework_id"  name="homework_id">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('apply') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small>
                                <input type="text" name="apply_date" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" id="apply_date" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                <select class="form-control" name="student_session_id" id="student_session_id">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
foreach ($studentclasses as $value) {
    ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->class; ?></option>
                                        <?php
}
?>

                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('from') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small>
                                <input type="text" name="from_date" id="from_date" class="form-control date" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" >
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $this->lang->line('leave'); ?> <?php echo $this->lang->line('from'); ?> <?php echo $this->lang->line('time'); ?></label><small class="req"> *</small>

                                <input type="time"  id="leave_from_time" name="leave_from_time" class="form-control "  >
                            </div>
                        </div>
                        
                        <span class="text-danger"><?php echo form_error('leave_from_time'); ?></span>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('to') . " " . $this->lang->line('date'); ?></label><small class="req"> *</small>
                                <input type="text" name="to_date" id="to_date"  class="form-control date" value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>">
                            </div>
                        </div>
                        
                        
                        
                         <div class="col-sm-3">
                         <div class="form-group">
                         <label><?php echo $this->lang->line('leave'); ?> <?php echo $this->lang->line('to'); ?> <?php echo $this->lang->line('time'); ?></label><small class="req"> *</small>

                         <input type="time"  id="leave_to_time" name="leave_to_time" class="form-control" >  
                         </div>
                         </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('reason'); ?></label>
                                <input type="hidden" name="leave_id" id="leave_id">
                                <textarea type="text" id="message" name="message" class="form-control "></textarea>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="pwd"><?php echo $this->lang->line('attach_document'); ?></label>
                                <input type="file" id="file" name="userfile" class="filestyle form-control" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                
                <div class="box-footer">
                    <div class="col-md-12">
                        <button class="btn btn-info pull-right"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait" value=""><?php echo $this->lang->line('save'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>









<script type="text/javascript">

$(document).on('click', '#printbtn', function (e)
{
var leaveid     =  $(this).data('leaveid');
var ssid        =  $(this).data('ssid');
var sid         =  $(this).data('sid');
var cls         =  $(this).data('cls');
var sctn        =  $(this).data('sctn');

var from        =  $(this).data('from');
var to          =  $(this).data('to');

var fromtime    =  $(this).data('fromtime');
var totime      =  $(this).data('totime');




var base_url = '<?php echo base_url() ?>';
$.ajax({
    type: 'POST',
    url: base_url + "user/apply_leave/lvreport",
    data: {'sid' : sid,
            'ssid' : ssid,
            'leaveid' : leaveid,
            'cls' : cls,
            'sctn' : sctn,
            'from': from,
            'to': to,
            'fromtime': fromtime,
            'totime': totime,
        
    }, 
    success: function (response)
    {
    Popup(response);
    },
});
});


var base_url = '<?php echo base_url() ?>';
function Popup(data)
{  
           
var frame1 = $('<iframe />');
frame1[0].name = "frame1";
$("body").append(frame1);
var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
frameDoc.document.open();
//Create a new HTML document.
frameDoc.document.write('<html>');
frameDoc.document.write('<head>');
frameDoc.document.write('<title></title>');


frameDoc.document.write('</head>');
frameDoc.document.write('<body>');
frameDoc.document.write(data);
frameDoc.document.write('</body>');
frameDoc.document.write('</html>');
frameDoc.document.close();
setTimeout(function () {
    window.frames["frame1"].focus();
    window.frames["frame1"].print();
    frame1.remove();
}, 500);
return true;
}



    function get(id) {
        $.ajax({
            url: "<?php echo site_url("user/apply_leave/get_details") ?>/" + id,
            type: "POST",
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,

            success: function (res)
            {

                $('#apply_date').val(res.apply_date);
                $('#from_date').val(res.from_date);
                $('#to_date').val(res.to_date);
                	
                $('#leave_from_time').val(res.leave_from_time);
                $('#leave_to_time').val(res.leave_to_time);
                $('#message').html(res.reason);
                $('#leave_id').val(res.id);
                $('#student_session_id').val(res.student_session_id);
                $('#title').html('<?php echo $this->lang->line('edit') . " " . $this->lang->line('leave'); ?>');
                $('#homework_docs').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            }
        });

    }

    function add_leave() {
        $('#title').html('<?php echo $this->lang->line('add') . " " . $this->lang->line('leave'); ?>');
        $('#homework_docs').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

    }

    $(document).ready(function () {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
    });

    $("#addleave_form").on('submit', (function (e) {
        e.preventDefault();

        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("user/apply_leave/add") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
            $this.button('loading');

            },
            success: function (res)
            {

                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);

                } else {

                    successMsg(res.message);

                    window.location.reload(true);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));
 
  
    
       

</script>