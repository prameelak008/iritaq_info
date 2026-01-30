        <?php
        
        if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
        }
        
        class Mailsmsconf 
        {
            
        
        public function __construct() 
        {
        $this->CI = &get_instance();
        $this->CI->config->load("mailsms");
        $this->CI->load->library('smsgateway');
        $this->CI->load->library('mailgateway');
        $this->CI->load->model('examresult_model');
        $this->CI->load->model('student_model');
        $this->CI->load->model('Entranceadmission_model');
        $this->config_mailsms = $this->CI->config->item('mailsms');
        $this->sch_setting = $this->CI->setting_model->getSetting();
        }
        
        
        
        public function mailsms($send_for, $sender_details, $date = null, $exam_schedule_array = null) 
        {
        $send_for        =    $this->config_mailsms[$send_for];
        $chk_mail_sms    =    $this->CI->customlib->sendMailSMS($send_for);
        $sms_detail      =    $this->CI->smsconfig_model->getActiveSMS();
        
        
        if($chk_mail_sms['is_template']==2)
        {
        $template_content   = $chk_mail_sms['template_two'];
        }
        else
        {
        $template_content   = $chk_mail_sms['template'];    
        }
     
        if (!empty($chk_mail_sms)) 
        {
            
        if ($send_for == "student_admission")
        {
        if ($chk_mail_sms['mail'] && $template_content != "")
        {
        $this->CI->mailgateway->sentRegisterMail($sender_details['student_id'], $sender_details['email'], $template_content, $chk_mail_sms['subject']);
        }
        
      
        if ($chk_mail_sms['sms'] && $template_content != "" && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sentRegisterSMS($sender_details['student_id'], $sender_details['contact_no'], $template_content,$chk_mail_sms['template_id']);
        }
        }
        
        elseif ($send_for == "exam_result")
        {
        $this->sendResult($chk_mail_sms, $sender_details, $template_content, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        } 
        
        elseif ($send_for == "login_credential") 
        {
        if ($chk_mail_sms['mail'] && $template_content != "") 
        {
        $this->CI->mailgateway->sendLoginCredential($chk_mail_sms, $sender_details, $template_content , $chk_mail_sms['subject']);
        }
        
        if ($chk_mail_sms['sms'] && $template_content != "" && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sendLoginCredential($chk_mail_sms, $sender_details, $template_content,$chk_mail_sms['template_id']);
        }
        } 
        elseif ($send_for == "fee_submission")
        {
        
        if ($chk_mail_sms['mail'] && $template_content != "") {
        $this->CI->mailgateway->sentAddFeeMail($sender_details,$template_content, $chk_mail_sms['subject']);
        }
        
        if ($chk_mail_sms['sms'] && $template_content != "" && !empty($sms_detail)) {
        
        $this->CI->smsgateway->sentAddFeeSMS($sender_details, $template_content,$chk_mail_sms['template_id']);
        }
        
        
        if ($chk_mail_sms['notification'] && $template_content != "") 
        {
        $this->CI->smsgateway->sentAddFeeNotification($sender_details, $template_content, $chk_mail_sms['subject']);
        }
        }
        
        elseif ($send_for == "absent_attendence") 
        {
        $this->sendAbsentAttendance($chk_mail_sms, $sender_details, $date, $template_content, $exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        
        elseif ($send_for == "exam_registration") 
        {
        $this->sendexam_registration($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        
        elseif ($send_for == "exam_application") 
        {
        $this->sendexam_application($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        
        elseif ($send_for == "fees_reminder") 
        {
        if ($chk_mail_sms['mail'] && $template_content != "") {
        $this->CI->mailgateway->sentMail($sender_details, $template_content, $chk_mail_sms['subject']);
        }
        
        if ($chk_mail_sms['sms'] && $template_content != "" && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sendSMS($sender_details->guardian_phone, $sender_details,$chk_mail_sms['template_id'], $template_content);
        }
        
        if ($chk_mail_sms['notification'] && $template_content != "")
        {
        $this->CI->smsgateway->sentNotification($sender_details->parent_app_key, $template_content, $sender_details, $chk_mail_sms['subject'], $template_content);
        }
        } 
        
        elseif ($send_for == "homework") 
        {
        $this->sendHomework($chk_mail_sms, $sender_details, $template_content, $chk_mail_sms['subject'], $chk_mail_sms['template_id']);
        } 
        elseif ($send_for == "online_examination_publish_exam") 
        {
        $this->sendOnlineexam($chk_mail_sms, $sender_details, $template_content, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        } 
        elseif ($send_for == "online_examination_publish_result") {
        
        $this->sendOnlineexam($chk_mail_sms, $sender_details, $template_content, $chk_mail_sms['subject'], $chk_mail_sms['template_id']);
        } 
        elseif ($send_for == "forgot_password") {
        $school_name = $this->CI->setting_model->getCurrentSchoolName();
        $sender_details['school_name'] = $school_name;
        
        $msg = ($this->getForgotPasswordContent($sender_details, $template_content));
        
        
        if ($chk_mail_sms['mail'] && $template_content != "") 
        {
        if (!empty($sender_details['email'])) 
        {
        $subject = $chk_mail_sms['subject'];
        $this->CI->mailer->send_mail($sender_details['email'], $subject, $msg);
        }
        }
        }
        
        elseif ($send_for == "online_admission_form_submission") 
        {
        $this->sendOnlineadmission($chk_mail_sms, $sender_details, $template_content, $chk_mail_sms['subject'], $chk_mail_sms['template_id']);
        } 
        
        elseif ($send_for == "exam_payment") 
        {
        $this->send_exampayment($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        
        elseif ($send_for == "exam_nonpayment") 
        {
        $this->send_exam_nonpayment($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        else
        {
        }
        }
        }
        
       
        
        
        
        public function mailsmsalumnistudent($sender_details) 
        {
        if ($sender_details['email_value'] == 'yes') 
        {
        $this->CI->mailgateway->sentMailToAlumni($sender_details);
        }
        if ($sender_details['sms_value'] == 'yes') 
        {
        $this->CI->smsgateway->sentSMSToAlumni($sender_details);
        }
        }
        
        
        
        public function sendResult($chk_mail_sms, $exam_result, $template, $subject, $template_id) 
        {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
        $sms_detail = $this->CI->smsconfig_model->getActiveSMS(); 
        if (!empty($exam_result['exam_result'])) {
        foreach ($exam_result['exam_result'] as $res_key => $res_value) {
        
        $detail = array(
        'student_name' => $this->CI->customlib->getFullName($res_value->firstname,$res_value->middlename,$res_value->lastname,$this->sch_setting->middlename,$this->sch_setting->lastname),
        'exam_roll_no' => $res_value->exam_roll_no,
        'email' => $res_value->email,
        'exam' => $exam_result['exam']->exam,
        'guardian_phone' => $res_value->guardian_phone,
        'guardian_email' => $res_value->guardian_email,
        'app_key' => $res_value->app_key,
        'parent_app_key' => $res_value->parent_app_key,
        );
        
        if ($chk_mail_sms['mail'] && $detail['guardian_email'] != "") {
        
        $this->CI->mailgateway->sentExamResultMail($detail, $template, $subject);
        }
        if ($chk_mail_sms['mail'] && $detail['email'] != "") {
        
        $this->CI->mailgateway->sentExamResultMailStudent($detail, $template, $subject);
        }
        if ($chk_mail_sms['sms'] && $detail['guardian_phone'] != ""  && !empty($sms_detail)) {
        $this->CI->smsgateway->sentExamResultSMS($detail, $template, $template_id);
        }
        if ($chk_mail_sms['notification'] && ($detail['parent_app_key'] != "" || $detail['app_key'] != "")) {
        $this->CI->smsgateway->sentExamResultNotification($detail, $template, $subject);
        }
        }
        }
        }
        }
        
        
        
        public function sendexam_registration($chk_mail_sms, $student_array, $date, $template, $examschedule,$subject,$template_id) 
        {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']  or $chk_mail_sms['whatsapp']) 
        {
        $student_result  = $this->getAbsentStudentlist($student_session_array);
        
        
        $sms_detail      = $this->CI->smsconfig_model->getActiveSMS();
        if (!empty($student_result))
        {
        foreach ($student_result as $student_result_k => $student_result_v)
        {
        $detail = array(
        'date' => $date,
        'parent_app_key' => $student_result_v->parent_app_key,
        'mobileno' => $student_result_v->mobileno,
        'email' => $student_result_v->email,
        'firstname' => $student_result_v->firstname,
        'middlename' => $student_result_v->middlename,
        'lastname' => $student_result_v->lastname,
        'father_name' => $student_result_v->father_name,
        'father_phone' => $student_result_v->father_phone,
        'father_occupation' => $student_result_v->father_occupation,
        'mother_name' => $student_result_v->mother_name,
        'mother_phone' => $student_result_v->mother_phone,
        'guardian_name' => $student_result_v->guardian_name,
        'guardian_phone' => $student_result_v->guardian_phone,
        'guardian_occupation' => $student_result_v->guardian_occupation,
        'guardian_email' => $student_result_v->guardian_email,
        );
        
       if (isset($examschedule) && !empty($examschedule)) 
        {
        $detail['name'] = $examschedule['name'];
        $detail['exam_type'] = $examschedule['exam_type'];
        $detail['exam'] = $examschedule['exam'];
        $detail['description'] = $examschedule['description'];
        $detail['name'] = $examschedule['name'];
        }
        
        $detail['student_name'] = $this->CI->customlib->getFullName($student_result_v->firstname,$student_result_v->middlename,$student_result_v->lastname,$this->sch_setting->middlename,$this->sch_setting->lastname);
        
        if ($chk_mail_sms['mail'])
        {
        $this->CI->mailgateway->sentAbsentStudentMail($detail, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template, $template_id);
        }
        
        
        if ($chk_mail_sms['notification'])
        {
        $this->CI->smsgateway->sentAbsentStudentNotification($detail, $template, $subject);
        }
        
        
        if ($chk_mail_sms['whatsapp']) 
        {
            
        $this->CI->smsgateway->sendregisterStudentWhatsapp($detail, $template, $template_id);
        }
        }
        }
        }
        }
        
        
        
        public function send_exampayment($chk_mail_sms, $student_session_array, $date, $template, $examschedule,$subject,$template_id) 
        {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']  or $chk_mail_sms['whatsapp']) 
        {
        $student_result  = $this->getAbsentStudentlist($student_session_array);
        $sms_detail      = $this->CI->smsconfig_model->getActiveSMS();
        if (!empty($student_result))
        {
        foreach ($student_result as $student_result_k => $student_result_v)
        {
        $detail = array(
        'date' => $date,
        'parent_app_key'      => $student_result_v->parent_app_key,
        'mobileno'            => $student_result_v->mobileno,
        'email'               => $student_result_v->email,
        'firstname'           => $student_result_v->firstname,
        'middlename'          => $student_result_v->middlename,
        'lastname'            => $student_result_v->lastname,
        'father_name'         => $student_result_v->father_name,
        'father_phone'        => $student_result_v->father_phone,
        'father_occupation'   => $student_result_v->father_occupation,
        'mother_name'         => $student_result_v->mother_name,
        'mother_phone'        => $student_result_v->mother_phone,
        'guardian_name'       => $student_result_v->guardian_name,
        'guardian_phone'      => $student_result_v->guardian_phone,
        'guardian_occupation' => $student_result_v->guardian_occupation,
        'guardian_email'      => $student_result_v->guardian_email,
        );
        
    
        
       if (isset($examschedule) && !empty($examschedule)) 
        {
        $detail['name']        = $examschedule['name'];
        $detail['exam_type']   = $examschedule['exam_type'];
        $detail['exam']        = $examschedule['exam'];
        $detail['description'] = $examschedule['description'];
        $detail['session']     = $examschedule['session'];
        $detail['fees_payment_orderid']        = $examschedule['fees_payment_orderid'];
        $detail['fees_payment_transaction_no'] = $examschedule['fees_payment_transaction_no'];
        $detail['fees_payment_amount']         = $examschedule['fees_payment_amount'];
        $detail['fees_payment_transdate']      = $examschedule['fees_payment_transdate'];
       
        }
        
        $detail['student_name'] = $this->CI->customlib->getFullName($student_result_v->firstname,$student_result_v->middlename,$student_result_v->lastname,$this->sch_setting->middlename,$this->sch_setting->lastname);
        
        if ($chk_mail_sms['mail'])
        {
        $this->CI->mailgateway->sentAbsentStudentMail($detail, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template, $template_id);
        }
        
        
        if ($chk_mail_sms['notification'])
        {
        $this->CI->smsgateway->sentAbsentStudentNotification($detail, $template, $subject);
        }
        if ($chk_mail_sms['whatsapp']) 
        {
        $this->CI->smsgateway->sendregisterStudentWhatsapp($detail, $template, $template_id);
        }
        
        
        }
        }
        }
        }
        
        
        
        public function send_exam_nonpayment($chk_mail_sms, $student_session_array, $date, $template, $examschedule,$subject,$template_id) 
        {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']  or $chk_mail_sms['whatsapp']) 
        {
        $student_result  = $this->getAbsentStudentlist($student_session_array);
        $sms_detail      = $this->CI->smsconfig_model->getActiveSMS();
        if (!empty($student_result))
        {
        foreach ($student_result as $student_result_k => $student_result_v)
        {
        $detail = array(
        'date' => $date,
        'parent_app_key' => $student_result_v->parent_app_key,
        'mobileno' => $student_result_v->mobileno,
        'email' => $student_result_v->email,
        'firstname' => $student_result_v->firstname,
        'middlename' => $student_result_v->middlename,
        'lastname' => $student_result_v->lastname,
        'father_name' => $student_result_v->father_name,
        'father_phone' => $student_result_v->father_phone,
        'father_occupation' => $student_result_v->father_occupation,
        'mother_name' => $student_result_v->mother_name,
        'mother_phone' => $student_result_v->mother_phone,
        'guardian_name' => $student_result_v->guardian_name,
        'guardian_phone' => $student_result_v->guardian_phone,
        'guardian_occupation' => $student_result_v->guardian_occupation,
        'guardian_email' => $student_result_v->guardian_email,
        );
        
      
        
       if (isset($examschedule) && !empty($examschedule)) 
        {
        $detail['name']         = $examschedule['name'];
        $detail['exam_type']    = $examschedule['exam_type'];
        $detail['exam']         = $examschedule['exam'];
        $detail['description']  = $examschedule['description'];
        $detail['session']      = $examschedule['session'];
        
        }
        
        $detail['student_name'] = $this->CI->customlib->getFullName($student_result_v->firstname,$student_result_v->middlename,$student_result_v->lastname,$this->sch_setting->middlename,$this->sch_setting->lastname);
        
        if ($chk_mail_sms['mail'])
        {
        $this->CI->mailgateway->sentAbsentStudentMail($detail, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template, $template_id);
        }
        
        
        if ($chk_mail_sms['notification'])
        {
        $this->CI->smsgateway->sentAbsentStudentNotification($detail, $template, $subject);
        }
        
        
        if ($chk_mail_sms['whatsapp']) 
        {
            
        $this->CI->smsgateway->sendregisterStudentWhatsapp($detail, $template, $template_id);
        }
        
        
        }
        }
        }
        }
        
        
        
        
        public function sendexam_application($chk_mail_sms, $student_session_array, $date, $template, $examschedule,$subject,$template_id) 
        {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']  or $chk_mail_sms['whatsapp']) 
        {
        $student_result  = $this->getapplicationStudentlist($student_session_array);
        $sms_detail      = $this->CI->smsconfig_model->getActiveSMS();
        if (!empty($student_result))
        {
        foreach ($student_result as $student_result_k => $student_result_v)
        {
        $detail = array(
        'date' => $date,
        'parent_app_key' => $student_result_v->parent_app_key,
        'mobileno' => $student_result_v->mobileno,
        'email' => $student_result_v->email,
        'firstname' => $student_result_v->firstname,
        'middlename' => $student_result_v->middlename,
        'lastname' => $student_result_v->lastname,
        'father_name' => $student_result_v->father_name,
        'father_phone' => $student_result_v->father_phone,
        'father_occupation' => $student_result_v->father_occupation,
        'mother_name' => $student_result_v->mother_name,
        'mother_phone' => $student_result_v->mother_phone,
        'guardian_name' => $student_result_v->guardian_name,
        'guardian_phone' => $student_result_v->guardian_phone,
        'guardian_occupation' => $student_result_v->guardian_occupation,
        'guardian_email' => $student_result_v->guardian_email,
        'session' => $student_result_v->session,
        );
        if (isset($examschedule) && !empty($examschedule)) 
        {
        $detail['name'] = $examschedule['name'];
        $detail['exam_type'] = $examschedule['exam_type'];
        $detail['exam'] = $examschedule['exam'];
        $detail['description'] = $examschedule['description'];
        }
        
        
        $detail['student_name'] = $this->CI->customlib->getFullName($student_result_v->firstname,$student_result_v->middlename,$student_result_v->lastname,$this->sch_setting->middlename,$this->sch_setting->lastname);
    
        if ($chk_mail_sms['mail'])
        {
        //$this->CI->mailgateway->sentAbsentStudentMail($detail, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) 
        {
       // $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template, $template_id);
        }
        
        
        if ($chk_mail_sms['notification'])
        {
        //$this->CI->smsgateway->sentAbsentStudentNotification($detail, $template, $subject);
        }
        
        
        if ($chk_mail_sms['whatsapp']) 
        {
        $this->CI->smsgateway->sendexamappliedStudentWhatsapp($detail, $template, $template_id);
        }
        
        
        }
        }
        }
        }
        
        
        public function sendAbsentAttendance($chk_mail_sms, $student_session_array, $date, $template, $subject_attendence, $subject,$template_id) 
        {
        
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']  or $chk_mail_sms['whatsapp']) 
        {
        $student_result  = $this->getAbsentStudentlist($student_session_array);
        $sms_detail      = $this->CI->smsconfig_model->getActiveSMS();
        
        
        if (!empty($student_result))
        {
        foreach ($student_result as $student_result_k => $student_result_v)
        {
        $detail = array(
        'date' => $date,
        'parent_app_key' => $student_result_v->parent_app_key,
        'mobileno' => $student_result_v->mobileno,
        'email' => $student_result_v->email,
        'firstname' => $student_result_v->firstname,
        'middlename' => $student_result_v->middlename,
        'lastname' => $student_result_v->lastname,
        'father_name' => $student_result_v->father_name,
        'father_phone' => $student_result_v->father_phone,
        'father_occupation' => $student_result_v->father_occupation,
        'mother_name' => $student_result_v->mother_name,
        'mother_phone' => $student_result_v->mother_phone,
        'guardian_name' => $student_result_v->guardian_name,
        'guardian_phone' => $student_result_v->guardian_phone,
        'guardian_occupation' => $student_result_v->guardian_occupation,
        'guardian_email' => $student_result_v->guardian_email,
        );
        
        if (isset($subject_attendence) && !empty($subject_attendence)) 
        {
        $detail['time_from'] = $subject_attendence->time_from;
        $detail['time_to'] = $subject_attendence->time_to;
        $detail['subject_name'] = $subject_attendence->name;
        $detail['subject_code'] = $subject_attendence->code;
        $detail['subject_type'] = $subject_attendence->type;
        }
        
        $detail['student_name'] = $this->CI->customlib->getFullName($student_result_v->firstname,$student_result_v->middlename,$student_result_v->lastname,$this->sch_setting->middlename,$this->sch_setting->lastname);
        
        if ($chk_mail_sms['mail'])
        {
        $this->CI->mailgateway->sentAbsentStudentMail($detail, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) 
        {
        $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template, $template_id);
        }
        
        
        if ($chk_mail_sms['notification'])
        {
        $this->CI->smsgateway->sentAbsentStudentNotification($detail, $template, $subject);
        }
        if ($chk_mail_sms['whatsapp']) 
        {
        $this->CI->smsgateway->sentAbsentStudentWhatsapp($detail, $template, $template_id);
        }
        }
        }
        }
        }
        
        
        
        public function getAbsentStudentlist($student_session_array) 
        {
        $result = $this->CI->student_model->getStudentListBYStudentsessionID($student_session_array);
        if (!empty($result)) {
        return $result;
        }
        return false;
        }
        
        
        
        public function getapplicationStudentlist($student_session_array) 
        {
        
        $result = $this->CI->student_model->getStudentListBYStudentID($student_session_array);
        if (!empty($result)) {
        return $result;
        }
        return false;
        }
        
        
         
        
        
        public function sendHomework($chk_mail_sms, $student_details, $template, $subject, $template_id)
        {
        $student_sms_list = array();
        $student_email_list = array();
        $student_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
        $class_id = ($student_details['class_id']);
        $section_id = ($student_details['section_id']);
        $homework_date = $student_details['homework_date'];
        $submit_date = $student_details['submit_date'];
        $subject = $student_details['subject'];
        $student_list = $this->CI->student_model->getStudentByClassSectionID($class_id, $section_id);
        $sms_detail = $this->CI->smsconfig_model->getActiveSMS();
        if (!empty($student_list)) {
        
        foreach ($student_list as $student_key => $student_value) {
        
        if ($student_value['app_key'] != "") {
        $student_notification_list[] = array(
        'app_key' => $student_value['app_key'],
        'class' => $student_value['class'],
        'section' => $student_value['section'],
        'homework_date' => $homework_date,
        'submit_date' => $submit_date,
        'subject' => $subject,
        'admission_no' => $student_value['admission_no'],
        'student_name' => $this->CI->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$this->sch_setting->middlename,$this->sch_setting->lastname),
        );
        }
        if ($student_value['parent_app_key'] != "") {
        $student_notification_list[] = array(
        'app_key' => $student_value['parent_app_key'],
        'class' => $student_value['class'],
        'section' => $student_value['section'],
        'homework_date' => $homework_date,
        'submit_date' => $submit_date,
        'subject' => $subject,
        'admission_no' => $student_value['admission_no'],
        'student_name' => $this->CI->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$this->sch_setting->middlename,$this->sch_setting->lastname),
        );
        }
        
        if ($student_value['email'] != "") {
        $student_email_list[$student_value['email']] = array(
        'class' => $student_value['class'],
        'section' => $student_value['section'],
        'homework_date' => $homework_date,
        'submit_date' => $submit_date,
        'subject' => $subject,
        'admission_no' => $student_value['admission_no'],
        'student_name' => $this->CI->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$this->sch_setting->middlename,$this->sch_setting->lastname),
        );
        }
        if ($student_value['guardian_email'] != "") {
        $student_email_list[$student_value['guardian_email']] = array(
        'class' => $student_value['class'],
        'section' => $student_value['section'],
        'homework_date' => $homework_date,
        'submit_date' => $submit_date,
        'subject' => $subject,
        'admission_no' => $student_value['admission_no'],
        'student_name' =>$this->CI->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$this->sch_setting->middlename,$this->sch_setting->lastname),
        );
        }
        if ($student_value['mobileno'] != "") {
        $student_sms_list[$student_value['mobileno']] = array(
        'class' => $student_value['class'],
        'section' => $student_value['section'],
        'homework_date' => $homework_date,
        'submit_date' => $submit_date,
        'subject' => $subject,
        'admission_no' => $student_value['admission_no'],
        'student_name' => $this->CI->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$this->sch_setting->middlename,$this->sch_setting->lastname),
        );
        }
        if ($student_value['guardian_phone'] != "") {
        $student_sms_list[$student_value['guardian_phone']] = array(
        'class' => $student_value['class'],
        'section' => $student_value['section'],
        'homework_date' => $homework_date,
        'submit_date' => $submit_date,
        'subject' => $subject,
        'admission_no' => $student_value['admission_no'],
        'student_name' => $this->CI->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$this->sch_setting->middlename,$this->sch_setting->lastname),
        );
        }
        }
        
        
        if ($chk_mail_sms['mail']) 
        {
        if ($student_email_list) 
        {
        $this->CI->mailgateway->sentHomeworkStudentMail($student_email_list, $template, $subject);
        }
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail))
        {
        
        if ($student_sms_list) 
        {
        $this->CI->smsgateway->sentHomeworkStudentSMS($student_sms_list, $template, $template_id);
        }
        }
        
        if ($chk_mail_sms['notification'])
        {
        if (!empty($student_notification_list)) {
        $this->CI->smsgateway->sentHomeworkStudentNotification($student_notification_list, $template, $subject);
        }
        }
        }
        }
        }
        
        
        public function sendOnlineexam($chk_mail_sms, $student_details, $template, $subject, $template_id) 
        {
        
        $student_sms_list = array();
        $student_email_list = array();
        $student_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
        $student_list=$this->CI->onlineexam_model->getstudentByexam_id($student_details['exam_id']);        
        $sms_detail = $this->CI->smsconfig_model->getActiveSMS();
        if (!empty($student_list)) {
        foreach ($student_list as $student_key => $student_value) {
        
        if ($student_value['app_key'] != "") {
        $student_details['app_key']=$student_value['app_key'];
        $student_notification_list[] = $student_details;
        }
        if ($student_value['parent_app_key'] != "") {
        $student_details['app_key']=$student_value['app_key'];
        $student_notification_list[] = $student_details;
        }
        
        if ($student_value['email'] != "") {
        $student_email_list[$student_value['email']] = $student_details;
        }
        if ($student_value['guardian_email'] != "") {
        $student_email_list[$student_value['guardian_email']] = $student_details;
        }
        if ($student_value['mobileno'] != "") {
        $student_sms_list[$student_value['mobileno']] =$student_details;
        }
        if ($student_value['guardian_phone'] != "") {
        $student_sms_list[$student_value['guardian_phone']] = $student_details;
        }
        }
        
        if ($chk_mail_sms['mail']) {
        
        if ($student_email_list) {
        $this->CI->mailgateway->sentOnlineexamStudentMail($student_email_list, $template, $subject);
        }
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) {
        
        if ($student_sms_list) {
        $this->CI->smsgateway->sentOnlineexamStudentSMS($student_sms_list, $template, $template_id);
        }
        }
        
        if ($chk_mail_sms['notification']) {
        
        if (!empty($student_notification_list)) {
        $this->CI->smsgateway->sentOnlineexamStudentNotification($student_notification_list, $template, $subject);
        }
        }
        }
        }
        }
        
        
        public function getForgotPasswordContent($student_result_detail, $template) {
        
        foreach ($student_result_detail as $key => $value) {
        $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $template;
        }
        
        public function sendOnlineadmission($chk_mail_sms, $student_details, $template, $subject,$template_id) {
        
        $student_sms_list = array();
        $student_email_list = array();
        $student_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
        $sms_detail = $this->CI->smsconfig_model->getActiveSMS();
        if ($chk_mail_sms['mail']) {
        
        $this->CI->mailgateway->sentOnlineadmissionStudentMail($student_details, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) {
        
        $this->CI->smsgateway->sentOnlineadmissionStudentSMS($student_details, $template,$template_id);
        }               
        
        }
        }
        
        public function sendOnlineadmissionFees($chk_mail_sms, $student_details, $template, $subject,$template_id)
        {
        $student_sms_list = array();
        $student_email_list = array();
        $student_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
        $sms_detail = $this->CI->smsconfig_model->getActiveSMS();
        if ($chk_mail_sms['mail']) {
        
        $this->CI->mailgateway->sentOnlineadmissionFeesMail($student_details, $template, $subject);
        }
        
        if ($chk_mail_sms['sms'] && !empty($sms_detail)) {
        
        $this->CI->smsgateway->sentOnlineadmissionFeesSMS($student_details, $template, $template_id);
        }               
        
        }
        }
        
        
        
        
        
        ////////////////////////////////    Online ...................................
        
        
        
        public function online_sms($send_for, $sender_details, $date = null, $exam_schedule_array = null)  
        {
        $send_for        =      $this->config_mailsms[$send_for];
        $chk_mail_sms    =      $this->CI->customlib->sendMailSMS_online($send_for);
        $sms_detail      =      $this->CI->smsconfig_model->getActiveSMS();
        
        
        if($chk_mail_sms['is_template']==2)
        {
        $template_content   = $chk_mail_sms['template_two'];
        }
        else
        {
        $template_content   = $chk_mail_sms['template'];    
        }
     
 
        if (!empty($chk_mail_sms)) 
        {
        if ($send_for == "entrance_registration") 
        {
        $this->entranceexam_registration($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        
        
        if ($send_for == "application_form") 
        {
        $this->entranceexam_registration($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
      
        
        elseif ($send_for == "exam_payment") 
        {
        $this->entranceexam_registration($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        
        elseif ($send_for == "exam_nonpayment") 
        {
        $this->entranceexam_registration($chk_mail_sms, $sender_details, $date, $template_content,$exam_schedule_array, $chk_mail_sms['subject'],$chk_mail_sms['template_id']);
        }
        else
        {
        }
        }
        }
        
        
        public function entranceexam_registration($chk_mail_sms, $student_array, $date, $template, $examschedule,$subject,$template_id) 
        {
        $sms_detail      = $this->CI->smsconfig_model->getActiveSMS();
        $this->CI->smsgateway->sendentranceregWhatsapp($student_array, $template, $template_id);
        
        if ($chk_mail_sms['whatsapp']) 
        {
        $this->CI->smsgateway->sendentranceregWhatsapp($student_array, $template, $template_id);
        }
        }
        
        
        
        public function authenticate_with_rml()
        {
        $url = "https://apis.rmlconnect.net/auth/v1/login/";
        $postData = json_encode([
        "username" => "Jamia",
        "password" => "Jam@r2602"
        ]);
        $headers = [
        'Content-Type: application/json'
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;        
        }
        
        
            // public function gettoken()
            // {
            // $jwt_token   = $this->authenticate_with_rml();
         
            // $token_data  = json_decode($jwt_token, true);
            // $jwt_auth    = $token_data['JWTAUTH'];
            
            // // Split the JWT token into three parts: header, payload, and signature
            // $token_parts  = explode('.', $jwt_auth);
            
            // // Decode the payload from Base64
            // $payload      = base64_decode(str_replace(['-', '_'], ['+', '/'], $token_parts[1]));
            
            // // Convert the payload JSON string into a PHP array
            // $token_data   = json_decode($payload, true);
            
            // // Extract the expiration (exp) and issued-at (orig_iat) fields
            // $expires_at   = $token_data['exp']; // Expiration timestamp
            // $orig_iat     = $token_data['orig_iat']; // Original issued-at timestamp
            
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
            // $new_jwt_token =  $this->authenticate_with_rml(); 
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
            // } 
            // else
            // {
            // echo "Failed to Generate New Token.";
            // }
            // } 
            // else 
            // {
            // echo "Token is still valid, no update needed.";
            // }
            // } 
            // else
            // {
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
            // $query     = $this->db->get();
            
            // if ($query->num_rows() > 0)
            // {
            // $token_record = $query->row();
            // $jwt_token = $token_record->jwt_token;
            // }
            // else 
            // {
            // // Handle case if no token found (though you already inserted one earlier)
            //  echo "No JWT token found.";
            //  return;
            // } 
            // }
            
            
            
            
            public function loadAuthToken()
            {
            $jwt_token   = $this->authenticate_with_rml();
            $result      = $this->CI->Entranceadmission_model->ManageTokenInfo($jwt_token);
            return $result;
            }
            
            
            
            
                   
           
        
            }
