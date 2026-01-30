        <?php
        
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }
        
        class Examgroup_model extends MY_Model
        {
        
        public function __construct()
        {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        }
        
        /**
        * This funtion takes id as a parameter and will fetch the record.
        * If id is not provided, then it will fetch all the records form the table.
        * @param int $id
        * @return mixed
        */
    //     public function get($id = null)
    //     {
        
    //     //$this->db->select('exam_groups.*,(select count(*) from exam_group_class_batch_exams WHERE exam_group_class_batch_exams.exam_group_id=exam_groups.id) as `counter`')->from('exam_groups');
        
    //     $this->db->select('exam_groups.*, (select count(*) from exam_group_class_batch_exams WHERE exam_group_class_batch_exams.exam_group_id=exam_groups.id AND exam_group_class_batch_exams.session_id=' . $this->db->escape($this->current_session) . ') as `counter`', false)
    // ->from('exam_groups');
    
    //     if ($id != null) {
    //     $this->db->where('id', $id);
    //     } else {
    //     $this->db->order_by('id');
    //     }
    //     $query = $this->db->get();
    //     if ($id != null) {
    //     return $query->row();
    //     } else {
    //     return $query->result();
    //     }
    //     }
    
    
    
    
    
        public function get_res($id = null)
        {
        
        $this->db->select('exam_groups.*,(select count(*) from exam_group_class_batch_exams WHERE exam_group_class_batch_exams.exam_group_id=exam_groups.id) as `counter`')->from('exam_groups');
        
    //     $this->db->select('exam_groups.*, (select count(*) from exam_group_class_batch_exams WHERE exam_group_class_batch_exams.exam_group_id=exam_groups.id AND exam_group_class_batch_exams.session_id=' . $this->db->escape($this->current_session) . ') as `counter`', false)
    // ->from('exam_groups');
    
        if ($id != null) {
        $this->db->where('id', $id);
        } else {
        $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
        return $query->row();
        } else {
        return $query->result();
        }
        }
    
    
        public function get($id = null)
        {
        $this->db->select('exam_groups.*,(select count(*) from exam_group_class_batch_exams WHERE exam_group_class_batch_exams.exam_group_id=exam_groups.id) as `counter`')->from('exam_groups');
        // $this->db->select('exam_groups.*, (select count(*) from exam_group_class_batch_exams WHERE exam_group_class_batch_exams.exam_group_id=exam_groups.id AND exam_group_class_batch_exams.session_id=' . $this->db->escape($this->current_session) . ') as `counter`', false)
        // ->from('exam_groups');
        
        if ($id !== null) {
        $this->db->where('id', $id);
        } else {
        $this->db->order_by('id');
        }
        
        $query = $this->db->get();
        
        if ($id !== null) {
        return $query->row();
        } else {
        $result = $query->result();
        
        // Filter results based on the counter value
        $filteredResult = array_filter($result, function ($row) {
        return $row->counter > 0;
        });
        
        return $filteredResult;
        }
        }
        
        
        
        public function getExamByID($id = null)
        {
        $sql = "SELECT exam_groups.name as `exam_group_name`,exam_groups.exam_type as `exam_group_type`,exam_groups.id as `exam_group_id`,exam_group_class_batch_exams.*,sessions.session FROM `exam_group_class_batch_exams` INNER JOIN exam_groups on exam_groups.id= exam_group_class_batch_exams.exam_group_id INNER JOIN sessions on sessions.id = exam_group_class_batch_exams.session_id WHERE exam_group_class_batch_exams.id=" . $this->db->escape($id);
        // $this->db->select('exam_group_class_batch_exams.*')->from('exam_group_class_batch_exams');
        $query = $this->db->query($sql);
        
        return $query->row();
        }
        
        /**
        * This function will delete the record based on the id
        * @param $id
        */
        public function remove($id)
        {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->delete('exam_groups'); //class record delete.
        $message   = DELETE_RECORD_CONSTANT . " On exam groups id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        if ($this->db->trans_status() === false) {
        $this->db->trans_rollback();
        } else {
        $this->db->trans_commit();
        }
        return true;
        }
        
        /**
        * This function will take the post data passed from the controller
        * If id is present, then it will do an update
        * else an insert. One function doing both add and edit.
        * @param $data
        */
        public function add($data)
        {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
        $this->db->where('id', $data['id']);
        $this->db->update('exam_groups', $data);
        $message   = UPDATE_RECORD_CONSTANT . " On  exam groups id " . $data['id'];
        $action    = "Update";
        $record_id = $data['id'];
        $this->log($message, $record_id, $action);
        } else {
        $this->db->insert('exam_groups', $data);
        $id        = $this->db->insert_id();
        $message   = INSERT_RECORD_CONSTANT . " On exam groups id " . $id;
        $action    = "Insert";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        }
        
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /*Optional*/
        
        if ($this->db->trans_status() === false) {
        # Something went wrong.
        $this->db->trans_rollback();
        return false;
        } else {
        //return $return_value;
        }
        }
        
        public function delete_exam($id)
        {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('exam_group_class_batch_exams');
        $message   = DELETE_RECORD_CONSTANT . " On exam groups exams name id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
        return false;
        } else {
        return true;
        }
        }
        
        public function add_exam($data)
        {
        if (isset($data['id'])) {
        $this->db->where('id', $data['id']);
        $this->db->update('exam_group_class_batch_exams', $data);
        $message   = UPDATE_RECORD_CONSTANT . " On  exam group exams name id " . $data['id'];
        $action    = "Update";
        $record_id = $data['id'];
        $this->log($message, $record_id, $action);
        
        } else {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        
        $exam_group = $this->examgroup_model->get($data['exam_group_id']);
        $this->db->insert('exam_group_class_batch_exams', $data);
        $insert_id = $this->db->insert_id();
        $message   = INSERT_RECORD_CONSTANT . " On exam group exams name id " . $insert_id;
        $action    = "Insert";
        $record_id = $insert_id;
        $this->log($message, $record_id, $action);
        // if ($exam_group->exam_type != "coll_grade_system") {
        //     $batch_subjects = $this->batchsubject_model->getClassBatchSubjects($data['class_batch_id']);
        //     if (!empty($batch_subjects)) {
        //         $exam_subjects = array();
        //         foreach ($batch_subjects as $batch_subject_key => $batch_subject_value) {
        //             $exam_subjects[] = array(
        //                 'exam_group_class_batch_exams_id' => $insert_id,
        //                 'class_batch_subject_id'          => $batch_subject_value->id,
        //             );
        //         }
        //         if (!empty($exam_subjects)) {
        //             $this->db->insert_batch('exam_group_class_batch_exam_subjects', $exam_subjects);
        //         }
        //     }
        // }
        $this->db->trans_complete(); # Completing transaction
        
        /* Optional */
        
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
        }
        
        
        
        public function getExamByExamGroup($id, $is_active = false)
        {
        $this->db->select('exam_group_class_batch_exams.*,sessions.session,(select COUNT(*) from exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id) as `total_subjects`')->from('exam_group_class_batch_exams');
        $this->db->join('sessions', 'sessions.id = exam_group_class_batch_exams.session_id');
        if ($is_active) {
        $this->db->where('exam_group_class_batch_exams.is_active', $is_active);
        }
        $this->db->where('exam_group_class_batch_exams.exam_group_id', $id);
        $this->db->order_by('exam_group_class_batch_exams.exam_group_id');
        $query = $this->db->get();
        return $query->result();
        }
        
        
        
        
        public function getExamBy_NewExamGroup($examgroup,$exambatch)
        {
        $this->db->select('*');
        $this->db->from('exam_groups');
        $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.exam_group_id = exam_groups.id');
        $this->db->where('exam_groups.id', $examgroup);
        $this->db->where('exam_group_class_batch_exams.id', $exambatch);
        $query = $this->db->get();
        return $query->row();
        }
        
        
        public function getBacklogExam($parent_exam_id)
        {
        $this->db->select()->from('exam_group_class_batch_exams');
        $this->db->where('parent_exam_id', $parent_exam_id);
        $query = $this->db->get();
        return $query->result();
        }
        
        public function getExamGroupDetailByID($id)
        {
        $this->db->select()->from('exam_groups');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
        $result        = $query->row();
        $result->exams = $this->getExamByExamGroup($result->id);
        return $result;
        }
        return false;
        }
        
        public function verifyExamConnection($exam_array)
        {
        
        $sql = "SELECT exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id,exam_group_class_batch_exam_subjects.subject_id,count(subject_id) as subject_count FROM `exam_group_class_batch_exam_subjects` WHERE exam_group_class_batch_exams_id in(" . implode(",", $exam_array) . ") GROUP by subject_id,exam_group_class_batch_exams_id";
        
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        $sub_array   = array();
        $exams_array = array();
        $ex_array    = array();
        $no_record   = 0;
        if (!empty($result)) {
        $no_record = 1;
        foreach ($result as $result_key => $result_value) {
        $exams_array[$result_value->exam_group_class_batch_exams_id]                         = $result_value->exam_group_class_batch_exams_id;
        $ex_array[$result_value->exam_group_class_batch_exams_id][$result_value->subject_id] = $result_value->subject_count;
        }
        }
        return array('sub_array' => $sub_array, 'exams_array' => $exams_array, 'exam_subject_array' => $ex_array, 'no_record' => $no_record);
        }
        
        public function getExamByExamGroupConnection($id = null)
        {
        
        $this->db->select('exam_group_class_batch_exams.*,IFNULL(exam_group_exam_connections.id,0) as `exam_group_exam_connection_id`,IFNULL(exam_group_exam_connections.exam_weightage,"0.00") as exam_weightage,(select COUNT(*) from exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id) as `total_subjects`')->from('exam_group_class_batch_exams');
        $this->db->join('exam_group_exam_connections', 'exam_group_exam_connections.exam_group_id = exam_group_class_batch_exams.exam_group_id and exam_group_exam_connections.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id', 'left');
        $this->db->where('exam_group_class_batch_exams.exam_group_id', $id);
        $this->db->order_by('exam_group_class_batch_exams.id','asc');
        
        $query = $this->db->get();
        
        return $query->result();
        }
        
        public function getExamGroupConnectionList($exam_group_id = null)
        {
        
        $this->db->select('exam_group_exam_connections.*')->from('exam_group_exam_connections');
        $this->db->where('exam_group_exam_connections.exam_group_id', $exam_group_id);
        $this->db->order_by('exam_group_exam_connections.id', 'asc');
        $query = $this->db->get();
        return $query->result();
        }
        
        public function connectExam($insert_array, $exam_group_id)
        {
        $not_be_delted = array();
        if (!empty($insert_array)) {
        
        foreach ($insert_array as $array_key => $array_value) {
        $this->db->where('exam_group_id', $array_value['exam_group_id']);
        $this->db->where('exam_group_class_batch_exams_id', $array_value['exam_group_class_batch_exams_id']);
        $q = $this->db->get('exam_group_exam_connections');
        
        if ($q->num_rows() == 0) {
        
        $this->db->insert('exam_group_exam_connections', $insert_array[$array_key]);
        $not_be_delted[] = $array_value['exam_group_class_batch_exams_id'];
        } else {
        $id                              = $q->row()->id;
        $exam_group_class_batch_exams_id = $q->row()->exam_group_class_batch_exams_id;
        $this->db->where('id', $id);
        $this->db->update('exam_group_exam_connections', $insert_array[$array_key]);
        $not_be_delted[] = $exam_group_class_batch_exams_id;
        }
        }
        }
        
        if (!empty($not_be_delted)) {
        
        $this->db->where('exam_group_id', $exam_group_id);
        $this->db->where_not_in('exam_group_class_batch_exams_id', $not_be_delted);
        $this->db->delete('exam_group_exam_connections');
        } else {
        $this->db->where('exam_group_id', $exam_group_id);
        $this->db->delete('exam_group_exam_connections');
        }
        }
        public function deleteExamGroupConnection($exam_group_id)
        {
        $this->db->where('exam_group_id', $exam_group_id);
        $this->db->delete('exam_group_exam_connections');
        }
        
        public function getExamGroupByStudent($student_id, $active = 1)
        {
        
        $this->db->select('exam_group_students.*,exam_groups.name,exam_groups.exam_type,exam_groups.exam_type')->from('exam_group_students');
        $this->db->join('exam_groups', 'exam_groups.id = exam_group_students.exam_group_id');
        $this->db->where('student_session_id', $student_id);
        $this->db->where('exam_groups.is_active', $active);
        $query = $this->db->get();
        
        return $query->result();
        }
        
        public function getExamGroupByStudentSession($student_session_id, $active = 1)
        {
        
        $this->db->select('exam_group_students.*,exam_groups.name,exam_groups.exam_type,exam_groups.exam_type')->from('exam_group_students');
        $this->db->join('exam_groups', 'exam_groups.id = exam_group_students.exam_group_id');
        $this->db->where('student_session_id', $student_session_id);
        $this->db->where('exam_groups.is_active', $active);
        $query = $this->db->get();
        
        $exam_groups  = $query->result();
        $exam_results = array();
        if (!empty($exam_groups)) {
        foreach ($exam_groups as $exam_group_key => $exam_group_value) {
        $exam_groups[$exam_group_key]->exam_group_connection = $this->getExamGroupConnection($exam_group_value->exam_group_id);
        $exam_groups[$exam_group_key]->exam_results          = $this->getExamGroupExamsResultByStudentID($exam_group_value->exam_group_id, $student_session_id);
        }
        return $exam_groups;
        }
        return false;
        }
        
        public function getExamResultStudent($exam_group_exam_id, $exam_group_id, $student_id)
        {
        
        $sql   = "SELECT `exam_group_class_batch_exam_subjects`.*,IFNULL(exam_group_student.id, 0) as exam_group_exam_result_id,exam_group_student.get_marks,exam_group_student.attendence,exam_group_student.note,subjects.id as `subject_id`,subjects.`name`,subjects.`code` FROM `exam_group_class_batch_exam_subjects` LEFT join (SELECT exam_group_exam_results.* FROM `exam_group_students` INNER JOIN exam_group_exam_results on exam_group_exam_results.exam_group_student_id = exam_group_students.id WHERE exam_group_students.exam_group_id=" . $this->db->escape($exam_group_id) . " and exam_group_students.student_session_id =" . $this->db->escape($student_id) . " ORDER BY `exam_group_id`) as `exam_group_student` on exam_group_student.exam_group_class_batch_exam_subject_id =exam_group_class_batch_exam_subjects.id INNER join subjects on subjects.id= exam_group_class_batch_exam_subjects.subject_id WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id=" . $this->db->escape($exam_group_exam_id) . " ORDER BY `exam_group_class_batch_exams_id`";
        $query = $this->db->query($sql);
        return $query->result();
        }
        
        public function getExamResultDetailStudent($exam_group_exam_id, $exam_group_id, $student_id)
        {
        
        $this->db->select('exam_groups.*')->from('exam_groups');
        
        $this->db->where('id', $exam_group_id);
        
        $query = $this->db->get();
        
        $exam_group               = $query->row();
        $exam_group->exam_results = $this->getExamResultStudent($exam_group_exam_id, $exam_group_id, $student_id);
        return $exam_group;
        }
        
        public function getExamGroupExamsResultByStudentID($exam_group_id, $student_id)
        {
        $exam_group_exams = $this->getExamByExamGroup($exam_group_id, 1);
        if (!empty($exam_group_exams)) {
        foreach ($exam_group_exams as $exam_key => $exam_value) {
        $exam_group_exams[$exam_key]->exam_results = $this->getExamResultStudent($exam_value->id, $exam_value->exam_group_id, $student_id);
        }
        }
        return $exam_group_exams;
        }
        
        
        public function getExamGroupConnection($exam_group_id)
        {
        $result_array                     = array();
        $sql                              = "SELECT exam_group_exam_connections.*,exam_group_class_batch_exams.id as `exam_group_class_batch_exam_id`,exam_group_class_batch_exams.exam,exam_group_class_batch_exams.description FROM `exam_group_exam_connections` INNER JOIN exam_group_class_batch_exams on exam_group_class_batch_exams.id = exam_group_exam_connections.exam_group_class_batch_exams_id WHERE exam_group_exam_connections.exam_group_id=" . $exam_group_id;
        $query                            = $this->db->query($sql);
        $result                           = $query->result();
        $result_array['exam_connections'] = $result;
        if (!empty($result)) {
        $sql_inner                        = "SELECT exam_group_exam_connections.*,exam_group_class_batch_exam_subjects.id as exam_group_class_batch_exam_subject_id,exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id,exam_group_class_batch_exam_subjects.subject_id,exam_group_class_batch_exam_subjects.credit_hours,exam_group_class_batch_exam_subjects.date_from,exam_group_class_batch_exam_subjects.date_from,exam_group_class_batch_exam_subjects.date_to,exam_group_class_batch_exam_subjects.room_no,exam_group_class_batch_exam_subjects.max_marks,exam_group_class_batch_exam_subjects.max_marks,subjects.name,subjects.code FROM `exam_group_exam_connections`INNER JOIN exam_group_class_batch_exams on exam_group_class_batch_exams.id=exam_group_exam_connections.exam_group_class_batch_exams_id INNER JOIN exam_group_class_batch_exam_subjects on exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id  INNER JOIN subjects on subjects.id=exam_group_class_batch_exam_subjects.subject_id WHERE exam_group_exam_connections.exam_group_id=" . $exam_group_id . " GROUP BY exam_group_class_batch_exam_subjects.subject_id";
        $query                            = $this->db->query($sql_inner);
        $result_array['connect_subjects'] = $query->result();
        }
        
        return $result_array;
        }
        
        public function getExamGroupByClassSection($class_id, $section_id, $session_id)
        {
        
        $result_array = array();
        $sql          = "SELECT student_session.*,exam_group_students.exam_group_id,exam_groups.name FROM `student_session` INNER join exam_group_students on exam_group_students.student_id=student_session.student_id INNER JOIN exam_groups on exam_groups.id=exam_group_students.exam_group_id WHERE class_id= " . $this->db->escape($class_id) . " and section_id=" . $this->db->escape($section_id) . " and session_id=" . $this->db->escape($session_id) . " GROUP BY exam_group_students.exam_group_id";
        $query        = $this->db->query($sql);
        
        $result = $query->result();
        return $result;
        }
        
        
        
        
        
        
        public function getexam_groups($student_id)
        {
        $this->db->select('*,exam_groups.name as groupname,exam_group_class_batch_exams.exam as exambatch_exam');
        
        
        
        $this->db->from('online_examination');
        
        $this->db->join('exam_groups', 'exam_groups.id  = online_examination.online_examination_examgroup');
        
        
        $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination.online_examination_exam');
        $this->db->join('subjects', 'subjects.id   = online_examination.online_examination_subject');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        
        
        
        public function get_groups($student_id)
        {
        
        $this->db->select('*,exam_groups.name as groupname,exam_group_class_batch_exams.exam as examname,subjects.name as subject');
        $this->db->from('online_examination');
        $this->db->join('exam_groups', 'exam_groups.id  = online_examination.online_examination_examgroup');
        
        $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination.online_examination_exam');
        $this->db->join('subjects', 'subjects.id  = online_examination.online_examination_subject','left');
        $this->db->where('online_examination.online_examination_student_id', $student_id);
        $query=$this->db->get();
        return $query->result_array();
        
        }
        
        public function online_examination_getsubjectlist($exam_group_id,$examid,$student_id)
        {
        $current= $this->current_session;
        
        $this->db->select('*,exam_group_class_batch_exams.id as grpid,exam_group_class_batch_exams.exam as examgrpid,
        subjects.id as subjectid,subjects.name as subject,subjects.code as subcode,exam_group_class_batch_exam_students.id as studid,exam_group_class_batch_exams.exam_group_id as grpidd');
        $this->db->from('subjects');
        $this->db->join('exam_group_class_batch_exam_subjects','exam_group_class_batch_exam_subjects.subject_id=subjects.id');
        $this->db->join('exam_group_class_batch_exam_students','exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id');
        $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=exam_group_class_batch_exam_students.exam_group_class_batch_exam_id');
        $this->db->join('student_session','student_session.student_id=exam_group_class_batch_exam_students.student_id');
        $this->db->where('exam_group_class_batch_exam_students.student_id', $student_id);
        $this->db->where('exam_group_class_batch_exams.exam_group_id', $exam_group_id);
        $this->db->where('exam_group_class_batch_exams.id', $examid);
        $this->db->where('student_session.session_id', $current);
        $this->db->group_by('exam_group_class_batch_exam_subjects.subject_id'); 
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function online_examination_getsubjectlist1($examid,$student_id)
        {
        $this->db->select('*,exam_group_class_batch_exams.id as grpid,exam_group_class_batch_exams.exam as examgrpid,
        subjects.id as subjectid,subjects.name as subject,exam_group_class_batch_exam_students.id as studid,exam_groups.id as grpidd');
        
        $this->db->from('students');
        
        $this->db->join('student_session', 'student_session.student_id=students.id');
        
        $this->db->join('classes', 'classes.id=student_session.class_id');
        
        $this->db->join('sections', 'sections.id=student_session.section_id');
        
        $this->db->join('class_sections', 'class_sections.class_id=classes.id');
        //$this->db->join('class_sections', 'class_sections.section_id=sections.id');
        
        
        $this->db->join('subject_group_class_sections', 'subject_group_class_sections.class_section_id=class_sections.id');
        
        
        
        $this->db->join('subject_group_subjects', 'subject_group_subjects.subject_group_id=subject_group_class_sections.subject_group_id');
        
        
        $this->db->join('subjects', 'subjects.id=subject_group_subjects.subject_id');
        $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id');
        
        $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id=  exam_group_class_batch_exam_students.exam_group_class_batch_exam_id');
        $this->db->join('exam_groups', 'exam_groups.id=exam_group_class_batch_exams.exam_group_id');
        
        
        $this->db->where('exam_group_class_batch_exam_students.student_id', $student_id);
        $this->db->where('exam_group_class_batch_exam_students.exam_group_class_batch_exam_id', $examid);
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        
        
        
        public function view_getsubjectlist($examgroup,$exambatch,$studentid)
        {
        
        $this->db->select('*,exam_groups.name as groupname,exam_group_class_batch_exams.exam as examname,subjects.name as subject,
        online_examination.online_examination_student_id as studid,
        online_examination.online_examination_examgroup as groupid,online_examination.online_examination_exam as exambatchid,online_examination.online_examination_subject as subj');
        
        $this->db->from('online_examination');
        $this->db->join('exam_groups', 'exam_groups.id  = online_examination.online_examination_examgroup');
        
        $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination.online_examination_exam');
        $this->db->join('subjects', 'subjects.id  = online_examination.online_examination_subject','left');
        
        $this->db->where('online_examination.online_examination_student_id', $studentid);
        $this->db->where('online_examination.online_examination_session_id',$this->current_session);
        
        $this->db->group_by('online_examination.online_examination_examgroup'); 
        $this->db->group_by('online_examination.online_examination_exam'); 
        $query=$this->db->get();
        return $query->result_array();
        } 
        
        
        
        
        
        public function get_subjectdetails_row($examgroup,$exambatch,$studentid)
        {
        
        $this->db->select('*,exam_groups.name as groupname,exam_group_class_batch_exams.exam as examname,
        online_examination.online_examination_student_id as studid,
        online_examination.online_examination_examgroup as groupid,online_examination.online_examination_exam as exambatchid,online_examination.online_examination_subject as subj');
        
        $this->db->from('online_examination');
        $this->db->join('exam_groups', 'exam_groups.id  = online_examination.online_examination_examgroup');
        
        $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination.online_examination_exam');
        
        
        $this->db->where('online_examination.online_examination_student_id', $studentid);
        
        $this->db->group_by('online_examination.online_examination_examgroup'); 
        $this->db->group_by('online_examination.online_examination_exam'); 
        $query=$this->db->get();
        return $query->row_array();
        } 
        
        
        
        
        
        public function getstud($examid,$exam_group_id,$studentid)
        {
        $this->db->select('*');
        $this->db->from('online_examination');
        $this->db->where('online_examination.online_examination_student_id', $studentid);
        $this->db->where('online_examination.online_examination_exam', $examid);
        $this->db->where('online_examination.online_examination_examgroup', $exam_group_id);
        
        $query=$this->db->get();
        return $query->result_array();
        }     
        
        
        
        
        
        public function view_attendence($studentid)
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id !=', 5);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        } 
        
        
        public function view_Studentattendence($studentid) //student side full present days
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 1);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        }       
        
        
        
        
        
        public function view_Studentattendence_halfdays($studentid) //half days
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 6);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        } 
        
        
        
        
        
        
        public function adminview_attendence($studentid) //working days
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id !=', 5);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        } 
        
        
        public function adminview_Studentattendence($studentid)    //present days
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 1);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        } 
        
        
        
        
        public function adminview_Studentattendence_late($studentid)   //late days
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 3);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        } 
        
        
        
        public function view_Studentattendence_late($studentid)   //late days
        { 
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->join('student_attendences', 'student_attendences.student_session_id  = student_session.id');
        $this->db->where('student_attendences.attendence_type_id =', 3);
        $this->db->where('students.id', $studentid);
        //$query=$this->db->get();
        //return $query->result_array();
        return $this->db->count_all_results(); 
        
        } 
        
        
        
        
        //(for 2)controlleR-> admin-> onlineexam and user
        
        public function online_exam_accept($exam_group_id,$exam_id,$student_id)
        { 
        $this->db->select('*');
        $this->db->from('online_examination_accept');
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        $this->db->where('online_examination_accept.online_examination_exam',$exam_id);
        $this->db->where('online_examination_accept.online_examination_student_id', $student_id);
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function online_exam_accept_result()
        { 
        $this->db->select('*');
        $this->db->from('online_examination_accept');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        
        
        
        public function admin_online_examination_approve($exam_group_id,$exam_id,$student_id)
        { 
        $this->db->select('*');
        $this->db->from('online_examination_accept');
        
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        $this->db->where('online_examination_accept.online_examination_exam',$exam_id);
        $this->db->where('online_examination_accept.online_examination_student_id', $student_id);
        $query=$this->db->get();
        return $query->row_array();
        } 
        
        
        public function getstudentlist_byuserID($studentid)
        { 
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id  = students.id');
        $this->db->where('students.id', $studentid);
        $query=$this->db->get();
        return $query->row_array();
        
        } 
        
        
        
        
        
        public function list_online_examination()
        {       
        
        $this->db->select('*');
        $this->db->from('students');       
        $this->db->join('student_session', 'student_session.student_id = students.id');
        
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');     
        
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->group_by('students.id'); 
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        
        
        
        
        
        public function NewlistlogindetailsId($id,$sectid,$namelist)
        {
        
        if($id=="" && $sectid=="" &&  $namelist=="") 
        {
        
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes'); 
        $this->db->group_by('students.id');     
        $query = $this->db->get();
        return $query->result_array();
        
        }
        elseif($id!="" && $sectid=="" && $namelist=="")
        {
        
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('student_session.class_id',$id);
        $this->db->group_by('students.id');
        
        
        $query = $this->db->get();
        return $query->result_array();
        }
        
        elseif($id!="" && $sectid!="" && $namelist=="")
        {
        $this->db->select('*');
        $this->db->from('students');        
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('student_session.class_id',$id);
        $this->db->where('student_session.section_id ',$sectid); 
        $this->db->group_by('students.id');       
        $query = $this->db->get();
        return $query->result_array();
        
        }
        
        
        elseif($id!="" && $sectid!="" && $namelist!="")
        {
        $this->db->select('*');
        $this->db->from('students');
        
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');    
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('student_session.class_id',$id);
        $this->db->where('student_session.section_id ',$sectid);
        $this->db->where('student_session.student_id ',$namelist);
        $this->db->group_by('students.id');
        
        $query = $this->db->get();
        return $query->result_array();
        
        }
        
        
        }
        
        
        
        
        public function list_online_exam($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {

           
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');
        $this->db->join('online_examination_accept','online_examination_accept.online_examination_exam=online_examination.online_examination_exam AND online_examination_accept.online_examination_examgroup=online_examination.online_examination_examgroup AND online_examination_accept.online_examination_student_id=online_examination.online_examination_student_id');
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        $this->db->where('online_examination_accept.online_examination_exam', $exam_id);
        $this->db->where('online_examination_accept.online_examination_session_id', $session_id);
        $this->db->where('online_examination_accept.online_examination_class_id', $class_id);
        $this->db->where('online_examination_accept.online_examination_section_id', $section_id);
        $this->db->group_by('online_examination.online_examination_student_id');
        $query = $this->db->get();
        return $query->result_array();
        }
        

        
        
        
        public function getonlineexamination($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('online_examination_accept'); 
        
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        $this->db->where('online_examination_accept.online_examination_exam', $exam_id);
        $this->db->where('online_examination_accept.online_examination_session_id', $session_id);
        $this->db->where('online_examination_accept.class_id', $class_id);
        $this->db->where('student_session.section_id', $section_id);
        $this->db->group_by('online_examination.online_examination_student_id');
        $query = $this->db->get();
        return $query->result_array();    
        }
        
        public function NewlistlogindetailsId_title($id,$sectid,$namelist)
        {
        if($id=="" && $sectid=="" &&  $namelist=="") 
        {
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('sessions', 'sessions.id = student_session.session_id');
        //$this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes'); 
        // $this->db->group_by('students.id');     
        $query = $this->db->get();
        return $query->row_array();
        
        }
        elseif($id!="" && $sectid=="" && $namelist=="")
        {
        
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('sessions', 'sessions.id = student_session.session_id');
        //$this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('student_session.class_id',$id);
        // $this->db->group_by('students.id');
        
        
        $query = $this->db->get();
        return $query->row_array();
        }
        
        elseif($id!="" && $sectid!="" && $namelist=="")
        {
        $this->db->select('*');
        $this->db->from('students');        
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('sessions', 'sessions.id = student_session.session_id');
        // $this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('student_session.class_id',$id);
        $this->db->where('student_session.section_id ',$sectid); 
        //$this->db->group_by('students.id');       
        $query = $this->db->get();
        return $query->row_array();
        
        }
        
        
        elseif($id!="" && $sectid!="" && $namelist!="")
        {
        $this->db->select('*');
        $this->db->from('students');
        
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        //$this->db->join('online_examination', 'online_examination.online_examination_student_id = student_session.student_id'); 
        $this->db->join('sessions', 'sessions.id = student_session.session_id');
        
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('student_session.class_id',$id);
        $this->db->where('student_session.section_id ',$sectid);
        $this->db->where('student_session.student_id ',$namelist);
        $this->db->group_by('students.id');
        
        $query = $this->db->get();
        return $query->row_array();
        
        }
        
        
        }
        
        
        
        
        
        
        
        
        
        
        
        public function listexam_ApprovedStatus($exam_group_id,$exam_id,$status_list)
        {              
        
        if($exam_group_id=="" && $exam_id=="" &&  $status_list=="") 
        {         
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination_accept', 'online_examination_accept.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes'); 
        
        //$this->db->where('online_examination_accept.online_examination_subject_status !=',1);
        
        $this->db->group_by('students.id');     
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        elseif($exam_group_id!="" && $exam_id=="" && $status_list=="")
        { 
        
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination_accept', 'online_examination_accept.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        //$this->db->where('online_examination_accept.online_examination_subject_status !=',1);
        
        
        $this->db->group_by('students.id'); 
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        elseif($exam_group_id!="" && $exam_id!="" && $status_list=="")
        {
        $this->db->select('*');
        $this->db->from('students');        
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination_accept', 'online_examination_accept.online_examination_student_id = student_session.student_id');   
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        $this->db->where('online_examination_accept.online_examination_exam', $exam_id);
        // $this->db->where('online_examination_accept.online_examination_subject_status !=',1);
        
        $this->db->group_by('students.id');       
        $query = $this->db->get();
        return $query->result_array();        
        }
        
        
        elseif($exam_group_id!="" && $exam_id!="" && $status_list!="")
        {
        $this->db->select('*');
        $this->db->from('students');        
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('online_examination_accept', 'online_examination_accept.online_examination_student_id = student_session.student_id');    
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('online_examination_accept.online_examination_examgroup', $exam_group_id);
        $this->db->where('online_examination_accept.online_examination_exam', $exam_id);
        // $this->db->where('online_examination_accept.online_examination_admin_approve', $status_list);
        
        $this->db->where('online_examination_accept.online_examination_subject_status !=',$status_list);
        $this->db->group_by('students.id');        
        $query = $this->db->get();
        return $query->result_array();        
        }
        
        }
        
        
        
        
        
        
        public function get_online_exam_instruction($exam_group_id,$examid)
        {
        
        
        $this->db->select('*');
        $this->db->from('online_examination_instruction');
        $this->db->join('exam_groups', 'exam_groups.id  = online_examination_instruction.online_examination_examgroup');
        $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination_instruction.online_examination_examid'); 
        $this->db->where('online_examination_instruction.online_examination_is_status',1);
        
        $this->db->where('online_examination_instruction.online_examination_examgroup',$exam_group_id);
        $this->db->where('online_examination_instruction.online_examination_examid',$examid);
        
        //$this->db->where('online_examination_instruction.online_examination_exam_type',1);
        
        $this->db->where('online_examination_current_session',$this->current_session);
        $this->db->where('online_examination_instruction.online_examination_is_status',1);
        
        $this->db->where('online_examination_instruction.online_examination_lasdate_of_exam >=', date('d-m-Y',strtotime($date)));
        
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        
        
        public function getExamByExamGroup_publishresult($id, $is_active = false)
        {
        $this->db->select('exam_group_class_batch_exams.*,sessions.session,(select COUNT(*) from exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id) as `total_subjects`')->from('exam_group_class_batch_exams');
        $this->db->join('sessions', 'sessions.id = exam_group_class_batch_exams.session_id');
        if ($is_active) 
        {
        $this->db->where('exam_group_class_batch_exams.is_active', $is_active);
        }
        $this->db->where('exam_group_class_batch_exams.exam_group_id', $id);
        $this->db->order_by('exam_group_class_batch_exams.exam_group_id');
        // $this->db->where('exam_group_class_batch_exams.is_publish=',1);
        $this->db->where('exam_group_class_batch_exams.is_active=',1);
        $query = $this->db->get();
        return $query->result();
        }
        
        
        
        public function  exam_revaluation_details($exam_id,$exam_group_id,$student_id,$section_id,$class_id,$session_id)
        {
        $this->db->select('*,exam_group_class_batch_exams.id as exmid,subjects.code as subjectcode,subjects.id as subjectid,subjects.name as subjectname,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_exam_results.get_cmarks as get_cmarks');
        
        $this->db->from ('exam_group_class_batch_exams');  
        $this->db->join('exam_group_class_batch_exam_students', 'exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id');
        $this->db->join('students', 'students.id = exam_group_class_batch_exam_students.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id = exam_group_class_batch_exams.id');
        $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_class_batch_exam_subjects.id');
        $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('exam_group_class_batch_exams.exam_group_id', $exam_group_id);
        $this->db->where('exam_group_class_batch_exams.id', $exam_id);
        $this->db->where('exam_group_class_batch_exam_students.student_id', $student_id);
        
        $this->db->where('student_session.class_id', $class_id);
        
        
        $this->db->group_by('exam_group_class_batch_exam_subjects.subject_id'); 
        $query = $this->db->get();
        return $query->result_array();
        
        }
        
        
        
        
        public function  feepayment($examgroup,$examgroupbatch,$id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('fees_payment');
        $this->db->where('fees_payment.fees_payment_examgroup', $examgroup);
        $this->db->where('fees_payment.fees_payment_exam', $examgroupbatch);
        $this->db->where('fees_payment.fees_payment_session', $this->current_session);
        $this->db->where('fees_payment.fees_payment_student_id', $id);
        $this->db->where('fees_payment.fees_payment_statuscode', 'S');
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        public function  revaluationfee_payment($examgroup,$examgroupbatch,$student_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('fees_revaluationpayment');
        $this->db->where('fees_revaluationpayment.fees_revaluationpayment_examgroup', $examgroup);
        $this->db->where('fees_revaluationpayment.fees_revaluationpayment_examgroupbatch', $examgroupbatch);
        $this->db->where('fees_revaluationpayment.fees_revaluationpayment_session_id', $session_id);
        $this->db->where('fees_revaluationpayment.fees_revaluationpayment_student_id', $student_id);
        $this->db->where('fees_revaluationpayment.fees_revaluationpayment_statuscode', 'S');
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        public function  sayexamfee_payment($examgroup,$examgroupbatch,$student_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('fees_sayexampayment');
        $this->db->where('fees_sayexampayment.fees_sayexampayment_examgroup', $examgroup);
        $this->db->where('fees_sayexampayment.fees_sayexampayment_examgroupbatch', $examgroupbatch);
        $this->db->where('fees_sayexampayment.fees_sayexampayment_session_id', $session_id);
        $this->db->where('fees_sayexampayment.fees_sayexampayment_student_id', $student_id);
        $this->db->where('fees_sayexampayment.fees_sayexampayment_statuscode', 'S');
        $this->db->where('fees_sayexampayment.exam_attempts', '2');
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        
        public function  sayexamfee_payment_temarks($examgroup,$examgroupbatch,$student_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('fees_sayexampayment_temarks');
        $this->db->where('fees_sayexampayment_temarks.fees_sayexampayment_examgroup', $examgroup);
        $this->db->where('fees_sayexampayment_temarks.fees_sayexampayment_examgroupbatch', $examgroupbatch);
        $this->db->where('fees_sayexampayment_temarks.fees_sayexampayment_session_id', $session_id);
        $this->db->where('fees_sayexampayment_temarks.fees_sayexampayment_student_id', $student_id);
        $this->db->where('fees_sayexampayment_temarks.fees_sayexampayment_statuscode', 'S');
        $this->db->where('fees_sayexampayment_temarks.exam_attempts', '2');
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function  revaluation_feechargeadmin($post_exam_id, $post_exam_group_id,$session_id)
        {  
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('examfees_charge');
        $this->db->where('examfees_charge.examfees_charge_exam',$post_exam_id );
        $this->db->where('examfees_charge.examfees_charge_examgroup', $post_exam_group_id);
        $this->db->where('examfees_charge.examfees_charge_sessionid', $session_id);
        $this->db->where('examfees_charge.examfees_charge_examoption', 'Revaluation');
        $this->db->where('examfees_charge.examfees_charge_examtype', 'Mixed');
        $this->db->where('examfees_charge.examfees_charge_exam_is_active', 1); 
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function  sayexamfee_feecharge_temarks($examgroupid,$examid)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('examfees_charge');
        $this->db->where('examfees_charge.examfees_charge_exam',$examid );
        $this->db->where('examfees_charge.examfees_charge_examgroup', $examgroupid);
        $this->db->where('examfees_charge.examfees_charge_sessionid', $this->current_session);
        $this->db->where('examfees_charge.examfees_charge_examoption', 'Sayexam');
        $this->db->where('examfees_charge.examfees_charge_examtype', 'TE');
        $this->db->where('examfees_charge.examfees_charge_exam_is_active', 1); 
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function  sayexamfee_feecharge_temarks_admin($post_exam_id, $post_exam_group_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('examfees_charge');
        $this->db->where('examfees_charge.examfees_charge_exam',$post_exam_id );
        $this->db->where('examfees_charge.examfees_charge_examgroup', $post_exam_group_id);
        $this->db->where('examfees_charge.examfees_charge_sessionid',$session_id);
        $this->db->where('examfees_charge.examfees_charge_examoption', 'Sayexam');
        $this->db->where('examfees_charge.examfees_charge_examtype', 'TE');
        $this->db->where('examfees_charge.examfees_charge_exam_is_active', 1); 
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function  sayexamfee_feecharge_cemarks($examgroupid,$examid)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('examfees_charge');
        $this->db->where('examfees_charge.examfees_charge_exam',$examid );
        $this->db->where('examfees_charge.examfees_charge_examgroup', $examgroupid);
        $this->db->where('examfees_charge.examfees_charge_sessionid', $this->current_session);
        $this->db->where('examfees_charge.examfees_charge_examoption', 'Sayexam');
        $this->db->where('examfees_charge.examfees_charge_examtype', 'CE');
        $this->db->where('examfees_charge.examfees_charge_exam_is_active', 1); 
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        public function  sayexamfee_feecharge_cemarks_admin($post_exam_id, $post_exam_group_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('examfees_charge');
        $this->db->where('examfees_charge.examfees_charge_exam',$post_exam_id );
        $this->db->where('examfees_charge.examfees_charge_examgroup', $post_exam_group_id);
        $this->db->where('examfees_charge.examfees_charge_sessionid', $session_id);
        $this->db->where('examfees_charge.examfees_charge_examoption', 'Sayexam');
        $this->db->where('examfees_charge.examfees_charge_examtype', 'CE');
        $this->db->where('examfees_charge.examfees_charge_exam_is_active', 1); 
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        public function getstudentbatch_id($exam_id,$studentid)
        {
        $this->db->select('*');
        $this->db->from('exam_group_class_batch_exam_students');
        $this->db->where('exam_group_class_batch_exam_students.exam_group_class_batch_exam_id',$exam_id);
        $this->db->where('exam_group_class_batch_exam_students.student_id',$studentid);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function getlist_NewExamGroup($examgroup,$exambatch)
        { 
        $this->db->select('*,');
        $this->db->from('exam_groups');
        $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.exam_group_id = exam_groups.id');
        $this->db->where('exam_groups.id', $examgroup);
        $this->db->where('exam_group_class_batch_exams.id', $exambatch);
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        public function  getstudent_bycategory($id,$examgroup,$examgroupbatch,$class_id,$section_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('online_examination_category,count(online_examination_category) as countcat ');
        $this->db->from('online_examination');
        $this->db->where('online_examination.online_examination_examgroup', $examgroup);
        $this->db->where('online_examination.online_examination_exam', $examgroupbatch);
        $this->db->where('online_examination.online_examination_class_id', $class_id);
        $this->db->where('online_examination.online_examination_section_id', $section_id);
        $this->db->where('online_examination.online_examination_session_id', $session_id);
        $this->db->where('online_examination.online_examination_student_id', $id);
        $this->db->group_by('online_examination.online_examination_category');
        $query = $this->db->get();
        return $query->result_array();
        } 
        
        
        public function  getstudent_applicationsubject($examgroup,$examgroupbatch,$class_id,$section_id,$session_id)
        { 
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('application_fees');
        $this->db->where('application_fees.application_fees_examgroup', $examgroup);
        $this->db->where('application_fees.application_fees_examgroupbatch', $examgroupbatch);
        
        $this->db->where('application_fees.application_fees_class', $class_id);
        $this->db->where('application_fees.application_fees_section', $section_id);
        $this->db->where('application_fees.application_fee_session', $session_id);
        
        $this->db->group_by('application_fees.application_fees_category');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function getstudent_applicationfee_value($examgroup,$examgroupbatch,$class_id,$section_id, $session_id)
        {
            
            
        $this->db->select('*');
        $this->db->from('application_examfee');
        $this->db->where('application_examfee_examgroup', $examgroup);
        $this->db->where('application_examfee_examgroupbatch', $examgroupbatch);
        $this->db->where('application_examfee_class', $class_id);
        $this->db->where('application_examfee_section', $section_id);
        $this->db->where('application_examfee_session', $session_id);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        public function getstudent_applicationfee_instruction($examgroup,$examgroupbatch,$class_id,$section_id, $session_id)
        {
        $this->db->select('*');
        $this->db->from('online_examination_instruction');
        $this->db->where('online_examination_examgroup', $examgroup);
        $this->db->where('online_examination_examid', $examgroupbatch);
        // $this->db->where('application_examfee_class', $class_id);
        // $this->db->where('application_examfee_section', $section_id);
        // $this->db->where('application_examfee_session', $session_id);
        $query = $this->db->get();
        return $query->row_array();
        
        }
        
        
        
        
        
        
        
        public function  getstudent_applicationfee($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('users', 'students.id = users.user_id', 'left');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('application_examfee', 'application_examfee.application_examfee_class = student_session.class_id','application_examfee.application_examfee_section = student_session.section_id');
        $this->db->where('application_examfee.application_examfee_session', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('students.id', $id);        
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        
        
        public function  getstudent_applicationfeebyStud($student_id,$group,$batchid,$class_id,$section_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('users', 'students.id = users.user_id', 'left');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('application_examfee', 'application_examfee.application_examfee_class = student_session.class_id','application_examfee.application_examfee_section = student_session.section_id');
        $this->db->where('application_examfee.application_examfee_examgroup', $group);
        $this->db->where('application_examfee.application_examfee_examgroupbatch', $batchid);
        $this->db->where('application_examfee.application_examfee_class', $class_id); 
        $this->db->where('application_examfee.application_examfee_section', $section_id);
        $this->db->where('application_examfee.application_examfee_session', $session_id);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('students.id', $student_id);        
        $query = $this->db->get();
        return $query->row_array();
        
        }
        
        
        
        
        
        
        
        public function  fees_payment_receipt($student_id,$group,$batchid,$class_id,$section_id,$session_id)
        {
        $this->db->select('*');
        $this->db->from('fees_payment');
        $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=fees_payment.fees_payment_exam');
        $this->db->where('fees_payment.fees_payment_examgroup', $group);
        $this->db->where('fees_payment.fees_payment_exam', $batchid);
        $this->db->where('fees_payment.fees_payment_class_id', $class_id);
        $this->db->where('fees_payment.fees_payment_section_id', $section_id);
        $this->db->where('fees_payment.fees_payment_session', $session_id);
        $this->db->where('fees_payment.fees_payment_student_id', $student_id);
        $this->db->where('fees_payment.fees_payment_statuscode', 'S');
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        
        public function getstudentdetails($students_id)
        {
        $this->db->select('student_session.transport_fees,students.app_key,students.vehroute_id,vehicle_routes.route_id,vehicle_routes.vehicle_id,transport_route.route_title,vehicles.vehicle_no,hostel_rooms.room_no,vehicles.driver_name,vehicles.driver_contact,hostel.id as `hostel_id`,hostel.hostel_name,room_types.id as `room_type_id`,room_types.room_type ,students.hostel_room_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,class_sections.id as `class_section_id`,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,students.middlename,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode , students.note, students.religion, students.cast, school_houses.house_name,   students.dob ,students.current_address, students.previous_school,
        students.guardian_is,students.parent_id,
        students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.father_pic ,students.height ,students.weight,students.measurement_date, students.mother_pic , students.guardian_pic , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.blood_group,students.school_house_id,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.rte,students.guardian_email, users.username,users.password,students.dis_reason,students.dis_note,students.app_key,students.parent_app_key')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('class_sections', 'class_sections.class_id = classes.id and class_sections.section_id = sections.id');
        $this->db->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id', 'left');
        $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
        $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
        $this->db->join('vehicle_routes', 'vehicle_routes.id = students.vehroute_id', 'left');
        $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
        $this->db->join('school_houses', 'school_houses.id = students.school_house_id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('users.role', 'student');
        $this->db->where('students.id', $students_id);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function  fees_transaction($student_id,$group,$batchid,$class_id,$section_id,$session_id)
        {
        $this->db->select('*');
        $this->db->from('fees_payment');
        $this->db->where('fees_payment.fees_payment_examgroup', $group);
        $this->db->where('fees_payment.fees_payment_exam', $batchid);
        $this->db->where('fees_payment.fees_payment_class_id', $class_id);
        $this->db->where('fees_payment.fees_payment_section_id', $section_id);
        $this->db->where('fees_payment.fees_payment_session', $session_id);
        $this->db->where('fees_payment.fees_payment_student_id', $student_id);
        $this->db->where('fees_payment.fees_payment_statuscode', 'S');
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        
        public function  classteacher($class_id,$section_id,$session_id)
        {
        $this->db->select('*');
        $this->db->from('class_teacher');
        $this->db->join('staff', 'staff.id = class_teacher.staff_id');
        $this->db->where('class_teacher.class_id', 	$class_id);
        $this->db->where('class_teacher.section_id', $section_id);
        $this->db->where('class_teacher.session_id', $session_id);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function  adminrole()
        {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where(array('is_active'=> 1,'designation'=>1));
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        public function  getsession()
        {
        $this->db->select('*');
        $this->db->from('sessions');
        $this->db->join('sch_settings', 'sch_settings.session_id = sessions.id');
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        public function online_exam_update_fees($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('fees_payment');
        $this->db->where('fees_payment_examgroup', $exam_group_id);
        $this->db->where('fees_payment_exam', $exam_id);
        $this->db->where('fees_payment_session', $session_id);
        $this->db->where('fees_payment_class_id', $class_id);
        $this->db->where('fees_payment_section_id', $section_id);
        $query = $this->db->get();
        return $query->result_array();
        }
        
        public function getExamBy_session($session_id)
        {
        $this->db->select('*');
        $this->db->from('sessions');
        $this->db->where('id', $session_id);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function getExamBy_class($class_id)
        {
        $this->db->select('*');
        $this->db->from('classes');
        $this->db->where('id', $class_id);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        public function getExamBy_section($section_id)
        {
        $this->db->select('*');
        $this->db->from('sections');
        $this->db->where('id', $section_id);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function getExamstudent($stud_id)
        {
        $this->db->select('students.*,student_session.id as student_sessionid');
        $this->db->from('students');
        $this->db->join('student_session','student_session.student_id=students.id');
        $this->db->where(array('students.id'=> $stud_id,'student_session.session_id'=>$this->current_session));
        $query = $this->db->get();
        return $query->row_array();  
        }
        
        
         public function getstudent_NewExamGroup($examgroup,$exambatch)
        { 
        $this->db->select('*,');
        $this->db->from('exam_groups');
        $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.exam_group_id = exam_groups.id');
        $this->db->where('exam_groups.id', $examgroup);
        $this->db->where('exam_group_class_batch_exams.id', $exambatch);
        $query = $this->db->get();
        return $query->row();
        } 
        
        public function update_value($approvedstatus,$studid,$group,$exambatchid,$class_id,$section_id)
        {
        $sql="UPDATE `online_examination_accept` SET `online_examination_admin_approve`=$approvedstatus WHERE online_examination_student_id='" . $studid . "'  and online_examination_examgroup='" . $group . "' and online_examination_exam='" . $exambatchid . "' and online_examination_session_id='" . $this->current_session . "' and online_examination_class_id='" . $class_id . "' and online_examination_section_id='" . $section_id . "' ";
        $this->db->query($sql); 
        }



        public function update_value_staff($approvedstatus,$studid,$group,$exambatchid,$class_id,$section_id)
        {
        $sql="UPDATE `online_examination_accept` SET `online_examination_subject_status`=$approvedstatus WHERE online_examination_student_id='" . $studid . "'  and online_examination_examgroup='" . $group . "' and online_examination_exam='" . $exambatchid . "' and online_examination_session_id='" . $this->current_session . "' and online_examination_class_id='" . $class_id . "' and online_examination_section_id='" . $section_id . "' ";
        $this->db->query($sql); 
        }
        
        
        public function attendence_percentage($group,$batchid,$session_id)
        { 
        $this->db->select('*,');
        $this->db->from('online_examination_attendence_settings');
        $this->db->where('online_examination_attendence_settings.online_examination_examgroup', $group);
        $this->db->where('online_examination_attendence_settings.online_examination_examid', $batchid);
        $this->db->where('online_examination_attendence_settings.online_examination_current_session', $session_id);
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
       /*..............................Revaluation Payment .......................*/ 
        
        public function list_online_exam_revaluation($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('exam_group_exam_revaluation', 'exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid = student_session.student_id');
        $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examgroupid', $exam_group_id);
        $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_examid', $exam_id);
        $this->db->where('exam_group_exam_revaluation.exam_group_exam_revaluation_session_id', $session_id);
        $this->db->group_by('exam_group_exam_revaluation.exam_group_exam_revaluation_student_studentid');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        public function online_exam_update_fees_rev($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('fees_revaluationpayment');
        $this->db->where('fees_revaluationpayment_examgroupbatch', $exam_group_id);
        $this->db->where('fees_revaluationpayment_examgroup', $exam_id);
        $this->db->where('fees_revaluationpayment_session_id', $session_id);
        $this->db->where('fees_revaluationpayment_class_id', $class_id);
        $this->db->where('fees_revaluationpayment_section_id', $section_id);
        $query = $this->db->get();
        return $query->result_array();
        }
        
        /*................Say Exam TE Payment.....................................*/
        
        public function list_online_exam_sayexamte($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        
        $this->db->join('exam_group_exam_sayexam_temarks', 'exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid = student_session.student_id');
        $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examgroupid', $exam_group_id);
        $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_examid', $exam_id);
        $this->db->where('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_session_id', $session_id);
        $this->db->group_by('exam_group_exam_sayexam_temarks.exam_group_exam_sayexam_student_studentid');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function online_exam_update_fees_sayexamte($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('fees_sayexampayment_temarks');
        $this->db->where('fees_sayexampayment_examgroupbatch', $exam_group_id);
        $this->db->where('fees_sayexampayment_examgroup', $exam_id);
        $this->db->where('fees_sayexampayment_session_id', $session_id);
        $this->db->where('fees_sayexampayment_class_id', $class_id);
        $this->db->where('fees_sayexampayment_section_id', $section_id);
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        /*............Say Exam Payment.....................................*/
        
        public function list_online_exam_sayexam($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('exam_group_exam_sayexam', 'exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid = student_session.student_id');
        $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examgroupid', $exam_group_id);
        $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_examid', $exam_id);
        $this->db->where('exam_group_exam_sayexam.exam_group_exam_sayexam_session_id', $session_id);
        $this->db->group_by('exam_group_exam_sayexam.exam_group_exam_sayexam_student_studentid');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function online_exam_update_fees_sayexam($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('fees_sayexampayment');
        $this->db->where('fees_sayexampayment_examgroupbatch', $exam_group_id);
        $this->db->where('fees_sayexampayment_examgroup', $exam_id);
        $this->db->where('fees_sayexampayment_session_id', $session_id);
        $this->db->where('fees_sayexampayment_class_id', $class_id);
        $this->db->where('fees_sayexampayment_section_id', $section_id);
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
         /*....................................Improvement Payment................................*/ 
        
        public function list_online_exam_improvement($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('students'); 
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('exam_group_exam_improvement', 'exam_group_exam_improvement.exam_group_exam_improvement_student_studentid = student_session.student_id');
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid', $exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid', $exam_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_session_id', $session_id);
        $this->db->group_by('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        public function online_exam_update_fees_improvement($exam_group_id,$exam_id,$session_id,$class_id,$section_id)
        {
        $this->db->select('*');
        $this->db->from('fees_improvementpayment');
        $this->db->where('fees_improvementpayment_examgroupbatch', $exam_group_id);
        $this->db->where('fees_improvementpayment_examgroup', $exam_id);
        $this->db->where('fees_improvementpayment_session_id', $session_id);
        $this->db->where('fees_improvementpayment_class_id', $class_id);
        $this->db->where('fees_improvementpayment_section_id', $section_id);
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        
        public function getrolebased_publish($examgroup,$exambatch)
        {
        $this->db->select('*,');
        $this->db->from('exam_group_class_batch_exams');
        $this->db->where('exam_group_class_batch_exams.id', $examgroup);
        $this->db->where('exam_group_class_batch_exams.exam_group_id', $exambatch);
        // $this->db->where('exam_group_class_batch_exams.is_publish', 0);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        }