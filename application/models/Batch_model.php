            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Batch_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            } 




            public function get($id = null) 
            { 
            $this->db->select('*');
            // $this->db->select('batch.b_id as id, batch.*, batchtype.*, programme_type.*, programee.*');
            $this->db->from('batch');
            $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name');
            $this->db->join('batchtype','batchtype.b_id =batch.b_batchtype');            
            $this->db->join('programme_type','programme_type.prog_type_id =batch.b_progtype');
            $this->db->join('programee','programee.id =batch.b_program');  
     
            if ($id != null) 
            {
            $this->db->where('batch.bt_id', $id );
            } 
            else 
            {
            $this->db->order_by('batch.bt_id');
            }

            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            $query=$this->db->get();
            return $query->result_array();          
            }
            


            
            public function add($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['b_id']))
            {
            $this->db->where('b_id', $data['b_id']);
            $this->db->update('batch', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  batch id " . $data['b_id'];
            $action    = "Update";
            $record_id = $data['b_id'];
            } 
            else
            {
            $this->db->insert('batch', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  batch id " . $return_value;
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
            $this->db->where('b_id', $id);
            $this->db->delete('batch');
            $message = DELETE_RECORD_CONSTANT . " On batch  b_id " . $id;
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
            $this->db->select_max('b_id');
            $this->db->from('batch');
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            public function batch_code_exists($code) 
            {
            $this->db->from('batch');
            $this->db->where('b_code', $code);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            public function batch_name_exists($name) 
            {
            $this->db->from('batch');
            $this->db->where('b_name', $name);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }
            
            public function getProgramsByType($type_id) 
            {
            $this->db->where('p_type', $type_id);
            $query = $this->db->get('programee');
            return $query->result_array();
            }           


            public function getbatch()
            {           
            $this->db->select('*');
            $this->db->from('batch');
            $this->db->join('batchtype','batchtype.b_id =batch.b_batchtype');            
            $this->db->join('programme_type','programme_type.prog_type_id =batch.b_progtype');
            $this->db->join('programee','programee.id =batch.b_program');           
            $query=$this->db->get();
            return $query->result_array(); 
            } 

            


            public function batchlist()
            {
            // $this->db->select('*');
            // $this->db->from('batchtype'); 
            // $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name','right');                         
            // $query=$this->db->get();
            // return $query->result_array(); 


            $this->db->select('*');
            $this->db->from('batch_groups');                           
            $query=$this->db->get();
            return $query->result_array();
            }
            
            

        }
            
            
