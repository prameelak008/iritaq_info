        <?php
        //defined('BASEPATH')OR exit('No direct script access allowed');
        class Librarysub extends Admin_Controller 
        {
        public function librarysb()
        {	
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'Librarysub/librarysub');
        $librarysublist = $this->Librarysub_model->alllibrarysub();
        $data['librarysublist']       = $librarysublist;
        $mainsublist = $this->Librarysub_model->Allmainsubjects();
        $data['mainsublist'] = $mainsublist;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/book/addlibrarysub', $data);
        $this->load->view('layout/footer', $data);
        }
        
        public function addlibrarysub()
        {
        $name=$this->input->post('subname');
        $type=$this->input->post('subtype');
        $mainsub=$this->input->post('mainsub');
        $ddc=$this->input->post('ddcno');
        $localno=$this->input->post('localno');
        $status=$this->input->post('substatus');
        $data=array('lib_sub_name'=>$name,'lib_sub_type'=>$type,'lib_sub_mainsub'=>$mainsub,'lib_sub_ddcno'=>$ddc,'lib_sub_localno'=>$localno,'lib_sub_status'=>$status);
        $query=$this->Librarysub_model->librarysubadd($data);
        redirect('Librarysub/librarysb');
        }
        
        public function editlibrarysub($id) {
        $mainsublist = $this->Librarysub_model->Allmainsubjects();
        $data['mainsublist'] = $mainsublist;
        $librarysublist = $this->Librarysub_model->alllibrarysub();
        $data['librarysublist']       = $librarysublist;
        $libsubedit = $this->Librarysub_model->getlibrarysub($id);
        $data['libsubedit'] = $libsubedit;
        $this->load->view('layout/header');
        $this->load->view('admin/book/editlibrarysub', $data);
        $this->load->view('layout/footer');
        }
        
        public function updatelibrarysub() {
        $id = $this->input->post('libsubid');
        $name=$this->input->post('subname');
        $type=$this->input->post('subtype');
        $mainsub=$this->input->post('mainsub');
        $ddc=$this->input->post('ddcno');
        $localno=$this->input->post('localno');
        $status=$this->input->post('substatus');
        $query=$this->Librarysub_model->librarysubupdate($id,$name,$type,$mainsub,$ddc,$localno,$status);
        redirect('Librarysub/librarysb');
        }
        
        public function deletelibrarysub($id) {
        $query=$this->Librarysub_model->librarysubdelete($id);
        redirect('Librarysub/librarysb');
        } 
        
        }
        ?>