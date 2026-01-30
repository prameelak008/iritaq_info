            <style>


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









            /* The switch - the box around the slider */
            .switch {
            position: relative;
            display: inline-block;
            width: 38px;
            height: 19px;  /*greyarea height*/
            }

            /* Hide default HTML checkbox */
            .switch input {
            opacity: 0;
            width: 0;
            height: 0;
            }

            /* The slider */
            .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            }

            .slider:before {
            position: absolute;
            content: "";
            height: 12px;   /* round-icon height and width*/ 
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            }

            input:checked + .slider {
            background-color: #08c447;
            }

            input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(18px);
            }

            /* Rounded sliders */
            .slider.round {
            border-radius: 27px;
            }

            .slider.round:before {
            border-radius: 50%;
            }
            </style>

            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('academics'); ?></h1>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('subject_paper', 'can_add') || $this->rbac->hasPrivilege('subject_paper', 'can_edit')) {
            ?>
            <div class="col-md-4">
            <!-- Horizontal Form -->
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><?php echo ('Edit Subject Paper'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->

            <form action="<?php echo site_url("admin/subjectpaper/edit/" . $subjectpaper_id ) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
            <div class="box-body">

            <?php
            /* if ($this->session->flashdata('msg')) {?>
            <?php echo $this->session->flashdata('msg') ?>
            <?php }
            */
            ?>
            <?php
            if (isset($error_message)) {
            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
            }
            ?>  
             
            <?php echo $this->customlib->getCSRF(); ?>                       
            <input name="subjectpaper_id  " type="hidden" class="form-control"  value="<?php echo set_value('subjectpaper_id ', $subjectpaperedit['subjectpaper_id']); ?>" required />

            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Select Course'); ?></label> <small class="req">*</small><br>
            <select class="form-control js-example-basic-single" name="subjectid" id="subjectid" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            <?php foreach ($subjects as $subs) {
            ?>
            <option value="<?php echo $subs['id'] ?>" <?php if ($subjectpaperedit['subjectpaper_subjectid'] == $subs['id']) { echo "selected=selected"; } ?>><?php echo $subs['name'] ?></option> 
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('courseid'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Subject/Paper Code'); ?></label> <small class="req">*</small><br>
            <input type="text" name="papercode" id="papercode" class="form-control" value="<?php echo set_value('papercode ', $subjectpaperedit['subjectpaper_papercode']); ?>" >
            <span class="text-danger"><?php echo form_error('papercode'); ?></span>
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Subject/Paper Name'); ?></label> <small class="req">*</small><br>
            <input type="text" name="papername" id="papername" class="form-control" value="<?php echo set_value('papername ', $subjectpaperedit['subjectpaper_papername']); ?>" >
            <span class="text-danger"><?php echo form_error('papername'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Subject/Paper Name').'&nbsp; -'. $this->lang->line('arabic'); ?></label> <small class="req">*</small><br>
            <input type="text" name="arabic_papername" id="arabic_papername" class="form-control" value="<?php echo set_value('arabic_papername ', $subjectpaperedit['subjectpaper_arabicpaper']); ?>" >
            <span class="text-danger"><?php echo form_error('arabic_papername'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Subject/Paper Type'); ?></label> <small class="req">*</small><br><br>
            <label class="radio-inline">
            <input type="radio" value="Compulsory" name="papertype"  <?php if ($subjectpaperedit['subjectpaper_papertype'] == "Compulsory") echo "checked"; ?> checked><?php echo $this->lang->line('compulsory'); ?>
            </label>
            <label class="radio-inline">
            <input type="radio" name="papertype" <?php if ($subjectpaperedit['subjectpaper_papertype'] == "Elective") echo "checked"; ?> value="Elective"><?php echo $this->lang->line('elective'); ?>
            </label>
            </div>

            <div class="form-group" id="parentsubject">
            <label for="exampleInputEmail1"><?php echo ('Parent Subject'); ?></label> <br>
            <input type="text" name="parentsubject" id="parentsubject" class="form-control" value="<?php echo set_value('parentsubject ', $subjectpaperedit['subjectpaper_parentsubject']); ?>" >
            <span class="text-danger"><?php echo form_error('parentsubject'); ?></span>
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Credit'); ?></label> <br>
            <input type="text" name="credit" id="credit" class="form-control" value="<?php echo set_value('credit ', $subjectpaperedit['subjectpaper_credit']); ?>" >
            <span class="text-danger"><?php echo form_error('credit'); ?></span>
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo ('Credit Hours'); ?></label> <br>
            <input type="text" name="credithours" id="credithours" class="form-control" value="<?php echo set_value('credithours ', $subjectpaperedit['subjectpaper_credithours']); ?>" >
            <span class="text-danger"><?php echo form_error('credithours'); ?></span>
            </div>


            <hr class="hr-text" data-content="GRADE SCHEME  ">
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('CE'); ?> </label>
            <input type="text" name="ce_max_marks" id="ce_max_marks" class="form-control" value="<?php echo set_value('ce_max_marks ', $subjectpaperedit['subjectpaper_ce_max_mrks']); ?>"/>
            <span class="text-danger"><?php echo form_error('ce_max_marks'); ?></span>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('TE'); ?> </label>
            <input type="text" name="te_max_marks" id="te_max_marks" class="form-control" value="<?php echo set_value('te_max_marks ', $subjectpaperedit['subjectpaper_te_max_mrks']); ?>"/>
            <span class="text-danger"><?php echo form_error('te_max_marks'); ?></span>
            </div>


            </div><!-- /.box-body -->

            <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('update'); ?></button>
            </div>
            </form>
            </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('subject_paper', 'can_add') || $this->rbac->hasPrivilege('subject_paper', 'can_edit')) {
            echo "8";
            } else {
            echo "12";
            }
            ?>">
            <!-- general form elements -->
            <div class="box box-primary">
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><?php echo ('Subject Paper List'); ?></h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            <div class="download_label"><?php echo ('Subject Paper List'); ?></div>
            <div class="mailbox-messages table-responsive">
            <table class="table table-striped table-bordered table-hover example">
            <thead>
            <tr>
            <th><?php echo ('Course'); ?> </th>
            <th><?php echo ('Paper Code'); ?> </th>
            <th><?php echo ('Paper Name'); ?> </th>
            <th><?php echo ('Paper Type'); ?> </th>
            <th><?php echo ('Parent Subject'); ?> </th>
            <th><?php echo ('Credit'); ?> </th>
            <th><?php echo ('Credit Hours'); ?> </th><th><?php echo $this->lang->line('CE'); ?> </th>
            <th><?php echo $this->lang->line('TE'); ?> </th>
            <th><?php echo ('Status'); ?> </th>
            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($subjectpaperList as $subjectpaper) {
            ?>
            <tr>
            <td class="mailbox-name">
            <?php echo $subjectpaper['name'] ?>                                     
            </td>
            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_papercode']; ?>

            </td>
            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_papername'];


            echo "<br>";
            echo "<br>";
            echo $subjectpaper['subjectpaper_arabicpaper'];
            
            ?>

            </td>
            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_papertype']; ?>

            </td>
            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_parentsubject']; ?>

            </td>
            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_credit']; ?>

            </td>
            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_credithours']; ?>

            </td>


            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_ce_max_mrks']; ?>
            </td>

            <td class="mailbox-name"> 
            <?php echo $subjectpaper['subjectpaper_te_max_mrks']; ?>
            </td>


            <td class="mailbox-name"> 
            <label class="switch">
            <input type="checkbox" class="checkboxstatus" name="checkboxstatus" value=""
            <?php if($subjectpaper['subjectpaper_status'] == 1) { echo "checked"; } ?>
            data-id="<?php echo $subjectpaper['subjectpaper_id'] ?>">
            <span class="slider round"></span>
            </label> 
            </td>



            <td class="mailbox-date pull-right">
            <?php
            if ($this->rbac->hasPrivilege('subject_paper', 'can_edit')) {
            ?>
            <a data-placement="left" href="<?php echo base_url(); ?>admin/subjectpaper/edit/<?php echo $subjectpaper['subjectpaper_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
            <i class="fa fa-pencil"></i>
            </a>
            <?php } ?>
            <?php
            if ($this->rbac->hasPrivilege('subject_paper', 'can_delete')) {
            ?>
            <a data-placement="left" href="<?php echo base_url(); ?>admin/subjectpaper/delete/<?php echo $subjectpaper['subjectpaper_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return doconfirm();" >
            <i class="fa fa-remove" style="color:#e52828;"></i>
            </a>
            <?php } ?>
            </td>

            </tr>
            <?php
            }
            ?>
            </tbody>
            </table><!-- /.table -->
            </div><!-- /.mail-box-messages -->
            </div><!-- /.box-body -->
            </div>
            </div><!--/.col (left) -->
            <!-- right column -->

            </div>
            <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
            </div>   <!-- /.row -->
            </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <script>

            $(document).ready(function() 
            {
            var selectedPaperType = $('input[name="papertype"]:checked').val();
            if(selectedPaperType=="Elective")
            {
            $('#parentsubject').show();   
            }
            else
            {
            $('#parentsubject').hide();    
            }


            $("input[name=papertype]").change(function(e) 
            {
            if ($(this).val() == 'Elective') {
            $('#parentsubject').show();
            }
            else {
            $('#parentsubject').hide();
            }
            });
            });


            $(document).ready(function() {
            $('.checkboxstatus').change(function() {
            var subjectPaperId = $(this).data('id');
            var status = this.checked ? 1 : 0; 

            var base_url = '<?php echo base_url() ?>';
            $.ajax({
            type: 'POST',
            url: base_url + 'admin/subjectpaper/changestatus',
            data: { subjectPaperId: subjectPaperId, status: status },
            success: function(response) {
            if (response.success) {
            window.location.reload();
            } else {
            // Handle the error
            }
            }
            });
            });
            });


            $(document).ready(function() {
            $('.js-example-basic-single').select2();
            });
            </script>