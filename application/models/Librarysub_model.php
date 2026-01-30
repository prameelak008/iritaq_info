<?php
//defined('BASEPATH')OR exit('No direct script access allowed');
class Librarysub_model extends MY_Model 
{

    public function Allmainsubjects()
    {
        $query=$this->db->get('librarymainsub');
        return $query->result_array();
    }

    function librarysubadd($data)
    {
      $query=$this->db->insert('librarysub',$data);
      if($query)
          {
        return true;
        }
        else
        {
        return false;
        }
    }

    function alllibrarysub()
    {   
        $this->db->select('*');
        $this->db->from('librarysub');
        $this->db->join('librarymainsub','librarymainsub.lib_mainsub_id = librarysub.lib_sub_mainsub','left');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function getlibrarysub($id) {
            // $sql = "SELECT * from entranceexam_centre where entranceexam_centreid=".$id."";
        //        $query=$this->db->query($sql); 
        //        return $query->result();
        $this->db->select('*');
        $this->db->from('librarysub');
        $this->db->where('lib_sub_id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    public function librarysubupdate($id,$name,$type,$mainsub,$ddc,$localno,$status) {
        $sql = "update librarysub set lib_sub_name='".$name."',lib_sub_type='".$type."',lib_sub_mainsub='".$mainsub."',lib_sub_ddcno=".$ddc.",lib_sub_localno=".$localno.",lib_sub_status=".$status." where lib_sub_id=$id";
        $query=$this->db->query($sql);
    }

    public function librarysubdelete($id) {
        $sql = "delete from librarysub where lib_sub_id=$id";
        $query=$this->db->query($sql); 
    }


}
?>