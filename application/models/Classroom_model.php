            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Classroom_model extends MY_Model {
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }



            public function add_buildingblock($data)
            { 
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['build_id']))
            {
            $this->db->where('build_id', $data['build_id']);
            $this->db->update('building_block', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  building_block  build_id " . $data['build_id'];
            $action    = "Update";
            $record_id = $data['build_id'];
            } else {
            $this->db->insert('building_block', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  building_block  build_id " . $return_value;
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











            public function list_row($table)
            {
            $this->db->select('*');
            $this->db->from($table);
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function list_result($table)
            {
            $this->db->select('*');
            $this->db->from($table);
            $query=$this->db->get();
            return $query->result_array();					
            }

            
            
            public function list_result_condition($table,$condition)
            {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);					
            $query=$this->db->get();
            return $query->result_array();					
            }


            
            public function list_row_condition($table,$condition)
            {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query=$this->db->get();
            return $query->row_array();
            }


            public function delete_data($table,$condition)
            {											
            $this->db->where($condition);
            return $this->db->delete($table);
            }

             public function update_value($table,$data,$condition)
            {
            $this->db->where($condition);					
            return $this->db->update($table,$data);							 
            }



            public function insert_value($table, $data)
            {
            // Insert the data into the specified table
            $inserted = $this->db->insert($table, $data);

            // Return true if insert was successful, false otherwise
            return $inserted;
            }
            



            public function insert_or_update($table, $data, $condition)
            {
            // Check if a record exists based on the condition
            $this->db->where($condition);
            $query = $this->db->get($table);

            if ($query->num_rows() > 0) {
            // Record exists → update it
            $this->db->where($condition);
            return $this->db->update($table, $data);
            } else {
            // Record does not exist → insert it
            return $this->db->insert($table, $data);
            }
            }




//////////////////////////Not used.....

            
            public function get($id = null) {
            $this->db->select()
            ->from('classroom');
            
            $this->db->join('building_block','building_block.id=classroom.cl_building_block');
            $this->db->join('floor','floor.id=classroom.cl_floor');
            $this->db->join('classroom_type','classroom_type.cls_id =classroom.cl_type');
            if ($id != null) 
            {
            $this->db->where('classroom.cl_id', $id );
            } 
            else 
            {
            $this->db->order_by('classroom.cl_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }
            
           
           
            public function get_Clssdata($id)
            {
            $this->db->select()
            ->from('classroom');
            $this->db->join('building_block','building_block.id=classroom.cl_building_block');
            $this->db->join('floor','floor.id=classroom.cl_floor');
            $this->db->join('classroom_type','classroom_type.cls_id =classroom.cl_type'); 
            $this->db->where('classroom.cl_id', $id );
            $query = $this->db->get();
            return $query->row_array();
            }
            
            
          
            public function get_type($id = null) {
            $this->db->select()
            ->from('classroom_type');
            if ($id != null) 
            {
            $this->db->where('classroom_type.cls_id', $id );
            } else {
            $this->db->order_by('classroom_type.cls_id');
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
            $this->db->where('cl_id', $data['id']);
            $this->db->update('classroom', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  classroom   cl_id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('classroom', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  classroom   cl_id " . $return_value;
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
            
            
            


            
            
            
            
            
           
            public function add_floor($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['id']))
            {
            $this->db->where('id', $data['id']);
            $this->db->update('floor', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  floor   	id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('floor', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  floor   	id " . $return_value;
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
            
    
    
    
    
            public function add_clstype($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['cls_id']))
            {
            $this->db->where('cls_id', $data['cls_id']);
            $this->db->update('classroom_type', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  classroom_type   	cls_id " . $data['cls_id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('classroom_type', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  classroom_type   	cls_id " . $return_value;
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
            $this->db->where('cl_id', $id);
            $this->db->delete('classroom');
            $message = DELETE_RECORD_CONSTANT . " On classroom  cl_id " . $id;
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
            
            
            
           
            
            
            public function get_buildingblock()
            {                                   
            $this->db->select('*');
            $this->db->from('building_block');
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            public function get_buildingblock_bystatus()
            {                                   
            $this->db->select('*');
            $this->db->from('building_block');
            $this->db->where(array('status' =>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            public function get_floor_bystatus()
            {                                   
            $this->db->select('*');
            $this->db->from('floor');
            $this->db->where(array('status' =>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            
            public function get_type_bystatus()
            {                                   
            $this->db->select('*');
            $this->db->from('classroom_type');
            $this->db->where(array('cls_status' =>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }
           
       
            
         
            
            
            
            
           
            
            
            
            
            }
