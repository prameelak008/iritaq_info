<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

        class Branch extends Admin_Controller {
        
        function __construct() 
        {
        parent::__construct();
        $this->load->library('Customlib');
        }
        
        
        
        
        public function index()
        {
        // if (!$this->rbac->hasPrivilege('hostel', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Branch');
        $this->session->set_userdata('sub_menu', 'branch/index');
        //$listhostel = $this->hostel_model->listhostel();
        // $data['listhostel'] = $listhostel;
        // $ght = $this->customlib->getHostaltype();
        // $data['ght'] = $ght;
        
        $data['branch_list']    =     $this->branch_model->branch_list();
        $this->load->view('layout/header');
        $this->load->view('branch/branch/create', $data);
        $this->load->view('layout/footer');
        }
        
    
    

        function create() 
        {
        if (!$this->rbac->hasPrivilege('branch', 'can_add')) {
        access_denied();
        }
        
        $data['title'] = 'Add Branch';
        $this->form_validation->set_rules('branch_name', $this->lang->line('branch_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('branch_code', $this->lang->line('branch_code'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('affiliation', $this->lang->line('affiliation'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('school_name', $this->lang->line('school_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('city', $this->lang->line('city'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('state', $this->lang->line('state'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile_no', $this->lang->line('mobile_no'), 'trim|required|xss_clean');
        $data['branch_list']    =     $this->branch_model->branch_list();
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('layout/header');
        $this->load->view('branch/branch/create',$data);
        $this->load->view('layout/footer');
        } 
        else
        {
            
         $id              =   $this->input->post('branch_id');
         $data = array(
        'branch_name'    =>  $this->input->post('branch_name'),
        'branch_code'    =>  $this->input->post('branch_code'),
        'affiliation'    =>  $this->input->post('affiliation'),
        'school_name'    =>  $this->input->post('school_name'),
        'contact'        =>  $this->input->post('mobile_no'),
        'city'           =>  $this->input->post('city'),
        'state_province' =>  $this->input->post('state'),
        'address'        =>  $this->input->post('address'),
        'country'        =>  $this->input->post('country'),
        );
        
        if($id)
        {
        $data['updated_at'] = date('d-m-Y H:i:s');
        $this->db->where('branch_id', $id);
        $this->db->update('branch', $data);
        $daat=array(
        'branch_id' => $id,
        'password'  => $this->enc_lib->passHashEnc($this->input->post('password')),
        'email'     => $this->input->post('email'));
        $this->db->where('branch_id', $id);
        $this->db->update('staff', $daat);
        }
        else
        {
        $data['type']       = 'Branch'; 
        $data['created_at'] = date('d-m-Y H:i:s');    
        $res                = $this->branch_model->add($data);
        $dat=array(
        'employee_id'=> 'BRANCH'.'0'.$res,
        'name'       => 'Admin',
        'branch_id'  =>  $res,
        'password'   =>  $this->enc_lib->passHashEnc($this->input->post('password')),
        'email'      =>  $this->input->post('email'));
         $this->db->insert('staff',$dat);
         $stafinsert_id  =  $this->db->insert_id();
         
         $dt  =array(
             'st_branch'=> $res,
             'st_staff' => $stafinsert_id
             );
         $this->db->insert('staff_branch',$dt);
         }
         
         $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
         redirect($_SERVER['HTTP_REFERER']);
        }
        }
        
        
    
    
        public function get_data($branchId)
        {
        $branchData = $this->branch_model->getBranchDataById($branchId);
        if($branchData) {
        echo json_encode($branchData);
        } 
        else
        {
        echo json_encode(array('error'=>'Failed'));
        }
        }


        public function delete_data($branchId)
        {
        $data=array('isactive'=>0);
        $this->db->where('branch_id', $branchId);
        $result=$this->db->update('branch', $data); 
        
        $dat=array('is_active'=>0);
        $this->db->where('branch_id', $branchId);
        $result=$this->db->update('staff', $dat); 
        
        if ($result) 
        {
        echo json_encode(array('message' => 'Deleted SuccessFully'));
        } 
        else
        {
        echo json_encode(array('error' => 'Failed to update'));
        }
        }
    
    
    
    
    
    
    
    

    function edit($id) {
        if (!$this->rbac->hasPrivilege('hostel', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Add Hostel';
        $data['id'] = $id;
        $edithostel = $this->hostel_model->get($id);
        $data['edithostel'] = $edithostel;
        $ght = $this->customlib->getHostaltype();
        $data['ght'] = $ght;
        $this->form_validation->set_rules('hostel_name', $this->lang->line('hostel_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', $this->lang->line('type'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listhostel = $this->hostel_model->listhostel();
            $data['listhostel'] = $listhostel;
            $this->load->view('layout/header');
            $this->load->view('admin/hostel/edithostel', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'hostel_name' => $this->input->post('hostel_name'),
                'type' => $this->input->post('type'),
                'address' => $this->input->post('address'),
                'intake' => $this->input->post('intake'),
                'description' => $this->input->post('description')
            );
            $this->hostel_model->addhostel($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
            redirect('admin/hostel/index');
        }
    }
    

    function delete($id) {
        if (!$this->rbac->hasPrivilege('hostel', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->hostel_model->remove($id);
        redirect('admin/hostel/index');
    }
    
    

}

?>