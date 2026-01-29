        <?php
        
        if (!defined('BASEPATH'))
        exit('No direct script access allowed');
        
        class Pay_storemodel extends MY_Model {
        
        public function __construct() 
        {
        parent::__construct();
        }
        
        
        public function insert_fees_payment($data)
        {
        $this->db->select('*');
        $this->db->from('fees_payment');
        $this->db->where(array('fees_payment_orderid'=>$data['fees_payment_orderid'],'fees_payment_statuscode'=>S));
        $query=$this->db->get();
        $res= $query->row_array();
        if($res=="")
        {
        $this->db->insert('fees_payment', $data);
        }
        }
        
        
        
        public function insert_entrance_fees_payment($data)
        {
           
        $this->db->select('*');
        $this->db->from('fees_entrancepayment');
        $this->db->where(array('fees_entrancepayment_orderid'=>$data['fees_entrancepayment_orderid'],'fees_entrancepayment_statuscode'=>S));
        $query=$this->db->get();
        $res= $query->row_array();
        if($res=="")
        {
        $this->db->insert('fees_entrancepayment', $data);
        }
        }
        
        
        public function insert_rev_fees_payment($data)
        {
        $this->db->select('*');
        $this->db->from('fees_revaluationpayment');
        $this->db->where(array('fees_revaluationpayment_orderid'=>$data['fees_payment_orderid'],'fees_revaluationpayment_statuscode'=>S));
        $query=$this->db->get();
        $res= $query->row_array();
        if($res=="")
        {
        $this->db->insert('fees_revaluationpayment', $data);
        }
        }
        
        public function insert_improve_fees_payment($data)
        {
        $this->db->select('*');
        $this->db->from('fees_improvementpayment');
        $this->db->where(array('fees_improvementpayment_orderid'=>$data['fees_payment_orderid'],'fees_improvementpayment_statuscode'=>S));
        $query=$this->db->get();
        $res= $query->row_array();
        if($res=="")
        {
        $this->db->insert('fees_improvementpayment', $data);
        }
        }
        
        
        // public function insert_ce_fees_payment($data)
        // {
        // $this->db->select('*');
        // $this->db->from('fees_sayexampayment');
        // $this->db->where(array('fees_sayexampayment_orderid'=>$data['fees_payment_orderid'],'fees_sayexampayment_statuscode'=>S));
        // $query=$this->db->get();
        // $res= $query->row_array();
        // if($res=="")
        // {
        // $this->db->insert('fees_sayexampayment', $data);
        // }
        // }
        
        
        
        
        public function insert_ce_fees_payment($data)
        {
        $this->db->select('*');
        $this->db->from('fees_sayexampayment');
        $this->db->where(array(
        'fees_sayexampayment_orderid'    => $data['fees_payment_orderid'],
        'fees_sayexampayment_statuscode' => 'F'));
        $query = $this->db->get();
        $res   = $query->row_array();
        if (empty($res)) 
        {
        $this->db->insert('fees_sayexampayment', $data);
        if ($data['fees_sayexampayment_statuscode'] == 'F') 
        {
        $insertid     = $this->db->insert_id();
        $this->db->select('*');
        $this->db->from('exam_group_exam_sayexam');
        $this->db->where(array(
        'exam_group_exam_sayexam_student_studentid' => $data['fees_sayexampayment_student_id'],
        'exam_group_exam_sayexam_examid'            => $data['fees_sayexampayment_examgroup'],
        'exam_group_exam_sayexam_examgroupid'       => $data['fees_sayexampayment_examgroupbatch'],
        'exam_group_exam_sayexam_termstatus'        => 1,
        'exam_attempts'                             => 2) 
        );
        $query_exam                                 =  $this->db->get();
        $exam_res                                   =  $query_exam->row_array();
        
        if (!empty($exam_res)) 
        {
        $this->db->select_max('exam_group_exam_sayexam_term');
        $this->db->from('exam_group_exam_sayexam');
        $this->db->where(array(
        'exam_group_exam_sayexam_student_studentid' => $data['fees_sayexampayment_student_id'],
        'exam_group_exam_sayexam_examid'            => $data['fees_sayexampayment_examgroup'],
        'exam_group_exam_sayexam_examgroupid'       => $data['fees_sayexampayment_examgroupbatch'],
        'exam_group_exam_sayexam_termstatus'        => 1 ,
        'exam_attempts'                             => '2'   
        ));
        
        $query_max_term = $this->db->get();
        $max_term_res   = $query_max_term->row_array();
        $new_term       = isset($max_term_res['exam_group_exam_sayexam_term']) ? $max_term_res['exam_group_exam_sayexam_term'] + 1 : 1;
        $this->db->where('exam_group_exam_sayexam_student_studentid', $data['fees_sayexampayment_student_id']);
        $this->db->where('exam_group_exam_sayexam_examid', $data['fees_sayexampayment_examgroup']);
        $this->db->where('exam_group_exam_sayexam_examgroupid', $data['fees_sayexampayment_examgroupbatch']);
        $this->db->where('exam_group_exam_sayexam_termpayment', '');
        $this->db->where('exam_group_exam_sayexam_termstatus', 1);
        $this->db->update('exam_group_exam_sayexam', array(
        'exam_group_exam_sayexam_term'        => $new_term,
        'exam_group_exam_sayexam_paymentid'   => $insertid,
        'exam_group_exam_sayexam_termpayment' => 'S'));
        
        $this->db->select_max('exam_group_exam_sayexam_term');
        $this->db->from('exam_group_exam_sayexam');
        $this->db->where('exam_group_exam_sayexam_student_studentid', $data['fees_sayexampayment_student_id']);
        $this->db->where('exam_group_exam_sayexam_examid', $data['fees_sayexampayment_examgroup']);
        $this->db->where('exam_group_exam_sayexam_examgroupid', $data['fees_sayexampayment_examgroupbatch']);
        $this->db->where('exam_attempts', 2);
        $query_max_term  = $this->db->get();
        $max_term_res    = $query_max_term->row_array();
        $max_sinterm     = isset($max_term_res['exam_group_exam_sayexam_term']) ? $max_term_res['exam_group_exam_sayexam_term'] : null;

        $term_data = array(
        'sayex_te_term_payment_term'   => $max_sinterm,
        'sayex_te_term_payment_status' => 1
        );
        $this->db->where('fees_sayexampayment_id', $insertid);
        $this->db->update('fees_sayexampayment', $term_data);
        }
        else
        {
        // $new_exam_data = array(
        // 'exam_group_exam_sayexam_student_studentid' => $data['fees_sayexampayment_student_id'],
        // 'exam_group_exam_sayexam_examid'            => $data['fees_sayexampayment_examgroup'],
        // 'exam_group_exam_sayexam_examgroupid'       => $data['fees_sayexampayment_examgroupbatch'],
        // 'exam_group_exam_sayexam_termstatus'        => 1,   
        // 'exam_group_exam_sayexam_term'              => 1,  
        // 'exam_group_exam_sayexam_termpayment'       => 'S'  
        // );
        // $this->db->insert('exam_group_exam_sayexam', $new_exam_data);
        }
        }
        }
        }
        
        
        public function insert_te_fees_payment($data)
        {
            
        $this->db->select('*');
        $this->db->from('fees_sayexampayment_temarks');
        $this->db->where(array(
        'fees_sayexampayment_orderid'    => $data['fees_payment_orderid'],
        'fees_sayexampayment_statuscode' => 'F'));
        $query = $this->db->get();
        $res   = $query->row_array();
       
        if (empty($res)) 
        {
        $this->db->insert('fees_sayexampayment_temarks', $data);
        
        if ($data['fees_sayexampayment_statuscode'] == 'F') 
        {
            
        $insertid     = $this->db->insert_id();
        $this->db->select('*');
        $this->db->from('exam_group_exam_sayexam_temarks');
        $this->db->where(array(
        'exam_group_exam_sayexam_student_studentid' => $data['fees_sayexampayment_student_id'],
        'exam_group_exam_sayexam_examid'            => $data['fees_sayexampayment_examgroup'],
        'exam_group_exam_sayexam_examgroupid'       => $data['fees_sayexampayment_examgroupbatch'],
        'exam_group_exam_sayexam_termstatus'        => 1,
        'exam_attempts'                             => '2'    
        ));
        $query_exam                                 =  $this->db->get();
        $exam_res                                   =  $query_exam->row_array();
        
         
        
        if (!empty($exam_res)) 
        {
        $this->db->select_max('exam_group_exam_sayexam_term');
        $this->db->from('exam_group_exam_sayexam_temarks');
        $this->db->where(array(
        'exam_group_exam_sayexam_student_studentid' => $data['fees_sayexampayment_student_id'],
        'exam_group_exam_sayexam_examid'            => $data['fees_sayexampayment_examgroup'],
        'exam_group_exam_sayexam_examgroupid'       => $data['fees_sayexampayment_examgroupbatch'],
        'exam_group_exam_sayexam_termstatus'        => 1,
        'exam_attempts'                             => '2'    
        ));
        
        $query_max_term = $this->db->get();
        $max_term_res   = $query_max_term->row_array();
        $new_term       = isset($max_term_res['exam_group_exam_sayexam_term']) ? $max_term_res['exam_group_exam_sayexam_term'] + 1 : 1;
        $this->db->where('exam_group_exam_sayexam_student_studentid', $data['fees_sayexampayment_student_id']);
        $this->db->where('exam_group_exam_sayexam_examid', $data['fees_sayexampayment_examgroup']);
        $this->db->where('exam_group_exam_sayexam_examgroupid', $data['fees_sayexampayment_examgroupbatch']);
        $this->db->where('exam_group_exam_sayexam_termpayment', 0);
        $this->db->where('exam_group_exam_sayexam_termstatus', 1);
        $this->db->where('exam_attempts', 2);
        
        $this->db->update('exam_group_exam_sayexam_temarks', array(
        'exam_group_exam_sayexam_term'        => $new_term,
        'exam_group_exam_sayexam_paymentid'   => $insertid,
        'exam_group_exam_sayexam_termpayment' => 'S'));
        
        $this->db->select_max('exam_group_exam_sayexam_term');
        $this->db->from('exam_group_exam_sayexam_temarks');
        $this->db->where('exam_group_exam_sayexam_student_studentid', $data['fees_sayexampayment_student_id']);
        $this->db->where('exam_group_exam_sayexam_examid', $data['fees_sayexampayment_examgroup']);
        $this->db->where('exam_group_exam_sayexam_examgroupid', $data['fees_sayexampayment_examgroupbatch']);
        $this->db->where('exam_attempts', 2);
        $query_max_term  = $this->db->get();
        $max_term_res    = $query_max_term->row_array();
        $max_sinterm     = isset($max_term_res['exam_group_exam_sayexam_term']) ? $max_term_res['exam_group_exam_sayexam_term'] : null;

        $term_data = array(
        'sayex_te_term_payment_term'   => $max_sinterm,
        'sayex_te_term_payment_status' => 1
        );
        $this->db->where('fees_sayexampayment_id', $insertid);
        $this->db->update('fees_sayexampayment_temarks', $term_data);
        }
        else
        {
        // $new_exam_data = array(
        // 'exam_group_exam_sayexam_student_studentid' => $data['fees_sayexampayment_student_id'],
        // 'exam_group_exam_sayexam_examid'            => $data['fees_sayexampayment_examgroup'],
        // 'exam_group_exam_sayexam_examgroupid'       => $data['fees_sayexampayment_examgroupbatch'],
        // 'exam_group_exam_sayexam_termstatus'        => 1,   
        // 'exam_group_exam_sayexam_term'              => 1,  
        // 'exam_group_exam_sayexam_termpayment'       => 'S'  
        // );
        // $this->db->insert('exam_group_exam_sayexam_temarks', $new_exam_data);
        }
        }
        }
        }
        
        
        
        
        public function insertentrance_fees_payment($data)
        {
        $this->db->select('*');
        $this->db->from('fees_entrancepayment');
        $this->db->where(array('fees_entrancepayment_orderid'=>$data['fees_payment_orderid'],'fees_entrancepayment_statuscode'=>S));
        $query=$this->db->get();
        $res= $query->row_array();
        if($res=="")
        {
        $this->db->insert('fees_entrancepayment', $data);
        }
        }
        }
