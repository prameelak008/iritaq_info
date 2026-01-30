                                    
                                    <style >
                                    .text-left
                                    {
                                    text-align: left !important;
                                    }
                                    </style>
                                    
                                    
                                    <div class="content-wrapper" style="min-height: 946px;">
                                    <section class="content-header">
                                    <h1>
                                    <i class="fa fa-map-o"></i> <?php echo $this->lang->line('Payment'); ?> <small></small>  
                                    </h1>
                                    </section>
                                    <!-- Main content -->
                                    <section class="content">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="box box-primary">
                                    <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search"></i><?php echo $this->lang->line('update '); ?> <small><?php echo $this->lang->line('Payment') ; ?></h3>
                                    </div>
                                    <div class="box-body">
                                        
                                        
                                    <form role="form" action="<?php echo site_url('entrance_allotment/payment/checkpayment') ?>" method="post" >
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    
                                    <div class="row">
                                        
                                    <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    <div class="form-group">
                                    <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                                    <select  id="entrance_course" name="entrance_course" class="form-control select2" required="required"  >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach($course as $cou)
                                    {
                                    ?>
                                    <option value="<?php  echo $cou['entranceexam_course_id'];  ?>"><?php  echo $cou['entranceexam_course_name'];  ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                                    </div>
                                    </div>
                                    
                                    
                                    
                                    <!--<div class="col-sm-6 col-lg-3 col-md-3 col20">
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
                                    </div>-->
                                    
                                    
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                    <button type="submit"  name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                    </div>
                                    
                                    
                                    </div>
                                    </form>
                                    </div>
                                    <div>
                                    <?php
                                    if (isset($applicants)) 
                                    {
                                    ?>
                                    <div class="" >
                                    <div class="box-header ptbnull"></div>
                                    <div class="box-header ptbnull">
                                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo  $this->lang->line('payment'); ?></h3>
                                    </div>
                                    <div class="box-body">
                                    
                                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                    <div class="download_label"> <?php echo $this->lang->line('payment'); ?></div>
                                    
                                    <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                                    
                                    
                                    
                                    <thead>
                                    <tr>
                                    <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                                    <th class="text-left">Admission no</th>
                                    <th class="text-left"><?php echo $this->lang->line('mobile_no'); ?></th>
                                    <th class="text-left"><?php echo $this->lang->line('name'); ?></th>
                                    <th class="text-left"></th>
                                    <th class="text-left">Transaction</th>
                                    <th class="text-left">Action </th>
                                    </tr>
                                    </thead>
                                    
                                    
                                    <tbody>
                                    <?php
                                    $sl=1;
                                    
                                    
                                    
                                    foreach($applicants as $appl)
                                    {
                                    ?>
                                    <tr>
                                    <form method="post" action="<?php echo base_url('entrance_allotment/Payment/updatefees') ?>" >
                                    <td><?php  echo $sl; ?></td> 
                                    <td><?php   echo $appl['admission_application_no'];  ?></td>
                                    <td><?php   echo $appl['admission_mobile'];  ?></td>
                                    <td><?php   echo $appl['admission_name'];  ?></td>
                                    <td>
                                    <?php 
                                    //echo $appl['admission_application_registerid'];
                                    foreach($entrancefees as $ent)
                                    {
                                        
                                        //echo "gg".$ent['fees_entrancepayment_registerid'];
                                        
                                    if($appl['admission_application_registerid']==$ent['fees_entrancepayment_registerid'])
                                    {
                                    echo 'Order Id :'.'&nbsp;&nbsp;'. $ent['fees_entrancepayment_orderid']; 
                                    echo "</br>";
                                    echo 'Transcation No :'.'&nbsp;&nbsp;'.$ent['fees_entrancepayment_transaction_no']; 
                                    echo "</br>";
                                    
                                    echo 'Amount :'.'&nbsp;&nbsp;'.$ent['fees_entrancepayment_amount']; 
                                    echo "</br>";
                                    
                                    echo 'Transaction Date :'.'&nbsp;&nbsp;'.$ent['fees_entrancepayment_transdate']; 
                                    echo "</br>";
                                    
                                    echo 'Status Code :'.'&nbsp;&nbsp';
                                    
                                    if($ent['fees_entrancepayment_statuscode']=="S")
                                    {
                                    $status= "Success";   
                                    }
                                    else if($ent['fees_entrancepayment_statuscode']=="F")
                                    {
                                    $status= "Failed" ;
                                    }
                                    echo $status;
                                    echo "</br>";
                                    
                                    echo "</br>";
                                    echo "</br>";
                                    
                                    ?>
                                    <a onclick ="return doconfirm()" href="<?php echo site_url();?>entrance_allotment/payment/deletefees/<?php   echo $ent['fees_entrancepayment_id'];  ?>/<?php   echo $ent['fees_entrancepayment_registerid'];  ?>" ><i class="fa fa-trash " style="color:red"></i></a>
                                    
                                    <?php
                                    
                                    }
                                    }
                                    
                                    ?>
                                    </td>
                                    
                                    
                                    <td>
                                    Order Id :<input type="text" class="form-control" name="orderid" />
                                    <br>
                                    
                                    Transaction No :<input type="text" class="form-control" name="transaction" /> 
                                    <br>
                                    Amount :
                                    <input type="text" class="form-control" name="amount" />
                                    
                                    <br>
                                    Transaction Date(Format:2023-03-28 15:52:09) :
                                    <input type="text" class="form-control" name="transactiondate" placeholder="2023-03-28 15:52:09" />
                                    <br>
                                  
                                    
                                    
                                    <input type="hidden" class="form-control" name="registerno" value="<?php   echo $appl['admission_application_registerid'];  ?>" />
                                    <input type="hidden" class="form-control" name="applicationno" value="<?php   echo $appl['admission_application_no'];   ?>" />
                                    
                                    
                                    </td>
                                    
                                    
                                    <td><button type="submit"  name="submit"  class="btn btn-class">PAYMENT</button></td>
                                    </form>
                                    </tr>
                                    <?php $sl++; }  ?>
                                    
                                    </tbody>
                                    </table>
                                    <?php 
                                    } 
                                    ?>
                                    </div>
                                    </div>
                                    </div>
                                    </section>
                                    </div>
                                    
                                    
                                    
                                    
                                    <script type="text/javascript">
                                    
                                    $(document).ready(function () 
                                    {
                                    $('.select2').select2();
                                    });
                                    
                                    $(document).ready(function () {
                                    $.extend($.fn.dataTable.defaults, {
                                    searching: true,
                                    ordering: true,
                                    paging: false,
                                    retrieve: true,
                                    destroy: true,
                                    info: false
                                    });
                                    });
                                    
                                   
                                    
                                    function doconfirm()
                                    {
                                    job=confirm("Are you sure to delete permanently?");
                                    if(job!=true)
                                    {
                                    return false;
                                    }
                                    }
                                    
                                    
                                    
                                    $(document).on('change', '#entrance_course', function (e) 
                                    {
                                    //$('#entrance_course').html("");
                                    var entrance_course = $(this).val();
                                    getsubjectbycourse(entrance_course, 0);
                                    });
                                    
                                    function getsubjectbycourse(entrance_course, entrance_subject) 
                                    { 
                                    var entrance_course = $('#entrance_course').val();
                                    var session = $('#session').val();
                                    var entrance_subject = $('#entrance_subject').val();
                                    
                                    if (entrance_course !== "") 
                                    {
                                    $('#entrance_subject').html("");
                                    var base_url = '<?php echo base_url() ?>';
                                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                    
                                    $.ajax({
                                    type: "POST",
                                    url: base_url + "entrance_allotment/add_marks/getentranceSubject",
                                    data: {'entrance_course': entrance_course},
                                    dataType: "json",
                                    // beforeSend: function () {
                                    //     $('#exam_id').addClass('dropdownloading');
                                    // },
                                    success: function (data) 
                                    { 
                                    
                                    $.each(data, function (i, obj)
                                    {
                                    var sel = "";
                                    if (entrance_subject === obj.entrance_subtype_id) {
                                    sel = "selected";
                                    }
                                    div_data += "<option value=" + obj.entrance_subtype_id + " " + sel + ">" + obj.entrance_subtype_name + "</option>";
                                    });
                                    
                                    $('#entrance_subject').append(div_data);
                                    $('#entrance_subject').trigger('change');
                                    },
                                    complete: function () {
                                    $('#entrance_subject').removeClass('dropdownloading');
                                    }
                                    });
                                    }
                                    }
                                    
                                    
                                    </script>