<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('section', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        
                        <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('edit').'&nbsp;'.$this->lang->line('category'); ?></h3>
                        </div>
                        
                        
                        <form action="<?php echo site_url("admin/leave_category/edit/".$id) ?>"  name="leave_category" method="post" accept-charset="utf-8">
                            <div class="box-body">
                               <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>

                                <?php echo $this->customlib->getCSRF(); ?>
                                
                                
                                <input type="hidden" name="id" value="<?php echo $category['leave_category_id'];  ?>"/>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('category'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="category" name="category" placeholder="" type="text" class="form-control"  value="<?php echo set_value('category',$category['leave_category_name']); ?>" />
                                    <span class="text-danger"><?php echo form_error('category'); ?></span>
                                </div>
                                
                                
                                   <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('shortname'); ?> </label><small class="req"> *</small>
                                    <input autofocus="" id="shortname" name="shortname" placeholder="" type="text" class="form-control"  value="<?php echo set_value('shortname',$category['leave_category_shortname']); ?>" />
                                    <span class="text-danger"><?php echo form_error('shortname'); ?></span>
                                   </div>
                                
                                 <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?> </label>
                                    <textarea class="form-control"  name="description" id="description" rows="10" cols="10"><?php echo set_value('description',$category['leave_category_description']); ?></textarea>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('color'); ?> </label><small class="req"> *</small>
                                    
                                     <input type="color" id="favcolor" class="form-control" name="favcolor" value="<?php echo set_value('#cfcece',$category['leave_category_favcolor']); ?>">
                                    
                                    <span class="text-danger"><?php echo form_error('color'); ?></span>
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
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('category').''.$this->lang->line('list'); ?></h3>
                    </div>
                    <div class="box-body ">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('category').''.$this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                         <th><?php echo $this->lang->line('category'); ?></th>
                                         <th><?php echo $this->lang->line('shortname'); ?></th>
                                         <th><?php echo $this->lang->line('description'); ?></th>
                                         <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>                                   

                                    <?php
                                    $count = 1;
                                    foreach ($categorylist as $category) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $category['leave_category_name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $category['leave_category_shortname'] ?></td>
                                            <td class="mailbox-name"> <?php echo $category['leave_category_description'] ?></td>
                                            
                                            
                                            <td class="mailbox-date pull-right">
                                                <?php
                                                if ($this->rbac->hasPrivilege('section', 'can_edit')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/leave_category/edit/<?php echo $category['leave_category_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php
                                                }
                                                if ($this->rbac->hasPrivilege('section', 'can_delete')) {
                                                    ?>
                                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/leave_category/delete/<?php echo $category['leave_category_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this category?');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                <?php } ?>
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