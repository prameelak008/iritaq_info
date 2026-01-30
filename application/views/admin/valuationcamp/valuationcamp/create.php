<style >
    .hr-text {
  line-height: 1em;
  position: relative;
  outline: 0;
  border: 0;
  color: black;
  text-align: center;
  height: 1.5em;
  opacity: .5;
  &:before {
    content: '';
    // use the linear-gradient for the fading effect
    // use a solid background color for a solid bar
    background: linear-gradient(to right, transparent, #818078, transparent);
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
  }
  &:after {
    content: attr(data-content);
    position: relative;
    display: inline-block;
    color: black;

    padding: 0 .5em;
    line-height: 1.5em;
    // this is really the only tricky part, you need to specify the background color of the container element...
    color: #818078;
    background-color: #fcfcfa;
  }
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('valuation_Camp'); ?> <small>
                <?php echo $this->lang->line(''); ?></small> 
           </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <?php
            //if ($this->rbac->hasPrivilege('online_examination_instruction', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('valuation_Camp'); ?></h3>
                        </div>

                         
                    <form action="<?php echo site_url('admin/valuation/add_val') ?>"  id="valuation_details" name="valuation_details" method="post" accept-charset="utf-8">


                            <div class="box-body">
                                 <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                
                                <!--
                                <div class="form-group">
                                    <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
                                    <select autofocus="" required="required" id="exam_group_id" name="exam_group_id" class="form-control" >
                                        
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
                                    <select  id="exam_id" required="required" name="exam_id" class="form-control" onchange="getsubjectid()" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                </div> 
                                -->
                                


                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?> </label><small class="req"> *</small>
                                <input autofocus="" required="required" id="valuation_name" name="valuation_name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('valuation_name'); ?>" />
                                <span class="text-danger"><?php echo form_error('valuation_name'); ?></span>
                                </div> 
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('location'); ?>location </label><small class="req"> *</small>
                                <input autofocus="" required="required" id="valuation_location" name="valuation_location" placeholder="" type="text" class="form-control"  value="<?php echo set_value('valuation_location'); ?>" />
                                <span class="text-danger"><?php echo form_error('valuation_location'); ?></span>
                                </div>
                                
        
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('from').''. $this->lang->line('date'); ?> </label><small class="req"> *</small>
                                <input autofocus="" required="required" id="fromdate" name="fromdate" placeholder="" type="date" class="form-control"  value="<?php echo date('Y-m-d'); ?>" />
                                <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
                                </div> 
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('to').''. $this->lang->line('date'); ?> </label><small class="req"> *</small>
                                <input autofocus="" required="required" id="todate" name="todate" placeholder="" type="date" class="form-control"  value="<?php echo date('Y-m-d'); ?>" />
                                <span class="text-danger"><?php echo form_error('todate'); ?></span>
                                </div>
                                
                               
                                
                                <hr class="hr-text" data-content="LAST DATE FOR  ENTER MARKS ">
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('close').'&nbsp;'.$this->lang->line('enter_mark'); ?> </label>
                                <input type="date" name="enter_mark" id="enter_mark" class="form-control"/>
                                <span class="text-danger"><?php echo form_error('enter_mark'); ?></span>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('close').'&nbsp;'.$this->lang->line('message'); ?> </label><small class="req"> *</small>
                                
                                <textarea name="close_enter_marks" placeholder="" class="form-control ckeditor">
                                
                                </textarea>
                                <span class="text-danger"><?php echo form_error('close_enter_marks'); ?></span>
                                </div>
                                
                                </div>
                                
                                
                                
                                <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                                </div>
                                
                              </form>
                    </div>  
                </div>   
            <?php //} ?>  
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
                                       <th><?php echo $this->lang->line('slno'); ?></th>
                                       <th><?php echo $this->lang->line('session'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                          <th><?php echo $this->lang->line('location'); ?></th>
                                        
                                        <!--<th><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></th>-->
                                        <!--<th><?php echo $this->lang->line('exam'); ?></th>-->

                                 
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    
                                
                                         foreach ($valuation_center as $valcenter) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $count; ?></td>
                                                <td class="mailbox-name"> <?php echo $valcenter['session'] ?></td>
                                                <td class="mailbox-name"> <?php echo $valcenter['valuation_centername'] ?></td>
                                                <td class="mailbox-name"> <?php echo $valcenter['valuation_centerlocation'] ?></td>
                                                
                                                <!--<td class="mailbox-name"> <?php echo $valcenter['name'] ?></td>-->
                                                <!--<td class="mailbox-name"> <?php echo $valcenter['exam'] ?></td>-->

                                            <td class="mailbox-date pull-right">                                              

                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/valuation/edit_valuationcenter/<?php echo $valcenter['valuation_centerid'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                            <i class="fa fa-pencil"></i>
                                             </a>

                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/valuation/delete_valuationcenter/<?php echo $valcenter['valuation_centerid'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                                           <i class="fa fa-remove" style="color:red;"></i>
                                             </a>                                               
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