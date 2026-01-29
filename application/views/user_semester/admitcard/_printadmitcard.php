            <style type="text/css">
            @media print {
            .pagebreak { page-break-before: always; }
            }

            *{padding: 0; margin:0;}
            .tableone{}
            .tableone td{padding:5px 10px}
            table.denifittable  {border: 1px solid #999;border-collapse: collapse; color: #000;}
            .denifittable th {color: #000;padding: 10px 10px; font-weight: normal;  border-collapse: collapse;border-right: 1px solid #999; border-bottom: 1px solid #999;}
            .denifittable td {padding: 10px 10px; font-weight: normal;border-collapse: collapse;border-left: 1px solid #999;border: 1px solid #999;}

            .mark-container{
            width: 1000px;position: relative;z-index: 2; margin: 0 auto; padding: 20px 30px;
            }

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

            .first_td {
            width: 100%;
            height: 10px;
            padding-bottom: 20px;
            }

            .first_tdd {
            width: 70%;
            height: 10px;
            padding-bottom: 10px;
            }

            .first_headertdd {
            width: 30%;
            height: 10px;
            padding-bottom: 10px;
            }

            .sec_col {
            font-weight: bold;
            }

            .fontstyle {
            font-size: 20px;
            }
            </style>

            <?php

            $admitcard = $admit_cards[0];

            if (!empty($student_details)) {
            // Loop through the outer array
            foreach ($student_details as $student_group) {
            // Get the first student from each group (since your array has nested structure)
            $student_value = reset($student_group);
            ?>

            <div class="mark-container">
            <?php if ($admitcard->background_img != "") { ?>
            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->background_img); ?>" class="tcmybg" width="100%" height="100%" />
            <?php } ?>

            <table cellpadding="0" cellspacing="0" width="100%" class="tablemain">
            <tr>
            <td valign="top">
            <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td valign="top" text-align="center" width="100">
            <?php if ($admitcard->left_logo != "") { ?>
            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->left_logo); ?>" width="100" height="100">
            <?php } ?>
            </td>

            <td valign="top">
            <table cellpadding="0" cellspacing="0" width="100%">
            <?php if ($admitcard->heading != "") { ?>
            <tr>
                <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;">
                    <?php echo $admitcard->heading; ?>
                </td>
            </tr>
            <?php } else { ?>
            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->middle_logo); ?>" width="100%" height="200px;" />
            <?php } ?>

            <tr>


            <td valign="top" height="5"></td></tr>

            <?php if ($admitcard->title != "") { ?>
            <tr>
                <td valign="top" style="font-size: 26px;text-align: center; text-transform: uppercase; font-weight:bold;">
                    <?php echo $admitcard->title; ?>
                </td>
            </tr>
            <?php } ?>

            <tr>
            <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;">
            <?php echo $exam_details['name']; ?></td>
            </tr>

            <tr>
            <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;">
            <?php echo $exam_details['exam']; ?></td>
            </tr>


            </table>
            </td>

            <td width="100" valign="top" text-align="center">
            <?php if ($admitcard->right_logo != "") { ?>
            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->right_logo); ?>" width="100" height="100">
            <?php } ?>
            </td>
            </tr>
            </table>
            </td>
            </tr>

            <?php if ($admitcard->exam_name) { ?>
            <tr>
            <td valign="top" style="text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;">
            <?php echo $admitcard->exam_name; ?>
            </td>
            </tr>
            <?php } ?>

            <tr><td valign="top" height="10"></td></tr>

            <tr>
            <td valign="top">
            <div id="" style="width:100%;">
            <div id="" style="width:75%; float:left;">
            <table cellpadding="0" cellspacing="0" class="denifittable" width="100%" style="text-transform: uppercase;float:left;">
            <?php if ($admitcard->is_roll_no) { ?>
            <tr style="border: 1px solid #999;border-collapse: collapse;">
            <td width="30%"><?php echo $this->lang->line('roll_no') ?></td>
            <td width="70%" style="font-weight:bold;">
                <?php echo $student_value['roll_no']; ?>
            </td>
            </tr>
            <?php } ?>

            <?php
            if ($admitcard->is_name) { 
            ?>
            <tr style="min-height:200px;">
            <td width="30%"><?php echo $this->lang->line('candidates') . " " . $this->lang->line('name') ?></td>
            <td width="70%" style="font-weight:bold;">
                <?php 
                echo $this->customlib->getFullName(
                    $student_value['firstname'], 
                    $student_value['middlename'], 
                    $student_value['lastname'], 
                    $sch_setting->middlename, 
                    $sch_setting->lastname
                ); 
                ?>
            </td>
            </tr>
            <?php
            }
            ?>

            <?php if ($admitcard->is_admission_no) { ?>
            <tr style="border: 1px solid #999;border-collapse: collapse;">
            <td width="30%"><?php echo $this->lang->line('admission_no') ?></td>
            <td width="70%" class="sec_col" style="font-weight:bold;">
                <?php echo $student_value['admission_no']; ?>
            </td>
            </tr>
            <?php } ?>

            <tr>
            <td><?php echo $this->lang->line('programme'); ?></td>
            <td><?php echo $student_value['p_name']; ?></td>
            </tr>

            <tr>
            <td><?php echo $this->lang->line('batch'); ?></td>
            <td><?php echo $student_value['batch_group_name']; ?></td>
            </tr>

            <tr>
            <td><?php echo $this->lang->line('semester'); ?></td>
            <td><?php echo $student_value['st_name'] . '&nbsp;&nbsp;' . $student_value['stm_name']; ?></td>
            </tr>
            </table>

            <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;float:left; color:#000;">
            <tr class="first_td"><td>&nbsp;</td></tr>

            <tr class="first_td">
            <?php if ($admitcard->is_dob) { ?>
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('d_o_b'); ?></td>
            <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;">
                <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($student_value['dob'])); ?>
            </td>
            <?php } ?>

            <?php if ($admitcard->is_gender) { ?>
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('gender'); ?></td>
            <td valign="top" class="first_tdd"><?php echo $student_value['gender']; ?></td>
            <?php } ?>
            </tr>

            <tr class="first_td">
            <?php if ($admitcard->is_father_name) { ?>
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('fathers') . " " . $this->lang->line('name') ?></td>
            <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;">
                <?php echo $student_value['father_name']; ?>
            </td>
            <?php } ?>

            <?php if ($admitcard->is_mother_name) { ?>
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('mothers') . " " . $this->lang->line('name'); ?></td>
            <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;">
                <?php echo $student_value['mother_name']; ?>
            </td>
            <?php } ?>
            </tr>

            <?php if ($admitcard->is_address) { ?>
            <tr class="first_td">
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('address'); ?></td>
            <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;">
                <?php echo $student_value['current_address']; ?>
            </td>
            </tr>
            <?php } ?>

            <?php if ($admitcard->school_name != "") { ?>
            <tr class="first_td">
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('school_name') ?></td>
            <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;">
                <?php echo $admitcard->school_name; ?>
            </td>
            </tr>
            <?php } ?>

            <?php if ($admitcard->exam_center != "") { ?>
            <tr class="first_td">
            <td valign="top" class="first_headertdd"><?php echo $this->lang->line('exam') . " " . $this->lang->line('center'); ?></td>
            <td valign="top" class="first_tdd" style="text-transform: uppercase; font-weight: bold;">
                <?php echo $admitcard->exam_center; ?>
            </td>
            </tr>
            <?php } ?>

            <tr class="first_td"><td>&nbsp;</td></tr>
            </table>
            </div>

            <div id="" style="width:24%;float:left;margin-left:2px;">
            <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;">
            <?php if ($admitcard->is_photo) { ?>
            <tr>
            <td width="13%">&nbsp;</td>
            <td valign="top" width="88%">
                <?php if ($student_value['image'] != '') { ?>
                    <img src="<?php echo base_url() . $student_value['image']; ?>" width="200" height="260" style="border: 2px solid #fff; outline: 1px solid #000000; text-align:right;">
                <?php } ?>
            </td>
            </tr>
            <?php } ?>
            </table>
            </div>
            </div>

            <table>
            <tr><td>&nbsp;</td></tr>
            </table>

            <div id="" style="min-height:800px; height:auto;">
            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
            <tr>
            <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('exam_date_time'); ?></th>
            <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('paper_code') ?></th>
            <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('subject'); ?></th>
            <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('obted_by_student') ?></th>
            <th valign="top" style="text-align: left; text-transform: uppercase;"><?php echo $this->lang->line('sign_of_invigilator') ?></th>
            </tr>

            <?php 
            // Loop through subjects for THIS student
            foreach ($student_group as $subjects) { 
            ?>
            <tr>
            <td valign="top" style="text-align: left;">
            <?php echo $subjects['date_from'] . ' ' . $subjects['time_from']; ?>
            </td>
            <td valign="top" style="text-align: left;"><?php echo $subjects['code']; ?></td>
            <td valign="top" style="text-align: left;"><?php echo $subjects['name']; ?></td>
            <td valign="top" style="text-align: left;"><?php echo $subjects['type']; ?></td>
            <td valign="top" style="text-align: left;">&nbsp; &nbsp;</td>
            </tr>
            <?php } ?>
            </table>
            </div>
            </td>
            </tr>

            <tr><td valign="top" height="5"></td></tr>

            <?php if ($admitcard->content_footer != "") { ?>
            <tr>
            <td valign="top" style="padding-bottom: 15px; line-height: normal;"></td>
            </tr>
            <?php } ?>

            <tr><td valign="top" height="20px"></td></tr>
            </table>
            </div>

            <div class="mark-container">
            <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td style="width:60%">
            <?php if ($admitcard->is_qrcode != "") { ?>
            <img src="<?php echo base_url() . $student_value['sem_exam_qrcode']; ?>" width="260" height="260" style="border: 2px solid #fff;"/>
            <?php } ?>
            </td>

            <td style="width:40%" valign="top" class="fontstyle">
            <?php if ($admitcard->sign != "") { ?>
            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign); ?>" width="100" height="38" />
            <br>
            <?php } ?>

            <b>Signature of the Candidate...................<br>
            (To be signed in the Presence of Identifying Officer)</b>
            <br>

            <?php if ($admitcard->sign_two != "") { ?>
            <br><br>
            <img src="<?php echo base_url('uploads/admit_card/' . $admitcard->sign_two); ?>" width="200" height="76" />
            <br>
            <b>Controller of Examinations</b>
            <br>
            <?php echo $sch_setting->name; ?>
            <?php } ?>
            </td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <td colspan="2" style="text-align:center; padding-top: 20px;">
            <h4>
            <?php if ($admitcard->content_warning != "") {
            echo $admitcard->content_warning;
            } ?>
            </h4>
            </td>
            </tr>
            </table>

            <div class="pagebreak"></div>

            <p>
            <?php if ($admitcard->content_instruction != "") {
            echo $admitcard->content_instruction;
            } ?>
            </p>
            </div>

            <div class="pagebreak"></div>

            <?php
            } // End foreach student_group
            } // End if !empty



            ?>