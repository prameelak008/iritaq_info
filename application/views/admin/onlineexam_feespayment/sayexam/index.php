    <div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <h1>
    <i class="fa fa-map-o"></i> Say Exam</small>  
    </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
    <div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('sayexam') .'&nbsp;'.$this->lang->line('payment'); ?></h3>
    </div>
    <div class="box-body">
    <form role="form" action="<?php echo site_url('admin/Onlineexampayment_sayexam') ?>" method="post" >
    <?php echo $this->customlib->getCSRF(); ?>
    <div class="row">
        <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
                <label><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req"> *</small>
                <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control select2" >
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
        <!--./col-md-3-->    
        <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
                <label><?php echo $this->lang->line('exam') ?></label><small class="req"> *</small>
                <select  id="exam_id" name="exam_id" class="form-control select2" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>
        </div>
        <!--./col-md-3-->
        <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
                <label><?php echo $this->lang->line('session'); ?></label><small class="req"> *</small>
                <select  id="session_id" name="session_id" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php
                    foreach ($sessionlist as $session) {
                        ?>
                        <option value="<?php echo $session['id'] ?>" <?php
                        if ($current_session == $session['id']) {
                            echo "selected=selected";
                        }
                        ?>><?php echo $session['session'] ?></option>
                                <?php
                            }
                            ?>
                </select>
                <span class="text-danger"><?php echo form_error('session_id'); ?></span>
            </div>
        </div>
        <!--./col-md-3-->
        <div class="col-sm-6 col-lg-3 col-md-12 col20">
            <div class="form-group">
                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                <select id="class_id" name="class_id" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php
                    foreach ($classlist as $class) {
                        ?>
                        <option value="<?php echo $class['id'] ?>" <?php
                        if (set_value('class_id') == $class['id']) {
                            echo "selected=selected";
                        }
                        ?>><?php echo $class['class'] ?></option>
                                <?php
                            }
                            ?>
                </select>
                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-md-12 col20">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                <select  id="section_id" name="section_id" class="form-control" >
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
            </div>
        </div>
    </div>
    </form>
    </div>
    <br>
    
    <input type="hidden" name="marksheet_template" value="1">
    
    <input type="hidden" name="marksheet_Newexamgroup" value="<?php   echo $Exam_group_list->name;   ?>">
      
    <input type="hidden" name="marksheet_Newexambatch" value="<?php   echo $Exam_group_list->exam;   ?>">
    
    
    <div class="box-body">
    <div class="tab-pane active table-responsive no-padding" id="tab_1">
    <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
    
    
    
    <table class="table table-striped  table-hover example " cellspacing="0" width="100%"   >
    <thead>
    
    <tr>
    <th >Sl.No</th>
    <th>InstitutionId</th>
    <th>RegisterNo</th>
    <th>StudentName</th>
    <th>Mobile No</th>
    <th>Action</th>
    </tr>
    </thead>
    <body>
    
    <?php
    
    $count = 1;
    
    $sl    = 1;
    
    
    foreach ($exampayments as $pay)
    {
    ?>
    <tr><td><?php  echo $sl; ?></td>
    <td><?php  echo $pay['admission_no']; ?></td>
    <td><?php  echo $pay['roll_no']; ?></td>
    <td><?php  echo $pay['firstname'].''.$pay['middlename'].''.$pay['lastname'];   ?></td>
    <td><?php  echo $pay['mobileno'];   ?></td>
    
        <td>
        <form method="POST" action="<?php  echo site_url('admin/Onlineexampayment_sayexam/getpaymentdetails');  ?>">
        <input type="hidden" name="student_id" value="<?php  echo $pay['fees_sayexampayment_student_id'];  ?>" />
        <input type="hidden" name="exam" value="<?php  echo $pay['fees_sayexampayment_examgroup'];   ?>" />
        <input type="hidden" name="examgroup" value="<?php  echo $pay['fees_sayexampayment_examgroupbatch'];  ?>" />
        <input type="hidden" name="class_id" value="<?php  echo $pay['fees_sayexampayment_class_id'];  ?>" />
        <input type="hidden" name="session_id" value="<?php  echo $pay['fees_sayexampayment_session_id']; ?>" />
        <input type="hidden" name="section_id" value="<?php  echo $pay['fees_sayexampayment_section_id']; ?>" />
        <button type="submit" name="submit" title="Payment Details"><i class="fa fa-eye"></i></button>
        </form>
        </td>
        </tr>
    
    
    
    <!--
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?php  echo $sl; ?>">
    View Details
    </button>
    
    <div class="modal fade" id="exampleModalLong<?php  echo $sl; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('payment').'&nbsp;&nbsp;'.$this->lang->line('details'); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    
    <section class="content">
    <div class="row">
    <div class="col-md-12">
    <?php
    
    $slm=1;
    
    foreach($paymentdetails as $paym)
    {
    
    if($pay['fees_payment_student_id']==$paym['fees_payment_student_id'] && $pay['fees_payment_examgroup']==$paym['fees_payment_examgroup'] && $pay['fees_payment_exam']==$paym['fees_payment_exam'] && $pay['fees_payment_class_id']==$paym['fees_payment_class_id'] && $pay['fees_payment_section_id']==$paym['fees_payment_section_id'] && $pay['fees_payment_session']==$paym['fees_payment_session'])
    
    {
    ?>
    
    <div class="row">
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <?php echo $slm ;?>
    </div>
    </div>  
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <?php echo "Order Id".''.$paym['fees_payment_orderid']; ?>
    </div>
    </div>
    
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <?php echo "Transaction Date".''.$paym['fees_payment_transdate']; ?>
    </div>
    </div>
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <?php echo "Transaction No".''.$paym['fees_payment_transaction_no']; ?>
    </div>
    </div>
    
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <?php echo "Amount".''.$paym['fees_payment_amount']; ?>
    </div>
    </div>
    
    
    <div class="col-sm-12">
    <div class="form-group">
    <?php 
    
    if($paym['fees_payment_statuscode']=="S")
    {
    $sta="Success";
    }
    elseif($paym['fees_payment_statuscode']=="F")
    {
    $sta="Failed";
    }
    else
    {
    $sta="No Transaction Found";   
    }
    
    echo "Amount".''.$sta; ?>
    </div>
    </div>
    
    
    
    
    </div>
    
    
    
    
    
    
    <?php    
    }
    $slm++;
    }
    
    
    ?>
    </div> 
    </div> 
    </section>
    
    
    
    
    </div>  
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"   name="findfee" class="btn btn-primary">SAVE</button>
    </div>
    </div>
    </div>
    </div>
    
    -->
    </div>
    
    
    
    
    
    
    <?php
    
    $sl++;
    } 
    
    ?>
    </body>
    </table>
    
    
    
    
    
    
    
    
    </div>
    </div>
    </div>
    </section>
    </div>
    
    
    
    <script type="text/javascript">
    
    
    $(document).ready(function () {
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
    
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
    var class_id = '<?php echo set_value('class_id') ?>';
    var section_id = '<?php echo set_value('section_id') ?>';
    var session_id = '<?php echo set_value('session_id') ?>';
    var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
    var exam_id = '<?php echo set_value('exam_id') ?>';
    getSectionByClass(class_id, section_id);
    
    // getExamgroupByClassSectionSession(class_id, section_id, session_id);
    getExamByExamgroup(exam_group_id, exam_id);
    $(document).on('change', '#exam_group_id', function (e) {
    $('#exam_id').html("");
    var exam_group_id = $(this).val();
    getExamByExamgroup(exam_group_id, 0);
    });
    
    $(document).on('change', '#class_id', function (e) {
    $('#section_id').html("");
    var class_id = $(this).val();
    getSectionByClass(class_id, 0);
    });
    
    function getSectionByClass(class_id, section_id) {
    
    if (class_id !== "") {
    $('#section_id').html("");
    var base_url = '<?php echo base_url() ?>';
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    
    
    $.ajax({
    type: "GET",
    url: base_url + "sections/getByClass",
    data: {'class_id': class_id},
    dataType: "json",
    beforeSend: function () {
    $('#section_id').addClass('dropdownloading');
    },
    success: function (data) {
    $.each(data, function (i, obj)
    {
    var sel = "";
    if (section_id === obj.section_id) {
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
    
    
    function getExamByExamgroup(exam_group_id, exam_id) {
    
    if (exam_group_id !== "") {
    $('#exam_id').html("");
    var base_url = '<?php echo base_url() ?>';
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    
    
    $.ajax({
    type: "POST",
    url: base_url + "admin/examgroup/getExamByExamgroup",
    data: {'exam_group_id': exam_group_id},
    dataType: "json",
    beforeSend: function () {
    $('#exam_id').addClass('dropdownloading');
    },
    success: function (data) {
    $.each(data, function (i, obj)
    {
    var sel = "";
    if (exam_id === obj.id) {
    sel = "selected";
    }
    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
    });
    
    $('#exam_id').append(div_data);
    $('#exam_id').trigger('change');
    },
    complete: function () {
    $('#exam_id').removeClass('dropdownloading');
    }
    });
    }
    }
    </script>
    
    <script>
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