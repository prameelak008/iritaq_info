                    <?php
                    
                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }
                    
                    
                    class Batch extends Admin_Controller
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
                    $this->session->set_userdata('sub_menu', 'batch/index');
                    
                    $data['title']      = 'Add batch';
                    $data['title_list'] = 'Batch';
                    
                    $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee', $this->lang->line('programee'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('batch_type', $this->lang->line('batch_type'), 'trim|required|xss_clean');        
                    $this->form_validation->set_rules('fromdate', $this->lang->line('fromdate'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('todate', $this->lang->line('todate'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('session_id', $this->lang->line('session_id'),  'trim|required|xss_clean');
                    
                    $data['Programmetype_list']   =   $this->Programmetype_model->get();
                    $data['sessionlist']          =   $this->session_model->get();
                    $data['batch']                =   $this->Batch_model->getbatch();

                    $data['batch_list']    =   $this->Batch_model->get();
                    $batch_list            =   $data['batch_list'];  
                    
                    if ($this->form_validation->run() == false)
                    {
                    } 
                    else 
                    {
                        
                    $data                    = array(
                    'b_progtype'             => $this->input->post('programee_type'),
                    'b_program'              => $this->input->post('programee'), 
                    'b_batchtype'            => $this->input->post('batch_type'), 
                    'b_startdate'            => $this->input->post('fromdate'), 
                    'b_enddate'              => $this->input->post('todate'), 
                    'b_year'                 => $this->input->post('session_id'), 
                    'b_createddate'          => date('Y-m-d H:i:s'));
                    $this->Batch_model->add($data);
                    
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/batch/index');
                    }
                    $data['batchlist']     =   $this->Batch_model->batchlist(); 
             
                    $batch_list             =   $data['batch_list'];
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/batch/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
                    
                    


                    public function edit($id)
                    { 

                    if (!$this->rbac->hasPrivilege('semester', 'can_edit')) 
                    {
                    access_denied();
                    }
                    $data['title']         =   'Edit Batch';
                    $data['id']            =   $id;
                    $data['editbatch']     =   $this->Batch_model->get($id);
                    $sem                   =   $data['sem'];
                    $data['title_list']    =  'batch List';
                    $data['batch_list']    =   $this->Batch_model->get();
                    $batch_list            =   $data['batch_list'];  
                    
                    
                    $this->form_validation->set_rules('batch_type', $this->lang->line('batch_type'), 'trim|required|xss_clean');                    
                    $this->form_validation->set_rules('batch_id', $this->lang->line('batch_id'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('batch_code', $this->lang->line('batch_code'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('batch_name', $this->lang->line('batch_name'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                    $data['Programmetype_list']   =   $this->Programmetype_model->get();
                    $data['batchlist']      =   $this->Batch_model->batchlist(); 
                    
                    
                    $data['sessionlist']          =   $this->session_model->get();
                    if ($this->form_validation->run() == false) 
                    {
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/batch/edit_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
            

                    else
                    {
                    $data                   = array(
                    'b_id'                  =>  $id,
                    'b_progtype'            => $this->input->post('programee_type'),
                    'b_program'             => $this->input->post('programee'), 
                    'b_batchtype'           => $this->input->post('batch_type'), 
                    'b_startdate'           => $this->input->post('fromdate'), 
                    'b_enddate'             => $this->input->post('todate'), 
                    'b_year'                => $this->input->post('session_id'), 
                    'b_createddate'         => date('Y-m-d H:i:s'));
                    $this->Batch_model->add($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    }
                    
                    
        
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    access_denied();
                    }
                    $data['title']       = 'batch Details';
                    $this->Batch_model->remove($id);
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    
                    
                    
                    public function update_status()
                    {
                    $batch_id        = $this->input->post('batch_id');
                    $status          = $this->input->post('status');
                    $data            = array('b_status' => $status);
                    $this->db->where('id', $batch_id);
                    if ($this->db->update('batch', $data))
                    {
                    echo json_encode(array('status' => 'success'));
                    } 
                    else
                    {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
                 
                    public function check_batch_code_exists($batch_code)
                    {
                    if ($this->Batch_model->batch_code_exists($batch_code))
                    {
                    $this->form_validation->set_message('check_batch_code_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }
                    
                 
                    public function check_batch_name_exists($batch_name)
                    {
                    if ($this->Batch_model->batch_name_exists($batch_name))
                    {
                    $this->form_validation->set_message('check_batch_name_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }
                    


                    public function getProgramsByType() 
                    {
                    $type_id  = $this->input->post('progType');
                    $data     = $this->Batch_model->getProgramsByType($type_id);
                    echo json_encode($data);
                    }

        
                    }
