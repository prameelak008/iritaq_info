            <?php

            if (!defined('BASEPATH'))
            exit('No direct script access allowed');


            class Semester_user_model extends MY_Model 
            {
            public function __construct() {
            parent::__construct();
            // $this->current_session = $this->setting_model->getCurrentSession();
            $this->load->library('Customlib');
            }  
            


            public function get_students($student_id)
            {  
            $this->db->select('*');
            $this->db->from('semester_students');
            $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id');
            // $this->db->join('semester_studentdetails', 'semester_studentdetails.stud_student_id = semester_student_tbl.sem_student_id', 'left');
            $this->db->join('semester_group', 'semester_group.sem_group_id = semester_student_session.sem_group_id', 'left');
            $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');
            $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');
            $this->db->join('programee', 'programee.id = semester_group.sem_group_program', 'left');
            $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left'); 
            $this->db->where('semester_student_session.student_id', $student_id);
            $this->db->where('semester_student_session.promote', 1);
            $this->db->order_by('semester_students.firstname', 'ASC');
            $query = $this->db->get();     
            return $query->row();           
            }



        ///////////////////////////Exam Schedule..........................................

            public function studentExams($student_session_id, $sem_group_id)
            {
            $sql        = "SELECT semester_student_tbl.*,exam_group_class_batch_exams.id as `exam_group_class_batch_exam_id`,exam_group_class_batch_exams.exam FROM `semester_student_tbl` INNER JOIN exam_group_class_batch_exams on semester_student_tbl.sem_exam_exam_id	=exam_group_class_batch_exams.id WHERE 	sem_student_id=" . $this->db->escape($student_session_id) . " and exam_group_class_batch_exams.is_active=1";       
            $query      = $this->db->query($sql);
            return $query->result();
            } 


            public function getExamstudentSubjects($id = null) 
            {
            $this->db->select('semester_exam_subjects.*,subjects.name as `subject_name`,subjects.code as `subject_code`,subjects.type as `subject_type`')->from('semester_exam_subjects');
            $this->db->join('subjects', 'subjects.id = semester_exam_subjects.subject_id');
            $this->db->where('semester_exam_subjects.exam_group_class_batch_exams_id', $id);
            $this->db->group_by('semester_exam_subjects.subject_id');
            $this->db->order_by('semester_exam_subjects.date_from');
            $this->db->order_by('date_from');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
            }

           ///////////////////////////Exam Application..........................................


            public function get_exam_instructions001($exam_group_id, $exam_id)
            {
            $this->db->select('*');
            $this->db->from('sem_exam_instruction');         
            $this->db->join('exam_groups', 'exam_groups.id = sem_exam_instruction.sem_exam_examgroup');
            $this->db->join('sem_fees_charge', 'sem_fees_charge.sem_fees_title = sem_exam_instruction.sem_exam_id','left');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id = sem_exam_instruction.sem_exam_examid');
            $this->db->where('sem_exam_instruction.sem_exam_examgroup', $exam_group_id);
            $this->db->where('sem_exam_instruction.sem_exam_examid', $exam_id);
            $query = $this->db->get();
            return $query->row_array();            
            }




            public function get_exam_instructions002($exam_group_id, $exam_id)
{
    // 1) MAIN EXAM DATA
    $this->db->select('*');
    $this->db->from('sem_exam_instruction');         
    $this->db->join('exam_groups', 'exam_groups.id = sem_exam_instruction.sem_exam_examgroup');
    $this->db->join('sem_fees_charge', 'sem_fees_charge.sem_fees_title = sem_exam_instruction.sem_exam_id','left');
    $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id = sem_exam_instruction.sem_exam_examid');

    $this->db->where('sem_exam_instruction.sem_exam_examgroup', $exam_group_id);
    $this->db->where('sem_exam_instruction.sem_exam_examid', $exam_id);

    $exam = $this->db->get()->row_array();

    // ⚠️ If no exam found → avoid error
    if(!$exam){
        return [
            'exam' => [],
            'subjects' => []
        ];
    }

    // 2) SUBJECT LIST
    $this->db->select('
        sem_subject_charge.*,
        subjects.id as subject_id,
        subjects.name as subject_name,
        subjects.arabic_name,
        subjects.code,
        subjects.type
    ');
    $this->db->from('sem_subject_charge');
    $this->db->join('subjects', 'subjects.id = sem_subject_charge.inst_sem_subject_id', 'left');

    $this->db->where('sem_subject_charge.inst_sem_group', $exam_group_id);
    $this->db->where('sem_subject_charge.inst_sem_title', $exam['sem_exam_id']);

    $subjects = $this->db->get()->result_array();

    return [
        'exam' => $exam,
        'subjects' => $subjects
    ];
}



            public function get_exam_instructions($exam_group_id, $exam_id)
            {
            $today=date('d-m-Y');
            // Get main exam instruction + exam group + fee
            $this->db->select('sem_exam_instruction.*, exam_groups.*, sem_fees_charge.*, exam_group_class_batch_exams.*');
            $this->db->from('sem_exam_instruction');
            $this->db->join('exam_groups', 'exam_groups.id = sem_exam_instruction.sem_exam_examgroup');
            $this->db->join('sem_fees_charge', 'sem_fees_charge.sem_fees_title = sem_exam_instruction.sem_exam_id', 'left');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id = sem_exam_instruction.sem_exam_examid');
            $this->db->where('sem_exam_instruction.sem_exam_examgroup', $exam_group_id);
            $this->db->where('sem_exam_instruction.sem_exam_examid', $exam_id);
            $this->db->where('sem_exam_instruction.sem_exam_examid', $exam_id);            
            // $this->db->where('sem_exam_instruction.sem_exam_publishdate >=', $today);
            $this->db->where('sem_exam_instruction.sem_exam_option =', 1);
            $this->db->where('sem_exam_instruction.sem_exam_optiontype =', 3);
            $this->db->where('exam_group_class_batch_exams.is_active =', 1);
            $exam = $this->db->get()->row_array();

            // IMPORTANT: Get semester group from exam_group_class_batch_exams
            //     $semester_group = $exam['semester_group_id']; // adjust name if different
            //     echo $semester_group;

            // Get subject list (JOIN subjects)
            $this->db->select('sem_subject_charge.*, subjects.*');
            $this->db->from('sem_subject_charge');
            $this->db->join('subjects', 'subjects.id = sem_subject_charge.inst_sem_subject_id');
            $this->db->where('sem_subject_charge.inst_sem_title', $exam['sem_exam_id']);
            // $this->db->where('sem_subject_charge.inst_sem_group', $semester_group);

            $subjects = $this->db->get()->result_array();
            $exam['subjects'] = $subjects;
            return $exam;
            }


        

        }


