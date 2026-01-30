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
<body>

<style>
table 
{

}


.tableclas
{
border:2px solid #b6b2b2; 
text-align:left;

line-height:30px;
}
</style>



    </head>
    <body class="body">
    <div class="container">
    <div class="row" >
    <div id="" style="width:100%; height:auto;" >
    
    <div class="wow fadeInUp" data-wow-delay="0.2s">
    <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="100%" height="120px" style="text-align:center;">
    </div>
    
    
    <hr style="	border: 1px solid #c1c2c2;"></hr>
    <table style="border:0px; !important;"  class="tableclas">
    <tr>
    <td>
    </td>
    </tr>
    </table>
    </div>



<div id="" style="width:100%; height:auto; " >
<table style="font-family: arial, sans-serif; border: 1px; border-collapse: collapse; width:100%; line-height:18px; ">
<tr>
<td colspan="2" style="text-align: center;line-height:20px;  font-size:15px;color:black;padding:5px 5px 5px 5px;">
PAYMENT RECEIPT-&nbsp;&nbsp;<?php   echo $paymentreceipt['fees_entrancepayment_year']; ?>
</td>
</tr>

<tr>
<td colspan="2" style="padding-top:3px; padding-bottom:10px;">
&nbsp;
</td>
</tr>


        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Application No</td>
        <td  class="tableclas" style="padding-left:4px; "><?php echo $paymentreceipt['admission_application_no'];  ?></td>
        </tr>   
            
            
        <tr  class="tableclas">
        <td  class="tableclas " style="padding-left:4px; ">Name</td>
        <td  class="tableclas " style="padding-left:4px; "><?php echo $paymentreceipt['admission_name'];  ?></td>
        </tr>
        
   
        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Paid Amount</td>
        <td  class="tableclas" style="padding-left:4px; "><?php echo number_format($paymentreceipt['fees_entrancepayment_amount'],2);  ?></td>
        </tr>
        
        
        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Paid Amount in Words</td>
        <td  class="tableclas" style="padding-left:4px; "><?php   $nu= numberTowords(520); 
         echo 'Rupees &nbsp;'.ucwords($nu).''.' Only/-';  ?></td>
        </tr>
        
        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Paid For</td>
        <td  class="tableclas" style="padding-left:4px; "><?php echo $paymentreceipt['entranceexam_course_name'];  ?></td>
        </tr>
        
        
        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Transaction ID</td>
        <td  class="tableclas" style="padding-left:4px; "><?php echo $paymentreceipt['fees_entrancepayment_transaction_no'];  ?></td>
        </tr>
        	
        
        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Date :</td>
        <td  class="tableclas" style="padding-left:4px; "><?php echo $paymentreceipt['fees_entrancepayment_transdate'];  ?></td>
        <input type="hidden" name="amount" value="520.00" >
        </tr>


  
  
  <tr><td colspan="2" style="line-height:19px; padding-top:20px;">Note:please retain the print  of the fee acknowledgement slip for further reference</td></tr>
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