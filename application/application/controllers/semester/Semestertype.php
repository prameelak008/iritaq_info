            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }


            class Semestertype extends Admin_Controller
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
            $this->session->set_userdata('sub_menu', 'semestertype/index');

            $data['title']      = 'Add semester Type';
            $data['title_list'] = 'semester';
            $this->form_validation->set_rules('semester_id', $this->lang->line('semester_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester_code', $this->lang->line('semester_code'), 'trim|required|xss_clean|callback_check_semester_code_exists');
            $this->form_validation->set_rules('semester_name', $this->lang->line('semester_name'), 'trim|required|xss_clean|callback_check_semester_name_exists');

            if ($this->form_validation->run() == false) 
            {
            } 
            else 
            {
            $data                    = array(
            'st_sid'                 => $this->input->post('semester_id'),
            'st_code'                => $this->input->post('semester_code'),
            'st_createddate'         => date('Y-m-d H:i:s'),
            'st_name'                => $this->input->post('semester_name'),
            'st_session'             => $this->current_session);
            $this->Semestertype_model->add($data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester/semestertype/index');
            }
            $data['semester_list']  =   $this->Semestertype_model->get();
            $data['max_code']       =   $this->Semestertype_model->get_maxcode();
            $semester_list          =   $data['semester_list'];
            $this->load->view('layout/header', $data);
            $this->load->view('semester/semestertype/add_data', $data);
            $this->load->view('layout/footer', $data);
            }


            

            public function unique_semester_code($code, $id)
            {
                $this->db->where('st_code', $code);
                $this->db->where('st_id !=', $id);
                $q = $this->db->get('semestertype');
                if ($q->num_rows() > 0) {
                    $this->form_validation->set_message('unique_semester_code', $this->lang->line('already_exists'));
                    return false;
                }
                return true;
            }

            public function unique_semester_name($name, $id)
            {
                $this->db->where('st_name', $name);
                $this->db->where('st_id !=', $id);
                $q = $this->db->get('semestertype');
                if ($q->num_rows() > 0) {
                    $this->form_validation->set_message('unique_semester_name', $this->lang->line('already_exists'));
                    return false;
                }
                return true;
            }




            public function edit($id)
            {
            if (!$this->rbac->hasPrivilege('semester', 'can_edit')) {
            access_denied();
            }
            $data['title']         = 'Edit semester';
            $data['id']            =  $id;
            $data['sem']           =  $this->Semestertype_model->get($id);
            $sem                   =  $data['sem'];
            $data['title_list']    = 'semester List';
            $data['semester_list'] =  $this->Semestertype_model->get();

            $this->form_validation->set_rules('semester_id', $this->lang->line('semester_id'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester_code', $this->lang->line('semester_code'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester_name', $this->lang->line('semester_name'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('semester/semestertype/edit_data', $data);
            $this->load->view('layout/footer', $data);
            }
            else
            {
            $semester_code = $this->input->post('semester_code');
            $semester_name = $this->input->post('semester_name');

            // Duplicate checks like Programee: exclude current id
            $this->db->from('semestertype');
            $this->db->where('st_code', $semester_code);
            $this->db->where('st_id !=', $id);
            $codeExists = $this->db->count_all_results() > 0;

            $this->db->from('semestertype');
            $this->db->where('st_name', $semester_name);
            $this->db->where('st_id !=', $id);
            $nameExists = $this->db->count_all_results() > 0;

            if ($nameExists || $codeExists) {
                $parts = array();
                if ($nameExists) { $parts[] = strtolower($this->lang->line('semester_name')); }
                if ($codeExists) { $parts[] = strtolower($this->lang->line('semester_code')); }
                $msg = ucfirst($this->lang->line('semester')).' '.implode(' and ', $parts).' '.$this->lang->line('already_exists').'.';
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$msg.'</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $data               =  array(
            'st_id'             => $id,
            'st_sid'            => $this->input->post('semester_id'),
            'st_code'           => $semester_code,
            'st_updateddate'    => date('Y-m-d H:i:s'),
            'st_name'           => $semester_name,
            'st_session'        => $this->current_session, 
            );
            $this->Semestertype_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
           redirect('semester/semestertype');
            }
            }



            // public function delete($id)
            // {
            // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
            // access_denied();
            // }
            // $data['title']       = 'semester Details';
            // $this->Semestertype_model->remove($id);
            // redirect($_SERVER['HTTP_REFERER']);
            // }


            public function delete($id)
            {
            if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
            access_denied();
            }

            $result = $this->Semestertype_model->remove($id);

            if ($result === true) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Deleted successfully.</div>');
            } elseif (is_array($result) && $result['code'] == 1451) 
            { 
            // MySQL error code 1451 = Cannot delete or update a parent row: a foreign key constraint fails
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Cannot delete: record is used in another table.</div>');
            } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Delete failed.</div>');
            }
            redirect('semester/Semestertype');            
            }
      




            public function update_status()
            {
            $semester_id     = $this->input->post('semester_id');
            $status          = $this->input->post('status');
            $data            = array(
            'st_status' => $status
            );
            $this->db->where('st_id', $semester_id);
            if ($this->db->update('semestertype', $data)) {
            echo json_encode(array('status' => 'success'));
            } else {
            echo json_encode(array('status' => 'error'));
            }
            }



            


            public function check_semester_code_exists($semester_code)
            {
            if ($this->Semestertype_model->semester_code_exists($semester_code))
            {
            // Set flashdata instead of inline validation message
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$this->lang->line('semester_code').' '.$this->lang->line('already_exists').'</div>');
            return FALSE;
            } else {
            return TRUE;
            }
            }


            public function check_semester_name_exists($semester_name)
            {
            if ($this->Semestertype_model->semester_name_exists($semester_name))
            {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$this->lang->line('semester_name').' '.$this->lang->line('already_exists').'</div>');

            // $this->form_validation->set_message('check_semester_name_exists', 'The {field} already exists.');
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
            $this->Semestertype_model->remove($id);
            }
            echo "success";
            } else {
            echo "no_ids";
            }
            }
          
            
            }
