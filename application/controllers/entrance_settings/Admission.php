            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Admission extends Admin_Controller 
            {
            
            public function __construct()
            {
            parent::__construct();
            $this->load->library('encoding_lib');
            }
            
            
            
            public function index() 
            {
            
            if (!$this->rbac->hasPrivilege('template', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_settings');
            $this->session->set_userdata('sub_menu', 'entrance_settings/admission');
           
            
            $data['current_session']        =  $this->setting_model->getCurrentSession();
            $current_session                =  $data['current_session'];
            $data['title']                  =  "Entrance Settings";
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            
            $taballotype                    =  "entrance_allotmentseattype";
            $condallotcond                  =  array('entrance_allot_type_status'=>1);
            $data['allottype']              =  $this->Entranceallotment_model->list_data($taballotype,$condallotcond);
            $inst_table                     = "entranceexam_insitute";
            $inst_condition                 =  array('entranceexam_insitutestatus'=>1);
            
            $data['institute']              =  $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =  $this->input->post('entrance_course');
            $courseid                       =  $data['courseid'];
            
            $data['session_id']             =  $this->input->post('session');
            $session_id                     =  $data['session_id'];
            
            
            $data['admission_settings']     =  $this->Entrance_settings_model->admission_settings();
          
            $data['sessionlist']            =  $this->session_model->get();
            
           
            $this->load->view('layout/headerentrance');
            $this->load->view('entrance_settings/admission', $data);
            $this->load->view('layout/footer');
            }
            
            
          
            
            public function add_admission()
            {
            $session                =  $this->input->post('session');
            $courseid               =  $this->input->post('entrance_course');
            $close_date             =  $this->input->post('close_date');
            $announcement           =  $this->input->post('announcement');
            $close_application      =  $this->input->post('close_application');
            $this->db->where(array('set_admission_session'=> $session,'set_admission_course'=> $courseid));
            $q                      = $this->db->get('entrance_settings_admission');
            if ($q->num_rows() > 0)
            {
            $update_result                       =      $q->row();
            $data                                =      array(
            'set_admission_updated_date'         =>     date('y-m-d h:i:s'),
            'set_admission_close'                =>     $close_date,
            'set_admission_announcement'         =>     $announcement,
            'set_admission_close'                =>     $close_application);
            $this->db->where('set_admission_id', $update_result->set_admission_id);
            $this->db->update('entrance_settings_admission', $data);
            }
            else
            {
            $data                                =     array(                                                                
            'set_admission_session'              =>     $session,
            'set_admission_course'               =>     $courseid,
            'set_admission_added_date'           =>     date('y-m-d h:i:s'), 
            'set_examresult_closeddate'          =>     $close_date,
            'set_admission_announcement'         =>     $announcement,
            'set_admission_close'                =>     $close_application);
            $this->db->insert('entrance_settings_admission', $data);
            }
            redirect('entrance_settings/admission');
            }
            
            
            function deladmission($id)
            {
            $this->db->where('set_admission_id',$id);
            $this->db->delete('entrance_settings_admission');
            redirect('entrance_settings/admission');
            }
            
            
            
            public function getadmission_instruction()
            {
            $session = $this->input->post('sess');
            $course  = $this->input->post('course');
            $data= $this->Entrance_settings_model->getadmission_instruction($session,$course);
            echo json_encode($data);
            
            
            }
                
            }
            
            
        
            ?>
            
