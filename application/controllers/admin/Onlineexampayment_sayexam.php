                        <?php
                        
                        if (!defined('BASEPATH')) 
                        {
                        exit('No direct script access allowed');
                        }
                        
                        class Onlineexampayment_sayexam extends Admin_Controller
                        {
                        
                        public $sch_setting_detail = array();
                        
                        public function __construct()
                        {
                        parent::__construct();        
                        $this->sch_setting_detail = $this->setting_model->getSetting();        
                        $this->current_session = $this->setting_model->getCurrentSession();
                        
                        }
                        
                        
                        
                        
                        
                        
                        
                        public function index()
                        {
                            
                        // if (!$this->rbac->hasPrivilege('exam_result', 'can_view')) 
                        // {
                        // access_denied();
                        // }
                        $this->session->set_userdata('top_menu', 'Online_Examinations');
                        $this->session->set_userdata('sub_menu', 'Online_Examinations/Onlineexampayment_sayexam');
                        $examgroup_result           = $this->examgroup_model->get();
                        $data['examgrouplist']      = $examgroup_result;
                        
                        $marksheet_result           = $this->marksheet_model->get();
                        $data['marksheetlist']      = $marksheet_result;
                        
                        $class                      = $this->class_model->get();
                        $data['title']              = 'Add Batch';
                        $data['title_list']         = 'Recent Batch';
                        $data['examType']           = $this->exam_type;
                        $data['classlist']          = $class;
                        $session                    = $this->session_model->get();
                        $data['sessionlist']        = $session;
                        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
                        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
                        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
                        
                        if ($this->form_validation->run() == false) 
                        {
                        
                        } 
                        else
                        {
                        $exam_group_id              = $this->input->post('exam_group_id');
                        $exam_id                    = $this->input->post('exam_id');
                        $session_id                 = $this->input->post('session_id');
                        $class_id                   = $this->input->post('class_id');
                        $section_id                 = $this->input->post('section_id');
                        $marksheet_template         = $this->input->post('marksheet');
                        $data['marksheet_template'] = $marksheet_template;
                        $exam_details               = $this->examgroup_model->getExamByID($exam_id);
                        $studentList                = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
                        if (!empty($studentList)) {
                        foreach ($studentList as $student_key => $student_value) {
                        $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
                        }
                        }
                        
                        $data['studentList']      = $studentList;
                        $data['Exam_group_list']  = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
                        $data['examList']         = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                        $exam_grades              = $this->grade_model->getByExamType($exam_details->exam_group_type);
                        $data['exam_grades']      = $exam_grades;
                        $data['exam_details']     = $exam_details;
                        $data['exam_id']          = $exam_id;
                        $data['exam_group_id']    = $exam_group_id;
                        $data['class_id']         = $class_id;
                        $data['section_id']       = $section_id;
                        $data['session_id']       = $session_id;
                        
                        
                        $data['exampayments'] = $this->examgroupstudent_model->getexam_payment_sayexam($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
                        }
                        $data['current_session'] = $this->current_session ;
                        
                        
                        $data['sch_setting'] = $this->sch_setting_detail;
                        $this->load->view('layout/header', $data);
                        $this->load->view('admin/onlineexam_feespayment/sayexam/index', $data);
                        $this->load->view('layout/footer', $data);
                        }
                        
                        
                        
                        
                        public function getpaymentdetails()
                        {
                            
                           if (!$this->rbac->hasPrivilege('exam_result', 'can_view')) 
                        {
                        access_denied();
                        }
                        
                        //$this->session->set_userdata('top_menu', 'Examinations');
                        //$this->session->set_userdata('sub_menu', 'Examinations/Examresult');
                        $student_id             = $this->input->post('student_id');
                        $exam_id                = $this->input->post('exam');
                        $exam_group_id          = $this->input->post('examgroup');
                        $class_id               = $this->input->post('class_id');
                        $session_id             = $this->input->post('session_id');
                        $section_id             = $this->input->post('section_id');
                        $data['paymentdetails'] = $this->examgroupstudent_model->getpaymentdetails_bystudent_sayexam($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id);
                        
                        $data['sch_setting'] = $this->sch_setting_detail;
                        $this->load->view('layout/header', $data);
                        $this->load->view('admin/onlineexam_feespayment/sayexam/paymentdetails', $data);
                        $this->load->view('layout/footer', $data);
                        }
                        
                        }      
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
