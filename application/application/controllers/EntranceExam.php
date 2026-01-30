            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class EntranceExam extends Admin_Controller 
            {
                
            public function __construct() 
            {
            parent::__construct();
            //$this->current_session = $this->setting_model->getCurrentSession();
            // $entrance_session       =  $this->Entrance_settings_model->get_entrance_settings();
            // $this->current_session =$entrance_session['cur_session'];
            $this->load->model('Entranceexam_model');
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            }    
                
                
            public function center()
            {
                
            if (!$this->rbac->hasPrivilege('entrance_examcenter', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/center');
                
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $data['current_session']          =  $this->current_session;
            $current_session                  =  $data['current_session']; 
            $data['sessionlist']              =  $this->session_model->get();
            $data['courselist']               =  $this->Entranceexam_model->Allcourse();
            $centerlist                       =  $this->Entranceexam_model->Allcenter($data['entrance_current_session']['cur_session']);
            $data['centerlist']               =  $centerlist;
            $this->load->model('Entranceexam_model');
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/incenter', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            public function addcenter()
            {
            $name        =$this->input->post('c_name');
            // $seat        =$this->input->post('c_seat');
            // $course      =$this->input->post('centre_course');
            // $session     =$this->input->post('session');
            
            //$data=array('entranceexam_centrename'=>$name,'entranceexam_centreseat'=>$seat,'entranceexam_centrecourse'=>$course,'entranceexam_centresession'=>$session);
            $data=array('entranceexam_centrename'=>$name);
            $this->load->model('Entranceexam_model');
            $query=$this->Entranceexam_model->Add_Center($data);
            redirect('EntranceExam/center');
            }
            
            
            
            public function editcenter($id) 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_examcenter', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/center');    
                
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();   
            $data['current_session'] =  $this->current_session;
            $current_session         =  $data['current_session']; 
            $data['sessionlist']     =  $this->session_model->get();
            $data['courselist']      =  $this->Entranceexam_model->Allcourse();
            $centerlist              =  $this->Entranceexam_model->Allcenter($data['entrance_current_session']['cur_session']);
            $data['centerlist']      =  $centerlist;
            $cedit                   =  $this->Entranceexam_model->getCenter($id);
            $data['cedit']           =  $cedit;
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/editcenter', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            public function updatecenter() 
            {
            $id       = $this->input->post('c_id');
            $name     = $this->input->post('c_name');
            // $seat     = $this->input->post('c_seat');
            // $course   = $this->input->post('inst_course');
            // $session  = $this->input->post('session');
            
            // if(!empty($name) && !empty($seat))
            // {
            //$this->Entranceexam_model->centerupdate($id,$name,$seat,$course,$session);
            
            $this->Entranceexam_model->centerupdate($id,$name);
            //redirect('EntranceExam/center');
            // }
            // else
            // {
            redirect('EntranceExam/center');
            //}
            }
            
            public function deletecenter($id) {
            $this->Entranceexam_model->centerdelete($id);
            redirect('EntranceExam/center');
            }
           
            
            
            
            public function groupinstitute()
            {
                
                
            if (!$this->rbac->hasPrivilege('entrance_exam_institute', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/institute');   
                
            $institutelist               = $this->Entranceexam_model->Allinstitute();
            $data['institutelist']       = $institutelist;
            $this->load->model('Entranceexam_model');
            $courselist                  = $this->Entranceexam_model->Allcourse();
            $data['courselist']          = $courselist;
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/ininstitute', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            
            public function addgroupinstitute()
            {
            $data['current_session'] =  $this->current_session;
            $current_session         =  $data['current_session'];     
            $name=$this->input->post('inst_name');
            // $seat=$this->input->post('inst_seat');
            // $course=$this->input->post('inst_course');
            
            
            //$data=array('entranceexam_insitutename'=>$name,'entranceexam_insituteseats'=>$seat,'entranceexam_insitutescourse'=>$course,'entranceexam_insitutesession'=>$current_session);
            
            $data=array('entranceexam_insitutename'=>$name);
            $this->load->model('Entranceexam_model');
            $query=$this->Entranceexam_model->Add_inst($data);
            redirect('EntranceExam/groupinstitute');
            }
            
            
            
            
            public function editgroupinstitute($id) 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_exam_institute', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/institute'); 
            
            
                
            $courselist                  = $this->Entranceexam_model->Allcourse();
            $data['courselist']          = $courselist;
            
             $institutelist               = $this->Entranceexam_model->Allinstitute();
            $data['institutelist']       = $institutelist;
            
            $inedit                      = $this->Entranceexam_model->getInstitute($id);
            $data['inedit']              = $inedit;
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/editinstitute', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            public function updategroupinstitute()
            {
            $data['current_session']      =  $this->current_session;
            $current_session              =  $data['current_session'];
            $id                           = $this->input->post('inst_id');
            $name                         = $this->input->post('inst_name');
            // $seat                         = $this->input->post('inst_seat');
            // $course                       = $this->input->post('inst_course');
            $data=array(
            'entranceexam_insitutename'    => $this->input->post('inst_name'),
            // 'entranceexam_insituteseats'   => $this->input->post('inst_seat'),
            // 'entranceexam_insitutescourse' => $this->input->post('inst_course'),
            //'entranceexam_insitutesession' => $current_session,
            );
                
            $this->db->where(array('entranceexam_insituteid'=>$id));   
            $this->db->update('entranceexam_insitutegroup',$data);     
            
                
            // if(!empty($name) && !empty($seat) && !empty($course))
            // {
            
            //$this->Entranceexam_model->instituteupdate($id,$name,$seat,$course);
            
            
            redirect('EntranceExam/groupinstitute');
            // }
            // else
            // {
            // redirect('EntranceExam/institute');
            // }
            }
            
            public function deletegroupinstitute($id) {
            $this->Entranceexam_model->institutedelete($id);
            redirect('EntranceExam/groupinstitute');
            }


            
            public function course()
            {                
            if (!$this->rbac->hasPrivilege('entrance_exam_course', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/course'); 
                
            $data['current_session']           =  $this->current_session;
            $current_session                   =  $data['current_session'];
            $data['sessionlist']               =  $this->session_model->get(); 
            $courselist                        =  $this->Entranceexam_model->Allcourse();
            $data['courselist']                =  $courselist;	
            $data['entrance_current_session']  =  $this->Entrance_settings_model->get_entrance_settings();   
            $entrance_current_session          =  $data['entrance_current_session'];
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/incourse', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            public function addcourse()
            {
            $name         =  $this->input->post('crs_name');
            $custom       =  $this->input->post('custom');
            $description  =  $this->input->post('description');
            $is_previous  =  $this->input->post('is_previous');
            
            // $session    =  $this->input->post('session');
            
            $session    =   0;
            $data       =   array('entranceexam_course_name'=>$name,'entranceexam_course_session'=>$session,'entranceexam_course_custom'=>$custom,'entranceexam_course_description'=>$description,'entranceexam_course_is_previous'=>$is_previous);
            $query=$this->Entranceexam_model->Add_course($data);
            redirect('EntranceExam/course');
            }
            
            
            
            
            public function editcourse($id) 
            {
            if (!$this->rbac->hasPrivilege('entrance_exam_course', 'can_view')) {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/course');   
                
                
            $data['current_session']           =  $this->current_session;
            $current_session                   =  $data['current_session'];
            $data['sessionlist']               =  $this->session_model->get(); 
            $courselist                        =  $this->Entranceexam_model->Allcourse();
            $data['courselist']                =  $courselist;	
            $courseedit                        =  $this->Entranceexam_model->getCourse($id);
            $data['courseedit']                =  $courseedit;
            $data['entrance_current_session']  =  $this->Entrance_settings_model->get_entrance_settings();   
            $entrance_current_session          =  $data['entrance_current_session'];
            
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/editcourse', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            public function updatecourse()
            {
            $id              =  $this->input->post('crs_id');
            $name            =  $this->input->post('crs_name');
            $custom          =  $this->input->post('custom');
            $description     =  $this->input->post('description');
            $is_previous     =  $this->input->post('is_previous');
            
            //$session    =  $this->input->post('session');
             $session =0;
            if(!empty($name))
            {
            $this->Entranceexam_model->courseupdate($id,$name,$session,$custom,$description,$is_previous);
            redirect('EntranceExam/course');
            }
            else
            {
            redirect('EntranceExam/course');
            
            }
            }
            
            public function deletecourse($id) {
            $this->Entranceexam_model->coursedelete($id);
            redirect('EntranceExam/course');
            }
            
           
            
            public function admitcard()
            {
                
            if (!$this->rbac->hasPrivilege('entrance_admit_card', 'can_view')) {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'EntranceExam/admitcard');   
            
            
                
            //$data['courselist'] = $this->Entranceexam_model->Allcourse();
            $data['current_entrancesession'] = $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession         = $data['current_entrancesession'];
            $data['courselist']              = $this->Entranceallotment_model->entrance_course($current_entrancesession['cur_session']);
            // $courselist                      = $data['courselist']; 
            
            $data['admitcard']               = $this->Entranceexam_model->getadmitcard($current_entrancesession['cur_session']);
            
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_entrancesession['cur_session']);
            
            $this->load->model('Entranceexam_model');
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/admitcard/add_data', $data);
            $this->load->view('layout/footer', $data);
            }

            
            
            
            
            public function addadmitcard()
            {
            //$this->current_session = $this->setting_model->getCurrentSession();
            
             $data['current_entrancesession'] = $this->Entrance_settings_model->get_entrance_settings();
             $current_entrancesession         = $data['current_entrancesession'];
            
            
            $this->load->model('Entranceexam_model'); 
            $entrance_admitcardapplied_course=$this->input->post('centre_course');
            $entrance_admitcarddate_time=$this->input->post('entrance_admitcarddate_time');
            $entrance_admitcarddescription=$this->input->post('entrance_admitcarddescription');
            $entrance_admitstatus =$this->input->post('entrance_admitstatus');
            $entrance_phase       =$this->input->post('entrance_phase');
            
            $data=array('entrance_admitcardapplied_course'=>$entrance_admitcardapplied_course,
            'entrance_admitcarddate_time'=>$entrance_admitcarddate_time,'entrance_admitcarddescription'=>	$entrance_admitcarddescription,
            'entrance_admitcardstatus'=>	$entrance_admitstatus,'entrance_admitcardsession'=>$current_entrancesession['cur_session'],
            'entrance_phase'=>$entrance_phase
            );
            $this->db->insert('entranceexam_admitcard',$data);
            redirect($_SERVER['HTTP_REFERER']); 
            }
            
            
            
            public function editadmitcard($id) 
            { 
            //$data['courselist'] = $this->Entranceexam_model->Allcourse();
            
            if (!$this->rbac->hasPrivilege('entrance_admit_card', 'can_view'))
            {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'EntranceExam/admitcard');
            
            
            
            $data['current_entrancesession'] = $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession         = $data['current_entrancesession'];
            $data['courselist']              = $this->Entranceallotment_model->entrance_course($current_entrancesession['cur_session']);
            $data['admitcard']               = $this->Entranceexam_model->getadmitcard($current_entrancesession['cur_session']);
            $courselist                      = $data['courselist'];
            
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_entrancesession['cur_session']);
            
            //$data['admitcard']  = $this->Entranceexam_model->getadmitcard();
            $data['getadmitbyid']  = $this->Entranceexam_model->getadmitby_id($id);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/admitcard/edit_data', $data);
            $this->load->view('layout/footer');
            }
            
            
            
        
            public function updateadmitcard()
            {
            $entrance_admitcardapplied_course   = $this->input->post('centre_course');
            $entrance_admitcarddate_time        = $this->input->post('entrance_admitcarddate_time');
            $entrance_admitcarddescription      = $this->input->post('entrance_admitcarddescription');
            $entrance_admitcardstatus           = $this->input->post('entrance_admitstatus');
            $entrance_admitcardid               = $this->input->post('entrance_admitcardid');
            $entrance_phase                     = $this->input->post('entrance_phase');
            
            $condition                          = array('entrance_admitcardid'=>$entrance_admitcardid);
            $data = array('entrance_admitcardapplied_course'=>$entrance_admitcardapplied_course,
           'entrance_admitcarddate_time'  => $entrance_admitcarddate_time,
           'entrance_admitcarddescription'=> $entrance_admitcarddescription,
           'entrance_phase'               => $entrance_phase,
           'entrance_admitcardstatus'     => $entrance_admitcardstatus);
           
           
            $this->db->where($condition);
            $this->db->update('entranceexam_admitcard', $data);
            redirect($_SERVER['HTTP_REFERER']); 
            }
        
            
            
            public function deleteadmitcard($id)
            {
            $this->Entranceexam_model->admitdelete($id);
            redirect($_SERVER['HTTP_REFERER']); 
            }
            
            public function examview($id)
            {
            $data['title']          = 'Student Exam Details';
            $adlist                 = $this->class_model->examgetById($id);
            $data['admissionlist']  = $adlist;
            $data['applicantfees']  = $this->Entranceexam_model->applicant_fees_details($id);
            $data['check_address']  = $this->Entranceexam_model->check_address($id);
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/applicantdetails/examstudentShow', $data);
            $this->load->view('layout/footer', $data);
            }
            
            public function examviewByName()
            {
            $data['current_entrancesession']     =   $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            $courseid                            =   $this->input->post('course_id');
            $instituteid                         =   $this->input->post('institute_id');
            $centerid                            =   $this->input->post('center_id');
            $phaseid                             =   $this->input->post('phaseid');
            $courselist                          =   $this->Entranceexam_model->examgetCourse();
            $data['courselist']                  =   $courselist;
            $phaselist                           =   $this->Entranceexam_model->phase($current_entrancesession['cur_session']);
            $data['phaselist']                   =   $phaselist;
            $searchall                           =   $this->Entranceexam_model->examgetBySearch($courseid,$instituteid,$centerid,$current_entrancesession['cur_session'],$phaseid);
            $data['searchlist']                  =   $searchall;
            $phaselist                           =   $this->Entranceexam_model->phase($current_entrancesession['cur_session']);
            $data['phaselist']                   =   $phaselist;
            
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/applicantdetails/examstudentSearchByname', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            public function examsearchvalidation()
            {
            $class_id   = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            
            $srch_type = $this->input->post('search_type');
            $search_text = $this->input->post('search_text');
            
            if ($srch_type == 'search_filter') {
            
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == true) {
            
            $params = array('srch_type' => $srch_type, 'class_id' => $class_id, 'section_id' => $section_id);
            $array  = array('status' => 1, 'error' => '', 'params' => $params);
            echo json_encode($array);
            
            } else {
            
            $error             = array();
            $error['class_id'] = form_error('class_id');
            $array             = array('status' => 0, 'error' => $error);
            echo json_encode($array);
            }
            } else {
            $params = array('srch_type' => 'search_full', 'class_id' => $class_id, 'section_id' => $section_id,'search_text'=>$search_text);
            $array  = array('status' => 1, 'error' => '', 'params' => $params);
            echo json_encode($array);
            }
            }
            
            
            
            
            
            public function examsearch()
            {
            
            if (!$this->rbac->hasPrivilege('applicant_details', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/examsearch');

            
            
            
            $data['title']           = 'Student Search';
            $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']     = $this->sch_setting_detail;
            $data['fields']          = $this->customfield_model->get_custom_fields('students', 1);
            
            
            // $adlist                   = $this->class_model->examget();
            // $data['admissionlist']       = $adlist;
            //$stuexamlist = $this->student_model->examList();
            
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            
            
            $adlist                  = $this->Entranceexam_model->examget($current_entrancesession['cur_session']);
            
            $feelistbyadmission      = $this->Entranceexam_model->examfee_byadmission($current_entrancesession['cur_session']);
            
            $data['admissionlist']        = $adlist;
            $data['feelistbyadmission']   = $feelistbyadmission;
            
            $crslist                 = $this->Entranceexam_model->examgetCourse();
            $data['courselist']      = $crslist;
            // $instlist                = $this->Entranceexam_model->examgetInstitute();
            // $data['institutelist']   = $instlist;
            // $cntrlist                = $this->Entranceexam_model->examgetCenter();
            // $data['centerlist']      = $cntrlist;
            
             $phaselist          = $this->Entranceexam_model->phase($current_entrancesession['cur_session']);
            $data['phaselist']  = $phaselist;
            
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/applicantdetails/examstudentSearch', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
           
            
            
            public function deleteexam($id) 
            {
            $this->Entranceexam_model->admissiondelete($id);
            $this->Entranceexam_model->regdelete($id);
            redirect('EntranceExam/examsearch');
            }
            
            
            public function selectInstitute()
            {
            $course_id = $this->input->get('course_id');
            $data     = $this->Entranceexam_model->examget_Institute($course_id);
            echo json_encode($data);
            }
            
            
            
            public function selectCenter()
            {
            //$data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            $session=$current_entrancesession['cur_session'];
           
             
            $course_id = $this->input->get('course_id');
            $data     = $this->Entranceexam_model->examgetCenter($course_id,$session);
            echo json_encode($data);
            }
            
            
            
            
            public function paymentdetails() 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_payment', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_payment');
            $this->session->set_userdata('sub_menu', 'EntranceExam/paymentdetails');
            $data['title']              = 'Payment';
            
           // $data['paymentdetails']               = $this->Entrance_admin_model->paymentdetails();
            //$data['fee_details']                = $this->Entrance_admin_model->fees_details();
            
            $data['current_entrancesession']      = $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession              = $data['current_entrancesession'];
            $data['paymentdetails']               = $this->Entrance_admin_model->payment_details_bysession($current_entrancesession['cur_session']);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/paymentdetails/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            
            public function feedetails($id) 
            {
            //      if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            //     access_denied();
            // }
            
            // $this->session->set_userdata('top_menu', 'Student Information');
            // $this->session->set_userdata('sub_menu', 'student/search');
            
            $data['title']              = 'Fee Details';
            $data['fee_details']        = $this->Entrance_admin_model->fees_details($id);
            $data['reg_applicant']      = $this->Entrance_admin_model->paymentdetails_byapplicant($id);
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/paymentdetails/feedetails', $data);
            $this->load->view('layout/footer');
            }
      
         
         
         
            public function selected_course()
            {
                
            if (!$this->rbac->hasPrivilege('entrance_exam_course', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/selected_course');

    
                
            $data['current_session']    =  $this->current_session;
            $current_session            =  $data['current_session']; 
            $data['sessionlist']        =  $this->session_model->get(); 
            $courselist                 =  $this->Entranceexam_model->Allcourse();
            $data['get_courselist']     =  $this->Entranceexam_model->getcourselist();
            $data['getselected_courselist']      =  $this->Entranceexam_model->getselected_courselist();
            $data['get_courselist']              =  $data['get_courselist'] ;
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $data['get_phase']                   =  $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
            
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_course/incourse', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            public function add_selected_course()
            {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('course', 'Course', 'required');
            $this->form_validation->set_rules('session', 'Session', 'required'); 
            
            $data['current_session']    =  $this->current_session;
            $current_session            =  $data['current_session']; 
            $data['sessionlist']        =  $this->session_model->get(); 
            $courselist                 =  $this->Entranceexam_model->Allcourse();
            $data['get_courselist']     =  $this->Entranceexam_model->getcourselist();
            
            $data['getselected_courselist']      =  $this->Entranceexam_model->getselected_courselist();
            $data['get_courselist']              =  $data['get_courselist'] ;
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $data['get_phase']                   =  $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
            
            if ($this->form_validation->run() == FALSE)
            {
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_course/incourse', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            $phasearray          =  array();
            $course              = $this->input->post('course');
            $session             = $this->input->post('session');
            $selected_phases     = $this->input->post('phase');
            $existing_record     = $this->db->where('sel_entranceexam_course_name', $course)
            ->where('sel_entranceexam_course_session', $session)
            ->get('entranceexamSelected_course')
            ->row();
            
            $phasearray = array();
            if (!empty($selected_phases)) {
            foreach ($selected_phases as $selected_phase) {
            $phasearray[]  = $selected_phase; 
            }
            }
            
            $json_string   = json_encode($phasearray);
            if ($existing_record) 
            {
            $data = array(
            'sel_entranceexam_course_phaselist' => $json_string
            );
            $this->db->where('sel_entranceexam_course_name', $course);
            $this->db->where('sel_entranceexam_course_session', $session);
            $this->db->update('entranceexamSelected_course', $data);
            } 
            else
            {
            $data        =  array('sel_entranceexam_course_name'=>$course,'sel_entranceexam_course_session'=>$session,'sel_entranceexam_course_phaselist'=>$json_string);
            $query       =  $this->Entranceexam_model->Add_selected_course($data);
            }
            redirect('EntranceExam/selected_course');
            }
            }
                
                
            
            
            public function get_phse_lst()
            {
            $course     =  $this->input->post('course');
            $session    =  $this->input->post('session'); 
            $res        =  $this->Entranceexam_model->get_phse($course,$session);
            echo json_encode($res);
            }
            
            
            
            public function get_Institute_phse_lst()
            {
            $insitute     =  $this->input->post('institute');
            $session      =  $this->input->post('session'); 
            $course       =  $this->input->post('course');
            $res          =  $this->Entranceexam_model->get_institute_phse($insitute,$session,$course);
            echo json_encode($res);
            }
            
            
            
            public function edit_selected_course($id) 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_exam_course', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/selected_course');     
                
                
                
            $data['current_session'] =  $this->current_session;
            $current_session         =  $data['current_session'];
            $data['sessionlist']     =  $this->session_model->get();
            
            $courselist              =  $this->Entranceexam_model->Allcourse();
            $data['courselist']      =  $courselist;
            
            $data['get_courselist']     =  $this->Entranceexam_model->getcourselist();
            $data['get_courselist']     =  $data['get_courselist'] ;
            $data['getselected_courselist'] =  $this->Entranceexam_model->getselected_courselist();
            $courseedit = $this->Entranceexam_model->edit_selectedCourse($id);
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            $data['courseedit'] = $courseedit;
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_course/editcourse', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            public function update_selected_course()
            {
            $id         =  $this->input->post('id');
            $course       =  $this->input->post('course');
            $session    =  $this->input->post('session');
            $this->Entranceexam_model->course_selctedeupdate($id,$course,$session);
            redirect('EntranceExam/selected_course');
            }
            
            
            public function delete_selected_course($id) {
            $this->Entranceexam_model->course_selecteddelete($id);
            redirect('EntranceExam/selected_course');
            }
            
            
            
            public function institute()
            { 
                
            if (!$this->rbac->hasPrivilege('entrance_exam_institute', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/selected_institute'); 
            
            
                
            $data['current_session']    =  $this->current_session;
            $current_session            =  $data['current_session']; 
            $data['sessionlist']        =  $this->session_model->get();  
            $institutelist              =  $this->Entranceexam_model->Allinstitute();
            $data['institutelist']      =  $institutelist;
            $this->load->model('Entranceexam_model');
            $courselist                 =  $this->Entranceexam_model->Allcourse();
            $data['courselist']         =  $courselist;
            $get_all_institute          =  $this->Entranceexam_model->get_all_institute();
            $data['get_all_institute']  =  $get_all_institute;
            
            $data['current_entrancesession']     =   $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            $data['get_phase']                   =   $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_institute/ininstitute', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
                            
            public function add_institute()
            { 
            $data['current_session']    =  $this->current_session;
            $current_session            =  $data['current_session']; 
            $data['sessionlist']        =  $this->session_model->get();  
            $institutelist              =  $this->Entranceexam_model->Allinstitute();
            $data['institutelist']      =  $institutelist;
            $this->load->model('Entranceexam_model');
            $courselist                 =  $this->Entranceexam_model->Allcourse();
            $data['courselist']         =  $courselist;
            $get_all_institute          =  $this->Entranceexam_model->get_all_institute();
            $data['get_all_institute']  =  $get_all_institute;
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =   $data['current_entrancesession'];
            
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $data['get_phase']                   =   $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
             
            $this->load->library('form_validation');
            $this->form_validation->set_rules('inst_name', 'Name', 'required');
            $this->form_validation->set_rules('session', 'Session', 'required'); 
            $this->form_validation->set_rules('inst_course', 'Course', 'required'); 
            $this->form_validation->set_rules('inst_seat', 'Seat No', 'required'); 
            $this->form_validation->set_rules('phase', 'Phase', 'required'); 
            
            if($this->form_validation->run()==FALSE)
            {
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_institute/ininstitute', $data);
            $this->load->view('layout/footer', $data);
            }
            else
            {
            $this->load->model('Entranceexam_model');     
            $phasearray              =  array();
            $name                    =  $this->input->post('inst_name');
            $seat                    =  $this->input->post('inst_seat');
            $course                  =  $this->input->post('inst_course');
            $session                 =  $this->input->post('session');
            $selected_phases         =  $this->input->post('phase');
            
            $existing_record         =  $this->db->where('entranceexam_insitutename', $name)
            ->where('entranceexam_insitutescourse', $course)
            ->where('entranceexam_insitutesession', $session)
            ->where('entranceexam_phaselist', $selected_phases)
            ->get('entranceexam_insitute')
            ->row();
            if ($existing_record) 
            {
            }
            else
            {
            $data=array('entranceexam_insitutename'=>$name,'entranceexam_insituteseats'=>$seat,'entranceexam_insitutescourse'=>$course,
            'entranceexam_insitutesession'=>$session,
            'entranceexam_phaselist'=>$selected_phases);
            $query=$this->Entranceexam_model->Add_selinst($data);
            }
            redirect($_SERVER['HTTP_REFERER']);
            }
            }
               
            
            
            
            // public function edit_selinstitute($id) {
            // $courselist = $this->Entranceexam_model->Allcourse();
            // $data['courselist']       = $courselist;
            
            // $institutelist = $this->Entranceexam_model->Allinstitute();
            // $data['institutelist']       = $institutelist;
            
            // $inedit = $this->Entranceexam_model->getInstitute($id);
            // $data['inedit'] = $inedit;
            
            // $this->load->view('layout/headerentrance');
            // $this->load->view('admin/entranceexam/selected_institute/editinstitute', $data);
            // $this->load->view('layout/footer');
            // } 
            
            
            
            public function delete_institute($id) 
            {
            $this->Entranceexam_model->del_selinstitute($id);
            redirect('EntranceExam/institute');
            }
            
            public function update_institute()
            {
            $data['current_session']      =  $this->current_session;
            //$current_session            =  $data['current_session'];
            $session                      = $this->input->post('session');
            $id                           = $this->input->post('inst_id');
            $name                         = $this->input->post('inst_name');
            $seat                         = $this->input->post('inst_seat');
            $course                       = $this->input->post('inst_course');
            $phase                        = $this->input->post('phase');
            $data=array(
            'entranceexam_insitutename'    => $this->input->post('inst_name'),
            'entranceexam_insituteseats'   => $this->input->post('inst_seat'),
            'entranceexam_insitutescourse' => $this->input->post('inst_course'),
            'entranceexam_insitutesession' => $this->input->post('session'),
            'entranceexam_phaselist'       => $this->input->post('phase'),
            );
                
            $this->db->where(array('entranceexam_insituteid'=>$id));   
            $this->db->update('entranceexam_insitute',$data);
            redirect('EntranceExam/institute');
            }
            
            
            
            
            public function edit_institute($id)
            {
                
            if (!$this->rbac->hasPrivilege('entrance_exam_institute', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/selected_institute');     
                
            $courselist                          =  $this->Entranceexam_model->Allcourse();
            $data['courselist']                  =  $courselist;
            $inedit                              =  $this->Entranceexam_model->getsel_Institute($id);
            $data['inedit']                      =  $inedit;
            $data['current_session']             =  $this->current_session;
            $current_session                     =  $data['current_session']; 
            $data['sessionlist']                 =  $this->session_model->get();  
            $institutelist                       =  $this->Entranceexam_model->Allinstitute();
            $data['institutelist']               =  $institutelist;
            $get_all_institute                   =  $this->Entranceexam_model->get_all_institute();
            $data['get_all_institute']           =  $get_all_institute;
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $data['get_phase']                   =  $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/selected_institute/editinstitute', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            
            public function selected_center()
            {
                
            if (!$this->rbac->hasPrivilege('entrance_exam_institute', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/selected_center'); 
            
            
                
                
            //$data['current_session']    =  $this->current_session;
            //$current_session            =  $data['current_session']; 
            $data['sessionlist']        =  $this->session_model->get();
            
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
            $data['current_session']          =  $this->current_session;
                
            $data['courselist']               = $this->Entranceexam_model->Allcourse();
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();   
            
            $centerlist                       =  $this->Entranceexam_model->Allcenter($data['entrance_current_session']['cur_session']);
            $data['centerlist']               =  $centerlist;
            
            $get_all_centerlist               =  $this->Entranceexam_model->get_all_centerlist();
            $data['get_all_centerlist']       =  $get_all_centerlist;
            
            
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $data['get_phase']                   =  $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
            
            $this->load->model('Entranceexam_model');
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_center/incenter', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            
            public function add_selcenter()
            {
                
            $this->load->library('form_validation');
            $this->form_validation->set_rules('c_name', 'Name', 'required');
            $this->form_validation->set_rules('c_seat', 'Seat', 'required'); 
            $this->form_validation->set_rules('centre_course', 'Course', 'required'); 
            $this->form_validation->set_rules('session', 'Session', 'required'); 
            $this->form_validation->set_rules('phase', 'Phase', 'required');
            if($this->form_validation->run()==FALSE)
            {
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/selected_center/incenter', $data);
            $this->load->view('layout/footer', $data);
            }
            else
            {
            $name        = $this->input->post('c_name');
            $seat        = $this->input->post('c_seat');
            $course      = $this->input->post('centre_course');
            $session     = $this->input->post('session');
            $phase       = $this->input->post('phase');
            $data=array('sel_entranceexam_centrename'=>$name,'sel_entranceexam_centreseat'=>$seat,'sel_entranceexam_centrecourse'=>$course,'sel_entranceexam_centresession'=>$session,'sel_entranceexam_phase'=>$phase);
            $this->load->model('Entranceexam_model');
            $query=$this->Entranceexam_model->Add_selCenter($data);
            redirect('EntranceExam/selected_center');
            }
            }
            
            
            
            public function edit_selcenter($id) 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_exam_institute', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_applcation');
            $this->session->set_userdata('sub_menu', 'EntranceExam/selected_center');    
                
            $data['current_session']          =  $this->current_session;
            $current_session                  =  $data['current_session']; 
            $data['sessionlist']              =  $this->session_model->get();
            $data['courselist']               =  $this->Entranceexam_model->Allcourse();
            $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings(); 
            $centerlist                       =  $this->Entranceexam_model->Allcenter($data['entrance_current_session']['cur_session']);
            $data['centerlist']               =  $centerlist;
            $cedit                            =  $this->Entranceexam_model->getSelCenter($id);
            $data['cedit']                    =  $cedit;
            $get_all_centerlist               = $this->Entranceexam_model->get_all_centerlist();
            $data['get_all_centerlist']       = $get_all_centerlist;
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $data['get_phase']                   =  $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/selected_center/editcenter', $data);
            $this->load->view('layout/footer');
            }
            
            public function update_selcenter() 
            {
            $id       = $this->input->post('c_id');
            $name     = $this->input->post('c_name');
            $seat     = $this->input->post('c_seat');
            $course   = $this->input->post('inst_course');
            $session  = $this->input->post('session');
            $phase    = $this->input->post('phase');
            
            if(!empty($name) && !empty($seat))
            {
            $this->Entranceexam_model->center_selupdate($id,$name,$seat,$course,$session,$phase);
            redirect('EntranceExam/selected_center');
            }
            else
            {
            redirect('EntranceExam/selected_center');
            }
            }
            public function delete_selcenter($id) {
            $this->Entranceexam_model->center_seldelete($id);
            redirect('EntranceExam/selected_center');
            }
            }
            
            ?>