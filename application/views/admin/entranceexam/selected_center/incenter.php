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
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('Center'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- <?php
            // if ($this->rbac->hasPrivilege('income', 'can_add')) {
                ?> -->
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary" style="padding-bottom: 100px">
                        <div class="box-header with-border">
                              <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp;'. $this->lang->line('center'); ?></h3>
                        </div><!-- /.box-header -->

                        <form id="form1" action="<?php echo site_url('EntranceExam/add_selcenter'); ?>"  id="centerform" name="centerform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                              <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
                            
                                <!-- <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                  -->
 
 
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo ('Course'); ?><small class="req"> *</small></label>
                                    <select class="form-control" name="centre_course" id="centre_course" >
                                        <option value="">Select Course</option>
									<?php foreach($courselist as $crslist){ ?>
									<option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if(set_value('inst_course')==$crslist['entranceexam_course_id'])
									{
									echo "selected=selected";
									}?>><?php echo $crslist['entranceexam_course_name']; ?></option>
									<?php } ?>
									</select>
									 <span class="text-danger"><?php echo form_error('centre_course'); ?></span>
									 
                                    <!-- <?php
                                        $count = 0;
                                        foreach ($courselist as $crslist) { ?>
                                    <input type="text" name="inst_course" placeholder="Course" class="form-control" value="<?php echo $crslist['entranceexam_course_name']; ?>" required>
                                    <?php
                                        $count++;
                                        }
                                        ?> -->
                                     </div>
                                     
                                     
                                     
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('phase'); ?><small class="req"> *</small></label>
                                    <select name="phase" id="phase" class="form-control" >
                                    <option  value="">Select Phase</option>
                                    <?php
                                    foreach($get_phase as $phse)
                                    {
                                    ?>
                                    <option value="<?php echo $phse['entrance_examgroup_id']; ?>"
                                    <?php 
                                    if(set_value('phase')==$phse['entrance_examgroup_id'])
                                    {
                                    echo "selected=selected";
                                    }
                                    ?> > <?php
                                    echo $phse['entrance_examgroup_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('phase'); ?></span>
                                    </div> 
                                     
                                     
                                    <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('session'); ?><small class="req"> *</small></label>
                                    <select name="session" id="session" class="form-control">
                                    <?php
                                    foreach($sessionlist as $session)
                                    {
                                    ?>
                                    <option value="<?php echo $session['id'] ?>" <?php
                                    if ($current_entrancesession['cur_session'] == $session['id']) 
                                    {
                                    echo "selected=selected";
                                    }
                                    ?>><?php   echo $session['session']; ?></option>
                                    <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('session'); ?></span>
                                    </div>
                                     
                               
 								
                                <!--<div class="form-group">-->
                                <!--    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>-->
                                <!--    <input type="text" name="c_name" placeholder="Name" class="form-control"  required>-->
                                <!--    <span class="text-danger"><?php echo form_error('name'); ?></span>-->
                                <!--</div>-->
                                
                              
                            
                            
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?><small class="req"> *</small></label>
                                <select name="c_name" id="c_name" class="form-control" "required "/>
                                <option value="">Select Center</option>
                                <?php
                                foreach($centerlist as $cent)
                                {
                                ?>
                                <option value="<?php echo $cent['entranceexam_centreid'];?>"><?php echo $cent['entranceexam_centrename'];?></option>
                                <?php }?>
                                </select>
                                <span class="text-danger"><?php echo form_error('c_name'); ?></span>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('seat'); ?><small class="req"> *</small></label>
                                <input type="text" name="c_seat" placeholder="" class="form-control" required>
                                <span class="text-danger"><?php echo form_error('c_seat'); ?></span>
                                </div>
                                
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
           <!--  <?php // } ?> -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('center').'&nbsp;'.$this->lang->line('list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       
                        <div class="table-responsive mailbox-messages">
                                 <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Center List'); ?>">
                                <thead>
                                    <tr>
                                        
                                        <th><?php echo $this->lang->line('session'); ?>
                                        </th>
                                        
                                        <th><?php echo $this->lang->line('phase'); ?></th>
                                        
                                        <th><?php echo $this->lang->line('name'); ?>
                                        </th>
                                         <th><?php echo $this->lang->line('seat'); ?></th>
                                           <th>Course</th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	 <?php
										$count = 0;
										foreach ($get_all_centerlist as $ctrlist) { ?>
										    <tr> 
										    
										     <td><?php echo $ctrlist['session']; ?></td>
										    <td><?php echo $ctrlist['entrance_examgroup_name']; ?></td>
										    <td><?php echo $ctrlist['entranceexam_centrename']; ?></td>
										    <td><?php echo $ctrlist['sel_entranceexam_centreseat']; ?></td>
										     <td><?php  echo $ctrlist['entranceexam_course_name']; ?></td>
										    <td align="right">
                                                <a data-placement="left" href="<?php echo site_url('EntranceExam/edit_selcenter/' . $ctrlist['sel_entranceexam_centreid']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                                <a data-placement="left" href="<?php echo site_url('EntranceExam/delete_selcenter/' . $ctrlist['sel_entranceexam_centreid']); ?>" onclick="return doconfirm();"   class="btn btn-default btn-xs"   data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove" style="color:#cb1515;"></i></a>
                                            </td>
										    </tr>                                                   
										    <?php
										$count++;
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

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
  
  





