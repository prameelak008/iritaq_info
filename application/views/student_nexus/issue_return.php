                    <?php
                    $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
                    ?>
                    <div class="content-wrapper">
                    <section class="content-header">
                    <h1>
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
                    </section>
                    <!-- Main content -->
                    <section class="content">

                    <div class="col-md-12">
                    <?php
                    $this->load->view('layout/topbar_studentnexus'); ?>
                    </div>
                    &nbsp;
                    <div class="row">
                    <div class="col-md-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('library'); ?></h3>
                    </div>


                    <div class="box-body">
                    <div class="promotion-grid">
                    <!-- Selection Section -->
                    <div class="section-card">
                    <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                    <table class="table table-striped table-bordered table-hover " data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
                    <thead>
                    <tr>
                    <th><?php echo $this->lang->line('library_card_no'); ?></th>
                    <th><?php echo $this->lang->line('admission_no'); ?></th>
                    <th><?php echo $this->lang->line('roll_no'); ?></th>
                    <th><?php echo $this->lang->line('student_name'); ?></th>
                    <th><?php echo $this->lang->line('father_name'); ?></th>
                    <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                    <th><?php echo $this->lang->line('gender'); ?></th>
                    <th><?php echo $this->lang->line('mobile_no'); ?></th>
                    <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($students as $stud)
                    {
                    ?>
                    <tr>
                    <td><?php echo $stud['library_card_no']; ?></td>     
                    <td><?php echo $stud['admission_no']; ?></td>
                    <td><?php echo $stud['roll_no']; ?></td>
                    <td><?php echo $stud['firstname']; ?></td> 
                    <td><?php echo $stud['father_name']; ?></td>
                    <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($stud['dob'])); ?></td>
                    <td><?php echo $stud['gender']; ?></td>
                    <td><?php echo $stud['mobileno']; ?></td>
                    <td class="mailbox-date pull-right">
                    <a href="<?php echo base_url(); ?>student_nexus/library/issue/<?php echo $stud['libarary_member_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('issue_return'); ?>">
                    <i class="fa fa-sign-out"></i>
                    </a>
                    </td>
                    <?php
                    // if ($stud['libarary_member_id'] == 0) {
                    ?>

                    <!-- <button data-placement="left"  data-stdid="<?php echo $stud['id'] ?>" class="btn btn-default btn-xs add-student"  data-toggle="tooltip" title="<?php echo $this->lang->line('add'); ?>" >
                    <i class="fa fa-sign-out"></i>
                    </button> -->

                    <?php
                    /*
                    } else {
                    ?>
                    <button data-placement="left" type="button" class="btn btn-default btn-xs surrender-student" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.." data-toggle="tooltip" data-memberid="<?php echo $member_id; ?>" title="<?php echo $this->lang->line('surrender_membership'); ?>"><i class="fa fa-mail-reply"></i></button>

                    <?php
                    }
                    */
                    ?>

                    </th>                
                    </tr>                    

                    <?php } ?>

                    </tbody>
                    </table>
                    </div>

                    </div><!--./col-md-6-->
                    </div>            

                    </div>

                    </div>
                    </div>
                    </div>         

                    </div>
                    </div>
                    </section>
                    </div>


                   