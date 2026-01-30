<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entrance_allotmentseatmodel extends MY_Model 
{
    
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }
    

public function AllSession()
  {
$query=$this->db->get('sessions');
return $query->result_array();
}


        
        public function AllCourse($session)
        {
        // $query=$this->db->get('entranceexam_course');
        // return $query->result_array();
        
        $this->db->select('*');
        $this->db->from('entranceexam_course');
        $this->db->join('entranceexamSelected_course','entranceexamSelected_course.sel_entranceexam_course_name=entranceexam_course.entranceexam_course_id');
        $this->db->where('entranceexamSelected_course.sel_entranceexam_course_session',$session);
        $query=$this->db->get();
        return $query->result_array();
        }
                    
                    

public function examgetInstitute($courseid)
    {
        $query = $this->db->select('*')->where("entranceexam_insitutescourse", $courseid)->get("entranceexam_insitute");
        return $query->result_array();
        
    }

    public function examgetCenter($courseid)
    {
        // $query = $this->db->select('*')->where("entranceexam_centrecourse", $courseid)->get("entranceexam_centre");
        // return $query->result_array();
        
    $this->db->select('*');
    $this->db->from('entranceexam_centre');
    $this->db->join('entranceexam_selectedcentre','entranceexam_selectedcentre.sel_entranceexam_centrename=entranceexam_centre.entranceexam_centreid');
    $this->db->where('entranceexam_selectedcentre.sel_entranceexam_centrecourse',$courseid);
    $query=$this->db->get();
    return $query->result_array();
        
         
    }




public function allseattypes()
  {
$query=$this->db->get('entrance_allotmentseattype');
return $query->result_array();
}

public function AllSeat($sess)
  {
    $this->db->select('*');
    $this->db->from('entrance_allotmentseat');
    $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_allotmentseat.entrance_allot_seat_course');
    $this->db->join('entranceexam_insitute','entranceexam_insitute.entranceexam_insituteid=entrance_allotmentseat.entrance_allot_seat_institute');
    $this->db->join('entranceexam_centre','entranceexam_centre.entranceexam_centreid=entrance_allotmentseat.entrance_allot_seat_center');
    $this->db->join('entrance_allotmentseattype','entrance_allotmentseattype.entrance_allot_type_id=entrance_allotmentseat.entrance_allot_seat_type');
    $this->db->join('sessions','sessions.id=entrance_allotmentseat.entrance_allot_seat_sessionid');
    $this->db->where('entrance_allotmentseat.entrance_allot_seat_sessionid',$sess);
    $query=$this->db->get();
    return $query->result_array();
    }

public function seatadd($data)
	{
$query=$this->db->insert('entrance_allotmentseat',$data);
if($query)
    {
	return true;
	}
	else
	{
	return false;
	}
}



            
            public function getseat($id) {
            $sql = "SELECT * FROM entrance_allotmentseat 
            JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entrance_allotmentseat.entrance_allot_seat_course
            JOIN entranceexam_insitute on entranceexam_insitute.entranceexam_insituteid=entrance_allotmentseat.entrance_allot_seat_institute
            JOIN entranceexam_centre on entranceexam_centre.entranceexam_centreid=entrance_allotmentseat.entrance_allot_seat_center
            JOIN entrance_allotmentseattype on entrance_allotmentseattype.entrance_allot_type_id=entrance_allotmentseat.entrance_allot_seat_type
            WHERE entrance_allotmentseat.entrance_allot_seat_id=".$id."";
            $query=$this->db->query($sql); 
            return $query->row();
            }
    

            public function seatupdate($id,$year,$session,$seatno,$course,$institute,$center,$type,$status) {
            $sql = "UPDATE entrance_allotmentseat SET entrance_allot_seat_year='$year',entrance_allot_seat_sessionid=$session,entrance_allot_seat_seatno=$seatno,entrance_allot_seat_course=$course,entrance_allot_seat_institute=$institute,entrance_allot_seat_center=$center,entrance_allot_seat_type=$type,
            entrance_allot_seat_status=$status,entrance_allot_seat_updated_date=date('d-m-Y H:i:s);   WHERE entrance_allot_seat_id=$id";
            $query=$this->db->query($sql);  
            if($query)
            {
            return true;
            }
            else
            {
            return false;
            } 
            }

            public function seatdelete($id) {
            $sql = "delete from entrance_allotmentseat where entrance_allot_seat_id=$id";
            $query=$this->db->query($sql);   
            }
}
?>