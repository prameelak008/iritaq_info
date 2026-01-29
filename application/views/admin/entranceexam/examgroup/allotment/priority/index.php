                <?php
                $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
                $language = $this->customlib->getLanguage();
                $language_name = $language["short_code"];
                ?>
                <style type="text/css">
                
                @media print {
                .no-print {
                visibility: hidden !important;
                display:none !important;
                }
                }
                </style>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                
                <section class="content-header">
                <h1>
                <i class="fa fa-usd"></i> Exam Group</h1>
                </section>
                
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary" style="padding-bottom: 100px">
                <div class="box-header with-border">
                <h3 class="box-title">Set Priority</h3>
                </div><!-- /.box-header -->
                
                
                <form id="form1" action="<?php echo site_url('entrance_allotment/allotment/setpriority'); ?>"  id="setpriority" name="setpriority" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="box-body">
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo ('Course'); ?><small class="req"> *</small></label>
                <select class="form-control" name="course_id" id="course_id">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php foreach($courselist as $crslist){ ?>
                <option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if(set_value('inst_course')==$crslist['entranceexam_course_id'])
                {
                echo "selected=selected";
                }?>><?php echo $crslist['entranceexam_course_name']; ?></option>
                <?php } ?>
                </select>
               
                </div> 
                
                
                
                <div class="form-group">
                <label><?php echo ('Institute'); ?></label> <small class="req"> *</small>
                <select autofocus="" id="institute_id" name="institute_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger" id="error_class_id"></span>
                </div>
                
                <div class="form-group">
                <label>Priority</label> <small class="req"> *</small>
                <input type="number" name="priority" class="form-control" value="<?php  echo set_value('priority');  ?>" id="priority"/>
                <span class="text-danger" id="priority"></span>
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
              
               <!-- <select name="session" class="form-control">
                
                <?php
                foreach($sessionlist as $session)
                {
                ?>
                <option value="<?php  echo $session['id']; ?>">
                <?php   echo $session['session']; ?>
                </option>
                <?php } ?>
                </select>
                -->
                
                <select name="session" id="session" class="form-control">
                <?php
                
                foreach($sessionlist as $session)
                {
                ?>
                <option value="<?php echo $session['id'] ?>" <?php
                if ($current_session['cur_session'] == $session['id']) 
                {
                echo "selected=selected";
                }
                ?>><?php   echo $session['session']; ?></option>
                <?php } ?>  
                </select>
                
                <span class="text-danger"><?php echo form_error('session'); ?></span>
                </div>
                
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                </div>
                </form>
                
                
                
                </div>
                </div><!--/.col (right) -->
                <!-- left column -->
                <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix">Edit Priority </h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover example" >
                <thead>
                <tr>
                <th><?php echo $this->lang->line('name'); ?>
                <th><?php echo $this->lang->line('session'); ?>
                </th>
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                
               
                foreach ($examgroup as $group) { ?>
                <tr>                                                  
                <td><?php echo $group['entrance_examgroup_name']; ?></td>
                <td><?php echo $group['session'];
                ?></td>
                
                <td align="right">
                    
                    
                <!--<a data-placement="left" href="<?php echo site_url();?>entrance_allotment/examgroup/editval/<?php echo $group['entrance_examgroup_id']; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>  -->
                    
                
                <!--<a data-placement="left" href="<?php echo site_url(); ?>entrance_allotment/examgroup/delval/<?php echo  $group['entrance_examgroup_id']; ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a>-->
               
                
                </td>
                </tr>                                        
                <?php
                $count++;
                }
                ?>
                </tbody>
                </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                </div>
                </div><!--/.col (left) -->
                <!-- right column -->
                
                </div>
                
                </section><!-- /.content -->
                </div>
                
                
                
                
                <script type="text/javascript">
                $(document).ready(function (e) {
                $("#form1").on('submit', (function (e) {
                e.preventDefault();
                
                $.ajax({
                url: "<?php echo site_url("entrance_allotment/examgroup/add_val") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    
                if (data.status == "fail")
                {
                var message = "";
                $.each(data.error, function (index, value) 
                {
                message += value;
                });
                errorMsg(message);
                } 
                else 
                {
                successMsg(data.message);
                window.location.reload(true);
                }
                }
                });
                }));
                });
                
                
        
        $(document).on('change', '#course_id', function (e)
        {
        $('#institute_id').html("");
      
        var course_id = $(this).val();
        getInstituteByCourse(course_id,institute_id);
        getCenterByCourse(course_id,center_id);
        });
        
        
        
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
        div_data += "<option value='" + obj.entranceexam_insituteid   + "'>" + obj.entranceexam_insitutename + "</option>";
        });
        $('#institute_id').append(div_data);
        },
        });
        }
        }
        </script>
                
                
             
                
                
