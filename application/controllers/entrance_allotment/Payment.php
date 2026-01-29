            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Payment extends Admin_Controller 
            {
            
           
           
           
            
            public function checkpayment() 
            {
                
            if (!$this->rbac->hasPrivilege('update_payment', 'can_view')) 
            {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'entrance_payment');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/payment/checkpayment');
            
            
            
            $data['current_session']        =  $this->user_model->get_current_session();
            $data['title']                  = 'Check Payment';
            $ta                             = "sessions";
            
            // $table                          = "entranceexam_course";
            // $condition                      =  array('entranceexam_course_status'=>1);
            // $data['course']                 =  $this->Entranceallotment_model->list_data($table,$condition);
            
       
            $data['current_entrancesession']= $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession        = $data['current_entrancesession'];
            $data['course']                 =  $this->Entranceallotment_model->entrance_course($current_entrancesession['cur_session']);
            $data['courseid']               =  $this->input->post('entrance_course');
            $courseid                       =  $data['courseid'];
            
            //$data['session_id']           =  $this->input->post('session');
            
            $session_id                     =  $data['session_id'];
            $data['subjectid']              =  $this->input->post('entrance_subject');
            $subjectid                      =  $data['subjectid'];
            $data['sessionlist']            =  $this->Entranceallotment_model->list_dat($ta);
           
           $data['applicants']             =  $this->Entranceallotment_model->get_feeapplicants($courseid,$current_entrancesession['cur_session']);
            //$data['applicants']           =  $this->Entranceallotment_model->get_feeapplicants($courseid,$session_id);
            $data['entrancefees']           =  $this->Entranceallotment_model->get_entrancefees();
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/payment/checkpayment', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            
            
            
            public function updatefees()
            {
            $orderid            = $this->input->post('orderid');
            $transaction        = $this->input->post('transaction');
            $amount             = $this->input->post('amount');
            $transactiondate    = $this->input->post('transactiondate');
            $registerno         = $this->input->post('registerno');
            $applicationno      = $this->input->post('applicationno');
            $statuscode         = $this->input->post('transactioncode');
            $status             = $this->input->post('getstatus');
            $year               = date('Y');
            $data                                           =  array(
            'fees_entrancepayment_student_id'               =>  $registerno, 
            'fees_entrancepayment_registerid'               =>  $registerno,
            'fees_entrancepayment_year'                     =>  $year,
            'fees_entrancepayment_applicationno'            =>  $applicationno,
            'fees_entrancepayment_orderid'                  =>  $orderid,
            'fees_entrancepayment_transaction_no'           =>  $transaction,
            'fees_entrancepayment_amount'                   =>  $amount,
            'fees_entrancepayment_statuscode'               =>  'S',
            'fees_entrancepayment_transdate'                =>  $transactiondate,
            'fees_entrancepayment_updated_date'             =>  date('y-m-d h:i:s'));
            $this->db->insert('fees_entrancepayment',$data);
            
            $dat                                           =  array(
            'admission_payment'                             =>  'Paid');
            $this->db->where('admission_application_registerid', $registerno);
            $this->db->update('admission_form_tbl', $dat);
            $dot             =  array(
            'ui_payment'                             =>  '1');
            $this->db->where('reg_id', $registerno);
            $this->db->update('set_entrance_uidesign', $dot);
            redirect('entrance_allotment/Payment/checkpayment');
            }
            
            
            
            
            
            public function deletefees($id,$regid)
            {
            $dat                                           =  array(
           'admission_payment'                             =>  NULL);
            $this->db->where('admission_application_registerid', $regid);
            $this->db->update('admission_form_tbl', $dat);
            $cond=array('fees_entrancepayment_id'=>$id);
            $this->db->delete('fees_entrancepayment',$cond);
            redirect('entrance_allotment/Payment/checkpayment');
            }
            
            }
            ?>