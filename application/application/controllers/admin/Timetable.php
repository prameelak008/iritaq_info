                <?php

                if (!defined('BASEPATH')) {
                exit('No direct script access allowed');
                }

                class Timetable extends Admin_Controller
                {

                public function __construct()
                {
                parent::__construct();
                $this->load->model("staff_model");
                $this->load->model("classteacher_model");
                $this->current_session = $this->setting_model->getCurrentSession();
                }



                public function index()
                {
                if (!$this->rbac->hasPrivilege('class_time_table', 'can_view')) 
                {
                access_denied();
                }

                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable');
                $session            = $this->setting_model->getCurrentSession();
                $data['title']      = 'Exam Marks';
                $data['exam_id']    = "";
                $data['class_id']   = "";
                $data['section_id'] = "";
                $class              = $this->class_model->get();
                $data['classlist']  = $class;

                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('group_id', $this->lang->line('group'), 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableList', $data);
                $this->load->view('layout/footer', $data);
                } 
                else
                {
                $class_id           = $this->input->post('class_id');
                $section_id         = $this->input->post('section_id');
                $section_id         = $this->input->post('group_id');
                $data['class_id']   = $class_id;
                $data['section_id'] = $section_id;
                $result_subjects    = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);

                $getDaysnameList         = $this->customlib->getDaysname();
                $data['getDaysnameList'] = $getDaysnameList;
                $final_array             = array();
                if (!empty($result_subjects)) {
                foreach ($result_subjects as $subject_k => $subject_v) {
                $result_array = array();
                foreach ($getDaysnameList as $day_key => $day_value) {
                $where_array = array(
                'teacher_subject_id' => $subject_v['id'],
                'day_name'           => $day_value,
                );
                $result = $this->timetable_model->get($where_array);
                if (!empty($result)) {
                $obj                      = new stdClass();
                $obj->status              = "Yes";
                $obj->start_time          = $result[0]['start_time'];
                $obj->end_time            = $result[0]['end_time'];
                $obj->room_no             = $result[0]['room_no'];
                $result_array[$day_value] = $obj;
                } else {
                $obj                      = new stdClass();
                $obj->status              = "No";
                $obj->start_time          = "N/A";
                $obj->end_time            = "N/A";
                $obj->room_no             = "N/A";
                $result_array[$day_value] = $obj;
                }
                }
                $final_array[$subject_v['name']] = $result_array;
                }
                }
                $data['result_array'] = $final_array;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableList', $data);
                $this->load->view('layout/footer', $data);
                }
                }



                public function mytimetable()
                {
                if (!$this->rbac->hasPrivilege('teachers_time_table', 'can_view')) {
                access_denied();
                }
                $data['title'] = 'My Timetable';
                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable/mytimetable');
                $my_role  = $this->customlib->getStaffRole();
                $role     = json_decode($my_role);
                $is_admin = false;

                if ($role->id != "2") {
                $staff_list         = $this->staff_model->getEmployee('2');
                $data['staff_list'] = $staff_list;
                $is_admin           = true;
                }

                $staff_id          = $this->customlib->getStaffID();
                $data['timetable'] = array();
                $days              = $this->customlib->getDaysname();

                foreach ($days as $day_key => $day_value) {
                $data['timetable'][$day_value] = $this->subjecttimetable_model->getByStaffandDay($staff_id, $day_key);
                }

                $this->load->view('layout/header', $data);
                if ($is_admin) 
                {
                $this->load->view('admin/timetable/admintimetable', $data);
                } 
                else 
                {
                $this->load->view('admin/timetable/mytimetable', $data);
                }
                $this->load->view('layout/footer', $data);
                }

                public function view($id)
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
                access_denied();
                }
                $data['title'] = 'Mark List';
                $mark          = $this->mark_model->get($id);
                $data['mark']  = $mark;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableShow', $data);
                $this->load->view('layout/footer', $data);
                }


                public function delete($id)
                {
                $data['title'] = 'Mark List';
                $this->mark_model->remove($id);
                redirect('admin/timetable/index');
                }




                public function create()
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable');

                $session                 = $this->setting_model->getCurrentSession();
                $data['title']           = 'Exam Schedule';
                $data['subject_id']      = "";
                $data['class_id']        = "";
                $data['section_id']      = "";
                $exam                    = $this->exam_model->get();
                $class                   = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']        = $exam;
                $data['classlist']       = $class;
                $userdata                = $this->customlib->getUserData();
                $staff                   = $this->staff_model->getStaffbyrole(2);
                $period                  = $this->staff_model->getperiod();
                $data['period']          = $period;
                $data['staff']           = $staff;
                $data['subject']         = array();
                $feecategory             = $this->feecategory_model->get();
                $data['feecategorylist'] = $feecategory;

                $feecategory               = $this->feecategory_model->get();
                $data['feecategorylist']   = $feecategory; 
                $subjectpapers             = $this->Subjectpaper_model->getsubjectpapers();
                $data['subjectpapers']     = $subjectpapers; 


                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('subject_group_id', $this->lang->line('group'), 'trim|required|xss_clean');
                $class_id                 = $this->input->post('class_id');
                $section_id               = $this->input->post('section_id');
                $subject_group_id         = $this->input->post('subject_group_id');
                $data['class_id']         = $class_id;
                $data['section_id']       = $section_id;
                $data['subject_group_id'] = $subject_group_id;

                if ($this->form_validation->run() == false)
                {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate', $data);
                $this->load->view('layout/footer', $data);
                } 
                else 
                {
                $getDaysnameList         = $this->customlib->getDaysname();
                $data['getDaysnameList'] = $getDaysnameList;
                $subject                 = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $data['subject']         = $subject;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate', $data);
                $this->load->view('layout/footer', $data);
                }
                }




                public function create_substitute()
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }

                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable_substitute');

                $session            = $this->setting_model->getCurrentSession();
                $data['title']      = 'Time Table';
                $data['subject_id'] = "";
                $data['class_id']   = "";
                $data['section_id'] = "";
                $exam               = $this->exam_model->get();
                $class              = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']        = $exam;
                $data['classlist']       = $class;
                $userdata                = $this->customlib->getUserData();

                $staff                   = $this->staff_model->getStaffbyrole(2);

                $period                  = $this->staff_model->getperiod();
                $data['period']          = $period;
                $data['staff']           = $staff;
                $data['subject']         = array();
                $feecategory             = $this->feecategory_model->get();
                $data['feecategorylist'] = $feecategory;
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('subject_group_id', $this->lang->line('group'), 'trim|required|xss_clean');
                $class_id                 = $this->input->post('class_id');
                $section_id               = $this->input->post('section_id');
                $subject_group_id         = $this->input->post('subject_group_id');

                $data['subst_date']         = $this->input->post('subst_date');


                $data['class_id']         = $class_id;
                $data['section_id']       = $section_id;
                $data['subject_group_id'] = $subject_group_id;

                if ($this->form_validation->run() == false)
                {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate_substitute', $data);
                $this->load->view('layout/footer', $data);
                } 
                else 
                {

                $data['classSection'] = $this->subjecttimetable_model->getclasssection($class_id, $section_id);
                foreach ($days as $day_key => $day_value) 
                {
                $class_id              = $this->input->post('class_id');
                $section_id            = $this->input->post('section_id');
                $days_record[$day_key] = $this->subjecttimetable_model->getSubjectByClassandSectionDay_substitute($class_id, $section_id, $day_key);
                }

                $data['timetable']    = $days_record;
                $getDaysnameList         = $this->customlib->getDaysname();
                $data['getDaysnameList'] = $getDaysnameList;
                $subject                 = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $data['subject']         = $subject;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate_substitute', $data);
                $this->load->view('layout/footer', $data);
                }
                }




                public function classreport()
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }

                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable');
                $session                 = $this->setting_model->getCurrentSession();
                $data['title']           = 'Exam Schedule';
                $data['subject_id']      = "";
                $data['class_id']        = "";
                $data['section_id']      = "";
                $exam                    = $this->exam_model->get();
                $class                   = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']        = $exam;
                $data['classlist']       = $class;
                $userdata                = $this->customlib->getUserData();
                $staff                   = $this->staff_model->getStaffbyrole(2);
                $data['staff']           = $staff;
                $data['subject']         = array();
                $feecategory             = $this->feecategory_model->get();
                $data['feecategorylist'] = $feecategory;
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

                if ($this->form_validation->run() == true)
                {
                if (isset($_POST['search']))
                {

                $class_id    = $this->input->post('class_id');
                $section_id  = $this->input->post('section_id');
                $days        = $this->customlib->getDaysname();
                $days_record = array();

                $data['classSection'] = $this->subjecttimetable_model->getclasssection($class_id, $section_id);
                $data['get_subjectsetpapers'] = $this->subjecttimetable_model->get_subjectsetpapers();


                foreach ($days as $day_key => $day_value) 
                {
                $class_id              = $this->input->post('class_id');
                $section_id            = $this->input->post('section_id');
                $days_record[$day_key] = $this->subjecttimetable_model->getSubjectByClassandSectionDay($class_id, $section_id, $day_key);
                }
                $data['timetable']    = $days_record;

                }
                }

                $data['getperiod']        = $this->subjecttimetable_model->getperiod();

                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/classreport', $data);
                $this->load->view('layout/footer', $data);
                }


                public function classreport_substitute()
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }

                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/classreport_substitute');
                $session                 = $this->setting_model->getCurrentSession();
                $data['title']           = 'Exam Schedule';
                $data['subject_id']      = "";
                $data['class_id']        = "";
                $data['section_id']      = "";
                $exam                    = $this->exam_model->get();
                $class                   = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']        = $exam;
                $data['classlist']       = $class;
                $userdata                = $this->customlib->getUserData();
                $staff                   = $this->staff_model->getStaffbyrole(2);
                $data['staff']           = $staff;
                $data['subject']         = array();
                $feecategory             = $this->feecategory_model->get();
                $data['feecategorylist'] = $feecategory;
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');

                if ($this->form_validation->run() == true)
                {
                if (isset($_POST['search']))
                {
                $class_id    = $this->input->post('class_id');
                $section_id  = $this->input->post('section_id');
                $days        = $this->customlib->getDaysname();
                $days_record = array();

                //  $data['classSection'] = $this->subjecttimetable_model->getclasssection_substitute($class_id, $section_id);

                foreach ($days as $day_key => $day_value) 
                {
                $class_id              = $this->input->post('class_id');
                $section_id            = $this->input->post('section_id');
                $days_record[$day_key] = $this->subjecttimetable_model->getSubjectByClassandSectionDay_substitute($class_id, $section_id, $day_key);
                }
                $data['timetable1']     = $days_record;
                }
                }

                $data['getperiod']             = $this->subjecttimetable_model->getperiod();

                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/classreport_substitute', $data);
                $this->load->view('layout/footer', $data);
                }



                public function edit($id)
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
                access_denied();
                }
                $data['title'] = 'Edit Mark';
                $data['id']    = $id;
                $mark          = $this->mark_model->get($id);
                $data['mark']  = $mark;
                $this->form_validation->set_rules('name', $this->lang->line('mark'), 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableEdit', $data);
                $this->load->view('layout/footer', $data);
                } else {
                $data = array(
                'id'   => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
                );
                $this->mark_model->add($data);
                $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/timetable/index');
                }
                }



                public function getBydategroupclasssection()
                {
                $data                  = array();
                $data['total_count']   = 1;
                $day                   = $this->input->post('day');
                $class_id              = $this->input->post('class_id');
                $section_id            = $this->input->post('section_id');
                $subject_group_id      = $this->input->post('subject_group_id');
                $subject               = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $prev_record           = $this->subjecttimetable_model->getBySubjectGroupDayClassSection($subject_group_id, $day, $class_id, $section_id);

                $staff                 = $this->staff_model->getStaffbyrole(2);
                $period                = $this->staff_model->getperiod();
                $data['period']        = $period;
                $subjectpapers         = $this->Subjectpaper_model->getsubjectpapers();
                $data['subjectpapers'] = $subjectpapers; 


                if($day=="Sunday")
                {
                $st="1";
                }

                if($day=="Monday")
                {
                $st="2";
                }
                if($day=="Tuesday")
                {
                $st="3";
                }
                if($day=="Wednesday")
                {
                $st="4";
                }
                if($day=="Thursday")
                {
                $st="5";
                }
                if($day=="Friday")
                {
                $st="6";
                }
                if($day=="Saturday")
                {
                $st="7";
                }

                $data['staff'] = $staff;
                if (empty($prev_record)) {
                $data['prev_record']  = array();
                } 
                else
                {
                $data['total_count']  = count($prev_record);
                $data['prev_record']  = $prev_record;
                }
                $data['subject']          = $subject;
                $data['day']              = $day;
                $data['class_id']         = $class_id;
                $data['section_id']       = $section_id;
                $data['subject_group_id'] = $subject_group_id;

                $data['html'] = $this->load->view('admin/timetable/addrow', $data, true);
                echo json_encode($data);
                }


                public function getBydategroupclasssection_substitute()
                {
                $data                = array();
                $data['total_count'] = 1;
                $day                 = $this->input->post('day');
                $class_id            = $this->input->post('class_id');
                $section_id          = $this->input->post('section_id');
                $subject_group_id    = $this->input->post('subject_group_id');
                $subst_date          = $this->input->post('subst_date');
                $subject             = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $prev_record         = $this->subjecttimetable_model->getBySubjectGroupDayClassSection($subject_group_id, $day, $class_id, $section_id);
                $staff               = $this->staff_model->getStaffbyrole(2);
                $period              = $this->staff_model->getperiod();
                $data['period']      = $period;

                if($day=="Sunday")
                {
                $st="1";
                }

                if($day=="Monday")
                {
                $st="2";
                }

                if($day=="Tuesday")
                {
                $st="3";
                }

                if($day=="Wednesday")
                {
                $st="4";
                }

                if($day=="Thursday")
                {
                $st="5";
                }
                if($day=="Friday")
                {
                $st="6";
                }
                if($day=="Saturday")
                {
                $st="7";
                }

                $data['staff'] = $staff;

                if (empty($prev_record)) 
                {
                $data['prev_record']  = array();
                } 
                else
                {
                $data['total_count']  = count($prev_record);
                $data['prev_record']  = $prev_record;
                }

                $data['subject']          = $subject;
                $data['day']              = $day;
                $data['class_id']         = $class_id;
                $data['section_id']       = $section_id;
                $data['subject_group_id'] = $subject_group_id;
                $data['subst_date']       = $subst_date;
                $data['getsubstitute']= $this->subjecttimetable_model->get_substitute();
                $data['html'] = $this->load->view('admin/timetable/addrow_substitute', $data, true);
                echo json_encode($data);
                }


                public function savegroup_substitute()
                {
                $json             = array();
                $day              = $this->input->post('day');
                $class_id         = $this->input->post('class_id');
                $section_id       = $this->input->post('section_id');
                $subject_group_id = $this->input->post('subject_group_id');
                $total_row        = $this->input->post('total_row');
                $room             = $this->input->post('room_no');
                $subjectsubs      = $this->input->post('subjectsubs');
                $staffsubs        = $this->input->post('staffsubs');
                $session          = $this->setting_model->getCurrentSession();
                $insert_array     = array();
                $update_array     = array();
                $old_input        = array();
                $prev_array       = $this->input->post('prev_array');
                $subst_date       = $this->input->post('subst_date');

                if (isset($prev_array)) 
                {
                foreach ($prev_array as $prev_arr_key => $prev_arr_value) 
                {
                $old_input[] = $prev_arr_value;
                }
                }

                $data = array();

                for($i=0;$i<sizeof($prev_array);$i++)
                { 
                $subject          = $this->input->post('subject');
                $staff            = $this->input->post('staff');

                $subjectsubs      = $this->input->post('subjectsubs');
                $staffsubs        = $this->input->post('staffsubs');
                $period_id        = $this->input->post('period_id');
                $time_from        = $this->input->post('time_from');
                $time_to          = $this->input->post('time_to');

                $this->db->where(array('timetable_id'=>$prev_array[$i], 'substitute_date'=> $subst_date));
                $q = $this->db->get('subject_timetable_substitute');

                if ($q->num_rows() > 0)
                {

                $update_array[] = array(
                'timetable_id'                  => $prev_array[$i],
                'substitute_date'              => $subst_date,
                'subject_group_subject_idsubs'  => $subjectsubs[$i],
                'staff_idsubs'                  => $staffsubs[$i],
                'substitute_date'               => $subst_date);
                }
                else
                {
                $insert_array[] = array(
                'day'                      => $day,
                'class_id'                 => $class_id,
                'section_id'               => $section_id,
                'subject_group_id'         => $subject_group_id,
                'subject_group_subject_id' => $subject[$i],
                'staff_id'                 => $staff[$i],
                'time_from'                => $time_from[$i],
                'time_to'                  => $time_to[$i],
                'subject_group_subject_idsubs' => $subjectsubs[$i],
                'staff_idsubs'            => $staffsubs[$i],
                'period_id'               => $period_id[$i],
                'room_no'                  => $room[$i],
                'session_id'               => $session,
                'timetable_id'             => $prev_array[$i],
                'substitute_date'          => $subst_date,
                );
                }
                $this->db->where(array('id'=>$staff[$i]));
                $sql= $this->db->get('staff');
                $staff=$sql->row_array();

                $this->db->where(array('id'=>$staffsubs[$i]));
                $sqlsubs= $this->db->get('staff');
                $staff_subs=$sqlsubs->row_array();
                $contactno=$staff_subs['contact_no'];

                $dayval= date('l', strtotime($subst_date));

                $this->db->where(array('subject_group_subjects.id'=>$subjectsubs[$i]));
                $this->db->join('subjects', 'subjects.id=subject_group_subjects.subject_id ');
                $sqlsubjects= $this->db->get('subject_group_subjects');
                $subject_subs=$sqlsubjects->row_array();
                $this->db->where(array('id'=>$class_id));
                $sqlclas    =  $this->db->get('classes'); 
                $class      =  $sqlclas->row_array();
                $this->db->where(array('id'=>$section_id));
                $sqlsection =  $this->db->get('sections');
                $section    =  $sqlsection->row_array();
                $this->db->where(array('periodic_table_id'=>$period_id[$i]));
                $sqlperiod = $this->db->get('periodic_table');
                $periodval   = $sqlperiod->row_array();
                $subs_staff  = $staff_subs['name'];
                $subs_shortname  = $staff_subs['shortname'];
                $staf= $staff['name'];
                $classes=$class['class'];
                $sections=$section['section'];
                $period=$periodval['periodic_table_name'];
                $subname=$subject_subs['name'];
                $subcode=$subject_subs['code'];
                $phoneno= $contactno;
                $heading="*Period Substitution :*";
                $name="*$subs_staff($subs_shortname)*";
                $date="$subst_date($dayval)";
                $class="*$classes $sections*";
                $period="*$period ($time_from[$i] to $time_to[$i])*";
                $subjectname="$subname";
                $subjectcode="$subcode";
                $description="For More Details : Please Check Class wise Timetable/Teacher's Timetable";

                if($staff_subs['name']!="")
                {
                $formated_message=" {$heading}\nStaff Name : {$name}\nDate : {$date}\nClass : {$class}\nPeriod : {$period}\nSubject : {$subjectname}{$subjectcode}\n\n\n$description";
                $this->smsgateway->sendWhatsAppSMS($phoneno,$formated_message );
                }
                }

                $delete_array = array_diff($old_input, $preserve_array);
                $result       = $this->subjecttimetable_model->add_subs($delete_array, $insert_array, $update_array,$subst_date);

                if ($result) {
                $json_array = array('status' => '1', 'error' => '', 'message' => $this->lang->line('success_message'));
                } else {
                $json_array = array('status' => '2', 'error' => '', 'message' => $this->lang->line('something_wrong'));
                } 


                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($json_array));

                }


                public function savegroup()
                {
                $json = array();
                $this->form_validation->set_rules('subject_group_id', $this->lang->line('subject_group'), 'trim|required');
                $this->form_validation->set_rules('day', $this->lang->line('day'), 'trim|required');
                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required');

                foreach ($this->input->post('total_row') as $key => $value)
                {
                // $this->form_validation->set_rules('subject_' . $value, 'Subject', 'trim|required');
                $this->form_validation->set_rules('staff_' . $value, 'Staff', 'trim|required');
                $this->form_validation->set_rules('time_from_' . $value, 'Time From', 'trim|required');
                $this->form_validation->set_rules('time_to_' . $value, 'Time To', 'trim|required');
                $this->form_validation->set_rules('room_no_' . $value, 'Room No', 'trim|required');
                $this->form_validation->set_rules('period_id_' . $value, 'Period', 'trim|required');
                //$this->form_validation->set_rules('subjectpaper_' . $value, 'Subject Paper', 'trim|required');
                }

                if (!$this->form_validation->run()) 
                {
                $json = array(
                'subject_group_id' => form_error('subject_group_id', '<li>', '</li>'),
                'day'              => form_error('day', '<li>', '</li>'),
                'class_id'         => form_error('class_id', '<li>', '</li>'),
                'section_id'       => form_error('section_id', '<li>', '</li>'),
                );

                foreach ($this->input->post('total_row') as $key => $value)
                {
                // $json['subject_' . $value]   = form_error('subject_' . $value, '<li>', '</li>');
                $json['staff_' . $value]     =   form_error('staff_' . $value, '<li>', '</li>');
                $json['time_from_' . $value] =   form_error('time_from_' . $value, '<li>', '</li>');
                $json['time_to_' . $value]   =   form_error('time_to_' . $value, '<li>', '</li>');
                $json['room_no_' . $value]   =   form_error('room_no_' . $value, '<li>', '</li>');
                $json['period_id_' . $value]   = form_error('period_id_' . $value, '<li>', '</li>');
                // $json['subjectpaper_' . $value]   = form_error('subjectpaper_' . $value, '<li>', '</li>');
                }
                $json_array = array('status' => '0', 'error' => $json);
                }
                else 
                {
                $day              = $this->input->post('day');
                $class_id         = $this->input->post('class_id');
                $section_id       = $this->input->post('section_id');
                $subject_group_id = $this->input->post('subject_group_id');
                $total_row        = $this->input->post('total_row');
                $session          = $this->setting_model->getCurrentSession();
                $insert_array     = array();
                $update_array     = array();
                $old_input        = array();
                $prev_array       = $this->input->post('prev_array');
                if (isset($prev_array)) 
                {
                foreach ($prev_array as $prev_arr_key => $prev_arr_value) {
                $old_input[] = $prev_arr_value;
                }
                }

                $preserve_array = array();
                if (isset($total_row)) {
                foreach ($total_row as $total_key => $total_value)
                {
                $prev_id = $this->input->post('prev_id_' . $total_value);

                if ($prev_id == 0)
                {
                // $subjectpaper  = $this->input->post('subjectpaper_' . $total_value);
                // $this->db->select('subjectpaper_subjectid');
                // $this->db->from('subjectpaper');
                // $this->db->where('subjectpaper_id', $subjectpaper);
                // $query        = $this->db->get();
                // $sub_pap      = $query->row_array()['subjectpaper_subjectid'];

                $subjectpaper = $this->input->post('subjectpaper_' . $total_value);
                $this->db->select('subject_group_subjects.id');
                $this->db->from('subjectpaper');
                $this->db->join('subject_group_subjects','subject_group_subjects.subject_id=subjectpaper.subjectpaper_subjectid');
                $this->db->where(array('subjectpaper.subjectpaper_id'=> $subjectpaper,'subject_group_subjects.session_id'=>$this->current_session));
                $query      = $this->db->get();
                $sub_pap    = $query->row_array()['id'];


                $insert_array[] = array(
                'day'                      => $day,
                'class_id'                 => $class_id,
                'section_id'               => $section_id,
                'subject_group_id'         => $subject_group_id,
                'subject_paper_id'         => $this->input->post('subjectpaper_' . $total_value),
                // 'subject_group_subject_id' => $this->input->post('subject_' . $total_value),
                'subject_group_subject_id' => $sub_pap,
                'staff_id'                 => $this->input->post('staff_' . $total_value),
                'time_from'                => $this->input->post('time_from_' . $total_value),
                'time_to'                  => $this->input->post('time_to_' . $total_value),
                'start_time'               => $this->customlib->timeFormat($this->input->post('time_from_' . $total_value), true),
                'end_time'                 => $this->customlib->timeFormat($this->input->post('time_to_' . $total_value), true),
                'period_id'                => $this->input->post('period_id_' . $total_value),
                'room_no'                  => $this->input->post('room_no_' . $total_value),
                'session_id'               => $session,
                );
                } else {

                // $subjectpaper = $this->input->post('subjectpaper_' . $total_value);
                // $this->db->select('subjectpaper_subjectid');
                // $this->db->from('subjectpaper');
                // $this->db->where('subjectpaper_id', $subjectpaper);
                // $query = $this->db->get();
                // $sub_pap = $query->row_array()['subjectpaper_subjectid'];


                $subjectpaper = $this->input->post('subjectpaper_' . $total_value);
                $this->db->select('subject_group_subjects.id');
                $this->db->from('subjectpaper');
                $this->db->join('subject_group_subjects','subject_group_subjects.subject_id=subjectpaper.subjectpaper_subjectid ');
                $this->db->where(array('subjectpaper.subjectpaper_id'=> $subjectpaper,'subject_group_subjects.session_id'=>$this->current_session));
                $query   = $this->db->get();
                $sub_pap = $query->row_array()['id'];


                $preserve_array[] = $prev_id;
                $update_array[]   = array(
                'id'                       => $prev_id,
                'day'                      => $day,
                'class_id'                 => $class_id,
                'section_id'               => $section_id,
                'subject_group_id'         => $subject_group_id,
                'subject_paper_id'         => $this->input->post('subjectpaper_' . $total_value),
                'subject_group_subject_id' => $sub_pap,
                'staff_id'                 => $this->input->post('staff_' . $total_value),
                'time_from'                => $this->input->post('time_from_' . $total_value),
                'time_to'                  => $this->input->post('time_to_' . $total_value),
                'period_id'               => $this->input->post('period_id_' . $total_value),
                'start_time'               => $this->customlib->timeFormat($this->input->post('time_from_' . $total_value), true),
                'end_time'                 => $this->customlib->timeFormat($this->input->post('time_to_' . $total_value), true),
                'room_no'                  => $this->input->post('room_no_' . $total_value),
                'session_id'               => $session,
                );
                }
                }
                }

                $delete_array = array_diff($old_input, $preserve_array);
                $result       = $this->subjecttimetable_model->add($delete_array, $insert_array, $update_array);
                if ($result) {
                $json_array = array('status' => '1', 'error' => '', 'message' => $this->lang->line('success_message'));
                } else {
                $json_array = array('status' => '2', 'error' => '', 'message' => $this->lang->line('something_wrong'));
                }
                }

                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($json_array));
                }





                public function timetable_detail()
                {
                $day              = $this->input->post('day');
                $class_id         = $this->input->post('class_id');
                $section_id       = $this->input->post('section_id');
                $subject_group_id = $this->input->post('subject_group_id');
                }




                public function getteachertimetable()
                {
                $json = array();
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('teacher', $this->lang->line('teacher'), 'trim|required');

                if (!$this->form_validation->run()) {
                $json = array(
                'teacher' => form_error('teacher'),
                );

                $json_array = array('status' => '0', 'error' => $json);
                } else {
                $staff_id          = $this->input->post('teacher');
                $data['timetable'] = array();
                $days              = $this->customlib->getDaysname();

                foreach ($days as $day_key => $day_value) {
                $data['timetable'][$day_value] = $this->subjecttimetable_model->getByStaffandDay($staff_id, $day_key);
                }

                $timetable_page = $this->load->view('admin/timetable/_partialgetteachertimetable', $data, true);
                $json_array = array('status' => '1', 'error' => '', 'message' => $timetable_page);
                }

                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($json_array));
                }


                public function getperiod()
                {
                $period_id=$this->input->post('period_id');
                $json_array=$this->subjecttimetable_model->addperiod($period_id);
                echo json_encode($json_array);
                }

                

                public function getsubjectpaper()
                {
                $subjectpaper_id=$this->input->post('subjectpaper_id');
                $json_array=$this->subjecttimetable_model->addsubject_paper($subjectpaper_id);
                echo json_encode($json_array);
                }



                public function get_subjects()
                {
                $subjectpaper=$this->input->post('subjectpaper');
                $json_array=$this->subjecttimetable_model->get_subjectpaper($subjectpaper);
                echo json_encode($json_array);
                }

                public function classreport_report()
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable_substitute');

                $session            = $this->setting_model->getCurrentSession();
                $data['title']      = 'Time Table';
                $data['subject_id'] = "";
                $data['class_id']   = "";
                $data['section_id'] = "";
                $exam               = $this->exam_model->get();
                $class              = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']        = $exam;
                $data['classlist']       = $class;
                $userdata                = $this->customlib->getUserData();
                $staff                   = $this->staff_model->getStaffbyrole(2);
                $period                  = $this->staff_model->getperiod();
                $data['period']          = $period;
                $data['staff']           = $staff;
                $data['subject']         = array();
                $feecategory             = $this->feecategory_model->get();
                $data['feecategorylist'] = $feecategory;
                $this->form_validation->set_rules('subst_date', $this->lang->line('date'), 'trim|required|xss_clean');
                $class_id                 = $this->input->post('class_id');
                $section_id               = $this->input->post('section_id');
                $subject_group_id         = $this->input->post('subject_group_id');

                $data['subst_date']       = $this->input->post('subst_date');

                $subst_date               =  $data['subst_date'];
                $data['dayval']           = date('l', strtotime($subst_date));

                $data['class_id']         = $class_id;
                $data['section_id']       = $section_id;
                $data['subject_group_id'] = $subject_group_id;
                if ($this->form_validation->run() == false)
                {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/substitute_report', $data);
                $this->load->view('layout/footer', $data);
                }
                else 
                {
                $data['substitute_report'] = $this->subjecttimetable_model->getclasssection_substituteReport($class_id, $section_id,$subject_group_id, $subst_date);
                $getDaysnameList           = $this->customlib->getDaysname();
                $data['getDaysnameList']   = $getDaysnameList;
                $subject                   = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $data['subject']           = $subject;

                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/substitute_report', $data);
                $this->load->view('layout/footer', $data);
                }
                }



                public function create_TimetableCreate()
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable');

                $session                   = $this->setting_model->getCurrentSession();
                $data['title']             = 'Exam Schedule';
                $data['subject_id']        = "";
                $data['class_id']          = "";
                $data['section_id']        = "";
                $exam                      = $this->exam_model->get();
                $class                     = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']          = $exam;
                $data['classlist']         = $class;
                $userdata                  = $this->customlib->getUserData();
                $staff                     = $this->staff_model->getStaffbyrole(2);
                $period                    = $this->staff_model->getperiod();
                $data['period']            = $period;
                $data['staff']             = $staff;
                $data['subject']           = array();
                $feecategory               = $this->feecategory_model->get();
                $data['feecategorylist']   = $feecategory;

                $feecategory               = $this->feecategory_model->get();
                $data['feecategorylist']   = $feecategory; 
                $subjectpapers             = $this->Subjectpaper_model->getsubjectpapers();
                $data['subjectpapers']     = $subjectpapers; 

                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('subject_group_id', $this->lang->line('group'), 'trim|required|xss_clean');
                $class_id                 = $this->input->post('class_id');
                $section_id               = $this->input->post('section_id');
                $subject_group_id         = $this->input->post('subject_group_id');

                $data['class_id']         = $class_id;
                $data['section_id']       = $section_id;
                $data['subject_group_id'] = $subject_group_id;
                if ($this->form_validation->run() == false)
                {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate_Create', $data);
                $this->load->view('layout/footer', $data);
                } 
                else 
                {
                $getDaysnameList         = $this->customlib->getDaysname();
                $data['getDaysnameList'] = $getDaysnameList;
                $subject                 = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $data['subject']         = $subject;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate_Create', $data);
                $this->load->view('layout/footer', $data);
                }
                }





                public function savetimetable_create() 
                {
                $day              = $this->input->post('day');
                $class_id         = $this->input->post('class_id');
                $section_id       = $this->input->post('section_id');
                $subject_group_id = $this->input->post('subject_group_id');
                $subjectpaper     = $this->input->post('subjectpaper'); 
                $getsubname       = $this->input->post('getsubname'); 
                $staff            = $this->input->post('staff_id'); 
                $period_id        = $this->input->post('period_id'); 
                $time_from        = $this->input->post('time_from'); 
                $time_to          = $this->input->post('time_to'); 
                $room_no          = $this->input->post('room_no');
                $allData          = [];
                for ($i = 0; $i < count($subjectpaper); $i++) 
                {
                $this->db->select('subject_group_subjects.id');
                $this->db->from('subjectpaper');
                $this->db->join('subject_group_subjects', 'subject_group_subjects.subject_id = subjectpaper.subjectpaper_subjectid');
                $this->db->where(array(
                'subjectpaper.subjectpaper_id' => $subjectpaper[$i],
                'subject_group_subjects.session_id' => $this->current_session
                ));
                $query                      =  $this->db->get();
                $sub_pap                    =  $query->row_array()['id'];

                $data[$i]                   =  array(	
                'day'                       => $day,
                'class_id'                  => $class_id,
                'section_id'                => $section_id,    
                'subject_group_id'          => $subject_group_id,
                'subject_paper_id'          => $subjectpaper[$i],
                'subject_group_subject_id'  => $sub_pap,
                'staff_id'                  => isset($staff[$i]) ? $staff[$i] : '',
                'period_id'                 => isset($period_id[$i]) ? $period_id[$i] : '',
                'time_from'                 => isset($time_from[$i]) ? $time_from[$i] : '',
                'time_to'                   => isset($time_to[$i]) ? $time_to[$i] : '',
                'room_no'                   => isset($room_no[$i]) ? $room_no[$i] : '',
                'session_id'                => $this->current_session);
                $allData[]                  =  $data[$i];
                $debugData                  =  print_r($data[$i], true);
                }
                $this->db->insert_batch('subject_timetable', $allData);
                redirect($_SERVER['HTTP_REFERER']);	
                }






                public function viewtable_Details() 
                {
                if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) 
                {
                access_denied();
                }
                $this->session->set_userdata('top_menu', 'Academics');
                $this->session->set_userdata('sub_menu', 'Academics/timetable');

                $session                   = $this->setting_model->getCurrentSession();
                $data['title']             = 'Exam Schedule';
                $data['subject_id']        = "";
                $data['class_id']          = "";
                $data['section_id']        = "";
                $exam                      = $this->exam_model->get();
                $class                     = $this->class_model->get('', $classteacher = 'yes');
                $data['examlist']          = $exam;
                $data['classlist']         = $class;
                $userdata                  = $this->customlib->getUserData();
                $staff                     = $this->staff_model->getStaffbyrole(2);
                $period                    = $this->staff_model->getperiod();
                $data['period']            = $period;
                $data['staff']             = $staff;
                $data['subject']           = array();
                $feecategory               = $this->feecategory_model->get();
                $data['feecategorylist']   = $feecategory;

                $feecategory               = $this->feecategory_model->get();
                $data['feecategorylist']   = $feecategory; 
                $subjectpapers             = $this->Subjectpaper_model->getsubjectpapers();
                $data['subjectpapers']     = $subjectpapers; 

                $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required|xss_clean');
                $this->form_validation->set_rules('subject_group_id', $this->lang->line('group'), 'trim|required|xss_clean');
                $class_id                  = $this->input->post('class_id');
                $section_id                = $this->input->post('section_id');
                $subject_group_id          = $this->input->post('subject_group_id');
                $day                       = $this->input->post('day');

                $data['class_id']          = $class_id;
                $data['section_id']        = $section_id;
                $data['subject_group_id']  = $subject_group_id;
                $data['day']               = $day;
                $data['view_details']      = $this->subjecttimetable_model->getByDayClassSection($day, $class_id, $section_id,$subject_group_id);

                if ($this->form_validation->run() == false)
                {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate_List', $data);
                $this->load->view('layout/footer', $data);
                } 
                else 
                {
                $getDaysnameList         = $this->customlib->getDaysname();
                $data['getDaysnameList'] = $getDaysnameList;
                $subject                 = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
                $data['subject']         = $subject;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/timetable/timetableCreate_List', $data);
                $this->load->view('layout/footer', $data);
                }	
                }



                public function delete_table($id=0)
                {
                $this->db->where('id', $id);
                $query = $this->db->get('subject_timetable');
                $row = $query->row_array();
                if ($row)
                {
                $row['deleted_on'] = date('Y-m-d H:i:s'); 
                $this->db->insert('subject_timetable_deleted', $row);
                $this->db->where('id', $id);
                $this->db->delete('subject_timetable');
                }
                redirect($_SERVER['HTTP_REFERER']);
                }
                }
