
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

if( isset($_SERVER['HTTPS'] ) ) {
$host ='https';
}
else
{
$host = 'http';
}

require_once 'TransactionResponseBean.php';

// $parameters = file_get_contents("./parameters.json");
// $data       = json_decode($parameters, true);

$data         = json_decode($parameters, true);
$protocolType = 'http';

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $protocolType = 'https';
}

// if(!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '80')
// {
// $hostStr = "$protocolType://$_SERVER[SERVER_NAME]$_SERVER[SCRIPT_NAME]";
// }
// else
// {
// $hostStr = "$protocolType://$_SERVER[SERVER_NAME]:$_SERVER[SERVER_PORT]$_SERVER[SCRIPT_NAME]";
// }
// $resHost = explode('/', $hostStr);
// array_pop($resHost);
// $resHost = implode('/', $resHost);
?>

<?php

if ($_POST) {
    if (isset($_POST['msg'])) {
        $response = $_POST;
        
        if (is_array($response)) {
            $str = $response['msg'];
        } else if (is_string($response) && strstr($response, 'msg=')) {
            $outputstr = str_replace('msg=', '', $response);
            $outputArr = explode('&', $outputstr);
            $str = $outputArr[0];
        } else {
            $str = $response;
        }
        
        $transactionResponseBean        = new TransactionResponseBean();
        $transactionResponseBean->setResponsePayload($str);
        $transactionResponseBean->key   = $data['key'];
        $transactionResponseBean->iv    = $data['iv'];
        $response                       = $transactionResponseBean->getResponsePayload();
        

        //Writing in Response Log
        $log  = "Date : ".date("F j, Y, g:i a")."; Response Data : ".$response.PHP_EOL;

        //Saving string to log by using "FILE_APPEND" to append.
        //file_put_contents('logs/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
        
         $base_url_path = $_SERVER['DOCUMENT_ROOT'] . parse_url(base_url('revpayment_store/logs/response/'), PHP_URL_PATH);
         file_put_contents($base_url_path . 'log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);
         

        $response_n = explode("|", $response);
        display_response($response_n,$data);
        
        
    // foreach ($response_n as $item) {
    // list($key, $value) = explode("=", $item, 2) + [NULL, NULL];
    // if ($key !== NULL) {
    //     $responseData[$key] = $value;
    // }
    // }




    
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

    // Print the parsed response data for debugging
    // echo "Parsed response data:\n";

    
    // Extract metadata if available
    if (isset($responseData['clnt_rqst_meta'])) {
        $metaString = $responseData['clnt_rqst_meta'];
        $metaString = trim($metaString, '{}'); // Remove outer braces
        $metaPairs = explode('}{', $metaString); // Split into key-value pairs
        
        // Create an associative array from the key-value pairs
        foreach ($metaPairs as $pair) {
            list($key, $value) = explode(':', $pair, 2) + [NULL, NULL];
            if ($key !== NULL) {
                $formattedKey = str_replace('studentid', 'studentid', $key); // Ensure key is 'student_id'
                $responseData[$formattedKey] = $value;
            }
        }
    }

        $txnmsg_msg = ($responseData['txn_msg'] === 'success') ? 'S' : 'F';
        
        $feepay = array(
        'fees_sayexampayment_responsecode'   => isset($responseData['txn_status']) ? $responseData['txn_status'] : null,
        'fees_sayexampayment_statuscode'     => $txnmsg_msg,
        'fees_sayexampayment_student_id'     => isset($responseData['studentid']) ? $responseData['studentid'] : null,
        'fees_sayexampayment_class_id'       => isset($responseData['class_id']) ? $responseData['class_id'] : null,
        'fees_sayexampayment_section_id'     => isset($responseData['section_id']) ? $responseData['section_id'] : null,
        'fees_sayexampayment_session_id'     => isset($responseData['session_id']) ? $responseData['session_id'] : null,
        'fees_sayexampayment_examgroup'      => isset($responseData['examgroup']) ? $responseData['examgroup'] : null,
        'fees_sayexampayment_examgroupbatch' => isset($responseData['examgroupbatch']) ? $responseData['examgroupbatch'] : null,
        'fees_sayexampayment_orderid'        => isset($responseData['txn_status']) ? $responseData['txn_status'] : null,
        'fees_sayexampayment_transdate'      => isset($responseData['tpsl_txn_time']) ? $responseData['tpsl_txn_time'] : null,
        'fees_sayexampayment_transaction_no' => isset($responseData['clnt_txn_ref']) ? $responseData['clnt_txn_ref'] : null,
        // 'fees_payment_orderid'        => isset($responseData['tpsl_txn_id']) ? $responseData['tpsl_txn_id'] : null,
        'fees_sayexampayment_amount'         => isset($responseData['txn_amt']) ? $responseData['txn_amt'] : null,
        'fees_sayexampayment_created_date'   => date('d-m-y H:i:s'),
        'fees_sayexampayment_onlinestatus'   =>"Worldline-3rd Stage",
        'fees_sayexampayment_errormsg'       => isset($responseData['txn_err_msg']) ? $responseData['txn_err_msg'] : null,
        'fees_sayexampayment_year'           => date('Y'),
         'exam_attempts'                     => 2 ,
        );
        $this->Pay_storemodel->insert_ce_fees_payment($feepay);
    } 
    else if (isset($_POST['response']))
    {

        //Writing in Response Log
        $log  = "Date : ".date("F j, Y, g:i a")."; Response Data : ".$_POST['response'].PHP_EOL;
        
        //Saving string to log by using "FILE_APPEND" to append.
        //file_put_contents('logs/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
        
         $base_url_path = $_SERVER['DOCUMENT_ROOT'] . parse_url(base_url('revpayment_store/logs/response/'), PHP_URL_PATH);
         file_put_contents($base_url_path . 'log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);

        $response_n = explode("|", $_POST['response']);
        display_response($response_n,$data);
        print_r($response_n);
    }
} else {
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
                <div class="col-md-12">
                    <h4>Your Payment Details</h4>
                    
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages">
                    <table class="table table-bordered table-hover example">
                        <tr class="info">
                            <th width="">Field Name</th>
                            <th width="">Value</th>
                        </tr>';
                      
                        
                        
    foreach ($res as $val) {
        $response1 = explode("=", $val);

        if( $response1[0] == 'txn_err_msg' && $status == '0300'){
            continue;
        }

        $data = getdetails($response1[0], $parameters);

        if (!(empty($data))) {
            $colum_name = $data;
        } else {
            continue;
        }

        if (empty($response1[1])) {
            $response1[1] = "Not found";
        }

        echo "<tr>";
        echo "<td> $colum_name </td>";

        if($response1[1] == "0300" || $response1[1] == "success"){
            echo "<td style='background-color: darkseagreen;color: aliceblue; text-align:left'> $response1[1] </td>";
        }elseif ($response1[1] == "0399" || $response1[1] == "failure") {
            echo "<td style='background-color: red;color: white; text-align:left'> $response1[1] </td>";
        }else{
            echo "<td style='text-align:left'> $response1[1] </td>";
        }
        
    echo "</tr>";
    }
    echo "</div></div></table>
                </div>
            </div>
        </div>";
        
}



function getdetails($code, $parameters)
{
    if($parameters['showAllResponse'] == "ON"){        
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
    if (in_array($code, array_keys($column_value))) {
        return $column_value[$code];
    }
}
?>

</div>
            </div>
            </div>
            </section>
            </div>
