            <?php
            
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }
            
            class Studentsubjectattendence_model extends CI_Model
            {
            
            public function __construct()
            {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            $this->current_date    = $this->setting_model->getDateYmd();
            }
            
            
            public function add($insert_array, $update_array)
            {
            $this->db->trans_start();
            $this->db->trans_strict(false);
            if (!empty($insert_array)) {
            
            $this->db->insert_batch('student_subject_attendances', $insert_array);
            }
            if (!empty($update_array)) {
            $this->db->update_batch('student_subject_attendances', $update_array, 'id');
            }
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === false) {
            
            $this->db->trans_rollback();
            return true;
            } else {
            
            $this->db->trans_commit();
            return true;
            }
            }
            
            
            
            public function searchAttendenceClassSection($class_id, $section_id, $subject_timetable_id, $date)
            {
            $sql   = "SELECT  IFNULL(student_subject_attendances.id, '0') as student_subject_attendance_id,student_subject_attendances.subject_timetable_id,student_subject_attendances.attendence_type_id, IFNULL(student_subject_attendances.date, 'xxx') as date,student_subject_attendances.remark,students.*,student_session.id as student_session_id FROM students INNER JOIN student_session on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id =" . $this->db->escape($section_id) . "  AND student_session.session_id=" . $this->db->escape($this->current_session) . " LEFT JOIN student_subject_attendances on student_session.id=student_subject_attendances.student_session_id and student_subject_attendances.subject_timetable_id=" . $this->db->escape($subject_timetable_id) . " and date=" . $this->db->escape($date) . " where `students`.`is_active`='yes'  ";
            $query = $this->db->query($sql);
            return $query->result_array();
            }
            
            
            
            
            public function getStudentMontlyAttendence($class_id, $section_id, $from_date, $to_date, $year, $month_number, $student_id)
            {
            $student_array = array();
            
            $student_array['students_attendances'] = array();
            for ($i = 1; $i <= $to_date; $i++) {
            
            $date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);
            
            $day = date('l', strtotime($date));
            
            $students_time_table = $this->searchByStudentAttendanceByDate($class_id, $section_id, $day, $date, $student_id);
            $a                   = array();
            $a['date']           = $this->customlib->dateformat($date);
            $a['day']            = $day;
            $a['subjects']       = array();
            $a['attendances']    = array();
            
            if (!empty($students_time_table)) {
            $students_time_table = json_decode($students_time_table);
            
            $a['subjects'] = ($students_time_table->subjects);
            foreach ($students_time_table->student_record as $students_time_table_key => $students_time_table_value) {
            $a['attendances'] = ($students_time_table->student_record[$students_time_table_key]);
            }
            }
            $student_array['students_attendances'][$i] = $a;
            }
            return $student_array;
            }
            
            
            public function getStudentsMontlyAttendence_day($class_id, $section_id, $from_date, $to_date, $year, $month_number, $student_id)
            {
            $student_array = array();
            
            $student_array['students_attendances'] = array();
            for ($i = 1; $i <= $to_date; $i++) {
            
            $date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);
            
            $day = date('l', strtotime($date));
            
            $students_time_table = $this->searchByStudentAttendanceByDate($class_id, $section_id, $day, $date, $student_id);
            $a                   = array();
            $a['date']           = $this->customlib->dateformat($date);
            $a['day']            = $day;
            $a['subjects']       = array();
            $a['attendances']    = array();
            
            if (!empty($students_time_table)) {
            $students_time_table = json_decode($students_time_table);
            
            $a['subjects'] = ($students_time_table->subjects);
            foreach ($students_time_table->student_record as $students_time_table_key => $students_time_table_value) {
            $a['attendances'] = ($students_time_table->student_record[$students_time_table_key]);
            }
            }
            $student_array['students_attendances'][$i] = $a;
            }
            return $student_array;
            }
            
            
            public function searchByStudentAttendanceByDate($class_id, $section_id, $day, $date, $student_id)
            {
            
            $sql = "SELECT subject_timetable.*,subjects.id as `subject_id`,subjects.name,subjects.code,subjects.type FROM `subject_timetable` INNER JOIN subject_group_subjects on subject_group_subjects.id=subject_timetable.subject_group_subject_id INNER JOIN subjects on subjects.id=subject_group_subjects.subject_id WHERE subject_timetable.class_id=" . $this->db->escape($class_id) . " AND subject_timetable.section_id=" . $this->db->escape($section_id) . " and subject_timetable.session_id=" . $this->db->escape($this->current_session) . " and subject_timetable.day=" . $this->db->escape($day);
            
            $query    = $this->db->query($sql);
            $subjects = $query->result();
            
            if (!empty($subjects)) {
            $count        = 1;
            $append_sql   = "";
            $append_param = "";
            foreach ($subjects as $subject_key => $subject_value) {
            $append_param .= ",student_subject_attendances_" . $count . ".attendence_type_id as attendence_type_id_" . $count;
            $append_sql .= " LEFT JOIN student_subject_attendances as student_subject_attendances_" . $count . " on  student_subject_attendances_" . $count . ".student_session_id=student_session.id and student_subject_attendances_" . $count . ".subject_timetable_id=" . $this->db->escape($subject_value->id) . " and student_subject_attendances_" . $count . ".date=" . $this->db->escape($date);
            $count++;
            }
            $sql_student_record = "SELECT students.id,students.firstname" . $append_param . " FROM `students` INNER JOIN student_session on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " AND student_session.section_id=" . $this->db->escape($section_id) . " AND student_session.session_id=" . $this->db->escape($this->current_session) . $append_sql . " WHERE students.id=" . $student_id;
            $query              = $this->db->query($sql_student_record);
            $student_record     = $query->result();
            return json_encode(array('subjects' => $subjects, 'student_record' => $student_record));
            }
            
            return false;
            }
            
            public function studentAttendanceByDate($class_id, $section_id, $day, $date, $student_session_id)
            {
            $sql        = "SELECT subject_timetable.*,subject_group_subjects.subject_group_id,subjects.id as `subject_id`,subjects.name,subjects.code,subjects.type,student_subject_attendances.student_session_id,student_subject_attendances.attendence_type_id,student_subject_attendances.date,student_subject_attendances.remark,student_subject_attendances.id as `student_subject_attendance_id`,student_subject_attendances.date  FROM `subject_timetable` INNER JOIN subject_group_subjects on subject_group_subjects.id = subject_timetable.subject_group_subject_id and subject_group_subjects.session_id=" . $this->current_session . " INNER JOIN subjects on subjects.id=subject_group_subjects.subject_id LEFT JOIN student_subject_attendances on student_subject_attendances.subject_timetable_id=subject_timetable.id and student_subject_attendances.student_session_id=" . $this->db->escape($student_session_id) . " WHERE subject_timetable.class_id=" . $this->db->escape($class_id) . " AND subject_timetable.section_id=" . $this->db->escape($section_id) . " and subject_timetable.day=" . $this->db->escape($day) . "and student_subject_attendances.date=" . $this->db->escape($date);
            $query      = $this->db->query($sql);
            $attendance = $query->result();
            return $attendance;
            }
            
             
