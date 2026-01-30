            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Set_fees extends Admin_Controller 
            {
                
                
            public function index() 
            {
                
            if (!$this->rbac->hasPrivilege('template', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_settings');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/set_fees');
            
            
            
            // $data['current_session']        =  $this->user_model->get_current_session();

            $data['current_session']        =   $this->Entrance_settings_model->get_entrance_settings();
            $current_session                =   $data['current_session'];
            $data['title']                  =   "Allot Students";
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            $taballotype                    =   "entrance_allotmentseattype";
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
            $data['seatno_bymanagment']     =   $this->Entranceallotment_model->seatno_bymanagment();
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_session['cur_session']);
            $data['entrance_phase']         =   $this->input->post('entrance_phase');
            $entrance_phase                 =   $data['entrance_phase'];
            $data['seatquota']              =   $this->Entranceallotment_model->search_Seatquota($courseid, $session_id);
            $data['getseatval']             =   $this->Entranceallotment_model->getseatval($courseid,$session_id,$entrance_phase);
            $data['seatno']                 =   $this->Entranceallotment_model->seatno();
            $data['eligibleseatno']         =   $this->Entranceallotment_model->eligibleseatno($courseid, $session_id,$entrance_phase);
            $data['get_fees_status']        =   $this->Entranceallotment_model->get_fees_status($courseid, $session_id,$entrance_phase);
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/setfees/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            function addval() 
            {
            // if (!$this->rbac->hasPrivilege('examfees_charge', 'can_add')) {
            // access_denied();
            // }
            $data['title']                  =   'Add Exam Fees Charge'; 
             $data['current_session']       =   $this->Entrance_settings_model->get_entrance_settings();
            $current_session                =   $data['current_session'];
            
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_session['cur_session']);
            $data['get_fees_status']        =   $this->Entranceallotment_model->get_fees_status($courseid, $session_id,$entrance_phase);
            
            $this->form_validation->set_rules('entrance_phase', $this->lang->line('entrance_phase'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('session', $this->lang->line('session'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('entrance_course', $this->lang->line('entrance_course'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('entrance_title', $this->lang->line('entrance_title'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('entrance_fees', $this->lang->line('entrance_fees'), 'trim|required|xss_clean');
    
            if ($this->form_validation->run() == FALSE)
            {
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/setfees/index', $data);
            $this->load->view('layout/footer');
            } 
            else 
            {
            $phaseId = $this->input->post('entrance_phase');
            $title   = $this->input->post('entrance_title');
            $this->db->where(array('entrance_setfees_phase'=> $phaseId,'UPPER(entrance_setfees_fees_title)' => strtoupper($title) ));
            
            $query = $this->db->get('entranceexam_setfees');
            if ($query->num_rows() > 0)
            {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">This phase already exists.</div>');
            redirect('entrance_allotment/set_fees');
            } 
            else
            { 
            $data                            = array(
            'entrance_setfees_phase'         => $this->input->post('entrance_phase'),
            'entrance_setfees_session'       => $this->input->post('session'),
            // 'entrance_setfees_course'        => $this->input->post('entrance_course'),
            'entrance_setfees_course'        => json_encode($this->input->post('entrance_course')), // Convert array to JSON
            
            'entrance_setfees_fees_title'    => $this->input->post('entrance_title'),
            'entrance_setfees_fees'          => $this->input->post('entrance_fees'),
            'entrance_setfees_createddate'   => date('d-m-Y'));
            $this->db->insert('entranceexam_setfees', $data); 
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('entrance_allotment/set_fees');
            }
            }
            }
            
            
            
            public function delval($id='0')
            {
            $table="entranceexam_setfees";
            $condition=array('entrance_setfees_id'=>$id);  
            $this->Entranceallotment_model->delete_data($table,$condition);
            redirect('entrance_allotment/set_fees');
            }
            
            
            public function editval($id)
            {
                
            if (!$this->rbac->hasPrivilege('template', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_settings');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/set_fees');
            
            $data['id']                     =   $id;
            $data['get_fees']               =   $this->Entranceallotment_model->get_fees_byid($id);
            
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            
            $data['title']                  =   'Add Exam Fees Charge'; 
            $data['current_session']        =   $this->Entrance_settings_model->get_entrance_settings();
            $current_session                =   $data['current_session'];
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            $data['get_phase']              =   $this->Entranceallotment_model->get_phase($current_session['cur_session']);
            $data['entrance_phase']         =   $this->input->post('entrance_phase');
            $entrance_phase                 =   $data['entrance_phase'];
            $data['get_fees_status']        =   $this->Entranceallotment_model->get_fees_status($courseid, $session_id,$entrance_phase);
            
            $this->form_validation->set_rules('entrance_phase', $this->lang->line('entrance_phase'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('session', $this->lang->line('session'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('entrance_course', $this->lang->line('entrance_course'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('entrance_title', $this->lang->line('entrance_title'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('entrance_fees', $this->lang->line('entrance_fees'), 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == false) {
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/setfees/edit', $data);
            $this->load->view('layout/footer');
            } 
            else 
            {
            $data                            = array(
            'entrance_setfees_phase'         => $this->input->post('entrance_phase'),
            'entrance_setfees_session'       => $this->input->post('session'),
            // 'entrance_setfees_course'        => $this->input->post('entrance_course'),
             'entrance_setfees_course'        => json_encode($this->input->post('entrance_course')),
            'entrance_setfees_fees_title'    => $this->input->post('entrance_title'),
            'entrance_setfees_fees'          => $this->input->post('entrance_fees'),
            'entrance_setfees_updateddate'   => date('d-m-Y'));
            
           
            $this->db->where('entrance_setfees_id', $id);
            $this->db->update('entranceexam_setfees', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect($_SERVER['HTTP_REFERER']);
            }
            }
            
            
            
            public function update_status()
            {
            $id         = $this->input->post('Id');
            $status     = $this->input->post('status');
            $data       = array(
            'entrance_setfees_status' => $status
            );
            $this->db->where('entrance_setfees_id', $id);
            if ($this->db->update('entranceexam_setfees', $data)) 
            {
            echo json_encode(array('status' => 'success'));
            } 
            else 
            {
            echo json_encode(array('status' => 'error'));
            }
            }
            
            
            
            public function get_course_status()
            {
            $phaseId        = $this->input->post('phase_id');
            $entrance_title = strtoupper($this->input->post('entrance_title'));
            if (!empty($phaseId)) 
            {
            $data['courseList']                 =   $this->Entranceallotment_model->getCoursesByPhase($phaseId,$entrance_title);
            $courseList                         =   $data['courseList'];
            $courseIds = array_column($courseList, 'entrance_setfees_course');
            echo json_encode($courseIds);
            } 
            else 
            {
            echo json_encode([]); // Return empty array if phaseId is not provided
            }
            }
            }
            ?>