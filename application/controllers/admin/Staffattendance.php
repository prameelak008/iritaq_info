<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Staffattendance extends Admin_Controller {

        function __construct() 
        {
        parent::__construct();
        $this->load->helper('file');
        $this->config->load("mailsms");
        $this->config->load("payroll");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->staff_attendance  = $this->config->item('staffattendance');
        $this->load->model("staffattendancemodel");
        $this->load->model("staff_model");
        $this->load->model("payroll_model");
        }
        

        function index() 
        {
        if (!($this->rbac->hasPrivilege('staff_attendance', 'can_view') )) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/staffattendance');
        $data['title']        = 'Staff Attendance List';
        $data['title_list']   = 'Staff Attendance List';
        $user_type            = $this->staff_model->getStaffRole();
        $data['classlist']    = $user_type;
        $data['class_id']     = "";
        $data['section_id']   = "";
        $data['date']         = "";
        $user_type_id         = $this->input->post('user_id');
        $data["user_type_id"] = $user_type_id;
        if (!(isset($user_type_id))) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffattendance/staffattendancelist', $data);
            $this->load->view('layout/footer', $data);
        } 
        else
        {

            $user_type            = $this->input->post('user_id');
            $date                 = $this->input->post('date');
            $user_list            = $this->staffattendancemodel->get();
            $data['userlist']     = $user_list;
            $data['class_id']     = $user_list;
            $data['user_type_id'] = $user_type_id;
            $data['section_id']   = "";
            $data['date']         = $date;
            $search               = $this->input->post('search');
            $holiday              = $this->input->post('holiday');
            $this->session->set_flashdata('msg', '');
            if ($search == "saveattendence") {
                $user_type_ary = $this->input->post('student_session');
                $absent_student_list = array();
                foreach ($user_type_ary as $key => $value) {
                    $checkForUpdate = $this->input->post('attendendence_id' . $value);
                    if ($checkForUpdate != 0) {
                        if (isset($holiday)) {
                            $arr = array(
                                'id' => $checkForUpdate,
                                'staff_id' => $value,
                                'staff_attendance_type_id' => 5,
                                'remark' => $this->input->post("remark" . $value),
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date))
                            );
                        } else {
                            $arr = array(
                                'id' => $checkForUpdate,
                                'staff_id' => $value,
                                'staff_attendance_type_id' => $this->input->post('attendencetype' . $value),
                                'remark' => $this->input->post("remark" . $value),
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date))
                            );
                        }

                        $insert_id = $this->staffattendancemodel->add($arr);
                    } else {
                        if (isset($holiday)) {
                            $arr = array(
                                'staff_id' => $value,
                                'staff_attendance_type_id' => 5,
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)),
                                'remark' => ''
                            );
                        } else {
                            $arr = array(
                                'staff_id' => $value,
                                'staff_attendance_type_id' => $this->input->post('attendencetype' . $value),
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)),
                                'remark' => $this->input->post("remark" . $value),
                            );
                        }
                        $insert_id = $this->staffattendancemodel->add($arr);
                        $absent_config = $this->config_attendance['absent'];
                        if ($arr['staff_attendance_type_id'] == $absent_config) {
                            $absent_student_list[] = $value;
                        }
                    }
                }

                $absent_config = $this->config_attendance['absent'];
                if (!empty($absent_student_list)) {

                    $this->mailsmsconf->mailsms('absent_attendence', $absent_student_list, $date);
                }
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/staffattendance/index');
            }
            
            
            $data['staffabsent']            = $this->attendencetype_model->getStaffAbsent(date('Y-m-d', $this->customlib->datetostrtotime($date)));
            $attendencetypes                = $this->attendencetype_model->getStaffAttendanceType();
            $data['attendencetypeslist']    = $attendencetypes;
            $resultlist                     = $this->staffattendancemodel->searchAttendenceUserType($user_type, date('Y-m-d', $this->customlib->datetostrtotime($date)));
            $data['resultlist']             = $resultlist;
            
            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffattendance/staffattendancelist', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    
    

    function attendancereport()
    {

        if (!$this->rbac->hasPrivilege('staff_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendance');
        $this->session->set_userdata('subsub_menu', 'Reports/attendance/staff_attendance_report');
        $attendencetypes = $this->staffattendancemodel->getStaffAttendanceType();
        $data['attendencetypeslist'] = $attendencetypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["role"] = $staffRole;
        $data['title'] = 'Attendance Report';
        $data['title_list'] = 'Attendance';
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist'] = $this->staffattendancemodel->attendanceYearCount();
        $data['date'] = "";
        $data['month_selected'] = "";
        $data["role_selected"] = "";
        $role = $this->input->post("role");
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffattendance/attendancereport', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $resultlist = array();
            $month = $this->input->post('month');
            $searchyear = $this->input->post('year');
            $data['month_selected'] = $month;
            $data["role_selected"] = $role;
            $stafflist = $this->staff_model->getEmployee($role);
            $session_current = $this->setting_model->getCurrentSessionName();
            $startMonth = $this->setting_model->getStartMonth();
            $centenary = substr($session_current, 0, 2); //2017-18 to 2017
            $year_first_substring = substr($session_current, 2, 2); //2017-18 to 2017
            $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
            $month_number = date("m", strtotime($month));

            if ($month_number >= $startMonth && $month_number <= 12) {
                $year = $centenary . $year_first_substring;
            } else {
                $year = $centenary . $year_second_substring;
            }

            $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, $searchyear);
            $attr_result = array();
            $attendence_array = array();
            $student_result = array();
            $data['no_of_days'] = $num_of_days;
            $date_result = array();
            $monthAttendance = array();

            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date = $searchyear . "-" . $month_number . "-" . sprintf("%02d", $i);
                $attendence_array[] = $att_date;

                $res = $this->staffattendancemodel->searchAttendanceReport($role, $att_date);


                $student_result = $res;
                $s = array();
                foreach ($res as $result_k => $result_v) {

                    $date = $searchyear . "-" . $month;
                    $newdate = date('Y-m-d', strtotime($date));

                    $s[$result_v['id']] = $result_v;
                }

                $date_result[$att_date] = $s;
            }

            foreach ($res as $result_k => $result_v) {

                $date = $searchyear . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['id']);
            }

            $data['monthAttendance'] = $monthAttendance;
            $data['resultlist'] = $date_result;
            if (!empty($searchyear)) {
                $data['attendence_array'] = $attendence_array;
                $data['student_array'] = $student_result;
            } else {

                $data['attendence_array'] = array();
                $data['student_array'] = array();
            }
 
            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffattendance/attendancereport', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    
    
    
    
        function attendancereportbyhour() 
        {
        if (!$this->rbac->hasPrivilege('staff_attendance_report', 'can_view')) 
        {
        access_denied();
        }

        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/attendance');
        $this->session->set_userdata('subsub_menu', 'Reports/attendance/staff_attendance_report');
        //$attendencetypes = $this->staffattendancemodel->getStaffAttendanceType();

       $attendencetypes = $this->attendencetype_model->getStaffLeaveType();

        $data['attendencetypeslist'] = $attendencetypes;
        $staffRole = $this->staff_model->getStaffRole();
        $data["role"] = $staffRole;
        $data['title'] = 'Attendance Report';
        $data['title_list'] = 'Attendance';
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist'] = $this->staffattendancemodel->attendanceYearCount();
        $data['date'] = "";
        $data['month_selected'] = "";
        $data["role_selected"] = "";
        $role = $this->input->post("role");
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required|xss_clean');



        if ($this->form_validation->run() == FALSE)
         {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffattendance/attendancereportbyhour', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $resultlist = array();
            $month = $this->input->post('month');
            $searchyear = $this->input->post('year');
            $data['month_selected'] = $month;
            $data["role_selected"] = $role;
            $stafflist = $this->staff_model->getEmployee($role);
            $session_current = $this->setting_model->getCurrentSessionName();
            $startMonth = $this->setting_model->getStartMonth();
            $centenary = substr($session_current, 0, 2); //2017-18 to 2017
            $year_first_substring = substr($session_current, 2, 2); //2017-18 to 2017
            $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
            $month_number = date("m", strtotime($month));

            if ($month_number >= $startMonth && $month_number <= 12) {
            $year = $centenary . $year_first_substring;
            } 
            else 
            {
            $year = $centenary . $year_second_substring;
            }

            $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, $searchyear);
            $attr_result = array();
            $attendence_array = array();
            $student_result = array();
            $data['no_of_days'] = $num_of_days;
            $date_result = array();
            $monthAttendance = array();

            $data['numberatt_date'] = $searchyear . "-" . $month_number . "-" .$num_of_days;
            $data['att_date']       = $searchyear . "-" . $month_number . "-" ."01";

            for ($i = 1; $i <= $num_of_days; $i++) {
            $att_date = $searchyear . "-" . $month_number . "-" . sprintf("%02d", $i);
            $attendence_array[] = $att_date;

            $res                        =  $this->staffattendancemodel->searchAttendanceReportbyhour($role, $att_date,$numberatt_date);

            $data['res_leave']          =  $res; 

           $data['staffs_results']      = $this->staffattendancemodel->staff();

            $data['leavetypes_result']  = $this->staffattendancemodel->leave_typess();


            $data['staff_leave_request'] = $this->staffattendancemodel->staff_leave_request();

                $student_result = $res;
                $s = array();

                foreach ($res as $result_k => $result_v) {

                    $date = $searchyear . "-" . $month;
                    $newdate = date('Y-m-d', strtotime($date));

                    $s[$result_v['id']] = $result_v;
                }

                $date_result[$att_date] = $s;
            }

            foreach ($res as $result_k => $result_v)
             {

                $date = $searchyear . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['id']);
            }

            //$data['monthAttendance'] = $monthAttendance;
            $data['resultlist'] = $date_result;
            if (!empty($searchyear)) {
                $data['attendence_array']     = $attendence_array;
                $data['student_array']        = $student_result;
            } 
            else 
            {
            $data['attendence_array']     = array();
            $data['student_array']        = array();
            }
 
            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffattendance/attendancereportbyhour', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    

    function monthAttendance($st_month, $no_of_months, $emp) 
    {

        $this->load->model("payroll_model");
        $record = array();

        $r = array();
        $month = date('m', strtotime($st_month));
        $year = date('Y', strtotime($st_month));

        foreach ($this->staff_attendance as $att_key => $att_value) {

            $s = $this->payroll_model->count_attendance_obj($month, $year, $emp, $att_value);

            $r[$att_key] = $s;
        }

        $record[$emp] = $r;

        return $record;
    }




    function profileattendance() 
    {
        $monthlist = $this->customlib->getMonthDropdown();
        $startMonth = $this->setting_model->getStartMonth();
        $data["monthlist"] = $monthlist;
        $data['yearlist'] = $this->staffattendancemodel->attendanceYearCount();
        $staffRole = $this->staff_model->getStaffRole();
        $data["role"] = $staffRole;
        $data["role_selected"] = "";
        $j = 0;
        for ($i = 1; $i <= 31; $i++) 
        {

            $att_date = sprintf("%02d", $i);
            $attendence_array[] = $att_date;
            foreach ($monthlist as $key => $value) {

                $datemonth = date("m", strtotime($value));
                $att_dates = date("Y") . "-" . $datemonth . "-" . sprintf("%02d", $i);
                $date_array[] = $att_dates;
                $res[$att_dates] = $this->staffattendancemodel->searchStaffattendance($att_dates, $staff_id = 8);
            }

            $j++;
        }

        $data["resultlist"] = $res;
        $data["attendence_array"] = $attendence_array;
        $data["date_array"] = $date_array;

        $this->load->view("layout/header");
        $this->load->view("admin/staff/staffattendance", $data);
        $this->load->view("layout/footer");
    }
    
    
    
    /*...............................................................Biometeric Add And Retrieve...................................*/
    
    
                    public function AddEmployee()
                    {
                    $soapUrl = "http://192.168.1.140/iclock/WebAPIService.asmx";  // Replace with your device's IP
                    $soapAction = "http://tempuri.org/AddEmployee";
                    
                    // Prepare your employee details
                    $employeeCode = "E001";  // Unique Employee Code
                    $employeeName = "John Doe";  // Employee Name
                    $cardNumber = "123456";  // Card Number
                    $serialNumber = "001";  // Serial Number (device specific)
                    $username = "admin";  // Username for authentication
                    $password = "admin123";  // Password for authentication
                    $apiKey = "your_api_key";  // API Key if required
                    $commandId = 1;  // Command ID (specific to your system)
                    
                    // Sanitize inputs (for example, avoid XML injection)
                    $employeeCode = htmlspecialchars($employeeCode, ENT_QUOTES, 'UTF-8');
                    $employeeName = htmlspecialchars($employeeName, ENT_QUOTES, 'UTF-8');
                    $cardNumber = htmlspecialchars($cardNumber, ENT_QUOTES, 'UTF-8');
                    $serialNumber = htmlspecialchars($serialNumber, ENT_QUOTES, 'UTF-8');
                    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
                    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
                    $apiKey = htmlspecialchars($apiKey, ENT_QUOTES, 'UTF-8');
                    
                    // Create the SOAP XML Request
                    $xmlRequest = '<?xml version="1.0" encoding="utf-8"?>' .
                    '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
                    'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
                    'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
                    '<soap:Body>' .
                    '<AddEmployee xmlns="http://tempuri.org/">' .
                    '<APIKey>' . $apiKey . '</APIKey>' .
                    '<EmployeeCode>' . $employeeCode . '</EmployeeCode>' .
                    '<EmployeeName>' . $employeeName . '</EmployeeName>' .
                    '<CardNumber>' . $cardNumber . '</CardNumber>' .
                    '<SerialNumber>' . $serialNumber . '</SerialNumber>' .
                    '<UserName>' . $username . '</UserName>' .
                    '<UserPassword>' . $password . '</UserPassword>' .
                    '<CommandId>' . $commandId . '</CommandId>' .
                    '</AddEmployee>' .
                    '</soap:Body>' .
                    '</soap:Envelope>';
                    
                    $options = [
                    'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-Type: text/xml; charset=utf-8\r\n" .
                    "SOAPAction: $soapAction\r\n",
                    'content' => $xmlRequest
                    ]
                    ];
                    
                    // Use stream_context_create to initiate the SOAP request
                    $context = stream_context_create($options);
                    
                    // Execute the request and capture the response
                    $response = @file_get_contents($soapUrl, false, $context);
                    
                    // Check if the request was successful
                    if ($response === FALSE) {
                    // Log the error or handle it gracefully
                    echo "Error: Unable to communicate with the device.";
                    return;
                    }
                    
                    // Parse the response (optional, based on what the device returns)
                    // Assuming the response contains XML and includes a field like AddEmployeeResult
                    $xml = simplexml_load_string($response);
                    if ($xml === false) {
                    echo "Error: Failed to parse the response XML.";
                    return;
                    }
                    
                    // Check if the employee was added successfully (this part depends on the API response structure)
                    // For example, assuming the success/failure result is inside <AddEmployeeResult>
                    $result = (string) $xml->xpath('//AddEmployeeResult')[0];  // Replace with the actual field from the response
                    
                    if ($result == "Success") {
                    echo "Employee added successfully!";
                    } else {
                    echo "Failed to add employee. Response: " . $result;
                    }
                    }
                    
                    
                    
                    public function storeAttendance_1()
                    {
                    $json           = file_get_contents('php://input');
                    $attendanceData = json_decode($json, true);
                    
                    print_r($attendanceData);
                    
                    
                    $attendanceData['EmployeeCode']   =   '41';
                    $attendanceData['AttendanceTime'] =   '2024-03-09 07:28:16';
                    $attendanceData['Status']         =   '1';
                    $attendanceData['DeviceSerial']   =   'hiiiiiiiiiiiii';
                    
                    // Extract the relevant data from the $attendanceData (sent by the biometric device)
                    
                    $staffId        = $attendanceData['EmployeeCode'];  // Assuming 'EmployeeCode' corresponds to 'staff_id'
                    $attendanceTime = $attendanceData['AttendanceTime'];  // Device time, use as is or adjust format
                    $status         = $attendanceData['Status'];  // This would be 'IN' or 'OUT' to determine attendance type
                    $deviceSerial   = $attendanceData['DeviceSerial'];  // Device serial number, can be used for remarks
                    
                    // Determine attendance type based on status (you need to map the status to 'staff_attendance_type_id')
                    $attendanceTypeId = ($status == 'IN') ? 1 : 2;  // Example: 1 for IN, 2 for OUT (adjust as needed)
                    
                    // If AttendanceTime is in a specific format, parse it, otherwise use as is.
                    // Ensure the AttendanceTime is in the format 'Y-m-d H:i:s'
                    $attendanceTime = date("Y-m-d H:i:s", strtotime($attendanceTime));  // Convert if necessary
                    
                    // You can add remarks based on your business logic or device data (optional)
                    $remark = "Attendance recorded from device serial: " . $deviceSerial;
                    
                    // Set status to active, assuming 1 means active
                    $isActive = 1;  // Assuming 1 is active, you can adjust this as needed
                    
                    // Set calendar and category ID (you may change these values as needed)
                    $calendarId = 1;  // Example, adjust based on your logic
                    $categoryId = 25;  // Example, adjust based on your logic
                    
                    // Prepare data array for insertion into the database
                    $data = array(
                    'date'       => $attendanceTime,  // Use AttendanceTime for the date
                    'staff_id'   => $staffId,
                    'staff_attendance_type_id' => '1',
                    'is_active'  => $isActive,
                    'created_at' => date("Y-m-d H:i:s"),  // Current timestamp
                    'updated_at' => date("Y-m-d H:i:s"),  // Current timestamp (set dynamically)
                    'calender_id'=> $calendarId,
                    'categoryid' => $categoryId,
                    'remark'     => $deviceSerial
                    );
                    // Use CodeIgniter's Active Record to insert the attendance data
                    
                    
                    if ($this->db->insert('staff_attendance', $data)) 
                    {
                    echo "Successfully inserted the attendance record";
                    // return true;
                    }
                    else
                    {
                    echo "Failed to insert the record";
                    // return false;
                    }
                    }
                    
                    
                    
                    
                    public function storeAttendance()
                    {
                    header('Content-Type: application/json');
                    // Get the raw JSON input
                    $json           = file_get_contents('php://input');
                    $attendanceData = json_decode($json, true);
                    
                    
                    
                    if (!$attendanceData) 
                    {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Invalid or empty JSON']);
                    return;
                    }
                    
                    // FOR TESTING: Overriding with dummy data
                    $attendanceData['EmployeeCode']   = '41';
                    $attendanceData['AttendanceTime'] = '2024-03-09 07:28:16';
                    $attendanceData['Status']         = '1';  // Or 'IN'/'OUT'
                    $attendanceData['DeviceSerial']   = 'hiiiiiiiiiiiii';
                    
                    // Extract fields
                    $staffId        = $attendanceData['EmployeeCode'];
                    $attendanceTime = date("Y-m-d H:i:s", strtotime($attendanceData['AttendanceTime']));
                    $status         = $attendanceData['Status'];
                    $deviceSerial   = $attendanceData['DeviceSerial'];
                    
                    // Map Status to attendance type (adjust this logic as per actual values)
                    $attendanceTypeId = ($status == 'IN' || $status == '1') ? 1 : 2;
                    
                    $remark           = "Attendance recorded from device serial: " . $deviceSerial;
                    
                    $data             = [
                    'date'                     => $attendanceTime,
                    'staff_id'                 => $staffId,
                    'staff_attendance_type_id' => $attendanceTypeId,
                    'is_active'                => 1,
                    'created_at'               => date("Y-m-d H:i:s"),
                    'updated_at'               => date("Y-m-d H:i:s"),
                    'calender_id'              => 1,
                    'categoryid'               => 25,
                    'remark'                   => $remark,
                    ];
                    
                    if ($this->db->insert('staff_attendance', $data)) 
                    {
                    echo json_encode(['status' => 'success', 'message' => 'Attendance recorded']);
                    } 
                    else 
                    {
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Database insertion failed']);
                    }
                    }
    
                    }


?>