            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Allotment extends Admin_Controller 
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
            $this->session->set_userdata('sub_menu', 'entrance_settings/allotment');
           
            
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
            $data['entrance_institute']     =  $this->Entranceallotment_model->getallot_institute($courseid);
            //$data['applicant']            =  $this->Entranceallotment_model->Searchstudents_forallot($courseid, $session_id);
            $data['alloted_settings']       =  $this->Entrance_settings_model->alloted_settings();
            $data['sessionlist']            =  $this->session_model->get();
           
           
            $this->load->view('layout/headerentrance');
            $this->load->view('entrance_settings/allotment', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            public function add_allotment()
            {
            $session                =  $this->input->post('session');
            $courseid               =  $this->input->post('entrance_course');
            $instruction            =  $this->input->post('instruction');
            $this->db->where(array('set_allotment_session'=> $session,'set_allotment_course'=> $courseid));
            $q = $this->db->get('entrance_settings_alloment'); 
            if ($q->num_rows() > 0)
            {
                
            $update_result                       =     $q->row();
            $data                                =      array(
            'set_allotment_updated_date'         =>     date('y-m-d h:i:s'),
            'set_allotment_instruction'          =>     $instruction);
            $this->db->where('set_allotment_id', $update_result->set_allotment_id);
            $this->db->update('entrance_settings_alloment', $data);
            }
            else
            {
            $data                                 =     array(                                                                
            'set_allotment_session'               =>     $session,
            'set_allotment_course'                =>     $courseid,
            'set_allotment_added_date'            =>     date('y-m-d h:i:s'),
            'set_allotment_instruction'           =>     $instruction);
            $this->db->insert('entrance_settings_alloment', $data);
            }
            redirect('entrance_settings/Allotment');
            }
            
            
            function delsetallotment($id)
            {
            $this->db->where('set_allotment_id',$id);
            $this->db->delete('entrance_settings_alloment');
            redirect('entrance_settings/Allotment');
            }
            
            
            public function getalloted_instruction()
            {
            $session = $this->input->post('sess');
            $course  = $this->input->post('course');
            $data= $this->Entrance_settings_model->get_instruction($session,$course);
            echo json_encode($data);
            }
            
            
          
        
            }
            ?>
            
