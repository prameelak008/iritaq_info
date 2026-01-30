<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examfeescharge extends Admin_Controller {

    function __construct() {
        parent::__construct();
         $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('examfees_charge', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examfeescharge');
        $data['title'] = 'Add Exam Fees Charge';
        $data['title_list'] = 'Recent Exam Fees Charge';
        $examfeescharge_result = $this->Examfeescharge_model->get();
        $data['examfeeschargeList'] = $examfeescharge_result;
        $examgroups = $this->Examfeescharge_model->getExamgroups();
        $data['examgroups'] = $examgroups;
        $this->load->view('layout/header');
        $this->load->view('admin/examfeescharge/examfeeschargeList', $data);
        $this->load->view('layout/footer');
    }
    


    function create() 
    {
        if (!$this->rbac->hasPrivilege('examfees_charge', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add Exam Fees Charge'; 
        $this->form_validation->set_rules('examoption', $this->lang->line('examoption'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('examgroups_id', $this->lang->line('examgroups_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('examtype', $this->lang->line('examtype'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('feescharge', $this->lang->line('feescharge'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('processingcharge', $this->lang->line('processingcharge'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $examgroups = $this->Examfeescharge_model->getExamgroups();
            $data['examgroups'] = $examgroups;
            $examfeescharge_result = $this->Examfeescharge_model->get();
            $data['examfeeschargeList'] = $examfeescharge_result;
            $this->load->view('layout/header');
            $this->load->view('admin/examfeescharge/examfeeschargeList', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                // 'examfees_charge_id' => $examfees_charge_id,
                'examfees_charge_examoption' => $this->input->post('examoption'),
                'examfees_charge_sessionid' => $this->setting_model->getCurrentSession(),
                'examfees_charge_examgroup' => $this->input->post('examgroups_id'),
                'examfees_charge_exam' => $this->input->post('exam_id'),
                'examfees_charge_examtype' => $this->input->post('examtype'),
                'examfees_charge_fees_charge' => $this->input->post('feescharge'),
                'examfees_charge_processing_charge' => $this->input->post('processingcharge'),
                'examfees_charge_fine' => $this->input->post('fine'),
                'examfees_charge_effectivedate' => $this->input->post('lastdate'));
                
            $this->Examfeescharge_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/examfeescharge/index');
        }
    }


    function edit($examfees_charge_id) 
    {
        if (!$this->rbac->hasPrivilege('examfees_charge', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'admin/examfeescharge');
        $data['title'] = 'Edit Exam Fees Charge';
        $data['examfees_charge_id'] = $examfees_charge_id;
        $this->form_validation->set_rules('examoption', $this->lang->line('examoption'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('examgroups_id', $this->lang->line('examgroups_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('examtype', $this->lang->line('examtype'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('feescharge', $this->lang->line('feescharge'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('processingcharge', $this->lang->line('processingcharge'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('active', $this->lang->line('active'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $examgroups = $this->Examfeescharge_model->getExamgroups();
            $data['examgroups'] = $examgroups;
            $examchargeedit = $this->Examfeescharge_model->get($examfees_charge_id);
            $data['examchargeedit'] = $examchargeedit;
            $examfeescharge_result = $this->Examfeescharge_model->get();
            $data['examfeeschargeList'] = $examfeescharge_result;
            $this->load->view('layout/header');
            $this->load->view('admin/examfeescharge/examfeeschargeEdit', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'examfees_charge_id' => $examfees_charge_id,
                'examfees_charge_examoption' => $this->input->post('examoption'),
                'examfees_charge_examgroup' => $this->input->post('examgroups_id'),
                'examfees_charge_exam' => $this->input->post('exam_id'),
                'examfees_charge_examtype' => $this->input->post('examtype'),
                'examfees_charge_fees_charge' => $this->input->post('feescharge'),
                'examfees_charge_processing_charge' => $this->input->post('processingcharge'),
                'examfees_charge_exam_is_active' => $this->input->post('active'),
                'examfees_charge_fine' => $this->input->post('fine'),
                'examfees_charge_effectivedate' => $this->input->post('lastdate'));
            $this->Examfeescharge_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/examfeescharge/index');
        }
    }



    function delete($examfees_charge_id)
     {
        if (!$this->rbac->hasPrivilege('examfees_charge', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Exam Fees Charge List';
        $this->Examfeescharge_model->remove($examfees_charge_id);
        redirect('admin/examfeescharge/index');
    }


    function selectexam()
    {
    $examgroups_id = $this->input->POST('examgroups_id');
    $data          = $this->Examfeescharge_model->examgroupgetExam($examgroups_id);
    echo json_encode($data); 
    }

}

?>