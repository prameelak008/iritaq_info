            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class User extends MY_Controller
            {


            public function __construct()
            {
            parent::__construct();
            // $this->current_session = $this->setting_model->getCurrentSession();
            $this->sch_setting_detail = $this->setting_model->getSetting();  
            }

            

            public function index()
            { 
            if (!$this->session->has_userdata('sem_student')) 
            {
            redirect('semester_auth/login'); 
            exit;
            }


            // $this->session->set_userdata('top_menu', 'Examinations');
            // $this->session->set_userdata('sub_menu', 'examSchedule/index');

            $data['title']        = 'Exam Schedule'; 
         
            // $student_id            = $this->customlib->getStudentSessionUserID();
            // $student_current_class = $this->customlib->getStudentCurrentClsSection();		

            // $parent_id             = $this->customlib->getUsersID();
            // $data['student_lists'] = $this->student_model->getParentChilds($parent_id);


            // $student = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);



            $data['page']     = 'user/index';
            $data['nav_text'] = 'Profile';
            $data['nav_link'] = 'user/index'; 

            $this->session->set_userdata('top_menu', 'Dashboard');
            $this->session->set_userdata('sub_menu', 'user/index');
            $sem              = $this->session->userdata('sem_student');  
            $sem_group_id     = $sem['sem_group_id'];
            $student_id       = (int)$sem['user_id'];             
            $student          = $this->Semester_user_model->get_students($student_id);
            $data['student']  = $student;           

            $data             = array();
            // if (!empty($student))
            // {
            // $student_session_id           = $student_current_class->student_session_id;
            // $gradeList                    = $this->grade_model->get();
            // $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_session_id);
            // $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
            // $data['student_discount_fee'] = $student_discount_fee;
            // $data['student_due_fee']      = $student_due_fee;
            // $timeline                     = $this->timeline_model->getStudentTimeline($student["id"], $status = 'yes');
            // $data["timeline_list"]        = $timeline;
            $data['sch_setting']          = $this->sch_setting_detail;
            // $data['adm_auto_insert']      = $this->sch_setting_detail->adm_auto_insert;
            // $data['examSchedule']         = array();
            // $data['exam_result']          = $this->examgroupstudent_model->searchStudentExams($student['student_session_id'], true, true);
            // $ss                           = $this->grade_model->getGradeDetails();
            // $data['exam_grade']           = $this->grade_model->getGradeDetails();
            // $student_doc                  = $this->student_model->getstudentdoc($student_id);
            // $data['student_doc']          = $student_doc;
            // $data['student_doc_id']       = $student_id;
            // $category_list                = $this->category_model->get();
            // $data['category_list']        = $category_list;
            // $data['gradeList']            = $gradeList;
            $data['student']              = $student;
            //  }

            // $unread_notifications         = $this->notification_model->getUnreadStudentNotification();
            // $notification_bydate          = array();


            // foreach ($unread_notifications as $unread_notifications_key => $unread_notifications_value) {
            // if (date($this->customlib->getSchoolDateFormat()) >= date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($unread_notifications_value->publish_date))) {
            // $notification_bydate[] = $unread_notifications_value;
            // }
            // }

            // $data['unread_notifications']   = $notification_bydate;
            $getUsersID 		              = $this->customlib->getUsersID();
            $data['childrens']              = $this->student_model->getMyNewChildrens($getUsersID);

            $this->load->view('layout/semester/header', $data); 
            $this->load->view('user_semester/user/profile/index',$data);
            $this->load->view('layout/semester/footer', $data);
            }




/*

            public function dashboard()
            {

            if (!$this->session->has_userdata('sem_student')) 
            {
            redirect('semester_auth/login'); 
            exit;
            }
            // $this->session->set_userdata('top_menu', 'Dashboard');
            // $student_id            = $this->customlib->getStudentSessionUserID();
            // $student_current_class = $this->customlib->getStudentCurrentClsSection();		

            // $parent_id             = $this->customlib->getUsersID();
            // $data['student_lists'] = $this->student_model->getParentChilds($parent_id);

            // $student = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);

            // $data = array();
            // if (!empty($student))
            // {

            // $student_session_id           = $student_current_class->student_session_id;
            // $gradeList                    = $this->grade_model->get();
            // $student_due_fee              = $this->studentfeemaster_model->getStudentFees($student_session_id);
            // $student_discount_fee         = $this->feediscount_model->getStudentFeesDiscount($student_session_id);
            // $data['student_discount_fee'] = $student_discount_fee;
            // $data['student_due_fee']      = $student_due_fee;
            // $timeline                     = $this->timeline_model->getStudentTimeline($student["id"], $status = 'yes');
            // $data["timeline_list"]        = $timeline;
            // $data['sch_setting']          = $this->sch_setting_detail;
            // $data['adm_auto_insert']      = $this->sch_setting_detail->adm_auto_insert;
            // $data['examSchedule']         = array();
            // $data['exam_result']          = $this->examgroupstudent_model->searchStudentExams($student['student_session_id'], true, true);
            // $ss                           = $this->grade_model->getGradeDetails();
            // $data['exam_grade']           = $this->grade_model->getGradeDetails();
            // $student_doc                  = $this->student_model->getstudentdoc($student_id);
            // $data['student_doc']          = $student_doc;
            // $data['student_doc_id']       = $student_id;
            // $category_list                = $this->category_model->get();
            // $data['category_list']        = $category_list;
            // $data['gradeList']            = $gradeList;
            // $data['student']              = $student;
            // }

            // $unread_notifications         = $this->notification_model->getUnreadStudentNotification();
            // $notification_bydate          = array();

            // foreach ($unread_notifications as $unread_notifications_key => $unread_notifications_value) {
            // if (date($this->customlib->getSchoolDateFormat()) >= date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($unread_notifications_value->publish_date))) {
            // $notification_bydate[] = $unread_notifications_value;
            // }
            // }

            // $data['unread_notifications']   = $notification_bydate;
            // $getUsersID 		            = $this->customlib->getUsersID();
            // $data['childrens']              = $this->student_model->getMyNewChildrens($getUsersID);




            $this->load->view('layout/student/header', $data);
            $this->load->view('user_semester/dashboard',$data);
            $this->load->view('layout/student/footer',$data);
            }
            */

            }
