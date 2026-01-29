            
            <style >
            .text-left
            {
            text-align: left !important;
            }
            </style>
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <small></small>  
            </h1>
            </section>
            
            
            <!-- Main content -->
            
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header ptbnull">
            
            <h2>
            <small><?php echo $this->lang->line('entrance_settings') ; ?></small>  
            </h2>
            <h5 class="box-title titlefix"><?php echo $this->lang->line('exam').'&nbsp;'.$this->lang->line('result') ; ?></h5>
            </div>
            
            <br>
            <div class="box-body">
            
            
            <form id="assign_form" action="<?php echo site_url('entrance_settings/examresult/add_examresult'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <?php echo $this->customlib->getCSRF(); ?>
            
            <div class="row">
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
            <select  id="session" name="session" class="form-control select2"  >
            <?php
            foreach($sessionlist as $sess)
            {
            ?>
            <option value="<?php echo $sess['id'];?>"<?php  if($current_session==$sess['id'])
            {  
            echo "selected=selected"; 
            } 
            ?> ><?php  echo $sess['session']; ?></option>
            <?php 
            } 
            ?>
            </select>
            
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>
            </div>
            
            
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo  $this->lang->line('course'); ?></label><small class="req"> *</small>
            <select  id="entrance_course" name="entrance_course" class="form-control " required="required"  >
            <option value="">Select Name</option>  
            <?php
            foreach($course as $cou)
            {
            ?>
            <option value="<?php echo $cou['entranceexam_course_id']; ?>"><?php echo $cou['entranceexam_course_name']; ?></option>
            <?php
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
            </div>
            </div>
            
            
            <div class="col-sm-6">
            <div class="form-group">
            <label>Expired Date</label><small class="req"> *</small>
            <input type="date" name="expired_date"  id="expired_date" class="form-control" />
            </div>
            </div>
            
            
            
            <div class="col-sm-12">
            <div class="form-group">
            <label for="exampleInputEmail1">Message Before Publishing</label> 
            <textarea name="publishing" id="publishing"  rows="6" class=" form-control ckeditor" required="required"></textarea>
            </div>
            </div>
            
            
            <div class="col-sm-12">
            <div class="form-group">
            <label for="exampleInputEmail1">Message After Close</label> 
            <textarea name="expired_message" id="expired_message"  rows="6" class=" form-control ckeditor" required="required"></textarea>
            </div>
            </div>
            
            
            
            <div class="col-sm-12">
            <div class="form-group">
            <input type="submit" name="submit" value="SAVE & UPDATE" class=" btn btn-primary pull-right btn-sm checkbox-toggle btn btn-success"/>
            </form>
            </div>
            </div>
            </div>
            
            
            <div>
            <div class="" >
            <div class="box-header ptbnull"></div>
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i><?php echo $this->lang->line('exam').'&nbsp;'.$this->lang->line('result') ; ?></h3>
            </div>
            
            <div class="box-body">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <div class="download_label"> <?php echo $this->lang->line('allotment') . " " . $this->lang->line('slip'); ?></div>
            
            <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example" >
            <thead>
            <tr>
            <th><?php echo $this->lang->line('session');?></th>
            <th><?php echo $this->lang->line('course');?> </th>
            <th>Publish</th>
            
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count = 0;
            foreach ($examresult_settings as $result) { ?>
            <tr>
            <td>
            <?php  echo  $result['session']; ?>
            </td>
            <td>
            <?php  echo  $result['entranceexam_course_name']; ?>
            </td>
            
            
            <td>
            <b>Publish :</b><br>
           <?php  echo  $result['set_examresult_publish_instruction']; ?>
            <br>
            <b>Expired Date:</b><?php  echo  $result['set_examresult_expireddate']; ?>
            
            <b>
            
            <br>
            <?php  echo  $result['set_examresult_expiredinstruction']; ?>
            </td>
            <td align="right">
            <a data-placement="left" onclick="return doconfirm();" href="<?php echo site_url('entrance_settings/examresult/delsetexamresult/' . $result['set_examresult_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#be2323;"></i></a>
            </td>
            </tr>                                        
            <?php
            $count++;
            }
            ?> 
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
            </div>
            <?php  
            //}
            ?>
            </div>
            </section>
            </div>
            </div>
            
            
            
            
            <script type="text/javascript">
            
            $(document).on('change', '#entrance_course', function (e) 
            {
            var course       = $('#entrance_course').val();
            var sess         = $('#session').val();
            $.ajax({
            url: '<?php echo site_url('entrance_settings/examresult/getexamresult_instruction'); ?>',
            type: 'POST',
            dataType: 'Json',
            data: {'course':course,'sess':sess},
            success: function(data) 
            {
            CKEDITOR.instances.publishing.setData(data.set_examresult_publish_instruction);
            CKEDITOR.instances.expired_message.setData(data.set_examresult_expiredinstruction);
            },
            });
            });
             
            $(document).on('change', '#session', function (e) 
            {
            CKEDITOR.instances.publishing.setData('');
            CKEDITOR.instances.expired_message.setData('');
            var course       = $('#entrance_course').val();
            var sess         = $('#session').val();
            $.ajax({
            url: '<?php echo site_url('entrance_settings/examresult/getexamresult_instruction'); ?>',
            type: 'POST',
             dataType: 'Json',
            data: {'course':course,'sess':sess},
            success: function(data) 
            {
            CKEDITOR.instances.publishing.setData(data.set_examresult_publish_instruction);
            CKEDITOR.instances.expired_message.setData(data.set_examresult_expiredinstruction);
            },
            });
            });
            
            function doconfirm() 
            { 
            var x = confirm("Are you sure you want to delete?"); 
            if (x == true) 
            {
            return true;
            }
            else
            {
            return false;
            }
            }
            
            
            </script>