        <?php
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }
        
        class Valuation extends Admin_Controller
        {
        
        public $exam_type            = array();
        private $sch_current_session = "";
        
        public function __construct()
        {
        parent::__construct();
        $this->load->library('encoding_lib');
        $this->load->library('mailsmsconf');
        $this->exam_type           = $this->config->item('exam_type');
        $this->sch_current_session = $this->setting_model->getCurrentSession();
        $this->attendence_exam     = $this->config->item('attendence_exam');
        $this->sch_setting_detail  = $this->setting_model->getSetting();
        $this->getuser_detail      = $this->customlib->getUserData();
        $this->current_session     = $this->setting_model->getCurrentSession();
        $this->load->library('Zend');	
        }
        
        
        function generate_qrcode($data,$valuationid)
        {
        $this->load->library('ciqrcode');
        $hex_data   = bin2hex($data);
        $save_name  = $valuationid.'.png';
        $dir = 'uploads/valuationcamp/qrcode/';
        if (!file_exists($dir)) {
        mkdir($dir, 0775, true);
        }
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
        
        
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);
        
        
        $return = array(
        'content' => $data,
        'file'    => $dir. $save_name
        );
        return $return;
        }
        
        
        
        
//         public function assign_subject()
//         {
//         if (!$this->rbac->hasPrivilege('assign_subject', 'can_view')) 
//         {
//         access_denied();
//         }
//         $data['userdetails'] =  $this->getuser_detail;
//         $userdetails         =  $data['userdetails'];
//         $role                =  $userdetails["user_type"];
//         $id                  =  $userdetails["id"];
//         $this->session->set_userdata('top_menu', 'valuationcamp');
//         $this->session->set_userdata('sub_menu', 'valuationcamp/assign_subject');
//         $data['title']      = 'Valuation ';
//         $data['title_list'] = 'valuation Camp';
//         $examgroup_result = $this->examgroup_model->get();
//         $data['examgrouplist'] = $examgroup_result;
//         $data['sch_current_session'] = $this->sch_current_session;
//         $sch_current_session         =  $data['sch_current_session'];
//         $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
//         $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
//         $this->form_validation->set_rules('staff', $this->lang->line('staff'), 'trim|required|xss_clean');
//         $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required|xss_clean');
//         $this->form_validation->set_rules('bundle_Code', $this->lang->line('bundle_Code'), 'trim|required|xss_clean');
//         $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
//        // $this->form_validation->set_rules('time', $this->lang->line('date'), 'trim|required|xss_clean');
//         if ($this->form_validation->run() == FALSE) 
//         {
        
//         } 
        
//         else 
//         {
//         $timefrom= $this->input->post('time');
//         $ttime= date("h:i a", strtotime($timefrom));
//         $data = array(
//         'valuation_staff'      => $this->input->post('staff'),
//         'valuation_subject'    => $this->input->post('subject'),
//         'valuation_bunblecode' => $this->input->post('bundle_Code'),
//         'valuation_date'          => $this->input->post('date'), 
//         'valuation_center_title'  => $this->input->post('valuation_title'), 
//         'valuation_time'          => $ttime,
//         'valuation_submissiondate'=> $this->input->post('submissiondate'),
//         'valuation_countofpaper'=> $this->input->post('countofpaper'),
//         'valuation_amount'      => $this->input->post('amount'),
//         'valuation_session'     => $sch_current_session,
//         'valuation_examgroup'   => $this->input->post('exam_group_id'),
//         'valuation_examid'      => $this->input->post('exam_id'),
//         'valuation_note'        => $this->input->post('note'));
//         $this->valuation_model->add($data);
//         $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
//         redirect('admin/valuation/assign_subject');        }
//         $data['valuation_list']           = $this->valuation_model->getdata($sch_current_session,$role,$id);
//         $data['valuation_list_previous']  = $this->valuation_model->getdata_previous($sch_current_session,$role,$id);
//         $data['examgroup_list']             = $this->valuation_model->examgroup_list();
//         $data['valuation_list_examgroup']   = $this->valuation_model->getdata_examgroup($role,$id);
//         $data['Stafflist']                  = $this->valuation_model->Stafflist();
//         $data['subjectlist']                = $this->valuation_model->subjectlist();
//         $data['valuationcenter']            = $this->examgroupstudent_model->valuation_center();
//         $this->load->view('layout/header', $data);
//         $this->load->view('admin/valuationcamp/index', $data);
//         $this->load->view('layout/footer', $data);
//         }



