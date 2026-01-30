                
                <div class="content-wrapper" style="min-height: 946px;">
                <section class="content-header">
                <h1>
                <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('attempts'); ?> <small>
                <?php echo $this->lang->line(''); ?></small> 
                </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="row">
                
                
                <div class="col-md-4">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('attempts'); ?></h3>
                </div>
                
                
                <form action="<?php echo site_url('admin/attempts/edit_attempt/' . $get_attempts_id['ex_id']); ?>"  id="attempts" name="attempts" method="post" accept-charset="utf-8">
                <div class="box-body">
                   <?php  /*if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php }  */ ?> 
                <?php echo $this->customlib->getCSRF(); ?>
                <div class="form-group">
                <label>
                <?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req"> *</small>
                
                <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control select2" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
                ?>
                <option value="<?php echo $ex_group_value->id ?>" <?php
                if ($get_attempts_id['ex_exam_group'] == $ex_group_value->id) {
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
                <label><?php echo $this->lang->line('exam') ?></label><small class="req"> *</small>
                <select  id="exam_id" name="exam_id" class="form-control select2"  >
                <option value="<?php  echo $get_attempts_id['ex_exam'] ?>"><?php  echo $get_attempts_id['exam'] ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                </div> 
                
             
                
                <div class="form-group">  
                <label><?php echo $this->lang->line('session'); ?></label><small class="req"> *</small>
                <select  id="session_id" name="session_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                foreach ($sessionlist as $session) {
                ?>
                <option value="<?php echo $session['id'] ?>" <?php
                if ($get_attempts_id['ex_session'] == $session['id']) {
                echo "selected=selected";
                }
                ?>><?php echo $session['session'] ?></option>
                <?php
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('session_id'); ?></span>
                </div> 
                
                
                
                <div class="form-group">
                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                <select id="class_id" name="class_id" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                foreach ($classlist as $class) {
                ?>
                <option value="<?php echo $class['id'] ?>" <?php
                if ($get_attempts_id['ex_class'] == $class['id']) {
                echo "selected=selected";
                }
                ?>><?php echo $class['class'] ?></option>
                <?php
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('class_id'); ?></span> 
                </div> 
                
                
                <div class="form-group">  
                <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                <select  id="section_id" name="section_id" class="form-control" >
                <option value="<?php echo $get_attempts_id['ex_section']; ?>"><?php echo $get_attempts_id['section']; ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                </div>
                
                
               
                
                <div class="form-group">
                <label for="exam_type"><?php echo $this->lang->line('exam') . ' ' . $this->lang->line('type'); ?> </label><small class="req"> *</small>
                <select id="exam_type" name="exam_type" class="form-control">
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php foreach ($exam_type as $typ) { ?>
                <option value="<?php echo $typ['exam_type_id'] ?>"
                <?php echo ($get_attempts_id['ex_exam_type'] == $typ['exam_type_id']) ? "selected=selected" : ""; ?>>
                <?php echo $typ['exam_type_name']; ?>
                </option>
                <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('examtype'); ?></span>
                </div>
                
                
                
                <!--<div class="form-group" id="sub_type_container" style="display: none;">-->
                <!--<label for="exam_sub_type"><?php echo $this->lang->line('exam') . ' ' . $this->lang->line('type'); ?> </label><small class="req"> *</small>-->
                <!--<select id="exam_sub_type" name="exam_sub_type" class="form-control" disabled>-->
                <!--<option value=""><?php echo $this->lang->line('select'); ?></option>-->
                <!--<option value="1"><?php echo $this->lang->line('TE'); ?></option>-->
                <!--<option value="2"><?php echo $this->lang->line('CE'); ?></option>-->
                <!--</select>-->
                <!--</div>-->
                
                
                <div class="form-group" id="sub_type_container" style="display: none;">
    <label for="exam_sub_type"><?php echo $this->lang->line('exam') . ' ' . $this->lang->line('type'); ?> </label><small class="req"> *</small>
    <select id="exam_sub_type" name="exam_sub_type" class="form-control" disabled>
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        <option value="1" <?php echo ($get_attempts_id['ex_exam_sub_type'] == '1') ? 'selected' : ''; ?>>
            <?php echo $this->lang->line('TE'); ?>
        </option>
        <option value="2" <?php echo ($get_attempts_id['ex_exam_sub_type'] == '2') ? 'selected' : ''; ?>>
            <?php echo $this->lang->line('CE'); ?>
        </option>
    </select>
</div>

                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  $this->lang->line('no').'&nbsp;'.$this->lang->line('attempts'); ?> </label><small class="req"> *</small>
                <input autofocus="" id="attempts" name="attempts" placeholder="" type="number" class="form-control"  value="<?php echo $get_attempts_id['ex_no_of_attempts']; ?>" />
                <span class="text-danger"><?php echo form_error('attempts'); ?></span>
                </div> 
                
                
                
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?> </label><small class="req"> *</small>
                <textarea name="description" placeholder="" class="form-control ckeditor">
                <?php echo $get_attempts_id['ex_description']; ?>    
                    
                </textarea>
                <span class="text-danger"><?php echo form_error('description'); ?></span>
                </div>
                
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                </div>
                </form>
                
                
                </div>  
                </div>   
                
                <div class="col-md-<?php
                if ($this->rbac->hasPrivilege('section', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">             
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><?php echo $this->lang->line(''); ?></h3>
                </div>
                <div class="box-body ">
                <div class="table-responsive mailbox-messages">
                <div class="download_label"><?php echo $this->lang->line(''); ?></div>
                <table class="table table-striped table-bordered table-hover example">
                <thead>
                <tr>
                <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></th>
                <th><?php echo $this->lang->line('exam'); ?></th>   
                <th><?php echo $this->lang->line('session'); ?></th>  
                <th><?php echo $this->lang->line('class'); ?></th>
                <th><?php echo $this->lang->line('section'); ?></th>
                <th><?php echo $this->lang->line('attempt'); ?></th>
                <th><?php echo $this->lang->line('status'); ?></th>
                <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>                                   
                
                <?php
                $count = 1;
                foreach ($get_attempts as $attempts) {
                ?>
                <tr>
                <td class="mailbox-name"> <?php echo $attempts['examgroup'] ?></td>
                <td class="mailbox-name"> <?php echo $attempts['exam'] ?></td>
                <td class="mailbox-name"> <?php echo $attempts['session'] ?></td>
                <td class="mailbox-name"> <?php echo $attempts['class'] ?></td>
                <td class="mailbox-name"> <?php echo $attempts['section'] ?></td>
                <td class="mailbox-name"> <?php echo $attempts['ex_no_of_attempts'] ?></td> 
                
                <td class="mailbox-name"> 
                <?php
                if($attempts['ex_status']=='1') 
                {
                $status="Active";
                $btn="btn btn-success";
                }
                else
                {
                $status="Inactive";
                $btn="btn btn-warning";   
                }       
                ?>
                <button class="<?php echo $btn; ?>" type="button" ><?php   echo $status; ?></button>
                </td>
                
                
                <td class="mailbox-date pull-right">                                              
                
                <a data-placement="left" href="<?php echo base_url(); ?>admin/attempts/edit_attempt/<?php echo $attempts['ex_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                <i class="fa fa-pencil"></i>
                </a>
                
                <a data-placement="left" href="<?php echo base_url(); ?>admin/attempts/delete_attempt/<?php echo $attempts['ex_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                <i class="fa fa-remove"></i>
                </a>                                               
                </td>
                
                
                
                </tr>
                <?php
                }
                $count++;
                ?>
                </tbody>
                </table>
                </div>
                </div>
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
                var exam_type = '<?php echo $get_attempts_id['ex_exam_type']; ?>';
                
               
                $('#exam_type').on('change', function () {
                if ($(this).val() == '2') {
                $('#sub_type_container').show();
                $('#exam_sub_type').prop('disabled', false);
                } else {
                $('#sub_type_container').hide();
                $('#exam_sub_type').prop('disabled', true).val('');
                }
                });
                
                // On page load
                if (exam_type == '2') {
                $('#sub_type_container').show();
                $('#exam_sub_type').prop('disabled', false);
                } else {
                $('#sub_type_container').hide();
                $('#exam_sub_type').prop('disabled', true).val('');
                }
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
                
              var exam_group_id = '<?php echo set_value('exam_group_id', $get_attempts_id['ex_exam_group']); ?>';
              var exam_id = '<?php echo set_value('exam_id', $get_attempts_id['ex_exam']); ?>';
              
              
              
              
            

              
              
                // $(document).ready(function () {
                // $('#exam_type').on('change', function () {
                // if ($(this).val() == '2') {
                // $('#sub_type_container').show();
                // $('#exam_sub_type').prop('disabled', false);
                // } else {
                // $('#sub_type_container').hide();
                // $('#exam_sub_type').prop('disabled', true).val('');
                // }
                // });
                
                // // Optional: Handle reload with previous value
                // if ($('#exam_type').val() == '2') {
                // $('#sub_type_container').show();
                // $('#exam_sub_type').prop('disabled', false);
                // }
                // });
                
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
                
                
                // function getExamByExamgroup(exam_group_id, exam_id) {
                
                // if (exam_group_id !== "") {
                // $('#exam_id').html("");
                // var base_url = '<?php echo base_url() ?>';
                // var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                
                
                // $.ajax({
                // type: "POST",
                // url: base_url + "admin/examgroup/getExamByExamgroup",
                // data: {'exam_group_id': exam_group_id},
                // dataType: "json",
                // beforeSend: function () {
                // $('#exam_id').addClass('dropdownloading');
                // },
                // success: function (data) {
                // $.each(data, function (i, obj)
                // {
                // var sel = "";
                // if (exam_id === obj.id) {
                // sel = "selected";
                // }
                // div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
                // });
                
                // $('#exam_id').append(div_data);
                // $('#exam_id').trigger('change');
                // },
                // complete: function () {
                // $('#exam_id').removeClass('dropdownloading');
                // }
                // });
                // }
                // }
                
                
                function getExamByExamgroup(exam_group_id, selected_exam_id) {
    if (exam_group_id !== "") {
        $.ajax({
            type: "POST",
            url: base_url + "admin/examgroup/getExamByExamgroup",
            data: {'exam_group_id': exam_group_id},
            dataType: "json",
            success: function (data) {
                var options = '<option value=""><?php echo $this->lang->line("select"); ?></option>';
                $.each(data, function (i, obj) {
                    var selected = (obj.id == selected_exam_id) ? "selected" : "";
                    options += "<option value='" + obj.id + "' " + selected + ">" + obj.name + "</option>";
                });
                $('#exam_id').html(options);
            }
        });
    } else {
        $('#exam_id').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
    }
                }
                
               
                
                
                
         
            
             </script>
                
               