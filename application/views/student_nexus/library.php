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
                <form role="form" action="<?php echo site_url('student_nexus/library') ?>" method="post" class="class_search_form">
                <div class="promotion-grid">
                <!-- Selection Section -->
                <div class="section-card">
                <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

                <div class="row">
                <div class="col-md-12">


                <div class="row">
                <?php echo $this->customlib->getCSRF(); ?>

                <div class="col-md-6">
                <div class="form-group">
                <label>Program Type / Program <small class="req">*</small></label>
              



                <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
                <span class="text-danger"><?php echo form_error('program'); ?></span>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label>Semester / Batch / Term <small class="req">*</small></label>

                <?php
                echo render_semester_dropdown($semesters_batches, set_value('semester'));
                ?>

                </div>
                </div>
                </div>
                </div>

               

                </div>
                </div><!--./col-md-6-->
                </div>

                <div class="col-md-12">
                <div class="row">

                <div class="col-sm-12">
                <div class="form-group">
                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
                <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('search'); ?>
                </button>
                </div>
                </div>


                </div>
                </div> 

                </div>
                </form>                    
                </div>
                </div>
                </div>

                <?php               
                

                if (isset($students)) 
                {
                ?>
                <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
                <div class="nav-tabs-custom border0 navnoshadow">
                <div class="box-header ptbnull"><?php echo $this->lang->line('library'); ?></div>

                <ul class="nav nav-tabs">
                <br>        
                </ul>
                <div class="tab-content">
                <div class="tab-pane active table-responsive no-padding" id="tab_1">

                    <table class="table table-striped table-bordered table-hover student-list-tab1" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
                    <thead>
                    <tr>
                    <th><?php echo $this->lang->line('slno'); ?> </th>
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

              
                    $slno=1;
                    foreach($students as $stud)
                    {
                    $clsactive = "a";
                    $member_id = "";
                    $library_card_no = "";                  
                    ?>


                    <tr>
                    <td><?php echo $slno++; ?></td>
                    <td><?php echo $stud['library_card_no']; ?></td> 
                    <td><?php echo $stud['admission_no']; ?></td>
                    <td><?php echo $stud['roll_no']; ?></td>
                    <td><?php echo $stud['firstname']; ?></td> 
                    <td><?php echo $stud['father_name']; ?></td>
                    <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($stud['dob'])); ?></td>
                    <td><?php echo $stud['gender']; ?></td>
                    <td><?php echo $stud['mobileno']; ?></td>


                    <td class="text text-right">
                        <?php                      
                        
                         if ($stud['libarary_member_id'] == '') {
                            ?>

                            <button data-placement="left"  data-stdid="<?php echo $stud['id'] ?>" class="btn btn-default btn-xs add-student"  data-toggle="tooltip" title="<?php echo $this->lang->line('add'); ?>" >
                                <i class="fa fa-plus"></i>
                            </button>

                            <?php
                         
                        } else {
                            ?>
                            <button data-placement="left" type="button" class="btn btn-default btn-xs surrender-student" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.." data-toggle="tooltip" data-memberid="<?php echo $member_id; ?>" title="<?php echo $this->lang->line('surrender_membership'); ?>"><i class="fa fa-mail-reply"></i></button>

                            <?php
                        }
                            
                        ?>
                    </td>        
                    </tr>                   

                    <?php             

                    } 
                    ?>

                    </tbody>
                    </table>


                

   <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="window.location.reload(true);" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="lineModalLabel"><?php echo $this->lang->line('add_member'); ?></h4>
            </div>
            <div class="modal-body">

                <input type="hidden" name="click_member_id" value="0" id="click_member_id">
                <!-- content goes here -->
                <form action="<?php echo site_url('student_nexus/library/add') ?>" id="add_member" method="post">
                    <input type="hidden" name="member_id" value="0" id="member_id">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('library_card_no'); ?></label>
                        <input type="name" class="form-control" name="library_card_no" id="library_card_no" >
                        <span class="text-danger" id="library_card_no_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm add-member" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('add'); ?></button>
                </form>

            </div>
        </div>
    </div>
</div>

                                
                <!-- Add Homework Modal -->


                </div>
              
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


      

<style>
    .surrender-active {
        background-color: #fff3cd !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $("#squarespaceModal").modal({
            show: false,
            backdrop: 'static'
        });
    });

    // $(".surrender-student").click(function () {
    //     if (confirm('Are you sure you want to surrender membership?')) {
    //         var memberid = $(this).data('memberid');
    //         var $this = $(this);
    //         var $row = $this.closest('tr');
    //         $row.addClass('surrender-active');
    //         $this.button('loading');
    //         $.ajax({
    //             type: "POST",
    //             url: '<?php echo site_url('student_nexus/library/surrender') ?>',
    //             data: {'member_id': memberid}, // serializes the form's elements.
    //             dataType: 'JSON',
    //             success: function (response)
    //             {

    //                 if (response.status == "success") {
    //                     successMsg(response.message);
    //                     $this.button('reset');
    //                     $row.removeClass('surrender-active');
    //                     window.setTimeout('location.reload()', 3000);
    //                 } else {
    //                     $row.removeClass('surrender-active');
    //                 }
    //             }
    //         });
    //     }

    // });


    $(".surrender-student").click(function () {
    
    if (confirm('Are you sure you want to surrender membership?')) {

        var $this = $(this);               // the clicked button
        var memberid = $this.data('memberid');
        var $row = $this.closest('tr');    // highlight row

        $row.addClass('surrender-active');
        $this.button('loading');           // START LOADING

        $.ajax({
            type: "POST",
            url: '<?php echo site_url('student_nexus/library/surrender') ?>',
            data: {'member_id': memberid},
            dataType: 'JSON',

            success: function (response) {

                // STOP LOADING ALWAYS
                $this.button('reset');
                $row.removeClass('surrender-active');

                if (response.status === "success") {
                    successMsg(response.message);

                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            },

            error: function (xhr, status, error) {
                // ALSO stop loading if AJAX fails
                $this.button('reset');
                $row.removeClass('surrender-active');

                console.log("AJAX Error:", status);
            }
        });
    }
});




    $(".add-student").click(function () {
        var student = $(this).data('stdid');
        $('#click_member_id').val(student);
        $('#member_id').val(student);
        $('#squarespaceModal').modal('show');
    });

    $("#add_member").submit(function (e) {
        var student = $('#click_member_id').val();
        var $this = $('.add-member');
        $this.button('loading');
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $("#add_member").serialize(), // serializes the form's elements.
            dataType: 'JSON',
            success: function (response)
            {

                if (response.status == "success") {
                    $('#squarespaceModal').modal('hide');
                    $('#add_member')[0].reset();
                    successMsg(response.message);
                    $this.button('reset');
                    $('*[data-stdid="' + student + '"]').closest('tr').find('td:first').text(response.inserted_id);
                    $('*[data-stdid="' + student + '"]').closest('tr').find('td:nth-child(2)').text(response.library_card_no);
                    $('*[data-stdid="' + student + '"]').closest("tr").addClass("success");
                    $('*[data-stdid="' + student + '"]').closest("td").empty();
                } else if (response.status == "fail") {
                    $.each(response.error, function (index, value) {
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                    $this.button('reset');
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });



    $(document).ready(function () {
    $("tr").each(function () {
        var memberId = $(this).find(".surrender-student").data("memberid");
        if (memberId) {
            $(this).addClass("success");
        }
    });
});

</script>