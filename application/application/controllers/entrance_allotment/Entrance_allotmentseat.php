<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entrance_allotmentseat extends Admin_Controller 
{

    public function selectInstitute()
    {
        $course_id = $this->input->get('course_id');
        $data     = $this->Entrance_allotmentseatmodel->examgetInstitute($course_id);
        echo json_encode($data);

    }

        public function selectCenter()
    {
        $course_id = $this->input->get('course_id');
        $data     = $this->Entrance_allotmentseatmodel->examgetCenter($course_id);
        echo json_encode($data);
    }
    
    

        public function allotmentseat()
	    {
	        
	    if (!$this->rbac->hasPrivilege('allotment_seat', 'can_view')) 
        {
        access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'entrance_allotment');
        $this->session->set_userdata('sub_menu', 'entrance_allotment/Entrance_allotmentseat/allotmentseat');  
	        
	        
        $data['current_session']    =  $this->Entrance_settings_model->get_entrance_settings();
        $current_session            =  $data['current_session']; 
        $sessionlist                =  $this->Entrance_allotmentseatmodel->AllSession();
        $data['sessionlist']        =  $sessionlist;
        $courselist                 =  $this->Entrance_allotmentseatmodel->AllCourse($current_session['cur_session']);
        $data['courselist']         =  $courselist;
        $seattypelist               =  $this->Entrance_allotmentseatmodel->allseattypes();
        $data['seattypelist']       =  $seattypelist;
        $seatlist                   =  $this->Entrance_allotmentseatmodel->AllSeat($current_session['cur_session']);
        $data['seatlist']           =  $seatlist;
    	$this->load->view('layout/headerentrance', $data);
        $this->load->view('admin/entranceexam/allotmentseat/addallotmentseat', $data);
        $this->load->view('layout/footer', $data);
        }
        
        

	public function addseat()
	{
        $year=$this->input->post('seat_year');
        $session=$this->input->post('seat_session');
        $seatno=$this->input->post('seat_seatno');
		$course=$this->input->post('course_id');
        $institute=$this->input->post('institute_id');
        $center=$this->input->post('center_id');
        $type=$this->input->post('seat_type');
        $status=$this->input->post('seat_status');
		$data=array('entrance_allot_seat_year'=>$year,'entrance_allot_seat_sessionid'=>$session,'entrance_allot_seat_seatno'=>$seatno,'entrance_allot_seat_course'=>$course,'entrance_allot_seat_institute'=>$institute,'entrance_allot_seat_center'=>$center,'entrance_allot_seat_type'=>$type,
		'entrance_allot_seat_status'=>$status,'entrance_allot_seat_created_date'=>date('d-m-Y H:i:s'));
		$query=$this->Entrance_allotmentseatmodel->seatadd($data);
	
         if(empty($query)) {
            $error = array("Record not saved. Please try again.");
            $array = array('status' => 'fail', 'error' => $error, 'message' => '');
        } else {
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
		//redirect('Entrance_allotmentseat/allotmentseat');
	}



	public function editseat($id) 
	{
    if (!$this->rbac->hasPrivilege('allotment_seat', 'can_view')) 
    {
    access_denied();
    }
    
    $this->session->set_userdata('top_menu', 'entrance_allotment');
    $this->session->set_userdata('sub_menu', 'entrance_allotment/Entrance_allotmentseat/allotmentseat');   
	    
	$data['current_session']=  $this->Entrance_settings_model->get_entrance_settings();
    $current_session        =  $data['current_session']; 
    $sessionlist            = $this->Entrance_allotmentseatmodel->AllSession();
    $data['sessionlist']    = $sessionlist;
    $courselist             = $this->Entrance_allotmentseatmodel->AllCourse($current_session['cur_session']);
    $data['courselist']     = $courselist;
    $seattypelist           = $this->Entrance_allotmentseatmodel->allseattypes();
    $data['seattypelist']   = $seattypelist;  
    $seatlist               = $this->Entrance_allotmentseatmodel->AllSeat($current_session['cur_session']);
    $data['seatlist']       = $seatlist;	
    $seatedit               = $this->Entrance_allotmentseatmodel->getseat($id);
    $data['seatedit']       = $seatedit;
	$this->load->view('layout/headerentrance', $data);
    $this->load->view('admin/entranceexam/allotmentseat/editallotmentseat', $data);
    $this->load->view('layout/footer', $data);
    }
    
    

    public function updateseat() {
        $id=$this->input->post('seat_id');
        $year=$this->input->post('seat_year');
        $session=$this->input->post('seat_session');
        $seatno=$this->input->post('seat_seatno');
        $course=$this->input->post('course_id');
        $institute=$this->input->post('institute_id');
        $center=$this->input->post('center_id');
        $type=$this->input->post('seat_type');
        $status=$this->input->post('seat_status');
        $query=$this->Entrance_allotmentseatmodel->seatupdate($id,$year,$session,$seatno,$course,$institute,$center,$type,$status);
         if(empty($query)) {
            $error = array("Record not updated. Please try again.");
            $array = array('status' => 'fail', 'error' => $error, 'message' => '');
        } else {
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
     	//redirect('Entrance_allotmentseat/allotmentseat');
    }

    public function deleteseat($id) {
	    $this->Entrance_allotmentseatmodel->seatdelete($id);
	    redirect('entrance_allotment/Entrance_allotmentseat/allotmentseat');
    }
}
?>
 