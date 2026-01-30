            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Semester_Subjectgroups  extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();
            }

            public function index()
            {
            if (!$this->rbac->hasPrivilege('subject_group', 'can_view')) {
            access_denied();
            }
            $json_array = array();
            $this->session->set_userdata('top_menu', 'semester');
            $this->session->set_userdata('sub_menu', 'Semester_Subjectgroup');
            $data['title']         = 'Add Subject';
            $data['title_list']    = 'Subject List';          

            
            $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean|callback_check_name_exists');
            

            $this->form_validation->set_rules('subject[]', $this->lang->line('subject'), 'trim|required|xss_clean');



            if ($this->form_validation->run() == false) {
            // $data['section_array'] = $this->input->post('sections');
            } else {
            $name        = $this->input->post('name');
            $session     = $this->setting_model->getCurrentSession();
            $class_array = array(
            'name'        => $this->input->post('name'),            
            'description' => $this->input->post('description'),
            );
            $subject  = $this->input->post('subject');     

            $this->Semester_subjectgroup_model->add($class_array, $subject);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester/Semester_Subjectgroups');
            }

            $subject_list             = $this->subject_model->get();
            $data['subjectlist']      = $subject_list;
            $subjectgroupList         = $this->Semester_subjectgroup_model->getByID();
            $data['subjectgroupList'] = $subjectgroupList;
            $this->load->view('layout/header', $data);
            $this->load->view('semester/subjectgroup/subjectgroupList', $data);
            $this->load->view('layout/footer', $data);
            }




            public function check_name_exists($name)
            {
            if ($this->Semester_subjectgroup_model->name_exists($name)) {
            // show a banner instead of inline message
            $this->session->set_flashdata('msg',
            '<div class="alert alert-danger text-left">'.$this->lang->line('name').' '.$this->lang->line('already_exists').'</div>'
            );
            // suppress CI default inline validation text
            $this->form_validation->set_message('check_name_exists', ' ');
            return FALSE;
            }
            return TRUE;
            }

            public function delete($id)
            {
            if (!$this->rbac->hasPrivilege('subject_group', 'can_delete')) {
            access_denied();
            }
            $data['title'] = 'Subject Group';
            $this->Semester_subjectgroup_model->remove($id);
            redirect('semester/Semester_Subjectgroups');
            }


            public function edit($id)
            {
            if (!$this->rbac->hasPrivilege('subject_group', 'can_edit')) {
            access_denied();
            }

            $this->session->set_userdata('top_menu', 'semester');
            $this->session->set_userdata('sub_menu', 'Semester_Subjectgroup');
            $json_array               = array();
            $old_sections             = array();
            $old_subjects             = array();
            $data['title']            = 'Edit Class';
            $data['id']               = $id;
            $class                    = $this->class_model->get();
            $data['classlist']        = $class;

            $subject_list             = $this->subject_model->get();
            $data['subjectlist']      = $subject_list;
            $subjectgroupList         = $this->Semester_subjectgroup_model->getByID();
            $data['class_id']         = 0;

            $data['subjectgroupList'] = $subjectgroupList;
            $subjectgroup             = $this->Semester_subjectgroup_model->getByID($id);


            if (!empty($subjectgroup[0]->group_subject)) {


            foreach ($subjectgroup[0]->group_subject as $key => $value) {

            $old_subjects[] = $value->subject_id;

            }
            }


            $data['subjectgroup'] = $subjectgroup;

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|xss_clean');

            $this->form_validation->set_rules('subject[]', $this->lang->line('subject'), 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
            // if($this->input->server('REQUEST_METHOD') == "POST"){
            // $data['section_array'] = $this->input->post('sections');
            // }

            $this->load->view('layout/header', $data);
            $this->load->view('semester/subjectgroup/subjectgroupEdit', $data);
            $this->load->view('layout/footer', $data);
            } else {

            $name = $this->input->post('name');
            if ($this->Semester_subjectgroup_model->name_exists($name, $id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$this->lang->line('name').' '.$this->lang->line('already_exists').'</div>');
            redirect($_SERVER['HTTP_REFERER']);
            }

            $class_array = array(
            'id'        => $this->input->post('id'),
            'name'        => $name,                
            'description' => $this->input->post('description'),
            );
            $subject  = $this->input->post('subject');
            // $sections = $this->input->post('sections');
            // $delete_sections = array_diff($old_sections, $sections);
            // $add_sections = array_diff($sections, $old_sections);
            $delete_subjects = array_diff($old_subjects, $subject);
            $add_subjects = array_diff($subject, $old_subjects);
            $this->Semester_subjectgroup_model->edit($class_array,$delete_subjects, $add_subjects);

             $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>'
            );

            redirect('semester/Semester_Subjectgroups');
            }
            }


            public function addsubjectgroup()
            {
            $this->form_validation->set_rules('subject_group_id', $this->lang->line('fee_group'), 'required|trim|xss_clean');

            if ($this->form_validation->run() == false) {
            $data = array(
            'subject_group_id' => form_error('subject_group_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
            } else {
            $student_session_id     = $this->input->post('student_session_id');
            $subject_group_id       = $this->input->post('subject_group_id');
            $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
            $student_ids            = $this->input->post('student_ids');
            $delete_student         = array_diff($student_ids, $student_sesssion_array);

            $preserve_record = array();
            if (!empty($student_sesssion_array)) {
            foreach ($student_sesssion_array as $key => $value) 
            {

            $insert_array = array(
            'student_session_id' => $value,
            'subject_group_id'   => $subject_group_id,
            );
            $inserted_id = $this->studentsubjectgroup_model->add($insert_array);

            $preserve_record[] = $inserted_id;
            }
            }

            if (!empty($delete_student)) {
            $this->studentsubjectgroup_model->delete($subject_group_id, $delete_student);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
            }
            } 

            public function getGroupByClassandSection()
            { 
            $class_id   = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data       = $this->subjectgroup_model->getGroupByClassandSection($class_id, $section_id);

            echo json_encode($data);
            }

            public function getSubjectByClassandSectionDate()
            { 
            $date =date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));

            $day        = date('l', strtotime($date));

            $class_id   = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data       = $this->subjecttimetable_model->getSubjectByClassandSectionDay($class_id, $section_id, $day);
            echo json_encode($data);
            }

            public function getSubjectByClassandSection()
            {
            $class_id   = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data       = $this->subjecttimetable_model->getSubjectByClassandSection($class_id, $section_id);
            echo json_encode($data);
            }

            public function getGroupsubjects()
            {

            $subject_group_id = $this->input->post('subject_group_id');
            $data             = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
            echo json_encode($data);
            }

            }
