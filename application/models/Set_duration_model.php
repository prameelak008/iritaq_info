            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Set_duration_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            public function get($id = null) {
            $this->db->select()
            ->from('batch');
            if ($id != null) 
            {
            $this->db->where('batch.id', $id );
            } else {
            $this->db->order_by('batch.id');
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
            $this->db->update('set_duration', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  set_duration id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } 
            else
            {
            $this->db->insert('set_duration', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  set_duration id " . $return_value;
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
            $this->db->delete('set_duration');
            $message = DELETE_RECORD_CONSTANT . " On set_duration  id " . $id;
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
            
            
            // program duration...............
            /*
            public function getdurationlist($session)
            {
            $this->db->select('*,set_duration.id as duration_id,programee.id as Program_id');
            $this->db->from('set_duration') ;
            $this->db->join('programee','programee.id=set_duration.programee_id') ;
            $this->db->where(array('set_duration.session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            */



            public function getprogramedetails()
            {
            $this->db->select('*,set_duration.id as duration_id,programee.id as Program_id');
            $this->db->from('set_duration') ;
            $this->db->join('programee','programee.id=set_duration.programee_id') ;
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type') ;
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
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type','left') ;
            $this->db->where(array('set_duration.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();
            }

            


            public function get_semester_term() 
            {
            $this->db->select('*');
            $this->db->from('semester_term') ;            
            $this->db->where(array('stm_status'=>1));
            $this->db->order_by('stm_id', 'ASC');
            $query=$this->db->get();
            return $query->result_array();
            }

     

            public function get_sem_term($term_id) 
            {
            $this->db->select('*');
            $this->db->from('semester_term') ;            
            $this->db->where(array('stm_id'=>$term_id));
           
            $query=$this->db->get();
            return $query->row_array();
            }


            /////Updated New Version           
            
            }
