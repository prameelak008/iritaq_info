           
                     <style type="text/css">
                    .tableone td{border:1px solid #000; padding:3px 0}
                    .denifittable th{}
                    .denifittable th,
                    .denifittable td {border: 1px solid #000;
                    border-collapse: collapse;border-left: 1px solid #999;}
                    
                   
                    
                    .denifittable tr th {padding: 8px 0px;  font-size: 12px}
                    
                    .denifittable tr td {padding: 8px 0px; font-weight: normal; font-size: 12px}
                    
                    
                    
                    .tcmybg {
                    background:top center;
                    background-size: 100% 100%;
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    z-index: 1;
                    width: 100%;height: 100%;
                    }
                    
                    .tablemain1
                    {
                    position: relative;
                    z-index: 1;
                    /*border:1px solid #000; */
                    padding: 3px;
                    min-height: 940px;
                    
                    }
                    
                    
                    .trstyle
                    {
                    height:3mm;
                    } 
                    
                    
                    
                    .tdstylelabel
                    {
                    width:45%;
                    padding-left: 12px;
                    font-size:14px;
                    
                    }
                    
                    
                    .tdstyledot
                    {
                    width:5%;
                    text-transform: uppercase;
                    }
                    
                    .tdstyle
                    {
                    width:50%; 
                    font-size:14px;
                    }
                    
                    
                    .headerclass
                    {
                    text-align: center;
                    font-weight:bold ;
                    }
                    
                    </style>
           
           
           
                    
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
                    <h6 class="box-title"><i class="fa fa-book"></i> Application For Revaluation</h6>
                    </div>
                    
                    
                    
                    
            <div class="box-body">
            <div style="width:100%">
            <span>
            <h5 style="text-align:center">REVALUATION PAYMENT </h5>
            </div>
                            
                            
           
            
            <form action="<?php echo site_url('user/revaluation/meTrnReq'); ?>"  method="POST" >
            
            
            <input type="hidden" id="examgroup" name="examgroup" value="<?php  echo $exam_group_exam_results_exam_idd;  ?>"  >
            
            <input type="hidden" id="examgroupbatch" name="examgroupbatch" value="<?php  echo $exam_group_exam_results_exam_groupidd;  ?>"> 
            
            <input type="hidden" id="session_id" name="session_id" value="<?php  echo $exam_session_id;  ?>"> 
            <input type="hidden" id="class_id" name="class_id" value="<?php  echo $exam_class_id;  ?>"> 
            <input type="hidden" id="section_id" name="section_id" value="<?php  echo $exam_section_id;  ?>">
            
            
            
            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
            <thead>                                         
            
            <tr>
            <th class="headerclass">No</th>
            <th  class="headerclass"><b>Description</b></th>
            <th class="headerclass"><b>Amount</b></th>
            </tr>
            </thead>
            
          
            
            
            
            <tr>
            <td>1</td>
            <td>Application Fees</td>
            <td>
                <!--20.00-->
                <?php echo $revaluation_feecharge['examfees_charge_processing_charge']; ?>
                </td>
            </tr>
            <?php
            
            $obtainedtotal=0;
            $maxtotal=0;
            $singlepercentage=0;
            
            $count=2;
            
            $feetotal=0;
            $feegrandtotal=0;
            
            // $totalfee="50";
             $totalfee= $revaluation_feecharge['examfees_charge_fees_charge'];
            $totalamt="0";
            
            foreach($revluation_marks as $reval)
            {
            
            ?>
            <tr>
            
            <td><?php echo $count; ?></td>
            <td><?php echo $reval['code'];  ?></td>
            
             <td><?php echo number_format($totalfee,2);  ?></td>
            </tr>
            
            <?php
             $count++;
             
             $totalamt+=   $totalfee; 
                
            } 
            
           // $gcount= $count-1;
            
            
            
            
            ?>
            
            
            <tr><td colspan="2" style="text-align:right;padding-right:20px"><b>Total Amount</b></td>
            
            <td colspan="2"><b><?php   $tot=$totalamt+20;  echo number_format($tot,2);?></b></td>
            </tr>
            
            
            
            
         
            
            </table>
            
            <br>
            
            
            
            
            <input type="hidden" name="totalamt" value="<?php  echo $tot ?>"/>
            
            <span ><input type="checkbox" name="paycheck" required="required"> By clicking  <b>Pay Now</b> </a> you are agreeing to the <a  style="display: inline-block;height: 18px;" target="_blank" href="https://iritaq.info/termsandcondition.html">Terms and Conditions.</a></span>
            <br>
            <table cellpadding="0" cellspacing="0" width="100%"  style="text-align: center;">
            <thead>                                         
            
            <tr>
            <td style="text-align:right;"> <input type="submit" name="paynow" value="PAY NOW" class="btn btn-success" ></td>
           
            </tr>
            
            </thead>
            </table>
            </form>
            </div>
                    
                    
                    
                  
                    
                    <?php
                    
                    function findGrade($exam_grades, $percentage) {
                    
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
                    
                    function examTotalResult($array) {
                    $return_array = array('max_marks' => 0, 'min_marks' => 0, 'credit_hours' => 0, 'get_marks' => 0, 'exam_result' => true);
                    if (!empty($array)) {
                    $max_marks = 0;
                    $min_marks = 0;
                    $credit_hours = 0;
                    $get_marks = 0;
                    $exam_result = true;
                    foreach ($array as $array_key => $array_value) {
                    if ($array_value->attendence == "absent") {
                    $exam_result = false;
                    }
                    $max_marks = $max_marks + $array_value->max_marks;
                    $min_marks = $min_marks + $array_value->min_marks;
                    $credit_hours = $credit_hours + $array_value->credit_hours;
                    $get_marks = $get_marks + $array_value->get_marks;
                    }
                    $return_array = array('max_marks' => $max_marks, 'min_marks' => $min_marks, 'credit_hours' => $credit_hours, 'get_marks' => $get_marks, 'exam_result' => $exam_result);
                    }
                    return json_encode($return_array);
                    }
                    
                    function getWeightageExam($exam_connection_list, $examid, $get_marks) {
                    
                    foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
                    if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                    return ($get_marks * $exam_connection_value->exam_weightage) / 100;
                    }
                    }
                    return "";
                    }
                    ?>
                    
                    
                    
                    
                    </div>
                    
                    </div>
                    
                    </section>
                    </div>
                    
                    
                    
                    <script type="text/javascript">
                    
                    
                    
                    
                    function doconfirm()
                    {
                    job=confirm("Once You applied cannot be modified");
                    if(job!=true)
                    {
                    return false;
                    }
                    
                    }
                    
                    
                    function toggle(source) {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
                    }
                    }
                    
                    
                    function getexam_id()
                    {
                    
                    
                    var exam_id           = $('#exam_id').val();
                    //var exam_groupid       = $('#exam_groupid').val(); 
                    
                    
                    // $('#exam_idd').val(exam_id);
                    //$('#exam_groupidd').val(exam_group_id);
                    
                    
                    
                    $('#exam_group_class_batch_exam_student_id').val(""); 
                    
                    
                    
                    
                    
                    $.ajax({
                    type: "POST",   
                    data: {exam_id: exam_id},  
                    dataType:"JSON",
                    url: "<?php echo site_url('user/revaluation/getstudentbatch_id');?>",
                    success:function(result)
                    {
                    
                    
                    
                    $('#exam_group_class_batch_exam_student_id').val(result['id']);
                    
                    // $('#exam_group_class_batch_exam_print_studentid').val(result['id']); 
                    
                    
                    
                    }
                    }); 
                    
                    
                    
                    
                    }
                    
                    
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
                    
                    </script>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <script>
                    
                    $(document).on('submit', 'form#printMarksheet', function (e) {
                    
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
                    
                    // alert(response);
                    
                    
                    
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
                    
                    </script>
                    
                    
                    <script type="text/javascript">
                    
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
                    </script>