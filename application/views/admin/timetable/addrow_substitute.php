                        <style type="text/css">
                        .relative label.text-danger{position: absolute; left:5px; bottom:0;}
                        </style>
                        <div class="row clearfix">
                        <div class="col-md-12 column">
                        
                        <form method="POST" action="<?php echo site_url('admin/timetable/savegroup_substitute'); ?>"  id="form_<?php echo $day; ?>" class="commentForm autoscroll">
                        
                        <input type="hidden" name="day"  value="<?php echo $day; ?>">
                        <input type="hidden" name="class_id"  value="<?php echo $class_id; ?>">
                        <input type="hidden" name="section_id"  value="<?php echo $section_id; ?>">
                        <input type="hidden" name="subject_group_id"  value="<?php echo $subject_group_id; ?>">
                        
                        <input type="hidden" name="subst_date"  value="<?php echo $subst_date; ?>">
                        <div class=""> 
                        
                        <?php
                        if($day=="Sunday")
                        {
                        $st="1";
                        }
                        
                        if($day=="Monday")
                        {
                        $st="2";
                        }
                        if($day=="Tuesday")
                        {
                        $st="3";
                        }
                        if($day=="Wednesday")
                        {
                        $st="4";
                        }
                        if($day=="Thursday")
                        {
                        $st="5";
                        }
                        if($day=="Friday")
                        {
                        $st="6";
                        }
                        if($day=="Saturday")
                        {
                        $st="7";
                        }
                        ?>
                        
                        
                        
                        <table class="table table-bordered table-hover order-list tablewidthRS" id="tab_logic">
                        <thead>
                        <tr>
                        
                        <th>
                        <?php echo $this->lang->line('subject') ?>
                        </th>
                        <th>
                        <?php echo $this->lang->line('teacher'); ?>
                        </th>
                        
                        <th>
                        <?php echo $this->lang->line('subject') ?>
                        </th>
                        <th>
                        <?php echo $this->lang->line('teacher'); ?>
                        </th>
                        
                        <th>
                        <?php echo $this->lang->line('period'); ?>
                        </th>
                        
                        
                        <th>
                        <?php echo $this->lang->line('time') . " " . $this->lang->line('from') ?><small class="astrike"> *</small>
                        </th>
                        <th>
                        <?php echo $this->lang->line('time') . " " . $this->lang->line('to') ?><small class="astrike"> *</small>
                        </th>
                        <th>
                        <?php echo $this->lang->line('room') . " " . $this->lang->line('no') ?>
                        </th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                        if (!empty($prev_record)) 
                        {
                        $counter = 1;
                        
                        foreach ($prev_record as $prev_rec_key => $prev_rec_value) 
                        {
                        ?>
                        
                        
                        <tr id='addr0'>
                        
                        <td>
                        <input type="hidden" name="prev_array[]" value="<?php echo $prev_rec_value->id; ?>">
                        <input type="hidden" name="total_row[]" value="<?php echo $counter.''.$st; ?>">
                        <input type="hidden" name="prev_id[]" value="<?php echo $prev_rec_value->id; ?>">
                        <input type="hidden" name="subject[]" value="<?php echo $prev_rec_value->subject_group_subject_id; ?>">
                        
                        <input type="hidden" name="subject[]" value="<?php echo $prev_rec_value->subject_group_subject_id; ?>">
                        
                        
                        <select disabled="true" class="form-control subject" id="subject_id_<?php echo $counter.''.$st; ?>" name="">
                        
                        <option value="" ><?php echo $this->lang->line('select') ?></option>
                        <?php
                        foreach ($subject as $subject_key => $subject_value) {
                        ?>
                        
                        <option value="<?php echo $subject_value->id; ?>" <?php echo set_select('subject_' . $counter.''.$st, $subject_value->id, ($prev_rec_value->subject_group_subject_id == $subject_value->id ) ? TRUE : FALSE ); ?> >
                        <?php
                        $sub_code = ($subject_value->code != "") ? " (" . $subject_value->code . ")" : "";
                        echo $subject_value->name . $sub_code;
                        ?>
                        <?php ?>
                        </option>
                        <?php
                        }
                        ?>
                        </select>
                        </td>
                        
                        <input type="hidden" name="staff[]" value="<?php echo $prev_rec_value->staff_id; ?>">
                        
                        <td>
                        <select disabled="true" class="form-control staff" id="staff_id_<?php echo $counter.''.$st; ?>" name="staffid_<?php echo $counter.''.$st; ?>">
                        <option value=""><?php echo $this->lang->line('select') ?></option>
                        <?php
                        foreach ($staff as $staff_key => $staff_value) {
                        ?>
                        
                        <option value="<?php echo $staff_value['id']; ?>" <?php echo set_select('staff_' . $counter.''.$st, $staff_value['id'], ($prev_rec_value->staff_id == $staff_value['id'] ) ? TRUE : FALSE ); ?> ><?php echo $staff_value['name'] . " " . $staff_value['surname'] . " (" . $staff_value['employee_id'] . ")"; ?></option>
                        <?php
                        }
                        ?>
                        </select>
                        </td>
                        
                        
                        
                        
                        <td>
                        <input type="hidden" name="total_row[]" value="<?php echo $counter.''.$st; ?>">
                        <input type="hidden" name="prev_id_<?php echo $counter.''.$st; ?>" value="<?php echo $prev_rec_value->id; ?>">
                        
                        
                        <select class="form-control " id="subject_idsubs_<?php echo $counter.''.$st; ?>" name="subjectsubs[]">
                        
                        <?php
                        foreach($getsubstitute as $subst)
                        {
                        if($subst->timetable_id==$prev_rec_value->id && $subst->substitute_date==$subst_date)
                        {
                        ?>
                        <option value="<?php echo $subject_value->id; ?>"><?php echo $subst->name.'('.$subst->code.')'; ?></option>
                        <?php
                        }
                        
                        }
                        ?>
                        <option value="" ><?php echo$this->lang->line('select') ?></option>
                        
                        
                        
                        <?php       
                        
                        foreach ($subject as $subject_key => $subject_value) 
                        {
                        ?>
                        <option value="<?php echo $subject_value->id; ?>" <?php echo set_select('subject_idsubs' . $counter.''.$st, $subject_value->id, ($prev_rec_value->	subject_group_subject_idsubs	 == $subject_value->id ) ? TRUE : FALSE ); ?> >
                        
                        <?php
                        $sub_code = ($subject_value->code != "") ? " (" .$subject_value->name.''. $subject_value->code . ")" : "";
                        echo $sub_code;
                        ?>
                        <?php ?>
                        </option>
                        
                        
                        
                        <?php
                        }
                        ?>
                        </select>
                        </td>
                        
                        
                        
                        
                        
                        <td>
                        <select class="form-control " id="staff_idsubs_<?php echo $counter.''.$st; ?>" name="staffsubs[]">
                        
                        <?php
                        foreach($getsubstitute as $subst)
                        {
                        
                        if($subst->timetable_id==$prev_rec_value->id && $subst->substitute_date==$subst_date)
                        { 
                        
                        if ($subst->staff_idsubs != '')
                        {   
                        
                        ?>
                        
                        <option value="<?php  echo $subst->staff_idsubs;  ?>"><?php  echo $subst->shortname;  ?></option>
                        
                        <?php }  
                        ?>
                        
                        <!--<option value="<?php echo $staff_value['id']; ?>" <?php echo set_select('staff_' . $counter.''.$st, $staff_value['id'], ($prev_rec_value->staff_id == $staff_value['id'] ) ? TRUE : FALSE ); ?> ><?php echo $staff_value['shortname'] ; ?></option>-->
                        
                        <?php
                        }
                        
                        }
                        ?> 
                        
                        <option value="" ><?php echo $this->lang->line('select') ?></option> 
                        
                        
                        
                        <?php
                        foreach ($staff as $staff_key => $staff_value) {
                        ?>
                        
                        <!--<option value="<?php echo $staff_value['id']; ?>" <?php echo set_select('staff_' . $counter.''.$st, $staff_value['id'], ($prev_rec_value->staff_id == $staff_value['id'] ) ? TRUE : FALSE ); ?> ><?php echo $staff_value['shortname'] ; ?></option>-->
                        <option value="<?php echo $staff_value['id']; ?>" ><?php echo $staff_value['shortname'] ; ?></option>      
                        
                        
                        <?php
                        }
                        ?>
                        </select>
                        </td>
                        
                        
                        
                        
                        <td class="relative">
                        
                        <input type="hidden" value="<?php echo $prev_rec_value->period_id; ?>"  name="period_id[]" >     
                        
                        <select disabled="true" class="form-control period" id="period_id_<?php echo $counter.''.$st; ?>" name="period_idd_<?php echo $counter.''.$st; ?>" onchange="getperiod_id(<?php echo $counter.''.$st; ?>)" >
                        <option value=""><?php echo $this->lang->line('select') ?></option>
                        <?php
                        foreach ($period as $periodkey => $period_value)
                        {
                        ?>
                        
                        
                        <option value="<?php echo $period_value['periodic_table_id']; ?>" <?php echo set_select('period_id_' . $counter.''.$st, $period_value['periodic_table_id'], ($prev_rec_value->period_id == $period_value['periodic_table_id'] ) ? TRUE : FALSE ); ?> ><?php echo $period_value['periodic_table_name']; ?></option>     
                        
                        <!--<option value="<?php echo $period_value['periodic_table_id']; ?>"><?php echo $period_value['periodic_table_name'] ; ?></option>-->
                        <?php
                        }
                        ?>
                        </select>
                        </td>
                        
                        
                        
                        <td>
                        <div class="input-group">
                        
                        <input  type="hidden" name="time_from[]" class="form-control time_from time" id="time_from_<?php echo $counter.''.$st; ?>" value="<?php echo $prev_rec_value->start_time; ?>">
                        <input disabled="true" type="text" name="" class="form-control time_from time" id="time_from_<?php echo $counter.''.$st; ?>" value="<?php echo $prev_rec_value->start_time; ?>">
                        <div class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                        </div>
                        </div>
                        </td>
                        
                        
                        <td>
                        <div class="input-group">
                        <input   type="hidden" name="time_to[]" class="form-control time_to time" id="time_to_<?php echo $counter.''.$st; ?>" value="<?php echo $prev_rec_value->end_time; ?>"> 
                        
                        <input  disabled="true" type="text" name="" class="form-control time_to time" id="time_to_<?php echo $counter.''.$st; ?>" value="<?php echo $prev_rec_value->end_time; ?>">
                        <div class="input-group-addon">
                        <span class="fa fa-clock-o"></span>
                        </div>
                        </div>
                        </td>
                        <td>
                        <input type="text" readonly="readonly" name='room_no[]' value="<?php echo $prev_rec_value->room_no; ?>" placeholder='Room no' class="form-control room_no" id="room_no_<?php echo $counter.''.$st; ?>"/>
                        </td>
                        
                        
                        </tr>
                        
                        <?php
                        $counter ++;
                        }
                        }
                        ?>
                        
                        
                        </tbody>
                        </table>
                        </div>
                        <?php if ($this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
                        ?>
                        <button class="btn btn-primary btn-sm pull-right" type="submit"><i class="fa fa-save"></i> <?php echo $this->lang->line('substitute'); ?></button>
                        <?php }
                        ?>
                        
                        
                        </form>
                        </div>
                        </div>
                        </div>
                        
                        <script type="text/javascript">
                        
                        var form_id = "<?php echo $day ?>";
                        $(function () {
                        
                        
                        $('form#form_' + form_id).on('submit', function (event)
                        {
                        // prevent default submit action         
                        event.preventDefault();
                        // test if form is valid 
                        
                        if ($('form#form_' + form_id).validate().form()) 
                        {
                        var target = $('.nav-tabs .active a').attr("href");
                        var target_id = $('.nav-tabs .active a').attr("id");
                        var ajax_data = $('.nav-tabs .active a').data();
                        
                        $.ajax({
                        type: 'POST',
                        url: base_url + "admin/timetable/savegroup_substitute",
                        data: $('#form_' + form_id).serialize(),
                        dataType: 'json',
                        beforeSend: function () 
                        {
                        },
                        success: function (data)
                        {
                        
                        $(target).html(data.html);
                        if (data.status == 1) {
                        
                        successMsg(data.message);
                        // $(target).html("");
                        // getGroupdata(target, target_id, ajax_data);
                        
                        } else {
                        var list = $('<ul/>');
                        $.each(data.error, function (key, value) {
                        
                        if (value != "") {
                        list.append(value);
                        }
                        });
                        errorMsg(list);
                        }
                        },
                        error: function (xhr) { // if error occured
                        
                        },
                        complete: function () {
                        
                        }
                        });
                        
                        } else {
                        console.log("does not validate");
                        }
                        });
                        
                        
                        // initialize the validator
                        $('form#form_' + form_id).validate({
                        errorClass: 'text-danger'
                        });
                        
                        
                        
                        
                        });
                        
                        </script>
                        
                        
                        
                        
