<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('render_program_dropdown')) {
    function render_program_dropdown($program_types, $programs, $selected = '')
    {
        $programs_by_type = [];
        foreach ($programs as $p) {
            $tid = $p['prog_type_id'] ?? null;
            if ($tid) $programs_by_type[$tid][] = $p;
        }

        $html = '<select id="program" name="program" class="form-control">';
        $html .= '<option value="">-- Select Program --</option>';

        foreach ($program_types as $type) {
            $html .= '<optgroup label="'.htmlspecialchars($type['prog_type_name']).'">';
            $list = $programs_by_type[$type['prog_type_id']] ?? [];

            if ($list) {
                foreach ($list as $prog) {
                    $sel = ($selected == $prog['p_id']) ? 'selected' : '';
                    $html .= '<option value="'.$prog['p_id'].'" '.$sel.'>'
                             .htmlspecialchars($prog['p_name']).'</option>';
                }
            } else {
                $html .= '<option value="" disabled>-</option>';
            }
            $html .= '</optgroup>';
        }

        $html .= '</select>';
        return $html;
    }
}


if (!function_exists('render_semester_dropdown')) {
    function render_semester_dropdown($semesters_batches, $selected = '')
    {
        $html = '<select id="semester" name="semester" class="form-control">';
        $html .= '<option value="">-- Select Semester / Term / Batch --</option>';

        $current_type = '';
        foreach ($semesters_batches as $sem) {
            if ($current_type != $sem['st_name']) {
                if ($current_type != '') $html .= '</optgroup>';
                $html .= '<optgroup label="'.htmlspecialchars($sem['st_name']).'">';
                $current_type = $sem['st_name'];
            }

            $value = $sem['sem_group_semester'].'|'.
                     $sem['sem_group_batchgroup'].'|'.
                     $sem['sem_group_semester_term'];

            $sel = ($selected == $value) ? 'selected' : '';

            $html .= '<option value="'.$value.'" '.$sel.'>'.
                     $sem['stm_name'].' - '.$sem['batch_group_year'].'</option>';
        }

        if ($current_type != '') $html .= '</optgroup>';

        $html .= '</select>';
        return $html;
    }
}



if (!function_exists('dropdownlist')) {

    function dropdownlist($programs, $selected = '', $label = 'Program Type / Program')
    {
        $grouped = [];

        // Group programs by dynamic program type name
        foreach ($programs as $row) {
            $type = $row['prog_type_name'] ?? 'Others';
            $grouped[$type][] = $row;
        }

        // Start building HTML
        $html = '<div class="form-group">';
        $html .= '<label>' . htmlspecialchars($label) . ' <small class="req">*</small></label>';
        $html .= '<select id="program" name="program"  class="form-control">';
        $html .= '<option value="">-- Select Program --</option>';

        foreach ($grouped as $type => $rows) {
            $html .= '<optgroup label="' . htmlspecialchars($type) . '">';
            foreach ($rows as $prog) {
                $sel = ($selected == $prog['id']) ? 'selected' : '';
                $html .= '<option value="' . $prog['id'] . '" ' . $sel . '>'
                      . htmlspecialchars($prog['p_name']) .
                      '</option>';
            }
            $html .= '</optgroup>';
        }

        $html .= '</select>';
        $html .= '</div>'; // close form-group

        return $html;
    }
}



if (!function_exists('dropdownlist_prog')) {

    function dropdownlist_prog($programs, $selected = '', $label = 'Program Type / Program')
    {
        $grouped = [];

        // Group programs by dynamic program type name
        foreach ($programs as $row) {
            $type = $row['prog_type_name'] ?? 'Others';
            $grouped[$type][] = $row;
        }

        // Start building HTML
        $html = '<div class="form-group">';
        $html .= '<label>' . htmlspecialchars($label) . ' <small class="req">*</small></label>';
        $html .= '<select id="progm_id" name="progm_id"  class="form-control">';
        $html .= '<option value="">-- Select Program --</option>';

        foreach ($grouped as $type => $rows) {
            $html .= '<optgroup label="' . htmlspecialchars($type) . '">';
            foreach ($rows as $prog) {
                $sel = ($selected == $prog['id']) ? 'selected' : '';
                $html .= '<option value="' . $prog['id'] . '" ' . $sel . '>'
                      . htmlspecialchars($prog['p_name']) .
                      '</option>';
            }
            $html .= '</optgroup>';
        }

        $html .= '</select>';
        $html .= '</div>'; // close form-group

        return $html;
    }
}




if (!function_exists('dropdownlist_program')) {

    function dropdownlist_program($programs, $selected = '', $label = 'Program Type / Program')
    {
        $grouped = [];

        // Group programs by dynamic program type name
        foreach ($programs as $row) {
            $type = $row['prog_type_name'] ?? 'Others';
            $grouped[$type][] = $row;
        }

        // Start building HTML
        $html = '<div class="form-group">';
        $html .= '<label>' . htmlspecialchars($label) . ' <small class="req">*</small></label>';
        $html .= '<select id="prog_id" name="prog_id"  class="form-control">';
        $html .= '<option value="">-- Select Program --</option>';

        foreach ($grouped as $type => $rows) {
            $html .= '<optgroup label="' . htmlspecialchars($type) . '">';
            foreach ($rows as $prog) {
                $sel = ($selected == $prog['id']) ? 'selected' : '';
                $html .= '<option value="' . $prog['id'] . '" ' . $sel . '>'
                      . htmlspecialchars($prog['p_name']) .
                      '</option>';
            }
            $html .= '</optgroup>';
        }

        $html .= '</select>';
        $html .= '</div>'; // close form-group

        return $html;
    }
}




