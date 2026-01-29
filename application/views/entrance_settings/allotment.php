               
            <style >
            .text-left
            {
            text-align: left !important;
            }
            </style>
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <small><?php echo $this->lang->line('entrance_settings') ; ?></small>  
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
            <h5 class="box-title titlefix"><?php echo $this->lang->line('allotment') .'&nbsp;'.$this->lang->line('print').'&nbsp;'.$this->lang->line('slip'); ?></h5>
            </div>
            
            <br>
            <div class="box-body">
            <!--<form name="form" action="<?php echo site_url('entrance_settings/allotment') ?>" method="post" >-->
            
            <form id="assign_form" action="<?php echo site_url('entrance_settings/allotment/add_allotment'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
            
            <div class="col-sm-12">
            <div class="form-group">
            <!--<button type="submit"  name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>-->
            
               
            <div class="form-group">
            <label for="exampleInputEmail1">Instruction</label> 
            <textarea name="instruction" id="instruction"  rows="6" class=" form-control ckeditor" required="required"></textarea>
            
            <!--<input type="text" name="setcourse" value="<?php  echo $courseid ;?>" />-->
            <!--<input type="text" name="setsession" value="<?php  echo $session_id ;?>" />-->
            </div>
            
            
            <input type="submit" name="submit" value="SAVE & UPDATE" class=" btn btn-primary pull-right btn-sm checkbox-toggle btn btn-success"/>
            </form>
            
            </div>
            </div>
            </div>
            </div>
            
            <div>
         
            
            <?php
           // if (!empty($alloted_settings)) 
            //{ 
            
            //if (!empty($session_id && !empty($courseid )))
            //{
            ?>
            
            
            <div class="" >
            <div class="box-header ptbnull"></div>
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i>Allotment</h3>
            </div>
            
            <div class="box-body">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <div class="download_label"> <?php echo $this->lang->line('allotment') . " " . $this->lang->line('slip'); ?></div>
            
            
            <!--<form name="form" id="form" method="POST" action="<?php  echo site_url('entrance_settings/allotment/add_allotment'); ?>" enctype="multipart/form-part" accept-charset="utf-8">-->
            
            
            
            
            
            
            
            <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover example" >
            <thead>
            
            
            <tr>
            <th><?php echo $this->lang->line('session');?></th>
            <th><?php echo $this->lang->line('course');?> </th>
            <th>Instruction</th>
            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
                <tbody>
                <?php
                $count = 0;
                foreach ($alloted_settings as $allot) { ?>
                <tr>
                <td>
                <?php  echo  $allot['session']; ?>
                </td>
                <td>
                <?php  echo  $allot['entranceexam_course_name']; ?>
                </td>
                <td>
                <?php  echo  $allot['set_allotment_instruction']; ?>
                </td>
                <td align="right">
                <!--<a data-placement="left" href="<?php echo site_url('entrance_settings/allotment/editsetallotment/' . $allot['set_allotment_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>-->
                <a data-placement="left" onclick="return doconfirm();" href="<?php echo site_url('entrance_settings/allotment/delsetallotment/' . $allot['set_allotment_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash" style="color:#be2323;"></i></a>
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
            CKEDITOR.replace( 'instruction' );
            $(document).on('change', '#entrance_course', function (e) 
            {
            CKEDITOR.instances.instruction.setData('');
            var course       = $('#entrance_course').val();
            var sess         = $('#session').val();
            $.ajax({
            url: '<?php echo site_url('entrance_settings/allotment/getalloted_instruction'); ?>',
            type: 'POST',
             dataType: 'Json',
            data: {'course':course,'sess':sess},
            success: function(data) 
            {
            CKEDITOR.instances.instruction.setData(data.set_allotment_instruction);
            },
            });
            });
            
             
             
            $(document).on('change', '#session', function (e) 
            {
            CKEDITOR.instances.instruction.setData('');
            var course       = $('#entrance_course').val();
            var sess         = $('#session').val();
            $.ajax({
            url: '<?php echo site_url('entrance_settings/allotment/getalloted_instruction'); ?>',
            type: 'POST',
             dataType: 'Json',
            data: {'course':course,'sess':sess},
            success: function(data) 
            {
            CKEDITOR.instances.instruction.setData(data.set_allotment_instruction);
            },
            });
            });
            
            
            
            $(document).ready(function()
            {
            $("#asign_form").submit(function(event)
            {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
            url: '<?php echo site_url('entrance_settings/allotment/add_allotment'); ?>',
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