public function assign_subject()
        {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_view')) 
        {
        access_denied();
        }
        $data['userdetails'] =  $this->getuser_detail;
        $userdetails         =  $data['userdetails'];
        $role                =  $userdetails["user_type"];
        $id                  =  $userdetails["id"];
        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/assign_subject');
        $data['title']      = 'Valuation ';
        $data['title_list'] = 'valuation Camp';
        $examgroup_result = $this->examgroup_model->get();
        $data['examgrouplist'] = $examgroup_result;
        $data['sch_current_session'] = $this->sch_current_session;
        $sch_current_session         =  $data['sch_current_session'];
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('staff', $this->lang->line('staff'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('bundle_Code', $this->lang->line('bundle_Code'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
       // $this->form_validation->set_rules('time', $this->lang->line('date'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) 
        {
        
        } 
        
        else 
        {
        $timefrom= $this->input->post('time');
        $ttime= date("h:i a", strtotime($timefrom));
        $data = array(
        'valuation_staff'      => $this->input->post('staff'),
        'valuation_subject'    => $this->input->post('subject'),
        'valuation_bunblecode' => $this->input->post('bundle_Code'),
        'valuation_date'          => $this->input->post('date'), 
        'valuation_center_title'  => $this->input->post('valuation_title'), 
        'valuation_time'          => $ttime,
        'valuation_submissiondate'=> $this->input->post('submissiondate'),
        'valuation_countofpaper'=> $this->input->post('countofpaper'),
        'valuation_amount'      => $this->input->post('amount'),
        'valuation_session'     => $sch_current_session,
        'valuation_examgroup'   => $this->input->post('exam_group_id'),
        'valuation_examid'      => $this->input->post('exam_id'),
        'valuation_note'        => $this->input->post('note'));
        $this->valuation_model->add($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect('admin/valuation/assign_subject');        }
        $data['valuation_list']           = $this->valuation_model->getdata($sch_current_session,$role,$id);
        $data['valuation_list_previous']  = $this->valuation_model->getdata_previous($sch_current_session,$role,$id);
        $data['examgroup_list']             = $this->valuation_model->examgroup_list();
        $data['valuation_list_examgroup']   = $this->valuation_model->getdata_examgroup($role,$id);
        $data['Stafflist']                  = $this->valuation_model->Stafflist();
        $data['subjectlist']                = $this->valuation_model->subjectlist();
        $data['valuationcenter']            = $this->examgroupstudent_model->valuation_center();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationcamp/index', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        
        public function edit($id)
        {
        if (!$this->rbac->hasPrivilege('assign_subject', 'can_view')) 
        {
        access_denied();
        }
        
         $data['sch_current_session'] =  $this->sch_current_session;
        $sch_current_session          =  $data['sch_current_session'];
        $examgroup_result             =  $this->examgroup_model->get();
        $data['examgrouplist']        =  $examgroup_result;
        $data['title']                =  'Edit Valuation';
        $data['id']                   =  $id;
        $data['editvaluation']        =  $this->valuation_model->get($id);
        $data['valuation_list']       =  $this->valuation_model->getdata($sch_current_session,$role,$id);
        
        // $data['valuation_list_previous']  = $this->valuation_model->getdata_previous($sch_current_session);
        
        $data['Stafflist']           = $this->valuation_model->Stafflist();
        $data['subjectlist']         = $this->valuation_model->subjectlist();  
        $data['title']           = 'Valuation';
        $data['title_list']      = 'valuation Camp';
        $data['valuationcenter']    = $this->examgroupstudent_model->valuation_center();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationcamp/edit', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        
        
        public  function update()
        {
        $data['sch_current_session'] =  $this->sch_current_session;
        $sch_current_session         =  $data['sch_current_session'];
        $examgroup_result            =  $this->examgroup_model->get();
        $data['examgrouplist']       =  $examgroup_result;
        $data['title']               =  'Edit Valuation';
        $id                          =  $this->input->post('id');
        $data['id']                  =  $id;
        $data['editvaluation']       =  $this->valuation_model->get($id);
        $data['valuation_list']      =  $this->valuation_model->getdata($sch_current_session,$role,$id);
        // $data['valuation_list_previous']  = $this->valuation_model->getdata_previous($sch_current_session);
        
        $data['Stafflist']           = $this->valuation_model->Stafflist();
        $data['subjectlist']         = $this->valuation_model->subjectlist(); 
        $data['title']           = 'Valuation';
        $data['title_list']      = 'valuation Camp';
        $data['valuationcenter']    = $this->examgroupstudent_model->valuation_center();
        
        // $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('staff', $this->lang->line('staff'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('bundle_Code', $this->lang->line('bundle_Code'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('date', $this->lang->line('date'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('time', $this->lang->line('time'), 'trim|required|xss_clean');
        
        // if ($this->form_validation->run() == FALSE) 
        // {
        
        // } 
        // else
        // {
        $timefrom        = $this->input->post('time');
        $ttime           = date("h:i a", strtotime($timefrom));          
        $data = array(
        'valuation_id'          => $id,
        'valuation_staff'       => $this->input->post('staff'),
        'valuation_subject'     => $this->input->post('subject'),
        'valuation_bunblecode'  => $this->input->post('bundle_Code'),
        'valuation_date'        => $this->input->post('date'),  
        'valuation_center_title'       => $this->input->post('valuation_title'), 
        'valuation_time'        => $ttime,
        'valuation_submissiondate'=> $this->input->post('submissiondate'),
        'valuation_countofpaper'=> $this->input->post('countofpaper'),
        'valuation_amount'      => $this->input->post('amount'),
        'valuation_session'    => $sch_current_session,
        'valuation_examgroup'   => $this->input->post('exam_group_id'),
        'valuation_examid'      => $this->input->post('exam_id'),
        'valuation_note'        => $this->input->post('note'));
        
        $this->valuation_model->add($data);
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('update_message').'</div>');
        //redirect('admin/valuationcamp/assign_subject');
        
        redirect($_SERVER['HTTP_REFERER']);
       // }
        }
        function delete($id) 
        {
        $this->valuation_model->remove($id);
        redirect('admin/valuation/assign_subject');
        }
        
        public function printvalue()
        {
        $valuationid              = $this->input->post('valuationid');
        $data['valuationval']     = $this->valuation_model->getvaluatuonid($valuationid);
        $valuationval             = $data['valuationval'];
        $staffid                    = $valuationval['staffid'] ;
        $staffname                  = $valuationval['staffname'] ;
        $sessionname                = $valuationval['sessionname'] ;
        $staffpermanentaddress      = $valuationval['staffpermanentaddress'];
        $valuation_bunblecode       =      $valuationval['valuation_bunblecode'] ;
        $subjectcode                =      $valuationval['subjectcode'] ;
      
        $data                  =    "Staff ID:$staffid\nName:$staffname\nSession:$sessionname\nHouse Name: $staffpermanentaddress\nBundlecode:$valuation_bunblecode";
        $qr                    =    $this->generate_qrcode($data,$valuationid);
        $table                 =    "valuation_assignsubjects";
        $condition             =    array('valuation_id'=>$valuationid);
        $data                  =    array('valuation_qrcode'=> $qr['file']);
        $this->Entranceadmission_model->updte_value($table,$data,$condition);
        
        
        $dat=[];
        $code=$subjectcode;       
        
        $this->zend->load('Zend/Barcode');
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
        imagepng($imageResource, 'uploads/valuationcamp/barcode/'.$valuationid.'.png');
        $dat['valuation_barcode'] = 'uploads/valuationcamp/barcode'.$valuationid.'.png';
        $barcode         =  $dat['valuation_barcode'] ;
        $dat            =  array('valuation_barcode'  =>  $valuationid.'.png' );
        
        $this->db->where('valuation_id',$valuationid);
        $this->db->update('valuation_assignsubjects', $dat);
        $data['assignsubjects']   = $this->valuation_model->getsubjectsid($valuationid);
        $html=$this->load->view('admin/valuationcamp/printreceipt',$data);
        echo json_encode($html);
        }
        
        
        
        public function createvaluationcamp_subjects()
        {
        //  if (!$this->rbac->hasPrivilege('enter_mark', 'can_view')) {
        //     access_denied();
        // }

        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/createvaluationcamp_subjects');
        $examgroup_result        = $this->examgroup_model->get();
        $data['examgrouplist']   = $examgroup_result;
        $marksheet_result        = $this->marksheet_model->get();
        $data['marksheetlist']   = $marksheet_result;
        $data['current_session'] = $this->sch_current_session;
        $class                   = $this->class_model->get();
        $data['title']           = 'Valuation Camp';
        $data['title_list']      = 'Valuation Camp';
        $data['examType']        = $this->exam_type;
        $data['classlist']       = $class;
        $session                 = $this->session_model->get();
        $data['sessionlist']     = $session;
        $this->form_validation->set_rules('session_id', $this->lang->line('session'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam') . " " . $this->lang->line('group'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false)
        {
        } 
        else
        {
        $valuation_title = $this->input->post('valuation_title');    
        $exam_group_id = $this->input->post('exam_group_id');
        $exam_id = $this->input->post('exam_id');
        $session_id = $this->input->post('session_id');
        // $class_id = $this->input->post('class_id');
        // $section_id = $this->input->post('section_id');
        // $subjectid = $this->input->post('subjectname');
        $marksheet_template = $this->input->post('marksheet');
        $data['marksheet_template'] = $marksheet_template;
        $exam_details = $this->examgroup_model->getExamByID($exam_id);
        $studentList         = $this->examgroupstudent_model->searchExamStudents_valuation($exam_group_id, $exam_id, $class_id, $section_id, $session_id,$subjectid);
        $data['mark_result']= $this->examgroupstudent_model->searchExamStudents_valuationeaxmresult();
        $exam_subjects = $this->batchsubject_model->getvaluationExamSubjects($exam_id);
        $data['subjectList'] = $exam_subjects;
        $data['studentList']       = $studentList;
        $exam_grades                = $this->grade_model->getByExamType($exam_details->exam_group_type);
        $data['exam_grades']        = $exam_grades;
        $data['exam_details']       = $exam_details;
        $data['exam_id']            = $exam_id;
        $data['exam_group_id']      = $exam_group_id;
        $data['attendence_exam']    = $this->attendence_exam;
        
        $exam_id                    = $this->input->post('exam_id'); 
        //$data['examlist']           = $this->examgroupstudent_model->getNamesubject_bytitle($valuation_title,$exam_id);
        $data['examlist']           = $this->examgroupstudent_model->getNamesubject_bytitle($valuation_title,$exam_id,$session_id);
        $valuation_title = $this->input->post('valuation_title'); 
        $data['valuation_title'] = $valuation_title;
        } 
        $data['valuationcenter']    = $this->examgroupstudent_model->valuation_center();
        $data['sch_setting'] = $this->sch_setting_detail;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationcamp/create', $data);
        /////$this->load->view('layout/footer', $data);
        }         
            
         public function addvaluationcamp_subjects()
         {
         $papercount        =     array();
         $paperamount       =     array();
         $subjectid         =     array();
         $ucode             =     $this->input->post('ucode');
         $exam_group_id     =     $this->input->post('exam_group_id');
         $exam_id           =     $this->input->post('exam_id');
         $subjectid         =     $this->input->post('subjectid');
         $papercount        =     $this->input->post('papercount');
         $paperamount       =     $this->input->post('paperamount');
         $subbatchid        =     $this->input->post('subbatchid');
         $valuation_title   =     $this->input->post('valuation_title');
        
        for($i=0;$i<=count($subjectid);$i++)
        {
        $this->db->select('*');
        $this->db->from('valuation_subject_list');
        $this->db->where(array('valuation_subject_list_subjectid'=>$subjectid[$i],
        'valuation_subject_list_examgroup'=>$exam_group_id,
        'valuation_subject_list_exam'=>$exam_id,
        'valuation_subject_list_title'=>$valuation_title,
        'valuation_subject_list_session'=>$this->current_session));
        $query   =   $this->db->get();
        if ($query->num_rows() > 0) 
        {
        $condition=$this->db->where(array('valuation_subject_list_subjectid'=>$subjectid[$i], 'valuation_subject_list_title'=>$valuation_title,'valuation_subject_list_examgroup'=>$exam_group_id,'valuation_subject_list_session'=>$this->current_session,'valuation_subject_list_exam'=>$exam_id));
        $dat=array('valuation_subject_list_papercount'=>$papercount[$i], 'valuation_subject_list_amount'=>$paperamount[$i],'valuation_subject_list_title'=>$valuation_title);
        $this->db->update('valuation_subject_list',$dat); 
        }
        else
        {
        $data                   =     array(
        'valuation_subject_list_subjectid'         =>     $subjectid[$i],
        'valuation_subject_list_papercount'        =>     $papercount[$i],
        'valuation_subject_list_amount'            =>     $paperamount[$i],
        'valuation_subject_list_examgroup'         =>     $exam_group_id,
        'valuation_subject_list_title'             =>     $valuation_title,
        'valuation_subject_list_exam'              =>     $exam_id,
        'valuation_subject_list_session'           =>     $this->current_session,
        );
        $this->db->insert('valuation_subject_list', $data); 
        }
        }
        redirect('admin/valuation/createvaluationcamp_subjects');
        }     
        
        
        
        
        public function clearvaluation()
        {
        $exam_id= $this->input->post('exam_id');
        $this->db->where(array('valuation_subject_list_exam'=>$exam_id));
        $data=$this->db->delete('valuation_subject_list');
        echo json_encode($data);
        }
        
        public function getvaluationtotal()
        {
        $exam_id= $this->input->post('exam_id');
        $subject= $this->input->post('subject');
        $valuation_title= $this->input->post('valuation_title');
        $data= $this->valuation_model->getvaluationamount($exam_id,$subject,$valuation_title);
        echo json_encode($data);
        }
        
        
        
        public function createvaluationcamp()
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/createvaluationcamp');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        
        $data['title']                 =  'valuation';
        $data['valuation_center']      =  $this->valuation_model->getvaluationcenter();
        
        $examgroup_result              = $this->examgroup_model->get();
        $data['examgrouplist']         = $examgroup_result;
        
        
        // $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('valuation_name', $this->lang->line('valuation_name'), 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == false) 
        {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationcamp/valuationcamp/create', $data);
        $this->load->view('layout/footer', $data);
        } 
        else
        {
        }
        }
        
        
        
        public function add_val()
        {
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('exam_group_id', $this->lang->line('exam_group_id'), 'trim|required|xss_clean');
        // $this->form_validation->set_rules('exam_id', $this->lang->line('exam_id'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('valuation_name', $this->lang->line('valuation_name'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) 
        {
       
        } 
        else
        { 
        $data = array(
        // 'valuation_centerexam_group_id'        => $this->input->post('exam_group_id'),
        // 'valuation_centerexamid'                => $this->input->post('exam_id'),
        'valuation_centername'                     => $this->input->post('valuation_name'),
        'valuation_centersession'                  => $this->current_session,
        'valuation_centerlocation'                 => $this->input->post('valuation_location'),
        'valuation_centerfromdate'                 => $this->input->post('fromdate'),
        'valuation_centertodate'                   => $this->input->post('todate'),
        'valuation_closingdate'                    => $this->input->post('enter_mark'),
        'valuation_close_entermarks_msg'           => $this->input->post('close_enter_marks'),         
        );
        $this->db->insert('valuation_center',$data); 
        redirect($_SERVER['HTTP_REFERER']);
        }
        }
        
        
        public function edit_valuationcenter($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->session->set_userdata('top_menu', 'valuationcamp');
        $this->session->set_userdata('sub_menu', 'valuationcamp/createvaluationcamp');
        
        $session                       =  $this->session_model->get();
        $data['sessionlist']           =  $session;
        $examgroup_result              =   $this->examgroup_model->get();
        $data['examgrouplist']         =   $examgroup_result;
        $data['title']                 =  'valuation';
        $data['valuation_center']      =   $this->valuation_model->getvaluationcenter();
        
        $data['valuation_centerbyid'] =  $this->valuation_model->valuationcenter_byid($id);
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/valuationcamp/valuationcamp/edit', $data);
        $this->load->view('layout/footer', $data);
        }
        
        
        public function update_valuationcenter()
        {
        $id         =               $this->input->post('valuation_id');
        $data = array(
        // 'valuation_centerexam_group_id'               => $this->input->post('exam_group_id'),
        // 'valuation_centerexamid'                      => $this->input->post('exam_id'),
        'valuation_centername'                        => $this->input->post('valuation_name'),
        'valuation_centersession'                     => $this->current_session,
        'valuation_centerlocation'                    => $this->input->post('valuation_location'),
        'valuation_centerfromdate'                    => $this->input->post('fromdate'),
        'valuation_centertodate'                      => $this->input->post('todate'),
        'valuation_closingdate'                       => $this->input->post('enter_mark'),
        'valuation_close_entermarks_msg'              => $this->input->post('close_enter_marks'),
        );
        
        $this->db->where('valuation_centerid',$id);
        $this->db->update('valuation_center',$data);
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        
        public function delete_valuationcenter($id)
        {
        $this->current_session = $this->setting_model->getCurrentSession();
        $tab                   = "valuation_center";
        $data                  = array('valuation_centerid'=>$id);
        $this->db->delete($tab,$data);
        redirect($_SERVER['HTTP_REFERER']);                       
        }
        
        
        
        public function getgroup_exam_bytitle()
        {
        $data=array();
        $title= $this->input->post('title');
        $data =  $this->valuation_model->getvaluationcenter_groupexam($title);
        echo json_encode($data);
        }
        
        
        
        public function getsubject_paper()
        {
        $data     =  array();
        $subject  =  $this->input->post('subject');
        $data     =  $this->valuation_model->getsubject_paper($subject);
        echo json_encode($data);
        }
        
        }
