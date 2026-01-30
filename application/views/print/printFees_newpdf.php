<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Fees Receipt </title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="html, css, html tables, table">
    <meta name="Description" content="html table">
    <!-- add icon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

   </head>


   <style type="text/css">
    
.th_style
{
     background: #6bb8d4; 
    border-bottom: 5px solid #ffffff; 
    border-right: 1px solid #ffffff; 
    text-align: right; color: #fff;
     font-weight: 100; 
   
      font-size:9px;
      text-align:center;
}

thead {
    display: table-row-group;
}
tr {
    page-break-before: always;
    page-break-after: always;
    page-break-inside: avoid;
}
table {
    word-wrap: break-word;
    font-size:3.20mm;
    
}
table td {
    word-break: break-all;
}




#footer
    {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 50px;
    font-size: 6pt;
    color: #777;
    /* For testing */
    background: red; 
    opacity: 0.5;
   }



 .col-sm-6 {
            width: 50%;
        }

        .footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  text-align: center;
}
</style>

<body>    
<div class="container"> 
                                   <div class="row">
                                   <table style="width:100%;">
                                        
                                        <tr>
                                            <td style="width:50%;">
                                                <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php echo  $sch_setting->admin_logo; ?>" >
                                                <br>
                                            </td>
                                            <td style="width:10%;"></td>
                                            <td style="width:40%;"><b><?php
                        $address=$sch_setting->address;
                        $output = str_replace(',', '<br />', $address);
                        ?></b>
                        <p class="text-black"><?php echo  $output; ?></p>
                        <p class="text-black">Phone No:<?php echo  $sch_setting->phone; ?></p>
                        <p class="text-black">Email:<?php echo  $sch_setting->email; ?></p></td>
                                        </tr>
                                    </table>
                                       <table>

                                        <tr>
                                            <td>
                                               <img  src="<?php echo base_url(); ?>/uploads/NewfeesCollectTitle/heading.jpg" style="width:100%;height:20px;"> 
                                            </td>
                                        </tr>
                                       </table>



                                        <table style="width:100%;">                                        
                                        <tr>
                                        <td style="width:80%;">
                                         <strong><?php
