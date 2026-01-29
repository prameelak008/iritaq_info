                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }

                class Semester_enrollment_model extends CI_Model {
                public function __construct() {
                parent::__construct();
                $this->current_session = $this->setting_model->getCurrentSession();
                }


                /////Enrollment Tables

                public function adddoc($data)
                {
                $this->db->insert('semester_student_doc', $data);
                return $this->db->insert_id();
                }



                public function add($data, $data_setting = array())
                {

                if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('semester_students', $data);
                $message   = UPDATE_RECORD_CONSTANT . " On semester_students id " . $data['id'];
                $action    = "Update";
                $record_id = $insert_id = $data['id'];

                } 
                else
                {
                // If entrance_reg_id is provided, upsert by that key
                if (isset($data['entrance_reg_id']) && $data['entrance_reg_id'] !== '') {
                $this->db->where('entrance_reg_id', $data['entrance_reg_id']);
                $q = $this->db->get('semester_students');
                if ($q->num_rows() > 0) {
                $existing = $q->row_array();
                $this->db->where('id', $existing['id']);
                $this->db->update('semester_students', $data);
                $message   = UPDATE_RECORD_CONSTANT . " On semester_students id " . $existing['id'];
                $action    = "Update";
                return $existing['id'];
                }
                }

                if (!empty($data_setting))
                {
                if ($data_setting['adm_auto_insert']) {
                if ($data_setting['adm_update_status'] == 0) {
                $data_setting['adm_update_status'] = 1;
                $this->setting_model->add($data_setting);
                }
                }
                $this->db->insert('semester_students', $data);
                $insert_id = $this->db->insert_id();
                $message   = INSERT_RECORD_CONSTANT . " On semester_students id " . $insert_id;
                $action    = "Insert";
                $record_id = $insert_id;
                // $this->log($message, $record_id, $action);

                return $insert_id;
                }
                }
                }



                public function add_student_session($data)
                {
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
                //=======================Code Start===========================
                // $this->db->where('session_id', $data['session_id']);
                $this->db->where('student_id', $data['student_id']);
                $q = $this->db->get('semester_student_session');
                if ($q->num_rows() > 0) {
                $rec = $q->row_array();
                $this->db->where('id', $rec['id']);
                $this->db->update('semester_student_session', $data);
                $message   = UPDATE_RECORD_CONSTANT . " On  student session id " . $rec['id'];
                $action    = "Update";
                $record_id = $rec['id'];
                // $this->log($message, $record_id, $action);
                } else {
                $this->db->insert('semester_student_session', $data);
                $id        = $this->db->insert_id();
                $message   = INSERT_RECORD_CONSTANT . " On  student session id " . $id;
                $action    = "Insert";
                $record_id = $id;
                // $this->log($message, $record_id, $action);
                }
                //======================Code End==============================

                $this->db->trans_complete(); # Completing transaction
                /* Optional */

                if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
                } else {
                return true;
                }
                }

                public function max_studentsid()
                {                                   
                $this->db->select_max('admission_no');
                $this->db->from('semester_students');               

                $query=$this->db->get();
                return $query->row_array();                             
                }


                public function max_rollid()
                {                                   
                $this->db->select_max('roll_no');
                $this->db->from('semester_students');
                $query=$this->db->get();
                return $query->row_array();                             
                }



                public function add_user($data) {
                $this->db->trans_start(); # Starting Transaction
                $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
                //=======================Code Start===========================
                if (isset($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update('sem_users', $data);
                $message = UPDATE_RECORD_CONSTANT . " On  sem_users id " . $data['id'];
                $action = "Update";
                $record_id = $data['id'];
                // $this->log($message, $record_id, $action);
                } else {
                $this->db->insert('sem_users', $data);
                $insert_id = $this->db->insert_id();
                $message = INSERT_RECORD_CONSTANT . " On sem_users id " . $insert_id;
                $action = "Insert";
                $record_id = $insert_id;
                // $this->log($message, $record_id, $action);

                // return $insert_id;
                }
                //======================Code End==============================

                $this->db->trans_complete(); # Completing transaction
                /* Optional */

                if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
                } else {
                return $insert_id;
                }
                }




                // public function get_programs()
                // {
                // $this->db->select('p.p_id, p.p_type AS prog_type_id, pt.prog_type_name AS prog_type_name, p.p_name AS p_name, CONCAT(pt.prog_type_name, " - ", p.p_name) as program_name');
                // $this->db->from('programee p');
                // $this->db->join('programme_type pt', 'pt.prog_type_id = p.p_type', 'left');
                // $this->db->where('p.p_status', 1);
                // $this->db->order_by('pt.prog_type_name, p.p_name');
                // $query = $this->db->get();
                // return $query->result_array();
                // }  




                public function get_program_list()
                {
                return $this->db
                ->select('pr.id, pr.p_name, pt.prog_type_name')
                ->from('programee pr')
                ->join('programme_type pt', 'pt.prog_type_id = pr.p_type', 'left')
                ->where('pr.p_status', 1)
                ->order_by('pt.prog_type_name ASC, pr.p_name ASC')
                ->get()
                ->result_array();
                }

                public function get_batch_types()
                {
                return $this->db
                ->select('
                bt.b_id,
                bm.b_mode_id,
                bm.b_mode_name,
                bg.batch_group_name,
                bg.batch_group_year
                ')
                ->from('batchtype bt')
                ->join('batch_mode bm', 'bm.b_mode_id = bt.b_mode')
                ->join('batch_groups bg', 'bg.batch_group_id = bt.b_bid')
                ->where('bt.b_status', 1)
                ->order_by('bm.b_mode_name ASC, bg.batch_group_year ASC')
                ->get()
                ->result_array();
                }




                // public function get_batch_types_by_program($program_id)
                // {
                // return $this->db
                // ->select('bt.b_bid,bt.b_id, bm.b_mode_name, bg.batch_group_name, bg.batch_group_year')
                // ->from('batchtype bt')
                // ->join('batch_mode bm', 'bm.b_mode_id = bt.b_mode')
                // ->join('batch_groups bg', 'bg.batch_group_id = bt.b_bid')
                // ->where('bt.b_program', $program_id)   // filter by program
                // ->where('bt.b_status', 1)
                // ->order_by('bm.b_mode_name ASC, bg.batch_group_year ASC')
                // ->get()
                // ->result_array();   // MUST return the array
                // }





                public function get_batch_semester_by_program($program_id)
                {

                // $this->db->select('
                // bs.bchsem_id,
                // st.stm_name,
                // bt.b_code AS batch_group_name,
                // bm.b_mode_name');

                // $this->db->from('batch_semester bs');
                // $this->db->join('batchtype bt', 'bt.b_id = bs.bchtyp_id');
                // $this->db->join('batch_mode bm', 'bm.b_mode_id = bt.b_mode', 'left');
                // $this->db->join('semester_term st', 'st.stm_id = bs.semterm_id', 'left');

                // $this->db->where('bt.b_program', $program_id);
                // $this->db->where('bs.bchsem_status', 1);
                // $this->db->where('bt.b_status', 1);

                // $this->db->order_by('bm.b_mode_name, st.stm_name');

                // return $this->db->get()->result_array();



                $this->db->select('batch_semester.bchsem_id,
                batchtype.b_id as b_id,
                semester_term.stm_name,
                batch_groups.batch_group_name AS batch_group_name, 
                batch_groups.batch_group_year AS batch_group_year,
                batch_semester.semterm_id as 	semterm_id,               
                batch_mode.b_mode_name');              

                $this->db->from('batch_semester');
                $this->db->join('batchtype', 'batchtype.b_id = batch_semester.bchtyp_id');
                $this->db->join('batch_groups', 'batch_groups.batch_group_id  = batchtype.b_name');

                $this->db->join('batch_mode', 'batch_mode.b_mode_id = batchtype.b_mode', 'left');

                $this->db->join('semester_term ', 'semester_term.stm_id = batch_semester.semterm_id', 'left');

                $this->db->where('batchtype.b_program', $program_id);
                $this->db->where('batch_semester.bchsem_status', 1);
                $this->db->where('batchtype.b_status', 1);

                // $this->db->order_by('batch_mode.b_mode_name, semester_term.stm_name');

                return $this->db->get()->result_array();

                }




                //Batchtype, SemesterType

                public function get_batch_type($program_id)
                {
                return $this->db
                ->select('
                bt.b_id,
                bg.batch_group_name,
                bm.b_mode_name
                ')
                ->from('batchtype bt')
                ->join('batch_groups bg', 'bg.batch_group_id = bt.b_name')
                ->join('batch_mode bm', 'bm.b_mode_id = bt.b_mode', 'left')
                ->where('bt.b_program', $program_id)
                ->where('bt.b_status', 1)
                ->order_by('bm.b_mode_name', 'ASC')
                ->get()
                ->result_array();
                }



                //Batchtype,Semestertype and batch    




                public function get_semester_batch_by_program($program_id)
                { 
                $this->db->select('batch_semester.bchsem_id,
                batch_mode.b_mode_name,
                semester_term.stm_name AS semester_name,
                batch_semester.semterm_id AS semterm_id,
                batchtype.b_code AS batch_code,batch_groups.batch_group_name as batch_group_name, 
                batch_groups.batch_group_year as batch_group_year');
                
                $this->db->from('batch_semester');
                $this->db->join('batchtype', 'batchtype.b_id = batch_semester.bchtyp_id');
                $this->db->join('batch_groups', 'batch_groups.batch_group_id = batchtype.b_name');
                $this->db->join('semester_term', 'semester_term.stm_id = batch_semester.semterm_id');
                $this->db->join('batch_mode ', 'batch_mode.b_mode_id = batchtype.b_mode');
                $this->db->where('batchtype.b_program', $program_id);
                // $this->db->where('batch_semester.bchsem_status', 1);
                $this->db->order_by('batch_mode.b_mode_name, semester_term.stm_id');
                return $this->db->get()->result_array(); 
                }


                public function get_semester_term()
                {
                return $this->db
                ->select('stm_id, stm_code, stm_name, stm_status, stm_createddate')
                ->from('semester_term')
                ->where('stm_status', 1)
                ->order_by('stm_name', 'ASC')
                ->get()
                ->result_array();
                }



                public function get_programs()
                {
                $this->db->select('
                p.id AS program_id,   
                p.p_type AS prog_type_id,
                pt.prog_type_name,
                p.p_name
                ');
                $this->db->from('programee p');
                $this->db->join('programme_type pt', 'pt.prog_type_id = p.p_type', 'left');
                $this->db->where('p.p_status', 1);
                $this->db->order_by('pt.prog_type_name, p.p_name');

                return $this->db->get()->result_array();
                }



                public function get_program_types()
                {
                $this->db->select('prog_type_id, prog_type_name');
                $this->db->from('programme_type');
                $this->db->order_by('prog_type_name', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
                }




                public function get_all_semesters_batches001()
                {
                $this->db->select('*');
                $this->db->from('semester_group');
                $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');
                $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');
                $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left');
                $this->db->order_by('semestertype.st_name', 'ASC');
                $this->db->order_by('batch_groups.batch_group_year', 'ASC');
                $query = $this->db->get();
                return $query->result_array();
                }



                public function get_all_semesters_batches()
                {
                $this->db->select('*');
                $this->db->from('semester_group');
                $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');
                $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');
                $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left');

                // Group by semester type, batch year, and term to avoid duplicates
                $this->db->group_by([
                'semestertype.st_id',
                'batch_groups.batch_group_year',
                'semester_term.stm_id'
                ]);

                // Order for cleaner display
                $this->db->order_by('semestertype.st_name', 'ASC');
                $this->db->order_by('batch_groups.batch_group_year', 'ASC');
                $this->db->order_by('semester_term.stm_code', 'ASC');

                $query = $this->db->get();
                return $query->result_array();
                }


                public function check_adm_exists($admission_no)
                {        
                $this->db->where(array('admission_no' => $admission_no));
                $query = $this->db->get('semester_students');
                if ($query->num_rows() > 0) {
                return true;
                } else {
                return false;
                }
                }





                public function get($id = null)
                {
                $this->db->select('programee.*,semestertype.*,semester_term.*,batch_groups.*,semester_student_session.session_id,semester_student_session.transport_fees,semester_students.app_key,semester_students.studentsign,semester_students.parent_app_key,semester_students.vehroute_id,vehicle_routes.route_id,vehicle_routes.vehicle_id,transport_route.route_title,vehicles.vehicle_no,hostel_rooms.room_no,vehicles.driver_name,vehicles.driver_contact,hostel.id as `hostel_id`,hostel.hostel_name,room_types.id as `room_type_id`,room_types.room_type ,semester_students.hostel_room_id,semester_student_session.id as `student_session_id`,semester_student_session.fees_discount,semester_students.id,semester_students.admission_no , semester_students.roll_no,semester_students.admission_date,semester_students.firstname,semester_students.middlename,  semester_students.lastname,semester_students.image,    semester_students.mobileno, semester_students.email ,semester_students.state ,   semester_students.city , semester_students.pincode , semester_students.note, semester_students.religion, semester_students.cast, school_houses.house_name,   semester_students.dob ,semester_students.current_address, semester_students.previous_school,
                semester_students.guardian_is,semester_students.parent_id,
                semester_students.permanent_address,semester_students.category_id,semester_students.wasupno,semester_students.passportno,semester_students.adhar_no,semester_students.samagra_id,semester_students.bank_account_no,semester_students.bank_name, semester_students.ifsc_code , semester_students.guardian_name , semester_students.father_pic ,semester_students.height ,semester_students.weight,semester_students.measurement_date, semester_students.mother_pic , semester_students.guardian_pic , semester_students.guardian_relation,semester_students.guardian_phone,semester_students.guardian_address,semester_students.is_active ,semester_students.created_at ,semester_students.updated_at,semester_students.father_name,semester_students.father_phone,semester_students.blood_group,semester_students.school_house_id,semester_students.father_occupation,semester_students.mother_name,semester_students.mother_phone,semester_students.mother_occupation,semester_students.guardian_occupation,semester_students.gender,semester_students.guardian_is,semester_students.rte,semester_students.guardian_email, sem_users.username,sem_users.password,semester_students.dis_reason,semester_students.dis_note,semester_students.disable_at,semester_students.last_studied_madrasa,semester_students.entrance_reg_id,semester_students.last_studied_madrasa_class,semester_students.previous_reg_no,semester_students.last_studied_school,semester_students.last_studied_class,semester_students.previous_medium,semester_students.last_studied_institute,semester_students.years_completed,semester_students.previous_place,semester_students.name_of_prominent_teacher,semester_students.major_books_studied,semester_students.general_education')->from('semester_students');
                $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id');

                $this->db->join('semester_group', 'semester_group.sem_group_id = semester_student_session.sem_group_id');
                $this->db->join('semestertype', 'semestertype.st_id = semester_group.sem_group_semester', 'left');

                $this->db->join('semester_term', 'semester_term.stm_id = semester_group.sem_group_semester_term', 'left');

                $this->db->join('batch_groups', 'batch_groups.batch_group_id = semester_group.sem_group_batchgroup', 'left');

                $this->db->join('programee', 'programee.id = semester_group.sem_group_program', 'left');

                $this->db->join('hostel_rooms', 'hostel_rooms.id = semester_students.hostel_room_id', 'left');
                $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
                $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
                $this->db->join('vehicle_routes', 'vehicle_routes.id = semester_students.vehroute_id', 'left');
                $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
                $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
                $this->db->join('school_houses', 'school_houses.id = semester_students.school_house_id', 'left');
                $this->db->join('sem_users', 'sem_users.user_id = semester_students.id', 'left');

                // $this->db->where('semester_student_session.session_id', $this->current_session);
                $this->db->where('sem_users.role', 'student');
                if ($id != null) {
                $this->db->where('semester_students.id', $id);
                } else {
                $this->db->where('semester_students.is_active', 'yes');
                $this->db->order_by('semester_students.id', 'desc');
                }
                $query = $this->db->get();
                if ($id != null) {
                return $query->row_array();
                } else {
                return $query->result_array();
                }
                }


                public function Newlistlogindetails()
                {   

                $this->db->select('*');
                $this->db->from('semester_students');
                $this->db->join('sem_users', 'semester_students.id = sem_users.user_id', 'left');
                $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id');        
                $this->db->join('categories', 'semester_students.category_id = categories.id', 'left'); 
                $this->db->where('semester_students.is_active', 'yes');
                $query = $this->db->get();
                return $query->result_array();
                }





                public function getNameByGroup($semGroup) { 
                $this->db->select('*');
                $this->db->from('semester_students');
                $this->db->join(' semester_student_session', ' semester_student_session.student_id  = semester_students.id'); 
                $this->db->where(array('semester_student_session.sem_group_id'=>$semGroup));       
                $query = $this->db->get();
                return $query->result_array();
                }   

                public function get_bysemgroup($semGroup) { 
                $this->db->select('*,semester_students.*,semester_student_session.*,semester_student_session.id as stud_id');
                $this->db->from('semester_students');
                $this->db->join(' semester_student_session', ' semester_student_session.student_id  = semester_students.id'); 
                $this->db->where(array('semester_student_session.sem_group_id'=>$semGroup));       
                $query = $this->db->get();
                return $query->result_array();
                }    




                // public function NewlistlogindetailsId($semGroup,$studentlist)
                // { 
                // $this->db->select('*');
                // $this->db->from('semester_students');
                // $this->db->join('sem_users', 'semester_students.id = sem_users.user_id', 'left');
                // $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id', 'left');        
                // $this->db->join('categories', 'semester_students.category_id = categories.id', 'left');    
                // $this->db->where(array('semester_student_session.sem_group_id'=> $semGroup));
                //  $this->db->where(array('semester_student_session.student_id'=> $studentlist));

                // $this->db->where('semester_students.is_active', 'yes');        
                // $query = $this->db->get();
                // return $query->result_array(); 





                public function NewlistlogindetailsId001($semGroup = null, $studentlist = null)
                {
                $this->db->select('*');
                $this->db->from('semester_students');
                $this->db->join('sem_users', 'semester_students.id = sem_users.user_id', 'left');
                $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id', 'left');        
                $this->db->join('categories', 'semester_students.category_id = categories.id', 'left');

                // If semester group is provided, filter by it
                if ($semGroup !== null) {
                $this->db->where('semester_student_session.sem_group_id', $semGroup);
                }

                // If student ID is provided, filter by it
                if ($studentlist !== null) {
                $this->db->where('semester_student_session.student_id', $studentlist);
                } 
                // If only name is provided (no student ID), search by name
                else if ($studentlist === null && $this->input->post('namelist')) {
                $name = $this->input->post('namelist');
                $this->db->group_start()
                ->like('semester_students.firstname', $name)
                ->or_like('semester_students.middlename', $name)
                ->or_like('semester_students.lastname', $name)
                ->group_end();
                }

                $this->db->where('semester_students.is_active', 'yes');        
                $query = $this->db->get();
                return $query->result_array();         
                }




                public function NewlistlogindetailsId($semGroup = null, $student_id = null, $nameSearch = null)
                {
                $this->db->select('*');
                $this->db->from('semester_students');
                $this->db->join('sem_users', 'semester_students.id = sem_users.user_id', 'left');
                $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id', 'left');
                $this->db->join('categories', 'semester_students.category_id = categories.id', 'left');

                // Filter by sem group
                if ($semGroup !== null) {
                $this->db->where('semester_student_session.sem_group_id', $semGroup);
                }

                // Filter by student ID if provided
                if (!empty($student_id)) {
                $this->db->where('semester_student_session.student_id', $student_id);
                }

                // Name search (only when ID is not provided)
                if (empty($student_id) && !empty($nameSearch)) {
                $this->db->group_start()
                ->like('semester_students.firstname', $nameSearch)
                ->or_like('semester_students.middlename', $nameSearch)
                ->or_like('semester_students.lastname', $nameSearch)
                ->group_end();
                }

                $this->db->where('semester_students.is_active', 'yes');
                $query = $this->db->get();
                return $query->result_array();
                }



                public function getStudentSession($id)
                {        
                $query = $this->db->query("SELECT  max(sessions.id) as student_session_id, max(sessions.session) as session from sessions join student_session on (sessions.id = student_session.session_id)  where student_session.student_id = " . $id);

                return $query->row_array();
                }




                public function getStudentLoginDetails($student_id) 
                {
                $sql = "SELECT sem_users.* FROM sem_users WHERE id in (select semester_students.parent_id from sem_users INNER JOIN semester_students on semester_students.id =sem_users.user_id WHERE sem_users.user_id=" . $this->db->escape($student_id) . " AND sem_users.role ='student') UNION select sem_users.* from sem_users INNER JOIN semester_students on semester_students.id =sem_users.user_id WHERE sem_users.user_id=" . $this->db->escape($student_id) . " AND sem_users.role ='student'";
                $query = $this->db->query($sql);
                return $query->result();
                }



                public function getdisableStudent($sem_group_id)
                {  
                $this->db->select('*,semester_students.id as id');
                $this->db->from('semester_student_session'); 
                $this->db->join('semester_students', ' semester_students.id   = semester_student_session.student_id'); 
                $this->db->where(array('semester_student_session.sem_group_id' =>$sem_group_id));
                $this->db->where(array('semester_students.is_active' =>no));
                $this->db->order_by('semester_students.firstname','Asc');
                $query=$this->db->get();
                return $query->result_array(); 
                } 



                public function getUserLoginDetails($student_id) {
                $sql = "SELECT sem_users.* FROM sem_users WHERE user_id =" . $student_id . " and role = 'student'";
                $query = $this->db->query($sql);
                return $query->row_array();
                }

                public function disableStudent($id, $data)
                {
                $this->db->where("id", $id)->update("semester_students", $data);
                }


                public function get_tc_details($student_id)
                {
                $this->db->select('*');
                $this->db->from('transfer_certificates'); 
                $this->db->join('semester_group','semester_group.sem_group_id=transfer_certificates.sem_group_id');
                $this->db->join('semester_students','semester_students.id=transfer_certificates.student_id');
                $this->db->join('programee','programee.id=semester_group.sem_group_program'); 
                $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
                $this->db->join('semestertype','semestertype.st_id=semester_group.sem_group_semester');  
                $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup'); 
                $this->db->where(array('transfer_certificates.student_id'=>$student_id));
                $query = $this->db->get();
                return $query->row_array();
                }



                public function get_tc_data($student_id, $sem_group_id) 
                {
                $this->db->select('*');
                $this->db->from('transfer_certificates'); 
                $this->db->join('semester_group','semester_group.sem_group_id=transfer_certificates.sem_group_id');
                $this->db->join('semester_students','semester_students.id=transfer_certificates.student_id');
                $this->db->join('programee','programee.id=semester_group.sem_group_program'); 
                $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
                $this->db->join('semestertype','semestertype.st_id=semester_group.sem_group_semester');  
                $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup'); 

                $this->db->where([
                'transfer_certificates.student_id' => $student_id,
                'transfer_certificates.sem_group_id' => $sem_group_id
                ]);

                return $this->db->get()->row_array();
                }

                }




