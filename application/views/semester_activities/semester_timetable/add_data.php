        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css">

        <style type="text/css">
        .nav-tabs {
        padding: 0;
        margin: 0 0 30px 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        border-bottom: none;
        }

        .nav-tabs li {
        list-style: none;
        margin-bottom: 0;
        }

        .nav-tabs li a {
        display: block;
        padding: 12px 24px;
        text-decoration: none;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        border: 2px solid #e0e0e0;
        background: #ffffff;
        border-radius: 8px;
        transition: all 0.3s ease;
        }

        .nav-tabs li a:hover {
        color: white;
        border-color: #6b7275;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
        }

        .nav-tabs li.active a {
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        background: linear-gradient(135deg, #6b7275 0%, #6b7275 100%);
        }

        .timetable-section 
        {
        display: <?php echo $show_timetable ? 'block' : 'none'; ?>;
        }


        @media (max-width: 767px) {
        .nav-tabs {
        border-bottom: none;
        }

        .nav-tabs > li {
        float: none;          
        width: 100%;
        margin-bottom: 5px;
        }

        .nav-tabs > li > a {
        border-radius: 4px;
        border: 1px solid #ddd;
        }

        .nav-tabs > li.active > a {
        border-bottom-color: #ddd;
        }
        }

        </style>



<script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>



<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?>
        </h1>
    </section>

    <section class="content">
        <div class="col-md-12">
            <?php $this->load->view('layout/topbar_activities'); ?>
        </div>
        &nbsp;

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>

                    <?php
                    $subjectOptions = '';
                    if (!empty($subjectpapers)) {
                        foreach ($subjectpapers as $paper) {
                            $subjectOptions .= '<option value="' . $paper['sem_paper_id'] . '">'
                                . $paper['subject_name'] . ' - ' . $paper['sem_paper_paper'] .
                                '</option>';
                        }
                    }

                    $staffOptions = '';
                    foreach ($teaching_staff as $staff) {
                        $staffOptions .= '<option value="' . $staff['id'] . '">' . $staff['name'] . '</option>';
                    }

                    $periodOptions = '';
                    foreach ($period as $per) {
                        $periodOptions .= '<option 
                            value="' . $per['periodic_table_id'] . '"
                            data-from="' . $per['periodic_table_timefrom'] . '"
                            data-to="' . $per['periodic_table_timeto'] . '">'
                            . $per['periodic_table_name'] .
                            '</option>';
                    }

                    // Organize existing timetable by day
                    $timetable_by_day = [];
                    if (!empty($existing_timetable)) {
                        foreach ($existing_timetable as $entry) {
                            $timetable_by_day[$entry['tb_day']][] = $entry;
                        }
                    }
                    ?>

                    <form role="form" action="<?php echo site_url('semester_activities/semester_timetable/set_timetable') ?>" method="post" class="class_search_form">
                        <div class="promotion-grid">
                            <div class="section-card">
                                <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <?php echo $this->customlib->getCSRF(); ?>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?= dropdownlist_program(
                                                        $programs,
                                                        set_value('prog_id', isset($prog_id) ? $prog_id : ''),
                                                    ); ?>
                                                    <span class="text-danger"><?= form_error('prog_id'); ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                                                    <select id="sem_type" name="sem_type" class="form-control">
                                                        <option value="">-- Select Batch & Semester --</option>
                                                    </select>
                                                    <span class="text-danger"><?= form_error('sem_type'); ?></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('subject') . '&nbsp;' . $this->lang->line('group'); ?> <small class="req">*</small></label>
                                                    <select id="subject_group" name="subject_group" class="form-control">
                                                        <option value="">-- Select Subject Group --</option>
                                                    </select>
                                                    <span class="text-danger"><?= form_error('subject_group'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                        </div>
                    </form>
                </div>

                <!-- TIMETABLE SECTION - Hidden until search -->
                <div class="timetable-section">
                    <div class="box box-primary">
                        <br>
                        <br>
                        <ul class="nav nav-tabs" id="myTabs">
                            <?php
                            $first = true;
                            foreach ($getDaysnameList as $day => $dayLabel) {
                            ?>
                                <li class="<?= $first ? 'active' : '' ?>">
                                    <a href="#tab_<?php echo $day; ?>" data-toggle="tab">
                                        <?php echo $day; ?>
                                    </a>
                                </li>
                            <?php
                                $first = false;
                            }
                            ?>
                        </ul>

                        <div class="promotion-grid">
                            <div class="section-card">
                                <div class="section-title"><?php echo $this->lang->line('timetable'); ?></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="<?php echo site_url('semester_activities/semester_timetable/save_timetable') ?>" method="post">
                                            <?php echo $this->customlib->getCSRF(); ?>
                                            
                                            <!-- Hidden fields to maintain context -->
                                            <input type="hidden" name="sem_type" value="<?php echo isset($sem_group_id) ? $sem_group_id : ''; ?>">
                                            <input type="hidden" name="subject_group" value="<?php echo isset($subject_group) ? $subject_group : ''; ?>">

                                            <div class="tab-content">
                                                <?php
                                                $first = true;
                                                foreach ($getDaysnameList as $day => $dayLabel) {
                                                    $day_entries = isset($timetable_by_day[$day]) ? $timetable_by_day[$day] : [];
                                                ?>
                                                    <div class="tab-pane <?= $first ? 'active' : '' ?>" id="tab_<?= $day ?>">
                                                        <table class="table table-striped table-bordered table-hover example">
                                                            <thead>
                                                                <tr>
                                                                    <th>Period</th>
                                                                    <th>Time From</th>
                                                                    <th>Time To</th>
                                                                    <th>Subject</th>
                                                                    <th>Subject Paper</th>
                                                                    <th>Staff</th>
                                                                    <th>Room</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody class="timetable-body" data-day="<?= $day ?>">
                                                                <?php if (empty($day_entries)) { ?>
                                                                    <!-- Empty row for new entry -->
                                                                    <tr>
                                                                        <td>
                                                                            <select class="form-control period" onchange="getperiod_id(this)" name="period[<?= $day ?>][]">
                                                                                <?= $periodOptions ?>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="time_from[<?= $day ?>][]" class="form-control" readonly></td>
                                                                        <td><input type="text" name="time_to[<?= $day ?>][]" class="form-control" readonly></td>
                                                                        <td>
                                                                            <select name="subject[<?= $day ?>][]" class="form-control subject-dropdown">
                                                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="subjectpaper[<?= $day ?>][]" class="form-control subjectpaper-dropdown">
                                                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="staff[<?= $day ?>][]" class="form-control">
                                                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                                <?= $staffOptions ?>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="room[<?= $day ?>][]" class="form-control"></td>
                                                                        <td><button type="button" class="btn btn-success addRow">+</button></td>
                                                                    </tr>
                                                                <?php } else {
                                                                    // Display existing entries
                                                                    $is_first_row = true;
                                                                    foreach ($day_entries as $entry) {
                                                                ?>
                                                                        <tr>
                                                                            <td>
                                                                                <select class="form-control period" onchange="getperiod_id(this)" name="period[<?= $day ?>][]">
                                                                                    <?php
                                                                                    foreach ($period as $per) {
                                                                                        $selected = ($per['periodic_table_id'] == $entry['tb_period_id']) ? 'selected' : '';
                                                                                        echo '<option value="' . $per['periodic_table_id'] . '" 
                                                                                            data-from="' . $per['periodic_table_timefrom'] . '"
                                                                                            data-to="' . $per['periodic_table_timeto'] . '" ' . $selected . '>'
                                                                                            . $per['periodic_table_name'] . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="time_from[<?= $day ?>][]" class="form-control" value="<?= $entry['tb_time_from'] ?>" readonly></td>
                                                                            <td><input type="text" name="time_to[<?= $day ?>][]" class="form-control" value="<?= $entry['tb_time_to'] ?>" readonly></td>
                                                                            <td>
                                                                                <select name="subject[<?= $day ?>][]" class="form-control subject-dropdown">
                                                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                                    <?php
                                                                                    if (!empty($subjectpapers)) {
                                                                                        $displayed_subjects = [];
                                                                                        foreach ($subjectpapers as $paper) {
                                                                                            if (!in_array($paper['subject_name'], $displayed_subjects)) {
                                                                                                $selected = (!empty($entry['tb_subject_id']) && $paper['sem_paper_subjectid'] == $entry['tb_subject_id']) ? 'selected' : '';
                                                                                                echo '<option value="' . $paper['sem_paper_subjectid'] . '" ' . $selected . '>' . $paper['subject_name'] . '</option>';
                                                                                                $displayed_subjects[] = $paper['subject_name'];
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select name="subjectpaper[<?= $day ?>][]" class="form-control subjectpaper-dropdown">
                                                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                                    <?php
                                                                                    if (!empty($subjectpapers)) {
                                                                                        foreach ($subjectpapers as $paper) {
                                                                                            $selected = ($paper['sem_paper_id'] == $entry['tb_subjectpaper']) ? 'selected' : '';
                                                                                            echo '<option value="' . $paper['sem_paper_id'] . '" data-subject="' . $paper['sem_paper_subjectid'] . '" ' . $selected . '>'
                                                                                                . $paper['subject_name'] . ' - ' . $paper['sem_paper_paper'] . '</option>';
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select name="staff[<?= $day ?>][]" class="form-control">
                                                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                                                    <?php
                                                                                    foreach ($teaching_staff as $staff) {
                                                                                        $selected = ($staff['id'] == $entry['tb_staff_id']) ? 'selected' : '';
                                                                                        echo '<option value="' . $staff['id'] . '" ' . $selected . '>' . $staff['name'] . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="room[<?= $day ?>][]" class="form-control" value="<?= $entry['tb_room_no'] ?>"></td>
                                                                            <td>
                                                                                <?php if ($is_first_row) { ?>
                                                                                    <button type="button" class="btn btn-success addRow">+</button>
                                                                                <?php } else { ?>
                                                                                    <button type="button" class="btn btn-danger removeRow">-</button>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                <?php
                                                                        $is_first_row = false;
                                                                    }
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php
                                                    $first = false;
                                                }
                                                ?>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary pull-right btn-sm">
                                                            <i class="fa fa-save"></i> &nbsp;<?php echo $this->lang->line('save'); ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Store all subject papers data
    var allSubjectPapers = <?php echo json_encode(!empty($subjectpapers) ? $subjectpapers : []); ?>;

    function getperiod_id(selectElement) {
        let $select = $(selectElement);
        let $row = $select.closest('tr');

        let timeFrom = $select.find('option:selected').data('from');
        let timeTo = $select.find('option:selected').data('to');

        $row.find('input[name*="time_from"]').val(timeFrom || '');
        $row.find('input[name*="time_to"]').val(timeTo || '');
    }

    // Load subjects when timetable is displayed
    <?php if (isset($show_timetable) && $show_timetable && isset($subject_group)) { ?>
    $(document).ready(function() {
        loadSubjects();
    });
    <?php } ?>

    // Load subjects based on subject group
    function loadSubjects() {
        var subject_group = '<?php echo isset($subject_group) ? $subject_group : ''; ?>';
        
        if (subject_group != '') {
            $.ajax({
                url: "<?php echo base_url('semester_activities/teacher_subject_assignments/list_subjects'); ?>",
                method: "POST",
                data: {group_id: subject_group},
                dataType: "json",
                success: function(data) {
                    // Populate all subject dropdowns
                    $('.subject-dropdown').each(function() {
                        var currentValue = $(this).val();
                        var html = '<option value="">Select Subject</option>';
                        
                        $.each(data, function(key, value) {
                            var selected = (currentValue == value.id) ? 'selected' : '';
                            html += '<option value="'+ value.id +'" '+ selected +'>'+ value.name +'</option>';
                        });
                        
                        $(this).html(html);
                    });
                }
            });
        }
    }

    // Filter subject papers when subject is selected
    $(document).on('change', '.subject-dropdown', function() {
        var subject_id = $(this).val();
        var $row = $(this).closest('tr');
        var $paperDropdown = $row.find('.subjectpaper-dropdown');
        
        if (subject_id != '') {
            var html = '<option value="">Select Subject Paper</option>';
            
            $.each(allSubjectPapers, function(key, paper) {
                if (paper.sem_paper_subjectid == subject_id) {
                    html += '<option value="'+ paper.sem_paper_id +'" data-subject="'+ paper.sem_paper_subjectid +'">'
                        + paper.subject_name + ' - ' + paper.sem_paper_paper + '</option>';
                }
            });
            
            $paperDropdown.html(html);
        } else {
            $paperDropdown.html('<option value="">Select Subject Paper</option>');
        }
    });

    $(document).on('click', '.addRow', function() {
        let $tbody = $(this).closest('tbody');
        let $row = $tbody.find('tr:first').clone();

        // Reset values
        $row.find('input').val('');
        $row.find('select').prop('selectedIndex', 0);

        // Convert + to -
        $row.find('.addRow')
            .removeClass('addRow btn-success')
            .addClass('removeRow btn-danger')
            .text('-');

        $tbody.append($row);
        
        // Reload subjects for new row
        loadSubjects();
    });

    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
    });

    // Preserve selections on page load
    <?php if (isset($show_timetable) && $show_timetable && isset($prog_id, $sem_group_id, $subject_group)) { ?>
        $(document).ready(function() {
            $('#prog_id').val('<?= $prog_id ?>').trigger('change');
            
            setTimeout(function() {
                $('#sem_type').val('<?= $sem_group_id ?>').trigger('change');
            }, 500);
            
            setTimeout(function() {
                $('#subject_group').val('<?= $subject_group ?>');
            }, 1000);
        });
    <?php } ?>

    

    $(document).on('change', '#sem_type', function() {
        const sem_group_id = $(this).val();

        $('#subject_group')
            .prop('disabled', true)
            .html('<option>Loading...</option>');

            

        $.post(
            "<?= site_url('semester_activities/semester_timetable/get_subject_groups_by_sem_group'); ?>",
            {
                sem_group_id: sem_group_id
            },
            function(data) 
            {

                
                let html = '<option value="">-- Select Subject Group --</option>';

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(row => {
                        html += `<option value="${row.iid}">${row.iname}</option>`;
                    });
                } else {
                    html += '<option value="">No Subject Groups Found</option>';
                }

                $('#subject_group')
                    .html(html)
                    .prop('disabled', false);
            },
            'json'
        );
    });
</script>
