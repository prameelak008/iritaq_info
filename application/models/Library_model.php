<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Library_model extends MY_Model 
{
    
    
  	function libraryadd($data)
  	{
      $query=$this->db->insert('library',$data);
      if($query)
          {
        return true;
        }
        else
        {
        return false;
        }
    }

    function alllibrary()
    {
        $query=$this->db->get('library');
        return $query->result_array();
    }

    public function getlibrary($id) {
    		// $sql = "SELECT * from entranceexam_centre where entranceexam_centreid=".$id."";
        //        $query=$this->db->query($sql); 
        //        return $query->result();
        $this->db->select('*');
        $this->db->from('library');
        $this->db->where('library_id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    public function libraryupdate($id,$name,$code,$location,$details,$status) {
        $sql = "update library set library_name='".$name."',library_code='".$code."',library_location='".$location."',library_details='".$details."',library_status=".$status." where library_id=$id";
        $query=$this->db->query($sql);
    }

    public function librarydelete($id) {
        $sql = "delete from library where library_id=$id";
        $query=$this->db->query($sql); 
    }


}
?>