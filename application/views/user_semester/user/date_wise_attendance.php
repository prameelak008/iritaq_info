
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <!-- <h3>Apply Leave Details</h3> -->
            </div>


            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Date Wise Attendance</li>            
            </ol>

            </div>
            </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

            <div class="container-fluid">
            <div class="row">
            <div class="col-12">
            <div class="card">



               <div class="col-md-12">
                <?php
                $this->load->view('layout/semester/semester_overview'); ?>
                </div>
                &nbsp;
                

            <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Date Wise Attendance</h3>            
            </div>


            <div class="card-body">
            <div class="card-header"> 
            <form id="admitcardFilter" method="post" action="<?php  echo site_url('student_semester_info/attendancelog/'); ?>">

            <div class="row g-3">
            <div class="col-md-3">                    
            <label for="exam_id" class="form-label">To Date<span class="text-danger">*</span></label>                
            <input type="date"  name="fromdate"  value="<?php echo set_value('fromdate'); ?>" id="fromdate" class="form-control" />
            <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
            </div>

            <div class="col-md-3">
            <label for="exam_id" class="form-label">To Date<span class="text-danger">*</span></label>             
            <input type="date"  name="todate" id="todate" value="<?php echo set_value('todate'); ?>"  class="form-control" />
            <span class="text-danger"><?php echo form_error('todate'); ?></span>
            </div> 

            <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Search</button>
            </div>
            </div>
            </form> 
            </div>


            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th><i class="bi bi-hash me-2"></i>Sl.No</th>
            <th><i class="bi bi-calendar3 me-2"></i>Attendance Date</th>

            <th><i class="bi bi-check-circle me-2"></i>Status</th>
            <th><i class="bi bi-clock me-2"></i>Created Date</th>
            <th><i class="bi bi-chat-left-text me-2"></i>Notes</th>
            </tr>
            </thead>

            <tbody>
            <?php if (empty($get_datewise_attendence)) { ?>
            <tr class="empty-state">
            <td colspan="7" class="text-center">
            <i class="bi bi-inbox" style="font-size: 48px; color: #6c757d;"></i>
            <p class="mb-0 mt-2">No attendance records found for the selected date range.</p>
            </td>
            </tr>
            <?php } else { ?>
            <?php 
            $slno = 1;
            foreach ($get_datewise_attendence as $attendance) 
            { 
            // Determine attendance status
            $status_class = '';
            $status_text = '';

            if ($attendance['attend_status'] == 1) {
            $status_class = 'badge bg-success';
            $status_text = 'Present';
            } else {
            $status_class = 'badge bg-danger';
            $status_text = 'Absent';
            }
            ?>
            <tr>
            <td><?php echo $slno; ?></td>
            <td><?php echo date('d-M-Y', strtotime($attendance['attend_date'])); ?></td>

            <td>
            <span class="<?php echo $status_class; ?>">
            <?php echo $status_text; ?>
            </span>
            </td>
            <td><?php echo date('d-M-Y h:i A', strtotime($attendance['attend_CreatedDate'])); ?></td>
            <td><?php echo !empty($attendance['attend_notes']) ? $attendance['attend_notes'] : '-'; ?></td>
            </tr>
            <?php 
            $slno++;
            } ?>
            <?php } ?>
            </tbody>

            <tfoot>
            <tr>
            <th><i class="bi bi-hash me-2"></i>Sl.No</th>
            <th><i class="bi bi-calendar3 me-2"></i>Attendance Date</th>

            <th><i class="bi bi-check-circle me-2"></i>Status</th>
            <th><i class="bi bi-clock me-2"></i>Created Date</th>
            <th><i class="bi bi-chat-left-text me-2"></i>Notes</th>
            </tr>
            </tfoot>
            </table>
            </div>


            <div class="card mt-3">
            <div class="card-body">
            <h5 class="card-title">Attendance Summary</h5>
            <br>
            <div class="row">
            <?php 
            $total_days = count($get_datewise_attendence);
            $present_days = 0;
            $absent_days = 0;

            foreach ($get_datewise_attendence as $attendance) {
            if ($attendance['attend_status'] == 1) {
            $present_days++;
            } else {
            $absent_days++;
            }
            }

            $attendance_percentage = $total_days > 0 ? round(($present_days / $total_days) * 100, 2) : 0;
            ?>



            <div class="col-md-3">
            <div class="card bg-primary text-white">
            <div class="card-body">
            <h6>Total Days</h6>
            <h3><?php echo $total_days; ?></h3>
            </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card bg-success text-white">
            <div class="card-body">
            <h6>Present Days</h6>
            <h3><?php echo $present_days; ?></h3>
            </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card bg-danger text-white">
            <div class="card-body">
            <h6>Absent Days</h6>
            <h3><?php echo $absent_days; ?></h3>
            </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card bg-info text-white">
            <div class="card-body">
            <h6>Attendance %</h6>
            <h3><?php echo $attendance_percentage; ?>%</h3>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>


            <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->



            <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->


            <!-- Modal -->











