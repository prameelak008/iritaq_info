            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Subjectpaper extends Admin_Controller {
            
            function __construct() {
            parent::__construct();
            $this->sch_setting_detail = $this->setting_model->getSetting();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            


            
            
            public function index() 
            {                
            if (!$this->rbac->hasPrivilege('subjectpaper', 'can_view')) {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'Academics');
            $this->session->set_userdata('sub_menu', 'subjectpaper/index');            
            
            $data['title']            = 'Add Subject Paper';
            $data['title_list']       =  'Recent Subject Paper';
            $subjectpaper_result      = $this->Subjectpaper_model->get();
            $data['subjectpaperList'] = $subjectpaper_result;
            $subjects                 = $this->Subjectpaper_model->getSubjects();
            $data['subpaperlist']     = $this->Subjectpaper_model->subpaperlist();

            $data['subjects'] = $subjects;
            $this->load->view('layout/header');
            $this->load->view('admin/subjectpaper/subjectpaperList', $data);
            $this->load->view('layout/footer');
            }
            
            
            function create() {
            if (!$this->rbac->hasPrivilege('subject_paper', 'can_add')) {
            access_denied();
            }
            $data['title'] = 'Add Subject Paper'; 
            $this->form_validation->set_rules('subjectid', $this->lang->line('subjectid'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papercode', $this->lang->line('papercode'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papername', $this->lang->line('papername'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papertype', $this->lang->line('papertype'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('te_max_marks', 'te_max_marks', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ce_max_marks', 'ce_max_marks', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
            $subjectpaper_result = $this->Subjectpaper_model->get();
            $data['subjectpaperList'] = $subjectpaper_result;
            $subjects = $this->Subjectpaper_model->getSubjects();
            $data['subjects'] = $subjects;
            $this->load->view('layout/header');
            $this->load->view('admin/subjectpaper/subjectpaperList', $data);
            $this->load->view('layout/footer');
            } else {
            $data = array(
            'subjectpaper_subjectid'     => $this->input->post('subjectid'),
            'subjectpaper_papercode'     => $this->input->post('papercode'),
            'subjectpaper_papername'     => $this->input->post('papername'),
            'subjectpaper_arabicpaper'   => $this->input->post('arabic_papername'),


            'subjectpaper_papertype'     => $this->input->post('papertype'),
            'subjectpaper_parentsubject' => $this->input->post('parentsubject'),
            'subjectpaper_credit'        => $this->input->post('credit'),
            'subjectpaper_session'       => $this->current_session,
            'subjectpaper_credithours'   => $this->input->post('credithours'),
            
            'subjectpaper_ce_max_mrks'   => $this->input->post('ce_max_marks'),
            'subjectpaper_te_max_mrks'   => $this->input->post('te_max_marks'),
            'created_at'=> date('Y-m-d h:i:s'),
            );
            $this->Subjectpaper_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/subjectpaper/index');
            }
            }
            
            
            function edit($subjectpaper_id)
            {
            if (!$this->rbac->hasPrivilege('subject_paper', 'can_edit')) {
            access_denied();
            }
            $papertype=$this->input->post('papertype');
            if($papertype=="Compulsory")
            {
            $parent="";   
            }
            else
            {
            $parent=$this->input->post('parentsubject');  
            }
            
            $this->session->set_userdata('top_menu', 'academics');
            $this->session->set_userdata('sub_menu', 'subjectpaper/index');
            $data['title']           = 'Edit Subject Paper';
            $data['subjectpaper_id'] = $subjectpaper_id;
            $this->form_validation->set_rules('subjectid', $this->lang->line('subjectid'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papercode', $this->lang->line('papercode'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papername', $this->lang->line('papername'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('papertype', $this->lang->line('papertype'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('te_max_marks', 'te_max_marks', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ce_max_marks', 'ce_max_marks', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
            $subjectpaperedit         = $this->Subjectpaper_model->get($subjectpaper_id);
            $data['subjectpaperedit'] = $subjectpaperedit;
            $subjectpaper_result      = $this->Subjectpaper_model->get();
            $data['subjectpaperList'] = $subjectpaper_result;
            $subjects                 = $this->Subjectpaper_model->getSubjects();
            $data['subjects']         = $subjects;
            $this->load->view('layout/header');
            $this->load->view('admin/subjectpaper/subjectpaperEdit', $data);
            $this->load->view('layout/footer');
            } else {
            $data = array(
            'subjectpaper_id'              => $subjectpaper_id,
            'subjectpaper_subjectid'       => $this->input->post('subjectid'),
            'subjectpaper_papercode'       => $this->input->post('papercode'),
            'subjectpaper_papername'       => $this->input->post('papername'),
            'subjectpaper_arabicpaper'     => $this->input->post('arabic_papername'),
            'subjectpaper_papertype'       => $this->input->post('papertype'),
            'subjectpaper_parentsubject'   => $parent,
            'subjectpaper_credit'          => $this->input->post('credit'),
            'subjectpaper_session'         => $this->current_session,
            'subjectpaper_credithours'     => $this->input->post('credithours'),
            'subjectpaper_ce_max_mrks'     => $this->input->post('ce_max_marks'),
            'subjectpaper_te_max_mrks'     => $this->input->post('te_max_marks'),
            'updated_at'=> date('Y-m-d h:i:s'),
            );
            $this->Subjectpaper_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/subjectpaper/index');
            }
            }
            
            
            function delete($subjectpaper_id) 
            {
            if (!$this->rbac->hasPrivilege('subject_paper', 'can_delete')) {
            access_denied();
            }
            $data['title'] = 'Subject Paper List';
            $this->Subjectpaper_model->remove($subjectpaper_id);
            redirect('admin/subjectpaper/index');
            }
            
            
            function changestatus() {
            $subjectpaperid = $this->input->post('subjectPaperId');
            $status = $this->input->post('status');
            $success = $this->Subjectpaper_model->setStatus($subjectpaperid,$status);
            if ($success) {
            $response = array('success' => true);
            } else {
            $response = array('success' => false, 'message' => 'Failed to update status');
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            }
            
            }
            
            ?>