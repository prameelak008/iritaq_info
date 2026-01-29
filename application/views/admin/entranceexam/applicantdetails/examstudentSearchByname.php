        <?php
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        ?>
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
        <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
        </div>
        
        <div class="box-body">
        <form role="form" action="<?php echo site_url('EntranceExam/examviewByName'); ?>" method="post" class="class_search_form">
        <div class="row">
        <div class="col-md-12">
        <div class="row">
        <?php echo $this->customlib->getCSRF(); ?>
        
        
        
        <div class="col-sm-3">
        <div class="form-group">
        <label><?php echo('Phase'); ?></label> <small class="req"> *</small>
        <select autofocus="" id="phaseid" name="phaseid" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        $count = 0;
        foreach ($phaselist as $phase) {
        ?>
        <option value="<?php echo $phase['entrance_examgroup_id'] ?>" <?php if (set_value('phaseid') == $phase['entrance_examgroup_id']) {
        echo "selected=selected";
        }
        ?>><?php echo $phase['entrance_examgroup_name'] ?></option>
        <?php
        $count++;
        }
        ?>
        </select>
        <span class="text-danger" id="error_class_id"></span>
        </div>
        </div>
        
        
        
        <div class="col-sm-3">
        <div class="form-group">
        <label><?php echo('Course'); ?></label> 
        <select autofocus="" id="course_id" name="course_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        $count = 0;
        foreach ($courselist as $crslist) {
        ?>
        <option value="<?php echo $crslist['entranceexam_course_id'] ?>" <?php if (set_value('course_id') == $crslist['entranceexam_course_id']) {
        echo "selected=selected";
        }
        ?>><?php echo $crslist['entranceexam_course_name'] ?></option>
        <?php
        $count++;
        }
        ?>
        </select>
        <span class="text-danger" id="error_class_id"></span>
        </div>
        </div>
        
        
        <div class="col-sm-3">
        <div class="form-group">
        <label><?php echo ('Institute'); ?></label> 
        <select autofocus="" id="institute_id" name="institute_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        $count = 0;
        foreach ($institutelist as $instlist) {
        ?>
        <option value="<?php echo $instlist['entranceexam_insitutename'] ?>" <?php if (set_value('institute_id') == $instlist['entranceexam_insitutename']) {
        echo "selected=selected";
        }
        ?>><?php echo $instlist['entranceexam_insitutename'] ?></option>
        <?php
        $count++;
        }
        ?>
        </select>
        <span class="text-danger" id="error_class_id"></span>
        </div>
        </div>
        
        
        <div class="col-sm-3">
        <div class="form-group">
        <label><?php echo ('Center'); ?></label> 
        
        <!-- <select autofocus="" id="center_id" name="center_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <?php
        $count = 0;
        foreach ($centerlist as $cntrlist) {
        ?>
        <option value="<?php echo $cntrlist['entranceexam_centrename'] ?>" <?php if (set_value('center_id') == $cntrlist['entranceexam_centrename']) {
        echo "selected=selected";
        }
        ?>><?php echo $cntrlist['entranceexam_centrename'] ?></option>
        <?php
        $count++;
        }
        ?>
        </select>-->
        
        
        <select id="center_id" name="center_id" class="form-control" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        
        
        <span class="text-danger" id="error_class_id"></span>
        </div>
        </div>
        
        
        
        <div class="col-sm-12">
        <div class="form-group">
        <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
        </div>
        </div>
        </div>
        </div><!--./col-md-6-->
        </form>
        
        
        
        
        <!--./col-md-6-->
        </div><!--./row-->
        </div>
        
        <?php
        //if (isset($resultlist)) {
        ?>
        <div class="nav-tabs-custom border0 navnoshadow">
        <div class="box-header ptbnull"></div>
        <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list'); ?>  <?php echo $this->lang->line('view'); ?></a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details'); ?> <?php echo $this->lang->line('view'); ?></a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active table-responsive no-padding" id="tab_1">
        <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
        <thead>
        <tr>
        <th>sl.No</th>
        <th>Registered Details</th>
        <th><?php echo ('Name'); ?></th>
        <!--<th><?php echo ('Address'); ?></th>-->
        <th><?php echo ('Date of Birth'); ?></th>
        <th><?php echo ('Admission Date'); ?></th>
        <th><?php echo ('Application_No'); ?></th>
        <th><?php echo ('Register Id'); ?></th>
        
        <th>Course Applied</th>
        <th><?php echo ('Exam Center'); ?></th>
        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($searchlist)) { ?>
        <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
        <?php
        } else {
        $count = 1;
        $sl=1;
        foreach ($searchlist as $searchall) {  ?>
        <tr>
        <td><?php  echo $sl ; ?></td> 
        
        <td style="font-size:15px;"><b > Registered Details</b><br>
         <?php echo $searchall['entrance_examgroup_name']; ?><br>
        <?php echo $searchall['entrance_reg_name']; ?><br>
        <?php echo $searchall['entrance_reg_phone']; ?><br>
        <?php echo $searchall['entrance_reg_email']; ?>
        </a></td>
        <td>
        <?php
        if($searchall['admission_name']=="")
        {
        ?>
        
        <span style="color:#e57841;"> Not Applied For Any Exam<br></span>
        
        
        <?php
        }
        else
        {
        ?>
        <a href="<?php echo base_url(); ?>EntranceExam/examview/<?php echo $searchall['admission_id'] ?>"> <?php echo $searchall['admission_name']; ?></a></td>
        <?php } ?>
        <td>
        <?php echo $searchall['admission_dob']; ?></td>
        <td><?php echo $searchall['admission_date']; ?></td>
        <td><?php echo $searchall['admission_application_no']; ?></td>
        <td><?php echo $searchall['admission_range']; ?></td>
        <td><?php echo $searchall['entranceexam_course_name']; ?></td>
        <td><?php echo $searchall['admission_institute_examcenter']; ?></td>
        <td align="right">
        <a href="<?php echo base_url(); ?>EntranceExam/examview/<?php echo $searchall['admission_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
        <i class="fa fa-reorder"></i>
        </a>
        
        <a href="<?php echo base_url(); ?>EntranceExam/deleteexam/<?php echo $searchall['admission_application_registerid'] ?>" class="btn btn-default btn-xs" id="deleteButton"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" >
        <i class="fa fa-remove"></i>
        </a>
        
        </td>
        </tr>
        <?php
        $sl++;
        }
        $count++;
        }
        ?>
        </tbody>
        </table>
        </div>
        <div class="tab-pane detail_view_tab" id="tab_2">
        <?php if (empty(searchlist)) {
        ?>
        <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
        <?php
        } else {
        $count = 1;
        foreach ($searchlist as $searchall) {
        if (empty($searchall["admission_photo"])) {
        $image = "uploads/student_images/default_male.jpg";
        } else {
        $image = "entrance/admissionphoto/".$searchall['admission_photo'];
        }
        ?>
        <div class="carousel-row">
        <div class="slide-row">
        <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
        <div class="carousel-inner">
        <div class="item active">
        <a href="<?php echo base_url(); ?>EntranceExam/view/<?php echo $searchall['admission_id'] ?>">
        <img class="img-responsive img-thumbnail width150" alt="<?php echo $searchall['admission_name']?>" src="<?php echo base_url() . $image; ?>" alt="Image" style="width:600px;height:600px;"></a>
        </div>
        </div>
        </div>
        <div class="slide-content">
        
        <?php
        if($searchall['admission_name']=="")
        {
        ?>
        <span style="color:#e57841;"> Not Applied For Any Exam<br></span>
        <?php
        }
        else
        {
        ?>
        <h4><a href="<?php echo base_url(); ?>EntranceExam/examview/<?php echo $searchall['admission_id'] ?>"> <?php echo $searchall['admission_name']; ?></a></h4>
        
        <?php } ?>
        
        <b > Registered Details</b><br>
        <?php echo $searchall['entrance_examgroup_name']; ?><br>
        <?php echo $searchall['entrance_reg_name']; ?><br>
        <?php echo $searchall['entrance_reg_phone']; ?><br>
        <?php echo $searchall['entrance_reg_email']; ?>
        </a>
        <br>
        <br>
        
        
        <div class="row">
        <div class="col-xs-6 col-md-6">
        <address>
        <strong><b><?php echo ('Address'); ?>: </b><?php echo $searchall['admission_address']  ?></strong><br>
        <b><?php echo ('Date Of Birth'); ?>: 
        
        <?php if ($adlist["admission_dob"] != null && $searchall["admission_dob"] != '0000-00-00') {echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($searchall['admission_dob']));}?></b><br>
        <b><?php echo ('Admission Date: '); ?><?php echo $searchall['admission_date'] ?><br>
        </address>
        </div>
        <div class="col-xs-6 col-md-6">
        
        <b><?php echo ('Application_No'); ?>:&nbsp;</b><?php echo $searchall['admission_application_no'] ?><br>
        <b><?php echo ('Register id'); ?>:&nbsp;</b><?php echo $searchall['admission_application_registerid'] ?><br>
        
        <b>Course Applied:&nbsp;</b><?php echo $searchall['entranceexam_course_name'] ?><br>
        
        <b><?php echo ('Exam Center'); ?>:&nbsp;</b><?php echo $searchall['admission_institute_examcenter'] ?><br>
       
        </div>
        </div>
        </div>
        <div class="slide-footer">
        <span class="pull-right buttons">
        <a href="<?php echo base_url(); ?>EntranceExam/examview/<?php echo $searchall['admission_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
        <i class="fa fa-reorder"></i>
        </a>
        </span>
        </div>
        </div>
        </div>
        <?php
        }
        $count++;
        }
        ?>
        </div>
        </div>
        </div>
        </div><!--./box box-primary -->
        <?php
        //  }
        ?>
        </div>
        </div>
        </section>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript">
        $(document).ready(function()
        {
        $('#deleteButton').on('click', function() 
        {
        var result = confirm("Are you sure you want to delete?");
        if (result)
        {
        return true;
        }
        else
        {
        return false;
        }
        });
        });
        
        
        $(document).on('change', '#course_id', function (e) {
        $('#institute_id').html("");
        $('#center_id').html("");
        var course_id = $(this).val();
        getInstituteByCourse(course_id,institute_id);
        getCenterByCourse(course_id,center_id);
        });
        
        function getCenterByCourse(course_id,center_id) 
        {
        var course_id = $('#course_id').val();
        if (course_id != "") {
        $('#center_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
        type: "GET",
        url: base_url + "EntranceExam/selectCenter",
        data: {'course_id': course_id},
        dataType: "json",
        success: function (data) 
        {
        $.each(data, function (i, obj)
        {
        div_data += "<option value='" + obj.entranceexam_centrename + "'>" + obj.entranceexam_centrename + "</option>";
        });
        $('#center_id').append(div_data);
        },
        });
        }
        }
        
        function getInstituteByCourse(course_id,institute_id) 
        {
        $('#institute_id').val(); 
        
        var course_id = $('#course_id').val();
        if (course_id != "") {
        $('#institute_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
        type: "GET",
        url: base_url + "EntranceExam/selectInstitute",
        data: {'course_id': course_id},
        dataType: "json",
        success: function (data) 
        {
        $.each(data, function (i, obj)
        {
        div_data += "<option value='" + obj.entranceexam_insitutename   + "'>" + obj.entranceexam_insitutename + "</option>";
        });
        $('#institute_id').append(div_data);
        },
        });
        }
        }
        </script>
