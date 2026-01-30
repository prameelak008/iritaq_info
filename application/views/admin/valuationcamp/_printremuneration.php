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
        
        <style>
        
        
        @media print {
        .pagebreak {
        page-break-after: always;
        page-break-inside: avoid; 
        } /* page-break-after works, as well */
        }
            
        page[size="A4"] 
        {  
        width: 21cm;
        height: 29.7cm;
        font-size:10px;
        }
        
        
        page[size="A5"] 
        {
        font-size:5px;
        }
        
        
        .firsttable
        {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 2px;
        font-size:12px;
        }
        
        .heading
        {
        font-size:15px; 
        }
        </style>
        
        </head>
        <body class="body">
        <page >  
        <?php
      
        
        $total=0;
        foreach($staffdetails['staff'] as $stf_detail)
        {
        ?> 
        <div class="container">
        <div class="cont">    
        <div class="row">
        <div id="" style="width:100%; height:auto;" >
        <table style="width:100%; height:auto;">
        <tr>
        <td style=" text-align:center;">
        <img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="80%" height="100"  >
        </td>
        </tr>
        </table>
        <hr style=" border: 1px solid black; width:100%;"></hr>
        <table style="width:100%;">
        <tr rowspan="2"><td class="heading" colspan="2" style="text-align:center; font-size:15px; font-weight:bold;">REMUNERATION PAYMENT SLIP</td></tr>
        <tr rowspan="2"><td colspan="2" style="text-align:center;"></td></tr>
        <tr rowspan="2"><td colspan="2" style="text-align:center;"></td></tr>
        <tr class="firsttable">
        <td style="width:50%">Slip No: <?php 
        
          $print=$staffdetails['print'];
          
          foreach($print as $prnt =>$pnt)
          {
              
          if ($pnt['print_staff_id'] == $stf_detail['staffid'] &&  $pnt['print_center_id'] == $stf_detail['valuation_centerid'] )
          {
          echo $pnt['print_id']; 
          }
          }
        
        
        echo   $print['print_id'];  ?></td>
        <td style="width:50%;text-align:right;">Date:<?php echo date('d-F-Y'); ?></td>
        </tr>
        </table>
        
        <table width="100%" >
        <tr class="firsttable">
        <td class="firsttable">Valuation Camp Name</td><td class="firsttable"><?php echo $stf_detail['valuation_centername'];  ?></td>
        </tr>
            
        <tr class="firsttable">
        <td class="firsttable">Period</td><td class="firsttable"><?php echo $stf_detail['valuation_centerfromdate'].'&nbsp;&nbsp;'.$stf_detail['valuation_centertodate'];  ?></td>
        </tr>    
            
        <tr class="firsttable">
        <td class="firsttable">Exam Group</td><td class="firsttable"><?php echo $stf_detail['groupname'];  ?></td>
        </tr>
        
        <!--
        <tr class="firsttable">
        <td class="firsttable">Exam Name</td><td class="firsttable"><?php echo $stf_detail['exam'];  ?></td>
        </tr>
        -->
        
        <tr class="firsttable">
        <td class="firsttable">Staff Name</td><td class="firsttable"><?php echo $stf_detail['staffname'].'&nbsp;'.$stf_detail['surname'];  ?></td>
        </tr>
        
         <tr class="firsttable">
        <td class="firsttable">Staff ID</td><td class="firsttable"><?php echo $stf_detail['employee_id'];  ?></td>
        </tr>
        
        <tr class="firsttable">
        <td class="firsttable">Contact</td><td class="firsttable"><?php echo $stf_detail['contact_no'];  ?></td>
        </tr>
        </table>
        
        <table style="height:auto;" >
            <tr>
                <td>
                    <b>Details</b>
                </td>
            </tr>
        </table>
        
        <!--
        <tr  class="tableclas">
        <td  class="tableclas" style="padding-left:4px; ">Paid Amount in Words</td>
        <td  class="tableclas" style="padding-left:4px; ">
        <?php
        $nu= numberTowords(520); 
        echo 'Rupees &nbsp;'.ucwords($nu).''.' Only/-'; 
        ?>
         </td>
        </tr>
        -->
       
        <table width="100%"  >
        <tr class="firsttable"><td class="firsttable">No</td><td class="firsttable">Subject Code</td><td class="firsttable">Subject Name</td><td class="firsttable">Count Of Papers</td><td class="firsttable">Amount</td></tr>
        
        <?php
        $countsum      =    0;
        $amtsum        =    0;
     $countsubcode=0;
        $slno     =     1;
        foreach($staffdetails['assignedsubjects'] as $assigned)
        {
       
        foreach($assigned as $assg)
        {   
        if ($assg['staffid'] == $stf_detail['staffid'] )
        {
        $total=$assg['valuation_countofpaper']*$assg['valuation_amount'];
        ?>
        <tr class="firsttable">
        <td class="firsttable"><?php echo $slno;  ?></td>
        <td class="firsttable"><?php echo $assg['subjectcode'];  ?></td>
        <td class="firsttable"><?php echo $assg['subjectname'];  ?></td>
        <td class="firsttable"><?php echo $assg['valuation_countofpaper'];  ?></td>
        <td class="firsttable"><?php echo $total;  ?></td>
        </tr>
        <?php
        
        $countsum+=$assg['valuation_countofpaper'];
        $amtsum+=$total;
         $slno++;
        }
    
        
       
        }
        ?>
        <?php
        }
        ?>
        <tr style="font-weight:bold;">
        <td class="firsttable"></td>
        <td class="firsttable"><?php echo $this->lang->line('total'); ?></td>
        <td class="firsttable"><?php echo $slno-1; ?>   </td>
        <td class="firsttable"><?php echo $countsum ?></td>
        <td class="firsttable"><?php echo $amtsum; ?></td>
        </tr>
        </table>
        <p >
        <?php
        $nu= numberTowords($amtsum); 
        //echo '(Amount in Words: &nbsp;'.ucwords($nu).''.' ONLY )';  ?>
        
         <span style="font-size:12px;"><b>(Amount in Words: &nbsp;&nbsp;</b><?php  echo ucwords(strtolower($nu)); ?> &nbsp;<b>Only)</b></span>
         
         
          
          
         </p>
        <br>
        <table width="100%"  >
        <tr>
            <td style="text-align:left;width:70%;">Controller Of Examination
            <br>
            <br>
            Signature
            <br>
            </td>
            <td style="text-align:left;width:40%;">Name:<?php echo $stf_detail['staffname'].'&nbsp;'.$stf_detail['surname'];  ?>
            <br>
            <br>Signature:</td>
        </tr>
        <tr>
        <td style="text-align:left;width:50%;">
            <?php   
            foreach($print as $prnt =>$pnt)
            {
            
            if ($pnt['print_staff_id'] == $stf_detail['staffid'] &&  $pnt['print_center_id'] == $stf_detail['valuation_centerid'] )
            {
            ?>
            
            <img src="<?php echo base_url(); ?>/<?php echo $pnt['print_qrcode']; ?>" style="width:80; height:80;"  />
            <?php
            }
            }
            ?>
       
        </td>
        <td style="text-align:right;">
          <?php   
            foreach($print as $prnt =>$pnt)
            {
            if ($pnt['print_staff_id'] == $stf_detail['staffid'] &&  $pnt['print_center_id'] == $stf_detail['valuation_centerid'] )
            {
            ?>
            <img src="<?php echo base_url(); ?>/uploads/valuationcamp/print_remuneration/barcode/<?php echo $pnt['print_barcode']; ?>" style="width:200; height:50;"  />
            <?php
            }
            }
            ?>  
        </td>
        </tr>
        </table>
        </div>
        </div>
        </div>
        </div>
        <div class="pagebreak"></div>
        
        
         <?php } ?>
        </page>
        
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
        
        