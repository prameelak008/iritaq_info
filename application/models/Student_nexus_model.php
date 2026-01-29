            <?php

            if (!defined('BASEPATH'))
            exit('No direct script access allowed');


            class Student_nexus_model extends MY_Model 
            {
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }  
            
            


            public function get_homeworklist($sem_group_id)
            {               
            $this->db->select('*,semester_subject_groups.name as groupname,subjects.name as subjectname,sem_homework.id as sem_homework_id,sem_homework.sem_group_id as sem_group_id,staff.name as staffname');
            $this->db->from('sem_homework');
            $this->db->join('semester_group','semester_group.sem_group_id=sem_homework.sem_group_id');
            $this->db->join('programee','programee.id=semester_group.sem_group_program'); 
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
            $this->db->join('semestertype','semestertype.st_id=semester_group.sem_group_semester');  
            $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup');
            $this->db->join('subjects','subjects.id=sem_homework.subject_id');
            $this->db->join('semester_subject_groups','semester_subject_groups.id=sem_homework.subject_group_subject_id');            
            $this->db->join('staff','staff.id=sem_homework.staff_id');        
            $this->db->where(array('sem_homework.sem_group_id' =>$sem_group_id));            
            $query=$this->db->get();
            return $query->result_array();            
            } 

            

            public function get_homework_details($sem_home_id)
            { 
            $this->db->select('*,semester_subject_groups.name as groupname,subjects.name as subjectname,sem_homework.description as description,sem_homework.id as sem_homework_id,sem_homework.sem_group_id as sem_group_id,  teacher.name AS teacher_name,
            creator.name AS created_by_name,
            evaluator.name AS evaluated_by_name');
            $this->db->from('sem_homework');
            $this->db->join('semester_group','semester_group.sem_group_id=sem_homework.sem_group_id');
            $this->db->join('programee','programee.id=semester_group.sem_group_program'); 
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
            $this->db->join('semestertype','semestertype.st_id=semester_group.sem_group_semester');  
            $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup');
            $this->db->join('subjects','subjects.id=sem_homework.subject_id');
            $this->db->join('semester_subject_groups','semester_subject_groups.id=sem_homework.subject_group_subject_id');
            $this->db->join('staff AS teacher','teacher.id = sem_homework.staff_id','LEFT');
            $this->db->join('staff AS creator','creator.id = sem_homework.created_by','LEFT');
            $this->db->join('staff AS evaluator','evaluator.id = sem_homework.evaluated_by','LEFT');
            $this->db->where(array('sem_homework.id' =>$sem_home_id));            
            $query=$this->db->get();
            return $query->row_array();            
            } 


            public function get_evaluated_students($homework_id) {
            $this->db->select('student_id');
            $this->db->from('sem_homework_evaluation');
            $this->db->where('homework_id', $homework_id);
            return $this->db->get()->result_array();
            }           
            


            public function insertHomework($data) 
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data["id"]) && $data["id"] > 0) {
            $this->db->where("id", $data["id"])->update("sem_homework", $data);
            $message = UPDATE_RECORD_CONSTANT . " On sem_homework id " . $data['id'];
            $action = "Update";
            $record_id = $insert_id = $data['id'];
            $this->log($message, $record_id, $action);
            } else {

            $this->db->insert("sem_homework", $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On sem_homework id " . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
            }
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {
            return $insert_id;
            }
            // return $insert_id;
            }




            public function get_students($sem_group_id)
            { 
            $this->db->select('*');
            $this->db->from('semester_students');
            $this->db->join(
            'semester_student_session',
            'semester_student_session.student_id = semester_students.id',
            'left'
            );

            $this->db->where('semester_student_session.sem_group_id', $sem_group_id);
            $query = $this->db->get();
            return $query->result_array();
            }

            }
