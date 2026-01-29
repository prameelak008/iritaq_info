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
                <h2 class="mb-2">Home Work</h2>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home Work</li>
                </ol>
                </nav>
                </div>
                </div>

                <div class="table-card">
                <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0" id="leaveTable">
                <thead>
                <tr>
                <th><i class="bi bi-calendar3 me-2"></i>Program</th>
                <th><i class="bi bi-clock me-2"></i>Batch</th>
                <th><i class="bi bi-clock-history me-2"></i>Subject</th>
                <th><i class="bi bi-clock me-2"></i>Homework Date</th>
                <th><i class="bi bi-clock-history me-2"></i>Submission Date</th>
                <th><i class="bi bi-chat-left-text me-2"></i>Evaluation Date</th>
                <th><i class="bi bi-info-circle me-2"></i>Evaluated By</th>
                <th><i class="bi bi-gear me-2"></i>Action</th>            
                </tr>
                </thead>
                <tbody id="leaveTableBody">
                <?php               
                
                if (empty($homeworklist)) { ?>

                <tr class="empty-state">
                <td colspan="8">
                <i class="bi bi-inbox"></i>
                <p class="mb-0">No homework.</p>
                </td>
                </tr>
                <?php } 
                else 
                { 
                ?>
                <?php foreach ($homeworklist as $homework) 
                { 
                ?>                 
                <tr>
                <td><?php echo $homework['p_code'].''.$homework['p_name']; ?></td>
                <td><?php echo $homework['batch_group_name'].''.$homework['batch_group_year']; ?></td>  
                <td><?php echo $homework['name']; ?></td>
                <td><?php echo $homework['create_date']; ?></td>
                <td><?php echo $homework['submit_date']; ?></td>
                <td><?php echo $homework['evaluation_date']; ?></td>
                <td><?php echo $homework['evaluated_by']; ?></td>
                <td>


                <?php //echo $homework['sem_homwork_id']; ?>                    
                <?php //echo $homework['eval_id']; ?> 
                <button type="button"
                class="btn btn-sm btn-primary editLeaveBtn"
                data-id="<?php echo $homework['sem_homwork_id']; ?>"
                data-evaluateid="<?php echo $homework['eval_id']; ?>">
                <i class="fa fa-pencil"></i>
                </button>
                </td>                
                </tr>



                        <div class="modal fade" id="editEvalModal" tabindex="-1">
                        <div class="modal-dialog">
                        <form id="updateEvalForm" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5>Edit Homework Evaluation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                        <input type="hidden" name="eval_id" id="eval_id">                   

                        <label>Message</label>
                        <textarea name="stud_message" id="stud_message" rows="4" class="form-control"></textarea>  
                        <label>Attach Document</label>
                        <input type="file" name="stud_file" id="stud_file" class="form-control">
                        </div>                        

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        </div>
                        </div>
                        </form>
                        </div>
                        </div>



                <?php } ?>

                <?php } ?>

                </tbody>

                </table>

                </div>
                </div>
                </div>           

                </div>
                </main> 
                

                
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript">

$(document).on('click', '.editLeaveBtn', function () 
{
    let id         = $(this).data('id');
    let evalId     = $(this).data('evaluateid');   

    $.ajax({
        url: "<?= base_url('student_semester_info/homework/getEvaluationById') ?>",
        type: "POST",
        data: { id: id,evalId:evalId },
        dataType: "json",
        success: function (res) 
        {
            if (!res)
            {
            alert('No record found');
            return;
            }
            // $('#eval_id').val(res.id);
             $('#eval_id').val(evalId);
            $('#status').val(res.status);
            $('#stud_message').val(res.stud_message);
            $('#date').val(res.date);
            $('#editEvalModal').modal('show');
        }
    });
});



