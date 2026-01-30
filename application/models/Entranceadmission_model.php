            <?php
            defined('BASEPATH') OR exit('No direct script access allowed');
            
            class Entranceadmission_model extends CI_Model
            {
            
            function __construct()
            {
            parent::__construct(); 
         
            }
            
            public function index()
            {
            
            }
            
            
            
            
            public function list_rowdata($table)
            {
            $this->db->select('*');
            $this->db->from($table);
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function list_dat($table)
            {
            $this->db->select('*');
            $this->db->from($table);
            $query=$this->db->get();
            return $query->result_array();					
            }
            
            public function list_data($table,$condition)
            {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);					
            $query=$this->db->get();
            return $query->result_array();					
            }
            
            public function list_valuedata($table,$condition)
            {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query=$this->db->get();
            return $query->row_array();
            }
            public function delete_data($table,$condition)
            {											
            $this->db->where($condition);
            return $this->db->delete($table);
            }
            
            public function updte_value($table,$data,$condition)
            {
            $this->db->where($condition);					
            return $this->db->update($table,$data);							 
            }
            
            public function max_application_no()
            {                                   
            $this->db->select_max('admission_application_no');
            $this->db->from('admission_form_tbl');
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            
            public function institutelist($studid)
            {                                   
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entranceexam_insitute','entranceexam_insitute.entranceexam_insitutescourse=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid));	
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            public function centrelist($studid)
            {
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entranceexam_centre','entranceexam_centre.entranceexam_centrecourse=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            
            public function getcourse($studid)
            {                                   
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid));	
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            public function getdataexists($studid)
            {
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->where(array('admission_application_registerid'=> $studid));
            $query = $this->db->get();
            if ($query->num_rows() > 0) 
            {
            return $query->row_array();
            } 
            }
            
            public function getcourse_status($studid)
            {                                   
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid));
            $this->db->order_by('admission_form_tbl.admission_application_registerid', 'DESC');
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            public function getfeerecept($studid)
            {                                   
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid,'fees_entrancepayment.fees_entrancepayment_statuscode'=>'S'));
            $query=$this->db->get();
            return $query->row_array();                             
            }
            
            public function getfeerecept_applicantstatus($studid)
            {                                   
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid));
            $query=$this->db->get();
            return $query->result_array();                             
            }
            
            
            
            public function getapplicant($studid)
            {                                   
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $studid));
            $query=$this->db->get();
            return $query->row_array();                              
            }
            
            public function examgetdetails($course) 
            {
            $sql = "select * from entranceexam_details where applied_course=".$course."";
            $query=$this->db->query($sql);
            return $query->result_array();
            }
            
            
            
            public function examgetByregid($id) {
            // $query = $this->db->select('*')->join("entrance_examregister", "entrance_examregister.entrance_reg_id = admission_form_tbl.admission_application_registerid")->join("entranceexam_course", "entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse")->join("state_list", "state_list.state_id=admission_form_tbl.admission_state")->join("district_list", "district_list.district_id =admission_form_tbl.admission_district")->where("admission_form_tbl.admission_application_registerid", $id)->get("admission_form_tbl");
            // return $query->row_array();
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
           //this->db->join('entranceexam_admitcard','entranceexam_admitcard.entrance_admitcardapplied_course=admission_form_tbl.admission_application_selectedcourse');
           // $this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('admission_form_tbl.admission_application_registerid' => $id));
            $query=$this->db->get();
            return $query->row_array(); 
            
            }
            
            
            
            public function applicantdetails_withcourse($studid) 
            {
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('entrance_examregister','entrance_examregister.entrance_reg_id'=>$studid));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function getadmitcard_time($cursess,$studid,$phase)
            {
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_admitcard','entranceexam_admitcard.entrance_admitcardapplied_course=admission_form_tbl.admission_application_selectedcourse');
            $this->db->where(array('entrance_examregister.entrance_reg_id'=>$studid,'entranceexam_admitcard.entrance_admitcardstatus'=>1,'entranceexam_admitcard.entrance_admitcardsession'=>$cursess,'entranceexam_admitcard.entrance_phase'=>$phase));
            
            $query=$this->db->get();
            return $query->result_array();
            }
 
    
            public function searchSubjectlist($studid,$courseid,$session)
            {
            $this->db->select('*');
            $this->db->from ('entrance_subjecttype');
            $this->db->join('entranceexam_subject', 'entranceexam_subject.entranceexam_subject_subid = entrance_subjecttype.entrance_subtype_id');
            $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_selectedcourse = entranceexam_subject.entranceexam_subject_course_id');
            //$this->db->where (array('entranceexam_subject.entranceexam_subject_status'=>1,'entranceexam_subject.entranceexam_subject_course_id'=>1,'entranceexam_subject.entranceexam_subject_sessionid'=>16));
           
            $this->db->where (array('entranceexam_subject.entranceexam_subject_course_id'=>$courseid,'entranceexam_subject.entranceexam_subject_sessionid'=>$session));
            $this->db->group_by('entrance_subjecttype.entrance_subtype_id');
            $query = $this->db->get();
            return $query->result_array();
            }
            
            
            
            
            
            public function searchExamResult($studid,$courseid,$session)
            {
            $this->db->select('*');
            $this->db->from ('entranceexam_result_value');
            $this->db->join('entranceexam_marks', 'entranceexam_marks.entranceexam_marks_id = entranceexam_result_value.entranceexam_result_marksid');
            $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_selectedcourse = entranceexam_marks.entranceexam_marks_course_id');
            //$this->db->where (array('entranceexam_marks.entranceexam_marks_active'=>1,'entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session_id));
            
            $this->db->where (array('admission_form_tbl.admission_application_registerid'=>$studid,'admission_form_tbl.admission_application_selectedcourse'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session));
            
            
            //$this->db->group_by('entranceexam_result.entranceexam_result_subject');
            $query = $this->db->get();
            return $query->result_array();
            }
    
    
            public function searchsubjectmarks($studid,$courseid,$session)
            {
            $this->db->select('*');
            $this->db->from ('entranceexam_marks');
            $this->db->where (array('entranceexam_marks.entranceexam_marks_active'=>1,'entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session));
            //$this->db->where (array('entranceexam_marks.entranceexam_marks_active'=>1,'entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session_id));
            $query = $this->db->get();
            return $query->result_array();
            }
            
            
            public function searchpublishresult($studid)
            {
            $this->db->select('*');
            $this->db->from ('entranceexam_publish_result_value');
            $this->db->where (array('exam_publish_status'=>1,'exam_publish_regid'=>$studid));
            //$this->db->group_by('exam_publish_regid');
            $query = $this->db->get();
            return $query->row_array();
            }
            
            public function listpublishdate($studid)
            {
            $this->db->select('*');
            $this->db->from ('entranceexam_publish_result_value');
            $this->db->where (array('exam_publish_status'=>1,'exam_publish_regid'=>$studid));
            $this->db->group_by('exam_publish_regid');
            $query = $this->db->get();
            return $query->row_array();
            }
            public function seatquotarawheader($cousid,$current_session)
            {
            $this->db->select('*');
            $this->db->from ('entranceexam_seatquota');
            $this->db->where (array('entranceexam_seatquota_status'=>1,'entranceexam_seatquota_course'=>$cousid,'entranceexam_seatquota_session'=>$current_session));
            $query = $this->db->get();
            return $query->row_array();
            }
            
            
            public function allotmentstatus($studid)
            {
            $this->db->select('*');
            $this->db->from ('entranceexam_allotment');
            $this->db->join('entranceexam_publish_result_value', 'entranceexam_publish_result_value.exam_publish_id = entranceexam_allotment.entranceexam_allotment_publishid');
            $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_registerid = entranceexam_publish_result_value.exam_publish_regid');
            $this->db->join('entranceexam_insitute', 'entranceexam_insitute.entranceexam_insituteid = entranceexam_allotment.entranceexam_allotment_instituteid');
            $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = entranceexam_allotment.entranceexam_allotment_courseid');
            $this->db->where (array('entranceexam_publish_result_value.exam_publish_status'=>1,'entranceexam_publish_result_value.exam_publish_regid'=>$studid));
            $query = $this->db->get();
            return $query->row_array();
            }
            
            public function applicant($studid)
            {
            $this->db->select('*');
            $this->db->from ('admission_form_tbl');
            $this->db->where (array('admission_form_tbl.admission_application_registerid'=>$studid));
            $query = $this->db->get();
            return $query->row_array();   
            }
            
            public function student_details($studid)
            {
            $this->db->select('*');
            $this->db->from('students');
            $this->db->join('student_session','student_session.student_id=students.id');
            $this->db->where(array('students.entrance_reg_id'=>$studid));
            $query=$this->db->get();
            return $query->row_array(); 
            }
            
            public function get_alloted_val($studid)
            {
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_publish_result_value','entranceexam_publish_result_value.exam_publish_regid=admission_form_tbl.admission_application_registerid');
            $this->db->join('entranceexam_allotment','entranceexam_allotment.entranceexam_allotment_publishid=entranceexam_publish_result_value.exam_publish_id');
            $this->db->where(array('entranceexam_publish_result_value.exam_publish_regid'=>$studid));
            $query=$this->db->get();
            return $query->row_array(); 
            }
            
            public function getstudents($studid)
            {
            $this->db->select('*');
            $this->db->from('entrance_examregister');
            $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=entrance_examregister.entrance_reg_id');
            $this->db->join('admission_form_details','admission_form_details.ad_reg_id=admission_form_tbl.admission_application_registerid','left');
            $this->db->join('state_list','state_list.state_id=admission_form_tbl.admission_state');
            $this->db->join('district_list','district_list.district_id=admission_form_tbl.admission_district');
            $this->db->where(array('admission_form_tbl.admission_application_registerid'=>$studid));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function get_instruction($sessionid,$course_id)
            {
            $this->db->select('*');
            $this->db->from('entrance_settings_alloment');
            $this->db->where(array('set_allotment_session'=>$sessionid,'set_allotment_course'=>$course_id));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            
            public function get_admission_list($studid)
            {
            $this->db->select('*');
            $this->db->from('admission_form_tbl');
            $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('state_list','state_list.state_id=admission_form_tbl.admission_state');
            $this->db->join('district_list','district_list.district_id=admission_form_tbl.admission_district','left');
            $this->db->where(array('admission_form_tbl.admission_application_registerid'=>$studid));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function check_address($studid)
            {
            $this->db->select('*');
            $this->db->from('admission_form_details');
            $this->db->where(array('ad_reg_id'=>$studid));
            $query=$this->db->get();
            return $query->row_array();
            }
            
            public function list_course_bysession($currententrance)
            {
            $this->db->select('*');
            $this->db->from('entranceexam_course');
            $this->db->join('entranceexamSelected_course','entranceexamSelected_course.sel_entranceexam_course_name=entranceexam_course.entranceexam_course_id');
            $this->db->where(array('entranceexamSelected_course.sel_entranceexam_course_session'=>$currententrance));
            $query=$this->db->get();
            return $query->result_array();
            }
            
            
            
            public function centerlist_bysession($selectedcourse,$session,$phase)
            {
            $this->db->select('*');
            $this->db->from('entranceexam_centre');
            $this->db->join('entranceexam_selectedcentre','entranceexam_selectedcentre.sel_entranceexam_centrename=entranceexam_centre.entranceexam_centreid');
            $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entranceexam_selectedcentre.sel_entranceexam_centrecourse');
            $this->db->where(array('entranceexam_selectedcentre.sel_entranceexam_centrecourse'=>$selectedcourse));
            $this->db->where(array('entranceexam_selectedcentre.sel_entranceexam_centresession'=>$session));
            $this->db->where(array('entranceexam_selectedcentre.sel_entranceexam_phase'=>$phase));
            $this->db->group_by('entranceexam_selectedcentre.sel_entranceexam_centrename');
            $query=$this->db->get();
            return $query->result_array();
            }
            
            public function admit_announce($studid,$session_id,$sel_course)
            {
            $this->db->select('*');  
            $this->db->from('admission_form_tbl');
            $this->db->join('set_entrance_uidesign','set_entrance_uidesign.reg_id=admission_form_tbl.admission_application_registerid');
            $this->db->join('entrance_settings_general','entrance_settings_general.set_general_phase=set_entrance_uidesign.phasegroup');
            $this->db->where(array('entrance_settings_general.set_general_section'=>'Admit Card'));
            $this->db->where(array('entrance_settings_general.set_general_session'=>$session_id));
            $this->db->where(array('admission_form_tbl.admission_application_registerid'=>$studid));
            $this->db->group_start(); 
            $this->db->where('entrance_settings_general.set_general_course', $sel_course);
            $this->db->or_where('entrance_settings_general.set_general_course', 0);
            $this->db->group_end();
            $query=$this->db->get();
            return  $query->row_array();
            }
            
            
            public function get_phase($cursess, $get_phase_value, $selectedcourse)
            {
            $this->db->select('*');
            $this->db->from('entranceexam_setfees');
            
            // Adding where condition to check if course and session match the selected values
            $this->db->where(array(
            'entrance_setfees_session' => $cursess,
            'entrance_setfees_phase' => $get_phase_value,
            'entrance_setfees_status' => 1
            ));
            
            // If selected course is an array (as it could contain multiple courses), handle that
            if (is_array($selectedcourse))
            {
            foreach ($selectedcourse as $course)
            {
            $this->db->or_where('entrance_setfees_course LIKE', "%$course%");  // Match any course in the JSON array
            }
            }
            else 
            {
            // If only a single course is selected, check for it in the JSON string
            $this->db->where('entrance_setfees_course LIKE', "%$selectedcourse%");
            }
            
            // Fetch the results
            $query = $this->db->get();
            return  $query->result_array();
            }
            
            
            
            
            
            public function  ManageTokenInfo($jwt_token)
            {
            if (!$jwt_token) 
            {
            $this->session->set_flashdata('failed', 'Authentication failed with RML Connect');
            redirect($_SERVER['HTTP_REFERER']);
            return;
            }
            
            $token_data  = json_decode($jwt_token, true);
            $jwt_auth    = $token_data['JWTAUTH'];
            
            // Split the JWT token into three parts: header, payload, and signature
            $token_parts = explode('.', $jwt_auth);
            
            // Decode the payload from Base64
            $payload = base64_decode(str_replace(['-', '_'], ['+', '/'], $token_parts[1]));
            
            // Convert the payload JSON string into a PHP array
            
            $token_data = json_decode($payload, true);
            
            // Extract the expiration (exp) and issued-at (orig_iat) fields
            $expires_at      = $token_data['exp']; // Expiration timestamp
            $orig_iat        = $token_data['orig_iat']; // Original issued-at timestamp
            
            // Convert timestamps to human-readable format
            $expires_at_date = date('Y-m-d H:i:s', $expires_at);
            $orig_iat_date   = date('Y-m-d H:i:s', $orig_iat);
            
            // Get the current timestamp
            $current_time    = time();
            
            // Check if the token already exists in the database
            
            $this->db->select('*')->from('auth_tokens');
            $query = $this->db->get();
            if ($query->num_rows() > 0) 
            {
            // Token exists, check if it has expired
            $token_record     = $query->row();
            $token_expires_at = strtotime($token_record->expires_at); // Convert DB date to timestamp
            
            if ($token_expires_at < $current_time) 
            {
            $new_jwt_token   = $this->mailsmsconf->authenticate_with_rml();
            if ($new_jwt_token) {
            $new_token_data  = json_decode($new_jwt_token, true);
            $new_jwt_auth    = $new_token_data['JWTAUTH'];
            
            // Decode new token payload
            $new_token_parts  = explode('.', $new_jwt_auth);
            $new_payload      = base64_decode(str_replace(['-', '_'], ['+', '/'], $new_token_parts[1]));
            $new_token_data   = json_decode($new_payload, true);
            
            // Extract new expiration and issued-at fields
            $new_expires_at_date = date('Y-m-d H:i:s', $new_token_data['exp']);
            $new_orig_iat_date = date('Y-m-d H:i:s', $new_token_data['orig_iat']);
            
            // Update the expired token with the new one
            $auth_data = array(
            'jwt_token'  => $new_jwt_auth,
            'created_at' => $new_orig_iat_date,
            'expires_at' => $new_expires_at_date,
            );
            
            $this->db->update('auth_tokens', $auth_data);
            echo "Token Updated Successfully!";
            } 
            else
            {
            echo "Failed to Generate New Token.";
            }
            } else {
            echo "Token is still valid, no update needed.";
            }
            } 
            else
            {
            // No token found, insert a new one
            $auth_data = array(
            'jwt_token'  => $jwt_auth,
            'created_at' => $orig_iat_date,
            'expires_at' => $expires_at_date,
            );
            
            $this->db->insert('auth_tokens', $auth_data);
            echo "New Token Inserted Successfully!";
            }
            
            $this->db->select('jwt_token')->from('auth_tokens');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0)
            {
            $token_record = $query->row();
            
            $jwt_token = $token_record->jwt_token;
            } 
            else 
            {
            // Handle case if no token found (though you already inserted one earlier)
            echo "No JWT token found.";
           // return;
            }
            return $jwt_token;
            }
            
            
            
            
            
                    public function getauth($phone_no, $type, $lang_code, $template_name, $text)
                    {
                    $jwt_token      = $this->mailsmsconf->loadAuthToken();
                    $url            = "https://apis.rmlconnect.net/wba/v1/messages";
                    $headers        = [
                    "Authorization:  $jwt_token",
                    "Content-Type: application/json"
                    ];
                    $body = [];
                    foreach ($text as $text_value) 
                    {
                    $body[] = ['text' => $text_value];
                    }
                    $data = [
                    'phone'           => $phone_no,
                    'enable_acculync' => true,
                    'media'           => [
                    'type'            => $type,
                    'lang_code'       => $lang_code,
                    'template_name'   => $template_name,
                    'body'            => $body
                    ]
                    ];
                    $data_json = json_encode($data);
                    // Initialize cURL
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                    curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable debugging
                    
                    // Execute cURL request
                    $response  = curl_exec($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $error     = curl_error($ch);
                    curl_close($ch);
                    return($response);
                    } 
            
                    }