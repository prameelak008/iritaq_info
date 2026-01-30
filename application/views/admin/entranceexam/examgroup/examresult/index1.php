                
                <style >
                
                .text-left
                {
                text-align: left !important;
                }
                </style>
                
                
                <div class="content-wrapper" style="min-height: 946px;">
                <section class="content-header">
                <h1>
                <i class="fa fa-map-o"></i> <?php echo $this->lang->line('Enter '); ?> <small><?php echo $this->lang->line('marks') ; ?></small>  
                </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-12">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i><?php echo $this->lang->line('Enter '); ?> <small><?php echo $this->lang->line('marks') ; ?></h3>
                </div>
                <div class="box-body">
                    
                    
                
                <form role="form" action="<?php echo site_url('entrance_allotment/examresult') ?>" method="post" >
                <?php echo $this->customlib->getCSRF(); ?>
                
                <div class="row">
                
                <div class="col-sm-6 col-lg-3 col-md-3 col20">
                <div class="form-group">
                <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                
                
                
                <select  id="entrance_course" name="entrance_course" class="form-control select2"  >
                <!--<option value="<?php if(!empty($subject_marks)) { echo  $subject_marks['entranceexam_course_id'];} else { echo ""; } ?>"><?php if(!empty($subject_marks)) { echo $subject_marks['entranceexam_course_name']; } else { echo $this->lang->line('select'); } ?></option>-->
                <?php
                foreach($course as $cou)
                {
                ?>
                
               <option value="<?php echo  $cou['entranceexam_course_id']; ?>" <?php
                if (set_value('entrance_course') == $cou['entranceexam_course_id']) {
                echo "selected=selected";
                }
                ?>><?php echo $cou['entranceexam_course_name']; ?></option>
                
                
                
                <?php
                }
                ?>
                </select>
                
                
                <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                </div>
                </div>
                
                
                
                <div class="col-sm-6 col-lg-3 col-md-3 col20">
                <div class="form-group">
                <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                <select  id="session" name="session" class="form-control select2"  >
                <!--<option value="<?php if(!empty($subject_marks)) { echo  $subject_marks['id'];} else { echo ""; } ?>"><?php if(!empty($subject_marks)) { echo $subject_marks['session']; } else { echo $this->lang->line('select'); } ?></option>-->
                <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
                
                <?php
                
                
                foreach($sessionlist as $sess)
                {
                ?>
                
                <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
                
                <?php } ?>
                </select>
                
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                </div>
                </div>
                
                
                <div class="col-sm-12">
                <div class="form-group">
                <button type="submit"  name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                </div>
                </div>
                
                
                </div>
                </form>
                </div>
                <div>
                <?php
                
                
                
                
                if (isset($studentList)) 
                { 
               // $ftot=array();
                ?>
                <div class="" >
                <div class="box-header ptbnull"></div>
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo  $this->lang->line('publish'); ?></h3>
                </div>
                <div class="box-body">
                
                <div class="tab-pane active table-responsive no-padding" id="tab_1">
                <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                <div class="box-body">
                
                <div class="table-responsive mailbox-messages">
                <table  border="2" hidden cellspacing="0" width="100%">
                
                <thead>
                <tr>
                <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('admission_no'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('mobile_no'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('student_name'); ?></th>
                <?php 
                
                foreach($subjectlist as $sub)
                {
                ?>
                <th><?php  echo $sub['entrance_subtype_name']; ?></th>
                <?php
                }
                
                ?>
                <th>Total</th>
                <th>Percentage</th>
                <th>Rank</th>
                </tr>
                </thead>
                
                
                <tbody>
                <tr>
                <th class="text-left"></th>
                <th class="text-left"></th>
                <th class="text-left"></th>
                <th class="text-left"></th>
                
                <?php
                $maxmarks=0;
                $percentage=0;
                $fgde="";
                foreach($subjectlist as $sub)
                {
                ?>
                <th>   
                <?php
                foreach($subjectmarks as $submark)
                {
                if($sub['entranceexam_subject_subid']==$submark['entranceexam_marks_subject_id'] && $sub['entranceexam_subject_sessionid']==$submark['entranceexam_marks_session_id'] && $sub['entranceexam_subject_course_id']==$submark['entranceexam_marks_course_id'] )
                {
                echo Max.'-'.$submark['entranceexam_marks_maximum_marks']; 
                echo Min.'-'.$submark['entranceexam_marks_minimum_marks']; 
                $maxmarks+=$submark['entranceexam_marks_maximum_marks'];
                }
                }
                ?>
                </th>
                <?php
                }
                
                ?>
                <th><?php echo $maxmarks;  ?></th>
                <th>%</th>
                <th></th>
                </tr>
                
                
                <?php
                $sl=1;
                foreach($studentList as $stud)
                {
                ?> 
                <tr>
                <td><?php  echo $sl; ?></td>
                <td><?php  echo $stud['admission_application_no']; ?></td>
                <td><?php  echo $stud['admission_mobile']; ?></td>
                <td><?php  echo $stud['admission_name']; ?></td>
                <?php
                $mark=0;
                $total_markst=0; 
                foreach($subjectlist as $sub)
                {
                ?>
                <td>
                <?php   
                foreach($examresult as $exam) 
                {
                if($exam['entranceexam_result_applicant']==$stud['admission_application_registerid']  && $exam['entranceexam_marks_subject_id']==$sub['entranceexam_subject_subid']  && $exam['entranceexam_marks_session_id']==$sub['entranceexam_subject_sessionid'])
                {
                ?>
                <?php
                $mark= $exam['entranceexam_result_getmarks'];
                echo $mark;
                $total_markst+=$exam['entranceexam_result_getmarks'];
                
                ?>
                <?php
                }
                }
                ?>
                </td>
                <?php
                }
                ?>
                <td><?php echo $total_markst; 
                $ftot[]= number_format((float)$total_markst, 2, '.', ''); ?></td>
                <td><?php echo  $total_markst*$maxmarks/100;  ?></td>
                <td style="text-align:center;"></td>
                </tr>
                <?php 
                $sl++; 
                }  
                
                ?>
                </tbody>
                </table>
                
                
             
                
                
                
                <form  action="<?php echo site_url('entrance_allotment/examresult/publishexamresult') ?>" method="post" enctype= "multipart/form-data" >   
                <div class="row">
                <div class="col-sm-6 col-lg-6 col-md-6 col20">
                <div class="form-group">    
                
                <input type="hidden" name="cou" value="<?php  echo $courseid; ?>" />
                <input type="hidden" name="sess" value="<?php  echo $session_id; ?>" />
                
                <input type="date"  class="form-control" name="publishdate" value="Publish Date"   />
                <input type="time"  class="form-control" name="publishtime" value="Publish Time"  />
               
                
               
                </div>
                </div>
                </div>
                
                
                
                <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                
                <thead>
                <tr>
                <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('admission_no'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('mobile_no'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('student_name'); ?></th>
                <?php 
                $maxmarks=0;
                $mark=0;
                
                foreach($subjectlist as $sub)
                {
                ?>
                <th><?php  echo $sub['entrance_subtype_name']; ?></th>
                <?php
                }
                
                ?>
                <th>Total</th>
                <th>Percentage</th>
                <th>Grade</th>
                <th>Rank</th>
                </tr>
                </thead>
                
                
                <tbody>
                <tr>
                <th class="text-left"></th>
                <th class="text-left"></th>
                <th class="text-left"></th>
                <th class="text-left"></th>
                
                <?php
                
                foreach($subjectlist as $sub)
                {
                ?>
                <th>
                <?php
                
                
                
                
                
                /*
                foreach($subjectmarks as $submark)
                {
                if($sub['entranceexam_subject_subid']==$submark['entranceexam_marks_subject_id'] && $sub['entranceexam_subject_sessionid']==$submark['entranceexam_marks_session_id'] && $sub['entranceexam_subject_course_id']==$submark['entranceexam_marks_course_id'] )
                {
                //echo Max.'-'.$submark['entranceexam_marks_maximum_marks']; 
                //echo Min.'-'.$submark['entranceexam_marks_minimum_marks']; 
                //$maxmarks+=$submark['entranceexam_marks_maximum_marks'];
                
                
                
                }
                }
                
                */
                
                
                
                ?>
                </th>
                <?php
                }
                
                ?>
                <th><?php echo $maxmarks;  ?></th>
                <th>%</th>
                <th></th>
                <th></th>
                </tr>
                
                <?php
                $sl=1;
                foreach($studentList as $stud)
                {
                ?> 
                <tr>
                <td><?php  echo $sl; ?></td>
                <td><?php  echo $stud['admission_application_no'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.  $stud['admission_application_registerid']; ?></td>
                <input type="text" name="regid[]" value="<?php  echo $stud['admission_application_registerid']; ?>">
                <input type="text" name="examsession[]" value="<?php  echo $stud['admission_sessionid']; ?>">
                <td><?php  echo $stud['admission_mobile']; ?></td>
                <td><?php  echo $stud['admission_name']; ?>
                </td>
                <?php
                $total_marks=0; 
                foreach($subjectlist as $sub)
                {
                ?>
                <td>
                <?php   
                foreach($examresult as $exam) 
                {
                if($exam['entranceexam_result_applicant']==$stud['admission_application_registerid']  && $exam['entranceexam_marks_subject_id']==$sub['entranceexam_subject_subid']  && $exam['entranceexam_marks_session_id']==$sub['entranceexam_subject_sessionid'])
                {
                ?>
                <?php
                $mark= $exam['entranceexam_result_getmarks'];
                echo $mark;
                $total_marks+=$exam['entranceexam_result_getmarks'];
                ?>
                 
                <?php
                }
                }
                ?>
                </td>
                
                
                <?php
                }
                ?>
                
                
                
                <?php
                $total_marks=0; 
                foreach($subjectlist as $sub)
                {
                ?>
                <td>
                <?php   
                foreach($examresult as $exam) 
                {
                if($exam['entranceexam_result_applicant']==$stud['admission_application_registerid']  && $exam['entranceexam_marks_subject_id']==$sub['entranceexam_subject_subid']  && $exam['entranceexam_marks_session_id']==$sub['entranceexam_subject_sessionid'])
                {
                ?>
                <?php
                $mark= $exam['entranceexam_result_getmarks'];
                echo $mark;
                $total_marks+=$exam['entranceexam_result_getmarks'];
                
                ?>
                 
                <?php
                }
                }
                ?>
                </td>
                
                
                
                
                <td>
                <?php echo number_format($total_marks,2);   
                ?>
                
                
                
                </td>
                <td><?php $percentage=  $total_marks/$maxmarks*100; 
                echo number_format($percentage,2);
                ?>
                </td>
                
                
                
                <td>
                <?php    
                
                if($percentage<=100 && $percentage>=90)
                {
                
                $fgde="A+" ;
                }
                
                elseif($percentage<=89 && $percentage>=80)
                {
                $fgde="A";
                }
                
                
                
                elseif($percentage<=79 && $percentage>=70)
                {
                $fgde="B+";
                }
                
                elseif($percentage<=69 && $percentage>=60)
                {
                $fgde="B";
                }
                
                
                elseif($percentage<=59 && $percentage>=50)
                {
                $fgde="C+";
                }
                
                elseif($percentage<=49 && $percentage>=40)
                {
                $fgde="C";
                }
                
                
                
                elseif($percentage<=39 && $percentage>=30)
                {
                $fgde="D+";
                }
                
                
                
                elseif($percentage<=29 && $percentage>=20)
                {
                $fgde="D";
                }
                
                
                elseif($percentage<=19 && $percentage>=10)
                {
                $fgde="E+";
                }
                
                
                elseif($percentage<=9 )
                {
                $fgde="E";
                }   
                echo   $fgde;                   
                ?>                      
                
                <input type="hidden" name="fgrade[]" value="<?php  echo $fgde; ?>">
                
                <input type="hidden" name="percentage[]" value="<?php  echo $percentage; ?>">
                <input type="hidden" name="totalmarksyy[]" value="<?php  echo $total_marks; ?>">
               
                
                </td>
                <td style="text-align:center;">
                <?php 
                
                
                $marks=$ftot;
                rsort($marks);
                $narr = array_count_values($marks);
                $y=1;
                foreach($narr as $k=>$v)
                {
                $i=1;
                while($i<=$v)
                {
                    
                    
                
                if($total_marks==$k)
                {
                    
                    
                ?>
                <span style="font-size:15px;"><b><?php   echo $y ;   ?></b></span>
                
                <input type="hidden" name="rank[]" value="<?php  echo $y; ?>" />
                <?php 
                break;
                }
                $i++;
                }
                $y++;
                }
                
              
              



?>
                
                
                
                
                
                
                </td>
                </tr>
                <?php 
                $sl++; 
                }  
                
                ?> 
                </tbody>
                </table>
                <input type="submit" class="btn btn-success"  name="publish" value="Publish"/>
                </form>
                
                </div>
                </div>
                </div>
                </div>
                </div>
                <?php  } ?>
                </section>
                </div>
                
                
                
                
                <script type="text/javascript">
                
                $(document).ready(function () 
                {
                $('.select2').select2();
                
                });
                $(document).ready(function () {
                $.extend($.fn.dataTable.defaults, {
                searching: true,
                ordering: true,
                paging: false,
                retrieve: true,
                destroy: true,
                info: false
                });
                });
                
                
                
                
                
                
                $(document).on('change', '#entrance_course', function (e) 
                {
                //$('#entrance_course').html("");
                var entrance_course = $(this).val();
                getsubjectbycourse(entrance_course, 0);
                });
                
                
                
                function getsubjectbycourse(entrance_course, entrance_subject) 
                { 
                
                var entrance_course = $('#entrance_course').val();
                var session = $('#session').val();
                var entrance_subject = $('#entrance_subject').val();
                
                if (entrance_course !== "") 
                {
                $('#entrance_subject').html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                
                $.ajax({
                type: "POST",
                url: base_url + "entrance_allotment/examresult/getentranceSubject",
                data: {'entrance_course': entrance_course},
                dataType: "json",
                // beforeSend: function () {
                //     $('#exam_id').addClass('dropdownloading');
                // },
                success: function (data) 
                {
                
                $.each(data, function (i, obj)
                {
                var sel = "";
                if (entrance_subject === obj.entrance_subtype_id) {
                sel = "selected";
                }
                div_data += "<option value=" + obj.entrance_subtype_id + " " + sel + ">" + obj.entrance_subtype_name + "</option>";
                });
                
                $('#entrance_subject').append(div_data);
                $('#entrance_subject').trigger('change');
                },
                complete: function () {
                $('#entrance_subject').removeClass('dropdownloading');
                }
                });
                }
                }
                
                
                </script>