if (!function_exists('batchtype_list')) {

    function batchtype_list($batch_types, $selected = '')
    {
        $html = '<option value="">-- Select Batch --</option>';

        $grouped = [];

        // Group by batch mode
        foreach ($batch_types as $row) {
            $grouped[$row['b_mode_name']][] = $row;
        }

        // Build select options
        foreach ($grouped as $mode_name => $rows) {

            $html .= '<optgroup label="' . htmlspecialchars($mode_name) . '">';

            foreach ($rows as $row) {

                $is_selected = ($selected == $row['b_id']) ? 'selected' : '';

                $label = $row['batch_group_name'] . '-' . $row['batch_group_year'];

                $html .= '<option value="' . $row['b_id'] . '" ' . $is_selected . '>';
                $html .= htmlspecialchars($label);
                $html .= '</option>';
            }

            $html .= '</optgroup>';
        }

        return $html;
    }
}

if (!function_exists('batchtype_mode_list')) {

    function batchtype_mode_list(
        $batch_types,
        $selected = '',
        $select_name = 'sem_batch_type',
        $select_id = 'sem_batch_type',
        $label_text = 'Batch'
    ) {
        $html  = '<div class="form-group">';

        // Label
        $html .= '<label for="' . htmlspecialchars($select_id) . '">';
        $html .= htmlspecialchars($label_text);
        $html .= '</label>';

        // Select
        $html .= '<select name="' . htmlspecialchars($select_name) . '" ';
        $html .= 'id="' . htmlspecialchars($select_id) . '" ';
        $html .= 'class="form-control">';

        $html .= '<option value="">-- Select Batch --</option>';

        $grouped = [];

        // Group rows by Batch Mode Name
        foreach ($batch_types as $row) {

            $mode_name = !empty($row['b_mode_name'])
                ? $row['b_mode_name']
                : 'Others';

            $grouped[$mode_name][] = $row;
        }

        // Build dropdown
        foreach ($grouped as $mode_name => $rows) {

            $html .= '<optgroup label="' . htmlspecialchars($mode_name) . '">';

            foreach ($rows as $row) {

                $is_selected = ($selected == $row['b_name']) ? 'selected' : '';

                $label = trim(
                    ($row['batch_group_name'] ?? '') .
                    ' - ' .
                    ($row['batch_group_year'] ?? '')
                );

                $html .= '<option value="' . htmlspecialchars($row['b_id']) . '" ' . $is_selected . '>';
                $html .= htmlspecialchars($label);
                $html .= '</option>';
            }

            $html .= '</optgroup>';
        }

        $html .= '</select>';
        $html .= '</div>';

        return $html;
    }
}






if (!function_exists('semester_term_dropdown')) {
    function semester_term_dropdown($semester_terms, $selected = '', $label = 'Semester Term') {
        $html = '<div class="form-group">';
        $html .= '<label>'.htmlspecialchars($label).' <small class="req">*</small></label>';
        $html .= '<select id="semester_term" name="semester_term" class="form-control">';
        $html .= '<option value="">-- Select Semester Term --</option>';

        if (is_array($semester_terms)) {
            foreach ($semester_terms as $term) {
                $sel = ($selected == $term['stm_id']) ? 'selected' : '';
                $html .= '<option value="'.$term['stm_id'].'" '.$sel.'>'
                      . htmlspecialchars($term['stm_name']) . ' (' . htmlspecialchars($term['stm_code']) . ')'
                      . '</option>';
            }
        }

        $html .= '</select>';
        $html .= '</div>';

        return $html;
    }
}



function render_subject_dropdowns($selected_group = '', $selected_subject = '')
{
    if ($selected_group == '') $selected_group = set_value('subject_group');
    if ($selected_subject == '') $selected_subject = set_value('subjects');

    $html  = '<div class="col-md-6">';
    $html .= '<div class="form-group">';
    $html .= '<label>Subject Group <small class="req">*</small></label>';
    $html .= '<select id="subject_group" name="subject_group" class="form-control" 
                data-selected="'.$selected_group.'">';
    $html .= '<option value="">-- Select Subject Group --</option>';
    $html .= '</select>';
    $html .= '<span class="text-danger">'.form_error('subject_group').'</span>';
    $html .= '</div></div>';

    $html .= '<div class="col-md-6">';
    $html .= '<div class="form-group">';
    $html .= '<label>Subjects <small class="req">*</small></label>';
    $html .= '<select id="subjects" name="subjects" class="form-control"
                data-selected="'.$selected_subject.'">';
    $html .= '<option value="">-- Select Subject --</option>';
    $html .= '</select>';
    $html .= '<span class="text-danger">'.form_error('subjects').'</span>';
    $html .= '</div></div>';
    return $html;
}





