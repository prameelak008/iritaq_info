            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class EntranceExam_model extends MY_Model 
            {
            function Add_Center($data)
            {
            $query=$this->db->insert('entranceexam_centre',$data);
            }
            
            function Allcenter()
            {
            $query=$this->db->get('entranceexam_centre');
            return $query->result_array();
            }
            
            public function getCenter($id)
            {
            $this->db->select('*');
            $this->db->from('entranceexam_centre');
            $this->db->where('entranceexam_centreid', $id);
            $query = $this->db->get();
            return $query->result();
            }
            
            
            public function centerupdate($id,$name,$seat,$course) {
            $sql = "update entranceexam_centre set entranceexam_centrename='".$name."',entranceexam_centreseat='".$seat."',entranceexam_centrecourse='".course."' where entranceexam_centreid=$id";
            $query=$this->db->query($sql);   
            }
            
            public function centerdelete($id) {
            $sql = "delete from entranceexam_centre where entranceexam_centreid=$id";
            $query=$this->db->query($sql);   
            }
            
            function Add_inst($data)
            {
            $query=$this->db->insert('entranceexam_insitute',$data);
            if($query)
            {
            return true;
            }
            else
            {
            return false;
            }
            }
            
            function Allinstitute()
            {
            $sql = "SELECT * FROM `entranceexam_insitute` JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_insitute.entranceexam_insitutescourse";
            $query=$this->db->query($sql); 
            return $query->result_array();
            }
            
            public function getInstitute($id) {
            $sql = "SELECT * from entranceexam_insitute where entranceexam_insituteid=".$id."";
            $query=$this->db->query($sql); 
            return $query->result();
            }
            
            public function instituteupdate($id,$name,$seat,$course) {
            $sql = "update entranceexam_insitute set entranceexam_insitutename='".$name."',entranceexam_insituteseats='".$seat."',entranceexam_insitutescourse='".$course."' where entranceexam_insituteid=$id";
            $query=$this->db->query($sql);   
            }
            
            public function institutedelete($id) {
            $sql = "delete from entranceexam_insitute where entranceexam_insituteid=$id";
            $query=$this->db->query($sql);   
            }
            
            function Add_course($data)
            {
            $query=$this->db->insert('entranceexam_course',$data);
            if($query)
            {
            return true;
            }
            else
            {
            return false;
            }
            }
            
            function Allcourse()
            {
            $query=$this->db->get('entranceexam_course');
            return $query->result_array();
            }
            
            public function getCourse($id) {
            
            $sql = "SELECT * from entranceexam_course where entranceexam_course_id=".$id."";
            $query=$this->db->query($sql); 
            return $query->result();
            }
            
            public function courseupdate($id,$name,$custom) {
            $sql = "update entranceexam_course set entranceexam_course_name='".$name."',entranceexam_course_custom='".$custom." where entranceexam_course_id=$id";
            $query=$this->db->query($sql);   
            }
            
            
            public function coursedelete($id) {
            $sql = "delete from entranceexam_course where entranceexam_course_id=$id";
            $query=$this->db->query($sql);   
            }
            
            
            public function admissiondelete($id) {
        $sql = "delete from admission_form_tbl where admission_application_registerid=$id";
        $query=$this->db->query($sql);   
        }
        
        public function regdelete($id) {
        $sql = "delete from entrance_examregister where entrance_reg_id=$id";
        $query=$this->db->query($sql);   
        }
        
        
        
       
        
            
            }
            ?>