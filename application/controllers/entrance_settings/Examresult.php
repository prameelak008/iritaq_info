            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Examresult extends Admin_Controller 
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
            $this->session->set_userdata('sub_menu', 'entrance_settings/examresult');
            
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
            //$data['entrance_institute']     =  $this->Entranceallotment_model->getallot_institute($courseid);
            //$data['applicant']            =  $this->Entranceallotment_model->Searchstudents_forallot($courseid, $session_id);
            $data['examresult_settings']    =  $this->Entrance_settings_model->examresult_settings();
            $data['sessionlist']            =  $this->session_model->get();
            
            
            $this->load->view('layout/headerentrance');
            $this->load->view('entrance_settings/examresult', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            public function add_examresult()
            {
            $session                =  $this->input->post('session');
            $courseid               =  $this->input->post('entrance_course');
            $expired_date           =  $this->input->post('expired_date');
            $publishing             =  $this->input->post('publishing');
            $expired_message        =  $this->input->post('expired_message');
            $this->db->where(array('set_examresult_session'=> $session,'set_examresult_course'=> $courseid));
            $q = $this->db->get('entrance_settings_examresult'); 
            if ($q->num_rows() > 0)
            {
            $update_result                       =      $q->row();
            $data                                =      array(
            'set_examresult_updated_date'        =>     date('y-m-d h:i:s'),
            'set_examresult_expireddate'         =>     $expired_date,
            'set_examresult_expiredinstruction'  =>     $expired_message,
            'set_examresult_publish_instruction' =>     $publishing);
            $this->db->where('set_examresult_id', $update_result->set_examresult_id);
            $this->db->update('entrance_settings_examresult', $data);
            }
            else
            {
            $data                                 =     array(                                                                
            'set_examresult_session'              =>     $session,
            'set_examresult_course'               =>     $courseid,
            'set_examresult_expireddate'          =>     $expired_date,
            'set_examresult_expiredinstruction'   =>     $expired_message,
            'set_examresult_added_date'           =>     date('y-m-d h:i:s'),
            'set_examresult_publish_instruction'  =>     $publishing);
            $this->db->insert('entrance_settings_examresult', $data);
            }
            redirect('entrance_settings/Examresult');
            }
            
            
            function delsetexamresult($id)
            {
            $this->db->where('set_examresult_id',$id);
            $this->db->delete('entrance_settings_examresult');
            redirect('entrance_settings/Examresult');
            }
            
            
            public function getexamresult_instruction()
            {
            $session = $this->input->post('sess');
            $course  = $this->input->post('course');
            $data= $this->Entrance_settings_model->get_resultinstruction($session,$course);
            echo json_encode($data);
            
            
            }
                
            }
            
            
        
            ?>
            
