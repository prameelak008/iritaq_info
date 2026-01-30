            <?php

<<<<<<< HEAD
            if (!defined('BASEPATH')) 
            {
=======
            if (!defined('BASEPATH')) {
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            exit('No direct script access allowed');
            }

            class Dashboard extends MY_Controller
            {

            public function __construct()
            {
            parent::__construct();
            }


<<<<<<< HEAD


            public function index()
            {
=======
            public function index()
            { 
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
                
            if (!$this->session->has_userdata('sem_student')) 
            {
            redirect('semester_auth/login'); 
            exit;
<<<<<<< HEAD
            }  
=======
            }

>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

            $data['page']     = 'dashboard/index';
            $data['nav_text'] = 'Dashboard';
            $data['nav_link'] = 'student_semester_info/dashboard';

<<<<<<< HEAD
=======

>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            $this->session->set_userdata('top_menu', 'Examinations');
            $this->session->set_userdata('sub_menu', 'examSchedule/index');
            // $data['title']          = 'Exam Schedule';

            $this->load->view('layout/semester/header', $data); 
            $this->load->view('user_semester/dashboard', $data);
            $this->load->view('layout/semester/footer', $data);
            }



<<<<<<< HEAD
=======



>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            public function getexamscheduledetail()
            {
            // $subjects                   = array();
            // $exam_id                    = $this->input->post('exam_id');
            // $subjects['subject_list']   = $this->semesterauth_model->getExamstudentSubjects($exam_id);
            // $result                     = $this->load->view('user_semester/exam_schedule/_getexamscheduledetail', $subjects,true);

            // echo json_encode(array('status'=>1,'result'=>$result));

            $subjects                   = array();
            $exam_id                    = $this->input->post('exam_id');
            $subjects['subject_list']   = $this->semesterauth_model->getExamstudentSubjects($exam_id);
            $result                     = $this->load->view('user_semester/exam_schedule/_getexamscheduledetail', $subjects,true);
            echo json_encode(array('status'=>1,'result'=>$result));
            }
<<<<<<< HEAD
=======



>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            }
