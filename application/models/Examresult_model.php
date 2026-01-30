                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }

                class Examresult_model extends CI_Model {

                public function __construct() {
                parent::__construct();
                $this->current_session = $this->setting_model->getCurrentSession();
                }

                /**
                * This funtion takes id as a parameter and will fetch the record.
                * If id is not provided, then it will fetch all the records form the table.
                * @param int $id
                * @return mixed
                */
                public function get($id = null) {
                $this->db->select()->from('exam_results');
                if ($id != null) {
                $this->db->where('id', $id);
                } else {
                $this->db->order_by('id');
                }
                $query = $this->db->get();
                if ($id != null) {
                return $query->row_array();
                } else {
                return $query->result_array();
                }
                }

                /**
                * This function will delete the record based on the id
                * @param $id
                */
                public function remove($id) {
                $this->db->where('id', $id);
                $this->db->delete('exam_results');
                }

                /**
                * This function will take the post data passed from the controller
                * If id is present, then it will do an update
                * else an insert. One function doing both add and edit.
                * @param $data
                */
                public function add($data) {
                if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('exam_results', $data);
                } else {
                $this->db->insert('exam_results', $data);
                return $this->db->insert_id();
                }
                }

                public function add_exam_result($data) {
                $this->db->where('exam_schedule_id', $data['exam_schedule_id']);
                $this->db->where('student_id', $data['student_id']);
                $q = $this->db->get('exam_results');
                $result = $q->row();
                if ($q->num_rows() > 0) {
                $this->db->where('id', $result->id);
                $this->db->update('exam_results', $data);
                if ($result->get_marks != $data['get_marks']) {
                return $result->id;
                }
                } else {
                $this->db->insert('exam_results', $data);
                $insert_id = $this->db->insert_id();
                return $insert_id;
                }
                return false;
                }

                public function get_exam_result($exam_schedule_id = null, $student_id = null) {
                $this->db->select()->from('exam_results');
                $this->db->where('exam_schedule_id', $exam_schedule_id);
                $this->db->where('student_id', $student_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                return $query->row();
                } else {
                $obj = new stdClass();
                $obj->attendence = 'pre';
                $obj->get_marks = "0.00";
                return $obj;
                }
                }

                public function get_result($exam_schedule_id = null, $student_id = null) {
                $this->db->select()->from('exam_results');
                $this->db->where('exam_schedule_id', $exam_schedule_id);
                $this->db->where('student_id', $student_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                return $query->row();
                } else {

                }
                }

                public function checkexamresultpreparebyexam($exam_id, $class_id, $section_id) {
                $query = $this->db->query("SELECT count(*) `counter` FROM `exam_results`,exam_schedules,student_session WHERE exam_results.exam_schedule_id=exam_schedules.id and student_session.student_id=exam_results.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session) . " and exam_schedules.exam_id=" . $this->db->escape($exam_id));
                if ($query->num_rows() > 0) {
                return true;
                } else {
                return false;
                }
                return $query->result_array();
                }

                public function getStudentExamResultByStudent($exam_id, $student_id, $exam_schedule) {
                $sql = "SELECT exam_schedules.id as `exam_schedules_id`,exam_results.id as `exam_results_id`,exam_schedules.exam_id,exam_schedules.date_of_exam,exam_schedules.full_marks,exam_schedules.passing_marks,exam_results.student_id,exam_results.get_marks,students.firstname,students.middlename,students.lastname,students.guardian_phone,students.email ,exams.name as `exam_name` FROM `exam_schedules` INNER JOIN exams on exams.id=exam_schedules.exam_id INNER JOIN exam_results ON exam_results.exam_schedule_id=exam_schedules.id INNER JOIN students on students.id=exam_results.student_id WHERE exam_schedules.session_id =" . $this->db->escape($this->current_session) . " and exam_schedules.exam_id =" . $this->db->escape($exam_id) . " and exam_results.student_id =" . $this->db->escape($student_id) . " and exam_schedules.id in (" . $exam_schedule . ") ORDER BY `exam_results`.`id` ASC";

                $query = $this->db->query($sql);
                return $query->result_array();
                }



                public function getExamResults($exam_id, $post_exam_group_id, $students)
                {
                $result = array('exam_connection' => 0, 'students' => array(), 'exams' => array(), 'exam_connection_list' => array());
                $exam_connection = false;
                $exam_connections = $this->examgroup_model->getExamGroupConnectionList($post_exam_group_id);

                if (!empty($exam_connections)) {
                $lastkey = key(array_slice($exam_connections, -1, 1, true));
                if ($exam_connections[$lastkey]->exam_group_class_batch_exams_id == $exam_id) {
                $exam_connection = true;
                $result['exam_connection'] = 1;
                }
                }        

                $result['exam_connection_list'] = $exam_connections;

                foreach ($students as $student_key => $student_value) {

                $student = $this->examstudent_model->getExamStudentByID($student_value);

                $student['exam_result'] = array();
                if ($exam_connection) {
                foreach ($exam_connections as $exam_connection_key => $exam_connection_value) {
                $exam_group_class_batch_exam_student = $this->examstudent_model->getStudentByExamAndStudentID($student_value, $exam_connection_value->exam_group_class_batch_exams_id);

                $exam = $this->examgroup_model->getExamByID($exam_connection_value->exam_group_class_batch_exams_id);

                $student['exam_result']['exam_roll_no_' . $exam_connection_value->exam_group_class_batch_exams_id] =  $student['roll_no'];


                // $student['exam_result']['exam_result_' . $exam_connection_value->exam_group_class_batch_exams_id] =$this->getStudentResultByExam($exam_id, $student['id']);
                $student['exam_result']['exam_result_' . $exam_connection_value->exam_group_class_batch_exams_id] =$this->loadStudentResultByExam($exam_id, $student['id']);


                $result['exams']['exam_' . $exam_connection_value->exam_group_class_batch_exams_id] = $exam;
                }
                $result['students'][] = $student;
                } else {                
                $student['exam_roll_no'] = $student['roll_no'];
                // $student['exam_result'] = $this->getStudentResultByExam($exam_id, $student['id']);
                $student['exam_result'] = $this->loadStudentResultByExam($exam_id, $student['id']);

                $result['students'][] = $student;
                }
                }
                return $result;
                }






                public function getStudentResultByExam($exam_id, $student_id)
                {

                //  $sql = "SELECT subjectpaper.*,exam_group_class_batch_exam_subjects.*,exam_group_exam_results.id as `exam_group_exam_results_id`,exam_group_exam_results.exam_group_class_batch_exam_student_id as `exam_group_exam_results_stud_id`,exam_group_exam_results.exam_group_class_batch_exam_subject_id as `exam_group_exam_results_subject_id`,exam_group_exam_results.attendence,exam_group_exam_results.exam_group_class_batch_exam_subject_id,exam_group_exam_results.get_marks,exam_group_exam_results.get_cmarks,exam_group_exam_results.note,subjects.name,subjects.code FROM `exam_group_class_batch_exam_subjects` inner JOIN exam_group_exam_results on exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_class_batch_exam_subjects.id INNER JOIN exam_group_class_batch_exam_students on exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_class_batch_exam_students.id and exam_group_class_batch_exam_students.id=" . $this->db->escape($student_id) . " INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id    INNER JOIN subjectpaper 
                //     ON subjectpaper.subjectpaper_subjectid = subjects.id  AND subjectpaper.subjectpaper_session = $this->current_session WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_id);

                // $sql = "SELECT exam_group_class_batch_exam_subjects.*,exam_group_exam_results.id as `exam_group_exam_results_id`,exam_group_exam_results.exam_group_class_batch_exam_student_id as `exam_group_exam_results_stud_id`,exam_group_exam_results.exam_group_class_batch_exam_subject_id as `exam_group_exam_results_subject_id`,exam_group_exam_results.attendence,exam_group_exam_results.exam_group_class_batch_exam_subject_id,exam_group_exam_results.get_marks,exam_group_exam_results.get_cmarks,exam_group_exam_results.note,subjects.name,subjects.code FROM `exam_group_class_batch_exam_subjects` inner JOIN exam_group_exam_results on exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_class_batch_exam_subjects.id INNER JOIN exam_group_class_batch_exam_students on exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_class_batch_exam_students.id and exam_group_class_batch_exam_students.id=" . $this->db->escape($student_id) . " INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id     
                // WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_id);
                // $query = $this->db->query($sql);
                // return $query->result();


                $sql = "SELECT exam_group_class_batch_exam_subjects.*,exam_group_class_batch_exams.*,exam_group_exam_results.id as `exam_group_exam_results_id`,exam_group_exam_results.exam_group_class_batch_exam_student_id as `exam_group_exam_results_stud_id`,exam_group_exam_results.exam_group_class_batch_exam_subject_id as `exam_group_exam_results_subject_id`,exam_group_exam_results.attendence,exam_group_exam_results.exam_group_class_batch_exam_subject_id,exam_group_exam_results.get_marks,exam_group_exam_results.get_cmarks,exam_group_exam_results.note,exam_group_exam_results.rsi_mode,subjects.name,subjects.code FROM `exam_group_class_batch_exam_subjects` inner JOIN exam_group_exam_results on exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_class_batch_exam_subjects.id INNER JOIN exam_group_class_batch_exam_students on exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_class_batch_exam_students.id and exam_group_class_batch_exam_students.id=" . $this->db->escape($student_id) . " INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id    

                INNER JOIN exam_group_class_batch_exams 
                ON exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id
                WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_id)." AND exam_group_class_batch_exams.is_publish = 1";
                $query = $this->db->query($sql);
                return $query->result();
                }       



                public function loadStudentResultByExam($exam_id, $student_id)
                {        
                $sql = "SELECT exam_group_class_batch_exam_subjects.*,exam_group_class_batch_exams.*,exam_group_exam_results.id as `exam_group_exam_results_id`,exam_group_exam_results.exam_group_class_batch_exam_student_id as `exam_group_exam_results_stud_id`,exam_group_exam_results.exam_group_class_batch_exam_subject_id as `exam_group_exam_results_subject_id`,exam_group_exam_results.attendence,exam_group_exam_results.exam_group_class_batch_exam_subject_id,exam_group_exam_results.get_marks,exam_group_exam_results.get_cmarks,exam_group_exam_results.note,exam_group_exam_results.rsi_mode,subjects.name,subjects.code FROM `exam_group_class_batch_exam_subjects` inner JOIN exam_group_exam_results on exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_class_batch_exam_subjects.id INNER JOIN exam_group_class_batch_exam_students on exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_class_batch_exam_students.id and exam_group_class_batch_exam_students.id=" . $this->db->escape($student_id) . " INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id    

                INNER JOIN exam_group_class_batch_exams 
                ON exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id
                WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_id)." ";
                $query = $this->db->query($sql);
                return $query->result();
                }


                public function getStudentResultByExam_bysayexam($exam_id, $student_id)
                {
                $sql = "SELECT exam_group_class_batch_exam_subjects.*,exam_group_exam_sayexam.exam_group_exam_sayexam_id as `exam_group_exam_results_id`,exam_group_exam_sayexam.exam_group_exam_sayexam_studentid as `exam_group_exam_results_stud_id`,exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id as `exam_group_exam_results_subject_id`,exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id,exam_group_exam_sayexam.get_marks,exam_group_exam_sayexam.get_cmarks,subjects.name,subjects.code FROM `exam_group_class_batch_exam_subjects` inner JOIN exam_group_exam_sayexam on exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id=exam_group_class_batch_exam_subjects.id INNER JOIN exam_group_class_batch_exam_students on exam_group_exam_sayexam.exam_group_exam_sayexam_studentid=exam_group_class_batch_exam_students.id and exam_group_class_batch_exam_students.id=" . $this->db->escape($student_id) . " INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_id). " 
                AND exam_group_exam_sayexam.exam_attempts = '2' ";

                $query = $this->db->query($sql);
                return $query->result();
                }


                public function getStudentResultByExam_bysayexamte($exam_id, $student_id)
                {
                $sql = "SELECT exam_group_class_batch_exam_subjects.*,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_id as `exam_group_exam_results_id`,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid as `exam_group_exam_results_stud_id`,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id as `exam_group_exam_results_subject_id`,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id,exam_group_exam_sayexam_temarks.get_marks,exam_group_exam_sayexam_temarks.get_cmarks,subjects.name,subjects.code FROM `exam_group_class_batch_exam_subjects` inner JOIN exam_group_exam_sayexam_temarks on exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id=exam_group_class_batch_exam_subjects.id INNER JOIN exam_group_class_batch_exam_students on exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid=exam_group_class_batch_exam_students.id and exam_group_class_batch_exam_students.id=" . $this->db->escape($student_id) . " INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_id) . " 
                AND exam_group_exam_sayexam_temarks.exam_attempts = '2' ";

                $query = $this->db->query($sql);
                return $query->result();
                }




                public function getStudentExamResults($exam_id, $post_exam_group_id, $exam_group_class_batch_exam_student_id, $student_id)
                {
                $result = array('exam_connection' => 0, 'result' => array(), 'exams' => array(), 'exam_connection_list' => array());
                $exam_connection = false;
                $exam_connections = $this->examgroup_model->getExamGroupConnectionList($post_exam_group_id);
                if (!empty($exam_connections)) {
                $lastkey = key(array_slice($exam_connections, -1, 1, true));
                if ($exam_connections[$lastkey]->exam_group_class_batch_exams_id == $exam_id) {
                $exam_connection = true;
                $result['exam_connection'] = 1;
                }
                }
                $result['exam_connection_list'] = $exam_connections;
                if ($exam_connection) {
                $new_array = array(); 

                foreach ($exam_connections as $exam_connection_key => $exam_connection_value) {

                $exam_group_class_batch_exam_student = $this->examstudent_model->getStudentByExamAndStudentID($student_id, $exam_connection_value->exam_group_class_batch_exams_id);

                $exam = $this->examgroup_model->getExamByID($exam_connection_value->exam_group_class_batch_exams_id);
                if(!empty($exam_group_class_batch_exam_student->id)){
                $result['exam_result']['exam_result_' . $exam_connection_value->exam_group_class_batch_exams_id] 
                = $this->getStudentResultByExam($exam_connection_value->exam_group_class_batch_exams_id, $exam_group_class_batch_exam_student->id);
                }
                $result['exams']['exam_' . $exam_connection_value->exam_group_class_batch_exams_id] = $exam;
                }

                } else {

                $result['exam_connection_list'] = $exam_connections;

                $result['result'] = $this->getStudentResultByExam($exam_id, $exam_group_class_batch_exam_student_id);
                }

                return $result;
                }





                public function getrevaluation_subjectfor_teachers_1($post_exam_id, $post_exam_group_id, $students_array)
                {
                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_revaluation.exam_group_exam_revaluation_id as exam_group_exam_revaluation_id,exam_group_exam_results.id as resultid');

                $this->db->from('exam_group_exam_revaluation');
                $this->db->join('students', 'students.id  = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_revaluation.exam_group_exam_revaluation_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');

                $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid',  $students_array);

                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid',  $post_exam_id);


                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }


                public function getrevaluation_subjectfor_teachers2($post_exam_id, $post_exam_group_id, $class_id, $section_id,$session_id)
                {
                $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_revaluation.exam_group_exam_revaluation_id as exam_group_exam_revaluation_id,exam_group_exam_results.id as resultid,exam_group_exam_revaluation.exam_group_exam_revaluation_examid as exam_group_exam_revaluation_examid,exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid as exam_group_exam_revaluation_examgroupid,exam_group_exam_revaluation.exam_group_exam_revaluation_studentid as exam_group_exam_revaluation_studentid');
                $this->db->from('exam_group_exam_revaluation');
                $this->db->join('students', 'students.id  = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_revaluation.exam_group_exam_revaluation_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid',  $post_exam_group_id);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid',  $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $query=$this->db->get();
                return $query->result_array();
                }




                // public function getrevaluation_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id, $session_id)
                // {
                // $this->db->select('
                // *,
                // students.id as Studentid,
                // subjects.code as code,
                // subjects.name as name,
                // exam_group_exam_results.get_cmarks as get_cmarks,
                // exam_group_exam_results.get_marks as get_marks,
                // exam_group_class_batch_exam_subjects.max_marks as max_marks,
                // exam_group_class_batch_exam_subjects.min_marks as min_marks,
                // exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,
                // exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,
                // exam_group_exam_revaluation.exam_group_exam_revaluation_id as exam_group_exam_revaluation_id,
                // exam_group_exam_results.id as resultid,
                // exam_group_exam_revaluation.exam_group_exam_revaluation_examid as exam_group_exam_revaluation_examid,
                // exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid as exam_group_exam_revaluation_examgroupid,
                // exam_group_exam_revaluation.exam_group_exam_revaluation_studentid as exam_group_exam_revaluation_studentid,
                // fees_revaluationpayment.fees_revaluationpayment_statuscode as payment_statuscode
                // ');

                // $this->db->from('exam_group_exam_revaluation');
                // $this->db->join('students', 'students.id = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                // $this->db->join('student_session', 'student_session.student_id = students.id');
                // $this->db->join('classes', 'classes.id = student_session.class_id');
                // $this->db->join('sections', 'sections.id = student_session.section_id');
                // $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_revaluation.exam_group_exam_revaluation_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');
                // $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                // $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');

                // // Join with fees_revaluationpayment table
                // $this->db->join('fees_revaluationpayment', 
                // 'fees_revaluationpayment.fees_revaluationpayment_examgroup =exam_group_exam_revaluation.exam_group_exam_revaluation_examid          
                // AND fees_revaluationpayment.fees_revaluationpayment_examgroupbatch =exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid  
                // AND fees_revaluationpayment.fees_revaluationpayment_class_id = student_session.class_id 
                // AND fees_revaluationpayment.fees_revaluationpayment_section_id = student_session.section_id 
                // AND fees_revaluationpayment.fees_revaluationpayment_session_id = student_session.session_id 
                // AND fees_revaluationpayment.fees_revaluationpayment_student_id = students.id',
                // 'left'
                // );
                // $this->db->where('student_session.session_id', $this->current_session);
                // $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid', $post_exam_group_id);
                // $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid', $post_exam_id);
                // $this->db->where('student_session.class_id', $class_id);
                // $this->db->where('student_session.section_id', $section_id);
                // $this->db->where('student_session.session_id', $session_id);
                // $this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                // $query = $this->db->get();
                // return $query->result_array();
                // }



                public function getrevaluation_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id, $session_id)
                {
                $this->db->select('
                exam_group_exam_revaluation.*,
                students.*,
                subjects.*,
                exam_group_exam_results.*,
                exam_group_class_batch_exam_subjects.*,
                fees_revaluationpayment.*,students.id as Studentid,
                MAX(CASE WHEN fees_revaluationpayment.fees_revaluationpayment_statuscode = "S" THEN 1 ELSE 0 END) as payment_success_flag
                ');
                $this->db->from('exam_group_exam_revaluation');
                $this->db->join('students', 'students.id = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id = student_session.class_id');
                $this->db->join('sections', 'sections.id = student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_revaluation.exam_group_exam_revaluation_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
                $this->db->join('fees_revaluationpayment', 
                'fees_revaluationpayment.fees_revaluationpayment_examgroup =exam_group_exam_revaluation.exam_group_exam_revaluation_examid          
                AND fees_revaluationpayment.fees_revaluationpayment_examgroupbatch =exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid  
                AND fees_revaluationpayment.fees_revaluationpayment_class_id = student_session.class_id 
                AND fees_revaluationpayment.fees_revaluationpayment_section_id = student_session.section_id 
                AND fees_revaluationpayment.fees_revaluationpayment_session_id = student_session.session_id 
                AND fees_revaluationpayment.fees_revaluationpayment_student_id = students.id',
                'left'
                );
                $this->db->where('student_session.session_id', $this->current_session);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid', $post_exam_group_id);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid', $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $query = $this->db->get();
                return $query->result_array();
                }




                public function getrevaluation_subjectfor_Marks($post_exam_id, $post_exam_group_id,$students_array)
                {
                $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_revaluation.exam_group_exam_revaluation_id as exam_group_exam_revaluation_id,exam_group_exam_results.id as resultid,exam_group_exam_revaluation.exam_group_exam_revaluation_examid as exam_group_exam_revaluation_examid,exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid as exam_group_exam_revaluation_examgroupid,exam_group_exam_revaluation.exam_group_exam_revaluation_studentid as exam_group_exam_revaluation_studentid');

                $this->db->from('exam_group_exam_revaluation');
                $this->db->join('students', 'students.id  = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_revaluation.exam_group_exam_revaluation_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid',  $post_exam_group_id);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid',  $post_exam_id);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid',  $students_array);
                $query=$this->db->get();
                return $query->result_array();
                }


                public function getrevluation_marks($post_exam_id, $post_exam_group_id,$student_id)
                {

                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_revaluation.exam_group_exam_revaluation_id as exam_group_exam_revaluation_id,exam_group_exam_results.id as resultid,exam_group_exam_revaluation.get_marks as gtmark,exam_group_exam_revaluation.get_cmarks as gtcmark');

                $this->db->from('exam_group_exam_revaluation');
                $this->db->join('students', 'students.id  = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_revaluation.exam_group_exam_revaluation_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid',  $student_id);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid',  $post_exam_group_id);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid',  $post_exam_id);
                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }


                public function getgroup_name($exam_id, $post_exam_group_id)
                {
                $this->db->select('*');
                $this->db->from('exam_groups');
                $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id  = exam_groups.id');
                $this->db->where('exam_group_class_batch_exams.exam_group_id',$post_exam_group_id);
                $this->db->where('exam_group_class_batch_exams.id',$exam_id);
                $this->db->where('exam_group_class_batch_exams.is_active',1  );
                $query=$this->db->get();
                return $query->row_array();
                }


                public function revaluation_approved_status($post_exam_id, $post_exam_group_id, $students_array)
                {
                $this->db->select('*');
                $this->db->from('exam_group_exam_revaluation');
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid',$post_exam_id  );
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid',$post_exam_group_id );
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid',$students_array);
                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_status',1  );
                $this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid');
                $query=$this->db->get();
                return $query->row_array();
                }


                public function getsayexam_subjectfor_teachers1($post_exam_id, $post_exam_group_id, $class_id, $section_id,$session_id)
                {
                $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam.exam_group_exam_sayexam_examid as exam_group_exam_sayexam_examid,exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid as exam_group_exam_sayexam_examgroupid,exam_group_exam_sayexam.exam_group_exam_sayexam_studentid as exam_group_exam_sayexam_studentid');
                $this->db->from('exam_group_exam_sayexam');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid',  $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $query=$this->db->get();
                return $query->result_array();
                }


                // public function getsayexam_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id,$session_id)
                // {
                // $this->db->select('
                // *,
                // students.id as Studentid,
                // subjects.code as code,
                // subjects.name as name,
                // exam_group_exam_results.get_cmarks as get_cmarks,
                // exam_group_exam_results.get_marks as get_marks,
                // exam_group_class_batch_exam_subjects.max_marks as max_marks,
                // exam_group_class_batch_exam_subjects.min_marks as min_marks,
                // exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,
                // exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,
                // exam_group_exam_sayexam.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,
                // exam_group_exam_results.id as resultid,
                // exam_group_exam_sayexam.exam_group_exam_sayexam_examid as exam_group_exam_sayexam_examid,
                // exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid as exam_group_exam_sayexam_examgroupid,
                // exam_group_exam_sayexam.exam_group_exam_sayexam_studentid as exam_group_exam_sayexam_studentid,
                // fees_sayexampayment.fees_sayexampayment_id as fees_sayexampayment_id,
                // fees_sayexampayment.fees_sayexampayment_student_id as fees_sayexampayment_student_id,
                // fees_sayexampayment.fees_sayexampayment_year as fees_sayexampayment_year,
                // fees_sayexampayment.fees_sayexampayment_amount as fees_sayexampayment_amount,
                // fees_sayexampayment.fees_sayexampayment_id_status as fees_sayexampayment_id_status,
                // fees_sayexampayment.fees_sayexampayment_orderid as fees_sayexampayment_orderid,
                // fees_sayexampayment.fees_sayexampayment_transdate as fees_sayexampayment_transdate,
                // fees_sayexampayment.fees_sayexampayment_statuscode as payment_statuscode ,
                // fees_sayexampayment.fees_sayexampayment_responsecode as fees_sayexampayment_responsecode,
                // fees_sayexampayment.fees_sayexampayment_transaction_no as fees_sayexampayment_transaction_no,
                // fees_sayexampayment.fees_sayexampayment_updated_date as fees_sayexampayment_updated_date,
                // fees_sayexampayment.fees_sayexampayment_rrn as fees_sayexampayment_rrn,
                // fees_sayexampayment.fees_sayexampayment_authzcode as fees_sayexampayment_authzcode,
                // fees_sayexampayment.fees_sayexampayment_examgroup as fees_sayexampayment_examgroup,
                // fees_sayexampayment.fees_sayexampayment_examgroupbatch as fees_sayexampayment_examgroupbatch,
                // fees_sayexampayment.fees_sayexampayment_class_id as fees_sayexampayment_class_id,
                // fees_sayexampayment.fees_sayexampayment_section_id as fees_sayexampayment_section_id,
                // fees_sayexampayment.fees_sayexampayment_session_id as fees_sayexampayment_session_id,
                // fees_sayexampayment.fees_sayexampayment_onlinestatus as fees_sayexampayment_onlinestatus,
                // fees_sayexampayment.fees_sayexampayment_errormsg as fees_sayexampayment_errormsg,
                // fees_sayexampayment.fees_sayexampayment_created_date as fees_sayexampayment_created_date,
                // fees_sayexampayment.sayex_te_term_payment_term as sayex_te_term_payment_term,
                // fees_sayexampayment.sayex_te_term_payment_status as sayex_te_term_payment_status,
                // fees_sayexampayment.fees_sayexampayment_notes as fees_sayexampayment_notes
                // ');

                // $this->db->from('exam_group_exam_sayexam');
                // $this->db->join('students', 'students.id  = exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                // $this->db->join('student_session', 'student_session.student_id = students.id');
                // $this->db->join('classes', 'classes.id=student_session.class_id');
                // $this->db->join('sections', 'sections.id=student_session.section_id');
                // $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id');
                // $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                // $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');

                // // Join with fees_sayexampayment table
                // $this->db->join('fees_sayexampayment', 
                // 'fees_sayexampayment.fees_sayexampayment_examgroup = exam_group_exam_sayexam.exam_group_exam_sayexam_examid 
                // AND fees_sayexampayment.fees_sayexampayment_examgroupbatch = exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid
                // AND fees_sayexampayment.fees_sayexampayment_class_id = student_session.class_id 
                // AND fees_sayexampayment.fees_sayexampayment_section_id = student_session.section_id 
                // AND fees_sayexampayment.fees_sayexampayment_session_id = student_session.session_id 
                // AND fees_sayexampayment.fees_sayexampayment_student_id = students.id',
                // 'left'
                // );

                // $this->db->where('student_session.session_id',  $this->current_session);
                // $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);
                // $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid',  $post_exam_id);
                // $this->db->where('student_session.class_id', $class_id);
                // $this->db->where('student_session.section_id', $section_id);
                // $this->db->where('student_session.session_id', $session_id);
                // $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                // $query = $this->db->get();
                // return $query->result_array();
                // }



                public function getsayexam_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id, $session_id)
                {
                $this->db->select('
                exam_group_exam_sayexam.*,
                students.*,
                subjects.*,
                exam_group_exam_results.*,
                exam_group_class_batch_exam_subjects.*,
                fees_sayexampayment.*,students.id as Studentid,
                MAX(CASE WHEN fees_sayexampayment.fees_sayexampayment_statuscode = "S" THEN 1 ELSE 0 END) as payment_success_flag
                ');
                $this->db->from('exam_group_exam_sayexam');
                $this->db->join('students', 'students.id = exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id = student_session.class_id');
                $this->db->join('sections', 'sections.id = student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_sayexam.exam_group_exam_sayexam_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
                $this->db->join('fees_sayexampayment', 
                'fees_sayexampayment.fees_sayexampayment_examgroup = exam_group_exam_sayexam.exam_group_exam_sayexam_examid
                AND fees_sayexampayment.fees_sayexampayment_examgroupbatch = exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid
                AND fees_sayexampayment.fees_sayexampayment_class_id = student_session.class_id
                AND fees_sayexampayment.fees_sayexampayment_section_id = student_session.section_id
                AND fees_sayexampayment.fees_sayexampayment_session_id = student_session.session_id
                AND fees_sayexampayment.fees_sayexampayment_student_id = students.id',
                'left'
                );
                $this->db->where('student_session.session_id', $this->current_session);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid', $post_exam_group_id);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid', $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $query = $this->db->get();
                return $query->result_array();
                }



                public function getsayexamte_subjectfor_teachers1($post_exam_id, $post_exam_group_id, $class_id, $section_id,$session_id)
                {
                $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid as exam_group_exam_sayexam_examid,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid as exam_group_exam_sayexam_examgroupid,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid as exam_group_exam_sayexam_studentid');

                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');



                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');

                $this->db->where('student_session.session_id',  $this->current_session);


                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid',  $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $query=$this->db->get();
                return $query->result_array();
                }



                // public function getsayexamte_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id, $session_id)
                // {
                // $this->db->select('
                // *,
                // students.id as Studentid,
                // subjects.code as code,
                // subjects.name as name,
                // exam_group_exam_results.get_cmarks as get_cmarks,
                // exam_group_exam_results.get_marks as get_marks,
                // exam_group_class_batch_exam_subjects.max_marks as max_marks,
                // exam_group_class_batch_exam_subjects.min_marks as min_marks,
                // exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,
                // exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,
                // exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,
                // exam_group_exam_results.id as resultid,
                // exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid as exam_group_exam_sayexam_examid,
                // exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid as exam_group_exam_sayexam_examgroupid,
                // exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid as exam_group_exam_sayexam_studentid,
                // fees_sayexampayment_temarks.fees_sayexampayment_id,
                // fees_sayexampayment_temarks.fees_sayexampayment_student_id,
                // fees_sayexampayment_temarks.fees_sayexampayment_year,
                // fees_sayexampayment_temarks.fees_sayexampayment_amount,
                // fees_sayexampayment_temarks.fees_sayexampayment_id_status,
                // fees_sayexampayment_temarks.fees_sayexampayment_orderid,
                // fees_sayexampayment_temarks.fees_sayexampayment_transdate,
                // fees_sayexampayment_temarks.fees_sayexampayment_statuscode as payment_statuscode,
                // fees_sayexampayment_temarks.fees_sayexampayment_responsecode,
                // fees_sayexampayment_temarks.fees_sayexampayment_transaction_no,
                // fees_sayexampayment_temarks.fees_sayexampayment_updated_date,
                // fees_sayexampayment_temarks.fees_sayexampayment_rrn,
                // fees_sayexampayment_temarks.fees_sayexampayment_authzcode,
                // fees_sayexampayment_temarks.fees_sayexampayment_examgroup,
                // fees_sayexampayment_temarks.fees_sayexampayment_examgroupbatch,
                // fees_sayexampayment_temarks.fees_sayexampayment_class_id,
                // fees_sayexampayment_temarks.fees_sayexampayment_section_id,
                // fees_sayexampayment_temarks.fees_sayexampayment_session_id,
                // fees_sayexampayment_temarks.fees_sayexampayment_onlinestatus,
                // fees_sayexampayment_temarks.fees_sayexampayment_errormsg,
                // fees_sayexampayment_temarks.fees_sayexampayment_created_date,
                // fees_sayexampayment_temarks.sayex_te_term_payment_term,
                // fees_sayexampayment_temarks.sayex_te_term_payment_status,
                // fees_sayexampayment_temarks.fees_sayexampayment_notes
                // ');
                // $this->db->from('exam_group_exam_sayexam_temarks');
                // $this->db->join('students', 'students.id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                // $this->db->join('student_session', 'student_session.student_id = students.id');
                // $this->db->join('classes', 'classes.id = student_session.class_id');
                // $this->db->join('sections', 'sections.id = student_session.section_id');
                // $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');
                // $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                // $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
                // $this->db->join('fees_sayexampayment_temarks', 
                // 'fees_sayexampayment_temarks.fees_sayexampayment_examgroup = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid
                // AND fees_sayexampayment_temarks.fees_sayexampayment_examgroupbatch = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid
                // AND fees_sayexampayment_temarks.fees_sayexampayment_class_id = student_session.class_id
                // AND fees_sayexampayment_temarks.fees_sayexampayment_section_id = student_session.section_id
                // AND fees_sayexampayment_temarks.fees_sayexampayment_session_id = student_session.session_id
                // AND fees_sayexampayment_temarks.fees_sayexampayment_student_id = students.id',
                // 'left'
                // );
                // $this->db->where('student_session.session_id', $this->current_session);
                // $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid', $post_exam_group_id);
                // $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid', $post_exam_id);
                // $this->db->where('student_session.class_id', $class_id);
                // $this->db->where('student_session.section_id', $section_id);
                // $this->db->where('student_session.session_id', $session_id);
                // $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');

                // $query = $this->db->get();
                // return $query->result_array();
                // }



                public function getsayexamte_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id, $session_id)
                {
                $this->db->select('
                exam_group_exam_sayexam_temarks.*,
                students.*,
                subjects.*,
                exam_group_exam_results.*,
                exam_group_class_batch_exam_subjects.*,
                fees_sayexampayment_temarks.*,students.id as Studentid,
                MAX(CASE WHEN fees_sayexampayment_temarks.fees_sayexampayment_statuscode = "S" THEN 1 ELSE 0 END) as payment_success_flag
                ');
                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->join('students', 'students.id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id = student_session.class_id');
                $this->db->join('sections', 'sections.id = student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
                $this->db->join('fees_sayexampayment_temarks', 
                'fees_sayexampayment_temarks.fees_sayexampayment_examgroup = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid
                AND fees_sayexampayment_temarks.fees_sayexampayment_examgroupbatch = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid
                AND fees_sayexampayment_temarks.fees_sayexampayment_class_id = student_session.class_id
                AND fees_sayexampayment_temarks.fees_sayexampayment_section_id = student_session.section_id
                AND fees_sayexampayment_temarks.fees_sayexampayment_session_id = student_session.session_id
                AND fees_sayexampayment_temarks.fees_sayexampayment_student_id = students.id',
                'left'
                );
                $this->db->where('student_session.session_id', $this->current_session);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid', $post_exam_group_id);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid', $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $query = $this->db->get();
                return $query->result_array();
                }








                public function admin_getstudents($post_exam_id, $post_exam_group_id,$students_array)
                {
                $student_details = array();
                if (!empty($students_array)) {
                foreach ($students_array as $student_key => $student_value)
                {
                $student_details[] = $this->admin_getrevluation_marks($post_exam_id, $post_exam_group_id,$student_value);
                }
                }

                return $student_details;

                }

                public function admin_getrevluation_marks($post_exam_id, $post_exam_group_id,$students_array)
                {  

                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_revaluation.exam_group_exam_revaluation_id as exam_group_exam_revaluation_id,exam_group_exam_results.id as resultid,exam_group_exam_revaluation.get_marks as gtmark,exam_group_exam_revaluation.get_cmarks as gtcmark');

                $this->db->from('exam_group_exam_revaluation');
                $this->db->join('students', 'students.id  = exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');

                $this->db->join('sections', 'sections.id=student_session.section_id');

                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');


                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_revaluation.exam_group_exam_revaluation_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_revaluation.exam_group_exam_revaluation_subject_id');



                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');





                $this->db->where('student_session.session_id',  $this->current_session);



                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid',  $students_array);

                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid',  $post_exam_id);


                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }


                public function admin_getsayexamte_marks($post_exam_id, $post_exam_group_id,$students_array)
                {   

                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam_temarks.get_marks as gtmark,exam_group_exam_sayexam_temarks.get_cmarks as gtcmark');

                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');

                $this->db->join('sections', 'sections.id=student_session.section_id');

                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');


                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');



                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');

                $this->db->where('student_session.session_id',  $this->current_session);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid',  $students_array);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid',  $post_exam_id);

                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }




                public function admin_getsayexam_marks($post_exam_id, $post_exam_group_id,$students_array)
                {   

                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam.get_marks as gtmark,exam_group_exam_sayexam.get_cmarks as gtcmark');

                $this->db->from('exam_group_exam_sayexam');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');

                $this->db->join('sections', 'sections.id=student_session.section_id');

                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');

                $this->db->where('student_session.session_id',  $this->current_session);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid',  $students_array);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid',  $post_exam_id);

                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }



                public function admin_get_sayexam_students($post_exam_id, $post_exam_group_id,$students_array)
                {
                $student_details = array();
                if (!empty($students_array)) {
                foreach ($students_array as $student_key => $student_value)
                {
                $student_details[] = $this->admin_getsayexam_marks($post_exam_id, $post_exam_group_id,$student_value);
                }
                }
                return $student_details;
                }


                public function admin_get_sayexamte_students($post_exam_id, $post_exam_group_id,$students_array)
                {
                $student_details = array();
                if (!empty($students_array)) {
                foreach ($students_array as $student_key => $student_value)
                {
                $student_details[] = $this->admin_getsayexamte_marks($post_exam_id, $post_exam_group_id,$student_value);
                }
                }
                return $student_details;
                }

                public function sayexam_approved_status($post_exam_id, $post_exam_group_id, $students_array)
                {  
                $this->db->select('*');
                $this->db->from('exam_group_exam_sayexam');
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid',$post_exam_id  );
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid',$post_exam_group_id );
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_studentid',$students_array);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_status',1  );
                $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_studentid');
                $query=$this->db->get();
                return $query->row_array();
                }

                public function sayexamte_approved_status($post_exam_id, $post_exam_group_id, $students_array)
                {  
                $this->db->select('*');
                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid',$post_exam_id  );
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid',$post_exam_group_id );
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid',$students_array);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_status',1  );
                $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid');
                $query=$this->db->get();
                return $query->row_array();
                }

                public function getsayexam_subjectfor_Marks($post_exam_id, $post_exam_group_id,$students_array)
                {
                $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam.exam_group_exam_sayexam_examid as exam_group_exam_sayexam_examid,exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid as exam_group_exam_sayexam_examgroupid,exam_group_exam_sayexam.exam_group_exam_sayexam_studentid as exam_group_exam_sayexam_studentid');

                $this->db->from('exam_group_exam_sayexam');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');

                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id');

                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                $this->db->where('student_session.session_id',  $this->current_session);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid',  $post_exam_id);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_studentid',  $students_array);


                $query=$this->db->get();
                return $query->result_array();
                }



                public function getsayexamte_subjectfor_Marks($post_exam_id, $post_exam_group_id,$students_array)
                {
                $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid as exam_group_exam_sayexam_examid,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid as exam_group_exam_sayexam_examgroupid,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid as exam_group_exam_sayexam_studentid');

                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');

                $this->db->join('classes', 'classes.id=student_session.class_id');

                $this->db->join('sections', 'sections.id=student_session.section_id');

                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');



                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');

                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');

                $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid',  $post_exam_id);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid',  $students_array);
                $query=$this->db->get();
                return $query->result_array();
                }



                public function getsayexam_marks($post_exam_id, $post_exam_group_id,$student_id)
                {
                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam.get_marks as gtmark,exam_group_exam_sayexam.get_cmarks as gtcmark');

                $this->db->from('exam_group_exam_sayexam');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam.exam_group_exam_sayexam_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                // $this->db->where('student_session.session_id',  $this->current_session);

                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_session_id', $this->current_session);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid',  $student_id);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);
                $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid',  $post_exam_id);
                $this->db->where('exam_group_exam_sayexam.exam_attempts',2);
                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }


                //Attempts  2 (   $this->db->where('exam_attempts',2);............

                public function getsayexam_marks_temarks($post_exam_id, $post_exam_group_id,$student_id)
                {
                $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_id as exam_group_exam_sayexam_id,exam_group_exam_results.id as resultid,exam_group_exam_sayexam_temarks.get_marks as gtmark,exam_group_exam_sayexam_temarks.get_cmarks as gtcmark');
                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->join('students', 'students.id  = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id=student_session.class_id');
                $this->db->join('sections', 'sections.id=student_session.section_id');
                $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');

                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
                // $this->db->where('student_session.session_id',  $this->current_session);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_session_id', $this->current_session);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid',  $student_id);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid',  $post_exam_group_id);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid',  $post_exam_id);

                $this->db->where('exam_group_exam_sayexam_temarks.exam_attempts',2);

                $this->db->group_by('subjects.code');
                $query=$this->db->get();
                return $query->result_array();
                }



                public function getfeedetails()
                {
                $this->db->select('*');
                $this->db->from('application_fees');
                $query=$this->db->get();
                return $query->result_array();
                }


                public function getapplication_subjectdetails($post_exam_id, $post_exam_group_id, $class_id, $section_id,$session_id)
                { 
                $this->db->select('*,subjects.name as subjectname,subjects.code as subjectcode,subjects.id as subjectid');

                $this->db->from('classes');

                $this->db->join('class_sections', 'class_sections.class_id  = classes.id');

                $this->db->join('sections', 'sections.id  = class_sections.section_id');


                $this->db->join('subject_group_class_sections', 'subject_group_class_sections.class_section_id  = class_sections.id');

                $this->db->join('subject_groups', 'subject_groups.id  = subject_group_class_sections.subject_group_id');

                $this->db->join('subject_group_subjects', 'subject_group_subjects.subject_group_id  = subject_groups.id');

                $this->db->join('subjects', 'subjects.id  = subject_group_subjects.subject_id');
                $this->db->where('class_sections.class_id', $class_id);
                $this->db->where('class_sections.section_id', $section_id);
                $query=$this->db->get();
                return $query->result_array();
                }

                public function applicationfee($exam_id, $exam_group_id,$class_id, $section_id,$session_id)
                {
                $this->db->select('*');
                $this->db->from('application_examfee');
                $this->db->where('application_examfee_examgroup',$exam_group_id);
                $this->db->where('application_examfee_examgroupbatch',$exam_id);
                $this->db->where('application_examfee_class',$class_id);
                $this->db->where('application_examfee_section',$section_id);
                $this->db->where('application_examfee_session',$session_id);  

                $query=$this->db->get();
                return $query->row_array();
                }

                public function getonline_instruction($post_exam_id, $post_exam_group_id)
                {
                $this->db->select('*');
                $this->db->from('online_examination_instruction');
                $this->db->where('online_examination_examid',$post_exam_id);
                $this->db->where('online_examination_examgroup',$post_exam_group_id);
                $this->db->where('online_examination_current_session', $this->current_session); 
                $query=$this->db->get();
                return $query->row_array();
                }



                /////Attempts


                public function getsayexamte_attempts()
                {

                $this->db->select('*');
                $this->db->from('exam_group_exam_sayexam_temarks');
                $this->db->join('students', 'students.id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $this->db->join('student_session', 'student_session.student_id = students.id');
                $this->db->join('classes', 'classes.id = student_session.class_id');
                $this->db->join('sections', 'sections.id = student_session.section_id');
                $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_subject_id');
                $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
                $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');

                $this->db->where('student_session.session_id', $this->current_session);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid', $post_exam_group_id);
                $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid', $post_exam_id);
                $this->db->where('student_session.class_id', $class_id);
                $this->db->where('student_session.section_id', $section_id);
                $this->db->where('student_session.session_id', $session_id);
                $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
                $query = $this->db->get();
                return $query->result_array();
                }
                }
