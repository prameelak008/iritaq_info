        <?php

        if (!defined('BASEPATH'))
        exit('No direct script access allowed');

        class Semesteractivities_model extends MY_Model 
        {

        public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        } 

        //.........................Assign Subject Teacher



        public function get_teachingstaff($id = null) 
        { 
        $this->db->select('*,staff.id as staff_id');          
        $this->db->from('staff');
        $this->db->join('staff_roles','staff_roles.staff_id =staff.id'); 
        $this->db->join('staff_branch','staff_branch.st_staff =staff.id');
        if ($id != null) 
        {
        $this->db->where('staff.id', $id );
        } 
        else 
        {
        $this->db->order_by('staff.id');
        }
        $this->db->where('staff_roles.role_id',2 );  
        $this->db->where('staff.is_active',1 );  
        $query = $this->db->get();
        if ($id  != null) {
        return $query->row_array();
        } else {
        return $query->result_array();
        }
        $query=$this->db->get();
        return $query->result_array();          
        }   


        public function getteacher_branch($teacher_id)
        {            
        $this->db->select('st_branch');
        $this->db->from('staff_branch');
        $this->db->where('st_staff', $teacher_id);
        $query = $this->db->get();
        return $query->row_array();
        }


        public function get_subjects($group_id)
        {
        $this->db->select('subjects.id, subjects.name');
        $this->db->from('semester_subject_group_subjects');
        $this->db->join('subjects', 'subjects.id = semester_subject_group_subjects.subject_id');
        $this->db->where('semester_subject_group_subjects.subject_group_id', $group_id);
        $query = $this->db->get();
        return $query->result_array();
        }



        public function get_papers($subject_id)
        {
        $this->db->select('*');
        $this->db->from('semestersubjectpaper');
        $this->db->join('subjects', 'subjects.id = semestersubjectpaper.sem_paper_subjectid ');
        $this->db->where('semestersubjectpaper.sem_paper_subjectid', $subject_id);
        $query = $this->db->get();
        return $query->result_array();
        }

        public function add($data)
        { 
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['assign_id']))
        {   


        $this->db->where('assign_id', $data['assign_id']);
        $this->db->update('teacher_subject_assignments', $data);
        $message   = UPDATE_RECORD_CONSTANT . " On  teacher_subject_assignments assign_id " . $data['assign_id'];
        $action    = "Update";
        $record_id = $data['assign_id'];          
        } 
        else
        {  


        $this->db->insert('teacher_subject_assignments', $data);
        $return_value = $this->db->insert_id();
        $message      = INSERT_RECORD_CONSTANT . " On  teacher_subject_assignments assign_id " . $return_value;
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
        } 
        else
        {
        return $record_id;
        }
        }





        public function getassignedteacher_subjects($id = null) 
        {

        $this->db->select('staff.*,batch_semester.*,semester_subject_groups.name as sub_group,semestersubjectpaper.sem_paper_paper as sem_paper_paper,programee.p_name,programee.id,batch_groups.batch_group_id,batch_groups.batch_group_name,batch_groups.batch_group_year, teacher_subject_assignments.* ,semestertype.*,batch_groups.*,programee.*,semester_subject_groups.name as subjects,subjects.id as subject_id,subjects.name as subject_name,semester_term.stm_id,semester_term.stm_name')
        ->from('teacher_subject_assignments'); 


        $this->db->join('staff','staff.id=teacher_subject_assignments.assign_teacher');

        $this->db->join('batch_semester','batch_semester.bchsem_id=teacher_subject_assignments.assign_batch','left');


        $this->db->join('semester_subject_groups','semester_subject_groups.id=teacher_subject_assignments.assign_subject_group' ,'left'); 

        // $this->db->join('semester_subject_groups','semester_subject_groups.id=teacher_subject_assignments.assign_subject_group','left');  


        // $this->db->join('semester_group','semester_group.sem_group_id =teacher_subject_assignments.assign_semester_group','left');

        $this->db->join('semester_term','semester_term.stm_id = batch_semester.semterm_id' ,'left'); 

        $this->db->join('semestertype','semestertype.st_id =batch_semester.semtyp_id','left');

        $this->db->join('programee','programee.id=batch_semester.bch_prog','left');
        // $this->db->join('batch_groups','batch_groups.batch_group_id=semester_group.sem_group_batchgroup','left');

        $this->db->join('batchtype','batchtype.b_id=batch_semester.	bchtyp_id','left');
        $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_bid','left');
        //  $this->db->join('batch_mode','batch_mode.b_mode_id=batchtype.b_mode');
        $this->db->join('subjects','subjects.id=teacher_subject_assignments.assign_subject ','left');
        $this->db->join('semestersubjectpaper','semestersubjectpaper.sem_paper_subjectid =teacher_subject_assignments.assign_subject','left');

        //  $this->db->join('semester_subject_groups','semester_subject_groups.id=teacher_subject_assignments.assign_subject_group','left');
        //  $this->db->join('semestersubjectpaper','semestersubjectpaper.sem_paper_subjectid =subjects.id','left');  


        if ($id != null) 
        {
        $this->db->where('teacher_subject_assignments.assign_id', $id );
        } 
        else
        {
        $this->db->order_by('teacher_subject_assignments.assign_id');
        $this->db->group_by('teacher_subject_assignments.assign_id');
        }
        $query = $this->db->get();



        if ($id  != null) {
        return $query->row_array();
        } 
        else
        {
        return $query->result_array();
        }
        }





        public function remove($id) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('assign_id', $id);
        $this->db->delete('teacher_subject_assignments');
        $message = DELETE_RECORD_CONSTANT . " On teacher_subject_assignments 	assign_id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
        return false;
        } else {
        return true;
        }
        }




        //.........................Assign Subject Teacher



        //Teacher Substitute (timtable)


        public function add_substitute($data)
        {               

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['substitute_id']))
        {
        $this->db->where('substitute_id', $data['substitute_id']);
        $this->db->update('semester_substitute', $data);
        $message   = UPDATE_RECORD_CONSTANT . " On  semester_substitute id " . $data['substitute_id'];
        $action    = "Update";
        $record_id = $data['assign_id'];
        } 
        else
        {                
        $this->db->insert('semester_substitute', $data);
        $return_value = $this->db->insert_id();
        $message      = INSERT_RECORD_CONSTANT . " On  semester_substitute id " . $return_value;
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
        } 
        else
        {
        return $record_id;
        }
        }  


        public function remove_substitute($id)
        {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('substitute_id', $id);
        $this->db->delete('semester_substitute');
        $message = DELETE_RECORD_CONSTANT . " On semester_substitute 	substitute_id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
        return false;
        } else {
        return true;
        }
        }



        public function get_sem_group($programe,$batch_group,$semester_semtype,$semester_semterm)
        {
        $this->db->select('*');
        $this->db->from('semester_group');            
        $this->db->where('sem_group_program', $programe);
        $this->db->where('sem_group_batchgroup', $batch_group);
        $this->db->where('sem_group_semester', $semester_semtype);
        $this->db->where('sem_group_semester_term', $semester_semterm);
        $query = $this->db->get();
        return $query->row_array();
        }


        /////////////////////////////////// Semester  - Class Teacher 


        public function add_sem_classteacher($data)
        {                
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['semcl_id']))
        {
        $this->db->where('semcl_id', $data['semcl_id']);
        $this->db->update('semester_classteacher', $data);
        $message   = UPDATE_RECORD_CONSTANT . " On  semester_classteacher id " . $data['semcl_id'];
        $action    = "Update";
        $record_id = $data['semcl_id'];
        } 
        else
        {                
        $this->db->insert('semester_classteacher', $data);
        $return_value = $this->db->insert_id();
        $message      = INSERT_RECORD_CONSTANT . " On  semester_classteacher id " . $return_value;
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
        } 
        else
        {
        return $record_id;
        }
        }




        //// Get Class Teacher

        public function get_sem_classteacher($id = null)
        {
        $this->db->select('staff.*,semester_classteacher.*,batch_semester.*,batch_groups.*,programee.*,semester_classteacher.semcl_id as semcl_id,programee.p_type as p_type,programee.id as pgm_id,
        GROUP_CONCAT(staff.name SEPARATOR "<br>") as teacher_names,GROUP_CONCAT(staff.id SEPARATOR "<br>") as teacher_ids')
        ->from('semester_classteacher'); 

        $this->db->join('semester_classteacher_details','semester_classteacher_details.semcl_sem_id=semester_classteacher.semcl_id','left');            
        $this->db->join('staff','staff.id=semester_classteacher_details.semcl_det_teacher','left');
        $this->db->join('batch_semester','batch_semester.bchsem_id=semester_classteacher.semcl_sem_group','left');
        // $this->db->join('semester_group','semester_group.sem_group_batchgroup =semester_classteacher.semcl_sem_group','left');   

        $this->db->join('programee','programee.id=batch_semester.bch_prog','left'); 

        $this->db->join('batchtype','batchtype.b_id= batch_semester.bchtyp_id','left');
        $this->db->join('batch_groups','batch_groups.batch_group_id=batchtype.b_name','left');  

        // $this->db->join('semestertype','semestertype.st_id =batch_semester.sem_group_semester','left'); 


        if ($id != null) 
        {
        $this->db->where('semester_classteacher.semcl_id', $id);
        } 
        else
        {
        $this->db->group_by('semester_classteacher_details.semcl_sem_id');
        $this->db->order_by('semester_classteacher.semcl_id');
        }
        $query = $this->db->get();
        if ($id  != null) {
        return $query->row_array();
        } else {
        return $query->result_array();
        } 
        }

        //// Get assigned Class Teacher

        public function get_assigned_teachers($sem_group_id)
        {
        $this->db->select('*');
        $this->db->from('semester_classteacher');
        $this->db->join('semester_classteacher_details', 'semester_classteacher_details.semcl_sem_id = semester_classteacher.semcl_id', 'inner');                
        $this->db->where('semester_classteacher.semcl_sem_group', $sem_group_id);
        $query = $this->db->get();
        return $query->result_array();
        }








        public function remove_clsteach($id)
        {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================


        $this->db->where('semcl_sem_id', $id);
        $this->db->delete('semester_classteacher_details');
        $this->db->where('semcl_id', $id);
        $this->db->delete('semester_classteacher');  
        $message   = DELETE_RECORD_CONSTANT . " On semester_classteacher 	semcl_id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
        return false;
        } else {
        return true;
        }
        }




        public function get_checked_teachers($sem_group_id)
        {
        $this->db->select('*');
        $this->db->from('semester_classteacher'); 
        $this->db->join('semester_classteacher_details','semester_classteacher_details.semcl_sem_id=semester_classteacher.semcl_id'); 
        $this->db->where('semcl_sem_group', $sem_group_id);
        $query = $this->db->get();
        return $query->result_array();
        }


        public function get_timetablelist()
        {
        $this->db->select('*,semester_substitute.*,semester_substitute.substitute_status,semester_subject_groups.name as semester_subject_groups,staff.name as staff_name,subjects.name as subject_name,semestersubjectpaper.sem_paper_paper as paper_name');
        $this->db->from('semester_substitute'); 
        $this->db->join('batch_semester','batch_semester.bchsem_id =semester_substitute.substitute_semester_group');

        $this->db->join('staff','staff.id=semester_substitute.substitute_substitutestaff','left');

        $this->db->join('batchtype','batchtype.b_id=batch_semester.bchtyp_id','left');
        $this->db->join('batch_groups','batch_groups.batch_group_id =batchtype.b_name','left');
        // $this->db->join('semester_group','semester_group.sem_group_id=semester_substitute.substitute_semester_group');
        $this->db->join('programee','programee.id=batch_semester.bch_prog'); 

        $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
        $this->db->join('semestertype','semestertype.st_id=batch_semester.semtyp_id'); 

        $this->db->join('semester_subject_groups','semester_subject_groups.id=semester_substitute.substitute_subjectgroup','left');

        $this->db->join('subjects','subjects.id=semester_substitute.substitute_substitute_subject','left');

        $this->db->join('semestersubjectpaper','semestersubjectpaper.sem_paper_id =semester_substitute.substitute_substitute_paper','left');

        $query = $this->db->get();
        // if($id!="")
        // {
        // $this->db->where('semester_substitute.substitute_id', $id);
        // return $query->row_array();   
        // }
        // else
        // {          
        return $query->result_array();
        // }
        }





        public function get_edittimetablelist($id = null)
        {
        $this->db->select('*,semester_substitute.*,semester_subject_groups.name as semester_subject_groups,staff.name as staff_name,subjects.name as subject_name,semestersubjectpaper.sem_paper_paper as paper_name');
        $this->db->from('semester_substitute'); 
        $this->db->join('batch_semester','batch_semester.bchsem_id =semester_substitute.substitute_semester_group');

        $this->db->join('staff','staff.id=semester_substitute.substitute_substitutestaff','left');

        $this->db->join('batchtype','batchtype.b_id=batch_semester.bchtyp_id','left');
        $this->db->join('batch_groups','batch_groups.batch_group_id =batchtype.b_name','left');
        // $this->db->join('semester_group','semester_group.sem_group_id=semester_substitute.substitute_semester_group');
        $this->db->join('programee','programee.id=batch_semester.bch_prog'); 

        $this->db->join('programme_type','programme_type.prog_type_id=programee.p_type'); 
        $this->db->join('semestertype','semestertype.st_id=batch_semester.semtyp_id'); 

        $this->db->join('semester_subject_groups','semester_subject_groups.id=semester_substitute.substitute_subjectgroup','left');

        $this->db->join('subjects','subjects.id=semester_substitute.substitute_substitute_subject','left');

        $this->db->join('semestersubjectpaper','semestersubjectpaper.sem_paper_id =semester_substitute.substitute_substitute_paper','left');



        $query = $this->db->get();

        $this->db->where('semester_substitute.substitute_id', $id);
        return $query->row_array();   

        }





        ////////Attendance List

        public function get_students($sem_group_id)
        {
        $this->db->select('*');
        $this->db->from('semester_studentdetails'); 
        $this->db->join('semester_students', 'semester_students.id= semester_studentdetails.stud_student_id');           
        $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid','left');
        $this->db->where('semester_group.sem_group_id', $sem_group_id);
        $query = $this->db->get();
        return $query->result_array();
        }






        public function get_students_with_attendance($sem_group_id, $attenddate)
        {

          
        // $this->db->select('
        // semester_students.id AS stud_student_id,
        // semester_students.roll_no,
        // semester_students.firstname,
        // semester_attendance.attend_id,
        // semester_attendance.attend_type_id AS attend_status,
        // semester_attendance.attend_notes');

        // $this->db->from('semester_studentdetails');
        // $this->db->join('semester_students', 'semester_students.id = semester_studentdetails.stud_student_id');
        // $this->db->join('semester_group', 'semester_group.sem_group_id = semester_studentdetails.stud_semgroupid', 'left');

        // //  LEFT JOIN to include students even if attendance not marked yet
        // $this->db->join(
        // 'semester_attendance',
        // 'semester_attendance.attend_student_id = semester_students.id 
        // AND semester_attendance.attend_group_id = semester_group.sem_group_id 
        // AND semester_attendance.attend_date = "' . $attenddate . '"',
        // 'left'
        // );

        // $this->db->where('semester_group.sem_group_id', $sem_group_id);

        // $query = $this->db->get();
        // return $query->result_array();



        // $this->db->select('*,semester_students.id AS stud_student_id,
        // semester_students.roll_no,
        // semester_students.firstname,
        // semester_attendance.attend_id,
        // semester_attendance.attend_type_id AS attend_status,
        // semester_attendance.attend_notes');

        // $this->db->from('semester_students'); 
        // // $this->db->join('semester_student_session', 'semester_student_session.id = semester_attendance.attend_student_id');  
        // $this->db->join('semester_student_session', 'semester_student_session.student_id=semester_students.id');   
        
        
        //  //  LEFT JOIN to include students even if attendance not marked yet


        // $this->db->join(
        // 'semester_attendance',
        // 'semester_attendance.attend_student_id = semester_student_session.id 
        
        // AND semester_attendance.attend_group_id = semester_student_session.sem_group_id 

        // AND semester_attendance.attend_date = "' . $attenddate . '"',
        // 'left'
        // );

        // $this->db->where('semester_attendance.attend_group_id', $sem_group_id);
        // $query = $this->db->get();
        // return $query->result_array();



            $this->db->select('semester_students.id AS stud_student_id,
            semester_students.roll_no,
            semester_students.firstname,
            semester_attendance.attend_id,
            semester_attendance.attend_type_id AS attend_status,
            semester_attendance.attend_notes');
            $this->db->from('semester_students');
            $this->db->join(
            'semester_student_session',
            'semester_student_session.student_id = semester_students.id'
            );

            $this->db->join(
            'semester_attendance',
            'semester_attendance.attend_student_id = semester_student_session.id
            AND semester_attendance.attend_group_id = semester_student_session.sem_group_id
            AND semester_attendance.attend_date = "' . $attenddate . '"',
            'left'
            );
            $this->db->where('semester_student_session.sem_group_id', $sem_group_id);
            $query = $this->db->get();
            return $query->result_array();

        }



        //////Period attendance........................................


        public function list_period()
        {            
        $this->db->select('*');   
        $this->db->from('periodic_table');
        $this->db->join('semester_timetable' ,'semester_timetable.tb_period_id = periodic_table.periodic_table_id' ,'left');
        $this->db->join('staff' ,'staff.id = semester_timetable.tb_staff_id' ,'left');
        $this->db->order_by('periodic_table.periodic_table_id');
        $query    = $this->db->get();
        return $query->result_array();        
        }


        public function get_stud_sub_with_attendance($sem_group_id, $attenddate)
        {     

        $this->db->select('semester_students.id AS stud_student_id,
        semester_students.roll_no,
        semester_students.firstname,
        semester_period_attendance.attend_id,
        semester_period_attendance.attend_type_id AS attend_status,
        semester_period_attendance.attend_notes');
        $this->db->from('semester_students');
        $this->db->join(
        'semester_student_session',
        'semester_student_session.student_id = semester_students.id'
        );
        $this->db->join(
        'semester_period_attendance',
        'semester_period_attendance.attend_student_id = semester_student_session.id
        AND semester_period_attendance.attend_group_id = semester_student_session.sem_group_id
        AND semester_period_attendance.attend_date = "' . $attenddate . '"',
        'left'
        );
        $this->db->where('semester_student_session.sem_group_id', $sem_group_id);
        $query = $this->db->get();
        return $query->result_array();
        }



        public function add_attendance($data)
        {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['attend_id']))
        {
        $this->db->where('attend_id', $data['attend_id']);
        $this->db->update('semester_attendance', $data);
        $message   = UPDATE_RECORD_CONSTANT . " On  semester_attendance attend_id " . $data['attend_id'];
        $action    = "Update";
        $record_id = $data['attend_id'];
        } 
        else
        {                
        $this->db->insert('semester_attendance', $data);
        $return_value = $this->db->insert_id();
        $message      = INSERT_RECORD_CONSTANT . " On  semester_attendance  attend_id " . $return_value;
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
        } 
        else
        {
        return $record_id;
        }

        }


        // public function get_subject_groups_by_sem_group($sem_group_id)
        // {
        // return $this->db
        // ->select('ssg.id, ssg.group_name')
        // ->from('semester_assign_subjects sas')
        // ->join(
        // 'semester_subject_groups ssg',
        // 'ssg.id = sas.sem_assign_subjects_id'
        // )
        // ->where('sas.sem_assign_group_id', $sem_group_id)
        // ->where('sas.sem_assign_status', 1)
        // ->get()
        // ->result();
        // }




        public function get_subject_groups_by_sem_group($sem_group_id)
        {
        $this->db->select('*,semester_subject_groups.id as iid,semester_subject_groups.name as iname');   
        $this->db->from('semester_assign_subjects');
        $this->db->join('semester_subject_groups' ,'semester_subject_groups.id = semester_assign_subjects.sem_assign_subjects_id');
        $this->db->where('sem_assign_group_id', $sem_group_id);
        $this->db->where('sem_assign_status', 1);
        $query = $this->db->get();
        return $query->result();
        }



        // public function get_subject_paper($prog_id, $sem_group_id, $subject_group)
        // {
        // $this->db->select('
        // semestersubjectpaper.sem_paper_id,
        // semestersubjectpaper.sem_paper_paper,
        // subjects.name AS subject_name
        // ');
        // $this->db->from('semester_assign_subjects');

        // $this->db->join('semester_subject_groups', 'semester_subject_groups.id = semester_assign_subjects.sem_assign_subjects_id');
        // $this->db->join('semester_subject_group_subjects', 'semester_subject_group_subjects.subject_group_id = semester_subject_groups.id');

        // $this->db->join('subjects', 'subjects.id = semester_subject_group_subjects.subject_id');



        // $this->db->join(
        // 'semestersubjectpaper',
        // 'semestersubjectpaper.sem_paper_subjectid = subjects.id'
        // );

        // $this->db->where('semester_assign_subjects.sem_assign_group_id', $sem_group_id);
        // $this->db->where('semester_assign_subjects.sem_assign_subjects_id ', $subject_group);
        // $this->db->where('semester_assign_subjects.sem_assign_status', 1);
        // $this->db->where('semestersubjectpaper.sem_paper_status', 1);

        // return $this->db->get()->result_array();
        // }  



        public function get_subject_paper($prog_id, $sem_group_id, $subject_group)
        {
        $this->db->select('
        semestersubjectpaper.sem_paper_id,
        semestersubjectpaper.sem_paper_paper,
        semestersubjectpaper.sem_paper_subjectid,
        subjects.id as subject_id,
        subjects.name AS subject_name
        ');
        $this->db->from('semester_assign_subjects');

        $this->db->join('semester_subject_groups', 'semester_subject_groups.id = semester_assign_subjects.sem_assign_subjects_id');
        $this->db->join('semester_subject_group_subjects', 'semester_subject_group_subjects.subject_group_id = semester_subject_groups.id');

        $this->db->join('subjects', 'subjects.id = semester_subject_group_subjects.subject_id');

        $this->db->join(
        'semestersubjectpaper',
        'semestersubjectpaper.sem_paper_subjectid = subjects.id'
        );

        $this->db->where('semester_assign_subjects.sem_assign_group_id', $sem_group_id);
        $this->db->where('semester_assign_subjects.sem_assign_subjects_id', $subject_group);
        $this->db->where('semester_assign_subjects.sem_assign_status', 1);
        $this->db->where('semestersubjectpaper.sem_paper_status', 1);

        return $this->db->get()->result_array();
        }



        public function get_timetable($sem_group_id, $subject_group)
        {
        $this->db->where('tb_batch', $sem_group_id);
        $this->db->where('tb_subjectgroup', $subject_group);
        $this->db->where('tb_status', 1);
        return $this->db->get('semester_timetable')->result_array();
        }

        // Add this method to get subjects list for dropdown
        public function list_subjects($group_id)
        {
        $this->db->select('subjects.id, subjects.name');
        $this->db->from('semester_subject_group_subjects');
        $this->db->join('subjects', 'subjects.id = semester_subject_group_subjects.subject_id');
        $this->db->where('semester_subject_group_subjects.subject_group_id', $group_id);
        $this->db->where('subjects.is_active', 'yes');
        $this->db->group_by('subjects.id');
        $query = $this->db->get();
        return $query->result_array();
        }


//Sub Timetable
          



        public function getPeriodsByBatch($batch, $day)
        {          

        $this->db->select('
        pt.periodic_table_count AS period_no,
        pt.periodic_table_timefrom AS time_from,
        pt.periodic_table_timeto AS time_to,
        s.name, st.tb_id AS tb_id,st.tb_period_id,
        pt.periodic_table_name AS periodic_table_name,
        ');
        $this->db->from('semester_timetable st');
        $this->db->join('periodic_table pt', 'pt.periodic_table_id = st.tb_period_id');
        $this->db->join('staff s', 's.id = st.tb_staff_id');
        $this->db->where('st.tb_batch', $batch);
        $this->db->where('st.tb_day', $day);
        // $this->db->where('st.tb_period_id', $period);       
        $this->db->where('st.tb_status', 1);
        $this->db->order_by('pt.periodic_table_count', 'ASC');
        return $this->db->get()->result_array();
        }


        }


