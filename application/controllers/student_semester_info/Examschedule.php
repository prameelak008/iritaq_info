            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class ExamSchedule extends MY_Controller
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

            $this->session->set_userdata('top_menu', 'Examinations');
            $this->session->set_userdata('sub_menu', 'examSchedule/index');
            $data['title']          = 'Exam Schedule';

            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');


            $student_current_class  = $this->customlib->getStudentCurrentClsSection();
            // $student_session_id    = $student_current_class->student_session_id;

            $sem                    = $this->session->userdata('sem_student');  
            $sem_group_id           = $sem['sem_group_id'];  

            $student_id             = (int)$sem['user_id'];         

            $examSchedule           = $this->semesterauth_model->studentExams($student_id,$sem_group_id);    
            $data['examSchedule']   = $examSchedule;

            // $this->load->view('layout/student/header', $data);
            // $this->load->view('user/exam_schedule/examList', $data);
            // $this->load->view('layout/student/footer', $data);

            $this->load->view('layout/semester/header', $data); 
            $this->load->view('user_semester/exam_schedule/examList', $data);
            $this->load->view('layout/semester/datatables', $data);
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
