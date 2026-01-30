                <?php
                //defined('BASEPATH')OR exit('No direct script access allowed');
                class Entranceexam_subject extends Admin_Controller 
                {
                    
                    
                    
                
                public function subject()
                {
                    
                if (!$this->rbac->hasPrivilege('entrance_subject', 'can_view')) {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'entrance_exam');
                $this->session->set_userdata('sub_menu', 'entrance_allotment/Entranceexam_subject/subject');  
                
                
                    
                    
                $data['current_session']         =  $this->user_model->get_current_session();
                $ta                              = "sessions";
                $data['sessionlist']             =  $this->Entranceallotment_model->list_dat($ta);
                
                $subjecttypelist                 = $this->Entranceexam_subjectmodel->Allsubjecttypes();
                $data['subjecttypelist']         = $subjecttypelist;
                //$courselist                    = $this->Entranceexam_model->Allcourse();
                
                $data['current_entrancesession'] = $this->Entrance_settings_model->get_entrance_settings();
                $current_entrancesession         = $data['current_entrancesession'];
                $data['courselist']              = $this->Entranceallotment_model->entrance_course($current_entrancesession['cur_session']);
                $courselist                      = $data['courselist']; 
               
                $subjectlist                     = $this->Entranceexam_subjectmodel->allsubject($current_entrancesession['cur_session']);
                $data['subjectlist']             = $subjectlist;
                $this->load->view('layout/headerentrance', $data);
                $this->load->view('admin/entranceexam/subjects/addsubject', $data);
                $this->load->view('layout/footer', $data);
                }
                
                
                
                
                
                
                
                public function addsubject()
                {
                    
                $course=$this->input->post('sub_course');
                $sub_subid=$this->input->post('sub_subid');
                $sub_status=$this->input->post('sub_status');
                //$sessionid=$this->input->post('session');
                
                
                $data['current_entrancesession']=  $this->Entrance_settings_model->get_entrance_settings();
                $current_entrancesession        =  $data['current_entrancesession'];
                
                $data=array('entranceexam_subject_course_id'=>$course,'entranceexam_subject_subid'=>$sub_subid,'entranceexam_subject_status'=>$sub_status,'entranceexam_subject_sessionid'=> $current_entrancesession['cur_session']);
                $query=$this->Entranceexam_subjectmodel->subjectadd($data);
                if(empty($query)) {
                $error = array("Record not saved. Please try again.");
                $array = array('status' => 'fail', 'error' => $error, 'message' => '');
                } else {
                $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
                }
                echo json_encode($array);
             
                }
                
                public function editsubject($id) 
                {
                    
                if (!$this->rbac->hasPrivilege('entrance_subject', 'can_view')) 
                {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'entrance_exam');
                $this->session->set_userdata('sub_menu', 'entrance_allotment/Entranceexam_subject/subject');
                
                
                
                $data['current_session']        =  $this->user_model->get_current_session();
                $ta                             = "sessions";
                $data['sessionlist']            =  $this->Entranceallotment_model->list_dat($ta);
                $subjecttypelist = $this->Entranceexam_subjectmodel->Allsubjecttypes();
                $data['subjecttypelist']       = $subjecttypelist;
                //$courselist = $this->Entranceexam_subjectmodel->Allcourse();
                //$data['courselist']       = $courselist;  
                
                
                
                $data['current_entrancesession']= $this->Entrance_settings_model->get_entrance_settings();
                $current_entrancesession        = $data['current_entrancesession'];
                $data['courselist']             = $this->Entranceallotment_model->entrance_course($current_entrancesession['cur_session']);
                $courselist                     = $data['courselist']; 
                 
                $subjectlist = $this->Entranceexam_subjectmodel->allsubject($current_entrancesession['cur_session']);
                $data['subjectlist']       = $subjectlist;  
                $subjectedit = $this->Entranceexam_subjectmodel->getsubject($id);
                $data['subjectedit'] = $subjectedit;
                $this->load->view('layout/headerentrance', $data);
                $this->load->view('admin/entranceexam/subjects/editsubject', $data);
                $this->load->view('layout/footer', $data);
                }
                
                public function updatesubject() {
                $id = $this->input->post('sub_id');
                $course=$this->input->post('sub_course');
                $subid=$this->input->post('sub_subid');
                $status=$this->input->post('sub_status');
               // $sessionid=$this->input->post('session');
               
                $data['current_entrancesession']=  $this->Entrance_settings_model->get_entrance_settings();
                $current_entrancesession        =  $data['current_entrancesession'];
                $query=$this->Entranceexam_subjectmodel->subjectupdate($id,$course,$subid,$status,$current_entrancesession['cur_session']);
                if(empty($query)) {
                $error = array("Record not updated. Please try again.");
                $array = array('status' => 'fail', 'error' => $error, 'message' => '');
                } else {
                $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
                }
                echo json_encode($array);
                //redirect('Entranceexam_subject/subject');
                }
                
                public function deletesubject($id) {
                $query=$this->Entranceexam_subjectmodel->subjectdelete($id);
                //  if(empty($query)) {
                //     $error = array("Record Not Deleted");
                //     $array = array('status' => 'fail', 'error' => $error, 'message' => '');
                // } else {
                //     $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
                // }
                // echo json_encode($array);
                redirect('entrance_allotment/Entranceexam_subject/subject');
                }
                }
                ?>
