                    <?php
                    
                    if (!defined('BASEPATH')) 
                    {
                    exit('No direct script access allowed');
                    }
                    

                    class Programee extends Admin_Controller
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
                    if (!$this->rbac->hasPrivilege('programee', 'can_view')) {
                    access_denied();
                    }
                    
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'programee/index');
                    
                    $data['title']      = 'Add Programee';
                    $data['title_list'] = 'Programee';
                    $this->form_validation->set_rules('programee_id', $this->lang->line('programee_id'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee_code', $this->lang->line('programee_code'), 'trim|required|xss_clean|callback_check_programee_code_exists');
                    $this->form_validation->set_rules('programee_name', $this->lang->line('programee_name'), 'trim|required|xss_clean|callback_check_programee_name_exists');
                    $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                     $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                    $data['Programmetype_list']     =   $this->Programmetype_model->get();

                    $data['Programmetype_bystatus'] =   $this->Programmetype_model->get_prgrmtype();

                    
                    if ($this->form_validation->run() == false) {
                    } 
                    else 
                    {
                    $data                   = array(
                    'p_id'                  => $this->input->post('programee_id'),
                    'p_code'                => $this->input->post('programee_code'),
                    'p_createddate'         => date('Y-m-d H:i:s'),
                    'p_name'                => $this->input->post('programee_name'),
                    'p_type'                => $this->input->post('programee_type'),
                    'session'               => $this->current_session,
                    );
                    $this->Programee_model->add($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/programee/index');
                    }
                    
                    $data['programee_list'] =   $this->Programee_model->get();
                    $data['max_code']       =   $this->Programee_model->get_maxcode();
                    $programee_list         =   $data['programee_list'];
                    
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/programee/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
    




                    public function edit($id)
                    {
                    if (!$this->rbac->hasPrivilege('programee', 'can_edit')) {
                    access_denied();
                    }
                    $data['title']        = 'Edit programee';
                    $data['id']           =  $id;
                    $data['get_by_id']    =  $this->Programee_model->get($id);
                    $data['title_list']   = 'programee List';
                    $data['programee_list'] =  $this->Programee_model->get();
                    $data['Programmetype_list'] =   $this->Programmetype_model->get();
                    $data['Programmetype_bystatus'] =   $this->Programmetype_model->get_prgrmtype();
                    $this->form_validation->set_rules('programee_id', $this->lang->line('programee_id'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee_code', $this->lang->line('programee_code'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee_name', $this->lang->line('programee_name'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/programee/edit_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
                    else
                    {


                    $prog_type_name = $this->input->post('programee_name');
                    $prog_type_code = $this->input->post('programee_code');

                    // Check name and code against other records (excluding current id)
                    $nameExists = $this->Programee_model->check_name_exists($prog_type_name, $id);
                    $codeExists = $this->Programee_model->check_code_exists($prog_type_code, $id);

                    if ($nameExists || $codeExists) {
                    $parts = [];
                    if ($nameExists) { $parts[] = 'name'; }
                    if ($codeExists) { $parts[] = 'code'; }
                    $msg = 'Programme  '.implode(' and ', $parts).' already exists.';
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$msg.'</div>');



                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    else
                    {

                    $data           =  array(
                    'id'            => $id,
                    'p_id'          => $this->input->post('programee_id'),
                    'p_code'        => $this->input->post('programee_code'),
                    'p_updateddate' => date('Y-m-d H:i:s'),
                    'p_name'        => $this->input->post('programee_name'),
                    'p_type'        => $this->input->post('programee_type'),
                    'session'       => $this->current_session, 
                    );
                    $this->Programee_model->add($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    }
                    }
                    
                    
        
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('programee', 'can_delete')) {
                    access_denied();
                    }
                    $data['title'] = 'programee Details';
                    $this->Programee_model->remove($id);
                    redirect('semester/programee');
                    }
                    
                    
                    public function update_status()
                    {
                    $programee_id = $this->input->post('programee_id');
                    $status     = $this->input->post('status');
                    $data            = array(
                    'p_status' => $status
                    );
                    $this->db->where('id', $programee_id);
                    if ($this->db->update('programee', $data)) {
                    echo json_encode(array('status' => 'success'));
                    } else {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
                    
                    
                    public function check_programee_name_exists($programee_name)
                    {
                    if ($this->Programee_model->programee_name_exists($programee_name))
                    {
                    $this->form_validation->set_message('check_programee_name_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }
                    
                    public function check_programee_code_exists($programee_code)
                    {
                    if ($this->Programee_model->programee_code_exists($programee_code))
                    {
                    $this->form_validation->set_message('check_programee_code_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }

                     public function bulkDelete()
                    {
                    $ids = $this->input->post('ids');
                    if (!empty($ids)) {
                    foreach ($ids as $id) {
                    $this->Programee_model->remove($id);
                    }
                    echo "success";
                    } else {
                    echo "no_ids";
                    }
                    } 

                
                    }
