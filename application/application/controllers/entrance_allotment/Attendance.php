            <?php
            //defined('BASEPATH')OR exit('No direct script access allowed');
            class Attendance extends Admin_Controller 
            {
            
            
            public function index() 
            {
            if (!$this->rbac->hasPrivilege('entrance_attendance', 'can_view')) 
            {
            access_denied();
            }
            
            $this->session->set_userdata('top_menu', 'entrance_exam');
            $this->session->set_userdata('sub_menu', 'entrance_allotment/attendance');
            
            $data['current_session']        =       $this->user_model->get_current_session();
            $data['title']                  =       'Attendance';
            $table                          =       "entranceexam_course";
            $ta                             =       "sessions";
            $condition                      =       array('entranceexam_course_status'=>1);
            $data['course']                 =       $this->Entranceallotment_model->list_data($table,$condition);
            $data['courseid']               =       $this->input->post('entrance_course');
            $data['phaseid']                =       $this->input->post('phaseid');
            $phaseid                        =       $data['phaseid'];
            $courseid                       =       $data['courseid'];
            $data['session_id']             =       $this->input->post('session');
            $session_id                     =       $data['session_id'];
            $data['subjectid']              =       $this->input->post('entrance_subject');
            $subjectid                      =       $data['subjectid'];
            // $data['sessionlist']         =       $this->Entranceallotment_model->list_dat($ta);
            $data['sessionlist']            =       $this->session_model->get();
            $data['applicants']             =       $this->Entranceallotment_model->get_allotapplicants($courseid,$session_id,$subjectid,$phaseid);
            
            
            $data['subject_marks']               =  $this->Entranceallotment_model->get_subjectmarks($courseid,$session_id,$subjectid);
            $data['getby_attendance']            =  $this->Entranceallotment_model->get_attendance();
            $data['current_entrancesession']     =  $this->Entrance_settings_model->get_entrance_settings();
            $current_entrancesession             =  $data['current_entrancesession'];
            $phaselist                           =  $this->Entranceexam_model->phase($current_entrancesession['cur_session']);
            $data['phaselist']                   =  $phaselist;
            
            $this->load->view('layout/headerentrance');
            $this->load->view('admin/entranceexam/examgroup/attendance/index', $data);
            $this->load->view('layout/footer');
            }
            
            
            
            
            public function getentranceSubject()
            {
            $entrance_course     =   $this->input->post('entrance_course');
            $data                =   $this->Entranceallotment_model->getentrance_subject($entrance_course);
            echo json_encode($data);
            }
            
            
            
            public function enterattendance()
            {
            $applicantname   = $this->input->post('applicantname');
            $subjectid       = $this->input->post('subjectid');
            $marks           = $this->input->post('marks');
            $notes           = $this->input->post('notes');
            $attendence      = $this->input->post('attendence');
            $session_id      = $this->input->post('session_id');
            $insert_array    = array();
            $update_array    = array();
            
            for($i=0;$i<=count($applicantname);$i++)
            {
            $this->db->where('entranceexam_attendance_applicant', $applicantname[$i]);
            $this->db->where('entranceexam_attendance_subject', $subjectid[$i]);
            $this->db->where('entranceexam_attendance_session', $session_id[$i]);
            $q = $this->db->get('entranceexam_attend');
            if ($q->num_rows() > 0)
            {
            $update_result[$i] = $q->row();
            $data[$i]          =  array(
            'entranceexam_attendance_attendence'                =>  $attendence[$i],
            'entranceexam_attendance_notes'                     =>  $notes[$i],
            'entranceexam_attendance_updateddate'               =>  date('y-m-d h:i:s'));
            $this->db->where('entranceexam_attendance_id', $update_result[$i]->entranceexam_attendance_id);
            $this->db->update('entranceexam_attend', $data[$i]);
            }
            else
            {
            $data[$i]                                        =  array( 
            'entranceexam_attendance_applicant'                  =>  $applicantname[$i],
            'entranceexam_attendance_subject'                    =>  $subjectid[$i],
            'entranceexam_attendance_attendence'                 =>  $attendence[$i],
            'entranceexam_attendance_notes'                      =>  $notes[$i],
            'entranceexam_attendance_session'                    =>  $session_id[$i],
            'entranceexam_attendance_createddate'                =>  date('y-m-d h:i:s'));
            $this->db->insert('entranceexam_attend',$data[$i]);                                                     
            }
            }
            redirect('entrance_allotment/attendance');
            }
            }
            ?>