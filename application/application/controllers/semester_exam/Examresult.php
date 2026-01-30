        <?php
        
        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }

        
        class Examresult extends Admin_Controller
        { 
        
        public function __construct()
        {
        parent::__construct();
        $this->config->load('app-config');
        $this->sch_setting_detail       = $this->setting_model->getSetting();
        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->current_session          = $this->setting_model->getCurrentSession();
        }        





        public function admitcard() 
        {
        if (!$this->rbac->hasPrivilege('print_admit_card', 'can_view')) 
        {
        access_denied();
        }        
        $this->session->set_userdata('top_menu', 'semester_exam');
        // $this->session->set_userdata('sub_menu', 'Examinations/examresult/admitcard');        
        // $data['current_session']    = $this->sch_current_session;         
        $data['title']                  = 'Generate Admit Card';
        $data['title_list']             = 'Admit Card';

        $examgroup_result               = $this->examgroup_model->get();
        $data['examgrouplist']          = $examgroup_result;

        // $data['Programmetype_list']     =   $this->Programmetype_model->get();
        // $data['batch_group']            =   $this->Batchtype_model->get_batchgroup();
        // $data['semestertype_list']      =   $this->Semestertype_model->getdata(); 
        // $data['semester_term']          =   $this->Set_duration_model->get_semester_term(); 


        $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
        $data['programs']                   = $this->Semester_enrollment_model->get_programs();

        $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();



        $admitcard_result               = $this->admitcard_model->get();
        $data['admitcardlist']          = $admitcard_result;
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('admitcard', $this->lang->line('admit') . " " . $this->lang->line('card') . " " . $this->lang->line('template'), 'trim|required|xss_clean');
        
        $exam_group_id                  = $this->input->post('exam_group_id');
        $exam_id                        = $this->input->post('exam_id'); 


        // $program_type                   = $this->input->post('program_type');   
        // $programe                       = $this->input->post('programe');   
        // $batch_group                    = $this->input->post('batch_group');   
        // $semester_semtype               = $this->input->post('semester_semtype');   
        // $semester_term                  = $this->input->post('semester_term');



        $admitcard_template             = $this->input->post('admitcard');        
        $sem_group_id                   = $this->input->post('sem_group_id_pt');
        $data['sem_group_id']           = $sem_group_id ;
        $data['admitcard_template']     = $admitcard_template; 
        if ($this->form_validation->run() == false) 
        {        
        } 
        else 
        {         
        // $data['studentList']        = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);        
        

                $program_id                     = $this->input->post('program'); 
                $semester_value                 = $this->input->post('semester'); 
                
           
                list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

                // Pass all selected values back to view for further processing / search
                $data['selected_program']       = $program_id;
                $data['selected_semester_type'] = $semester_type_id;
                $data['selected_batch']         = $batch_id;
                $data['selected_term']          = $semester_term_id;

                $program                        = $data['selected_program'];
                $semester_id                    = $data['selected_semester_type'];
                $batch_id                       = $data['selected_batch'];
                $term_id                        = $data['selected_term'];

                $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group($program,$batch_id,$semester_id,$term_id); 
                $sem_groups                     = $data['sem_groups']; 


                // $sem_group_id                   = $this->input->post('sem_group_id');
                // $data['sem_group_id']           = $sem_group_id ; 

                $data['studentList']            = $this->Semesterexam_model->search_ByStudents($exam_group_id,$exam_id,$sem_groups['sem_group_id']);
                $stud_details                   = $data['studentList']; 

                $sem_group_id                   = $sem_groups['sem_group_id'];
                $data['sem_group_id']           = $sem_group_id ; 

                $data['examList']               = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                $data['exam_id']                = $exam_id;
                $data['exam_group_id']          = $exam_group_id;        
        
        
        // foreach($stud_details as $key)
        // {
        // $student_value                  = $key->student_session_id;
        // $exam_group_class_batch_exam_id = $exam_id;
        // $studentdetails                 = $this->examgroupstudent_model->exam_students($student_value);
        // $name                   =$studentdetails['firstname'].''.$studentdetails['middlename'].''.$studentdetails['lastname'];
        // $admission              =$studentdetails['admission_no'];
        // $roll                   =$studentdetails['roll_no'];
        // $this->db->where(array('student_session_id' => $student_value,'exam_group_class_batch_exam_id' => $exam_group_class_batch_exam_id, 'exam_qrcode' => ""));      
        // $q 		    =     $this->db->get('exam_group_class_batch_exam_students');
        // $dat       =    "Student Id:$student_value,\nExam Id:$exam_group_class_batch_exam_id,\nSession Id:$this->sch_current_session,\nName:$name,\nAdmission No:$admission,\nRoll No:$roll,";
        // $qr         =    $this->generate_qrcode($dat,$student_value);
        // if ($q->num_rows() > 0) 
        // {
        // $datval                =    $q->row_array();
        // $table                 =    "exam_group_class_batch_exam_students";
        // $condition             =    array('student_session_id'=>$student_value,'exam_group_class_batch_exam_id' => $exam_group_class_batch_exam_id);
        // $data                  =    array('exam_qrcode'=> $qr['file']);
        // $this->Entranceadmission_model->updte_value($table,$data,$condition);
        // }
        // }

        }
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('semester_exam/examresult/admitcard', $data);
        $this->load->view('layout/footer', $data);
        }      
                



        public function printCard()
        {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('admitcard_template', $this->lang->line('template'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_id', $this->lang->line('exam'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('exam_group_class_batch_exam_student_id[]', $this->lang->line('students'), 'required|trim|xss_clean');
        $data = array();
        
        if ($this->form_validation->run() == false) 
        {
        $data                                    = array(
        'admitcard_template'                     => form_error('admitcard_template'),
        'post_exam_id'                           => form_error('post_exam_id'),
        'post_exam_group_id'                     => form_error('post_exam_group_id'),
        'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
        );
        $array = array('status' => 0, 'error' => $data);
        echo json_encode($array);
        } 
        else
        { 
        $post_exam_id                   = $this->input->post('post_exam_id');
        $post_exam_group_id             = $this->input->post('post_exam_group_id');
        $students_array                 = $this->input->post('exam_group_class_batch_exam_student_id');
        $sem_group_id                   = $this->input->post('sem_group_id');
        $data['sem_group_id']           = $sem_group_id ;
      
        $exam                           = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam']                   = $exam;
        $exam_grades                    = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades']            = $exam_grades;
        $data['admitcard']              = $this->admitcard_model->get($this->input->post('admitcard_template'));
        
        $data['exam_subjects']          = $this->Semesterexam_model->getSemExamSubjects($post_exam_id);        
        $data['post_exam_id']           = $post_exam_id;
        $data['post_exam_group_id']     = $post_exam_group_id;  
     
        // $data['exam_subjects_row'] = $this->batchsubject_model->getExamSubjects_row($post_exam_id);
        
        $data['exam_details']           = $this->Semesterexam_model->getexamgroup_And_exam_Name($post_exam_id,$post_exam_group_id); 
               
        $data['student_details']        = $this->Semesterexam_model->getStudentsAdmitCardByExamAndStudentID($students_array, $post_exam_id,$sem_group_id);


        //  $data['get_subjects']            = $this->Semesterexam_model->get_sem_subjects($students_array, $post_exam_id,$sem_group_id);


        // $data['student_details']         = $this->Semesterexam_model->get_sem_subjects($students_array, $post_exam_id);



        $data['sch_setting']            = $this->sch_setting_detail;

        
        
        $stud_details                   = $data['student_details'];
        
        $student_admit_cards            = $this->load->view('semester_exam/examresult/_printadmitcard', $data, true);
        
        $array                          = array('status' => '1', 'error' => '', 'page' => $student_admit_cards);
        echo json_encode($array);
        }
        }





        public function marksheet()
        {
        if (!$this->rbac->hasPrivilege('print_marksheet', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult/marksheet');
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        
        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        
        $class = $this->class_model->get();
        $data['title'] = 'Add Batch';
        $data['title_list'] = 'Recent Batch';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        $this->form_validation->set_rules('marksheet', $this->lang->line('marksheet'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('student'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) 
        {        
        } 
        else
        {
        $exam_group_id              = $this->input->post('exam_group_id');
        $exam_id                    = $this->input->post('exam_id');
        $session_id                 = $this->input->post('session_id');
        $class_id                   = $this->input->post('class_id');
        $section_id                 = $this->input->post('section_id');
        
        $marksheet_template         = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        
        $data['studentList']        = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $session_id);
        $data['Exam_group_list']    = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
        $data['examList']           = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['exam_id']            = $exam_id;
        $data['exam_group_id']      = $exam_group_id;
        }
        
        $data['sch_setting']        = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('semester_exam/examresult/marksheet', $data);
        $this->load->view('layout/footer', $data);
        }
        }
