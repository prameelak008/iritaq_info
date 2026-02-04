        <?php

        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }


        class Exam_attempt extends Admin_Controller
        {    


        public function __construct()
        {
        parent::__construct();
        $this->config->load('app-config');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->current_session = $this->setting_model->getCurrentSession();        
        $this->exam_options    = $this->customlib->getExamOptions(); 
        $this->getExamType     = $this->customlib->getExamType();        
        }


            // public function index()
            // {
            // $this->current_session = $this->setting_model->getCurrentSession();
            // $this->session->set_userdata('top_menu', 'semester_exam');
            // $data['examOptions'] = $this->exam_options; 
            // $data['title'] = 'Instruction';
            // $data['programs'] = $this->Semester_enrollment_model->get_program_list();
            // $data['exam_subjects'] = [];

            // if ($this->input->post()) 
            // {
            // $this->form_validation->set_rules('prog_id', $this->lang->line('programme'), 'trim|required'); 
            // $this->form_validation->set_rules('sem_type', $this->lang->line('batch'), 'trim|required'); 

            // if ($this->form_validation->run() == false) 
            // {
            // $sem_group_id = $this->input->post('sem_type');
            // if ($sem_group_id) {
            // $data['exam_subjects'] = $this->Semesterexam_model->get_exam_subjects($sem_group_id);
            // }
            // } 
            // else

            // { 
            // $sem_type_id = $this->input->post('sem_type');
            // $limits = $this->input->post('limits');
            // $unlimited = $this->input->post('unlimited'); 
            // $valid_year = $this->input->post('valid_year');

            // if (!empty($limits)) 
            // {
            // foreach ($limits as $exam_type_id => $max_attempts)
            // {
            // $is_unlimited = (!empty($unlimited) && isset($unlimited[$exam_type_id])) ? 1 : 0;

            // $insertData = [
            // 'c_sem_type_id'   => $sem_type_id,
            // 'c_exam_type'     => $exam_type_id,  // This is now 1, 2, 3, or 4
            // 'c_max_attempts'  => $is_unlimited ? NULL : (int)$max_attempts,
            // 'c_is_unlimited'  => $is_unlimited,
            // 'c_valid_years'   => isset($valid_year[$exam_type_id]) ? (int)$valid_year[$exam_type_id] : 1,
            // 'c_created_by'    => $this->session->userdata('user_id') ?? 1,
            // 'c_created_at'    => date('Y-m-d H:i:s'),
            // 'c_status'        => 1
            // ];

            // $this->db->insert('common_attempt_limits', $insertData);
            // }

            // $this->session->set_flashdata(
            // 'msg',
            // '<div class="alert alert-success">Attempt limits saved successfully</div>'
            // );
            // }

            // redirect('semester_exam/exam_attempt');
            // }
            // }

            // $this->load->view('layout/header', $data);
            // $this->load->view('semester_exam/exam_instruction/exam_attempt', $data);
            // $this->load->view('layout/footer', $data);         
            // }



            public function index()
{
    $this->current_session = $this->setting_model->getCurrentSession();
    $this->session->set_userdata('top_menu', 'semester_exam');
    $data['examOptions'] = $this->exam_options; 
    $data['title'] = 'Instruction';
    $data['programs'] = $this->Semester_enrollment_model->get_program_list();
    $data['exam_subjects'] = [];

    if ($this->input->post()) 
    {
        $this->form_validation->set_rules('prog_id', $this->lang->line('programme'), 'trim|required'); 
        $this->form_validation->set_rules('sem_type', $this->lang->line('batch'), 'trim|required'); 

        if ($this->form_validation->run() == false) 
        {
            $sem_group_id = $this->input->post('sem_type');
            if ($sem_group_id) {
                $data['exam_subjects'] = $this->Semesterexam_model->get_exam_subjects($sem_group_id);
            }
        } 
        else
        { 
            $sem_type_id = $this->input->post('sem_type');
            $limits = $this->input->post('limits');
            $unlimited = $this->input->post('unlimited'); 
            $valid_year = $this->input->post('valid_year');

            if (!empty($limits)) 
            {
                foreach ($limits as $exam_type_id => $max_attempts)
                {
                    $is_unlimited = (!empty($unlimited) && isset($unlimited[$exam_type_id])) ? 1 : 0;

                    // Check if record already exists
                    $this->db->where('c_sem_type_id', $sem_type_id);
                    $this->db->where('c_exam_type', $exam_type_id);
                    $existing = $this->db->get('common_attempt_limits')->row();

                    $data_to_save = [
                        'c_sem_type_id'   => $sem_type_id,
                        'c_exam_type'     => $exam_type_id,
                        'c_max_attempts'  => $is_unlimited ? NULL : (int)$max_attempts,
                        'c_is_unlimited'  => $is_unlimited,
                        'c_valid_years'   => isset($valid_year[$exam_type_id]) ? (int)$valid_year[$exam_type_id] : 1,
                        'c_status'        => 1
                    ];

                    if ($existing) {
                        // Record exists - UPDATE
                        $data_to_save['c_updated_by'] = $this->session->userdata('user_id') ?? 1;
                        $data_to_save['c_updated_at'] = date('Y-m-d H:i:s');
                        
                        $this->db->where('c_limit_id', $existing->c_limit_id);
                        $this->db->update('common_attempt_limits', $data_to_save);
                    } else {
                        // Record doesn't exist - INSERT
                        $data_to_save['c_created_by'] = $this->session->userdata('user_id') ?? 1;
                        $data_to_save['c_created_at'] = date('Y-m-d H:i:s');
                        
                        $this->db->insert('common_attempt_limits', $data_to_save);
                    }
                }

                $this->session->set_flashdata(
                    'msg',
                    '<div class="alert alert-success">Attempt limits saved successfully</div>'
                );
            }

            redirect('semester_exam/exam_attempt');
        }
    }

    $this->load->view('layout/header', $data);
    $this->load->view('semester_exam/exam_instruction/exam_attempt', $data);
    $this->load->view('layout/footer', $data);         
}

      
            public function getexam_subjects()
            {
            $sem_type_id         =    $this->input->post('sem_type');;
            $attempt_subjects    =    $this->Semesterexam_model->get_attempt_subjects($sem_type_id);  
            echo  json_encode($attempt_subjects);
            } 


        public function add_subject_attempt()
        {
        // Get form data
        $sem_type = $this->input->post('sem_type');
        $subject_attempts = $this->input->post('subject_attempts');

    

        if (!$sem_type || !$subject_attempts) {
        $this->session->set_flashdata('error', 'Please select batch and load subjects');
        redirect('semester_exam/exam_attempt');
        return;
        }

        // Get current user ID (adjust based on your auth system)
        $created_by = $this->session->userdata('admin_id') ?? 1;

        $insert_data = [];

        // 👇 CORRECTED: Match with getExamOptions() keys (1-4, not 0-3)
        $exam_types = [
        'regular' => 1,      // Regular
        'say_exam' => 2,     // Say Exam
        'revaluation' => 3,  // Revaluation
        'improvement' => 4   // Improvement
        ];

        // Loop through each subject
        foreach ($subject_attempts as $subject_id => $attempts) {

        // Loop through each exam type for this subject
        foreach ($attempts as $exam_key => $max_attempts) {

        // Only insert if user entered a value
        if (!empty($max_attempts) && is_numeric($max_attempts)) {

        $insert_data[] = [
        'c_sem_type_id' => $sem_type,
        'c_subject_id' => $subject_id,
        'c_exam_type' => $exam_types[$exam_key],
        'c_max_attempts' => $max_attempts,
        'c_is_unlimited' => 0,
        'c_created_by' => $created_by,
        'c_created_at' => date('Y-m-d H:i:s'),
        'c_status' => 1
        ];
        }
        }
        }

        if (!empty($insert_data)) {
        // Delete existing records for this batch (to avoid duplicates)
        $this->db->where('c_sem_type_id', $sem_type);
        $this->db->delete('subject_wise_attempt_limits');

        // Insert new records
        $result = $this->db->insert_batch('subject_wise_attempt_limits', $insert_data);

        if ($result) {
        $this->session->set_flashdata('success', 'Subject attempt limits saved successfully!');
        } else {
        $this->session->set_flashdata('error', 'Failed to save attempt limits');
        }
        } else {
        $this->session->set_flashdata('warning', 'No attempt limits were set');
        }

        redirect('semester_exam/exam_attempt');
        }




        //................................Student-Wise Attempts

        public function getexam_students()
        {            
        $sem_type_id         =    $this->input->post('sem_type');;
        $attempt_students    =    $this->Semesterexam_model->get_attempt_students($sem_type_id);  
        echo  json_encode($attempt_students);
        }


        public function get_attempt_subjects_ajax() 
        {
        $sem_type_id = $this->input->post('sem_type');
        $subjects    = $this->Semesterexam_model->get_attempt_subjects($sem_type_id);
        echo json_encode($subjects);
        }




        public function save_student_attempt() 
        {            
        // 1. Collect Input
        $student_id   = $this->input->post('student_id');
        $subject_id   = $this->input->post('subject_id');
        $exam_type    = $this->input->post('exam_type');
        $sem_group_id = $this->input->post('sem_group_id');
        $attempts     = $this->input->post('attempt_count');
        $desc         = $this->input->post('description');

        // 2. Prepare Data Array
        $data = array(
            'student_id'    => $student_id,
            // 'subject_id'    => $subject_id,
            // 'exam_type'     => $exam_type,
            // 'sem_group_id'  => $sem_group_id,
            // 'attempts_used' => $attempts,
            // 'description'   => $desc, // assuming you have this column or a log table
            // 'updated_at'    => date('Y-m-d H:i:s')
        );

        // 3. Check if Record Exists
        $this->db->where([
            'student_id'      => $student_id,
            // 'subject_id'   => $subject_id,
            // 'exam_type'    => $exam_type,
            // 'sem_group_id' => $sem_group_id
        ]);


        $query = $this->db->get('student_exam_attempts');

        if ($query->num_rows() > 0) {
            // UPDATE
            $this->db->where('id', $query->row()->id);
            $status = $this->db->update('student_exam_attempts', $data);
        } else {
            // INSERT
            $data['created_at'] = date('Y-m-d H:i:s');
            $status = $this->db->insert('student_exam_attempts', $data);
        }

        // 4. Return JSON response for AJAX
        if ($status) {
            echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save record']);
        }
        }


      public function get_existing_limits()
{
    $sem_type_id = $this->input->post('sem_type_id'); // ✅ Changed from 'sem_type' to 'sem_type_id'
    
    if (empty($sem_type_id)) {
        echo json_encode([
            'success' => false,
            'data' => null,
            'message' => 'No semester type selected'
        ]);
        return;
    }
    
    $limits = $this->Semesterexam_model->get_attempt_limits($sem_type_id);
    
    // ✅ Return proper JSON format with success flag
    if (!empty($limits)) {
        echo json_encode([
            'success' => true,
            'data' => $limits,
            'message' => 'Limits loaded successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'data' => null,
            'message' => 'No limits found'
        ]);
    }
}




        /////....................................................Student-Wise Attempts



//         public function get_student_subject_attempts() {
//     $student_id = $this->input->post('student_id');
//     $sem_type = $this->input->post('sem_type');
    
//     // Logic to join your subjects table with your exam_attempts table
//     // filtering by the specific student and semester
//     $data = $this->ExamModel->getStudentSubjectsWithAttempts($student_id, $sem_type);
    
//     echo json_encode($data);
// }





//         public function student_attempts()
// {
//     $this->current_session = $this->setting_model->getCurrentSession();
//     $this->session->set_userdata('top_menu', 'semester_exam');

//     $data['title']    = 'Student Wise Attempts';
//     $data['programs'] = $this->Semester_enrollment_model->get_program_list();

//     /* sem_type from POST (form submit) or GET (redirect after save) */
//     $sem_type_id = $this->input->post('sem_type');
//     if (empty($sem_type_id)) {
//         $sem_type_id = $this->input->get('sem_type');
//     }
//     $data['sem_type_id'] = $sem_type_id;

//     /* student list – only if batch is selected */
//     $data['students'] = [];
//     if (!empty($sem_type_id))
//     {
//         $data['students'] = $this->Semesterexam_model->get_attempt_students($sem_type_id);
//     }

//     $this->load->view('layout/header', $data);
//     $this->load->view('semester_exam/exam_instruction/exam_attempt_students', $data);
//     $this->load->view('layout/footer', $data);
// }


// public function get_student_subjects_data()
// {
//     $student_id = $this->input->post('student_id');
//     $sem_type   = $this->input->post('sem_type');

//     if (empty($student_id) || empty($sem_type)) {
//         echo json_encode([]);
//         return;
//     }

//     /* ── subjects enrolled by this student in this batch ── */
//     $this->db->select([
//         'student_subjects.subject_id',
//         'subjects.subject_name',
//         'subjects.subject_code'
//     ]);
//     $this->db->from('student_subjects');
//     $this->db->join('subjects', 'subjects.id = student_subjects.subject_id');
//     $this->db->where('student_subjects.student_id',   $student_id);
//     $this->db->where('student_subjects.sem_group_id', $sem_type);
//     $this->db->order_by('subjects.subject_name ASC');

//     $subjects = $this->db->get()->result_array();

//     if (empty($subjects)) {
//         echo json_encode([]);
//         return;
//     }

//     /* ── attempt rows for this student in this batch ── */
//     $subjectIds = array_column($subjects, 'subject_id');

//     $this->db->select('id, subject_id, exam_type, attempts_used, max_attempts');
//     $this->db->from('student_exam_attempts');
//     $this->db->where('student_id',   $student_id);
//     $this->db->where('sem_group_id', $sem_type);
//     $this->db->where_in('subject_id', $subjectIds);

//     $attempts = $this->db->get()->result_array();

//     /* ── build map: subject_id → { exam_type → row } ── */
//     $attemptMap = [];
//     foreach ($attempts as $a) {
//         $attemptMap[$a['subject_id']][$a['exam_type']] = $a;
//     }

//     /* ── merge into subjects ── */
//     foreach ($subjects as &$subj) {
//         $subj['attempts'] = isset($attemptMap[$subj['subject_id']])
//                             ? $attemptMap[$subj['subject_id']]
//                             : [];
//     }
//     unset($subj);

//     echo json_encode($subjects);
// }

        
}


