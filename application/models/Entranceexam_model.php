        <?php
        // defined('BASEPATH')OR exit('No direct script access allowed');
        class Entranceexam_model extends CI_Model 
        {
        
        
        public function __construct() 
        {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        }
        
        
        
        
        function EntranceExamRegister($data)
        {
        $query=$this->db->insert('entrance_Examregister',$data);
        if($query)
        {
        return true;
        }
        else
        {
        return false;
        }
        }
        
        
        
        public function login($username,$password)
        {                       
        $this->db->where('entrance_reg_username',$username);
        $this->db->where('entrance_reg_password',$password);
        return $this->db->get('entrance_examregister');
        }
        
        
        function Add_Center($data)
        {
        $query=$this->db->insert('entranceexam_centre',$data);
        }
        
        
        
        
        
        
        function Allcenter($cur_session)
        {
        if($cur_session==18)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_centre');
        $this->db->where(array('entranceexam_previousyear'=>0));
        $query = $this->db->get();
        return $query->result_array();    
        
        }
        else
        {
        $this->db->select('*');
        $this->db->from('entranceexam_centre');
        //$this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=entranceexam_centre.entranceexam_centrecourse');
        // $this->db->join('sessions','sessions.id  = entranceexam_centre.entranceexam_centresession');
        $this->db->where(array('entranceexam_previousyear'=>1));
        $query = $this->db->get();
        return $query->result_array();
        }

        
        }
        
        
        
        public function getCenter($id) 
        {
        $this->db->select('*');
        $this->db->from('entranceexam_centre');
        //$this->db->join('sessions','sessions.id  = entranceexam_centre.entranceexam_centresession');
        $this->db->where(array('entranceexam_centre.entranceexam_centreid'=> $id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function centerupdate($id,$name) 
        {
        //$sql = "update entranceexam_centre set entranceexam_centrename='".$name."',entranceexam_centreseat='".$seat."',entranceexam_centrecourse='".$course."',entranceexam_centresession='".$session."' where entranceexam_centreid=$id";
        
        $sql = "update entranceexam_centre set entranceexam_centrename='".$name."' where entranceexam_centreid=$id";
        $query=$this->db->query($sql);   
        }
        
        
        public function centerdelete($id) 
        {
        $sql = "delete from entranceexam_centre where entranceexam_centreid=$id";
        $query=$this->db->query($sql);   
        }

        
        
        function Add_inst($data)
        {
        $query=$this->db->insert('entranceexam_insitutegroup',$data);
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
        //$sql = "SELECT * FROM `entranceexam_insitute` JOIN entranceexam_course on entranceexam_course.entranceexam_course_id=entranceexam_insitute.entranceexam_insitutescourse";
        
        $sql = "SELECT * FROM `entranceexam_insitutegroup`";
        $query=$this->db->query($sql); 
        return $query->result_array();
        }
        
        
        public function getInstitute($id)
        {
        $this->db->select('*');    
        $this->db->from('entranceexam_insitutegroup'); 
        //$this->db->join('sessions','sessions.id=entranceexam_insitute.entranceexam_insitutesession');
        $this->db->where(array('entranceexam_insitutegroup','entranceexam_insitutegroup.entranceexam_insituteid'=>$id));
        $query=$this->db->get();
        return $query->row();
        }
        
        
        
        function instituteupdate($id,$name,$seat,$course,$priority)
        {
        $sql = "update entranceexam_insitutegroup set entranceexam_insitutename='".$name."' where entranceexam_insituteid=$id";
        return $this->db->query($sql);   
        }
        
        
        public function institutedelete($id)
        {
        $sql = "delete from entranceexam_insitutegroup where entranceexam_insituteid=$id";
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
        $this->db->select('*');    
        $this->db->from('entranceexam_course'); 
        //$this->db->join('sessions','sessions.id=entranceexam_course.entranceexam_course_session');
        $query=$this->db->get();
        return $query->result_array();
        }
        
        public function getCourse($id) {
        
        $sql = "SELECT * from entranceexam_course where entranceexam_course_id=".$id."";
        $query=$this->db->query($sql); 
        return $query->result();
        }
        
        public function courseupdate($id,$name,$session,$custom,$description,$is_previous) {
        $sql = "update entranceexam_course set entranceexam_course_name='".$name."',entranceexam_course_session='".$session."',entranceexam_course_custom='".$custom."',entranceexam_course_description='".$description."', entranceexam_course_is_previous='".$is_previous."'  where entranceexam_course_id=$id";
        $query=$this->db->query($sql);   
        }
        
        
        public function coursedelete($id) {
        $sql = "delete from entranceexam_course where entranceexam_course_id=$id";
        $query=$this->db->query($sql);   
        } 
        
        public function admitdelete($id)
        {
        $sql = "delete from entranceexam_admitcard where entrance_admitcardid=$id";
        return $this->db->query($sql);   
        } 
        
        public function admissiondelete($id) 
        {
        $sql = "delete from admission_form_tbl where admission_application_registerid=$id";
        $query=$this->db->query($sql);   
        }
        
        
        
        public function regdelete($id) 
        {
        $sql      = "delete from entrance_examregister where entrance_reg_id=$id";
        $this->db->query($sql); 
        $sql_form = "delete from admission_form_details where ad_reg_id=$id";
        $this->db->query($sql_form); 
        $sql_reg  = "delete from admission_form_tbl where admission_application_registerid=$id";
        $this->db->query($sql_reg); 
        $sql_ui   = "delete from set_entrance_uidesign where reg_id=$id";
        $this->db->query($sql_ui); 
        $sql_pay  = "delete from fees_entrancepayment where fees_entrancepayment_student_id=$id";
        $this->db->query($sql_pay); 
        return true;
        }
        
        
        
        
        public function examget($entrance_session)
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse','left');
        //$this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id=admission_form_tbl.admission_application_registerid','left');
        $this->db->join('sessions','sessions.id=admission_form_tbl.admission_sessionid');
        //$this->db->where(array('admission_form_tbl','admission_form_tbl.admission_application_selectedcourse!='=>'0'));
        $this->db->where(array('admission_form_tbl','admission_form_tbl.admission_sessionid'=>$entrance_session));
        $query=$this->db->get();
        return $query->result_array(); 
        }
        
        
        
         public function examfee_byadmission($entrance_session)
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        //$this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
       // $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse','left');
        $this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id=admission_form_tbl.admission_application_registerid','left');
        $this->db->join('sessions','sessions.id=admission_form_tbl.admission_sessionid');
        //$this->db->where(array('admission_form_tbl','admission_form_tbl.admission_application_selectedcourse!='=>'0'));
        $this->db->where(array('admission_form_tbl','admission_form_tbl.admission_sessionid'=>$entrance_session));
        $query=$this->db->get();
        return $query->result_array(); 
        }
        
        
        
        
        
        public function list_admission_applicants($studid)
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse','left');
        $this->db->join('state_list','state_list.state_id=admission_form_tbl.admission_state','left');
        $this->db->join('district_list','district_list.district_id=admission_form_tbl.admission_district','left');
        $this->db->join('sessions','sessions.id=admission_form_tbl.admission_sessionid');
        $this->db->where(array('admission_form_tbl','admission_form_tbl.admission_application_registerid'=>$studid));
        $query=$this->db->get();
        return $query->row_array(); 
        }
        
        
        public function examgetCourse()
        {
        $sql = "select * from entranceexam_course";
        $query=$this->db->query($sql);
        return $query->result_array();
        }
        
        public function examgetInstitute()
        {
        $sql = "select * from entranceexam_insitute";
        $query=$this->db->query($sql);
        return $query->row_array();
        }
        
        
        
        public function examgetBySearch($course,$institute,$center,$entrance_session,$phase)
        {
        
        if($course!="" && $institute=="" && $center=="")
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
        $this->db->join('set_entrance_uidesign','set_entrance_uidesign.reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=set_entrance_uidesign.phasegroup');
        $this->db->where(array('admission_form_tbl.admission_application_selectedcourse'=>$course));
        $this->db->where(array('admission_form_tbl.admission_sessionid'=>$entrance_session));
        $this->db->where(array('set_entrance_uidesign.phasegroup'=>$phase));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        else if($course!="" && $institute!="" && $center=="")
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
        $this->db->join('set_entrance_uidesign','set_entrance_uidesign.reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=set_entrance_uidesign.phasegroup');
        $this->db->where(array('admission_form_tbl.admission_institute_optionone'=>$institute));
        $this->db->where(array('admission_form_tbl.admission_application_selectedcourse'=>$course));
        $this->db->where(array('admission_form_tbl.admission_sessionid'=>$entrance_session));
        $this->db->where(array('set_entrance_uidesign.phasegroup'=>$phase));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        else if($course!="" && $institute=="" && $center!="")
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
        $this->db->join('set_entrance_uidesign','set_entrance_uidesign.reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=set_entrance_uidesign.phasegroup');
        $this->db->where(array('admission_form_tbl.admission_institute_examcenter'=>$center));
        $this->db->where(array('admission_form_tbl.admission_application_selectedcourse'=>$course));
        $this->db->where(array('admission_form_tbl.admission_sessionid'=>$entrance_session));
        $this->db->where(array('set_entrance_uidesign.phasegroup'=>$phase));
        $query = $this->db->get();
        return $query->result_array();
        }
        else if($course!="" && $institute!="" && $center!="")
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
        $this->db->join('set_entrance_uidesign','set_entrance_uidesign.reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=set_entrance_uidesign.phasegroup');
        $this->db->where(array('admission_form_tbl.admission_institute_examcenter'=>$center));
        $this->db->where(array('admission_form_tbl.admission_application_selectedcourse'=>$course));
        $this->db->where(array('admission_form_tbl.admission_institute_optionone'=>$institute));
        $this->db->where(array('admission_form_tbl.admission_sessionid'=>$entrance_session));
        $this->db->where(array('set_entrance_uidesign.phasegroup'=>$phase));
        $query = $this->db->get();
        return $query->result_array();
        }
        else if($course=="" && $institute!="" && $center=="")
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse');
        
        $this->db->join('set_entrance_uidesign','set_entrance_uidesign.reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=set_entrance_uidesign.phasegroup');
        $this->db->where(array('admission_form_tbl.admission_institute_optionone'=>$institute));
        $this->db->where(array('admission_form_tbl.admission_sessionid'=>$entrance_session));
       $this->db->where(array('set_entrance_uidesign.phasegroup'=>$phase));
        $query = $this->db->get();
        return $query->result_array();
        }
        }
        
        
        function usernamechk($uname,$pass)
        {
        
        $this->db->where(array('entrance_reg_username' => $username, 'entrance_reg_password' => $password));      
        return $this->db->get('entrance_examregister');
        }
        
        
        
        
        public function examget_Institute($courseid)
        {
        $query = $this->db->select('*')->where("entranceexam_insitutescourse", $courseid)->get("entranceexam_insitute");
        return $query->result_array();
        }
        
        
        public function examgetCenter($id,$sess)
        {
           
        //$query = $this->db->select('*')->where("entranceexam_centreid", $courseid)->get("entranceexam_centre");
        
        // $query = $this->db->select('*')->where("entranceexam_centreid", $id)->get("entranceexam_centre");
        // return $query->result_array();
        
        
        
        
        $this->db->from('entranceexam_centre');
        $this->db->join('entranceexam_selectedcentre','entranceexam_selectedcentre.	sel_entranceexam_centrename  = entranceexam_centre.entranceexam_centreid');
        $this->db->where(array('entranceexam_selectedcentre.sel_entranceexam_centrecourse'=>$id));
        $this->db->where(array('entranceexam_selectedcentre.sel_entranceexam_centresession'=>$sess));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
       // sel_entranceexam_centresession
        
        
        public function applicant_fees_details($id)
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id  = admission_form_tbl.admission_application_registerid');
        $this->db->join('fees_entrancepayment','fees_entrancepayment.fees_entrancepayment_student_id  = entrance_examregister.entrance_reg_id');
        $this->db->where(array('admission_form_tbl.admission_id'=> $id));
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        public function getadmitcard($sess_id)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_admitcard');
        
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id   = entranceexam_admitcard.entrance_phase','left');
        
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id  = entranceexam_admitcard.entrance_admitcardapplied_course');
        $this->db->where(array('entranceexam_admitcard.entrance_admitcardsession'=> $sess_id));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        public function getadmitby_id($id)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_admitcard');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id   = entranceexam_admitcard.entrance_phase','left');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id  = entranceexam_admitcard.entrance_admitcardapplied_course');
        $this->db->where(array('entranceexam_admitcard.entrance_admitcardid'=> $id));
        $query = $this->db->get();
        return $query->row_array();
        } 
        
        
        
        
        
        function getcourselist()
        {
        $this->db->select('*');    
        $this->db->from('entranceexam_course'); 
        $query=$this->db->get();
        return $query->result_array();
        }
        
        
        
        function Add_selected_course($data)
        {
        $query=$this->db->insert('entranceexamSelected_course',$data);
        if($query)
        {
        return true;
        }
        else
        {
        return false;
        }
        }
        
        
        
        function getselected_courselist()
        {
        $this->db->select('*');
        $this->db->from('entranceexam_course');
        $this->db->join('entranceexamSelected_course','entranceexamSelected_course.sel_entranceexam_course_name  = entranceexam_course.entranceexam_course_id');
        $this->db->join('current_settings','current_settings.cur_session  = entranceexamSelected_course.sel_entranceexam_course_session');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('current_settings.is_activestatus'=> 1));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function course_selecteddelete($id)
        {
        $sql = "delete from entranceexamSelected_course where sel_entranceexam_course_id=$id";
        $query=$this->db->query($sql); 
        }
        
        
        
        public function course_selctedeupdate($id,$course,$session) {
        $sql = "update entranceexamSelected_course set sel_entranceexam_course_name='".$course."',sel_entranceexam_course_session='".$session."' where sel_entranceexam_course_id=$id";
        $query=$this->db->query($sql);   
        }
        
        
        function edit_selectedCourse($id)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_course');
        $this->db->join('entranceexamSelected_course','entranceexamSelected_course.sel_entranceexam_course_name  = entranceexam_course.entranceexam_course_id');
        $this->db->join('current_settings','current_settings.cur_session  = entranceexamSelected_course.sel_entranceexam_course_session');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('entranceexamSelected_course.sel_entranceexam_course_id'=> $id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        function Add_selinst($data)
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
        
        
        
        
        public function get_all_institute()
        {
            
        // $this->db->select('*');
        // $this->db->from('entranceexam_insitute');
        // $this->db->join('entranceexam_selectedinsitute','entranceexam_selectedinsitute.	sel_entranceexam_insitutename  = entranceexam_insitute.entranceexam_insituteid');

        // $this->db->join('entranceexam_course','entranceexam_course.	entranceexam_course_id   = entranceexam_selectedinsitute.sel_entranceexam_insitutescourse');
        
        // $this->db->join('current_settings','current_settings.cur_session  = entranceexam_selectedinsitute.sel_entranceexam_insitutesession');
        // $this->db->join('sessions','sessions.id=current_settings.cur_session');
        // $this->db->where(array('current_settings.is_activestatus'=> 1));
        // $query = $this->db->get();
        // return $query->result_array();
      
          
        $this->db->select('*');
        $this->db->from('entranceexam_insitute');
        $this->db->join('entranceexam_course','entranceexam_course.	entranceexam_course_id = entranceexam_insitute.entranceexam_insitutescourse');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id = entranceexam_insitute.entranceexam_phaselist','left');
        $this->db->join('current_settings','current_settings.cur_session  = entranceexam_insitute.entranceexam_insitutesession');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('current_settings.is_activestatus'=> 1));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        public function phase($sess)
        {
        $this->db->select('*');
        $this->db->from('entrance_examgroup');
        $this->db->where(array('entrance_examgroup.entrance_examgroup_session'=> $sess,'entrance_examgroup_status'=>1));
        $query = $this->db->get();
        return $query->result_array();
            
        }
        
        
        public function del_selinstitute($id) 
        {
        $sql = "delete from entranceexam_insitute where entranceexam_insituteid=$id";
        $query=$this->db->query($sql);   
        }
        
        
        
        public function getsel_Institute($id)
        {
            
      /*      
       $this->db->select('*');
        $this->db->from('entranceexam_insitute');
        $this->db->join('entranceexam_selectedinsitute','entranceexam_selectedinsitute.	sel_entranceexam_insitutename  = entranceexam_insitute.entranceexam_insituteid');

        $this->db->join('entranceexam_course','entranceexam_course.	entranceexam_course_id   = entranceexam_selectedinsitute.sel_entranceexam_insitutescourse');
        
        $this->db->join('current_settings','current_settings.cur_session  = entranceexam_selectedinsitute.sel_entranceexam_insitutesession');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('entranceexam_selectedinsitute.sel_entranceexam_insituteid'=> $id));
        $query = $this->db->get();
        return $query->row_array();
        */
        
        $this->db->select('*');
        $this->db->from('entranceexam_insitute');
        $this->db->join('entranceexam_course','entranceexam_course.	entranceexam_course_id   = entranceexam_insitute.entranceexam_insitutescourse');
        $this->db->join('current_settings','current_settings.cur_session  = entranceexam_insitute.entranceexam_insitutesession');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('entranceexam_insitute.entranceexam_insituteid'=> $id));
        $query = $this->db->get();
        return $query->row_array(); 
        }
        
        
        
        function Add_selCenter($data)
        {
        $query=$this->db->insert('entranceexam_selectedcentre',$data);
        }
        
        
        
        function get_all_centerlist()
        {
            
        $this->db->select('*');
        $this->db->from('entranceexam_centre');
        $this->db->join('entranceexam_selectedcentre','entranceexam_selectedcentre.	sel_entranceexam_centrename  = entranceexam_centre.entranceexam_centreid');
        $this->db->join('entrance_examgroup','entrance_examgroup.entrance_examgroup_id=entranceexam_selectedcentre.sel_entranceexam_phase','left');

        $this->db->join('entranceexam_course','entranceexam_course.	entranceexam_course_id   = entranceexam_selectedcentre.sel_entranceexam_centrecourse');
        $this->db->join('current_settings','current_settings.cur_session  = entranceexam_selectedcentre.sel_entranceexam_centresession	');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('current_settings.is_activestatus'=> 1));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        public function center_selupdate($id,$name,$seat,$course,$session,$phase) 
        {
        $sql = "update entranceexam_selectedcentre set sel_entranceexam_centrename='".$name."',sel_entranceexam_centreseat='".$seat."',sel_entranceexam_centrecourse='".$course."',sel_entranceexam_centresession='".$session."',sel_entranceexam_phase='".$phase."' where sel_entranceexam_centreid=$id";
        $query=$this->db->query($sql);   
        }
        
        
        public function center_seldelete($id) 
        {
        $sql = "delete from entranceexam_selectedcentre where sel_entranceexam_centreid=$id";
        $query=$this->db->query($sql);   
        }
        
        
        
        public function getSelCenter($id) 
        {
        $this->db->select('*');
        $this->db->from('entranceexam_centre');
        $this->db->join('entranceexam_selectedcentre','entranceexam_selectedcentre.sel_entranceexam_centrename  = entranceexam_centre.entranceexam_centreid');
        $this->db->join('entranceexam_course','entranceexam_course.	entranceexam_course_id   = entranceexam_selectedcentre.sel_entranceexam_centrecourse');
        $this->db->join('current_settings','current_settings.cur_session  = entranceexam_selectedcentre.sel_entranceexam_centresession');
        $this->db->join('sessions','sessions.id=current_settings.cur_session');
        $this->db->where(array('entranceexam_selectedcentre.sel_entranceexam_centreid'=> $id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        public function check_address($id)
        {
        $this->db->select('*');
        $this->db->from('admission_form_tbl');
        $this->db->join('entrance_examregister','entrance_examregister.entrance_reg_id=admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_course','entranceexam_course.entranceexam_course_id=admission_form_tbl.admission_application_selectedcourse','left');
        $this->db->join('admission_form_details','admission_form_details.ad_reg_id=admission_form_tbl.admission_application_registerid','left');
        $this->db->where(array('admission_form_tbl','admission_form_tbl.admission_id'=>$id));
        $query=$this->db->get();
        return $query->row_array(); 
        }
        
        
        public function get_phse($course, $session)
        {
        $this->db->select('*');
        $this->db->from('entranceexamSelected_course');
        $this->db->where('sel_entranceexam_course_session', $session);
        $this->db->where('sel_entranceexam_course_name', $course);
        $query = $this->db->get();
        return $query->result_array();     
        }
        
        
        
        public function get_institute_phse($institute,$session,$course)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_insitute');
        $this->db->where('entranceexam_insitutename', $institute);
        $this->db->where('entranceexam_insitutesession', $session);
        $this->db->where('entranceexam_insitutescourse', $course);
        $query = $this->db->get();
        return $query->result_array();     
        }
        }
        ?>