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
              if (!$this->rbac->hasPrivilege('allotment_seat', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_allotment');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/allotment');
            
            
            
            
           // $data['current_session']      =  $this->user_model->get_current_session();
           
            $data['title']                  =   "Allot Students";
            $data['current_session']        =   $this->Entrance_settings_model->get_entrance_settings();
            
            $ta                             =   "sessions";
            $data['sessionlist']            =   $this->Entranceallotment_model->list_dat($ta);
            $current_session                =   $data['current_session'];
            
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_session['cur_session']);
            $data['entrance_phase']         =   $this->input->post('entrance_phase');
            $entrance_phase                 =   $data['entrance_phase'];
            
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            $taballotype                    =  "entrance_allotmentseattype";
            
            $condallotcond                  =   array('entrance_allot_type_status'=>1);
            
            $data['allottype']              =   $this->Entranceallotment_model->list_data($taballotype,$condallotcond);
            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);
            
            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            
            $data['entrance_institute']     =   $this->Entranceallotment_model->getallot_institute($courseid);
            $data['applicant']              =   $this->Entranceallotment_model->Searchstudents_forallot($courseid, $session_id,$entrance_phase);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/allotment/index', $data);
            $this->load->view('layout/footer');
            }
            
            public function add_forallotmant()
            {
            $exam_publish_id       =  $this->input->post('exam_publish_id');
            $instituteid           =  $this->input->post('entrance_institute');
            $description           =  $this->input->post('description');
            $course                =  $this->input->post('course');
            $seattype              =  $this->input->post('seattype');
            $insert_array          = array();
            $update_array          = array();
            
            for($i=0;$i<sizeof($exam_publish_id);$i++)
            {           
            if($exam_publish_id!="") 
            {
            $data['seatno']        =  $this->Entranceallotment_model->get_max_allotseatno();
            $seatno                =  $data['seatno'] ;
            $seatmax               =  $seatno['entranceexam_allotment_seatno'];
            $this->db->where('entranceexam_allotment_publishid', $exam_publish_id[$i]);
            $q = $this->db->get('entranceexam_allotment'); 
            if($seatmax['entranceexam_allotment_seatno']==0 || $seatmax['entranceexam_allotment_seatno']=='')
            {
            $seatmax="1";
            }
            else
            {
            $seatmax++;
            }
            if ($q->num_rows() > 0)
            {
            $update_result[$i]          = $q->row();
            $data[$i]                   =  array(
            'entranceexam_allotment_instituteid'   =>  $instituteid,
            'entranceexam_allotment_description'   =>  $description,
            'entranceexam_allotment_courseid'      =>  $course,
            'entranceexam_allotment_seattype'      =>  $seattype,
            'entranceexam_allotment_updateddate'   =>  date('y-m-d h:i:s'));
            $this->db->where('entranceexam_allotment_publishid', $update_result[$i]->entranceexam_allotment_publishid);
            $this->db->update('entranceexam_allotment', $data[$i]);
            }
            else
            {
            $data[$i]                    =     array(                                                                
            'entranceexam_allotment_publishid'    =>     $exam_publish_id[$i],
            'entranceexam_allotment_instituteid'  =>     $instituteid,
            'entranceexam_allotment_addeddate'    =>     date('y-m-d h:i:s'),
            'entranceexam_allotment_courseid'     =>     $course,
            'entranceexam_allotment_seattype'     =>     $seattype,
            'entranceexam_allotment_seatno'       =>     $seatmax,
            'entranceexam_allotment_description'  =>     $description); 
            $this->db->insert('entranceexam_allotment', $data[$i]);
            }
            }
            }
            redirect('entrance_allotment/allotment');
            }
            
            public function getinstitute()
            {
            $entrance_course       =  $this->input->post('entrance_course');
            $query=$this->Entranceallotment_model->getallot_institute($entrance_course);
            echo json_encode($query);
            }
            
            
            
            
            public function viewallotment()
            {
                
            if (!$this->rbac->hasPrivilege('allotment_seat', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_allotment');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/allotment/listallotment'); 
            
            
                
                
           // $data['current_session']        =   $this->user_model->get_current_session();
            $data['current_session']          =  $this->Entrance_settings_model->get_entrance_settings();
            $data['title']                  =   "Allot Students";
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            
            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);
            
            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            $data['entrance_institute']     =   $this->Entranceallotment_model->getallot_institute($courseid);
            
            $data['institu']                =  $this->input->post('entrance_institute');
            $inst                           =  $data['institu'];
            $data['statustype']             =  $this->input->post('statustype');
            $statustype                     =  $data['statustype'] ;
            $data['applicant']              =  $this->Entranceallotment_model->alloted_applicants($courseid, $inst,$session_id,$statustype);
            $tbl_seattype                   =  "entrance_allotmentseattype";
            $tbl_seatcondition              =  array('entrance_allot_type_status'=>1);
            $data['allot_seattype']         =  $this->Entranceallotment_model->list_data($tbl_seattype,$tbl_seatcondition);
            
            $ta                               = "sessions";
            $data['sessionlist']              =  $this->Entranceallotment_model->list_dat($ta);
            
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/allotment/allotmentlist', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            public function getallot_no()
            {
            $seattype           =  $this->input->post('seattype');
            $entrance_course    =  $this->input->post('entrance_course');
            $entrance_institute =  $this->input->post('entrance_institute');
            $query              =  $this->Entranceallotment_model->getallotno($seattype,$entrance_course,$entrance_institute);
            echo json_encode($query);
            }
            
            
            
            
            public function generate_allotment() 
            {
            
            if (!$this->rbac->hasPrivilege('generate_allotment', 'can_view')) 
            {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_allotment');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/allotment/generate_allotment');  
            
            
            
            //$data['current_session']        =  $this->user_model->get_current_session();
            $data['current_session']          =  $this->Entrance_settings_model->get_entrance_settings();
            $current_session                =   $data['current_session'];
            $data['title']                  = "Allot Students";
            
            $table                          = "entranceexam_course";
            $ta                             = "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            $taballotype                    = "entrance_allotmentseattype";
            $condallotcond                  =  array('entrance_allot_type_status'=>1);
            $data['allottype']              =  $this->Entranceallotment_model->list_data($taballotype,$condallotcond);
            $inst_table                     = "entranceexam_insitute";
            $inst_condition                 =  array('entranceexam_insitutestatus'=>1);
            $data['institute']              =  $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =  $this->input->post('entrance_course');
            $courseid                       =  $data['courseid'];
            $data['session_id']             =  $this->input->post('session');
            $session_id                     =  $data['session_id'];
            
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_session['cur_session']);
            $data['entrance_phase']         =   $this->input->post('entrance_phase');
            $entrance_phase                 =   $data['entrance_phase'];
            $data['entrance_institute']     =  $this->Entranceallotment_model->getallot_institute($courseid);
            $data['applicant']              =  $this->Entranceallotment_model->Searchstudents_forallot($courseid, $session_id,$entrance_phase);
            
           
            
            $ta                             = "sessions";
            $data['sessionlist']            =  $this->Entranceallotment_model->list_dat($ta);
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/allotment/generate_allotment', $data);
            $this->load->view('layout/footer');
            }
            
            
       
            
            public function setpriority()
            {
            
            if (!$this->rbac->hasPrivilege('allotment_seat', 'can_view')) 
            {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_allotment');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/allotment/setpriority');
            
            
            
            //$data['title'] = '';
            // $data['title_list'] = '';
            
            //      if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            //     access_denied();
            // }
            
            // $this->session->set_userdata('top_menu', 'Student Information');
            // $this->session->set_userdata('sub_menu', 'student/search');
            
            
            $data['courselist']             =  $this->Entranceexam_model->Allcourse();
            // $data['current_session']        =  $this->user_model->get_current_session();
             $data['current_session']          =  $this->Entrance_settings_model->get_entrance_settings();
            $ta                             = "sessions";
            $data['sessionlist']            =  $this->Entranceallotment_model->list_dat($ta);
            $current_session                =  $data['current_session'];
            
            //$data['examgroup']              =  $this->Entranceallotment_model->exam_group_session();
            
            $this->load->model('Entranceexam_model');
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/examgroup/allotment/priority/index', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            
            
            
            public function forwardenroll()
            {
                
            if (!$this->rbac->hasPrivilege('allotment_seat', 'can_view')) 
            {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_allotment');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/allotment/enrolment');  
                
                
            // $data['current_session']        =   $this->user_model->get_current_session();
            $data['current_session']          =  $this->Entrance_settings_model->get_entrance_settings();
            $data['title']                  =  "Allot Students";
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            
            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);
            
            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            $data['institu']                =   $this->input->post('entrance_institute');
            $inst                           =   $data['institu'];
            $data['applicant']              =   $this->Entranceallotment_model->forwardenroll_applicants($courseid, $inst,$session_id);
            $tbl_seattype                   =  "entrance_allotmentseattype";
            $tbl_seatcondition              =   array('entrance_allot_type_status'=>1);
            $data['allot_seattype']         =   $this->Entranceallotment_model->list_data($tbl_seattype,$tbl_seatcondition);
            $data['getcourse_name']         =   $this->Entranceallotment_model->getcourse_name($courseid,$inst);
            $ta                             = "sessions";
            $data['sessionlist']            =  $this->Entranceallotment_model->list_dat($ta);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/allotment/forwardenroll', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            
            
            public function add_forward_to_enrol()
            {
            $data['current_session']    =   $this->user_model->get_current_session();
            $data['title']              =  "Forward To Enroll";
            $applicant_id               =   $this->input->post('applicant_id');
            $allot_type_id              =   $this->input->post('allot_type_id');
            $insert_array               =   array();
            $update_array               =   array();
            
            for($i=0;$i<sizeof($applicant_id);$i++)
            {  
            $this->db->where('entranceexam_forwardenroll_regid', $applicant_id[$i]);
            $q = $this->db->get('entranceexam_forwardenroll'); 
            
            if ($q->num_rows() > 0)
            {
            
            $update_result[$i]          = $q->row();
            $data[$i]                   =  array(
            'entranceexam_forwardenroll_regid'          =>  $applicant_id[$i],
            'entranceexam_forwardenroll_allot_type'     =>  $allot_type_id[$i],
            'entranceexam_forwardenroll_updated_date'   =>   date('y-m-d h:i:s'));
            $this->db->where('entranceexam_forwardenroll_id', $update_result[$i]->entranceexam_forwardenroll_id);
            $this->db->update('entranceexam_allotment', $data[$i]);
            }
            else
            {
            $data[$i]                    =     array(                                                                
            'entranceexam_forwardenroll_regid'          =>  $applicant_id[$i],
            'entranceexam_forwardenroll_allot_type'          =>  $allot_type_id[$i],
            'entranceexam_forwardenroll_created_date'   =>   date('y-m-d h:i:s'));
            $this->db->insert('entranceexam_forwardenroll', $data[$i]);
            }
            }
            redirect('entrance_allotment/allotment/forwardenroll');
            }
            }
            ?>
            
