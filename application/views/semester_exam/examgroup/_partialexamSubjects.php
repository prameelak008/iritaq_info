<<<<<<< HEAD
           
          <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Moment -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<!-- Bootstrap 3 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Bootstrap Datetimepicker (jQuery 3 compatible) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">



           
            <div class="row pb10">
=======
           <div class="row pb10">
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

            <div class="col-lg-2 col-md-3 col-sm-12">   
            <p class="examinfo"><span><?php echo $this->lang->line('exam'); ?></span><?php echo $examgroupDetail->exam; ?></p>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">   
            <p class="examinfo"><span><?php echo $this->lang->line('exam')." ".$this->lang->line('group');?></span><?php echo $examgroupDetail->exam_group_name; ?></p>
            </div> 

            <form  action="<?php echo site_url('admin/exam_schedule/exportformat') ?>" method="post" >
            <input type="hidden" name="exam_id" id="exam_id"  value="<?php echo $exam_id; ?>" class="from-control"/>
            <input type="hidden" name="exam_group_name" value="<?php echo $examgroupDetail->exam_group_name; ?>" class="form-control"/>
            <button  type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-download"></i> <?php echo $this->lang->line('dl_sample_import'); ?></button>
            </form>

            <!--
            <form  action="<?php echo site_url('admin/exam_schedule/importformat') ?>" method="post" >
            <button  type="submit" class="btn btn-primary btn-sm  pull-right"><i class="fa fa-download"></i> <?php echo $this->lang->line('import'); ?></button>
            </form>
            -->


            <form class="row g-3" action="<?php echo site_url('admin/exam_schedule/importformat') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label for="exampleInputFile"><?php echo $this->lang->line('select_csv_file'); ?></label><small class="req"> *</small>
            <div>
            <input type="hidden" name="exam_id" id="exam_id"  value="<?php echo $exam_id; ?>" class="from-control"/>
            <input class="filestyle form-control"  type='file' name='file' id="file" size='20' style="opacity:1 !important; outline:none!important;" />
            <span class="text-danger"><?php echo form_error('file'); ?></span></div>
            </div>

<<<<<<< HEAD
=======


>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            <div class="col-auto">
            <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
            </div>
            </form>


<<<<<<< HEAD

=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            </div>    
            <div class="divider2"></div>
            <div class="row">
            <div class="col-md-12 pt5">
            <button type="button" name="add" class="btn btn-primary btn-sm add pull-right" autocomplete="off"><span class="fa fa-plus"></span> <?php echo $this->lang->line('add')." ".$this->lang->line('exam')." ".$this->lang->line('subject');?></button>
            </div>
            </div>

<<<<<<< HEAD
            

            <form action="<?php echo site_url('semester_exam/examgroup/addexamsubject') ?>" method="POST" class="ssaddSubject ptt10 autoscroll">
            <input type="text" name="exam_group_class_batch_exam_id" value="<?php echo $exam_id; ?>">
=======


            

            <form action="<?php echo site_url('semester_exam/examgroup/addexamsubject') ?>" method="POST" class="ssaddSubject ptt10 autoscroll">
            <input type="hidden" name="exam_group_class_batch_exam_id" value="<?php echo $exam_id; ?>">
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            <div class="">
            <table class="table table-bordered" id="item_table">
            <thead>
            <tr>
            <th class=""><?php echo $this->lang->line('subject'); ?></th>
            <th class=""><?php echo $this->lang->line('date'); ?></th>
            <th class=""><?php echo $this->lang->line('time');?></th>
            <th class=""><?php echo $this->lang->line('duration'); ?> -- <?php echo $this->lang->line('durationtimeformat'); ?></th>
            <th class=""><?php echo $this->lang->line('credit')." ".$this->lang->line('hours') ?></th>
            <th class=""><?php echo $this->lang->line('room')." ".$this->lang->line('no')?></th>
            <th class="tddm150"><?php echo $this->lang->line('marks')." (".$this->lang->line('max').".)";?></th>
            <th class="tddm150"><?php echo $this->lang->line('marks')." (".$this->lang->line('min').".)";?></th>
            <th class="tddm150"><?php echo $this->lang->line('cmarks')." (".$this->lang->line('max').".)";?></th>
            <th class="tddm150"><?php echo $this->lang->line('cmarks')." (".$this->lang->line('min').".)";?></th>
            <?php
            if ($examgroupDetail->exam_group_type == "coll_grade_system") {
            ?>
            <th class="text-center"><?php echo $this->lang->line('action'); ?></th>
            <?php
            }
            ?>
