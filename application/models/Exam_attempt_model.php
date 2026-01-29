                <?php
                class Exam_attempt_model extends MY_model
                {
                public function __construct()
                {
                parent::__construct();
                $this->current_session = $this->setting_model->getCurrentSession();
                }
                
                
                public function get_exam_type()
                {
                $this->db->select('*');
                $this->db->from('exam_type');
                $this->db->where('exam_type_status', 1);
                $query=$this->db->get();
                return $query->result_array();
                }
                
                
                public function get_attempts()
                {
                $this->db->select('*,sections.section as section,classes.class as class,sessions.session as session,exam_group_class_batch_exams.exam as exam,exam_groups.name as examgroup');
                $this->db->from('exam_attempts');
                $this->db->join('exam_groups','exam_groups.id=exam_attempts.ex_exam_group');
                $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=exam_attempts.ex_exam');
                $this->db->join('exam_type','exam_type.exam_type_id=exam_attempts.ex_exam_type');
                $this->db->join('classes','classes.id=exam_attempts.ex_class');
                $this->db->join('sections','sections.id=exam_attempts.ex_section');
                $this->db->join('sessions','sessions.id=exam_attempts.ex_session');
                $this->db->where(array('exam_attempts.ex_status'=> 1));
                $query=$this->db->get();
                return $query->result_array();
                }
                
                
                public function get_attempts_id($id)
                {
                $this->db->select('*');
                $this->db->from('exam_attempts');
                $this->db->join('exam_groups','exam_groups.id=exam_attempts.ex_exam_group');
                $this->db->join('exam_group_class_batch_exams','exam_group_class_batch_exams.id=exam_attempts.ex_exam');
                $this->db->join('exam_type','exam_type.exam_type_id=exam_attempts.ex_exam_type');
                $this->db->join('classes','classes.id=exam_attempts.ex_class');
                $this->db->join('sections','sections.id=exam_attempts.ex_section');
                $this->db->join('sessions','sessions.id=exam_attempts.ex_session');
                $this->db->where(array('exam_attempts.ex_id'=> $id,'exam_attempts.ex_status'=> 1));
                $query=$this->db->get();
                return $query->row_array();
                }
                }
