            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Batch_duration_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            

            
            public function get($id = null) 
            {
            $this->db->select('*,batch_duration.id as batch_duration_id,programee.*,batch_groups.batch_group_name as sp_name,batch_groups.batch_group_name as ');
            $this->db->from('batch_duration') ;            
            $this->db->join('programee','programee.id=batch_duration.program','left') ;
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type','left') ;


            // $this->db->join('semestertype','semestertype.st_id=batch_duration.semester','left') ;
            $this->db->join('batchtype','batchtype.b_id=batch_duration.batch' ,'left') ;
            // $this->db->join('batch_groups','batch_groups.batch_group_id=batch_duration.batch','left');
           $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name','left'); 
            

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

            


            public function getBatchDuartionbyId($id)
            {

            $this->db->select('*,set_duration.id as duration_id,programee.id as Program_id');
            $this->db->from('set_duration') ;
            $this->db->join('programee','programee.id=set_duration.programee_id') ;
            $this->db->where(array('set_duration.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();

            }
            
            
            
            
            
           
            
            
        
            
            
            
            
            }
