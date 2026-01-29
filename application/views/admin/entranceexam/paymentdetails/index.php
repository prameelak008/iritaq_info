<?php


$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('payment'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
           
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('payment'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       
                        <div class="table-responsive mailbox-messages">
                            
                            <div class="tab-pane detail_view_tab" id="tab_2">
                                <?php if (empty($paymentdetails )) {
    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
} else {
    $count = 1;
                      foreach ($paymentdetails as $pay) {
                       if (empty($pay["admission_photo"])) {
                                                $image = "uploads/student_images/default_male.jpg";
                                            } else {
                                                $image = "entrance/admissionphoto/".$pay['admission_photo'];
                                            }
    
        ?>
                                <div class="carousel-row">
                                            <div class="slide-row">
                                              <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a href="<?php echo base_url(); ?>EntranceExam/view/<?php echo $pay['admission_id'] ?>">
                                                                <img class="img-responsive img-thumbnail width150" alt="<?php echo $pay['admission_name']?>" src="<?php echo base_url() . $image; ?>" alt="Image" style="width:600px;height:600px;"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4><a href="<?php echo base_url(); ?>EntranceExam/examview/<?php echo $pay['admission_id'] ?>"> <?php echo $pay['admission_name']; ?></a></h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                
                                                                <strong>
                                                                <b>Register Id:<?php echo $pay['admission_range'] ?><br>
                                                                <b>Name<?php echo $pay['admission_name'] ?><br>
                                                                
                                                                 <b>Application No:<?php echo $pay['admission_range'] ?><br>
                                                            
                                                                 <b>Date Of Birth <?php echo $pay['admission_dob'] ?><br>
                                                                
                                                                <b>Payment <?php echo $pay['admission_payment'] ?><br>
                                                                 
                                                                 
                                                                    </address>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    </div>
                                                                    </div>
                                                                    <div class="slide-footer">
                                                                        <span class="pull-right buttons">
                                                                            <a href="<?php echo base_url(); ?>EntranceExam/examview/<?php echo $pay['admission_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
                                                                                <i class="fa fa-reorder"></i>
                                                                            </a>
                                                                            
                                                                            <a href="<?php echo site_url(); ?>EntranceExam/feedetails/<?php echo $pay['admission_application_registerid'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('fees'); ?>" >
                                                                                <i class="fa fa-cc-mastercard"></i>
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                    
                                                                     
                                                                    
                                                                    
                                                                    </div>
                                                                    </div>
                            <?php }  } ?>
                            
                            <!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->





// <script>
//     ( function ( $ ) {
//     'use strict';
//     $(document).ready(function () {

//         initDatatable('income-list','admin/income/getincomelist',[],[],100);
//     });
// } ( jQuery ) )
// </script>