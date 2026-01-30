            <?php

            if (!defined('BASEPATH')) 
            {
            exit('No direct script access allowed');
            } 


            class Library extends Admin_Controller
            {


            public function __construct()
            {
            parent::__construct();
            $this->load->model("classteacher_model");
            $this->load->model("Staff_model");
            $this->load->library('Enc_lib');
            $this->sch_setting_detail = $this->setting_model->getSetting();
            $this->load->library('Zend');
            $this->load->library('form_validation');
            $this->load->library('mailsmsconf');
            $this->blood_group        = $this->config->item('bloodgroup');
            }




            public function index()
            {                        
            $this->session->set_userdata('top_menu', 'student_nexus');
            // Page title
            $data['title'] = 'Student Search';

            // School settings
            $data['adm_auto_insert']            = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']                = $this->sch_setting_detail;

            // // Class list
            // $data['classlist']                  = $this->class_model->get();

            // Program types and programs
            $data['program_types']              = $this->Semester_enrollment_model->get_program_types();
            $data['programs']                   = $this->Semester_enrollment_model->get_programs();

            // Semesters, batches, and terms
            $data['semesters_batches']          = $this->Semester_enrollment_model->get_all_semesters_batches();

            // Form validation
            $this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester', 'Semester / Term / Batch', 'trim|required|xss_clean');

            if ($this->form_validation->run() == false) {
            // First load or validation failed: just show the form
            $this->load->view('layout/header');
            $this->load->view('student_nexus/library', $data);
            $this->load->view('layout/footer');
            } 
            else
            {
            // Form submitted: get program and semester selection
            $program_id                     = $this->input->post('program'); 
            $semester_value                 = $this->input->post('semester'); // e.g. "1|12|3"

            // Split semester value into individual IDs: semester type, batch, term
            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            // Pass all selected values back to view for further processing / search
            $data['selected_program']       = $program_id;
            $data['selected_semester_type'] = $semester_type_id;
            $data['selected_batch']         = $batch_id;
            $data['selected_term']          = $semester_term_id;

            $program                        = $data['selected_program'];
            $semester_id                    = $data['selected_semester_type'];
            $batch_id                       = $data['selected_batch'];
            $term_id                        = $data['selected_term'];

            $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group($program,$batch_id,$semester_id,$term_id); 
            $sem_groups                     = $data['sem_groups'];  
                        
            // $data['students']     = $this->Semester_enrollment_model->get_students($program_id, $semester_type_id, $batch_id, $semester_term_id);

            $data['students']               = $this->Room_allocation_model->get_students_for_id($sem_groups['sem_group_id']);

            $this->load->view('layout/header');
            $this->load->view('student_nexus/library', $data);
            $this->load->view('layout/footer');
            }
            } 
            
            

            
            

            public function add() 
            {

            if ($this->input->post('library_card_no') != "") 
            {

            $this->form_validation->set_rules('library_card_no', $this->lang->line('library_card_no'), 'required|trim|xss_clean|callback_check_cardno_exists');
            if ($this->form_validation->run() == false) {
            $data = array(
            'library_card_no' => form_error('library_card_no'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
            } else {
            $library_card_no = $this->input->post('library_card_no');
            $student = $this->input->post('member_id');
            $data               = array(
            'member_type'       => 'student',
            'member_id'         => $student,
            'semester_type'     => 1,
            'library_card_no'   => $library_card_no,
            );

            $inserted_id = $this->librarymanagement_model->add_library($data);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'), 'inserted_id' => $inserted_id, 'library_card_no' => $library_card_no);
            echo json_encode($array);
            }
            } else {
            $library_card_no = $this->input->post('library_card_no');
            $student = $this->input->post('member_id');
            $data               = array(
            'member_type'       => 'student',
            'member_id'         => $student,
            'semester_type'     => 1,
            'library_card_no'   => $library_card_no,
            );

            $inserted_id = $this->librarymanagement_model->add_library($data);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'), 'inserted_id' => $inserted_id, 'library_card_no' => $library_card_no);
            echo json_encode($array);
            }
            }



            public function check_cardno_exists()
            {
            $data['library_card_no'] = $this->security->xss_clean($this->input->post('library_card_no'));

            if ($this->librarymanagement_model->check_data_sem_exists($data)) {
            $this->form_validation->set_message('check_cardno_exists', $this->lang->line('card_no_already_exists'));
            return false;
            } else {
            return true;
            }
            }          
            
            

            // public function surrender() 
            // {   
                       
            // $member_id = $this->input->post('member_id');
            // $this->room_allocation_model->surrender($member_id);

            // $array = array(
            // 'status' => 'success',
            // 'error' => '',
            // 'message' => $this->lang->line('success_message')
            // );
            // echo json_encode($array);
            // }



            public function surrender() 
            {         
            $member_id = $this->input->post('member_id');
            $this->Room_allocation_model->surrender($member_id);
            redirect($_SERVER['HTTP_REFERER']);
            
            }


            public function issue_return()
            {

            $this->session->set_userdata('top_menu', 'student_nexus');
            // Page title
            $data['title'] = 'Student Search';

            // School settings
            $data['adm_auto_insert']            = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']                = $this->sch_setting_detail;

        

           
            
            $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group($program,$batch_id,$semester_id,$term_id); 
            $sem_groups                     = $data['sem_groups']; 
            // $data['students']               = $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);

            $data['students']               = $this->Room_allocation_model->get_bookissue_members();

            $this->load->view('layout/header');
            $this->load->view('student_nexus/issue_return', $data);
            $this->load->view('layout/footer');            
            }          




            public function issue($id) 
            {
               
            $data['title']        = 'Member';
            $data['title_list']   = 'Members';
            $memberList           =  $this->Room_allocation_model->getByMemberID($id);
            $data['memberList']   =  $memberList;

            $issued_books         =  $this->Room_allocation_model->getMemberBooks($id);
            $data['issued_books'] =  $issued_books;
            $bookList             =  $this->book_model->get();           
           
            $data['bookList']     =  $bookList;
            $this->form_validation->set_rules('return_date', $this->lang->line('return_date'), 'trim|required|xss_clean');
            $this->form_validation->set_rules(
            'book_id', $this->lang->line('book'), array(
            'required',
            array('check_exists', array($this->bookissue_model, 'valid_check_exists')),
            )
            );
            if ($this->form_validation->run() == false)
            {
            
            } 
            else
            {
            $member_id = $this->input->post('member_id');

            $data = array(
            'book_id'        => $this->input->post('book_id'),
            'duereturn_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('return_date'))),
            'issue_date'     => date('Y-m-d'),
            'member_id'      => $this->input->post('member_id'),
            );
            $this->Room_allocation_model->add_book_issues($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            // redirect('student_nexus/issue' . $member_id);
             redirect($_SERVER['HTTP_REFERER']);
            }
            $data['sch_setting'] = $this->sch_setting_detail;
            $this->load->view('layout/header');
            $this->load->view('student_nexus/issue', $data);
            $this->load->view('layout/footer');
            }




            public function bookreturn()
            {                
            $this->form_validation->set_rules('id', $this->lang->line('id'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('member_id', $this->lang->line('member_id'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('date', $this->lang->line('date'), 'required|trim|xss_clean');
            if ($this->form_validation->run() == false) {
            $data = array(
            'id' => form_error('id'),
            'member_id' => form_error('member_id'),
            'date' => form_error('date'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
            } 
            else
            {
            $id         = $this->input->post('id');
            $member_id  = $this->input->post('member_id');
            $member_amt = $this->input->post('member_amt');
            
            $date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));
            $data = array(
            'id' => $id,
            'return_date' => $date,
            'amount_paid' => $member_amt,
            'is_returned' => 1,
            );
            $this->Room_allocation_model->update($data);
            
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
            }
            }





            ///////no..............

            public function save_homework()
            {
            $this->load->library('upload');

            $data = [
            "sem_group_id"              => $this->input->post("sem_group_id"),
            "subject_group_subject_id"  => $this->input->post("subject_group_id"),
            "subject_id"                => $this->input->post("subject_id"),
            "homework_date"             => $this->input->post("homework_date"),
            "submit_date"               => $this->input->post("submit_date"),
            "description"               => $this->input->post("description"),
            "create_date"               => date("Y-m-d H:i:s"),
            "created_by"                => $this->customlib->getStaffID(), // or session user id
            ];

            // FILE UPLOAD
            if (!empty($_FILES['document']['name'])) {
            $config['upload_path'] = './uploads/homework/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|docx|doc';
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('document')) {
            $upload_data = $this->upload->data();
            $data['document'] = $upload_data['file_name'];
            }
            }
            // Insert into DB
            $this->db->insert("semester_homework", $data);

            echo json_encode(["status" => "success"]);
            }
            }


