
            <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">  
            -->

            <style>
            .toggle-big {
            font-size: 24px !important;   /* make button icon bigger */
            padding: 8px 12px !important; /* increase button clickable area */
            border-radius: 6px;
            }
            .toggle-big i {
            font-size: 28px !important;   /* bigger toggle icon */
            color: #d9534f !important;    /* red inactive */
            }
            </style>

            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            ?>
            <div class="content-wrapper">
            <section class="content-header">
            <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> 
            <small><?php echo $this->lang->line('student1'); ?></small>
            </h1>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="col-md-12">
            <?php $this->load->view('layout/topbar_enrollment'); ?>
            </div>
            &nbsp;



            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">
            <i class="fa fa-search"></i> <?php echo $this->lang->line('disable'); ?>
            </h3>
            </div>


            <div class="box-body">
            <form role="form" action="<?php echo site_url('semester_enrollment/enroll/disablestudentslist') ?>" method="post" class="class_search_form">
            <div class="promotion-grid">
            <!-- Selection Section -->
            <div class="section-card">
            <div class="section-title"><?php echo $this->lang->line('disable'); ?></div>

            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <label>Program Type / Program <small class="req">*</small></label>
            <select id="program" name="program" class="form-control">
            <option value="">-- Select Program --</option>
            <?php 
            $programs_by_type = [];
            foreach ($programs as $p) {
            $tid = isset($p['prog_type_id']) ? $p['prog_type_id'] : null;
            if ($tid === null) continue;
            if (!isset($programs_by_type[$tid])) $programs_by_type[$tid] = [];
            $programs_by_type[$tid][] = $p;
            }
            foreach ($program_types as $type) {
            echo '<optgroup label="'.htmlspecialchars($type['prog_type_name']).'">';
            $list = isset($programs_by_type[$type['prog_type_id']]) ? $programs_by_type[$type['prog_type_id']] : [];
            if (!empty($list)) {
            foreach ($list as $prog) {
            echo '<option value="'.$prog['p_id'].'" '.set_select('program', $prog['p_id']).'>'
            .htmlspecialchars($prog['p_name']).'</option>';
            }
            } else {
            echo '<option value="" disabled>-</option>';
            }
            echo '</optgroup>';
            }
            ?>
            </select>
            <span class="text-danger"><?php echo form_error('program'); ?></span>
            </div>
            </div>

            <!-- Semester / Batch / Term -->
            <div class="col-md-6">
            <div class="form-group">
            <label>Semester / Batch / Term <small class="req">*</small></label>
            <select id="semester" name="semester" class="form-control">
            <option value="">-- Select Semester / Term / Batch --</option>
            <?php 
            $current_type = '';
            foreach ($semesters_batches as $sem): 
            if ($current_type != $sem['st_name']) {
            if ($current_type != '') echo '</optgroup>';
            echo '<optgroup label="' . htmlspecialchars($sem['st_name']) . '">';
            $current_type = $sem['st_name'];
            }
            $value = $sem['sem_group_semester'] . '|' . $sem['sem_group_batchgroup'] . '|' . $sem['sem_group_semester_term'];
            ?>
            <option value="<?php echo $value; ?>" <?php echo set_select('semester', $value); ?>>
            <?php echo $sem['stm_name'] . ' - ' . $sem['batch_group_year']; ?>
            </option>
            <?php endforeach; ?>
            <?php if ($current_type != '') echo '</optgroup>'; ?>
            </select>
            <span class="text-danger"><?php echo form_error('semester'); ?></span>
            </div>
            </div>
            </div>

            </div>
            </div>

            <div class="col-md-12">
            <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
            <i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?>
            </button>
            </div>
            </div>
            </div>
            </div> 
            </form>
            </div>
            </div>

            <?php  
            if (isset($disable_students)) 
            {
            ?>
            <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
            <div class="nav-tabs-custom border0 navnoshadow">
            <div class="box-header with-border">
            <h3 class="box-title">
            <i class="fa fa-search"></i> <?php echo  $this->lang->line('disable').'&nbsp;&nbsp;'.$this->lang->line('student_list'); ?>
            </h3>
            </div>

            <div class="box-body">
            <div class="table-responsive mailbox-messages">        
            <table class="table table-striped table-bordered table-hover example">           
            <thead>
            <tr>          
            <th><?php echo $this->lang->line('admission_no'); ?></th>
            <th><?php echo $this->lang->line('roll_no'); ?></th>
            <th><?php echo $this->lang->line('student_name'); ?></th>
            <th><?php echo $this->lang->line('gender'); ?></th>
            <th><?php echo $this->lang->line('father_name'); ?></th>
            <th><?php echo $this->lang->line('current_address'); ?></th>
            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
            <th><?php echo $this->lang->line('action'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($disable_students as $stud)
            {
            ?>
            <tr>
            <td>         
            <td><?php echo $stud['admission_no']; ?></td>
            <td><?php echo $stud['roll_no']; ?></td>
            <td><?php echo $stud['firstname']; ?></td>              
            <td><?php echo $stud['gender']; ?></td>
            <td><?php echo $stud['father_name']; ?></td>
            <td><?php echo $stud['current_address']; ?></td>
            <td><?php echo $stud['dob']; ?></td>
            <td class="">
            <a data-placement="left" href="<?php echo base_url(); ?>semester_enrollment/Enroll/view/<?php echo $stud['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('show'); ?>" >
            <i class="fa fa-reorder"></i>
            </a>
            </td>

            </tr> 
            <?php } ?>
            </tbody>
            </table>           
            </div>
          
            </div>
            </div><!--./box box-primary -->
            <?php
            }
            ?>
            </div>
            </div>
            </section>
            </div>




            <script>
            function resetFields(search_type)
            {
            if(search_type == "search_full"){
            $('#class_id').prop('selectedIndex',0);
            $('#section_id').find('option').not(':first').remove();
            }else if (search_type == "search_filter") {

            $('#search_text').val("");
            }
            } 
            
            
           

                    $(document).ready(function ()
                    {
                    $("#select_all").on("click", function () {
                    $(".allcheckbox").prop("checked", this.checked);
                    });

                    $(".allcheckbox").on("change", function () {
                    $("#select_all").prop(
                    "checked",
                    $(".allcheckbox:checked").length === $(".allcheckbox").length
                    );
                    });

                    $("#delete_selected").on("click", function () {

                    var ids = [];

                    $(".allcheckbox:checked").each(function () {
                    ids.push($(this).val());
                    });

                    alert(ids);

                    if (ids.length === 0) {
                    alert("Please select at least one student.");
                    return;
                    }

                    if (confirm("Are you sure you want to delete selected students?")) {

                    $.ajax({
                    url: "<?php echo base_url('semester_enrollment/Enroll/delete_data'); ?>",
                    type: "POST",
                    data: { ids: ids },
                    dataType: "json",
                    success: function (response) {

                    console.log(response);

                    if (response.status === "success") {
                    alert("Deleted Successfully");
                    location.reload();
                    } else {
                    alert("Error: " + response.status);
                    console.log(response);
                    }

                    },
                    error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("AJAX error occurred");
                    }
                    });

                    }
                    });
                    }); 
                    
                   
                    

          
                $(document).on("click", ".toggle-status-btn", function () {

                let student_id = $(this).data("id");
                let current_status = $(this).data("status");
                let new_status = current_status == 1 ? 0 : 1;
                let button = $(this);

                $.ajax({
                url: "<?php echo base_url('admin/semester_student/update_status'); ?>",
                type: "POST",
                data: {
                id: student_id,
                status: new_status
                },
                success: function (res) {

                button.data("status", new_status);

                if (new_status == 1) {
                button.html('<i class="fa fa-toggle-on text-success"></i>');
                } else {
                button.html('<i class="fa fa-toggle-off text-danger"></i>');
                }
                }
                });
                });


                

          
            </script>