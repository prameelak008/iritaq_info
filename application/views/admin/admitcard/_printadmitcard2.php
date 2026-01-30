<style type="text/css">
    @media print {
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }

    *{padding: 0; margin:0;}
    /*body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}*/
    .tableone{}
    .tableone td{padding:5px 10px}
    table.denifittable  {border: 1px solid #999;border-collapse: collapse;}
    .denifittable th {padding: 10px 10px; font-weight: normal;  border-collapse: collapse;border-right: 1px solid #999; border-bottom: 1px solid #999;}
    .denifittable td {padding: 10px 10px; font-weight: bold;border-collapse: collapse;border-left: 1px solid #999;}

    .mark-container{
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

</style>
<?php
if (!empty($student_details)) {
    foreach ($student_details as $student_key => $student_value) {
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
if ($admitcard->title != "" || $admitcard->heading != "" || $admitcard->left_logo != "") {
            ?>
                    <tr>
                        <td valign="top">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td valign="top" align="center" width="100">
                                        <?php
if ($admitcard->left_logo != "") {
                ?>
                                            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->left_logo); ?>" width="100" height="100">
                                            <?php
}
            ?>
                                    </td>
                                    <td valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <?php
if ($admitcard->heading != "") {
                ?>
                                                <tr>
                                                    <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;"><?php echo $admitcard->heading; ?></td>
                                                </tr>
                                                <?php
}
            ?>

                                            <tr><td valign="top" height="5"></td></tr>
                                            <?php
if ($admitcard->title != "") {
                ?>
                                                <tr>
                                                    <td valign="top" style="font-size: 20px;text-align: center; text-transform: uppercase; text-decoration: underline;">
                                                        <?php echo $admitcard->title; ?></td>
                                                </tr>
                                                <?php
}
            ?>

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
}
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
                        <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;">
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" >
                                        <tr>
                                            <?php
if ($admitcard->is_roll_no) {
            ?>
                                                <td valign="top" width="25%" style="padding-bottom: 10px;"><?php echo $this->lang->line('roll_no') ?></td>
                                                <td valign="top" width="30%" style="font-weight: bold;padding-bottom: 10px;">
                                                     <?php 
                                                      echo ($exam->use_exam_roll_no)?$student_value->roll_no:$student_value->profile_roll_no; ?>

                                                </td>
                                                <?php
}
        ?>
                                            <?php
if ($admitcard->is_admission_no) {
            ?>
                                                <td valign="top" width="20%" style="padding-bottom: 10px;"><?php echo $this->lang->line('admission_no') ?></td>
                                                <td valign="top" width="25%" style="font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->admission_no; ?></td>
                                                <?php
}
        ?>


                                        </tr>
                                        <?php
if ($admitcard->is_name) {
            ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('candidates') . " " . $this->lang->line('name') ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $sch_setting->middlename, $sch_setting->lastname); ?></td>
                                                <?php
if ($admitcard->is_class || $admitcard->is_section) {
                ?>

                                                    <td valign="top" style="padding-bottom: 10px;"> <?php echo $this->lang->line('class'); ?></td>
                                                    <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">

                                                        <?php
if ($admitcard->is_class && $admitcard->is_section) {

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
                                            <?php
}
        ?>


                                        <tr>
                                            <?php
if ($admitcard->is_dob) {
            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('d_o_b'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($student_value->dob)); ?></td>
                                                <?php
}
        ?>

                                            <?php
if ($admitcard->is_gender) {
            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('gender'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->gender; ?></td>
                                                <?php
}
        ?>

                                        </tr>
                                        <tr>
                                            <?php
if ($admitcard->is_father_name) {
            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('fathers') . " " . $this->lang->line('name') ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->father_name; ?></td>
                                                <?php
}
        ?>
                                            <?php
if ($admitcard->is_mother_name) {
            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('mothers') . " " . $this->lang->line('name'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->mother_name; ?></td>
                                                <?php
}
        ?>

                                        </tr>
                                        <?php
if ($admitcard->is_address) {
            ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('address'); ?></td>
                                                <td colspan="3" valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->current_address; ?></td>
                                            </tr>
                                            <?php
}
        ?>
                                        <?php
if ($admitcard->school_name != "") {
            ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('school_name') ?></td>
                                                <td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $admitcard->school_name; ?></td>
                                            </tr>
                                            <?php
}
        ?>
                                        <?php
if ($admitcard->exam_center != "") {
            ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('exam') . " " . $this->lang->line('center'); ?></td>
                                                <td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $admitcard->exam_center; ?></td>
                                            </tr>
                                            <?php
}
        ?>
                                    </table>
                                </td>
                                <?php
if ($admitcard->is_photo) {
            ?>
                                    <td valign="top" width="25%" align="right">
                                        <?php
if ($student_value->image != '') {
                ?>
                                            <img src="<?php echo base_url() . $student_value->image; ?>" width="100" height="130" style="border: 2px solid #fff;
                                                 outline: 1px solid #000000;">
                                             <?php }?>

                                    </td>
                                    <?php
}
        ?>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td valign="top" height="10"></td></tr>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
                            <tr>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('theory_exam_date_time'); ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('paper_code') ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('subject'); ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('obted_by_student') ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('sign_of_invigilator') ?></th>
                            </tr>
                            <?php
foreach ($exam_subjects as $subject_key => $subject_value)
{
    
    
$date           =  $subject_value->time_from ;
$duration       =  $subject_value->duration;
$time           =  date("H:i:s", strtotime($date));
$time2          =  date("H:i:s",strtotime($duration));
$secs           =  strtotime($time2)-strtotime("00:00:00");
$durationresult =  date("H:i:s",strtotime($time)+$secs);

?>
                                <tr>
<td valign="top" style="text-align: center;">
<?php echo date($this->customlib->getSchoolDateFormat(), strtotime($subject_value->date_from)) . " " . $subject_value->time_from."--". $durationresult;  ?></td>
                                    <td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_code; ?></td>
                                    <td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_name; ?></td>
                                    <td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_type; ?></td>
                                    <td></td>
                                </tr>
                                <?php
}
        ?>
                        </table>
                    </td>
                </tr>
                <tr><td valign="top" height="5"></td></tr>
                <?php
if ($admitcard->content_footer != "") {
            ?>
                    <tr>
                        <td valign="top" style="padding-bottom: 15px; line-height: normal;"> <?php echo htmlspecialchars_decode($admitcard->content_footer); ?></td>
                    </tr>
                    <?php
}
        ?>
                <tr><td valign="top" height="20px"></td></tr>
                
                    <tr>
                        <td align="right" valign="top">
                            <table cellpadding="0" cellspacing="0" width="100%" >
                                <tr >
                                    <td valign="top" style="width:50%;">
                                        <?php
                                        if ($admitcard->sign != "") {
                                        ?><br>
                                        <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign); ?>" width="100" height="38"  />
                                        
                                        <?php
                                        }
                                        ?>
                                        <b></b>Signature of the Candidate...................<br>
                                        (To be signed in the Presence of Identifying Officer)</b>

                                        

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


                                        <td style="width:50%; text-align: right;">
 
                                        <?php
                                        if ($admitcard->sign_two != "") {
                                        ?>
                                        <br>
                                        <br>
                                        <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign_two); ?>" width="100" height="38"  />

                                        
                                        <br>

                                        <b>Controller Of Examinations</b>
                                        <br>
                                       

                                        <?php
                                        echo $sch_setting->name;
                                      
                                        }
                                        ?>
                                        </td>


                                </tr>
                               
                                
                       
                       <tr><td colspan="2" style="text-align:center; padding-top: 20px;"><h4>
                           
                            <?php
                        if ($admitcard->content_warning != "")
                         {                         
                        echo $admitcard->content_warning;
                        } 
                        ?>
                           
                           <!--***COMMUNICATION DEVICES ARE STRICTLY PROHIBITED INSIDE EXAMINATION HALL ***-->
                           
                           
                           </h4></td></tr>




            </table>


   <div class="pagebreak"> </div>

<!--<table style="top:20px;" >

            <tr>

                                   <td style="width:47%">INSTRUCTIONS TO THE CANDIDATES WRITING UNIVERSITY EXAMINATION
                                    <br>
 

1. Students appearing tor university examination are called candidates.<br>
2.  Candidates should bring hall tickets on all days of examination<br>
3.  Thay should reach the examination centre sufflclantly earty before the commencement of examination and should find the room allotted for them from the notice board.<br>
4.  After the atroke of the 11rat bell candidate& should enter the class room In the presence of lnvlgllator wtth their hall ticket, pan, pancll,n.ibber, scale etc. and occupy their reapectlve seats.<br>
5.  Strict sllance should be maintained In the examination hall.<br>
8. Whan answer book & question papers are Issued, candidates should stand up from their seat and then receive them.<br>
7.  On receiving the main answer sheet, candidates should flll neceaary data on the front page uper the Instruction of the lnvlgllator and read the lnstn.ictlona on second page.<br>
a.  On receiving the question paper, ascertain whether ha question paper belongs to them If so candidate should write hlslhar nam"9 register number tharaon. Nothing else should be written on the question paper.<br>
9.  No candidates will be allowed to leave the hall until after the expiry of 30 minutee after the commencement of the examination.<br>
10. candldatea are forbidden to ask question ot any kind either to the
lnvlgllators or to the fallow candidates when the examinations are going on. Borrowing of mathamatlcal Instruments, pancll,rubber ate. from neighbors should be avoided.<br>
</td>
<td  style="width:6%"></td>
                                   
                                   <td  style="width:47%">
                                       
                                       11.  Any kind of malpractlce In the examination hall wlll ba daaH with the rules. Matter will be reported to the university(copying from Manuscript, book, nelghbourapaper, bringing any materlal except authorized onea)<br>
12. Disobedience ot the lnatructlons ot the Chief Supdt/Addl Chief Supdt or
lnvlgllators or floutlng their authority In any other manner /non observance of any of these Instructions ,communicating with parson outside or Inside the examination room or Intimidation assault ,uaa of abusive language or any kind of misbehavior towards supdL1nvlgllators or authority connected with examination with in the premises or outside the examination centre will also from part of malpractlce.<br>
13. Moblle phones are not allowed In the examination hall.<br>
14. Any other act vlolatlva of the Integrity and proper conduct of examination wlll also be a kind of malpractlce.<br>
15. lmmadlataly aflar the examination are over candidate should hand over all answer shaal: to the lnvlgllator.<br>
16. candidate should leave the premises as soon as their exams are over and should not fonn crowds near the examination hall and varanda.<br>
17. Examinations ot Core •Complementary courses under B.ComlBBA
Programme should be written In Engllsh language only.<br>

                                   </td> 

                                </tr>
                            </table>-->
                            
                            <p>
    <?php
      if ($admitcard->content_instruction != "")
       {

         echo $admitcard->content_instruction; 
       }

       ?> 



   </p>
        </div>
        <div class="pagebreak"> </div>
        <?php
}
}
?>