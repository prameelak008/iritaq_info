

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('online_examination_instruction'); ?> <small>
                <?php echo $this->lang->line(''); ?></small> 
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
                            <h3 class="box-title"><?php echo $this->lang->line('online_examination_instruction'); ?></h3>
                        </div>

                         
                    <form action="<?php echo site_url('admin/onlineexam_list/add_inst') ?>"  id="instruction" name="instruction" method="post" accept-charset="utf-8">
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
                                    <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
                                        
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
                                    <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
                                    <select  id="exam_id" name="exam_id" class="form-control" onchange="getsubjectid()" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                </div> 


                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?> </label><small class="req"> *</small>
                                <input autofocus="" id="online_examination_heading" name="online_examination_heading" placeholder="" type="text" class="form-control"  value="<?php echo set_value('online_examination_heading'); ?>" />
                                <span class="text-danger"><?php echo form_error('online_examination_heading'); ?></span>
                                </div> 

                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('last_date_fee_withoutfine'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="last_date_fee_withoutfine" name="last_date_fee_withoutfine" placeholder="" type="text" class="form-control"  value="<?php echo set_value('last_date_fee_withoutfine'); ?>" />
                                    <span class="text-danger"><?php echo form_error('last_date_fee_withoutfine'); ?></span>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('last_date_fee_withfine'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="last_date_fee_withfine" name="last_date_fee_withfine" placeholder="" type="text" class="form-control"  value="<?php echo set_value('last_date_fee_withfine'); ?>" />
                                    <span class="text-danger"><?php echo form_error('last_date_fee_withfine'); ?></span>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('class_leave_for_studying'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="class_leave_for_studying" name="class_leave_for_studying" placeholder="" type="text" class="form-control"  value="<?php echo set_value('class_leave_for_studying'); ?>" />
                                    <span class="text-danger"><?php echo form_error('class_leave_for_studying'); ?></span>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('Examcommencement'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="Examcommencement" name="Examcommencement" placeholder="" type="text" class="form-control"  value="<?php echo set_value('Examcommencement'); ?>" />
                                    <span class="text-danger"><?php echo form_error('Examcommencement'); ?></span>
                                    </div>


                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('fee_details'); ?> </label><small class="req"> *</small>
                                    <textarea id="fee_details" name="fee_details" placeholder="" class="form-control ckeditor"></textarea>
                                    <span class="text-danger"><?php echo form_error('fee_details'); ?></span>
                                    </div>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('mode_of_payment'); ?> </label><small class="req"> *</small>
                                    <textarea id="mode_of_payment" name="mode_of_payment" placeholder="" class="form-control ckeditor"></textarea>
                                    <span class="text-danger"><?php echo form_error('mode_of_payment'); ?></span>
                                    </div>



        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('declaration'); ?> </label><small class="req"> *</small>
        <textarea name="declaration" placeholder="" class="form-control ckeditor"></textarea>
        <span class="text-danger"><?php echo form_error('declaration'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('publish_date'); ?> </label><small class="req"> *</small>
        <input autofocus="" id="publishdate" name="publishdate" placeholder="" type="date" class="form-control"  value="<?php echo set_value('publish_date'); ?>" />
        <span class="text-danger"><?php echo form_error('publish_date'); ?></span>
        </div>                
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('lastdate_of_exam'); ?> </label><small class="req"> *</small>
        <input autofocus="" id="lastdate_of_exam" name="lastdate_of_exam" placeholder="" type="date" class="form-control"  value="<?php echo set_value('lastdate_of_exam'); ?>" />
        <span class="text-danger"><?php echo form_error('lastdate_of_exam'); ?></span>
        </div>



        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('close').'&nbsp;&nbsp;'.$this->lang->line('date'); ?> </label><small class="req"> *</small>
        <input autofocus="" id="closingdate" name="closingdate" placeholder="Closing Date" type="date" class="form-control"  value="<?php echo set_value('closingdate'); ?>" />
        <span class="text-danger"><?php echo form_error('closingdate'); ?></span>
        </div>
        
        
         <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('close').'&nbsp;&nbsp;'.$this->lang->line('time'); ?> </label><small class="req"> *</small>
        <input type="time" class="form-control" name="closetime" />
        <span class="text-danger"><?php echo form_error('closetime'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('close').'&nbsp;&nbsp;'.$this->lang->line('message'); ?> </label><small class="req"> *</small>
        <textarea name="closemessage" placeholder="" class="form-control ckeditor"></textarea>
        <span class="text-danger"><?php echo form_error('closemessage'); ?></span>
        </div>


        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('remarks_after_fees_payment'); ?> </label>
        <small class="req"> *</small>
        <textarea name="remarks_after_fees_payment" placeholder="Remarks" class="form-control ckeditor"></textarea>
        <span class="text-danger"><?php echo form_error('remarks_after_fees_payment'); ?></span>
        </div>
      
        
      
        
        
        <div class="form-group switch-inline">
        <label><?php echo $this->lang->line('active') ?><?php echo $this->lang->line('status') ?></label>
        <div class="material-switch switchcheck">
        <input id="is_status" name="is_status" type="checkbox" class="chk" value="1">
        <label for="is_status" class="label-success"></label>
        </div>
        </div>
        
        

        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
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
                        <h3 class="box-title titlefix"><?php echo $this->lang->line(''); ?></h3>
                    </div>
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line(''); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                   <tr>
                                        <th><?php echo $this->lang->line('section'); ?></th>
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

                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/onlineexam_list/edit_inst/<?php echo $instruction['online_examination_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                            <i class="fa fa-pencil"></i>
                                             </a>

                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/onlineexam_list/delete_inst/<?php echo $instruction['online_examination_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
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