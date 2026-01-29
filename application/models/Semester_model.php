            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Semester_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            public function get($id = null) {
            $this->db->select('*')
            ->from('semester');
            $this->db->join('semestertype','semestertype.st_id =semester.s_sem_type');
            $this->db->join('programme_type','programme_type.prog_type_id =semester.s_prog_type');

            $this->db->join('programee','programee.p_type =programme_type.prog_type_id','left');

            if ($id != null) 
            {
            $this->db->where('semester.s_id', $id );
            } else {
            $this->db->order_by('semester.s_id');
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
            if (isset($data['s_id']))
            {
            $this->db->where('s_id', $data['s_id']);
            $this->db->update('semester', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  semester   s_id " . $data['s_id'];
            $action    = "Update";
            $record_id = $data['s_id'];
            } else {
            $this->db->insert('semester', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  semester   s_id " . $return_value;
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
    
    
    
    
            public function remove($id)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('s_id', $id);
            $this->db->delete('semester');
            $message = DELETE_RECORD_CONSTANT . " On semester  s_id " . $id;
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

            
            
            
           
        
            
            
    
            
            
            
            
            }
