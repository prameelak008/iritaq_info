            <?php
            
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }
            
            class Examgroupstudent_model extends CI_Model {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            public function searchExamGroupStudentAttempted1($exam_group_id, $class_id, $batch_id) {
            $sql = "select IFNULL(exam_group_students.id, 0) as `exam_group_student_id`,students.admission_no , students.id as `student_id`, students.roll_no,students.admission_date,students.firstname, students.middlename, students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,students.dob ,students.current_address,    students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`,   students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,`classes`.`class`,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender`,students.batch_id,batch.name,student_session.* from student_session INNER join students on students.id=student_session.student_id JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` inner join batch on students.batch_id=batch.id INNER JOIN exam_group_students on exam_group_students.exam_group_id=" . $this->db->escape($exam_group_id) . " and exam_group_students.student_id =students.id WHERE student_session.class_id=" . $this->db->escape($class_id) . " and students.batch_id=" . $this->db->escape($batch_id) . " GROUP BY students.id ORDER BY students.id asc";
            $query = $this->db->query($sql);
            return $query->result_array();
            }
            
            public function searchExamGroupStudentAttempted($exam_group_id, $exam_id, $class_id, $section_id, $session_id) {
            $sql = "select IFNULL(exam_group_students.id, 0) as `exam_group_student_id`,students.admission_no , students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,`classes`.`class`,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender`,student_session.* from student_session INNER join students on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_ids=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($session_id) . " JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN exam_group_students on exam_group_students.exam_group_id=" . $this->db->escape($exam_group_id) . " and exam_group_students.student_id =students.id ORDER BY students.id asc";
            $query = $this->db->query($sql);
            return $query->result_array();
            }
            
            
            public function searchExamStudentsByExam($exam_id) {
            $sql = "SELECT  exam_group_class_batch_exam_students.id as `exam_group_class_batch_exam_student_id`,exam_group_class_batch_exam_students.roll_no as `exam_roll_no`,exam_group_class_batch_exam_students.teacher_remark,students.admission_no , students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_email,`classes`.`class`,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender`,`students`.`app_key`,`students`.`parent_app_key` FROM `exam_group_class_batch_exam_students` INNER JOIN student_session on student_session.id=exam_group_class_batch_exam_students.student_session_id INNER join students on students.id=student_session.student_id  INNER JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` WHERE exam_group_class_batch_exam_id=" . $this->db->escape($exam_id) . " AND students.is_active='yes'";
            
            $query = $this->db->query($sql);
            return $query->result();
            }
            
            public function searchExamStudentsByExam_NewStudent($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$admitcard_template)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('classes', 'student_session.class_id = classes.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('classes.id', $class_id);
            $this->db->where('sections.id', $section_id);
            $this->db->where('student_session.session_id', $this->current_session);
            $this->db->where('students.id', $student_id);
            $query = $this->db->get();
            return $query->row();
            }
            
            public function getonline_examintaion_approvedbyadmin($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('online_examination_accept');
            $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
            $this->db->where('online_examination_accept.online_examination_exam', $exam_id);
            $this->db->where('online_examination_accept.online_examination_student_id', $student_id);
            $this->db->where('online_examination_accept.online_examination_session_id', $this->current_session);
            $query = $this->db->get();
            return $query->row_array();
            }
            
            public function searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id) 
            {
            $sql = "SELECT  exam_group_class_batch_exam_students.id as `exam_group_class_batch_exam_student_id`,exam_group_class_batch_exam_students.roll_no as `exam_roll_no`,students.admission_no , student_session.id as  student_session_id, students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,`classes`.`class`,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender` FROM `exam_group_class_batch_exam_students` INNER JOIN student_session on student_session.id=exam_group_class_batch_exam_students.student_session_id INNER join students on students.id=student_session.student_id  INNER JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` WHERE exam_group_class_batch_exam_id=" . $this->db->escape($exam_id) . " AND students.is_active='yes' AND student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($session_id);
            $query = $this->db->query($sql);
            return $query->result();
            }
            
            public function searchExamStudents_valuationeaxmresult() 
            {
            $this->db->select('*');
            $this->db->from ('exam_group_exam_results');
            // $this->db->where('exam_group_exam_results');  
            $query = $this->db->get();
            return $query->result();
            }
       
            
            public function searchExamStudents_valuation($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid) 
            {
            $this->db->select('*,exam_group_class_batch_exam_students.id as exam_group_class_batch_exam_student_id,exam_group_class_batch_exam_subjects.id as subject_id');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id');    
            
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('sections.id', $section_id); 
            $this->db->where('student_session.session_id', $session_id);
            $this->db->where('exam_group_class_batch_exam_subjects.id', $subjectid);
            $this->db->group_by('exam_group_class_batch_exam_students.student_id'); 
            $query = $this->db->get();
            return $query->result();
            }
            
            
            
            public function searchExamStudents_valuationcamp($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid) 
            {
            $this->db->select('*,exam_group_class_batch_exam_students.id as exam_group_class_batch_exam_student_id,exam_group_class_batch_exam_subjects.id as subject_id,exam_group_exam_results.id as resid');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id'); 
            $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_class_batch_exam_subjects.id', 'LEFT'); 
            //$this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_class_batch_exam_subjects.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('sections.id', $section_id);     
            $this->db->where('exam_group_class_batch_exam_subjects.id', $subjectid);
            $this->db->where('student_session.session_id', $session_id);
            $this->db->group_by('exam_group_class_batch_exam_students.student_id'); 
            $query = $this->db->get();
            return $query->result();
            }
            
            public function valuation_lastdate($exam_group_id, $exam_id, $session_id) 
            {
            $date = date('Y-m-d');    
            $this->db->select('*');
            $this->db->from('valuation_center');
            $this->db->join('valuation_subject_list', 'valuation_subject_list.valuation_subject_list_title = valuation_center.valuation_centerid');
            $this->db->where('valuation_subject_list.valuation_subject_list_examgroup', $exam_group_id);
            $this->db->where('valuation_subject_list.valuation_subject_list_exam', $exam_id);
            $this->db->where('valuation_subject_list.valuation_subject_list_session', $session_id);
            $this->db->where(array('valuation_subject_list.valuation_closingdate >=', $date));
            $this->db->group_by('valuation_subject_list.valuation_subject_list_title'); 
            $query = $this->db->get();
            return $query->row_array();
            }
            
            public function valuation_lastdate_admin($exam_group_id, $exam_id, $session_id) 
            {
            $date = date('Y-m-d');    
            $this->db->select('*');
            $this->db->from('valuation_center');
            $this->db->join('valuation_subject_list', 'valuation_subject_list.valuation_subject_list_title = valuation_center.valuation_centerid');
            $this->db->where('valuation_subject_list.valuation_subject_list_examgroup', $exam_group_id);
            $this->db->where('valuation_subject_list.valuation_subject_list_exam', $exam_id);
            $this->db->where('valuation_subject_list.valuation_subject_list_session', $session_id);
            $this->db->group_by('valuation_subject_list.valuation_subject_list_title'); 
            $query = $this->db->get();
            return $query->row_array();
            }

            public function searchExamStudents_valuationview($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid) 
            {
            $this->db->select('*,exam_group_exam_results.id as result_id,exam_group_exam_results.created_at as created_at,exam_group_exam_results.updated_at as updated_at');
            $this->db->from ('exam_group_class_batch_exam_students');
            $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id'); 
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_group_class_batch_exam_students.exam_group_class_batch_exam_id', $exam_id);
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('sections.id', $section_id);
            $this->db->where('student_session.session_id', $session_id);
            $this->db->where('exam_group_exam_results.exam_group_class_batch_exam_subject_id', $subjectid);
            $query = $this->db->get();
            return $query->result();
            } 
            
            public function searchExamStudents_valuationtest($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid) 
            {
            $this->db->select('exam_group_class_batch_exam_students.id as exam_group_class_batch_exam_student_id,exam_group_class_batch_exam_subjects.id as subject_id,exam_group_class_batch_exam_subjects.max_marks');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id','LEFT'); 
            $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('sections.id', $section_id);     
            $this->db->where('exam_group_class_batch_exam_subjects.id', $subjectid);
            $this->db->group_by('exam_group_class_batch_exam_students.student_id'); 
            $query = $this->db->get();
            return $query->result();
            }
            
            
            
            
            
            public function getmarks($exam_id,$subjectid) 
            {
            $this->db->select('*');
            $this->db->from ('exam_group_class_batch_exam_subjects');
            $this->db->where('exam_group_class_batch_exam_subjects.id', $exam_id);
            $this->db->where('exam_group_class_batch_exam_subjects.id', $subjectid);
            $query = $this->db->get();
            return $query->result();
            }
            
            
            
            
            public function searchExamStudents_valuationempty($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid) 
            {
            $this->db->select('*,exam_group_class_batch_exam_students.id as exam_group_class_batch_exam_student_id,exam_group_class_batch_exam_subjects.id as subject_id');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('sections.id', $section_id);     
            $this->db->where('exam_group_class_batch_exam_subjects.id', $subjectid);
            $this->db->group_by('exam_group_class_batch_exam_students.student_id'); 
            $query = $this->db->get();
            return $query->result();
            
            }
            
            
            
            
            
            public function searchExamGroupStudents($exam_group_id, $class_id, $section_id, $session_id) {
            $sql = "select IFNULL(exam_group_students.id, 0) as `exam_group_student_id`,students.admission_no , students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,`classes`.`class`,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender`,student_session.* from student_session INNER join students on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($session_id) . " JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` LEFT JOIN exam_group_students on exam_group_students.exam_group_id=" . $this->db->escape($exam_group_id) . " and exam_group_students.student_id =students.id ORDER BY students.id asc";
            $query = $this->db->query($sql);
            return $query->result_array();
            }
            
            public function add($data_insert, $data_delete, $exam_group_id) {
            
            $this->db->trans_begin();
            
            if (!empty($data_insert)) {
            
            foreach ($data_insert as $student_key => $student_value) {
            $this->db->where('exam_group_id', $student_value['exam_group_id']);
            $this->db->where('student_id', $student_value['student_id']);
            $q = $this->db->get('exam_group_students');
            
            if ($q->num_rows() == 0) {
            
            $this->db->insert('exam_group_students', $data_insert[$student_key]);
            }
            }
            }
            if (!empty($data_delete)) {
            
            $this->db->where('exam_group_id', $exam_group_id);
            $this->db->where_in('student_id', $data_delete);
            $this->db->delete('exam_group_students');
            }
            
            if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
            } else {
            $this->db->trans_commit();
            return true;
            }
            }
            
            public function examGroupSubjectResult($exam_subject_id, $class_id, $section_id, $session_id) {
            $sql = "SELECT IFNULL(exam_group_exam_results.id, 0) as exam_group_exam_result_id,IFNULL(exam_group_exam_results.attendence,'') as `exam_group_exam_result_attendance`,IFNULL(exam_group_exam_results.get_marks,'') as `exam_group_exam_result_get_marks`,IFNULL(exam_group_exam_results.get_cmarks,'') as `exam_group_exam_result_get_cmarks`,IFNULL(exam_group_exam_results.note,'') as `exam_group_exam_result_note`,exam_group_class_batch_exam_students.id as `exam_group_class_batch_exam_students_id`,exam_group_class_batch_exam_students.roll_no as `exam_roll_no`,exam_group_class_batch_exam_subjects.*,subjects.name,subjects.code,subjects.type,students.admission_no , students.roll_no,students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender`,exam_group_class_batch_exams.use_exam_roll_no FROM `exam_group_class_batch_exam_subjects` INNER JOIN exam_group_class_batch_exams on exam_group_class_batch_exams.id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id INNER JOIN exam_group_class_batch_exam_students on exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id INNER join student_session on student_session.id=exam_group_class_batch_exam_students.student_session_id LEFT join exam_group_exam_results on exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_class_batch_exam_subjects.id and exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_class_batch_exam_students.id  INNER JOIN students on students.id=student_session.student_id LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id`  WHERE students.is_active='yes' AND exam_group_class_batch_exam_subjects.id=" . $this->db->escape($exam_subject_id) . " and  student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($session_id) . " ORDER BY students.id asc";
            
            $query = $this->db->query($sql);
            return $query->result_array();
            }
            
            
            public function add_result($insert_array)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            
            if (!empty($insert_array)) {
            // foreach ($insert_array as $student_key => $student_value) 
            // {
            // $student_value['exam_group_class_batch_exam_subject_id'];
            // $student_value['exam_group_class_batch_exam_student_id'];
            // $this->db->where('exam_group_class_batch_exam_subject_id', $student_value['exam_group_class_batch_exam_subject_id']);
            // $this->db->where('exam_group_class_batch_exam_student_id', $student_value['exam_group_class_batch_exam_student_id']);
            // $q = $this->db->get('exam_group_exam_results');
            // if ($q->num_rows() > 0)
            // {
            // $update_result = $q->row();
            // $this->db->where('id', $update_result->id);
            // $this->db->update('exam_group_exam_results', $student_value);
            
            // } else
            // {
            // $this->db->insert('exam_group_exam_results', $student_value);
            // }
            // }
            
            
            
            foreach ($insert_array as $student_key => $student_value) 
            {
            $subject    = $student_value['exam_group_class_batch_exam_subject_id'];
            $student    = $student_value['exam_group_class_batch_exam_student_id'];
            $attendence = $student_value['attendence'];
            $get_marks  = $student_value['get_marks'];
            $get_cmarks = $student_value['get_cmarks'];
            $note       = $student_value['note'];
            $this->db->where('exam_group_class_batch_exam_subject_id', $student_value['exam_group_class_batch_exam_subject_id']);
            $this->db->where('exam_group_class_batch_exam_student_id', $student_value['exam_group_class_batch_exam_student_id']);
            $q          = $this->db->get('exam_group_exam_results');
            
            if ($q->num_rows() > 0)
            {
            $update_result = $q->row();
            $da = array(
            'exam_group_class_batch_exam_student_id'   => $student,
            'exam_group_class_batch_exam_subject_id'   => $subject,
            'attendence'                               => $attendence,
            'get_marks'                                => $get_marks,
            'get_cmarks'                               => $get_cmarks,
            'note'                                     => $note
            );
            
            $this->db->where('id', $update_result->id);
            $this->db->update('exam_group_exam_results', $da);
            $this->db->where('result_id', $update_result->id);
            $q_regular = $this->db->get('exam_group_exam_results_regular');
            if ($q_regular->num_rows() > 0)
            {
            $update_regular = $q_regular->row();
            $regular_data = array(
            'exam_group_class_batch_exam_student_id'   => $student,
            'exam_group_class_batch_exam_subject_id'   => $subject,
            'attendence'                               => $attendence,
            'get_marks'                                => $get_marks,
            'get_cmarks'                               => $get_cmarks,
            'note'                                     => $note,
            'result_id'                                => $update_result->id
            );
            
            $this->db->where('id', $update_regular->id);
            $this->db->update('exam_group_exam_results_regular', $regular_data);
            }
            else
            {
            $regular_data = array(
            'exam_group_class_batch_exam_student_id'   => $student,
            'exam_group_class_batch_exam_subject_id'   => $subject,
            'attendence'                               => $attendence,
            'get_marks'                                => $get_marks,
            'get_cmarks'                               => $get_cmarks,
            'note'                                     => $note,
            'result_id'                                => $update_result->id
            );
            
            $this->db->insert('exam_group_exam_results_regular', $regular_data);
            }
            }
            else
            {
            $da = array(
            'exam_group_class_batch_exam_student_id'   => $student,
            'exam_group_class_batch_exam_subject_id'   => $subject,
            'attendence'                               => $attendence,
            'get_marks'                                => $get_marks,
            'get_cmarks'                               => $get_cmarks,
            'note'                                     => $note
            );
            $this->db->insert('exam_group_exam_results', $da);
            $result_id = $this->db->insert_id();
            $regular_data = array(
            'exam_group_class_batch_exam_student_id'   => $student,
            'exam_group_class_batch_exam_subject_id'   => $subject,
            'attendence'                               => $attendence,
            'get_marks'                                => $get_marks,
            'get_cmarks'                               => $get_cmarks,
            'note'                                     => $note,
            'result_id'                                => $result_id  // Insert the result_id (ID of the newly inserted record)
            );
            $this->db->insert('exam_group_exam_results_regular', $regular_data);
            }
            }
            }
            $this->db->trans_complete(); # Completing transaction
            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {
            # Everything is Perfect.
            # Committing data to the database.
            $this->db->trans_commit();
            return true;
            }
            }
            
            
            
            
            public function searchStudentByClassSectionSession($class_id, $section_id, $session_id) {
            $sql = "SELECT students.admission_no , students.id as `student_id`, students.roll_no,students.admission_date,students.firstname, students.middlename,students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender` FROM `students` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER join student_session on students.id=student_session.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($session_id) . " ORDER BY students.id asc";
            
            $query = $this->db->query($sql);
            return $query->result_array();
            }
            
            
            
            public function searchStudentExams($student_session_id, $is_active = false, $is_publish = false) {
            $inner_sql = "";
            if ($is_active) {
            $inner_sql = "and exam_group_class_batch_exams.is_active=1 ";
            }
            if ($is_publish) {
            $inner_sql .= "and exam_group_class_batch_exams.is_publish=1 ";
            }
            $sql = "SELECT exam_group_class_batch_exam_students.*,exam_group_class_batch_exams.exam_group_id,exam_group_class_batch_exams.exam,exam_group_class_batch_exams.date_from,exam_group_class_batch_exams.date_to,exam_group_class_batch_exams.description,exam_groups.name,exam_groups.exam_type FROM `exam_group_class_batch_exam_students` INNER JOIN exam_group_class_batch_exams on exam_group_class_batch_exams.id=exam_group_class_batch_exam_students.exam_group_class_batch_exam_id  INNER JOIN exam_groups on exam_groups.id=exam_group_class_batch_exams.exam_group_id WHERE student_session_id=" . $this->db->escape($student_session_id) . $inner_sql . " ORDER BY id asc";
            
            
            $query = $this->db->query($sql);
            $student_exam = $query->result();
            
            if (!empty($student_exam)) {
            foreach ($student_exam as $student_exam_key => $student_exam_value) {
            $student_exam_value->exam_result = $this->examresult_model->getStudentExamResults($student_exam_value->exam_group_class_batch_exam_id, $student_exam_value->exam_group_id, $student_exam_value->id, $student_exam_value->student_id);
            }
            }
            return $student_exam;
            }
            
            
            
            public function studentExams($student_session_id) {
            $sql = "SELECT exam_group_class_batch_exam_students.*,exam_group_class_batch_exams.id as `exam_group_class_batch_exam_id`,exam_group_class_batch_exams.exam FROM `exam_group_class_batch_exam_students` INNER JOIN exam_group_class_batch_exams on exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE student_session_id=" . $this->db->escape($student_session_id) . " and exam_group_class_batch_exams.is_active=1";
            
            $query = $this->db->query($sql);
            $student_exam = $query->result();
            return $student_exam;
            }
            
            
            public function updateExamStudent($data)
            {
            $this->db->update_batch('exam_group_class_batch_exam_students', $data, 'id');
            }
            
            
            public function NewsearchExamStudents($class_id, $section_id, $session_id) 
            {
            $this->db->select('*,exam_group_class_batch_exam_students.id as `exam_group_class_batch_exam_student_id,exam_group_class_batch_exam_students.roll_no as `exam_roll_no`,students.admission_no , students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.permanent_address,students.category_id');
            $this->db->from ('students');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.student_id = students.id');
            $this->db->join('classes', 'student_session.class_id = classes.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('student_session.session_id', $session_id );
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('student_session.section_id', $section_id);
            $this->db->group_by('exam_group_class_batch_exam_students.student_id');         
            $query = $this->db->get();
            return $query->result();
            }
            
            
            //no more updation here
            public function getNamesubject($examid)
            {
            $this->db->select('*,exam_group_class_batch_exam_subjects.id as subject_id,subjects.name as name,subjects.code as ucode,subjects.id as subjectid');
            $this->db->from ('exam_group_class_batch_exam_subjects');
            $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
            $this->db->where(array('exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id'=> $examid)); 
            // $this->db->group_by('subjects.code');
            
            $this->db->group_by('exam_group_class_batch_exam_subjects.subject_id');
            $query = $this->db->get();
            return $query->result_array();
            }
            
            
            public function getsubj($id)
            {
            $this->db->select('*,exam_group_class_batch_exam_subjects.id as subject_id,subjects.name as name,subjects.code as ucode,subjects.id as subjectid');
            $this->db->from ('exam_group_class_batch_exam_subjects');
            $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
            $this->db->where(array('exam_group_class_batch_exam_subjects.id'=> $id)); 
            $this->db->group_by('subjects.code');
            $query = $this->db->get();
            return $query->row_array();
            }
            
            
            
            public function getsubject_bylist($examid)
            {
            $this->db->select('*,exam_group_class_batch_exam_subjects.id as subject_id,subjects.name as name,subjects.code as ucode,subjects.id as subjectid,valuation_subject_list.valuation_subject_list_id as vallist');
            $this->db->from ('exam_group_class_batch_exam_subjects');
            $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
            $this->db->join('valuation_subject_list', 'valuation_subject_list.valuation_subject_list_subjectid = exam_group_class_batch_exam_subjects.id');
            $this->db->where(array('exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id'=> $examid)); 
            $this->db->group_by('subjects.code');
            $query = $this->db->get();
            return $query->result_array();
            }
            
            
            
            
           /* public function getNamesubject_bytitle($title,$examid)
            {
            $this->db->select('*,valuation_subject_list.valuation_subject_list_papercount as valuation_subject_list_papercount,valuation_subject_list.valuation_subject_list_amount as valuation_subject_list_amount, exam_group_class_batch_exam_subjects.id as subject_id,subjects.name as name,subjects.code as ucode,subjects.id as subjectid,valuation_subject_list.valuation_subject_list_id as vallist');
            $this->db->from ('exam_group_class_batch_exam_subjects');
            $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
            $this->db->join('valuation_center', 'valuation_center.valuation_centerexamid = exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id');
            $this->db->join('valuation_subject_list', 'valuation_subject_list.valuation_subject_list_subjectid = subjects.id ','left');
            $this->db->where(array('valuation_center.valuation_centerid'=>$title,'valuation_center.valuation_centerexam_group_id'=> $examid)); 
            $this->db->group_by('subjects.code');
            $query = $this->db->get();
            return $query->result_array();
            }
            */
            
            public function getNamesubject_bytitle($title, $examid,$session_id)
            {
            $this->db->select('valuation_subject_list.valuation_subject_list_papercount as valuation_subject_list_papercount,valuation_subject_list.valuation_subject_list_amount as valuation_subject_list_amount, exam_group_class_batch_exam_subjects.id as subject_id,subjects.name as name,subjects.code as ucode,subjects.id as subjectid,valuation_subject_list.valuation_subject_list_id as vallist');
            $this->db->from('subjects');
            $this->db->join('exam_group_class_batch_exam_subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
            $this->db->join('valuation_subject_list', 'valuation_subject_list.valuation_subject_list_subjectid = subjects.id AND valuation_subject_list.valuation_subject_list_exam = ' . $this->db->escape($examid) . ' AND valuation_subject_list.valuation_subject_list_title = ' . $this->db->escape($title). ' AND valuation_subject_list.	valuation_subject_list_session = ' . $this->db->escape($session_id), 'left');
            $this->db->where(array('exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id'=> $examid));
            $this->db->group_by('subjects.code');
            $query = $this->db->get();
            return $query->result_array();
            }
    
            
            
            public function getNamesubject_valuation($examid)
            {
            $this->db->select('exam_group_class_batch_exam_subjects.*, exam_group_class_batch_exam_subjects.subject_id as subid,exam_group_class_batch_exam_subjects.id as subbatchid,subjects.name as name, subjects.code as ucode, subjects.id as subjectid, valuation_subject_list.valuation_subject_list_papercount as valuation_subject_list_papercount,valuation_subject_list.valuation_subject_list_amount as valuation_subject_list_amount');
            $this->db->from('exam_group_class_batch_exam_subjects');
            $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
            $this->db->join('valuation_subject_list', 'valuation_subject_list.valuation_subject_list_subjectid = exam_group_class_batch_exam_subjects.subject_id', 'left'); // Use INNER JOIN for valuation_subject_list
            $this->db->where(array('exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id' => $examid));
            $this->db->group_by('subjects.code');
            $query = $this->db->get();
            return $query->result_array();
            }
            
            
            
            
            public function revaluation_approvedbyadmin($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_group_exam_revaluation');
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid', $exam_id);
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid', $student_id);
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_status',1  );
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_session_id',$this->current_session);
            $this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid');
            $query = $this->db->get();
            return $query->row_array();        
            }
            
            
            
            public function getstud($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from('exam_group_exam_revaluation');
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid', $exam_id);
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid', $student_id);
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_status',1  );
            $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_session_id',$this->current_session);
            //$this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid');
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            
            public function getstud_sayexam($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from('exam_group_exam_sayexam');
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid', $exam_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid', $student_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_status',1  );
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_session_id',$this->current_session);
            //$this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid');
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            public function getstud_sayexam_temarks($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from('exam_group_exam_sayexam_temarks');
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid', $exam_id);
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid', $student_id);
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_status',1  );
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_session_id',$this->current_session);
            //$this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_studentid');
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            public function sayexam_approvedbyadmin($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_group_exam_sayexam');
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid', $exam_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid', $student_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_status',1  );
            $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_studentid');
            $query = $this->db->get();
            return $query->row_array();        
            }
            
            
            public function sayexamtemraks_approvedbyadmin($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_group_exam_sayexam_temarks');
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid', $exam_id);
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid', $student_id);
            $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_status',1);
            $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_studentid');
            $query = $this->db->get();
            return $query->row_array();        
            }
            
            
            public function improvement_approvedbyadmin($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_group_exam_sayexam');
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid', $exam_group_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid', $exam_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid', $student_id);
            $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_status',1  );
            $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_studentid');
            $query = $this->db->get();
            return $query->row_array(); 
            }
            
            
            public function feesdetails($exam_group_id, $exam_id, $class_id, $section_id, $session_id) 
            {    
            $this->db->select('*');
            $this->db->from ('fees_payment');
            $this->db->where('fees_payment_examgroup', $exam_group_id);
            $this->db->where('fees_payment_exam', $exam_id);
            $this->db->where('fees_payment_class_id', $class_id);
            $this->db->where('fees_payment_section_id', $section_id);
            $this->db->where('fees_payment_session', $session_id);        
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            
            public function getexam_payment($exam_group_id, $exam_id, $class_id, $section_id, $session_id) 
            {    
            $this->db->select('*');
            $this->db->from ('students');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('fees_payment', 'fees_payment.fees_payment_student_id = students.id');
            $this->db->where(array('fees_payment.fees_payment_examgroup'=> $exam_group_id,'fees_payment.fees_payment_exam'=> $exam_id,'fees_payment.fees_payment_class_id'=> $class_id,'fees_payment.fees_payment_section_id'=> $section_id,'fees_payment.fees_payment_session'=> $session_id));
            $this->db->group_by('fees_payment.fees_payment_student_id'); 
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            
            public function getpaymentdetails_bystudent($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id) 
            {    
            $this->db->select('*');
            $this->db->from ('students');
            //$this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('fees_payment', 'fees_payment.fees_payment_student_id = students.id');
            $this->db->where(array('fees_payment.fees_payment_examgroup'=> $exam_group_id,'fees_payment.fees_payment_exam'=> $exam_id,'fees_payment.fees_payment_class_id'=> $class_id,'fees_payment.fees_payment_section_id'=> $section_id,'fees_payment.fees_payment_session'=> $session_id,'fees_payment.fees_payment_student_id'=>$student_id));
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            
            
            public function getexam_payment_sayexam($exam_group_id, $exam_id, $class_id, $section_id, $session_id) 
            {    
            $this->db->select('*');
            $this->db->from ('students');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('fees_sayexampayment', 'fees_sayexampayment.fees_sayexampayment_student_id = students.id');
            $this->db->where(array('fees_sayexampayment.fees_sayexampayment_examgroupbatch'=> $exam_group_id,'fees_sayexampayment.fees_sayexampayment_examgroup'=> $exam_id,'fees_sayexampayment.fees_sayexampayment_class_id'=> $class_id,'fees_sayexampayment.fees_sayexampayment_section_id'=> $section_id,'fees_sayexampayment.fees_sayexampayment_session_id'=> $session_id));
            $this->db->group_by('fees_sayexampayment.fees_sayexampayment_student_id'); 
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            public function getpaymentdetails_bystudent_sayexam($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id) 
            { 
            $this->db->select('*');
            $this->db->from ('students');
            $this->db->join('fees_sayexampayment', 'fees_sayexampayment.fees_sayexampayment_student_id = students.id');
            $this->db->where(array('fees_sayexampayment.fees_sayexampayment_examgroupbatch'=> $exam_group_id,'fees_sayexampayment.fees_sayexampayment_examgroup'=> $exam_id,'fees_sayexampayment.fees_sayexampayment_class_id'=> $class_id,'fees_sayexampayment.fees_sayexampayment_section_id'=> $section_id,'fees_sayexampayment.fees_sayexampayment_session_id'=> $session_id,'fees_sayexampayment.fees_sayexampayment_student_id'=>$student_id));
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            
            public function getexam_payment_revaluation($exam_group_id, $exam_id, $class_id, $section_id, $session_id) 
            {    
            $this->db->select('*');
            $this->db->from ('students');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('fees_revaluationpayment', 'fees_revaluationpayment.fees_revaluationpayment_student_id = students.id');
            
            $this->db->where(array('fees_revaluationpayment.fees_revaluationpayment_examgroupbatch'=> $exam_group_id,'fees_revaluationpayment.fees_revaluationpayment_examgroup'=> $exam_id,'fees_revaluationpayment.fees_revaluationpayment_class_id'=> $class_id,'fees_revaluationpayment.fees_revaluationpayment_section_id'=> $section_id,'fees_revaluationpayment.fees_revaluationpayment_session_id'=> $session_id));
            $this->db->group_by('fees_revaluationpayment.fees_revaluationpayment_student_id'); 
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            
            
            public function getpaymentdetails_bystudent_revaluation($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$student_id) 
            { 
            $this->db->select('*');
            $this->db->from ('students');
            $this->db->join('fees_revaluationpayment', 'fees_revaluationpayment.fees_revaluationpayment_student_id = students.id');
            $this->db->where(array('fees_revaluationpayment.fees_revaluationpayment_examgroupbatch'=> $exam_group_id,'fees_revaluationpayment.fees_revaluationpayment_examgroup'=> $exam_id,'fees_revaluationpayment.fees_revaluationpayment_class_id'=> $class_id,'fees_revaluationpayment.fees_revaluationpayment_section_id'=> $section_id,'fees_revaluationpayment.fees_revaluationpayment_session_id'=> $session_id,'fees_revaluationpayment.fees_revaluationpayment_student_id'=>$student_id));
            $query = $this->db->get();
            return $query->result_array();  
            }
            
            
            
            public function gettotalStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id)
            {
            $this->db->select('*');
            $this->db->from('exam_groups');
            
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('classes', 'student_session.class_id = classes.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('classes.id', $class_id);
            $this->db->where('sections.id', $section_id);
            $this->db->where('student_session.session_id', $this->current_session);
            return $this->db->count_all_results(); 
            }
            
            
            
            public function exam_students($student_value)
            {
            $this->db->select('*');
            $this->db->from('students');
            $this->db->join('student_session','student_session.student_id=students.id');
            $this->db->where(array('student_session.id'=>$student_value,'student_session.session_id'=> $this->current_session));
            $q=$this->db->get();
            return  $q->row_array();
            }
            public function getvaluation_count($subjectid,$exam_group_id,$exam_id)
            {
            $this->db->select('*');
            $this->db->from('valuation_subject_list');
            $this->db->where(array('valuation_subject_list_subjectid'=>$subjectid, 'valuation_subject_list_examgroup'=>$exam_group_id, 'valuation_subject_list_exam'=>$exam_id, 'valuation_subject_list_session'=> $this->current_session));
            $q=$this->db->get();
            return  $q->row_array();
            }
            
            public function valuation_center()
            {
            $this->db->select('*');
            $this->db->from('valuation_center');
            $this->db->where('valuation_centerstatus',1);
            $q=$this->db->get();
            return  $q->result_array();
            }
            
            public function get_assigned_staff($title)
            {
            $this->db->select('*,staff.id as staffid,staff.name as staffname,staff.surname as surname,staff.employee_id as employee_id, exam_groups.name as examgroupname,exam_group_class_batch_exams.exam as exam');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('valuation_center','valuation_center.valuation_centerid=valuation_assignsubjects.valuation_center_title');
            
            $this->db->join('exam_groups','exam_groups.id=valuation_assignsubjects.valuation_examgroup');
            $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=valuation_assignsubjects.valuation_examid');
            
            
            //$this->db->join('exam_groups','exam_groups.id=valuation_center.valuation_centerexam_group_id');
            //$this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=valuation_center.valuation_centerexamid');
            $this->db->join('staff','staff.id=valuation_assignsubjects.valuation_staff');
            $this->db->where(array('valuation_assignsubjects.valuation_center_title'=>$title));
            $this->db->group_by('valuation_assignsubjects.valuation_staff'); 
            $q=$this->db->get();
            return  $q->result_array();
            }
            
            
            
            
            public function getexamgroups_withheld($exam_group_id, $exam_id, $class_id, $section_id, $session_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id'); 
            $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_class_batch_exam_subjects.id', 'LEFT');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('classes', 'student_session.class_id = classes.id');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('classes.id', $class_id);
            $this->db->where('sections.id', $section_id);
            $this->db->where('student_session.session_id', $this->current_session);
            $this->db->where('students.id', $student_id);
            $this->db->where('exam_group_exam_results.attendence', 'Withheld');
            $query = $this->db->get();
            if ($query->num_rows() > 0) 
            {
            return $query->row();
            } 
            else
            {
            
            return null;
            }
            }


            public function get_publish_status($exam_group_id, $exam_id)
            {
            $student_id = $this->customlib->getStudentSessionUserID();
            $this->db->select('*');
            $this->db->from ('exam_group_class_batch_exams');
            $this->db->where('exam_group_id', $exam_group_id);
            $this->db->where('id', $exam_id);
            $this->db->where('is_publish', 1);
            $this->db->where('session_id', $this->current_session);
            $query = $this->db->get();
            return  $query->row_array();
            }
            
            
            
            
            
            public function searchExamStudents_moderationreport($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid) 
            {
            $this->db->select('*,exam_group_class_batch_exam_students.id as exam_group_class_batch_exam_student_id,exam_group_class_batch_exam_subjects.id as subject_id,exam_group_exam_moderation.id as resid,exam_group_exam_moderation.moderation_ce as moderation_ce,exam_group_exam_moderation.moderation_te as moderation_te');
            $this->db->from ('exam_groups');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');
            $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
            $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id'); 
            $this->db->join('exam_group_exam_moderation', 'exam_group_exam_moderation.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id AND exam_group_exam_moderation.exam_group_class_batch_exam_subject_id = exam_group_class_batch_exam_subjects.id', 'LEFT');
            $this->db->join('sections', 'sections.id = student_session.section_id');
            $this->db->where('exam_groups.id', $exam_group_id);
            $this->db->where('exam_group_class_batch_exams.id', $exam_id);
            $this->db->where('student_session.class_id', $class_id);
            $this->db->where('sections.id', $section_id);     
            $this->db->where('exam_group_class_batch_exam_subjects.id', $subjectid);
            $this->db->group_by('exam_group_class_batch_exam_students.student_id'); 
            $query = $this->db->get();
            return $query->result();
            }
          
            
            
            public function search_moderation_marks($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid)
            {
            $this->db->select('*');
            $this->db->from('moderation_marks');
            $this->db->where(array('moderation_examgroup'=>$exam_group_id,'	moderation_exam'=>$exam_id,'moderation_class'=>$class_id,'moderation_section'=>$section_id,'moderation_session'=>$session_id,'moderation_subjects'=>$subjectid));
            $query = $this->db->get();
            return $query->row_array();
            }
            
            public function get_attendence($std)
            {
            $attendence_details = array();
            $this->db->select('*');
            $this->db->from('students');
            $this->db->join('student_session', 'student_session.student_id  = students.id');
            $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
            $this->db->where('student_attendences.attendence_type_id =', 1);
            $this->db->where('student_attendences.student_session_id', $std);
            $attendence_details= $this->db->count_all_results(); 
            return $attendence_details;
            }


            public function view_Studentabs($std)
            {
            $attendence_details = array();
            $this->db->select('*');
            $this->db->from('students');
            $this->db->join('student_session', 'student_session.student_id  = students.id');
            $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
            $this->db->where('student_attendences.attendence_type_id =', 5);
            $this->db->where('student_attendences.student_session_id', $std);
            $attendence_details= $this->db->count_all_results(); 
            return $attendence_details;
            }


            public function view_Studentattendence_halfdays($students_array)
            {
            $attendence_details = array();
    
            if (!empty($students_array)) 
            {
            foreach ($students_array as $student_key => $student_value)
            {
                 
            $attendence_details[] = $student_value;
    
            $this->db->select('*');
            $this->db->from('students');
            $this->db->join('student_session', 'student_session.student_id  = students.id');
            $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
            $this->db->where('student_attendences.attendence_type_id =', 6);
    
            $this->db->where('students.id', $student_value);
            $attendence_details= $this->db->count_all_results(); 
    
             }
             }
            return $attendence_details;
            } 





        public function view_Studentattendence_late($students_array)
        {
        $attendence_details = array();

        if (!empty($students_array)) 
        {
        foreach ($students_array as $student_key => $student_value)
        {
             
        $attendence_details[] = $student_value;

        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 3);

        $this->db->where('students.id', $student_value);
        $attendence_details= $this->db->count_all_results(); 

         }
         }
        return $attendence_details;
        } 
            
            

            
            }
