        <?php
        
        if (!defined('BASEPATH'))
        exit('No direct script access allowed');
        
        class Content extends Student_Controller {
        
        function __construct() {
        parent::__construct();
        }
        
        public function index() {
        $data['title'] = 'Upload Content';
        $data['title_list'] = 'Upload Content List';
        $list = $this->content_model->get();
        $data['list'] = $list;
        $ght = $this->customlib->getcontenttype();
        $data['ght'] = $ght;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/createcontent', $data);
        $this->load->view('layout/student/footer');
        }
        
        public function download($file) {
        
        $this->load->helper('download');
        $filepath = "./uploads/school_content/material/" . $this->uri->segment(7);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(7);
        force_download($name, $data);
        }
        
        public function assignment() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/assignment');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        
        $data['title_list'] = 'List of Assignment';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id, "assignments");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/assignment', $data);
        $this->load->view('layout/student/footer');
        }
        
        public function studymaterial() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/studymaterial');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        
        $data['title_list'] = 'List of Assignment';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id, "study_material");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/studymaterial', $data);
        $this->load->view('layout/student/footer');
        }
        
        
        public function viewpdf($id)
        {
        $data['pdf'] = $this->student_model->getNewpdf($id);
        $data['file']=  $data['pdf']['file'];
        $this->load->view('layout/student/header');
        $this->load->view('user/content/viewpdf',$data);
        $this->load->view('layout/student/footer'); 
        }
        
        
        public function viewtxt($id)
        {
        $data['pdf'] = $this->student_model->getNewpdf($id);
        $data['file']=  $data['pdf']['file'];
        $filename = $data['file'];
        $fp = fopen($filename, "r");
        
        $content = fread($fp, filesize($filename));
        $data['lines'] = explode("\n", $content);
       
        $this->load->view('layout/student/header');
        $this->load->view('user/content/viewtxt',$data);
        $this->load->view('layout/student/footer'); 
        }
        
        
        public function viewdoc($id)
        {
        $data['pdf'] = $this->student_model->getNewpdf($id);
        $data['file']=  $data['pdf']['file'];
        $this->load->view('layout/student/header');
        $this->load->view('user/content/viewdoc',$data);
        $this->load->view('layout/student/footer'); 
        }
        
        
        public function syllabus() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/syllabus');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);   
        $data['title_list'] = 'List of Syllabus';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id,"syllabus");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/syllabus', $data);
        $this->load->view('layout/student/footer');
        }
        
        public function other() {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/other');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        
        $data['title_list'] = 'List of Other Download';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id,"other_download");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/other', $data);
        $this->load->view('layout/student/footer');
        }
        
        
        
        public function refund() 
        {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/refund');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        $data['title_list'] = 'Refund Form';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id,"refund");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/refund', $data);
        $this->load->view('layout/student/footer');
        }
        
        
        
        
        public function oldquestionppapers()
        {
        $this->session->set_userdata('top_menu', 'Downloads');
        $this->session->set_userdata('sub_menu', 'content/oldquestionppapers');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        
        $data['title_list'] = 'List of Old Question Papers';
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $list = $this->content_model->getListByCategoryforUser($student_current_class->class_id, $student_current_class->section_id,"old_question_papers");
        $data['list'] = $list;
        $this->load->view('layout/student/header');
        $this->load->view('user/content/oldquestionpapers', $data);
        $this->load->view('layout/student/footer');
        }
        
        }
        
        ?>