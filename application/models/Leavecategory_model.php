    <?php
    if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
    class Leavecategory_model extends MY_Model
    {
    
    public function __construct() 
    {
    parent::__construct();
    $this->current_session = $this->setting_model->getCurrentSession();
    }
    
    public function get($id = null) 
    {
    $this->db->select()->from('leave_category');
    if ($id != null) {
    $this->db->where('leave_category_id', $id);
    } else {
    $this->db->order_by('leave_category_id');
    }
    $query = $this->db->get();
    if ($id != null) {
    return $query->row_array();
    } else {
    return $query->result_array();
    }
    }
    
    public function remove($id) 
    {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
    //=======================Code Start===========================
    $this->db->where('leave_category_id', $id);
    $this->db->delete('leave_category');
    $message = DELETE_RECORD_CONSTANT . " On leave_category leave_category_id " . $id;
    $action = "Delete";
    $record_id = $id;
    $this->log($message, $record_id, $action);
    //======================Code End==============================
    $this->db->trans_complete(); # Completing transaction
    /* Optional */
    if ($this->db->trans_status() === false) {
    # Something went wrong.
    $this->db->trans_rollback();
    return false;
    } else {
    //return $return_value;
    }
    }
    
    public function add($data) 
    {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
    //=======================Code Start===========================
    if (isset($data['leave_category_id'])) {
    $this->db->where('leave_category_id', $data['leave_category_id']);
    $this->db->update('leave_category', $data);
    $message = UPDATE_RECORD_CONSTANT . " On leave category leave_category_id " . $data['leave_category_id'];
    $action = "Update";
    $record_id = $data['leave_category_id'];
    $this->log($message, $record_id, $action);
    //======================Code End==============================
    
    $this->db->trans_complete(); # Completing transaction
    /* Optional */
    
    if ($this->db->trans_status() === false) {
    # Something went wrong.
    $this->db->trans_rollback();
    return false;
    } else {
    //return $return_value;
    }
    } 
    else
    {
    $this->db->insert('leave_category', $data);
    $id = $this->db->insert_id();
    $message = INSERT_RECORD_CONSTANT . " On leave_category leave_category_id " . $id;
    $action = "Insert";
    $record_id = $id;
    $this->log($message, $record_id, $action);
    //======================Code End==============================
    
    $this->db->trans_complete(); # Completing transaction
    /* Optional */
    
    if ($this->db->trans_status() === false) {
    # Something went wrong.
    $this->db->trans_rollback();
    return false;
    } else {
    //return $return_value;
    }
    }
    }
    
    public function get_data()
    {
    $this->db->select('*');
    $this->db->from('leave_category');
    $this->db->where(array('leave_category_status'=>1));
    $q=$this->db->get();
    return $q->result_array();
    }
    
    public function gettimetable($class_id, $section_value,$day)
    {
    $this->db->select('*');
    $this->db->from('subject_timetable');
    $this->db->where(array('class_id'=>$class_id,'section_id'=>$section_value,'day'=>$day,'session_id'=>$this->current_session));
    $q=$this->db->get();
    return $q->result_array(); 
    }
    
    
    public function get_roles($id = null) 
    {
    $userdata = $this->customlib->getUserData();
    if ($userdata["role_id"] != 7) {
    $this->db->where("id !=", 7);
    }
    
    $this->db->select()->from('roles');
    if ($id != null) {
    $this->db->where('roles.id', $id);
    } else {
    $this->db->order_by('roles.id');
    }
    $query = $this->db->get();
    if ($id != null) {
    return $query->row_array();
    } else {
    return $query->result_array();
    }
    }
    
    public function get_leavedetails($class_id, $section_value,$date)
    {
    $this->db->select('*');
    $this->db->from('leave_catmanagement');
    $this->db->where(array('leave_catmanagement_class'=>$class_id,'leave_catmanagement_section'=>$section_value,'leave_catmanagement_date'=>$date,'leave_catmanagement_session'=>$this->current_session));
    $q=$this->db->get();
    return $q->row_array(); 
    }
    
    public function get_attendencetails($userdetails, $timeid,$i)
    {
    $this->db->select('*');
    $this->db->from('student_subject_attendances');
    $this->db->where(array('student_session_id'=>$userdetails,'subject_timetable_id'=>$timeid,'date'=>$i));
    $q=$this->db->get();
    return $q->row_array(); 
    }
    
    
    public function get_staff_details($staff, $date)
    {
    $this->db->select('*');
    $this->db->from('staff_attendance');
    $this->db->where(array('staff_id'=>$staff,'date'=>$date));
    $q=$this->db->get();
    return $q->row_array(); 
    }
    
    
    
    
    public function search_byleavemanagement($class_id, $section_value,$from_date, $to_date, $year, $month_number)
    {
    $fromdate  = $year.'-'.$month_number.'-'. $from_date;
    $todate   =  $year.'-'.$month_number.'-'. $to_date;
    $this->db->select('*');
    $this->db->from('leave_catmanagement');
    $this->db->join('classes','classes.id=leave_catmanagement.leave_catmanagement_class');
    $this->db->join('sections','sections.id=leave_catmanagement.leave_catmanagement_section');
    $this->db->join('leave_category','leave_category.leave_category_id =leave_catmanagement.leave_catmanagement_category');
    $this->db->where(array('leave_catmanagement_class'=>$class_id,'leave_catmanagement_section'=>$section_value,'leave_catmanagement_session'=>$this->current_session));
    $this->db->where('leave_catmanagement.leave_catmanagement_date >=', $fromdate);
    $this->db->where('leave_catmanagement.leave_catmanagement_date <=', $todate);
    $this->db->order_by('leave_catmanagement.leave_catmanagement_date', 'asc'); 
    $q=$this->db->get();
    return $q->result_array(); 
    }
    
    
    
    public function get_attendencelist($class_id,$section_value,$date)
    {
    $this->db->select('*');
    $this->db->from('subject_timetable');
    $this->db->join('student_subject_attendances', 'student_subject_attendances.subject_timetable_id = subject_timetable.id');
    $this->db->where(array('subject_timetable.class_id' => $class_id,'subject_timetable.section_id' => $section_value,'subject_timetable.session_id' => $this->current_session,'student_subject_attendances.date' => $date
    ));
    $q = $this->db->get();
    return  $q->result_array();
    }
    
    }
