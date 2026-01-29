<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    @media print {
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
        table.hidden-xs {
            display: table;
        }
        tr.hidden-xs {
            display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }
        .hidden-xs.hidden-print {
            display: none !important;
        }
        .hidden-sm {
            display: none !important;
        }
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
        .trow{
        background-color:##D3D3D3 !important;
        }
        .thr{
        background-color: #000 !important;
        text-decoration-color: #fff !important;
        -webkit-print-color-adjust: exact; 
        }        
        
        .styletbl
        {
        font-size:13px;
        }        
        
        .thcls        
        {
        padding-left:4px !important;
        }
        
        .stltb
        {
        font-size:15px;  
        }
        .wordwrap
        {
        white-space: nowrap;
        }        
    }


</style>


<script type="text/javascript" src="<?php echo base_url() ?>/js/Numbertowordconvertsconver.js"></script>
                    
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $this->lang->line('payslip'); ?></title>
    </head>

    <div id="html-2-pdfwrapper">

        <div class="row">
            <!-- left column -->
            <div class="col-sm-12">

                <div class="">

                    <table width="100%">
                    <tr>
                    <td style="height: 80px;width: 850px;">
                    <div ><img src="<?php echo base_url() ?>/uploads/print_headerfooter/staff_payslip/Salary_Pre_Payment Slip.png " style="height: 100px;width: 100%;" /></div>
                    </td>
                    </tr>
                        
                        
                    <tr style="width: 100%;text-align: center;">
                    <td style="white-space:nowrap;text-align: center;"><h4 style="display: inline-block;"><center><?php echo ('Pre-payment Slip for the period of'); ?> <?php echo $result["month"] ?> <?php echo $result["year"] ?></center></h4></td>
                    </tr>
                    </table>


                    <table width="100%" class="">
                    <tr>
                    <th class="stltb"><?php echo 'Slip No: '; ?> #<?php echo $result["id"] ?></th> <td></td>
                    <th class="text-right stltb"></th> <th class="text-right"> <?php echo $this->lang->line('date'); ?>: <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($result['payment_date'])); ?></th>

                    </tr>
                    </table>


                     <hr/>

                    <div class="col-sm-12">
                    <div class="col-sm-4"><?php echo "Staff  Details"?>
                    </div>                        
                    <div class="col-sm-7"><?php echo "Attendance  Records"?>
                    </div>
                    </div>

                
                    <div class="col-sm-12">
                    <div class="col-sm-4" style="float:left;">
                    <table width="100%" style="border:1px #746f6f solid;height: 99px;text-align: center;font-size: 11px; float:left;" class="">

                        <tr>
                        <th class="thcls" style="padding-left:5px !important;"><?php echo $this->lang->line('staff_id'); ?></th>
                        <td style="text-align:left;" ><?php echo $result["employee_id"] ?></td>
                        </tr>
                        <tr style="padding-left:5px;">
                            <th class="thcls" style="padding-left:5px !important;"><?php echo $this->lang->line('department'); ?></th>
                            <td style="text-align:left;"><?php echo $result["department"] ?></td>
                        </tr>
                        <tr style="padding-left:2px;">
                            <th class="thcls" style="padding-left:5px !important;"><?php echo ('Name'); ?></th>
                            <td style="text-align:left;"><?php echo $result["name"]." ".$result["surname"] ?></td>
                        </tr>
                        <tr style="padding-left:2px;">
                            <th class="thcls" style="padding-left:5px !important;"><?php echo $this->lang->line('designation'); ?></th>
                            <td style="text-align:left;"><?php echo $result["designation"] ?></td>
                        </tr>
                    </table>
                     </div>


                     
