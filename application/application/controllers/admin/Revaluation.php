            <?php
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }
            
            class Revaluation extends Admin_Controller
            {
            
            public $exam_type            = array();
            private $sch_current_session = "";
            
            public function __construct()
            {
            parent::__construct();
            $this->load->library('encoding_lib');
            $this->load->library('mailsmsconf');
            $this->exam_type           = $this->config->item('exam_type');
            $this->sch_current_session = $this->setting_model->getCurrentSession();
            $this->attendence_exam     = $this->config->item('attendence_exam');
            $this->sch_setting_detail  = $this->setting_model->getSetting();
            }
            
            
            
            public function index() 
            {
            if (!$this->rbac->hasPrivilege('revaluation', 'can_view')) {
            access_denied();
            } 
            
            $this->session->set_userdata('top_menu', 'Revaluation');
            $this->session->set_userdata('sub_menu', 'Revaluation/application_for_revaluation');
            
            $examgroup_result               = $this->examgroup_model->get();
            $data['examgrouplist']          = $examgroup_result;
            
            $marksheet_result               = $this->marksheet_model->get();
            $data['marksheetlist']          = $marksheet_result;
            $data['current_session']        = $this->sch_current_session;
            $class                          = $this->class_model->get();
            $data['title']                  = 'Revaluation';
            $data['title_list']             = 'Revaluation';
            $data['examType']               = $this->exam_type;
            $data['classlist']              = $class;
            $session                        = $this->session_model->get();
            $data['sessionlist']            = $session;
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == false) {
            
            }
            else
            {
            $data['exam_group_id']       = $this->input->post('exam_group_id');
            $data['exam_id']             = $this->input->post('exam_id');
            $data['session_id']          = $this->input->post('session_id');
            $data['class_id']            = $this->input->post('class_id');
            $data['section_id']          = $this->input->post('section_id');
            $marksheet_template          = $this->input->post('marksheet');
            $data['marksheet_template']  = $marksheet_template;
            $exam_id                     = $data['exam_id'];
            $exam_details                = $this->examgroup_model->getExamByID($exam_id);
            
            $exam_group_id  = $data['exam_group_id'];
            $exam_id        = $data['exam_id'];
            $session_id     = $data['session_id'];
            $class_id       = $data['class_id'];
            $section_id     = $data['section_id'];
            
            $data['revaluation']        = $this->examresult_model->getrevaluation_subjectfor_teachers($exam_id, $exam_group_id,$class_id, $section_id,$session_id);
            $data['getgroup_name']      = $this->examresult_model->getgroup_name($exam_id, $exam_group_id);
            $data['get_class_section']  = $this->classsection_model->getDetailbyClassSection($class_id, $section_id);
            $data['sess']               = $this->session_model->get($session_id);
            $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
            $data['exam_grades']        = $exam_grades;
            $data['exam_details']       = $exam_details;
            $data['exam_id']            = $exam_id;
            $data['exam_group_id']      = $exam_group_id;
            $data['attendence_exam']    = $this->attendence_exam;
            }   
            $data['sch_setting']        = $this->sch_setting_detail;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/revaluation/index', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            
            
            function update_marksentry()
            {
            $exam_group_exam_revaluation_id                  = $this->input->post('exam_group_exam_revaluation_id');
            $exam_group_exam_result_id                       = $this->input->post('exam_group_exam_result_id');
            $get_cmarks                                      = $this->input->post('get_cmarks');
            $get_marks                                       = $this->input->post('get_marks');
            $resultid                                        = $this->input->post('resultid');
            
            for($i=0;$i<count($exam_group_exam_revaluation_id);$i++)
            {
            $data[$i]          =    array(                                 
            'exam_group_exam_revaluation_updated_getcmarks'   =>  $get_cmarks[$i],
            'exam_group_exam_revaluation_updated_getmarks'    =>  $get_marks[$i],
            'exam_group_exam_revaluation_approvedstatus'      =>  2,
            );
            
            $this->db->where('exam_group_exam_revaluation_id', $exam_group_exam_revaluation_id[$i]);            
            $this->db->update('exam_group_exam_revaluation', $data[$i]);
            }
            for($i=0;$i<count($resultid);$i++)
            {
            $dat[$i]              =    array(                                 
            'get_cmarks'         =>  $get_cmarks[$i],
            'get_marks'          =>  $get_marks[$i]);                                    
            $this->db->where('id', $resultid[$i]);            
            $this->db->update('exam_group_exam_results', $dat[$i]);
            }
            redirect($_SERVER['HTTP_REFERER'],'refresh');
            }
            
            
            
            public function printrevaluation() 
            {
            $student_data                       = $this->customlib->getLoggedInUserData();
            $student_id                         = $this->customlib->getStudentSessionUserID();
            $student_current_class              = $this->customlib->getStudentCurrentClsSection(); 
            $data['students_listt']             = $this->student_model->get_student_list($student_id);
            $students_array                     = $this->input->post('exam_group_class_batch_exam_student_id');
            // $data['students_arrayy']=$students_array ;
            //$data['template']                 = $this->marksheet_model->get($this->input->post('marksheet_template'));
            $post_exam_id                       = $this->input->post('post_exam_id');
            $post_exam_group_id                 = $this->input->post('post_exam_group_id');
            $session_id                         = $this->input->post('session_id'); 
            $class_id                           = $this->input->post('class_id'); 
            $section_id                         = $this->input->post('section_id');
            $data['session_id']                 = $session_id;
            $data['class_id']                   = $class_id;
            $data['section_id']                 = $section_id;
            $data['post_exam_id']               = $post_exam_id;
            $data['post_exam_group_id']         = $post_exam_group_id;
            
            $data['getgroup_name']              = $this->examresult_model->getgroup_name($post_exam_id, $post_exam_group_id);
            $exam                               = $this->examgroup_model->getExamByID($post_exam_id);
            $data['exam']                       = $exam;
            
            $exam_grades                        = $this->grade_model->getByExamType($exam->exam_group_type);
            $data['exam_grades']                = $exam_grades;
            //$data['marksheet']                = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
            
            $data['student_details']            = $this->examstudent_model->getStudentsAdmitCardByExamAndStudentID($students_array, $post_exam_id);
            
            $data['revluation_marks']           = $this->examresult_model->admin_getstudents($post_exam_id, $post_exam_group_id,$students_array);
            $data['revaluation_feecharge']      = $this->examgroup_model->revaluation_feechargeadmin($post_exam_id, $post_exam_group_id,$session_id);
            //$data['revaluation_payment']      = $this->examresult_model->get_revaluation_payment($post_exam_id, $post_exam_group_id,$students_array);
            $data['sch_setting']                = $this->sch_setting_detail;
            $student_exam_page                  = $this->load->view('admin/revaluation/_printrevaluation', $data, true); 
            $array                              = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
            echo json_encode($array);
            }
            
            
            
            public function  getstudent_revaluationlist_modal ()
            {
            $students_array                         =   array();
            $student                                =   $this->input->post('student'); 
            $students_array                         =   $this->input->post('exam_group_exam_studentid');
            $post_exam_id                           =   $this->input->post('post_exam_id');
            $post_exam_group_id                     =   $this->input->post('post_exam_group_id');
            $data['revaluation']                    =   $this->examresult_model->getrevaluation_subjectfor_Marks($post_exam_id, $post_exam_group_id, $students_array);
            $data['getgroup_name']                  =   $this->examresult_model->getgroup_name($post_exam_id, $post_exam_group_id);
            $data['revaluation_approved_status']    =   $this->examresult_model->revaluation_approved_status($post_exam_id, $post_exam_group_id, $students_array);
            if (!$this->input->is_ajax_request())
            {
            exit('No direct script access allowed');
            } 
            $this->load->view('admin/revaluation/online_exam_ajax',$data);
            }
            }
            
            
            
            
            
            
            
            
            
            
