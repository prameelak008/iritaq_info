            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Batchtype_model extends MY_Model 
            {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            public function get($id = null) {
            $this->db->select()
            ->from('batchtype');
            $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name','left');
            $this->db->join('batch_mode','batch_mode.b_mode_id=batchtype.b_mode','left');
            $this->db->join('programee','programee.id=batchtype.b_program','left');
            $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type','left');
            if ($id != null) 
            {
            $this->db->where('batchtype.b_id', $id );
            } else {
            $this->db->order_by('batchtype.b_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }

            


            public function get_batchgroup($id = null) {
            $this->db->select()
            ->from('batch_groups');            
            if ($id != null) 
            {
            $this->db->where('batch_groups.batch_group_id', $id);
            } else {
            $this->db->order_by('batch_groups.batch_group_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }



            // public function get_batchtypes($id = null) {
            // $this->db->select()
            // ->from('batchtype');              
            // $this->db->join('batch_groups','batchtype.b_name=batch_groups.batch_group_id','left');
            // $this->db->join('batch_mode','batch_mode.b_mode_id=batchtype.b_mode','left');
            // if ($id != null) 
            // {
            // $this->db->where('batch_groups.batch_group_id', $id);
            // } else {
            // $this->db->order_by('batch_groups.batch_group_id');
            // }
            // $query = $this->db->get();
            // if ($id  != null) {
            // return $query->row_array();
            // } else {
            // return $query->result_array();
            // }
            // }


              public function get_batchtypes($id = null)
              {
              $this->db->select()
              ->from('batchtype')
              ->join('batch_groups','batchtype.b_name = batch_groups.batch_group_id','left')
              ->join('batch_mode','batch_mode.b_mode_id = batchtype.b_mode','left');
              

              if ($id != null) {
              $this->db->where('batch_groups.batch_group_id', $id);
              }


              $this->db->group_by([
              'batchtype.b_mode',                 // Regular / Supplementary
              'batch_groups.batch_group_year'     // 2023, 2024
              ]);

              $this->db->order_by('batch_mode.b_mode_name');
              $this->db->order_by('batch_groups.batch_group_year');

              $query = $this->db->get();

              return ($id != null) ? $query->row_array() : $query->result_array();
              }



               


            public function get_batchlist() 
              {
            $this->db->select()
            ->from('batch_groups');
            $this->db->where('batch_groups.batch_group_status', 1);
           
            $this->db->order_by('batch_groups.batch_group_id');
            
            $query = $this->db->get();
           
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
            $this->db->update('batchtype', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  batchtype b_id " . $data['b_id'];
            $action    = "Update";
            $record_id = $data['b_id'];
            } 
            else
            {
            $this->db->insert('batchtype', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  batchtype b_id " . $return_value;
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
            $this->db->delete('batchtype');
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
            $this->db->select_max('b_bid');
            $this->db->from('batchtype');
            $query=$this->db->get();
            return $query->row_array();                             
            }

            public function combo_exists($mode_id, $program_id, $batch_group_id)
            {
            $this->db->from('batchtype');
            $this->db->where('b_mode', $mode_id);
            $this->db->where('b_program', $program_id);
            $this->db->where('b_name', $batch_group_id);
            return $this->db->count_all_results() > 0;
            }

            public function combo_exists_except_id($mode_id, $program_id, $batch_group_id, $exclude_id)
            {
            $this->db->from('batchtype');
            $this->db->where('b_mode', $mode_id);
            $this->db->where('b_program', $program_id);
            $this->db->where('b_name', $batch_group_id);
            $this->db->where('b_id !=', $exclude_id);
            return $this->db->count_all_results() > 0;
            }
            

            
            public function batch_code_exists($code) {
            $this->db->from('batchtype');
            $this->db->where('b_code', $code);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }

            public function check_exists_for_edit($code, $exclude_id) {
            $this->db->from('batchtype');
            $this->db->where('b_code', $code);
            $this->db->where('b_id !=', $exclude_id);
            $query = $this->db->get();
            return $query->num_rows() > 0;
            }
            
            public function batch_name_exists($name) {
            $this->db->from('batchtype');
            $this->db->where('b_name', $name);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            return TRUE;
            } else {
            return FALSE;
            }
            }



            public function get_batchmode()
            {
            $this->db->select('*');
            $this->db->from('batch_mode');
            $this->db->where(array('b_mode_status'=>1));
            $query = $this->db->get();
            return $query->result_array(); 
            }
            
            }
