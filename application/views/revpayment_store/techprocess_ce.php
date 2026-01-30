            
            <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary" id="hroom">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('payments'); ?></h3>
            <div class="box-tools pull-right">
            </div>
            </div>
            
            <?php
            ob_start();
            error_reporting(E_ALL);
            $strNo = rand(1, 1000000);
            date_default_timezone_set('Asia/Calcutta');
            $strCurDate = date('Y-m-d');
            require_once 'TransactionRequestBean.php';
            
            // $parameters = file_get_contents("./parameters.json");
            // $data = json_decode($parameters, true);
            
            $data = json_decode($parameters, true);
            
            $protocolType = 'http';
            if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $protocolType = 'https';
            }
            
            if(!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '80')
            {
            $hostStr = "$protocolType://$_SERVER[SERVER_NAME]$_SERVER[SCRIPT_NAME]";
            }else{
            $hostStr = "$protocolType://$_SERVER[SERVER_NAME]:$_SERVER[SERVER_PORT]$_SERVER[SCRIPT_NAME]";
            }
            $resHost = explode('/', $hostStr);
            array_pop($resHost);
            $resHostNew = $resHost;
            array_push($resHost, 'response_ce.php');
            $resUrl = implode('/', $resHost);
            
            if ($_POST && isset($_POST['submit'])) {
            $val = $_POST;
            $transactionRequestBean = new TransactionRequestBean();
            //Setting all values here
            $transactionRequestBean->merchantCode = $val['mrctCode'];
            $transactionRequestBean->ITC = $val['itc'];
            $transactionRequestBean->customerName = $val['custname'];
            $transactionRequestBean->requestType = $val['reqType'];
            $transactionRequestBean->merchantTxnRefNumber = $val['mrctTxtID'];
            $transactionRequestBean->amount = $val['amount'];
            $transactionRequestBean->currencyCode = $val['currencyType'];
            $transactionRequestBean->returnURL = $val['returnURL'];
            $transactionRequestBean->shoppingCartDetails = $val['reqDetail'];
            $transactionRequestBean->TPSLTxnID = $val['tpsl_txn_id'];
            $transactionRequestBean->mobileNumber = $val['mobile'];
            $transactionRequestBean->txnDate = $val['txnDate'];
            $transactionRequestBean->bankCode = $val['bankCode'];
            $transactionRequestBean->custId = $val['custID'];
            $transactionRequestBean->key = $data['key'];
            $transactionRequestBean->iv = $data['iv'];
            $transactionRequestBean->accountNo = $val['accNo'];
            $transactionRequestBean->webServiceLocator = $val['locatorURL'];
            $transactionRequestBean->timeOut = (!empty($val['timeOut']) ? $val['timeOut'] : 30);
            $transactionRequestBean->student_id = $val['student_id'];
            $transactionRequestBean->examgroup = $val['examgroup'];
            $transactionRequestBean->examgroupbatch = $val['examgroupbatch'];
            $transactionRequestBean->class_id = $val['class_id'];
            $transactionRequestBean->section_id = $val['section_id'];
            $transactionRequestBean->session_id = $val['session_id'];
            
            //Writing in Request Log
            $log  = "Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->TPSLTxnID."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->custId."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->accountNo."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
            
            //Saving string to log by using "FILE_APPEND" to append.
            // file_put_contents('logs/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
            
            $base_url_path = $_SERVER['DOCUMENT_ROOT'] . parse_url(base_url('revpayment_store/logs/request/'), PHP_URL_PATH);
            file_put_contents($base_url_path . 'log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);
            
            $responseDetails = $transactionRequestBean->getTransactionToken();
            $responseDetails = (array)$responseDetails;
            $response = $responseDetails[0];
            
           
            echo "<script>window.location = '" . $response . "'</script>";
            ob_flush();
            }
            $resHostNew =  implode('/', $resHostNew);
            ?>
            
            
            <h2>Payment Details</h2>
            <div class="alert alert-info">
            <strong style="color:red">Important Note :</strong> Amount Should not be Null Or Zero<strong style="color:red">
            </div>
            
            <form method="post">
            <table class="table table-striped table-bordered table-hover example">
            <tr class="info">
            <th width="40%">Field Description</th>
            <th width="60%">Field Name</th>
            </tr>
            <tr hidden>
            <td><label><span style="color:red">*</span> Request Type <a href="#" data-toggle="tooltip" title="Type of request sent to Ingenico side"><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <td><input type="text" value="T" name="reqType" required />
            </td>
            </tr>
            
            <tr hidden>
            <td><label><span style="color:red">*</span> Merchant Code <a href="#" data-toggle="tooltip" title="Merchant Code provided by Ingenico"><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <td><input type="text" name="mrctCode" value="<?php echo $data['merchantCode']; ?>" required /></td>
            </tr>
            
            <tr hidden>
            <td><label><span style="color:red">*</span> Merchant Transaction ID <a href="#" data-toggle="tooltip" title="Unique Transaction ID generated from merchant side"><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <td><input type="text" name="mrctTxtID" value="<?php echo $strNo; ?>" required /></td>
            </tr>
            
            <tr>
            <td><label><span style="color:red">*</span> Currency Code <a href="#" data-toggle="tooltip" title="Currency Code provided by merchant. For eg - INR, USD etc"><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <td><input type="text" readonly name="currencyType" value="INR" required /></td>
            </tr>
            
            <tr>
            <td><label><span style="color:red">*</span> Amount <a href="#" data-toggle="tooltip" title="Amount to be processed"><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <!--<td><input type="text" readonly name="amount" id="amount" onchange="change_scheme_code()" value="<?php echo $totalamt; ?>" required /></td>-->
            
            
            <td>
            <input type="text" readonly name="amount" id="amount"  value="<?php echo $amount; ?>" required />
               <!--<input type="text" readonly name="amount" id="amount"  value="1" required />-->
            </td>
            </tr>
            
            
            
            <tr hidden>
            <td><label><span style="color:red">*</span> Client Meta Data</label></td>
            <td><input type="text" name="itc" value="email:demo@demo.com" /></td>
            </tr>
            <tr hidden>
            <td><label><span style="color:red">*</span> Scheme Code Details <a href="#" data-toggle="tooltip" title="Unique Request Detail i.e. combination of Scheme Code (provided by Ingenico) & Amount sent to Ingenico side from merchant"><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <td><input type="text" name="reqDetail" id="reqDetail"  value="<?php echo $data['schemeCode']; ?>_1.0_0.0" required /></td>
            </tr>
            
            <tr>
            <td><label><span style="color:red">*</span> Transaction Date</label></td>
            <td>
            <!--<input type="date"  name="txnDate" id="txnDate" value="<?php echo $strCurDate; ?>" />-->
            <input type="text" readonly name="txnDate" id="txnDate" value="<?php echo $strCurDate; ?>" />
            </td>
            </tr>
            
            <tr hidden>
            <td><label><span style="color:red">*</span> Bank Code</label></td>
            <td><input type="text" name="bankCode" value="470" /></td>
            </tr>
            
            <tr hidden>
            <td><label><span style="color:red">*</span> Locator URL</label></td>
            <td><select name="locatorURL">
            <option selected value="https://www.tpsl-india.in/PaymentGateway/TransactionDetailsNew.wsdl">LIVE</option>
            </select>
            </td>
            </tr>
            <tr hidden>
            <td><label>TPSL Transaction ID</label></td>
            
            <td><input type="text" name="tpsl_txn_id" value="" /></td>
            </tr>
            
            <tr hidden>
            <td><label><span style="color:red"></span> Customer ID</label></td>
            <td><input type="text" name="custID" value="19872627" /></td>
            </tr>
            <tr hidden>
            <td><label><span style="color:red">*</span> Card Name</label></td>
            <td><input type="text" name="custname" value="test" /></td>
            </tr>
            <tr hidden>
            <td><label>Mobile Number</label></td>
            <td><input type="text" name="mobile" value="1234567890" /></td>
            </tr>
            <tr hidden>
            <td><label>Account No</label></td>
            <td><input type="text" name="accNo" value="" /></td>
            </tr>
            
            <tr hidden>
            <td><label><span style="color:red">*</span> Return URL <a href="#" data-toggle="tooltip" title=" "><span class="glyphicon glyphicon-info-sign"></span></a></label></td>
            <td>
            <!--<input type="text" name="returnURL" value='<?php echo $resUrl; ?>' required />-->
            
            <input type="text" name="returnURL" value='<?php echo site_url();?>user/sayexam/response' required />
            
            
            </td>
            </tr>
            <tr>
            <td>
            <input type="hidden" name="student_id" value='<?php echo $student_id; ?>' required />
            <input type="hidden" name="examgroup" value='<?php echo $examgroup; ?>' required />
            <input type="hidden" name="examgroupbatch" value='<?php echo $examgroupbatch; ?>' required />
            <input type="hidden" name="class_id" value='<?php echo $class_id; ?>' required />
            <input type="hidden" name="section_id" value='<?php echo $section_id; ?>' required />
            <input type="hidden" name="session_id" value='<?php echo $session_id; ?>' required />
            </td>
            </tr>
            
            <tr>
            <td colspan=2>
            <input type="submit" name="submit" value="Submit" />
            </td>
            </tr>
            </table>
            </form>
            
            
            
            </div>
            </div>
            </div>
            </section>
            </div>
            
            <!--</body>-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
            
            
            function change_scheme_code() 
            {
            var amount = document.getElementById('amount').value;
            let parseval = parseFloat(amount);
            let fixValue = parseval.toFixed(2);
            document.getElementById('amount').value = fixValue;
            var scheme_code = "<?php echo $data['schemeCode']; ?>_" + fixValue + "_0.0";
            document.getElementById("reqDetail").value = scheme_code;
            }
            
            
            $(document).ready(function() 
            {
            // Check if 'amount' field exists
            if ($('#amount').length) {
            // Apply changes when the document is ready
            change_scheme_code();
            // Optionally, bind the function to the 'onchange' event
            $('#amount').on('change', change_scheme_code);
            }
            });
            
            </script>
