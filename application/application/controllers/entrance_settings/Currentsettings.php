            <?php
            
            if (!defined('BASEPATH'))
            {
            exit('No direct script access allowed');
            }
            
            
            class Currentsettings extends Admin_Controller
            {
                
            public function __construct()
            {
            parent::__construct();
            }
            
            
            
            public function index()
            {
                
                
            if (!$this->rbac->hasPrivilege('template', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_settings');
            $this->session->set_userdata('sub_menu', 'entrance_settings/currentsettings');
            
            
            $data['title']                  = 'Current Settings';
            $data['current_session']        =  $this->setting_model->getCurrentSession();
            $current_session                =  $data['current_session'];
            $data['sessionlist']            =  $this->session_model->get();
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            $data['general']                =  $this->Entrance_settings_model->currentsettings_general();
            
            
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/currentsettings/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            public function delete($id)
            {
            // if (!$this->rbac->hasPrivilege('expense_head', 'can_delete')) {
            // access_denied();
            // }
            
            $data['title'] = 'Title';
            $this->db->where(array('cur_id'=>$id));
            $this->db->delete('current_settings');
            redirect('entrance_settings/currentsettings/index');
            }
            
            
            
            
            public function create()
            {
                
            // if (!$this->rbac->hasPrivilege('expense_head', 'can_add')) {
            //     access_denied();
            // }
            //$data['title']        = 'Add Expense Head';
            
            $data['title']                  = 'Settings';
            $data['current_session']        =  $this->setting_model->getCurrentSession();
            $current_session                =  $data['current_session'];
            $data['sessionlist']            =  $this->session_model->get();
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $data['general']                =  $this->Entrance_settings_model->currentsettings_general(); 
            
            $this->form_validation->set_rules('session', $this->lang->line('session'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == false) 
            {
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/currentsettings/index', $data);
            $this->load->view('layout/footer');
            } 
            else
            {
            if (isset($_POST['is_status'])) {
            $is_active = 1;
            } else {
            $is_active = 0;
            }
            
            if ($is_active == 1) {
            $this->db->where('is_activestatus', 1);
            $this->db->update('current_settings', array('is_activestatus' => 0));
            }
                
            $data = array(
            'cur_session'         => $this->input->post('session'),
            'cur_title'           => $this->input->post('title'),
            'cur_createddate'     => date('Y-m-d H:i:s'),
            'cur_title_subpage'   => $this->input->post('subpage'),
            'cur_title_admitcard' => $this->input->post('admit_title'),
            'is_activestatus'     => $is_active);
            $this->db->insert('current_settings',$data);
            
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('entrance_settings/currentsettings/');
            }
            }
            
            
            
            public function edit($id)
            {
            // if (!$this->rbac->hasPrivilege('expense', 'can_edit')) {
            //     access_denied();
            // }
            
            $data['title']                  = 'Settings';
            $data['current_session']        =  $this->setting_model->getCurrentSession();
            $current_session                =  $data['current_session'];
            $data['sessionlist']            =  $this->session_model->get();
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            $data['id']                     =  $id;
            
            $data['general']                =  $this->Entrance_settings_model->currentsettings_general(); 
            $data['generalbyval']           =  $this->Entrance_settings_model->currentsettings_general_byval($id);
            $this->form_validation->set_rules('session', $this->lang->line('session'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', $this->lang->line('title'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) 
            {
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/currentsettings/edit_data', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            if (isset($_POST['is_status'])) {
            $is_active = 1;
            } else {
            $is_active = 0;
            }
                
            if ($is_active == 1) {
            $this->db->where('is_activestatus', 1);
            $this->db->update('current_settings', array('is_activestatus' => 0));
            }
            $data = array(
            'cur_session'         => $this->input->post('session'),
            'cur_title'           => $this->input->post('title'),
            'is_activestatus'     => $is_active,
            'cur_title_subpage'   => $this->input->post('subpage'),
            'cur_title_admitcard' => $this->input->post('admit_title'),
            'cur_createddate'     => date('Y-m-d H:i:s'));
            $cond=array('cur_id'=>$id);
            $this->db->where($cond);
            $this->db->update('current_settings',$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
             redirect($_SERVER['HTTP_REFERER']);
            }
            }
            
            }
