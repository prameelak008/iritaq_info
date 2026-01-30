
                <style>                    
                .step-indicator {
                display: flex;
                justify-content: space-between;
                padding: 20px 30px;
                background: #f8f9fa;
                border-bottom: 2px solid #e9ecef;
                }

                .step {
                flex: 1;
                text-align: center;
                padding: 10px;
                position: relative;
                }

                .step.active {
                color: #667eea;
                font-weight: bold;
                }

                .step.completed {
                color: #28a745;
                }

                .content {
                padding: 30px;
                }

                .form-section {
                display: none;
                }

                .form-section.active {
                display: block;
                animation: fadeIn 0.5s;
                }

                @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
                }

                input[type="text"],
                input[type="email"],
                input[type="tel"],
                select {
                width: 100%;
                padding: 12px;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                font-size: 15px;
                transition: border-color 0.3s;
                }

                input:focus, select:focus {
                outline: none;
                border-color: #667eea;
                }

                .fees-table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                }

                .fees-table th,
                .fees-table td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #e9ecef;
                }

                .fees-table th {
                background: #f8f9fa;
                font-weight: 600;
                }

                .terms-box {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                max-height: 300px;
                overflow-y: auto;
                margin: 20px 0;
                border: 2px solid #e9ecef;
                }

                .terms-box h3 {
                color: #667eea;
                margin-bottom: 15px;
                }

                .terms-box p {
                margin-bottom: 10px;
                line-height: 1.6;
                color: #555;
                }

                .checkbox-group {
                display: flex;
                align-items: center;
                margin: 20px 0;
                }

                .checkbox-group input[type="checkbox"] {
                width: 20px;
                height: 20px;
                margin-right: 10px;
                }

                .subject-selection {
                margin: 20px 0;
                }

                .subject-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                background: #f8f9fa;
                border-radius: 8px;
                margin-bottom: 10px;
                }

                .subject-item input[type="checkbox"] {
                width: 20px;
                height: 20px;
                }

                .confirmation-box {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0;
                }

                .confirmation-box p {
                margin-bottom: 10px;
                display: flex;
                justify-content: space-between;
                }

                .confirmation-box p strong {
                color: #333;
                }

                .payment-form {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                }

                .success-message,
                .failure-message {
                text-align: center;
                padding: 40px;
                }

                .success-message svg,
                .failure-message svg {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
                }

                .success-message h2 {
                color: #28a745;
                margin-bottom: 15px;
                }

                .failure-message h2 {
                color: #dc3545;
                margin-bottom: 15px;
                }                    

                .btn-container {
                display: flex;
                justify-content: space-between;
                margin-top: 30px;
                }

                .total-fees {
                font-size: 24px;
                font-weight: bold;
                color: #667eea;
                text-align: center;
                margin: 20px 0;
                padding: 15px;
                background: #f8f9fa;
                border-radius: 8px;
                }


                </style>            


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exam Application</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exam Application</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header"> 

                 <form id="admitcardFilter" method="post" action="<?php  echo site_url('student_semester_info/examapplication/onlineExamination'); ?>">
                <div class="row g-3">
                <div class="col-md-3">
                <label for="exam_group_id" class="form-label">Exam Group <span class="text-danger">*</span></label>
                <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
                ?>
                <option value="<?php echo $ex_group_value->id ?>" <?php
                if (set_value('exam_group_id') == $ex_group_value->id) {
                echo "selected=selected";
                }
                ?>><?php echo $ex_group_value->name; ?></option>
                <?php
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                </div>


                <div class="col-md-3">
                <label for="exam_id" class="form-label">Exam</label>
                <select  id="exam_id" name="exam_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                </div> 

                <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Search</button>
                </div>
                </div>
                </form> 
              </div> 




            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Online Examination</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php
                if (!empty($get_instructions))
                {               
                // ?>
                <div class="header" style="align:center">
                <h4 >📝 Exam Application Form</h4>
                <h4><?php echo  $get_instructions['sem_exam_title']; ?></h4>  

                <input type="hidden" id="sem_exam_id" name="sem_exam_id" value="<?php echo  $get_instructions['sem_exam_id']; ?>" />
                <!-- <p>Complete all steps to register for the examination</p> -->
                </div>

                <div class="step-indicator">
                <div class="step active" id="step1">1. Fees & Terms</div>
                <div class="step" id="step2">2. Subjects</div>
                <div class="step" id="step3">3. Confirmation</div>
                <div class="step" id="step4">4. Payment</div>
                <div class="step" id="step5">5. Complete</div>
                </div>

                <div class="content">
                <!-- Section 1: Fees Structure and Terms -->
                <div class="form-section active" id="section1">
                <h2>Fee Structure</h2>
                <table class="fees-table">
                <thead>
                <tr>
                <th>Item</th>
                <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>Application Fee</td>
                <td>
                <?php echo number_format($get_instructions['sem_fees_fees_charge'], 2); ?> 
                </td>
                </tr>

                <input type="hidden" name="sem_fees_id" id="sem_fees_id" value="<?php echo $get_instructions['sem_fees_id']; ?>" />

                <tr>
                <td>Processing Fee</td>
                <td><?php echo number_format($get_instructions['sem_fees_processing_charge'], 2); ?></td>
                </tr>

                </tbody>
                </table>

                <div class="terms-box">
                <?php echo   $get_instructions['sem_exam_declaration']; ?>
                </div>

                <div class="checkbox-group">
                <input type="checkbox" id="acceptTerms">
                <label for="acceptTerms">I have read and accept the terms and conditions</label>
                </div>

                <div class="btn-container">
                <div></div>
                <button class="btn btn-primary" onclick="nextSection(1)">Next</button>
                </div>
                </div>

                <!-- Section 2: Subject Selection -->
                <div class="form-section" id="section2">
                <h2>Select Subjects</h2>
                <p style="color: #666; margin-bottom: 20px;">Choose the subjects you want to appear for (₹300 per subject)</p>
                <div class="subject-selection">
                <?php 
                foreach ($get_instructions['subjects'] as $sub) { ?>
                <div class="subject-item">
                <label>
                <input 
                type="checkbox"
                class="subject-checkbox"
                data-fee="<?php echo $sub['inst_fees_charge']; ?>" 
                value="<?php echo $sub['inst_sem_id']; ?>"
                >
                &nbsp;<?php echo $sub['name']; ?>
                </label>

                <span>₹<?php echo number_format($sub['inst_fees_charge'], 2); ?></span>
                </div>
                <?php } ?>
                </div>

                <div class="total-fees" id="subjectTotal">
                Total Subject Fees: ₹0.00
                </div>

                <div class="btn-container">
                <button class="btn btn-secondary" onclick="prevSection(2)">Back</button>
                <button class="btn btn-primary" onclick="nextSection(2)">Next</button>
                </div>
                </div>

                <!-- Section 3: Confirmation -->
                <div class="form-section" id="section3">
                <h2>Confirm Your Application</h2>

                <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" value="<?php echo $sem['firstname'] ?>"   required>
                </div>

                <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" value="<?php echo $sem['email'] ?>" required>
                </div>

                <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone"  value="<?php echo $sem['mobileno'] ?>" required>
                </div>  

                <input type="hidden" id="student_id" anme="student_id" value="<?php echo $sem['stud_id'] ?>" >
                <input type="hidden" id="sem_group_id" anme="sem_group_id" value="<?php echo $sem['sem_group_id'] ?>" >


                <div class="confirmation-box">
                <h3>Application Summary</h3>
                <p><strong>Selected Subjects:</strong> <span id="confirmSubjects">None</span></p>
                <p><strong>Application Fee:</strong> <span><?php echo number_format($get_instructions['sem_fees_fees_charge'], 2); ?></span></p>

                <p><strong>Subject Fees:</strong> 
                <span id="confirmSubjectFees"> <div class="total-fees subjectTotal" id="subjectTotal">

                </div></span></p>

                <p>
                <strong>Processing Fee:</strong> <span><?php echo number_format($get_instructions['sem_fees_processing_charge'], 2); ?></span></p>
                <hr style="margin: 15px 0;">


                <p style="font-size: 20px;"><strong>Total Amount:</strong>

                <span id="confirmTotal" style="color: #667eea;"></span></p>
                </div>             


                <div class="btn-container">
                <button class="btn btn-secondary" onclick="prevSection(3)">Back</button>
                <button class="btn btn-primary" onclick="submitApplication()">Submit Application</button>
                </div>
                </div>


             
                <!-- Section 4: Payment -->
                <div class="form-section" id="section4">
                <h2>Payment</h2>

                <div class="total-fees" id="paymentTotal">
                Amount to Pay: ₹700                 

                <input type="text" id="paymentTotalInput" readonly>
                </div>




            <?php 
            // ob_start();
            // error_reporting(E_ALL);
            $strNo = rand(1, 1000000);
            date_default_timezone_set('Asia/Calcutta');
            $strCurDate = date('Y-m-d');
            require_once 'TransactionRequestBean.php';
            
            // $parameters = file_get_contents("./parameters.json");
            // $data = json_decode($parameters, true);

            // require_once APPPATH . 'views/user_semester/payment_store/TransactionRequestBean.php';
            
            $data           = json_decode($parameters, true);            
            
            $protocolType   = 'http';

            if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') 
            {
            $protocolType   = 'https';
            }
            
            if(!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '80')
            {
            $hostStr        = "$protocolType://$_SERVER[SERVER_NAME]$_SERVER[SCRIPT_NAME]";
            }
            else
            {
            $hostStr        = "$protocolType://$_SERVER[SERVER_NAME]:$_SERVER[SERVER_PORT]$_SERVER[SCRIPT_NAME]";
            }

            $resHost        = explode('/', $hostStr);
            array_pop($resHost);
            $resHostNew     = $resHost;
            array_push($resHost, 'response.php');
            // array_push($resHost, APPPATH . 'views/user_semester/payment_store/response.php');
            $resUrl         = implode('/', $resHost);


            
            if ($_POST && isset($_POST['submit'])) 
            {                           
            $val                    = $_POST;        
          
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


          //   $transactionRequestBean->student_id = $val['student_id'];
            // $transactionRequestBean->examgroup = $val['examgroup'];
            // $transactionRequestBean->examgroupbatch = $val['examgroupbatch'];
            // $transactionRequestBean->class_id = $val['class_id'];
            // $transactionRequestBean->section_id = $val['section_id'];
            // $transactionRequestBean->session_id = $val['session_id'];
            
            //Writing in Request Log
            $log  = "Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->TPSLTxnID."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->custId."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->accountNo."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
            
            //Saving string to log by using "FILE_APPEND" to append.
            // file_put_contents('logs/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);            
            $base_url_path = $_SERVER['DOCUMENT_ROOT'] . parse_url(base_url('payment_store/logs/request/'), PHP_URL_PATH);
            file_put_contents($base_url_path . 'log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);            
            $responseDetails = $transactionRequestBean->getTransactionToken();
            $responseDetails = (array)$responseDetails;
            $response = $responseDetails[0];
            echo "<script>window.location = '" . $response . "'</script>";
            ob_flush();            
            }
            $resHostNew =  implode('/', $resHostNew);
            ?>

            


                <form method="post">
                <table class="table table-striped table-bordered table-hover example">
                <tr class="info">
                <th width="40%">Field Description</th>
                <th width="60%">Field Name</th>
                </tr>

                <!-- Hidden Fields -->
                <tr >
                <td>Request Type</td>
                <td><input type="text" name="reqType" value="T" required /></td>
                </tr>

                <tr >
                <td>Merchant Code</td>
                <td><input type="text" name="mrctCode" value="<?php echo $data['merchantCode']; ?>" required /></td>
                </tr>

                <tr >
                <td>Merchant Transaction ID</td>
                <td><input type="text" name="mrctTxtID" value="<?php echo $strNo; ?>" required /></td>
                </tr>

                <!-- Currency Code -->
                <tr>
                <td>Currency Code</td>
                <td><input type="text" readonly name="currencyType" value="INR" required /></td>
                </tr>

                <!-- Amount -->
                <tr>
                <td>Amount</td>
                <td><input type="text" readonly name="amount" id="amount" required /></td>
                </tr>

                <!-- Hidden additional fields -->
                <tr hidden>
                <td>Client Meta Data</td>
                <td><input type="text" name="itc" value="email:demo@demo.com" /></td>
                </tr>

                <tr >
                <td>Scheme Code Details</td>
                <td><input type="text" name="reqDetail" id="reqDetail" value="<?php echo $data['schemeCode']; ?>_1.0_0.0" required /></td>
                </tr>

                <!-- Transaction Date -->
                <tr>
                <td>Transaction Date</td>
                <td><input type="text" readonly name="txnDate" id="txnDate" value="<?php echo $strCurDate; ?>" /></td>
                </tr>

                <tr>
                <td>Bank Code</td>
                <td><input type="text" name="bankCode" value="470" /></td>
                </tr>


                <tr>
                <td>Locator URL</td>
                <td>
                <select name="locatorURL">
                <option selected value="https://www.tpsl-india.in/PaymentGateway/TransactionDetailsNew.wsdl">LIVE</option>
                </select>
                </td>
                </tr>

                <tr >
                <td>TPSL Transaction ID</td>
                <td><input type="text" name="tpsl_txn_id" value="" /></td>
                </tr>

                <tr >
                <td>Customer ID</td>
                <td><input type="text" name="custID" value="19872627" /></td>
                </tr>

                <tr >
                <td>Card Name</td>
                <td><input type="text" name="custname" value="test" /></td>
                </tr>

                <tr >
                <td>Mobile Number</td>
                <td><input type="text" name="mobile" value="1234567890" /></td>
                </tr>

                <tr >
                <td>Account No</td>
                <td><input type="text" name="accNo" value="" /></td>
                </tr>

                <!-- Return URL -->
                <tr >
                <td>Return URL</td>
                <td>
                <input type="text" name="returnURL" value="<?php echo site_url(); ?>student_semester_info/examapplication/response" required />
                </td>
                </tr> 

             
                <tr>
                <td colspan="2" style="text-align:center;">
                <button class="btn btn-secondary" onclick="prevSection(4)">Back</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </td>
                </tr>
                </table>
                </form>

                </div>
                </div>



                <!-- Section 5: Success/Failure -->
                <div class="form-section" id="section5">
                <div class="success-message" id="successMsg" style="display:none;">
                <svg fill="#28a745" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                <h2>Payment Successful!</h2>
                <p>Your exam application has been submitted successfully.</p>
                <p><strong>Application ID:</strong> <span id="applicationId"></span></p>
                <p>A confirmation email has been sent to your registered email address.</p>
                <button class="btn btn-primary" onclick="location.reload()" style="margin-top: 20px;">New Application</button>
                </div>

                <div class="failure-message" id="failureMsg" style="display:none;">
                <svg fill="#dc3545" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                <h2>Payment Failed!</h2>
                <p>Unfortunately, your payment could not be processed.</p>
                <p>Please check your payment details and try again.</p>
                <div style="margin-top: 20px;">
                <button class="btn btn-secondary" onclick="retryPayment()">Try Again</button>
                <button class="btn btn-primary" onclick="location.reload()">Start Over</button>
                </div>
                </div>
                </div>


                </div>
                </section>
                </div>
                </div>
                </div>


                <?php 
                } 
                else
                {

                echo "No Records Found";
                }
                ?>
             
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
                <script type="text/javascript">
                $(document).ready(function () 
                {            

                var exam_group_id = '<?php echo set_value('exam_group_id'); ?>';
                var exam_id = '<?php echo set_value('exam_id'); ?>';
                getExamByExamgroup(exam_group_id, exam_id);

                $(document).on('change', '#exam_group_id', function (e) {
                var exam_group_id = $(this).val();
                // alert('Exam group changed to: ' + exam_group_id); 
                $('#exam_id').html("");
                getExamByExamgroup(exam_group_id, 0);
                });

                function getExamByExamgroup(exam_group_id, exam_id) {
                if (exam_group_id != "") {
                $('#exam_id').html("");
                var base_url = '<?php echo base_url(); ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

                $.ajax({
                type: "POST",
                url: base_url + "semesterauth/getExamByExamgroup",
                data: { 'exam_group_id': exam_group_id },
                dataType: "json",
                beforeSend: function () {
                $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) {
                $.each(data, function (i, obj) {
                var sel = (exam_id == obj.id) ? "selected" : "";
                div_data += "<option value='" + obj.id + "' " + sel + ">" + obj.exam + "</option>";
                });
                $('#exam_id').append(div_data);
                },
                complete: function () {
                $('#exam_id').removeClass('dropdownloading');
                },
                error: function (xhr, status, error) {
                console.error("Error fetching exams:", error);
                }
                });
                } else {
                $('#exam_id').html('<option value=""><?php echo $this->lang->line('select'); ?></option>');
                }
                }
                });

                let currentSection = 1;
                let selectedSubjects = [];
                // let totalFees = 700; // Base fee (500 + 200)

                // Calculate subject fees
                document.querySelectorAll('.subject-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', calculateFees);
                });

                function calculateFees()
                {
                selectedSubjects = [];
                let subjectFees = 0;

                document.querySelectorAll('.subject-checkbox:checked').forEach(checkbox => {
                selectedSubjects.push(checkbox.value);
                subjectFees += parseInt(checkbox.dataset.fee);
                });

                totalFees = 700 + subjectFees; // Base fees + subject fees
                document.getElementById('subjectTotal').textContent = `Total Subject Fees: ₹${subjectFees}`;
                }

                function nextSection(current) {
                // Validation
                if (current === 1)
                {
                if (!document.getElementById('acceptTerms').checked) {
                alert('Please accept the terms and conditions to proceed.');
                return;
                }
                }

                if (current === 2)
                {
                if (selectedSubjects.length === 0) {
                alert('Please select at least one subject.');
                return;
                }
                }

                // Hide current section
                document.getElementById(`section${current}`).classList.remove('active');
                document.getElementById(`step${current}`).classList.add('completed');
                document.getElementById(`step${current}`).classList.remove('active');

                // Show next section
                currentSection = current + 1;
                document.getElementById(`section${currentSection}`).classList.add('active');
                document.getElementById(`step${currentSection}`).classList.add('active');

                // Update confirmation if moving to section 3
                if (currentSection === 3)
                {
                updateConfirmation();
                }

                // Update payment total if moving to section 4
                if (currentSection === 4) 
                {
                // document.getElementById('paymentTotal').textContent = `Amount to Pay: ₹${totalFees}`;
                document.getElementById('paymentTotal').textContent =
                `Amount to Pay: ₹${finalPayable.toFixed(2)}`;

                //  document.getElementById('paymentTotalInput').value = finalPayable;

                document.getElementById('amount').value = finalPayable;                
                }

                }

                function prevSection(current) {
                document.getElementById(`section${current}`).classList.remove('active');
                document.getElementById(`step${current}`).classList.remove('active');

                currentSection = current - 1;
                document.getElementById(`section${currentSection}`).classList.add('active');
                document.getElementById(`step${currentSection}`).classList.add('active');
                document.getElementById(`step${currentSection}`).classList.remove('completed');
                }

                function updateConfirmation001() 
                {
                let subjectFees = (totalFees - 700);
                document.getElementById('confirmSubjects').textContent = selectedSubjects.join(', ');
                document.getElementById('confirmSubjectFees').textContent = `₹${subjectFees}`;
                document.getElementById('confirmTotal').textContent = `₹${totalFees}`;
                }


                function updateConfirmation() 
                {                
                let subjectFees = (totalFees - 700);
                document.getElementById('confirmSubjects').textContent = selectedSubjects.join(', ');
                document.getElementById('confirmSubjectFees').textContent = `₹${subjectFees}`;
                // document.getElementById('confirmTotal').textContent = `₹${totalFees}`;

                let applicationFee = parseFloat("<?php echo $get_instructions['sem_fees_fees_charge']; ?>");
                let processingFee = parseFloat("<?php echo $get_instructions['sem_fees_processing_charge']; ?>");

                let total    = applicationFee +  processingFee+subjectFees;
                document.getElementById('confirmTotal').textContent = `₹${total.toFixed(2)}`;
                finalPayable = total;            
                }


                function submitApplication() {
                const name = document.getElementById('fullName').value;
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;

                if (!name || !email || !phone) {
                alert('Please fill in all required fields.');
                return;
                }

                nextSection(3);
                }

