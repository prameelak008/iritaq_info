            <?php

            if (!defined('BASEPATH'))
            exit('No direct script access allowed');

            class Set_semesterDuration_model extends MY_Model 
            {

            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }            


            public function add001($data)
            {                
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['bchsem_id']))
            { 
               
            $this->db->where('bchsem_id', $data['bchsem_id']);
            $this->db->update('batch_semester', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  batch_semester   bchsem_id  " . $data['bchsem_id'];
            $action    = "Update";
            $record_id = $data['bchsem_id'];            
            } 


            else 
            {                
            $this->db->insert('batch_semester', $data);           
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  batch_semester   bchsem_id  " . $return_value;
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
            
            


           public function add($data)
{
    $this->db->trans_start();
    $this->db->trans_strict(false);

    // ======================= BATCH SEMESTER =======================
    if (isset($data['bchsem_id'])) {

        // UPDATE
        $this->db->where('bchsem_id', $data['bchsem_id']);
        $this->db->update('batch_semester', $data);

        $record_id = $data['bchsem_id'];
        $action    = "Update";
        $message   = UPDATE_RECORD_CONSTANT . " On batch_semester bchsem_id " . $record_id;

    } else {

        // CHECK EXISTENCE BEFORE INSERT
        $this->db->where('bchtyp_id', $data['bchtyp_id']);
        $this->db->where('bch_prog',   $data['bch_prog']);
        $this->db->where('semterm_id', $data['semterm_id']);
        $this->db->where('semtyp_id',  $data['semtyp_id']);

        $exists = $this->db->get('batch_semester')->row();

        if ($exists) {
            // Record already exists → do not insert
            $this->db->trans_complete();
            return $exists->bchsem_id;
        }

        // INSERT
        $this->db->insert('batch_semester', $data);
        $record_id = $this->db->insert_id();

        $action  = "Insert";
        $message = INSERT_RECORD_CONSTANT . " On batch_semester bchsem_id " . $record_id;
    }

    $this->log($message, $record_id, $action);

    // ======================= SEMESTER GROUP =======================
    $this->db->where('sem_group_program',       $data['bch_prog']);
    $this->db->where('sem_group_batchgroup',    $record_id);
    $this->db->where('sem_group_semester_term', $data['semterm_id']);

    $existsGroup = $this->db->get('semester_group')->row();

    if (!$existsGroup) {
        $this->db->insert('semester_group', [
            'sem_group_program'        => $data['bch_prog'],
            'sem_group_batchgroup'     => $record_id,
            'sem_group_semester_term'  => $data['semterm_id'],
            'sem_group_createddate'    => date('Y-m-d H:i:s')
        ]);
    }

    // ======================= TRANSACTION END ======================
    $this->db->trans_complete();

    if ($this->db->trans_status() === false) {
        $this->db->trans_rollback();
        return false;
    }

    return $record_id;
}




            public function get_batch_semester()
            {
            $this->db->select('*');
            $this->db->from('batch_semester');
            $this->db->join('batchtype', 'batchtype.b_id = batch_semester.bchtyp_id');
            $this->db->join('semestertype', 'semestertype.st_id = batch_semester.semtyp_id');
            $query = $this->db->get();
            return $query->result_array();
            }

            

            public function get($id = null) 
            {
            $this->db->select('*')
            ->from('batch_semester');
            $this->db->join('batchtype', 'batchtype.b_id = batch_semester.bchtyp_id');
            // $this->db->join('semestertype', 'semestertype.st_id = batch_semester.semtyp_id','left');
            
            $this->db->join('batch_groups', 'batch_groups.batch_group_id = batchtype.b_name');
            $this->db->join('semestertype', 'semestertype.st_id = batch_semester.semtyp_id','left');

             $this->db->join('semester_term', 'semester_term.stm_id = batch_semester.semterm_id','left');

            if ($id != null) 
            {
            $this->db->where('batch_semester.bchsem_id', $id );
            } 
            else
            {
            $this->db->order_by('batch_semester.bchsem_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }  

            public function remove($id)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('bchsem_id', $id);
            $this->db->delete('batch_semester');
            $message = DELETE_RECORD_CONSTANT . " On batch_semester  bchsem_id " . $id;
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
