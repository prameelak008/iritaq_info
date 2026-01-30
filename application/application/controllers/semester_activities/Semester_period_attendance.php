            <?php                    
            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            }


            class Semester_period_attendance extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();
            $this->load->helper('form');
            $this->config->load('app-config');
            $this->load->library("datatables");
            $this->load->library('Customlib');                      
            $this->current_session = $this->setting_model->getCurrentSession(); 
            }




            public function index()
            {          

            $data['title']                     =  'Add Attendance';
            $data['title_list']                =  'Attendance';

            // $data['Programmetype_list']  =   $this->Programmetype_model->get();
            // $data['batch_group']         =   $this->Batchtype_model->get_batchgroup();
            // $data['semestertype_list']   =   $this->Semestertype_model->getdata();  
            // $data['subject_groups']      =   $this->Assignsubjects_model->get_subjectgroups();  
            // $data['semester_term']       =   $this->Set_duration_model->get_semester_term();
            // Program types and programs


            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();

            // Semesters, batches, and terms
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();
            $data['subject_groups']             = $this->Assignsubjects_model->get_subjectgroups(); 



            // Form validation
            $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');
      

            if ($this->form_validation->run() == false) 
            {   
            // First load or validation failed: just show the form
            // $this->load->view('layout/header');
            // $this->load->view('semester_activities/semester_sub_atttendance/add_data', $data);
            // $this->load->view('layout/footer');
            } 
            else
            {                 
            $program_id                     = $this->input->post('program'); 
            $semester_value                 = $this->input->post('semester');  
            $period                         = $this->input->post('period');
        


            // Split semester value into individual IDs: semester type, batch, term

            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);            
            $data['selected_program']       = $program_id;
            $data['selected_semester_type'] = $semester_type_id;
            $data['selected_batch']         = $batch_id;
            $data['selected_term']          = $semester_term_id;             

            $data['period']                 = $period;
            $program                        = $data['selected_program'];
            $semester_id                    = $data['selected_semester_type'];
            $batch_id                       = $data['selected_batch'];
            $term_id                        = $data['selected_term'];
            $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group($program,$batch_id,$semester_id,$term_id); 
            $sem_groups                     = $data['sem_groups'];    


            // $prg                    =  $this->input->post('programe'); 
            // $sem                    =  $this->input->post('semester_type'); 
            // $sem_term               =  $this->input->post('semester_term'); 
            // $bat                    =  $this->input->post('batch_group');

            $sem_group_id           =  $this->input->post('sem_group_id'); 
            $data['attendanceDate'] =  $this->input->post('attendanceDate'); 
            $attendanceDate         =  $data['attendanceDate'] ;
            $data['sem_group_id']   =  $sem_group_id;
            // // $data['students'] =  $this->Semesteractivities_model->get_students($sem_group_id); 
            $data['students']       = $this->Semesteractivities_model->get_stud_sub_with_attendance($sem_group_id, $attendanceDate);
            $attendanceRecords      = $data['students'];
            $hasMarked              = false;
            $allHoliday             = true;


            foreach ($attendanceRecords as $row) {
            if (!empty($row['id'])) {
            $hasMarked = true;
            if (!in_array($row['attend_status'], [5, 6, 7])) {
            $allHoliday = false;
            }
            }
            }

            if ($hasMarked) {
            $data['attendance_status_summary'] = $allHoliday ? 'holiday' : 'marked';
            } else {
            $data['attendance_status_summary'] = 'not_marked';
            }
            }            

            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_sub_atttendance/add_data', $data);                   
            $this->load->view('layout/footer', $data);
            }            
            
            

            public function getPeriodsBySemesterGroup()
            {
            $sem_group_id = $this->input->post('sem_group_id');

            $this->db->select('
            pt.periodic_table_id,
            pt.periodic_table_name,
            pt.periodic_table_timefrom,
            pt.periodic_table_timeto
            ');
            $this->db->from('semester_timetable st');
            $this->db->join('periodic_table pt','pt.periodic_table_id = st.tb_period_id');
            $this->db->where('st.tb_semester_group', $sem_group_id);
            $this->db->group_by('st.tb_period_id');
            $this->db->order_by('pt.periodic_table_count','ASC');

            echo json_encode($this->db->get()->result());
            }




            public function save_attendence()
            { 

            $this->output->set_content_type('application/json');
            $statusArr       = $this->input->post('status');
            $student_ids     = $this->input->post('student_id');
            $notesArr        = $this->input->post('notes');
            $commonLeave     = $this->input->post('leave');
            $attend_date     = $this->input->post('attendanceDate') ?: date('Y-m-d');
            $at_sem_group_id = $this->input->post('at_sem_group_id');
            $period          = $this->input->post('period');


            $saved           = 0;
            foreach ($student_ids as $sl => $student_id) {
            $status          = $statusArr[$sl] ?? null;
            if (!empty($commonLeave)) {
            $status          = is_array($commonLeave) ? $commonLeave[0] : $commonLeave;
            }
            $note            = $notesArr[$sl] ?? '';


            $data            = [
            'student_session_id'  => $student_id,
            'attend_group_id'     => $at_sem_group_id,
            'attend_date'         => $attend_date,
            'attend_CreatedDate'  => date('Y-m-d H:i:s'),
            'attend_notes'        => $note,
            'attendence_type_id'  => $status,
            'subject_timetable_id'=> $period  
            ];

            $existing = $this->db
            ->where('student_session_id', $student_id)
            ->where('attend_group_id', $at_sem_group_id)
            ->where('attend_date', $attend_date)
            ->where('subject_timetable_id', $period)
            ->get('sem_student_subject_attendances')
            ->row(); 

            if ($existing) 
            {
            $this->db->where('id', $existing->id)->update('sem_student_subject_attendances', $data);
            } 
            else
            {
            $this->db->insert('sem_student_subject_attendances', $data);
            }

            $saved++;
            }

            
            $this->session->set_flashdata('msg', "$saved attendance records saved successfully");
            echo json_encode(['status' => true]);
            }

            }