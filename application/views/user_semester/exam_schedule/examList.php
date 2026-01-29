
            <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"> -->

            <?php /* ?>
            <div class="content-wrapper" >
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small></h1>
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-warning">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><?php echo $this->lang->line('exam_schedule'); ?> </h3>
            <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body table-responsive">
            <div class="download_label"><?php echo $this->lang->line('exam_schedule'); ?></div>
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <th style="width: 30px">#</th>
            <th><?php echo $this->lang->line('exam'); ?></th>
            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (empty($examSchedule)) {
            ?>
            <?php
            } 
            else
            {
            $count = 1;
            foreach ($examSchedule as $exam) {
            ?>
            <tr>
            <td><?php echo $count; ?>.</td>
            <td><?php echo $exam->exam; ?></td>
            <td class="pull-right">
            <a  class="btn btn-primary btn-xs schedule_modal" data-toggle="tooltip" title="" data-examname="<?php echo $exam->exam; ?>" data-examid="<?php echo $exam->exam_group_class_batch_exam_id; ?>" >
            <i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?>
            </a>
            </td>
            </tr>
            <?php
            $count++;
            }
            }
            ?>
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
            </section>
            </div>



            <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="scheduleModalLabel">Exam Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <!-- For Bootstrap 4 use: <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>

            <div class="modal-body">
            Loading...
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <!-- For Bootstrap 4 use: data-dismiss="modal" -->
            </div>

            </div>
            </div>
            </div>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script type="text/javascript">

            $(document).ready(function () 
            {  

            var date_format = '<?php echo strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']); ?>';

            $(document).on('click', '.schedule_modal', function () {
            $('.modal-title').html("");
            var exam_id = $(this).data('examid');
            var examname = $(this).data('examname');

            $('.modal-title').html(examname);
            var base_url = '<?php echo base_url() ?>';

            $.ajax({
            type: "post",
            url: base_url + "student_semester_info/examSchedule/getexamscheduledetail",
            data: { 'exam_id': exam_id },
            dataType: "json",
            success: function (response) {
            $('.modal-body').html(response.result);
            $("#scheduleModal").modal('show');

            // Only run this if you actually have a DataTable in your modal
            var dtable = $('.modal-body').find('table').DataTable();

            new $.fn.dataTable.Buttons(dtable, {
            buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'print', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'colvis', text: '<i class="fa fa-columns"></i>', titleAttr: 'Columns', postfixButtons: ['colvisRestore'] }
            ]
            });

            dtable.buttons(0, null).container().prependTo(
            dtable.table().container()
            );
            },
            error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            }
            });
            });

            });


            </script>

            <?php */   /* ?>



            <main class="main-content" id="mainContent">
            <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
            <div class="col">
            <h2 class="mb-1">User Management</h2>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
            </nav>
            </div>
            </div>

            <!-- Add User Form -->
            <div class="row mb-4">
            <div class="col-12">
            <div class="card">
            <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Add New User</h5>
            </div>
            <div class="card-body">
            <div class="box-body table-responsive">
            <div class="download_label"><?php echo $this->lang->line('exam_schedule'); ?></div>
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <th style="width: 30px">#</th>
            <th><?php echo $this->lang->line('exam'); ?></th>
            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (empty($examSchedule)) {
            ?>
            <?php
            } 
            else
            {
            $count = 1;
            foreach ($examSchedule as $exam) {
            ?>
            <tr>
            <td><?php echo $count; ?>.</td>
            <td><?php echo $exam->exam; ?></td>
            <td class="pull-right">
            <a  class="btn btn-primary btn-xs schedule_modal" data-toggle="tooltip" title="" data-examname="<?php echo $exam->exam; ?>" data-examid="<?php echo $exam->exam_group_class_batch_exam_id; ?>" >
            <i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?>
            </a>
            </td>
            </tr>
            <?php
            $count++;
            }
            }
            ?>
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </main>

            <script type="text/javascript">

            $(document).ready(function () 
            { 
            var date_format = '<?php echo strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']); ?>';

            $(document).on('click', '.schedule_modal', function () {
            $('.modal-title').html("");
            var exam_id = $(this).data('examid');
            var examname = $(this).data('examname');

            $('.modal-title').html(examname);
            var base_url = '<?php echo base_url() ?>';

            $.ajax({
            type: "post",
            url: base_url + "student_semester_info/examSchedule/getexamscheduledetail",
            data: { 'exam_id': exam_id },
            dataType: "json",
            success: function (response) {
            $('.modal-body').html(response.result);
            $("#scheduleModal").modal('show');

            // Only run this if you actually have a DataTable in your modal
            var dtable = $('.modal-body').find('table').DataTable();

            new $.fn.dataTable.Buttons(dtable, {
            buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'print', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'colvis', text: '<i class="fa fa-columns"></i>', titleAttr: 'Columns', postfixButtons: ['colvisRestore'] }
            ]
            });

            dtable.buttons(0, null).container().prependTo(
            dtable.table().container()
            );
            },
            error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            }
            });
            });

            });

            </script>

            <?php */ ?>


            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Exam List</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Exam List</li>
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
            <div class="card-header">
            <h3 class="card-title">Exam List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th style="width: 30px">#</th>
            <th><?php echo $this->lang->line('exam'); ?></th>
            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (empty($examSchedule)) {
            ?>
            <?php
            } 
            else
            {
            $count = 1;
            foreach ($examSchedule as $exam)
            {
            ?>
            <tr>
            <td><?php echo $count; ?>.</td>
            <td><?php echo $exam->exam; ?></td>
            <td class="pull-right">
            <a  class="btn btn-primary btn-xs schedule_modal" data-toggle="tooltip" title="" data-examname="<?php echo $exam->exam; ?>" data-examid="<?php echo $exam->exam_group_class_batch_exam_id; ?>" >
            <i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?>
            </a>
            </td>
            </tr>
            <?php
            $count++;
            }
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <th style="width: 30px">#</th>
            <th><?php echo $this->lang->line('exam'); ?></th>
            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </tfoot>
            </table>
            </div>



            <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title" id="scheduleModalLabel">Exam Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>            
            </div>

            <div class="modal-body">
            Loading...
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>         
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





            <script type="text/javascript">
            $(document).ready(function () 
            { 
            var date_format = '<?php echo strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'MM', 'Y' => 'yyyy']); ?>';

            $(document).on('click', '.schedule_modal', function () {
            $('.modal-title').html("");
            var exam_id = $(this).data('examid');
            var examname = $(this).data('examname');

            $('.modal-title').html(examname);
            var base_url = '<?php echo base_url() ?>';

            $.ajax({
            type: "post",
            url: base_url + "student_semester_info/examSchedule/getexamscheduledetail",
            data: { 'exam_id': exam_id },
            dataType: "json",
            success: function (response) {
            $('.modal-body').html(response.result);
            $("#scheduleModal").modal('show');

            // Only run this if you actually have a DataTable in your modal
            var dtable = $('.modal-body').find('table').DataTable();

            new $.fn.dataTable.Buttons(dtable, {
            buttons: [
            { extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'csvHtml5', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'print', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', title: examname, exportOptions: { columns: ':visible' } },
            { extend: 'colvis', text: '<i class="fa fa-columns"></i>', titleAttr: 'Columns', postfixButtons: ['colvisRestore'] }
            ]
            });

            dtable.buttons(0, null).container().prependTo(
            dtable.table().container()
            );
            },
            error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            }
            });
            });

            });

            </script>
