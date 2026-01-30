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
                
                page[size="A4"] 
                {  
                width: 21cm;
                height: 29.7cm; 
                }
                
                
                .container
                {
                width: 100%;
                }
                
                .tablesubject
                {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 1px solid #000; 
                font-size:14px;
                }
                
                .th_tablesubject
                {
                border: 1px solid #000;
                text-align:left;
                }
                
                .first_td
                {
                width:50%;
                font-size:16px; 
                line-height: 12px;
                }
                
                .tbl
                {
                font-size:16px;    
                }
                
                
                .second_td
                {
                width:5%;
                }
                
                .third_td
                {
                width:50%;
                margin-left: 0px;
                font-size:16px; 
                }
                
                .headertext
                {
                font-size:20px;
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
                font-size: 12px;
                margin-top:15px;
                }
                
                .declaration_text
                {
                font-size: 18px;
                width:680px;
                line-height:35x;
                }
                
                
                .th_tablesubject
                {
                font-size:18px;
               
               
                }
                
                
                #div_tablesubject
                {
                min-height: 1990px;
                }
                
                
                .pagebreak 
                {
                clear: both;
                page-break-after: always;
                }
                
                .cont
                {
                height: 1000px;
                max-height:1000px;
                width: 100%;
                border-top: 2px solid black;
                border-bottom: 2px solid black;
                border-left: 2px dotted black;
                border-right: 2px dotted black; 
                }
                
                
                
                .contain
                {
                height: 1050px;
                max-height:1050px;
                width: 100%;
                border-top: 2px solid black;
                border-bottom: 2px solid black;
                border-left: 2px dotted black;
                border-right: 2px dotted black; 
                }
                
                
                #conttable {
                width: 100%;
                margin: auto;
                /*text-align: left;*/
                
                }
                #first {
                width:48%;
                float: left;
                height: 200px;
                
                }
                #second {
                width: 48%;
                float: left;
                height: 200px;
               
                
                }
                #clear 
                {
                clear: both;
                }
                
                #space{
                width: 4%;
                float: left;
                height: 200px;
                }
                
                .tablec
                {
                margin: 0 auto;
                table-layout:fixed;
                width:100%;
                text-align:left;
                }
                
                
                .footer
                {
                font-size:18px;
                }
                
                .approved
                {
                font-size:20px;
                    
                }
                
                .approv
                {
                font-size:17px;
                }
                
                
                .taclss
                {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 0px solid #00000;
                text-align:center;
                }
                
                
                
                .taclss tr th
                {
                border: 1px black solid; 
                line-height:30px;
                background-color:#ccced8;
                font-size:20px;
                }
                
                
                .taclss tr td
                {
                border: 1px black solid; 
                line-height:30px;
                font-size:20px;
                text-align:left;
                padding-left:3px;
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
                    
                    
                <page size="A4">
                
                <div class="container">
                <div class="cont">    
                <div class="row">
                  <div id="" style="width:100%; height:auto;" >
                  <table>
                  <tr>
                  <td><img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%" height="150">
                  </td>
                  </tr>
                  </table>
                  </div>
                <div style="width: 100%; display: table;">
                <div style="width: 70%; float:left;">
                <table>
                <tr>
                <tr style="font-size:18px; ">
                <td><b>Application No:<?php 
                echo $student_value->studid; ?></b></td>
                </tr>
                    
                <td style="text-align: center; ">
                <span class="headertext" style="font-weight:bold; ">
                <b>Application Form for <?php echo $exam_subjects_row->examname;?> <br> 
                (Faculty of Islamic & Contemporary Studies)
                <br>
                </b>
                
                </span></td>
                
                </tr>
                </table>
                
                
                <table  float="left">
                <tr>
                <td class="first_td">Institution Id </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $student_value->admission_no; ?></td>
                </tr>
                
                <tr>
                <td class="first_td">Name of the applicant </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $student_value->firstname; ?></td>
                </tr>
                
                
                <tr>
                <td class="first_td">Register No </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $student_value->roll_no; ?></td>
                </tr>
                
                <tr>
                <td class="first_td">Age & date of birth</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $student_value->dob; ?></td>
                </tr>
                
                
                <tr>
                <td class="first_td">Name of the guardian</td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $student_value->guardian_name; ?></td>
                </tr>
                
                <tr>
                <td class="first_td">Address of communication </td>
                <td class="second_td">:</td>
                <td class="third_td"><?php echo $student_value->current_address; ?></td>
                </tr>
                
                
                </table>
                <span style="font-size:18px;"><b>Name of the paper attending for the examination</b></span>
                </div>
                
                
                <div style="width: 30%; float:left;">
                
                <table width="30%" float="left">
                    
                <tr style="text-align: center; font-size:14px;"><td><b> Date :
                
                
                
                <?php
                $this->db->select('*');
                $this->db->from('fees_payment');
                $this->db->where('fees_payment.fees_payment_examgroup', $post_exam_group_id);
                $this->db->where('fees_payment.fees_payment_exam', $post_exam_id);
                $this->db->where('fees_payment.fees_payment_session', $session_id);
                
                $this->db->where('fees_payment.fees_payment_class_id', $class_id);
                $this->db->where('fees_payment.fees_payment_section_id', $section_id);
                $this->db->where('fees_payment.fees_payment_student_id', $student_value->student_id);
                $this->db->where('fees_payment.fees_payment_statuscode', 'S');
                $query            = $this->db->get();
                $fee_trans  = $query->row_array();
                $newDate = date("d-F-Y", strtotime($fee_trans['fees_payment_transdate']));
                echo $newDate;
                 ?></b></td></tr>  
                <tr style="text-align: right;"> 
                <td>
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
                
                
                
            <div  style="height:auto;min-height:400px !important; ">
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
                
                <div class="" style="text-align:center; 
                font-size:18px;margin-top:6px;"><b>DECLARATION</b>
                </div>
                <div class="declaration_text" style="padding-left:8px;padding-right:8px;">
                I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibilty for the correctness of mentioned particular.
                </div>  
                
                
                
                
                        <div style="width: 100%; display: table; ">
                        
                        <table  style="width:100% !important; ">
                        
                        
                        <tr>
                        <td style="width:35%"></td>
                        <td class="approv" style="text-align:left;width:20%;"><b>Name of Student :</b></td>
                        <td class="approv" style="text-align:left;"><b><?php echo $student_value->firstname;?></b></td>
                        </tr>
                        
                        <tr style="line-height:30px;">
                        <td style="width:35%"></td>
                        <td class="approv" style="text-align:left;width:20%; "><b>Signature :</b></td>
                        <td style="text-align:left;width:20%; font-size:11px;">
                        
                        <?php
                        if($studid['studentsign']!="")
                        {
                        ?>
                        <img src="<?php echo base_url(); ?>/<?php echo $student_value->studentsign; ?>" style="height:20px; width:60px;">
                        <?php 
                        } 
                        ?>
                        </td>
                        
                        
                        </tr>
                        
                        
                        
                        </table>
                        </div>
                </div>
                 </div>
                
                <div class = "pagebreak" ></div>
                <div class="contain">    
                <div class="row" style="width:100%; margin-top:20px;">
                        
                        
                <div class="footer" style="width:100%;  ">
                
                <div style="width:100%">
                
                
                <div style="width:100%; min-height:280px;">
                
                <div style="width:55%; float:left; ">
                    
                    
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
            $this->db->where('fees_payment.fees_payment_student_id', $student_value->student_id);
            $this->db->where('fees_payment.fees_payment_statuscode', 'S');
            $query            = $this->db->get();
            $fee_transcation  = $query->row_array();
            ?> 
                    
                    
                    
                <table  style=" border: 1px solid #000; text-align: left; width: 100%; line-height:25px;">
                <thead>
                <tr style="background-color:#ccced8;border: 1px solid #000;text-align: center;">
                <th colspan="2" class="tbl" >Payment Details</th>
                </tr>
                </thead>
                <tbody>
                
                <tr >
                <td class="tbl">Transaction Number:</td>
                <td class="tbl"><?php  echo $fee_transcation['fees_payment_transaction_no']; ?></td>
                </tr>
                
                
                
                <tr>
                <td class="tbl" >Transaction Amount:</td>
                <td class="tbl"><?php  echo $fee_transcation['fees_payment_amount']; ?></td>
                </tr>
                
                <tr>
                <td class="tbl">Order Number</td>
                <td class="tbl"><?php  echo $fee_transcation['fees_payment_orderid']; ?></td>
                </tr>
                
                
                <tr>
                <td class="tbl">Date</td>
                <td class="tbl"><?php  echo $fee_transcation['fees_payment_transdate']; ?></td>
                </tr>
                
                
                </tbody>
                </table>
                
                
                
                
                <table  style=" border: 1px solid #000; margin-top: 5px;text-align: left; width: 100%; ">
                <thead>
                <tr style="background-color:#ccced8;border: 1px solid #000; text-align: center;">
                <th colspan="4" class="tbl" >Attendence Record</th>
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
                if($count2>=93.70)
                
                {
                $eligiblestatus="Eligible";
                
                }
                else
                {
                $eligiblestatus="Not Eligible";
                
                }
                echo  $eligiblestatus;
                ?>
                </td>
                </tr>
                </tbody>
                </table>
                </div>
                
                <div style="width:1%; float:left; height:240px;"></div>
                <div style="width:39%; float:left; height:240px;">
                
                
                <table  style=" border: 1px solid #000;text-align: left; width: 100%; min-height:248px  ">
                <thead>
                <tr style="background-color:#ccced8;border: 1px solid #000; ">
                <th colspan="2" class="tbl" >Fee Details</th>
                </tr>
                </thead>
                <tbody>
                
                
                <tr style="line-height: 18px;" >
                <td class="tbl"><b>Description</td>
                <td class="tbl" style="padding-right:20px; text-align:right;"><b>Amount(Rs.)</b></td>
                </tr>
                
                
                
                <tr style="line-height: 18px;">
                <td class="tbl">Application Fee:</td>
                <td  class="tbl"style="padding-right:20px; text-align:right;"> <?php echo number_format((float)$applicationfee['application_examfee_fees'], 2, '.', ''); ?> </td>
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
                <td class="tbl">  <?php echo $sub['application_fees_category']; ?> Paper</td>      
                
                <td class="tbl" style="padding-right:20px; text-align:right;">
                
                
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
                <td class="tbl">Processing  fee</td>
                <td class="tbl" style="padding-right:20px; text-align:right;"> <?php echo number_format((float)$applicationfee['application_examfee_processingfees'], 2, '.', ''); ?></td>
                </tr>
                
                
                
                <tr style="line-height: 18px;">
                <td class="tbl">Mark list fee</td>
                <td class="tbl" style="padding-right:20px; text-align:right;"> <?php echo number_format((float)$applicationfee['application_examfee_marklistfee'], 2, '.', ''); ?></td>
                </tr>
                
                
                <tr style="line-height: 18px;">
                <td class="tbl">Evaluation Camp Fee</td>
                <td  class="tbl" style="padding-right:20px; text-align:right;"><?php echo number_format((float)$applicationfee['application_examfee_evaluationcampfee'], 2, '.', ''); ?></td>
                </tr>
                
                
                   <tr style="line-height: 18px;">
                <td class="tbl">Fine Fee  after(<?php echo $applicationfee['application_examfee_finedate']; ?>)</td>
                <td  class="tbl" style="padding-right:20px; text-align:right;">Rs.<?php echo number_format((float)$applicationfee['application_examfee_finefees'], 2, '.', '');
                
                
                if($applicationfee['application_examfee_finedate']<=date('Y-m-d'))
                {
                   $finefees= $applicationfee['application_examfee_finefees'];
                    
                }
                else
                {
                 $finefees==0;   
                } ?></td>
                </tr>
                
                <tr style="line-height: 18px;">
                <td class="tbl"><b>Total Amount</b></td>
                <td class="tbl" style="padding-right:20px; text-align:right;"><b><?php  $grandtotal=$totalSum+$applicationfee['application_examfee_processingfees']+$applicationfee['application_examfee_fees']+$applicationfee['application_examfee_marklistfee']+$applicationfee['application_examfee_evaluationcampfee']+$finefees;
                echo 'Rs.'.number_format((float)$grandtotal, 2, '.', ''); ?></b></td>
                </tr> 
                </tbody>
                </table>
                </div>
                </div>
                </div> 
                </div>
                
                <div class="footer" style="width:100%;  ">
                <br>
                <div class="declaration" style="text-align:center; line-height: 4px; font-size:20px;margin-top:30px;"><b>CLEARANCE REPORT</b></div>
                <br>
                
                
                <br>
                
                <table class="taclss"  style="width:680px;  padding-left:5px;text-align:center;">
                    
                <tr >
                <th >Sl.No</th>
                <th >Authority</th>
                <th >Amount/Item</th>
                <th >Verified By</th>
                </tr>
                
                <tr>
                <td>1</td>
                <td>Administrative Office</td>
                <td></td>
                <td></td>
                </tr>
                
                <tr>
                <td>2</td>
                <td>Academic Office</td>
                <td></td>
                <td></td>
                </tr>
                
                <tr>
                <td>3</td>
                <td>Library</td>
                <td></td>
                <td></td>
                </tr>
                
                
                <tr>
                <td>4</td>
                <td>Students Union</td>
                <td></td>
                <td></td>
                </tr>
                
                <tr>
                <td>5</td>
                <td>Store</td>
                <td></td>
                <td></td>
                </tr>
                </table>
                <div class="declaration_text" style="padding-left:8px;padding-right:8px;padding-top:10px;">
                It is stated that the student named <b><?php echo $student_value->firstname;?></b> holding  the register number <b><?php echo $student_value->admission_no;?>     </b>, is qualified to  attend
                
                the examination with all financial and attendance clearances for the  academic year  <b> <?php echo $sessionlist['session']; ?></b>, as per  our records.
                </div>                     
                                            
                <br>
                <br>
                <div id = "conttable" >
                <div id="first">
                <table class="tablec">
                <tr style="line-height: 50px; ">
                <th style="text-align:left;">
                <span style="font-size:20px; font-weight:bold; margin-top:2px; " >
                <b> Verified By</b> </span>
                </th>
                <br>
                </tr>
                <tr>
                <td class="approved"><?php  echo $classteacher['name'];   ?>(Class Teacher)</td>
                </tr>
                <br>
                <tr style="line-height: 50px; ">
                <td class="approved">Signature</td>
                </tr>
                </table>
                </div>
                
                
                
                <div id = "space">
                </div>
                
                <div id = "second" style="text-align:left;" >
                <table >
                <tr style="line-height: 50px; ">
                <th style="text-align:left;">
                <span style="font-size:20px; font-weight:bold; padding-top:30px !important;" > <b>Approved By </b> </span>
                </th>
                </tr>
                
                <br>
                <tr>
                <td  class="approved">Academic Administrator</td>
                </tr>
                
                <br>
                <tr style="line-height: 50px; ">
                <td class="approved">Signature</td>
                </tr>
                </table>
                </div>
                </div>
                </div>                 
                </div>
                </div>
                </div>
                </page>
                
                
                <?php
                }
                }
                ?>
                
                
                
                
                
                
                
