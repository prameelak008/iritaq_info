                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }                   


                class Set_room_allocation extends Admin_Controller
                {

                public function __construct()
                {
                parent::__construct();
                $this->load->helper('form');
                $this->config->load('app-config');
                $this->load->library("datatables");
                $this->current_session = $this->setting_model->getCurrentSession(); 
                }  


                public function index()
                {
                                            
                // if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                // access_denied();
                // }

                $this->session->set_userdata('top_menu', 'semester'); 
                $this->session->set_userdata('sub_menu', 'set_room_allocation/index');

                $data['title']              = 'Room Allocation';
                $data['title_list']         = 'Set Room Allocation';
                $id                         =  $this->input->post('building_id');                    
                $building_name              =  $this->input->post('building_name');    

                $table                      =  "building_block";                   
                $data['get_building']       =  $this->Room_allocation_model->list_result($table);                     

                $floor_table                =  "floor";                
                $data['get_floor']          =  $this->Room_allocation_model->list_result($floor_table);          

                $roomtype_table             =  "room_type";                
                $data['get_roomtype']       =  $this->Room_allocation_model->list_result($roomtype_table);


                $classroom_types_table      =  "classroom_types";                
                $data['get_classroomtypes'] =  $this->Room_allocation_model->list_result($classroom_types_table);

                $build_condition            =  array('build_status'=>1); 
                $floor_condition            =  array('floor_status'=>1); 
                $roomtype_condition         =  array('roomtype_status'=>1); 
                $class_condition            =  array('cls_roomtype_status'=>1);            

               
                $data['buildinglist']       =  $this->Room_allocation_model->list_result_condition($table,$build_condition);
        
              
                $data['floorlist']          =  $this->Room_allocation_model->list_result_condition($floor_table,$floor_condition);
                
      
                $data['roomtypelist']       =  $this->Room_allocation_model->list_result_condition($roomtype_table,$roomtype_condition);
                
 
                $data['classlist']          =  $this->Room_allocation_model->list_result_condition($classroom_types_table,$class_condition);
                
                
                
                $data['get_capacity_list']  =  $this->Room_allocation_model->get_capacity_list();

                $this->form_validation->set_rules('building_name', $this->lang->line('building'), 'trim|required|xss_clean');   
                if ($this->form_validation->run() == false)
                {                                                         

                } 
                else 
                {
                if($id=="")
                {
                $data                   =  array(                  
                'build_name'            => $this->input->post('building_name'),
                'build_description'     => $this->input->post('building_description'),                                    
                'build_createddate'     => date('Y-m-d H:i:s'));
                $this->Room_allocation_model->add_buildingblock($data);
                }
                else
                {                      
                $data                  =  array(
                'build_id'              => $id,      
                'build_name'            => $this->input->post('building_name'),
                'build_description'     => $this->input->post('building_description'),                    
                'build_updateddate'     => date('Y-m-d H:i:s'));
                $this->Room_allocation_model->add_buildingblock($data);
                 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                } 
               
                // redirect('semester/Setduration/index');
                redirect($_SERVER['HTTP_REFERER']);
                }                              

                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/tab', $data);                 
                $this->load->view('layout/footer', $data);
                }






                public function set_capacitytype()
                {                        
                // if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                // access_denied();
                // }
                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'set_room_allocation/index');

                $data['title']         = 'Set Class Room';
                $data['title_list']    = 'Class Room';

                $id                    =  $this->input->post('classroom_type_id');
                $classroom_type_name   =  $this->input->post('classroom_type_name'); 
                $table                 =  "classroom_types";               

                $this->form_validation->set_rules('classroom_type_name', $this->lang->line('class'), 'trim|required|xss_clean');   
                if ($this->form_validation->run() == false)
                {                                              

                } 
                else 
                {                      

                if ($id == "") 
                {
                // Insert new floor
                $data                          =  array( 
                'cls_roomtype_name'            => $this->input->post('classroom_type_name'),
                'cls_roomtype_description'     => $this->input->post('classroom_type_description'),               
                'cls_roomtype_createddate'     => date('Y-m-d H:i:s') );
                $this->Room_allocation_model->insert_value($table, $data);
                } 
                else
                {
                $data                          =  array( 
                'cls_roomtype_name'            => $this->input->post('classroom_type_name'),
                'cls_roomtype_description'     => $this->input->post('classroom_type_description'),               
                'cls_roomtype_createddate'     => date('Y-m-d H:i:s') );
                $condition = array('cls_roomtype_id' => $id);

                $this->Room_allocation_model->update_value($table, $data, $condition);
                }                    

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');

                redirect($_SERVER['HTTP_REFERER']);
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/tab', $data);                 
                $this->load->view('layout/footer', $data);
                }

                public function delete_building($id)
                {
                // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                // access_denied();
                // }
                // $data['title']       = 'Building Block';
                // $tab                 = "building_block";
                // $condition           =  array('build_id'=>$id);

                // $this->Room_allocation_model->delete_data($tab,$condition);
                // redirect($_SERVER['HTTP_REFERER']);


                header('Content-Type: application/json'); // tell browser this is JSON

                $tab                 = "building_block";
                $condition           =  array('build_id'=>$id);
                $deleted             = $this->Room_allocation_model->delete_data($tab, $condition);
                echo json_encode(['success' => (bool)$deleted]); // return JSON
                exit; 
                } 


                public function delete_capacity($id)
                {
                // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                // access_denied();
                // }
                // $data['title']       = 'Room Allocation';
                // $tab                 = "Classroom_capacity";
                // $condition           =  array('cl_cap_id'=>$id);
                // $this->Room_allocation_model->delete_data($tab,$condition);
                // redirect($_SERVER['HTTP_REFERER']);


                header('Content-Type: application/json'); // tell browser this is JSON

                $tab                 = "Classroom_capacity";
                $condition           =  array('cl_cap_id'=>$id);
                $deleted             = $this->Room_allocation_model->delete_data($tab, $condition);
                echo json_encode(['success' => (bool)$deleted]); // return JSON
                exit; 
                } 



                public function delete_classtype($id)
                {
                // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                // access_denied();
                // }
                // $data['title']       = 'Class Type';
                // $tab                 = "classroom_types";
                // $condition           =  array('cls_roomtype_id'=>$id);                    
                // $this->Room_allocation_model->delete_data($tab,$condition);
                // redirect($_SERVER['HTTP_REFERER']);


                header('Content-Type: application/json'); // tell browser this is JSON

                $tab                 = "classroom_types";
                $condition           =  array('cls_roomtype_id'=>$id); 
                $deleted             = $this->Room_allocation_model->delete_data($tab, $condition);
                echo json_encode(['success' => (bool)$deleted]); // return JSON
                exit; 
                }




                // public function delete_floor($id)
                // {
                // // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                // // access_denied();
                // // }
                // header('Content-Type: application/json'); // ensure JSON header
                
                // $data['title']       = 'Floor';
                // $tab                 = "floor";
                // $condition           =  array('floor_id'=>$id);
                // $this->Room_allocation_model->delete_data($tab,$condition);
                // redirect($_SERVER['HTTP_REFERER']);
              
                // }




                public function delete_floor($id)
                {
                header('Content-Type: application/json'); // tell browser this is JSON

                $tab        = "floor";
                $condition  = array('floor_id' => $id);
                $deleted    = $this->Room_allocation_model->delete_data($tab, $condition);

                echo json_encode(['success' => (bool)$deleted]); // return JSON
                exit; // stop further output
                }



                public function update_status()
                {
                $id              = $this->input->post('Id');
                $status          = $this->input->post('status');
                $data            = array('build_status' => $status);
                $this->db->where('build_id', $id);
                if ($this->db->update('building_block', $data))
                {
                echo json_encode(array('status' => 'success'));
                } 
                else
                {
                echo json_encode(array('status' => 'error'));
                }
                }                    


                public function update_status_capacity()
                {
                $id              = $this->input->post('Id');
                $status          = $this->input->post('status');
                $data            = array('cl_cap_status' => $status);
                $this->db->where('cl_cap_id', $id);
                if ($this->db->update('classroom_capacity', $data))
                {
                echo json_encode(array('status' => 'success'));
                } 
                else
                {
                echo json_encode(array('status' => 'error'));
                }
                } 

                public function get_building_byid($id)
                {
                $table      = "building_block";
                $condition  = array('build_id'=>$id);
                $Data       = $this->Room_allocation_model->list_row_condition($table,$condition);
                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }               



                public function get_capacity_byid($id)
                {
                //     $table      = "classroom_capacity";
                //     $condition  = array('cl_cap_id'=>$id);


                $Data       = $this->Room_allocation_model->get_capacity_list($id);
                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }  

                public function set_floor()
                {                        
                // if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                // access_denied();
                // }
                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'Set_room_allocation/index');

                $data['title']      = 'Room Allocation';
                $data['title_list'] = 'Set Room Allocation';
                $id                 =  $this->input->post('floor_id');
                $floor_name         =  $this->input->post('floor_name'); 

                $table              =  "floor";
                // $condition          =  array('floor_status'=>1);

                // $data['get_floor']  = $this->Room_allocation_model->list_result_condition($table,$condition);


                $this->form_validation->set_rules('floor_name', $this->lang->line('floor'), 'trim|required|xss_clean');   
                if ($this->form_validation->run() == false)
                {                                              

                } 
                else 
                {  

                if ($id == "") {
                // Insert new floor
                $data                   =  array(                  
                'floor_name'            => $this->input->post('floor_name'),
                'floor_description'     => $this->input->post('floor_description'),                                    
                'floor_createddate'     => date('Y-m-d H:i:s'));
                $this->Room_allocation_model->insert_value($table, $data);
                }
                else
                { 
                $data                   =  array(                     
                'floor_name'            => $this->input->post('floor_name'),
                'floor_description'     => $this->input->post('floor_description'),                    
                'floor_updateddate'     => date('Y-m-d H:i:s'));
                $condition = array('floor_id' => $id);
                $this->Room_allocation_model->update_value($table, $data, $condition);
                }                    

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');

                redirect($_SERVER['HTTP_REFERER']);
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/tab', $data);                 
                $this->load->view('layout/footer', $data);
                }



                public function update_status_floor()
                {
                $id              = $this->input->post('Id');
                $status          = $this->input->post('status');
                $data            = array('floor_status' => $status);
                $this->db->where('floor_id', $id);
                if ($this->db->update('floor', $data))
                {
                echo json_encode(array('status' => 'success'));
                } 
                else
                {
                echo json_encode(array('status' => 'error'));
                }
                }


                public function get_floor_byid($id)
                {
                $table      = "floor";
                $condition  = array('floor_id'=>$id);
                $Data       = $this->Room_allocation_model->list_row_condition($table,$condition);
                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }


                ////////................................Room Type......................................


                public function set_roomtype()
                {                        
                // if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                // access_denied();
                // }


                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'Set_room_allocation/index');

                $data['title']         = 'Room Allocation';
                $data['title_list']    = 'Set Room Type';

                $id                    =  $this->input->post('roomtype_id');
                $roomtype_name         =  $this->input->post('roomtype_name'); 

                $table                 =  "room_type";
                // $condition             =  array('roomtype_status'=>1);

                // $data['get_roomtype']  = $this->Room_allocation_model->list_result_condition($table,$condition);


                $this->form_validation->set_rules('roomtype_name', $this->lang->line('room_type'), 'trim|required|xss_clean');   
                if ($this->form_validation->run() == false)
                {                                              

                } 
                else 
                {  

                if ($id == "") {
                // Insert new floor
                $data                   =  array(                  
                'roomtype_name'            => $this->input->post('roomtype_name'),
                'roomtype_description'     => $this->input->post('roomtype_description'),                                    
                'roomtype_createddate'     => date('Y-m-d H:i:s'));
                $this->Room_allocation_model->insert_value($table, $data);
                } else { 
                $data                   =  array(                     
                'roomtype_name'            => $this->input->post('roomtype_name'),
                'roomtype_description'     => $this->input->post('roomtype_description'),                    
                'roomtype_createddate'     => date('Y-m-d H:i:s'));
                $condition = array('roomtype_id' => $id);
                $this->Room_allocation_model->update_value($table, $data, $condition);
                }                    

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');

                redirect($_SERVER['HTTP_REFERER']);
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/tab', $data);                 
                $this->load->view('layout/footer', $data);
                }




                public function update_status_roomtype()
                {
                $id              = $this->input->post('Id');
                $status          = $this->input->post('status');
                $data            = array('roomtype_status' => $status);
                $this->db->where('roomtype_id', $id);
                if ($this->db->update('roomtype', $data))
                {
                echo json_encode(array('status' => 'success'));
                } 
                else
                {
                echo json_encode(array('status' => 'error'));
                }
                }



                public function get_roomtype_byid($id)
                {
                $table      = "room_type";
                $condition  = array('roomtype_id'=>$id);
                $Data       = $this->Room_allocation_model->list_row_condition($table,$condition);
                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }


                public function delete_roomtype($id)
                {
                header('Content-Type: application/json'); // tell browser this is JSON

                $data['title']       = 'Room Type';
                $tab                 = "room_type";
                $condition           =  array('roomtype_id'=>$id);
                $deleted    = $this->Room_allocation_model->delete_data($tab, $condition);

                echo json_encode(['success' => (bool)$deleted]); // return JSON
                exit; // stop further output
                
                }

                ////// class Room.........................................................

                public function set_class_roomtype()
                {                        
                // if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                // access_denied();
                // }

                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'Set_room_allocation/index');

                $data['title']              = 'Set Room Allocation';
                $data['title_list']         = 'Set Class Room Type';

                $id                         =  $this->input->post('classroom_type_id');
                $cls_roomtype_name          =  $this->input->post('classroom_type_name'); 
                $cls_roomtype_description   =  $this->input->post('classroom_type_description');

                $table                      =  "classroom_types";
                $this->form_validation->set_rules('classroom_type_name', $this->lang->line('class'), 'trim|required|xss_clean'); 

                if ($this->form_validation->run() == false)
                {                                              

                } 
                else 
                {  

                if ($id == "")
                {                 
                $data                          =  array(                  
                'cls_roomtype_name'            => $this->input->post('classroom_type_name'),
                'cls_roomtype_description'     => $this->input->post('classroom_type_description'),                                    
                'cls_roomtype_createddate'     => date('Y-m-d H:i:s'));
                $this->Room_allocation_model->insert_value($table, $data);
                } 
                else
                { 
                $data                          =  array(                     
                'cls_roomtype_name'            => $this->input->post('classroom_type_name'),
                'cls_roomtype_description'     => $this->input->post('classroom_type_description'),                    
                'cls_roomtype_updateddate'     => date('Y-m-d H:i:s'));
                $condition = array('cls_roomtype_id' => $id);
                $this->Room_allocation_model->update_value($table, $data, $condition);
                }                    

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');

                redirect($_SERVER['HTTP_REFERER']);
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/tab', $data);                 
                $this->load->view('layout/footer', $data);
                }


                public function update_status_classtype()
                {
                $id              = $this->input->post('Id');
                $status          = $this->input->post('status');
                $data            = array('cls_roomtype_status' => $status);
                $this->db->where('cls_roomtype_id', $id);
                if ($this->db->update('classroom_types', $data))
                {
                echo json_encode(array('status' => 'success'));
                } 
                else
                {
                echo json_encode(array('status' => 'error'));
                }
                }

                public function get_classtype_byid($id)
                {
                $table      = "classroom_types";
                $condition  = array('cls_roomtype_id'=>$id);
                $Data       = $this->Room_allocation_model->list_row_condition($table,$condition);
                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }

                public function get_data($durationid)
                {
                $duraData = $this->Set_duration_model->getDuartionbyId($durationid);
                if($duraData) {
                echo json_encode($duraData);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                }  
                }



                public function add_data()
                {
                $this->form_validation->set_rules('programee_category', $this->lang->line('programee_category'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('date_from', $this->lang->line('date_from'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('date_to', $this->lang->line('date_to'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('No_of_Semester', $this->lang->line('No_of_Semester'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('No_of_Months', $this->lang->line('No_of_Months'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('No_of_Days', $this->lang->line('No_of_Days'), 'trim|required|xss_clean');

                $programme_id           = $this->input->post('programme_id');

                if ($this->form_validation->run() == false)
                {
                $array = array('status' => 'fail', 'error' => $msg, 'message' => '');    
                } 
                else 
                { 

                if($programme_id=="")
                {
                $data                   =  array(
                'programee_id'          => $this->input->post('programee_category'),
                'date_from'             => $this->input->post('date_from'),
                'date_to'               => $this->input->post('date_to'),
                'no_of_semester'        => $this->input->post('No_of_Semester'),
                'no_of_months'          => $this->input->post('No_of_Months'),
                'no_of_days'            => $this->input->post('No_of_Days'),
                'createddate'           => date('Y-m-d H:i:s'),
                'session'               => $this->current_session
                );
                $this->Set_duration_model->add($data);
                }
                else
                {
                $data                   =  array(
                'programee_id'          => $this->input->post('programee_category'),
                'date_from'             => $this->input->post('date_from'),
                'date_to'               => $this->input->post('date_to'),
                'no_of_semester'        => $this->input->post('No_of_Semester'),
                'no_of_months'          => $this->input->post('No_of_Months'),
                'no_of_days'            => $this->input->post('No_of_Days'),
                'updateddate'           => date('Y-m-d H:i:s'),
                'session'               => $this->current_session );
                $this->db->where(array('id'=>$programme_id));
                $this->db->update('set_duration', $data);  
                }  
                $msg   = $this->lang->line('success_message');
                $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                }
                echo json_encode($array);
                }                  



                public function get_duration_by_id($id)
                {
                $Data = $this->Set_duration_model->getDuartionbyId($id);

                if($Data) {
                echo json_encode($Data);
                } 
                else
                {
                echo json_encode(array('error'=>'Failed'));
                } 
                }


                public function set_class_capacity()
                {                    
                // if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                // access_denied();
                // }
                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'Set_room_allocation/index');

                $data['title']         = 'Room Allocation';
                $data['title_list']    = 'Set Room Type';

                $id                    =  $this->input->post('cl_cap_id');
                $cl_cap_room_number    =  $this->input->post('cl_cap_room_number'); 
                $table                 =  "classroom_capacity";

                $this->form_validation->set_rules('cl_cap_room_number', $this->lang->line('room_type'), 'trim|required|xss_clean');   
                if ($this->form_validation->run() == false)
                {                                              

                } 
                else 
                {                        

                if ($id == "") {
                // Insert new floor
                $data                      =  array(                         
                'cl_cap_room_number'       => $this->input->post('cl_cap_room_number'),
                'cl_cap_building_id'       => $this->input->post('cl_cap_building'),
                'cl_cap_floor_id'          => $this->input->post('cl_cap_floor'),
                'cl_cap_classroom_type_id' => $this->input->post('cl_cap_classroom_type'),
                'cl_cap_roomtype_id'       => $this->input->post('cl_cap_roomtype'),
                'cl_cap_capacity'          => $this->input->post('cl_cap_capacity'),
                'cl_cap_description'       => $this->input->post('cl_cap_description'), 
                'cl_cap_createddate'       => date('Y-m-d H:i:s') );
                $this->Room_allocation_model->insert_value($table, $data);
                } 
                else
                {

                $data                     =  array(                     
                'cl_cap_room_number'      => $this->input->post('cl_cap_room_number'),
                'cl_cap_building_id'      => $this->input->post('cl_cap_building'),
                'cl_cap_floor_id'         => $this->input->post('cl_cap_floor'),
                'cl_cap_classroom_type_id'=> $this->input->post('cl_cap_classroom_type'),
                'cl_cap_roomtype_id'      => $this->input->post('cl_cap_roomtype'),
                'cl_cap_capacity'         => $this->input->post('cl_cap_capacity'),
                'cl_cap_description'      => $this->input->post('cl_cap_description'), 
                'cl_cap_createddate'      => date('Y-m-d H:i:s'));
                $condition = array('cl_cap_id' => $id);

                $this->Room_allocation_model->update_value($table, $data, $condition);
                }                    

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');

                redirect($_SERVER['HTTP_REFERER']);
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/tab', $data);                 
                $this->load->view('layout/footer', $data);
                }



                public function getFloorsByBuilding()
                {
                $building_id   =  $this->input->post('cl_building_id');
                $Data          =  $this->Room_allocation_model->getfloorlist_bybuilding($building_id);
                echo json_encode($Data);

                // if($Data) {
                // echo json_encode($Data);
                // } 
                // else
                // {
                // echo json_encode(array('error'=>'Failed'));
                // } 
                // }

                }


                



                public function getroomnoByFloor()
                {
                $cl_floor_id   =  $this->input->post('cl_floor_id');
                $Data          =  $this->Room_allocation_model->getroomtype_byfloor($cl_floor_id);
                echo json_encode($Data);
                }                



                public function getclasstypeByFloor()
                {
                $cl_floor_id   =  $this->input->post('cl_floor_id');
                $building_bl   =  $this->input->post('building_bl');
                $Data          =  $this->Room_allocation_model->getclastypelist_byfloor($cl_floor_id,$building_bl);
                echo json_encode($Data);
                }                

                public function getroomtypeByclass()
                {
                $cl_clstype             =  $this->input->post('cl_clstype');
                $sethall_cap_building   =  $this->input->post('sethall_cap_building');
                $sethall_build_floor    =  $this->input->post('sethall_build_floor');               

                $Data                   =  $this->Room_allocation_model->getroomtypeByclass($cl_clstype,$sethall_cap_building,$sethall_build_floor);
                echo json_encode($Data);
                }





                public function get_totalcapacity()
                {
                $cl_cap_building   =  $this->input->post('cl_cap_building');
                $cl_room_types   =  $this->input->post('cl_room_types');
                $cl_classroom_types   =  $this->input->post('cl_classroom_types'); 
                $cl_build_floor   =  $this->input->post('cl_build_floor'); 
                $sethall_room_no   =  $this->input->post('sethall_room_no'); 
                $Data          =  $this->Room_allocation_model->get_capacitylist($cl_cap_building,$cl_room_types,$cl_classroom_types,$cl_build_floor,$sethall_room_no);
                echo json_encode($Data); 
                            }




                public function fetchAllRooms()
                {
                $pl_building          =  $this->input->post('pl_building');
                $pl_build_floor       =  $this->input->post('pl_build_floor');
                $pl_classroom_types   =  $this->input->post('pl_classroom_types'); 
                $pl_room_types        =  $this->input->post('pl_room_types');                 
                $Data                 =  $this->Room_allocation_model->fetch_allrooms($pl_building,$pl_build_floor,$pl_classroom_types,$pl_room_types);
                echo json_encode($Data); 
                } 
                                    


                }
