            <?php
            
            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }
            
            class Leave_management extends Admin_Controller
            {
            public function __construct()
            {
            parent::__construct();
            $this->load->library('smsgateway');
            $this->load->library('mailsmsconf');
            $this->load->model("classteacher_model");
            $this->mailer;
            $this->sch_setting_detail = $this->setting_model->getSetting();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
            
            
            
            
            public function index()
            {
            /*if (!$this->rbac->hasPrivilege('sms', 'can_view')) 
            {
            access_denied();
            }
            */
            $this->session->set_userdata('top_menu', 'Attendance');
            $this->session->set_userdata('sub_menu', 'Attendance/leave_management');
            
            $data['title']     = 'Leave Management';
            $class             = $this->class_model->get();
            $data['classlist'] = $class;
            $userdata          = $this->customlib->getUserData();
            $carray            = array();
            $date              = date('Y-m-d');
            $birthDaysList     = array();
          
            $data['leave_category']= $this->leavecategory_model->get_data();
            $data['roles']         = $this->role_model->get();
            $data['birthDaysList'] = $birthDaysList;
            $data['sch_setting']   = $this->sch_setting_detail;
            $this->load->view('layout/header');
            $this->load->view('admin/leave_management/index', $data);
            $this->load->view('layout/footer');
            }
            
            public function send_class()
            {
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $this->form_validation->set_rules('category', $this->lang->line('category'), 'required');
            $this->form_validation->set_rules('fromdate', $this->lang->line('fromdate'), 'required');
            $this->form_validation->set_rules('todate', $this->lang->line('todate'), 'required');
            $this->form_validation->set_rules('user[]', $this->lang->line('recipient'), 'required');
            $template_id = $this->input->post('class_template_id');
            if ($this->form_validation->run())
            {
                
            $category      = $this->input->post('category');
            $section_id    = $this->input->post('section_id');
            $section       = $this->input->post('user[]');
            $class_id      = $this->input->post('class_id');
            $fromdate      = $this->input->post('fromdate');
            $todate        = $this->input->post('todate');
            
            $user_array    = array();
            $timetable     = array();
            foreach ($section as $section_key => $section_value)
            {
            $userlisting = $this->student_model->searchByClassSection($class_id, $section_value);
            if (!empty($userlisting)) 
            {
            for($i=$fromdate;$i<=$todate;$i++)
            {
            $day       = date('l', strtotime($i));
            $timetable = $this->leavecategory_model->gettimetable($class_id, $section_value,$day);
            foreach($timetable as $time)
            {
            foreach ($userlisting as $userlisting_key => $userlisting_value) 
            {
            $array = array(
            'user_id'  => $userlisting_value['id'],
            'session_id'    => $userlisting_value['student_session_id'],
            'send_mail'=>$i,
            );
            
            $attendencelist   = $this->leavecategory_model->get_attendencetails($userlisting_value['student_session_id'],$time['id'], $i);
            
            if($attendencelist=="")
            {
            $user_array[] = $array;
            $data = array(
            'student_session_id'        => $userlisting_value['student_session_id'],
            'subject_timetable_id'      => $time['id'],
            'date'                      => $i,
            'attendence_type_id'        => 5,
            'leavecategory_id'          => $category,
            'created_at'                => date('Y-m-d H:i:s'));
            $this->messages_model->addleave_management($data);
            }
            }
            }
            $getleave   = $this->leavecategory_model->get_leavedetails($class_id, $section_value,$i);
            if($getleave=="")
            {
            $dat = array(
            'leave_catmanagement_class'       => $class_id,
            'leave_catmanagement_section'     => $section_value,
            'leave_catmanagement_session'     => $this->current_session,
            'leave_catmanagement_date'        => $i,
            'leave_catmanagement_category'    => $category,
            'leave_catmanagement_created_at'  => date('Y-m-d H:i:s'));
            $this->messages_model->leavemanagement($dat);
            }
            }
            }
            }
            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('attendance_marked_as_holiday')));
            }
		    else
            {
            $data = array(
           'fromdate' => form_error('fromdate'),
           'todate' => form_error('todate'),
           'category' => form_error('category'),
           'user[]'          => form_error('user[]'),
            );
            echo json_encode(array('status' => 1, 'msg' => $data));
            }
            }
            
            
            public function send_group_attendence()
            {
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $this->form_validation->set_rules('fromdate', $this->lang->line('fromdate'), 'required');
            $this->form_validation->set_rules('todate', $this->lang->line('todate'), 'required');
            $this->form_validation->set_rules('category', $this->lang->line('category'), 'required');
            $this->form_validation->set_rules('user[]', $this->lang->line('staff') . " " . $this->lang->line('to'), 'required');
            $template_id        = $this->input->post('group_template_id');
            $getusermobile      = "";
            if ($this->form_validation->run()) 
            {
            $user_array       = array();
            $fromdate         = $this->input->post('fromdate');
            $todate           = $this->input->post('todate');
            $category         = $this->input->post('category');
            $data         = array(
            'is_group'    => 1,
            'title'       => $message_title,
            'message'     => $message,
            'send_mail'   => 0,
            'send_sms'    => 1,
            'group_list'  => json_encode(array()),
            'created_at'  => date('Y-m-d H:i:s'),
            'template_id' => $template_id,
            );
            
            $this->messages_model->add($data);
            $userlisting = $this->input->post('user[]'); 
            foreach ($userlisting as $users_key => $users_value) 
            {
                
            if ($users_value == "student")
            {
                
            $student_array = $this->student_model->get();
           
            if (!empty($student_array)) 
            {
            foreach ($student_array as $student_key => $student_value) 
            {
            $userlisting = $this->student_model->searchByClassSection($student_value['class_id'], $student_value['section_id']);
            if (!empty($userlisting)) 
            {
            for($i=$fromdate;$i<=$todate;$i++)
            {
            $day       = date('l', strtotime($i));
            $timetable = $this->leavecategory_model->gettimetable($student_value['class_id'], $student_value['section_id'],$day);
            
            foreach($timetable as $time)
            {
            foreach ($userlisting as $userlisting_key => $userlisting_value) 
            {
            $array = array(
            'user_id'  => $userlisting_value['id'],
            'session_id'    => $userlisting_value['student_session_id'],
            'send_mail'=>$i,
            );
            $attendencelist   = $this->leavecategory_model->get_attendencetails($userlisting_value['student_session_id'],$time['id'], $i);
            
            if($attendencelist=="")
            {
            $user_array[] = $array;
            $data = array(
            'student_session_id'        => $userlisting_value['student_session_id'],
            'subject_timetable_id'      => $time['id'],
            'date'                      => $i,
            'attendence_type_id'        => 5,
            'leavecategory_id'          => $category,
            'created_at'                => date('Y-m-d H:i:s'));
            $this->messages_model->addleave_management($data);
            }
            }
            }
            
            $getleave   = $this->leavecategory_model->get_leavedetails($student_value['class_id'], $student_value['section_id'],$i);
            if($getleave=="")
            {
            $dat = array(
            'leave_catmanagement_class'       => $student_value['class_id'],
            'leave_catmanagement_section'     => $student_value['section_id'],
            'leave_catmanagement_session'     => $this->current_session,
            'leave_catmanagement_date'        => $i,
            'leave_catmanagement_category'    => $category,
            'leave_catmanagement_created_at'  => date('Y-m-d H:i:s'));
            $this->messages_model->leavemanagement($dat);
            }
            }
            }
            }
            }
            } 
            else if (is_numeric($users_value)) 
            {
            $staff = $this->staff_model->getEmployeeByRoleID($users_value); 
            if (!empty($staff)) {
            foreach ($staff as $staff_key => $staff_value) 
            {
            for($i=$fromdate;$i<=$todate;$i++)
            {
            $getleave   = $this->leavecategory_model->get_staff_details($staff_value['id'], $i);
            if($getleave=="")
            {
            $data = array(
            'staff_id'  => $staff_value['id'],
            'staff_attendance_type_id'=>5,
            'categoryid'=>$category,
            'date'=>$i,
            'created_at'=>date('Y-m-d H:i:s'));
            $user_array[] = $array;
            $this->messages_model->add_attendence($data);
            }
            }
            }
            }
            }
            }
            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('attendance_marked_as_holiday')));
            } 
            else
            {
            $data = array(
           'fromdate' => form_error('fromdate'),
           'todate' => form_error('todate'),
           'category' => form_error('category'),
           'group_send_by[]' => form_error('group_send_by[]'),
           'user[]'          => form_error('user[]'),
            );
            echo json_encode(array('status' => 1, 'msg' => $data));
            }
            }
            
            public function leave_management_view() 
            {
            /*    
            $this->session->set_userdata('top_menu', 'Attendance');
            $this->session->set_userdata('sub_menu', 'Attendance/leave_management_view');
            $data = array();
            $class = $this->class_model->get('', $classteacher = 'yes');
            $data['classlist'] = $class;
            $data['monthlist'] = $this->customlib->getMonthDropdown();
            $data['yearlist'] = $this->studentsubjectattendence_model->attendanceYearCount();
            $data['sch_setting']     = $this->setting_model->getSetting();
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('year', $this->lang->line('year'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == true) 
            {
            $data['attendencetypeslist'] = $attendencetypes;
            $class_id                   = $this->input->post('class_id');
            $section_id                 = $this->input->post('section_id');
            $month                      = $this->input->post('month');
            $year                       = $this->input->post('year');
            $data['monthv']             = $month;
            $month_number               = date("m", strtotime($month));
            $to_date                    = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result                = array();
            $attendence_array           = array();
            $student_result             = array();
            $data['no_of_days']         = $to_date;
            $date_result                = array();
            $from_date                  = 01;
            $data['from_date']          =  $from_date;
            $data['month_number']       =  $month_number;
            $data['year_val']           =  $year;
            $data['to_date']            =  $to_date;
            $fdate                      =  $year.'-'.$month_number.'-'.'01';
            $tdate                      =  $year.'-'.$month_number.'-'.$to_date;
            $resultlist                 = $this->category_model->getleave_details($class_id, $section_id, $fdate, $tdate);
            $data['resultlist']         = $resultlist;
            $this->sch_current_session  = $this->setting_model->getCurrentSession();
            $data['current_session']    = $this->sch_current_session;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/leave_management/leave_management_view', $data);
            $this->load->view('layout/footer', $data);
            */
            
            
           
            /*if (!$this->rbac->hasPrivilege('sms', 'can_view')) 
            {
            access_denied();
            }
            */
            $this->session->set_userdata('top_menu', 'Attendance');
            $this->session->set_userdata('sub_menu', 'Attendance/leave_management_view');
            
            $data['title']     = 'Leave Management';
            $class             = $this->class_model->get();
            $data['classlist'] = $class;
            $userdata          = $this->customlib->getUserData();
            $carray            = array();
            $date              = date('Y-m-d');
            $birthDaysList     = array();
          
            $data['leave_category']= $this->leavecategory_model->get_data();
            $data['roles']         = $this->role_model->get();
            $data['birthDaysList'] = $birthDaysList;
            $data['sch_setting']   = $this->sch_setting_detail;
            $this->load->view('layout/header');
            $this->load->view('admin/leave_management/leave_management_view', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            
            
            
            
            public function delete_leave($id='0',$class_id,$section_id,$date)
            {
            $resultlist = $this->category_model->studentmanagement($class_id,$section_id);
            $this->db->where(array('leave_catmanagement_id'=> $id));
            $this->db->delete('leave_catmanagement');
            foreach($resultlist as $res)
            {
            $this->db->where(array('student_session_id'=> $res['session_id'],'date'=> $date));
            $this->db->delete('student_subject_attendances'); 
            }
            redirect('admin/leave_management/leave_management_view');
            }
            
            
            public function subject_attendence_report()
            {
            $this->session->set_userdata('top_menu', 'Attendance');
            $this->session->set_userdata('sub_menu', 'Attendance/subject_attendence_report'); 
            $this->load->view('layout/header');
            $this->load->view('admin/leave_management/leave_report', $data);
            $this->load->view('layout/footer'); 
            }
            
            
            
            
            
            //Remove Class
            
            public function remove_class()
            {
                
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            
            $this->form_validation->set_rules('fromdate', $this->lang->line('fromdate'), 'required');
            $this->form_validation->set_rules('todate', $this->lang->line('todate'), 'required');
            $this->form_validation->set_rules('user[]', $this->lang->line('recipient'), 'required');
            $template_id = $this->input->post('class_template_id');
            if ($this->form_validation->run())
            {
            $section_id    = $this->input->post('section_id');
            $section       = $this->input->post('user[]');
            $class_id      = $this->input->post('class_id');
            $fromdate      = $this->input->post('fromdate');
            $todate        = $this->input->post('todate');
            
            $user_array    = array();
            $timetable     = array();
            foreach ($section as $section_key => $section_value)
            {
            $userlisting = $this->student_model->searchByClassSection($class_id, $section_value);
            if (!empty($userlisting)) 
            {
            for($i=$fromdate;$i<=$todate;$i++)
            {
            $day       = date('l', strtotime($i));
            $timetable = $this->leavecategory_model->gettimetable($class_id, $section_value,$day);
            foreach($timetable as $time)
            {
            foreach ($userlisting as $userlisting_key => $userlisting_value) 
            {
            $array = array(
            'user_id'  => $userlisting_value['id'],
            'session_id'    => $userlisting_value['student_session_id'],
            'send_mail'=>$i,
            );
            
            $attendencelist   = $this->leavecategory_model->get_attendencetails($userlisting_value['student_session_id'],$time['id'], $i);
            
            if($attendencelist!="")
            {
            $user_array[] = $array;
            $this->db->where(array('date'=> $i,'student_session_id'=>$userlisting_value['student_session_id'],'subject_timetable_id'=> $time['id']));
            $this->db->delete('student_subject_attendances');
            }
            }
            }
            $getleave   = $this->leavecategory_model->get_leavedetails($class_id, $section_value,$i);
            if($getleave!="")
            {
            $this->db->where(array('leave_catmanagement_date'=> $i,'leave_catmanagement_class'=>$class_id,'leave_catmanagement_section'=>  $section_value,'leave_catmanagement_session'=>  $this->current_session));
            $this->db->delete('leave_catmanagement');
            }
            }
            }
            }
            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('attendence_cancelled')));
            }
		    else
            {
            $data = array(
           'fromdate' => form_error('fromdate'),
           'todate'   => form_error('todate'),
           'user[]'   => form_error('user[]'),
            );
            echo json_encode(array('status' => 1, 'msg' => $data));
            }
            }
            
            
            
            public function remove_group_attendence()
            {
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $this->form_validation->set_rules('fromdate', $this->lang->line('fromdate'), 'required');
            $this->form_validation->set_rules('todate', $this->lang->line('todate'), 'required');
            $this->form_validation->set_rules('user[]', $this->lang->line('staff') . " " . $this->lang->line('to'), 'required');
            $template_id        = $this->input->post('group_template_id');
            $getusermobile      = "";
            if ($this->form_validation->run()) 
            {
            $user_array       = array();
            $fromdate         = $this->input->post('fromdate');
            $todate           = $this->input->post('todate');
           
            $data         = array(
            'is_group'    => 1,
            'title'       => $message_title,
            'message'     => $message,
            'send_mail'   => 0,
            'send_sms'    => 1,
            'group_list'  => json_encode(array()),
            'created_at'  => date('Y-m-d H:i:s'),
            'template_id' => $template_id,
            );
            
            $this->messages_model->add($data);
            $userlisting = $this->input->post('user[]'); 
            foreach ($userlisting as $users_key => $users_value) 
            {
                
            if ($users_value == "student")
            {
                
            $student_array = $this->student_model->get();
           
            if (!empty($student_array)) 
            {
            foreach ($student_array as $student_key => $student_value) 
            {
            $userlisting = $this->student_model->searchByClassSection($student_value['class_id'], $student_value['section_id']);
            if (!empty($userlisting)) 
            {
            for($i=$fromdate;$i<=$todate;$i++)
            {
            $day       = date('l', strtotime($i));
            $timetable = $this->leavecategory_model->gettimetable($student_value['class_id'], $student_value['section_id'],$day);
            
            foreach($timetable as $time)
            {
            foreach ($userlisting as $userlisting_key => $userlisting_value) 
            {
            $array = array(
            'user_id'  => $userlisting_value['id'],
            'session_id'    => $userlisting_value['student_session_id'],
            'send_mail'=>$i,
            );
            $attendencelist   = $this->leavecategory_model->get_attendencetails($userlisting_value['student_session_id'],$time['id'], $i);
            
            if($attendencelist!="")
            {
            $user_array[] = $array;
            $this->db->where(array('date'=> $i,'student_session_id'=>$userlisting_value['student_session_id'],'subject_timetable_id'=> $time['id']));
            $this->db->delete('student_subject_attendances');
            
            
            }
            }
            }
            
            $getleave   = $this->leavecategory_model->get_leavedetails($student_value['class_id'], $student_value['section_id'],$i);
            if($getleave!="")
            {
            $this->db->where(array('leave_catmanagement_date'=> $i,'leave_catmanagement_class'=>$class_id,'leave_catmanagement_section'=>  $section_value,'leave_catmanagement_session'=>  $this->current_session));
            $this->db->delete('leave_catmanagement');
            
            }
            }
            }
            }
            }
            } 
            else if (is_numeric($users_value)) 
            {
            $staff = $this->staff_model->getEmployeeByRoleID($users_value); 
            if (!empty($staff)) {
            foreach ($staff as $staff_key => $staff_value) 
            {
            for($i=$fromdate;$i<=$todate;$i++)
            {
            $getleave   = $this->leavecategory_model->get_staff_details($staff_value['id'], $i);
            if($getleave!="")
            {
            $this->db->where(array('staff_id'=> $staff_value['id'],'date'=>$i));
            $this->db->delete('staff_attendance');
            }
            }
            }
            }
            }
            }
            echo json_encode(array('status' => 0, 'msg' => $this->lang->line('attendence_cancelled')));
            } 
            else
            {
            $data = array(
           'fromdate' => form_error('fromdate'),
           'todate' => form_error('todate'),
           'group_send_by[]' => form_error('group_send_by[]'),
           'user[]'          => form_error('user[]'),
            );
            echo json_encode(array('status' => 1, 'msg' => $data));
            }
            }
            
            
            
        public function view_holidays()
        {
            
        // if (!$this->rbac->hasPrivilege('disable_student', 'can_view')) {
        //     access_denied();
        // }

            $this->session->set_userdata('top_menu', 'Attendance');
            $this->session->set_userdata('sub_menu', 'Attendance/leave_management/view_holidays'); 
        
        
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;
        $result                  = $this->student_model->getdisableStudent();
        $data["resultlist"]      = array();
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        $userdata                = $this->customlib->getUserData();
        $carray                  = array();
        $reason_list             = array();
          $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist'] = $this->studentsubjectattendence_model->attendanceYearCount();
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") 
        {

        } 
        else
        {
            $class       = $this->input->post('class_id');
            $section     = $this->input->post('section_id');
            $search      = $this->input->post('search');
            $month                       =    $this->input->post('month');
            $year                        =    $this->input->post('year');
            
        $data['year_no']             =    $year;
        $data['month']               =    $month;
          $from_date = 1;
         $month_number = date("m", strtotime($month));
        $to_date = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
       
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                    if ($this->form_validation->run() == false) {

                    } 
                    else 
                    {
                        $data['searchby']   = "filter";
                        $data['class_id']   = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist          = $this->leavecategory_model->search_byleavemanagement($class, $section, $from_date, $to_date, $year, $month_number);
                        $data['resultlist']  = $resultlist;
                    }
                } 
            }
        }

        $this->load->view("layout/header", $data);
        $this->load->view("admin/leave_management/view_holidays", $data);
        $this->load->view("layout/footer", $data);
        }
        
        
        
        
        public function remove_holiday()
        {
        // $query   = $this->db->get('leave_catmanagement');
        // $records = $query->result_array();
        // if (empty($records)) 
        // {
        // } 
        // else 
        // {
        // $this->db->insert_batch('leave_catmanagement_backup', $records);
        // } 
        
        
            
        $data['id']      = $this->input->post('id');   
        $data['class']   = $this->input->post('class');
        $data['section'] = $this->input->post('section'); 
        $data['date']    = $this->input->post('date'); 
        $id              = $data['id'];
        $class           = $data['class'];
        $section           = $data['section'];
        $date              = $data['date'];
        $data['resultlist']= $this->leavecategory_model->get_attendencelist($class,$section,$date);
        $resultlist        = $data['resultlist'];
        if (!empty($resultlist)) 
        {
        foreach ($resultlist as $record) 
        {
        $this->db->where(array('attendence_type_id'=> 5,'leavecategory_id!='=>'','id'=>$record['id']));
        $this->db->delete('student_subject_attendances'); 
        // $this->leavecategory_model->update_attendance_record($record['id'], $update_data);
        }
        echo "Attendance updated successfully!";
        } else {
        // Return a message indicating that no records were found
        echo "No records found for the specified class, section, and date.";
        }
        $this->db->where(array('leave_catmanagement_id'=> $id));
        $this->db->delete('leave_catmanagement'); 
        redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        }
