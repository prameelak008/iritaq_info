                    <?php
                    
                    if (!defined('BASEPATH')) {
                        exit('No direct script access allowed');
                    }
                
                    
                    class Programmetype extends Admin_Controller
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
                    if (!$this->rbac->hasPrivilege('Programmetype', 'can_view')) {
                    access_denied();
                    }
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'programmetype/index');
                    
                    $data['title']      = 'Add Programmetype';
                    $data['title_list'] = 'Programmetype';
                    $this->form_validation->set_rules('prog_type_name', $this->lang->line('prog_type_name'), 'trim|required|xss_clean|callback_check_prog_type_name_exists');
                    $this->form_validation->set_rules('prog_type_code', $this->lang->line('prog_type_code'), 'trim|required|xss_clean|callback_check_prog_type_code_exists');
                    if ($this->form_validation->run() == false) {
                    } 
                    else 
                    {
                    $data                 = array(
                    'prog_type_name'             => $this->input->post('prog_type_name'),
                    'prog_type_code'             => $this->input->post('prog_type_code'),
                    'prog_type_createddate'      => date('Y-m-d H:i:s'),
                    'prog_type_session'          => $this->current_session
                    );
                    
                    $this->Programmetype_model->add($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/Programmetype/index');
                    }

                    $data['Programmetype_list'] =   $this->Programmetype_model->get();
                    $Programmetype_list         =   $data['Programmetype_list'];
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/programmetype/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }





                    public function edit($id)
                    {
                    if (!$this->rbac->hasPrivilege('Programmetype', 'can_edit')) {
                    access_denied();
                    }

                    $data['title']              = 'Edit Programmetype';
                    $data['id']                 = $id;
                    $data['get_byid']           = $this->Programmetype_model->get($id);
                    $data['title_list']         = 'Programmetype List';
                    $data['Programmetype_list'] = $this->Programmetype_model->get();

                    $this->form_validation->set_rules('prog_type_name', $this->lang->line('prog_type_name'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('prog_type_code', $this->lang->line('prog_type_code'), 'trim|required|xss_clean');

                    if ($this->form_validation->run() == false) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/programmetype/edit_data', $data);
                    $this->load->view('layout/footer', $data);
                    } 
                    else
                     {

                    $prog_type_name = $this->input->post('prog_type_name');
                    $prog_type_code = $this->input->post('prog_type_code');

                    // Check name and code against other records (excluding current id)
                    $nameExists = $this->Programmetype_model->check_name_exists($prog_type_name, $id);
                    $codeExists = $this->Programmetype_model->check_code_exists($prog_type_code, $id);

                    if ($nameExists || $codeExists) {
                    $parts = [];
                    if ($nameExists) { $parts[] = 'name'; }
                    if ($codeExists) { $parts[] = 'code'; }
                    $msg = 'Programme Type '.implode(' and ', $parts).' already exists.';
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$msg.'</div>');



                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    
                    else 
                    {
                    $update_data = array(
                    'prog_type_id'          => $id,
                    'prog_type_name'        => $prog_type_name,
                    'prog_type_code'        => $prog_type_code,
                    'prog_type_updateddate' => date('Y-m-d H:i:s'),
                    'prog_type_session'     => $this->current_session
                    );

                    $this->Programmetype_model->add($update_data);
                    $this->session->set_flashdata(
                    'msg',
                    '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>'
                    );
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    }
                    }


        
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('Programmetype', 'can_delete')) {
                    access_denied();
                    }
                    $data['title'] = 'Programmetype Details';
                    $this->Programmetype_model->remove($id);
                    redirect('semester/programmetype');
                    }
                    
                    public function update_status()
                    {
                    $id               = $this->input->post('id');
                    $status           = $this->input->post('status');
                    $data             = array(
                    'prog_type_status' => $status
                    );
                    $this->db->where('prog_type_id', $id);
                    if ($this->db->update('programme_type', $data)) {
                    echo json_encode(array('status' => 'success'));
                    } else {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
                    
                    public function check_prog_type_name_exists($prog_type_name)
                    {
                    if ($this->Programmetype_model->name_exists($prog_type_name))
                    {
                    $this->form_validation->set_message('check_prog_type_name_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }
                    
                    public function check_prog_type_code_exists($prog_type_code)
                    {
                    if ($this->Programmetype_model->code_exists($prog_type_code))
                    {
                    $this->form_validation->set_message('check_prog_type_code_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }



                    public function bulkDelete()
                    {
                    $ids = $this->input->post('ids');
                    if (!empty($ids)) {
                    foreach ($ids as $id)
                    {
                    $this->Programmetype_model->remove($id);
                    }
                    echo "success";
                    } else {
                    echo "no_ids";
                    }
                    }
                    }
