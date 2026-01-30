        <?php
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }
        
        class Improvement extends Admin_Controller
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
        if (!$this->rbac->hasPrivilege('application_for_improvement', 'can_view')) {
        access_denied();
        }
        
        
        $this->session->set_userdata('top_menu','Improvement');
        $this->session->set_userdata('sub_menu','Improvement/application_for_improvement');
        
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        $marksheet_result         = $this->marksheet_model->get();
        $data['marksheetlist']    = $marksheet_result;
        $class                    = $this->class_model->get();
        $data['title']            = 'Improvemnt';
        $data['title_list']       = 'Improvemnt';
        $data['examType']         = $this->exam_type;
        $data['classlist']        = $class;
        $session                  = $this->session_model->get();
        $data['sessionlist']      = $session;
        $data['current_session']  = $this->sch_current_session;
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
        $data['improvementexam']            = $this->Examimprovement_model->getimprovement_subjectfor_teachers($exam_id, $exam_group_id,$class_id, $section_id,$session_id);
        $data['getgroup_name']      = $this->examresult_model->getgroup_name($exam_id, $exam_group_id);
        //$data['studentList']      = $studentList;
        $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
        $data['exam_grades']        = $exam_grades;
        $data['exam_details']       = $exam_details;
        $data['exam_id']            = $exam_id;
        $data['exam_group_id']      = $exam_group_id;
        $data['session_id']         = $session_id;
        $data['class_id']           = $class_id;
        $data['section_id']         = $section_id;
        $data['attendence_exam']    = $this->attendence_exam;
        }   
        $data['sch_setting']        = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/improvement/index', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        function update_marksentry()
        {
        $exam_group_exam_improvement_id  = $this->input->post('exam_group_exam_improvement_id');
        $exam_group_exam_result_id       = $this->input->post('exam_group_exam_result_id');
        $get_cmarks                      = $this->input->post('get_cmarks');
        $get_marks                       = $this->input->post('get_marks'); 
        $resultid                        = $this->input->post('resultid');
        for($i=0;$i<count($exam_group_exam_improvement_id);$i++)
        {
        $data[$i]          =    array(                                 
        //'exam_group_exam_improvement_updated_getcmarks'   =>  $get_cmarks[$i],
        'exam_group_exam_improvement_updated_getmarks'     =>  $get_marks[$i],
        'exam_group_exam_improvement_approvedstatus'        =>  2,
        );
        $this->db->where('exam_group_exam_improvement_id', $exam_group_exam_improvement_id[$i]);            
        $this->db->update('exam_group_exam_improvement', $data[$i]);
        }
        for($i=0;$i<count($resultid);$i++)
        { 
        $dat[$i]          =    array(                                 
        // 'get_cmarks'         =>  $get_cmarks[$i],
        'get_marks'          =>  $get_marks[$i]
       );                                    
        $this->db->where('id', $resultid[$i]);            
        $this->db->update('exam_group_exam_results', $dat[$i]);
        }
        redirect($_SERVER['HTTP_REFERER'],'refresh');
        }
        
        
        public function  getstudent_improvementlist_modal()
        {
        $students_array       =   array();
        $student              =   $this->input->post('student');
        $students_array       = $this->input->post('exam_group_exam_studentid');
        $post_exam_id         = $this->input->post('post_exam_id');
        $post_exam_group_id   = $this->input->post('post_exam_group_id');
        $data['improvement'] = $this->Examimprovement_model->getimprovement_subjectfor_Marks($post_exam_id, $post_exam_group_id, $students_array);
        $data['getgroup_name'] = $this->examresult_model->getgroup_name($post_exam_id, $post_exam_group_id);
        $data['improvement_approved_status'] = $this->Examimprovement_model->improvement_approved_status($post_exam_id, $post_exam_group_id, $students_array);
        if (!$this->input->is_ajax_request())
        {
        exit('No direct script access allowed');
        }                     
        
        $this->load->view('admin/improvement/online_exam_ajax',$data);
        }
        
        
        
        public function printimprovement() 
        {
        $student_data                 = $this->customlib->getLoggedInUserData();
        $student_id                   = $this->customlib->getStudentSessionUserID();
        $student_current_class        = $this->customlib->getStudentCurrentClsSection();
        $data['students_listt']       = $this->student_model->get_student_list($student_id);
        $students_array               = $this->input->post('exam_group_class_batch_exam_student_id');
        $post_exam_id                 = $this->input->post('post_exam_id');
        $post_exam_group_id           = $this->input->post('post_exam_group_id');
        $session_id                   = $this->input->post('session_id'); 
        $class_id                     = $this->input->post('class_id'); 
        $section_id                   = $this->input->post('section_id');
        $data['session_id']           = $session_id;
        $data['class_id']             = $class_id;
        $data['section_id']           = $section_id;
        $data['post_exam_id']         = $post_exam_id;
        $data['post_exam_group_id']   = $post_exam_group_id;
        $data['getgroup_name']        = $this->examresult_model->getgroup_name($post_exam_id, $post_exam_group_id);
        $exam                         = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam']                 = $exam;
        $exam_grades                  = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades']          = $exam_grades;
        $data['student_details']      = $this->examstudent_model->getStudentsAdmitCardByExamAndStudentID($students_array, $post_exam_id);
        
        
        $data['improvement_marks']    = $this->Examimprovement_model->admin_get_improvement_students($post_exam_id, $post_exam_group_id,$students_array);
        
        $data['improvementfee_feecharge_te']    = $this->Examimprovement_model->improvementfee_feecharge($post_exam_id, $post_exam_group_id,$session_id);
        $data['sch_setting']          = $this->sch_setting_detail;
        
        $student_exam_page            = $this->load->view('admin/improvement/_printimprovement', $data, true); 
        $array                        = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
        echo json_encode($array); 
        }
        
        
        
        
        
                        /*.....................Update Payment.......................................................*/
                        
                        
                        
                        public function checkpayment()
                        {
                        if (!$this->rbac->hasPrivilege('checkpayment_improvement', 'can_view')) 
                        {
                        access_denied();
                        }
                        
                        $this->session->set_userdata('top_menu','Improvement');
                        $this->session->set_userdata('sub_menu','Improvement/checkpayment_improvement');
                        
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
                        $data['logindetails']    =   $this->examgroup_model->list_online_examination();
                        
                        $class                   =   $this->class_model->get();
                        $data['classlist']       =   $class; 
                       
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
                        
                        $data['online_examlist']  =  $this->examgroup_model->list_online_exam_improvement($exam_group_id,$exam_id,$session_id,$class_id,$section_id);
                        $data['feelist']          =  $this->examgroup_model->online_exam_update_fees_improvement($exam_group_id,$exam_id,$session_id,$class_id,$section_id);
                        }
                        // $data['current_session']  =  $this->current_session; 
                        $this->load->view('layout/header', $data);
                        $this->load->view('admin/improvement/updatepayment', $data);
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
                        'fees_improvementpayment_orderid'                   =>  $orderid,
                        'fees_improvementpayment_transaction_no'            =>  $transaction,
                        'fees_improvementpayment_amount'                    =>  $amount,
                        'fees_improvementpayment_transdate'                 =>  $transactiondate,
                        'fees_improvementpayment_student_id'                =>  $student_id,
                        'fees_improvementpayment_examgroup'                 =>  $exam,
                        'fees_improvementpayment_examgroupbatch'            =>  $examgroup,
                        'fees_improvementpayment_session_id'                =>  $session_id,
                        'fees_improvementpayment_class_id'                  =>  $class_id,
                        'fees_improvementpayment_section_id'                =>  $section_id,
                        'fees_improvementpayment_onlinestatus'              =>  'Worldline-3rd Stage',
                        'fees_improvementpayment_id_status'                 =>  '1',
                        'fees_improvementpayment_statuscode'                =>  'S',
                        'fees_improvementpayment_errormsg'                  => 'Successfully processed by the office',
                        'fees_improvementpayment_updated_date'              =>  date('Y-m-d H:i:s'),
                        'fees_improvementpayment_year'                      =>  date('Y'),
                        'fees_improvementpayment_notes'                     =>  $notes);
                        $inserted = $this->db->insert('fees_improvementpayment', $data);
                        echo json_encode($inserted);
                        }
                        
                        
                        
                        public function deletefees()
                        {
                        $id=$this->input->post('id');
                        $cond=array('fees_improvementpayment_id'=>$id);
                        $empdelete=$this->db->delete('fees_improvementpayment',$cond);
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
        
        
