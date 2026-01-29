            <?php

            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            } 

            class Promote extends Admin_Controller
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
            $this->load->model("Programee_model");
            $this->load->model("Semestertype_model");
            $this->load->model("set_duration_model");
            $this->load->model("Semesteractivities_model");
            $this->load->model("Batchtype_model");        
            } 



            public function index()
            {  
            // Page title
            $data['title']                      = 'Student Search';            // School settings
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
            $this->load->view('semester_enrollment/promote', $data);
            $this->load->view('layout/footer');
            } 
            else
             {
            // Form submitted: get program and semester selection

            $program_id             = $this->input->post('program'); 
            $semester_value         = $this->input->post('semester'); // e.g. "1|12|3"
           
            $promote_program_id     = $this->input->post('promote_program'); 
            $promote_semester_value = $this->input->post('promote_semester');

            // EXTRA CHECK to avoid empty selects

            if (empty($program_id) ||
            empty($semester_value) ||
            empty($promote_program_id) ||
            empty($promote_semester_value)) {

            $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-danger">Please select all required options before continuing. *</div>'
            );
            redirect('semester_enrollment/Promote');
            return;
            }          

        
            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            
            $data['selected_program']       =   $program_id;
            $data['selected_semester_type'] =   $semester_type_id;
            $data['selected_batch']         =   $batch_id;
            $data['selected_term']          =   $semester_term_id;

            $program                        =   $data['selected_program'];
            $semester_id                    =   $data['selected_semester_type'];
            $batch_id                       =   $data['selected_batch'];
            $term_id                        =   $data['selected_term'];

            $data['sem_groups']             =   $this->Semesteractivities_model->get_sem_group($program,$batch_id,$semester_id,$term_id); 
            $sem_groups                     =   $data['sem_groups']; 
            
            
            $data['students']               =   $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);

            $promote_program_id             =   $this->input->post('promote_program'); 
            $promote_semester_value         =   $this->input->post('promote_semester'); // e.g. "1|12|3"

            $program_id                     =   $this->input->post('program'); 
            $semester_value                 =   $this->input->post('semester');

            $promote_program_id             =   $this->input->post('promote_program'); 
            $promote_semester_value         =   $this->input->post('promote_semester');

            $data['program_id']             =  $program_id;
            $data['semester_value']         =  $semester_value;

            $data['promote_program_id']     =  $promote_program_id;
            $data['promote_semester_value'] =  $promote_semester_value;

            // To display the name

            $program_details                = $this->Programee_model->get($program_id);
            $data['program_name']           = $program_details ? $program_details['p_name'] : '';

            $semester_details               = $this->Semestertype_model->get($semester_id);
            $data['semester_details']       = $semester_details ? $semester_details['st_name'] : '';

            $term_details                   = $this->set_duration_model->get_sem_term($term_id);
            $data['term_details']           = $term_details ? $term_details['stm_name'] : '';

            // Title of the batch


            $batch_details                  = $this->Batchtype_model->get_batchgroup($batch_id);          

            $data['batch_details'] = [
            'year' => $batch_details['batch_group_year'] ?? '',
            'name' => $batch_details['batch_group_name'] ?? ''
            ];           

            // Split semester value into individual IDs: semester type, batch, term
            list($promote_semester_type_id, $promote_batch_id, $promote_semester_term_id) = explode('|', $promote_semester_value);

            // Pass all selected values back to view for further processing / search
            $data['promote_selected_program']       = $promote_program_id;
            $data['promote_selected_semester_type'] = $promote_semester_type_id;
            $data['promote_selected_batch']         = $promote_batch_id;
            $data['promote_selected_term']          = $promote_semester_term_id;

           
            $this->db->where([
            'sem_group_program'       => $program_id,
            'sem_group_batchgroup'    => $batch_id,
            'sem_group_semester'      => $semester_type_id,
            'sem_group_semester_term' => $semester_term_id
            ]);

            $q1 = $this->db->get('semester_group');

            if ($q1->num_rows() > 0) {
           
            $current_sem_group_id = $q1->row()->sem_group_id;
            } else {
          
            $this->db->insert('semester_group', [
            'sem_group_program'       => $program_id,
            'sem_group_batchgroup'    => $batch_id,
            'sem_group_semester'      => $semester_type_id,
            'sem_group_semester_term' => $semester_term_id,
            'sem_group_createddate'   => date('Y-m-d H:i:s'),
            'sem_group_updateddate'   => date('Y-m-d H:i:s')
            ]);    
            }

            $this->db->where([
            'sem_group_program'       => $promote_program_id,
            'sem_group_batchgroup'    => $promote_batch_id,
            'sem_group_semester'      => $promote_semester_type_id,
            'sem_group_semester_term' => $promote_semester_term_id
            ]);


            $q2 = $this->db->get('semester_group');

            if ($q2->num_rows() > 0) {
            $promote_sem_group_id = $q2->row()->sem_group_id;
            } else {
            $this->db->insert('semester_group', [
            'sem_group_program'       => $promote_program_id,
            'sem_group_batchgroup'    => $promote_batch_id,
            'sem_group_semester'      => $promote_semester_type_id,
            'sem_group_semester_term' => $promote_semester_term_id,
            'sem_group_createddate'   => date('Y-m-d H:i:s'),
            'sem_group_updateddate'   => date('Y-m-d H:i:s')
            ]);
            }

            $promote_program              = $data['promote_selected_program'];
            $promote_semester_id          = $data['promote_selected_semester_type'];
            $promote_batch_id             = $data['promote_selected_batch'];
            $promote_term_id              = $data['promote_selected_term'];
            $data['promote_sem_groups']   = $this->Semesteractivities_model->get_sem_group($promote_program,$promote_batch_id,$promote_semester_id,$promote_term_id); 
            $promote_sem_groups           = $data['promote_sem_groups']; 

            $this->load->view('layout/header');
            $this->load->view('semester_enrollment/promote', $data);
            $this->load->view('layout/footer');
            }
            } 
            
                       
            
            public function add_data()
            {
            $sem_group_id           = $this->input->post('sem_group_id');
            $students               = $this->input->post('student_list');
            $program_id             = $this->input->post('program_id');
            $promote_program_id     = $this->input->post('promote_program_id');
            $semester_value         = $this->input->post('semester_value');
            $promote_semester_value = $this->input->post('promote_semester_value');

            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            list($promote_semester_type_id, $promote_batch_id, $promote_semester_term_id) = explode('|', $promote_semester_value);


            // $current_group = $this->Semesteractivities_model->get_sem_group(
            // $program_id,
            // $batch_id,
            // $semester_type_id,
            // $semester_term_id
            // );
            // $current_sem_group_id = $current_group['sem_group_id'];


            // $promote_group = $this->Semesteractivities_model->get_sem_group(
            // $promote_program_id,
            // $promote_batch_id,
            // $promote_semester_type_id,
            // $promote_semester_term_id
            // );
            // $promote_sem_group_id = $promote_group['sem_group_id'];





                // $this->db->insert('semester_group', [
                // 'sem_group_program'       => $program_id,
                // 'sem_group_batchgroup'    => $batch_id,
                // 'sem_group_semester'      => $semester_type_id,
                // 'sem_group_semester_term' => $semester_term_id,
                // 'sem_group_createddate'   => date('Y-m-d H:i:s'),
                // 'sem_group_updateddate'   => date('Y-m-d H:i:s')
                // ]);

                // $this->db->insert('semester_group', [
                // 'sem_group_program'       => $promote_program_id,
                // 'sem_group_batchgroup'    => $promote_batch_id,
                // 'sem_group_semester'      => $promote_semester_type_id,
                // 'sem_group_semester_term' => $promote_semester_term_id,
                // 'sem_group_createddate'   => date('Y-m-d H:i:s'),
                // 'sem_group_updateddate'   => date('Y-m-d H:i:s')
                // ]);


            if (empty($students)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">No students selected.</div>');
            redirect('semester_enrollment/Promote');
            return;
            }

            $count = 0;

            foreach ($students as $student_id) 
            {              
            // Get per-student radio values
            $result = $this->input->post('result_' . $student_id);      // pass / fail
            $next_status = $this->input->post('next_working_' . $student_id); // continue / leave

            // Check if already promoted in this sem_group
            $exists = $this->db
            ->where('student_id', $student_id)
            ->where('sem_group_id', $sem_group_id)
            ->get('semester_student_session')
            ->row();

            if ($exists) {
            continue;   // skip, do NOT insert again
            }

            // Alumni condition (pass + leave)
            $is_alumni = 0;
            if ($result == "pass" && $next_status == "leave") {
            $is_alumni = 1;

            // Update alumni table
            $this->student_model->alumni_student_status([
            'student_id' => $student_id,
            'is_alumni'  => 1
            ]);
            }


            $this->db->where('student_id', $student_id)
            // ->where('sem_group_id', $sem_group_id)
            ->update('semester_student_session', [
            'promote' => 0
            ]);

            // Insert into table
            $this->db->insert('semester_student_session', [
            'student_id'   => $student_id,
            'sem_group_id' => $sem_group_id,
            'result'       => $result,
            'next_status'  => $next_status,
            'is_alumni'    => $is_alumni,
            'promote'      => 1, 
            'is_active'    => 'yes',
            'created_at'   => date('Y-m-d H:i:s')
            ]);

            // Also ensure a row exists in semester_studentdetails for this student+group
            $exists_det = $this->db
                ->where('stud_student_id', $student_id)
                ->where('stud_semgroupid', $sem_group_id)
                ->get('semester_studentdetails')
                ->row();

            if ($exists_det) {
                $this->db->where('stud_id', $exists_det->stud_id)
                         ->update('semester_studentdetails', [
                             'stud_status' => 'active'
                         ]);
            } else {
                $this->db->insert('semester_studentdetails', [
                    'stud_student_id'  => $student_id,
                    'stud_semgroupid'  => $sem_group_id,
                    'stud_status'      => 'active'
                ]);
            }

            $count++;
            }
            // Flash message
            $this->session->set_flashdata('msg',
            '<div class="alert alert-success">'.$count.' students promoted successfully.</div>'
            );

            redirect('semester_enrollment/Promote');
            }  


            

            }