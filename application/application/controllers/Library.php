        <?php
        //defined('BASEPATH')OR exit('No direct script access allowed');
        class Library extends Admin_Controller 
        {
        
        
        public function lib()
        {
        
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'Library/lib');   
        $librarylist = $this->Library_model->alllibrary();
        $data['librarylist']       = $librarylist;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/book/createlibrary', $data);
        $this->load->view('layout/footer', $data);
        }
        
        public function addlibrary()
        {
        $name=$this->input->post('name');
        $code=$this->input->post('code');
        $location=$this->input->post('location');
        $details=$this->input->post('details');
        $data=array('library_name'=>$name,'library_code'=>$code,'library_location'=>$location,'library_details'=>$details);
        $query=$this->Library_model->libraryadd($data);
        redirect('Library/lib');
        }
        
        public function editlibrary($id) {
        $librarylist = $this->Library_model->alllibrary();
        $data['librarylist']       = $librarylist;
        $libedit = $this->Library_model->getlibrary($id);
        $data['libedit'] = $libedit;
        $this->load->view('layout/header');
        $this->load->view('admin/book/editlibrary', $data);
        $this->load->view('layout/footer');
        }
        
        public function updatelibrary() {
        $id = $this->input->post('libid');
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $location = $this->input->post('location');
        $details = $this->input->post('details');
        $status = $this->input->post('status');
        $query=$this->Library_model->libraryupdate($id,$name,$code,$location,$details,$status);
        redirect('Library/lib');
        }
        
        public function deletelibrary($id) {
        $query=$this->Library_model->librarydelete($id);
        redirect('Library/lib');
        } 
        
        }
        ?>