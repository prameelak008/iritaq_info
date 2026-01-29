                <?php
                defined('BASEPATH') OR exit('No direct script access allowed');
                
                class Importfees extends CI_Controller {
                
                
                
                
                
                public function __construct()
                {
                parent::__construct();
                // load model
                $this->load->model('ImportFeesmodel', 'import');
                
                } 	 
                
                
                
                public function importFile()
                {  
                $ses_id = $this->input->post('ses_id');
                $path = 'importfees/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
                } else {
                $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
                } else {
                $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                
                
                try {
                //$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                //$objReader = PHPExcel_IOFactory::createReader($inputFileType);
                //$objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($allDataInSheet as $value) 
                {
                if($flag)
                {
                $flag =false;
                continue;
                }
                
                //$cond	    		     =	 $value['A']; 
                //$condb	    		     =	 $value['B'];
                
                //$val				     =     $this->importFeesmodel->student_studentsession($cond,$condb);
                
                $condnew	    		     =	 $value['A'];
                $contno						=		$value['C'];
                
                $val				     =   $this->ImportFeesmodel->student_studentsession($condnew);
                $id				         = 	 $val['student_sessionid'];												
                $data 					 = 	array(
                'student_session_id'     =>  $id,
                'fee_session_group_id'   =>  $ses_id,
                );
                
                
                if( $value['A']!="") {
                $this->db->where('student_session_id', $id);
                $this->db->where('fee_session_group_id', $ses_id);
                
                $query = $this->db->get('student_fees_master');
                
                if ($query->num_rows() > 0) 
                {
                $reco 		= $query->row_array();
                $ido	    = $reco['id'];      	
                
                }
                else
                {
                $this->db->insert('student_fees_master',$data);
                $ido 			= $this->db->insert_id();
                
                $data 			=    array('mobileno'=> $contno);
                $this->db->where('admission_no', $condnew);
                $this->db->update('students', $data);
                
                
                }
                }
                
                $month				       =     $this->ImportFeesmodel->feejan($ses_id);				
                $id_jan=$month['idd'];
                $valamt_jan=$value['L'];
                
                
                $month_feb				   =     $this->ImportFeesmodel->feefeb($ses_id);
                $id_feb=$month_feb['idd'];
                $valamt_feb=$value['M'];
                
                
                $month_mar				   =     $this->ImportFeesmodel->feemar($ses_id);
                $id_mar=$month_mar['idd'];
                $valamt_mar=$value['N'];
                
                
                
                $month_apr				   =     $this->ImportFeesmodel->feeapr($ses_id);
                $id_apr=$month_apr['idd'];
                $valamt_apr=$value['O'];
                
                $month_may				   =     $this->ImportFeesmodel->feemay($ses_id);
                $id_may=$month_may['idd'];
                $valamt_may=$value['D'];
                
                
                $month_jun				   =     $this->ImportFeesmodel->feejun($ses_id);
                $id_jun=$month_jun['idd'];
                $valamt_jun=$value['E'];
                
                
                $month_jul				   =     $this->ImportFeesmodel->feejul($ses_id);
                $id_jul=$month_jul['idd'];
                $valamt_jul=$value['F'];
                
                $month_aug				   =     $this->ImportFeesmodel->feeaug($ses_id);
                $id_aug=$month_aug['idd'];
                $valamt_aug=$value['G'];
                
                $month_sep				   =     $this->ImportFeesmodel->feesep($ses_id);
                $id_sep=$month_sep['idd'];
                $valamt_sep=$value['H'];
                
                $month_oct				   =     $this->ImportFeesmodel->feeoct($ses_id);
                $id_oct=$month_oct['idd'];
                $valamt_oct=$value['I'];
                
                $month_nov				   =     $this->ImportFeesmodel->feenov($ses_id);
                $id_nov=$month_nov['idd'];
                $valamt_nov=$value['J'];
                
                
                $month_dec				   =     $this->ImportFeesmodel->feedec($ses_id);
                $id_dec=$month_dec['idd'];
                $valamt_dec=$value['K'];
                
                
                
                
                if($value['L']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_jan);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                $array_jan=array(
                'amount'          => $valamt_jan,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_jan    = json_encode($array_jan);
                
                
                $data_jan					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_jan,
                'amount_detail'   => '{"1":'.$ar_valamt_jan.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_jan);
                }
                }
                
                
                
                
                
                
                
                
                
                
                /*febrauary---------------->*/
                
                if($value['M']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_feb);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                $array_feb=array(
                'amount'          => $valamt_feb,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_feb    = json_encode($array_feb);
                
                
                $data_feb					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_feb,
                'amount_detail'   => '{"1":'.$ar_valamt_feb.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_feb);
                
                }
                }
                
                
                
                
                /*-------march------*/
                
                if($value['N']!="")
                {
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_mar);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {		
                
                
                
                $array_mar=array(
                'amount'          => $valamt_mar,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_mar    = json_encode($array_mar);
                
                
                $data_mar					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_mar,
                'amount_detail'   => '{"1":'.$ar_valamt_mar.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_mar);
                }
                }
                
                
                
                
                
                /*-------April------*/
                
                if($value['O']!="")
                {
                
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_apr);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {
                
                
                $array_apr=array(
                'amount'          => $valamt_apr,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_apr    = json_encode($array_apr);
                $data_apr					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_apr,
                'amount_detail'   => '{"1":'.$ar_valamt_apr.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_apr);
                }
                }
                
                
                
                /*-------May------*/
                
                if($value['D']!="")
                {
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_may);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {
                
                
                $array_may=array(
                'amount'          => $valamt_may,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_may    = json_encode($array_may);
                
                
                $data_may					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_may,
                'amount_detail'   => '{"1":'.$ar_valamt_may.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_may);
                }
                }
                
                
                
                
                /*-------June------*/
                
                if($value['E']!="")
                {
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_jun);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                $array_jun=array(
                'amount'          => $valamt_jun,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_jun    = json_encode($array_jun);
                
                
                $data_jun					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_jun,
                'amount_detail'   => '{"1":'.$ar_valamt_jun.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_jun);
                }
                }
                
                
                
                
                /*-------July------*/
                
                if($value['F']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_jul);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                $array_jul=array(
                'amount'          => $valamt_jul,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_jul    = json_encode($array_jul);
                
                
                $data_jul					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_jul,
                'amount_detail'   => '{"1":'.$ar_valamt_jul.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_jul);
                }
                }
                
                
                
                
                /*-------August------*/
                
                if($value['G']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_aug);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {
                
                
                $array_aug=array(
                'amount'          => $valamt_aug,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_aug    = json_encode($array_aug);
                
                
                $data_aug					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_aug,
                'amount_detail'   => '{"1":'.$ar_valamt_aug.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_aug);
                }
                }
                
                
                
                
                /*-------September------*/
                
                if($value['H']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_sep);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                
                $array_sep=array(
                'amount'          => $valamt_sep,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_sep    = json_encode($array_sep);
                
                
                $data_sep					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_sep,
                'amount_detail'   => '{"1":'.$ar_valamt_sep.'}',
                );
                
                $result=$this->db->insert('student_fees_deposite',$data_sep);
                }
                }
                
                
                
                /*-------October------*/
                
                if($value['I']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_oct);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                $array_oct=array(
                'amount'          => $valamt_oct,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_oct    = json_encode($array_oct);
                
                
                $data_oct					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_oct,
                'amount_detail'   => '{"1":'.$ar_valamt_oct.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_oct);
                }
                
                }
                
                /*-------November------*/
                
                if($value['J']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_nov);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {
                
                
                $array_nov=array(
                'amount'          => $valamt_nov,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_nov    = json_encode($array_nov);
                
                
                $data_nov					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_nov,
                'amount_detail'   => '{"1":'.$ar_valamt_nov.'}',
                );
                
                $this->db->insert('student_fees_deposite',$data_nov);
                }
                }
                
                
                
                /*-------December------*/
                
                if($value['K']!="")
                {
                
                $this->db->where('student_fees_master_id', $ido);
                $this->db->where('fee_groups_feetype_id', $id_dec);
                
                $query = $this->db->get('student_fees_deposite');
                
                if ($query->num_rows() > 0) 
                {
                
                
                
                }
                else
                {	
                
                
                $array_dec=array(
                'amount'          => $valamt_dec,
                'date'            => date('Y-m-d'),
                'description'     => 'Direct Collected By: Super Admin',
                'amount_discount' => 0,
                'amount_fine'     => 0,
                'payment_mode'    => 'Cash',
                'received_by'     => 1,
                'inv_no'		  => 1);
                
                $ar_valamt_dec    = json_encode($array_dec);
                
                
                $data_dec					 = 	array(
                'student_fees_master_id'     =>  $ido,
                'fee_groups_feetype_id'   =>  $id_dec,
                'amount_detail'   => '{"1":'.$ar_valamt_dec.'}',
                );
                
                $result	=$this->db->insert('student_fees_deposite',$data_dec);
                }
                }
                
                
                $i++;
                }
                
                if($result=='true')
                {
                
                
                $this->session->set_flashdata('flashSuccess', 'Imported successfully');
                }
                else
                {
                $this->session->set_flashdata('flashError', 'Already exists');
                
                
                } 
                redirect($_SERVER['HTTP_REFERER']);	            
                
                } 
                catch (Exception $e)
                {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                . '": ' .$e->getMessage());
                }
                }
                else
                {
                echo $error['error'];
                }
                
                
                
                
                }						
                
                }
