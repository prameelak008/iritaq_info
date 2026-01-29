
        
        <style type="text/css">
        
        
        .tableclas
        {
        border: 1px black solid; 
        
        
        }
        </style>
        
        
                
            <div class="container-xxl py-5"> 
            <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            </div>
            
            <div class="col-md-6" style="height:auto; float:none;margin:auto;">
            <div class="wow fadeInUp" data-wow-delay="0.2s">                          
            
            
            
            <form action="<?php echo site_url('entrance/home/meTrnReq'); ?>" method="POST"> 
            
            <table style="width:100%; " class="tableclas" >
            <tr  class="tableclas">
            <td  class="tableclas " style="padding-left:4px; text-align:center;" ><b>No</b></td>
            <td  class="tableclas " style="padding-left:4px;  text-align:center;"><b>Description</b></td>
            <td  class="tableclas " style="padding-left:4px; text-align:center;"><b>Amount</b></td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; text-align:center;">1</td>
            <td  class="tableclas" style="padding-left:4px; text-align:center;">Application Fee</td>
            <td  class="tableclas" style="padding-left:4px; text-align:center;">Rs. 500</td>
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; text-align:center;">2</td>
            <td  class="tableclas" style="padding-left:4px; text-align:center;">Processing Charge</td>
            <td  class="tableclas" style="padding-left:4px; text-align:center;">Rs.20</td>
            </tr>
            
            
            
            
            <tr  class="tableclas">
            
            
            <td  class="tableclas" style="padding-left:4px; text-align:center; border-right-color: white;"></td>
            <td  class="tableclas" style="padding-left:4px; text-align:center;;"><b>Total</b></td>
            <td  class="tableclas" style="padding-left:4px; text-align:center;"><b>Rs.520</b></td>
            
            
            <input type="hidden" name="amount" value="520.00" >
            </tr>
            </table>
            <br>
            
            <p><input type="checkbox" required="required" name="proccedpayementcheck" id="proccedpayementcheck" >&nbsp;&nbsp;By clicking <b>Paynow</b> you are agreeing to the <a  style="display: inline-block;height: 15px;" target="_blank" href="https://iritaq.info/termsandcondition.html">Terms and Conditions</a> </span></p>
            
            <p style="text-align:right;"><b><?php   $nu= numberTowords(520); 
            echo 'Rupees &nbsp;'.ucwords($nu).''.' Only/-';  ?></b></p>
            
            <br>
            
            <table style="border: 0px black solid; width:100%">
            <tr style="border: 0px black solid;">
            <td colspan="3" style="text-align:right; padding-right:40px;" >           
            <input type="submit" name="submit" class="btn btn-success" value="PAY NOW" ></td>
            </tr>
            </table>
            </form>
        
        
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
        
