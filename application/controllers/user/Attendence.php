            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Attendence extends Student_Controller
            {

            public function __construct()
            {
            parent::__construct();
            }



            public function getdaysubattendence()
            {
            $date = $this->input->post('date');
            $date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));

            $attendencetypes = $this->attendencetype_model->get();
            $timestamp       = strtotime($date);
            $day             = date('l', $timestamp);

            $student_id                    = $this->customlib->getStudentSessionUserID();
            $student                       = $this->student_model->get($student_id);
            $student_current_class         = $this->customlib->getStudentCurrentClsSection();
            $student_session_id            = $student_current_class->student_session_id;
            $class_id                      = $student_current_class->class_id;
            $section_id                    = $student_current_class->section_id;
            $result['attendencetypeslist'] = $attendencetypes;
            $result['attendence']          = $this->studentsubjectattendence_model->studentAttendanceByDate($class_id, $section_id, $day, $date, $student_session_id);
            $result_page                   = $this->load->view('user/attendence/_getdaysubattendence', $result, true);
            echo json_encode(array('status' => 1, 'result_page' => $result_page));
            }



            public function index()
            {
            $this->session->set_userdata('top_menu', 'Attendence');
            // $this->session->set_userdata('sub_menu', 'book/index');
            $data['title']      = 'Attendence List';
            $result             = array();
            $data['resultList'] = $result;
            $setting_result     = $this->setting_model->get();

            $setting_result = ($setting_result[0]);
            $setting_result['attendence_type'];

            $this->load->view('layout/student/header');
            if ($setting_result['attendence_type']) {

            $this->load->view('user/attendence/attendenceSubject', $data);
            } else {
            $this->load->view('user/attendence/attendenceIndex', $data);
            }

            $this->load->view('layout/student/footer');
            }



            public function getAttendence()
            {
            $year                  = $this->input->get('year');
            $month                 = $this->input->get('month');
            $student_id            = $this->customlib->getStudentSessionUserID();
            $student               = $this->student_model->get($student_id);
            $student_current_class = $this->customlib->getStudentCurrentClsSection();
            $student_session_id    = $student_current_class->student_session_id;
            $result                = array();
            $new_date              = "01-" . $month . "-" . $year;
            $totalDays             = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $first_day_this_month  = date('01-m-Y');
            $fst_day_str           = strtotime(date('d-m-Y', strtotime($new_date)));
            $array                 = array();
            for ($day = 1; $day <= $totalDays; $day++) {
            $date               = date('Y-m-d', $fst_day_str);
            $student_attendence = $this->attendencetype_model->getStudentAttendence($date, $student_session_id);
            if (!empty($student_attendence)) {
            $s           = array();
            $s['date']   = $date;
            $s['badge']  = false;
            $s['footer'] = "Extra information";
            $type        = $student_attendence->type;
            $s['title']  = $type;
            if ($type == 'Present') {
            $s['classname'] = "grade-4";
            } else if ($type == 'Absent') {
            $s['classname'] = "grade-1";
            } else if ($type == 'Late') {
            $s['classname'] = "grade-3";
            } else if ($type == 'Late with excuse') {
            $s['classname'] = "grade-2";
            } else if ($type == 'Holiday') {
            $s['classname'] = "grade-5";
            } else if ($type == 'Half Day') {
            $s['classname'] = "grade-2";
            }
            $array[] = $s;
            }
            $fst_day_str = ($fst_day_str + 86400);
            }
            if (!empty($array)) {
            echo json_encode($array);
            } else {
            echo false;
            }
            }


            public function custom_report()
            {
            $this->session->set_userdata('top_menu', 'Attendence');
            $this->session->set_userdata('sub_menu', 'book/index');
            $session_id                   =    $this->input->post('session_id');
            $from_date                    =    $this->input->post('from_date');
            $to_date                      =    $this->input->post('to_date');
            $data['session_id']           =    $session_id;
            $this->sch_current_session    =    $this->setting_model->getCurrentSession();
            $data['current_session']      =    $this->sch_current_session;
            $session                      =    $this->session_model->get();
            $data['sessionlist']          =    $session;
            $student_current_class        =    $this->customlib->getStudentCurrentClsSection();
            $student_session_id           =    $student_current_class->student_session_id;
            $class_id                     =    $student_current_class->class_id;
            $section_id                   =    $student_current_class->section_id;
            $data['attendence']           =    $this->studentsubjectattendence_model->studentAttendanceByDateReport($class_id,$section_id,$session_id,$from_date,$to_date,$student_session_id);

            $leavemanagementleaves        =    $this->studentsubjectattendence_model->get_leavemanagement_leaves_bydate($class_id, $section_id, $from_date, $to_date);
            $data['leavemanagementleaves']=    $leavemanagementleaves;
            $data['tot_timetable_days']   =    $this->studentsubjectattendence_model->get_totaltimetabledays($class_id, $section_id);

            $dayCounts = array(
            'Sunday' => 0,
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0
            );

            $firstDay = new DateTime($from_date);
            $lastDay  = new DateTime($to_date);
            while ($firstDay <= $lastDay) {
            $dayName = $firstDay->format('l'); 
            $dayCounts[$dayName]++; 
            $firstDay->modify('+1 day');
            }
            $data['wekdays']    =  $dayCounts;
            $data['title']      = 'Attendence List';
            $this->load->view('layout/student/header');
            $this->load->view('user/attendence/custom_attendence_report', $data);
            $this->load->view('layout/student/footer');
            }
            }
