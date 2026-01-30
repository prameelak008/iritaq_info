<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entrance_allotmenttype extends Admin_Controller 
{

    public function allotmenttype()
	{
        if (!$this->rbac->hasPrivilege('allotment_type', 'can_view')) 
        {
        access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'entrance_allotment');
        $this->session->set_userdata('sub_menu', 'EntranceExam/paymentdetailsentrance_allotment/Entrance_allotmenttype/allotmenttype');
     
     
     
        $seattypelist = $this->Entrance_allotmenttypemodel->allseattypes();
        $data['seattypelist'] = $seattypelist;	
    	$this->load->view('layout/headerentrance', $data);
        $this->load->view('admin/entranceexam/allotment_seattype/addallotmentseattype', $data);
        $this->load->view('layout/footer', $data);
    }

	public function addseattype()
	{
        $typename=$this->input->post('type_name');
		$typedesc=$this->input->post('type_desc');
        $typestatus=$this->input->post('type_status');
		$data=array('entrance_allot_type_name'=>$typename,'entrance_allot_type_description'=>$typedesc,'entrance_allot_type_status'=>$typestatus);
		$query=$this->Entrance_allotmenttypemodel->seattypeadd($data);
		redirect('entrance_allotment/Entrance_allotmenttype/allotmenttype');
	}

	public function editseattype($id)
	{
	    
        if (!$this->rbac->hasPrivilege('allotment_type', 'can_view')) 
        {
        access_denied();
        }
        
        $this->session->set_userdata('top_menu', 'entrance_allotment');
        $this->session->set_userdata('sub_menu', 'EntranceExam/paymentdetailsentrance_allotment/Entrance_allotmenttype/allotmenttype');
          
        $seattypelist = $this->Entrance_allotmenttypemodel->allseattypes();
        $data['seattypelist'] = $seattypelist;	
        $seattypeedit = $this->Entrance_allotmenttypemodel->getseattype($id);
        $data['seattypeedit'] = $seattypeedit;
    	$this->load->view('layout/headerentrance', $data);
        $this->load->view('admin/entranceexam/allotment_seattype/editallotmentseattype', $data);
        $this->load->view('layout/footer', $data);
    }

    public function updateseattype() {
        $typeid=$this->input->post('type_id');
    	$typename=$this->input->post('type_name');
        $typedesc=$this->input->post('type_desc');
        $typestatus=$this->input->post('type_status');
        $this->Entrance_allotmenttypemodel->seattypeupdate($typeid,$typename,$typedesc,$typestatus);
     	redirect('entrance_allotment/Entrance_allotmenttype/allotmenttype');
    }

    public function deleteseattype($id) {
	    $this->Entrance_allotmenttypemodel->seattypedelete($id);
	    redirect('entrance_allotment/Entrance_allotmenttype/allotmenttype');
    }
}
?>
 