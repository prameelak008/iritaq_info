<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Apply_leave extends Student_Controller
{

        public function __construct()
        {
        parent::__construct();
        $this->load->model("filetype_model");
        $this->load->library('Zend');
        }
        
        

        public function index()
        {
        $this->session->set_userdata('top_menu', 'apply_leave');
        $student_session_id     = $this->session->userdata['current_class']['student_session_id'];
        $student_id             = $this->customlib->getStudentSessionUserID();
        
        $student                = $this->student_model->get($student_id);
        $data['results']        = $this->apply_leave_model->get_student($student_session_id);
        
        $data['studentclasses'] = $this->studentsession_model->searchMultiClsSectionByStudent($student_id);
        
        $this->load->view('layout/student/header', $data);
        $this->load->view('user/apply_leave/apply_leave', $data);
        $this->load->view('layout/student/footer', $data);
        }
        
        

        public function get_details($id)
        {
        $data               = $this->apply_leave_model->get($id, null, null);
        $data['from_date']  = date($this->customlib->getSchoolDateFormat(), strtotime($data['from_date']));
        $data['to_date']    = date($this->customlib->getSchoolDateFormat(), strtotime($data['to_date']));
        $data['apply_date'] = date($this->customlib->getSchoolDateFormat(), strtotime($data['apply_date']));
        echo json_encode($data);
        }
        

        public function add()
        {
        $student_id = $this->customlib->getStudentSessionUserID();
        $this->form_validation->set_rules('apply_date', $this->lang->line('apply') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('from_date', $this->lang->line('from') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', $this->lang->line('to') . " " . $this->lang->line('date'), 'trim|required|xss_clean');
        
        $this->form_validation->set_rules('leave_from_time', $this->lang->line('to') . " " . $this->lang->line('time'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('leave_to_time', $this->lang->line('from') . " " . $this->lang->line('time'), 'trim|required|xss_clean');
        
        $this->form_validation->set_rules('student_session_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('userfile', $this->lang->line('document'), 'callback_handle_upload[userfile]');

        if ($this->form_validation->run() == false) {

            $msg = array(
                'apply_date'         => form_error('apply_date'),
                'student_session_id' => form_error('student_session_id'),
                'from_date'          => form_error('from_date'),
                'to_date'            => form_error('to_date'),
                'userfile'           => form_error('userfile'),
                'leave_from_time'    => form_error('leave_from_time'),
                'leave_to_time'      => form_error('leave_to_time'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $data = array(
                'apply_date'         => date('Y-m-d'),
                'from_date'          => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('from_date'))),
                'to_date'            => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('to_date'))),
                'student_session_id' => $this->input->post('student_session_id'),
                'reason'             => $this->input->post('message'),
                'leave_from_time'    => $this->input->post('leave_from_time'),
                'leave_to_time'      => $this->input->post('leave_to_time'),
                
            );

            if ($this->input->post('leave_id') == '') {
                $leave_id = $this->apply_leave_model->add($data);
            } else {
                $data['id'] = $this->input->post('leave_id');
                $leave_id   = $data['id'];
                $this->apply_leave_model->add($data);
            }

            if (isset($_FILES["userfile"]) && !empty($_FILES['userfile']['name'])) {
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $img_name = $leave_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["userfile"]["tmp_name"], "./uploads/student_leavedocuments/" . $img_name);
                $data = array('id' => $leave_id, 'docs' => $img_name);
                $this->apply_leave_model->add($data);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }
    

    public function remove_leave($id)
    {

        $this->apply_leave_model->remove_leave($id);
        redirect('user/apply_leave');
    }

    public function download($doc)
    {

        $this->load->helper('download');
        $filepath = "./uploads/student_leavedocuments/" . $doc;
        $data     = file_get_contents($filepath);
        $name     = $doc;

        force_download($name, $data);
    }

    public function handle_upload($str, $var)
    {

        $image_validate = $this->config->item('file_validate');
        $result         = $this->filetype_model->get();
        if (isset($_FILES[$var]) && !empty($_FILES[$var]['name'])) {

            $file_type = $_FILES[$var]['type'];
            $file_size = $_FILES[$var]["size"];
            $file_name = $_FILES[$var]["name"];

            $allowed_extension = array_map('trim', array_map('strtolower', explode(',', $result->file_extension)));
            $allowed_mime_type = array_map('trim', array_map('strtolower', explode(',', $result->file_mime)));
            $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($files = filesize($_FILES[$var]['tmp_name'])) {

                if (!in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'File Type Not Allowed');
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', 'Extension Not Allowed');
                    return false;
                }
                if ($file_size > $result->file_size) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }

            } else {
                $this->form_validation->set_message('handle_upload', "File Type / Extension Error Uploading ");
                return false;
            }

            return true;
        }
        return true;

    }
    
    
    
    
        public function lvreport()
        {
            
        $data['current_session']        = $this->setting_model->getCurrentSession();
        $current_session                = $data['current_session'] ;
        $leaveid                        = $this->input->post('leaveid');
        $ssid                           = $this->input->post('ssid');
        $sid                            = $this->input->post('sid');
        $cls                            = $this->input->post('cls');
        $sctn                           = $this->input->post('sctn');
        $from                           = $this->input->post('from');
        $to                             = $this->input->post('to');
        $fromtime                       = $this->input->post('fromtime');
        $totime                         = $this->input->post('totime');
        //student list
        
        $data['leaveid']                = $leaveid;
        $stulist                        = $this->apply_leave_model->studentlist($sid,$current_session);
        $data['stulist']                = $stulist;
        
        
        $data['student_leavesession']   = $this->apply_leave_model->total_leave($stulist->session_id,$current_session);
                
        $this->db->where(array('id'=>$stulist->id, 'barcode' => ""));      
        $q 		    = $this->db->get('students');
        
        if ($q->num_rows() > 0) 
        {
        $data            =  [];
        $code            =  $stulist->admission_no;
        
        $this->zend->load('Zend/Barcode');
        $imageResource   = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
        imagepng($imageResource, 'barcodes/'.$code.'.png');
        $data['barcode'] = 'barcodes/'.$code.'.png';
        $barcode         =  $data['barcode'] ;
        $data            =  array('barcode'  =>  'barcodes/'.$code.'.png' );
        $this->db->where('id',$stulist->id);
        $this->db->update('students', $data);
        }

        //classteacher
        
        $classteacher                   = $this->apply_leave_model->getclsteacher($cls,$sctn,$current_session);
        $data['classteacher']           = $classteacher;

        //working days
         $worklist                      = $this->apply_leave_model->workdays($ssid);
         $data['worklist']              = $worklist;


        //attending days
        $att                            = $this->apply_leave_model->attendingdays($ssid);
        $data['att']                    = $att;

        // leave details
         $tott_leave                    = $this->apply_leave_model->totalleavedetails($leaveid);
         $data['tott_leave']            = $tott_leave;
         
         $totalleave                    = $this->apply_leave_model->totalleavedetails_val($ssid);
         $data['totalleave']            = $totalleave;
        
        
        $this->load->view('user/apply_leave/leaveprint',$data);
      
        }
    
    
    
    

}
