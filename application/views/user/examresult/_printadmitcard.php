        <style type="text/css">
        @media print {
        .pagebreak 
        { 
        page-break-before: always !important;
        }    
        }
        
        
        @media print {
        .rempage
        {
        page-break-after: avoid;
        page-break-before: avoid;
        }
        }

    
    
    
    
    *{padding: 0; margin:0;}
    /*body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}*/
    .tableone{}
    .tableone td{padding:5px 10px}
    table.denifittable  {border: 1px solid #999;border-collapse: collapse; color: #000;}
    .denifittable th {color: #000;padding: 10px 10px; font-weight: normal;  border-collapse: collapse;border-right: 1px solid #999; border-bottom: 1px solid #999;}
    .denifittable td {padding: 10px 10px; font-weight: normal;border-collapse: collapse;border-left: 1px solid #999;border: 1px solid #999;}
    
    .mark-container
    {
    width: 1000px;position: relative;z-index: 2; margin: 0 auto; padding: 20px 30px;}
    
    .tcmybg {
    background:top center;
    background-size: 100% 100%;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    z-index: 1;
    }
    .tablemain{position: relative;z-index: 2}
    
    
    .first_td
    {
    width: 100%;
    
    height: 10px;
    padding-bottom: 20px;
    
    
    
    }
    
    
    .first_tdd
    {
    width: 70%;
    
    height: 10px;
    padding-bottom: 10px;
    
    
    
    }
    
    .first_headertdd
    {
    width: 30%;
    
    height: 10px;
    padding-bottom: 10px;
    
    
    
    }
    
    .sec_col
    {
    font-weight: bold;
    }
    
    
    .fontstyle
    {
    
    font-size: 20px;
    }
    
    
    
    </style>
    <?php
    
    
    if (!empty($student_details)) 
    {
    foreach ($student_details as $student_key => $student_value)
    {    
    
    
    
    ?>
    
    <div class="mark-container">
    <?php
    
    if ($admitcard->background_img != "") {
    ?>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->background_img); ?>" class="tcmybg" width="100%" height="100%" />
    <?php
    }
    ?>
    <table cellpadding="0" cellspacing="0" width="100%" class="tablemain">
    <?php
    //if ($admitcard->title != "" || $admitcard->heading != "" || $admitcard->left_logo != "") 
    //{
    ?>
    <tr>
    <td valign="top">
    <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
    <td valign="top" align="center" width="100">
    <?php
    if ($admitcard->left_logo != "")
    {
    ?>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->left_logo); ?>" width="100" height="100">
    <?php
    }
    ?>
    </td>
    
    <td valign="top">
    <table cellpadding="0" cellspacing="0" width="100%">
    <?php
    if ($admitcard->heading != "") 
    {
    ?>
    <tr>
        <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;"><?php echo $admitcard->heading; ?></td>
    </tr>
    <?php
    }
    else
    {
    
    
    //if ($admitcard->middle_logo != "")
    //{
    ?>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->middle_logo); ?>"     width="100%" height="200px;" 
    />
    <?php
    //}
    
    
    
    }
    
    
    ?>
    
    
    
    <tr><td valign="top" height="5"></td></tr>
    <?php
    if ($admitcard->title != "") 
    {
    ?>
    <tr>
    <td valign="top" style="font-size: 26px;text-align: center; text-transform: uppercase; font-weight:bold; ">
    <?php echo $admitcard->title; ?></td>
    </tr>
    <?php
    }
    
    
    ?>
    
    <tr>
    <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;">
    <?php echo $exam_subjects_row->examname; ?></td>
    </tr>
    
    
    </table>
    </td>
    <td width="100" valign="top" align="center">
    <?php
    if ($admitcard->right_logo != "") {
    ?>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->right_logo); ?>" width="100" height="100">
    
    <?php
    }
    ?>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <?php
    //}
    ?>
    <?php
    if ($admitcard->exam_name) {
    ?>
    <tr>
    <td valign="top" style="text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;"><?php echo $admitcard->exam_name; ?></td>
    </tr>
    <?php
    }
    ?>
    <tr><td valign="top" height="10"></td></tr>
    <tr>
    <td valign="top">
    
    
    <div id="" style="width:100%;">
    
    <div id="" style="width:75%; float:left;">
    
    <table cellpadding="0" cellspacing="0" class="denifittable" width="100%" style="text-transform: uppercase;float:left;">
    
    <tr style="border: 1px solid #999;border-collapse: collapse;" >
    <?php
    if ($admitcard->is_roll_no) {
    ?>
    <td width="30%"><?php echo $this->lang->line('roll_no') ?></td>
    <td width="70%"  style="font-weight:bold;">
    <?php 
    //echo ($exam->use_exam_roll_no)?$student_value->roll_no:$student_value->profile_roll_no; ?>
    
    <?php echo $student_value->profile_roll_no; ?>
    
    </td>
    <?php
    }
    ?>
    </tr>
    
    
    <?php
    
    if ($admitcard->is_name) 
    {
    ?>
    <tr style="min-height:200px;">
    <td width="30%"><?php echo $this->lang->line('candidates') . " " . $this->lang->line('name') ?></td>
    <td width="70%"  style="font-weight:bold;"><?php echo $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $sch_setting->middlename, $sch_setting->lastname); ?></td>
    
    
    </tr>
    <?php } ?>
    
    
    
    
    <tr style="border: 1px solid #999;border-collapse: collapse;">
    <?php
    if ($admitcard->is_admission_no) {
    ?>
    <td width="30%"><?php echo $this->lang->line('admission_no') ?></td>
    <td width="70%" class="sec_col" style="font-weight:bold;"><?php echo $student_value->admission_no; ?></td>
    <?php
    }
    ?>
    
    
    
    </tr>
    <tr>
    <?php
    if ($admitcard->is_class || $admitcard->is_section) 
    {
    ?>
    
    <td width="30%"> <?php echo $this->lang->line('class'); ?></td>
    
    <td width="70%" style="font-weight:bold;"  >
    
    <?php
    if ($admitcard->is_class && $admitcard->is_section) 
    {
    
    echo $student_value->class . " (" . $student_value->section . ")";
    } elseif ($admitcard->is_class) {
    echo $student_value->class;
    } elseif ($admitcard->is_section) {
    echo $student_value->section;
    }
    ?>
    </td>
    
    <?php
    }
    ?>
    </tr>
    </table>
    
    
    
    <table cellpadding="0" cellspacing="0" width="100%"   style="text-transform: uppercase;float:left; color:#000;"> 
    
    <tr class="first_td"><td>&nbsp;</td></tr>
    
    <tr class="first_td">
    <?php
    if ($admitcard->is_dob) {
    ?>
    <td valign="top" class="first_headertdd" ><?php echo $this->lang->line('d_o_b'); ?></td>
    <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;"><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($student_value->dob)); ?></td>
    <?php
    }
    ?>
    
    <?php
    if ($admitcard->is_gender) {
    ?>
    <td valign="top" class="first_headertdd"  ><?php echo $this->lang->line('gender'); ?></td>
    <td valign="top" class="first_tdd" ><?php echo $student_value->gender; ?></td>
    <?php
    }
    ?>
    
    </tr>
    <tr class="first_td">
    <?php
    if ($admitcard->is_father_name) {
    ?>
    <td valign="top" class="first_headertdd"  ><?php echo $this->lang->line('fathers') . " " . $this->lang->line('name') ?></td>
    <td valign="top"  class="first_tdd"style="text-transform: uppercase; font-weight: bold;" ><?php echo $student_value->father_name; ?></td>
    <?php
    }
    ?>
    <?php
    if ($admitcard->is_mother_name) {
    ?>
    <td valign="top" class="first_headertdd" ><?php echo $this->lang->line('mothers') . " " . $this->lang->line('name'); ?></td>
    <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;"><?php echo $student_value->mother_name; ?></td>
    <?php
    }
    ?>
    
    </tr>
    <?php
    if ($admitcard->is_address) {
    ?>
    <tr class="first_td">
    <td valign="top" class="first_headertdd"  ><?php echo $this->lang->line('address'); ?></td>
    <td  valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;"><?php echo $student_value->current_address; ?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if ($admitcard->school_name != "") {
    ?>
    <tr class="first_td">
    <td valign="top" class="first_headertdd"    ><?php echo $this->lang->line('school_name') ?></td>
    <td valign="top" class="first_tdd"  style="text-transform: uppercase; font-weight: bold;"><?php echo $admitcard->school_name; ?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    if ($admitcard->exam_center != "") {
    ?>
    <tr class="first_td">
    <td valign="top" class="first_headertdd"   ><?php echo $this->lang->line('exam') . " " . $this->lang->line('center'); ?></td>
    <td valign="top"  class="first_tdd" style="text-transform: uppercase; font-weight: bold;"><?php echo $admitcard->exam_center; ?></td>
    </tr>
    <?php
    }
    ?>
    <tr class="first_td"><td>&nbsp;</td></tr>
    </table>
    </div>
    
    
    
    
    <div id="" style="width:24%;float:left;margin-left:2px;">
    <table cellpadding="0" cellspacing="0" width="100%"   style="text-transform: uppercase;">
    <?php
    if ($admitcard->is_photo) {
    ?>
    <tr>
    <td width="13%">&nbsp;</td> 
    <td valign="top" width="88%" >
    <?php
    if ($student_value->image != '') {
    ?>
    <img src="<?php echo base_url() . $student_value->image; ?>" width="200" height="260" style="border: 2px solid #fff;
    outline: 1px solid #000000; text-align:right;">
    <?php }?>
    
    </td>
    </tr>
    <?php
    }
    ?>
    
    </table>
    </div>
    </div>
    
    <table>
    <tr><td>&nbsp;</td></tr>
    </table>
    
    <tr>
    <td valign="top">
    <div id="" style="min-height:400px; height:auto;" >
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" >
    <tr>
    <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('exam_date_time'); ?></th>
    <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('paper_code') ?></th>
    <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('subject'); ?></th>
    <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('obted_by_student') ?></th>
    <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('sign_of_invigilator') ?></th>
    </tr>
    <?php
    if($ExamName_ExamTypeStatus['exam_Type_Status']=="2")
    {
    
    $this->db->select('*,subjects.code as subject_code,subjects.name as subject_name,subjects.type as subject_type,exam_group_class_batch_exam_subjects.time_from,exam_group_class_batch_exam_subjects.duration');
    $this->db->from('online_examination');
    $this->db->join('subjects', 'subjects.id = online_examination.online_examination_subject');
    $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.subject_id = online_examination.online_examination_subject AND exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = online_examination.online_examination_exam');    
    $this->db->where('online_examination.online_examination_exam', $post_exam_id);
    $this->db->where('online_examination.online_examination_examgroup', $post_exam_group_id);
    $this->db->where('online_examination.online_examination_student_id', $studid);
    $query   = $this->db->get();
    $getExamSubjects_SayExam= $query->result();
    
    foreach ($getExamSubjects_SayExam as $subject_key => $subject_value) 
    {
    
    $date=$subject_value->time_from ;
    $duration=$subject_value->duration;
    
    $time = date("H:i:s", strtotime($date));
    $time2 = date("H:i:s", strtotime($duration));
    
    
    
    $secs = strtotime($time2)-strtotime("00:00:00");
    $durationresult = date("H:i:s",strtotime($time)+$secs);
    ?>
    <tr>
    <!--<td valign="top" style="text-align: center;"><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($subject_value->date_from)) . " " . $subject_value->time_from ."--". $durationresult; ?></td>-->
    
    
    
    
    <td>
    <?php
    
    $timefrom   = $date;
    $from       = date("g:i a", strtotime($timefrom));
    
    $timeto     = $durationresult;
    $to         = date("g:i a", strtotime($timeto));
    
    echo date($this->customlib->getSchoolDateFormat(), strtotime($subject_value->date_from)) . " " . $from ."--". $to;
    
    ?>  
    </td>
    
    <td style="text-align: left;text-transform: uppercase;" class="tdstyle"><?php echo $subject_value->subject_code; ?></td>
    <td style="text-align: left;text-transform: uppercase;" class="tdstyle"><?php echo $subject_value->subject_name; ?></td>
    <td style="text-align: left;text-transform: uppercase;" class="tdstyle"><?php echo $subject_value->subject_type; ?></td>
    <td class="tdstyle;" style="text-align: left;text-transform: uppercase;">&nbsp;</td>
    </tr>
    <?php
    }
    
    }
    
    else
    {
    foreach ($exam_subjects as $subject_key => $subject_value) 
    {
    
    $date=$subject_value->time_from ;
    $duration=$subject_value->duration;
    
    $time = date("H:i:s", strtotime($date));
    $time2 = date("H:i:s", strtotime($duration));
    
    
    
    $secs = strtotime($time2)-strtotime("00:00:00");
    $durationresult = date("H:i:s",strtotime($time)+$secs);
    ?>
    <tr>
    <!--<td valign="top" style="text-align: center;"><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($subject_value->date_from)) . " " . $subject_value->time_from ."--". $durationresult; ?></td>-->
        
    <td>
    <?php    
    $timefrom   = $date;
    $from       = date("g:i a", strtotime($timefrom));
    
    $timeto     = $durationresult;
    $to         = date("g:i a", strtotime($timeto));
    
    echo date($this->customlib->getSchoolDateFormat(), strtotime($subject_value->date_from)) . " " . $from ."--". $to;
    
    ?>  
    </td>
    
    <td style="text-align: left;text-transform: uppercase;" class="tdstyle"><?php echo $subject_value->subject_code; ?></td>
    <td style="text-align: left;text-transform: uppercase;" class="tdstyle"><?php echo $subject_value->subject_name; ?></td>
    <td style="text-align: left;text-transform: uppercase;" class="tdstyle"><?php echo $subject_value->subject_type; ?></td>
    <td class="tdstyle;" style="text-align: left;text-transform: uppercase;">&nbsp;</td>
    </tr>
    <?php
    } }
    ?>
    </table>
    </div>
    
    
    
    </td>
    </tr>
    <tr><td valign="top" height="5"></td></tr>
    <?php
    if ($admitcard->content_footer != "") {
    ?>
    <tr>
    <td valign="top" style="padding-bottom: 15px; line-height: normal; "> <?php //echo htmlspecialchars_decode($admitcard->content_footer); ?></td>
    </tr>
    <?php
    }
    ?>    
    </div>
    
    
    <tr><td valign="top" height="20px"></td></tr>
    <?php
    if ($admitcard->sign != "") {
    ?>
    <tr>
    <td align="right" valign="top">
    <table cellpadding="0" cellspacing="0" width="100%" style="text-align: center;">
    <tr>
    <td valign="top">
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign); ?>" width="100" height="38"  />
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <?php
    }
    ?>
    <br> 
    </table>
    </div>    
    
    
    <div class="mark-container">
    <table cellpadding="0" cellspacing="0" width="100%" >
    <tr>
    
    <td style="width:60%">
    <?php
    if ($admitcard->is_qrcode != "") 
    { 
    ?>
    <img src="<?php echo base_url() . $student_value->exam_qrcode; ?>" width="260" height="260" style="border: 2px solid #fff;"/>
    <?php
    } 
    ?>
    </td>
    
    
    <td style="width:40%" valign="top" class="fontstyle">
    <?php
    if ($admitcard->sign != "")
    { 
    ?>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign); ?>" width="100" height="38"  />
    <br><?php
    }
    ?>
    <b>Signature of the Candidate...................<br>
    (To be signed in the Presence of Identifying Officer)</b>
    
    
    
     
    <br> 
     <!-- <i class="fa fa-map-marker"></i> -->                                       
    <?php
    
    /*
    $addr = $sch_setting->address;
    $add=explode(',',$addr);
    foreach($add as $ad)
    {
    echo $ad;
    echo "<br>";
    }
    echo "<br>";
    */
    ?>
    
    
    
    <?php
    if ($admitcard->sign_two != "") 
    {
    ?>
    <br>
    <br>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign_two); ?>" width="200" height="76"  />
    <br>
    
    <b>Controller of  Examinations</b>
    <br>
    <?php
    echo $sch_setting->name;
    }
    ?>
    </td>
    
    
    
    
    <!-- <td valign="top" style="width:60%;" class="fontstyle">
    <?php
    if ($admitcard->sign != "")
    { 
    ?>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign); ?>" width="100" height="38"  />
    <br><?php
    }
    ?>
    
    
    <b>Signature of the Candidate...................<br>
    (To be signed in the Presence of Identifying Officer)</b>
    
    
    
    <br> 
    <br> 
    <br> 
    <i class="fa fa-map-marker"></i>                                          
    <?php
    $addr = $sch_setting->address;
    $add=explode(',',$addr);
    foreach($add as $ad)
    {
    echo $ad;
    echo "<br>";
    }
    echo "<br>";
    
    ?>
    
    </td>
    
    
    <td style="width:50%; text-align: right;" class="fontstyle">
    
    <?php
    if ($admitcard->sign_two != "") {
    ?>
    <br>
    <br>
    <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign_two); ?>" width="200" height="76"  />
    
    
    <br>
    
    <b>Controller of  Examinations</b>
    <br>
    
    
    <?php
    echo $sch_setting->name;
    
    }
    ?>
    </td>-->
    
    
    </tr>
    </table>
    
    
    
    
    <table style="width:100%;"> 
    <tr>
    <td colspan="2" style="text-align:center; padding-top: 20px;"><h4>
    
    <?php
    if ($admitcard->content_warning != "")
    {                         
    echo $admitcard->content_warning;
    } 
    ?>
    </h4></td>
    </tr>
    </table>
    
    
    <div class="pagebreak"> </div>
    
    
    <div id="" style="padding-top:50px !important;">
    
    <p>
    <?php
    if ($admitcard->content_instruction != "")
    {
    echo $admitcard->content_instruction; 
    }
    ?>
    </p>
    </div>
    <div class="rempage"> </div>
    </div>
    
    <?php
    }
    }
    ?>