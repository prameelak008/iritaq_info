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
                    
                    
                    
                      <div class="form-group" style="text-align:center; font-size:16px;">
                      <b >Applicant Name:  &nbsp;&nbsp;</b><?php echo $reg_applicant['entrance_reg_name']; ?><br>
                      <b>Email:&nbsp; &nbsp;</b><?php echo $reg_applicant['entrance_reg_email']; ?><br>
                      <b>Contact No:&nbsp; &nbsp;</b><?php echo $reg_applicant['entrance_reg_phone']; ?><br>
                      
                      
                      </div>
                
                
                <div class="row">
                <?php
                
                $sl=1;
                
                if(!empty($fee_details))
                {
                
                foreach($fee_details as $fee) 
                {
                ?>
                
            <div class="form-group">
            <label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" ><?php echo $sl;?> &nbsp; Payment Transaction</label>
            </div>
                
               <div class="form-group" style="padding:8px 8px 8px 8px; text-align:center;"> 
               
               
                <b>Order Id:&nbsp;</b><?php echo $fee['fees_entrancepayment_orderid']; ?><br>
                <b>Transaction Date:&nbsp;</b><?php echo $fee['fees_entrancepayment_transdate']; ?><br>
                <b>Transaction No:&nbsp;</b><?php echo $fee['fees_entrancepayment_transaction_no']; ?><br>
                <b>Register Id:&nbsp;</b><?php echo $fee['fees_entrancepayment_registerid']; ?><br>
                <b>Application No:&nbsp;</b><?php echo $fee['fees_entrancepayment_applicationno']; ?><br>
                <b>Amount:&nbsp;</b><?php echo $fee['fees_entrancepayment_amount']; ?><br>
                
                <b>Payment Status:&nbsp;</b>
                <?php 
                if($fee['fees_entrancepayment_statuscode']=='S')
                {
                $st="Payment Success";
                }
                
                elseif($fee['fees_entrancepayment_statuscode']=='F')
                {
                
                $st="Payment Failed";
                
                }
                
                else
                {
                $st="No Transaction Found";
                
                }
                echo $st; ?><br>
                <br>
                <br>
                <br>
                <br>
                
                 </div>
                <?php 
                $sl++;
                }
                }
                
                else
                {
                ?>
                
                <div class="col-md-6">
                <div class="form-group">
                <label class="form-control" >No Transaction Found</label>
                </div>
                </div>
                <?php }
                ?>
                <br>
                <br>
                </div>
                
                
               
                </div>
                </div>
                
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