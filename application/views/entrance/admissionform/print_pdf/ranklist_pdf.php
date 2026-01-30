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
            
            .tablemain{position: relative;z-index: 1;border:1px solid #000; padding: 10px;  height:925px;
                
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
            
            table
            {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            /*border: 1px solid #ddd;*/
            }
            
            th, td {
            text-align: left;
            padding: 8px;
            line-height:normal;
            }
            
            tr:nth-child(even) {
            /*background-color: #f2f2f2;*/
            }
            
            .first_td
            {
            width:40px;
            height:4px;
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
            
          
            
            </style>
            </head>
            <body>
        
            <div class="tablemain">
            <div class="submain">
            <div class="sub" style=" height:90px;">
            <p style="text-align:center;"><img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="80%" height="90px"></p>
            
            <hr style="	border: 1px solid #c1c2c2;"></hr>
            </div>
            
            <br>
            <br>
            
            <div class="sub" style=" height:8px;">
            <h2  style="text-align:center;">ENTRANCE EXAMINATION 2023</h2>
            <h4 style="text-align:center;">RANK LIST</h4>
            </div>
            <br>
            <br>
            
            
            
            <div class="sub" style=" display: inline-block;   width: 100%;">
            <div class="row">
                
                <table style="width:100%;font-style: italic; padding-left:20px;">
                    <tr><td style="width:60%;">File No:01</td>
                    <td style="width:100%;text-align:right;">Published Date:<?php  echo date("d-F-Y", strtotime($publishresult['exam_publish_date']));?></td></tr>
                </table>
                
                
            </table>
            </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            
            
            
            <div class="sub" style="padding-bottom:10px;"  >
            <div class="row">
            <div class="column">
               
            
                <table style="border:1px solid;" border="1" style="height:70px;width:780px" class="">
                     
                <tr>
                    <td width="25%" class="first_td" style="text-align: left;padding:6px;">COURSE</td>
                    <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['entranceexam_course_name']; ?></b></td>
                </tr>
                <tr>
                    <td width="25%" class="first_td" style="text-align: left;padding:6px;">TOTAL SEAT</td>
                    <td  class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_datetime']; ?></td>
                </tr>
               
            </table>
            </div>
            </div>
            </div>
            
            
            <div class="sub" style="padding-bottom:30px;" >
            <div class="row">
            <table style="border:1px solid;" border="1" style="height:80px;  width:100%;" class="">
            <img src="<?php echo base_url('entrance/payment_code/backgroundadmitcard.jpg'); ?>" class="tcmybg" width="40%" height="30%" style="padding:80px 20px 20px 20px;" />
            
            
            <tr>
            <th style="text-align: center;">sl.No</th>
            <th style="text-align: center;">Application No</th>
            <th style="text-align: center;">Applicant Name</th>
            <th style="text-align: center;" colspan="4">Marks</th>
            <th style="text-align: center;" >Total</th>
            <th style="text-align: center;">%</th>
            <th style="text-align: center;">Grade</th>
            <th style="text-align: center;">Rank</th>
            <th style="text-align: center;">Result</th>
            </tr>
            
            
            
            <tr>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            
            <?php
            foreach($subjectlist as $sub)
            {
            ?>
            <th style="text-align: center;" colspan="2"><?php   echo $sub['entrance_subtype_name']; ?></th>
            
            <?php } ?>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
             <th style="text-align: center;"></th>
            </tr>
            
            
            
            <tr>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
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
            <th style="text-align: left;">Max-<?php echo $submark['entranceexam_marks_maximum_marks'];?></th>
            <th style="text-align: left;">Min-<?php echo $submark['entranceexam_marks_minimum_marks'];?></th>
            
            <?php
            $totalmax+=$submark['entranceexam_marks_maximum_marks'];
            }
            }
            } 
            ?>
            
            
            <th style="text-align: center;"><?php  echo $totalmax; ?></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"></th>
            </tr>
            
            
            
            
            <tr>
            <th style="text-align: center;">1</th>
             <th style="text-align: center;"><?php echo $admissionlist['entranceexam_course_name']; ?></b></th>
            <th style="text-align: center;"><?php echo $admissionlist['entranceexam_course_name']; ?></b></th>
            <?php
            
            foreach($subjectlist as $sub)
            {
                
            foreach($examresult as $exam) 
            { 
                
            if($exam['entranceexam_result_applicant']==$admissionlist['admission_application_registerid']  && $exam['entranceexam_marks_subject_id']==$sub['entranceexam_subject_subid']  && $exam['entranceexam_marks_session_id']==$sub['entranceexam_subject_sessionid'])
            {
            ?>
            <th style="text-align: center;" colspan="2" ><?php $mark= $exam['entranceexam_result_getmarks'];
            echo $mark; ?></th>
            
            <?php
            }
            } 
            } 
            ?>
            
            <th style="text-align: center;"><?php  echo number_format($getresult['exam_publish_totalmarks'],2);   ?></th>
            <th style="text-align: center;"><?php  echo number_format($getresult['exam_publish_percentage'],2);   ?></th>
            <th style="text-align: center;"><?php  echo $getresult['exam_publish_grade'];   ?></th>
            <th style="text-align: center;"><?php  echo $getresult['exam_publish_rank'];   ?></th>
            <th style="text-align: center;">
                
            <?php
            
            
            $totalmark     =   number_format($getresult['exam_publish_totalmarks'],2);
            
            if($admissionlist['admission_application_selectedcourse']=='5')
            {
            $getpassed   = $totalmax*40/100;
            }
            else
            {
            $getpassed   = $totalmax*50/100;    
            }
            
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
            
            <div class="sub" style=" display: inline-block;position: fixed;    vertical-align: bottom;    width: 100%;    bottom: 60px; ">
            <div class="row">
            
            <table style="width:100%;font-style: italic; padding-left:20px;">
            <tr><td style="width:60%;">Published Date:<?php  echo date("d-F-Y", strtotime($publishresult['exam_publish_date']));?></td>
            <td style="width:100%;text-align:right;">Printed Date:<?php echo date('d-F-Y'); ?></td></tr>
            </table>
            
           
           
            </div>
            </div>
            </div>  
            
            </div>
            <div class="pagebreak"></div>
           
            </body>
            
            </html>
            
            
            
            
            
