            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Examresult extends Admin_Controller 
            {
                
            public function index() 
            {
                
            if (!$this->rbac->hasPrivilege('entrance_enter_marks', 'can_view')) 
            {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/Examresult');

            
            
            //$data['current_session']      =  $this->user_model->get_current_session();
            $data['current_session']        =  $this->Entrance_settings_model->get_entrance_settings();
           
            $entrance_current_session       =   $data['current_session'];
            $data['title']                  =  'Enter Marks';
            $table                          =  "entranceexam_course";
            $ta                             =  "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            
            $data['phaseid']                =   $this->input->post('entrance_phase');
            $phaseid                        =   $data['phaseid'];
            
            $data['studentList']            =   $this->Entranceallotment_model->searchExamStudents($courseid, $session_id,$phaseid);
            
            $data['subjectlist']            =   $this->Entranceallotment_model->searchSubjectlist($courseid, $session_id);
            $data['examresult']             =   $this->Entranceallotment_model->searchExamResult($courseid, $session_id);
            $data['subjectmarks']           =   $this->Entranceallotment_model->searchsubjectmarks($courseid, $session_id);
            $data['get_publish']            =   $this->Entranceallotment_model->get_publish_result($courseid, $session_id,$phaseid);
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($entrance_current_session['cur_session']);
            $data['entrance_phase']         =   $this->input->post('entrance_phase');
            $entrance_phase                 =   $data['entrance_phase'];
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/examresult/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            public function publishexamresult()
            {
            $regid                = $this->input->post('regid');
            $examsession          = $this->input->post('examsession');
            $rank                 = $this->input->post('rank');
            $percentage           = $this->input->post('percentage');
            $totalmarks           = $this->input->post('totalmarks');
            $publishdate          = $this->input->post('publishdate');
            $fgrade               = $this->input->post('fgrade');
            $cou                  = $this->input->post('cou');
            $sess                 = $this->input->post('sess');
            $publishdate          = $this->input->post('publishdate');
            $publishtime          = $this->input->post('publishtime');
            $entrance_phase       = $this->input->post('entrance_phase');
            
            
            $insert_array         = array();
            $update_array         = array();
           
            for($i=0;$i<=count($regid);$i++)
            {
            $dat[$i]                   =  array( 
            'ui_examresult'        =>  1,
            'ui_result_publishdate'=>  $publishdate.':'.$publishtime
                        );
            $this->db->where('reg_id', $regid[$i]);
            $this->db->update('set_entrance_uidesign', $dat[$i]);
            }
            
            
            for($i=0;$i<=count($regid);$i++)
            {   
            $this->db->where('exam_publish_regid', $regid[$i]);
            $q = $this->db->get('entranceexam_publish_result_value');
            if ($q->num_rows() > 0)
            {
            $update_result[$i] = $q->row();
            $data[$i]                   =  array( 
            'exam_publish_regid'        =>  $regid[$i],
            'exam_publish_examsession'  =>  $examsession[$i],
            'exam_publish_percentage'   =>  $percentage[$i],
            'exam_publish_totalmarks'   =>  $totalmarks[$i],
            'exam_publish_rank'         =>  $rank[$i],
            'exam_publish_grade'        =>  $fgrade[$i],
            'exam_publish_date'         =>  $publishdate,
            'exam_publish_time'         =>  $publishtime,
            'exam_publish_phasegroup'   =>  $entrance_phase,
            'exam_publish_updateddate'  =>  date('y-m-d h:i:s'));
            $this->db->where('exam_publish_regid', $update_result[$i]->exam_publish_regid);
            $this->db->update('entranceexam_publish_result_value', $data[$i]);
            }
            else
            {
            $data[$i]                   =  array( 
            'exam_publish_regid'        =>  $regid[$i],
            'exam_publish_examsession'  =>  $examsession[$i],
            'exam_publish_percentage'   =>  $percentage[$i],
            'exam_publish_totalmarks'   =>  $totalmarks[$i],
            'exam_publish_rank'         =>  $rank[$i],
            'exam_publish_grade'        =>  $fgrade[$i],
            'exam_publish_date'         =>  $publishdate,
            'exam_publish_time'         =>  $publishtime,
            'exam_publish_phasegroup'   =>  $entrance_phase,
            'exam_publish_updateddate'  =>  date('y-m-d h:i:s'));
            $this->db->insert('entranceexam_publish_result_value',$data[$i]);                                                     
            }
            }
            redirect('entrance_allotment/Examresult');
            }
            }
            ?>