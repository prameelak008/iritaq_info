            <?php

            if (!defined('BASEPATH')) {
            exit('No direct script access allowed');
            }

            class Generateidcard extends Admin_Controller
            {

            public function __construct()
            {
            parent::__construct();

            $this->load->library('Customlib');
            $this->sch_setting_detail = $this->setting_model->getSetting();
            $this->load->library('Zend');
            $this->current_session = $this->setting_model->getCurrentSession();
            }




            public function search()
            {

            if (!$this->rbac->hasPrivilege('generateidcard', 'can_view')) {
            access_denied();
            }
            $this->session->set_userdata('top_menu', 'idcard');
            $this->session->set_userdata('sub_menu', 'admin/generateidcard');


            $data['program_types']       = $this->Semester_enrollment_model->get_program_types();
            $data['programs']            = $this->Semester_enrollment_model->get_programs();
            $data['semesters_batches']   = $this->Semester_enrollment_model->get_all_semesters_batches();


            $class                       = $this->class_model->get();
            $data['classlist']           = $class;
            $data['adm_auto_insert']     = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']         = $this->sch_setting_detail;
            $idcardlist                  = $this->Generateidcard_model->getstudentidcard();
            $data['idcardlist']          = $idcardlist;
 
            $session                     = $this->current_session;

            $button                      = $this->input->post('search');


            if ($this->input->server('REQUEST_METHOD') == "GET") 
            {

            $this->load->view('layout/header', $data);
            $this->load->view('student_nexus/generateidcard', $data);
            $this->load->view('layout/footer', $data);
            } 
            else
            {
            // $class   = $this->input->post('class_id');
            // $section = $this->input->post('section_id');
            // $search  = $this->input->post('search');
            $id_card = $this->input->post('id_card');

            if (isset($search))
            {     

            $this->form_validation->set_rules('id_card', $this->lang->line('id_card_template'), 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {

            } else {
            // $data['searchby']     = "filter";
            // $data['class_id']     = $this->input->post('class_id');
            // $data['section_id']   = $this->input->post('section_id');
            // $id_card              = $this->input->post('id_card');
            // $idcardResult         = $this->Generateidcard_model->getidcardbyid($id_card);
            // $data['idcardResult'] = $idcardResult;

            // echo $data['idcardResult'];



            // $resultlist           = $this->student_model->searchByClassSection($class, $section,$session);
            // $data['resultlist']   = $resultlist;
            // $title                = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
            // $data['title']        = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
            }
            }

            $id_card              = $this->input->post('id_card');
            $idcardResult         = $this->Generateidcard_model->getidcardbyid($id_card);
            $data['idcardResult'] = $idcardResult;     

            $program_id           = $this->input->post('program'); 
            $semester_value       = $this->input->post('semester'); // e.g. "1|12|3"

            // Split semester value into individual IDs: semester type, batch, term
            list($semester_type_id, $batch_id, $semester_term_id) = explode('|', $semester_value);

            // Pass all selected values back to view for further processing / search
            $data['selected_program']       = $program_id;
            $data['selected_semester_type'] = $semester_type_id;
            $data['selected_batch']         = $batch_id;
            $data['selected_term']          = $semester_term_id;

            $program                        = $data['selected_program'];
            $semester_id                    = $data['selected_semester_type'];
            $batch_id                       = $data['selected_batch'];
            $term_id                        = $data['selected_term'];

            $data['sem_groups']             = $this->Semesteractivities_model->get_sem_group($program,$batch_id,$semester_id,$term_id); 
            $sem_groups                     = $data['sem_groups'];              
            // $data['students']     = $this->Semester_enrollment_model->get_students($program_id, $semester_type_id, $batch_id, $semester_term_id);

            $data['resultlist']               = $this->Room_allocation_model->get_students($sem_groups['sem_group_id']);

            $this->load->view('layout/header', $data);
            $this->load->view('student_nexus/generateidcard', $data);
            $this->load->view('layout/footer', $data);
            }
            }





            // public function generate($student, $class, $idcard)
            // {
            // $idcardlist         = $this->Generateidcard_model->getidcardbyid($idcard);
            // $data['idcardlist'] = $idcardlist;
            // $resultlist         = $this->student_model->searchByClassStudent($class, $student);
            // $data['resultlist'] = $resultlist;
            // $this->load->view('admin/certificate/studentidcard', $data);
            // }


            function generate_qrcode($data,$id)
            {
            $dirname         =   $id;

            $this->load->library('ciqrcode');
            $hex_data   = bin2hex($data);
            $save_name  = $dirname.'.png';
            $dir = 'qrcode/';
            if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
            }
            $config['cacheable']    = true;
            $config['imagedir']     = $dir;
            $config['quality']      = true;
            $config['size']         = '1024';
            $config['black']        = array(255,255,255);
            $config['white']        = array(255,255,255);
            $this->ciqrcode->initialize($config);


            $params['data']     = $data;
            $params['level']    = 'L';
            $params['size']     = 10;
            $params['savename'] = FCPATH.$config['imagedir']. $save_name;

            $this->ciqrcode->generate($params);


            $return = array(
            'content' => $data,
            'file'    => $dir. $save_name
            );
            return $return;
            }           




            public function generatemultiple()
            { 
            $studentid               = $this->input->post('data');
            $student_array           = json_decode($studentid);
            $idcard                  = $this->input->post('id_card');
            $sem_group_id            = $this->input->post('sem_group_id'); 

            $data                    = array();
            $results                 = array();
            $std_arr                 = array();
            $data['sch_setting']     = $this->setting_model->get();
            $data['id_card']         = $this->Generateidcard_model->getidcardbyid($idcard);    
            $data['id_card_backend'] = $this->Generateidcard_model->getidcardbyid_backend();    

            
            foreach ($student_array as $key => $value)
            {
            $std_arr[]           = $value->student_id;
            $this->db->where(array('id'=>$value->student_id, 'barcode' => ""));      
            $q 		    = $this->db->get('semester_students');
            if ($q->num_rows() > 0) 
            {
            $update_result             = $q->row();   

            $data=[];
            $code=$update_result->admission_no;
            $this->zend->load('Zend/Barcode');
            $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
            imagepng($imageResource, 'barcodes/'.$code.'.png');
            $data['barcode'] = 'barcodes/'.$code.'.png';
            $barcode         =  $data['barcode'] ;
            $data            =  array('barcode'  =>  'barcodes/'.$code.'.png' );

            $this->db->where('id',$value->student_id);
            $this->db->update('semester_students', $data);
            }

            $this->db->where(array('id'=>$value->student_id, 'qrcode' => ""));      
            $q 		               = $this->db->get('semester_students');
            if ($q->num_rows() > 0) 
            {
            $datval                =   $q->row_array();
            $stud_id               =   $datval['id'];
            $firstname             =   $datval['firstname'];
            $middlename            =   $datval['middlename'];
            $lastname              =   $datval['lastname'];
            $middlename            =   $datval['middlename'];
            $mobileno              =   $datval['mobileno'];
            $father_name           =   $datval['father_name'];
            $father_mobile         =   $datval['father_phone'];
            $current_address       =   $datval['current_address'];

            $data= "Name:$firstname\nMobile:$mobileno\nFather Name:$father_name\nFather Mobile:$father_mobile\nHouse Name: $current_address";
            $qr                    =    $this->generate_qrcode($data,$stud_id);

            $table                 =    "semester_students";
            $condition             =    array('id'=>$datval['id']);
            $data                  =    array('qrcode'=> $qr['file']);
            $this->db->where('id',$datval['id']);
            $this->db->update('semester_students', $data);
            }
            }

            $data['students']        = $this->Room_allocation_model->getStudentsByArray($std_arr);
            $data['sch_settingdata'] = $this->sch_setting_detail;  

            $id_cards                = $this->load->view('student_nexus/generatemultiple', $data, true);

            echo json_encode(array('status' => 1, 'page' => $id_cards));
            }


            }
