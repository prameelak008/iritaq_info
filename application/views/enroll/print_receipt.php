        <!doctype html>
        <html lang="en">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="assets/img/s-favican.png">
        <meta http-equiv="X-UA-Compatible" content="" />
        
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="theme-color" content="" />
        <?php echo $this->customlib->getCSRF(); ?>   
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
        
        <!--<link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=Almarai:wght@300&display=swap" rel="stylesheet">-->
        
        
        <body>
        
        <style>
        
        html,body{
        /*height:300mm;*/
        width:292mm;
        }
        
        .clstd {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        text-transform: uppercase;
        font-size: 15px;
        }
        
        
        .clsth {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        
        font-size: 15px;
        text-transform: uppercase;
        }
        
        
        .container
        {
        width:100%;
        }
        
        .row
        {
        width:45%;
        float:left;
        }
        
        
        
        
        </style>
        
        </head>
        
        <body class="body">
        
        
        <div class="container">
        
        <div class="row" style="padding-right:100px;" >
        
        <div id="" style="width:100%; height:auto;" >
        <table style="border:0px; !important;">
        <tr>
        <td><img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%" height="120">
        </td>
        </tr>
        </table>
        </div>
        
        
        
        <div id="" style="width:100%; height:auto; " >
        <table style="font-family: arial, sans-serif; border: 1px; border-collapse: collapse; width:100%; line-height:18px; ">
        <tr>
        
        <td colspan="2" style="font-size: 15px;text-align: center;background-color: #dddddd;line-height:20px; padding-top:10px; padding-bottom:10px;">
        FEE ACKNOWLEDGEMENT SLIP
        </td>
        
        </tr>
        
        
        <tr>
        <th class="clsth">Name</th>
        <th class="clsth"><?php   echo $students_regid['firstname'];    ?></th>
        
        </tr>
        
        <tr>
        <td class="clstd" style="width:50%;">Institution ID</td>
        <td class="clstd" style="width:50%;"><?php echo $students_regid['admission_no'];    ?> </td>
        
        </tr>
        
        
        <tr>
        <td class="clstd" style="width:50%;">Register No</td>
        <td class="clstd" style="width:50%;"><?php   echo $students_regid['roll_no'];    ?>  </td>
        
        </tr>
        
        
        <tr>
        <td class="clstd" style="width:50%;">Paid Amount</td>
        <td class="clstd" style="width:50%;"><?php   echo $students_regid['studentfees_feesamount'];    ?>   
        
        </td>
        
        </tr>
        <tr>
        <td class="clstd"  style="width:50%;">Paid Amount in Words</td>
        <td class="clstd" id="numbr" style="width:50%;">
        <?php 
        $nu=numberTowords($students_regid['studentfees_feesamount'],2).'&nbsp;'.Only;
        echo $nu;     
        ?>
        
        
        
        </td>
        
        </tr>
        <tr>
        <td class="clstd" style="width:50%;">Paid For</td>
        <td class="clstd" style="width:50%;">Admission <?php   echo $students_regid['session'].'&nbsp;'.$entrance_regid['entranceexam_course_name'];    ?>  </td>
        
        </tr>
        <tr>
        
        <td class="clstd" style="width:50%;">Receipt No</td>
        <td class="clstd" style="width:50%;"><?php   echo   $students_regid['studentfees_receiptno'];   ?></td>
        
        </tr>
        <tr>
        <td class="clstd" style="width:50%;">Date</td>
        <td class="clstd" style="width:50%;"><?php  echo $students_regid['studentfees_date'];   ?></td>
        
        </tr>
        
        <tr><td colspan="2" style="line-height:19px; padding-top:20px;">Note:please retain the print  of the fee acknowledgement slip for further reference</td></tr>
        </table>
        <br>
        
        <table style="border:0px; !important;100%">
        <tr>
        <td style="width:50%;text-align:left;"><img src="<?php echo base_url();?><?php echo $entrance_regid['admission_qrcode']; ?>" width="60px" height="60px">  </td>
        
        <td style="width:50%;text-align:right;"><img src="<?php echo base_url();?><?php echo $students_regid['barcode']; ?>" width="200px" height="60px"></td>
        </tr>
        </table>
        
        
        <table style="border:0px; !important;100%;position: fixed;padding-top:80px; ">
        <tr>
        <td style="width:50%;text-align:left;font-style: italic;font-size:24px;">Candidates's Copy </td>
        </tr>
        </table>
       
        
        </div>
        </div>
        
        
        
        
        
        
        
        <div class="row" >
        <div id="" style="width:100%; height:auto;" >
        <table style="border:0px; !important;">
        <tr>
        <td><img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%" height="120">
        </td>
        </tr>
        </table>
        </div>
        
        
        <div id="" style="width:100%; height:auto; " >
        <table style="font-family: arial, sans-serif; border: 1px; border-collapse: collapse; width:100%; line-height:18px; ">
        <tr>
        
        <td colspan="2" style="font-size: 15px;text-align: center;background-color: #dddddd;line-height:20px; padding-top:10px; padding-bottom:10px;">
        FEE ACKNOWLEDGEMENT SLIP
        </td>
        
        </tr>
        
        
        <tr>
        <th class="clsth">Name</th>
        <th class="clsth"><?php   echo $students_regid['firstname'];    ?></th>
        
        </tr>
        
        <tr>
        <td class="clstd" style="width:50%;">Institution ID</td>
        <td class="clstd" style="width:50%;"><?php echo $students_regid['admission_no'];    ?> </td>
        
        </tr>
        
        
        <tr>
        <td class="clstd" style="width:50%;">Register No</td>
        <td class="clstd" style="width:50%;"><?php   echo $students_regid['roll_no'];    ?>  </td>
        
        </tr>
        
        
        <tr>
        <td class="clstd" style="width:50%;">Paid Amount</td>
        <td class="clstd" style="width:50%;"><?php   echo $students_regid['studentfees_feesamount'];    ?>   
        
        </td>
        
        </tr>
        <tr>
        <td class="clstd"  style="width:50%;">Paid Amount in Words</td>
        <td class="clstd" id="numbr" style="width:50%;">
        <?php 
        $nu=numberTowords($students_regid['studentfees_feesamount'],2).'&nbsp;'.Only;
        echo $nu;     
        ?>
        
        
        
        </td>
        
        </tr>
        <tr>
        <td class="clstd" style="width:50%;">Paid For</td>
        <td class="clstd" style="width:50%;">Admission <?php   echo $students_regid['session'].'&nbsp'.$entrance_regid['entranceexam_course_name'];    ?>  </td>
        
        </tr>
        <tr>
        
        <td class="clstd" style="width:50%;">Receipt No</td>
        <td class="clstd" style="width:50%;"><?php   echo   $students_regid['studentfees_receiptno'];   ?></td>
        
        </tr>
        <tr>
        <td class="clstd" style="width:50%;">Date</td>
        <td class="clstd" style="width:50%;"><?php  echo $students_regid['studentfees_date'];   ?></td>
        
        </tr>
        
        <tr><td colspan="2" style="line-height:19px; padding-top:20px;">Note:please retain the print  of the fee acknowledgement slip for further reference</td></tr>
        </table>
        <br>
        <table style="border:0px; !important;50%">
        <tr>
            
            
        <td style="width:50%;text-align:left;"><img src="<?php echo base_url();?><?php echo $entrance_regid['admission_qrcode']; ?>" width="60px" height="60px">  </td>
        
        <td style="width:50%;text-align:right;"><img src="<?php echo base_url();?><?php echo $students_regid['barcode']; ?>" width="200px" height="60px"></td>
        
        </tr>
        </table>
        
        <table style="border:0px; !important;100%; position: fixed;padding-top:80px; ">
        <tr>
        <td style="width:50%;text-align:right; font-style: italic;font-size:24px;    ">Office Copy </td>
        </tr>
        </table>
        
        
        </div>
        </div>
        
        
        <div id = "clear" ></div>
        </div>
        </div>
        </div>  
        
        </div>
        
        
        
        
        <?php
        function numberTowords($num)
        {
        $ones = array(
        0 =>"ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
        );
        $tens = array( 
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY", 
        4 => "FORTY", 
        5 => "FIFTY", 
        6 => "SIXTY", 
        7 => "SEVENTY", 
        8 => "EIGHTY", 
        9 => "NINETY" 
        ); 
        $hundreds = array( 
        "HUNDRED", 
        "THOUSAND", 
        "MILLION", 
        "BILLION", 
        "TRILLION", 
        "QUARDRILLION" 
        ); /*limit t quadrillion */
        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr,1); 
        $rettxt = ""; 
        foreach($whole_arr as $key => $i){
        
        while(substr($i,0,1)=="0")
        $i=substr($i,1,5);
        if($i < 20){ 
        /* echo "getting:".$i; */
        $rettxt .= $ones[$i]; 
        }elseif($i < 100){ 
        if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
        if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
        }else{ 
        if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
        if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
        } 
        if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
        }
        } 
        if($decnum > 0){
        $rettxt .= " and ";
        if($decnum < 20){
        $rettxt .= $ones[$decnum];
        }elseif($decnum < 100){
        $rettxt .= $tens[substr($decnum,0,1)];
        $rettxt .= " ".$ones[substr($decnum,1,1)];
        }
        }
        return $rettxt;
        }
        extract($_POST);
        return $num;
        ?>