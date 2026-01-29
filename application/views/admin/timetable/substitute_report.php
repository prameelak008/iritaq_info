                        <script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>
                        
                        <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                        <h1>
                        <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small></h1>
                        </section>
                        <!-- Main content -->
                        <section class="content">
                        <div class="row">
                        <div class="col-md-12">
                        <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                        </div>
                        
                        
                        
                        <form action="<?php echo site_url('admin/timetable/classreport_report') ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                        
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                        <label><?php echo $this->lang->line('class'); ?></label>
                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
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
                        
                        
                        
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                        <label><?php echo $this->lang->line('section'); ?></label>
                        <select  id="section_id" name="section_id" class="form-control" >
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        </select>
                        </div>
                        </div>
                        
                        
                        <div class="col-md-3">
                        <div class="form-group">
                        <label><?php echo $this->lang->line('subject') . " " . $this->lang->line('group'); ?></label>
                        <select  id="subject_group_id" name="subject_group_id" class="form-control" >
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        </select>
                        </div>
                        </div>
                        
                        
                        
                        <div class="col-md-3">
                        <div class="form-group">
                        <label><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label> 
                        <input type="date" name="subst_date" id="subst_date" class="form-control" value="<?php echo set_value('subst_date',date('Y-m-d')); ?>" />
                        <span class="text-danger"><?php echo form_error('subst_date'); ?></span>
                        </div>
                        </div>
                        
                        </div>
                        </div>
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right btn-sm"><?php echo $this->lang->line('search'); ?></button>
                        </div>
                        </form>
                        
                        <?php
                        if(!empty($substitute_report))
                        {
                        ?>
                        
                        <div class="row clearfix">
                        <div class="col-md-12 column">
                        <input type='button' id='btn' class="btn btn-success pull-left btn-sm" style="width:10%" value='Print' onclick='printDiv();'> 
                        <br>
                        <br>
                         <div class="box-body">
                        <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('expense_list'); ?></div>
                            <div class="table-responsive"> 
                            
                            <table class="table table-striped table-bordered table-hover example" >
                        <thead>
                        <tr>
                        <th>
                         Sl.No.
                        </th>
                        
                        <th >
                        <?php echo $this->lang->line('class') ?>
                        </th>
                        
                        
                        
                        <th>
                        <?php echo $this->lang->line('period'); ?>
                        </th>
                        <th>
                        <?php echo $this->lang->line('time'); ?>
                        </th>
                        <th>
                        <?php echo $this->lang->line('substitute'); ?>
                        </th>
                        <th>
                        <?php echo $this->lang->line('subject'); ?>
                        </th>
                        </thead>
                        <tbody>
                            
                            
                        <?php
                        $i=1;
                        foreach($substitute_report as $substitute)
                        {
                        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        
                        
                        <td>
                        <?php echo $substitute['Classname'].'-'.$substitute['Sectionname']; ?>
                        </td>
                        
                        
                       
                        <td>
                        <?php echo $substitute['periodname']; ?>
                        </td>
                        <td >
                        <?php 
                        $from  = date("g:i A", strtotime($substitute['time_from']));
                        $to    = date("g:i A", strtotime($substitute['time_to']));
                        
                        echo $from.'&nbsp;&nbsp; - &nbsp;'.$to; ?>
                        </td>
                        
                        
                        <td>
                       <?php echo $substitute['staffname']; ?>
                        </td>
                        <td>
                        <?php echo $substitute['subjectname']; ?>
                        </td>
                        </tr>
                        <?php 
                        $i++;
                        } 
                        ?>   
                        </tbody>
                        </table>
                          </div>
                        </div>
                          </div>
                        </div>
                        
                        
                        </div>
                        </div>
                        <?php } ?>
                        </section>
                        
                        
                        
                        
                        
                        <div id="Tableprint" style="visibility:hidden">
                        
                        <style>
                        @media all and (orientation:portrait)
                        {
                        .fontstyle
                        {
                        font-size:12px;
                        }
                        
                        .trclax
                        {
                        border: 1px solid #999 !important; 
                        text-align:center;
                        }
                        }
                        @media all and (orientation:landscape)
                        {
                        
                        .fontstyle
                        {
                        font-size:10px;
                        }
                        
                        
                       .trclax
                        {
                        border: 1px solid #999 !important; 
                        text-align:center;
                        white-space: nowrap;
                        }
                        
                        }
                         .trclass
                        {
                        border: 1px solid #999 !important; 
                        text-align:center;
                        white-space: nowrap;
                        }
                        
                        .tdclass
                        {
                        text-align:center;
                        }
                        
                        
                        </style>
                        <div class="" style="border:1px solid black !important; height:100% !important;"   >
                        <div class="submain">
                        
                        <table  style="height:110px; width:100%" >
                        <thead>
                        <tr>
                        <th><img src="<?php  echo base_url(); ?>backend/default_format/substitute.jpg"  style="width:88%; height:130px; padding-bottom:10px;"/>
                        </th>
                        </tr>
                        
                        <tr><td><hr style="border-top: 1px solid #605b60; width:95%; align:center;"></hr></td></tr>
                        <tr>
                        <th>SUBSTITUTION TIME TABLE DETAILS</th>
                        </tr>
                        <tr>
                        <th>
                        Date :<?php   echo date('d F Y', strtotime($subst_date)).'&nbsp; ,&nbsp;'.$dayval; ?></th>
                        </tr>
                        </head>
                        </table>
                        <br>
            
               
                    <table  style="border: 1px solid #999 !important;border-collapse: collapse; color: #000; width:90%;  margin-left: auto;
  margin-right: auto; ">
                        <thead>
                        <tr class="trclass" >
                        <th class="trclass" style="width:5%;">
                        Sl.No.
                        </th>
                        
                        <th class="trclass" style="width:20%;">
                        <?php echo $this->lang->line('class') ?>
                        </th>
                        
                        
                        
                        
                        <th class="trclass" style="width:5%;">
                        <?php echo $this->lang->line('period'); ?>
                        </th>
                        <th class="trclass" style="width:10%;">
                        <?php echo $this->lang->line('time'); ?>
                        </th>
                        <th class="trclass" style="width:10%;">
                        <?php echo $this->lang->line('substitute'); ?>
                        </th>
                        <th class="trclass" style="width:10%;">
                        <?php echo $this->lang->line('subject'); ?>
                        </th>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach($substitute_report as $substitute)
                        {
                        ?>
                        <tr>
                        <td class="trclass"><?php echo $i; ?></td>
                        
                        <td class="trclass">
                        <?php echo $substitute['Classname'].'-'.$substitute['Sectionname']; ?>
                        </td>
                        
                        <td class="trclass">
                        <?php echo $substitute['periodname']; ?>
                        </td>
                        
                        
                        <td class="trclass">
                        <?php 
                        $from  = date("g:i A", strtotime($substitute['time_from']));
                        $to    = date("g:i A", strtotime($substitute['time_to']));
                        
                        echo $from.'&nbsp;&nbsp; - &nbsp;'.$to; ?>
                        </td>
                        <td class="trclax">
                        <?php echo $substitute['staffname']; ?>
                        </td>
                        <td class="trclass">
                        <?php echo $substitute['subjectname'];
                         echo "<br>";
                         echo $substitute['subjectcode']; 
                        
                        ?>
                        </td>   
                        </tr>
                        <?php 
                        $i++;
                        } 
                        ?>   
                        </tbody>
                        </table>
                        
                        
                        </div>
                        </div>
                        <div class="pagebreak" style="page-break-after:"></div>
                        </div>
                        </div>
                        
                        
                        <script type="text/javascript">
                        
                        $(document).on('focus', '.time', function () {
                        var $this = $(this);
                        $this.datetimepicker({
                        format: 'LT'
                        });
                        });
                        var tot_count = 0;
                        var class_id = $('#class_id').val();
                        var section_id = '<?php echo set_value('section_id') ?>';
                        var subject_group_id = '<?php echo set_value('subject_group_id') ?>';
                        $(document).ready(function ()
                        {
                        
                        $('#myTabs a:first').tab('show') // Select first tab
                        getSectionByClass(class_id, section_id);
                        getGroupByClassandSection(class_id, section_id, subject_group_id);
                        
                        $(document).on('change', '#class_id', function (e) {
                        $('#section_id').html("");
                        var class_id = $(this).val();
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        
                        $.ajax({
                        type: "GET",
                        url: base_url + "sections/getByClass",
                        data: {'class_id': class_id},
                        dataType: "json",
                        success: function (data) {
                        $.each(data, function (i, obj)
                        {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                        });
                        
                        $('#section_id').append(div_data);
                        }
                        });
                        });
                        
                        $(document).on('change', '#section_id', function (e) {
                        $('#subject_group_id').html("");
                        var section_id = $(this).val();
                        var class_id = $('#class_id').val();
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                        type: "POST",
                        url: base_url + "admin/subjectgroup/getGroupByClassandSection",
                        data: {'class_id': class_id, 'section_id': section_id},
                        dataType: "json",
                        success: function (data) {
                        $.each(data, function (i, obj)
                        {
                        div_data += "<option value=" + obj.subject_group_id + ">" + obj.name + "</option>";
                        });
                        
                        $('#subject_group_id').append(div_data);
                        }
                        });
                        });
                        });
                        
                        function getSectionByClass(class_id, section_id) {
                        if (class_id != "" && section_id != "") {
                        $('#section_id').html("");
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        
                        $.ajax({
                        type: "GET",
                        url: base_url + "sections/getByClass",
                        data: {'class_id': class_id},
                        dataType: "json",
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
                        }
                        });
                        }
                        }
                        
                        
                        function getGroupByClassandSection(class_id, section_id, subject_group_id) {
                        if (class_id != "" && section_id != "" && subject_group_id != "") {
                        $('#subject_group_id').html("");
                        
                        var base_url = '<?php echo base_url() ?>';
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                        type: "POST",
                        url: base_url + "admin/subjectgroup/getGroupByClassandSection",
                        data: {'class_id': class_id, 'section_id': section_id},
                        dataType: "json",
                        success: function (data) {
                        console.log(subject_group_id);
                        $.each(data, function (i, obj)
                        {
                        var sel = "";
                        if (subject_group_id == obj.subject_group_id) {
                        sel = "selected";
                        }
                        div_data += "<option value=" + obj.subject_group_id + " " + sel + ">" + obj.name + "</option>";
                        });
                        
                        $('#subject_group_id').append(div_data);
                        }
                        });
                        }
                        }
                        
                        
                        
                        
                        function printDiv() 
                        {
                        var divToPrint=document.getElementById('Tableprint');
                        var newWin=window.open('','Print-Window');
                        newWin.document.open();
                        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                        newWin.document.close();
                        setTimeout(function(){newWin.close();},10);
                        }
                        </script>
                    
                        
                        
                        
                        
                     
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
