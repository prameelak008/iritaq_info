                    <?php
                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }
                    
                    class Classroom extends Admin_Controller
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
                    if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                    access_denied();
                    }
                    
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'classroom/index');
                    
                    $data['title']      = 'Add classroom';
                    $data['title_list'] = 'Class Room';
                    $this->form_validation->set_rules('room_number', $this->lang->line('room_number'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('building_block', $this->lang->line('building_block'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('floor', $this->lang->line('floor'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('type', $this->lang->line('type'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('capacity', $this->lang->line('capacity'), 'trim|required|xss_clean');
                    $clsid          =   $this->input->post('clsid');
                  
                    if ($this->form_validation->run() == false) 
                    {
                    } 
                    else 
                    {
                    if($clsid!="")
                    {
                     $data                 = array(
                    'id'                  => $clsid,     
                    'cl_room_number'      => $this->input->post('room_number'),
                    'cl_building_block'   => $this->input->post('building_block'),
                    'cl_floor'            => $this->input->post('floor'),
                    'cl_type'             => $this->input->post('type'),
                    'cl_capacity'         => $this->input->post('capacity'),
                    'cl_createddate'      => date('Y-m-d H:i:s'),
                    'cl_session'          => $this->current_session);
                    $this->Classroom_model->add($data);
                    }
                    else
                    {
                    $data                 = array(
                    'cl_room_number'      => $this->input->post('room_number'),
                    'cl_building_block'   => $this->input->post('building_block'),
                    'cl_floor'            => $this->input->post('floor'),
                    'cl_type'             => $this->input->post('type'),
                    'cl_capacity'         => $this->input->post('capacity'),
                    'cl_createddate'      => date('Y-m-d H:i:s'),
                    'cl_session'          => $this->current_session);
                    $this->Classroom_model->add($data);
                    }
                    
                    
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/Classroom/index');
                    }
                    
                    $data['classroomlist']            =   $this->Classroom_model->get();
                    $data['buildingblock']            =   $this->Classroom_model->get_buildingblock();
                    $data['buildingblock_bystatus']   =   $this->Classroom_model->get_buildingblock_bystatus();
                    $data['floor_bystatus']           =   $this->Classroom_model->get_floor_bystatus();
                    $data['class_type']               =   $this->Classroom_model->get_type();
                    $data['type_bystatus']            =   $this->Classroom_model->get_type_bystatus();
                    
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/classroom/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
                    
                    
                    //BuildingBlock
                    
                    public function add_buildingblock() 
                    {
                    $this->form_validation->set_rules('block_name', $this->lang->line('block_name'), 'trim|required|xss_clean');
                    
                    if ($this->form_validation->run() == false) {
                    $errors = array(
                    'block_name' => form_error('block_name')
                    );
                    $array = array('status' => 'fail', 'error' => $errors, 'message' => '');    
                    } else {
                    $data = array(
                    'block_name' => $this->input->post('block_name'),
                    'description'=> $this->input->post('description')
                    );
                    $this->Classroom_model->add_buildingblock($data);
                    $msg = $this->lang->line('success_message');
                    $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                    }
                    echo json_encode($array);
                    }
                    
                    
                    
                    public function edit_block()
                    {
                    $block_id              = $this->input->post('block_id');
                    $block_name            = $this->input->post('block_name');
                    $description           = $this->input->post('block_description');
                    $data                  = array('block_name' => $block_name,
                    'description'          => $description);
                    $this->db->where('id', $block_id);
                    if ($this->db->update('building_block', $data))
                    {
                    $msg = $this->lang->line('success_message');
                    $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                    } 
                    else
                    {
                    $array = array('status' => 'fail', 'error' => $errors, 'message' => '');    
                    }
                    echo json_encode($array);
                    }
                    
                    
                    public function update_status()
                    {
                    $id              = $this->input->post('id');
                    $status          = $this->input->post('status');
                    $data            = array('status' => $status);
                    $this->db->where('id', $id);
                    if ($this->db->update('building_block', $data))
                    {
                    echo json_encode(array('status' => 'success'));
                    } 
                    else
                    {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
                    
                    
                    
                    
                    
                    ///// floor
                    
                    
                    
                    
                    public function add_floor() 
                    {
                    $this->form_validation->set_rules('floor_name', $this->lang->line('floor_name'), 'trim|required|xss_clean');
                    
                    if ($this->form_validation->run() == false) {
                    $errors = array(
                    'floor_name' => form_error('floor_name')
                    );
                    $array = array('status' => 'fail', 'error' => $errors, 'message' => '');    
                    } else {
                    $data = array(
                    'floor_name' => $this->input->post('floor_name'),
                    'description'=> $this->input->post('description')
                    );
                    $this->Classroom_model->add_floor($data);
                    $msg = $this->lang->line('success_message');
                    $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                    }
                    echo json_encode($array);
                    }
                    
                    
                    public function add_clstype() 
                    {
                    $this->form_validation->set_rules('classroom_type', $this->lang->line('classroom_type'), 'trim|required|xss_clean');
                    
                    if ($this->form_validation->run() == false) {
                    $errors = array(
                    'classroom_type' => form_error('classroom_type')
                    );
                    $array = array('status' => 'fail', 'error' => $errors, 'message' => '');    
                    } else {
                    $data = array(
                    'cls_name' => $this->input->post('classroom_type'),
                    'cls_description'=> $this->input->post('description')
                    );
                    $this->Classroom_model->add_clstype($data);
                    $msg = $this->lang->line('success_message');
                    $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                    }
                    echo json_encode($array);
                    }
                    
                    
                    
                    public function update_statusClss()
                    {
                    $id              = $this->input->post('id');
                    $status          = $this->input->post('status');
                    $data            = array('cl_status' => $status);
                    $this->db->where('cl_id', $id);
                    if ($this->db->update('classroom', $data))
                    {
                    echo json_encode(array('status' => 'success'));
                    } 
                    else
                    {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
                    
                    
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    access_denied();
                    }
                    $data['title']       = 'Class Room Details';
                    $this->Classroom_model->remove($id);
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    
                    
                    
                    public function get_data($id)
                    {
                    $getData     = $this->Classroom_model->get_Clssdata($id);
                    if($getData) {
                    echo json_encode($getData);
                    } 
                    else
                    {
                    echo json_encode(array('error'=>'Failed'));
                    }  
                    }
                    
                    }
