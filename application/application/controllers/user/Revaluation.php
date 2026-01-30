                            <?php
                            
                            if (!defined('BASEPATH')) 
                            {
                            exit('No direct script access allowed');
                            }
                            
                            
                            class Revaluation extends Student_Controller
                            {
                                
                            public function __construct()
                            {
                            parent::__construct();
                            $session_id = $this->setting_model->getCurrentSession();
                            }
                            
                            
                            public function index()
                            {
                            
                            }
                            
                            
                            public function exam_revaluation()
                            { 
                            $student_data             =  $this->customlib->getLoggedInUserData();
                            $student_id               =  $this->customlib->getStudentSessionUserID();
                            $student_current_class    =  $this->customlib->getStudentCurrentClsSection();
                            $data['students_listt']   =  $this->student_model->get_student_list($student_id);
                            $this->session->set_userdata('top_menu', 'Examinations');
                            $this->session->set_userdata('sub_menu', 'Examinations/exam_revaluation');
                            $examgroup_result         =   $this->examgroup_model->get();
                            
                            $data['examgrouplist']    =   $examgroup_result;
                            $class                    =   $this->class_model->get();
                            $data['title']            =  'Add Batch';
                            $data['title_list']       =  'Recent Batch';
                            $data['examType']         =   $this->exam_type;
                            $data['classlist']        =   $class;
                            $session                  =   $this->session_model->get();
                            $data['sessionlist']      =   $session;
                            
                            $data['exam_group_id']    =   $this->input->post('exam_group_id');
                            $data['exam_id']          =   $this->input->post('exam_id');
                            $data['session_id']       =   $this->input->post('session_id');
                            $data['class_id']         =   $this->input->post('class_id');
                            $data['section_id']       =   $this->input->post('section_id');
                            $exam_group_id            =   $data['exam_group_id'];            
                            $exam_id                  =   $data['exam_id'];            
                            $session_id               =   $data['session_id'];        
                            $class_id                 =   $data['class_id'];            
                            $section_id               =   $data['section_id'];
                            $data['student_session_id']=  $student_id;
                            
                            $data['studentList'] = $this->examgroupstudent_model->searchExamStudents($exam_group_id, $exam_id, $class_id, $section_id, $session_id);
                            if (!empty($studentList)) 
                            {
                            foreach ($studentList as $student_key => $student_value) {
                            $studentList[$student_key]->subject_results      =  $this->examresult_model->getStudentResultByExam($exam_id, $student_value->exam_group_class_batch_exam_student_id);
                            }
                            }
                            
                            
                            $data['Exam_group_list']                         =  $this->examgroup_model->getExamBy_NewExamGroup($exam_group_id, $exam_id);
                            $data['examList']                                =  $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                            //$data['admin_approval']         = $this->examgroupstudent_model->getonline_examintaion_approvedbyadmin($exam_group_id, $exam_id);
                            
                            $data['revaluation_approval']                    =  $this->examgroupstudent_model->revaluation_approvedbyadmin($exam_group_id, $exam_id);
                            $data['examList']                                =  $this->examgroup_model->getExamByExamGroup($exam_group_id, true);
                            
                            $data['sch_setting']                             =  $this->sch_setting_detail;
                            $students_array                                  =  $this->input->post('exam_group_class_batch_exam_student_id');
                            $data['exam_group_class_batch_exam_student_id']  =  $students_array;
                            
                            
                            $data['revaluationfee_payment']                  =  $this->examgroup_model->revaluationfee_payment($exam_id,$exam_group_id,$student_id,$session_id); 
                            $data['marksheet']                               =  $this->examresult_model->getExamResults($exam_id, $exam_group_id, $students_array);
                            $data['getstud']                                 =  $this->examgroupstudent_model->getstud($exam_group_id,$exam_id);
                            $data['revluation_marks']                        =  $this->examresult_model->getrevluation_marks($exam_id, $exam_group_id,$student_id);
                            $data['revaluation_feecharge']                   =  $this->examgroup_model->revaluation_feechargeadmin($exam_id, $exam_group_id,$session_id);
                            $this->load->view('layout/student/header',$data);
                            $this->load->view('user/revaluation/index', $data);
                            $this->load->view('layout/student/footer',$data);
                            }
                            
                            
                            
                            public function send_request()
                            {
                            // $session_id                                     = $this->setting_model->getCurrentSession();
                            // $student_id                                     = $this->customlib->getStudentSessionUserID(); 
                            
                            // $exam_group_exam_results_id                     = $this->input->post('exam_group_exam_results_id');
                            // $exam_group_exam_results_stud_id                = $this->input->post('exam_group_exam_results_stud_id');
                            
                            // $data['exam_group_exam_results_exam_idd']        = $this->input->post('exam_idd');
                            // $data['exam_group_exam_results_exam_groupidd']   = $this->input->post('exam_groupidd');
                            // $exam_group_exam_results_exam_idd                = $data['exam_group_exam_results_exam_idd'];
                            // $exam_group_exam_results_exam_groupidd           = $data['exam_group_exam_results_exam_groupidd'];
                            
                            // $data['exam_group_exam_results_exam_idd']       = $this->input->post('exam_idd');
                            // $data['exam_group_exam_results_exam_groupidd']  = $this->input->post('exam_groupidd');
                            // $exam_group_exam_results_exam_idd               = $data['exam_group_exam_results_exam_idd'];
                            // $exam_group_exam_results_exam_groupidd          = $data['exam_group_exam_results_exam_groupidd'];
                            // $data['exam_session_id']                        = $this->input->post('exam_session_id');
                            // $data['exam_class_id']                          = $this->input->post('exam_class_id');
                            // $data['exam_section_id']                        = $this->input->post('exam_section_id');
                            // $exam_class_id                                  = $data['exam_class_id'];
                            // $exam_session_id                                = $data['exam_session_id'];
                            // $exam_section_id                                = $data['exam_section_id'];
                            // $session_id                                     = $this->setting_model->getCurrentSession();
                            
                            // for($i=0;$i<count($exam_group_exam_results_id);$i++)
                            // { 
                            // $this->db->select('*');
                            // $this->db->from('exam_group_exam_results');
                            // $this->db->where(array('id'=> $exam_group_exam_results_id[$i]));
                            // $query = $this->db->get();
                            // $res= $query->row_array();
                            
                            // $this->db->where('exam_group_exam_revaluation_result_id', $exam_group_exam_results_id[$i]);
                            // $this->db->where('exam_group_exam_revaluation_studentid', $exam_group_exam_results_stud_id[$i]);
                            // $this->db->where('exam_group_exam_revaluation_subject_id', $res['exam_group_class_batch_exam_subject_id']);
                            // $q = $this->db->get('exam_group_exam_revaluation');
                            // if ($q->num_rows() > 0) 
                            // {
                            // }
                            // else
                            // {
                            // $dyt[$i] = array(                       
                            // 'exam_group_exam_revaluation_result_id'           =>  $exam_group_exam_results_id[$i],
                            // 'exam_group_exam_revaluation_studentid'           =>  $exam_group_exam_results_stud_id[$i],
                            // 'exam_group_exam_revaluation_subject_id'          =>  $res['exam_group_class_batch_exam_subject_id'],
                            // 'exam_group_exam_revaluation_createddate'         =>  date('d-m-Y'),
                            // 'exam_group_exam_revaluation_examid'              =>  $exam_group_exam_results_exam_idd,
                            // 'exam_group_exam_revaluation_examgroupid'         =>  $exam_group_exam_results_exam_groupidd,
                            // 'exam_group_exam_revaluation_student_studentid'   =>  $student_id,
                            // 'exam_group_exam_revaluation_approvedstatus'      =>   1,
                            // 'get_cmarks'                                      =>   $res['get_cmarks'],
                            // 'get_marks'                                       =>   $res['get_marks'],
                            // 'exam_group_exam_revaluation_session_id'          =>   $session_id,
                            // 'exam_group_exam_revaluation_status'              =>  1);                     
                            // $this->db->insert('exam_group_exam_revaluation', $dyt[$i]);
                            // }
                            // }
                            
                            // $data['revluation_marks'] = $this->examresult_model->getrevluation_marks($exam_group_exam_results_exam_idd, $exam_group_exam_results_exam_groupidd,$student_id); 
                            
                            // $this->load->view('layout/student/header',$data);
                            // $this->load->view('user/revaluation/revaluationview', $data);
                            // $this->load->view('layout/student/footer',$data);
                            
                            
                            $session_id          = $this->setting_model->getCurrentSession();
                            $student_id          = $this->customlib->getStudentSessionUserID();
                            
                            $checked_result_ids  = $this->input->post('exam_group_exam_results_id');     // selected checkboxes
                            $checked_student_ids = $this->input->post('exam_group_exam_results_stud_id');
                            
                            $exam_id             = $this->input->post('exam_idd');
                            $group_id            = $this->input->post('exam_groupidd');
                            
                            // Ensure arrays
                            
                            $checked_result_ids  = is_array($checked_result_ids) ? $checked_result_ids : [];
                            $checked_student_ids = is_array($checked_student_ids) ? $checked_student_ids : [];
                            
                            // 1. Get already saved revaluation entries
                            $this->db->where([
                                'exam_group_exam_revaluation_examid'            => $exam_id,
                                'exam_group_exam_revaluation_examgroupid'       => $group_id,
                                'exam_group_exam_revaluation_student_studentid' => $student_id,
                            ]);
                            $existing = $this->db->get('exam_group_exam_revaluation')->result_array();
                            
                            // 2. Map old: result_id => full row
                            
                            $existing_map = [];
                            foreach ($existing as $row) {
                                $existing_map[$row['exam_group_exam_revaluation_result_id']] = $row;
                            }
                            
                            // 3. Track checked result IDs
                            $keep_ids        = [];
                            
                            for ($i = 0; $i < count($checked_result_ids); $i++) {
                                $result_id   = $checked_result_ids[$i];
                                $stud_id     = $checked_student_ids[$i];
                                $keep_ids[]  = $result_id;
                                $result      = $this->db->where('id', $result_id)->get('exam_group_exam_results')->row_array();
                                if (!$result)
                                continue;
                                $data = [
                                    'exam_group_exam_revaluation_result_id'         => $result_id,
                                    'exam_group_exam_revaluation_studentid'         => $stud_id,
                                    'exam_group_exam_revaluation_subject_id'        => $result['exam_group_class_batch_exam_subject_id'],
                                    'exam_group_exam_revaluation_createddate'       => date('Y-m-d'),
                                    'exam_group_exam_revaluation_examid'            => $exam_id,
                                    'exam_group_exam_revaluation_examgroupid'       => $group_id,
                                    'exam_group_exam_revaluation_student_studentid' => $student_id,
                                    'exam_group_exam_revaluation_approvedstatus'    => 1,
                                    'get_cmarks'                                    => $result['get_cmarks'],
                                    'get_marks'                                     => $result['get_marks'],
                                    'exam_group_exam_revaluation_session_id'        => $session_id,
                                    'exam_group_exam_revaluation_status'            => 1 ];
                            
                                if (isset($existing_map[$result_id])) {
                                    // Already exists → Update
                                    $this->db->where('exam_group_exam_revaluation_id', $existing_map[$result_id]['exam_group_exam_revaluation_id'])
                                             ->update('exam_group_exam_revaluation', $data);
                                } else {
                                    // New → Insert
                                    $this->db->insert('exam_group_exam_revaluation', $data);
                                }
                                
                                
                            }
                            
                            // 4. Delete unchecked
                            foreach ($existing_map as $result_id => $row) 
                            {
                                if (!in_array($result_id, $keep_ids)) 
                                {
                                    $this->db->where('exam_group_exam_revaluation_id', $row['exam_group_exam_revaluation_id'])
                                             ->delete('exam_group_exam_revaluation');
                                }
                            }
                            
                            $exam_group_exam_results_id                     = $this->input->post('exam_group_exam_results_id');
                            $exam_group_exam_results_stud_id                = $this->input->post('exam_group_exam_results_stud_id');
                            $data['exam_group_exam_results_exam_idd']       = $this->input->post('exam_idd');
                            $data['exam_group_exam_results_exam_groupidd']  = $this->input->post('exam_groupidd');
                            $exam_group_exam_results_exam_idd               = $data['exam_group_exam_results_exam_idd'];
                            $exam_group_exam_results_exam_groupidd          = $data['exam_group_exam_results_exam_groupidd'];
                            $data['exam_session_id']                        = $this->input->post('exam_session_id');
                            $data['exam_class_id']                          = $this->input->post('exam_class_id');
                            $data['exam_section_id']                        = $this->input->post('exam_section_id');
                            $exam_class_id                                  = $data['exam_class_id'];
                            $exam_session_id                                = $data['exam_session_id'];
                            $exam_section_id                                = $data['exam_section_id'];
                            $data['revluation_marks'] = $this->examresult_model->getrevluation_marks($exam_group_exam_results_exam_idd, $exam_group_exam_results_exam_groupidd,$student_id); 
                            $this->load->view('layout/student/header',$data);
                            $this->load->view('user/revaluation/revaluationview', $data);
                            $this->load->view('layout/student/footer',$data);
                            }
                            
                            
                            public function getstudentbatch_id() 
                            {
                            $student_id     = $this->customlib->getStudentSessionUserID(); 
                            $exam_id        = $this->input->post('exam_id');
                            $data           = $this->examgroup_model->getstudentbatch_id($exam_id,$student_id);
                            echo json_encode($data);
                            }
                            
                            
                            public function inprogress()
                            {
                            $session_id                                     = $this->setting_model->getCurrentSession();
                            $student_id                                     = $this->customlib->getStudentSessionUserID(); 
                            
                            $exam_group_exam_results_id                     = $this->input->post('exam_group_exam_results_id');
                            $exam_group_exam_results_stud_id                = $this->input->post('exam_group_exam_results_stud_id');
                            
                            $data['exam_group_exam_results_exam_idd']       = $this->input->post('exam_idd');
                            $data['exam_group_exam_results_exam_groupidd']  = $this->input->post('exam_groupidd');
                            $exam_group_exam_results_exam_idd               = $data['exam_group_exam_results_exam_idd'];
                            $exam_group_exam_results_exam_groupidd          = $data['exam_group_exam_results_exam_groupidd'];
                            
                            $data['exam_group_exam_results_exam_idd']       = $this->input->post('exam_idd');
                            $data['exam_group_exam_results_exam_groupidd']  = $this->input->post('exam_groupidd');
                            $exam_group_exam_results_exam_idd               = $data['exam_group_exam_results_exam_idd'];
                            $exam_group_exam_results_exam_groupidd          = $data['exam_group_exam_results_exam_groupidd'];
                            $data['exam_session_id']                        = $this->input->post('exam_session_id');
                            $data['exam_class_id']                          = $this->input->post('exam_class_id');
                            $data['exam_section_id']                        = $this->input->post('exam_section_id');
                            $exam_class_id                                  = $data['exam_class_id'];
                            $exam_session_id                                = $data['exam_session_id'];
                            $exam_section_id                                = $data['exam_section_id'];
                            $session_id                                     = $this->setting_model->getCurrentSession();
                            $data['revluation_marks']                       = $this->examresult_model->getrevluation_marks($exam_group_exam_results_exam_idd, $exam_group_exam_results_exam_groupidd,$student_id); 
                            
                            $this->load->view('layout/student/header',$data);
                            $this->load->view('user/revaluation/inprogress', $data);
                            }                             
                            
                            
                            
                            public function proceedtopayment()
                            {
                            $student_id                                     = $this->customlib->getStudentSessionUserID();
                            $exam_group_exam_results_id                     = $this->input->post('exam_group_exam_results_id');
                            $exam_group_exam_results_stud_id                = $this->input->post('exam_group_exam_results_stud_id');
                            $data['exam_group_exam_results_exam_idd']       = $this->input->post('exam_group_exam_results_exam_idd');
                            $data['exam_group_exam_results_exam_groupidd']  = $this->input->post('exam_group_exam_results_exam_groupidd');
                            
                            $exam_group_exam_results_exam_idd       = $data['exam_group_exam_results_exam_idd'];
                            $exam_group_exam_results_exam_groupidd  = $data['exam_group_exam_results_exam_groupidd'];
                            $data['exam_session_id']                = $this->input->post('exam_session_id');
                            $session_id                             = $data['exam_session_id'] ; 
                            $data['exam_session_id'] ;
                            $data['exam_class_id']                  = $this->input->post('exam_class_id');
                            $data['exam_section_id']                = $this->input->post('exam_section_id');
                            $data['revluation_marks']               = $this->examresult_model->getrevluation_marks($exam_group_exam_results_exam_idd, $exam_group_exam_results_exam_groupidd,$student_id);
                            $data['revaluation_feecharge']          = $this->examgroup_model->revaluation_feechargeadmin($exam_group_exam_results_exam_idd, $exam_group_exam_results_exam_groupidd,$session_id);
                            
                            $this->load->view('layout/student/header',$data);
                            $this->load->view('user/revaluation/revaluaton_proceedtopayment', $data);
                            $this->load->view('layout/student/footer',$data);
                            } 
                            
                            


                            
                            public function meTrnReq()
                            {
                                
                            $data['parameters']      = file_get_contents(APPPATH . 'views/revpayment_store/parameters.json');

                            $data['paymentconfig']   = $this->user_model->payment_config();
                            $student_id              = $this->customlib->getStudentSessionUserID();
                            $data['totalamt']        = $this->input->post('totalamt');
                            $data['student_id']      = $student_id ;
                            $data['examgroup']       = $this->input->post('examgroup');
                            $data['examgroupbatch']  = $this->input->post('examgroupbatch');
                            $data['class_id']        = $this->input->post('class_id');
                            $data['section_id']      = $this->input->post('section_id');
                            $data['session_id']      = $this->input->post('session_id');
                            
                            $this->load->view('layout/student/header', $data);
                            // $this->load->view('user/revaluation/standard/meTrnReq', $data);
                            $this->load->view('revpayment_store/techprocess',$data);
                            $this->load->view('layout/student/footer', $data);
                            }
                            
                            public function meTrnSuccess()
                            {
                            $data['paymentconfig']   = $this->user_model->payment_config();    
                            $this->load->view('user/revaluation/standard/meTrnSuccess',$data);
                            }
                            
                            
                            public function meTrnPayment()
                            {
                            $student_id              = $this->customlib->getStudentSessionUserID();
                            $amount                  = $this->input->post('amount');
                            $paise                   = $amount*100;
                            $data['orderId']         = $this->input->post('orderId');
                            $data['responseUrl']     = $this->input->post('responseUrl');
                            $data['amount']          = $paise;
                            $data['meTransReqType']  = $this->input->post('meTransReqType');
                            $data['currencyName']    = $this->input->post('currencyName');
                            $data['mid']             = $this->input->post('mid');
                            $data['enckey']          = $this->input->post('enckey');
                            $data['recurPeriod']     = $this->input->post('recurPeriod');
                            $data['numberRecurring'] = $this->input->post('numberRecurring');
                            $data['recurDay']        = $this->input->post('recurDay');
                            $data['addField1']       = $this->input->post('addField1');
                            $data['addField2']       = $this->input->post('addField2');
                            $data['addField3']       = $this->input->post('addField3');
                            $data['addField4']       = $this->input->post('addField4');
                            $data['addField5']       = $this->input->post('addField5');
                            $data['addField6']       = $this->input->post('addField6');
                            $data['addField7']       = $this->input->post('addField7');
                            $data['addField8']       = $this->input->post('addField8'); 
                            $this->load->view('layout/student/header', $data);
                            $this->load->view('user/revaluation/standard/meTrnPay',$data);
                            $this->load->view('layout/student/footer', $data);
                            } 
                            
                            
                            
                            public function pay()
                            {
                            date_default_timezone_set('Asia/Kolkata');
                            $student_id              = $this->customlib->getStudentSessionUserID();
                            $getStatusCode           = $this->input->post('getStatusCode');
                            $getPgMeTrnRefNo         = $this->input->post('getPgMeTrnRefNo');
                            $getOrderId              = $this->input->post('getOrderId');
                            $getTrnAmt               = $this->input->post('getTrnAmt');
                            $getStatusDesc           = $this->input->post('getStatusDesc');
                            $getTrnReqDate           = $this->input->post('getTrnReqDate');
                            $getResponseCode         = $this->input->post('getResponseCode');
                            $getAddField1            = $this->input->post('getAddField1');
                            $getAddField2            = $this->input->post('getAddField2');
                            $getAddField3            = $this->input->post('getAddField3');
                            $getAddField4            = $this->input->post('getAddField4');
                            $getAddField5            = $this->input->post('getAddField5');
                            $getAddField6            = $this->input->post('getAddField6');
                            $getAddField7            = $this->input->post('getAddField7');
                            $getRrn                  = $this->input->post('getRrn');
                            $getamt                  = $getTrnAmt/100;
                            $feepay                  = array(
                            'fees_revaluationpayment_statuscode'     =>  $getStatusCode,
                            'fees_revaluationpayment_transaction_no' =>  $getPgMeTrnRefNo,
                            'fees_revaluationpayment_orderid'        =>  $getOrderId,
                            'fees_revaluationpayment_amount'         =>  $getamt,
                            'fees_revaluationpayment_student_id'     =>  $getAddField1,
                            'fees_revaluationpayment_year'           =>  $getAddField2,
                            'fees_revaluationpayment_examgroup'      =>  $getAddField3,
                            'fees_revaluationpayment_examgroupbatch' =>  $getAddField4,
                            'fees_revaluationpayment_class_id'       =>  $getAddField5,
                            'fees_revaluationpayment_section_id'     =>  $getAddField6,
                            'fees_revaluationpayment_session_id'     =>  $getAddField7,
                            'fees_revaluationpayment_transdate'      =>  $getTrnReqDate,
                            'fees_revaluationpayment_responsecode'   =>  $getResponseCode,
                            'fees_revaluationpayment_created_date'   =>  date('d-m-y H:i:s'));
                            $this->db->insert("fees_revaluationpayment", $feepay);
                            
                            if(	$getStatusCode=="S")
                            {
                            $this->load->view('layout/student/header', $data);
                            $this->load->view('user/revaluation/standard/success', $data);
                            $this->load->view('layout/student/footer', $data);
                            }
                            else
                            {
                            $this->load->view('layout/student/header', $data);
                            $this->load->view('user/revaluation/standard/failed', $data);
                            $this->load->view('layout/student/footer', $data);
                            }
                            } 
                            
                            
                            
                            public function printrevaluation() 
                            {
                            $session_id                 = $this->setting_model->getCurrentSession();
                            $student_data               = $this->customlib->getLoggedInUserData();
                            $student_id                 = $this->customlib->getStudentSessionUserID();
                            $student_current_class      = $this->customlib->getStudentCurrentClsSection();
                            $data['students_listt']     = $this->student_model->get_student_list($student_id); 
                            $post_exam_id               = $this->input->post('post_exam_id');
                            $post_exam_group_id         = $this->input->post('post_exam_group_id');
                            $data['getgroup_name']      = $this->examresult_model->getgroup_name($post_exam_id, $post_exam_group_id);
                            $exam                       = $this->examgroup_model->getExamByID($post_exam_id);
                            $data['exam']               = $exam;
                            $exam_grades                = $this->grade_model->getByExamType($exam->exam_group_type);
                            $data['exam_grades']        = $exam_grades;
                            
                            $data['examfee_feecharge']      =  $this->examgroup_model->revaluation_feechargeadmin($post_exam_group_id,$post_exam_id,$session_id);
                            $data['revaluation_feecharge']  =  $this->examgroup_model->revaluation_feechargeadmin($post_exam_id, $post_exam_group_id,$session_id);
                            $data['revluation_marks']       =  $this->examresult_model->getrevluation_marks($post_exam_id, $post_exam_group_id,$student_id);
                            $data['revaluationfee_payment'] =  $this->examgroup_model->revaluationfee_payment($post_exam_id, $post_exam_group_id,$student_id,$session_id); 
                            $data['sch_setting']            =  $this->sch_setting_detail;
                            $student_exam_page              =  $this->load->view('user/revaluation/_printrevaluation', $data, true); 
                            $array                          =  array('status' => '1', 'error' => '', 'page' => $student_exam_page);
                            echo json_encode($array);
                            }
                            }
