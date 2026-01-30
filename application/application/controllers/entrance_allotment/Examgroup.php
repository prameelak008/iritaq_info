            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Examgroup extends Admin_Controller 
            {
            
            public function __construct() 
            {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            } 
            
            
            
            
            public function index() 
            {
        
            
            if (!$this->rbac->hasPrivilege('entrance_examgroup', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/examgroup');
            
            
            
            $data['current_session']          =  $this->Entrance_settings_model->get_entrance_settings();
            // $data['current_session']       =  $this->setting_model->getCurrentSession();
            $current_session                  =  $data['current_session'];
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $entrance_current_session         =  $data['entrance_current_session'];

           
            $ta                               = "sessions";
            $data['sessionlist']              =  $this->Entranceallotment_model->list_dat($ta);
            $current_session                  =  $data['current_session'];
            $data['examgroup']                =  $this->Entranceallotment_model->exam_group_session($entrance_current_session['cur_session']);
            $this->load->model('Entranceexam_model');
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/examgroup/examgroup/index', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            public function add_val()
            {
            $data['current_session'] =   $this->setting_model->getCurrentSession();
            $current_session         =   $data['current_session'];
            $session_id              =   $this->input->post('session');
            $name                    =   $this->input->post('name');
            $start_date              =   $this->input->post('start_date');
            $end_date                =   $this->input->post('end_date');
            $data                    =   array('entrance_examgroup_session' => $session_id,'entrance_examgroup_name'=>$name,'entrance_start_date'=>$start_date,'entrance_end_date'=>$end_date);
            $query                   =   $this->db->insert('entrance_examgroup', $data); 
            
            if(empty($query)) {
            $error = array("Record not saved. Please try again.");
            $array = array('status' => 'fail', 'error' => $error, 'message' => '');
            }
            else
            {
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
            echo json_encode($array);
            }
            
            
            public function editval($id) 
            {
                
             if (!$this->rbac->hasPrivilege('entrance_examgroup', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/examgroup');    
                
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $entrance_current_session         =  $data['entrance_current_session'];
                
            $data['current_session']          =  $this->setting_model->getCurrentSession();
            $current_session                  =  $data['current_session'];
            $ta                               = "sessions";
            $data['sessionlist']              =  $this->Entranceallotment_model->list_dat($ta);
            $current_session                  =  $data['current_session'];
            $data['examgroup']                =  $this->Entranceallotment_model->exam_group_session($entrance_current_session['cur_session']);
            $data['examgroupval']             =  $this->Entranceallotment_model->getexamgroupval_row($id);
            
            $data['current_session']          =  $this->Entrance_settings_model->get_entrance_settings();
            // $data['current_session']       =  $this->setting_model->getCurrentSession();
            $current_session                  =  $data['current_session'];
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/examgroup/editdata', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            public function updateval()
            {
            $data['current_session']         =   $this->setting_model->getCurrentSession();
            $current_session                 =   $data['current_session']; 
            $name                            =   $this->input->post('name');
            $id                              =   $this->input->post('id');
            $session                         =   $this->input->post('session');
            $start_date                      =   $this->input->post('start_date');
            $end_date                        =   $this->input->post('end_date');
            $table                           =   "entrance_examgroup";
            $data                            =   array('entrance_examgroup_name'=>$name,'entrance_examgroup_session'=>$session,'entrance_start_date'=>$start_date,'entrance_end_date'=>$end_date);
            $condition                       =   array('entrance_examgroup_id'=>$id);
            $query                           =   $this->Entranceallotment_model->updte_value($table,$data,$condition);
            if(empty($query)) {
            $error                           =   array("Record not updated. Please try again.");
            $array                           =   array('status' => 'fail', 'error' => $error, 'message' => '');
            } 
            else
            {
            $array                           =   array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
            echo json_encode($array);
            }
            
            
            public function delval($id)
            {
            $data['current_session']         =  $this->setting_model->getCurrentSession();
            $current_session                 =  $data['current_session'];
            $table                           =  "entrance_examgroup";
            $data = array('entrance_examgroup_status' => 0);
            $condition=$this->db->where('entrance_examgroup_id', $id);
            $this->Entranceallotment_model->updte_value($table,$data,$condition);
            redirect('entrance_allotment/examgroup');
            }
            }
            ?>