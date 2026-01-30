        <?php
        defined('BASEPATH') OR exit('No direct script access allowed');
        
        class Entranceallotment_model extends CI_Model
        {
        
        function __construct()
        {
        parent::__construct();    
        }
        
        public function index()
        {
        
        }
        
        public function list_dat($table)
        {
        $this->db->select('*');
        $this->db->from($table);
        $query=$this->db->get();
        return $query->result_array();					
        }
        public function list_data($table,$condition)
        {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);					
        $query=$this->db->get();
        return $query->result_array();					
        }
        
        public function list_valuedata($table,$condition)
        {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query=$this->db->get();
        return $query->row_array();
        }
        
        public function delete_data($table,$condition)
        {											
        $this->db->where($condition);
        return $this->db->delete($table);
        }
        
        public function updte_value($table,$data,$condition)
        {
        $this->db->where($condition);					
        return $this->db->update($table,$data);							 
        }
        
        public function getentrance_subject($entrance_course)
        {
        $this->db->select('*');
        $this->db->from ('entrance_subjecttype');
        $this->db->join('entranceexam_subject', 'entranceexam_subject.entranceexam_subject_subid = entrance_subjecttype.entrance_subtype_id');
        $this->db->where (array('entranceexam_subject.entranceexam_subject_course_id'=> $entrance_course));
        $this->db->group_by('entranceexam_subject.entranceexam_subject_subid'); 
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function get_attendance()
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_attend');
        $this->db->where (array('entranceexam_attendance_status'=> 1));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function get_applicants($course,$session_id,$subjectid,$phase)
        {
        $this->db->select('*');
        $this->db->from ('admission_form_tbl');
        $this->db->join('set_entrance_uidesign', 'set_entrance_uidesign.reg_id = admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_attend', 'entranceexam_attend.entranceexam_attendance_applicant = admission_form_tbl.admission_application_registerid');
        $this->db->where (array('admission_form_tbl.admission_application_selectedcourse'=>$course,'admission_form_tbl.admission_sessionid'=>$session_id));
        $this->db->where (array('entranceexam_attend.entranceexam_attendance_attendence'=>'Present'));
        $this->db->where (array('set_entrance_uidesign.phasegroup'=>$phase));
        $this->db->group_by('entranceexam_attend.entranceexam_attendance_applicant');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function get_allotapplicants($course,$session_id,$subj,$phaseid)
        {
        $this->db->select('*');
        $this->db->from ('admission_form_tbl');
        $this->db->join('set_entrance_uidesign', 'set_entrance_uidesign.reg_id = admission_form_tbl.admission_application_registerid');
        $this->db->join('entranceexam_subject', 'entranceexam_subject.entranceexam_subject_course_id = admission_form_tbl.admission_application_selectedcourse');
        $this->db->where(array('admission_form_tbl.admission_application_selectedcourse'=>$course,'admission_form_tbl.admission_sessionid'=>$session_id));
        $this->db->where(array('entranceexam_subject.entranceexam_subject_subid'=>$subj));
        $this->db->where(array('set_entrance_uidesign.phasegroup'=>$phaseid));
        $this->db->group_by('admission_form_tbl.admission_application_registerid');
        $query = $this->db->get();
        return  $query->result_array();
        }
        
        
        
        public function get_subjectmarks($course,$session_id,$subject)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_marks');
        $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = entranceexam_marks.entranceexam_marks_course_id');
        $this->db->join('sessions', 'sessions.id = entranceexam_marks.entranceexam_marks_session_id');
        $this->db->join('entrance_subjecttype', 'entrance_subjecttype.entrance_subtype_id = entranceexam_marks.entranceexam_marks_subject_id');
        $this->db->where (array('entranceexam_marks.entranceexam_marks_course_id'=>$course,'entranceexam_marks.entranceexam_marks_subject_id'=>$subject,'entranceexam_marks.entranceexam_marks_session_id'=>$session_id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        public function get_marks()
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_result_value');
        $this->db->join('entranceexam_marks', 'entranceexam_marks.entranceexam_marks_id = entranceexam_result_value.entranceexam_result_marksid');
        $query = $this->db->get();
        return $query->result_array();
        }
    
        
        //Exam Result
        
        public function searchExamStudents($courseid, $session_id,$phaseid)
        {
        $this->db->select('*');
        $this->db->from ('admission_form_tbl');
        $this->db->join('set_entrance_uidesign', 'set_entrance_uidesign.reg_id = admission_form_tbl.admission_application_registerid');
        $this->db->where (array('admission_form_tbl.admission_application_selectedcourse'=>$courseid,'admission_form_tbl.admission_sessionid'=>$session_id));
        $this->db->where (array('set_entrance_uidesign.phasegroup'=>$phaseid));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function searchSubjectlist($courseid,$session_id)
        {
        $this->db->select('*');
        $this->db->from ('entrance_subjecttype');
        $this->db->join('entranceexam_subject', 'entranceexam_subject.entranceexam_subject_subid = entrance_subjecttype.entrance_subtype_id');
        $this->db->where (array('entranceexam_subject.entranceexam_subject_status'=>1,'entranceexam_subject.entranceexam_subject_course_id'=>$courseid,'entranceexam_subject.entranceexam_subject_sessionid'=>$session_id));
        //$this->db->group_by('entranceexam_subject.entranceexam_subject_course_id');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function searchExamResult($courseid,$session_id)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_result_value');
        $this->db->join('entranceexam_marks', 'entranceexam_marks.entranceexam_marks_id = entranceexam_result_value.entranceexam_result_marksid');
        $this->db->where (array('entranceexam_marks.entranceexam_marks_active'=>1,'entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session_id));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function searchsubjectmarks($courseid,$session_id)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_marks');
        $this->db->where (array('entranceexam_marks.entranceexam_marks_active'=>1,'entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session_id));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        public function get_feeapplicants($course,$session_id)
        {
        $this->db->select('*');
        $this->db->from ('admission_form_tbl');
        $this->db->where (array('admission_form_tbl.admission_application_selectedcourse'=>$course,'admission_form_tbl.admission_sessionid'=>$session_id));
        $this->db->order_by('admission_form_tbl.admission_name', 'desc');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function entrance_course($sess_id)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_course');
        $this->db->join('entranceexamSelected_course','entranceexamSelected_course.sel_entranceexam_course_name=entranceexam_course.entranceexam_course_id');
        $this->db->where (array('entranceexamSelected_course.sel_entranceexam_course_session'=>$sess_id));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function get_entrancefees()
        {
        $this->db->select('*');
        $this->db->from ('fees_entrancepayment');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function Searchstudents_forallot($courseid,$session_id,$phaseid)
        {
            
        $this->db->select('*');
        $this->db->from ('admission_form_tbl');
        $this->db->join('set_entrance_uidesign', 'set_entrance_uidesign.reg_id = admission_form_tbl.admission_application_registerid'); 
        $this->db->join('entranceexam_publish_result_value', 'entranceexam_publish_result_value.exam_publish_regid = admission_form_tbl.admission_application_registerid');
        $this->db->where (array('admission_form_tbl.admission_application_selectedcourse'=>$courseid,'admission_form_tbl.admission_sessionid'=>$session_id));
      //$this->db->where (array('entranceexam_publish_result_value.exam_publish_phasegroup'=>$phaseid));
        $this->db->where (array('set_entrance_uidesign.phasegroup'=>$phaseid));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        
        public function getallot_institute($courseid)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_insitute');
        $this->db->where (array('entranceexam_insitute.entranceexam_insitutescourse'=>$courseid));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function alloted_applicants($courseid,$inst,$session_id,$statustype)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_allotment');
        $this->db->join('entranceexam_publish_result_value', 'entranceexam_publish_result_value.exam_publish_id = entranceexam_allotment.entranceexam_allotment_publishid');
        $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_registerid = entranceexam_publish_result_value.exam_publish_regid');
        $this->db->where (array('entranceexam_allotment.entranceexam_allotment_courseid'=>$courseid,'entranceexam_allotment.entranceexam_allotment_instituteid'=>$inst,'entranceexam_allotment.entranceexam_allotment_seattype'=>$statustype));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function getallotno($seattype,$entrance_course,$entrance_institute)
        {
        $this->db->select('*');
        $this->db->from ('entrance_allotmentseat');
        $this->db->where (array('entrance_allot_seat_course'=>$entrance_course,'entrance_allot_seat_institute'=>$entrance_institute,'entrance_allot_seat_type'=>$seattype));
        $this->db->order_by("entrance_allot_seat_id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function list_eligiblestatus()
        {
        $this->db->select('*');
        $this->db->from ('entrance_allotmentseat');
        $this->db->where (array('entrance_allot_seat_course'=>$entrance_course,'entrance_allot_seat_institute'=>$entrance_institute,'entrance_allot_seat_type'=>$seattype));
        $this->db->order_by("entrance_allot_seat_id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        public function list_eligble()
        {
        $this->db->select('*');
        $this->db->from ('entrance_eligiblestatus');
        $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = entrance_eligiblestatus.entrance_eligiblestatus_course');
        $this->db->join('sessions', 'sessions.id = entrance_eligiblestatus.entrance_eligiblestatus_session');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function edit_list_eligble($id)
        {
        $this->db->select('*');
        $this->db->from ('entrance_eligiblestatus');
        $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = entrance_eligiblestatus.entrance_eligiblestatus_course');
        $this->db->join('sessions', 'sessions.id = entrance_eligiblestatus.entrance_eligiblestatus_session');
        $this->db->where (array('entrance_eligiblestatus.entrance_eligiblestatus_id'=>$id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        public function search_Seatquota($course,$session_id)
        {
        $this->db->select('*');
        $this->db->from ('entrance_allotmentseat');
        $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = entrance_allotmentseat.entrance_allot_seat_course');
        $this->db->join('entranceexam_insitute', 'entranceexam_insitute.entranceexam_insituteid = entrance_allotmentseat.entrance_allot_seat_institute');
        $this->db->where (array('entrance_allotmentseat.entrance_allot_seat_course'=>$course,'entrance_allotmentseat.entrance_allot_seat_sessionid'=>$session_id));
        $this->db->group_by('entrance_allotmentseat.entrance_allot_seat_institute'); 
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function getseatval($course,$session_id,$phase)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_seatquota');
        $this->db->where (array('entranceexam_seatquota.entranceexam_seatquota_course'=>$course,'entranceexam_seatquota.entranceexam_seatquota_session'=>$session_id,
        'entranceexam_seatquota.entranceexam_seatquota_phase'=>$phase));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
       
       
        
        
        public function seatno()
        {
        $this->db->select('*');
        $this->db->from('entrance_allotmentseattype');
        $this->db->where (array('entrance_allotmentseattype.entrance_allot_type_status'=>1));
        $query = $this->db->get();
        return $query->result_array(); 
        }
        
        
        
        public function seatno_bymanagment()
        {
        $this->db->select('*');
        $this->db->from('entrance_allotmentseattype');
        $this->db->where (array('entrance_allotmentseattype.entrance_allot_type_status'=>1,'entrance_allotmentseattype.entrance_allot_type_name!='=>Merit));
        $query = $this->db->get();
        return $query->result_array(); 
        }
        
        
        
        
        public function eligibleseatno($courseid, $session_id,$entrance_phase)
        {
        $this->db->select('*');
        $this->db->from('entrance_allotmentseattype');
        $this->db->join('entranceexam_eligiblequota', 'entrance_allotmentseattype.entrance_allot_type_id=entranceexam_eligiblequota.entranceexam_eligiblequota_seattype');
        $this->db->where (array('entranceexam_eligiblequota.entranceexam_eligiblequota_course'=>$courseid,'entranceexam_eligiblequota.entranceexam_eligiblequota_session'=>$session_id,'entranceexam_eligiblequota.entranceexam_eligiblequota_phase'=>$entrance_phase));
        $query = $this->db->get();
        return $query->result_array();           
        }
        
        
        public function getseat_val($type_name,$courseid,$sessionid,$phaseid)
        {
        $this->db->select('*');
        $this->db->from('entranceexam_eligiblequota');
        $this->db->where (array('entranceexam_eligiblequota.entranceexam_eligiblequota_seattype'=>$type_name,'entranceexam_eligiblequota.entranceexam_eligiblequota_course'=>$courseid,'entranceexam_eligiblequota.entranceexam_eligiblequota_phase'=>$phaseid));
        $query = $this->db->get();
        return $query->row_array();           
        }
        
        public function exam_group_session($sess)
        {
        $this->db->select('*');
        $this->db->from('entrance_examgroup');
        $this->db->join('sessions', 'sessions.id=entrance_examgroup.entrance_examgroup_session');
        $this->db->where (array('entrance_examgroup.entrance_examgroup_session'=>$sess,'entrance_examgroup.entrance_examgroup_status'=>1));
        $query = $this->db->get();
        return $query->result_array(); 
        }
        
        
        public function getexamgroupval_row($id)
        {
        $this->db->select('*');
        $this->db->from('entrance_examgroup');
        $this->db->join('sessions', 'sessions.id=entrance_examgroup.entrance_examgroup_session');
        $this->db->where (array('entrance_examgroup.entrance_examgroup_id'=>$id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function get_publish_result($courseid, $session_id,$phaseid)
        {
        $this->db->select('*,SUM(entranceexam_result_value.entranceexam_result_getmarks) as getmark,SUM(entranceexam_result_value.entranceexam_result_max_marks) as maxmark,SUM(entranceexam_result_value.entranceexam_result_min_marks) as minmark');
        $this->db->from ('entranceexam_result_value');
        $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_registerid=entranceexam_result_value.entranceexam_result_applicant');
        $this->db->join('set_entrance_uidesign', 'set_entrance_uidesign.reg_id = admission_form_tbl.admission_application_registerid');
        $this->db->where (array('admission_form_tbl.admission_application_selectedcourse'=>$courseid,'admission_form_tbl.admission_sessionid'=>$session_id));
        $this->db->where (array('set_entrance_uidesign.phasegroup'=>$phaseid));
        $this->db->group_by('entranceexam_result_value.entranceexam_result_applicant');
        $this->db->order_by('entranceexam_result_value.entranceexam_result_applicant','asc');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function get_result_value($courseid, $session_id)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_marks');
        $this->db->join('entranceexam_result_value', 'entranceexam_result_value.entranceexam_result_marksid=entranceexam_marks.entranceexam_marks_id');
        $this->db->where (array('entranceexam_marks.entranceexam_marks_course_id'=>$courseid,'entranceexam_marks.entranceexam_marks_session_id'=>$session_id));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function getexportvalue($courseid,$inst,$session_id,$statustype)
        {
        $this->db->select('admission_form_tbl.admission_application_no,admission_form_tbl.admission_name,admission_form_tbl.admission_dob,admission_form_tbl.admission_mobile,admission_form_tbl.admission_mobile,entrance_examregister.entrance_reg_email,admission_form_tbl.admission_fathername,admission_form_tbl.admission_housename,admission_form_tbl.admission_guardianaddress,admission_form_tbl.admission_fatheroccupation,admission_form_tbl.admission_mothername ,admission_form_tbl.admission_motherhousename ,admission_form_tbl.admission_address ,admission_form_tbl.admission_adharno ,state_list.state_name ,district_list.district_name ,admission_form_tbl.admission_thaluk ,admission_form_tbl.admission_village ,admission_form_tbl.admission_mahallu ,admission_form_tbl.admission_iforphan ,admission_form_tbl.admission_guardian ,admission_form_tbl.admission_relationship ,admission_form_tbl.admission_laststudiedmadarsa ,admission_form_tbl.admission_range ,admission_form_tbl.admission_laststudied ,admission_form_tbl.admission_schoolname ,admission_form_tbl.admission_medium ,admission_form_tbl.admission_identification ,admission_form_tbl.admission_payment,admission_form_tbl.admission_photo' );
        $this->db->from ('entranceexam_allotment');
        $this->db->join('entranceexam_publish_result_value', 'entranceexam_publish_result_value.exam_publish_id = entranceexam_allotment.entranceexam_allotment_publishid');
        $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_registerid = entranceexam_publish_result_value.exam_publish_regid');
        $this->db->join('entrance_examregister', 'entrance_examregister.entrance_reg_id = admission_form_tbl.admission_application_registerid');
        $this->db->join('state_list', 'state_list.state_id = admission_form_tbl.admission_state');
        $this->db->join('district_list', 'district_list.district_id = admission_form_tbl.admission_district');
        $this->db->where (array('entranceexam_allotment.entranceexam_allotment_courseid'=>$courseid,'entranceexam_allotment.entranceexam_allotment_instituteid'=>$inst,'entranceexam_allotment.entranceexam_allotment_seattype'=>$statustype));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function getcourse_name($courseid,$inst)
        {
            
        $this->db->select('*' );
        $this->db->from('entranceexam_insitute');
        $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = entranceexam_insitute.entranceexam_insitutescourse');
        $this->db->where (array('entranceexam_insitute.entranceexam_insitutescourse'=>$courseid,'entranceexam_insitute.entranceexam_insituteid'=>$inst));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function forwardenroll_applicants($courseid,$inst,$session_id)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_allotment');
        $this->db->join('entrance_allotmentseattype', 'entrance_allotmentseattype.entrance_allot_type_id = entranceexam_allotment.entranceexam_allotment_seattype');
        $this->db->join('entranceexam_publish_result_value', 'entranceexam_publish_result_value.exam_publish_id = entranceexam_allotment.entranceexam_allotment_publishid');
        $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_registerid = entranceexam_publish_result_value.exam_publish_regid');
        $this->db->where (array('entranceexam_allotment.entranceexam_allotment_courseid'=>$courseid,'entranceexam_allotment.entranceexam_allotment_instituteid'=>$inst));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        
        public function get_max_allotseatno()
        {
        $this->db->select_max('entranceexam_allotment_seatno');
        $query = $this->db->get('entranceexam_allotment');
        return $query->row_array();
        }
        
        
        public function get_students_byregid($applicant_id)
        {
        $this->db->select('*');
        $this->db->from ('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('student_admissionfees', 'student_admissionfees.studentfees_student_id = students.id');
        $this->db->join('categories', 'categories.id = students.category_id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('sessions', 'sessions.id=student_session.session_id');
        $this->db->where (array('students.entrance_reg_id'=>$applicant_id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        
        
        
        public function get_students_byregid_details($applicant_id)
        {
        $this->db->select('*,students.id as studid');
        $this->db->from ('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('student_admissionfees', 'student_admissionfees.studentfees_student_id = students.id');
        $this->db->join('categories', 'categories.id = students.category_id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('sessions', 'sessions.id=student_session.session_id');
        $this->db->where (array('students.entrance_reg_id'=>$applicant_id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        public function get_entranceapplicant_byregid($applicant_id)
        {
        $this->db->select('*');
        $this->db->from ('admission_form_tbl');
        $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id = admission_form_tbl.admission_application_selectedcourse');
        $this->db->where (array('admission_application_registerid'=>$applicant_id));
        $query = $this->db->get();
        return $query->row_array();
        }
        
        
        //m
        public function get_phase($session_id)
        {
        $this->db->select('*');
        $this->db->from ('entrance_examgroup');
        $this->db->where (array('entrance_examgroup_session'=>$session_id,'entrance_examgroup_status'=>1));
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        public function ranklist($courseid, $session_id)
        {
        $this->db->select('*');
        $this->db->from ('entranceexam_result_value');
        $this->db->join('admission_form_tbl', 'admission_form_tbl.admission_application_registerid = entranceexam_result_value.entranceexam_result_applicant');
        $this->db->join('entranceexam_subject', 'entranceexam_subject.entranceexam_subject_subid = entranceexam_result_value.entranceexam_result_subject');
        $this->db->where (array('admission_form_tbl.admission_application_selectedcourse'=>$courseid,'entranceexam_result_value.entranceexam_result_session'=>$session_id));
        $this->db->group_by('admission_form_tbl.admission_id');
        $query = $this->db->get();
        return $query->result_array();
        }
        
        
        // public function get_fees_status()
        // {
        // $this->db->select('*');
        // $this->db->from('entranceexam_setfees');
        // $this->db->join('entrance_examgroup', 'entrance_examgroup.entrance_examgroup_id=entranceexam_setfees.entrance_setfees_phase');
        // $this->db->join('sessions', 'sessions.id=entranceexam_setfees.entrance_setfees_session');
        // $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id=entranceexam_setfees.entrance_setfees_course');
        // $query = $this->db->get();
        // return $query->result_array();
        // }
        
        
        
        public function get_fees_status()
        {
        $this->db->select('
        entranceexam_setfees.*, 
        entrance_examgroup.entrance_examgroup_name, 
        sessions.session
        ');
        $this->db->from('entranceexam_setfees');
        $this->db->join('entrance_examgroup', 'entrance_examgroup.entrance_examgroup_id = entranceexam_setfees.entrance_setfees_phase');
        $this->db->join('sessions', 'sessions.id = entranceexam_setfees.entrance_setfees_session');
        $query = $this->db->get();
        
        $fees_data = $query->result_array();
        
        // Fetch course names separately
        foreach ($fees_data as &$fee) {
        $courseIds = json_decode($fee['entrance_setfees_course'], true); // Convert JSON to array
        if (!empty($courseIds)) {
        $this->db->select('GROUP_CONCAT(entranceexam_course_name SEPARATOR ", ") AS course_names');
        $this->db->from('entranceexam_course');
        $this->db->where_in('entranceexam_course_id', $courseIds); // Filter by course IDs
        $courseQuery = $this->db->get();
        $courseResult = $courseQuery->row_array();
        $fee['course_names'] = $courseResult['course_names'] ?? '';
        } else {
        $fee['course_names'] = '';
        }
        }
        return $fees_data;
        }


        
        
        // public function get_fees_byid($id='0')
        // {
        // $this->db->select('*');
        // $this->db->from('entranceexam_setfees');
        // $this->db->join('entrance_examgroup', 'entrance_examgroup.entrance_examgroup_id=entranceexam_setfees.entrance_setfees_phase');
        // $this->db->join('sessions', 'sessions.id=entranceexam_setfees.entrance_setfees_session');
        // // $this->db->join('entranceexam_course', 'entranceexam_course.entranceexam_course_id=entranceexam_setfees.entrance_setfees_course');
        // $this->db->where (array('entranceexam_setfees.entrance_setfees_id'=>$id));
        // $query = $this->db->get();
        // return $query->row_array();
        // }
        
        
        
        
        public function get_fees_byid($id = '0')
        {
        $this->db->select('*');
        $this->db->from('entranceexam_setfees');
        $this->db->join('entrance_examgroup', 'entrance_examgroup.entrance_examgroup_id = entranceexam_setfees.entrance_setfees_phase');
        $this->db->join('sessions', 'sessions.id = entranceexam_setfees.entrance_setfees_session');
        $this->db->where(array('entranceexam_setfees.entrance_setfees_id' => $id));
        $query = $this->db->get();
        
        $fee_data = $query->row_array();  // Since we're using 'row_array()', this will return a single row of data
        
        if ($fee_data) {
        // Fetch courses for this fee entry if 'entrance_setfees_course' contains IDs
        $courseIds = json_decode($fee_data['entrance_setfees_course'], true); // Convert JSON to array
        if (!empty($courseIds)) {
        $this->db->select('GROUP_CONCAT(entranceexam_course_name SEPARATOR ", ") AS course_names');
        $this->db->from('entranceexam_course');
        $this->db->where_in('entranceexam_course_id', $courseIds);  // Filter by course IDs
        $courseQuery = $this->db->get();
        $courseResult = $courseQuery->row_array();
        $fee_data['course_names'] = $courseResult['course_names'] ?? '';  // Concatenate course names
        } else {
        $fee_data['course_names'] = '';
        }
        }
        return $fee_data;  // Return the result
        }
        
        
        
        
        public function getCoursesByPhase($phaseId,$entrance_title)
        {
        $this->db->select('entrance_setfees_course');
        $this->db->from('entranceexam_setfees'); 
        $this->db->where(array('entrance_setfees_phase' => strtoupper($phaseId), 'UPPER(entrance_setfees_fees_title)' => strtoupper($entrance_title)));
        $query = $this->db->get();
        return $query->result_array(); // Returns an array of course IDs
        }

        
        }