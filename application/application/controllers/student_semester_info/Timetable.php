
            <?php
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }
            

            class Timetable extends MY_Controller
            {
            public function __construct() {
            parent::__construct();
            $this->sch_setting_detail = $this->setting_model->getSetting();
            } 
            




            public function index001()
            {            
            // $this->session->set_userdata('top_menu', 'Time_table');
            // $student_current_class = $this->customlib->getStudentCurrentClsSection();

            // $student_id = $this->customlib->getStudentSessionUserID();
            // $student = $this->student_model->get($student_id);


            $sem              = $this->session->userdata('sem_student');  
            $sem_group_id     = $sem['sem_group_id'];
            $student_id       = (int)$sem['user_id'];             
            $student          = $this->Semester_user_model->get_students($student_id);
            $data['student']  = $student; 
            $days             = $this->customlib->getDaysname();
            $days_record      = array();

            

            foreach ($days as $day_key => $day_value) 
            {
            $days_record[$day_key] = $this->subjecttimetable_model->getparentSubjectByClassandSectionDay($student_current_class->class_id, $student_current_class->section_id, $day_key);
            }
            
            $data['timetable'] = $days_record;
            $this->load->view('layout/semester/header', $data);
            $this->load->view('user_semester/user/timetableList', $data); 
           
            $this->load->view('layout/semester/footer', $data);         
            }





            public function index()
            {
            $sem = $this->session->userdata('sem_student');
            $sem_group_id = (int)$sem['sem_group_id'];

            // Get days from customlib
            $days = $this->customlib->getDaysnameWithoutLang();

            // Fetch timetable records
            $records = $this->semesterauth_model->getSemesterTimetable($sem_group_id);

            $timetable = [];
            $time_slots = [];

            foreach ($records as $row) {
            $time = $row->tb_time_from . ' - ' . $row->tb_time_to;
            $timetable[$time][$row->tb_day] = $row->subject_name;
            $time_slots[$time] = true;
            }

            $data['days'] = $days;
            $data['time_slots'] = array_keys($time_slots);
            $data['timetable'] = $timetable;

            $this->load->view('layout/semester/header', $data);
            $this->load->view('user_semester/user/timetableList', $data);
              $this->load->view('layout/semester/datatables', $data);  
            $this->load->view('layout/semester/footer', $data);
            }
            }

