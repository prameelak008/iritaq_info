<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


class Cardtest extends Student_Controller
{

    public $school_name;
    public $school_setting;
    public $setting;
    public $payment_method;

    public function __construct()
    {
        parent::__construct();

        $this->sch_setting_detail = $this->setting_model->getSetting();

    }
		
	
		 public function meTrnReq()
		 {

         $checklist			  = array();
         $data['sch_setting'] = $this->sch_setting_detail;      

         $checklist           = $this->input->post('fee_checkbox');

       

			foreach($checklist as $ch)
			{
			$rec				   = explode(',',$ch);

            $fee_groups_feetype_id = $rec[2];
            $fee_master_id         = $rec[1];
            $fee_session_group_id  = $rec[0];
            $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
            $fees_array[]          = $feeList;
			}
		
	

		  $this->session->set_userdata('fee_master_id', $fee_master_id);
		  $this->session->set_userdata('fee_groups_feetype_id', $fee_groups_feetype_id);       
     
          $data['feearray'] = $fees_array;
          $this->load->view('layout/student/header', $data);
          $this->load->view('Standard/meTrnReq', $data);
          $this->load->view('layout/student/footer', $data);
    }
                 

	






		
	
	
	    public function meTrnPayment()
	    {
		$amount=$this->input->post('amount_to_be_pay_Newtot');
		$paise=$amount*100;
		
	
		$data['OrderId']    	 = $this->input->post('OrderId');
        $data['responseUrl']     = $this->input->post('responseUrl');
		
		/*$data['amount'] 		 = $this->input->post('amount');*/
		
		$data['amount'] 		 = $paise;
		
		$data['meTransReqType']  = $this->input->post('meTransReqType');
		$data['currencyName'] 	 = $this->input->post('currencyName');
		$data['mid']    		 = $this->input->post('mid');
		$data['enckey']          = $this->input->post('enckey');
		
		
		$data['recurPeriod'] 	 = $this->input->post('recurPeriod');
		$data['numberRecurring'] = $this->input->post('numberRecurring');
		$data['recurDay'] 		 = $this->input->post('recurDay');
		$data['addField1']       = $this->input->post('addField1');
		$data['addField2']       = $this->input->post('addField2');
		$data['addField3']       = $this->input->post('addField3');
		$data['addField4']       = $this->input->post('addField4');
		$data['addField5']       = $this->input->post('addField5');
		$data['addField6']       = $this->input->post('addField6');
		$data['addField7']       = $this->input->post('addField7');
		$data['addField8']       = $this->input->post('addField8');



			$collected_array  	= array();
            $collected_by    	= " Collected By: " . $this->customlib->getAdminSessionUserName();
			$staff_record 	 	= $this->staff_model->get($this->customlib->getStaffID());
            

            $total_row 		 	= $this->input->post('row_counter');
			$tot=0;

            foreach ($total_row as $total_row_key => $total_row_value)
			{	

                $this->input->post('student_fees_master_id_' . $total_row_value);
                $this->input->post('fee_groups_feetype_id_' . $total_row_value);

				

                $json_array = array(
                    'amount'          => $this->input->post('fee_amount_' . $total_row_value),
                    'date'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('collected_date'))),
                    'description'     => $this->input->post('fee_gupcollected_note') . $collected_by,
                    'amount_discount' => 0,
                    'amount_fine'     => $this->input->post('fee_groups_feetype_fine_amount_' . $total_row_value),
                    'payment_mode'    => $this->input->post('payment_mode_fee'),
                    'received_by'     => $staff_record['id'],
                );
				
                $collected_array[] = array(
                    'student_fees_master_id' => $this->input->post('student_fees_master_id_' . $total_row_value),
                    'fee_groups_feetype_id'  => $this->input->post('fee_groups_feetype_id_' . $total_row_value),
                    'amount_detail'          => $json_array,
                );
				
				$tot+=$total_row_value;
			}
			

          
		   $this->session->set_userdata('collected_array', $collected_array);		   
		   $this->session->userdata('collected_array');
    

$this->load->view('Standard/meTrnPay',$data);		
	}


	
	public function meTrnSuccess()
	{
	$this->load->view('Standard/meTrnSuccess');
	}
	
	
	
	
	
	
	public function meTrnCancelReq()
	{
	$this->load->view('Standard/meTrnSuccess' );
	}
	
	
	
	public function paymentfailed()
	{

	$data['sch_setting'] = $this->sch_setting_detail; 

	$this->load->view('layout/student/header', $data);
	$this->load->view('Standard/failed');
	$this->load->view('layout/student/footer', $data);


	}
	
	
	
		public function paymentsuccess()
		{
		$collected_array=$this->session->userdata('collected_array');
		$this->studentfeemaster_model->fee_deposit_collections($collected_array);
		
		
		
		$this->load->view('layout/student/header', $data);
		$this->load->view('Standard/success');
		$this->load->view('layout/student/footer', $data);
	   
		}
		
		

		public function failedpage()
		{
			$this->load->view('Standard/failedpage');
		}

	

}
