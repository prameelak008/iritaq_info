                <div class="content-wrapper" style="min-height: 946px;">
                <section class="content-header">
                <h1>
                <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-12">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('exam_result'); ?></h3>
                </div>
                <div class="box-body">
                
                
                <form role="form" action="<?php echo site_url('user/exam/examresult_print') ?>" method="post" class="row">
                <?php echo $this->customlib->getCSRF(); ?>
                
                
                <div class="col-sm-6 col-lg-4 col-md-4">
                <div class="form-group">
                <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
                <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
                
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                
                <?php
                foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
                ?>
                <option value="<?php echo $ex_group_value->id ?>" <?php
                if (set_value('exam_group_id') == $ex_group_value->id) {
                echo "selected=selected";
                }
                ?>><?php echo $ex_group_value->name; ?></option>
                <?php
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                </div>  
                </div>
                <div class="col-sm-6 col-lg-4 col-md-4">
                <div class="form-group">  
                <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
                <select  id="exam_id" name="exam_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                </div>  
                </div>
                
                
                <div class="col-sm-6 col-lg-4 col-md-4" style="visibility: hidden;" >
                <div class="form-group">  
                <label><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
                <select  id="session_id" name="session_id" class="form-control" >
                <option  value="<?php echo $students_listt['sesidd']; ?>"><?php echo $students_listt['sesname']; ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('session_id'); ?></span>
                </div>  
                </div>
                
                
                <div class="col-sm-6 col-lg-4 col-md-4" style="visibility: hidden;" >
                <div class="form-group">  
                <label><?php echo $this->lang->line('class'); ?><small class="req"> *</small></label>
                <select id="class_id" name="class_id" class="form-control" >
                <option value="<?php  echo $students_listt['classesidd'];?>"><?php  echo $students_listt['classesname'];?></option>
                </select>
                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                </div>  
                </div>
                
                
                <div class="col-sm-6 col-lg-4 col-md-4" style="visibility: hidden;" >
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?><small class="req"> *</small></label>
                <select  id="section_id1" name="section_id" class="form-control" >
                <option value="<?php echo $students_listt['sectionsidd']; ?>"><?php echo $students_listt['sectionsname']; ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                </div>   
                </div>
                
                
                
                <div class="col-sm-12">
                <div class="form-group">
                <button type="submit"  onclick="return checkvalue();" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                </div>
                </div>
                </form>
                </div>
                <?php
                if (isset($studentList))
                {
                ?>
                
                <form  action="<?php echo base_url('user/exam/printexamresult') ?>"  id="printMarksheet" name="printMarksheet" method="post">
                
                <input type="hidden" name="marksheet_template" value="1">
                
                <input type="hidden" name="marksheet_Newexamgroup" value="<?php   echo $Exam_group_list->name;   ?>">
                
                <input type="hidden" name="marksheet_Newexambatch" value="<?php   echo $Exam_group_list->exam;   ?>">
                
                <div class="box-body">
                <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
                <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
                <div class="tab-pane active table-responsive no-padding" id="tab_1">
                <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div> 
                
                <table width="100%"  style="text-align: left; font-size:15px; line-height: inherit;">
                
                <?php
                if (empty($studentList)) {
                ?>
                <?php
                } 
                else 
                {
                $count = 1;
                $sl    = 1;
                foreach ($studentList as $student_key => $student_value)
                {
                if($student_value->student_id==$student_session_id)
                {
                $result_status = 1;
                $no_subject_result = 0;
                $result_status_cmark = 1;
                $no_subject_result_cmark = 0;
                ?>
                
                <tr>
                <td class="text-center" style="visibility: hidden;" >
                <input type="checkbox" class="checkbox center-block" checked="checked"  name="exam_group_class_batch_exam_student_id[]" data-student_id="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>" value="<?php echo $student_value->exam_group_class_batch_exam_student_id; ?>">
                <br> 
                </td>
                </tr>
                
                
                  
                    <tr>
                    <?php
                    if(!empty($publish_status))
                    {
                    ?>
                    <td style="text-align:center; color:#4e168d; font-size:18px;"><?php echo "Exam Result Published"; ?></td>
                    <?php } else { ?>
                    <td style="text-align:center; color:#4e168d; font-size:18px;"> <span style="color:red;  ">Examination Results Not Declared  <i class="fa fa-times-circle"></i> </span></td>
                    
                    <?php }  ?>
                    </tr>
                    
                
                <tr>
                <td style="text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                </tr>
                
                
                <tr>
                <td style="text-align:center;">
                <?php   echo $Exam_group_list->name;   ?>
                </td>
                </tr>
                
                <tr>
                <td style="text-align:center;">
                <?php   echo $Exam_group_list->exam;   ?>
                </td>
                </tr>
                <tr>
                <td style="text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="text-align:center;">
                <?php echo $student_value->firstname.''. $student_value->middlename.''.$student_value->lastname ?></td>
                </tr>
                
                <tr>
                <td style="text-align:center;">
                <?php echo $student_value->admission_no; ?>
                </td>
                </tr>
                
                <tr>
                <td style="text-align:center;">
                <?php echo $student_value->class; ?>
                </td>
                </tr>
                
                <tr>
                <td style="text-align:center;">
                
                <?php echo $student_value->section; ?>
                </td>
                </tr>
                
                <tr>
                <td>
                &nbsp;&nbsp; &nbsp; &nbsp;  
                
                <input type="hidden" name="section_id" value="<?php  echo $section_id; ?>"/>
                </td>
                </tr> 
                
                <tr>
                <td style="text-align:center;">
                <?php
                
                if(!empty($publish_status))
                {
                if ($examwithheld == null)
                {
                ?>
                <button  class="btn btn-success btn-sm" type="submit" name="generate" title="generate multiple certificate"><?php echo $this->lang->line('generate'); ?></button>
                <?php
                }
                else
                {
                ?>
                <span style="color:red;  "><b>Your Result is Withheld  <i class="fa fa-exclamation-triangle"></i> </b></span>
                <br>
                <br>
                <span>Notice: Please contact the Examination Board office</span>
                <br>
                <br>
                <?php
                }
                }
                else
                {
                ?>
                <!--<span style="color:red;  "><b>Result not Published  <i class="fa fa-times-circle"></i> </b></span>-->
                <br>
                <br>
                <br>
                <br>
                <?php
                }
                
                ?>
                </td>
                </tr>
                
                <?php
                
                $sl++;  } } }
                ?>
                </table>
                </form>
                <?php } ?>
                </div>
                </div>
                </section>
                </div>
                
                
                <?php
                
                function getSubjectMarks($subject_results, $subject_id) 
                {
                if (!empty($subject_results)) {
                foreach ($subject_results as $subject_result_key => $subject_result_value) {
                if ($subject_id == $subject_result_value->subject_id) {
                return $subject_result_value;
                }
                }
                }
                return false;
                }
                
                function get_ExamGrade($exam_grades, $percentage) 
                {
                if (!empty($exam_grades)) {
                foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {
                
                if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->name;
                }
                }
                }
                return "-";
                }
                
                function findGradePoints($exam_grades, $percentage) {
                
                if (!empty($exam_grades)) {
                foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {
                
                if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->point;
                }
                }
                }
                return 0;
                }
                ?>
                
                <script type="text/javascript">
                var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
                var class_id = '<?php echo set_value('class_id') ?>';
                var section_id = '<?php echo set_value('section_id') ?>';
                var session_id = '<?php echo set_value('session_id') ?>';
                var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
                var exam_id = '<?php echo set_value('exam_id') ?>';
                getSectionByClass(class_id, section_id);
                getExamByExamgroup(exam_group_id, exam_id);
                
                $(document).on('change', '#exam_group_id', function (e)
                {
                $('#exam_id').html("");
                var exam_group_id = $(this).val();
                getExamByExamgroup(exam_group_id, 0);
                });
                $(document).on('change', '#class_id', function (e) {
                $('#section_id').html("");
                var class_id = $(this).val();
                getSectionByClass(class_id, 0);
                });
                
                function getSectionByClass(class_id, section_id)
                {
                if (class_id != "") {
                $('#section_id').html("");
                var base_url = '<?php echo base_url() ?>';
                //var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                
                $.ajax({
                type: "GET",
                url: base_url + "user/user/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                $('#section_id').addClass('dropdownloading');
                },
                success: function (data) {
                $.each(data, function (i, obj)
                {
                var sel = "";
                if (section_id == obj.section_id) {
                sel = "selected";
                }
                div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
                },
                complete: function () {
                $('#section_id').removeClass('dropdownloading');
                }
                });
                }
                } 
                
                
                function getExamByExamgroup(exam_group_id, exam_id) 
                {
                if (exam_group_id != "")
                {
                $('#exam_id').html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                
                $.ajax({
                type: "POST",
                url: base_url + "user/user/getExamByExamGroup_publish_result",
                data: {'exam_group_id': exam_group_id},
                dataType: "json",
                beforeSend: function () {
                $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) {
                $.each(data, function (i, obj)
                {
                var sel = "";
                if (exam_id == obj.id) {
                sel = "selected";
                }
                div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
                });
                $('#exam_id').append(div_data);
                },
                complete: function () {
                $('#exam_id').removeClass('dropdownloading');
                }
                });
                }
                }
                
                /*
                $(document).on('submit', 'form#printMarksheet', function (e)
                {
                e.preventDefault();
                var form = $(this);
                var subsubmit_button = $(this).find(':submit');
                var formdata = form.serializeArray();
                
                var list_selected =  $('form#printMarksheet input[name="exam_group_class_batch_exam_student_id[]"]:checked').length;
                if(list_selected > 0)
                {
                $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: formdata, // serializes the form's elements.
                dataType: "JSON", // serializes the form's elements.
                beforeSend: function () {
                subsubmit_button.button('loading');
                },
                success: function (response)
                {
                Popup(response.page);
                },
                error: function (xhr) { // if error occured
                
                alert("Error occured.please try again");
                subsubmit_button.button('reset');
                },
                complete: function () {
                subsubmit_button.button('reset');
                }
                });
                }
                else
                {
                confirm("<?php echo $this->lang->line('please_select_student'); ?>");
                }
                });
                
                $(document).on('click', '#select_all', function () {
                $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
                });
                
                var base_url = '<?php echo base_url() ?>';
                
                
                function Popup(data)
                { 
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html>');
                frameDoc.document.write('<head>');
                frameDoc.document.write('<title></title>');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
                frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
                frameDoc.document.write('</head>');
                frameDoc.document.write('<body>');
                frameDoc.document.write(data);
                frameDoc.document.write('</body>');
                frameDoc.document.write('</html>');
                frameDoc.document.close();
                setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
                }, 500);
                return true;
                }
                
                */
                
                
                
            $(document).on('submit', 'form#printMarksheet', function (e) {
            e.preventDefault();
            var form = $(this);
            var submitButton = form.find(':submit');
            var formData     = form.serializeArray();
            var selectedCount = $('form#printMarksheet input[name="exam_group_class_batch_exam_student_id[]"]:checked').length;
            if (selectedCount > 0) {
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function () {
                        submitButton.button('loading');
                    },
                    success: function (response) 
                    {
                    Popup(response.page);
                    },
                    error: function (xhr) {
                        alert("Error occurred. Please try again.");
                        submitButton.button('reset');
                    },
                    complete: function () {
                        submitButton.button('reset');
                    }
                });
            } else {
                alert("Please select a student.");
            }
            });




            $(document).on('click', '#select_all', function ()
            {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
            });
            
            var baseUrl = '<?php echo base_url() ?>';
            function Popup(data) {
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html>');
            printWindow.document.write('<head>');
            printWindow.document.write('<title>Exam Result</title>');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/bootstrap/css/bootstrap.min.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/dist/css/font-awesome.min.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/dist/css/ionicons.min.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/dist/css/AdminLTE.min.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/dist/css/skins/_all-skins.min.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/plugins/iCheck/flat/blue.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/plugins/morris/morris.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/plugins/datepicker/datepicker3.css">');
            printWindow.document.write('<link rel="stylesheet" href="' + baseUrl + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
            printWindow.document.write('</head>');
            printWindow.document.write('<body>');
            printWindow.document.write(data);
            printWindow.document.write('</body>');
            printWindow.document.write('</html>');
            printWindow.document.close();
            printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            // printWindow.close();
            };
            return true;
            }
            

            </script>