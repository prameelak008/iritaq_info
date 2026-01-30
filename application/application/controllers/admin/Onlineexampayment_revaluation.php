                        <?php
                        
                        if (!defined('BASEPATH')) 
                        {
                        exit('No direct script access allowed');
                        }
                        
                        class Onlineexampayment_revaluation extends Admin_Controller
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
                        $this->session->set_userdata('sub_menu', 'Online_Examinations/Onlineexampayment_revaluation');
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
                        
                        $data['current_session']     = $this->current_session;
                        
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
                        $data['exampayments']     = $this->examgroupstudent_model->getexam_payment_revaluation($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
                        }
                         
                        $data['current_session'] = $this->current_session ;
                        $data['sch_setting']     = $this->sch_setting_detail;
                        $this->load->view('layout/header', $data);
                        $this->load->view('admin/onlineexam_feespayment/revaluation/index', $data);
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
                        
                        $data['paymentdetails'] = $this->examgroupstudent_model->getpaymentdetails_bystudent_revaluation($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id);
                        
                        $data['sch_setting'] = $this->sch_setting_detail;
                        $this->load->view('layout/header', $data);
                        $this->load->view('admin/onlineexam_feespayment/revaluation/paymentdetails', $data);
                        $this->load->view('layout/footer', $data);
                        }
                        
                        
                        
                        /*.....................Update Payment.......................................................*/
                        
                        
                        
                        public function checkpayment()
                        {
                        // if (!$this->rbac->hasPrivilege('online_examination', 'can_view')) 
                        // {
                        // access_denied();
                        // }
                        
                        $this->session->set_userdata('top_menu', 'Revaluation');
                        $this->session->set_userdata('sub_menu', 'Revaluation/checkpayment_revaluation');
                        
                        
                        $data['current_session'] =   $this->current_session; 
                        $data                    =   array();
                        $questionList            =   $this->onlineexam_model->get();
                        $data['questionList']    =   $questionList;
                        $subject_result          =   $this->subject_model->get();
                        $data['subjectlist']     =   $subject_result;
                        
                        $examgroup_result        =   $this->examgroup_model->get();
                        $data['examgrouplist']   =   $examgroup_result;
                        
                        $data['classList']       =   $this->class_model->get();
                        
                        $exam                    =   $this->examgroup_model->getExamByID($post_exam_id);
                        $data['exam']            =   $exam;
                        
                        $session                 =   $this->session_model->get();
                        $data['sessionlist']     =   $session;
                        
                        
                        
                        $data['logindetails']    = $this->examgroup_model->list_online_examination();
                        
                        $class                   = $this->class_model->get();
                        
                        $data['classlist']       = $class; 
                       
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
                        
                        $exam_group_id        = $this->input->post('exam_group_id');
                        $exam_id              = $this->input->post('exam_id');
                        $session_id           = $this->input->post('session_id');
                        $class_id             = $this->input->post('class_id');
                        $section_id           = $this->input->post('section_id');
                        $data['exam_group_id']    =  $exam_group_id;
                        $data['exam_id']          =  $exam_id;
                        $data['session_id']       =  $session_id;
                        $data['class_id']         =  $class_id;
                        $data['section_id']       =  $section_id;
                        
                        $data['online_examlist']  =  $this->examgroup_model->list_online_exam_revaluation($exam_group_id,$exam_id,$session_id,$class_id,$section_id);
                        $data['feelist']          =  $this->examgroup_model->online_exam_update_fees_rev($exam_group_id,$exam_id,$session_id,$class_id,$section_id);
                        }
                        // $data['current_session']  =  $this->current_session; 
                        
                        $this->load->view('layout/header', $data);
                        $this->load->view('admin/onlineexam_feespayment/revaluation/updatepayment', $data);
                        $this->load->view('layout/footer', $data);
                        } 
                        
                        
                        public function updatefees()
                        {
                        $orderid            = $this->input->post('orderid');
                        $transaction        = $this->input->post('transaction');
                        $amount             = $this->input->post('amount');
                        $transactiondate    = $this->input->post('transactiondate');
                        $student_id         = $this->input->post('student_id');
                        $examgroup          = $this->input->post('examgroup');
                        $exam               = $this->input->post('exam');
                        $session_id         = $this->input->post('session_id');
                        $class_id           = $this->input->post('class_id');
                        $section_id         = $this->input->post('section_id');
                        $notes              = $this->input->post('notes');
                        $year               = date('Y');
                        
                        $data                                               =  array(
                        'fees_revaluationpayment_orderid'                   =>  $orderid,
                        'fees_revaluationpayment_transaction_no'            =>  $transaction,
                        'fees_revaluationpayment_amount'                    =>  $amount,
                        'fees_revaluationpayment_transdate'                 =>  $transactiondate,
                        'fees_revaluationpayment_student_id'                =>  $student_id,
                        'fees_revaluationpayment_examgroup'                 =>  $exam,
                        'fees_revaluationpayment_examgroupbatch'            =>  $examgroup,
                        'fees_revaluationpayment_session_id'                =>  $session_id,
                        'fees_revaluationpayment_class_id'                  =>  $class_id,
                        'fees_revaluationpayment_section_id'                =>  $section_id,
                        'fees_revaluationpayment_onlinestatus'              =>  'Worldline-3rd Stage',
                        'fees_revaluationpayment_id_status'                 =>  '1',
                        'fees_revaluationpayment_updated_date'              =>  date('Y-m-d H:i:s'),
                        'fees_revaluationpayment_year'                      =>  date('Y'),
                        'fees_revaluationpayment_statuscode'                =>  'S',
                        'fees_revaluationpayment_errormsg'                  => 'Successfully processed by the office',
                        'fees_revaluationpayment_notes'                    =>  $notes );
                        $inserted = $this->db->insert('fees_revaluationpayment', $data);
                        echo json_encode($inserted);
                          
                        }
                        
                        
                        
                        
                        
                        
                        public function deletefees()
                        {
                        $id=$this->input->post('id');
                        $cond=array('fees_revaluationpayment_id'=>$id);
                        $empdelete=$this->db->delete('fees_revaluationpayment',$cond);
                        if($empdelete)
                        {
                        echo true;
                        } 
                        else 
                        {
                        echo false;
                        }
                        } 
                        
                        
                        
                        }      
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
