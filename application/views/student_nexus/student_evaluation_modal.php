
                <style>
                .summary-box {
                background: #f4f4f4;
                padding: 15px;
                border-radius: 6px;
                min-height: 400px; /* same as student table */
                }

                /* Summary styles */
                .summary-title {
                font-weight: 600;
                margin-bottom: 12px;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
                }

                .summary-item {
                display: flex;
                align-items: center;
                font-size: 14px;
                margin-bottom: 8px;
                }

                .summary-item i {
                font-size: 16px;
                margin-right: 8px;
                color: #555;
                }

                .summary-desc p {
                font-size: 14px;
                margin-top: 5px;
                }

                .student-table-wrapper {
                min-height: 400px; /* Set the min-height as needed */
                overflow-y: auto;  /* Add scroll if content exceeds */
                margin-bottom: 15px;
               
                }

                .student_content
                {
                     background-color:#f4f4f4;
                }
                </style>

                <div class="row">

                <!-- LEFT COLUMN : STUDENT TABLE -->
                <div class="col-md-7 ">
                <form name="frm" method="POST" action="<?php echo site_url('student_nexus/homework/add_evaluation'); ?>">


                <div class="student-table-wrapper ">              
                <table class="table table-bordered ">
                <thead>
                <tr>
                <th><input type="checkbox" id="select_all"></th>
                <th>#</th>
                <th>Student Name</th>
                <th>Roll No</th>
                </tr>
                </thead>
                <tbody>                

                <?php $sl = 1; 
                foreach ($students as $stud) 
                {
                ?>
                <tr>
                <td>

                <input type="checkbox" 
                class="student_checkbox"
                name="student_ids[]"
                value="<?= $stud['id']; ?>" 
                <?= in_array($stud['id'], $evaluated_student_ids) ? 'checked' : ''; ?>>
                </td>


                <td><?= $sl++; ?></td>
                <td><?= $stud['firstname']; ?></td>
                <td><?= $stud['roll_no']; ?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>

                

                <!-- EVALUATION DATE UPDATE -->

                <div class="form-group">
                <label for="evaluation_date"><b>Evaluation Date:</b></label>
                <input type="date" 
                id="evaluation_date" 
                name="evaluation_date" 
                class="form-control" 
                value="<?= !empty($get_homework_details['evaluation_date']) ? date('Y-m-d', strtotime($get_homework_details['evaluation_date'])) : ''; ?>">


                <input type="hidden" name="homework_id" id="homework_id" value="<?php echo $get_homework_details['sem_homework_id']; ?>"/>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Update Evaluation Date</button>
                </form>
                </div>

                <!-- RIGHT COLUMN : SUMMARY -->
                <div class="col-md-5">
                <div class="summary-box">
                <h4 class="summary-title">Summary</h4>

                <div class="summary-item">
                <i class="bi bi-calendar-event"></i>
                <span><b>Homework Date:</b> <?= $get_homework_details['homework_date']; ?></span>
                </div>

                <div class="summary-item">
                <i class="bi bi-upload"></i>
                <span><b>Submission Date:</b> <?= $get_homework_details['submit_date']; ?></span>
                </div>

                <div class="summary-item">
                <i class="bi bi-check-circle"></i>
                <span><b>Evaluation Date:</b> <?= $get_homework_details['evaluation_date']; ?></span>
                </div>

                <div class="summary-item">
                <i class="bi bi-person"></i>
                <span><b>Created By:</b> <?= $get_homework_details['created_by_name']; ?></span>
                </div>

                <div class="summary-item">
                <i class="bi bi-person-check"></i>
                <span><b>Evaluated By:</b> <?= $get_homework_details['evaluated_by_name']; ?></span>
                </div>

                <div class="summary-item">
                <i class="bi bi-book"></i>
                <span><b>Subject Group:</b> <?= $get_homework_details['groupname']; ?></span>
                </div>

                <div class="summary-item">
                <i class="bi bi-journal-text"></i>
                <span><b>Subject:</b> <?= $get_homework_details['subjectname']; ?></span>
                </div>

                <div class="summary-desc">
                <b>Description:</b>
                <p><?= $get_homework_details['description']; ?></p>
                </div>
                
                </div>
                </div>
                </div>

                <script>
                $('#select_all').on('change', function ()
                {
                $('.student_checkbox').prop('checked', this.checked);
                });
                </script>