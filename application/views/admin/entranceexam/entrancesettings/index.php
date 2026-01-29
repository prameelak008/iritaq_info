                
            <style >
            
            .text-left
            {
            text-align: left !important;
            }
            </style>
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
                
            <h1>
            <i class="fa fa-map-o"></i> <small><?php echo $this->lang->line('Students') ; ?></small>  
            </h1>
            
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i>Entrance Settings </h3>
            </div>
            
            
            <div class="box-body">
            <form role="form" action="<?php echo site_url('entrance_allotment/seatquota') ?>" method="post" >
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="row">
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
            <select  id="session" name="session" class="form-control select2"  >
            <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
            
            
            <?php
            foreach($sessionlist as $sess)
            {
            ?>
            <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
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
            <select  id="entrance_course" name="entrance_course" class="form-control select2"  >
            <?php
            foreach($course as $cou)
            {
            ?>
            <option value="<?php echo  $cou['entranceexam_course_id']; ?>" <?php
            if (set_value('entrance_course') == $cou['entranceexam_course_id']) {
            echo "selected=selected";
            }
            ?>><?php echo $cou['entranceexam_course_name']; ?></option>
            <?php
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
            </div>
            </div>
            
            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit"  name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
            </div>
            </div>
            </div>
            </form>
            </div>
            <div>
            
            
            <?php
            if (!empty($seatquota)) 
            { 
            ?>
            <div class="" >
            <div class="box-header ptbnull"></div>
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i> Seat Quota</h3>
            </div>
            
            <!--<button type="button"  data-toggle="modal" data-target="#sel_institute">-->
            <!--<i class="fa fa-plus btn btn-success">ALLOT INSTITUTE</i>-->
            <!--</button> -->
            
            <div class="box-body">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
            <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
            <thead>
            <tr>
            
            <th ><?php echo $this->lang->line('slno'); ?></th>
            <th ><?php echo $this->lang->line('institute'); ?></th>
            
            <?php   
            
            foreach($seatno as $seat)
            {
            ?>
            <th><?php  echo $seat['entrance_allot_type_name']; ?></th>
            <?php  } ?>
            </tr>
            </thead>
            <tbody>
            
            
            <?php
            $sl=1;
            foreach($seatquota as $app)
            {
            ?>
            <tr>
            <td><?php  echo $sl; ?></td> 
            <td><?php  echo $app['entranceexam_insitutename']; ?></td>
            <?php
            foreach($seatno as $seat)
            {
            ?>
            <td><?php  //echo $seat['entrance_allot_seat_seatno']; ?></td>
            <?php }  ?>
            </tr>
            <?php $sl++; }  ?>
            </tbody>
            </table>
            
            <br>
            <br>
            
            
            <div class="col-md-6">
            <h4><b>Set Criteria For Rank list and Waiting list</b></h4>
            <br>
            <form id="form" action="<?php echo site_url('entrance_allotment/seatquota/addval'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="box-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Eligible Percentage (Rank list)</label>
            <input type="hidden" name="courseid"  value="<?php echo $courseid; ?>" class="form-control" required>
            <input type="hidden" name="sessionid"  value="<?php echo $session_id; ?>" class="form-control" required>
            <input type="hidden" name="seatquotaid"  value="<?php echo $getseatval['entranceexam_seatquota_id']; ?>" class="form-control" required>
            <input type="text" name="eligiblepercentage" placeholder="Eligible Percentage (Rank list)" value="<?php if(isset($getseatval['entranceexam_seatquota_eligiblepercentage'])) {  echo $getseatval['entranceexam_seatquota_eligiblepercentage'];    } else { echo set_value('eligiblepercentage'); } ?>" class="form-control" required>
            </div>
            
            
            <div class="form-group">
            <label for="exampleInputEmail1">Pass Out Percentage</label>
            <input type="text" name="passoutpercentage" placeholder="Passout Percentage" value="<?php if(isset($getseatval['entranceexam_seatquota_passoutpercentage'])) {  echo $getseatval['entranceexam_seatquota_passoutpercentage'];    } else { echo set_value('passoutpercentage'); } ?>" class="form-control" required>
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"><b>Score Sheet Raw Header Setting</b></label>
            </div>
            <br>
            
            <div class="form-group">
            <label for="exampleInputEmail1">Percentage For Admission Eligibilty</label>
            <input type="text" name="admissioneligibilty" placeholder="Eligible Percentage" value="<?php if(isset($getseatval['entranceexam_seatquota_admissioneligibilty'])) {  echo $getseatval['entranceexam_seatquota_admissioneligibilty'];    } else { echo set_value('admissioneligibilty'); } ?>" class="form-control" required>
            </div>
            <br>
            
            
            
            <div class="form-group">
            <label for="exampleInputEmail1">Percentage for Pass Out:40%</label>
            <input type="text" style="width:50%;" name="headerpercentage" placeholder="Percentage for Pass Out:40%" class="form-control" value="<?php if(isset($getseatval['entranceexam_seatquota_headerpercentage'])) {  echo $getseatval['entranceexam_seatquota_headerpercentage'];    } else { echo set_value('headerpercentage'); } ?>" required>
            
            </div>
            </div>
            
            
            <div class="box-footer">
            <input type="submit"  name="submit"  class="btn btn-success" value="SAVE & UPDATE" >
            <button type="button" title="delete"  onClick="return ConfirmDelete(this)" class="btn btn-danger" style="color:white;" data-id="<?php echo $getseatval['entranceexam_seatquota_id']; ?>">REMOVE</button>
            
            
            </div>
            </form>             
            </div>
            
            
            <div class="col-md-6">
            <h4><b>Set Criteria For Management And Other Reserved Quotas</b></h4>
            <br>
            <div class="box-body">
            <form id="assign_form" action="<?php echo site_url('entrance_allotment/seatquota/addeligibleval'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <input type="hidden" name="courseid" id="courseid"  value="<?php echo $courseid; ?>" class="form-control" required>
            <input type="hidden" name="sessionid" id="sessionid"  value="<?php echo $session_id; ?>" class="form-control" required>  
            <input type="hidden" name="alot_id" id="alot_id" value="<?php echo $seat['entrance_allot_type_id'];  ?>" class="form-control" />
            
           
            
            <div class="form-group">
            <label for="exampleInputEmail1"><b>Category</b></label>
            <select name="entrance_allot_type_name" id="entrance_allot_type_name" class="form-control" required>
                
            <option value="">SELECT CATEGORY</option>    
            <?php 
            foreach($seatno_bymanagment as $app)
            {
            ?>
            <option value="<?php echo $app['entrance_allot_type_id']; ?>"><?php echo $app['entrance_allot_type_name'];  ?></option>
            <?php } ?>
            </select>
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1"><b>Eligible Percentage</b></label>
            <input type="text" name="entrance_eligiblepercentage" id="entrance_eligiblepercentage" class="form-control" />
            </div>
            
            
            
            <div class="form-group">
            <input type="submit"  name="submit"  class="btn btn-success" value="SAVE & UPDATE" >
            </div>
            </form>
            <br>
            <br>
            
            <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
            <tr><td><b>Category</b></td><td><b>Eligible Percentage</b></td><td><b>Action</b></td></tr>
            <?php
            foreach($eligibleseatno as $eli)
            {
            ?>
            <tr>
            <td><?php  echo $eli['entrance_allot_type_name']; ?></td>
            <td><?php  echo $eli['entranceexam_eligiblequota_elig_percentage']; ?></td>
            <td><button type="button" title="delete"  onClick="return ConfDelete(this)"  style="color:white;" data-id="<?php echo $eli['entranceexam_eligiblequota_id']; ?>"><i class="fa fa-trash" style="color:red;"></i></button>
            </td>
            
            </tr>
            <?php } ?>
            </table>
            </div>
            </div>
            </div>
            </div>  
            <?php  
            }
            ?>
            </div>
            </section>
            </div>
                
                
                
                
            <script type="text/javascript">
            $(document).ready(function(){
            $("#form").submit(function(event)
            {
            event.preventDefault();
            
            var formData = new FormData(this);
            $.ajax({
            url: '<?php echo site_url('entrance_allotment/seatquota/addval'); ?>',
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
            
            $(document).on('change', '#seattype', function (e) 
            {
            var seattype           = $(this).val();
            var entrance_course    = $('#entrance_course').val();
            var entrance_institute = $('#entrance_institute').val();
            $.ajax({
            type: "POST",
            data: {'seattype':seattype,'entrance_course':entrance_course,'entrance_institute':entrance_institute},
            url: base_url + "entrance_allotment/allotment/getallot_no",
            dataType: "json",
            success: function (data) 
            {
            $('#divno').show(); 
            $('#seatno').html(data.entrance_allot_seat_seatno);
            }
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
            url: "<?php echo site_url('entrance_allotment/seatquota/delval'); ?>",
            cache: false,
            data: {'id': id},
            success: function (data) 
            {
            console.log('ajax returned: ');
            console.log(data);
            
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
            $(document).ready(function(){
            $("#assign_form").submit(function(event)
            {
            event.preventDefault();
            
            var formData = new FormData(this);
            $.ajax({
            url: '<?php echo site_url('entrance_allotment/seatquota/addeligibleval'); ?>',
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
            
            
            
            
             function ConfDelete(obj) 
            { 
            var x = confirm("Are you sure you want to delete?"); 
            if (x == true) 
            {
            var id = $(obj).data('id');
            if (id != '')
            {
            $.ajax({
            type: "POST",
            url: "<?php echo site_url('entrance_allotment/seatquota/deleligibleval'); ?>",
            cache: false,
            data: {'id': id},
            success: function (data) 
            {
            console.log('ajax returned: ');
            console.log(data);
            
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
        
        
                $('#entrance_allot_type_name').change(function()
                {
                var type_name       = $(this).val();
                var courseid        = $('#courseid').val();
                var sessionid       = $('#sessionid').val();
                $.ajax({
                type: "POST",
                url: "<?php echo site_url('entrance_allotment/seatquota/getvalue'); ?>",
                cache: false,
                data: {'type_name': type_name,'courseid': courseid,'sessionid': sessionid},
                success: function (result) 
                {
                var data = JSON.parse(result);
                $('#entrance_eligiblepercentage').val(data.entranceexam_eligiblequota_elig_percentage);
                }
                    
                });
                });
            
            </script>