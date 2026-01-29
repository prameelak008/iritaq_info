            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Entrance_subjecttype extends Admin_Controller 
            {
            
            public function subjecttype()
            {
                
            if (!$this->rbac->hasPrivilege('entrancesubject_type', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/Entrance_subjecttype/subjecttype');
                
            $subjecttypelist = $this->Entrance_subjecttypemodel->allsubjecttypes();
            $data['subjecttypelist'] = $subjecttypelist;	
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/subjecttypes/addsubjecttype', $data);
            $this->load->view('layout/footer', $data);
            }
            
            public function addsubjcttype()
            {
            $subname=$this->input->post('sub_name');
            $subcode=$this->input->post('sub_code');
            $subtype=$this->input->post('sub_type');
            $substatus=$this->input->post('sub_status');
            $date = 
            $data=array('entrance_subtype_name'=>$subname,'entrance_subtype_code'=>$subcode,'entrance_subtype_type'=>$subtype,'entrance_subtype_is_active'=>$substatus,'entrance_subtype_created_at'=>date('Y-m-d H:i:s'));
            $query=$this->Entrance_subjecttypemodel->subjecttypeadd($data);
            if(empty($query)) {
            $error = array("Record not saved. Please try again.");
            $array = array('status' => 'fail', 'error' => $error, 'message' => '');
            } else {
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
            echo json_encode($array);
            //redirect('Entrance_subjecttype/subjecttype');
            }
            
            public function editsubjecttype($id) {
                
            if (!$this->rbac->hasPrivilege('entrancesubject_type', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/Entrance_subjecttype/subjecttype');
            
              
            // $courselist = $this->Entranceexam_model->Allcourse();
            // $data['courselist']       = $courselist;   
            $subjecttypelist = $this->Entrance_subjecttypemodel->allsubjecttypes();
            $data['subjecttypelist'] = $subjecttypelist;	
            $subjecttypeedit = $this->Entrance_subjecttypemodel->getsubjecttype($id);
            $data['subjecttypeedit'] = $subjecttypeedit;
            $this->load->view('layout/headerentrance', $data);
            $this->load->view('admin/entranceexam/subjecttypes/editsubjecttype', $data);
            $this->load->view('layout/footer', $data);
            }
            
            public function updatesubjecttype() {
            $subid=$this->input->post('sub_id');
            $subname=$this->input->post('sub_name');
            $subcode=$this->input->post('sub_code');
            $subtype=$this->input->post('sub_type');
            $substatus=$this->input->post('sub_status');
            $query=$this->Entrance_subjecttypemodel->subjecttypeupdate($subname,$subcode,$subtype,$substatus,$subid);
            if(empty($query)) {
            $error = array("Record not updated. Please try again.");
            $array = array('status' => 'fail', 'error' => $error, 'message' => '');
            } else {
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
            echo json_encode($array);
            
            }
            
            public function deletesubjecttype($id) {
            $this->Entrance_subjecttypemodel->subjecttypedelete($id);
            redirect('entrance_allotment/Entrance_subjecttype/subjecttype');
            }
            }
            ?>
