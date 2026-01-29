            <?php

            if (!defined('BASEPATH'))
            exit('No direct script access allowed');

            class Valuation_model extends MY_Model {

            public function __construct() 
            {
            parent::__construct();
            $this->current_session = $this->setting_model->getCurrentSession();
            }


            public function getdata_previous($sch_current_session,$role,$id)
            {
            if($role=="Teacher")
            {
            $this->db->select('*, valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname, subjects.id as subjectid,staff.id as staffid, valuation_assignsubjects.valuation_note as valuation_note');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');
            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->join('sessions', 'sessions.id = valuation_assignsubjects.valuation_session');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $this->db->where('valuation_assignsubjects.valuation_session < ', $sch_current_session);
            $this->db->where('valuation_assignsubjects.valuation_staff', $id);
            $query = $this->db->get();
            return $query->result_array();
            }
            else
            {
            $this->db->select('*, valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname, subjects.id as subjectid,staff.id as staffid, valuation_assignsubjects.valuation_note as valuation_note');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');
            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->join('sessions', 'sessions.id = valuation_assignsubjects.valuation_session');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $this->db->where('valuation_assignsubjects.valuation_session < ', $sch_current_session);
            $query = $this->db->get();
            return $query->result_array();
            }
            }




            public function getdata($sch_current_session,$role,$id)
            {
            if($role=="Teacher")
            {
            $this->db->select('*,valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname, subjects.id as subjectid,staff.id as staffid, valuation_assignsubjects.valuation_note as valuation_note');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');
            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $this->db->where('valuation_assignsubjects.valuation_session = ', $sch_current_session);
            $this->db->where('valuation_assignsubjects.valuation_staff', $id);
            $query = $this->db->get();
            return $query->result_array();
            }
            else
            {
            $this->db->select('*,valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname, subjects.id as subjectid,staff.id as staffid, valuation_assignsubjects.valuation_note as valuation_note');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');

            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $this->db->where('valuation_assignsubjects.valuation_session = ', $sch_current_session);
            $query = $this->db->get();
            return $query->result_array();
            }
            }

            public function get($id = null) 
            {
            $this->db->select('*,exam_groups.id as examgroupid,exam_group_class_batch_exams.id as batchexamid, valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname,valuation_assignsubjects.valuation_note as valuation_note,subjects.id as subjectid,staff.id as staffid');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');
            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->join('subjectpaper', 'subjectpaper.subjectpaper_subjectid = subjects.id','left');
            $this->db->join('exam_groups', 'exam_groups.id = valuation_assignsubjects.valuation_examgroup');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid');
            $this->db->join('valuation_center', 'valuation_center.valuation_centerid = valuation_assignsubjects.valuation_center_title');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $this->db->where('valuation_assignsubjects.valuation_id = ', $id);
            $query = $this->db->get();
            return $query->row_array();
            }


            public function getdata_examgroup($role,$id)
            {
            if($role=="Teacher")
            {

            $this->db->select('*,valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname, subjects.id as subjectid,staff.id as staffid, valuation_assignsubjects.valuation_note as valuation_note');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');
            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->join('exam_groups', 'exam_groups.id = valuation_assignsubjects.valuation_examgroup');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid');
            $this->db->join('sessions', 'sessions.id = valuation_assignsubjects.valuation_session');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $this->db->where('valuation_assignsubjects.valuation_staff = ', $id);
            $query = $this->db->get();
            return $query->result_array();
            }
            else
            {
            $this->db->select('*,valuation_assignsubjects.valuation_id as valuation_id,staff.name as staffname,subjects.code as subjectcode,subjects.name as subjectname, subjects.id as subjectid,staff.id as staffid, valuation_assignsubjects.valuation_note as valuation_note');
            $this->db->from('valuation_assignsubjects');
            $this->db->join('staff','staff.id = valuation_assignsubjects.valuation_staff');
            $this->db->join('subjects', 'subjects.id = valuation_assignsubjects.valuation_subject');
            $this->db->join('exam_groups', 'exam_groups.id = valuation_assignsubjects.valuation_examgroup');
            $this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid');
            $this->db->join('sessions', 'sessions.id = valuation_assignsubjects.valuation_session');
            $this->db->where('valuation_assignsubjects.valuation_status = ', 1);
            $query = $this->db->get();
            return $query->result_array();
            }
            }


            public function examgroup_list()
            {
            $this->db->select('*');
            $this->db->from('exam_groups');
            $query = $this->db->get();
            return $query->result_array();   
            }

            public function remove($id)
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            $this->db->where('valuation_id', $id);
            $this->db->delete('valuation_assignsubjects');
            $message = DELETE_RECORD_CONSTANT . " On valuation_assignsubjects valuation_id " . $id;
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



            public function add($data) 
            {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
            //=======================Code Start===========================
            if (isset($data['valuation_id'])) 
            {
            $this->db->where('valuation_id ', $data['valuation_id']);
            $this->db->update('valuation_assignsubjects', $data);
            $message = UPDATE_RECORD_CONSTANT . " On  valuation_assignsubjects valuation_id " . $data['valuation_id'];
            $action = "Update";
            $record_id = $data['valuation_id'];
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
            else
            {

            $this->db->insert('valuation_assignsubjects', $data);
            $insert_id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On valuation_assignsubjects valuation_id" . $insert_id;
            $action = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) 
            {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
            } 
            else 
            {
            //return $return_value;
            }
            return $insert_id;
            }
            }

            public function Stafflist()
            {
            $this->db->select('*,staff.id as id,staff_roles.id as staff_role');
            $this->db->from('staff');
            $this->db->join('staff_roles', "staff_roles.staff_id = staff.id");
            $this->db->where('staff.is_active = ', 1);
            $this->db->where('staff_roles.role_id = ', 2);
            $query = $this->db->get();
            return $query->result_array();
            }

            public function subjectlist()
            {
            $this->db->select('*');
            $this->db->from('subjects');
            $query = $this->db->get();
            return $query->result_array();
            }



            public function getsubjectsid($id)
            {
            $this->db->select('sessions.session as sessionname,exam_groups.name as name,exam_group_class_batch_exams.exam as exam,staff.name as staffname,staff.permanent_address as permanent_address,staff.employee_id as employee_id,staff.employee_id as employee_id,valuation_assignsubjects.valuation_amount as valuation_amount,valuation_assignsubjects.valuation_date as valuation_date,valuation_assignsubjects.valuation_time as valuation_time,valuation_assignsubjects.valuation_bunblecode as valuation_bunblecode,valuation_assignsubjects.valuation_countofpaper as valuation_countofpaper,valuation_assignsubjects.valuation_submissiondate as valuation_submissiondate,valuation_assignsubjects.valuation_id as valuation_id,subjects.name as subjectname,subjects.code as subjectcode,valuation_assignsubjects.valuation_qrcode as valuation_qrcode,valuation_assignsubjects.valuation_amount as valuation_amount,valuation_assignsubjects.valuation_barcode as valuation_barcode,subjectpaper.subjectpaper_papername');	
            $this->db->from('valuation_assignsubjects');
            $this->db->join('exam_groups', "exam_groups.id = valuation_assignsubjects.valuation_examgroup");
            $this->db->join('exam_group_class_batch_exams', "exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid");
            $this->db->join('staff', "staff.id = valuation_assignsubjects.valuation_staff");
            $this->db->join('sessions', "sessions.id = valuation_assignsubjects.valuation_session");
            $this->db->join('subjects', "subjects.id = valuation_assignsubjects.valuation_subject");
            $this->db->join('subjectpaper', 'subjectpaper.subjectpaper_subjectid = subjects.id','left');
            $this->db->where(array('valuation_assignsubjects.valuation_id'=> $id));
            $query = $this->db->get();
            return $query->row_array();
            }


            public function getvaluatuonid($id)
            {
            $this->db->select('sessions.session as sessionname,exam_groups.name as name,exam_group_class_batch_exams.exam as exam,staff.permanent_address as staffpermanentaddress,staff.id as staffid,staff.name as staffname,staff.permanent_address as permanent_address,staff.employee_id as employee_id,staff.employee_id as employee_id,valuation_assignsubjects.valuation_amount as valuation_amount, valuation_assignsubjects.valuation_date as valuation_date,valuation_assignsubjects.valuation_time as valuation_time,valuation_assignsubjects.valuation_bunblecode as valuation_bunblecode,valuation_assignsubjects.valuation_countofpaper as valuation_countofpaper,valuation_assignsubjects.valuation_amount as valuation_amount,valuation_assignsubjects.valuation_submissiondate as valuation_submissiondate,valuation_assignsubjects.valuation_id as valuation_id,subjects.name as subjectname,subjects.code as subjectcode,valuation_assignsubjects.valuation_qrcode as valuation_qrcode,valuation_assignsubjects.valuation_amount as valuation_amount,valuation_assignsubjects.valuation_barcode as valuation_barcode');	
            $this->db->from('valuation_assignsubjects');
            $this->db->join('exam_groups', "exam_groups.id = valuation_assignsubjects.valuation_examgroup");
            $this->db->join('exam_group_class_batch_exams', "exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid");
            $this->db->join('staff', "staff.id = valuation_assignsubjects.valuation_staff");
            $this->db->join('sessions', "sessions.id = valuation_assignsubjects.valuation_session");
            $this->db->join('subjects', "subjects.id = valuation_assignsubjects.valuation_subject");
            $this->db->where(array('valuation_assignsubjects.valuation_id'=> $id));
            $query = $this->db->get();
            return $query->row_array();
            }



            public function getvaluationamount($examid,$subject,$valuation_title)
            {
            $this->db->select('*');	
            $this->db->from('valuation_subject_list');
            $this->db->where(array('valuation_subject_list_exam'=> $examid,'valuation_subject_list_subjectid'=> $subject,'valuation_subject_list_title'=>$valuation_title));
            $query = $this->db->get();
            return $query->row_array();
            }


            public function getvaluationcenter()
            {
            $this->db->select('*');	
            $this->db->from('valuation_center');
            $this->db->join('sessions', "sessions.id = valuation_center.valuation_centersession");
            $this->db->where(array('valuation_center.valuation_centerstatus'=> 1));
            $query = $this->db->get();
            return $query->result_array();
            }


            public function valuationcenter_byid($id)
            {
            $this->db->select('*');	
            $this->db->from('valuation_center');
            $this->db->join('sessions', "sessions.id = valuation_center.valuation_centersession");
            $this->db->where(array('valuation_center.valuation_centerid'=> $id));
            $query = $this->db->get();
            return $query->row_array();
            }


            public function getvaluationcenter_groupexam($id)
            {
            $this->db->select('*,exam_group_class_batch_exams.exam as exam,exam_groups.name as name,exam_group_class_batch_exams.id as batchexamid,exam_groups.id as examgroupid');	
            $this->db->from('valuation_center');
            $this->db->join('exam_group_class_batch_exams', "exam_group_class_batch_exams.id = valuation_center.valuation_centerexamid");
            $this->db->join('exam_groups', "exam_groups.id = valuation_center.valuation_centerexam_group_id");
            $this->db->join('sessions', "sessions.id = valuation_center.valuation_centersession");
            $this->db->where(array('valuation_center.valuation_centerid'=> $id));
            $query = $this->db->get();
            return $query->row_array();  
            }


            public function get_valauationstaff_details($staffid,$centerid)
            {
            foreach ($staffid as $staff_key =>$staff_value )
            {
            $staff            = $this->valuation_model->getStaff_center($staff_value,$centerid);
            $staffid          = $staff['staffid'];
            $assignedsubjects = $this->valuation_model->getassignedsubjects($staffid,$centerid);
            $printval         = $this->valuation_model->getprintval($staffid,$centerid);
            $result['print'][]= $printval;
            $result['staff'][]  = $staff;
            $result['assignedsubjects'][]=  $assignedsubjects;
            }
            return $result;
            }




            public function getStaff_center($staffid,$centerid)
            {
            $this->db->select('*,valuation_center.valuation_centername as valuation_centername,valuation_center.valuation_centerlocation as valuation_centerlocation,valuation_center.valuation_centerfromdate as valuation_centerfromdate,valuation_center.valuation_centertodate as valuation_centertodate,staff.id as staffid,staff.name as staffname,staff.surname as surname,   staff.contact_no as staffcontact_no,exam_groups.name as groupname,exam_group_class_batch_exams.exam as exam ');
            $this->db->from('valuation_center');
            $this->db->join('sessions', "sessions.id = valuation_center.valuation_centersession");
            $this->db->join('valuation_assignsubjects', "valuation_assignsubjects.valuation_center_title = valuation_center.valuation_centerid");
            $this->db->join('exam_group_class_batch_exams', "exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid");
            $this->db->join('exam_groups', "exam_groups.id = valuation_assignsubjects.valuation_examgroup");
            $this->db->join('staff', "staff.id = valuation_assignsubjects.valuation_staff");
            $this->db->where(array('valuation_center.valuation_centerid'=> $centerid));
            $this->db->where(array('valuation_assignsubjects.valuation_staff'=> $staffid));
            $query = $this->db->get();
            return $query->row_array();  
            } 




            public function getassignedsubjects($staffid,$title_value)
            {
            $this->db->select('subjects.name as subjectname,sessions.session as sessionname,exam_groups.name as name,exam_group_class_batch_exams.exam as exam,staff.permanent_address as staffpermanentaddress,staff.id as staffid,staff.name as staffname,staff.permanent_address as permanent_address,staff.employee_id as employee_id,staff.employee_id as employee_id,valuation_assignsubjects.valuation_amount as valuation_amount, valuation_assignsubjects.valuation_date as valuation_date,valuation_assignsubjects.valuation_time as valuation_time,valuation_assignsubjects.valuation_bunblecode as valuation_bunblecode,valuation_assignsubjects.valuation_countofpaper as valuation_countofpaper,valuation_assignsubjects.valuation_amount as valuation_amount,valuation_assignsubjects.valuation_submissiondate as valuation_submissiondate,valuation_assignsubjects.valuation_id as valuation_id,subjects.name as subjectname,subjects.code as subjectcode,valuation_assignsubjects.valuation_qrcode as valuation_qrcode,valuation_assignsubjects.valuation_amount as valuation_amount,valuation_assignsubjects.valuation_barcode as valuation_barcode');	
            $this->db->from('valuation_assignsubjects');
            $this->db->join('exam_groups', "exam_groups.id = valuation_assignsubjects.valuation_examgroup");
            $this->db->join('exam_group_class_batch_exams', "exam_group_class_batch_exams.id = valuation_assignsubjects.valuation_examid");
            $this->db->join('staff', "staff.id = valuation_assignsubjects.valuation_staff");
            $this->db->join('sessions', "sessions.id = valuation_assignsubjects.valuation_session");
            $this->db->join('subjects', "subjects.id = valuation_assignsubjects.valuation_subject");
            $this->db->where(array('valuation_assignsubjects.valuation_center_title'=> $title_value));
            $this->db->where(array('staff.id'=> $staffid));
            $query = $this->db->get();
            return $query->result_array();  

            }



            public function getprintval($staffid,$title_value)
            {
            $this->db->select('*');	
            $this->db->from('valuation_print_details');
            $this->db->where(array('print_center_id'=> $title_value));
            $this->db->where(array('print_staff_id'=> $staffid));
            $query = $this->db->get();
            return $query->row_array();
            }

            public function getsubject_paper($subjectid)
            {
            $this->db->select('*');	
            $this->db->from('subjectpaper');
            $this->db->where(array('subjectpaper_subjectid'=> $subjectid,'subjectpaper_session'=>$this->current_session));
            $query = $this->db->get();
            return $query->row_array();
            }
            }
