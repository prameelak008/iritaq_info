        <?php
        
        defined('BASEPATH') OR exit('No direct script access allowed');
        
        class Progresscard extends CI_Controller {
        
        public function __construct() 
        {
        parent::__construct();
        //  $this->load->library('pdf');   
         $this->load->helper('url');
        }
        
        
        
        
        
        public function getreport($id)
        {
            
        $data['student']    = $this->student_model->getNewStudent($id);
        
        //$data['halfyearly'] = $this->student_model->gethalfyearExamList($id);
        //$data['annual']     = $this->student_model->getannualExamList($id);
        $data['halfyearly']        = $this->student_model->getAllExamList($id);
        
        $data['examgroup']      = $this->student_model->examgroup();
        $data['layout']     = $this->student_model->pdflayout_pdf(); 
        $this->load->library('pdf');
        $html_content       = $this->load->view('progressreport/mypdfLayout',$data,true);
        
      
   
        //  $html_content=$this->load->view('entrance/admissionform/print_pdf/admission_form',$data,true);
        //$customer_id = $this->uri->segment(3);
        //$html_content = '<h3 align="center">Convert HTML to PDF in CodeIgniter using Dompdf</h3>';
        // $html_content .= $this->htmltopdf_model->fetch_single_details($customer_id);
        // isRemoteEnabled
        // $dompdf->set_option('enable_remote', TRUE);
        
        
        $this->pdf->set_option('enable_remote', TRUE);
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $this->pdf->stream(""."ee".".pdf", array("Attachment"=>0)); 
        
        
        //  $html_content=$this->load->view('entrance/admissionform/print_pdf/allotment_slip_pdf',$data,true);
        
        // $this->pdf->loadHtml($html_content);
        // $this->pdf->set_option('isRemoteEnabled', true);
        // $this->pdf->render();
        // $this->pdf->stream(""."Allotment".".pdf", array("Attachment"=>0));
        } 
        
        
        
        /* public function getreport($id)
        {
        
        $data['student']    = $this->student_model->getNewStudent($id);
        
        $data['halfyearly'] = $this->student_model->gethalfyearExamList($id);
        $data['annual']     = $this->student_model->getannualExamList($id);
        $data['layout']     = $this->student_model->pdflayout();
        
        $html_content = $this->load->view('progressreport/mypdfLayout',$data,true);
        //$customer_id = $this->uri->segment(3);
        //$html_content = '<h3 align="center">Convert HTML to PDF in CodeIgniter using Dompdf</h3>';
        // $html_content .= $this->htmltopdf_model->fetch_single_details($customer_id);
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $this->pdf->stream(""."ee".".pdf", array("Attachment"=>0));        
        }
        */
        
        public function progresscardlayout()
        { 
        
        $id=1;
        $this->db->where('progress_card_id',$id);
        $q = $this->db->get('progress_card_layout_tbl');
        if ( $q->num_rows() > 0 ) 
        {
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|';
        $config['file_name']        = $_FILES['pic']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('pic'))
        {
        $uploadData         =   $this->upload->data();
        $pic                =   $uploadData['file_name'];
        }
        
        else
        {
        $pic                =   $this->input->post('pi');    
        }
        
        
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['file_name']        = $_FILES['footerone']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('footerone'))
        {
        $uploadData         =   $this->upload->data();
        $footerone                =   $uploadData['file_name'];
        }
        
        else
        {
        $footerone                =   $this->input->post('fot1');    
        }
        
        
        
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['file_name']        = $_FILES['footertwo']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('footertwo'))
        {
        $uploadData         =   $this->upload->data();
        $footertwo          =   $uploadData['file_name'];
        }
        
        else
        {
        $footertwo                =   $this->input->post('fot2');    
        }
        
        
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['file_name']        = $_FILES['footerthree']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config); 
        if($this->upload->do_upload('footerthree'))
        {
        $uploadData         =   $this->upload->data();
        $footerthree        =   $uploadData['file_name'];
        }
        else
        {
        $footerthree        =   $this->input->post('fot3');    
        }
        
        
        
        $table              = "progress_card_layout_tbl";
        $condition          = array('progress_card_id'     => $id);
        $data               = array('progress_card_logo'   => $pic,
        'progress_card_footer1'=> $footerone,
        'progress_card_footer2'=> $footertwo,
        'progress_card_footer3'=> $footerthree);
        
        $this->db->where($condition);
        $res=$this->db->update('progress_card_layout_tbl', $data);
        
        if($res==true)
        {
        // $this->session->set_flashdata('success', 'Updated Successfully');
        redirect($_SERVER['HTTP_REFERER']); 
        }
        
        } 
        else
        {
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['file_name']        = $_FILES['pic']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        
        
        if($this->upload->do_upload('pic'))
        {
        $uploadData         =   $this->upload->data();
        $pic                =   $uploadData['file_name'];
        }
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['file_name']        = $_FILES['footerone']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('footerone'))
        {
        $uploadData         =   $this->upload->data();
        $footerone          =   $uploadData['file_name'];
        }
        
        
        
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['file_name']        = $_FILES['footertwo']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('footertwo'))
        {
        $uploadData         =   $this->upload->data();
        $footertwo          =   $uploadData['file_name'];
        }
        
        
        
        $config['upload_path']      = 'backend/pdf_layout/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['file_name']        = $_FILES['footerthree']['name'];
        
        //Load upload library and initialize configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config); 
        if($this->upload->do_upload('footerthree'))
        {
        $uploadData         =   $this->upload->data();
        $footerthree        =   $uploadData['file_name'];
        }
        
        $data = array(               
        'progress_card_logo'   => $pic,
        'progress_card_footer1'=> $footerone,
        'progress_card_footer2'=> $footertwo,
        'progress_card_footer3'=> $footerthree);
        
        //$this->db->set('user_id', $id);
        
        $res=$this->db->insert('progress_card_layout_tbl',$data);
        if($res==true)
        {
        //$this->session->set_flashdata('success', 'Added Successfully');
        redirect($_SERVER['HTTP_REFERER']); 
        }
        }
        }
        
        
        
        
        }
