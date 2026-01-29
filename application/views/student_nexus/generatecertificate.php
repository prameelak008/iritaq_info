            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            ?>
            <div class="content-wrapper">  
            <section class="content-header">
            <h1><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('certificate'); ?></h1>
            </section>
            <!-- Main content -->
            <section class="content">


            <div class="col-md-12">
            <?php
            $this->load->view('layout/topbar_studentnexus'); ?>
            </div>
            &nbsp;
            <?php
            /* if ($this->session->flashdata('msg')) {?>
            <?php echo $this->session->flashdata('msg') ?>
            <?php }
            */
            ?>
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
            </div>
            <div class="box-body">
            <div class="row">


            <form role="form" action="<?php echo site_url('student_nexus/generatecertificate/') ?>" method="post" class="class_search_form">
            <div class="promotion-grid">
            <!-- Selection Section -->
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

            <div class="row">
            <div class="col-md-12">


            <div class="row">
            <?php echo $this->customlib->getCSRF(); ?>

            <div class="col-md-4">
            <div class="form-group">
            <label>Program Type / Program <small class="req">*</small></label>

            <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
            <span class="text-danger"><?php echo form_error('program'); ?></span>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-group">
            <label>Semester / Batch / Term <small class="req">*</small></label>

            <?php
            echo render_semester_dropdown($semesters_batches, set_value('semester'));
            ?>
            </div>
            </div>



            <div class="col-md-4">
            <div class="form-group">
            <label><?php echo $this->lang->line('template'); ?><small class="req">*</small></label>
            <select name="certificate_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php
            if (isset($certificateList)) {
            foreach ($certificateList as $list) {
            ?>
            <option value="<?php echo $list->id ?>" <?php if (set_value('certificate_id') == $list->id) echo "selected=selected" ?>><?php echo $list->certificate_name ?></option>
            <?php
            }
            }
            ?>
            </select>
             <span class="text-danger"><?php echo form_error('id_card'); ?></span>
            </div>
            </div>
            </div>
            </div>                 

            </div>
            </div>
            </div>

            <div class="col-md-12">
            <div class="row">

            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
            <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('search'); ?>
            </button>
            </div>
            </div>
            </div>
            </div> 
            </div>
            </form>



            </div>  
            </div>

            <?php
            if (isset($resultlist)) {
            ?>
            <form method="post" action="<?php echo base_url('student_nexus/generatecertificate/generatemultiple') ?>">
            <div  class="" id="duefee">
         
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>
            <button  class="btn btn-info btn-sm printSelected pull-right" type="button" name="generate" title="generate multiple certificate"><?php echo $this->lang->line('generate'); ?></button>
            </div>
            <div class="box-body table-responsive">
            <div class="download_label"><?php echo $title; ?></div>
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
            <tr>
            <th><input type="checkbox" id="select_all" /></th>
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('student_name'); ?></th>
            <th><?php echo $this->lang->line('class'); ?></th>
            <th><?php echo $this->lang->line('father_name'); ?></th>
            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
            <th><?php echo $this->lang->line('gender'); ?></th>
            <th><?php echo $this->lang->line('category'); ?></th>
            <th class=""><?php echo $this->lang->line('mobile_no'); ?></th>

            </tr>
            </thead>
            <tbody>
            <?php
            if (empty($resultlist)) {
            ?>
                    <!-- <tr>
                        <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                    </tr> -->
            <?php
            } else {
            $count = 1;
            foreach ($resultlist as $student) {
            ?>
            <tr>
            <td class="text-center"><input type="checkbox" class="checkbox center-block"  name="check" data-student_id="<?php echo $student['id'] ?>" value="<?php echo $student['id'] ?>">
            <!-- <input type="hidden" name="class_id" value="<?php echo $student['class_id'] ?>"> -->

            <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
            <input type="hidden" name="certificate_id" value="<?php echo $certificateResult[0]->id ?>" id="certificate_id">
            </td>
            <td><?php echo $student['admission_no']; ?></td>
            <td>
            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $this->customlib->getFullName($student['firstname'],$student['middlename'],$student['lastname'],$sch_setting->middlename,$sch_setting->lastname);  ?>
            </a>
            </td> 
            <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
            <td><?php echo $student['father_name']; ?></td>
            <td><?php if($student['dob']!='' && $student['dob']!='0000-00-00'){ echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); } ?></td>
            <td><?php echo $student['gender']; ?></td>
            <td><?php echo $student['category']; ?></td>
            <td><?php echo $student['mobileno']; ?></td>

            </tr>
            <?php
            $count++;
            }
            }
            ?>
            </tbody>
            </table>

            </div>                                                                           
            </div>                                                         
            </div>
            </form>
            <?php
            }
            ?>
            </div>  
            </div>  
            </div> 
            </section>
            </div>
           
            <script type="text/javascript">
            $(document).ready(function () {
            $('#select_all').on('click', function () {
            if (this.checked) {
            $('.checkbox').each(function () {
            this.checked = true;
            });
            } else {
            $('.checkbox').each(function () {
            this.checked = false;
            });
            }
            });

            $('.checkbox').on('click', function () {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
            $('#select_all').prop('checked', true);
            } else {
            $('#select_all').prop('checked', false);
            }
            });
            });
            </script>

            
            <script type="text/javascript">
            $(document).ready(function () {
            $(document).on('click', '.printSelected', function () {
            var array_to_print = [];
            var sem_group_id = $("#sem_group_id").val();
            var certificateId = $("#certificate_id").val();
            $.each($("input[name='check']:checked"), function () {
            var studentId = $(this).data('student_id');
            item = {}
            item ["student_id"] = studentId;
            array_to_print.push(item);
            });
            if (array_to_print.length == 0) {
            alert("<?php echo $this->lang->line('no_record_selected'); ?>");
            } else {
            $.ajax({
            url: '<?php echo site_url("student_nexus/generatecertificate/generatemultiple") ?>',
            type: 'post',
            dataType: "html",
            data: {'data': JSON.stringify(array_to_print), 'sem_group_id': sem_group_id, 'certificate_id': certificateId, },
            success: function (response) {                       
            Popup(response);

            }
            });
            }
            });
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
            // frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');

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