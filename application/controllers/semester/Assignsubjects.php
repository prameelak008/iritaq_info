                    <?php

                    if (!defined('BASEPATH')) {
                    exit('No direct script access allowed');
                    }


                    class Assignsubjects extends Admin_Controller
                    {
                    public function __construct()
                    {
                    parent::__construct();
                    $this->load->helper('form');

                    $this->load->helper('dropdown_helper');

                    $this->config->load('app-config');
                    $this->load->library("datatables");
                    $this->current_session = $this->setting_model->getCurrentSession();
                    } 

                    

                    public function index()
                    { 
                        
                    if (!$this->rbac->hasPrivilege('Semester', 'can_view')) {
                    access_denied();
                    }

                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'Assignsubjects/index');

                    $data['title']                      = 'Assign Subjects';
                    $data['title_list']                 = 'Semester';  

                    // $data['Programmetype_list']    =   $this->Programmetype_model->get();
                    $data['faculty_type_list']          =   $this->Faculty_model->getfaculty_type();
                    $data['get_assigned_subjects']      =   $this->Assignsubjects_model->get();              


                    // $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('program', $this->lang->line('programee'), 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('semester_type', $this->lang->line('semester_type'), 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('batch_group', 'Batch Group', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('subject_groups[]', $this->lang->line('subjects'), 'required'); 

                    if ($this->form_validation->run() == false)
                    {                    

                    }
                    else
                    { 
                    // $batch_group        = $this->input->post('batchtype_id');
                    // $programme          = $this->input->post('program'); 
                    $programme             = $this->input->post('prog_id');
                    $sem_group_id          = $this->input->post('sem_type');
                    $subject_group_ids     = $this->input->post('subject_groups');                
                    $semester_term         = $this->input->post('semester_term'); 
                    

                    // $this->db->where('sem_group_batchgroup', $batch_group);
                    // $this->db->where('sem_group_program', $programme);
                    // // $this->db->where('sem_group_semester', $semester);
                    // $this->db->where('sem_group_semester_term', $semester_term);
                    // $query = $this->db->get('semester_group');                        

                    // if ($query->num_rows() == 0) 
                    // {
                    // $data_to_insert = array(
                    // 'sem_group_batchgroup'   => $batch_group,
                    // 'sem_group_program'      => $programme,
                    // // 'sem_group_semester'     => $semester,
                    // 'sem_group_semester_term'=> $semester_term,                
                    // 'sem_group_createddate'  => date('Y-m-d H:i:s')
                    // );
                    // $this->db->insert('semester_group', $data_to_insert);
                    // $sem_group_id = $this->db->insert_id();               
                    // } 
                    // else 
                    // {
                    // $row          = $query->row();
                    // $sem_group_id = $row->sem_group_id;
                    // }

                    // ---------- 2. IF NO SUBJECT SELECTED → DELETE ALL ----------
                    
                    if (empty($subject_group_ids))
                    {
                    $this->db->where('sem_assign_group_id', $sem_group_id);
                    $this->db->delete('semester_assign_subjects');
                    $this->db->trans_complete();
                    return; // stop further execution
                    }

                    // ---------- 3. FETCH EXISTING SUBJECTS ----------

                    $this->db->select('sem_assign_subjects_id');
                    $this->db->where('sem_assign_group_id', $sem_group_id);
                    $existing           = $this->db->get('semester_assign_subjects')->result_array();

                    $existing_subjects  = array_column($existing, 'sem_assign_subjects_id');

                    // ---------- 4. INSERT ONLY NEW SUBJECTS ----------
                    $insert_data        = [];

                    foreach ($subject_group_ids as $sid) {
                    if (!in_array($sid, $existing_subjects)) {
                    $insert_data[] = array(
                    'sem_assign_group_id'     => $sem_group_id,
                    'sem_assign_subjects_id'  => $sid,
                    'sem_assign_status'       => 1,
                    'sem_assign_created_date' => date('Y-m-d H:i:s')
                    );
                    }
                    }

                    if (!empty($insert_data)) {
                    $this->db->insert_batch('semester_assign_subjects', $insert_data);
                    }


                    // ---------- 5. DELETE UNCHECKED SUBJECTS ----------
                    $this->db->where('sem_assign_group_id', $sem_group_id);
                    $this->db->where_not_in('sem_assign_subjects_id', $subject_group_ids);
                    $this->db->delete('semester_assign_subjects'); 
                    }  

                    $data['programs']               = $this->Semester_enrollment_model->get_program_list();
                    $data['batch_types']            = $this->Semester_enrollment_model->get_batch_types();
                    $data['semester_term']          = $this->Semester_enrollment_model->get_semester_term();
                    $data['subject_groups']         = $this->Assignsubjects_model->get_subjectgroups();
                    $data['get_assigned_subjects']  = $this->Assignsubjects_model->get();
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/assignsubjects/add_data', $data);
                    $this->load->view('layout/footer', $data);
                    }



                    public function getAssignedSubjectGroups()
                    {
                    // $batch      = $this->input->post('batch_type');
                    // $program    = $this->input->post('programe');
                    // $semester   = $this->input->post('semester_type');

                    // $this->db->where('as_batch', $batch);
                    // $this->db->where('as_programs', $program);
                    // $this->db->where('as_semester', $semester);
                    // $query = $this->db->get('assignsubjects');

                    // if ($query->num_rows() > 0) {
                    // $row = $query->row();
                    // $subjectGroups = explode(',', $row->as_subjectgroup); // convert to array
                    // echo json_encode(['status' => 'exists', 'subject_groups' => $subjectGroups]);
                    // } else {
                    // echo json_encode(['status' => 'not_found']);
                    // }


                    $batch    = $this->input->post('batch_type');
                    $program  = $this->input->post('programe');
                    $semester = $this->input->post('semester_type');           
                    $semester_term = $this->input->post('semester_term');

                    // Step 1: Check semester_group
                    $this->db->where('sem_group_batchgroup', $batch);
                    $this->db->where('sem_group_program', $program);
                    $this->db->where('sem_group_semester', $semester);
                    $this->db->where('sem_group_semester_term', $semester_term);
                    $query = $this->db->get('semester_group');

                    if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $sem_group_id = $row->sem_group_id;

                    // Step 2: Get assigned subject groups
                    $this->db->where('sem_assign_group_id', $sem_group_id);
                    $subQuery = $this->db->get('semester_assign_subjects');
                    $subjectGroups = [];
                    if ($subQuery->num_rows() > 0) {
                    foreach ($subQuery->result() as $sg) {
                    $subjectGroups[] = $sg->sem_assign_subjects_id;
                    }
                    }
                    echo json_encode(['status' => 'exists', 'subject_groups' => $subjectGroups]);
                    } else {
                    echo json_encode(['status' => 'not_found']);
                    }
                    }




                    public function checkAssignedSubjects()
                    {
                    // Get POST values
                    $program       = $this->input->post('program');
                    $batch_group   = $this->input->post('batchtype_id');
                    // $semester_term = $this->input->post('semester_term');

                    // Default response
                    $response = [
                    'status' => 'not_exists',
                    'subject_groups' => []
                    ];

                    // Validate required inputs
                    // if (empty($program) || empty($batch_group) || empty($semester_term)) {
                    // echo json_encode($response);
                    // return;
                    // }

                    
                    if (empty($program) || empty($batch_group)) {
                    echo json_encode($response);
                    return;
                    }

                    // Get semester group
                    // $this->db->where('sem_group_program', $program);
                    // $this->db->where('sem_group_batchgroup', $batch_group);
                    // $this->db->where('sem_group_semester_term', $semester_term);
                    // $group = $this->db->get('semester_group')->row();

                    // if ($group) {

                    // Get assigned subjects
                    $this->db->select('sem_assign_subjects_id');
                    $this->db->where('sem_assign_group_id', $batch_group);
                    $assigned = $this->db->get('semester_assign_subjects')->result_array();

                    if (!empty($assigned)) {
                    $response['status'] = 'exists';
                    $response['subject_groups'] = array_column(
                    $assigned,
                    'sem_assign_subjects_id'
                    );
                    }
                    // }
                    echo json_encode($response);
                    }




                    public function edit($id ='0')
                    { 
                    if (!$this->rbac->hasPrivilege('Semester', 'can_view')) {
                    access_denied();
                    }
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'Assignsubjects/index'); 

                    $data['Programmetype_list']= $this->Programmetype_model->get();
                    $data['semester_list']     = $this->Semester_model->get();
                    $data['semestertype_list'] = $this->Semestertype_model->getdata();
                    $data['batchlist']         = $this->Batch_model->batchlist();
                    $data['subject_groups']    = $this->Assignsubjects_model->get_subjectgroups();
                    $data['semester_term']     = $this->Set_duration_model->get_semester_term();  

                    $this->session->set_userdata('top_menu', 'Semester');
                    $this->session->set_userdata('sub_menu', 'Assignsubjects/index');

                    $data['title']        = 'Assign Subjects';
                    $data['title_list']   = 'Semester';
                    $data['id']           =  $id;
                    $this->form_validation->set_rules('program_type', $this->lang->line('program_type'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programe', $this->lang->line('programee'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('semester_type', $this->lang->line('semester_type'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('semester_term', $this->lang->line('semester_term'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('batch_group', 'Batch Group', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('subject_groups[]', $this->lang->line('subjects'), 'required');                 
                    $data['faculty_type_list']        = $this->Faculty_model->getfaculty_type();
                    $data['get_assigned_subjects']    = $this->Assignsubjects_model->get();
                    $data['edit_assigned_subjects']   = $this->Assignsubjects_model->get($id); 
                    $data['batch_group']              = $this->Batchtype_model->get_batchgroup(); 
                    // $data['checklist']                = $this->Assignsubjects_model->get_sem_assig($id); 

                    $sem_group_id                      = $data['edit_assigned_subjects']['sem_assign_group_id'];
                    $data['checked_ids']               = $this->Assignsubjects_model->get_assigned_subject_ids($sem_group_id); 

                    if ($this->form_validation->run() == false) {

                    }
                    else
                    {


                    $batch_group        = $this->input->post('batch_group');
                    $programme          = $this->input->post('programe');
                    $semester           = $this->input->post('semester_type');
                    $subject_group_ids  = $this->input->post('subject_groups');

                    // Step 1: Check if semester group exists
                    $this->db->where('sem_group_batchgroup', $batch_group);
                    $this->db->where('sem_group_program', $programme);
                    $this->db->where('sem_group_semester', $semester);
                    $query = $this->db->get('semester_group');

                    if ($query->num_rows() > 0) {
                    // Semester group exists
                    $row = $query->row();
                    $sem_group_id = $row->sem_group_id;

                    // Step 2: Check if subject assignments already exist
                    $this->db->where('sem_assign_group_id', $sem_group_id);
                    $assign_query = $this->db->get('semester_assign_subjects');

                    if ($assign_query->num_rows() > 0) {
                    // Assignments already exist → Return message
                    return array('status' => false, 'message' => 'These assignments already exist for this group.');
                    }
                    } else {
                    // Semester group does not exist → Insert it
                    $data_to_insert = array(
                    'sem_group_batchgroup'   => $batch_group,
                    'sem_group_program'      => $programme,
                    'sem_group_semester'     => $semester,
                    'sem_group_createddate'  => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('semester_group', $data_to_insert);
                    $sem_group_id = $this->db->insert_id();
                    }

                    // Step 3: Insert new subject assignments
                    if (is_array($subject_group_ids)) {
                    foreach ($subject_group_ids as $sg_id) {
                    $data = array(
                    'sem_assign_group_id'    => $sem_group_id,
                    'sem_assign_subjects_id' => $sg_id,
                    'sem_assign_status'      => 1,
                    'sem_assign_created_date'=> date('Y-m-d H:i:s')
                    );
                    $this->db->insert('semester_assign_subjects', $data);
                    }
                    }
                    return array('status' => true, 'message' => 'Assignments successfully saved.');
                    }

                    // Load form initially or on validation failure
                    $data['semester_list']      = $this->Semester_model->get();
                    $data['semestertype_list']  = $this->Semestertype_model->getdata();
                    $data['batchlist']          = $this->Batch_model->batchlist();
                    $data['subject_groups']     = $this->Assignsubjects_model->get_subjectgroups();
                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/assignsubjects/edit_data', $data);
                    $this->load->view('layout/footer', $data);
                    }


                    // public function delete($id)
                    // {
                    // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    // access_denied();
                    // }
                    // $data['title']       = 'semester Details';
                    // $this->Semester_model->remove($id);
                    // redirect($_SERVER['HTTP_REFERER']);
                    // }




                    public function update_status()
                    {
                    $id              = $this->input->post('id');
                    $status          = $this->input->post('status');
                    $data            = array(
                    'sem_assign_status'      => $status);
                    $this->db->where('sem_assign_group_id', $id);

                    if ($this->db->update('semester_assign_subjects', $data)) 
                    {
                    echo json_encode(array('status' => 'success'));
                    } else {
                    echo json_encode(array('status' => 'error'));
                    }
                    } 




                    public function check_semester_name_exists($semester_name)
                    {
                    if ($this->Semester_model->semester_name_exists($semester_name))
                    {
                    $this->form_validation->set_message('check_semester_name_exists', 'The {field} already exists.');
                    return FALSE;
                    } else {
                    return TRUE;
                    }
                    }  


                    public function getpgm_by_pgmtype() 
                    {
                    $prog_type_id = $this->input->post('prog_type_id');
                    $this->db->where('p_type', $prog_type_id);
                    $this->db->where('p_status', 1);
                    $query        = $this->db->get('programee');

                    $data         = $query->result_array();
                    echo json_encode($data);
                    }
                    

                    public function delete($id)
                    {
                    // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                    // access_denied();
                    // }  
                    $data['title']       = 'Semester Details';
                    $this->Assignsubjects_model->remove($id);

                    redirect('semester/assignsubjects');

                    }


                    // public function bulkDelete()
                    // {
                    // $ids = $this->input->post('ids');
                    // if (!empty($ids)) {
                    // foreach ($ids as $id)
                    //      {
                    // $this->Assignsubjects_model->remove($id);
                    // }
                    // echo "success";
                    // } 
                    // else
                    // {
                    // echo "no_ids";
                    // }
                    // }      




                    public function get_batch_by_program()
                    {
                    $program_id = $this->input->post('program_id');
                    $batch_types = $this->Semester_enrollment_model->get_batch_types_by_program($program_id);
                    // echo batchtype_list($batch_types, set_value('batchtype_id'));
                    echo json_encode($batch_types);
                    } 



                    public function get_batch_semester_by_program()
                    {
                    $program_id = $this->input->post('program_id');
                    $batch_types = $this->Semester_enrollment_model->get_batch_semester_by_program($program_id);                   
                    echo json_encode($batch_types);
                    }


                    public function get_batchtype()
{
    $program_id = $this->input->post('program_id');

    if (!$program_id) {
        echo json_encode([]);
        return;
    }

    echo json_encode(
        $this->Semester_enrollment_model->get_batch_type($program_id)
    );
}




                    public function get_semester_by_batch()
                    {
                    $b_bid = $this->input->post('b_bid');
                    $this->db->select('bs.bchsem_id, stm.stm_name');
                    $this->db->from('batch_semester bs');
                    $this->db->join('semester_term stm', 'stm.stm_id = bs.semterm_id');

                    $this->db->where('bs.bchtyp_id', $b_bid);
                    $this->db->where('bs.bchsem_status', 1);
                    // $this->db->order_by('stm.stm_id', 'ASC');

                    echo json_encode($this->db->get()->result_array());
                    } 




                    public function get_semester_batch_by_program()
                    {
                    $program_id     = $this->input->post('program_id');
                    if (!$program_id) {
                    echo json_encode([]);
                    return;
                    }
                    echo json_encode(
                    $this->Semester_enrollment_model->get_semester_batch_by_program($program_id)
                    ); 
                    }

                    }
