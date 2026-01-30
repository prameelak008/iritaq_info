            <!DOCTYPE html>
            <html>
            <head>
            
            <!--<link href='https://fonts.googleapis.com/css?family=Noto Sans Malayalam' rel='stylesheet'>-->
            <style type="text/css">
            @media print {
            .pagebreak { page-break-before: always; } 
            
            }
            </style>
            <style>
            
            
            page[size="A4"] 
            {  
            width: 21cm;
            height: 29.7cm; 
            }
            
            
            /*@page{padding: 0; margin:5px;}*/
            body
            {
            margin:2px 2px 3px 1px; font-family: arial; color: #000; font-size: 12px; line-height: 10px;}
            .tableone{}
            .tableone td{border:1px solid #000; padding: 5px 0}
            
            .denifittable th{border-top: 1px solid #999;}
            .denifittable th,
            .denifittable td {border-bottom: 1px solid #999;
            
            border-collapse: collapse;border-left: 1px solid #999;}
            .denifittable tr th {padding: 4px 4px; font-weight: normal; font-size:12px;}
            .denifittable tr td {padding: 4px 4px; font-weight: normal;font-size:12px;}
            
            
            .tcmybg {
            background:top center;
            position: fixed;
            top: 10%;
            left: 20%;
            bottom: 0;
            z-index: -9999;
            opacity:0.15;
            text-align:center;
            
            }
            
            .tablemain{position: relative;z-index: 1;border:1px solid #000; padding: 8px;  height:925px;
            
            }
            
            *{
            box-sizing: border-box;
            
            }
            
            .tableclas
            {
            /*border: 1px black solid; */
            width:50%;
            line-height:3px;
            }
            
            .row {
            margin-left:-5px;
            margin-right:-5px;
            }
            
            .column {
            float: left;
            width: 75%;
            padding: 5px;
            }
            
            
            
            .columnn {
            float: left;
            width: 75%;
            padding: 5px;
            }
            
            
            
            .column_inst {
            float: left;
            width: 50%;
            padding: 5px;
            }
            
            .column_tag
            {
            float: left;
            width: 70%;
            padding: 5px;  
            }
            
            /* Clearfix (clear floats) */
            .row::after {
            content: "";
            clear: both;
            display: table;
            }
            
            .first_td
            {
            width:40px;
            height:10px;
            padding-left:5px;
            font-size:12px;
            }
            
            .third_td
            {
            width:60px;
            }
            
            .sub
            {
            width:100%;
            height:auto;
            
            }
            
            hr.hrcls
            {
            border-top: 1px solid #8c8b8b;
            }
            .hrclass {
            border: 1px solid black;
            }
            
            .tableclss {
            border-collapse: collapse;
            width: 100%;
            }
            
            .hrclass {
            height: 25px;
            }
            
            </style>
            </head>
            <body>
            
            
            
            
            <div class="tablemain">
            <div class="submain">
            <div class="sub" style=" height:90px;">
            <p style="text-align:center;">
                
            <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="90%" height="100px"> -->
        <img src="<?php echo FCPATH.'entrance/payment_code/'.$pdfimage['header_image']; ?>" width="90%" height="100px">
        </p>
            
            <hr style="	border: 1px solid #c1c2c2;"></hr>
            </div>
            
            <br>
            
            
            <div class="sub" style=" height:8px;">
            <h2  style="text-align:center;">ENTRANCE EXAMINATION 2023-24</h2>
            <h4 style="text-align:center;">EXAM RESULT</h4>
            </div>
            
            
            <br>
            <div class="sub"   >
            <div class="row">
            <div class="column">
            
            
            <table style="border:1px solid;" border="1" style="height:100px;width:760px; line-height:10px;" class="tableclss">
            
            <tr>
            <td width="25%" class="first_td" style="text-align: left;padding:11px;">APPLICATION NO</td>
            <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['admission_application_no']; ?></b></td>
            </tr>
            
            
            <!--<tr>-->
            <!--<td width="25%" class="first_td" style="text-align: left;padding:11px;">APPLIED DATE & TIME</td>-->
            <!--<td  class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_datetime']; ?></td>-->
            <!--</tr>-->
            <tr>
            <td class="first_td" width="25%" style="text-align: left;padding:11px;">CANDIDATE NAME</td>
            <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_name']; ?></td>
            </tr>
            <tr>
            <td  class="first_td" width="25%" style="text-align: left;padding:11px;">DATE OF BIRTH</td>
            <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_dob']; ?></td>
            </tr>
            <tr>
            <td class="first_td" width="25%" style="text-align: left;padding:11px;">NAME OF FATHER</td>
            <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_fathername']; ?></td>
            </tr>
            <tr>
            <td class="first_td" width="25%" style="text-align: left;padding:11px;">ADDRESS</td>
            <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_address']; ?></td>
            </tr>
            <tr>
            <td  class="first_td" width="25%" style="text-align: left;padding:11px;">APPLIED COURSE</td>
            <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['entranceexam_course_name']; ?></b></td>
            </tr>
            <tr>
            <td  class="first_td" width="25%" style="text-align: left;padding:11px;">EXAM CENTER</td>
            <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['admission_institute_examcenter']; ?></b></td>
            </tr>
            </table>
            </div>
            
            
            <div class="columnn">
            <table class="">
            <tr>

            
           

            <td style="text-align:left">

                
            <?php                                
            if (empty($admission["admission_photo"]))
            {
            // $image = FCPATH . "entrance/payment_code/default_male.jpg";
            } else {
            $image = FCPATH . "entrance/admissionphoto/".$admission['admission_photo'];
            }
            ?>          
                            
            <img src="<?php echo  $image; ?>" style="height:120px; width:100px; margin-top:2px;" >
            <br>
            <img src="<?php echo FCPATH. $admission['admission_qrcode'];?>"   style="height:100px; width:100px; margin-top:2px;" > 
               
            </td>


            
            </tr>
            </table>
            </div>
            </div>
            </div>
            
            
            <div class="sub" style="padding-bottom:20px;" >
            <div class="row">
            <table style="border:1px solid;" border="1" style="height:80px;  width:100%;" class="tableclss">
            <!-- <img src="<?php echo base_url('entrance/payment_code/backgroundadmitcard.jpg'); ?>" class="tcmybg" width="40%" height="30%" style="padding:80px 20px 20px 20px;" /> -->
            <img src="<?php echo FCPATH . 'entrance/payment_code/backgroundadmitcard.jpg'; ?>" class="tcmybg" width="40%" height="30%" style="padding:80px 20px 20px 20px;" />
            
            <tr>
            <th class="hrclass" style="text-align: center;">sl.No</th>
            <th class="hrclass" style="text-align: center;">Description</th>
            <th class="hrclass" style="text-align: center;" colspan="4">Marks</th>
            <th class="hrclass" style="text-align: center;" >Total</th>
            <th class="hrclass" style="text-align: center;">%</th>
            <th class="hrclass" style="text-align: center;">Grade</th>
            <th class="hrclass" style="text-align: center;">Rank</th>
            <th class="hrclass" style="text-align: center;">Result</th>
            </tr>
            
            
            
            <tr>
            <th class="hrclass" style="text-align: center;"></th>
            <th  class="hrclass" style="text-align: center;"></th>
            
            <?php
            foreach($subjectlist as $sub)
            {
            ?>
            <th style="text-align: center;" colspan="2"><?php   echo $sub['entrance_subtype_name']; ?></th>
            
            <?php } ?>
            <th  class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            <th  class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            </tr>
            
            
            
            <tr>
            <th class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            
            
            <?php
            $totalmax=0;
            $totalmark=0;
            
            foreach($subjectlist as $sub)
            {
            foreach($subjectmarks as $submark)
            {
            if($sub['entranceexam_subject_subid']==$submark['entranceexam_marks_subject_id']) 
            {
            
            //if($sub['entranceexam_subject_subid']==$submark['entranceexam_marks_subject_id'] && $sub['entranceexam_subject_sessionid']==$submark['entranceexam_marks_session_id'] && $sub['entranceexam_subject_course_id']==$submark['entranceexam_marks_course_id'] )
            //{ 
            ?>
            <th class="hrclass" style="text-align: center;">Max-<?php echo $submark['entranceexam_marks_maximum_marks'];?></th>
            <th class="hrclass" style="text-align: center;">Min-<?php echo $submark['entranceexam_marks_minimum_marks'];?></th>
            <?php
            $totalmax+=$submark['entranceexam_marks_maximum_marks'];
            }
            }
            } 
            ?>
            <th class="hrclass" style="text-align: center;"><?php  echo $totalmax; ?></th>
            <th class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            <th class="hrclass" style="text-align: center;"></th>
            </tr>
            
            
            <tr>
            <th class="hrclass" style="text-align: center;">1</th>
            <th class="hrclass" style="text-align: center;"><?php echo $admissionlist['entranceexam_course_name'];
            ?>
            
            
            </b></th>
            
            
            <?php
            /*
            foreach($subjectlist as $sub)
            {
            foreach($examresult as $exam) 
            {
            if($exam['entranceexam_result_applicant']==$admissionlist['admission_application_registerid']  && $exam['entranceexam_marks_subject_id']==$sub['entranceexam_subject_subid'])
            {
            ?>
            <th class="hrclass" style="text-align: center;" colspan="2" >
            <?php
            $mark= $exam['entranceexam_result_getmarks'];
            echo $mark; 
            ?>
            </th>
            <?php
            }
            else
            {
            ?>
           <th class="hrclass" style="text-align: center;" colspan="2" > </th>   
           <?php }
            
            
            } 
            }
            */
            ?>
            
            
            
            <?php
foreach ($subjectlist as $sub) {
    $markFound = false;
    foreach ($examresult as $exam) {
        if (
            $exam['entranceexam_result_applicant'] == $admissionlist['admission_application_registerid'] &&
            $exam['entranceexam_marks_subject_id'] == $sub['entranceexam_subject_subid']
        ) {
            $mark = $exam['entranceexam_result_getmarks'];
            ?>
            <th class="hrclass" style="text-align: center;" colspan="2">
                <?php echo $mark; ?>
            </th>
            <?php
            $markFound = true;
            break; // Stop inner loop once the mark is found
        }
    }
    if (!$markFound) {
        ?>
        <th class="hrclass" style="text-align: center;" colspan="2"> </th>
        <?php
    }
}
?>

            
            <th class="hrclass" style="text-align: center;"><?php  echo number_format($getresult['exam_publish_totalmarks'],2);   ?></th>
            <th class="hrclass" style="text-align: center;"><?php  echo number_format($getresult['exam_publish_percentage'],2);   ?></th>
            <th class="hrclass" style="text-align: center;"><?php  echo $getresult['exam_publish_grade'];   ?></th>
            <th class="hrclass" style="text-align: center;"><?php  echo $getresult['exam_publish_rank'];   ?></th>
            <th class="hrclass" style="text-align: center;"> 
            
            <?php
            
            
            $totalmark     =   number_format($getresult['exam_publish_totalmarks'],2);
            
            // if($admissionlist['admission_application_selectedcourse']=='5')
            // {
            // $getpassed   = $totalmax*40/100;
            // }
            // else
            // {
            // $getpassed   = $totalmax*50/100;    
            // }
            
            $getpassed   = $totalmax*$raw_percentage['entranceexam_seatquota_passoutpercentage']/100;
            
            if($totalmark>=$getpassed)
            {
            echo "Passed"; 
            }
            else
            {
            echo "Failed";  
            } 
            ?>
            </th>
            </tr>
            </table>
            </div>
            </div>
            
            
            
            
            <div class="sub" style="padding-bottom:6px;">
            <div class="row">
            <table class="tableclss" style="width:100%;" >
            <tr>
            <th class="hrclass" style="text-align: center; width:50%;">ADMISSION STATUS</th>
            <th class="hrclass" style="text-align: center; width:50%;">
            
            <?php  $percentage= number_format($getresult['exam_publish_percentage'],2);
            
            if($percentage>=$raw_percentage['entranceexam_seatquota_eligiblepercentage'])
            {
            $status=" RANK LIST";  
            
            }
            else if($percentage<=$raw_percentage['entranceexam_seatquota_eligiblepercentage'] && $percentage>=$raw_percentage['entranceexam_seatquota_passoutpercentage'])
            {
            $status=" WAITING LIST";    
            }
            
            else
            {
                $status="NOT ELIGIBLE";
            }
            echo $status;
            
            ?>
            </th>
            </tr>
            </table>
            <br>
            
            <table class="tableclss" style="width:100%;">
            <tr>
            <th class="hrclass" class="hrclass" style="text-align: center; width:50%;">Percentage for Pass Out:&nbsp;&nbsp;<?php echo $raw_percentage['entranceexam_seatquota_headerpercentage'];  ?></th>
            <th class="hrclass" style="text-align: center; width:50%;">Percentage for Admission Eligibilty:&nbsp;&nbsp;<?php echo $raw_percentage['entranceexam_seatquota_admissioneligibilty'];  ?></th>
            </tr>
            </table>
            </div>
            </div>
            
            
            <div class="sub" style="padding-bottom:10px;">
            <div class="row">
            <table style="border:1px solid;" border="1" style="height:80px;  width:100%;" class="tableclss">
            
            <tr>
            <th class="hrclass" style="text-align: center;">A+ : 90% & Above</th>
            <th class="hrclass" style="text-align: center;">A :  80% - 89%</th>
            <th class="hrclass" class="hrclass" style="text-align: center;">B+ : 70% - 79%</th>
            <th class="hrclass" style="text-align: center;">B :  60% - 69%</th>
            <th  class="hrclass" style="text-align: center;">C+ : 50% - 59%</th>
            </tr>
            
            <tr>
            <th class="hrclass" style="text-align: center;">C :  40% - 49%</th>
            <th class="hrclass" style="text-align: center;">D+ : 30% - 39%</th>
            <th class="hrclass" style="text-align: center;">D :  20% - 29%</th>
            <th class="hrclass" style="text-align: center;">E+ : 10% - 19%</th>
            <th class="hrclass" style="text-align: center;">E :   0% - 9%</th>
            </tr>
            </table>
            </div>
            </div>
            
            
            
            <div class="sub" style="margin-top:3px;">
            <div class="row">
            <div class="column_tag">
            <span>Mundkkulam, Muthuparamba Post<br>
            Kondotty, Malappuram, Kerala, 673 638<br>
            www.jamiajalaliyya.com<br>
            jamiajalaliyya@gmail.com</span>
            </div>
            
            <div class="column_tag" >
            <img src="<?php echo FCPATH . 'entrance/payment_code/' . $pdfimage['signaturecontroller']; ?>" 
     style="width:150px; height:30px; opacity:3.0">

            
            
            <br>
            
            <h4 class="text-right"><b>Controller of Examinations</b></h4>
            <h5 class="text-right"><b>JAMIA JALALIYYA MUNDKKULAM</b></h5>
            </div>
            </div>
            </div>
            
            
            
            <div class="sub" style=" display: inline-block;position: fixed;    vertical-align: bottom;    width: 100%;    bottom: 60px; ">
            <div class="row">
            
            <table style="width:100%;font-style: italic; padding-left:20px;">
            <tr>
                <!--<td style="width:60%;">Published Date:<?php  echo date("d-F-Y", strtotime($publishresult['exam_publish_date']));?></td>-->
                
            <td style="width:60%;">Published Date:<?php  echo date("d-F-Y", strtotime($entrance_ui_phaseresult['set_general_publishdate']));?></td>    
                
                
            <td style="width:100%;text-align:right;">Printed Date:<?php echo date('d-F-Y'); ?></td>
            
            </tr>
            </table>
            
            
            </table>
            </div>
            </div>
            </div>  
            
            </div>
            <div class="pagebreak"></div>
            
            </body>
            
            </html>
            
            
            
            
            
