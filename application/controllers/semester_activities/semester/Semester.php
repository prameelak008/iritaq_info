                    <?php
                    
                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }
                    
                    
                    class Semester extends Admin_Controller
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
                    if (!$this->rbac->hasPrivilege('semester', 'can_view')) 
                    {
                    access_denied();
                    }
                    
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'semester/index');
                    
                    $data['title']      = 'Add semester';
                    $data['title_list'] = 'semester';
                    
                    // $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee', $this->lang->line('programee'), 'trim|required|xss_clean');

                    $data['Programmetype_list'] =   $this->Programmetype_model->get();
                    $data['semestertype_list']  =   $this->Semestertype_model->getdata();
                    
                    if ($this->form_validation->run() == false)
                    {
                    } 
                    else 
                    {
                    $data                   = array(
                    // 's_id'                  => $this->input->post('semester_id'),
                    // 's_code'                => $this->input->post('semester_code'),
                    's_createddate'         => date('Y-m-d H:i:s'),
                    // 's_name'                => $this->input->post('semester_name'),
                    's_sem_type'            => $this->input->post('semester_type'),
                    's_prog_type'           => $this->input->post('programee_type'),
                    's_prog'                => $this->input->post('programee'),                    
                    's_session'               => $this->current_session,
                    );
                    $this->Semester_model->add($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect('semester/semester/index');
                    }
                    $data['semester_list']  =   $this->Semester_model->get();
                    $semester_list          =   $data['semester_list'];
                    
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/semester/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }

                    
                    
                    
                    public function edit($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_edit')) {
                    access_denied();
                    }
                    $data['title']         = 'Edit Semester';
                    $data['id']            =  $id;
                    $data['sem']           =  $this->Semester_model->get($id);
                    $sem                   =  $data['sem'];
                    $data['title_list']    = 'semester List';
                    $data['semester_list'] =  $this->Semester_model->get();
                    $data['Programmetype_list'] =   $this->Programmetype_model->get();
                    $data['semestertype_list']  =   $this->Semestertype_model->getdata();                  
                    
                    
                    $this->form_validation->set_rules('programee_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programee', $this->lang->line('programee'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/semester/edit_data', $data);
                    $this->load->view('layout/footer', $data);
                    }
                    else
                    {
                    $data           =  array(
                    's_id'            => $id,
                    // 's_id'          => $this->input->post('semester_id'),
                    // 's_code'        => $this->input->post('semester_code'),
                    's_updateddate' => date('Y-m-d H:i:s'),
                    's_sem_type'            => $this->input->post('semester_type'),
                    's_prog_type'   => $this->input->post('programee_type'),
                     's_prog'                => $this->input->post('programee'),
                    's_session'       => $this->current_session, 
                    );
                    $this->Semester_model->add($data);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    }
                    }
                    
                    
        
                    public function delete($id)
                    {
                    if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    access_denied();
                    }
                    $data['title']       = 'semester Details';
                    $this->Semester_model->remove($id);
                    redirect('semester/Semester');
                    }
                    
                    public function update_status()
                    {
                    $semester_id     = $this->input->post('semester_id');
                    $status          = $this->input->post('status');
                    $data            = array(
                    's_status' => $status
                    );
                    $this->db->where('s_id', $semester_id);
                    if ($this->db->update('semester', $data)) {
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
