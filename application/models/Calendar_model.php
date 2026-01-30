<?php

class Calendar_model extends CI_Model

{

        public function __construct()
        {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date    = $this->setting_model->getDateYmd();
        }




        public function saveEvent($data) 
        {   
        $daterange=array(); 


        
   

        if (isset($data["id"])) 
        {

        $this->db->where("calender_id", $data["id"])->delete("student_attendences");
        $this->db->where("calender_id", $data["id"])->delete("staff_attendance");

        
        $this->db->where("id", $data["id"])->update("events", $data);

        $getid           = $data["id"];
        $getdata         = $this->listall($getid);
        $date_to         = $getdata['start_date'];
        $date_from       = $getdata['end_date'];

            $start       = strtotime($date_to); 
            $end         = strtotime($date_from); 
            $range       = array();
            $date        = strtotime("-1 day", $start);



            
            while($date < $end) 
            { 
            $date         = strtotime("+1 day", $date); 
            $daterange    = date('Y-m-d', $date);

            if ($data['is_activeholiday'] ==1 && $data['event_type'] == 'public')
            {

            $query        = $this->db->get("student_session");
            $stu          = $query->result_array();

            foreach($stu as $student_ses)
            {
            $student                        = $student_ses['id'];
            $attendence_data                = array('date' => $daterange,
            'attendence_type_id'            => 5,
            'created_at'                    => date('Y-m-d'),
            'student_session_id'            => $student,
            'remark'                        => $getdata['event_title'],
            'calender_id'                   => $getid ,
            );          

            $this->db->insert("student_attendences", $attendence_data); 
            }

            $query          = $this->db->get("staff");
            $staff          = $query->result_array();

            foreach($staff as $staff_ses)
            {
            $staffid                        =  $staff_ses['id'];
            $attendenc_data = array('date'  => $daterange,
            'staff_attendance_type_id'      => 5,
            'created_at'                    => date('Y-m-d'),
            'staff_id'                      => $staffid,
            'remark'                        => $getdata['event_title'],
            'calender_id'                   => $getid,
            );

            //$this->calendar_model->saveStaffAttendenceEvent($attendenc_data); 
             $this->db->insert("staff_attendance", $attendenc_data); 
            }
            }
            }
            }


        else
        {

        $this->db->insert("events", $data);

        $insert_id     = $this->db->insert_id();
        $getdata       = $this->listall($insert_id);
          
            $date_to   = $getdata['start_date'];
            $date_from = $getdata['end_date'];

            $start     = strtotime($date_to); 
            $end       = strtotime($date_from); 
            $range     = array();
            $date      = strtotime("-1 day", $start); 

            while($date < $end) 
            { 
            $date       = strtotime("+1 day", $date);            

            $daterange  = date('Y-m-d', $date);

            if ($getdata['is_activeholiday'] ==1 && $getdata['event_type'] == 'public')
            {

            $query      = $this->db->get("student_session");
            $stu        = $query->result_array();

            foreach($stu as $student_ses)
            {
            $student                        = $student_ses['id'];
            $attendence_data                = array('date' => $daterange,
            'attendence_type_id'            => 5,
            'created_at'                    => date('Y-m-d'),
            'student_session_id'            => $student,
            'remark'                        => $getdata['event_title'],
            'calender_id'                   => $getdata['id'],
            );          

            $this->db->insert("student_attendences", $attendence_data); 
            }

            $query          = $this->db->get("staff");
            $staff          = $query->result_array();

            foreach($staff as $staff_ses)
            {
            $staffid                        =  $staff_ses['id'];
            $attendenc_data = array('date'  => $daterange,
            'staff_attendance_type_id'      => 5,
            'created_at'                    => date('Y-m-d'),
            'staff_id'                      => $staffid,
            'remark'                        => $getdata['event_title'],
            'calender_id'                   => $getdata['id'],
            );

            //$this->calendar_model->saveStaffAttendenceEvent($attendenc_data); 
             $this->db->insert("staff_attendance", $attendenc_data); 
            }
            }
            }


        }
        }


    

        public function saveAttendenceEvent($data) 
        {
            
        $this->db->insert("student_attendences", $data);
        }   



        public function saveStaffAttendenceEvent($data) 
        {
        $this->db->insert("staff_attendance", $data);    
        }



        public function listall($insert_id)
        {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->where('id', $insert_id); 
        $query      = $this->db->get();            
        return  $query->row_array();
        }




        public function getEvents($id = null) 
        {

        if (!empty($id)) {
            $query = $this->db->where("id", $id)->get("events");
            return $query->row_array();
        } else {

            $query = $this->db->get("events");
            return $query->result_array();
        }
        }

        

    public function getStudentEvents($id = null) 
    {

    $cond = "(event_type = 'public' or event_type = 'task') and role_id=0 ";
    $query = $this->db->where($cond)->get("events");
    return $query->result_array();
    }


    public function deleteEvent($id) 
    {
    $this->db->where("id", $id)->delete("events");
    $this->db->where("calender_id", $id)->delete("student_attendences");
    $this->db->where("calender_id", $id)->delete("staff_attendance");
    }



    public function getTask($id,$role_id, $limit = null, $offset = null) 
    {
    $query = $this->db->where(array('event_type' => 'task', 'event_for' => $id, 'role_id' => $role_id))->order_by("is_active,start_date", "asc")->limit($limit, $offset)->get("events");

    return $query->result_array();
    }


    function countEventByUser($user_id) 
    {

    $query = $this->db->where(array("event_type"=> "task",'event_for'=>$user_id))->get("events");

    return $query->num_rows();
    }



       function countrows($id,$role_id) {

       $query = $this->db->where(array('event_type' => 'task', 'event_for' => $id, 'role_id' => $role_id))->order_by("is_active,start_date", "asc")->get("events");
        return $query->num_rows();
    }

    function countincompleteTask($id) {

        $query = $this->db->where("event_type", "task")->where("is_active", "no")->where("event_for", $id)->where("start_date", date("Y-m-d"))->get("events");

        return $query->num_rows();
    }

    function getincompleteTask($id) {


        $query = $this->db->where("event_type", "task")->where("is_active", "no")->where("event_for", $id)->where("start_date", date("Y-m-d"))->order_by("start_date", "asc")->get("events");

        return $query->result_array();
    }




        function countstudent_leave()
        {  

        $query = $this->db->query("SELECT * FROM student_applyleave where approve_by='0'");
        return $query->num_rows();
        }


        function countstaff_leave()
        {    
      
        $query = $this->db->query("SELECT * FROM staff_leave_request where  status='pending'");
        return $query->num_rows();
        }
       


        function countstudent_leave_forteacher($id)
        {
        $this->db->select('*');
        $this->db->from('student_applyleave');
        $this->db->join('student_session','student_session.id=student_applyleave.student_session_id');
        $this->db->join('class_teacher','class_teacher.class_id=student_session.class_id');        
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('class_teacher.staff_id', $id);
        $this->db->where('student_applyleave.approve_by', 0);
        $query = $this->db->get();
        return $query->num_rows();
        }
        
        }


        ?>