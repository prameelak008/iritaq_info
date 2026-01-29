        <?php

        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }


        class Batchduration  extends Admin_Controller
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
        $this->session->set_userdata('sub_menu', 'setduration/index');

        $data['title']      = 'Semester';
        $data['title_list'] = 'Set Duration';     
        $this->form_validation->set_rules('bt_from_date', $this->lang->line('bt_from_date'), 'trim|required|xss_clean');
        $id                 = $this->input->post('batch_duration_id');
     
        // $this->form_validation->set_rules('sem_program_type', $this->lang->line('sem_program_type'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('sem_programe', $this->lang->line('sem_programe'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('sem_batch_type', $this->lang->line('sem_batch_type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('bt_from_date', $this->lang->line('bt_from_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('bt_to_date', $this->lang->line('bt_to_date'), 'trim|required|xss_clean');
       
       
        $data['Programmetype_list'] =   $this->Programmetype_model->get();
         
        $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();  

        $data['programs']               = $this->Semester_enrollment_model->get_program_list();          
       
        if ($this->form_validation->run() == false)
        {
        } 
        else 
        {    

        if($id=="")
        {             
        $data                   =  array(
        // 'semester'              => $this->input->post('semester_type'),
        // 'program'               => $this->input->post('sem_programe'),      
        // 'batch'                 => $this->input->post('sem_batch_type'), 
        
        
        'program'               => $this->input->post('progm_id'),         
        'batch'                 => $this->input->post('batch_type'),        
        'fromdate'              => $this->input->post('bt_from_date'),
        'todate'                => $this->input->post('bt_to_date'),                   
        'createddate'           => date('Y-m-d H:i:s'),
        'session'               => $this->current_session
        );
        $this->Batch_duration_model->add($data);
        }
        else
        { 
        $data                   =  array(
        'id'                    => $id,      
        // 'semester'              => $this->input->post('semester_type'),
        // 'program'               => $this->input->post('sem_programe'),
        // 'batch'                 => $this->input->post('sem_batch_type'), 
        'program'               => $this->input->post('progm_id'), 
        'batch'                 => $this->input->post('batch_type'),                      
        'fromdate'              => $this->input->post('bt_from_date'),
        'todate'                => $this->input->post('bt_to_date'),                   
        // 'updateddate'           => date('Y-m-d H:i:s'),
        'session'               => $this->current_session                
        );
        $this->Batch_duration_model->add($data);
        } 
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect('semester/Setduration/index');
        } 

        $this->load->view('layout/header', $data);
        $this->load->view('semester/tab', $data);
        // $this->load->view('semester/prog_setduration/add_data', $data);
        $this->load->view('layout/footer', $data);
        }   



        public function delete($id)
        {
        // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
        // access_denied();
        // }
        // $data['title']       = 'set Duration Details';
        // $this->Batch_duration_model->remove($id);
        // redirect($_SERVER['HTTP_REFERER']); 

        header('Content-Type: application/json'); // tell browser this is JSON

        $tab                 = "batch_duration";
        $condition           =  array('id'=>$id);
        $deleted             = $this->Room_allocation_model->delete_data($tab, $condition);
        echo json_encode(['success' => (bool)$deleted]); // return JSON
        exit; 
        }                    


        public function update_status()
        {
        $id              = $this->input->post('id');
        $status          = $this->input->post('status');
        $data            = array('status' => $status);
        $this->db->where('id', $id);
        if ($this->db->update('batch_duration', $data))
        {
        echo json_encode(array('status' => 'success'));
        } 
        else
        {
        echo json_encode(array('status' => 'error'));
        }
        }



        public function get_data($durationid)
        {
        $duraData = $this->Set_duration_model->getDuartionbyId($durationid);
        if($duraData) {
        echo json_encode($duraData);
        } 
        else
        {
        echo json_encode(array('error'=>'Failed'));
        }  
        }



        // public function add_data()
        // {
        // $this->form_validation->set_rules('programee_category', $this->lang->line('programee_category'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('date_from', $this->lang->line('date_from'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('date_to', $this->lang->line('date_to'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('No_of_Semester', $this->lang->line('No_of_Semester'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('No_of_Months', $this->lang->line('No_of_Months'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('No_of_Days', $this->lang->line('No_of_Days'), 'trim|required|xss_clean');

        // $programme_id           = $this->input->post('programme_id');

        // if ($this->form_validation->run() == false)
        // {
        // $array = array('status' => 'fail', 'error' => $msg, 'message' => '');    
        // } 
        // else 
        // { 

        // if($programme_id=="")
        // {
        //  $data                   =  array(
        // 'programee_id'          => $this->input->post('programee_category'),
        // 'date_from'             => $this->input->post('date_from'),
        // 'date_to'               => $this->input->post('date_to'),
        // 'no_of_semester'        => $this->input->post('No_of_Semester'),
        // 'no_of_months'          => $this->input->post('No_of_Months'),
        // 'no_of_days'            => $this->input->post('No_of_Days'),
        // 'createddate'           => date('Y-m-d H:i:s'),
        // 'session'               => $this->current_session
        // );
        // $this->Set_duration_model->add($data);
        // }
        // else
        // {
        //  $data                   =  array(
        // 'programee_id'          => $this->input->post('programee_category'),
        // 'date_from'             => $this->input->post('date_from'),
        // 'date_to'               => $this->input->post('date_to'),
        // 'no_of_semester'        => $this->input->post('No_of_Semester'),
        // 'no_of_months'          => $this->input->post('No_of_Months'),
        // 'no_of_days'            => $this->input->post('No_of_Days'),
        // 'updateddate'           => date('Y-m-d H:i:s'),
        // 'session'               => $this->current_session );
        // $this->db->where(array('id'=>$programme_id));
        // $this->db->update('set_duration', $data);  
        // }                   

        // $msg   = $this->lang->line('success_message');
        // $array = array('status' => 'success', 'error' => '', 'message' => $msg);
        // }
        // echo json_encode($array);
        // }




        public function get_batchduration_by_id($id)
        {
        $Data = $this->Batch_duration_model->get($id);
        
        if($Data) {
        echo json_encode($Data);
        } 
        else
        {
        echo json_encode(array('error'=>'Failed'));
        } 
        }

        }
