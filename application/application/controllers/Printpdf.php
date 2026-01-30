<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Printpdf extends CI_Controller {

    public function __construct() 
    {
    parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->search_type        = $this->config->item('search_type');
        $this->sch_setting_detail = $this->setting_model->getSetting();

        $this->load->library('Customlib');
        $this->sch_setting_detail = $this->setting_model->getSetting();
        $this->load->library('pdf'); 



    }


        public  function printFeesBy_Newpdf()
        {
        $data['sch_setting'] = $this->sch_setting_detail;
        
        if(isset($_POST['Print']))
        {
         $checklist=array();
         $data['sch_setting'] = $this->sch_setting_detail;       

         $checklist                  = $this->input->post('fee_checkbox');
        foreach($checklist as $ch)
        {
        $rec= explode(',',$ch);

            $fee_groups_feetype_id = $rec[2];
            $fee_master_id         = $rec[1];
            $fee_session_group_id  = $rec[0];
            $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
            $fees_array[]          = $feeList;
        }
       
     
          $data['feearray'] = $fees_array;
          $html_content=$this->load->view('print/printFees_newpdf',$data,true);
           $this->pdf->loadHtml($html_content);
           $this->pdf->render();
           $this->pdf->stream(""."Fees".".pdf", array("Attachment"=>0));          

}


        if(isset($_POST['sendmail']))
        {

          

        $getemailconfig=$this->student_model->Newgetemailconfig();

        $email_type= $getemailconfig['email_type'];
        $smtp_server=  $getemailconfig['smtp_server'];
        $smtp_port= $getemailconfig['smtp_port'];
        $smtp_username= $getemailconfig['smtp_username']; //sender ()
        $smtp_password= $getemailconfig['smtp_password'];

      echo $this->session->flashdata('Mail has been sent');

        $checklist=array();
        $data['sch_setting'] = $this->sch_setting_detail;       

         $checklist          = $this->input->post('fee_checkbox');
        foreach($checklist as $ch)
        {
        $rec                   = explode(',',$ch);

        $fee_session_group_id  = $rec[0];
        $fee_master_id         = $rec[1];            
        $fee_groups_feetype_id = $rec[2]; 
        $feeList               = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
        $fees_array[]          = $feeList;
        } 
        $data['feearray'] = $fees_array;

          
          
           $html_content=$this->load->view('print/printFees_newpdf',$data,true);     
           $this->pdf->loadHtml($html_content);
           $this->pdf->render();
           
         $output=$this->pdf->Output();
         
         $path=base_url().'pdf/';
         $pdf_data=$this->pdf->stream(""."Fees".".pdf", array("Attachment"=>0));
         
         $filename="fees.pdf";
       
         file_put_contents('pdf/'.$filename,$output);



        
        foreach($fees_array as $fees=>$key)
        {        
        $id=$key->student_session_id;
        
        } 

        $idd               = $id;

        $Newgetstudentlist = $this->student_model->Newgetstudentlist($idd);
       
        $email             = $Newgetstudentlist['email'];
        


    $atch=base_url().'pdf/fees.pdf';
    $this->load->library('mailsmsconf');

//SMTP & mail configuration
$config = array(
    'protocol'  => $email_type,
    'smtp_host' => $smtp_server,
    'smtp_port' => $smtp_port,
    'smtp_user' => $smtp_username, //sender ()
    'smtp_pass' => $smtp_password,//sender gmail password()
    'mailtype'  => 'html',
    'charset'   => 'utf-8'
);
$this->email->initialize($config);
$this->email->set_mailtype("html");
$this->email->set_newline("\r\n");

//Email content
$htmlContent = '<h1> Fees Receipt</h1>';
$htmlContent .= '<p>This email has sent via Jamia</p>';

$this->email->to($email);  //Reciver Mail
$this->email->from($smtp_username,'Smart Madarsa');
$this->email->subject('Fees Receipt');
$this->email->message($htmlContent);

$this->email->attach($atch);
//$this->email->attach('Order-000.pdf');
//Send email
$this->email->send();


//$this->session->set_flashdata('flashSuccess', 'Mail has been sent'); 

redirect($_SERVER['HTTP_REFERER'],'refresh');	



        }
}






    

   





 
  








   

}
