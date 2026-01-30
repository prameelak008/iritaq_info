                    <?php
                    
                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }
                    
                    
                    class Seatcapduration extends Admin_Controller
                    {
                    public function __construct()
                    {
                    parent::__construct();
                    $this->load->helper('form');
                    $this->config->load('app-config');
                    $this->load->library("datatables");
                    $this->current_session = $this->setting_model->getCurrentSession(); 
                    }
                    
                     
                    
                    public function update_status()
                    {
                    $id              = $this->input->post('Id');
                    $status          = $this->input->post('status');
                    $data            = array('status' => $status);
                    $this->db->where('id', $id);
                    if ($this->db->update('seatcapacity_duration', $data))
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
                    $this->form_validation->set_rules('se_faculty', $this->lang->line('se_faculty'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('se_batch', $this->lang->line('se_batch'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('se_seatcapacity', $this->lang->line('se_seatcapacity'), 'trim|required|xss_clean');
                    
                    
                    if ($this->form_validation->run() == false)
                    {
                    $array = array('status' => 'fail', 'error' => $msg, 'message' => '');    
                    } 
                    else 
                    {
                    $data                    = array(
                    'faculty'                => $this->input->post('se_faculty'),
                    'batch'                  => $this->input->post('se_batch'),
                    'createddate'            => date('Y-m-d H:i:s'),
                    'seatcapacity'           => $this->input->post('se_seatcapacity'),
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
                    $msg   = $this->lang->line('success_message');
                    $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                    echo json_encode($array);
                    }                  
                    
                    
                    
                    public function get_data($id)
                    {
                    $Data = $this->Seatcapacity_model->getseatcapacitybyId($id);
                    if($Data) {
                    echo json_encode($Data);
                    } 
                    else
                    {
                    echo json_encode(array('error'=>'Failed'));
                    }  
                    }
                     


                    // public function remove($id)
                    // {
                    // // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    // // access_denied();
                    // // }
                    // // $data['title']       = 'set Duration Details';
                    // // $this->Seatcapacity_model->remove($id);
                    // // redirect($_SERVER['HTTP_REFERER']);
                    // header('Content-Type: application/json'); // tell browser this is JSON
                    // $data['title']       = 'set Duration Details';            
                    // $deleted             = $this->Seatcapacity_model->remove($id);
                    // echo json_encode(['success' => (bool)$deleted]); // return JSON
                    // exit; 
                    // }



                    public function remove($id)
                    {
                    header('Content-Type: application/json'); // tell browser this is JSON

                    $tab                 = "seatcapacity_duration";
                    $condition           =  array('id'=>$id);
                    $deleted             = $this->Room_allocation_model->delete_data($tab, $condition);
                    echo json_encode(['success' => (bool)$deleted]); // return JSON
                    exit; 
                    }
                   
                    }
