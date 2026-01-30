        <?php
        
        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }
        
        class Attendence_settings extends Admin_Controller
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
        
        // if (!$this->rbac->hasPrivilege('online_examination_instruction', 'can_view')) 
        //{
        //access_denied();
        //}
        
        $this->current_session     = $this->setting_model->getCurrentSession();
        $data['current_session']   = $this->current_session;
        
        $this->session->set_userdata('top_menu', 'Online_Examinations');    
        $this->session->set_userdata('sub_menu', 'Online_Examinations/online_examination_instruction');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        $data['title']                 =  'Instruction';
        $data['online_instructon']     =  $this->onlineexam_model->online_examination_attendence_settings();
        $examgroup_result              =  $this->examgroup_model->get();
        $data['examgrouplist']         =  $examgroup_result;
        
        if ($this->form_validation->run() == false) 
        {
        $this->load->view('layout/header', $data);
        $this->load->view('online_exam_attendencesettings/sectionList', $data);
        $this->load->view('layout/footer', $data);
        } 
        else
        {
        }
        }
        
        
        public function add_inst()
        {
            
            
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
        'online_examination_current_session'          => $this->input->post('session_id'),
        'online_examination_is_status'                => $is_status,
        'online_examination_attendencepercentage'     => $this->input->post('attendence_percentage'),
        'online_examination_ineligible_msg'           => $this->input->post('message'),
        );
        $this->db->insert('online_examination_attendence_settings',$data); 
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        
        
        public function edit_inst($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'Exam Application');    
        $this->session->set_userdata('sub_menu', 'onlineexam_list/online_examination_instruction');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        $data['current_session']       =  $this->current_session;
        $examgroup_result              =  $this->examgroup_model->get();
        $data['examgrouplist']         =  $examgroup_result;
        $data['title']                 =  'Instruction';
        $data['online_instructon']     =  $this->onlineexam_model->online_examination_attendence_settings();
        $data['editonline_instructon'] =  $this->onlineexam_model->edit_online_attendence_settings($id);
        $this->load->view('layout/header', $data);
        $this->load->view('online_exam_attendencesettings/sectionEdit', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        
        public function update_inst()
        {
        
        $id               = $this->input->post('online_examination_id');
        $exam_group_id    = $this->input->post('exam_group_id');  
        $exam_id          = $this->input->post('exam_id');
     
        
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
        'online_examination_is_status'                => $is_status,
        'online_examination_attendencepercentage'     => $this->input->post('attendence_percentage'),
        'online_examination_ineligible_msg'           => $this->input->post('message'),
        );
        $this->db->where('online_examination_id',$id);
        $this->db->update('online_examination_attendence_settings',$data);
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        public function delete_inst($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $tab                   = "online_examination_attendence_settings";
        $data                  = array('online_examination_id'=>$id);
        $this->db->delete($tab,$data); 
        redirect($_SERVER['HTTP_REFERER']);                       
        }
        }
