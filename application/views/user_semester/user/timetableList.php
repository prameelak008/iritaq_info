
                <?php
                /*
                ?>
                <main class="main-content" id="mainContent">
                <div class="container-fluid">
                <!-- Page Header -->
                <div class="row mb-4">
                <div class="col">
                <h2 class="mb-1">Dashboard</h2>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Timetable</li>
                </ol>
                </nav>
                </div>
                </div>

                <!-- ADD THIS ROW WRAPPER -->
                <div class="row">
                <!-- Profile Card -->
                <div class="col-12 col-md-12">




                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example" >
                <thead>
                <tr>
                <th>Time</th>
                <?php foreach ($days as $dayKey => $dayLabel) { ?>
                <th><?php echo ucfirst($dayKey); ?></th>
                <?php } ?>
                </tr>
                </thead>

                <tbody>
                <?php
                $hasSchedule = false;
                foreach ($timetable as $time => $daysData) {
                foreach ($daysData as $val) {
                if (!empty($val)) {
                $hasSchedule = true;
                break 2;
                }
                }
                }

                if ($hasSchedule) {
                foreach ($time_slots as $time) { ?>
                <tr>
                <td><b><?php echo $time; ?></b></td>
                <?php foreach ($days as $dayKey => $dayLabel) { ?>
                <td>
                <?php
                if (!empty($timetable[$time][$dayKey])) {
                echo $timetable[$time][$dayKey];
                } else {
                echo '<span class="text-muted">Not Scheduled</span>';
                }
                ?>
                </td>
                <?php } ?>
                </tr>
                <?php
                }
                } else { ?>
                <tr>
                <td colspan="<?php echo count($days) + 1; ?>" class="text-center text-danger">
                <b>No timetable scheduled</b>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>




                </div>


                </div>
                </div>
                <!-- END ROW WRAPPER -->

                </div>
                </main>

                <?php */ ?>


                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Timetable</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Timetable</li>
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
                <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Time</th>
                <?php foreach ($days as $dayKey => $dayLabel) { ?>
                <th><?php echo ucfirst($dayKey); ?></th>
                <?php } ?>
                </tr>
                </thead>

                <tbody>
                <?php
                $hasSchedule = false;
                foreach ($timetable as $time => $daysData) {
                foreach ($daysData as $val) {
                if (!empty($val)) {
                $hasSchedule = true;
                break 2;
                }
                }
                }
                
                if ($hasSchedule) {
                foreach ($time_slots as $time) { ?>
                <tr>
                <td><b><?php echo $time; ?></b></td>
                <?php foreach ($days as $dayKey => $dayLabel) { ?>
                <td>
                <?php
                if (!empty($timetable[$time][$dayKey])) {
                echo $timetable[$time][$dayKey];
                } else {
                echo '<span class="text-muted">Not Scheduled</span>';
                }
                ?>
                </td>
                <?php } ?>
                </tr>
                <?php
                }
                } else { ?>
                <tr>
                <td colspan="<?php echo count($days) + 1; ?>" class="text-center text-danger">
                <b>No timetable scheduled</b>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>


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