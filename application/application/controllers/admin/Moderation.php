            <?php
            
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }
            
            class Moderation extends Admin_Controller {
            
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
            $this->session->set_userdata('sub_menu', 'valuationcamp/moderation');
            
            
            $examgroup_result       = $this->examgroup_model->get();
            $data['examgrouplist']  = $examgroup_result;
            
            $marksheet_result        = $this->marksheet_model->get();
            $data['marksheetlist']   = $marksheet_result;
            $data['current_session'] = $this->sch_current_session;
            
            $class                  = $this->class_model->get();
            $data['title']          = 'Mark Entry';
            $data['title_list']     = 'Mark Entry';
            $data['examType']       = $this->exam_type;
            $data['classlist']      = $class;
            $session                = $this->session_model->get();
            $data['sessionlist']    = $session;
            
            $userdata               = $this->customlib->getUserData();
            $role_id                = $userdata["role_id"];
            $data['role_id']        = $role_id;
            
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
            $exam_group_id               = $this->input->post('exam_group_id');
            $exam_id                     = $this->input->post('exam_id');
            $session_id                  = $this->input->post('session_id');
            $class_id                    = $this->input->post('class_id');
            $section_id                  = $this->input->post('section_id');
            $subjectid                   = $this->input->post('subjectname');
            $marksheet_template          = $this->input->post('marksheet');
            $data['marksheet_template']  = $marksheet_template;
            $exam_details                = $this->examgroup_model->getExamByID($exam_id);
            $studentList                 = $this->examgroupstudent_model->searchExamStudents_valuationcamp($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
            
            $data['marksenter_last_date']= $this->examgroupstudent_model->valuation_lastdate_admin($exam_group_id, $exam_id,$session_id);
            $data['mark_result']         = $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
            $exam_subjects               = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
            $data['subjectList']         = $exam_subjects;
            $data['studentList']         = $studentList;
            $exam_grades                 = $this->grade_model->getByExamType($exam_details->exam_group_type);
            $data['exam_grades']         = $exam_grades;
            $data['exam_details']        = $exam_details;
            $data['exam_id']             = $exam_id;
            $data['exam_group_id']       = $exam_group_id;
            $data['subjectid']           = $subjectid;
            $data['attendence_exam']     = $this->attendence_exam;
            $data['class_id']            = $class_id;
            $data['section_id']          = $section_id; 
            $data['modertion_marks']     = $this->examgroupstudent_model->search_moderation_marks($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
            $modertion_marks              =  $data['modertion_marks'] ;
            }   
            $data['sch_setting']         = $this->sch_setting_detail;
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/moderation/index', $data);
            $this->load->view('layout/footer', $data);
            }
            
            
            
            
            
            public function entrymarks()
            {
            if(isset($_POST['save']))
            {
            $exam_group_class_batch_exam_student_id  = $this->input->post('exam_group_class_batch_exam_student_id');
            $exam_group_class_batch_exam_subject_id  = $this->input->post('subjectlist');
            $exam_group_student_mark                 = $this->input->post('exam_group_student_mark');
            $exam_group_student_cmark                = $this->input->post('exam_group_student_cmark');
            $exam_group_student_note                 = $this->input->post('exam_group_student_note');
            $post_exam_id                            = $this->input->post('post_exam_id');
            $post_exam_group_id                      = $this->input->post('post_exam_group_id');
            $subjectid                               = $this->input->post('subjectid');
            $class_id                                = $this->input->post('class_id');
            $section_id                              = $this->input->post('section_id');
            $moderation_ce                           = $this->input->post('moderation_ce');
            $moderation_te                           = $this->input->post('moderation_te') ;
            $moderation_cemarks_perc                 = $this->input->post('moderation_ce_percentage') ;
            $moderation_temarks_perc                 = $this->input->post('moderation_te_percentage') ;
            $check_moderation                        = $this->input->post('check_moderation');
            $getsubjid                               = $this->examgroupstudent_model->getsubj($subjectid);
            $this->db->where('moderation_exam', $post_exam_id);
            $this->db->where('moderation_examgroup', $post_exam_group_id);
            $this->db->where('moderation_subjects', $exam_group_class_batch_exam_subject_id);
            $this->db->where('moderation_class', $class_id);
            $this->db->where('moderation_section', $section_id);
            $this->db->where('moderation_session', $this->sch_current_session);
            $q = $this->db->get('moderation_marks'); 
            
            if ($q->num_rows() > 0)
            {
            $row             =  $q->row();
            $last_id         =  $row->moderation_id ;
            $datval          =  array( 
            'moderation_exam'           =>  $post_exam_id ,
            'moderation_examgroup'      =>  $post_exam_group_id ,
            'moderation_subjects'       =>  $exam_group_class_batch_exam_subject_id ,
            'moderation_session'        =>  $this->sch_current_session,
            'moderation_class'          =>  $class_id,
            'moderation_section'        =>  $section_id,
            'moderation_cemarks'        =>  $moderation_ce,
            'moderation_temarks'        =>  $moderation_te,
            'moderation_cemarks_perc'   =>  $moderation_cemarks_perc,
            'moderation_temarks_perc'   =>  $moderation_temarks_perc,
            'moderation_type'           =>   $check_moderation,
            'moderation_updateddate'    =>  date('Y-m-d h:i:s'));
            $this->db->where('moderation_exam', $post_exam_id);
            $this->db->where('moderation_examgroup', $post_exam_group_id);
            $this->db->where('moderation_subjects', $exam_group_class_batch_exam_subject_id);
            $this->db->where('moderation_class', $class_id);
            $this->db->where('moderation_section', $section_id);
            $this->db->update('moderation_marks', $datval); 
            }
            else
            {
            $data         =    array(                                 
            'moderation_exam'           =>  $post_exam_id ,
            'moderation_examgroup'      =>  $post_exam_group_id ,
            'moderation_subjects'       =>  $exam_group_class_batch_exam_subject_id ,
            'moderation_session'        =>  $this->sch_current_session,
            'moderation_class'          =>  $class_id,
            'moderation_section'        =>  $section_id,
            'moderation_cemarks'        =>  $moderation_ce,
            'moderation_temarks'        =>  $moderation_te,
            'moderation_cemarks_perc'   =>  $moderation_cemarks_perc,
            'moderation_temarks_perc'   =>  $moderation_temarks_perc,
            'moderation_type'           =>   $check_moderation,
            'moderation_createddate'    =>  date('Y-m-d h:i:s'));
            $this->db->insert('moderation_marks',$data); 
            $last_id= $this->db->insert_id();
            }
            $max_marks                          = $this->input->post('max_marks');
            $min_marks                          = $this->input->post('min_marks');
            $max_cmarks                         = $this->input->post('max_cmarks');
            $min_cmarks                         = $this->input->post('min_cmarks');
            $sel                                = $this->input->post('sel');
            $insert_array                       = array();
            $update_array                       = array();
            
            for($i=0;$i<count($exam_group_class_batch_exam_student_id);$i++)
            {
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $q = $this->db->get('exam_group_exam_moderation');
            if ($q->num_rows() > 0)
            {
            
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_all') 
            {
            if($moderation_ce!="" && $moderation_ce!="")
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++)
            {
            
            if ($sel[$i] != "Absent") 
            {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_ce)) {
            $original_ce_marks    = (float) $exam_group_student_cmark[$i];
            $moderated_ce         = $original_ce_marks + (float) $moderation_ce;
            
            
            if ($original_ce_marks < $min_cmarks) {
            $difference = $min_cmarks - $original_ce_marks;
            if ($moderation_ce > $difference) {
            $moderated_ce = $min_cmarks;
            } else {
            
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            }
            }
            
            if ($moderated_ce > $max_cmarks) {
            $moderated_ce = $max_cmarks;
            }
            } 
            else
            {
            $moderated_ce = 0; 
            }
            
            if (is_numeric($exam_group_student_mark[$i]) && is_numeric($moderation_te)) {
            $original_te_marks  =   (float) $exam_group_student_mark[$i];
            $moderated_te       =   $original_te_marks + (float) $moderation_te;
            
            if ($original_te_marks < $min_marks) {
            $difference       =   $min_marks - $original_te_marks;
            if ($moderation_te > $difference) {
            $moderated_te = $min_marks;
            } else {
            
            $moderated_te = $original_te_marks + (float) $moderation_te;
            }
            }
            
            if ($moderated_te > $max_marks) {
            $moderated_te = $max_marks;
            }
            } 
            else
            {
            $moderated_te = 0; 
            } 
            $data = array(
            'moderation_ce' => $moderated_ce,
            'moderation_te' => $moderated_te,
            'attendence' => $sel[$i],
            // 'get_marks' => $exam_group_student_mark[$i],
            // 'get_cmarks' => $exam_group_student_cmark[$i],
            'moderation_id' => $last_id,
            'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_moderation', $data);
            }
            }
            } 
            
            
            else if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) {
            if ($sel[$i] != "Absent") {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_cemarks_perc) && is_numeric($moderation_temarks_perc)) {
            
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i];
            // Calculate moderated marks by adding percentage-based moderation
            $moderated_cet = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            $moderated_tet = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            if ($original_ce_marks <= $min_cmarks)
            {
            if($moderated_cet>=$min_cmarks)
            {
            $moderated_ce = $min_cmarks;     
            }
            else
            {
            $moderated_ce = $moderated_cet;    
            }
            }
            elseif ($original_ce_marks >= $min_cmarks)
            {
            if($moderated_cet>=$max_cmarks)
            {
            $moderated_ce = $max_cmarks;     
            }
            else
            {
            $moderated_ce = $moderated_cet;    
            }
            }
            
            
            if ($original_te_marks <= $min_marks)
            {
            if($moderated_tet>=$min_marks)
            {
            $moderated_te = $min_marks;     
            }
            else
            {
            $moderated_te = $moderated_tet;    
            }
            }
            elseif ($original_te_marks >= $min_marks)
            {
            if($moderated_tet>=$max_marks)
            {
            $moderated_te = $max_marks;     
            }
            else
            {
            $moderated_te = $moderated_tet;    
            }
            }
            } 
            else
            {
            $moderated_ce = 0; 
            $moderated_te = 0; 
            }
            $data = array(
            'moderation_ce' => $moderated_ce,
            'moderation_te' => $moderated_te,
            'attendence' => $sel[$i],
            // 'get_marks' => $exam_group_student_mark[$i],
            // 'get_cmarks' => $exam_group_student_cmark[$i],
            'moderation_id' => $last_id,
            'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_moderation', $data);
            }
            }
            }
            } 
            
            
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_failed') 
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            
            $moderated_cet = (float)$original_ce_marks + (float)$moderation_ce;
            $moderated_tet = (float)$original_te_marks + (float)$moderation_te;
            
            
            if ($moderation_ce != "" && $moderation_te != "") 
            {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            if ($sel[$i] != "Absent")
            {
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks + $moderation_ce;
            
            // Ensure moderated marks do not exceed minimum
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks + $moderation_te;
            // Ensure moderated marks do not exceed minimum
            $moderated_te = min($moderated_te, $min_marks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_te = $original_te_marks;
            }
            $data = array(
            'moderation_ce' => $moderated_ce,
            'moderation_te' => $moderated_te,
            'attendence' => $sel[$i],
            // 'get_marks' => $exam_group_student_mark[$i],
            // 'get_cmarks' => $exam_group_student_cmark[$i],
            'moderation_id' => $last_id,
            'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_moderation', $data);
            }
            }
            
            if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            if ($sel[$i] != "Absent")
            {
            
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_te = min($moderated_te, $min_marks);
            } 
            else 
            {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_te = $original_te_marks;
            } 
            
            $data = array(                                 
            'moderation_ce' => $moderated_ce,
            'moderation_te' => $moderated_te,
            'attendence' => $sel[$i],
            // 'get_marks' => $exam_group_student_mark[$i],
            // 'get_cmarks' => $exam_group_student_cmark[$i],
            'moderation_id' => $last_id,
            'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_moderation', $data);
            }
            }
            }
            }
            }
            else
            {
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_all') 
            {
            if($moderation_ce!="" && $moderation_ce!="")
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++)
            {
            
            if ($sel[$i] != "Absent") 
            {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_ce)) {
            $original_ce_marks = (float) $exam_group_student_cmark[$i];
            
            // Calculate moderated marks by adding moderation
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            
            // If original marks are below the minimum
            if ($original_ce_marks < $min_cmarks) {
            // Calculate the difference between the minimum marks and original marks
            $difference = $min_cmarks - $original_ce_marks;
            
            // If moderation is greater than the difference, cap moderated marks at minimum marks
            if ($moderation_ce > $difference) {
            $moderated_ce = $min_cmarks;
            } else {
            // Otherwise, add moderation to original marks
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            }
            }
            
            
            if ($moderated_ce > $max_cmarks) {
            $moderated_ce = $max_cmarks;
            }
            } 
            else
            {
            $moderated_ce = 0; // Default value if marks or moderation are not numeric
            }
            
            
            
            if (is_numeric($exam_group_student_mark[$i]) && is_numeric($moderation_te)) {
            $original_te_marks = (float) $exam_group_student_mark[$i];
            
            // Calculate moderated marks by adding moderation
            $moderated_te = $original_te_marks + (float) $moderation_te;
            // If original marks are below the minimum
            if ($original_te_marks < $min_marks) {
            // Calculate the difference between the minimum marks and original marks
            $difference = $min_marks - $original_te_marks;
            
            // If moderation is greater than the difference, cap moderated marks at minimum marks
            if ($moderation_te > $difference) {
            $moderated_te = $min_marks;
            } else {
            // Otherwise, add moderation to original marks
            $moderated_te = $original_te_marks + (float) $moderation_te;
            }
            }
            
            // Cap moderated marks at the maximum marks
            if ($moderated_te > $max_marks) {
            $moderated_te = $max_marks;
            }
            } else {
            $moderated_te = 0; // Default value if marks or moderation are not numeric
            } 
            
            $data[$i]          =    array(                                 
            'exam_group_class_batch_exam_student_id'    =>  $exam_group_class_batch_exam_student_id[$i],
            'exam_group_class_batch_exam_subject_id'    =>  $exam_group_class_batch_exam_subject_id,
            'attendence'                                =>  $sel[$i],
            'moderation_ce'                             =>  $moderated_ce,
            'moderation_te'                             =>  $moderated_te,
            'moderation_id'                             =>  $last_id,
            'get_marks'                                 =>  $exam_group_student_mark[$i],
            'get_cmarks'                                =>  $exam_group_student_cmark[$i],
            'note'                                      =>  $exam_group_student_note[$i]);
            $this->db->insert('exam_group_exam_moderation',$data[$i]);
            }
            }
            } 
            else if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            
            
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) {
            if ($sel[$i] != "Absent") {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_cemarks_perc) && is_numeric($moderation_temarks_perc)) {
            
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i];
            // Calculate moderated marks by adding percentage-based moderation
            $moderated_cet = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            $moderated_tet = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            if ($original_ce_marks <= $min_cmarks) {
            if ($moderated_cet <= $min_cmarks  )
            {
            $moderated_ce = $moderated_cet;
            } 
            elseif($moderated_cet >= $min_cmarks) 
            {
            $moderated_ce = $min_cmarks;
            }
            } 
            else 
            {
            $moderated_ce = $original_ce_marks;
            }
            if ($original_ce_marks >= $min_cmarks)
            {
            $moderated_ce = $original_ce_marks;
            } 
            }
            else
            {
            $moderated_ce = 0; 
            $moderated_te = 0; 
            }
            $data[$i]          =    array(                                 
            'exam_group_class_batch_exam_student_id'    =>  $exam_group_class_batch_exam_student_id[$i],
            'exam_group_class_batch_exam_subject_id'    =>  $exam_group_class_batch_exam_subject_id,
            'attendence'                                =>  $sel[$i],
            'moderation_ce'                             =>  $moderated_ce,
            'moderation_te'                             =>  $moderated_te,
            'moderation_id'                             =>  $last_id,
            'get_marks'                                 =>  $exam_group_student_mark[$i],
            'get_cmarks'                                =>  $exam_group_student_cmark[$i],
            'note'                                      =>  $exam_group_student_note[$i]);
            $this->db->insert('exam_group_exam_moderation',$data[$i]);
            }
            }
            } 
            } 
            
            
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_failed') 
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) 
            {
            if ($moderation_ce != "" && $moderation_te != "") 
            {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            
            
            if ($sel[$i] != "Absent")
            {
            
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks + $moderation_ce;
            
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks + $moderation_te;
            
            $moderated_te = min($moderated_te, $min_marks);
            } else {
            $moderated_te = $original_te_marks;
            }
            
            $data[$i] = array(                                 
            'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
            'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
            'attendence' => $sel[$i],
            'moderation_ce' => $moderated_ce,
            'moderation_te' => $moderated_te,
            'moderation_id' => $last_id,
            'get_marks' => $exam_group_student_mark[$i],
            'get_cmarks' => $exam_group_student_cmark[$i],
            'note' => $exam_group_student_note[$i]
            );
            $this->db->insert('exam_group_exam_moderation', $data[$i]);
            }
            }
            
            
            if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            
            if ($sel[$i] != "Absent") 
            {
            
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_te = min($moderated_te, $min_marks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_te = $original_te_marks;
            }
            
            $data[$i] = array(                                 
            'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
            'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
            'attendence' => $sel[$i],
            'moderation_ce' => $moderated_ce,
            'moderation_te' => $moderated_te,
            'moderation_id' => $last_id,
            'get_marks' => $exam_group_student_mark[$i],
            'get_cmarks' => $exam_group_student_cmark[$i],
            'note' => $exam_group_student_note[$i]
            );
            
            $this->db->insert('exam_group_exam_moderation', $data[$i]);
            }
            }
            } 
            }
            }
            }
            /*exam Result*/
            for($i=0;$i<count($exam_group_class_batch_exam_student_id);$i++)
            {
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $q = $this->db->get('exam_group_exam_results');
            
            if ($q->num_rows() > 0)
            {
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_all') 
            {
            if($moderation_ce!="" && $moderation_ce!="")
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++)
            {
            
            if ($sel[$i] != "Absent") 
            {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_ce)) {
            $original_ce_marks = (float) $exam_group_student_cmark[$i];
            
            
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            
            
            if ($original_ce_marks < $min_cmarks) {
            $difference = $min_cmarks - $original_ce_marks;
            if ($moderation_ce > $difference) {
            $moderated_ce = $min_cmarks;
            } else {
            
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            }
            }
            if ($moderated_ce > $max_cmarks) {
            $moderated_ce = $max_cmarks;
            }
            } 
            else
            {
            $moderated_ce = 0; 
            }
            
            if (is_numeric($exam_group_student_mark[$i]) && is_numeric($moderation_te)) {
            $original_te_marks  =   (float) $exam_group_student_mark[$i];
            $moderated_te       =   $original_te_marks + (float) $moderation_te;
            
            if ($original_te_marks < $min_marks) {
            $difference       =   $min_marks - $original_te_marks;
            if ($moderation_te > $difference) {
            $moderated_te = $min_marks;
            } 
            else
            {
            $moderated_te = $original_te_marks + (float) $moderation_te;
            }
            }
            
            if ($moderated_te > $max_marks) {
            $moderated_te = $max_marks;
            }
            } 
            else
            {
            $moderated_te = 0; 
            } 
            
            $data = array(
            // 'moderation_ce' => $moderated_ce,
            // 'moderation_te' => $moderated_te,
            // 'attendence'    => $sel[$i],
            'get_marks'     => $moderated_te,
            'get_cmarks'    => $moderated_ce,
            'moderation_id' => $last_id,
            // 'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_results', $data);
            }
            }
            } 
            
            else if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) {
            if ($sel[$i] != "Absent") {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_cemarks_perc) && is_numeric($moderation_temarks_perc)) {
            
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i];
            // Calculate moderated marks by adding percentage-based moderation
            $moderated_cet = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            $moderated_tet = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            if ($original_ce_marks <= $min_cmarks)
            {
            if($moderated_cet>=$min_cmarks)
            {
            $moderated_ce = $min_cmarks;     
            }
            else
            {
            $moderated_ce = $moderated_cet;    
            }
            }
            elseif ($original_ce_marks >= $min_cmarks)
            {
            if($moderated_cet>=$max_cmarks)
            {
            $moderated_ce = $max_cmarks;     
            }
            else
            {
            $moderated_ce = $moderated_cet;    
            }
            }
            
            
            if ($original_te_marks <= $min_marks)
            {
            if($moderated_tet>=$min_marks)
            {
            $moderated_te = $min_marks;     
            }
            else
            {
            $moderated_te = $moderated_tet;    
            }
            }
            elseif ($original_te_marks >= $min_marks)
            {
            if($moderated_tet>=$max_marks)
            {
            $moderated_te = $max_marks;     
            }
            else
            {
            $moderated_te = $moderated_tet;    
            }
            }
            } 
            else
            {
            $moderated_ce = 0; 
            $moderated_te = 0; 
            }
            $data = array(
            // 'moderation_ce' => $moderated_ce,
            // 'moderation_te' => $moderated_te,
            // 'attendence' => $sel[$i],
            'get_marks'     => $moderated_te,
            'get_cmarks'    => $moderated_ce,
            'moderation_id' => $last_id,
            // 'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_results', $data);
            }
            }
            }
            } 
            
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_failed') 
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            
            $moderated_cet = (float)$original_ce_marks + (float)$moderation_ce;
            $moderated_tet = (float)$original_te_marks + (float)$moderation_te;
            
            
            if ($moderation_ce != "" && $moderation_te != "") 
            {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            if ($sel[$i] != "Absent")
            {
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks + $moderation_ce;
            
            // Ensure moderated marks do not exceed minimum
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks + $moderation_te;
            // Ensure moderated marks do not exceed minimum
            $moderated_te = min($moderated_te, $min_marks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_te = $original_te_marks;
            }
            $data = array(
            // 'moderation_ce' => $moderated_ce,
            // 'moderation_te' => $moderated_te,
            // 'attendence' => $sel[$i],
            'get_marks' => $moderated_te,
            'get_cmarks' => $moderated_ce,
            'moderation_id' => $last_id,
            // 'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_results', $data);
            }
            }
            
            if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            if ($sel[$i] != "Absent")
            {
            
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_te = min($moderated_te, $min_marks);
            } 
            else 
            {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_te = $original_te_marks;
            } 
            
            $data = array(                                 
            // 'moderation_ce' => $moderated_ce,
            // 'moderation_te' => $moderated_te,
            // 'attendence' => $sel[$i],
            'get_marks'       =>  $moderated_te,
            'get_cmarks'      =>  $moderated_ce,
            'moderation_id'   =>  $last_id,
            // 'note' => $exam_group_student_note[$i]
            );
            
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->update('exam_group_exam_results', $data);
            }
            }
            }
            }
            }
            else
            {
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_all') 
            {
            if($moderation_ce!="" && $moderation_ce!="")
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++)
            {
            
            if ($sel[$i] != "Absent") 
            {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_ce)) {
            $original_ce_marks = (float) $exam_group_student_cmark[$i];
            
            // Calculate moderated marks by adding moderation
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            
            // If original marks are below the minimum
            if ($original_ce_marks < $min_cmarks) {
            // Calculate the difference between the minimum marks and original marks
            $difference = $min_cmarks - $original_ce_marks;
            
            // If moderation is greater than the difference, cap moderated marks at minimum marks
            if ($moderation_ce > $difference) {
            $moderated_ce = $min_cmarks;
            } else {
            // Otherwise, add moderation to original marks
            $moderated_ce = $original_ce_marks + (float) $moderation_ce;
            }
            }
            
            if ($moderated_ce > $max_cmarks) {
            $moderated_ce = $max_cmarks;
            }
            } 
            else
            {
            $moderated_ce = 0; // Default value if marks or moderation are not numeric
            }
            
            if (is_numeric($exam_group_student_mark[$i]) && is_numeric($moderation_te)) {
            $original_te_marks = (float) $exam_group_student_mark[$i];
            
            // Calculate moderated marks by adding moderation
            $moderated_te = $original_te_marks + (float) $moderation_te;
            // If original marks are below the minimum
            if ($original_te_marks < $min_marks) {
            // Calculate the difference between the minimum marks and original marks
            $difference = $min_marks - $original_te_marks;
            
            // If moderation is greater than the difference, cap moderated marks at minimum marks
            if ($moderation_te > $difference) {
            $moderated_te = $min_marks;
            } else {
            // Otherwise, add moderation to original marks
            $moderated_te = $original_te_marks + (float) $moderation_te;
            }
            }
            
            // Cap moderated marks at the maximum marks
            if ($moderated_te > $max_marks) {
            $moderated_te = $max_marks;
            }
            } else {
            $moderated_te = 0; // Default value if marks or moderation are not numeric
            } 
            
            $data[$i]          =    array(                                 
            // 'exam_group_class_batch_exam_student_id'    =>  $exam_group_class_batch_exam_student_id[$i],
            // 'exam_group_class_batch_exam_subject_id'    =>  $exam_group_class_batch_exam_subject_id,
            // 'attendence'                                =>  $sel[$i],
            // 'moderation_ce'                             =>  $moderated_ce,
            // 'moderation_te'                             =>  $moderated_te,
            'moderation_id'                                =>  $last_id,
            'get_marks'                                    =>  $moderated_te,
            'get_cmarks'                                   =>  $moderated_ce,
            // 'note'                                      =>  $exam_group_student_note[$i]
            );
            $this->db->insert('exam_group_exam_results',$data[$i]);
            }
            }
            } 
            else if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            
            
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) {
            if ($sel[$i] != "Absent") {
            if (is_numeric($exam_group_student_cmark[$i]) && is_numeric($moderation_cemarks_perc) && is_numeric($moderation_temarks_perc)) {
            
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i];
            // Calculate moderated marks by adding percentage-based moderation
            $moderated_cet = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            $moderated_tet = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            if ($original_ce_marks <= $min_cmarks) {
            if ($moderated_cet <= $min_cmarks  )
            {
            $moderated_ce = $moderated_cet;
            } 
            elseif($moderated_cet >= $min_cmarks) 
            {
            $moderated_ce = $min_cmarks;
            }
            } 
            else 
            {
            $moderated_ce = $original_ce_marks;
            }
            if ($original_ce_marks >= $min_cmarks)
            {
            $moderated_ce = $original_ce_marks;
            } 
            }
            else
            {
            $moderated_ce = 0; 
            $moderated_te = 0; 
            }
            $data[$i]          =    array(                                 
            // 'exam_group_class_batch_exam_student_id'    =>  $exam_group_class_batch_exam_student_id[$i],
            // 'exam_group_class_batch_exam_subject_id'    =>  $exam_group_class_batch_exam_subject_id,
            // 'attendence'                                =>  $sel[$i],
            // 'moderation_ce'                             =>  $moderated_ce,
            // 'moderation_te'                             =>  $moderated_te,
            'moderation_id'                                =>  $last_id,
            'get_marks'                                    =>  $moderated_te,
            'get_cmarks'                                   =>  $moderated_ce,
            // 'note'                                      =>  $exam_group_student_note[$i]
            );
            $this->db->insert('exam_group_exam_results',$data[$i]);
            }
            }
            } 
            } 
            
            if(isset($_POST['check_moderation']) && $_POST['check_moderation'] == 'check_failed') 
            {
            for ($i = 0; $i < count($exam_group_class_batch_exam_student_id); $i++) 
            {
            if ($moderation_ce != "" && $moderation_te != "") 
            {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            
            
            if ($sel[$i] != "Absent")
            {
            
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks + $moderation_ce;
            
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks + $moderation_te;
            
            $moderated_te = min($moderated_te, $min_marks);
            } else {
            $moderated_te = $original_te_marks;
            }
            
            $data[$i] = array(                                 
            // 'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
            // 'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
            // 'attendence' => $sel[$i],
            // 'moderation_ce' => $moderated_ce,
            // 'moderation_te' => $moderated_te,
            'moderation_id'    => $last_id,
            'get_marks'        => $moderated_te,
            'get_cmarks'       => $moderated_ce,
            // 'note' => $exam_group_student_note[$i]
            );
            $this->db->insert('exam_group_exam_results', $data[$i]);
            }
            }
            
            
            if ($moderation_cemarks_perc != "" && $moderation_temarks_perc != "") {
            $original_ce_marks = (float)$exam_group_student_cmark[$i];
            $original_te_marks = (float)$exam_group_student_mark[$i]; 
            
            if ($sel[$i] != "Absent") 
            {
            if ($original_ce_marks < $min_cmarks) 
            {
            $moderated_ce = $original_ce_marks * (1 + $moderation_cemarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_ce = min($moderated_ce, $min_cmarks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_ce = $original_ce_marks;
            }
            
            if ($original_te_marks < $min_marks) 
            {
            $moderated_te = $original_te_marks * (1 + $moderation_temarks_perc / 100);
            
            // Ensure moderated marks do not exceed minimum
            $moderated_te = min($moderated_te, $min_marks);
            } else {
            // If original marks are at or above minimum, keep them unchanged
            $moderated_te = $original_te_marks;
            }
            
            
            $data[$i] = array(                                 
            // 'exam_group_class_batch_exam_student_id' => $exam_group_class_batch_exam_student_id[$i],
            // 'exam_group_class_batch_exam_subject_id' => $exam_group_class_batch_exam_subject_id,
            // 'attendence' => $sel[$i],
            // 'moderation_ce' => $moderated_ce,
            // 'moderation_te' => $moderated_te,
            'moderation_id' => $last_id,
            'get_marks'     => $moderated_te,
            'get_cmarks'    => $moderated_ce,
            // 'note' => $exam_group_student_note[$i]
            );
            $this->db->insert('exam_group_exam_results', $data[$i]);
            }
            }
            } 
            }
            }
            }
            }
            
            if(isset($_POST['revert']))
            {
            $check_moderation = isset($_POST['check_moderation']) ? $_POST['check_moderation'] : null;
            $exam_group_class_batch_exam_student_id  = $this->input->post('exam_group_class_batch_exam_student_id');
            $exam_group_class_batch_exam_subject_id  = $this->input->post('subjectlist');
            $exam_group_student_mark                 = $this->input->post('exam_group_student_mark');
            $exam_group_student_cmark                = $this->input->post('exam_group_student_cmark');
            $exam_group_student_note                 = $this->input->post('exam_group_student_note');
            $post_exam_id                            = $this->input->post('post_exam_id');
            
            for($i=0;$i<count($exam_group_class_batch_exam_student_id);$i++)
            {
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $q   = $this->db->get('exam_group_exam_moderation');
            
            if ($q->num_rows() > 0)
            {
            $update_result[$i]                             =  $q->row();
            $data[$i]                                      =  array(
            'moderation_te'                                =>  $update_result[$i]->get_marks,
            'moderation_ce'                                =>  $update_result[$i]->get_cmarks,
            //  'moderation_notes'                          =>  "Moderate Marks",
            );
            $this->db->where('id', $update_result[$i]->id);
            $this->db->update('exam_group_exam_moderation', $data[$i]);
            $results_data = array(
            'get_marks'  => $update_result[$i]->get_marks,
            'get_cmarks' => $update_result[$i]->get_cmarks,
            );
            $this->db->where('exam_group_class_batch_exam_student_id', $exam_group_class_batch_exam_student_id[$i]);
            $this->db->where('exam_group_class_batch_exam_subject_id', $exam_group_class_batch_exam_subject_id);
            $this->db->update('exam_group_exam_results', $results_data);
            $mode_res      =    array('moderation_temarks' => '',
            'moderation_cemarks'            => '',
            'moderation_cemarks'            => '',
            'moderation_cemarks'            => '',
            'moderation_type'               => ''
            );
            $this->db->where('moderation_id', $update_result[$i]->moderation_id);
            $this->db->update('moderation_marks', $mode_res);
            }
            }
            }
            redirect($_SERVER['HTTP_REFERER']);             
            }
            
            
            
            
            
            
            
            public function moderationreport()
            {
            //  if (!$this->rbac->hasPrivilege('enter_mark', 'can_view')) {
            //     access_denied();
            // }
            
            $this->session->set_userdata('top_menu', 'valuationcamp');
            $this->session->set_userdata('sub_menu', 'valuationcamp/moderationreport');
            
            
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
            $exam_group_id          = $this->input->post('exam_group_id');
            $exam_id                = $this->input->post('exam_id');
            $session_id             = $this->input->post('session_id');
            $class_id               = $this->input->post('class_id');
            $section_id             = $this->input->post('section_id');
            $subjectid              = $this->input->post('subjectname');
            $marksheet_template     = $this->input->post('marksheet');
            $data['marksheet_template']  = $marksheet_template;
            $exam_details                = $this->examgroup_model->getExamByID($exam_id);
            $studentList                 = $this->examgroupstudent_model->searchExamStudents_moderationreport($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
            $data['marksenter_last_date']= $this->examgroupstudent_model->valuation_lastdate_admin($exam_group_id, $exam_id,$session_id);
            
            $data['mark_result']        = $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
            $exam_subjects              = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
            $data['subjectList']        = $exam_subjects;
            $data['studentList']        = $studentList;
            $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
            $data['exam_grades']        = $exam_grades;
            $data['exam_details']       = $exam_details;
            $data['exam_id']            = $exam_id;
            $data['exam_group_id']      = $exam_group_id;
            $data['subjectid']          = $subjectid;
            $data['attendence_exam']    = $this->attendence_exam;
            $data['class_id']      = $class_id;
            $data['section_id']    = $section_id;
            }   
            $data['sch_setting'] = $this->sch_setting_detail;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/moderation/report', $data);
            $this->load->view('layout/footer', $data);
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
            
            public function clearresult()
            {
            $row=$this->input->post('row');
            $this->db->where(array('id'=>$row));
            $data=$this->db->delete('exam_group_exam_results');
            echo Json_encode($data);
            }
            }