/*
                function processPayment() 
                {           

                // Simulate payment processing
                document.getElementById('section4').classList.remove('active');
                document.getElementById('step4').classList.add('completed');
                document.getElementById('step4').classList.remove('active');

                currentSection = 5;
                document.getElementById('section5').classList.add('active');
                document.getElementById('step5').classList.add('active');

                // Simulate random success/failure (70% success rate)
                const isSuccess = Math.random() > 0.3;

                if (isSuccess) {
                document.getElementById('successMsg').style.display = 'block';
                document.getElementById('failureMsg').style.display = 'none';
                document.getElementById('applicationId').textContent = 'APP' + Math.floor(Math.random() * 1000000);
                } else {
                document.getElementById('successMsg').style.display = 'none';
                document.getElementById('failureMsg').style.display = 'block';
                }
                }

                function retryPayment() {
                document.getElementById('section5').classList.remove('active');
                document.getElementById('step5').classList.remove('active');

                currentSection = 4;
                document.getElementById('section4').classList.add('active');
                document.getElementById('step4').classList.add('active');
                document.getElementById('step4').classList.remove('completed');
                }
                */


                </script>


                <!------------------------- Script------------------------>

                <script>               

                function processPayment()
                {
                let student_id      = document.getElementById('student_id').value;
                let sem_group_id    = document.getElementById('sem_group_id').value;
                let sem_fees_id     = document.getElementById('sem_fees_id').value;  
                let sem_exam_id     = document.getElementById('sem_exam_id').value; 

                if (!window.finalPayable) finalPayable = 0;

                // Main payload
                const formData = {
                student_id       : student_id,
                sem_group_id     : sem_group_id,
                sem_fees_id      : sem_fees_id,
                selected_subjects: JSON.stringify(selectedSubjects),               
                total_amount     : finalPayable,
                sem_exam_id      : sem_exam_id
                };  


                $.ajax({
                url         : "<?php echo base_url('student_semester_info/Examapplication/saveApplication'); ?>",
                type        : "POST",
                data        : formData,
                dataType    : "json",
                success     : function(resp) {                 

                if (resp.status === "success")
                {
                // Create a hidden form
                let form = document.createElement("form");
                form.method = "POST";
                form.action = "<?php echo base_url('student_semester_info/Examapplication/loadPaymentPage'); ?>";

                // Add fields
                form.innerHTML = `
                <input type="hidden" name="application_id" value="${resp.application_id}">
                <input type="hidden" name="student_id" value="${resp.student_id}">
                <input type="hidden" name="sem_group_id" value="${resp.sem_group_id}">
                <input type="hidden" name="total_amount" value="${resp.total_amount}">
                <input type="hidden" name="sem_exam_id" value="${resp.sem_exam_id}">
                `;

                document.body.appendChild(form);
                form.submit(); // Auto submit
                }               

                else {
                alert("Something went wrong. Please try again.");
                }
                },
                error: function() {
                alert("Server error. Please try again.");
                }
                });
                }
                </script>




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
            // // Check if 'amount' field exists
            if ($('#amount').length) {
            // Apply changes when the document is ready
            change_scheme_code();
            // Optionally, bind the function to the 'onchange' event
            $('#amount').on('change', change_scheme_code);
            }            
            });
            </script>

                    