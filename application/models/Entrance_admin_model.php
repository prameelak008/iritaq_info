            <?php
            defined('BASEPATH') OR exit('No direct script access allowed');
            
            class Entrance_admin_model extends CI_Model
            {
            
            
            
            public function index()
            {
            
            }
            
            
            
            public function paymentdetails()
            {
                
            $this->db->select('*');
            $this->db->from('entrance_examregister');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=entrance_examregister.entrance_reg_id');
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            public function payment_details_bysession($sess_id)
            {
                
            $this->db->select('*');
            $this->db->from('entrance_examregister');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=entrance_examregister.entrance_reg_id');
            $this->db->where(array('admission_form_tbl.admission_sessionid'=>$sess_id));
            
            $query=$this->db->get();
            return $query->result_array();
            
            }
            
            
            
            
            public function fees_details($id)
            {
            $this->db->select('*');
            $this->db->from('fees_entrancepayment');
            $this->db->where(array('fees_entrancepayment_student_id'=>$id));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            public function paymentdetails_byapplicant($id)
            {
            $this->db->select('*');
            $this->db->from('entrance_examregister');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=entrance_examregister.entrance_reg_id');
             $this->db->where(array('admission_form_tbl.admission_application_registerid' => $id));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            
            
            
            
            

            }