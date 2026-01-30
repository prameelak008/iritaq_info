<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_category extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    

        public function index()
        {
        if (!$this->rbac->hasPrivilege('section', 'can_view')) {
            access_denied();
        }
        
        
       
       $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'Attendance/leave_category');
        
        $data['title']        = 'Category List';
        $category_result      = $this->leavecategory_model->get();
        $data['categorylist'] = $category_result;
        $this->form_validation->set_rules('category', $this->lang->line('category'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/leave_category/categorylist', $data);
            $this->load->view('layout/footer', $data);
        } 
        else 
        {
            
            
            $data = array(
                'leave_category_name' => $this->input->post('category'),
                'leave_category_description' => $this->input->post('description'),
                'leave_category_shortname' => $this->input->post('shortname'),
                'leave_category_favcolor' => $this->input->post('favcolor'),
                
                
            );
            $this->leavecategory_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/leave_category/index');
        }
        }

        public function delete($id)
        {
        if (!$this->rbac->hasPrivilege('section', 'can_delete')) 
        {
            access_denied();
        }
        
        
        
        
        $data['title'] = 'Category List';
        
        
                $this->db->where(array('leave_catmanagement_category' => $id));      
                $q 		    = $this->db->get('leave_catmanagement');
                if ($q->num_rows() > 0) 
                {
                $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
                }
                else
                {
                $this->leavecategory_model->remove($id);
                $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
                }
                redirect('admin/leave_category/index');
        }
	
	
	

   

        public function edit($id)
        {
        if (!$this->rbac->hasPrivilege('section', 'can_edit'))
        {
            access_denied();
        }
        $data['title']        = 'Category List';
        $category_result      = $this->leavecategory_model->get();
        $data['categorylist'] = $category_result;
        $data['title']        = 'Edit Category';
        $data['id']           = $id;
        $category             = $this->leavecategory_model->get($id);
        $data['category']     = $category;
        $this->form_validation->set_rules('category', $this->lang->line('category'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/leave_category/categoryedit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'leave_category_id'      => $id,
                'leave_category_name' => $this->input->post('category'),
                'leave_category_description' => $this->input->post('description'),
                'leave_category_shortname' => $this->input->post('shortname'),
                'leave_category_favcolor' => $this->input->post('favcolor'),
                );
            $this->leavecategory_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/leave_category/index');
        }
        }
        
        

}
