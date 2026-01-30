<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select()->from('categories');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('categories');
        $message = DELETE_RECORD_CONSTANT . " On categories id " . $id;
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

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('categories', $data);
            $message = UPDATE_RECORD_CONSTANT . " On  categories id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
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
        } else {
            $this->db->insert('categories', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On  categories id " . $id;
            $action = "Insert";
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
            return $id;
        }
    }
    
    
    
        // public function get_leave_category($class_id,$section_value,$category)
        // {
        // $this->db->select('*');
        // $this->db->from('leave_catmanagement');
        // $this->db->join('leave_category','leave_category.leave_category_id=leave_catmanagement.leave_catmanagement_category');
        // $this->db->where(array('leave_category.leave_category_status'=>1,'leave_catmanagement.leave_catmanagement_class'=>$class_id,'leave_catmanagement.leave_catmanagement_section'=>$section_value,'leave_catmanagement.leave_catmanagement_category'=>$category,'leave_catmanagement.leave_catmanagement_session'=>$this->current_session));
        // $sql=$this->db->get();
        // return $sql->result_array();
        // }
        
      
        public function getleave_details($class_id, $section_id, $fdate, $tdate)
        {
        $current_session=$this->current_session;
        $this->db->select('*');
        $this->db->from('leave_catmanagement');
        $this->db->join('leave_category','leave_category.leave_category_id=leave_catmanagement.leave_catmanagement_category');
        $this->db->where(array('leave_catmanagement.leave_catmanagement_class'=>$class_id,'leave_catmanagement.leave_catmanagement_section'=>$section_id,'leave_catmanagement.leave_catmanagement_session'=>$current_session));
        $this->db->where(array('leave_catmanagement.leave_catmanagement_date >='=> $fdate));
        $this->db->where(array('leave_catmanagement.leave_catmanagement_date <='=> $tdate));
        $sql=$this->db->get();
        return $sql->result_array();
        }
        
        
        
        public function studentmanagement($class_id,$section_id)
        {
        $this->db->select('student_session.id as session_id');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where(array('student_session.session_id'=> $this->current_session,'student_session.class_id'=> $class_id,'student_session.section_id'=> $section_id));
        $sql=$this->db->get();
        return $sql->result_array();
        
        }

    

}
