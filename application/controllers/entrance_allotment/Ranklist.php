            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Ranklist extends Admin_Controller 
            {
               
               
                
            public function index() 
            {
            //      if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            //     access_denied();
            // }
            
            // $this->session->set_userdata('top_menu', 'Student Information');
            // $this->session->set_userdata('sub_menu', 'student/search');
            
            // $data['current_session']     =  $this->user_model->get_current_session();

            $data['current_session']        =   $this->Entrance_settings_model->get_entrance_settings();
            $current_session                =   $data['current_session'];
            $data['title']                  =   "Ranklist";
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            $taballotype                    =   "entrance_allotmentseattype";
            $condallotcond                  =    array('entrance_allot_type_status'=>1);
            $data['allottype']              =    $this->Entranceallotment_model->list_data($taballotype,$condallotcond);
            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);
            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            $data['phaseid']                =   $this->input->post('phaseid');
            $phaseid                        =   $data['phaseid'];
            
           
           
            $data['entrance_institute']     =   $this->Entranceallotment_model->getallot_institute($courseid);
            $data['seatquota']              =   $this->Entranceallotment_model->search_Seatquota($courseid, $session_id);
            $data['getseatval']             =   $this->Entranceallotment_model->getseatval($courseid, $session_id,$phaseid);
            $data['seatno']                 =   $this->Entranceallotment_model->seatno();
            $data['eligibleseatno']         =   $this->Entranceallotment_model->eligibleseatno($courseid, $session_id,$phaseid);
            $data['ranklist']               =   $this->Entranceallotment_model->ranklist($courseid, $session_id);
            $data['seatno_bymanagment']     =   $this->Entranceallotment_model->seatno_bymanagment();
            $data['current_entrancesession']=  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession        =  $data['current_entrancesession'];
            $phaselist                      =  $this->Entranceexam_model->phase($current_entrancesession['cur_session']);
            $data['phaselist']              =  $phaselist;
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/ranklist/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
          
            public function addval()
            {
            $eligiblepercentage    =  $this->input->post('eligiblepercentage');
            $passoutpercentage     =  $this->input->post('passoutpercentage');
            $admissioneligibilty   =  $this->input->post('admissioneligibilty');
            $headerpercentage      =  $this->input->post('headerpercentage');
            $courseid              =  $this->input->post('courseid');
            $sessionid             =  $this->input->post('sessionid');
            $seatquotaid           =  $this->input->post('seatquotaid');
            $this->db->where('entranceexam_seatquota_id', $seatquotaid);
            $q = $this->db->get('entranceexam_seatquota'); 
            if ($q->num_rows() > 0)
            {
            $update_result          = $q->row();
            $data                    =     array(                                                                
            'entranceexam_seatquota_eligiblepercentage'   =>     $eligiblepercentage,
            'entranceexam_seatquota_passoutpercentage'    =>     $passoutpercentage,
            'entranceexam_seatquota_admissioneligibilty'  =>     $admissioneligibilty,
            'entranceexam_seatquota_headerpercentage'     =>     $headerpercentage,
            'entranceexam_seatquota_course'               =>     $courseid,
            'entranceexam_seatquota_session'              =>     $sessionid,
            'entranceexam_seatquota_updateddate'          =>     date('y-m-d h:i:s'));
            
             $this->db->where('entranceexam_seatquota_id', $update_result->entranceexam_seatquota_id);
             $query=$this->db->update('entranceexam_seatquota', $data);
             echo json_encode($query);
            }
            else
            {
            $data                    =     array(                                                                
            'entranceexam_seatquota_eligiblepercentage'   =>     $eligiblepercentage,
            'entranceexam_seatquota_passoutpercentage'    =>     $passoutpercentage,
            'entranceexam_seatquota_admissioneligibilty'  =>     $admissioneligibilty,
            'entranceexam_seatquota_headerpercentage'     =>     $headerpercentage,
            'entranceexam_seatquota_course'  =>     $courseid,
            'entranceexam_seatquota_session' =>     $sessionid,
            'entranceexam_seatquota_createddate'    =>     date('y-m-d h:i:s')); 
             $query= $this->db->insert('entranceexam_seatquota', $data);
             echo json_encode($query);
            }
            }
            
            
            
            public function delval()
            {
            $id       =  $this->input->post('id');
            $table="entranceexam_seatquota";
            $condition=array('entranceexam_seatquota_id'=>$id);  
            $query=$this->Entranceallotment_model->delete_data($table,$condition);
            echo json_encode($query);
            }
            
            
            
            public function deleligibleval()
            {
            $id       =  $this->input->post('id');
            $table="entranceexam_eligiblequota";
            $condition=array('entranceexam_eligiblequota_id'=>$id);  
            $query=$this->Entranceallotment_model->delete_data($table,$condition);
            echo json_encode($query);
            }
            
            
            
            
            public function addeligibleval()
            {
            $courseid                      =  $this->input->post('courseid');
            $sessionid                     =  $this->input->post('sessionid');
            $entrance_eligiblepercentage   =  $this->input->post('entrance_eligiblepercentage');
            $entrance_allot_type_name      =  $this->input->post('entrance_allot_type_name');
            $alot_id                       =  $this->input->post('alot_id');
            $this->db->where('entranceexam_eligiblequota_course', $courseid);
            $this->db->where('entranceexam_eligiblequota_session', $sessionid);
            $this->db->where('entranceexam_eligiblequota_seattype', $entrance_allot_type_name);
            $q = $this->db->get('entranceexam_eligiblequota'); 
            
            if ($q->num_rows() > 0)
            {
            
            $update_result          = $q->row();
            
            
            $data                    =     array(                                                                
            'entranceexam_eligiblequota_course'            =>     $courseid,
            'entranceexam_eligiblequota_session'           =>     $sessionid,
             'entranceexam_eligiblequota_seattype'         =>     $entrance_allot_type_name,
            'entranceexam_eligiblequota_elig_percentage'   =>     $entrance_eligiblepercentage,
            'entranceexam_eligiblequota_updateddate'       =>     date('y-m-d h:i:s'));
            
             $this->db->where('entranceexam_eligiblequota_id', $update_result->entranceexam_eligiblequota_id);
             $query=$this->db->update('entranceexam_eligiblequota', $data);
             echo json_encode($query);
            }
            else
            {
            $data                    =     array(
            'entranceexam_eligiblequota_course'            =>     $courseid,
            'entranceexam_eligiblequota_session'           =>     $sessionid,
             'entranceexam_eligiblequota_seattype'         =>     $entrance_allot_type_name,
            'entranceexam_eligiblequota_elig_percentage'   =>     $entrance_eligiblepercentage,
            'entranceexam_eligiblequota_createddate'       =>     date('y-m-d h:i:s'));
             $query= $this->db->insert('entranceexam_eligiblequota', $data);
             echo json_encode($query);
            
            }
            }
            
            function getvalue()
            { 
            $type_name    =  $this->input->post('type_name');
            $courseid    =  $this->input->post('courseid');
            $sessionid    =  $this->input->post('sessionid');
            $alot_id    =  $this->input->post('alot_id');
            $query=$this->Entranceallotment_model->getseat_val($type_name,$courseid,$sessionid);
            echo json_encode($query);
            
            }
            
            
            }
            ?>