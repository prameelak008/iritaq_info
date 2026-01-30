<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Template extends Admin_Controller
{

        public function __construct()
        {
        parent::__construct();
        }
        
        public function index()
        {
            
        if (!$this->rbac->hasPrivilege('template', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'entrance_settings');
        $this->session->set_userdata('sub_menu', 'entrance_settings/template/');
        
        
        $data['title']      = 'Template';
        
        $data['template']   =   $this->Entrance_settings_model->settings_template();
        $this->load->view('layout/headerentrance',$data);
        $this->load->view('entrance_settings/template/index', $data);
        $this->load->view('layout/footer');
        }
        
        
        
        
        
        
        public function delete($id)
        {
        if (!$this->rbac->hasPrivilege('expense_head', 'can_delete')) {
        access_denied();
        }
        
        $data['title'] = 'Template';
        $this->db->where(array('set_template_id'=>$id));
        $this->db->delete('entrance_settings_template');
        redirect('entrance_settings/template/index');
        }
        
        
        
        public function create()
        {
        // if (!$this->rbac->hasPrivilege('expense_head', 'can_add')) {
        //     access_denied();
        // }
        //$data['title']        = 'Add Expense Head';
        
        
        
        // $category_result      = $this->expensehead_model->get();
        
        //$data['categorylist'] = $category_result;
        
        $this->form_validation->set_rules('templatename', $this->lang->line('templatename'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) {
       $this->load->view('layout/headerentrance',$data);
        $this->load->view('entrance_settings/template/index', $data);
        $this->load->view('layout/footer', $data);
        } 
        else
        {
        $data = array(
        'set_template_name' => $this->input->post('templatename'),
        'set_template_instruction'  => $this->input->post('instruction'),
        );
        $this->db->insert('entrance_settings_template',$data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect('entrance_settings/template/');
        }
        }
    
    
    
    
    

            public function edit($id)
            {
                
                
            if (!$this->rbac->hasPrivilege('template', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_settings');
            $this->session->set_userdata('sub_menu', 'entrance_settings/template/');
            
            
            
            $data['title']        = 'Edit Template';
            
            $data['template']     =  $this->Entrance_settings_model->settings_template();
            
            $data['id']           =  $id;
            
            $data['tempval']      =  $this->Entrance_settings_model->get_temp_byval($id);
            
            
            $this->form_validation->set_rules('templatename', $this->lang->line('templatename'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('instruction', $this->lang->line('instruction'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) 
            {
            
            
            $this->load->view('layout/headerentrance',$data);
            $this->load->view('entrance_settings/template/edit_data', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            $data = array(
            'set_template_name' => $this->input->post('templatename'),
            'set_template_instruction'  => $this->input->post('instruction'));
            
            $cond=array('set_template_id'=>$id);
            $this->db->where($cond);
            $this->db->update('entrance_settings_template',$data);
            
            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('update_message') . '</div>');
            redirect('entrance_settings/template/');
            }
            }

}
