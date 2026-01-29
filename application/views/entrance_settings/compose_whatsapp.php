            <?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            
            <section class="content-header">
            <h1>
            <i class="fa fa-credit-card"></i> <?php echo $this->lang->line('template'); ?> </h1>
            </section>
            
         
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            
            <section class="contesnt">
            
            <div class="row">
            <div class="col-md-12">
            <div class="nav-tabs-custom theme-shadow">
            <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab_group" data-toggle="tab"><?php echo $this->lang->line('group').'&nbsp;&nbsp;'.$this->lang->line('message'); ?></a></li>
            <li class="pull-left header"><?php echo $this->lang->line('send') . " " . $this->lang->line('WhatsApp') ?></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="tab_group">
            
            
            
            <form action="<?php echo site_url('entrance_settings/mailsms/send_group_whatsapp') ?>" method="post" id="group_form">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
            
                        <div class="form-group">
                            <label><?php echo $this->lang->line('title'); ?></label> <small class="req">*</small>
                            <input autofocus="" class="form-control" name="group_title">
                        </div>
            
            
                        <div class="form-group">
                           <label class="pr20"><?php echo $this->lang->line('send_through'); ?><small class="req"> *</small></label>
            
                             <label class="checkbox-inline">
                                <input type="checkbox" value="push_whatsapp" name="group_send_by[]"><?php echo $this->lang->line('WhatsApp'); ?>
                            </label>
                            <span class="text-danger"><?php echo form_error('message'); ?></span>
                        </div>
            
            
                        <div class="form-group">
                            <!--<label><?php echo $this->lang->line('template_id'); ?>  </label> (<?php echo $this->lang->line('this_field_is_reqiured_only_for_indian_sms_gateway');?>) -->
                            <input type="hidden" name="group_template_id" id="group_template_id" class="form-control" autocomplete="off" value="Group Message">
                        </div>
                        
                        
                        <div class="form-group">
                            <label><?php echo $this->lang->line('message'); ?></label><small class="req"> *</small>
                            <textarea id="group_msg_text" name="group_message" class="form-control compose-textarea" rows="12"><?php echo set_value('message'); ?></textarea>
                            <span class="text-muted tot_count_group_msg_text pull-right word_counter"><?php echo $this->lang->line('character') . " " . $this->lang->line('count') ?>: 0</span>
                        </div>
            
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('message_to'); ?></label><small class="req"> *</small>
                            <div class="well minheight303">
                                <div class="checkbox mt0">
                                    <label><input type="checkbox" name="user[]" value="student"> <b><?php echo $this->lang->line('students'); ?></b> </label>
                                </div>
                                
                                
                                    <div class="checkbox">
                                    <label><input type="checkbox" name="user[]" value="parent"> <b><?php echo $this->lang->line('guardians'); ?></b></label>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary submit_group" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Sending" ><i class="fa fa-envelope-o"></i> <?php echo $this->lang->line('send'); ?></button>
            
                </div>
            
            </div>
            <!-- /.box-footer -->
            </form>
            </div>
            
            
            </div>
            </div>
            </div>
            </div>
            </section> 
            
            </div>
            
            
            
            
            
            
            </div>
            
            </section>
            </div>
            
            <script>
            $(document).on('click', '.dropdown-menu li', function () 
            {
            $("#suggesstion-box ul").empty();
            $("#suggesstion-box").hide();
            });
            $(document).ready(function (e) {
            $(document).on('click', '.bs-dropdown-to-select-group .dropdown-menu li', function (event) {
            var $target = $(event.currentTarget);
            $target.closest('.bs-dropdown-to-select-group')
            .find('[data-bind="bs-drp-sel-value"]').val($target.attr('data-value'))
            .end()
            .children('.dropdown-toggle').dropdown('toggle');
            $target.closest('.bs-dropdown-to-select-group')
            .find('[data-bind="bs-drp-sel-label"]').text($target.context.textContent);
            return false;
            });
            
            });
            </script>
            
            <script type="text/javascript">
            var attr = {};
            
            $(document).ready(function () 
            {
            $("#search-query").keyup(function ()
            {
            
            $("#search-query").attr('data-record', "");
            $("#search-query").attr('data-email', "");
            $("#search-query").attr('data-mobileno', "");
            $("#suggesstion-box").hide();
            var category_selected = $("input[name='selected_value']").val();
            $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/mailsms/entrancesearch') ?>",
            data: {'keyword': $(this).val(), 'category': category_selected},
            dataType: 'JSON',
            beforeSend: function () {
            $("#search-query").css("background", "#FFF url(../../backend/images/loading.gif) no-repeat 165px");
            },
            success: function (data) {
            if (data.length > 0) {
            setTimeout(function () {
            $("#suggesstion-box").show();
            var cList = $('<ul/>').addClass('selector-list');
            $.each(data, function (i, obj)
            {
            if (category_selected == "student") 
            {
                console.log(obj);
                
            
                var email = obj.entrance_reg_email;
                var contact = obj.entrance_reg_phone;
                var name = obj.entrance_reg_name";
            } 
            
            else if (category_selected == "parent") {
                if (obj.parent_app_key == null) {
                    obj.app_key = "";
                }
                var app_key = obj.parent_app_key;
                var email = obj.guardian_email;
                var contact = obj.guardian_phone;
                var name = obj.guardian_name;
            }
            
            var li = $('<li/>')
                    .addClass('ui-menu-item')
                    .attr('category', category_selected)
                    .attr('record_id', obj.id)
                    .attr('email', email)
                    .attr('mobileno', contact)
                    .attr('app_key', app_key)
                    .text(name);
            
            if (category_selected == "student_guardian") {
                li.attr('data-guardian-email', guardian_email);
            }
            li.appendTo(cList);
            });
            $("#suggesstion-box").html(cList);
            
            
            $("#search-query").css("background", "#FFF");
            
            }
            , 1000);
            } else {
            $("#suggesstion-box").hide();
            $("#search-query").css("background", "#FFF");
            }
            
            }
            });
            });
            });
            
            
            $(document).on('click', '.selector-list li', function () {
            var val = $(this).text();
            var record_id = $(this).attr('record_id');
            var email = $(this).attr('email');
            var mobileno = $(this).attr('mobileno');
            var app_key = $(this).attr('app_key');
            
            
            $("#search-query").attr('value', val).val(val);
            $("#search-query").attr('data-record', record_id);
            $("#search-query").attr('data-email', email);
            if ($(this).data('guardianEmail') != undefined) {
            $("#search-query").attr('data-guardian-email', $(this).data('guardianEmail'));
            
            }
            $("#search-query").attr('data-mobileno', mobileno);
            $("#search-query").attr('data-app_key', app_key);
            $("#suggesstion-box").hide();
            });
            
            
            $(document).on('click', '.add-btn', function () {
            
            var guardianEmail = "";
            var value = $("#search-query").val();
            if ($.trim(value) != "") {
            var record_id = $("#search-query").attr('data-record');
            var app_key = $("#search-query").attr('data-app_key');
            
            var email = $("#search-query").attr('data-email');
            var mobileno = $("#search-query").attr('data-mobileno');
            if ($("#search-query").data('guardianEmail') != undefined) {
            var guardianEmail = $("#search-query").data('guardianEmail');
            
            }
            
            var category_selected = $("input[name='selected_value']").val();
            if (record_id != "" || category_selected != "") {
            var chkexists = checkRecordExists(category_selected + "-" + record_id);
            if (chkexists) {
            var arr = [];
            arr.push({
            'category': category_selected,
            'record_id': record_id,
            'email': email,
            'guardianEmail': guardianEmail,
            'mobileno': mobileno,
            'app_key': app_key
            });
            
            attr[category_selected + "-" + record_id] = arr;
            $("#search-query").attr('value', "").val("");
            $("#search-query").attr('data-record', "");
            $(".send_list").append('<li class="list-group-item" id="' + category_selected + '-' + record_id + '"><i class="fa fa-user"></i> ' + value + ' (' + category_selected.charAt(0).toUpperCase() + category_selected.slice(1).toLowerCase() + ') <i class="fa fa-trash pull-right text-danger" onclick="delete_record(' + "'" + category_selected + '-' + record_id + "'" + ')"></i></li>');
            } else {
            errorMsg("Record already exists");
            }
            } else {
            errorMsg("Incorrect record");
            }
            } else {
            errorMsg("<?php echo $this->lang->line('please_select_record'); ?>");
            }
            
            getTotalRecord();
            });
            </script>
            
            
            
            <script type="text/javascript">
            function getTotalRecord() {
            
            $.each(attr, function (key, value) {
            //  console.log(value);
            
            });
            }
            function checkRecordExists(find) {
            
            if (find in attr) {
            return false;
            }
            return true;
            }
            
            $(function () {
            
            
            $('[name="SearchDualList"]').keyup(function (e) {
            var code = e.keyCode || e.which;
            if (code == '9')
            return;
            if (code == '27')
            $(this).val(null);
            var $rows = $(this).closest('.dual-list').find('.list-group li');
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
            }).hide();
            });
            
            });
            function delete_record(record) {
            delete attr[record];
            $('#' + record).remove();
            getTotalRecord();
            return false;
            
            };
            
            
            $("#individual_form").submit(function (event) 
            {
            
            
            event.preventDefault();
            var formData = new FormData();
            var other_data = $(this).serializeArray();
            
            $.each(other_data, function (key, input) {
            formData.append(input.name, input.value);
            });
            
            var objArr = [];
            var user_list = (!jQuery.isEmptyObject(attr)) ? JSON.stringify(attr) : "";
            
            formData.append('user_list', user_list);
            
            var $form = $(this),
            url = $form.attr('action');
            
            var $this = $('.submit_individual');
            $this.button('loading');
            $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            async: false,
            success: function (data)
            { 
            
            if (data.status == 1) 
            {
            var message = "";
            $.each(data.msg, function (index, value) 
            {       
            
            message += value;
            
            });
            errorMsg(message);
            } 
            else
            {
            
            $('#individual_form')[0].reset();
            
            $("ul.send_list").empty();
            attr = {};
            successMsg(data.msg);
            
            }
            },
            error: function (jqXHR, textStatus, errorThrown) 
            {
            
            }, complete: function (data) {
            $this.button('reset');
            }
            })
            });
            
            
            
            
            $("#birthday_form").submit(function (event) 
            {
            var user_list = [];
            $.each($("input[name='user[]']:checked"), function () {
            
            user_list.push($(this).attr("app-key"));
            });
            event.preventDefault();
            var formData = new FormData();
            var other_data = $(this).serializeArray();
            $.each(other_data, function (key, input) {
            if (input.value != "") {
            
            formData.append(input.name, input.value);
            } else {
            formData.append(input.name, 0);
            
            }
            });
            $.each(user_list, function (index, value) {
            formData.append('app-key[]', value);
            });
            
            
            
            
            var $form = $(this),
            url = $form.attr('action');
            var $this = $('.submit_birthday');
            $this.button('loading');
            
            
            $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            
            beforeSend: function () {
            $this.button('loading');
            
            },
            success: function (data) {
            if (data.status == 1) {
            var message = "";
            $.each(data.msg, function (index, value) {
            
            
            
            message += value;
            });
            errorMsg(message);
            } else {
            $('#birthday_form')[0].reset();
            
            successMsg(data.msg);
            }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            
            }, complete: function (data) {
            $this.button('reset');
            }
            })
            
            });
            
            
            
            
            $("#group_form").submit(function (event) {
            
            
            event.preventDefault();
            // var logoImg = $('input[name="group_attachment"]').get(0).files[0];
            var formData = new FormData();
            var other_data = $(this).serializeArray();
            $.each(other_data, function (key, input) {
            formData.append(input.name, input.value);
            });
            
            
            var $form = $(this),
            url = $form.attr('action');
            var $this = $('.submit_group');
            $this.button('loading');
            
            
            $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            async: false,
            success: function (data) {
            if (data.status == 1) {
            var message = "";
            $.each(data.msg, function (index, value) 
            {
            
            
            message += value;
            });
            errorMsg(message);
            } else {
            $('#group_form')[0].reset();
            
            successMsg(data.msg);
            }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            
            }, complete: function (data) {
            $this.button('reset');
            }
            })
            
            });
            
            
            $(document).on('change', '#class_id', function (e) {
            $('.section_list').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var url = "<?php
                                $userdata = $this->customlib->getUserData();
                                if (($userdata["role_id"] == 2)) {
                                    echo "getClassTeacherSection";
                                } else {
                                    echo "getByClass";
                                }
                                ?>";
            var div_data = '';
            $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
            $.each(data, function (i, obj)
            {
            div_data += '<li class="checkbox"><a href="#" class="small"><label><input type="checkbox" name="user[]" value ="' + obj.section_id + '"/>' + obj.section + '</label></a></li>';
            
            
            });
            $('.section_list').append(div_data);
            }
            });
            });
            
            $("#class_form").submit(function (event) {
            event.preventDefault();
            
            var formData = new FormData();
            var other_data = $(this).serializeArray();
            $.each(other_data, function (key, input) {
            formData.append(input.name, input.value);
            });
            
            var $form = $(this),
            url = $form.attr('action');
            var $this = $('.submit_class');
            $this.button('loading');
            
            $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            async: false,
            success: function (data) {
            if (data.status == 1) {
            var message = "";
            $.each(data.msg, function (index, value) {
            
            message += value;
            });
            errorMsg(message);
            } else {
            $('#class_form')[0].reset();
            $('.section_list').html("");
            successMsg(data.msg);
            }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            
            }, complete: function (data) {
            $this.button('reset');
            }
            });
            
            });
            
            
            $(document).on('keypress keyup keydown paste change focus blur', '.compose-textarea', function (event) {
            
            var total_length = checkTextAreaMaxLength(this, event);
            $(this).next('span.word_counter').html("<?php echo $this->lang->line('character') . " " . $this->lang->line('count') ?>: " + total_length)
            
            
            });
            function checkTextAreaMaxLength(textBox, e) {
            return textBox.value.length;
            }
            </script>
            
