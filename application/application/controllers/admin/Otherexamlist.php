        <?php
        
        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }
        
        class Otherexamlist extends Admin_Controller
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
        
        
        public function others_exam_instruction()
        {
            
        // if (!$this->rbac->hasPrivilege('others_examination_instruction', 'can_view')) 
        //{
        //access_denied();
        //}
        
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'Online_Examinations');    
        $this->session->set_userdata('sub_menu', 'Online_Examinations/others_examination_instruction');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        
        $data['title']                 =  'Instruction';
        $data['online_instructon']     =  $this->onlineexam_model->others_instruction();
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        
        if ($this->form_validation->run() == false) 
        {
        $this->load->view('layout/header', $data);
        $this->load->view('others_exam_instruction/sectionList', $data);
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
        $this->db->insert('others_examination_instruction',$data); 
        redirect($_SERVER['HTTP_REFERER']);
        }
        
       
        
        public function edit_inst($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'Exam Application');    
        $this->session->set_userdata('sub_menu', 'Otherexamlist/others_examination_instruction');
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        $examgroup_result              =  $this->examgroup_model->get();
        $data['examgrouplist']         =  $examgroup_result;
        $data['title']                 =  'Instruction';
        $data['online_instructon']     =   $this->onlineexam_model->others_instruction();
        $data['editonline_instructon'] =  $this->onlineexam_model->edit_others_instruction($id);
        $this->load->view('layout/header', $data);
        $this->load->view('others_exam_instruction/sectionEdit', $data);
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
        $this->db->update('others_examination_instruction',$data);
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        public function delete_inst($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $tab                   = "others_examination_instruction";
        $data                  = array('online_examination_id'=>$id);
        $this->db->delete($tab,$data); 
        redirect($_SERVER['HTTP_REFERER']);                       
        }
        
        }
