        <?php
        
        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }
        
        class Onlineexam_list extends Admin_Controller
        {
        
        public $sch_setting_detail = array();
        
        public function __construct()
        {
        parent::__construct();
        $this->config->load('app-config');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->current_session = $this->setting_model->getCurrentSession();
        }
        
        
        public function index()
        {
           
        $data=array();
        $this->session->set_userdata('top_menu', 'Online_Examinations');
        $this->session->set_userdata('sub_menu', 'Online_Examinations/onlineexam_list');
        $questionList            =  $this->onlineexam_model->get();
        $data['questionList']    =  $questionList;
        $subject_result          =  $this->subject_model->get();
        $data['subjectlist']     =  $subject_result;
        
        $examgroup_result        =  $this->examgroup_model->get();
        $data['examgrouplist']   =  $examgroup_result;
        
        $data['classList']       =  $this->class_model->get();
        $exam                    =  $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam']            =  $exam;
        $session                 =  $this->session_model->get();
        $data['sessionlist']     =  $session;
        
        $data['logindetails']    =  $this->examgroup_model->list_online_examination();
        
        $class                   =  $this->class_model->get();
        
        $data['classlist']       =  $class; 
        
        $exam_group_id           =  $this->input->post('exam_group_id');
        $exam_id                 =  $this->input->post('exam_id');
        $session_id              =  $this->input->post('session_id');
        $class_id                =  $this->input->post('class_id');
        $section_id              =  $this->input->post('section_id');
        $data['exam_group_id']   =  $exam_group_id  ;
        $data['exam_id']         =  $exam_id  ;
        $data['session_id']      =  $session_id  ;
        $data['class_id']        =  $class_id  ;
        $data['section_id']      =  $section_id  ;
         $data['online_examlist'] =   $this->examgroup_model->list_online_exam($exam_group_id,$exam_id,$session_id,$class_id,$section_id);

       
        $data['current_session'] =   $this->current_session;
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/onlineexam_adminview/index', $data);
        $this->load->view('layout/footer', $data);
        }
        


        
        public function Loginsearchvalidation()
        {
        $class_id                =   $this->input->post('class_id');
        $section_id              =   $this->input->post('section_id');
        $namelist                =   $this->input->post('namelist');
        $data['logindetails']    =   $this->examgroup_model->NewlistlogindetailsId($class_id,$section_id,$namelist);         
        
        if (!$this->input->is_ajax_request())
        {
        exit('No direct script access allowed');
        }
        $this->load->view('admin/onlineexam_adminview/studentajxbyclass',$data);
        }
        
        public function delete_student_online_exam()
        {
        $this->current_session = $this->setting_model->getCurrentSession();    
        $studid      = $this->input->post('studid');
        $group       = $this->input->post('group');
        $exambatchid = $this->input->post('exambatchid');
        
        $this->db->select()->from('fees_payment');
        $this->db->where('fees_payment_student_id', $studid);
        $this->db->where('fees_payment_examgroup', $group);
        $this->db->where('fees_payment_exam', $exambatchid);
        $this->db->where('fees_payment_session', $this->current_session);
        
         $query = $this->db->get();
         $datval                =    $query->result_array(); 
         echo $this->customlib->getAdminSessionUserName();
         
        
        if(!empty($datval))
        {
            foreach($datval as $dt)
            {
            $fees_payment_id           =   $dt['fees_payment_id'];
            $fees_payment_statuscode   =   $dt['fees_payment_statuscode'];
            
             $data = array(
             'fees_payment_cancelled_details'                   => 'Success Payment cancelled by' .''.$this->customlib->getAdminSessionUserName().''.'on'.''. date('d-m-Y H:i:s'),
            'fees_payment_statuscode' =>'F'
            );
            
            
            $this->db->where(array('fees_payment_id'=>$fees_payment_id,'fees_payment_statuscode'=>'S'));
            $this->db->update('fees_payment',$data);
            }
        }
        
        $this->db->where('online_examination_student_id', $studid);
        $this->db->where('online_examination_examgroup', $group);
        $this->db->where('online_examination_exam', $exambatchid);
        
        $this->db->where('online_examination_session_id', $this->current_session);
        $this->db->delete('online_examination');
        
        $this->db->where('online_examination_student_id', $studid);
        $this->db->where('online_examination_examgroup', $group);
        $this->db->where('online_examination_exam', $exambatchid);
        $this->db->where('online_examination_session_id', $this->current_session);
        $this->db->delete('online_examination_accept'); 
        
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        
        public function bulkdelete_student_online_exam()
        { 
        $this->current_session = $this->setting_model->getCurrentSession();
        $tb            =   "online_examination"; 
        $tb1           =   "online_examination_accept"; 
        $checkbox      = $this->input->post('check');
        for($i=0;$i<count($checkbox);$i++)
        {
        $del_id[$i] = $checkbox[$i];
        $cdt[$i]=array('online_examination_student_id'=> $del_id[$i],
        'online_examination_session_id'=> $this->current_session 
        );                         
        $this->db->delete($tb,$cdt[$i]);                      
        } 
        
        for($i=0;$i<count($checkbox);$i++)
        {
        $del_id[$i] = $checkbox[$i];
        $cd[$i]=array('online_examination_student_id'=> $del_id[$i],
        'online_examination_session_id'=> $this->current_session ,
        );
        $this->db->delete($tb1,$cd[$i]);                      
        }
        
        if(isset($_POST['generate']))
        {
        
        $data = array();
        
        if ($this->form_validation->run() == false) 
        {
        $data = array(
        'post_exam_id' => form_error('post_exam_id'),
        'post_exam_group_id' => form_error('post_exam_group_id'),
        'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
        );
        $array = array('status' => 0, 'error' => $data);
        echo json_encode($array);
        }
        else
        {
        $data['template'] = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $post_exam_id = $this->input->post('post_exam_id');
        $post_exam_group_id = $this->input->post('post_exam_group_id');
        
        $data['marksheet_Newexamgroup'] = $this->input->post('marksheet_Newexamgroup');
        $data['marksheet_Newexambatch'] = $this->input->post('marksheet_Newexambatch');
        $students_array = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam'] = $exam;
        $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades'] = $exam_grades;
        $data['marksheet'] = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
        $data['sch_setting'] = $this->sch_setting_detail;
        
        $student_exam_page = $this->load->view('admin/examresult/_printmarksheet', $data, true); 
        $array = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
        echo json_encode($array);
        }
        }
        }
        
        
        
        public function approve_onlineexam()
        { 
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult/admitcard');
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        $data['get_groups']       = $this->examgroup_model->get_groups($student_id);
        $class                    = $this->class_model->get();
        $data['examType']         = $this->exam_type;
        $data['classlist']        = $class;
        $session                  = $this->session_model->get();
        $data['sessionlist']      = $session;
        
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('student'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('admitcard', $this->lang->line('admit') . " " . $this->lang->line('card') . " " . $this->lang->line('template'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) 
        {
        
        } 
        else 
        {
        $exam_group_id              = $this->input->post('exam_group_id');
        $exam_id                    = $this->input->post('exam_id');
        $admitcard_template         = $this->input->post('admitcard');
        $data['admitcard_template'] = $admitcard_template;
        
        $data['student_Newvalue']    = $this->examgroupstudent_model->searchExamStudentsByExam_NewStudent($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$admitcard_template);
        
        $data['examList']          = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        $data['exam_id']           = $exam_id;
        $data['exam_group_id']     = $exam_group_id;
        
        }
        $data['sch_setting']        = $this->sch_setting_detail; 
        $this->load->view('layout/header', $data);
        $this->load->view('admin/onlineexam/approve_online_examination',$data);
        $this->load->view('layout/footer', $data);
        }
        
        
        public function online_examination_get_student()
        {
        $student_data               =   $this->customlib->getLoggedInUserData();
        $student_id                 =   $this->customlib->getStudentSessionUserID();
        $student_current_class      =   $this->customlib->getStudentCurrentClsSection();
        
        $examid                     =   $this->input->post('examid');
        $exam_group_id              =   $this->input->post('exam_group_id');
        
        $data['getsubjectid']       =   $this->examgroup_model->online_examination_getsubjectlist($examid,$student_id);
        $data['online_exam_accept'] =   $this->examgroup_model->admin_online_examination_approve($examid,$exam_group_id);
        if (!$this->input->is_ajax_request())
        {
        exit('No direct script access allowed');
        } 
        $this->load->view('admin/onlineexam/online_examination_ajax',$data);
        }       


        
        public function listonlinexam_approvedstatus()
        {      
        
        $exam_group_id     =   $this->input->post('exam_group_id');
        $exam_id           =   $this->input->post('exam_id');
        $status_list       =   $this->input->post('status_list');
        
        $data['listexam']  =   $this->examgroup_model->listexam_ApprovedStatus($exam_group_id,$exam_id,$status_list); 
        
        if (!$this->input->is_ajax_request())
        {
        exit('No direct script access allowed');
        }
        
        $this->load->view('admin/onlineexam_adminview/studentajx_approvedstatus_onlineexam',$data);
        }
        
        


        public function update_approval()
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $studid           =   $this->input->post('studid');
        $group            =   $this->input->post('group');
        $exambatchid      =   $this->input->post('exambatchid');
        $approvedstatus   =   $this->input->post('approvedstatus');
        $class_id         =   $this->input->post('class_id');
        $section_id       =   $this->input->post('section_id');
        $examschedule     =   $this->examgroup_model->getlist_NewExamGroup($group,$exambatchid);        
        $studentid        =   $this->examgroup_model->getExamstudent($studid);        
        $student_sessionid=   $studentid['student_sessionid'];
        $date="date('d-m-Y')";
        $this->examgroup_model->update_value($approvedstatus,$studid,$group,$exambatchid,$class_id,$section_id);
        }


        public function update_staffapproval()
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $studid           =   $this->input->post('studid');
        $group            =   $this->input->post('group');
        $exambatchid      =   $this->input->post('exambatchid');
        $approvedstatus   =   $this->input->post('approvedstatus');
        $class_id         =   $this->input->post('class_id');
        $section_id       =   $this->input->post('section_id');
        $examschedule     =   $this->examgroup_model->getlist_NewExamGroup($group,$exambatchid);
        
        $studentid        =   $this->examgroup_model->getExamstudent($studid);
        
        $student_sessionid=   $studentid['student_sessionid'];
        $date="date('d-m-Y')";
        $this->examgroup_model->update_value_staff($approvedstatus,$studid,$group,$exambatchid,$class_id,$section_id);
        }
        
        
        
        
        public function send_approval()
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $studid           =   $this->input->post('studid');
        $group            =   $this->input->post('group');
        $exambatchid      =   $this->input->post('exambatchid');
        $examschedule     =   $this->examgroup_model->getlist_NewExamGroup($group,$exambatchid);
        $studentid        =   $this->examgroup_model->getExamstudent($studid);
        $student_sessionid=   $studentid['student_sessionid'];
        $date="date('d-m-Y')";
        $res=$this->mailsmsconf->mailsms("exam_application", $student_sessionid, $date, $examschedule);
        echo json_encode($res);
        }
        
        
        public function viewsubjectpdf_printer()
        {
        $studid                          =   $this->input->post('studid');
        $group                           =   $this->input->post('group');
        $batchid                         =   $this->input->post('exambatchid');
        $data['studid']                  =   $this->onlineexam_model->get_studentdetails($studid);
        $data['subjects']                =   $this->onlineexam_model->get_subjectdetails($studid,$group,$batchid);
        
        $data['getstudent_workingdays']  =   $this->examgroup_model->view_attendence($studid);
        $data['getstudent_presentdays']  =   $this->examgroup_model->view_Studentattendence($studid);
        
        $data['getstudent_halfdays']     =   $this->examgroup_model->view_Studentattendence_halfdays($studid);
        
        $data['subjects_row']            =   $this->onlineexam_model->get_subjectdetails_row($studid,$group,$batchid);
        
        $data['html']= $this->load->view('user/online_examination/online_examination_pdf',$data);
        
        echo json_encode($data);
        }
        
        
        
        
        
        
        public function online_exam_instruction()
        {
            
        // if (!$this->rbac->hasPrivilege('online_examination_instruction', 'can_view')) 
        //{
        //access_denied();
        //}
        
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'Online_Examinations');    
        $this->session->set_userdata('sub_menu', 'Online_Examinations/online_examination_instruction');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        
        $data['title']                 =  'Instruction';
        $data['online_instructon']     =  $this->onlineexam_model->online_instruction();
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        
        if ($this->form_validation->run() == false) 
        {
        $this->load->view('layout/header', $data);
        $this->load->view('online_exam_instruction/sectionList', $data);
        $this->load->view('layout/footer', $data);
        } 
        else
        {
        
        }
        
        }
        
        
        
        
        public function add_inst()
        {
        $lastdate         = $this->input->post('lastdate_of_exam'); 
        $closingdate      = $this->input->post('closingdate');
        $newDate          = date("d-m-Y", strtotime($lastdate));
        $closingdate      = date("d-m-Y", strtotime($closingdate));
        
        if (isset($_POST['is_status']))
        {
        $is_status = 1;
        } 
        else
        {
        $is_status = 0;
        }
        
        $data = array(
        'online_examination_heading'                  => $this->input->post('online_examination_heading'),
        'online_examination_examgroup'                => $this->input->post('exam_group_id'),
        'online_examination_examid'                   => $this->input->post('exam_id'),
        'online_examination_current_session'          => $this->current_session,
        'online_examination_last_date_fee_withoutfine'=> $this->input->post('last_date_fee_withoutfine'),
        'online_examination_last_date_fee_withfine'   => $this->input->post('last_date_fee_withfine'),
        'online_examination_class_leave_for_studying' => $this->input->post('class_leave_for_studying'),
        'online_examination_Examcommencement'         => $this->input->post('Examcommencement'),
        'online_examination_fee_details'              => $this->input->post('fee_details'),
        'online_examination_mode_of_payment'          => $this->input->post('mode_of_payment'),
        'online_examination_declaration'              => $this->input->post('declaration'),
        'online_examination_lasdate_of_exam'          => $newDate,
        'online_examination_is_status'                => $is_status,
        'online_examination_publishdate'              => date("d-m-Y", strtotime($this->input->post('publishdate'))),
        'online_examination_closingdate_of_exam'      => $closingdate,
        'online_examination_closetime'                => $this->input->post('closetime'),
        'online_examination_closemessage'             => $this->input->post('closemessage'),
        'online_examination_remarksafterpayment'      => $this->input->post('remarks_after_fees_payment'),
        
        );
        $this->db->insert('online_examination_instruction',$data); 
        redirect($_SERVER['HTTP_REFERER']);
        }
        
       
        
        public function edit_inst($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'Exam Application');    
        $this->session->set_userdata('sub_menu', 'onlineexam_list/online_examination_instruction');
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        $examgroup_result              =  $this->examgroup_model->get();
        $data['examgrouplist']         =  $examgroup_result;
        $data['title']                 =  'Instruction';
        $data['online_instructon']     =   $this->onlineexam_model->online_instruction();
        $data['editonline_instructon'] =  $this->onlineexam_model->edit_online_instruction($id);
        $this->load->view('layout/header', $data);
        $this->load->view('online_exam_instruction/sectionEdit', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        
        public function update_inst()
        {
        $id               = $this->input->post('online_examination_id');
        $lastdate         = $this->input->post('lastdate_of_exam');
        $exam_group_id    = $this->input->post('exam_group_id');  
        $exam_id          = $this->input->post('exam_id');
        $newDate          = date("d-m-Y", strtotime($lastdate));
        $closingdate         = $this->input->post('closingdate'); 
        
        if (isset($_POST['is_status']))
        {
        $is_status = 1;
        } 
        else
        {
        $is_status = 0;
        }
        $data = array(
        'online_examination_heading'                   => $this->input->post('online_examination_heading'),
        'online_examination_examgroup'                 => $this->input->post('exam_group_id'),
        'online_examination_examid'                    => $this->input->post('exam_id'),
        'online_examination_current_session'           => $this->current_session,
        'online_examination_last_date_fee_withoutfine' => $this->input->post('last_date_fee_withoutfine'),
        'online_examination_last_date_fee_withfine'    => $this->input->post('last_date_fee_withfine'),
        'online_examination_class_leave_for_studying'  => $this->input->post('class_leave_for_studying'),
        'online_examination_Examcommencement'          => $this->input->post('Examcommencement'),
        'online_examination_fee_details'               => $this->input->post('fee_details'),
        'online_examination_mode_of_payment'           => $this->input->post('mode_of_payment'),
        'online_examination_declaration'               => $this->input->post('declaration'),
        'online_examination_publishdate'               => date("d-m-Y", strtotime($this->input->post('publishdate'))), 
        'online_examination_lasdate_of_exam'           => $newDate,
        'online_examination_is_status'                 => $is_status,
        'online_examination_closingdate_of_exam'       => $closingdate,
        'online_examination_remarksafterpayment'       => $this->input->post('remarks_after_fees_payment'),
      
        
        );
        
        $this->db->where('online_examination_id',$id);
        $this->db->update('online_examination_instruction',$data);
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        public function delete_inst($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $tab                   = "online_examination_instruction";
        $data                  = array('online_examination_id'=>$id);
        $this->db->delete($tab,$data); 
        redirect($_SERVER['HTTP_REFERER']);                       
        }
        
        }
