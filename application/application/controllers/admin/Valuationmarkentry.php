<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

        class Valuationmarkentry extends Admin_Controller {
        
        public $exam_type = array();
        
        public function __construct()
        {
        parent::__construct();
        $this->exam_type = $this->config->item('exam_type');
        $this->attendence_exam = $this->config->item('attendence_exam');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->sch_current_session = $this->setting_model->getCurrentSession();
        $this->load->library('Zend');
        }


        public function entermark() 
        {    

        //  if (!$this->rbac->hasPrivilege('enter_mark', 'can_view')) {
        //     access_denied();
        // }

        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/enter_mark');
        
        
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;

        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        $data['current_session'] = $this->sch_current_session;

        $class                  = $this->class_model->get();
        $data['title'] = 'Mark Entry';
        $data['title_list'] = 'Mark Entry';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        
        $userdata    = $this->customlib->getUserData();
        $role_id     = $userdata["role_id"];
        $data['role_id']= $role_id;
       
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false)
        {
            
        } 
        else
        {
        $exam_group_id                 = $this->input->post('exam_group_id');
        $exam_id                       = $this->input->post('exam_id');
        $session_id                    = $this->input->post('session_id');
        $class_id                      = $this->input->post('class_id');
        $section_id                    = $this->input->post('section_id');
        $subjectid                     = $this->input->post('subjectname');
        $marksheet_template            = $this->input->post('marksheet');
        $data['marksheet_template']    = $marksheet_template;
        $exam_details                  = $this->examgroup_model->getExamByID($exam_id);
        $studentList                   = $this->examgroupstudent_model->searchExamStudents_valuationcamp($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
        $data['marksenter_last_date']  = $this->examgroupstudent_model->valuation_lastdate_admin($exam_group_id, $exam_id,$session_id);
        $data['mark_result']           = $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
        $exam_subjects                 = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
        $data['subjectList']           = $exam_subjects;
        $data['studentList']           = $studentList;
        $exam_grades                   = $this->grade_model->getByExamType($exam_details->exam_group_type);
        $data['exam_grades']           = $exam_grades;
        $data['exam_details']          = $exam_details;
        $data['exam_id']               = $exam_id;
        $data['exam_group_id']         = $exam_group_id;
        $data['subjectid']             = $subjectid;
        $data['attendence_exam']       = $this->attendence_exam;
        }   
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationentermark/index', $data);
        $this->load->view('layout/footer', $data);
        }
        
            
        public function attendance() 
        {    

        //  if (!$this->rbac->hasPrivilege('enter_mark', 'can_view')) {
        //     access_denied();
        // }

        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/attendance');
        
        
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;

        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        $data['current_session'] = $this->sch_current_session;

        $class                  = $this->class_model->get();
        $data['title'] = 'Mark Entry';
        $data['title_list'] = 'Mark Entry';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');

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
            $subjectid = $this->input->post('subjectname');
            $marksheet_template = $this->input->post('marksheet');
            $data['marksheet_template'] = $marksheet_template;
            $exam_details = $this->examgroup_model->getExamByID($exam_id);
            $studentList         = $this->examgroupstudent_model->searchExamStudents_valuation($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
            $data['mark_result']= $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
            $exam_subjects = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
            $data['subjectList'] = $exam_subjects;
            $data['studentList']       = $studentList;
            $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
            $data['exam_grades']        = $exam_grades;
            $data['exam_details']       = $exam_details;
            $data['exam_id']            = $exam_id;
            $data['exam_group_id']      = $exam_group_id;
            $data['attendence_exam']    = $this->attendence_exam;

            }   
            $data['sch_setting'] = $this->sch_setting_detail;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/valuationentermark/attendence', $data);
            $this->load->view('layout/footer', $data);
            }



                public function entrymarks()
                {
                //$this->form_validation->set_error_delimiters('', ''); 
                $exam_group_class_batch_exam_student_id  = $this->input->post('exam_group_class_batch_exam_student_id');
                $exam_group_class_batch_exam_subject_id  = $this->input->post('subjectlist');
                $exam_group_student_mark                 = $this->input->post('exam_group_student_mark');
                $exam_group_student_cmark                = $this->input->post('exam_group_student_cmark');
                $exam_group_student_note                 = $this->input->post('exam_group_student_note');
                 $post_exam_id                           = $this->input->post('post_exam_id');
                 $post_exam_group_id                     = $this->input->post('post_exam_group_id');
                 $subjectid                              = $this->input->post('subjectid');
                 $getsubjid                              = $this->examgroupstudent_model->getsubj($subjectid);
                 
                $this->db->where('valuation_examid', $post_exam_id);
                $this->db->where('valuation_examgroup', $post_exam_group_id);
                $this->db->where('valuation_subject', $getsubjid['subjectid']);
                $q = $this->db->get('valuation_assignsubjects');                
                
                if ($q->num_rows() > 0)
                {
                $datval          =  array( 
                'valuation_submitted_date' =>  date('Y-m-d h:i:s'));
                 $this->db->where('valuation_examid', $post_exam_id);
                $this->db->where('valuation_examgroup', $post_exam_group_id);
                $this->db->where('valuation_subject', $getsubjid['subjectid']);
                $this->db->update('valuation_assignsubjects', $datval);    
                }
                
                //$exam_group_student_attendance           = $this->input->post('exam_group_student_attendance');
                $sel                                     = $this->input->post('sel');
                $insert_array                            = array();
                $update_array                            = array();
                
                // for($i=0;$i<count($exam_group_class_batch_exam_student_id);$i++)
                // {
                // $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
                // $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
                // $q = $this->db->get('exam_group_exam_results');                
                
                // if ($q->num_rows() > 0)
                // {
                // $update_result[$i] = $q->row();
                // $data[$i]          =  array(         
                
                // 'attendence'                                =>  $sel[$i],
                // 'get_marks'                                 =>  $exam_group_student_mark[$i],
                // 'get_cmarks'                                =>  $exam_group_student_cmark[$i],
                // 'note'                                      =>  $exam_group_student_note[$i]);
                // $this->db->where('id', $update_result[$i]->id);
                // $this->db->update('exam_group_exam_results', $data[$i]);
                // }
                // else
                // {
                // $data[$i]          =    array(                                 
                // 'exam_group_class_batch_exam_student_id'    =>  $exam_group_class_batch_exam_student_id[$i],
                // 'exam_group_class_batch_exam_subject_id'    =>  $exam_group_class_batch_exam_subject_id,
                // 'attendence'                                =>  $sel[$i],
                // 'get_marks'                                 =>  $exam_group_student_mark[$i],
                // 'get_cmarks'                                =>  $exam_group_student_cmark[$i],
                // 'note'                                      =>  $exam_group_student_note[$i]);
                // $this->db->insert('exam_group_exam_results',$data[$i]);                                                     
                // }
                // }
                
                
                    for($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++)
                    {
                    // Check if record exists in exam_group_exam_results
                    $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
                    $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
                    $q = $this->db->get('exam_group_exam_results');                    
                    
                    if ($q->num_rows() > 0)
                    {
                    // Record exists in exam_group_exam_results, update it
                    $update_result = $q->row();
                    $data[$i]     = array(
                    'attendence'  => $sel[$i],
                    'get_marks'   => $exam_group_student_mark[$i],
                    'get_cmarks'  => $exam_group_student_cmark[$i],
                    'note'        => $exam_group_student_note[$i]
                    );
                   
                    $this->db->where('id', $update_result->id);
                    $this->db->update('exam_group_exam_results', $data[$i]);
                    
                    $this->db->where('result_id', $update_result->id);
                    $q_regular = $this->db->get('exam_group_exam_results_regular');
                    
                    if ($q_regular->num_rows() > 0)
                    {
                    // Record exists in exam_group_exam_results_regular, update it
                    $update_regular = $q_regular->row();
                    $regular_data = array(
                    'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
                    'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
                    'attendence' => $sel[$i],
                    'get_marks'  => $exam_group_student_mark[$i],
                    'get_cmarks' => $exam_group_student_cmark[$i],
                    'note'        => $exam_group_student_note[$i],
                    'result_id'   => $update_result->id  // Update the result_id
                    );
                    // Update record in exam_group_exam_results_regular
                    $this->db->where('id', $update_regular->id);
                    $this->db->update('exam_group_exam_results_regular', $regular_data);
                    }
                    else
                    {
                    // No matching record in exam_group_exam_results_regular, insert a new one
                    $regular_data = array(
                    'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
                    'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
                    'attendence' => $sel[$i],
                    'get_marks'  => $exam_group_student_mark[$i],
                    'get_cmarks' => $exam_group_student_cmark[$i],
                    'note'        => $exam_group_student_note[$i],
                    'result_id'   => $update_result->id  // Insert the result_id
                    );
                    // Insert into exam_group_exam_results_regular
                    $this->db->insert('exam_group_exam_results_regular', $regular_data);
                    }
                    }
                    else
                    {
                    // No matching record in exam_group_exam_results, insert into it
                    $data[$i]     = array(
                    'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
                    'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
                    'attendence'  => $sel[$i],
                    'get_marks'   => $exam_group_student_mark[$i],
                    'get_cmarks'  => $exam_group_student_cmark[$i],
                    'note'        => $exam_group_student_note[$i]
                    );
                 
                    $this->db->insert('exam_group_exam_results', $data[$i]);
                    $result_id = $this->db->insert_id();
                    $regular_data = array(
                    'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
                    'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
                    'attendence' => $sel[$i],
                    'get_marks'  => $exam_group_student_mark[$i],
                    'get_cmarks' => $exam_group_student_cmark[$i],
                    'note'        => $exam_group_student_note[$i],
                    'result_id'   => $result_id  // Insert the result_id
                    );
                    $this->db->insert('exam_group_exam_results_regular', $regular_data);
                    }
                    }
                    redirect($_SERVER['HTTP_REFERER']);             
                    }
                    
                    
                    
                
                public function add_attendence()
                {
                $exam_group_class_batch_exam_student_id   = $this->input->post('exam_group_class_batch_exam_student_id');
                $exam_group_class_batch_exam_subject_id   = $this->input->post('exam_group_class_batch_exam_subject_id');
                $sel                                      = $this->input->post('sel');
                $insert_array                            = array();
                $update_array                            = array();
                
                for($i=0;$i<count($exam_group_class_batch_exam_student_id);$i++)
                {
                $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
                $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
                $q = $this->db->get('exam_group_exam_results');                
                
                if ($q->num_rows() > 0)
                {
                $update_result[$i] = $q->row();
                $data[$i]          =  array(         
                
                'attendence'                                =>  $sel[$i],
                //'note'                                      =>  $exam_group_student_note[$i],
                );
                
                $this->db->where('id', $update_result[$i]->id);
                $this->db->update('exam_group_exam_results', $data[$i]);
                }
                else
                {
                $data[$i]          =    array(                                 
                'exam_group_class_batch_exam_student_id'    =>  $exam_group_class_batch_exam_student_id[$i],
                'exam_group_class_batch_exam_subject_id'    =>  $exam_group_class_batch_exam_subject_id,
                'attendence'                                =>  $sel[$i],
                
                //'note'                                    =>  $exam_group_student_note[$i]
                );
                $this->db->insert('exam_group_exam_results',$data[$i]);                                                     
                }
                }
                redirect($_SERVER['HTTP_REFERER']);             
                }
                
                
                


        public function getsubjectentry()
        {
        $exam_id               = $this->input->post('exam_id');       
        $data                  = $this->examgroupstudent_model->getNamesubject($exam_id);
        }
        public function getsubject()
        {
        $exam_id               = $this->input->post('exam_id');       
        $data                  = $this->examgroupstudent_model->getNamesubject($exam_id);
        echo json_encode($data);
        }
        
        
        public function getsubject_bylist()
        {
        $exam_id               = $this->input->post('exam_id');       
        $data                  = $this->examgroupstudent_model->getsubject_bylist($exam_id);
        echo json_encode($data);
        }




        public function getsubjecttet()
        {
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $subjectid = $this->input->post('subjectname'); 
        $data['studentList']= $this->examgroupstudent_model->searchExamStudents_valuationtest($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
        if (!$this->input->is_ajax_request())
        {
        exit('No direct script access allowed');
        }
        $this->load->view('admin/valuationentermark/ajax_subjectlist',$data);
        }      
                
                
        public function qr_verification() 
        {      

        //  if (!$this->rbac->hasPrivilege('enter_mark', 'can_view')) {
        //     access_denied();
        // }

        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/qr_verification');
        
        
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;

        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        $data['current_session'] = $this->sch_current_session;

        $class                  = $this->class_model->get();
        $data['title'] = 'Mark Entry';
        $data['title_list'] = 'Mark Entry';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');

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
            $subjectid = $this->input->post('subjectname');
            $marksheet_template = $this->input->post('marksheet');
            $data['marksheet_template'] = $marksheet_template;
            $exam_details = $this->examgroup_model->getExamByID($exam_id);
            $studentList         = $this->examgroupstudent_model->searchExamStudents_valuationview($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
            //$data['mark_result']= $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
            $exam_subjects = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
            $data['subjectList'] = $exam_subjects;
            $data['studentList']       = $studentList;
            $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
            $data['exam_grades']        = $exam_grades;
            $data['exam_details']       = $exam_details;
            $data['exam_id']            = $exam_id;
            $data['exam_group_id']      = $exam_group_id;
            $data['attendence_exam']    = $this->attendence_exam;

            }   
            $data['sch_setting'] = $this->sch_setting_detail;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/valuationentermark/qr_verification', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            public function clearresult()
            {
            $row=$this->input->post('row');
            $this->db->where(array('id'=>$row));
            $data=$this->db->delete('exam_group_exam_results');
            echo Json_encode($data);
            }
            
            
            
            
        public function generateremuneration() 
        {
        //  if (!$this->rbac->hasPrivilege('enter_mark', 'can_view')) {
        //     access_denied();
        // }
        
        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/generateremuneration');
        $examgroup_result        = $this->examgroup_model->get();
        $data['examgrouplist']   = $examgroup_result;
        $marksheet_result        = $this->marksheet_model->get();
        $data['marksheetlist']   = $marksheet_result;
        $data['current_session'] = $this->sch_current_session;
        $class                   = $this->class_model->get();
        
        $data['title']           = 'Print Valuation';
        $data['title_list']      = 'Print Valuation';
        $data['examType']        = $this->exam_type;
        $data['classlist']       = $class;
        $session                 = $this->session_model->get();
        $data['sessionlist']     = $session;
        $valuation_title         = $this->input->post('valuation_title');
        $data['valuation_title'] = $valuation_title;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false)
        {
        } 
        else
        {
        $data['marksheet_template'] = $marksheet_template;
        $exam_details               = $this->examgroup_model->getExamByID($exam_id);
        $studentList                = $this->examgroupstudent_model->searchExamStudents_valuationcamp($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
        $data['mark_result']        = $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
        $exam_subjects              = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
        $data['subjectList']        = $exam_subjects;
        $data['studentList']        = $studentList;
        $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
        $data['exam_grades']        = $exam_grades;
        $data['exam_details']       = $exam_details;
        $data['exam_id']            = $exam_id;
        $data['exam_group_id']      = $exam_group_id;
        $data['attendence_exam']    = $this->attendence_exam;  
        }
        
        $data['sch_setting']        = $this->sch_setting_detail;
        $data['valuationcenter']    = $this->examgroupstudent_model->valuation_center();
        $data['assignedstaff']      = $this->examgroupstudent_model->get_assigned_staff($valuation_title);
        $valuation=$data['assignedstaff'];
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationcamp/generateremuneration', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        function generate_qrcode($data,$print_value)
        {
        $this->load->library('ciqrcode');
        $hex_data   = bin2hex($data);
        $save_name  = $print_value.'.png';
        $dir = 'uploads/valuationcamp/print_remuneration/qrcode/';
        if (!file_exists($dir)) {
        mkdir($dir, 0775, true);
        }
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        $this->ciqrcode->generate($params);
        $return = array(
        'content' => $data,
        'file'    => $dir. $save_name
        );
        return $return;
        }
        
        
        public function getvaluation_title()
        {
        $valuation_title            = $this->input->post('valuation_title');
        $data['assignedstaff']      = $this->examgroupstudent_model->get_assigned_staff($valuation_title);
        $valuation=$data['assignedstaff'];
        $this->zend->load('Zend/Barcode');
        
        foreach($valuation as $val=>$key)
        {
        $print_valuation_id = $key['valuation_id'];  
        $print_group_id     = $key['valuation_examgroup'];
        $print_exam_id      = $key['valuation_examid'];
        $print_staff_id     = $key['valuation_staff'];
        $print_center_id    = $key['valuation_centerid'];
        $print_session_id   = $key['session_id'];
        
        $this->db->where('print_valuation_id', $print_valuation_id);
        $this->db->where('print_group_id', $print_group_id);
        $this->db->where('print_exam_id', $print_exam_id);
        $this->db->where('print_staff_id', $print_staff_id);
        $this->db->where('print_center_id', $print_center_id);
        $this->db->where('print_session_id', $print_session_id);
       $q           = $this->db->get('valuation_print_details');
        
        $update_result = $q->row();
        $print_value=$update_result->print_id;
        
        $data                  =    "Valuation Id:$print_valuation_id\nExam Group:$print_group_id\nExam Id:$print_exam_id\nStaff Id: $print_staff_id\nCenter:$print_center_id";
        $qr                    =    $this->generate_qrcode($data,$print_value);
        $code                  =    $print_value;
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
        imagepng($imageResource, 'uploads/valuationcamp/print_remuneration/barcode/'.$print_value.'.png');
        $dat['print_barcode']  = 'uploads/valuationcamp/print_remuneration/barcode/'.$print_value.'.png';
        $barcode               =  $dat['print_barcode'] ;
        
        if ($q->num_rows() > 0)
        {
        $update_result = $q->row();
        $data         =  array(
        'print_valuation_id'           =>  $print_valuation_id,
        'print_group_id'               =>  $print_group_id,
        'print_exam_id'                =>  $print_exam_id,
        'print_staff_id'               =>  $print_staff_id,
        'print_center_id'              =>  $print_center_id,
        'print_session_id'             =>  $print_session_id,
        'print_qrcode'                 =>  $qr['file'],
        'print_barcode'                =>  $print_value.'.png',
        );
        $this->db->where('print_id', $update_result->print_id);
        $this->db->update('valuation_print_details', $data);
        }
        else
        {
        $data                  =    array(
        'print_valuation_id'   =>  $print_valuation_id,
        'print_group_id'       =>  $print_group_id,
        'print_exam_id'        =>  $print_exam_id,
        'print_staff_id'       =>  $print_staff_id,
        'print_center_id'      =>  $print_center_id,
        'print_session_id'     =>  $print_session_id,
        'print_qrcode'         =>  $qr['file'],
        'print_barcode'        =>  $print_value.'.png',
        ); 
        $this->db->insert('valuation_print_details',$data);                                                     
        }
        }   
        echo json_encode($valuation);
        }
        
        public function printrenumeration()
        {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('staffid[]', $this->lang->line('students'), 'required|trim|xss_clean');
        $data = array();
        $data['template']     = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $staffid              = $this->input->post('staffid');
        $centerid              = $this->input->post('centerid');
        
        $data['staffdetails'] = $this->valuation_model->get_valauationstaff_details($staffid,$centerid);
        $data['sch_setting']  = $this->sch_setting_detail;
        $staffdetails         = $this->load->view('admin/valuationcamp/_printremuneration', $data, true); 
        $array                = array('status' => '1', 'error' => '', 'page' => $staffdetails);
        echo json_encode($array);
        }
        
        
        
}
