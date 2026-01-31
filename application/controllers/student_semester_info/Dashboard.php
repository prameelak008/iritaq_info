            <?php

            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            }

            class Dashboard extends MY_Controller
            {

            public function __construct()
            {
            parent::__construct();
            }




            public function index()
            {
                
            if (!$this->session->has_userdata('sem_student')) 
            {
            redirect('semester_auth/login'); 
            exit;
            }  

            $data['page']     = 'dashboard/index';
            $data['nav_text'] = 'Dashboard';
            $data['nav_link'] = 'student_semester_info/dashboard';

            $this->session->set_userdata('top_menu', 'Examinations');
            $this->session->set_userdata('sub_menu', 'examSchedule/index');
            // $data['title']          = 'Exam Schedule';

            $this->load->view('layout/semester/header', $data); 
            $this->load->view('user_semester/dashboard', $data);
            $this->load->view('layout/semester/footer', $data);
            }



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
            }
