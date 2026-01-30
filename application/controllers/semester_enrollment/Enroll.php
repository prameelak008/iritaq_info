            <?php

            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            } 

            class Enroll extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();
            $this->load->model("classteacher_model");
            $this->load->model("Staff_model");
            $this->load->library('Enc_lib');
            $this->sch_setting_detail = $this->setting_model->getSetting();
            $this->load->library('Zend');
            $this->load->library('form_validation');
            $this->load->library('mailsmsconf');
            $this->blood_group        = $this->config->item('bloodgroup');
            }       






            public function forward_to_enrol()
            {
            if (!$this->rbac->hasPrivilege('candidate', 'can_view'))
            {
            access_denied();
            }
            $data['title']           = 'Forward To Enroll';
            $this->session->set_userdata('top_menu', 'semester_enrollment');
            // $this->session->set_userdata('sub_menu', 'enroll/forward_to_enrol');

            $class                          = $this->class_model->get();
            $data['classlist']              = $class;
            $userdata                       = $this->customlib->getUserData();
            $data['sch_setting']            = $this->sch_setting_detail;
            $session_result                 = $this->session_model->get();
            $data['sessionlist']            = $session_result;

            $data['current_session']        =   $this->user_model->get_current_session();
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);
            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            $data['institu']                =   $this->input->post('entrance_institute');
            $inst                           =   $data['institu'];
            $data['applicant']              =   $this->Entranceallotment_model->forwardenroll_applicants($courseid, $inst,$session_id);
            $tbl_seattype                   =   "entrance_allotmentseattype";
            $tbl_seatcondition              =   array('entrance_allot_type_status'=>1);
            $data['allot_seattype']         =   $this->Entranceallotment_model->list_data($tbl_seattype,$tbl_seatcondition);
            $data['getcourse_name']         =   $this->Entranceallotment_model->getcourse_name($courseid,$inst);

            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/forwardenroll', $data);
            $this->load->view('layout/footer');
            }




            public function afflited_enrol()
            {
            if (!$this->rbac->hasPrivilege('candidate', 'can_view'))
            {
            access_denied();
            }
            $data['title'] = 'Forward To Enroll';
            $this->session->set_userdata('top_menu', 'semester_enrollment');
            $class                   = $this->class_model->get();
            $data['classlist']       = $class;
            $userdata                = $this->customlib->getUserData();
            $data['sch_setting']     = $this->sch_setting_detail;
            $session_result          = $this->session_model->get();
            $data['sessionlist']     = $session_result;
            $data['admission_institute']    =   $this->input->post('admission_institute');
            $data['current_session']        =   $this->user_model->get_current_session();
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);
            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);
            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];
            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            $data['institu']                =   $this->input->post('entrance_institute');
            $inst                           =   $data['institu'];
            $data['applicant']              =   $this->Entranceallotment_model->forwardenroll_applicants($courseid, $inst,$session_id);
            $tbl_seattype                   =   "entrance_allotmentseattype";
            $tbl_seatcondition              =   array('entrance_allot_type_status'=>1);
            $data['allot_seattype']         =   $this->Entranceallotment_model->list_data($tbl_seattype,$tbl_seatcondition);
            $data['getcourse_name']         =   $this->Entranceallotment_model->getcourse_name($courseid,$inst);
            $category                       =   $this->category_model->get();
            $data['categorylist']           =   $category;
            $data['max_studentsid']         =   $this->Semester_enrollment_model->max_studentsid();
            $data['admission_name']         =   $this->input->post('admission_name');
            $data['applicant_id']           =   $this->input->post('applicant_id');
            $applicant_id                   =   $data['applicant_id'];
            $admission_name                 =   $data['admission_name'];
            $data['students_regid']         =   $this->Entranceallotment_model->get_students_byregid($applicant_id);
            $data['max_rollid']             =   $this->Semester_enrollment_model->max_rollid();

            $data['Programmetype_list'] =   $this->Programmetype_model->get();
            $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
            $data['semestertype_list']  =   $this->Semestertype_model->getdata();
            $data['semester_term']      =   $this->Set_duration_model->get_semester_term();  
            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/afflited_enroll', $data);
            $this->load->view('layout/footer');
            }





            public function add_frwdenrol()
            {         

            $class                          =   $this->class_model->get();
            $data['classlist']              =   $class;
            $userdata                       =   $this->customlib->getUserData();
            $data['sch_setting']            =   $this->sch_setting_detail;
            $session_result                 =   $this->session_model->get();
            $data['sessionlist']            =   $session_result;
            $data['current_session']        =   $this->user_model->get_current_session();
            $table                          =   "entranceexam_course";
            $ta                             =   "sessions";
            $condition                      =   array('entranceexam_course_status'=>1);
            $data['course']                 =   $this->Entranceallotment_model->list_data($table,$condition);

            $inst_table                     =   "entranceexam_insitute";
            $inst_condition                 =   array('entranceexam_insitutestatus'=>1);

            $data['institute']              =   $this->Entranceallotment_model->list_data($inst_table,$inst_condition);
            $data['courseid']               =   $this->input->post('entrance_course');
            $courseid                       =   $data['courseid'];

            $data['session_id']             =   $this->input->post('session');
            $session_id                     =   $data['session_id'];
            $data['institu']                =   $this->input->post('entrance_institute');
            $inst                           =   $data['institu'];
            $data['applicant']              =   $this->Entranceallotment_model->forwardenroll_applicants($courseid, $inst,$session_id);
            $tbl_seattype                   =   "entrance_allotmentseattype";
            $tbl_seatcondition              =   array('entrance_allot_type_status'=>1);
            $data['allot_seattype']         =   $this->Entranceallotment_model->list_data($tbl_seattype,$tbl_seatcondition);
            $data['getcourse_name']         =   $this->Entranceallotment_model->getcourse_name($courseid,$inst);  

            $data['applicant_id']           =   $this->input->post('applicant_id');
            $applicant_id                   =   $data['applicant_id']; 

            $data['students_regid']         =   $this->Entranceallotment_model->get_students_byregid($applicant_id);
            $students_regidd                =   $data['students_regid'];


            $data['max_rollid']             =   $this->Semester_enrollment_model->max_rollid();
            $data['max_studentsid']         =   $this->Semester_enrollment_model->max_studentsid();
            $category                       =   $this->category_model->get();
            $data['categorylist']           =   $category;


            $data['admission_name']         =   $this->input->post('admission_name');
            $admission_name                 =   $data['admission_name'];

            $data['admission_institute']    =   $this->input->post('admission_institute');

            $admission_institute            =   $data['admission_institute'];

            $data['Programmetype_list']     =   $this->Programmetype_model->get();
            $data['batch_group']            =   $this->Batchtype_model->get_batchgroup();
            $data['semestertype_list']      =   $this->Semestertype_model->getdata();
            $data['semester_term']          =   $this->Set_duration_model->get_semester_term(); 


            $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false)
            {
            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/afflited_enroll', $data);
            $this->load->view('layout/footer');
            }
            else
            {
            $insert                            = true;
            $data_setting                      = array();
            $data_setting['id']                = $this->sch_setting_detail->id;
            $data_setting['adm_auto_insert']   = $this->sch_setting_detail->adm_auto_insert;
            $data_setting['adm_update_status'] = $this->sch_setting_detail->adm_update_status;
            $admission_no                      = 0;
            $data['applicant']                 =   $this->input->post('applicant_id'); 
            $applicant                         =   $data['applicant'];
            $get_applicant                     =   $this->enroll_model->getapplicant($applicant);
            $session                           =   $this->input->post('session_id');           

            $sem_group_id                      =   $this->input->post('sem_group_id');
            $admission_no                      =       $this->input->post('admission_no');
            $roll_no                           =   $this->input->post('roll_no');
            $category                          =   $this->input->post('category');
            $receipt                           =   $this->input->post('receipt');
            $amount                            =   $this->input->post('amount');
            $adhaar_no                         =   $this->input->post('adhaar_no');


            $data_insert = array(
            'admission_no'              => $admission_no,
            'roll_no'                   => $roll_no,
            'firstname'                 => $get_applicant['admission_name'],
            'admission_date'            => date('Y-m-d'),
            'category_id'               => $category,
            'state'                     => $get_applicant['state_name'],
            'gender'                    => 'Male',
            'father_name'               => $get_applicant['admission_fathername'],
            'mother_name'               => $get_applicant['admission_mothername'],
            'guardian_name'             => $get_applicant['admission_guardian'],
            'guardian_relation'         => $get_applicant['admission_relationship'],
            'guardian_is'               => $get_applicant['admission_relationship'],
            'email'                     => $get_applicant['entrance_reg_email'],
            'previous_school'           => $get_applicant['admission_schoolname'],
            'dob'                       => $this->customlib->dateFormatToYYYYMMDD($get_applicant['admission_dob']),
            'current_address'           => $get_applicant['admission_address'],
            'permanent_address'         => $get_applicant['admission_address'],
            'mobileno'                  => $get_applicant['admission_mobile'],
            'entrance_reg_id'           => $get_applicant['admission_application_registerid'],
            'last_studied_madrasa'      => $get_applicant['admission_nameofmadarsa'],
            'last_studied_madrasa_class'=> $get_applicant['admission_laststudiedmadarsa'],
            'previous_reg_no'           => $get_applicant['admission_range'],
            'previous_medium'           => $get_applicant['admission_medium'],
            'guardian_address'          => $get_applicant['admission_guardianaddress'],
            'is_active'                 => 'yes' );
            $insert_id                  = $this->Semester_enrollment_model->add($data_insert, $data_setting); 

            if (isset($get_applicant['admission_adharno']) && !empty($get_applicant['admission_adharno'])) 
            {
            $da                        =     array('belong_table_id'  => $insert_id,'custom_field_id'=>3,'field_value'=>$get_applicant['admission_adharno'],'created_at' =>date('Y-m-d h:i:s'));
            $this->db->insert('custom_field_values', $da);
            }

            if (isset($get_applicant['entrance_reg_phone']) && !empty($get_applicant['entrance_reg_phone'])) 
            {
            $dy                        =     array('belong_table_id'  => $insert_id,'custom_field_id'=>2,'field_value'=>$get_applicant['entrance_reg_phone'],'created_at' =>date('Y-m-d h:i:s') );
            $this->db->insert('custom_field_values', $dy);
            }


            $data_new = array(
            'student_id'    => $insert_id,
            'sem_group_id'  => $sem_group_id,
            'session_id'    => $session                 
            );


            $sem_details = array(
            'stud_student_id' => $insert_id,
            'stud_semgroupid' => $sem_group_id
            );

            // avoid duplicate
            $exists = $this->db->get_where('semester_studentdetails', [
            'stud_student_id' => $insert_id,
            'stud_semgroupid' => $sem_group_id
            ])->num_rows() > 0;

            if (!$exists) {
            $this->db->insert('semester_studentdetails', $sem_details);
            }


            $this->Semester_enrollment_model->add_student_session($data_new);

            $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $data_student_login = array(
            'username' => $this->student_login_prefix . $insert_id,
            'password' => $user_password,
            'user_id'  => $insert_id,
            'role'     => 'student',
            );
            $this->Semester_enrollment_model->add_user($data_student_login);

            $parent_password   = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $temp           = $insert_id;

            $data_parent_login = array(
            'username' => $this->parent_login_prefix . $insert_id,
            'password' => $parent_password,
            'user_id'  => $insert_id,
            'role'     => 'parent',
            'childs'   => $temp,
            );
            // Insert parent login into sem_users and get its id
            $ins_parent_user_id = $this->Semester_enrollment_model->add_user($data_parent_login);

            // Update the student record with the correct parent user id
            $update_student = array(
            'id'        => $insert_id,
            'parent_id' => $ins_parent_user_id,
            );
            $this->Semester_enrollment_model->add($update_student);
            $this->db->where('studentfees_student_id', $insert_id);
            $q = $this->db->get('sem_student_admissionfees');
            if ($q->num_rows() > 0)
            {
            $update_result             =    $q->row();
            $data                      =    array(
            'studentfees_receiptno'    =>  $receipt,
            'studentfees_feesamount'   =>  $amount,
            'studentfees_student_id'   =>  $insert_id );
            $this->db->where('studentfees_id', $update_result->studentfees_id);
            $this->db->update('sem_student_admissionfees', $data);
            }
            else
            {
            $data                      =     array(                                                                
            'studentfees_receiptno'    =>  $receipt,
            'studentfees_feesamount'   =>  $amount,
            'studentfees_date'         =>  date('y-m-d h:i:s'),
            'studentfees_student_id'   =>  $insert_id ); 
            $this->db->insert('sem_student_admissionfees', $data);
            }

            if (isset($_FILES["adhaar"]) && !empty($_FILES['adhaar']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo    = pathinfo($_FILES["adhaar"]["name"]);
            $adhaar_no = 'Adhaar No';
            $file_name   = $_FILES['adhaar']['name'];
            $exp         = explode(' ', $file_name);
            $imp         = implode('_', $exp);
            $img_name    = $uploaddir . $imp;
            move_uploaded_file($_FILES["adhaar"]["tmp_name"], $img_name);

            $data_img = array('student_id' => $insert_id, 'title' => $adhaar_no, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }
            if (isset($_FILES["affidavit"]) && !empty($_FILES['affidavit']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["affidavit"]["name"]);
            $affidavit_no = 'Affidavit No';
            $file_name    = $_FILES['affidavit']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["affidavit"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $affidavit_no, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }


            if (isset($_FILES["ration"]) && !empty($_FILES['ration']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["ration"]["name"]);
            $ration_no    = 'Ration';
            $file_name    = $_FILES['ration']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["ration"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $ration_no, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }            



            if (isset($_FILES["document_one"]) && !empty($_FILES['document_one']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["document_one"]["name"]);
            $document_one  = 'Document 1';
            $file_name    = $_FILES['document_one']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["document_one"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $document_one, 'doc' => $imp);
            $this->studenSemester_enrollment_modelt_model->adddoc($data_img);
            }




            if (isset($_FILES["document_two"]) && !empty($_FILES['document_two']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["document_two"]["name"]);
            $document_two = 'Document 2';
            $file_name    = $_FILES['document_two']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["document_two"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $document_two, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }


            if (isset($_FILES["document_three"]) && !empty($_FILES['document_three']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["document_three"]["name"]);
            $document_three  =   $file_name    = $_FILES['document_three']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["document_three"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $document_three, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }


            $this->db->where(array('entrance_reg_id'=>$applicant_id, 'barcode' => ""));      
            $q 		    = $this->db->get('students');
            if ($q->num_rows() > 0) 
            {
            $data=[];
            $code=$admission_no;
            $this->zend->load('Zend/Barcode');
            $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
            imagepng($imageResource, 'barcodes/'.$code.'.png');
            $data['barcode'] = 'barcodes/'.$code.'.png';
            $barcode         =  $data['barcode'] ;
            $data            =  array('barcode'  =>  'barcodes/'.$code.'.png' );
            $this->db->where('entrance_reg_id',$get_applicant['admission_application_registerid']);
            $this->db->update('student_semester', $data);
            }

            $numberlength = strlen((string)$get_applicant['entrance_reg_phone']);
            if($numberlength<12)
            {
            $getphone='91'.''.$get_applicant['entrance_reg_phone'];
            }
            else
            {
            $getphone=$get_applicant['entrance_reg_phone'];
            }
            $data['students_reg']         =   $this->Entranceallotment_model->get_students_byregid_details($applicant_id);
            $studs                        =   $data['students_reg'];
            $admisionclass                =   $studs['class'];
            $admisionsection              =   $studs['section'];
            $admisionadmission_no         =   $studs['admission_no'];
            $admisionroll_no              =   $studs['roll_no'];
            $admisionsession              =   $studs['session'];
            $name                         =   $get_applicant['admission_name'];
            $studid                       =   $studs['studid'];
            $admissionusername            =   $this->student_login_prefix . $insert_id;
            $admissionpassword            =   $user_password;
            $message="Dear  *$name*,\n\nGreetings from *AL JAMIA AL JALALIYYA!*\n\nWe are happy to inform you that your admission has been provisionally confirmed as per the following details: \n\n*PROGRAMME  :$admisionclass* \n*ENROLLMENT NUMBER :$admisionadmission_no*\n*REGISTER  NO  :$admisionroll_no*\n*REGISTERED SESSION AND YEAR:$admisionsession*\n\nINSTITUTE DETAILS:*$admission_institute*\n\nPlease log in to our web portal https://appiritaq.info/site/userlogin and update your profile.\n*Your Login credential details*\n*Username:$admissionusername*\n*Password:$admissionpassword*\n\nFor any queries,please contact the academic office or call on +919847232786 or mail to jamiajalaliyya@gmail.com\n\n***This is an automatically generated message,please do not reply***    ";
            $this->smsgateway->sendWhatsAppSMS($getphone,$message );
            // $this->session->set_flashdata('message', 'Added Successfully.');

            $this->session->set_flashdata('msg','<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester_enrollment/Enroll/forward_to_enrol');
            }
            }


            public function printreceipt()
            {
            $applicant_id            =   $this->input->post('student_reg_id');
            $data['students_regid']  =   $this->Entranceallotment_model->get_students_byregid($applicant_id);
            $data['entrance_regid']  =   $this->Entranceallotment_model->get_entranceapplicant_byregid($applicant_id);
            $html=$this->load->view('enroll/print_receipt',$data);
            echo json_encode($html);
            }





            public function search()
            {                        
            $this->session->set_userdata('top_menu', 'semester_enrollment');
            // Page title
            $data['title'] = 'Student Search';

            // School settings
            $data['adm_auto_insert']            = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']                = $this->sch_setting_detail;

            // Class list
            $data['classlist']                  = $this->class_model->get();

            // Program types and programs
            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();

            // Semesters, batches, and terms
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();

            // Form validation
            $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
            // First load or validation failed: just show the form
            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/studentSearch', $data);
            $this->load->view('layout/footer');
            } 
            else
            {
            // Form submitted: get program and semester selection
            $program_id                     = $this->input->post('program'); 
            $semester_value                 = $this->input->post('semester'); // e.g. "1|12|3"

            // Split semester value into individual IDs: semester type, batch, term
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
            // $data['students']     = $this->Semester_enrollment_model->get_students($program_id, $semester_type_id, $batch_id, $semester_term_id);

            $data['students']               = $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);


            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/studentSearch', $data);
            $this->load->view('layout/footer');
            }
            }




            public function create()
            {
            //          if (!$this->rbac->hasPrivilege('student', 'can_add')) 
            // {
            // access_denied();
            // }


            $this->session->set_userdata('top_menu', 'semester_enrollment');


            $genderList                         = $this->customlib->getGender();


            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();


            $program_id                         = $this->input->post('program'); 
            $semester_value                     = $this->input->post('semester');
            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            $data['selected_program']       =   $program_id;
            $data['selected_semester_type'] =   $semester_type_id;
            $data['selected_batch']         =   $batch_id;
            $data['selected_term']          =   $semester_term_id;
            $program                        =   $data['selected_program'];
            $semester_id                    =   $data['selected_semester_type'];
            $batch_id                       =   $data['selected_batch'];
            $term_id                        =   $data['selected_term']; 


            $this->db->where('sem_group_program', $program_id);
            $this->db->where('sem_group_batchgroup', $batch_id);               
            $this->db->where('sem_group_semester', $semester_type_id);
            $this->db->where('sem_group_semester_term', $semester_term_id);                
            $query = $this->db->get('semester_group');


            if ($query->num_rows() == 0) 
            {
            $data_to_insert = array(
            'sem_group_batchgroup'   => $batch_id,
            'sem_group_program'      => $program_id,
            'sem_group_semester'     => $semester_type_id,
            'sem_group_semester_term'=> $semester_term_id,                
            'sem_group_createddate'  => date('Y-m-d H:i:s')
            );
            $this->db->insert('semester_group', $data_to_insert);
            $sem_group_id = $this->db->insert_id();
            } 
            else 
            {
            $row          = $query->row();
            $sem_group_id = $row->sem_group_id;
            } 

            // Semesters, batches, and terms
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();
            $data['genderList']                 = $genderList;
            $data['sch_setting']                = $this->sch_setting_detail;
            $data['title']                      = 'Add Student';
            $data['title_list']                 = 'Recently Added Student';
            $data['adm_auto_insert']            = $this->sch_setting_detail->adm_auto_insert;
            $data["student_categorize"]         = 'class';
            $session                            = $this->setting_model->getCurrentSession();
            $student_result                     = $this->student_model->getRecentRecord();
            $data['studentlist']                = $student_result;
            $class                              = $this->class_model->get('', $classteacher = 'yes');
            $data['classlist']                  = $class;
            $userdata                           = $this->customlib->getUserData();
            $category                           = $this->category_model->get();
            $data['categorylist']               = $category;
            $houses                             = $this->student_model->gethouselist();
            $data['houses']                     = $houses;
            $data["bloodgroup"]                 = $this->blood_group;
            $hostelList                         = $this->hostel_model->get();
            $data['hostelList']                 = $hostelList;
            $vehroute_result                    = $this->vehroute_model->get();
            $data['vehroutelist']               = $vehroute_result;
            $custom_fields                      = $this->customfield_model->getByBelong('students');

            foreach ($custom_fields as $custom_fields_key => $custom_fields_value) 
            {
            if ($custom_fields_value['validation'])
            {
            $custom_fields_id   = $custom_fields_value['id'];
            $custom_fields_name = $custom_fields_value['name'];
            $this->form_validation->set_rules("custom_fields[students][" . $custom_fields_id . "]", $custom_fields_name, 'trim|required');
            }
            }

            $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');


            $this->form_validation->set_rules('mobileno', $this->lang->line('mobileno'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('blood_group', $this->lang->line('blood_group'), 'trim|required|xss_clean');


            $this->form_validation->set_rules('program', $this->lang->line('programme'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester', $this->lang->line('semester'), 'trim|required|xss_clean');



            if ($this->sch_setting_detail->guardian_name)
            {
            $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
            }

            if ($this->sch_setting_detail->guardian_phone) 
            {
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

            $this->form_validation->set_rules('admission_no', $this->lang->line('admission_no'), 'trim|required|xss_clean|is_unique[students.admission_no]');
            }
            // $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');

            $data['max_studentsid']                 = $this->student_model->max_studentsid();


            if ($this->form_validation->run() == false)
            {

            $this->load->view('layout/header', $data);
            $this->load->view('semester_enrollment/studentCreate', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            $admission_no=$this->input->post('admission_no');
            $this->db->where('admission_no', $admission_no);      
            $q 		    = $this->db->get('students');
            if ($q->num_rows() > 0) 
            {
            }
            else
            {
            $custom_field_post  = $this->input->post("custom_fields[students]");
            $custom_value_array = array();
            if (!empty($custom_field_post)) 
            {

            foreach ($custom_field_post as $key => $value) {
            $check_field_type = $this->input->post("custom_fields[students][" . $key . "]");
            $field_value      = is_array($check_field_type) ? implode(",", $check_field_type) : $check_field_type;
            $array_custom     = array(
            'belong_table_id' => 0,
            'custom_field_id' => $key,
            'field_value'     => $field_value,
            );
            $custom_value_array[] = $array_custom;
            }
            }

            // $class_id   = $this->input->post('class_id');
            // $section_id = $this->input->post('section_id');

            $fees_discount  = $this->input->post('fees_discount');
            $vehroute_id    = $this->input->post('vehroute_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            if (empty($vehroute_id)) {
            $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
            $hostel_room_id = 0;
            }

            $data_insert = array(
            'firstname'                 => $this->input->post('firstname'),
            'rte'                       => $this->input->post('rte'),
            'state'                     => $this->input->post('state'),
            'city'                      => $this->input->post('city'),
            'pincode'                   => $this->input->post('pincode'),
            'cast'                      => $this->input->post('cast'),
            'previous_school'           => $this->input->post('previous_school'),
            'dob'                       => $this->customlib->dateFormatToYYYYMMDD($this->input->post('dob')),
            'current_address'           => $this->input->post('current_address'),
            'permanent_address'         => $this->input->post('permanent_address'),
            'adhar_no'                  => $this->input->post('adhar_no'),
            'samagra_id'                => $this->input->post('samagra_id'),
            'bank_account_no'           => $this->input->post('bank_account_no'),
            'bank_name'                 => $this->input->post('bank_name'),
            'ifsc_code'                 => $this->input->post('ifsc_code'),
            'guardian_email'            => $this->input->post('guardian_email'),
            'gender'                    => $this->input->post('gender'),
            'guardian_name'             => $this->input->post('guardian_name'),
            'guardian_relation'         => $this->input->post('guardian_relation'),
            'guardian_phone'            => $this->input->post('guardian_phone'),
            'guardian_address'          => $this->input->post('guardian_address'),
            'vehroute_id'               => $vehroute_id,
            'hostel_room_id'            => $hostel_room_id,
            'note'                      => $this->input->post('note'),
            'is_active'                 => 'yes',
            'last_studied_madrasa'      =>  $this->input->post('last_studied_madrasa'),
            'last_studied_madrasa_class'=>  $this->input->post('last_studied_madrasa_class'),
            'previous_reg_no'           =>  $this->input->post('previous_reg_no'),
            'previous_school'           =>  $this->input->post('last_studied_school'),
            'last_studied_class'        =>  $this->input->post('last_studied_class'),
            'previous_medium'           =>  $this->input->post('previous_medium'),
            'last_studied_institute'    =>  $this->input->post('last_studied_institute'),
            'years_completed'           =>  $this->input->post('years_completed'),
            'previous_place'            =>  $this->input->post('previous_place'),
            'name_of_prominent_teacher' =>  $this->input->post('name_of_prominent_teacher'),
            'major_books_studied'       =>  $this->input->post('major_books_studied'),
            'general_education'         =>  $this->input->post('general_education') );


            if ($this->sch_setting_detail->guardian_occupation) {
            $data_insert['guardian_occupation'] = $this->input->post('guardian_occupation');
            }
            if ($this->input->post('gender') == 'Female') 
            {
            $data_insert['image'] = 'uploads/student_images/default_female.jpg';
            } 
            else
            {
            $data_insert['image'] = 'uploads/student_images/default_male.jpg';
            }

            $house                  =    $this->input->post('house');
            $blood_group            =    $this->input->post('blood_group');
            $measurement_date       =    $this->input->post('measure_date');
            $roll_no                =    $this->input->post('roll_no');
            $lastname               =    $this->input->post('lastname');
            $middlename             =    $this->input->post('middlename');
            $category_id            =    $this->input->post('category_id');
            $religion               =    $this->input->post('religion');
            $mobileno               =    $this->input->post('mobileno');
            $email                  =    $this->input->post('email');
            $admission_date         =    $this->input->post('admission_date');
            $height                 =    $this->input->post('height');
            $weight                 =    $this->input->post('weight');
            $father_name            =    $this->input->post('father_name');
            $father_phone           =    $this->input->post('father_phone');
            $father_occupation      =    $this->input->post('father_occupation');
            $mother_name            =    $this->input->post('mother_name');
            $mother_phone           =    $this->input->post('mother_phone');
            $mother_occupation      =    $this->input->post('mother_occupation');

            if ($this->sch_setting_detail->guardian_name) {
            $data_insert['guardian_is'] = $this->input->post('guardian_is');
            }

            if (isset($measurement_date)) {
            $data_insert['measurement_date'] = $this->customlib->dateFormatToYYYYMMDD($this->input->post('measure_date'));
            }

            if (isset($house)) {
            $data_insert['school_house_id'] = $this->input->post('house');
            }
            if (isset($blood_group)) {

            $data_insert['blood_group'] = $this->input->post('blood_group');
            }

            if (isset($roll_no)) {

            $data_insert['roll_no'] = $this->input->post('roll_no');
            }

            if (isset($lastname)) {

            $data_insert['lastname'] = $this->input->post('lastname');
            }
            if (isset($middlename)) {

            $data_insert['middlename'] = $this->input->post('middlename');
            }
            if (isset($category_id)) {

            $data_insert['category_id'] = $this->input->post('category_id');
            }

            if (isset($religion)) {

            $data_insert['religion'] = $this->input->post('religion');
            }

            if (isset($mobileno)) {

            $data_insert['mobileno'] = $this->input->post('mobileno');
            }

            if (isset($email)) {

            $data_insert['email'] = $this->input->post('email');
            }

            if (isset($admission_date)) {

            $data_insert['admission_date'] = $this->customlib->dateFormatToYYYYMMDD($this->input->post('admission_date'));
            }

            if (isset($height)) {

            $data_insert['height'] = $this->input->post('height');
            }

            if (isset($weight)) {

            $data_insert['weight'] = $this->input->post('weight');
            }

            if (isset($father_name)) {

            $data_insert['father_name'] = $this->input->post('father_name');
            }

            if (isset($father_phone)) {

            $data_insert['father_phone'] = $this->input->post('father_phone');
            }

            if (isset($father_occupation)) {

            $data_insert['father_occupation'] = $this->input->post('father_occupation');
            }

            if (isset($mother_name)) {

            $data_insert['mother_name'] = $this->input->post('mother_name');
            }

            if (isset($mother_phone)) {

            $data_insert['mother_phone'] = $this->input->post('mother_phone');
            }

            if (isset($mother_occupation)) 
            {
            $data_insert['mother_occupation'] = $this->input->post('mother_occupation');
            }

            $insert                            = true;
            $data_setting                      = array();
            $data_setting['id']                = $this->sch_setting_detail->id;
            $data_setting['adm_auto_insert']   = $this->sch_setting_detail->adm_auto_insert;
            $data_setting['adm_update_status'] = $this->sch_setting_detail->adm_update_status;
            $admission_no                      = 0;

            if ($this->sch_setting_detail->adm_auto_insert) {
            if ($this->sch_setting_detail->adm_update_status) {

            $admission_no = $this->sch_setting_detail->adm_prefix . $this->sch_setting_detail->adm_start_from;

            $last_student         = $this->student_model->lastRecord();
            $last_admission_digit = str_replace($this->sch_setting_detail->adm_prefix, "", $last_student->admission_no);

            $admission_no                = $this->sch_setting_detail->adm_prefix . sprintf("%0" . $this->sch_setting_detail->adm_no_digit . "d", $last_admission_digit + 1);
            $data_insert['admission_no'] = $admission_no;
            } else {
            $admission_no                = $this->sch_setting_detail->adm_prefix . $this->sch_setting_detail->adm_start_from;
            $data_insert['admission_no'] = $admission_no;
            }

            $admission_no_exists = $this->semester_enrollment_model->check_adm_exists($admission_no);
            if ($admission_no_exists) 
            {
            $insert = false;
            }
            } else {
            $data_insert['admission_no'] = $this->input->post('admission_no');
            }
            if ($insert) 
            {
            $insert_id = $this->Semester_enrollment_model->add($data_insert, $data_setting);
            if (!empty($custom_value_array)) {
            $this->customfield_model->insertRecord($custom_value_array, $insert_id);
            }
            $data_new = array(
            'student_id'    => $insert_id,
            'sem_group_id'  => $sem_group_id,        
            // 'class_id'      => $class_id,
            // 'section_id'    => $section_id,
            // 'session_id'    => $session,
            'fees_discount' => $fees_discount,
            );


            $this->Semester_enrollment_model->add_student_session($data_new);


            $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

            $sibling_id         = $this->input->post('sibling_id');

            $data_student_login = array(
            'username' => $this->student_login_prefix . $insert_id,
            'password' => $user_password,
            'user_id'  => $insert_id,
            'role'     => 'student',
            );
            $this->Semester_enrollment_model->add_user($data_student_login);


            // if ($sibling_id > 0) {
            // $student_sibling = $this->Semester_enrollment_model->get($sibling_id);
            // $update_student  = array(
            // 'id'        => $insert_id,
            // 'parent_id' => $student_sibling['parent_id'],
            // );
            // $student_sibling = $this->Semester_enrollment_model->add($update_student);
            // } else {
            $parent_password   = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $temp              = $insert_id;
            $data_parent_login = array(
            'username' => $this->parent_login_prefix . $insert_id,
            'password' => $parent_password,
            'user_id'  => $insert_id,
            'role'     => 'parent',
            'childs'   => $temp,
            );
            $ins_parent_id  = $this->Semester_enrollment_model->add_user($data_parent_login);
            $update_student = array(
            'id'        => $insert_id,
            'parent_id' => $ins_parent_id,
            );
            $this->Semester_enrollment_model->add($update_student);
            // }           


            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $fileInfo = pathinfo($_FILES["file"]["name"]);
            $img_name = $insert_id . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["file"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $insert_id, 'image' => 'files/students/student_images/' . $img_name);
            $this->Semester_enrollment_model->add($data_img);
            }

            if (isset($_FILES["studentsign"]) && !empty($_FILES['studentsign']['name'])) 
            {
            $fileInfo = pathinfo($_FILES["studentsign"]["name"]);
            $sign_name = $insert_id . "sign" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["studentsign"]["tmp_name"], "./files/students/student_sign/" . $sign_name);
            $data_sign = array('id' => $insert_id, 'studentsign' => 'files/students/student_sign/' . $sign_name);
            $this->Semester_enrollment_model->add($data_sign);
            }



            if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
            $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
            $img_name = $insert_id . "father" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $insert_id, 'father_pic' => 'files/students/student_images/' . $img_name);
            $this->Semester_enrollment_model->add($data_img);
            }


            if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
            $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
            $img_name = $insert_id . "mother" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $insert_id, 'mother_pic' => 'files/students/student_images/' . $img_name);
            $this->Semester_enrollment_model->add($data_img);
            }


            if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
            $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
            $img_name = $insert_id . "guardian" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $insert_id, 'guardian_pic' => 'files/students/student_images/' . $img_name);
            $this->Semester_enrollment_model->add($data_img);
            }

            if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo    = pathinfo($_FILES["first_doc"]["name"]);
            $first_title = $this->input->post('first_title');
            $file_name   = $_FILES['first_doc']['name'];
            $exp         = explode(' ', $file_name);
            $imp         = implode('_', $exp);
            $img_name    = $uploaddir . $imp;
            move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $first_title, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }
            if (isset($_FILES["second_doc"]) && !empty($_FILES['second_doc']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["second_doc"]["name"]);
            $second_title = $this->input->post('second_title');
            $file_name    = $_FILES['second_doc']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["second_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $second_title, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }

            if (isset($_FILES["fourth_doc"]) && !empty($_FILES['fourth_doc']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo     = pathinfo($_FILES["fourth_doc"]["name"]);
            $fourth_title = $this->input->post('fourth_title');
            $file_name    = $_FILES['fourth_doc']['name'];
            $exp          = explode(' ', $file_name);
            $imp          = implode('_', $exp);
            $img_name     = $uploaddir . $imp;
            move_uploaded_file($_FILES["fourth_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $fourth_title, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }

            if (isset($_FILES["fifth_doc"]) && !empty($_FILES['fifth_doc']['name'])) {
            $uploaddir = './files/student_documents/' . $insert_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
            die("Error creating folder $uploaddir");
            }
            $fileInfo    = pathinfo($_FILES["fifth_doc"]["name"]);
            $fifth_title = $this->input->post('fifth_title');
            $file_name   = $_FILES['fifth_doc']['name'];
            $exp         = explode(' ', $file_name);
            $imp         = implode('_', $exp);
            $img_name    = $uploaddir . $imp;

            move_uploaded_file($_FILES["fifth_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $insert_id, 'title' => $fifth_title, 'doc' => $imp);
            $this->Semester_enrollment_model->adddoc($data_img);
            }

            $sender_details = array('student_id' => $insert_id, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));
            //$this->mailsmsconf->mailsms('student_admission', $sender_details);

            $student_login_detail = array('id' => $insert_id, 'credential_for' => 'student', 'username' => $this->student_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('mobileno'), 'email' => $this->input->post('email'));
            //$this->mailsmsconf->mailsms('login_credential', $student_login_detail);

            if ($sibling_id > 0) {

            } else {
            $parent_login_detail = array('id' => $insert_id, 'credential_for' => 'parent', 'username' => $this->parent_login_prefix . $insert_id, 'password' => $parent_password, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));
            $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
            redirect('semester_enrollment/enroll/create','refresh');
            }
            else 
            {

            $this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');

            $data['error_message'] = $this->lang->line('admission_no') . ' ' . $admission_no . ' ' . $this->lang->line('already_exists');
            $data['lastrecord']                 = $this->student_model->lastRecord();
            $this->load->view('layout/header', $data);
            $this->load->view('semester_enrollment/studentCreate', $data);
            $this->load->view('layout/footer', $data);
            }
            }
            }
            }




            public function listlogindetails()
            {
            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();
            $program_id                         = $this->input->post('program'); 
            $semester_value                     = $this->input->post('semester');            
            $data['logindetails']               = $this->Semester_enrollment_model->Newlistlogindetails(); 
            $this->load->view('layout/header', $data);
            $this->load->view('semester_enrollment/studentLoginList', $data);
            $this->load->view('layout/footer', $data);
            }
            public function getstudents()
            {
            $program_id     = $this->input->post('program_id'); 
            $semester_value = $this->input->post('semester_value');

            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            $sem_groups = $this->Semesteractivities_model->get_sem_group(
            $program_id, 
            $batch_id, 
            $semester_type_id, 
            $semester_term_id
            );

            $students = $this->Semester_enrollment_model->getNameByGroup($sem_groups['sem_group_id']);

            echo json_encode($students);
            }





            public function Loginsearchvalidation()
            {
            if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            }

            $program_id     = $this->input->post('program_id'); 
            $semester_value = $this->input->post('semester_value');
            $studentlist    = $this->input->post('namelist'); // optional

            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            // Get semester group
            $sem_group = $this->Semesteractivities_model->get_sem_group(
            $program_id,
            $batch_id,
            $semester_type_id,
            $semester_term_id
            );

            if (empty($sem_group)) {
            echo "No semester group found";
            return;
            }

            // Get login details list
            $data['studentslist'] = $this->Semester_enrollment_model
            ->NewlistlogindetailsId($sem_group['sem_group_id'],$studentlist);

            // Debug before sending view
            //echo "<pre>"; print_r($data['studentslist']); echo "</pre>"; exit;

            $this->load->view('semester_enrollment/studentslist_ajax', $data);
            }




            public function downloadExcellist()
            {
            $program_id     = $this->input->post('program_id'); 
            $semester_value = $this->input->post('semester_value');
            $studentlist    = $this->input->post('namelist');

            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            // Get semester group
            $sem_group = $this->Semesteractivities_model->get_sem_group(
            $program_id,
            $batch_id,
            $semester_type_id,
            $semester_term_id
            );

            // file name

            $filename = 'LoginDetails_'.date('Ymd').'.csv';		

            header("Content-Description: File Transfer");

            header("Content-Disposition: attachment; filename=$filename");

            header("Content-Type: application/csv; ");


            $usersData = $this->Semester_enrollment_model
            ->NewlistlogindetailsId($sem_group['sem_group_id'],$studentlist);

            // file creation

            $file   = fopen('php://output', 'w');

            $header = array("Institutional Id","firstname","lastname","Username","Password","Mobile");

            fputcsv($file, $header);

            foreach ($usersData as $key=>$line)
            {
            fputcsv($file,$line);
            }


            fclose($file);
            exit;

            }




            public function view($id)
            {        
            // if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            // access_denied();
            // }

            $sem_group_id                   = $this->input->post('sem_group_id');
            $data['sem_group_id']           = $sem_group_id; 


            $data['title']                  = 'Student Details';
            $student                        = $this->Semester_enrollment_model->get($id);
            $gradeList                   = $this->grade_model->get();
            // $studentSession          = $this->student_model->getStudentSession($id);
            $timeline                = $this->timeline_model->getStudentTimeline($id, $status = '');
            $data["timeline_list"]   = $timeline;

            // $student_session_id      = $studentSession["student_session_id"];

            // $student_session         = $studentSession["session"];
            $data['sch_setting']            = $this->sch_setting_detail;
            $data['adm_auto_insert']        = $this->sch_setting_detail->adm_auto_insert;
            // $current_student_session = $this->student_model->get_studentsession($student['student_session_id']);



            // $data["session"]                = $current_student_session["session"];
            // $student_due_fee                = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
            // $student_discount_fee           = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
            // $data['student_discount_fee']   = $student_discount_fee;
            // $data['student_due_fee']        = $student_due_fee;
            // $siblings                       = $this->student_model->getMySiblings($student['parent_id'], $student['id']);

            // $student_doc                    = $this->student_model->getstudentdoc($id);

            // $data['student_doc']            = $student_doc;
            // $data['student_doc_id']         = $id;
            $category_list                  = $this->category_model->get();
            $data['category_list']          = $category_list;
            // $data['gradeList']              = $gradeList;
            $data['student']                = $student;
            $data['siblings']               = $siblings;
            // $class_section                  = $this->student_model->getClassSection($student["class_id"]);
            // $data["class_section"]          = $class_section;
            // $session                        = $this->setting_model->getCurrentSession();

            // $studentlistbysection           = $this->student_model->getStudentClassSection($student["class_id"], $session);
            // $data["studentlistbysection"]   = $studentlistbysection;

            // $data['guardian_credential']    = $this->student_model->guardian_credential($student['parent_id']);

            $data['reason']                 = $this->disable_reason_model->get();

            if ($student['is_active'] = 'no') {
            $data['reason_data']            = $this->disable_reason_model->get($student['dis_reason']);
            }


            // $data['exam_result']            = $this->examgroupstudent_model->searchStudentExams($student['student_session_id'], true, true);
            // $data['exam_grade']             = $this->grade_model->getGradeDetails();
            $this->load->view('layout/header', $data);
            $this->load->view('semester_enrollment/studentShow', $data);
            $this->load->view('layout/footer', $data);
            }





            public function edit($id)
            {

            if (!$this->rbac->hasPrivilege('student', 'can_edit')) {
            access_denied();
            }


            $program_id                         = $this->input->post('program'); 
            $semester_value                     = $this->input->post('semester');

            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();


            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            // $data['selected_program']       =   $program_id;
            // $data['selected_semester_type'] =   $semester_type_id;
            // $data['selected_batch']         =   $batch_id;
            // $data['selected_term']          =   $semester_term_id;
            // $program                        =   $data['selected_program'];
            // $semester_id                    =   $data['selected_semester_type'];
            // $batch_id                       =   $data['selected_batch'];
            // $term_id                        =   $data['selected_term']; 


            $this->db->where('sem_group_program', $program_id);
            $this->db->where('sem_group_batchgroup', $batch_id);               
            $this->db->where('sem_group_semester', $semester_type_id);
            $this->db->where('sem_group_semester_term', $semester_term_id);                
            $query = $this->db->get('semester_group');


            if ($query->num_rows() == 0) 
            {
            $data_to_insert = array(
            'sem_group_batchgroup'   => $batch_id,
            'sem_group_program'      => $program_id,
            'sem_group_semester'     => $semester_type_id,
            'sem_group_semester_term'=> $semester_term_id,                
            'sem_group_createddate'  => date('Y-m-d H:i:s')
            );
            $this->db->insert('semester_group', $data_to_insert);
            $sem_group_id = $this->db->insert_id();
            } 
            else 
            {
            $row          = $query->row();
            $sem_group_id = $row->sem_group_id;
            }



            $data['title']           = 'Edit Student';
            $data['id']              = $id;
            $student                 = $this->Semester_enrollment_model->get($id);
            $genderList              = $this->customlib->getGender();
            $data['student']         = $student;		

            $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
            $data['genderList']      = $genderList;
            $session                 = $this->setting_model->getCurrentSession();
            $student_result         = $this->student_model->getRecentRecord();
            $vehroute_result         = $this->vehroute_model->get();
            $data['vehroutelist']    = $vehroute_result;
            // $class                   = $this->class_model->get();
            $class                      = $this->class_model->get('', $classteacher = 'yes');
            $data['classlist']          = $class;
            $setting_result          = $this->setting_model->get();

            //$data["student_categorize"] = 'class';
            //$data['classlist']          = $class;
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

            // $this->form_validation->set_rules('firstname', $this->lang->line('first_name'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('dob', $this->lang->line('date_of_birth'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('blood_group', $this->lang->line('blood_group'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('mobileno', $this->lang->line('mobileno'), 'trim|required|xss_clean');



            // $this->form_validation->set_rules('program', $this->lang->line('programme'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('semester', $this->lang->line('semester'), 'trim|required|xss_clean');

            // $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required|xss_clean');

            // if ($this->sch_setting_detail->guardian_name) {
            //     $this->form_validation->set_rules('guardian_name', $this->lang->line('guardian_name'), 'trim|required|xss_clean');
            //     $this->form_validation->set_rules('guardian_is', $this->lang->line('guardian'), 'trim|required|xss_clean');
            // }
            // if ($this->sch_setting_detail->guardian_phone) {
            //     $this->form_validation->set_rules('guardian_phone', $this->lang->line('guardian_phone'), 'trim|required|xss_clean');
            // }

            // $this->form_validation->set_rules(
            //     'email', $this->lang->line('email'), array(
            //         'valid_email',
            //         array('check_student_email_exists', array($this->student_model, 'check_student_email_exists')),
            //     )
            // );
            // $this->form_validation->set_rules('guardian_email', $this->lang->line('guardian_email'), 'trim|valid_email|xss_clean');
            // if (!$this->sch_setting_detail->adm_auto_insert) {

            //     $this->form_validation->set_rules('admission_no', $this->lang->line('admission_no'), array('required', array('check_admission_no_exists', array($this->student_model, 'valid_student_admission_no'))));
            // }

            // $this->form_validation->set_rules('file', $this->lang->line('image'), 'callback_handle_upload');
            // $this->form_validation->set_rules('studentsign', $this->lang->line('image'), 'callback_handle_studentsign_upload');

            // $this->form_validation->set_rules('father_pic', $this->lang->line('image'), 'callback_handle_father_upload');
            // $this->form_validation->set_rules('mother_pic', $this->lang->line('image'), 'callback_handle_mother_upload');
            // $this->form_validation->set_rules('guardian_pic', $this->lang->line('image'), 'callback_handle_guardian_upload');
            if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('semester_enrollment/studentEdit', $data);
            $this->load->view('layout/footer', $data);
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
            // $class_id        = $this->input->post('class_id');
            // $section_id      = $this->input->post('section_id');

            $sem_group_id      = $this->input->post('sem_group_id');

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
            'last_studied_madrasa'          =>$this->input->post('last_studied_madrasa'),
            'last_studied_madrasa_class'    =>$this->input->post('last_studied_madrasa_class'),
            'previous_reg_no'               =>$this->input->post('previous_reg_no'),
            //'last_studied_school'           =>$this->input->post('last_studied_school'),
            'last_studied_class'            =>$this->input->post('last_studied_class'),
            'previous_medium'               =>$this->input->post('previous_medium'),
            'last_studied_institute'       =>$this->input->post('last_studied_institute'),
            'years_completed'               =>$this->input->post('years_completed'),
            'previous_place'                =>$this->input->post('previous_place'),
            'name_of_prominent_teacher'     =>$this->input->post('name_of_prominent_teacher'),
            'major_books_studied'           =>$this->input->post('major_books_studied'),
            'general_education'             =>$this->input->post('general_education'),
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

            if (!$this->sch_setting_detail->adm_auto_insert) {

            $data['admission_no'] = $this->input->post('admission_no');
            }
            $this->student_model->add($data);
            $data_new = array(
            'student_id'    => $id,
            // 'class_id'      => $class_id,
            // // 'section_id'    => $section_id,
            // 'session_id'    => $session,
            'fees_discount' => $fees_discount,
            );
            $insert_id = $this->student_model->add_student_session($data_new);

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $fileInfo = pathinfo($_FILES["file"]["name"]);
            $img_name = $id . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["file"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $id, 'image' => 'files/students/student_images/' . $img_name);
            $this->student_model->add($data_img);
            }


            if (isset($_FILES["studentsign"]) && !empty($_FILES['studentsign']['name'])) 
            {
            $fileInfo = pathinfo($_FILES["studentsign"]["name"]);
            $sign_name = $insert_id . "sign" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["studentsign"]["tmp_name"], "./files/students/student_sign/" . $sign_name);
            $data_sign = array('id' => $insert_id, 'studentsign' => 'files/students/student_sign/' . $sign_name);
            $this->student_model->add($data_sign);
            }

            if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
            $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
            $img_name = $id . "father" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $id, 'father_pic' => 'files/students/student_images/' . $img_name);
            $this->student_model->add($data_img);
            }

            if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
            $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
            $img_name = $id . "mother" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $id, 'mother_pic' => 'files/students/student_images/' . $img_name);
            $this->student_model->add($data_img);
            }

            if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
            $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
            $img_name = $id . "guardian" . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./files/students/student_images/" . $img_name);
            $data_img = array('id' => $id, 'guardian_pic' => 'files/students/student_images/' . $img_name);
            $this->student_model->add($data_img);
            }

            /*

            if (isset($siblings_counts) && ($total_siblings == $siblings_counts)) 
            {
            //if there is no change in sibling
            } 

            else if (!isset($siblings_counts) && $sibling_id == 0 && $total_siblings > 0)
            {
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
            } 
            else if ($sibling_id != 0) {
            //join to student with new parent
            $student_sibling = $this->student_model->get($sibling_id);
            $update_student  = array(
            'id'        => $student_id,
            'parent_id' => $student_sibling['parent_id'],
            );
            $student_sibling = $this->student_model->add($update_student);
            } 
            else {

            }
            */

            $st			= $this->input->post('student_id');
            $sibl       = $this->input->post('sibling_id');	

            $this->student_model->addnewsiblings($st,$sibl); 

            $this->session->set_flashdata('msg', '<div student="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect($_SERVER['HTTP_REFERER']);
            }
            }



           

            public function bulk_delete()
            {                 

            $this->session->set_userdata('top_menu', 'semester_enrollment');
            // Page title
            $data['title']                      = 'Bulk Delete';                    

            // School settings
            $data['adm_auto_insert']            = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']                = $this->sch_setting_detail;

            // Class list
            $data['classlist']                  = $this->class_model->get();

            // Program types and programs
            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();

            // Semesters, batches, and terms
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();

            // Form validation
            $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
            // First load or validation failed: just show the form
            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/bulk_delete', $data);
            $this->load->view('layout/footer');
            } 
            else
            {
            // Form submitted: get program and semester selection
            $program_id                     = $this->input->post('program'); 
            $semester_value                 = $this->input->post('semester'); // e.g. "1|12|3"

            // Split semester value into individual IDs: semester type, batch, term
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
            // $data['students']     = $this->Semester_enrollment_model->get_students($program_id, $semester_type_id, $batch_id, $semester_term_id);

            $data['students']               = $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);


            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/bulk_delete', $data);
            $this->load->view('layout/footer');
            }
            }




            /*
            public function delete_data()
            {
            $ids = $this->input->post('ids');

            if (empty($ids)) {
            echo json_encode(['status' => 'no_ids']);
            return;
            }

            foreach ($ids as $id) {

            // 1. Get the row before delete
            $row = $this->db->get_where('semester_student_session', ['id' => $id])->row_array();

            if (!$row) {
            echo json_encode(['status' => 'row_not_found', 'id' => $id]);
            return;
            }

            // 2. Insert into deleted table
            $insert = $this->db->insert('backup_del_sem_student_session', [
            'student_id'   => $row['student_id'],
            'sem_group_id' => $row['sem_group_id'],
            'class_id'     => $row['class_id'],
            'section_id'   => $row['section_id'],
            'session_id'   => $row['session_id'],
            'created_at'   => $row['created_at'],
            'deleted_at'   => date('Y-m-d H:i:s'),
            'deleted_by'   => $this->session->userdata('admin_id')
            ]);

            // 3. Check if insert failed
            if (!$insert) {
            echo json_encode([
            'status' => 'insert_error',
            'db_error' => $this->db->error(),   // <-- REAL ERROR
            'row' => $row
            ]);
            return;
            }

            // 4. Delete from original table
            $this->db->delete('semester_student_session', ['id' => $id]);
            }

            echo json_encode(['status' => 'success']);
            }
            */




            public function delete_data()
            {
            $ids            = $this->input->post('ids');

            $userdata       = $this->customlib->getUserData();                

            if (empty($ids)) 
            {
            echo json_encode(['status' => 'no_ids']);
            return;
            }

            foreach ($ids as $id) 
            {
            $row        = $this->db->get_where('semester_student_session', ['id' => $id])->row_array();

            if (!$row) {
            echo json_encode(['status' => 'row_not_found', 'id' => $id]);
            return;
            }

            $insert        = $this->db->insert('backup_del_sem_student_session', [
            'student_id'   => $row['student_id'],
            'sem_group_id' => $row['sem_group_id'],
            'route_id'     => $row['route_id'], 
            'hostel_room_id' => $row['hostel_room_id'],
            'vehroute_id' => $row['vehroute_id'], 
            'transport_fees' => $row['transport_fees'],
            'fees_discount' => $row['fees_discount'], 
            'result' => $row['result'],  
            'next_status' => $row['next_status'],     


            'created_at'   => $row['created_at'],
            'deleted_at'   => date('Y-m-d H:i:s'),
            'deleted_by'   => $userdata['id']
            ]);

            if (!$insert) {
            echo json_encode([
            'status' => 'insert_error',
            'db_error' => $this->db->error()
            ]);
            return;
            }

            $this->db->delete('semester_student_session', ['id' => $id]);
            }
            echo json_encode(['status' => 'success']);
            } 



            public function getlogindetail()
            {
            // if (!$this->rbac->hasPrivilege('student_login_credential_report', 'can_view')) {
            // access_denied();
            // }
            $student_id   = $this->input->post('student_id');
            $examSchedule = $this->Semester_enrollment_model->getStudentLoginDetails($student_id);
            echo json_encode($examSchedule);
            }



            
            public function disable_reason()
            {
            $student_id = '';
            $this->form_validation->set_rules('reason', $this->lang->line('reason'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('disable_date', $this->lang->line('date'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {

            $msg = array(
            'reason' => form_error('reason'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            } else {

            $data = array(
            'dis_reason' => $this->input->post('reason'),
            'dis_note'   => $this->input->post('note'),
            'id'         => $this->input->post('student_id'),
            'disable_at' => $this->customlib->dateFormatToYYYYMMDD($this->input->post('disable_date')),
            'is_active'  => 'no',
            );

            $this->Semester_enrollment_model->add($data);

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            }
            echo json_encode($array);
            }


                    public function disablestudentslist()
                    {
                    if (!$this->rbac->hasPrivilege('disable_student', 'can_view')) {
                    access_denied();
                    }

                    $this->session->set_userdata('top_menu', 'semester_enrollment');

                    // $this->session->set_userdata('top_menu', 'Student Information');
                    // $this->session->set_userdata('sub_menu', 'student/disablestudentslist');

                    $data['adm_auto_insert']        = $this->sch_setting_detail->adm_auto_insert;
                    $data['sch_setting']            = $this->sch_setting_detail;
                    $userdata                       = $this->customlib->getUserData();

                    $data['program_types']          = $this->Semester_enrollment_model->get_program_types();
                    $data['programs']               = $this->Semester_enrollment_model->get_programs();
                    $data['semesters_batches']      = $this->Semester_enrollment_model->get_all_semesters_batches();

                    // Only run validation if form submitted (POST)
                    if ($this->input->server('REQUEST_METHOD') === 'POST') {

                    // Validation Rules
                    $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');

                    if ($this->form_validation->run() == true) {

                    // Form Valid → Load student list
                    $program_id                     = $this->input->post('program');
                    $semester_value                 = $this->input->post('semester');

                    list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

                    $data['selected_program']       = $program_id;
                    $data['selected_semester_type'] = $semester_type_id;
                    $data['selected_batch']         = $batch_id;
                    $data['selected_term']          = $semester_term_id;
                    $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group(
                    $program_id, 
                    $batch_id, 
                    $semester_type_id, 
                    $semester_term_id
                    );

                    $sem_groups                     = $data['sem_groups'];

                    $data['disable_students']       = $this->Semester_enrollment_model->getdisableStudent($sem_groups['sem_group_id']);
                    }

                    //  Whether validation failed or passed → load same view
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester_enrollment/disable_students', $data);
                    $this->load->view('layout/footer');
                    return;
                    }
                    //  Page Load (GET request)
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester_enrollment/disable_students', $data);
                    $this->load->view('layout/footer');
                    }


                    public function getUserLoginDetails()
                    {
                    $studentid = $this->input->post("student_id");
                    $result    = $this->Semester_enrollment_model->getUserLoginDetails($studentid);
                    echo json_encode($result);
                    }


                    public function enablestudent($id)
                    {
                    $data = array('is_active' => "yes");
                    $this->Semester_enrollment_model->disableStudent($id, $data);
                    echo "0";
                    }                    


               

                    public function transfer_certificate()
                    {
                    if (!$this->rbac->hasPrivilege('disable_student', 'can_view')) {
                    access_denied();
                    }

                    $this->session->set_userdata('top_menu', 'semester_enrollment');

                    // $this->session->set_userdata('top_menu', 'Student Information');
                    // $this->session->set_userdata('sub_menu', 'student/disablestudentslist');

                    $data['adm_auto_insert']        = $this->sch_setting_detail->adm_auto_insert;
                    $data['sch_setting']            = $this->sch_setting_detail;
                    $userdata                       = $this->customlib->getUserData();

                    $data['program_types']          = $this->Semester_enrollment_model->get_program_types();
                    $data['programs']               = $this->Semester_enrollment_model->get_programs();
                    $data['semesters_batches']      = $this->Semester_enrollment_model->get_all_semesters_batches();

                    // Only run validation if form submitted (POST)
                    if ($this->input->server('REQUEST_METHOD') === 'POST') {

                    // Validation Rules
                    $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');

                    if ($this->form_validation->run() == true) {

                    // Form Valid → Load student list
                    $program_id                     = $this->input->post('program');
                    $semester_value                 = $this->input->post('semester');

                    list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

                    $data['selected_program']       = $program_id;
                    $data['selected_semester_type'] = $semester_type_id;
                    $data['selected_batch']         = $batch_id;
                    $data['selected_term']          = $semester_term_id;
                    $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group(
                    $program_id, 
                    $batch_id, 
                    $semester_type_id, 
                    $semester_term_id
                    );

                    $sem_groups                     = $data['sem_groups'];
                    $data['students']               = $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);
                    $sem_group_id                   = $sem_groups['sem_group_id'] ?? 0;
                    // Get all TCs for all students in the system
                    $tc_data                        = $this->db->select('student_id, sem_group_id')
                    ->from('transfer_certificates')
                    ->get()
                    ->result_array();
                    // Create associative arrays for lookup
                    $tc_same_sem  = []; // students in SAME semester
                    $tc_other_sem = []; // students in OTHER semesters

                    foreach($tc_data as $tc) {
                    if($tc['sem_group_id'] == $sem_group_id){
                    $tc_same_sem[$tc['student_id']] = true;
                    } else {
                    $tc_other_sem[$tc['student_id']] = true;
                    }
                    }
                    $data['tc_same_sem']        = $tc_same_sem;
                    $data['tc_other_sem']       = $tc_other_sem;
                //     $data['disable_students']       = $this->Semester_enrollment_model->getdisableStudent($sem_groups['sem_group_id']);
                    }

                    //  Whether validation failed or passed → load same view
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester_enrollment/transfer_certificate', $data);
                    $this->load->view('layout/footer');
                    return;
                    }
                    //  Page Load (GET request)
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester_enrollment/transfer_certificate', $data);
                    $this->load->view('layout/footer');
                    }  


                    public function print_data()                
                    {
                    $data['studentId']     = $this->input->post('studentId');
                    $data['studentName']   = $this->input->post('studentName');
                    $data['admNo']         = $this->input->post('admNo');
                    $data['reason']        = $this->input->post('reason');
                    $data['issueDate']     = $this->input->post('issueDate');
                    $data['lastDate']      = $this->input->post('lastDate');
                    $data['conduct']       = $this->input->post('conduct');
                    $data['remarks']       = $this->input->post('remarks');
                    $data['sem_group_id']  = $this->input->post('sem_group_id');
                    $data['tcNumber']      = 'TC/' . date('Y') . '/' .  $data['admNo'];

                    // Prepare DB array
                    $insertData = [
                    'student_id'      => $data['studentId'],
                    'sem_group_id'    => $data['sem_group_id'],
                    'admission_no'    => $data['admNo'],
                    'student_name'    => $data['studentName'],
                    'reason'          => $data['reason'],
                    'issue_date'      => $data['issueDate'],
                    'last_attendance' => $data['lastDate'],
                    'conduct'         => $data['conduct'],
                    'remarks'         => $data['remarks'],
                    'tc_number'       => $data['tcNumber'],
                    'created_at'      => date('Y-m-d H:i:s')
                    ];


 
                    $existing = $this->db->where('student_id', $data['studentId'])
                    ->where('sem_group_id', $data['sem_group_id'])
                    ->get('transfer_certificates')
                    ->row();

                    if ($existing) {

                    $this->db->where('id', $existing->id)
                    ->update('transfer_certificates', $insertData);
                    $tc_id = $existing->id;
                    } else {

                    $this->db->insert('transfer_certificates', $insertData);
                    $tc_id = $this->db->insert_id();
                    }


                    $data['tc_details'] = $this->Semester_enrollment_model ->get_tc_data($data['studentId'], $data['sem_group_id']);



                    $print_page = $this->load->view(
                    'semester_enrollment/tc_print_page',
                    $data,
                    true
                    );

                    echo json_encode([
                    'status' => '1',
                    'error'  => '',
                    'page'   => $print_page
                    ]);
                    }                   


                    public function get_tc_data()
                    {
                    $student_id   = $this->input->post('student_id');
                    $sem_group_id = $this->input->post('sem_group_id');

                    $existing = $this->db
                    ->where('student_id', $student_id)
                    ->where('sem_group_id', $sem_group_id)
                    ->get('transfer_certificates')
                    ->row_array();

                    if ($existing) {
                    echo json_encode([
                    'status' => 1,
                    'data'   => $existing
                    ]);
                    } else {
                    echo json_encode([
                    'status' => 0,
                    'data'   => null
                    ]);
                    }
                    }


                    public function print_tc()                
                    {
                    $data['studentId']     = $this->input->post('studentId');                    
                    $data['sem_group_id']  = $this->input->post('sem_group_id');                    
                    $data['tc_details']    = $this->Semester_enrollment_model->get_tc_details($data['studentId']);
                    $print_page            = $this->load->view(
                    'semester_enrollment/tc_print_page',
                    $data,
                    true
                    );

                    echo json_encode([
                    'status' => '1',
                    'error'  => '',
                    'page'   => $print_page
                    ]);
                    }


                    }


