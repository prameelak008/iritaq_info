                <?php
                defined('BASEPATH') OR exit('No direct script access allowed');
                
                class Home extends CI_Controller
                {  
                
                public function __construct()
                {
                parent::__construct();
                $this->load->helper(array('form'));
                $this->load->library(array('form_validation'));
                $studid=$this->session->userdata['session_studid'];
                $this->load->library('Zend');
                }
                
                
                public function admission_form_termsandcondition()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $ta                     =    "entranceexamimage";
                $con                    =    array('img_status'=>1);
                $data['pdfimage']       =    $this->Entranceadmission_model->list_valuedata($ta,$con);
                $feetable               =    "fees_entrancepayment";
                $feecondition           =     array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =     $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =     $data['fee_details'];
                $studid=$this->session->userdata['session_studid']; 
                $this->load->library('form_validation');
                $this->load->library('session');
                $selectedcourse         =    $this->input->post('work_days');
                
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0); 
                $data                   =    array('admission_application_selectedcourse' =>$selectedcourse);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                public function admission_form()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $this->load->library('form_validation');
                $this->load->library('session');
                
                $this->form_validation->set_rules('mobile', 'Mobile', 'required');
                $this->form_validation->set_rules('uname', 'Name', 'required');             
                //$this->form_validation->set_rules('soughtfor[]', 'Sought', 'required'); 
                
                if ($this->form_validation->run() == FALSE) 
                { 
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form',$data);
                $this->load->view('entrance/layout/footer');
                } 
                else 
                {
                $mobile         =     $this->input->post('mobile');
                $uname          =     $this->input->post('uname');
                $exists         =     $this->db->get_where('admission_form_tbl', array('admission_mobile' => $mobile,'admission_form_status' => 0));
                $table          =    "admission_form_tbl";
                $condition      =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0); 
                $data           =     array('admission_mobile'=> $mobile,
                'admission_name'  => $uname);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $this->session->set_userdata(array(
                'admission_mobile'         => $mobile,
                'admission_name'           => $uname,
                'admission_form_status'    => 0
                ));
                $data['getstud']        =$this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_second',$data);
                $this->load->view('entrance/layout/footer');
                } 
                }
               
                else
                {
                
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                public function admission_form_second()
                {
                if(isset($this->session->userdata['logged_in']))
                { 
                $studid=$this->session->userdata['session_studid'];
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('fathername', 'Father Name', 'required');
                $this->form_validation->set_rules('housename', 'House Name', 'required');
                $this->form_validation->set_rules('fatheroccupation', 'Father Occupation', 'required');
                $this->form_validation->set_rules('mothername', 'Mother Name', 'required');
                $this->form_validation->set_rules('motherhousename', 'House Name', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $fathername         =   $this->input->post('fathername');
                $housename          =   $this->input->post('housename');
                $fatheroccupation   =   $this->input->post('fatheroccupation');
                $mothername         =   $this->input->post('mothername');
                $motherhousename    =   $this->input->post('motherhousename');
                $address            =   $this->input->post('address');
                
                if ($this->form_validation->run() == FALSE) 
                {
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);   
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);    
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid); 
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_second',$data);
                $this->load->view('entrance/layout/footer');
                } 
                else 
                {
                $mobile=$this->session->userdata('admission_mobile');
                $uname= $this->session->userdata('admission_name');
                
                $table                        =    "admission_form_tbl";
                $condition                    =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0); 
                $data                         =     array('admission_fathername'  =>   $fathername,
                'admission_housename'         =>   $housename,
                'admission_fatheroccupation'  =>   $fatheroccupation,
                'admission_mothername'        =>   $mothername,
                'admission_motherhousename'  =>   $motherhousename,
                'admission_address'          =>   $address);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $condition         =    array('state_status'=>1); 
                $table             =    "state_list";
                $data['statelist'] =   $this->Entranceadmission_model->list_data($table,$condition); 
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_third',$data);
                $this->load->view('entrance/layout/footer');
                }
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                public function admission_form_third()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                
                $studid=$this->session->userdata['session_studid']; 
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);
                $this->load->library('form_validation');
                $this->form_validation->set_rules('adharno', 'Adhar Number', 'required');
                $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('district', 'District', 'required');
                $this->form_validation->set_rules('thaluk', 'Thaluk', 'required');
                $this->form_validation->set_rules('village', 'Village', 'required');
                $this->form_validation->set_rules('mahallu', 'Mahallu', 'required');
                $this->form_validation->set_rules('iforphan', 'Orphan', 'required');
                $this->form_validation->set_rules('guardian', 'Guardian', 'required');
                $this->form_validation->set_rules('relationship', 'Relationship', 'required');
                $this->form_validation->set_rules('phoneno', 'Phone No', 'required');
                
                $this->form_validation->set_rules('guardianaddress', 'Guardian Address', 'required');
                
                
                
                $adharno        =   $this->input->post('adharno');
                $dob            =   $this->input->post('dob');
                $state          =   $this->input->post('state');
                $district       =   $this->input->post('district');
                $thaluk         =   $this->input->post('thaluk');
                $village        =   $this->input->post('village');
                $mahallu        =   $this->input->post('mahallu');
                $iforphan       =   $this->input->post('iforphan');
                $guardian       =   $this->input->post('guardian');
                $relationship   =   $this->input->post('relationship');
                $phoneno        =   $this->input->post('phoneno');
                
                
                $guardianaddress =   $this->input->post('guardianaddress');
                
                
                $db= date("d-M-Y", strtotime($dob)); 
                
                if ($this->form_validation->run() == FALSE) 
                {
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);
                
                
                $condition      =    array('state_status'=>1); 
                $table          =    "state_list";
                $data['statelist'] =$this->Entranceadmission_model->list_data($table,$condition); 
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_third',$data);
                $this->load->view('entrance/layout/footer');
                } 
                else 
                {
                $mobile                 =   $this->session->userdata('admission_mobile');
                $uname                  =   $this->session->userdata('admission_name');
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);       
                $data                   =     array('admission_adharno'=>   $adharno,
                'admission_dob'         =>   $db,
                'admission_state'       =>   $state,
                'admission_district'    =>   $district,
                'admission_thaluk'      =>   $thaluk,
                'admission_village'     =>   $village,
                'admission_mahallu'     =>   $mahallu,
                'admission_iforphan'    =>   $iforphan,
                'admission_guardian'    =>   $guardian,
                'admission_relationship'=>   $relationship,
                'admission_phoneno'     =>   $phoneno,
                'admission_guardianaddress' =>   $guardianaddress);
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);
                $data['centre']=$this->Entranceadmission_model->centrelist($studid);
                $data['institute']=$this->Entranceadmission_model->institutelist($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_four',$data);
                $this->load->view('entrance/layout/footer');
                } 
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                public function admission_form_four()
                {
                
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid']; 
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $this->load->library('form_validation');
                $this->form_validation->set_rules('laststudiedmadarsa', 'Last Studied Madarasa', 'required');
                $this->form_validation->set_rules('madarsaname', 'Name Of Madarsa ', 'required');
                $this->form_validation->set_rules('range', 'Range', 'required');
                $this->form_validation->set_rules('laststudied', 'Last Studied Class', 'required');
                $this->form_validation->set_rules('schoolname', 'School Name', 'required');
                $this->form_validation->set_rules('medium', 'Medium', 'required');
                $this->form_validation->set_rules('identification', 'Identification', 'required');
                $laststudiedmadarsa=    $this->input->post('laststudiedmadarsa');
                $madarsaname       =    $this->input->post('madarsaname');
                $range             =    $this->input->post('range');
                $laststudied       =    $this->input->post('laststudied');
                $schoolname        =    $this->input->post('schoolname');
                $medium            =    $this->input->post('medium');
                $identification    =    $this->input->post('identification');
                
                if ($this->form_validation->run() == FALSE) 
                {
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid); 
                $data['centre']=$this->Entranceadmission_model->centrelist($studid);
                $data['institute']=$this->Entranceadmission_model->institutelist($studid);
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_four',$data);
                $this->load->view('entrance/layout/footer');
                }
                
                else 
                {
                if(!empty($_FILES['photo']['name']))
                {
                $config['upload_path']     = 'entrance/admissionphoto/';
                $config['allowed_types']   = 'jpg|jpeg|png|gif';
                $config['file_name']       = $_FILES['photo']['name'];
                $img_array['create_thumb'] = TRUE;
                /*$config['max_width']       = '2000';
                $config['max_height']      = '2000';*/
                
                //$config['create_thumb'] = TRUE;           
                
                //$config['max_size'] = '100';
                // $config['max_width'] = '1024';
                //$config['max_height'] = '768';
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('photo'))
                {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
                }
                else
                {
                $picture = '';
                }
                }
                
                $mobile=$this->session->userdata('admission_mobile');
                $uname= $this->session->userdata('admission_name');
                $table                 =             "admission_form_tbl";
                $condition             =             array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                $data                  =             array('admission_laststudiedmadarsa'  =>   $laststudiedmadarsa,
                'admission_range'               =>   $range,
                'admission_laststudied'         =>   $laststudied,
                'admission_nameofmadarsa'       =>   $madarsaname,
                
                'admission_schoolname'          =>   $schoolname,
                'admission_medium'              =>   $medium,
                'admission_identification'      =>   $identification,
                'admission_photo'               =>   $picture);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);
                $data['centre']         =    $this->Entranceadmission_model->centrelist($studid);
                $data['institute']      =    $this->Entranceadmission_model->institutelist($studid); 
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_photo',$data);
                $this->load->view('entrance/layout/footer');
                }
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                
                public function update_admission_form_secondary()
                { 
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $this->load->library('form_validation');
                $this->form_validation->set_rules('institute_optionone', 'Option 1', 'required');
                $this->form_validation->set_rules('institute_optiontwo', 'Option 2', 'required');
                $this->form_validation->set_rules('institute_optionthree', 'Option 3', 'required');
                $this->form_validation->set_rules('examcenter', 'Exam Center', 'required');
                $institute_optionone     =   $this->input->post('institute_optionone');
                $institute_optiontwo     =   $this->input->post('institute_optiontwo');
                $institute_optionthree   =   $this->input->post('institute_optionthree');
                $examcenter              =   $this->input->post('examcenter');
                if ($this->form_validation->run() == FALSE) 
                {  
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);   
                $data['centre']=$this->Entranceadmission_model->centrelist($studid);
                $data['institute']=$this->Entranceadmission_model->institutelist($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_photo',$data);
                $this->load->view('entrance/layout/footer');
                } 
                else 
                { 
                
                $mobile=$this->session->userdata('admission_mobile');
                $uname= $this->session->userdata('admission_name');
                $studid=$this->session->userdata['session_studid']; 
                $table       =    "admission_form_tbl";
                $condition   =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                $data        =     array('admission_institute_optionone'  =>   $institute_optionone,
                'admission_institute_optiontwo'         =>   $institute_optiontwo,
                'admission_institute_optionthree'  =>   $institute_optionthree,
                'admission_institute_examcenter'        =>   $examcenter );
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                
                $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid); 
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid); 
                $data['application_no']= $this->Entranceadmission_model->max_application_no();
                $application=$data['application_no'];
                
                foreach($application as $ch)
                {
                if($ch=="")
                {
                $record="1001";
                }
                else
                {
                $rec= explode(',',$ch);
                $record= $rec[0]+1;
                }            
                }
                
                $datetime=date('Y-m-d H:i:s');
                $date=date('d-M-Y');
                
                
                
                $table          =    "admission_form_tbl";
                $condition      =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                $data           =    array('admission_form_status'=>0,'admission_application_no'=>$record,'admission_datetime'=>$datetime,'admission_date'=>$date);
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                
                $application_no=array();
                
                $data['admission']=$this->Entranceadmission_model->list_valuedata($table,$condition);
                
                
                $ta                    = "entranceexamimage";
                
                $con                   = array('img_status'=>1);
                
                $data['pdfimage']      = $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_payment');
                $this->load->view('entrance/layout/footer');
                }
                
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                public function admission_form_payment()
                {
                //$this->load->library('form_validation');
                
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $mobile         =    $this->session->userdata('admission_mobile');
                $uname          =    $this->session->userdata('admission_name');
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_form_success',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                public  function admission_form_pdf()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $this->load->library('pdf'); 
                $application_no=array();
                
                $mobile                 =   $this->session->userdata('admission_mobile');
                $uname                  =   $this->session->userdata('admission_name');
                $data['admission']      =   $this->Entranceadmission_model->getstudents($studid);
                $ta                     =   "entranceexamimage";
                $con                    =   array('img_status'=>1);
                $data['pdfimage']       =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                $data['courses']        =   $this->Entranceadmission_model->getcourse($studid);
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admission_form',$data,true);
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                public function paynow()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $mobile                = $this->session->userdata('admission_mobile');
                $uname                 = $this->session->userdata('admission_name');
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_paynow',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                public function meTrnReq()
                {
                
                if(isset($this->session->userdata['logged_in']))
                {
                $studid                 =   $this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $data['amount']         =   $this->input->post('amount');
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                $tab                    =    "admission_form_tbl";
                $con                    =    array('admission_application_registerid'=>$studid);
                $data['regid']          =   $this->Entranceadmission_model->list_valuedata($tab,$con);
                
                
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/standard/meTrnReq',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                public function meTrnPayment()
                {
                
                if(isset($this->session->userdata['logged_in']))
                {
                
                $studid=$this->session->userdata['session_studid']; 
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $amount=$this->input->post('amount');
                $paise=$amount*100;
                
                $data['orderId']         = $this->input->post('orderId');
                $data['responseUrl']     = $this->input->post('responseUrl');
                $data['amount']          = $paise;
                $data['meTransReqType']  = $this->input->post('meTransReqType');
                $data['currencyName']    = $this->input->post('currencyName');
                $data['mid']             = $this->input->post('mid');
                $data['enckey']          = $this->input->post('enckey');
                $data['recurPeriod']     = $this->input->post('recurPeriod');
                $data['numberRecurring'] = $this->input->post('numberRecurring');
                $data['recurDay']        = $this->input->post('recurDay');
                $data['addField1']       = $this->input->post('addField1');
                $data['addField2']       = $this->input->post('addField2');
                $data['addField3']       = $this->input->post('addField3');
                $data['addField4']       = $this->input->post('addField4');
                $data['addField5']       = $this->input->post('addField5');
                $data['addField6']       = $this->input->post('addField6');
                $data['addField7']       = $this->input->post('addField7');
                $data['addField8']       = $this->input->post('addField8'); 
                
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/standard/meTrnPay',$data);
                $this->load->view('entrance/layout/footer'); 
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                } 
                
                
                public function meTrnSuccess()
                {
                $this->load->view('entrance/admissionform/standard/meTrnSuccess');
                }
                
                
                
                public function pay()
                {
                
                date_default_timezone_set('Asia/Kolkata');  
                
                $studid                  = $this->session->userdata['session_studid']; 
                $getStatusCode           = $this->input->post('getStatusCode');
                $getPgMeTrnRefNo         = $this->input->post('getPgMeTrnRefNo');
                $getOrderId              = $this->input->post('getOrderId');
                $getTrnAmt               = $this->input->post('getTrnAmt');
                $getStatusDesc           = $this->input->post('getStatusDesc');
                $getTrnReqDate           = $this->input->post('getTrnReqDate');
                $getResponseCode         = $this->input->post('getResponseCode');
                $getAddField1            = $this->input->post('getAddField1');
                $getAddField2            = $this->input->post('getAddField2');
                $getAddField3            = $this->input->post('getAddField3');
                $getAddField4            = $this->input->post('getAddField4');
                $getRrn                  = $this->input->post('getRrn');
                $getAuthZCode            = $this->input->post('getAuthZCode');
                $getamt                  = $getTrnAmt/100;
                
                $feepay                  = array(
                'fees_entrancepayment_statuscode'    =>  $getStatusCode,
                'fees_entrancepayment_transaction_no'=>  $getPgMeTrnRefNo,
                'fees_entrancepayment_orderid'       =>  $getOrderId,
                'fees_entrancepayment_amount'        =>  $getamt,
                'fees_entrancepayment_student_id'    =>  $getAddField1,
                'fees_entrancepayment_year'          =>  $getAddField2,
                'fees_entrancepayment_registerid'    =>  $getAddField3,
                'fees_entrancepayment_applicationno' =>  $getAddField4,
                'fees_entrancepayment_transdate'     =>  $getTrnReqDate,
                'fees_entrancepayment_responsecode'  =>  $getResponseCode,
                'fees_entrancepayment_authzcode'     =>  $getAuthZCode, 
                'fees_entrancepayment_rrn'           =>  $getRrn,
                
                'fees_entrancepayment_created_date'  =>  date('d-m-y H:i:s'));
                $this->db->insert("fees_entrancepayment", $feepay);
                
                $data['applicantcourse']=    $this->Entranceadmission_model->getcourse_status($studid); 
                
                if(	$getStatusCode=="S")
                {
                
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid); 
                $data                   =    array('admission_form_status' =>1,'admission_payment'=>'Paid');
                
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/standard/success',$data); 
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid); 
                $data                   =    array('admission_form_status' =>1,'admission_payment'=>'Failed');
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition); 
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/standard/failed',$data);
                $this->load->view('entrance/layout/footer'); 
                }
                }
                
                
                
                
                
                
                
                
                public function paymentreceipt()
                {
                
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                $feedetails             =   $data['fee_details'];
                
                $data['paymentreceipt'] =   $this->Entranceadmission_model->getfeerecept($studid);
                
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_feereceipt',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                
                public  function admission_paymentreceipt_pdf()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $this->load->library('pdf');
                
                
                $application_no         =   array();
                $ta                     =   "entranceexamimage";
                $con                    =   array('img_status'=>1);
                $data['pdfimage']       =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                
                $data['paymentreceipt'] =   $this->Entranceadmission_model->getfeerecept($studid);
                
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admission_paymentreceipt_pdf',$data,true);
                
                $this->pdf->loadHtml($html_content);
                
                $html = mb_convert_encoding($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                
                public  function admission_admitcard_pdf()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                
                
                
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $this->load->library('pdf');
                $application_no         =   array();
                $ta                     =   "entranceexamimage";
                $con                    =   array('img_status'=>1);
                $data['pdfimage']       =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                $data['paymentreceipt'] =   $this->Entranceadmission_model->getfeerecept($studid);
                $adlist                   = $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']    = $adlist;
                
                $exdetails                  = $this->Entranceadmission_model->getadmitcard_time($studid);
                $data['examdetails']        = $exdetails;
                $table                  =   "admission_form_tbl";
                $condition              =   array('admission_application_registerid'=>$studid,);
                $data['admission']      =   $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admitcard_pdf',$data,true);
                
                
                $this->pdf->loadHtml($html_content, 'UTF-8');
                
                
                
                
                $this->pdf->set_option('isRemoteEnabled', true);
                
                
                $this->pdf->set_option('isFontSubsettingEnabled', true);
                
                
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                public function dist()
                {
                $state          =   $this->input->post('state');
                $table			=	"district_list";
                $condition		=	array('district_stateid'=>$state,'district_status'=>1);
                $district       =   $this->Entranceadmission_model->list_data($table,$condition);
                echo json_encode($district);	
                }
                
                
                
                
                
                public function checkstatus()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $data['applicant']      =   $this->Entranceadmission_model->getapplicant($studid);
                
                $data['applicantstatus']    =   $this->Entranceadmission_model->getfeerecept_applicantstatus($studid);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/admission_checkstatus',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                function generate_qrcode($data)
                {
                $dirname         =   $this->session->userdata['session_studid'];
                
                $this->load->library('ciqrcode');
                $hex_data   = bin2hex($data);
                $save_name  = $dirname.'.png';
                $dir = 'entrance/admissionqrcode/';
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
                
                
                
                
                
                public function admitcard()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid         =   $this->session->userdata['session_studid'];
                $this->db->where(array('admission_application_registerid' => $studid, 'admission_qrcode' => ""));  
                
                $q 		    = $this->db->get('admission_form_tbl');
                if ($q->num_rows() > 0) 
                {
                
                $datval                =   $q->row_array();
                $admission_name        =   $datval['admission_name'];
                $admission_mobile      =   $datval['admission_mobile'];
                $admission_fathername  =   $datval['admission_fathername'];                    
                $admission_housename   =   $datval['admission_housename'];
               
                $data= "Student Name:$admission_name\nMobile:$admission_mobile\nFather Name:$admission_fathername\nHouse Name: $admission_housename\n";
                $qr                    =    $this->generate_qrcode($data);
                $table                 =    "admission_form_tbl";
                $condition             =    array('admission_application_registerid'=>$studid);
                $data                  =    array('admission_qrcode'=> $qr['file']);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                }
                
                
                $data['getcourse']      =   $this->Entranceadmission_model->getcourse($studid);
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $this->load->library('pdf');
                
                $application_no          =   array();
                $ta                      =   "entranceexamimage";
                $con                     =   array('img_status'=>1);
                $data['pdfimage']        =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                $data['paymentreceipt']  =   $this->Entranceadmission_model->getfeerecept($studid);
                $adlist                  =   $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']   =   $adlist;
                
                $exdetails                =   $this->Entranceadmission_model->getadmitcard_time($studid);
                $data['examdetails']      =   $exdetails;
                $table                    =   "admission_form_tbl";
                $condition                =   array('admission_application_registerid'=>$studid);
                $data['admission']        =   $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admitcard_pdf',$data,true);
                
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                public function resultt()
                {
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/publishmsg',$data);
                $this->load->view('entrance/layout/footer');
                }
                
                
                public function result()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid               =   $this->session->userdata['session_studid'];
                //$publish_date       =   $this->Entranceadmission_model->listpublishdate($studid);
                
                $currentdate          =   date('Y-m-d');
                
                $this->db->where(array('admission_application_registerid' => $studid, 'admission_qrcode' => ""));      
                $q 		               = $this->db->get('admission_form_tbl');
                if ($q->num_rows() > 0) 
                {
                $datval                =   $q->row_array();
                $admission_name        =   $datval['admission_name'];
                $admission_mobile      =   $datval['admission_mobile'];
                $admission_fathername  =   $datval['admission_fathername'];                    
                $admission_housename   =   $datval['admission_housename'];
                //$data= "Student Name:$admission_name,Mobile:$admission_mobile,Father Name:$admission_fathername,House Name: $admission_housename";
                
                $data= "Student Name:$admission_name\nMobile:$admission_mobile\nFather Name:$admission_fathername\nHouse Name: $admission_housename";
                $qr                    =    $this->generate_qrcode($data);
                
                $table                 =    "admission_form_tbl";
                $condition             =    array('admission_application_registerid'=>$studid);
                $data                  =    array('admission_qrcode'=> $qr['file']);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                }
                
               
               
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $tab                    =    "entranceexam_publish_result_value";
                $condit                 =    array('exam_publish_regid'=>$studid);
                $data['getresult']      =    $this->Entranceadmission_model->list_valuedata($tab,$condit);
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid);
                $app                    =    $this->Entranceadmission_model->list_valuedata($table,$condition);
                $cousid                 =    $app['admission_application_selectedcourse'];
                $data['subjectlist']    =    $this->Entranceadmission_model->searchSubjectlist($studid);
                $data['subjectmarks']   =    $this->Entranceadmission_model->searchsubjectmarks($studid,$cousid);
                $data['examresult']     =    $this->Entranceadmission_model->searchExamResult($studid,$cousid);
                $data['publishresult']  =    $this->Entranceadmission_model->searchpublishresult($studid);
                $data['current_session']=    $this->user_model->get_current_session();
                $current_session        =    $data['current_session']; 
                $currentsess            =    $current_session['session_id'];
                $data['raw_percentage'] =    $this->Entranceadmission_model->seatquotarawheader($cousid,$currentsess);
                $this->load->library('pdf');
                
                $application_no          =   array();
                $ta                      =   "entranceexamimage";
                $con                     =   array('img_status'=>1);
                $data['pdfimage']        =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                $adlist                  =   $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']   =   $adlist;
                $table                   =   "admission_form_tbl";
                $condition               =   array('admission_application_registerid'=>$studid,);
                $data['admission']       =   $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                // $data['reserved_quota']      =   $this->Entranceadmission_model->entranceexam_reserved_seatquota($cousid,$current_session);
                
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/result_pdf',$data,true);
                
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                public function ranklist()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid            =   $this->session->userdata['session_studid'];
                $publish_date      =   $this->Entranceadmission_model->listpublishdate($studid);
                
                $currentdate       =   date('Y-m-d');
                
                
                $this->db->where(array('admission_application_registerid' => $studid, 'admission_qrcode' => ""));      
                $q 		               = $this->db->get('admission_form_tbl');
                if ($q->num_rows() > 0) 
                {
                $datval                =   $q->row_array();
                $admission_name        =   $datval['admission_name'];
                $admission_mobile      =   $datval['admission_mobile'];
                $admission_fathername  =   $datval['admission_fathername'];                    
                $admission_housename   =   $datval['admission_housename'];
                $data= "Student Name:$admission_name\nMobile:$admission_mobile\nFather Name:$admission_fathername\nHouse Name: $admission_housename\n";
                $qr                    =    $this->generate_qrcode($data);
                
                $table                 =    "admission_form_tbl";
                $condition             =    array('admission_application_registerid'=>$studid);
                $data                  =    array('admission_qrcode'=> $qr['file']);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                }
                
                
                $data['getcourse']      =   $this->Entranceadmission_model->getcourse($studid);
                $tab                    =   "entranceexam_publish_result";
                $condit                 =    array('exam_publish_regid'=>$studid);
                $data['getresult']      =   $this->Entranceadmission_model->list_valuedata($tab,$condit);
                
                
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid);
                $app                    =    $this->Entranceadmission_model->list_valuedata($table,$condition);
                $cousid                 =    $app['admission_application_selectedcourse'];
                
                $data['subjectlist']    =   $this->Entranceadmission_model->searchSubjectlist($studid);
                
                
                $data['subjectmarks']   =   $this->Entranceadmission_model->searchsubjectmarks($studid,$cousid);
                
                
                $data['examresult']     =   $this->Entranceadmission_model->searchExamResult($studid,$cousid);
                
                
                $data['publishresult']  =   $this->Entranceadmission_model->searchpublishresult($studid);
                
                
                $this->load->library('pdf');
                
                $application_no          =   array();
                $ta                      =   "entranceexamimage";
                $con                     =   array('img_status'=>1);
                $data['pdfimage']        =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                $adlist                  =   $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']   =   $adlist;
                $table                   =   "admission_form_tbl";
                $condition               =   array('admission_application_registerid'=>$studid,);
                $data['admission']       =   $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/ranklist_pdf',$data,true);
                
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                public function allotmentstatus()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid                    =   $this->session->userdata['session_studid'];
                $tab                       =   "admission_form_tbl";
                $feetable                  =   "fees_entrancepayment";
                $feecondition              =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']       =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails                =   $data['fee_details'];
                $data['applicant']         =   $this->Entranceadmission_model->getapplicant($studid);
                $condit                    =   array('admission_application_registerid'=>$studid);
                $data['applicant']         =   $this->Entranceadmission_model->list_valuedata($tab,$condit);
                $data['allotmentstatus']   =   $this->Entranceadmission_model->allotmentstatus($studid);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/allotment_status',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                public function allotment_slip()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                    
                $data['current_session']   =  $this->setting_model->getCurrentSession();
                $sessionid                 =  $data['current_session'];
                    
                $studid                    =   $this->session->userdata['session_studid'];
                $currentdate               =   date('Y-m-d');
                $studid                    =   $this->session->userdata['session_studid'];
                $tab                       =   "admission_form_tbl";
                $feetable                  =   "fees_entrancepayment";
                $feecondition              =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']       =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails                =   $data['fee_details'];
                $data['applicant']         =   $this->Entranceadmission_model->getapplicant($studid);
                $data['entranceexam_course_id'] =  $data['applicant']['entranceexam_course_id'];
                $course_id                 =  $data['entranceexam_course_id'];
                $condit                    =   array('admission_application_registerid'=>$studid);
                $data['applicant']         =   $this->Entranceadmission_model->list_valuedata($tab,$condit);
                $data['allotmentstatus']   =   $this->Entranceadmission_model->allotmentstatus($studid);
                $data['student_details']   =   $this->Entranceadmission_model->student_details($studid);
                $data['alloted_details']   =   $this->Entranceadmission_model->get_alloted_val($studid);
                $alloted_details           =   $data['alloted_details'];
                $publishid                 =   $alloted_details['entranceexam_allotment_publishid'];
                $data['instruction']       =   $this->Entranceadmission_model->get_instruction($sessionid,$course_id);
                $applicant                 =   $data['applicant'];
                $application               =   $applicant['admission_application_no'];
                
                if($alloted_details['entranceexam_allotment_barcode']=="")
                {
                    
                $data           =[];
                $code           = $application;
                $this->zend->load('Zend/Barcode');
                
                $imageResource   =  Zend_Barcode::factory('EAN13', 'image', array('text'=>$code), array())->draw();
                $path            =  imagepng($imageResource, 'allotbarcodes/'.$code.'.png');
                $data['barcode'] = 'allotbarcodes/'.$code.'.png';
                $barcode         =  $data['barcode'];
                $data            =  array('entranceexam_allotment_barcode'  =>  'allotbarcodes/'.$code.'.png' );
                $this->db->where('entranceexam_allotment_publishid',$publishid);
                $this->db->update('entranceexam_allotment', $data);
                
                
                }
                
                
                $this->load->library('pdf');
                $application_no          =   array();
                $ta                      =   "entranceexamimage";
                $con                     =   array('img_status'=>1);
                $data['pdfimage']        =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                $adlist                  =   $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']   =   $adlist;
                $table                   =   "admission_form_tbl";
                $condition               =   array('admission_application_registerid'=>$studid,);
                $data['admission']       =   $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                // $data['reserved_quota']      =   $this->Entranceadmission_model->entranceexam_reserved_seatquota($cousid,$current_session);
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/allotment_slip_pdf',$data,true);
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                
                }
                
               
                }