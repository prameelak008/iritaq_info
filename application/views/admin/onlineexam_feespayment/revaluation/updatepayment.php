            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            
            $result    = $this->customlib->getUserData();
            $role      = $result["user_type"];
            ?>    
            <div class="content-wrapper">
            
            <section class="content-header">
            <h1><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('payment'); ?></h1>
            </section>
            
            <section class="content">
            <div class="row">
            
            
            
            
            
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary" id="hroom">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><?php echo 'Transaction'.''.$this->lang->line('payment'); ?> </h3>
            </div><!-- /.box-header -->
            
            <div class="box-body">
                
                
            <form role="form" action="<?php echo site_url('admin/Onlineexampayment_revaluation/checkpayment') ?>" method="post" class="row">
            
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="col-sm-6 col-lg-4 col-md-4">
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
            </div><!--./col-md-3-->
            <div class="col-sm-6 col-lg-4 col-md-4">
            <div class="form-group">   
            <label><?php echo $this->lang->line('exam'); ?></label><small class="req"> *</small>
            <select  id="exam_id" name="exam_id" class="form-control select2" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>  
            </div><!--./col-md-3-->
            
            
            <div class="col-sm-6 col-lg-4 col-md-4">
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
            
            <div class="col-sm-6 col-lg-4 col-md-4">
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
            
            <div class="col-sm-6 col-lg-4 col-md-4">
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
            </form>
            </div>
            
            <?php
            if (!empty($online_examlist)) 
            {
            ?>
            <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <div class="download_label"> <?php echo $this->lang->line('online_examination'); ?> <?php echo $this->lang->line('list'); ?></div>
            
            <input type="hidden" name="post_exam_id" value="<?php echo $exam_id; ?>">
            <input type="hidden" name="post_exam_group_id" value="<?php echo $exam_group_id; ?>">
            <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">
            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
            <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
            
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <th>Sl.No</th>
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('roll_no'); ?></th>
            <th><?php echo $this->lang->line('student_name'); ?></th>
            <th><?php echo $this->lang->line('father_name'); ?></th>
            
            <th class=""><?php echo $this->lang->line('mobile_no'); ?></th>
            
            <th class=""><?php echo $this->lang->line('transaction'); ?></th>
            <th class=""><?php echo $this->lang->line('payment'); ?></th>
            </tr>
            
            </thead>
            <tbody>
            
            <?php
            $sl=1;
            
            foreach($online_examlist as $online)
            {
            ?>
                
            <tr>
            <td class="text-center"><?php echo $sl; ?></td>
            <td><?php   echo   $online['admission_no']; ?></td>
            <td><?php   echo   $online['roll_no']; ?></td>
            <td><?php   echo   $online['firstname'].''.$online['middlename'].''.$online['lastname']; ?></td>
            <td><?php   echo   $online['father_name']; ?>
            <input type="hidden" name="studid" id="studid<?php echo $sl; ?>" value="<?php echo $online['exam_group_exam_revaluation_student_studentid'];?>">
            <input type="hidden" name="group" id="group<?php echo $sl; ?>" value="<?php echo  $online['exam_group_exam_revaluation_examid']; ?>">
            <input type="hidden" name="exambatchid" id="exambatchid<?php echo $sl; ?>" value="<?php echo $online['exam_group_exam_revaluation_examgroupid']; ?>">
            </td>
            
            <td><?php  echo  $online['mobileno']; ?></td>
            <td>
              
                <?php
                foreach($feelist as $fee)
                {
                if($fee['fees_revaluationpayment_student_id']==$online['exam_group_exam_revaluation_student_studentid']
                && $fee['fees_revaluationpayment_examgroup']==$online['exam_group_exam_revaluation_examid'] 
                && $fee['fees_revaluationpayment_examgroupbatch']==$online['exam_group_exam_revaluation_examgroupid'] 
                && $fee['fees_revaluationpayment_session_id']==$online['exam_group_exam_revaluation_session_id'] )
                {
                echo  'Order Id'.'&nbsp;&nbsp;:'. 	$fee['fees_revaluationpayment_orderid'];
                echo "<br>";
                echo  'Transaction No'.'&nbsp;&nbsp; :'. 	$fee['fees_revaluationpayment_transaction_no'];
                
                echo "<br>";
                echo  'Transaction Date'.'&nbsp;&nbsp; :'. 	$fee['fees_revaluationpayment_transdate'];
                
                echo "<br>";
                echo  'Amount'.'&nbsp;&nbsp; :'. 	$fee['fees_revaluationpayment_amount'];
                
                echo "<br>";
                echo  'Year'.'&nbsp;&nbsp;:'. 	$fee['fees_revaluationpayment_year'];
                
                echo "<br>";
                
                
                echo  'Notes'.'&nbsp;&nbsp;:'. 	$fee['fees_revaluationpayment_notes'];
                echo "<br>";
                
                if($fee['fees_revaluationpayment_statuscode'] == 'S') 
                {
                $status = '<span style="font-size:18px;">Success <i class="fa fa-check-circle" style="color:green;"></i></span>';
                } 
                else if($fee['fees_revaluationpayment_statuscode'] == 'F') 
                {
                $status = '<span style="font-size:18px;">Failed <i class="fa fa-times-circle" style="color:red;"></i></span>';
                }
                echo 'Status&nbsp;&nbsp;: ' . $status;
                ?>
                
                
                <button type="button" title="delete"  onClick="return ConfirmDelete(this)" class="fa fa-trash" style="color:red" data-id="<?php echo $fee['fees_revaluationpayment_id']; ?>"></button>
                
                <?php
                echo  "<br>";
                echo  "<br>";
                echo  "<br>";
                }
                }
                ?>
                </td>
                                        <td>
                                        
                                        <form id="form" action="<?php echo site_url('admin/onlineexampayment_revaluation/updatefees'); ?>" method="post"  enctype="multipart/form-data">
                                        
                                        Order Id :<input type="text" class="form-control" name="orderid" id="orderid" placeholder="Enter Order Id" />
                                        <br>
                                        
                                        Transaction No :<input type="text" class="form-control" name="transaction" id="transaction" placeholder="Enter Transaction No" /> 
                                        <br>
                                        
                                        Amount :
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" />
                                        
                                        <br>
                                        Notes :
                                        <textarea class="form-control" name="notes" id="notes" rows="2" placeholder="Provide a brief reason or comment..."></textarea>

                                        
                                        <br>
                                        Transaction Date(Format:2023-03-28 15:52:09) :
                                        
                                        <input type="text" class="form-control" name="transactiondate" id="transactiondate" placeholder="2023-03-28 15:52:09" />
                                        
                                        <input type="hidden" class="form-control" name="student_id" id="student_id" value="<?php echo $online['exam_group_exam_revaluation_student_studentid']; ?>" />
                                        <input type="hidden" class="form-control" name="examgroup" id="examgroup" value="<?php echo $online['exam_group_exam_revaluation_examgroupid']; ?>" /> 
                                        
                                        <input type="hidden" class="form-control" name="exam"  id="exam" value="<?php echo $online['exam_group_exam_revaluation_examid']; ?>" />
                                        <input type="hidden" class="form-control" name="session_id" id="session_id" value="<?php echo $online['exam_group_exam_revaluation_session_id']; ?>" /> 
                                        
                                        <input type="hidden" class="form-control" name="class_id"  id="class_id"   value="<?php echo $class_id; ?>" /> 
                                        <input type="hidden" class="form-control" name="section_id" id="section_id" value="<?php echo $section_id; ?>" /> 
                                        <br>
                                        
                                        <button type="submit"  name="submit"  class="btn btn-success">PAYMENT</button>
                                        </form>
                    
            </td>
            <?php  $sl++; } ?>
            </tr>
            </tbody>
            <?php
            }
            
            ?>
            </table>
            
            
            </div>
            <!-- /.table -->
            </div><!-- /.mail-box-messages -->
            </div><!-- /.box-body -->
            </form>
            
            
            </div>
            </div><!--/.col (left) -->
            <!-- right column -->
            </div>
            <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
            </div>   <!-- /.row -->
            </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!-- Modal -->
            
            
            <script type="text/javascript">
            $(document).ready(function () {
            $('.select2').select2();
            
            });
            var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
            var class_id = '<?php echo set_value('class_id') ?>';
            var section_id = '<?php echo set_value('section_id') ?>';
            var session_id = '<?php echo set_value('session_id') ?>';
            var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
            var exam_id = '<?php echo set_value('exam_id') ?>';
            
            getSectionByClass(class_id, section_id);
            
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
            
            function getSectionByClass(class_id, section_id)
            {
            if (class_id != "") {
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
            
            function getExamByExamgroup(exam_group_id, exam_id) {
            
            if (exam_group_id !== "") 
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
      
                
            $(document).ready(function(){
            $("#form").submit(function(event)
            {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
            url: '<?php echo site_url('admin/Onlineexampayment_revaluation/updatefees'); ?>',
            type: 'POST',
            data: formData,
            async: false,
            success: function(data) 
            {
            if (data) 
            {
            alert("INSERTED SUCCESSFULLY");
            }
            else
            {
            alert("SOMETHING GONE WRONG");
            }
                
            location.reload(true);
            },
            cache: false,
            contentType: false,
            processData: false
            });
            });
            });
            
            
            function ConfirmDelete(obj) 
            { 
            var x = confirm("Are you sure you want to delete?"); 
            if (x == true) 
            {
            var id = $(obj).data('id');
            if (id != '')
            {
            $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/Onlineexampayment_revaluation/deletefees'); ?>",
            cache: false,
            data: {'id': id},
            success: function (data) 
            {
            if (data) 
            {
            alert("Deleted Successfully");
            }
            else
            {
            alert("ERROR");
            }
            location.reload(true);
            return false;
            }
            });
            }
            }
            else
            {
            return false;
            }
            }
            
            </script>
