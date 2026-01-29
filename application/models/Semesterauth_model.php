            <?php

            if (!defined('BASEPATH'))
            exit('No direct script access allowed');

            class Semesterauth_model extends MY_Model 
            {
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            $this->load->library('Customlib');
            }  
            
            
            public function getExamByExamGroup($id)
            {
            $this->db->select('*');
            $this->db->from('exam_group_class_batch_exams');
            $this->db->where('exam_group_class_batch_exams.exam_group_id', $id);
            $this->db->order_by('exam_group_class_batch_exams.id');
            $query = $this->db->get();
            return $query->result_array();
            }


            public function getStudentsAdmitCardByExamAndStudentID($student_id, $exam_group_class_batch_exam_id, $semgroup_id)
            {
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
            $this->db->where('semester_student_tbl.sem_student_id', $student_id);

            $this->db->order_by('semester_students.firstname', 'ASC');
            $query = $this->db->get();

            // Group rows per student (only one student now)
            $rows = $query->result_array();
            $grouped = [];
            if (!empty($rows)) {
            $grouped[$student_id] = $rows;
            }

            return $grouped;
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


//////////////////////////////Timetable................................


                    public function getSemesterTimetable($sem_group_id)
                    {                      
                    $this->db->select('
                    tb_day,
                    tb_time_from,
                    tb_time_to,
                    subjects.name as subject_name
                    ');
                    $this->db->from('semester_timetable');
                     $this->db->join('subjects','subjects.id = 	semester_timetable.tb_subname','left');
                    // $this->db->where('tb_semester_group', $sem_group_id);

                    $this->db->where('tb_batch', $sem_group_id);

                    $this->db->where('tb_status', 1);
                    $this->db->order_by('tb_time_from', 'ASC');

                    return $this->db->get()->result();
                    }




//////////////////////////////Apply Leave................................................


                    public function applyleavelist($student_id,$sem_group_id)
                    {
                    $this->db->select('*');
                    $this->db->from('sem_student_applyleave');                   
                    $this->db->where('sem_student_id', $student_id);  
                    $this->db->where('sem_group_id', $sem_group_id);                  
                    $this->db->where('status', 1);
                    $this->db->order_by('id', 'ASC');
                    $query = $this->db->get();
                    return $query->result_array();   
                    }

//////////////////////////////////HomeWork................................................

                   public function homeworklist($student_id,$sem_group_id)
                    { 
                    $this->db->select('*,sem_homework.id as sem_homwork_id,sem_homework_evaluation.id as eval_id');
                    $this->db->from('sem_homework');  
                    $this->db->join('sem_homework_evaluation','sem_homework_evaluation.homework_id=sem_homework.id'); 
                    $this->db->join('semester_group', 'semester_group.sem_group_id = sem_homework.sem_group_id', 'left');
                    $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');
                    $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');
                    $this->db->join('programee', 'programee.id = semester_group.sem_group_program', 'left');
                    $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left');                    
                    $this->db->join('subjects', 'subjects.id = sem_homework.subject_id', 'left');
                    $this->db->where('sem_homework_evaluation.student_id', $student_id);  
                    $this->db->where('sem_homework.sem_group_id', $sem_group_id); 
                    $this->db->order_by('sem_homework.id', 'ASC');
                    $query = $this->db->get();
                    return $query->result_array();   
                    }
                    
                    
/////////////////////////Date Wise Attendence/////////////////////////////////////////////




                    public function get_datewise_attendence($student_id,$sem_group_id)
                    {
                    $this->db->select('*');
                    $this->db->from('semester_attendance');
                    $this->db->join('semester_students','semester_students.id=semester_attendance.attend_student_id'); 
                    $this->db->join('semester_student_session','semester_student_session.student_id=semester_students.id'); 
                    $this->db->join('semester_group', 'semester_group.sem_group_id = semester_attendance.attend_group_id', 'left');
                    $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');
                    $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');
                    $this->db->join('programee', 'programee.id = semester_group.sem_group_program', 'left');
                    $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left');                    
                    // $this->db->join('subjects', 'subjects.id = sem_homework.subject_id', 'left');
                    $this->db->where('semester_attendance.attend_student_id', $student_id);  
                    $this->db->where('semester_attendance.attend_group_id', $sem_group_id); 
                    // $this->db->order_by('semester_attendance.attend_id', 'ASC');
                    $query = $this->db->get();
                    return $query->result_array();                         
                    }

                  

                    public function get_datewise($student_id, $sem_group_id, $fromdate = null, $todate = null)
                    {
                    $this->db->select('*');
                    $this->db->from(' semester_attendance'); // Replace with your actual table name
                    $this->db->where('attend_student_id', $student_id);
                    $this->db->where('attend_group_id', $sem_group_id);

                    // Apply date filters if provided
                    if (!empty($fromdate)) {
                    $this->db->where('attend_date >=', $fromdate);
                    }

                    if (!empty($todate)) {
                    $this->db->where('attend_date <=', $todate);
                    }

                    $this->db->order_by('attend_date', 'DESC');

                    $query = $this->db->get();
                    return $query->result_array();
                    }



                    ////////////////////////////////////////////////////////////////


                    public function get_period_datewise001($student_id, $sem_group_id, $fromdate = null, $todate = null)
                    {
                    $this->db->select('*');
                    $this->db->from('sem_student_subject_attendances'); 
                    $this->db->join('semester_students','semester_students.id=sem_student_subject_attendances.student_session_id'); 
                    $this->db->join('semester_student_session','semester_student_session.student_id=semester_students.id');
                    $this->db->join('periodic_table','periodic_table.periodic_table_id=sem_student_subject_attendances.subject_timetable_id');


                    $this->db->where('sem_student_subject_attendances.student_session_id', $student_id);
                    $this->db->where('attend_group_id', $sem_group_id);
                    
                    if (!empty($fromdate)) {
                    $this->db->where('attend_date >=', $fromdate);
                    }

                    if (!empty($todate)) {
                    $this->db->where('attend_date <=', $todate);
                    }

                    $this->db->order_by('attend_date', 'DESC');

                    $query = $this->db->get();
                    return $query->result_array();

                    }



                    public function get_period_datewise($student_id, $sem_group_id, $fromdate = null, $todate = null)
                    {
                    $this->db->select('
                    sem_student_subject_attendances.attend_date,
                    sem_student_subject_attendances.attendence_type_id,
                    sem_student_subject_attendances.attend_notes,
                    periodic_table.periodic_table_id,
                    periodic_table.periodic_table_name,
                    periodic_table.periodic_table_timefrom,
                    periodic_table.periodic_table_timeto,
                    periodic_table.periodic_table_count
                    ');
                    $this->db->from('sem_student_subject_attendances');
                    $this->db->join(
                    'periodic_table',
                    'periodic_table.periodic_table_id = sem_student_subject_attendances.subject_timetable_id'
                    );

                    $this->db->where('sem_student_subject_attendances.student_session_id', $student_id);
                    $this->db->where('sem_student_subject_attendances.attend_group_id', $sem_group_id);

                    if (!empty($fromdate)) {
                    $this->db->where('attend_date >=', $fromdate);
                    }
                    if (!empty($todate)) {
                    $this->db->where('attend_date <=', $todate);
                    }

                    $this->db->order_by('attend_date', 'ASC');
                    $this->db->order_by('periodic_table.periodic_table_count', 'ASC');

                    return $this->db->get()->result_array();
                    }



                public function get_all_periods()
                {
                return $this->db
                ->order_by('periodic_table_id', 'ASC')
                ->get('periodic_table')
                ->result_array();
                }




                    }



                 



                    
                


            


