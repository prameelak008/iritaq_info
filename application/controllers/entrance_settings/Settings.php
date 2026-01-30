            <?php
            
            if (!defined('BASEPATH'))
            {
            exit('No direct script access allowed');
            }
            
            
            class Settings extends Admin_Controller
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
            $this->session->set_userdata('sub_menu', 'entrance_settings/settings/');
             
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $entrance_current_session         =  $data['entrance_current_session'];
            $data['title']                    = 'Settings';
            $data['current_session']          =  $this->setting_model->getCurrentSession();
            $current_session                  =  $data['current_session'];
            $data['sessionlist']              =  $this->session_model->get();
            $table                            =  "entranceexam_course";
            $ta                               =  "sessions";
            $condition                        =  array('entranceexam_course_status'=>1);
            $data['course']                   =  $this->Entranceallotment_model->list_data($table,$condition);
            
            $data['template']                 =  $this->Entrance_settings_model->settings_template();
            $data['general']                  =  $this->Entrance_settings_model->settings_general($entrance_current_session['cur_session']);
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $data['get_session_phase']        =  $this->Entrance_settings_model->get_session_phase($data['entrance_current_session']['cur_session']);
            
            
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/settings/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            public function delete($id)
            {
            if (!$this->rbac->hasPrivilege('expense_head', 'can_delete')) {
            access_denied();
            }
            $data['title'] = 'Settings';
            $this->db->where(array('set_general_id'=>$id));
            $this->db->delete('entrance_settings_general');
            redirect('entrance_settings/settings/index');
            }
            
            
            
            public function create()
            {
            // if (!$this->rbac->hasPrivilege('expense_head', 'can_add')) {
            //     access_denied();
            // }
            //$data['title']        = 'Add Expense Head';
            
            $data['title']                    = 'Settings';
           // $data['current_session']        =  $this->setting_model->getCurrentSession();
            //$current_session                =  $data['current_session'];
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $entrance_current_session         =  $data['entrance_current_session'];
            
            $data['sessionlist']              =  $this->session_model->get();
            $table                            =  "entranceexam_course";
            $ta                               =  "sessions";
            $condition                        =  array('entranceexam_course_status'=>1);
            $data['course']                   =  $this->Entranceallotment_model->list_data($table,$condition);
            $data['template']                 =  $this->Entrance_settings_model->settings_template(); 
            $this->form_validation->set_rules('session', $this->lang->line('session'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('entrance_course', $this->lang->line('entrance_course'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_section', $this->lang->line('exam_section'), 'trim|required|xss_clean');
            $session            = $this->input->post('session');
            $entrancecourse     = $this->input->post('entrance_course');
            $phase              = $this->input->post('phase');
            $exam_section       = $this->input->post('exam_section');
            
            if ($this->form_validation->run() == false) 
            {
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/settings/index', $data);
            $this->load->view('layout/footer');
            } 
            else
            {
            if($entrancecourse==0)
            {
            if($exam_section=='College Preference') 
            {
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q   = $this->db->get(); 
            $res = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_collegepreference' => 1,
            'set_allotment_date'   => date('Y-m-d H:i:s'), 
            );
            $this->db->where('phasegroup',$phase);
            $this->db->update('set_entrance_uidesign', $data);
            } 
            }
            else if($exam_section=='Allotment Status') 
            {
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q   = $this->db->get(); 
            $res = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_checkallotment' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where('phasegroup',$phase);
            $this->db->update('set_entrance_uidesign', $data);
            } 
            }
            }
            else
            {
            if($exam_section=='College Preference') 
            {   
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=set_entrance_uidesign.reg_id');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q     = $this->db->get(); 
            $res   = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_collegepreference' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where(array('phasegroup'=>$phase));
            $this->db->update('set_entrance_uidesign', $data);
            }
            }
            else if($exam_section=='Allotment Status') 
            {   
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=set_entrance_uidesign.reg_id');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q     = $this->db->get(); 
            $res   = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_collegepreference' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where(array('phasegroup'=>$phase));
            $this->db->update('set_entrance_uidesign', $data);
            }
            }
            }  
            $data = array(
            'set_general_session'          => $this->input->post('session'),
            'set_general_course'           => $this->input->post('entrance_course'),
            'set_general_phase'            => $this->input->post('phase'),
            'set_general_section'          => $this->input->post('exam_section'),
            'set_general_announcedate'     => $this->input->post('announce_date'),
            'set_general_announcemessage'  => $this->input->post('announce_message'),
            'set_general_publishdate'      => $this->input->post('publish_date'),
            'set_general_closemessage'     => $this->input->post('close_message'),
            'set_general_closedate'        => $this->input->post('close_date'),
            'set_created_at'               => date('Y-m-d:H:i:s'),
            );
            $this->db->insert('entrance_settings_general',$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('entrance_settings/Settings/');
            }
            }
            
            
            
            public function edit($id)
            {
            if (!$this->rbac->hasPrivilege('template', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_settings');
            $this->session->set_userdata('sub_menu', 'entrance_settings/settings/');
            
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $entrance_current_session         =  $data['entrance_current_session'];
            $data['title']                  = 'Settings';
            $data['current_session']        =  $this->setting_model->getCurrentSession();
            $current_session                =  $data['current_session'];
            $data['sessionlist']            =  $this->session_model->get();
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            $data['id']                     =  $id;
            $data['template']               =  $this->Entrance_settings_model->settings_template();
            $data['general']                =  $this->Entrance_settings_model->settings_general($entrance_current_session['cur_session']);
            $data['generalbyval']           =  $this->Entrance_settings_model->settings_general_byval($id);
            $this->form_validation->set_rules('session', $this->lang->line('session'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('entrance_course', $this->lang->line('entrance_course'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_section', $this->lang->line('exam_section'), 'trim|required|xss_clean');
            
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $data['get_session_phase']        =  $this->Entrance_settings_model->get_session_phase($data['entrance_current_session']['cur_session']);
            $session                          = $this->input->post('session');
            $entrancecourse                   = $this->input->post('entrance_course');
            $phase                            = $this->input->post('phase');
            $exam_section                     = $this->input->post('exam_section');
            
            if ($this->form_validation->run() == false) 
            {
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/settings/edit_data', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            if($entrancecourse==0)
            {
            if($exam_section=='College Preference') 
            {
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q   = $this->db->get(); 
            $res = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_collegepreference' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where('phasegroup',$phase);
            $this->db->update('set_entrance_uidesign', $data);
            } 
            }
            else if($exam_section=='Allotment Status') 
            {
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q   = $this->db->get(); 
            $res = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_checkallotment' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where('phasegroup',$phase);
            $this->db->update('set_entrance_uidesign', $data);
            } 
            }
            }
            else
            {
            if($exam_section=='College Preference') 
            {   
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=set_entrance_uidesign.reg_id');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q     = $this->db->get(); 
            $res   = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_collegepreference' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where(array('phasegroup'=>$phase));
            $this->db->update('set_entrance_uidesign', $data);
            }
            }
            else if($exam_section=='Allotment Status') 
            {   
            $this->db->select('*');
            $this->db->from('set_entrance_uidesign');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=set_entrance_uidesign.reg_id');
            $this->db->where(array('phasegroup'=>$phase,'ui_examresult'=>1));
            $q     = $this->db->get(); 
            $res   = $q ->result_array();
            foreach ($res as $row) {
            $data = array(
            'ui_collegepreference' => 1,
            'set_allotment_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where(array('phasegroup'=>$phase));
            $this->db->update('set_entrance_uidesign', $data);
            }
            }
            }  
                
             $data = array(
            'set_general_session'          => $this->input->post('session'),
            'set_general_course'           => $this->input->post('entrance_course'),
            'set_general_phase'            => $this->input->post('phase'),
            'set_general_section'          => $this->input->post('exam_section'),
            'set_general_announcedate'     => $this->input->post('announce_date'),
            'set_general_announcemessage'  => $this->input->post('announce_message'),
            'set_general_publishdate'      => $this->input->post('publish_date'),
            'set_general_closemessage'     => $this->input->post('close_message'),
            'set_general_closedate'        => $this->input->post('close_date'),
            'set_updated_at'               => date('Y-m-d:H:i:s'),
            );
            $cond=array('set_general_id'=>$id);
            $this->db->where($cond);
            $this->db->update('entrance_settings_general',$data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect($_SERVER['HTTP_REFERER']);
            return; 
            }
            }
            
            
            public function gettemplate_instruction()
            {
            $close_message   = $this->input->post('close_message');
            $msg               =  $this->Entrance_settings_model->getclose_inst($close_message);
            echo json_encode($msg);
            }
            
            
            public function get_instruction()
            {
            $announce_message   = $this->input->post('announce_message');
            $msg               =  $this->Entrance_settings_model->getclose_inst($announce_message);
            echo json_encode($msg);
            }
            
            }