<<<<<<< HEAD
            </tr>
            </thead>


=======

            </tr>
            </thead>
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            <?php         

            if (!empty($exam_subjects)) 
            {
            $count = 1;
            foreach ($exam_subjects as $exam_subject_key => $exam_subject_value) {
            ?>
            <tr>
            <td width="160">
            <select class="form-control item_unit tddm200" name="subject_<?php echo $count; ?>">
            <option value=""><?php echo $this->lang->line('select')?></option>

            <?php
            if (!empty($batch_subjects)) {
            foreach ($batch_subjects as $subject_key => $subject_value) 
            {
            ?>
            <option value="<?php echo $subject_value['id'] ?>" <?php echo set_select('subject_' . $count, $subject_value['id'], ($exam_subject_value->subject_id == $subject_value['id']) ? true : false); ?>>
            <?php 
            $sub_code=($subject_value['code'] != "") ? " (".$subject_value['code'].")":"";
            echo $subject_value['name'].$sub_code; ?>
<<<<<<< HEAD
            </option>
=======

            </option>

>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            <?php
            }
            }
            ?>
            </select>
            </td>
            <td>

            <div class="input-group datepicker_init">
            <input class="form-control tddm200" name="date_from_<?php echo $count; ?>" type="text" value="<?php echo $this->customlib->dateformat($exam_subject_value->date_from); ?>">
            <span class="input-group-addon" id="basic-addon2">
            <i class="fa fa-calendar">
            </i>
            </span>
            </input>
            </div>
            </td>
            <td >
            <div class="input-group datepicker_init_time">
            <input type="text" name="time_from<?php echo $count; ?>" class="form-control tddm200" value="<?php echo $exam_subject_value->time_from; ?>">
            <span class="input-group-addon" id="basic-addon2">
            <i class="fa fa-calendar"></i>
            </span>
            </div>
            </td>

            <td>
            <div class="input-group datepicker_init_time">
            <input type="text" name="duration<?php echo $count; ?>" class="form-control duration tddm200" value="<?php echo $exam_subject_value->duration; ?>" autocomplete="off">
            <span class="input-group-addon" id="basic-addon2">
            <i class="fa fa-calendar"></i>
            </span>
            </div>
            </td>
<<<<<<< HEAD


=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            <td>
            <input class="form-control credit_hours tddm150" name="credit_hours_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->credit_hours; ?>"/>
            </td>
            <td>
            <input class="form-control room_no" name="room_no_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->room_no ?>"/>
            </td>
            <td>
            <input class="form-control marksssss" step="any" name="max_marks_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->max_marks; ?>"/>
            </td>

            <td>
            <input name="rows[]" type="hidden" value="<?php echo $count; ?>">
            <input name="prev_row[<?php echo $count; ?>]" type="hidden" value="<?php echo $exam_subject_value->id; ?>">
            <input class="form-control marksssss" step="any"  name="min_marks_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->min_marks; ?>"/>
            </td>
            <td>
            <input class="form-control marksssss" step="any"  name="max_cmarks_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->max_cmarks; ?>"/>
            </td>
            <td>


            <input class="form-control marksssss" step="any"  name="min_cmarks_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->min_cmarks; ?>"/>

            </td>

            <td class="text-center" style="vertical-align: middle; cursor: pointer;">
            <span class="text text-danger remove fa fa-times"></span>
            </td>


            </tr>

            <?php
            $count++;
            }
            }
            ?>
            </table>
            </div>  
            <div class="modal-footer"> 
            <div class="row"> 
            <?php 
            if($this->rbac->hasPrivilege('exam_subject','can_edit')){
            ?>
            <button type="submit" class="btn btn-primary pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save')?></button>
            <?php
            }
            ?>
<<<<<<< HEAD
=======

>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            </div>  
            </div>
            </form>


            <script type="text/javascript">
            $(document).ready(function () {
            //change selectboxes to selectize mode to be searchable
            $("select").select2();
            });
            </script>
<<<<<<< HEAD

       
=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
