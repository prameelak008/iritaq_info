                <?php
                
                if (!defined('BASEPATH')) 
                {
                exit('No direct script access allowed');
                }
                
                class User extends Student_Controller
                {
                
                public $school_name;
                public $school_setting;
                public $setting;
                public $payment_method;
                
                public function __construct()
                {
                parent::__construct();
                $this->blood_group        = $this->config->item('bloodgroup');
                $this->load->model(array("timeline_model", "student_edit_field_model"));
                $this->payment_method     = $this->paymentsetting_model->getActiveMethod();
                $this->sch_setting_detail = $this->setting_model->getSetting();
                $this->load->model("student_edit_field_model");
                $this->config->load('mailsms');
                $this->load->model("student_model");
                $this->load->library('mailsmsconf');
                $this->current_session = $this->setting_model->getCurrentSession();
                $this->load->library('Zend');
                }
                
                public function unauthorized()
                {
                $data = array();
                $this->load->view('layout/student/header');
                $this->load->view('unauthorized', $data);
                $this->load->view('layout/student/footer');
                }
                
                
                public function choose()
                {
                if ($this->session->has_userdata('current_class')) {
                
                redirect('user/user/dashboard');
                }
                $data['sch_setting']      = $this->sch_setting_detail;
                $role                     = $this->customlib->getUserRole();
                $data['role']             = $role;
                $student_current_class    = array();
                $default_login_student_id = "";
                if ($role == "student") {
                $student_id            = $this->customlib->getStudentSessionUserID();
                $data['student_lists'] = $this->studentsession_model->searchMultiClsSectionByStudent($student_id);
                
                if ($data['student_lists'][0]->default_login) {
                $default_login_student_id = $data['student_lists'][0]->student_id;
                $student_current_class    = array('class_id' => $data['student_lists'][0]->class_id, 'section_id' => $data['student_lists'][0]->section_id, 'student_session_id' => $data['student_lists'][0]->student_session_id);
                }
                } elseif ($role == "parent") {
                $parent_id             = $this->customlib->getUsersID();
                $data['student_lists'] = $this->student_model->getParentChilds($parent_id);
                
                
                if ($data['student_lists'][0]->default_login) {
                $default_login_student_id = $data['student_lists'][0]->id;
                $student_current_class    = array('class_id' => $data['student_lists'][0]->class_id, 'section_id' => $data['student_lists'][0]->section_id, 'student_session_id' => $data['student_lists'][0]->student_session_id);
                }
                }
                if (!empty($student_current_class)) 
                {
                $logged_In_User               = $this->customlib->getLoggedInUserData();
                $logged_In_User['student_id'] = $default_login_student_id;
                $this->session->set_userdata('student', $logged_In_User);
                $this->session->set_userdata('current_class', $student_current_class);
                redirect('user/user/dashboard');
                }
                
                $this->form_validation->set_rules('clschg', $this->lang->line('select') . " " . $this->lang->line('class'), 'trim|required|xss_clean');
                
                if ($this->form_validation->run() == true) {
                $student_session_id           = $this->input->post('clschg');
                $student                      = $this->student_model->getByStudentSession($student_session_id);
                $logged_In_User               = $this->customlib->getLoggedInUserData();
                $logged_In_User['student_id'] = $student['id'];
                $this->session->set_userdata('student', $logged_In_User);
                $this->studentsession_model->updateById(array('id'=>$student_session_id,'default_login'=>1));
                $student_current_class = array('class_id' => $student['class_id'], 'section_id' => $student['section_id'], 'student_session_id' => $student['student_session_id']);
                $this->session->set_userdata('current_class', $student_current_class);   
                redirect('user/user/dashboard');
                }
                $this->load->view('user/choose', $data);
                }
                
                
                public function dashboard()
                {
                $this->session->set_userdata('top_menu', 'Dashboard');
                $student_id            = $this->customlib->getStudentSessionUserID();
                $student_current_class = $this->customlib->getStudentCurrentClsSection();		
                
                $parent_id             = $this->customlib->getUsersID();
                $data['student_lists'] = $this->student_model->getParentChilds($parent_id);
                
                $student = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);
                
                $data = array();
                if (!empty($student)) {
                
                $student_session_id           = $student_current_class->student_session_id;
                $gradeList                    = $this->grade_model->get();
                $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_session_id);
                $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee']      = $student_due_fee;
                $timeline                     = $this->timeline_model->getStudentTimeline($student["id"], $status = 'yes');
                $data["timeline_list"]        = $timeline;
                $data['sch_setting']          = $this->sch_setting_detail;
                $data['adm_auto_insert']      = $this->sch_setting_detail->adm_auto_insert;
                $data['examSchedule']         = array();
                $data['exam_result']          = $this->examgroupstudent_model->searchStudentExams($student['student_session_id'], true, true);
                $ss                           = $this->grade_model->getGradeDetails();
                $data['exam_grade']           = $this->grade_model->getGradeDetails();
                $student_doc                  = $this->student_model->getstudentdoc($student_id);
                $data['student_doc']          = $student_doc;
                $data['student_doc_id']       = $student_id;
                $category_list                = $this->category_model->get();
                $data['category_list']        = $category_list;
                $data['gradeList']            = $gradeList;
                $data['student']              = $student;
                }
                
                $unread_notifications         = $this->notification_model->getUnreadStudentNotification();
                $notification_bydate          = array();
                
                foreach ($unread_notifications as $unread_notifications_key => $unread_notifications_value) {
                if (date($this->customlib->getSchoolDateFormat()) >= date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($unread_notifications_value->publish_date))) {
                $notification_bydate[] = $unread_notifications_value;
                }
                }
                
                $data['unread_notifications']   = $notification_bydate;
                $getUsersID 		            = $this->customlib->getUsersID();
                $data['childrens']              = $this->student_model->getMyNewChildrens($getUsersID);
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/dashboard',$data);
                $this->load->view('layout/student/footer',$data);
                }

                
                
                
                
                public function updatesesion($id)
                {	
                
                $role                     = $this->customlib->getUserRole();
                $data['role']             = $role;
                $student_current_class    = array();	
                $parent_id                = $this->customlib->getUsersID();
                
                $student_session_id       = $id;
                $student                  = $this->student_model->getByStudentSession($student_session_id);
                
                
                $logged_In_User               = $this->customlib->getLoggedInUserData();
                $logged_In_User['student_id'] = $student['id'];
                
                
                $this->session->set_userdata('student', $logged_In_User);
                $this->studentsession_model->updateById(array('id'=>$student_session_id,'default_login'=>1));
                $student_current_class = array('class_id' => $student['class_id'], 'section_id' => $student['section_id'], 'student_session_id' => $student['student_session_id']);
                $this->session->set_userdata('current_class', $student_current_class);   	
                
                
                redirect('user/user/dashboard');			
                }
                
                public function changepass()
                {
                $data['title'] = 'Change Password';
                $this->form_validation->set_rules('current_pass', 'Current password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_pass', 'New password', 'trim|required|xss_clean|matches[confirm_pass]');
                $this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {
                $sessionData            = $this->session->userdata('loggedIn');
                $this->data['id']       = $sessionData['id'];
                $this->data['username'] = $sessionData['username'];
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/change_password', $data);
                $this->load->view('layout/student/footer', $data);
                } else {
                $sessionData = $this->session->userdata('student');
                $data_array  = array(
                'current_pass' => ($this->input->post('current_pass')),
                'new_pass'     => ($this->input->post('new_pass')),
                'user_id'      => $sessionData['id'],
                'user_name'    => $sessionData['username'],
                );
                $newdata = array(
                'id'       => $sessionData['id'],
                'password' => $this->input->post('new_pass'),
                );
                $query1 = $this->user_model->checkOldPass($data_array);
                if ($query1) {
                $query2 = $this->user_model->saveNewPass($newdata);
                if ($query2) {
                
                $this->session->set_flashdata('success_msg', 'Password changed successfully');
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/change_password', $data);
                $this->load->view('layout/student/footer', $data);
                }
                } else {
                
                $this->session->set_flashdata('error_msg', 'Invalid current password');
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/change_password', $data);
                $this->load->view('layout/student/footer', $data);
                }
                }
                }
                
                public function changeusername()
                {
                $sessionData = $this->customlib->getLoggedInUserData();
                
                $data['title'] = 'Change Username';
                $this->form_validation->set_rules('current_username', 'Current username', 'trim|required|xss_clean');
                $this->form_validation->set_rules('new_username', 'New username', 'trim|required|xss_clean|matches[confirm_username]');
                $this->form_validation->set_rules('confirm_username', 'Confirm username', 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {
                
                } else {
                
                $data_array = array(
                'username'     => $this->input->post('current_username'),
                'new_username' => $this->input->post('new_username'),
                'role'         => $sessionData['role'],
                'user_id'      => $sessionData['id'],
                );
                $newdata = array(
                'id'       => $sessionData['id'],
                'username' => $this->input->post('new_username'),
                );
                $is_valid = $this->user_model->checkOldUsername($data_array);
                
                if ($is_valid) {
                $is_exists = $this->user_model->checkUserNameExist($data_array);
                if (!$is_exists) {
                $is_updated = $this->user_model->saveNewUsername($newdata);
                if ($is_updated) {
                $this->session->set_flashdata('success_msg', 'Username changed successfully');
                redirect('user/user/changeusername');
                }
                } else {
                $this->session->set_flashdata('error_msg', 'Username Already Exists, Please choose other');
                }
                } else {
                $this->session->set_flashdata('error_msg', 'Invalid current username');
                }
                }
                $this->data['id']       = $sessionData['id'];
                $this->data['username'] = $sessionData['username'];
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/change_username', $data);
                $this->load->view('layout/student/footer', $data);
                }
                
                public function download($student_id, $doc)
                {
                $this->load->helper('download');
                $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(5);
                $data     = file_get_contents($filepath);
                $name     = $this->uri->segment(6);
                force_download($name, $data);
                }
                
                public function user_language($lang_id)
                {
                $language_name = $this->db->select('languages.language')->from('languages')->where('id', $lang_id)->get()->row_array();
                $student       = $this->session->userdata('student');
                if (!empty($student)) {
                $this->session->unset_userdata('student');
                }
                $language_array      = array('lang_id' => $lang_id, 'language' => $language_name['language']);
                $student['language'] = $language_array;
                $this->session->set_userdata('student', $student);
                
                $session         = $this->session->userdata('student');
                $id              = $session['student_id'];
                $data['lang_id'] = $lang_id;
                $language_result = $this->language_model->set_studentlang($id, $data);
                }
                
                public function timeline_download($timeline_id, $doc)
                {
                $this->load->helper('download');
                $filepath = "./uploads/student_timeline/" . $doc;
                $data     = file_get_contents($filepath);
                $name     = $doc;
                force_download($name, $data);
                }
                
                public function view($id)
                {
                
                $data['title']           = 'Student Details';
                $student                 = $this->student_model->get($id);
                $student_due_fee         = $this->studentfee_model->getDueFeeBystudent($student['class_id'], $student['section_id'], $id);
                $data['student_due_fee'] = $student_due_fee;
                $transport_fee           = $this->studenttransportfee_model->getTransportFeeByStudent($student['student_session_id']);
                $data['transport_fee']   = $transport_fee;
                $examList                = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
                $data['examSchedule']    = array();
                
                
                if (!empty($examList))
                {
                $new_array = array();
                foreach ($examList as $ex_key => $ex_value) {
                $array         = array();
                $x             = array();
                $exam_id       = $ex_value['exam_id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                $exam_array                     = array();
                $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                $exam_array['exam_id']          = $value['exam_id'];
                $exam_array['full_marks']       = $value['full_marks'];
                $exam_array['passing_marks']    = $value['passing_marks'];
                $exam_array['exam_name']        = $value['name'];
                $exam_array['exam_type']        = $value['type'];
                $exam_array['attendence']       = $value['attendence'];
                $exam_array['get_marks']        = $value['get_marks'];
                $x[]                            = $exam_array;
                }
                $array['exam_name']   = $ex_value['exam_name'];
                $array['exam_result'] = $x;
                $new_array[]          = $array;
                }
                $data['examSchedule'] = $new_array;
                }
                return $data['student'] = $student;
                }
                
                
                
                
                public function getfees()
                {
                $id                    = $this->customlib->getStudentSessionUserID();
                $student_current_class = $this->customlib->getStudentCurrentClsSection();
                
                $this->session->set_userdata('top_menu', 'fees');
                $this->session->set_userdata('sub_menu', 'student/getFees');
                $category                = $this->category_model->get();
                $data['categorylist']    = $category;
                $data['sch_setting']     = $this->sch_setting_detail;
                $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
                $paymentoption           = $this->customlib->checkPaypalDisplay();
                $data['paymentoption']   = $paymentoption;
                $data['payment_method']  = false;
                if (!empty($this->payment_method)) {
                $data['payment_method'] = true;
                }
                $student_id                   = $id;
                $student                      = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);
                $class_id                     = $student_current_class->class_id;
                $section_id                   = $student_current_class->section_id;
                $data['title']                = 'Student Details';
                $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_current_class->student_session_id);
                $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_current_class->student_session_id);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee']      = $student_due_fee;
                $data['student']              = $student;
                
                $this->load->view('layout/student/header', $data);
                $this->load->view('student/getfees', $data);
                $this->load->view('layout/student/footer', $data);
                }
                
                
                public function printFeesByGroupArray()
                {
                
                $data['sch_setting'] = $this->sch_setting_detail;
                $record              = $this->input->post('data');
                $record_array        = json_decode($record);
                $fees_array          = array();
                foreach ($record_array as $key => $value) {
                $fee_groups_feetype_id = $value->fee_groups_feetype_id;
                $fee_master_id         = $value->fee_master_id;
                $fee_session_group_id  = $value->fee_session_group_id;
                $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
                $fees_array[]          = $feeList;
                }
                $data['feearray'] = $fees_array;
                $this->load->view('student/printFeesByGroupArray', $data);
                }
                
                public function getcollectfee()
                {
                $setting_result      = $this->setting_model->get();
                $data['settinglist'] = $setting_result;
                $record              = $this->input->post('data');
                $record_array        = json_decode($record);
                $fees_array = array();
                foreach ($record_array as $key => $value) {
                $fee_groups_feetype_id = $value->fee_groups_feetype_id;
                $fee_master_id         = $value->fee_master_id;
                $fee_session_group_id  = $value->fee_session_group_id;
                $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
                $fees_array[]          = $feeList;
                }
                $data['feearray'] = $fees_array;
                $result           = array(
                'view' => $this->load->view('student/getcollectfee', $data, true),
                );
                $this->output->set_output(json_encode($result));
                }
                
                public function create_doc()
                {
                
                $this->form_validation->set_rules('first_title', $this->lang->line('title'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('first_doc', $this->lang->line('document'), 'callback_handle_upload');
                
                if ($this->form_validation->run() == false) {
                $msg = array(
                'first_title' => form_error('first_title'),
                'first_doc'   => form_error('first_doc'),
                );
                $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
                } else {
                $student_id = $this->input->post('student_id');
                if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $student_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                die("Error creating folder $uploaddir");
                }
                
                $fileInfo    = pathinfo($_FILES["first_doc"]["name"]);
                $first_title = $this->input->post('first_title');
                $file_name   = $_FILES['first_doc']['name'];
                $exp         = explode(' ', $file_name);
                $imp         = implode('_', $exp);
                $img_name    = $uploaddir . basename($imp);
                move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $student_id, 'title' => $first_title, 'doc' => $imp);
                $this->student_model->adddoc($data_img);
                
                }
                
                $msg   = $this->lang->line('success_message');
                $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                
                }
                echo json_encode($array);
                
                }
                
                public function handle_upload()
                {
                
                $image_validate = $this->config->item('file_validate');
                $result         = $this->filetype_model->get();
                if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
                
                $file_type = $_FILES["first_doc"]['type'];
                $file_size = $_FILES["first_doc"]["size"];
                $file_name = $_FILES["first_doc"]["name"];
                
                $allowed_extension = array_map('trim', array_map('strtolower', explode(',', $result->file_extension)));
                $allowed_mime_type = array_map('trim', array_map('strtolower', explode(',', $result->file_mime)));
                $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mtype = finfo_file($finfo, $_FILES['first_doc']['tmp_name']);
                finfo_close($finfo);
                
                if (!in_array($mtype, $allowed_mime_type)) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed'));
                return false;
                }
                
                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('extension_not_allowed'));
                return false;
                }
                if ($file_size > $result->file_size) {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                return false;
                }
                
                return true;
                } else {
                $this->form_validation->set_message('handle_upload', $this->lang->line('the_file_field_is_required'));
                return false;
                }
                return true;
                }
                
                
                public function edit($id)
                {       
                $data['title']              = 'Edit Student';
                //$id                         = $this->customlib->getStudentSessionUserID();
                $data['id']                 = $id;
                $student                    = $this->student_model->get($id);
                $genderList                 = $this->customlib->getGender();
                $data['student']            = $student;
                $data['genderList']         = $genderList;
                $session                    = $this->setting_model->getCurrentSession();
                $vehroute_result            = $this->vehroute_model->get();
                $data['vehroutelist']       = $vehroute_result;
                $category                   = $this->category_model->get();
                $data['categorylist']       = $category;
                $data["bloodgroup"]         = $this->config->item('bloodgroup');
                $data['inserted_fields']    = $this->student_edit_field_model->get();
                $data['sch_setting_detail'] = $this->sch_setting_detail;
                
                if ($this->findSelected($data['inserted_fields'], 'firstname')) {
                $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
                }
                if ($this->findSelected($data['inserted_fields'], 'guardian_is')) {
                
                $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
                }
                if ($this->findSelected($data['inserted_fields'], 'dob')) {
                
                $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
                }
                if ($this->findSelected($data['inserted_fields'], 'gender')) {
                
                $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
                }
                if ($this->findSelected($data['inserted_fields'], 'guardian_name')) {
                $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
                
                }
                
                if ($this->findSelected($data['inserted_fields'], 'guardian_phone')) {
                
                $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');
                }
                
                
                
                $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_edit_handle_upload[file]');
                $this->form_validation->set_rules('studentsign', $this->lang->line('image'), 'callback_edit_handle_upload[studentsign]');
                $this->form_validation->set_rules('father_pic', $this->lang->line('image'), 'callback_edit_handle_upload[father_pic]');
                $this->form_validation->set_rules('mother_pic', $this->lang->line('image'), 'callback_edit_handle_upload[mother_pic]');
                $this->form_validation->set_rules('guardian_pic', $this->lang->line('image'), 'callback_edit_handle_upload[guardian_pic]');
                
                if ($this->form_validation->run() == false) {
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/edit', $data);
                $this->load->view('layout/student/footer', $data);
                } else {
                
                $student_id = $id;
                $data       = array(
                'id' => $id,
                );
                
                $firstname = $this->input->post('firstname');
                if (isset($firstname)) {
                $data['firstname'] = $this->input->post('firstname');
                }
                $rte = $this->input->post('rte');
                if (isset($rte)) {
                $data['rte'] = $this->input->post('rte');
                }
                $pincode = $this->input->post('pincode');
                if (isset($pincode)) {
                $data['pincode'] = $this->input->post('pincode');
                }
                $cast = $this->input->post('cast');
                if (isset($cast)) {
                $data['cast'] = $this->input->post('cast');
                }
                $guardian_is = $this->input->post('guardian_is');
                if (isset($guardian_is)) {
                $data['guardian_is'] = $this->input->post('guardian_is');
                }
                $previous_school = $this->input->post('previous_school');
                if (isset($previous_school)) {
                $data['previous_school'] = $this->input->post('previous_school');
                }
                $dob = $this->input->post('dob');
                if (isset($dob)) {
                $data['dob'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob')));
                }
                $current_address = $this->input->post('current_address');
                if (isset($current_address)) {
                $data['current_address'] = $this->input->post('current_address');
                }
                $permanent_address = $this->input->post('permanent_address');
                if (isset($permanent_address)) {
                $data['permanent_address'] = $this->input->post('permanent_address');
                }
                $bank_account_no = $this->input->post('bank_account_no');
                if (isset($bank_account_no)) {
                $data['bank_account_no'] = $this->input->post('bank_account_no');
                }
                $bank_name = $this->input->post('bank_name');
                if (isset($bank_name)) {
                $data['bank_name'] = $this->input->post('bank_name');
                }
                $ifsc_code = $this->input->post('ifsc_code');
                if (isset($ifsc_code)) {
                $data['ifsc_code'] = $this->input->post('ifsc_code');
                }
                $guardian_occupation = $this->input->post('guardian_occupation');
                if (isset($guardian_occupation)) {
                $data['guardian_occupation'] = $this->input->post('guardian_occupation');
                }
                $guardian_email = $this->input->post('guardian_email');
                if (isset($guardian_email)) {
                $data['guardian_email'] = $this->input->post('guardian_email');
                }
                $gender = $this->input->post('gender');
                if (isset($gender)) {
                $data['gender'] = $this->input->post('gender');
                }
                $guardian_name = $this->input->post('guardian_name');
                if (isset($guardian_name)) {
                $data['guardian_name'] = $this->input->post('guardian_name');
                }
                $guardian_relation = $this->input->post('guardian_relation');
                if (isset($guardian_relation)) {
                $data['guardian_relation'] = $this->input->post('guardian_relation');
                }
                $guardian_phone = $this->input->post('guardian_phone');
                if (isset($guardian_phone)) {
                $data['guardian_phone'] = $this->input->post('guardian_phone');
                }
                $guardian_address = $this->input->post('guardian_address');
                if (isset($guardian_address)) {
                $data['guardian_address'] = $this->input->post('guardian_address');
                }
                $adhar_no = $this->input->post('adhar_no');
                if (isset($adhar_no)) {
                $data['adhar_no'] = $this->input->post('adhar_no');
                }
                
                $samagra_id = $this->input->post('samagra_id');
                if (isset($samagra_id)) {
                $data['samagra_id'] = $this->input->post('samagra_id');
                }
                $wasupno = $this->input->post('wasupno');
                if (isset($wasupno)) {
                $data['wasupno'] = $this->input->post('wasupno');
                }
                $passportno = $this->input->post('passportno');
                if (isset($passportno)) {
                $data['passportno'] = $this->input->post('passportno');
                }
                $house             = $this->input->post('house');
                $blood_group       = $this->input->post('blood_group');
                $measurement_date  = $this->input->post('measure_date');
                $roll_no           = $this->input->post('roll_no');
                $lastname          = $this->input->post('lastname');
                $category_id       = $this->input->post('category_id');
                $religion          = $this->input->post('religion');
                $mobileno          = $this->input->post('mobileno');
                $email             = $this->input->post('email');
                $admission_date    = $this->input->post('admission_date');
                $height            = $this->input->post('height');
                $weight            = $this->input->post('weight');
                $father_name       = $this->input->post('father_name');
                $father_phone      = $this->input->post('father_phone');
                $father_occupation = $this->input->post('father_occupation');
                $mother_name       = $this->input->post('mother_name');
                $mother_phone      = $this->input->post('mother_phone');
                $mother_occupation = $this->input->post('mother_occupation');
                $sibling_id      = $this->input->post('sibling_id');
                $siblings_counts = $this->input->post('siblings_counts');
                $siblings        = $this->student_model->getMySiblings($student['parent_id'], $student_id);
                $total_siblings  = count($siblings);
                
                
                if (isset($measurement_date)) {
                $data['measurement_date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('measure_date')));
                }
                
                if (isset($house)) {
                $data['school_house_id'] = $this->input->post('house');
                }
                if (isset($blood_group)) {
                
                $data['blood_group'] = $this->input->post('blood_group');
                }
                
                if (isset($lastname)) {
                
                $data['lastname'] = $this->input->post('lastname');
                }
                
                if (isset($category_id)) {
                
                $data['category_id'] = $this->input->post('category_id');
                }
                
                if (isset($religion)) {
                
                $data['religion'] = $this->input->post('religion');
                }
                
                if (isset($mobileno)) {
                
                $data['mobileno'] = $this->input->post('mobileno');
                }
                
                if (isset($email)) {
                
                $data['email'] = $this->input->post('email');
                }
                
                if (isset($admission_date)) {
                
                $data['admission_date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date')));
                }
                
                if (isset($height)) {
                
                $data['height'] = $this->input->post('height');
                }
                
                if (isset($weight)) {
                
                $data['weight'] = $this->input->post('weight');
                }
                
                if (isset($father_name)) {
                
                $data['father_name'] = $this->input->post('father_name');
                }
                
                if (isset($father_phone)) {
                
                $data['father_phone'] = $this->input->post('father_phone');
                }
                
                if (isset($father_occupation)) {
                
                $data['father_occupation'] = $this->input->post('father_occupation');
                }
                
                if (isset($mother_name)) {
                
                $data['mother_name'] = $this->input->post('mother_name');
                }
                
                if (isset($mother_phone)) {
                
                $data['mother_phone'] = $this->input->post('mother_phone');
                }
                
                if (isset($mother_occupation)) {
                
                $data['mother_occupation'] = $this->input->post('mother_occupation');
                }
                
                $this->student_model->add($data);
                
                if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                
                
                
                if (isset($_FILES["studentsign"]) && !empty($_FILES['studentsign']['name']))
                {
                $fileInfo = pathinfo($_FILES["studentsign"]["name"]);
                $img_studname = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["studentsign"]["tmp_name"], "./uploads/student_sign/" . $img_studname);
                $data_studimg = array('id' => $id, 'studentsign' => 'uploads/student_sign/' . $img_studname);
                $this->student_model->add($data_studimg);
                }
                
                
                
                
                if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                $img_name = $id . "father" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'father_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                $img_name = $id . "mother" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                $img_name = $id . "guardian" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                
                
                
                if (isset($siblings_counts) && ($total_siblings == $siblings_counts)) {
                //if there is no change in sibling
                } else if (!isset($siblings_counts) && $sibling_id == 0 && $total_siblings > 0) {
                // add for new parent
                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                
                $data_parent_login = array(
                'username' => $this->parent_login_prefix . $student_id . "_1",
                'password' => $parent_password,
                'user_id'  => "",
                'role'     => 'parent',
                );
                
                $update_student = array(
                'id'        => $student_id,
                'parent_id' => 0,
                );
                $ins_id = $this->user_model->addNewParent($data_parent_login, $update_student);
                } else if ($sibling_id != 0) {
                //join to student with new parent
                $student_sibling = $this->student_model->get($sibling_id);
                $update_student  = array(
                'id'        => $student_id,
                'parent_id' => $student_sibling['parent_id'],
                );
                $student_sibling = $this->student_model->add($update_student);
                } else {
                
                }
                
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
                //redirect('user/user/edit');
                redirect($_SERVER['HTTP_REFERER']);
                }
                }
                
                public function findSelected($inserted_fields, $find)
                {
                foreach ($inserted_fields as $inserted_key => $inserted_value) {
                if ($find == $inserted_value->name && $inserted_value->status) {
                return true;
                }
                }
                return false;
                
                }
                
                public function edit_handle_upload($value, $field_name)
                {
                $image_validate = $this->config->item('image_validate');
                if (isset($_FILES[$field_name]) && !empty($_FILES[$field_name]['name'])) 
                {
                $file_type         = $_FILES[$field_name]['type'];
                $file_size         = $_FILES[$field_name]["size"];
                $file_name         = $_FILES[$field_name]["name"];
                $allowed_extension = $image_validate['allowed_extension'];
                $ext               = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_mime_type = $image_validate['allowed_mime_type'];
                if ($files = @getimagesize($_FILES[$field_name]['tmp_name'])) {
                
                if (!in_array($files['mime'], $allowed_mime_type)) {
                $this->form_validation->set_message('edit_handle_upload', 'File Type Not Allowed');
                return false;
                }
                
                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                $this->form_validation->set_message('edit_handle_upload', 'Extension Not Allowed');
                return false;
                }
                if ($file_size > $image_validate['upload_size']) {
                $this->form_validation->set_message('edit_handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                return false;
                }
                } else {
                $this->form_validation->set_message('edit_handle_upload', "File Type / Extension Error Uploading  Image");
                return false;
                }
                
                return true;
                }
                return true;
                }
                
                public function printFeesByName()
                {
                $data                   = array('payment' => "0");
                $record                 = $this->input->post('data');
                $invoice_id             = $this->input->post('main_invoice');
                $sub_invoice_id         = $this->input->post('sub_invoice');
                $student_session_id     = $this->input->post('student_session_id');
                $setting_result         = $this->setting_model->get();
                $data['settinglist']    = $setting_result;
                $student                = $this->studentsession_model->searchStudentsBySession($student_session_id);
                $fee_record             = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
                $data['student']        = $student;
                $data['sub_invoice_id'] = $sub_invoice_id;
                $data['feeList']        = $fee_record;
                $data['sch_setting']    = $this->sch_setting_detail;
                $this->load->view('print/printFeesByName', $data);
                }
                
                
                public function editstudent($id)
                {
                $this->blood_group        = $this->config->item('bloodgroup');
                $data['title']   = 'Edit Student';
                $data['id']      = $id;
                $student         = $this->student_model->get($id);
                $genderList      = $this->customlib->getGender();
                $data['student'] = $student;
                $data['stu']     = $this->student_model->newget($id);
                
                $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
                $data['genderList']      = $genderList;
                $session                 = $this->setting_model->getCurrentSession();
                $vehroute_result         = $this->vehroute_model->get();
                $data['vehroutelist']    = $vehroute_result;
                $class                   = $this->class_model->get();
                $setting_result          = $this->setting_model->get();
                
                $data["student_categorize"] = 'class';
                $data['classlist']          = $class;
                $category                   = $this->category_model->get();
                $data['categorylist']       = $category;
                $hostelList                 = $this->hostel_model->get();
                $data['hostelList']         = $hostelList;
                $houses                     = $this->student_model->gethouselist();
                $data['houses']             = $houses;
                $data["bloodgroup"]         = $this->blood_group;
                $siblings                   = $this->student_model->getMySiblings($student['parent_id'], $student['id']);
                $data['siblings']           = $siblings;
                $data['siblings_counts']    = count($siblings);
                $custom_fields              = $this->customfield_model->getByBelong('students');
                $data['sch_setting']        = $this->sch_setting_detail;
                
                foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
                if ($custom_fields_value['validation']) {
                $custom_fields_id   = $custom_fields_value['id'];
                $custom_fields_name = $custom_fields_value['name'];
                $this->form_validation->set_rules("custom_fields[students][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
                }
                }
                
                $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
                
                if ($this->sch_setting_detail->guardian_name) {
                $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
                }
                if ($this->sch_setting_detail->guardian_phone) {
                $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');
                }
                
                $this->form_validation->set_rules(
                'email', $this->lang->line('email'), array(
                'valid_email',
                array('check_student_email_exists', array($this->student_model, 'check_student_email_exists')),
                )
                );
                $this->form_validation->set_rules('guardian_email', $this->lang->line('guardian_email'), 'trim|valid_email|xss_clean');
                if (!$this->sch_setting_detail->adm_auto_insert) {
                
                $this->form_validation->set_rules('admission_no', $this->lang->line('admission_no'), array('required', array('check_admission_no_exists', array($this->student_model, 'valid_student_admission_no'))));
                }
                
                $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
                $this->form_validation->set_rules('father_pic', $this->lang->line('image'), 'callback_handle_father_upload');
                $this->form_validation->set_rules('mother_pic', $this->lang->line('image'), 'callback_handle_mother_upload');
                $this->form_validation->set_rules('guardian_pic', $this->lang->line('image'), 'callback_handle_guardian_upload');
                if ($this->form_validation->run() == false) {
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/StudentEdit', $data);
                $this->load->view('layout/student/footer', $data);
                } else {
                
                $custom_field_post = $this->input->post("custom_fields[students]");
                if (isset($custom_field_post)) {
                $custom_value_array = array();
                foreach ($custom_field_post as $key => $value) {
                $check_field_type = $this->input->post("custom_fields[students][" . $key . "]");
                $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
                $array_custom     = array(
                'belong_table_id' => $id,
                'custom_field_id' => $key,
                'field_value'     => $field_value,
                );
                $custom_value_array[] = $array_custom;
                }
                $this->customfield_model->updateRecord($custom_value_array, $id, 'students');
                }
                $student_id      = $this->input->post('student_id');
                $student         = $this->student_model->get($student_id);
                $sibling_id      = $this->input->post('sibling_id');
                $siblings_counts = $this->input->post('siblings_counts');
                $siblings        = $this->student_model->getMySiblings($student['parent_id'], $student_id);
                $total_siblings  = count($siblings);
                $class_id        = $this->input->post('class_id');
                $section_id      = $this->input->post('section_id');
                $hostel_room_id  = $this->input->post('hostel_room_id');
                $fees_discount   = $this->input->post('fees_discount');
                $vehroute_id     = $this->input->post('vehroute_id');
                if (empty($vehroute_id)) {
                $vehroute_id = 0;
                }
                if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
                }
                
                $data = array(
                'id'                => $id,
                'firstname'         => $this->input->post('firstname'),
                'rte'               => $this->input->post('rte'),
                'state'             => $this->input->post('state'),
                'city'              => $this->input->post('city'),
                'pincode'           => $this->input->post('pincode'),
                'cast'              => $this->input->post('cast'),
                'previous_school'   => $this->input->post('previous_school'),
                'dob'               => $this->customlib->dateFormatToYYYYMMDD($this->input->post('dob')),
                'current_address'   => $this->input->post('current_address'),
                'permanent_address' => $this->input->post('permanent_address'),
                'adhar_no'          => $this->input->post('adhar_no'),
                'samagra_id'        => $this->input->post('samagra_id'),
                'bank_account_no'   => $this->input->post('bank_account_no'),
                'bank_name'         => $this->input->post('bank_name'),
                'ifsc_code'         => $this->input->post('ifsc_code'),
                
                'guardian_email'    => $this->input->post('guardian_email'),
                'gender'            => $this->input->post('gender'),
                'guardian_name'     => $this->input->post('guardian_name'),
                'guardian_relation' => $this->input->post('guardian_relation'),
                'guardian_phone'    => $this->input->post('guardian_phone'),
                'guardian_address'  => $this->input->post('guardian_address'),
                'vehroute_id'       => $vehroute_id,
                'hostel_room_id'    => $hostel_room_id,
                'note'              => $this->input->post('note'),
                'is_active'         => 'yes',
                );
                if ($this->sch_setting_detail->guardian_occupation) {
                $data['guardian_occupation'] = $this->input->post('guardian_occupation');
                }
                $house             = $this->input->post('house');
                $blood_group       = $this->input->post('blood_group');
                $measurement_date  = $this->input->post('measure_date');
                $roll_no           = $this->input->post('roll_no');
                $lastname          = $this->input->post('lastname');
                $middlename        = $this->input->post('middlename');
                $category_id       = $this->input->post('category_id');
                $religion          = $this->input->post('religion');
                $mobileno          = $this->input->post('mobileno');
                $email             = $this->input->post('email');
                $admission_date    = $this->input->post('admission_date');
                $height            = $this->input->post('height');
                $weight            = $this->input->post('weight');
                $father_name       = $this->input->post('father_name');
                $father_phone      = $this->input->post('father_phone');
                $father_occupation = $this->input->post('father_occupation');
                $mother_name       = $this->input->post('mother_name');
                $mother_phone      = $this->input->post('mother_phone');
                $mother_occupation = $this->input->post('mother_occupation');
                
                if ($this->sch_setting_detail->guardian_name) {
                $data['guardian_is'] = $this->input->post('guardian_is');
                }
                
                if (isset($measurement_date)) {
                $data['measurement_date'] = $this->customlib->dateFormatToYYYYMMDD($this->input->post('measure_date'));
                }
                
                if (isset($house)) {
                $data['school_house_id'] = $this->input->post('house');
                }
                if (isset($blood_group)) {
                
                $data['blood_group'] = $this->input->post('blood_group');
                }
                
                if (isset($roll_no)) {
                
                $data['roll_no'] = $this->input->post('roll_no');
                }
                
                if (isset($lastname)) {
                
                $data['lastname'] = $this->input->post('lastname');
                }
                
                if (isset($middlename)) {
                $data['middlename'] = $this->input->post('middlename');
                }
                
                if (isset($category_id)) {
                
                $data['category_id'] = $this->input->post('category_id');
                }
                
                if (isset($religion)) {
                
                $data['religion'] = $this->input->post('religion');
                }
                
                if (isset($mobileno)) {
                
                $data['mobileno'] = $this->input->post('mobileno');
                }
                
                if (isset($email)) {
                
                $data['email'] = $this->input->post('email');
                }
                
                if (isset($admission_date)) {
                
                $data['admission_date'] = $this->customlib->dateFormatToYYYYMMDD($this->input->post('admission_date'));
                }
                
                if (isset($height)) {
                
                $data['height'] = $this->input->post('height');
                }
                
                if (isset($weight)) {
                
                $data['weight'] = $this->input->post('weight');
                }
                
                if (isset($father_name)) {
                
                $data['father_name'] = $this->input->post('father_name');
                }
                
                if (isset($father_phone)) {
                
                $data['father_phone'] = $this->input->post('father_phone');
                }
                
                if (isset($father_occupation)) {
                
                $data['father_occupation'] = $this->input->post('father_occupation');
                }
                
                if (isset($mother_name)) {
                
                $data['mother_name'] = $this->input->post('mother_name');
                }
                
                if (isset($mother_phone)) {
                
                $data['mother_phone'] = $this->input->post('mother_phone');
                }
                
                if (isset($mother_occupation)) {
                
                $data['mother_occupation'] = $this->input->post('mother_occupation');
                }
                
                $default_image = array('uploads/student_images/default_female.jpg', 'uploads/student_images/default_male.jpg');
                if (in_array($student['image'], $default_image)) {
                if ($this->input->post('gender') == 'Female') {
                $data['image'] = 'uploads/student_images/default_female.jpg';
                } else {
                $data['image'] = 'uploads/student_images/default_male.jpg';
                }
                }
                
                /* if (!$this->sch_setting_detail->adm_auto_insert) {
                
                $data['admission_no'] = $this->input->post('admission_no');
                }
                $this->student_model->add($data);*/
                $data_new = array(
                'student_id'    => $id,
                'class_id'      => $class_id,
                'section_id'    => $section_id,
                'session_id'    => $session,
                'fees_discount' => $fees_discount,
                );
                $insert_id = $this->student_model->add_student_session($data_new);
                if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                $img_name = $id . "father" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'father_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                $img_name = $id . "mother" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                $img_name = $id . "guardian" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
                }
                
                if (isset($siblings_counts) && ($total_siblings == $siblings_counts)) {
                //if there is no change in sibling
                } else if (!isset($siblings_counts) && $sibling_id == 0 && $total_siblings > 0) {
                // add for new parent
                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                
                $data_parent_login = array(
                'username' => $this->parent_login_prefix . $student_id . "_1",
                'password' => $parent_password,
                'user_id'  => "",
                'role'     => 'parent',
                );
                
                $update_student = array(
                'id'        => $student_id,
                'parent_id' => 0,
                );
                $ins_id = $this->user_model->addNewParent($data_parent_login, $update_student);
                } else if ($sibling_id != 0) {
                //join to student with new parent
                $student_sibling = $this->student_model->get($sibling_id);
                $update_student  = array(
                'id'        => $student_id,
                'parent_id' => $student_sibling['parent_id'],
                );
                $student_sibling = $this->student_model->add($update_student);
                } else {
                
                }
                
                $this->session->set_flashdata('msg', '<div student="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
                redirect('user/user/dashboard');
                }
                }
                
                
                
                
                
                public function getStudentRecordByID()
                {
                $this->load->model("student_model");
                $student_id = $this->input->get('student_id');
                $resultlist = $this->student_model->get($student_id);
                
                foreach ($resultlist as $key => $value) {
                
                $resultlist['full_name'] = $this->customlib->getFullName($resultlist['firstname'], $resultlist['middlename'], $resultlist['lastname'], $this->sch_setting_detail->middlename, $this->sch_setting_detail->lastname);
                }
                
                echo json_encode($resultlist);
                }
                
                public function getByClass()
                {
                $class_id = $this->input->get('class_id');
                $data     = $this->section_model->getClassBySection($class_id);
                echo json_encode($data);
                }
                public function getByClassAndSection()
                {
                $class      = $this->input->get('class_id');
                $section    = $this->input->get('section_id');
                $resultlist = $this->student_model->searchByClassSection($class, $section);
                foreach ($resultlist as $key => $value) {
                $resultlist[$key]['full_name'] = $this->customlib->getFullName($value['firstname'], $value['middlename'], $value['lastname'], $this->sch_setting_detail->middlename, $this->sch_setting_detail->lastname);
                # code...
                }
                echo json_encode($resultlist);
                }
                
                public function getByClassAndSectionExcludeMe()
                {
                $class      = $this->input->get('class_id');
                $section    = $this->input->get('section_id');
                $student_id = $this->input->get('current_student_id');
                $resultlist = $this->student_model->searchByClassSectionWithoutCurrent($class, $section, $student_id);
                
                foreach ($resultlist as $key => $value) {
                $resultlist[$key]['full_name'] = $this->customlib->getFullName($value['firstname'], $value['middlename'], $value['lastname'], $this->sch_setting_detail->middlename, $this->sch_setting_detail->lastname);
                # code...
                }
                
                echo json_encode($resultlist);
                }
                
                
                
                
                
                public function admitcard()
                {   
                    
                    
                $this->current_session    = $this->setting_model->getCurrentSession();    
                $student_data             = $this->customlib->getLoggedInUserData();
                $student_id               = $this->customlib->getStudentSessionUserID();
                $student_current_class    = $this->customlib->getStudentCurrentClsSection();
                
                
                $data['students_list']    = $this->student_model->get_student_list($student_id);         
                
                $this->session->set_userdata('top_menu', 'Examinations');
                $this->session->set_userdata('sub_menu', 'Examinations/print_admit_card');


                $examgroup_result         = $this->examgroup_model->get();
                $data['examgrouplist']    = $examgroup_result;
                
                /*$admitcard_result = $this->admitcard_model->get();*/
                $admitcard_result         = $this->admitcard_model->get_Active();
                $data['admitcardlist']    = $admitcard_result;
                
                $class                    = $this->class_model->get();
                $data['title']            = 'Add Batch';
                $data['title_list']       = 'Recent Batch';
                $data['examType']         = $this->exam_type;
                $data['classlist']        = $class;
                $session                  = $this->session_model->get();
                $data['sessionlist']      = $session;
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('session_id', $this->lang->line('student'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('admitcard', $this->lang->line('admit') . " " . $this->lang->line('card') . " " . $this->lang->line('template'), 'trim|required|xss_clean');
                
                //  $idcardlist              = $this->Generateidcard_model->getstudentidcard();
                //     $data['idcardlist']      = $idcardlist;
                
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
                $admitcard_template         = $this->input->post('admitcard');
                $data['admitcard_template'] = $admitcard_template;
                
                
                $data['student_Newvalue']    = $this->examgroupstudent_model->searchExamStudentsByExam_NewStudent($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$admitcard_template); 
                
                //$data['studentList'] = $this->examgroupstudent_model->searchExamStudentsByExam($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
            
                
                $data['admin_approval']    = $this->examgroupstudent_model->getonline_examintaion_approvedbyadmin($exam_group_id, $exam_id);
                

                $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
                
                $data['examList']               = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                $data['exam_id']                = $exam_id;
                $data['exam_group_id']          = $exam_group_id;   
                $student_value                  = $data['student_Newvalue']->student_session_id;
                $exam_group_class_batch_exam_id = $exam_id;
                $studentdetails                 = $this->examgroupstudent_model->exam_students($student_value);
                $name                           = $studentdetails['firstname'].''.$studentdetails['middlename'].''.$studentdetails['lastname'];
                $admission                      = $studentdetails['admission_no'];
                $roll                           = $studentdetails['roll_no'];
                
                $this->db->where(array('student_session_id' => $student_value,'exam_group_class_batch_exam_id' => $exam_group_class_batch_exam_id, 'exam_qrcode' => ""));      
                $q 		    =     $this->db->get('exam_group_class_batch_exam_students');
                
                $dat        =    "Student Id:$student_value,\nExam Id:$exam_group_class_batch_exam_id,\nSession Id:$this->current_session,\nName:$name\nAdmission No:$admission,\nRoll No:$roll,";
                $qr         =    $this->generate_qrcode($dat,$student_value);
                if ($q->num_rows() > 0) 
                {
                $datval                =    $q->row_array();
                $table                 =    "exam_group_class_batch_exam_students";
                $condition             =    array('student_session_id'=>$student_value,'exam_group_class_batch_exam_id' => $exam_group_class_batch_exam_id);
                $data                  =    array('exam_qrcode'=> $qr['file']);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                }
                }
                $data['sch_setting']   = $this->sch_setting_detail;   
                
                $this->load->view('layout/student/header',$data);
                $this->load->view('user/examresult/admitcard',$data);
                $this->load->view('layout/student/footer',$data);
                }
                
                
                
                
                public function getExamByExamgroup()
                {
                $exam_group_id = $this->input->post('exam_group_id');
                $data          = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                echo json_encode($data);
                }
                
                
                
                function generate_qrcode($data,$student_value)
                {
                $dirname=$student_value;
                $this->load->library('ciqrcode');
                $hex_data   = bin2hex($data);
                $save_name  = $dirname.'.png';
                $dir = 'uploads/partial_exam/';
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
                $data = array(
                'admitcard_template' => form_error('admitcard_template'),
                'post_exam_id' => form_error('post_exam_id'),
                'post_exam_group_id' => form_error('post_exam_group_id'),
                'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
                );
                $array = array('status' => 0, 'error' => $data);
                echo json_encode($array);
                } 
                else 
                {
                $post_exam_id           = $this->input->post('post_exam_id');
                $post_exam_group_id     = $this->input->post('post_exam_group_id');
                $students_array         = $this->input->post('exam_group_class_batch_exam_student_id');
                $student_id                  = $this->customlib->getStudentSessionUserID();
                $data['studid']              =   $student_id ;
                $data['post_exam_id']        =   $post_exam_id;
                $data['post_exam_group_id']  =   $post_exam_group_id;
                $data['ExamName_ExamTypeStatus'] = $this->batchsubject_model->getexamgroup_And_exam_Name($post_exam_id,$post_exam_group_id);
                $exam = $this->examgroup_model->getExamByID($post_exam_id);
                $data['exam'] = $exam;
                $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
                $data['exam_grades'] = $exam_grades;
                $data['admitcard'] = $this->admitcard_model->get($this->input->post('admitcard_template'));
                $data['exam_subjects'] = $this->batchsubject_model->getExamSubjects($post_exam_id);
                $data['exam_subjects_row'] = $this->batchsubject_model->getExamSubjects_row($post_exam_id);
                $data['student_details'] = $this->examstudent_model->getStudentsAdmitCardByExamAndStudentID($students_array, $post_exam_id);
                $data['sch_setting']= $this->sch_setting_detail;
                $student_admit_cards = $this->load->view('user/examresult/_printadmitcard', $data, true);
                $array = array('status' => '1', 'error' => '', 'page' => $student_admit_cards);
                echo json_encode($array);
                }
                }
                
                
                
                
                public function onlineExamination()
                {
                $this->session->set_userdata('top_menu', 'Examinations');
                $this->session->set_userdata('sub_menu', 'Examinations/applyonlineExamination');
                $student_data             = $this->customlib->getLoggedInUserData();
                $student_id               = $this->customlib->getStudentSessionUserID();
                $student_current_class    = $this->customlib->getStudentCurrentClsSection();
                $data['students_list']    = $this->student_model->get_student_list($student_id);
                $session_id               = $this->setting_model->getCurrentSession();
                $data['session_id']       = $session_id;
                $current_session          = $this->current_session; 
                $examgroup_result         = $this->examgroup_model->get();
                $data['examgrouplist']    = $examgroup_result;
                $data['get_groups']       = $this->examgroup_model->get_groups($student_id);
                $class                    = $this->class_model->get();
                $data['examType']         = $this->exam_type;
                $data['classlist']        = $class;
                $session                  = $this->session_model->get();
                $data['sessionlist']      = $session;
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('session_id', $this->lang->line('student'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('admitcard', $this->lang->line('admit') . " " . $this->lang->line('card') . " " . $this->lang->line('template'), 'trim|required|xss_clean');
                
                
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
                $admitcard_template         = $this->input->post('admitcard');
                $data['admitcard_template'] = $admitcard_template;
                $data['student_Newvalue']   = $this->examgroupstudent_model->searchExamStudentsByExam_NewStudent($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$admitcard_template);
                
                $data['examList']           = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                $data['exam_id']            = $exam_id;
                $data['exam_group_id']      = $exam_group_id;
                }
                
                $data['sch_setting']        =   $this->sch_setting_detail; 
                $student_data               =   $this->customlib->getLoggedInUserData();
                $student_id                 =   $this->customlib->getStudentSessionUserID();
                $student_current_class      =   $this->customlib->getStudentCurrentClsSection();
                $examid                     =   $this->input->post('exam_id');
                $exam_group_id              =   $this->input->post('exam_group_id');
                $data['getsubjectid']       =   $this->examgroup_model->online_examination_getsubjectlist($exam_group_id,$examid,$student_id);
                $data['instruction']        =   $this->examgroup_model->get_online_exam_instruction($exam_group_id,$examid);
                $data['online_exam_accept'] =   $this->examgroup_model->online_exam_accept($exam_group_id,$examid,$student_id); 
                
                $data['getst']                   =   $this->examgroup_model->getstud($examid,$exam_group_id,$student_id);
                $data['feepayment']              =   $this->examgroup_model->feepayment($exam_group_id,$examid,$student_id); 
                $data['attendence_settings']     =   $this->examgroup_model->attendence_percentage($exam_group_id,$examid,$session_id);
                $data['getstudent_workingdays']  =   $this->examgroup_model->view_attendence($student_id);
                $data['getstudent_presentdays']  =   $this->examgroup_model->view_Studentattendence($student_id);
                $data['getstudent_halfdays']     =   $this->examgroup_model->view_Studentattendence_halfdays($student_id);
                $data['getstudent_latedays']     =   $this->examgroup_model->view_Studentattendence_late($student_id);
            
                $this->load->view('layout/student/header',$data);
                $this->load->view('user/online_examination/online_examination',$data);
                $this->load->view('layout/student/footer',$data);
                }
                
                
                
                
                
                public function online_examination_get_subjectid()
                {
                $student_data             =   $this->customlib->getLoggedInUserData();
                $student_id               =   $this->customlib->getStudentSessionUserID();
                $student_current_class    =   $this->customlib->getStudentCurrentClsSection();
                $examid                   =   $this->input->post('examid');
                $exam_group_id            =   $this->input->post('exam_group_id');
                
                //$data['getsubjectid']     =   $this->examgroup_model->online_examination_getsubjectlist_old($examid,$student_id);
                
                $data['getsubjectid']     =   $this->examgroup_model->online_examination_getsubjectlist($exam_group_id,$examid,$student_id);
                
                //echo json_encode($getsubjectid);
                
                //$data['instruction']       =   $this->examgroup_model->get_online_exam_instruction();
                $data['instruction']       =   $this->examgroup_model->get_online_exam_instruction($exam_group_id,$examid);
                
                $data['online_exam_accept'] = $this->examgroup_model->online_exam_accept($exam_group_id,$examid,$student_id); 
                
                $data['getst']  =   $this->examgroup_model->getstud($examid,$exam_group_id,$student_id);
                
                if (!$this->input->is_ajax_request())
                {
                exit('No direct script access allowed');
                }                                
                
                $this->load->view('user/online_examination/online_examination_ajax',$data);
                }
                
                public function add_onlineexamination_list()
                {
                $exam_group_id      =   $this->input->post('exam_group_id');
                $exam_id            =   $this->input->post('exam_id'); 
                $subject_id         =   $this->input->post('subject_id'); 
                $student_id         =   $this->customlib->getStudentSessionUserID();
                $idd                =   $this->input->post('idd');
                $this->db->where('online_examination_examgroup',$exam_group_id);
                $this->db->where('online_examination_exam',$exam_id);
                $this->db->where('online_examination_subject',$subject_id);
                $this->db->where('online_examination_student_id',$student_id);
                $q                  =   $this->db->get('online_examination');
                
                if ( $q->num_rows() > 0 ) 
                {
                
                
                
                redirect($_SERVER['HTTP_REFERER']); 
                
                }
                
                else
                {
                
                $data = array(               
                'online_examination_examgroup'   => $exam_group_id,
                'online_examination_exam'        => $exam_id,
                'online_examination_subject'     => $subject_id,
                'online_examination_session_id'=>$this->current_session,
                'online_examination_student_id'  => $student_id );
                
                $this->db->insert('online_examination',$data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                
                redirect($_SERVER['HTTP_REFERER']); 
                
                }
                }      
                
                
                
                
                public function viewsubjectpdf ()
                {
                $examgroup           =   $this->input->post('examgroup');
                $exambatch           =   $this->input->post('exambatch');
                $studentid           =   $this->input->post('student');
                
                $data['getsubject']  =   $this->examgroup_model->view_getsubjectlist($examgroup,$exambatch,$studentid);
                if (!$this->input->is_ajax_request())
                {
                exit('No direct script access allowed');
                }
                $this->load->view('user/online_examination/online_exam_ajax',$data);
                }
                
                
                
                
                
                public function add_dat_ex()
                { 
                $this->load->library('session');
                if(isset($_POST['submit']))
                {
                $checkbox              =    $this->input->post('check');
                $examgroup             =    $this->input->post('examgroup');
                $examgroupbatch        =    $this->input->post('examgroupbatch');         
                $subjectid             =    $this->input->post('subjectid'); 
                $class_id              =    $this->input->post('class_id');
                $section_id            =    $this->input->post('section_id');        
                $student_id            =    $this->customlib->getStudentSessionUserID();
                $this->current_session =    $this->setting_model->getCurrentSession();
                $subcode               =    $this->input->post('subcode');
                $class_idd             =    $this->input->post('class_idd');
                $section_idd           =    $this->input->post('section_idd');
                $examgroupp            =   $this->input->post('examgroupp');
                $examgroupbatchh       =   $this->input->post('examgroupbatchh');
                $tb                    =   "online_examination"; 
                $tb1                   =   "online_examination_accept";
                $this->db->where('online_examination_examgroup',$this->input->post('examgroupp'));
                $this->db->where('online_examination_exam',$this->input->post('examgroupbatchh')); 
                
                
                $this->db->where('online_examination_class_id',$this->input->post('class_idd')); 
                $this->db->where('online_examination_section_id',$this->input->post('section_idd')); 
                
                $this->db->where('online_examination_session_id',$this->current_session);
                
                $this->db->where('online_examination_student_id',$student_id);
                $this->db->where('online_examination_subject_status',1);
                $q  =   $this->db->get('online_examination_accept');
                
                
                
                if ( $q->num_rows() > 0 ) 
                {
                
                $dat=array('online_examination_student_id'    => $student_id,
                'online_examination_examgroup'=>$this->input->post('examgroupp'),
                'online_examination_exam'     =>$this->input->post('examgroupbatchh'),
                'online_examination_class_id' =>$this->input->post('class_idd'),
                'online_examination_section_id' =>$this->input->post('section_idd'),
                'online_examination_session_id'=>$this->current_session);
                
                
                $data=array('online_examination_student_id'=> $student_id,
                'online_examination_examgroup'=>$this->input->post('examgroupp'),
                'online_examination_exam'=>$this->input->post('examgroupbatchh'),
                'online_examination_class_id' =>$this->input->post('class_idd'),
                'online_examination_section_id' =>$this->input->post('section_idd'),
                
                
                'online_examination_session_id'=>$this->current_session); 
                
                $this->db->delete($tb,$dat);
                $this->db->delete($tb1,$data);
                }
                
                $dat                           =     array('online_examination_examgroup'   =>   $this->input->post('examgroupp'),
                'online_examination_exam'        =>    $this->input->post('examgroupbatchh'),
                
                'online_examination_class_id' =>    $this->input->post('class_idd'),
                'online_examination_section_id'  =>    $this->input->post('section_idd'),
                
                
                'online_examination_student_id' =>    $student_id,
                'online_examination_session_id'  =>    $this->current_session,
                'online_examination_subject_status'=>1); 
                $res= $this->db->insert('online_examination_accept',$dat);
                
                
                
                for($i=0;$i<sizeof($checkbox);$i++)
                {           
                if($checkbox!="") 
                {
                
                $sub_id[$i] = $checkbox[$i];
                
                $this->db->select('*');
                $this->db->from('subjects'); $this->db->where('subjects.id', $sub_id[$i] );
                $query = $this->db->get();
                $subject= $query->row_array();
                $subj[$i]=explode('-',$subject['code']); 
                
                
                $this->db->where('online_examination_examgroup',$examgroup[$i]);
                $this->db->where('online_examination_exam',$examgroupbatch[$i]);
                $this->db->where('online_examination_subject',$sub_id[$i]);
                $this->db->where('online_examination_class_id',$class_id[$i]);
                $this->db->where('online_examination_section_id',$section_id[$i]);
                $this->db->where('online_examination_session_id',$this->current_session);
                $this->db->where('online_examination_student_id',$student_id);
                $q                  =   $this->db->get('online_examination');
                if ( $q->num_rows() > 0 ) 
                {
                }
                else
                {
                $sub_id[$i] = $checkbox[$i];
                $data[$i]                    =     array(                                                                
                'online_examination_subject'    =>    $sub_id[$i] ,
                'online_examination_examgroup'   =>    $examgroup[$i] ,
                'online_examination_exam'        =>    $examgroupbatch[$i] ,
                'online_examination_class_id'   =>    $class_id[$i] ,
                'online_examination_section_id'   =>    $section_id[$i] ,
                'online_examination_category'        =>    $subj[$i][1],
                'online_examination_student_id' =>    $student_id,
                'online_examination_session_id'  =>    $this->current_session,
                
                ); 
                $this->db->insert('online_examination', $data[$i]);                              
                
                }              
                if($res==true)
                {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
                
                } 
                
                }
                }
                
                redirect('user/user/confirm/'.$examgroupp.'/'.$examgroupbatchh ); 
                }
                
                
                
                
                
                
                
                if(isset($_POST['editconfirm']))
                {
                $checkbox              =    $this->input->post('check');
                $examgroup             =    $this->input->post('examgroup');
                $examgroupbatch        =    $this->input->post('examgroupbatch');         
                $subjectid             =    $this->input->post('subjectid'); 
                
                
                $class_id              =  $this->input->post('class_id');
                $section_id            =  $this->input->post('section_id');
                $examgroupp            =  $this->input->post('examgroupp');
                $examgroupbatchh       =  $this->input->post('examgroupbatchh');        
                $student_id            =  $this->customlib->getStudentSessionUserID();
                $this->current_session = $this->setting_model->getCurrentSession();
                $subcode               =    $this->input->post('subcode');
                $class_idd             =   $this->input->post('class_idd');
                $section_idd           =   $this->input->post('section_idd');
                $tb                    =   "online_examination"; 
                $tb1                   =   "online_examination_accept";
                $this->db->where('online_examination_examgroup',$this->input->post('examgroupp'));
                $this->db->where('online_examination_exam',$this->input->post('examgroupbatchh')); 
                $this->db->where('online_examination_class_id',$this->input->post('class_idd')); 
                $this->db->where('online_examination_section_id',$this->input->post('section_idd')); 
                $this->db->where('online_examination_session_id',$this->current_session);
                $this->db->where('online_examination_student_id',$student_id);
                $this->db->where('online_examination_subject_status',1);
                $q  =   $this->db->get('online_examination_accept');
                if ( $q->num_rows() > 0 ) 
                {
                
                $dat=array('online_examination_student_id'    => $student_id,
                'online_examination_examgroup'=>$this->input->post('examgroupp'),
                'online_examination_exam'     =>$this->input->post('examgroupbatchh'),
                'online_examination_class_id' =>$this->input->post('class_idd'),
                'online_examination_section_id' =>$this->input->post('section_idd'),
                'online_examination_session_id'=>$this->current_session);
                
                
                $data=array('online_examination_student_id'=> $student_id,
                'online_examination_examgroup'=>$this->input->post('examgroupp'),
                'online_examination_exam'=>$this->input->post('examgroupbatchh'),
                'online_examination_class_id' =>$this->input->post('class_idd'),
                'online_examination_section_id' =>$this->input->post('section_idd'),
                'online_examination_session_id'=>$this->current_session); 
                
                $this->db->delete($tb,$dat);
                $this->db->delete($tb1,$data);
                }
                
                $dat                           =     array('online_examination_examgroup'   =>   $this->input->post('examgroupp'),
                'online_examination_exam'        =>    $this->input->post('examgroupbatchh'),
                'online_examination_class_id'    =>    $this->input->post('class_idd'),
                'online_examination_section_id'  =>    $this->input->post('section_idd'),
                'online_examination_student_id'  =>    $student_id,
                'online_examination_session_id'  =>    $this->current_session,
                'online_examination_subject_status'=>1); 
                $res= $this->db->insert('online_examination_accept',$dat);
                
                
                
                for($i=0;$i<sizeof($checkbox);$i++)
                {           
                if($checkbox!="") 
                {
                
                $sub_id[$i] = $checkbox[$i];
                
                $this->db->select('*');
                $this->db->from('subjects'); $this->db->where('subjects.id', $sub_id[$i] );
                $query = $this->db->get();
                $subject= $query->row_array();
                $subj[$i]=explode('-',$subject['code']); 
                
                
                $this->db->where('online_examination_examgroup',$examgroup[$i]);
                $this->db->where('online_examination_exam',$examgroupbatch[$i]);
                $this->db->where('online_examination_subject',$sub_id[$i]);
                $this->db->where('online_examination_class_id',$class_id[$i]);
                $this->db->where('online_examination_section_id',$section_id[$i]);
                $this->db->where('online_examination_session_id',$this->current_session);
                $this->db->where('online_examination_student_id',$student_id);
                $q                  =   $this->db->get('online_examination');
                if ( $q->num_rows() > 0 ) 
                {
                }
                else
                {
                $sub_id[$i] = $checkbox[$i];
                $data[$i]                    =     array(                                                                
                'online_examination_subject'    =>    $sub_id[$i] ,
                'online_examination_examgroup'   =>    $examgroup[$i] ,
                'online_examination_exam'        =>    $examgroupbatch[$i] ,
                'online_examination_class_id'   =>    $class_id[$i] ,
                'online_examination_section_id'   =>    $section_id[$i] ,
                'online_examination_category'        =>    $subj[$i][1],
                'online_examination_student_id' =>    $student_id,
                'online_examination_session_id'  =>    $this->current_session,
                ); 
                $this->db->insert('online_examination', $data[$i]);
                }     
                
                if($res==true)
                {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
                }
                }
                }
                }
                redirect('user/user/confirmView/'.$examgroupp.'/'.$examgroupbatchh ); 
                }
                
                
                
                
                
                public function confirm($exam_group_id,$examid)
                {
                $this->session->set_userdata('top_menu', 'Examinations');
                $this->session->set_userdata('sub_menu', 'onlineExamination');
                $student_data            = $this->customlib->getLoggedInUserData();
                $student_id              = $this->customlib->getStudentSessionUserID();
                $student_current_class   = $this->customlib->getStudentCurrentClsSection();
                $data['students_list']    =   $this->student_model->get_student_list($student_id); 
                $examgroup_result         =   $this->examgroup_model->get();
                $data['examgrouplist']    =   $examgroup_result;
                $data['get_groups']       =   $this->examgroup_model->get_groups($student_id);
                $class                    =   $this->class_model->get();
                $data['examType']         =   $this->exam_type;
                $data['classlist']        =   $class;
                $session                  =   $this->session_model->get();
                $data['sessionlist']      =   $session;    
                
                $data['sch_setting']      =   $this->sch_setting_detail; 
                $student_data             =   $this->customlib->getLoggedInUserData();
                $student_id               =   $this->customlib->getStudentSessionUserID();
                $student_current_class    =   $this->customlib->getStudentCurrentClsSection();
                $data['getsubjectid']     =   $this->examgroup_model->online_examination_getsubjectlist($exam_group_id,$examid,$student_id);
                $data['instruction']      =   $this->examgroup_model->get_online_exam_instruction($exam_group_id,$examid);
                $data['online_exam_accept'] = $this->examgroup_model->online_exam_accept($exam_group_id,$examid,$student_id); 
                $data['getst']              = $this->examgroup_model->getstud($examid,$exam_group_id,$student_id);
                
                $data['listexamgroup']      = $this->examgroup_model->getlist_NewExamGroup($exam_group_id,$examid);
                
                $this->load->view('layout/student/header',$data);
                $this->load->view('user/online_examination/online_examinationConfirm',$data);
                $this->load->view('layout/student/footer',$data);
                }
                
                
                public function confirmView($exam_group_id,$examid)
                {
                $this->session->set_userdata('top_menu', 'Examinations');
                $this->session->set_userdata('sub_menu', 'onlineExamination');
                $student_data               =  $this->customlib->getLoggedInUserData();
                $student_id                 =  $this->customlib->getStudentSessionUserID();
                $student_current_class      =  $this->customlib->getStudentCurrentClsSection();
                $data['students_list']      =  $this->student_model->get_student_list($student_id); 
                $examgroup_result           =  $this->examgroup_model->get();
                $data['examgrouplist']      =  $examgroup_result;
                $data['get_groups']         =  $this->examgroup_model->get_groups($student_id);
                $class                      =  $this->class_model->get();
                $data['examType']           =  $this->exam_type;
                $data['classlist']          =  $class;
                $session                    =  $this->session_model->get();
                $data['sessionlist']        =  $session;     
                
                $data['sch_setting']        =  $this->sch_setting_detail; 
                $student_data               =  $this->customlib->getLoggedInUserData();
                $student_id                 =  $this->customlib->getStudentSessionUserID();
                $student_current_class      =  $this->customlib->getStudentCurrentClsSection();        
                
                $data['getsubjectid']       =  $this->examgroup_model->online_examination_getsubjectlist($exam_group_id,$examid,$student_id);
                $data['instruction']        =  $this->examgroup_model->get_online_exam_instruction($exam_group_id,$examid);
                $data['online_exam_accept'] =  $this->examgroup_model->online_exam_accept($exam_group_id,$examid,$student_id);
                $data['getst']              =  $this->examgroup_model->getstud($examid,$exam_group_id,$student_id);
                $data['listexamgroup']      =  $this->examgroup_model->getlist_NewExamGroup($exam_group_id,$examid);
                $data['feepayment']         =  $this->examgroup_model->feepayment($exam_group_id,$examid,$student_id);
                $this->load->view('layout/student/header',$data);
                $this->load->view('user/online_examination/online_examinationView',$data);
                $this->load->view('layout/student/footer',$data);
                }
                
                
                public function viewsubjectpdf_printer()
                {
                $data['sessionlist']        =  $this->examgroup_model->getsession();
                $studid                     =   $this->input->post('studid');
                $group                      =   $this->input->post('group');
                $batchid                    =   $this->input->post('exambatchid'); 
                
                $class_id                   =   $this->input->post('class_id');
                $section_id                 =   $this->input->post('section_id');
                $session_id                 =   $this->input->post('session_id');
                
                $student_id                 = $this->customlib->getStudentSessionUserID();
                $data['applicationfee']     =         $this->examgroup_model->getstudent_applicationfeebyStud($student_id,$group,$batchid,$class_id,$section_id,$session_id);
                $data['studid']             =   $this->onlineexam_model->get_studentdetails($studid);
                $data['studidd']            =   $this->onlineexam_model->get_studentdetails($studid);
                $data['subjects']           =   $this->onlineexam_model->get_subjectdetails($studid,$group,$batchid);
                
                $data['getstudent_workingdays']  =   $this->examgroup_model->view_attendence($studid);
                $data['getstudent_presentdays']  =   $this->examgroup_model->view_Studentattendence($studid);
                $data['getstudent_halfdays']     =   $this->examgroup_model->view_Studentattendence_halfdays($studid);
                $data['getstudent_latedays']     =   $this->examgroup_model->view_Studentattendence_late($studid);
                $data['subjects_row']            =   $this->onlineexam_model->get_subjectdetails_row($studid,$group,$batchid);
                
                
                $data['applicationsubject']      =   $this->examgroup_model->getstudent_applicationsubject($group,$batchid,$class_id,$section_id,$session_id);
                $data['bycategory']              =   $this->examgroup_model->getstudent_bycategory($student_id,$group,$batchid,$class_id,$section_id,$session_id);
                
                
                ///////////$data['attendence_settings']     =    $this->examgroup_model->attendence_percentage($group,$batchid,$session_id);
                
                
                
                $data['fee_transcation']         =$this->examgroup_model->fees_transaction($student_id,$group,$batchid,$class_id,$section_id,$session_id);
                $data['classteacher']            =$this->examgroup_model->classteacher($class_id,$section_id,$session_id);
                
                
                $data['admin']                   =$this->examgroup_model->adminrole();
                
                $html=$this->load->view('user/online_examination/online_examination_pdf',$data);
                
                
                echo json_encode($html);
                }
                
                
                public function viewprintreceipt()
                {
                $studid          =   $this->input->post('studid');
                $group           =   $this->input->post('group');
                $batchid         =   $this->input->post('exambatchid');
                $class_id        =   $this->input->post('class_id');
                $section_id      =   $this->input->post('section_id');
                $session_id      =   $this->input->post('session_id');
                $student_id      = $this->customlib->getStudentSessionUserID();
                $data['student']  = $this->examgroup_model->getstudentdetails($student_id);
                $data['fees_paymentreceipt']=$this->examgroup_model->fees_payment_receipt($student_id,$group,$batchid,$class_id,$section_id,$session_id);
                $html=$this->load->view('user/online_examination/online_exam_receipt_pdf',$data);
                echo json_encode($html);
                }
                
                
                
                
                
                public function viewprintreceiptt($group,$batchid,$class_id,$section_id,$session_id) 
                {
                $this->load->library('pdf');  
                $student_id       =  $this->customlib->getStudentSessionUserID();
                $data['student']  =  $this->examgroup_model->getstudentdetails($student_id);
                $data['fees_paymentreceipt']= $this->examgroup_model->fees_payment_receipt($student_id,$group,$batchid,$class_id,$section_id,$session_id);
                $html_content               = $this->load->view('user/online_examination/online_exam_receipt_pdf',$data,true); 
                $this->pdf->loadHtml($html_content);
                $this->pdf->setPaper('A4', 'landscape');
                
                $this->pdf->set_option('isRemoteEnabled', true);
                
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                }
                
                
                
                
                public function viewStudentsubjectpdf($studid,$group,$batchid)
                {
                    
                $this->load->library('pdf');
                $data['studid']                  =   $this->onlineexam_model->get_studentdetails($studid);
                $data['subjects']                =   $this->onlineexam_model->get_subjectdetails($studid,$group,$batchid);
                
                $data['getstudent_workingdays']  =   $this->examgroup_model->view_attendence($studid);
                $data['getstudent_presentdays']  =   $this->examgroup_model->view_Studentattendence($studid);
                $data['getstudent_latedays']     =   $this->examgroup_model->view_Studentattendence_late($studid);
                
                $data['getstudent_halfdays']     =   $this->examgroup_model->view_Studentattendence_halfdays($studid);
                
                $html_content=$this->load->view('user/online_examination/online_examination_pdf',$data,true);
                
                
                $this->pdf->loadHtml($html_content);
                
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream(""."OnlineApplication".".pdf", array("Attachment"=>0));
                
                }
                
                
                
                
                public function delete_appliedpdf($studid,$groupid,$exambatchid)
                {
                $this->current_session =   $this->setting_model->getCurrentSession();
                
                $tb                    =   "online_examination"; 
                $tb1                   =   "online_examination_accept";         
                
                
                $this->db->where('online_examination_examgroup',$groupid);
                $this->db->where('online_examination_exam',$exambatchid);
                
                $this->db->where('online_examination_student_id',$studid);
                $this->db->where('online_examination_subject_status',1);
                
                $q  =   $this->db->get('online_examination_accept');
                
                if ( $q->num_rows() > 0 ) 
                {
                
                $dat=array('online_examination_student_id'    => $studid,
                'online_examination_examgroup'=>$groupid,
                'online_examination_exam'     =>$exambatchid,
                'online_examination_session_id'=>$this->current_session);
                
                
                $data=array('online_examination_student_id'=> $studid,
                'online_examination_examgroup'=>$groupid,
                'online_examination_exam'=>$exambatchid,
                'online_examination_session_id'=>$this->current_session); 
                
                $this->db->delete($tb,$dat);
                $this->db->delete($tb1,$data);
                }
                redirect($_SERVER['HTTP_REFERER']);
                }
                
                
                
                public function getExamByExamGroup_publish_result()
                {
                $exam_group_id = $this->input->post('exam_group_id');
                $data          = $this->examgroup_model->getExamByExamGroup_publishresult($exam_group_id, true);
                echo json_encode($data);
                }
                
                
                public function print_format()
                {
                $student_id      = $this->customlib->getStudentSessionUserID();
                $examgroup       = $this->input->post('examgroupp');
                $examgroupbatch  = $this->input->post('examgroupbatchh');  
                
                $class_id        = $this->input->post('class_id');  
                $section_id      = $this->input->post('section_id'); 
                $session_id      = $this->input->post('session_id'); 
                
                
                $data['student_id']     = $student_id;
                $data['examgroup']      = $examgroup;
                $data['examgroupbatch'] = $examgroupbatch;
                
                $data['class_id']       = $class_id;
                $data['section_id']     = $section_id;
                $data['session_id']     = $session_id;
                
                
                // $data['applicationfee']=$this->examgroup_model->getstudent_applicationfee_value($examgroup,$examgroupbatch,$class_id,$section_id, $session_id,$student_id);  /* find this ----*/
                
                $data['applicationfee']=$this->examgroup_model->getstudent_applicationfee_value($examgroup,$examgroupbatch,$class_id,$section_id, $session_id,$student_id); 
                
                $data['applicationsubject']=$this->examgroup_model->getstudent_applicationsubject($examgroup,$examgroupbatch,$class_id,$section_id,$session_id);
                
                $data['bycategory']=$this->examgroup_model->getstudent_bycategory($student_id,$examgroup,$examgroupbatch,$class_id,$section_id,$session_id);
            
                $this->load->view('layout/student/header', $data);
                $this->load->view('user/online_examination/online_examination_printformat',$data);
                $this->load->view('layout/student/footer',$data);
                }
                
                
                public function meTrnSuccess()
                {
                $student_id      = $this->customlib->getStudentSessionUserID(); 
                $this->load->view('layout/student/header', $data);    
                $this->load->view('Standard/meTrnSuccess');
                $this->load->view('layout/student/footer', $data);
                }
                
                
                
                public function meTrnReq()
                {
                $data['parameters']      = file_get_contents(APPPATH . 'views/payment_store/parameters.json');  
                
                $data['totalamt']        = $this->input->post('totalamt');
                $data['student_id']      = $this->input->post('student_id');
                $data['examgroup']       = $this->input->post('examgroup');
                $data['examgroupbatch']  = $this->input->post('examgroupbatch');
                $data['class_id']        = $this->input->post('class_id');
                $data['section_id']      = $this->input->post('section_id');
                $data['session_id']      = $this->input->post('session_id');
                
                // $this->load->view('layout/student/header', $data);
                // $this->load->view('Standard/meTrnReq', $data);
                // $this->load->view('layout/student/footer', $data);
                
                $this->load->view('layout/student/header', $data);
                $this->load->view('payment_store/techprocess',$data);
                $this->load->view('layout/student/footer', $data);
                }
                
                
                
                
                public function meTrnPayment()
                {
                $student_id              = $this->customlib->getStudentSessionUserID();
                $amount                  = $this->input->post('amount');
                $paise                   = $amount*100;
                $data['OrderId']         = $this->input->post('OrderId');
                $data['responseUrl']     = $this->input->post('responseUrl');
                $data['amount']          = $paise;
                $data['meTransReqType']  = $this->input->post('meTransReqType');
                $data['currencyName']    = $this->input->post('currencyName');
                $data['mid']             = $this->input->post('mid');
                $data['enckey']          = $this->input->post('enckey');
                $data['recurPeriod']     = $this->input->post('recurPeriod');
                $data['numberRecurring'] = $this->input->post('numberRecurring');
                $data['recurDay']        = $this->input->post('recurDay');
                $data['addField1']       = $this->input->post('addField1');
                $data['addField2']       = $this->input->post('addField2');
                $data['addField3']       = $this->input->post('addField3');
                $data['addField4']       = $this->input->post('addField4');
                $data['addField5']       = $this->input->post('addField5');
                $data['addField6']       = $this->input->post('addField6');
                $this->load->view('layout/student/header', $data);
                $this->load->view('Standard/meTrnPay',$data); 
                $this->load->view('layout/student/footer', $data);             
                }
                
                
                
                public function pay()
                {
                date_default_timezone_set('Asia/Kolkata');
                $student_id              = $this->customlib->getStudentSessionUserID();
                $getStatusCode           = $this->input->post('getStatusCode');
                $getPgMeTrnRefNo         = $this->input->post('getPgMeTrnRefNo');
                $getOrderId              = $this->input->post('getOrderId');
                $getTrnAmt               = $this->input->post('getTrnAmt');
                $getStatusDesc           = $this->input->post('getStatusDesc');
                $getTrnReqDate           = $this->input->post('getTrnReqDate');
                $getResponseCode         = $this->input->post('getResponseCode');
                $getAddField1            = $this->input->post('getAddField1');
                $getAddField2            = $this->input->post('getAddField2');
                $getAddField3            = $this->input->post('getAddField3');
                $getAddField4            = $this->input->post('getAddField4');
                $getAddField5            = $this->input->post('getAddField5');
                $getAddField6            = $this->input->post('getAddField6');
                $getamt                  = $getTrnAmt/100;
                $feepay                  = array(
                'fees_payment_statuscode'     =>   $getStatusCode,
                'fees_payment_transaction_no' =>  $getPgMeTrnRefNo,
                'fees_payment_orderid'        =>  $getOrderId,
                'fees_payment_amount'         =>  $getamt,
                'fees_payment_student_id'      => $getAddField1,
                'fees_payment_examgroup'       => $getAddField2,
                'fees_payment_exam'            => $getAddField3,
                'fees_payment_class_id'        => $getAddField4,
                'fees_payment_section_id'      => $getAddField5,
                'fees_payment_session'         => $getAddField6,
                'fees_payment_transdate'       =>  $getTrnReqDate,
                'fees_payment_responsecode'    =>  $getResponseCode,
                'fees_payment_created_date'    =>  date('d-m-y H:i:s'),
                'fees_payment_year'            =>  date('Y'));
                $this->db->insert("fees_payment", $feepay);
                
                
                
                $data['examschedule']          = $this->batchsubject_model->getexamgroup_And_exam_Name($getAddField3,$getAddField2);
                $examScheduleval               = $data['examschedule'] ;
                $studentval                    = $this->onlineexam_model->getstudent($getAddField1);
                $stu                           = array($studentval['session_id']);
            
                
                if(	$getStatusCode=="S")
                {
                $examschedule         = array_merge($examScheduleval, $feepay);
                $this->mailsmsconf->mailsms('exam_payment', $stu, $getTrnReqDate, $examschedule);
                $this->load->view('layout/student/header', $data);
                $this->load->view('Standard/success', $data);
                $this->load->view('layout/student/footer', $data);
                }
                else
                { 
                $this->mailsmsconf->mailsms('exam_nonpayment', $stu, $getTrnReqDate, $examScheduleval);
                $this->load->view('layout/student/header', $data);
                $this->load->view('Standard/failed', $data);
                $this->load->view('layout/student/footer', $data);
                }
                } 
                
                
                
                
                public function payment_store()
                { 
                $data['parameters']      = file_get_contents(APPPATH . 'views/payment_store/parameters.json');
                $data['totalamt']        = $this->input->post('totalamt');
                $data['student_id']      = $this->input->post('student_id');
                $data['examgroup']       = $this->input->post('examgroup');
                $data['examgroupbatch']  = $this->input->post('examgroupbatch');
                $data['class_id']        = $this->input->post('class_id');
                $data['section_id']      = $this->input->post('section_id');
                $data['session_id']      = $this->input->post('session_id');
                
                $this->load->view('layout/student/header', $data);
                $this->load->view('payment_store/techprocess',$data);
                $this->load->view('layout/student/footer',$data); 
                }
                                

                public function response()
                { 
                $data['totalamt']        = $this->input->post('totalamt');
                $data['student_id']      = $this->input->post('student_id');
                $data['examgroup']       = $this->input->post('examgroup');
                $data['examgroupbatch']  = $this->input->post('examgroupbatch');
                $data['class_id']        = $this->input->post('class_id');
                $data['section_id']      = $this->input->post('section_id');
                $data['session_id']      = $this->input->post('session_id');

                $data['parameters']      = file_get_contents(APPPATH . 'views/payment_store/parameters.json'); 

                $this->load->view('layout/student/header', $data);
                $this->load->view('payment_store/response',$data);
                $this->load->view('layout/student/footer',$data); 
                }
                
                
                
                public function rev_response()
                { 
                $data['totalamt']        = $this->input->post('totalamt');
                $data['student_id']      = $this->input->post('student_id');
                $data['examgroup']       = $this->input->post('examgroup');
                $data['examgroupbatch']  = $this->input->post('examgroupbatch');
                $data['class_id']        = $this->input->post('class_id');
                $data['section_id']      = $this->input->post('section_id');
                $data['session_id']      = $this->input->post('session_id');
                $data['parameters'] = file_get_contents(APPPATH . 'views/revpayment_store/parameters.json'); 
                $this->load->view('layout/student/header', $data);
                $this->load->view('revpayment_store/response',$data);
                $this->load->view('layout/student/footer',$data);
                }
                
                
                
                }
