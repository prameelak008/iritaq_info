        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">
        
        <?php
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        $language = $this->customlib->getLanguage();
        $language_name = $language["short_code"];
        ?>


        <style type="text/css">
        @media print {
        .no-print {
        visibility: hidden !important;
        display:none !important;
        }
        }
        </style>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

        <section class="content-header">
        <h1>
        <i class="fa fa-usd"></i> <?php echo $this->lang->line('batch_semester'); ?></h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
        <?php
        // if ($this->rbac->hasPrivilege('batch', 'can_add')) {
        ?>
        <div class="col-md-4">
        <!-- Horizontal Form -->
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('batch_semester'); ?></h3>
        </div><!-- /.box-header -->



        <form method="post" action="<?php echo site_url('semester/batchsemester/edit/' . $id); ?>" enctype="multipart/form-data">

        <div class="box-body">  

        <?php echo $this->customlib->getCSRF(); ?> 
        
  

        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_type'); ?></label>
        <select name="batch_type" id="batch_type" class="form-control" >

        <?php
        foreach($batchlist as $bt)
        {        
        ?>
        <option value="<?php  echo $bt['b_id'];  ?>"
        <?php
        if($bt_sem['b_id']==$bt['b_id'])
        {
        echo  "selected=selected";
        }
        ?>        
        ><?php  echo $bt['b_name'];  ?></option>
        <?php } ?>
        </select>
        <span class="text-danger"><?php echo form_error('batch_type'); ?></span>
        </div>

        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_type'); ?></label>
        <select name="semester_type" id="semester_type" class="form-control" >
        <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
        <?php
        foreach($semestertype_list as $sem_type)
        {
        ?>
        <option value="<?php  echo $sem_type['st_id'];  ?>"

        <?php
        if($bt_sem['st_id']==$sem_type['st_id'])
        {
        echo "selected=selected";
        }
        ?>
        ><?php  echo $sem_type['st_name'];  ?></option>
        <?php } ?>
        </select>
        <!-- <span class="text-danger"><?php echo form_error('semester_type'); ?></span> -->
        </div>



        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester_no'); ?></label>
        <input id="semester_no"  name="semester_no" value="<?php  echo $bt_sem['bchsem_no'] ; ?>" placeholder="<?php echo $this->lang->line('semester_no'); ?>" type="text" class="form-control" />
        <!-- <span class="text-danger"><?php echo form_error('semester_no'); ?></span> -->
        </div>



        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('from'); ?></label>
        <input id="from_date"  name="from_date" value="<?php  echo $bt_sem['bchsem_from'] ; ?>"  placeholder="<?php echo $this->lang->line('from_date'); ?>" type="date" class="form-control" />
        <!-- <span class="text-danger"><?php echo form_error('from_date'); ?></span> -->
        </div>


        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('to'); ?></label>
        <input id="to_date"  name="to_date" value="<?php  echo $bt_sem['bchsem_to'] ; ?>"   placeholder="<?php echo $this->lang->line('to_date'); ?>" type="date"    class="form-control "  />
        <!-- <span class="text-danger"><?php echo form_error('to_date'); ?></span> -->
        </div> 

        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('capacity'); ?></label>
        <input id="capacity"  name="capacity" value="<?php  echo $bt_sem['bchsem_capacity'] ; ?>" placeholder="<?php echo $this->lang->line('capacity'); ?>" type="text" class="form-control"  />
        <!-- <span class="text-danger"><?php echo form_error('capacity'); ?></span> -->
        </div>
        </div>

        <div class="box-footer">
<button type="submit" class="btn btn-info pull-right"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo $this->lang->line('update'); ?></button>
        </div>
        </form>
        </div>



        </div><!--/.col (right) -->
        <!-- left column -->
        <?php //} ?>
        <div class="col-md-<?php
        if ($this->rbac->hasPrivilege('batch', 'can_add')) {
        echo "8";
        } else {
        echo "12";
        }
        ?>">
        <!-- general form elements -->
        <div class="box box-primary">
        <div class="box-header ptbnull">
        <h3 class="box-title titlefix"> <?php echo $this->lang->line('batch'); ?></h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">

        <div class="table-responsive mailbox-messages">
        <table class="table table-striped table-bordered table-hover example">
        <thead>
        <tr>               
        <th><?php echo $this->lang->line('slno'); ?></th>
        <th><?php echo $this->lang->line('batch'); ?></th>

        <th><?php echo $this->lang->line('semester_type'); ?>  </th>

        <th><?php echo $this->lang->line('semester_no'); ?>
        </th>        

        <th><?php echo $this->lang->line('from'); ?>
        </th>
        <th><?php echo $this->lang->line('to'); ?>
        </th>   

        <th><?php echo $this->lang->line('capacity'); ?>
        </th>  

      
        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php
        $slno=1;          
        foreach($batch_semester as $bt_sem)
        {
        ?>
        <tr>
        <td><?php echo $slno; ?></td>          
        <td><?php  echo $bt_sem['b_name']; ?></td>
        <td><?php  echo $bt_sem['st_name']; ?></td>
        <td><?php  echo $bt_sem['bchsem_no']; ?></td>
        <td><?php  echo $bt_sem['bchsem_from']; ?></td>
        <td><?php  echo $bt_sem['bchsem_to']; ?></td>
        <td><?php  echo $bt_sem['bchsem_capacity']; ?></td>

       

        <td text-align="right">
        <a data-placement="left" href="<?php echo site_url('semester/batchsemester/edit/' . $bt_sem['bchsem_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
        <a data-placement="left" href="<?php echo site_url('semester/batchsemester/delete/' . $bt_sem['bchsem_id']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-trash trashstyle" ></i></a>
                    
            
</td>

        </tr>
        <?php 
        $slno++;
        } ?>
        </tbody>
        </table><!-- /.table -->
        </div><!-- /.mail-box-messages -->
        </div><!-- /.box-body -->
        </div>
        </div><!--/.col (left) -->
        <!-- right column -->
        </div>

        </section><!-- /.content -->
        </div><!-- /.content-wrapper -->









