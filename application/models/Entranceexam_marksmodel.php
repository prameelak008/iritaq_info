<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entranceexam_marksmodel extends MY_Model 
{
                function marksadd($data)
                {
                $query=$this->db->insert('entranceexam_marks',$data);
                if($query)
                {
                return true;
                }
                else
                {
                return false;
                }
                }
                

// function allsubject()
// {
//     $sql = "SELECT * FROM `entranceexam_subject` JOIN entrance_subjecttype on entrance_subjecttype.entrance_subtype_id=entranceexam_subject.entranceexam_subject_subid;";
//     $query=$this->db->query($sql); 
//     return $query->result_array();
// }

            function allmarks($cur_ses)
            	{
            		$sql = "SELECT * FROM entranceexam_marks 
            JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_marks.entranceexam_marks_course_id
            JOIN entrance_examgroup on entrance_examgroup.entrance_examgroup_id =entranceexam_marks.entranceexam_marks_phase
            JOIN entrance_subjecttype on entrance_subjecttype.entrance_subtype_id=entranceexam_marks.entranceexam_marks_subject_id where entranceexam_marks.entranceexam_marks_session_id='$cur_ses'";
                 $query=$this->db->query($sql); 
                 return $query->result_array();
                 
                 
            //      SELECT * FROM entranceexam_marks 
            // JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_marks.entranceexam_marks_course_id
            // JOIN entranceexam_subject on entranceexam_subject.entranceexam_subject_id=entranceexam_marks.entranceexam_marks_subject_id JOIN entrance_subjecttype on entrance_subjecttype.entrance_subtype_id=entranceexam_subject.entranceexam_subject_subid
             }
 

    public function getMarks($id) {
    $sql = "SELECT * from entranceexam_marks JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_marks.entranceexam_marks_course_id JOIN entrance_subjecttype on entrance_subjecttype.entrance_subtype_id=entranceexam_marks.entranceexam_marks_subject_id where entranceexam_marks.entranceexam_marks_id=".$id."";
    $query=$this->db->query($sql); 
    return  $query->result();
    }
    
    
    
    public function chksubject($subject,$course) {
    $sql = "SELECT * from entranceexam_marks where entranceexam_marks.entranceexam_marks_subject_id=".$subject." and entranceexam_marks.entranceexam_marks_course_id=".$course."";
    $query=$this->db->query($sql); 
    return $query->result();
    }
  
    

    public function exammarkupdate($course,$subject,$maxmark,$minmark,$year,$active,$mark_id,$phase) {
    $sql = "update entranceexam_marks set  entranceexam_marks_phase=".$phase.", entranceexam_marks_course_id=".$course.",entranceexam_marks_subject_id=".$subject.",entranceexam_marks_maximum_marks=".$maxmark." ,entranceexam_marks_minimum_marks=".$minmark.",entranceexam_marks_year=".$year.",entranceexam_marks_active='".$active."' where entranceexam_marks_id=".$mark_id."";
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

    public function markdelete($id) 
    {
       $sql = "delete from entranceexam_marks where entranceexam_marks_id=$id";
       $query=$this->db->query($sql);   
    }

    public function examgetSubject($course_id)
    {
        // $query = $this->db->select('*')->join("entrance_subjecttype", "entrance_subjecttype.entrance_subtype_id=entranceexam_subject.entranceexam_subject_subid")->where("entranceexam_subject_course_id", $course_id)->get("entranceexam_subject");
        // return $query->result_array();
        
        $query = $this->db->select('*')
        ->join("entrance_subjecttype", "entrance_subjecttype.entrance_subtype_id = entranceexam_subject.entranceexam_subject_subid")
        ->where("entranceexam_subject_course_id", $course_id)
        ->group_by("entranceexam_subject_subid") 
        ->get("entranceexam_subject");
        return $query->result_array();
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