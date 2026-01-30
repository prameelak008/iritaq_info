                <?php

                if (!defined('BASEPATH')) 
                {
                exit('No direct script access allowed');
                }

                class Semester_classteacher extends Admin_Controller
                { 

                public function __construct()
                {
                parent::__construct();
                $this->load->helper('form');
                $this->config->load('app-config');
                $this->load->library("datatables");
                $this->current_session = $this->setting_model->getCurrentSession(); 
                }
<<<<<<< HEAD
                
                // public function index001()
                // {
                // // if (!$this->rbac->hasPrivilege('faculty', 'can_view')) {
                // // access_denied();
                // // }
                //  $this->session->set_userdata('top_menu', 'semester_activities');
                // // $this->session->set_userdata('sub_menu', 'semester_classteacher/index');

                // $data['title']              =   'Class Teacher';
                // $data['title_list']         =   'Add Class Teacher';  
                // $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();
                // $data['Programmetype_list'] =   $this->Programmetype_model->get();
                // $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
                // $data['semestertype_list']  =   $this->Semestertype_model->getdata(); 
                // $teacher                    =   $this->input->post('teacher');
                // $data['get_classteacher']   =   $this->Semesteractivities_model->get_sem_classteacher();
                // $data['semester_term']      =   $this->Set_duration_model->get_semester_term();

                // $program                    =   $this->input->post('programe');
                // $batch_group                =   $this->input->post('batch_group');
                // $semester_semtype           =   $this->input->post('semester_semtype');
                // $semester_term              =   $this->input->post('semester_term');

                // $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                // $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');
                // $this->form_validation->set_rules('batch_group', 'Batch Group', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester_type'), 'trim|required|xss_clean');
                // $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');
                // // $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'callback_check_teacher');

                // if ($this->form_validation->run() == false) 
                // {                 
                // } 
                // else 
                // {                    
                // $this->db->where('sem_group_program', $program);
                // $this->db->where('sem_group_batchgroup', $batch_group);               
                // $this->db->where('sem_group_semester', $semester_semtype);
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


                // // $sem_group_id = $this->input->post('sem_group_id');
                // $branch_id    = $this->input->post('branch_id');
                // $description  = $this->input->post('description');
                // $teacher_ids  = $this->input->post('teacher');  // Array of selected teacher IDs
                // $semcl_id     = $this->input->post('semcl_id');  // Comes from form when editing

                // // Ensure $teacher_ids is always an array
                // $teacher_ids       = is_array($teacher_ids) ? $teacher_ids : [];

                // // Check if a semester_classteacher already exists for this sem_group
                // $this->db->where('semcl_sem_group', $sem_group_id);
                // $existing_record   = $this->db->get('semester_classteacher')->row();

                // if ($existing_record) 
                // {
                // // Already exists, use this ID
                // $record_id              = $existing_record->semcl_id;
                // // Optionally update description/branch if needed
                // $update_data            = array(
                // 'semcl_branch_id'       => $branch_id,
                // 'semcl_sem_description' => $description,
                // 'semcl_updateddate'     => date('Y-m-d H:i:s')
                // );
                // $this->db->where('semcl_id', $record_id);
                // $this->db->update('semester_classteacher', $update_data);
                // } 
                // else
                // {
                // // Insert new main record
                // $data = array(
                // 'semcl_sem_group'       => $sem_group_id,
                // 'semcl_branch_id'       => $branch_id,
                // 'semcl_sem_description' => $description,
                // 'semcl_createddate'     => date('Y-m-d H:i:s'),
                // 'semcl_sem_status'      => 1
                // );
                // $record_id               = $this->Semesteractivities_model->add_sem_classteacher($data);
                // }

                // // Handle semester_classteacher_details for this semcl_id only

                // // Get existing teacher IDs for this semester/class
                // $this->db->select('semcl_det_teacher');
                // $this->db->where('semcl_sem_id', $record_id);
                // $existing_teacher_ids = array_column($this->db->get('semester_classteacher_details')->result_array(), 'semcl_det_teacher');

                // // Insert only newly checked teachers
                // $to_insert = array_diff($teacher_ids, $existing_teacher_ids);

                // foreach ($to_insert as $teacher_id) {
                // $this->db->insert('semester_classteacher_details', [
                // 'semcl_det_teacher' => $teacher_id,
                // 'semcl_sem_id'      => $record_id
                // ]);
                // }

                // // Delete unchecked teachers only if editing an existing record
                // if ($semcl_id || $existing_record) {
                // $to_delete = array_diff($existing_teacher_ids, $teacher_ids);
                // if (!empty($to_delete)) {
                // $this->db->where('semcl_sem_id', $record_id);
                // $this->db->where_in('semcl_det_teacher', $to_delete);
                // $this->db->delete('semester_classteacher_details');
                // }
                // }

                // $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                // redirect('semester_activities/semester_classteacher/index');
                // } 
                // $this->load->view('layout/header', $data);
                // $this->load->view('semester_activities/class_teacher/add_data', $data);
                // $this->load->view('layout/footer', $data);
                // }  


                public function index()
                {                    
                    
                $this->session->set_userdata('top_menu', 'semester_activities'); 
                $data['title']              =   'Class Teacher';
                $data['title_list']         =   'Add Class Teacher';                             
                $teacher                    =    $this->input->post('teacher');
                $data['get_classteacher']   =    $this->Semesteractivities_model->get_sem_classteacher();                  
                $this->form_validation->set_rules('prog_id', $this->lang->line('programee'), 'trim|required|xss_clean');

                $this->form_validation->set_rules('sem_type', $this->lang->line('batch'), 'trim|required|xss_clean');
             
=======




                
                public function index001()
                {
                // if (!$this->rbac->hasPrivilege('faculty', 'can_view')) {
                // access_denied();
                // }
                 $this->session->set_userdata('top_menu', 'semester_activities');
                // $this->session->set_userdata('sub_menu', 'semester_classteacher/index');

                $data['title']              =   'Class Teacher';
                $data['title_list']         =   'Add Class Teacher';  
                $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();
                $data['Programmetype_list'] =   $this->Programmetype_model->get();
                $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
                $data['semestertype_list']  =   $this->Semestertype_model->getdata(); 
                $teacher                    =   $this->input->post('teacher');
                $data['get_classteacher']   =   $this->Semesteractivities_model->get_sem_classteacher();
                $data['semester_term']      =   $this->Set_duration_model->get_semester_term();

                $program                    =   $this->input->post('programe');
                $batch_group                =   $this->input->post('batch_group');
                $semester_semtype           =   $this->input->post('semester_semtype');
                $semester_term              =   $this->input->post('semester_term');

                $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('batch_group', 'Batch Group', 'trim|required|xss_clean');
                $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');
                // $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'callback_check_teacher');

                if ($this->form_validation->run() == false) 
                {                 
                } 
                else 
                {                    
                $this->db->where('sem_group_program', $program);
                $this->db->where('sem_group_batchgroup', $batch_group);               
                $this->db->where('sem_group_semester', $semester_semtype);
                $this->db->where('sem_group_semester_term', $semester_term);                
                $query = $this->db->get('semester_group');                        

                if ($query->num_rows() == 0) 
                {
                $data_to_insert = array(
                'sem_group_batchgroup'   => $batch_group,
                'sem_group_program'      => $program,
                'sem_group_semester'     => $semester_semtype,
                'sem_group_semester_term'=> $semester_term,                
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


                // $sem_group_id = $this->input->post('sem_group_id');
                $branch_id    = $this->input->post('branch_id');
                $description  = $this->input->post('description');
                $teacher_ids  = $this->input->post('teacher');  // Array of selected teacher IDs
                $semcl_id     = $this->input->post('semcl_id');  // Comes from form when editing

                // Ensure $teacher_ids is always an array
                $teacher_ids       = is_array($teacher_ids) ? $teacher_ids : [];

                // Check if a semester_classteacher already exists for this sem_group
                $this->db->where('semcl_sem_group', $sem_group_id);
                $existing_record   = $this->db->get('semester_classteacher')->row();

                if ($existing_record) 
                {
                // Already exists, use this ID
                $record_id              = $existing_record->semcl_id;
                // Optionally update description/branch if needed
                $update_data            = array(
                'semcl_branch_id'       => $branch_id,
                'semcl_sem_description' => $description,
                'semcl_updateddate'     => date('Y-m-d H:i:s')
                );
                $this->db->where('semcl_id', $record_id);
                $this->db->update('semester_classteacher', $update_data);
                } 
                else
                {
                // Insert new main record
                $data = array(
                'semcl_sem_group'       => $sem_group_id,
                'semcl_branch_id'       => $branch_id,
                'semcl_sem_description' => $description,
                'semcl_createddate'     => date('Y-m-d H:i:s'),
                'semcl_sem_status'      => 1
                );
                $record_id               = $this->Semesteractivities_model->add_sem_classteacher($data);
                }

                // Handle semester_classteacher_details for this semcl_id only

                // Get existing teacher IDs for this semester/class
                $this->db->select('semcl_det_teacher');
                $this->db->where('semcl_sem_id', $record_id);
                $existing_teacher_ids = array_column($this->db->get('semester_classteacher_details')->result_array(), 'semcl_det_teacher');

                // Insert only newly checked teachers
                $to_insert = array_diff($teacher_ids, $existing_teacher_ids);

                foreach ($to_insert as $teacher_id) {
                $this->db->insert('semester_classteacher_details', [
                'semcl_det_teacher' => $teacher_id,
                'semcl_sem_id'      => $record_id
                ]);
                }

                // Delete unchecked teachers only if editing an existing record
                if ($semcl_id || $existing_record) {
                $to_delete = array_diff($existing_teacher_ids, $teacher_ids);
                if (!empty($to_delete)) {
                $this->db->where('semcl_sem_id', $record_id);
                $this->db->where_in('semcl_det_teacher', $to_delete);
                $this->db->delete('semester_classteacher_details');
                }
                }

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('semester_activities/semester_classteacher/index');
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('semester_activities/class_teacher/add_data', $data);
                $this->load->view('layout/footer', $data);
                }                  
                




                public function index()
                {
                // if (!$this->rbac->hasPrivilege('faculty', 'can_view')) {
                // access_denied();
                // }
                 $this->session->set_userdata('top_menu', 'semester_activities');
                // $this->session->set_userdata('sub_menu', 'semester_classteacher/index');

                $data['title']              =   'Class Teacher';
                $data['title_list']         =   'Add Class Teacher';  
                $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();

                // $data['Programmetype_list'] =   $this->Programmetype_model->get();
                // $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
                // $data['semestertype_list']  =   $this->Semestertype_model->getdata(); 
                // $data['semester_term']      =   $this->Set_duration_model->get_semester_term();

                
                $data['programs']           = $this->Semester_enrollment_model->get_program_list();
                $data['batch_types']        = $this->Semester_enrollment_model->get_batch_types();
                $data['semester_term']      = $this->Semester_enrollment_model->get_semester_term();

                $teacher                    = $this->input->post('teacher');
                $data['get_classteacher']   = $this->Semesteractivities_model->get_sem_classteacher(); 


                // $program                    =   $this->input->post('programe');
                // $batch_group                =   $this->input->post('batch_group');
                // $semester_semtype           =   $this->input->post('semester_semtype');
                // $semester_term              =   $this->input->post('semester_term');                


                $batch_group        = $this->input->post('batchtype_id');
                $program            = $this->input->post('program'); 
                $semester_term      = $this->input->post('semester_term');


                // $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('program', $this->lang->line('programee'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('batchtype_id', 'Batch ', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester_type'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
                // $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'callback_check_teacher');



                if ($this->form_validation->run() == false) 
                {                 
                } 
<<<<<<< HEAD

                else 
                { 
                $sem_group_id        = $this->input->post('sem_type'); 
                $branch_id          = $this->input->post('branch_id');
                $description        = $this->input->post('description');
                $teacher_ids        = $this->input->post('teacher');  // Array of selected teacher IDs
   
=======
                else 
                {  

                $this->db->where('sem_group_program', $program);
                $this->db->where('sem_group_batchgroup', $batch_group);               
                // $this->db->where('sem_group_semester', $semester_semtype);
                $this->db->where('sem_group_semester_term', $semester_term); 
                $query = $this->db->get('semester_group');                        

                if ($query->num_rows() == 0) 
                {
                $data_to_insert = array(
                'sem_group_batchgroup'   => $batch_group,
                'sem_group_program'      => $program,
                // 'sem_group_semester'     => $semester_semtype,
                'sem_group_semester_term'=> $semester_term,                
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



                // $sem_group_id = $this->input->post('sem_group_id');
                $branch_id    = $this->input->post('branch_id');
                $description  = $this->input->post('description');
                $teacher_ids  = $this->input->post('teacher');  // Array of selected teacher IDs
                // $semcl_id     = $this->input->post('semcl_id');  // Comes from form when editing
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

                // Ensure $teacher_ids is always an array
                $teacher_ids       = is_array($teacher_ids) ? $teacher_ids : [];

                // Check if a semester_classteacher already exists for this sem_group
                $this->db->where('semcl_sem_group', $sem_group_id);
                $existing_record   = $this->db->get('semester_classteacher')->row();


                if ($existing_record) 
                {
                // Already exists, use this ID
                $record_id              = $existing_record->semcl_id;
                // Optionally update description/branch if needed
                $update_data            = array(
                'semcl_branch_id'       => $branch_id,
                'semcl_sem_description' => $description,
                'semcl_updateddate'     => date('Y-m-d H:i:s')
                );
                $this->db->where('semcl_id', $record_id);
                $this->db->update('semester_classteacher', $update_data);
                } 
                else
                {
                // Insert new main record
                $data = array(
                'semcl_sem_group'       => $sem_group_id,
                'semcl_branch_id'       => $branch_id,
                'semcl_sem_description' => $description,
                'semcl_createddate'     => date('Y-m-d H:i:s'),
                'semcl_sem_status'      => 1
                );
                $record_id               = $this->Semesteractivities_model->add_sem_classteacher($data);
<<<<<<< HEAD
                }          
=======
                }

                // Handle semester_classteacher_details for this semcl_id only
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

                // Get existing teacher IDs for this semester/class
                $this->db->select('semcl_det_teacher');
                $this->db->where('semcl_sem_id', $record_id);
                $existing_teacher_ids = array_column($this->db->get('semester_classteacher_details')->result_array(), 'semcl_det_teacher');

                // Insert only newly checked teachers
                $to_insert = array_diff($teacher_ids, $existing_teacher_ids);
                foreach ($to_insert as $teacher_id) {
                $this->db->insert('semester_classteacher_details', [
                'semcl_det_teacher' => $teacher_id,
                'semcl_sem_id'      => $record_id
                ]);
                }

                // Delete unchecked teachers only if editing an existing record
                if ($semcl_id || $existing_record) {
                $to_delete = array_diff($existing_teacher_ids, $teacher_ids);
                if (!empty($to_delete)) {
                $this->db->where('semcl_sem_id', $record_id);
                $this->db->where_in('semcl_det_teacher', $to_delete);
                $this->db->delete('semester_classteacher_details');
                }
                }

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('semester_activities/semester_classteacher/index');
                }
<<<<<<< HEAD
                $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();                
                $data['programs']           =    $this->Semester_enrollment_model->get_program_list();

                $this->load->view('layout/header', $data);
                $this->load->view('semester_activities/class_teacher/add_data', $data);
                $this->load->view('layout/footer', $data);
                }
=======
                 
                $this->load->view('layout/header', $data);
                $this->load->view('semester_activities/class_teacher/add_data', $data);
                $this->load->view('layout/footer', $data);
                } 


>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956


                public function check_teacher($teacher)
                {
                if (empty($teacher)) {
                $this->form_validation->set_message('check_teacher', 'Please select at least one ' . $this->lang->line('teacher') . '.');
                return FALSE;
                }
                return TRUE;
                }

<<<<<<< HEAD


=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
                public function edit($id='0')
                { 
                $this->session->set_userdata('top_menu', 'semester');
                $this->session->set_userdata('sub_menu', 'semester_classteacher/index');
                $data['title']              =   'Class Teacher';
                $data['title_list']         =   'Add Class Teacher';  
                $data['get_classteacher']   =   $this->Semesteractivities_model->get_sem_classteacher();
                $data['edit_classteacher']  =   $this->Semesteractivities_model->get_sem_classteacher($id);
                $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();
                $data['Programmetype_list'] =   $this->Programmetype_model->get();
                $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
                $data['semestertype_list']  =   $this->Semestertype_model->getdata(); 
                $teacher                    =   $this->input->post('teacher');
                $data['id']                 =   $id;
                $sem_group_id               =   $this->input->post('sem_group_id');
                $branch_id                  =   $this->input->post('branch_id');
                $description                =   $this->input->post('description');
                $teacher_ids                =   $this->input->post('teacher');  // Array of selected teacher IDs
                $semcl_id                   =   $this->input->post('semcl_id');  // Comes from the form when editing

                $this->form_validation->set_rules('programe', $this->lang->line('programe'), 'trim|required|xss_clean');

                if ($this->form_validation->run() == false) 
                {

                $this->load->view('layout/header', $data);
                $this->load->view('semester_activities/class_teacher/edit_data', $data);
                $this->load->view('layout/footer', $data);
                }
                else
                {
                // Prepare data array
                $data = array(
                'semcl_id'              => $id,
                'semcl_sem_group'       => $sem_group_id,
                'semcl_branch_id'       => $branch_id,
                'semcl_sem_description' => $description,
                'semcl_updateddate'     => date('Y-m-d H:i:s')
                );        

                $record_id = $this->Semesteractivities_model->add_sem_classteacher($data);

                // Step 2: Update semester_classteacher_details

                // First, delete existing related teacher IDs
                $this->db->where('semcl_sem_id', $record_id);
                $this->db->delete('semester_classteacher_details');

                // Then, insert new selected teacher IDs
                if (!empty($teacher_ids)) {
                foreach ($teacher_ids as $teacher_id) {
                $detail_data = array(
                'semcl_det_teacher' => $teacher_id,
                'semcl_sem_id'      => $record_id
                );
                $this->db->insert('semester_classteacher_details', $detail_data);
                }
                }

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect($_SERVER['HTTP_REFERER']);                    
                }
                } 



                public function delete($id='0')
                {
                $data['title']       = 'Assign Class Teacher';
                $this->Semesteractivities_model->remove_clsteach($id);
                redirect($_SERVER['HTTP_REFERER']);
                }




                public function update_status()
                {
                $id                = $this->input->post('id');
                $status            = $this->input->post('status');

                $data              = array(
                'semcl_sem_status' => $status
                );
                $this->db->where('semcl_id', $id);
                if ($this->db->update('semester_classteacher', $data)) {
                echo json_encode(array('status' => 'success'));
                } else {
                echo json_encode(array('status' => 'error'));
                }
                }


                

                public function bulkDelete()
                {
                $ids = $this->input->post('ids');
                if (!empty($ids)) {
                foreach ($ids as $id) {

                $this->Semesteractivities_model->remove_clsteach($id);
                }
                echo "success";
                } else {
                echo "no_ids";
                }
                }




                public function getAssigned_classteacher999()
                {
                $batch    = $this->input->post('batch_type');
                $program  = $this->input->post('programe');
                $semester = $this->input->post('semester_type');

                $sem_group_id = $this->input->post('sem_group_id');

                // Step 1: Check semester_group
                $this->db->where('sem_group_batchgroup', $sem_group_id);
                $this->db->where('sem_group_program', $program);
                $this->db->where('sem_group_semester', $semester);
                $query = $this->db->get('semester_group');

                if ($query->num_rows() > 0) {
                $row = $query->row();
                $sem_group_id = $row->sem_group_id;

                // Step 2: Get assigned subject groups
                $this->db->where('semcl_sem_group', $sem_group_id);
<<<<<<< HEAD
=======

>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
                $this->db->join('semester_classteacher_details','semester_classteacher_details.semcl_sem_id=semester_classteacher.semcl_id');
                $subQuery = $this->db->get('semester_classteacher');
                $classTeacherGroups = [];
                if ($subQuery->num_rows() > 0) {
                foreach ($subQuery->result() as $sg) {
                $classTeacherGroups[] = $sg->semcl_det_teacher;
                }
                }
                echo json_encode(['status' => 'exists', 'Class Teacher' => $classTeacherGroups]);
                } else {
                echo json_encode(['status' => 'not_found']);
                }
                }

<<<<<<< HEAD
                // public function getAssigned_classteacher()
                // {
                // $batch        = $this->input->post('batch_type');
                // $program      = $this->input->post('programe');
                // $semester     = $this->input->post('semester_type');
                // $sem_group_id = $this->input->post('sem_group_id');

                // // Step 1: Check semester_group
                // $this->db->where('semcl_sem_group', $sem_group_id);                      
                // $query = $this->db->get('semester_classteacher');

                // if ($query->num_rows() > 0) {
                // $row = $query->row();
                // $semcl_sem_group = $row->semcl_sem_group;

                // // Step 2: Get assigned subject groups
                // $this->db->where('semcl_sem_group', $sem_group_id);
                // $this->db->join('semester_classteacher_details', 'semester_classteacher_details.semcl_sem_id = semester_classteacher.semcl_id');
                // $subQuery = $this->db->get('semester_classteacher');

                // $classTeacherGroups = [];
                // if ($subQuery->num_rows() > 0) {
                // foreach ($subQuery->result() as $sg) {
                // $classTeacherGroups[] = $sg->semcl_det_teacher;
                // }
                // }
                // // Use a JS-friendly key
                // echo json_encode(['status' => 'exists', 'subject_groups' => $classTeacherGroups]);
                // } else {
                // echo json_encode(['status' => 'not_found']);
                // }
                // }

                public function get_assigned_teachers()
                {
                $sem_group_id   = $this->input->post('sem_group_id');
                $record_id      = $this->Semesteractivities_model->get_assigned_teachers($sem_group_id);
                echo json_encode($record_id);
                }
=======




                public function getAssigned_classteacher()
                {
                $batch        = $this->input->post('batch_type');
                $program      = $this->input->post('programe');
                $semester     = $this->input->post('semester_type');
                $sem_group_id = $this->input->post('sem_group_id');

                // Step 1: Check semester_group
                $this->db->where('semcl_sem_group', $sem_group_id);                      
                $query = $this->db->get('semester_classteacher');

                if ($query->num_rows() > 0) {
                $row = $query->row();
                $semcl_sem_group = $row->semcl_sem_group;

                // Step 2: Get assigned subject groups
                $this->db->where('semcl_sem_group', $sem_group_id);
                $this->db->join('semester_classteacher_details', 'semester_classteacher_details.semcl_sem_id = semester_classteacher.semcl_id');
                $subQuery = $this->db->get('semester_classteacher');

                $classTeacherGroups = [];
                if ($subQuery->num_rows() > 0) {
                foreach ($subQuery->result() as $sg) {
                $classTeacherGroups[] = $sg->semcl_det_teacher;
                }
                }
                // Use a JS-friendly key
                echo json_encode(['status' => 'exists', 'subject_groups' => $classTeacherGroups]);
                } else {
                echo json_encode(['status' => 'not_found']);
                }
                }


>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
                
                public function get_checked_teachers()
                {                
                $sem_group_id   = $this->input->post('semgroup');
                $data           = $this->Semesteractivities_model->get_checked_teachers($sem_group_id);
                echo json_encode($data);
                }
<<<<<<< HEAD
=======




>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
                }
