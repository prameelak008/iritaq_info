            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Semesterexam_model extends CI_Model {
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }




            public function searchExamSemStudents001($sem_group_id) 
            {               
            $this->db->select('*');
            $this->db->from('semester_studentdetails');
            $this->db->join('students', 'students.id= semester_studentdetails.stud_student_id');
            $this->db->join('student_session', 'student_session.student_id  = students.id');
            $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid');
            $this->db->join('semester_term','semester_term.stm_id = semester_group.sem_group_semester_term'); 
            $this->db->join('semestertype','semestertype.st_id =semester_group.sem_group_semester'); 
            $this->db->join('programee','programee.id=semester_group.sem_group_program','left');
            $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup','left');            
            $this->db->join('semester_student_tbl','semester_student_tbl.sem_student_id=semester_studentdetails.stud_student_id','left');
            $this->db->where('semester_studentdetails.stud_semgroupid',$sem_group_id);               
            // $this->db->order_by('students.admission_no');
            $query = $this->db->get();
            return $query->result_array();
            }





            // public function searchExamSemStudents($sem_group_id) 
            // { 
            // $this->db->select('semester_studentdetails.*, semester_students.*, semester_student_tbl.sem_student_id as sem_checked');
            // $this->db->from('semester_studentdetails');
            // $this->db->join('semester_students', 'semester_students.id= semester_studentdetails.stud_student_id');
            // $this->db->join('semester_student_session', 'semester_student_session.student_id  = semester_students.id');
            // $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid');
            // $this->db->join('semester_term','semester_term.stm_id = semester_group.sem_group_semester_term'); 
            // $this->db->join('semestertype','semestertype.st_id =semester_group.sem_group_semester'); 
            // $this->db->join('programee','programee.id=semester_group.sem_group_program','left');
            // $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup','left');
            // // LEFT JOIN to semester_student_tbl to see if a record exists
            // $this->db->join('semester_student_tbl','semester_student_tbl.sem_student_id=semester_studentdetails.stud_student_id','left');

            // $this->db->where('semester_studentdetails.stud_semgroupid',$sem_group_id);               
            // $query = $this->db->get();
            // return $query->result_array();
            // }



            public function searchExamSemStudents($sem_group_id) 
            {                
            $this->db->select('*,semester_student_session.id as stud_student_id,semester_student_tbl.sem_student_id as sem_checked');
            $this->db->from('semester_students');            
            // $this->db->join('semester_students', 'semester_students.id= semester_studentdetails.stud_student_id');    
            
            
            $this->db->join('semester_student_session', 'semester_student_session.student_id  = semester_students.id');
            

            $this->db->join('batch_semester', 'batch_semester.bchsem_id  = semester_student_session.sem_group_id');
            // $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid');
            // $this->db->join('semester_term','semester_term.stm_id = semester_group.sem_group_semester_term'); 
            // $this->db->join('semestertype','semestertype.st_id =semester_group.sem_group_semester'); 
            // $this->db->join('programee','programee.id=semester_group.sem_group_program','left');
            $this->db->join('batchtype','batchtype.b_id=batch_semester.bchtyp_id','left');
            $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name','left');
         
            $this->db->join('semester_student_tbl','semester_student_tbl.sem_student_id=semester_student_session.id','left');

            // $this->db->where('semester_studentdetails.stud_semgroupid',$sem_group_id); 

            $this->db->where('semester_student_session.sem_group_id',$sem_group_id);


            $query = $this->db->get();
            return $query->result_array();
            }

            



            public function add_subjects($insert_array, $update_array, $not_be_del,$exam_id)
            {
            if (!empty($insert_array)) {

            foreach ($insert_array as $insert_key => $insert_value) {
            $this->db->insert('semester_exam_subjects', $insert_array[$insert_key]);
            $not_be_del[]= $this->db->insert_id();

            }
            }
            if (!empty($update_array)) 
            {
            $this->db->update_batch('semester_exam_subjects',$update_array, 'id'); 
            }

            if (!empty($not_be_del)) {
            $this->db->where('exam_group_class_batch_exams_id', $exam_id);
            $this->db->where_not_in('id', $not_be_del);
            $this->db->delete('semester_exam_subjects');
            }
            }




            public function getExamSubjects($id = null)
            {

            // $subject_condition = 0;
            // $userdata          = $this->customlib->getUserData();
            // $role_id           = $userdata["role_id"];

            // if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) 
            // {
            // if ($userdata["class_teacher"] == 'yes')
            // {
            // $my_classes         = $this->teacher_model->my_classes($userdata['id']);
            // if (!empty($my_classes))
            // {
            // $subject_condition  = 0;
            // }
            // else
            // {
            // $subject_condition  = 1;
            // $my_subjects        = $this->teacher_model->get_examsubjects($userdata['id']);
            // }
            // }
            // }

            // $this->db->select('exam_group_class_batch_exam_subjects.*,subjects.name as `subject_name`,subjects.code as `subject_code`,subjects.type as `subject_type`')->from('exam_group_class_batch_exam_subjects');

            // $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');

            // //$this->db->join('subject_group_subjects', 'subject_group_subjects.subject_id   = subjects.id');
            // //$this->db->join('subject_groups', 'subject_groups.id   = subject_group_subjects.subject_group_id');

            // //$this->db->join('subject_group_class_sections', 'subject_group_class_sections.subject_group_id   = subject_groups.id');
            // // $this->db->join('class_sections', 'class_sections.id   = subject_group_class_sections.class_section_id');

            // $this->db->where('exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id', $id);

            // if ($subject_condition == 1) {
            // $this->db->where_in('subjects.id', $my_subjects);
            // }
            // //$this->db->order_by('exam_group_class_batch_exam_subjects.id');
            // $this->db->order_by('exam_group_class_batch_exam_subjects.date_from');
            // $this->db->group_by('exam_group_class_batch_exam_subjects.subject_id');
            // $query = $this->db->get();
            // $result = $query->result();
            // return $result;    

            // $exam_group_class_batch_exams_id is the current exam batch id


            $this->db->select('semester_exam_subjects.*, subjects.name as subject_name, subjects.code as subject_code');
            $this->db->from('semester_exam_subjects');
            $this->db->join('subjects', 'subjects.id = semester_exam_subjects.subject_id', 'left');
            $this->db->where('semester_exam_subjects.exam_group_class_batch_exams_id', $id);
            $this->db->order_by('semester_exam_subjects.date_from', 'ASC');
            $this->db->group_by('semester_exam_subjects.subject_id');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
            }


            public function getExamSubject($exam_subject_id) 
            {
            $sql = "SELECT semester_exam_subjects.*,subjects.name as `subject_name`,subjects.code FROM `semester_exam_subjects` INNER JOIN subjects on subjects.id=semester_exam_subjects.subject_id WHERE semester_exam_subjects.id=" . $this->db->escape_str($exam_subject_id);

            $query = $this->db->query($sql);
            return $query->row();
            }

            public function examGroupSubjectResult($exam_subject_id,$sem_group_id) 
            {
            // $sql = "SELECT 
            // IFNULL(semester_group_exam_results.id, 0) as exam_group_exam_result_id,
            // IFNULL(semester_group_exam_results.attendence, '') as 	attendence,


            // IFNULL(semester_group_exam_results.attendence,'') as attendence,
            // IFNULL(semester_group_exam_results.get_marks,'') as exam_group_exam_result_get_marks,
            // IFNULL(semester_group_exam_results.get_cmarks,'') as exam_group_exam_result_get_cmarks,
            // IFNULL(semester_group_exam_results.note,'') as exam_group_exam_result_note,
            // exam_group_class_batch_exam_students.id as exam_group_class_batch_exam_students_id,
            // exam_group_class_batch_exam_students.roll_no as exam_roll_no,
            // semester_exam_subjects.*,
            // subjects.name,
            // subjects.code,
            // subjects.type,
            // students.admission_no,
            // students.roll_no,
            // students.id as student_id,
            // students.admission_date,
            // students.firstname,
            // students.middlename,
            // students.lastname,
            // students.image,
            // students.mobileno,
            // students.email,
            // students.state,
            // students.city,
            // students.pincode,
            // students.religion,
            // students.dob,
            // students.current_address,
            // students.permanent_address,
            // students.category_id,
            // IFNULL(categories.category, '') as category,
            // students.adhar_no,
            // students.samagra_id,
            // students.bank_account_no,
            // students.bank_name,
            // students.ifsc_code,
            // students.guardian_name,
            // students.guardian_relation,
            // students.guardian_phone,
            // students.guardian_address,
            // students.is_active,
            // students.father_name,
            // students.gender,
            // exam_group_class_batch_exams.use_exam_roll_no
            // FROM semester_exam_subjects

            // INNER JOIN exam_group_class_batch_exams 
            // ON exam_group_class_batch_exams.id = semester_exam_subjects.exam_group_class_batch_exams_id

            // INNER JOIN subjects 
            // ON subjects.id = semester_exam_subjects.subject_id

            // INNER JOIN exam_group_class_batch_exam_students 
            // ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id

            // INNER JOIN student_session 
            // ON student_session.id = exam_group_class_batch_exam_students.student_session_id

            // LEFT JOIN semester_group_exam_results 
            // ON semester_group_exam_results.exam_group_class_batch_exam_subject_id = semester_exam_subjects.id
            // AND semester_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_class_batch_exam_students.id

            // INNER JOIN students 
            // ON students.id = student_session.student_id

            // LEFT JOIN categories 
            // ON students.category_id = categories.id

            // WHERE students.is_active = 'yes' 
            // AND semester_exam_subjects.id = " . $this->db->escape($exam_subject_id) . " 

            // ORDER BY students.id ASC";
            // $query = $this->db->query($sql);
            // return $query->result_array();

            $sql = "SELECT 
            IFNULL(semester_group_exam_results.id, 0) as exam_group_exam_result_id,
            IFNULL(semester_group_exam_results.attendence, '') as 	attendence,
            IFNULL(semester_group_exam_results.attendence,'') as attendence,
            IFNULL(semester_group_exam_results.get_marks,'') as exam_group_exam_result_get_marks,
            IFNULL(semester_group_exam_results.get_cmarks,'') as exam_group_exam_result_get_cmarks,
            IFNULL(semester_group_exam_results.note,'') as exam_group_exam_result_note,
            semester_student_tbl.sem_exam_id as exam_group_class_batch_exam_students_id,
            semester_student_tbl.roll_no as exam_roll_no,
            semester_exam_subjects.*,
            subjects.name,
            subjects.code,
            subjects.type,
            semester_students.admission_no,
            semester_students.roll_no,
            semester_students.id as student_id,
            semester_students.admission_date,
            semester_students.firstname,
            semester_students.middlename,
            semester_students.lastname,
            semester_students.image,
            semester_students.mobileno,
            semester_students.email,
            semester_students.state,
            semester_students.city,
            semester_students.pincode,
            semester_students.religion,
            semester_students.dob,
            semester_students.current_address,
            semester_students.permanent_address,
            semester_students.category_id,
            IFNULL(categories.category, '') as category,
            semester_students.adhar_no,
            semester_students.samagra_id,
            semester_students.bank_account_no,
            semester_students.bank_name,
            semester_students.ifsc_code,
            semester_students.guardian_name,
            semester_students.guardian_relation,
            semester_students.guardian_phone,
            semester_students.guardian_address,
            semester_students.is_active,
            semester_students.father_name,
            semester_students.gender,
            exam_group_class_batch_exams.use_exam_roll_no
            FROM semester_exam_subjects

            INNER JOIN exam_group_class_batch_exams 
            ON exam_group_class_batch_exams.id = semester_exam_subjects.exam_group_class_batch_exams_id

            INNER JOIN subjects 
            ON subjects.id = semester_exam_subjects.subject_id

            INNER JOIN semester_student_tbl 
            ON semester_student_tbl.sem_exam_exam_id = exam_group_class_batch_exams.id

            INNER JOIN semester_student_session 
            ON semester_student_session.id = semester_student_tbl.sem_student_id

            LEFT JOIN semester_group_exam_results 
            ON semester_group_exam_results.exam_group_class_batch_exam_subject_id = semester_exam_subjects.id
            AND semester_group_exam_results.exam_group_class_batch_exam_student_id = semester_student_tbl.sem_exam_id

            INNER JOIN semester_students 
            ON semester_students.id = semester_student_session.student_id

            LEFT JOIN categories 
            ON semester_students.category_id = categories.id

            WHERE semester_students.is_active = 'yes' 
            AND semester_exam_subjects.id = " . $this->db->escape($exam_subject_id) . " 
            AND semester_student_session.sem_group_id=" . $this->db->escape($sem_group_id) . "

            ORDER BY semester_students.id ASC";
            $query = $this->db->query($sql);
            return $query->result_array();              
            }




            ////////////////////////////////////////Admit Card......................................




            public function search_ByStudents($exam_group_id,$exam_id,$sem_group_id ) 
            { 
            $this->db->select('*,semester_students.id as student_id');
            $this->db->from('semester_student_tbl`'); 
            $this->db->join('semester_studentdetails','semester_studentdetails.stud_student_id=semester_student_tbl.sem_student_id');
            $this->db->join('semester_students','semester_students.id=semester_studentdetails.stud_student_id');
            $this->db->join('semester_group','semester_group.sem_group_id=semester_studentdetails.stud_semgroupid');     
            // $this->db->where(array('semester_student_tbl.sem_exam_exam_id'=> $exam_id));
            $this->db->where(array('semester_studentdetails.stud_semgroupid'=> $sem_group_id));
            $query = $this->db->get();
            $result = $query->result();
            return $result;
            }


            public function searchExamStudents($exam_group_id,$exam_id,$sem_group_id ) 
            {             
            //  $sql   = "SELECT  exam_group_class_batch_exam_students.id as `exam_group_class_batch_exam_student_id`,exam_group_class_batch_exam_students.roll_no as `exam_roll_no`,students.admission_no , student_session.id as  student_session_id, students.id as `student_id`, students.roll_no,students.admission_date,students.firstname,students.middlename, students.lastname,students.image, students.mobileno, students.email ,students.state , students.city , students.pincode , students.religion,students.dob ,students.current_address, students.permanent_address,students.category_id, IFNULL(categories.category, '') as `category`, students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,`classes`.`class`,students.guardian_address,students.is_active,`students`.`father_name`,`students`.`gender` FROM `exam_group_class_batch_exam_students` INNER JOIN student_session on student_session.id=exam_group_class_batch_exam_students.student_session_id INNER join students on students.id=student_session.student_id  INNER JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` WHERE exam_group_class_batch_exam_id=" . $this->db->escape($exam_id) . " AND students.is_active='yes' AND student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and student_session.session_id=" . $this->db->escape($session_id);

            $this->db->select('*,semester_students.id as student_id');
            $this->db->from('semester_student_tbl`'); 
            $this->db->join('semester_studentdetails','semester_studentdetails.stud_student_id=semester_student_tbl.sem_student_id');
            $this->db->join('semester_students','semester_students.id=semester_studentdetails.stud_student_id');
            $this->db->join('semester_group','semester_group.sem_group_id=semester_studentdetails.stud_semgroupid');     
            $this->db->where(array('semester_student_tbl.sem_exam_exam_id'=> $exam_id));
            $query = $this->db->get();
            $result = $query->result();
            return $result;
            }




                public function getStudentsAdmitCardByExamAndStudentID($students_array, $exam_group_class_batch_exam_id, $semgroup_id)
                {
                // 
                // 1️⃣ Assign roll numbers to students who don't have one
                $this->db->trans_start();

                $this->db->select('*');
                $this->db->from('semester_student_tbl');
                $this->db->where('sem_exam_exam_id', $exam_group_class_batch_exam_id);
                $this->db->where('roll_no', 0);
                $results = $this->db->get()->result();

                if (!empty($results)) {
                $maxid = $this->db
                ->select_max('roll_no', 'maxid')
                ->where('sem_exam_exam_id', $exam_group_class_batch_exam_id)
                ->get('semester_student_tbl')
                ->row()->maxid ?? 0;

                $update_roll_no = ($maxid == 0) ? 100001 : $maxid + 1;

                foreach ($results as $res) {
                $this->db->where('sem_exam_exam_id', $exam_group_class_batch_exam_id);
                $this->db->where('sem_student_id', $res->sem_student_id);
                $this->db->update('semester_student_tbl', ['roll_no' => $update_roll_no]);
                $update_roll_no++;
                }
                }

                $this->db->trans_complete();

                // 2️⃣ Fetch full student details with joins
                $this->db->select('
                semester_student_tbl.sem_student_id,
                semester_students.id AS student_id,
                semester_students.firstname,
                semester_students.middlename,
                semester_students.lastname,
                semester_students.admission_no,
                semester_students.gender,
                semester_students.dob,
                semester_students.father_name,
                semester_students.mother_name,
                semester_students.current_address,
                semester_students.image,
                semester_student_tbl.roll_no,
                semester_student_tbl.sem_exam_exam_id,
                semester_student_tbl.sem_exam_qrcode,
                semester_exam_subjects.date_from,
                semester_exam_subjects.time_from,
                semester_exam_subjects.duration,
                subjects.name AS name,
                subjects.code AS code,
                subjects.type AS type,
                semestertype.st_name,
                semester_term.stm_name,
                programee.p_name,
                batch_groups.batch_group_name
                ');

                $this->db->from('semester_student_tbl');
                $this->db->join('semester_students', 'semester_students.id = semester_student_tbl.sem_student_id');
                $this->db->join('semester_studentdetails', 'semester_studentdetails.stud_student_id = semester_student_tbl.sem_student_id', 'left');
                $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid', 'left');
                $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');
                $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');
                $this->db->join('programee', 'programee.id = semester_group.sem_group_program', 'left');
                $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left');
                $this->db->join('semester_exam_subjects', 'semester_exam_subjects.exam_group_class_batch_exams_id = semester_student_tbl.sem_exam_exam_id', 'left');
                $this->db->join('subjects', 'subjects.id = semester_exam_subjects.subject_id', 'left');

                $this->db->where('semester_student_tbl.sem_exam_exam_id', $exam_group_class_batch_exam_id);
                $this->db->where('semester_group.sem_group_id', $semgroup_id);

                if (!empty($students_array)) {
                $this->db->where_in('semester_student_tbl.sem_student_id', $students_array);
                }

                $this->db->order_by('semester_students.firstname', 'ASC');
                $query = $this->db->get();

                // Group rows per student and return arrays to match view expectations
                $rows = $query->result_array();
                $grouped = array();
                foreach ($rows as $r) {
                $sid = $r['sem_student_id'];
                if (!isset($grouped[$sid])) $grouped[$sid] = array();
                $grouped[$sid][] = $r;
                }
                return array_values($grouped);
                }



                public function  getexamgroup_And_exam_Name($post_exam_id,$post_exam_group_id)
                {
                $this->db->select('*');        
                $this->db->from('exam_groups'); 
                $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.exam_group_id = exam_groups.id');                
                $this->db->where('exam_group_class_batch_exams.id',$post_exam_id);
                $this->db->where('exam_group_class_batch_exams.exam_group_id',$post_exam_group_id);
                $query = $this->db->get();
                return $query->row_array();
                }




            public function getStudentsAdmitCardByExamAndStudentID001($students_array, $exam_group_class_batch_exam_id,$semgroup_id) 
            {
            $sql     = "SELECT *  FROM `semester_student_tbl` where sem_exam_exam_id=" . $exam_group_class_batch_exam_id . " and roll_no =0";
            $query   = $this->db->query($sql);
            $results = $query->result();
            if (!empty($results)) {
            $maxid = $this->db->query('SELECT MAX(roll_no) AS `maxid` FROM `semester_student_tbl` where sem_exam_exam_id=' . $exam_group_class_batch_exam_id)->row()->maxid;

            // Assign roll numbers sequentially for rows of this exam with roll_no=0
            if ($maxid == 0) {
            $update_roll_no = 100001;
            } else {
            $update_roll_no = $maxid + 1;
            }

            $this->db->trans_start();
            foreach ($results as $res_key => $res_value) {
            // Update each student's row for this exam safely
            $this->db->where('sem_exam_exam_id', $exam_group_class_batch_exam_id);
            $this->db->where('sem_student_id', $res_value->sem_student_id);
            $this->db->update('semester_student_tbl', ['roll_no' => $update_roll_no]);
            $update_roll_no++;
            }
            $this->db->trans_complete();
            }

            $student_details = array();

            if (!empty($students_array))
            {
            foreach ($students_array as $student_key => $student_value)
            {
            $student_details[] = $this->getStudentDetailsByExamAndStudentID($student_value, $exam_group_class_batch_exam_id);
            }
            }
            return $student_details;  
            }


            public function getStudentDetailsByExamAndStudentID($student_id, $exam_group_class_batch_exam_id) 
            {    
            $this->db->select('subjects.*, semester_exam_subjects.*, semester_student_tbl.*, batch_groups.*, semester_students.*, programee.*, semestertype.*, semester_group.*, semester_term.*');
            $this->db->from('semester_student_tbl');
            $this->db->join('semester_students', 'semester_students.id = semester_student_tbl.sem_student_id');
            $this->db->join('semester_studentdetails', 'semester_studentdetails.stud_student_id = semester_student_tbl.sem_student_id');
            $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid');
            $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term');
            $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester');
            $this->db->join('programee', 'programee.id = semester_group.sem_group_program');
            $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup');
            $this->db->join('semester_exam_subjects', 'semester_exam_subjects.exam_group_class_batch_exams_id = semester_student_tbl.sem_exam_exam_id');
            $this->db->join('subjects', 'subjects.id = semester_exam_subjects.subject_id');
            $this->db->where('semester_student_tbl.sem_exam_exam_id', $exam_group_class_batch_exam_id);
            $this->db->where('semester_student_tbl.sem_student_id', $student_id);
            $query = $this->db->get();
            return $query->result_array();
            }     






            public function getSemExamSubjects($post_exam_id)
            {          
            $this->db->select('semester_exam_subjects.*,exam_group_class_batch_exams.*,subjects.*,semester_exam_subjects.*');
            $this->db->from('semester_exam_subjects');
            $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=semester_exam_subjects.exam_group_class_batch_exams_id');
            $this->db->join('subjects','subjects.id=semester_exam_subjects.subject_id');
            $this->db->where(array('semester_exam_subjects.exam_group_class_batch_exams_id'=> $post_exam_id));
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
            }



            //////Semester Exam


            public function get_instruction()
            {          
            $this->db->select('*');
            $this->db->from('sem_exam_instruction');  
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
            }



            public function get_exam_subjects001($sem_group_id)
            {                
            $this->db->select('*,semester_subject_groups.id as sem_sub_group_id,subjects.id as subjectid');
            $this->db->from('semester_assign_subjects');
            $this->db->join('semester_subject_groups','semester_subject_groups.id=semester_assign_subjects.sem_assign_subjects_id');

            $this->db->join('semester_subject_group_subjects','semester_subject_group_subjects.subject_group_id =semester_subject_groups.id');

            $this->db->join('subjects','subjects.id =semester_subject_group_subjects.subject_id');
            $this->db->where(array('semester_assign_subjects.sem_assign_group_id'=> $sem_group_id));
            $query    = $this->db->get();
            $result   = $query->result_array();
            return $result;  
            } 


            public function get_exam_subjects($sem_group_id)
            {                
            $this->db->select('
            semester_subject_groups.id AS sem_sub_group_id,
            subjects.id AS subjectid,
            subjects.name AS subject_name,
            sem_subject_charge.inst_fees_charge
            ');
            $this->db->from('semester_assign_subjects');
            $this->db->join('semester_subject_groups', 'semester_subject_groups.id = semester_assign_subjects.sem_assign_subjects_id');
            $this->db->join('semester_subject_group_subjects', 'semester_subject_group_subjects.subject_group_id = semester_subject_groups.id');
            $this->db->join('subjects', 'subjects.id = semester_subject_group_subjects.subject_id');

            $this->db->join(
            'sem_subject_charge',
            'sem_subject_charge.inst_sem_subject_id = subjects.id AND sem_subject_charge.inst_sem_group = semester_assign_subjects.sem_assign_group_id',
            'left' //  Left join so it still shows subjects even if no fees exist yet
            );

            $this->db->where('semester_assign_subjects.sem_assign_group_id', $sem_group_id);
            $query = $this->db->get();
            return $query->result_array();
            }




            public function get_instructiondetails()
            {
            $this->db->select('* ,exam_groups.name as examgroupname,exam_group_class_batch_exams.exam as exam_name');
            $this->db->from('sem_exam_instruction');
            $this->db->join('exam_groups','exam_groups.id=sem_exam_instruction.sem_exam_examgroup' ,'left');
            $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=sem_exam_instruction.sem_exam_examid','left');
            $this->db->join('sem_fees_charge','sem_fees_charge.sem_fees_title=sem_exam_instruction.sem_exam_id','left'); 
            $this->db->where(array('sem_exam_instruction.sem_exam_is_status'=> 1));
            $query    = $this->db->get();
            $result   = $query->result_array();
            return $result; 
            }


            /////Enrollment Tables

            public function adddoc($data)
            {
            $this->db->insert('semester_student_doc', $data);
            return $this->db->insert_id();
            }




            public function add($data, $data_setting = array())
            {
            if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('semester_students', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On students id " . $data['id'];
            $action    = "Update";
            $record_id = $insert_id = $data['id'];

            } else {
            if (!empty($data_setting)) {

            if ($data_setting['adm_auto_insert']) {
            if ($data_setting['adm_update_status'] == 0) {
            $data_setting['adm_update_status'] = 1;
            $this->setting_model->add($data_setting);
            }
            }
            $this->db->insert('semester_students', $data);
            $insert_id = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On students id " . $insert_id;
            $action    = "Insert";
            $record_id = $insert_id;
            // $this->log($message, $record_id, $action);

            return $insert_id;
            }
            }
            }



            public function add_student_session($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            // $this->db->where('session_id', $data['session_id']);
            $this->db->where('student_id', $data['student_id']);
            $q = $this->db->get('semester_student_session');
            if ($q->num_rows() > 0) {
            $rec = $q->row_array();
            $this->db->where('id', $rec['id']);
            $this->db->update('semester_student_session', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  student session id " . $rec['id'];
            $action    = "Update";
            $record_id = $rec['id'];
            // $this->log($message, $record_id, $action);
            } else {
            $this->db->insert('semester_student_session', $data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On  student session id " . $id;
            $action    = "Insert";
            $record_id = $id;
            // $this->log($message, $record_id, $action);
            }
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {
            return true;
            }
            }


            public function get_printcard($students_array, $exam_group_id, $exam_id)
            {
                // Normalize to an array of ints (supports single student or multiple)
                if (!is_array($students_array)) {
                    $students_array = array((int)$students_array);
                } else {
                    $students_array = array_filter(array_map('intval', $students_array));
                }

                // Delegate to existing method with correct parameter order:
                // getStudentsAdmitCardByExamAndStudentID($students_array, $exam_id, $semgroup_id)
                return $this->getStudentsAdmitCardByExamAndStudentID($students_array, (int)$exam_id, (int)$exam_group_id);
            }

            }
