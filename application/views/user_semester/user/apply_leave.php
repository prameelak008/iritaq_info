               
            <?php
            /* 
            ?>
               <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Student Leave Application</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
                <style>
                body {
                background-color: #f8f9fa;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                
                </style>
                </head>
                <body>
                <main class="main-content py-4" id="mainContent">
                <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                <div class="row align-items-center">
                <div class="col-md-6">
                <h2 class="mb-2">Apply Leave</h2>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Leave Application</li>
                </ol>
                </nav>
                </div>

                <div class="col-md-6 text-md-end">
                <button id="myBtn" class="btn btn-gradient">
                <i class="bi bi-plus-circle me-2"></i>Apply for Leave
                </button>
                </div>

                </div>

                <div class="table-card">
                <!-- <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0" id="leaveTable"> -->

                <div class="box-body table-responsive">
                          
                  <div class="box-body">
          <div class="table-responsive mailbox-messages">
          <table class="table table-striped table-bordered table-hover example">            
                <thead>
                <tr>
                <th><i class="bi bi-calendar3 me-2"></i>Sl.No</th>
                <th><i class="bi bi-calendar3 me-2"></i>Apply Date</th>
                <th><i class="bi bi-clock me-2"></i>From Date</th>
                <th><i class="bi bi-clock-history me-2"></i>To Date</th>

                <th><i class="bi bi-clock me-2"></i>From Time</th>
                <th><i class="bi bi-clock-history me-2"></i>To Time</th>

                <th><i class="bi bi-chat-left-text me-2"></i>Reason</th>
                <th><i class="bi bi-info-circle me-2"></i>Approve By</th>
                <th><i class="bi bi-gear me-2"></i>Action</th>
                <th><i class="bi bi-printer me-2"></i>Print</th>
                </tr>
                </thead>
                <tbody id="leaveTableBody">

                <?php if (empty($applyleavelist)) { ?>
                <tr class="empty-state">
                <td colspan="8">
                <i class="bi bi-inbox"></i>
                <p class="mb-0">No leave applications yet. Click "Apply for Leave" to get started.</p>
                </td>
                </tr>
                <?php } else { ?>
                    

                <?php 
                $slno=1;
                foreach ($applyleavelist as $leave) { ?>
                <tr data-id="<?php echo $leave['id']; ?>">
                <td><?php echo $slno ; ?></td>
                 <td><?php echo $leave['apply_date']; ?></td>
               
                <td><?php echo $leave['from_date']; ?></td>   

                <td><?php echo $leave['to_date']; ?></td>
                <td><?php echo $leave['leave_from_time']; ?></td>
                <td><?php echo $leave['leave_to_time']; ?></td>
                <td><?php echo $leave['reason']; ?></td>
                <td><?php echo $leave['approve_by']; ?></td>

                <!-- Edit Button -->

                <td>
                
                <button 
                class="btn btn-sm btn-primary editLeaveBtn"
                data-id="<?php echo $leave['id']; ?>"
                data-applydate="<?php echo $leave['apply_date']; ?>"
                data-fromdate="<?php echo $leave['from_date']; ?>"
                data-fromtime="<?php echo $leave['leave_from_time']; ?>"
                data-todate="<?php echo $leave['to_date']; ?>"
                data-totime="<?php echo $leave['leave_to_time']; ?>"
                data-reason="<?php echo htmlspecialchars($leave['reason']); ?>"
                >
                <i class="fa  fa-edit"></i>
                </button>

                <a href="<?php echo site_url('student_semester_info/apply_leave/delete/'.$leave['id']); ?>"
                onclick="return confirm('Are you sure you want to delete this leave?');"
                class="btn btn-sm btn-danger">
                <i class="fa  fa-trash"></i>
                </a>


                </td>

                <!-- Delete Button -->
                <td>
          <button type="button"
        class="btn btn-sm btn-success printBtn"
        data-name="<?php echo $student_name; ?>"
        data-applydate="<?php echo $leave['apply_date']; ?>"
        data-fromdate="<?php echo $leave['from_date']; ?>"
        data-fromtime="<?php echo $leave['leave_from_time']; ?>"
        data-todate="<?php echo $leave['to_date']; ?>"
        data-totime="<?php echo $leave['leave_to_time']; ?>"
        data-reason="<?php echo htmlspecialchars($leave['reason'], ENT_QUOTES); ?>">
    <i class="bi bi-printer"></i>
</button>
                </td>
                </tr>

                <?php 
            $slno++;
            } ?>

                <?php } ?>

                </tbody>

                </table>
                </div>
                </div>
                </div>

                <!-- Bootstrap Table Card -->

                </div>
                </main>


                <!-- Modal -->
                 
<div class="modal fade" id="editmyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-file-earmark-text me-2"></i>Apply for Leave</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                <form id="leaveForm" method="POST" action="<?php echo site_url('student_semester_info/apply_leave/add_leave'); ?>" enctype="multipart/form-data">

                <input type="hidden" name="leave_id" id="leave_id">
                <div class="row g-3">
                <!-- Apply Date -->
                <div class="col-md-6">
                <label class="form-label">Apply Date<span class="required">*</span></label>
                <input type="date" class="form-control" id="applyDate" name="applyDate" required>
                </div>

                <div class="col-md-6">

                </div>

                <!-- From Date -->
                <div class="col-md-6">
                <label class="form-label">From Date<span class="required">*</span></label>
                <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                </div>

                <!-- From Time -->
                <div class="col-md-6">
                <label class="form-label">From Time<span class="required">*</span></label>
                <input type="time" class="form-control" id="fromTime" name="fromTime" required>
                </div>

                <!-- To Date -->
                <div class="col-md-6">
                <label class="form-label">To Date<span class="required">*</span></label>
                <input type="date" class="form-control" id="toDate" name="toDate" required>
                </div>

                <!-- To Time -->
                <div class="col-md-6">
                <label class="form-label">To Time<span class="required">*</span></label>
                <input type="time" class="form-control" id="toTime" name="toTime" required>
                </div>

                <!-- Reason -->
                <div class="col-12">
                <label class="form-label">Reason<span class="required">*</span></label>
                <textarea class="form-control" id="reason" name="reason" placeholder="Please provide a detailed reason for your leave..." required></textarea>
                </div>

                <!-- Attach Document -->
                <div class="col-12">
                <label class="form-label">Attach Document (Optional)</label>
                <div class="file-input-wrapper">
                <input type="file" id="document" name="document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                <label for="document" class="file-input-label">
                <i class="bi bi-cloud-upload me-2"></i>
                Choose File or Drag & Drop
                </label>
                </div>
                <div id="fileName" class="file-name"></div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                <button type="submit" class="btn-submit">
                <i class="bi bi-send me-2"></i>Submit Leave Application
                </button>
                </div>


                </div>
                </form>
       
      </div>
    </div>
  </div>
</div>

               

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


                <script>                    
                // Get DOM elements
                const modal = document.getElementById("myModal");
                const btn = document.getElementById("myBtn");
                const span = document.getElementsByClassName("close")[0];
                const leaveForm = document.getElementById("leaveForm");
                const leaveTableBody = document.getElementById("leaveTableBody");
                const fileInput = document.getElementById("document");
                const fileName = document.getElementById("fileName");

                // Set today's date as default for apply date
                document.getElementById("applyDate").valueAsDate = new Date();

                // Open modal
                btn.onclick = function() {
                modal.style.display = "block";
                }

                // Close modal
                span.onclick = function() {
                modal.style.display = "none";
                }

                // Close modal when clicking outside
                window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
                }
                }

                // File input change
                fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                fileName.innerHTML = '<i class="bi bi-paperclip me-1"></i>' + this.files[0].name;
                } else {
                fileName.textContent = '';
                }
                });

                // Form submission
                leaveForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const semester = document.getElementById('semester').value;
                const applyDate = document.getElementById('applyDate').value;
                const fromDate = document.getElementById('fromDate').value;
                const fromTime = document.getElementById('fromTime').value;
                const toDate = document.getElementById('toDate').value;
                const toTime = document.getElementById('toTime').value;
                const reason = document.getElementById('reason').value;
                const documentFile = fileInput.files[0];

                // Format dates
                const formatDate = (date) => {
                const d = new Date(date);
                return d.toLocaleDateString('en-GB');
                };

                // Format time to 12-hour format
                const formatTime = (time) => {
                const [hours, minutes] = time.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const hour12 = hour % 12 || 12;
                return `${hour12}:${minutes} ${ampm}`;
                };

                // Create new row
                const tbody = document.getElementById('leaveTableBody');

                // Remove empty state if it exists
                const emptyState = tbody.querySelector('.empty-state');
                if (emptyState) {
                emptyState.remove();
                }

                const newRow = tbody.insertRow(0); // Insert at the beginning
                newRow.innerHTML = `
                <td>Semester ${semester}</td>
                <td>${formatDate(applyDate)}</td>
                <td>${formatDate(fromDate)} ${formatTime(fromTime)}</td>
                <td>${formatDate(toDate)} ${formatTime(toTime)}</td>
                <td>${reason.substring(0, 40)}${reason.length > 40 ? '...' : ''}</td>
                <td><span class="badge badge-status bg-warning text-dark">Pending</span></td>
                <td>
                <button class="btn btn-sm btn-info text-white" onclick="viewDetails(this)">
                <i class="bi bi-eye"></i> View
                </button>
                </td>
                <td>
                <button class="btn btn-sm btn-secondary" onclick="printLeave(this)">
                <i class="bi bi-printer"></i> Print
                </button>
                </td>
                `;

                // Store full data in row's dataset
                newRow.dataset.fullReason = reason;
                newRow.dataset.document = documentFile ? documentFile.name : 'No document';
                newRow.dataset.semester = semester;
                newRow.dataset.applyDate = formatDate(applyDate);
                newRow.dataset.fromDateTime = `${formatDate(fromDate)} ${formatTime(fromTime)}`;
                newRow.dataset.toDateTime = `${formatDate(toDate)} ${formatTime(toTime)}`;

                // Close modal and reset form
                modal.style.display = "none";
                leaveForm.reset();
                fileName.textContent = '';

                // Show Bootstrap alert
                showAlert('success', 'Leave application submitted successfully!');
                });
                
                </script>  
                
                



<script>
document.querySelectorAll('.printBtn').forEach(btn => {
    btn.addEventListener('click', function () {

        const win = window.open('', '', 'width=900,height=600');

        win.document.write(`
        <html>
        <head>
            <title>Leave Application</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 30px;
                }
                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 10px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                    width: 30%;
                }
            </style>
        </head>
        <body>

        <h2>Leave Application</h2>

        <table>
            <tr>
                <th>Student Name</th>
                <td><?php echo $firstname;  ?></td>
            </tr>
            <tr>
                <th>Apply Date</th>
                <td>${this.dataset.applydate}</td>
            </tr>
            <tr>
                <th>From Date</th>
                <td>${this.dataset.fromdate} ${this.dataset.fromtime}</td>
            </tr>
            <tr>
                <th>To Date</th>
                <td>${this.dataset.todate} ${this.dataset.totime}</td>
            </tr>
            <tr>
                <th>Reason</th>
                <td>${this.dataset.reason}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>Pending</td>
            </tr>
        </table>

        </body>
        </html>
        `);

        win.document.close();
        win.focus();
        win.print();
    });
});








document.addEventListener('DOMContentLoaded', function () {
    const myModalEl = document.getElementById('editmyModal');
    const bootstrapModal = new bootstrap.Modal(myModalEl);
    const leaveForm = document.getElementById('leaveForm');

    // Add Leave button
    document.getElementById('myBtn').addEventListener('click', () => {
        leaveForm.reset();
        document.getElementById('leave_id').value = '';
        leaveForm.action = "<?php echo site_url('student_semester_info/apply_leave/add_leave'); ?>";
        bootstrapModal.show();
    });

    // Edit Leave buttons
    document.querySelectorAll('.editLeaveBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('leave_id').value = this.dataset.id;
            document.getElementById('applyDate').value = this.dataset.applydate;
            document.getElementById('fromDate').value  = this.dataset.fromdate;
            document.getElementById('fromTime').value  = this.dataset.fromtime;
            document.getElementById('toDate').value    = this.dataset.todate;
            document.getElementById('toTime').value    = this.dataset.totime;
            document.getElementById('reason').value    = this.dataset.reason;

            leaveForm.action = "<?php echo site_url('student_semester_info/apply_leave/update_leave'); ?>";
            bootstrapModal.show();
        });
    });
});


</script>




                </body>
                </html>

                <?php */ ?>





  <!-- Bootstrap JS Bundle with Popper -->


  <!-- Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item active">Apply Leave</li>
            
            </ol>

             <!-- <button id="myBtn" class="btn btn-gradient">
                <i class="btn btn-primary"></i>
                </button> -->
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

            <div class="card-header d-flex align-items-center">
            <h3 class="card-title mb-0">Apply Leave</h3>

            <button type="button" id="myBtn" class="btn btn-primary ml-auto">
            Apply for Leave
            </button>
            </div>

            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th><i class="bi bi-calendar3 me-2"></i>Sl.No</th>
            <th><i class="bi bi-calendar3 me-2"></i>Apply Date</th>
            <th><i class="bi bi-clock me-2"></i>From Date</th>
            <th><i class="bi bi-clock-history me-2"></i>To Date</th>

            <th><i class="bi bi-clock me-2"></i>From Time</th>
            <th><i class="bi bi-clock-history me-2"></i>To Time</th>

            <th><i class="bi bi-chat-left-text me-2"></i>Reason</th>
            <th><i class="bi bi-info-circle me-2"></i>Approve By</th>
            <th><i class="bi bi-gear me-2"></i>Action</th>
            <th><i class="bi bi-printer me-2"></i>Print</th>
            </tr>
            </thead>

            <tbody id="leaveTableBody">

            <?php if (empty($applyleavelist)) { ?>
            <tr class="empty-state">
            <td colspan="8">
            <i class="bi bi-inbox"></i>
            <p class="mb-0">No leave applications yet. Click "Apply for Leave" to get started.</p>
            </td>
            </tr>
            <?php } else { ?>


            <?php 
            $slno=1;
            foreach ($applyleavelist as $leave) { ?>
            <tr data-id="<?php echo $leave['id']; ?>">
            <td><?php echo $slno ; ?></td>
            <td><?php echo $leave['apply_date']; ?></td>

            <td><?php echo $leave['from_date']; ?></td>   

            <td><?php echo $leave['to_date']; ?></td>
            <td><?php echo $leave['leave_from_time']; ?></td>
            <td><?php echo $leave['leave_to_time']; ?></td>
            <td><?php echo $leave['reason']; ?></td>
            <td><?php echo $leave['approve_by']; ?></td>

            <!-- Edit Button -->

            <!-- <td>

            <button 
            class="btn btn-sm btn-primary editLeaveBtn"
            data-id="<?php echo $leave['id']; ?>"
            data-applydate="<?php echo $leave['apply_date']; ?>"
            data-fromdate="<?php echo $leave['from_date']; ?>"
            data-fromtime="<?php echo $leave['leave_from_time']; ?>"
            data-todate="<?php echo $leave['to_date']; ?>"
            data-totime="<?php echo $leave['leave_to_time']; ?>"
            data-reason="<?php echo htmlspecialchars($leave['reason']); ?>"
            >
            <i class="fa  fa-edit"></i>
            </button>

            <a href="<?php echo site_url('student_semester_info/apply_leave/delete/'.$leave['id']); ?>"
            onclick="return confirm('Are you sure you want to delete this leave?');"
            class="btn btn-sm btn-danger">
            <i class="fa  fa-trash"></i>
            </a>

            </td> -->

            <td class="d-flex justify-content-center align-items-center" style="gap: 5px;">
            <button 
            class="btn btn-sm btn-primary editLeaveBtn"
            data-id="<?php echo $leave['id']; ?>"
            data-applydate="<?php echo $leave['apply_date']; ?>"
            data-fromdate="<?php echo $leave['from_date']; ?>"
            data-fromtime="<?php echo $leave['leave_from_time']; ?>"
            data-todate="<?php echo $leave['to_date']; ?>"
            data-totime="<?php echo $leave['leave_to_time']; ?>"
            data-reason="<?php echo htmlspecialchars($leave['reason']); ?>"
            title="Edit Leave">
            <i class="fa fa-edit"></i>
            </button>
            <a href="<?php echo site_url('student_semester_info/apply_leave/delete/'.$leave['id']); ?>"
            onclick="return confirm('Are you sure you want to delete this leave?');"
            class="btn btn-sm btn-danger"
            title="Delete Leave">
            <i class="fa fa-trash"></i>
            </a>
            </td>

            <!-- Delete Button -->
                <td>
                <button type="button"
                class="btn btn-sm btn-success printBtn"
                data-name="<?php echo $student_name; ?>"
                data-applydate="<?php echo $leave['apply_date']; ?>"
                data-fromdate="<?php echo $leave['from_date']; ?>"
                data-fromtime="<?php echo $leave['leave_from_time']; ?>"
                data-todate="<?php echo $leave['to_date']; ?>"
                data-totime="<?php echo $leave['leave_to_time']; ?>"
                data-reason="<?php echo htmlspecialchars($leave['reason'], ENT_QUOTES); ?>">
                <i class="fa fa-print"></i>
                </button>
                </td>


            </tr>

            <?php 
            $slno++;
            } ?>

            <?php } ?>

            </tbody>

            <tfoot>
            <tr>
            <th><i class="bi bi-calendar3 me-2"></i>Sl.No</th>
            <th><i class="bi bi-calendar3 me-2"></i>Apply Date</th>
            <th><i class="bi bi-clock me-2"></i>From Date</th>
            <th><i class="bi bi-clock-history me-2"></i>To Date</th>
            <th><i class="bi bi-clock me-2"></i>From Time</th>
            <th><i class="bi bi-clock-history me-2"></i>To Time</th>
            <th><i class="bi bi-chat-left-text me-2"></i>Reason</th>
            <th><i class="bi bi-info-circle me-2"></i>Approve By</th>
            <th><i class="bi bi-gear me-2"></i>Action</th>
            <th><i class="bi bi-printer me-2"></i>Print</th>
            </tr>
            </tfoot>
            </table>
            </div>



                <div class="modal fade" id="editmyModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <!-- <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-file-earmark-text me-2"></i>Apply for Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="modal-header">
                <h5 class="modal-title">
                <i class="bi bi-file-earmark-text me-2"></i>Apply for Leave
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">
                <form id="leaveForm" method="POST" action="<?php echo site_url('student_semester_info/apply_leave/add_leave'); ?>" enctype="multipart/form-data">

                <input type="hidden" name="leave_id" id="leave_id">
                <div class="row g-3">
                <!-- Apply Date -->
                <div class="col-md-6">
                <label class="form-label">Apply Date<span class="required">*</span></label>
                <input type="date" class="form-control" id="applyDate" name="applyDate" required>
                </div>

                <div class="col-md-6">

                </div>

                <!-- From Date -->
                <div class="col-md-6">
                <label class="form-label">From Date<span class="required">*</span></label>
                <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                </div>

                <!-- From Time -->
                <div class="col-md-6">
                <label class="form-label">From Time<span class="required">*</span></label>
                <input type="time" class="form-control" id="fromTime" name="fromTime" required>
                </div>

                <!-- To Date -->
                <div class="col-md-6">
                <label class="form-label">To Date<span class="required">*</span></label>
                <input type="date" class="form-control" id="toDate" name="toDate" required>
                </div>

                <!-- To Time -->
                <div class="col-md-6">
                <label class="form-label">To Time<span class="required">*</span></label>
                <input type="time" class="form-control" id="toTime" name="toTime" required>
                </div>

                <!-- Reason -->
                <div class="col-12">
                <label class="form-label">Reason<span class="required">*</span></label>
                <textarea class="form-control" id="reason" name="reason" placeholder="Please provide a detailed reason for your leave..." required></textarea>
                </div>



                <!-- Attach Document -->
                <!-- <div class="col-12">
                <label class="form-label">Attach Document (Optional)</label>
                <div class="file-input-wrapper">
                <input type="file" id="document" name="document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                <label for="document" class="file-input-label">
                <i class="bi bi-cloud-upload me-2"></i>
                Choose File or Drag & Drop
                </label>
                </div>
                <div id="fileName" class="file-name"></div>
                </div> -->




                <div class="col-12">
                <label class="form-label">Attach Document (Optional)</label>
                <div class="file-input-wrapper">
                <input 
                type="file" 
                id="document" 
                name="document" 
                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">

                <!-- <label for="document" class="file-input-label">
                <i class="bi bi-cloud-upload mr-2"></i>
                Choose File or Drag & Drop
                </label> -->
                </div>

                <div id="fileName" class="file-name"></div>
                </div>





                <!-- Submit Button -->
                <div class="col-12">
                <!-- <button type="submit" class="btn-submit">
                 Submit Leave Application
                </button> -->


                <!-- <button type="submit" id="myBtn" class="btn btn-primary ml-auto">
                Apply & Edit for Leave
                </button> -->
                
                    <br>

                    <div class="col-12 text-center">
                    <button type="submit" id="myBtn" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Apply & Edit Leave
                    </button>
                    </div>

            
            </div>


                </div>
                </form>
       
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
                 

         


            


                <script>                    
                // Get DOM elements
                const modal = document.getElementById("myModal");
                const btn = document.getElementById("myBtn");
                const span = document.getElementsByClassName("close")[0];
                const leaveForm = document.getElementById("leaveForm");
                const leaveTableBody = document.getElementById("leaveTableBody");
                const fileInput = document.getElementById("document");
                const fileName = document.getElementById("fileName");

                // Set today's date as default for apply date
                document.getElementById("applyDate").valueAsDate = new Date();

                // Open modal
                btn.onclick = function() {
                modal.style.display = "block";
                }

                // Close modal
                span.onclick = function() {
                modal.style.display = "none";
                }

                // Close modal when clicking outside
                window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
                }
                }

                // File input change
                fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                fileName.innerHTML = '<i class="bi bi-paperclip me-1"></i>' + this.files[0].name;
                } else {
                fileName.textContent = '';
                }
                });

                // Form submission
                leaveForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const semester = document.getElementById('semester').value;
                const applyDate = document.getElementById('applyDate').value;
                const fromDate = document.getElementById('fromDate').value;
                const fromTime = document.getElementById('fromTime').value;
                const toDate = document.getElementById('toDate').value;
                const toTime = document.getElementById('toTime').value;
                const reason = document.getElementById('reason').value;
                const documentFile = fileInput.files[0];

                // Format dates
                const formatDate = (date) => {
                const d = new Date(date);
                return d.toLocaleDateString('en-GB');
                };

                // Format time to 12-hour format
                const formatTime = (time) => {
                const [hours, minutes] = time.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const hour12 = hour % 12 || 12;
                return `${hour12}:${minutes} ${ampm}`;
                };

                // Create new row
                const tbody = document.getElementById('leaveTableBody');

                // Remove empty state if it exists
                const emptyState = tbody.querySelector('.empty-state');
                if (emptyState) {
                emptyState.remove();
                }

                const newRow = tbody.insertRow(0); // Insert at the beginning
                newRow.innerHTML = `
                <td>Semester ${semester}</td>
                <td>${formatDate(applyDate)}</td>
                <td>${formatDate(fromDate)} ${formatTime(fromTime)}</td>
                <td>${formatDate(toDate)} ${formatTime(toTime)}</td>
                <td>${reason.substring(0, 40)}${reason.length > 40 ? '...' : ''}</td>
                <td><span class="badge badge-status bg-warning text-dark">Pending</span></td>
                <td>
                <button class="btn btn-sm btn-info text-white" onclick="viewDetails(this)">
                <i class="bi bi-eye"></i> View
                </button>
                </td>
                <td>
                <button class="btn btn-sm btn-secondary" onclick="printLeave(this)">
                <i class="bi bi-printer"></i> Print
                </button>
                </td>
                `;

                // Store full data in row's dataset
                newRow.dataset.fullReason = reason;
                newRow.dataset.document = documentFile ? documentFile.name : 'No document';
                newRow.dataset.semester = semester;
                newRow.dataset.applyDate = formatDate(applyDate);
                newRow.dataset.fromDateTime = `${formatDate(fromDate)} ${formatTime(fromTime)}`;
                newRow.dataset.toDateTime = `${formatDate(toDate)} ${formatTime(toTime)}`;

                // Close modal and reset form
                modal.style.display = "none";
                leaveForm.reset();
                fileName.textContent = '';

                // Show Bootstrap alert
                showAlert('success', 'Leave application submitted successfully!');
                });
                
               