echo $this->customlib->getFullName($feearray[0]->firstname, $feearray[0]->middlename,$feearray[0]->lastname,$sch_setting->middlename,$sch_setting->lastname);

                              ?></strong><?php echo " (".$feearray[0]->admission_no.")"; ?> <br>

                                        <?php echo "Father Name"; ?>: <?php echo $feearray[0]->father_name; ?><br>
                                        <?php echo "Class"; ?>: <?php echo $feearray[0]->class . " (" . $feearray[0]->section . ")"; ?>
                                        
                                            
                                        </td>

                                        <td style="width:20%;">
                                           <strong>Date :<?php
                                        $date = date('d-m-Y');

                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date));
                                        ?></strong><br/> 
                                        
                                       
 
 


                                        </td>
                                        </tr>
                                        



                                        <?php
                                        if (!empty($feearray)) {
                                            ?>

                                        <table class="table table-striped table-responsive" style="width:100%;" >
                                        <thead >
                                        <th class="th_style">Fees Group</th>
                                        <th class="th_style">Fees Code</th>
                                        <th class="th_style">Due Date</th>
                                        <th class="th_style">Status</th>
                                        <th class="th_style" >Amount</th>
                                        <th class="th_style" >Payment Id</th>
                                        <th class="th_style" >Mode</th>
                                        <th class="th_style">Date</th>
                                        <th class="th_style" >Paid</th>
                                        <th class="th_style">Fine</th>
                                        <th class="th_style">Discount</th>
                                        <th class="th_style">Balance</th>

                                        </thead>

                                        <tbody>
                                            <tr>
                                                
                                            </tr>

                                           <?php
                                            $total_amount = 0;
                                            $total_deposite_amount = 0;
                                            $total_fine_amount = 0;
                                            $total_discount_amount = 0;
                                            $total_balance_amount = 0;
                                            $alot_fee_discount = 0;
                                            if (empty($feearray)) {
                                                ?>
                                                <tr >
                                                   
                                                </tr>
                                                <?php
                                            } else {



                                                foreach ($feearray as $fee_key => $feeList) {
                                                    if ($feeList->is_system) {
                                                        $feeList->amount = $feeList->student_fees_master_amount;
                                                    }

                                                    $fee_discount = 0;
                                                    $fee_paid = 0;
                                                    $fee_fine = 0;
                                                    if (!empty($feeList->amount_detail)) {
                                                        $fee_deposits = json_decode(($feeList->amount_detail));

                                                        foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                            $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                            $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                            $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                        }
                                                    }
                                                    $feetype_balance = $feeList->amount - ($fee_paid + $fee_discount);
                                                    $total_amount = $total_amount + $feeList->amount;
                                                    $total_discount_amount = $total_discount_amount + $fee_discount;
                                                    $total_fine_amount = $total_fine_amount + $fee_fine;
                                                    $total_deposite_amount = $total_deposite_amount + $fee_paid;
                                                    $total_balance_amount = $total_balance_amount + $feetype_balance;
                                                    ?>
                                                    <tr  >

                                                        <td><?php echo $feeList->name;
                                                            ?></td>

                                                            <td><?php echo $feeList->code; ?></td>

                                                              <td class="">

                                                            <?php
                                                            if ($feeList->due_date == "0000-00-00") {
                                                                
                                                            } else {

                                                                echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($feeList->due_date));
                                                            }
                                                            ?>
                                                        </td>


                                                        <td class="">
                                                            <?php
                                                            if ($feetype_balance == 0) {
                                                                echo "paid";;
                                                            } else if (!empty($feeList->amount_detail)) {
                                                                ?><?php echo "partial"; ?><?php
                                                            } else {
                                                                echo "unpaid";
                                                            }
                                                            ?>

                                                        </td>

                                                         <td class="text text-right"><?php echo $currency_symbol . $feeList->amount; ?></td>

                                                          <td colspan="3"></td>

                                                           <td class="text text-right"><?php
                                                            echo ($currency_symbol . number_format($fee_paid, 2, '.', ''));
                                                            ?></td>

                                                            <td class="text text-right"><?php
                                                            echo ($currency_symbol . number_format($fee_fine, 2, '.', ''));
                                                            ?></td>
                                                        <td class="text text-right"><?php
                                                            echo ($currency_symbol . number_format($fee_discount, 2, '.', ''));
                                                            ?></td>


                                                             <td class="text text-right"><?php
                                                            $display_none = "ss-none";
                                                            if ($feetype_balance > 0) {
                                                                $display_none = "";


                                                                echo ($currency_symbol . number_format($feetype_balance, 2, '.', ''));
                                                            }
                                                            ?>

                                                        </td>

                                                        
                                            </tr>


                                            <?php
                                                    $fee_deposits = json_decode(($feeList->amount_detail));
                                                    if (is_object($fee_deposits)) {
                                                        foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                            ?>
                                                            <tr class="white-td">
                                                                <td colspan="5" class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                                <td class="text text-center">
                                                                    <?php echo $feeList->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?>
                                                                </td>
                                                                <td class="text text-center"><?php echo $fee_deposits_value->payment_mode; ?></td>
                                                                <td class="text text-center">
                                                                    <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                                </td>
                                                                <td class="text text-right" ><b><?php echo ($currency_symbol . number_format($fee_deposits_value->amount, 2, '.', '')); ?></b></td>
                                                                <td class="text text-right"><?php echo ($currency_symbol . number_format($fee_deposits_value->amount_fine, 2, '.', '')); ?></td>
                                                                <td class="text text-right"><?php echo ($currency_symbol . number_format($fee_deposits_value->amount_discount, 2, '.', '')); ?></td>
                                                                <td></td>

                                                            </tr>
                                                            <?php
                                                        }
                                                    }





                                         } } ?>



                                                <tr class="success">
                                                <td align="left" ></td>
                                                <td align="left" ></td>
                                                <td align="left" ></td>

                                                <td align="left" class="text text-left" >
                                                    <b>    <?php echo "Grand Total"; ?></b>
                                                </td>
                                                <td class="text text-right">
                                                    <b>    <?php
                                                        echo ($currency_symbol . number_format($total_amount, 2, '.', ''));
                                                        ?></b>
                                                </td>
                                                <td class="text text-left"></td>
                                                <td class="text text-left"></td>
                                                <td class="text text-left"></td>

                                                <td class="text text-right"> <b>  <?php
                                                        echo ($currency_symbol . number_format($total_deposite_amount, 2, '.', ''));
                                                        ?></b></td>
                                                <td class="text text-right"> <b>  <?php
                                                        echo ($currency_symbol . number_format($total_fine_amount, 2, '.', ''));
                                                        ?></b></td>
                                                <td class="text text-right"> <b>  <?php
                                                        echo ($currency_symbol . number_format($total_discount_amount, 2, '.', ''));
                                                        ?></b></td>



                                                <td class="text text-right"> <b>  <?php
                                                        echo ($currency_symbol . number_format($total_balance_amount, 2, '.', ''));
                                                        ?></b></td>  <td class="text text-right"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot><tr><td><div class="footer" style="position: fixed;padding-top: 10px; border-top: 1px solid #ddd; font-size:12px; color: #333; margin-top: 20px; text-align: center;"> <a style="color: #000; text-decoration: none;" > <?php $this->setting_model->get_receiptfooter(); ?></div>
</td></tr></tfoot>
                                    </table>

                                <?php
                                }
                                ?>                              
                                </div>



        </div>
        
       

  </body>
</html>