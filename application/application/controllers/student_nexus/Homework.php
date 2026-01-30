                <?php

                if (!defined('BASEPATH')) 
                {
                exit('No direct script access allowed');
                } 


                class Homework extends Admin_Controller
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




                public function index()
                {  
                                          
                $this->session->set_userdata('top_menu', 'student_nexus');
                // Page title
                $data['title']                      = 'Student Search';

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
                $data['subject_groups']             = $this->Assignsubjects_model->get_subjectgroups(); 
           

                // Form validation
                $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
                $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('subject_group', 'subject_group', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('subjects', 'subjects', 'trim|required|xss_clean');

                if ($this->form_validation->run() == false) 
                {
                // First load or validation failed: just show the form
                $this->load->view('layout/header');
                $this->load->view('student_nexus/homework', $data);
                $this->load->view('layout/footer');
                } 
                else
                {
                // Form submitted: get program and semester selection
                $program_id                     = $this->input->post('program'); 
                $semester_value                 = $this->input->post('semester'); // e.g. "1|12|3"
                $subject_group                  = $this->input->post('subject_group_mod'); 
                $subjects                       = $this->input->post('subject_mod');            

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

                $data['homeworklist']           = $this->student_nexus_model->get_homeworklist($sem_groups['sem_group_id']);                

                $this->load->view('layout/header');
                $this->load->view('student_nexus/homework', $data);
                $this->load->view('layout/footer');
                }
                }   
                  

                public function get_sem_group_id() 
                {
                $program_id = $this->input->post('program_id');
                $semester   = $this->input->post('semester');
                $batch      = $this->input->post('batch');
                $term       = $this->input->post('term');

                // Query semester_group table
                $this->db->select('sem_group_id');
                $this->db->from('semester_group');
                $this->db->where('sem_group_program', $program_id);
                $this->db->where('sem_group_semester', $semester);
                $this->db->where('sem_group_batchgroup', $batch);
                $this->db->where('sem_group_semester_term', $term);
                $query = $this->db->get();
                $result = $query->row();
                echo json_encode($result);
                }


                public function get_subject_groups() 
                {
                $sem_group_id = $this->input->post('sem_group_id');

                if (!$sem_group_id) {
                echo json_encode([]);
                return;
                }

                // Select subject groups assigned to this sem_group_id
                $this->db->select('semester_subject_groups.id, semester_subject_groups.name, semester_subject_groups.description');
                $this->db->from('semester_subject_groups');
                $this->db->join('semester_assign_subjects', 'semester_assign_subjects.sem_assign_subjects_id = semester_subject_groups.id', 'inner');
                $this->db->where('semester_assign_subjects.sem_assign_group_id', $sem_group_id);

                $query = $this->db->get();
                $result = $query->result(); // use result() to get all rows
                echo json_encode($result);
                }



                public function get_subjects() 
                {
                $subject_group_id = $this->input->post('subject_group_id');          
                if (empty($subject_group_id)) {
                echo json_encode([]);
                return;
                }
                $this->db->select('subjects.*');
                $this->db->from('semester_subject_group_subjects');
                $this->db->join('subjects', 'subjects.id = semester_subject_group_subjects.subject_id');
                $this->db->where('semester_subject_group_subjects.subject_group_id', $subject_group_id);            
                $query = $this->db->get();
                $result = $query->result();
                echo json_encode($result);
                }

                public function get_sem_group_id_mod()
                {
                $program_id  = $this->input->post('program_id');
                $semester_id = $this->input->post('semester_id');
                $batch_id    = $this->input->post('batch_id');
                $term_id     = $this->input->post('term_id');

                $row = $this->db->where([
                'sem_group_program'       => $program_id,
                'sem_group_semester'      => $semester_id,
                'sem_group_batchgroup'    => $batch_id,
                'sem_group_semester_term' => $term_id
                ])->get('semester_group')->row();

                if ($row) {
                echo json_encode([
                'status' => true,
                'sem_group_id' => $row->sem_group_id
                ]);
                } else {
                echo json_encode([
                'status' => false
                ]);
                }
                }
               


                public function add_or_update()
                {
                $userdata = $this->customlib->getUserData();

                // Get ID from form
                $homework_id = $this->input->post('sem_home_id_mod');

                $data = [
                'sem_group_id'             => $this->input->post('sem_group_id_mod'),
                'homework_date'            => $this->input->post('homework_date'),
                'submit_date'              => $this->input->post('submit_date'),
                'subject_group_subject_id' => $this->input->post('subject_group_mod'),
                'subject_id'               => $this->input->post('subject_mod'),
                'description'              => $this->input->post('description'),
                'staff_id'                 => $userdata["id"],
                'created_by'               => $userdata["id"],
                ];

                /* ---------- FILE UPLOAD ---------- */
                if (!empty($_FILES['document']['name'])) 
                {
                $config['upload_path']   = FCPATH . 'files/students/homework/';
                $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
                $config['max_size']      = 2048; // 2 MB
                $config['encrypt_name']  = true;
                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('document')) 
                {
                echo json_encode([
                'status'  => false,
                'message' => strip_tags($this->upload->display_errors())
                ]);
                exit;
                }

                $file = $this->upload->data();
                $data['document'] = $file['file_name'];
                }

                if ($homework_id) {
                // Update existing homework
                $this->db->where('id', $homework_id);
                $update = $this->db->update('sem_homework', $data);
                echo json_encode([
                'status'  => $update ? true : false,
                'message' => $update ? 'Homework updated successfully' : 'Failed to update homework'
                ]);
                } else {
                // Add new homework
                $data['create_date'] = date('Y-m-d H:i:s');
                $insert = $this->db->insert('sem_homework', $data);
                echo json_encode([
                'status'  => $insert ? true : false,
                'message' => $insert ? 'Homework saved successfully' : 'Failed to save homework'
                ]);
                }
                exit;
                }


                public function delete()
                {
                $id   = $this->input->post('id');            
                $this->db->where('id', $id);
                $this->db->delete('sem_homework');
                redirect($_SERVER['HTTP_REFERER']);                      
                }

                public function view()
                { 
                $this->load->model('student_nexus_model');                   
                $homework_id                  = $this->input->post('homework_id');
                $sem_group_id                 = $this->input->post('sem_group_id');            
                $data['sem_group_id']         = $sem_group_id;
                $data['homework_id']          = $homework_id;                
                $data['get_homework_details'] = $this->student_nexus_model->get_homework_details($homework_id);
                $data['students']             = $this->student_nexus_model->get_students($sem_group_id);


                $evaluated_students = $this->student_nexus_model->get_evaluated_students($homework_id);
                $evaluated_student_ids = array_column($evaluated_students, 'student_id');
                $data['evaluated_student_ids'] = $evaluated_student_ids;


                $this->load->view('student_nexus/student_evaluation_modal',$data);
                }

                

                public function add_evaluation()
                {                                       
                $homework_id         = $this->input->post('homework_id');
                $evaluation_date     = $this->input->post('evaluation_date');
                $student_ids         = $this->input->post('student_ids'); // array of selected students

                if (!empty($student_ids)) {
                foreach ($student_ids as $student_id) 
                {
                // Check if already exists for this student and homework
                $exists = $this->db->get_where('sem_homework_evaluation', [
                'homework_id' => $homework_id,
                'student_id'  => $student_id
                ])->row();

                if (!$exists) {
                // Insert new evaluation record
                $insert_data = [
                'homework_id'        => $homework_id,
                'student_id'         => $student_id,
                'student_session_id' => 0, // add session id if available
                'date'               => $evaluation_date,
                'status'             => 'pending' // default
                ];
                $this->db->insert('sem_homework_evaluation', $insert_data);
                } else {
                // Update date if record exists
                $this->db->where('id', $exists->id);
                $this->db->update('sem_homework_evaluation', ['date' => $evaluation_date]);
                }
                }
                }

                // Update evaluation_date in homework master table (sem_homework)
                $this->db->where('id', $homework_id);
                $this->db->update('sem_homework', ['evaluation_date' => $evaluation_date]);
                $this->session->set_flashdata('success', 'Evaluation date updated and students added successfully!');
                // redirect('student_nexus/homework'); // change to your listing page
                 redirect($_SERVER['HTTP_REFERER']);    
                }




                public function get_homework_by_id()
                {
                    
                $homework_id = $this->input->post('homework_id');

                // if (!$id) {
                // echo json_encode(['status' => false]);
                // return;
                // }
        
                $data = $this->student_nexus_model->get_homework_details($homework_id);

                if ($data) {
                echo json_encode([
                'status' => true,
                'data'   => $data
                ]);
                } else {
                echo json_encode(['status' => false]);
                }
                }


                }


              