document.querySelectorAll('.printBtn').forEach(btn => {
    btn.addEventListener('click', function () {

        const win = window.open('', '', 'width=900,height=600');

        win.document.write(`
        <html>
        <head>
            <title>Leave Application</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 30px;
                }
                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 10px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                    width: 30%;
                }
            </style>
        </head>
        <body>

        <h2>Leave Application</h2>

        <table>
            <tr>
                <th>Student Name</th>
                <td><?php echo $firstname;  ?></td>
            </tr>
            <tr>
                <th>Apply Date</th>
                <td>${this.dataset.applydate}</td>
            </tr>
            <tr>
                <th>From Date</th>
                <td>${this.dataset.fromdate} ${this.dataset.fromtime}</td>
            </tr>
            <tr>
                <th>To Date</th>
                <td>${this.dataset.todate} ${this.dataset.totime}</td>
            </tr>
            <tr>
                <th>Reason</th>
                <td>${this.dataset.reason}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>Pending</td>
            </tr>
        </table>

        </body>
        </html>
        `);

        win.document.close();
        win.focus();
        win.print();
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const myModalEl = document.getElementById('editmyModal');
    const bootstrapModal = new bootstrap.Modal(myModalEl);
    const leaveForm = document.getElementById('leaveForm');

    // Add Leave button
    document.getElementById('myBtn').addEventListener('click', () => {
        leaveForm.reset();
        document.getElementById('leave_id').value = '';
        leaveForm.action = "<?php echo site_url('student_semester_info/apply_leave/add_leave'); ?>";
        bootstrapModal.show();
    });

    // Edit Leave buttons
    document.querySelectorAll('.editLeaveBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('leave_id').value = this.dataset.id;
            document.getElementById('applyDate').value = this.dataset.applydate;
            document.getElementById('fromDate').value  = this.dataset.fromdate;
            document.getElementById('fromTime').value  = this.dataset.fromtime;
            document.getElementById('toDate').value    = this.dataset.todate;
            document.getElementById('toTime').value    = this.dataset.totime;
            document.getElementById('reason').value    = this.dataset.reason;

            leaveForm.action = "<?php echo site_url('student_semester_info/apply_leave/update_leave'); ?>";
            bootstrapModal.show();
        });
    });
});
</script>
          
            
