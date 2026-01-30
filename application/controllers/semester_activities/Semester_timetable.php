            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Semester_timetable extends Admin_Controller
            {
            public function __construct()
            {
            parent::__construct();
            $this->load->helper('form');
            $this->config->load('app-config');
            $this->load->library("datatables");
<<<<<<< HEAD
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            

            function set_timetable()
            {
            $this->session->set_userdata('top_menu', 'semester_activities');

            $data['title'] = 'Set Semester Timetable';
            $data['teaching_staff'] = $this->Semesteractivities_model->get_teachingstaff();
            $data['programs'] = $this->Semester_enrollment_model->get_program_list();
            $data['semesters_batches'] = $this->Semester_enrollment_model->get_all_semesters_batches();
            $data['subject_groups'] = $this->Assignsubjects_model->get_subjectgroups();

            $getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;

            $subjectpapers = $this->Subjectpaper_model->getsubjectpapers();
            $data['subjectpapers'] = $subjectpapers;
            $period = $this->staff_model->getperiod();
            $data['period'] = $period;

            // Initialize empty data
            $data['show_timetable'] = false;
            $data['existing_timetable'] = [];

            $this->form_validation->set_rules('prog_id', $this->lang->line('programee'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('sem_type', $this->lang->line('batch'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('subject_group', $this->lang->line('subject_group'), 'required|trim|xss_clean');

            if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            } else {
            $prog_id = $this->input->post('prog_id');
            $sem_group_id = $this->input->post('sem_type');
            $subject_group = $this->input->post('subject_group');

            $data['prog_id'] = $prog_id;
            $data['sem_group_id'] = $sem_group_id;
            $data['subject_group'] = $subject_group;
            $data['show_timetable'] = true;

            // Get subject papers for this combination
            $data['subjectpapers'] = $this->Semesteractivities_model->get_subject_paper($prog_id, $sem_group_id, $subject_group);

            // Get existing timetable data
            $data['existing_timetable'] = $this->Semesteractivities_model->get_timetable($sem_group_id, $subject_group);

            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            }
            }



            public function save_timetable()
            {
            $subject_group                  = $this->input->post('subject_group');
            $sem_group_id                   = $this->input->post('sem_type');

            if (!$sem_group_id || !$subject_group) {
            $this->session->set_flashdata('error', 'Batch and Subject Group required');
            redirect($_SERVER['HTTP_REFERER']);
            }

            // Delete existing timetable for this batch and subject group
            $this->db->where('tb_batch', $sem_group_id);
            $this->db->where('tb_subjectgroup', $subject_group);
            $this->db->delete('semester_timetable');

            if (!empty($_POST['period']) && is_array($_POST['period'])) {
            foreach ($_POST['period'] as $day => $periods) {
            foreach ($periods as $i => $period_id) {
            $subject_id         = $_POST['subject'][$day][$i] ?? '';
            $subjectpaper       = $_POST['subjectpaper'][$day][$i] ?? '';
            $staff              = $_POST['staff'][$day][$i] ?? '';
            $room               = trim($_POST['room'][$day][$i] ?? '');
            $time_from          = $_POST['time_from'][$day][$i] ?? '';
            $time_to            = $_POST['time_to'][$day][$i] ?? '';

            // Skip empty rows
            if (empty($subject_id) && empty($subjectpaper) && empty($staff) && empty($room)) {
            continue;
            }

            $data = [
            'tb_day'            => $day,
            'tb_batch'          => $sem_group_id,
            'tb_subjectgroup'   => $subject_group,
            'tb_subname'        => $subject_id,
            'tb_subjectpaper'   => $subjectpaper,
            'tb_staff_id'       => $staff,
            'tb_period_id'      => $period_id,
            'tb_time_from'      => $time_from,
            'tb_time_to'        => $time_to,
            'tb_room_no'        => $room,
            'tb_created_date'   => date('Y-m-d H:i:s'),
            'tb_status'         => 1
            ];

            $this->db->insert('semester_timetable', $data);
            }
            }
            }

            $this->session->set_flashdata('success', 'Timetable saved successfully');
            redirect($_SERVER['HTTP_REFERER']);
=======
            $this->current_session = $this->setting_model->getCurrentSession(); 
            } 


              

            function set_timetable001()
            {

            // if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
            // {
            // access_denied();
            // }
            // $this->session->set_userdata('top_menu', 'semester');
            // $this->session->set_userdata('sub_menu', 'semester_timetable/index');

            $this->session->set_userdata('top_menu', 'semester_activities');

            $session                    =   $this->setting_model->getCurrentSession();
            $data['title']              =  'Set  Semester Timetable';                            

            $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();
            $data['Programmetype_list'] =   $this->Programmetype_model->get();
            $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
            $data['semestertype_list']  =   $this->Semestertype_model->getdata();  
            $data['subject_groups']     =   $this->Assignsubjects_model->get_subjectgroups(); 

            $getDaysnameList            =   $this->customlib->getDaysname();
            $data['getDaysnameList']    =   $getDaysnameList;  
            // $data['programe']           =   $this->input->post('programe');
            // $data['semester']           =   $this->input->post('semester_semtype');
            // $data['bat_group']          =   $this->input->post('batch_group');   
            // $data['sub_groups']         =   $this->input->post('subject_groups'); 
            // $data['sem_term']           =   $this->input->post('semester_term');             

            $data['semester_term']      =   $this->Set_duration_model->get_semester_term(); 


            $subjectpapers              =   $this->Subjectpaper_model->getsubjectpapers();                    
            $data['subjectpapers']      =   $subjectpapers;



            $period                     =   $this->staff_model->getperiod();
            $data['period']             =   $period;

            // validation rules for search form
            $this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');
            // $this->form_validation->set_rules('program_type', $this->lang->line('programee_type'), 'required|trim|xss_clean');
            // $this->form_validation->set_rules('programe', $this->lang->line('programee'), 'required|trim|xss_clean');
            // $this->form_validation->set_rules('semester_semtype', $this->lang->line('semester'), 'required|trim|xss_clean');
            // $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'required|trim|xss_clean');
            // $this->form_validation->set_rules('batch_group', $this->lang->line('batch'), 'required|trim|xss_clean');
            // $this->form_validation->set_rules('subject_groups', $this->lang->line('subject').' '.$this->lang->line('group'), 'required|trim|xss_clean');

            // $programe                   =  $data['programe'] ;
            // $semester                   =  $data['semester'] ;
            // $bat_group                  =  $data['bat_group'] ;
            // $sub_groups                 =  $data['sub_groups'] ;
            // $sem_term                   =  $data['sem_term'] ;


            if ($this->form_validation->run() == false)
            {
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            } 
            else 
            {
            $program_id                     = $this->input->post('program'); 
            $semester_value                 = $this->input->post('semester'); // e.g. "1|12|3"
            $subject_group                  = $this->input->post('subject_group'); 
            $subjects                       = $this->input->post('subjects');  

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

            $getDaysnameList         = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $subject                 = $this->subjectgroup_model->getGroupsubjects($sub_groups);
            $data['subject']         = $subject;
            $data['get_subjectlist'] = $this->Semesteractivities_model->get_timetablelist($programe,$semester,$bat_group,$sub_groups,$sem_term);
            $get_subjectlist         = $data['get_subjectlist'];
            $data['subject']         = $subject;                              
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            }
            } 





            function set_timetable()
            {           

            $this->session->set_userdata('top_menu', 'semester_activities');

            $session                    =   $this->setting_model->getCurrentSession();
            $data['title']              =  'Set  Semester Timetable';                            

            $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();


            $data['program_types']      = $this->Semester_enrollment_model->get_program_types();
            $data['programs']           = $this->Semester_enrollment_model->get_programs();           
            $data['semesters_batches']  = $this->Semester_enrollment_model->get_all_semesters_batches();
            $data['subject_groups']     = $this->Assignsubjects_model->get_subjectgroups(); 


            $getDaysnameList            =   $this->customlib->getDaysname();
            $data['getDaysnameList']    =   $getDaysnameList;  


            $subjectpapers              =   $this->Subjectpaper_model->getsubjectpapers();                    
            $data['subjectpapers']      =   $subjectpapers;
            $period                     =   $this->staff_model->getperiod();
            $data['period']             =   $period;

            // validation rules for search form
           $this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');             
           $this->form_validation->set_rules('program', $this->lang->line('programee'), 'required|trim|xss_clean'); 
           
            if ($this->form_validation->run() == false)
            {
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            } 
            else 
            {
            $program_id                     = $this->input->post('program'); 
            $semester_value                 = $this->input->post('semester'); // e.g. "1|12|3"
            $subject_group                  = $this->input->post('subject_group'); 
            $subjects                       = $this->input->post('subjects'); 

            $data['subject_group']          = $subject_group;
            $data['subjects']               = $subjects;

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

            $getDaysnameList         = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $subject                 = $this->subjectgroup_model->getGroupsubjects($sub_groups);
            $data['subject']         = $subject;
            $data['get_subjectlist'] = $this->Semesteractivities_model->get_timetablelist($programe,$semester,$bat_group,$sub_groups,$sem_term);
            $get_subjectlist         = $data['get_subjectlist'];
            $data['subject']         = $subject;                              
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_timetable/add_data', $data);
            $this->load->view('layout/footer', $data);
            }
            } 











            public function savetimetable()
            {   
            // Debugging first
            $subjectpaper = $this->input->post('subjectpaper'); 
            $staff_id     = $this->input->post('staff_id');     
            $period       = $this->input->post('period');       
            $time_from    = $this->input->post('time_from');    
            $time_to      = $this->input->post('time_to');      
            $room_no      = $this->input->post('room_no');                      
            // $sem_group_id = $this->input->post('sem_group_id');

            $prg          =  $this->input->post('prg'); 
            $sem          =  $this->input->post('sem'); 
            $sem_term     =  $this->input->post('sem_term'); 
            $bat          =  $this->input->post('bat'); 
            // $sub_grp      =  $this->input->post('sub_grp'); 


            $this->db->where('sem_group_program', $prg);
            $this->db->where('sem_group_batchgroup', $bat);               
            $this->db->where('sem_group_semester', $sem);
            $this->db->where('sem_group_semester_term', $sem_term);                
            $query       = $this->db->get('semester_group'); 

            if ($query->num_rows() == 0) 
            {
            $data_to_insert = array(
            'sem_group_batchgroup'   => $bat,
            'sem_group_program'      => $prg,
            'sem_group_semester'     => $sem,
            'sem_group_semester_term'=> $sem_term,                
            'sem_group_createddate'  => date('Y-m-d H:i:s')
            );
            $this->db->insert('semester_group', $data_to_insert);
            $sem_group_id = $this->db->insert_id();
            } 
            else 
            {
            $row          = $query->row();
            $sem_group_id = $row->sem_group_id;
            } 

            foreach ($subjectpaper as $day => $rows) {
            foreach ($rows as $index => $subj) 
            {
            $where = [
            'tb_subjectpaper' => $subjectpaper[$day][$index],
            'tb_staff_id'     => $staff_id[$day][$index],
            'tb_period_id'    => $period[$day][$index],
            'tb_day'          => $day
            ];

            $data = [
            'tb_subjectpaper' => $subjectpaper[$day][$index],
            'tb_staff_id'     => $staff_id[$day][$index],
            'tb_period_id'    => $period[$day][$index],
            'tb_time_from'    => $time_from[$day][$index],
            'tb_time_to'      => $time_to[$day][$index],
            'tb_room_no'      => $room_no[$day][$index],
            'tb_day'          => $day,
            'tb_semester_group'   => $sem_group_id,             
            // 'tb_program'          => $prg,
            // 'tb_semester'         => $sem,
            // 'tb_batch'            => $bat,
            // 'tb_subjectgroup'     => $sub_grp,
            ];

            //where condition 
            $this->db->where($where);
            $query    = $this->db->get('semester_timetable');

            if ($query->num_rows() > 0) 
            {
            $this->db->where($where);
            $this->db->update('semester_timetable', $data);
            }

            else 
            {
            $this->db->insert('semester_timetable', $data);
            }
            }
            } 
            $this->session->set_flashdata('msg', 'Timetable saved successfully!');
            redirect('semester_activities/semester_timetable/set_timetable');
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            }




<<<<<<< HEAD
            public function get_subject_groups_by_sem_group()
            {
            $sem_group_id = $this->input->post('sem_group_id');
            $data = $this->Semesteractivities_model->get_subject_groups_by_sem_group($sem_group_id);
            echo json_encode($data);
=======

            public function get_day_records()
            {
            $day = $this->input->post('day');
            $program = $this->input->post('program');
            $semester = $this->input->post('semester');
            $sem_term = $this->input->post('sem_term');
            $batch = $this->input->post('bat');
            $sub_grp = $this->input->post('sub_grp');

            // Get the semester_group_id
            $this->db->where('sem_group_program', $program);
            $this->db->where('sem_group_batchgroup', $batch);
            $this->db->where('sem_group_semester', $semester);
            $this->db->where('sem_group_semester_term', $sem_term);
            $semQuery = $this->db->get('semester_group');

            if ($semQuery->num_rows() > 0) {
            $sem_group_row = $semQuery->row();
            $sem_group_id = $sem_group_row->sem_group_id;
            } else {
            // No semester group found, return empty array
            echo json_encode([]);
            return;
            }

            // Now query the timetable with subject (if resolvable from paper)
            $this->db->select('semester_timetable.*, subjects.id as subject_id, subjects.name as subject_name');
            $this->db->from('semester_timetable');
            $this->db->join('semestersubjectpaper', 'semestersubjectpaper.sem_paper_id = semester_timetable.tb_subjectpaper', 'left');
            $this->db->join('subjects', 'subjects.id = semestersubjectpaper.sem_paper_subjectid', 'left');
            $this->db->where('semester_timetable.tb_day', $day);  
            $this->db->where('semester_timetable.tb_semester_group', $sem_group_id);            
            $query = $this->db->get();
            echo json_encode($query->result());
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            }



<<<<<<< HEAD
            }
=======
            public function get_papers_by_group()
            {
            $group_id = $this->input->post('group_id');
            // TODO: filter by group once linking column is confirmed
            $papers = $this->Subjectpaper_model->getsubjectpapers();
            echo json_encode($papers);
            }

            public function get_subject_by_paper()
            {
            $paper_id = $this->input->post('paper_id');
            $subject = $this->Subjectpaper_model->get_subject_by_paper($paper_id);
            echo json_encode($subject);
            }

            }
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
