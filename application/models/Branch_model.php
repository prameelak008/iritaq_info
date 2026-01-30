<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    

        class Branch_model extends MY_Model 
        {
        public function __construct()
        {
        parent::__construct();
        }
        
        
        
        public function get($id = null) 
        {
        $this->db->select()->from('branch');
        if ($id != null) {
        $this->db->where('branch_id', $id);
        } else {
        $this->db->order_by('branch_id');
        }
        $query = $this->db->get();
        if ($id != null) {
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
        if (isset($data['branch_id'])) {
            $this->db->where('branch_id', $data['branch_id']);
            $this->db->update('branch', $data);
            $message = UPDATE_RECORD_CONSTANT . " On  branch id " . $data['branch_id'];
            $action = "Update";
            $record_id = $data['branch_id'];
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
        else
        {
        $this->db->insert('branch', $data);
        $insert_id   = $this->db->insert_id();
        $message = INSERT_RECORD_CONSTANT . " On branch id " . $insert_id;
        $action = "Insert";
        $record_id = $insert_id;
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
        return $insert_id;
        }
    }
    
    //     public function add($data)
    //     {
    //     $this->db->trans_start(); # Starting Transaction
    //     $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
    //     //=======================Code Start===========================
    //     if (isset($data['branch_id'])) {
    //     $this->db->where('branch_id', $data['branch_id']);
    //     $this->db->update('branch', $data);
    //     $message = UPDATE_RECORD_CONSTANT . " On branch id " . $data['branch_id'];
    //     $action = "Update";
    //     $record_id = $data['branch_id'];
    //     $this->log($message, $record_id, $action);
    //     //======================Code End==============================
        
    //     $this->db->trans_complete(); # Completing transaction
    //     /* Optional */
        
    //     if ($this->db->trans_status() === false) {
    //     # Something went wrong.
    //     $this->db->trans_rollback();
    //     return false;
    //     } else {
    //     return $return_value;
    //     }
    //     } 
    //     else 
    //     {
            
    //     $this->db->insert('branch', $data);
    //     $branch_id = $this->db->insert_id();
    //     $message = INSERT_RECORD_CONSTANT . " On branch branch_id " . $branch_id;
    //     $action = "Insert";
    //     $record_id = $branch_id;
    //     $this->log($message, $record_id, $action);
        
    //     $this->db->trans_complete(); 
    //     if ($this->db->trans_status() === false) {
    //     # Something went wrong.
    //     $this->db->trans_rollback();
    //     return false;
    //     } else {
    //   // return $return_value;
    
    //     }
    //     }
    //     }
        
        public function branch_list()
        {
        $this->db->select('*');
        $this->db->from('branch');
       // $this->db->join('staff','staff.branch_id=branch.branch_id');
        $this->db->group_by('branch.branch_id');
        $this->db->where('isactive',1);
        $q=$this->db->get();
        return $q->result_array();
        }
        
        
        
        public function getBranchDataById($branchId) 
        {
            
           
        // $this->db->select('*');
        // $this->db->from('branch');
        // // $this->db->join('staff','staff.branch_id=branch.branch_id');
        // //$this->db->group_by('branch.branch_id');
        // $this->db->where(array('branch_id'=>$branchId));
        // $q=$this->db->get();
        // return $q->row_array();
            $this->db->select('*');
            $this->db->from('branch');
            $this->db->join('staff_branch', 'staff_branch.st_branch = branch.branch_id');
            $this->db->join('staff', 'staff.id = staff_branch.st_staff');
            $this->db->where('staff_branch.st_branch IS NOT NULL');
            $q = $this->db->get();
            return $q->row_array();
      
        }

}
