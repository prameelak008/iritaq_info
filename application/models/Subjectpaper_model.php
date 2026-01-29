            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class Subjectpaper_model extends MY_Model {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            public function get($subjectpaper_id = null) {
            $this->db->select()
            ->from('subjectpaper')
            ->join('subjects','subjects.id = subjectpaper.subjectpaper_subjectid');  
            if ($subjectpaper_id != null) {
            $this->db->where('subjectpaper.subjectpaper_id', $subjectpaper_id );
            } else {
                
            $this->db->order_by('subjectpaper.subjectpaper_id');
            }
            
            
          
            $query = $this->db->get();
            
            if ($subjectpaper_id != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }
            
            public function remove($subjectpaper_id) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('subjectpaper_id', $subjectpaper_id);
            $this->db->delete('subjectpaper');
            $message = DELETE_RECORD_CONSTANT . " On subject paper subjectpaper_id " . $subjectpaper_id;
            $action = "Delete";
            $record_id = $subjectpaper_id;
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
            if (isset($data['subjectpaper_id'])) {
            $this->db->where('subjectpaper_id', $data['subjectpaper_id']);
            $this->db->update('subjectpaper', $data);
            $message = UPDATE_RECORD_CONSTANT . " On  subject paper subjectpaper_id " . $data['subjectpaper_id'];
            $action = "Update";
            $record_id = $data['subjectpaper_id'];
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
            $this->db->insert('subjectpaper', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On subject paper subjectpaper_id " . $insert_id;
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
            
            public function getSubjects()
            {
            $sql="select * from subjects";
            $query=$this->db->query($sql); 
            return $query->result_array();
            }
            
            public function setStatus($subjectpaperid,$status)
            {
            $sql = "update subjectpaper set subjectpaper_status=$status where subjectpaper_id=$subjectpaperid";
            return $this->db->query($sql);
            }            
            


            
            
            public function getsubjectpapers()
            {
            $this->db->select('*');   
            $this->db->from('semestersubjectpaper');
            $this->db->where(array('sem_paper_status'=>1));
            $query = $this->db->get();
            return $query->result_array();
            }



            public function get_papers_by_group($group_id)
            {
            $this->db->select('*');
            $this->db->from('semestersubjectpaper');
            $this->db->where('sem_paper_status', 1);
            $this->db->where('sem_paper_group_id', $group_id);
            $query = $this->db->get();
            return $query->result_array();
            }

            public function get_papers_by_subject($subject_id)
            {
            $this->db->select('*');
            $this->db->from('semestersubjectpaper');
            $this->db->where('sem_paper_status', 1);
            $this->db->where('sem_paper_subject_id', $subject_id);
            $query = $this->db->get();
            return $query->result_array();
            }

            public function get_subject_by_paper($paper_id)
            {
            $this->db->select('subjects.id, subjects.name');
            $this->db->from('semestersubjectpaper');
            $this->db->join('subjects', 'subjects.id = semestersubjectpaper.sem_paper_subjectid', 'left');
            $this->db->where('semestersubjectpaper.sem_paper_id', $paper_id);
            $query = $this->db->get();
            return $query->row_array();
            }



            public function  subpaperlist()
            {
            $this->db->select('*');   
            $this->db->from('subjectpaper');
            $this->db->where(array('subjectpaper_status'=>1));
            $query = $this->db->get();
            return $query->result_array();
            }




            }
