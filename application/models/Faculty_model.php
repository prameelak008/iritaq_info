            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Faculty_model extends MY_Model {
                
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            public function get($id = null) {
            $this->db->select()
            ->from('faculty');
            if ($id != null) 
            {
            $this->db->where('faculty.id', $id );
            } else {
            $this->db->order_by('faculty.id');
            }
            $query = $this->db->get();
            if ($id  != null) {
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
            $this->db->update('faculty', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  faculty   id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('faculty', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  faculty   id " . $return_value;
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
            $this->db->delete('faculty');
            $message = DELETE_RECORD_CONSTANT . " On faculty  id " . $id;
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
            $this->db->select_max('faculty_id');
            $this->db->from('faculty');
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            
            
            ///misc
            
            public function get_faculty()
            {                                   
            $this->db->select('*');
            $this->db->from('faculty');
            $this->db->where(array('faculty_status'=>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }


            
            

            
            public function faculty_name_exists($faculty_name) {
            $this->db->from('faculty');
            $this->db->where('faculty_name', $faculty_name);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            public function faculty_name_exists_except_id($faculty_name, $exclude_id) {
            $this->db->from('faculty');
            $this->db->where('faculty_name', $faculty_name);
            $this->db->where('id !=', $exclude_id);
            $query = $this->db->get();
            return $query->num_rows() > 0;
            }
            
            public function faculty_code_exists($faculty_code) {
            $this->db->from('faculty');
            $this->db->where('faculty_code', $faculty_code);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            public function faculty_code_exists_except_id($faculty_code, $exclude_id) {
            $this->db->from('faculty');
            $this->db->where('faculty_code', $faculty_code);
            $this->db->where('id !=', $exclude_id);
            $query = $this->db->get();
            return $query->num_rows() > 0;
            }


            


            public function getfaculty_type()
            {
            $this->db->select('*');
            $this->db->from('faculty');
            $this->db->where(array('faculty_status'=>1));
            $query=$this->db->get();
            return $query->result_array(); 
            }

            public function check_exists_for_edit($code, $name, $id)
            {
            $this->db->where('(faculty_code = "' . $code . '" OR faculty_name = "' . $name . '")');
            $this->db->where('id !=', $id); // exclude the current record
            $query = $this->db->get('faculty');

            return $query->num_rows() > 0;
            }



            
            
            }
