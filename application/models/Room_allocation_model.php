            <?php

            if (!defined('BASEPATH'))
            exit('No direct script access allowed');


            class Room_allocation_model extends MY_Model {
            public function __construct() {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }


            public function add_buildingblock($data)
            { 
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['build_id']))
            {
            $this->db->where('build_id', $data['build_id']);
            $this->db->update('building_block', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  building_block  build_id " . $data['build_id'];
            $action    = "Update";
            $record_id = $data['build_id'];
            } else {
            $this->db->insert('building_block', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  building_block  build_id " . $return_value;
            $action       = "Insert";
            $record_id    = $return_value;
            }

            $this->log($message, $record_id, $action);

            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {

            return $record_id;
            }
            }



            /* ................................  Database-------------------------------------------------------*/







            public function list_row($table)
            {
            $this->db->select('*');
            $this->db->from($table);
            $query=$this->db->get();
            return $query->row_array();
            }

            public function list_result($table)
            {
            $this->db->select('*');
            $this->db->from($table);
            $query=$this->db->get();
            return $query->result_array();					
            }



            public function list_result_condition($table,$condition)
            {
            $this->db->select('*');
            $this->db->from($table);

            $this->db->where($condition);
            // $this->db->group_by($groupby);
            $query=$this->db->get();
            return $query->result_array();					
            }



            public function list_row_condition($table,$condition)
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

            public function update_value($table,$data,$condition)
            {
            $this->db->where($condition);					
            return $this->db->update($table,$data);							 
            }



            public function insert_value($table, $data)
            {
            // Insert the data into the specified table
            $inserted = $this->db->insert($table, $data);

            // Return true if insert was successful, false otherwise
            return $inserted;
            }




            public function insert_or_update($table, $data, $condition)
            {
            // Check if a record exists based on the condition
            $this->db->where($condition);
            $query = $this->db->get($table);

            if ($query->num_rows() > 0) {
            // Record exists → update it
            $this->db->where($condition);
            return $this->db->update($table, $data);
            } else {
            // Record does not exist → insert it
            return $this->db->insert($table, $data);
            }
            }



            public function get_capacity_list($id = null) {
            $this->db->select('*');
            $this->db->from('classroom_capacity');            
            $this->db->join('building_block','building_block.build_id=classroom_capacity.cl_cap_building_id');
            $this->db->join('floor','floor.floor_id=classroom_capacity.cl_cap_floor_id');
            $this->db->join('classroom_types','classroom_types.cls_roomtype_id =classroom_capacity.cl_cap_classroom_type_id');
            $this->db->join('room_type','room_type.roomtype_id=classroom_capacity.cl_cap_roomtype_id');

            if ($id != null) 
            {
            $this->db->where('classroom_capacity.cl_cap_id ', $id );
            } 
            else 
            {
            $this->db->order_by('classroom_capacity.cl_cap_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }




            //////////////////////////Not used.....


            public function get($id = null) {
            $this->db->select()
            ->from('classroom');

            $this->db->join('building_block','building_block.id=classroom.cl_building_block');
            $this->db->join('floor','floor.id=classroom.cl_floor');
            $this->db->join('classroom_type','classroom_type.cls_id =classroom.cl_type');
            if ($id != null) 
            {
            $this->db->where('classroom.cl_id', $id );
            } 
            else 
            {
            $this->db->order_by('classroom.cl_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }



            public function get_Clssdata($id)
            {
            $this->db->select()
            ->from('classroom');
            $this->db->join('building_block','building_block.id=classroom.cl_building_block');
            $this->db->join('floor','floor.id=classroom.cl_floor');
            $this->db->join('classroom_type','classroom_type.cls_id =classroom.cl_type'); 
            $this->db->where('classroom.cl_id', $id );
            $query = $this->db->get();
            return $query->row_array();
            }



            public function get_type($id = null) {
            $this->db->select()
            ->from('classroom_type');
            if ($id != null) 
            {
            $this->db->where('classroom_type.cls_id', $id );
            } else {
            $this->db->order_by('classroom_type.cls_id');
            }
            $query = $this->db->get();
            if ($id  != null) {
            return $query->row_array();
            } else {
            return $query->result_array();
            }
            }



            public function add($data)
            {

            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['id']))
            {
            $this->db->where('cl_id', $data['id']);
            $this->db->update('classroom', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  classroom   cl_id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('classroom', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  classroom   cl_id " . $return_value;
            $action       = "Insert";
            $record_id    = $return_value;
            }

            $this->log($message, $record_id, $action);

            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {

            return $record_id;
            }
            }











            public function add_floor($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['id']))
            {
            $this->db->where('id', $data['id']);
            $this->db->update('floor', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  floor   	id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('floor', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  floor   	id " . $return_value;
            $action       = "Insert";
            $record_id    = $return_value;
            }

            $this->log($message, $record_id, $action);

            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {

            return $record_id;
            }
            }





            public function add_clstype($data)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['cls_id']))
            {
            $this->db->where('cls_id', $data['cls_id']);
            $this->db->update('classroom_type', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  classroom_type   	cls_id " . $data['cls_id'];
            $action    = "Update";
            $record_id = $data['id'];
            } else {
            $this->db->insert('classroom_type', $data);
            $return_value = $this->db->insert_id();
            $message      = INSERT_RECORD_CONSTANT . " On  classroom_type   	cls_id " . $return_value;
            $action       = "Insert";
            $record_id    = $return_value;
            }

            $this->log($message, $record_id, $action);

            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {

            return $record_id;
            }
            }







            public function remove($id) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('cl_id', $id);
            $this->db->delete('classroom');
            $message = DELETE_RECORD_CONSTANT . " On classroom  cl_id " . $id;
            $action = "Delete";
            $record_id = $id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================
            $this->db->trans_complete(); # Completing transaction
            /* Optional */
            if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } else {
            //return $return_value;
            }
            } 

            public function get_buildingblock()
            {                                   
            $this->db->select('*');
            $this->db->from('building_block');
            $query=$this->db->get();
            return $query->result_array();                             
            }

            public function get_buildingblock_bystatus()
            {                                   
            $this->db->select('*');
            $this->db->from('building_block');
            $this->db->where(array('status' =>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }


            public function get_floor_bystatus()
            {                                   
            $this->db->select('*');
            $this->db->from('floor');
            $this->db->where(array('status' =>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }



            public function get_type_bystatus()
            {                                   
            $this->db->select('*');
            $this->db->from('classroom_type');
            $this->db->where(array('cls_status' =>1));
            $query=$this->db->get();
            return $query->result_array();                             
            }            



            public function getfloorlist_bybuilding($id)
            {
            $this->db->select('*');
            $this->db->from('classroom_capacity');
            $this->db->join('floor','floor.floor_id=classroom_capacity.cl_cap_floor_id');
            $this->db->where(array('cl_cap_building_id' =>$id));
            $this->db->group_by('classroom_capacity.cl_cap_floor_id');
            $query=$this->db->get();
            return $query->result_array();                  
            }


            public function getroomtype_byfloor($id)
            {
            $this->db->select('*');
            $this->db->from('classroom_capacity');            
            $this->db->where(array('classroom_capacity.cl_cap_floor_id' =>$id));
            $this->db->group_by('classroom_capacity.cl_cap_room_number');
            $query=$this->db->get();
            return $query->result_array(); 
            }


            public function getclastypelist_byfloor($id,$building_bl)
            {
            $this->db->select('*');
            $this->db->from('classroom_capacity');
            $this->db->join('classroom_types','classroom_types.cls_roomtype_id=classroom_capacity.cl_cap_classroom_type_id');
            $this->db->where(array('classroom_capacity.cl_cap_floor_id' =>$id,'cl_cap_building_id'=>$building_bl));
            $this->db->group_by('classroom_capacity.cl_cap_classroom_type_id');
            $query=$this->db->get();
            return $query->result_array();                  
            }            




            public function getroomtypeByclass($id,$sethall_cap_building,$sethall_build_floor)
            {
            $this->db->select('*');
            $this->db->from('classroom_capacity');
            $this->db->join('room_type','room_type.	roomtype_id=classroom_capacity.cl_cap_roomtype_id');
            $this->db->where(array('classroom_capacity.cl_cap_classroom_type_id' =>$id));
            $this->db->where(array('classroom_capacity.cl_cap_building_id' =>$sethall_cap_building));
            $this->db->where(array('classroom_capacity.cl_cap_floor_id' =>$sethall_build_floor));
            $this->db->group_by('classroom_capacity.cl_cap_roomtype_id');
            $query=$this->db->get();
            return $query->result_array();                  
            }


            public function get_capacitylist($cl_cap_building,$cl_room_types,$cl_classroom_types,$cl_build_floor,$sethall_room_no)
            {
            $this->db->select('*');
            $this->db->from('classroom_capacity');           
            $this->db->where(array('cl_cap_building_id' =>$cl_cap_building,'classroom_capacity.cl_cap_roomtype_id ' =>$cl_room_types,'classroom_capacity.cl_cap_classroom_type_id ' =>$cl_classroom_types,'classroom_capacity.cl_cap_floor_id' =>$cl_build_floor,'classroom_capacity.cl_cap_room_number' =>$sethall_room_no));            
            $this->db->order_by('cl_cap_id', 'DESC');
            $this->db->limit(1);
            $query=$this->db->get();
            return $query->row_array(); 
            }



            public function fetch_allrooms($pl_building,$pl_build_floor,$pl_classroom_types,$pl_room_types)
            {
            $this->db->select('*');
            $this->db->from('classroom_capacity');         
            $this->db->where(array('classroom_capacity.cl_cap_building_id' =>$pl_building));
            $this->db->where(array('classroom_capacity.cl_cap_floor_id' =>$pl_build_floor));
            $this->db->where(array('classroom_capacity.cl_cap_classroom_type_id' =>$pl_classroom_types));
            $this->db->where(array('classroom_capacity.cl_cap_roomtype_id' =>$pl_room_types));
            // $this->db->group_by('classroom_capacity.cl_cap_roomtype_id');
            $this->db->group_by('classroom_capacity.cl_cap_capacity');
            $query=$this->db->get();
            return $query->result_array();  
            }


            
            public function get_students($sem_group_id)
            {               
            $this->db->select('*,semester_students.id as id');
            $this->db->from('semester_student_session'); 
             
            // $this->db->join('semester_student_tbl','semester_student_tbl.sem_student_id=semester_studentdetails.stud_id');

            // $this->db->join('semester_studentdetails','semester_studentdetails.sem_student_id=semester_studentdetails.stud_id');            
            // $this->db->join('semester_students','semester_students.id=semester_studentdetails.stud_student_id');


            $this->db->join('semester_students', ' semester_students.id   = semester_student_session.student_id'); 

            // $this->db->join('semester_student_session', ' semester_student_session.student_id   = semester_students.id'); 
            $this->db->where(array('semester_student_session.sem_group_id' =>$sem_group_id));
              $this->db->where(array('semester_students.is_active' =>yes));
            // $this->db->group_by('semester_studentdetails.stud_semgroupid');
            $this->db->order_by('semester_students.firstname','Asc');

            $query=$this->db->get();
            return $query->result_array(); 
            } 

            


////////////////////////////// Library  Starts.............................

            public function get_lib_member($sem_group_id)
            {     
                     
            $this->db->select('*,semester_students.id as id,sem_libarary_members.library_card_no,sem_libarary_members.id as libarary_member_id');
            $this->db->from('semester_student_session');          
           

            $this->db->join('semester_students', ' semester_students.id   = semester_student_session.student_id');            
             $this->db->join('sem_libarary_members', ' sem_libarary_members.member_id = semester_student_session.student_id','left'); 

            // $this->db->join('semester_student_session', ' semester_student_session.student_id   = semester_students.id'); 
            $this->db->where(array('semester_student_session.sem_group_id' =>$sem_group_id));
             $this->db->where(array('semester_students.is_active' =>yes));
            // $this->db->group_by('semester_studentdetails.stud_semgroupid');
            $this->db->order_by('semester_students.firstname','Asc');
            $query=$this->db->get();
            return $query->result_array(); 
            } 


            

            public function get_bookissue_members()
            {       
            $this->db->select('*,semester_students.id as id,sem_libarary_members.library_card_no,sem_libarary_members.id as libarary_member_id');
            $this->db->from('semester_student_session');
            $this->db->join('semester_students', ' semester_students.id   = semester_student_session.student_id');            
            $this->db->join('sem_libarary_members', ' sem_libarary_members.member_id = semester_student_session.student_id');            
            
            $this->db->where(array('semester_students.is_active' =>yes));           
            $this->db->order_by('semester_students.firstname','Asc');
            $this->db->group_by('semester_student_session.student_id');
            $query=$this->db->get();
            return $query->result_array(); 
            } 


         
            
        function surrender($id) 
        {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('sem_libarary_members');
        $message = DELETE_RECORD_CONSTANT . " On sem_libarary_members  id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);

        $this->db->where('member_id', $id);
        $this->db->delete('sem_book_issues');
        $message = DELETE_RECORD_CONSTANT . " On sem_book_issues issues id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        // //======================Code End==============================
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



        public function getByMemberID($id = null)
        {
        $this->db->select()->from('sem_libarary_members');
        if ($id != null) {
        $this->db->where('sem_libarary_members.id', $id);
        }
        $query = $this->db->get();
        if ($id != null) {
        $result = $query->row();
        if ($result->member_type == "student") {
        $return = $this->getStudentData($result->id);
        } else {
        // $return = $this->getTeacherData($result->id);
        }
        return $return;
        }
        }


        function getStudentData($id) 
        {
        $this->db->select('sem_libarary_members.id as `lib_member_id`,sem_libarary_members.library_card_no,sem_libarary_members.member_type,semester_students.*');
        $this->db->from('sem_libarary_members');
        $this->db->join('semester_students', 'sem_libarary_members.member_id = semester_students.id');
        $this->db->where('sem_libarary_members.id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
        }


        public function getMemberBooks($member_id = null) 
        {
        $this->db->select('library_cp_id,library_circulationprivileges.library_cp_category,library_circulationprivileges.library_cp_no_of_days,sem_book_issues.id,sem_book_issues.return_date,sem_book_issues.duereturn_date,sem_book_issues.issue_date,sem_book_issues.is_returned,sem_book_issues.amount_paid,books.book_title,books.book_no,books.author,books.rack_no,books.isbn_no,books.perunitcost')->from('sem_book_issues');
        $this->db->join('books', 'books.id = sem_book_issues.book_id', 'left');
        $this->db->join('sem_libarary_members', 'sem_libarary_members.id = sem_book_issues.member_id', 'left');
        $this->db->join('library_circulationprivileges', 'library_circulationprivileges.library_cp_category = sem_libarary_members.member_type', 'left');
        
        if ($member_id != null) {
        $this->db->where('sem_book_issues.member_id', $member_id);
        $this->db->order_by("sem_book_issues.is_returned", "asc");
        }
        $this->db->group_by(['sem_book_issues.book_id', 'sem_book_issues.issue_date', 'sem_book_issues.member_id']);
        $query = $this->db->get();
        return $query->result_array();
        }



         public function add_book_issues($data) 
         {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->insert('sem_book_issues', $data);
        $insert_id = $this->db->insert_id();
        $message = INSERT_RECORD_CONSTANT . " On sem_book_issues issues id " . $insert_id;
        $action = "Insert";
        $record_id = $insert_id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        
        if ($this->db->trans_status() === false) {
        # Something went wrong.
        $this->db->trans_rollback();
        return false;
        } else {
        //return $return_value;
        }
        return $insert_id;
        }


        public function update($data) 
        {
        if (isset($data['id'])) {
        $this->db->where('id', $data['id']);
        $this->db->update('sem_book_issues', $data);
        }
        }


//////////////////////////////  End Library.............................






///////////////////////Generate Id Card.................................

                public function get_students_for_id($sem_group_id)
                {     

                $this->db->select('*,semester_students.id as id');
                $this->db->from('semester_student_session');  

                $this->db->join('semester_students', ' semester_students.id   = semester_student_session.student_id');            

                $this->db->where(array('semester_student_session.sem_group_id' =>$sem_group_id));
                $this->db->where(array('semester_students.is_active' =>yes));
                // $this->db->group_by('semester_studentdetails.stud_semgroupid');
                $this->db->order_by('semester_students.firstname','Asc');
                $query=$this->db->get();
                return $query->result_array(); 
                } 



/////////////////////End  Generate Id Card.......




            public function get_studentscount($sem_group_id)
            {
            $this->db->from('semester_studentdetails');
            $this->db->where('stud_semgroupid', $sem_group_id);
            return $this->db->count_all_results(); 
            }


            public function get_subjects($sem_group_id)
            {
            $this->db->select('*,subjects.id as id,subjects.name as name');
            $this->db->from('semester_assign_subjects'); 
            $this->db->join('semester_subject_group_subjects','semester_subject_group_subjects.subject_group_id=semester_assign_subjects.sem_assign_subjects_id');
            $this->db->join('subjects','subjects.id=semester_subject_group_subjects.subject_id');
            $this->db->where(array('semester_assign_subjects.sem_assign_group_id' =>$sem_group_id));
            // $this->db->group_by('semester_studentdetails.stud_semgroupid');
            $query=$this->db->get();
            return $query->result_array(); 
            }



            public function get_seat_list()
            {
            $this->db->select('
            b.build_name,
            rt.roomtype_name,
            ct.cls_roomtype_name,
            f.floor_name,
            c.cl_cap_id,
            c.cl_cap_room_number,
            c.cl_cap_capacity
            ');
            $this->db->from('classroom_capacity c');
            $this->db->join('building_block b', 'b.build_id = c.cl_cap_building_id');
            $this->db->join('floor f', 'f.floor_id = c.cl_cap_floor_id');
            $this->db->join('room_type rt', 'rt.roomtype_id = c.cl_cap_roomtype_id', 'left');
            $this->db->join('classroom_types ct', 'ct.cls_roomtype_id = c.cl_cap_classroom_type_id', 'left');
            $this->db->order_by('b.build_name, f.floor_name, c.cl_cap_room_number ASC');
            $query = $this->db->get();
            return $query->result_array();
            }




            public function get_seat_capacity($capacity)
            {              
            $this->db->select('*');
            $this->db->from('classroom_capacity');
            $this->db->where(array('cl_cap_id' =>$capacity));
            $query=$this->db->get();
            return $query->row_array(); 
            }

//Generate Id Card List

        public function getStudentsByArray($array)
        {
        $i             = 1;
        // $custom_fields = $this->customfield_model->get_custom_fields('students');
        
        $field_var_array = array();
        // if (!empty($custom_fields)) {
        // foreach ($custom_fields as $custom_fields_key => $custom_fields_value) {
        // $tb_counter = "table_custom_" . $i;
        // array_push($field_var_array, 'table_custom_' . $i . '.field_value as ' . $custom_fields_value->name);
        // $this->db->join('custom_field_values as ' . $tb_counter, 'students.id = ' . $tb_counter . '.belong_table_id AND ' . $tb_counter . '.custom_field_id = ' . $custom_fields_value->id, 'left');
        // $i++;
        // }
        // }
        
        // $field_variable = implode(',', $field_var_array);
        
        // $this->db->select('d AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname, students.middlename, students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,students.blood_group, students.barcode,students.qrcode,students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.cast,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.mother_name,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`,' . $field_variable)->from('students');
        // $this->db->join('student_session', 'student_session.student_id = students.id');
        // $this->db->join('classes', 'student_session.class_id = classes.id');
        // $this->db->join('sections', 'sections.id = student_session.section_id');
        // $this->db->join('categories', 'students.category_id = categories.id', 'left');
        // $this->db->join('users', 'users.user_id = students.id', 'left');
        // $this->db->where('student_session.session_id', $this->current_session);
        // $this->db->where('users.role', 'student');
        // $this->db->where_in('students.id', $array);
        // $this->db->order_by('students.id');
        
        // $query = $this->db->get();
        // return $query->result();
     


        $field_variable = implode(',', $field_var_array);
        $this->db->select("
        semester_students.blood_group,
        semester_students.barcode,
        semester_students.qrcode,
        semester_students.permanent_address,
        IFNULL(semester_students.category_id, 0) AS category_id,
        IFNULL(categories.category, '') AS category,
        semester_students.adhar_no,
        semester_students.samagra_id,
        semester_students.bank_account_no,
        semester_students.cast,
        semester_students.bank_name,
        semester_students.ifsc_code,
        semester_students.guardian_name,
        semester_students.guardian_relation,
        semester_students.guardian_phone,
        semester_students.guardian_address,
        semester_students.is_active,
        semester_students.created_at,
        semester_students.updated_at,
        semester_students.mother_name,
        semester_students.father_name,
        semester_students.rte,
        semester_students.gender,
        sem_users.id AS user_tbl_id,
        sem_users.username,
        sem_users.password AS user_tbl_password,
        sem_users.is_active AS user_tbl_active,
        $field_variable
        ");

        $this->db->from('semester_students');
        $this->db->join('semester_student_session', 'semester_student_session.student_id = semester_students.id');
        $this->db->join('categories', 'semester_students.category_id = categories.id', 'left');
        $this->db->join('sem_users', 'sem_users.user_id = semester_students.id AND sem_users.role = "student"', 'left');
        $this->db->where_in('semester_students.id', $array);
        $this->db->order_by('semester_students.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
        }


        }
