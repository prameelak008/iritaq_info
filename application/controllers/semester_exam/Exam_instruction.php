            <?php

            if (!defined('BASEPATH'))
            {
            exit('No direct script access allowed');
            }


            class Exam_instruction extends Admin_Controller
            {    


            public function __construct()
            {
            parent::__construct();
            $this->config->load('app-config');
            $this->sch_setting_detail = $this->setting_model->getSetting();
            $this->config->load("mailsms");
            $this->load->library('mailsmsconf');
            $this->current_session = $this->setting_model->getCurrentSession();        
            $this->exam_options    = $this->customlib->getExamOptions(); 
            $this->getExamType     = $this->customlib->getExamType();        
            }



            
            public function index()
            {
            $this->current_session = $this->setting_model->getCurrentSession();
            $this->session->set_userdata('top_menu', 'semester_exam');


            $data['title']                 =  'Instruction';
            $data['online_instructon']     =   $this->onlineexam_model->online_instruction();
            $examgroup_result              =   $this->examgroup_model->get();
            $data['examgrouplist']         =   $examgroup_result; 
            $get_instruction               =   $this->Semesterexam_model->get_instruction();
            $data['get_instruction']       =   $get_instruction;

            $data['Programmetype_list']    =   $this->Programmetype_model->get();
            $data['semestertype_list']     =   $this->Semestertype_model->getdata();
            // $data['batchlist']           = $this->Batch_model->batchlist();
            $data['batch_group']           =   $this->Batchtype_model->get_batchgroup(); 
            $data['semester_term']         =   $this->Set_duration_model->get_semester_term(); 
            
            $sem_group_id                  =   $this->input->post('sem_type');

            // $sem_group_id                  =   $this->input->post('sem_group_id'); 
            $get_exam_subjects             =   $this->Semesterexam_model->get_exam_subjects($sem_group_id);
            $data['exam_subjects']         =   $get_exam_subjects;


            $get_instructiondetails         =   $this->Semesterexam_model->get_instructiondetails();
            $data['get_instructiondetails'] =   $get_instructiondetails;

            $data['sem_group_id']          =   $sem_group_id;
            $data['inst_title']            =   $this->input->post('fee_exam_type');

            $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group'), 'trim|required|xss_clean');

            $data['exam_options']          =   $this->exam_options;
            $data['getExamType']           =   $this->getExamType;  
            
             $data['programs']           =   $this->Semester_enrollment_model->get_program_list(); 

            // $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            //     $data['programs']                   = $this->Semester_enrollment_model->get_programs();

                // // Semesters, batches, and terms
                $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();
                // $data['subject_groups']             = $this->Assignsubjects_model->get_subjectgroups(); 

            if ($this->form_validation->run() == false) 
            {            
            $this->load->view('layout/header', $data);
            $this->load->view('semester_exam/exam_instruction/sectionList', $data);
            $this->load->view('layout/footer', $data);      
            } 
            else
            {                
                
            $lastdate                       = $this->input->post('exam_end'); 
            $closingdate                    = $this->input->post('closing_date');
            $newDate                        = date("d-m-Y", strtotime($lastdate));
            $closingdate                    = date("d-m-Y", strtotime($closingdate));

            if (isset($_POST['active_status']))
            {
            $is_status = 1;
            } 
            else
            {
            $is_status = 0;
            } 

            $exam_group_id    = $this->input->post('exam_group_id');
            $exam_id          = $this->input->post('exam_id');
            $exam_option      = $this->input->post('exam_option');
            $exam_type        = $this->input->post('exam_type');

            $this->db->where('sem_exam_examgroup', $exam_group_id);  
            $this->db->where('sem_exam_examid', $exam_id);
            $this->db->where('sem_exam_option', $exam_option); 
            $this->db->where('sem_exam_optiontype', $exam_type); 

            $query                               = $this->db->get('sem_exam_instruction');

            if ($query->num_rows() > 0) 
            {
            $data                                = array(
            'sem_exam_title'                     => $this->input->post('exam_title'),          
            // 'sem_exam_option'                    => $this->input->post('exam_option'),
            // 'sem_exam_optiontype'                => $this->input->post('exam_type'),
            
            'sem_exam_Examcommencement'          => $this->input->post('exam_start'),
            'sem_exam_last_date_fee_withoutfine' => $this->input->post('fine_details'),
            'sem_exam_last_date_fee_withoutfine' => $this->input->post('no_fine_details'),
            'sem_exam_class_leave_for_studying'  => $this->input->post('class_leave'),       
            'sem_exam_fee_details'               => $this->input->post('fee_details'),
            'sem_exam_mode_of_payment'           => $this->input->post('payment_mode'),
            'sem_exam_declaration'               => $this->input->post('declaration'),
            'sem_exam_lasdate_of_exam'           => $newDate,
            'sem_exam_is_status'                 => $is_status,
            'sem_exam_publishdate'               => date("d-m-Y", strtotime($this->input->post('publish_date'))),
            'sem_exam_closingdate_of_exam'       => $closingdate,
            'sem_exam_closetime'                 => $this->input->post('closing_time'),
            'sem_exam_closemessage'              => $this->input->post('close_message'),
            'sem_exam_remarksafterpayment'       => $this->input->post('payment_remarks'),         
            'sem_exam_updateddate'               => date('d-m-y'),  
            );
            $this->db->where('sem_exam_examgroup', $fee_exam_type);
            $this->db->where('sem_exam_examid', $fee_exam_type); 
            $this->db->where('sem_exam_option', $exam_option); 
            $this->db->where('sem_exam_optiontype', $exam_type); 
            $this->db->update('sem_exam_instruction', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('already_exists') . '</div>');   

            }
            else
            {        

            $data = array(
            'sem_exam_title'                     => $this->input->post('exam_title'),
            'sem_exam_examgroup'                 => $this->input->post('exam_group_id'),
            'sem_exam_examid'                    => $this->input->post('exam_id'),
             'sem_exam_Examcommencement'         => $this->input->post('exam_start'),
            'sem_exam_option'                    => $this->input->post('exam_option'),
            'sem_exam_optiontype'                => $this->input->post('exam_type'),  
            'sem_exam_last_date_fee_withoutfine' => $this->input->post('fine_details'),
            'sem_exam_last_date_fee_withoutfine' => $this->input->post('no_fine_details'),
            'sem_exam_class_leave_for_studying'  => $this->input->post('class_leave'),       
            'sem_exam_fee_details'               => $this->input->post('fee_details'),
            'sem_exam_mode_of_payment'           => $this->input->post('payment_mode'),
            'sem_exam_declaration'               => $this->input->post('declaration'),
            'sem_exam_lasdate_of_exam'           => $newDate,
            'sem_exam_is_status'                 => $is_status,
            'sem_exam_publishdate'               => date("d-m-Y", strtotime($this->input->post('publish_date'))),
            'sem_exam_closingdate_of_exam'       => $closingdate,
            'sem_exam_closetime'                 => $this->input->post('closing_time'),
            'sem_exam_closemessage'              => $this->input->post('close_message'),
            'sem_exam_remarksafterpayment'       => $this->input->post('payment_remarks'),         
            'sem_exam_createddate'               => date('d-m-y'),  
            );       
            $this->db->insert('sem_exam_instruction',$data); 
            }
            redirect($_SERVER['HTTP_REFERER']); 
            }        
            }



            public function save_fees()        
            {
            $this->current_session = $this->setting_model->getCurrentSession();
            $this->session->set_userdata('top_menu', 'Online_Examinations');
            $data['title']                 =  'Instruction';
            $get_instruction               =  $this->Semesterexam_model->get_instruction();
            $data['get_instruction']       =  $get_instruction;

            $this->form_validation->set_rules('fee_ex_type', $this->lang->line('fee_exam_type'), 'trim|required|xss_clean');
            $fee_exam_type                = $this->input->post('fee_ex_type');

            if ($this->form_validation->run() == false) 
            {            
            $this->load->view('layout/header', $data);
            $this->load->view('semester_exam/exam_instruction/sectionList', $data);
            $this->load->view('layout/footer', $data);      
            } 
            else
            {  

            $this->db->where('sem_fees_title', $fee_exam_type);            
            $query = $this->db->get('sem_fees_charge');

            if ($query->num_rows() > 0) 
            {
            $data = array(
            'sem_fees_fees_charge'          => $this->input->post('exam_fees'),
            'sem_fees_processing_charge'    => $this->input->post('processing_charge'),
            'sem_fees_charge_fine'          => $this->input->post('fine_amount'),
            'sem_fees_charge_effectivedate' => $this->input->post('fine_effective_date'),
            'sem_fees_without_fine_dt'      => $this->input->post('last_date_without_fine'),
            'sem_fees_with_fine_dt'         => $this->input->post('last_date_with_fine'),
            'sem_fees_updateddate'          => date('d-m-Y'),
            );

            $this->db->where('sem_fees_title', $fee_exam_type);
            $this->db->update('sem_fees_charge', $data);


            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('already_exists') . '</div>');   
            }
            else
            {
            $data = array(
            'sem_fees_title'                  => $this->input->post('fee_ex_type'),
            'sem_fees_fees_charge'            => $this->input->post('exam_fees'),
            'sem_fees_processing_charge'      => $this->input->post('processing_charge'),
            'sem_fees_charge_fine'            => $this->input->post('fine_amount'),
            'sem_fees_charge_effectivedate'   => $this->input->post('fine_effective_date'),
            'sem_fees_without_fine_dt'        => $this->input->post('last_date_without_fine'),
            'sem_fees_with_fine_dt'           => $this->input->post('last_date_with_fine'),
            'sem_fees_createddate'            => date('d-m-Y'),            
            );               
            $this->db->insert('sem_fees_charge',$data); 
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            }
            redirect($_SERVER['HTTP_REFERER']);      
            } 
            }



            public function save_subjectform()
            {
            $gt_sem_group = $this->input->post('gt_sem_group');
            $gt_sem_title = $this->input->post('gt_sem_title');
            $fees_charge  = $this->input->post('fees_charge'); // array
            $subject_id   = $this->input->post('subject_id');  // array         
            


            if (!empty($fees_charge) && !empty($subject_id)) {
            // Loop using index to match subject_id with fee
            for ($i = 0; $i < count($subject_id); $i++) {
            $fee = $fees_charge[$i];
            $sub_id = $subject_id[$i];

            if (!empty($fee)) {
            // Check if record exists for this subject, group, and title
            $this->db->where('inst_sem_group', $gt_sem_group);
            $this->db->where('inst_sem_title', $gt_sem_title);
            $this->db->where('inst_sem_subject_id', $sub_id);
            $query = $this->db->get('sem_subject_charge');

            if ($query->num_rows() > 0) {              
                
            // Update Existing Record
            $this->db->where('inst_sem_group', $gt_sem_group);
            $this->db->where('inst_sem_title', $gt_sem_title);
            $this->db->where('inst_sem_subject_id', $sub_id);
            $this->db->update('sem_subject_charge', [
            'inst_fees_charge' => $fee
            ]);
            } else {

             
            // Insert New Record
            $data = [
            'inst_sem_group'       => $gt_sem_group,
            'inst_sem_title'       => $gt_sem_title,
            'inst_sem_subject_id'  => $sub_id,
            'inst_fees_charge'     => $fee
            ];
            $this->db->insert('sem_subject_charge', $data);          


            }
            }
            }
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester_exam/exam_instruction');
            }



            public function get_bygroup()
            {
            $exam_group_id = $this->input->post('exam_group_id');
            $exam_id = $this->input->post('exam_id');
            $exam_option = $this->input->post('exam_option');
            $exam_type = $this->input->post('exam_type');

            $this->db->where([
            'sem_exam_examgroup'     => $exam_group_id,
            'sem_exam_examid'         => $exam_id,
            'sem_exam_option'         => $exam_option,
            'sem_exam_optiontype'     => $exam_type
            ]);
            $query = $this->db->get('sem_exam_instruction');

            if ($query->num_rows() > 0) {
            echo json_encode($query->row());
            } else {
            echo json_encode([]);
            }
            }



            public function get_byfeechrge()
            {
            $fee_exam_type       = $this->input->post('fee_exam_type');        

            $this->db->where([
            'sem_fees_title'     => $fee_exam_type,            
            ]);
            $query = $this->db->get('sem_fees_charge');

            if ($query->num_rows() > 0) {
            echo json_encode($query->row());
            } else {
            echo json_encode([]);
            }

            }
    

            



            }


