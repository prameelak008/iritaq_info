<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


class Exam_schedule extends Admin_Controller
{
    private $sch_current_session = "";

    public function __construct()
    {
    parent::__construct();
    $this->load->library('encoding_lib');
    $this->exam_type           = $this->config->item('exam_type');
    $this->sch_current_session = $this->setting_model->getCurrentSession();
    }
    
    
    public function index()
    {
    $this->session->set_userdata('top_menu', 'Examinations');
    $this->session->set_userdata('sub_menu', 'Examinations/Examschedule');
    $examgroup_result      = $this->examgroup_model->get();
    $data['examgrouplist'] = $examgroup_result;
    
    $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == false) 
    {
    } 
    else
    {
    $exam_group_id           = $this->input->post('exam_group_id');
    $id                      = $_POST['exam_id'];
    $data['getgroup_name']   = $this->examresult_model->getgroup_name($id, $exam_group_id);
    $data['examgroupDetail'] = $this->examgroup_model->getExamByID($id);
    $data['exam_subjects']   = $this->batchsubject_model->getExamSubjects($id);
    $class                   = $this->class_model->get();
    $data['classlist']       = $class;
    $session                 = $this->session_model->get();
    $data['sessionlist']     = $session;
    $data['current_session'] = $this->sch_current_session;
    $data['exam_group_id']   = $exam_group_id;
    $data['id']              = $id;
    }
    $this->load->view('layout/header',$data);
    $this->load->view('admin/exam_schedule/exam_schedule',$data);
    $this->load->view('layout/footer',$data);
    }

	
	
	
        public function exportformat()
        {
        $data['id']                      = $this->input->post('exam_id');
        $id                              = $data['id'];
        $data['exam_group_name']         = $this->input->post('exam_group_name');
        $exam_group_name                 = $data['exam_group_name'];
        $filename = $exam_group_name.''.date('Y-m-d').'.csv';		
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; "); 
        
        // get data
        $usersData = $this->batchsubject_model->let_export($id);
        // file creation
        $file = fopen('php://output', 'w');
        
        $header = array("","subject_id","date_from","time_from","duration","room_no","max_marks","min_marks","credit_hours","date_to","is_active","created_at","updated_at","max_cmarks","min_cmarks");
        fputcsv($file, $header);
         
        foreach ($usersData as $key=>$line)
        {
        fputcsv($file,$line);
        }
        fclose($file);
        exit;
        }
        
        
        
            public function importformat()
            {
                
            $data['exam_id']    =  $this->input->post('exam_id');
            $exam_id            =  $data['exam_id'];
            
              
                
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) 
            {
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if ($ext == 'csv') {
                $file = $_FILES['file']['tmp_name'];
                $this->load->library('CSVReader');
                $result = $this->csvreader->parse_file($file);

                $rowcount = 0;
                
                if (!empty($result))
                {
                    foreach ($result as $r_key => $r_value) 
                    {
                    $date= $r_value['date_from'];
                    $created_at= $r_value['created_at'];
                    $date_to= $r_value['date_to'];
                    $updated_at= $r_value['updated_at'];
                     
                   $result[$r_key]['exam_group_class_batch_exams_id']     = $exam_id;
                    $result[$r_key]['subject_id']      = $this->encoding_lib->toUTF8($result[$r_key]['subject_id']);
                    $result[$r_key]['date_from']       =  date("Y-m-d", strtotime($date));
                    $result[$r_key]['time_from']       = $this->encoding_lib->toUTF8($result[$r_key]['time_from']);
                    $result[$r_key]['duration']        = $this->encoding_lib->toUTF8($result[$r_key]['duration']);
                    $result[$r_key]['room_no']         = $this->encoding_lib->toUTF8($result[$r_key]['room_no']);
                    $result[$r_key]['max_marks']       = $this->encoding_lib->toUTF8($result[$r_key]['max_marks']);
                    $result[$r_key]['min_marks']        = $this->encoding_lib->toUTF8($result[$r_key]['min_marks']);
                    $result[$r_key]['credit_hours']     = $this->encoding_lib->toUTF8($result[$r_key]['credit_hours']);
                    $result[$r_key]['date_to']          ='';
                    $result[$r_key]['is_active']        = $this->encoding_lib->toUTF8($result[$r_key]['is_active']);
                    $result[$r_key]['created_at']       = date("Y/m/d h:i", strtotime($created_at));;
                    $result[$r_key]['updated_at']       ='';
                    $result[$r_key]['max_cmarks']       = $this->encoding_lib->toUTF8($result[$r_key]['max_cmarks']);
                    $result[$r_key]['min_cmarks']       = $this->encoding_lib->toUTF8($result[$r_key]['min_cmarks']);
                    $rowcount++;
                    }

                    $this->db->insert_batch('exam_group_class_batch_exam_subjects', $result);
                }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            }
        } 
        
         
            redirect('admin/examgroup');
            
        }
        
        

}
?>