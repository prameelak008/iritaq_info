<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entrance_subjecttypemodel extends MY_Model 
{

public function allsubjecttypes()
  {
$query=$this->db->get('entrance_subjecttype');
return $query->result_array();
}

public function subjecttypeadd($data)
	{
$query=$this->db->insert('entrance_subjecttype',$data);
if($query)
    {
	return true;
	}
	else
	{
	return false;
	}
}

// public function allseattypes()
// {
//     $sql = "SELECT * FROM entrance_allotmentseattype";
//     $query=$this->db->query($sql); 
//     return $query->result_array();
// }

public function getsubjecttype($id) {
	   $sql = "SELECT * from entrance_subjecttype where entrance_subtype_id=".$id."";
     $query=$this->db->query($sql); 
     return $query->result(); 
    }

public function subjecttypeupdate($subname,$subcode,$subtype,$substatus,$subid) {
       $sql = "update entrance_subjecttype set entrance_subtype_name='".$subname."',entrance_subtype_code='".$subcode."',entrance_subtype_type='".$subtype."',entrance_subtype_is_active=".$substatus.",entrance_subtype_updated_at='".date('Y-m-d H:i:s')."' where entrance_subtype_id=".$subid."";
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

    public function subjecttypedelete($id) {
       $sql = "delete from entrance_subjecttype where entrance_subtype_id=$id";
       $query=$this->db->query($sql);   
    }

}
?>