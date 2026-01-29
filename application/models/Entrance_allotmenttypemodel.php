<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Entrance_allotmenttypemodel extends MY_Model 
{

public function allseattypes()
  {
$query=$this->db->get('entrance_allotmentseattype');
return $query->result_array();
}

public function seattypeadd($data)
	{
$query=$this->db->insert('entrance_allotmentseattype',$data);
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

public function getseattype($id) {
	   $sql = "SELECT * from entrance_allotmentseattype where entrance_allot_type_id=".$id."";
     $query=$this->db->query($sql); 
     return $query->result(); 
    }

public function seattypeupdate($typeid,$typename,$typedesc,$typestatus) {
       $sql = "update entrance_allotmentseattype set entrance_allot_type_name='".$typename."',entrance_allot_type_description='".$typedesc."',entrance_allot_type_status=".$typestatus." where entrance_allot_type_id=".$typeid."";
       $query=$this->db->query($sql);   
    }

    public function seattypedelete($id) {
       $sql = "delete from entrance_allotmentseattype where entrance_allot_type_id=$id";
       $query=$this->db->query($sql);   
    }

}
?>