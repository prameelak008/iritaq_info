
            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Examapplication extends MY_Controller
            {

            public function __construct()
            {
            parent::__construct();
            }
                       



            public function onlineExamination()
            {                
            // $data['parameters']             = file_get_contents(APPPATH . 'views/user_semester/payment_store/parameters.json'); 
            
            
            $data['parameters']     = $this->payment_parameters->getArray();            

            $this->session->set_userdata('top_menu', 'Examinations');
            $this->session->set_userdata('sub_menu', 'Examinations/applyonlineExamination'); 

            $data['parameters']             = $this->payment_parameters->getArray();
            $data['sem']                    = $this->sem_student;
            $sem_group_id                   = $this->sem_group_id;
            $student_id                     = $this->student_id; 
            $firstname                      = $this->firstname; 
            $data['sess_firstname']         = $firstname;       

            // $sem                            =    $this->session->userdata('sem_student'); 

            // $sem_group_id                   =    $sem['sem_group_id'];  
            // $student_id                     =    (int)$sem['user_id']; 

            // $data['sem']                    =    $sem ;

            $exam_group_id                  =    $this->input->post('exam_group_id');
            $exam_id                        =    $this->input->post('exam_id');            
            // $admitcard_template             =  $this->input->post('admitcard');         
            $data['examList']               =   $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
            $data['exam_id']                =   $exam_id;
            $data['exam_group_id']          =   $exam_group_id;              
            $examgroup_result               =   $this->examgroup_model->get();
            $data['examgrouplist']          =   $examgroup_result; 
            $data['get_instructions']       =   $this->semesterauth_model->get_exam_instructions($exam_group_id, $exam_id);

            $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('admitcard', $this->lang->line('admit') . " " . $this->lang->line('card') . " " . $this->lang->line('template'), 'trim|required|xss_clean');


            if ($this->form_validation->run() == false) 
            {

            } 
            else 
            {            
            } 
            $this->load->view('layout/semester/header', $data); 
            // $this->load->view('layout/semester/datatables', $data);  
            $this->load->view('user_semester/online_examination/online_examination', $data);
            $this->load->view('layout/semester/footer', $data);
            }
            
            


            public function saveApplication()
            {
            $data['parameters'] = file_get_contents(APPPATH . 'views/user_semester/payment_store/parameters.json');                        
            $selected_subjects  = $this->input->post('selected_subjects'); 
            $subjectsArray      = json_decode($selected_subjects, true);
            $student_id         = $this->input->post('student_id');
            $sem_group_id       = $this->input->post('sem_group_id');
            $sem_fees_id        = $this->input->post('sem_fees_id');
            $total_amount       = $this->input->post('total_amount');
            $sem_exam_id        = $this->input->post('sem_exam_id');

            // ---------------------------------------------
            // 1️⃣ CHECK EXISTING APPLICATION
            // ---------------------------------------------

            $existing = $this->db->where('student_id', $student_id)
            ->where('sem_group_id', $sem_group_id)
            ->where('sem_exam_id', $sem_exam_id)
            ->get('sem_exam_application')
            ->row();

            if ($existing) 
            {
            // Update only total amount
            $this->db->where('id', $existing->id)
            ->update('sem_exam_application', [
            "total_amount" => $total_amount,
            "updated_at"   => date("Y-m-d H:i:s")
            ]);

            $application_id = $existing->id;
            }
            else 
            {
            // Insert new application
            $data = [
            "student_id"     => $student_id,
            "sem_group_id"   => $sem_group_id,
            "sem_fees_id"    => $sem_fees_id,
            "total_amount"   => $total_amount,
            'sem_exam_id'    => $sem_exam_id,
            "payment_status" => "PENDING",
            "created_at"     => date("Y-m-d H:i:s")
            ];

            $this->db->insert('sem_exam_application', $data);
            $application_id = $this->db->insert_id();
            }

            // ---------------------------------------------
            // 2️⃣ SYNC SUBJECTS (ONLY CHECKED ONES)
            // ---------------------------------------------

            // Delete all old subjects
            $this->db->where('application_id', $application_id)
            ->delete('sem_exam_subjects');

            // Insert new checked subjects
            if (!empty($subjectsArray))
            {

            foreach ($subjectsArray as $subject_id)
            {
            $subjectData = [
            "application_id" => $application_id, 
            "subject_id"     => $subject_id,
            "created_at"     => date("Y-m-d H:i:s")
            ];
            $this->db->insert('sem_exam_subjects', $subjectData);
            }
            }

            echo json_encode([
            "status"          => "success",
            "application_id"  => $application_id,
            "student_id"      => $student_id,
            "sem_group_id"    => $sem_group_id,
            "sem_exam_id"     => $sem_exam_id,
            "total_amount"    => $total_amount
            ]);
            }


            

            public function loadPaymentPage()
            {
            $application_id = $this->input->post('application_id');
            $student_id     = $this->input->post('student_id');
            $sem_group_id   = $this->input->post('sem_group_id');
            $total_amount   = $this->input->post('total_amount');
            $sem_exam_id    = $this->input->post('sem_exam_id');


            $data['application_id'] = $application_id;
            $data['student_id']     = $student_id;
            $data['sem_group_id']   = $sem_group_id;
            $data['total_amount']   = $total_amount;
            $data['sem_exam_id']    = $sem_exam_id;

            $data['parameters'] = file_get_contents(APPPATH.'views/user_semester/payment_store/parameters.json');
            $this->load->view('layout/semester/header', $data); 
            $this->load->view('user_semester/payment_store/techprocess', $data);
            $this->load->view('layout/semester/footer', $data);
            }




            public function response()
            {
                            
            date_default_timezone_set('Asia/Kolkata');    
            $data['parameters']                 = file_get_contents(APPPATH . 'views/user_semester/payment_store/parameters.json');   

            $data['totalamt']                   = $this->input->post('amount');          
            
            $data['studid']                     = $this->input->post('studid');
            $data['year']                       = $this->input->post('year');
            $data['admission_range']            = $this->input->post('admission_range');
            $data['admission_application_no']   = $this->input->post('admission_application_no');
            $studid                             = $this->session->userdata['session_studid'];
            $data['entrance_current_session']   = $this->Entrance_settings_model->get_entrance_settings();
            $ses                                = $data['entrance_current_session']['session'];
            $data['sessionyear']                = explode("-",  $ses)[0];

            $this->db->where('entrance_reg_id', $studid);
            $query = $this->db->get('entrance_examregister');
            $data['result'] = $query->result(); 

            $data['getcourse']                  = $this->Entranceadmission_model->getcourse($studid);


            // $this->load->view('entrance/layout/header',$data);
            // $this->load->view('entrance/layout/caraosalheader',$data);
            // $this->load->view('entrance/payment_store/response',$data);
            // $this->load->view('entrance/layout/footer');



            $this->load->view('layout/semester/header', $data); 
            $this->load->view('user_semester/payment_store/response', $data);
            $this->load->view('layout/semester/footer', $data);


            }
            }