                  <?php
                  
                  if (!defined('BASEPATH')) {
                  exit('No direct script access allowed');
                  }
                  
                  
                  class Setduration extends Admin_Controller
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

                    if (!$this->rbac->hasPrivilege('semester', 'can_view')) {
                    access_denied();
                    }
                    $this->session->set_userdata('top_menu', 'semester');
                    $this->session->set_userdata('sub_menu', 'setduration/index');

                    $data['title']      = 'Semester';
                    $data['title_list'] = 'Set Duration';

                    $this->form_validation->set_rules('program_type', $this->lang->line('programmetype'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('programe', $this->lang->line('programee'), 'trim|required|xss_clean');

                    $this->form_validation->set_rules('No_of_Months', $this->lang->line('no_of_months'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('No_of_Days', $this->lang->line('no_of_days'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('date_from', $this->lang->line('date'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('date_to', $this->lang->line('date'), 'trim|required|xss_clean');
                    $this->form_validation->set_rules('No_of_Semester', $this->lang->line('no_of_semester'), 'trim|required|xss_clean');                 


                    $id         = $this->input->post('program_id'); 
                                      

                    // $this->Set_duration_model->add($data);                     
                    if ($this->form_validation->run() == false)
                    {
                    } 
                    else 
                    {

                    if($id=="")
                    {                      
                    $data                   =  array(
                    // 'programee_id'          => $this->input->post('programe'),
                    'programee_id '         => $this->input->post('programe'),
                    'date_from'             => $this->input->post('date_from'),
                    'date_to'               => $this->input->post('date_to'),
                    'no_of_semester'        => $this->input->post('No_of_Semester'),
                    'no_of_months'          => $this->input->post('No_of_Months'),
                    'no_of_days'            => $this->input->post('No_of_Days'),
                    'createddate'           => date('Y-m-d H:i:s'),
                    'session'               => $this->current_session);
                    $this->Set_duration_model->add($data);
                    }
                    else
                    {

                    $data                   =  array(
                    'id'                    => $id,      
                    'programee_id'          => $this->input->post('programe'),
                    'date_from'             => $this->input->post('date_from'),
                    'date_to'               => $this->input->post('date_to'),
                    'no_of_semester'        => $this->input->post('No_of_Semester'),
                    'no_of_months'          => $this->input->post('No_of_Months'),
                    'no_of_days'            => $this->input->post('No_of_Days'),
                    'updateddate'           => date('Y-m-d H:i:s'),
                    'session'               => $this->current_session);
                    $this->Set_duration_model->add($data);
                    } 
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                    // redirect('semester/Setduration/index');
                    redirect($_SERVER['HTTP_REFERER']);
                    }

                    $data['Programmetype_list'] = $this->Programmetype_model->get();
                    $data['durationlist']       = $this->Set_duration_model->getprogramedetails(); 
                    $data['semestertype_list'] = $this->Semestertype_model->getdata();
                    // $data['batchlist'] = $this->Batch_model->batchlist();
                    $data['get_batch_duration'] = $this->Batch_duration_model->get();                     
                    $data['facultylist'] = $this->Faculty_model->get();
                    $data['get_seatcapacity'] = $this->Seatcapacity_model->get();
                    $data['semester_term']       = $this->Set_duration_model->get_semester_term(); 

                    $data['semester_list']  =   $this->Semester_model->get();
                    $semester_list          =   $data['semester_list'];
                    $data['batchlist']      =   $this->Batch_model->batchlist(); 
                    $data['get_semester_duration'] =   $this->set_semesterDuration_model->get(); 
                    $data['batch_group']    =   $this->Batchtype_model->get_batchgroup();

                    $data['programs']               = $this->Semester_enrollment_model->get_program_list();
                    $data['batch_types']            = $this->Semester_enrollment_model->get_batch_types();

                    


                    $program_rows = $this->db
                    ->select('pr.id as program_id, pr.p_name, pt.prog_type_id, pt.prog_type_name')
                    ->from('programee pr')
                    ->join('programme_type pt', 'pt.prog_type_id = pr.p_type', 'left')
                    ->where('pr.p_status', 1)
                    ->order_by('pt.prog_type_name ASC, pr.p_name ASC')
                    ->get()
                    ->result_array();

                    $grouped_programs = array();

                    foreach ($data['Programmetype_list'] as $type_row) {
                    $grouped_programs[$type_row['prog_type_id']] = array(
                    'prog_type_id'   => $type_row['prog_type_id'],
                    'prog_type_name' => $type_row['prog_type_name'],
                    'programs'       => array()
                    );
                    }

                    foreach ($program_rows as $row) {
                    $type_id = $row['prog_type_id'];

                    if (!isset($grouped_programs[$type_id])) {
                    $grouped_programs[$type_id] = array(
                    'prog_type_id'   => $type_id,
                    'prog_type_name' => $row['prog_type_name'],
                    'programs'       => array()
                    );
                    }

                    $grouped_programs[$type_id]['programs'][] = array(
                    'id'     => $row['program_id'],
                    'p_name' => $row['p_name']
                    );
                    }

                    $data['program_groups'] = array_values($grouped_programs);


                    $this->load->view('layout/header', $data);
                    $this->load->view('semester/tab', $data);                
                    $this->load->view('layout/footer', $data);
                    }
                  

                    
      
                  public function delete($id)
                  {
                  // if (!$this->rbac->hasPrivilege('semester', 'can_delete')) {
                  // access_denied();
                  // }
                  // $data['title']       = 'set Duration Details';
                  // $this->Set_duration_model->remove($id);
                  // redirect($_SERVER['HTTP_REFERER']);

                  header('Content-Type: application/json'); // tell browser this is JSON       

                  $tab                 = "set_duration";
                  $condition           =  array('id'=>$id);
                  $deleted             = $this->Room_allocation_model->delete_data($tab, $condition);
                  echo json_encode(['success' => (bool)$deleted]); // return JSON
                  exit; 
                  }



                  
                  // public function program_exists($programe_id)
                  // {
                  // $id = $this->input->post('program_id'); // hidden field

                  // // If editing, skip duplicate check
                  // if (!empty($id)) {
                  // return true;
                  // }

                  // $this->db->where('programee_id', $programe_id);
                  // $query = $this->db->get('set_duration');

                  // if ($query->num_rows() > 0) {
                  // $this->form_validation->set_message(
                  // 'program_exists',
                  // 'Duration already exists for this program'
                  // );
                  // return false;
                  // }
                  // return true;
                  // }  
                  
                  

                  
                  
                  public function update_status()
                  {
                  $id              = $this->input->post('Id');
                  $status          = $this->input->post('status');
                  $data            = array('status' => $status);
                  $this->db->where('id', $id);
                  if ($this->db->update('set_duration', $data))
                  {
                  echo json_encode(array('status' => 'success'));
                  } 
                  else
                  {
                  echo json_encode(array('status' => 'error'));
                  }
                  }
                  
                  public function get_data($durationid)
                  {
                  $duraData = $this->Set_duration_model->getDuartionbyId($durationid);
                  if($duraData) {
                  echo json_encode($duraData);
                  } 
                  else
                  {
                  echo json_encode(array('error'=>'Failed'));
                  }  
                  }
                  
                  
                  
                  public function add_data()
                  {
                  $this->form_validation->set_rules('programee_category', $this->lang->line('programee_category'), 'trim|required|xss_clean');
                  $this->form_validation->set_rules('date_from', $this->lang->line('date_from'), 'trim|required|xss_clean');
                  $this->form_validation->set_rules('date_to', $this->lang->line('date_to'), 'trim|required|xss_clean');
                  $this->form_validation->set_rules('No_of_Semester', $this->lang->line('No_of_Semester'), 'trim|required|xss_clean');
                  $this->form_validation->set_rules('No_of_Months', $this->lang->line('No_of_Months'), 'trim|required|xss_clean');
                  $this->form_validation->set_rules('No_of_Days', $this->lang->line('No_of_Days'), 'trim|required|xss_clean');
                  
                  $programme_id           = $this->input->post('programme_id');
                  
                  if ($this->form_validation->run() == false)
                  {
                  $array = array('status' => 'fail', 'error' => $msg, 'message' => '');    
                  } 
                  else 
                  { 
                      
                  if($programme_id=="")
                  {
                    $data                   =  array(
                  'programee_id'          => $this->input->post('programee_category'),
                  'date_from'             => $this->input->post('date_from'),
                  'date_to'               => $this->input->post('date_to'),
                  'no_of_semester'        => $this->input->post('No_of_Semester'),
                  'no_of_months'          => $this->input->post('No_of_Months'),
                  'no_of_days'            => $this->input->post('No_of_Days'),
                  'createddate'           => date('Y-m-d H:i:s'),
                  'session'               => $this->current_session
                  );
                  $this->Set_duration_model->add($data);
                  }
                  else
                  {
                    $data                   =  array(
                  'programee_id'          => $this->input->post('programee_category'),
                  'date_from'             => $this->input->post('date_from'),
                  'date_to'               => $this->input->post('date_to'),
                  'no_of_semester'        => $this->input->post('No_of_Semester'),
                  'no_of_months'          => $this->input->post('No_of_Months'),
                  'no_of_days'            => $this->input->post('No_of_Days'),
                  'updateddate'           => date('Y-m-d H:i:s'),
                  'session'               => $this->current_session );
                  $this->db->where(array('id'=>$programme_id));
                  $this->db->update('set_duration', $data);  
                  }  
                  $msg   = $this->lang->line('success_message');
                  $array = array('status' => 'success', 'error' => '', 'message' => $msg);
                  }
                  echo json_encode($array);
                  }                  



                  public function get_duration_by_id($id)
                  {
                  $Data = $this->Set_duration_model->getDuartionbyId($id);

                  if($Data) {
                  echo json_encode($Data);
                  } 
                  else
                  {
                  echo json_encode(array('error'=>'Failed'));
                  } 
                  }

                  }
