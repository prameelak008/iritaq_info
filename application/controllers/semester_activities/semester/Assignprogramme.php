                    <?php
                    
                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }
                    
                    
                    class Assignprogramme extends Admin_Controller
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
                    $this->session->set_userdata('sub_menu', 'assignprogramme/index');
                    
                    $data['title']      = 'Assign Programme';
                    $data['title_list'] = 'Assign';
                    $this->form_validation->set_rules('programme', $this->lang->line('programme'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('facultydept', $this->lang->line('faculty'), 'trim|required|xss_clean');
             
                    if ($this->form_validation->run() == false) 
                    {
                    } 
                    else 
                    {
                    $data                    = array(
                    'pg_programme'           => $this->input->post('programme'),
                    'pg_facultydep'          => $this->input->post('facultydept'),
                    'pg_createddate'         => date('Y-m-d H:i:s'),
                    'pg_session'             => $this->current_session,
                    );
                    $this->Programee_model->add_assign($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/Assignprogramme/index');
                    }
                    $data['programelist']   =   $this->Programee_model->get_programs($this->current_session);
                    $data['facultylist']    =   $this->Faculty_model->get_faculty($this->current_session);
                    
                    $data['assignprgmlist'] =   $this->Programee_model->get_assignprograme($this->current_session);
                 
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/assignprograme/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }




                    public function edit($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_edit')) {
                    access_denied();
                    }
                    $data['title']          =  'Edit Assign Programme';
                    $data['id']             =   $id;
                    
                    $data['programelist']   =   $this->Programee_model->get_programs($this->current_session);
                    $data['facultylist']    =   $this->Faculty_model->get_faculty($this->current_session);
                    $data['assignprgmlist'] =   $this->Programee_model->get_assignprograme($this->current_session);
                    $data['assignprgm_byid'] =   $this->Programee_model->get_assignprogramebyid($id);
                    
                    $this->form_validation->set_rules('programme', $this->lang->line('programme'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('facultydept', $this->lang->line('faculty'), 'trim|required|xss_clean');
                    
                    if ($this->form_validation->run() == false) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/assignprograme/edit_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
                    else
                    {
                    $data                    = array(
                    'id'                     => $id,    
                    'pg_programme'           => $this->input->post('programme'),
                    'pg_facultydep'          => $this->input->post('facultydept'),
                    'pg_createddate'         => date('Y-m-d H:i:s'),
                    'pg_session'             => $this->current_session,
                    );
                    
                    $this->Programee_model->add_assign($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    
                    }
                    }
                    
                    
        
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    access_denied();
                    }
                    $data['title']       = 'Assign Programme';
                    $this->Programee_model->remove_assign($id);
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    
                    public function update_status()
                    {
                    $id              = $this->input->post('id');
                    $status          = $this->input->post('status');
                    $data            = array('pg_status' => $status);
                    $this->db->where('id', $id);
                    if ($this->db->update('assign_programme', $data))
                    {
                    echo json_encode(array('status' => 'success'));
                    } 
                    else
                    {
                    echo json_encode(array('status' => 'error'));
                    }
                    }
        
                    }
