            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Semester_timetable extends Admin_Controller
            {
            public function __construct()
            {
            parent::__construct();
            $this->load->helper('form');
            $this->config->load('app-config');
            $this->load->library("datatables");
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            

            function set_timetable()
            {
            $this->session->set_userdata('top_menu', 'semester_activities');

            $data['title'] = 'Set Semester Timetable';
            $data['teaching_staff'] = $this->Semesteractivities_model->get_teachingstaff();
            $data['programs'] = $this->Semester_enrollment_model->get_program_list();
            $data['semesters_batches'] = $this->Semester_enrollment_model->get_all_semesters_batches();
            $data['subject_groups'] = $this->Assignsubjects_model->get_subjectgroups();

            $getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;

            $subjectpapers = $this->Subjectpaper_model->getsubjectpapers();
            $data['subjectpapers'] = $subjectpapers;
            $period = $this->staff_model->getperiod();
            $data['period'] = $period;

            // Initialize empty data
            $data['show_timetable'] = false;
            $data['existing_timetable'] = [];

            $this->form_validation->set_rules('prog_id', $this->lang->line('programee'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('sem_type', $this->lang->line('batch'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('subject_group', $this->lang->line('subject_group'), 'required|trim|xss_clean');

            if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            } else {
            $prog_id = $this->input->post('prog_id');
            $sem_group_id = $this->input->post('sem_type');
            $subject_group = $this->input->post('subject_group');

            $data['prog_id'] = $prog_id;
            $data['sem_group_id'] = $sem_group_id;
            $data['subject_group'] = $subject_group;
            $data['show_timetable'] = true;

            // Get subject papers for this combination
            $data['subjectpapers'] = $this->Semesteractivities_model->get_subject_paper($prog_id, $sem_group_id, $subject_group);

            // Get existing timetable data
            $data['existing_timetable'] = $this->Semesteractivities_model->get_timetable($sem_group_id, $subject_group);

            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            }
            }



            public function save_timetable()
            {
            $subject_group                  = $this->input->post('subject_group');
            $sem_group_id                   = $this->input->post('sem_type');

            if (!$sem_group_id || !$subject_group) {
            $this->session->set_flashdata('error', 'Batch and Subject Group required');
            redirect($_SERVER['HTTP_REFERER']);
            }

            // Delete existing timetable for this batch and subject group
            $this->db->where('tb_batch', $sem_group_id);
            $this->db->where('tb_subjectgroup', $subject_group);
            $this->db->delete('semester_timetable');

            if (!empty($_POST['period']) && is_array($_POST['period'])) {
            foreach ($_POST['period'] as $day => $periods) {
            foreach ($periods as $i => $period_id) {
            $subject_id         = $_POST['subject'][$day][$i] ?? '';
            $subjectpaper       = $_POST['subjectpaper'][$day][$i] ?? '';
            $staff              = $_POST['staff'][$day][$i] ?? '';
            $room               = trim($_POST['room'][$day][$i] ?? '');
            $time_from          = $_POST['time_from'][$day][$i] ?? '';
            $time_to            = $_POST['time_to'][$day][$i] ?? '';

            // Skip empty rows
            if (empty($subject_id) && empty($subjectpaper) && empty($staff) && empty($room)) {
            continue;
            }

            $data = [
            'tb_day'            => $day,
            'tb_batch'          => $sem_group_id,
            'tb_subjectgroup'   => $subject_group,
            'tb_subname'        => $subject_id,
            'tb_subjectpaper'   => $subjectpaper,
            'tb_staff_id'       => $staff,
            'tb_period_id'      => $period_id,
            'tb_time_from'      => $time_from,
            'tb_time_to'        => $time_to,
            'tb_room_no'        => $room,
            'tb_created_date'   => date('Y-m-d H:i:s'),
            'tb_status'         => 1
            ];

            $this->db->insert('semester_timetable', $data);
            }
            }
            }

            $this->session->set_flashdata('success', 'Timetable saved successfully');
            redirect($_SERVER['HTTP_REFERER']);
            }




            public function get_subject_groups_by_sem_group()
            {
            $sem_group_id = $this->input->post('sem_group_id');
            $data = $this->Semesteractivities_model->get_subject_groups_by_sem_group($sem_group_id);
            echo json_encode($data);
            }



            }
