                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }                   


                class Set_seatingarrangement extends Admin_Controller
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

                $table                      =   "building_block";                   
                $data['get_building']       =   $this->Room_allocation_model->list_result($table);                     

                $floor_table                =   "floor";                
                $data['get_floor']          =   $this->Room_allocation_model->list_result($floor_table);          

                $roomtype_table             =   "room_type";                
                $data['get_roomtype']       =   $this->Room_allocation_model->list_result($roomtype_table);


                $classroom_types_table      =   "classroom_types";                
                $data['get_classroomtypes'] =   $this->Room_allocation_model->list_result($classroom_types_table);

                $data['Programmetype_list'] =   $this->Programmetype_model->get();
                $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
                $data['semestertype_list']  =   $this->Semestertype_model->getdata();
                
                $data['semester_term']      =   $this->Set_duration_model->get_semester_term(); 

                $build_condition            =  array('build_status'=>1); 
                $floor_condition            =  array('floor_status'=>1); 
                $roomtype_condition         =  array('roomtype_status'=>1); 
                $class_condition            =  array('cls_roomtype_status'=>1);          

               
                $data['buildinglist']       =  $this->Room_allocation_model->list_result_condition($table,$build_condition);
        
              
                $data['floorlist']          =  $this->Room_allocation_model->list_result_condition($floor_table,$floor_condition);
                
      
                $data['roomtypelist']       =  $this->Room_allocation_model->list_result_condition($roomtype_table,$roomtype_condition);
                
 
                $data['classlist']          =  $this->Room_allocation_model->list_result_condition($classroom_types_table,$class_condition);
                                
                $data['get_capacity_list']  = $this->Room_allocation_model->get_capacity_list();

                $sem_group_id                 = $this->input->post('sem_group_id');
                // $batch_group             = $this->input->post('batch_group');
                // $semester_semtype        = $this->input->post('semester_semtype'); 
                // $semester_term           = $this->input->post('semester_term');
                

                 $room_id                 = $this->input->post('seat_select');
            


              //  $data['get_room_capacity']  = $this->Room_allocation_model->get_room_capacity($sem_group_id);



                $total_capacity             = $this->input->post('total_capacity'); 
                $data['total_capacity']     = $total_capacity;

                

                $data['get_seat_list']      = $this->Room_allocation_model->get_seat_list();
                $seat_select                 = $this->input->post('seat_select');
                $data['seat_select']         = $seat_select; // expose for set_value restore in view
                $data['subject_id']          = $this->input->post('subjects'); // expose for set_value restore in view

                $data['get_seat_count']      = $this->Room_allocation_model->get_seat_capacity($seat_select);
                           



                    $data['existing_allocations'] = $this->db
                    ->select('studallot_stud_id, studallot_seat_label')
                    ->from('sem_set_seat_allocation_tbl')
                    ->where('studallot_room_id', $room_id)
                    ->where('studallot_sem_group_id', $sem_group_id)
                 
                    ->get()
                    ->result_array();

                    

                $this->form_validation->set_rules('programe', $this->lang->line('programee'), 'trim|required|xss_clean'); 
                
                if ($this->form_validation->run() == false)
                {                                                         

                } 
                else 
                {  
                $program                 = $this->input->post('programe');
                $batch_group             = $this->input->post('batch_group');
                $semester_semtype        = $this->input->post('semester_semtype'); 
                $semester_term           = $this->input->post('semester_term');

                $this->db->where('sem_group_program', $program);
                $this->db->where('sem_group_batchgroup', $batch_group);               
                $this->db->where('sem_group_semester', $semester_semtype);
                $this->db->where('sem_group_semester_term', $semester_term);                
                $query = $this->db->get('semester_group');

                if ($query->num_rows() == 0) 
                {
                $data_to_insert = array(
                'sem_group_batchgroup'   => $batch_group,
                'sem_group_program'      => $program,
                'sem_group_semester'     => $semester_semtype,
                'sem_group_semester_term'=> $semester_term,                
                'sem_group_createddate'  => date('Y-m-d H:i:s')
                );
                $this->db->insert('semester_group', $data_to_insert);
                $sem_group_id           = $this->db->insert_id();
                } 
                else 
                {
                $row                    = $query->row();
                $sem_group_id           = $row->sem_group_id;
                }

                $data['students']        = $this->Room_allocation_model->get_students($sem_group_id); 
                $data['get_total_count'] = $this->Room_allocation_model->get_studentscount($sem_group_id);  
                }  
                $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/arrangeseat', $data);                 
                $this->load->view('layout/footer', $data);
                }  
            

                
                


                public function save_seat_allocation001() 
                {
                $data = json_decode(file_get_contents('php://input'), true);
                $allocations = $data['allocations'];
                $room_id = $data['room_id'];
                $sem_group_id = $data['sem_group_id'];
                $subject_id = $data['subject_id'];
                $term_id = $data['term_id'];

                if (empty($allocations)) {
                echo json_encode(['status' => 'error', 'message' => 'No data received']);
                return;
                }

                foreach ($allocations as $stud_id => $seat_label) {
                $insertData = [
                'studallot_stud_id' => $stud_id,
                'studallot_room_id' => $room_id,
                'studallot_sem_group_id' => $sem_group_id,
                'studallot_seat_label' => $seat_label,
                'studallot_subject_id' => $subject_id,
                'studallot_term_id' => $term_id,
                'studallot_allocated_date' => date('Y-m-d H:i:s'),
                'studallot_created_by' => $this->session->userdata('admin_id'),
                ];

                $this->db->insert('sem_set_seat_allocation_tbl', $insertData);
                }

                echo json_encode(['status' => 'success']);
                }




                    public function save_seat_allocation()
                    {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $allocations = $data['allocations'];
                    $room_id = $data['room_id'];
                    $sem_group_id = $data['sem_group_id'];
                    $subject_id = $data['subject_id'];
                    $term_id = $data['term_id'];

                    if (empty($allocations)) {
                    echo json_encode(['status' => 'error', 'message' => 'No data received']);
                    return;
                    }

                    foreach ($allocations as $stud_id => $seat_label) {

                    //  Check if record already exists
                    $this->db->where('studallot_stud_id', $stud_id);
                    $this->db->where('studallot_room_id', $room_id);
                    $this->db->where('studallot_sem_group_id', $sem_group_id);
                    $query = $this->db->get('sem_set_seat_allocation_tbl');

                    $existing = $query->row_array();

                    $updateData = [
                    'studallot_seat_label' => $seat_label,
                    'studallot_subject_id' => $subject_id,
                    'studallot_term_id' => $term_id,
                    'studallot_allocated_date' => date('Y-m-d H:i:s'),
                    'studallot_created_by' => $this->session->userdata('admin_id'),
                    ];

                    if ($existing) {
                    //  Update existing record
                    $this->db->where('studallot_id', $existing['studallot_id']);
                    $this->db->update('sem_set_seat_allocation_tbl', $updateData);
                    } else {
                    //  Insert new record
                    $insertData = array_merge($updateData, [
                    'studallot_stud_id' => $stud_id,
                    'studallot_room_id' => $room_id,
                    'studallot_sem_group_id' => $sem_group_id
                    ]);
                    $this->db->insert('sem_set_seat_allocation_tbl', $insertData);
                    }
                    }

                    echo json_encode(['status' => 'success']);
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


                
      
                
                public function get_students()
                {           
                $program         = $this->input->post('programe');
                $batch_group      = $this->input->post('batch_group');
                $semester_semtype = $this->input->post('semester_semtype'); 
                $semester_term    = $this->input->post('semester_term'); 


                $this->db->where('sem_group_program', $program);
                $this->db->where('sem_group_batchgroup', $batch_group);               
                $this->db->where('sem_group_semester', $semester_semtype);
                $this->db->where('sem_group_semester_term', $semester_term);                
                $query = $this->db->get('semester_group');  


                if ($query->num_rows() == 0) 
                {
                $data_to_insert = array(
                'sem_group_batchgroup'   => $batch_group,
                'sem_group_program'      => $program,
                'sem_group_semester'     => $semester_semtype,
                'sem_group_semester_term'=> $semester_term,                
                'sem_group_createddate'  => date('Y-m-d H:i:s')
                );
                $this->db->insert('semester_group', $data_to_insert);
                $sem_group_id = $this->db->insert_id();
                } 
                else 
                {
                $row          = $query->row();
                $sem_group_id = $row->sem_group_id;
                }

                $data['students'] = $this->Room_allocation_model->get_students($sem_group_id); 
                // echo json_encode($data); 
                // redirect($_SERVER['HTTP_REFERER']);

                      $this->load->view('layout/header', $data);
                $this->load->view('semester/room_allocation/arrangeseat', $data);                 
                $this->load->view('layout/footer', $data);
                }   




                public function get_assigned_subjects()
                {
                $sem_group_id         = $this->input->post('sem_group_id');
                $data = $this->Room_allocation_model->get_subjects($sem_group_id); 
                echo json_encode($data);
                }

                


                  public function saveAllocation() {
                  $student_ids = $this->input->post('student_ids'); // Array of IDs
                  if(!$student_ids) {
                  echo json_encode(['status'=>'error', 'msg'=>$_POST]);
                  return;
                  }
                  foreach($student_ids as $id) {
                  $data = [
                  'studallot_stud_id' => $id,
                  'studallot_allocated_date' => date('Y-m-d H:i:s')
                  ];
                  $this->db->insert('student_allocation_tbl', $data);
                  }

                  echo json_encode(['status'=>'success']);
                  } 

                }
