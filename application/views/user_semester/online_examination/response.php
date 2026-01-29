            <?php
            $this->load->library('smsgateway');
            $this->load->library('mailsmsconf');
            // if(isset($this->session->userdata['logged_in']))
            // {
            // $session_studid  = $this->session->userdata['session_studid']; 
            // $name            = isset($this->session->userdata['name']) ? $this->session->userdata['name'] : '';
            // $studid          = $session_studid;

            // } 
            ?>
            
            
            <style type="text/css">
            .tableclas
            {
            border: 1px black solid; 
            }
            </style>
            
            
            <div class="form-group" id="wrp"> 
            <label style="background-color:#00C3CB; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" ></label>
            </div>
            
            <div class=" " style="height:auto; margin-top:20px;">
            <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <!--<h6 class="section-title text-center text-primary text-uppercase">Login</h6>-->
            </div>
            <div class="col-md-6" style="float:none;margin:auto;">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
            
            
            
            <?php
            if( isset($_SERVER['HTTPS'] ) ) {
            $host ='https';
            }else{
            $host = 'http';
            }
            require_once 'TransactionResponseBean.php';
            $data = json_decode($parameters, true);
            
            
            $protocolType = 'http';
            if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $protocolType = 'https';
            }
            
            if(!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '80'){
            $hostStr = "$protocolType://$_SERVER[SERVER_NAME]$_SERVER[SCRIPT_NAME]";
            }else{
            $hostStr = "$protocolType://$_SERVER[SERVER_NAME]:$_SERVER[SERVER_PORT]$_SERVER[SCRIPT_NAME]";
            }
            $resHost = explode('/', $hostStr);
            array_pop($resHost);
            $resHost = implode('/', $resHost);
            ?>
            
            
            <?php            
            if ($_POST) {
            if (isset($_POST['msg'])) {
            $response = $_POST;
            
            if (is_array($response)) {
            $str        = $response['msg'];
            } else if (is_string($response) && strstr($response, 'msg=')) {
            $outputstr = str_replace('msg=', '', $response);
            $outputArr = explode('&', $outputstr);
            $str = $outputArr[0];
            } else {
            $str = $response;
            }
            $transactionResponseBean = new TransactionResponseBean();
            $transactionResponseBean->setResponsePayload($str);
            $transactionResponseBean->key = $data['key'];
            $transactionResponseBean->iv = $data['iv'];
            $response = $transactionResponseBean->getResponsePayload();
            
            //Writing in Response Log
            $log  = "Date : ".date("F j, Y, g:i a")."; Response Data : ".$response.PHP_EOL;
            
            
            //Saving string to log by using "FILE_APPEND" to append.
            // file_put_contents('logs/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
            
            
            $base_url_path = $_SERVER['DOCUMENT_ROOT'] . parse_url(base_url('payment_store/logs/response/'), PHP_URL_PATH);
            file_put_contents($base_url_path . 'log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);
            
            $response_n = explode("|", $response);
            // print_r($response_n);
            
            display_response($response_n,$data);
            
            
            // Initialize an empty array to hold the parsed response data
            $responseData = [];
            
            // Loop through each item in the response array
            foreach ($response_n as $item) {
            // Split the item into key and value by '='
            list($key, $value) = explode("=", $item, 2) + [NULL, NULL];
            
            // If key is not null, store it in the responseData array
            if ($key !== NULL) {
            $responseData[$key] = $value;
            }
            }
            // print_r($response_n);
            // Print the parsed response data for debugging
            // echo "Parsed response data:\n";
            // Extract metadata if available
            
            
            if (isset($responseData['clnt_rqst_meta'])) 
            {
            $metaString = $responseData['clnt_rqst_meta'];
            $metaString = trim($metaString, '{}'); // Remove outer braces
            $metaPairs = explode('}{', $metaString); // Split into key-value pairs
            
            // Create an associative array from the key-value pairs
            
            foreach ($metaPairs as $pair) {
            list($key, $value) = explode(':', $pair, 2) + [NULL, NULL];
            if ($key !== NULL) 
            {
            $formattedKey = str_replace('session_studid', 'session_studid', $key); // Ensure key is 'student_id'
            $responseData[$formattedKey] = $value;
            }
            }
            }
            
            
            $txnmsg_msg = ($responseData['txn_msg'] === 'success') ? 'S' : 'F';
            
            
            $feepay = array(
            'fees_entrancepayment_responsecode'      => isset($responseData['txn_status']) ? $responseData['txn_status'] : null,
            'fees_entrancepayment_statuscode'        => $txnmsg_msg,
            'fees_entrancepayment_student_id'        => isset($responseData['session_studid']) ? $responseData['session_studid'] : null,
            'fees_entrancepayment_applicationno'     => isset($responseData['admission_application_no']) ? $responseData['admission_application_no'] : null,
            'fees_entrancepayment_registerid'        => isset($responseData['session_studid']) ? $responseData['session_studid'] : null,
            'fees_entrancepayment_transdate'         => isset($responseData['tpsl_txn_time']) ? $responseData['tpsl_txn_time'] : null,
            'fees_entrancepayment_transaction_no'    => isset($responseData['clnt_txn_ref']) ? $responseData['clnt_txn_ref'] : null,
            'fees_entrancepayment_orderid'           => isset($responseData['tpsl_txn_id']) ? $responseData['tpsl_txn_id'] : null,
            'fees_entrancepayment_amount'            => isset($responseData['txn_amt']) ? $responseData['txn_amt'] : null,
            'fees_entrancepayment_created_date'      => date('d-m-y H:i:s'),
            'fees_entrancepayment_onlinestatus'      => "Worldline-3rd Stage",
            'fees_entrancepayment_errormsg'          => isset($responseData['txn_err_msg']) ? $responseData['txn_err_msg'] : null,
            'fees_entrancepayment_year'              => date('Y')
            );
            
           
                $this->Pay_storemodel->insert_entrance_fees_payment($feepay);
                $reg_phone       =  $this->session->userdata['reg_phone'];  
                    
                if ($reg_phone[0] != '+') 
                {
                $phone_no = '+' . $reg_phone; 
                }
                        
                
                if ($txnmsg_msg === 'S') 
                {
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid); 
                $data                   =    array('admission_form_status' =>1,'admission_payment'=>'Paid');
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                $this->db->where(array('reg_id' => $studid));      
                $q 		               = $this->db->get('set_entrance_uidesign');
                
                if ($q->num_rows() > 0) 
                {
                $dato = array(
                    'ui_payment'=>1);
                $this->db->where('reg_id',$studid);    
                $this->db->update('set_entrance_uidesign',$dato);
                }
                else
                {
                $setui = array(               
                    'reg_id'=>$studid,
                    'ui_payment'=>1);
                $this->db->insert('set_entrance_uidesign',$setui);
                }
                $reg_phone       =  $this->session->userdata['reg_phone'];
//                 $paragraph       = "*Jamia Jalaliyya Entrance Examination- Fee Payment Successful.*";
//                 $message         = "Your payment of *Rs. 500* for the *Jamia Jalaliyya Entrance Examination* was successful.*Thank You*";
//               $details="*STEP-2 COMPLETED SUCCESSFULLY*
// You have successfully completed Step 2 *Fee Payment*. Now, please proceed to complete Step 3, *Finalize Application*. 

// നിങ്ങള്‍ ഘട്ടം-2 *Fee Payment* വിജയകരമായി പൂര്‍ത്തീകരിച്ചിരിക്കുന്നു. ഘട്ടം-3 *Finalize Application* എന്ന ഐക്കണില്‍ ക്ലിക്ക് ചെയ്ത് ഘട്ടം-3 പൂര്‍ത്തീകരിക്കാവുന്നതാണ്."
//               ;
               
            $formated_message="{$paragraph}\n{$message}\n{$details}";
            // $this->smsgateway->sendWhatsAppSMS($reg_phone,$formated_message);
            $feepay['mobile_no']  = $reg_phone;
            
            if (!empty($result)) 
            {
            $resultArray = (array)$result[0]; 
            $feepay = array_merge($feepay, $resultArray);
            }
            // $this->mailsmsconf->online_sms('exam_payment', $feepay);
            
            $type          = "media_template";
            $lang_code     = "ml";
            $template_name = 'entrance_exampayment';
            $text          = [$responseData['txn_amt']];
            $this->Entranceadmission_model->getauth($phone_no,$type,$lang_code,$template_name,$text);
            } 
            else 
            {
            $table                  =    "admission_form_tbl";
            $condition              =    array('admission_application_registerid'=>$studid); 
            $data                   =    array('admission_form_status' =>1,'admission_payment'=>'Failed');
            $reg_phone              =     $this->session->userdata['reg_phone'];
            $paragraph              =    "*Jamia Jalaliyya Entrance Examination-2025*";
            $message                =    "*Fee Payment Failed.* Try Again after Some time";
            $formated_message       =    "{$paragraph}\n{$message}";
            // $this->smsgateway->sendWhatsAppSMS($reg_phone,$formated_message );
            $feepay['mobile_no']    =   $reg_phone;
            
            if (!empty($result)) {
            // Convert stdClass Object to Array
            $resultArray = (array)$result[0]; // Assuming $result has only one row
            
            // Merge both arrays
            $feepay = array_merge($feepay, $resultArray);
            }
             
            // $this->mailsmsconf->online_sms('exam_nonpayment', $feepay); 
        
            $type          = "media_template";
            $lang_code     = "en_GB";
            $template_name = 'entrance_paymentfailed';
            $text          = [$sessionyear];
            $this->Entranceadmission_model->getauth($phone_no,$type,$lang_code,$template_name,$text);
            
            
            $this->Entranceadmission_model->updte_value($table,$data,$condition);
            }
            
            } 
            else if (isset($_POST['response'])) 
            {
            //Writing in Response Log
            $log  = "Date : ".date("F j, Y, g:i a")."; Response Data : ".$_POST['response'].PHP_EOL;
            
            //Saving string to log by using "FILE_APPEND" to append.
            // file_put_contents('logs/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
            
            $base_url_path = $_SERVER['DOCUMENT_ROOT'] . parse_url(base_url('payment_store/logs/response/'), PHP_URL_PATH);
            file_put_contents($base_url_path . 'log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);
            $response_n = explode("|", $_POST['response']);
            display_response($response_n,$data);
            }
            } 
            else 
            {
            echo "No Response Received";
            }
            ?>
            
            <?php
            function display_response($res, $parameters)
            {
            $stat = $res[0];
            $mystatus = explode("=", $stat);
            $status = $mystatus[1];
            
            echo '<div class="container">
            <div class="row">
            <div class="col-md-8">
            <h3 style="text-align:center">Transaction Status</h3>
            
            <div style="overflow-x: auto;">
            <table class="table table-bordered table-hover"  style="width:100%;" id="transactionTable">
            <tr class="info">
            <th width="40%">Field Name</th>
            <th width="60%" style="word-wrap: break-word; white-space: normal;">Value</th>
            </tr>';
            
            foreach ($res as $val)
            {
                
            $response1 = explode("=", $val);
            if( $response1[0] == 'txn_err_msg' && $status == '0300')
            {
            continue;
            }
            
            $data = getdetails($response1[0], $parameters);
            if (!(empty($data))) {
            $colum_name = $data;
            } else {
            continue;
            }
            
            if (empty($response1[1]))
            {
            $response1[1] = "Not found";
            }
            
            echo "<tr>";
            echo "<td> $colum_name </td>";
            
            if($response1[1] == "0300" || $response1[1] == "success"){
            echo "<td style='background-color: darkseagreen;color: aliceblue;'> $response1[1] </td>";
            }elseif ($response1[1] == "0399" || $response1[1] == "failure") {
            echo "<td style='background-color: red;color: white;'> $response1[1] </td>";
            }else{
            echo "<td> $response1[1] </td>";
            }
            echo "</tr>";
            }
            echo "</table>";
            
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr>";
            echo "<td colspan='2' style='text-align: center; '>
            <button onclick='printTable()' class='btn btn-primary'>Print</button>
            </td>";
            echo "</tr>";
            echo "</table>
            </div>
            <br>
            </div>
            </div>
            </div>";
            }
            
            
            function getdetails($code, $parameters)
            {
            if($parameters['showAllResponse'] == "ON")
            {        
            $column_value = [
            "txn_status"            => "Transaction Status",
            "txn_msg"               => "Message",
            "txn_err_msg"           => "Error Message",
            "clnt_txn_ref"          => "Transaction ID",
            "tpsl_bank_cd"          => "TPSL Bank Code",
            "tpsl_txn_id"           => "TPSL Transaction ID",
            "txn_amt"               => "Amount",
            "tpsl_txn_time"         => "Transaction Time",
            "tpsl_rfnd_id"          => "TPSL Refund ID",
            "bal_amt"               => "Balance Amount",
            "REFUND_DETAILS"        => "Refund details",
            "rqst_token"            => "Request Token",
            "bank_name"             => "Bank Name",
            "card_id"               => "Card ID",
            "alias_name"            => "Alias Name",
            "card_Type"             => "Card Type",
            "Card_Expiry"           => "Card Expiry",
            "hash"                  => "Hash",
            "BANK_TYPE"             => "Bank Type",
            "auth"                  => "Auth"
            ];
            }
            else{
            $column_value = [
            "txn_status"            => "Transaction Status",
            "txn_msg"               => "Message",
            "txn_err_msg"           => "Error Message",
            "clnt_txn_ref"          => "Transaction ID",
            "tpsl_bank_cd"          => "TPSL Bank Code",
            "tpsl_txn_id"           => "TPSL Transaction ID",
            "txn_amt"               => "Amount",
            "REFUND_DETAILS"        => "Refund details",
            "bank_name"             => "Bank Name"
            ];
            }
            if (in_array($code, array_keys($column_value))) 
            {
            return $column_value[$code];
            }
            }
            ?>
            
        <script>
        function printTable()
        {
        var table = document.getElementById("transactionTable").outerHTML;
        var newWindow = window.open("", "", "width=800,height=600");
        newWindow.document.write("<html><head><title>Printable Transaction Report</title>");
        newWindow.document.write("<style> table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid black; padding: 8px; text-align: left; } </style>");
        newWindow.document.write("</head><body>");
        newWindow.document.write("<h3>Transaction Status</h3>");
        newWindow.document.write(table);
        newWindow.document.write("</body></html>");
        newWindow.document.close();
        newWindow.print();
        }
        
        $(document).ready(function()
        {
        $('#wrp').show();
        $('html, body').animate({
        scrollTop: $('#wrp').offset().top
        }, 'slow');
        });
        </script>
        
            </div>
            </div>
            </div>
            </div>
