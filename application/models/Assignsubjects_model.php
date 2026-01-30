                <?php

                if (!defined('BASEPATH'))
                exit('No direct script access allowed');

                class Assignsubjects_model extends MY_Model 
                {

                public function __construct() {
                parent::__construct();
                $this->current_session = $this->setting_model->getCurrentSession();
                }           


                public function get001($id = null) 
                {
                $this->db->select('*');            
                $this->db->from('assignsubjects');              
                $this->db->join('programee','programee.id = assignsubjects.as_programs'); 
                $this->db->join('programme_type','programme_type.prog_type_id = programee.p_type'); 
                $this->db->join('semestertype','semestertype.st_id = assignsubjects.as_semester');
                $this->db->join('batchtype','batchtype.b_id = assignsubjects.as_batch');             
                // $this->db->join('subject_groups', "FIND_IN_SET(subject_groups.id, assignsubjects.as_subjectgroup)", 'left');   
                $this->db->join('semester_subject_groups', "FIND_IN_SET(semester_subject_groups.id, assignsubjects.as_subjectgroup)", 'left');                   

                if ($id != null) {
                $this->db->where('assignsubjects.as_id', $id);
                $query = $this->db->get();
                return $query->row_array();
                } else {
                $this->db->order_by('assignsubjects.as_id');
                $query = $this->db->get();
                return $query->result_array();
                }
                }


                public function get($id = null) 
                {

                // $this->db->select("assignsubjects.*, programee.p_name as p_name,programme_type.prog_type_id,programme_type.prog_type_name as prog_type_name, semestertype.st_name, batch_groups.batch_group_name,  GROUP_CONCAT(subject_groups.name ORDER BY subject_groups.id) as group_names");            
                // $this->db->from('assignsubjects');              
                // $this->db->join('programee','programee.id = assignsubjects.as_programs'); 
                // $this->db->join('programme_type','programme_type.prog_type_id = programee.p_type'); 
                // $this->db->join('semestertype','semestertype.st_id = assignsubjects.as_semester');

                // $this->db->join('batch_groups','batch_groups.batch_group_id = assignsubjects.as_batchgroup'); 

                // // $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name');
                // $this->db->join('subject_groups', "FIND_IN_SET(subject_groups.id, assignsubjects.as_subjectgroup)", 'left');

                // if ($id != null) {
                // $this->db->where('assignsubjects.as_id', $id);
                // $this->db->group_by('assignsubjects.as_id');
                // $query = $this->db->get();
                // return $query->row_array();
                // } else {
                // $this->db->group_by('assignsubjects.as_id');
                // $this->db->order_by('assignsubjects.as_id');
                // $query = $this->db->get();
                // return $query->result_array();
                // }




                // $this->db->select("semester_assign_subjects.*, programee.p_name as p_name,programme_type.prog_type_id,programme_type.prog_type_name as prog_type_name, semestertype.st_name, batch_groups.batch_group_name,  GROUP_CONCAT(subject_groups.name ORDER BY subject_groups.id) as group_names");            
                // $this->db->from('semester_assign_subjects');
                // $this->db->join('semester_group','semester_group.sem_group_id  = semester_assign_subjects.sem_assign_group_id');
                // $this->db->join('programee','programee.id = semester_group.	sem_group_program'); 
                // $this->db->join('programme_type','programme_type.prog_type_id = programee.p_type'); 
                // $this->db->join('semestertype','semestertype.st_id = semester_group.sem_group_semester');
                // $this->db->join('batch_groups','batch_groups.batch_group_id = semester_group.sem_group_batchgroup'); 
                // $this->db->join('subject_groups', "FIND_IN_SET(subject_groups.id, semester_assign_subjects.sem_assign_subjects_id)", 'left');
                // if ($id != null) {
                // $this->db->where('semester_assign_subjects.sem_assign_id', $id);
                // $this->db->group_by('semester_assign_subjects.sem_assign_id');
                // $query = $this->db->get();
                // return $query->row_array();
                // } else {
                // $this->db->group_by('semester_assign_subjects.sem_assign_id ');
                // $this->db->order_by('semester_assign_subjects.sem_assign_id ');
                // $query = $this->db->get();
                // return $query->result_array();

                

                // $this->db->select("
                // semester_assign_subjects.*,
                // semester_group.*,
                // programee.p_name AS p_name,
                // programme_type.prog_type_id as prog_type_id ,
                // programme_type.prog_type_name AS prog_type_name,
                // semestertype.st_name as st_name,
                // batch_groups.batch_group_name as batch_group_name,
                // batch_groups.batch_group_year as b_year,
                // GROUP_CONCAT(semester_subject_groups.name ORDER BY semester_subject_groups.id SEPARATOR ', ') AS group_names");
                
                // $this->db->from('semester_assign_subjects');
                // $this->db->join('semester_group', 'semester_group.sem_group_id = semester_assign_subjects.sem_assign_group_id');
                // $this->db->join('programee', 'programee.id = semester_group.sem_group_program');
                // $this->db->join('programme_type', 'programme_type.prog_type_id = programee.p_type');
                // $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester');
                // $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup');
                // $this->db->join('semester_subject_groups', 'semester_subject_groups.id = semester_assign_subjects.sem_assign_subjects_id', 'left'); // <-- fixed


                
                // if ($id != null) {
                // $this->db->where('semester_assign_subjects.sem_assign_id', $id);
                // $this->db->group_by('semester_assign_subjects.sem_assign_id');
                // $query = $this->db->get();
                // return $query->row_array();
                // } else {
                // // GROUP BY program, batch, semester to get one row per combination
                // $this->db->group_by([
                // 'semester_group.sem_group_program',
                // 'semester_group.sem_group_batchgroup',
                // 'semester_group.sem_group_semester'
                // ]);
                // $this->db->order_by('programee.p_name, batch_groups.batch_group_name');
                // $query = $this->db->get();
                // return $query->result_array();
                // }

             
            $this->db->select("semester_assign_subjects.*,semester_group.*,
                programee.p_name AS p_name,programme_type.prog_type_id as prog_type_id,programme_type.prog_type_name AS prog_type_name,batch_groups.batch_group_name ,batch_groups.batch_group_year  as b_year,GROUP_CONCAT(semester_subject_groups.name ORDER BY semester_subject_groups.id) as group_names");            
            $this->db->from("semester_assign_subjects");
            $this->db->join('semester_group', 'semester_group.sem_group_id = semester_assign_subjects.sem_assign_group_id');
            $this->db->join('programee', 'programee.id = semester_group.sem_group_program');
            $this->db->join('programme_type', 'programme_type.prog_type_id = programee.p_type');
            $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester');
            $this->db->join('batch_semester', 'batch_semester.bchsem_id = semester_group.sem_group_batchgroup');
            $this->db->join('batchtype', 'batchtype.b_id  = batch_semester.bchtyp_id');            
            $this->db->join('batch_groups', 'batch_groups.batch_group_id = batchtype.b_bid');            
            $this->db->join('semester_subject_groups', "FIND_IN_SET(semester_subject_groups.id, semester_assign_subjects.sem_assign_subjects_id)", 'left');
            if ($id != null) {
            $this->db->where('semester_assign_subjects.sem_assign_id', $id);
            $this->db->group_by('semester_assign_subjects.sem_assign_id');
            $query = $this->db->get();
            return $query->row_array();
            }
            else 
            {               
            $this->db->group_by([
            'semester_group.sem_group_program',
            'semester_group.sem_group_batchgroup',
            'semester_group.sem_group_semester'
            ]);
            $this->db->order_by('programee.p_name, batch_groups.batch_group_name');
            $query = $this->db->get();
            return $query->result_array();
            }
            }                
                




                public function add($data)
                { 
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
                //=======================Code Start===========================
                if (isset($data['as_id']))
                {
                $this->db->where('as_id', $data['as_id']);
                $this->db->update('assignsubjects', $data);
                $message   = UPDATE_RECORD_CONSTANT . " On  assignsubjects as_id " . $data['as_id'];
                $action    = "Update";
                $record_id = $data['as_id'];
                } 
                else
                {

                $this->db->insert('assignsubjects', $data);
                $return_value = $this->db->insert_id();
                $message      = INSERT_RECORD_CONSTANT . " On  assignsubjects as_id " . $return_value;
                $action       = "Insert";
                $record_id    = $return_value;
                }
                $this->log($message, $record_id, $action);
                //======================Code End==============================

                $this->db->trans_complete(); # Completing transaction
                /* Optional */

                if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
                } 
                else
                {
                return $record_id;
                }
                }                



                public function remove($id)
                {
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
                //=======================Code Start===========================
                $this->db->where('sem_assign_group_id', $id);
                $this->db->delete('semester_assign_subjects');
                $message = DELETE_RECORD_CONSTANT . " On semester_assign_subjects  sem_assign_group_id " . $id;
                $action = "Delete";
                $record_id = $id;
                $this->log($message, $record_id, $action);
                //======================Code End==============================
                $this->db->trans_complete(); # Completing transaction
                /* Optional */
                if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
                } else {
                //return $return_value;
                }
                }                

                public function get_sem_assig($id)
                {  
                $this->db->select('*');
                $this->db->from('semester_assign_subjects');
                $this->db->join('semester_group', 'semester_group.sem_group_id = semester_assign_subjects.sem_assign_group_id');
                $this->db->join('semester_subject_groups', 'semester_subject_groups.id = semester_assign_subjects.sem_assign_subjects_id');
                // $this->db->where(array('sem_assign_group_id'=>19));
                $this->db->where(array('sem_assign_group_id'=>19));
                $query=$this->db->get();
                return $query->result_array(); 
                
                //  $this->db->select('*');
                //  $this->db->from('semester_group');
                //  $this->db->join('programee', 'programee.id = semester_group.sem_group_program');
                //  $this->db->join('programme_type', 'programme_type.prog_type_id = programee.p_type');
                //  $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester');
                //  $this->db->join('batch_groups', 'batch_groups.batch_group_id  = semester_group.sem_group_batchgroup');
                //  $query=$this->db->get();
                //  return $query->result_array(); 
                }



                public function get_subjectgroups()
                {
                $this->db->select('*');
                $this->db->from('semester_subject_groups');
                $query=$this->db->get();
                return $query->result_array();  
                }

                public function get_assigned_subject_ids($sem_group_id)
                {                    
                $this->db->select('sem_assign_subjects_id');
                $this->db->from('semester_assign_subjects');
                $this->db->where('sem_assign_group_id', $sem_group_id);
                $query = $this->db->get();
                return array_column($query->result_array(), 'sem_assign_subjects_id');
                } 
                }


