        <?php
        
        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }
        
        class Attempts extends Admin_Controller
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
        $this->load->library('form_validation');
        }
  
        
        public function index()
        {
            
        // if (!$this->rbac->hasPrivilege('online_examination_instruction', 'can_view')) 
        //{
        //access_denied();
        //}
        
        $this->current_session = $this->setting_model->getCurrentSession();
        
        $this->session->set_userdata('top_menu', 'say_exam');    
        $this->session->set_userdata('sub_menu', 'say_exam/attempts');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;

        $examgroup_result              =  $this->examgroup_model->get();
        $data['examgrouplist']         =  $examgroup_result;
        $class                         =  $this->class_model->get();
        $data['classlist']             =  $class;
        $data['exam_type']             =  $this->exam_attempt_model->get_exam_type();
        
        $data['get_attempts']          =  $this->exam_attempt_model->get_attempts();
        
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_type', $this->lang->line('exam_type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('attempts', $this->lang->line('attempts'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) 
        {
        
        } 
        else
        {
        $data = array(
        'ex_exam_group'      => $this->input->post('exam_group_id'),
        'ex_exam'            => $this->input->post('exam_id'),
        'ex_session'         => $this->input->post('session_id'),
        'ex_class'           => $this->input->post('class_id'),
        'ex_section'         => $this->input->post('section_id'),
        'ex_exam_type'       => $this->input->post('exam_type'),
        'ex_exam_sub_type'   => $this->input->post('exam_sub_type') !== null && $this->input->post('exam_sub_type') !== ''
        ? $this->input->post('exam_sub_type') 
        : 0,
        'ex_no_of_attempts'  => $this->input->post('attempts'),
        'ex_created_date'    => date('d-m-y h:i:s')
        );
        $this->db->insert('exam_attempts',$data); 
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect($_SERVER['HTTP_REFERER']);
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam_attempts/sectionList', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
            public function edit_attempt($id)
            {
                
                
            // if (!$this->rbac->hasPrivilege('income', 'can_edit')) {
            // access_denied();
            // }
            $this->current_session = $this->setting_model->getCurrentSession();
            
            
            $this->session->set_userdata('top_menu', 'say_exam');    
            $this->session->set_userdata('sub_menu', 'say_exam/attempts');
            
            $session                       =  $this->session_model->get();
            $data['sessionlist']           =  $session;
            $examgroup_result              =  $this->examgroup_model->get();
            $data['examgrouplist']         =  $examgroup_result;
            $class                         =  $this->class_model->get();
            $data['classlist']             =  $class;
            $data['exam_type']             =  $this->exam_attempt_model->get_exam_type();
            
            $data['get_attempts']          =  $this->exam_attempt_model->get_attempts();
            $data['get_attempts_id']       =  $this->exam_attempt_model->get_attempts_id($id);
            
            $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('session_id', $this->lang->line('session_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', $this->lang->line('class_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', $this->lang->line('section_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_type', $this->lang->line('exam_type'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('attempts', $this->lang->line('attempts'), 'trim|required|xss_clean');
            
            
            if ($this->form_validation->run() == false) 
            {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam_attempts/sectionEdit', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            $data = array(
            'ex_exam_group'      => $this->input->post('exam_group_id'),
            'ex_exam'            => $this->input->post('exam_id'),
            'ex_session'         => $this->input->post('session_id'),
            'ex_class'           => $this->input->post('class_id'),
            'ex_section'         => $this->input->post('section_id'),
            'ex_exam_type'       => $this->input->post('exam_type'),
            'ex_exam_sub_type'   => $this->input->post('exam_sub_type') !== null && $this->input->post('exam_sub_type') !== ''
            ? $this->input->post('exam_sub_type') 
            : 0,
            'ex_no_of_attempts'  => $this->input->post('attempts'),
            'ex_updated_date'    => date('d-m-y h:i:s')
            );
           
            $this->db->where('ex_id', $id);
            $this->db->update('exam_attempts', $data);
            
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect($_SERVER['HTTP_REFERER']);
            }
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
