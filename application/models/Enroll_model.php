        <?php
        defined('BASEPATH') OR exit('No direct script access allowed');
        
        class Enroll_model extends CI_Model
        {
        
        function __construct()
        {
        parent::__construct();    
        }
        
        
        
        public function index()
        {
        
        }

        
        
        public function getapplicant($applicant)
        {
        $this->db->select('*');
        $this->db->from('entrance_examregister');
        $this->db->join('admission_form_tbl','admission_form_tbl.admission_application_registerid=entrance_examregister.entrance_reg_id');
        $this->db->join('state_list','state_list.state_id=admission_form_tbl.admission_state');
        $this->db->join('district_list','district_list.district_id=admission_form_tbl.admission_district');
        $this->db->where(array('admission_form_tbl.admission_application_registerid'=>$applicant));
        $query=$this->db->get();
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
        
        
        
        
        

        
        
        
        
        }