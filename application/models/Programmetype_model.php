            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Programmetype_model extends MY_Model {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            public function get($id = null) {
            $this->db->select()
            ->from('programme_type');
            if ($id != null) 
            {
              
            $this->db->where('programme_type.prog_type_id', $id );
            } else {
              
            // $this->db->where('programme_type.prog_type_status', 1 );
            $this->db->order_by('programme_type.prog_type_id');
            }
             
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }


            
            public function getprg_type()
            {
            $this->db->select()
            ->from('programme_type');
            $this->db->where('programme_type.prog_type_status', 1 );
            $this->db->order_by('programme_type.prog_type_id');
            $query = $this->db->get();
            return $query->result_array();

            }



           
            
            public function add($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['prog_type_id']))
            {
            $this->db->where('prog_type_id', $data['prog_type_id']);
            $this->db->update('programme_type', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  programme_type   prog_type_id " . $data['prog_type_id'];
            $action    = "Update";
            $record_id = $data['prog_type_id'];
            } else {
            $this->db->insert('programme_type', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  programme_type   prog_type_id " . $return_value;
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
            $this->db->where('prog_type_id', $id);
            $this->db->delete('programme_type');
            $message = DELETE_RECORD_CONSTANT . " On programme_type  prog_type_id " . $id;
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
            
            ///misc
            
            public function get_faculty($session)
            {                                   
            $this->db->select('*');
            $this->db->from('faculty');
            $this->db->where(array('faculty_status'=>1,'session'=>$session));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            public function name_exists($name) {
            $this->db->from('programme_type');
            $this->db->where('prog_type_name', $name);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            
            public function code_exists($code) {
            $this->db->from('programme_type');
            $this->db->where('prog_type_code', $code);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }



            public function get_prgrmtype($id = null) {
            $this->db->select()
            ->from('programme_type');
            if ($id != null) 
            {
              
            $this->db->where('programme_type.prog_type_id', $id );
            } 
            else
             {               
            $this->db->where('programme_type.prog_type_status',1); 
            $this->db->order_by('programme_type.prog_type_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }




        


            public function check_name_exists($name, $id = null)
            {
            $this->db->where('prog_type_name', $name);
            if (!empty($id)) {
            $this->db->where('prog_type_id !=', $id);
            }
            return $this->db->count_all_results('programme_type') > 0;
            }

            public function check_code_exists($code, $id = null)
            {
            $this->db->where('prog_type_code', $code);
            if (!empty($id)) {
            $this->db->where('prog_type_id !=', $id);
            }
            return $this->db->count_all_results('programme_type') > 0;
            }

            
            
            }
