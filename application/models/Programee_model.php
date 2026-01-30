            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Programee_model extends MY_Model {
                
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            


            
            public function get($id = null) 
            {               
                
            $this->db->select()
            ->from('programee');
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
            if ($id != null) 
            {
            $this->db->where('programee.id', $id);            
            } 
            else 
            {
            $this->db->order_by('programee.id');
            }
            $query = $this->db->get();
            if ($id  != null)
            {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }
            
            public function add($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['id']))
            {
            $this->db->where('id', $data['id']);
            $this->db->update('programee', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  programee   id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('programee', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  programee   id " . $return_value;
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
            } else {
            
            return $record_id;
            }
            }
    
    
            public function remove($id) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('id', $id);
            $this->db->delete('programee');
            $message = DELETE_RECORD_CONSTANT . " On programee  id " . $id;
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
            
            
            
            public function remove_assign($id) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('id', $id);
            $this->db->delete('assign_programme');
            $message = DELETE_RECORD_CONSTANT . " On assign_programme  id " . $id;
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
            
           
            public function get_maxcode()
            {                                   
            $this->db->select_max('p_id');
            $this->db->from('programee');
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            ////assign programme
            
            public function get_programs()
            {                                   
            $this->db->select('*');
            $this->db->from('programee');
            $this->db->where(array('p_status'=>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            public function get_assignprograme()
            {                                   
            $this->db->select('*,assign_programme.id as id,faculty.id as facultyid,programee.id as progid ');
            $this->db->from('assign_programme');
            $this->db->join('programee','programee.id=assign_programme.pg_programme');
            $this->db->join('faculty','faculty.id=assign_programme.pg_facultydep');
            // $this->db->where(array('pg_session'=>$session));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            
            public function get_assignprogramebyid($id)
            {                                   
            $this->db->select('*,assign_programme.id as id,faculty.id as facultyid,programee.id as progid,programee.p_name as p_name');
            $this->db->from('assign_programme');
            $this->db->join('programee','programee.id=assign_programme.pg_programme');
            $this->db->join('faculty','faculty.id=assign_programme.pg_facultydep');
            $this->db->where(array('assign_programme.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            
            
            public function add_assign($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['id']))
            {
            $this->db->where('id', $data['id']);
            $this->db->update('assign_programme', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  assign_programme   id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('assign_programme', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  assign_programme   id " . $return_value;
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
            } else {
            
            return $record_id;
            }
            }
            
            
            
            
            public function programee_name_exists($name) {
            $this->db->from('programee');
            $this->db->where('p_name', $name);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
             public function programee_code_exists($code) {
            $this->db->from('programee');
            $this->db->where('p_code', $code);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            
            public function programee_type_exists($type) {
            $this->db->from('programee');
            $this->db->where('p_type', $type);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }


             public function check_name_exists($name, $id = null)
            {
            $this->db->where('p_name', $name);
            if (!empty($id)) {
            $this->db->where('id !=', $id);
            }
            return $this->db->count_all_results('programee') > 0;
            }
            

            public function check_code_exists($code, $id = null)
            {
            $this->db->where('p_code', $code);
            if (!empty($id)) {
            $this->db->where('id !=', $id);
            }
            return $this->db->count_all_results('programee') > 0;
            }


            
            public function programme_exists($programme)
            {
            return $this->db
            ->where('pg_programme', $programme)
            ->get('assign_programme')
            ->num_rows() > 0;
            }

            
            
            }
