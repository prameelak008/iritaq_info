<?php

class Payroll extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->config->load("mailsms");
        $this->config->load("payroll");
        $this->load->library('mailsmsconf');
        $this->config_attendance = $this->config->item('attendence');
        $this->staff_attendance  = $this->config->item('staffattendance');
        $this->payment_mode      = $this->config->item('payment_mode');
        $this->load->model("payroll_model");
        $this->load->model("staff_model");
        $this->load->model('staffattendancemodel');
        $this->payroll_status     = $this->config->item('payroll_status');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->current_session    = $this->setting_model->getCurrentSession();
    }
    
    

    public function index()
    {
        if (!$this->rbac->hasPrivilege('staff_payroll', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/payroll');
        $data["staff_id"]            = "";
        $data["name"]                = "";
        $data["month"]               = date("F", strtotime("-1 month"));
        $data["year"]                = date("Y");
        $data["present"]             = 0;
        $data["absent"]              = 0;
        $data["late"]                = 0;
        $data["half_day"]            = 0;
        $data["holiday"]             = 0;
        $data["leave_count"]         = 0;
        $data["alloted_leave"]       = 0;
        $data["basic"]               = 0;
        $data["payment_mode"]        = $this->payment_mode;
        $user_type                   = $this->staff_model->getStaffRole();
        $data['classlist']           = $user_type;
        $data['monthlist']           = $this->customlib->getMonthDropdown();
        $data['sch_setting']         = $this->sch_setting_detail;
        $data['staffid_auto_insert'] = $this->sch_setting_detail->staffid_auto_insert;
        $submit                      = $this->input->post("search");
        $data["formats"]             = $this->input->post('format');
       // $data["formats"]   = $formats;
        if (isset($submit) && $submit == "search") {

            $month    = $this->input->post("month");
            $year     = $this->input->post("year");
            $emp_name = $this->input->post("name");
            $role     = $this->input->post("role");

            $searchEmployee = $this->payroll_model->searchEmployee($month, $year, $emp_name, $role);

            $data["resultlist"] = $searchEmployee;
            $data["name"]       = $emp_name;
            $data["month"]      = $month;
            $data["year"]       = $year;
        }

        $data["payroll_status"] = $this->payroll_status;
        $this->load->view("layout/header", $data);
        $this->load->view("admin/payroll/stafflist", $data);
        $this->load->view("layout/footer", $data);
    }

    public function create($month, $year, $id)
    {

        $data["staff_id"]            = "";
        $data["basic"]               = "";
        $data["name"]                = "";
        $data["month"]               = "";
        $data["year"]                = "";
        $data["present"]             = 0;
        $data["absent"]              = 0;
        $data["late"]                = 0;
        $data["half_day"]            = 0;
        $data["holiday"]             = 0;
        $data["leave_count"]         = 0;
        $data["alloted_leave"]       = 0;
        $data['sch_setting']         = $this->sch_setting_detail;
        $data['staffid_auto_insert'] = $this->sch_setting_detail->staffid_auto_insert;
        $user_type                   = $this->staff_model->getStaffRole();
        $data['classlist']           = $user_type;

        $date = $year . "-" . $month;

        $searchEmployee = $this->payroll_model->searchEmployeeById($id);

        $data['result'] = $searchEmployee;
        $data["month"]  = $month;
        $data["year"]   = $year;

        $alloted_leave = $this->staff_model->alloted_leave($id);

        $newdate = date('Y-m-d', strtotime($date . " +1 month"));

        $data['monthAttendance'] = $this->monthAttendance($newdate, 3, $id);
        $data['monthLeaves']     = $this->monthLeaves($newdate, 3, $id);

        $data["attendanceType"] = $this->staffattendancemodel->getStaffAttendanceType();

        $data["alloted_leave"] = $alloted_leave[0]["alloted_leave"];
       
        $staff_id=$id;
        //$data["leave"]      = $this->payroll_model->getLeave($staff_id,$data["year"],$data["m"]);
        //$data["absent"]     = $this->payroll_model->getAbsentcount($staff_id,$data["year"],$data["m"]);
        
        $data["getdedhrs"]     = $this->payroll_model->getAbsentcount($staff_id);
        $getdedhrs = $data["getdedhrs"];
        //split from and to dates of leave deduction by leave type id, find sum
        $data['getmonth']           =   $data['month'];
        $data['getyear']            =   $data['year'];
        $getyear = $data['getyear'];
        $getmonth =  $data['getmonth'];
        $mo= date('m', strtotime($getmonth));
        $mn = ltrim($mo, '0');
        $data["d"] = cal_days_in_month(CAL_GREGORIAN,$mn,$getyear);
        $firstdate=($getyear.'-'.$mo.'-'.'01'.''.'00:00' );
        $lastdate=($getyear.'-'.$mo.'-'.$data["d"].''.'23:59' );

        foreach($getdedhrs as $getdata)
        {
        $getfrom     = $getdata['leave_from'].''.$getdata['leave_fromtime']; 
        $getto       = $getdata['leave_to'].''.$getdata['leave_totime'];
        if (strtotime($getfrom) <= strtotime($firstdate)) 
        {
        $start       = strtotime($firstdate);
        }
        else
        {
        $start       = strtotime($getfrom);                         
        }
        if (strtotime($getto) >= strtotime($lastdate)) 
        {
        $end       =   strtotime($lastdate); 
        }
        else
        {
        $end       =   strtotime($getto);
        }

        $range       = array();
        $dates        = strtotime("-1 day", $start);
        if($dates < $end) 
        {
        $dates         = strtotime("+1 day", $dates); 
        $daterange    = date('Y-m-d H:i', $dates); 
        $endrange    = date('Y-m-d H:i', $end);
        $datetime1 = strtotime($daterange);
        $datetime2 = strtotime($endrange);
        $diff = $datetime2-$datetime1;

        $hrs = floor($diff/3600);
        $remain = $diff - $hrs * 3600;
        $formatdiff[]= sprintf('%02d',$hrs).gmdate(':i:s',$remain);
        }
        }
        
        $hours = 0;
        $minutes = 0;
        foreach($formatdiff as $value)
         {
        $value_explode = explode(':', $value);
        $hours += $value_explode[0];
        $minutes += $value_explode[1];
        if($minutes > 60) {
        $hours += 1;
        $minutes = $minutes % 60;
        }
        }
        $dedhr = sprintf('%02d:%02d', $hours, $minutes);
        $data["deduction_hr"] = $dedhr;
        
        $this->load->view("layout/header", $data);
        $this->load->view("admin/payroll/create", $data);
        $this->load->view("layout/footer", $data);
    }

    public function monthAttendance($st_month, $no_of_months, $emp)
    {
        $record = array();
        for ($i = 1; $i <= $no_of_months; $i++) {

            $r     = array();
            $month = date('m', strtotime($st_month . " -$i month"));
            $year  = date('Y', strtotime($st_month . " -$i month"));

            foreach ($this->staff_attendance as $att_key => $att_value) {

                $s = $this->payroll_model->count_attendance_obj($month, $year, $emp, $att_value);

                $r[$att_key] = $s;
            }

            $record['01-' . $month . '-' . $year] = $r;
        }
        return $record;
    }

    public function monthLeaves($st_month, $no_of_months, $emp)
    {
        $record = array();
        for ($i = 1; $i <= $no_of_months; $i++) {

            $r           = array();
            $month       = date('m', strtotime($st_month . " -$i month"));
            $year        = date('Y', strtotime($st_month . " -$i month"));
            $leave_count = $this->staff_model->count_leave($month, $year, $emp);
            if (!empty($leave_count["tl"])) {
                $l = $leave_count["tl"];
            } else {
                $l = "0";
            }

            $record[$month] = $l;
        }

        return $record;
    }

    public function payslip()
    {
        if (!$this->rbac->hasPrivilege('staff_payroll', 'can_add')) {
            access_denied();
        }

        $basic           = $this->input->post("basic");
        $total_allowance = $this->input->post("total_allowance");
        $total_deduction = $this->input->post("total_deduction");
        $net_salary      = $this->input->post("net_salary");
        $status          = $this->input->post("status");
        $staff_id        = $this->input->post("staff_id");
        $month           = $this->input->post("month");
        $name            = $this->input->post("name");
        $year            = $this->input->post("year");
        $tax             = $this->input->post("tax");
        $leave_deduction = $this->input->post("leave_deduction");
        $this->form_validation->set_rules('net_salary', 'Net Salary', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $this->create($month, $year, $staff_id);
        } else {

            $data = array('staff_id' => $staff_id,
                'basic'                  => $basic,
                'total_allowance'        => $total_allowance,
                'total_deduction'        => $total_deduction,
                'net_salary'             => $net_salary,
                'payment_date'           => date("Y-m-d"),
                'status'                 => $status,
                'month'                  => $month,
                'year'                   => $year,
                'tax'                    => $tax,
                'leave_deduction'        => $leave_deduction,
            );

            $checkForUpdate = $this->payroll_model->checkPayslip($month, $year, $staff_id);

            if ($checkForUpdate == true) {

                $insert_id        = $this->payroll_model->createPayslip($data);
                $payslipid        = $insert_id;
                $allowance_type   = $this->input->post("allowance_type");
                $deduction_type   = $this->input->post("deduction_type");
                $allowance_amount = $this->input->post("allowance_amount");
                $deduction_amount = $this->input->post("deduction_amount");
                if (!empty($allowance_type)) {

                    $i = 0;
                    foreach ($allowance_type as $key => $all) {

                        $all_data = array(
                            'payslip_id'     => $payslipid,
                            'allowance_type' => $allowance_type[$i],
                            'amount'         => $allowance_amount[$i],
                            'staff_id'       => $staff_id,
                            'cal_type'       => "positive",
                        );

                        $insert_payslip_allowance = $this->payroll_model->add_allowance($all_data);

                        $i++;
                    }
                }

                if (!empty($deduction_type)) {
                    $j = 0;
                    foreach ($deduction_type as $key => $type) {

                        $type_data = array('payslip_id' => $payslipid,
                            'allowance_type'                => $deduction_type[$j],
                            'amount'                        => $deduction_amount[$j],
                            'staff_id'                      => $staff_id,
                            'cal_type'                      => "negative",
                        );

                        $insert_payslip_allowance = $this->payroll_model->add_allowance($type_data);

                        $j++;
                    }
                }

                redirect('admin/payroll');
            } else {

                $this->session->set_flashdata("msg", $this->lang->line('payslip_already_generated'));
                redirect('admin/payroll');
            }
        }
    }

    public function search($month, $year, $role = '')
    {

        $user_type         = $this->staff_model->getStaffRole();
        $data['classlist'] = $user_type;
        $data['monthlist'] = $this->customlib->getMonthDropdown();

        $searchEmployee    = $this->payroll_model->searchEmployee($month, $year, $emp_name = '', $role);

        $data["resultlist"]     = $searchEmployee;
        $data["name"]           = $emp_name;
        $data["month"]          = $month;
        $data["year"]           = $year;
        $data['sch_setting']    = $this->sch_setting_detail;
        $data["payroll_status"] = $this->payroll_status;
        $data["resultlist"]     = $searchEmployee;
        $data["payment_mode"]   = $this->payment_mode;
        $this->load->view("layout/header", $data);
        $this->load->view("admin/payroll/stafflist", $data);
        $this->load->view("layout/footer", $data);
    }

    public function paymentRecord()
    {

        $month          = $this->input->get_post("month");
        $year           = $this->input->get_post("year");
        $id             = $this->input->get_post("staffid");
        $searchEmployee = $this->payroll_model->searchPayment($id, $month, $year);
        $data['result'] = $searchEmployee;
        $data["month"]  = $month;
        $data["year"]   = $year;
        echo json_encode($data);
    }

    public function paymentStatus($status)
    {

        $id          = $this->input->get('id');
        $updateStaus = $this->payroll_model->updatePaymentStatus($status, $id);
        redirect("admin/payroll");
    }

    public function paymentSuccess()
    {

        $payment_mode = $this->input->post("payment_mode");
        $date         = $this->input->post("payment_date");
        $payment_date = date('Y-m-d', strtotime($date));
        $remark       = $this->input->post("remarks");
        $status       = 'paid';
        $payslipid    = $this->input->post("paymentid");
        $this->form_validation->set_rules('payment_mode', $this->lang->line('payment') . " " . $this->lang->line('mode'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $msg = array(
                'payment_mode' => form_error('payment_mode'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $data = array('payment_mode' => $payment_mode, 'payment_date' => $payment_date, 'remark' => $remark, 'status' => $status);
            $this->payroll_model->paymentSuccess($data, $payslipid);
            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
        }
        echo json_encode($array);
    }
    
    
    
   /* 
    public function payslipviewformattwo()
    {
        if (!$this->rbac->hasPrivilege('staff', 'can_view')) {
            access_denied();
        }
        $data["payment_mode"] = $this->payment_mode;
        $this->load->model("setting_model");
        $setting_result      = $this->setting_model->get();
        $data['settinglist'] = $setting_result[0];
        $id                  = $this->input->post("payslipid");
        $result              = $this->payroll_model->getPayslip($id);
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['staffid_auto_insert'] = $this->sch_setting_detail->staffid_auto_insert;
        
        
        if (!empty($result)) {
            $allowance                  = $this->payroll_model->getAllowance($result["id"]);
            $data["allowance"]          = $allowance;
            $positive_allowance         = $this->payroll_model->getAllowance($result["id"], "positive");
            $data["positive_allowance"] = $positive_allowance;
            $negative_allowance         = $this->payroll_model->getAllowance($result["id"], "negative");
            $data["negative_allowance"] = $negative_allowance;
            //$leavedetails               = $this->payroll_model->getLeave($result["staff_id"]);
            if ($result["month"]=='December') 
    {
      $result["m"]='12';
    }
    else if($result["month"]=='November') 
    {
      $result["m"]='11';
    }
    else if ($result["month"]=='October') 
    {
      $result["m"]='10';
    }
    else if ($result["month"]=='September') 
    {
      $result["m"]='9';
    }
    else if ($result["month"]=='August') 
    {
      $result["m"]='8';
    }
    else if ($result["month"]=='July') 
    {
      $result["m"]='7';
    }
    else if ($result["month"]=='June') 
    {
      $result["m"]='6';
    }
    else if ($result["month"]=='May') 
    {
      $result["m"]='5';
    }
    else if ($result["month"]=='April') 
    {
      $result["m"]='4';
    }
    else if ($result["month"]=='March') 
    {
      $result["m"]='3';
    }                                                           
    else if ($result["month"]=='February') 
    {
      $result["m"]='2';
    }
    else if ($result["month"]=='January')
    {
      $result["m"]='1';
    }
        $data["leave"]      = $this->payroll_model->getLeave($result["staff_id"],$result["year"],$result["m"]);
        //$data["leavebal"] = $this->payroll_model->getLeaveBal($result["staff_id"]);
        //$data["thismonth"]  = $this->payroll_model->getthismonth($result["staff_id"]);
                       
        $data["result"]     = $result;
        $this->load->view("admin/payroll/payslipviewformattwo", $data);
        } else {
            echo "<div class='alert alert-info'>No Record Found.</div>";
        }
    }
    
    
  */
  
  
  
  
  
        public function payslipviewformattwo()
        {
        if (!$this->rbac->hasPrivilege('staff', 'can_view')) {
            access_denied();
        }
        
        $data['current_session']           = $this->current_session;
        $current_session                   = $data['current_session'];
        $data["payment_mode"]      = $this->payment_mode;
        $this->load->model("setting_model");
        $setting_result            = $this->setting_model->get();
        $data['settinglist']       = $setting_result[0];
        $id                        = $this->input->post("payslipid");
        $result                    = $this->payroll_model->getPayslip($id);

        $data['sch_setting']         = $this->sch_setting_detail;
        $data['staffid_auto_insert'] = $this->sch_setting_detail->staffid_auto_insert; 

        $getmonth                  = $result['month'];
        $getyear                   = $result['year'];
             
        
            if (!empty($result))
            {
            $allowance                  = $this->payroll_model->getAllowance($result["id"]);
            $data["allowance"]          = $allowance;
            $positive_allowance         = $this->payroll_model->getAllowance($result["id"], "positive");
            $data["positive_allowance"] = $positive_allowance;
            $negative_allowance         = $this->payroll_model->getAllowance($result["id"], "negative");
            $data["negative_allowance"] = $negative_allowance;
            //$leavedetails             = $this->payroll_model->getLeave($result["staff_id"]);
            $data["result"]             = $result;


            $data["active_leavetypes"]  = $this->payroll_model->get_leavetypes();
            $data['staff_id']           = $result["staff_id"];
            
            $data["leavedetails"]       = $this->payroll_model->get_leavedetails($result["staff_id"]);
            
            $data['getmonth']           = $result['month'];
            $data['getyear']            = $result['year'];
            $data["leavedetails"]       = $this->payroll_model->getmonthused($result["staff_id"]);
        


        //$data["leavebal"] = $this->payroll_model->getLeaveBal($result["staff_id"]);
        //$data["thismonth"]  = $this->payroll_model->getthismonth($result["staff_id"]);
                       
        $data["result"]     = $result;
        $this->load->view("admin/payroll/payslipviewformattwo", $data);
        } 
        else
        {
        echo "<div class='alert alert-info'>No Record Found.</div>";
        }
        }
    
    
    
    

public function payslipviewformatone()
    {
        if (!$this->rbac->hasPrivilege('staff', 'can_view')) {
            access_denied();
        }
        $data["payment_mode"] = $this->payment_mode;
        $this->load->model("setting_model");
        $setting_result      = $this->setting_model->get();
        $data['settinglist'] = $setting_result[0];
        $id                  = $this->input->post("payslipid");
        $result              = $this->payroll_model->getPayslip($id);
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['staffid_auto_insert'] = $this->sch_setting_detail->staffid_auto_insert;
        if (!empty($result)) {
            $allowance                  = $this->payroll_model->getAllowance($result["id"]);
            $data["allowance"]          = $allowance;
            $positive_allowance         = $this->payroll_model->getAllowance($result["id"], "positive");
            $data["positive_allowance"] = $positive_allowance;
            $negative_allowance         = $this->payroll_model->getAllowance($result["id"], "negative");
            $data["negative_allowance"] = $negative_allowance;
            if ($result["month"]=='December') 
    {
      $result["m"]='12';
    }
    else if($result["month"]=='November') 
    {
      $result["m"]='11';
    }
    else if ($result["month"]=='October') 
    {
      $result["m"]='10';
    }
    else if ($result["month"]=='September') 
    {
      $result["m"]='9';
    }
    else if ($result["month"]=='August') 
    {
      $result["m"]='8';
    }
    else if ($result["month"]=='July') 
    {
      $result["m"]='7';
    }
    else if ($result["month"]=='June') 
    {
      $result["m"]='6';
    }
    else if ($result["month"]=='May') 
    {
      $result["m"]='5';
    }
    else if ($result["month"]=='April') 
    {
      $result["m"]='4';
    }
    else if ($result["month"]=='March') 
    {
      $result["m"]='3';
    }                                                           
    else if ($result["month"]=='February') 
    {
      $result["m"]='2';
    }
    else if ($result["month"]=='January')
    {
      $result["m"]='1';
    }
        $data["leave"]      = $this->payroll_model->getLeave($result["staff_id"],$result["year"],$result["m"]);
            $data["result"]             = $result;
        $this->load->view("admin/payroll/payslipviewformatone", $data);
        } else {
            echo "<div class='alert alert-info'>No Record Found.</div>";
        }
    }
    // $data["leavetypes"]         = $this->payroll_model->getLeaveTypes();
            // $this->db->select("types");
            // $query=$this->db->get("leave_types");
            // return query->result;


    public function payslippdf()
    {

        $this->load->model("setting_model");
        $setting_result             = $this->setting_model->get();
        $data['settinglist']        = $setting_result[0];
        $id                         = 15;
        $result                     = $this->payroll_model->getPayslip($id);
        $allowance                  = $this->payroll_model->getAllowance($result["id"]);
        $data["allowance"]          = $allowance;
        $positive_allowance         = $this->payroll_model->getAllowance($result["id"], "positive");
        $data["positive_allowance"] = $positive_allowance;
        $negative_allowance         = $this->payroll_model->getAllowance($result["id"], "negative");
        $data["negative_allowance"] = $negative_allowance;
        $data["result"]             = $result;
        $this->load->view("admin/payroll/payslippdf", $data);
    }

    public function payrollreport()
    {
        if (!$this->rbac->hasPrivilege('payroll_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/human_resource');
        $this->session->set_userdata('subsub_menu', 'Reports/attendance/attendance_report');
        $month                = $this->input->post("month");
        $year                 = $this->input->post("year");
        $role                 = $this->input->post("role");
        $data["month"]        = $month;
        $data["year"]         = $year;
        $data["role_select"]  = $role;
        $data['monthlist']    = $this->customlib->getMonthDropdown();
        $data['yearlist']     = $this->payroll_model->payrollYearCount();
        $staffRole            = $this->staff_model->getStaffRole();
        $data["role"]         = $staffRole;
        $data["payment_mode"] = $this->payment_mode;

        $this->form_validation->set_rules('year', $this->lang->line('year'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {

            $this->load->view("layout/header", $data);
            $this->load->view("admin/payroll/payrollreport", $data);
            $this->load->view("layout/footer", $data);
        } else {

            $result         = $this->payroll_model->getpayrollReport($month, $year, $role);
            $data["result"] = $result;
            $this->load->view("layout/header", $data);
            $this->load->view("admin/payroll/payrollreport", $data);
            $this->load->view("layout/footer", $data);
        }
    }

    public function deletepayroll($payslipid, $month, $year, $role = '')
    {
        if (!$this->rbac->hasPrivilege('staff_payroll', 'can_delete')) {
            access_denied();
        }
        if (!empty($payslipid)) {

            $this->payroll_model->deletePayslip($payslipid);
        }

        redirect('admin/payroll/search/' . $month . "/" . $year . "/" . $role);
    }

    public function revertpayroll($payslipid, $month, $year, $role = '')
    {

        if (!$this->rbac->hasPrivilege('staff_payroll', 'can_delete')) {
            access_denied();
        }
        if (!empty($payslipid)) {

            $this->payroll_model->revertPayslipStatus($payslipid);
        }
        redirect('admin/payroll/search/' . $month . "/" . $year . "/" . $role);

    }
    
    
    
    
  


}
