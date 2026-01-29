                            
                            
                            
                            
                            <div id="mod">
                            <?php
                            
                            $totalhalf=$getstudent_halfdays/2;
                            
                            $getstudent_workingdays;
                            $totalpresent=$getstudent_presentdays+$getstudent_latedays+$totalhalf;
                            
                            $count1=$totalpresent/$getstudent_workingdays;
                            $count2=$count1*100;
                            ?>
                            
                            <p>Present Days:<?php  echo number_format((float)$count2, 2, '.', ''); ?>%</p>
                            <table width="100%" class="table table-hover">
                            <thead>
                            
                            <tr>
                            <th>Group Name</th>
                            <th>Exam Name</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            
                            </tr>
                            
                            </thead>
                            <tbody>
                            
                            
                            <?php
                            
                            $sl=1;
                            
                            foreach($getsubject as $subject)
                            {
                            ?>
                            <tr>
                            <td><b><?php echo $subject['groupname']; ?></b></td>
                            
                            <td><b><?php echo $subject['examname']; ?></b></td>
                            
                            
                            
                            <?php
                            
                            $studid 	    = $subject['studid']; 
                            $groupid	    = $subject['groupid'];
                            $exambatchid	= $subject['exambatchid'];
                            
                            ?>
                            
                            <td>
                            
                            
                            
                            <input type="hidden" name="studid" id="studid<?php echo $sl; ?>" value="<?php echo $studid; ?>">
                            <input type="hidden" name="groupid" id="groupid<?php echo $sl; ?>" value="<?php echo $groupid; ?>">
                            <input type="hidden" name="exambatchid" id="exambatchid<?php echo $sl; ?>" value="<?php echo $exambatchid; ?>">
                            </td>
                            </tr>
                            
                            
                            
                            <?php
                            $this->db->select('*');
                            $this->db->from('online_examination');
                            $this->db->join('exam_groups', 'exam_groups.id  = online_examination.online_examination_examgroup');
                            
                            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination.online_examination_exam');
                            $this->db->join('subjects', 'subjects.id  = online_examination.online_examination_subject','left');
                            
                            $this->db->where('online_examination.online_examination_student_id', $studid);
                            
                            $this->db->where('online_examination.online_examination_examgroup',$groupid); 
                            $this->db->where('online_examination.online_examination_exam',$exambatchid);                            
                            
                            $query=$this->db->get();
                            $res= $query->result_array();
                            ?>
                            
                            
                            <tr>
                            <td>
                            
                            
                            
                            
                            <?php
                            foreach($res as $getsub)
                            {
                            ?>
                            
                            <tr>
                            <td>&nbsp;</td>
                            <td><?php echo $getsub['name'];  ?></td>
                            </tr>
                            
                            
                            <?php } ?>
                            </td>
                            </tr>
                            <tr>
                            
                            <td>
                            
                            <?php
                            
                            
                            foreach($online_exam_accept_result as $res)
                            {
                            
                            if($res['online_examination_student_id']==$studid && $res['online_examination_examgroup']==$groupid && $res['online_examination_exam']==$exambatchid)
                            
                            {
                            
                            if($res['online_examination_subject_status']=='1' && $res['online_examination_admin_approve']=='1')
                            {
                            $status="Waiting";
                            $class="warning";
                            
                            }
                            
                            elseif($res['online_examination_subject_status']=='2' && $res['online_examination_admin_approve']=='1')
                            {
                            $status="Waiting For Admin Approval";
                            $class="primary";
                            
                            }
                            
                            
                            elseif($res['online_examination_subject_status']=='3' && $res['online_examination_admin_approve']=='1')
                            {
                            $status="Waiting For Admin  Approval";
                            $class="primary";
                            
                            }
                            
                            elseif($res['online_examination_subject_status']=='2' && $res['online_examination_admin_approve']=='2')
                            {
                            $status="Accepted";
                            $class="success";
                            
                            
                            }
                            
                            
                            elseif($res['online_examination_subject_status']=='3' && $res['online_examination_admin_approve']=='3')
                            {
                            $status="Rejected";
                            $class="danger";
                            
                            }
                            
                            else
                            {
                            $status="";                            
                            }                         
                            
                            
                            echo "<button type='button'  class='btn btn-$class'>$status</button>";                             
                            }                           
                            
                            } 
                            
                            ?>
                            </td>
                            
                            <td>
                            <a  class="btn-link-button" onclick="accept_ajaxexam(<?php echo $sl; ?>)" href="<?php echo site_url(); ?>/admin/onlineexam/accept_exam/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>">Accept</a>
                            </td>


                            <td>                            
                            <a  class="btn-link-cancel-button"  href="<?php echo site_url(); ?>/admin/onlineexam/reject_exam/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>">Reject</a>
                            </td>
                            
                            
                            <td>   
                            <input type="button" value="Generate" id="btnPrint" onclick="getdata_result(<?php echo $sl; ?>)" /> 
                            
                            

                            <script>                            
                            
                            function getdata_result(row)
                            { 
                            var studid      = $("#studid"+row).val();
                            var group       = $("#groupid"+row).val();
                            var exambatchid = $("#exambatchid"+row).val();
                            
                            $.ajax({
                            type : "POST",
                            
                            url: base_url + "admin/onlineexam/viewsubjectpdf_printer",
                            
                            data: {studid:studid,group:group,exambatchid:exambatchid},       
                            datatype : 'JSON',      
                            
                            success:function(data)
                            {                             
                            var ht = $(window).height();
                            var wt = $(window).width();                           
                            
                            var divContents = $("#print_content").html();
                            var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
                            printWindow.document.write('<html><head><title><?php  echo $this->customlib->getAppName(); ?>  </title>');
                            printWindow.document.write('<link href="<?=base_url()?>web_assets/css/bootstrap.css" rel="stylesheet" media="screen">  <link href="<?=base_url()?>web_assets/css/custom.css" rel="stylesheet" media="screen">');
                            printWindow.document.write('</head><body>');
                            printWindow.document.write(data);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();
                            printWindow.print(); 
                            
                            },
                            
                            });
                            }
                            
                            
                            
                            
                            
                            </script>
                            </td>
                            
                            
                            
                            </tr>
                            
                            
                            
                            
                            
                            <tr>
                            <td>&nbsp;</td>
                            
                            </tr>
                            <?php
                            $sl++;
                            }
                            ?>
                            
                            
                            
                            
                            
                            
                            </tbody>
                            </table>
                            
                            <table>
                            
                            
                            
                            </table>
                            
                            <div id="print_content" style="visibility:hidden;">
                            
                            
                            
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
                            
                            body 
                            { 
                          
                            
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
                            <div class="container">
                            
                            <div class="row">
                            
                            
                            
                            <div id="" style="width:100%; height:auto;" >
                            <table>
                            <tr>
                            <td><img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%">
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
                            
                            
                            
                            
                            
                            
                            <b>Application Form for <?php echo $subjects_row['examname'];?> <br> 
                            (Faculty of Islamic & Contemporary Studies)
                            <br>
                            </b></span></td>
                            
                            </tr>
                            </table>
                            
                            
                            <table  float="left">
                            
                            
                            <tr>
                            
                            <td class="first_td">1.&nbsp;&nbsp;Institution Id </td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php echo $studid['admission_no']; ?></td>
                            
                            </tr>
                            
                            <tr>
                            <td class="first_td">2.&nbsp;&nbsp;Name of the applicant (in block letters) </td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php echo $studid['firstname']; ?></td>
                            </tr>
                            
                            
                            <tr>
                            <td class="first_td">3.&nbsp;&nbsp;Register No </td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php echo $studid['roll_no']; ?></td>
                            </tr>
                            
                            
                            
                            
                            <tr>
                            <td class="first_td">4.&nbsp;&nbsp;Age & date of birth</td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php echo $studid['dob']; ?></td>
                            </tr>
                            <tr>
                            <td class="first_td">5.&nbsp;&nbsp;Name of the guardian</td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php echo $studid['guardian_name']; ?></td>
                            </tr>
                            
                            
                            
                            <tr>
                            <td class="first_td">6.&nbsp;&nbsp;Address of communication </td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php echo $studid['current_address']; ?></td>
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
                            <tr> 
                            
                            <td colspan="7">
                            
                            <?php
                            
                            if($studid['image']=="")
                            {
                            ?>
                            <img src="<?php echo base_url();?>/backend/default_format/copy_photo.png" style="width:150px; height:200px;" >
                            
                            <?php
                            }
                            else
                            {
                            ?> 
                            
                            <img src="<?php echo base_url();?>/<?php echo $studid['image']; ?>"  style="width:150px; height:200px;">
                            
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
                            
                            
                            
                            
                            foreach($subjects as $sub)
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
                            
                            <!-- <td class="th_tablesubject" 
                            <?php if (preg_match('/[اأإء-ي]/ui' ,   "اردو"    )  )  {
                            echo 'style="direction: rtl;"';
                            } ?>> اردو 
                            </td>-->
                            
                            
                            
                            <td class="th_tablesubject"><?php echo $sub['subject']; ?></td>
                            
                            
                            
                            <td class="th_tablesubject"></td>
                            </tr>
                            
                            
                            <?php 
                            $sl++;
                            } 
                            ?>   
                            
                            
                            </table>
                            </div>
                            
                            <div style="width: 70%; display: table;">
                            
                            
                            
                            
                            <table width="100%">     
                            
                            <tr>
                            
                            <td class="first_td">8.&nbsp;&nbsp;Number of working days </td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php  echo $getstudent_workingdays; ?></td>
                            </tr>
                            
                            <tr>
                            <td class="first_td">9.&nbsp;&nbsp;Number of attending days</td>
                            <td class="second_td">:</td>
                            <td class="third_td"><?php  
                            
                            $totalhalf=$getstudent_halfdays/2;
                            
                            
                            
                            echo $totalpresent=$getstudent_presentdays+$totalhalf; ?></td>
                            </tr>
                            <tr>
                            <td class="first_td">10.&nbsp;&nbsp;Percentage of attendance</td>
                            
                            <?php
                            $count1=$totalpresent/$getstudent_workingdays;
                            $count2=$count1*100;
                            ?>
                            
                            
                            
                            
                            
                            <td class="second_td">:</td>
                            <td class="third_td"><?php  echo number_format((float)$count2, 2, '.', ''); ?>%</td>       
                            
                            </tr>
                            
                            </table>
                            </div>
                            
                            <br>
                            
                            
                            
                            <div class="footer" style="width:100%; ">
                            
                            <div class="declaration" style="text-align:center; "><span style="font-weight:bold;font-size:16px;"><b style="font-weight:bold">Attendance Declaration </b></span>(to be filled by class teacher)</div>
                            <br>
                            
                            <div class="declaration_text" style="text-align: left; margin-left:5px;">It Is stated here that …………………………….……..s/o……………………………….of…………..std, has attended <br>the
                            class ………………working days and he is eligible /conditionally eligible for writing the examination by<br>
                            securing 90% of attendance during the academic year 2022 <?php echo '-'; ?> &nbsp;23  </div>
                            </div>
                            
                            
                            
                            
                            
                            <div style="width: 100%; display: table;">
                            
                            <table  style="width:100% !important;">
                            <tr>
                            
                            <td class="" style="width:30% !important;">Name of Class Teacher :</td>
                            
                            <td class="" style="width:40%">: </td>
                            
                            <td class="" style="width:30% !important;">Date :</td>
                            
                            
                            
                            </tr>
                            
                            <tr>
                            
                            
                            
                            <td class="" style="width:30% !important;">Signature :</td>
                            
                            <td class="" style="width:40%">: </td>
                            
                            <td class="" style="width:30% !important;">Place :</td>
                            
                            
                            </tr>
                            
                            
                            
                            <tr>
                            
                            
                            
                            <td class="" style="width:30% !important;">Signature of Vice Principal  :</td>
                            
                            <td class="" style="width:40%">: </td>
                            
                            <td class="" style="width:30% !important;">&nbsp;</td>
                            
                            
                            </tr>
                            
                            </table>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="footer" style="width:100%; ">
                            
                            <div class="declaration" style="text-align:left; ">
                            </div>
                            
                            <hr class="line"></hr>
                            <br>
                            
                            <div class="declaration_text" style="">I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibility for
                            the correctness of mentioned particular. </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div style="width: 100%; display: table;">
                            
                            <table  style="width:100% !important;">
                            
                            
                            <tr>
                            
                            <td class="" style="width:30%">Name of Student</td>
                            
                            <td class="" style="width:40%">: </td>
                            
                            <td class="" style="width:30%">Date :</td>
                            
                            </tr>
                            
                            <tr>
                            <td class="" style="width:30%">Signature </td>
                            
                            <td class="" style="width:40%">: </td>
                            
                            <td class="" style="width:30%">Place :</td>
                            </tr>
                            
                            </table>
                            </div>
                            <br>
                            <br>
                            
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                            
