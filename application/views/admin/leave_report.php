    <style type="text/css">
    
    table{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000; }
    .tc-container{width: 100%;position: relative; text-align: center;margin-bottom:60px;padding-bottom: 5px;}
    .denifittable th{}
    .denifittable th,
    .denifittable td {border: 1px solid #000;
    border-collapse: collapse;border-left: 1px solid #999;}
    
    .denifittable tr th {font-size: 12px; font-weight: normal; width:10px; text-align:center;}
    .denifittable tr td { font-weight: normal; font-size: 12px;width:10px;}
    </style>
    
    
    
    <div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small><?php echo $this->lang->line('by_date1'); ?></small></h1>
    </section> 
    <!-- Main content -->
    <section class="content">
 
    <div class="row">
    <div class="col-md-12">
    <div class="box removeboxmius">
    <div class="box-header ptbnull"></div>
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
    </div>
    
    
    <form id='form1' action="<?php echo site_url('admin/leave_management/leave_management_view') ?>"  method="post" accept-charset="utf-8">
    <div class="box-body">
        <?php
        /* if ($this->session->flashdata('msg')) {?>
        <?php echo $this->session->flashdata('msg') ?>
        <?php }
        */
        ?>
    
    <?php echo $this->customlib->getCSRF(); ?>
    <div class="row">
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
    <select autofocus="" id="class_id" name="class_id" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    <?php
    foreach ($classlist as $class) {
    ?>
    <option value="<?php echo $class['id'] ?>" <?php
    if (set_value('class_id') == $class['id']) {
    echo "selected =selected";
    }
    ?>><?php echo $class['class'] ?></option>
    <?php
    $count++;
    }
    ?>
    </select>
    <span class="text-danger"  style="background-color:green;"><?php echo form_error('class_id'); ?></span>
    </div>
    </div>
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
    <select  id="section_id" name="section_id" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    </select>
    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
    </div>
    </div>
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1">
    
    <?php echo $this->lang->line('month') ?>
    </label><small class="req"> *</small>
    <select  id="month" name="month" class="form-control" >
    <option value=""><?php echo $this->lang->line('select'); ?></option>
    <?php
    foreach ($monthlist as $m_key => $month) {
    ?>
    <option value="<?php echo $m_key ?>" <?php echo set_select('month', $month, set_value('month')) ?>><?php echo $month; ?></option>
    <?php
    }
    ?>
    </select>
    <span class="text-danger"><?php echo form_error('month'); ?></span>
    </div>
    </div>
    
    
    <div class="col-md-3">
    <div class="form-group">
    <label for="exampleInputEmail1">
    
    <?php echo $this->lang->line('year') ?>
    </label>
    <select  id="year" name="year" class="form-control" >
    <?php
    foreach ($yearlist as $y_key => $year) 
    {
    ?>
    <option value="<?php echo $year["year"] ?>"><?php echo $year["year"]; ?></option>
    <?php
    }
    ?>
    </select>
    <span class="text-danger"><?php echo form_error('year'); ?></span>
    </div>
    </div>
    
    
    <div class="col-md-12">
    <div class="form-group">
    <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
    </div>  
    </div>  
    
    </div>
    </div>
    </form>
    
 
    
    <div class="">
    <div class="box-header ptbnull"></div>  
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('leave'); ?> <?php echo $this->lang->line('management'); ?></h3>
    <div class="box-tools pull-right">
    </div>
    </div>
    <div class="box-body">
        
     
         

        
     <div class="mailbox-messages table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('expense_list'); ?></div>
                            <div class="table-responsive"> 
                                <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo $this->lang->line('expense_list'); ?>">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('category'); ?>
                                            </th>
                                             <th><?php echo $this->lang->line('date'); ?>
                                            </th>
                                            
                                            <th><?php echo $this->lang->line('created'); ?>
                                            </th>
                                            
                                            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($resultlist as  $res)
                                        {
                                        
                                        ?>
                                         <tr>
                                            <td><?php  echo  $res['leave_category_name']; ?></td>
                                            <td><?php  echo $res['leave_catmanagement_date']; ?></td>
                                            <td><?php  echo $res['leave_catmanagement_created_at']; ?></td>
                                            <td>
                                                
                                            <a data-placement="left" href="<?php echo base_url(); ?>admin/leave_management/delete_leave/<?php echo $res['leave_catmanagement_id'].'/'.$res['leave_catmanagement_class'].'/'.$res['leave_catmanagement_section'].'/'.$res['leave_catmanagement_date']; ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
                                            <i class="fa fa-remove"></i>
                                            </a> 
                                            </td>
                                           
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>  

                        </div>
                       
         </div>
    </div>
    </div>
    </div>  
    </div>
    </div> 
    
    </div>
  
    
    </section>
   
    <script type="text/javascript">
    function printDiv() 
    {
    var divToPrint=document.getElementById('Tableprint');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
    }
    </script>
    <?php
    
    function getAttendance($array, $student_session_id) {
    if (!empty($array)) {
    return $array[$student_session_id];
    }
    }
    
    function getattendencetype($attendencetype, $find) 
    {
    foreach ($attendencetype as $attendencetype_key => $attendencetype_value) {
    if ($attendencetype_value['id'] == $find) {
    return $attendencetype_value['key_value'];
    }
    }
    return false;
    }
    ?>
    
    
    <script type="text/javascript">
    $(document).ready(function () 
    {
    var section_id_post = "<?php echo set_value('section_id'); ?>";
    var class_id_post = "<?php echo set_value('class_id'); ?>";
    var date_post = "<?php echo set_value('date'); ?>";
    var subject_timetable_id = "<?php echo set_value('subject_timetable_id', 0); ?>";
    populateSection(section_id_post, class_id_post);
    
    function populateSection(section_id_post, class_id_post) {
    if (section_id_post != "" && class_id_post != "") {
    
    $('#section_id').html("");
    
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    $.ajax({
    type: "GET",
    url: baseurl + "sections/getByClass",
    data: {'class_id': class_id_post},
    dataType: "json",
    success: function (data) {
    $.each(data, function (i, obj)
    {
    var select = "";
    if (section_id_post == obj.section_id) {
    var select = "selected=selected";
    }
    div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
    });
    $('#section_id').append(div_data);
    }
    });
    }
    }
    
    
    
    $(document).on('change', '#class_id', function (e) {
    $('#section_id').html("");
    var class_id = $(this).val();
    
    var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
    var url = "";
    $.ajax({
    type: "GET",
    url: baseurl + "sections/getByClass",
    data: {'class_id': class_id},
    dataType: "json",
    success: function (data) {
    $.each(data, function (i, obj)
    {
    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
    });
    $('#section_id').append(div_data);
    }
    });
    });
    });
    </script>
