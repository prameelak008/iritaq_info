                <?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                
                <section class="content-header">
                <h1>
                <i class="fa fa-credit-card"></i> <?php echo $this->lang->line('template'); ?>ttyty </h1>
                </section>
                
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <?php
                if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                ?>
                
                <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                
                <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('settings').'&nbsp;&nbsp;'.   $entrance_current_session['session']; ?>
                
                </h3>
                </div><!-- /.box-header -->
                
                
                
                
                <form id="form1" action="<?php echo site_url("entrance_settings/settings/edit/" . $id); ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                
                <div class="box-body">                            
                <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
                
                
                
                <div class="form-group">
                <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                <select  id="session" name="session" class="form-control select2"  >
                <?php
                foreach($sessionlist as $sess)
                {
                ?>
                <option value="<?php echo $sess['id'];?>"<?php  if($generalbyval['set_general_session']==$sess['id'])
                {  
                echo "selected=selected"; 
                } 
                ?> ><?php  echo $sess['session']; ?></option>
                <?php 
                } 
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('session'); ?></span>
                </div>
                
                
                
                <div class="form-group">
                <label><?php echo $this->lang->line('phase') ?></label><small class="req"> *</small>
                    <select  id="phase" name="phase" class="form-control select2"  >
                    <?php 
                    foreach($get_session_phase as $phase)
                    {
                    ?>
                        <option value="<?php echo $phase['entrance_examgroup_id']; ?>"
                        <?php 
                        if($generalbyval['set_general_phase']==$phase['entrance_examgroup_id'])
                        {
                        echo "selected=selected";
                        }
                        ?> >
                        <?php
                        echo $phase['entrance_examgroup_name']; ?>
                        </option>
                    
                    <?php } ?>
                    </select>
                <span class="text-danger"><?php echo form_error('session'); ?></span>
                </div>

                
                
                
                <div class="form-group">
                <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
                <select  id="entrance_course" name="entrance_course" class="form-control " >
                <?php
                if($generalbyval['set_general_course']==0)
                {
                $set="All";   
                }
                else
                {
                $set=$generalbyval['entranceexam_course_name'];   
                }
                ?>
                <option value="<?php echo $generalbyval['set_general_course']; ?>"><?php echo $set; ?></option>    
                <option value="0">Select All</option>  
                <?php
                foreach($course as $cou)
                {
                ?>
                <option value="<?php echo $cou['entranceexam_course_id']; ?>"  
                <?php  if($generalbyval['set_general_course']==$cou['entranceexam_course_id'])
                { 
                echo "selected=seleted"; 
                }
                ?>>
                <?php echo $cou['entranceexam_course_name']; ?></option>
                <?php
                }
                ?>
                </select>
                <span class="text-danger"><?php echo form_error('entrance_course'); ?></span>
                </div>
                
                
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('exam').'&nbsp;'.$this->lang->line('section'); ?></label><small class="req"> *</small>
                <select name="exam_section" class="form-control"><small class="req"> *</small>
                <option value="<?php echo $generalbyval['set_general_section']; ?>"  
                <?php  if(set_value['exam_section']==$generalbyval['set_general_section'])
                { 
                echo "selected=seleted"; 
                }
                ?>>
                <?php echo $generalbyval['set_general_section']; ?></option>
                <option value="Admission">Admission </option>
                <option value="Check Status">Check Status </option>
                <option value="Payment Receipt">Payment Receipt </option>
                <option value="Admit Card">Admit Card</option>
                <option value="Exam Result">Exam Result</option>
                <option value="College Preference">College Preference </option>
                <option value="Allotment Status">Allotment Status</option>
                <option value="Allotment Slip">Allotment Slip</option> 
                </select>
                <span class="text-danger"><?php echo form_error('exam_section'); ?></span>
                </div>
                
                
                <div class="form-group">
                <label>Announce Date</label>
                <input type="datetime-local" name="announce_date" value="<?php echo $generalbyval['set_general_announcedate']; ?>"  id="announce_date" class="form-control" />
                </div>
                
                <div class="form-group">
                <label for="exampleInputEmail1">Announce Message </label>
                <select name="announce_message" id="announce_message" class="form-control">
                <option value="">Select Announce</option>
                <?php
                foreach($template as $temp)
                {
                ?>
                <option value="<?php echo $temp['set_template_id'];  ?>"
                <?php
                
                if($generalbyval['set_general_announcemessage']==$temp['set_template_id'])
                {
                echo "selected==selected";
                }
                ?> >
                
                <?php echo $temp['set_template_name'];  ?>
               </option>
                <?php
                } 
                ?>
                </select>
                </div>
                
                
                
                <div class="form-group" id="anno">
                <label for="exampleInputEmail1">Announce Details </label>
                <textarea cols="3" rows="5" id="announcemsg_details" name="announcemsg_details" class="form-control" readonly style="background-color: whitesmoke;"></textarea>
                </div>
                
                
                <div class="form-group">
                <label>Publish Date</label>
                <input type="datetime-local" name="publish_date"  id="publish_date" value="<?php echo $generalbyval['set_general_publishdate']; ?>" class="form-control" />
                </div>
                
                
                <div class="form-group">
                <label for="exampleInputEmail1">Close Message </label>
                <select name="close_message" id="close_message" class="form-control">
                <option vlaue="">Select Template</option>
                <?php
                foreach($template as $temp)
                {
                ?>
                <option value="<?php echo $temp['set_template_id'];  ?>"
                <?php 
                
                if($generalbyval['set_general_closemessage']==$temp['set_template_id'])
                {
                    echo "selected==selected";
                }
                ?> ><?php 
                
                echo $temp['set_template_name'];  ?>
                </option>
                <?php } ?>
                </select>
                </div>
                
                
                <div class="form-group" id="close">
                <label for="exampleInputEmail1">Close Details </label>
                <textarea cols="3" rows="5" id="closemsg_details" name="closemsg_details" class="form-control" readonly style="background-color: whitesmoke;"></textarea>
                </div>
                
                
                <div class="form-group">
                <label>Close Date</label>
                <input type="datetime-local" name="close_date"  id="close_date"  value="<?php echo $generalbyval['set_general_closedate']; ?>" class="form-control" />
                </div>
                
                
                </div>
               
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                </div>
                
                </form>
                </div>
                
                </div><!--/.col (right) -->
                <!-- left column -->
                <?php } ?>
                
                
                <div class="col-md-<?php
                if ($this->rbac->hasPrivilege('expense', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><?php echo $this->lang->line('template').'&nbsp;'.$this->lang->line('list'); ?></h3>
                <div class="box-tools pull-right">
                </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="mailbox-messages table-responsive">
                <div class="download_label"><?php echo $this->lang->line('template'); ?></div>
                <div class="table-responsive"> 
                <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo $this->lang->line('template'); ?>">
                <thead>
                <tr>
                <th><?php echo $this->lang->line('session'); ?></th>
                 <th><?php echo $this->lang->line('phase'); ?></th>
                <th><?php echo $this->lang->line('course'); ?></th>
                <th><?php echo $this->lang->line('section'); ?></th>
                <th><?php echo $this->lang->line('key').'&nbsp;'. $this->lang->line('dates'); ?></th>
                <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($general as $gen)
                {
                ?>
                <tr>
                <th><?php echo $gen['session']; ?></th>
                <th><?php echo $gen['entrance_examgroup_name']; ?></th>
                <th><?php echo $gen['entranceexam_course_name']; ?></th>
                <th><?php echo $gen['set_general_section']; ?></th>
                
                
                <th>
                <?php  
                echo "Announce Date ".'&nbsp;&nbsp; :&nbsp;&nbsp;'.str_replace('T', ' ', $gen['set_general_announcedate']);
                echo "<br>";   
                echo "Publish Date ".'&nbsp;&nbsp; :&nbsp;&nbsp;'.  str_replace('T', ' ', $gen['set_general_publishdate']);
                echo "<br>";  
                echo "Close Date ".'&nbsp;&nbsp; :&nbsp;&nbsp;'.  str_replace('T', ' ', $gen['set_general_closedate']);
                ?>
                    
                </th>
                <th class="text-right ">
                <a data-placement="left" href="<?php echo base_url(); ?>entrance_settings/settings/edit/<?php echo $gen['set_general_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                <i class="fa fa-pencil"></i>
                </a>
                <a data-placement="left" href="<?php echo base_url(); ?>entrance_settings/settings/delete/<?php echo $gen['set_general_id'] ?>" class="btn btn-default btn-xs"  onclick="return doconfirm();"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>">
                <i class="fa fa-trash" style="color:red;"></i>
                </a></th>
                </tr>
               
                
                <?php } ?>
                
                
                </tbody>
                </table>
                
                <!-- /.table -->
                
                </div>  
                
                </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                </div>
                
                </div><!--/.col (left) -->
                
                </div>
                <div class="row">
                <!-- left column -->
                
                <!-- right column -->
                <div class="col-md-12">
                
                </div><!--/.col (right) -->
                </div>   <!-- /.row -->
                </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
                
                <script type="text/javascript">
                
                $( document ).ready(function() 
                {
                $('#close').hide();
                $('#anno').hide();
                });
                
                $(document).on('change', '#close_message', function (e) 
                {
                var close_message       = $('#close_message').val();
                
                $.ajax({
                url: '<?php echo site_url('entrance_settings/settings/gettemplate_instruction'); ?>',
                type: 'POST',
                dataType: 'Json',
                data: {'close_message':close_message},
                success: function(data) 
                {
                $('#closemsg_details').val(data.set_template_instruction);
                $('#close').show();
                },
                });
                });
                
                $(document).on('change', '#announce_message', function (e) 
                {
                var announce_message = $('#announce_message').val();
                $.ajax({
                url: '<?php echo site_url('entrance_settings/settings/get_instruction'); ?>',
                type: 'POST',
                dataType: 'Json',
                data: {'announce_message':announce_message},
                success: function(data) 
                {
                $('#announcemsg_details').val(data.set_template_instruction);  
                $('#anno').show();   
                
                },
                });
                });
                
                
                
                function doconfirm()
                {
                var job=confirm('Do you want To Delete');
                if(job==true)
                {
                return true;
                }
                else
                {
                return false;  
                }
                }
                </script>
