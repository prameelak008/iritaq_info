                        <style type="text/css">
                            .relative label.text-danger{position: absolute; left:5px; bottom:0;}
                        </style>
                        
                        
                        
                        
                        
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <a id="add_row" class="addrow addbtnright btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add') . " " . $this->lang->line('new'); ?></a>
                                
                                
                                    <form method="POST" action="<?php echo site_url('admin/timetable/savetimetable'); ?>" id="form_<?php echo $day; ?>" class="commentForm autoscroll">
                                   
                                    <input type="hidden" name="day"  value="<?php echo $day; ?>">
                                    <input type="hidden" name="class_id"  value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id"  value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="subject_group_id"  value="<?php echo $subject_group_id; ?>">
                                    
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
                                                        <?php echo $this->lang->line('papername') ?>
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
                                                    <th class="text-right">
                                                        <?php echo $this->lang->line('action') ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             
                                                <?php
                                                //vlex
                                                if (!empty($prev_record)) 
                                                {
                                                   $counter = 1;
                                                    foreach ($prev_record as $prev_rec_key => $prev_rec_value) 
                                                    {
                                                       
                                                    ?>
                                                    <input type="hidden" name="prev_array[]" value="<?php echo $prev_rec_value->id; ?>">
                        
                                                    <tr id='addr0'>
                                                        <td>
                                                           <select class="form-control subjectpaper" id="subjectpaper_<?php echo $counter.''.$st; ?>" name="subjectpaper_<?php echo $counter.''.$st; ?>" onchange="get_subject_id(<?php echo $counter.''.$st; ?>)"  >
                                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                                                <?php
                                                                foreach ($subjectpapers as $subjectpaper_key => $subjectpaper_value)
                                                                {
                                                                ?>
                                                                <option value="<?php echo $subjectpaper_value['subjectpaper_id']; ?>" <?php echo set_select('subjectpaper_' . $counter.''.$st, $subjectpaper_value['subjectpaper_id'], ($prev_rec_value->subject_paper_id == $subjectpaper_value['subjectpaper_id'] ) ? TRUE : FALSE ); ?> ><?php echo $subjectpaper_value['subjectpaper_papername'].'&nbsp;&nbsp;'.$subjectpaper_value['subjectpaper_papercode']; ?></option>     
                                                                
                                                                <?php
                                                                }
                                                                ?>
                                                        </select> 
                                                        </td>
                                                        
                        
                                                        <td>
                                                            <input type="hidden" name="total_row[]" value="<?php echo $counter.''.$st; ?>">
                                                            <input type="hidden" name="prev_id_<?php echo $counter.''.$st; ?>" value="<?php echo $prev_rec_value->id; ?>">
                                                            
                                                            <!--<select class="form-control subject" id="subject_id_<?php echo $counter.''.$st; ?>" name="subject_<?php echo $counter.''.$st; ?>">
                        
                                                                <option value=""><?php echo$this->lang->line('select') ?></option>
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
                                                            </select>-->
                                                            
                                                        <input type="text" name="getsubname<?php echo $counter.''.$st; ?>" class="form-control getsubname" id="getsubname<?php echo $counter.''.$st; ?>" value="<?php echo ($prev_rec_value->subname != "") ? $prev_rec_value->subname :  $prev_rec_value->subname;?>"> 
                                                        <input type="hidden" name="subject_id_<?php echo $counter.''.$st; ?>" class="form-control subject_id" id="subject_id_<?php echo $counter.''.$st; ?>" value="">   
                                                            
                                                        </td>
                                                        
                                                        
                                                        
                                                        <td>
                                                            <select class="form-control " id="staff_id_<?php echo $counter.''.$st; ?>" name="staff_<?php echo $counter.''.$st; ?>">
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
                                                        
                                                        
                                                        <!--if valueeee-->
                                                          <td class="relative">
                                                        <select class="form-control period" id="period_id_<?php echo $counter.''.$st; ?>" name="period_id_<?php echo $counter.''.$st; ?>" onchange="getperiod_id(<?php echo $counter.''.$st; ?>)" >
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
                                                                <input type="text" name="time_from_<?php echo $counter.''.$st; ?>" class="form-control time_from time" id="time_from_<?php echo $counter.''.$st; ?>" value="<?php echo ($prev_rec_value->start_time != "") ? $prev_rec_value->time_from :  $this->customlib->timeFormat($prev_rec_value->start_time);?>">
                                                                <div class="input-group-addon">
                                                                    <span class="fa fa-clock-o"></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" name="time_to_<?php echo $counter.''.$st; ?>" class="form-control time_to time" id="time_to_<?php echo $counter.''.$st; ?>" value="<?php echo ($prev_rec_value->end_time != "") ? $prev_rec_value->time_to :  $this->customlib->timeFormat($prev_rec_value->end_time);?>">
                                                                <div class="input-group-addon">
                                                                    <span class="fa fa-clock-o"></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name='room_no_<?php echo $counter.''.$st; ?>' value="<?php echo $prev_rec_value->room_no; ?>" placeholder='Room no' class="form-control room_no" id="room_no_<?php echo $counter.''.$st; ?>"/>
                                                        </td>
                                                        <td class="text-right"><button class="ibtnDel btn btn-danger btn-sm btn-danger"> <i class="fa fa-trash"></i></button></td>
                        
                                                    </tr>
                        
                                                    <?php
                                                    $counter ++;
                                                }
                                            } 
                                            else 
                                            {
                                            ?>
                        <!-- inor---->
                        
                        <?php  $counter = 1;  ?>
                                                <tr id='addr0'>
                                                      <td class="relative">
                                                        <select class="form-control subjectpaper" id="subjectpaper_<?php echo $total_count; ?>" name="subjectpaper_<?php echo $total_count; ?>"  onchange="get_subject_id(<?php echo $total_count; ?>)"   >
                                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                                            <?php
                                                            foreach ($subjectpapers as $subjectpaper_key => $subjectpaper_value)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $subjectpaper_value['subjectpaper_id']; ?>" ><?php echo $subjectpaper_value['subjectpaper_papername'].'&nbsp;&nbsp;'.$subjectpaper_value['subjectpaper_papercode'];  ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                        
                                                    <td class="relative">
                                                        <input type="hidden" name="total_row[]" value="<?php echo $total_count; ?>">
                                                        <input type="hidden" name="prev_id_<?php echo $total_count; ?>" value="0">
                                                        
                                                        
                                                 <!-- <select class="form-control subject" id="subject_id_<?php echo $total_count; ?>" name="subject_<?php echo $total_count; ?>">
                                                    
                                                    <option value=""><?php echo $this->lang->line('select') ?></option>
                                                    <?php
                                                    foreach ($subject as $subject_key => $subject_value) {
                                                        ?>
                                                    
                                                        <option value="<?php echo $subject_value->id; ?>"><?php echo $subject_value->name . " (" . $subject_value->code . ")"; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    </select>-->
                                                   
                                                    
                                                    <!--<input type="text" name="getsubname<?php echo $counter.''.$st; ?>" class="form-control getsubname" id="getsubname<?php echo $counter.''.$st; ?>" value="<?php echo ($prev_rec_value->subname != "") ? $prev_rec_value->subname :  $prev_rec_value->subname;?>"> -->
                                                    <!--<input type="hidden" name="subject_id_<?php echo $counter.''.$st; ?>" class="form-control subject_id" id="subject_id_<?php echo $counter.''.$st; ?>" value="">   -->
                                                        
                                                    <input type="text" name="getsubname<?php echo $total_count; ?>" class="form-control getsubname" id="getsubname<?php echo $total_count; ?>" value="<?php echo ($prev_rec_value->subname != "") ? $prev_rec_value->subname :  $prev_rec_value->subname;?>"> 
                                                    <input type="hidden" name="subject_id_<?php echo $total_count; ?>" class="form-control subject_id" id="subject_id_<?php echo $total_count; ?>" value="">     
                                                       
                                                    </td>
                                                    
                                                    
                                                    <td class="relative">
                                                        <select class="form-control " id="staff_id_<?php echo $total_count; ?>" name="staff_<?php echo $total_count; ?>">
                                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                                            <?php
                                                            foreach ($staff as $staff_key => $staff_value) {
                                                                ?>
                                                                <option value="<?php echo $staff_value['id']; ?>"><?php echo $staff_value['name'] . " " . $staff_value['surname'] . " (" . $staff_value['employee_id'] . ")"; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    
                                                    
                                                    <td class="relative">
                                                        <select class="form-control period" id="period_id_<?php echo $total_count; ?>" name="period_id_<?php echo $total_count; ?>" onchange="getperiod_id(<?php echo $total_count; ?>)" >
                                                            <option value=""><?php echo $this->lang->line('select') ?></option>
                                                            <?php
                                                            foreach ($period as $periodkey => $period_value)
                                                            {
                                                                ?>
                        
                                                                <option value="<?php echo $period_value['periodic_table_id']; ?>"><?php echo $period_value['periodic_table_name'] ; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" name="time_from_<?php echo $total_count; ?>" class="form-control time_from time" id="time_from_<?php echo $total_count; ?>" aria-invalid="false">
                                                            <div class="input-group-addon">
                                                                <span class="fa fa-clock-o"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" name="time_to_<?php echo $total_count; ?>" class="form-control time_to time" id="time_to_<?php echo $total_count; ?>" aria-invalid="false">
                                                            <div class="input-group-addon">
                                                                <span class="fa fa-clock-o"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" name='room_no_<?php echo $total_count; ?>' id='room_no_<?php echo $total_count; ?>' placeholder='Room no' class="form-control room_no"/>
                                                    </td>
                                                    
                                                    <td class="text-right"><button class="ibtnDel btn btn-danger btn-sm btn-danger"> <i class="fa fa-trash"></i></button></td>
                        
                                                </tr>
                                                <?php
                                                $counter ++;
                                            }
                                            ?>
                        
                        
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if ($this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
                                        ?>
                                        <button class="btn btn-primary btn-sm pull-right" type="submit"><i class="fa fa-save"></i> <?php echo $this->lang->line('save'); ?></button>&nbsp;
                                        
                                        
                                    <?php }
                                    ?>
                                </form>
                            </div>
                        </div>
                        </div>
                        
                        <script type="text/javascript">
                            var form_id = "<?php echo $day ?>";
                            
                            $(function ()
                            {
                                $('form#form_' + form_id).on('submit', function (event) {
                                    
                        
                                    // adding rules for inputs with class 'comment'
                                    $('select[id^="subject_id_"]').each(function ()
                                    {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                        
                                    });
                                    // adding rules for inputs with class 'comment'
                                    $('select[id^="staff_id_"]').each(function () {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                        
                                    });
                        
                                    $('input[id^="time_from_"]').each(function () {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                                    });
                        
                                    $('input[id^="time_to_"]').each(function () {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                                    });
                        
                                    $('input[id^="room_no_"]').each(function () {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                                    });
                                    
                                     $('select[id^="period_id_"]').each(function () {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                                    });
                                    
                                      $('select[id^="subjectpaper_"]').each(function () {
                                        $(this).rules('add', {
                                            required: true,
                                            messages: {
                                                required: "Required"
                                            }
                                        });
                                    });
                        
                                    // prevent default submit action         
                                    event.preventDefault();
                                    // test if form is valid 
                                    if ($('form#form_' + form_id).validate().form()) 
                                    {
                                        var target    = $('.nav-tabs .active a').attr("href");
                                        var target_id = $('.nav-tabs .active a').attr("id");
                                        var ajax_data = $('.nav-tabs .active a').data();
                                        $.ajax({
                                            type: 'POST',
                                            url: base_url + "admin/timetable/savegroup",
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
                                                    $(target).html("");
                                                    getGroupdata(target, target_id, ajax_data);
                        
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
                        
                        
                        
                        
