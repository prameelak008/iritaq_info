    <style type="text/css">
    
    table{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000; }
    .tc-container{width: 100%;position: relative; text-align: center;margin-bottom:60px;padding-bottom: 5px;}
    .denifittable th{}
    .denifittable th,
    .denifittable td {border: 1px solid #000;
    border-collapse: collapse;border-left: 1px solid #999;}
    
    .denifittable tr th {font-size: 12px; font-weight: normal; width:10px; text-align:center;}
    .denifittable tr td { font-weight: normal; font-size: 12px;width:10px;}
    .draggable
    {
    cursor: move;
    width: 100%;
    height: 900px; /* Set a fixed height for vertical scrolling */
    overflow: auto;
    white-space: nowrap; /* Optional: Prevent content from wrapping */
    border: 1px solid #ccc;
    padding: 10px;
    }
    </style>
    
    
    <div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <h1>
    <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small><?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section> 
    <!-- Main content -->
    <section class="content">
    <?php $this->load->view('reports/_attendance'); ?>
    <div class="row">
    <div class="col-md-12">
    <div class="box removeboxmius">
    <div class="box-header ptbnull"></div>
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
    </div>
    
    <form id='form' action="<?php echo site_url('admin/subjectattendence/dayreportbymonthstudent') ?>"  method="post" accept-charset="utf-8">
    <div class="box-body">
    <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
    <?php echo $this->customlib->getCSRF(); ?>
    <div class="row">
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
    <select autofocus="" id="class_id" name="class_id" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    <?php
    foreach ($classlist as $class) 
    {
    ?>
    <option value="<?php echo $class['id'] ?>" <?php
    if (set_value('class_id') == $class['id']) {
    echo "selected =selected";
    }
    ?>><?php echo $class['class'] ?></option>
    <?php
    $count++;
    }
    ?>
    </select>
    <span class="text-danger"  style="background-color:green;"><?php echo form_error('class_id'); ?></span>
    </div>
    </div>
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
    <select  id="section_id" name="section_id" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    </select>
    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
    </div>
    </div>
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1">
    
    <?php echo $this->lang->line('month') ?>
    </label>
    
    <small class="req"> *</small>
    <select  id="month" name="month" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    <?php
    foreach ($monthlist as $m_key => $month) {
    ?>
    <option value="<?php echo $m_key ?>" <?php echo set_select('month', $month, set_value('month')) ?>><?php echo $month; ?></option>
    <?php
    }
    ?>
    </select>
    <span class="text-danger"><?php echo form_error('month'); ?></span>
    </div>
    </div>
    
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1">
    
    <?php echo $this->lang->line('year') ?>
    </label>
    <select  id="year" name="year" class="form-control" >
    <?php
    foreach ($yearlist as $y_key => $year) 
    {
    ?>
    <option value="<?php echo $year["year"] ?>"><?php echo $year["year"]; ?></option>
    <?php
    }
    ?>
    </select>
    <span class="text-danger"><?php echo form_error('year'); ?></span>
    </div>
    </div>
    <div class="col-md-12">
    <div class="form-group">
    <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
    </div>  
    </div>  
    </div>
    </div>
    </form>
    
    <?php
    if (isset($resultlist)) 
    {
    ?>
    <div class="">
    <div class="box-header ptbnull"></div>  
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>
    <div class="box-tools pull-right">
    </div>
    </div>
    <div class="box-body">
    <?php
    if (!empty($resultlist)) 
    {
        $totalcount= 0;
        $scounty   = 0;
        $scount    = 0;
        $currentDate = new DateTime();
        foreach ($leavemanagementleaves as $leave)
        {
        $leaveDate = new DateTime($leave['leave_catmanagement_date']);
        $dayOfWeek = $leaveDate->format('l'); 
        $leaveCounts[$dayOfWeek]++;
        }
        
        foreach ($leaveCounts as $leavecount => $countleavedays) 
        {
        echo "<td>";
        echo "$leavecount: $countleavedays   <br>";
        $leaveCountValues[$leavecount] = $countleavedays;
        echo "</td>";
        } 
        ?>
        
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
    <tr style="width:400px;">
    <td>LEAVECOUNT</td>
    
        <?php
        foreach ($leaveCounts as $leavecount => $countleavedays) 
        {
        echo "<td>";
        echo "$leavecount: $countleavedays   <br>";
        $leaveCountValues[$leavecount] = $countleavedays;
        echo "</td>";
        } 
        
      ?>
      </td>
      </tr>
      
      
      
      
      </table>
      
      <?php
      
       echo "----------------------------";
       echo"<br>";
       echo "MonthCount";
       echo "<br>";
       
        foreach ($wekdays as $day => $count) 
        {
        foreach ($tot_timetable_days as $tot) 
        {
        if ($tot['day'] == $day) 
        {
        
        // Check if the day exists in $leaveCountValues
        if (isset($leaveCountValues[$day]))
        {
        // Subtract leave count from monthday count
        $count -= $leaveCountValues[$day];
        }
        
        echo 'TIMETABLE COUNT: ' . $tot['count'] ;
        echo "************";
        echo  $day .''. $count . '<br>';
        echo "<br>";
         //$totalTimetableCount += $tot['count'];
         $workingdayscount += $count;
         $totalTimetableCount+=$tot['count']*$count;
        }
        }
        }
        
    $tot_workingdays     = $workingdayscount; 
    //$totalwd_percentage = $totalTimetableCount * $tot_workingdays;
    $totalwd_percentage= $totalTimetableCount;
    //echo $totalwd_percentage;
    
    ?>
    </br>
    </br>
    </br>
    
    <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></div>
    <div class="table-responsive">
    <input type='button' id='btn' class="btn btn-success pull-right btn-sm" value='Print  Table' onclick='printDiv();'> 
    <br>
    <br>
    
    <div class="draggable" id="scrollableContainer">
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable"  style="text-align: center;" width="85%;">
    <thead>   
    <tr>
    <td class="name" >Name</td>
    
    <td>
    <table cellpadding="0" cellspacing="0" width="100%"  style="text-align: center;">
        
    <tr style="width:400px;">
    <td style="text-align:left;border:none;colspan:<?php echo $no_of_days+5; ?>">&nbsp;
    <!--<td  style="border:none;  font-size:15px; font-weight:bold;" colspan="5">-->
     <?php
     foreach($leave_category as $leave)
     {
     echo  $leave['leave_category_name'] .':';  ?>
     <span style="color:<?php echo  $leave['leave_category_favcolor'];  ?>"> 
        
     <?php echo $leave['leave_category_shortname'].'&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
     </span>  
     <?php
     }
     ?>
    </td>

    
    </tr>
    </table>
    </td>
    <td>Total %</td>
    </tr>
    </thead>
    
    
    <tbody>
    <?php
    $frdate =    $year_val.'-'.$month_number.'-'.$from_date;
    $trdate =    $year_val.'-'.$month_number.'-'.$to_date;
    foreach($resultlist as $res)
    {
    $grandtotval     = 0;
    $totalpresentval = 0;   
    $grandtot        = 0;
    $totalpresent    = 0;
    $totalabs        = 0;
    $totalcls        = 0;
    ?>
    <tr>
    <td class="name">
    <?php  echo $res['firstname'].'&nbsp;'.$res['middlename'].'&nbsp;'.$res['lastname'];  
    echo "<br>";
    
    echo $res['admission_no'];
    echo "<br>";
    echo $res['roll_no'];
    ?>
    
    </td>
    <td>
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;" id="dragTable" >
    <tr style="width:400px;">
    <td style="border:none;">&nbsp;</td>
    <?php  for($i=1;$i<=$no_of_days-2;$i++) 
    { 
    ?>
    <td style="border:none;"></td><?php } ?>
    <td style="background-color:yellow;">TWP</td><td style="background-color:yellow;"><?php echo $totalwd_percentage;  ?></td><td style="background-color:yellow;">WD</td><td style="background-color:yellow;margin-left:2px;"><?php  echo $tot_workingdays;  ?></td><td style="background-color:yellow;">HD</td>
    <td style="background-color:yellow;">
    <?php  echo $leavemanagement['t']; ?></td>
    <td style="background-color:yellow;"></td>
    </tr>
    <tr style="width:400px; background-color:#d0cdcd;"><td><b>PERIOD</b></td>
    <?php 
    for($i=1;$i<=$no_of_days;$i++)
    {
        
    $date = sprintf("%04d-%02d-%02d", $year_no, $month_number, $i);
    $day_of_week = date('D', strtotime($date)); 
    ?>
    <td><b><?php  echo $i; echo "<br>"; echo $day_of_week; ?></b></td><?php
    } 
    ?>
    <td><b>%</b></td><td><b>P</b></td><td><b>A</b></td><td><b>H</b></td><td><b>C</b></td>
    </tr>
    <?php
    foreach($periodval as $per)
    {
    ?>
    <tr  style="width:400px;">
    <td class="pe">
    <?php 
    
    
    echo $per['periodic_table_name']; ?>
    </td>
    
    <?php
    
    for($i=1;$i<=$no_of_days;$i++)
    {
    ?>
    <td>
    <?php
    $arr          =    $res['sess_id'];
    $classid      =    $res['classid'];
    $sectionid    =    $res['sectionid'];
    $tdate        =    $year_val.'-'.$month_number.'-'.$i;
    $date         = sprintf("%04d-%02d-%02d", $year_no, $month_number, $i);
    $day_of_week  = date('F', strtotime($date)); 
    $dateo        = sprintf("%04d-%02d-%02d", $year_val, $month_number, $i);
    $day_of_weeky = date('l', strtotime($dateo));
               
        $this->db->select('*');
        $this->db->from('subject_timetable');
        $this->db->join('student_subject_attendances', 'subject_timetable.id = student_subject_attendances.subject_timetable_id', 'left');
        $this->db->where(array('subject_timetable.period_id' => $per['periodic_table_id']));
        $this->db->where('student_subject_attendances.date', $tdate);
        $this->db->where('student_subject_attendances.student_session_id', $arr);
        $this->db->group_by('subject_timetable.period_id');
        $qy = $this->db->get();
        if ($qy->num_rows() > 0)
        {
            
       $r = $qy->row_array();
       if($r['leavecategory_id']=='0' || $r['leavecategory_id']=='')
       {
       echo "class";
       }
       else
       {
       echo "holiday";
       }
       
       }
       
        else 
        {
        echo "mainholiday";
        }
        
        
        $this->db->select('*');
        $this->db->from('subject_timetable');
        $this->db->join('student_subject_attendances', 'subject_timetable.id = student_subject_attendances.subject_timetable_id', 'left');
        $this->db->where(array('subject_timetable.period_id' => $per['periodic_table_id']));
        $this->db->where('student_subject_attendances.date', $tdate);
        $this->db->where('student_subject_attendances.student_session_id', $arr);
        $this->db->group_by('subject_timetable.period_id');
        $q = $this->db->get();
        
        if ($q->num_rows() > 0) 
        {
        $rec = $q->row_array();
        if($rec['attendence_type_id']==1)
        {
        $sbid="P";
        $class="";
        $style="color:#00000; font-weight:bold;";
        }
        
        if($rec['attendence_type_id']==2)
        {
        $sbid="E";
        $class="";
        $style="color:#00000; font-weight:bold;";
        }
    
    
    if($rec['attendence_type_id']==3)
    {
    $sbid="L"; 
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    
    if($rec['attendence_type_id']==4)
    {
    $sbid="A";
    $style="color:#00000; font-weight:bold;";
    }
    
    if($rec['attendence_type_id']==5)
    {
    $this->db->from('leave_catmanagement');
    $this->db->join('leave_category','leave_category.leave_category_id=leave_catmanagement.leave_catmanagement_category');
    $this->db->where(array('leave_catmanagement.leave_catmanagement_class'=> $classid,'leave_catmanagement.leave_catmanagement_section'=> $sectionid,'leave_catmanagement.leave_catmanagement_date'=> $tdate,'leave_catmanagement.leave_catmanagement_session'=> $current_session));
    $qy 		    = $this->db->get();
    $resval         = $qy->row_array();
    if($resval['leave_category_shortname']!="")
    {
    $sbid= $resval['leave_category_shortname'];
    $style="background-color".':'.$resval['leave_category_favcolor'].';'."color:#00000; font-weight:bold;";
    }
    }
    
    // if($rec['attendence_type_id']==0)
    // {
    // $sbid="N"; 
    // $class="";
    // $style="color:red; font-weight:bold;";
    // }
    
    if($rec['attendence_type_id']==6)
    {
    $sbid="F"; 
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    
    if($rec['attendence_type_id']==7)
    {
    $sbid    = "M"; 
    $style   = "color:#00000; font-weight:bold;";
    }
    if($rec['attendence_type_id']==8)
    {
    $sbid    = "C";   
    $class   = "";
    $style   = "color:#00000; font-weight:bold;";
    }
    if($rec['attendence_type_id']==9)
    {
    $sbid    = "S"; 
    $class   = "";
    $style   = "color:#00000; font-weight:bold;";
    }
    }
    else
    {
    $this->db->from('leave_catmanagement');
    $this->db->join('leave_category','leave_category.leave_category_id=leave_catmanagement.leave_catmanagement_category');
    $this->db->where(array('leave_catmanagement.leave_catmanagement_class'=> $classid,'leave_catmanagement.leave_catmanagement_section'=> $sectionid,'leave_catmanagement.leave_catmanagement_date'=> $tdate,'leave_catmanagement.leave_catmanagement_session'=> $current_session));
    $qy 		    = $this->db->get();
    $resval         = $qy->row_array();
    if($resval['leave_category_shortname']!="")
    {
    $sbid= $resval['leave_category_shortname'];
    $style="background-color".':'.$resval['leave_category_favcolor'].';'."color:#00000; font-weight:bold;";
    }
    else
    {
    $sbid= "N";
    $style="color:red; font-weight:bold;";
    }
    }
    ?>
    <span class="<?php echo $class; ?>" style="<?php echo $style; ?>"><?php  echo $sbid; ?></span>
    </td>
    <?php  }  ?>
    <td>
    <?php
    $this->db->select('COUNT(DISTINCT student_subject_attendances.date) as date_count');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable', 'subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id' => $arr));
    $this->db->where('subject_timetable.period_id', $per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id' => 1));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $query = $this->db->get();
    $result = $query->row();
    if ($result) {
    $justpresent= $result->date_count;
    } 
    else 
    {
    $justpresent='0'; 
    }
    
    $grandtot= $justpresent/$tot_workingdays*100;
    echo number_format($grandtot,2).''.'%';
    ?>
    </td>
    <td>
        
    <?php
    
    $this->db->select('COUNT(DISTINCT student_subject_attendances.date) as date_count');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable', 'subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id' => $arr));
    $this->db->where('subject_timetable.period_id', $per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id' => 1));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $query = $this->db->get();
    $result = $query->row(); 
    if ($result)
    {
    $pre=  $result->date_count;
    } 
    else
    {
    $pre='0'; 
    }
    $totalpresent+= $pre;
    echo $pre;
    ?>
    </td>
    <td>
    <?php
   
   
    $this->db->select('*');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id'=> $arr));
    $this->db->where('subject_timetable.period_id',$per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id'=>4));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $abs = $this->db->count_all_results();
    echo $abs;
    $totalabs+= $abs;
    ?>
    </td>
    <td>
       
    <?php
    $this->db->select('*');
    $this->db->from('leave_catmanagement');
    $this->db->where(array('leave_catmanagement_class'=>$classid));
    $this->db->where(array('leave_catmanagement_section'=>$sectionid));
    $this->db->where('leave_catmanagement.leave_catmanagement_date >=', $frdate);
    $this->db->where('leave_catmanagement.leave_catmanagement_date <=', $trdate);
    $this->db->where('leave_catmanagement.leave_catmanagement_session ', $current_session);
    $holidy = $this->db->count_all_results();
    echo $holidy;
    ?> 
    </td>
    <td>
    <?php
    $this->db->select('*');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id'=> $arr));
    $this->db->where('subject_timetable.period_id',$per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id'=>8));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $cls = $this->db->count_all_results();
    echo $cls;
    
    $totalcls+=$cls;
    ?> 
    </td>
    </tr>
    <?php  } ?>
    <tr style="width:400px;">
    <td style="border:none;">&nbsp;</td>
    <?php  for($i=1;$i<=$no_of_days;$i++) 
    { 
    ?>
    
    <td style="border:none; border-spacing: 1em 0;"></td>
    <?php } ?>
    <td style="background-color:#e5ecf6;"></td>
    <td style="background-color:#e5ecf6;margin-left:2px;"><?php   echo $totalpresent; ?></td>
    <td style="background-color:#e5ecf6;"><?php echo $totalabs;  ?></td>
    <td style="background-color:#e5ecf6;"></td>
    <td style="background-color:#e5ecf6;"><?php echo $totalcls;  ?></td>
    </tr>
    </table>
    </td>
    
    <td>
    <?php
     $grandtotval=$totalpresent/$totalwd_percentage*100;
     echo number_format($grandtotval,2).''.'%';
     ?>
    </td>
    </tr>
   
    <?php
    }
    ?>
    </body>
    </table>
    </div>
    </div>
    <style>
    .tablemain1
    {
    position: relative;
    z-index: 1;
    border:1px solid #000; 
    padding: 3px;
    
    width:1000px;
    
    }
    @media all and (orientation:portrait)
    {
    .fontstyle
    {
    font-size:12px;
    .tabletr
    {
    border:1px solid black;
    }
    }
    }
    @media all and (orientation:landscape)
    {
    .fontstyle
    {
    font-size:10px;
    }
    }
    
    
     table{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000; }
    .tc-container{width: 100%;position: relative; text-align: center;margin-bottom:60px;padding-bottom: 5px;}
    .denifittable th{}
    .denifittable th,
    .denifittable td {border: 1px solid #000;
    border-collapse: collapse;border-left: 1px solid #999;}
    
    .denifittable tr th {font-size: 12px; font-weight: normal; width:10px; text-align:center;}
    .denifittable tr td { font-weight: normal; font-size: 12px;width:10px;}
    
    
    
    
    </style>
    
    
    
  
    
    
    
    
<!----print------------------------------------------------------------->

    <div id="Tableprint" style="visibility:hidden" >
    
    <div class="download_label"><h2 style="text-align:center;">Student Attendance Report</h2><br><h3 style="text-align:center;"><?php echo $class_name['class'].'&nbsp;&nbsp;'.$section_name['section'].'&nbsp;'.$monthv.'&nbsp;-&nbsp;'.$year_val; ?></h3> </div>
    <div class="table-responsive">
    
    <table cellpadding="0" cellspacing="0" width="100%" class="printstyle" style="text-align: center; border:1px solid black;" width="85%;">
    <thead> 
    <tr style="border: 1px solid #000 !important;">
    <td class="name" style="border: 1px solid #000;">Name</td>
    <td style="border: 1px solid #000 !important;">
    
    <table cellpadding="0" cellspacing="0" width="100%"  style="text-align: center;">
    
    <tr style="width:400px;margin-left:2px;border: 1px solid #000 !important;">
    <td style="border:none;">&nbsp;
    </td>
    
    <?php
   ?>
    <td style="text-align:left;border:none;colspan:<?php echo $no_of_days+5; ?>">&nbsp;
   
    <?php
    foreach($leave_category as $leave)
    {
     echo  $leave['leave_category_name'] .':';  ?>
     <span style="color:<?php echo  $leave['leave_category_favcolor'];  ?>"> 
        
    <?php echo $leave['leave_category_shortname'].'&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
   </span>  
   <?php 
        
    }
    ?>
    </td>
    
    </tr>
    </table>
    </td>
    <td style="border: 1px solid #000;">Total %</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $frdate         =    $year_val.'-'.$month_number.'-'.$from_date;
    $trdate         =    $year_val.'-'.$month_number.'-'.$to_date;
    foreach($resultlist as $res)
    {
    $grandtotval    =   0;
    $totalpresentval=   0;   
    $grandtot       =   0;
    $totalpresentpnt=   0;
    $totalabspnt    =   0;
    $totalclspnt    =   0;
    $grandtotvalpnt =   0;
    ?>
    
    <tr style="border: 1px solid #000 !important;">
    <td class="name" style="border: 1px solid #000;
    border-collapse: collapse;border-left: 1px solid #999;">
    <?php 
    echo $res['firstname'].'&nbsp;'.$res['middlename'].'&nbsp;'.$res['lastname'];  
    echo "<br>";
    
    echo $res['admission_no'];
    echo "<br>";
    echo $res['roll_no'];
    ?>
    
    
    
    </td>
    <td >
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
    
    <tr style="width:400px;"><td style="border:none;">&nbsp;</td><?php  for($i=1;$i<=$no_of_days-2;$i++) { ?><td style="border:none;"></td><?php } ?>
    <td style="background-color:yellow;">TWP</td><td style="background-color:yellow;"><?php echo $totalwd_percentage;  ?></td><td style="background-color:yellow;border: 1px solid #000;">WD</td><td style="background-color:yellow;border: 1px solid #000;"><?php  echo $tot_workingdays;  ?></td><td style="background-color:yellow;border: 1px solid #000;">HD</td><td style="background-color:yellow;border: 1px solid #000;"><?php  echo $leavemanagement['t']; ?></td><td style="background-color:yellow;border: 1px solid #000;"></td>
    </tr>    
    
    <tr style="width:400px; background-color:#d0cdcd; "><td style="border: 1px solid #000;"><b>PERIOD</b></td><?php  for($i=1;$i<=$no_of_days;$i++) { ?><td style="border: 1px solid #000;"><b><?php  echo $i; ?></b></td><?php } ?>
    <td style="border: 1px solid #000;margin-left:2px !important;"><b>%</b></td><td style="border: 1px solid #000;"><b>P</b></td><td style="border: 1px solid #000;"><b>A</b></td><td style="border: 1px solid #000;"><b>H</b></td><td style="border: 1px solid #000;"><b>C</b></td>
    </tr>
    <?php
    
    
    foreach($periodval as $per)
    {
    ?>
    <tr  style="border: 1px solid #000 !important;">
    <td style="border: 1px solid #000 !important;">
    <?php 
    echo $per['periodic_table_name']; ?>
    </td>
    
    <?php
    
    for($i=1;$i<=$no_of_days;$i++)
    {
    ?>
    <td style="border: 1px solid #000 !important;">
    <?php 
    $arr= $res['sess_id'];
    $tdate =    $year_val.'-'.$month_number.'-'.$i;
    $this->db->select('*');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.date ='=> $tdate));
    $this->db->where(array('student_subject_attendances.student_session_id'=> $arr));
    $this->db->where('subject_timetable.period_id',$per['periodic_table_id']);
    $this->db->group_by('student_subject_attendances.student_session_id');
    $q 		    = $this->db->get();
    if ($q->num_rows() > 0) 
    {
    $rec = $q->row_array();	
    if($rec['attendence_type_id']==1)
    {
    $sbid="P";
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    
    if($rec['attendence_type_id']==2)
    {
    $sbid="E";
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    
    
    if($rec['attendence_type_id']==3)
    {
    $sbid="L"; 
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    
    
    if($rec['attendence_type_id']==4)
    {
    $sbid="A";
    $style="color:#00000; font-weight:bold;";
    }
    
    
    if($rec['attendence_type_id']==5)
    {
    $this->db->from('leave_catmanagement');
    $this->db->join('leave_category','leave_category.leave_category_id=leave_catmanagement.leave_catmanagement_category');
    $this->db->where(array('leave_catmanagement.leave_catmanagement_class'=> $classid,'leave_catmanagement.leave_catmanagement_section'=> $sectionid,'leave_catmanagement.leave_catmanagement_date'=> $tdate));
    $qy 		    = $this->db->get();
    $resval         = $qy->row_array();
    
    
    if($resval['leave_category_shortname']!="")
    {
    $sbid= $resval['leave_category_shortname'];
    $style="background-color".':'.$resval['leave_category_favcolor'].';'."color:#00000; font-weight:bold;";
    } 
    }
    if($rec['attendence_type_id']==6)
    {
    $sbid="F"; 
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    if($rec['attendence_type_id']==7)
    {
    $sbid="M"; 
    $style="color:#00000; font-weight:bold;";
    }
    if($rec['attendence_type_id']==8)
    {
    $sbid="C";   
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    if($rec['attendence_type_id']==9)
    {
    $sbid="S"; 
    $class="";
    $style="color:#00000; font-weight:bold;";
    }
    }
    else
    {
    $this->db->from('leave_catmanagement');
    $this->db->join('leave_category','leave_category.leave_category_id=leave_catmanagement.leave_catmanagement_category');
    $this->db->where(array('leave_catmanagement.leave_catmanagement_class'=> $classid,'leave_catmanagement.leave_catmanagement_section'=> $sectionid,'leave_catmanagement.leave_catmanagement_date'=> $tdate));
    $qy 		    = $this->db->get();
    $resval         = $qy->row_array();
    if($resval['leave_category_shortname']!="")
    {
    $sbid= $resval['leave_category_shortname'];
    $style="background-color".':'.$resval['leave_category_favcolor'].';'."color:#00000; font-weight:bold;";
    }
    else
    {
    $sbid= "N";
    $style="color:red; font-weight:bold;";
    }
    }
    ?>
    <span class="<?php echo $class; ?>" style="<?php echo $style; ?>"><?php  echo $sbid; ?></span>
    </td>
    <?php  
    }  
    ?>
    
    <td style="border: 1px solid #000 !important;">
    <?php
    $this->db->select('COUNT(DISTINCT student_subject_attendances.date) as date_count');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable', 'subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id' => $arr));
    $this->db->where('subject_timetable.period_id', $per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id' => 1));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $query = $this->db->get();
    $result = $query->row();
    if ($result) {
    $justpresent= $result->date_count;
    } 
    else 
    {
    $justpresent='0'; 
    }
    $grandtot= $justpresent/$tot_workingdays*100;
    echo number_format($grandtot,2).''.'%';
    ?>
    </td>
    
    <td style="border: 1px solid #000 !important;">
    <?php
    $this->db->select('COUNT(DISTINCT student_subject_attendances.date) as date_count');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable', 'subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id' => $arr));
    $this->db->where('subject_timetable.period_id', $per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id' => 1));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $query = $this->db->get();
    $result = $query->row();
    if ($result) 
    {
    $pre=  $result->date_count;
    } 
    else 
    {
    $pre='0'; 
    }
    
    $totalpresentpnt+=$pre;
    echo $pre;
    ?>
    </td>
    
    
    <td style="border: 1px solid #000 !important;">
    <?php
    $this->db->select('*');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id'=> $arr));
    $this->db->where('subject_timetable.period_id',$per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id'=>4));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $abs = $this->db->count_all_results();
    $totalabspnt+=$abs;
    echo $abs;
    ?>
    </td>
   
    
    <td style="border: 1px solid #000 !important;">
    <?php
    $this->db->select('*');
    $this->db->from('leave_catmanagement');
    $this->db->where(array('leave_catmanagement_class'=>$classid));
    $this->db->where(array('leave_catmanagement_section'=>$sectionid));
    $this->db->where('leave_catmanagement.leave_catmanagement_date >=', $frdate);
    $this->db->where('leave_catmanagement.leave_catmanagement_date <=', $trdate);
    $this->db->where('leave_catmanagement.leave_catmanagement_session ', $current_session);
    $holidy = $this->db->count_all_results();
    echo $holidy;
    ?> 
    </td>
    
    
    <td style="border: 1px solid #000 !important;">
    <?php
    $this->db->select('*');
    $this->db->from('student_subject_attendances');
    $this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
    $this->db->where(array('student_subject_attendances.student_session_id'=> $arr));
    $this->db->where('subject_timetable.period_id',$per['periodic_table_id']);
    $this->db->where(array('student_subject_attendances.attendence_type_id'=>6));
    $this->db->where('student_subject_attendances.date >=', $frdate);
    $this->db->where('student_subject_attendances.date <=', $trdate);
    $cls = $this->db->count_all_results();
    $totalclspnt+=$cls;
    echo $cls;
    ?> 
    </td>
    
    </tr>
    <?php 
    }
    ?>
    
    <tr style="width:400px;"><td style="border:none;">&nbsp;</td><?php  for($i=1;$i<=$no_of_days;$i++) { ?><td style="border:none;"></td><?php } ?>
    <td style="background-color:#e5ecf6;border: 1px solid #000;"></td>
    <td style="background-color:#e5ecf6;border: 1px solid #000;"><?php   echo $totalpresentpnt; ?></td>
    <td style="background-color:#e5ecf6;border: 1px solid #000;"><?php echo $totalabspnt;  ?></td>
    <td style="background-color:#e5ecf6;border: 1px solid #000;"></td>
    <td style="background-color:#e5ecf6;border: 1px solid #000;"><?php echo $totalcls;  ?></td>
    </tr>
    </table>
    </td>
    
    
    <td style="border: 1px solid #000 !important; text-align:center;">
    <?php
    $grandtotvalpnt=$totalpresentpnt/$totalwd_percentage*100;
    echo number_format($grandtotvalpnt,2).''.'%';
    ?>
    </td>
    
    </tr>
    <?php
    }
    ?>
    </body>
    </table>
    </div>
    </div>
    
    
    <!---print close------------------------------------------->
    <?php
    }
    ?>
    </div>
    </div>
    </div>  
    </div>
    </div> 
    </div> 
    
    
    <?php
    }
    ?>
    </section>
    <style>
    
    th {
    /*background-color: #B3B3B3;*/
    border: 2px solid;
    }
    
    td {
    border: 1px solid;
    padding: 10px;
    text-align: center;
    }
    
    .nav-date,
    .nav-event {
    margin-left: auto;
    margin-right: auto;
    width: 75%;
    }           
    </style>
    
    
    
    
    
    
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var isDragging = false;
        var startPositionX = 0;
        var startPositionY = 0;
        var container = $("#scrollableContainer");

        container.mousedown(function (e) {
            isDragging = true;
            startPositionX = e.pageX;
            startPositionY = e.pageY;
            e.preventDefault();
        });

        $(document).mouseup(function () {
            isDragging = false;
        });

        $(document).mousemove(function (e) {
            if (isDragging) {
                container.scrollLeft(container.scrollLeft() + (startPositionX - e.pageX));
                container.scrollTop(container.scrollTop() + (startPositionY - e.pageY));
                startPositionX = e.pageX;
                startPositionY = e.pageY;
            }
        });

        container.on("wheel", function (event) {
            event.preventDefault();
            var delta = event.originalEvent.deltaY || event.originalEvent.detail || event.originalEvent.wheelDelta;
            var scrollDistance = 50;
            container.scrollTop(container.scrollTop() + delta * scrollDistance);
        });
    });

    
    
    
    
    function printDiv() 
    {
    var divToPrint=document.getElementById('Tableprint');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
    }
    </script>
    <?php
    
    function getAttendance($array, $student_session_id) {
    if (!empty($array)) {
    return $array[$student_session_id];
    }
    }
    
    function getattendencetype($attendencetype, $find) 
    {
    foreach ($attendencetype as $attendencetype_key => $attendencetype_value) {
    if ($attendencetype_value['id'] == $find) {
    return $attendencetype_value['key_value'];
    }
    }
    return false;
    }
    ?>
    
    
    <script type="text/javascript">
    $(document).ready(function () 
    {
    var section_id_post = "<?php echo set_value('section_id'); ?>";
    var class_id_post = "<?php echo set_value('class_id'); ?>";
    var date_post = "<?php echo set_value('date'); ?>";
    var subject_timetable_id = "<?php echo set_value('subject_timetable_id', 0); ?>";
    populateSection(section_id_post, class_id_post);
    
    function populateSection(section_id_post, class_id_post) {
    if (section_id_post != "" && class_id_post != "") {
    
    $('#section_id').html("");
    
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    $.ajax({
    type: "GET",
    url: baseurl + "sections/getByClass",
    data: {'class_id': class_id_post},
    dataType: "json",
    success: function (data) {
    $.each(data, function (i, obj)
    {
    var select = "";
    if (section_id_post == obj.section_id) {
    var select = "selected=selected";
    }
    div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
    });
    $('#section_id').append(div_data);
    }
    });
    }
    }
    
    
    
    $(document).on('change', '#class_id', function (e) {
    $('#section_id').html("");
    var class_id = $(this).val();
    
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    var url = "";
    $.ajax({
    type: "GET",
    url: baseurl + "sections/getByClass",
    data: {'class_id': class_id},
    dataType: "json",
    success: function (data) {
    $.each(data, function (i, obj)
    {
    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
    });
    $('#section_id').append(div_data);
    }
    });
    });
    });
    </script>
