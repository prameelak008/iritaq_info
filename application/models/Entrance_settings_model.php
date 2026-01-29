        <?php
        defined('BASEPATH')OR exit('No direct script access allowed');
        class Entrance_settings_model extends CI_Model 
        {
            
        public function alloted_settings()
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_alloment');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_settings_alloment.set_allotment_course');
        $this->db->join('sessions','sessions.id=entrance_settings_alloment.set_allotment_session');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function getby_alloted_settings($id)
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_alloment');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_settings_alloment.set_allotment_course');
        $this->db->join('sessions','sessions.id=entrance_settings_alloment.set_allotment_session');
        $this->db->where(array('entrance_settings_alloment.set_allotment_id'=>$id));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function get_instruction($session,$course)
        {
        $this->db->select('set_allotment_instruction');
        $this->db->from('entrance_settings_alloment');
        $this->db->where(array('set_allotment_session'=>$session,'set_allotment_course'=>$course));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function  examresult_settings()
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_examresult');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_settings_examresult.set_examresult_course');
        $this->db->join('sessions','sessions.id=entrance_settings_examresult.set_examresult_session');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function get_resultinstruction($session,$course)
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_examresult');
        $this->db->where(array('set_examresult_course'=>$session,'set_examresult_course'=>$course));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function admission_settings()
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_admission');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_settings_admission.set_admission_course');
        $this->db->join('sessions','sessions.id=entrance_settings_admission.set_admission_session');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function getadmission_instruction($session,$course)
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_admission');
        $this->db->where(array('set_admission_session'=>$session,'set_admission_course'=>$course));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function settings_template()
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_template');
        $this->db->where(array('set_template_status'=>1));
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function get_temp_byval($id)
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_template');
        $this->db->where(array('set_template_id'=>$id));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        
        //set_general_phase
        
        public function settings_general($cur_sess)
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_general');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_settings_general.set_general_course','left');
        $this->db->join('sessions','sessions.id=entrance_settings_general.set_general_session');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=entrance_settings_general.set_general_phase','left');
        $this->db->where(array('set_general_status'=>1,'entrance_settings_general.set_general_session'=>$cur_sess));
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        public function settings_general_byval($id)
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_general');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entrance_settings_general.set_general_course','left');
        $this->db->join('sessions','sessions.id=entrance_settings_general.set_general_session');
        
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=entrance_settings_general.set_general_phase');
        
        //$this->db->join('entrance_settings_template','entrance_settings_template.set_template_id=entrance_settings_general.set_general_announcemessage	');
        $this->db->where(array('set_general_id'=>$id));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function getclose_inst($id='0')
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_template');
        $this->db->where(array('set_template_id'=>$id));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function getannounce_inst()
        {
        $this->db->select('*');
        $this->db->from('entrance_settings_template');
        $this->db->where(array('set_template_id'=>$id));
        $query=$this->db->get();
        return $query->row_array();   
        }
        
        public function currentsettings_general()
        {
        $this->db->select('*');
        $this->db->from('current_settings');
        $this->db->join('sessions','sessions.id= current_settings.cur_session');
        $this->db->where(array('cur_status'=>1));
        $query=$this->db->get();
        return $query->result_array();   
        }
        
        
        
        public function currentsettings_general_byval($id)
        {
        $this->db->select('*');
        $this->db->from('current_settings');
        $this->db->join('sessions','sessions.id= current_settings.cur_session');
        $this->db->where(array('cur_id'=>$id));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        
        
        public function get_entrance_settings()
        {
        $this->db->select('*');
        $this->db->from('current_settings');
        $this->db->join('sessions','sessions.id= current_settings.cur_session');
        $this->db->where(array('is_activestatus'=>1));
        $query=$this->db->get();
        return $query->row_array();
        }
        
        
        public function get_phase($cursess)
        {
        $currentDate = date("Y-m-d");
        $this->db->select('entrance_examgroup_id');
        $this->db->from('entrance_examgroup');
        $this->db->where('entrance_start_date <=', $currentDate);
        $this->db->where('entrance_end_date >=', $currentDate);
        $this->db->where('entrance_examgroup_session', $cursess);
        $this->db->where(array('entrance_examgroup_status'=> 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) 
        {
        return $query->row_array();
        } else {
        return 0;
        }
        }
        
        
        
        public function get_session_phase($cursess)
        {
        $this->db->select('*');
        $this->db->from('entrance_examgroup');  
        $this->db->where(array('entrance_examgroup_session'=> $cursess));
        $this->db->where(array('entrance_examgroup_status'=> 1));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function get_applicants($sess)
        {
        $this->db->select('*');
        $this->db->from('entrance_examregister');
        $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=entrance_examregister.entrance_reg_id');
        $this->db->where(array('admission_form_tbl.admission_sessionid'=> $sess));
        $query = $this->db->get();
        return $query->result_array();
        }
      
        
    public function add($data) 
    {
    $this->db->trans_start(); # Starting Transaction
    $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
    //=======================Code Start===========================
    if (isset($data['id'])) {
    $this->db->where('id', $data['id']);
    $this->db->update('entrancemessages', $data);
    $message = UPDATE_RECORD_CONSTANT . " On  entrancemessages id " . $data['id'];
    $action = "Update";
    $record_id = $id = $data['id'];
    $this->log($message, $record_id, $action);
    } else {
    $this->db->insert('entrancemessages', $data);
    $insert_id = $this->db->insert_id();
    $message = INSERT_RECORD_CONSTANT . " On entrancemessages id " . $insert_id;
    $action = "Insert";
    $record_id = $id = $insert_id;
    $this->log($message, $record_id, $action);
    }
    //======================Code End==============================
    
    $this->db->trans_complete(); # Completing transaction
    /* Optional */
    
    if ($this->db->trans_status() === false) {
    # Something went wrong.
    $this->db->trans_rollback();
    return false;
    } else {
    return $id;
    }
    }
    
    public function get_phase_list()
    {
    $currentDate   = date("Y-m-d");
    $sql           = "SELECT entrance_examgroup_id 
    FROM entrance_examgroup 
    WHERE '$currentDate' BETWEEN entrance_start_date AND entrance_end_date";
    $query         = $this->db->query($sql);
    if ($query->num_rows() > 0) {
    return $query->row_array();
    } else {
    return 0;
    }
    }
    
    
    public function entrance_settings_general($phasegroup,$session,$course)
    {
    $this->db->select('*');
    $this->db->from('entrance_settings_general');
    $this->db->where(array('set_general_phase'=> $phasegroup));
    $this->db->where(array('set_general_session'=> $session));
    $this->db->where(array('set_general_section'=>'College Preference'));
    $this->db->group_start();
    $this->db->where('set_general_course', $course);
    $this->db->or_where('set_general_course', 0);
    $this->db->group_end();
    $query = $this->db->get();
    return $query->row_array();
    } 
    
    public function entrance_settings_phaseresult($phasegroup,$session,$course)
    {
    $this->db->select('*');
    $this->db->from('entrance_settings_general');
    $this->db->where(array('set_general_phase'=> $phasegroup));
    $this->db->where(array('set_general_session'=> $session));
    $this->db->where(array('set_general_section'=>'Exam Result'));
    $this->db->group_start();
    $this->db->where('set_general_course', $course);
    $this->db->or_where('set_general_course', 0);
    $this->db->group_end();
    $query = $this->db->get();
    return $query->row_array();
    } 
    
    
    
    public function entrance_settings_phaseallotment($phasegroup,$session,$course)
    {
    $this->db->select('*');
    $this->db->from('entrance_settings_general');
    $this->db->where(array('set_general_phase'=> $phasegroup));
    $this->db->where(array('set_general_session'=> $session));
    $this->db->where(array('set_general_section'=>'Allotment Slip'));
    $this->db->group_start();
    $this->db->where('set_general_course', $course);
    $this->db->or_where('set_general_course', 0);
    $this->db->group_end();
    $query = $this->db->get();
    return $query->row_array();
    } 
    
          
}
?>