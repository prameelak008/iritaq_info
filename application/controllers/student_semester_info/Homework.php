
        <?php
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }  


        class Homework  extends MY_Controller
        {
        public function __construct() {
        parent::__construct();
        $this->sch_setting_detail = $this->setting_model->getSetting();
        } 




        public function index()
        { 
        $sem                        = $this->session->userdata('sem_student');  
        $sem_group_id               = $sem['sem_group_id'];
        $student_id                 = $sem['stud_id'];
        $data['homeworklist']       = $this->semesterauth_model->homeworklist($student_id,$sem_group_id); 
            
        $this->load->view('layout/semester/header', $data);
        $this->load->view('user_semester/user/homework', $data);
        $this->load->view('layout/semester/datatables', $data);  
        $this->load->view('layout/semester/footer', $data); 
        } 


        public function getEvaluationById()
        {
        $id = $this->input->post('id');
        $data = $this->db
        ->where('id', $id)
        ->get('sem_homework')
        ->row_array();
        echo json_encode($data);
        }


        


        // public function updateEvaluation()
        // {
        // $id    = $this->input->post('eval_id');
        // // $file  = $this->input->post('file');
        // $data       = [
        // // 'stud_docs' => $file, 
        // 'stud_message'     => $this->input->post('stud_message'),       
        // 'stud_updateddate' => date('Y-m-d H:i:s')
        // ];

        // $this->db->where('id', $id)->update('sem_homework_evaluation', $data);
        // } 
        
        


    public function updateEvaluation()
{
    $id = $this->input->post('eval_id');

    $file_name = null;

    if (!empty($_FILES['stud_file']['name'])) {

        $upload_path = realpath(FCPATH . 'files/students/homework_message') . DIRECTORY_SEPARATOR;

        if (!$upload_path) {
            echo json_encode([
                'status' => false,
                'error' => 'Upload folder not found'
            ]);
            return;
        }

        $ext = pathinfo($_FILES['stud_file']['name'], PATHINFO_EXTENSION);
        $file_name = 'hw_eval_' . time() . '_' . rand(1000,9999) . '.' . $ext;

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = '*';
        $config['file_name']     = $file_name;
        $config['overwrite']     = false;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('stud_file')) {
            echo json_encode([
                'status' => false,
                'error'  => strip_tags($this->upload->display_errors())
            ]);
            return;
        }
    }

    $data = [
        'stud_message'     => $this->input->post('stud_message'),
        'stud_updateddate' => date('Y-m-d H:i:s')
    ];

    if ($file_name != null) {
        $data['stud_docs'] = $file_name;
    }

    $this->db->where('id', $id)->update('sem_homework_evaluation', $data);

    echo json_encode(['status' => true]);
}       

        
        }

