        <?php
        if (!defined('BASEPATH')) 
        {
        exit('No direct script access allowed');
        }
        
        class Circulation_privileges extends Admin_Controller
        {
        public function __construct()
        {
        parent::__construct();
        $this->load->library('encoding_lib');
        $this->current_session = $this->setting_model->getCurrentSession();
        }
        
        
        public function index()
        {
        if (!$this->rbac->hasPrivilege('books', 'can_view')) 
        {
        access_denied();
        }
        $data['roles']          = $this->role_model->get();
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/circulation_privileges');
        $data['title']          = 'Circulation Privileges';
        $data['title_list']     = 'Circulation Privileges';
        $listbook               = $this->book_model->listbook();
        $cprivileges            = $this->book_model->get_cprivileges();
        $data['current_session']= $this->book_model->get_currentsession();
        $multifine              = $this->book_model->get_multifine();
        $data['multifine']      = $multifine;
        $data['litbook']        = $listbook;
        $data['privileges']     = $cprivileges;
        $this->load->view('layout/header');
        $this->load->view('admin/book/circulation_privileges', $data);
        $this->load->view('layout/footer');
        }
        
        public function add_circulation_privileges()
        {
        $this->current_session  = $this->setting_model->getCurrentSession();
        $this->form_validation->set_rules('category', $this->lang->line('category'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false)
        {
        }
        else
        {
        $data = array(
        'library_cp_category'        => $this->input->post('category'), 
        'library_cp_no_of_books'     => $this->input->post('no_of_books'),   
        'library_cp_no_of_days'      => $this->input->post('no_of_days'),
        'library_cp_session'         => $this->current_session,
        );
        $this->db->insert('library_circulationprivileges', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        }
        redirect('admin/circulation_privileges');
        }
        
        public function edit($id)
        {
        if (!$this->rbac->hasPrivilege('books', 'can_view')) 
        {
        access_denied();
        }
        $data['roles']          = $this->role_model->get();
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/circulation_privileges');
        $data['title']          = 'Circulation Privileges';
        $data['title_list']     = 'Circulation Privileges';
        $listbook               = $this->book_model->listbook();
        $data['privileges']     = $this->book_model->get_cprivileges();
        $data['current_session']= $this->book_model->get_currentsession();
        $data['editprivileges'] = $this->book_model->get_privilegesbyid($id);
        $data['litbook']        = $listbook;
        $cprivileges            = $data['privileges'];
        $this->load->view('layout/header');
        $this->load->view('admin/book/editcirculation_privileges', $data);
        $this->load->view('layout/footer');
        }
        
        public function update_circulation_privileges()
        {
        $cid       = $this->input->post('cid');
        $data = array(
        'library_cp_category'        => $this->input->post('category'), 
        'library_cp_no_of_books'     => $this->input->post('no_of_books'),   
        'library_cp_no_of_days'      => $this->input->post('no_of_days'),
        'library_cp_session'         => $this->current_session,
        );
        $this->db->where('library_cp_id',$cid);
        $this->db->update('library_circulationprivileges', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
        redirect('admin/circulation_privileges');
        }
        
        public function delete($id)
        {
        $this->db->where('library_cp_id', $id);
        $this->db->delete('library_circulationprivileges');
        redirect('admin/circulation_privileges/');
        }
        
        public function add_multiplefine()
        {
        $data                   =     array(  
        'lib_multi_privilege_id' => $this->input->post('privilegefine'), 
        'lib_multi_finedays'     => $this->input->post('fine_days'),   
        'lib_multi_amt'          => $this->input->post('fineamt'),
        'lib_multi_createddate'  =>date('Y-m-d H:i:s') ); 
        $this->db->insert('library_multiplefine', $data);
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function getmultiplefine()
        {
        $library_cp_id    = $this->input->post('library_cp_id');    
        $data     = $this->book_model->get_multifine_byprivilegeid($library_cp_id);
        echo json_encode($data);
        }
        
        public function delete_multi()
        {
        $lib_multi_id    = $this->input->post('lib_multi_id');
        $this->db->where('lib_multi_id', $lib_multi_id);
        $data     =$this->db->delete('library_multiplefine');
        echo json_encode($data);
        }
        
        
        public function editmulti()
        {
        $lib_multi_id    = $this->input->post('lib_multi_id');
         $data = array(
        'lib_multi_finedays'        => $this->input->post('lib_multi_finedays'), 
        'lib_multi_amt'     => $this->input->post('lib_multi_amt'));
        $this->db->where('lib_multi_id',$lib_multi_id);
        $this->db->update('library_multiplefine', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
        redirect('admin/circulation_privileges');
        }
        }
