        <style>
        .denifittable th{}
        .denifittable th,
        .denifittable td {border: 1px solid #fffff;
         border-collapse: collapse;border-left: 1px solid #fffff;}
        .denifittable tr th {padding: 8px 0px;  font-size: 12px}
        .denifittable tr td {padding: 8px 0px; font-weight: normal; font-size: 12px}
        </style>

        
        <div class="content-wrapper" style="min-height: 946px;">
        <section class="content-header">
        <h1>
        <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('exam'); ?></small>  
        </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="row">
        <div class="col-md-12">
            
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
        </div>
        
        <div class="box-body">
        <form role="form" action="<?php echo site_url('admin/examresult') ?>" method="post" >
        <?php echo $this->customlib->getCSRF(); ?>
        <div class="row">
        <div class="col-sm-6 col-lg-3 col-md-3 col20">
        <div class="form-group">
        <label><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req"> *</small>
        <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control select2" >
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
        <!--./col-md-3-->    
        <div class="col-sm-6 col-lg-3 col-md-3 col20">
        <div class="form-group">
        <label><?php echo $this->lang->line('exam') ?></label><small class="req"> *</small>
        <select  id="exam_id" name="exam_id" class="form-control select2" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
        </div>
        </div>
        <!--./col-md-3-->
        
        
        <div class="col-sm-6 col-lg-3 col-md-3 col20">
        <div class="form-group">
        <label><?php echo $this->lang->line('session'); ?></label><small class="req"> *</small>
        <select  id="session_id" name="session_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        
       
        
        foreach ($sessionlist as $session) {
        ?>
        <option value="<?php echo $session['id'] ?>" <?php
        if ($current_session == $session['id']) {
        echo "selected=selected";
        }
        ?>><?php echo $session['session'] ?></option>
        <?php
        }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('session_id'); ?></span>
        </div>
        </div>
        <!--./col-md-3-->
        <div class="col-sm-6 col-lg-3 col-md-12 col20">
        <div class="form-group">
        <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
        <select id="class_id" name="class_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        foreach ($classlist as $class) {
        ?>
        <option value="<?php echo $class['id'] ?>" <?php
        if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
        }
        ?>><?php echo $class['class'] ?></option>
        <?php
        }
        ?>
        </select>
        
        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
        </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-md-12 col20">
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
        <select  id="section_id" name="section_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group">
        <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
        </div>
        </div>
        </div>
        </form>
        </div>
        <br>
       
        <?php
        
        
        if (isset($getrolebased) && !empty($getrolebased)) { ?>
        
        <?php
        $is_publish = $getrolebased['is_publish'];
        if ($is_publish == 1 || ($is_publish == 0 && $role == 'Super Admin')) { 
    
     
        // if($role=='Super Admin')
        // {
      
        // if(!empty($getrolebased) && $role=='Super Admin')
        // {
        ?>
        <a href="javascript:void(0);" onclick="printPage();">
            
        <i class="btn btn-primary pull-right btn-sm checkbox-toggle  fa fa-print" style="font-size:20px;">Print</i></a>
        
        <div id="form_duplicate" style="visibility:hidden;" >
            
        <form method="post" action="<?php echo base_url('admin/examresult/printexamresult') ?>" id="printMarksheet">
        <input type="hidden" name="marksheet_template" value="1">
        <input type="hidden" name="marksheet_Newexamgroup" value="<?php   echo $Exam_group_list->name;   ?>">
        <input type="hidden" name="marksheet_Newexambatch" value="<?php   echo $Exam_group_list->exam;   ?>">
        <div class="box-body"  >
        <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
        <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
        <div class="tab-pane active table-responsive no-padding" id="tab_1">
        <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
        <?php
        if (empty($studentList)) {
        ?>
        <?php
        } 
        else 
        {
        $count = 1;
        $sl    = 1;
        $p     = 0;
        $f     = 0;
        $ftot  = array();
        foreach ($studentList as $student_key => $student_value)
        {
        $result_status           = 1;
        $no_subject_result       = 0;
        $result_status_cmark     = 1;
        $no_subject_result_cmark = 0;
        ?>
        <?php
        if (!empty($subjectList)) 
        {
        $total_marks          = 0;
        $total_cmarks         = 0;                                                  
        $get_marks            = 0;
        $get_cmarks           = 0;
        $get_percentage       = 0;
        $total_credit_hour    = 0;
        $total_quality_point  = 0;
        $finalTotal           = 0; 
        $lastTotal            = 100;
        $rank                 = 1;
        $getcmarkk = 0;
        $mincmarkk = 0;
        $getmarkk  = 0;
        $minmarkk  = 0;
        $result    = 0;
        $finaltotal_percentage= 0;
        $total                = 0;
        $prev_rank            = $rank; 
        foreach ($subjectList as $subject_key => $subject_value)
        {
        
        $subject_status  = 1;
        
        $total_marks     = $total_marks + $subject_value->max_marks;
        $total_cmarks    = $total_cmarks + $subject_value->max_cmarks;
        $result          = getSubjectMarks($student_value->subject_results, $subject_value->subject_id);
        $total           = $result->get_marks+$result->get_cmarks;  
        $max_tot_marks   = $subject_value->max_cmarks+$subject_value->max_marks;
        $min_tot_marks   = $subject_value->min_cmarks+$subject_value->min_marks;
        $finalTotal+=$total;
        $grade           = $total/$max_tot_marks*100;
        $floatgrade      = number_format((float)$grade, 2, '.', '');
        ?>
        <?php
        $getcmarkk = $result->get_cmarks;
        $mincmarkk = $subject_value->min_cmarks;
        $getmarkk  = $result->get_marks;
        $minmarkk  = $subject_value->min_marks;
        
        
        echo  $result->get_cmarks; ?> 
       
        <td style="text-align:center; background-color:<?php  echo  $stylebackground;  ?>"><?php    echo $result->get_marks; ?></td>
        <td style="text-align:center; background-color:<?php  echo  $stylebackground;  ?>"><b><?php echo number_format((float)$total, 1, '.', ''); ?></b></td> 
        <td style="text-align:center; background-color:<?php  echo  $stylebackground;  ?>; border-collapse: collapse;border-right: 2px solid #000;">
        
        <?php 
        echo $fgde;
        ?>
        
        
        <?php } }   ?>

        
        <?php
        
        $floatfinaltot= number_format((float)$finalTotal, 1, '.', '');
        
        $ftot[]= number_format((float)$finalTotal, 1, '.', '');
        
        
        echo $floatfinaltot;
        
        $finaltotal_percentage= $floatfinaltot/$totmax_marks_dup *100; ?> 
        
        
        <?php
        echo number_format((float)$finaltotal_percentage, 2, '.', '');                                                        
        ?>
        </b>%        <?php 
        
        $sl++;  } }
        
        
        ?>
        </div>
        </div>
        </form>
        </div>
        
        <form method="post" action="<?php echo base_url('admin/examresult/printexamresult') ?>" id="printMarksheet">
        <input type="hidden" name="marksheet_template" value="1">
        <input type="hidden" name="marksheet_Newexamgroup" value="<?php   echo $Exam_group_list->name;   ?>">
        <input type="hidden" name="marksheet_Newexambatch" value="<?php   echo $Exam_group_list->exam;   ?>">
        <input type="hidden" name="marksheet_session" value="<?php echo $get_session['session']; ?>">
        <input type="hidden" name="marksheet_class" value="<?php  echo $get_class['class'];   ?>">
        <input type="hidden" name="marksheet_section" value="<?php echo $get_section['section'];   ?>">
        <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
        <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
        <div class="box-body">
        <div class="table-responsive mailbox-messages">
        <div class="download_label"><?php    echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
        
        
        <table class="table table-striped  example denifittable" id="testing" border="2" cellspacing="0" width="100%">
        <thead>
        <tr>
        <th>
        <b>
        <button  class="btn btn-success btn-sm printSelected pull-right" type="submit" name="generate" title="generate multiple certificate">Generate </button></b>
        </th>                                                    
        <th>Sl.No</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Institution Id&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th style="border-collapse: collapse;border-right: 2px solid #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        
        <?php
        $min_tot_marks=0;
        $max_tot_marks=0;
        
        if (!empty($subjectList))
        {
        $totmax_marks=0;
        
        
        foreach ($subjectList as $subject_key => $subject_value) 
        {
        ?>
        <!--<th colspan="5"><b><?php echo $subject_value->subject_name; ?></b></th>-->
        <th><?php echo $subject_value->subject_name; ?></th>
        <th></th>
       <th></th>
       <th></th>
       <th></th>
        <?php 
        }  
        }
        ?>
        <th style="text-align:center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;</b></th>
        <th style="text-align:center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
        <th style="text-align:center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;Result&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
        <th style="text-align:center;"><b>&nbsp;&nbsp;&nbsp;&nbsp;Rank&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
        </tr>
        </thead>
        <tbody> 
        <tr>
        <td >  <input type="checkbox" id="select_all" /></td> 
        <td>&nbsp;</td>   
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="border-collapse: collapse;border-right: 2px solid #000;">&nbsp;</td>
        <?php
        if (!empty($subjectList)) {
        foreach ($subjectList as $subject_key => $subject_value) 
        {
        ?>
        <td style="text-align:center"><b>&nbsp;&nbsp;&nbsp;&nbsp;CE&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        <td style="text-align:center"><b>&nbsp;&nbsp;&nbsp;&nbsp;TE&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        <td style="text-align:center"><b>&nbsp;&nbsp;&nbsp;&nbsp;TT&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        <td style="text-align:center;border-collapse: collapse;border-right: 2px solid #000;"><b>&nbsp;&nbsp;&nbsp;&nbsp;G&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        <td style="text-align:center;border-collapse: collapse;border-right: 2px solid #000;"><b>Result</b></td>
        <?php 
        }  
        }
        ?>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="border-collapse: collapse;border-right: 2px solid #000;">&nbsp;</td>
        <?php
        
        
        
        foreach ($subjectList as $subject_key => $subject_value)
        {
        ?>  
        
        <td style="text-align:center;"><b>&nbsp;&nbsp;<?php echo $subject_value->max_cmarks;?>&nbsp;&nbsp;</b></td>
        <td style="text-align:center;"><b>&nbsp;&nbsp;<?php echo $subject_value->max_marks;?>&nbsp;&nbsp;</b></td>
        <td style="text-align:center;"><b>&nbsp;&nbsp;<?php  $ttmarks=$subject_value->max_cmarks+$subject_value->max_marks;
        
        
        echo number_format((float)$ttmarks, 2, '.', ''); 
        
        $totmax_marks+=$subject_value->max_cmarks+$subject_value->max_marks;
        $totmin_marks+=$subject_value->min_cmarks+$subject_value->min_marks;
        ?>
        
        &nbsp;&nbsp;</b></td>
        <td style="text-align:center;border-collapse: collapse;border-right: 2px solid #000;">&nbsp;</td>
        <td style="text-align:center;border-collapse: collapse;border-right: 2px solid #000;">&nbsp;</td>
        <?php
        }
        ?>
        
        <td style="text-align:center;"><b><?php    echo number_format((float)$totmax_marks, 2, '.', '');    ?></b></td>
        <td style="text-align:center;" ><b>100</b></td>
        <td>res</td>
        <td><b><i class="fa fa-list"></i></b></td>
        </tr>
        <?php
        if (empty($studentList)) {
        ?>
        <?php
        } 
        else 
        {
        $count = 1;
        $sl    = 1;
        //$rank  = 1;
        
        //$rank = $previous = 0;
        
        foreach ($studentList as $student_key => $student_value)
        {
        $result_status = 1;
        $no_subject_result = 0;
        $result_status_cmark = 1;
        $no_subject_result_cmark = 0;
        ?>
        
        <tr  class="ro2">
        <td class="text-center">
        &nbsp;<input type="checkbox" class="checkbox center-block"  name="exam_group_class_batch_exam_student_id[]" data-student_id="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>" value="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>">
        </td>
        
        <td style="text-align:center;"><?php echo $sl; ?></td>
        <td class="text-center"><?php echo $student_value->admission_no; ?></td>
        <td class="text-center"><?php echo $student_value->roll_no; ?></td>
        
        
        <td class="text-center;" style="border-collapse: collapse;border-right: 2px solid #000;"><a href="<?php echo base_url(); ?>student/view/<?php echo $student_value->student_id; ?>"><?php echo $this->customlib->getFullName($student_value->firstname,$student_value->middlename,$student_value->lastname,$sch_setting->middlename,$sch_setting->lastname); ?>
        </a></td>
        
        
        <?php
        if (!empty($subjectList)) {
        
        $total_marks = 0;
        $total_cmarks = 0;                                                  
        $get_marks = 0;
        $get_cmarks=0;
        $get_percentage = 0;
        $total_credit_hour = 0;
        $total_quality_point = 0;
        $finalTotal=0; 
        $lastTotal=100;
        $rank = 1;
        $finaltotal_percentage=0;
        //$ranklist=array(); 
        
        
        $getcmark=0;
        $mincmark =0;
        $getmark =0;
        $minmark = 0;
        $floatfinaltot=0;
        $getgrndtotal=0;
        
        $fgde="";
        $grade ="";
        $getresult = array();
        $cart   = array();
        
        
        foreach ($subjectList as $subject_key => $subject_value)
        {
        $subject_status     = 1;
        $total_marks        = $total_marks + $subject_value->max_marks;
        $total_cmarks       = $total_cmarks + $subject_value->max_cmarks; 
        $result             = getSubjectMarks($student_value->subject_results, $subject_value->subject_id);
        $total              = $result->get_marks+$result->get_cmarks; 
        $max_tot_marks      = $subject_value->max_cmarks+$subject_value->max_marks;
        
        $resval=array();
        $status_subject=array();
        $finalTotal+=$total;
        
        $grade          = $total/$max_tot_marks*100;
        
        $floatgrade    = number_format((float)$grade, 2, '.', '');
        
        ?>
        
        <?php   
        
        $getcmark= $result->get_cmarks;
        $mincmark =$subject_value->min_cmarks;
        $getmark = $result->get_marks;
        $minmark = $subject_value->min_marks;
        
        
        if($floatgrade<=100 && $floatgrade>=90)
        {
        $fgde="A+" ;
        }
        
        elseif($floatgrade<=89 && $floatgrade>=80)
        {
        $fgde="A";
        }
        elseif($floatgrade<=79 && $floatgrade>=70)
        {
        $fgde="B+";
        }
        elseif($floatgrade<=69 && $floatgrade>=60)
        {
        $fgde="B";
        }
        elseif($floatgrade<=59 && $floatgrade>=50)
        {
        $fgde="C+";
        }
        elseif($floatgrade<=49 && $floatgrade>=40)
        {
        $fgde="C";
        }
        elseif($floatgrade<=39 && $floatgrade>=30)
        {
        $fgde="D+";
        }
        elseif($floatgrade<=29 && $floatgrade>=20)
        {
        $fgde="D";
        }
        elseif($floatgrade<=19 && $floatgrade>=10)
        {
        $fgde="E+";
        }
        elseif($floatgrade<=9 )
        {
        $fgde="E";
        } 
        
        if($section_id==7)
        {
        if($fgde=="E" || $fgde=="E+")
        {
        $stylebackground="yellow";
        }
        else
        {
        $stylebackground="";
        } 
        }
        else
        {
        if($fgde=="D+" || $fgde=="D" || $fgde=="E" || $fgde=="E+")
        {
        $stylebackground="yellow";
        }
        else
        {
        $stylebackground="";
        }
        }
        if($getcmark < $mincmark )
        {
        $stylebackground_sty="yellow";   
        }
        else
        {
        $stylebackground_sty="";  
        }
        
        
        if($getmark < $minmark)
        {
        $stylebackground_styo="yellow";   
        }
        else
        {
        $stylebackground_styo="";  
        }
        ?>
        <td style="text-align:center;background-color:<?php  echo   $stylebackground_sty;  ?>"><?php echo  $result->get_cmarks; ?> </span> </td>
        <td style="text-align:center;background-color:<?php  echo   $stylebackground_styo;  ?> "><span style="text-align:center; background-color:<?php  echo  $stylebackground_sty;  ?>"><?php    echo $result->get_marks; ?></span></td>
        <td style="text-align:center;background-color:<?php  echo   $stylebackground;  ?> "><span style="text-align:center; background-color:<?php  echo  $stylebackground_sty;  ?>"><b><?php echo number_format((float)$total, 2, '.', ''); ?></b></span></td> 
        <td style="text-align:center; background-color:<?php  echo  $stylebackground;  ?>; border-collapse: collapse;border-right: 2px solid #000;"><span style="text-align:center; background-color:<?php  echo  $stylebackground;  ?>"><b>
        <?php 
        echo $fgde;
        ?>
        
        </b>
        </span>
        
        <?php
        
        if($getcmark < $mincmark || $getmark < $minmark)
        {
            
        $res        ="Failed";
        $stylesta   ="yellow";
        }
        else
        {
            
        $res        = "Passed";
        $stylesta   = "";
        }
        
        
        ?>
        </td>
        
        <td style="text-align:center;border-collapse: collapse;border-right: 2px solid #000; background-color:<?php echo $stylesta;  ?>"><b>
        
        
        <?php 
        echo $res;
        $getresult[] = $res;
        ?></b></td>
        <?php } } 
         ?>
         
        <td style="text-align:center;"><b>
        
        <?php
        $floatfinaltot= number_format((float)$finalTotal, 2, '.', '');
        
        echo $floatfinaltot;
        $getgrndtotal+=$floatfinaltot;
        $finaltotal_percentage= $floatfinaltot/$totmax_marks *100; ?> 
        
        </b>
        </td>
        
        <td style="text-align:center;"><b>
        <?php
        echo number_format((float)$finaltotal_percentage, 2, '.', '');                                                        
        ?>
        </b>%</td>
             <td>
            <?php
            if (in_array("Failed", $getresult)) 
            {
            $subjectres= "Failed";
            $f++;
            } 
            else
            {
            $subjectres= "Passed";
            $p++;
            }
            echo $subjectres;
            ?>
            </td>
            
           
        
        <td style="text-align:center;">
        <?php
        $marks=$ftot;
        rsort($marks);
        $narr = array_count_values($marks);
        $y=1;
        foreach($narr as $k=>$v)
        {
        $i=1;
        while($i<=$v)
        {
        
        
        if($floatfinaltot==$k)
        {
        ?>
        <span style="font-size:15px;"><b><?php   echo $y ;  ?></b></span>
        <?php
        break;
        }
        $i++;
        }
        $y++;
        }
        ?>
        </td>
        </tr>
        <?php 
        $sl++; 
        }
        }
        ?>
        
        <tr style="border:3px !important; background-color:#f1f1f1; font-weight:bold;" >
        <!--<td colspan="3">-->
        <!--<b style="color:red;font-size:17px;"><b>Total Students:<?php echo $totalstudents ; ?></b>-->
        <!--</td>-->
         <td  style="font-size:17px; border-color:white !important; white-space: nowrap;"><b>Total Students:<?php echo $totalstudents ; ?></td>
         <td  style="font-size:17px; border-right:none !important;"></td>
         <td  style="font-size:17px;"></td>
         <td  style="font-size:17px;"><b>Passed:<?php echo $p; ?></b></td>
         <td  style="font-size:17px;"></td>
        
        
        
        <?php
        $subjectcount= count($subjectList);
        if (!empty($subjectList))
        {
        $totmax_marks=0;
        $slnumb=1;
        foreach ($subjectList as $subject_key => $subject_value) 
        { 
        ?>
        
        <td  style="font-size:17px;" ><b><?php if( $slnumb==1)
        {
        ?> Failed:<?php echo $f; 
        }
        if( $slnumb==2)
        {
          ?>
          <span style="color:red;">Passed:<?php  $per_passed = $p/$totalstudents*100;  echo number_format($per_passed,2); ?>% </span> 
        <?php
        }
        
        if( $slnumb==3)
        {
          ?>
          Failed:<?php  $per_failed          = $f/$totalstudents*100;  echo number_format($per_failed,2); ?>%  
        <?php }
        if($slnumb==4)
        {
            echo "Average";
        }
        ?></b></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <?php
        $slnumb++;
        }
        ?></b>
        <?php
        }
        ?>
        
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
      
        </form>
        <?php  } else {     ?>
        
        
        
        
        <div style="text-align: center; margin-top: 20px;">
    <span style="color: red; font-size: 20px;">
        Examination Results Not Declared <i class="fa fa-times-circle"></i>
    </span>
</div>
         <br>
         <br>
         <?php } }  ?>    
        <script type="text/javascript">
        function printPage()
        {
        var tableData = '<table border="1" align="center">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
        var data = '<button  onclick="window.print()">Print this page</button><br><br><b><?php   echo $Exam_group_list->name;   ?></b><?php echo "-"; ?>&nbsp;&nbsp;<b><?php   echo $Exam_group_list->exam;   ?><br><br><?php echo $get_class['class']; ?>&nbsp;&nbsp;<?php echo "-"; ?>&nbsp;&nbsp;<?php echo $get_section['section']; ?>&nbsp;&nbsp;<?php echo "-"; ?>&nbsp;&nbsp;<?php echo $get_session['session']; ?><br><br></b>'+tableData; 
        myWindow=window.open('','','width=800,height=600');
        myWindow.innerWidth = screen.width;
        myWindow.innerHeight = screen.height;
        myWindow.screenX = 0;
        myWindow.screenY = 0;
        myWindow.document.write(data);
        myWindow.focus();
        };
        </script>
        
        
        </div>
        </div>
        </div>
        </section>
        </div>
        <?php
        function getSubjectMarks($subject_results, $subject_id) {
        if (!empty($subject_results)) {
        foreach ($subject_results as $subject_result_key => $subject_result_value) {
        if ($subject_id == $subject_result_value->subject_id) {
        return $subject_result_value;
        }
        }
        }
        return false;
        }
        
        
        function get_ExamGrade($exam_grades, $percentage) {
        if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {
        
        if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
        return $exam_grade_value->name;
        }
        }
        }
        return "-";
        }
        
        
        
        function findGradePoints($exam_grades, $percentage) 
        {
        if (!empty($exam_grades)) 
        {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {
        
        if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
        return $exam_grade_value->point;
        }
        }
        }
        return 0;
        }
        ?>
        
        
        <script type="text/javascript">
        
        $(document).ready(function () 
        {
            
        $('#form_duplicate').hide();
        var ftotalval = <?php echo json_encode($ftot); ?>;
        $('#getarrayval').val(ftotalval);
        });
        
        $(document).ready(function () 
        {
        $('.select2').select2();
        });
        
        
        $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
        searching: true,
        ordering: true,
        paging: false,
        retrieve: true,
        destroy: true,
        info: false
        });
        });
        
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
        var class_id = '<?php echo set_value('class_id') ?>';
        var section_id = '<?php echo set_value('section_id') ?>';
        var session_id = '<?php echo set_value('session_id') ?>';
        var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
        var exam_id = '<?php echo set_value('exam_id') ?>';
        getSectionByClass(class_id, section_id);
        // getExamgroupByClassSectionSession(class_id, section_id, session_id);
        getExamByExamgroup(exam_group_id, exam_id);
        $(document).on('change', '#exam_group_id', function (e) {
        $('#exam_id').html("");
        var exam_group_id = $(this).val();
        getExamByExamgroup(exam_group_id, 0);
        });
        $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
        });
        
        function getSectionByClass(class_id, section_id) {
        
        if (class_id !== "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        
        
        $.ajax({
        type: "GET",
        url: base_url + "sections/getByClass",
        data: {'class_id': class_id},
        dataType: "json",
        beforeSend: function () {
        $('#section_id').addClass('dropdownloading');
        },
        success: function (data) {
        $.each(data, function (i, obj)
        {
        var sel = "";
        if (section_id === obj.section_id) {
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
        if (exam_group_id !== "") {
        $('#exam_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
        type: "POST",
        url: base_url + "admin/examgroup/getExamByExamgroup",
        data: {'exam_group_id': exam_group_id},
        dataType: "json",
        beforeSend: function () {
        $('#exam_id').addClass('dropdownloading');
        },
        success: function (data) {
        $.each(data, function (i, obj)
        {
        var sel = "";
        if (exam_id === obj.id) {
        sel = "selected";
        }
        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
        });
        
        $('#exam_id').append(div_data);
        $('#exam_id').trigger('change');
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
        
        </script>
        
        
        <script type="text/javascript">
        
        var base_url = '<?php echo base_url() ?>';
        function Popup(data)
        {
        
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
        }, 500);
        return true;
        }
        
        
        $(document).ready(function() {
    $('#example').DataTable();
} );

        </script>
    
        
        
       