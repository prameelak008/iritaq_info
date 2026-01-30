        <?php
        
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }
        
        class Exam extends Student_Controller
        {
        
        public function __construct()
        {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession(); 
        }
        
        public function index()
        {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'exam/index');
        $data['title']      = 'Add Exam';
        $data['title_list'] = 'Exam List';
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
        
        } else {
        $data = array(
        'name' => $this->input->post('name'),
        'note' => $this->input->post('note'),
        );
        $this->exam_model->add($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee details added to Database!!!</div>');
        redirect('admin/exam/index');
        }
        $stuid              = $this->session->userdata('student');
        $stu_record         = $this->student_model->getRecentRecord($stuid['student_id']);
        $data['class_id']   = $stu_record['class_id'];
        $data['section_id'] = $stu_record['section_id'];
        $exam_result        = $this->examschedule_model->getExamByClassandSection($data['class_id'], $data['section_id']);
        $data['examlist']   = $exam_result;
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/exam/examList', $data);
        $this->load->view('layout/student/footer', $data);
        }
        
        
        
        public function view($id)
        {
        $data['title'] = 'Exam List';
        $exam          = $this->exam_model->get($id);
        $data['exam']  = $exam;
        $this->load->view('layout/header', $data);
        $this->load->view('exam/examShow', $data);
        $this->load->view('layout/footer', $data);
        }
        
        public function getByFeecategory()
        {
        $feecategory_id = $this->input->get('feecategory_id');
        $data           = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
        }
        
        public function getStudentCategoryFee()
        {
        $type     = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data     = $this->exam_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
        $status = 'fail';
        } else {
        $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
        }
        
        public function delete($id)
        {
        $data['title'] = 'Exam List';
        $this->exam_model->remove($id);
        redirect('admin/exam/index');
        }
        
        public function create()
        {
        $data['title'] = 'Add Exam';
        $this->form_validation->set_rules('exam', 'Exam', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
        $this->load->view('layout/header', $data);
        $this->load->view('exam/examCreate', $data);
        $this->load->view('layout/footer', $data);
        } else {
        $data = array(
        'exam' => $this->input->post('exam'),
        'note' => $this->input->post('note'),
        );
        $this->exam_model->add($data);
        $this->session->set_flashdata('msg', '<div exam="alert alert-success text-center">Employee details added to Database!!!</div>');
        redirect('exam/index');
        }
        }
        
        public function edit($id)
        {
        $data['title']      = 'Edit Exam';
        $data['id']         = $id;
        $exam               = $this->exam_model->get($id);
        $data['exam']       = $exam;
        $data['title_list'] = 'Exam List';
        $exam_result        = $this->exam_model->get();
        $data['examlist']   = $exam_result;
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/examEdit', $data);
        $this->load->view('layout/footer', $data);
        } else {
        $data = array(
        'id'   => $id,
        'name' => $this->input->post('name'),
        'note' => $this->input->post('note'),
        );
        $this->exam_model->add($data);
        $this->session->set_flashdata('msg', '<div exam="alert alert-success text-center">Employee details added to Database!!!</div>');
        redirect('admin/exam/index');
        }
        }
        
        public function examSearch()
        {
        $data['title'] = 'Search exam';
        if ($this->input->server('REQUEST_METHOD') == "POST") {
        $search = $this->input->post('search');
        if ($search == "search_filter") {
        $data['exp_title']  = 'exam Result From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
        $date_from          = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
        $date_to            = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
        $resultList         = $this->exam_model->search("", $date_from, $date_to);
        $data['resultList'] = $resultList;
        } else {
        $data['exp_title']  = 'exam Result';
        $search_text        = $this->input->post('search_text');
        $resultList         = $this->exam_model->search($search_text, "", "");
        $data['resultList'] = $resultList;
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/examSearch', $data);
        $this->load->view('layout/footer', $data);
        } else {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam/examSearch', $data);
        $this->load->view('layout/footer', $data);
        }
        }
        
        public function examresult()
        {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'examresult/index');
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student_session_id    = $student_current_class->student_session_id;
        $data['exam_result']   = $this->examgroupstudent_model->searchStudentExams($student_session_id, true,true);
        $data['exam_grade']    = $this->grade_model->getGradeDetails();
        
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/examresult/index', $data);
        $this->load->view('layout/student/footer', $data);
        }
        
        
        
        
        
        
        
        
        public function printexamresult() 
        {
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'examresult/index');;     
        $data = array();
        $data['template'] = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $post_exam_id = $this->input->post('post_exam_id');
        $post_exam_group_id = $this->input->post('post_exam_group_id');
        $data['section_id'] = $this->input->post('section_id');
        $section_id         =  $data['section_id'];
        $data['marksheet_Newexamgroup'] = $this->input->post('marksheet_Newexamgroup');
        $data['marksheet_Newexambatch'] = $this->input->post('marksheet_Newexambatch');
        $students_array = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam'] = $exam;
        $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades']   = $exam_grades;
        $data['marksheet']     = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
        //$data['sch_setting'] = $this->sch_setting_detail;
        $data['instruction']   = $this->examresult_model->getonline_instruction($post_exam_id, $post_exam_group_id);
        $student_exam_page     = $this->load->view('user/examresult/_printexamresult', $data, true); 
        $array = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
        echo json_encode($array); 
        }
        
        
        
       
        
        
        
        public function examresult_print()
        { 
        $student_data             = $this->customlib->getLoggedInUserData();
        $student_id               = $this->customlib->getStudentSessionUserID();
        $student_current_class    = $this->customlib->getStudentCurrentClsSection();
        $data['students_listt']   = $this->student_model->get_student_list($student_id);
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult_print');
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        
        $class                    = $this->class_model->get();
        $data['title']            = 'Add Batch';
        $data['title_list']       = 'Recent Batch';
        $data['examType']         = $this->exam_type;
        $data['classlist']        = $class;
        $session                  = $this->session_model->get();
        $data['sessionlist']      = $session;
        
        $exam_group_id              = $this->input->post('exam_group_id');
        $exam_id                    = $this->input->post('exam_id');
        $session_id                 = $this->input->post('session_id');
        $class_id                   = $this->input->post('class_id');
        $data['section_id']         = $this->input->post('section_id');
        $section_id                 = $data['section_id'];
        $data['student_session_id'] = $student_id;
        $data['studentList']        = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        
        if (!empty($studentList)) {
        foreach ($studentList as $student_key => $student_value) {
        $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
        }
        }
        $data['Exam_group_list'] = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
        $data['examList'] = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['admin_approval']    = $this->examgroupstudent_model->getonline_examintaion_approvedbyadmin($exam_group_id, $exam_id);
        
        $data['examList']          = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        $data['exam_id']           = $exam_id;
        $data['exam_group_id']     = $exam_group_id;
        
        $data['examwithheld']      = $this->examgroupstudent_model->getexamgroups_withheld($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id);
        
        
        $data['publish_status']    = $this->examgroupstudent_model->get_publish_status($exam_group_id, $exam_id);
        //}
        $data['sch_setting'] = $this->sch_setting_detail;      
        
        $this->load->view('layout/student/header',$data);
        $this->load->view('user/examresult/indexexam_result', $data);
        $this->load->view('layout/student/footer',$data);
        }
        
        
        
        
        public function progressreport()
        {
            
        $student_data             = $this->customlib->getLoggedInUserData();
        $student_id               = $this->customlib->getStudentSessionUserID();
        $student_current_class    = $this->customlib->getStudentCurrentClsSection();
        $data['students_listt']   = $this->student_model->get_student_list($student_id);
        
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult_print');
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        
        $class                    = $this->class_model->get();
        $data['title']            = 'Add Batch';
        $data['title_list']       = 'Recent Batch';
        $data['examType']         = $this->exam_type;
        $data['classlist']        = $class;
        $session                  = $this->session_model->get();
        $data['sessionlist']      = $session;
        
        $exam_group_id              = $this->input->post('exam_group_id');
        $exam_id                    = $this->input->post('exam_id');
        $session_id                 = $this->input->post('session_id');
        $class_id                   = $this->input->post('class_id');
        $data['section_id']         = $this->input->post('section_id');
        $section_id                 = $data['section_id'];
        $data['student_session_id'] = $student_id;
        $data['studentList']        = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        
        if (!empty($studentList)) {
        foreach ($studentList as $student_key => $student_value) {
        $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
        }
        }
        $data['Exam_group_list'] = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
        $data['examList'] = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['admin_approval']    = $this->examgroupstudent_model->getonline_examintaion_approvedbyadmin($exam_group_id, $exam_id);
        
        $data['examList']          = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        $data['exam_id']           = $exam_id;
        $data['exam_group_id']     = $exam_group_id;
        
        $data['examwithheld']      = $this->examgroupstudent_model->getexamgroups_withheld($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id);
        
        //}
        $data['sch_setting'] = $this->sch_setting_detail;      
        
        $this->load->view('layout/student/header',$data);
        $this->load->view('user/examresult/progressreport', $data);
        $this->load->view('layout/student/footer',$data);
        }
        
        
        
        
        
        public function progressreport_print()
        {
        $student_data             = $this->customlib->getLoggedInUserData();
        $student_id               = $this->customlib->getStudentSessionUserID();
        $student_current_class    = $this->customlib->getStudentCurrentClsSection();
        
        
        $data['students_listt']   = $this->student_model->get_student_list($student_id);
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult_print');
        $examgroup_result         = $this->examgroup_model->get();
        $data['examgrouplist']    = $examgroup_result;
        
        $class                    = $this->class_model->get();
        $data['title']            = 'Progress Report';
        $data['title_list']       = 'Progress Report';
        $data['examType']         = $this->exam_type;
        $data['classlist']        = $class;
        $session                  = $this->session_model->get();
        $data['sessionlist']      = $session;
        
        $exam_group_id              = $this->input->post('exam_group_id');
        $exam_id                    = $this->input->post('exam_id');
        $session_id                 = $this->input->post('session_id');
        $class_id                   = $this->input->post('class_id');
        $data['section_id']         = $this->input->post('section_id');
        $section_id                 = $data['section_id'];
        $data['student_session_id'] = $student_id;
        $data['studentList']        = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        
        if (!empty($studentList)) {
        foreach ($studentList as $student_key => $student_value) {
        $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
        }
        }
        $data['Exam_group_list'] = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
        $data['examList'] = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['admin_approval']    = $this->examgroupstudent_model->getonline_examintaion_approvedbyadmin($exam_group_id, $exam_id);
        
        $data['examList']          = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        $data['exam_id']           = $exam_id;
        $data['exam_group_id']     = $exam_group_id;
        
        $data['examwithheld']      = $this->examgroupstudent_model->getexamgroups_withheld($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id);
        
        //}
        $data['sch_setting'] = $this->sch_setting_detail;      
        
        $this->load->view('layout/student/header',$data);
        $this->load->view('user/examresult/progressreport', $data);
        $this->load->view('layout/student/footer',$data);
        }
        
        
        
        public function printprogressreport() 
        {
        $student_data             = $this->customlib->getLoggedInUserData();
        $student_id               = $this->customlib->getStudentSessionUserID();
        $student_current_class    = $this->customlib->getStudentCurrentClsSection(); 
            
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'examresult/index');;     
        $data = array();
        $data['template'] = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $post_exam_id = $this->input->post('post_exam_id');
        $post_exam_group_id = $this->input->post('post_exam_group_id');
        $data['section_id'] = $this->input->post('section_id');
        $section_id         =  $data['section_id'];
        $data['marksheet_Newexamgroup'] = $this->input->post('marksheet_Newexamgroup');
        $data['marksheet_Newexambatch'] = $this->input->post('marksheet_Newexambatch');
        $students_array        = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam                  = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam']          = $exam;
        $exam_grades           = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades']   = $exam_grades;
        $data['marksheet']     = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
        //$data['sch_setting'] = $this->sch_setting_detail;
        $data['instruction']   = $this->examresult_model->getonline_instruction($post_exam_id, $post_exam_group_id);
        $data['get_student']             =   $this->student_model->get($student_id);
        $class_id                        =   $data['get_student']['class_id'] ; 
        $section                         =   $data['get_student']['section_id'] ; 
        $session_id                      =   $data['get_student']['session_id'] ;
        
        
        
        $data['getstudent_workingdays']      =   $this->examgroupstudent_model->get_attendence($student_id);
        $data['getstudent_abs']              =   $this->examgroupstudent_model->view_Studentabs($student_id);
        
        
        // $data['getstudent_halfdays']     =   $this->examgroupstudent_model->view_Studentattendence_halfdays($student_id);                
        // $data['getstudent_latedays']     =   $this->examgroupstudent_model->view_Studentattendence_late($student_id);
        
        
        //  $data['getstudent_latedays']     =   $this->examgroupstudent_model->get_leave($class_id,$section,$session_id);
        
        $this->load->library('pdf');
        $html_content=$this->load->view('user/examresult/_printprogressreport',$data,true);
        
        $this->pdf->loadHtml($html_content);
        $html = mb_convert_encoding($html_content);
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->render();
        $this->pdf->stream(""."Receipt".".pdf", array("Attachment"=>0));
        }
        }
