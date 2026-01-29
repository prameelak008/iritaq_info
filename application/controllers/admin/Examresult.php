        <?php
        
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }
        
        class Examresult extends Admin_Controller {
        
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
        
        
        
        
        public function printCard()
        {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('admitcard_template', $this->lang->line('template'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_id', $this->lang->line('exam'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('exam_group_class_batch_exam_student_id[]', $this->lang->line('students'), 'required|trim|xss_clean');
        $data = array();
        
        if ($this->form_validation->run() == false) {
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
        $post_exam_id = $this->input->post('post_exam_id');
        $post_exam_group_id = $this->input->post('post_exam_group_id');
        $students_array = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam'] = $exam;
        $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades'] = $exam_grades;
        $data['admitcard'] = $this->admitcard_model->get($this->input->post('admitcard_template'));
        
        $data['exam_subjects'] = $this->batchsubject_model->getExamSubjects($post_exam_id);
        
        $data['post_exam_id']=$post_exam_id;
        $data['post_exam_group_id']=$post_exam_group_id;
        
        // $data['exam_subjects'] = $this->batchsubject_model->getExamSubjects($post_exam_id,$post_exam_group_id);
        $data['exam_subjects_row'] = $this->batchsubject_model->getExamSubjects_row($post_exam_id);
        
        $data['ExamName_ExamTypeStatus'] = $this->batchsubject_model->getexamgroup_And_exam_Name($post_exam_id,$post_exam_group_id);
        
        
        $data['student_details'] = $this->examstudent_model->getStudentsAdmitCardByExamAndStudentID($students_array, $post_exam_id);
        $data['sch_setting']= $this->sch_setting_detail;
        
        $stud_details=$data['student_details'];
        
        $student_admit_cards = $this->load->view('admin/admitcard/_printadmitcard', $data, true);
        
        $array = array('status' => '1', 'error' => '', 'page' => $student_admit_cards);
        echo json_encode($array);
        }
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
        
        
        
        public function admitcard() 
        {
        if (!$this->rbac->hasPrivilege('print_admit_card', 'can_view')) 
        {
        access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult/admitcard');
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        $data['current_session'] = $this->sch_current_session;
        
        $admitcard_result = $this->admitcard_model->get();
        $data['admitcardlist'] = $admitcard_result;
        $class = $this->class_model->get();
        $data['title'] = 'Add Batch';
        $data['title_list'] = 'Recent Batch';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
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
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $admitcard_template = $this->input->post('admitcard');
        $data['admitcard_template'] = $admitcard_template;
        
        $data['studentList'] = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);        
        
        $stud_details=$data['studentList'];
        
        
        $data['examList'] = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        $data['exam_id'] = $exam_id;
        $data['exam_group_id'] = $exam_group_id;
        
        
        foreach($stud_details as $key)
        {
        $student_value                  = $key->student_session_id;
        $exam_group_class_batch_exam_id = $exam_id;
        $studentdetails                 = $this->examgroupstudent_model->exam_students($student_value);
        $name                   =$studentdetails['firstname'].''.$studentdetails['middlename'].''.$studentdetails['lastname'];
        $admission              =$studentdetails['admission_no'];
        $roll                   =$studentdetails['roll_no'];
        $this->db->where(array('student_session_id' => $student_value,'exam_group_class_batch_exam_id' => $exam_group_class_batch_exam_id, 'exam_qrcode' => ""));      
        $q 		    =     $this->db->get('exam_group_class_batch_exam_students');
        $dat       =    "Student Id:$student_value,\nExam Id:$exam_group_class_batch_exam_id,\nSession Id:$this->sch_current_session,\nName:$name,\nAdmission No:$admission,\nRoll No:$roll,";
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
        }
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/admitcard', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        public function admitcardscanqr() 
        {
         if (!$this->rbac->hasPrivilege('generateidcard', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult/admitcardscanqr');
        
          $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        $data['current_session'] = $this->sch_current_session;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;

        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        $idcardlist              = $this->Generateidcard_model->getstudentidcard();
        $data['idcardlist']      = $idcardlist;
        $button                  = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/examresult/admitcardscanqr', $data);
            $this->load->view('layout/footer', $data);
        } 
        else
        {
            
            $exam_group_id = $this->input->post('exam_group_id');
            $exam_id = $this->input->post('exam_id');
            $session_id = $this->input->post('session_id');
            $class   = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search  = $this->input->post('search');
            $id_card = $this->input->post('id_card');
            
            if (isset($search))
            {
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');

                $this->form_validation->set_rules('id_card', $this->lang->line('id_card_template'), 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {

                } else {
                    $data['searchby']     = "filter";
                    $exam_group_id = $this->input->post('exam_group_id');
                    $exam_id = $this->input->post('exam_id');
                    $session_id = $this->input->post('session_id');
                    $data['class_id']     = $this->input->post('class_id');
                    $data['section_id']   = $this->input->post('section_id');
                    $id_card              = $this->input->post('id_card');
                    
                    $data['exam_id']      = $exam_id;
                    $data['exam_group_id']=$exam_group_id;
                    $data['session_id']   =$session_id;
                    $idcardResult         = $this->Generateidcard_model->getidcardbyid($id_card);
                    $data['idcardResult'] = $idcardResult;
                    // $resultlist           = $this->student_model->searchByClassSection($class, $section);
                    // $data['resultlist']   = $resultlist;
                    
                    $resultlist           = $this->student_model->searchByClassSection_admitteemplate($exam_group_id, $exam_id,$class, $section,$session_id);
                    $data['resultlist']   = $resultlist;
                    $title                = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                    
                    $data['title']        = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
                }
            }
            
            
            

            $this->load->view('layout/header', $data);
            $this->load->view('admin/examresult/admitcardscanqr', $data);
            $this->load->view('layout/footer', $data);
        } 
        }
        
        
        
        
          
    public function generatemultiple()
    {
    $studentid           = $this->input->post('data');
    $student_array       = json_decode($studentid);
    $idcard              = $this->input->post('id_card');
    $class               = $this->input->post('class_id');
    $data['exam_qrcode'] = $this->input->post('exam_qrcode');
    $data                = array();
    $results             = array();
    $std_arr             = array();
    $data['sch_setting'] = $this->setting_model->get();
    $data['id_card']     = $this->Generateidcard_model->getidcardbyid($idcard);
    
    
    
    $exam_id              = $this->input->post('exam_id');
    $session              = $this->input->post('session_id');
    $exam_group_id        = $this->input->post('exam_group_id');
    
    
    $res    = $this->student_model->get_max_date_to_from_exam($exam_group_id,$exam_id,$session);
    
    $data['maxToDate'] = $res['max_to_date_formatted'];
    
    $data['id_card_backend']     = $this->Generateidcard_model->getidcardbyid_backend();
    
    foreach ($student_array as $key => $value)
    {
    $std_arr[]           = $value->student_id;
    $this->db->where(array('id'=>$value->student_id, 'barcode' => ""));      
    $q 		    = $this->db->get('students');
    if ($q->num_rows() > 0) 
    {
    $update_result             = $q->row();   
        
    $data=[];
    $code=$update_result->admission_no;
    $this->zend->load('Zend/Barcode');
    $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
    imagepng($imageResource, 'barcodes/'.$code.'.png');
    $data['barcode'] = 'barcodes/'.$code.'.png';
    $barcode         =  $data['barcode'] ;
    $data            =  array('barcode'  =>  'barcodes/'.$code.'.png' );
    
    $this->db->where('id',$value->student_id);
    $this->db->update('students', $data);
    }
    
    $this->db->where(array('id'=>$value->student_id, 'qrcode' => ""));      
    $q 		               = $this->db->get('students');
    if ($q->num_rows() > 0) 
    {
    $datval                =   $q->row_array();
    $stud_id               =    $datval['id'];
    $firstname             =   $datval['firstname'];
    $middlename            =   $datval['middlename'];
    $lastname              =   $datval['lastname'];
    $middlename            =   $datval['middlename'];
    $mobileno              =   $datval['mobileno'];
    $father_name           =   $datval['father_name'];
    $father_mobile         =   $datval['father_phone'];
    $current_address       =   $datval['current_address'];
    
    $data= "Name:$firstname\nMobile:$mobileno\nFather Name:$father_name\nFather Mobile:$father_mobile\nHouse Name: $current_address";
    $qr                    =    $this->generate_qrcode($data,$stud_id);
    
    $table                 =    "students";
    $condition             =    array('id'=>$datval['id']);
    $data                  =    array('qrcode'=> $qr['file']);
    $this->db->where('id',$datval['id']);
    $this->db->update('students', $data);
    }
    }

 
 
    $data['students']        = $this->student_model->getStudentsByArray_admittemplate($std_arr);
    $data['sch_settingdata'] = $this->sch_setting_detail;
    
    $id_cards = $this->load->view('admin/examresult/generatemultiple', $data, true);
    echo json_encode(array('status' => 1, 'page' => $id_cards));
    
        }
          
          
        
        
        
    //      public function generatemultiple()
    //     {
    //     $this->form_validation->set_error_delimiters('', '');
    //   // $this->form_validation->set_rules('admitcard_template', $this->lang->line('template'), 'required|trim|xss_clean');
    //     $this->form_validation->set_rules('post_exam_id', $this->lang->line('exam'), 'required|trim|xss_clean');
    //     $this->form_validation->set_rules('post_exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'required|trim|xss_clean');
    //     $this->form_validation->set_rules('exam_group_class_batch_exam_student_id[]', $this->lang->line('students'), 'required|trim|xss_clean');
    //     $data = array();
        
    //     if ($this->form_validation->run() == false) {
    //     $data = array(
    //   // 'admitcard_template' => form_error('admitcard_template'),
    //     'post_exam_id' => form_error('post_exam_id'),
    //     'post_exam_group_id' => form_error('post_exam_group_id'),
    //     'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
    //     );
    //     $array = array('status' => 0, 'error' => $data);
    //     echo json_encode($array);
    //     } 
    //     else
    //     {
            
    //       $studentid           = $this->input->post('data');
    // $student_array       = json_decode($studentid);
    // $std_arr             = array();
            
          
          
    // $data['id_card_backend']     = $this->Generateidcard_model->getidcardbyid_backend();
    //     $id_card = $this->input->post('admitcard_template');  
    //     $data['id_card']     = $this->Generateidcard_model->getidcardbyid($idcard);
    //     $post_exam_id = $this->input->post('post_exam_id');
    //     $post_exam_group_id = $this->input->post('post_exam_group_id');
    //     $students_array = $this->input->post('exam_group_class_batch_exam_student_id');
    //     $exam = $this->examgroup_model->getExamByID($post_exam_id);
    //     $data['exam'] = $exam;
    //     $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
    //     $data['exam_grades'] = $exam_grades;
    //   // $data['admitcard'] = $this->admitcard_model->get($this->input->post('admitcard_template'));
    //     $id_card              = $this->input->post('id_card');
    //     $idcardResult         = $this->Generateidcard_model->getidcardbyid($id_card);
    //     $data['idcardResult'] = $idcardResult;
        
    //     $data['exam_subjects'] = $this->batchsubject_model->getExamSubjects($post_exam_id);
        
    //     $data['post_exam_id']=$post_exam_id;
    //     $data['post_exam_group_id']=$post_exam_group_id;
        
    //     // $data['exam_subjects'] = $this->batchsubject_model->getExamSubjects($post_exam_id,$post_exam_group_id);
    //     $data['exam_subjects_row'] = $this->batchsubject_model->getExamSubjects_row($post_exam_id);
        
    //     $data['ExamName_ExamTypeStatus'] = $this->batchsubject_model->getexamgroup_And_exam_Name($post_exam_id,$post_exam_group_id);
        
        
    //     $data['student_details'] = $this->examstudent_model->getStudentsAdmitCardByExamAndStudentID($students_array, $post_exam_id);
    //     $data['sch_setting']= $this->sch_setting_detail;
        
    //     $stud_details=$data['student_details'];
        
    //      $data['students']        = $this->student_model->getStudentsByArray($std_arr);
        
    //     $student_admit_cards = $this->load->view('admin/examresult/generatemultiple', $data, true);
        
    //     $array = array('status' => '1', 'error' => '', 'page' => $student_admit_cards);
    //     echo json_encode($array);
    //     }
    //     }
        
        
        
        
    //  public function generatemultiple()
    // {
    // $studentid           = $this->input->post('data');
    // $student_array       = json_decode($studentid);
    // $idcard              = $this->input->post('id_card');
    // $class               = $this->input->post('class_id');
    // $data                = array();
    // $results             = array();
    // $std_arr             = array();
    // $data['sch_setting'] = $this->setting_model->get();
    // $data['id_card']     = $this->Generateidcard_model->getidcardbyid($idcard);
    
    // $data['id_card_backend']     = $this->Generateidcard_model->getidcardbyid_backend();
    
    // foreach ($student_array as $key => $value)
    // {
    // $std_arr[]           = $value->student_id;
    // $this->db->where(array('id'=>$value->student_id, 'barcode' => ""));      
    // $q 		    = $this->db->get('students');
    // if ($q->num_rows() > 0) 
    // {
    // $update_result             = $q->row();   
        
    // $data=[];
    // $code=$update_result->admission_no;
    // $this->zend->load('Zend/Barcode');
    // $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
    // imagepng($imageResource, 'barcodes/'.$code.'.png');
    // $data['barcode'] = 'barcodes/'.$code.'.png';
    // $barcode         =  $data['barcode'] ;
    // $data            =  array('barcode'  =>  'barcodes/'.$code.'.png' );
    
    // $this->db->where('id',$value->student_id);
    // $this->db->update('students', $data);
    // }
    
    // $this->db->where(array('id'=>$value->student_id, 'qrcode' => ""));      
    // $q 		               = $this->db->get('students');
    // if ($q->num_rows() > 0) 
    // {
    // $datval                =   $q->row_array();
    // $stud_id               =   $datval['id'];
    // $firstname             =   $datval['firstname'];
    // $middlename            =   $datval['middlename'];
    // $lastname              =   $datval['lastname'];
    // $middlename            =   $datval['middlename'];
    // $mobileno              =   $datval['mobileno'];
    // $father_name           =   $datval['father_name'];
    // $father_mobile         =   $datval['father_phone'];
    // $current_address       =   $datval['current_address'];
    
    // $data= "Name:$firstname\nMobile:$mobileno\nFather Name:$father_name\nFather Mobile:$father_mobile\nHouse Name: $current_address";
    // $qr                    =    $this->generate_qrcode($data,$stud_id);
    
    // $table                 =    "students";
    // $condition             =    array('id'=>$datval['id']);
    // $data                  =    array('qrcode'=> $qr['file']);
    // $this->db->where('id',$datval['id']);
    // $this->db->update('students', $data);
    // }
    // }

    // $data['students']        = $this->student_model->getStudentsByArray($std_arr);
    // $data['sch_settingdata'] = $this->sch_setting_detail;
    
    // $id_cards = $this->load->view('admin/examresult/generatemultiple', $data, true);
    // echo json_encode(array('status' => 1, 'page' => $id_cards));
    // }
        
        
        
        
        
        
        /* public function marksheet() {
        if (!$this->rbac->hasPrivilege('print_marksheet', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult/marksheet');
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        
        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        $data['layout'] = $this->examgroup_model->pdflayout();
        
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
        
        if ($this->form_validation->run() == false) {
        
        } else {
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        
        $marksheet_template = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        
        $data['studentList'] = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        
        $data['examList'] = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['exam_id'] = $exam_id;
        $data['exam_group_id'] = $exam_group_id;
        }
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/marksheet', $data);
        $this->load->view('layout/footer', $data);
        }
        
        public function printmarksheet() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('post_exam_id', $this->lang->line('exam'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('exam_group_class_batch_exam_student_id[]', $this->lang->line('students'), 'required|trim|xss_clean');
        $data = array();
        
        if ($this->form_validation->run() == false) {
        $data = array(
        'post_exam_id' => form_error('post_exam_id'),
        'post_exam_group_id' => form_error('post_exam_group_id'),
        'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
        );
        $array = array('status' => 0, 'error' => $data);
        echo json_encode($array);
        } else {
        $data['template'] = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $post_exam_id = $this->input->post('post_exam_id');
        $post_exam_group_id = $this->input->post('post_exam_group_id');
        $students_array = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam'] = $exam;
        
        $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades'] = $exam_grades;
        $data['marksheet'] = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
        $data['sch_setting'] = $this->sch_setting_detail;
        
        $student_exam_page = $this->load->view('admin/examresult/_printmarksheet', $data, true); 
        $array = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
        echo json_encode($array);
        }
        }
        */
        
        
        
        public function marksheet()
        {
        if (!$this->rbac->hasPrivilege('print_marksheet', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/examresult/marksheet');
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        
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
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id                 = $this->input->post('session_id');
        $class_id                   = $this->input->post('class_id');
        $section_id                 = $this->input->post('section_id');
        
        $marksheet_template         = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        
        $data['studentList']        = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        $data['Exam_group_list']    = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
        $data['examList']           = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['exam_id']            = $exam_id;
        $data['exam_group_id']      = $exam_group_id;
        }
        
        $data['sch_setting']        = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/marksheet', $data);
        $this->load->view('layout/footer', $data);
        }

        
        
        
        
        public function printmarksheet() 
        {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('post_exam_id', $this->lang->line('exam'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('exam_group_class_batch_exam_student_id[]', $this->lang->line('students'), 'required|trim|xss_clean');
        
        $data = array();

        if ($this->form_validation->run() == false) {
        $data           = array(
        'post_exam_id' => form_error('post_exam_id'),
        'post_exam_group_id' => form_error('post_exam_group_id'),
        'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
        );        
        $array = array('status' => 0, 'error' => $data);
        echo json_encode($array);
        } 
        else
        {
        $data['template']               = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $post_exam_id                   = $this->input->post('post_exam_id');
        $post_exam_group_id             = $this->input->post('post_exam_group_id');
        
        $data['marksheet_Newexamgroup'] = $this->input->post('marksheet_Newexamgroup');
        $data['marksheet_Newexambatch'] = $this->input->post('marksheet_Newexambatch');
        $students_array                 = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam                           = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam']                   = $exam;
        $exam_grades                    = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades']            = $exam_grades;

        $data['marksheet']              = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
        $data['sch_setting']            = $this->sch_setting_detail;
        
        $student_exam_page = $this->load->view('admin/examresult/_printmarksheet', $data, true); 
        $array = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
        echo json_encode($array);
        }
        }          
        
        public function index()
        {
        if (!$this->rbac->hasPrivilege('exam_result', 'can_view'))
        {
        access_denied();
        }

        $userdata             = $this->customlib->getUserData();
        $data["role"]         = $userdata["user_type"];
        $rolename             = $data["role"] ;
        
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/Examresult');
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        
        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        $data['current_session'] = $this->sch_current_session;
        
        $class = $this->class_model->get();
        $data['title'] = 'Add Exam Result';
        $data['title_list'] = 'Add Exam Result';
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
        $data['session_id'] = $this->input->post('session_id');
        $session_id         = $data['session_id'];
        $class_id = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $section_id         = $data['section_id'];
        $marksheet_template = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        $exam_details               = $this->examgroup_model->getExamByID($exam_id);
        
        $studentList                = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        $data['totalstudents']      = $this->examgroupstudent_model->gettotalStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        
        
        $exam_subjects = $this->batchsubject_model->getExamSubjects($exam_id);
        $data['subjectList'] = $exam_subjects;
        
        
        if (!empty($studentList)) {
        foreach ($studentList as $student_key => $student_value) {
        // $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
        
        
        $studentList[$student_key]->subject_results = $this->examresult_model->loadStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);    

        }
        }
        
        $data['studentList']     = $studentList;
        
        $data['Exam_group_list'] = $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
        $data['examList']        = $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
        
        $data['get_session']     = $this->examgroup_model->getExamBy_session($session_id);
        
        $data['get_class']       = $this->examgroup_model->getExamBy_class($class_id);
        
        $data['get_section']     = $this->examgroup_model->getExamBy_section($section_id);
        
        $exam_grades             = $this->grade_model->getByExamType($exam_details->exam_group_type);
        
        $data['getrolebased']    = $this->examgroup_model-> getrolebased_publish($exam_id,$exam_group_id);
        
        $data['exam_grades']     = $exam_grades;
        $data['exam_details']    = $exam_details;
        $data['exam_id']         = $exam_id;
        $data['exam_group_id']   = $exam_group_id;
        }   
        $data['sch_setting']     = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/index', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        
        
        
        /*
        public function index_old() {
        if (!$this->rbac->hasPrivilege('exam_result', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/Examresult');
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        
        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        
        $class = $this->class_model->get();
        $data['title'] = 'Add Batch';
        $data['title_list'] = 'Recent Batch';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) {
        
        } else {
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        
        $marksheet_template = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        $exam_details = $this->examgroup_model->getExamByID($exam_id);
        
        $studentList = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        
        $exam_subjects = $this->batchsubject_model->getExamSubjects($exam_id);
        $data['subjectList'] = $exam_subjects;
        
        if (!empty($studentList)) {
        foreach ($studentList as $student_key => $student_value) {
        $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
        }
        }
        
        $data['studentList'] = $studentList;
        
        $exam_grades = $this->grade_model->getByExamType($exam_details->exam_group_type);
        $data['exam_grades'] = $exam_grades;
        $data['exam_details'] = $exam_details;
        $data['exam_id'] = $exam_id;
        $data['exam_group_id'] = $exam_group_id;
        }   
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/index', $data);
        $this->load->view('layout/footer', $data);
        }
        */
        
        
        public function getStudentByClassBatch() 
        {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $session_id = $this->input->post('session_id');
        $data['studentList'] = $this->examgroupstudent_model->searchStudentByClassSectionSession($class_id, $section_id, $session_id);
        echo json_encode($data);
        }
        
        public function getExamGroupByStudent()
        {
        $student_id = $this->input->post('student_id');
        
        $data['examgrouplist'] = $this->examgroup_model->getExamGroupByStudent($student_id);
        echo json_encode($data);
        }
        
        
        public function studentresult() 
        {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('exam_group_id', 'exam_group_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_id', 'student_id', 'required|trim|xss_clean');
        
        if ($this->form_validation->run() == false) {
        $data = array(
        'exam_group_id' => form_error('exam_group_id'),
        'student_id' => form_error('student_id'),
        );
        $array = array('status' => 0, 'error' => $data);
        echo json_encode($array);
        } else {
        
        $student_id = $this->input->post('student_id');
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_group_exam_id = $this->input->post('exam_id');
        
        $examresult = array();
        $exam_grades = array();
        if ($exam_group_exam_id != "") {
        $examresult = $this->examgroup_model->getExamResultDetailStudent($exam_group_exam_id, $exam_group_id, $student_id);
        
        $data['examresult'] = $examresult;
        $exam_grades = $this->grade_model->getByExamType($examresult->exam_type);
        $data['exam_grades'] = $exam_grades;
        $examresult = $this->load->view('admin/examresult/_getExam', $data, true);
        } else {
        $exam_group = $this->examgroup_model->get($exam_group_id);
        $data['exam_group'] = $exam_group;
        
        $exam_grades = $this->grade_model->getByExamType($exam_group->exam_type);
        $data['exam_grades'] = $exam_grades;
        
        $exam_result = $this->examgroup_model->getExamGroupExamsResultByStudentID($exam_group_id, $student_id);
        $data['examresult'] = $exam_result;
        $exam_connections = $this->examgroup_model->getExamGroupConnection($exam_group_id);
        $data['exam_connections'] = $exam_connections;
        $examresult = $this->load->view('admin/examresult/_getExamGroupResult', $data, true);
        }
        
        $data['exam_grades'] = $exam_grades;
        
        $array = array('status' => '1', 'result' => $examresult, 'message' => $this->lang->line('success_message'));
        echo json_encode($array);
        }
        }
        
        public function getStudentCurrentResult() {
        $this->form_validation->set_rules('student_session_id', $this->lang->line('student') . " " . $this->lang->line('id'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) {
        
        $msg = array(
        'student_session_id' => form_error('student_session_id'),
        );
        
        $array = array('status' => 0, 'error' => $msg);
        } else {
        $student_session_id = $this->input->post('student_session_id');
        $data['exam_grades'] = $this->grade_model->get();
        $exam_groups_attempt = $this->examgroup_model->getExamGroupByStudentSession($student_session_id);
        
        $data['exam_groups_attempt'] = $exam_groups_attempt;
        $examresult = $this->load->view('admin/examresult/_getExamGroupResult', $data, true);
        $array = array('status' => 1, 'error' => '', 'result' => $examresult);
        }
        echo json_encode($array);
        }
        
        public function generatemarksheet() {
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam') . " " . $this->lang->line('id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('check[]', $this->lang->line('students'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) {
        
        $msg = array(
        'exam_id' => form_error('exam_id'),
        'check' => form_error('check'),
        );
        
        $array = array('status' => 0, 'error' => $msg);
        } else {
        echo "<pre/>";
        $exam_id = $this->input->post('exam_id');
        $students = $this->input->post('check');
        $exam = $this->examgroup_model->getExamByID($exam_id);
        $exam_id = $exam->id;
        $students_result = array();
        if (!empty($students)) {
        foreach ($students as $student_key => $student_value) {
        $students_result[] = $this->examresult_model->getStudentExamResult($exam_id, $student_value);
        }
        }
        }
        echo json_encode($array);
        }
        
        
        public function rankreport()
        {
        if (!$this->rbac->hasPrivilege('rank_report', 'can_view')) {
        access_denied();
        }
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/examinations');
        $this->session->set_userdata('subsub_menu', 'Reports/examinations/rankreport');
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        $marksheet_result = $this->marksheet_model->get();
        $data['marksheetlist'] = $marksheet_result;
        $class = $this->class_model->get();
        $data['title'] = 'Add Batch';
        $data['title_list'] = 'Recent Batch';
        $data['examType'] = $this->exam_type;
        $data['classlist'] = $class;
        $session = $this->session_model->get();
        $data['sessionlist'] = $session;
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) {
        
        } else {
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        
        $marksheet_template = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        $exam_details = $this->examgroup_model->getExamByID($exam_id);
        
        $studentList = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
        $exam_subjects = $this->batchsubject_model->getExamSubjects($exam_id);
        $data['subjectList'] = $exam_subjects;
        
        if (!empty($studentList)) {
        foreach ($studentList as $student_key => $student_value) {
        $studentList[$student_key]->subject_results = $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
        }
        }

        
        $data['studentList'] = $studentList;
        $exam_grades = $this->grade_model->getByExamType($exam_details->exam_group_type);
        $data['exam_grades'] = $exam_grades;
        $data['exam_details'] = $exam_details;
        $data['exam_id'] = $exam_id;
        $data['exam_group_id'] = $exam_group_id;
        }
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/examresult/rankreport', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        public function remove_image($id)
        {
        $table              = "progress_card_layout_tbl";
        $condition          = array('progress_card_id'     => $id);
        $data               = array('progress_card_logo'   => "");
        $this->db->where($condition);
        $res=$this->db->update('progress_card_layout_tbl', $data);
        
        if($res==true)
        {
        // $this->session->set_flashdata('success', 'Updated Successfully');
        redirect($_SERVER['HTTP_REFERER']); 
        }   
        }
        
        
        
        public function remove_footer1($id)
        {
        
        
        $table              = "progress_card_layout_tbl";
        $condition          = array('progress_card_id'     => $id);
        
        $data               = array('progress_card_footer1'   => "");
        
        $this->db->where($condition);
        $res=$this->db->update('progress_card_layout_tbl', $data);
        
        if($res==true)
        {
        // $this->session->set_flashdata('success', 'Updated Successfully');
        redirect($_SERVER['HTTP_REFERER']); 
        }
        
        
        }
        
        
        
        
        public function remove_footer2($id)
        {
        $table              = "progress_card_layout_tbl";
        $condition          = array('progress_card_id'     => $id);
        $data               = array('progress_card_footer2'   => "");
        $this->db->where($condition);
        $res=$this->db->update('progress_card_layout_tbl', $data);
        
        if($res==true)
        {
        // $this->session->set_flashdata('success', 'Updated Successfully');
        redirect($_SERVER['HTTP_REFERER']); 
        }
        }
        
        
        
        public function remove_footer3($id)
        {
        $table              = "progress_card_layout_tbl";
        $condition          = array('progress_card_id'     => $id);
        
        $data               = array('progress_card_footer3'   => "");
        
        $this->db->where($condition);
        $res=$this->db->update('progress_card_layout_tbl', $data);
        
        if($res==true)
        {
        // $this->session->set_flashdata('success', 'Updated Successfully');
        redirect($_SERVER['HTTP_REFERER']); 
        }
        }
        
        
        public function printexamresult() 
        {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('post_exam_id', $this->lang->line('exam'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('post_exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('exam_group_class_batch_exam_student_id[]', $this->lang->line('students'), 'required|trim|xss_clean');
        $data = array();
        
        if ($this->form_validation->run() == false) {
        $data = array(
        'post_exam_id' => form_error('post_exam_id'),
        'post_exam_group_id' => form_error('post_exam_group_id'),
        'exam_group_class_batch_exam_student_id' => form_error('exam_group_class_batch_exam_student_id'),
        );
        $array = array('status' => 0, 'error' => $data);
        echo json_encode($array);
        } else {
        $data['template'] = $this->marksheet_model->get($this->input->post('marksheet_template'));
        $post_exam_id = $this->input->post('post_exam_id');
        $post_exam_group_id = $this->input->post('post_exam_group_id');
        
        $data['post_exam_id']        =   $post_exam_id;
        $data['post_exam_group_id']  =   $post_exam_group_id;
        $data['marksheet_Newexamgroup'] = $this->input->post('marksheet_Newexamgroup');
        $data['marksheet_Newexambatch'] = $this->input->post('marksheet_Newexambatch');
        $students_array = $this->input->post('exam_group_class_batch_exam_student_id');
        $exam = $this->examgroup_model->getExamByID($post_exam_id);
        $data['exam'] = $exam;
        
        $exam_grades = $this->grade_model->getByExamType($exam->exam_group_type);
        $data['exam_grades']    = $exam_grades;
        $data['marksheet']      = $this->examresult_model->getExamResults($post_exam_id, $post_exam_group_id, $students_array);
        $data['sch_setting']    = $this->sch_setting_detail;
         $data['instruction']   = $this->examresult_model->getonline_instruction($post_exam_id, $post_exam_group_id);
        
        $student_exam_page = $this->load->view('admin/examresult/_printexamresult', $data, true); 
        $array = array('status' => '1', 'error' => '', 'page' => $student_exam_page);
        echo json_encode($array);
        }
        }
        }