$('#updateEvalForm').on('submit', function(e) 
{
    e.preventDefault();
    let formData = new FormData(this);

    // Debug: log all keys and values
    for (let pair of formData.entries()) {
        console.log(pair[0] + ':', pair[1]);
    }

    $.ajax({
        url: "<?= base_url('student_semester_info/homework/updateEvaluation') ?>",
        type: "POST",
        data: formData,
        contentType: false,  // Important for file upload
        processData: false,  // Important for file upload
        dataType: "json",
        success: function(res) {
            console.log(res); // see the server response
            if (res.status) {
                alert('Updated successfully');
                $('#editEvalModal').modal('hide');
                // location.reload();
            } else {
                alert(res.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});


// $('#updateEvalForm').on('submit', function (e) 
// {   
//     e.preventDefault();   
    
//     console.log($(this).serialize());

//     $.ajax({
//         url: "<?= base_url('student_semester_info/homework/updateEvaluation') ?>",
//         type: "POST",
//         data: $(this).serialize(),
//         success: function () 
//         {
//             alert('Updated successfully');
//             location.reload();
//         }
//     });
// });



// $(document).on('submit', '#updateEvalForm', function(e)
//{
//     e.preventDefault();
//     let formData = new FormData(this);
//     alert(JSON.stringify(formData))

//     $.ajax({
//         url: "<?= base_url('student_semester_info/homework/updateEvaluation') ?>",
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         dataType: "json",
//         success: function(res) {
//             console.log(res);
//             if (res.status) {
//                 alert('Updated successfully');
//                 $('#editEvalModal').modal('hide');
//                 location.reload();
//             } else {
//                 alert(res.error);
//             }
//         }
//     });
// });

                </script>

                <?php */ ?>




  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Homework</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Homework</li>
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
                <h3 class="card-title">Homework</h3>
              </div>
         
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                 <thead>
                <tr>
                <th><i class="bi bi-calendar3 me-2"></i>Program</th>
                <th><i class="bi bi-clock me-2"></i>Batch</th>
                <th><i class="bi bi-clock-history me-2"></i>Subject</th>
                <th><i class="bi bi-clock me-2"></i>Homework Date</th>
                <th><i class="bi bi-clock-history me-2"></i>Submission Date</th>
                <th><i class="bi bi-chat-left-text me-2"></i>Evaluation Date</th>
                <th><i class="bi bi-info-circle me-2"></i>Evaluated By</th>
                <th><i class="bi bi-gear me-2"></i>Action</th>            
                </tr>
                </thead>           

                <tbody>

                <?php               
                /*
                if (empty($homeworklist)) { ?>

                <tr class="empty-state">
                <td colspan="8">
                <i class="bi bi-inbox"></i>
                <p class="mb-0">No homework.</p>
                </td>
                </tr>
                <?php } 
                else 
                { 
                    */
                ?>
                

                
                <?php foreach ($homeworklist as $homework) 
                { 
                ?>                 
                <tr>
                <td><?php echo $homework['p_code'].''.$homework['p_name']; ?></td>
                <td><?php echo $homework['batch_group_name'].''.$homework['batch_group_year']; ?></td>  
                <td><?php echo $homework['name']; ?></td>
                <td><?php echo $homework['create_date']; ?></td>
                <td><?php echo $homework['submit_date']; ?></td>
                <td><?php echo $homework['evaluation_date']; ?></td>
                <td><?php echo $homework['evaluated_by']; ?></td>
                <td>
                <?php //echo $homework['sem_homwork_id']; ?>                    
                <?php //echo $homework['eval_id']; ?> 
                <button type="button"
                class="btn btn-sm btn-primary editLeaveBtn"
                data-id="<?php echo $homework['sem_homwork_id']; ?>"
                data-evaluateid="<?php echo $homework['eval_id']; ?>">
                <i class="fa fa-pencil"></i>
                </button>
                </td>                
                </tr>
                <?php } ?>            
                  
                </tbody>
                <tfoot>
                <tr>
                <th><i class="bi bi-calendar3 me-2"></i>Program</th>
                <th><i class="bi bi-clock me-2"></i>Batch</th>
                <th><i class="bi bi-clock-history me-2"></i>Subject</th>
                <th><i class="bi bi-clock me-2"></i>Homework Date</th>
                <th><i class="bi bi-clock-history me-2"></i>Submission Date</th>
                <th><i class="bi bi-chat-left-text me-2"></i>Evaluation Date</th>
                <th><i class="bi bi-info-circle me-2"></i>Evaluated By</th>
                <th><i class="bi bi-gear me-2"></i>Action</th>            
                </tr>
                  </tfoot>
                </table>
              </div>

               <!-- <div class="modal fade" id="editEvalModal" tabindex="-1">
                        <div class="modal-dialog">
                        <form id="updateEvalForm" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5>Edit Homework Evaluation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                        <input type="hidden" name="eval_id" id="eval_id">                   

                        <label>Message</label>
                        <textarea name="stud_message" id="stud_message" rows="4" class="form-control"></textarea>  
                        <label>Attach Document</label>
                        <input type="file" name="stud_file" id="stud_file" class="form-control">
                        </div>                        

                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        </div>
                        </div>
                        </form>
                        </div>
                        </div> -->
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

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript">

$(document).on('click', '.editLeaveBtn', function () 
{
    let id         = $(this).data('id');
    let evalId     = $(this).data('evaluateid');   

    $.ajax({
        url: "<?= base_url('student_semester_info/homework/getEvaluationById') ?>",
        type: "POST",
        data: { id: id,evalId:evalId },
        dataType: "json",
        success: function (res) 
        {
            if (!res)
            {
            alert('No record found');
            return;
            }
            // $('#eval_id').val(res.id);
             $('#eval_id').val(evalId);
            $('#status').val(res.status);
            $('#stud_message').val(res.stud_message);
            $('#date').val(res.date);
            $('#editEvalModal').modal('show');
        }
    });
});



$('#updateEvalForm').on('submit', function(e) 
{
    e.preventDefault();
    let formData = new FormData(this);

    // Debug: log all keys and values
    for (let pair of formData.entries()) {
        console.log(pair[0] + ':', pair[1]);
    }

    $.ajax({
        url: "<?= base_url('student_semester_info/homework/updateEvaluation') ?>",
        type: "POST",
        data: formData,
        contentType: false,  // Important for file upload
        processData: false,  // Important for file upload
        dataType: "json",
        success: function(res) {
            console.log(res); // see the server response
            if (res.status) {
                alert('Updated successfully');
                $('#editEvalModal').modal('hide');
                // location.reload();
            } else {
                alert(res.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});


// $('#updateEvalForm').on('submit', function (e) 
// {   
//     e.preventDefault();   
    
//     console.log($(this).serialize());

//     $.ajax({
//         url: "<?= base_url('student_semester_info/homework/updateEvaluation') ?>",
//         type: "POST",
//         data: $(this).serialize(),
//         success: function () 
//         {
//             alert('Updated successfully');
//             location.reload();
//         }
//     });
// });



// $(document).on('submit', '#updateEvalForm', function(e)
//{
//     e.preventDefault();
//     let formData = new FormData(this);
//     alert(JSON.stringify(formData))

//     $.ajax({
//         url: "<?= base_url('student_semester_info/homework/updateEvaluation') ?>",
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         dataType: "json",
//         success: function(res) {
//             console.log(res);
//             if (res.status) {
//                 alert('Updated successfully');
//                 $('#editEvalModal').modal('hide');
//                 location.reload();
//             } else {
//                 alert(res.error);
//             }
//         }
//     });
// });

                </script>