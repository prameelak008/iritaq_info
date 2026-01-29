        <!DOCTYPE html>
        <html>
        <head>
        <link href='https://fonts.googleapis.com/css?family=Noto Sans Malayalam' rel='stylesheet'>
        <style type="text/css">
        @media print {
        .pagebreak {
        clear: both;
        page-break-after: always;
        }
        }
        
        
        
        }
        </style>
        <style>
        @page 
        {
        size: 21cm 29.7cm;
        margin: 5mm 5mm 5mm 5mm;
        /* change the margins as you want them to be. */
        
        }
        
        @media print {
        body
        {
        width: 21cm;
        height: 29.7cm;
        margin: 30mm 40mm 60mm 40mm; 
        
        /* change the margins as you want them to be. */
        } 
        }
        
        
        
        
        
        body
        {
        padding: 0;  font-family: arial; color: #000; font-size: 13px; line-height: 8px;
        }
        /*.tableone{}*/
        /*.tableone td{border:1px solid #000; padding: 5px 0}*/
        /*.denifittable th{border-top: 1px solid #999;}*/
        /*.denifittable th,*/
        /*.denifittable td {border-bottom: 1px solid #999;*/
        
        /* border-collapse: collapse;border-left: 1px solid #999;}*/
        /*.denifittable tr th {padding: 3px 3px; font-weight: normal;}*/
        /*.denifittable tr td {padding: 3px 3px; font-weight: normal;}*/
        
        
        .tcmybg 
        {
        background:top center;
        background-size: 100% 100%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
        }
        
        .tablemain{
        }
        
        .subtable
        {
        z-index: 1;
        border:2px solid #000; height: 30px;
        width:700px; 
        
        }
        
        
        
        .subtablesec
        {
        border:2px solid #000; height: 1050px;
        width:750px; 
        
        }
        
        
        
        *{
        box-sizing: border-box;
        }
        
        .tableclas
        {
        border: 1px black solid; 
        width:50%;
        line-height:13px;
        }
        
        .row {
        margin-left:-5px;
        margin-right:-5px;
        }
        
        .column 
        {
        float: left;
        width: 50%;
        padding: 5px;
        }
        
        .columnn {
        float: left;
        width: 50%;
        padding: 5px;
        }
        
        
        .colm
        {
        width:100px;
        }
        /* Clearfix (clear floats) */
        .row::after {
        content: "";
        clear: both;
        display: table;
        
        }
        
        
        
        /* Clearfix (clear floats) */
        .roww::after {
        content: "";
        clear: both;
        display: table;
        }
        
        
        /*table*/
        .tab
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        /*border: 1px solid #ddd;*/
        }
        
        
        .tabclss
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 0px solid #00000;
        }
        
        .taclss
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 0px solid #00000;
        text-align:center;
        }
        
        .center
        {
        margin-left: auto;
        margin-right: auto;  
        }
        
        
        
        th, td {
        text-align: left;
        padding: 6px;
        line-height:10px;
        font-size:13px;
        }
        
        tr:nth-child(even)
        {
        /*background-color: #f2f2f2;*/
        }
        
        
        .first_td
        {
        width:80px !important;
        line-height:10px;
        }
        
        
        
        
        .second_td
        {
        width:2px;
        line-height:normal;
        }
        
        .third_td
        {
        width:40px;
        text-align:left;
        line-height:10px;
        }
        
        .sub
        {
        width:100%;
        }
        
        
        
        hr.hrcls
        {
        border-top: 1px solid #8c8b8b;
        }
        
        .cent
        {
        text-align:center;
        padding:10px 10px 10px 10px;
        }
        </style>
                
                
                </head>
                <body>
                <div class="tablemain">
                <div class="subtablefirst" style="height: 1020px; index:1; border:2px solid #000;">
                
                <div class="sub" style="height:100px;">
                <p style="text-align:center;">

                
                <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="580px" height="90px">-->

                <img src="<?php echo FCPATH.'entrance/payment_code/'.$pdfimage['header_image']; ?>" width="580px" height="90px">

                </p>
                <hr style="	border: 1px solid #c1c2c2; width:680px;"></hr>
                </div>
                
                
                <div class="sub" >
                <div class="row">
                <div class="column">
                <br>
                
                
                <table class="tab" >
                <tr style=" height:20px;">
                     
                    
                <td colspan="3"><b style="font-size:14px;">APPLICATION FOR &nbsp;
              
                <?php echo $courses['entranceexam_course_name'];?></b></td> 
                </td>
                </tr> 
                
                
                <tr>
                <td class="first_td" >Name Of Applicant</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_name'];     ?>
                </td>
                </tr>
                
                
                
                
                <tr>
                <td class="first_td">House Name</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_housename'];?></td>
                </tr>
                
                
                <tr>
                <td class="first_td">Name of Father</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_fathername'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Job of Father</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_fatheroccupation'];?></td>
                </tr>
                
                
                <tr>
                <td class="first_td">Address</td>
                <td class="second_td">:</td>
                <td class="third_td" style="line-height: 1.3;"><?php echo $admission['admission_address'];?></td>
                </tr>
                
                
                <tr>
                <td class="first_td">Name of Mother</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_mothername'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Mobile No &nbsp;&nbsp;</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_mobile'];?></td>
                </tr>
                </table>
                </div>
                
                
                
                
                <div class="column"> <br>
                <table>
                <tr>
                <td colspan="3" style="text-align:center" >
                <h3><b>Application No:<?php echo $admission['admission_application_no'];?></b></h3>
                <br>
                <!-- <img src="<?php echo base_url();?>entrance/admissionphoto/<?php echo $admission['admission_photo'];?>" style="height:140px; width:110px;" > -->
                 <img src="<?php echo FCPATH.'entrance/admissionphoto/'.$admission['admission_photo']; ?>" style="height:140px; width:110px;">

                </td>
                </tr>
                
                
                
                <tr>
                <td class="first_td" >Date of Birth</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_dob'];?></td>
                </tr>
                
                
                <tr>
                <td class="first_td">House Name Of Mother</td>
                <td class="second_td">:</td>
                <td class="third_td"  style="line-height: 1.3;"><?php echo $admission['admission_motherhousename'];?></td>
                </tr>
                
                
                </table>
                </div>
                </div>
                
                <hr style="border: 1px solid #c1c2c2; width:680px;"></hr>
                </div>
                
                
                
                <div class="sub">
                <div class="roww">
                <div class="columnn">
                <table>
                <tr>
                <td class="first_td">Adhaar No </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_adharno'];?></td>
                </tr>
                <tr>
                <td class="first_td">Thaluk</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_thaluk'];?></td>
                </tr>
                <tr>
                <td class="first_td">Village</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_village'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Mahallu</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_mahallu'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">District</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['district_name'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">State</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['state_name'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Are you an Orphan?</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_iforphan'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Identification Mark</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_identification'];?></td>
                </tr>
                
                </table>
                </div>
                <div class="column">
                <?php
                if ($courses['entranceexam_course_id'] == 3 ) 
                {
                ?>
                <table>
                <tr>
                <td class="first_td">Last Studied Institute
                </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['last_studied_institute'];?></td>
                </tr>
                <tr>
                <td class="first_td">Years Completed</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['years_completed'];?></td>
                </tr>
                <tr>
                <td class="first_td">Name Of Prominent Teacher</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['Name_Prominent_Teacher'];?></td>
                </tr>
                <tr>
                <td class="first_td">Repitition Completed</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['Repitition_Completed'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">General Education</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['General_Education'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Place Of Institution</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['PlaceOf_Institution'];?></td>
                </tr>
                </table>
                <?php
                }
                else if ($courses['entranceexam_course_id'] == 5 ) 
                {
                ?>
                <table>
                <tr>
                <td class="first_td">Last Studied Institute
                </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['last_studied_institute'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Years Completed</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['years_completed'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Name Of Prominent Teacher</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['Name_Prominent_Teacher'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Major Books Studied</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['Major_Books_Studied'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">General Education</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['General_Education_mutawal'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Place Of Institution</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $check_address['PlaceOf_Institution'];?></td>
                </tr>
                </table>
                <?php
                }
                else 
                {
                ?>
                <table>
                <tr>
                <td class="first_td">Register No</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_range'];?></td>
                </tr>    
                    
                <tr>
                <td class="first_td">Last Studied Madrassa Class
                </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_laststudiedmadarsa'];?></td>
                </tr>
               
                <tr>
                <td class="first_td">Last Studied School Class</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_laststudied'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Name of Madrassa :
                </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_nameofmadarsa'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Name of School</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_schoolname'];?></td>
                </tr>
                
                <tr>
                <td class="first_td">Medium Of School</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_medium'];?></td>
                </tr>
                </table>
                <?php
                }
                ?>
                
                </div>
                </div>
                <hr style="border: 1px solid #c1c2c2; width:680px;"></hr>
                </div>
                
                
                <div class="sub">
                <table> 
                <!--<tr>-->
                <!--<td class="first_td">Admission Options</td>-->
                <!--<td class="second_td">:</td>-->
                <!--<td class="third_td">1.<?php echo $admission['admission_institute_optionone'];?></td>-->
                <!--</tr>-->
                
                <!--<tr>-->
                <!--<td class="first_td"></td>-->
                <!--<td class="second_td">:</td>-->
                <!--<td class="third_td">2.<?php echo $admission['admission_institute_optiontwo'];?></td>-->
                <!--</tr> -->
                
                <!--<tr>-->
                <!--<td class="first_td"></td>-->
                <!--<td class="second_td">:</td>-->
                <!--<td class="third_td">3.<?php echo $admission['admission_institute_optionthree'];?></td>-->
                <!--</tr> -->
                
                
                <tr>
                <td class="first_td">Entrance Exam Center</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $admission['admission_institute_examcenter'];?></td>
                </tr> 
                </table>
                </div>
                
                
                
                
                
                <div class="sub">
                <table style="width:680px; height:120px;" >
                    
                <tr>
                <td>
                    
                <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['pledge'];?>" style="width:700px; height:120px;"/> -->
            <img src="<?php echo FCPATH.'entrance/payment_code/'.$pdfimage['pledge']; ?>" style="width:700px; height:120px;"/>

            </td>
                </tr>
                </table>
                
                <table style="width:760px;height:60px" >
                <tr>
                <td style="width:500px;">Date :<?php echo date('d-m-Y') ?></td>
                <td style="width:300px;"> Signature:</td>
                </tr>
                
                <tr>
                <td style="width:70%;">Place :</td><td style="width:50%;"> Guardian Name:<?php echo $admission['admission_guardian'];?></td>
                </tr>
                </table>
                </div>
                
                </div>
                <br>
                <br>
                 <div class="pagebreak"> </div> 
                <br>
                <div>
                    
                    
               
                
                <div class="subtablesec">
                    <br>
                    <br>
                <div class="sub">
                    
                    
                    
                <table  class="taclss " style="line-height:3px; width:700px;  padding-left:20px;text-align:left;">
                
                <tr>
                <td colspan="2"><span style="font-size:15px; font-weight:bold; color:#47474c;">Payment Details</span>
                </td>
                </tr>
                
                <tr>
                <td colspan="2"><span style="font-size:16px; font-weight:bold; color:#47474c;"></span>
                </td>
                </tr>
                
                <tr  class="tableclas">
                <td  class="tableclas">Name</td>
                <td  class="tableclas"><?php echo $admission['admission_name'];?></td>
                </tr>
                
                
                <tr  class="tableclas">
                <td  class="tableclas">Application Number</td>
                <td  class="tableclas"><?php echo $admission['admission_application_no'];?></td>
                </tr>
                
                
                <tr  class="tableclas">
                <td  class="tableclas">Paid Amount</td>
                <td  class="tableclas"><?php echo  $fee_details['fees_entrancepayment_amount'];    ?></td>
                </tr>
                <tr  class="tableclas">
                <td  class="tableclas">Paid Amount in Words</td>
                <td  class="tableclas"><?php   $nu= numberTowords($fee_details['fees_entrancepayment_amount'],2); 
                echo 'Rupees &nbsp;'.ucwords($nu).''.' Only/-';  ?>
                </p>
                </td>
                </tr>
                <tr  class="tableclas">
                <td  class="tableclas">Paid For</td>
                <td  class="tableclas"><?php echo $courses['entranceexam_course_name'];?></td>
                </tr>
                <tr  class="tableclas">
                <td  class="tableclas">Transaction ID</td>
                <td  class="tableclas"><?php echo $fee_details['fees_entrancepayment_transaction_no'];    ?></td>
                </tr>
                <tr  class="tableclas">
                <td  class="tableclas">Date</td>
                <td  class="tableclas"><?php echo $fee_details['fees_entrancepayment_transdate'];    ?></td>
                </tr>
                </table>
                </div>
                <br>
                <br>
                
                
                
                
                
                <div class="sub">
                <table  class="taclss left" style="line-height:3px; width:70px;  padding-left:10px;text-align:left;">
                
                <tr>
                <td colspan="2"><span style="font-size:15px; font-weight:bold; color:#47474c;">Entrance Exam Details</span></td>
                </tr>
                
                <tr>
                <td colspan="2">
                <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/entranceexamdetails.png" width="700px" height="260px"> -->

                <img src="<?php echo FCPATH . 'entrance/payment_code/entranceexamdetails.png'; ?>" 
     width="700px" 
     height="260px">

                </td> 
                </tr>
                </table>
                </div>
                
                
                
                <div class="sub">
                <hr style="border: 1px solid #c1c2c2; width:680px;"></hr>
                </div>
                
                
                <div class="sub">
                <table class="taclss center" style="line-height:8px; width:650px;  padding-left:10px;text-align:center;">
                <tr>
                <td colspan="4"><span style="font-size:16px; font-weight:bold; color:#47474c;">For Office Use Only</span></td>
                </tr>
                
                
                <tr>
                <td colspan="2"><span style="font-size:12px; font-weight:normal; color:#47474c;">Admission No:.................................................</span></td>
                <td colspan="2"><span style="font-size:12px; font-weight:normal; color:#47474c;">Date Of Admission:..............................................</span></td>
                </tr>
                
                
                <tr style=" text-align:center; background-color:#adb0b4;">
                <td colspan="4" class="tableclas cent"><span style="font-size:16px; font-weight:bold; color:#47474c; text-align:center;margin-top:10px; ">ENTRANCE EXAM MARKS DETAILS</span></td>
                </tr>
                <tr>
                <td class="tableclas cent">WRITTEN</td>
                <td class="tableclas cent">VIVA</td>
                <td  class="tableclas cent">TOTAL</td>
                <td class="tableclas cent">RANK</td>
                </tr>
                
                <tr>
                <td class="tableclas cent">&nbsp;</td>
                <td class="tableclas cent">&nbsp;</td>
                <td class="tableclas cent">&nbsp;</td>
                <td class="tableclas cent">&nbsp;</td>
                </tr>
                
                <tr>
                <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                <td colspan="2"><span style="font-size:12px; font-weight:normal; color:#47474c; padding-top: 10px;">Checked By:.................................................................</span></td>
                <td colspan="2"><span style="font-size:12px; font-weight:normal; color:#47474c; padding-top: 10px;">Signature:..............................................................................................................</span></td>
                </tr>
                
                
                <tr>
                <td colspan="2"><span style="font-size:12px; font-weight:normal; color:#47474c;">File Number:..................................................................</span></td>
                <td colspan="2"><span style="font-size:12px; font-weight:normal; color:#47474c;">Signature Academic Administrator:.......................................................................</span></td>
                </tr>
                
                <tr>
                <td  colspan="4"><span style="font-size:12px; font-weight:normal; color:#47474c;">Remarks..............................................................................................................................................................................................................</span></td>
                
                </tr>
                
                
                </table> 
                <br>
                <br>
                </div>
                
                
                <div class="sub">
                <hr style="border: 1px solid #c1c2c2; width:680px; "></hr>
                </div>
                
                <div class="sub" style="text-align:center;">
                <p><span>Mundkkulam Muthuparambha Post,Kondotty,Malappuram,Kerala,India-673 638</span></p>
                <p>www.jamiajalaliyya.com,email:jamiajalaliyya@gmail.com</p>
                <p style="color:#3864ac;"><b>Ph:0483 2962 786,7947 232 786,9496 446093</b></p>
                </div>
                
                
                <div class="sub">
                <table style="width:100%;">
                <tr><td style="width:50%; text-align:left;padding-left:60px;">
                <!-- <img src="<?php echo base_url();?><?php echo $admission['admission_qrcode'];?>" class="content-img" alt="<?php echo $admission['admission_qrcode'];?>"  style="height:100px; width:100px; margin-top:2px;" > -->
              <img src="<?php echo FCPATH . $admission['admission_qrcode']; ?>" 
     class="content-img" 
     alt="QR Code"  
     style="height:100px; width:100px; margin-top:2px;" >

           
               </td>
                
                
                <td  style="width:50%; text-align:right; padding-right:60px">
                <!-- <img src="<?php echo base_url();?><?php echo $admission['barcode'];?>" class="content-img" alt="<?php echo $admission['barcode'];?>"  style="height:60px; width:200px; margin-top:2px;" >      -->
                <img src="<?php echo FCPATH . $admission['barcode']; ?>" 
     class="content-img" 
     alt="Barcode"  
     style="height:60px; width:200px; margin-top:2px;" >             
            </td>
                </tr>
                
                
                </table>
                </div>
                
                </div>
                </div>
                <div class="pagebreak"> </div>
                
                </div>  
                
                </div>
                
                
                
                
                <?php
                function numberTowords($num)
                { 
                $ones = array( 
                1 => "one", 
                2 => "two", 
                3 => "three", 
                4 => "four", 
                5 => "five", 
                6 => "six", 
                7 => "seven", 
                8 => "eight", 
                9 => "nine", 
                10 => "ten", 
                11 => "eleven", 
                12 => "twelve", 
                13 => "thirteen", 
                14 => "fourteen", 
                15 => "fifteen", 
                16 => "sixteen", 
                17 => "seventeen", 
                18 => "eighteen", 
                19 => "nineteen" 
                ); 
                $tens = array( 
                1 => "ten",
                2 => "twenty", 
                3 => "thirty", 
                4 => "forty", 
                5 => "fifty", 
                6 => "sixty", 
                7 => "seventy", 
                8 => "eighty", 
                9 => "ninety" 
                ); 
                $hundreds = array( 
                "hundred", 
                "thousand", 
                "million", 
                "billion", 
                "trillion", 
                "quadrillion" 
                ); //limit t quadrillion 
                $num = number_format($num,2,".",","); 
                $num_arr = explode(".",$num); 
                $wholenum = $num_arr[0]; 
                $decnum = $num_arr[1]; 
                $whole_arr = array_reverse(explode(",",$wholenum)); 
                krsort($whole_arr); 
                $rettxt = ""; 
                foreach($whole_arr as $key => $i){ 
                if($i < 20){ 
                $rettxt .= $ones[$i]; 
                }elseif($i < 100){ 
                $rettxt .= $tens[substr($i,0,1)]; 
                $rettxt .= " ".$ones[substr($i,1,1)]; 
                }else{ 
                $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                $rettxt .= " ".$tens[substr($i,1,1)]; 
                $rettxt .= " ".$ones[substr($i,2,1)]; 
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
                
                
                return($num);
                ?>
                
                
                </body>
                
                </html>
                
                
               <script type="text/javascript">
            $(document).ready(function()
            {
              
            var coursename_ajx= $('#coursename_ajx').val();
            if(coursename_ajx=="MUTHAWWAL")
            {
            $('#previous').hide();   
            $('#main_previous').show();   
            $('#Major_Books_Studied_ajx').show(); 
            $('#general_education_mutajx').show(); 
            $('#general_education_huffaz_ajx').hide(); 
            $('#Repitition_Completed_ajx').hide(); 
            }
            else if(coursename_ajx=="THAJLIYATHUL HUFFAZ")
            {
            $('#previous').hide();     
            $('#main_previous').show();  
            $('#Major_Books_Studied_ajx').hide();  
            $('#Repitition_Completed_ajx').show(); 
            $('#general_education_mutajx').hide();
            $('#general_education_huffaz_ajx').show(); 
            }
            else
            {
            $('#main_previous').hide();   
            $('#previous').show();
            }
            });  
                
                
