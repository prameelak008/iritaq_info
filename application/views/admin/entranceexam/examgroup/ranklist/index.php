                
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
            <h3 class="box-title"><i class="fa fa-search"></i>Ranklist </h3>
            </div>
            
            
            <div class="box-body">
            <form role="form" action="<?php echo site_url('entrance_allotment/ranklist') ?>" method="post" >
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="row">
                
                
                
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo $this->lang->line('phase') ?></label><small class="req"> *</small>
            <select  id="phaseid" name="phaseid" class="form-control select2" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php
            $count = 0;
            foreach ($phaselist as $phase) {
            ?>
            <option value="<?php echo $phase['entrance_examgroup_id'] ?>" <?php if (set_value('phaseid') == $phase['entrance_examgroup_id']) {
            echo "selected=selected";
            }
            ?>><?php echo $phase['entrance_examgroup_name'] ?></option>
            <?php
            $count++;
            }
            ?>
            </select>
            
            <span class="text-danger"><?php echo form_error('session'); ?></span>
            </div>
            </div>
                
                
                
                
                
                
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
            
            <span class="text-danger"><?php echo form_error('session'); ?></span>
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
            <span class="text-danger"><?php echo form_error('entrance_course'); ?></span>
            </div>
            </div>
            
            
            <div class="col-sm-6 col-lg-3 col-md-3 col20">
            <div class="form-group">
            <label><?php echo  $this->lang->line('ranklist'); ?></label><small class="req"> *</small>
            <select  id="ranklist" name="ranklist" class="form-control select2"  >
            <option value="1">Rank List</option>
            <option value="2">Waiting List</option>
            <option value="3">Failed </option>
            </select>
            <span class="text-danger"><?php echo form_error('ranklist'); ?></span>
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
            if (!empty($ranklist)) 
            { 
            ?>
            <div class="" >
            <div class="box-header ptbnull"></div>
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i> Ranklist</h3>
            </div>
            <div class="box-body">
            <div class="tab-pane active table-responsive no-padding" id="tab_1">
            <div class="download_label"> <?php echo $this->lang->line('ranklist'); ?></div>
            <div class="col-md-6">
       
            <div class="box-body">
                
                 <table class="table table-bordered" id="subjects_table">
                                <thead>
                                    <tr>
                                        <th> <?php echo $this->lang->line('slno'); ?> </th>
                                    <th class="col-sm-3"> <?php echo $this->lang->line('name'); ?> </th>
                                    
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($ranklist)) {
                                        $slno=1;
                                        foreach ($ranklist as $rank) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno;  ?></td>
                                                <td><?php echo $rank['admission_name'];  ?></td>
                                                <td><?php //echo $rank['entranceexam_subject_subid'];  ?></td>
                                            </tr>
                                            <?php
                                             $slno++;
                                        }
                                    }
                                    ?>
                                </tbody>
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