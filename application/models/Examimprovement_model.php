        <?php
        
        if (!defined('BASEPATH'))
        {
        exit('No direct script access allowed');
        }
        
        class Examimprovement_model extends CI_Model 
        {
        
        public function __construct()
        {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        }
        
        public function getimprovement_subjectfor_teachers1($post_exam_id, $post_exam_group_id, $class_id, $section_id,$session_id)
        {
        $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_improvement.exam_group_exam_improvement_id as exam_group_exam_improvement_id,exam_group_exam_results.id as resultid,exam_group_exam_improvement.exam_group_exam_improvement_examid as exam_group_exam_improvement_examid,exam_group_exam_improvement.exam_group_exam_improvement_examgroupid as exam_group_exam_improvement_examgroupid,exam_group_exam_improvement.exam_group_exam_improvement_studentid as exam_group_exam_improvement_studentid');
        $this->db->from('exam_group_exam_improvement');
        $this->db->join('students', 'students.id  = exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_improvement.exam_group_exam_improvement_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_improvement.exam_group_exam_improvement_subject_id');
        $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');
        $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
        $this->db->where('student_session.session_id',  $this->current_session);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid',  $post_exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid',  $post_exam_id);
        $this->db->where('student_session.class_id', $class_id);
        $this->db->where('student_session.section_id', $section_id);
        $this->db->where('student_session.session_id', $session_id);
        $this->db->group_by('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        
        public function getimprovement_subjectfor_teachers($post_exam_id, $post_exam_group_id, $class_id, $section_id, $session_id)
        {
        $this->db->select('
        *,
        students.id as Studentid,
        subjects.code as code,
        subjects.name as name,
        exam_group_exam_results.get_cmarks as get_cmarks,
        exam_group_exam_results.get_marks as get_marks,
        exam_group_class_batch_exam_subjects.max_marks as max_marks,
        exam_group_class_batch_exam_subjects.min_marks as min_marks,
        exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,
        exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,
        exam_group_exam_improvement.exam_group_exam_improvement_id as exam_group_exam_improvement_id,
        exam_group_exam_results.id as resultid,
        exam_group_exam_improvement.exam_group_exam_improvement_examid as exam_group_exam_improvement_examid,
        exam_group_exam_improvement.exam_group_exam_improvement_examgroupid as exam_group_exam_improvement_examgroupid,
        exam_group_exam_improvement.exam_group_exam_improvement_studentid as exam_group_exam_improvement_studentid,
        fees_improvementpayment.fees_improvementpayment_statuscode as payment_statuscode
        ');
        $this->db->from('exam_group_exam_improvement');
        $this->db->join('students', 'students.id = exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'classes.id = student_session.class_id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id = exam_group_exam_improvement.exam_group_exam_improvement_studentid AND exam_group_exam_results.exam_group_class_batch_exam_subject_id = exam_group_exam_improvement.exam_group_exam_improvement_subject_id');
        $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id');
        $this->db->join('subjects', 'subjects.id = exam_group_class_batch_exam_subjects.subject_id');
        
      
        $this->db->join('fees_improvementpayment', 
        'fees_improvementpayment.fees_improvementpayment_examgroup = exam_group_exam_improvement.exam_group_exam_improvement_examid
        AND fees_improvementpayment.fees_improvementpayment_examgroupbatch = exam_group_exam_improvement.exam_group_exam_improvement_examgroupid
        AND fees_improvementpayment.fees_improvementpayment_class_id = student_session.class_id
        AND fees_improvementpayment.fees_improvementpayment_section_id = student_session.section_id
        AND fees_improvementpayment.fees_improvementpayment_session_id = student_session.session_id
        AND fees_improvementpayment.fees_improvementpayment_student_id = students.id',
        'left'
        );
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid', $post_exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid', $post_exam_id);
        $this->db->where('student_session.class_id', $class_id);
        $this->db->where('student_session.section_id', $section_id);
        $this->db->where('student_session.session_id', $session_id);
        $this->db->group_by('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $query = $this->db->get();
        return $query->result_array();
        }

        
        
        public function improvement_approvedbyadmin($exam_group_id, $exam_id)
        {
        $student_id = $this->customlib->getStudentSessionUserID();
        $this->db->select('*');
        $this->db->from ('exam_group_exam_improvement');
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid', $exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid', $exam_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid', $student_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_status',1  );
        $this->db->group_by('exam_group_exam_improvement.exam_group_exam_improvement_studentid');
        $query = $this->db->get();
        return $query->row_array();        
        }
        
        
        public function getstud_improvement($exam_group_id, $exam_id)
        {
        $student_id = $this->customlib->getStudentSessionUserID();
        $this->db->select('*');
        $this->db->from('exam_group_exam_improvement');
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid', $exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid', $exam_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid', $student_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_status',1  );
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function getimprovement_marks($post_exam_id, $post_exam_group_id,$student_id)
        { 
        $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_improvement.exam_group_exam_improvement_id as exam_group_exam_improvement_id,exam_group_exam_results.id as resultid,exam_group_exam_improvement.get_marks as gtmark,exam_group_exam_improvement.get_cmarks as gtcmark');
        $this->db->from('exam_group_exam_improvement');
        $this->db->join('students', 'students.id  = exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
        $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_improvement.exam_group_exam_improvement_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_improvement.exam_group_exam_improvement_subject_id');
        $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');
        $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
        $this->db->where('student_session.session_id',  $this->current_session);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid',  $student_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid',  $post_exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid',  $post_exam_id);
        $this->db->group_by('subjects.code');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        public function improvementfee_payment($examgroup,$examgroupbatch,$student_id,$session_id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('fees_improvementpayment');
        $this->db->where('fees_improvementpayment.fees_improvementpayment_examgroup', $examgroup);
        $this->db->where('fees_improvementpayment.fees_improvementpayment_examgroupbatch', $examgroupbatch);
        $this->db->where('fees_improvementpayment.fees_improvementpayment_session_id', $session_id);
        $this->db->where('fees_improvementpayment.fees_improvementpayment_student_id', $student_id);
        $this->db->where('fees_improvementpayment.fees_improvementpayment_statuscode', 'S');
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        public function improvementfee_feecharge($examgroupid,$examid)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->db->select('*');
        $this->db->from('examfees_charge');
        $this->db->where('examfees_charge.examfees_charge_exam',$examid );
        $this->db->where('examfees_charge.examfees_charge_examgroup', $examgroupid);
        $this->db->where('examfees_charge.examfees_charge_sessionid', $this->current_session);
        $this->db->where('examfees_charge.examfees_charge_examoption', 'Improvement');
        $this->db->where('examfees_charge.examfees_charge_examtype', 'TE');
        $this->db->where('examfees_charge.examfees_charge_exam_is_active', 1); 
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function getimprovement_subjectfor_Marks($post_exam_id, $post_exam_group_id,$students_array)
        {
        $this->db->select('*,students.id as Studentid,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_improvement.exam_group_exam_improvement_id as exam_group_exam_improvement_id,exam_group_exam_results.id as resultid,exam_group_exam_improvement.exam_group_exam_improvement_examid as exam_group_exam_improvement_examid,exam_group_exam_improvement.exam_group_exam_improvement_examgroupid as exam_group_exam_improvement_examgroupid,exam_group_exam_improvement.exam_group_exam_improvement_studentid as exam_group_exam_improvement_studentid');
        $this->db->from('exam_group_exam_improvement');
        $this->db->join('students', 'students.id  = exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_improvement.exam_group_exam_improvement_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_improvement.exam_group_exam_improvement_subject_id');
        $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id');
        $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
        $this->db->where('student_session.session_id',  $this->current_session);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid',  $post_exam_group_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid',  $post_exam_id);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_studentid',  $students_array);
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        public function improvement_approved_status($post_exam_id, $post_exam_group_id, $students_array)
        {  
        $this->db->select('*');
        $this->db->from('exam_group_exam_improvement');
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid',$post_exam_id  );
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid',$post_exam_group_id );
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_studentid',$students_array);
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_status',1  );
        $this->db->group_by('exam_group_exam_improvement.exam_group_exam_improvement_studentid');
        $query=$this->db->get();
        return $query->row_array();
        }
        
        
         public function admin_get_improvement_students($post_exam_id, $post_exam_group_id,$students_array)
        {
        $student_details = array();
        if (!empty($students_array)) {
        foreach ($students_array as $student_key => $student_value)
        {
        $student_details[] = $this->admin_getimprovement_marks($post_exam_id, $post_exam_group_id,$student_value);
        }
        }
        return $student_details;
        }
        
        
        public function admin_getimprovement_marks($post_exam_id, $post_exam_group_id,$students_array)
        {   
        
        $this->db->select('*,subjects.code as code,subjects.name as name,exam_group_exam_results.get_cmarks as get_cmarks,exam_group_exam_results.get_marks as get_marks,exam_group_class_batch_exam_subjects.max_marks as max_marks,exam_group_class_batch_exam_subjects.min_marks as min_marks,exam_group_class_batch_exam_subjects.max_cmarks as max_cmarks,exam_group_class_batch_exam_subjects.min_cmarks as min_cmarks,exam_group_exam_improvement.exam_group_exam_improvement_id as exam_group_exam_improvement_id,exam_group_exam_results.id as resultid,exam_group_exam_improvement.get_marks as gtmark,exam_group_exam_improvement.get_cmarks as gtcmark');
        
        $this->db->from('exam_group_exam_improvement');
        $this->db->join('students', 'students.id  = exam_group_exam_improvement.exam_group_exam_improvement_student_studentid');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        
        $this->db->join('classes', 'classes.id=student_session.class_id');
        
        $this->db->join('sections', 'sections.id=student_session.section_id');
        
        $this->db->join('class_teacher', 'class_teacher.class_id=classes.id');
        $this->db->join('exam_group_exam_results', 'exam_group_exam_results.exam_group_class_batch_exam_student_id=exam_group_exam_improvement.exam_group_exam_improvement_studentid and exam_group_exam_results.exam_group_class_batch_exam_subject_id=exam_group_exam_improvement.exam_group_exam_improvement_subject_id');
        $this->db->join('exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exam_subjects.id=exam_group_exam_results.   exam_group_class_batch_exam_subject_id');
        
        $this->db->join('subjects', 'subjects.id=exam_group_class_batch_exam_subjects.subject_id');
        
        $this->db->where('student_session.session_id',  $this->current_session);
        
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_student_studentid',  $students_array);
        
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examgroupid',  $post_exam_group_id);
        
        $this->db->where('exam_group_exam_improvement.exam_group_exam_improvement_examid',  $post_exam_id);
        
        $this->db->group_by('subjects.code');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        
        
        
        }
