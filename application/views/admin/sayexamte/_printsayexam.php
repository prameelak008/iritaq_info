            
            <html>
            <head>
            <style type="text/css">
            @media print {
            .pagebreak1 { page-break-before: always; } /* page-break-after works, as well */
            }
            
            .pagebreak
            {
            page-break-after: always;
            display: block;
            clear: both;
            }
            </style>
            
            
            
            
            
            <style type="text/css">
            
            @page{padding: 0; margin:0;}
            
            body{padding: 0; margin:8mm 8mm 8mm 8mm; font-family: arial; color: #000; font-size: 8px; line-height: normal; }
            .tableone{}
            .tableone td{border:1px solid #000; padding:3px 0}
            .denifittable th{}
            .denifittable th,
            .denifittable td {border: 1px solid #000;
            border-collapse: collapse;border-left: 1px solid #999;}
            .denifittable tr th {padding: 8px 0px;  font-size: 12px}
            .denifittable tr td {padding: 8px 0px; font-weight: normal; font-size: 12px}
            
            
            
            .tcmybg {
            background:top center;
            background-size: 100% 100%;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1;
            width: 100%;height: 100%;
            }
            
            .tablemain1
            {
            position: relative;
            z-index: 1;
            border:1px solid #000; 
            padding: 3px;
            min-height: 940px;
            }
            
            
            .trstyle
            {
            height:3mm;
            } 
            
            
            
            .tdstylelabel
            {
            width:45%;
            padding-left: 12px;
            font-size:14px;
            
            }
            
            
            .tdstyledot
            {
            width:5%;
            text-transform: uppercase;
            }
            
            .tdstyle
            {
            width:50%; 
            font-size:14px;
            
            }
            
            .headerclass
            {
            font-weight: 500;
            
            }
            
            
            .footerclass
            {
            font-weight: bold;
            }
            
            .pagesize
            {
            width: 21cm;
            height: 29.7cm; 
            }
            .container
            {
            width: 100%;
            }
            
            </style>
            </head>
            
            
            <?php
            
            
            
            
            
            if (!empty($student_details)) 
            {
            foreach ($student_details as $student_key => $student_value)
            { 
            ?>
            
            
            
            
            
            
            <body>
            <div class="container">
            <div style="margin: 0 auto; padding: 5px 5px 5px;position: relative; z-index: 0;">
            <div class="tablemain1">
            <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td valign="top" align="center" width="100">
            
            <img src="<?php echo base_url('backend/default_format/exam_result_logo.jpg'); ?>" width="650" height="120">
            </td>
            </tr>
            </table>
            
            <div style="width:100%">
            <span>
            <h1 style="text-align:center"><?php echo $this->lang->line('application_for_sayexam'); ?>  </h1>
            <h1 style="text-align:center"><?php //echo $marksheet_Newexamgroup; ?></h1><br>
            </span>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%"  class="tablemain">
            <tr>
            <td valign="top">
            <table cellpadding="0" cellspacing="0" width="100%" class="">
            
            <tr>
            <td valign="top">
            <table cellpadding="0" cellspacing="0" width="100%" class="">
            <tr>
            <td colspan="3" style="text-align:center;">
            <?php echo $getgroup_name['exam'];  ?><br>
            <b>(Faculty of Islamic & Contemporary Studies)</b>
            </td>
            
            </tr>
            
            
            
            
            <tr class="trstyle">                                       
            
            <td class="tdstylelabel">Institution Id
            </td>
            <td  class="tdstyledot" >:</td>
            <td class="tdstyle" ><span>
            
            
            
            <?php echo $student_value->admission_no; ?></span>
            </td>
            
            </tr>
            
            
            <tr class="trstyle">                                       
            
            <td class="tdstylelabel">Name of the applicant(in block letters)
            </td>
            <td  class="tdstyledot" >:</td>
            <td class="tdstyle" ><span ><?php   echo $student_value->firstname; ?></span>
            </td>
            
            </tr>
            
            
            
            
            <tr class="trstyle">                                       
            
            <td class="tdstylelabel"><?php echo $this->lang->line('roll_no'); ?>
            </td>
            <td  class="tdstyledot" >:</td>
            <td class="tdstyle" ><span >
            
            <?php 
            //$roll_no=($exam->use_exam_roll_no) ? $student_value['exam_roll_no']:$student_value['student_roll_no'];
            //echo  $student_value->roll_no;
            echo  $student_value->profile_roll_no;
            
            ?>
            </span>
            </td>
            
            </tr>
            
            
            <tr class="trstyle">
            <td class="tdstylelabel" > <?php echo $this->lang->line('date_of_birth'); ?>
            </td>
            <td class="tdstyledot" >:</td>
            <td class="tdstyle" ><span ><?php echo $student_value->dob; ?></span>
            </td>
            </tr>
            
            
            <tr class="trstyle">
            <td class="tdstylelabel" >Name of the Guardian
            </td>
            <td class="tdstyledot" >:</td>
            <td class="tdstyle"><span ><?php echo $student_value->father_name; ?></span>
            </td>
            </tr>
            
            
            <tr class="trstyle">
            <td class="tdstylelabel" > <?php echo $this->lang->line('address'); ?>
            </td>
            <td class="tdstyledot" >:</td>
            <td class="tdstyle" ><span ><?php echo$student_value->current_address; ?></span>
            
            
            </td>
            
            
            </tr>
            </table>
            </td>
            
            
            <td valign="top" align="center"><?php if ($student_value->image!= '') { ?><img src="<?php echo base_url() . $student_value->image; ?>" width="150" height="180" >
            <?php } ?>
            </td>
            
            
            </tr>
            </table>
            </td>
            </tr>
            
            
            
            
            <tr><td>&nbsp;</td></tr>
            
            
            
            <tr>
            <td valign="top">
            
            
            <div style="min-height:110mm;">
            <span style="font-weight:bold;"><b>Applied Subject Details :</b></span>
            
            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
            <thead>                                         
            
            <tr>
            <th class="headerclass">Sl.No</th>
            <th colspan="2" class="headerclass"><b>Subjects</b></th>
            
            
            <th ><b>Marks Obtained</b></th>
            <th rowspan="2"><b>Total</b>   </th>
            
            
            <th  class="headerclass" ><b>Grade</b>   </th>
            </tr>
            </thead>
            
            <tr>
            <td></td>
            <td>Code</td>
            <td>Name</td>
            
            
            <!--<td>CE</td>-->
            <td>TE</td>
            <td></td>
            <td></td>
            
            </tr>
            
            
            
            
            <?php
            
            $obtainedtotal=0;
            $maxtotal=0;
            $singlepercentage=0;
            
            $count=1;
            
            $feetotal=0;
            $feegrandtotal=0;
            $gcount=0;
            
            
            foreach($sayexam_marks as $sayexam_mark)
            {
            foreach($sayexam_mark as $syexam)
            {  
            
            if($student_value->student_id==$syexam['exam_group_exam_sayexam_student_studentid'])
            { 
            ?>
            
            <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $syexam['code'];  ?></td>
            <td><?php echo $syexam['name'];  ?></td>
            
            
            <!--<td><?php echo $syexam['gtcmark'];  ?></td>-->
            <td><?php echo $syexam['get_marks'];  ?></td>
            <td><?php  
            //$obtainedtotal= $syexam['gtmark'];
            
            $obtainedtotal= $syexam['get_marks'];
            
            ?>
            <?php
         
            
            $maxtotal= $syexam['max_marks'];
            echo number_format((float)$obtainedtotal, 2, '.', '');
            $singlepercentage=$obtainedtotal/$maxtotal*100;
            ?>
            
            </td>
            
            <td>
            <?php
            
            if($singlepercentage<=100 && $singlepercentage>=90)
            {
            $fgde="A+" ;
            }
            elseif($singlepercentage<=89 && $singlepercentage>=80)
            {
            $fgde="A";
            }
            elseif($singlepercentage<=79 && $singlepercentage>=70)
            {
            $fgde="B+";
            }
            elseif($singlepercentage<=69 && $singlepercentage>=60)
            {
            $fgde="B";
            }
            elseif($singlepercentage<=59 && $singlepercentage>=50)
            {
            $fgde="C+";
            }
            elseif($singlepercentage<=49 && $singlepercentage>=40)
            {
            $fgde="C";
            }
            elseif($singlepercentage<=39 && $singlepercentage>=30)
            {
            $fgde="D+";
            }
            elseif($singlepercentage<=29 && $singlepercentage>=20)
            {
            $fgde="D";
            }
            elseif($singlepercentage<=19 && $singlepercentage>=10)
            {
            $fgde="E+";
            }
            elseif($singlepercentage<=9)
            {
            $fgde="E";
            }
            echo $fgde;
            $count++;
            ?>
            
            </td>
            </tr>
            <?php 
            }
            } 
            } 
            $gcount= $count-1;
            ?>
            </table>
            
            </div>
            
            <div style="width:100%">
            
            <style>
            .wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            }
            
            
            
            
            table:first-child {
            margin-right: 10px;
            }
            
            </style>
            <div class="wrapper">
            <table id="table-one" style=" border: 1px solid #000;
            text-align: left; width: 100%;">
            <thead>
            <tr style="background-color:#c5cac5">
            <th colspan="2">Fee Details</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>Description</td>
            <td style="padding-right:15px;text-align: right;">Amount <i class="fa fa-rupee"></i>  </td>
            </tr>
            
            
            <tr>
            <td>Application Fee</td>
            <td style="padding-right:15px;text-align: right;"><?php $feetotal= $gcount*$sayexamfee_feecharge_te['examfees_charge_fees_charge']; 
            
            echo number_format((float)$feetotal, 2, '.', '');
            
            
            ?></td>
            </tr>
            
            
            <tr>
            <td>Processing Charge</td>
            <td style="padding-right:15px;text-align: right;">
            
            <?php echo $sayexamfee_feecharge_te['examfees_charge_processing_charge']; ?></td>
            </tr>
            
            <tr>
            <td>Total Amount</td>
            <td style="padding-right:15px;text-align: right;"><?php   $feegrandtotal=$feetotal+$sayexamfee_feecharge_te['examfees_charge_processing_charge'];
            
            echo number_format((float)$feegrandtotal, 2, '.', '');
            ?></td>
            </tr>
            
            
            
            
            
            </tbody>
            </table>
            
            
            <table id="table-two"  style=" border: 1px solid #000;
            text-align: left; width: 100%;">
            <thead>
            <tr style="background-color:#c5cac5;border: 1px solid #000;">
            <th colspan="2" >Payment Details</th>
            
            
            <?php
            $this->db->select('*');
            $this->db->from('fees_sayexampayment_temarks');
            $this->db->where('fees_sayexampayment_examgroup',$post_exam_id);
            $this->db->where('fees_sayexampayment_examgroupbatch',$post_exam_group_id);
            $this->db->where('fees_sayexampayment_session_id', $session_id); 
            $this->db->where('fees_sayexampayment_class_id', $class_id); 
            $this->db->where('fees_sayexampayment_section_id', $section_id); 
            $this->db->where('fees_sayexampayment_statuscode','S');
            $this->db->where('fees_sayexampayment_student_id',$student_value->student_id);
            $query=$this->db->get();
            $sayexam_paymentdetails= $query->row_array();
            
            ?>
            </tr>
            </thead>
            <tbody>
            <tr >
            <td >Transaction Number:</td>
            <td><?php   if($sayexam_paymentdetails['fees_sayexampayment_transaction_no']!=""){ echo $sayexam_paymentdetails['fees_sayexampayment_transaction_no']; } ?></td>
            </tr>
            
            <tr>
            <td>Transaction Amount:</td>
            <td><?php   if($sayexam_paymentdetails['fees_sayexampayment_amount']!=""){ echo $sayexam_paymentdetails['fees_sayexampayment_amount']; } ?></td>
            </tr>
            
            <tr>
            <td>Order Number</td>
            <td><?php   if($sayexam_paymentdetails['fees_sayexampayment_orderid']!=""){ echo $sayexam_paymentdetails['fees_sayexampayment_orderid']; } ?></td>
            </tr>
            
            
            <tr>
            <td>Date</td>
            <td><?php //echo date('d-m-y H:i:s');?>
            <?php  if($sayexam_paymentdetails['fees_sayexampayment_transdate']!=""){ echo $sayexam_paymentdetails['fees_sayexampayment_transdate']; } ?>
            </td>
            </tr>
            
            
            
            
            
            </tbody>
            </table>
            
            </div>
            
            <table width="100%">
            <tr><td colspan="2" style="text-align: center; font-weight:bold;">DECLARATION</td></tr>
            
            
            <tr><td colspan="2">
            I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibilty for the correctness of mentioned particular.
            </td></tr>
            
            
            <tr>
            <td style="width:50%" >&nbsp;</td>
            <td style="text-align: left; font-weight:bold;">Name of Student:<?php echo $student_value->firstname,$student_value->middlename,$student_value->lastname;  ?></td></tr>
            <tr><td style="width:50%">&nbsp;</td><td style="text-align: left; font-weight:bold;">Signature:
            
            <?php
            if($student_value->studentsign!="")
            {
            ?>
            <img src="<?php echo base_url(); ?>/<?php echo $student_value->studentsign; ?>" style="height:30px; width:70px;">
            <?php  } ?>
            
            
            
            </td></tr>
            </table>
            </div>
            
            </div>
            
            </div>                         
            
            
            
            
            
            </div>
            </table>
            <br>
            <div>
            </div>
            
            <br>
            <div>
            </div>                               
            
            </td>
            </tr>
            
            
            <tr>
            <td valign="top" height="20"></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="pagebreak"> </div>
            </body>
            
            <?php } ?>
            
            
            
            <?php } ?>
            
            
            </html>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