//                 public function studentAttendanceByDateReport($class_id, $section_id, $session_id, $from_date, $to_date, $student_session_id)
// {
//     $this->db->select('
//         subjects.code, 
//         subjects.name, 
//         COUNT(student_subject_attendances.id) as total,
//         SUM(CASE WHEN student_subject_attendances.attendance_type_id = 1 THEN 1 ELSE 0 END) as total_present,
//         SUM(CASE WHEN student_subject_attendances.attendance_type_id = 4 THEN 1 ELSE 0 END) as total_absent
//     ');
    
//     $this->db->from('subject_timetable');
//     $this->db->join('subject_group_subjects', 'subject_group_subjects.id = subject_timetable.subject_group_subject_id');
//     $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
//     $this->db->join('student_subject_attendances', 'student_subject_attendances.subject_timetable_id = subject_timetable.id');
//     $this->db->where('subject_timetable.class_id', $class_id);
//     $this->db->where('subject_timetable.section_id', $section_id);
//     $this->db->where('subject_timetable.session_id', $session_id);
//     $this->db->where('student_subject_attendances.student_session_id', $student_session_id);
//     // Filter by date if needed
//     $this->db->where('student_subject_attendances.date >=', $from_date);
//     $this->db->where('student_subject_attendances.date <=', $to_date);
//     $this->db->group_by('subjects.code, subjects.name');
//     $q = $this->db->get();
//     return $q->result_array();
// }




            public function studentAttendanceByDateReport($class_id, $section_id, $session_id, $from_date, $to_date, $student_session_id)
            {
                
            $this->db->select('
                subjects.code, 
                subjects.name, 
                COUNT(student_subject_attendances.id) as total,
                SUM(CASE WHEN student_subject_attendances.attendence_type_id  = 1 THEN 1 ELSE 0 END) as total_present,
                SUM(CASE WHEN student_subject_attendances.attendence_type_id  = 4 THEN 1 ELSE 0 END) as total_absent
            ');
            
            $this->db->from('subject_timetable');
            $this->db->join('subject_group_subjects', 'subject_group_subjects.id = subject_timetable.subject_group_subject_id');
            $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
            $this->db->join('student_subject_attendances', 'student_subject_attendances.subject_timetable_id = subject_timetable.id');
            $this->db->where('subject_timetable.class_id', $class_id);
            $this->db->where('subject_timetable.section_id', $section_id);
            $this->db->where('subject_timetable.session_id', $session_id);
            $this->db->where('student_subject_attendances.student_session_id', $student_session_id);
             //$this->db->where('student_subject_attendances.date >=', $from_date);
                   // $this->db->where('student_subject_attendances.date <=', $to_date);
            $this->db->group_by('subjects.code, subjects.name');
            $q = $this->db->get();
            return $q->result_array();
            }
            
            
                
                
                
                
          /*  public function studentAttendanceByDateReport($class_id, $section_id, $session_id, $from_date, $to_date, $student_session_id)
            {
            // Check if there are any records within the date range
            $this->db->from('subject_timetable');
            $this->db->where("DATE(from_time) BETWEEN '$from_date' AND '$to_date'");
            $this->db->or_where("DATE(to_time) BETWEEN '$from_date' AND '$to_date'");
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
            // Calculate the total number of periods within the date range
            $this->db->select('COUNT(DISTINCT period_id) as total_periods');
            $this->db->from('subject_timetable');
            $this->db->where("DATE(from_time) BETWEEN '$from_date' AND '$to_date'");
            $this->db->where("DATE(to_time) BETWEEN '$from_date' AND '$to_date'");
            $query = $this->db->get();
            
            $result = $query->row_array();
            $total_periods = $result['total_periods'];
            
            echo "Total periods between $from_date and $to_date: $total_periods";
            } else {
            echo "No records found for the specified date range.";
            }
            
            // Original query for student attendance report
            $this->db->select('
            subjects.code, 
            subjects.name, 
            COUNT(student_subject_attendances.id) as total,
            SUM(CASE WHEN student_subject_attendances.attendence_type_id = 1 THEN 1 ELSE 0 END) as total_present,
            SUM(CASE WHEN student_subject_attendances.attendence_type_id = 5 THEN 1 ELSE 0 END) as total_absent
            ');
            $this->db->from('subject_timetable');
            $this->db->join('subject_group_subjects', 'subject_group_subjects.id = subject_timetable.subject_group_subject_id');
            $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
            $this->db->join('student_subject_attendances', 'student_subject_attendances.subject_timetable_id = subject_timetable.id');
            $this->db->where('subject_timetable.class_id', $class_id);
            $this->db->where('subject_timetable.section_id', $section_id);
            $this->db->where('subject_timetable.session_id', $session_id);
            $this->db->where('student_subject_attendances.student_session_id', $student_session_id);
            $this->db->where('student_subject_attendances.date >=', $from_date);
            $this->db->where('student_subject_attendances.date <=', $to_date);
            $this->db->group_by('subjects.code, subjects.name');
            
            $q = $this->db->get();
            return $q->result_array();
            }
            
            */
            
            
            
            
            public function getStudentsMontlyAttendence($class_id, $section_id, $from_date, $to_date, $year, $month_number)
            {
            
            $student_array                   = array();
            $student_array['class_students'] = $this->student_model->searchByClassSectionWithSession($class_id, $section_id);
            
            $student_array['students_attendances'] = array();
            for ($i = 1; $i <= $to_date; $i++) {
            
            $date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);
            
            $day = date('l', strtotime($date));
            
            $students_time_table = $this->searchByStudentsAttendanceByDate($class_id, $section_id, $day, $date);
            
            $a             = array();
            $a['date']     = $date;
            $a['day']      = $day;
            $a['subjects'] = array();
            $a['students'] = array();
            
            if (!empty($students_time_table)) {
            $students_time_table = json_decode($students_time_table);
            
            $a['subjects'] = ($students_time_table->subjects);
            foreach ($students_time_table->student_record as $students_time_table_key => $students_time_table_value) {
            $a['students'][$students_time_table_value->id] = ($students_time_table->student_record[$students_time_table_key]);
            }
            }
            $student_array['students_attendances'][$i] = $a;
            }
            
            return $student_array;
            }
            
            
            
            
            public function searchByStudentsAttendanceByDate_dayval($class_id, $section_id, $day, $date)
            {
            $sql      = "SELECT subject_timetable.*,subjects.id as `subject_id`,subjects.name,subjects.code,subjects.type,periodic_table.periodic_table_name,periodic_table.periodic_table_id FROM `subject_timetable` INNER JOIN subject_group_subjects on subject_group_subjects.id=subject_timetable.subject_group_subject_id     LEFT JOIN periodic_table on periodic_table.periodic_table_id=subject_timetable.period_id INNER JOIN subjects on subjects.id=subject_group_subjects.subject_id WHERE subject_timetable.class_id=" . $this->db->escape($class_id) . " AND subject_timetable.section_id=" . $this->db->escape($section_id) . " and subject_timetable.session_id=" . $this->db->escape($this->current_session) . " and subject_timetable.day=" . $this->db->escape($day);
            
            $query    = $this->db->query($sql);
            
            $subjects = $query->result();
            
            if (!empty($subjects)) {
            $count        = 1;
            $append_sql   = "";
            $append_param = "";
            foreach ($subjects as $subject_key => $subject_value) {
            $append_param .= ",student_subject_attendances_" . $count . ".attendence_type_id as attendence_type_id_" . $count;
            $append_sql .= " LEFT JOIN student_subject_attendances as student_subject_attendances_" . $count . " on  student_subject_attendances_" . $count . ".student_session_id=student_session.id and student_subject_attendances_" . $count . ".subject_timetable_id=" . $this->db->escape($subject_value->id) . " and student_subject_attendances_" . $count . ".date=" . $this->db->escape($date);
            $count++;
            }
            $sql_student_record = "SELECT students.id,students.firstname,students.middlename,students.lastname,students.admission_no " . $append_param . " FROM `students` INNER JOIN student_session on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " AND student_session.section_id=" . $this->db->escape($section_id) . " AND student_session.session_id=" . $this->db->escape($this->current_session) . $append_sql;
            $query              = $this->db->query($sql_student_record);
            $student_record     = $query->result();
            return json_encode(array('subjects' => $subjects, 'student_record' => $student_record));
            }
            return false;
            }
            
            
            
            
            public function searchByStudentsAttendanceByDate($class_id, $section_id, $day, $date)
            { 
            $sql      = "SELECT subject_timetable.*,subjects.id as `subject_id`,subjects.name,subjects.code,subjects.type,periodic_table.periodic_table_name,periodic_table.periodic_table_id FROM `subject_timetable` INNER JOIN subject_group_subjects on subject_group_subjects.id=subject_timetable.subject_group_subject_id     JOIN periodic_table on periodic_table.periodic_table_id=subject_timetable.period_id INNER JOIN subjects on subjects.id=subject_group_subjects.subject_id WHERE subject_timetable.class_id=" . $this->db->escape($class_id) . " AND subject_timetable.section_id=" . $this->db->escape($section_id) . " and subject_timetable.session_id=" . $this->db->escape($this->current_session) . " and subject_timetable.day=" . $this->db->escape($day);
            
            $query    = $this->db->query($sql);
            
            $subjects = $query->result();
            
            if (!empty($subjects)) {
            $count        = 1;
            $append_sql   = "";
            $append_param = "";
            foreach ($subjects as $subject_key => $subject_value) {
            $append_param .= ",student_subject_attendances_" . $count . ".attendence_type_id as attendence_type_id_" . $count;
            $append_sql .= " LEFT JOIN student_subject_attendances as student_subject_attendances_" . $count . " on  student_subject_attendances_" . $count . ".student_session_id=student_session.id and student_subject_attendances_" . $count . ".subject_timetable_id=" . $this->db->escape($subject_value->id) . " and student_subject_attendances_" . $count . ".date=" . $this->db->escape($date);
            $count++;
            }
            
            $sql_student_record = "SELECT students.id,students.firstname,students.middlename,students.lastname,students.admission_no " . $append_param . " FROM `students` INNER JOIN student_session on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " AND student_session.section_id=" . $this->db->escape($section_id) . " AND student_session.session_id=" . $this->db->escape($this->current_session) . $append_sql  ;
            $query              = $this->db->query($sql_student_record);
            $student_record     = $query->result();
            return json_encode(array('subjects' => $subjects, 'student_record' => $student_record));
            }
            return false;
            }
            
            
            
            
            public function attendanceYearCount()
            {
            $query = $this->db->select("distinct year(date) as year")->get("student_subject_attendances");
            return $query->result_array();
            }
            
            public function is_biometricAttendence()
            {
            $this->db->select('sch_settings.id,sch_settings.biometric,sch_settings.attendence_type,sch_settings.is_rtl,sch_settings.timezone,
            sch_settings.name,sch_settings.email,sch_settings.biometric,sch_settings.biometric_device,sch_settings.phone,languages.language,
            sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.image,sch_settings.theme,sessions.session'
            );
            
            $this->db->from('sch_settings');
            $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
            $this->db->join('languages', 'languages.id = sch_settings.lang_id');
            $this->db->order_by('sch_settings.id');
            $query  = $this->db->get();
            $result = $query->row();
            
            if ($result->biometric) 
            {
            return true;
            }
            
            return false;
            }
            
            
            public function student_val($class_id, $section_id,$current_session)
            {
            $this->db->select('*');
            $this->db->from('students');
            $this->db->join('student_session','student_session.student_id=students.id');
            $this->db->where('session_id', $current_session);
            $this->db->where('class_id', $class_id);
            $this->db->where('section_id', $section_id);
            $q 		    = $this->db->get();
            return $q->result_array();
            }
            
            
            public function getStudentsMontlyAttendence_byday($from_date, $to_date, $year, $month_number)
            {
            
            $fdate =    $year.'-'.$month_number.'-'.$from_date;
            $tdate =    $year.'-'.$month_number.'-'.$to_date;
            
            
            $this->db->select('*');
            $this->db->from('student_subject_attendances');
            //$this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
            
            //$this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
            //$this->db->join('periodic_table','periodic_table.periodic_table_id=subject_timetable.period_id');
            
            $this->db->where('student_subject_attendances.date >=', $fdate);
            $this->db->where('student_subject_attendances.date <=', $tdate); 
            $q 		    = $this->db->get();
            return $q->result_array();
            }
            
            
            public function getStudentsMontlyAttendence_dayval($class_id, $section_id, $from_date, $to_date, $year, $month_number)
            {
            $current_session=$this->current_session;
            $this->db->select('students.firstname,student_session.id as sess_id,students.admission_no,students.roll_no,student_session.class_id as classid,student_session.section_id as sectionid');
            $this->db->from ('students');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('sessions', 'sessions.id = student_session.session_id');
            $this->db->join('classes', ' classes.id=student_session.class_id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('classes.id', $class_id);
            $this->db->where('sections.id', $section_id);
            $this->db->where(array('student_session.session_id'=> $current_session));
            $this->db->where(array('students.dis_reason'=> 0));
            $q 		    = $this->db->get();
            return $q->result_array();
            }
           
            
            
            
            public function getclass($class_id)
            {
            $this->db->select('*');
            $this->db->from('classes');
            $this->db->where('id', $class_id);
            $q 		    = $this->db->get();
            return $q->row_array();
            } 
            
            
            public function getsection($section_id)
            {
            $this->db->select('*');
            $this->db->from('sections');
            $this->db->where(array('id'=> $section_id));
            $q 		    = $this->db->get();
            return $q->row_array();
            } 
            
            
            public function report_testday($class_id, $section_id)
            {
            $this->db->select('students.first*,student_session.id as sess_id');
            $this->db->from('students');
            $this->db->join('student_session','student_session.student_id=students.id');
            $this->db->where(array('class_id'=> $class_id));
            $this->db->where(array('section_id'=> $section_id));
            $q 		    = $this->db->get();
            return $q->result_array();
            }
            
            
            public function periodval()
            {
            $this->db->select('*');
            $this->db->from('periodic_table');
            $this->db->order_by('periodic_table_id');
            $this->db->group_by('periodic_table_id');
            $q 		    = $this->db->get();
            return $q->result_array();  
            }
            
            public function getStudentsMontlyAttendence_attendence($class_id, $section_id, $from_date, $to_date, $year, $month_number)
            {
            $fdate =    $year.'-'.$month_number.'-'.$from_date;
            $tdate =    $year.'-'.$month_number.'-'.$to_date;
            $this->db->select('*');
            $this->db->from('student_subject_attendances');
            $this->db->join('subject_timetable','subject_timetable.id=student_subject_attendances.subject_timetable_id');
            $this->db->where('student_subject_attendances.date >=', $fdate);
            $this->db->where('student_subject_attendances.date <=', $tdate);
            $q 		    = $this->db->get();
            return $q->result_array(); 
            }
            
            
            public function get_leavemanagement($class_id, $section_id, $from_date, $to_date,$month_number,$year)
            {
            $fdate =    $year.'-'.$month_number.'-'.$from_date;
            $tdate =    $year.'-'.$month_number.'-'.$to_date;
            $sql="SELECT count(*) as t FROM leave_catmanagement WHERE  leave_catmanagement_class= '".$class_id."'  and leave_catmanagement_section= '".$section_id."' and leave_catmanagement_session='".$this->current_session."'  and    `leave_catmanagement_date` BETWEEN '".$fdate."' AND '".$tdate."' ";
            $q=$this->db->query($sql);
            return $q->row_array();
            }
            
            
            
            
            public function get_leavemanagement_leaves($class_id, $section_id, $from_date, $to_date,$month_number,$year)
            {
            $fdate =    $year.'-'.$month_number.'-'.$from_date;
            $tdate =    $year.'-'.$month_number.'-'.$to_date;
            $sql="SELECT * FROM leave_catmanagement WHERE  leave_catmanagement_class= '".$class_id."'  and leave_catmanagement_section= '".$section_id."' and leave_catmanagement_session='".$this->current_session."'  and    `leave_catmanagement_date` BETWEEN '".$fdate."' AND '".$tdate."' ";
            $q=$this->db->query($sql);
            return $q->result_array();
            }
            
            
            public function get_periodcount()
            {
            $this->db->select('count(*) as pcount');
            $this->db->from('periodic_table');
            $this->db->where('periodic_table_count','Yes');
            $q=$this->db->get();
            return $q->row_array();
            }
            
           
            public function get_leave_category()
            {
            $this->db->select('*');
            $this->db->from('leave_category');
            $this->db->where('leave_category_status',1);
            $q=$this->db->get();
            return $q->result_array();
            }
            
            
            public function get_totaltimetabledays($class_id,$section_id)
            {
            $this->db->select('COUNT(*) as count, day');
            $this->db->from('subject_timetable');
            $this->db->where(array('class_id'=>$class_id,'section_id'=>$section_id,'session_id'=>$this->current_session));
            $this->db->group_by('day');
            $q=$this->db->get();
            return $q->result_array();
            } 
            
            
            
            ///////Betweeen date 
            
            
            public function getStudentsMontlyAttendence_bt_date($class_id, $section_id,$from_date,$to_date)
            {
            $current_session = $this->current_session;
            $this->db->select('students.firstname, students.middlename, students.lastname, students.admission_no, students.roll_no, student_session.id as sess_id');
            $this->db->from('students');
            $this->db->join('student_session', 'student_session.student_id = students.id', 'left');
            $this->db->join('student_subject_attendances', 'student_subject_attendances.student_session_id = student_session.id', 'left');
            $this->db->join('subject_timetable', 'subject_timetable.id = student_subject_attendances.subject_timetable_id', 'left');
            $this->db->join('subject_group_subjects', 'subject_group_subjects.id = subject_timetable.subject_group_subject_id', 'left');
            $this->db->join('sessions', 'sessions.id = student_session.session_id', 'left');
            $this->db->join('classes', 'classes.id = student_session.class_id', 'left');
            $this->db->join('sections', 'sections.id = student_session.section_id', 'left');
            $this->db->where('classes.id', $class_id);
            $this->db->where('sections.id', $section_id);
            $this->db->where('student_session.session_id', $current_session);
            $this->db->where('students.dis_reason', 0);
            $this->db->where("(student_subject_attendances.date IS NULL OR DATE_FORMAT(student_subject_attendances.date, '%Y-%m-%d') >= '$from_date')");
            $this->db->where("(student_subject_attendances.date IS NULL OR DATE_FORMAT(student_subject_attendances.date, '%Y-%m-%d') <= '$to_date')");
            $this->db->group_by('student_session.id');
            $query = $this->db->get();
            return $query->result_array();
            }
            
            
            
            
            public function get_workingdaysbydate($class_id, $section_id,$from_date,$to_date)
            {
            $current_session = $this->current_session;
            $this->db->select('COUNT(DISTINCT student_subject_attendances.date) as total_working');
            $this->db->from('student_subject_attendances');
            $this->db->join('subject_timetable', 'subject_timetable.id=student_subject_attendances.subject_timetable_id', 'left');
            $this->db->where('attendence_type_id !=', '4');
            $this->db->where('subject_timetable.session_id', $current_session);
            $this->db->where("(student_subject_attendances.date IS NULL OR DATE_FORMAT(student_subject_attendances.date, '%Y-%m-%d') >= '$from_date')");
            $this->db->where("(student_subject_attendances.date IS NULL OR DATE_FORMAT(student_subject_attendances.date, '%Y-%m-%d') <= '$to_date')");
            $this->db->where('subject_timetable.class_id', $class_id);
            $this->db->where('subject_timetable.section_id', $section_id);
            $query = $this->db->get();
            return $query->row_array();
            }
            
            
            
            public function get_totalholidaysbydate($class_id, $section_id,$from_date,$to_date)
            {
            $current_session = $this->current_session;
            $this->db->select('COUNT(DISTINCT student_subject_attendances.date) as total_holidays');
            $this->db->from('student_subject_attendances');
            $this->db->join('subject_timetable', 'subject_timetable.id=student_subject_attendances.subject_timetable_id', 'left');
            $this->db->where('attendence_type_id !=', '4');
            $this->db->where('subject_timetable.session_id', $current_session);
            $this->db->where("(student_subject_attendances.date IS NULL OR DATE_FORMAT(student_subject_attendances.date, '%Y-%m-%d') >= '$from_date')");
            $this->db->where("(student_subject_attendances.date IS NULL OR DATE_FORMAT(student_subject_attendances.date, '%Y-%m-%d') <= '$to_date')");
            $this->db->where('subject_timetable.class_id', $class_id);
            $this->db->where('subject_timetable.section_id', $section_id);
            $query = $this->db->get();
            return $query->row_array();
            }
           
           
            public function get_timetable_count($class_id, $section_id)
            {
            $current_session = $this->current_session;
            $this->db->select('day, COUNT(*) as dayscount');
            $this->db->from('subject_timetable');
            $this->db->where('class_id', $class_id);
            $this->db->where('section_id', $section_id);
            $this->db->where('session_id', $current_session);
            $this->db->group_by('day');
            $query = $this->db->get();
            return $query->result_array();
            }
        
        
            public function get_leavemanagement_leaves_bydate($class_id, $section_id, $from_date, $to_date)
            {
            $sql="SELECT * FROM leave_catmanagement WHERE  leave_catmanagement_class= '".$class_id."'  and leave_catmanagement_section= '".$section_id."' and leave_catmanagement_session='".$this->current_session."'  and    `leave_catmanagement_date` BETWEEN '".$from_date."' AND '".$to_date."' ";
            $q=$this->db->query($sql);
            return $q->result_array();
            }
            
            
            
            
            public function get_leavemanagement_bydate($class_id, $section_id, $from_date, $to_date)
            {
            $sql="SELECT count(*) as t FROM leave_catmanagement WHERE  leave_catmanagement_class= '".$class_id."'  and leave_catmanagement_section= '".$section_id."' and leave_catmanagement_session='".$this->current_session."'  and    `leave_catmanagement_date` BETWEEN '".$from_date."' AND '".$to_date."' ";
            $q=$this->db->query($sql);
            return $q->row_array();
            }
            
            
            
           }
