        <?php
        //defined('BASEPATH')OR exit('No direct script access allowed');
        class Entranceexam_marks extends Admin_Controller 
        {
        
        
        public function marks()
        {
        if (!$this->rbac->hasPrivilege('entrance_assign_marks', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'entrance_exam');
        $this->session->set_userdata('sub_menu', 'entrance_allotment/Entranceexam_marks/marks');
            
            
        //$data['current_session']           =  $this->user_model->get_current_session();
        $data['current_entrancesession']     =   $this->Entrance_settings_model->get_entrance_settings();
        $current_entrancesession             =   $data['current_entrancesession'];
        
        $cur_ses                             =   $data['current_entrancesession']['cur_session'];
        $data['get_phase']                   =   $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
        $ta                             = "sessions";
        $data['sessionlist']            =  $this->Entranceallotment_model->list_dat($ta);
        $list                           =  $this->Entranceexam_marksmodel->allmarks($cur_ses);
        $data['markslist']              =  $list;
        
        
        // $sublist = $this->Entranceexam_marksmodel->allsubject();
        // $data['subjectlist']       = $sublist;  
        $courselist = $this->Entranceexam_model->Allcourse();
        $data['courselist']       = $courselist;
        $this->load->view('layout/headerentrance', $data);
        $this->load->view('admin/entranceexam/entranceexam_marks/exammark', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        public function addmarks()
        {
        $session_idd    =   $this->setting_model->getCurrentSession();
        $session_id     =   $this->input->post('session');
        $course         =   $this->input->post('course_id');
        $subject        =   $this->input->post('subject_id');
        $maxmark        =   $this->input->post('max_mark');
        $minmark        =   $this->input->post('min_mark');
        $year           =   $this->input->post('year');
        $active         =   1;
        $phase          =   $this->input->post('phase');
        
        $data=array('entranceexam_marks_session_id' => $session_id,'entranceexam_marks_course_id'=>$course,'entranceexam_marks_subject_id'=>$subject,
        'entranceexam_marks_maximum_marks'=>$maxmark,'entranceexam_marks_minimum_marks'=>$minmark,
        'entranceexam_marks_year' => $year,'entranceexam_marks_active'=>$active,
        'entranceexam_marks_phase'=>$phase);
        
        // $subexists = $this->Entranceexam_marksmodel->chksubject($subject,$course);
        // if(empty($subexists))
        // {
        $query=$this->Entranceexam_marksmodel->marksadd($data);
        
        redirect('entrance_allotment/Entranceexam_marks/marks');
        //       }
        // else
        //       {
        //           redirect('Entranceexam_marks/marks');
        //       }
        }
        
        
        
        public function editmarks($id) 
        {
        if (!$this->rbac->hasPrivilege('entrance_assign_marks', 'can_view')) 
        {
        access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'entrance_exam');
        $this->session->set_userdata('sub_menu', 'entrance_allotment/Entranceexam_marks/marks');    
            
        $data['current_session']              =   $this->user_model->get_current_session();
        $cur_ses                              =   $data['current_entrancesession']['cur_session'];
        $data['current_entrancesession']      =   $this->Entrance_settings_model->get_entrance_settings();
        $current_entrancesession              =   $data['current_entrancesession'];
        $cur_ses                              =   $data['current_entrancesession']['cur_session'];
        $ta                                   =   "sessions";
        $data['sessionlist']                  =   $this->Entranceallotment_model->list_dat($ta);
        $list                                 =   $this->Entranceexam_marksmodel->allmarks($cur_ses);
        $data['get_phase']                    =   $this->Entranceallotment_model->get_phase($data['current_entrancesession']['cur_session']);
        
        
        $data['markslist']              = $list;
        // $sublist = $this->Entranceexam_marksmodel->allsubject();
        // $data['subjectlist']         = $sublist;  
        
        
        $courselist                     = $this->Entranceexam_model->Allcourse();
        $data['courselist']             = $courselist;
        $markedit                       = $this->Entranceexam_marksmodel->getMarks($id);
        $data['markedit']               = $markedit;
        
        
        $this->load->view('layout/headerentrance');
        $this->load->view('admin/entranceexam/entranceexam_marks/editexammark', $data);
        $this->load->view('layout/footer');
        }
        
        
        
        
        public function updatemark() 
        {
        $mark_id=$this->input->post('mark_id');
        $course=$this->input->post('course_id');
        $subject=$this->input->post('subject_id');
        $maxmark=$this->input->post('max_mark');
        $minmark=$this->input->post('min_mark');
        $year=$this->input->post('year');
        $active=$this->input->post('active');
        $phase=$this->input->post('phase');
        
        // $subexists = $this->Entranceexam_marksmodel->chksubject($subject,$course);
        // if(empty($subexists))
        // {
        $this->Entranceexam_marksmodel->exammarkupdate($course,$subject,$maxmark,$minmark,$year,$active,$mark_id,$phase);
        redirect('entrance_allotment/Entranceexam_marks/marks');
        // }
        // else
        // {
        // 	redirect('Entranceexam_marks/marks');
        // }
        }
        
        
        
        
        public function deletemark($id) 
        {
        $this->Entranceexam_marksmodel->markdelete($id);
        redirect('entrance_allotment/Entranceexam_marks/marks');
        }
        
        
        public function selectSubject()
        {
        $course_id  = $this->input->POST('course_id');
        $data       = $this->Entranceexam_marksmodel->examgetSubject($course_id);
        echo json_encode($data);
        }
        
        
        
        }
        ?>