<div class="col-sm-8">
<table width="100%" class="" style="padding-left: 2px;font-size: 10px; height: 99px;" border="1">                      
 <tr>
                            <?php
                            $counttype   =  count($active_leavetypes)+1;
                            
                            
                            
                            for($i=0;$i<=$counttype;$i++)
                            {
                                
                                

                                if($i==1)
                                { ?>
                                   <th width="20px"  style="white-space: nowrap; text-align:left; padding-left:5px;"><?php echo('Paid Days'); ?></th>
                                <?php
                                }
                              if($i==2)
                                { ?>
                                   <th width="20px"  style="white-space: nowrap; text-align:center; padding-left:2px;" >26</th>
                                <?php
                                }
                              if($i==3)
                                {  ?>
                                   <th width="20px"  style="white-space: nowrap; text-align:center;  padding-left:2px;"><?php echo ('L.Days'); ?></th>
                                <?php
                                }
                              if($i==4)
                                {  ?>
                                   <th width="20px"   style="white-space: nowrap; text-align:center; padding-left:2px;"><?php echo "4"; ?></th>
                                <?php
                                }
                                
                                
                               if($i>4)
                                { 
                                ?>
                                   <th width="20px"   style="white-space: nowrap; text-align:left; border-left-color: none;border:0px;  padding-left:2px;"></th>
                                <?php
                                }
                                
                                
                                }
                            
                                ?>

                           
                            <?php
                            
                            ?>
                            
                           

                            </tr>
                            <tr>
                            <td width="20px"  style="white-space: nowrap; text-align:left;padding-left:5px;">Leave Type</td>

                            <?php
                            $staff         =   $staff_id;
                            
                            
                            
                            foreach($active_leavetypes as $leavetypes)
                            {
                              $lid= $leavetypes['id'];
                              $this->db->select('*');
                              $this->db->from('staff_leave_details');        
                              $this->db->where('staff_leave_details.staff_id',$staff);
                              $this->db->where('staff_leave_details.leave_type_id',$lid);
                              $query=$this->db->get();
                              $leavedetails= $query->row_array(); 
                                $string =$leavetypes['type'];
                                $typ = strtok($string, " ");
                              ?>
                            <td style="white-space: nowrap; text-align:center; width:40px;" >
                            <?php
                            echo $typ.'('.$leavedetails['alloted_leavehours'] .')';
                            ?>                            
                            </td>
                            <?php 
                            } 
                            ?>
                            </tr>



                            <tr>
                            <td width="20px"  style="white-space: nowrap; text-align:left;padding-left:5px;">Total Used</td>
                            <?php                           

                            foreach($active_leavetypes as $leavetypes)
                            {
                            $lve     = $leavetypes['id'];
                            ?>
                        <td style="white-space: nowrap; text-align:center;">

                        <?php
                        $this->db->select('SEC_TO_TIME( SUM(time_to_sec(leave_hours))) as leavehrs');  
                        $this->db->from('staff_leave_request');
                        $this->db->where('staff_id',$staff);
                        $this->db->where('leave_type_id',$lve);
                        $this->db->where('status','approve');
                        $this->db->where('leave_session_id',$current_session);
                        $this->db->group_by('leave_type_id');
                        $query = $this->db->get();                      
                        $res   =  $query->row_array(); 
                    

                        if(!empty($res))
                        { 
                      
                        $leav = explode(':', $res['leavehrs']);
                        echo $leav[0].':'.$leav[1]; 
                        }
                        else
                        {
                            echo "00:00";
                        }
                        
                         
                        ?>
                        </td>
                        <?php                            
                        }
                        ?>                         
                        </tr>


                            <tr>
                            <td width="20px"  style="white-space: nowrap; text-align:left;padding-left:5px;">This Month</td>
                            <?php

                            foreach($active_leavetypes as $leavetypes)
                            {
                            $lvee=$leavetypes['id']; 
                            ?>


        <td style="white-space: nowrap; text-align:center;">

        <?php    

        $mo        = date('m', strtotime($getmonth));
        $mn        = ltrim($mo, '0');
        $d         = cal_days_in_month(CAL_GREGORIAN,$mn,$getyear);
        $firstdate=($getyear.'-'.$mo.'-'.'01'.''.'00:00' );
        $lastdate=($getyear.'-'.$mo.'-'.$d.''.'24:00' );
        $this->db->select("*");
        $this->db->from('staff_leave_request');
        $this->db->where(array('staff_id'=>$staff,'leave_type_id'=>$lvee,'status'=>'approve'));
        $this->db->where('leave_session_id',$current_session);
        
        
        $query        = $this->db->get();
        $getleavedate = $query->result_array();

        $formatdiff   = array();
        $sum2         = 0;
		
        foreach($getleavedate as $getdata)
        {
        $getfrom     = $getdata['leave_from'].''.$getdata['leave_fromtime']; 
        $getto       = $getdata['leave_to'].''.$getdata['leave_totime'];
        if (strtotime($getfrom) <= strtotime($firstdate)) 
        {
        $start       = strtotime($firstdate);
        }
        else
        {
        $start       = strtotime($getfrom);                         
        }
        if (strtotime($getto) >= strtotime($lastdate)) 
        {
        $end         =   strtotime($lastdate); 
        }
        else
        {
        $end         =   strtotime($getto);
        } 

        $range       = array();
        $date        = strtotime("-1 day", $start);
        if($date < $end) 
        {
        $date        = strtotime("+1 day", $date); 
        $daterange   = date('Y-m-d H:i', $date);         
        $endrange    = date('Y-m-d H:i', $end);
        $datetime1   = strtotime($daterange);
        $datetime2   = strtotime($endrange);
        $diff        = $datetime2-$datetime1;
        $hrs         = floor($diff/3600);
        $remain      = $diff - $hrs * 3600;        
        $formatdiff[]= sprintf('%02d',$hrs).gmdate(':i:s',$remain);
        }
        }
        
     
		 $hours = 0;
         $minutes = 0;
        foreach($formatdiff as $value)
         {
        $value_explode = explode(':', $value);
        $hours += $value_explode[0];
        $minutes += $value_explode[1];
        if($minutes >= 60) {
        $hours += 1;
            $minutes = $minutes % 60;
        }
        }
        echo sprintf('%02d:%02d', $hours, $minutes);
        ?>
        </td>
        <?php	

        }   
        ?>

        </tr>               
                            <tr>
                            <td width="20px"  style="white-space: nowrap; text-align:left;padding-left:5px;">Total Balance</td>
                            <?php
                            $staff         =   $staff_id;
                            foreach($active_leavetypes as $leavetypes)
                            {
                            $lvve     = $leavetypes['id'];
                            ?>
                            <td style="white-space: nowrap; text-align:center;">
                              <?php
                              $this->db->select('*');
                              $this->db->from('staff_leave_details');        
                              $this->db->where('staff_leave_details.staff_id',$staff);
                              $this->db->where('staff_leave_details.leave_type_id',$lvve);
                              $query=$this->db->get();
                              $leavedetails= $query->row_array();                            
                              $this->db->select('SEC_TO_TIME( SUM(time_to_sec(leave_hours))) as leavehrs'); 
                              $this->db->from('staff_leave_request');
                              $this->db->where(array('staff_leave_request.staff_id'=>$staff,'staff_leave_request.leave_type_id'=>$lvve,'staff_leave_request.status'=>'approve'));
                              $this->db->where('leave_session_id',$current_session);
                              $this->db->group_by('staff_leave_request.leave_type_id');
                              $query = $this->db->get();                      
                              $res=  $query->row_array();
                                $time2     = $leavedetails['alloted_leavehours'];
                                $time1     = $res['leavehrs'];
                                list($hours, $minutes, $seconds) = explode(':', $time2);
                                $interval2 = $hours*3600 + $minutes*60 + $seconds;
                                list($hours, $minutes, $seconds) = explode(':', $time1);
                                $interval1 = $hours*3600 + $minutes*60 + $seconds;
                                $diff      = $interval2 - $interval1;
                                $totbalance= floor($diff / 3600) . ':' . 
                                str_pad(floor($diff / 60) % 60, 2, '0') . ':' . 
                                str_pad($diff % 60, 2, '0');
                                $bal = explode(':', $totbalance);
                                echo $bal[0].':'.$bal[1];                         
                                
                                ?>
                            </td>
                            <?php                            
                            }
                            ?> 

                           
                            </tr>

                    </table>
                    <br/>
                </div>
            </div>
      
        </div>




                        <table class="earntable table table-striped table-responsive  stltb" >
                        <tr>
                        <th width="19%"><?php echo $this->lang->line('earning'); ?></th> 
                        <th width="16%" class="pttright reborder"><?php echo $this->lang->line('amount'); ?>(<?php echo $currency_symbol; ?>)</th>
                        <th width="20%" class="pttleft"><?php echo $this->lang->line('deduction'); ?></th>
                        <th width="16%" class="text-right"><?php echo $this->lang->line('amount'); ?>(<?php echo $currency_symbol; ?>)</th>
                        </tr>
                       
                        <?php
                        if(!empty($result["leave_deduction"])) {
                            ?>
                            <tr><td></td><td></td>
                                <td class="pttleft styletbl"><?php echo ("Leave Deduction"); ?></td>

                                <td class="text-right styletbl"><?php echo number_format($result["leave_deduction"],2);?>
                                </td>
                            </tr>
                            <?php  
                            }
                        ?>    

                        <?php
                        $j = 0;
                        foreach ($allowance as $key => $value) { 
                            ?>
                            <tr>

                                <?php if (array_key_exists($j, $positive_allowance)) { ?>
                                    <td><?php echo $positive_allowance[$j]["allowance_type"]; ?></td>
                                    <td class="pttright reborder"><?php echo number_format($positive_allowance[$j]["amount"],2);?></td>
                                <?php }else{ echo "<td></td><td></td>";} ?>
                                <?php if (array_key_exists($j, $negative_allowance)) { ?>
                                    <td class="pttleft"><?php echo $negative_allowance[$j]["allowance_type"]; ?></td>
                                    <td class="text-right"><?php echo number_format($negative_allowance[$j]["amount"],2);?>
                                    </td>
                                <?php }else{ echo "<td></td><td></td>";} ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        ?>

                        <tr>
                            <th class="stltb"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('earning'); ?></th>
                            <th class="pttright reborder stltb"><?php echo number_format($result["total_allowance"],2);  ?></th>
                            <th class="pttleft stltb"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?></th>
                            <?php  $result["tot_deduction"]=$result["total_deduction"]+$result["leave_deduction"]; ?>
                            <th class="text-right stltb"><?php echo number_format($result["tot_deduction"],2);  ?></th>
                        </tr>  

                        
                        
                    </table>   

                    <table class="totaltable table table-striped table-responsive">
                        <tr>
                            <th width="20%" class="stltb"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></th> 
                            <td class="text-right" class="stltb"><?php echo $payment_mode[$result["payment_mode"]]; ?></td>
                        </tr>
                        <tr>
                            <th width="25%" class="stltb"><?php echo $this->lang->line('basic_salary'); ?>(<?php echo $currency_symbol; ?>)</th> 
                            <td class="text-right" class="stltb"><?php $basic =   $result["basic"]; echo  number_format($basic,2); ?></td>
                        </tr>

                        <tr>
                            <th width="25%" ><?php echo $this->lang->line('gross_salary'); ?>(<?php echo $currency_symbol; ?>)</th> 
                            <td class="text-right" class="stltb"><?php $gross_salary  = $result["basic"] + $result["total_allowance"] - $result["total_deduction"] - $result["leave_deduction"]; echo  number_format($gross_salary,2); ?></td>
                        </tr>
                        <?php if (!empty($result["tax"])) { ?>

                            <tr>
                                <th width="20%"><?php echo $this->lang->line('tax'); ?>(<?php echo $currency_symbol; ?>)</th> 
                                <td class="text-right"><?php echo $result["tax"] ?></td>
                            </tr>

                        <?php 
                        }                       
                       
                        ?>
                        <tr>
                            <th width="20%" ><?php echo $this->lang->line('net_salary'); ?>(<?php echo $currency_symbol; ?>)</th> 
                            <td class="text-right stltb "><?php echo number_format($result["net_salary"],2);?>
                            <?php $num=$result["net_salary"]?>
                        </td>
                        </tr>
                    </table>  
                    <div class="col-sm-12">
                        <table>
                        <tr>
                            <td id="numbr" class="styletbl" style="padding:5px;"></td>
                        </tr>
                    </table>
               




                    </div>
                        <div class="col-sm-12">
                        <div class="col-sm-4">
                            <?php echo("<b>Signature</b>");?><br>
                            <?php echo("(Head,Account and Estate)");?>
                        </div>
                        <div class=" col-sm-4" style="text-align: center;">
                            <?php echo("<b>Signature</b>");?><br>
                            <?php echo("(Academic Administrator)");?>
                        </div>
                        <div class="col-sm-4" style="text-align: right;">
                            <?php echo("<b>Signature</b>");?><br>
                            <?php echo("(Payee)");?>
                        </div>
                        </div>
                        </div>
            </div>
            <!--/.col (left) -->

        </div>
    </div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->





 <script type="text/javascript">  
$( document ).ready(function()
 {
  
var number = <?php echo $num ?>;  
var Inwords = toWordsconver(number);

$('#numbr').css('textTransform', 'capitalize');
$('#numbr').html("<b>Amount in Words: </b>"+Inwords+" Only");
                      
});


</script>

</html>
