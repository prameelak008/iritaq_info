
                <?php
                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }  


                class Apply_leave extends MY_Controller
                {
                public function __construct() {
                parent::__construct();
                $this->sch_setting_detail = $this->setting_model->getSetting();
                } 


                public function index()
                { 
                $sem                        = $this->session->userdata('sem_student');  
                $sem_group_id               = $sem['sem_group_id'];
                $student_id                 = (int)$sem['user_id']; 

                $data['firstname']          = $sem['firstname'];


                $data['applyleavelist']     = $this->semesterauth_model->applyleavelist($student_id,$sem_group_id);  

                $this->load->view('layout/semester/header', $data);
                $this->load->view('user_semester/user/apply_leave', $data);
                $this->load->view('layout/semester/datatables', $data);
                $this->load->view('layout/semester/footer', $data); 
                }




                public function add_leave()
                {
                $sem            = $this->session->userdata('sem_student');
                $sem_group_id   = $sem['sem_group_id'];
                $sem_student_id = $sem['user_id'];

                $doc_name = '';


                if (!empty($_FILES['document']['name'])) {

                $config['upload_path']   = FCPATH . 'files/students/apply_leave/';
                $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
                $config['max_size']      = 2048; // 2MB
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if ($this->upload->do_upload('document')) {
                $uploadData = $this->upload->data();
                $doc_name = $uploadData['file_name'];
                } else {

                echo $this->upload->display_errors();
                exit;
                }
                }

                $data = array(
                'sem_student_id'   => $sem_student_id,
                'sem_group_id'     => $sem_group_id,
                'apply_date'       => $this->input->post('applyDate'),
                'from_date'        => $this->input->post('fromDate'),
                'to_date'          => $this->input->post('toDate'),
                'leave_from_time'  => $this->input->post('fromTime'),
                'leave_to_time'    => $this->input->post('toTime'),
                'reason'           => $this->input->post('reason'),
                'docs'             => $doc_name,
                'status'           => '1',
                'request_type'     => '0',
                'created_at'       => date('Y-m-d H:i:s')
                );
                $this->db->insert('sem_student_applyleave', $data);
                $this->session->set_flashdata('msg', 'Leave applied successfully');
                redirect($_SERVER['HTTP_REFERER']);
                }


                public function update_leave()
                {
                $id                 = $this->input->post('leave_id');   
                $data               = array(
                'apply_date'       => $this->input->post('applyDate'),
                'from_date'        => $this->input->post('fromDate'),
                'to_date'          => $this->input->post('toDate'),
                'leave_from_time'  => $this->input->post('fromTime'),
                'leave_to_time'    => $this->input->post('toTime'),
                'reason'           => $this->input->post('reason'),
                );

                $this->db->where('id', $id);
                $this->db->update('sem_student_applyleave', $data);

                redirect($_SERVER['HTTP_REFERER']);
                }

                public function delete($id)
                {
                $this->db->where('id', $id);
                $this->db->delete('sem_student_applyleave');

                $this->session->set_flashdata('msg', 'Leave deleted');
                redirect($_SERVER['HTTP_REFERER']);
                }






                }

