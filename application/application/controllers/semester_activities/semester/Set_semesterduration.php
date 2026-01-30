                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }


                class Set_semesterduration  extends Admin_Controller
                { 
                                    
                    
                public function __construct()
                {
                parent::__construct();
                $this->load->helper('form');
                $this->config->load('app-config');
                $this->load->library("datatables");
                $this->current_session = $this->setting_model->getCurrentSession(); 
                }  



                //                     public function index()
                //                     {

                //                     if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                //                     access_denied();
                //                     }

                //                     $this->session->set_userdata('top_menu', 'semester');
                //                     $this->session->set_userdata('sub_menu', 'batch_semester/index'); 

                //                     $data['title']      = 'Add Batch Semester';
                //                     $data['title_list'] = 'Semester';                    
                //                     $this->form_validation->set_rules('batch_semtype', $this->lang->line('batch_type'), 'trim|required|xss_clean');
                //                     $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester_type'), 'trim|required|xss_clean'); 
                //                     $this->form_validation->set_rules('semester_no', $this->lang->line('semester_no'), 'trim|required|xss_clean'); 
                //                     $this->form_validation->set_rules('from_semdate', $this->lang->line('date_from'), 'trim|required|xss_clean'); 
                //                     $this->form_validation->set_rules('to_semdate', $this->lang->line('date_to'), 'trim|required|xss_clean'); 
                //                     $this->form_validation->set_rules('capacity', $this->lang->line('capacity'), 'trim|required|xss_clean');                     
                //                     $data['semestertype_list']     =   $this->Semestertype_model->getdata(); 
                //                     $data['batch_semester']        =   $this->batch_semester_model->get_batch_semester();




                //                     if ($this->form_validation->run() == false)
                //                     {
                //                     } 
                //                     else 
                //                     {
                //                     // $data                      = array(
                //                     // 'bchtyp_id'                => $this->input->post('batch_type'),
                //                     // 'semtyp_id'                => $this->input->post('semester_type'), 
                //                     // 'bchsem_no'                => $this->input->post('semester_no'),
                //                     // 'bchsem_from'              => $this->input->post('from_date'),
                //                     // 'bchsem_to'                => $this->input->post('to_date'),                      
                //                     // 'bchsem_capacity'          => $this->input->post('capacity'),                     
                //                     // 'bchsem_createddate'       => date('Y-m-d H:i:s'),
                //                     // ); 

                //                     // $this->batch_semester_model->add($data);

                // $id=$this->input->post('batch_semtype');

                //                     if($id=="")
                //                     {                        
                //                     $data                      = array(
                //                     'bchtyp_id'                => $this->input->post('batch_semtype'),
                //                     'semtyp_id'                => $this->input->post('semester_semtype'), 
                //                     'bchsem_no'                => $this->input->post('semester_no'),
                //                     'bchsem_from'              => $this->input->post('from_date'),
                //                     'bchsem_to'                => $this->input->post('to_date'),                      
                //                     'bchsem_capacity'          => $this->input->post('capacity'),                     
                //                     'bchsem_createddate'       => date('Y-m-d H:i:s'),
                //                     ); 
                //                     $this->Set_semesterDuration_model->add($data);
                //                     }
                //                     else
                //                     {                         
                //                      $data                     =  array(
                //                     'id'                       => $id,      
                //                     'bchtyp_id'                => $this->input->post('batch_semtype'),
                //                     'semtyp_id'                => $this->input->post('semester_semtype'), 
                //                     'bchsem_no'                => $this->input->post('semester_no'),
                //                     'bchsem_from'              => $this->input->post('from_date'),
                //                     'bchsem_to'                => $this->input->post('to_date'),                      
                //                     'bchsem_capacity'          => $this->input->post('capacity'),                     
                //                     'bchsem_createddate'       => date('Y-m-d H:i:s'),                
                //                     );
                //                     $this->Set_semesterDuration_model->add($data);
                //                     }



                //                     $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                //                     redirect('semester/Set_SemesterDuration/index');
                //                     }
                //                     $data['semester_list']  =   $this->Semester_model->get();
                //                     $semester_list          =   $data['semester_list'];
                //                     $data['batchlist']      =   $this->Batch_model->batchlist(); 

                //                     $this->load->view('layout/header', $data);
                //                     $this->load->view('semester/batchsemester/add_data', $data);
                //                     $this->load->view('layout/footer', $data);
                //                     }                   






                public function index()
                { 
                if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'setduration/index');

                $data['title']      = 'Semester';
                $data['title_list'] = 'Set Duration';     
                $this->form_validation->set_rules('from_semdate', $this->lang->line('from_semdate'), 'trim|required|xss_clean');
                $id                 = $this->input->post('semesterduration_id');  


                
                $data['semestertype_list'] = $this->Semestertype_model->getdata();
                $data['Programmetype_list'] = $this->Programmetype_model->get();
                $data['batch_group']    =   $this->Batchtype_model->get_batchgroup();
                $data['semester_term']       = $this->Set_duration_model->get_semester_term(); 


                // required selects
                $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('semester_term', 'Semester Term', 'trim|required|xss_clean');
                $this->form_validation->set_rules('batch_semtype', 'Batch Group', 'trim|required|xss_clean');

                // required dates + ordering callback
                $this->form_validation->set_rules('from_semdate', $this->lang->line('from'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('to_semdate', $this->lang->line('to'), 'trim|required|xss_clean');

                // required numeric fields (you marked with *)
                $this->form_validation->set_rules('workingdays', 'Working Days', 'trim|required|integer|greater_than_equal_to[0]|xss_clean');
                $this->form_validation->set_rules('learningdays', 'Learning Days', 'trim|required|integer|greater_than_equal_to[0]|xss_clean');
                $this->form_validation->set_rules('holidays', 'Holidays', 'trim|required|integer|greater_than_equal_to[0]|xss_clean');
                $this->form_validation->set_rules('classleave', 'Class Leave', 'trim|required|integer|greater_than_equal_to[0]|xss_clean');
                $this->form_validation->set_rules('leavestaff', 'Leave Staff', 'trim|required|integer|greater_than_equal_to[0]|xss_clean');
                $this->form_validation->set_rules('leavestudent', 'Leave Student', 'trim|required|integer|greater_than_equal_to[0]|xss_clean');
                if ($this->form_validation->run() == false)
                {
                } 
                else 
                {  

                if($id=="")
                {                    

                $data                      = array(
                'bchtyp_id'                => $this->input->post('batch_semtype'),
                'semtyp_id'                => $this->input->post('semester_semtype'),                
                'semterm_id'                => $this->input->post('semester_term'),              
                // 'bchsem_count'                => $this->input->post('semester_no'),
                'bchsem_from'              => $this->input->post('from_semdate'),
                'bchsem_to'                => $this->input->post('to_semdate'),                      
                // 'bchsem_capacity'          => $this->input->post('capacity'),                     
                'bchsem_createddate'        => date('Y-m-d H:i:s'),
                'bchsem_workingdays'        =>  $this->input->post('workingdays'),    
                'bchsem_learningdays'       =>  $this->input->post('learningdays'), 
                'bchsem_holidays'           =>  $this->input->post('holidays'),
                'bchsem_classleave'         =>  $this->input->post('classleave'), 
                'bchsem_leavestaff'         =>  $this->input->post('leavestaff'),   
                'bchsem_leavestudent'       =>  $this->input->post('leavestudent')
                );
                $this->set_semesterDuration_model->add($data);                
                }

                else
                {               

                $data                     =  array(
                'bchsem_id'                => $id,      
                'bchtyp_id'                => $this->input->post('batch_semtype'),
                'semtyp_id'                => $this->input->post('semester_semtype'), 
                'semterm_id'                => $this->input->post('semester_term'), 
                // 'bchsem_count'             => $this->input->post('semester_no'),
                'bchsem_from'              => $this->input->post('from_semdate'),
                'bchsem_to'                => $this->input->post('to_semdate'),                      
                // 'bchsem_capacity'          => $this->input->post('capacity'),                     
                'bchsem_createddate'       => date('Y-m-d H:i:s'),         
                'bchsem_workingdays'       =>  $this->input->post('workingdays'),    
                'bchsem_learningdays'       =>  $this->input->post('learningdays'), 
                'bchsem_holidays'       =>  $this->input->post('holidays'),
                'bchsem_classleave'       =>  $this->input->post('classleave'), 
                'bchsem_leavestaff'       =>  $this->input->post('leavestaff'),   
                'bchsem_leavestudent'       =>  $this->input->post('leavestudent'));                  
                $this->set_semesterDuration_model->add($data);  
                }


                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('semester/Setduration/index');
                }
                $this->load->view('layout/header', $data);
                $this->load->view('semester/tab', $data);
                // $this->load->view('semester/prog_setduration/add_data', $data);
                $this->load->view('layout/footer', $data);
                } 



                public function get_semduration_by_id($id)
                {
                $Data = $this->set_semesterDuration_model->get($id);
                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }               



                public function delete($id)
                {
                if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                access_denied();
                }
                $data['title']       = 'Semester Duration Details';
                $this->set_semesterDuration_model->remove($id);
                redirect($_SERVER['HTTP_REFERER']);
                }



                public function update_status()
                {
                $id              = $this->input->post('id');
                $status          = $this->input->post('status');
                $data            = array(
                'bchsem_status' => $status);
                $this->db->where('bchsem_id', $id);
                if ($this->db->update('batch_semester', $data)) {
                echo json_encode(array('status' => 'success'));
                } else {
                echo json_encode(array('status' => 'error'));
                }
                }



                public function check_semester_code_exists($semester_code)
                {
                if ($this->Semester_model->semester_code_exists($semester_code))
                {
                $this->form_validation->set_message('check_semester_code_exists', 'The {field} already exists.');
                return FALSE;
                } else {
                return TRUE;
                }
                }


                public function check_semester_name_exists($semester_name)
                {
                if ($this->Semester_model->semester_name_exists($semester_name))
                {
                $this->form_validation->set_message('check_semester_name_exists', 'The {field} already exists.');
                return FALSE;
                } else {
                return TRUE;
                }
                }
                }
