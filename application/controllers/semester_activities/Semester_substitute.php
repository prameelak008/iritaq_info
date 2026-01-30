            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Semester_substitute extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();
            $this->load->helper('form');
            $this->config->load('app-config');
            $this->load->library("datatables");
            $this->current_session = $this->setting_model->getCurrentSession(); 
            }                   


            public function index()
            {
            // if (!$this->rbac->hasPrivilege('faculty', 'can_view')) {
            // access_denied();
            // }           

            // $this->session->set_userdata('top_menu', 'semester');
            // $this->session->set_userdata('sub_menu', 'semester_substitute/index');

             $this->session->set_userdata('top_menu', 'semester_activities');

            $data['title']              =   'Timetable';
            $data['title_list']         =   'Substitute ';
            $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();

<<<<<<< HEAD
            // $data['Programmetype_list'] =   $this->Programmetype_model->get();
            // $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
            // $data['semestertype_list']  =   $this->Semestertype_model->getdata();  
=======
            $data['Programmetype_list'] =   $this->Programmetype_model->get();
            $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
            $data['semestertype_list']  =   $this->Semestertype_model->getdata();  
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            $data['subject_groups']     =   $this->Assignsubjects_model->get_subjectgroups();             
            $data['assign_teacher']     =   $this->Semesteractivities_model->getassignedteacher_subjects(); 
            $subjectpapers              =   $this->Subjectpaper_model->getsubjectpapers();
            $data['subjectpapers']      =   $subjectpapers;  
            $period                     =   $this->staff_model->getperiod();
            $data['semester_term']      =   $this->Set_duration_model->get_semester_term(); 
            $data['period']             =   $period;
            $data['semester_group']     =   $this->input->post('sem_group_id');
            $semester_group             =   $data['semester_group']; 
<<<<<<< HEAD
            $data['get_subjectlist']    = $this->Semesteractivities_model->get_timetablelist();  
            
   
=======
            $data['get_subjectlist']    = $this->Semesteractivities_model->get_timetablelist();                   
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

            $this->form_validation->set_rules('substitute_staff_id', $this->lang->line('substitute_staff_id'), 'trim|required|xss_clean'); 


            if ($this->form_validation->run() == false) 
            {                 
            } 
            else 
            { 
<<<<<<< HEAD

            $sem_group_id                          = $this->input->post('sem_type');           

            $data                                  = array(
            // 'substitute_program'                   => $this->input->post('programe'),
            // 'substitute_semester'                  => $this->input->post('semester_semtype'),
            // 'substitute_batch'                     => $this->input->post('batch_group'),


            'substitute_subjectgroup'              => $this->input->post('subject_groups'), 
            'substitute_substitute_subject'        => $this->input->post('subjects'),
            'substitute_substitute_paper'          => $this->input->post('paper'),
            'substitute_substitutestaff	'          => $this->input->post('substitute_staff_id'),    
            'substitute_remarks'                   => $this->input->post('remarks'), 
            'substitute_period'                    => $this->input->post('period'),
=======
            $program             = $this->input->post('programe');
            $batch_group         = $this->input->post('batch_group');
            $semester_semtype    = $this->input->post('semester_semtype');
            $semester_term       = $this->input->post('semester_term');

            $this->db->where('sem_group_program', $program);
            $this->db->where('sem_group_batchgroup', $batch_group);               
            $this->db->where('sem_group_semester', $semester_semtype);
            $this->db->where('sem_group_semester_term', $semester_term);                
            $query = $this->db->get('semester_group');                        

            if ($query->num_rows() == 0) 
            {
            $data_to_insert = array(
            'sem_group_batchgroup'   => $batch_group,
            'sem_group_program'      => $program,
            'sem_group_semester'     => $semester_semtype,
            'sem_group_semester_term'=> $semester_term,                
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

            $data                                  = array(
            'substitute_program'                   => $this->input->post('programe'),
            'substitute_semester'                  => $this->input->post('semester_semtype'),
            'substitute_batch'                     => $this->input->post('batch_group'),
            'substitute_subjectgroup'              => $this->input->post('subject_groups'), 
            'substitute_substitute_subject'        => $this->input->post('subject'),
            'substitute_substitute_paper'          => $this->input->post('substitute_subjectpaper'),
            'substitute_substitutestaff	'          => $this->input->post('substitute_staff_id'),    
            'substitute_remarks'                   => $this->input->post('remarks'), 
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            'substitute_semester_group'            => $sem_group_id,
            'substitute_created_date'              => date('Y-m-d H:i:s') );
            $this->Semesteractivities_model->add_substitute($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('semester_activities/semester_substitute/index');
            } 
<<<<<<< HEAD
            $data['programs']           =    $this->Semester_enrollment_model->get_program_list();
=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
            $this->load->view('layout/header', $data);
            $this->load->view('semester_activities/semester_substitute/add_data', $data);
            $this->load->view('layout/footer', $data);
            } 




            public function delete($id)
            {
            if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
            access_denied();
            }
            $data['title']       = 'Semester Details';
            $this->Semesteractivities_model->remove_substitute($id);
            redirect($_SERVER['HTTP_REFERER']);
            }




            public function bulkDelete()
            {
            $ids = $this->input->post('ids');
            if (!empty($ids)) {
            foreach ($ids as $id) 
            {           
            $this->Semesteractivities_model->remove_substitute($id);
            }
            echo "success";
            } else {
            echo "no_ids";
            }
            } 



<<<<<<< HEAD


=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
        public function edit($id)
        {
        // if (!$this->rbac->hasPrivilege('faculty', 'can_edit')) {
        // access_denied();
        // }
<<<<<<< HEAD
        $data['title']              =   'Edit Substitute';
        $data['id']                 =   $id;      

      
        $data['title_list']         =   'Substitute List';
        // $data['get_subjectlist']    =   $this->Semesteractivities_model->get_timetablelist();  
=======
        $data['title']        = 'Edit Substitute';
        $data['id']           =  $id;
        

      
        $data['title_list']   = 'Substitute List';
        $data['get_subjectlist']    = $this->Semesteractivities_model->get_timetablelist();  
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956

        $data['Programmetype_list'] =   $this->Programmetype_model->get();
        $data['batch_group']        =   $this->Batchtype_model->get_batchgroup();
        $data['semestertype_list']  =   $this->Semestertype_model->getdata();  
<<<<<<< HEAD
        $data['subject_groups']     =   $this->Assignsubjects_model->get_subjectgroups();  
        
        
        $data['assign_teacher']     =   $this->Semesteractivities_model->getassignedteacher_subjects(); 
        $subjectpapers              =   $this->Subjectpaper_model->getsubjectpapers();
        $data['subjectpapers']      =   $subjectpapers;  


=======
        $data['subject_groups']     =   $this->Assignsubjects_model->get_subjectgroups();             
        $data['assign_teacher']     =   $this->Semesteractivities_model->getassignedteacher_subjects(); 
        $subjectpapers              =   $this->Subjectpaper_model->getsubjectpapers();
        $data['subjectpapers']      =   $subjectpapers;  
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
        $period                     =   $this->staff_model->getperiod();
        $data['semester_term']      =   $this->Set_duration_model->get_semester_term(); 
        $data['period']             =   $period;
        $data['semester_group']     =   $this->input->post('sem_group_id');
        $semester_group             =   $data['semester_group']; 
<<<<<<< HEAD
        $data['get_subjectlist']    = $this->Semesteractivities_model->get_timetablelist();  
        $data['programs']           =    $this->Semester_enrollment_model->get_program_list(); 
        
        
        $data['get_edittimetablelist'] = $this->Semesteractivities_model->get_edittimetablelist($id);

        $this->form_validation->set_rules('substitute_staff_id', $this->lang->line('substitute_staff_id'), 'trim|required|xss_clean');
        $sem_group_id                 = $this->input->post('sem_type');

         $data['teaching_staff']     =   $this->Semesteractivities_model->get_teachingstaff();
=======
        $data['get_subjectlist']    = $this->Semesteractivities_model->get_timetablelist();                   

        $this->form_validation->set_rules('substitute_staff_id', $this->lang->line('substitute_staff_id'), 'trim|required|xss_clean');

>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
              
        if ($this->form_validation->run() == false) {
        $this->load->view('layout/header', $data);
        $this->load->view('semester_activities/semester_substitute/edit_data', $data);
        $this->load->view('layout/footer', $data);
        }
        else
        {
        $data                                  = array(
        'substitute_id'                        => $id,
<<<<<<< HEAD

        // 'substitute_program'                   => $this->input->post('programe'),
        // 'substitute_semester'                  => $this->input->post('semester_semtype'),
        // 'substitute_batch'                     => $this->input->post('batch_group'),
        'substitute_subjectgroup'              => $this->input->post('subject_groups'), 
        'substitute_substitute_subject'        => $this->input->post('subjects'),
        'substitute_substitute_paper'          => $this->input->post('paper'),
        'substitute_substitutestaff	'          => $this->input->post('substitute_staff_id'),    
        'substitute_remarks'                   => $this->input->post('remarks'), 
        'substitute_period'                    => $this->input->post('period'),

        'substitute_semester_group'            => $sem_group_id,
        'substitute_created_date'              => date('Y-m-d H:i:s') );
        $this->Semesteractivities_model->add_substitute($data);  
=======
        'substitute_program'                   => $this->input->post('programe'),
        'substitute_semester'                  => $this->input->post('semester_semtype'),
        'substitute_batch'                     => $this->input->post('batch_group'),
        'substitute_subjectgroup'              => $this->input->post('subject_groups'), 
        'substitute_substitute_subject'        => $this->input->post('subject'),
        'substitute_substitute_paper'          => $this->input->post('substitute_subjectpaper'),
        'substitute_substitutestaff	'          => $this->input->post('substitute_staff_id'),    
        'substitute_remarks'                   => $this->input->post('remarks'), 
        'substitute_semester_group'            => $sem_group_id,
        'substitute_created_date'              => date('Y-m-d H:i:s') );
        $this->Semesteractivities_model->add_substitute($data);      
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
     
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect($_SERVER['HTTP_REFERER']);
        }
<<<<<<< HEAD
        }         
        

        public function update_status()
        {
        $id         = $this->input->post('id');
        $status     = $this->input->post('status');

        $data            = array(
        'substitute_status' => $status
        );
        $this->db->where('substitute_id', $id);
        if ($this->db->update('semester_substitute', $data)) {
        echo json_encode(array('status' => 'success'));
        } else {
        echo json_encode(array('status' => 'error'));
        }
        }


        }
=======
        }



            

                    
          

            }
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
