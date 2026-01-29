<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entranceexam_subjectmodel extends MY_Model 
{

function Allsubjecttypes()
  {
$query=$this->db->get('entrance_subjecttype');
return $query->result_array();
}

function Allcourse()
  {
$query=$this->db->get('entranceexam_course');
return $query->result_array();
}

            public function subjectadd($data)
            {
            $query=$this->db->insert('entranceexam_subject',$data);
            if($query)
            {
            return true;
            }
            else
            {
            return false;
            }
            }

public function allsubject($sess_id)
{
    $sql = "SELECT * FROM `entranceexam_subject` 
JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_subject.entranceexam_subject_course_id
JOIN entrance_subjecttype on entrance_subjecttype.entrance_subtype_id=entranceexam_subject.entranceexam_subject_subid where entranceexam_subject.entranceexam_subject_sessionid=$sess_id";
    $query=$this->db->query($sql); 
    return $query->result_array();
}



public function getsubject($id) 
{
	$sql = "SELECT * FROM `entranceexam_subject` 
JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_subject.entranceexam_subject_course_id
JOIN entrance_subjecttype on entrance_subjecttype.entrance_subtype_id=entranceexam_subject.entranceexam_subject_subid where entranceexam_subject.entranceexam_subject_id=".$id."";
     $query=$this->db->query($sql); 
     return $query->result(); 
    }
    

public function subjectupdate($id,$course,$subid,$status,$sessionid) 
{
    
    
       $sql = "update entranceexam_subject set entranceexam_subject_course_id=".$course.",entranceexam_subject_subid='".$subid."',entranceexam_subject_status=".$status.",entranceexam_subject_sessionid=".$sessionid."  where entranceexam_subject_id=".$id."";
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

    public function subjectdelete($id) {
       $sql = "delete from entranceexam_subject where entranceexam_subject_id=$id";
       $query=$this->db->query($sql);   
  //      if($query)
  //   {
  // return true;
  // }
  // else
  // {
  // return false;
  // }
    }

// function Add_course($data)
// 	{
// $query=$this->db->insert('entranceexam_course',$data);
// if($query)
//     {
// 	return true;
// 	}
// 	else
// 	{
// 	return false;
// 	}
// }

// function Allcourse()
// 	{
// $query=$this->db->get('entranceexam_course');
// return $query->result_array();
// }

// public function getCourse($id) {

// 	$sql = "SELECT * from entranceexam_course where entranceexam_course_id=".$id."";
//      $query=$this->db->query($sql); 
//      return $query->result();
//     }

// public function courseupdate($id,$name) {
//        $sql = "update entranceexam_course set entranceexam_course_name='".$name."' where entranceexam_course_id=$id";
//        $query=$this->db->query($sql);   
//     }


// public function coursedelete($id) {
//        $sql = "delete from entranceexam_course where entranceexam_course_id=$id";
//        $query=$this->db->query($sql);   
//     }

}
?>