            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css"> 
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_style.css"> 



            <script>
            // To display same tab after form submit
            document.addEventListener("DOMContentLoaded", function() {
            const activeTab = localStorage.getItem('activeTab');
            if(activeTab !== null) {
            // show the saved tab
            switchTab(parseInt(activeTab));
            } else {
            // default to first tab
            switchTab(0);
            }
            });
            $(document).on('click', '.toggle-details', function(){
            var target = $(this).data('target');
            var $panel = $(target);
            var $icon = $(this).find('i');
            // close other open panels smoothly
            $('.details-row').not($panel).stop(true, true).slideUp(400, 'swing');
            $('.toggle-details i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            if($panel.is(':visible')){
            $panel.stop(true, true).slideUp(400, 'swing');
            $icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            } else {
            $panel.stop(true, true).slideDown(400, 'swing');
            $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
            });
            </script>

            <div class="content-wrapper"> 
            <section class="content-header">
            <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('fee_charge'); ?></h1>
            </section>          

            <!-- Main content -->
            <section class="content">
            <div class="col-md-12">
            <?php
            $this->load->view('layout/topbar_exam'); ?>
            </div>
            &nbsp;

            <div class="row">

            <div class="">
            <!-- <h1 class="page-title">🎓 Online Examination Management</h1> -->
            <div class="tabs-container">
            <div class="tabs-header">
            <button class="tab-button active" onclick="switchTab(0)">
            <span class="tab-icon">📋</span>
            <span><?php echo $this->lang->line('exam_instructions'); ?></span>
            </button>


            <button class="tab-button" onclick="switchTab(1)">
            <span class="tab-icon">💰</span>
            <span><?php echo $this->lang->line('fees_&_payment'); ?></span>
            </button>          


            <button class="tab-button" onclick="switchTab(2)">
            <span class="tab-icon">📝</span>
            <span><?php echo $this->lang->line('subject_charge') ; ?></span>
            </button>


            <button class="tab-button" onclick="switchTab(3)">
            <span class="tab-icon">📝</span>
            <span><?php echo $this->lang->line('details') ; ?></span>
            </button>

            <button class="tab-button" onclick="switchTab(4)">
            <span class="tab-icon">📝</span>
            <span><?php echo $this->lang->line('attempt') ; ?></span>
            </button>




            <!-- <button class="tab-button" onclick="switchTab(3)">
            <span class="tab-icon">💰</span>
            <span>Subject Fees</span>
            </button> -->


            </div>



            <form id="examForm" method="POST" action="<?php echo site_url('semester_exam/exam_instruction/') ?>">
            <!-- Tab 1: Exam Instructions -->
            <div class="tab-content active">
            <div class="form-section">

            <div class="section-title">
            <span>🎯</span> Basic Information
            </div>

            <div class="form-row">

            <div class="form-group">
            <label>Exam Group <span class="required">*</span></label>
            <select  id="exam_group_id" name="exam_group_id" class="form-control" >

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


            <div class="form-group">
            <label><?php echo $this->lang->line('exam'); ?> <span class="required">*</span></label>
            <select  id="exam_id" name="exam_id" class="form-control"   >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            </div>           



            <div class="form-group">
            <label><?php echo $this->lang->line('exam').'&nbsp;'.$this->lang->line('option'); ?> <span class="required">*</span></label>
            <select id="exam_option" name="exam_option" class="form-control">
            <option value="">Select Exam</option>
            <?php foreach ($exam_options as $key => $value) { ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
            </select>
            </div>


            <div class="form-group">
            <label>Exam Type <span class="required">*</span></label>
            <select id="exam_type" name="exam_type" class="form-control">
            <option value="">Select Type</option>
            <?php foreach ($getExamType as $key => $value) { ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
            </select>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group full-width">
            <label>Exam Title <span class="required">*</span></label>
            <input type="text" id="exam_title" name="exam_title" placeholder="Enter Examination Title" >
            </div>
            </div>

            </div>

            <div class="form-section">
            <div class="section-title">
            <span>📅</span> Important Dates
            </div>
            <div class="form-row">
            <div class="form-group">
            <label>Exam Commencement <span class="required">*</span></label>
            <input type="date" id="exam_start"  name="exam_start" >
            </div>

            <div class="form-group">
            <label>Last Date of Exam <span class="required">*</span></label>
            <input type="date" id="exam_end" name="exam_end"  >
            </div>

            <div class="form-group">
            <label>Publish Date <span class="required">*</span></label>
            <input type="date" id="publish_date" name="publish_date" >
            </div>
            </div>

            <div class="form-row">
            <div class="form-group">
            <label>Closing Date <span class="required">*</span></label>
            <input type="date" id="closing_date" name="closing_date" >
            </div>

            <div class="form-group">
            <label>Closing Time <span class="required">*</span></label>
            <input type="time" id="closing_time" name="closing_time" >
            </div>

            <div class="form-group">
            <label>Class Leave for Studying</label>
            <input type="text" id="class_leave" name="class_leave" placeholder="e.g., 3 days before exam">
            </div>
            </div>
            </div>


            <div class="form-section">
            <div class="section-title">
            <span>📅</span> Payment Information
            </div>

            <div class="form-row">
            <div class="form-group">
            <label>Mode of Payment <span class="required">*</span></label>
            <textarea id="payment_mode" name="payment_mode" placeholder="e.g., Online Payment, Bank Transfer, Cash at Counter" ></textarea>
            </div>


            <div class="form-group">
            <label>Fee Details & Instructions</label>
            <textarea id="fee_details" name="fee_details" placeholder="Enter detailed fee breakdown and instructions"></textarea>
            </div>                
            </div>


            <div class="form-row">
            <div class="form-group">
            <label>Without Fine Details</label>
            <textarea id="no_fine_details" name="no_fine_details" placeholder="Message to display before date"></textarea>
            </div> 


            <div class="form-group">
            <label>With Fine Details </label>
            <textarea id="fine_details" name="fine_details" placeholder="Message to display after date"></textarea>
            </div> 
            </div>
            </div> 



            <div class="form-section">

            <div class="section-title">
            <span>📢</span> Declarations & Messages
            </div>

            <div class="form-row">

            <div class="form-group">
            <label>Declaration <span class="required">*</span></label>
            <textarea id="declaration" name="declaration" placeholder="Enter declaration text that students must accept" ></textarea>
            </div>

            <div class="form-group">
            <label>Close Message</label>
            <textarea id="close_message" name="close_message" placeholder="Message to display after exam registration closes"></textarea>
            </div> 


            <div class="form-group">
            <label>Remarks After Payment</label>
            <textarea id="payment_remarks" name="payment_remarks" placeholder="Instructions/remarks to show after successful payment"></textarea>
            </div> 
            </div>
            </div>


            <div class="form-section">
            <div class="section-title">
            <span>⚙️</span> Settings
            </div>
            <div class="form-group">
            <label class="toggle-switch">
            <span>Active Status</span>
            <label class="switch">
            <input type="checkbox" id="active_status" name="active_status" checked>
            <span class="slider"></span>
            </label>
            </label>
            </div>
            </div>               

            <div class="btn-container">                
            <button type="submit" class="btn btn-primary" >Save & Update</button>
            <button type="button" class="btn btn-primary" onclick="switchTab(1)">Next: Fees & Payment →</button>
            </div>
            </div>
            </form> 


            <form id="feeform" method="POST" action="<?php echo site_url('semester_exam/exam_instruction/save_fees') ?>">
            <!-- Tab 2: Fees & Payment -->

            <div class="tab-content">
            <div class="info-card">
            <p><strong>💡 Note:</strong> Configure exam fees, processing charges, and late fine details. The total amount will be calculated automatically.</p>
            </div>


            <div class="form-section">
            <div class="section-title">
            <span>💵</span> Fee Structure
            </div>
            <div class="form-row">
            <div class="form-group">
            <label>Title <span class="required">*</span></label>
            <select id="fee_ex_type" name="fee_ex_type" >
            <option value="">Select Exam Type</option>
            <?php
            foreach($get_instruction as $instr)
            {
            ?>
            <option value="<?php echo $instr['sem_exam_id'];  ?>"><?php echo $instr['sem_exam_title'];  ?></option>
            <?php } ?>                   
            </select>
            </div>

            <div class="form-group">
            <label>Exam Fees <span class="required">*</span></label>
            <div class="currency-input">
            <input type="number" id="exam_fees"  name="exam_fees" placeholder="0.00" min="0" step="0.01" >
            </div>
            </div>

            <div class="form-group">
            <label>Processing Charge</label>
            <div class="currency-input">
            <input type="number" id="processing_charge" name="processing_charge" placeholder="0.00" min="0" step="0.01">
            </div>
            </div>
            </div>
            </div>

            <div class="form-section">
            <div class="section-title">
            <span>⏰</span> Late Fine Configuration
            </div>
            <div class="form-row">
            <div class="form-group">
            <label>Late Fine Amount</label>
            <div class="currency-input">
            <input type="number" id="fine_amount" name="fine_amount" placeholder="0.00" min="0" step="0.01">
            </div>
            </div>



            <div class="form-group">
            <label>Fine Effective Date</label>
            <input type="date" id="fine_effective_date" name="fine_effective_date">
            </div>
            </div>

            <div class="form-row">
            <div class="form-group">
            <label>Last Date (Without Fine) <span class="required">*</span></label>
            <input type="date" id="last_date_without_fine" name="last_date_without_fine" >
            </div>

            <div class="form-group">
            <label>Last Date (With Fine) <span class="required">*</span></label>
            <input type="date" id="last_date_with_fine" name="last_date_with_fine" >
            </div>
            </div>
            </div>



            <div class="form-section">
            <div class="section-title">
            <span>📊</span> Fee Summary
            </div>


            <div class="fee-summary-box">
            <div class="fee-summary-title">💰 Total Fee Breakdown</div>
            <div class="fee-row">
            <span>Exam Fees:</span>
            <span id="display_exam_fees">₹ 0.00</span>
            </div>

            <div class="fee-row">
            <span>Processing Charge:</span>
            <span id="display_processing">₹ 0.00</span>
            </div>

            <div class="fee-row">
            <span>Late Fine:</span>
            <span id="display_fine">₹ 0.00</span>
            </div>

            <div class="fee-row">
            <span>Total Amount:</span>
            <span id="display_total">₹ 0.00</span>
            </div>

            </div>
            </div>



            <div class="btn-container">
            <button type="submit" class="btn btn-secondary" >Save & Update</button>
            <button type="button" class="btn btn-secondary" onclick="switchTab(0)">← Previous</button>
            <button type="button" class="btn btn-primary" onclick="switchTab(2)">Next: Additional Details →</button>
            </div>
            </div>
            </form>



            <!-- Tab 3: Subject Charge -->
            <div class="tab-content">
            <div class="form-section"> 

            <div class="section-title">
            <span>💵</span> Exam Details
            </div>


            <form id="subjectform" method="POST" action="<?php echo site_url('semester_exam/exam_instruction') ?>">

            <div class="form-row">
            <div class="form-group">
            <label>Title <span class="required">*</span></label>
            <select id="fee_exam_type" name="fee_exam_type" >
            <option value="">Select Exam Type</option>
            <?php
            foreach($get_instruction as $instr)
            {
            ?>
            <option value="<?php echo $instr['sem_exam_id'];  ?>" <?php   if(set_value('fee_exam_type')== $instr['sem_exam_id'])  { echo  "selected=selected"; } ?>   ><?php echo $instr['sem_exam_title'];  ?></option>
            <?php } ?>                   
            </select>
            </div>


            <!-- <input type="hidden" name="sem_group_id" id="sem_group_id" class="form-control" value="<?php echo set_value('sem_group_id'); ?>" /> -->

<!--
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
            <select name="program_type" id="program_type" class="form-control" >
            <option value=""><?php echo $this->lang->line('type'); ?></option>
            <?php
            foreach($Programmetype_list as $prog_type)
            {
            ?>
            <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
            <?php 
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('program_type'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programe" id="programe" class="form-control">
            </select>            
            </div>



            <div class="form-group">
            <label><?php echo $this->lang->line('semester_type'); ?> <span class="required">*</span></label>
            <select name="semester_semtype" id="semester_semtype" class="form-control" >
            <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
            <?php
            foreach($semestertype_list as $sem_type)
            {
            ?>
            <option value="<?php  echo $sem_type['st_id'];  ?>"

            <?php
            if(set_value('semester_semtype')==$sem_type['st_id'])
            {
            echo "selected=selected";
            }
            ?>
            ><?php  echo $sem_type['st_name'];  ?></option>
            <?php } ?>
            </select>
            </div>



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_term'); ?></label>
            <select name="semester_term" id="semester_term" class="form-control" >
            <option value="">Select Semester</option>
            <?php     
            foreach($semester_term as $term)
            {
            ?>
            <option value="<?php echo  $term['stm_id']; ?>"<?php if(set_value('semester_term')==$term['stm_id']) { echo "selected=selected"; }        ?> ><?php echo  $term['stm_name']; ?> </option>
            <?php 
            }
            ?>
            </select> 
            </div>

            

            <div class="form-group">
            <label for="exampleInputEmail1">Batch Group</label>
            <select name="batch_group" id="batch_group" class="form-control" >
            <option value="">Select Batch</option>

            <?php
            foreach($batch_group as $batch)
            {
            ?>
            <option value="<?php echo  $batch['batch_group_id']; ?>"<?php if(set_value('batch_group')==$batch['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $batch['batch_group_name'].'&nbsp;&nbsp;'.$batch['batch_group_year']; ?> </option>
            <?php 
            }
            ?>
            </select> 
            </div>
            -->


            <div class="row">
                <div class="col-md-6">
                <div class="form-group">           
                <?= dropdownlist_program(
                $programs,              // Array of programs from DB
                set_value('prog_id'), 
                ); ?>
                <span class="text-danger"><?= form_error('prog_id'); ?></span>
                </div>  
                </div> 


                <div class="col-md-6">
                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_type" name="sem_type" class="form-control">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                <span class="text-danger"><?= form_error('sem_type'); ?></span>
                </div>
                </div>




            <div class="form-group">
            <label for="exampleInputEmail1">&nbsp;</label>
            <button type="submit" class="btn btn-secondary">💾 Search</button>                       
            </div>
            </div>                 
            </form>
            </div>






            <form id="subjectform" method="POST" action="<?php echo site_url('semester_exam/exam_instruction/save_subjectform') ?>">

            <input type="hidden" name="gt_sem_group" name="gt_sem_group" class="form-control" value="<?php echo $sem_group_id; ?>" />
            <input type="hidden" name="gt_sem_title" name="gt_sem_title" class="form-control" value="<?php echo $inst_title; ?>" />


            <div class="table-responsive mailbox-messages">
            <?php
            if(!empty($exam_subjects)) { 
            ?>

            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>           
            <th>S.No</th>
            <th>Subject Name</th>
            <th>Fees<input type="text" name="get_fees_charge" id="get_fees_charge" class="form-control" placeholder="Specify fee amount" /></th>            
            </tr>
            </thead>
            <tbody>
            <?php 

            $sno = 1;
            foreach($exam_subjects as $result) { 
            ?>
            <tr>            
            <td><?php echo $sno++; ?></td>
            <td><?php echo $result['subject_name']; ?></td>
            <td>

            <input type="hidden" name="subject_id[]" id="subject_id" value="<?php  echo $result['subjectid'] ?>" />          
            <input type="text" 
            name="fees_charge[]" 
            class="form-control fees_charge" 
            placeholder="Enter applicable fee" 
            value="<?php echo !empty($result['inst_fees_charge']) ? $result['inst_fees_charge'] : ''; ?>" />

            </td>
            </tr>
            <?php
            }


            /*
            } 
            } else { ?>
            <tr>
            <td colspan="10" class="no-results">
            <i>📋</i>
            No results found. Please try different search criteria.
            </td>
            </tr>
            <?php }  

            */
            ?>
            </tbody>
            </table> 
            </div>
            <div class="btn-container">
            <button type="button" class="btn btn-secondary" onclick="switchTab(1)">← Previous</button>
            <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset All</button>
            <button type="submit" class="btn btn-primary">💾 Save Fees</button>
            </div>
            <?php }  ?>
            </form>
            </div>
            </div>  




            <div class="tab-content">
            <div class="info-card">
            <p><strong> Note:</strong> 
            Review the exam fees and instructions listed below. 
            </p>
            </div>

            <div class="table-responsive mailbox-messages"> 
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>           
            <th>S.No</th>
            <th><?php echo $this->lang->line('title'); ?></th>
            <th><?php echo $this->lang->line('exam_group'); ?></th>
            <th>Last Date Of Exam</th>
            <th>Closing Date Of Exam</th>
            <th>Closing Time</th>

            <th class="text-center">Details</th>


            </tr>
            </thead>
            <tbody>


            <?php           
            $slno = 1;
            foreach($get_instructiondetails as $row) { 
            $detailsId = 'exam_details_'.$row['sem_exam_id'];
            ?>
            <tr>            
            <td><?php echo $slno++; ?></td>
            <td><?php echo $row['sem_exam_title']; ?></td>
            <td><?php echo $row['examgroupname']; ?></td>
            <td><?php echo $row['sem_exam_lasdate_of_exam']; ?></td>
            <td><?php echo $row['sem_exam_closingdate_of_exam']; ?></td>
            <td><?php echo $row['sem_exam_closetime']; ?></td>
            <td class="text-center">
            <button type="button" class="btn btn-info btn-xs toggle-details" data-target="#<?php echo $detailsId; ?>">
            <i class="fa fa-chevron-down"></i>
            </button>
            </td>
            </tr>




            <tr id="<?php echo $detailsId; ?>" class="details-row" style="display:none;">
            <td colspan="7">
            <div class="well" style="margin:0;">
            <div class="row">
            <div class="col-sm-6">
            <h5 style="margin-top:0;">General</h5>
            <p><strong>Publish date:</strong> <?php echo isset($row['sem_exam_publishdate']) ? $row['sem_exam_publishdate'] : '-'; ?></p>
            <p><strong>Closing date:</strong> <?php echo isset($row['sem_exam_closingdate_of_exam']) ? $row['sem_exam_closingdate_of_exam'] : '-'; ?></p>
            <p><strong>Closing time:</strong> <?php echo isset($row['sem_exam_closetime']) ? $row['sem_exam_closetime'] : '-'; ?></p>
            <p><strong>Mode of payment:</strong> <?php echo isset($row['sem_exam_mode_of_payment']) ? nl2br(htmlspecialchars($row['sem_exam_mode_of_payment'])) : '-'; ?></p>
            <p><strong>Fee details:</strong><br><?php echo isset($row['sem_exam_fee_details']) ? nl2br(htmlspecialchars($row['sem_exam_fee_details'])) : '-'; ?></p>
            <p><strong>Declaration:</strong><br><?php echo isset($row['sem_exam_declaration']) ? nl2br(htmlspecialchars($row['sem_exam_declaration'])) : '-'; ?></p>
            </div>
            <div class="col-sm-6">
            <h5 style="margin-top:0;">Fees</h5>
            <p><strong>Exam fees:</strong> <?php echo isset($row['sem_fees_fees_charge']) ? $row['sem_fees_fees_charge'] : '-'; ?></p>
            <p><strong>Processing charge:</strong> <?php echo isset($row['sem_fees_processing_charge']) ? $row['sem_fees_processing_charge'] : '-'; ?></p>
            <p><strong>Late fine:</strong> <?php echo isset($row['sem_fees_charge_fine']) ? $row['sem_fees_charge_fine'] : '-'; ?></p>
            <p><strong>Without fine till:</strong> <?php echo isset($row['last_date_without_fine']) ? $row['last_date_without_fine'] : (isset($row['sem_fees_without_fine_dt']) ? $row['sem_fees_without_fine_dt'] : '-'); ?></p>
            <p><strong>With fine till:</strong> <?php echo isset($row['sem_fees_with_fine_dt']) ? $row['sem_fees_with_fine_dt'] : '-'; ?></p>
            <p><strong>Fine effective from:</strong> <?php echo isset($row['sem_fees_charge_effectivedate']) ? $row['sem_fees_charge_effectivedate'] : '-'; ?></p>
            <?php 
            $total = 0;
            if (isset($row['sem_fees_fees_charge'])) $total += (float)$row['sem_fees_fees_charge'];
            if (isset($row['sem_fees_processing_charge'])) $total += (float)$row['sem_fees_processing_charge'];
            if (isset($row['sem_fees_charge_fine'])) $total += (float)$row['sem_fees_charge_fine'];
            ?>
            <p><strong>Total (if applicable):</strong> <?php echo $total > 0 ? number_format($total, 2) : '-'; ?></p>
            <p><strong>After payment remarks:</strong><br><?php echo isset($row['sem_exam_remarksafterpayment']) ? nl2br(htmlspecialchars($row['sem_exam_remarksafterpayment'])) : '-'; ?></p>
            </div>
            </div>
            </div>
            </td>
            </tr>
            <?php } ?>

            </tbody>
            </table>

            </div>         
            </div>  
            
            

            <!------------------------4 tab-------------------------------------------->

            <form id="feeform" method="POST" action="<?php echo site_url('semester_exam/exam_instruction/save_attempt') ?>">
            <!-- Tab 2: Fees & Payment -->

            <div class="tab-content">
            <div class="info-card">
            <p><strong>💡 Note:</strong> 
            

            📋 What This Controls:
            <br>
            Set the maximum number of times a student can apply/register for each exam type. For example:
            <br>
            Regular Exam: Usually unlimited (students can apply every time)<br>
            SAY Exam: Limited to 1 attempt only<br>
            Improvement: Limited to 1 attempt per subject<br>
            Revaluation: Limited to 1 attempt per subject<br>


            </p>
            </div>

            <div class="form-section">
            <div class="section-title">
            <span>💵</span>Attempts
            </div>



            <div class="form-row">                    
         
            <div class="form-group">
            <label>Program Type / Program <small class="req">*</small></label> 
            <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
            <span class="text-danger"><?php echo form_error('program'); ?></span>
            </div> 

        
            <div class="form-group">
            <label>Semester / Batch / Term <small class="req">*</small></label>      
            <?php
            echo render_semester_dropdown($semesters_batches, set_value('semester'));
            ?>
            </div> 



            <div class="form-group">
            <label>Exam Group <span class="required">*</span></label>
            <select  id="exam_group_id_attempt" name="exam_group_id_attempt" class="form-control" >

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


            <div class="form-group">
            <label><?php echo $this->lang->line('exam'); ?> <span class="required">*</span></label>
            <select  id="exam_id_attempt" name="exam_id_attempt" class="form-control"   >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            </div>

            
            </div>
            </div> 
            
            
<table class="table table-bordered" id="examOptionTypeTable">
    <thead>
        <tr>
            <th>Exam Option</th>
            <th>Exam Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>



            <td>
                <select name="exam_option[]" class="form-control">
                    <option value="">Select</option>
                    <option value="REGULAR">Regular</option>
                    <option value="SUPP">Supplementary</option>
                    <option value="IMP">Improvement</option>
                    <option value="REVAL">Revaluation</option>
                </select>
            </td>
            <td>
                <select name="exam_type[]" class="form-control">
                    <option value="">Select</option>
                    <option value="GENERAL">General</option>
                    <option value="TE">TE</option>
                    <option value="CE">CE</option>
                </select>
            </td>

            <td><input type="text" name="attempt[]" class="form-control"></td>
            <td>
                <button type="button" class="btn btn-danger removeRow">X</button>
            </td>
        </tr>
    </tbody>
</table>

<button type="button" class="btn btn-primary" id="addRow">
    + Add
</button>




                     
            </div>
            <div class="form-section">
            <div class="btn-container">
            <button type="submit" class="btn btn-secondary" >Save & Update</button>
            <!-- <button type="button" class="btn btn-secondary" onclick="switchTab(0)">← Previous</button> -->
            <!-- <button type="button" class="btn btn-primary" onclick="switchTab(2)">Next: Additional Details →</button> -->
            </div>
            </div>
            </form>



            <!---------4 Tab closed-------------------------------------------->

            </div>

            </div>
            </div>





            <script type="text/javascript">
            $(document).ready(function () { 


            $('#fee_ex_type').on('change', function () {         
            const fee_exam_type = $(this).val();

            // Optional: Clear existing values while fetching
            $('#fine_effective_date, #exam_fees, #processing_charge, #fine_amount, #last_date_without_fine, #last_date_with_fine').val('');

            $.ajax({
            url: '<?php echo base_url("Semester_exam/exam_instruction/get_byfeechrge"); ?>',
            type: 'POST',
            data: { fee_exam_type },
            dataType: 'json',

            success: function (data) {


            if (data) { 

            // const effectivedate = data.sem_fees_charge_effectivedate?.split('-').reverse().join('-') || '';
            // $('#fine_effective_date').val(effectivedate);

            // const withoutfine = data.sem_fees_without_fine_dt?.split('-').reverse().join('-') || '';
            // $('#last_date_without_fine').val(withoutfine);

            // const withfine = data.sem_fees_with_fine_dt?.split('-').reverse().join('-') || '';
            // $('#last_date_with_fine').val(withfine);

            $('#fine_effective_date').val(data.sem_fees_charge_effectivedate || '');
            $('#last_date_without_fine').val(data.sem_fees_without_fine_dt || '');
            $('#last_date_with_fine').val(data.sem_fees_with_fine_dt || '');


            $('#exam_fees').val(data.sem_fees_fees_charge || '');
            $('#processing_charge').val(data.sem_fees_processing_charge || '');
            $('#fine_amount').val(data.sem_fees_charge_fine || '');
            } else {
            // No data case
            alert('No fee details found for this exam type.');
            }
            },

            error: function (xhr, status, error) {
            console.error('Error fetching exam details:', error);
            alert('Error loading exam fee details. Please try again.');
            }
            });
            });



            $('#exam_group_id,#exam_id,#exam_option,#exam_type').on('change', function () 
            {         
            let examGroupId = $('#exam_group_id').val();
            let examId = $('#exam_id').val();
            let examOption = $('#exam_option').val();
            let examType = $('#exam_type').val();
            if (examGroupId && examId && examOption && examType) {
            $.ajax({
            url: '<?php echo base_url("Semester_exam/exam_instruction/get_bygroup"); ?>', // adjust your controller path
            type: 'POST',
            data: {
            exam_group_id: examGroupId,
            exam_id: examId,
            exam_option: examOption,
            exam_type: examType
            },
            dataType: 'json',
            success: function (data) {
            if (data) {
            $('#exam_title').val(data.sem_exam_title);
            const startdate = data.sem_exam_Examcommencement?.split('-').reverse().join('-') || '';
            $('#exam_start').val(startdate);

            const lastdate = data.sem_exam_lasdate_of_exam?.split('-').reverse().join('-') || '';
            $('#exam_end').val(lastdate);

            const publishDate = data.sem_exam_publishdate?.split('-').reverse().join('-') || '';
            $('#publish_date').val(publishDate);
            const closingDate = data.sem_exam_closingdate_of_exam?.split('-').reverse().join('-') || '';
            $('#closing_date').val(closingDate);

            // $('#closing_date').val(data.sem_exam_closingdate_of_exam);
            $('#closing_time').val(data.sem_exam_closetime);
            $('#class_leave').val(data.sem_exam_class_leave_for_studying);
            $('#payment_mode').val(data.sem_exam_mode_of_payment);
            $('#fee_details').val(data.sem_exam_fee_details);
            $('#no_fine_details').val(data.sem_exam_last_date_fee_withoutfine);
            $('#fine_details').val(data.sem_exam_last_date_fee_withoutfine);
            $('#declaration').val(data.sem_exam_declaration);
            $('#close_message').val(data.sem_exam_closemessage);
            $('#payment_remarks').val(data.sem_exam_remarksafterpayment);
            $('#active_status').val(data.sem_exam_is_status);
            }
            },
            error: function (xhr, status, error) {
            console.error('Error fetching exam details:', error);
            }
            });
            }
            });


            });


            $(document).on('input', '#get_fees_charge', function() {                      
            var amount = $(this).val(); // get entered amount
            // $('input[name="fees_charge"]').val(amount); // set it to all row inputs
            $('.fees_charge').val(amount); // set it to all row inputs
            });




            // $(document).ready(function()
            // { 
            // $('#programe, #batch_group, #semester_semtype,#semester_term').change(function() 
            // {
            // var prog      = $('#programe').val();
            // var bat       = $('#batch_group').val();
            // var sem       = $('#semester_semtype').val(); 
            // var sem_term  = $('#semester_term').val();                   

            // if( prog && bat && sem && sem_term) 
            // {
            // $.ajax({
            // url: '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
            // type: 'POST',
            // data: { 
            // prog   : prog,
            // bat    : bat,
            // sem    : sem,
            // sem_term:sem_term,
            // },
            // success: function(response) 
            // {
            // var res = JSON.parse(response);  // Convert string to object 
            // console.log(res.sem_group_id);  
            // $('#sem_group_id').val(res.sem_group_id); 
            // //     $('#sem_group_id').trigger('change');
            // }
            // });
            // }
            // else
            // {
            // // Clear sem_group_id when any required field is empty
            // $('#sem_group_id').val('');
            // $('#sem_group_id').trigger('change');  // Optional: To handle downstream logic if needed
            // console.log('sem_group_id cleared because prog, bat, or sem is empty');
            // }
            // });


            // var old_program_type  = "<?php echo set_value('program_type'); ?>";
            // var old_programe      = "<?php echo set_value('programe'); ?>";

            // $(document).ready(function()
            // {
            // function loadProgrames(prog_type_id, selected_programe = '') {
            // if(prog_type_id != '') {
            // $.ajax({
            // url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
            // method: "POST",
            // data: { prog_type_id: prog_type_id },
            // dataType: "json",
            // success: function(data) { 
            // $('#programe').empty();
            // $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            // $.each(data, function(key, value) { 
            // var selected = (value.id == selected_programe) ? 'selected' : '';
            // $('#programe').append('<option value="'+ value.id +'" '+selected+'>'+ value.p_name +'</option>');
            // });
            // }
            // });
            // } else {
            // $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            // }
            // }

            // // On page load: populate programe if old_program_type exists
            // if(old_program_type != '') {
            // $('#program_type').val(old_program_type);
            // loadProgrames(old_program_type, old_programe);
            // }
            // // On change: load programe dynamically
            // $('#program_type').change(function() {
            // var prog_type_id = $(this).val();
            // loadProgrames(prog_type_id);
            // });
            // }); 
            // });



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

            var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
            var exam_id = '<?php echo set_value('exam_id') ?>';



            var exam_group_id_attempt = '<?php echo set_value('exam_group_id_attempt') ?>';
            var exam_id_attempt = '<?php echo set_value('exam_id_attempt') ?>';


            // getExamgroupByClassSectionSession(class_id, section_id, session_id);
            getExamByExamgroup(exam_group_id, exam_id);


            $(document).on('change', '#exam_group_id_attempt', function (e) {
            $('#exam_id_attempt').html("");
            var exam_group_id_attempt = $(this).val();
            getExamByExamgroup_attempt(exam_group_id_attempt, 0);
            });


            $(document).on('change', '#exam_group_id', function (e) {
            $('#exam_id').html("");
            var exam_group_id = $(this).val();
            getExamByExamgroup(exam_group_id, 0);
            });



            function getExamByExamgroup(exam_group_id, exam_id)
            {
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



            function getExamByExamgroup_attempt(exam_group_id_attempt, exam_id_attempt)
            {
            if (exam_group_id_attempt !== "") {
            $('#exam_id_attempt').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
            type: "POST",
            url: base_url + "admin/examgroup/getExamByExamgroup",
            data: {'exam_group_id': exam_group_id_attempt},
            dataType: "json",
            beforeSend: function () {
            $('#exam_id_attempt').addClass('dropdownloading');
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

            $('#exam_id_attempt').append(div_data);
            $('#exam_id_attempt').trigger('change');
            },
            complete: function () {
            $('#exam_id_attempt').removeClass('dropdownloading');
            }
            });
            }
            }


          

            // Tab switching
            function switchTab(index) {
            const buttons = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');

            buttons.forEach((btn, i) => {
            btn.classList.toggle('active', i === index);
            });

            contents.forEach((content, i) => {
            content.classList.toggle('active', i === index);
            });

            // Scroll to top smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });
            }                         


            // const examFeesInput = document.getElementById('exam_fees');
            // const processing_charge = document.getElementById('processing_charge');
            // const fine_amount = document.getElementById('fine_amount');



            // const displayExamFees = document.getElementById('display_exam_fees');
            // const display_processing = document.getElementById('display_processing');
            // const display_fine = document.getElementById('display_fine');
            // const display_total = document.getElementById('display_total');


            // examFeesInput.addEventListener('input', function() {
            // const value = parseFloat(examFeesInput.value) || 0;
            // displayExamFees.textContent = `₹ ${value.toFixed(2)}`;
            // });

            const examFeesInput = document.getElementById('exam_fees');
            const processingChargeInput = document.getElementById('processing_charge');
            const fineAmountInput = document.getElementById('fine_amount');

            const displayExamFees = document.getElementById('display_exam_fees');
            const displayProcessing = document.getElementById('display_processing');
            const displayFine = document.getElementById('display_fine');
            const displayTotal = document.getElementById('display_total');

            // Update when Exam Fees changes
            examFeesInput.addEventListener('input', function() {
            const value = parseFloat(examFeesInput.value) || 0;
            displayExamFees.textContent = `₹ ${value.toFixed(2)}`;
            const processing = parseFloat(processingChargeInput.value) || 0;
            const fine = parseFloat(fineAmountInput.value) || 0;
            displayTotal.textContent = `₹ ${(value + processing + fine).toFixed(2)}`;
            });

            // Update when Processing Charge changes
            processingChargeInput.addEventListener('input', function() {
            const value = parseFloat(examFeesInput.value) || 0;
            const processing = parseFloat(processingChargeInput.value) || 0;
            displayProcessing.textContent = `₹ ${processing.toFixed(2)}`;
            const fine = parseFloat(fineAmountInput.value) || 0;
            displayTotal.textContent = `₹ ${(value + processing + fine).toFixed(2)}`;
            });

            // Update when Fine changes
            fineAmountInput.addEventListener('input', function() {
            const value = parseFloat(examFeesInput.value) || 0;
            const processing = parseFloat(processingChargeInput.value) || 0;
            const fine = parseFloat(fineAmountInput.value) || 0;
            displayFine.textContent = `₹ ${fine.toFixed(2)}`;
            displayTotal.textContent = `₹ ${(value + processing + fine).toFixed(2)}`;
            });


            // Calculate and display total fees
            // function updateFeesSummary() {
            //     const examFees = parseFloat(document.getElementById('exam_fees').value) || 0;
            //     const processing = parseFloat(document.getElementById('processing_charge').value) || 0;
            //     const fine = parseFloat(document.getElementById('fine_amount').value) || 0;
            //     const total = examFees + processing + fine;

            //     document.getElementById('display_exam_fees').textContent = `₹ ${examFees.toFixed(2)}`;
            //     document.getElementById('display_processing').textContent = `₹ ${processing.toFixed(2)}`;
            //     document.getElementById('display_fine').textContent = `₹ ${fine.toFixed(2)}`;
            //     document.getElementById('display_total').textContent = `₹ ${total.toFixed(2)}`;
            // }

            // Add event listeners for fee inputs
            // ['exam_fees', 'processing_charge', 'fine_amount'].forEach(id => {
            //     document.getElementById(id).addEventListener('input', updateFeesSummary);
            // });

            // Form submission


            // document.getElementById('examForm').addEventListener('submit', function(e) {
            //     e.preventDefault();

            //     // Validate all required fields
            //     const requiredFields = this.querySelectorAll('[required]');
            //     let isValid = true;

            //     requiredFields.forEach(field => {
            //         if (!field.value.trim()) {
            //             isValid = false;
            //             field.style.borderColor = '#e74c3c';
            //         } else {
            //             field.style.borderColor = '#e0e0e0';
            //         }
            //     });

            //     if (isValid) {
            //         const formData = {
            //             exam_group: document.getElementById('exam_group').value,
            //             exam_id: document.getElementById('exam_id').value,
            //             exam_title: document.getElementById('exam_title').value,
            //             exam_fees: document.getElementById('exam_fees').value,
            //             processing_charge: document.getElementById('processing_charge').value,
            //             fine_amount: document.getElementById('fine_amount').value,
            //             total_amount: (parseFloat(document.getElementById('exam_fees').value || 0) + 
            //                           parseFloat(document.getElementById('processing_charge').value || 0) + 
            //                           parseFloat(document.getElementById('fine_amount').value || 0)).toFixed(2)
            //         };

            //         console.log('Form Data:', formData);
            //         alert('✅ Examination details saved successfully!\n\n📊 Total Fee: ₹ ' + formData.total_amount);
            //     } else {
            //         alert('❌ Please fill all required fields');
            //         // Find first invalid field and switch to its tab
            //         const firstInvalid = Array.from(requiredFields).find(f => !f.value.trim());
            //         if (firstInvalid) {
            //             const tabContent = firstInvalid.closest('.tab-content');
            //             const tabIndex = Array.from(document.querySelectorAll('.tab-content')).indexOf(tabContent);
            //             switchTab(tabIndex);
            //         }
            //     }
            // });

            // Reset form
            function resetForm() {
            if (confirm('⚠️ Are you sure you want to reset all fields?')) {
            document.getElementById('examForm').reset();
            updateFeesSummary();
            switchTab(0);
            }
            }

            // Reset border on input
            document.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', function() {
            this.style.borderColor = '#e0e0e0';
            });
            });

            // Initialize fees summary
            updateFeesSummary();


            /// Redirect in same Tab


            function switchTab(index) {
            const tabs = document.querySelectorAll(".tab-button");
            const tabContents = document.querySelectorAll(".tab-content");

            // remove active class from all tabs
            tabs.forEach((tab) => tab.classList.remove("active"));
            tabContents.forEach((content) => content.style.display = "none");

            // activate selected tab
            tabs[index].classList.add("active");
            tabContents[index].style.display = "block";

            // save the active tab index in localStorage
            localStorage.setItem('activeTab', index);
            } 
            </script>


<script>
document.getElementById('addRow').addEventListener('click', function () {
    let table = document.getElementById('examOptionTypeTable').querySelector('tbody');
    let row = table.rows[0].cloneNode(true);

    row.querySelectorAll('select').forEach(s => s.value = '');
    table.appendChild(row);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeRow')) {
        let rows = document.querySelectorAll('#examOptionTypeTable tbody tr');
        if (rows.length > 1) {
            e.target.closest('tr').remove();
        }
    }
});
</script>
