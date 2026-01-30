                <?php
                defined('BASEPATH') OR exit('No direct script access allowed');



                class SemesterAuth extends MY_Controller
                {

                public function __construct()
                {
                parent::__construct();                
                $this->load->model('examgroup_model');
                $this->load->model('Semesterauth_model'); 
                $this->load->model('admitcard_model'); 
                $this->sch_setting_detail       = $this->setting_model->getSetting(); 
                $this->current_session          = $this->setting_model->getCurrentSession();               
                
                }

                


                public function login001()
                {
                $this->load->library('form_validation');
                $this->load->library('session');

                $this->form_validation->set_rules('username', 'Username', 'required|trim');
                $this->form_validation->set_rules('password', 'Password', 'required');

                $data['title']         = 'Semester Login';
                $data['error_message'] = '';

                if ($this->form_validation->run() === FALSE) {
                $this->load->view('userlogin_auth', $data);
                } else {
                $username = $this->input->post('username', TRUE);
                $password = $this->input->post('password', TRUE);

                // 🔹 1. Get sem_user record
                $this->db->where('username', $username);
                $this->db->where('is_active', 'yes');
                $user = $this->db->get('sem_users')->row();

                if (!$user || $user->password != $password) {
                $data['error_message'] = 'Invalid Username or Password';
                $this->load->view('userlogin_auth', $data);
                return;
                }
                // 🔹 2. Get student details

                $this->db->where('id', $user->user_id); // sem_users.user_id -> semester_students.id
                $student   = $this->db->get('semester_students')->row();
                $firstname = $student ? $student->firstname : '';
                $email     = $student ? $student->email : '';
                $mobileno  = $student ? $student->mobileno : '';
                $stud_id   = $student ? $student->id : '';
                $image     = $student && $student->image ? $student->image : 'default.png';              

                $this->db->select('*');
                $this->db->where(array('student_id'=> $user->user_id));
                // $this->db->where('is_active', 1); // optional filter if you have one active record
                $this->db->order_by('id', 'DESC'); // latest promotion (in case of multiple)
                $this->db->limit(1);
                $student_session =  $this->db->get('semester_student_session')->row();                
                $sem_group_id    =  $student_session ? $student_session->sem_group_id : NULL; 
                $student_sem_id  =  $student_session->id; 


                // 🔹 4. Store user data in session
                $session_data   = array(
                'id'            => $user->id,
                'username'      => $user->username,
                'role'          => isset($user->role) ? $user->role : 'student',
                'firstname'     => $firstname,
                'email'         => $email,
                'mobileno'      => $mobileno,
                'user_id'       => $user->user_id,
                'sem_group_id'  => $sem_group_id, // ✅ current semester group
                'stud_id'       => $stud_id,
                'student_sem_id'=> $student_sem_id,
                'image'         => $image,  
                );  

                $this->session->set_userdata('sem_student', $session_data); 
                $this->load->view('layout/semester/header', $data); 
                $this->load->view('user_semester/dashboard', $data);
                $this->load->view('layout/semester/footer', $data);
                }
                } 




                public function login()
                {
                $this->load->library(['form_validation', 'session']);

                $data['title'] = 'Semester Login';
                $data['error_message'] = '';

                $this->form_validation->set_rules('username', 'Username', 'required|trim');
                $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run() === FALSE) {
                $this->load->view('userlogin_auth', $data);
                return;
                }

                $username = $this->input->post('username', TRUE);
                $password = $this->input->post('password', TRUE);

                // 1️⃣ User validation
                $user = $this->db
                ->where('username', $username)
                ->where('is_active', 'yes')
                ->get('sem_users')
                ->row();

                if (!$user || $user->password != $password) {
                $data['error_message'] = 'Invalid Username or Password';
                $this->load->view('userlogin_auth', $data);
                return;
                }

                // 2️⃣ Student details
                $student = $this->db
                ->where('id', $user->user_id)
                ->get('semester_students')
                ->row();

                // 3️⃣ Current semester
                $student_session = $this->db
                ->where('student_id', $user->user_id)
                ->order_by('id', 'DESC')
                ->limit(1)
                ->get('semester_student_session')
                ->row();

                // 4️⃣ Session data
                $session_data = [
                'id'             => $user->id,
                'username'       => $user->username,
                'role'           => $user->role ?? 'student',
                'firstname'      => $student->firstname ?? '',
                'email'          => $student->email ?? '',
                'mobileno'       => $student->mobileno ?? '',
                'user_id'        => $user->user_id,
                'stud_id'        => $student->id ?? '',
                'sem_group_id'   => $student_session->sem_group_id ?? null,
                'student_sem_id' => $student_session->id ?? null,
                'image'          => $student->image ?? 'default.png',
                ];

                $this->session->set_userdata('sem_student', $session_data);

                // ✅ MUST REDIRECT
                redirect('semesterauth/dashboard');
                exit;
                }




        public function dashboard()
        {
        if (!$this->session->has_userdata('sem_student')) 
        {
        redirect('semester_auth/login'); 
        exit;
        }

        $this->load->view('layout/semester/header');
        $this->load->view('user_semester/dashboard');
        $this->load->view('layout/semester/footer');
        } 



                        public function admitcard()
                        {                                           
                        // Load dependencies
                        $this->load->model('examgroup_model');
                        $this->load->library('form_validation');

                        // Get all exam groups
                        $examgroup_result       = $this->examgroup_model->get();
                        $data['examgrouplist']  = $examgroup_result;

                        // Set validation rules
                        $this->form_validation->set_rules('exam_group_id', 'Exam Group', 'required|trim');
                        $this->form_validation->set_rules('exam_id', 'Exam', 'required|trim');

                        if ($this->form_validation->run() == FALSE) {
                        // Show form again if validation fails
                        $this->load->view('layout/semester/header', $data); 
                        $this->load->view('user_semester/admitcard/index', $data);
                        $this->load->view('layout/semester/footer', $data);
                        } 
                        else {
                        // Retrieve POST data safely
                        $exam_group_id          = $this->input->post('exam_group_id', TRUE);
                        $exam_id                = $this->input->post('exam_id', TRUE);

                        // Pass values to the view
                        $data['exam_group_id']  = $exam_group_id;
                        $data['exam_id']        = $exam_id;

                        // Logged-in student from session
                        $sem = $this->session->userdata('sem_student');
                        if (empty($sem) || empty($sem['user_id'])) {
                            redirect('semesterauth/login');
                            return;
                        }
                        $student_id = (int)$sem['user_id'];

                        // Fetch single student record
                        $this->db->where('id', $student_id);
                        $data['students'] = $this->db->get('semester_students')->row();

                        // Optionally: fetch admit card details for this student
                        // if (!isset($this->Semesterexam_model)) {
                        //     $this->load->model('Semesterexam_model');
                        // }

                        $data['get_details'] = $this->Semesterexam_model->get_printcard(array($student_id), $exam_group_id, $exam_id);

                        $this->load->view('layout/semester/header', $data); 
                        $this->load->view('user_semester/admitcard/index', $data);
                        $this->load->view('layout/semester/datatables', $data);
                        $this->load->view('layout/semester/footer', $data);
                        }
                        }                  

                        
                       

                        public function getExamByExamgroup()
                        {
                        $exam_group_id = $this->input->post('exam_group_id');
                        $data          = $this->semesterauth_model->getExamByExamGroup($exam_group_id, true);
                        echo json_encode($data);
                        }




                        

                        public function printCard()
                        {

                        $sem                = $this->session->userdata('sem_student');  
                        $sem_group_id       = $sem['sem_group_id'];  

                        // if (empty($sem) || empty($sem['user_id'])) {
                        // redirect('semesterauth/login');
                        // return;
                        // }

                         $student_id         = (int)$sem['user_id'];

                        // --- Fetch single student record ---
                        // $this->db->where('id', $student_id);
                        // $student            = $this->db->get('semester_students')->row();

                        // if (!$student) {
                        // echo json_encode(['status' => 0, 'error' => 'Student record not found.']);
                        // return;
                        // }

                        // --- Get sem_group_id from the student record ---
                        // $sem_group_id               = $student->sem_group_id;

                        // --- Continue with your existing logic ---
                        $post_exam_group_id         = $this->input->post('exam_group_id');
                        $post_exam_id               = $this->input->post('exam_id');

                        $data['admit_cards']          = $this->admitcard_model->get($this->input->post('admitcard_template'));
                        // $data['exam_subjects']      = $this->Semesterexam_model->getSemExamSubjects($post_exam_id);

                        $data['post_exam_id']        = $post_exam_id;
                        $data['post_exam_group_id']  = $post_exam_group_id;

                        $data['exam_details']        = $this->Semesterexam_model->getexamgroup_And_exam_Name($post_exam_id, $post_exam_group_id);

                        // Now you have $sem_group_id from the student
                         $data['student_details']    = $this->Semesterauth_model->getStudentsAdmitCardByExamAndStudentID($student_id, $post_exam_id, $sem_group_id);

                        $data['sch_setting']         = $this->sch_setting_detail;
                        // $data['students']            = $student;

                        $student_admit_cards         = $this->load->view('user_semester/admitcard/_printadmitcard', $data, true);

                        $array                       = ['status' => 1, 'error' => '', 'page' => $student_admit_cards];
                        echo json_encode($array);
                        }



                        public function logout()
                        {                            
                        // $this->session->unset_userdata('sem_student');
                        // $this->session->sess_regenerate(TRUE); // prevent reuse of old session ID
                        // redirect('semesterAuth/login');   
                        
                        

                        $this->session->unset_userdata('sem_student');
                        $this->session->sess_destroy();

                        // extra cache protection
                        $this->output
                        ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
                        ->set_header('Pragma: no-cache');

                        redirect('semesterauth/login');
                        exit;
                        }


                        }
