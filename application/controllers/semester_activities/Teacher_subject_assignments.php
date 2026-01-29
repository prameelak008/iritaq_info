            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Teacher_subject_assignments extends Admin_Controller
            { 

            public function __construct()
            {
            parent::__construct();
            $this->load->helper('form');
            $this->config->load('app-config');
            $this->load->library("datatables");
            $this->current_session = $this->setting_model->getCurrentSession(); 
            }



            public function index()
            {  

            // if (!$this->rbac->hasPrivilege('faculty', 'can_view')) {
            // access_denied();
            // }
            $this->session->set_userdata('top_menu', 'semester_activities');

            $data['title']              =   'Timetable';
            $data['title_list']         =   'Assign Subject';
            $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();

            // $data['Programmetype_list'] =   $this->Programmetype_model->get();
            // $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
            // $data['semestertype_list']  =   $this->Semestertype_model->getdata();  
            // $data['semester_term']      =   $this->Set_duration_model->get_semester_term();            

            $data['subject_groups']     =   $this->Assignsubjects_model->get_subjectgroups();             
            $data['assign_teacher']     =   $this->Semesteractivities_model->getassignedteacher_subjects();

            // $data['programs']           =   $this->Semester_enrollment_model->get_program_list();
            // $data['batch_types']        =   $this->Semester_enrollment_model->get_batch_types();
            // $data['semester_term']      =   $this->Semester_enrollment_model->get_semester_term();

            // Validation rules for add
            // $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('branch_id', 'Branch', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('program_type', $this->lang->line('programee_type'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('programe', $this->lang->line('programee'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('batch_group', 'Batch Group', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('semester_term', $this->lang->line('semester'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('subject_groups', $this->lang->line('subject').' '.$this->lang->line('group'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('subjects', $this->lang->line('subject'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('paper[]', $this->lang->line('paper'), 'required');

            $this->form_validation->set_rules('prog_id', $this->lang->line('programee'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('sem_type', 'Batch ', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');


            if ($this->form_validation->run() == false) 
            {

            } 
            else 
            {                
            $program              = $this->input->post('prog_id');
            $sem_group_id         = $this->input->post('sem_type');
            // $semester_semtype    = $this->input->post('semester_semtype');
            // $semester_term       = $this->input->post('semester_term');

            // $this->db->where('sem_group_program', $program);
            // $this->db->where('sem_group_batchgroup', $batch_group);               
            // // $this->db->where('sem_group_semester', $semester_semtype);
            // $this->db->where('sem_group_semester_term', $semester_term);                
            // $query = $this->db->get('semester_group');                        

            // if ($query->num_rows() == 0) 
            // {
            // $data_to_insert = array(
            // 'sem_group_batchgroup'   => $batch_group,
            // 'sem_group_program'      => $program,
            // 'sem_group_semester'     => $semester_semtype,
            // 'sem_group_semester_term'=> $semester_term,                
            // 'sem_group_createddate'  => date('Y-m-d H:i:s')
            // );
            // $this->db->insert('semester_group', $data_to_insert);
            // $sem_group_id = $this->db->insert_id();
            // } 
            // else 
            // {
            // $row          = $query->row();
            // $sem_group_id = $row->sem_group_id;
            // } 

            // Prevent duplicate: same Program, Batch, Semester, Term (via sem group), Subject Group, Session, Branch

            // $this->db->where('assign_program', $program);
            // $this->db->where('assign_batch', $batch_group);
            // $this->db->where('assign_semester', $semester_semtype);


            $this->db->where('assign_subject_group', $this->input->post('subject_groups'));
            $this->db->where('assign_batch', $sem_group_id);
            // $this->db->where('assign_session', $this->current_session);
            $this->db->where('assign_branch_id', $this->input->post('branch_id'));
            $dup_query = $this->db->get('teacher_subject_assignments');

            if ($dup_query->num_rows() > 0) 
            {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">You cannot add for same types.</div>');
            redirect('semester_activities/teacher_subject_assignments/index');
            }

            $data                     = array(
            'assign_teacher'          => $this->input->post('teacher'),
            'assign_branch_id'        => $this->input->post('branch_id'),
            'assign_batch'            => $sem_group_id,
            // 'assign_program'          => $program,
            // 'assign_batch'            => $batch_group,
            // 'assign_semester'         => $semester_semtype,  

            'assign_subject_group'    => $this->input->post('subject_groups'),
            'assign_subject'          => $this->input->post('subjects'),
            // 'assign_semester_group'   => $sem_group_id, //semester group id             
            'assign_paper'            => implode(",", $this->input->post('paper')),
            'assign_createddate'      => date('Y-m-d H:i:s'),            
            // 'assign_session'          => $this->current_session
        );
            $this->Semesteractivities_model->add($data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester_activities/teacher_subject_assignments/index');
            } 

            $data['programs']           = $this->Semester_enrollment_model->get_program_list();
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/teacher_subject_assignments/add_data', $data);
            $this->load->view('layout/footer', $data);
            }
            


            public function list_subjects()
            {
            $group_id        = $this->input->post('group_id');                  
            $data            = $this->Semesteractivities_model->get_subjects($group_id); 
            echo json_encode($data); 
            }       


            public function list_papers()
            {
            $subject_id        = $this->input->post('subject_id');                  
            $data            = $this->Semesteractivities_model->get_papers($subject_id); 
            echo json_encode($data); 
            }






            public function edit($id)
            {
              
            $this->session->set_userdata('top_menu', 'semester');
            $this->session->set_userdata('sub_menu', 'teacher_subject_assignments/index');
            $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();

            // $data['Programmetype_list'] =   $this->Programmetype_model->get();
            // $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
            // $data['semestertype_list']  =   $this->Semestertype_model->getdata();  
            // $data['semester_term']      =   $this->Set_duration_model->get_semester_term(); 


            $data['programs']             =  $this->Semester_enrollment_model->get_program_list();
            $data['batch_types']          =  $this->Semester_enrollment_model->get_batch_types();
            $data['semester_term']        = $this->Semester_enrollment_model->get_semester_term();

            $data['subject_groups']       =   $this->Assignsubjects_model->get_subjectgroups();             
            $data['assign_teacher']       =   $this->Semesteractivities_model->getassignedteacher_subjects(); 
            $data['id']                   =   $id;
            $data['edit_teaching_staff']  =   $this->Semesteractivities_model->getassignedteacher_subjects($id);           
      

            // Validation rules for edit
            // $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('branch_id', 'Branch', 'trim|required|xss_clean');

            $this->form_validation->set_rules('prog_id', $this->lang->line('programee'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('sem_type', 'batch', 'trim|required|xss_clean');

            // $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester'), 'trim|required|xss_clean');

           

            // $this->form_validation->set_rules('batchtype_id', 'Batch ', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');
            // $this->form_validation->set_rules('sem_group_id', 'Semester Group', 'trim|required|xss_clean');
            $this->form_validation->set_rules('subject_groups', $this->lang->line('subject').' '.$this->lang->line('group'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('subjects', $this->lang->line('subject'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('paper[]', $this->lang->line('paper'), 'required');

            // $program             =  $this->input->post('program'); 
            $sem_group_id        =  $this->input->post('sem_type');
            if ($this->form_validation->run() == false) 
            {
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/teacher_subject_assignments/edit_data', $data);
            $this->load->view('layout/footer', $data);
            }
            else
            { 

            $data                     = array(
            'assign_id'               => $id,
            'assign_teacher'          => $this->input->post('teacher'),
            // 'assign_branch_id'        => $this->input->post('branch_id'), 

            // 'assign_program'          => $this->input->post('program'),
            // 'assign_batch'            => $this->input->post('batch_group'),
            // 'assign_semester'         => $this->input->post('semester_semtype'),

            'assign_subject_group'    => $this->input->post('subject_groups'),
            'assign_batch'            => $sem_group_id, 
            'assign_subject'          => $this->input->post('subjects'),

            // 'assign_paper'            => $this->input->post('paper'),
            'assign_updateddate'      => date('Y-m-d H:i:s')
            ); 
            $this->Semesteractivities_model->add($data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect($_SERVER['HTTP_REFERER']);                    
            }
            } 
            


            public function get_sem_group_id()
            {                           
            $programe         = $this->input->post('prog');
            $batch_group      = $this->input->post('bat');
            $semester_semtype = $this->input->post('sem'); 
            $semester_semterm = $this->input->post('sem_term');               
            $data             = $this->Semesteractivities_model->get_sem_group($programe,$batch_group,$semester_semtype,$semester_semterm); 
            echo json_encode($data); 
            }  



            public function delete($id)
            {
            $data['title']       = 'Teacher Assignment Details';
            $this->Semesteractivities_model->remove($id);
            redirect($_SERVER['HTTP_REFERER']);
            }


            public function update_status()
            {
            $id                = $this->input->post('id');
            $status            = $this->input->post('status');

            $data              = array(
            'assign_status' => $status
            );
            $this->db->where('assign_id', $id);
            if ($this->db->update('teacher_subject_assignments', $data)) {
            echo json_encode(array('status' => 'success'));
            } else {
            echo json_encode(array('status' => 'error'));
            }
            }


            public function get_teacher_branch()
            {
            // Get teacher_id from POST
            $teacher_id = $this->input->post('teacher_id');

            // Fetch branch from the model
            $branch = $this->Semesteractivities_model->getteacher_branch($teacher_id);

            // Return as JSON
            echo json_encode(['branch_id' => $branch['st_branch']]);
            }


            public function bulkDelete()
            {
            $ids = $this->input->post('ids');
            if (!empty($ids)) {
            foreach ($ids as $id) 
            {           
            $this->Semesteractivities_model->remove($id);
            }
            echo "success";
            } else {
            echo "no_ids";
            }
            } 


            }
