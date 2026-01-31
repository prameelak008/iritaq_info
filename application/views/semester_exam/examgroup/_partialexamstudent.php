
                <form method="post" action="<?php echo site_url('semester_exam/Examgroup/entrystudents') ?>" id="allot_exam_student1">
                <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                <input type="hidden" name="sem_group_id" value="<?php echo $sem_group_id; ?>">     


                <?php

                if (isset($studentlist) && !empty($studentlist)) {
                ?>
                <div class="row">

                <div class="col-md-12">       

                <div class="table-responsive ptt10">

                <table class="table table-striped">
                <tbody>

                <tr>
                <th width="60"><label class="checkbox-inline bolds">
                <input type="checkbox" class="select_all"/> <?php echo $this->lang->line('all'); ?></label></th>        
                <th><?php echo $this->lang->line('admission_no'); ?></th>
                <th><?php echo $this->lang->line('student_name'); ?></th>
                <th><?php echo $this->lang->line('father_name'); ?></th>
                </tr>

                <?php
                if (empty($studentlist)) {
                ?>
                <tr>
                <td colspan="7" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                </tr>
                <?php
                } else {
                $counter = 1;    




                foreach ($studentlist as $student)
                { 
                $stud_id = $student['stud_student_id'];
                $checked = !empty($student['sem_checked']) ? 'checked' : '';               
                ?>
                <tr>
                <td>        
                <input type="hidden" name="all_students[]" value="<?php echo $student['stud_student_id']; ?>">
                <!-- <input type="hidden" name="student_<?php echo $student['student_session_id']; ?>" value="<?php echo $student['id']; ?>"> -->
                <!-- <input class="checkbox" type="checkbox" name="student_id[]"  value="<?php echo $student['stud_student_id']; ?>"    /> -->


                <input type="hidden" name="all_students[]" value="<?php echo $stud_id; ?>">
                <input type="checkbox" name="student_id[]" value="<?php echo $stud_id; ?>" <?php echo $checked; ?> />
                </td>

                <td><?php echo $student['admission_no']; ?></td>        
                <td><?php echo $student['firstname'] .''.$student['middlename'].''.$student['lastname']; ?></td>        
                <td><?php echo $student['father_name']; ?></td>        
                </tr>
                <?php
                }
                }
                ?>
                </tbody></table>        
                </div>

                <?php if ($this->rbac->hasPrivilege('exam_assign_view_student', 'can_edit')) { ?>
                <button type="submit" class="btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('save'); ?>
                </button>
                <?php } ?>
                </div>
                </div>
                <?php
                } else {
                ?>        
                <div class="alert alert-danger "><?php echo $this->lang->line('no_record_found'); ?></div>
                <?php
                }
                ?>
                </form>

                


                <script>
                $('#allot_exam_student').on('submit', function(e){

                e.preventDefault(); // This would stop the form from submitting
                });
                </script>



