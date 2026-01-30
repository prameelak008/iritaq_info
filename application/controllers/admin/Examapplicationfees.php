<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

    class Examapplicationfees extends Admin_Controller
    {

    public $exam_type            = array();
    private $sch_current_session = "";



        public function __construct()
        {
        parent::__construct();
        $this->load->library('encoding_lib');
        $this->load->library('mailsmsconf');
        $this->exam_type           = $this->config->item('exam_type');
        $this->sch_current_session = $this->setting_model->getCurrentSession();
        $this->attendence_exam     = $this->config->item('attendence_exam');
        $this->sch_setting_detail  = $this->setting_model->getSetting();
        $this->current_session = $this->setting_model->getCurrentSession();
        }

     
     
     
        public function index() 
        {
        // if (!$this->rbac->hasPrivilege('revaluation', 'can_view')) 
        // {
        // access_denied();
        // }      
        
        
        $this->session->set_userdata('top_menu', 'Online_Examinations');
        $this->session->set_userdata('sub_menu', 'Online_Examinations/examapplicationfees');
        
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        
        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        
        $class                  = $this->class_model->get();
        $data['title'] = 'Exam Application';
        $data['title_list'] = 'Exam Application';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        
        $data['current_session']=  $this->current_session;
        
        if ($this->form_validation->run() == false) 
        {
        
        } 
        else
        {
        
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        
        $marksheet_template = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        $exam_details = $this->examgroup_model->getExamByID($exam_id);        
        
        $data['getsubjectdetails'] = $this->examresult_model->getapplication_subjectdetails($exam_id, $exam_group_id,$class_id, $section_id,$session_id);
        
        $data['getfeedetails']     = $this->examresult_model->getfeedetails();
        
        $getsubjects               = $data['getsubjectdetails'];
        $data['applicationfee']    = $this->examresult_model->applicationfee($exam_id, $exam_group_id,$class_id, $section_id,$session_id);
        
        $data['exam_group_id']=$exam_group_id;
        $data['exam_id']=$exam_id;
        $data['class_id']=$class_id;
        $data['section_id']=$section_id;
        $data['session_id']=$session_id;
        } 
        
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/applicationfeesubject/index', $data);
        $this->load->view('layout/footer', $data);
        } 




            // function addapplicationfees()
            // {
            // $applicationfee      = $this->input->post('applicationfee');
            // $application_finefee = $this->input->post('application_finefee'); 
            // $marklistfee         = $this->input->post('marklistfee');
            // $evaluationcampfee   = $this->input->post('evaluationcampfee');
            // $exam_group_in       = $this->input->post('exam_group_in');
            // $exam_in             = $this->input->post('exam_in');
            // $class_in            = $this->input->post('class_in');
            // $section_in          = $this->input->post('section_in');
            // $session_in          = $this->input->post('session_in');
            // $paymenttitle        = $this->input->post('paymenttitle');
            // $paymentterms        = $this->input->post('paymentterms');
            // $processingfees      = $this->input->post('processingfees');
            // $finedate            = $this->input->post('finedate');
            // $appfine_id          = $this->input->post('applicationfee_id');
            
            // $this->db->where('application_examfee_examgroup',$exam_group_in);
            // $this->db->where('application_examfee_examgroupbatch',$exam_in);        
            // $this->db->where('application_examfee_class',$class_in);
            // $this->db->where('application_examfee_section',$section_in);
            // $this->db->where('application_examfee_session',$session_in);
            // $q  =   $this->db->get('application_examfee');
            
            // if ( $q->num_rows() > 0 ) 
            // {        
            // $condition          = array('application_examfee_examgroup' =>    $exam_group_in,
            // 'application_examfee_examgroupbatch'  =>    $exam_in,
            // 'application_examfee_class'           =>    $class_in,
            // 'application_examfee_section'         =>    $section_in,
            // 'application_examfee_session'         =>    $session_in);
            
            
            // $data               = array('application_examfee_fees' =>    $applicationfee,
            // 'application_examfee_finefees'        =>       $application_finefee,
            // 'application_examfee_marklistfee'      =>      $marklistfee,
            // 'application_examfee_paymenttitle'      =>     $paymenttitle,
            // 'application_examfee_paymentterms'      =>     $paymentterms,         
            // 'application_examfee_evaluationcampfee' =>     $evaluationcampfee,
            // 'application_examfee_finedate'          =>     $finedate,
            // 'application_examfee_processingfees'    =>     $processingfees
            // );
            
            // $this->db->where($condition);
            // $this->db->update('application_examfee', $data);
            // $this->db->delete($tb1,$data);
            // }
            // else
            // {
            // $data                                   =     array(                                                                
            // 'application_examfee_examgroup'         =>    $exam_group_in,
            // 'application_examfee_examgroupbatch'    =>    $exam_in,
            // 'application_examfee_class'             =>    $class_in,
            // 'application_examfee_section'           =>    $section_in,
            // 'application_examfee_session'           =>    $session_in,
            // 'application_examfee_fees'              =>    $applicationfee,
            // 'application_examfee_finefees'          =>     $application_finefee,
            // 'application_examfee_marklistfee'       =>    $marklistfee,
            // 'application_examfee_paymenttitle'      =>    $paymenttitle,
            // 'application_examfee_paymentterms'      =>    $paymentterms,
            // 'application_examfee_evaluationcampfee' =>     $evaluationcampfee,
            // 'application_examfee_finedate'          =>     $finedate,
            // 'application_examfee_processingfees'    =>  $processingfees); 
            // $this->db->insert('application_examfee', $data);
            // }
            // redirect($_SERVER['HTTP_REFERER']);
            // }
            
            
                function addapplicationfees()
                {       
                $applicationfee      = $this->input->post('applicationfee');
                $application_finefee = $this->input->post('application_finefee'); 
                $marklistfee         = $this->input->post('marklistfee');
                $evaluationcampfee   = $this->input->post('evaluationcampfee');
                $exam_group_in       = $this->input->post('exam_group_in');
                $exam_in             = $this->input->post('exam_in');
                $class_in            = $this->input->post('class_in');
                $section_in          = $this->input->post('section_in');
                $session_in          = $this->input->post('session_in');
                $paymenttitle        = $this->input->post('paymenttitle');
                $paymentterms        = $this->input->post('paymentterms');
                $processingfees      = $this->input->post('processingfees');
                $finedate            = $this->input->post('finedate');
                $appfine_id          = $this->input->post('applicationfee_id'); // Unique ID for update
                
                // Prepare the data
                $data = array(
                'application_examfee_fees'             => $applicationfee,
                'application_examfee_finefees'         => $application_finefee,
                'application_examfee_marklistfee'      => $marklistfee,
                'application_examfee_paymenttitle'     => $paymenttitle,
                'application_examfee_paymentterms'     => $paymentterms,
                'application_examfee_evaluationcampfee'=> $evaluationcampfee,
                'application_examfee_finedate'         => $finedate,
                'application_examfee_processingfees'   => $processingfees,
                'application_examfee_examgroup'        => $exam_group_in,
                'application_examfee_examgroupbatch'   => $exam_in,
                'application_examfee_class'            => $class_in,
                'application_examfee_section'          => $section_in,
                'application_examfee_session'          => $session_in,
                );
                
                if (!empty($appfine_id)) 
                {
                // Update existing record
                $this->db->where('application_examfee_id', $appfine_id);
                $this->db->update('application_examfee', $data);
                } else {
                // Insert new record
                $this->db->insert('application_examfee', $data);
                }
                redirect($_SERVER['HTTP_REFERER']);
                }


       
        
        
            function getfees() 
            {
            $subj_id        = $this->input->post('subj_id');
            $exam_group_id  = $this->input->post('exam_group_id');
            $exam_id        = $this->input->post('exam_id');
            $session_id     = $this->input->post('session_id');
            $class_id       = $this->input->post('class_id');
            $section_id     = $this->input->post('section_id');
            $fees           = $this->input->post('fees');
            $finefees       = $this->input->post('finefees');
            $subj_code      = $this->input->post('subj_code');
            $fid            = $this->input->post('fid'); // Check if the record already exists
            
            for ($i = 0; $i < count($subj_id); $i++) {
            $data = array(
            'application_fees_subjectid'      => $subj_id[$i],
            'application_fees_examgroup'      => $exam_group_id[$i],
            'application_fees_examgroupbatch' => $exam_id[$i],
            'application_fees_class'          => $class_id[$i],
            'application_fees_section'        => $section_id[$i],
            'application_fee_session'         => $session_id[$i],
            'application_fees_fees'           => $fees[$i],
            'application_fees_finefees'       => $finefees[$i],
            'application_fees_category'       => $subj_code[$i]
            );
            
            if (!empty($fid[$i])) {
            // Update the record if $fid exists
            $this->db->where('application_fees_id', $fid[$i]);
            $this->db->update('application_fees', $data);
            } else {
            // Insert a new record if $fid does not exist
            $this->db->insert('application_fees', $data);
            }
            }
            redirect('admin/examapplicationfees/index');
            }



        }




    
       

