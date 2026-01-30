            
            <div class="content-wrapper">
            <section class="content-header">
            <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance').'&nbsp;'.$this->lang->line('report'); ?></small>        </h1>
            </section>
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"> <?php echo $this->lang->line('attendance').'&nbsp;'.$this->lang->line('report'); ?></h3>
            <div class="box-tools pull-right">
            </div>
            </div>
            <div class="box-body">
            <div class="row">
                
            
            <form id='form' action="<?php echo site_url('user/attendence/custom_report') ?>"  method="post" accept-charset="utf-8">
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
            
            
            <style type="text/css">
            .progress {
            height: 20px;
            margin-bottom: 20px; /* Add some bottom margin for spacing */
            }
            
            .progress-bar {
            line-height: 20px;
            }
            
            /* Adjust the colors and styles for different progress bars */
            .progress-bar.bg-success {
            background-color: #28a745;
            }
            
            .progress-bar.bg-danger {
            background-color: #dc3545;
            }
            
            .progress-bar.bg-warning {
            background-color: #ffc107;
            }
            </style> 
  
  
        <?php
        
        if (!empty($attendence)) 
        {
        $leaveCounts = []; 
        foreach ($leavemanagementleaves as $leave) {
        $leaveDate = new DateTime($leave['leave_catmanagement_date']);
        $dayOfWeek = $leaveDate->format('l'); 
        
        if (!isset($leaveCounts[$dayOfWeek])) {
        $leaveCounts[$dayOfWeek] = 1; 
        } else {
        $leaveCounts[$dayOfWeek]++; 
        }
        }
            
            
        foreach ($leaveCounts as $leavecount => $countleavedays) 
        {
        echo "<td>";
        $leaveCountValues[$leavecount] = $countleavedays;
        echo "</td>";
        } 
        ?>
       
        <?php
        foreach ($leaveCounts as $leavecount => $countleavedays) 
        {
        echo "<td>";
        $leaveCountValues[$leavecount] = $countleavedays;
        echo "</td>";
        }
        
        $workingdayscount = 0; 
        $totalTimetableCount=0;
        
        foreach ($wekdays as $day => $count) {
        foreach ($tot_timetable_days as $tot) {
        if ($tot['day'] == $day) {
        if (isset($leaveCountValues[$day])) {
        $count -= $leaveCountValues[$day];
        }
       
        echo "<br>";
        $workingdayscount += $count; 
        $totalTimetableCount += $tot['count'] * $count;
        }
        }
        }
        $totalwd_percentage= $totalTimetableCount;
        ?> 
        
        
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <td>subject</td>
            <td>code</td>
            <td>Total </td>
            <td>Total Present</td>
            <td>Total Absent</td>
            <td>Show</td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($attendence as $attend)
            {
            $remaining = $attend['total'] - $attend['total_present'] - $attend['total_absent'];
            $total = $attend['total'];
            $total_present = $attend['total_present'];
            $total_absent = $attend['total_absent'];
            $total_percentage = ($total / $total) * 100;
            $present_percentage = ($total_present / $total) * 100;
            $absent_percentage = ($total_absent / $total) * 100;
            ?>
            <tr>
            <td><?php echo $attend['code']; ?></td>
            <td><?php echo $attend['name']; ?></td>
            <td><?php //echo  $totalwd_percentage; ?></td>
            <td><?php echo $attend['total_present']; ?></td>
            <td><?php echo $attend['total_absent']; ?></td>
            <td>
            <div class="progress" style="max-width: 100%">
            <div class="progress-bar bg-success" style="width: <?php echo $present_percentage; ?>%" role="progressbar" aria-valuenow="<?php echo $present_percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($present_percentage, 2); ?>%</div>
            <div class="progress-bar bg-warning" style="width: <?php echo $absent_percentage; ?>%" role="progressbar" aria-valuenow="<?php echo $absent_percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($absent_percentage, 2); ?>%</div>
            <div class="progress-bar bg-info" style="width: <?php echo $total_percentage; ?>%" role="progressbar" aria-valuenow="<?php echo $total_percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $total_percentage; ?>%</div>
            </div>
            </td>
            </tr>
            <?php } ?>
           </tbody>
           </table>
            <?php
            }
            ?>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </section>
            </div>
            
            <script type="text/javascript">
            $(document).ready(function () {
            var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
            attendance.result($('#dob').val());
            $('.date').datepicker({
            format: date_format,
            autoclose: true,
            weekStart : start_week,
            
            }).on('changeDate', dateChanged);
            
            function dateChanged(ev) {
            var date = $('#dob').val();
            attendance.result(date);
            }
            });
            
            
            </script>