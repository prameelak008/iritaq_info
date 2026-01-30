    <style type="text/css">
    
    .styleclass
    {
        background-color:yellow;
    }
    
    .headstyle
    {
     background-color:#efefef;   
    }
  
    table{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000; }
    .tc-container{width: 100%;position: relative; text-align: center;margin-bottom:60px;padding-bottom: 5px;}
    .denifittable th{}
    .denifittable th,
    .denifittable td {border: 1px solid #000;
    border-collapse: collapse;border-left: 1px solid #999;}
    
    .denifittable tr th {font-size: 12px; font-weight: normal; width:10px; text-align:center;}
    .denifittable tr td { font-weight: normal; font-size: 15px;width:10px;}
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
    
    <form id='form' action="<?php echo site_url('admin/subjectattendence/reportbetween_bydate') ?>"  method="post" accept-charset="utf-8">
    <div class="box-body">
    <?php /* if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } */ ?>
    <?php echo $this->customlib->getCSRF(); ?>
    <div class="row">
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
    <select autofocus="" id="class_id" name="class_id" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    <?php
    foreach ($classlist as $class) {
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
    
    <div class="col-md-2">
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
    
       
    <div class="col-md-2">
    <div class="form-group">
    <label for="exampleInputEmail1">
    <?php echo $this->lang->line('fromdate') ?>
    </label><small class="req"> *</small>
    <input type="date" name="from_date" id="from_date" class="form-control"  value="<?php echo set_value('from_date', date('d-m-Y')) ?>"/>
    <span class="text-danger"><?php echo form_error('from_date'); ?></span>
    </div>
    </div>
    
    
    <div class="col-md-2">
    <div class="form-group">
    <label for="exampleInputEmail1">
    <?php echo $this->lang->line('todate') ?>
    </label><small class="req"> *</small>
    <input type="date" name="to_date" id="to_date" class="form-control"   value="<?php echo set_value('to_date', date('d-m-Y')) ?>"/>
    <span class="text-danger"><?php echo form_error('to_date'); ?></span>
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
    if (!empty($resultlist)) 
    {
    $sl=1;
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
        //echo "$leavecount: $countleavedays   <br>";
        $leaveCountValues[$leavecount] = $countleavedays;
        echo "</td>";
        } 
        ?>
        
        
        <!--<div class="table-responsive">   -->
        <!--<table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">-->
        <!--<tr style="width:400px;">-->
        <!--<td>LEAVECOUNT</td>-->
        <?php
        foreach ($leaveCounts as $leavecount => $countleavedays) 
        {
        echo "<td>";
        //echo "$leavecount: $countleavedays   <br>";
        $leaveCountValues[$leavecount] = $countleavedays;
        echo "</td>";
        } 
        ?>
        <!--</td>-->
        <!--</tr>-->
        <!--</table>-->
        <!--</div>-->
        
        <?php
        
     
        
        foreach ($wekdays as $day => $count) 
        {
        foreach ($tot_timetable_days as $tot) 
        {
        if ($tot['day'] == $day) 
        {
        
 
        if (isset($leaveCountValues[$day]))
        {
       
        $count -= $leaveCountValues[$day];
        }
        
        echo 'TIMETABLE COUNT: ' . $tot['count'].'&nbsp;- &nbsp;'.$day .''. $count ;
       
        
        echo "<br>";
        
        ?>
       
        
        <?php
        
        
        //$totalTimetableCount += $tot['count'];
        $workingdayscount += $count;
        $totalTimetableCount+=$tot['count']*$count;
        }
        }
        }
        
        $tot_workingdays     = $workingdayscount; 
        
        $totalwd_percentage= $totalTimetableCount;
       
        ?>
        
        <!--</tr>-->
        <!--</table>-->
        
     </br>
    </br>
    <input type='button' id='btn' class="btn btn-success pull-right btn-sm" value='Print  Table' onclick='printDiv();'> 
    
    </br>
    </br>
    
    
    <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;" width="85%;" >
    <tr>
    <td class="styleclass">WD</td>
    <td class="styleclass"><?php echo $tot_workingdays;    ?></td>
    <td class="styleclass">HD</td>
    <td class="styleclass"><?php  echo $leavemanagement['t']; ?>
    </td>
    <td class="styleclass">Total Period</td>
    <td class="styleclass"><?php echo  $totalwd_percentage;  ?> </td>
    </tr>
    <tr>
    <td style="font-size:15px;" class="headstyle"><b>Sl.No</b></td>
    <td style="font-size:15px;" class="headstyle"><b>Name</b></td>
    <td style="font-size:15px;" class="headstyle"><b>Total Present</b></td>
    <td style="font-size:15px;" class="headstyle"><b> Percentage(%)</b></td>
    <td style="font-size:15px;" class="headstyle"><b>Total Absent</b></td>
    <td style="font-size:15px;" class="headstyle"><b> Percentage(%)</b></td>
    </tr>
    
    <?php
    $totalAttendancePresent=0;
    $totalAttendanceAbsent=0;
    foreach($resultlist as $res)
    {
    ?>
    <tr>
    <td><?php  echo $sl; ?></td>
    <td ><?php  echo $res['firstname'].'&nbsp; '.$res['middlename'].'&nbsp;'.$res['lastname'];
    echo "<br>";
    echo "Institutional Id".'&nbsp; :&nbsp;'.$res['admission_no'];
    echo "<br>";
    echo "Register No ".'&nbsp; :&nbsp;'.$res['roll_no'];
    ?>
    </td>
    <td>
    <?php
    
    
$this->db->select('COUNT(*) as total_present');
$this->db->from("(SELECT DISTINCT date, student_session_id, subject_timetable_id
                 FROM student_subject_attendances
                 JOIN subject_timetable ON subject_timetable.id = student_subject_attendances.subject_timetable_id
                 WHERE student_session_id = " . $this->db->escape($res['sess_id']) . "
                     AND attendence_type_id = '1'
                     AND subject_timetable.session_id = " . $this->db->escape($session_id) . "
                     AND student_subject_attendances.date >= " . $this->db->escape($from_date) . "
                     AND student_subject_attendances.date <= " . $this->db->escape($to_date) . ") AS subquery");
                    $query = $this->db->get();
                    $result = $query->row();
                    $totalAttendancePresent = ($result) ? $result->total_present : 0;
                    echo $totalAttendancePresent;

    ?>
    </td>
    <td><?php  echo number_format($totalAttendancePresent/$totalwd_percentage*100,2).''.'%';  ?></td>
    <td>
    <?php
$this->db->select('COUNT(*) as total_absent');
$this->db->from("(SELECT DISTINCT date, student_session_id, subject_timetable_id
                 FROM student_subject_attendances
                 JOIN subject_timetable ON subject_timetable.id = student_subject_attendances.subject_timetable_id
                 WHERE student_session_id = " . $this->db->escape($res['sess_id']) . "
                     AND attendence_type_id = '4'
                     AND subject_timetable.session_id = " . $this->db->escape($session_id) . "
                     AND student_subject_attendances.date >= " . $this->db->escape($from_date) . "
                     AND student_subject_attendances.date <= " . $this->db->escape($to_date) . ") AS subquery");
                    $query = $this->db->get();
                    $result = $query->row();
                    $totalAttendanceAbsent = ($result) ? $result->total_absent : 0;
                    echo $totalAttendanceAbsent;
    ?>
    
   </td>
   <td>
   <?php  echo number_format($totalAttendanceAbsent/$totalwd_percentage*100,2).''.'%';  ?></td>
    </tr>
    <?php
    $sl++;
    }
    ?>
    </table>
    <?php
    }
    else
    {
    ?>
    
    <section class="content">
    <div class="row">  
        <div class="col-md-12"> 
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Info!</h4>
                <?php echo $this->lang->line('no_search_record_found'); ?>
            </div>
        </div>
    </div>
    </section>
            
    <?php    
    }
    ?>
   
    </div>
    
    <div id="Tableprint" style="visibility:hidden" >
    <div class="download_label"><h2 style="text-align:center;">Student Attendance Report </h2>
    <br>
    <h3 style="text-align:center;"><?php echo $class_name['class'].'&nbsp;&nbsp;'.$section_name['section'].'&nbsp;&nbsp;' .$from_date.'&nbsp;&nbsp;'.$to_date; ?></h3>
    </div>
    <div class="table-responsive">
    <table cellpadding="0" cellspacing="0" width="100%" class="denifittable"  style="text-align: center; border:1px solid black;">
    <tr>
    <td style="border: 1px solid #000 !important;background-color:yellow;">WD</td>
    <td style="border: 1px solid #000 !important;background-color:yellow;"><?php echo $tot_workingdays-$leavemanagement['t'];    ?></td>
    <td style="border: 1px solid #000 !important;background-color:yellow;">HD</td>
    <td style="border: 1px solid #000 !important;background-color:yellow;"><?php  echo $leavemanagement['t']; ?>
    </td>
    <td style="border: 1px solid #000 !important;background-color:yellow;">Total Period</td>
    <td style="border: 1px solid #000 !important;background-color:yellow;"><?php echo  $totalwd_percentage;  ?>
    </td>
    </tr>
    <tr>
        
    <td style="font-size:15px;border: 1px solid #000 !important;background-color:#efefef;"><b>Sl.No</b></td>
    <td style="font-size:15px;border: 1px solid #000 !important;background-color:#efefef;"><b>Name</b></td>
    <td style="font-size:15px;border: 1px solid #000 !important;background-color:#efefef;"><b>Total Present</b></td>
    <td style="font-size:15px;border: 1px solid #000 !important;background-color:#efefef;"><b> Percentage(%)</b></td>
    <td style="font-size:15px;border: 1px solid #000 !important;background-color:#efefef;"><b>Total Absent</b></td>
    <td style="font-size:15px;border: 1px solid #000 !important;background-color:#efefef;"><b> Percentage(%)</b></td>
    </tr>
    
    <?php
    $totalAttendancePresent=0;
    $totalAttendanceAbsent=0;
    $sln=1;
    foreach($resultlist as $res)
    {
    ?>
    <tr>
    <td style="font-size:15px;border: 1px solid #000 !important;"><?php  echo $sln; ?></td>
    <td style="font-size:15px;border: 1px solid #000 !important;"><?php  echo $res['firstname'].'&nbsp; '.$res['middlename'].'&nbsp;'.$res['lastname'];
    echo "<br>";
    echo "Institutional Id".'&nbsp; :&nbsp;'.$res['admission_no'];
    echo "<br>";
    echo "Register No ".'&nbsp; :&nbsp;'.$res['roll_no'];
    ?>
    </td>
    
    <td style="font-size:15px;border: 1px solid #000 !important;">
        
    <?php
$this->db->select('COUNT(*) as total_present');
$this->db->from("(SELECT DISTINCT date, student_session_id, subject_timetable_id
                 FROM student_subject_attendances
                 JOIN subject_timetable ON subject_timetable.id = student_subject_attendances.subject_timetable_id
                 WHERE student_session_id = " . $this->db->escape($res['sess_id']) . "
                     AND attendence_type_id = '1'
                     AND subject_timetable.session_id = " . $this->db->escape($session_id) . "
                     AND student_subject_attendances.date >= " . $this->db->escape($from_date) . "
                     AND student_subject_attendances.date <= " . $this->db->escape($to_date) . ") AS subquery");

                    $query = $this->db->get();
                    $result = $query->row();
                    $totalAttendancePresent = ($result) ? $result->total_present : 0;
echo $totalAttendancePresent;
    ?>
    </td>
    
    
    <td style="font-size:15px;border: 1px solid #000 !important;"><?php  echo number_format($totalAttendancePresent/$totalwd_percentage*100,2).''.'%';  ?></td>
    
    <td style="font-size:15px;border: 1px solid #000 !important;">
    <?php
    $this->db->select('COUNT(*) as total_absent');
$this->db->from("(SELECT DISTINCT date, student_session_id, subject_timetable_id
                 FROM student_subject_attendances
                 JOIN subject_timetable ON subject_timetable.id = student_subject_attendances.subject_timetable_id
                 WHERE student_session_id = " . $this->db->escape($res['sess_id']) . "
                     AND attendence_type_id = '4'
                     AND subject_timetable.session_id = " . $this->db->escape($session_id) . "
                     AND student_subject_attendances.date >= " . $this->db->escape($from_date) . "
                     AND student_subject_attendances.date <= " . $this->db->escape($to_date) . ") AS subquery");
                    $query = $this->db->get();
                    $result = $query->row();
                    $totalAttendanceAb = ($result) ? $result->total_absent : 0;
                    echo $totalAttendanceAb;
    ?>
    </td>
    <td style="font-size:15px;border: 1px solid #000 !important;"><?php  echo number_format($totalAttendanceAb/$totalwd_percentage*100,2).''.'%';  ?></td>
    </tr>
    <?php
    $sln++;
    }
    ?>
    </table>
    </div>
    </div>
    
    
    
    
    
     
    
    
    
    
        <style>
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
        </div>
        </div>
        </div>  
        </div>
        </div> 
        </div>
 
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
    <script type="text/javascript">
    
    
    
    
    
    
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
