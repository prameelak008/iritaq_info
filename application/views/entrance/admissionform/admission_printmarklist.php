            <style type="text/css">
            .tableclas
            {
            border:2px solid #b6b2b2; 
            text-align:left;
            
            line-height:30px;
            
            }
            </style>
            
            
            <div class="container-xxl py-5"> 
            <div class="container">
            <div class="col-md-6" style="height:auto; float:none;margin:auto;">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
            <label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >Applicant Status&nbsp; - &nbsp; <?php   echo $applicant['fees_entrancepayment_year']; ?></label>
            </div>
            
            
            
            <table style="width:100%; " class="tableclas" >
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Application No</td>
            <td  class="tableclas" style="padding-left:4px; "><?php echo $applicant['admission_application_no'];  ?></td>
            </tr>    
            
            
            <tr  class="tableclas">
            <td  class="tableclas " style="padding-left:4px; ">Name</td>
            <td  class="tableclas " style="padding-left:4px; "><?php echo $applicant['admission_name'];  ?></td>
            </tr>
            
            <tr  class="tableclas">
            <td  class="tableclas " style="padding-left:4px; ">Mobile</td>
            <td  class="tableclas " style="padding-left:4px; "><?php echo $applicant['admission_mobile'];  ?></td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas " style="padding-left:4px; ">Father Name</td>
            <td  class="tableclas " style="padding-left:4px; "><?php echo $applicant['admission_fathername'];  ?></td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas " style="padding-left:4px; ">House Name</td>
            <td  class="tableclas " style="padding-left:4px; "><?php echo $applicant['admission_housename'];  ?></td>
            </tr>
            
            <?php
            
            $sl=1;
            
            foreach($applicantstatus as $appl)
            {
            ?>
            
            <tr  class="tableclas">
            <td  class="tableclas " colspan="2" style="padding-left:4px; text-align:center; color:#7c94c5; "><b>Payment Status- <?php  echo $sl;  ?> Transaction</b></td>
            
            </tr>
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Paid Amount</td>
            <td  class="tableclas" style="padding-left:4px; "><?php echo number_format($appl['fees_entrancepayment_amount'],2);  ?></td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Paid Amount in Words</td>
            <td  class="tableclas" style="padding-left:4px; "><?php   $nu= numberTowords(520); 
            echo 'Rupees &nbsp;'.ucwords($nu).''.' Only/-';  ?></td>
            </tr>
            
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Paid For</td>
            <td  class="tableclas" style="padding-left:4px; "><?php echo $appl['entranceexam_course_name'];  ?></td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Transaction ID</td>
            <td  class="tableclas" style="padding-left:4px; "><?php echo $appl['fees_entrancepayment_transaction_no'];  ?></td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Date :</td>
            <td  class="tableclas" style="padding-left:4px; "><?php echo $appl['fees_entrancepayment_transdate'];  ?></td>
            <input type="hidden" name="amount" value="520.00" >
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; ">Status :</td>
            <td  class="tableclas" style="padding-left:4px; ">
            
            <?php
            
            if($appl['fees_entrancepayment_statuscode']=='S')
            {
            $st="Success";
            }
            elseif($appl['fees_entrancepayment_statuscode']=='F')
            {
            $st="Failed";  
            }
            else
            {
            $st="No Transcation Found";
            }
            
            echo $st;  ?></td>
            <input type="hidden" name="amount" value="520.00" >
            </tr>
            
            <?php 
            $sl++;
            
            } 
            ?>
            
            
            
            </table>
            <br>
            <br>
            
            
            
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
            
            
            
            
            </div>
            </div>
            </div>
            </div>
            
