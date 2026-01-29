            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Semestertype_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            
            
            public function get($id = null)
            {
            $this->db->select()
            ->from('semestertype');
            if ($id != null) 
            {
            $this->db->where('st_id', $id);
            } else {
            $this->db->order_by('st_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }
            
            
            public function getdata()
            {
            $this->db->select()
            ->from('semestertype');
            $this->db->where(array('st_status'=> 1));
            $query = $this->db->get();
            return $query->result_array();
            }

           
            
            public function add($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['st_id']))
            {
            $this->db->where('st_id', $data['st_id']);
            $this->db->update('semestertype', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  semester   st_id " . $data['st_id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('semestertype', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  semester   st_id " . $return_value;
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
    
    
    
    
            // public function remove($id)
            // { 
            // $this->db->trans_start(); # Starting Transaction
            // $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            // //=======================Code Start===========================
            // $this->db->where('st_id', $id);
            // $this->db->delete('semestertype');
            // $message    = DELETE_RECORD_CONSTANT . " On semestertype  st_id " . $id;
            // $action     = "Delete";
            // $record_id  = $id;
            // $this->log($message, $record_id, $action);
            // //======================Code End==============================
            // $this->db->trans_complete(); # Completing transaction
            // /* Optional */
            // if ($this->db->trans_status() === false)
            // {
            // # Something went wrong.
            // $this->db->trans_rollback();
            // return false;
            // } 
            // else 
            // {
            // //return $return_value;
            // }
            // }



                public function remove($id)
                { 
                $this->db->trans_start();
                $this->db->trans_strict(false);

                $this->db->where('st_id', $id);
                $this->db->delete('semestertype');

                $error = $this->db->error(); // <---- catch DB error here

                if ($error['code'] != 0) {
                // Foreign key or other error occurred
                $this->db->trans_rollback();
                return $error;   // return error details instead of success
                }

                $message    = DELETE_RECORD_CONSTANT . " On semestertype  st_id " . $id;
                $action     = "Delete";
                $record_id  = $id;
                $this->log($message, $record_id, $action);

                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
                } else {
                return true;
                }
                }

            
            
           
            public function get_maxcode()
            {                                   
            $this->db->select_max('st_sid');
            $this->db->from('semestertype');
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            
            public function semester_code_exists($code) {
            $this->db->from('semestertype');
            $this->db->where('st_code', $code);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            public function semester_name_exists($name) {
            $this->db->from('semestertype');
            $this->db->where('st_name', $name);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
           
            
            }
