            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }


            class Generatecertificate extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();
            $this->load->library('Customlib');
            $this->sch_setting_detail = $this->setting_model->getSetting();
            } 


            public function index()
            {
            // Load necessary data
            $data['program_types'] = $this->Semester_enrollment_model->get_program_types();
            $data['programs'] = $this->Semester_enrollment_model->get_programs();
            $data['semesters_batches'] = $this->Semester_enrollment_model->get_all_semesters_batches();
            $data['certificateList'] = $this->Certificate_model->getstudentcertificate();

            // Check if form is submitted
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Form validation rules
            $this->form_validation->set_rules('program', $this->lang->line('program'), 'trim|required');
            $this->form_validation->set_rules('semester', $this->lang->line('semester'), 'trim|required');
            $this->form_validation->set_rules('certificate_id', $this->lang->line('certificate'), 'trim|required');

            if ($this->form_validation->run() == true) {
            // Get form data
            $program_id = $this->input->post('program'); 
            $semester_value = $this->input->post('semester');
            $certificate_id = $this->input->post('certificate_id');

            // Validate semester value format
            if (strpos($semester_value, '|') !== false) {
            // Split semester value into individual IDs: semester type, batch, term
            $semester_parts = explode('|', $semester_value);
            if (count($semester_parts) === 3) {
            list($semester_type_id, $batch_id, $semester_term_id) = $semester_parts;

            // Store selected values
            $data['selected_program'] = $program_id;
            $data['selected_semester_type'] = $semester_type_id;
            $data['selected_batch'] = $batch_id;
            $data['selected_term'] = $semester_term_id;

            // Get semester groups
            $sem_groups = $this->Semesteractivities_model->get_sem_group(
            $program_id,
            $batch_id,
            $semester_type_id,
            $semester_term_id
            );

            if (!empty($sem_groups)) {
            $data['sem_groups'] = $sem_groups;
            $data['resultlist'] = $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);
            $data['certificateResult'] = $this->Generatecertificate_model->getcertificatebyid($certificate_id);
            } else {
            $this->session->set_flashdata('error', 'No semester groups found for the selected criteria.');
            }
            } else {
            $this->session->set_flashdata('error', 'Invalid semester format.');
            }
            } else {
            $this->session->set_flashdata('error', 'Invalid semester value.');
            }
            }
            }

            // Load views
            $this->load->view('layout/header', $data);
            $this->load->view('student_nexus/generatecertificate', $data);
            $this->load->view('layout/footer', $data);
            }


            public function generate($student, $class, $certificate)
            {
            $certificateResult         = $this->Generatecertificate_model->getcertificatebyid($certificate);
            $data['certificateResult'] = $certificateResult;
            $resultlist                = $this->student_model->searchByClassStudent($class, $student);
            $data['resultlist']        = $resultlist;

            $this->load->view('admin/certificate/transfercertificate', $data);
            }

            public function generatemultiple()
            {
            $studentid           = $this->input->post('data');
            $student_array       = json_decode($studentid);
            $certificate_id      = $this->input->post('certificate_id');
            // $class               = $this->input->post('class_id');
            $data                = array();
            $results             = array();
            $std_arr             = array();
            $data['sch_setting'] = $this->setting_model->get();
            $data['certificate'] = $this->Generatecertificate_model->getcertificatebyid($certificate_id);

            foreach ($student_array as $key => $value) {
            $std_arr[] = $value->student_id;
            }
            $data['students'] = $this->Room_allocation_model->getStudentsByArray($std_arr);
            foreach ($data['students'] as $key => $value) {
            $data['students'][$key]->name = $this->customlib->getFullName($value->firstname, $value->middlename, $value->lastname, $this->sch_setting_detail->middlename, $this->sch_setting_detail->lastname);
            }

            $data['sch_setting'] = $this->sch_setting_detail;
            $certificates        = $this->load->view('student_nexus/printcertificate', $data, true);
            echo $certificates;
            }

            }
