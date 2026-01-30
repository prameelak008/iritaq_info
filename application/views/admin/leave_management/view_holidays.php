<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">

</style>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('view').'&nbsp;'.$this->lang->line('holiday');; ?> <small></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('view').'&nbsp;'.$this->lang->line('holiday'); ?></h3>
                    </div>
                    <div class="box-body">
                         <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/leave_management/view_holidays') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-3">
                                            <div class="form-group"> 
                                                <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div>  
                                        </div><!--./col-md-6-->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
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
    
    <!--./col-md-6-->

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>   
                                </div><!--./row-->
                            </div><!--./col-md-6-->
                          
                        </div>
                    </div>

                    <div class="box-header ptbnull"></div> 
                    <?php
                   
                    if (isset($resultlist)) {
                        ?>
                        <div class="nav-tabs-custom border0">
                          
                            <div class="tab-content">
                                <div class="download_label"> <?php echo $this->lang->line('disable') . " " . $this->lang->line('student') . " " . $this->lang->line('list') ?></div>
                                <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                    <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                            <th><?php echo $this->lang->line('category'); ?></th>
                                            <th><?php echo $this->lang->line('date'); ?></th>
                                            <th><?php echo $this->lang->line('month'); ?></th>
                                            <th class="pull-right"><?php echo $this->lang->line('action'); ?></th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                            <?php
                                            if (!empty($resultlist)) 
                                            {
                                            foreach($resultlist as $res=>$key)
                                            {
                                            ?>
                                            <tr>
                                            <td><?php echo $key['leave_category_name']; ?></td>
                                            <td><?php echo $key['leave_catmanagement_date']; ?></td>
                                            <td><?php echo date('l', strtotime($key['leave_catmanagement_date'])); ?></td>
                                            
                                            <td>
                                            <form name="form" method="POST" action="<?php echo site_url('admin/leave_management/remove_holiday'); ?>"/>
                                            <input type="hidden" name="id" value="<?php echo $key['leave_catmanagement_id']; ?>" />
                                            <input type="hidden" name="class" value="<?php echo $key['leave_catmanagement_class']; ?>" />
                                            <input type="hidden" name="section" value="<?php echo $key['leave_catmanagement_section']; ?>" />
                                            <input type="hidden" name="date" value="<?php echo $key['leave_catmanagement_date']; ?>" />
                                            <button type="submit" title="Delete holiday & Remove all holidays from attendences ." name="submit" onclick="return confirm('Do you want to delete holiday.It will remove all attendence holidays from these days ?')" /><i class="fa fa-trash" style="color:red;"></i></button>
                                            </form>
                                            </td>
                                            </tr>
                                            <?php
                                            $count++;
                                                }
                                            
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>                           
                                                                                         
                                                                </div>                                                         
                                                                </div>

                                                                </div><!--./box box-primary-->    
    <?php
}
?>
                                                            </div>  
                                                            </div> 
                                                            </section>
                                                            </div>
                                                            <script type="text/javascript">
                                                                function getSectionByClass(class_id, section_id) {
                                                                    if (class_id != "" && section_id != "") {
                                                                        $('#section_id').html("");
                                                                        var base_url = '<?php echo base_url() ?>';
                                                                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                                                        $.ajax({
                                                                            type: "GET",
                                                                            url: base_url + "sections/getByClass",
                                                                            data: {'class_id': class_id},
                                                                            dataType: "json",
                                                                            success: function (data) {
                                                                                $.each(data, function (i, obj)
                                                                                {
                                                                                    var sel = "";
                                                                                    if (section_id == obj.section_id) {
                                                                                        sel = "selected";
                                                                                    }
                                                                                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                                                                                });
                                                                                $('#section_id').append(div_data);
                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                                $(document).ready(function () {
                                                                    var class_id = $('#class_id').val();
                                                                    var section_id = '<?php echo set_value('section_id') ?>';
                                                                    getSectionByClass(class_id, section_id);
                                                                    $(document).on('change', '#class_id', function (e) {
                                                                        $('#section_id').html("");
                                                                        var class_id = $(this).val();
                                                                        var base_url = '<?php echo base_url() ?>';
                                                                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                                                                        $.ajax({
                                                                            type: "GET",
                                                                            url: base_url + "sections/getByClass",
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
                                                                $(document).ready(function () {
                                                                    $('.detail_popover').popover({
                                                                        placement: 'right',
                                                                        title: '',
                                                                        trigger: 'hover',
                                                                        container: 'body',
                                                                        html: true,
                                                                        content: function () {
                                                                            return $(this).closest('td').find('.fee_detail_popover').html();
                                                                        }
                                                                    });
                                                                });
                                                            </script>