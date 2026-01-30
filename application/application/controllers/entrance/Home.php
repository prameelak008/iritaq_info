                <?php
                defined('BASEPATH') OR exit('No direct script access allowed');
                
                class Home extends CI_Controller
                { 
                
                public function __construct()
                {
                date_default_timezone_set('Asia/Kolkata');    
                parent::__construct();
                $this->load->helper(array('form'));
                $this->load->library(array('form_validation'));
                $studid=$this->session->userdata['session_studid'];
                $reg_phone=$this->session->userdata['reg_phone'];
                $this->load->library('Zend');
                $this->load->helper('url');
                $this->load->library('smsgateway');
                $data['entrance_current_session']   =  $this->Entrance_settings_model->get_entrance_settings();
                $cursess                            =  $data['entrance_current_session']['cur_session'];
                $this->load->library('mailsmsconf');
                }
                
                
                
                public function admission_form_termsandcondition()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $ta                     =     "entranceexamimage";
                $con                    =     array('img_status'=>1);
                $data['pdfimage']       =     $this->Entranceadmission_model->list_valuedata($ta,$con);
                $feetable               =     "fees_entrancepayment";
                $feecondition           =     array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =     $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =     $data['fee_details'];
                $studid                 =     $this->session->userdata['session_studid'];
                $data['centre']         =     $this->Entranceadmission_model->centrelist($studid);
                $this->load->library('form_validation');
                $this->load->library('session');
                $selectedcourse         =     $this->input->post('work_days');
                $table                  =     "admission_form_tbl";
                $condition              =     array('admission_application_registerid'=>$studid,'admission_form_status'=>0); 
                $data                   =     array('admission_application_selectedcourse' =>$selectedcourse);
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $feetable               =   "fees_entrancepayment";
                
                $feecondition                       =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']                =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $data['entrance_current_session']   =   $this->Entrance_settings_model->get_entrance_settings();
                
                $cursess                            =  $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =  $this->Entrance_settings_model->get_phase($cursess);
                $get_phase                          =  $data['get_phase'];
                
                $get_phase_value                    =  $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                
                $data['entrance_current_session']   =     $this->Entrance_settings_model->get_entrance_settings();
                $condition                          =     array('state_status'=>1); 
                $table                              =     "state_list";
                $data['statelist']                  =     $this->Entranceadmission_model->list_data($table,$condition);
                $data['check_address']              =     $this->Entranceadmission_model->check_address($studid);
                $data['centerlist_bysession']       =     $this->Entranceadmission_model->centerlist_bysession($selectedcourse,$data['entrance_current_session']['cur_session'],$get_phase_value);
               
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
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
                $studid                 =   $this->session->userdata['session_studid'];
                $data['application_no'] =   $this->Entranceadmission_model->max_application_no();
                $application            =   $data['application_no'];
                
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
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                $this->load->library('form_validation');
                $this->load->library('session');
                $condition              =    array('state_status'=>1); 
                $table                  =    "state_list";
                $data['statelist']      =    $this->Entranceadmission_model->list_data($table,$condition); 
                
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $add_selectedcourse     =    $data['getcourse']['admission_application_selectedcourse'];
                $data['entrance_current_session']   =  $this->Entrance_settings_model->get_entrance_settings();
                $cursess                            =  $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =  $this->Entrance_settings_model->get_phase($cursess);
                
                $get_phase                          =  $data['get_phase']; 
                $get_phase_value                    =  $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                $data['centerlist_bysession']       =  $this->Entranceadmission_model->centerlist_bysession($add_selectedcourse,$data['entrance_current_session']['cur_session'],$get_phase_value);
               
                $this->form_validation->set_rules('mobile', 'Mobile', 'required');
                $this->form_validation->set_rules('uname', 'Name', 'required');
                $this->form_validation->set_rules('fathername', 'Father Name', 'required');
                $this->form_validation->set_rules('housename', 'House Name', 'required');
                $this->form_validation->set_rules('fatheroccupation', 'Father Occupation', 'required');
                $this->form_validation->set_rules('mothername', 'Mother Name', 'required');
                $this->form_validation->set_rules('motherhousename', 'House Name', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
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
                
                // $this->form_validation->set_rules('laststudiedmadarsa', 'Last Studied Madarasa', 'required');
                // $this->form_validation->set_rules('madarsaname', 'Name Of Madarsa ', 'required');
                // $this->form_validation->set_rules('range', 'Range', 'required');
                // $this->form_validation->set_rules('laststudied', 'Last Studied Class', 'required');
                // $this->form_validation->set_rules('schoolname', 'School Name', 'required');
                // $this->form_validation->set_rules('medium', 'Medium', 'required');
               // $this->form_validation->set_rules('identification', 'Identification', 'required');
               
                if ($this->form_validation->run() == FALSE) 
                { 
                $data['getstud']        =   $this->Entranceadmission_model->getdataexists($studid);
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $data['check_address']  =   $this->Entranceadmission_model->check_address($studid);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/admissionform/admission_form',$data);
                $this->load->view('entrance/layout/footer');
                } 
                else 
                {
                $mobile             =   $this->input->post('mobile');
                $uname              =   $this->input->post('uname');
                $fathername         =   $this->input->post('fathername');
                $housename          =   $this->input->post('housename');
                $fatheroccupation   =   $this->input->post('fatheroccupation');
                $mothername         =   $this->input->post('mothername');
                $motherhousename    =   $this->input->post('motherhousename');
                $address            =   $this->input->post('address');
                $adharno            =   $this->input->post('adharno');
                $dob                =   $this->input->post('dob');
                $state              =   $this->input->post('state');
                $district           =   $this->input->post('district');
                $thaluk             =   $this->input->post('thaluk');
                $village            =   $this->input->post('village');
                $mahallu            =   $this->input->post('mahallu');
                $iforphan           =   $this->input->post('iforphan');
                $guardian           =   $this->input->post('guardian');
                $relationship       =   $this->input->post('relationship');
                $phoneno            =   $this->input->post('phoneno');
                $guardianaddress    =   $this->input->post('guardianaddress');
                $db                 =   date("d-M-Y", strtotime($dob));
                $laststudiedmadarsa =    $this->input->post('laststudiedmadarsa');
                $madarsaname        =    $this->input->post('madarsaname');
                $range              =    $this->input->post('admission_range');
                $laststudied        =    $this->input->post('laststudied');
                $schoolname         =    $this->input->post('schoolname');
                $medium             =    $this->input->post('medium');
                $identification     =    $this->input->post('identification');
                $ad_check_address   =    $this->input->post('sameasabove');
                $admission_institute_examcenter   =    $this->input->post('examcenter');
                $last_studied_institute     =    $this->input->post('last_studied_institute');
                $Major_Books_Studied        =    $this->input->post('Major_Books_Studied');
                $Name_Prominent_Teacher	    =    $this->input->post('Name_Prominent_Teacher');
                $years_completed            =    $this->input->post('years_completed');
                $Repitition_Completed       =    $this->input->post('Repitition_Completed');
                $General_Education          =    $this->input->post('General_Education');
                $General_Education_mutawal  =    $this->input->post('General_Education_mutawal');
                $PlaceOf_Institution        =    $this->input->post('PlaceOf_Institution');
                $Medium_of_questionpaper    =    $this->input->post('Medium_of_questionpaper');
                
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
               
                $this->db->where(array('reg_id' => $studid));
                $q 	= $this->db->get('set_entrance_uidesign');
                if ($q->num_rows() > 0) 
                {
                $da = array(
                'ui_primary'=>1,
                'phasegroup'=>$get_phase_value
                ); 
                $this->db->where(array('reg_id'=>$studid));    
                $this->db->update('set_entrance_uidesign',$da);
                }
                else
                {
                $setui = array(               
                'reg_id'=>$studid,
                'phasegroup'=>$get_phase_value,
                'ui_created_date'=>date('Y-m-d H:i:s'),
                'ui_primary'=>1);
                $this->db->insert('set_entrance_uidesign',$setui);
                }
                
                $this->db->where(array('ad_reg_id' => $studid));
                $q 	= $this->db->get('admission_form_details');
                if ($q->num_rows() > 0) 
                {
                $dat = array(
                'ad_check_address'         => $ad_check_address,
                'last_studied_institute'   => $last_studied_institute,
                'Major_Books_Studied'      => $Major_Books_Studied	,
                'Name_Prominent_Teacher'   => $Name_Prominent_Teacher,
                'years_completed'          => $years_completed,
                'Repitition_Completed'     => $Repitition_Completed,
                'PlaceOf_Institution'      => $PlaceOf_Institution,
                'Medium_of_questionpaper'  => $Medium_of_questionpaper,
                'General_Education'        => $General_Education,
                'General_Education_mutawal'=> $General_Education_mutawal,
                ); 
                $this->db->where(array('ad_reg_id'=>$studid));    
                $this->db->update('admission_form_details',$dat);
                }
                else
                {
                $ad_details = array(               
                'ad_reg_id'                => $studid,
                'ad_check_address'         => $ad_check_address,
                'last_studied_institute'   => $last_studied_institute,
                'Major_Books_Studied'      => $Major_Books_Studied	,
                'Name_Prominent_Teacher'   => $Name_Prominent_Teacher,
                'years_completed'          => $years_completed,
                'Repitition_Completed'     => $Repitition_Completed,
                'General_Education'        => $General_Education,
                'General_Education_mutawal'=> $General_Education_mutawal,
                'PlaceOf_Institution'      => $PlaceOf_Institution,
                'Medium_of_questionpaper'  => $Medium_of_questionpaper);
                $this->db->insert('admission_form_details',$ad_details);
                }
                $datetime=date('Y-m-d H:i:s');
                $date=date('d-M-Y');
                $exists                         =     $this->db->get_where('admission_form_tbl', array('admission_mobile' => $mobile,'admission_form_status' => 0));
                $table                          =    "admission_form_tbl";
                $condition                      =     array('admission_application_registerid'=>$studid,'admission_form_status'=>0); 
                $data                           =     array('admission_mobile'=> $mobile,
                'admission_name'                =>   $uname,
                'admission_fathername'          =>   $fathername,
                'admission_housename'           =>   $housename,
                'admission_fatheroccupation'    =>   $fatheroccupation,
                'admission_mothername'          =>   $mothername,
                'admission_motherhousename'     =>   $motherhousename,
                'admission_address'             =>   $address,
                'admission_adharno'             =>   $adharno,
                'admission_dob'                 =>   $db,
                'admission_state'               =>   $state,
                'admission_district'            =>   $district,
                'admission_thaluk'              =>   $thaluk,
                'admission_village'             =>   $village,
                'admission_mahallu'             =>   $mahallu,
                'admission_iforphan'            =>   $iforphan,
                'admission_guardian'            =>   $guardian,
                'admission_relationship'        =>   $relationship,
                'admission_phoneno'             =>   $phoneno,
                'admission_guardianaddress'     =>   $guardianaddress,
                'admission_laststudiedmadarsa'  =>   $laststudiedmadarsa,
                'admission_range'               =>   $range,
                'admission_laststudied'         =>   $laststudied,
                'admission_nameofmadarsa'       =>   $madarsaname,
                'admission_schoolname'          =>   $schoolname,
                'admission_medium'              =>   $medium,
                'admission_identification'      =>   $identification,
                'admission_photo'               =>   $picture,
                'admission_application_no'      =>   $record,
                'admission_datetime'            =>   $datetime,
                'admission_date'                =>    $date,
                'admission_institute_examcenter'=>   $admission_institute_examcenter,
                );
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $this->session->set_userdata(array(
                'admission_mobile'         => $mobile,
                'admission_name'           => $uname,
                'admission_form_status'    => 0
                ));
                
                
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
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $ui_table               =  "set_entrance_uidesign";
                $ui_condition           =  array('reg_id'=>$studid);
                $data['ui_tables']      =   $this->Entranceadmission_model->list_valuedata($ui_table,$ui_condition);
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                
                $reg_phone=$this->session->userdata['reg_phone'];
                $paragraph       = "*Jamia Jalaliyya Entrance Examination 2024.*";
                $message         = "*STEP-1 COMPLETED SUCCESSFULLY*
                You have successfully completed Step 1 *Application*. Now, please proceed to complete Step 2, *Fee Payment*.
നിങ്ങള്‍ ഘട്ടം-1     *Application*  വിജയകരമായി പൂര്‍ത്തീകരിച്ചിരിക്കുന്നു. ഘട്ടം-2 *Fee Payment* എന്ന ഐക്കണില്‍ ക്ലിക്ക് ചെയ്ത് ഘട്ടം-2 പൂര്‍ത്തീകരിക്കാവുന്നതാണ്.";

               
               
            $formated_message     = "{$paragraph}\n{$message}";
            $data['mobileno']     = $reg_phone; 
                
                // $this->mailsmsconf->online_sms('application_form', $data);
              
            $session = $data['entrance_current_session']['session']; 
            $sessionyear = explode("-", $session)[0];
            
                
            if ($data['mobileno'][0] != '+') 
            {
            $phone_no = '+' . $data['mobileno']; 
            } 
            
            
            // $jwt_token              = $this->mailsmsconf->authenticate_with_rml();
            
            // if (!$jwt_token) 
            // {
            // $this->session->set_flashdata('failed', 'Authentication failed with RML Connect');
            // redirect($_SERVER['HTTP_REFERER']);
            // return;
            // }
            
            // $token_data  = json_decode($jwt_token, true);
            // $jwt_auth    = $token_data['JWTAUTH'];
            
            // // Split the JWT token into three parts: header, payload, and signature
            // $token_parts = explode('.', $jwt_auth);
            
            // // Decode the payload from Base64
            // $payload = base64_decode(str_replace(['-', '_'], ['+', '/'], $token_parts[1]));
            
            // // Convert the payload JSON string into a PHP array
            // $token_data = json_decode($payload, true);
            
            // // Extract the expiration (exp) and issued-at (orig_iat) fields
            // $expires_at = $token_data['exp']; // Expiration timestamp
            // $orig_iat   = $token_data['orig_iat']; // Original issued-at timestamp
            
            // // Convert timestamps to human-readable format
            // $expires_at_date = date('Y-m-d H:i:s', $expires_at);
            // $orig_iat_date = date('Y-m-d H:i:s', $orig_iat);
            
            // // Get the current timestamp
            // $current_time = time();
            
            // // Check if the token already exists in the database
            
            // $this->db->select('*')->from('auth_tokens');
            // $query = $this->db->get();
            
            // if ($query->num_rows() > 0) 
            // {
            // // Token exists, check if it has expired
            // $token_record = $query->row();
            // $token_expires_at = strtotime($token_record->expires_at); // Convert DB date to timestamp
            
            // if ($token_expires_at < $current_time) 
            // {
            // // Token is expired, generate a new one
            // $new_jwt_token =  $this->mailsmsconf->authenticate_with_rml(); 
            // if ($new_jwt_token) {
            // $new_token_data = json_decode($new_jwt_token, true);
            // $new_jwt_auth = $new_token_data['JWTAUTH'];
            
            // // Decode new token payload
            // $new_token_parts = explode('.', $new_jwt_auth);
            // $new_payload = base64_decode(str_replace(['-', '_'], ['+', '/'], $new_token_parts[1]));
            // $new_token_data = json_decode($new_payload, true);
            
            // // Extract new expiration and issued-at fields
            // $new_expires_at_date = date('Y-m-d H:i:s', $new_token_data['exp']);
            // $new_orig_iat_date = date('Y-m-d H:i:s', $new_token_data['orig_iat']);
            
            // // Update the expired token with the new one
            // $auth_data = array(
            // 'jwt_token'  => $new_jwt_auth,
            // 'created_at' => $new_orig_iat_date,
            // 'expires_at' => $new_expires_at_date,
            // );
            
            // $this->db->update('auth_tokens', $auth_data);
            // echo "Token Updated Successfully!";
            // } else {
            // echo "Failed to Generate New Token.";
            // }
            // } else {
            // echo "Token is still valid, no update needed.";
            // }
            // } else {
            // // No token found, insert a new one
            // $auth_data = array(
            // 'jwt_token'  => $jwt_auth,
            // 'created_at' => $orig_iat_date,
            // 'expires_at' => $expires_at_date,
            // );
            
            // $this->db->insert('auth_tokens', $auth_data);
            // echo "New Token Inserted Successfully!";
            // }
            
            
            
            // $this->db->select('jwt_token')->from('auth_tokens');
            // $query = $this->db->get();
            
            // if ($query->num_rows() > 0)
            // {
            // $token_record = $query->row();
            
            // $jwt_token = $token_record->jwt_token;
            // } 
            
            // else 
            // {
            // // Handle case if no token found (though you already inserted one earlier)
            // echo "No JWT token found.";
            // return;
            // }
            
            
            // $url = "https://apis.rmlconnect.net/wba/v1/messages";
            // $headers = [
            // "Authorization:  $jwt_token",
            // "Content-Type: application/json"
            // ];
            
            // $template_name = 'application_form';  
            // $lang_code = 'ml'; 
            // $data = [
            // 'phone' => $phone_no,
            // 'enable_acculync' => true,
            // 'media' => [
            // 'type' => 'media_template',
            // 'lang_code' => $lang_code,
            // 'template_name' => $template_name,
            // 'body'  => [
            // [
            // 'text' => $sessionyear 
            // ],
            // [
            // 'text' => $sessionyear  
            // ]
            // ]
            // ]
            // ];
            // $data_json  = json_encode($data);
            
            // // Initialize cURL
            // $ch         = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            // curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable debugging
            
            // // Execute cURL request
            // $response   = curl_exec($ch);
            // $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // $error      = curl_error($ch);
            // curl_close($ch);
            
            
            
            
            $type="media_template";
            $lang_code="ml";
            $template_name='application_form';
            $text=[$session,$session];
            $this->Entranceadmission_model->getauth($phone_no,$type,$lang_code,$template_name,$text);
            
                // $this->smsgateway->sendWhatsAppSMS($reg_phone,$formated_message);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$adata);
                //$this->load->view('entrance/admissionform/admission_form_second',$data);
                $this->load->view('entrance/ui/ui_tables',$data);
                $this->load->view('entrance/layout/footer');
                } 
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
               
               
                
            
                
                
                
                
                
                
               /* 
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
                
                */
                
                
                /*
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
                
                */
                
                public function admission_form_four()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid                 =   $this->session->userdata['session_studid'];
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
                
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
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
                $this->load->view('entrance/layout/caraosalheader',$data);
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
               
               
               
               
                public function edit_application()
                {
                if(isset($_POST['editconfirm']))
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $this->load->library('form_validation');
                $this->load->library('session');
                
                
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid);
               // $data['admission']    =    $this->Entranceadmission_model->list_valuedata($table,$condition);
                //$data['statelist']    =    $this->Entranceadmission_model->list_data($table,$condition);
                
               
                $data['admission']      =    $this->Entranceexam_model->list_admission_applicants($studid);
                
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $data['check_address']  =    $this->Entranceadmission_model->check_address($studid);
                 
                // $data['entrance_current_session']=  $this->Entrance_settings_model->get_entrance_settings();
                    
                $this->db->where(array('reg_id' => $studid));      
                $q 		               = $this->db->get('set_entrance_uidesign');
                if ($q->num_rows() > 0) 
                {
                $dato = array(
                    'ui_finalise'=>1); 
                $this->db->where('reg_id',$studid);   
                $this->db->update('set_entrance_uidesign',$dato);
                }
                else
                {
                $setui = array(               
                    'reg_id'=>$studid,
                    'ui_finalise'=>1);
                $this->db->insert('set_entrance_uidesign',$setui);
                }
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                
                $reg_phone       =  $this->session->userdata['reg_phone'];
                $paragraph       = "*Jamia Jalaliyya Entrance Examination-2024*";
                $message         =  "*YOU HAVE SUCCESSFULLY COMPLETED.*";
                
                $details="You have successfully completed the *Jamia Jalaliyya Entrance Examination Application 2024*. Now You can print your application form from the Print Application icon. "; 
                
    $list="*ജാമിഅ ജലാലിയ്യയുടെ ജലാലി* കോഴ്‌സ് എന്‍ട്രന്‍സ് എക്‌സാമിനുള്ള അപേക്ഷ നടപടികള്‍ നിങ്ങള്‍ വിജയകരമായി പൂര്‍ത്തീകരിച്ചിരിക്കുന്നു. *Print Application* എന്ന ഐക്കണില്‍ നിന്ന് നിങ്ങളുടെ അപേക്ഷ നിങ്ങള്‍ക്ക് ഡൗണ്‍ലോഡ് ചെയ്യാവുന്നതാണ്.
               ";
                $formated_message="{$paragraph}\n{$message}\n{$details}\n{$list}";
                
                $this->smsgateway->sendWhatsAppSMS($reg_phone,$formated_message);
                
                $data['getstud']                    =    $this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']                  =    $this->Entranceadmission_model->getcourse($studid);
                $ui_table                           =    "set_entrance_uidesign";
                $ui_condition                       =    array('reg_id'=>$studid);
                $data['ui_tables']                  =    $this->Entranceadmission_model->list_valuedata($ui_table,$ui_condition);
                $data['entrance_current_session']   =    $this->Entrance_settings_model->get_entrance_settings();
                
                $data['entrance_current_session']   =    $this->Entrance_settings_model->get_entrance_settings();
                $cursess                            =    $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =    $this->Entrance_settings_model->get_phase($cursess);
                $get_phase                          =    $data['get_phase']; 
                $get_phase_value                    =    $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                $data['centerlist_bysession']       =    $this->Entranceadmission_model->centerlist_bysession($selectedcourse,$data['entrance_current_session']['cur_session'],$get_phase_value);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/ui/ui_tables',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                if(isset($_POST['edit']))
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid=$this->session->userdata['session_studid'];
                $data['check_address'] =   $this->Entranceadmission_model->check_address($studid);
                $this->load->library('form_validation');
                $this->load->library('session');
                
                $cond                 =    array('state_status'=>1); 
                $tab                  =    "state_list";
                $table                =    "admission_form_tbl";
                $condition            =     array('admission_application_registerid'=>$studid);
                $data['admission']    =     $this->Entranceadmission_model->list_valuedata($table,$condition);
                $data['statelist']    =     $this->Entranceadmission_model->list_data($tab,$cond);
                $con                  =     array('admission_application_registerid'=>$studid);
                $data['admission_list']=    $this->Entranceadmission_model->list_valuedata($table,$con);
                
                $this->form_validation->set_rules('admission_name', 'Admission Name', 'required');
                $this->form_validation->set_rules('admission_housename', 'House Name', 'required');
                $this->form_validation->set_rules('admission_fathername', 'Father Name', 'required');
                $this->form_validation->set_rules('admission_fatheroccupation', 'Father Occupation', 'required');
                $this->form_validation->set_rules('admission_address', 'Address', 'required');
                $this->form_validation->set_rules('admission_mothername', 'Mother Name', 'required');
               // $this->form_validation->set_rules('admission_photo', 'Photo', 'required');
                // $this->form_validation->set_rules('admission_dob', 'Date Of Birth', 'required');
                // $this->form_validation->set_rules('admission_motherhousename', 'Mother House', 'required');
                // $this->form_validation->set_rules('admission_adharno', 'Adharno', 'required');
                // $this->form_validation->set_rules('admission_thaluk', 'Thaluk', 'required');
                // $this->form_validation->set_rules('admission_village', 'Village', 'required');
                // $this->form_validation->set_rules('admission_mahallu', 'Mahallu', 'required');
                // $this->form_validation->set_rules('admission_district', 'District', 'required');
                // $this->form_validation->set_rules('admission_state', 'State', 'required');
                // $this->form_validation->set_rules('admission_iforphan', 'If_orphan', 'required');
                // $this->form_validation->set_rules('admission_laststudiedmadarsa', 'Last Studied Madrasa', 'required');
                // $this->form_validation->set_rules('admission_range', 'Admission Range', 'required');
                // $this->form_validation->set_rules('admission_laststudied', 'Last Studied ', 'required');
                // $this->form_validation->set_rules('admission_schoolname', 'School Name', 'required');
                
                // $this->form_validation->set_rules('admission_medium', 'Medium', 'required');
                $this->form_validation->set_rules('admission_identification', 'Identification', 'required');
                $data['getstud']                   =    $this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']                 =    $this->Entranceadmission_model->getcourse($studid); 
                $data['entrance_current_session']  =    $this->Entrance_settings_model->get_entrance_settings();
               
                if ($this->form_validation->run() == FALSE) 
                {
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader');
                $this->load->view('entrance/admissionform/ui_admission_form_payment',$data);
                $this->load->view('entrance/layout/footer');
                }
                else 
                {
                $admission_name                =    $this->input->post('admission_name');
                $admission_housename           =    $this->input->post('admission_housename');
                $admission_fathername          =    $this->input->post('admission_fathername');
                $admission_fatheroccupation    =    $this->input->post('admission_fatheroccupation');
                $admission_address             =    $this->input->post('admission_address');
                $admission_mothername          =    $this->input->post('admission_mothername');
                $admission_dob                 =    $this->input->post('admission_dob');
                $admission_guardian            =    $this->input->post('guardian');
                $admission_relationship        =    $this->input->post('relationship');
                $admission_phoneno             =    $this->input->post('phoneno');
                $admission_guardianaddress     =    $this->input->post('admission_guardianaddress');
                $admission_nameofmadarsa       =    $this->input->post('admission_nameofmadarsa');
                $admission_motherhousename     =    $this->input->post('admission_motherhousename');
                $admission_adharno             =    $this->input->post('admission_adharno');
                $admission_thaluk              =    $this->input->post('admission_thaluk');
                $admission_village             =    $this->input->post('admission_village');
                $admission_mahallu             =    $this->input->post('admission_mahallu');
                $admission_district            =    $this->input->post('district');
                $admission_state               =    $this->input->post('admission_state');
                $admission_iforphan            =    $this->input->post('admission_iforphan');
                $admission_laststudiedmadarsa  =    $this->input->post('admission_laststudiedmadarsa');
                $admission_range               =    $this->input->post('admission_range');
                $admission_laststudied         =    $this->input->post('admission_laststudied');
                $admission_schoolname          =    $this->input->post('admission_schoolname');
                $admission_medium              =    $this->input->post('admission_medium');
                $admission_identification      =    $this->input->post('admission_identification');
                $admission_institute_examcenter=    $this->input->post('examcenter');
                $Major_Books_Studied           =    $this->input->post('Major_Books_Studied');
                $Name_Prominent_Teacher	       =    $this->input->post('Name_Prominent_Teacher');
                $years_completed               =    $this->input->post('years_completed');
                $Repitition_Completed          =    $this->input->post('Repitition_Completed');
                $General_Education             =    $this->input->post('General_Education');
                $General_Education_mutawal     =    $this->input->post('General_Education_mutawal');
                $PlaceOf_Institution           =    $this->input->post('PlaceOf_Institution');
                $Medium_of_questionpaper       =    $this->input->post('Medium_of_questionpaper');
                $ad_check_address              =    $this->input->post('sameasabove');
                $db                            =    date("d-M-Y", strtotime($admission_dob)); 
                $last_studied_institute        =    $this->input->post('last_studied_institute');
                
                $this->db->where(array('ad_reg_id' => $studid));
                $q 	= $this->db->get('admission_form_details');
                if ($q->num_rows() > 0) 
                {
                $dati = array(
                'ad_check_address'         => $ad_check_address,
                'last_studied_institute'   => $last_studied_institute,
                'Major_Books_Studied'      => $Major_Books_Studied	,
                'Name_Prominent_Teacher'   => $Name_Prominent_Teacher,
                'years_completed'          => $years_completed,
                'Repitition_Completed'     => $Repitition_Completed,
                'PlaceOf_Institution'      => $PlaceOf_Institution,
                'Medium_of_questionpaper'  => $Medium_of_questionpaper,
                'General_Education'        => $General_Education,
                'General_Education_mutawal'=> $General_Education_mutawal,
                ); 
                $this->db->where(array('ad_reg_id'=>$studid));    
                $this->db->update('admission_form_details',$dati);
                }
                else
                {
               $ad_details = array(               
                'ad_reg_id'                => $studid,
                'ad_check_address'         => $ad_check_address,
                'last_studied_institute'   => $last_studied_institute,
                'Major_Books_Studied'      => $Major_Books_Studied	,
                'Name_Prominent_Teacher'   => $Name_Prominent_Teacher,
                'years_completed'          => $years_completed,
                'Repitition_Completed'     => $Repitition_Completed,
                'General_Education'        => $General_Education,
                'General_Education_mutawal'=> $General_Education_mutawal,
                'PlaceOf_Institution'      => $PlaceOf_Institution,
                'Medium_of_questionpaper'  => $Medium_of_questionpaper
                );
                $this->db->insert('admission_form_details',$ad_details);
                }
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
    			$picture 			            = 	$this->input->post('pict');
    			}
                $data                           =     array(
                'admission_name'                =>   $admission_name,
                'admission_fathername'          =>   $admission_fathername,
                'admission_housename'           =>   $admission_housename,
                'admission_fatheroccupation'    =>   $admission_fatheroccupation,
                'admission_mothername'          =>   $admission_mothername,
                'admission_motherhousename'     =>   $admission_motherhousename,
                'admission_address'             =>   $admission_address,
                'admission_adharno'             =>   $admission_adharno,
                'admission_dob'                 =>   $db,
                'admission_state'               =>   $admission_state,
                'admission_district'            =>   $admission_district,
                'admission_thaluk'              =>   $admission_thaluk,
                'admission_village'             =>   $admission_village,
                'admission_mahallu'             =>   $admission_mahallu,
                'admission_iforphan'            =>   $admission_iforphan,
                'admission_guardian'            =>   $admission_guardian,
                'admission_relationship'        =>   $admission_relationship,
                'admission_phoneno'             =>   $admission_phoneno,
                'admission_guardianaddress'     =>   $admission_guardianaddress,
                'admission_laststudiedmadarsa'  =>   $admission_laststudiedmadarsa,
                'admission_range'               =>   $admission_range,
                'admission_laststudied'         =>   $admission_laststudied,
                'admission_nameofmadarsa'       =>   $admission_nameofmadarsa,
                'admission_schoolname'          =>   $admission_schoolname,
                'admission_medium'              =>   $admission_medium,
                'admission_identification'      =>   $admission_identification,
                'admission_institute_examcenter'=>   $admission_institute_examcenter,
                'admission_photo'               =>   $picture,
                );
                
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $ui_table               =    "set_entrance_uidesign";
                $ui_condition           =    array('reg_id'=>$studid);
                
                $data['ui_tables']      =    $this->Entranceadmission_model->list_valuedata($ui_table,$ui_condition);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' .'Updated Successfully' . '</div>');
                redirect($_SERVER['HTTP_REFERER']);
                return;
                } 
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                }
                
                
                
                
                public function confirm_application()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $studid                 =    $this->session->userdata['session_studid'];
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid);
                
                $data['admission_list']      =    $this->Entranceadmission_model->list_valuedata($table,$condition);
               
              
                
                $data['admission']      =    $this->Entranceadmission_model->get_admission_list($studid);
                
                $feetable               =   "fees_entrancepayment";
                $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =   $data['fee_details'];
                
                $this->load->library('form_validation');
                $data['getstud']        =     $this->Entranceadmission_model->getdataexists($studid);   
                $data['centre']         =     $this->Entranceadmission_model->centrelist($studid);
                $data['institute']      =     $this->Entranceadmission_model->institutelist($studid);
                $data['getcourse']      =     $this->Entranceadmission_model->getcourse($studid);
                
                $feetable               =     "fees_entrancepayment";
                $feecondition           =      array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =      $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $data['entrance_current_session']=  $this->Entrance_settings_model->get_entrance_settings();
                
                $condition              =    array('state_status'=>1); 
                $table                  =    "state_list";
                $data['statelist']      =    $this->Entranceadmission_model->list_data($table,$condition);
                
                //if ($this->form_validation->run() == FALSE) 
                //{  
                // $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid);   
                // $data['centre']=$this->Entranceadmission_model->centrelist($studid);
                // $data['institute']=$this->Entranceadmission_model->institutelist($studid);
                // $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                
                // $feetable               =   "fees_entrancepayment";
                // $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                // $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                
                // $this->load->view('entrance/layout/header',$data);
                // $this->load->view('entrance/layout/caraosalheader');
                // $this->load->view('entrance/admissionform/admission_form_photo',$data);
                // $this->load->view('entrance/layout/footer');
               // } 
               // else 
               // { 
                
                $mobile                 =    $this->session->userdata('admission_mobile');
                $uname                  =    $this->session->userdata('admission_name');
                $studid                 =    $this->session->userdata['session_studid'];
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid); 
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid); 
                $data['application_no'] =    $this->Entranceadmission_model->max_application_no();
                $application            =    $data['application_no'];
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
                
               
               // $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                
                $application_no=array();
                $ta                    = "entranceexamimage";
                
                $con                   = array('img_status'=>1);
                
                $data['pdfimage']      = $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                $feetable              =   "fees_entrancepayment";
                $feecondition          =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']   =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $data['check_address'] =   $this->Entranceadmission_model->check_address($studid);
               
                $data['entrance_current_session']   =  $this->Entrance_settings_model->get_entrance_settings();
                $cursess                            =  $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =  $this->Entrance_settings_model->get_phase($cursess);
                $get_phase                          =  $data['get_phase']; 
                $get_phase_value                    =  $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                $data['entrance_current_session']   =     $this->Entrance_settings_model->get_entrance_settings();
                $data['centerlist_bysession']       =     $this->Entranceadmission_model->centerlist_bysession($data['admission_list']['admission_application_selectedcourse'],$data['entrance_current_session']['cur_session'],$get_phase_value);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/admissionform/ui_admission_form_payment',$data);
                $this->load->view('entrance/layout/footer');
                //}
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                } 
                
                
                
                
                // public function update_admission_form_secondary()
                // { 
                // if(isset($this->session->userdata['logged_in']))
                // {
                // $studid=$this->session->userdata['session_studid'];
                
                // $feetable               =   "fees_entrancepayment";
                // $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                // $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                // $feedetails             =   $data['fee_details'];
                
                // $this->load->library('form_validation');
                // $this->form_validation->set_rules('institute_optionone', 'Option 1', 'required');
                // $this->form_validation->set_rules('institute_optiontwo', 'Option 2', 'required');
                // $this->form_validation->set_rules('institute_optionthree', 'Option 3', 'required');
                // $this->form_validation->set_rules('examcenter', 'Exam Center', 'required');
                // $institute_optionone     =   $this->input->post('institute_optionone');
                // $institute_optiontwo     =   $this->input->post('institute_optiontwo');
                // $institute_optionthree   =   $this->input->post('institute_optionthree');
                // $examcenter              =   $this->input->post('examcenter');
                //  $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                // if ($this->form_validation->run() == FALSE) 
                // {  
                // $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid);   
                // $data['centre']         =    $this->Entranceadmission_model->centrelist($studid);
                // $data['institute']      =    $this->Entranceadmission_model->institutelist($studid);
                // $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                // $feetable               =    "fees_entrancepayment";
                // $feecondition           =    array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                // $data['fee_details']    =    $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                
                
                // $this->load->view('entrance/layout/header',$data);
                // $this->load->view('entrance/layout/caraosalheader',$data);
                // $this->load->view('entrance/admissionform/admission_form_photo',$data);
                // $this->load->view('entrance/layout/footer');
                // } 
                // else 
                // { 
                
                // $mobile=$this->session->userdata('admission_mobile');
                // $uname= $this->session->userdata('admission_name');
                // $studid=$this->session->userdata['session_studid']; 
                // $table       =    "admission_form_tbl";
                // $condition   =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                // $data        =     array('admission_institute_optionone'  =>   $institute_optionone,
                // 'admission_institute_optiontwo'         =>   $institute_optiontwo,
                // 'admission_institute_optionthree'  =>   $institute_optionthree,
                // 'admission_institute_examcenter'        =>   $examcenter );
                // $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                
                // $data['getstud'] =$this->Entranceadmission_model->getdataexists($studid); 
                // $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid); 
                
                // $data['application_no']= $this->Entranceadmission_model->max_application_no();
                // $application=$data['application_no'];
                
                // foreach($application as $ch)
                // {
                // if($ch=="")
                // {
                // $record="1001";
                // }
                // else
                // {
                // $rec= explode(',',$ch);
                // $record= $rec[0]+1;
                // }            
                // }
                
                // $datetime=date('Y-m-d H:i:s');
                // $date=date('d-M-Y');
                
                
                
                // $table          =    "admission_form_tbl";
                // $condition      =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                // $data           =    array('admission_form_status'=>0,'admission_application_no'=>$record,'admission_datetime'=>$datetime,'admission_date'=>$date);
                
                // $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                
                // $application_no=array();
                
                // $data['admission']=$this->Entranceadmission_model->list_valuedata($table,$condition);
                
                
                // $ta                    = "entranceexamimage";
                
                // $con                   = array('img_status'=>1);
                
                // $data['pdfimage']      = $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                
                
                // $feetable               =   "fees_entrancepayment";
                // $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                // $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                // $this->load->view('entrance/layout/header',$data);
                // $this->load->view('entrance/layout/caraosalheader',$data);
                // $this->load->view('entrance/admissionform/admission_form_payment');
                // $this->load->view('entrance/layout/footer');
                // }
                
                // }
                // else
                // {
                // $this->load->view('entrance/404_page');
                // }
                // }
                
                
                
                public function get_institution()
                {  
                if(isset($this->session->userdata['logged_in']))
                {
                $studid                 =    $this->session->userdata['session_studid'];
                $this->load->library('form_validation');
                $this->form_validation->set_rules('institute_optionone', 'Option 1', 'required');
                $this->form_validation->set_rules('institute_optiontwo', 'Option 2', 'required');
                $this->form_validation->set_rules('institute_optionthree', 'Option 3', 'required');
                $this->form_validation->set_rules('examcenter', 'Exam Center', 'required');
                $institute_optionone     =   $this->input->post('institute_optionone');
                $institute_optiontwo     =   $this->input->post('institute_optiontwo');
                $institute_optionthree   =   $this->input->post('institute_optionthree');
                $examcenter              =   $this->input->post('examcenter');
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                $data['centre']         =    $this->Entranceadmission_model->centrelist($studid);
                $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid); 
                $data['institute']      =    $this->Entranceadmission_model->institutelist($studid);
                $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                $feetable               =    "fees_entrancepayment";
                $feecondition           =    array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =    $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
              
               
                if ($this->form_validation->run() == FALSE) 
                {
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/admissionform/admission_form_photo',$data);
                $this->load->view('entrance/layout/footer');
                } 
                else 
                {
                $mobile=$this->session->userdata('admission_mobile');
                $uname= $this->session->userdata('admission_name');
                $studid=$this->session->userdata['session_studid'];
                $table       =    "admission_form_tbl";
                $condition   =     array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                $data        =     array('admission_institute_optionone'  =>   $institute_optionone,
                'admission_institute_optiontwo'         =>   $institute_optiontwo,
                'admission_institute_optionthree'       =>   $institute_optionthree,
                'admission_institute_examcenter'        =>   $examcenter );
                $this->Entranceadmission_model->updte_value($table,$data,$condition); 
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/admissionform/admission_form_photo',$data);
                $this->load->view('entrance/layout/footer');    
                }
                
                
                // $mobile=$this->session->userdata('admission_mobile');
                // $uname= $this->session->userdata('admission_name');
                // $studid=$this->session->userdata['session_studid']; 
                // $table       =    "admission_form_tbl";
                // $condition   =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                
                // $data        =     array('admission_institute_optionone'  =>   $institute_optionone,
                // 'admission_institute_optiontwo'         =>   $institute_optiontwo,
                // 'admission_institute_optionthree'       =>   $institute_optionthree,
                // 'admission_institute_examcenter'        =>   $examcenter );
                // $this->Entranceadmission_model->updte_value($table,$data,$condition);
                // $data['getstud']        =    $this->Entranceadmission_model->getdataexists($studid); 
                // $data['getcourse']      =    $this->Entranceadmission_model->getcourse($studid);
                // $data['application_no'] =    $this->Entranceadmission_model->max_application_no();
                // $application            =    $data['application_no'];
                
                // $table          =    "admission_form_tbl";
                // $condition      =    array('admission_application_registerid'=>$studid,'admission_form_status'=>0);
                // $data           =    array('admission_form_status'=>0,'admission_application_no'=>$record,'admission_datetime'=>$datetime,'admission_date'=>$date);
                
                // $this->Entranceadmission_model->updte_value($table,$data,$condition);
                // $application_no=array();
                
                // $data['admission']     = $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                
                // $ta                    = "entranceexamimage";
                
                // $con                   = array('img_status'=>1);
                
                // // $data['pdfimage']      = $this->Entranceadmission_model->list_valuedata($ta,$con);
                // // $feetable               =   "fees_entrancepayment";
                // // $feecondition           =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                // // $data['fee_details']    =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                // $this->load->view('entrance/layout/header',$data);
                // $this->load->view('entrance/layout/caraosalheader',$data);
                // $this->load->view('entrance/admissionform/admission_form_payment');
                // $this->load->view('entrance/layout/footer');
                // }
                
                // }
                // else
                // {
                // $this->load->view('entrance/404_page');
                }
                }
                
                
                public function update_center()
                {
                $institute_optionone     =   $this->input->post('institute_optionone');
                $institute_optiontwo     =   $this->input->post('institute_optiontwo');
                $institute_optionthree   =   $this->input->post('institute_optionthree');
                $examcenter              =   $this->input->post('examcenter');    
                $studid                  =   $this->session->userdata['session_studid'];
                $table                   =   "admission_form_tbl";
                $condition               =   array('admission_application_registerid'=> $studid,'admission_form_status'=>0);
                $data                    =   array('admission_institute_optionone'   => $institute_optionone,
                'admission_institute_optiontwo'         =>   $institute_optiontwo,
                'admission_institute_optionthree'       =>   $institute_optionthree,
                'admission_institute_examcenter'        =>   $examcenter );
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' .'Updated Successfully' . '</div>');
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                redirect($_SERVER['HTTP_REFERER']);
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
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
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
                if (!empty($this->session->userdata('logged_in')))
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
               
                $ta                     =   "entranceexamimage";
                $con                    =   array('img_status'=>1);
                $data['pdfimage']       =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                $data['courses']        =   $this->Entranceadmission_model->getcourse($studid);
                
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
                
                $this->db->where(array('ad_reg_id' => $studid, 'barcode' => ""));
                $qu =$this->db->get('admission_form_details');
                
                if ($qu->num_rows() > 0) 
                {
                $datval           =   $qu->row_array(); 
                $ad_reg_id        =   $datval['ad_reg_id'];
                
                $this->zend->load('Zend/Barcode');
                $imageResource   =  Zend_Barcode::factory('EAN13', 'image', array('text'=>$ad_reg_id), array())->draw();
                $path            =  imagepng($imageResource, 'entrance/barcode/'.$ad_reg_id.'.png');
                
                $data['barcode'] = 'entrance/barcode/'.$ad_reg_id.'.png';
                $barcode         =  $data['barcode'];
                
                $data            =  array('barcode'  =>  'entrance/barcode/'.$ad_reg_id.'.png' );
                $this->db->where(array('ad_reg_id'=>$ad_reg_id));
                $this->db->update('admission_form_details', $data);
                }
                
                $data['admission']       =     $this->Entranceadmission_model->getstudents($studid);
                $data['check_address']   =     $this->Entranceadmission_model->check_address($studid);
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admission_form',$data,true);

                // print_r($html_content);
                // $this->pdf->loadHtml($html_content);
                // $this->pdf->set_option('isRemoteEnabled', true);
                // $this->pdf->render();
                // $this->pdf->stream(""."AdmissionForm".".pdf", array("Attachment"=>0));

                @ob_end_clean();
                ob_start();

                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream("AdmissionForm.pdf", array("Attachment" => 0));

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
                $data['parameters']                 =    file_get_contents(APPPATH . 'views/entrance/payment_store/parameters.json');
                $studid                             =    $this->session->userdata['session_studid'];
                $data['getcourse']                  =    $this->Entranceadmission_model->getcourse($studid);
                $feetable                           =    "fees_entrancepayment";
                $feecondition                       =    array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']                =    $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $feedetails                         =    $data['fee_details'];
                $mobile                             =    $this->session->userdata('admission_mobile');
                $uname                              =    $this->session->userdata('admission_name');
                $data['entrance_current_session']   =    $this->Entrance_settings_model->get_entrance_settings();
                
                $tab                                =    "admission_form_tbl";
                $con                                =     array('admission_application_registerid'=>$studid);
                $data['regid']                      =     $this->Entranceadmission_model->list_valuedata($tab,$con);
                
                $data['entrance_current_session']   =     $this->Entrance_settings_model->get_entrance_settings();
                
                $cursess                            =     $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =     $this->Entrance_settings_model->get_phase($cursess);
                
                $get_phase                          =     $data['get_phase']; 
                $get_phase_value                    =     $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                $selectedcourse                     =     $data['getcourse']['admission_application_selectedcourse'];              


                $data['get_fees']                   =     $this->Entranceadmission_model->get_phase($cursess,$get_phase_value,$selectedcourse);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/admissionform/admission_paynow',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                public function paynow_new()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                $data['parameters']                 =    file_get_contents(APPPATH . 'views/entrance/payment_store/parameters.json');
                $studid                             =    $this->session->userdata['session_studid'];
                $data['getcourse']                  =    $this->Entranceadmission_model->getcourse($studid);
                $feetable                           =    "fees_entrancepayment";
                $feecondition                       =    array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']                =    $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $feedetails                         =    $data['fee_details'];
                $mobile                             =    $this->session->userdata('admission_mobile');
                $uname                              =    $this->session->userdata('admission_name');
                $data['entrance_current_session']   =    $this->Entrance_settings_model->get_entrance_settings();
                
                $tab                                =     "admission_form_tbl";
                $con                                =     array('admission_application_registerid'=>$studid);
                $data['regid']                      =     $this->Entranceadmission_model->list_valuedata($tab,$con);
                
                $data['entrance_current_session']   =     $this->Entrance_settings_model->get_entrance_settings();
                
                $cursess                            =     $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =     $this->Entrance_settings_model->get_phase($cursess);
                $get_phase                          =     $data['get_phase']; 
                $get_phase_value                    =     $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                $selectedcourse                     =     $data['getcourse']['admission_application_selectedcourse'];
                
                $data['get_fees']                   =     $this->Entranceadmission_model->get_phase($cursess,$get_phase_value,$selectedcourse);
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/admissionform_new',$data);
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
                date_default_timezone_set('Asia/Kolkata');    
                $data['parameters']                =   file_get_contents(APPPATH . 'views/entrance/payment_store/parameters.json');
                $studid                            =   $this->session->userdata['session_studid'];
                $data['getcourse']                 =   $this->Entranceadmission_model->getcourse($studid);
                // $data['amount']                    =   $this->input->post('amount');
                $feetable                          =   "fees_entrancepayment";
                
                $feecondition                      =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']               =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                
                $tab                               =  "admission_form_tbl";
                $con                               =   array('admission_application_registerid'=>$studid);
                $data['regid']                     =   $this->Entranceadmission_model->list_valuedata($tab,$con);
                $data['entrance_current_session']  =   $this->Entrance_settings_model->get_entrance_settings();
                $data['studid']                    =   $studid;
                
                $data['totalamt']                  =   $this->input->post('amount');
                $data['admission_range']           =   $this->input->post('admission_range');
                $data['admission_application_no']  =   $this->input->post('admission_application_no');
                $data['session_studid']            =   $this->input->post('session_studid');
                $data['ayear']                     =   $this->input->post('ayear');
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/payment_store/techprocess',$data);
                $this->load->view('entrance/layout/footer');
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                public function response()
                {
                if(isset($this->session->userdata['logged_in']))
                {
                date_default_timezone_set('Asia/Kolkata');    
                $data['parameters']                 = file_get_contents(APPPATH . 'views/entrance/payment_store/parameters.json');
                $data['totalamt']                   = $this->input->post('amount');
                $data['studid']                     = $this->input->post('studid');
                $data['year']                       = $this->input->post('year');
                $data['admission_range']            = $this->input->post('admission_range');
                $data['admission_application_no']   = $this->input->post('admission_application_no');
                $studid                             = $this->session->userdata['session_studid'];
                $data['entrance_current_session']   = $this->Entrance_settings_model->get_entrance_settings();
                $ses                                = $data['entrance_current_session']['session'];
                $data['sessionyear']                = explode("-",  $ses)[0];
                
                
                $this->db->where('entrance_reg_id', $studid);
                $query = $this->db->get('entrance_examregister');
                $data['result'] = $query->result(); 
                
                $data['getcourse']                  = $this->Entranceadmission_model->getcourse($studid);
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
                $this->load->view('entrance/payment_store/response',$data);
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
                $data['getcourse']       =    $this->Entranceadmission_model->getcourse($studid);
                $amount                  =    $this->input->post('amount');
                $paise                   =    $amount*100;
                $data['orderId']         =    $this->input->post('orderId');
                $data['responseUrl']     =    $this->input->post('responseUrl');
                $data['amount']          =    $paise;
                $data['meTransReqType']  =    $this->input->post('meTransReqType');
                $data['currencyName']    =    $this->input->post('currencyName');
                $data['mid']             =    $this->input->post('mid');
                $data['enckey']          =    $this->input->post('enckey');
                $data['recurPeriod']     =    $this->input->post('recurPeriod');
                $data['numberRecurring'] =    $this->input->post('numberRecurring');
                $data['recurDay']        =    $this->input->post('recurDay');
                $data['addField1']       =    $this->input->post('addField1');
                $data['addField2']       =    $this->input->post('addField2');
                $data['addField3']       =    $this->input->post('addField3');
                $data['addField4']       =    $this->input->post('addField4');
                $data['addField5']       =    $this->input->post('addField5');
                $data['addField6']       =    $this->input->post('addField6');
                $data['addField7']       =    $this->input->post('addField7');
                $data['addField8']       =    $this->input->post('addField8'); 
                
                $feetable                           =    "fees_entrancepayment";
                $feecondition                       =    array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']                =    $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $data['entrance_current_session']   =    $this->Entrance_settings_model->get_entrance_settings();
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
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
                $studid             =    $this->session->userdata['session_studid'];
                $txnmsg_msg         =    $this->input->post('txnmsgMsg');
                if ($txnmsg_msg === 'S') 
                {
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid); 
                $data                   =    array('admission_form_status' =>1,'admission_payment'=>'Paid');
                
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                
                $this->db->where(array('reg_id' => $studid));      
                $q 		               = $this->db->get('set_entrance_uidesign');
                
                if ($q->num_rows() > 0) 
                {
                $dato = array(
                    'ui_payment'=>1);
                $this->db->where('reg_id',$studid);    
                $this->db->update('set_entrance_uidesign',$dato);
                }
                else
                {
                $setui = array(               
                    'reg_id'=>$studid,
                    'ui_payment'=>1);
                $this->db->insert('set_entrance_uidesign',$setui);
                }
                $reg_phone       =  $this->session->userdata['reg_phone'];
                $paragraph       = "*Jamia Jalaliyya Entrance Examination- Fee Payment Successful.*";
                $message         = "Your payment of *Rs. 500* for the *Jamia Jalaliyya Entrance Examination* was successful.*Thank You*";
              $details="*STEP-2 COMPLETED SUCCESSFULLY*
You have successfully completed Step 2 *Fee Payment*. Now, please proceed to complete Step 3, *Finalize Application*. 

നിങ്ങള്‍ ഘട്ടം-2 *Fee Payment* വിജയകരമായി പൂര്‍ത്തീകരിച്ചിരിക്കുന്നു. ഘട്ടം-3 *Finalize Application* എന്ന ഐക്കണില്‍ ക്ലിക്ക് ചെയ്ത് ഘട്ടം-3 പൂര്‍ത്തീകരിക്കാവുന്നതാണ്."
              ;
               
                $formated_message="{$paragraph}\n{$message}\n{$details}";
                // $this->smsgateway->sendWhatsAppSMS($reg_phone,$formated_message);
                
                
                } 
                else 
                {
                $table                  =    "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid); 
                $data                   =    array('admission_form_status' =>1,'admission_payment'=>'Failed');
                $reg_phone              =     $this->session->userdata['reg_phone'];
                $paragraph              =    "*Jamia Jalaliyya Entrance Examination-2024*";
                $message                =    "*Fee Payment Failed.* Try Again after Some time";
                $formated_message       =    "{$paragraph}\n{$message}";
                $this->smsgateway->sendWhatsAppSMS($reg_phone,$formated_message );
                $this->Entranceadmission_model->updte_value($table,$data,$condition);
                }
                echo json_encode(['status' => $txnmsg_msg]);
                return;
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
                
                
                $feedetails                       =  $data['fee_details'];
                
                $data['paymentreceipt']           =  $this->Entranceadmission_model->getfeerecept($studid);
                $data['entrance_current_session'] =  $this->Entrance_settings_model->get_entrance_settings();
                
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
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
                $this->pdf->stream(""."Receipt".".pdf", array("Attachment"=>0));
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
                
                $feetable               =    "fees_entrancepayment";
                $feecondition           =    array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
                $data['fee_details']    =    $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
                $feedetails             =    $data['fee_details'];
                $this->load->library('pdf');
                $application_no         =    array();
                $ta                     =    "entranceexamimage";
                $con                    =    array('img_status'=>1);
                $data['pdfimage']       =    $this->Entranceadmission_model->list_valuedata($ta,$con);
                $data['paymentreceipt'] =    $this->Entranceadmission_model->getfeerecept($studid);
                $adlist                 =    $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']  =    $adlist;
                
                $exdetails              =    $this->Entranceadmission_model->getadmitcard_time($studid);
                $data['examdetails']    =    $exdetails;
                $table                  =   "admission_form_tbl";
                $condition              =    array('admission_application_registerid'=>$studid,);
                $data['admission']      =    $this->Entranceadmission_model->list_valuedata($table,$condition);
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admitcard_pdf',$data,true);
                $this->pdf->loadHtml($html_content, 'UTF-8');
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->set_option('isFontSubsettingEnabled', true);
                $this->pdf->render();
                $this->pdf->stream(""."Admitcard".".pdf", array("Attachment"=>0));
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
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
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
                $data['entrance_current_session']   =  $this->Entrance_settings_model->get_entrance_settings();
                
                $data['admit_title']                =  $data['entrance_current_session']['cur_title_admitcard'];
                
                $cursess                            =  $data['entrance_current_session']['cur_session'];
                $data['sess_val']                   =  $data['entrance_current_session']['session'];
                
                
                $studid                             =  $this->session->userdata['session_studid'];
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
                
                $data['entrance_current_session']   =  $this->Entrance_settings_model->get_entrance_settings();
                $cursess                            =  $data['entrance_current_session']['cur_session'];
                $data['get_phase']                  =  $this->Entrance_settings_model->get_phase($cursess);
                $get_phase                          =  $data['get_phase']; 
                
                
                
                $get_phase_value         =   $get_phase ? $get_phase['entrance_examgroup_id'] : 0;
                
                $application_no          =   array();
                $ta                      =   "entranceexamimage";
                $con                     =   array('img_status'=>1);
                $data['pdfimage']        =   $this->Entranceadmission_model->list_valuedata($ta,$con);
                
                $data['paymentreceipt']  =   $this->Entranceadmission_model->getfeerecept($studid);
                $adlist                  =   $this->Entranceadmission_model->examgetByregid($studid);
                $data['admissionlist']   =   $adlist;
                $exdetails               =   $this->Entranceadmission_model->getadmitcard_time($cursess,$studid,$get_phase_value);
                $data['examdetails']     =   $exdetails;
                $table                   =   "admission_form_tbl";
                $condition               =   array('admission_application_registerid'=>$studid);
                $data['admission']       =   $this->Entranceadmission_model->list_valuedata($table,$condition);
                
                
                $html_content=$this->load->view('entrance/admissionform/print_pdf/admitcard_pdf',$data,true);
                
                // $this->pdf->loadHtml($html_content);
                // $this->pdf->set_option('isRemoteEnabled', true);
                
                // $this->pdf->render();
                // $this->pdf->stream(""."Admitcard".".pdf", array("Attachment"=>0));



                  @ob_end_clean();
                ob_start();
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream("AdmissionForm.pdf", array("Attachment" => 0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
                
                
                
                
                /*public function admitcard()
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
                */
                
                
                
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
                
                
               
                // $data['publishresult']  =    $this->Entranceadmission_model->searchpublishresult($studid);
                
                $data['applicant_withcourse']       =   $this->Entranceadmission_model->applicantdetails_withcourse($studid);
                $ui_table                           =   "set_entrance_uidesign";
                $ui_condition                       =   array('reg_id'=>$studid);
                $data['ui_tables']                  =   $this->Entranceadmission_model->list_valuedata($ui_table,$ui_condition);
                $data['entrance_current_session']   =   $this->Entrance_settings_model->get_entrance_settings();
                $currententrance                    =   $data['entrance_current_session'];
                $data['entrance_ui_phaseresult']    =   $this->Entrance_settings_model->entrance_settings_phaseresult($data['ui_tables']['phasegroup'],$currententrance['cur_session'],$data['applicant_withcourse']['admission_application_selectedcourse']);    
                
                
                
                // $data['current_session']  =    $this->user_model->get_current_session();
                $data['current_session']     =    $this->Entrance_settings_model->get_entrance_settings();
                $current_session             =    $data['current_session'];
                $currentsess                 =    $current_session['cur_session'];
                //$currentsess            =    $current_session['session_id'];
                // $data['current_session']     =  $this->Entrance_settings_model->get_entrance_settings();
                // $currentsess             =   $data['current_session'];
                
               
                
                $data['subjectlist']    =    $this->Entranceadmission_model->searchSubjectlist($studid,$cousid,$currentsess);
                
                
                
                $data['subjectmarks']   =    $this->Entranceadmission_model->searchsubjectmarks($studid,$cousid,$currentsess);
                $data['examresult']     =    $this->Entranceadmission_model->searchExamResult($studid,$cousid,$currentsess);
                
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


                @ob_end_clean();
                ob_start();
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream("AdmissionForm.pdf", array("Attachment" => 0));
                
                
                // $this->pdf->loadHtml($html_content);
                // $this->pdf->set_option('isRemoteEnabled', true);
                
                // $this->pdf->render();
                // $this->pdf->stream(""."Result".".pdf", array("Attachment"=>0));
                
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
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                
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
                $this->pdf->stream(""."Ranklist".".pdf", array("Attachment"=>0));
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
                $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
                $this->load->view('entrance/layout/header',$data);
                $this->load->view('entrance/layout/caraosalheader',$data);
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
                
                ob_end_clean();
                ob_start();
                $this->pdf->loadHtml($html_content);
                $this->pdf->set_option('isRemoteEnabled', true);
                $this->pdf->render();
                $this->pdf->stream("AdmissionForm.pdf", array("Attachment" => 0));


                // $this->pdf->loadHtml($html_content);
                // $this->pdf->set_option('isRemoteEnabled', true);
                // $this->pdf->render();
                // $this->pdf->stream(""."Allotment".".pdf", array("Attachment"=>0));
                }
                else
                {
                $this->load->view('entrance/404_page');
                }
                }
                
               
            }