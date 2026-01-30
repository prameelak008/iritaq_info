                    <style type="text/css">
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
                    /*border:1px solid #000; */
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
                    text-align: center;
                    font-weight:bold ;
                    }
                    
                    </style>               
                    <div class="content-wrapper" style="min-height: 946px;">
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
                    </section>
                    <!-- Main content -->
                    <section class="content">
                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> Application For Improvement</h3>
                    </div>
                    
                    <div class="box-body">
                        
                    <form role="form" action="<?php echo site_url('user/improvement/improvement') ?>" method="post" class="row">
                    <?php echo $this->customlib->getCSRF(); ?>
                    <div class="col-sm-6 col-lg-4 col-md-4">
                    <div class="form-group">
                    <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
                    <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
                    
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    
                    <?php
                    foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
                    ?>
                    <option value="<?php echo $ex_group_value->id ?>" <?php
                    if (set_value('exam_group_id') == $ex_group_value->id) {
                    echo "selected=selected";
                    }
                    ?>><?php echo $ex_group_value->name; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    
                    
                    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                    </div>  
                    </div>
                    <div class="col-sm-6 col-lg-4 col-md-4">
                    <div class="form-group">  
                    <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
                    <select  id="exam_id" name="exam_id" onchange="getexam_id()" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                    </div>  
                    </div>
                    
                    
                    <div class="col-sm-6 col-lg-4 col-md-4" style="visibility: hidden;" >
                    <div class="form-group">  
                    <label><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
                    <select  id="session_id" name="session_id" class="form-control" >
                    <option  value="<?php echo $students_listt['sesidd']; ?>"><?php echo $students_listt['sesname']; ?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error('session_id'); ?></span>
                    </div>  
                    </div>
                    
                    
                    <div class="col-sm-6 col-lg-4 col-md-4" style="visibility: hidden;" >
                    <div class="form-group">  
                    <label><?php echo $this->lang->line('class'); ?><small class="req"> *</small></label>
                    <select id="class_id" name="class_id" class="form-control" >
                    <option value="<?php  echo $students_listt['classesidd'];?>"><?php  echo $students_listt['classesname'];?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                    </div>  
                    </div>
                    
                    
                    <div class="col-sm-6 col-lg-4 col-md-4" style="visibility: hidden;" >
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?><small class="req"> *</small></label>
                    <select  id="section_id1" name="section_id" class="form-control" >
                    <option value="<?php echo $students_listt['sectionsidd']; ?>"><?php echo $students_listt['sectionsname']; ?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                    </div>   
                    </div>
                    
                    <div class="col-sm-12">
                    <div class="form-group">
                    <input type="hidden" id="exam_group_class_batch_exam_student_id" value="" name="exam_group_class_batch_exam_student_id[]"/>
                    <button type="submit"  onclick="return checkvalue();" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                    </div>
                    </div>
                    </form>
                    </div>
                    
                    <?php
                    if(empty($improvement_payment))
                    {
                    if (empty($marksheet)) 
                    {
                    ?>
                    <div class="alert alter-info">
                    <?php echo $this->lang->line('no_record_found'); ?>
                    </div>
                    <?php
                    } 
                    else 
                    {
                    if ($marksheet['exam_connection'] == 0) 
                    {
                    if (!empty($marksheet['students'])) {
                    foreach ($marksheet['students'] as $student_key => $student_value)
                    {
                    $result_status = 1;
                    $absent_status = false;
                    $percentage_total = 0;
                    ?>
                    
                    <style type="text/css">
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
                    /*border:1px solid #000; */
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
                    text-align: center;
                    font-weight:bold ;
                    }
                    
                    </style>
                    
                    <div class="row">
                    <div class="col-md-12">
                    <div style="margin: 0 auto; padding: 5px 5px 5px;position: relative; z-index: 0;">
                        
                        
                    <?php
                    
                    foreach($getstud as $gt) 
                    {
                    $sayexam_subject[]=$gt['exam_group_exam_improvement_subject_id'];
                    }
                    
                    if( $Exam_group_list->is_publish=='1')
                    {
                    if (!empty($student_value['exam_result']))
                    {
                    ?>
                    
                    <form name="" method="POST" action="<?php   echo site_url('user/improvement/send_request');?>">
                    
                    <div class="tablemain1">
                    <input type="hidden" id="exam_idd" name="exam_idd" value="<?php  echo $exam_id;  ?>"  >
                    <input type="hidden" id="exam_groupidd" name="exam_groupidd" value="<?php  echo $exam_group_id;  ?>">
                    <input type="hidden" id="exam_session_id" name="exam_session_id" value="<?php  echo $session_id;  ?>"> 
                    <input type="hidden" id="exam_class_id" name="exam_class_id" value="<?php  echo $class_id;  ?>"> 
                    <input type="hidden" id="exam_section_id" name="exam_section_id" value="<?php  echo $section_id;  ?>">
                    <div style="min-height:85mm;">
                    <span style="font-weight:bold;"></b>Apply Subject For Improvement :<b></span>
                    <br>
                    <br>
                    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
                    <thead>
                    <tr>
                    <th rowspan="2" class="headerclass" ><input type="checkbox" onclick="toggle(this);" /></th>
                    
                    <th colspan="2" class="headerclass" ><b>Subjects</b></th>
                    <!--<th colspan="2" class="headerclass"><b>CE</b></th>-->
                    <th colspan="2" class="headerclass"><b>TE</b></th>
                    <th class="headerclass"><b>Marks Obtained</b></th>
                    <th rowspan="2" class="headerclass" ><b>Total</b>   </th>
                    <!--<th colspan="2" class="headerclass" ><b>Grade</b>   </th>-->
                    <!--<th  class="headerclass" ><b></b>   </th>-->
                    <th  class="headerclass" ><b>Grade</b>   </th>
                    </tr>
                    </thead>
                    
                    
                    <tr>
                    <td class="headerclass"></td>
                    <td class="headerclass">Code</td>
                    <td class="headerclass">Name</td>
                    <td class="headerclass">Max</td>
                    <td class="headerclass">Min</td>
                    <!--<td class="headerclass">Max</td>-->
                    <!--<td class="headerclass">Min</td>-->
                    <!--<td class="headerclass">CE</td>-->
                    <td class="headerclass">TE</td>
                    <td class="headerclass"></td>
                    <td class="headerclass"></td>
                    </tr>
                    <?php
                    $total_max_marks    = 0;
                    $total_obtain_marks = 0;
                    $total_points       = 0;
                    $total_hours        = 0;
                    $total_quality_point= 0;
                    $grandtotal         = 0;
                    $obtainedtotal      = 0;
                    $maxtotal           = 0;
                    $grandmaxtotal      = 0;
                    $singlepercentage   = 0;
                    $grandobtainedtotal = 0;
                    $percentage         = 0;
                    $perc               = 0;                                    
                    $total_min_marks    = 0;
                    
                    $clas               ="";
                    $res                ="";
                    $fgde               ="";
                    
                   
                    $mincmarks          = 0;
                    $minmarks           = 0;
                    $get_cmarks         = 0;
                    $get_marks          = 0;
                    $array_push         =array();
                    
                    foreach ($student_value['exam_result'] as $exam_result_key => $exam_result_value) 
                    {
                    $total_min_marks = $total_min_marks + $exam_result_value->min_marks;
                    $total_max_marks = $total_max_marks + $exam_result_value->max_marks;
                    $total_obtain_marks = $total_obtain_marks + $exam_result_value->get_marks+ $exam_result_value->get_cmarks;
                    $student_val= $exam_result_value->exam_group_class_batch_exam_subject_id;
                  
                  
                    if(in_array($student_val, $sayexam_subject))
                    {
                    $checked="checked";
                    }
                    else
                    {
                    $checked="";
                    }
                    ?>
                    <tr>
                    <td class="headerclass">
                    <input type="checkbox" class="checkbox" <?php echo $checked; ?>   name="exam_group_exam_results_id[]"  value="<?php echo $exam_result_value->exam_group_exam_results_id ; ?>">
                    <input type="hidden"   name="exam_group_exam_results_getallid[]" value="<?php echo $exam_result_value->exam_group_exam_results_id ; ?>"/>
                    
                    <input type="hidden" name="exam_group_exam_results_stud_id[]" value="<?php echo $exam_result_value->exam_group_exam_results_stud_id ; ?>"/>
                    <input type="hidden" name="exam_group_exam_results_subject_id[]" value="<?php echo $exam_result_value->exam_group_exam_results_subject_id ; ?>"/>
                    <input type="hidden" name="get_cmarks[]" value="<?php echo $exam_result_value->get_cmarks ; ?>"/>
                    <input type="hidden" name="get_marks[]" value="<?php echo $exam_result_value->get_marks ; ?>"/>
                    </td>
                    <td><?php echo $exam_result_value->code ; ?></td>
                    <td><?php echo $exam_result_value->name ; ?> </td>
                    <!--<td><?php echo $exam_result_value->max_cmarks ; ?></td>-->
                    <!--<td><?php echo $exam_result_value->min_cmarks ; ?></td>-->
                    
                    <td><?php echo $exam_result_value->max_marks ; ?></td>
                    <td><?php echo $exam_result_value->min_marks ; ?></td>
                    
                    <!--<td><?php echo $exam_result_value->get_cmarks ; ?></td>-->
                    <td><?php echo $exam_result_value->get_marks ; ?></td>
                    
                    
                    <td>
                    <?php 
                    /* $obtainedtotal= $exam_result_value->get_cmarks+$exam_result_value->get_marks;
                    
                    $maxtotal= $exam_result_value->max_cmarks+$exam_result_value->max_marks;
                    */
                    $obtainedtotal= $exam_result_value->get_marks;
                    $maxtotal= $exam_result_value->max_marks;
                    echo number_format((float)$obtainedtotal, 2, '.', '');
                    $singlepercentage=$obtainedtotal/$maxtotal*100;
                    $grandobtainedtotal+=$obtainedtotal;
                    $grandmaxtotal+=$maxtotal;
                    ?></td>
                    
                    <!-- <td><?php echo number_format((float)$singlepercentage, 2, '.', '');?> %</td>-->
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
                    $mincmarks=$exam_result_value->  min_cmarks ;
                    $minmarks=$exam_result_value->   min_marks ;
                    $get_cmarks=$exam_result_value-> get_cmarks ;
                    $get_marks=$exam_result_value->  get_marks ; 
                    
                    if($get_cmarks<$mincmarks)
                    {
                    $checkc_result="0";
                    }
                    
                    else
                    {
                    $checkc_result="1";
                    }
                    
                    if($get_marks<$minmarks)
                    {
                    $check_result="0";
                    }
                    else
                    {
                    $check_result="1";
                    }
                    
                    if($checkc_result=='1' && $check_result=='1')
                    {
                    
                    $ret="Pass";
                    
                    }
                    else
                    {
                    $ret="Fail";
                    }
                    $array_push[]= $ret;
                    ?>
                    </td>
                    </tr>
                    <?php 
                    } 
                    ?>
                    </table>
                    </div>
                    
                    <br>
                    <div>
                    
                    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
                    <thead>
                    <tr>
                    
                    <?php
                    
                    $percentage=$grandobtainedtotal/$grandmaxtotal*100;
                    $perc= number_format((float)$percentage, 2, '.', '');
                    if($perc>=80)
                    {
                    $clas="First";
                  
                    }
                    elseif($perc>=50 && $perc<=79)
                    {
                    $clas="Second ";
                    }
                    
                    elseif($perc>=35 && $perc<=50)
                    {
                    $clas="Third ";
                    }
                    
                    else
                    {
                    $clas="";
                    }
                    ?>
                    <td>Result:<?php
                    if(in_array('Fail', $array_push))
                    {
                    $result_status="Fail";
                    }
                    else
                    {
                    $result_status="Pass";
                    }
                    
                    echo $result_status;
                    ?>
                    
                    </td>
                    <td>Division:<?php echo $clas; ?></td>
                    <td>Percentage:
                    <?php
                    echo number_format((float)$percentage, 2, '.', '');
                    ?>%</td>
                    <td>Total:<?php     echo number_format((float)$grandobtainedtotal, 2, '.', ''); ?></td>
                    </tr>
                    </thead>
                    </table>
                    </div>
                    <br>
                    
                    <div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
                    <thead>
                    <tr>
                    <td class="headerclass">A+:90% & Above</td>
                    <td class="headerclass">A:80% -89%</td>
                    <td class="headerclass">B+:70% -79%</td>
                    <td class="headerclass">B:60% -69%</td>
                    <td class="headerclass">C+:50% -59%</td>
                    </tr>
                    </thead>
                    <tr>
                    <td>C:40% - 49%</td>
                    <td>D+:30% -39%</td>
                    <td>D:20% -29%</td>
                    <td>E+:10% -19%</td>
                    <td>E:0%-9%</td>
                    </tr>
                    </table>
                    <p>Division:80% & above=First Class with distinction,50%-79%=Second Class,35%-50%=Third Class</p>
                    </div>
                    </td>
                    </tr>
                    </table>
                    <?php
                    
                      
                    }
                    ?>
                  
                    <br>
                    <br>
                    
                    
                    <table  style=" border: 1px solid #000;
                    text-align: left; width: 100%;">
                    <thead>
                    
                    <tr style="background-color:#c5cac5"><td><b>Our Terms And Conditions</b></td></tr>
                    
                    <tr><td>&nbsp;</td></tr>
                    
                    </thead>
                    <tbody>
                    
                  
                    <tr>
                    <td>Application Fee  :   <i class="fa fa-rupee"></i>
                    
                    <?php
                    if($improvement_feecharge_ce['examfees_charge_fees_charge']!="")
                    {
                    echo $improvement_feecharge_ce['examfees_charge_fees_charge'].''.'/Paper';
                    }
                    else
                    {
                    echo "0";
                    }
                    ?>
                    
                    </td>
                    <td>
                    </td>
                    </tr>
                    
                    
                    <tr>
                    <td>&nbsp;</td>
                    <td>
                    </td>
                    </tr>
                   
                    
                    <tr>
                    <td>Processing Charge : <i class="fa fa-rupee"></i>
                    
                    <?php
                    if($improvement_feecharge_ce['examfees_charge_processing_charge']!="")
                    {
                    echo $improvement_feecharge_ce['examfees_charge_processing_charge'];
                    }
                    else
                    {
                    echo "0";
                    }
                    ?>
                    </td>
                    <td>
                    </tr>
                    <tr>
                    <td>Fine Charge : <i class="fa fa-rupee"></i>
                    
                    <?php
                    if($improvement_feecharge_ce['examfees_charge_fine']!="")
                    {
                    echo $improvement_feecharge_ce['examfees_charge_fine'];
                    }
                    else
                    {
                    echo "0";
                    }
                    ?>
                    </td>
                    <td>
                    </tr>
                    <tr>
                    <td>Effective Date : <i class="fa fa-calendar"></i>
                    
                    <?php
                    if($improvement_feecharge_ce['examfees_charge_effectivedate']!="")
                    {
                    echo $improvement_feecharge_ce['examfees_charge_effectivedate'];
                    }
                    else
                    {
                    echo "00:00:0000";
                    }
                    ?>
                    </td>
                    <td>
                    
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    
                    <br>
                    <br>
                    
                    <table>
                    <tr>
                    <td><input type="checkbox" name="declaration" required="required">&nbsp;
                    I hereby declare that I have gone through all the above instructions carefully and have followed due procedure while filling online examination form. If any of my information is found to be false in the future, I will have no right to claim for appearing in the examination,declaration of results,and refund of examination fee. I shall abide by the rules and regulations of the Institute.I assure you that I will not indulge myself in any unfair activities relating to the Semester Examination of the Institute.In case found to be indulged in any unfair means activities at my stage,action may be taken.</td>
                    </tr>
                    </table>
                    <br>
                    <br>
                    <?php  
                    if($sayexam_approval['exam_group_exam_sayexam_approvedstatus']>=0)
                    {
                    ?>
                    <table style="height:50%;">                        
                    <tr><td><input type="submit" name="submit" value="Apply For Improvement" onclick="return doconfirm();" class="btn btn-primary pull-right btn-sm checkbox-toggle"/></td></tr>
                    </table>
                    <?php
                    }
                    elseif($sayexam_approval['exam_group_exam_sayexam_approvedstatus']==1)
                    {
                    ?>
                    <table style="height:50%;">                        
                    <tr><td><input type="button" name="button" value="Applied" class="btn btn-success pull-right btn-sm checkbox-toggle"/></td></tr>
                    </table>
                    
                    <?php }
                    else
                    {
                    ?>
                    <table style="height:50%;">                        
                    <tr><td><input type="button" name="button" value="Updated" class="btn btn-warning pull-right btn-sm checkbox-toggle"/></td></tr>
                    </table>
                    <?php } ?>
                    </form>
                    </div>
                    
                    <?php
                    }
                    else
                    {
                    ?>
                           <!--Result not Declared-->
                    
                    <?php
                    }
                    
                    
                    
                    }
                    }
                    }
                    }
                    }
                    else
                    {
                    ?>
                    <div class="box-body">
                        
                    <div style="width:100%">
                    <span>
                    <h5 style="text-align:center">IMPROVEMENT STATUS </h5>
                    </div>
                    
                    <form method="post" action="<?php echo base_url('user/improvement/printimprovement') ?>" id="printMarksheet">
                    <input type="hidden" id="examgroup" name="examgroup" value="<?php  echo $exam_group_exam_results_exam_idd;  ?>"  >
                    <input type="hidden" id="examgroupbatch" name="examgroupbatch" value="<?php  echo $exam_group_exam_results_exam_groupidd;  ?>"> 
                    <input type="hidden" id="session_id" name="session_id" value="<?php  echo $exam_session_id;  ?>"> 
                    <input type="hidden" id="class_id" name="class_id" value="<?php  echo $exam_class_id;  ?>"> 
                    <input type="hidden" id="section_id" name="section_id" value="<?php  echo $exam_section_id;  ?>">
                    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
                    <thead>
                    <tr>
                    <th class="headerclass">No</th>
                    <th  class="headerclass"><b>Description</b></th>
                    <th class="headerclass"><b>Amount</b></th>
                    </tr>
                    </thead>
                    <tr>
                    <td>1</td>
                    <td>Application Fees</td>
                    <td><?php echo $improvement_feecharge_ce['examfees_charge_processing_charge']; ?></td>
                    </tr>
                    <?php
                    $obtainedtotal=0;
                    $maxtotal=0;
                    $singlepercentage=0;
                    $count=2;
                    $feetotal=0;
                    $feegrandtotal=0;
                    //$totalfee="500";
                    
                    $totalfee= $improvement_feecharge_ce['examfees_charge_fees_charge'];
                    
                    $totalamt="0";
                    
                    foreach($improvement_marks as $say)
                    {
                    ?>
                    <tr>
                    
                    <td><?php echo $count; ?></td>
                    <td><?php echo $say['code'];  ?></td>
                    
                    <td><?php echo number_format($totalfee,2);  ?></td>
                    </tr>
                    <?php
                    $count++;
                    $totalamt+=   $totalfee;
                    } 
                    ?>
                    <tr><td colspan="2" style="text-align:right;padding-right:20px"><b>Total Amount</b></td>
                    
                    <td colspan="2"><b><?php   $tot=$totalamt+$improvement_feecharge_ce['examfees_charge_processing_charge']; 
                    echo number_format($tot,2);?></b></td>
                    </tr>
                    </table>
                    <br> 
                    <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
                    <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
                    <input type="checkbox" style="visibility:hidden" class="checkbox center-block" checked="checked"  name="exam_group_class_batch_exam_student_id[]" data-student_id="<?php  echo $student_session_id; ?>" value="<?php  echo $student_session_id; ?>" />
                    <input type="submit" name="submit" value="Already Paid" class="btn btn-warning pull-right btn-sm checkbox-toggle"/>&nbsp;&nbsp;
                    <input type="submit" name="submit" value="Print Improvement" class="btn btn-success pull-right btn-sm checkbox-toggle" style="margin-right:10px;"/>
                    </form>
                    </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                    
                    <?php
                    function findGrade($exam_grades, $percentage) {
                    
                    if (!empty($exam_grades)) {
                    foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {
                    
                    if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                    return $exam_grade_value->name;
                    }
                    }
                    }
                    
                    return "-";
                    }
                    
                    function findGradePoints($exam_grades, $percentage) {
                    
                    if (!empty($exam_grades)) {
                    foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {
                    
                    if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                    return $exam_grade_value->point;
                    }
                    }
                    }
                    
                    return 0;
                    }
                    
                    function examTotalResult($array) {
                    $return_array = array('max_marks' => 0, 'min_marks' => 0, 'credit_hours' => 0, 'get_marks' => 0, 'exam_result' => true);
                    if (!empty($array)) {
                    $max_marks = 0;
                    $min_marks = 0;
                    $credit_hours = 0;
                    $get_marks = 0;
                    $exam_result = true;
                    foreach ($array as $array_key => $array_value) {
                    if ($array_value->attendence == "absent") {
                    $exam_result = false;
                    }
                    $max_marks = $max_marks + $array_value->max_marks;
                    $min_marks = $min_marks + $array_value->min_marks;
                    $credit_hours = $credit_hours + $array_value->credit_hours;
                    $get_marks = $get_marks + $array_value->get_marks;
                    }
                    $return_array = array('max_marks' => $max_marks, 'min_marks' => $min_marks, 'credit_hours' => $credit_hours, 'get_marks' => $get_marks, 'exam_result' => $exam_result);
                    }
                    return json_encode($return_array);
                    }
                    
                    function getWeightageExam($exam_connection_list, $examid, $get_marks) {
                    
                    foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
                    if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                    return ($get_marks * $exam_connection_value->exam_weightage) / 100;
                    }
                    }
                    return "";
                    }
                    ?>
                    
                    
                    
                    
                    </div>
                    
                    </div>
                    
                    </section>
                    </div>
                    
                    
                    
                    <script type="text/javascript">
                    function doconfirm()
                    {
                    job=confirm("Do you Want to Continue");
                    if(job!=true)
                    {
                    return false;
                    }
                    }
                    
                    
                    function toggle(source) {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
                    }
                    }
                    
                    
                    function getexam_id()
                    {
                        
                    var exam_id           = $('#exam_id').val();
                    //var exam_groupid       = $('#exam_groupid').val(); 
                    
                    
                    // $('#exam_idd').val(exam_id);
                    //$('#exam_groupidd').val(exam_group_id);
                    $('#exam_group_class_batch_exam_student_id').val("");
                    $.ajax({
                    type: "POST",   
                    data: {exam_id: exam_id},  
                    dataType:"JSON",
                    url: "<?php echo site_url('user/sayexam/getstudentbatch_id');?>",
                    success:function(result)
                    {
                    
                    $('#exam_group_class_batch_exam_student_id').val(result['id']);
                    
                    // $('#exam_group_class_batch_exam_print_studentid').val(result['id']); 
                    
                    }
                    });
                    }
                    
                    
                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
                    var class_id = '<?php echo set_value('class_id') ?>';
                    var section_id = '<?php echo set_value('section_id') ?>';
                    var session_id = '<?php echo set_value('session_id') ?>';
                    var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
                    var exam_id = '<?php echo set_value('exam_id') ?>';
                    getSectionByClass(class_id, section_id);
                    getExamByExamgroup(exam_group_id, exam_id);
                    
                    $(document).on('change', '#exam_group_id', function (e)
                    {
                    $('#exam_id').html("");
                    var exam_group_id = $(this).val();
                    getExamByExamgroup(exam_group_id, 0);
                    });
                    
                    $(document).on('change', '#class_id', function (e) {
                    $('#section_id').html("");
                    var class_id = $(this).val();
                    getSectionByClass(class_id, 0);
                    });
                    
                    
                    
                    function getSectionByClass(class_id, section_id)
                    {
                    if (class_id != "") {
                    $('#section_id').html("");
                    var base_url = '<?php echo base_url() ?>';
                    //var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                    
                    $.ajax({
                    type: "GET",
                    url: base_url + "user/user/getByClass",
                    data: {'class_id': class_id},
                    dataType: "json",
                    beforeSend: function () {
                    $('#section_id').addClass('dropdownloading');
                    },
                    success: function (data) {
                    $.each(data, function (i, obj)
                    {
                    var sel = "";
                    if (section_id == obj.section_id) {
                    sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                    },
                    complete: function () {
                    $('#section_id').removeClass('dropdownloading');
                    }
                    });
                    }
                    } 
                    
                    
                    
                    
                    
                    function getExamByExamgroup(exam_group_id, exam_id) 
                    {
                    if (exam_group_id != "")
                    {
                    $('#exam_id').html("");
                    var base_url = '<?php echo base_url() ?>';
                    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                    
                    $.ajax({
                    type: "POST",
                    url: base_url + "user/user/getExamByExamGroup_publish_result",
                    data: {'exam_group_id': exam_group_id},
                    dataType: "json",
                    beforeSend: function () {
                    $('#exam_id').addClass('dropdownloading');
                    },
                    success: function (data) {
                    $.each(data, function (i, obj)
                    {
                    var sel = "";
                    if (exam_id == obj.id) {
                    sel = "selected";
                    }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                    },
                    complete: function () {
                    $('#exam_id').removeClass('dropdownloading');
                    }
                    });
                    }
                    }
                    
                    </script>
                    
                    <script>
                    
                    $(document).on('submit', 'form#printMarksheet', function (e) {
                    e.preventDefault();
                    var form = $(this);
                    var subsubmit_button = $(this).find(':submit');
                    var formdata = form.serializeArray();
                    var list_selected =  $('form#printMarksheet input[name="exam_group_class_batch_exam_student_id[]"]:checked').length;
                    if(list_selected > 0)
                    {
                    $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: formdata, // serializes the form's elements.
                    dataType: "JSON", // serializes the form's elements.
                    beforeSend: function () {
                    subsubmit_button.button('loading');
                    },
                    success: function (response)
                    {
                    // alert(response);
                    Popup(response.page);
                    },
                    error: function (xhr) { // if error occured
                    
                    alert("Error occured.please try again");
                    subsubmit_button.button('reset');
                    },
                    complete: function () {
                    subsubmit_button.button('reset');
                    }
                    });
                    }
                    else
                    {
                    confirm("<?php echo $this->lang->line('please_select_student'); ?>");
                    }
                    });
                    
                    
                    $(document).on('click', '#select_all', function () {
                    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
                    });



                     var baseUrl = '<?php echo base_url() ?>';
                     function Popup(data) {
                     var printWindow = window.open('', '_blank');
                     printWindow.document.open();
                     printWindow.document.write('<html>');
                     printWindow.document.write('<head>');
                     printWindow.document.write('<title>Exam Result</title>');

                     printWindow.document.write('</head>');
                     printWindow.document.write('<body>');
                     printWindow.document.write(data);
                     printWindow.document.write('</body>');
                     printWindow.document.write('</html>');
                     printWindow.document.close();
                     printWindow.onload = function () {
                     printWindow.focus();
                     printWindow.print();
                     // printWindow.close();
                     };
                     return true;
                     }
                    
                   
              //       var base_url = '<?php echo base_url() ?>';
                    
              //       function Popup(data)
              //       {
              //       var frame1 = $('<iframe />');
              //       frame1[0].name = "frame1";
              //       $("body").append(frame1);
              //       var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
              //       frameDoc.document.open();
              //       //Create a new HTML document.
              //       frameDoc.document.write('<html>');
              //       frameDoc.document.write('<head>');
              //       frameDoc.document.write('<title></title>');
              //       frameDoc.document.write('</head>');
              //       frameDoc.document.write('<body>');
              //       frameDoc.document.write(data);
              //       frameDoc.document.write('</body>');
              //       frameDoc.document.write('</html>');
              //       frameDoc.document.close();
              //       setTimeout(function () {
              //       window.frames["frame1"].focus();
              //       window.frames["frame1"].print();
              //       frame1.remove();
              //       }, 500);
              //       return true;
              //       }
                    
                    </script>