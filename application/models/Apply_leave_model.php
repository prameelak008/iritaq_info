<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class apply_leave_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date    = $this->setting_model->getDateYmd();
    }

    public function get($id = null, $carray = null, $section_array = null)
    {

        $this->db->select('student_applyleave.*,students.firstname,students.middlename,students.lastname,staff.name as staff_name,students.id as stud_id,staff.surname,classes.id as class_id,sections.id as section_id,classes.class,sections.section')->from('student_applyleave')->join('student_session', 'student_session.id = student_applyleave.student_session_id')->join('students', 'students.id=student_session.student_id', 'inner')->join('staff', 'staff.id=student_applyleave.approve_by', 'left')->join('classes', 'student_session.class_id = classes.id')->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('students.is_active', 'yes');
        if ($carray != null) {
            $this->db->where_in('classes.id', $carray);
        }

        if ($section_array != null) {
            $this->db->where_in('sections.id', $section_array);
        }

        if ($id != null) {

            $this->db->where('student_applyleave.id', $id);
        } else {

            $this->db->order_by('student_applyleave.id', 'desc');
        }

        $this->db->where('student_session.session_id', $this->current_session);

        $query = $this->db->get();

        if ($id != null) {

            return $query->row_array();
        } else {

            return $query->result_array();
        }
    }

    public function get_student($student_session_id = null)
    {

        // $this->db->select()->from('student_applyleave');
        // if ($student_session_id != null) {
        //     $this->db->where('student_session_id', $student_session_id);
        // } else {
        //     $this->db->order_by('id');
        // }
        // $query = $this->db->get();
        //     return $query->result_array();
        
        /*
        $this->db->select('student_applyleave.*,students.firstname,students.middlename,students.lastname,staff.name as staff_name,staff.surname,classes.id as class_id,sections.id as section_id,classes.class,sections.section')->from('student_applyleave')->join('student_session', 'student_session.id = student_applyleave.student_session_id')->join('students', 'students.id=student_session.student_id', 'inner')->join('staff', 'staff.id=student_applyleave.approve_by', 'left')->join('classes', 'student_session.class_id = classes.id')->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('student_session.id', $student_session_id);
        $this->db->where('students.is_active', 'yes');
        $query = $this->db->get();
        return $query->result_array();
        */
        
        $this->db->select('student_applyleave.*,students.id as sid,student_applyleave.student_session_id as ssid,student_applyleave.id as leaveid,students.firstname,students.middlename,students.lastname,staff.name as staff_name,staff.surname,classes.id as class_id,sections.id as section_id,classes.class,sections.section')->from('student_applyleave')->join('student_session', 'student_session.id = student_applyleave.student_session_id')->join('students', 'students.id=student_session.student_id', 'inner')->join('staff', 'staff.id=student_applyleave.approve_by', 'left')->join('classes', 'student_session.class_id = classes.id')->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('student_session.id', $student_session_id);
        $this->db->where('students.is_active', 'yes');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_applyleave', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  student apply leave id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
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
        } else {
            $this->db->insert('student_applyleave', $data);
            $id        = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On student apply leave id " . $id;
            $action    = "Insert";
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
            return $id;
        }
    }

    public function get_studentsessionId($class_id, $section_id, $student_id)
    {
        $where['class_id']   = $class_id;
        $where['section_id'] = $section_id;
        $where['student_id'] = $student_id;

        return $this->db->select('id')->from('student_session')->where($where)->get()->row_array();
    }

    public function remove_leave($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('student_applyleave');
        $message   = DELETE_RECORD_CONSTANT . " On student apply leave id " . $id;
        $action    = "Delete";
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

    public function canApproveLeave($staff_id, $class_id, $section_id)
    {
        $class_teacher = $this->db->select('*')->from('class_teacher')->where('class_id', $class_id)->where('section_id', $section_id)->where('staff_id', $staff_id)->get()->num_rows();
        if ($class_teacher > 0) {
            return 1;
        } else {
            $subject_teacher = $this->db->select('*')->from('subject_timetable')->join('subject_group_subjects', 'subject_timetable.subject_group_subject_id=subject_group_subjects.id')->where('class_id', $class_id)->where('section_id', $section_id)->where('staff_id', $staff_id)->get()->num_rows();
            if ($subject_teacher > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    
    
    
    
    
   public function studentlist($sid,$current_session)
    {
        $sql = "select students.admission_no, students.image,students.id as id,students.image,students.firstname as namest,students.admission_no,students.dob,classes.class,sections.section,
    students.guardian_name,students.wasupno,students.barcode,student_session.id as session_id
    from students
    JOIN student_session on student_session.student_id = students.id
    JOIN classes on classes.id = student_session.class_id 
    JOIN sections on sections.id = student_session.section_id
    where students.id=".$sid." and  session_id=$current_session";   
    $query=$this->db->query($sql); 
    return $query->row(); 
    }
    
    
    

public function getclsteacher($cls,$sctn,$current_session)
    {
$sql = "SELECT CONCAT(staff.name,' ',staff.surname) as staffname FROM `class_teacher` 
JOIN classes on classes.id = class_teacher.class_id
JOIN staff on staff.id = class_teacher.staff_id
JOIN sections on section_id = class_teacher.section_id
JOIN sessions on session_id = class_teacher.session_id
WHERE classes.class = '".$cls."' and sections.section = '".$sctn."' and class_teacher.session_id='". $current_session."'  group by class_id";  

    $query=$this->db->query($sql); 
    return $query->row();   
    }


 public function workdays($ssid)
{
    $sql = " select classes.class as clas,COUNT(stw.attendence_type_id) as workingdays
from students
 JOIN student_session on student_session.student_id = students.id
 JOIN classes on classes.id = student_session.class_id
 JOIN student_attendences stw on stw.student_session_id = student_session.id and stw.attendence_type_id != 5 and stw.student_session_id=".$ssid."";   
    $query = $this->db->query($sql); 
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return null; // Return null if no data is found
    }
}

     public function attendingdays($ssid)
    { 
         $sql = "select COUNT(sta.attendence_type_id) as attendingdays
from students
JOIN student_session on student_session.student_id = students.id
JOIN classes on classes.id = student_session.class_id
JOIN student_attendences sta on sta.student_session_id = student_session.id and sta.attendence_type_id != 5 and sta.attendence_type_id != 4 and sta.student_session_id=".$ssid.""; 
            $query=$this->db->query($sql); 
            return $query->row();
    }
    
    
    

    public function totalleavedetails($leaveid)
   { 
    $sql = "SELECT CONCAT(student_applyleave.from_date, ' ', student_applyleave.leave_from_time) AS fromdt, CONCAT(student_applyleave.to_date, ' ', student_applyleave.leave_to_time) AS todt, student_applyleave.reason,student_applyleave.reporting_accuracy,student_applyleave.reporting_status, datediff(student_applyleave.to_date, student_applyleave.from_date) + 1 AS leavedaydiff, substring_index(timediff(CONCAT(student_applyleave.to_date, ' ', student_applyleave.leave_to_time), CONCAT(student_applyleave.from_date, ' ', student_applyleave.leave_from_time)), ':', 2) AS leavehrdiff,sum(substring_index(timediff(CONCAT(sl.to_date, ' ', sl.leave_to_time), CONCAT(sl.from_date, ' ', sl.leave_from_time)), ':', 2)) as totalhours
    FROM students
    JOIN student_session ON student_session.student_id = students.id 
    JOIN student_applyleave sl ON sl.student_session_id = student_session.id
    JOIN student_applyleave ON student_applyleave.student_session_id = student_session.id where student_applyleave.id=".$leaveid." "; 
    $query = $this->db->query($sql); 
    return $query->row();
}




  public function total_leave($session,$current_session)
   { 
    $sql = "SELECT CONCAT(student_applyleave.from_date, ' ', student_applyleave.leave_from_time) AS fromdt, CONCAT(student_applyleave.to_date, ' ', student_applyleave.leave_to_time) AS todt,  datediff(student_applyleave.to_date, student_applyleave.from_date) + 1 AS leavedaydiff, substring_index(timediff(CONCAT(student_applyleave.to_date, ' ', student_applyleave.leave_to_time), CONCAT(student_applyleave.from_date, ' ', student_applyleave.leave_from_time)), ':', 2) AS leavehrdiff,sum(substring_index(timediff(CONCAT(sl.to_date, ' ', sl.leave_to_time), CONCAT(sl.from_date, ' ', sl.leave_from_time)), ':', 2)) as totalhours
    FROM students
    JOIN student_session ON student_session.student_id = students.id 
    JOIN student_applyleave sl ON sl.student_session_id = student_session.id
    JOIN student_applyleave ON student_applyleave.student_session_id = student_session.id
    where student_applyleave.student_session_id=".$session." "; 
    $query = $this->db->query($sql); 
    return $query->row();
}










 public function totalleavedetails_val($ssid)
{ 
    $sql = "SELECT student_applyleave.id as lvid,
                CONCAT(student_applyleave.from_date, ' ', student_applyleave.leave_from_time) AS fromdt,
                CONCAT(student_applyleave.to_date, ' ', student_applyleave.leave_to_time) AS todt,
                student_applyleave.reason,
                datediff(student_applyleave.to_date, student_applyleave.from_date) + 1 AS leavedaydiff,
                substring_index(timediff(CONCAT(student_applyleave.to_date, ' ', student_applyleave.leave_to_time), CONCAT(student_applyleave.from_date, ' ', student_applyleave.leave_from_time)), ':', 2) AS leavehrdiff,
                sum(substring_index(timediff(CONCAT(sl.to_date, ' ', sl.leave_to_time), CONCAT(sl.from_date, ' ', sl.leave_from_time)), ':', 2)) AS totalhours
            FROM students
            JOIN student_session ON student_session.student_id = students.id 
            JOIN student_applyleave sl ON sl.student_session_id = student_session.id
            JOIN student_applyleave ON student_applyleave.student_session_id = student_session.id 
            WHERE student_applyleave.student_session_id = ".$ssid."
            GROUP BY student_applyleave.id"; 
    $query = $this->db->query($sql); 
    return $query->result_array();
}
    
    
    
    
    

}
