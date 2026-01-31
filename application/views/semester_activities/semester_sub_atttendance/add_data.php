
            <style>

            .program-details {
            /* display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px; */
            }   


            /*

            .form-group {
            display: flex;
            flex-direction: column;
            }

            .form-group label {
            margin-bottom: 8px;
            color: #333;
            }



            .form-group select,
            .form-group input {
            padding: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;

            transition: all 0.3s;
            }

            .form-group select:focus,
            .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }
            */


            .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            }

            .attendance-table thead {
            background: linear-gradient(135deg, #6589d7 0%, #293047 100%);
            color: white;
            }

            .attendance-table th,
            .attendance-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            }

            .attendance-table th {
            text-align: center;
            }

            .attendance-table tbody tr:hover {
            background: #f5f5f5;
            }

            .radio-group {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
            }

            .radio-option {
            display: flex;
            align-items: center;
            gap: 5px;
            }

            .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #667eea;
            }

            .radio-option label {
            cursor: pointer;
            font-weight: 500;
            }


            .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            }


            .checkbox-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ff9800;
            }


            .checkbox-option label {
            cursor: pointer;
            font-weight: 500;
            }



            .holiday-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #fff8e1;
            border-radius: 10px;
            border-left: 4px solid #ffc107;
            }


            .holiday-section h3 {
            color: #f57c00;
            margin-bottom: 15px;
            }


            .holiday-inputs {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            }



            .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            width: 100%;
            }



            .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            }


            .add-student-btn {
            background: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 15px;
            font-weight: 600;
            }

            .saved-message {
            display: none;
            background: #4caf50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            font-weight: 600;
            }

            .saved-message.show {
            display: block;
            animation: slideIn 0.3s ease;
            }

            @keyframes slideIn {
            from {
            opacity: 0;
            transform: translateY(-20px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
            }

            .text-center {
            text-align: center;
            } 


            </style>


            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">

            <script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>


            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('attendence'); ?> <small></small></h1>
            </section>


            <!-- Main content -->
            <section class="content">

            <div class="col-md-12">
            <?php
            $this->load->view('layout/topbar_activities'); ?>
            </div>
            &nbsp;


            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('subject').'&nbsp;'.$this->lang->line('attendence'); ?></h3>
            <div class="box-tools pull-right">
            </div>
            </div>

  

            <div class="table-responsive mailbox-messages">             


            <form role="form" action="<?php echo site_url('semester_activities/Semester_period_attendance') ?>" method="post" class="class_search_form">
            <div class="promotion-grid">      
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

            <div class="row">
            <div class="col-md-12">
            <?php echo $this->customlib->getCSRF(); ?>

            <div class="col-md-3">
            <div class="form-group">           
            <?= dropdownlist_program(
            $programs,              // Array of programs from DB
            set_value('prog_id'), 
            ); ?>
            <span class="text-danger"><?= form_error('prog_id'); ?></span>
            </div>  
            </div> 

             
            <input type="hidden" id="saved_sem_type" value="<?= isset($sem_group_id) ? $sem_group_id : '' ?>">
            <input type="hidden" id="saved_period"   value="<?= isset($period_id) ? $period_id : '' ?>">

            <div class="col-md-3">
            <div class="form-group">
            <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
            <select id="sem_type" name="sem_type" class="form-control">
            <option value="">-- Select Batch & Semester --</option>
            </select>
            <span class="text-danger"><?= form_error('sem_type'); ?></span>
            </div>
            </div>            


            <div class="col-md-3">
            <div class="form-group">
            <label>Date<small class="req">*</small></label>
            <!-- <input type="date" name="attendanceDate" id="attendanceDate" class="form-control" value=" <?php echo set_value('attendanceDate'); ?> ">      -->
            
            <?php $savedDate = isset($attendanceDate) && !empty($attendanceDate) ? $attendanceDate : date('Y-m-d'); ?>
            <input type="date" name="attendanceDate" id="attendanceDate" class="form-control" value="<?= $savedDate ?>">
            </div>
            </div>           


            <div class="col-md-3">
            <div class="form-group">
            <label>Period<small class="req">*</small></label> 
            <select id="period_list" name="period_list" class="form-control">
            <option value="">Select Period</option>
            </select>
            </div>
            </div>              
            


            <div class="col-md-12">
            <div class="row">
            <div class="form-group">
            <button type="submit" name="search" value="search_full" class="btn btn-info pull-right">
            <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('search'); ?>
            </button>
            </div>
            </div>
            </div>  
            </div>
            </div><!--./col-md-6-->
            </div>
            </div>
            </form>         
            




            <form id="saveForm" method="POST" action="<?php echo site_url('semester_activities/Semester_period_attendance/save_attendence'); ?>">
            <div class="holiday-section">                
            <?php $shownDate = isset($attendanceDate) && !empty($attendanceDate) ? date('d-M-Y', strtotime($attendanceDate)) : date('d-M-Y'); ?>
            <div class="alert alert-info" style="margin-bottom:10px; text-align:center">
            <strong><?php echo $this->lang->line('date'); ?>:</strong> <?php echo $shownDate; ?>              
            </div>

            <?php if (isset($attendance_status_summary)): ?>
            <?php if ($attendance_status_summary == 'marked'): ?>
            <div class="alert alert-success text-center">
            <i class="fa fa-check-circle" aria-hidden="true" style="margin-right:6px;"></i>
            Attendance already marked for this date.
            </div>
            <?php elseif ($attendance_status_summary == 'holiday'): ?>
            <div class="alert alert-danger text-center">
            <i class="fa fa-sun-o" aria-hidden="true" style="margin-right:6px;"></i>
            This date is marked as a holiday.
            </div>
            <?php elseif ($attendance_status_summary == 'not_marked'): ?>
            <div class="alert alert-warning text-center">
            <i class="fa fa-info-circle" aria-hidden="true" style="margin-right:6px;"></i>
            Attendance not yet marked for this date.
            </div>
            <?php endif; ?>
            <?php endif; ?>


            <h3><i class="fa fa-calendar" aria-hidden="true" style="margin-right:6px;"></i> Common Leave</h3>

            <?php
            // Determine if ALL students on this date are marked with the same common-leave value (5/6/7)
            $commonLeave = null; // 5,6,7 if uniform across all students; otherwise null
            if (!empty($students)) {
                $first = null;
                $allSame = true;
                foreach ($students as $s) {
                    $st = isset($s['attend_status']) ? (int)$s['attend_status'] : 0;
                    if (in_array($st, [5, 6, 7], true)) {
                        if ($first === null) {
                            $first = $st;
                        } elseif ($first !== $st) {
                            $allSame = false; break;
                        }
                    } else {
                        $allSame = false; break;
                    }
                }
                if ($allSame && $first !== null) { $commonLeave = $first; }
            }
            ?>

            <div class="holiday-inputs">
            <div class="checkbox-option">
            <input type="checkbox" class="common-leave" id="monthlyLeaveAll" name="leave" value="5" <?php echo ($commonLeave === 5) ? 'checked' : ''; ?>>&nbsp;
            <label for="monthlyLeaveAll">Monthly Leave</label>
            </div>

            <div class="checkbox-option">
            <input type="checkbox" class="common-leave" id="classLeaveAll" name="leave" value="6" <?php echo ($commonLeave === 6) ? 'checked' : ''; ?>>&nbsp;
            <label for="classLeaveAll">Class Leave</label>
            </div>

            <div class="checkbox-option">
            <input type="checkbox" class="common-leave" id="specialLeaveAll" name="leave" value="7" <?php echo ($commonLeave === 7) ? 'checked' : ''; ?>>&nbsp;
            <label for="specialLeaveAll">Special Leave</label>
            </div>
            </div>



            <input type="hidden" name="at_sem_group_id" id="at_sem_group_id" value="<?php echo $sem_group_id; ?>" class="at_sem_group_id" class="form-control">

            <input type="hidden" name="period"  id="period"  value="<?php echo $period_id; ?>"  class="form-control">

            <input type="hidden" name="attendanceDate" value="<?php echo $attendanceDate; ?>"  class="form-control">
            <br>


            <div style="margin-bottom: 10px;">
            <strong>Legend:</strong>
            <span style="margin-left:10px;vertical-align:middle;">
            <i class="fa fa-check-circle" aria-hidden="true" style="color:#28a745;"></i> Present
            </span>
            <span style="margin-left:10px;vertical-align:middle;">
            <i class="fa fa-times-circle" aria-hidden="true" style="color:#dc3545;"></i> Absent
            </span>
            <span style="margin-left:10px;vertical-align:middle;">
            <i class="fa fa-sun-o" aria-hidden="true" style="color:#007bff;"></i> Holiday
            </span>
            <span style="margin-left:10px;vertical-align:middle;">
            <i class="fa fa-circle-o" aria-hidden="true" style="color:#6c757d;"></i> Not Marked
            </span>
            </div>

            </div>

            <div style="overflow-x: auto;">
            <table  class="attendance-table">                   
            <thead>
              
            <tr>
            <th><?php echo $this->lang->line('slno'); ?></th>
            <th><?php echo $this->lang->line('roll'); ?></th>
            <th><?php echo $this->lang->line('student'); ?></th>            
            <th><?php echo $this->lang->line('present').'&nbsp;'.$this->lang->line('absent'); ?></th>
            <th><?php echo $this->lang->line('note'); ?></</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $sl = 1;
            foreach ($students as $stud) {
            // Get existing attendance status and notes if available
            $attend_status = isset($stud['attend_status']) ? $stud['attend_status'] : '';
            // Determine color and title for each row
            $dotColor = '#6c757d'; // gray default
            $dotTitle = 'Not marked';

            if ($attend_status !== '') {
            if ($attend_status == 1) {
            $dotColor = '#28a745'; // green
            $dotTitle = 'Already marked (Present)';
            } elseif ($attend_status == 4) {
            $dotColor = '#dc3545'; // red
            $dotTitle = 'Already marked (Absent)';
            } elseif (in_array($attend_status, [5,6,7])) {
            $dotColor = '#007bff'; // blue
            $dotTitle = 'Set as Holiday';
            }
            }
            $attend_notes  = isset($stud['attend_notes']) ? $stud['attend_notes'] : '';
            ?>
            <tr>
            <td><?php echo $sl; ?></td>
            <td><?php echo $stud['roll_no']; ?></td>


            <td>
            <?php echo $stud['firstname']; ?>
            <?php if ($attend_status !== ''): ?>
            <?php 
            $statusText = 'Marked';
            $icon = 'fa-circle-o';
            $iconColor = '#6c757d'; // default gray
            if ($attend_status == '1') { $statusText = 'Present'; $icon = 'fa-check-circle'; $iconColor = '#28a745'; }
            elseif ($attend_status == '4') { $statusText = 'Absent'; $icon = 'fa-times-circle'; $iconColor = '#dc3545'; }
            elseif (in_array((int)$attend_status, [5,6,7])) { $statusText = 'Holiday'; $icon = 'fa-sun-o'; $iconColor = '#007bff'; }
            ?>
            <i class="fa <?php echo $icon; ?>" aria-hidden="true"
            title="<?php echo $statusText; ?>"
            style="margin-left:6px;color:<?php echo $iconColor; ?>;"></i>
            <?php endif; ?>
            </td>
            <td>
            <label>
            <input 
            type="radio" 
            name="status[<?php echo $sl; ?>]" 
            value="1"
            <?php echo ($attend_status == '1' || $attend_status == '' ? 'checked' : ''); ?>> Present
            </label>

            <label>
            <input 
            type="radio" 
            name="status[<?php echo $sl; ?>]" 
            value="4"
            <?php echo ($attend_status == '4' ? 'checked' : ''); ?>> Absent
            </label>
            </td>

            <td>
            <input type="hidden" name="student_id[<?php echo $sl; ?>]" value="<?php echo $stud['stud_student_id']; ?>">    
            <textarea 
            name="notes[<?php echo $sl; ?>]" 
            class="form-control"><?php echo htmlspecialchars($attend_notes); ?></textarea>
            </td>
            </tr>
            <?php
            $sl++;
            }
            ?>

            </tbody>
            </table>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;<?php echo $this->lang->line('save').'&nbsp;&nbsp;'.$this->lang->line('attendance'); ?></button>
            </div>
            </form>
            </div>
            </section>
            </div>

            
            <script> 
            
            
$(document).on('change', '#sem_type, #attendanceDate', function () {
    const batch = $('#sem_type').val();
    const attendanceDate = $('#attendanceDate').val();
    const savedPeriod = String($('#saved_period').val()).trim();
    const $period = $('#period_list');

    if (!batch || !attendanceDate) {
        $period.html('<option value="">Select Period</option>');
        return;
    }

    $period.prop('disabled', true).html('<option>Loading...</option>');

    $.ajax({
        url: "<?= base_url('semester_activities/Semester_period_attendance/getPeriodsByBatch') ?>",
        type: "POST",
        dataType: "json",
        data: { batch: batch, attendanceDate: attendanceDate },
        success: function (response) {
            let options = '<option value="">Select Period</option>';

            response.forEach(row => {
                options += `<option value="${row.tb_id}">Period ${row.periodic_table_name} (${row.time_from} - ${row.time_to}) - ${row.name}</option>`;
            });

            $period.html(options).prop('disabled', false);

            // 🔹 Apply saved period
            if (savedPeriod && $period.find(`option[value="${savedPeriod}"]`).length) {
                $period.val(savedPeriod);
            }
        },
        error: function () {
            alert('AJAX error');
        }
    });
});



            $(document).ready(function() 
            {
            function applyCommonLeaveState() {
            const anyChecked = $('.common-leave:checked').length > 0;
            const $radios = $('input[type="radio"][name^="status"]');
            $radios.prop('disabled', anyChecked);
            if (anyChecked) { $radios.prop('checked', false); }
            }

            $('.common-leave').on('change', function() {
            if (this.checked) {
            // keep only this one checked
            $('.common-leave').not(this).prop('checked', false);
            }
            applyCommonLeaveState();
            });

            // Apply initial state on load (in case pre-checked from PHP)
            applyCommonLeaveState();
            });


            $(document).ready(function()
            {
            $('#saveForm').on('submit', function(e) 
            {

            e.preventDefault(); // stop normal page refresh

            var form        = $(this);
            var formData = form.serialize();          


            $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function()
            {
            $('.btn-info')
            .prop('disabled', true)
            .html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            },
            success: function(response) {
            $('.btn-info')
            .prop('disabled', false)
            .html('<i class="fa fa-save"></i> Save Attendance');

            if (response.status) {
            // 🔁 Reload page — flash message will appear
            location.reload();
            } else {
            alert('Error while saving attendance.');
            }
            },
            error: function(xhr, status, error) {
            $('.btn-info')
            .prop('disabled', false)
            .html('<i class="fa fa-save"></i> Save Attendance');

            console.error('Server Error:', xhr.responseText);
            alert('Server error: ' + error);
            }
            });
            });
            });






           




 </script>



