            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Faculty extends Admin_Controller
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
            if (!$this->rbac->hasPrivilege('faculty', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'semester');
            // $this->session->set_userdata('sub_menu', 'faculty/index');

            $data['title']      = 'Add Faculty';
            $data['title_list'] = 'Faculty';
            $this->form_validation->set_rules('faculty_id', $this->lang->line('faculty_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('faculty_code', $this->lang->line('faculty_code'), 'trim|required|xss_clean|callback_check_faculty_code_exists');
            $this->form_validation->set_rules('faculty_name', $this->lang->line('faculty_name'), 'trim|required|xss_clean|callback_check_faculty_name_exists');
            if ($this->form_validation->run() == false) {
            } 
            else 
            {
            $data                 = array(
            'faculty_id'          => $this->input->post('faculty_id'),
            'faculty_code'        => $this->input->post('faculty_code'),
            'faculty_createddate' => date('Y-m-d H:i:s'),
            'faculty_name'        => $this->input->post('faculty_name'),
            'session'             => $this->current_session
            );

            $this->Faculty_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester/faculty/index');
            }                   

            $data['faculty_list'] =   $this->Faculty_model->get();
            $data['max_code']     =   $this->Faculty_model->get_maxcode();
            $faculty_list         =   $data['faculty_list'];

            $this->load->view('layout/header', $data);
            // $this->load->view('layout/topbar', $data);
            $this->load->view('semester/faculty/add_data', $data);
            $this->load->view('layout/footer', $data);
            }





            public function edit($id)
            {
            if (!$this->rbac->hasPrivilege('faculty', 'can_edit')) {
            access_denied();
            }

            $data['title']        = 'Edit Faculty';
            $data['id']           = $id;
            $data['faculties']    = $this->Faculty_model->get($id);
            $faculties            = $data['faculties'];
            $data['title_list']   = 'Faculty List';
            $data['faculty_list'] = $this->Faculty_model->get();

            $this->form_validation->set_rules('faculty_id', $this->lang->line('faculty_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('faculty_code', $this->lang->line('faculty_code'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('faculty_name', $this->lang->line('faculty_name'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('semester/faculty/edit_data', $data);
            $this->load->view('layout/footer', $data);
            } else {
            $faculty_code = $this->input->post('faculty_code');
            $faculty_name = $this->input->post('faculty_name');

            //  Check if same code/name exists for other records
            $exists = $this->Faculty_model->check_exists_for_edit($faculty_code, $faculty_name, $id);

            if ($exists) {
            $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-danger text-left">Faculty code or name already exists for another record.</div>'
            );
            redirect($_SERVER['HTTP_REFERER']);
            } else {
            $update_data = array(
            'id'                  => $id,
            'faculty_id'          => $this->input->post('faculty_id'),
            'faculty_code'        => $faculty_code,
            'faculty_name'        => $faculty_name,
            'faculty_updateddate' => date('Y-m-d H:i:s'),
            'session'             => $this->current_session,
            );

            $this->Faculty_model->add($update_data);
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
            if (!$this->rbac->hasPrivilege('faculty', 'can_delete')) {
            access_denied();
            }
            $data['title'] = 'Faculty Details';
            $this->Faculty_model->remove($id);
            redirect('semester/faculty');
            }


            public function update_status()
            {
            $faculty_id = $this->input->post('faculty_id');
            $status     = $this->input->post('status');
            $data            = array(
            'faculty_status' => $status
            );
            $this->db->where('id', $faculty_id);
            if ($this->db->update('faculty', $data)) {
            echo json_encode(array('status' => 'success'));
            } else {
            echo json_encode(array('status' => 'error'));
            }
            }



            public function check_faculty_name_exists($faculty_name)
            {
            if ($this->Faculty_model->faculty_name_exists($faculty_name))
            {
            // flash banner and suppress inline validation message
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$this->lang->line('faculty_name').' '.$this->lang->line('already_exists').'</div>');
            $this->form_validation->set_message('check_faculty_name_exists', ' ');
            return FALSE;
            } else {
            return TRUE;
            }
            }

            public function check_faculty_code_exists($faculty_code)
            {
            if ($this->Faculty_model->faculty_code_exists($faculty_code))
            {
            // flash banner and suppress inline validation message
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$this->lang->line('faculty_code').' '.$this->lang->line('already_exists').'</div>');
            $this->form_validation->set_message('check_faculty_code_exists', ' ');
            return FALSE;
            } else {
            return TRUE;
            }
            }

            public function check_faculty_name_exists_edit($faculty_name, $id)
            {
            if ($this->Faculty_model->faculty_name_exists_except_id($faculty_name, $id)) {
            $this->form_validation->set_message('check_faculty_name_exists_edit', 'The {field} already exists.');
            return FALSE;
            } else {
            return TRUE;
            }
            }

            public function check_faculty_code_exists_edit($faculty_code, $id)
            {
            if ($this->Faculty_model->faculty_code_exists_except_id($faculty_code, $id)) {
            $this->form_validation->set_message('check_faculty_code_exists_edit', 'The {field} already exists.');
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
            $this->Faculty_model->remove($id);
            }
            echo "success";
            } else {
            echo "no_ids";
            }
            } 
            }
