            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Seatcapacity_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }         



            public function get($id = null) 
            {
            $this->db->select('*,seatcapacity_duration.id as id,faculty.id as faculty_id,batch_groups.*');
            $this->db->from('seatcapacity_duration') ;
            $this->db->join('faculty','faculty.id=seatcapacity_duration.faculty','left') ;
            // $this->db->join('batchtype','batchtype.b_id=seatcapacity_duration.batch' ,'left') ;
             $this->db->join('batch_groups','batch_groups.batch_group_id =seatcapacity_duration.batch','left') ;

            if ($id != null) 
            {
            $this->db->where('seatcapacity_duration.id', $id );
            } else {
            $this->db->order_by('seatcapacity_duration.id');
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
            $this->db->update('seatcapacity_duration', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  seatcapacity_duration id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } 
            else
            {
            $this->db->insert('seatcapacity_duration', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  seatcapacity_duration id " . $return_value;
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
            $this->db->delete('seatcapacity_duration');
            $message = DELETE_RECORD_CONSTANT . " On seatcapacity_duration  id " . $id;
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
            
            
            public function get_faculty($session)
            {
            $this->db->select('*');
            $this->db->from('faculty') ;
            $this->db->where(array('faculty_status'=>1,'session'=>$session));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            public function get_seatcapacity($session)
            {
            $this->db->select('*,seatcapacity_duration.id as id,batch.b_name as b_name,batch.b_code as b_code,batch.b_id as b_id,faculty.faculty_code as faculty_code,faculty.faculty_name as faculty_name');
            $this->db->from('seatcapacity_duration');
            $this->db->join('batch','batch.id=seatcapacity_duration.batch');
            $this->db->join('faculty','faculty.id=seatcapacity_duration.faculty');
            $this->db->where(array('seatcapacity_duration.status'=>1,'seatcapacity_duration.session'=>$session));
            $query=$this->db->get();
            return $query->result_array();   
            }




            public function getseatcapacitybyId($id) 
            {
            $this->db->select('*,seatcapacity_duration.id as id,batchtype.b_name as b_name,batchtype.b_code as b_code,batchtype.b_id as b_id,faculty.id as faculty_id,faculty.faculty_code as faculty_code,faculty_name as faculty_name');
            $this->db->from('seatcapacity_duration'); 
            $this->db->join('batch_groups','batch_groups.batch_group_id=seatcapacity_duration.batch','left');
            $this->db->join('batchtype','batchtype.b_name=batch_groups.batch_group_id','left');
            $this->db->join('faculty','faculty.id=seatcapacity_duration.faculty','left');
            $this->db->where(array('seatcapacity_duration.id'=>$id));
            $query=$this->db->get();
            return $query->row_array();
            }              
            
            }
