            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Add_marks extends Admin_Controller 
            {
                
                
            public function index() 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_enter_marks', 'can_view')) 
            {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/Add_marks');
            
            $data['current_session']        =  $this->user_model->get_current_session();
            
            $data['title']                  = 'Enter Marks';
            $table                          = "entranceexam_course";
            $ta                             = "sessions";
            $condition                      =  array('entranceexam_course_status'=>1);
            $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            
            $data['courseid']               =  $this->input->post('entrance_course');
            $courseid                       =  $data['courseid'];
            
            $data['session_id']             =  $this->input->post('session');
            $session_id                     =  $data['session_id'];
            $data['subjectid']              =  $this->input->post('entrance_subject');
            
            
            $subjectid                      =  $data['subjectid'];
            $data['phaseid']                =  $this->input->post('phaseid');
            $phaseid                        =  $data['phaseid'];
            
            //$data['sessionlist']               =    $this->Entranceallotment_model->list_dat($ta);
             $data['sessionlist']                =    $this->session_model->get(); 
            $data['applicants']                  =    $this->Entranceallotment_model->get_applicants($courseid,$session_id,$subjectid,$phaseid);
            $data['subject_marks']               =    $this->Entranceallotment_model->get_subjectmarks($courseid,$session_id,$subjectid);
            $data['getby_marks']                 =    $this->Entranceallotment_model->get_marks();
            $data['current_entrancesession']     =    $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =    $data['current_entrancesession'];
            $phaselist                           =    $this->Entranceexam_model->phase($current_entrancesession['cur_session']);
            $data['phaselist']                   =    $phaselist;
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/addexam/index', $data);
            $this->load->view('layout/footer');
            }
            
            public function getentranceSubject()
            {
            $entrance_course     =   $this->input->post('entrance_course');
            $data                =   $this->Entranceallotment_model->getentrance_subject($entrance_course);
            echo json_encode($data);
            }
            
            
                
            public function entermarks()
            {
                
            if (!$this->rbac->hasPrivilege('entrance_enter_marks', 'can_view')) 
            {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/Add_marks');  
            
                
            $applicantname   = $this->input->post('applicantname');
            $subjectid       = $this->input->post('subjectid');
            $marks           = $this->input->post('marks');
            $notes           = $this->input->post('notes');
            $session_id      = $this->input->post('session_id');
            $marksid         = $this->input->post('marksid');
            $max_marks       = $this->input->post('max_marks');
            $min_marks       = $this->input->post('min_marks');
            $insert_array    = array();
            $update_array    = array();
            
            for($i=0;$i<=count($applicantname);$i++)
            {
            $this->db->where('entranceexam_result_applicant', $applicantname[$i]);
            $this->db->where('entranceexam_result_subject', $subjectid[$i]);
            $this->db->where('entranceexam_result_session', $session_id[$i]);
            $q = $this->db->get('entranceexam_result_value');                
            
            if ($q->num_rows() > 0)
            {
            $update_result[$i] = $q->row();
            $data[$i]          =  array(
            'entranceexam_result_getmarks'                  =>  $marks[$i],
            'entranceexam_result_max_marks'                 =>  $max_marks[$i],
            'entranceexam_result_min_marks'                 =>  $min_marks[$i],
            'entranceexam_result_notes'                     =>  $notes[$i],
            'entranceexam_result_updateddate'               =>  date('y-m-d h:i:s'));
            $this->db->where('entranceexam_result_id', $update_result[$i]->entranceexam_result_id);
            $this->db->update('entranceexam_result_value', $data[$i]);
            }
            else
            {
            $data[$i]                                        =  array( 
            'entranceexam_result_applicant'                  =>  $applicantname[$i],
            'entranceexam_result_subject'                    =>  $subjectid[$i],
            'entranceexam_result_getmarks'                   =>  $marks[$i],
             'entranceexam_result_max_marks'                 =>  $max_marks[$i],
            'entranceexam_result_min_marks'                  =>  $min_marks[$i],
            'entranceexam_result_notes'                      =>  $notes[$i],
            'entranceexam_result_session'                    =>  $session_id[$i],
            'entranceexam_result_marksid'                    =>  $marksid[$i],
            'entranceexam_result_createddate'                =>  date('y-m-d h:i:s'));
            $this->db->insert('entranceexam_result_value',$data[$i]);                                                     
            }
            }
            redirect('entrance_allotment/add_marks');
            }
            }
            ?>