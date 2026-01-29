        <?php
        
        if (!defined('BASEPATH'))
        exit('No direct script access allowed');
        
        class Periodwise_model extends MY_Model {
        
        public function __construct() {
        parent::__construct();
        }
        
        public function get()
        {
        $this->db->select('*');
        $this->db->from('periodic_table');
        $this->db->order_by('periodic_table_id');
        $query=$this->db->get();
        return $query->result_array();
        }
        public function getbyid($id)
        {
        $this->db->select('*');
        $this->db->from('periodic_table');
        $this->db->where('periodic_table_id',$id);
        $query=$this->db->get();
        return $query->row_array();
        }
        }
