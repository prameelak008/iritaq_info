            
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
            <label><?php echo  $this->lang->line('phase'); ?></label><small class="req"> *</small>
            <select  id="entrance_phase" name="entrance_phase" class="form-control select2"  >
            <option value"">Select Phase</option>
            <?php
            foreach($get_phase as $phase)
            {
            ?>
            <option value="<?php echo  $phase['entrance_examgroup_id']; ?>" <?php
            if (set_value('entrance_phase') == $phase['entrance_examgroup_id']) {
            echo "selected=selected";
            }
            ?>><?php echo $phase['entrance_examgroup_name']; ?></option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('entrance_phase'); ?></span>
            </div>
            </div>
            
                
            
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
            <span class="text-danger"><?php echo form_error('entrance_course'); ?></span>
            </div>
            </div>
            
            
         
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
            <select  id="session" name="session" class="form-control select2"  >
            <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
            <?php
            foreach($sessionlist as $sess)
            {
            ?>
            <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('session'); ?></span>
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
            <form  action="<?php echo site_url('entrance_allotment/examresult/publishexamresult') ?>" method="post" enctype= "multipart/form-data" > 
            <div class="row">
            
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            
            <input type="date" name="publishdate" class="form-control"/>
            <input type="time" name="publishtime" class="form-control"/>
            <input type="hidden" name="courseid" value="<?php echo $courseid; ?>"/>
            <input type="hidden" name="session_id" value="<?php echo $session_id; ?>"/>
            <input type="hidden" name="entrance_phase" value="<?php echo $entrance_phase; ?>"/>
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
            foreach($subjectlist as $sub)
            {
            ?>
            <th><?php  echo $sub['entrance_subtype_name']; ?></th>
            <?php
            }
            ?>
            <th >Max</th>
            <th >Min</th>
            <th>Total</th>
            <th>Percentage</th>
            <th>Grade</th>
            <th>Rank</th> 
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($get_publish as $pub)
            {
            $ftot[]= $pub['getmark'];    
            }
            
            $sl_no=1;
            $fgde="";
            $percentage="";
            foreach($get_publish as $publish)
            {
            ?>
            <tr>
            <td><?php  echo $sl_no; ?>
            <input type="hidden" name="regid[]" value="<?php echo $publish['admission_application_registerid'];  ?>"/>
            <input type="hidden" name="examsession[]" value="<?php echo $session_id;  ?>"/>
            </td>
            
            
            <td>
            <?php echo $publish['admission_application_no'];  ?>
            </td>
            
            <td>
            <?php echo $publish['admission_mobile'];  ?>
            </td>
            <td>
            <?php echo $publish['admission_name'];  ?>
            </td>
                
                
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
                if($exam['entranceexam_result_applicant']==$publish['admission_application_registerid']  && $exam['entranceexam_marks_subject_id']==$sub['entranceexam_subject_subid']  && $exam['entranceexam_marks_session_id']==$sub['entranceexam_subject_sessionid'])
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
                
             <td >
            <?php echo $publish['maxmark'];  ?>
            </td>
            
            <td >
            <?php echo $publish['minmark'];  ?>
            </td>    
                
            
            <td>
            <?php echo number_format($publish['getmark'],2);  ?>
            <input type="hidden" name="ranklist" class="ranklist" value="<?php echo number_format($publish['getmark'],2);  ?>"/>
            </td>
            
            <td>
            <?php
            $percentage=  $publish['getmark']/$publish['maxmark']*100; 
            $percent= number_format($percentage,2);
            echo $percent;
            ?>
            
            <input type="hidden" name="percentage[]" value="<?php echo $percent;  ?>"/>
            <input type="hidden" name="totalmarks[]" value="<?php echo $publish['getmark'];  ?>"/>
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
            
            <input type="hidden" name="fgrade[]" value="<?php echo $fgde;  ?>"/>
            </td>
            
        <td>
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
        if($publish['getmark']==$k)
        {
        ?>
        
        <span style="font-size:15px;"><b><?php   echo $y ;   ?></b></span>
        <input type="hidden" name="rank[]" value="<?php echo $y;  ?>"/>
        
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
            $sl_no++;
            
            
            } 
            
            ?>
            </tbody>
            </table>
            <input type="submit" name="submit" class="btn btn-success" value="SUBMIT"/>
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
            
            
            
            $(document).ready(function()
            {
            var arr = new Array();
            $('.rank').each(function(){
            arr.push($(this).text());
            });
            
            
            arr.sort();
            $.each(arr, function( index, value ) {
            $('.rank:contains(' + value + ')').find('span.innerrank').html(index+1);
            });
            })
            
            
            
            
            // $(document).ready(function () {
            // $.extend($.fn.dataTable.defaults, {
            // searching: true,
            // ordering: true,
            // paging: false,
            // retrieve: true,
            // destroy: true,
            // info: false
            // });
            // });
            
            
            
            
            
            
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