<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examfeescharge_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($examfees_charge_id  = null) {
    $this->db->select('examfees_charge.*,exam_groups.*,exam_group_class_batch_exams.*,exam_group_class_batch_exams.id as batchexamid,exam_group_class_batch_exams.exam as batchexamname,sessions.*')
             ->from('examfees_charge')
             ->join('exam_groups','examfees_charge.examfees_charge_examgroup = exam_groups.id') 
             ->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id = examfees_charge. examfees_charge_exam')
             ->join('sessions','examfees_charge.examfees_charge_sessionid = sessions.id');  
    if ($examfees_charge_id != null) {
        $this->db->where('examfees_charge.examfees_charge_id', $examfees_charge_id );
    } else {
        $this->db->order_by('examfees_charge.examfees_charge_id');
    }

    $query = $this->db->get();

    if ($examfees_charge_id != null) {
        return $query->row_array();
    } else {
        return $query->result_array();
    }
}

    public function remove($examfees_charge_id ) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('examfees_charge_id ', $examfees_charge_id );
        $this->db->delete('examfees_charge');
        $message = DELETE_RECORD_CONSTANT . " On examfees charge examfees_charge_id  " . $examfees_charge_id;
        $action = "Delete";
        $record_id = $examfees_charge_id;
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

    public function add($data) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['examfees_charge_id'])) {
            $this->db->where('examfees_charge_id', $data['examfees_charge_id']);
            $this->db->update('examfees_charge', $data);
            $message = UPDATE_RECORD_CONSTANT . " On  examfees charge examfees_charge_id " . $data['examfees_charge_id'];
            $action = "Update";
            $record_id = $data['examfees_charge_id'];
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
            $this->db->insert('examfees_charge', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On examfees charge examfees_charge_id " . $insert_id;
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

    public function getExamgroups()
    {
        $sql="select * from exam_groups";
        $query=$this->db->query($sql); 
        return $query->result_array();
    }

    public function examgroupgetExam($examgroups_id) {
        $query = $this->db->select('*')->join("exam_group_class_batch_exams", "exam_group_class_batch_exams.exam_group_id=exam_groups.id")->where("exam_group_id", $examgroups_id)->get("exam_groups");
        return $query->result_array();
    }

    // public function listroute() {
    //     $this->db->select()->from('transport_route');
    //     $listtransport = $this->db->get();
    //     return $listtransport->result_array();
    // }

    // public function listvehicles() {
    //     $this->db->select()->from('vehicles');
    //     $listvehicles = $this->db->get();
    //     return $listvehicles->result_array();
    // }

}
