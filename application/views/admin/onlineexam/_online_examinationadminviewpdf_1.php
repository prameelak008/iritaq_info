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
        
        <style type="text/css">
        @media print {
        .pagebreak1 { page-break-before: always; } /* page-break-after works, as well */
        }
        
        .pagebreak {
        page-break-after: always;
        display: block;
        clear: both;
        }
        
        </style>
        
        
        
        <style>
        
        
        body 
        { 
        /*font-family: Almarai, sans-serif;  direction: ltr;
        font-family:Arial;  direction: ltr;
        
        
        
        font-family: DejaVu Sans, sans-serif;  direction: ltr;*/
        
        }
        
        
        
        
        
        .container
        {
        width: 100%;
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        border-left: 2px dotted black;
        border-right: 2px dotted black; 
        
        
        
        }
        
        .tablesubject
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #000;
        
        
        }
        
        .th_tablesubject
        {
        border: 1px solid #000;
        text-align:left;
        
        }
        
        
        .first_td
        {
        width:50%;
        font-size:12px; 
        
        
        
        }
        
        .second_td
        {
        width:5%;
        }
        
        .third_td
        {
        width:50%;
        margin-left: 0px;
        font-size:12px; 
        }
        
        .headertext
        {
        font-size:15px;
        font-weight: bold; 
        
        }
        
        .div30
        {
        width:30%; 
        }
        
        .div10
        {
        width:10%; 
        }
        
        .div40
        {
        width:40%; 
        }
        
        .div20
        {
        width:20%; 
        }
        
        
        .div50
        {
        width:50%; 
        }
        
        .line
        {
        border-top: 1px dotted black;
        }
        
        .row
        {
        margin-left: 20px;
        margin-right: 20px;
        
        }
        
        .declaration
        {
        font-size: 13px;
        }
        .declaration_text
        {
        font-size: 14px;
        
        }
        .th_tablesubject
        {
        font-size: 13px;
        
        }
        
        
        #div_tablesubject
        {
        min-height: 2000px;
        }
        
        </style>
        
        </head>
        
        <body class="body">
        
        
        <?php
        
        
        if (!empty($student_details)) 
        {
        foreach ($student_details as $student_key => $student_value)
        {   
        
        echo "<br>";
        echo "<br>";
        
        
        ?>
        <div class="container">
        
        <div class="row">
        
        
        
        <div id="" style="width:100%; height:auto;" >
        <table>
        <tr>
        <td><img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%" height="150">
        </td>
        </tr>
        </table>
        </div>
        
        <br>
        
        
        
        <div style="width: 100%; display: table;">
        
        <div style="width: 70%; float:left;">
        
        <table>
        <tr>
        <td style="text-align: center; ">
        <span class="headertext" style="font-weight:bold; font-size:17px;">
        
        <!--<b>Application Form for 1st Semester Post‐Graduation Examination <br> 
        (Faculty of Islamic & Contemporary Studies)
        <br>
        
        
        </b>
        -->
        
        
        <b>Application Form for &nbsp;<?php echo $subjects_row['exam'];?> <br> 
        (Faculty of Islamic & Contemporary Studies)
        <br>
        
        
        </b>
        
        </span></td>
        
        </tr>
        </table>
        
        
        <table  float="left">
        
        
        <tr>
        
        <td class="first_td">1.&nbsp;&nbsp;Institution Id </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $student_value->admission_no; ?></td>
        
        </tr>
        
        <tr>
        <td class="first_td">2.&nbsp;&nbsp;Name of the applicant (in block letters) </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $student_value->firstname; ?></td>
        </tr>
        
        
        <tr>
        <td class="first_td">3.&nbsp;&nbsp;Register No </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $student_value->roll_no; ?></td>
        </tr>
        
        
        
        
        <tr>
        <td class="first_td">4.&nbsp;&nbsp;Age & date of birth</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $student_value->dob; ?></td>
        </tr>
        <tr>
        <td class="first_td">5.&nbsp;&nbsp;Name of the guardian</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $student_value->guardian_name; ?></td>
        </tr>
        
        
        
        <tr>
        <td class="first_td">6.&nbsp;&nbsp;Address of communication </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $student_value->current_address; ?></td>
        </tr>
        
        <tr>
        <td class="first_td">7.&nbsp;&nbsp;Name of the paper attending for the examination</td>
        <td class="second_td"></td>
        <td class="third_td"></td>
        </tr>
        
        
        
        </table>
        </div>
        
        
        <div style="width: 30%; float:left;">
        
        <table width="30%" float="left">
        <tr style="text-align: right;"> 
        
        <td >
        
        <?php
        
        if($student_value->image=="")
        {
        ?>
        <img src="<?php echo base_url();?>/backend/default_format/copy_photo.png" style="width:160px; height:230px;" >
        
        <?php
        }
        else
        {
        ?> 
        
        <img src="<?php echo base_url();?>/<?php echo $student_value->image; ?>"  style="width:160px; height:230px;">
        
        <?php } ?>
        
        </td>
        </tr>
        </table>
        </div>
        
        </div>
        <br>
        
        
        <div  style="height:auto;min-height:240px !important; ">
        <table class="tablesubject">
        <tr>
        <th class="th_tablesubject">S.No</th>
        <th colspan="2" class="th_tablesubject">Course code</th>
        <th class="th_tablesubject">Subject</th>
        <th class="th_tablesubject">Paper</th>
        </tr> 
        
        
        <?php
        $sl=1;
        $gcount=0;
        $feegrandtotal=0;
        
        if (!empty($subjects)) 
        {
        foreach ($subjects as $stu => $val)
        { 
        
        
        
        foreach ($val as $sub )
        {
        //echo $sub['studid'];
        
        if($student_value->student_id==$sub['studid'])
        {
        ?>
        
        
        <tr>
        <td class="th_tablesubject">
        <?php echo $sl; ?>
        </td>
        
        
        <?php $subjectcode= $sub['subjectcode'];
        
        $arr = explode('-', trim($subjectcode));
        ?>
        <td class="th_tablesubject"><?php echo $arr[0]; ?></td>
        <td class="th_tablesubject"><?php echo $arr[1]; ?></td>
        <td class="th_tablesubject"><?php echo $sub['subject']; ?></td>
        <td class="th_tablesubject"></td>
        
        </tr>
        
        
        <?php
        
        
        $sl++;
        
        }
        
        $gcount= $sl-1;
        
        
        } 
        
        
        
        }
        }
        ?>   
        
        
        </table>
        </div>
        
        <div style="width: 70%; display: table;">
        
        
        
        <?php
        $bycategory=array();
        $applicationfee =0;
        $grandtotal=0;
        $student_val= $student_value->student_id;
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id !=', 5);
        $this->db->where('students.id', $student_val);
        $getstudent_workingdays= $this->db->count_all_results(); 
        
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 1);
        $this->db->where('students.id', $student_val);
        $getstudent_presentdays= $this->db->count_all_results();
        
        
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 6);
        
        $this->db->where('students.id', $student_val);
        $getstudent_halfdays= $this->db->count_all_results(); 
        
        
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 3);
        
        $this->db->where('students.id', $student_val);
        $getstudent_latedays= $this->db->count_all_results();
        
        
        
        
        
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('users', 'students.id = users.user_id', 'left');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('application_examfee', 'application_examfee.application_examfee_class = student_session.class_id','application_examfee.application_examfee_section = student_session.section_id');
        $this->db->where('application_examfee.application_examfee_session', $session_id);
        
        
        $this->db->where('application_examfee.application_examfee_examgroup', $post_exam_group_id);
        $this->db->where('application_examfee.application_examfee_examgroupbatch', $post_exam_id);
        $this->db->where('application_examfee.application_examfee_class', $class_id);
        $this->db->where('application_examfee.application_examfee_section', $section_id);
        
        $this->db->where('students.is_active', 'yes');
        $this->db->where('students.id', $student_val);        
        $query           = $this->db->get();
        $applicationfee  = $query->row_array();
        
        
        
        
        
        $this->db->select('online_examination_category,count(online_examination_category) as countcat ');
        $this->db->from('online_examination');
        $this->db->where('online_examination.online_examination_examgroup', $post_exam_group_id);
        $this->db->where('online_examination.online_examination_exam', $post_exam_id);
        $this->db->where('online_examination.online_examination_class_id', $class_id);
        $this->db->where('online_examination.online_examination_section_id', $section_id);
        $this->db->where('online_examination.online_examination_session_id', $session_id);
        $this->db->where('online_examination.online_examination_student_id', $student_val);
        $this->db->group_by('online_examination.online_examination_category');
        $query       =  $this->db->get();
        $bycategory  =  $query->result_array();
        
        
        
        
        $this->db->select('*');
        $this->db->from('fees_payment');
        $this->db->where('fees_payment.fees_payment_examgroup', $post_exam_group_id);
        $this->db->where('fees_payment.fees_payment_exam', $post_exam_id);
        $this->db->where('fees_payment.fees_payment_session', $session_id);
        $this->db->where('fees_payment.fees_payment_student_id', $student_val);
        $this->db->where('fees_payment.fees_payment_statuscode', 'S');
        $query            = $this->db->get();
        $fee_transcation  = $query->row_array();
        ?>
        
        </div>
        
        
        
        
        
        <div style="width:100%">
        
        <div style="width:60%; float:left; ">
        
        <table  style=" border: 1px solid #000;text-align: left; width: 100%;">
        <thead>
        <tr style="background-color:#c5cac5;border: 1px solid #000;">
        <th colspan="2" >Payment Details</th>
        </tr>
        </thead>
        <tbody>
        
        <tr >
        <td >Transaction Number:</td>
        <td><?php echo $fee_transcation['fees_payment_transaction_no'];  ?></td>
        </tr>
        
        
        
        <tr>
        <td>Transaction Amount:</td>
        <td><?php  echo $fee_transcation['fees_payment_amount']; ?></td>
        </tr>
        
        <tr>
        <td>Order Number</td>
        <td><?php  echo $fee_transcation['fees_payment_orderid']; ?></td>
        </tr>
        
        
        <tr>
        <td>Date</td>
        <td><?php  echo $fee_transcation['fees_payment_transdate']; ?></td>
        </tr>
        
        
        
        </tbody>
        </table>
        
        
        <br>
        
        <table  style=" border: 1px solid #000;
        text-align: left; width: 100%; ">
        <thead>
        <tr style="background-color:#c5cac5;border: 1px solid #000; text-align: center;">
        <th colspan="4" >Attendence Record</th>
        </tr>
        </thead>
        <tbody>
        <tr >
        <td>Number of Working Days</td>
        <td>Number of Attending Days</td>
        <td>Percentage of Attendance</td>
        <td>Eligible Status</td>
        </tr>
        
        <tr >
        <td><?php  echo $getstudent_workingdays; ?></td>
        <td><?php  
        
        $totalhalf=$getstudent_halfdays/2;
        
        
        
        echo $totalpresent=$getstudent_presentdays+$getstudent_latedays+$totalhalf; ?></td>
        <td><?php
        $count1=$totalpresent/$getstudent_workingdays;
        $count2=$count1*100;
        ?>
        
        <?php  echo number_format((float)$count2, 2, '.', ''); ?>%
        </td>
        <td>
        
        <?php
        if($count2 >=93.70)
        {
        $eligiblestatus="Eligible";
        }
        else
        {
        $eligiblestatus="Not Eligible";
        }
        echo $eligiblestatus; 
        ?>
        </td>
        </tr>
        
        
        
        
        
        </tbody>
        </table>
        
        </div>
        
        
        
        
        
        <div style="width:40%; float:left; height:250px;">
        
        <!--<table   style=" border: 1px solid #000;
        text-align: left; width: 100%;">
        <thead>
        <tr style="background-color:#c5cac5;border: 1px solid #000;">
        <th colspan="2" >Fee Details</th>
        </tr>
        </thead>
        <tbody>
        
        
        
        
        
        <tr style="line-height: 22px;" >
        <td >Description</td>
        <td style="padding-right:20px; text-align:right;">Amount</td>
        </tr>
        
        
        
        
        
        
        <tr style="line-height: 25px;">
        <td>Application Fee:</td>
        <td style="padding-right:20px; text-align:right;">50.00</td>
        </tr >
        
        <tr style="line-height: 24px;">
        <td>Each KEC Paper</td>
        <td style="padding-right:20px; text-align:right;"><?php $feetotal= $gcount*15;
        
        echo number_format((float)$feetotal, 2, '.', '');
        
        
        ?></td>
        </tr>
        
        
        <tr style="line-height:22px;">
        <td>First Appearance</td>
        <td style="padding-right:20px; text-align:right;">10.00</td>
        </tr>
        
        
        
        <tr style="line-height: 23px;">
        <td>Mark list fee</td>
        <td style="padding-right:20px; text-align:right;">40.00</td>
        </tr>
        
        
        
        
        <tr style="line-height: 22px;">
        <td>Evaluation Camp Fee</td>
        <td style="padding-right:20px; text-align:right;">75.00</td>
        </tr>
        
        
        <tr style="line-height: 26px;">
        <td>Total Amount</td>
        <td style="padding-right:20px; text-align:right;"><?php   $feegrandtotal=$feetotal+50+10+40+75;
        
        echo number_format((float)$feegrandtotal, 2, '.', '');
        ?></td>
        </tr>  
        
        
        
        
        
        
        
        </tbody>
        </table>-->
        
        
        
        <table  style=" border: 1px solid #000;text-align: left; width: 100%; min-height:248px  ">
        <thead>
        <tr style="background-color:#c5cac5;border: 1px solid #000; ">
        <th colspan="2" >Fee Details</th>
        </tr>
        </thead>
        <tbody>
        
        
        
        
        <tr style="line-height: 18px;" >
        <td ><b>Description</td>
        <td style="padding-right:20px; text-align:right;"><b>Amount(Rs.)</b></td>
        </tr>
        
        <tr style="line-height: 18px;">
        <td>Application Fee:</td>
        <td style="padding-right:20px; text-align:right;"> <?php echo number_format((float)$applicationfee['application_examfee_fees'], 2, '.', ''); ?> </td>
        </tr>
        
        <?php 
        $sl=2;
        $total=0;
        $subtotal=0;
        $totalSum=0;
        
        
        
        foreach($applicationsubject as $sub)
        {
        $totalapplication = $sub['application_fees_category'];
        $marklist         = $applicationfee['application_examfee_marklistfee'];
        $evaluation       = $applicationfee['application_examfee_evaluationcampfee'];
        $processing       = $applicationfee['application_examfee_processingfees'];
        
        if($sl==2)
        {
        $s='2';
        }
        else
        {
        $s="";
        }
        ?>
        
        <tr style="line-height: 18px;">        
        <td>Each  <?php echo $sub['application_fees_category']; ?> Paper</td>      
        
        <td style="padding-right:20px; text-align:right;">
        
        
        <?php
        
        foreach($bycategory as $cate)
        { 
        
        if($cate['online_examination_category']==$sub['application_fees_category'])
        {        
        
        
        $total= $sub['application_fees_fees']*$cate['countcat']; 
        
        
        echo ''.number_format((float)$total, 2, '.', '');
        $totalSum += $total;
        
        }
        
        
        }
        ?>
        
        
        </td>
        </tr>
        
        <?php $sl++; 
        } 
        
        ?>
        
        
        <tr style="line-height: 18px;">
        <td>Processing  fee</td>
        <td style="padding-right:20px; text-align:right;"> <?php echo number_format((float)$applicationfee['application_examfee_processingfees'], 2, '.', ''); ?></td>
        </tr>
        
        
        
        <tr style="line-height: 18px;">
        <td>Mark list fee</td>
        <td style="padding-right:20px; text-align:right;"> <?php echo number_format((float)$applicationfee['application_examfee_marklistfee'], 2, '.', ''); ?></td>
        </tr>
        
        
        <tr style="line-height: 18px;">
        <td>Evaluation Camp Fee</td>
        <td style="padding-right:20px; text-align:right;"><?php echo number_format((float)$applicationfee['application_examfee_evaluationcampfee'], 2, '.', ''); ?></td>
        </tr>
        
        
        <tr style="line-height: 18px;">
        <td><b>Total Amount</b></td>
        <td style="padding-right:20px; text-align:right;"><b><?php  $grandtotal=$totalSum+$applicationfee['application_examfee_processingfees']+$applicationfee['application_examfee_fees']+$applicationfee['application_examfee_marklistfee']+$applicationfee['application_examfee_evaluationcampfee'];
        echo 'Rs.'.number_format((float)$grandtotal, 2, '.', ''); ?></b></td>
        </tr> 
        
        </tbody>
        </table>
        
        
        
        
        
        </div>
        
        </div>
        
        <br>
        
        
        <div class="footer" style="width:100%; ">
        
        <div class="declaration" style="text-align:left; ">
        </div>
        
        <!--<hr class="line"></hr>-->
        <br>
        
        <div class="declaration_text" style="padding-left:8px;padding-right:8px;"> I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibility for
        the correctness of mentioned particular. </div>
        </div>
        
        
        
        
        
        
        
        
        
        <div style="width: 100%; display: table; ">
        
        <table  style="width:100% !important; ">
        
        
        <tr>
        
        <td class="" style="width:50%"></td>
        <td class="" style="width:20%;text-align:left;">Name of Student :</td>
        <td style="width:50%;"><?php echo $student_value->firstname;?></td>
        
        
        
        </tr>
        
        <tr>
        
        
        
        <td class="" style="width:50%"></td>
        <td class="" style="width:20%;text-align:left;">Signature</td>
        <td style="width:50%;">
        
        <?php
        if($student_value->studentsign!="")
        {
        ?>
        <img src="<?php echo base_url(); ?>/<?php echo $student_value->studentsign; ?>" style="height:30px; width:70px;">
        <?php 
        } 
        ?>
        </td>
        
        
        </tr>
        
        
        
        </table>
        </div>
        <br>
        <br>
        
        </div>
        </div>
        
        <?php } } ?>
        
        
        <div class="pagebreak"> </div>
        
        
        
        
        
        
        
        
        
        
