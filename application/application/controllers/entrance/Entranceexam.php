<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

            class Entranceexam extends CI_Controller
            {
                
            public function __construct()
            {
            parent::__construct();
            $studid=$this->session->userdata['session_studid'];
            $this->load->library('ciqrcode');
            $this->load->helper('url');
            date_default_timezone_set('Asia/Kolkata');
            $this->load->library('mailsmsconf');
            }
            
        
            public function index()
            {
            $data['entrance_current_session']=  $this->Entrance_settings_model->get_entrance_settings(); 
            $this->load->view('entrance/layout/header');
            $this->load->view('entrance/layout/banner',$data);
            $this->load->view('entrance/layout/aboutus');
            $this->load->view('entrance/layout/footer');
            }
            
            
            
            
            public function register()
            {
            $data['entrance_current_session']  =  $this->Entrance_settings_model->get_entrance_settings();
            $data['get_phase_list']            =  $this->Entrance_settings_model->get_phase_list();
            $phase_list                        =   $data['get_phase_list'];
            $this->load->view('entrance/layout/header');
            $this->load->view('entrance/layout/caraosalheader',$data);
            
            if($phase_list=="")
            {
            $this->load->view('entrance/closed');
            }
            else
            {
            $this->load->view('entrance/register');
            }
            $this->load->view('entrance/layout/footer');        
            }
            
            
            

            public function addregister()
            {
            $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings(); 
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
            
            if ($this->form_validation->run() == FALSE) 
            { 
            $this->load->view('entrance/layout/header');
            $this->load->view('entrance/layout/caraosalheader',$data);
            $this->load->view('entrance/register');
            $this->load->view('entrance/layout/footer');
            }
            else
            {
            $this->load->model('Entranceexam_model');
            $name                           =   $this->input->post('name');
            $username                       =   $this->input->post('username');
            $password                       =   $this->input->post('password');
            $email                          =   $this->input->post('email');
            $phoneno                        =   $this->input->post('phone');
           // $data['current_session']      =   $this->user_model->get_current_session();
           // $current_session              =   $data['current_session'];
            $data['current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
            $current_session                 =   $data['current_session'];
            $this->db->where('entrance_reg_username', $username);
            $query = $this->db->get('entrance_examregister');
            
            if ($query->num_rows() > 0) 
            {
            $this->session->set_flashdata('failed', 'Username already exists');
            redirect($_SERVER['HTTP_REFERER']);
            return; 
            }
            
            $admission_data = array(               
            'entrance_reg_name'            =>  $name,
            'entrance_reg_username'        =>  $username,
            'entrance_reg_password'        =>  $password,
            'entrance_reg_email'           =>  $email,
            'entrance_reg_created_date'    =>  date('Y-m-d H:i:s'),
            'entrance_reg_phone'           =>  $phoneno);
            
            $this->db->where(array('entrance_reg_username' => $username, 'entrance_reg_password' => $password));      
            $q 		    = $this->db->get('entrance_examregister');
            
            if ($q->num_rows() > 0) 
            {
            $this->session->set_flashdata('failed','failed');
            }
            else
            {
            $paragraph       = "*Jamia Jalaliyya Entrance Examination 2024.*";
            $message         = "Hi $name. You are successfully registered with the Entrance Exam Registration Portal.Please keep your username and password for future reference. ";
            
            $portal="Please login and complete your application
https://app.iritaq.info/entrance/entranceexam/login";
$welcome="*ജാമിയ ജലാലിയ എൻട്രൻസ് എക്സാം പോർട്ടലിലേക്ക് സ്വാഗതം.*";


  $description=" *$name* എക്സാം പോർട്ടലിൽ താങ്കൾ അക്കൗണ്ട് രജിസ്ട്രേഷൻ വിജയകരമായി പൂർത്തീകരിച്ചിരിക്കുന്നു. മുകളിൽ കൊടുത്ത യൂസർനെയിം പാസ്‌വേഡ് ഉപയോഗിച്ച് താങ്കളുടെ അക്കൗണ്ട് ലോഗിൻ ചെയ്തു അപേക്ഷ പൂർത്തീകരിക്കേണ്ടതാണ്" 
           
           ;
           
            $formated_message="{$paragraph}\n{$message}\nUsername :  {$username}\nPassword :  {$password}\n{$portal}\n{$welcome}\n{$description}";
           
            $details                = $admission_data;
            $details['mobileno']    = $phoneno;
            if ($phoneno[0] != '+') {
            $phoneno = '+' . $phoneno; 
            } 
            
            
            // $this->mailsmsconf->online_sms('entrance_registration', $details);
            
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
            
            // $template_name = 'entranceregistration';  
            // $lang_code = 'en'; 
            
            // $data = [
            // 'phone' => $phoneno,
            // 'enable_acculync' => true,
            // 'media' => [
            // 'type' => 'media_template',
            // 'lang_code' => $lang_code,
            // 'template_name' => $template_name,
            // 'body'  => [
            // [
            // 'text' => $data['entrance_current_session']['session'] 
            // ],
            // [
            // 'text' => $admission_data['entrance_reg_name']  
            // ],
            // [
            // 'text' => $admission_data['entrance_reg_username'] 
            // ],
            // [
            // 'text' => $admission_data['entrance_reg_password']  
            // ],
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
            
            // $this->smsgateway->sendWhatsAppSMS($phoneno,$formated_message);
            
           
            
  
            
            
            $m_ses         =  $data['entrance_current_session']['session'];
            $m_name        =  $admission_data['entrance_reg_name'];
            $m_username    =  $admission_data['entrance_reg_username'];
            $m_regpwd      =  $admission_data['entrance_reg_password'];
            
            $type          = "media_template";
            $lang_code     = "en";
            $template_name = 'entranceregistration';
            $text          = [$m_ses,$m_name,$m_username,$m_regpwd];
            
            $this->Entranceadmission_model->getauth($phoneno,$type,$lang_code,$template_name,$text);
            
            $this->db->insert('entrance_examregister',$admission_data);
            $insert_id = $this->db->insert_id();
            $admissionform = array(               
            'admission_application_registerid'=> $insert_id,
            'admission_form_status'           => 0,
            'admission_sessionid'             => $current_session['cur_session']); 
            $this->db->insert('admission_form_tbl',$admissionform);
            $this->session->set_flashdata('success','success');
            }
            redirect($_SERVER['HTTP_REFERER']);
            }
            }


            public function login()
            { 
            $user           =   $this->input->post('username');
            $pass           =   $this->input->post('password');
            $userid         =   $this->Entranceexam_model->login($user,$pass);
            if($userid->num_rows() > 0)                     
            {  
            if (isset($userid) && !empty($userid)) 
            {
            $data                      =   $userid->row_array();
            $username                  =   $data['entrance_reg_username'];
            $email                     =   $data['entrance_reg_email'];
            $password                  =   $data['entrance_reg_password'];                    
            $session_studid            =   $data['entrance_reg_id'];  
            $reg_phone                 =   $data['entrance_reg_phone'];  
            $sesdata = array(
                    'username'          => $username,
                    'password'          => $password,
                    'email'             => $email,
                    'reg_phone'         => $reg_phone ,
                    'session_studid'    => $session_studid,
                    'logged_in'         => TRUE
                );                
            $this->session->set_userdata($sesdata); 
            $session_studid=$this->session->userdata['session_studid'];
            redirect('entrance/Entranceexam/ui_tables');
            }
            }
            else
            {
            $data                      =   $userid->row_array();
            
            if($user!=$data['entrance_reg_username'] || $pass!=$data['entrance_reg_password'])
            {
            $data['msg']="Invalid Username Or Password"; 
            }
            $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
            $this->load->view('entrance/layout/header');
            $this->load->view('entrance/layout/caraosalheader',$data);
            $this->load->view('entrance/login',$data);
            $this->load->view('entrance/layout/footer');
            }        
            }
            


            public function termsandcondition()
            {
            if(isset($this->session->userdata['logged_in']))
            {
            $studid=$this->session->userdata['session_studid'];
            $ta                     =   "entranceexamimage";
            $con                    =   array('img_status'=>1);
            $data['pdfimage']       =   $this->Entranceadmission_model->list_valuedata($ta,$con);
            $tablec                 =   "entranceexam_course";
            
            $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings();
            $currententrance                          =  $data['entrance_current_session'];
            
            $conditionc               =   array('entranceexam_course_status'=>1,'entranceexam_course_session'=>$currententrance['cur_session']);
           // $data['course']         =   $this->Entranceadmission_model->list_data($tablec,$conditionc);
            $data['course']           =   $this->Entranceadmission_model->list_course_bysession($currententrance['cur_session']);
            
            $feetable                 =   "fees_entrancepayment";
            
            $feecondition             =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
            $data['fee_details']      =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
            $feedetails               =   $data['fee_details'];
            $data['applicant_withcourse']       =   $this->Entranceadmission_model->applicantdetails_withcourse($studid);
            
            $this->load->view('entrance/layout/header',$data);
            $this->load->view('entrance/layout/caraosalheader',$data);
            $this->load->view('entrance/admissionform/admission_form_introduction',$data);
            $this->load->view('entrance/layout/footer');
            }
            else
            {
            $this->load->view('entrance/404_page');
            }
            }
            
            
            
            public function ui_tables()
            {
            if(isset($this->session->userdata['logged_in']))
            {
            $studid                             =   $this->session->userdata['session_studid'];
            $ta                                 =   "entranceexamimage";
            $con                                =   array('img_status'=>1);
            $data['pdfimage']                   =   $this->Entranceadmission_model->list_valuedata($ta,$con);
            $tablec                             =   "entranceexam_course";
            $conditionc                         =   array('entranceexam_course_status'=>1);
            $data['course']                     =   $this->Entranceadmission_model->list_data($tablec,$conditionc);
            $feetable                           =   "fees_entrancepayment";
            $feecondition                       =   array('fees_entrancepayment_student_id'=>$studid,'fees_entrancepayment_id_status'=>1,'fees_entrancepayment_statuscode'=>'S');
            $data['fee_details']                =   $this->Entranceadmission_model->list_valuedata($feetable,$feecondition);
            $feedetails                         =   $data['fee_details'];
            $data['applicant_withcourse']       =   $this->Entranceadmission_model->applicantdetails_withcourse($studid);
            $ui_table                           =   "set_entrance_uidesign";
            $ui_condition                       =   array('reg_id'=>$studid);
            $data['ui_tables']                  =   $this->Entranceadmission_model->list_valuedata($ui_table,$ui_condition);
            $data['entrance_current_session']   =   $this->Entrance_settings_model->get_entrance_settings();
            $currententrance                    =   $data['entrance_current_session'];
            $data['admitcard']                  =   $this->Entranceadmission_model->admit_announce($studid,$currententrance['cur_session'],$data['applicant_withcourse']['admission_application_selectedcourse']);
            $admitcard                          =   $data['admitcard'];
            $current_date                       =   date('Y-m-d H:i');
            $announce_date                      =   str_replace('T', ' ', $admitcard['set_general_announcedate']);
            
            $data['entrance_ui_phase']          =   $this->Entrance_settings_model->entrance_settings_general($data['ui_tables']['phasegroup'],$currententrance['cur_session'],$data['applicant_withcourse']['admission_application_selectedcourse']);
            $data['entrance_ui_phaseresult']    =   $this->Entrance_settings_model->entrance_settings_phaseresult($data['ui_tables']['phasegroup'],$currententrance['cur_session'],$data['applicant_withcourse']['admission_application_selectedcourse']);
            
            $data['entrance_ui_allotment']      =   $this->Entrance_settings_model->entrance_settings_phaseallotment($data['ui_tables']['phasegroup'],$currententrance['cur_session'],$data['applicant_withcourse']['admission_application_selectedcourse']);
            
            if ($announce_date >= $current_date) 
            {
            $da = array(
            'ui_admitcard'=>1,
            ); 
            $this->db->where(array('reg_id'=>$studid));    
            $this->db->update('set_entrance_uidesign',$da);
            }
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
            
            
            public function logout()
            {
            $this->session->unset_userdata('logged_in');
            redirect('entrance/Entranceexam');
            }
            
            public function prospects()
            {
            $data['entrance_current_session']         =  $this->Entrance_settings_model->get_entrance_settings(); 
            $this->load->view('entrance/layout/header');
            $this->load->view('entrance/prospects');
            $this->load->view('entrance/layout/footer');
            }
            
    
            public function registerr()
            {
            $this->load->view('entrance/layout/header');
            $this->load->view('entrance/layout/caraosalheader');
            $this->load->view('entrance/qr/qr');
            $this->load->view('entrance/layout/footer');        
            }
            }
            
   
   
   
   
   
   
            

            
            
