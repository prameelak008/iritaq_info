<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Librarymainsub_model extends MY_Model 
{
    function mainsubadd($data)
    {
      $query=$this->db->insert('librarymainsub',$data);
      if($query)
          {
        return true;
        }
        else
        {
        return false;
        }
    }

    function allmainsub()
    {
        $query=$this->db->get('librarymainsub');
        return $query->result_array();
    }

    public function getmainsub($id) {
            // $sql = "SELECT * from entranceexam_centre where entranceexam_centreid=".$id."";
        //        $query=$this->db->query($sql); 
        //        return $query->result();
        $this->db->select('*');
        $this->db->from('librarymainsub');
        $this->db->where('lib_mainsub_id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    public function mainsubupdate($id,$name,$status) {
        $sql = "update librarymainsub set lib_mainsub_name='".$name."',lib_mainsub_status=".$status." where lib_mainsub_id=$id";
        $query=$this->db->query($sql);
    }

    public function mainsubdelete($id) {
        $sql = "delete from librarymainsub where lib_mainsub_id =$id";
        $query=$this->db->query($sql); 
    }


}
?>