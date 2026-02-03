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




        public function index()
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'semester_exam');
        $data['examOptions']           =  $this->exam_options; 
        $data['title']                 =  'Instruction';
        $sem_group_id                  =   $this->input->post('sem_type');   
        $get_exam_subjects             =   $this->Semesterexam_model->get_exam_subjects($sem_group_id);
        $data['exam_subjects']         =   $get_exam_subjects;     

        $this->form_validation->set_rules('prog_id', $this->lang->line('programme'), 'trim|required'); 
        $this->form_validation->set_rules('sem_type', $this->lang->line('batch'), 'trim|required'); 

        $data['programs']              =   $this->Semester_enrollment_model->get_program_list();    

        if ($this->form_validation->run() == false) 
        {            

        } 
        else
        {           

        $sem_type_id                    = $this->input->post('sem_type');
        $attempts                       = $this->input->post('attempts');   // array
        $unlimited                      = $this->input->post('unlimited');  // array OR NULL (only checked boxes)

        echo "<h3>Processed Data:</h3>";
        echo "Sem Type ID: " . $sem_type_id . "<br>";
        echo "Attempts: <pre>" . print_r($attempts, true) . "</pre>";
        echo "Unlimited (checked only): <pre>" . print_r($unlimited, true) . "</pre>";

        if (!empty($attempts)) 
        {
        foreach ($attempts as $exam_type_id => $max_attempts) 
        {

        // This is CORRECT: unchecked boxes won't be in $unlimited array
        $is_unlimited = (!empty($unlimited) && isset($unlimited[$exam_type_id])) ? 1 : 0;

        echo "Exam Type ID: $exam_type_id, Is Unlimited: $is_unlimited<br>";

        $insertData = [
        'c_sem_type_id'   => $sem_type_id,
        'c_exam_type'     => $exam_type_id,
        'c_max_attempts'  => $is_unlimited ? NULL : (int)$max_attempts,
        'c_is_unlimited'  => $is_unlimited,
        'c_created_by'    =>1, // Use session user ID
        'c_created_at'    => date('Y-m-d H:i:s'),
        'c_status'        => 1
        ];

        echo "Inserting: <pre>" . print_r($insertData, true) . "</pre>";

        $this->db->insert('common_attempt_limits', $insertData);

        if ($this->db->affected_rows() > 0) {
        echo " Insert successful for exam_type_id: $exam_type_id<br>";
        } else {
        echo " Insert failed for exam_type_id: $exam_type_id<br>";
        echo "Last Query: " . $this->db->last_query() . "<br>";
        }
        }

        $this->session->set_flashdata(
        'msg',
        '<div class="alert alert-success">Attempt limits saved successfully</div>'
        );
        } else {
        echo " No attempts data found<br>";
        }

        // Redirect after processing
        redirect('semester_exam/exam_attempt');
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
        
        
        }


