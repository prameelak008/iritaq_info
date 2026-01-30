
            <?php                    
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Semester_Subjectpaper extends Admin_Controller
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
            // if (!$this->rbac->hasPrivilege('Subjectpaper', 'can_view')) {
            // access_denied();
            // }

            $this->session->set_userdata('top_menu', 'semester');
            $this->session->set_userdata('sub_menu', 'Semester_Subjectpaper/index');                    
            $data['title']            = 'Add Subjectpaper';
            $data['title_list']       = 'Subjectpaper';

            $this->form_validation->set_rules('subjectid', $this->lang->line('subject'), 'trim|required|xss_clean');

            $this->form_validation->set_rules('paper_code', $this->lang->line('paper_code'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papername', $this->lang->line('papername'), 'trim|required|xss_clean');


            $subjects                 = $this->Subjectpaper_model->getSubjects();
            $data['subjects']         = $subjects;

            $subject_paper            = $this->Semester_subjectgroup_model->get_subjectpaper();
            $data['subject_paper']    = $subject_paper;

            if ($this->form_validation->run() == false)
            {

            } 
            else 
            {
            $code = $this->input->post('paper_code');
            $name = $this->input->post('papername');

            $codeExists = $this->Semester_subjectgroup_model->paper_code_exists($code);
            $nameExists = $this->Semester_subjectgroup_model->paper_name_exists($name);

            if ($codeExists || $nameExists) {
            $parts = array();
            if ($nameExists) { $parts[] = strtolower($this->lang->line('papername')); }
            if ($codeExists) { $parts[] = strtolower($this->lang->line('paper_code')); }
            $msg = ucfirst(implode(' and ', $parts)).' '.$this->lang->line('already_exists').'.';

            $data['msg'] = '<div class="alert alert-danger text-left">'.$msg.'</div>';
            $this->load->view('layout/header', $data);
            $this->load->view('semester/subjectpaper/add_data', $data);
            $this->load->view('layout/footer', $data);
            return; // IMPORTANT: no redirect, so set_value() keeps the POST data
            }

            $data                   = array(
            'sem_paper_subjectid'   => $this->input->post('subjectid'),
            'sem_paper_code'        => $code,
            'sem_paper_paper'       => $name,
            'sem_paper_description' => $this->input->post('description'),                    
            'sem_paper_created'     => date('Y-m-d H:i:s') );
            $this->Semester_subjectgroup_model->add_semesterpaper($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester/Semester_Subjectpaper/index');
            } 
            $this->load->view('layout/header', $data);
            $this->load->view('semester/subjectpaper/add_data', $data);
            $this->load->view('layout/footer', $data);
            }



            public function edit($id)
            {
            // if (!$this->rbac->hasPrivilege('programee', 'can_edit')) {
            // access_denied();
            // }

            $this->session->set_userdata('top_menu', 'semester');
            $this->session->set_userdata('sub_menu', 'Semester_Subjectpaper/index'); 

            $data['title']              = 'Paper';
            $data['id']                 =  $id;   
            $data['title_list']         =  'Paper List';  
            $this->form_validation->set_rules('paper_code', $this->lang->line('paper_code'), 'trim|required|xss_clean');                
            $subjects                   = $this->Subjectpaper_model->getSubjects();
            $data['subjects']           = $subjects;

            $subject_paper              = $this->Semester_subjectgroup_model->get_subjectpaper();
            $data['subject_paper']      = $subject_paper;

            $edit_subject_paper         = $this->Semester_subjectgroup_model->get_subjectpaper($id);
            $data['edit_subject_paper'] = $edit_subject_paper;

            $this->form_validation->set_rules('subjectid', $this->lang->line('subject'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('paper_code', $this->lang->line('paper_code'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papername', $this->lang->line('papername'), 'trim|required|xss_clean');


            if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('semester/subjectpaper/edit_data', $data);
            $this->load->view('layout/footer', $data);
            }
            else
            {                        
            // Semestertype-style duplicate checks (exclude current id)
            $code = $this->input->post('paper_code');
            $name = $this->input->post('papername');
            $codeExists = $this->Semester_subjectgroup_model->paper_code_exists($code, $id);
            $nameExists = $this->Semester_subjectgroup_model->paper_name_exists($name, $id);

            if ($codeExists || $nameExists) {
            $parts = array();
            if ($nameExists) { $parts[] = strtolower($this->lang->line('papername')); }
            if ($codeExists) { $parts[] = strtolower($this->lang->line('paper_code')); }
            $msg = ucfirst().' '.implode(' and ', $parts).' '.$this->lang->line('already_exists').'.';
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$msg.'</div>');
            redirect($_SERVER['HTTP_REFERER']);
            }



            $data                   = array(
            'sem_paper_id'          => $id, 
            'sem_paper_subjectid'   => $this->input->post('subjectid'),
            'sem_paper_code'        => $code,
            'sem_paper_paper'       => $name,
            'sem_paper_description' => $this->input->post('description'),                    
            'sem_paper_updated'     => date('Y-m-d H:i:s') );
            $this->Semester_subjectgroup_model->add_semesterpaper($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect($_SERVER['HTTP_REFERER']);
            }
            }




            public function delete($id)
            {
            // if (!$this->rbac->hasPrivilege('programee', 'can_delete')) {
            // access_denied();
            // }

            $data['title'] = 'Semester ';
            $this->Semester_subjectgroup_model->remove_paper($id);
            redirect('semester/Semester_Subjectpaper');
            }


            public function update_status()
            {
            $id                = $this->input->post('id');
            $status            = $this->input->post('status');
            $data              = array(
            'sem_paper_status' => $status
            );
            $this->db->where('sem_paper_id', $id);
            if ($this->db->update('semestersubjectpaper', $data)) {
            echo json_encode(array('status' => 'success'));
            } else {
            echo json_encode(array('status' => 'error'));
            }
            }


            // public function check_programee_name_exists($programee_name)
            // {
            // if ($this->Programee_model->programee_name_exists($programee_name))
            // {
            // $this->form_validation->set_message('check_programee_name_exists', 'The {field} already exists.');
            // return FALSE;
            // } else {
            // return TRUE;
            // }
            // }

            // public function check_programee_code_exists($programee_code)
            // {
            // if ($this->Programee_model->programee_code_exists($programee_code))
            // {
            // $this->form_validation->set_message('check_programee_code_exists', 'The {field} already exists.');
            // return FALSE;
            // } else {
            // return TRUE;
            // }
            // }

            // public function bulkDelete()
            // {
            // $ids = $this->input->post('ids');
            // if (!empty($ids)) {
            // foreach ($ids as $id) {
            // $this->Programee_model->remove($id);
            // }
            // echo "success";
            // } else {
            // echo "no_ids";
            // }
            // } 

            }
