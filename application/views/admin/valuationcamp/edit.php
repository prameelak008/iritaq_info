        <style type="text/css">
        @media print
        {
        .no-print, .no-print *
        {
        display: none !important;
        }
        }
        </style>
        <?php
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        $result    = $this->customlib->getUserData();
        $role      = $result["user_type"];
        ?>
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
        <i class="fa fa-bus"></i> <?php echo $this->lang->line('valuation_Camp'); ?></h1>
        </section>
        <section class="content">
        
        <div class="row">
        
        <?php if ($this->rbac->hasPrivilege('assign_subject', 'can_add') || $this->rbac->hasPrivilege('assign_subject', 'can_edit'))
        { ?>
        
        
        <div class="col-md-4">
        <div class="box box-primary" >
        <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('valuation_Camp'); ?></h3>
        </div>
        
        <form id="form1" action="<?php echo site_url('admin/valuation/update') ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="box-body">
         <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
        <?php
        if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>      
        <?php echo $this->customlib->getCSRF(); ?>
        <div class="form-group">
        <label ><?php echo $this->lang->line('title') ; ?><small class="req"> *</small></label>
        <select autofocus="" required="required" id="valuation_title" name="valuation_title" class="form-control" >
        <option value="<?php  echo $editvaluation['valuation_centerid']; ?>"><?php  echo $editvaluation['valuation_centername']; ?></option>
        <?php
        foreach ($valuationcenter as $center ) {
        ?>
        <option value="<?php echo $center['valuation_centerid'] ?>" <?php
        if (set_value('valuation_title') == $center['valuation_centerid']) {
        echo "selected=selected";
        }
        ?>><?php echo $center['valuation_centername']; ?></option>
        <?php
        }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('valuation_title'); ?></span>
        </div>
        
        <!--
        <div class="form-group">
        <label><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req"> *</small> 
        <input type="text" name="exam_val" id="exam_val" readonly="readonly" value="<?php  echo $editvaluation['name']; ?>" class="form-control"/>
        <input type="hidden" name="exam_id" id="exam_id" class="form-control" value="<?php  echo $editvaluation['examgroupid']; ?>" />
        </div>
        
        
        <div class="form-group">
        <label><?php echo $this->lang->line('exam') ; ?></label><small class="req"> *</small>
        <input type="text" name="exam_group_value" readonly="readonly" value="<?php  echo $editvaluation['exam']; ?>" id="exam_group_value"  class="form-control"/>
        <input type="hidden" name="exam_group_id" id="exam_group_id" class="form-control"  value="<?php  echo $editvaluation['batchexamid']; ?>"/>
        </div>
        -->
        
        <div class="form-group">
        <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
        <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
        <?php
        foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
        ?>
        <option value="<?php echo $ex_group_value->id ?>" <?php
        if ( $editvaluation['valuation_examgroup'] == $ex_group_value->id) {
        echo "selected=selected";
        }
        ?>><?php echo $ex_group_value->name; ?></option>
        <?php
        }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
        </div>
        
        
        <div class="form-group">  
        <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
        <select  id="exam_id" name="exam_id"  class="form-control" >
        <option value="<?php  echo $editvaluation['valuation_examid'] ?>"><?php  echo $editvaluation['exam'] ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
        </div> 
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('staff'); ?></label><small class="req"> *</small>
        <select class="form-control" id="staff" name="staff"  >
        <option value="<?php  echo $editvaluation['staffid']; ?>"><?php  echo $editvaluation['staffname']; ?></option>
        
        <?php
        foreach($Stafflist as $staf) 
        {
        ?>
        <option value="<?php  echo $staf['id'];  ?>"><?php  echo $staf['name'];  ?></option>
        <?php } ?>
        </select>
        <span class="text-danger"><?php echo form_error('staff'); ?></span>
        </div>
        
        
        
        
        <!--<div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('subject'); ?></label><small class="req"> *</small>
        <select class="form-control" id="subject" name="subject"  >
        <option value="<?php  echo $editvaluation['subjectid']; ?>"><?php  echo $editvaluation['subjectname']; ?></option>
        <?php
        foreach($subjectlist as $sub) {
        ?>
        
        <option value="<?php  echo $sub['id'];  ?>"><?php  echo $sub['name'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$sub['code'];  ?></option>
        
        <?php } ?>
        
        </select>
        <span class="text-danger"><?php echo form_error('subject'); ?></span>
        </div>-->
        
        
        
        <div class="form-group">
        <label><?php echo $this->lang->line('select') . " " . $this->lang->line('subject'); ?></label><small class="req"> *</small>
        <select id="subject" name="subject" class="form-control select2"  >
        <option value="<?php  echo $editvaluation['subjectid']; ?>"><?php  echo $editvaluation['subjectname']; ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('subject'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('paper'); ?></label><small class="req"> *</small>
        <input type="text"  name="paper" id="paper" class="form-control"  value="<?php  echo $editvaluation['subjectpaper_papername'].'&nbsp;&nbsp;'.$editvaluation['subjectpaper_papercode']; ?>"/>
        <span class="text-danger"><?php echo form_error('paper'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('Bundle_Code'); ?></label>
        <input id="bundle_Code" name="bundle_Code" placeholder="" type="text" class="form-control"  value="<?php  echo $editvaluation['valuation_bunblecode']; ?>" />
        <span class="text-danger"><?php echo form_error('bundle_Code'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('assigned').'&nbsp;'. $this->lang->line('date'); ?></label>
        <input type="datetime-local"  name="date" class="form-control"  value="<?php echo $editvaluation['valuation_date'];  ?>"/>
        <span class="text-danger"><?php echo form_error('date'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('submission'); ?>&nbsp;<?php echo $this->lang->line('date'); ?><?php echo $this->lang->line('time'); ?></label>
        
        <input type="datetime-local"  name="submissiondate" class="form-control"  value="<?php echo $editvaluation['valuation_submissiondate'];  ?>"/>
        <span class="text-danger"><?php echo form_error('submissiondate'); ?></span>
        </div>
        
        
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('submit'); ?>&nbsp;<?php echo $this->lang->line('date'); ?><?php echo $this->lang->line('time'); ?></label>
        <br>
        <span class="text-danger" style="font-size:18px; color:#d03e11; "><?php echo $editvaluation['valuation_submitted_date'];  ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('count').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('paper'); ?></label>
        <input id="countofpaper" name="countofpaper" placeholder="" readonly="readonly" type="text" class="form-control"  value="<?php  echo $editvaluation['valuation_countofpaper']; ?>" />
        <span class="text-danger"><?php echo form_error('countofpaper'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?> </label>
        <input id="amount" name="amount" placeholder="" type="text" readonly="readonly" class="form-control"  value="<?php  echo $editvaluation['valuation_amount']; ?>" />
        <span class="text-danger"><?php echo form_error('amount'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
        <textarea class="form-control" id="note" name="note" placeholder="" rows="3" placeholder="Enter ...">
        <?php  echo $editvaluation['valuation_note']; ?></textarea>
        <span class="text-danger"><?php echo form_error('note'); ?></span>
        </div>
        
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
        </div>
        </form>
        </div>
        </div>     
        <?php  } ?>  
        
        
        <div class="col-md-<?php
        if ($this->rbac->hasPrivilege('assign_subject', 'can_add') || $this->rbac->hasPrivilege('assign_subject', 'can_edit'))
        {
        echo "8";
        
        } 
        else 
        {
        echo "12"; } ?>">
        <div class="box box-primary" id="vehicle">
        
        <div class="box-header ptbnull">
        <h3 class="box-title titlefix"><?php echo $this->lang->line('valuation_Camp'); ?></h3>
        <br>
        <br>
        </div>
        
        <div class="box-body">
        <div class="mailbox-controls">                         
        <div class="pull-right">
        </div>
        </div>
        
        
        <div class="mailbox-messages table-responsive">
        
        <div class="download_label"><?php echo $this->lang->line('valuation_Camp'); ?>
        </div>
        
        <table class="table table-striped table-bordered table-hover example">
        <thead>
        <tr>
        <th><?php echo $this->lang->line('staff'); ?></th>
        <th><?php echo $this->lang->line('code'); ?> </th>
        <th><?php echo $this->lang->line('subject'); ?> </th>
        <th><?php echo $this->lang->line('Bundle_Code'); ?></th>
        <th><?php echo $this->lang->line('count').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('paper'); ?>
        <th><?php echo $this->lang->line('assigned').'&nbsp;&nbsp;'.$this->lang->line('date'); ?></th>
        <th ><?php echo $this->lang->line('submission').''.$this->lang->line('date'); ?></th>
        <th><?php echo $this->lang->line('submit').''.$this->lang->line('date'); ?></th>
        <?php
        if($role!="Teacher")  { 
        ?>
        <th><?php echo $this->lang->line('amt').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('remuneration'); ?></th>
        <?php } ?>
        <th class="text-right no-print"><?php echo $this->lang->line('submission').'&nbsp;'.$this->lang->line('status'); ?></th>
        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
        
        </tr>
        </thead>
        <tbody>
            
        <?php if (empty($valuation_list)) 
        {
        ?>
        <?php
        } 
        else 
        {
        $count = 1;
        $tot   = 0;
        $amt   = 0;
        $grandtotal=0;
        foreach ($valuation_list as $data) 
        {
        ?>
        <tr>
        <td class="mailbox-name"> <?php echo $data['staffname']; ?></td>
        <td class="mailbox-name"> <?php echo $data['subjectcode']; ?></td>
        
        <td class="mailbox-name"><?php echo $data['subjectname']; ?> </td>   
        <td class="mailbox-name"><?php echo $data['valuation_bunblecode']; ?> </td>
        <td class="mailbox-name"><?php echo $data['valuation_countofpaper']; ?></td>
        <td>
        
        <?php
        $str=$data['valuation_date'];
        $delimiter = 'T';
        $words = explode($delimiter, $str);
        $valuation_date= $words[0].'&nbsp;&nbsp;'.$words[1];
        echo $valuation_date;
        ?>
        
        </td>
        <td class="mailbox-name">
        
        <?php
        $str=$data['valuation_submissiondate'];
        $delimiter = 'T';
        $words = explode($delimiter, $str);
        $submissiondate= $words[0].''.$words[1];
        echo $submissiondate;
        ?>
        </td>
        
        
        
        <td class="mailbox-name">
        
        <?php
        $strsub=$data['valuation_submitted_date'];
        $delimiter = 'T';
        $wordsub = explode($delimiter, $strsub);
        $submittdate= $wordsub[0].''.$wordsub[1];
        echo $submittdate;
        ?>
        </td>
        <?php
        if($role!="Teacher")  { 
        ?>
        <td class="mailbox-name"><?php echo $data['valuation_countofpaper']*$data['valuation_amount']; ?></td>
        <?php } ?>
        <td class="mailbox-name">
        <?php
        if($words[0] <= date('Y-m-d'))
        {
        $date1=date_create(date($words[0]));
        $date2=date_create(date('Y-m-d'));
        $diff=date_diff($date1,$date2);
        $days= $diff->format("%R%a days");
        $status=$days.'&nbsp;'."left";
        $class="btn btn-warning btn-sm pull-right";
        }
        elseif($words[0] >= date('Y-m-d'))
        {
        $status="Over Due";
        $class="btn btn-danger btn-sm pull-right";
        }
        if($words[0] == date('Y-m-d'))
        {
        $status="Submitted";
        $class="btn btn-success btn-sm pull-right";
        }
        ?>
        <button type="button"  class="<?php  echo $class; ?>" ><?php echo $status;    ?></button>
        </td>
        
        <td class="mailbox-date pull-right no-print">
        
        
        <?php
        if ($this->rbac->hasPrivilege('assign_subject', 'can_edit')) {
        ?>
        
        <a data-placement="left" href="<?php echo base_url(); ?>admin/Valuation/edit/<?php echo $data['valuation_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
        <i class="fa fa-pencil"></i>
        </a>
        <?php 
        } 
        if ($this->rbac->hasPrivilege('assign_subject', 'can_delete')) {
        ?>
        
        <a data-placement="left" href="<?php echo base_url(); ?>admin/Valuation/delete/<?php echo $data['valuation_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
        <i class="fa fa-remove"></i>
        </a>
        <?php } ?>
        </td>
        
       
        
        </tr>
        <?php
        
        $tot+=$data['valuation_countofpaper'];
        $amt+=$data['valuation_amount'];
        $grandtotal+= $data['valuation_countofpaper']*$data['valuation_amount'];
        }
        $count++;
        }
        ?>
        
        <?php
        if($role!="Teacher")  { 
        ?>
        <tr style="color:#d23131;font-size:16px;">
        
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        
        <td class="mailbox-name"></td>
        <td class="mailbox-name" style="font-weight:bold;"><b><?php echo $this->lang->line('total'); ?></b></td>
        
        <td class="mailbox-name"><b><?php echo $tot; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        
        <td class="mailbox-name"></td>
        <td class="mailbox-name" style="text-align: left;"><i class="fa fa-rupee"></i>&nbsp;<b><?php echo $grandtotal; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        </tr>
        <?php } ?>
        
        
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>  
        
        </div>
        <div class="row">           
        <div class="col-md-12">
        </div>
        </div> 
        </section>
        </div>
        <script type="text/javascript">
        
        $(document).ready(function () {
        
        $("#btnreset").click(function () {
        $("#form1")[0].reset();
        });
        });
        
        var base_url = '<?php echo base_url() ?>';
        function printDiv(elem) {
        Popup(jQuery(elem).html());
        }
        
        
        
        function Popup(data)
        {
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
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
        
        
        
        $(document).ready(function () {
        $('.detail_popover').popover({
        placement: 'right',
        trigger: 'hover',
        container: 'body',
        html: true,
        content: function () {
        return $(this).closest('td').find('.vehicle_detail_popover').html();
        }
        });
        });
        
        $(document).on('change', '#exam_id', function (e) 
        {       
        // $('#subject').html("");
        var exam_id = $(this).val();
        getSubjectByExamgroup(exam_id, 0);
        });
        
        
        function getSubjectByExamgroup(exam_id, subject) 
        {
        if (exam_id !== "") {
        $('#subject').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_dataa = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
        type: "POST",
        url: base_url + "admin/valuationmarkentry/getsubject",
        data: {'exam_id': exam_id},
        dataType: "json",
        beforeSend: function () {
        $('#exam_id').addClass('dropdownloading');
        },
        success: function (data) 
        {
        $.each(data, function (i, obj)
        {
        var sel = "";
        if (subject === obj.subjectid) {
        sel = "selected";
        
        var sub=obj.subjectid;
        $('#subjectlist').val(sub);
        }
        div_dataa += "<option value=" + obj.subjectid + " " + sel + ">" + obj.subjectid +'-'+ obj.code +'-'+ obj.name + "</option>";
        });
        
        $('#subject').append(div_dataa);
        $('#subject').trigger('change');
        },
        complete: function () {
        $('#subject').removeClass('dropdownloading');
        }
        });
        }
        }
        
        
        $(document).on('change', '#subject', function (e) 
        {
        var valuation_title = $('#valuation_title').val();
        var exam_id         = $('#exam_id').val();
        var subject         = $(this).val();
        tot=0;
        $.ajax({
        type: "POST",
        url: base_url + "admin/valuation/getvaluationtotal",
        data: {exam_id: exam_id,subject:subject,valuation_title:valuation_title},
        dataType: "json",
        success: function (data) 
        {
        $('#countofpaper').val(data.valuation_subject_list_papercount);
        $('#amount').val(data.valuation_subject_list_amount);
        var tot=data.valuation_subject_list_papercount*data.valuation_subject_list_amount;
        $('#totalamount').val(tot);
        },
        });
        });
        
        
        
        
        $(document).on('change', '#exam_group_id', function (e)
        {
        $('#exam_id').html("");
        var exam_group_id = $(this).val();
        getExamByExamgroup(exam_group_id, 0);
        });
        
        function getExamByExamgroup(exam_group_id, exam_id) 
        {
        if (exam_group_id != "")
        {
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
        
        
        
        $(document).on('change', '#subject', function (e) 
        {
            
        var subject         = $(this).val();
        $.ajax({
        type: "POST",
        url: base_url + "admin/valuation/getsubject_paper",
        data: {subject: subject},
        dataType: "json",
        success: function (data) 
        {
        $('#paper').val(data.subjectpaper_papername + ' ' + data.subjectpaper_papercode);
       
        },
        });
        });
        
        </script>