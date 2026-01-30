            <?php
            if(isset($this->session->userdata['logged_in']))
            {
            $session_studid  = $this->session->userdata['session_studid']; 
            $name            = $this->session->userdata['name']; 
            }                 
            ?>
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            
            
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
            
            
            <meta charset="utf-8">
            <title>Cash Transaction</title>
            <style>
            body{
            font-family:Verdana, sans-serif	;
            font-size::12px;
            }
            .wrapper{
            /*width:980px;*/
            margin:0 auto;	
            }
            table{
            
            }
            tr{
            padding:5px
            }
            td{
            padding:5px;	
            }
            input{
            padding:5px;	
            }
            </style>
            
            
            <script type="text/javascript">
            function getData()
            {
            var d = new Date();
            var n = d.getTime();
            var orderID = n +  '' +randomFromTo(0,1000);
            
            document.getElementById("orderId").value = orderID;
            return true;
            }
            
            function randomFromTo(from, to){
            return Math.floor(Math.random() * (to - from + 1) + from);
            }
            
            
            </script>
            </head>
            <body onload="getData();">
            <div class="wrapper">
            <br>
            <br>
            <center> <H3>  </H3></center>
            
            
            <form action="<?php  echo site_url('user/improvement/meTrnPayment_improvement');?>" method="post">
            <table width="100%" >
            <tr hidden>
            <td><label for="one"> Order No.</label></td>
            <td><input type="text" value="" id="orderId" name="orderId"></td>
            </tr>
            <tr hidden>
            <td><label for="one"> Total Amount </label></td>
            <td><input type="text" value="<?php  echo $amount; ?>" id="amount" name="amount"></td>
            
            <td><label for="one"> Currency Name </label></td>
            <td><input type="text" value="INR" id="currencyName" name="currencyName"> </td>
            </tr>
            <tr hidden>
            <td><label for="two">Transaction Type (S/P/R)</label></td>
            <td><input type="text" value="S" id="meTransReqType" name="meTransReqType"></td>
            
            <td><label for="two">Recurring Period(NA/W/M)</label></td>
            <td><input type="text" value="" id="recurPeriod" name="recurPeriod"></td>
            
            <td><label for="two">Recurring Day</label></td>
            <td><input type="text" value="" id="recurDay" name="recurDay"></td>
            </tr>
            <tr  hidden>
            <td><label for="three">No Of Recurring</label></td>
            <td><input type="text" name="numberRecurring" id="numberRecurring" value=""></td>
            
            <td><label for="three">Merchant ID</label></td>
            <td><input type="text" name="mid" id="mid" value="WL0000000033855"></td>
            
            <td><label for="three">Encryption Key</label></td>
            <td><input type="text" name="enckey" id="enckey" value="777fb73ceab4185ec75c5773fae36e32"></td>
            </tr>
            <tr hidden>	
            <td><label for="addField1">Add Field 1</label></td>
            <td><input type="text" name="addField1" id="addField1" value="<?php  echo $student_id;  ?>"  /></td>
            
            <td><label for="addField2">Add Field 2</label></td>
            <td><input type="text" name="addField2" id="addField2" value="<?php echo date("Y"); ?>" /></td>
            
            <td><label for="addField3">Add Field 3</label></td>
            <td><input type="text" name="addField3" id="addField3" value="<?php  echo $examgroup; ?>" /></td>
            </tr>
            <tr hidden>	
            <td><label for="addField4">Add Field 4</label></td>
            <td><input type="text" name="addField4" id="addField4"  value="<?php  echo $examgroupbatch; ?>" /></td>
            
            <td><label for="addField5">Add Field 5</label></td>
            <td><input type="text" name="addField5" id="addField5" value="<?php  echo $class_id; ?>" /></td>
            
            <td><label for="addField6">Add Field 6</label></td>
            <td><input type="text" name="addField6" id="addField6" value="<?php  echo $section_id; ?>"  /></td>	
            </tr>
            <tr hidden>	
            <td><label for="addField7">Add Field 7</label></td>
            <td><input type="text" name="addField7" id="addField7" value="<?php  echo $session_id; ?>" /></td>
            
            <td><label for="addField8">Add Field 8</label></td>
            <td><input type="text" name="addField8" id="addField8" /></td>
            
            
            <td><label for="responseUrl">Response Url</label></td>
            <td><input type="text" name="responseUrl" id="responseUrl" value="<?php echo site_url();?>user/improvement/meTrnSuccess_improvement" /></td>
            </tr>
            <tr><td></td></tr>
            <tr>
            <td style="text-align:center;">
            <b><?php echo $name; ?></b>
            <br>
            <b>You are paying <?php  echo $amount; ?></b></td></tr>
            <tr>
            <td style="text-align:center;">
            <input type="submit" class="btn btn-danger " style="background:#33CC33;padding:5px;font-size:15px" 
            name="CHECKOUT" value= "CHECKOUT" />	
            </td>
            </tr>
            
            </table>
            </form>
            </div>
            </div>
            </section>
            </div>
            
            
