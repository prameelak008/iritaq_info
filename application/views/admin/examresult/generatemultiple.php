
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        
        @media print {  
        @page {
        size: 57mm 89mm;
        margin: 0;
        }
        }
        
        
        @media print
        {
        body
        {
        height:89mm !important;
        width:57mm;  
        margin: 0;
        }
        }
        @media print 
        {
        div {
        break-inside: avoid;
        }
        }
        @media print {
        .pagebreak { page-break-before: always; } 
        }
        
        
        .medical 
        {
        width: 8.5cm;
        height: 5.3cm;
        padding: 10px;
        font-family: 'Roboto','Source Sans Pro',sans-serif;
        -moz-border-radius-topleft: 12px; 
        -moz-border-radius-topright:12px; 
        -moz-border-radius-bottomleft:12px; 
        -moz-border-radius-bottomright:12px; 
        -webkit-border-top-left-radius:12px; 
        -webkit-border-top-right-radius:12px; 
        -webkit-border-bottom-left-radius:12px;
        -webkit-border-bottom-right-radius:12px;
        border-top-left-radius:12px; 
        border-top-right-radius:12px; 
        border-bottom-left-radius:12px;
        border-bottom-right-radius:12px;
        }
        
        
        
        
        .medicalback
        {
        padding: 0px;
        width: 8.5cm;
        height: 5.3cm;
        -webkit-border-top-left-radius:12px; 
        -webkit-border-top-right-radius:12px; 
        -webkit-border-bottom-left-radius:12px;
        -webkit-border-bottom-right-radius:12px;
        border-top-left-radius:12px; 
        border-top-right-radius:12px; 
        border-bottom-left-radius:12px;
        border-bottom-right-radius:12px;
        
        }
        
        .medtitle
        {
        display: block;
        margin-left: -10px;
        margin-right: -10px;
        margin-top: -10px;
        padding: 4px;
        text-align:center;
        font-weight:bold;
        font-size:15px;
        -moz-border-radius-topleft: 12px; 
        -moz-border-radius-topright:12px; 
        -webkit-border-top-left-radius:12px; 
        -webkit-border-top-right-radius:12px; 
        border-top-left-radius:12px; 
        border-top-right-radius:12px;
        }
        
        .medtitle_back
        {
        display: block;
        
        margin-left: -10px;
        margin-right: -10px;
        margin-top: -10px;
        padding: 4px;
        text-align:center;
        font-size:15px;
        -moz-border-radius-topleft: 12px; 
        -moz-border-radius-topright:12px; 
        -webkit-border-top-left-radius:12px; 
        -webkit-border-top-right-radius:12px; 
        border-top-left-radius:12px; 
        border-top-right-radius:12px;
        }
        .medtitlefooter 
        {
        display: block;
        padding: 4px;  
        font-weight: bold;
        font-size: 12px;
        font-family: Arial;
        }
        .footer_title
        {
        width:50%
        height:20px;
        background-color:green;
        }
        
        hr.new4 {
        border: 1px solid red;
        }
        
        .pbackclass
        {
        font-size:8px;
        padding-left:0px;
        }
        
        .back_footer_address
        {
        font-size: 10px;
        }
        
        
        .pclass
        {
        margin: 0px 0px 2px !important;
        font-size: 12px
        }
        .id_card_main
        {
        height:87mm !important;
        width:57mm;
        }
        .id_card_main_back
        {
        height:87mm !important;
        width:57mm;
        float:left;
        }
        }
        
        
        .tdfirst
        {
        text-align:left;
        }
        
        .tdfirst_space
        {
        font-size:5pt;  
        line-height:10px;
        }
        
        
        .tdsecond
        {
        text-align:left;
        /*width:10px !important;*/
        }
        
        .font6
        {
            
        font-size:6pt;
        font-family:Helvetica Condensed;
        }
        
        
        .font8
        {
        font-size:10pt; 
        text-align:center;
        
        }
        
        .tdft_centre
        {
        font-size:8px;
        font-family:Helvetica Condensed;
        }
        
        .tdsec_centre
        {
        font-size:8px;
        font-family:Helvetica Condensed;
        }
        }
        
        
        .id-card-holder 
        {
        width: 225px;
        padding: 4px;
        margin: 0 auto;
        background-color: #1f1f1f;
        border-radius: 5px;
        position: relative;
        }
        .id-card
        {
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        }
        
        
        .id-card img 
        {
        margin: 0 auto;
        }
        
        .header img 
        {
        width: 100%;
        margin-top: 15px;
        }
        
        .photo img
        {
        width: 80px;
        margin-top: 15px;
        }
        
        h2 
        {
        font-size: 8pt;
        margin: 5px 0;
        }
        
        h3 
        {
        font-size: 7pt;
        margin: 2.5px 0;
        font-weight: 300;
        }
        
        .qr-code img 
        {
        width: 50px;
        }
        
        p 
        {
        font-size: 5px;
        margin: 2px;
        }
        
        
        .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
        }
        .id-card-hook:after {
        content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
        }
        .breakpage {
        page-break-after: always;
        }
        
        
        
        .container {
        position: relative;
        text-align: center;
        color: white;
        }
        
       
        .bottom-left {
        position: absolute;
        bottom: 8px;
        left: 16px;
        }
        
      
        .top-left {
        position: absolute;
        top: 8px;
        left: 16px;
        }
        
        
        
        .top-right {
        position: absolute;
        top: 8px;
        right: 16px;
        }
        
        
        
        .bottom-right {
        position: absolute;
        bottom: 8px;
        right: 16px;
        }
        
        
        
        .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        }
        
        .tdft_centre
        {
        text-align:left;
        width:30%;
        }
        
        .tdft_dots
        {
        font-size:6px;    
        width:5%;
        }                    
        
        .tdfsec_centre
        {
        text-align:left;
        width:50%;
        }
        table{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}
        .tc-container{width: 100%;position: relative; text-align: center;}
        .tcmybg 
        {
        background: top center;
        background-size: contain;
        position: absolute;
        left: 0;
        height:89mm !important;
        width:57mm;
        right: 0;
        z-index: -1;
        }
        
        table.center {
        margin-left: auto; 
        margin-right: auto;
        }
        }
        
        </style>
        
        <body>
        
        
        <?php
        $school = $sch_setting[0];
        $i = 0;
        ?>
        
        <?php
        
        
        if($id_card[0]->template_no==2)
        {
        //if($id_card[0]->enable_vertical_card)
        //{
        foreach ($students as $student) 
        {
        ?>
        <div class="breakpage">
        <?php
        $i++; 
        $stud_id=  $student->id;
        
        $this->db->select('*');
        $this->db->from('student_session');
        $this->db->join('transport_route', 'transport_route.id = student_session.route_id');
        $this->db->where(array('student_session.student_id' => $stud_id));                       
        $query = $this->db->get();
        $res= $query->row_array(); 
        $no_of_vehicle= $res['no_of_vehicle'];
        ?>
        
        
        <div class="medical" style="background: <?php echo $id_card[0]->background_color; ?>;">
        <h5 class="medtitle" style="background: <?php echo $id_card[0]->header_color; ?>; border-bottom-color: <?php echo $id_card[0]->layout_color; ?>;
        border-bottom: 5px solid <?php echo $id_card[0]->layout_color; ?>;  ">
        <img src="<?php echo base_url('uploads/student_id_card/logo/'.$id_card[0]->logo); ?>" width="30" height="30"> 
        <small> <?php echo $id_card[0]->school_name; ?></small>
        <br>
        
        </h5>
        <img src="<?php
        if (!empty($student->image))
        {
        echo base_url() . $student->image;
        } 
        else
        {
        
        if ($student->gender == 'Female')
        {
        echo base_url() . "uploads/student_images/default_female.jpg";
        } 
        elseif ($student->gender == 'Male') 
        {
        echo base_url() . "uploads/student_images/default_male.jpg";
        }
        
        }
        ?>" class="img-responsive img-circle block-center" style="float: left; 
        margin: 0px 0px 0px 0px; 
        padding: 0px 0px 0px 0px; 
        object-fit: cover; /*object-position: -40px -1%; 
        width:100px; height:70px;padding-right: 15px;" />
        
        <p class="pclass"><?php echo $this->lang->line('name'); ?>: <?php echo $this->customlib->getFullName($student->firstname,$student->middlename,$student->lastname,$sch_settingdata->middlename,$sch_settingdata->lastname); ?></p>  
        <?php if ($id_card[0]->enable_admission_no == 1)
        {
        ?>
        <p class="pclass">Reg No:<?php echo $student->admission_no; ?></p>
        <?php 
        } 
        
        if ($id_card[0]->enable_class == 1) 
        {
        ?> 
        <p class="pclass"><?php echo $this->lang->line('class'); ?>: <?php echo $student->class;?> </p>
        <?php 
        } 
        if ($id_card[0]->enable_section == 1) 
        {
        ?>
        
        <p class="pclass"><?php echo $this->lang->line('section'); ?>: <?php echo $student->section ; ?></p>
        
        <?php 
        } 
        
        
        if ($id_card[0]->enable_fathers_name == 1) 
        {
        ?>
        <p class="pclass">Father's Name: <?php echo $student->enable_fathers_name ; ?></p>
        
        <?php 
        }
        
        
        if ($id_card[0]->enable_mothers_name == 1) 
        {
        
        ?>
        <p class="pclass">Mother's Name: <?php echo $student->enable_mothers_name ; ?></p>
        
        <?php 
        } 
        
        
        if ($id_card[0]->enable_address == 1) 
        {
        ?>
        <p class="pclass">Address: <?php echo $student->enable_address ; ?></p>
        
        <?php 
        }
        
        if ($id_card[0]->enable_phone == 1) 
        {
        ?>
        <p class="pclass">Phone: <?php echo $student->enable_phone ; ?></p>
        
        <?php 
        }
        
        
        if ($id_card[0]->enable_dob == 1) 
        {
        ?>
        <p class="pclass"><?php echo $this->lang->line('d_o_b');?><?php echo $student->enable_dob ; ?></p>
        
        <?php 
        }
        ?>
        
        
        <br style="clear:both;">
        <br>
        
        <div class="medtitlefooter">
        <span style="background-color: <?php echo $id_card[0]->layout_color; ?>; width:50%; border-radius: 2px 2px 75px 2px; width:50%;">Bus no :<?php echo  $no_of_vehicle; ?> &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp;   </span><span style=" border-radius: 2px 2px 75px 2px;">Academic Year &nbsp;<?php echo $school['current_session']['session']; ?></span>
        </div>
        </div>
        
        
        <br>
        </div>
        <?php } ?>
        
        
        
        
        <?php
        }
        else if($id_card[0]->template_no==1)
        {
        foreach ($students as $student) 
        {
        ?>
        <div class="breakpage">
        <?php
        $i++; 
        ?>
        
        <div class="medicalback" style="background: <?php echo $id_card[0]->background_color; ?>;"   >
        <h4 class="medtitle_back" >Vehicle Name <br>Student ID Card</h4>
        <p class="pbackclass">Pick Up Area :<?php echo $student->PickUp ; ?> </p> 
        <p class="pbackclass">Drop Of Area: <?php echo $student->DropOf ; ?></p>  
        <p class="pbackclass">Parent Contact No 1: <?php echo $student->guardian_phone ; ?></p> 
        <p class="pbackclass">Parent Contact No 2: </p> 
        <p style="width:85%;background-color:<?php echo $id_card[0]->layout_color; ?>;color:#fff; font-weight:bold; font-size:12px; border-radius: 2px 2px 75px 2px;padding-right:15px;">
        <?php  echo $id_card[0]->layout_title;  ?> </p>
        
        <p class="back_footer_address" ><?php echo $id_card[0]->footer_contents; ?><br>
        <small style="text-align:center"><span> &nbsp; Tel:&nbsp;<?php  echo $school['phone'];  ?>&nbsp;<?php  echo $school['website'];  ?></small>
        </p>
        
        
        <br style="clear:both;">
        </div>
        <br>
        </div>
        <?php } ?>
        <?php
        }
        
        
        
        else if($id_card[0]->template_no==3)
        {
        foreach ($students as $student) 
        {
        ?>
        
        <div class="id_card_main" style="position: relative; " >
        <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="padding-left:10px;padding-right:10px;" >
        <tr>
        <td valign="top">
        <img src="<?php  echo base_url();?>/uploads/student_id_card/background/<?php echo $id_card[0]->background; ?>" class="tcmybg"  />
        </td>
        </tr>
        
        <tr>
        <td valign="top" >
        <div class="sttext1">
        <img src="<?php echo base_url() ?>uploads/student_id_card/logo/<?php echo $id_card[0]->logo; ?>" style="height: 35px;width:90%;margin-top:20px; "/>  
        </div>
        </td>
        </tr>
        
        <tr>
        <td style="padding-top:10px;padding-right:6px;">
            
            <h4  style="font-family:Helvetica;text-transform: uppercase;">Admit Card</h4>
        <img src="<?php
        if (!empty($student->image))
        {
        echo base_url() . $student->image;
        } 
        else
        {
        
        if ($student->gender == 'Female')
        {
        echo base_url() . "uploads/student_images/default_female.jpg";
        } 
        elseif ($student->gender == 'Male') 
        {
        echo base_url() . "uploads/student_images/default_male.jpg";
        }
        
        }
        ?>" style="height:83px;  width:65px; border:1px solid #bcc1c7; border-radius:7px 5px 5px 5px;  " /></td></tr>
        
        <tr style="line-height:1px;"><td>&nbsp;</td></tr>
     
        <tr style="padding-top:5px;">
        <td colspan="2"  class="font8" style="font-family:Helvetica;"><b>
        <?php echo $this->customlib->getFullName($student->firstname,$student->middlename,$student->lastname,$sch_settingdata->middlename,$sch_settingdata->lastname); ?></b>
        <br>
        <span style="font-family:Helvetica Condensed;font-size:8pt;">
        
        <?php  
        if ($id_card[0]->enable_class == 1) {  echo $student->class;   }?>
        </span>
        </td>
        </tr>
        
        </table>
        <table  style="padding-left:10px;padding-right:10px;margin-top:6px;" class="center" >
        <?php if ($id_card[0]->enable_admission_no == 1)
        {
        ?>
        <tr style="text-align:left;">
        <td class="tdfirst font6" >Institution ID</td>
        <td class="tdfirst_space">:</td>
        <td class="tdsecond font6"><?php echo $student->admission_no; ?></td>
        </tr>
        
        
          <tr style="text-align:left;">
        <td class="tdfirst font6" >Register No</td>
        <td class="tdfirst_space">:</td>
        <td class="tdsecond font6"><?php echo $student->roll_no; ?></td>
        </tr>
        <?php } ?>
        
        
        
        <?php
        /*
        if ($id_card[0]->enable_blood_group == 1)
        {
        ?>
        <tr style="text-align:left;">
        <td class="tdfirst font6 " ><span >Blood Group</span></td>
        <td class="tdfirst_space">:</td>
        <td class="tdsecond font6 "><?php echo $student->blood_group; ?></td>
        </tr>
        
        <?php } 
        
        
        ?>
        
        <?php if ($id_card[0]->enable_phone == 1)
        {
        ?>
        <tr style="text-align:left;">
        <td class="tdfirst font6 ">Phone</td>
        <td class="tdfirst_space">:</td>
        <td class="tdsecond font6 "><?php echo $student->mobileno; ?></td>
        </tr>
        <?php 
        } 
        */
        ?>
        
        <tr>
        <td class="tdfirst font6 " style="text-align:left;">Valid up to</td>
        <td class="tdfirst_space">:</td>
        <td class="tdsecond font6 "><?php echo $maxToDate;?></td>
        </tr>
        
        </table>
        <table style="padding-left:10px;padding-right:10px;margin-top:1px;" class="center" >
        
        <tr>
       <td class="tdfirst font6 "  style="text-align:center; padding-top:2px;">
        <img src="<?php  echo base_url() . $student->barcode; ?>"  style="width:33mm; height:8mm; margin-left:2px;"  /></td>
        </tr>
        </table>
        </div>
        
        
        <div class="breakpage"/></div>
        
        <div class="id_card_main" style="position: relative; " >
        <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="padding-left:10px;padding-right:10px; " >
        <tr>
        <td valign="top">
        <img src="<?php  echo base_url();?>/uploads/student_id_card/background/<?php echo $id_card_backend[0]->background; ?>" class="tcmybg"  />
        </td>
        </tr>
        <tr><td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td>
        </tr>
        </table>
        
        
        
        <table style="margin-left:20px; margin-right:20px; padding-top:28px; ">
        <?php if ($id_card_backend[0]->enable_dob == 1)
        {
        ?>
        <tr >
        <td class="tdft_centre" >Date of Birth:</td>
        <td class="tdft_dots">:</td>
        <td class="tdsec_centre" ><?php echo $student->dob; ?></td>
        </tr>
        <?php } ?>
        
        
        <?php if ($id_card_backend[0]->enable_address == 1)
        {
        ?>
        <tr style="height:70px; min-height:150px !important;   ">
        <td class="tdft_centre ">Address:</td>
        <td class="tdft_dots">:</td>
        <td class="tdsec_centre" >
        <?php
        $string_array = explode(',', $student->current_address);
        end($string_array);        
        $last = key($string_array);
        foreach ($string_array as $key => $value) {
        if($last==$key){
        echo strtoupper($value);
        }else{
        echo strtoupper($value.',');
        }
        if(($key+1)%1==0){
        echo "<br />";
        }
        }
        ?>
        </td>
        </tr>
        <?php } ?>
        
        <?php if ($id_card_backend[0]->enable_email == 1)
        {
        ?>
        <tr style="height:5px;">
        <td class="tdft_centre">E-mail</td>
        <td class="tdft_dots">:</td>
        <td class="tdsec_centre" ><?php echo $student->email; ?></td>
        </tr>
        <?php } ?>
        </table>
        
        
        
        <table style="margin-left:20px; margin-right:20px; margin-top:5px; min-height:50px;">
        <tr style="height:15px;">
        <td class="tdft_centre" >Exam Controller<br> </td>
        
        <td class="tdsec_centre"  >
        <img src="<?php echo base_url() ?>uploads/student_id_card/signature/<?php echo $id_card_backend[0]->sign_image; ?>" style="width:60px; height:40px; "/>    
        
        <br>
        <span style="padding-left:10px;">
        (Principal)</span>
        </td>
        
        
        <td class="tdsec_centre">
        <img src="<?php echo base_url() ?>uploads/student_id_card/seal/<?php echo $id_card_backend[0]->seal; ?>" style="width:40px; height:40px; float:left;"/>
        </td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
        <td class="tdsec_centre"  >
           <img src="<?php echo base_url();?>/<?php echo $student->exam_qrcode; ?>" style="height:100px; width:100px; "/>
            </td>
        </tr>
        
        <!--
        <tr>
            <td>&nbsp;</td>
            <td class="tdsec_centre " style="text-align:right; width:70%;" colspan="2" >
        <?php echo $id_card_backend[0]->school_address; ?> 
        </td>
        
        </tr>
        -->
        
        </table>
        
        
        
        <!--<table style="margin-left:20px; margin-right:20px;max-height:40px;padding-top:2px; margin-top:0px; background-color:green; ">-->
        <!--<tr>-->
        <!--<td class="tdft_centre" style=" width:47%; " >-->
        <!--<img src="<?php echo base_url();?>/<?php echo $student->qrcode; ?>" style="height:38px; width:38px; "/>-->
        <!--</td>-->
        
        <!--<td class="tdsec_centre " style="text-align:right; width:70%;" colspan="2">-->
        <!--<?php echo $id_card_backend[0]->school_address; ?>  -->
        
        <!--</td>-->
        <!--</tr>-->
        <!--<br>-->
        <!--<br>-->
        <!--</table>-->
        </div>
        
        <?php } 
        
        
          ?>
        <?php  
        }
        
        
        elseif($id_card[0]->template_no==4)
        {
        ?> 
        <div class="id_card_main" style="position: relative; " >
        
        
        <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="padding-left:10px;padding-right:10px; " >
        <tr>
        <td valign="top">
        <img src="<?php  echo base_url();?>/uploads/student_id_card/background/<?php echo $id_card_backend[0]->background; ?>" class="tcmybg"  />
        </td>
        </tr>
        <tr><td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td>
        </tr>
        </table>
        
        
        
        <table style="margin-left:20px; margin-right:20px; ">
        <?php if ($id_card_backend[0]->enable_dob == 1)
        {
        ?>
        
        
        
        
        <tr >
        <td class="tdft_centre">Date of Birth:</td>
        
        <td class="tdsec_centre" colspan="2"><?php echo $student->dob; ?></td>
        </tr>
        <?php } ?>
        
        
        <?php if ($id_card_backend[0]->enable_address == 1)
        {
        ?>
        <tr style="height:40px;">
        <td class="tdft_centre ">Address:</td>
        <td class="tdsec_centre" colspan="2">
        
        
        
        <?php 
        $string_array = explode(',', $student->current_address);
        end($string_array);        
        $last = key($string_array);
        foreach ($string_array as $key => $value) 
        {
        if($last==$key){
        echo $value;
        }else{
        echo $value.',';
        }
        if(($key+1)%1==0){
        echo "<br />";
        }
        }
        
        ?>
        
        
        
        
        
        
        
        
        </td>
        </tr>
        <?php } ?>
        
        <?php if ($id_card_backend[0]->enable_email == 1)
        {
        ?>
        <tr style="height:40px;">
        <td class="tdft_centre ">E-mail:</td>
        <td class="tdsec_centre" colspan="2"><?php echo $student->email; ?></td>
        </tr>
        <?php } ?>
        
        
        
        
        <tr style="height:90px;">
        <td class="tdft_centre" >Signature of <br> Issuing Authority</td>
        
        <td class="tdsec_centre"  >
        <img src="<?php echo base_url() ?>uploads/student_id_card/signature/<?php echo $id_card_backend[0]->sign_image; ?>" style="width:50px; height:40px; "/>    
        
        <br>
        <span style="padding-left:2px;">
        (Principal)</span>
        </td>
        
        
        <td class="tdsec_centre">
        
        
        <img src="<?php echo base_url() ?>uploads/student_id_card/seal/<?php echo $id_card_backend[0]->seal; ?>" style="width:40px; height:40px; float:left;"/>  
        
        
        </td>
        </tr>
        
        
        
        
        <tr >
        <td class="tdft_centre" >
        <img src="<?php echo base_url();?>/<?php echo $student->qrcode; ?>" style="height:35px; width:350px;"/></td>
        
        <td class="tdsec_centre " style="text-align:right; width:80%;" colspan="2">
        <?php echo $id_card_backend[0]->school_address; ?> 
        </td>
        </tr>
        
        
        
        <br>
        
        <br>
        </table>
        </div>
        <div class="breakpage"/></div>
        <?php
        }
        ?>
        
        
        </html>   
