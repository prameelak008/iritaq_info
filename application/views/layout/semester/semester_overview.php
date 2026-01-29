<div class="row">
    <div class="col-md-12">
        <div class="box box-primary border0 mb0 margesection">
            <div class="box-header with-border">
                <h6 class="box-title">
                    <i class="fa fa-view"></i>  
                    <?php echo $this->lang->line('view').'&nbsp;'.$this->lang->line('history'); ?>
                </h6>

                <div class="row">
                    <!-- Program dropdown -->
                    <div class="col-md-4">
                        <div class="form-group">           
                            <?= dropdownlist_program($programs, set_value('prog_id')); ?>
                            <span class="text-danger"><?= form_error('prog_id'); ?></span>
                        </div> 
                    </div>

                    <!-- Batch/Semester dropdown -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                            <select id="sem_type" name="sem_type" class="form-control">
                                <option value="">-- Select Batch & Semester --</option>
                            </select>
                        </div>
                    </div>
                </div> <!-- end inner row -->

            </div> <!-- end box-header -->
        </div> <!-- end box -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->