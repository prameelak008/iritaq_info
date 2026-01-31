
                <?php
                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }  



                class Attendancelog extends MY_Controller
                {
                public function __construct() {
                parent::__construct();
                $this->sch_setting_detail = $this->setting_model->getSetting();
                } 




                // public function index()
                // {                   
                // $sem                        = $this->session->userdata('sem_student');  
                // $sem_group_id               = $sem['sem_group_id'];
                // $student_id                 = (int)$sem['user_id']; 
                // $data['firstname']          = $sem['firstname'];           

                // $data['get_datewise_attendence'] = $this->semesterauth_model->get_datewise_attendence($student_id,$sem_group_id);              

                // $this->load->view('layout/semester/header', $data);
                // $this->load->view('user_semester/user/date_wise_attendance', $data);
                // $this->load->view('layout/semester/datatables', $data);
                // $this->load->view('layout/semester/footer', $data); 
                // }




                public function index001()
                {                   
                $sem                        = $this->session->userdata('sem_student');  
                $sem_group_id               = $sem['sem_group_id'];
                $student_id                 = (int)$sem['user_id']; 
                $data['firstname']          = $sem['firstname'];

                // Initialize date variables
                $fromdate                   = '';
                $todate                     = '';

                // Form validation
                $this->form_validation->set_rules('fromdate', 'From Date', 'trim|required|xss_clean');
                $this->form_validation->set_rules('todate', 'To Date', 'trim|required|xss_clean');

                if ($this->form_validation->run() == false) {
                // Validation failed or first load - show all records
                // $data['get_datewise_attendence'] = $this->semesterauth_model->get_datewise_attendence($student_id, $sem_group_id);


                // $this->load->view('layout/semester/header', $data);
                // $this->load->view('user_semester/user/date_wise_attendance', $data);
                // $this->load->view('layout/semester/datatables', $data);
                // $this->load->view('layout/semester/footer', $data); 
                } else {
                // Validation passed - filter by dates
                $fromdate                           = $this->input->post('fromdate');
                $todate                             = $this->input->post('todate');

                $data['get_datewise_attendence']    = $this->semesterauth_model->get_datewise($student_id, $sem_group_id, $fromdate, $todate);
                }

                // Pass dates to view for repopulating form
                $data['fromdate']                   = $fromdate;
                $data['todate']                     = $todate;

                $this->load->view('layout/semester/header', $data);
                $this->load->view('user_semester/user/date_wise_attendance', $data);
                $this->load->view('layout/semester/datatables', $data);
                $this->load->view('layout/semester/footer', $data); 
                } 



                    public function index()
                    {                   
                    if (!$this->session->has_userdata('sem_student')) {
                    redirect('semester_auth/login');
                    exit;
                    }

                    $sem                = $this->session->userdata('sem_student');
                    $sem_group_id       = $sem['sem_group_id'];
                    $student_id         = (int)$sem['user_id'];
                    $data['firstname']  = $sem['firstname'];

                    $fromdate           = '';
                    $todate             = '';

                    $this->form_validation->set_rules('fromdate', 'From Date', 'trim|required');
                    $this->form_validation->set_rules('todate', 'To Date', 'trim|required');

                    if ($this->form_validation->run() === TRUE) {
                    $fromdate           = $this->input->post('fromdate');
                    $todate             = $this->input->post('todate');

                    $data['get_datewise_attendence'] =
                    $this->semesterauth_model->get_datewise(
                    $student_id,
                    $sem_group_id,
                    $fromdate,
                    $todate
                    );
                    }

                    $data['fromdate']   = $fromdate;
                    $data['todate']     = $todate;

                    $this->load->view('layout/semester/header', $data);
                                        
                    $this->load->view('user_semester/user/date_wise_attendance', $data);
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



//////////////////////////Period wise Attendance



                public function period_wise_attendance()
                {                   
                $sem                        = $this->session->userdata('sem_student');  
                $sem_group_id               = $sem['sem_group_id'];
                $student_id                 = (int)$sem['user_id']; 
                $data['firstname']          = $sem['firstname'];
                $fromdate = '';
                $todate = '';
                $this->form_validation->set_rules('fromdate', 'From Date', 'trim|required|xss_clean');
                $this->form_validation->set_rules('todate', 'To Date', 'trim|required|xss_clean');

                if ($this->form_validation->run() == false) {

                } 
                else
                {

                $fromdate                        = $this->input->post('fromdate');
                $todate                          = $this->input->post('todate');



                $data['get_datewise_attendence'] = $this->semesterauth_model->get_period_datewise($student_id, $sem_group_id, $fromdate, $todate);


                $attendance_raw = $data['get_datewise_attendence'];
                $all_periods    = $this->semesterauth_model->get_all_periods();

                /* ---------- Period headers ---------- */
                $periods = [];
                foreach ($all_periods as $p) {
                $periods[$p['periodic_table_id']] = $p;
                }

                /* ---------- Attendance map ---------- */
                $attendance_map = [];
                foreach ($attendance_raw as $row) {
                $attendance_map[$row['attend_date']][$row['periodic_table_id']] =
                $row['attendence_type_id'];
                }

                /* ---------- Generate ALL dates ---------- */
                $attendance_matrix = [];
                $start = new DateTime($fromdate);
                $end   = new DateTime($todate);
                $end->modify('+1 day');

                while ($start < $end) {
                $date = $start->format('Y-m-d');

                foreach ($periods as $pid => $p) {
                $attendance_matrix[$date][$pid] =
                $attendance_map[$date][$pid] ?? null;
                }

                $start->modify('+1 day');
                }

                $data['attendance_matrix'] = $attendance_matrix;
                $data['periods'] = $periods;





                }
                $data['fromdate']                = $fromdate;
                $data['todate']                  = $todate;
                $this->load->view('layout/semester/header', $data);
                $this->load->view('user_semester/user/period_wise_attendance', $data);
                $this->load->view('layout/semester/datatables', $data);
                $this->load->view('layout/semester/footer', $data); 
                }

                }

