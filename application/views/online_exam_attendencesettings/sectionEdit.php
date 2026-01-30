

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('attendance').'&nbsp;'.$this->lang->line('settings'); ?> <small>
               <?php echo $this->lang->line('attendance').'&nbsp;'.$this->lang->line('settings'); ?></small> 
           </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <?php
            if ($this->rbac->hasPrivilege('online_examination_instruction', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('update').'&nbsp;'.$this->lang->line('attendance').'&nbsp;'.$this->lang->line('settings'); ?></h3>
                        </div>
                         
                    <form action="<?php echo site_url('admin/attendence_settings/update_inst') ?>"  id="instruction" name="instruction" method="post" accept-charset="utf-8">



                                <div class="box-body">
                               <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?> 
                                <?php echo $this->customlib->getCSRF(); ?>
                                
                                
                                 <div class="form-group">
                                    <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
                                    <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" required="required" >
                                        
                        <option value="<?php   echo $editonline_instructon['online_examination_examgroup']; ?> "><?php   echo $editonline_instructon['name'];      ?></option>

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
                                    <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
                                    <select  id="exam_id" name="exam_id" class="form-control" onchange="getsubjectid()" required="required" >
                                        <option value="<?php   echo $editonline_instructon['online_examination_examid']; ?>  "><?php   echo $editonline_instructon['exam']; ?>  </option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                </div> 
                                
                                
                        <div class="form-group">  
                        <label><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
                        <select  id="session_id" name="session_id" class="form-control" >
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
                        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                        </div> 
                                



                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?> </label><small class="req"> *</small>
 <input autofocus="" id="online_examination_id" name="online_examination_id" placeholder="" type="hidden" class="form-control"  value="<?php echo $editonline_instructon['online_examination_id']; ?>" />


                                <input autofocus="" id="online_examination_heading" name="online_examination_heading" placeholder="" type="text" class="form-control"  value="<?php echo $editonline_instructon['online_examination_heading']; ?>" />
                                <span class="text-danger"><?php echo form_error('online_examination_heading'); ?></span>
                                </div>
                                
                                
                         <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('ineligible').'&nbsp;'. $this->lang->line('message'); ?> </label><small class="req"> *</small>

                                <textarea name="message" placeholder="" class="form-control ckeditor">
                                <?php echo $editonline_instructon['online_examination_ineligible_msg']; ?></textarea>
                                <span class="text-danger"><?php echo form_error('message'); ?></span>
                                </div>        
                                
                                
                                
                                
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('attendence').'&nbsp;'. $this->lang->line('percentage'); ?> </label><small class="req"> *</small>
        <input autofocus="" id="attendence_percentage" name="attendence_percentage" placeholder="" type="text" class="form-control"  value="<?php echo $editonline_instructon['online_examination_attendencepercentage']; ?>" />
        <span class="text-danger"><?php echo form_error('attendence'); ?></span>
        </div>


        <div class="form-group switch-inline">
        <label><?php echo $this->lang->line('active') ?><?php echo $this->lang->line('status') ?></label>
        <div class="material-switch switchcheck">
        <input id="is_status" name="is_status" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_status', '1', (set_value('is_status',  $editonline_instructon['online_examination_is_status']) == 1) ? true : false); ?> >
        
        <label for="is_status" class="label-success"></label>
        </div>
        </div>


        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('edit'); ?></button>
        </div>
        </form>
        
        
                    </div>  
                </div>   
            <?php } ?>  
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('section', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('attendance').'&nbsp;'.$this->lang->line('settings'); ?></h3>
                    </div>
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('attendance').'&nbsp;'.$this->lang->line('settings'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                   <tr>
                                        <th><?php echo $this->lang->line('title'); ?></th>
                                        <th><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></th>
                                        <th><?php echo $this->lang->line('exam'); ?></th>

                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    foreach ($online_instructon as $instruction) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $instruction['online_examination_heading'] ?></td>
                                            <td class="mailbox-name"> <?php echo $instruction['name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $instruction['exam'] ?></td>

                                            <td class="mailbox-name"> 


                                                <?php
                                                if($instruction['online_examination_is_status']=='1') 
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

                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/attendence_settings/edit_inst/<?php echo $instruction['online_examination_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                <i class="fa fa-pencil"></i>
                                                </a>


                                                <a data-placement="left" href="<?php echo base_url(); ?>admin/attendence_settings/delete_inst/<?php echo $instruction['online_examination_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
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

    $( document ).ready(function()
     {

      var idate= $('#idate').val(); 



    $('#tt').val(idate);
    
});


   // $('#dateid').val(today);

    </script>
    
    
    <script type="text/javascript">
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
    var class_id = '<?php echo set_value('class_id') ?>';
    var section_id = '<?php echo set_value('section_id') ?>';
    var session_id = '<?php echo set_value('session_id') ?>';
    var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
    var exam_id = '<?php echo set_value('exam_id') ?>';
    getSectionByClass(class_id, section_id);

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


    function getExamByExamgroup(exam_group_id, exam_id) {

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
</script>