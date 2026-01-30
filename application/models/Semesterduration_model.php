            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            
            
            class Semesterduration_model extends MY_Model 
            {
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            
            public function get($id = null) {
            $this->db->select()
            ->from('batch_duration');
            if ($id != null) 
            {
            $this->db->where('batch_duration.id', $id );
            } else {
            $this->db->order_by('batch_duration.id');
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
            $this->db->update('batch_duration', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  batch_duration id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } 
            else
            {
            $this->db->insert('batch_duration', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  batch_duration id " . $return_value;
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
            $this->db->where('id', $id);
            $this->db->delete('batch_duration');
            $message = DELETE_RECORD_CONSTANT . " On batch_duration  id " . $id;
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
            
            
            
            
            
            //Programee
            
          
            
            public function get_program($session)
            {
            $this->db->select('*');
            $this->db->from('programee') ;
            $this->db->where(array('p_status'=>1,'session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            
            public function getdurationlist($session)
            {
            $this->db->select('*,set_duration.id as duration_id,programee.id as Program_id');
            $this->db->from('set_duration') ;
            $this->db->join('programee','programee.id=set_duration.programee_id') ;
            $this->db->where(array('set_duration.session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            
            public function editduration($id)
            {
            $this->db->select('*,set_duration.id as duration_id,programee.id as Program_id');
            $this->db->from('set_duration') ;
            $this->db->join('programee','programee.id=set_duration.programee_id') ;
            $this->db->where(array('set_duration.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            
            public function getDuartionbyId($id) 
            {
            $this->db->select('*,set_duration.id as duration_id,programee.id as Program_id');
            $this->db->from('set_duration') ;
            $this->db->join('programee','programee.id=set_duration.programee_id') ;
            $this->db->where(array('set_duration.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            
            
            public function semesterlist($session)
            {
            $this->db->select('*');
            $this->db->from('semester') ;
            $this->db->where(array('s_status'=>1,'session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            public function batchlist($session)
            {
            $this->db->select('*');
            $this->db->from('batch') ;
            $this->db->where(array('b_status'=>1,'session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
          
            public function get_batch($session)
            {
            $this->db->select('*,batch_duration.id as batchduration_id,batch.id as batchid,semester.id as semesterid,semester.s_name as s_name,batch.b_name as b_name');
            $this->db->from('batch_duration') ;
            $this->db->join('batch','batch.id=batch_duration.batch') ;
            $this->db->join('semester','semester.id=batch_duration.semester') ;
            $this->db->where(array('batch_duration.session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            
            public function getBatchbyId($id) 
            {
            $this->db->select('*,batch_duration.id as batchduration_id,batch.id as batchid,semester.id as semesterid,semester.s_name as s_name,batch.b_name as b_name');
            $this->db->from('batch_duration') ;
            $this->db->join('batch','batch.id=batch_duration.batch') ;
            $this->db->join('semester','semester.id=batch_duration.semester') ;
            $this->db->where(array('batch_duration.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();
            }             
            }
