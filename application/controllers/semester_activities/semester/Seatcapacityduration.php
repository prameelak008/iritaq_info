                    <?php
                    
                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }
                    
                    
                    class Seatcapacityduration extends Admin_Controller
                    {
                    public function __construct()
                    {
                    parent::__construct();
                    $this->load->helper('form');
                    $this->config->load('app-config');
                    $this->load->library("datatables");
                    $this->current_session = $this->setting_model->getCurrentSession(); 
                    } 
    

                    public function get_data($id)
                    {
                    $Data = $this->Seatcapacity_model->getseatcapacitybyId($id);
                   
                    if($Data) 
                    {
                    echo json_encode($Data);
                    } 
                    else
                    {
                    echo json_encode(array('error'=>'Failed'));
                    }                     
                    }

                    
                    public function index()
                    {                   
                       
                    if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                    access_denied();
                    }
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'setduration/index');
                    
                    $data['title']         = 'Semester';
                    $data['title_list']    = 'Set Duration'; 
                    $id                    = $this->input->post('seatcapacity_duration'); 
                    $data['facultylist']   = $this->Faculty_model->get();
                    $data['batch_group']   =   $this->Batchtype_model->get_batchgroup();
                    $data['batchlist']      =   $this->Batch_model->batchlist();
                    $data['get_semester_duration'] =   $this->set_semesterDuration_model->get(); 

                    $this->form_validation->set_rules('facultycapacity', $this->lang->line('faculty'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('batch_capacitytype', $this->lang->line('batch'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('se_seatcapacity', $this->lang->line('capacity'), 'trim|required|xss_clean');
                    
                    if ($this->form_validation->run() == false)
                    {
                    } 
                    else 
                    {
                        
                    if($id=="")
                    {                        
                    $data                   =  array(                
                    'faculty'               => $this->input->post('facultycapacity'),
                    'batch'                 => $this->input->post('batch_capacitytype'),
                    'seatcapacity'          => $this->input->post('se_seatcapacity'),                    
                    'createddate'           => date('Y-m-d H:i:s'),
                    'session'               => $this->current_session);
                    $this->Seatcapacity_model->add($data);
                    }
                    else
                    {                         
                     $data                =  array(
                    'id'                  => $id,      
                    'faculty'             => $this->input->post('facultycapacity'),
                    'batch'               => $this->input->post('batch_capacitytype'),
                    'seatcapacity'        => $this->input->post('se_seatcapacity'), 
                    'updateddate'         => date('Y-m-d H:i:s'),
                    'session'             => $this->current_session);
                    $this->Seatcapacity_model->add($data);
                    } 


                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/Setduration/index');
                    }                      
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/tab', $data);
                    // $this->load->view('semester/prog_setduration/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }



                    
                     
                    
                    public function update_status()
                    {
                    $id              = $this->input->post('Id');
                    $status          = $this->input->post('status');
                    $data            = array('status' => $status);
                    $this->db->where('id', $id);
                    if ($this->db->update('batch_duration', $data))
                    {
                    echo json_encode(array('status' => 'success'));
                    } 
                    else
                    {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
                    
                    public function getbatch_data($id)
                    {
                    $Data = $this->Batch_duration_model->getBatchbyId($id);
                    if($Data) {
                    echo json_encode($Data);
                    } 
                    else
                    {
                    echo json_encode(array('error'=>'Failed'));
                    }  
                    }
                    
                    
                    public function add_data()
                    {
                    $this->form_validation->set_rules('faculty', $this->lang->line('faculty'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('batch', $this->lang->line('batch'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('seatcapacity', $this->lang->line('seatcapacity'), 'trim|required|xss_clean');
                    
                    
                    if ($this->form_validation->run() == false)
                    {
                    $array = array('status' => 'fail', 'error' => $msg, 'message' => '');    
                    } 
                    else 
                    {
                    $data                    = array(
                    'faculty'                => $this->input->post('faculty'),
                    'batch'                  => $this->input->post('batch'),
                    'createddate'            => date('Y-m-d H:i:s'),
                    'seatcapacity'           => $this->input->post('seatcapacity'),
                    'session'                => $this->current_session,
                    );
                    $this->Seatcapacity_model->add($data);
                    $msg   = $this->lang->line('success_message');
                    $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                    }
                    echo json_encode($array);
                    }
                    
                    
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    access_denied();
                    }
                    $data['title']       = 'set Duration Details';
                    $this->Seatcapacity_model->remove($id);
                    redirect('semester/seatcapacityduration');
                    }                    
                   
                    }
