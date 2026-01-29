            <?php
            
            if (!defined('BASEPATH'))
            exit('No direct script access allowed');
            
            class ImportFeesmodel extends MY_Model {
            
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            public function insert($data)
            {
            $res = $this->db->insert_batch('student_fees_deposite',$data);       
            
            if($res)
            {
            return TRUE;
            }
            
            else
            {
            return FALSE;
            }
            
            }
            
            public function list_valuedata($table,$condition)
            {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function student_studentsession($condnew)
            {
            $this->db->select('student_session.id as student_sessionid');              
            $this->db->from('students');     
            $this->db->join('student_session', 'student_session.student_id = students.id');
            $this->db->join('sessions', 'sessions.id = student_session.session_id');
            $this->db->where('students.admission_no', $condnew);
            $this->db->where('student_session.session_id',  $this->current_session);
            $q = $this->db->get();
            $response = $q->row_array();
            return $response;
            
            }
            
            
            
            
         
            
            
            public function feetype_fee_groups_feetype($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $q = $this->db->get();
            $respnse =$q->result_array();
            return $respnse;
            }
            
            
            
            
            public function feetype_fee_groups_feb($ses_id)
            {
            
            $this->db->select('fee_groups_feetype.id as idd');              
            $this->db->from('fee_groups_feetype');
            $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Feb');
            $q = $this->db->get();
            $response = $q->row_array();
            return $response;
            }
            
            
            public function feejan($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Jan');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feefeb($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Feb');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            
            public function feemar($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Mar');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feeapr($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Apr');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feemay($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'May');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feejun($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Jun');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feejul($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Jul');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feeaug($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Aug');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            public function feesep($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Sep');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            public function feeoct($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Oct');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            public function feenov($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Nov');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            public function feedec($ses_id)
            {
            $this->db->select('fee_groups_feetype.id as idd,feetype.code as Code');              
            $this->db->from('fee_groups_feetype');
            //$this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
            
            $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
            //$this->db->join('fee_session_groups', 'fee_session_groups.id = fee_groups_feetype.session_id');
            $this->db->where('fee_groups_feetype.fee_session_group_id', $ses_id);
            $this->db->where('fee_groups_feetype.session_id', $this->current_session);
            $this->db->where('feetype.code', 'Dec');
            
            $q = $this->db->get();
            return $q->row_array();
            }
            
            
            
            
            }
