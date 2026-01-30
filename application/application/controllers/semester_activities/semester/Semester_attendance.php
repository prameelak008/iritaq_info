            <?php                    
            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            }


            class Semester_attendance extends Admin_Controller
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
            $data['title']               =  'Add Attendance';
            $data['title_list']          =  'Attendance';
            $data['Programmetype_list']  =   $this->Programmetype_model->get();
            $data['batch_group']         =   $this->Batchtype_model->get_batchgroup();
            $data['semestertype_list']   =   $this->Semestertype_model->getdata();  
            $data['subject_groups']      =   $this->Assignsubjects_model->get_subjectgroups();  
            $data['semester_term']       =   $this->Set_duration_model->get_semester_term();

            $this->form_validation->set_rules('programe', $this->lang->line('programee'), 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('attendanceDate', $this->lang->line('date'), 'trim|required|xss_clean'); 


            if ($this->form_validation->run() == false) 
            {              
            } 
            else 
            {
            $prg                    =  $this->input->post('programe'); 
            $sem                    =  $this->input->post('semester_type'); 
            $sem_term               =  $this->input->post('semester_term'); 
            $bat                    =  $this->input->post('batch_group');
            $sem_group_id           =  $this->input->post('sem_group_id'); 
            $data['attendanceDate'] =  $this->input->post('attendanceDate'); 
            $attendanceDate         = $data['attendanceDate'] ;
            $data['sem_group_id']   = $sem_group_id;
            // $data['students'] =  $this->Semesteractivities_model->get_students($sem_group_id); 
            $data['students'] = $this->Semesteractivities_model->get_students_with_attendance(
            $sem_group_id,
            $attendanceDate
            );

            $attendanceRecords =$data['students'];
            

           $hasMarked = false;
$allHoliday = true;

foreach ($attendanceRecords as $row) {
    if (!empty($row['attend_id'])) {
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
            $this->load->view('semester_activities/semester_atttendance/add_data', $data);                   
            $this->load->view('layout/footer', $data);
            }



            public function save_attendence0011()
            { 
            $statusArr          = $this->input->post('status');       // status[sl] => present/absent
            $student_ids        = $this->input->post('student_id');   // student_id[sl]
            $notesArr           = $this->input->post('notes');        // notes[sl]
            $commonLeave        = $this->input->post('leave');        // monthly/class/special
            $attend_date        = date('Y-m-d');
            $attend_date        = $this->input->post('attendanceDate'); 
            $at_sem_group_id    = $this->input->post('at_sem_group_id');  
            foreach ($student_ids as $sl => $student_id) {
            // Correct status assignment
            $status = $commonLeave ?? ($statusArr[$sl] ?? null);

            // Correct note assignment if notes array is numerically indexed
            $note = $notesArr[$sl] ?? '';

            $data = [
            'attend_student_id'  => $student_id,    
            'attend_group_id'    => $at_sem_group_id,
            'attend_date'        => $attend_date,
            'attend_CreatedDate' => date('Y-m-d H:i:s'),
            'attend_notes'       => $note,
            'attend_type_id'     => $status
            ];

            // Use correct variable for group id
            $existing = $this->db
            ->where('attend_student_id', $student_id)
            ->where('attend_group_id', $at_sem_group_id)
            ->where('attend_date', $attend_date)
            ->get('semester_attendance')
            ->row();

            if ($existing) {
            $this->db->where('attend_id', $existing->attend_id)
            ->update('semester_attendance', $data);
            } else {
            $this->db->insert('semester_attendance', $data);
            }
            }
            // If this is an AJAX request, return JSON so the page is not refreshed
            if ($this->input->is_ajax_request()) {
            $this->output->set_content_type('application/json');
            echo json_encode(array(
            'status'  => true,
            'message' => 'Attendance saved successfully.'
            ));
            return;
            }
            // Fallback for non-AJAX submission
            redirect('semester_activities/semester_attendance/index');
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

            $saved = 0;
            foreach ($student_ids as $sl => $student_id) {
            $status = $statusArr[$sl] ?? null;
            if (!empty($commonLeave)) {
            $status = is_array($commonLeave) ? $commonLeave[0] : $commonLeave;
            }

            $note = $notesArr[$sl] ?? '';

            $data = [
            'attend_student_id'  => $student_id,
            'attend_group_id'    => $at_sem_group_id,
            'attend_date'        => $attend_date,
            'attend_CreatedDate' => date('Y-m-d H:i:s'),
            'attend_notes'       => $note,
            'attend_type_id'     => $status
            ];

            $existing = $this->db
            ->where('attend_student_id', $student_id)
            ->where('attend_group_id', $at_sem_group_id)
            ->where('attend_date', $attend_date)
            ->get('semester_attendance')
            ->row();

            if ($existing) {
            $this->db->where('attend_id', $existing->attend_id)->update('semester_attendance', $data);
            } else {
            $this->db->insert('semester_attendance', $data);
            }

            $saved++;
            }

            // ✅ Flash message for reload
            $this->session->set_flashdata('msg', "$saved attendance records saved successfully");

            echo json_encode(['status' => true]);
            }

            }